<?php session_start(); ?>
<?php
// 還沒登入的話要跳轉出去
if (!isset($_SESSION["username"])) {
    header("Location:member_error.php");
}
?>
<?php
if (isset($_POST["ok"])) {
    include_once("connSQL.php");
    // 連線資料庫

    $insertSQL = "INSERT INTO `forum`(`members_name`, `forum_title`, `forum_kind`, `forum_pic`, `forum_msg`, `forum_rep_date`,`forum_level`) VALUES ('$_POST[members_name]','$_POST[forum_title]','$_POST[forum_kind]','$_POST[forum_pic]','$_POST[forum_msg]',NOW(),'$_POST[forum_level]')";
    //來一段SQL的INSERT語法吧
    $myData = $myconnect->query($insertSQL);
    //執行上面那段SQL語法

    //新增主題，寶石+10
    $updateSQL = "UPDATE `members` SET `members_power` = `members_power` + 10 WHERE `members_name` = '$_POST[members_name]'";
    $myconnect->query($updateSQL);



    if ($myData) {
        header("Location:forum_add_ok.php");
    } else {
        echo "錯誤: " . $insertSQL . "<br>" . $myconnect->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>發表新主題</title>
    <!--emoji開始-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="emojionearea.min.js"></script>
    <link rel="stylesheet" href="emojionearea.min.css">
    <script type="text/javascript">
        $(document).ready(function() {
            $(".forum_msg").emojioneArea({
                pickerPosition: "left",
                tonesStyle: "bullet",
                pickerPosition: "bottom"
            });
        });
    </script>
    <!--emoji結束-->
    <style>
        .forum_msg {
            width: 500px;
        }
    </style>
</head>

<body>

    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>

    <h1>發表新主題</h1>
    <form action="" method="post">
        <label for="">會員名稱</label>
        <input type="text" name="members_name" value="<?php echo $_SESSION["username"] ?>" readonly>
        <br>
        <label for="">發表主題</label>
        <input type="text" name="forum_title">
        <br>
        <label for="">主題類型</label>
        <select name="forum_kind">
            <option value="公告">公告</option>
            <option value="新聞">新聞</option>
            <option value="閒聊">閒聊</option>
            <option value="求救">求救</option>
        </select>
        <br>
        <label for="">選擇可看到此主題的會員等級</label>
        <select name="forum_level">
            <option value="0">0初心者</option>
            <option value="1">1黃金會員</option>
            <option value="2">2白金會員</option>
            <option value="3">3鑽石會員</option>
            <option value="4">4藍鑽會員</option>
            <option value="5">5最高管理員</option>
        </select>
        <br>
        <p>發表心情</p>
        <label for="pic01">
            <img src="images/pic01.gif" alt="">
        </label>
        <input type="radio" name="forum_pic" id="pic01" value="pic01.gif" checked>

        <label for="pic02">
            <img src="images/pic02.gif" alt="">
        </label>
        <input type="radio" name="forum_pic" id="pic02" value="pic02.gif">

        <label for="pic03">
            <img src="images/pic03.gif" alt="">
        </label>
        <input type="radio" name="forum_pic" id="pic03" value="pic03.gif">

        <label for="pic04">
            <img src="images/pic04.gif" alt="">
        </label>
        <input type="radio" name="forum_pic" id="pic04" value="pic04.gif">

        <label for="pic05">
            <img src="images/pic05.gif" alt="">
        </label>
        <input type="radio" name="forum_pic" id="pic05" value="pic05.gif">

        <label for="pic06">
            <img src="images/pic06.gif" alt="">
        </label>
        <input type="radio" name="forum_pic" id="pic06" value="pic06.gif">

        <label for="pic07">
            <img src="images/pic07.gif" alt="">
        </label>
        <input type="radio" name="forum_pic" id="pic07" value="pic07.gif">

        <br>
        <label for="">發表內容</label>
        <br>
        <textarea name="forum_msg" cols="30" rows="10" class="forum_msg"></textarea>
        <br>
        <input type="hidden" name="ok" value="1">
        <button type="submit">新增主題</button>
        <button type="reset">清除內容</button>
    </form>
    <?php

    ?>
</body>

</html>