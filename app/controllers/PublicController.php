<?php


class PublicController extends Controller
{
    public function home()
    {
        $this->view('layouts/header');
        $this->view('public/home');
        $this->view('layouts/footer');
    }

    public function informasi()
    {
        $this->view('public/informasi');
    }

    public function layanan()
    {
        $this->view('public/layanan');
    }

    public function dataDesa()
    {
        $this->view('public/data_desa');
    }

    public function berita()
    {
        $this->view('public/berita');
    }

    public function galeri()
    {
        $this->view('public/galeri');
    }

    public function ppid()
    {
        $this->view('public/ppid');
    }

    public function pengaduan()
    {
        $this->view('public/pengaduan');
    }

    // Fungsi untuk memproses data yang dikirim dari form pengaduan
    public function storePengaduan()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // 1. Tangkap dan bersihkan data teks dari form
            $data = [
                'nama'     => htmlspecialchars($_POST['nama']),
                'kontak'   => htmlspecialchars($_POST['kontak']),
                'kategori' => htmlspecialchars($_POST['kategori']),
                'judul'    => htmlspecialchars($_POST['judul']),
                'isi'      => htmlspecialchars($_POST['isi']),
                'lokasi'   => htmlspecialchars($_POST['lokasi'])
            ];

            $nama_file_foto = null; 

            // 2. Proses Upload File Foto (jika ada)
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
                $file_tmp  = $_FILES['foto']['tmp_name'];
                $nama_file  = str_replace(" ", "_", $_FILES['foto']['name']);
                $nama_file_foto = time() . '_' . $nama_file;
                
                // Sesuaikan path folder tujuan penyimpanan foto
                $folder_tujuan = '../public/uploads/pengaduan/';
                if (!file_exists($folder_tujuan)) {
                    mkdir($folder_tujuan, 0777, true);
                }
                
                move_uploaded_file($file_tmp, $folder_tujuan . $nama_file_foto);
            }

            $pengaduanModel = $this->model('PengaduanModel'); 
            $sukses = $pengaduanModel->tambahPengaduan($data, $nama_file_foto);

            // 4. Pengalihan Halaman Kembali ke Halaman Asal (Asal Klik)
            if ($sukses) {
                // Mendefinisikan base_url secara lokal agar tidak error
                $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
                $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

                // Mengambil URL halaman sebelumnya secara otomatis, jika kosong arahkan ke home
                $redirect_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $base_url . '/index.php?url=public/home';
                
                header('Location: ' . $redirect_url);
                exit();
            } else {
                echo "<script>alert('Gagal menyimpan pengaduan!'); window.history.back();</script>";
            }
        }
    }
}