<?php session_start(); ?>


<?php
if (isset($_POST["ok"])) {
    include_once("connSQL.php");
    // 連線資料庫

    // 使用 prepared statement 防止 SQL injection
    $stmt = $myconnect->prepare("SELECT `members_name` FROM `members` WHERE `members_name` = ?");
    $stmt->bind_param('s', $_POST['members_name']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        //帳號重覆
        header("Location:member_add_ng.php?username=" . urlencode($_POST['members_name']));
        die();
    } else {
        //沒有重覆
        //寫入會員資料開始（密碼以 password_hash 雜湊後儲存，不存明文）
        $pwHash = password_hash((string)$_POST['members_pw'], PASSWORD_DEFAULT);
        $ins = $myconnect->prepare("INSERT INTO members(members_name, members_pw, members_sex, members_birthday, members_email) VALUES (?,?,?,?,?)");
        $ins->bind_param('sssss', $_POST['members_name'], $pwHash, $_POST['members_sex'], $_POST['members_birthday'], $_POST['members_email']);
        if ($ins->execute()) {
            header("Location:member_add_OK.php");
            die();
        } else {
            // 不回顯 SQL 與資料庫錯誤細節，避免洩漏資料庫結構
            echo "新增會員失敗，請稍後再試。";
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