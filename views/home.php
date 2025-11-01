<?php

/**
 * Vue : Page d'accueil
 * Affiche le bandeau principal, les derniers livres, le fonctionnement et les valeurs
 * Variables attendues :
 *   - $lastBooks : tableau des derniers livres ajoutés
 */
?>
<!-- Bandeau principal -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-left">
            <h1>Rejoignez nos lecteurs passionnés</h1>
            <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture.
                Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.</p>
            <a href="index.php?page=books" class="btn">Découvrir</a>
        </div>
        <div class="hero-right">
            <img src="./assets/home/hero_img.jpg" alt="">
            <p>Hamza</p>
        </div>
    </div>
</section>
<!-- Section derniers livres ajoutés -->
<section class="last-books">
    <h2>Les derniers livres ajoutés</h2>
    <div class="last-books-list">
        <?php if (!empty($lastBooks)): ?>
            <?php foreach ($lastBooks as $book): ?>
                <!-- Carte cliquable : redirige vers la page de détail du livre -->
                <a class="book-link" href="index.php?page=book_details&id=<?= $book->getId() ?>" aria-label="Voir le détail du livre <?= htmlspecialchars($book->getTitle() ?? '') ?>">
                    <div class="book-card">
                        <div class="book-infos">
                            <h3 class="title"><?= htmlspecialchars($book->getTitle()) ?></h3>
                            <p class="author"><?= htmlspecialchars($book->getAuthor()) ?></p>
                            <p class="seller">Vendu par : <?= htmlspecialchars($book->getOwnerPseudo() ?? '') ?></p>
                        </div>
                        <div class="book-tag<?= ($book->getAvailability() ?? 'Disponible') !== 'Disponible' ? ' book-tag-red' : '' ?>">
                            <?= htmlspecialchars($book->getAvailability() ?? 'Disponible') ?>
                        </div>
                        <img src="<?= htmlspecialchars($book->getCover() ?? 'assets/books/default.png') ?>" alt="Couverture du livre <?= htmlspecialchars($book->getTitle() ?? '') ?>">
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun livre à afficher.</p>
        <?php endif; ?>
    </div>
    <a href="index.php?page=books" class="btn">Voir tous les livres</a>
</section>
<!-- Section fonctionnement de la plateforme -->
<section class="functioning">
    <h2>Comment ça marche ?</h2>
    <p>Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :</p>
    <div class="functioning-cards">
        <div class="functioning-card">Inscrivez-vous gratuitement sur notre plateforme.</div>
        <div class="functioning-card">Ajoutez les livres que vous souhaitez échanger à votre profil.</div>
        <div class="functioning-card">Parcourez les livres disponibles chez d'autres membres.</div>
        <div class="functioning-card">Proposez un échange et discutez avec d'autres passionnés de lecture.</div>
    </div>
    <a href="index.php?page=books" class="btn">Voir tous les livres</a>
</section>

<!-- Section valeurs de TomTroc -->
<section class="values">
    <img src="./assets/home/home_banner.jpg" alt="">
    <h2>Nos valeurs</h2>
    <p>
        Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.<br><br>
        Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.<br><br>
        Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.
    </p>
    <div class="values-signature">
        <span class="signature">L'équipe Tom Troc</span>
        <img src="./assets/logo/logo_coeur.svg" alt="" class="values-logo">
    </div>
</section>