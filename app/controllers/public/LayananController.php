<?php
class LayananController extends Controller {
    private function recordAndGetVisitor() {
        $visitorModel = $this->model('VisitorModel');
        $visitorModel->recordVisitor();
        return $visitorModel->getVisitorStats();
    }

    public function index() {
        $data['visitor_stats'] = $this->recordAndGetVisitor();

        $this->view('layouts/header', $data);
        $this->view('public/layanan', $data);
        $this->view('layouts/footer', $data);
    }
}