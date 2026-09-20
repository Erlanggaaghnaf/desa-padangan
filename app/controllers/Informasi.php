<?php
class Informasi extends Controller {
    public function index() {
        // Harus mengarah ke 'public/informasi', BUKAN 'public/home'
        $this->view('public/informasi');
    }
}