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

-- Listage des données de la table projet_hafida.annonce : ~3 rows (environ)
INSERT INTO `annonce` (`id_annonce`, `logement_id`, `utilisateur_id`, `dateCreation`, `nbChat`, `dateDebut`, `dateFin`, `description`, `estValide`) VALUES
	(1, 1, 6, '2024-06-09 13:15:48', 1, '2024-07-15', '2024-07-30', 'Jolie maison au coeur de la ville', 0),
	(2, 2, 3, '2024-06-09 13:19:21', 2, '2024-08-01', '2024-08-15', 'Bel appartement haussmanien, spacieux et confortable', 1),
	(8, 7, 6, '2024-07-24 13:39:36', 1, '2024-08-01', '2024-08-15', 'Maison très spacieuse et bien située', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table projet_hafida.avis : ~3 rows (environ)
INSERT INTO `avis` (`id_avis`, `dateAvis`, `commentaire`, `logement_id`, `utilisateur_id`) VALUES
	(1, '2024-06-10 09:21:52', 'Très bien', 1, 4),
	(2, '2024-06-10 09:23:15', 'Parfait', 2, 4),
	(6, '2024-07-11 14:45:11', 'ok', 6, 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Listage des données de la table projet_hafida.logement : ~6 rows (environ)
INSERT INTO `logement` (`id_logement`, `typeLogement_id`, `utilisateur_id`, `nbChambre`, `rue`, `CP`, `ville`, `image`) VALUES
	(1, 1, 6, 4, 'rue Emile Mathis', '67000', 'Strasbourg', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRejWjXOlNie6FTSAeZ2RJoyumDhGJV_fhlaw&s'),
	(2, 2, 6, 3, 'rue du Chemin', '70000', 'Vesoul', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLKSrOL_x6rdXBh7i4bJ9o7NJXiK3RjuCK3g&s'),
	(3, 1, 6, 3, 'rue du Poitou', '68000', 'Mulhouse', 'https://images.pexels.com/photos/3555615/pexels-photo-3555615.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260'),
	(4, 1, 6, 4, 'rue des Platanes', '68000', 'Mulhouse', 'https://th.bing.com/th/id/R.21658bbd6bd48d461370b96c05580dba?rik=GFSJzRIkgsui5A&pid=ImgRaw&r=0'),
	(6, 1, 6, 4, 'rue des Jonquilles', '70000', 'Vesoul', 'https://th.bing.com/th/id/R.2ba5d5204d04be664899c094a482327a?rik=Jk7ANqt4NAQBRA&riu=http%3a%2f%2fmedias.residences-immobilier.com%2farticles_RI%2fimages%2fPhoto_8489_679.jpg&ehk=i8Us4QINxY8MbmajIunoZuW6Mrr9%2ftV1JKCgAlOMPQE%3d&risl=&pid=ImgRaw&r=0'),
	(7, 1, 6, 4, 'rue Parmentier', '70300', 'Froideconche', 'https://images.pexels.com/photos/280222/pexels-photo-280222.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2');

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

-- Listage des données de la table projet_hafida.reserver : ~5 rows (environ)
INSERT INTO `reserver` (`utilisateur_id`, `annonce_id`, `valide`, `numeroTelephone`, `nbAdultes`, `nbEnfants`, `paiement`, `question`) VALUES
	(3, 2, 0, '0670809000', 2, 2, 'carte Visa', 'Y a t il le Wi-fi?'),
	(2, 2, 0, '0765432189', 2, 1, 'Paypal', 'Y a t\'il un parking pour se garer?'),
	(6, 1, 0, '0764432167', 1, 1, 'paypal', 'ok'),
	(6, 2, 0, '0987654321', 2, 2, 'paypal', 'NO'),
	(6, 2, 1, '0987654321', 2, 2, 'paypal', 'NON');

-- Listage de la structure de table projet_hafida. typelogement
CREATE TABLE IF NOT EXISTS `typelogement` (
  `id_typeLogement` int NOT NULL AUTO_INCREMENT,
  `nomType` varchar(255) NOT NULL,
  PRIMARY KEY (`id_typeLogement`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table projet_hafida.typelogement : ~2 rows (environ)
INSERT INTO `typelogement` (`id_typeLogement`, `nomType`) VALUES
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Listage des données de la table projet_hafida.utilisateur : ~6 rows (environ)
INSERT INTO `utilisateur` (`id_utilisateur`, `pseudo`, `email`, `password`, `role`, `nom`, `prenom`) VALUES
	(1, 'Glenn\r\n', 'glenn67@gmail.com', '123456AZERTY', 'user', 'DUPONT', 'Marc'),
	(2, 'Zack', 'zack67@gmail.com', '123456AZERTY', 'user', 'ROLLAND', 'René'),
	(3, 'Magda', 'magda67@gmail.com', '123456AZERTY', 'user', 'ARNAUD  ', 'Julie'),
	(4, 'Micka', 'micka@exemple.com', 'helloworld', 'user', 'STURME', 'Mickael'),
	(5, 'Elsa', 'elsa78@gmail.com', '$2y$10$GNXBz0GOVtR0xlSOETyHZuX7NQcq0lEfGkFNlaHN8asqm6neiy5V6', 'user', 'HENRY', 'Elsa'),
	(6, 'Lea', 'lea@gmail.com', '$2y$10$D/FHCUbzE.pNS/Hf1vsHWu39kFZtrq1qwE2ra5POCgrmLjY26YlaG', 'user', 'BECKER', 'Léa');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
