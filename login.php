<?php
if (isset($_SESSION['username'])) header('location: users.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <div id="card" class="card">
        <form action="http://localhost:8888/handlers/auth.handler.php" method="POST">
            <input id="login" name="login" type="text" placeholder="Login" class="input" />
            <input id="password" name="password" type="password" placeholder="Password" class="input" />
            <button id="submit" type="submit" class="btn">Войти</button>
        </form>
    </div>
</body>
<!--<script type="module" src="./js/login.js"></script>-->
<!--<script type="module" src="./js/request.js"></script>-->
</html>