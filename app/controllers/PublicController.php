<?php

class PublicController extends Controller
{
    /**
     * Helper privat untuk mencatat kunjungan dan mengambil datanya agar bisa digunakan di semua halaman publik
     */
    private function recordAndGetVisitor()
    {
        $visitorModel = $this->model('VisitorModel');
        $visitorModel->recordVisitor();
        return $visitorModel->getVisitorStats();
    }

    public function home()
    {
        $data['visitor_stats'] = $this->recordAndGetVisitor();

        $this->view('layouts/header', $data);
        $this->view('public/home', $data);
        $this->view('layouts/footer', $data);
    }

    public function informasi()
    {
        $data['visitor_stats'] = $this->recordAndGetVisitor();

        $this->view('layouts/header', $data);
        $this->view('public/informasi', $data);
        $this->view('layouts/footer', $data);
    }

    public function layanan()
    {
        $data['visitor_stats'] = $this->recordAndGetVisitor();

        $this->view('layouts/header', $data);
        $this->view('public/layanan', $data);
        $this->view('layouts/footer', $data);
    }

    public function dataDesa()
    {
        $data['visitor_stats'] = $this->recordAndGetVisitor();

        $this->view('layouts/header', $data);
        $this->view('public/data_desa', $data);
        $this->view('layouts/footer', $data);
    }

    public function berita()
    {
        $data['visitor_stats'] = $this->recordAndGetVisitor();

        $this->view('layouts/header', $data);
        $this->view('public/berita', $data);
        $this->view('layouts/footer', $data);
    }

    public function galeri()
    {
        $data['visitor_stats'] = $this->recordAndGetVisitor();

        $this->view('layouts/header', $data);
        $this->view('public/galeri', $data);
        $this->view('layouts/footer', $data);
    }

    public function ppid()
    {
        $data['visitor_stats'] = $this->recordAndGetVisitor();

        $this->view('layouts/header', $data);
        $this->view('public/ppid', $data);
        $this->view('layouts/footer', $data);
    }

    public function pengaduan()
    {
        $data['visitor_stats'] = $this->recordAndGetVisitor();

        $this->view('layouts/header', $data);
        $this->view('public/pengaduan', $data);
        $this->view('layouts/footer', $data);
    }

    // Fungsi untuk memproses data yang dikirim dari form pengaduan
    public function storePengaduan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // 1. Tangkap data teks sesuai kolom yang diminta
            $data = [
                'nama'   => htmlspecialchars($_POST['nama']),
                'kontak' => htmlspecialchars($_POST['kontak']),
                'judul'  => htmlspecialchars($_POST['judul']),
                'isi'    => htmlspecialchars($_POST['isi'])
            ];

            $uploaded_fotos = [];

            // 2. Proses Multi-Upload File Foto (Maksimal 3 foto)
            if (isset($_FILES['foto'])) {
                $folder_tujuan = '../public/uploads/pengaduan/';
                if (!file_exists($folder_tujuan)) {
                    mkdir($folder_tujuan, 0777, true);
                }

                // Loop file yang di-upload
                foreach ($_FILES['foto']['tmp_name'] as $key => $tmp_name) {
                    if ($_FILES['foto']['error'][$key] == 0 && count($uploaded_fotos) < 3) {
                        $file_name = $_FILES['foto']['name'][$key];
                        $file_name_clean = str_replace(" ", "_", $file_name);
                        $nama_file_final = time() . '_' . uniqid() . '_' . $file_name_clean;
                        
                        if (move_uploaded_file($tmp_name, $folder_tujuan . $nama_file_final)) {
                            $uploaded_fotos[] = $nama_file_final;
                        }
                    }
                }
            }

            // Gabungkan nama foto menjadi satu string dipisahkan koma (contoh: foto1.jpg,foto2.jpg)
            $string_nama_foto = !empty($uploaded_fotos) ? implode(',', $uploaded_fotos) : null;

            // 3. Panggil Model
            $pengaduanModel = $this->model('PengaduanModel');
            $sukses = $pengaduanModel->tambahPengaduan($data, $string_nama_foto);

            // 4. Redirect kembali ke halaman asal
            $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
            $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

            $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $base_url . '/index.php?url=public/home';
            
            if ($sukses) {
                header('Location: ' . $redirect_url);
                exit();
            } else {
                echo "<script>alert('Gagal mengirim pengaduan!'); window.history.back();</script>";
            }
        }
    }
}