<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增主題成功</title>
    <meta http-equiv="Refresh" content="10;URL=index.php" />
</head>

<body>
    <?php
    include_once("connSQL.php");
    // 使用 prepared statement 防止 SQL injection
    $stmt = $myconnect->prepare("SELECT * FROM `members` WHERE `members_name` = ?");
    $stmt->bind_param('s', $_SESSION['username']);
    $stmt->execute();
    $myData = $stmt->get_result();
    $row = $myData->fetch_assoc();

    if ($row["members_level"] <> 5) {
        if ($row["members_power"] >= 400) {
            $mypower = 4;
        } elseif ($row["members_power"] >= 300) {
            $mypower = 3;
        } elseif ($row["members_power"] >= 200) {
            $mypower = 2;
        } elseif ($row["members_power"] >= 100) {
            $mypower = 1;
        } else {
            $mypower = 0;
        }
        // 使用 prepared statement 防止 SQL injection
        $stmtUp = $myconnect->prepare("UPDATE `members` SET `members_level` = ? WHERE `members_name` = ?");
        $stmtUp->bind_param('is', $mypower, $_SESSION['username']);
        $stmtUp->execute();
    }



    // 使用 prepared statement 防止 SQL injection
    $stmt2 = $myconnect->prepare("SELECT `members`.*,`members_level_name`.* FROM `members` INNER JOIN `members_level_name` ON `members`.`members_level` = `members_level_name`.`members_level` WHERE members_name = ?");
    //來一段SQL的SELECT語法吧
    $stmt2->bind_param('s', $_SESSION['username']);
    $stmt2->execute();

    $myData2 = $stmt2->get_result();
    //執行上面那段SQL語法並將所得資料放進 $myData

    if ($myData2->num_rows > 0) {
        $row2 = $myData2->fetch_assoc();
        $_SESSION["userlevel"] = $row2["members_level"];
        $_SESSION["userlevelname"] = $row2["members_level_name"];
    }

    ?>
    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>
    <h1>新增主題成功</h1>
    <p>您的主題已成功的寫入資料庫</p>
    <p>三秒後自動回到首頁</p>
    <p><a href="index.php">或按這裡回到首頁</a></p>
</body>

</html>