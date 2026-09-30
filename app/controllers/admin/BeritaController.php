<?php
class BeritaController extends Controller {
    public function index() {
        $data['title'] = 'Manajemen Berita';
        $this->view('admin/berita', $data);
    }
}