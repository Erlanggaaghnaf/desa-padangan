<?php

class AdminLayanan extends Controller {
    public function index() {
        $data['title'] = 'Manajemen Layanan Desa';
        
        // Memanggil view utama manajemen layanan
        $this->view('admin/layanan', $data);
    }
}