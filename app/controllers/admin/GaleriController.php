<?php
class GaleriController extends Controller {
    public function index() {
        $data['title'] = 'Manajemen Galeri';
        $this->view('admin/galeri', $data);
    }
}