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
    $insertSQL = "INSERT INTO `forum_rep`( `forum_id`, `members_name`, `forum_rep_msg`) VALUES ('$_POST[forum_id]','$_POST[members_name]','$_POST[forum_rep_msg]')";
    //來一段SQL的INSERT語法吧
    $myData = $myconnect->query($insertSQL);
    //執行上面那段SQL語法

    $updateSQL = "UPDATE `forum` SET `forum_rep`=`forum_rep`+1,`forum_rep_date`=NOW() WHERE `forum_id` = '$_POST[forum_id]'";
    //來一段SQL的UPDATE語法吧
    $myconnect->query($updateSQL);

    //新增主題，寶石+2
    $updateSQL2 = "UPDATE `members` SET `members_power` = `members_power` + 2 WHERE `members_name` = '$_POST[members_name]'";
    $myconnect->query($updateSQL2);


    if ($myData) {
        header("Location:index_det_rep_ok.php?id=$_POST[forum_id]");
    } else {
        echo "錯誤: " . $insertSQL . "<br>" . $myconnect->error;
    }
    ?>
</body>

</html>