<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>用户注册</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <div class="container">
        <h1>用户注册</h1>
        <form action="user_save.php" method="post">
            <p><input type="text" name="email" placeholder="Email" class="middle"/></p>
            <p><input type="password" name="password" placeholder="密码" class="middle" /></p>
            <p><input type="password" name="password2" placeholder="重置密码" class="middle"/></p>
            <p><input type="submit" value="注册" class="middle-button"></p>
        </form>
    </div>
</body>
</html>
<?php
var_dump(date("Y-m-d H:i:s"));