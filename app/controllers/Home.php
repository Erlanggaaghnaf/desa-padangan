<?php
class Home extends Controller {
    public function index() {
        // Memanggil file dari dalam folder app/views/
        $this->view('layouts/header');
        $this->view('public/home');
        $this->view('layouts/footer');
    }
}