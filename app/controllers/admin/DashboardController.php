<?php
class DashboardController extends Controller {
    public function index() {
        $data['title'] = 'Dashboard Administrator';

        $pengaduanModel = $this->model('PengaduanModel');
        $data['statistik'] = $pengaduanModel->getStatistikPengaduan();

        $visitorModel = $this->model('VisitorModel');
        $data['visitor_stats'] = $visitorModel->getVisitorStats();

        // Tentukan tahun dan semester berdasarkan tanggal saat ini
        $currentYear = (int) date('Y');
        $currentMonth = (int) date('n');
        $currentSemester = ($currentMonth <= 6) ? 1 : 2;

        // Gunakan semester dari URL jika tersedia dan valid.
        // Jika tidak ada, gunakan semester yang sedang berjalan.
        $requestedSemester = isset($_GET['semester']) ? (int) $_GET['semester'] : $currentSemester;
        $semester = in_array($requestedSemester, [1, 2], true)
            ? $requestedSemester
            : $currentSemester;

        $data['current_year'] = $currentYear;
        $data['selected_semester'] = $semester;

        $monthlyData = $visitorModel->getMonthlyStats($currentYear, $semester);
        $data['chart_labels'] = ($semester == 1)
            ? ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun']
            : ['Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $data['chart_data'] = $monthlyData;

        $this->view('admin/dashboard', $data);
    }
}