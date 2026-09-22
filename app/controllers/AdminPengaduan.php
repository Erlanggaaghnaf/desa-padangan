<?php

class AdminPengaduan extends Controller {
    public function index() {
        $data['title'] = 'Manajemen Pengaduan';
        
        // Memanggil view khusus manajemen pengaduan admin
        $this->view('admin/pengaduan', $data);
    }
}