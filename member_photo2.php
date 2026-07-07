<?php session_start(); ?>
<?php
// 還沒登入的話要跳轉出去
if (!isset($_SESSION["username"])) {
    header("Location:member_error.php");
    die();
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
    if (!isset($_FILES["file"]) || $_FILES["file"]["error"] > 0) {
        echo "Error: " . (isset($_FILES["file"]) ? (int)$_FILES["file"]["error"] : 0);
    } else {
        // 上傳驗證：僅允許影像白名單副檔名，並用 getimagesize 確認為真實影像，
        // 檔名以時間戳＋亂數重新命名，不沿用使用者原始檔名（防止上傳 .php 造成 RCE）
        $ext = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
        $allowExt = array("jpg", "jpeg", "png", "gif");
        if (!in_array($ext, $allowExt, true) || getimagesize($_FILES["file"]["tmp_name"]) === false) {
            die("只允許上傳 JPG / PNG / GIF 影像檔");
        }

        // 刪除舊照片：basename 去除路徑成分並確認確實位於 upload/ 內（防路徑穿越刪除任意檔案）
        if (!empty($_POST["mydel"])) {
            $oldName = basename((string)$_POST["mydel"]);
            $oldPath = "upload/" . $oldName;
            if ($oldName !== "" && $oldName !== "none.png" && is_file($oldPath)) {
                unlink($oldPath);
            }
        }

        $bb = time() . bin2hex(random_bytes(8)) . "." . $ext;
        move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $bb);


        include_once("connSQL.php");
        // 連線資料庫

        // 使用 prepared statement 防止 SQL injection
        $stmt = $myconnect->prepare("UPDATE `members` SET `members_photo` = ? WHERE `members_name` = ?");
        $stmt->bind_param('ss', $bb, $_SESSION["username"]);

        if ($stmt->execute()) {
            header("Location:member_photo.php");
            die();
        } else {
            // 不回顯 SQL 與資料庫錯誤細節
            echo "更新大頭照失敗，請稍後再試。";
        }
    }
    ?>
</body>

</html>