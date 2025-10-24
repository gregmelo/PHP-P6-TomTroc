<?php

/**
 * Vue : En-tête du site
 * Affiche le logo, la barre de navigation et le menu responsive
 * Variables attendues :
 *   - $title : titre de la page
 *   - $unreadMessagesCount : nombre de messages non lus
*/
?>
<?php // Détermine la page courante via le paramètre GET 'page' (par défaut 'home')
$currentPage = isset($_GET['page']) && $_GET['page'] !== '' ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? "$title - " : "" ?>TomTroc</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="./assets/logo/logo.png" alt="Logo TomTroc">
        </div>
        <div class="navbar" id="navbar">
            <nav class="navbar-left">
                <a href="index.php?page=home" class="<?= $currentPage === 'home' ? 'active' : '' ?>">Accueil</a>
                <a href="index.php?page=books" class="<?= $currentPage === 'books' ? 'active' : '' ?>">Nos livres à l'échange</a>
            </nav>
            <nav class="navbar-right">
                <a href="index.php?page=messages" class="<?= $currentPage === 'messages' ? 'active' : '' ?>"><i class="fa-regular fa-message"></i> Messagerie<?php if (isset($_SESSION['user']) && isset($unreadMessagesCount) && $unreadMessagesCount > 0): ?> <span class="message-badge"><?= $unreadMessagesCount ?></span><?php endif; ?></a>
                <a href="index.php?page=account" class="<?= $currentPage === 'account' ? 'active' : '' ?>"><i class="fa-regular fa-user"></i> Mon compte</a>
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="index.php?page=logout" class="<?= $currentPage === 'logout' ? 'active' : '' ?>">Déconnexion</a>
                <?php else: ?>
                    <a href="index.php?page=login" class="<?= $currentPage === 'login' ? 'active' : '' ?>">Connexion</a>
                <?php endif; ?>
            </nav>
        </div>
        <div class="menu-toggle" id="menu-toggle">
            <i class="fa-solid fa-bars" id="burger-icon"></i>
            <i class="fa-solid fa-xmark" id="close-icon" style="display:none;"></i>
        </div>
    </header>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const burgerIcon = document.getElementById('burger-icon');
            const closeIcon = document.getElementById('close-icon');
            const navbar = document.getElementById('navbar');


            burgerIcon.addEventListener('click', function() {
                navbar.classList.add('menu-open');
                burgerIcon.style.display = 'none';
                closeIcon.style.display = 'inline';
            });


            closeIcon.addEventListener('click', function() {
                navbar.classList.remove('menu-open');
                burgerIcon.style.display = 'inline';
                closeIcon.style.display = 'none';
            });

            // Au chargement, cacher le menu en mobile
            function handleResize() {
                if (window.innerWidth <= 768) {
                    // navbar.style.display = 'none';
                    burgerIcon.style.display = 'inline';
                    closeIcon.style.display = 'none';
                } else {
                    navbar.style.display = 'flex';
                    burgerIcon.style.display = 'none';
                    closeIcon.style.display = 'none';
                }
            }
            window.addEventListener('resize', handleResize);
            handleResize();
        });
    </script>