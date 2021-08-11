<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>List</title>
  <link rel="stylesheet" href="./css/users.css">
</head>
<body>
<div class="main">
    <div class="add-container">
        <input class="info" placeholder="Фамилия" id="surname" />
        <input class="info" placeholder="Имя" id="name" />
        <input class="info" placeholder="Отчество" id="patronymic" />
        <input class="info" placeholder="Email" id="email" />
        <input class="info" placeholder="Адрес" id="address" />
    </div>
    <div class="btn-container"><button class="btn" id="add-btn" style="margin-top: 10px;">Добавить</button></div>
    <div class="add-container">
        <span>Выберите вариант сортировки</span>
        <select>
            <option selected value="asc">По возрастанию (id)</option>
            <option value="desc">По убыванию (id)</option>
        </select>
    </div>
    <div class="list"></div>
    <div class="btn-container delete"><button class="delete-btn" id="delete-btn">Удалить</button></div>
</div>
</body>

<script type="module" src="js/users.js"></script>
<script type="module" src="./js/request.js"></script>
</html>
