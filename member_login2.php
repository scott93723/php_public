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

    $selectSQL = "SELECT `members`.*,`members_level_name`.* FROM `members` INNER JOIN `members_level_name` ON `members`.`members_level` = `members_level_name`.`members_level` WHERE members_name = '$_POST[members_name]' and members_pw = '$_POST[members_pw]'";
    //來一段SQL的SELECT語法吧

    $myData = $myconnect->query($selectSQL);
    //執行上面那段SQL語法並將所得資料放進 $myData

    if ($myData->num_rows > 0) {
        $row = $myData->fetch_assoc();
        $_SESSION["username"] = $row["members_name"];
        $_SESSION["userlevel"] = $row["members_level"];
        $_SESSION["userlevelname"] = $row["members_level_name"];
        header("Location:member_login_ok.php");
    } else {
        header("Location:member_login_ng.php");
    }
    ?>
</body>

</html>