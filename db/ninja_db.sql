-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 10 Juillet 2016 à 14:47
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id`, `idUser`, `idTeam`, `captain`) VALUES
(1, 2, 0, 0),
(2, 2, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

CREATE TABLE IF NOT EXISTS `discussions` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `discussions`
--

INSERT INTO `discussions` (`id`) VALUES
(1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `discussions_users_pivot`
--

INSERT INTO `discussions_users_pivot` (`id`, `discussion_id`, `user_id`) VALUES
(1, 1, 3),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `events`
--

INSERT INTO `events` (`id`, `name`, `from_date`, `to_date`, `joignable_until`, `tags`, `owner`, `description`, `location`, `owner_name`, `nb_people_max`, `open`) VALUES
(30, 'Mon event', '2016-08-14 18:00:00', '2016-08-14 22:00:00', '2016-08-14 12:00:00', '#belote,#amour,#bonheur', 2, 'Un super match de belote', 'Le bistro du coin', 'renaud', 24, 0);

-- --------------------------------------------------------

--
-- Structure de la table `events_users_pivot`
--

CREATE TABLE IF NOT EXISTS `events_users_pivot` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `event_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `fk_event` (`event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `events_users_pivot`
--

INSERT INTO `events_users_pivot` (`id`, `event_id`, `user_id`) VALUES
(19, 30, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `invitations`
--

INSERT INTO `invitations` (`id`, `dateInvited`, `message`, `state`, `idTeamInviting`, `idUserInvited`) VALUES
(1, '2016-06-27 19:09:58', 'viens dans ma team pd', 0, 1, 3);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id`, `id_user`, `datetime`, `type`, `opened`, `message`) VALUES
(1, 2, '2016-06-28 07:18:16', 1, 0, 'Une notif');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `teams`
--

INSERT INTO `teams` (`id`, `teamName`, `dateCreated`, `sports`, `description`, `avatar`) VALUES
(1, 'My team', '2016-06-27 19:08:19', '', 'La mÃ©ga team de la mort qui tue', '');

-- --------------------------------------------------------

--
-- Structure de la table `team_has_user`
--

CREATE TABLE IF NOT EXISTS `team_has_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTeam` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `team_has_user`
--

INSERT INTO `team_has_user` (`id`, `idTeam`, `idUser`) VALUES
(1, 1, 2);

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
(2, 'bellec', 'renaud', '', '0000-00-00', 'renaud.bellec.3@gmail.com', 'ABVmdrEehFnsI', '', '97a5de09d6182e30e16993170674d430', 1, 'renaud', '087956432', 'public/img/users/renaud.jpg', '2016-06-15 09:56:37'),
(3, '', '', '', '0000-00-00', 'roland.kuku@gmail.com', 'ABVmdrEehFnsI', '', '0617f52a5165872fe786533a7cf93697', 1, 'Roland', '0', '', '2016-06-19 18:45:55');

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
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `events_users_pivot`
--
ALTER TABLE `events_users_pivot`
  ADD CONSTRAINT `events_users_pivot_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `events_users_pivot_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`discussion_id`) REFERENCES `discussions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
