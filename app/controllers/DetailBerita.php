<?php

class DetailBerita extends Controller {
    
    // Karena ini controller terpisah, kita cukup gunakan method index (default)
    public function index() {
        $this->view('public/detail_berita');
    }
}