<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員登入</title>
</head>

<body>
    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>
    <h1>會員登入</h1>
    <form action="member_login2.php" method="post">
        <label>會員帳號</label>
        <input type="text" name="members_name">
        <br>
        <label>會員密碼</label>
        <input type="password" name="members_pw">
        <br>
        <button type="submit">會員登入</button>
    </form>
</body>

</html>