<?php

class AdminLogin extends Controller {
    public function index() {
        $data['error'] = '';

        // Cek apakah tombol form disubmit (metode POST)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // USERNAME & PASSWORD DEFAULT SEMENTARA
            $default_user = 'admin';
            $default_pass = 'desa123';

            if ($username === $default_user && $password === $default_pass) {
                // Jika login benar, sementara kita arahkan ke beranda atau buat session sukses
                // (Nanti bisa diubah ke dashboard admin jika halamannya sudah dibuat)
                header('Location: index.php?url=AdminDashboard');
                exit;
            } else {
                // Jika salah, kirim pesan error ke view
                $data['error'] = 'Username atau password salah!';
            }
        }

        // Tampilkan view login dengan membawa data error (jika ada)
        $this->view('admin/login', $data);
    }
}