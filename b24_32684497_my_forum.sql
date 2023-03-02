-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： sql302.byethost24.com
-- 產生時間： 2023 年 02 月 24 日 08:17
-- 伺服器版本： 10.3.27-MariaDB
-- PHP 版本： 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `b24_32684497_my_forum`
--

-- --------------------------------------------------------

--
-- 資料表結構 `forum`
--

CREATE TABLE `forum` (
  `forum_id` int(11) NOT NULL COMMENT '主索引',
  `members_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '發表人(會員外鍵)',
  `forum_title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '發表主題',
  `forum_kind` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '發表類型',
  `forum_pic` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '發表心情圖片',
  `forum_msg` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '發表內容',
  `forum_view` smallint(5) UNSIGNED NOT NULL COMMENT '人氣值',
  `forum_rep` smallint(5) UNSIGNED NOT NULL COMMENT '回覆值',
  `forum_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '發表日期',
  `forum_rep_date` datetime NOT NULL COMMENT '該主題最後一次回覆日期',
  `forum_level` tinyint(3) UNSIGNED NOT NULL COMMENT '可以看到此主題的會員等級'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='論壇';

--
-- 傾印資料表的資料 `forum`
--

INSERT INTO `forum` (`forum_id`, `members_name`, `forum_title`, `forum_kind`, `forum_pic`, `forum_msg`, `forum_view`, `forum_rep`, `forum_date`, `forum_rep_date`, `forum_level`) VALUES
(1, '小呆', '變冷了', '公告', 'pic03.gif', '要注意保暖❤️❤️❤️', 8, 1, '2022-12-09 11:29:05', '2022-12-20 20:03:26', 2),
(3, '小呆', '吃宵夜好地方', '閒聊', 'pic01.gif', '請問冬天吃宵夜的地方~~\r\n', 81, 3, '2022-12-11 11:29:05', '2022-12-20 20:47:03', 4),
(4, '小呆', '加油GOGOGO~', '閒聊', 'pic02.gif', '一級棒~\r\n一級棒~\r\n\r\n💞💞💞\r\n', 153, 1, '2022-12-12 11:29:05', '2022-12-20 20:01:40', 0),
(5, '小花', '有冬天的感覺了', '閒聊', 'pic02.gif', '要注意保暖❤💞❤', 64, 11, '2022-12-13 12:29:32', '2022-12-29 19:25:25', 0),
(6, '小花', '今天比較不冷了', '閒聊', 'pic03.gif', '如題', 5, 1, '2022-12-20 11:50:02', '2022-12-20 20:02:02', 0),
(7, '小花', '過年快到了', '公告', 'pic01.gif', 'TEST\r\n', 5, 0, '2022-12-20 11:51:50', '2022-12-20 19:51:50', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `forum_rep`
--

CREATE TABLE `forum_rep` (
  `forum_rep_id` int(11) NOT NULL COMMENT '回覆主索引',
  `forum_id` int(11) NOT NULL COMMENT '外鍵(主題)',
  `members_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '外鍵(回覆人)',
  `forum_rep_msg` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `forum_rep_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='回覆';

--
-- 傾印資料表的資料 `forum_rep`
--

INSERT INTO `forum_rep` (`forum_rep_id`, `forum_id`, `members_name`, `forum_rep_msg`, `forum_rep_date`) VALUES
(1, 3, '小花', '清大對面的宵夜街還不錯', '2022-12-20 11:23:41'),
(2, 3, '小花', '新竹有麥當勞', '2022-12-20 11:26:25'),
(9, 6, '小花', '幫推一下', '2022-12-20 12:02:02'),
(12, 5, '小花', '多穿一點喔', '2022-12-20 12:28:47'),
(13, 3, '小花', '公園乾面也很好吃', '2022-12-20 12:47:03'),
(19, 5, '小呆', '123', '2022-12-29 11:13:17'),
(20, 5, '小呆', '111', '2022-12-29 11:15:02'),
(21, 5, '小呆', 'ddd', '2022-12-29 11:15:31'),
(22, 5, '小呆', 'sdfas', '2022-12-29 11:16:09'),
(23, 5, '小呆', 'aaa', '2022-12-29 11:17:50'),
(24, 5, '小呆', 'asdf', '2022-12-29 11:19:19'),
(25, 5, '小呆', 'ddd', '2022-12-29 11:20:06'),
(26, 5, '小呆', 'aaa', '2022-12-29 11:20:35'),
(27, 5, '小呆', '11', '2022-12-29 11:25:25');

-- --------------------------------------------------------

--
-- 資料表結構 `members`
--

CREATE TABLE `members` (
  `members_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '會員帳號(主索引)',
  `members_pw` int(20) NOT NULL COMMENT '會員密碼',
  `members_level` tinyint(3) UNSIGNED NOT NULL COMMENT '會員等級(預設為0)',
  `members_power` smallint(5) UNSIGNED NOT NULL COMMENT '會員的寶石',
  `members_sex` char(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '會員性別',
  `members_birthday` date NOT NULL COMMENT '會員生日',
  `members_email` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '會員電郵',
  `members_photo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none.png' COMMENT '會員大頭照',
  `members_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '會員加入日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='會員';

--
-- 傾印資料表的資料 `members`
--

INSERT INTO `members` (`members_name`, `members_pw`, `members_level`, `members_power`, `members_sex`, `members_birthday`, `members_email`, `members_photo`, `members_date`) VALUES
('小呆', 1234, 5, 111, '男', '2022-10-10', 'myhello@yahoo.com.tw', '1669297251abc.jpg', '2022-11-17 12:03:59'),
('小和', 1234, 4, 400, '男', '2022-11-23', 'aaa@aaa.com.tw', '1672148335dog.jpg', '2022-11-22 11:04:09'),
('小花', 1234, 1, 100, '女', '1988-12-12', 'jenny9981@gmail.com', '1669295991123.jpg', '2022-11-17 13:20:37');

-- --------------------------------------------------------

--
-- 資料表結構 `members_level_name`
--

CREATE TABLE `members_level_name` (
  `members_level` tinyint(3) UNSIGNED NOT NULL,
  `members_level_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='會員等級表';

--
-- 傾印資料表的資料 `members_level_name`
--

INSERT INTO `members_level_name` (`members_level`, `members_level_name`) VALUES
(0, '初心者'),
(1, '黃金會員'),
(2, '白金會員'),
(3, '鑽石會員'),
(4, '藍鑽會員'),
(5, '最高管理員');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`forum_id`),
  ADD KEY `members_name` (`members_name`);

--
-- 資料表索引 `forum_rep`
--
ALTER TABLE `forum_rep`
  ADD PRIMARY KEY (`forum_rep_id`),
  ADD KEY `forum_id` (`forum_id`),
  ADD KEY `members_name` (`members_name`);

--
-- 資料表索引 `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`members_name`),
  ADD KEY `members_level` (`members_level`);

--
-- 資料表索引 `members_level_name`
--
ALTER TABLE `members_level_name`
  ADD PRIMARY KEY (`members_level`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `forum`
--
ALTER TABLE `forum`
  MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主索引', AUTO_INCREMENT=21;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `forum_rep`
--
ALTER TABLE `forum_rep`
  MODIFY `forum_rep_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '回覆主索引', AUTO_INCREMENT=28;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`members_name`) REFERENCES `members` (`members_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `forum_rep`
--
ALTER TABLE `forum_rep`
  ADD CONSTRAINT `forum_rep_ibfk_1` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`forum_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `forum_rep_ibfk_2` FOREIGN KEY (`members_name`) REFERENCES `members` (`members_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`members_level`) REFERENCES `members_level_name` (`members_level`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
