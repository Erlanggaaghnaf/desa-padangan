<?php

class Controller 
{
    public function view($view, $data = []) 
    {
        if (file_exists('../app/views/' . $view . '.php')) {
            extract($data); 
            require_once '../app/views/' . $view . '.php';
        } else {
            die("View tidak ditemukan: " . $view);
        }
    }

    // TAMBAHKAN FUNGSI INI DI CONTROLLER.PHP
    public function model($model) 
    {
        if (file_exists('../app/models/' . $model . '.php')) {
            require_once '../app/models/' . $model . '.php';
            return new $model;
        } else {
            die("Model tidak ditemukan: " . $model);
        }
    }
}