-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 10.2.1.127:3306
-- Généré le :  lun. 30 sep. 2019 à 03:11
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
-- Base de données :  `u532250745_app`
--

-- --------------------------------------------------------

--
-- Structure de la table `payement`
--

CREATE TABLE `payement` (
  `id` int(11) NOT NULL,
  `statement_id` int(11) NOT NULL,
  `pf_id` int(11) NOT NULL,
  `payed_amount` int(11) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `payement`
--

INSERT INTO `payement` (`id`, `statement_id`, `pf_id`, `payed_amount`, `created`) VALUES
(1, 1, 68330, 520000, '2017-07-29'),
(2, 2, 142633, 7200000, '2017-07-29'),
(3, 3, 743525, 769315, '2017-07-30'),
(4, 1, 68330, 220000, '2017-10-28'),
(5, 1, 68330, 150000, '2017-10-28'),
(7, 1, 68330, 51781, '2017-10-28');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `payement`
--
ALTER TABLE `payement`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `payement`
--
ALTER TABLE `payement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
