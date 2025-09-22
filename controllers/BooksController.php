<?php
class BooksController {
    public function books_list() {
        ob_start();
        require_once __DIR__ . '/../views/books.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

    public function book_details() { //ajouter l'id lors de l'ajout du php
        ob_start();
        require_once __DIR__ . '/../views/book_details.php';
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