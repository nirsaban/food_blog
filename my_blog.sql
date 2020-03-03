-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2019 at 11:38 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `post` text NOT NULL,
  `create_at` datetime NOT NULL,
  `image` text NOT NULL,
  `how` text NOT NULL,
  `amount` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `uid`, `title`, `post`, `create_at`, `image`, `how`, `amount`) VALUES
(55, 12, ';ikliuluil', 'uiluiluilui', '2019-10-23 17:23:18', 'hero2.jpg', 'uiliuli', 'uiluiluil'),
(56, 12, 'reg', 'reg', '2019-10-23 19:57:08', '', 'rgeg', 'greg'),
(57, 12, 'gr', 'rg', '2019-10-23 19:57:18', '', 'reg', 'ergerg'),
(58, 12, 'gergeg', 'ergreg', '2019-10-23 19:57:26', '', 'gerge', 'gergeg'),
(59, 12, 'ergerg', 'ergeg', '2019-10-23 19:57:35', '', 'egrg', 'ergeg'),
(60, 12, 'ergr', 'gergre', '2019-10-23 19:57:48', '', 'gr', 'rg'),
(61, 14, 'fdhfh', 'fdh', '2019-10-23 21:28:07', 'bgc2.jpg', 'fhdfdh', 'fdhfh');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` int(11) NOT NULL,
  `update_at` datetime NOT NULL,
  `avatar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `update_at`, `avatar`) VALUES
(11, 'nir', 'admin2@gmail.com', '$2y$10$ckXh.JJ82ZAZsbiujzH7O.PIe45BxZrVWhPf2.19sR6EPl.gnZdIu', 6, '2019-10-17 21:41:12', ''),
(12, 'nir', 'nir@gmail.com', '$2y$10$sKKi3axo4acgHo.UHUqMn.oGTxgWVHwzk1rJTovXjVXrR8SU.stT.', 6, '2019-10-20 13:52:37', 'nirsa.jpg'),
(13, 'omer havar', 'admin@gmail.com', '$2y$10$kHUZEvlz9euzWUYae6BFku32P6RdvO58gcmcc6BBZYX2RsVIx3ZNi', 6, '2019-10-23 13:37:11', 'WhatsApp Image 2019-10-23 at 13.30.46(1).jpeg'),
(14, 'tsipi', 'tipi@gmail.com', '$2y$10$wuSnRB2W3cAsN9G9BSom/utOHj9X2aI.JPDlemB37qXSPgQhS8hMS', 6, '2019-10-23 21:27:20', 'nirsa.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
