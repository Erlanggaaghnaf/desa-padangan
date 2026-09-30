<?php

class BeritaController extends Controller
{
    /**
     * Helper privat untuk mencatat kunjungan dan mengambil datanya
     */
    private function recordAndGetVisitor()
    {
        $visitorModel = $this->model('VisitorModel');
        $visitorModel->recordVisitor();
        return $visitorModel->getVisitorStats();
    }

    private function getPublicBaseUrl()
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        return $protocol . '://' . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    }

    /**
     * Halaman daftar berita publik dengan paginasi
     */
    public function index()
    {
        $data['visitor_stats'] = $this->recordAndGetVisitor();
        $data['base_url'] = $this->getPublicBaseUrl();

        $beritaModel = $this->model('BeritaModel');
        $totalBerita = $beritaModel->getCount();

        $requestedPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $requestedPage = max(1, $requestedPage);

        $perPage = 12;
        $totalPages = max(1, (int) ceil($totalBerita / $perPage));
        $currentPage = min($requestedPage, $totalPages);
        $offset = ($currentPage - 1) * $perPage;

        $data['berita'] = $beritaModel->getPaginated($perPage, $offset);
        $data['berita_total'] = $totalBerita;
        $data['berita_current_page'] = $currentPage;
        $data['berita_total_pages'] = $totalPages;

        $this->view('layouts/header', $data);
        $this->view('public/berita', $data);
        $this->view('layouts/footer', $data);
    }

    /**
     * Halaman detail berita lengkap dengan penambahan jumlah views
     */
    public function detailBerita($id = 0)
    {
        $data['visitor_stats'] = $this->recordAndGetVisitor();
        $data['base_url'] = $this->getPublicBaseUrl();

        $id = (int) $id;

        if ($id <= 0) {
            header('Location: ' . $this->getPublicBaseUrl() . '/index.php?url=public/BeritaController/index');
            exit;
        }

        $beritaModel = $this->model('BeritaModel');
        $berita = $beritaModel->getById($id);

        if (!$berita) {
            http_response_code(404);

            $data['berita'] = null;
            $data['berita_lainnya'] = [];

            $this->view('layouts/header', $data);
            $this->view('public/detail_berita', $data);
            $this->view('layouts/footer', $data);

            return;
        }

        // Tambah jumlah views setiap kali detail berita dibuka
        $beritaModel->incrementViews($id);

        // Ambil ulang data setelah views bertambah
        $berita = $beritaModel->getById($id);

        $data['berita'] = $berita;
        $data['berita_lainnya'] = $beritaModel->getLatestExcept($id, 3);

        $this->view('layouts/header', $data);
        $this->view('public/detail_berita', $data);
        $this->view('layouts/footer', $data);
    }
}