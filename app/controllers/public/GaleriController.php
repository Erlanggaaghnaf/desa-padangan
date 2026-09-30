<?php

class GaleriController extends Controller
{
    private function recordAndGetVisitor()
    {
        $visitorModel = $this->model('VisitorModel');
        $visitorModel->recordVisitor();
        return $visitorModel->getVisitorStats();
    }

    private function getPublicBaseUrl()
    {
        $protocol =
            (!empty($_SERVER['HTTPS']) &&
            $_SERVER['HTTPS'] !== 'off')
                ? 'https'
                : 'http';

        return $protocol .
            '://' .
            $_SERVER['HTTP_HOST'] .
            rtrim(
                dirname($_SERVER['SCRIPT_NAME']),
                '/\\'
            );
    }

    public function index()
    {
        $data['visitor_stats'] = $this->recordAndGetVisitor();
        $data['base_url'] = $this->getPublicBaseUrl();

        $galeriModel = $this->model('GaleriModel');

        $totalFoto = $galeriModel->getCount();

        $requestedPage = isset($_GET['page'])
            ? (int) $_GET['page']
            : 1;

        $requestedPage = max(1, $requestedPage);

        $perPage = 12;

        $totalPages = max(
            1,
            (int) ceil(
                $totalFoto /
                $perPage
            )
        );

        $currentPage = min(
            $requestedPage,
            $totalPages
        );

        $offset = ($currentPage - 1) * $perPage;

        $data['galeri'] = $galeriModel->getPaginated(
            $perPage,
            $offset
        );

        $data['galeri_total'] = $totalFoto;
        $data['galeri_current_page'] = $currentPage;
        $data['galeri_total_pages'] = $totalPages;

        $this->view('layouts/header', $data);
        $this->view('public/galeri', $data);
        $this->view('layouts/footer', $data);
    }
}