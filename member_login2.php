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

    // 使用 prepared statement 防止 SQL injection：只用帳號查詢，密碼另以 password_verify 比對
    $stmt = $myconnect->prepare("SELECT `members`.*,`members_level_name`.* FROM `members` INNER JOIN `members_level_name` ON `members`.`members_level` = `members_level_name`.`members_level` WHERE members_name = ?");
    $stmt->bind_param('s', $_POST['members_name']);
    $stmt->execute();
    $myData = $stmt->get_result();

    $loginOK = false;
    $row = null;
    if ($myData && $myData->num_rows > 0) {
        $row = $myData->fetch_assoc();
        $inputPw = isset($_POST['members_pw']) ? (string)$_POST['members_pw'] : '';
        $storedPw = (string)$row['members_pw'];

        if (password_verify($inputPw, $storedPw)) {
            // 密碼已為雜湊格式，正常驗證
            $loginOK = true;
        } elseif ($storedPw !== '' && hash_equals($storedPw, $inputPw)) {
            // 相容既有明文密碼帳號：驗證成功後立即改存雜湊（一次性遷移）
            $loginOK = true;
            $newHash = password_hash($inputPw, PASSWORD_DEFAULT);
            $up = $myconnect->prepare("UPDATE `members` SET `members_pw` = ? WHERE `members_name` = ?");
            $up->bind_param('ss', $newHash, $row['members_name']);
            $up->execute();
        }
    }

    if ($loginOK) {
        $_SESSION["username"] = $row["members_name"];
        $_SESSION["userlevel"] = $row["members_level"];
        $_SESSION["userlevelname"] = $row["members_level_name"];
        header("Location:member_login_ok.php");
        die();
    } else {
        header("Location:member_login_ng.php");
        die();
    }
    ?>
</body>

</html>
