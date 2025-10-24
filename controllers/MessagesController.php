
<?php

require_once __DIR__ . '/../config/_config.php'; // Configuration
require_once __DIR__ . '/../config/Database.php'; // Database singleton
require_once __DIR__ . '/../models/MessagesModel.php'; // Modèle messages
require_once __DIR__ . '/../models/UserModel.php'; // Modèle utilisateurs

/**
 * Contrôleur de gestion des messages privés entre utilisateurs
 */
class MessagesController
{
    /**
     * Affiche la page de messagerie et les conversations de l'utilisateur
     */
    public function index()
    {
        if (!isset($_SESSION['user']['id'])) {
            header('Location: index.php?page=login');
            exit;
        }
    $pdo = Database::getInstance();
    $messagesModel = new MessagesModel($pdo);
        $userId = $_SESSION['user']['id'];
        $conversations = $messagesModel->getConversations($userId);
        $selected = isset($_GET['with']) ? intval($_GET['with']) : null;
        $messages = $selected ? $messagesModel->getConversationMessages($userId, $selected) : [];
        if ($selected) {
            $messagesModel->markAsRead($userId, $selected);
        }
        $selected = isset($_GET['with']) ? intval($_GET['with']) : null;
        $messages = $selected ? $messagesModel->getConversationMessages($userId, $selected) : [];
        if ($selected) {
            $messagesModel->markAsRead($userId, $selected);
        }

    // Ajout pour avatar/pseudo de l'interlocuteur
    $userModel = new UserModel($pdo);
        $interlocuteur_avatar = 'assets/users/default.png';
        $interlocuteur_pseudo = '';
        if ($selected) {
            // Recherche dans les conversations existantes
            foreach ($conversations as $conv) {
                $conv_id = ($conv['sender_id'] == $userId) ? $conv['receiver_id'] : $conv['sender_id'];
                if ($conv_id == $selected) {
                    $interlocuteur_avatar = $conv['avatar'] ?? 'assets/users/default.png';
                    $interlocuteur_pseudo = $conv['pseudo'] ?? '';
                    $interlocuteur_id = $conv_id ?? null;
                    break;
                }
            }
            // Si aucune conversation existante, récupérer l'utilisateur cible
            if (empty($interlocuteur_pseudo)) {
                $destinataire = $userModel->getUserById($selected);
                if ($destinataire) {
                    $interlocuteur_avatar = $destinataire['avatar'] ?? 'assets/users/default.png';
                    $interlocuteur_pseudo = $destinataire['pseudo'] ?? '';
                    $interlocuteur_id = $destinataire['id'] ?? null;
                }
            }
        }

        // Passe ces variables à la vue
        ob_start();
        require __DIR__ . '/../views/messages.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

    /**
     * Traite l'envoi d'un message privé
     */
    public function send()
    {
        if (!isset($_SESSION['user']['id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdo = Database::getInstance();
            $messagesModel = new MessagesModel($pdo);
            $senderId = $_SESSION['user']['id'];
            $receiverId = intval($_POST['receiver_id']);
            $content = trim($_POST['content']);
            if ($content !== '') {
                $messagesModel->sendMessage($senderId, $receiverId, $content);
            }
            header('Location: index.php?page=messages&with=' . $receiverId);
            exit;
        }
    }
}
