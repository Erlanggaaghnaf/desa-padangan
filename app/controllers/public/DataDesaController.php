<?php
class DataDesaController extends Controller {
    private function recordAndGetVisitor() {
        $visitorModel = $this->model('VisitorModel');
        $visitorModel->recordVisitor();
        return $visitorModel->getVisitorStats();
    }

    public function index() {
        $data['visitor_stats'] = $this->recordAndGetVisitor();

        // Panggil model DataDesa untuk menarik seluruh data statistik dari database
        $model = $this->model('DataDesaModel');
        $data['desa'] = $model->getSemuaDataDesa();

        // Memuat view dengan membawa data desa
        $this->view('layouts/header', $data);
        $this->view('public/data_desa', $data);
        $this->view('layouts/footer', $data);
    }
}