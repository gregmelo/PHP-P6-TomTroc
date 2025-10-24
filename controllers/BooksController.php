<?php

require_once __DIR__ . '/../config/_config.php'; // Configuration
require_once __DIR__ . '/../config/Database.php'; // Database singleton
require_once __DIR__ . '/../models/BooksModel.php'; // Modèle

/**
 * Contrôleur de gestion des livres
 * Gère l'affichage, la modification, la suppression et la recherche des livres
 */
class BooksController
{
    /**
     * Affiche la liste des livres
     * Si un terme de recherche est présent, filtre par titre
     */
    public function books_list()
    {
    $pdo = Database::getInstance();
    $booksModel = new BooksModel($pdo);
        // Gestion de la recherche par titre
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        if ($search !== '') {
            $books = $booksModel->searchBooksByTitle($search);
        } else {
            $books = $booksModel->getAllBooks();
        }
        // Passage à la vue
        ob_start();
        // $books sera disponible dans la vue
        require __DIR__ . '/../views/books.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

    /**
     * Affiche les détails d'un livre selon son id
     */
    public function book_details()
    {
    $pdo = Database::getInstance();
    $booksModel = new BooksModel($pdo);
        $bookId = isset($_GET['id']) ? intval($_GET['id']) : 0; // Récupère l'id du livre
        $book = $booksModel->getBookById($bookId);
        // Passage à la vue
        ob_start();
        // $book sera disponible dans la vue
        require __DIR__ . '/../views/book_details.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

    /**
     * Affiche le formulaire d'édition d'un livre
     */
    public function book_edit()
    {
    $pdo = Database::getInstance();
    $booksModel = new BooksModel($pdo);
        $bookId = isset($_GET['id']) ? intval($_GET['id']) : 0; // Id du livre à éditer
        $book = $booksModel->getBookById($bookId);

        ob_start();
        require __DIR__ . '/../views/book_edit.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

    /**
     * Met à jour les informations d'un livre
     */
    public function book_update()
    {
    $pdo = Database::getInstance();
    $booksModel = new BooksModel($pdo);
        $bookId = isset($_GET['id']) ? intval($_GET['id']) : 0;

        // Récupération des données du formulaire
        $title = trim($_POST['title']);
        $author = trim($_POST['author']);
        $description = trim($_POST['commentaire']);
        $status = $_POST['status'];

        // Gestion de la photo
        $cover = null;
        if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['cover']['tmp_name'];
            $fileName = uniqid() . '_' . basename($_FILES['cover']['name']);
            $destination = 'assets/books/' . $fileName;
            move_uploaded_file($tmpName, $destination);
            $cover = $destination;
        }

        // Met à jour le livre dans la base
        $booksModel->updateBook($bookId, $title, $author, $description, $status, $cover);

        // Redirection vers la page d'édition
        header('Location: index.php?page=book_edit&id=' . $bookId);
        exit;
    }

    /**
     * Supprime un livre selon son id
     */
    public function book_delete()
    {
    $pdo = Database::getInstance();
    $booksModel = new BooksModel($pdo);
        $bookId = isset($_GET['id']) ? intval($_GET['id']) : 0; // Id du livre à supprimer
        $booksModel->bookDelete($bookId);
        // Redirection vers le compte utilisateur
        header('Location: index.php?page=account');
        exit;
    }
}
