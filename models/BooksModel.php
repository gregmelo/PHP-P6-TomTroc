<?php

/**
 * Modèle de gestion des livres
 * Gère les opérations CRUD et la recherche sur les livres
 */
// L'entité Book est autoloadée via config/autoload.php
// BaseModel centralise la connexion PDO
require_once __DIR__ . '/BaseModel.php';
class BooksModel extends BaseModel
{
    /**
     * Récupère les livres d'un utilisateur
     * @param int $userId
     * @return Book[]
     */
    public function getUserBooks($userId)
    {
    $stmt = $this->pdo->prepare("SELECT * FROM book WHERE id_user = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $books = [];
        foreach ($rows as $r) {
            $books[] = Book::fromArray($r);
        }
        return $books;
    }
    /**
     * Récupère tous les livres
     * @return Book[]
     */
    public function getAllBooks()
    {
        $stmt = $this->pdo->query(
            "SELECT b.*, u.pseudo AS owner_pseudo, u.avatar AS owner_avatar
             FROM book b
             JOIN user u ON b.id_user = u.id"
        );
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $books = [];
        foreach ($rows as $r) {
            $books[] = Book::fromArray($r);
        }
        return $books;
    }
    /**
     * Récupère un livre par son id
     * @param int $id
     * @return Book|null
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
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return Book::fromArray($row);
        }
        return null;
    }
    /**
     * Récupère les derniers livres ajoutés
     * @param int $limit
     * @return Book[]
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
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $books = [];
        foreach ($rows as $r) {
            $books[] = Book::fromArray($r);
        }
        return $books;
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
     * @return Book[]
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
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $books = [];
        foreach ($rows as $r) {
            $books[] = Book::fromArray($r);
        }
        return $books;
    }
}
