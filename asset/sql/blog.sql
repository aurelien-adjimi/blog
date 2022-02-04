-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 04 fév. 2022 à 15:25
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
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `article`, `id_utilisateur`, `id_categorie`, `date`) VALUES
(1, 'Tiramisu:<br>\r\n250g de Mascarpone<br>\r\n35cl de creme fleurette<br>\r\n3 paquets de boudoirs<br>\r\n1 cafetiere de cafe<br>\r\n1 verre d\'amaretto', 1, 4, '2021-01-03 23:00:00'),
(2, 'Rouleaux thon Saint Moret:\r\n1 boite de thon<br>\r\n1 boite de Saint Moret<br>\r\n6 tranches de pain de mie', 1, 1, '2022-01-17 23:00:00'),
(3, 'Pates au saumon:<br>\r\n2 paves de saumon<br>\r\n500g de pates fraiches<br>\r\n20cl de creme fraiche liquide<br>\r\nAneth <br>\r\nSel <br>\r\nPoivre \r\n\r\n', 1, 3, '2022-01-17 23:00:00'),
(4, 'Cordons bleus:<br>\r\n2 filets de poulet<br>\r\n4 tranches d\'emmental<br>\r\n2 tranches de jambon <br>\r\n2 oeufs<br>\r\nChapelure<br>\r\nFarine', 1, 3, '2022-01-19 23:00:00'),
(5, 'Gratin de pates ', 2, 3, '2022-02-04 10:08:27'),
(6, 'Gratin de pates ', 2, 3, '2022-02-04 10:10:42'),
(7, 'Gratin de pates ', 2, 3, '2022-02-04 10:11:13'),
(8, 'Gratin de pates ', 2, 3, '2022-02-04 10:12:25'),
(9, 'Gratin de pates ', 2, 3, '2022-02-04 10:13:15'),
(10, 'Gratin de pates ', 2, 3, '2022-02-04 10:13:46'),
(11, 'Gratin de pates ', 2, 3, '2022-02-04 10:14:04'),
(12, 'Crumble', 2, 4, '2022-02-04 10:16:49');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(4, 'Desserts'),
(3, 'Plats'),
(2, 'Entrees'),
(1, 'Aperitifs');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(1024) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES
(1, 'coucou', 1, 1, '2022-01-19 23:00:00'),
(2, 'TrÃ¨s bonne recette !', 1, 1, '2022-02-04 13:53:50'),
(3, 'Super bon et facile !', 4, 4, '2022-02-04 13:56:48'),
(4, 'Regalade', 4, 4, '2022-02-04 14:00:11'),
(5, 'tres bon', 4, 4, '2022-02-04 14:20:31'),
(6, 'Meilleur gratin', 11, 11, '2022-02-04 14:36:50');

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

DROP TABLE IF EXISTS `droits`;
CREATE TABLE IF NOT EXISTS `droits` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'utilisateur'),
(42, 'modérateur'),
(1337, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_droits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `id_droits`) VALUES
(1, 'User1', 'User1', 'user1@gmail.com', 1),
(2, 'Moderateur', 'mod', 'mod@gmail.com', 42),
(3, 'Admin', 'admin', 'admin@gmail.com', 1337),
(4, 'Aurelus', 'coucou', 'coucou@coucou.fr', 1),
(5, 'Marie', 'marie', 'marie@gmail.com', 1),
(6, 'koobiak', 'lol', 'lol', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
