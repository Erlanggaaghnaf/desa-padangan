<?php

class DataDesa extends Controller {
    public function index() {
        // Memanggil file view 'data_desa.php' yang berada di dalam folder app/views/public/
        $this->view('public/data_desa');
    }
}