
<?php
// Point d'entrée du site
require_once 'config/_config.php';

// Détermination de la page demandée
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
	case 'login':
		require_once 'controllers/LoginController.php';
		$controller = new LoginController();
		$controller->index();
		break;
	case 'register':
		require_once 'controllers/RegisterController.php';
		$controller = new RegisterController();
		$controller->index();
		break;
	case 'home':
	default:
		require_once 'controllers/HomeController.php';
		$controller = new HomeController();
		$controller->index();
		break;
		case 'books':
		require_once 'controllers/BooksController.php';
		$controller = new BooksController();
		$controller->index();
		break;
}
