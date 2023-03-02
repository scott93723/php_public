<?php session_start(); ?>
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

    $updateSQL = "UPDATE `members` SET `members_pw`='$_POST[members_pw]',`members_sex`='$_POST[members_sex]',`members_birthday`='$_POST[members_birthday]',`members_email`='$_POST[members_email]' WHERE  `members_name` = '$_SESSION[username]'";
    //來一段SQL的UPDATE語法吧

    $myData = $myconnect->query($updateSQL);

    if ($myData) {
        header("Location:member_mod_ok.php");
    } else {
        echo "錯誤: " . $updateSQL . "<br>" . $myconnect->error;
    }
    ?>
</body>

</html>