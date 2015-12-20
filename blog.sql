-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2015 at 07:11 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comments_id` int(11) DEFAULT NULL,
  `comments` text
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `body`, `created`, `modified`, `user_id`, `comments_id`, `comments`) VALUES
(6, 'cake', 'Hi this is cake php', '2015-12-07 04:21:53', '2015-12-07 13:27:24', 3, NULL, 'this is commmnet'),
(7, 'hello', 'This is user', '2015-12-07 04:26:49', '2015-12-18 01:43:22', 4, NULL, 'this is the comments by user'),
(8, 'User', 'I am user', '2015-12-07 04:27:41', '2015-12-07 13:55:50', 4, NULL, 'This is a user comment (edited by admin)'),
(9, 'hi ', 'This is the articles by rohan', '2015-12-19 22:01:54', '2015-12-19 22:01:54', 4, NULL, NULL),
(10, 'heelo ', 'this is the article', '2015-12-20 06:07:16', '2015-12-20 06:07:16', 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `article_tag_relation`
--

CREATE TABLE IF NOT EXISTS `article_tag_relation` (
  `id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article_tag_relation`
--

INSERT INTO `article_tag_relation` (`id`, `article_id`, `tag_id`) VALUES
(2, 52, 1),
(3, 53, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `article_id` int(11) NOT NULL,
  `isApproved` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `article_id`, `isApproved`, `created`, `updated`) VALUES
(1, 'hehehe', 6, 0, '2015-12-19 22:03:08', '2015-12-19 22:03:08'),
(2, 'this is comment by rohan', 9, 0, '2015-12-20 06:05:54', '2015-12-20 06:05:54'),
(3, 'this is the comment by rohan\r\n', 9, 0, '2015-12-20 06:06:35', '2015-12-20 06:06:35');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`) VALUES
(3, 'nithin', '$2y$10$2Y57YBV.7hxK9fEVUWsvMuIQpv48ANq.SRJaQAXdhiAOGpdFCLCIy', 'admin', NULL, NULL),
(4, 'rohan', '$2y$10$tX.mKYrFHsFOLKJNLIpBNeznm8W06BmvndB2oIfqE3VvoqdXFsLXS', 'author', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `article_tag_relation`
--
ALTER TABLE `article_tag_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `article_tag_relation`
--
ALTER TABLE `article_tag_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
