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
    <title>會員資料更新</title>
</head>

<body>
    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>
    <?php
    include_once("connSQL.php");
    // 連線資料庫


    $selectSQL = "SELECT `members`.*,`members_level_name`.* FROM `members` INNER JOIN `members_level_name` ON `members`.`members_level` = `members_level_name`.`members_level` WHERE `members`.`members_name` = '$_GET[username]'";


    $myData = $myconnect->query($selectSQL);
    //執行上面那段SQL語法並將所得資料放進 $myData
    if ($myData->num_rows > 0) {
        $row = $myData->fetch_assoc();
    }
    ?>


    <h1>會員資料更新</h1>
    <form action="admin_members_mod2.php" method="post">
        <label>會員等級</label>
        <select name="members_level">
            <option value="0" <?php if ($row["members_level"] == "0") {
                                    echo "selected";
                                }
                                ?>>0初心者</option>
            <option value="1" <?php if ($row["members_level"] == "1") {
                                    echo "selected";
                                }
                                ?>>1黃金會員</option>
            <option value="2" <?php if ($row["members_level"] == "2") {
                                    echo "selected";
                                }
                                ?>>2白金會員</option>
            <option value="3" <?php if ($row["members_level"] == "3") {
                                    echo "selected";
                                }
                                ?>>3鑽石會員</option>
            <option value="4" <?php if ($row["members_level"] == "4") {
                                    echo "selected";
                                }
                                ?>>4藍鑽會員</option>
            <option value="5" <?php if ($row["members_level"] == "5") {
                                    echo "selected";
                                }
                                ?>>5最高管理員</option>
        </select>
        <br>
        <label>會員帳號</label>
        <input type="text" name="members_name" value="<?php echo $row["members_name"] ?>" readonly>
        <br>
        <label>會員密碼</label>
        <input type="text" name="members_pw" value="<?php echo $row["members_pw"] ?>">
        <br>
        <p>會員性別</p>
        <label for="boy">男</label>
        <input type="radio" name="members_sex" value="男" id="boy" <?php if ($row["members_sex"] == "男") {
                                                                        echo "checked";
                                                                    }
                                                                    ?>>
        <label for="gril">女</label>
        <input type="radio" name="members_sex" value="女" id="girl" <?php if ($row["members_sex"] == "女") {
                                                                        echo "checked";
                                                                    }
                                                                    ?>>
        <br>
        <label>會員生日</label>
        <input type="date" name="members_birthday" value="<?php echo $row["members_birthday"] ?>">
        <br>
        <label>會員電郵</label>
        <input type="email" name="members_email" value="<?php echo $row["members_email"] ?>">
        <br>
        <button type="submit">確認修改</button>
    </form>
</body>

</html>