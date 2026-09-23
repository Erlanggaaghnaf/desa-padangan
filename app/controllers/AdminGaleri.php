<?php

class AdminGaleri extends Controller {
    
    public function index() {
        // Data yang dikirimkan ke view (seperti judul halaman)
        $data['title'] = 'Manajemen Galeri - Administrator Desa Padangan';
        
        // Memanggil file view app/views/admin/galeri.php
        $this->view('admin/galeri', $data);
    }

}