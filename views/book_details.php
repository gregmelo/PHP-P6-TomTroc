<?php

/**
 * Vue : Détail d'un livre
 * Affiche les informations détaillées d'un livre et son propriétaire
 * Variables attendues :
 *   - $book : tableau des infos du livre
 */
$title = "Page du livre " . htmlspecialchars($book['title'] ?? '');
?>

<!-- Fil d'Ariane -->
<section class="book-navigation"><a href="index.php?page=books">Nos livres</a> > <?= htmlspecialchars($book['title'] ?? '') ?></section>
<!-- Contenu principal de la page détail livre -->
<div class="content-book-details">
    <!-- Illustration du livre -->
    <section class="illustration-book-detail">
        <img src="<?= htmlspecialchars($book['cover'] ?? 'assets/books/default.png') ?>" alt="Couverture du livre <?= htmlspecialchars($book['title'] ?? '') ?>">
    </section>
    <!-- Informations détaillées du livre -->
    <section class="book-detail-infos">
        <h1><?= htmlspecialchars($book['title'] ?? '') ?></h1>
        <h2>par <?= htmlspecialchars($book['author'] ?? '') ?></h2>
        <hr>
        <h3>description</h3>
        <p><?= nl2br(htmlspecialchars($book['description'] ?? '')) ?></p>
        <h3>propriétaire</h3>
        <!-- Lien vers le compte du propriétaire -->
        <a href="index.php?page=<?= (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] == $book['id_user']) ? 'account' : 'public_account&id=' . $book['id_user'] ?>">
            <div class="proprietaire-infos">
                <div class="avatar">
                    <img src="<?= htmlspecialchars($book['owner_avatar'] ?? 'assets/users/default.png') ?>" alt="Photo de profil de <?= htmlspecialchars($book['owner_pseudo'] ?? '') ?>">
                    <div class="overlay"></div>
                </div>
                <p><?= htmlspecialchars($book['owner_pseudo'] ?? '') ?></p>
            </div>
        </a>
        <!-- Bouton d'envoi de message -->
        <?php if (isset($_SESSION['user']['id']) && $_SESSION['user']['id'] == $book['id_user']): ?>
            <a href="#" class="btn" style="pointer-events: none; opacity: 0.5; cursor: not-allowed;">Envoyer un message</a>
        <?php else: ?>
            <a href="index.php?page=messages&with=<?= $book['id_user'] ?>" class="btn">Envoyer un message</a>
        <?php endif; ?>
    </section>
</div>