<?php


class UsersController
{

  private $service;

  public function __construct(UsersService $usersService)
  {
    $this->service = $usersService;
  }

  public function getUsers($order = 'desc')
  {
    $result = $this->service->getUsers($order);
    if (!$result) {
      echo json_encode(['error' => 'Не удалось получить пользователей']);
      return;
    }

    echo json_encode($result);
  }

  public function getUser($id)
  {
    $result = $this->service->getUser($id);
    if (!$result) {
      echo json_encode(['error' => 'Не удалось получить данного пользователя']);
      return;
    }

    echo json_encode($result);
  }

  public function changeUser($data)
  {
    echo $data;
    $result = $this->service->editUser($data);
    if (!$result)
      echo json_encode(['error' => 'Изменение не удалось']);
  }

  public function deleteUsers($ids)
  {
    if (count($ids) == 0) {
      echo json_encode(['error' => 'Передайте пользователей для удаления']);
      return;
    }
    $this->service->deleteUsers($ids);
    echo json_encode(['message' => 'Удаление выполнено успешно']);
  }

  public function addUser($body)
  {
    $result = $this->service->addUser($body);
    if (!$result) {
      echo json_encode(['error' => 'Не удалось добавить пользователя']);
    }
    echo json_encode(['id' => $result]);
  }

}


