<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>您所觀看的程式需要登入會員</title>
</head>

<body>
    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>
    <h1>您所觀看的程式需要登入會員</h1>
    <p>如果您不是本站會員，請按<a href="member_add.php">這裡</a>加入會員</p>
    <p>如果您是本站會員，請按<a href="member_login.php">這裡</a>登入會員</p>
</body>

</html>