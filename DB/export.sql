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


-- Listage de la structure de la base pour forum_maximefutterer
CREATE DATABASE IF NOT EXISTS `forum_maximefutterer` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum_maximefutterer`;

-- Listage de la structure de table forum_maximefutterer. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id_category`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table forum_maximefutterer.category : ~4 rows (environ)
INSERT IGNORE INTO `category` (`id_category`, `name`) VALUES
	(1, 'Général'),
	(2, '18 - 25'),
	(3, 'Musique'),
	(4, 'Livres'),
	(5, 'Elan');

-- Listage de la structure de table forum_maximefutterer. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `contenu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `dateMessage` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int DEFAULT NULL,
  `topic_id` int DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `user_id` (`user_id`),
  KEY `topic_id` (`topic_id`),
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE,
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table forum_maximefutterer.post : ~17 rows (environ)
INSERT IGNORE INTO `post` (`id_post`, `contenu`, `dateMessage`, `closed`, `user_id`, `topic_id`) VALUES
	(1, 'blablablou, blou bli ?', '2024-03-27 16:16:17', 0, 2, 1),
	(6, 'classic', '2024-04-03 14:10:23', 0, 4, 6),
	(7, 'bonjour', '2024-04-03 14:11:19', 0, 3, 6),
	(11, 'love me some air guitar!', '2024-04-04 09:24:01', 0, 3, 6),
	(15, 'woaw', '2024-04-04 10:29:37', 0, 5, 13),
	(16, 'jador', '2024-04-04 10:29:47', 0, 5, 13),
	(17, '+2', '2024-04-04 10:31:06', 0, 4, 13),
	(18, 'votez &#60;blank&#62;', '2024-04-04 10:49:58', 0, 3, 14),
	(19, 'Mason or Agatha ?', '2024-04-04 11:14:11', 0, 3, 15),
	(20, 'carrément!', '2024-04-04 16:26:14', 0, 3, 1),
	(21, '3 ptits chats', '2024-04-05 16:43:00', 0, 3, 7),
	(23, 'bkabkabka', '2024-04-05 20:40:06', 0, 3, 16),
	(29, 'Privet, kak dela ?', '2024-04-08 11:03:19', 0, 6, 19),
	(30, 'vsë khorosho', '2024-04-08 11:03:41', 0, 6, 19),
	(31, 'tenosia...', '2024-04-08 11:04:21', 0, 6, 15),
	(32, 'blablba', '2024-04-08 13:50:16', 0, 4, 20),
	(35, 'test 1 2', '2024-04-08 14:54:15', 0, 8, 22);

-- Listage de la structure de table forum_maximefutterer. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `categorie_id` (`category_id`) USING BTREE,
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_topic_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE RESTRICT,
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table forum_maximefutterer.topic : ~7 rows (environ)
INSERT IGNORE INTO `topic` (`id_topic`, `title`, `dateCreation`, `category_id`, `user_id`) VALUES
	(1, 'CSS tips', '2024-03-27 15:57:34', 1, 2),
	(6, 'Guitare acoustique : Classique ou Folk ?', '2024-04-03 14:10:08', 3, 4),
	(7, 'Cats', '2024-04-03 16:08:37', 1, 3),
	(13, '50 shades of gray', '2024-04-04 10:29:37', 4, 5),
	(14, 'test', '2024-04-04 10:49:58', 2, 3),
	(15, 'Chivalry 2', '2024-04-04 11:14:11', 1, 3),
	(16, 'blabka', '2024-04-05 20:40:06', 1, 3),
	(17, 'The Witcher', '2024-04-08 10:59:20', 4, 6),
	(19, 'Metro 2033', '2024-04-08 11:03:19', 4, 6),
	(20, 'ForumPlateau_V2 elan', '2024-04-08 13:50:16', 5, 4),
	(22, 'test', '2024-04-08 14:54:15', 3, 8);

-- Listage de la structure de table forum_maximefutterer. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `registerDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT 'role_user',
  `avatar` varchar(255) COLLATE utf8mb4_bin NOT NULL DEFAULT 'User-avatar.png',
  `status` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Listage des données de la table forum_maximefutterer.user : ~7 rows (environ)
INSERT IGNORE INTO `user` (`id_user`, `username`, `email`, `password`, `registerDate`, `role`, `avatar`, `status`) VALUES
	(2, 'admin1', 'admin@gmail.com', '$2y$10$uFKy8AbYNFOWoNBmCCxbAOXUSuDaY.xHR6yy4.ZjIwwkvPLxeyOp2*', '2024-03-27 15:57:05', 'role_admin', 'User-avatar.png', 1),
	(3, 'futrr_', 'max@exemple.com', '$2y$10$7ZsR7PvyRgLX1FJ8iKJfKuvINM4fwn0vea2DFG1lvR51E5Gn.VOma', '2024-04-02 15:46:09', 'role_user', '6613a33ca10915.96096367.webp', 0),
	(4, 'admin', 'admin@exemple.com', '$2y$10$0QYfIdBUiHmWT/fe2nt9pOzHSt1GIWqw8djk5HZjI3vSoTHj0LtrO', '2024-04-03 13:39:40', 'role_admin', '6613a48a04d0a7.72813701.webp', 0),
	(5, 'kev', 'azerty2@gmail.com', '$2y$10$CBbVlbc8YwG7oHHsQcyqX.mtQu/zRBk9eJo4ewr7vF/WSxBKbxb6e', '2024-04-04 10:28:45', 'role_user', 'User-avatar.png', 0),
	(6, 'testeur', 'test@exe.fr', '$2y$10$nR7NEg5xDLfbvP/Qx7FiNu7clqW9zSd4642itpCx5hXtPbnOuzSSK', '2024-04-05 20:41:18', 'role_user', '6613d60a16afb5.26446301.webp', 0),
	(8, 'Utilisateur supprimé', 'Utilisateur supprimé', '$2y$10$y0eQ8hWk02h.i8cAtwWTzeC/GLNSDULpjj.uJ6P.BCwnrjOeStigi', '2024-04-08 14:53:52', 'role_user', '', 2),
	(9, 'Utilisateur supprimé', 'Utilisateur supprimé', '$2y$10$pTXwHdycb0IA37qmRmiMd.o3uBXf99L82KS3Rjq9tXwBHwJxW1lCe', '2024-04-08 15:02:19', 'role_user', '', 2);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
