<?php
class LoginController
{
    public function login()
    {
        ob_start();
        require_once __DIR__ . '/../views/login.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

    public function register()
    {
        ob_start();
        require_once __DIR__ . '/../views/register.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

    public function account()
    {
        ob_start();
        require_once __DIR__ . '/../views/account.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

    public function public_account()
    {
        ob_start();
        require_once __DIR__ . '/../views/public_account.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }
}
