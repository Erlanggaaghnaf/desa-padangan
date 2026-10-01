<?php

class AkunController extends Controller {
    public function index()
    {
        $this->requireSuperadmin();
        $adminModel = $this->model('AdminModel');

        $data['title'] = 'Manajemen Akun Administrator';
        $data['admin_accounts'] = $adminModel->getAll();
        $data['csrf_token'] = $this->getAdminCsrfToken();
        $data['admin_flash'] = $_SESSION['admin_flash'] ?? null;
        unset($_SESSION['admin_flash']);

        $this->view('admin/akun', $data);
    }

    public function tambahAdmin()
    {
        $this->requireSuperadmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleTambahAdmin();
            return;
        }

        $data['title'] = 'Tambah Akun Administrator';
        $data['csrf_token'] = $this->getAdminCsrfToken();
        $data['admin_flash'] = $_SESSION['admin_flash'] ?? null;
        unset($_SESSION['admin_flash']);

        $this->view('admin/tambah_admin', $data);
    }

    private function handleTambahAdmin()
    {
        $username = trim((string) ($_POST['username'] ?? ''));
        $password = isset($_POST['password']) ? (string) $_POST['password'] : '';
        $confirmation = isset($_POST['password_confirmation']) ? (string) $_POST['password_confirmation'] : '';
        $role = strtolower(trim((string) ($_POST['role'] ?? 'admin')));
        $superadminPassword = isset($_POST['superadmin_password']) ? (string) $_POST['superadmin_password'] : '';

        try {
            $this->requireAdminCsrf();
            $this->validateAdminUsername($username);
            $this->validateAdminPassword($password, $confirmation);
            $this->validateAdminRole($role);

            $adminModel = $this->model('AdminModel');
            $currentAdminId = (int) ($_SESSION['admin_auth']['id'] ?? 0);

            if ($adminModel->usernameExists($username)) {
                throw new InvalidArgumentException('Username sudah digunakan. Silakan pilih username lain.');
            }

            if ($role === 'superadmin') {
                if ($superadminPassword === '') {
                    throw new InvalidArgumentException('Password akun superadmin saat ini wajib diisi untuk membuat superadmin baru.');
                }

                $currentAdmin = $adminModel->findByIdWithPassword($currentAdminId);

                if (!$currentAdmin || !password_verify($superadminPassword, (string) ($currentAdmin['password_hash'] ?? ''))) {
                    throw new InvalidArgumentException('Verifikasi password superadmin tidak valid.');
                }
            }

            $hash = password_hash($password, PASSWORD_DEFAULT);
            if ($hash === false) {
                throw new RuntimeException('Password gagal diproses.');
            }

            try {
                $adminModel->create($username, $hash, $role);
            } catch (PDOException $e) {
                if ($e->getCode() === '23000') {
                    throw new InvalidArgumentException('Username sudah digunakan. Silakan pilih username lain.');
                }
                throw $e;
            }

            $this->setAdminFlash('success', 'Akun administrator baru berhasil dibuat.');
            $this->redirectToAdmin('akun');

        } catch (InvalidArgumentException $e) {
            $this->setAdminFlash('error', $e->getMessage());
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->setAdminFlash('error', 'Akun administrator gagal dibuat. Periksa data lalu coba lagi.');
        }

        $this->redirectToAdmin('tambah-admin');
    }

    private function validateAdminUsername($username)
    {
        if ($username === '') {
            throw new InvalidArgumentException('Username wajib diisi.');
        }
        if (mb_strlen($username) < 3 || mb_strlen($username) > 100) {
            throw new InvalidArgumentException('Username harus terdiri dari 3 sampai 100 karakter.');
        }
        if (!preg_match('/^[A-Za-z0-9._-]+$/', $username)) {
            throw new InvalidArgumentException('Username hanya boleh menggunakan huruf, angka, titik, garis bawah, dan tanda hubung.');
        }
    }

    private function validateAdminRole($role)
    {
        if (!in_array($role, ['admin', 'superadmin'], true)) {
            throw new InvalidArgumentException('Role administrator tidak valid.');
        }
    }

    private function validateAdminPassword($password, $confirmation)
    {
        $length = strlen($password);
        if ($length < 8) {
            throw new InvalidArgumentException('Password minimal 8 karakter.');
        }
        if ($length > 255) {
            throw new InvalidArgumentException('Password terlalu panjang.');
        }
        if ($password !== $confirmation) {
            throw new InvalidArgumentException('Konfirmasi password tidak cocok.');
        }
    }

    private function requireSuperadmin()
    {
        $role = (string) ($_SESSION['admin_auth']['role'] ?? '');
        if ($role !== 'superadmin') {
            http_response_code(403);
            $data['title'] = 'Akses Ditolak';
            $data['message'] = 'Halaman ini hanya dapat digunakan oleh superadmin.';
            $this->view('admin/forbidden', $data);
            exit;
        }
    }

    private function requireAdminCsrf()
    {
        $token = $_POST['_csrf'] ?? '';
        if (!isset($_SESSION['admin_csrf']) || !is_string($token) || !hash_equals($_SESSION['admin_csrf'], (string) $token)) {
            throw new RuntimeException('Permintaan tidak valid. Silakan muat ulang halaman lalu coba lagi.');
        }
    }

    private function getAdminCsrfToken()
    {
        if (empty($_SESSION['admin_csrf'])) {
            $_SESSION['admin_csrf'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['admin_csrf'];
    }

    private function setAdminFlash($type, $message)
    {
        $_SESSION['admin_flash'] = [
            'type' => $type,
            'message' => $message,
        ];
    }

    private function redirectToAdmin($route)
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $baseUrl = $protocol . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        header('Location: ' . $baseUrl . '/index.php?url=admin/' . ltrim($route, '/'));
        exit;
    }

    public function pengaturanAkun()
    {
        $adminModel = $this->model('AdminModel');
        $currentAdminId = (int) ($_SESSION['admin_auth']['id'] ?? 0);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePengaturanAkun($adminModel, $currentAdminId);
            return;
        }

        $data['title'] = 'Pengaturan Akun Saya';
        $data['admin_account'] = $adminModel->findById($currentAdminId);
        $data['csrf_token'] = $this->getAdminCsrfToken();
        $data['admin_flash'] = $_SESSION['admin_flash'] ?? null;
        unset($_SESSION['admin_flash']);

        $this->view('admin/pengaturan_akun', $data);
    }

    private function handlePengaturanAkun(AdminModel $adminModel, $currentAdminId)
    {
        $username = trim((string) ($_POST['username'] ?? ''));
        $currentPassword = isset($_POST['current_password']) ? (string) $_POST['current_password'] : '';
        $newPassword = isset($_POST['password']) ? (string) $_POST['password'] : '';
        $confirmation = isset($_POST['password_confirmation']) ? (string) $_POST['password_confirmation'] : '';

        try {
            $this->requireAdminCsrf();
            $this->validateAdminUsername($username);

            $admin = $adminModel->findByIdWithPassword($currentAdminId);
            if (!$admin) {
                throw new RuntimeException('Akun tidak ditemukan.');
            }

            if ($username !== $admin['username'] && $adminModel->usernameExists($username)) {
                throw new InvalidArgumentException('Username sudah digunakan oleh akun lain.');
            }

            $updateData = ['username' => $username];

            // Jika ingin mengganti password
            if ($newPassword !== '' || $currentPassword !== '') {
                if ($currentPassword === '' || !password_verify($currentPassword, (string) ($admin['password_hash'] ?? ''))) {
                    throw new InvalidArgumentException('Password saat ini tidak sesuai.');
                }
                $this->validateAdminPassword($newPassword, $confirmation);
                $hash = password_hash($newPassword, PASSWORD_DEFAULT);
                if ($hash === false) {
                    throw new RuntimeException('Password gagal diproses.');
                }
                $updateData['password_hash'] = $hash;
            }

            $adminModel->updateAccount($currentAdminId, $updateData);
            $_SESSION['admin_auth']['username'] = $username;

            $this->setAdminFlash('success', 'Pengaturan akun berhasil diperbarui.');
            $this->redirectToAdmin('pengaturan-akun');

        } catch (InvalidArgumentException $e) {
            $this->setAdminFlash('error', $e->getMessage());
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $this->setAdminFlash('error', 'Gagal memperbarui pengaturan akun.');
        }

        $this->redirectToAdmin('pengaturan-akun');
    }

    public function hapusAdmin()
    {
        $this->requireSuperadmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->requireAdminCsrf();

                $idToDelete = isset($_POST['id']) ? (int) $_POST['id'] : 0;
                $currentAdminId = (int) ($_SESSION['admin_auth']['id'] ?? 0);

                if ($idToDelete <= 0) {
                    throw new InvalidArgumentException('ID administrator tidak valid.');
                }

                if ($idToDelete === $currentAdminId) {
                    throw new InvalidArgumentException('Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.');
                }

                $adminModel = $this->model('AdminModel');
                $targetAdmin = $adminModel->findById($idToDelete);

                if (!$targetAdmin) {
                    throw new RuntimeException('Akun administrator tidak ditemukan.');
                }

                $deleted = $adminModel->deleteById($idToDelete);

                if (!$deleted) {
                    throw new RuntimeException('Gagal menghapus akun dari database.');
                }

                $this->setAdminFlash('success', 'Akun administrator berhasil dihapus.');
            } catch (InvalidArgumentException | RuntimeException $e) {
                $this->setAdminFlash('error', $e->getMessage());
            } catch (Throwable $e) {
                error_log($e->getMessage());
                $this->setAdminFlash('error', 'Terjadi kesalahan sistem saat menghapus akun.');
            }
        }

        $this->redirectToAdmin('akun');
    }
}