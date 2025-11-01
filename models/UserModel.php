<?php

/**
 * Modèle de gestion des utilisateurs
 * Gère l'inscription, la connexion, la modification et la récupération des utilisateurs
 */
// BaseModel centralise la connexion PDO
require_once __DIR__ . '/BaseModel.php';
class UserModel extends BaseModel
{

    /**
     * Vérifie l'unicité du pseudo et de l'email
     * @param string $pseudo
     * @param string $email
     * @return array
     */
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

    /**
     * Crée un nouvel utilisateur
     * @param string $pseudo
     * @param string $email
     * @param string $hashedPassword
     * @param string $creation_date
     * @param string $avatar
     * @return bool
     */
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

    /**
     * Récupère un utilisateur par son email
     * @param string $email
     * @return User|null
     */
    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return User::fromArray($row);
        }
        return null;
    }

    /**
     * Vérifie si le pseudo est déjà pris par un autre utilisateur
     * @param string $pseudo
     * @param int $currentId
     * @return bool
     */
    public function isPseudoTaken($pseudo, $currentId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM user WHERE pseudo = :pseudo AND id != :id");
        $stmt->execute(['pseudo' => $pseudo, 'id' => $currentId]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Met à jour le pseudo et l'email d'un utilisateur
     * @param int $id
     * @param string $pseudo
     * @param string $email
     * @return bool
     */
    public function updateUserInfo($id, $pseudo, $email)
    {
        $stmt = $this->pdo->prepare("UPDATE user SET pseudo = :pseudo, email = :email WHERE id = :id");
        return $stmt->execute([
            'pseudo' => $pseudo,
            'email' => $email,
            'id' => $id
        ]);
    }

    /**
     * Met à jour le pseudo, l'email et le mot de passe d'un utilisateur
     * @param int $id
     * @param string $pseudo
     * @param string $email
     * @param string $hashedPassword
     * @return bool
     */
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

    /**
     * Met à jour l'avatar d'un utilisateur
     * @param int $id
     * @param string $avatarPath
     * @return bool
     */
    public function updateAvatar($id, $avatarPath)
    {
        $stmt = $this->pdo->prepare("UPDATE user SET avatar = :avatar WHERE id = :id");
        return $stmt->execute([
            'avatar' => $avatarPath,
            'id' => $id
        ]);
    }

    /**
     * Récupère un utilisateur par son id
     * @param int $id
     * @return User|null
     */
    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return User::fromArray($row);
        }
        return null;
    }

    /**
     * Retourne la liste des utilisateurs (id, pseudo, email)
     * @return array
     */
    public function getAllUsers()
    {
        $stmt = $this->pdo->query("SELECT id, pseudo, email FROM user");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
