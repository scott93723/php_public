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
    <title>Document</title>
</head>

<body>
    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>
    <?php
    if ($_FILES["file"]["error"] > 0) {
        echo "Error: " . $_FILES["file"]["error"];
    } else {
        unlink("upload/$_POST[mydel]");
        
        $aa = time();
        $bb = $aa . $_FILES["file"]["name"];
        move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $aa . $_FILES["file"]["name"]);


        include_once("connSQL.php");
        // 連線資料庫

        $updateSQL = "UPDATE `members` SET `members_photo`='$bb' WHERE  `members_name` = '$_SESSION[username]'";
        //來一段SQL的UPDATE語法吧

        $myData = $myconnect->query($updateSQL);

        if ($myData) {
            header("Location:member_photo.php");
        } else {
            echo "錯誤: " . $updateSQL . "<br>" . $myconnect->error;
        }
    }
    ?>
</body>

</html>