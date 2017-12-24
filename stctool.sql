-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2016 at 05:25 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stctool`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_title`, `user_id`, `date_created`) VALUES
(1, 'AI Group 1', 0, '0000-00-00 00:00:00'),
(2, 'test group2', 10, '0000-00-00 00:00:00'),
(3, 'sdfghjk', 10, '2016-11-06 17:40:48'),
(4, 'dsfsfdssadsaasd', 10, '2016-11-06 20:28:52');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_content`, `user_id`, `group_id`, `date_created`, `date_modified`) VALUES
(1, '<p>sadsadsadsad</p>', 10, 3, '2016-11-06 20:33:49', '2016-11-06 15:33:49'),
(2, '<p>this is a <strong>test</strong> post</p>', 10, 3, '2016-11-06 20:35:45', '2016-11-06 15:35:45'),
(3, '<p style="text-align: center;">second test post&nbsp;</p>', 10, 3, '2016-11-06 20:39:42', '2016-11-06 15:39:42'),
(4, '<p>another tste <em>post hello</em></p>', 10, 3, '2016-11-06 20:40:49', '2016-11-06 15:40:49'),
(5, '<p>hello there!</p>', 10, 3, '2016-11-06 21:10:01', '2016-11-06 16:10:01'),
(6, '<p>This is another test post from different user</p>\r\n<ul>\r\n<li>First bullet</li>\r\n<li>Second bullet</li>\r\n</ul>\r\n<p>Final</p>', 1, 3, '2016-11-06 21:17:54', '2016-11-06 16:17:54');

-- --------------------------------------------------------

--
-- Table structure for table `posts_reply`
--

CREATE TABLE `posts_reply` (
  `reply_id` int(11) NOT NULL,
  `reply_content` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_replied` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `is_verified`, `date_added`) VALUES
(1, 'test name', 'test@test.com', 'e10adc3949ba59abbe56e057f20f883e', '34567890', 1, '2016-10-02 09:40:15'),
(5, 'test name 2', 'test2@test.com', '123456', '234567890', 0, '2016-10-02 10:02:54'),
(7, 'sdfghj', 'test2@test.com1', '345678', '45678', 0, '2016-10-02 10:21:21'),
(8, 'sdfghyj', 'test2@test.com2', '456789', '345678', 0, '2016-10-02 10:22:28'),
(9, 'dfghj', 'rtyu@ds.com', '45678', '456789', 0, '2016-10-02 10:25:33'),
(10, 'Muhammad Bilal', 'madforstrength@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '34567890', 1, '2016-10-02 10:27:18'),
(11, 'test md5', 'testmd5@test.com', 'e10adc3949ba59abbe56e057f20f883e', '34567890', 0, '2016-10-02 10:54:38');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `date_joined` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`, `date_joined`) VALUES
(1, 1, 3, '2016-11-06 18:04:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `posts_reply`
--
ALTER TABLE `posts_reply`
  ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `posts_reply`
--
ALTER TABLE `posts_reply`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
