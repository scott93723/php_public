<?php session_start(); ?>
<?php
// 還沒登入的話要跳轉出去
if (!isset($_SESSION["username"])) {
    header("Location:member_error.php");
}
?>
<?php
if (isset($_GET["ok"])) {
    $_SESSION["username"] = "";
    $_SESSION["userlevel"] = "";
    unset($_SESSION["username"]);
    unset($_SESSION["userlevel"]);
    session_unset();
    session_destroy();
    header("Location:member_logout_ok.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員登出</title>
</head>

<body>
    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>
    <h1>會員登出</h1>
    <h2>確認登出嗎???</h2>
    <a href="member_logout.php?ok=1">是</a>/
    <a href="index.php">否</a>
</body>

</html>