<?php

class App
{
    protected $controller = 'public/HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        // 1. Jalankan manajemen sesi terlebih dahulu
        $this->startSession();

        $url = $this->parseURL();
        $isAdmin = false;

        // 2. TENTUKAN AREA (ADMIN ATAU PUBLIC) & CONTROLLER
        if (isset($url[0]) && strtolower($url[0]) === 'admin') {
            $isAdmin = true;
            unset($url[0]); // Hapus segmen 'admin'[cite: 1]

            // Cek apakah mengakses shortcut auth (login/logout/setup)
            $authActions = ['login', 'logout', 'setup'];
            if (isset($url[1]) && in_array(strtolower($url[1]), $authActions, true)) {
                $controllerName = 'AuthController';
                $file = '../app/controllers/admin/AuthController.php';
                $this->method = strtolower($url[1]);
                unset($url[1]);
            }elseif (isset($url[1]) && strtolower($url[1]) === 'tambah-admin') {
                $controllerName = 'AkunController';
                $file = '../app/controllers/admin/AkunController.php';
                $this->method = 'tambahAdmin';
                unset($url[1]);
            }elseif (isset($url[1]) && strtolower($url[1]) === 'hapus-admin') {
                $controllerName = 'AkunController';
                $file = '../app/controllers/admin/AkunController.php';
                $this->method = 'hapusAdmin';
                unset($url[1]);
            }elseif (isset($url[1]) && strtolower($url[1]) === 'pengaturan-akun') {
                $controllerName = 'AkunController';
                $file = '../app/controllers/admin/AkunController.php';
                $this->method = 'pengaturanAkun';
                unset($url[1]);
            }else {
                // Konversi URL bergaris datar (master-data) menjadi CamelCase (MasterData)[cite: 1]
                $rawControllerName = isset($url[1]) ? str_replace(' ', '', ucwords(str_replace('-', ' ', $url[1]))) : 'Dashboard';
                $controllerName = $rawControllerName . 'Controller';
                $file = '../app/controllers/admin/' . $controllerName . '.php';
                unset($url[1]);
            }

            if (file_exists($file)) {
                $this->controller = 'admin/' . $controllerName;
            } else {
                $this->controller = 'admin/DashboardController'; // Fallback jika controller tidak ditemukan[cite: 1]
            }
        } else {
            // Modul Public / Pengunjung[cite: 1]
            $rawControllerName = isset($url[0]) && !empty($url[0]) ? str_replace(' ', '', ucwords(str_replace('-', ' ', $url[0]))) : 'Home';
            $controllerName = $rawControllerName . 'Controller';
            $file = '../app/controllers/public/' . $controllerName . '.php';

            if (file_exists($file)) {
                $this->controller = 'public/' . $controllerName;
                unset($url[0]);
            } else {
                $this->controller = 'public/HomeController'; // Fallback[cite: 1]
            }
        }

        // Load File Controller
        require_once '../app/controllers/' . $this->controller . '.php';
        $className = basename($this->controller);
        $this->controller = new $className;

        // 3. TENTUKAN METHOD / FUNGSI
        $methodIndex = $isAdmin ? 2 : 1;

        if (!in_array($this->method, ['login', 'logout', 'setup', 'tambahAdmin'], true) && isset($url[$methodIndex])) {
            $rawMethodName = str_replace('-', ' ', $url[$methodIndex]);
            $methodName = lcfirst(str_replace(' ', '', ucwords($rawMethodName)));

            if (method_exists($this->controller, $methodName)) {
                $this->method = $methodName;
                unset($url[$methodIndex]);
            }
        }

        // 4. TENTUKAN PARAMETER
        $this->params = $url ? array_values($url) : [];

        // 5. PROTEKSI AREA ADMIN (SESSION & AUTH GUARD)
        $routeArea = $this->getRouteArea($_GET['url'] ?? '');

        if ($routeArea === 'admin' && !$this->isPublicAdminMethod($this->method)) {
            if (!$this->isAuthenticated()) {
                $this->redirectTo('admin/login');
            }

            $this->disableAdminPageCache();
        }

        if ($routeArea === 'admin' && $this->method === 'logout') {
            $this->disableAdminPageCache();
        }

        // 6. JALANKAN CONTROLLER, METHOD, DAN PARAMETER
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }

        return [];
    }

    private function startSession()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        $secure = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
        $cookiePath = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? '/'), '/\\');
        $cookiePath = $cookiePath === '' ? '/' : $cookiePath . '/';

        session_set_cookie_params([
            'lifetime' => 0,
            'path' => $cookiePath,
            'secure' => $secure,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);

        session_start();
    }

    private function isAuthenticated()
    {
        if (empty($_SESSION['admin_auth']['authenticated'])
            || $_SESSION['admin_auth']['authenticated'] !== true
            || empty($_SESSION['admin_auth']['id'])) {
            return false;
        }

        try {
            require_once __DIR__ . '/../models/AdminModel.php';
            $adminModel = new AdminModel();
            $identity = $adminModel->findIdentityById((int) $_SESSION['admin_auth']['id']);

            if (!$identity) {
                $_SESSION = [];
                return false;
            }

            $_SESSION['admin_auth']['username'] = (string) $identity['username'];
            $_SESSION['admin_auth']['role'] = (string) ($identity['role'] ?? 'admin');
            return in_array($_SESSION['admin_auth']['role'], ['superadmin', 'admin'], true);
        } catch (Throwable $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    private function isPublicAdminMethod($method)
    {
        return in_array($method, ['login', 'logout', 'setup'], true);
    }

    private function getRouteArea($route)
    {
        $route = trim((string) $route, '/');

        if ($route === '') {
            return 'public';
        }

        $parts = explode('/', $route);

        return strtolower($parts[0] ?? '');
    }

    private function disableAdminPageCache()
    {
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Pragma: no-cache');
        header('Expires: 0');
    }

    private function redirectTo($route)
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            ? 'https'
            : 'http';

        $baseUrl = $protocol
            . '://'
            . $_SERVER['HTTP_HOST']
            . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

        header('Location: ' . $baseUrl . '/index.php?url=' . ltrim($route, '/'));
        exit;
    }
}