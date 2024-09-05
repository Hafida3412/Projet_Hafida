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

-- Listage des données de la table projet_hafida.annonce : ~4 rows (environ)
REPLACE INTO `annonce` (`id_annonce`, `logement_id`, `utilisateur_id`, `dateCreation`, `nbChat`, `dateDebut`, `dateFin`, `description`, `estValide`) VALUES
	(1, 1, 1, '2024-06-09 13:15:48', 1, '2024-07-15', '2024-07-30', 'Jolie maison au coeur de la ville', 0),
	(2, 2, 2, '2024-06-09 13:19:21', 2, '2024-08-01', '2024-08-15', 'Bel appartement haussmanien, spacieux et confortable', 0),
	(6, 3, 3, '2024-06-13 20:22:08', 2, '2024-06-13', '2024-06-20', 'Belle maison, spacieuse. Située en plein coeur de la nature. Commerces à proximité.', 1),
	(8, 5, 5, '2024-08-26 20:24:55', 2, '2024-08-31', '2024-09-07', 'Belle maison. Située en plein coeur de la nature. ', 0);

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

-- Listage des données de la table projet_hafida.avis : ~3 rows (environ)
REPLACE INTO `avis` (`id_avis`, `dateAvis`, `commentaire`, `logement_id`, `utilisateur_id`) VALUES
	(1, '2024-06-10 09:21:52', 'Nous avons passé un super séjour. Le logement est super confortable et bien situé.', 1, 3),
	(2, '2024-06-10 09:23:15', 'Nous sommes très satisfaits de notre séjour. L\'hôte était disponible et son logement super', 2, 3),
	(3, '2024-08-30 09:00:34', 'Super', 2, 5),
	(4, '2024-09-04 12:53:30', 'Nous avons passé un super séjour!', 3, 6),
	(6, '2024-09-04 14:00:13', 'super', 5, 6),
	(7, '2024-09-04 14:20:42', 'Nous avons passé un super moment. Logement très confortable et spacieux. Chat super sociable.', 3, 6);

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

-- Listage des données de la table projet_hafida.image : ~4 rows (environ)
REPLACE INTO `image` (`id_image`, `logement_id`, `nomImage`, `altImage`) VALUES
	(16, 2, '66d02e023a5742.22947578.jpg', 'Vesoul'),
	(17, 3, '66d0daa6b58899.89483344.jpg', 'Mulhouse'),
	(18, 3, '66d0dafdd57d69.71140796.jpg', 'Mulhouse'),
	(19, 1, '66d0dc54c3a565.66578166.jpg', 'Strasbourg');

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

-- Listage des données de la table projet_hafida.logement : ~5 rows (environ)
REPLACE INTO `logement` (`id_logement`, `typeLogement_id`, `utilisateur_id`, `nbChambre`, `rue`, `CP`, `ville`, `image`) VALUES
	(1, 1, 1, 4, 'rue Emile Mathis', '67000', 'Strasbourg', 'https://images.pexels.com/photos/6538945/pexels-photo-6538945.jpeg?auto=compress&cs=tinysrgb&w=600'),
	(2, 2, 2, 3, 'rue du Chemin', '70000', 'Vesoul', 'https://images.pexels.com/photos/7147284/pexels-photo-7147284.jpeg?auto=compress&cs=tinysrgb&w=600'),
	(3, 1, 3, 3, 'rue du Poitou', '68000', 'Mulhouse', 'https://images.pexels.com/photos/3555615/pexels-photo-3555615.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260'),
	(4, 1, 4, 4, 'rue des Platanes', '68000', 'Mulhouse', 'https://th.bing.com/th/id/R.21658bbd6bd48d461370b96c05580dba?rik=GFSJzRIkgsui5A&pid=ImgRaw&r=0'),
	(5, 1, 5, 4, 'rue des Jonquilles', '70000', 'Vesoul', 'https://th.bing.com/th/id/R.2ba5d5204d04be664899c094a482327a?rik=Jk7ANqt4NAQBRA&riu=http%3a%2f%2fmedias.residences-immobilier.com%2farticles_RI%2fimages%2fPhoto_8489_679.jpg&ehk=i8Us4QINxY8MbmajIunoZuW6Mrr9%2ftV1JKCgAlOMPQE%3d&risl=&pid=ImgRaw&r=0');

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

-- Listage des données de la table projet_hafida.reserver : ~0 rows (environ)
REPLACE INTO `reserver` (`utilisateur_id`, `annonce_id`, `valide`, `numeroTelephone`, `nbAdultes`, `nbEnfants`, `paiement`, `question`) VALUES
	(5, 2, 0, '0670809000', 2, 2, 'carte Visa', 'Y a t il le Wi-fi?'),
	(2, 2, 0, '0765432189', 2, 1, 'Paypal', 'Y a t\'il un parking pour se garer?'),
	(6, 8, 0, '0654897584', 2, 2, 'Paypal\r\n', 'Quelles sont les activités proposées dans les alentours?'),
	(6, 6, 1, '0764432167', 2, 2, 'paypal', 'ok');

-- Listage de la structure de table projet_hafida. typelogement
CREATE TABLE IF NOT EXISTS `typelogement` (
  `id_typeLogement` int NOT NULL AUTO_INCREMENT,
  `nomType` varchar(255) NOT NULL,
  PRIMARY KEY (`id_typeLogement`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table projet_hafida.typelogement : ~0 rows (environ)
REPLACE INTO `typelogement` (`id_typeLogement`, `nomType`) VALUES
	(1, 'maison'),
	(2, 'appartement');

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

-- Listage des données de la table projet_hafida.utilisateur : ~6 rows (environ)
REPLACE INTO `utilisateur` (`id_utilisateur`, `pseudo`, `email`, `password`, `role`, `nom`, `prenom`) VALUES
	(1, 'Glenn\r\n', 'glenn67@gmail.com', '123456AZERTY', 'user', 'DUPONT', 'Marc'),
	(2, 'Zack', 'zack67@gmail.com', '123456AZERTY', 'user', 'ROLLAND', 'René'),
	(3, 'Magda', 'magda67@gmail.com', 'AZERTY12345', 'user', 'ARNAUD  ', 'Julie'),
	(4, 'micka', 'micka@exemple.com', '$2y$10$J0Eoq08vM/Ht5ZCPNV.1H.aCkncUeWaP592HshWbGu/bAMUK4AjnW', 'user', 'STURME', 'Mickael'),
	(5, 'Lea', 'lea@gmail.com', '$2y$10$98Ce7ZlJXuhgRNnrK4BwO.vm3eGZ1kMqnm12HwFXsUEpVAD8u3Tiy', 'ROLE_ADMIN', 'BECKER', 'Léa'),
	(6, 'Joe', 'joe@gmail.com', '$2y$10$Qc/.TcrpivsFdJh/8DNPKeg04zXsLVqdYh4XVw10ULcwRrPGz2i1e', 'user', 'MARTIN', 'Joe');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
