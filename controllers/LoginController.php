
<?php

require_once __DIR__ . '/../config/_config.php'; // Configuration

/**
 * Contrôleur de gestion des utilisateurs (authentification, inscription, compte)
 */
class LoginController
{
    /**
     * Affiche le formulaire de connexion
     */
    public function login()
    {
        ob_start();
        require_once __DIR__ . '/../views/login.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

    /**
     * Affiche le formulaire d'inscription
     */
    public function register()
    {
        ob_start();
        require_once __DIR__ . '/../views/register.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

    /**
     * Affiche la page de compte utilisateur avec ses livres
     */
    public function account()
    {
    $booksModel = new BooksModel();
        $userId = $_SESSION['user']['id'];
        // Récupérer l'utilisateur depuis le modèle pour avoir un objet User
        $userModel = new UserModel();
        $userObj = $userModel->getUserById($userId);
        $user = $userObj ? $userObj : $_SESSION['user'];
        $userBooks = $booksModel->getUserBooks($userId);
        // Passage à la vue
        ob_start();
        // $userBooks sera disponible dans la vue
        require __DIR__ . '/../views/account.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

    /**
     * Affiche le profil public d'un utilisateur et ses livres
     */
    public function public_account()
    {
        $id_user = isset($_GET['id']) ? intval($_GET['id']) : null;
    $userModel = new UserModel();
    $booksModel = new BooksModel();

    $userObj = $id_user ? $userModel->getUserById($id_user) : null;
    // Passer l'objet User à la vue (la vue utilisera les getters)
    $user = $userObj ? $userObj : null;
    $books = $id_user ? $booksModel->getUserBooks($id_user) : [];

        ob_start();
        require_once __DIR__ . '/../views/public_account.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

    /**
     * Retourne la liste des utilisateurs (id, pseudo, email)
     * @return array
     */
    public function getAllUsers()
    {
        try {
            $userModel = new UserModel();
            return $userModel->getAllUsers();
        } catch (PDOException $e) {
            return [];
        }
    }


    /**
     * Traite le formulaire d'inscription
     */
    public function processRegister()
    {
    $userModel = new UserModel();

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pseudo = htmlspecialchars(trim($_POST['pseudo'] ?? ''));
            $email = htmlspecialchars(trim($_POST['email'] ?? ''));
            $password = $_POST['password'] ?? '';
            $creation_date = date('Y-m-d H:i:s');

            // ...validation...

            $errors = $userModel->checkUnique($pseudo, $email);

            if (empty($errors)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $avatar = 'assets/users/default.png';
                if ($userModel->createUser($pseudo, $email, $hashedPassword, $creation_date, $avatar)) {
                    $_SESSION['message'] = "Inscription réussie !";
                    header('Location: index.php?page=login');
                    exit;
                } else {
                    $errors[] = "Erreur lors de l'inscription.";
                }
            }
        }
        // Inclure la vue avec $errors
        ob_start();
        require __DIR__ . '/../views/register.php';
        $content = ob_get_clean();
        require __DIR__ . '/../views/main.php';
    }

    /**
     * Traite le formulaire de connexion
     */
    public function processLogin()
    {
    $userModel = new UserModel();

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars(trim($_POST['email'] ?? ''));
            $password = $_POST['password'] ?? '';

            // Validation
            if (empty($email) || empty($password)) {
                $errors[] = "Tous les champs sont obligatoires.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'adresse email n'est pas valide.";
            } else {
                $userObj = $userModel->getUserByEmail($email);
                if ($userObj && password_verify($password, $userObj->getPassword())) {
                    // Authentification OK — on stocke seulement les champs publics en session
                    $_SESSION['user'] = $userObj->toPublicArray();
                    header('Location: index.php?page=account');
                    exit;
                } else {
                    $errors[] = "Email ou mot de passe incorrect.";
                }
            }
        }
        // Inclure la vue login avec $errors
        ob_start();
        require __DIR__ . '/../views/login.php';
        $content = ob_get_clean();
        require __DIR__ . '/../views/main.php';
    }
    /**
     * Met à jour les informations du compte utilisateur
     */
    public function updateAccount()
    {
    $userModel = new UserModel();
    $userId = $_SESSION['user']['id'];
    $bookModel = new BooksModel();
    $userBooks = $bookModel->getUserBooks($userId);


        $errors = [];
        $success = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pseudo = htmlspecialchars(trim($_POST['pseudo'] ?? ''));
            $email = htmlspecialchars(trim($_POST['email'] ?? ''));
            $password = $_POST['password'] ?? '';

            // Vérification unicité du pseudo
            if ($userModel->isPseudoTaken($pseudo, $userId)) {
                $errors[] = "Ce pseudo est déjà utilisé par un autre utilisateur.";
            }

            // Gestion de l'upload d'avatar
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $fileTmp = $_FILES['avatar']['tmp_name'];
                $fileName = uniqid() . '_' . basename($_FILES['avatar']['name']);
                $destination = 'assets/users/' . $fileName;
                move_uploaded_file($fileTmp, $destination);
                $userModel->updateAvatar($userId, $destination);
                $_SESSION['user']['avatar'] = $destination;
            }

            if (empty($errors)) {
                if (empty($password)) {
                    // Mise à jour sans le mot de passe
                    $userModel->updateUserInfo($userId, $pseudo, $email);
                    $_SESSION['user']['pseudo'] = $pseudo;
                    $_SESSION['user']['email'] = $email;
                    $success = "Modifications enregistrées avec succès.";
                } else {
                    // Mise à jour avec le mot de passe
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $userModel->updateUserInfoWithPassword($userId, $pseudo, $email, $hashedPassword);
                    session_destroy();
                    header('Location: index.php?page=login&message=Mot de passe modifié, veuillez vous reconnecter.');
                    exit;
                }
            }
        }
        // Affichage de la page account avec messages
        ob_start();
        // On rend les variables $errors et $success disponibles dans la vue
        $errors = isset($errors) ? $errors : [];
        $success = isset($success) ? $success : '';
        require __DIR__ . '/../views/account.php';
        $content = ob_get_clean();
        require __DIR__ . '/../views/main.php';
        // Affichage de la page account par défaut
        ob_start();
        require __DIR__ . '/../views/account.php';
        $content = ob_get_clean();
        require __DIR__ . '/../views/main.php';
    }
}
