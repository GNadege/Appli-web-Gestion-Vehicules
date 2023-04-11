-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 11 avr. 2023 à 12:05
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_sn`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `idadmin` tinyint(1) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pwd` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `niveau` tinyint(1) NOT NULL,
  `fonction` varchar(30) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `nom` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prenom` varchar(40) NOT NULL,
  PRIMARY KEY (`idadmin`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`idadmin`, `login`, `pwd`, `niveau`, `fonction`, `Description`, `nom`, `prenom`) VALUES
(2, 'nadege', 'a5bf5eada9bda308420a982dc8a7c924a41f1c71', 1, '', '0', 'GRANDYOT', 'Nadège'),
(3, 'JPP', '68eeed9bb9d86c240b87a2364e44f7a80786ccce', 1, 'Technicien', '', 'Pernaut', 'Jean-Pierre'),
(4, 'eric', '1edc35ebfe55de9a33b355512893f5b0174d194e', 1, 'Plombier', '', 'Antoine', 'Eric'),
(5, 'Jury1', '537c68213a47b18e6ab907ad065fc4d2a03e7178', 1, '', '', 'Jury 1', ''),
(6, 'Jury2', 'f90cc593911d3d6653aaaeb6a885255f3d1bcec5', 1, '', '', 'Jury2', '');

-- --------------------------------------------------------

--
-- Structure de la table `dispo`
--

DROP TABLE IF EXISTS `dispo`;
CREATE TABLE IF NOT EXISTS `dispo` (
  `idvehicule` int NOT NULL,
  `idadmin` int NOT NULL,
  `iddispo` smallint NOT NULL AUTO_INCREMENT,
  `date_emprunt` date NOT NULL,
  `date_retour` date NOT NULL,
  `date_reservation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `commentaire` text NOT NULL,
  PRIMARY KEY (`iddispo`),
  KEY `idvehicule` (`idvehicule`),
  KEY `idadmin` (`idadmin`)
) ENGINE=MyISAM AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `dispo`
--

INSERT INTO `dispo` (`idvehicule`, `idadmin`, `iddispo`, `date_emprunt`, `date_retour`, `date_reservation`, `commentaire`) VALUES
(4, 4, 88, '2023-03-16', '2023-03-17', '2023-03-07 16:51:13', 'truc'),
(1, 3, 94, '2023-03-29', '2023-03-30', '2023-03-28 15:37:35', 'vive les '),
(4, 2, 93, '2023-03-18', '2023-03-29', '2023-03-14 14:01:00', 'Emplacement C13'),
(2, 3, 92, '2023-03-21', '2023-03-22', '2023-03-08 16:40:13', 'NNNN'),
(4, 4, 90, '2023-03-30', '2023-04-01', '2023-03-07 17:05:14', 'un comm'),
(4, 3, 91, '2023-04-02', '2023-04-06', '2023-03-07 19:30:39', 'avec pare choc'),
(4, 2, 73, '2023-03-07', '2023-03-08', '0000-00-00 00:00:00', ''),
(3, 2, 72, '2023-03-07', '2023-03-08', '0000-00-00 00:00:00', ''),
(1, 2, 71, '2023-03-07', '2023-03-08', '0000-00-00 00:00:00', ''),
(2, 2, 58, '2023-03-12', '2023-03-18', '2023-03-07 10:58:22', 'bah');

-- --------------------------------------------------------

--
-- Structure de la table `type_vehicule`
--

DROP TABLE IF EXISTS `type_vehicule`;
CREATE TABLE IF NOT EXISTS `type_vehicule` (
  `idtype` tinyint NOT NULL AUTO_INCREMENT,
  `intitule` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idtype`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `type_vehicule`
--

INSERT INTO `type_vehicule` (`idtype`, `intitule`) VALUES
(1, 'Utilitaire'),
(2, 'Camion Poubelle'),
(3, 'Voiture'),
(4, 'Fourgon'),
(5, 'Pick-UP'),
(6, 'Minibus'),
(7, 'BUS');

-- --------------------------------------------------------

--
-- Structure de la table `vehicules`
--

DROP TABLE IF EXISTS `vehicules`;
CREATE TABLE IF NOT EXISTS `vehicules` (
  `idvehicule` tinyint NOT NULL AUTO_INCREMENT,
  `modele` varchar(40) NOT NULL,
  `carburant` varchar(10) NOT NULL,
  `plaque` varchar(9) NOT NULL,
  `type` tinyint NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `Anneecontrole` date NOT NULL,
  `Description` varchar(100) NOT NULL,
  `emplacement` varchar(4) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`idvehicule`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `vehicules`
--

INSERT INTO `vehicules` (`idvehicule`, `modele`, `carburant`, `plaque`, `type`, `statut`, `Anneecontrole`, `Description`, `emplacement`) VALUES
(1, 'Peugeot Partner', 'SP95', 'AA-00-AA', 1, 0, '2023-02-01', '', 'A10'),
(2, 'Semat Cargopac', 'Gazole', 'BB-11-BB', 2, 1, '2022-12-12', '', 'D5'),
(3, 'Clio3', 'SP98/95', 'DZ-678-AE', 3, 0, '2023-03-07', '', 'B6'),
(4, 'Pegeot Boxer', 'Diesel', 'TR-395-LS', 4, 0, '0000-00-00', '', 'D4');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
