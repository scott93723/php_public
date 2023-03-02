<?php session_start(); ?>
<?php
if ($_SESSION["userlevel"] <> 5) {
    header("Location:admin_error.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員已成功更新</title>
</head>

<body>
    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>
    <h1>會員已成功更新</h1>
    <a href="admin_members.php">請按這裡回到會員清單</a>
</body>

</html>