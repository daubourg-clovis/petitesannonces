-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 11 sep. 2020 à 13:11
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`ann_unique_id`, `ann_description`, `ann_image_url`, `ann_image_nom`, `ann_est_valider`, `ann_date_ecriture`, `ann_date_validation`, `iD_categorie`, `ID_utilisateur`, `ann_titre`, `ann_prix`) VALUES
(1, 'J\'ai perdu le mien lors d\'une sortie en chute libre, si vous le retrouver me contacter, sinon j\'en achète un neuf', '/img/parapluie.jpg', 'C:\\wamp64\\tmp\\php6D0A.tmp', 'true', '2020-09-11', NULL, 8, 31, 'Recherche parapluie résistant', 100),
(2, 'Baguette magique très puissante a vendre car je préfère les balais', '/img/baguette.jpg', 'C:\\wamp64\\tmp\\php2C0C.tmp', 'true', '2020-09-11', NULL, 8, 32, 'Vend baguette magique', 1500),
(3, 'Recherche un porteur pour un anneau à faire fondre à la montagne du destin. \r\nExpérience : une vie dédié au combat serait un plus. \r\nDemande un bon travail d\'équipe', '/img/anneau.jpg', 'C:\\wamp64\\tmp\\php6728.tmp', 'true', '2020-09-11', NULL, 3, 33, 'Cherche porteur de l\'anneau unique', 0),
(4, 'Mon bison volant ne s\'est pas dégourdi les pattes depuis longtemps, je vous propose donc de faire un petit tour', '/img/bison.jpg', 'C:\\wamp64\\tmp\\phpAE20.tmp', 'true', '2020-09-11', NULL, 5, 34, 'Tour de bison volant', 0),
(5, 'Le dragon que j\'ai corrompu fait des siennes, je le cède pour une modique somme', '/img/dragon.jpg', 'C:\\wamp64\\tmp\\phpCFEC.tmp', 'true', '2020-09-11', NULL, 4, 35, 'Vend dragon rebel', 750000),
(6, 'Je vend le costume que j\'ai acheté pour une soirée costumée mais je me suis trompé de thème', '/img/rebin des bois.jpg', 'C:\\wamp64\\tmp\\php473B.tmp', 'true', '2020-09-11', NULL, 8, 36, 'Vend costume robin des bois', 15),
(7, 'Vous voulez de l\'action et poutrer du démon, rejoignez moi en enfer et on va faire vibrer la tronçonneuse', '/img/enfer.jpg', 'C:\\wamp64\\tmp\\phpFB17.tmp', 'true', '2020-09-11', NULL, 6, 37, 'Des Vacances en enfer', 0),
(8, 'Recherche équipe pour transformer la réalité', '/img/Inception.jpg', 'C:\\wamp64\\tmp\\phpE20D.tmp', 'true', '2020-09-11', NULL, 3, 38, 'Recherche équipe de choc', 0),
(9, 'Mon chateau prend la poussière pendant que je suis mort, je le vend pas cher, avec plein d\'élèves dedans', '/img/poudlard.jpg', 'C:\\wamp64\\tmp\\phpE10F.tmp', 'true', '2020-09-11', NULL, 1, 39, 'Vend maison de campgne', 789456123),
(10, 'Voir titre', '/img/boules-cristal.jpg', 'C:\\wamp64\\tmp\\phpB43A.tmp', 'true', '2020-09-11', NULL, 7, 40, 'Chere partenaire pour trouver 7 boules de cristal', 0),
(11, 'Le druide du village s\'est cassé la jambe, on cherche quelqu’un de compétant pour le remplacer, si vous savez multiplier le pains on prend aussi', '/img/potion.jpg', 'C:\\wamp64\\tmp\\php1E5A.tmp', 'true', '2020-09-11', NULL, 3, 41, 'Cherche druide pour potion magique', 0),
(12, 'Elle n\'a ABSOLUMENT rien de spécial, elle appartenait a mon \"grand-père\"', '/img/delorean.jpg', 'C:\\wamp64\\tmp\\php9A5.tmp', 'true', '2020-09-11', NULL, 2, 42, 'Vend delorean', 120000),
(13, 'Je suis poursuivie par un homme qui semble dangereux, aidez moi', '/img/terminator.jpg', 'C:\\wamp64\\tmp\\php3768.tmp', 'true', '2020-09-11', NULL, 5, 43, 'AIdez moi', 0),
(15, 'Il en fallait un', '/img/', '', 'false', '2020-09-11', NULL, 8, 45, 'Test', 25),
(16, 'J\'ai perdu une chauve souris dans gotham', '/img/', '', 'true', '2020-09-11', NULL, 4, 46, 'Recherche chaude souris', 0);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `cat_libelle` varchar(250) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `categorie` (`cat_libelle`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`ID`, `cat_libelle`) VALUES
(7, 'Affaires pro'),
(4, 'Animaux'),
(2, 'Auto-Moto'),
(8, 'Autres'),
(3, 'Emploi'),
(1, 'Immobilier'),
(5, 'Services'),
(6, 'Vacances');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `usr_courriel` varchar(250) NOT NULL,
  `usr_nom` varchar(250) NOT NULL,
  `usr_prenom` varchar(250) NOT NULL,
  `usr_telephone` varchar(250) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`usr_courriel`, `usr_nom`, `usr_prenom`, `usr_telephone`, `ID`) VALUES
('clovis.daubourg@gmail.com', 'Marry', 'Poppins', '0610213040', 31),
('clovis.daubourg@gmail.com', 'Potter', 'Harry James', '062185110', 32),
('clovis.daubourg@gmail.com', 'Le Gris', 'Gandalf', '06000000', 33),
('clovis.daubourg@gmail.com', 'De L\'air', 'Ang', '0380403010', 34),
('clovis.daubourg@gmail.com', 'Dieu Très Ancien', 'N\'Zoth', '0875412301', 35),
('clovis.daubourg@gmail.com', 'Flantier', 'Noel', '02851478', 36),
('clovis.daubourg@gmail.com', 'DOOM', 'Guy', '06666666', 37),
('clovis.daubourg@gmail.com', 'Cole', 'Tom', '0381113141', 38),
('clovis.daubourg@gmail.com', 'Dumbledore', 'Albus', '02222222', 39),
('clovis.daubourg@gmail.com', 'San', 'Goku', '0707070707', 40),
('clovis.daubourg@gmail.com', 'Gaulois', 'Astérix', '06218161', 41),
('clovis.daubourg@gmail.com', 'McFly', 'Marty', '05010203', 42),
('clovis.daubourg@gmail.com', 'Connor', 'Sarah', '09090909', 43),
('clovis.daubourg@gmail.com', 'Lanister', 'Tirion', '0123456475', 44),
('clovis.daubourg@gmail.com', 'Test', '123', '05857412', 45),
('clovis.daubourg@gmail.com', 'Caire', 'Joe', '0380103040', 46);

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
