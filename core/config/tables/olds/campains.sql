-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 10.2.1.127:3306
-- Généré le :  lun. 30 sep. 2019 à 03:27
-- Version du serveur :  10.2.24-MariaDB
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `u532250745_regie`
--

-- --------------------------------------------------------

--
-- Structure de la table `campains`
--

CREATE TABLE `campains` (
  `id` int(11) NOT NULL,
  `init_id` int(11) NOT NULL,
  `init_rid` int(11) NOT NULL,
  `nbr` int(11) NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `campains`
--

INSERT INTO `campains` (`id`, `init_id`, `init_rid`, `nbr`, `debut`, `fin`) VALUES
(98, 24, 25, 49, '2019-07-01', '2019-09-30'),
(110, 26, 27, 26, '2019-09-01', '2019-09-30'),
(111, 26, 27, 47, '2019-09-01', '2019-09-30'),
(112, 27, 28, 58, '2019-09-01', '2020-06-30'),
(125, 30, 31, 54, '2019-09-16', '2019-10-15'),
(126, 30, 31, 41, '2019-09-16', '2019-10-15'),
(127, 30, 31, 12, '2019-09-16', '2019-10-15'),
(128, 30, 31, 17, '2019-09-16', '2019-10-15'),
(129, 29, 30, 7, '2019-09-16', '2019-09-30'),
(130, 29, 30, 54, '2019-09-16', '2019-09-30'),
(131, 29, 30, 24, '2019-09-16', '2019-09-30'),
(132, 29, 30, 48, '2019-09-16', '2019-09-30'),
(134, 29, 30, 13, '2019-09-16', '2019-09-30'),
(135, 29, 30, 20, '2019-09-16', '2019-09-30'),
(136, 31, 32, 31, '2019-09-16', '2019-10-15'),
(137, 30, 31, 37, '2019-09-16', '2019-10-15');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `campains`
--
ALTER TABLE `campains`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `campains`
--
ALTER TABLE `campains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
