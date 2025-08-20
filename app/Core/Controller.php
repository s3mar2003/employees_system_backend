<?php
namespace App\Core;

class Controller {
    protected function view($view, $data = []) {
        extract($data);
        
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            http_response_code(404);
            echo "View file not found: " . $view;
        }
    }
    
    protected function redirect($url) {
        header("Location: $url");
        exit;
    }
    
    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}