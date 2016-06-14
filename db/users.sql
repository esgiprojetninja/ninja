-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2016 at 01:31 PM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `favorite_sports` varchar(255) NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `token` varchar(255) NOT NULL,
  `avatar` varchar(40) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `last_connection` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `city`, `birthday`, `email`, `password`, `favorite_sports`, `access_token`, `is_active`, `username`, `phone_number`, `token`, `avatar`, `dateCreated`, `last_connection`) VALUES
(20, '', '', '', '0000-00-00', 'nicolas.cherridi@gmail.com', '34a7437c7b63d371d229e911df4ab8b4', '', '', 1, 'nicoto', '0', '6b1c7623a02a96333df051b7b028a817', '', '2016-06-10 10:40:18', '0000-00-00 00:00:00'),
(26, '', '', '', '0000-00-00', 'lambot.rom@gmail.com', '$1$Yp/.Bj0.$bwvYIhQznmAuo097lH3n9.', '', '', 1, 'popy', '0', 'ecd9885aece71d588477097e93574999', '', '2016-06-09 13:41:49', '0000-00-00 00:00:00'),
(27, '', '', '', '0000-00-00', 'nicolas.cherridi@gmail.com', '', '', '', 0, 'nicoto', '0', '0d12ad3ae8b65dfc7e5fa3beac07aa7e', '', '2016-06-09 13:47:45', '0000-00-00 00:00:00'),
(28, '', '', '', '0000-00-00', 'coucoutuveuxvoirmabible@gmail.com', '', '', '', 0, 'coucou', '0', '683d8682f300087203dca0fca25f0a10', '', '2016-06-10 12:05:16', '0000-00-00 00:00:00'),
(29, '', '', '', '0000-00-00', 'coucoutuveuxvoirmaBYTE@gmail.com', '', '', '', 0, 'coucouBYTE', '0', '0f84a6521151cedb8297d672b5bb2a70', '', '2016-06-10 13:48:57', '0000-00-00 00:00:00'),
(30, '', '', '', '0000-00-00', 'maj@maj.fr', '', '', '', 0, 'MAJ', '0', '7a32fbba1d0223e42aeae58fb813780c', '', '2016-06-10 15:07:19', '0000-00-00 00:00:00'),
(31, '', '', '', '0000-00-00', 'maaj@maj.fr', '', '', '', 0, 'MAAJ', '0', '9453a6ba83c6d716e937d194da682476', '', '2016-06-10 15:13:37', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
