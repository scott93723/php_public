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

    if($_GET["msgid"]=1){
        echo "新增主題成功";
        echo "<a href=index.php>按這裡回到首頁</a>";
    }elseif($_GET["msgid"]=2){
        echo "新增回覆成功";
        echo "<a href=index.php>按這裡回到首頁</a>";
    }elseif($_GET["msgid"]=3){
        echo "修改個人資料成功";
        echo "<a href=index.php>按這裡回到首頁</a>";
    }elseif($_GET["msgid"]=4){
        echo "刪除會員成功";
        echo "<a href=index.php>按這裡回到首頁</a>";
    }

    ?>
</body>

</html>