-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour projet_hafida
CREATE DATABASE IF NOT EXISTS `projet_hafida` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `projet_hafida`;

-- Listage de la structure de table projet_hafida. annonce
CREATE TABLE IF NOT EXISTS `annonce` (
  `id_annonce` int NOT NULL AUTO_INCREMENT,
  `logement_id` int NOT NULL,
  `utilisateur_id` int NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nbChat` int NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `description` text NOT NULL,
  `estValide` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_annonce`),
  KEY `id_logement` (`logement_id`) USING BTREE,
  KEY `id_utilisateur` (`utilisateur_id`) USING BTREE,
  CONSTRAINT `FK_annonce_logement` FOREIGN KEY (`logement_id`) REFERENCES `logement` (`id_logement`),
  CONSTRAINT `FK_annonce_utilisateur` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table projet_hafida. avis
CREATE TABLE IF NOT EXISTS `avis` (
  `id_avis` int NOT NULL AUTO_INCREMENT,
  `dateAvis` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `commentaire` text NOT NULL,
  `logement_id` int NOT NULL,
  `utilisateur_id` int NOT NULL,
  PRIMARY KEY (`id_avis`),
  KEY `logement_id` (`logement_id`),
  KEY `utilisateur_id` (`utilisateur_id`),
  CONSTRAINT `FK__logement` FOREIGN KEY (`logement_id`) REFERENCES `logement` (`id_logement`),
  CONSTRAINT `FK__utilisateur` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table projet_hafida. image
CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `logement_id` int NOT NULL DEFAULT '0',
  `nomImage` varchar(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  `altImage` varchar(255) NOT NULL,
  PRIMARY KEY (`id_image`),
  KEY `FK_image_logement` (`logement_id`),
  CONSTRAINT `FK_image_logement` FOREIGN KEY (`logement_id`) REFERENCES `logement` (`id_logement`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table projet_hafida. logement
CREATE TABLE IF NOT EXISTS `logement` (
  `id_logement` int NOT NULL AUTO_INCREMENT,
  `typeLogement_id` int NOT NULL,
  `utilisateur_id` int NOT NULL,
  `nbChambre` int NOT NULL DEFAULT '0',
  `rue` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CP` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id_logement`),
  KEY `id_utilisateur` (`utilisateur_id`) USING BTREE,
  KEY `id_type` (`typeLogement_id`) USING BTREE,
  CONSTRAINT `FK_logement_typelogement` FOREIGN KEY (`typeLogement_id`) REFERENCES `typelogement` (`id_typeLogement`),
  CONSTRAINT `FK_logement_utilisateur` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table projet_hafida. reserver
CREATE TABLE IF NOT EXISTS `reserver` (
  `utilisateur_id` int NOT NULL,
  `annonce_id` int NOT NULL,
  `valide` tinyint NOT NULL DEFAULT '0',
  `numeroTelephone` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nbAdultes` int NOT NULL,
  `nbEnfants` int NOT NULL,
  `paiement` varchar(255) NOT NULL DEFAULT '',
  `question` varchar(255) NOT NULL DEFAULT '',
  KEY `id_utilisateur` (`utilisateur_id`) USING BTREE,
  KEY `id_annonce` (`annonce_id`) USING BTREE,
  CONSTRAINT `FK_reserver_annonce` FOREIGN KEY (`annonce_id`) REFERENCES `annonce` (`id_annonce`),
  CONSTRAINT `FK_reserver_utilisateur` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table projet_hafida. typelogement
CREATE TABLE IF NOT EXISTS `typelogement` (
  `id_typeLogement` int NOT NULL AUTO_INCREMENT,
  `nomType` varchar(255) NOT NULL,
  PRIMARY KEY (`id_typeLogement`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de table projet_hafida. utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'user',
  `nom` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `prenom` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Les données exportées n'étaient pas sélectionnées.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
