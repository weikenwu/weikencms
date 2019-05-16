-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2019-04-09 08:20:58
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- 表的结构 `cms_content`
--

CREATE TABLE IF NOT EXISTS `cms_content` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//编号',
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '//标题',
  `nav` mediumint(8) unsigned NOT NULL COMMENT '//栏目号',
  `attr` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '//属性',
  `tag` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '//标签',
  `keyword` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '//关键字',
  `thumbnail` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '//缩略图',
  `source` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '//文章来源',
  `author` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '//作者',
  `info` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '//简介',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '//详细内容',
  `commend` tinyint(1) NOT NULL DEFAULT '1' COMMENT '//评论开关',
  `count` smallint(6) NOT NULL DEFAULT '0' COMMENT '//浏览次数',
  `gold` tinyint(6) NOT NULL DEFAULT '0' COMMENT '//金币',
  `sort` tinyint(1) NOT NULL DEFAULT '0' COMMENT '//排序',
  `readlimit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '//阅读权限',
  `color` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '//颜色',
  `date` datetime NOT NULL COMMENT '//发布时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `cms_level`
--

CREATE TABLE IF NOT EXISTS `cms_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_info` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `cms_level`
--

INSERT INTO `cms_level` (`id`, `level_name`, `level_info`) VALUES
(1, '超级管理员', '管理所有栏目'),
(2, '普通管理员', '普通管理员普通管理员');

-- --------------------------------------------------------

--
-- 表的结构 `cms_manage`
--

CREATE TABLE IF NOT EXISTS `cms_manage` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_user` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `admin_pass` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(10) NOT NULL,
  `login_count` int(10) NOT NULL,
  `last_ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0000.0000.0000.0000',
  `last_time` datetime DEFAULT NULL,
  `reg_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `cms_manage`
--

INSERT INTO `cms_manage` (`id`, `admin_user`, `admin_pass`, `level`, `login_count`, `last_ip`, `last_time`, `reg_time`) VALUES
(1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 3, '::1', '2019-04-09 09:41:17', NULL),
(2, 'weiwei', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, 0, '0000.0000.0000.0000', NULL, '2019-04-07 17:10:19');

-- --------------------------------------------------------

--
-- 表的结构 `cms_nav`
--

CREATE TABLE IF NOT EXISTS `cms_nav` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nav_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nav_info` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pid` int(10) NOT NULL DEFAULT '0',
  `sort` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `cms_nav`
--

INSERT INTO `cms_nav` (`id`, `nav_name`, `nav_info`, `pid`, `sort`) VALUES
(1, '军事新闻', '军事新闻军事新闻军事新闻军事新闻', 0, 3),
(2, '娱乐新闻', '娱乐新闻娱乐新闻娱乐新闻', 0, 2),
(3, '日本军事', '日本军事日本军事日本军事', 1, 3),
(4, '韩国军事', '韩国军事韩国军事韩国军事韩国军事', 1, 4),
(5, '股票证券', '股票证券股票证券', 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
