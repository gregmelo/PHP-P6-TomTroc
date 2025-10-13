<?php

/**
 * Modèle de gestion des livres
 * Gère les opérations CRUD et la recherche sur les livres
 */
class BooksModel
{
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
     * Récupère les livres d'un utilisateur
     * @param int $userId
     * @return array
     */
    public function getUserBooks($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM book WHERE id_user = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Récupère tous les livres
     * @return array
     */
    public function getAllBooks()
    {
        $stmt = $this->pdo->query(
            "SELECT b.*, u.pseudo AS owner_pseudo, u.avatar AS owner_avatar
             FROM book b
             JOIN user u ON b.id_user = u.id"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Récupère un livre par son id
     * @param int $id
     * @return array|false
     */
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
    /**
     * Récupère les derniers livres ajoutés
     * @param int $limit
     * @return array
     */
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


    /**
     * Met à jour les informations d'un livre
     * @param int $id
     * @param string $title
     * @param string $author
     * @param string $description
     * @param string $status
     * @param string|null $cover
     */
    public function updateBook($id, $title, $author, $description, $status, $cover = null)
    {
        if ($cover) {
            $sql = "UPDATE book SET title=?, author=?, description=?, availability=?, cover=? WHERE id=?";
            $params = [$title, $author, $description, $status, $cover, $id];
        } else {
            $sql = "UPDATE book SET title=?, author=?, description=?, availability=? WHERE id=?";
            $params = [$title, $author, $description, $status, $id];
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
    }

    /**
     * Supprime un livre par son id
     * @param int $id
     */
    public function bookDelete($id)
    {
        $sql = "DELETE FROM book WHERE id = ?";
        $params = [$id];
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
    }

    /**
     * Recherche les livres par titre (partiel, insensible à la casse)
     * @param string $search
     * @return array
     */
    public function searchBooksByTitle($search)
    {
        $stmt = $this->pdo->prepare(
            "SELECT b.*, u.pseudo AS owner_pseudo, u.avatar AS owner_avatar
             FROM book b
             JOIN user u ON b.id_user = u.id
             WHERE LOWER(b.title) LIKE LOWER(:search)"
        );
        $stmt->execute(['search' => '%' . $search . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
