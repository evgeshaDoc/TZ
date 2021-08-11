<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once '../services/users.service.php';
include_once '../controllers/auth.controller.php';
include_once '../controllers/users.controller.php';

$user = 'root';
$password = 'root';
$db = 'admin_panel';
$host = 'localhost';
$dsn = "mysql:host=$host;dbname=$db";

$usersService = new UsersService($dsn, $user, $password);
$usersController = new UsersController($usersService);

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    AuthController::checkSession();
    if (isset($_REQUEST['order'])) $usersController->getUsers($_REQUEST['order']);
    else if(isset($_REQUEST['id'])) $usersController->getUser($_REQUEST['id']);
    break;
  case 'DELETE':
    AuthController::checkSession();

    $content = file_get_contents('php://input');
    $body = json_decode($content, true);

    $usersController->deleteUsers($body['ids']);
    break;
  case 'PUT':
    AuthController::checkSession();

    $content = file_get_contents('php://input');
    $body = json_decode($content, true);

    $usersController->changeUser($body);
    break;
  case 'POST':
    AuthController::checkSession();

    $content = file_get_contents('php://input');
    $body = json_decode($content, true);

    $usersController->addUser($body);
    break;
  default:
    echo json_encode(['error' => 'Такого запроса не существует']);
    return;
}