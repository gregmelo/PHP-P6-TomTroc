<?php

/**
 * Vue principale (layout)
 * Affiche l'en-tête, le contenu de la page et le pied de page
 * Variables attendues :
 *   - $content : contenu HTML de la page courante
 */

// Récupérer le nombre de messages non lus pour l'utilisateur connecté
if (isset($_SESSION['user']['id'])) {
    // Models are autoloaded; BaseModel will provide a PDO if needed
    $messagesModel = new MessagesModel();
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