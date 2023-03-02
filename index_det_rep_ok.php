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
    <?php
    include_once("connSQL.php");
    $selectSQL = "SELECT * FROM `members` WHERE `members_name` = '$_SESSION[username]'";
    $myData = $myconnect->query($selectSQL);
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
        $updateSQL = "UPDATE `members` SET `members_level` = $mypower WHERE `members_name` = '$_SESSION[username]'";
        $myconnect->query($updateSQL);
    }


    $selectSQL2 = "SELECT `members`.*,`members_level_name`.* FROM `members` INNER JOIN `members_level_name` ON `members`.`members_level` = `members_level_name`.`members_level` WHERE members_name = '$_SESSION[username]'";
    //來一段SQL的SELECT語法吧

    $myData2 = $myconnect->query($selectSQL2);
    //執行上面那段SQL語法並將所得資料放進 $myData

    if ($myData2->num_rows > 0) {
        $row2 = $myData2->fetch_assoc();
        $_SESSION["userlevel"] = $row2["members_level"];
        $_SESSION["userlevelname"] = $row2["members_level_name"];
    }

    ?>
    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>
    <h2>回覆成功</h2>
    <p>
        <a href="index.php">請按這裡回到首頁</a>
    </p>
    <p>
        <a href="index_det.php?id=<?php echo $_GET["id"] ?>">或按這裡回到該筆主題</a>
    </p>
</body>

</html>