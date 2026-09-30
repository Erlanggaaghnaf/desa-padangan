<?php
class AuthController extends Controller {
    public function login() {
        $data['error'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $defaultUser = 'admin';
            $defaultPass = 'desa123';

            if ($username === $defaultUser && $password === $defaultPass) {
                $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
                $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
                
                header('Location: ' . $base_url . '/index.php?url=admin/dashboard');
                exit;
            }

            $data['error'] = 'Username atau password salah!';
        }

        $this->view('admin/login', $data);
    }
}