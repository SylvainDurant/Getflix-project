-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 11 déc. 2020 à 07:53
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
-- Base de données : `moosic_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Rock', '2020-11-27 14:42:37', '2020-11-27 14:42:37'),
(2, 'Metal', '2020-11-30 08:26:47', '2020-11-30 08:26:47'),
(3, 'Classic', '2020-12-02 11:26:02', '2020-12-02 11:26:02');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `song_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `comment_user_id_foreign` (`user_id`),
  KEY `comment_song_id_foreign` (`song_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `text`, `user_id`, `song_id`, `created_at`, `updated_at`) VALUES
(1, 'Best Technical Death Metal band ever!', 1, 2, '2020-11-30 08:34:47', '2020-11-30 08:34:47'),
(2, 'I love this band!', 2, 2, '2020-11-30 10:21:15', '2020-11-30 10:21:15'),
(3, 'This is the best song in the wolrd... Tribute X\'D', 1, 1, '2020-11-30 14:36:05', '2020-11-30 14:35:30');

-- --------------------------------------------------------

--
-- Structure de la table `songs`
--

DROP TABLE IF EXISTS `songs`;
CREATE TABLE IF NOT EXISTS `songs` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `artist_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `album_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'Unknown',
  `album_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '../images/Moosic_T2.1.png',
  `released_date` date DEFAULT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `song_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `songs`
--

INSERT INTO `songs` (`id`, `title`, `description`, `source`, `artist_name`, `album_name`, `album_image`, `released_date`, `user_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Tribute', 'something something ', 'https://www.youtube.com/embed/_lK4cX5xGiQ', 'Tenacious D', 'Tenacious D', 'https://upload.wikimedia.org/wikipedia/en/5/52/Tenacious_D_album_cover.jpg', '2001-09-25', 1, 1, '2020-11-27 14:31:06', '2020-11-27 14:31:06'),
(2, 'Involuntary Doppelgänger', 'Artwork painted by artist Eliran Kantor (Testament, Atheist, Hate Eternal).', 'https://www.youtube.com/embed/1lsnTQyGI78', 'Archspire', 'Relentless Mutation', 'https://f4.bcbits.com/img/a3627749183_10.jpg', '2017-09-22', 1, 2, '2020-11-30 08:28:58', '2020-11-30 08:28:58'),
(3, 'From Afar', 'Finnish folk metal band from Helsinki.', 'https://www.youtube.com/embed/ALrjjJdmxgA', 'Ensiferum', 'From Afar', 'https://upload.wikimedia.org/wikipedia/en/b/b8/From_Afar_%28Ensiferum_album%29_coverart.jpg', '2009-09-09', 1, 2, '2020-12-01 15:22:50', '2020-12-01 15:22:50'),
(4, 'Toccata and Fugue in D Minor', 'Though the composition is public domain, the performance belongs to the record label that recorded the following performer:\r\nHannes Kästner', 'https://www.youtube.com/embed/ho9rZjlsyYY', 'Johann Sebastian Bach', 'Toccata and Fugue in D Minor', 'https://upload.wikimedia.org/wikipedia/commons/6/6a/Johann_Sebastian_Bach.jpg', '1704-01-01', 1, 3, '2020-12-07 10:21:11', '2020-12-07 10:21:11'),
(5, 'Moonlight Sonata', 'The Piano Sonata No. 14 in C♯ minor \"Quasi una fantasia\", op. 27, No. 2, by Ludwig van Beethoven.', 'https://www.youtube.com/embed/4Tr0otuiQuU', 'Ludwig van Beethoven', 'Moonlight Sonata', 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Beethoven.jpg/330px-Beethoven.jpg', '1802-01-01', 2, 3, '2020-12-07 11:07:00', '2020-12-07 11:07:00'),
(8, 'Sugar', 'Fleshgod Apocalypse', 'https://www.youtube.com/embed/Xmq3iyW02b8', 'Fleshgod Apocalypse', 'Veleno', 'https://zwaremetalen.com/wp-content/uploads/2019/06/752608.jpg', '2019-05-24', 1, 2, '2020-12-09 13:38:06', '2020-12-09 13:38:06'),
(9, 'Rize Of The Fenix', '', 'https://www.youtube.com/embed/ls3rD8VfiSY', 'Tenacious D', 'Unknown', '../images/Moosic_T2.1.png', '2020-01-01', 1, 1, '2020-12-09 15:37:23', '2020-12-09 15:37:23'),
(10, 'Smoke On The Water', '', 'https://www.youtube.com/embed/ikGyZh0VbPQ', 'Deep Purple', 'Unknown', '../images/Moosic_T2.1.png', '2020-01-01', 1, 1, '2020-12-09 15:45:44', '2020-12-09 15:45:44'),
(11, 'Spring', 'Vivaldi', 'https://www.youtube.com/embed/3LiztfE1X7E', 'Vivaldi', 'Unknown', '../images/Moosic_T2.1.png', '2020-01-01', 1, 3, '2020-12-09 16:02:34', '2020-12-09 16:02:34'),
(12, 'Sons Of The North', 'Welicoruss', 'https://www.youtube.com/embed/UgdmxBFgJQA', 'Welicoruss', 'Unknown', '../images/Moosic_T2.1.png', '2020-01-01', 1, 2, '2020-12-10 10:44:19', '2020-12-10 10:44:19');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` text COLLATE utf8mb4_unicode_ci,
  `role` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `is_connected` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `pseudo`, `email`, `password`, `birthday`, `photo`, `about`, `role`, `is_connected`, `created_at`, `updated_at`) VALUES
(1, 'Sylvain', 'Durant', 'Oda_Fubuki', 'sy.durant@hotmail.com', '$2y$10$r7PHsYmKGa0fpGv6lv.MnOJwaF2gv2DehlpLzXLPV6Bd1rk2rjvfC', '1992-05-07', 'https://media-exp1.licdn.com/dms/image/C4E03AQEe8SU-ZtGuMA/profile-displayphoto-shrink_200_200/0?e=1608768000&v=beta&t=S9Y08up4Dq83AI9CMaRgcTy3t2cltNJu-I176Ms795o', 'METAL!!!', 'admin', 0, '2020-11-27 14:38:25', '2020-11-27 14:38:25'),
(2, 'Wade', 'Wilson', 'Deadpool', 'thedisturbedone@hotmail.be', '$2y$10$r7PHsYmKGa0fpGv6lv.MnOJwaF2gv2DehlpLzXLPV6Bd1rk2rjvfC', '1991-02-01', 'https://pbs.twimg.com/profile_images/1208234904405757953/mT0cFOVQ_400x400.jpg', 'chimichanga!', 'member', 0, '2020-11-27 15:59:48', '2020-11-27 15:59:48'),
(3, 'Sylvain', 'Durant', 'Robin', 'odasylvain@gmail.com', '$2y$10$27uDoxalgcIqSLhl/CthqOEnWjDFBv8.4HpfULtKzQAWUmPzftoD2', NULL, NULL, NULL, 'member', 0, '2020-12-08 09:41:52', '2020-12-08 09:41:52');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_song_id_foreign` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `song_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
