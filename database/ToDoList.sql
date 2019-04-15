-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 15 Avril 2019 à 09:18
-- Version du serveur :  5.7.25-0ubuntu0.18.04.2
-- Version de PHP :  7.2.15-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Becode`
--

-- --------------------------------------------------------

--
-- Structure de la table `ToDoList`
--

CREATE TABLE `ToDoList` (
  `ID` int(11) NOT NULL,
  `TASK` varchar(100) CHARACTER SET utf8 NOT NULL,
  `DEADLINE` datetime(1) DEFAULT NULL,
  `DO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ToDoList`
--

INSERT INTO `ToDoList` (`ID`, `TASK`, `DEADLINE`, `DO`) VALUES
(1, 'Perdre sa soeur', '2019-04-13 17:00:00.0', 0),
(2, 'Oublier Mémé dans le bus', '2019-04-07 12:00:00.0', 1),
(3, 'Faire chier Niky', '2019-04-07 00:00:00.0', 1),
(4, 'Mrrggllgggllggll', '2019-04-07 00:00:00.0', 1),
(5, 'Faire encore plus chier Niky', '2019-04-11 12:00:00.0', 0),
(7, 'Foutre un Houk dans le Doukake du vilain Lokdu', '2019-04-19 00:00:00.0', 0),
(8, 'Terminer la première étape de la ToDoList', '2019-04-07 00:00:00.0', 1),
(9, 'Terminer les bonus', '2019-04-12 17:00:00.0', 0),
(12, 'Ceci est une tache avec une deadline', '2019-04-10 17:00:00.0', 1),
(16, 'Ceci est un test a la con', '2019-04-12 13:00:00.0', 0),
(22, 'This is Spartaaaaaaaaa !', '2019-04-12 16:00:00.0', 0),
(23, 'C&#39;est un tache avec un deadline', '2019-04-01 17:00:00.0', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ToDoList`
--
ALTER TABLE `ToDoList`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ToDoList`
--
ALTER TABLE `ToDoList`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
