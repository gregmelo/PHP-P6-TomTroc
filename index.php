<?php
// Point d'entrée du site
require_once 'config/_config.php';
require_once 'controllers/HomeController.php';

$controller = new HomeController();
$controller->index();
