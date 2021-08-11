<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
    <link rel="stylesheet" href="./css/edit.css">
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
        <div class="btn-container">
            <button class="edit-btn">Изменить</button>
        </div>
    </div>
</body>
<script type="module" src="js/edit.js"></script>
<script type="module" src="js/request.js"></swcript>
</html>