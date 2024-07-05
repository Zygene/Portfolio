-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 30 août 2023 à 19:00
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `portfolio`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `description`) VALUES
(0, 'Non classé', ''),
(2, 'Mise en page', ''),
(3, 'Animation', ''),
(1, 'Illustration', '');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `identifiant`
--

DROP TABLE IF EXISTS `identifiant`;
CREATE TABLE IF NOT EXISTS `identifiant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `identifiant`
--

INSERT INTO `identifiant` (`id`, `login`, `password`, `email`) VALUES
(1, 'Zygene', '$2y$10$SD3kuIegk98dMTQ.wF4laeP.bfplPZGaPCn7GYOICe0P.DnzBfyv.', 'wilmesrobin2001@hotmail.fr');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fichier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_products` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_products` (`id_products`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `id_categorie` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categorie` (`id_categorie`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `date`, `cover`, `id_categorie`) VALUES
(11, 'Affiche typographie', '', '2023-08-01', '2489898212.-Affiche-typo-orgine-Robin.jpg', 1),
(10, 'Invitation d&#039;anniversaire', '', '2023-05-09', '48572155Invitation-Romy.jpg', 1),
(12, 'Composition de chiffres', '', '2023-08-02', '13680634203.-Composition-de-chiffres-Robin.jpg', 1),
(13, 'Invitation Keith Haring', '', '2023-08-03', '4708223676.-Invitation-Keith-Haring-Robin.jpg', 1),
(14, 'Expo libre comme l&#039;Art', '', '2023-08-08', '1434717337Examen-Typographie-Wilmes-Robin.jpg', 1),
(15, 'Nature morte', '', '2023-07-28', '17573724324.jpg', 1),
(16, 'Quadriptyque', '', '2023-08-01', '870138505Quadriptyque.jpg', 2),
(17, 'Brochure touristique', '', '2023-08-02', '1149195851Brochure-touristique.jpg', 2),
(18, 'Brochure Carrefour', '', '2023-08-03', '849896990Brochure-Carrefour.jpg', 2),
(22, 'Magazine', '', '2023-08-08', '538921647ARTENSION-magazine-d-Aoarts-my-dias.jpg', 2),
(20, 'Tableau', '', '2023-08-04', '1995156112390647421Robin-Tableau.jpg', 2),
(21, 'Bichromie', '', '2023-08-05', '2070017663Bichromie.jpg', 2),
(23, 'Vinyle', '', '2023-08-02', '245927229Vinyle.jpg', 1),
(24, 'Sentiment', '', '2023-08-02', '379686790Sentiment.jpg', 1),
(25, 'Pochette DVD', '', '2023-08-02', '1801664029Pochette-DVD.jpg', 1),
(26, 'Moodboard', '', '2023-08-01', '1536601813Robin-Moodboard-Portfolio.jpg', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
