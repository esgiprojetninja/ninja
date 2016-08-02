-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 24 Juillet 2016 à 14:14
-- Version du serveur: 5.5.47-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.14

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Contenu de la table `captain`
--

INSERT INTO `captain` (`id`, `idUser`, `idTeam`, `captain`) VALUES
(102, 35, 90, 2),
(105, 36, 90, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `comment`, `date_created`, `id_author`) VALUES
(12, 'Test', '2016-07-24', 36),
(13, 'Test', '2016-07-24', 36),
(14, 'Test', '2016-07-24', 36);

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

CREATE TABLE IF NOT EXISTS `discussions` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

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
(31, 'Nicoto gangbang ce fdp', '2016-07-26 14:20:00', '2016-07-26 17:50:00', '2016-07-26 13:00:00', '#Viol #Pleure #Rip #Suicide #Depresison #Paniquoto', 35, 'On va le terminer', 'A07', 'GoRFy', 8, 0, '', 0, '');

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
(25, 31, 35);

-- --------------------------------------------------------

--
-- Structure de la table `event_has_comment`
--

CREATE TABLE IF NOT EXISTS `event_has_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_event` int(11) NOT NULL,
  `id_comment` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `event_has_comment`
--

INSERT INTO `event_has_comment` (`id`, `id_event`, `id_comment`) VALUES
(7, 31, 12),
(8, 31, 13),
(9, 31, 14);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id`, `id_user`, `datetime`, `type`, `opened`, `message`, `action`) VALUES
(3, 36, '2016-07-24 14:35:55', 1, 0, 'You''ve got rekt of the group 90 bro !', 'http://localhost:8888/ninja/'),
(4, 36, '2016-07-24 14:36:03', 1, 0, '2016-07-24 14:36:03 : the team fdsfsdfsdf  has invited you', 'http://localhost:8888/ninja/team/show/90'),
(5, 36, '2016-07-24 14:42:44', 1, 0, '2016-07-24 14:42:44 : the team fdsfsdfsdf  has invited you', 'http://localhost:8888/ninja/team/show/90');

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
(90, 'fdsfsdfsdf', '2016-07-24 14:32:41', '', 'sdfds', '');

-- --------------------------------------------------------

--
-- Structure de la table `team_has_user`
--

CREATE TABLE IF NOT EXISTS `team_has_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTeam` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=132 ;

--
-- Contenu de la table `team_has_user`
--

INSERT INTO `team_has_user` (`id`, `idTeam`, `idUser`) VALUES
(128, 90, 35),
(131, 90, 36);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `city`, `zipcode`, `country`, `street`, `birthday`, `email`, `password`, `favorite_sports`, `token`, `is_active`, `username`, `phone_number`, `avatar`, `dateCreated`, `is_admin`) VALUES
(35, '', '', '', 0, '', '', '0000-00-00', 'lambot.rom@gmail.com', 'ABxr0aR8ARW8M', '', 'e649dd1bf40f5906c3573cb0987922fe', 1, 'GoRFy', '0', '', '2016-07-24 13:26:06', 0),
(36, '', '', '', 0, '', '', '0000-00-00', 'test@test.fr', 'ABxr0aR8ARW8M', '', '8884e19d550fe4d15fff29cfa00d692b', 1, 'Test', '', '', '0000-00-00 00:00:00', 0);

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
