<?php session_start(); ?>
<?php
// 還沒登入的話要跳轉出去
if (!isset($_SESSION["username"])) {
    header("Location:member_error.php");
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

    $selectSQL = "SELECT * FROM `members` WHERE `members_name` = '$_SESSION[username]'";
    //來一段SQL的SELECT語法吧

    $myData = $myconnect->query($selectSQL);
    //執行上面那段SQL語法並將所得資料放進 $myData
    if ($myData->num_rows > 0) {
        $row = $myData->fetch_assoc();
    }
    ?>


    <h1>會員資料更新</h1>
    <form action="member_mod2.php" method="post">
        <label>會員帳號</label>
        <input type="text" name="members_name" value="<?php echo $row["members_name"] ?>" disabled>
        <br>
        <label>會員密碼</label>
        <input type="password" name="members_pw" value="<?php echo $row["members_pw"] ?>">
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