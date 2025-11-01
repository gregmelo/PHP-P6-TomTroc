<?php
/**
 * Entité Book
 * Représente un livre
 */
class Book
{
    private $id;
    private $userId;
    private $title;
    private $author;
    private $description;
    private $availability;
    private $cover;
    private $publicationDate;
    private $ownerPseudo;
    private $ownerAvatar;

    /**
     * Constructeur. Accepte un tableau associatif.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->userId = $data['id_user'] ?? ($data['userId'] ?? null);
        $this->title = $data['title'] ?? null;
        $this->author = $data['author'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->availability = $data['availability'] ?? ($data['status'] ?? null);
        $this->cover = $data['cover'] ?? null;
        $this->publicationDate = $data['publication_date'] ?? ($data['publicationDate'] ?? null);
        $this->ownerPseudo = $data['owner_pseudo'] ?? ($data['ownerPseudo'] ?? null);
        $this->ownerAvatar = $data['owner_avatar'] ?? ($data['ownerAvatar'] ?? null);
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'id_user' => $this->userId,
            'title' => $this->title,
            'author' => $this->author,
            'description' => $this->description,
            'availability' => $this->availability,
            'cover' => $this->cover,
            'publication_date' => $this->publicationDate,
            'owner_pseudo' => $this->ownerPseudo,
            'owner_avatar' => $this->ownerAvatar,
        ];
    }

    // Getters et setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getAvailability()
    {
        return $this->availability;
    }

    public function setAvailability($availability)
    {
        $this->availability = $availability;
        return $this;
    }

    public function getCover()
    {
        return $this->cover;
    }

    public function setCover($cover)
    {
        $this->cover = $cover;
        return $this;
    }

    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;
        return $this;
    }

    public function getOwnerPseudo()
    {
        return $this->ownerPseudo;
    }

    public function setOwnerPseudo($v)
    {
        $this->ownerPseudo = $v;
        return $this;
    }

    public function getOwnerAvatar()
    {
        return $this->ownerAvatar;
    }

    public function setOwnerAvatar($v)
    {
        $this->ownerAvatar = $v;
        return $this;
    }
}
