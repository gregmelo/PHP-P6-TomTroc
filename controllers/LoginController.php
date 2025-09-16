<?php
class LoginController {
    public function login() {
        ob_start();
        require_once __DIR__ . '/../views/login.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

        public function register() {
        ob_start();
        require_once __DIR__ . '/../views/register.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }
}