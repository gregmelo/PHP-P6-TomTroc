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
    public function getAllBooks()
    {
        $stmt = $this->pdo->query(
            "SELECT b.*, u.pseudo AS owner_pseudo, u.avatar AS owner_avatar
             FROM book b
             JOIN user u ON b.id_user = u.id"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBookById($id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT b.*, u.pseudo AS owner_pseudo, u.avatar AS owner_avatar
             FROM book b
             JOIN user u ON b.id_user = u.id
             WHERE b.id = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getLastBooks($limit = 4)
    {
        $stmt = $this->pdo->prepare(
            "SELECT b.*, u.pseudo AS owner_pseudo, u.avatar AS owner_avatar
             FROM book b
             JOIN user u ON b.id_user = u.id
             ORDER BY b.publication_date DESC
             LIMIT :limit"
        );
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
