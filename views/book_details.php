<?php

/**
 * Vue : Détail d'un livre
 * Affiche les informations détaillées d'un livre et son propriétaire
 * Variables attendues :
 *   - $book : tableau des infos du livre
 */
// $book est un objet Book
$title = "Page du livre " . ($book ? htmlspecialchars($book->getTitle()) : '');
?>

<!-- Fil d'Ariane -->
<section class="book-navigation"><a href="index.php?page=books">Nos livres</a> > <?= $book ? htmlspecialchars($book->getTitle()) : '' ?></section>
<!-- Contenu principal de la page détail livre -->
<div class="content-book-details">
    <!-- Illustration du livre -->
    <section class="illustration-book-detail">
    <img src="<?= $book ? htmlspecialchars($book->getCover() ?? 'assets/books/default.png') : 'assets/books/default.png' ?>" alt="Couverture du livre <?= $book ? htmlspecialchars($book->getTitle()) : '' ?>">
    </section>
    <!-- Informations détaillées du livre -->
    <section class="book-detail-infos">
    <h1><?= $book ? htmlspecialchars($book->getTitle()) : '' ?></h1>
    <h2>par <?= $book ? htmlspecialchars($book->getAuthor()) : '' ?></h2>
        <hr>
        <h3>description</h3>
    <p><?= $book ? nl2br(htmlspecialchars($book->getDescription() ?? '')) : '' ?></p>
        <h3>propriétaire</h3>
        <!-- Lien vers le compte du propriétaire -->
    <a href="index.php?page=<?= (isset($_SESSION['user']['id']) && $book && $_SESSION['user']['id'] == $book->getUserId()) ? 'account' : 'public_account&id=' . ($book ? $book->getUserId() : '') ?>">
            <div class="proprietaire-infos">
                <div class="avatar">
                    <img src="<?= $book ? htmlspecialchars($book->getOwnerAvatar() ?? 'assets/users/default.png') : 'assets/users/default.png' ?>" alt="Photo de profil de <?= $book ? htmlspecialchars($book->getOwnerPseudo()) : '' ?>">
                    <div class="overlay"></div>
                </div>
                <p><?= $book ? htmlspecialchars($book->getOwnerPseudo()) : '' ?></p>
            </div>
        </a>
        <!-- Bouton d'envoi de message -->
    <?php if ($book && isset($_SESSION['user']['id']) && $_SESSION['user']['id'] == $book->getUserId()): ?>
            <a href="#" class="btn btn-disabled">Envoyer un message</a>
        <?php else: ?>
            <a href="index.php?page=messages&with=<?= $book ? $book->getUserId() : '' ?>" class="btn">Envoyer un message</a>
        <?php endif; ?>
    </section>
</div>