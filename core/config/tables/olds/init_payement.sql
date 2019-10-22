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
-- Structure de la table `init_payement`
--

CREATE TABLE `init_payement` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `pf_id` int(11) NOT NULL,
  `ttc` int(11) NOT NULL,
  `tac` int(11) NOT NULL,
  `rap` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `init_payement`
--

INSERT INTO `init_payement` (`id`, `client_id`, `pf_id`, `ttc`, `tac`, `rap`, `created`) VALUES
(1, 2, 68330, 1241781, 941781, 300000, '2017-10-28 14:43:49'),
(2, 2, 142633, 13770600, 7200000, 6570600, '2017-07-29 13:48:54'),
(3, 6, 743525, 769315, 769315, 0, '2017-07-30 20:53:28');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `init_payement`
--
ALTER TABLE `init_payement`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `init_payement`
--
ALTER TABLE `init_payement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
