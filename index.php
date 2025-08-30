<?php 
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . "/init.php";
use Framework\Router;

// Instantiating router
$router = new Router();

// get routes
require base_path('routes.php');
// Get current URI and HTTP method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//Route the request
$router->route($uri);