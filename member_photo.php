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
    <title>會員大頭照更新</title>
    <style>
        .myphoto {
            width: 200px;
            height: 200px;
            border: 5px solid #fff;
            border-radius: 10px;
            box-shadow: 3px 3px 5px 1px #000;
            background-size: cover;
            background-position: center center;
            ;
        }
    </style>
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


    <h1>會員大頭照更新</h1>
    <div class="myphoto" style="background-image: url(upload/<?php echo $row["members_photo"] ?>)"></div>
    <br>
    <form action="member_photo2.php" method="post" enctype="multipart/form-data">
        　選擇檔案:<input type="file" name="file" id="file" /><br />
        <input type="hidden" name="mydel" value="<?php echo $row["members_photo"] ?>">
        　<input type="submit" name="submit" value="上傳檔案" />
        　</form>
</body>

</html>