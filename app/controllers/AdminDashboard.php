<?php

class AdminDashboard extends Controller {
    public function index() {
        // Data sementara untuk statistik dashboard
        $data['title'] = 'Dashboard Administrator';
        
        // Memanggil view khusus dashboard admin
        $this->view('admin/dashboard', $data);
    }
}