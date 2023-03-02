<?php
$dbhost = 'sql302.byethost24.com';
//資料庫主機位置(大部份都是localhost)
$dbuser = 'b24_32684497';
//資料庫使用者 登入帳號(xampp預設是root最高權限登入)
$dbpw = '123456';
//資料庫使用者 登入密碼(xampp預設是密碼是空的)
$database = 'b24_32684497_my_forum';
//資料庫名稱
$myconnect = new mysqli($dbhost, $dbuser, $dbpw, $database);
//建立資料庫連線 實體化mysqli(資料庫主機位置, 登入帳號, 登入密碼, 資料庫名稱)
/*
if ($myconnect->connect_error) {
    die("連線失敗: " . $myconnect->connect_error);
} else {
    echo "連線成功";
}
*/
$myconnect->set_charset("utf8mb4");
//設定連線utf8編碼，防止中文亂碼
