-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2016 at 02:31 PM
-- Server version: 5.6.19
-- PHP Version: 5.5.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sports`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `status` enum('deleted','active') NOT NULL DEFAULT 'active',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `updated_at`, `created_at`) VALUES
(1, '中心简介', 'active', '2015-12-16 00:12:22', '2015-12-14 00:00:00'),
(2, '教师培训', 'active', '2015-12-15 00:18:58', '2015-12-15 00:18:58'),
(3, '教学研究', 'active', '2015-12-15 00:19:09', '2015-12-15 00:19:09'),
(4, '教学资源', 'active', '2015-12-15 00:19:19', '2015-12-15 00:19:19'),
(5, '教学测评', 'active', '2015-12-15 23:55:45', '2015-12-15 23:55:45'),
(6, '对话交流', 'active', '2015-12-15 23:57:58', '2015-12-15 23:57:58'),
(7, '教学督导', 'active', '2015-12-15 23:58:22', '2015-12-15 23:58:22'),
(8, '公告通知', 'active', '2015-12-16 00:13:14', '2015-12-16 00:12:46');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `seats` smallint(5) unsigned NOT NULL,
  `status` enum('active','deleted') NOT NULL DEFAULT 'active',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `seats`, `status`, `updated_at`, `created_at`) VALUES
(1, '大教室101', 102, 'active', '2015-12-13 21:52:39', '2015-12-02 00:00:00'),
(2, '小教室104', 30, 'active', '2015-12-02 00:00:00', '2015-12-02 00:00:00'),
(3, '电子教室101', 40, 'active', '2015-12-10 21:29:10', '2015-12-10 21:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `locations_rent`
--

CREATE TABLE IF NOT EXISTS `locations_rent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL,
  `worker_id` varchar(128) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `attendees` smallint(5) unsigned NOT NULL,
  `department` varchar(128) NOT NULL,
  `renter` varchar(128) NOT NULL,
  `event` varchar(128) NOT NULL,
  `comment` text,
  `status` enum('auditing','approved','disapproved') NOT NULL DEFAULT 'auditing',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location-start_datetime` (`start_date`,`start_time`,`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `locations_rent`
--

INSERT INTO `locations_rent` (`id`, `location_id`, `worker_id`, `start_date`, `start_time`, `end_time`, `attendees`, `department`, `renter`, `event`, `comment`, `status`, `updated_at`, `created_at`) VALUES
(1, 2, 'delta003', '2015-12-09', '13:00:00', '14:00:00', 20, 'PHP', 'John', 'Hackthon', 'This is just a test', 'approved', '2015-12-02 00:00:00', '2015-12-02 00:00:00'),
(2, 1, 'delta003', '2015-12-09', '09:30:00', '11:00:00', 35, 'Java', 'Paul', 'Knowledge sharing', 'This is just another test', 'approved', '2015-12-02 00:00:00', '2015-12-02 00:00:00'),
(3, 1, 'delta003', '2015-12-08', '06:30:00', '06:45:00', 35, 'Python', 'Paul', 'Knowledge sharing', 'This is just another test', 'approved', '2015-12-02 00:00:00', '2015-12-02 00:00:00'),
(4, 1, 'delta003', '2015-12-12', '09:00:00', '10:00:00', 5, 'Backend', 'Jack', 'training', 'no comment', 'approved', '2016-01-10 17:25:26', '2015-12-05 00:12:16'),
(5, 1, 'delta003', '2015-12-12', '09:00:00', '10:00:00', 5, 'Backend', 'Jack', 'training', 'no comment', 'approved', '2015-12-10 00:01:41', '2015-12-05 00:20:48'),
(6, 1, 'delta003', '2015-12-31', '09:00:00', '10:30:00', 8, 'Server Team', 'Charles', 'meeting', 'this is still a test', 'disapproved', '2016-01-10 17:25:18', '2015-12-09 22:34:10'),
(7, 1, 'delta003', '2015-12-30', '09:15:00', '09:50:00', 2, 'Server Team', 'Charles', 'interview', 'test test', 'approved', '2015-12-10 00:00:49', '2015-12-09 23:34:38'),
(8, 1, 'delta003', '2016-02-01', '09:10:00', '11:30:00', 30, '计算机学院', 'Jack', 'meeting', 'test', 'disapproved', '2016-01-24 15:13:50', '2016-01-24 15:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `author` varchar(128) NOT NULL,
  `category_id` smallint(5) unsigned NOT NULL,
  `subcategory_id` smallint(5) unsigned NOT NULL,
  `content` text NOT NULL,
  `training_id` int(11) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `status` enum('deleted','active') NOT NULL DEFAULT 'active',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `title` (`title`),
  KEY `content` (`content`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `date`, `author`, `category_id`, `subcategory_id`, `content`, `training_id`, `document`, `status`, `updated_at`, `created_at`) VALUES
(1, '新闻标题', '2015-12-14', 'Rose', 0, 0, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;新闻内容\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', NULL, '/documents/2015-12-14/beaa0ef3515e158676641b224b0405ab.png', 'deleted', '2015-12-17 00:35:10', '2015-12-14 23:21:50'),
(2, '新闻标题', '2015-12-14', 'Rose', 0, 0, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;新闻内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', NULL, '0', 'deleted', '2015-12-17 00:35:12', '2015-12-14 23:22:49'),
(3, '新闻标题', '2015-12-15', 'Rose', 0, 0, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;文章内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', NULL, '/documents/2015-12-15/fc3cd5f3c4ec772592ad42b917e02164.png', 'deleted', '2015-12-15 00:36:16', '2015-12-15 00:36:16'),
(4, 'PHP7培训', '2015-12-17', 'Jack', 0, 3, '<p>测试上传word</p>', NULL, '/documents/2015-12-17/f630422c2678dd39b1de9c435c31a346.docx', 'deleted', '2016-01-16 19:30:43', '2015-12-17 00:38:10'),
(5, 'PHP7培训2', '2015-03-17', 'Peter', 1, 2, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容我是新闻内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', NULL, '/documents/2016-01-24/9456cca3f27eb5945095b1d50426a55a.png', 'active', '2016-01-24 15:18:18', '2015-12-17 00:55:54'),
(6, '新闻标题asdf', '2015-12-17', 'Rose', 0, 1, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;文章内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', NULL, NULL, 'deleted', '2015-12-17 01:04:39', '2015-12-17 01:00:22'),
(7, '中心概况', '2015-12-17', 'Rose', 0, 1, '<p>中心概况</p>', NULL, NULL, 'deleted', '2016-01-16 19:31:04', '2015-12-17 01:02:03'),
(8, '中心概况', '2015-12-17', 'Peter', 1, 1, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;中心概况文章内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', NULL, NULL, 'active', '2016-01-16 19:31:51', '2015-12-17 01:03:17'),
(9, 'PHP7培训20s', '2015-12-22', 'Peter0s', 1, 6, '<p>测试培训0s</p>', NULL, '/documents/2015-12-17/6ae1f9bcf5bf2635ca81cd4aa3ee8dad.png', 'active', '2015-12-17 01:17:37', '2015-12-17 01:14:53'),
(10, 'PHP7培训201s', '2015-12-22', 'Peter01s', 0, 12, '<p>测试培训01s</p>', NULL, NULL, 'deleted', '2015-12-17 01:17:08', '2015-12-17 01:15:39'),
(11, '发展规划', '2016-01-16', 'Jaffery', 1, 2, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 发展规划&nbsp; &nbsp; &nbsp; &nbsp;文章内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', NULL, NULL, 'active', '2016-01-16 19:32:51', '2016-01-16 19:32:51'),
(12, '骨干教师培训', '2016-01-16', 'Jack', 2, 8, '<p>&nbsp; &nbsp; &nbsp; &nbsp;骨干教师培训 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;文章内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', 6, NULL, 'active', '2016-01-30 17:28:15', '2016-01-16 19:57:37'),
(13, '新教师培训', '2016-01-16', 'Jack', 2, 7, '<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;新教师培训文章内容2 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>', NULL, NULL, 'active', '2016-01-16 20:25:32', '2016-01-16 20:23:38'),
(14, '公告通知1', '2016-01-16', 'Jack', 8, 14, '<p>&nbsp; &nbsp; 公告通知&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;文章内容\r\n &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>', 5, NULL, 'active', '2016-01-30 17:52:18', '2016-01-16 20:31:16'),
(15, '名师沙龙测试', '2016-03-30', 'Jack', 2, 10, '<p>名师沙龙测试</p>', 6, NULL, 'active', '2016-01-30 17:32:53', '2016-01-30 17:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` smallint(5) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `single_article` tinyint(1) NOT NULL,
  `status` enum('deleted','active') NOT NULL DEFAULT 'active',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_id` (`category_id`,`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `single_article`, `status`, `updated_at`, `created_at`) VALUES
(1, 1, '中心概况', 1, 'active', '2015-12-17 00:26:49', '2015-12-16 00:26:37'),
(2, 1, '发展规划', 0, 'active', '2015-12-16 00:32:21', '2015-12-16 00:32:21'),
(3, 6, '测试3', 1, 'deleted', '2015-12-17 00:23:05', '2015-12-16 00:39:39'),
(4, 1, '机构设置', 1, 'active', '2015-12-17 00:27:11', '2015-12-17 00:27:11'),
(5, 1, '成员构成', 1, 'active', '2015-12-17 00:27:19', '2015-12-17 00:27:19'),
(6, 1, '分中心', 0, 'active', '2015-12-17 00:27:34', '2015-12-17 00:27:34'),
(7, 2, '新教师培训', 1, 'active', '2015-12-17 00:27:58', '2015-12-17 00:27:58'),
(8, 2, '骨干教师培训', 1, 'active', '2015-12-17 00:30:24', '2015-12-17 00:28:17'),
(9, 2, '教学工作坊', 0, 'active', '2015-12-17 00:30:40', '2015-12-17 00:28:29'),
(10, 2, '名师沙龙', 0, 'active', '2015-12-17 00:31:01', '2015-12-17 00:28:40'),
(11, 2, '新视野沙龙', 0, 'active', '2015-12-17 00:30:53', '2015-12-17 00:28:48'),
(12, 2, '体育百家', 0, 'active', '2015-12-17 00:31:20', '2015-12-17 00:28:56'),
(13, 2, '教师英语培训', 1, 'active', '2015-12-17 00:31:31', '2015-12-17 00:29:09'),
(14, 8, '公告通知', 0, 'active', '2016-01-16 20:30:52', '2016-01-16 20:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE IF NOT EXISTS `trainings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1024) NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `speaker` varchar(512) NOT NULL,
  `location` varchar(1024) NOT NULL,
  `seats` smallint(6) unsigned NOT NULL,
  `seats_left` smallint(6) unsigned NOT NULL,
  `score` smallint(6) unsigned NOT NULL,
  `status` enum('deleted','active') NOT NULL DEFAULT 'active',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `trainings`
--

INSERT INTO `trainings` (`id`, `title`, `content`, `date`, `time`, `speaker`, `location`, `seats`, `seats_left`, `score`, `status`, `updated_at`, `created_at`) VALUES
(1, 'test title', 'test content2', '2015-11-30', '00:00:00', 'Lin', '大教室101', 100, 100, 5, 'active', '2016-01-24 15:08:10', '2015-11-27 16:10:18'),
(2, 'test title 2', 'test content 2', '2015-12-25', '00:00:00', 'Frank', '大教室102', 50, 49, 10, 'active', '2015-12-13 19:55:02', '2015-11-27 16:10:18'),
(3, '测试培训', '测试培训介绍', '1970-01-01', '00:00:00', '黄师傅', '小教室007', 60, 60, 8, 'active', '2015-12-06 20:32:48', '2015-12-06 20:32:48'),
(5, 'PHP7培训', '新功能培训', '2016-12-26', '10:35:00', 'Jack2', '公司会议室2', 82, 80, 6, 'active', '2016-01-31 18:48:55', '2015-12-13 19:51:03'),
(6, 'laravel 5.2培训', '我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案我是文案', '2016-02-11', '09:30:00', 'Jaffery Way', '张江科技园', 1500, 1500, 8, 'active', '2016-01-16 18:25:01', '2016-01-16 18:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `trainings_attendees`
--

CREATE TABLE IF NOT EXISTS `trainings_attendees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `training_id` mediumint(8) unsigned NOT NULL,
  `worker_id` varchar(128) NOT NULL,
  `status` enum('auditing','approved','disapproved') NOT NULL DEFAULT 'auditing',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `training_id-worker_id` (`training_id`,`worker_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `trainings_attendees`
--

INSERT INTO `trainings_attendees` (`id`, `training_id`, `worker_id`, `status`, `updated_at`, `created_at`) VALUES
(1, 1, 'delta003', 'approved', '2015-12-01 21:49:57', '2015-11-29 10:34:33'),
(2, 1, 'beta002', 'disapproved', '2015-12-01 21:54:04', '2015-11-29 12:05:45'),
(3, 1, 'alpha001', 'approved', '2015-12-01 21:54:21', '2015-11-29 12:05:53'),
(4, 2, 'delta003', 'disapproved', '2015-12-06 15:49:29', '2015-12-05 23:21:41'),
(5, 1, 'beta001', 'approved', '2016-01-10 17:17:28', '2016-01-10 17:14:30'),
(6, 6, 'beta001', 'approved', '2016-01-24 15:09:02', '2016-01-24 15:07:48'),
(7, 5, 'delta003', 'auditing', '2016-01-31 18:48:55', '2016-01-31 18:48:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `worker_id` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `salt` varchar(64) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `cellphone` varchar(128) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `accumulated_scores` smallint(3) unsigned DEFAULT '0',
  `role` enum('teacher','admin') NOT NULL DEFAULT 'teacher',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `worker_id` (`worker_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `worker_id`, `password`, `salt`, `name`, `cellphone`, `company`, `remember_token`, `accumulated_scores`, `role`, `updated_at`, `created_at`) VALUES
(1, '', 'alpha001', '', '', NULL, NULL, NULL, NULL, 5, 'teacher', '2015-12-01 21:54:21', '2015-11-28 00:00:00'),
(2, '', 'beta002', '', '', NULL, NULL, NULL, NULL, 0, 'teacher', '2015-12-01 21:47:55', '2015-11-28 00:00:00'),
(3, '', 'delta003', '', '', NULL, NULL, NULL, NULL, 5, 'teacher', '2015-12-01 21:49:57', '2015-11-28 00:00:00'),
(4, 'cc@cc.com', '', '$2y$10$kcSmviae.C8BuEPhc56EY.IQav9o.9dwfzdYYmT1sWFApIasDxGS2', '', '', '', '', NULL, 0, 'teacher', '2015-12-24 21:34:49', '2015-12-24 21:34:49'),
(5, 'cc2@cc.com', 'alpha003', '$2y$10$a4g4XxQt2XwKZcxnFY9Wq.PTb2NiZ2x9FOyO9aucj3YRhUF2/v6ti', '', 'ac', '13500000002', 'ups', NULL, 0, 'teacher', '2015-12-24 21:39:41', '2015-12-24 21:39:41'),
(6, 'beta001@gmail.com', 'beta001', '2ab9050a825891d8bf7042d4abce6ff0', 'M0953rZNap', 'Jack', '13500000004', 'sports', NULL, 11, 'admin', '2016-01-24 15:09:02', '2015-12-29 22:18:01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
