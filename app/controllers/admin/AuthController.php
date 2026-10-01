<?php

class AuthController extends Controller
{
    public function login()
    {
        if (!empty($_SESSION['admin_auth']['authenticated'])) {
            $this->redirectToAdmin('dashboard');
        }

        $data['error'] = '';
        $data['flash'] = $_SESSION['admin_flash'] ?? null;
        unset($_SESSION['admin_flash']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = isset($_POST['password']) ? (string) $_POST['password'] : '';

            $adminModel = $this->model('AdminModel');
            $admin = $adminModel->findByUsername($username);

            if ($admin && password_verify($password, $admin['password_hash'])) {
                session_regenerate_id(true);

                $_SESSION['admin_auth'] = [
                    'authenticated' => true,
                    'id' => (int) $admin['id'],
                    'username' => (string) $admin['username'],
                    'role' => (string) ($admin['role'] ?? 'admin'),
                ];

                $this->redirectToAdmin('dashboard');
            }

            $data['error'] = 'Username atau password salah!';
        }

        $this->view('admin/login', $data);
    }

    /**
     * Wizard setup akun superadmin pertama.
     */
    public function setup()
    {
        $adminModel = $this->model('AdminModel');
        $state = null;
        $data = [
            'title' => 'Setup Administrator',
            'setup_error' => $_SESSION['setup_flash']['error'] ?? '',
            'setup_success' => $_SESSION['setup_flash']['success'] ?? '',
            'csrf_token' => $this->getSetupCsrfToken(),
            'schema_ready' => false,
            'setup_allowed' => false,
            'setup_completed' => false,
            'setup_enabled' => defined('ADMIN_SETUP_ENABLED') ? ADMIN_SETUP_ENABLED : true,
            'setup_key_configured' => defined('ADMIN_SETUP_KEY') ? strlen((string) ADMIN_SETUP_KEY) >= 32 : false,
        ];
        unset($_SESSION['setup_flash']);

        try {
            $data['schema_ready'] = method_exists($adminModel, 'hasRoleColumn') && $adminModel->hasRoleColumn()
                && method_exists($adminModel, 'hasSetupStateTable') && $adminModel->hasSetupStateTable();

            if ($data['schema_ready']) {
                $state = $adminModel->getSetupState();
                $data['setup_completed'] = !empty($state)
                    && (int) ($state['setup_completed'] ?? 0) === 1;

                $data['setup_allowed'] = (defined('ADMIN_SETUP_ENABLED') ? ADMIN_SETUP_ENABLED : true)
                    && (defined('ADMIN_SETUP_KEY') ? strlen((string) ADMIN_SETUP_KEY) >= 32 : false)
                    && !$data['setup_completed']
                    && $adminModel->countAdmins() === 0;
            }
        } catch (Throwable $e) {
            error_log($e->getMessage());
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleSetup($adminModel, $data['setup_allowed']);
            return;
        }

        $this->view('admin/setup', $data);
    }

    private function handleSetup(AdminModel $adminModel, $setupAllowed)
    {
        try {
            $this->requireSetupCsrf();

            if (!$setupAllowed) {
                throw new RuntimeException('Setup administrator sudah terkunci atau belum siap digunakan.');
            }

            $setupKey = isset($_POST['setup_key']) ? (string) $_POST['setup_key'] : '';
            $username = trim((string) ($_POST['username'] ?? ''));
            $password = isset($_POST['password']) ? (string) $_POST['password'] : '';
            $confirmation = isset($_POST['password_confirmation']) ? (string) $_POST['password_confirmation'] : '';

            if ($setupKey === '' || !defined('ADMIN_SETUP_KEY') || !hash_equals((string) ADMIN_SETUP_KEY, $setupKey)) {
                throw new InvalidArgumentException('Kunci setup tidak valid.');
            }

            if ($username === '' || strlen($password) < 8 || $password !== $confirmation) {
                throw new InvalidArgumentException('Data form setup tidak valid atau password kurang dari 8 karakter.');
            }

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $created = $adminModel->createSuperadminAtomically($username, $hash);

            if (!$created) {
                throw new RuntimeException('Setup administrator gagal diproses.');
            }

            unset($_SESSION['setup_csrf']);
            session_regenerate_id(true);

            $_SESSION['admin_flash'] = [
                'type' => 'success',
                'message' => 'Akun superadmin berhasil dibuat. Silakan login.'
            ];

            $this->redirectToAdmin('login');
        } catch (Throwable $e) {
            $_SESSION['setup_flash'] = ['error' => $e->getMessage()];
            $this->redirectToAdmin('setup');
        }
    }

    private function requireSetupCsrf()
    {
        $token = $_POST['_csrf'] ?? '';
        if (!isset($_SESSION['setup_csrf']) || !is_string($token) || !hash_equals((string) $_SESSION['setup_csrf'], (string) $token)) {
            throw new RuntimeException('Permintaan setup tidak valid.');
        }
    }

    private function getSetupCsrfToken()
    {
        if (empty($_SESSION['setup_csrf'])) {
            $_SESSION['setup_csrf'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['setup_csrf'];
    }

    public function logout()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'] ?? '',
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
        $this->redirectToAdmin('login');
    }

    private function redirectToAdmin($route)
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $baseUrl = $protocol . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        header('Location: ' . $baseUrl . '/index.php?url=admin/' . ltrim($route, '/'));
        exit;
    }
}