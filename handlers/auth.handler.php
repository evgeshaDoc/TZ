<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once '../services/auth.service.php';
include_once '../controllers/auth.controller.php';

$user = "news";
$password = "news";
$db = "admin_panel";
$host = "localhost";
$dsn = "mysql:host=$host;dbname=$db";

//$pdo = new PDO();
//$stmt = $pdo->prepare('select * from users');
//$stmt->execute();
//$result = $stmt->fetch(PDO::FETCH_ASSOC);
//
//var_dump( $result);
//
//echo json_encode($result);

$authService = new AuthService($dsn, $user, $password);
$authController = new AuthController($authService);
echo 'works';

switch ($_SERVER['REQUEST_METHOD']) {
  case 'POST':
//    $content = file_get_contents("php://input");
//    $body = json_decode($content, true);
    $body = [
      'login' => $_POST['login'],
      'password' => $_POST['password']
    ];
    var_dump($_POST);

    $authController->login($body);
    break;
  case 'GET':
    $authController->logout();
    break;
  default:
    echo json_encode(['error' => 'Запрашивамого адреса не существует']);
    return;
}
