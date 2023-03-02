<?php session_start(); ?>
<?php
// 還沒登入的話要跳轉出去
if (!isset($_SESSION["username"])) {
    header("Location:member_error.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員登入成功</title>
</head>

<body>
    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>
    <h1>會員登入成功</h1>
    <p>歡迎<< <?php echo $_SESSION["username"]; ?>>>您回來</p>
    <p>
    </p>
</body>

</html>