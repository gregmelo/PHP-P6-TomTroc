<?php

/**
 * Modèle de gestion des messages privés
 * Gère les conversations, l'envoi et la lecture des messages
 */
class MessagesModel
{
    /**
     * Compte le nombre de messages reçus non lus pour l'utilisateur
     * @param int $userId
     * @return int
     */
    public function countUnreadMessages($userId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT COUNT(*) FROM message WHERE receiver_id = :userId AND message_read = 0"
        );
        $stmt->execute(['userId' => $userId]);
        return (int)$stmt->fetchColumn();
    }
    /**
     * Instance PDO pour la connexion à la base
     * @var PDO
     */
    private $pdo;

    /**
     * Constructeur
     * @param PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupère la liste des conversations de l'utilisateur (groupées par interlocuteur)
     * @param int $userId
     * @return array
     */
    public function getConversations($userId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT m.*, u.pseudo, u.avatar
             FROM message m
             JOIN user u ON (u.id = IF(m.sender_id = :userId_if, m.receiver_id, m.sender_id))
             WHERE m.sender_id = :userId_w1 OR m.receiver_id = :userId_w2
             GROUP BY u.id
             ORDER BY MAX(m.send_at) DESC"
        );
        $stmt->execute([
            'userId_if' => $userId,
            'userId_w1' => $userId,
            'userId_w2' => $userId
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère tous les messages d'une conversation entre deux utilisateurs
     * @param int $userId
     * @param int $otherId
     * @return array
     */
    public function getConversationMessages($userId, $otherId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT m.*, u.pseudo, u.avatar
             FROM message m
             JOIN user u ON u.id = m.sender_id
             WHERE (m.sender_id = :userId_1 AND m.receiver_id = :otherId_1)
                OR (m.sender_id = :otherId_2 AND m.receiver_id = :userId_2)
             ORDER BY m.send_at ASC"
        );
        $stmt->execute([
            'userId_1' => $userId,
            'otherId_1' => $otherId,
            'otherId_2' => $otherId,
            'userId_2' => $userId
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Envoie un nouveau message
     * @param int $senderId
     * @param int $receiverId
     * @param string $content
     * @return bool
     */
    public function sendMessage($senderId, $receiverId, $content)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO message (sender_id, receiver_id, content, send_at, message_read)
             VALUES (:senderId, :receiverId, :content, NOW(), 0)"
        );
        return $stmt->execute([
            'senderId' => $senderId,
            'receiverId' => $receiverId,
            'content' => $content
        ]);
    }

    /**
     * Marque tous les messages reçus comme lus dans une conversation
     * @param int $userId
     * @param int $otherId
     * @return bool
     */
    public function markAsRead($userId, $otherId)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE message SET message_read = 1
             WHERE receiver_id = :userId AND sender_id = :otherId AND message_read = 0"
        );
        return $stmt->execute([
            'userId' => $userId,
            'otherId' => $otherId
        ]);
    }
}
