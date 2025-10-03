<?php
class HomeController {
    public function index() {
        require_once __DIR__ . '/../config/_config.php';
        require_once __DIR__ . '/../models/BooksModel.php';
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $booksModel = new BooksModel($pdo);
        $lastBooks = $booksModel->getLastBooks(4);
        
        ob_start();
        // $lastBooks sera disponible dans la vue
        require __DIR__ . '/../views/home.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }
}
