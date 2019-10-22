-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 10.2.1.127:3306
-- Généré le :  lun. 30 sep. 2019 à 03:14
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
-- Structure de la table `providers`
--

CREATE TABLE `providers` (
  `id` int(11) NOT NULL,
  `p_name` varchar(225) NOT NULL,
  `c_name` varchar(225) NOT NULL,
  `p_mail` varchar(225) NOT NULL,
  `contacts` varchar(225) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `providers`
--

INSERT INTO `providers` (`id`, `p_name`, `c_name`, `p_mail`, `contacts`, `created`) VALUES
(2, 'LIGHT-MEDIA', 'OKAMBAWA K. Fabrice', 'commercial3@lightmedia.ci', '+225 20323302 / 07055765', '2016-11-17 11:59:04'),
(3, 'CANAL STREET', 'Maama COULIBALY', 'dg.cs@canalstreet.ci', '+225 23151515', '2017-11-03 19:00:50'),
(4, 'SELFIE MEDIA', 'KONE Abou', 'kone07aboude@gmail.com', '07003176 !!! 40455356', '2018-05-11 17:08:27');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `p_name` (`p_name`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
