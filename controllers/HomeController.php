<?php

require_once __DIR__ . '/../config/_config.php'; // Configuration

/**
 * Contrôleur de la page d'accueil
 * Affiche les derniers livres ajoutés
 */
class HomeController
{
    /**
     * Affiche la page d'accueil avec les 4 derniers livres
     */
    public function index()
    {
    $booksModel = new BooksModel();
    $lastBooks = $booksModel->getLastBooks(4); // Récupère les 4 derniers livres (objets)

        ob_start();
        // $lastBooks sera disponible dans la vue
        require __DIR__ . '/../views/home.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }
}
