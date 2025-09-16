<?php
class HomeController {
    public function index() {
        ob_start();
        require_once __DIR__ . '/../views/home.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }
}
