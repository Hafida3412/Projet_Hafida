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
  CONSTRAINT `FK_annonce_logement` FOREIGN KEY (`logement_id`) REFERENCES `logement` (`id_logement`) ON DELETE CASCADE,
  CONSTRAINT `FK_annonce_utilisateur` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Listage des données de la table projet_hafida.annonce : ~5 rows (environ)
INSERT INTO `annonce` (`id_annonce`, `logement_id`, `utilisateur_id`, `dateCreation`, `nbChat`, `dateDebut`, `dateFin`, `description`, `estValide`) VALUES
	(1, 1, 1, '2024-06-09 13:15:48', 1, '2024-07-15', '2024-07-30', 'Jolie maison au coeur de la ville. Chat sociable, gourmand, n\'aime pas sortir.', 0),
	(2, 2, 2, '2024-06-09 13:19:21', 2, '2024-08-01', '2024-08-15', 'Bel appartement haussmanien, spacieux et confortable. Garage.\r\nChat très sociable. Aime jouer et qu\'on s\'occupe de lui. Il n\'aime pas sortir. Il dort beaucoup.', 0),
	(10, 7, 5, '2024-09-08 11:59:35', 1, '2024-09-23', '2024-09-29', 'Grande maison, très spacieuse, avec vue sur la mer. Chat très sociable. Aime jouer et qu\'on s\'occupe de lui. Il n\'aime pas sortir. Il dort beaucoup.', 0),
	(12, 8, 7, '2024-09-09 21:11:03', 1, '2024-09-16', '2024-09-22', 'Grande maison spacieuse avec 3 chambres. La mer est à 2km. Commerces et transports en commun à proximité. Chat très sociable.', 0),
	(19, 16, 5, '2024-10-14 22:24:07', 1, '2024-10-18', '2024-10-25', 'Mon chat aime jouer et qu\'on s\'occupe de lui. Il n\'aime pas sortir. Il dort beaucoup.', 0);

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

-- Listage des données de la table projet_hafida.avis : ~9 rows (environ)
INSERT INTO `avis` (`id_avis`, `dateAvis`, `commentaire`, `logement_id`, `utilisateur_id`) VALUES
	(1, '2024-06-10 09:21:52', 'Nous avons passé un super séjour. Le logement est super confortable et bien situé.', 1, 3),
	(2, '2024-06-10 09:23:15', 'Nous sommes très satisfaits de notre séjour. L\'hôte était disponible et son logement super', 2, 3),
	(3, '2024-09-04 21:01:19', 'Le séjour s&#39;est très bien passé...L&#39;endroit est magnifique.', 3, 5),
	(4, '2024-09-04 22:14:39', 'Je suis ravie de mon séjour', 10, 3),
	(5, '2024-09-05 10:57:00', 'Très ravie de mon expérience', 1, 7),
	(6, '2024-09-08 11:02:06', 'Très satisfait', 7, 5),
	(7, '2024-09-08 12:53:16', 'Nous avons passé une semaine super! La mer à proximité, l&#39;endroit est bien situé. Chat trop mignon.', 7, 7),
	(8, '2024-10-27 14:53:39', 'Super expérience, très satisfait. Le chat était trop mignon, très calin, pas difficile...les propriétaires disponibles, on pouvait facilement les joindre par téléphone.', 1, 7),
	(9, '2024-10-27 15:00:48', 'Très belle expérience, le chat était trop mignon, très calin, il adore jouer et qu&#39;on s&#39;occupe de lui. Les propriétaires étaient facilement joignables.', 8, 5);

-- Listage de la structure de table projet_hafida. image
CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `nomImage` varchar(255) NOT NULL DEFAULT '0',
  `altImage` varchar(255) NOT NULL DEFAULT '0',
  `logement_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_image`),
  KEY `logement_id` (`logement_id`),
  CONSTRAINT `FK_image_logement` FOREIGN KEY (`logement_id`) REFERENCES `logement` (`id_logement`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Listage des données de la table projet_hafida.image : ~24 rows (environ)
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
	(21, '66df065f72a729.25430766.jpg', 'La Rochelle', 8),
	(23, '66df49758c5ee5.38135258.jpg', 'La Rochelle', 8),
	(24, '66df49fc996700.65547571.jpg', 'La Rochelle', 8),
	(26, '66df4c512df8f8.36007712.jpg', 'La Rochelle', 8),
	(27, '66df4f5679f3c8.73749744.jpg', 'La Rochelle', 8),
	(28, '671e4db8d9e1e1.11878908.jpeg', 'Illkirch', 16),
	(29, '671e4e347773a7.84471205.jpg', 'Illkirch', 16),
	(30, '671e4e80c383f3.61457786.jpg', 'Illkirch', 16),
	(31, '671e5001695168.33621772.jpg', 'Illkirch', 16),
	(32, '6720093cd1f412.93455917.jpg', 'Strasbourg', 1),
	(33, '6720098f8df842.19052838.jpg', 'Strasbourg', 1),
	(34, '672009e1771477.37201310.jpg', 'Strasbourg', 1),
	(35, '67200a4edfed05.57497749.jpg', 'Strasbourg', 1),
	(36, '67200bb3d8dc76.83145908.jpg', 'Vesoul', 2),
	(37, '67200c0619d8b0.57023013.jpg', 'Vesoul', 2),
	(38, '67200c4d4c3d85.79597497.jpg', 'Vesoul', 2),
	(39, '67200cecaf7a27.89678246.jpg', 'Vesoul', 2);

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
  CONSTRAINT `FK_logement_typelogement` FOREIGN KEY (`typeLogement_id`) REFERENCES `typelogement` (`id_typeLogement`) ON DELETE CASCADE,
  CONSTRAINT `FK_logement_utilisateur` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Listage des données de la table projet_hafida.logement : ~11 rows (environ)
INSERT INTO `logement` (`id_logement`, `typeLogement_id`, `utilisateur_id`, `nbChambre`, `rue`, `CP`, `ville`, `image`) VALUES
	(1, 1, 4, 4, 'rue Emile Mathis', '67000', 'Strasbourg', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRejWjXOlNie6FTSAeZ2RJoyumDhGJV_fhlaw&s'),
	(2, 2, 1, 3, 'rue du Chemin', '70000', 'Vesoul', 'https://images.pexels.com/photos/29120627/pexels-photo-29120627.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'),
	(3, 1, 4, 3, 'rue du Poitou', '68000', 'Mulhouse', 'https://images.pexels.com/photos/3555615/pexels-photo-3555615.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260'),
	(4, 1, 4, 4, 'rue des Platanes', '68000', 'Mulhouse', 'https://th.bing.com/th/id/R.21658bbd6bd48d461370b96c05580dba?rik=GFSJzRIkgsui5A&pid=ImgRaw&r=0'),
	(5, 1, 4, 4, 'rue des Jonquilles', '70000', 'Vesoul', 'https://th.bing.com/th/id/R.2ba5d5204d04be664899c094a482327a?rik=Jk7ANqt4NAQBRA&riu=http%3a%2f%2fmedias.residences-immobilier.com%2farticles_RI%2fimages%2fPhoto_8489_679.jpg&ehk=i8Us4QINxY8MbmajIunoZuW6Mrr9%2ftV1JKCgAlOMPQE%3d&risl=&pid=ImgRaw&r=0'),
	(7, 1, 5, 3, 'rue des Flamands', '34000', 'Montpellier', 'https://images.pexels.com/photos/1571457/pexels-photo-1571457.jpeg?auto=compress&cs=tinysrgb&w=600'),
	(8, 1, 7, 3, 'rue Jacques Prévert', '17000', 'La Rochelle', 'https://images.pexels.com/photos/7174405/pexels-photo-7174405.jpeg?auto=compress&cs=tinysrgb&w=600'),
	(9, 1, 5, 4, 'avenue de Strasbourg', '69100', 'Lyon', 'https://images.pexels.com/photos/3555615/pexels-photo-3555615.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260'),
	(10, 1, 5, 5, 'rue des Alouettes', '06000', 'Nice', 'https://th.bing.com/th/id/R.21658bbd6bd48d461370b96c05580dba?rik=GFSJzRIkgsui5A&pid=ImgRaw&r=0'),
	(11, 1, 5, 4, 'rue des Charmilles', '44100', 'Nantes', 'https://th.bing.com/th/id/R.21658bbd6bd48d461370b96c05580dba?rik=GFSJzRIkgsui5A&pid=ImgRaw&r=0'),
	(16, 1, 5, 2, 'Rue de Strasbourg', '67400', 'Illkirch', 'https://th.bing.com/th/id/R.2ba5d5204d04be664899c094a482327a?rik=Jk7ANqt4NAQBRA&riu=http%3a%2f%2fmedias.residences-immobilier.com%2farticles_RI%2fimages%2fPhoto_8489_679.jpg&ehk=i8Us4QINxY8MbmajIunoZuW6Mrr9%2ftV1JKCgAlOMPQE%3d&risl=&pid=ImgRaw&r=0');

-- Listage de la structure de table projet_hafida. reserver
CREATE TABLE IF NOT EXISTS `reserver` (
  `utilisateur_id` int DEFAULT NULL,
  `annonce_id` int DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `valide` tinyint NOT NULL DEFAULT '0',
  `numeroTelephone` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nbAdultes` int NOT NULL,
  `nbEnfants` int NOT NULL,
  `paiement` varchar(255) NOT NULL DEFAULT '',
  `question` varchar(255) NOT NULL DEFAULT '',
  `id_reserver` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_reserver`),
  KEY `id_utilisateur` (`utilisateur_id`) USING BTREE,
  KEY `id_annonce` (`annonce_id`) USING BTREE,
  CONSTRAINT `FK_reserver_annonce` FOREIGN KEY (`annonce_id`) REFERENCES `annonce` (`id_annonce`) ON DELETE SET NULL,
  CONSTRAINT `FK_reserver_utilisateur` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Listage des données de la table projet_hafida.reserver : ~2 rows (environ)
INSERT INTO `reserver` (`utilisateur_id`, `annonce_id`, `nom`, `prenom`, `valide`, `numeroTelephone`, `nbAdultes`, `nbEnfants`, `paiement`, `question`, `id_reserver`) VALUES
	(NULL, 12, 'Lemand', 'Edouard', 1, '0764432167', 2, 2, 'cb', 'NON', 12),
	(7, 1, 'DUPONT', 'MARC', 1, '0786874589', 2, 2, 'cb', 'NON', 14);

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
  `nom` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `prenom` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Listage des données de la table projet_hafida.utilisateur : ~8 rows (environ)
INSERT INTO `utilisateur` (`id_utilisateur`, `pseudo`, `email`, `password`, `role`, `nom`, `prenom`) VALUES
	(1, 'Glenn\r\n', 'glenn67@exemple.com', '$2y$10$jm7YmiefTCwMSyGSQXDrse2IKfgU3c3J5h/.pPKF7gBgI5fR0kIUG', 'user', 'DUPONT', 'Marc'),
	(2, 'Zack', 'zack67@exemple.com', '$2y$10$rm0109dKYkACKhl75KIic.v9g5mCNn0kusj2J/q7uGbtJEmmkT3va', 'user', 'ROLLAND', 'René'),
	(3, 'Magda', 'magda67@exemple.com', '$2y$10$j4kCWzAPb3DRRhVIuikrfea5M2Ogy/HP0QK6LH.GWhXoTbeEFo0c.', 'user', 'ARNAUD  ', 'Julie'),
	(4, 'micka', 'micka@exemple.com', '$2y$10$J0Eoq08vM/Ht5ZCPNV.1H.aCkncUeWaP592HshWbGu/bAMUK4AjnW', 'user', 'STURME', 'Mickael'),
	(5, 'L&eacute;a', 'lea@exemple.com', '$2y$10$rMMGyo8jPiLbXIA4C204IeBDkxPfsMp2cataiFxW38qCb0hzBPYMy', 'ROLE_ADMIN', 'DURAND', 'Léa'),
	(7, 'Joe', 'joe@exemple.com', '$2y$10$dGpg8u9qpap08/pXvUghuOqPoNDmo2qcBkTdjgHiHx7pbMg2Kayjm', 'user', 'ARMAND', 'Joe'),
	(8, 'lucy', 'test6@exemple.com', '$2y$10$fGKmQIj2aPszVOvB6YwweurW7AC8BANTJV61VLVnz.j7bOPUpdz3y', 'user', 'ARNOLD', 'Lucie'),
	(14, 'tony', 'tony@exemple.com', '$2y$10$edMI/MjAyQllp3Z2KRHfU.WdC263GgsTqKNShQ4A8.Y3UAGLux2tK', 'user', 'JOHNS', 'Tony');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
