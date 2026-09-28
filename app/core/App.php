<?php

class App
{
    protected $controller = 'PublicController';
    protected $method = 'home';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // ---> TAMBAHKAN KODE INI DI BAGIAN PALING ATAS <---
        // Jika user mengetik ?url=public saja, alihkan secara otomatis ke ?url=public/home
        if (isset($url[0]) && strtolower($url[0]) === 'public' && count($url) === 1) {
            $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
            $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            
            header('Location: ' . $base_url . '/index.php?url=public/home');
            exit;
        }
        // --------------------------------------------------

        // 1. TENTUKAN CONTROLLER
        if (isset($url[0])) {
            $area = strtolower($url[0]);
            
            if ($area === 'admin') {
                $this->controller = 'AdminController';
                $this->method = 'login'; 
            } elseif ($area === 'public') {
                $this->controller = 'PublicController';
                $this->method = 'home'; 
            }
            unset($url[0]);
        }

        // Panggil Controller
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;


        // 2. TENTUKAN METHOD / FUNGSI
        if (isset($url[1])) {
            $methodName = lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $url[1]))));

            if (method_exists($this->controller, $methodName)) {
                $this->method = $methodName;
                unset($url[1]); 
            }
        }


        // 3. TENTUKAN PARAMETER
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // 4. JALANKAN
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
}