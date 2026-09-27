<?php
// Memanggil class Database Anda
require_once __DIR__ . '/app/core/Database.php';

if (isset($_POST['kirim_pengaduan'])) {
    // Menangkap data dari form sesuai struktur tabel db_padangan.sql
    $nama     = htmlspecialchars($_POST['nama']);
    $kontak   = htmlspecialchars($_POST['kontak']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $judul    = htmlspecialchars($_POST['judul']);
    $isi      = htmlspecialchars($_POST['isi']);
    $lokasi   = htmlspecialchars($_POST['lokasi']);
    
    $nama_file_foto = null; 

    // Proses Upload File Foto jika ada
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $file_tmp   = $_FILES['foto']['tmp_name'];
        $nama_file  = str_replace(" ", "_", $_FILES['foto']['name']);
        $nama_file_foto = time() . '_' . $nama_file;
        
        // Path folder tujuan sesuai dengan struktur folder Anda
        $folder_tujuan = __DIR__ . '/public/uploads/pengaduan/';
        if (!file_exists($folder_tujuan)) {
            mkdir($folder_tujuan, 0777, true);
        }
        
        move_uploaded_file($file_tmp, $folder_tujuan . $nama_file_foto);
    }

    try {
        // Menggunakan koneksi dari core/Database.php
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "INSERT INTO pengaduan (nama, kontak, kategori, judul, isi, foto, lokasi) 
                VALUES (:nama, :kontak, :kategori, :judul, :isi, :foto, :lokasi)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nama'     => $nama,
            ':kontak'   => $kontak,
            ':kategori' => $kategori,
            ':judul'    => $judul,
            ':isi'      => $isi,
            ':foto'     => $nama_file_foto,
            ':lokasi'   => $lokasi
        ]);

        // Berhasil: Langsung kembali ke halaman utama tanpa alert
        header("Location: public/index.php");
        exit();

    } catch(PDOException $e) {
        // Jika gagal, kembali ke halaman sebelumnya
        echo "<script>
                alert('Gagal mengirim pengaduan: " . addslashes($e->getMessage()) . "'); 
                window.history.back();
              </script>";
    }
}
?>