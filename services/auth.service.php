<?php

class AuthService  {

  private $_conn = null;

  public function __construct($dsn, $user, $pass)
  {
    if (!is_null($this->_conn)) {
      return $this->_conn;
    }
    $this->_conn = false;
    try {
      $this->_conn = new PDO($dsn, $user, $pass);
      $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
    return $this->_conn;
  }


  public function getAdmin($login, $password) {
    $sql = "SELECT login, password FROM admins where login=? AND password=?";
    $stmt = $this->_conn->prepare($sql);
    $stmt->execute([$login, $password]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

}