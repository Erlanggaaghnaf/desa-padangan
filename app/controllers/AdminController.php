<?php

class AdminController extends Controller
{
    /**
     * Login administrator
     */
    public function login()
    {
        $data['error'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // LOGIN SEMENTARA
            // Nanti akan diganti dengan database + password_hash()
            $defaultUser = 'admin';
            $defaultPass = 'desa123';

            if (
                $username === $defaultUser &&
                $password === $defaultPass
            ) {
                // Mendeteksi Base URL secara dinamis untuk mengatasi masalah path di XAMPP/Hosting
                $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
                $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
                
                // Redirect menggunakan Base URL
                header('Location: ' . $base_url . '/index.php?url=admin/dashboard');
                exit;
            }

            $data['error'] = 'Username atau password salah!';
        }

        $this->view('admin/login', $data);
    }

    /**
     * Dashboard administrator
     */
    public function dashboard()
    {
        $data['title'] = 'Dashboard Administrator';

        $this->view('admin/dashboard', $data);
    }

    /**
     * Manajemen layanan desa
     */
    public function layanan()
    {
        $data['title'] = 'Manajemen Layanan Desa';

        $this->view('admin/layanan', $data);
    }

    /**
     * Manajemen pengaduan
     */
    public function pengaduan()
    {
        $data['title'] = 'Manajemen Pengaduan';

        $this->view('admin/pengaduan', $data);
    }

    /**
     * Manajemen galeri
     */
    public function galeri()
    {
        $data['title'] = 'Manajemen Galeri';

        $this->view('admin/galeri', $data);
    }

    /**
     * Manajemen berita
     */
    public function berita()
    {
        $data['title'] = 'Manajemen Berita';

        $this->view('admin/berita', $data);
    }

    /**
     * Master data
     */
    public function masterData()
    {
        $data['title'] = 'Master Data';

        // Pastikan nama file view-nya menggunakan underscore (master_data.php) atau sesuaikan dengan keinginan Anda
        $this->view('admin/master_data', $data); 
    }
}