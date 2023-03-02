<nav style="background-color:#ff0;text-align: right;font-weight: bold;">
    <a href="index.php">回首頁</a>|
    <?php
    if (!isset($_SESSION["username"])) {
        //還沒登入
    ?>
        <a href="member_add.php">加入會員</a>|
        <a href="member_login.php">會員登入</a>
    <?php } else { //已經登入 
    ?>
        <span>歡迎《<?php echo $_SESSION["userlevelname"]; ?>》 <?php echo $_SESSION["username"] ?> 您回來</span>|
        <a href="forum_add.php">發表新主題</a>
        <a href="my_topic.php">我的主題</a>
        <a href="my_level.php">我的等級</a>
        <a href="member_mod.php">更新會員資料</a>
        <a href="member_photo.php">更新大頭照</a>
        <a href="member_logout.php">會員登出</a>

        <?php
        if ($_SESSION["userlevel"] == 5) {
        ?>
            <span style="background-color: #ff4d4d;">
                <a href="admin_forum.php">主題管理</a>
                <a href="admin_members.php">會員管理</a>
            </span>
        <?php
        }
        ?>


    <?php } ?>
</nav>