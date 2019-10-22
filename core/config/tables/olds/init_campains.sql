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
-- Structure de la table `init_campains`
--

CREATE TABLE `init_campains` (
  `id` int(11) NOT NULL,
  `init_rid` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `campain_name` varchar(225) NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `init_campains`
--

INSERT INTO `init_campains` (`id`, `init_rid`, `client_id`, `campain_name`, `debut`, `fin`, `created`) VALUES
(24, 25, 31, 'NOUVELLE CAMPAGNE', '2019-07-01', '2019-09-30', '2019-07-09'),
(26, 27, 53, 'CAMPAGNE SEPTEMBRE 2019', '2019-09-01', '2019-09-30', '2019-08-26'),
(27, 28, 62, 'CAMPAGNE COSMOS', '2019-09-01', '2020-06-30', '2019-08-26'),
(29, 30, 69, 'NOUVELLE CAMPAGNE', '2019-09-16', '2019-09-30', '2019-09-09'),
(30, 31, 71, 'CAMPAGNE SEPT PHD', '2019-09-16', '2019-10-15', '2019-09-09'),
(31, 32, 69, 'CAMPAGNE PM SEPt-OCT', '2019-09-16', '2019-10-15', '2019-09-16');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `init_campains`
--
ALTER TABLE `init_campains`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `init_campains`
--
ALTER TABLE `init_campains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
