<?php

class App {
    protected $controller = 'public/HomeController'; // Default public
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();
        $isAdmin = false;

        // 1. Cek apakah mengakses modul Admin
        if (isset($url[0]) && strtolower($url[0]) == 'admin') {
            $isAdmin = true;
            unset($url[0]); // Hapus segmen 'admin'
            
            // Konversi URL bergaris datar (master-data) menjadi CamelCase (MasterData)
            $rawControllerName = isset($url[1]) ? str_replace(' ', '', ucwords(str_replace('-', ' ', $url[1]))) : 'Dashboard';
            $controllerName = $rawControllerName . 'Controller';
            $file = '../app/controllers/admin/' . $controllerName . '.php';

            if (file_exists($file)) {
                $this->controller = 'admin/' . $controllerName;
                unset($url[1]);
            } else {
                $this->controller = 'admin/DashboardController'; // Fallback
            }
        } 
        // 2. Modul Public / Pengunjung
        else {
            // Konversi URL bergaris datar (data-desa) menjadi CamelCase (DataDesa)
            $rawControllerName = isset($url[0]) && !empty($url[0]) ? str_replace(' ', '', ucwords(str_replace('-', ' ', $url[0]))) : 'Home';
            $controllerName = $rawControllerName . 'Controller';
            $file = '../app/controllers/public/' . $controllerName . '.php';

            if (file_exists($file)) {
                $this->controller = 'public/' . $controllerName;
                unset($url[0]);
            } else {
                $this->controller = 'public/HomeController'; // Fallback
            }
        }

        // Load File Controller
        require_once '../app/controllers/' . $this->controller . '.php';
        $className = basename($this->controller);
        $this->controller = new $className;

        // 3. Cek Method (Bug fixed!)
        // Jika admin, method ada di index ke-2. Jika public, method ada di index ke-1
        $methodIndex = $isAdmin ? 2 : 1;
        
        if (isset($url[$methodIndex])) {
            $methodName = str_replace('-', '_', $url[$methodIndex]); // ubah dash jadi underscore untuk nama function
            if (method_exists($this->controller, $methodName)) {
                $this->method = $methodName;
                unset($url[$methodIndex]);
            }
        }

        // 4. Ambil Parameter sisanya
        $this->params = $url ? array_values($url) : [];

        // Jalankan Controller & Method
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}