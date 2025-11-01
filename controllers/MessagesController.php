
<?php

require_once __DIR__ . '/../config/_config.php'; // Configuration

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
    $messagesModel = new MessagesModel();
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
    $userModel = new UserModel();
        $interlocuteur_avatar = 'assets/users/default.png';
        $interlocuteur_pseudo = '';
        if ($selected) {
            // Recherche dans les conversations existantes (maintenant Message objects)
            foreach ($conversations as $conv) {
                $conv_id = ($conv->getSenderId() == $userId) ? $conv->getReceiverId() : $conv->getSenderId();
                if ($conv_id == $selected) {
                    $interlocuteur_avatar = $conv->getSenderAvatar() ?? 'assets/users/default.png';
                    $interlocuteur_pseudo = $conv->getSenderPseudo() ?? '';
                    $interlocuteur_id = $conv_id ?? null;
                    break;
                }
            }
            // Si aucune conversation existante, récupérer l'utilisateur cible
            if (empty($interlocuteur_pseudo)) {
                $destinataire = $userModel->getUserById($selected);
                if ($destinataire) {
                    // $destinataire est maintenant un objet User
                    $interlocuteur_avatar = $destinataire->getAvatar() ?? 'assets/users/default.png';
                    $interlocuteur_pseudo = $destinataire->getPseudo() ?? '';
                    $interlocuteur_id = $destinataire->getId() ?? null;
                }
            }
        }

    // Les vues attendent des tableaux ou objets ; on passe les objets Message et conversations
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
            $messagesModel = new MessagesModel();
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
