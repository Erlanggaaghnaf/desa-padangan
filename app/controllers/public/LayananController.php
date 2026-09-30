<?php

class LayananController extends Controller
{
    private function recordAndGetVisitor()
    {
        $visitorModel = $this->model('VisitorModel');
        $visitorModel->recordVisitor();
        return $visitorModel->getVisitorStats();
    }

    /**
     * Halaman layanan untuk pengunjung publik.
     */
    public function index()
    {
        $data['visitor_stats'] = $this->recordAndGetVisitor();

        $layananModel = $this->model('LayananModel');
        $data['layanan'] = $layananModel->getAllLayanan();

        $this->view('layouts/header', $data);
        $this->view('public/layanan', $data);
        $this->view('layouts/footer', $data);
    }
}