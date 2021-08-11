<?php

class UsersService {

  private $_conn;

  public function __construct($dsn, $username, $password)
  {
    if (!is_null($this->_conn)) {
      return $this->_conn;
    }
    $this->_conn = false;
    try {
      $this->_conn = new PDO($dsn, $username, $password);
      $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
    return $this->_conn;
  }

  public function getUsers($order) {
    $sql = "SELECT * from users order by `id` $order";
    $stmt = $this->_conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getUser($id) {
    $sql = "select * from users where id=?";
    $stmt = $this->_conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(2);
  }

  public function editUser($data): bool {
    try {
      $sql = "update users set name=?, surname=?, patronymic=?, email=?, address=? where id=?";
      $stmt = $this->_conn->prepare($sql);
      $stmt->execute([$data['name'], $data['surname'], $data['patronymic'], $data['email'], $data['address'], $data['id']]);
      return true;
    } catch (PDOException $e) {
      return false;
    }
  }

  public function deleteUsers($ids): bool {
    try {
      $sql = "delete from users where id=?";
      foreach ($ids as $id) {
        $stmt = $this->_conn->prepare($sql);
        $stmt->execute([$id]);
      }
      return true;
    } catch (\mysql_xdevapi\Exception $e) {
      return false;
    }

  }

  public function addUser($data) {
    $sql = "insert into users (id, name, surname, patronymic, email, address) values(NULL, ?, ?, ?, ?, ?)";
    $stmt = $this->_conn->prepare($sql);
    $stmt->execute([$data['name'], $data['surname'], $data['patronymic'], $data['email'], $data['address']]);
    return $this->_conn->lastInsertId();
  }

}