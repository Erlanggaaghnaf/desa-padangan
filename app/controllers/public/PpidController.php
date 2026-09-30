<?php
class PpidController extends Controller {
    private function recordAndGetVisitor() {
        $visitorModel = $this->model('VisitorModel');
        $visitorModel->recordVisitor();
        return $visitorModel->getVisitorStats();
    }

    public function index() {
        $data['visitor_stats'] = $this->recordAndGetVisitor();
        
        // Panggil PpidModel untuk mengambil semua dokumen PPID dari database
        $ppidModel = $this->model('PpidModel');
        $data['dokumen'] = $ppidModel->getAllDokumen();

        // Di dalam struktur MVC Anda, view header, ppid, dan footer dipanggil terpisah
        $this->view('layouts/header', $data);
        $this->view('public/ppid', $data);
        $this->view('layouts/footer', $data);
    }
}