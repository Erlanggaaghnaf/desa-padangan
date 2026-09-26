<?php

class AdminMasterData extends Controller {
    
    public function index() {
        $data['judul'] = 'Master Data';

        $this->view('admin/master_data', $data);
    }
}