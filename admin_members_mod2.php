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
    if($_POST["members_level"]==4){
        $members_power = 400;
    }elseif($_POST["members_level"]==3){
        $members_power = 300;
    }elseif($_POST["members_level"]==2){
        $members_power = 200;
    }elseif($_POST["members_level"]==1){
        $members_power = 100;
    }elseif($_POST["members_level"]==0){
        $members_power = 0;
    }


    // 使用 prepared statement 防止 SQL injection
    $stmt = $myconnect->prepare("UPDATE `members` SET `members_pw`=?,`members_sex`=?,`members_birthday`=?,`members_email`=?,`members_level`=?,`members_power`=? WHERE `members_name` = ?");
    //來一段SQL的UPDATE語法吧
    $stmt->bind_param('ssssiis', $_POST['members_pw'], $_POST['members_sex'], $_POST['members_birthday'], $_POST['members_email'], $_POST['members_level'], $members_power, $_POST['members_name']);

    $myData = $stmt->execute();

    if ($myData) {
        header("Location:admin_members_mod_ok.php");
    } else {
        // 不回顯 SQL 與資料庫錯誤細節
        echo "資料庫錯誤，請稍後再試";
    }
    ?>
</body>

</html>