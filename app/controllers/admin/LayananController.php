<?php

class LayananController extends Controller
{
    /**
     * Manajemen layanan desa di sisi admin.
     * GET  : menampilkan daftar / form edit.
     * POST : store, update, atau delete.
     */
    public function index()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $layananModel = $this->model('LayananModel');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = trim($_POST['action'] ?? '');

            try {
                if ($action === 'store' || $action === 'update') {
                    $namaLayanan = trim($_POST['nama_layanan'] ?? '');
                    $kategori = $this->normalizeKategoriLayanan($_POST['kategori'] ?? '');
                    $persyaratan = $this->collectPersyaratan($_POST['persyaratan'] ?? []);
                    $alur = $this->collectAlur($_POST['alur_judul'] ?? [], $_POST['alur_deskripsi'] ?? []);

                    $this->validateLayananInput($namaLayanan, $kategori, $alur);

                    if ($action === 'store') {
                        $layananModel->tambahLayanan(
                            $namaLayanan,
                            $kategori,
                            $persyaratan,
                            $alur
                        );

                        $this->setLayananFlash('success', 'Layanan berhasil ditambahkan.');
                        $this->redirectLayanan();
                    }

                    $id = (int) ($_POST['id'] ?? 0);
                    if ($id <= 0) {
                        throw new InvalidArgumentException('ID layanan tidak valid.');
                    }

                    $layananModel->ubahLayanan(
                        $id,
                        $namaLayanan,
                        $kategori,
                        $persyaratan,
                        $alur
                    );

                    $this->setLayananFlash('success', 'Layanan berhasil diperbarui.');
                    $this->redirectLayanan();
                }

                if ($action === 'delete') {
                    $id = (int) ($_POST['id'] ?? 0);

                    if ($id <= 0) {
                        throw new InvalidArgumentException('ID layanan tidak valid.');
                    }

                    if (!$layananModel->hapusLayanan($id)) {
                        throw new RuntimeException('Layanan tidak ditemukan.');
                    }

                    $this->setLayananFlash('success', 'Layanan berhasil dihapus.');
                    $this->redirectLayanan();
                }

                throw new InvalidArgumentException('Aksi layanan tidak valid.');
            } catch (Throwable $e) {
                error_log($e->getMessage());

                $this->setLayananFlash(
                    'error',
                    'Perubahan layanan gagal diproses. Periksa data lalu coba lagi.'
                );

                $this->redirectLayanan();
            }
        }

        $data['title'] = 'Manajemen Layanan Desa';

        $data['layanan_flash'] = $_SESSION['layanan_flash'] ?? null;
        unset($_SESSION['layanan_flash']);

        $data['layanan'] = $layananModel->getAllLayanan();
        $data['edit_layanan'] = null;

        $editId = isset($_GET['edit_id']) ? (int) $_GET['edit_id'] : 0;
        if ($editId > 0) {
            $data['edit_layanan'] = $layananModel->getLayananById($editId);

            if ($data['edit_layanan'] === null) {
                $data['error'] = 'not_found';
            }
        }

        $this->view('admin/layanan', $data);
    }

    private function normalizeKategoriLayanan($kategori)
    {
        $kategori = trim((string) $kategori);
        $normalized = strtolower(preg_replace('/\s+/', ' ', $kategori));

        $allowed = [
            'kependudukan' => 'Kependudukan',
            'surat keterangan' => 'Surat Keterangan',
            'surat lainnya' => 'Surat Lainnya',
        ];

        return $allowed[$normalized] ?? null;
    }

    private function collectPersyaratan($rawPersyaratan)
    {
        if (!is_array($rawPersyaratan)) {
            return [];
        }

        $result = [];

        foreach ($rawPersyaratan as $value) {
            $value = trim((string) $value);

            if ($value !== '') {
                $result[] = $value;
            }
        }

        return $result;
    }

    private function collectAlur($rawJudul, $rawDeskripsi)
    {
        if (!is_array($rawJudul) || !is_array($rawDeskripsi)) {
            return [];
        }

        $total = max(count($rawJudul), count($rawDeskripsi));
        $result = [];

        for ($i = 0; $i < $total; $i++) {
            $judul = trim((string) ($rawJudul[$i] ?? ''));
            $deskripsi = trim((string) ($rawDeskripsi[$i] ?? ''));

            if ($judul === '' && $deskripsi === '') {
                continue;
            }

            if ($judul === '' || $deskripsi === '') {
                throw new InvalidArgumentException('Setiap langkah layanan harus memiliki judul dan deskripsi.');
            }

            $result[] = [
                'judul_langkah' => $judul,
                'deskripsi_langkah' => $deskripsi,
            ];
        }

        return $result;
    }

    private function validateLayananInput($namaLayanan, $kategori, array $alur)
    {
        if ($namaLayanan === '') {
            throw new InvalidArgumentException('Nama layanan wajib diisi.');
        }

        if ($kategori === null) {
            throw new InvalidArgumentException('Kategori layanan tidak valid.');
        }

        foreach ($alur as $langkah) {
            if ($langkah['judul_langkah'] === '' || $langkah['deskripsi_langkah'] === '') {
                throw new InvalidArgumentException('Judul dan deskripsi setiap langkah wajib diisi.');
            }
        }
    }

    private function setLayananFlash($type, $message)
    {
        $_SESSION['layanan_flash'] = [
            'type' => $type,
            'message' => $message,
        ];
    }

    private function redirectLayanan()
    {
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
        $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        $url = $base_url . '/index.php?url=admin/layanan';

        header('Location: ' . $url);
        exit;
    }
}