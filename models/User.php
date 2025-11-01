<?php

/**
 * Entité User
 * Représente un utilisateur
 */
class User
{
    private $id;
    private $pseudo;
    private $email;
    private $password;
    private $creationDate;
    private $avatar;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->pseudo = $data['pseudo'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->creationDate = $data['creation_date'] ?? ($data['creationDate'] ?? null);
        $this->avatar = $data['avatar'] ?? null;
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'pseudo' => $this->pseudo,
            'email' => $this->email,
            'password' => $this->password,
            'creation_date' => $this->creationDate,
            'avatar' => $this->avatar,
        ];
    }

    // Getters / Setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getPseudo()
    {
        return $this->pseudo;
    }
    public function setPseudo($v)
    {
        $this->pseudo = $v;
        return $this;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($v)
    {
        $this->email = $v;
        return $this;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($v)
    {
        $this->password = $v;
        return $this;
    }
    public function getCreationDate()
    {
        return $this->creationDate;
    }
    public function setCreationDate($v)
    {
        $this->creationDate = $v;
        return $this;
    }
    public function getAvatar()
    {
        return $this->avatar;
    }
    public function setAvatar($v)
    {
        $this->avatar = $v;
        return $this;
    }

    /**
     * Retourne un tableau sûr pour l'exposition (exclut le mot de passe)
     * @return array
     */
    public function toPublicArray(): array
    {
        return [
            'id' => $this->id,
            'pseudo' => $this->pseudo,
            'email' => $this->email,
            'creation_date' => $this->creationDate,
            'avatar' => $this->avatar,
        ];
    }
}
