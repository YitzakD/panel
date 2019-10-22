-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 10.2.1.127:3306
-- Généré le :  lun. 30 sep. 2019 à 03:23
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
-- Structure de la table `bc`
--

CREATE TABLE `bc` (
  `id` int(11) NOT NULL,
  `bc_id` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `dating` varchar(225) NOT NULL,
  `qte` int(11) NOT NULL,
  `pu` int(11) NOT NULL,
  `ht` int(11) NOT NULL,
  `transport` int(11) NOT NULL,
  `odp` int(11) NOT NULL,
  `tm` int(11) NOT NULL,
  `tva` int(11) NOT NULL,
  `tsp` int(11) NOT NULL,
  `other_tax` varchar(225) NOT NULL,
  `other_tax_name` varchar(225) NOT NULL,
  `other_tax_amount` int(11) NOT NULL,
  `ttc` int(11) NOT NULL,
  `state` enum('Non','Oui') NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bc`
--

INSERT INTO `bc` (`id`, `bc_id`, `f_id`, `description`, `dating`, `qte`, `pu`, `ht`, `transport`, `odp`, `tm`, `tva`, `tsp`, `other_tax`, `other_tax_name`, `other_tax_amount`, `ttc`, `state`, `created`) VALUES
(1, 433223, 3, '5 panneaux 12mÂ² dans le district dâ€™ABIDJAN', '01 Jan  - 31 Jan', 5, 80000, 400000, 0, 60000, 60000, 72000, 14160, 'Non', 'TIF', 12000, 606160, 'Oui', '2017-11-03 19:21:21'),
(3, 385986, 3, '10 panneaux 12m² dans le district d\'ABIDJAN', '01/01/17 - 31/01/17', 10, 80000, 800000, 0, 120000, 120000, 122400, 24072, 'Non', 'TIF', 24000, 1090472, 'Non', '2019-08-31 20:29:50');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bc`
--
ALTER TABLE `bc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bc`
--
ALTER TABLE `bc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
