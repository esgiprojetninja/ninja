-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 16 Mars 2016 à 19:18
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `p_a`
--

-- --------------------------------------------------------

--
-- Structure de la table `sports`
--

CREATE TABLE IF NOT EXISTS `sports` (
  `id_sport` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_sport`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=256 ;

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
(53, 'Course d''orientation'),
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
(210, 'Tir à l''arc'),
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
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `favorite_sport` varchar(255) NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Structure de la table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teamName` varchar(255) NOT NULL,
  `dateCreated` date NOT NULL,
  `sports` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Structure de la table `team_has_user`
--

CREATE TABLE IF NOT EXISTS `team_has_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTeam` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


