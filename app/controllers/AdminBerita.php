<?php

class AdminBerita extends Controller {
    
    public function index() {
        $data['title'] = 'Manajemen Berita - Administrator Desa Padangan';
        $this->view('admin/berita', $data);
    }

}