-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 10.2.1.127:3306
-- Généré le :  lun. 30 sep. 2019 à 03:12
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
-- Structure de la table `init_transaction`
--

CREATE TABLE `init_transaction` (
  `id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `bc_id` int(11) NOT NULL,
  `ttc` int(11) NOT NULL,
  `tac` int(11) NOT NULL,
  `rap` int(11) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `init_transaction`
--

INSERT INTO `init_transaction` (`id`, `f_id`, `bc_id`, `ttc`, `tac`, `rap`, `created`) VALUES
(1, 3, 433223, 606160, 203160, 403000, '2017-11-03');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `init_transaction`
--
ALTER TABLE `init_transaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `init_transaction`
--
ALTER TABLE `init_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
