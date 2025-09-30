
<?php
class MessagesController {
    public function index() {
        if (!isset($_SESSION['user']['id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        require_once __DIR__ . '/../config/_config.php';
        require_once __DIR__ . '/../models/MessagesModel.php';
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $messagesModel = new MessagesModel($pdo);
        $userId = $_SESSION['user']['id'];
        $conversations = $messagesModel->getConversations($userId);
        $selected = isset($_GET['with']) ? intval($_GET['with']) : null;
        $messages = $selected ? $messagesModel->getConversationMessages($userId, $selected) : [];
        if ($selected) {
            $messagesModel->markAsRead($userId, $selected);
        }
        ob_start();
        require __DIR__ . '/../views/messages.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

    public function send() {
        if (!isset($_SESSION['user']['id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../config/_config.php';
            require_once __DIR__ . '/../models/MessagesModel.php';
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
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