-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 03 sep. 2020 à 16:14
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `annonces`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `ann_unique_id` int(11) NOT NULL AUTO_INCREMENT,
  `ann_description` varchar(250) NOT NULL,
  `ann_image_url` varchar(250) NOT NULL,
  `ann_image_nom` varchar(250) NOT NULL,
  `ann_est_valider` varchar(250) NOT NULL,
  `ann_date_ecriture` date NOT NULL,
  `ann_date_validation` date DEFAULT NULL,
  `iD_categorie` int(11) NOT NULL,
  `ID_utilisateur` int(11) NOT NULL,
  `ann_titre` varchar(50) NOT NULL,
  `ann_prix` int(10) DEFAULT NULL,
  PRIMARY KEY (`ann_unique_id`),
  KEY `fk_utilisateur` (`ID_utilisateur`),
  KEY `fk_categorie` (`iD_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`ann_unique_id`, `ann_description`, `ann_image_url`, `ann_image_nom`, `ann_est_valider`, `ann_date_ecriture`, `ann_date_validation`, `iD_categorie`, `ID_utilisateur`, `ann_titre`, `ann_prix`) VALUES
(17, 'Bonjour je vend un appartement 22 m²', 'im.jpg', 'im.jpg', 'false', '2020-09-03', NULL, 1, 16, 'vente d\'appartement', 20000),
(18, 'Ceci est une chaussure', '', '', 'false', '2020-09-03', NULL, 8, 17, 'Chaussures femmes', 45),
(35, 'ceci est un appart', 'non', 'non', 'false', '2020-09-15', NULL, 2, 17, 'appartement ou maison', 150000),
(36, 'ceci est un avion', 'avion', 'avion', 'false', '2020-09-15', NULL, 6, 6, 'louer avion', 12000),
(37, 'ceci est un métier', 'non', 'suitcase', 'false', '2020-09-29', NULL, 3, 7, 'dev web', 15),
(38, 'ceci est un chameau', 'dromaire', 'lol', 'false', '2020-09-15', NULL, 4, 16, 'ride a camel', 78),
(39, 'ceci est une baignoire', 'dsd', 'gbfgfg', 'false', '2020-09-16', NULL, 8, 7, 'jacuzzi', 785),
(40, 'ceci est un hotel ', 'peut etre ', 'non', 'false', '2020-09-14', NULL, 6, 1, 'hotel ipisse', 55),
(42, 'ceci est autre chose', 'un', 'deux', 'false', '2020-09-23', NULL, 8, 7, 'un autre truc', 15),
(44, 'Pas de prix', '', '', 'false', '2020-09-08', NULL, 3, 17, 'test', NULL),
(45, 'descrpiton', 'dsdsds', 'sdsddsd', 'false', '2020-09-22', NULL, 3, 16, '12345678901234567890123456789012345678901234567890', 750),
(46, 'Bblblblbblblbl', '20200719_135047.jpg', '20200719_135047.jpg', 'false', '2020-09-03', NULL, 8, 20, 'Yes', 81);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `annonce_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `annonce_ibfk_2` FOREIGN KEY (`iD_categorie`) REFERENCES `categorie` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
