<?php

/**
 * Vue : Liste des livres à l'échange
 * Affiche le formulaire de recherche et la liste des livres
 * Variables attendues :
 *   - $books : tableau des livres à afficher
 */
$title = "Page nos livres à l'échange";
?>

<!-- Contenu principal de la page livres -->
<div class="content-books">
    <!-- En-tête et barre de recherche -->
    <section class="books-section-header">
        <h1>Nos livres à l'échange</h1>
        <?php if (isset($_GET['search']) && trim($_GET['search']) !== ''): ?>
            <p style="color: #888;">Recherche : <strong><?= htmlspecialchars($_GET['search']) ?></strong></p>
        <?php endif; ?>
        <form method="GET" action="index.php" class="search-bar-wrapper">
            <input type="hidden" name="page" value="books">
            <input type="text" name="search" placeholder="Rechercher un livre" class="search-bar">
            <i class="fa-solid fa-magnifying-glass"></i>
        </form>
    </section>
    <!-- Liste des livres -->
    <section class="books-section-list">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $book): ?>
                <!-- Carte d'un livre -->
                <a href="index.php?page=book_details&id=<?= $book['id'] ?>">
                    <div class="book-card">
                        <div class="book-infos">
                            <h3 class="title"><?= htmlspecialchars($book['title']) ?></h3>
                            <p class="author"><?= htmlspecialchars($book['author']) ?></p>
                            <p class="seller">Vendu par : <?= htmlspecialchars($book['owner_pseudo'] ?? '') ?></p>
                        </div>
                        <div class="book-tag<?= (isset($book['availability']) && $book['availability'] !== 'Disponible') ? ' book-tag-red' : '' ?>">
                            <?= htmlspecialchars($book['availability'] ?? 'Disponible') ?>
                        </div>
                        <img src="<?= htmlspecialchars($book['cover'] ?? 'assets/books/default.png') ?>" alt="Couverture du livre <?= htmlspecialchars($book['title'] ?? '') ?>">
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <!-- Message si aucun livre -->
            <p>Aucun livre à afficher.</p>
        <?php endif; ?>

    </section>
</div>
<!-- Script JS pour la recherche instantanée -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('.search-bar');
        const booksSection = document.querySelector('.books-section-list');
        const form = document.querySelector('.search-bar-wrapper');

        // Empêche le submit classique
        form.addEventListener('submit', function(e) {
            e.preventDefault();
        });

        searchInput.addEventListener('input', function() {
            const search = searchInput.value;
            // Requête AJAX
            const params = new URLSearchParams({
                page: 'books',
                search: search
            });
            fetch('index.php?' + params.toString())
                .then(response => response.text())
                .then(html => {
                    // Extraire la nouvelle liste des livres
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newBooksSection = doc.querySelector('.books-section-list');
                    if (newBooksSection) {
                        booksSection.innerHTML = newBooksSection.innerHTML;
                    }
                });
        });
    });
</script>