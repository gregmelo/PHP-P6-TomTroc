
<?php
// Récupérer le nombre de messages non lus pour l'utilisateur connecté
if (isset($_SESSION['user']['id'])) {
    require_once __DIR__ . '/../models/MessagesModel.php';
    require_once __DIR__ . '/../config/_config.php';
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    $messagesModel = new MessagesModel($pdo);
    $unreadMessagesCount = $messagesModel->countUnreadMessages($_SESSION['user']['id']);
} else {
    $unreadMessagesCount = 0;
}
?>
<?php include __DIR__ . '/header.php'; ?>

    <main>    
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>

<?php include __DIR__ . '/footer.php'; ?>