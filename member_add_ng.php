<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員帳號重覆</title>
</head>

<body>
    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>
    <h1>會員帳號重覆</h1>
    <p>您選擇帳號<<<?php echo $_GET["username"]; ?>>>重覆</p>
    <a href="member_add.php">請按這裡回去重新選擇其它帳號</a>
</body>

</html>