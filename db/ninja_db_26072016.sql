-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 26 Juillet 2016 à 09:12
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `captain`
--

CREATE TABLE IF NOT EXISTS `captain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idTeam` int(11) NOT NULL,
  `captain` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Contenu de la table `captain`
--

INSERT INTO `captain` (`id`, `idUser`, `idTeam`, `captain`) VALUES
(102, 35, 90, 2);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `date_created` datetime NOT NULL,
  `id_author` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

CREATE TABLE IF NOT EXISTS `discussions` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `people` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Contenu de la table `discussions`
--

INSERT INTO `discussions` (`id`, `people`) VALUES
(37, ',36,35'),
(38, ',38,35');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Contenu de la table `discussions_users_pivot`
--

INSERT INTO `discussions_users_pivot` (`id`, `discussion_id`, `user_id`) VALUES
(44, 37, 36),
(45, 37, 35),
(47, 38, 38),
(48, 38, 35);

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
  `country` varchar(100) NOT NULL,
  `zipcode` int(10) NOT NULL,
  `city` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `events`
--

INSERT INTO `events` (`id`, `name`, `from_date`, `to_date`, `joignable_until`, `tags`, `owner`, `description`, `location`, `owner_name`, `nb_people_max`, `open`, `country`, `zipcode`, `city`) VALUES
(31, 'Un event', '2016-08-14 10:00:00', '2016-08-14 11:00:00', '2016-08-13 23:00:00', '#belote,#amour,#bonheur', 35, 'une super event', '10 rue du toto', 'renaud', 10, 0, '', 0, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `events_users_pivot`
--

INSERT INTO `events_users_pivot` (`id`, `event_id`, `user_id`) VALUES
(25, 31, 35),
(26, 31, 38);

-- --------------------------------------------------------

--
-- Structure de la table `event_has_comment`
--

CREATE TABLE IF NOT EXISTS `event_has_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_event` int(11) NOT NULL,
  `id_comment` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `invitations`
--

CREATE TABLE IF NOT EXISTS `invitations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateInvited` datetime NOT NULL,
  `message` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `content`, `date`, `discussion_id`) VALUES
(41, 35, 'toto', '2016-07-24 16:08:00', 38),
(42, 35, 'to bellec', '2016-07-24 16:35:52', 38),
(43, 35, 'uep', '2016-07-24 17:08:06', 37),
(44, 35, 'uep', '2016-07-24 17:08:22', 37),
(45, 35, 'tutu', '2016-07-24 17:10:05', 38);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `type` tinyint(1) NOT NULL,
  `opened` tinyint(1) NOT NULL,
  `message` longtext NOT NULL,
  `action` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `rates`
--

CREATE TABLE IF NOT EXISTS `rates` (
  `user_id` int(6) DEFAULT NULL,
  `rate` int(6) DEFAULT NULL,
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `voter_id` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `rates`
--

INSERT INTO `rates` (`user_id`, `rate`, `id`, `voter_id`) VALUES
(36, 0, 5, NULL),
(36, 1, 6, NULL),
(36, 0, 7, 35),
(36, 0, 8, 35),
(36, 0, 9, 35),
(36, 0, 10, 35),
(36, 0, 11, 35);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Contenu de la table `teams`
--

INSERT INTO `teams` (`id`, `teamName`, `dateCreated`, `sports`, `description`, `avatar`) VALUES
(90, 'La team de renaud', '2016-07-24 17:21:43', '', 'super mega team uech trankil tavu', 'public/img/teams/la team de renaud.png');

-- --------------------------------------------------------

--
-- Structure de la table `team_has_user`
--

CREATE TABLE IF NOT EXISTS `team_has_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTeam` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=129 ;

--
-- Contenu de la table `team_has_user`
--

INSERT INTO `team_has_user` (`id`, `idTeam`, `idUser`) VALUES
(128, 90, 35);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` int(5) NOT NULL,
  `country` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
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
  `is_admin` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `city`, `zipcode`, `country`, `street`, `birthday`, `email`, `password`, `favorite_sports`, `token`, `is_active`, `username`, `phone_number`, `avatar`, `dateCreated`, `is_admin`) VALUES
(35, 'Bellec', 'Renaud', '', 0, '', '', '0000-00-00', 'renaud.bellec.3@gmail.com', 'ABVmdrEehFnsI', '', '637cf6b69813b1908a3084a0afd50512', 1, 'renaud', '96784354524168', 'public/img/users/renaud.jpg', '2016-07-24 13:20:14', 0),
(36, 'Kullet', 'Roland', '', 0, '', '', '0000-00-00', 'roland.kuku@gmail.com', 'ABVmdrEehFnsI', '', '23200801b1f2b502abd218b7125cdc8e', 1, 'roland', '0', 'public/img/users/roland.jpg', '2016-07-24 13:35:02', 0),
(38, '', '', '', 0, '', '', '0000-00-00', 'rbellec@cowork.io', 'ABVmdrEehFnsI', '', '19154870424fe7d8ffee0f0f5d30a0b4', 1, 'rbellec', '0', '', '2016-07-24 14:49:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_has_sport_fav`
--

CREATE TABLE IF NOT EXISTS `user_has_sport_fav` (
  `id_sport` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user_info_sport`
--

CREATE TABLE IF NOT EXISTS `user_info_sport` (
  `id_sport` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `level` varchar(5) NOT NULL,
  `interest` varchar(5) NOT NULL,
  `praticate_since` varchar(6) NOT NULL,
  PRIMARY KEY (`id_sport`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
