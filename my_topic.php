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
    <title>主題一覽表</title>
    <style>
        h1 {
            text-align: center;
            color: #f00;
        }

        table {
            width: 1000px;
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        .table-header {
            background-color: #cc88ff;
            font-weight: bold;
            font-size: 22px;
        }

        tbody tr:nth-child(odd) {
            background-color: #b0d8ff;
        }

        tbody tr:nth-child(even) {
            background-color: #73b9ff;
        }

        tbody tr:hover {
            background-color: #002260;
            color: #fff;
            line-height: 2em;
        }

        tbody tr:hover a {
            color: #fff;
            text-decoration: none;
        }

        tbody tr {
            transition: 0.3s;
        }

        img {
            vertical-align: middle;
        }

        b{
            color: #f00;
        }
    </style>
</head>

<body>
    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>
    <h1>個人主題查詢</h1>
    <?php
    include_once("connSQL.php");
    // 連線資料庫
    $selectSQL = "SELECT * FROM `forum` WHERE `members_name` = '$_SESSION[username]'";

    
    $myData = $myconnect->query($selectSQL);
    //執行上面那段SQL語法並將所得資料放進 $myData

    if ($myData->num_rows > 0) {
        //有資料筆數大於0時才執行
    ?>
        <table>
            <tr>
                <td>
                    <form action="search.php" method="post">
                        <select name="sk">
                            <option value="forum_title">主題</option>
                            <option value="members_name">發表人</option>
                        </select>

                        請輸入關鍵字：<input type="text" name="kw">
                        <button type="submit">查詢</button>
                    </form>
                </td>
            </tr>
        </table>
        <table>

            <thead class="table-header">
                <tr>
                    <th>發表主題</th>
                    <th>發表會員</th>
                    <th>人氣值</th>
                    <th>回覆值</th>
                    <th>發表時間</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $myData->fetch_assoc()) {
                    //將陣列資料中的Key值設定為該欄位的欄位名稱，並依序放進$row中   
                ?>
                    <tr>
                        <td>
                            <?php
                            // 發表最近三天要出現new圖片
                            $my3day = date("Y-m-d", strtotime("-3 day"));
                            if ($row["forum_date"] >= $my3day) {
                                echo "<img src=images/new.gif>";
                            }
                            ?>

                            <a href="index_det.php?id=<?php echo $row["forum_id"]; ?>">
                                <strong>
                                    《<?php echo $row["forum_kind"]; ?>》
                                </strong>
                                <em>
                                    <?php echo $row["forum_title"]; ?>
                                </em>
                            </a>

                            <?php
                            //人氣值超過100要出現hot圖片
                            if ($row["forum_view"] >= 100) {
                                echo "<img src=images/hot.gif>";
                            }
                            ?>

                        </td>
                        <td><?php echo $row["members_name"]; ?></td>
                        <td><?php echo $row["forum_view"]; ?></td>
                        <td><?php echo $row["forum_rep"]; ?></td>
                        <td><?php echo $row["forum_date"]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot class="table-header">
                <tr>
                    <td colspan="5">
                        <?php
                        echo "共有 " . $myData->num_rows . " 筆主題";
                        //印出總共的資料筆數
                        ?>
                    </td>
                </tr>
            </tfoot>
        </table>

    <?php
    } else { //沒有資料時顯示
        echo '沒有資料';
    }
    ?>

</body>

</html>