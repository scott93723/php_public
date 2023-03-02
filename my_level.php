<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>等級清單</title>
</head>

<body>
    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>
    <h2>等級清單</h2>
    <h3>您目前的等級</h3>
    <p>
        <?php

        include_once("connSQL.php");
        $selectSQL2 = "SELECT * FROM `members` WHERE `members_name` = '$_SESSION[username]'";
        //來一段SQL的SELECT語法吧
        $myData2 = $myconnect->query($selectSQL2);
        $row2 = $myData2->fetch_assoc();


        echo $_SESSION["userlevel"];
        echo $_SESSION["userlevelname"];
        echo "<br>";
        echo "您的寶石數：" . $row2["members_power"];
        echo "<h3>本網站會員等級清單</h3>";


        $selectSQL = "SELECT * FROM `members_level_name` WHERE `members_level` <=4";
        //來一段SQL的SELECT語法吧

        $myData = $myconnect->query($selectSQL);
        //執行上面那段SQL語法並將所得資料放進 $myData


        if ($myData->num_rows > 0) {
            //有資料筆數大於0時才執行

            //印出總共的資料筆數

            while ($row = $myData->fetch_assoc()) {
                //將陣列資料中的Key值設定為該欄位的欄位名稱，並依序放進$row中   
        ?>
    <div style="color:#ff0000;">
        <?php echo $row["members_level"]; ?>
        <?php echo $row["members_level_name"]; ?>
        <br>
    </div>
<?php
            }
            echo "<p>請多發表主題/回覆，來增加等級</p>";
            echo "<br>";
            echo "<p>每發表一個主題，可得到10個寶石</p>";
            echo "<p>每回覆主題，可得到2個寶石</p>";
            echo "<p>寶石數每滿100，即可提升一個等級</p>";
        } else { //沒有資料時顯示
            echo '沒有資料';
        }
?>
</p>
</body>

</html>