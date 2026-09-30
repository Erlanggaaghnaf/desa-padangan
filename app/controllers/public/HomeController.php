<?php
class HomeController extends Controller {
    private function recordAndGetVisitor() {
        $visitorModel = $this->model('VisitorModel');
        $visitorModel->recordVisitor();
        return $visitorModel->getVisitorStats();
    }

    public function index() {
        $data['visitor_stats'] = $this->recordAndGetVisitor();

        // Ambil berita terbaru (misal 4 berita)
        $beritaModel = $this->model('BeritaModel');
        $data['berita'] = $beritaModel->getLatest(4);

        // Ambil galeri terbaru (misal 4 foto)
        $galeriModel = $this->model('GaleriModel');
        $data['galeri'] = $galeriModel->getPaginated(4, 0);

        $this->view('layouts/header', $data);
        $this->view('public/home', $data);
        $this->view('layouts/footer', $data);
    }
}