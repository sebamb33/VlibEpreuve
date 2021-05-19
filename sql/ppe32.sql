-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 19 mai 2021 à 22:46
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ppe32`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

DROP TABLE IF EXISTS `abonnement`;
CREATE TABLE IF NOT EXISTS `abonnement` (
  `CODEA` varchar(128) NOT NULL,
  `CODETYPEABO` varchar(128) NOT NULL,
  `DUREEA` varchar(128) DEFAULT NULL,
  `MONTANTA` double(5,2) DEFAULT NULL,
  `CREDITTEMPSBASE` double(5,2) DEFAULT NULL,
  `CAUTION` double(5,2) DEFAULT NULL,
  `TLIB` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CODEA`),
  KEY `I_FK_ABONNEMENT_TYPE_ABONEMENT` (`CODETYPEABO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `abonnement`
--

INSERT INTO `abonnement` (`CODEA`, `CODETYPEABO`, `DUREEA`, `MONTANTA`, `CREDITTEMPSBASE`, `CAUTION`, `TLIB`) VALUES
('0', '0', '0', 0.00, 0.00, 0.00, 0),
('1', '1', '1jour', 1.50, 0.00, 200.00, 0),
('2', '2', '7jours', 5.00, 0.00, 200.00, 0);

-- --------------------------------------------------------

--
-- Structure de la table `date_histo`
--

DROP TABLE IF EXISTS `date_histo`;
CREATE TABLE IF NOT EXISTS `date_histo` (
  `DATEHISTO` date NOT NULL,
  `HEURE` time NOT NULL,
  PRIMARY KEY (`DATEHISTO`,`HEURE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

DROP TABLE IF EXISTS `emprunt`;
CREATE TABLE IF NOT EXISTS `emprunt` (
  `IDUTIL` int(11) NOT NULL,
  `DATEHISTO` date NOT NULL,
  `HEURE` time NOT NULL,
  `NUMV` varchar(128) NOT NULL,
  `DURÉE` time DEFAULT NULL,
  PRIMARY KEY (`IDUTIL`,`DATEHISTO`,`HEURE`),
  KEY `I_FK_EMPRUNT_VELO` (`NUMV`),
  KEY `I_FK_EMPRUNT_UTILISATEUR` (`IDUTIL`),
  KEY `I_FK_EMPRUNT_DATE_HISTO` (`DATEHISTO`,`HEURE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etat_plot`
--

DROP TABLE IF EXISTS `etat_plot`;
CREATE TABLE IF NOT EXISTS `etat_plot` (
  `NUMP` varchar(128) NOT NULL,
  `DATEHISTO` date NOT NULL,
  `HEURE` time NOT NULL,
  `ETATPLOT` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`NUMP`,`DATEHISTO`,`HEURE`),
  KEY `I_FK_ETAT_PLOT_PLOT` (`NUMP`),
  KEY `I_FK_ETAT_PLOT_DATE_HISTO` (`DATEHISTO`,`HEURE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etat_station`
--

DROP TABLE IF EXISTS `etat_station`;
CREATE TABLE IF NOT EXISTS `etat_station` (
  `NUMS` varchar(128) NOT NULL,
  `DATEHISTO` date NOT NULL,
  `HEURE` time NOT NULL,
  `ETATSTATION` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`NUMS`,`DATEHISTO`,`HEURE`),
  KEY `I_FK_ETAT_STATION_STATION` (`NUMS`),
  KEY `I_FK_ETAT_STATION_DATE_HISTO` (`DATEHISTO`,`HEURE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etat_velo`
--

DROP TABLE IF EXISTS `etat_velo`;
CREATE TABLE IF NOT EXISTS `etat_velo` (
  `NUMV` varchar(128) NOT NULL,
  `DATEHISTO` date NOT NULL,
  `HEURE` time NOT NULL,
  `ETATVELO` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`NUMV`,`DATEHISTO`,`HEURE`),
  KEY `I_FK_ETAT_VELO_VELO` (`NUMV`),
  KEY `I_FK_ETAT_VELO_DATE_HISTO` (`DATEHISTO`,`HEURE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `plot`
--

DROP TABLE IF EXISTS `plot`;
CREATE TABLE IF NOT EXISTS `plot` (
  `NUMP` varchar(128) NOT NULL,
  `NUMV` varchar(128) DEFAULT NULL,
  `NUMS` varchar(128) NOT NULL,
  `ETAT` varchar(128) DEFAULT NULL,
  `DISPONIBILITÉ` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`NUMP`),
  UNIQUE KEY `I_FK_PLOT_VELO` (`NUMV`),
  KEY `I_FK_PLOT_STATION` (`NUMS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `station`
--

DROP TABLE IF EXISTS `station`;
CREATE TABLE IF NOT EXISTS `station` (
  `NUMS` varchar(128) NOT NULL,
  `ETATS` varchar(128) DEFAULT NULL,
  `NOMS` varchar(128) DEFAULT NULL,
  `SITUATIONS` varchar(128) DEFAULT NULL,
  `CAPACITES` bigint(4) DEFAULT NULL,
  `NUMBORNE` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`NUMS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `station`
--

INSERT INTO `station` (`NUMS`, `ETATS`, `NOMS`, `SITUATIONS`, `CAPACITES`, `NUMBORNE`) VALUES
('101', 'Disponible', 'Pl. Jean Jaures', NULL, NULL, '20'),
('107', 'Disponible', 'St Nicolas', NULL, NULL, '15'),
('108', 'Disponible', 'Bergonie', NULL, NULL, '15'),
('110', 'Disponible', 'Forum', NULL, NULL, '41'),
('112', 'Disponible', 'Arts et Metiers', NULL, NULL, '39'),
('114', 'Disponible', 'Compostelle', NULL, NULL, '27'),
('116', 'Disponible', 'Montaigne Montesquieu', NULL, NULL, '40'),
('117', 'Disponible', 'Doyen Brus', NULL, NULL, '19'),
('119', 'Disponible', 'Tram station Grd Parc', NULL, NULL, '19'),
('12', 'Indisponible', 'Grand Lebrun', NULL, NULL, '15'),
('120', 'Disponible', 'Saint Louis Haussmann', NULL, NULL, '18'),
('124', 'Disponible', 'Parc des Sports', NULL, NULL, '19'),
('125', 'Disponible', 'Conservatoire', NULL, NULL, '18'),
('128', 'Disponible', 'Sacre Coeur', NULL, NULL, '16'),
('138', 'Disponible', 'Barbey', NULL, NULL, '18'),
('14', 'Indisponible', 'Dubreuil / Turenne', NULL, NULL, '14'),
('142', 'Disponible', 'Bourranville', NULL, NULL, '19'),
('143', 'Disponible', 'Pins Francs', NULL, NULL, '18'),
('145', 'Disponible', 'Berges du Lac', NULL, NULL, '17'),
('149', 'Disponible', 'Lauriers', NULL, NULL, '19'),
('15', 'Indisponible', 'Rue de la Croix Blanche', NULL, NULL, '13'),
('150', 'Disponible', 'Feydeau', NULL, NULL, '19'),
('151', 'Disponible', 'Dravemont', NULL, NULL, '20'),
('153', 'Disponible', 'Parc Sourreil', NULL, NULL, '20'),
('159', 'Disponible', 'Camping International', NULL, NULL, '24'),
('16', 'Indisponible', 'Galin', NULL, NULL, '18'),
('160', 'Disponible', 'Eglise St Aubin', NULL, NULL, '10'),
('18', 'Indisponible', 'Huguerie', NULL, NULL, '14'),
('20', 'Indisponible', 'Grands Hommes', NULL, NULL, '20'),
('21', 'Indisponible', 'Puy Paulin', NULL, NULL, '15'),
('22', 'Indisponible', 'Hotel de Ville', NULL, NULL, '33'),
('24', 'Indisponible', 'Liberation', NULL, NULL, '15'),
('32', 'Indisponible', 'Parc Bordelais', NULL, NULL, '16'),
('35', 'Indisponible', 'Pl. Marie Brizard', NULL, NULL, '15'),
('36', 'Indisponible', 'Pl. de Longchamps', NULL, NULL, '17'),
('38', 'Indisponible', 'Pl. Charles Gruet', NULL, NULL, '16'),
('4', 'Indisponible', 'St Seurin', NULL, NULL, '20'),
('42', 'Indisponible', 'Camille Jullian', NULL, NULL, '18'),
('43', 'Indisponible', 'St Paul', NULL, NULL, '18'),
('45', 'Indisponible', 'Pl. Ste Eulalie', NULL, NULL, '20'),
('50', 'Disponible', 'Mandron Godard', NULL, NULL, '14'),
('51', 'Disponible', 'Place Ampere', NULL, NULL, '20'),
('52', 'Disponible', 'Place de l\'Europe', NULL, NULL, '17'),
('53', 'Disponible', 'Parc Riviere', NULL, NULL, '13'),
('54', 'Disponible', 'Rue St Vincent de Paul', NULL, NULL, '22'),
('55', 'Disponible', 'Camille Godard', NULL, NULL, '16'),
('56', 'Disponible', 'Pl. Paul Doumer', NULL, NULL, '18'),
('57', 'Disponible', 'Eglise St Louis', NULL, NULL, '16'),
('6', 'Indisponible', 'Square A. Lhote', NULL, NULL, '20'),
('60', 'Disponible', 'Allees de Chartres', NULL, NULL, '20'),
('61', 'Disponible', 'Parc aux Angeliques', NULL, NULL, '16'),
('63', 'Disponible', 'Francois Mitterrand', NULL, NULL, '17'),
('66', 'Disponible', 'Gare d\'Orleans', NULL, NULL, '20'),
('67', 'Disponible', 'Allee de Serr - Abadie', NULL, NULL, '16'),
('69', 'Disponible', 'Cours Le Rouzic', NULL, NULL, '12'),
('7', 'Indisponible', 'Palais de Justice', NULL, NULL, '18'),
('71', 'Disponible', 'La Gardette', NULL, NULL, '18'),
('72', 'Disponible', 'Jean Zay', NULL, NULL, '22'),
('77', 'Disponible', 'Pl. Bernard Roumegoux', NULL, NULL, '20'),
('78', 'Disponible', 'Bougnard', NULL, NULL, '16'),
('80', 'Disponible', 'Gare Alouette', NULL, NULL, '17'),
('81', 'Disponible', 'L. Morin Cazalet', NULL, NULL, '18'),
('90', 'Disponible', 'Fontaine d\'Arlac', NULL, NULL, '18'),
('97', 'Disponible', 'Claveau', NULL, NULL, '20'),
('98', 'Disponible', 'Bassins a flot', NULL, NULL, '16'),
('99', 'Disponible', 'Les Hangars', NULL, NULL, '20');

-- --------------------------------------------------------

--
-- Structure de la table `type_abonement`
--

DROP TABLE IF EXISTS `type_abonement`;
CREATE TABLE IF NOT EXISTS `type_abonement` (
  `CODETYPEABO` varchar(128) NOT NULL,
  `LIBELLETYPEABO` varchar(128) DEFAULT NULL,
  `TARIFHORAIRE` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`CODETYPEABO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_abonement`
--

INSERT INTO `type_abonement` (`CODETYPEABO`, `LIBELLETYPEABO`, `TARIFHORAIRE`) VALUES
('0', 'Aucun Abonnement', '0.00'),
('1', '24heures', '2.00'),
('2', '7jours', '2.00');

-- --------------------------------------------------------

--
-- Structure de la table `type_utilisateur`
--

DROP TABLE IF EXISTS `type_utilisateur`;
CREATE TABLE IF NOT EXISTS `type_utilisateur` (
  `CODETYPE` varchar(32) NOT NULL,
  `LIBELLETYPE` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`CODETYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_utilisateur`
--

INSERT INTO `type_utilisateur` (`CODETYPE`, `LIBELLETYPE`) VALUES
('1', 'abonne'),
('2', 'Responsable Technique');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `IDUTIL` int(11) NOT NULL AUTO_INCREMENT,
  `LOGIN` int(6) NOT NULL,
  `MDP` varchar(255) NOT NULL,
  `CODETYPE` varchar(32) NOT NULL,
  `CODEA` varchar(128) NOT NULL,
  `NOM` varchar(128) DEFAULT NULL,
  `PRENOM` varchar(128) DEFAULT NULL,
  `SEXE` varchar(4) DEFAULT NULL,
  `DATENAISS` date DEFAULT NULL,
  `ADRESSE` varchar(255) DEFAULT NULL,
  `SUPLEMENTADDR` varchar(255) DEFAULT NULL,
  `TEL` tinytext,
  `VILLE` varchar(50) DEFAULT NULL,
  `CP` text NOT NULL,
  `DATEDEBABON` date DEFAULT NULL,
  `DATEFINABON` date DEFAULT NULL,
  `CREDITTEMPS` decimal(10,2) DEFAULT NULL,
  `MONTANTADEBITER` decimal(10,2) DEFAULT NULL,
  `MAIL` varchar(150) NOT NULL,
  PRIMARY KEY (`IDUTIL`),
  UNIQUE KEY `contrainteUnSeulLogin` (`LOGIN`),
  KEY `I_FK_UTILISATEUR_TYPE_UTILISATEUR` (`CODETYPE`),
  KEY `I_FK_UTILISATEUR_ABONNEMENT` (`CODEA`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`IDUTIL`, `LOGIN`, `MDP`, `CODETYPE`, `CODEA`, `NOM`, `PRENOM`, `SEXE`, `DATENAISS`, `ADRESSE`, `SUPLEMENTADDR`, `TEL`, `VILLE`, `CP`, `DATEDEBABON`, `DATEFINABON`, `CREDITTEMPS`, `MONTANTADEBITER`, `MAIL`) VALUES
(1, 444333, '81dc9bdb52d04dc20036dbd8313ed055', '1', '1', 'toutou', 'momo', 'Mr', '2019-01-06', 'Coucou les bg', 'ca va ', '0669191385', 'Bègles', '12345', '2021-04-19', '2021-04-21', '30.20', '43.20', 'chaud@cacao.fr'),
(4, 967366, '265c2b6a26807154013753637b68d01d', '1', '1', 'aaa', 'aaaa', 'Mr', '2020-03-05', 'EZAFF', 'ZFZZE', 'FFFFF', 'FFFF', 'FFFFF', NULL, NULL, '0.00', '0.00', 'sebastienambona33@outlook.com'),
(10, 960187, 'e564618b1a0f9a0e5b043f63d43fc065', '1', '0', 'aaa', 'aaaa', 'Mr', '2003-07-05', 'aaaaa', 'zaezaa', '000000000', 'zaazza', '23300', NULL, NULL, '0.00', '0.00', 'seb@coucou'),
(11, 816279, '566f0ea4f6c2e947f36795c8f58ba901', '1', '0', 'aaaa', 'zzzzz', 'Mr', '1999-04-05', 'edddd', 'dddd', '0669191385', 'oop', '47300', NULL, NULL, '0.00', '0.00', 'seb@aoaa'),
(12, 806128, '488c1e0332065eb80e1129139a67d6e0', '1', '0', 'dfg', 'dfg', 'Mr', '2020-03-05', 'zzz', 'zzz', '0669191343', 'zzz', '33000', NULL, NULL, '0.00', '0.00', 'seb@ooo'),
(13, 860736, 'bb836c01cdc9120a9c984c525e4b1a4a', '1', '1', 'sebCompte', 'sebPrenom', 'Mr', '2000-07-05', 'azerty', 'azerty', '0669191385', 'alloz', '33130', '2021-05-10', '2021-05-11', '40.00', '20.33', 'seba@compte.fr'),
(14, 530605, '01daa090f0d5693d97c90755a54fa204', '1', '2', 'sebar', 'sebar', 'Mr', '2000-07-05', '11 ch des roseaux', ' supp', '0669564343', 'Bordeaux', '33130', '2021-05-01', '2021-05-08', '0.00', '0.00', 'seb@mail.com'),
(15, 260597, '81dc9bdb52d04dc20036dbd8313ed055', '1', '0', 'seba', 'seb', 'Mr', '2000-05-05', 'aaa', 'aaa', '0669567965', 'VSL', '33130', NULL, NULL, '30.30', '0.00', 'aa'),
(16, 97165, 'b645e524a1512ce68947d3b9c948aa46', '1', '0', 'sebo', 'sebo', 'Mr', '2000-07-05', '11 def le', 'lele', '0669191454', 'BDX', '33130', NULL, NULL, '0.00', '0.00', 'AD@GMAIL.com'),
(17, 173951, 'f106b7f99d2cb30c3db1c3cc0fde9ccb', '1', '2', 'bac', 'bac', 'Mr', '2000-05-05', '11 coucou bobo', 'supsup', '0606060606', 'Vsl', '47300', '2021-05-01', '2021-05-02', '50.00', '0.00', 'seba@bac.fr'),
(18, 129875, '41d80bfc327ef980528426fc810a6d7a', '1', '0', 'zra', 'amb', 'Mr', '2001-07-05', '13 rue des poissons', 'supsup', '0669191313', 'Bordeaux', '33000', NULL, NULL, '0.00', '0.00', 'ambona@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `velo`
--

DROP TABLE IF EXISTS `velo`;
CREATE TABLE IF NOT EXISTS `velo` (
  `NUMV` varchar(128) NOT NULL,
  `NUMP` varchar(128) DEFAULT NULL,
  `ETATV` varchar(128) DEFAULT NULL,
  `DMEC` date DEFAULT NULL,
  `DISPONIBILITÉ` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`NUMV`),
  UNIQUE KEY `I_FK_VELO_PLOT` (`NUMP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD CONSTRAINT `abonnement_ibfk_1` FOREIGN KEY (`CODETYPEABO`) REFERENCES `type_abonement` (`CODETYPEABO`);

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `emprunt_ibfk_1` FOREIGN KEY (`NUMV`) REFERENCES `velo` (`NUMV`),
  ADD CONSTRAINT `emprunt_ibfk_2` FOREIGN KEY (`IDUTIL`) REFERENCES `utilisateur` (`IDUTIL`),
  ADD CONSTRAINT `emprunt_ibfk_3` FOREIGN KEY (`DATEHISTO`,`HEURE`) REFERENCES `date_histo` (`DATEHISTO`, `HEURE`);

--
-- Contraintes pour la table `etat_plot`
--
ALTER TABLE `etat_plot`
  ADD CONSTRAINT `etat_plot_ibfk_1` FOREIGN KEY (`NUMP`) REFERENCES `plot` (`NUMP`),
  ADD CONSTRAINT `etat_plot_ibfk_2` FOREIGN KEY (`DATEHISTO`,`HEURE`) REFERENCES `date_histo` (`DATEHISTO`, `HEURE`);

--
-- Contraintes pour la table `etat_station`
--
ALTER TABLE `etat_station`
  ADD CONSTRAINT `etat_station_ibfk_1` FOREIGN KEY (`NUMS`) REFERENCES `station` (`NUMS`),
  ADD CONSTRAINT `etat_station_ibfk_2` FOREIGN KEY (`DATEHISTO`,`HEURE`) REFERENCES `date_histo` (`DATEHISTO`, `HEURE`);

--
-- Contraintes pour la table `etat_velo`
--
ALTER TABLE `etat_velo`
  ADD CONSTRAINT `etat_velo_ibfk_1` FOREIGN KEY (`NUMV`) REFERENCES `velo` (`NUMV`),
  ADD CONSTRAINT `etat_velo_ibfk_2` FOREIGN KEY (`DATEHISTO`,`HEURE`) REFERENCES `date_histo` (`DATEHISTO`, `HEURE`);

--
-- Contraintes pour la table `plot`
--
ALTER TABLE `plot`
  ADD CONSTRAINT `plot_ibfk_1` FOREIGN KEY (`NUMV`) REFERENCES `velo` (`NUMV`),
  ADD CONSTRAINT `plot_ibfk_2` FOREIGN KEY (`NUMS`) REFERENCES `station` (`NUMS`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `UTILISATEUR_ibfk_1` FOREIGN KEY (`CODETYPE`) REFERENCES `type_utilisateur` (`CODETYPE`),
  ADD CONSTRAINT `UTILISATEUR_ibfk_2` FOREIGN KEY (`CODEA`) REFERENCES `abonnement` (`CODEA`);

--
-- Contraintes pour la table `velo`
--
ALTER TABLE `velo`
  ADD CONSTRAINT `velo_ibfk_1` FOREIGN KEY (`NUMP`) REFERENCES `plot` (`NUMP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
