
<?php $title = "Page du livre " . htmlspecialchars($book['title'] ?? ''); ?>

<section class="book-navigation"><a href="index.php?page=books">Nos livres</a> > <?= htmlspecialchars($book['title'] ?? '') ?></section>
<div class="content-book-details">
    <section class="illustration-book-detail">
        <img src="<?= htmlspecialchars($book['cover'] ?? 'assets/books/default.png') ?>" alt="Couverture du livre">
    </section>
    <section class="book-detail-infos">
        <h1><?= htmlspecialchars($book['title'] ?? '') ?></h1>
        <h2>par <?= htmlspecialchars($book['author'] ?? '') ?></h2>
        <hr>
        <h3>description</h3>
        <p><?= nl2br(htmlspecialchars($book['description'] ?? '')) ?></p>
        <h3>propriétaire</h3>
        <a href="index.php?page=public_account&id=<?= $book['id_user'] ?>">
            <div class="proprietaire-infos">
                <div class="avatar">
                    <img src="<?= htmlspecialchars($book['owner_avatar'] ?? 'assets/users/default.png') ?>" alt="Photo de profil de <?= htmlspecialchars($book['owner_pseudo'] ?? '') ?>">
                    <div class="overlay"></div>
                </div>
                <p><?= htmlspecialchars($book['owner_pseudo'] ?? '') ?></p>
            </div>
        </a>
        <a href="#" class="btn">Envoyer un message</a>
    </section>
</div>