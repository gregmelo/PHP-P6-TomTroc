<?php
class BooksModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function getUserBooks($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM book WHERE id_user = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
