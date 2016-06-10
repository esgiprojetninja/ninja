-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 10, 2016 at 03:30 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ninja_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `type` tinyint(1) NOT NULL,
  `opened` tinyint(1) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `id_user`, `datetime`, `type`, `opened`, `message`) VALUES
(1, 42, '2016-06-10 12:13:05', 1, 0, 'Bondour'),
(2, 26, '2016-06-10 14:28:59', 1, 1, 'Bondour vous avez une notification !'),
(3, 26, '2016-06-10 14:29:22', 1, 0, 'Bondour vous avez une notification !'),
(4, 26, '2016-06-10 14:29:24', 1, 0, 'Bondour vous avez une notification !'),
(5, 26, '2016-06-10 14:38:07', 1, 0, 'Bondour vous avez une notification !'),
(6, 26, '2016-06-10 15:49:18', 1, 0, 'Bondour vous avez un nouveau message !'),
(7, 26, '2016-06-10 15:49:20', 1, 0, 'Bondour vous avez un nouveau message !'),
(8, 26, '2016-06-10 15:49:20', 1, 0, 'Bondour vous avez un nouveau message !'),
(9, 26, '2016-06-10 15:49:20', 1, 0, 'Bondour vous avez un nouveau message !'),
(10, 26, '2016-06-10 15:49:20', 1, 0, 'Bondour vous avez un nouveau message !'),
(11, 26, '2016-06-10 15:49:21', 1, 0, 'Bondour vous avez un nouveau message !'),
(12, 26, '2016-06-10 15:49:47', 1, 0, 'COUCOU VOUS ÊTES INVITÉS À UN EVENT !'),
(13, 26, '2016-06-10 15:49:48', 1, 0, 'COUCOU VOUS ÊTES INVITÉS À UN EVENT !');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
