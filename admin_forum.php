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
    <title>主題管理</title>
    <style>
        h1 {
            text-align: center;
            color: #f00;
        }

        table {
            width: 1000px;
            margin: 0px auto;
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        .table-header {
            background-color: #effd8a;
            font-weight: bold;
            font-size: 18px;
        }

        tbody tr:nth-child(odd) {
            background-color: #b1feb7;
        }

        tbody tr:nth-child(even) {
            background-color: #76fc8a;
        }

        tbody tr:hover {
            background-color: #045e02;
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
            text-align: center;
        }

        .myphoto {
            width: 100px;
            height: 100px;
            border: 5px solid #fff;
            border-radius: 10px;
            box-shadow: 3px 3px 5px 1px #000;
            background-size: cover;
            background-position: center center;
            ;
        }

        .space {
            height: 50px;
        }
    </style>
</head>

<body>
    <!-- 掛選單進來 -->
    <?php include_once("menu.php") ?>
    <h1>主題管理</h1>
    <?php
    include_once("connSQL.php");
    // 連線資料庫
    $selectSQL = "SELECT * FROM `forum` ORDER BY `forum_rep_date` DESC";
    //來一段SQL的SELECT語法吧

    $myData = $myconnect->query($selectSQL);
    //執行上面那段SQL語法並將所得資料放進 $myData

    if ($myData->num_rows > 0) {
        //有資料筆數大於0時才執行
    ?>
        <table>

            <thead class="table-header">
                <tr>
                    <th>發表主題</th>
                    <th>發表會員</th>
                    <th>人氣值</th>
                    <th>回覆值</th>
                    <th>發表時間</th>
                    <th>管理</th>
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

                            <a href="admin_forum_det.php?id=<?php echo $row["forum_id"]; ?>">
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
                        <td>
                            
                            <a href="admin_forum_mod.php?id=<?php echo $row["forum_id"]; ?>">修改</a>
                            |
                            <a href="admin_forum_del.php?id=<?php echo $row["forum_id"]; ?>">刪除</a>
                            
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot class="table-header">
                <tr>
                    <td colspan="6">
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