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
    $deleteSQL = "DELETE FROM `forum` WHERE `forum_id` = '$_GET[id]'";
    //來一段SQL的UPDATE語法吧

    $myData = $myconnect->query($deleteSQL);

    if ($myData) {
        header("Location:forum_del2_ok.php");
    } else {
        echo "錯誤: " . $deleteSQL . "<br>" . $myconnect->error;
    }
    ?>
</body>

</html>