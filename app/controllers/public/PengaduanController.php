
<?php

class PengaduanController extends Controller
{
    private const MAX_PHOTOS = 3;
    private const MAX_PHOTO_SIZE = 5 * 1024 * 1024;
    private const MAX_TOTAL_PHOTO_SIZE = 15 * 1024 * 1024;
    private const MAX_REQUEST_SIZE = 17 * 1024 * 1024;
    private const MIN_FORM_SECONDS = 3;
    private const MAX_FORM_AGE_SECONDS = 10800;

    private function ensureSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function recordAndGetVisitor()
    {
        $visitorModel = $this->model('VisitorModel');
        $visitorModel->recordVisitor();

        return $visitorModel->getVisitorStats();
    }

    public function index()
    {
        $this->ensureSession();

        if (
            empty($_SESSION['pengaduan_csrf']) ||
            !is_string($_SESSION['pengaduan_csrf'])
        ) {
            $_SESSION['pengaduan_csrf'] = bin2hex(random_bytes(32));
        }

        $data['visitor_stats'] = $this->recordAndGetVisitor();

        $this->view('layouts/header', $data);
        $this->view('public/pengaduan', $data);
        $this->view('layouts/footer', $data);
    }

    private function getSecurityConfig(): array
    {
        $path = __DIR__ . '/../../config/pengaduan_security.local.php';

        if (!is_file($path)) {
            return [];
        }

        $config = require $path;

        if (!is_array($config)) {
            return [];
        }

        $turnstile = is_array($config['turnstile'] ?? null)
            ? $config['turnstile']
            : [];

        $siteKey = $config['turnstile_site_key']
            ?? $config['site_key']
            ?? $turnstile['site_key']
            ?? '';

        $secretKey = $config['turnstile_secret_key']
            ?? $config['secret_key']
            ?? $turnstile['secret_key']
            ?? '';

        $hmacSecret = $config['rate_limit_hmac_secret']
            ?? $config['hmac_secret']
            ?? $config['ip_hash_secret']
            ?? '';

        $hostnames = $config['allowed_hostnames']
            ?? $config['hostnames']
            ?? ['desapadangan.site', 'www.desapadangan.site'];

        if (!is_array($hostnames)) {
            $hostnames = [];
        }

        return [
            'site_key' => is_string($siteKey) ? trim($siteKey) : '',
            'secret_key' => is_string($secretKey) ? trim($secretKey) : '',
            'hmac_secret' => is_string($hmacSecret) ? $hmacSecret : '',
            'allowed_hostnames' => array_values(
                array_filter($hostnames, 'is_string')
            ),
        ];
    }

    private function postString(string $key): string
    {
        $value = $_POST[$key] ?? '';

        return is_string($value) ? trim($value) : '';
    }

    private function redirectToForm(): void
    {
        $this->ensureSession();

        $requestHost = strtolower(
            (string) parse_url(
                'https://' . ($_SERVER['HTTP_HOST'] ?? ''),
                PHP_URL_HOST
            )
        );

        $target = '/';
        $referer = $_SERVER['HTTP_REFERER'] ?? '';
        $parts = is_string($referer) ? parse_url($referer) : false;

        if (
            is_array($parts) &&
            isset($parts['host']) &&
            strtolower($parts['host']) === $requestHost &&
            isset($parts['path']) &&
            str_starts_with($parts['path'], '/')
        ) {
            $target = $parts['path'];

            if (isset($parts['query'])) {
                $target .= '?' . $parts['query'];
            }
        }

        $target = preg_replace('/[\r\n]/', '', $target);
        header('Location: ' . $target . '#pengaduanModal', true, 303);
        exit;
    }

    private function flashAndRedirect(
        string $type,
        string $message
    ): void {
        $this->ensureSession();

        $_SESSION['pengaduan_flash'] = [
            'type' => $type,
            'message' => $message,
        ];

        $this->redirectToForm();
    }

    private function getClientIp(): ?string
    {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';

        if (
            !is_string($ip) ||
            filter_var($ip, FILTER_VALIDATE_IP) === false
        ) {
            return null;
        }

        return $ip;
    }

    private function verifyTurnstile(
        string $token,
        string $secretKey,
        string $clientIp,
        array $allowedHostnames
    ): bool {
        if (
            $token === '' ||
            $secretKey === '' ||
            !function_exists('curl_init')
        ) {
            return false;
        }

        $curl = curl_init(
            'https://challenges.cloudflare.com/turnstile/v0/siteverify'
        );

        if ($curl === false) {
            return false;
        }

        curl_setopt_array($curl, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query([
                'secret' => $secretKey,
                'response' => $token,
                'remoteip' => $clientIp,
            ]),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 8,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',
            ],
        ]);

        $response = curl_exec($curl);
        $httpStatus = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlError = curl_errno($curl);

        curl_close($curl);

        if (
            $response === false ||
            $curlError !== 0 ||
            $httpStatus !== 200
        ) {
            return false;
        }

        $result = json_decode($response, true);

        if (
            !is_array($result) ||
            ($result['success'] ?? false) !== true ||
            ($result['action'] ?? '') !== 'pengaduan'
        ) {
            return false;
        }

        $hostname = strtolower(
            (string) ($result['hostname'] ?? '')
        );

        $allowedHostnames = array_map(
            static fn($host) => strtolower(trim($host)),
            $allowedHostnames
        );

        return $hostname !== '' &&
            in_array($hostname, $allowedHostnames, true);
    }

    private function savePhotos(?array $files, string $directory): array
    {
        if ($files === null) {
            return [];
        }

        foreach (['name', 'tmp_name', 'error', 'size'] as $key) {
            if (!isset($files[$key]) || !is_array($files[$key])) {
                throw new RuntimeException(
                    'Format lampiran tidak valid.'
                );
            }
        }

        $count = count($files['name']);

        if (
            count($files['tmp_name']) !== $count ||
            count($files['error']) !== $count ||
            count($files['size']) !== $count
        ) {
            throw new RuntimeException(
                'Format lampiran tidak valid.'
            );
        }

        $selected = [];

        foreach ($files['error'] as $index => $error) {
            if ((int) $error !== UPLOAD_ERR_NO_FILE) {
                $selected[] = $index;
            }
        }

        if (count($selected) > self::MAX_PHOTOS) {
            throw new RuntimeException(
                'Maksimal 3 foto untuk setiap pengaduan.'
            );
        }

        if (empty($selected)) {
            return [];
        }

        $totalSize = 0;

        foreach ($selected as $index) {
            $error = (int) $files['error'][$index];
            $size = (int) $files['size'][$index];

            if ($error !== UPLOAD_ERR_OK) {
                throw new RuntimeException(
                    'Salah satu foto gagal diunggah. Silakan coba lagi.'
                );
            }

            if ($size <= 0 || $size > self::MAX_PHOTO_SIZE) {
                throw new RuntimeException(
                    'Setiap foto harus berukuran maksimal 5 MB.'
                );
            }

            $totalSize += $size;
        }

        if ($totalSize > self::MAX_TOTAL_PHOTO_SIZE) {
            throw new RuntimeException(
                'Total ukuran foto maksimal 15 MB.'
            );
        }

        if (!is_dir($directory)) {
            if (!mkdir($directory, 0755, true) && !is_dir($directory)) {
                throw new RuntimeException(
                    'Folder penyimpanan foto tidak tersedia.'
                );
            }
        }

        if (!is_writable($directory)) {
            throw new RuntimeException(
                'Folder penyimpanan foto tidak dapat ditulisi.'
            );
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        if ($finfo === false) {
            throw new RuntimeException(
                'Validasi tipe foto tidak dapat dilakukan.'
            );
        }

        $uploaded = [];

        try {
            $allowedTypes = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
            ];

            foreach ($selected as $index) {
                $tmpPath = $files['tmp_name'][$index] ?? '';

                if (
                    !is_string($tmpPath) ||
                    !is_uploaded_file($tmpPath)
                ) {
                    throw new RuntimeException(
                        'Lampiran foto tidak valid.'
                    );
                }

                $mime = finfo_file($finfo, $tmpPath);

                if (
                    !is_string($mime) ||
                    !isset($allowedTypes[$mime])
                ) {
                    throw new RuntimeException(
                        'Format foto hanya boleh JPG atau PNG.'
                    );
                }

                $imageInfo = @getimagesize($tmpPath);

                if (
                    $imageInfo === false ||
                    ($imageInfo['mime'] ?? '') !== $mime ||
                    empty($imageInfo[0]) ||
                    empty($imageInfo[1])
                ) {
                    throw new RuntimeException(
                        'Salah satu file bukan gambar yang valid.'
                    );
                }

                if (($imageInfo[0] * $imageInfo[1]) > 25000000) {
                    throw new RuntimeException(
                        'Dimensi salah satu foto terlalu besar.'
                    );
                }

                $filename = bin2hex(random_bytes(16))
                    . '.' . $allowedTypes[$mime];

                $destination = rtrim($directory, '/\\')
                    . DIRECTORY_SEPARATOR
                    . $filename;

                if (!move_uploaded_file($tmpPath, $destination)) {
                    throw new RuntimeException(
                        'Foto gagal disimpan. Silakan coba lagi.'
                    );
                }

                @chmod($destination, 0640);
                $uploaded[] = $filename;
            }
        } catch (Throwable $e) {
            foreach ($uploaded as $filename) {
                $path = rtrim($directory, '/\\')
                    . DIRECTORY_SEPARATOR
                    . $filename;

                if (is_file($path)) {
                    @unlink($path);
                }
            }

            finfo_close($finfo);
            throw $e;
        }

        finfo_close($finfo);

        return $uploaded;
    }

    public function store()
    {
        $this->ensureSession();

        if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            http_response_code(405);
            header('Allow: POST');
            exit('Metode permintaan tidak diizinkan.');
        }

        $contentLength = (int) ($_SERVER['CONTENT_LENGTH'] ?? 0);

        if ($contentLength > self::MAX_REQUEST_SIZE) {
            $this->flashAndRedirect(
                'error',
                'Ukuran permintaan terlalu besar. Maksimal total foto 15 MB.'
            );
        }

        $config = $this->getSecurityConfig();

        if (
            $config['site_key'] === '' ||
            $config['secret_key'] === '' ||
            strlen($config['hmac_secret']) < 32 ||
            empty($config['allowed_hostnames'])
        ) {
            $this->flashAndRedirect(
                'error',
                'Formulir pengaduan belum siap digunakan. Silakan hubungi admin desa.'
            );
        }

        $clientIp = $this->getClientIp();

        if ($clientIp === null) {
            $this->flashAndRedirect(
                'error',
                'Permintaan tidak dapat diverifikasi. Silakan coba lagi.'
            );
        }

        $ipHash = hash_hmac(
            'sha256',
            $clientIp,
            $config['hmac_secret']
        );

        try {
            $pengaduanModel = $this->model('PengaduanModel');

            // Hitung semua percobaan, termasuk yang ditolak.
            $rate = $pengaduanModel->registerAttempt($ipHash);

            if (!is_array($rate) || empty($rate['allowed'])) {
                $message = 'Batas pengiriman tercapai. Silakan coba kembali nanti.';

                if (
                    is_array($rate) &&
                    isset($rate['message']) &&
                    is_string($rate['message'])
                ) {
                    $message = $rate['message'];
                }

                $this->flashAndRedirect('error', $message);
            }
        } catch (Throwable $e) {
            error_log('Pengaduan rate limit error: ' . $e->getMessage());

            $this->flashAndRedirect(
                'error',
                'Pengaduan belum dapat diproses. Silakan coba lagi nanti.'
            );
        }

        // Validasi CSRF.
        $csrfToken = $this->postString('csrf_token');
        $sessionToken = $_SESSION['pengaduan_csrf'] ?? '';

        if (
            $csrfToken === '' ||
            !is_string($sessionToken) ||
            $sessionToken === '' ||
            !hash_equals($sessionToken, $csrfToken)
        ) {
            $this->flashAndRedirect(
                'error',
                'Sesi formulir tidak valid. Silakan buka formulir kembali.'
            );
        }

        // Honeypot: kolom ini seharusnya selalu kosong.
        if ($this->postString('website') !== '') {
            $this->flashAndRedirect(
                'error',
                'Pengiriman tidak dapat diproses.'
            );
        }

        // Tolak pengiriman yang terlalu cepat atau formulir yang kedaluwarsa.
        $startedAt = filter_var(
            $this->postString('form_started_at'),
            FILTER_VALIDATE_INT
        );

        $now = time();

        if (
            $startedAt === false ||
            $startedAt <= 0 ||
            ($now - $startedAt) < self::MIN_FORM_SECONDS ||
            ($now - $startedAt) > self::MAX_FORM_AGE_SECONDS
        ) {
            $this->flashAndRedirect(
                'error',
                'Silakan buka formulir kembali dan isi dengan lengkap.'
            );
        }

        // Verifikasi Turnstile harus berhasil di server.
        $turnstileToken = $this->postString('cf-turnstile-response');

        if (!$this->verifyTurnstile(
            $turnstileToken,
            $config['secret_key'],
            $clientIp,
            $config['allowed_hostnames']
        )) {
            $this->flashAndRedirect(
                'error',
                'Verifikasi keamanan gagal atau kedaluwarsa. Silakan coba lagi.'
            );
        }

        // Ambil teks secara aman.
        $rawData = [
            'nama' => $this->postString('nama'),
            'kontak' => $this->postString('kontak'),
            'judul' => $this->postString('judul'),
            'isi' => $this->postString('isi'),
        ];

        $limits = [
            'nama' => 100,
            'kontak' => 50,
            'judul' => 150,
            'isi' => 5000,
        ];

        foreach ($rawData as $field => $value) {
            if ($value === '') {
                $this->flashAndRedirect(
                    'error',
                    'Semua kolom pengaduan wajib diisi.'
                );
            }

            $length = function_exists('mb_strlen')
                ? mb_strlen($value, 'UTF-8')
                : strlen($value);

            if ($length > $limits[$field]) {
                $this->flashAndRedirect(
                    'error',
                    'Salah satu kolom melebihi batas panjang yang diperbolehkan.'
                );
            }

            if (preg_match('//u', $value) !== 1) {
                $this->flashAndRedirect(
                    'error',
                    'Teks yang dimasukkan memiliki format tidak valid.'
                );
            }
        }

        // Tetap simpan teks yang telah di-escape seperti perilaku controller lama.
        $data = [];

        foreach ($rawData as $field => $value) {
            $data[$field] = htmlspecialchars(
                $value,
                ENT_QUOTES | ENT_SUBSTITUTE,
                'UTF-8'
            );
        }

        // Hash konten digunakan untuk mencari pengaduan duplikat.
        $canonicalContent = implode("\n", array_map(
            static function ($value) {
                $value = trim($value);

                return function_exists('mb_strtolower')
                    ? mb_strtolower($value, 'UTF-8')
                    : strtolower($value);
            },
            array_values($rawData)
        ));

        $contentHash = hash_hmac(
            'sha256',
            $canonicalContent,
            $config['hmac_secret']
        );

        try {
            if (
                $pengaduanModel->isDuplicateSubmission(
                    $ipHash,
                    $contentHash
                )
            ) {
                $this->flashAndRedirect(
                    'error',
                    'Pengaduan serupa baru saja dikirim. Silakan tunggu sebelum mengirim ulang.'
                );
            }
        } catch (Throwable $e) {
            error_log('Pengaduan duplicate check error: ' . $e->getMessage());

            $this->flashAndRedirect(
                'error',
                'Pengaduan belum dapat diproses. Silakan coba lagi nanti.'
            );
        }

        $uploadDirectory = rtrim(
            (string) ($_SERVER['DOCUMENT_ROOT'] ?? ''),
            '/\\'
        ) . '/uploads/pengaduan';

        $uploadedPhotos = [];

        try {
            $uploadedPhotos = $this->savePhotos(
                isset($_FILES['foto']) && is_array($_FILES['foto'])
                    ? $_FILES['foto']
                    : null,
                $uploadDirectory
            );

            $photoString = !empty($uploadedPhotos)
                ? implode(',', $uploadedPhotos)
                : null;

            $success = $pengaduanModel->tambahPengaduan(
                $data,
                $photoString,
                $ipHash,
                $contentHash
            );

            if (!$success) {
                throw new RuntimeException(
                    'Database menolak penyimpanan pengaduan.'
                );
            }
        } catch (Throwable $e) {
            error_log('Pengaduan save error: ' . $e->getMessage());

            // Hapus lampiran yang sudah tersimpan jika DB gagal.
            foreach ($uploadedPhotos as $filename) {
                $path = $uploadDirectory
                    . DIRECTORY_SEPARATOR
                    . $filename;

                if (is_file($path)) {
                    @unlink($path);
                }
            }

            $message = $e instanceof RuntimeException
                ? $e->getMessage()
                : 'Terjadi kesalahan saat menyimpan pengaduan.';

            $this->flashAndRedirect('error', $message);
        }

        // Rotasi token setelah pengiriman sukses.
        $_SESSION['pengaduan_csrf'] = bin2hex(random_bytes(32));

        $this->flashAndRedirect(
            'success',
            'Pengaduan berhasil dikirim. Terima kasih telah menyampaikan aspirasi Anda.'
        );
    }
}
