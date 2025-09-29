
<?php
class LoginController
{
    public function login()
    {
        ob_start();
        require_once __DIR__ . '/../views/login.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

    public function register()
    {
        ob_start();
        require_once __DIR__ . '/../views/register.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

    public function account()
    {
    require_once __DIR__ . '/../config/_config.php';
    require_once __DIR__ . '/../models/BooksModel.php';
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $booksModel = new BooksModel($pdo);
    $userId = $_SESSION['user']['id'];
    $userBooks = $booksModel->getUserBooks($userId);
    // Passage à la vue
    ob_start();
    // $userBooks sera disponible dans la vue
    require __DIR__ . '/../views/account.php';
    $content = ob_get_clean();
    require_once __DIR__ . '/../views/main.php';
    }

    public function public_account()
    {
        ob_start();
        require_once __DIR__ . '/../views/public_account.php';
        $content = ob_get_clean();
        require_once __DIR__ . '/../views/main.php';
    }

    /**
     * Retourne la liste des utilisateurs (id, pseudo, email)
     */
    public function getAllUsers()
    {
        require_once __DIR__ . '/../config/_config.php';
        try {
            $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->query("SELECT id, pseudo, email FROM user");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }


    public function processRegister()
    {
        require_once __DIR__ . '/../config/_config.php';
        require_once __DIR__ . '/../models/UserModel.php';
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $userModel = new UserModel($pdo);

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

    public function processLogin()
    {
        require_once __DIR__ . '/../config/_config.php';
        require_once __DIR__ . '/../models/UserModel.php';
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $userModel = new UserModel($pdo);

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
                $user = $userModel->getUserByEmail($email);
                if ($user && password_verify($password, $user['password'])) {
                    // Authentification OK
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'pseudo' => $user['pseudo'],
                        'email' => $user['email'],
                        'creation_date' => $user['creation_date'],
                        'avatar' => $user['avatar']
                    ];
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
    public function updateAccount()
    {
        require_once __DIR__ . '/../config/_config.php';
        require_once __DIR__ . '/../models/UserModel.php';
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $userModel = new UserModel($pdo);
        $userId = $_SESSION['user']['id'];

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
