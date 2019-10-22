-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 10.2.1.127:3306
-- Généré le :  lun. 30 sep. 2019 à 03:28
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
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `init_id` int(11) NOT NULL,
  `nbr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Liste des panneaux réservés';

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `init_id`, `nbr`) VALUES
(1, 3, 24),
(2, 3, 35),
(3, 3, 36),
(4, 3, 30),
(5, 3, 34),
(6, 4, 47),
(7, 5, 23),
(8, 5, 44),
(10, 5, 41),
(11, 6, 31),
(12, 6, 32),
(14, 1, 50),
(15, 1, 10),
(16, 7, 45),
(17, 7, 51),
(18, 1, 37),
(19, 1, 12),
(20, 1, 51),
(21, 8, 54),
(22, 8, 1),
(23, 8, 5),
(24, 8, 6),
(25, 8, 7),
(26, 8, 8),
(27, 8, 26),
(28, 8, 46),
(29, 8, 13),
(30, 8, 15),
(31, 8, 16),
(32, 8, 17),
(33, 8, 20),
(34, 9, 48),
(35, 9, 3),
(37, 10, 12),
(38, 10, 44),
(40, 11, 50),
(41, 11, 37),
(42, 11, 24),
(43, 12, 49),
(44, 10, 37),
(45, 13, 48),
(46, 13, 47),
(47, 13, 49),
(49, 14, 26),
(51, 14, 35),
(55, 17, 54),
(56, 17, 8),
(57, 17, 19),
(59, 17, 20),
(60, 17, 1),
(62, 14, 10),
(63, 17, 47),
(64, 15, 47),
(65, 17, 46),
(66, 17, 31),
(67, 17, 52),
(68, 14, 52),
(69, 17, 15),
(70, 18, 10),
(71, 18, 26),
(72, 18, 37),
(73, 18, 44),
(74, 18, 16),
(75, 18, 48),
(77, 16, 16),
(78, 19, 23),
(79, 18, 33),
(80, 20, 5),
(81, 20, 7),
(82, 20, 13),
(83, 20, 17),
(84, 21, 24),
(85, 21, 12),
(86, 21, 3),
(87, 22, 49),
(88, 23, 13),
(89, 23, 37),
(90, 23, 47),
(91, 23, 48),
(92, 24, 46),
(93, 24, 31),
(94, 24, 12),
(95, 25, 49),
(96, 26, 5),
(97, 26, 47),
(98, 26, 33),
(99, 26, 13),
(100, 26, 17),
(101, 26, 1),
(102, 26, 7),
(103, 26, 10),
(104, 26, 48),
(105, 26, 20),
(106, 26, 14),
(107, 27, 26),
(108, 27, 47),
(109, 28, 58),
(111, 29, 41),
(112, 29, 12),
(113, 29, 17),
(114, 29, 56),
(115, 30, 7),
(116, 30, 54),
(117, 30, 24),
(118, 30, 48),
(120, 30, 13),
(121, 30, 20),
(122, 31, 54),
(123, 31, 41),
(124, 31, 12),
(125, 31, 17),
(126, 32, 31),
(127, 31, 37);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
