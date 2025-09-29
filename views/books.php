<?php $title = "Page nos livres à l'échange"; ?>

<div class="content-books">
    <section class="books-section-header">
        <h1>Nos livres à l'échange</h1>
        <div class="search-bar-wrapper">
            <input type="text" placeholder="Rechercher un livre" class="search-bar">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
    </section>
    <section class="books-section-list">
        <?php if (!empty($books)): ?>
            <?php foreach ($books as $book): ?>
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
            <p>Aucun livre à afficher.</p>
        <?php endif; ?>

    </section>
</div>