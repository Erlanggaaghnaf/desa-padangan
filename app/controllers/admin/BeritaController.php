<?php

class BeritaController extends Controller
{
    public function index()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $beritaModel = $this->model('BeritaModel');
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        if ($requestMethod === 'POST') {
            $action = trim($_POST['action'] ?? '');

            switch ($action) {
                case 'store':
                    $this->handleStoreBerita($beritaModel);
                    break;

                case 'update':
                    $this->handleUpdateBerita($beritaModel);
                    break;

                case 'delete':
                    $this->handleDeleteBerita($beritaModel);
                    break;

                default:
                    $this->setBeritaFlash(
                        'error',
                        'Berita gagal diproses. Aksi tidak dikenali.'
                    );

                    $this->redirectBerita();
                    break;
            }

            return;
        }

        $totalBerita = $beritaModel->getCount();

        $requestedPage = isset($_GET['page'])
            ? (int) $_GET['page']
            : 1;

        $requestedPage = max(1, $requestedPage);

        /*
         * Page 1:
         * 15 berita karena 1 slot digunakan tombol Tambah.
         * Page 2+:
         * 16 berita.
         */
        $totalPages = $totalBerita <= 15
            ? 1
            : 1 + (int) ceil(($totalBerita - 15) / 16);

        $currentPage = min(
            $requestedPage,
            $totalPages
        );

        if ($currentPage === 1) {
            $limit = 15;
            $offset = 0;
        } else {
            $limit = 16;
            $offset = 15 + (($currentPage - 2) * 16);
        }

        $data['title'] = 'Manajemen Berita';

        $data['berita'] = $beritaModel->getPaginated(
            $limit,
            $offset
        );

        $data['berita_total'] = $totalBerita;
        $data['berita_current_page'] = $currentPage;
        $data['berita_total_pages'] = $totalPages;

        $data['berita_flash'] =
            $_SESSION['berita_flash'] ?? null;

        unset($_SESSION['berita_flash']);

        $this->view('admin/berita', $data);
    }

    // Alias jika rute memanggil method berita() langsung
    public function berita()
    {
        return $this->index();
    }

    // Handler Berita
    private function handleStoreBerita(BeritaModel $beritaModel)
    {
        $judul = trim($_POST['judul'] ?? '');
        $isi = trim($_POST['isi'] ?? ($_POST['deskripsi'] ?? ''));
        $deskripsi = $isi;

        if ($judul === '') {
            $this->setBeritaFlash(
                'error',
                'Berita gagal ditambahkan. Judul wajib diisi.'
            );

            $this->redirectBerita();
        }

        if ($isi === '') {
            $this->setBeritaFlash(
                'error',
                'Berita gagal ditambahkan. Detail berita wajib diisi.'
            );

            $this->redirectBerita();
        }

        $validation = $this->validateBeritaUpload(
            $_FILES['foto'] ?? null,
            true
        );

        if ($validation['error'] !== null) {
            $this->setBeritaFlash(
                'error',
                'Berita gagal ditambahkan. ' .
                $validation['error']
            );

            $this->redirectBerita();
        }

        $storedFile = $this->storeBeritaFile(
            $_FILES['foto'],
            $validation['extension']
        );

        if ($storedFile === false) {
            $this->setBeritaFlash(
                'error',
                'Berita gagal ditambahkan. File foto tidak dapat disimpan.'
            );

            $this->redirectBerita();
        }

        try {
            $saved = $beritaModel->create(
                $judul,
                $deskripsi,
                $isi,
                $storedFile
            );
        } catch (Throwable $e) {
            error_log($e->getMessage());

            $saved = false;
        }

        if (!$saved) {
            $this->removeStoredBeritaFile($storedFile);

            $this->setBeritaFlash(
                'error',
                'Berita gagal ditambahkan. Data database tidak dapat disimpan.'
            );

            $this->redirectBerita();
        }

        $this->setBeritaFlash(
            'success',
            'Berita berhasil ditambahkan.'
        );

        $this->redirectBerita(1);
    }

    // Update Berita
    private function handleUpdateBerita(BeritaModel $beritaModel)
    {
        $id = isset($_POST['id'])
            ? (int) $_POST['id']
            : 0;

        $returnPage = isset($_POST['page'])
            ? max(1, (int) $_POST['page'])
            : 1;

        $judul = trim($_POST['judul'] ?? '');
        $isi = trim($_POST['isi'] ?? ($_POST['deskripsi'] ?? ''));
        $deskripsi = $isi;

        $existing = $beritaModel->getById($id);

        if (!$existing) {
            $this->setBeritaFlash(
                'error',
                'Berita gagal diperbarui. Data tidak ditemukan.'
            );

            $this->redirectBerita($returnPage);
        }

        if ($judul === '') {
            $this->setBeritaFlash(
                'error',
                'Berita gagal diperbarui. Judul wajib diisi.'
            );

            $this->redirectBerita($returnPage);
        }

        if ($isi === '') {
            $this->setBeritaFlash(
                'error',
                'Berita gagal diperbarui. Detail berita wajib diisi.'
            );

            $this->redirectBerita($returnPage);
        }

        $newFile = $_FILES['foto'] ?? null;

        $hasNewFile =
            is_array($newFile) &&
            ($newFile['error'] ?? UPLOAD_ERR_NO_FILE)
                !== UPLOAD_ERR_NO_FILE;

        $storedNewFile = null;

        if ($hasNewFile) {
            $validation = $this->validateBeritaUpload(
                $newFile,
                true
            );

            if ($validation['error'] !== null) {
                $this->setBeritaFlash(
                    'error',
                    'Berita gagal diperbarui. ' .
                    $validation['error']
                );

                $this->redirectBerita($returnPage);
            }

            $storedNewFile = $this->storeBeritaFile(
                $newFile,
                $validation['extension']
            );

            if ($storedNewFile === false) {
                $this->setBeritaFlash(
                    'error',
                    'Berita gagal diperbarui. File baru tidak dapat disimpan.'
                );

                $this->redirectBerita($returnPage);
            }
        }

        try {
            $updated = $beritaModel->update(
                $id,
                $judul,
                $deskripsi,
                $isi,
                $storedNewFile
            );
        } catch (Throwable $e) {
            error_log($e->getMessage());

            $updated = false;
        }

        if (!$updated) {
            if ($storedNewFile !== null) {
                $this->removeStoredBeritaFile($storedNewFile);
            }

            $this->setBeritaFlash(
                'error',
                'Berita gagal diperbarui. Data database tidak dapat disimpan.'
            );

            $this->redirectBerita($returnPage);
        }

        if (
            $storedNewFile !== null &&
            !empty($existing['foto']) &&
            $existing['foto'] !== $storedNewFile
        ) {
            $oldDeleted = $this->removeStoredBeritaFile(
                $existing['foto']
            );

            if (!$oldDeleted) {
                $this->setBeritaFlash(
                    'error',
                    'Berita berhasil diperbarui, tetapi foto lama tidak dapat dihapus dari storage.'
                );

                $this->redirectBerita($returnPage);
            }
        }

        $this->setBeritaFlash(
            'success',
            'Berita berhasil diperbarui.'
        );

        $this->redirectBerita($returnPage);
    }

    // Handler delete berita
    private function handleDeleteBerita(BeritaModel $beritaModel)
    {
        $id = isset($_POST['id'])
            ? (int) $_POST['id']
            : 0;

        $returnPage = isset($_POST['page'])
            ? max(1, (int) $_POST['page'])
            : 1;

        $existing = $beritaModel->getById($id);

        if (!$existing) {
            $this->setBeritaFlash(
                'error',
                'Berita gagal dihapus. Data tidak ditemukan.'
            );

            $this->redirectBerita($returnPage);
        }

        try {
            $deleted = $beritaModel->delete($id);
        } catch (Throwable $e) {
            error_log($e->getMessage());

            $deleted = false;
        }

        if (!$deleted) {
            $this->setBeritaFlash(
                'error',
                'Berita gagal dihapus. Data database tidak dapat dihapus.'
            );

            $this->redirectBerita($returnPage);
        }

        if (
            !$this->removeStoredBeritaFile(
                $existing['foto']
            )
        ) {
            $this->setBeritaFlash(
                'error',
                'Berita berhasil dihapus dari database, tetapi file foto tidak dapat dihapus dari storage.'
            );

            $this->redirectBerita($returnPage);
        }

        $this->setBeritaFlash(
            'success',
            'Berita berhasil dihapus.'
        );

        $this->redirectBerita($returnPage);
    }

    // Validasi update berita
    private function validateBeritaUpload($file, $required = true)
    {
        if (!is_array($file)) {
            return [
                'error' => $required
                    ? 'File foto wajib dipilih.'
                    : null,
                'extension' => null
            ];
        }

        $errorCode =
            $file['error'] ?? UPLOAD_ERR_NO_FILE;

        if ($errorCode === UPLOAD_ERR_NO_FILE) {
            return [
                'error' => $required
                    ? 'File foto wajib dipilih.'
                    : null,
                'extension' => null
            ];
        }

        if ($errorCode !== UPLOAD_ERR_OK) {
            return [
                'error' => 'Upload file gagal diproses.',
                'extension' => null
            ];
        }

        if (
            !isset(
                $file['tmp_name'],
                $file['name'],
                $file['size']
            ) ||
            !is_uploaded_file($file['tmp_name'])
        ) {
            return [
                'error' => 'File upload tidak valid.',
                'extension' => null
            ];
        }

        if ((int) $file['size'] > 5 * 1024 * 1024) {
            return [
                'error' => 'Ukuran file maksimal 5 MB.',
                'extension' => null
            ];
        }

        $extension = strtolower(
            pathinfo(
                $file['name'],
                PATHINFO_EXTENSION
            )
        );

        $allowedExtensions = [
            'jpg',
            'jpeg',
            'png'
        ];

        if (
            !in_array(
                $extension,
                $allowedExtensions,
                true
            )
        ) {
            return [
                'error' =>
                    'Format file hanya JPG, JPEG, atau PNG.',
                'extension' => null
            ];
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);

        $mime = $finfo->file(
            $file['tmp_name']
        );

        $allowedMimes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png'
        ];

        if (
            !isset($allowedMimes[$extension]) ||
            $mime !== $allowedMimes[$extension]
        ) {
            return [
                'error' =>
                    'Tipe file gambar tidak valid.',
                'extension' => null
            ];
        }

        if (
            @getimagesize(
                $file['tmp_name']
            ) === false
        ) {
            return [
                'error' =>
                    'File yang diunggah bukan gambar yang valid.',
                'extension' => null
            ];
        }

        return [
            'error' => null,
            'extension' => $extension
        ];
    }

    // Handler storage berita
    private function storeBeritaFile($file, $extension)
    {
        $uploadDir = $this->getBeritaUploadDir();

        if (
            !is_dir($uploadDir) &&
            !mkdir($uploadDir, 0775, true) &&
            !is_dir($uploadDir)
        ) {
            return false;
        }

        if (!is_writable($uploadDir)) {
            return false;
        }

        try {
            $token = bin2hex(
                random_bytes(12)
            );
        } catch (Throwable $e) {
            $token = uniqid('', true);
        }

        $filename =
            'berita_' .
            date('YmdHis') .
            '_' .
            $token .
            '.' .
            $extension;

        $destination =
            $uploadDir .
            $filename;

        if (
            !move_uploaded_file(
                $file['tmp_name'],
                $destination
            )
        ) {
            return false;
        }

        return $filename;
    }

    private function removeStoredBeritaFile($filename)
    {
        $filename = basename(
            (string) $filename
        );

        if ($filename === '') {
            return true;
        }

        $path =
            $this->getBeritaUploadDir() .
            $filename;

        if (!file_exists($path)) {
            return true;
        }

        return unlink($path);
    }

    private function getBeritaUploadDir()
    {
        return dirname(__DIR__, 3) . '/public/uploads/berita/';
    }

    private function setBeritaFlash($type, $message)
    {
        $_SESSION['berita_flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }

    private function redirectBerita($page = 1)
    {
        $protocol =
            (!empty($_SERVER['HTTPS']) &&
            $_SERVER['HTTPS'] !== 'off')
                ? 'https'
                : 'http';

        $baseUrl =
            $protocol .
            '://' .
            $_SERVER['HTTP_HOST'] .
            rtrim(
                dirname($_SERVER['SCRIPT_NAME']),
                '/\\'
            );

        $page = max(1, (int) $page);

        $url =
            $baseUrl .
            '/index.php?url=admin/berita&page=' .
            $page;

        header('Location: ' . $url);
        exit;
    }
}