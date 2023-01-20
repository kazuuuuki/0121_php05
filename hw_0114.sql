-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023 年 1 月 20 日 03:49
-- サーバのバージョン： 10.4.21-MariaDB
-- PHP のバージョン: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `hw_0114`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `movie_log`
--

CREATE TABLE `movie_log` (
  `id` int(11) NOT NULL,
  `genre` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '映画のジャンル',
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '映画のタイトル',
  `review` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'レビュー（評価）',
  `coment` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'コメント',
  `img` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '画像のpath',
  `date` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT '登録日'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `movie_log`
--

INSERT INTO `movie_log` (`id`, `genre`, `title`, `review`, `coment`, `img`, `date`) VALUES
(11, '未選択', '', '未選択', '', NULL, '');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_data`
--

CREATE TABLE `user_data` (
  `id` int(12) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_data`
--

INSERT INTO `user_data` (`id`, `name`, `email`, `lpw`, `date`) VALUES
(50, '', '', '$2y$10$sFwq1KORX/tKq8yw9kzbg.HsbagdEiEg1t939dI9RcZRmNv42MNne', '2023-01-18 10:16:14'),
(53, '', 'a', '$2y$10$aDB2ijqafnQK3AjSETxBJu3IpAiWQI60pVRDKz93mUXgk4LMvd2Je', '2023-01-18 10:16:33'),
(120, '', 'aa', '$2y$10$egLJN75aq7YxahgfM4WCEuWtGCkJ9B2qkYm/c80vJWCagW3VDXnPe', '2023-01-18 14:14:24'),
(124, '咲いて', 'ああ', '$2y$10$4mC.9uI061lkC8gpua5M0uYWFYaQxNIcbLut0EYuoZ1kB1P8ZpN6.', '2023-01-18 14:27:32'),
(125, '', 'あ', '$2y$10$af2eCT9KVoH8XzpL2/Em7OJgbJwX.bYWzVYnHtaxPNTiXE3EFngz2', '2023-01-18 14:27:40'),
(126, 'ああ', 'ああ言えばこう言う', '$2y$10$qoYwTd14P4S4N2Hf08pE.eFRgfxd8ZFzpZRsznKyPEarAUMgsNOYm', '2023-01-18 14:27:47'),
(142, 'ishikawa', 'ishi', '$2y$10$95TkW2jj6rUQkgKuf06OIu1qyUX9NMoyjEjyklARuLNrYG1O4Ep6i', '2023-01-18 14:59:35');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `movie_log`
--
ALTER TABLE `movie_log`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `movie_log`
--
ALTER TABLE `movie_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- テーブルの AUTO_INCREMENT `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
