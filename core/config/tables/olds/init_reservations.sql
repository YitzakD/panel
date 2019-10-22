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
-- Structure de la table `init_reservations`
--

CREATE TABLE `init_reservations` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `campain_name` varchar(225) NOT NULL,
  `debut` date NOT NULL,
  `fin` date NOT NULL,
  `etat` enum('En attente','En cours','En pause','Close') NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Initialisation des réservations';

--
-- Déchargement des données de la table `init_reservations`
--

INSERT INTO `init_reservations` (`id`, `client_id`, `campain_name`, `debut`, `fin`, `etat`, `created`) VALUES
(1, 51, 'CAMPAGNE ANAGED', '2019-01-01', '2019-01-31', 'Close', '2018-12-31'),
(3, 30, 'DEUXIÈME CAMPAGNE OILIBYA', '2019-01-01', '2019-01-15', 'Close', '2018-12-31'),
(4, 31, 'CAMPAGNE COCOVICO', '2019-01-01', '2019-02-28', 'Close', '2018-12-31'),
(5, 14, 'BLANCO', '2019-01-01', '2019-01-15', 'Close', '2018-12-31'),
(6, 30, 'RECONDUCTION OILIBYA', '2019-01-01', '2019-01-31', 'Close', '2018-12-31'),
(7, 53, 'CAMPAGNE RED', '2019-02-01', '2019-02-28', 'Close', '2018-12-31'),
(8, 4, 'CAMPAGNE 2 MOIS RENOUVELABLE ', '2019-01-01', '2019-03-31', 'Close', '2019-02-25'),
(9, 52, 'NOUVELLE CAMPAGNE', '2019-01-16', '2019-02-15', 'Close', '2019-01-15'),
(10, 21, 'SOTACI', '2019-02-16', '2019-04-15', 'Close', '2019-01-22'),
(11, 57, 'NOUVELLE CAMPAGNE', '2019-02-16', '2019-02-28', 'Close', '2019-02-04'),
(12, 22, 'PV2', '2019-02-01', '2019-02-28', 'Close', '2019-02-04'),
(13, 25, 'NOUVELLE CAMPAGNE OREV', '2019-03-16', '2019-03-17', 'Close', '2019-03-11'),
(14, 53, 'NOUVELLE CAMPAGNE', '2019-04-01', '2019-04-30', 'Close', '2019-04-09'),
(15, 11, 'NOUVELLE CAMPAGNE', '2019-04-16', '2019-05-15', 'Close', '2019-04-04'),
(16, 63, 'NOUVELLE CAMPAGNE', '2019-04-08', '2019-04-30', 'Close', '2019-04-08'),
(17, 19, 'CAMPAGNE RAMADAN', '2019-05-01', '2019-05-31', 'Close', '2019-04-09'),
(18, 38, 'CAMPAGNE AROMATE', '2019-05-01', '2019-05-31', 'Close', '2019-04-16'),
(19, 64, 'NOUVELLE CAMPAGNE', '2019-04-16', '2019-05-15', 'Close', '2019-04-16'),
(20, 18, 'NOUVELLE CAMPAGNE', '2019-05-16', '2019-06-15', 'Close', '2019-05-29'),
(21, 11, 'CAMPAGNE HOD', '2019-05-16', '2019-05-20', 'Close', '2019-05-20'),
(22, 52, 'CAMPAGNE ESP', '2019-05-16', '2019-06-15', 'Close', '2019-05-20'),
(23, 53, 'CAMPAGNE RA4', '2019-06-16', '2019-07-15', 'Close', '2019-06-24'),
(24, 67, 'CAMPAGNE JUILLET O7P', '2019-07-01', '2019-07-31', 'Close', '2019-07-09'),
(25, 31, 'NOUVELLE CAMPAGNE', '2019-07-01', '2019-09-30', 'En cours', '2019-07-09'),
(26, 18, 'MEDIA', '2019-08-01', '2019-08-31', 'Close', '2019-07-29'),
(27, 53, 'CAMPAGNE SEPTEMBRE 2019', '2019-09-01', '2019-09-30', 'En cours', '2019-08-26'),
(28, 62, 'CAMPAGNE COSMOS', '2019-09-01', '2020-06-30', 'En cours', '2019-08-26'),
(29, 71, 'CAMPAGNE PHD SEPT', '2019-09-01', '2019-09-09', 'Close', '2019-09-09'),
(30, 69, 'NOUVELLE CAMPAGNE', '2019-09-16', '2019-09-30', 'En cours', '2019-09-09'),
(31, 71, 'CAMPAGNE SEPT PHD', '2019-09-16', '2019-10-15', 'En cours', '2019-09-09'),
(32, 69, 'CAMPAGNE PM SEPt-OCT', '2019-09-16', '2019-10-15', 'En cours', '2019-09-16');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `init_reservations`
--
ALTER TABLE `init_reservations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `init_reservations`
--
ALTER TABLE `init_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
