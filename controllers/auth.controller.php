<?php

class AuthController {

  private $service;
  private $baseUrl = 'http://localhost:8888/';

  public function __construct(AuthService $authService)
  {
    $this->service = $authService;
  }

  public function login($body) {
    $result = $this->service->getAdmin($body['login'], $body['password']);
    if (empty($result)) {
      echo json_encode(['error' => 'Не удалось войти']);
      return;
    }
    session_start();
    $_SESSION['username'] = $body['login'];
    setcookie('username', $body['login'], time() + 60*60*24);
    header('Location:'.$this->baseUrl.'users.php');
  }

  static function checkSession() {
    session_start();
    if ($_SESSION['username']) return;
    echo json_encode(['error' => 'Вы не авторизованы']);
  }

  public function logout() {
    session_start();
    unset($_SESSION['username']);
    session_destroy();
    header('Location:'.$this->baseUrl.'login.php');
  }
}