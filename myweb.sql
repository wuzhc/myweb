-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-06-02 17:58:25
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myweb`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hits` int(11) DEFAULT '0',
  `comments` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '0',
  `status` smallint(6) DEFAULT '0',
  `create_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `title`, `summary`, `user_id`, `category_id`, `image_url`, `hits`, `comments`, `sort`, `status`, `create_at`) VALUES
(1, 'Yii2系列教程五：简单的用户权限管理', '上一篇文章所实现的功能还比较简单，可以发一条状态，但是不知道你注意到没有，如果是没有注册的用户也可以使用我们的应用(类似小微博)来发状态，这是不符合情理的。正确的做法是在用户没有注册，登录之前，我们甚至都不应该给没有注册的用户看到我们创建状态的页面，即是http://localhost:8999/status/create就不应该让游客看到，更不用说编辑和删除一条状态(status)了。', 1, 1, 'https://segmentfault.com/image?src=https://wt-prj.oss.aliyuncs.com/0d06af79c49d4e08abb1ab3f7ab6e860/84b4f942-b2a1-40d9-90af-90d187cd9071.png&objectId=1190000003059939&token=256d5c7b3856256964b638da2d4', 12, 1, 0, 0, 1464442858),
(2, 'php - 计算机编程语言（Hypertext Preprocessor）', 'PHP，一个嵌套的缩写名称，是英文超级文本预处理语言（PHP:Hypertext Preprocessor）的缩写。PHP 是一种 HTML 内嵌式的语言，PHP与微软的ASP颇有几分相似，都是一种在服务器端执行的嵌入HTML文档的脚本语言，语言的风格有类似于C语言，现在被很多的网站编程人员广泛的运用。', 1, 1, 'http://i2.qhimg.com/dr/270_500_/t0161159ea8ac88d849.jpg?size=550x284', 2, 2, 0, 0, 1464442858),
(9, '库里准三双汤神11三分 勇士再胜雷霆总比分3-3', '腾讯体育5月29日讯 NBA季后赛继续进行，勇士在客场以108-101击败雷霆，将西部决赛系列赛总比分追为3-3平，抢七大战将于北京时间5月31日在勇士主场进行。本场', 1, 1, 'http://myweb.cm/uploads/20160529/146090515748.jpg', 0, 0, 0, 0, 1464532307),
(11, '干豆腐干豆腐', '广东', 1, 1, 'http://myweb.cm/uploads/20160529/759ad01588a491d895d70f6c660a28a9.jpg', 0, 0, 1, 0, 1464533210),
(12, '第三方斯蒂芬斯蒂芬斯蒂芬', '是的发生的发生但是对', 1, 2, 'http://myweb.cm/uploads/20160529/677c60f0973e78fc76868c79cf5296dc.jpg', 0, 0, 0, 0, 1464533450);

-- --------------------------------------------------------

--
-- 表的结构 `article_content`
--

CREATE TABLE IF NOT EXISTS `article_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_id` (`content_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- 表的结构 `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT '0',
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT '0',
  `path` varchar(225) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `level` smallint(11) NOT NULL,
  `status` smallint(6) DEFAULT '0',
  `create_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `categories`
--

INSERT INTO `categories` (`id`, `parent`, `title`, `sort`, `path`, `level`, `status`, `create_at`) VALUES
(1, 0, '顶级大类', 0, '0-1', 1, 0, 1464442858),
(2, 1, '图片类型', 0, '0-1-2', 2, 0, 1464442858),
(3, 1, 'PHP', 0, '0-1-3', 2, 0, 1464442858),
(4, 1, '数据库', 0, '0-1-4', 2, 0, 1464442858),
(5, 4, 'MYSQL', 0, '0-1-4-5', 2, 1, 1464442858),
(6, 4, 'NoSQL', 0, '0-1-4-6', 3, 1, 1464442858),
(8, 1, 'javascript', 0, '0-1-8', 2, 0, 1464519453),
(7, 3, 'Yii2.0', 0, '0-1-3-7', 2, 0, 1464506145),
(13, 2, '室内设计模型', 0, '0-1-2-13', 3, 0, 1464610453),
(12, 2, '淘宝汽车', 0, '0-1-2-12', 3, 0, 1464610415),
(11, 3, 'thinkphp', 0, '0-1-3-11', 3, 0, 1464519589),
(10, 1, 'linux', 0, '0-1-10', 2, 1, 1464519505),
(9, 1, '网站模板', 0, '0-1-9', 2, 0, 1464519479);

-- --------------------------------------------------------

--
-- 表的结构 `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hits` int(11) DEFAULT '0',
  `comments` int(11) DEFAULT '0',
  `sort` int(11) DEFAULT '0',
  `status` smallint(6) DEFAULT '0',
  `create_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=53 ;

--
-- 转存表中的数据 `content`
--

INSERT INTO `content` (`id`, `title`, `summary`, `user_id`, `category_id`, `image_url`, `hits`, `comments`, `sort`, `status`, `create_at`) VALUES
(1, 'Yii2系列教程五：简单的用户权限管理', '上一篇文章所实现的功能还比较简单，可以发一条状态，但是不知道你注意到没有，如果是没有注册的用户也可以使用我们的应用(类似小微博)来发状态，这是不符合情理的。正确的做法是在用户没有注册，登录之前，我们甚至都不应该给没有注册的用户看到我们创建状态的页面，即是http://localhost:8999/status/create就不应该让游客看到，更不用说编辑和删除一条状态(status)了。', 1, 1, '', 12, 1, 0, 0, 1464442858),
(51, '还是', '还是', 1, 12, 'uploads/20160602/Alanah Rae 32G合集.jpg', 0, 0, 0, NULL, 1464882939),
(2, 'php - 计算机编程语言（Hypertext Preprocessor）', 'PHP，一个嵌套的缩写名称，是英文超级文本预处理语言（PHP:Hypertext Preprocessor）的缩写。PHP 是一种 HTML 内嵌式的语言，PHP与微软的ASP颇有几分相似，都是一种在服务器端执行的嵌入HTML文档的脚本语言，语言的风格有类似于C语言，现在被很多的网站编程人员广泛的运用。', 1, 1, '', 2, 2, 0, 0, 1464442858),
(50, '笨笨笨笨', '笨笨笨笨', 1, 12, 'uploads/20160602/Angela Crystal 11G合集.jpg', 0, 0, 0, 0, 1464882847),
(9, '库里准三双汤神11三分 勇士再胜雷霆总比分3-3', '腾讯体育5月29日讯 NBA季后赛继续进行，勇士在客场以108-101击败雷霆，将西部决赛系列赛总比分追为3-3平，抢七大战将于北京时间5月31日在勇士主场进行。本场', 1, 1, 'uploads/20160601/benbenla-03c.jpg', 0, 0, 0, 0, 1464532307),
(52, '哈哈哈哈哈哈', '哈哈哈哈哈哈', 1, 12, 'uploads/20160602/BrianaBanks.jpg', 0, 0, 0, 0, 1464883046),
(49, '测试2', '测是2', 1, 13, 'uploads/20160602/Ally.jpg', 0, 0, 0, 1, 1464878451);

-- --------------------------------------------------------

--
-- 表的结构 `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `article_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ext` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `create_at` int(11) NOT NULL,
  `status` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=104 ;

--
-- 转存表中的数据 `file`
--

INSERT INTO `file` (`id`, `title`, `article_id`, `type_id`, `category_id`, `url`, `ext`, `size`, `create_at`, `status`) VALUES
(85, '0616xpbz05.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/0616xpbz05.jpg', 'jpg', '197351', 1464782475, 0),
(86, '0111_1024.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/0111_1024.jpg', 'jpg', '307754', 1464782475, 0),
(82, '11.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/11.JPG', 'JPG', '221289', 1464782475, 0),
(83, '0105_1024.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/0105_1024.jpg', 'jpg', '179930', 1464782475, 0),
(84, '0605sheji51.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/0605sheji51.jpg', 'jpg', '126573', 1464782475, 0),
(80, '1.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/1.JPG', 'JPG', '153186', 1464782475, 0),
(81, '10.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/10.JPG', 'JPG', '300223', 1464782475, 0),
(79, '01.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/01.jpg', 'jpg', '201966', 1464782475, 0),
(78, 'IMG_2459.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_2459.JPG', 'JPG', '791759', 1464623039, 0),
(77, 'IMG_2457.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_2438.JPG', 'JPG', '695982', 1464623039, 0),
(76, 'IMG_2452.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_2452.JPG', 'JPG', '837523', 1464623039, 0),
(75, 'IMG_2443.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_2443.JPG', 'JPG', '906643', 1464623039, 0),
(74, 'IMG_2440.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_2440.JPG', 'JPG', '888414', 1464623039, 0),
(73, 'IMG_2438.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_2438.JPG', 'JPG', '759319', 1464623039, 0),
(72, 'IMG_2433.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_2433.JPG', 'JPG', '768575', 1464623039, 0),
(70, 'IMG_0446.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_0446.JPG', 'JPG', '985355', 1464622974, 0),
(71, 'IMG_2430.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_2430.JPG', 'JPG', '876279', 1464623039, 0),
(68, 'IMG_0412.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_0412.JPG', 'JPG', '584627', 1464622974, 0),
(69, 'IMG_0424.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_0424.JPG', 'JPG', '463369', 1464622974, 0),
(66, 'IMG_0395.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_0395.JPG', 'JPG', '659483', 1464622974, 0),
(67, 'IMG_0397.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_0397.JPG', 'JPG', '586058', 1464622974, 0),
(65, 'IMG_0390.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_0390.JPG', 'JPG', '657407', 1464622974, 0),
(64, 'IMG_0387.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_0387.JPG', 'JPG', '598147', 1464622974, 0),
(63, 'IMG_0385.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_0385.JPG', 'JPG', '614425', 1464622974, 0),
(62, 'IMG_0373.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_0373.JPG', 'JPG', '622628', 1464622974, 0),
(61, 'IMG_0369.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160530/IMG_0369.JPG', 'JPG', '630194', 1464622974, 0),
(87, '21560.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/21560.JPG', 'JPG', '131949', 1464782475, 0),
(88, '1105696795_1.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/1105696795_1.jpg', 'jpg', '113013', 1464782475, 0),
(89, '1105696798_2.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/1105696798_2.jpg', 'jpg', '179325', 1464782475, 0),
(90, '1105696803_3.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/1105696803_3.jpg', 'jpg', '111688', 1464782475, 0),
(91, '1105696806_4.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/1105696806_4.jpg', 'jpg', '125805', 1464782475, 0),
(92, '1105696811_5.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/1105696811_5.jpg', 'jpg', '149341', 1464782475, 0),
(93, '1105696814_6.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/1105696814_6.jpg', 'jpg', '145036', 1464782475, 0),
(94, '1105696818_7.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/1105696818_7.jpg', 'jpg', '114128', 1464782475, 0),
(95, '1105696822_8.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/1105696822_8.jpg', 'jpg', '142789', 1464782475, 0),
(96, '1105696825_9.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/1105696825_9.jpg', 'jpg', '147640', 1464782475, 0),
(97, '1105696828_10.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/1105696828_10.jpg', 'jpg', '139047', 1464782475, 0),
(98, '10677014281.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/10677014281.jpg', 'jpg', '97185', 1464782475, 0),
(99, '10677014432.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/10677014432.jpg', 'jpg', '193910', 1464782475, 0),
(100, '200310150193814535.JPG', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/200310150193814535.JPG', 'JPG', '288641', 1464782475, 0),
(101, '200310150275069099.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/200310150275069099.jpg', 'jpg', '85366', 1464782475, 0),
(102, '2003101422571354016.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/2003101422571354016.jpg', 'jpg', '117971', 1464782475, 0),
(103, 'IMG_20131121_231359.jpg', NULL, NULL, 13, 'http://myweb.cm/webuploader/upload/20160601/IMG_20131121_231359.jpg', 'jpg', '326667', 1464782475, 0);

-- --------------------------------------------------------

--
-- 表的结构 `image_content`
--

CREATE TABLE IF NOT EXISTS `image_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_id` int(11) DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_id` (`content_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `image_content`
--

INSERT INTO `image_content` (`id`, `content_id`, `content`) VALUES
(1, 49, 'a:23:{i:0;a:4:{i:0;s:24:"Ally Evans 20G合集.jpg";i:1;s:41:"uploads/20160602/Ally Evans 20G合集.jpg";i:2;i:78335;i:3;s:3:"jpg";}i:1;a:4:{i:0;s:28:"Amber Michaels 71G合集.jpg";i:1;s:45:"uploads/20160602/Amber Michaels 71G合集.jpg";i:2;i:95899;i:3;s:3:"jpg";}i:2;a:4:{i:0;s:25:"Amber Rayne 30G合集.jpg";i:1;s:42:"uploads/20160602/Amber Rayne 30G合集.jpg";i:2;i:99013;i:3;s:3:"jpg";}i:3;a:4:{i:0;s:24:"Amia Miley 57G合集.jpg";i:1;s:41:"uploads/20160602/Amia Miley 57G合集.jpg";i:2;i:109629;i:3;s:3:"jpg";}i:4;a:4:{i:0;s:24:"Amy Brooke 34G合集.jpg";i:1;s:41:"uploads/20160602/Amy Brooke 34G合集.jpg";i:2;i:86997;i:3;s:3:"jpg";}i:5;a:4:{i:0;s:23:"Amy Ried 118G合集.jpg";i:1;s:40:"uploads/20160602/Amy Ried 118G合集.jpg";i:2;i:20091;i:3;s:3:"jpg";}i:6;a:4:{i:0;s:28:"Anais Alexander 6G合集.jpg";i:1;s:45:"uploads/20160602/Anais Alexander 6G合集.jpg";i:2;i:133414;i:3;s:3:"jpg";}i:7;a:4:{i:0;s:30:"Anastasia Christ 16G合集.jpg";i:1;s:47:"uploads/20160602/Anastasia Christ 16G合集.jpg";i:2;i:25892;i:3;s:3:"jpg";}i:8;a:4:{i:0;s:29:"Andie Valentino 13G合集.jpg";i:1;s:46:"uploads/20160602/Andie Valentino 13G合集.jpg";i:2;i:96267;i:3;s:3:"jpg";}i:9;a:4:{i:0;s:24:"Anetta Keys 8G合集.jpg";i:1;s:41:"uploads/20160602/Anetta Keys 8G合集.jpg";i:2;i:25513;i:3;s:3:"jpg";}i:10;a:4:{i:0;s:25:"Anette Dawn 13G合集.jpg";i:1;s:42:"uploads/20160602/Anette Dawn 13G合集.jpg";i:2;i:86082;i:3;s:3:"jpg";}i:11;a:4:{i:0;s:25:"Angel Dark 150G合集.jpg";i:1;s:42:"uploads/20160602/Angel Dark 150G合集.jpg";i:2;i:72289;i:3;s:3:"jpg";}i:12;a:4:{i:0;s:24:"Angel Pink 24G合集.jpg";i:1;s:41:"uploads/20160602/Angel Pink 24G合集.jpg";i:2;i:97281;i:3;s:3:"jpg";}i:13;a:4:{i:0;s:28:"Angela Crystal 11G合集.jpg";i:1;s:45:"uploads/20160602/Angela Crystal 11G合集.jpg";i:2;i:81858;i:3;s:3:"jpg";}i:14;a:4:{i:0;s:28:"Angelica Heart 26G合集.jpg";i:1;s:45:"uploads/20160602/Angelica Heart 26G合集.jpg";i:2;i:105016;i:3;s:3:"jpg";}i:15;a:4:{i:0;s:27:"Angelina Crow 25G合集.jpg";i:1;s:44:"uploads/20160602/Angelina Crow 25G合集.jpg";i:2;i:60882;i:3;s:3:"jpg";}i:16;a:4:{i:0;s:32:"Angelina Valentine 61G合集.jpg";i:1;s:49:"uploads/20160602/Angelina Valentine 61G合集.jpg";i:2;i:75195;i:3;s:3:"jpg";}i:17;a:4:{i:0;s:25:"Anissa Kate 33G合集.jpg";i:1;s:42:"uploads/20160602/Anissa Kate 33G合集.jpg";i:2;i:86445;i:3;s:3:"jpg";}i:18;a:4:{i:0;s:25:"Anita Blond 29G合集.jpg";i:1;s:42:"uploads/20160602/Anita Blond 29G合集.jpg";i:2;i:144885;i:3;s:3:"jpg";}i:19;a:4:{i:0;s:24:"Anita Dark 45G合集.jpg";i:1;s:41:"uploads/20160602/Anita Dark 45G合集.jpg";i:2;i:111324;i:3;s:3:"jpg";}i:20;a:4:{i:0;s:24:"Anita Queen 9G合集.jpg";i:1;s:41:"uploads/20160602/Anita Queen 9G合集.jpg";i:2;i:79788;i:3;s:3:"jpg";}i:21;a:4:{i:0;s:22:"Anjelica 28G合集.jpg";i:1;s:39:"uploads/20160602/Anjelica 28G合集.jpg";i:2;i:59666;i:3;s:3:"jpg";}i:22;a:4:{i:0;s:23:"Anna Nova 38G合集.jpg";i:1;s:40:"uploads/20160602/Anna Nova 38G合集.jpg";i:2;i:77888;i:3;s:3:"jpg";}}'),
(2, NULL, 'a:14:{i:0;a:4:{i:0;s:28:"Angela Crystal 11G合集.jpg";i:1;s:45:"uploads/20160602/Angela Crystal 11G合集.jpg";i:2;i:81858;i:3;s:3:"jpg";}i:1;a:4:{i:0;s:28:"Angelica Heart 26G合集.jpg";i:1;s:45:"uploads/20160602/Angelica Heart 26G合集.jpg";i:2;i:105016;i:3;s:3:"jpg";}i:2;a:4:{i:0;s:27:"Angelina Crow 25G合集.jpg";i:1;s:44:"uploads/20160602/Angelina Crow 25G合集.jpg";i:2;i:60882;i:3;s:3:"jpg";}i:3;a:4:{i:0;s:32:"Angelina Valentine 61G合集.jpg";i:1;s:49:"uploads/20160602/Angelina Valentine 61G合集.jpg";i:2;i:75195;i:3;s:3:"jpg";}i:4;a:4:{i:0;s:25:"Anissa Kate 33G合集.jpg";i:1;s:42:"uploads/20160602/Anissa Kate 33G合集.jpg";i:2;i:86445;i:3;s:3:"jpg";}i:5;a:4:{i:0;s:25:"Anita Blond 29G合集.jpg";i:1;s:42:"uploads/20160602/Anita Blond 29G合集.jpg";i:2;i:144885;i:3;s:3:"jpg";}i:6;a:4:{i:0;s:24:"Anita Dark 45G合集.jpg";i:1;s:41:"uploads/20160602/Anita Dark 45G合集.jpg";i:2;i:111324;i:3;s:3:"jpg";}i:7;a:4:{i:0;s:24:"Anita Queen 9G合集.jpg";i:1;s:41:"uploads/20160602/Anita Queen 9G合集.jpg";i:2;i:79788;i:3;s:3:"jpg";}i:8;a:4:{i:0;s:9:"undefined";i:1;s:9:"undefined";i:2;i:0;i:3;s:9:"undefined";}i:9;a:4:{i:0;s:22:"Anjelica 28G合集.jpg";i:1;s:39:"uploads/20160602/Anjelica 28G合集.jpg";i:2;i:59666;i:3;s:3:"jpg";}i:10;a:4:{i:0;s:23:"Anna Nova 38G合集.jpg";i:1;s:40:"uploads/20160602/Anna Nova 38G合集.jpg";i:2;i:77888;i:3;s:3:"jpg";}i:11;a:4:{i:0;s:27:"Anna Sbitnaya 52G合集.jpg";i:1;s:44:"uploads/20160602/Anna Sbitnaya 52G合集.jpg";i:2;i:129867;i:3;s:3:"jpg";}i:12;a:4:{i:0;s:29:"Annette Schwarz 32G合集.jpg";i:1;s:46:"uploads/20160602/Annette Schwarz 32G合集.jpg";i:2;i:83614;i:3;s:3:"jpg";}i:13;a:4:{i:0;s:27:"April Flowers 10G合集.jpg";i:1;s:44:"uploads/20160602/April Flowers 10G合集.jpg";i:2;i:71294;i:3;s:3:"jpg";}}'),
(3, 52, 'a:1:{i:0;a:4:{i:0;s:15:"BrianaBanks.jpg";i:1;s:32:"uploads/20160602/BrianaBanks.jpg";i:2;i:103069;i:3;s:3:"jpg";}}');

-- --------------------------------------------------------

--
-- 表的结构 `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1464441994),
('m130524_201442_init', 1464441999),
('m160528_134441_categories', 1464444968),
('m160528_135409_article', 1464444970),
('m160528_150053_aritcle_content', 1464447830),
('m160530_114036_file', 1464608937);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_id` int(11) DEFAULT '0',
  `nickname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `card_id` (`card_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `phone`, `card_id`, `nickname`, `status`, `created_at`, `updated_at`) VALUES
(1, 'wuzhc', '', '$2y$13$GiaxNIibcnfka9DRCCGuc.PtL2rmr68Cz34wH9k4l4Hl.wsYHOdGK', NULL, 'wuzhencan@163.com', '14718070574', 0, '', 10, 1464442858, 1464442858);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
