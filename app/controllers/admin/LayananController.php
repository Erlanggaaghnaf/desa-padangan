<?php
class LayananController extends Controller {
    public function index() {
        $data['title'] = 'Manajemen Layanan Desa';
        $this->view('admin/layanan', $data);
    }
}