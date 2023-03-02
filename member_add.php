<?php session_start(); ?>


<?php
if (isset($_POST["ok"])) {
    include_once("connSQL.php");
    // 連線資料庫

    $selectSQL = "SELECT * FROM members WHERE members_name = '$_POST[members_name]'";
    //來一段SQL的SELECT語法吧

    $myData = $myconnect->query($selectSQL);
    //執行上面那段SQL語法並將所得資料放進 $myData


    if ($myData->num_rows > 0) {
        //帳號重覆
        header("Location:member_add_ng.php?username=$_POST[members_name]");
    } else {
        //沒有重覆
        //寫入會員資料開始
        $insertSQL = "INSERT INTO members(members_name, members_pw, members_sex, members_birthday, members_email) VALUES ('$_POST[members_name]','$_POST[members_pw]','$_POST[members_sex]','$_POST[members_birthday]','$_POST[members_email]')";
        //來一段SQL的INSERT語法吧
        $myData = $myconnect->query($insertSQL);
        //執行上面那段SQL語法
        if ($myData) {
            header("Location:member_add_OK.php");
        } else {
            echo "錯誤: " . $insertSQL . "<br>" . $myconnect->error;
        }
        //寫入會員資料結束
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>加入會員</title>
</head>

<body>
    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>

    <h1>加入會員</h1>
    <form action="member_add.php" method="post">
        <label>會員帳號</label>
        <input type="text" name="members_name">
        <br>
        <label>會員密碼</label>
        <input type="password" name="members_pw">
        <br>
        <p>會員性別</p>
        <label for="boy">男</label>
        <input type="radio" name="members_sex" value="男" id="boy">
        <label for="gril">女</label>
        <input type="radio" name="members_sex" value="女" id="girl">
        <br>
        <label>會員生日</label>
        <input type="date" name="members_birthday">
        <br>
        <label>會員電郵</label>
        <input type="email" name="members_email">
        <br>
        <input type="hidden" name="ok" value="1">
        <button type="submit">新增會員</button>
        <button type="reset">清除資料</button>
    </form>
</body>

</html>