<?php
class BooksController {
    public function books_list() {
    require_once __DIR__ . '/../config/_config.php';
    require_once __DIR__ . '/../models/BooksModel.php';
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $booksModel = new BooksModel($pdo);
    $books = $booksModel->getAllBooks();
    // Passage à la vue
    ob_start();
    // $books sera disponible dans la vue
    require __DIR__ . '/../views/books.php';
    $content = ob_get_clean();
    require_once __DIR__ . '/../views/main.php';
    }

    public function book_details() { //ajouter l'id lors de l'ajout du php
    require_once __DIR__ . '/../config/_config.php';
    require_once __DIR__ . '/../models/BooksModel.php';
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $booksModel = new BooksModel($pdo);
    $bookId = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $book = $booksModel->getBookById($bookId);
    // Passage à la vue
    ob_start();
    // $book sera disponible dans la vue
    require __DIR__ . '/../views/book_details.php';
    $content = ob_get_clean();
    require_once __DIR__ . '/../views/main.php';
    }

    public function book_edit() {
        ob_start();
        require_once __DIR__ . '/../views/book_edit.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }
}