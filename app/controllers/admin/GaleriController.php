<?php

class GaleriController extends Controller
{
    public function index()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $galeriModel = $this->model('GaleriModel');
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        if ($requestMethod === 'POST') {
            $action = $_POST['action'] ?? '';

            switch ($action) {
                case 'store':
                    $this->handleStoreGaleri($galeriModel);
                    break;

                case 'update':
                    $this->handleUpdateGaleri($galeriModel);
                    break;

                case 'delete':
                    $this->handleDeleteGaleri($galeriModel);
                    break;

                default:
                    $this->setGaleriFlash('error', 'Aksi galeri tidak dikenali.');
                    $this->redirectGaleri();
                    break;
            }

            return;
        }

        $totalFoto = $galeriModel->getCount();

        $requestedPage = isset($_GET['page'])
            ? (int) $_GET['page']
            : 1;

        $requestedPage = max(1, $requestedPage);

        $totalPages = $totalFoto <= 15
            ? 1
            : 1 + (int) ceil(($totalFoto - 15) / 16);

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

        $data['title'] = 'Manajemen Galeri';
        $data['galeri'] = $galeriModel->getPaginated(
            $limit,
            $offset
        );

        $data['galeri_total'] = $totalFoto;
        $data['galeri_current_page'] = $currentPage;
        $data['galeri_total_pages'] = $totalPages;

        $data['galeri_flash'] =
            $_SESSION['galeri_flash'] ?? null;

        unset($_SESSION['galeri_flash']);

        $this->view('admin/galeri', $data);
    }

    private function handleStoreGaleri(GaleriModel $galeriModel) {
        $judul = trim($_POST['judul'] ?? '');

        if ($judul === '') {
            $this->setGaleriFlash(
                'error',
                'Foto galeri gagal ditambahkan. Judul kegiatan wajib diisi.'
            );

            $this->redirectGaleri(1);
        }

        if (mb_strlen($judul) > 255) {
            $this->setGaleriFlash(
                'error',
                'Foto galeri gagal ditambahkan. Judul maksimal 255 karakter.'
            );

            $this->redirectGaleri(1);
        }

        $validation = $this->validateGaleriUpload(
            $_FILES['foto'] ?? null,
            true
        );

        if ($validation['error'] !== null) {
            $this->setGaleriFlash(
                'error',
                'Foto galeri gagal ditambahkan. ' .
                $validation['error']
            );

            $this->redirectGaleri(1);
        }

        $storedFile = $this->storeGaleriFile(
            $_FILES['foto'],
            $validation['extension']
        );

        if ($storedFile === false) {
            $this->setGaleriFlash(
                'error',
                'Foto galeri gagal ditambahkan. File tidak dapat disimpan ke storage.'
            );

            $this->redirectGaleri(1);
        }

        try {
            $galeriModel->create(
                $judul,
                $storedFile
            );
        } catch (Throwable $e) {
            $this->removeStoredGaleriFile($storedFile);

            $this->setGaleriFlash(
                'error',
                'Foto galeri gagal ditambahkan. Data database tidak dapat disimpan.'
            );

            $this->redirectGaleri(1);
        }

        $this->setGaleriFlash(
            'success',
            'Foto galeri berhasil ditambahkan.'
        );

        $this->redirectGaleri(1);
    }

    private function handleUpdateGaleri(GaleriModel $galeriModel) {
        $id = isset($_POST['id'])
            ? (int) $_POST['id']
            : 0;

        $returnPage = isset($_POST['page'])
            ? max(1, (int) $_POST['page'])
            : 1;

        $judul = trim($_POST['judul'] ?? '');

        $existing = $galeriModel->getById($id);

        if (!$existing) {
            $this->setGaleriFlash(
                'error',
                'Foto galeri gagal diperbarui. Data tidak ditemukan.'
            );

            $this->redirectGaleri($returnPage);
        }

        if ($judul === '') {
            $this->setGaleriFlash(
                'error',
                'Foto galeri gagal diperbarui. Judul kegiatan wajib diisi.'
            );

            $this->redirectGaleri($returnPage);
        }

        if (mb_strlen($judul) > 255) {
            $this->setGaleriFlash(
                'error',
                'Foto galeri gagal diperbarui. Judul maksimal 255 karakter.'
            );

            $this->redirectGaleri($returnPage);
        }

        $newFile = $_FILES['foto'] ?? null;

        $hasNewFile =
            is_array($newFile) &&
            ($newFile['error'] ?? UPLOAD_ERR_NO_FILE)
            !== UPLOAD_ERR_NO_FILE;

        $storedNewFile = null;

        if ($hasNewFile) {
            $validation = $this->validateGaleriUpload(
                $newFile,
                true
            );

            if ($validation['error'] !== null) {
                $this->setGaleriFlash(
                    'error',
                    'Foto galeri gagal diperbarui. ' .
                    $validation['error']
                );

                $this->redirectGaleri($returnPage);
            }

            $storedNewFile = $this->storeGaleriFile(
                $newFile,
                $validation['extension']
            );

            if ($storedNewFile === false) {
                $this->setGaleriFlash(
                    'error',
                    'Foto galeri gagal diperbarui. File baru tidak dapat disimpan ke storage.'
                );

                $this->redirectGaleri($returnPage);
            }
        }

        try {
            $updated = $galeriModel->update(
                $id,
                $judul,
                $storedNewFile !== null
                    ? $storedNewFile
                    : null
            );
        } catch (Throwable $e) {
            $updated = false;
        }

        if (!$updated) {
            if ($storedNewFile !== null) {
                $this->removeStoredGaleriFile(
                    $storedNewFile
                );
            }

            $this->setGaleriFlash(
                'error',
                'Foto galeri gagal diperbarui. Data database tidak dapat disimpan.'
            );

            $this->redirectGaleri($returnPage);
        }

        if (
            $storedNewFile !== null &&
            $existing['foto'] !== $storedNewFile
        ) {
            $oldFileDeleted =
                $this->removeStoredGaleriFile(
                    $existing['foto']
                );

            if (!$oldFileDeleted) {
                $this->setGaleriFlash(
                    'error',
                    'Foto galeri berhasil diperbarui, tetapi file gambar lama tidak dapat dihapus dari storage.'
                );

                $this->redirectGaleri($returnPage);
            }
        }

        $this->setGaleriFlash(
            'success',
            'Foto galeri berhasil diperbarui.'
        );

        $this->redirectGaleri($returnPage);
    }

    private function handleDeleteGaleri(GaleriModel $galeriModel) {
        $id = isset($_POST['id'])
            ? (int) $_POST['id']
            : 0;

        $returnPage = isset($_POST['page'])
            ? max(1, (int) $_POST['page'])
            : 1;

        $existing = $galeriModel->getById($id);

        if (!$existing) {
            $this->setGaleriFlash(
                'error',
                'Foto galeri gagal dihapus. Data tidak ditemukan.'
            );

            $this->redirectGaleri($returnPage);
        }

        try {
            $deleted =
                $galeriModel->delete($id);
        } catch (Throwable $e) {
            $deleted = false;
        }

        if (!$deleted) {
            $this->setGaleriFlash(
                'error',
                'Foto galeri gagal dihapus. Data database tidak dapat dihapus.'
            );

            $this->redirectGaleri($returnPage);
        }

        if (
            !$this->removeStoredGaleriFile(
                $existing['foto']
            )
        ) {
            $this->setGaleriFlash(
                'error',
                'Foto galeri berhasil dihapus dari database, tetapi file gambar tidak dapat dihapus dari storage.'
            );

            $this->redirectGaleri($returnPage);
        }

        $this->setGaleriFlash(
            'success',
            'Foto galeri berhasil dihapus.'
        );

        $this->redirectGaleri($returnPage);
    }

    private function validateGaleriUpload(
        $file,
        $required = true
    ) {
        if (!is_array($file)) {
            return [
                'error' => $required
                    ? 'File foto wajib dipilih.'
                    : null,
                'extension' => null,
            ];
        }

        $errorCode =
            $file['error'] ?? UPLOAD_ERR_NO_FILE;

        if ($errorCode === UPLOAD_ERR_NO_FILE) {
            return [
                'error' => $required
                    ? 'File foto wajib dipilih.'
                    : null,
                'extension' => null,
            ];
        }

        if ($errorCode !== UPLOAD_ERR_OK) {
            return [
                'error' => 'Upload file gagal diproses.',
                'extension' => null,
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
                'extension' => null,
            ];
        }

        if ((int) $file['size'] > 5 * 1024 * 1024) {
            return [
                'error' => 'Ukuran file maksimal 5 MB.',
                'extension' => null,
            ];
        }

        $extension =
            strtolower(
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
                'extension' => null,
            ];
        }

        $finfo = new finfo(
            FILEINFO_MIME_TYPE
        );

        $mime =
            $finfo->file(
                $file['tmp_name']
            );

        $allowedMimes = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
        ];

        if (
            !isset($allowedMimes[$extension]) ||
            $mime !== $allowedMimes[$extension]
        ) {
            return [
                'error' =>
                    'Tipe file gambar tidak valid.',
                'extension' => null,
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
                'extension' => null,
            ];
        }

        return [
            'error' => null,
            'extension' => $extension,
        ];
    }

    private function storeGaleriFile(
        $file,
        $extension
    ) {
        $uploadDir =
            $this->getGaleriUploadDir();

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
            $token =
                bin2hex(
                    random_bytes(12)
                );
        } catch (Throwable $e) {
            $token =
                uniqid('', true);
        }

        $filename =
            'galeri_' .
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

    private function removeStoredGaleriFile(
        $filename
    ) {
        $filename =
            basename(
                (string) $filename
            );

        if ($filename === '') {
            return true;
        }

        $path =
            $this->getGaleriUploadDir() .
            $filename;

        if (!file_exists($path)) {
            return true;
        }

        return unlink($path);
    }

    private function getGaleriUploadDir()
    {
       return $_SERVER['DOCUMENT_ROOT'] . '/desa-padangan/public/uploads/galeri/';
    }

    private function setGaleriFlash(
        $type,
        $message
    ) {
        $_SESSION['galeri_flash'] = [
            'type' => $type,
            'message' => $message,
        ];
    }

    private function redirectGaleri(
        $page = 1
    ) {
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

        $page =
            max(1, (int) $page);

        $url =
            $baseUrl .
            '/index.php?url=admin/galeri&page=' .
            $page;

        header(
            'Location: ' . $url
        );

        exit;
    }
}