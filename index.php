
<?php
// Point d'entrée du site
require_once 'config/_config.php';

// Détermination de la page demandée
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
	case 'home':
		require_once 'controllers/HomeController.php';
		$controller = new HomeController();
		$controller->index();
		break;
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
	case 'books':
		require_once 'controllers/BooksController.php';
		$controller = new BooksController();
		$controller->books_list();
		break;
	case 'book_details':
		require_once 'controllers/BooksController.php';
		$controller = new BooksController();
		$controller->book_details();
		break;
	case 'book_edit':
		require_once 'controllers/BooksController.php';
		$controller = new BooksController();
		$controller->book_edit();
		break;
	case 'messages':
		require_once 'controllers/MessagesController.php';
		$controller = new MessagesController();
		$controller->index();
		break;
	case 'messages_send':
		require_once 'controllers/MessagesController.php';
		$controller = new MessagesController();
		$controller->send();
		break;
	case 'account':
		require_once 'controllers/LoginController.php';
		$controller = new LoginController();
		$controller->account();
		break;
	case 'public_account':
		require_once 'controllers/LoginController.php';
		$controller = new LoginController();
		$controller->public_account();
		break;
	case 'testBDD':
		require_once 'views/testBDD.php';
		break;
	case 'process_register':
		require_once 'controllers/LoginController.php';
		$controller = new LoginController();
		$controller->processRegister();
		break;
	case 'process_login':
		require_once 'controllers/LoginController.php';
		$controller = new LoginController();
		$controller->processLogin();
		break;
	case 'logout':
		require_once 'views/logout.php';
		break;
	case 'updateAccount':
		require_once 'controllers/LoginController.php';
		$controller = new LoginController();
		$controller->updateAccount();
		break;
	case 'book_update':
		require_once 'controllers/BooksController.php';
		$controller = new BooksController();
		$controller->book_update();
		break;
	case 'book_delete':
		require_once 'controllers/BooksController.php';
		$controller = new BooksController();
		$controller->book_delete();
		break;
	default:
		ob_start();
		require_once 'views/error404.php';
		$content = ob_get_clean();
		require_once 'views/main.php';
		break;
}
