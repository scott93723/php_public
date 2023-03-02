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
    <title>Document</title>
</head>

<body>
    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>
    <?php
    include_once("connSQL.php");
    // 連線資料庫


    $deleteSQL = "DELETE FROM `members` WHERE `members_name` = '$_GET[username]'";
    //來一段SQL的UPDATE語法吧

    $myData = $myconnect->query($deleteSQL);

    if ($myData) {
        header("Location:admin_members_del_ok.php");
    } else {
        echo "錯誤: " . $deleteSQL . "<br>" . $myconnect->error;
    }
    ?>
    ?>
</body>

</html>