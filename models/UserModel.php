<?php
class UserModel

{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function checkUnique($pseudo, $email)
    {
        $stmt = $this->pdo->prepare("SELECT pseudo, email FROM user WHERE pseudo = :pseudo OR email = :email");
        $stmt->execute(['pseudo' => $pseudo, 'email' => $email]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $errors = [];
        foreach ($result as $row) {
            if ($row['pseudo'] === $pseudo) {
                $errors[] = "Le pseudo est déjà utilisé.";
            }
            if ($row['email'] === $email) {
                $errors[] = "L'adresse email est déjà utilisée.";
            }
        }
        return $errors;
    }

    public function createUser($pseudo, $email, $hashedPassword, $creation_date, $avatar = 'assets/users/default.png')
    {
        $stmt = $this->pdo->prepare("INSERT INTO user (pseudo, email, password, creation_date, avatar) VALUES (:pseudo, :email, :password, :creation_date, :avatar)");
        return $stmt->execute([
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $hashedPassword,
            'creation_date' => $creation_date,
            'avatar' => $avatar
        ]);
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function isPseudoTaken($pseudo, $currentId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM user WHERE pseudo = :pseudo AND id != :id");
        $stmt->execute(['pseudo' => $pseudo, 'id' => $currentId]);
        return $stmt->fetchColumn() > 0;
    }

    public function updateUserInfo($id, $pseudo, $email)
    {
        $stmt = $this->pdo->prepare("UPDATE user SET pseudo = :pseudo, email = :email WHERE id = :id");
        return $stmt->execute([
            'pseudo' => $pseudo,
            'email' => $email,
            'id' => $id
        ]);
    }

    public function updateUserInfoWithPassword($id, $pseudo, $email, $hashedPassword)
    {
        $stmt = $this->pdo->prepare("UPDATE user SET pseudo = :pseudo, email = :email, password = :password WHERE id = :id");
        return $stmt->execute([
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $hashedPassword,
            'id' => $id
        ]);
    }

    public function updateAvatar($id, $avatarPath)
    {
        $stmt = $this->pdo->prepare("UPDATE user SET avatar = :avatar WHERE id = :id");
        return $stmt->execute([
            'avatar' => $avatarPath,
            'id' => $id
        ]);
    }

    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
