-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Sam 06 Août 2016 à 16:53
-- Version du serveur :  10.1.16-MariaDB
-- Version de PHP :  7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gauch`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_edited` datetime DEFAULT NULL,
  `type` varchar(40) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `is_visible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `id_author`, `date_creation`, `date_edited`, `type`, `title`, `message`, `is_visible`) VALUES
(25, 33, '2016-08-06 01:54:46', NULL, 'Guitare', 'Ma première SG', 'Ceci est un article', 1),
(26, 33, '2016-08-06 01:54:47', NULL, 'Guitare', 'Ma première SG', 'Ceci est un article', 1),
(27, 33, '2016-08-06 01:54:48', NULL, 'Guitare', 'Ma première SG', 'Ceci est un article', 1),
(28, 33, '2016-08-06 01:54:48', NULL, 'Guitare', 'Ma première SG', 'Ceci est un article', 1),
(29, 26, '2016-08-06 01:55:19', NULL, 'Guitare', 'Ma première Les Paul', 'Ceci est un article', 1),
(30, 26, '2016-08-06 01:55:20', NULL, 'Guitare', 'Ma première Les Paul', 'Ceci est un article', 1),
(31, 26, '2016-08-06 01:55:21', NULL, 'Guitare', 'Ma première Les Paul', 'Ceci est un article', 1),
(32, 26, '2016-08-06 01:55:43', NULL, 'Guitare', 'Ma dernière Fender', 'Ceci est un article', 1),
(33, 26, '2016-08-06 01:55:44', NULL, 'Guitare', 'Ma dernière Fender', 'Ceci est un article', 1),
(34, 33, '2016-08-06 01:56:19', NULL, 'Ampli', 'Le Marshall Code 25', 'Ceci est un article', 1),
(35, 33, '2016-08-06 01:56:30', NULL, 'Ampli', 'Le Marshall Code 25', 'WAOUW', 1),
(36, 33, '2016-08-06 04:25:15', NULL, 'Ampli', 'Le Marshall Code 25', 'WAOUW', 1);

-- --------------------------------------------------------

--
-- Structure de la table `captain`
--

CREATE TABLE `captain` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL,
  `captain` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `captain`
--

INSERT INTO `captain` (`id`, `idUser`, `idTeam`, `captain`) VALUES
(1, 26, 1, 2),
(2, 26, 2, 2),
(3, 26, 3, 2),
(4, 26, 4, 2),
(5, 33, 3, 2),
(6, 26, 5, 2),
(7, 26, 6, 2),
(8, 26, 7, 2),
(9, 26, 8, 2),
(10, 26, 9, 2),
(11, 33, 10, 2),
(12, 33, 11, 2),
(13, 33, 12, 2);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_created` date NOT NULL,
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `comment`, `date_created`, `id_author`) VALUES
(71, 'Ceci est un message de test', '2016-07-24', 33),
(72, 'coucou', '2016-07-24', 33),
(73, 'coucou', '2016-07-24', 33),
(74, 'coucou', '2016-07-24', 33),
(75, 'coucou', '2016-07-24', 33),
(76, 'coucou', '2016-07-24', 33),
(77, 'Bonjour', '2016-07-25', 26),
(78, 'Bonjour', '2016-07-25', 26),
(79, 'Bonjour', '2016-07-25', 26),
(80, 'Bonjour', '2016-07-25', 26),
(81, 'bonjour', '2016-07-25', 33),
(82, 'hjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhh', '2016-07-25', 33),
(83, 'hjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhh', '2016-07-25', 33),
(84, 'hjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhh', '2016-07-25', 33),
(85, 'hjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhh', '2016-07-25', 33),
(86, 'hjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhh', '2016-07-25', 33),
(87, 'hjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhh', '2016-07-25', 33),
(88, 'hjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhh', '2016-07-25', 33),
(89, 'hjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhhhjbonjourhhhhhhhhhhhhhh', '2016-07-25', 33);

-- --------------------------------------------------------

--
-- Structure de la table `discussions_users_pivot`
--

CREATE TABLE `discussions_users_pivot` (
  `id` int(6) NOT NULL,
  `discussion_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int(6) NOT NULL,
  `name` char(50) DEFAULT NULL,
  `from_date` datetime DEFAULT NULL,
  `to_date` datetime DEFAULT NULL,
  `joignable_until` datetime DEFAULT NULL,
  `tags` longtext,
  `owner` int(6) NOT NULL,
  `description` longtext,
  `location` longtext,
  `owner_name` varchar(50) DEFAULT NULL,
  `nb_people_max` int(10) NOT NULL,
  `open` int(6) DEFAULT '0',
  `country` varchar(100) NOT NULL,
  `zipcode` int(10) NOT NULL,
  `city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `events`
--

INSERT INTO `events` (`id`, `name`, `from_date`, `to_date`, `joignable_until`, `tags`, `owner`, `description`, `location`, `owner_name`, `nb_people_max`, `open`, `country`, `zipcode`, `city`) VALUES
(31, 'Quay54', '2016-09-09 12:00:00', '2016-09-09 19:00:00', '2016-09-08 00:00:00', 'Basket', 33, 'Le célèbre event de Basket à Paris', 'Paris 13', 'Nicoto', 10, 0, '', 0, ''),
(33, 'a', '2001-01-01 00:00:00', '2002-01-01 00:00:00', '2001-01-01 00:00:00', 'aAa', 33, 'a', 'Paris', 'Nicoto', 10, 0, '', 0, ''),
(34, 'a', '2001-01-01 00:00:00', '2002-01-01 00:00:00', '2001-01-01 00:00:00', 'aAa', 33, 'a', 'Paris', 'Nicoto', 42, 0, '', 0, ''),
(35, 'Mon event', '2016-08-14 18:00:00', '2016-08-14 22:00:00', '2016-08-14 12:00:00', '#belote,#amour,#bonheur', 26, 'Un super match de belote', 'Le bistro du coin', 'POPY', 24, 0, '', 22181, 'Fairfax'),
(37, 'Bonjour', '2001-01-01 00:00:00', '2002-01-01 00:00:00', '2003-01-01 00:00:00', '#Hache', 33, 'Romain Lambot', 'DTC', 'Nicoto', 42, 0, '', 0, ''),
(38, 'Ah tu es là ?', '2001-01-01 00:00:00', '2002-01-01 00:00:00', '2003-01-01 00:00:00', '#Hache', 26, 'Romain Lambot &lt;3', 'DTC', 'popy', 42, 0, '', 0, ''),
(39, 'Ah tu es là BB ?', '2017-01-01 00:00:00', '2017-01-02 00:00:00', '2017-01-01 00:00:00', '#Hache', 26, 'Romain Lambot &lt;3 coeur', 'DTC', 'popy', 42, 0, '', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `events_users_pivot`
--

CREATE TABLE `events_users_pivot` (
  `id` int(6) NOT NULL,
  `event_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `events_users_pivot`
--

INSERT INTO `events_users_pivot` (`id`, `event_id`, `user_id`) VALUES
(25, 32, 33),
(26, 31, 33),
(27, 33, 33),
(28, 34, 33),
(29, 30, 2),
(30, 30, 33),
(31, 32, 26),
(32, 32, 30),
(33, 37, 33),
(34, 38, 26),
(35, 39, 26),
(38, 31, 26),
(39, 31, 33),
(40, 31, 33),
(41, 31, 33);

-- --------------------------------------------------------

--
-- Structure de la table `event_has_comment`
--

CREATE TABLE `event_has_comment` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `id_comment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `event_has_comment`
--

INSERT INTO `event_has_comment` (`id`, `id_event`, `id_comment`) VALUES
(7, 31, 12),
(8, 31, 13),
(9, 31, 14),
(10, 31, 15),
(11, 31, 16),
(12, 31, 17),
(13, 31, 18),
(14, 31, 19),
(15, 31, 20),
(16, 31, 21),
(17, 31, 22),
(18, 31, 23),
(19, 31, 24),
(20, 31, 25),
(21, 31, 26),
(22, 31, 27),
(23, 31, 28),
(24, 31, 29),
(25, 31, 30),
(26, 31, 31),
(27, 31, 32),
(28, 31, 33),
(29, 31, 34),
(30, 31, 35),
(31, 31, 36),
(32, 31, 37),
(33, 31, 38),
(34, 31, 39),
(35, 31, 40),
(36, 31, 41),
(37, 31, 42),
(38, 31, 43),
(39, 31, 44),
(40, 31, 45),
(41, 31, 46),
(42, 31, 47),
(43, 31, 48),
(44, 31, 49),
(45, 31, 50),
(46, 31, 51),
(47, 31, 52),
(48, 31, 53),
(49, 31, 54),
(50, 31, 55),
(51, 31, 56),
(52, 31, 57),
(53, 31, 58),
(54, 31, 59),
(55, 31, 60),
(56, 31, 61),
(57, 31, 62),
(58, 31, 63),
(59, 31, 64),
(60, 31, 65),
(61, 31, 66),
(62, 31, 67),
(63, 31, 68),
(64, 31, 69),
(65, 31, 70),
(66, 31, 71),
(67, 31, 72),
(68, 31, 73),
(69, 31, 74),
(70, 31, 75),
(71, 31, 76),
(72, 31, 77),
(73, 31, 78),
(74, 31, 79),
(75, 31, 80),
(76, 31, 81),
(77, 31, 82),
(78, 31, 83),
(79, 31, 84),
(80, 31, 85),
(81, 31, 86),
(82, 31, 87),
(83, 31, 88),
(84, 31, 89);

-- --------------------------------------------------------

--
-- Structure de la table `event_has_users`
--

CREATE TABLE `event_has_users` (
  `idEvent` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `invitations`
--

CREATE TABLE `invitations` (
  `id` int(11) NOT NULL,
  `dateInvited` datetime NOT NULL,
  `message` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `idTeamInviting` int(11) NOT NULL,
  `idUserInvited` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `invitations`
--

INSERT INTO `invitations` (`id`, `dateInvited`, `message`, `type`, `idTeamInviting`, `idUserInvited`) VALUES
(54, '2016-06-29 10:53:22', ' We need you ! ', 0, 3, 33),
(55, '2016-06-29 16:51:23', ' We need you ! ', 0, 4, 33),
(56, '2016-06-29 16:51:38', ' We need you ! ', 0, 2, 33),
(57, '2016-07-01 15:20:58', ' We need you ! ', 0, 1, 33),
(58, '2016-07-01 15:21:23', 'oui oui', 0, 5, 33),
(59, '2016-07-01 15:23:08', ' We need you ! ', 0, 9, 33),
(60, '2016-07-01 15:23:19', ' We need you ! ', 0, 8, 33),
(61, '2016-07-01 15:23:32', ' We need you ! ', 0, 7, 33),
(62, '2016-07-01 15:23:42', ' We need you ! ', 0, 6, 33);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(6) NOT NULL,
  `sender_id` int(6) NOT NULL,
  `content` longtext,
  `date` datetime DEFAULT NULL,
  `discussion_id` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `messages_reported`
--

CREATE TABLE `messages_reported` (
  `id` int(11) NOT NULL,
  `id_thread` int(11) NOT NULL,
  `id_message` int(11) NOT NULL,
  `id_user_reported` int(11) NOT NULL,
  `id_user_reporter` int(11) NOT NULL,
  `original_message` longtext NOT NULL,
  `edited_message` longtext NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `date_report` int(11) NOT NULL,
  `date_done` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `type` tinyint(1) NOT NULL,
  `opened` tinyint(1) NOT NULL,
  `message` longtext NOT NULL,
  `action` varchar(255) NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id`, `id_user`, `datetime`, `type`, `opened`, `message`, `action`, `visible`) VALUES
(71, 33, '2016-06-29 10:53:22', 1, 1, 'the team coucou  has invited you', 'http://ninja.dev/team/show/3', 1),
(72, 33, '2016-06-29 16:51:23', 1, 1, 'the team lalalalala  has invited you', 'http://ninja.dev/team/show/4', 1),
(73, 33, '2016-06-29 16:51:38', 1, 1, 'the team GEM TA SOEUR  has invited you', 'http://ninja.dev/team/show/2', 1),
(74, 33, '2016-07-01 15:20:58', 1, 1, 'the team Zobification  has invited you', 'http://ninja.dev/team/show/1', 1),
(75, 33, '2016-07-01 15:21:23', 1, 1, 'the team oneone  has invited you', 'http://ninja.dev/team/show/5', 1),
(76, 33, '2016-07-01 15:23:08', 1, 1, 'the team Majestic  has invited you', 'http://ninja.dev/team/show/9', 1),
(77, 33, '2016-07-01 15:23:19', 1, 1, 'the team nonnon  has invited you', 'http://ninja.dev/team/show/8', 1),
(78, 33, '2016-07-01 15:23:32', 1, 1, 'the team zqsd  has invited you', 'http://ninja.dev/team/show/7', 1),
(79, 33, '2016-07-01 15:23:42', 1, 1, 'the team azerty  has invited you', 'http://ninja.dev/team/show/6', 1),
(80, 33, '2016-07-26 11:18:16', 1, 1, 'Someone just joined your event, check it out !', 'http://ninja.dev/event/manage/31', 1),
(81, 33, '2016-07-26 11:18:53', 1, 1, 'Someone just joined your event, check it out !', 'http://ninja.dev/event/update/31', 1),
(82, 33, '2016-07-26 11:19:46', 1, 0, 'Someone just left your event, check it out !', 'http://ninja.dev/event/update/31', 1),
(83, 33, '2016-07-26 11:27:44', 1, 0, 'Someone just joined your event, check it out !', 'http://ninja.dev/event/update/31', 1),
(84, 26, '2016-07-26 11:32:37', 1, 0, 'The event \'.Quay54.\' has been deleted !', 'http://ninja.dev/', 1),
(85, 33, '2016-07-26 11:32:37', 1, 0, 'The event \'.Quay54.\' has been deleted !', 'http://ninja.dev/', 1),
(86, 26, '2016-07-26 11:32:45', 1, 0, 'The event \'.Quay54.\' has been deleted !', 'http://ninja.dev/', 1),
(87, 33, '2016-07-26 11:32:45', 1, 0, 'The event \'.Quay54.\' has been deleted !', 'http://ninja.dev/', 1),
(88, 26, '2016-07-26 11:32:59', 1, 0, 'The event \'.Quay54.\' has been deleted !', 'http://ninja.dev/', 1),
(89, 33, '2016-07-26 11:32:59', 1, 0, 'The event \'.Quay54.\' has been deleted !', 'http://ninja.dev/', 1),
(90, 26, '2016-07-26 11:33:22', 1, 1, 'The event Quay54 has been deleted !', 'http://ninja.dev/', 1),
(91, 33, '2016-07-26 11:33:22', 1, 0, 'The event Quay54 has been deleted !', 'http://ninja.dev/', 1),
(92, 26, '2016-07-26 11:37:23', 1, 0, 'The event Quay54 has been edited !', 'http://ninja.dev/event/update/31', 1),
(93, 33, '2016-07-26 11:37:23', 1, 0, 'The event Quay54 has been edited !', 'http://ninja.dev/event/update/31', 1),
(94, 26, '2016-07-26 11:38:12', 1, 1, 'The event Quay54 has been edited !', 'http://ninja.dev/event/update/31', 1),
(95, 26, '2016-07-26 11:42:10', 1, 1, 'The event Quay54 has been edited !', 'http://ninja.dev/event/list', 1);

-- --------------------------------------------------------

--
-- Structure de la table `sports`
--

CREATE TABLE `sports` (
  `id_sport` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sports`
--

INSERT INTO `sports` (`id_sport`, `name`) VALUES
(1, 'Accrobranche'),
(2, 'Aerobic sportive'),
(3, 'Aéromodélisme'),
(4, 'Aérostation'),
(5, 'Agility'),
(6, 'Aikido'),
(7, 'Alpinisme'),
(8, 'Apnée'),
(9, 'Aqua gym'),
(10, 'Arts martiaux artistiques'),
(11, 'Athlétisme'),
(12, 'Aviation'),
(13, 'Aviron'),
(14, 'Baby foot'),
(15, 'Badminton'),
(16, 'Ball trap'),
(17, 'Ballet sur glace'),
(18, 'Baseball'),
(19, 'Basket ball'),
(20, 'Baton défense'),
(21, 'Beach soccer'),
(22, 'Beach volley'),
(23, 'Bébé nageur'),
(24, 'Biathlon'),
(25, 'Billard'),
(26, 'BMX'),
(27, 'Bodyboard'),
(28, 'Boogie Woogie'),
(29, 'Boomerang'),
(30, 'Boule lyonnaise'),
(31, 'Bowling'),
(32, 'Boxe américaine'),
(33, 'Boxe anglaise'),
(34, 'Boxe chinoise'),
(35, 'Boxe française'),
(36, 'Boxe thaïlandaise'),
(37, 'Bridge'),
(38, 'Canne de combat'),
(39, 'Canne défense'),
(40, 'Canoë kayak'),
(41, 'Canyonisme'),
(42, 'Capoeira'),
(43, 'Carrom'),
(44, 'Cerf volant'),
(45, 'Chanbara'),
(46, 'Char à voile'),
(47, 'Cheerleading'),
(48, 'Cirque'),
(49, 'Claquettes'),
(50, 'Combat libre'),
(51, 'Combat médiéval'),
(52, 'Course à pied'),
(53, 'Course d\'orientation'),
(54, 'Cyclisme sur piste'),
(55, 'Cyclisme sur route'),
(56, 'Cyclo-cross'),
(57, 'Cyclotourisme'),
(58, 'Danse africaine'),
(59, 'Danse classique'),
(60, 'Danse contemporaine'),
(61, 'Danse country'),
(62, 'Danse espagnole'),
(63, 'Danse indienne'),
(64, 'Danse jazz'),
(65, 'Danse modern jazz'),
(66, 'Danse orientale'),
(67, 'Danse sur glace'),
(68, 'Danses caraïbes'),
(69, 'Danses de salon'),
(70, 'Danses latines'),
(71, 'Danses standards'),
(72, 'Danses swing'),
(73, 'Deltaplane'),
(74, 'Disc Golf'),
(75, 'Echecs'),
(76, 'Equitation'),
(77, 'Escalade'),
(78, 'Escrime'),
(79, 'Eveil corporel'),
(80, 'Fitness'),
(81, 'Flag'),
(82, 'Fléchettes'),
(83, 'Football'),
(84, 'Football US'),
(85, 'Force athlétique'),
(86, 'Futsal'),
(87, 'Giraviation'),
(88, 'Golf'),
(89, 'Gouren'),
(90, 'Grappling'),
(91, 'Gymnastique artistique'),
(92, 'Gymnastique douce'),
(93, 'Gymnastique rythmique'),
(94, 'Haltérophilie'),
(95, 'Handball'),
(96, 'Handisport'),
(97, 'Hapkido'),
(98, 'Hip hop'),
(99, 'Hockey subaquatique'),
(100, 'Hockey sur gazon'),
(101, 'Hockey sur glace'),
(102, 'Horse ball'),
(103, 'Iaïdo'),
(104, 'Jeet kune do'),
(105, 'Jetski'),
(106, 'Jiu-Jitsu brésilien'),
(107, 'Jodo'),
(108, 'Jorkyball'),
(109, 'Joutes nautiques'),
(110, 'Ju-Jitsu traditionnel'),
(111, 'Judo'),
(112, 'Kali Escrima'),
(113, 'Karaté'),
(114, 'Karting'),
(115, 'Kempo'),
(116, 'Kendo'),
(117, 'Kenjutsu'),
(118, 'Kick boxing'),
(119, 'Kin ball'),
(120, 'Kite surf'),
(121, 'Kobudo'),
(122, 'Krav maga'),
(123, 'Kung fu'),
(124, 'Kyudo'),
(125, 'Luge'),
(126, 'Luta livre'),
(127, 'Lutte contact'),
(128, 'Lutte gréco-romaine'),
(129, 'Lutte libre'),
(130, 'Marche athlétique'),
(131, 'Modélisme'),
(132, 'Moto cross'),
(133, 'Moto vitesse'),
(134, 'Motoneige'),
(135, 'Mountainboard'),
(136, 'Musculation'),
(137, 'Nage avec palmes'),
(138, 'Nage en eau vive'),
(139, 'Naginata'),
(140, 'Natation'),
(141, 'Natation synchronisée'),
(142, 'Ninjitsu'),
(143, 'Nunchaku'),
(144, 'Padel'),
(145, 'Paintball'),
(146, 'Pancrace'),
(147, 'Parachutisme'),
(148, 'Paramoteur'),
(149, 'Parapente'),
(150, 'Patinage artistique'),
(151, 'Pêche'),
(152, 'Pêche sous-marine'),
(153, 'Pelote basque'),
(154, 'Penchak Silat'),
(155, 'Pentathlon'),
(156, 'Pétanque'),
(157, 'Peteca'),
(158, 'Planche à voile'),
(159, 'Plongée'),
(160, 'Plongeon'),
(161, 'Qi gong'),
(162, 'Quad'),
(163, 'Quilles'),
(164, 'Qwan ki do'),
(165, 'Rafting'),
(166, 'Ragga'),
(167, 'Raid nature'),
(168, 'Rallye'),
(169, 'Randonnée équestre'),
(170, 'Randonnée pédestre'),
(171, 'Raquette à neige'),
(172, 'Rink hockey'),
(173, 'Rock'),
(174, 'Rock acrobatique'),
(175, 'Roller'),
(176, 'Roller in line hockey'),
(177, 'ROS'),
(178, 'Rugby à XIII'),
(179, 'Rugby à XV'),
(180, 'Salsa'),
(181, 'Samba'),
(182, 'Sambo'),
(183, 'Sarbacana'),
(184, 'Sarbacane'),
(185, 'Sauvetage'),
(186, 'Self défense'),
(187, 'Self Pro Krav'),
(188, 'Short track'),
(189, 'Skateboard'),
(190, 'Ski alpin'),
(191, 'Ski de fond'),
(192, 'Ski de randonnée'),
(193, 'Ski de vitesse'),
(194, 'Ski nautique'),
(195, 'Ski sur herbe'),
(196, 'Snowboard'),
(197, 'Softball'),
(198, 'Spéléologie'),
(199, 'Squash'),
(200, 'Sumo'),
(201, 'Surf'),
(202, 'Taekwondo'),
(203, 'Taï chi chuan'),
(204, 'Taï jitsu'),
(205, 'Tambourin'),
(206, 'Tango argentin'),
(207, 'Tennis'),
(208, 'Tennis de table'),
(209, 'Thaing Bando'),
(210, 'Tir à l\'arc'),
(211, 'Tir sportif'),
(212, 'Tir subaquatique'),
(213, 'Traîneaux'),
(214, 'Trampoline'),
(215, 'Triathlon'),
(216, 'Tumbling'),
(217, 'Twirling baton'),
(218, 'ULM'),
(219, 'Ultimate Frisbee'),
(220, 'Viet vo dao'),
(221, 'Voile'),
(222, 'Vol à voile'),
(223, 'Volley ball'),
(224, 'VTT'),
(225, 'Water polo'),
(226, 'Wing chun'),
(227, 'Yoga'),
(228, 'Yoseikan budo');

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `teamName` varchar(255) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `sports` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `teams`
--

INSERT INTO `teams` (`id`, `teamName`, `dateCreated`, `sports`, `description`, `avatar`) VALUES
(1, 'Zobification', '2016-06-27 19:56:50', 'ZOB', 'La bitasse !', ''),
(2, 'GEM TA SOEUR', '2016-06-27 19:58:45', '', 'SISI la famille', ''),
(3, 'coucou', '2016-06-27 19:59:48', 'PUTE', 'fdp', ''),
(4, 'lalalalala', '2016-06-27 20:17:16', '', 'oui', ''),
(5, 'oneone', '2016-07-01 15:21:11', '', 'one', ''),
(6, 'Azerty', '2016-07-01 15:22:04', '', 'azerty', ''),
(7, 'zqsd', '2016-07-01 15:22:15', 'wasd', 'zqsd', ''),
(8, 'nonnon', '2016-07-01 15:22:25', '', 'non', ''),
(9, 'Majestic', '2016-07-01 15:22:48', '', 'Zoo', ''),
(10, 'Bonjour monsieur', '2016-07-11 16:41:14', '', 'caca', ''),
(11, '*aAa*', '2016-07-19 19:23:28', '', 'La meilleure team de jeux videos ever !', ''),
(12, 'EClypsia', '2016-07-19 19:31:26', '', 'RIP Skyyart', '');

-- --------------------------------------------------------

--
-- Structure de la table `team_has_user`
--

CREATE TABLE `team_has_user` (
  `id` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `team_has_user`
--

INSERT INTO `team_has_user` (`id`, `idTeam`, `idUser`) VALUES
(1, 1, 26),
(2, 2, 26),
(3, 3, 26),
(4, 4, 26),
(5, 3, 33),
(6, 5, 26),
(7, 6, 26),
(8, 7, 26),
(9, 8, 26),
(10, 9, 26),
(11, 10, 33),
(12, 11, 33),
(13, 12, 33);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
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
  `last_connection` datetime NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zipcode` int(10) NOT NULL,
  `street` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `city`, `birthday`, `email`, `password`, `favorite_sports`, `access_token`, `is_active`, `username`, `phone_number`, `token`, `avatar`, `dateCreated`, `last_connection`, `is_admin`, `country`, `zipcode`, `street`) VALUES
(26, 'lambot', 'romain', 'Champigny', '0000-00-00', 'lambot.rom@gmail.com', 'ABxr0aR8ARW8M', '', '', 1, 'popy', '0123456789', 'a1c40b40697348054e238b9a753aed92', '', '2016-06-09 13:41:49', '0000-00-00 00:00:00', 0, 'France', 0, ''),
(28, '', '', 'Clichy', '0000-00-00', 'coucoutuveuxvoirmabible@gmail.com', 'ABxr0aR8ARW8M', '', '', 0, 'coucou', '0', '683d8682f300087203dca0fca25f0a10', '', '2016-06-10 12:05:16', '0000-00-00 00:00:00', 0, 'France', 0, ''),
(30, '', '', 'Asnières', '0000-00-00', 'maj@maj.fr', 'ABxr0aR8ARW8M', '', '', 0, 'MAJ', '0', '7a32fbba1d0223e42aeae58fb813780c', '', '2016-06-10 15:07:19', '0000-00-00 00:00:00', 0, 'France', 0, ''),
(31, '', '', '', '0000-00-00', 'maaj@maj.fr', 'ABxr0aR8ARW8M', '', '', 0, 'MAAJ', '0', '9453a6ba83c6d716e937d194da682476', '', '2016-06-10 15:13:37', '0000-00-00 00:00:00', 0, 'USA', 0, ''),
(32, '', '', '', NULL, 'oui@dfkhjdfkfhfjkfhfhf.fr', 'ABxr0aR8ARW8M', '', '', 0, 'ouioui', '0', 'fe0a8ea027818ec687e3035d55671400', '', '2016-06-28 10:12:53', '0000-00-00 00:00:00', 0, 'Germany', 0, ''),
(33, 'Cherridi', 'Nicolas', 'Paris', NULL, 'nicolas.cherridi@gmail.com', 'ABxr0aR8ARW8M', '', '', 0, 'Nicoto', '0686732646', 'b7747abe19f9a90e28cd547b7c388e15', 'public/img/avatar-medium.jpg', '2016-06-28 10:13:59', '0000-00-00 00:00:00', 1, 'USA', 0, ''),
(34, 'Cherridi', 'Nicolas', 'Paris', '2016-07-06', 'b@b.fr', 'ABxr0aR8ARW8M', '', '', 1, 'COUCOU', '0123456789', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'Germany', 0, ''),
(35, '', '', '', '0000-00-00', 'bb@bb.fr', '', '', '', 0, 'BB', '0', 'c7f25f4cfe57915d3c6df4409de94fac', '', '2016-07-23 23:16:23', '0000-00-00 00:00:00', 0, 'USA', 0, ''),
(36, '', '', '', '0000-00-00', 'cc@bb.fr', '', '', '', 0, 'cc', '0', '9a599de418e0b87f463bbbcf8b705954', '', '2016-07-23 23:16:43', '0000-00-00 00:00:00', 0, 'Germany', 0, ''),
(37, '', '', '', '0000-00-00', 'ccbb@bb.fr', '', '', '', 0, 'ccbb', '0', '9144dd40e69bb29ee3bbc9247528aec4', '', '2016-07-23 23:16:48', '0000-00-00 00:00:00', 0, 'USA', 0, ''),
(38, '', '', '', '0000-00-00', 'aaa@bb.fr', '', '', '', 0, 'nicocolas', '0', '5588750cef548e66775d2fb65d6242ca', '', '2016-07-23 23:17:00', '0000-00-00 00:00:00', 0, 'Korea', 0, ''),
(39, '', '', 'Champigny', '0000-00-00', 'papa@aaa.fr', '', '', '', 0, 'papa', '0', 'e34a0a43b62377d84b2ea16bec6e9594', '', '2016-07-24 01:43:59', '0000-00-00 00:00:00', 0, 'Russia', 0, ''),
(40, '', '', '', '0000-00-00', 'n.icolascherridi@gmail.com', '', '', '', 0, 'nicoco', '0', '426bf14a04bd5d4ffe99e05e2b0e0918', '', '2016-07-25 18:16:27', '0000-00-00 00:00:00', 0, '', 0, ''),
(41, '', '', '', '0000-00-00', 'mysterbabache@gmail.com', '', '', '', 0, 'babache', '0', '6a61608bb041c4532bd31e1a84bc5966', '', '2016-07-26 14:23:23', '0000-00-00 00:00:00', 0, '', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `user_has_sport_fav`
--

CREATE TABLE `user_has_sport_fav` (
  `id_sport` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user_info_sport`
--

CREATE TABLE `user_info_sport` (
  `id_sport` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `level` varchar(5) NOT NULL,
  `interest` varchar(5) NOT NULL,
  `praticate_since` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `captain`
--
ALTER TABLE `captain`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `discussions_users_pivot`
--
ALTER TABLE `discussions_users_pivot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discussion_id` (`discussion_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`owner`);

--
-- Index pour la table `events_users_pivot`
--
ALTER TABLE `events_users_pivot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_event` (`event_id`);

--
-- Index pour la table `event_has_comment`
--
ALTER TABLE `event_has_comment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discussion_id` (`discussion_id`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Index pour la table `messages_reported`
--
ALTER TABLE `messages_reported`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users` (`id_user`);

--
-- Index pour la table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id_sport`);

--
-- Index pour la table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `team_has_user`
--
ALTER TABLE `team_has_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_info_sport`
--
ALTER TABLE `user_info_sport`
  ADD PRIMARY KEY (`id_sport`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT pour la table `captain`
--
ALTER TABLE `captain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT pour la table `discussions_users_pivot`
--
ALTER TABLE `discussions_users_pivot`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT pour la table `events_users_pivot`
--
ALTER TABLE `events_users_pivot`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT pour la table `event_has_comment`
--
ALTER TABLE `event_has_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT pour la table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `messages_reported`
--
ALTER TABLE `messages_reported`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT pour la table `sports`
--
ALTER TABLE `sports`
  MODIFY `id_sport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;
--
-- AUTO_INCREMENT pour la table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `team_has_user`
--
ALTER TABLE `team_has_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT pour la table `user_info_sport`
--
ALTER TABLE `user_info_sport`
  MODIFY `id_sport` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
