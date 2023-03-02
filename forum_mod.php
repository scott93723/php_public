<?php
session_start();
include_once("connSQL.php");
// 連線資料庫
?>
<?php
// 還沒登入的話要跳轉出去
if (!isset($_SESSION["username"])) {
    header("Location:member_error.php");
}
?>
<?php
if (isset($_POST["ok"])) {
    $updateSQL = "UPDATE `forum` SET `forum_title`='$_POST[forum_title]',`forum_kind`='$_POST[forum_kind]',`forum_pic`='$_POST[forum_pic]',`forum_msg`='$_POST[forum_msg]',`forum_level`='$_POST[forum_level]' WHERE `forum_id` = '$_POST[forum_id]'";
    //來一段SQL的UPDATE語法吧

    $myData2 = $myconnect->query($updateSQL);

    if ($myData2) {
        header("Location:forum_mod_ok.php");
        die();
    } else {
        echo "錯誤: " . $updateSQL . "<br>" . $myconnect->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>更新主題</title>
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

    <h1>更新主題</h1>
    <?php
    $selectSQL = "SELECT * FROM `forum` WHERE `forum_id` = '$_GET[id]'";
    //來一段SQL的SELECT語法吧

    $myData = $myconnect->query($selectSQL);
    //執行上面那段SQL語法並將所得資料放進 $myData
    if ($myData->num_rows > 0) {
        $row = $myData->fetch_assoc();
    }
    // 如果不是登入者的主題要跳轉出去
    if ($_SESSION["username"] != $row["members_name"]) {
        header("Location:member_ng.php");
    }
    ?>


    <form action="forum_mod.php" method="post">
        <label for="">會員名稱</label>
        <input type="text" name="members_name" value="<?php echo $row["members_name"] ?>" disabled>
        <br>
        <label for="">發表主題</label>
        <input type="text" name="forum_title" value="<?php echo $row["forum_title"] ?>">
        <br>
        <label for="">主題類型</label>
        <select name="forum_kind">
            <option value="公告" <?php if ($row["forum_kind"] == "公告") {
                                    echo "selected";
                                }
                                ?>>公告</option>
            <option value="新聞" <?php if ($row["forum_kind"] == "新聞") {
                                    echo "selected";
                                }
                                ?>>新聞</option>
            <option value="閒聊" <?php if ($row["forum_kind"] == "閒聊") {
                                    echo "selected";
                                }
                                ?>>閒聊</option>
            <option value="求救" <?php if ($row["forum_kind"] == "求救") {
                                    echo "selected";
                                }
                                ?>>求救</option>
        </select>
        <br>
        <label for="">選擇可看到此主題的會員等級</label>
        <select name="forum_level">
            <option value="0" <?php if ($row["forum_level"] == 0) {
                                    echo "selected";
                                }
                                ?>>0初心者</option>
            <option value="1" <?php if ($row["forum_level"] == 1) {
                                    echo "selected";
                                }
                                ?>>1黃金會員</option>
            <option value="2" <?php if ($row["forum_level"] == 2) {
                                    echo "selected";
                                }
                                ?>>2白金會員</option>
            <option value="3" <?php if ($row["forum_level"] == 3) {
                                    echo "selected";
                                }
                                ?>>3鑽石會員</option>
            <option value="4" <?php if ($row["forum_level"] == 4) {
                                    echo "selected";
                                }
                                ?>>4藍鑽會員</option>
            <option value="5" <?php if ($row["forum_level"] == 5) {
                                    echo "selected";
                                }
                                ?>>5最高管理員</option>
        </select>
        <br>
        <p>發表心情</p>
        <label for="pic01">
            <img src="images/pic01.gif" alt="">
        </label>
        <input type="radio" name="forum_pic" id="pic01" value="pic01.gif" <?php if ($row["forum_pic"] == "pic01.gif") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>>

        <label for="pic02">
            <img src="images/pic02.gif" alt="">
        </label>
        <input type="radio" name="forum_pic" id="pic02" value="pic02.gif" <?php if ($row["forum_pic"] == "pic02.gif") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>>

        <label for="pic03">
            <img src="images/pic03.gif" alt="">
        </label>
        <input type="radio" name="forum_pic" id="pic03" value="pic03.gif" <?php if ($row["forum_pic"] == "pic03.gif") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>>

        <label for="pic04">
            <img src="images/pic04.gif" alt="">
        </label>
        <input type="radio" name="forum_pic" id="pic04" value="pic04.gif" <?php if ($row["forum_pic"] == "pic04.gif") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>>

        <label for="pic05">
            <img src="images/pic05.gif" alt="">
        </label>
        <input type="radio" name="forum_pic" id="pic05" value="pic05.gif" <?php if ($row["forum_pic"] == "pic05.gif") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>>

        <label for="pic06">
            <img src="images/pic06.gif" alt="">
        </label>
        <input type="radio" name="forum_pic" id="pic06" value="pic06.gif" <?php if ($row["forum_pic"] == "pic06.gif") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>>

        <label for="pic07">
            <img src="images/pic07.gif" alt="">
        </label>
        <input type="radio" name="forum_pic" id="pic07" value="pic07.gif" <?php if ($row["forum_pic"] == "pic07.gif") {
                                                                                echo "checked";
                                                                            }
                                                                            ?>>

        <br>
        <label for="">發表內容</label>
        <br>
        <textarea name="forum_msg" cols="30" rows="10" class="forum_msg"><?php echo $row["forum_msg"] ?></textarea>
        <br>
        <input type="hidden" name="forum_id" value="<?php echo $_GET["id"]; ?>">
        <input type="hidden" name="ok" value="1">
        <button type="submit">更新主題</button>
    </form>

</body>

</html>