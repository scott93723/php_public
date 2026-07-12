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
    // 使用 prepared statement 防止 SQL injection
    $stmt = $myconnect->prepare("DELETE FROM `forum_rep` WHERE `forum_rep_id` = ?");
    $stmt->bind_param('i', $_GET['rid']);

    $myData = $stmt->execute();

    if ($myData) {
        header("Location:admin_forum_det.php?id=$_GET[id]");
    } else {
        // 不回顯 SQL 與資料庫錯誤細節
        echo "資料庫錯誤，請稍後再試";
    }
    ?>
</body>

</html>