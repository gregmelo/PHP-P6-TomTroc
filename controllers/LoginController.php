
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

    /**
     * Retourne la liste des utilisateurs (id, pseudo, email)
     */
    public function getAllUsers()
    {
        require_once __DIR__ . '/../config/_config.php';
        try {
            $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->query("SELECT id, pseudo, email FROM users");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
}
