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
    <title>主題的細節頁面</title>
    <style>
        table {
            width: 800px;
            margin: 0px auto;
        }

        table,
        td {
            border: 1px solid #000;
        }

        img {
            vertical-align: middle;
        }

        .table-title {
            background-color: #cc88ff;
            font-weight: bold;
            font-size: 34px;
            font-weight: bold;
            color: #94015c;
        }

        .table-left {
            background-color: #b0d8ff;
            text-align: center;
            font-size: 24px;
            width: 30%;
        }

        .table-right {
            background-color: #73b9ff;
            text-align: center;
            font-size: 18px;
            width: 70%;
        }

        .table-footer {
            background-color: #bf0030;
            color: #fff;
        }

        .table-footer a {
            color: #fff;
        }

        h1 {
            text-align: center;
        }

        .myrep {
            width: 400px;
            margin: 0px auto;
            background-color: #f5adfe;
            border: 1px solid #000;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            color: #070e87;
        }
    </style>
</head>

<body>
    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>
    <h1>主題內容</h1>

    <?php
    // 還沒登入的話要跳轉出去
    if (!isset($_SESSION["username"])) {
        header("Location:member_error.php");
        die();
    }
    ?>

    <?php
    include_once("connSQL.php");
    // 連線資料庫
    $selectSQL = "SELECT `forum`.*,`members_level_name`.* FROM `forum` INNER JOIN `members_level_name` ON `forum`.`forum_level` = `members_level_name`.`members_level` WHERE `forum_id` = '$_GET[id]'";
    //來一段SQL的SELECT語法吧

    $myData = $myconnect->query($selectSQL);
    //執行上面那段SQL語法並將所得資料放進 $myData

    if ($myData->num_rows > 0) {
        //有資料筆數大於0時才執行
        $row = $myData->fetch_assoc();
    ?>
        <?php
        // 判斷會員等級開始 
        if ($_SESSION["userlevel"] >= $row["forum_level"] or $_SESSION["username"] == $row["members_name"]) {
        ?>

            <table>
                <tr class="table-title">
                    <td colspan="2">

                        <img src="images/<?php echo $row["forum_pic"]; ?>">
                        《<?php echo $row["forum_kind"]; ?>》
                        <?php echo $row["forum_title"]; ?>
                    </td>
                </tr>
                <tr>
                    <td class="table-left">
                        <p><?php echo $row["members_name"]; ?></p>
                        <p><?php echo $row["forum_date"]; ?></p>
                    </td>
                    <td class="table-right">
                        <p><?php echo $row["forum_msg"]; ?></p>
                    </td>
                </tr>
                <?php
                if (isset($_SESSION["username"]) and $_SESSION["username"] == $row["members_name"]) {
                ?>
                    <tr class="table-footer">
                        <td colspan="2" style="text-align: right;">
                            <a href="forum_mod.php?id=<?php echo $_GET["id"]; ?>">更新主題</a>
                            |
                            <a href="forum_del.php?id=<?php echo $_GET["id"]; ?>">刪除主題</a>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </table>


            <!-- 回覆內容 -->
            <?php
            $selectSQL2 = "SELECT * FROM `forum_rep` WHERE `forum_id` = '$_GET[id]' ORDER BY `forum_rep_date` DESC";
            //來一段SQL的SELECT語法吧

            $myData2 = $myconnect->query($selectSQL2);
            //執行上面那段SQL語法並將所得資料放進 $myData

            if ($myData2->num_rows > 0) {
                //有資料筆數大於0時才執行
            ?>
                <table>
                    <tr>
                        <td colspan="2" style="background-color: #cc88ff;">回覆內容</td>
                    </tr>
                    <?php
                    while ($row2 = $myData2->fetch_assoc()) {
                        //將陣列資料中的Key值設定為該欄位的欄位名稱，並依序放進$row中   
                    ?>
                        <tr>
                            <td>
                                <?php echo $row2["members_name"]; ?>說：
                                <br>
                                <?php echo $row2["forum_rep_msg"]; ?>
                                <br>
                                留言日期：<?php echo $row2["forum_rep_date"]; ?>
                                <br>
                               
                                <a href="admin_forum_det_del.php?rid=<?php echo $row2["forum_rep_id"]; ?>&id=<?php echo $_GET["id"];?>">刪除回覆</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            <?php
            } else {
                echo "沒有任何人回覆喔";
            }
            ?>



            <!-- 回覆表單 -->
            <div class="myrep">
                <?php
                if (isset($_SESSION["username"])) {
                ?>
                    <form action="index_det2.php" method="post">
                        <label>回覆人</label>
                        <br>
                        <input type="text" name="members_name" value="<?php echo $_SESSION["username"] ?>" readonly>
                        <br> <br>
                        <label>回覆內容</label>
                        <br>
                        <textarea name="forum_rep_msg" cols="30" rows="10"></textarea>

                        <!-- 該回覆屬於那一筆主題 -->
                        <input type="hidden" name="forum_id" value="<?php echo $_GET["id"]; ?>">

                        <br>
                        <button type="submit">回覆</button>
                    </form>

                <?php
                } else {
                    echo "登入之後才可以回覆主題喔!!";
                }
                ?>
            </div>
            <?php
            // 人氣值加1
            $updateSQL = "UPDATE `forum` SET `forum_view`=`forum_view`+1 WHERE `forum_id` = '$_GET[id]'";
            $myconnect->query($updateSQL);
            ?>

        <?php
        } else {
            echo "會員等級不足";
            echo "您的等級為：" . $_SESSION["userlevel"] . $_SESSION["userlevelname"];
            echo "<br>";
            echo "觀看等級為：" . $row["forum_level"] . $row["members_level_name"];
        }
        // 判斷會員等級結束 
        ?>
    <?php
    } else {
        echo "沒有資料";
    } ?>
</body>

</html>