-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 23 Juin 2016 à 07:33
-- Version du serveur: 5.5.49-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ninja_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL,
  `captain` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id`, `idUser`, `idTeam`, `captain`) VALUES
(1, 2, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

CREATE TABLE IF NOT EXISTS `discussions` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `discussions`
--

INSERT INTO `discussions` (`id`) VALUES
(19);

-- --------------------------------------------------------

--
-- Structure de la table `discussions_users_pivot`
--

CREATE TABLE IF NOT EXISTS `discussions_users_pivot` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `discussion_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `discussion_id` (`discussion_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `discussions_users_pivot`
--

INSERT INTO `discussions_users_pivot` (`id`, `discussion_id`, `user_id`) VALUES
(29, 19, 3),
(30, 19, 2);

-- --------------------------------------------------------

--
-- Structure de la table `invitations`
--

CREATE TABLE IF NOT EXISTS `invitations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateInvited` datetime NOT NULL,
  `message` varchar(255) NOT NULL,
  `state` tinyint(4) NOT NULL,
  `idTeamInviting` int(11) NOT NULL,
  `idUserInvited` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `sender_id` int(6) NOT NULL,
  `content` longtext,
  `date` datetime DEFAULT NULL,
  `discussion_id` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `discussion_id` (`discussion_id`),
  KEY `sender_id` (`sender_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `content`, `date`, `discussion_id`) VALUES
(7, 2, 'mon message', '2016-06-22 11:44:45', 19),
(8, 2, 'Mon deuxiÃ¨me message', '2016-06-22 11:45:26', 19),
(9, 2, 'Un autre message', '2016-06-22 11:50:25', 19),
(10, 2, 'un message de plus', '2016-06-22 11:51:03', 19),
(11, 2, 'toto', '2016-06-22 12:00:37', 19),
(12, 2, 'tutu', '2016-06-22 12:08:27', 19),
(13, 2, 'titi', '2016-06-22 12:14:44', 19),
(14, 2, 'tata', '2016-06-22 12:15:12', 19),
(15, 2, 'aegrer', '2016-06-22 12:16:39', 19),
(16, 2, 'zergzerr', '2016-06-22 12:16:58', 19),
(17, 2, 'ffff', '2016-06-22 12:17:35', 19),
(18, 2, 'ezrgzer', '2016-06-22 14:00:07', 19),
(19, 2, 'aergez', '2016-06-22 14:00:39', 19),
(20, 2, 'zegzer', '2016-06-22 14:03:25', 19),
(21, 2, 'ergzeg', '2016-06-22 14:05:08', 19),
(22, 2, 'arger', '2016-06-22 14:05:36', 19),
(23, 2, 'agergzerg', '2016-06-22 14:06:31', 19),
(24, 2, 'azfaz', '2016-06-22 14:08:49', 19),
(25, 2, 'afze', '2016-06-22 14:09:43', 19),
(26, 2, 'zergzer', '2016-06-22 14:10:02', 19),
(27, 2, 'azrra', '2016-06-22 14:18:21', 19),
(28, 2, 'toot', '2016-06-22 14:27:46', 19),
(29, 2, 'pÃ©pÃ©', '2016-06-22 14:29:17', 19),
(30, 2, 'pÃ©pÃ©pupu', '2016-06-22 14:29:20', 19),
(31, 2, 'pÃ©pÃ©pupu', '2016-06-22 14:29:52', 19),
(32, 2, 'pÃ©pÃ©pupu', '2016-06-22 14:29:53', 19),
(33, 2, 'pÃ©pÃ©pupu', '2016-06-22 14:29:53', 19),
(34, 2, 'pÃ©pÃ©pupu', '2016-06-22 14:29:56', 19),
(35, 2, 'mmm', '2016-06-22 16:52:44', 19),
(36, 2, 'toto', '2016-06-22 16:56:04', 19);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `type` tinyint(1) NOT NULL,
  `opened` tinyint(1) NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teamName` varchar(255) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `sports` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `team_has_user`
--

CREATE TABLE IF NOT EXISTS `team_has_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTeam` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `favorite_sports` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone_number` varchar(14) NOT NULL,
  `avatar` varchar(40) NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `city`, `birthday`, `email`, `password`, `favorite_sports`, `token`, `is_active`, `username`, `phone_number`, `avatar`, `dateCreated`) VALUES
(2, 'bellec', 'renaud', '', '0000-00-00', 'renaud.bellec.3@gmail.com', 'ABVmdrEehFnsI', '', '496420b46c9f6ea8dc46920740922246', 1, 'renaud', '087956432', 'public/img/users/renaud.jpg', '2016-06-15 09:56:37'),
(3, '', '', '', '0000-00-00', 'roland.kuku@gmail.com', 'ABVmdrEehFnsI', '', '47575ed20f508d1990c8ae0f11b8a489', 1, 'Roland', '0', '', '2016-06-19 18:45:55');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `discussions_users_pivot`
--
ALTER TABLE `discussions_users_pivot`
  ADD CONSTRAINT `discussions_users_pivot_ibfk_1` FOREIGN KEY (`discussion_id`) REFERENCES `discussions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `discussions_users_pivot_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`discussion_id`) REFERENCES `discussions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
