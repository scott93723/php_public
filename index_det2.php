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
    // 使用 prepared statement 防止 SQL injection
    $stmt = $myconnect->prepare("INSERT INTO `forum_rep`( `forum_id`, `members_name`, `forum_rep_msg`) VALUES (?,?,?)");
    //來一段SQL的INSERT語法吧
    $stmt->bind_param('iss', $_POST['forum_id'], $_POST['members_name'], $_POST['forum_rep_msg']);
    $myData = $stmt->execute();
    //執行上面那段SQL語法

    $stmt2 = $myconnect->prepare("UPDATE `forum` SET `forum_rep`=`forum_rep`+1,`forum_rep_date`=NOW() WHERE `forum_id` = ?");
    //來一段SQL的UPDATE語法吧
    $stmt2->bind_param('i', $_POST['forum_id']);
    $stmt2->execute();

    //新增主題，寶石+2
    $stmt3 = $myconnect->prepare("UPDATE `members` SET `members_power` = `members_power` + 2 WHERE `members_name` = ?");
    $stmt3->bind_param('s', $_POST['members_name']);
    $stmt3->execute();


    if ($myData) {
        header("Location:index_det_rep_ok.php?id=$_POST[forum_id]");
    } else {
        // 不回顯 SQL 與資料庫錯誤細節
        echo "資料庫錯誤，請稍後再試";
    }
    ?>
</body>

</html>