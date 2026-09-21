<?php
class Berita extends Controller {
    
    // Ini untuk menampilkan daftar semua berita
    public function index() {
        $this->view('public/berita');
    }

}