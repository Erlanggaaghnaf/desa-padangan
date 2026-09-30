<?php
class DashboardController extends Controller {
    public function index() {
        $data['title'] = 'Dashboard Administrator';

        $pengaduanModel = $this->model('PengaduanModel');
        $data['statistik'] = $pengaduanModel->getStatistikPengaduan();

        $visitorModel = $this->model('VisitorModel');
        $data['visitor_stats'] = $visitorModel->getVisitorStats();

        $semester = isset($_GET['semester']) ? (int)$_GET['semester'] : 2;
        $data['selected_semester'] = $semester;

        $monthlyData = $visitorModel->getMonthlyStats(2026, $semester);
        $data['chart_labels'] = ($semester == 1) ? ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'] : ['Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $data['chart_data'] = $monthlyData;

        $this->view('admin/dashboard', $data);
    }
}