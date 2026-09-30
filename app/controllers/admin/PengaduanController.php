<?php
class PengaduanController extends Controller {
    public function index() {
        $data['title'] = 'Manajemen Pengaduan';
        $this->view('admin/pengaduan', $data);
    }
}