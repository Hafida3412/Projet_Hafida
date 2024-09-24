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
CREATE DATABASE IF NOT EXISTS `projet_hafida` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Listage des données de la table projet_hafida.annonce : ~5 rows (environ)
INSERT INTO `annonce` (`id_annonce`, `logement_id`, `utilisateur_id`, `dateCreation`, `nbChat`, `dateDebut`, `dateFin`, `description`, `estValide`) VALUES
	(1, 1, 1, '2024-06-09 13:15:48', 1, '2024-07-15', '2024-07-30', 'Jolie maison au coeur de la ville', 0),
	(2, 2, 2, '2024-06-09 13:19:21', 2, '2024-08-01', '2024-08-15', 'Bel appartement haussmanien, spacieux et confortable. Garage.', 0),
	(8, 6, 5, '2024-09-08 11:35:11', 1, '2024-09-09', '2024-09-15', 'Grande maison spacieuse, bien située. Chat sociable. Commerces et aires de jeux à proximité.', 0),
	(10, 7, 5, '2024-09-08 11:59:35', 1, '2024-09-23', '2024-09-29', 'Grande maison, très spacieuse, avec vue sur la mer. Chat très sociable.', 1),
	(12, 8, 7, '2024-09-09 21:11:03', 1, '2024-09-16', '2024-09-22', 'Grande maison spacieuse avec 3 chambres. La mer est à 2km. Commerces et transports en commun à proximité. Chat très sociable.', 0);

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

-- Listage des données de la table projet_hafida.avis : ~7 rows (environ)
INSERT INTO `avis` (`id_avis`, `dateAvis`, `commentaire`, `logement_id`, `utilisateur_id`) VALUES
	(1, '2024-06-10 09:21:52', 'Nous avons passé un super séjour. Le logement est super confortable et bien situé.', 1, 3),
	(2, '2024-06-10 09:23:15', 'Nous sommes très satisfaits de notre séjour. L\'hôte était disponible et son logement super', 2, 3),
	(3, '2024-09-04 21:01:19', 'Le séjour s&#39;est très bien passé...L&#39;endroit est magnifique.', 3, 5),
	(4, '2024-09-04 22:14:39', 'Je suis ravie de mon séjour', 4, 5),
	(5, '2024-09-05 10:57:00', 'Très ravie de mon expérience', 1, 5),
	(6, '2024-09-08 11:02:06', 'Très satisfait', 7, 5),
	(7, '2024-09-08 12:53:16', 'Nous avons passé une semaine super! La mer à proximité, l&#39;endroit est bien situé. Chat trop mignon.', 7, 7);

-- Listage de la structure de table projet_hafida. image
CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `nomImage` varchar(255) NOT NULL DEFAULT '0',
  `altImage` varchar(255) NOT NULL DEFAULT '0',
  `logement_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_image`),
  KEY `logement_id` (`logement_id`),
  CONSTRAINT `FK_image_logement` FOREIGN KEY (`logement_id`) REFERENCES `logement` (`id_logement`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Listage des données de la table projet_hafida.image : ~23 rows (environ)
INSERT INTO `image` (`id_image`, `nomImage`, `altImage`, `logement_id`) VALUES
	(1, '66d9f7254e3a84.68958559.jpg', 'Mulhouse', 3),
	(2, '66d9f8f505ed79.79606379.jpg', 'Mulhouse', 3),
	(3, '66d9fc0e0857a2.30074603.jpg', 'Mulhouse', 3),
	(4, '66d9fd6dd1fe81.63138725.jpg', 'Mulhouse', 3),
	(5, '66da0194cd6ef0.30255880.jpg', 'Mulhouse', 3),
	(6, '66da025bdd50a7.20389027.jpg', 'Mulhouse', 3),
	(7, '66da06514f3662.03961193.jpg', 'Mulhouse', 3),
	(8, '66da0bcb6d14f5.41886514.jpg', 'Mulhouse', 3),
	(9, '66da11ca3d9ce2.32791332.jpg', 'Mulhouse', 3),
	(10, '66da13af7021f4.16493588.jpg', 'Mulhouse', 3),
	(11, '66da145dd6de19.67453339.jpg', 'Mulhouse', 3),
	(13, '66dd7f112fde88.96962414.jpg', 'Montpellier', 7),
	(14, '66dd800da7ec90.88429143.jpg', 'Montpellier', 7),
	(15, '66dd814446d639.40718676.jpg', 'Montpellier', 7),
	(16, '66de0383891190.99721721.jpg', 'Montpellier', 7),
	(17, '66de9dcdb147d2.21391678.jpg', 'Perpignan', 6),
	(18, '66de9e3c233328.27618268.jpg', 'Perpignan', 6),
	(19, '66de9f31863c61.85918547.jpg', 'Perpignan', 6),
	(20, '66dea08de285e6.59247506.jpg', 'Perpignan', 6),
	(21, '66df065f72a729.25430766.jpg', 'La Rochelle', 8),
	(23, '66df49758c5ee5.38135258.jpg', 'La Rochelle', 8),
	(24, '66df49fc996700.65547571.jpg', 'La Rochelle', 8),
	(26, '66df4c512df8f8.36007712.jpg', 'La Rochelle', 8),
	(27, '66df4f5679f3c8.73749744.jpg', 'La Rochelle', 8);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Listage des données de la table projet_hafida.logement : ~11 rows (environ)
INSERT INTO `logement` (`id_logement`, `typeLogement_id`, `utilisateur_id`, `nbChambre`, `rue`, `CP`, `ville`, `image`) VALUES
	(1, 1, 4, 4, 'rue Emile Mathis', '67000', 'Strasbourg', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRejWjXOlNie6FTSAeZ2RJoyumDhGJV_fhlaw&s'),
	(2, 2, 1, 3, 'rue du Chemin', '70000', 'Vesoul', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLKSrOL_x6rdXBh7i4bJ9o7NJXiK3RjuCK3g&s'),
	(3, 1, 4, 3, 'rue du Poitou', '68000', 'Mulhouse', 'https://images.pexels.com/photos/3555615/pexels-photo-3555615.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260'),
	(4, 1, 4, 4, 'rue des Platanes', '68000', 'Mulhouse', 'https://th.bing.com/th/id/R.21658bbd6bd48d461370b96c05580dba?rik=GFSJzRIkgsui5A&pid=ImgRaw&r=0'),
	(5, 1, 4, 4, 'rue des Jonquilles', '70000', 'Vesoul', 'https://th.bing.com/th/id/R.2ba5d5204d04be664899c094a482327a?rik=Jk7ANqt4NAQBRA&riu=http%3a%2f%2fmedias.residences-immobilier.com%2farticles_RI%2fimages%2fPhoto_8489_679.jpg&ehk=i8Us4QINxY8MbmajIunoZuW6Mrr9%2ftV1JKCgAlOMPQE%3d&risl=&pid=ImgRaw&r=0'),
	(6, 1, 5, 4, 'rue de la Papeterie', '66000', 'Perpignan', 'https://images.pexels.com/photos/18559615/pexels-photo-18559615/free-photo-of-maison-table-luxe-cuisine.jpeg?auto=compress&cs=tinysrgb&w=600'),
	(7, 1, 5, 3, 'rue des Flamands', '34000', 'Montpellier', 'https://images.pexels.com/photos/1571457/pexels-photo-1571457.jpeg?auto=compress&cs=tinysrgb&w=600'),
	(8, 1, 7, 3, 'rue Jacques Prévert', '17000', 'La Rochelle', 'https://images.pexels.com/photos/7174405/pexels-photo-7174405.jpeg?auto=compress&cs=tinysrgb&w=600'),
	(9, 1, 5, 4, 'avenue de Strasbourg', '69100', 'Lyon', 'https://images.pexels.com/photos/3555615/pexels-photo-3555615.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260'),
	(10, 1, 5, 5, 'rue des Alouettes', '06000', 'Nice', 'https://th.bing.com/th/id/R.21658bbd6bd48d461370b96c05580dba?rik=GFSJzRIkgsui5A&pid=ImgRaw&r=0'),
	(11, 1, 5, 4, 'rue des Charmilles', '44100', 'Nantes', 'https://th.bing.com/th/id/R.21658bbd6bd48d461370b96c05580dba?rik=GFSJzRIkgsui5A&pid=ImgRaw&r=0');

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

-- Listage des données de la table projet_hafida.reserver : ~6 rows (environ)
INSERT INTO `reserver` (`utilisateur_id`, `annonce_id`, `valide`, `numeroTelephone`, `nbAdultes`, `nbEnfants`, `paiement`, `question`) VALUES
	(3, 2, 0, '0670809000', 2, 2, 'carte Visa', 'Y a t il le Wi-fi?'),
	(2, 2, 0, '0765432189', 2, 1, 'Paypal', 'Y a t\'il un parking pour se garer?'),
	(5, 1, 0, '0987654321', 2, 2, 'paypal', 'Quelles sont les activités proposées aux enfants dans les alentours?'),
	(5, 2, 0, '0987654321', 2, 2, 'paypal', 'NO'),
	(7, 10, 0, '0786543291', 2, 2, 'paypal', 'NON');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Listage des données de la table projet_hafida.utilisateur : ~9 rows (environ)
INSERT INTO `utilisateur` (`id_utilisateur`, `pseudo`, `email`, `password`, `role`, `nom`, `prenom`) VALUES
	(1, 'Glenn\r\n', 'glenn67@exemple.com', '$2y$10$jm7YmiefTCwMSyGSQXDrse2IKfgU3c3J5h/.pPKF7gBgI5fR0kIUG', 'user', 'DUPONT', 'Marc'),
	(2, 'Zack', 'zack67@exemple.com', '$2y$10$rm0109dKYkACKhl75KIic.v9g5mCNn0kusj2J/q7uGbtJEmmkT3va', 'user', 'ROLLAND', 'René'),
	(3, 'Magda', 'magda67@exemple.com', '$2y$10$j4kCWzAPb3DRRhVIuikrfea5M2Ogy/HP0QK6LH.GWhXoTbeEFo0c.', 'user', 'ARNAUD  ', 'Julie'),
	(4, 'micka', 'micka@exemple.com', '$2y$10$J0Eoq08vM/Ht5ZCPNV.1H.aCkncUeWaP592HshWbGu/bAMUK4AjnW', 'user', 'STURME', 'Mickael'),
	(5, 'L&eacute;a', 'lea@exemple.com', '$2y$10$4JhbV9V733hLoAUMMhZYregit8fqS8.Q4Lr/YelRWvdFVYMnO01Qm', 'ROLE_ADMIN', 'DURAND', 'Léa'),
	(7, 'Joe', 'joe@exemple.com', '$2y$10$UpeoFLWQKadErLl.BGjGWuJLHeLm/4aoN5bzDAImvp2P7hmskRtfW', 'user', 'ARMAND', 'Joe'),
	(8, 'lucy', 'test6@exemple.com', '$2y$10$E7GOM5qRHgxy5RUFmhhgeOzK639diC.5x7d.tctjZ8n9MwXQSoyiy', 'user', 'ARNOLD', 'Lucie'),
	(10, 'test7', 'test7@exemple.com', '$2y$10$Y/J05G3WPqy1p8LI8O4Oq.xHHLNwj5tfTPEGSe1rNvt2s.48md8gW', 'user', 'RAYMOND', 'Gilles'),
	(13, 'momo', 'momo@exemple.fr', '$2y$10$qAIJoC8XQA4/FOKWdwZawucowbvzzDKZNwoIWRG.41iLtOunTQPHi', 'user', 'BERTRAND', 'Louis');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
