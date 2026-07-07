<?php
// 資料庫連線資訊改由環境變數讀取，請勿將真實帳密寫死並提交進版控。
// 部署時請設定環境變數 DB_HOST / DB_USER / DB_PASSWORD / DB_NAME，
// 或另建一支不進版控（加入 .gitignore）的 connSQL.local.php 覆寫這些值。
// ⚠ 舊版檔案曾含正式資料庫帳密且仍存在於 git 歷史中，請務必至資料庫主機端輪換密碼。
$dbhost = getenv('DB_HOST') ?: 'localhost';
//資料庫主機位置
$dbuser = getenv('DB_USER') ?: 'your_db_user';
//資料庫使用者 登入帳號
$dbpw = getenv('DB_PASSWORD') ?: 'your_db_password';
//資料庫使用者 登入密碼
$database = getenv('DB_NAME') ?: 'your_db_name';
//資料庫名稱
$myconnect = new mysqli($dbhost, $dbuser, $dbpw, $database);
//建立資料庫連線 實體化mysqli(資料庫主機位置, 登入帳號, 登入密碼, 資料庫名稱)
$myconnect->set_charset("utf8mb4");
//設定連線utf8編碼，防止中文亂碼
