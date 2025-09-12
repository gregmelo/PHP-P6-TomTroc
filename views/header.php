<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TomTroc <?= isset($title) ? " - $title" : "" ?></title>
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
                <a href="index.php" class="active">Accueil</a>
                <a href="index.php?page=books">Nos livres à l'échange</a>
            </nav>
            <nav class="navbar-right">
                <a href="index.php?page=login"><i class="fa-regular fa-message"></i> Messagerie <span class="message-badge">1</span></a>
                <a href="index.php?page=register"><i class="fa-regular fa-user"></i> Mon compte</a>
                <a href="index.php?page=addbook">Connexion</a>
                <!--<a href="index.php?page=addbook">Deconnexion</a>-->
            </nav>
        </div>
    </header>