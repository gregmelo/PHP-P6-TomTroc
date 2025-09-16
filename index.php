
<?php
// Point d'entrée du site
require_once 'config/_config.php';

// Détermination de la page demandée
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
	case 'login':
		require_once 'controllers/LoginController.php';
		$controller = new LoginController();
		$controller->login();
		break;
	case 'register':
		require_once 'controllers/LoginController.php';
		$controller = new LoginController();
		$controller->register();
		break;
	case 'home':
	case 'books':
		require_once 'controllers/BooksController.php';
		$controller = new BooksController();
		$controller->index();
		break;
	case 'book_details':
		require_once 'controllers/BooksController.php';
		$controller = new BooksController();
		$controller->book_details();
		break;
	default:
		require_once 'controllers/HomeController.php';
		$controller = new HomeController();
		$controller->index();
		break;
}
