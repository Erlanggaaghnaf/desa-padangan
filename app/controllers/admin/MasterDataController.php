<?php
class MasterDataController extends Controller {
    
    public function index() {
        $data['title'] = 'Master Data';
        
        // Panggil model untuk ambil data existing
        $model = $this->model('DataDesaModel');
        $data['desa'] = $model->getSemuaDataDesa();

        $this->view('admin/master_data', $data);
    }

    // Endpoint untuk simpan data kependudukan via AJAX
    public function simpanKependudukan() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            $laki = (int)($input['laki_laki'] ?? 0);
            $perempuan = (int)($input['perempuan'] ?? 0);
            $kk = (int)($input['kepala_keluarga'] ?? 0); // Tambahkan penangkapan variabel KK dari JSON

            $model = $this->model('DataDesaModel');
            // Sertakan variabel $kk ke dalam pemanggilan method model
            if ($model->updateKependudukan($laki, $perempuan, $kk)) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error']);
            }
        }
    }

    // Endpoint untuk simpan data kategori dinamis (Umur, Pekerjaan, dll) via AJAX
    public function simpanKategori() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            $kategori = $input['kategori'] ?? '';
            $items = $input['items'] ?? [];
            
            $model = $this->model('DataDesaModel');
            $sukses = false;

            if ($kategori === 'umur') {
                $sukses = $model->updateDataKategori('desa_umur', 'rentang', $items);
            } elseif ($kategori === 'pekerjaan') {
                $sukses = $model->updateDataKategori('desa_pekerjaan', 'kategori', $items);
            } elseif ($kategori === 'pendidikan') {
                $sukses = $model->updateDataKategori('desa_pendidikan', 'tingkat', $items);
            } elseif ($kategori === 'perkawinan') {
                $sukses = $model->updateDataKategori('desa_perkawinan', 'status', $items);
            } elseif ($kategori === 'agama') {
                $sukses = $model->updateDataKategori('desa_agama', 'agama', $items);
            }

            if ($sukses) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error']);
            }
        }
    }

    // Endpoint untuk mengambil data PPID (jika dibutuhkan via AJAX)
    public function getDokumenPpid() {
        $model = $this->model('PpidModel');
        $data = $model->getAllDokumen();
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    // Endpoint untuk menyimpan dokumen PPID baru beserta file PDF
    public function simpanDokumen() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $judul = $_POST['judul'] ?? '';
            $deskripsi = $_POST['deskripsi'] ?? '';
            $tahun = $_POST['tahun'] ?? '';
            
            // Tangkap file upload
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['file']['tmp_name'];
                $fileName = $_FILES['file']['name'];
                
                // Validasi ekstensi harus PDF
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                if ($fileExtension !== 'pdf') {
                    echo json_encode(['status' => 'error', 'message' => 'Format file harus PDF!']);
                    return;
                }

                $newFileName = md5(time() . $fileName) . '.pdf';
                $uploadFileDir = '../public/uploads/ppid/';
                
                // Pastikan folder tujuan ada
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }

                $destPath = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $model = $this->model('PpidModel');
                    $berhasil = $model->tambahDokumen($judul, $deskripsi, $tahun, $newFileName);

                    if ($berhasil) {
                        echo json_encode(['status' => 'success']);
                        return;
                    }
                }
            }
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengunggah file atau format bukan PDF.']);
        }
    } 

    // Endpoint untuk menghapus dokumen PPID
    public function hapusDokumen() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            $id = $input['id'] ?? 0;

            $model = $this->model('PpidModel');
            if ($model->hapusDokumen($id)) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error']);
            }
        }
    }

    public function updateDokumen() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? 0;
            $judul = $_POST['judul'] ?? '';
            $deskripsi = $_POST['deskripsi'] ?? '';
            $tahun = $_POST['tahun'] ?? '';
            
            $namaFileBaru = null;
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['file']['tmp_name'];
                $fileName = $_FILES['file']['name'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if ($fileExtension === 'pdf') {
                    $namaFileBaru = md5(time() . $fileName) . '.pdf';
                    $uploadFileDir = '../public/uploads/ppid/';
                    if (!is_dir($uploadFileDir)) { mkdir($uploadFileDir, 0755, true); }
                    move_uploaded_file($fileTmpPath, $uploadFileDir . $namaFileBaru);
                }
            }

            $model = $this->model('PpidModel');
            if ($model->editDokumen($id, $judul, $deskripsi, $tahun, $namaFileBaru)) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui dokumen.']);
            }
        }
    }
}