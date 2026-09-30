<?php
class PengaduanController extends Controller {
    private function recordAndGetVisitor() {
        $visitorModel = $this->model('VisitorModel');
        $visitorModel->recordVisitor();
        return $visitorModel->getVisitorStats();
    }

    public function index() {
        $data['visitor_stats'] = $this->recordAndGetVisitor();

        $this->view('layouts/header', $data);
        $this->view('public/pengaduan', $data);
        $this->view('layouts/footer', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nama'   => htmlspecialchars($_POST['nama']),
                'kontak' => htmlspecialchars($_POST['kontak']),
                'judul'  => htmlspecialchars($_POST['judul']),
                'isi'    => htmlspecialchars($_POST['isi'])
            ];

            $uploaded_fotos = [];

            if (isset($_FILES['foto'])) {
                $folder_tujuan = '../public/uploads/pengaduan/';
                if (!file_exists($folder_tujuan)) {
                    mkdir($folder_tujuan, 0777, true);
                }

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

            $string_nama_foto = !empty($uploaded_fotos) ? implode(',', $uploaded_fotos) : null;

            $pengaduanModel = $this->model('PengaduanModel');
            $sukses = $pengaduanModel->tambahPengaduan($data, $string_nama_foto);

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