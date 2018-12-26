-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 17 Décembre 2018 à 11:28
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `drive`
--
CREATE DATABASE IF NOT EXISTS `drive` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `drive`;

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

CREATE TABLE IF NOT EXISTS `abonnement` (
  `idabonnement` int(11) NOT NULL,
  `datesouscription` varchar(45) DEFAULT NULL,
  `chauffeur_idchauffeur` int(11) NOT NULL,
  PRIMARY KEY (`idabonnement`),
  KEY `fk_abonnement_chauffeur1_idx` (`chauffeur_idchauffeur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `access_token`
--

CREATE TABLE IF NOT EXISTS `access_token` (
  `id_token` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `token` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_token`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `access_token`
--

INSERT INTO `access_token` (`id_token`, `id_utilisateur`, `token`) VALUES
(1, 1, '79b0358'),
(2, 2, '1cc9098'),
(3, 2, '8b64734');

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `idadministrateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dateajout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idadministrateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `chauffeur`
--

CREATE TABLE IF NOT EXISTS `chauffeur` (
  `idchauffeur` int(11) NOT NULL,
  `permisconduire` varchar(45) DEFAULT NULL,
  `fichier_permis` varchar(255) NOT NULL,
  `cni` varchar(45) DEFAULT NULL,
  `fichier_cni` varchar(255) NOT NULL,
  `casier` varchar(45) DEFAULT NULL,
  `idutilisateur` int(11) NOT NULL,
  `datechauffeur` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ispermis` int(11) NOT NULL,
  `iscasier` int(11) NOT NULL,
  `iscni` int(11) NOT NULL,
  PRIMARY KEY (`idchauffeur`),
  KEY `fk_chauffeur_utilisateur_idx` (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `chauffeur`
--

INSERT INTO `chauffeur` (`idchauffeur`, `permisconduire`, `fichier_permis`, `cni`, `fichier_cni`, `casier`, `idutilisateur`, `datechauffeur`, `ispermis`, `iscasier`, `iscni`) VALUES
(1, '1111111111111111111', 'permis1.pdf', '1234567880', 'cni1.docx', 'casier1.pdf', 1, '2018-12-12 21:19:06', 1, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `idcourse` int(11) NOT NULL,
  `idchauffeur` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `lieu_depart` varchar(45) DEFAULT NULL,
  `lieu_arrive` varchar(45) DEFAULT NULL,
  `datealler` date DEFAULT NULL,
  `heurealler` time NOT NULL,
  `prix` varchar(45) DEFAULT NULL,
  `frequence` varchar(45) DEFAULT NULL,
  `point_idpoint` int(11) NOT NULL,
  `point_idpoint1` int(11) NOT NULL,
  `date_fin_frequence` varchar(45) DEFAULT NULL,
  `nombre_place` varchar(45) DEFAULT NULL,
  `delai_confirmation` varchar(45) DEFAULT NULL,
  `validation_express` varchar(45) DEFAULT NULL,
  `vehicule_idvehicule` int(11) NOT NULL,
  `bagage` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `dateajout` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idcourse`),
  KEY `fk_course_point1_idx` (`point_idpoint`),
  KEY `fk_course_point2_idx` (`point_idpoint1`),
  KEY `fk_course_vehicule1_idx` (`vehicule_idvehicule`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `course`
--

INSERT INTO `course` (`idcourse`, `idchauffeur`, `type`, `lieu_depart`, `lieu_arrive`, `datealler`, `heurealler`, `prix`, `frequence`, `point_idpoint`, `point_idpoint1`, `date_fin_frequence`, `nombre_place`, `delai_confirmation`, `validation_express`, `vehicule_idvehicule`, `bagage`, `description`, `dateajout`) VALUES
(1, 1, 'express', 'Ange Raphael', 'Nkolbissong', '2018-12-13', '12:00:00', '15000', 'reguliere', 1, 2, NULL, '3', NULL, NULL, 0, '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2018-12-14 06:47:36'),
(2, 1, 'express', 'Ange Raphael', 'Nkolbissong', NULL, '00:00:00', '9000', NULL, 1, 3, NULL, '3', NULL, NULL, 0, '', '', '2018-12-14 06:47:36'),
(3, 1, 'express', 'Ange Raphael', 'Nkolbissong', NULL, '00:00:00', '6000', NULL, 1, 9, NULL, '3', NULL, NULL, 0, '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2018-12-14 06:47:36');

-- --------------------------------------------------------

--
-- Structure de la table `coursehoraire`
--

CREATE TABLE IF NOT EXISTS `coursehoraire` (
  `idcoursehoraire` int(11) NOT NULL,
  `jour` varchar(45) DEFAULT NULL,
  `heure_depart` time DEFAULT NULL,
  `heure_retour` time DEFAULT NULL,
  `course_idcourse` int(11) NOT NULL,
  PRIMARY KEY (`idcoursehoraire`),
  KEY `fk_coursehoraire_course1_idx` (`course_idcourse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `coursehoraire`
--

INSERT INTO `coursehoraire` (`idcoursehoraire`, `jour`, `heure_depart`, `heure_retour`, `course_idcourse`) VALUES
(1, '1', '13:00:00', '20:00:00', 1),
(2, '3', '13:00:00', '20:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `coursetrajet`
--

CREATE TABLE IF NOT EXISTS `coursetrajet` (
  `idcoursetrajet` int(11) NOT NULL,
  `prix` varchar(45) DEFAULT NULL,
  `course_idcourse` int(11) NOT NULL,
  `nompoint` varchar(255) NOT NULL,
  PRIMARY KEY (`idcoursetrajet`),
  KEY `fk_coursetrajet_course1_idx` (`course_idcourse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `course_option`
--

CREATE TABLE IF NOT EXISTS `course_option` (
  `idcourseoption` int(11) NOT NULL AUTO_INCREMENT,
  `idcourse` int(11) NOT NULL,
  `idoption` int(11) NOT NULL,
  PRIMARY KEY (`idcourseoption`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `course_option`
--

INSERT INTO `course_option` (`idcourseoption`, `idcourse`, `idoption`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `critere_notation`
--

CREATE TABLE IF NOT EXISTS `critere_notation` (
  `idcritere_notation` int(11) NOT NULL,
  `critere` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcritere_notation`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `critere_rating`
--

CREATE TABLE IF NOT EXISTS `critere_rating` (
  `idcritere_rating` int(11) NOT NULL,
  `commentaire` varchar(45) DEFAULT NULL,
  `note` varchar(45) DEFAULT NULL,
  `critere_notation_idcritere_notation` int(11) NOT NULL,
  `rating_idrating` int(11) NOT NULL,
  PRIMARY KEY (`idcritere_rating`),
  KEY `fk_critere_rating_critere_notation1_idx` (`critere_notation_idcritere_notation`),
  KEY `fk_critere_rating_rating1_idx` (`rating_idrating`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE IF NOT EXISTS `marque` (
  `idmarque` int(11) NOT NULL,
  `marque` varchar(45) DEFAULT NULL,
  `marquecol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmarque`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `idnotification` int(11) NOT NULL,
  `titre` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `utilisateur_idutilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idnotification`),
  KEY `fk_notification_utilisateur1_idx` (`utilisateur_idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `option_course`
--

CREATE TABLE IF NOT EXISTS `option_course` (
  `idoption` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`idoption`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `option_course`
--

INSERT INTO `option_course` (`idoption`, `intitule`, `icon`) VALUES
(1, 'Fumeur', 'smoking.png'),
(2, 'Pause café', 'coffee-cup.png'),
(3, 'Nourriture', 'food.png'),
(4, 'Musique', 'musical-note.png'),
(5, 'Trajet entre femme', 'female-silhouette.png'),
(6, 'Animaux', 'pawprint');

-- --------------------------------------------------------

--
-- Structure de la table `partenaire`
--

CREATE TABLE IF NOT EXISTS `partenaire` (
  `idpartenaire` int(11) NOT NULL,
  `nompartenaire` varchar(45) DEFAULT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `ville` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpartenaire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE IF NOT EXISTS `pays` (
  `IDPAYS` int(11) NOT NULL AUTO_INCREMENT,
  `IDENTIFIANT` int(11) NOT NULL,
  `NOMPAYS` varchar(128) NOT NULL,
  `CODE` varchar(100) NOT NULL,
  `CODE2` varchar(10) NOT NULL,
  `NOMPAYS_EN` varchar(255) NOT NULL,
  PRIMARY KEY (`IDPAYS`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=238 ;

--
-- Contenu de la table `pays`
--

INSERT INTO `pays` (`IDPAYS`, `IDENTIFIANT`, `NOMPAYS`, `CODE`, `CODE2`, `NOMPAYS_EN`) VALUES
(1, 61, 'Australie', '', '', ''),
(2, 679, 'Fidji', '', '', ''),
(3, 1, 'Mariannes', '', '', ''),
(4, 683, 'Niue', '', '', ''),
(5, 687, 'Nouvelle-Calédonie', '', '', ''),
(6, 64, 'Nouvelle-Zélande', '', '', ''),
(7, 675, 'Papouasie-Nouvelle-Guinée', '', '', ''),
(8, 689, 'Polynésie-Francaise', '', '', ''),
(9, 677, 'Salomon (iles)', '', '', ''),
(10, 27, 'Afrique du Sud', '', '', ''),
(11, 213, 'Algérie', '', '', ''),
(12, 244, 'Angola', '', '', ''),
(13, 229, 'Bénin', '', '', ''),
(14, 267, 'Botswana', '', '', ''),
(15, 226, 'Burkina Faso', '', '', ''),
(16, 257, 'Burundi', '', '', ''),
(18, 238, 'Cap Vert', '', '', ''),
(19, 269, 'Comores', '', '', ''),
(20, 225, 'Côte d''Ivoire', '', '', ''),
(21, 253, 'Djibouti', '', '', ''),
(22, 20, 'Égypte', '', '', ''),
(23, 251, 'Éthiopie', '', '', ''),
(24, 241, 'Gabon', '', '', ''),
(25, 220, 'Gambie', '', '', ''),
(26, 233, 'Ghana', '', '', ''),
(27, 224, 'Guinée', '', '', ''),
(28, 245, 'Guinée Bisseau', '', '', ''),
(29, 240, 'Guinée Équatoriale', '', '', ''),
(30, 254, 'Kenya', '', '', ''),
(31, 266, 'Lesotho', '', '', ''),
(32, 218, 'Lybie', '', '', ''),
(33, 261, 'Madagascar', '', '', ''),
(34, 265, 'Malawi', '', '', ''),
(35, 212, 'Maroc', '', '', ''),
(36, 230, 'Maurice', '', '', ''),
(37, 222, 'Mauritanie', '', '', ''),
(38, 258, 'Mozambique', '', '', ''),
(39, 264, 'Namibie', '', '', ''),
(40, 227, 'Niger', '', '', ''),
(41, 234, 'Nigeria', '', '', ''),
(42, 256, 'Ouganda', '', '', ''),
(43, 243, 'République démocratique du Congo', '', '', ''),
(44, 242, 'République Congo', '', '', ''),
(45, 250, 'Rwanda', '', '', ''),
(46, 239, 'Sao Tome-et-Principe', '', '', ''),
(47, 221, 'Sénégal', '', '', ''),
(48, 248, 'Seychelles', '', '', ''),
(49, 232, 'Sierra Leone', '', '', ''),
(50, 252, 'Somalie', '', '', ''),
(51, 249, 'Soudan', '', '', ''),
(52, 268, 'Swaziland', '', '', ''),
(53, 255, 'Tanzanie', '', '', ''),
(54, 235, 'Tchad', '', '', ''),
(55, 228, 'Togo', '', '', ''),
(56, 216, 'Tunisie', '', '', ''),
(57, 263, 'Zimbabwe', '', '', ''),
(58, 1, 'Anguilla', '', '', ''),
(59, 1268, 'Antigua-et-Barbuda', '', '', ''),
(60, 599, 'Antilles Néerlandaises', '', '', ''),
(61, 54, 'Argentine', '', '', ''),
(62, 297, 'Aruba', '', '', ''),
(63, 1, 'Bahamas', '', '', ''),
(64, 1, 'Barbade', '', '', ''),
(65, 501, 'Bélize', '', '', ''),
(66, 1441, 'Bermudes', '', '', ''),
(67, 591, 'Bolivie', '', '', ''),
(68, 55, 'Brésil', '', '', ''),
(69, 1, 'Caïmans', '', '', ''),
(70, 1, 'Canada', '', '', ''),
(71, 56, 'Chili', '', '', ''),
(72, 57, 'Colombie', '', '', ''),
(73, 506, 'Costa Rica', '', '', ''),
(74, 53, 'Cuba', '', '', ''),
(75, 1, 'Dominique', '', '', ''),
(76, 593, 'Équateur', '', '', ''),
(77, 1, 'États-unis', '', '', ''),
(78, 1, 'Grenade', '', '', ''),
(79, 299, 'Groenland', '', '', ''),
(80, 590, 'Guadeloupe', '', '', ''),
(81, 502, 'Guatemala', '', '', ''),
(82, 592, 'Guyana', '', '', ''),
(83, 594, 'Guyane', '', '', ''),
(84, 509, 'Haïti', '', '', ''),
(85, 504, 'Honduras', '', '', ''),
(86, 1876, 'Jamaïque', '', '', ''),
(87, 500, 'Malouines', '', '', ''),
(88, 596, 'Martinique', '', '', ''),
(89, 52, 'Mexique', '', '', ''),
(90, 1, 'Montserrat', '', '', ''),
(91, 505, 'Nicaragua', '', '', ''),
(92, 507, 'Panama', 'PA', '', ''),
(93, 595, 'Paraguay', '', '', ''),
(94, 51, 'Pérou', '', '', ''),
(95, 1, 'Porto Rico', '', '', ''),
(96, 1, 'République Dominicaine', '', '', ''),
(97, 1, 'Saint-Christophe', '', '', ''),
(98, 508, 'Saint-Pierre et Miquelon', '', '', ''),
(99, 1784, 'Saint-Vincent et les Grenadines', '', '', ''),
(100, 503, 'Salvador', '', '', ''),
(101, 597, 'Suriname', '', '', ''),
(102, 1, 'Trinité-et-Tobago', '', '', ''),
(103, 598, 'Uruguay', '', '', ''),
(104, 58, 'Vénézuela', '', '', ''),
(105, 1, 'Vierges américaines', '', '', ''),
(106, 1, 'Vierges britanniques', '', '', ''),
(107, 93, 'Afghanistan', 'AF', '', ''),
(108, 966, 'Arabie saoudite', '', '', ''),
(109, 973, 'Bahreïn', '', '', ''),
(110, 880, 'Bangladesh', '', '', ''),
(111, 975, 'Bhoutan', '', '', ''),
(112, 95, 'Birmanie', '', '', ''),
(113, 673, 'Brunei', '', '', ''),
(114, 855, 'Cambodge', '', '', ''),
(115, 86, 'Chine', '', '', ''),
(116, 850, 'Corée du Nord', '', '', ''),
(117, 82, 'Corée du Sud', '', '', ''),
(118, 971, 'Émirats arabes unis', '', '', ''),
(119, 852, 'Hong Kong', '', '', ''),
(120, 91, 'Inde', '', '', ''),
(121, 62, 'Indonésie', '', '', ''),
(122, 964, 'Irak', '', '', ''),
(123, 98, 'Iran', '', '', ''),
(124, 972, 'Israël', '', '', ''),
(125, 81, 'Japon', '', '', ''),
(126, 962, 'Jordanie', '', '', ''),
(127, 7, 'Kazakhstan', 'KZ', '', ''),
(128, 996, 'Kirghizistan', '', '', ''),
(129, 965, 'Koweït', 'KW', '', ''),
(130, 856, 'Laos', '', '', ''),
(131, 961, 'Liban', '', '', ''),
(132, 60, 'Malaisie', '', '', ''),
(133, 960, 'Maldives', 'MV', '', ''),
(134, 976, 'Mongolie', '', '', ''),
(135, 977, 'Népal', '', '', ''),
(136, 968, 'Oman', '', '', ''),
(137, 998, 'Ouzbékistan', '', '', ''),
(138, 92, 'Pakistan', '', '', ''),
(139, 63, 'philippines', '', '', ''),
(140, 974, 'Qatar', '', '', ''),
(141, 65, 'Singapour', '', '', ''),
(142, 94, 'Sri Lanka', '', '', ''),
(143, 992, 'Tadjikistan', '', '', ''),
(144, 886, 'Taiwan', '', '', ''),
(145, 66, 'Thaïlande', '', '', ''),
(146, 993, 'Turkménistan', '', '', ''),
(147, 84, 'Viêt Nam', '', '', ''),
(148, 967, 'Yémen', '', '', ''),
(149, 27, 'Albanie', '', '', ''),
(150, 213, 'Allemagne', '', '', ''),
(151, 355, 'Andorre', '', '', ''),
(152, 374, 'Arménie', '', '', ''),
(153, 43, 'Autriche', '', '', ''),
(154, 32, 'Belgique', '', '', ''),
(155, 375, 'Biélorussie', '', '', ''),
(156, 387, 'Bosnie Herzégovine', '', '', ''),
(157, 359, 'Bulgarie', '', '', ''),
(158, 385, 'Croatie', '', '', ''),
(159, 45, 'Danemark', '', '', ''),
(160, 34, 'Espagne', '', '', ''),
(161, 372, 'Estonie', '', '', ''),
(162, 298, 'Féroé', '', '', ''),
(163, 358, 'Finlande', '', '', ''),
(164, 33, 'France', 'FR', '', ''),
(165, 995, 'Géorgie', '', '', ''),
(166, 350, 'Gibraltar', '', '', ''),
(167, 30, 'Grèce', '', '', ''),
(168, 36, 'Hongrie', '', '', ''),
(169, 353, 'Irlande', '', '', ''),
(170, 354, 'Islande', '', '', ''),
(171, 39, 'Italie', '', '', ''),
(172, 371, 'Lettonie', '', '', ''),
(173, 423, 'Liechtenstein', '', '', ''),
(174, 370, 'Lituanie', '', '', ''),
(175, 352, 'Luxembourg', '', '', ''),
(176, 389, 'Macédoine', '', '', ''),
(177, 356, 'Malte', '', '', ''),
(178, 373, 'Moldavie', '', '', ''),
(179, 377, 'Monaco', '', '', ''),
(180, 382, 'Montenegro', '', '', ''),
(181, 47, 'Norvège', '', '', ''),
(182, 31, 'Pays-bas', '', '', ''),
(183, 48, 'Pologne', '', '', ''),
(184, 351, 'Portugal', '', '', ''),
(185, 420, 'République Tchèque', '', '', ''),
(186, 40, 'Roumanie', '', '', ''),
(187, 44, 'Royaume-uni', '', '', ''),
(188, 7, 'Russie', '', '', ''),
(189, 590, 'Saint-Martin', '', '', ''),
(190, 381, 'Serbie', '', '', ''),
(191, 421, 'Slovaquie', '', '', ''),
(192, 386, 'Slovénie', '', '', ''),
(193, 46, 'Suède', '', '', ''),
(194, 41, 'Suisse', '', '', ''),
(195, 90, 'Turquie', '', '', ''),
(196, 380, 'Ukraine', '', '', ''),
(197, 379, 'Vatican', '', '', ''),
(237, 237, 'Cameroun', 'CM', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `planification`
--

CREATE TABLE IF NOT EXISTS `planification` (
  `idplanification` int(11) NOT NULL,
  `date_heure` varchar(45) DEFAULT NULL,
  `dateplanification` varchar(45) DEFAULT NULL,
  `marque_idmarque` int(11) NOT NULL,
  `utilisateur_idutilisateur` int(11) NOT NULL,
  `point_idpoint` int(11) NOT NULL,
  `point_idpoint1` int(11) NOT NULL,
  PRIMARY KEY (`idplanification`),
  KEY `fk_planification_marque1_idx` (`marque_idmarque`),
  KEY `fk_planification_utilisateur1_idx` (`utilisateur_idutilisateur`),
  KEY `fk_planification_point1_idx` (`point_idpoint`),
  KEY `fk_planification_point2_idx` (`point_idpoint1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `point`
--

CREATE TABLE IF NOT EXISTS `point` (
  `idpoint` int(11) NOT NULL,
  `nompoint` varchar(45) DEFAULT NULL,
  `positiongprs` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpoint`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `point`
--

INSERT INTO `point` (`idpoint`, `nompoint`, `positiongprs`) VALUES
(1, 'Douala', NULL),
(2, 'Yaoundé', NULL),
(3, 'Bafoussam', NULL),
(4, 'Ngaoundéré', NULL),
(5, 'Garoua', NULL),
(6, 'Bafia', NULL),
(7, 'Ebolowa', NULL),
(8, 'Edea', NULL),
(9, 'Kribi', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `idrating` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL COMMENT 'Ex : Client to Chauffeur, Chauffeur to Client',
  `daterating` varchar(45) DEFAULT NULL,
  `message` varchar(45) DEFAULT NULL,
  `chauffeur_idchauffeur` int(11) NOT NULL,
  `utilisateur_idutilisateur` int(11) NOT NULL,
  `course_idcourse` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  PRIMARY KEY (`idrating`),
  KEY `fk_rating_chauffeur1_idx` (`chauffeur_idchauffeur`),
  KEY `fk_rating_utilisateur1_idx` (`utilisateur_idutilisateur`),
  KEY `fk_rating_course1_idx` (`course_idcourse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `idreservation` int(11) NOT NULL,
  `idvalider` int(11) DEFAULT NULL,
  `course_idcourse` int(11) NOT NULL,
  `utilisateur_idutilisateur` int(11) NOT NULL,
  `nombre_place` int(11) NOT NULL,
  `datereservation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idreservation`),
  KEY `fk_reservation_course1_idx` (`course_idcourse`),
  KEY `fk_reservation_utilisateur1_idx` (`utilisateur_idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reservation`
--

INSERT INTO `reservation` (`idreservation`, `idvalider`, `course_idcourse`, `utilisateur_idutilisateur`, `nombre_place`, `datereservation`) VALUES
(1, 1, 1, 2, 2, '2018-12-14 13:26:19'),
(2, 1, 1, 2, 1, '2018-12-14 13:26:26');

-- --------------------------------------------------------

--
-- Structure de la table `trajetpoint`
--

CREATE TABLE IF NOT EXISTS `trajetpoint` (
  `idtrajetpoint` int(11) NOT NULL,
  `point_idpoint` int(11) NOT NULL,
  `point_idpoint1` int(11) NOT NULL,
  `point_idpoint2` int(11) NOT NULL,
  PRIMARY KEY (`idtrajetpoint`),
  KEY `fk_trajetpoint_point1_idx` (`point_idpoint`),
  KEY `fk_trajetpoint_point2_idx` (`point_idpoint1`),
  KEY `fk_trajetpoint_point3_idx` (`point_idpoint2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `trajetpoint`
--

INSERT INTO `trajetpoint` (`idtrajetpoint`, `point_idpoint`, `point_idpoint1`, `point_idpoint2`) VALUES
(1, 8, 1, 2),
(2, 7, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idutilisateur` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `sexe` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `isactif` int(11) NOT NULL,
  `datecreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `nom`, `prenom`, `email`, `telephone`, `adresse`, `password`, `sexe`, `image`, `isactif`, `datecreation`) VALUES
(1, 'test', 'test', 'admin@yahoo.fr', '671346560', 'Logpom', 'OcK8GBOrpoE=', '', '', 1, '2018-12-12 20:55:25'),
(2, 'Tchepda', 'Flavie', 'tchepda.flavie@yahoo.fr', '+237 691799694', 'Logpom', 'Molhz7GDmvIQFAHwa1f2hw==', '', '', 1, '2018-12-14 12:02:17');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE IF NOT EXISTS `vehicule` (
  `idvehicule` int(11) NOT NULL,
  `nomvehicule` varchar(45) DEFAULT NULL,
  `marque_idmarque` int(11) NOT NULL,
  `chauffeur_idchauffeur` int(11) NOT NULL,
  `couleurvehicule` varchar(255) NOT NULL,
  PRIMARY KEY (`idvehicule`),
  KEY `fk_vehicule_marque1_idx` (`marque_idmarque`),
  KEY `fk_vehicule_chauffeur1_idx` (`chauffeur_idchauffeur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `verification`
--

CREATE TABLE IF NOT EXISTS `verification` (
  `idverification` int(11) NOT NULL,
  `etat` varchar(45) DEFAULT NULL,
  `dateverification` varchar(45) DEFAULT NULL,
  `vehicule_idvehicule` int(11) NOT NULL,
  `partenaire_idpartenaire` int(11) NOT NULL,
  PRIMARY KEY (`idverification`),
  KEY `fk_verification_vehicule1_idx` (`vehicule_idvehicule`),
  KEY `fk_verification_partenaire1_idx` (`partenaire_idpartenaire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD CONSTRAINT `fk_abonnement_chauffeur1` FOREIGN KEY (`chauffeur_idchauffeur`) REFERENCES `chauffeur` (`idchauffeur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  ADD CONSTRAINT `fk_chauffeur_utilisateur` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `fk_course_point1` FOREIGN KEY (`point_idpoint`) REFERENCES `point` (`idpoint`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_course_point2` FOREIGN KEY (`point_idpoint1`) REFERENCES `point` (`idpoint`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `coursehoraire`
--
ALTER TABLE `coursehoraire`
  ADD CONSTRAINT `fk_coursehoraire_course1` FOREIGN KEY (`course_idcourse`) REFERENCES `course` (`idcourse`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `coursetrajet`
--
ALTER TABLE `coursetrajet`
  ADD CONSTRAINT `fk_coursetrajet_course1` FOREIGN KEY (`course_idcourse`) REFERENCES `course` (`idcourse`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `critere_rating`
--
ALTER TABLE `critere_rating`
  ADD CONSTRAINT `fk_critere_rating_critere_notation1` FOREIGN KEY (`critere_notation_idcritere_notation`) REFERENCES `critere_notation` (`idcritere_notation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_critere_rating_rating1` FOREIGN KEY (`rating_idrating`) REFERENCES `rating` (`idrating`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `fk_notification_utilisateur1` FOREIGN KEY (`utilisateur_idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `planification`
--
ALTER TABLE `planification`
  ADD CONSTRAINT `fk_planification_marque1` FOREIGN KEY (`marque_idmarque`) REFERENCES `marque` (`idmarque`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_planification_point1` FOREIGN KEY (`point_idpoint`) REFERENCES `point` (`idpoint`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_planification_point2` FOREIGN KEY (`point_idpoint1`) REFERENCES `point` (`idpoint`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_planification_utilisateur1` FOREIGN KEY (`utilisateur_idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_rating_chauffeur1` FOREIGN KEY (`chauffeur_idchauffeur`) REFERENCES `chauffeur` (`idchauffeur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rating_course1` FOREIGN KEY (`course_idcourse`) REFERENCES `course` (`idcourse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rating_utilisateur1` FOREIGN KEY (`utilisateur_idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation_course1` FOREIGN KEY (`course_idcourse`) REFERENCES `course` (`idcourse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservation_utilisateur1` FOREIGN KEY (`utilisateur_idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `trajetpoint`
--
ALTER TABLE `trajetpoint`
  ADD CONSTRAINT `fk_trajetpoint_point1` FOREIGN KEY (`point_idpoint`) REFERENCES `point` (`idpoint`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_trajetpoint_point2` FOREIGN KEY (`point_idpoint1`) REFERENCES `point` (`idpoint`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_trajetpoint_point3` FOREIGN KEY (`point_idpoint2`) REFERENCES `point` (`idpoint`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `fk_vehicule_chauffeur1` FOREIGN KEY (`chauffeur_idchauffeur`) REFERENCES `chauffeur` (`idchauffeur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vehicule_marque1` FOREIGN KEY (`marque_idmarque`) REFERENCES `marque` (`idmarque`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `verification`
--
ALTER TABLE `verification`
  ADD CONSTRAINT `fk_verification_partenaire1` FOREIGN KEY (`partenaire_idpartenaire`) REFERENCES `partenaire` (`idpartenaire`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_verification_vehicule1` FOREIGN KEY (`vehicule_idvehicule`) REFERENCES `vehicule` (`idvehicule`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
