-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : sigyn-db.cdvjopbzfq6j.eu-west-1.rds.amazonaws.com
-- Généré le :  ven. 05 mai 2017 à 13:16
-- Version du serveur :  5.6.27-log
-- Version de PHP :  7.0.16
 
SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
 
 
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
 
--
-- Base de données :  `sigyn`
--
CREATE DATABASE IF NOT EXISTS `sigyn`;
USE `sigyn`;
 
-- --------------------------------------------------------
 
--
-- Structure de la table `Messages`
--
 
CREATE TABLE `Messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pro` int(10) UNSIGNED NOT NULL,
  `id_patient` int(10) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `is_pro` tinyint(1) NOT NULL,
  `date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
--
-- Déchargement des données de la table `Messages`
--
 
INSERT INTO `Messages` (`id`, `id_pro`, `id_patient`, `text`, `is_pro`, `date`) VALUES
(82, 24, 7, 'Salut Bob, Ca gaze ?', 1, '2017-04-27 00:00:00');
 
-- --------------------------------------------------------
 
--
-- Structure de la table `Patients`
--
 
CREATE TABLE `Patients` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pro_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
 
--
-- Déchargement des données de la table `Patients`
--
 
INSERT INTO `Patients` (`id`, `email`, `name`, `firstname`, `password`, `pro_id`) VALUES
(1, 'qc.cloarec@gmail.com', 'Cloarec', 'Quentin', NULL, 12),
(5, 'pata97400@gmail.com', 'Le Corre', 'Thomas', '$2y$08$cFY4WG54RkpDeW5qNmZpT.R9GVJ7qIvgDSnStTgWqkFOf2R6YCOSO', 23),
(6, 'spamqcloarec@gmail.com', 'Galoge', 'Grospd', NULL, 24),
(7, 'bobleponge@bob.com', 'Leponge', 'Bob', NULL, 24),
(8, 'jeanmich@patient.fr', 'Patient', 'Jean-Michel', NULL, 23);
 
-- --------------------------------------------------------
 
--
-- Structure de la table `Pros`
--
 
CREATE TABLE `Pros` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pro_type` enum('generalist','dentist','nutritionnist','') NOT NULL DEFAULT 'generalist',
  `confirmed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
--
-- Déchargement des données de la table `Pros`
--
 
INSERT INTO `Pros` (`id`, `email`, `password`, `pro_type`, `confirmed`) VALUES
(2, 'test@test.com', '$2y$08$emtPc2JSMWNzZTBFalN5cOosJqt0hLh.UcEfiWAtZRvariFbUFSUO', 'generalist', 0),
(3, 'testiphone@tot.com', '$2y$08$MVNNd0haSFdRRTJ5a3EzLuegNpYHcUetUtC6bCAiNWc2iiv85k3XK', 'generalist', 0),
(12, 'toto@toto.com', '$2y$08$djExSFZLbTdzdW91UEY2dOuLFMgDQZTIbcBYjkeOtLforAJ7Zu8KK', 'generalist', 0),
(19, 'test@test.com', '$2y$08$SU5HZU5YbnJmZmUxZVBveO2jFaBSyA6RO9O3qyH4zY0yA4AoZiKmq', 'generalist', 0),
(20, 'galogepd@grospd.com', '$2y$08$aWVKSVF6SnhoVW9oTDBDTutzmiTfITzvGZK2iRlzCcdrqIvTyNyni', 'generalist', 0),
(21, 'johndoe@gmail.com', '$2y$08$bS9rN3BhaXBhWVRsZm9OYunnUAtSr4WS8fplchcNeLdXTOaWiRwTK', 'generalist', 0),
(23, 'pata97400@gmail.com', '$2y$08$d21yUUl4Qy9JUEcxUUNqO.ZL..trXX/qVxAkY55hLRyr37571B1Z.', 'dentist', 1),
(24, 'qc.cloarec@gmail.com', '$2y$08$a1czRkRGMHVWVk5aTkRSVOiWrYcJ7huft5A6R00UFAUbVVhR2Q3sy', 'nutritionnist', 1);
 
-- --------------------------------------------------------
 
--
-- Structure de la table `Recovery_Token`
--
 
CREATE TABLE `Recovery_Token` (
  `id` varchar(32) NOT NULL DEFAULT '',
  `expiration_date` int(11) DEFAULT NULL,
  `pro_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
--
-- Index pour les tables déchargées
--
 
--
-- Index pour la table `Messages`
--
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_patient` (`id_patient`),
  ADD KEY `id_pro` (`id_pro`);
 
--
-- Index pour la table `Patients`
--
ALTER TABLE `Patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_id` (`pro_id`);
 
--
-- Index pour la table `Pros`
--
ALTER TABLE `Pros`
  ADD PRIMARY KEY (`id`);
 
--
-- Index pour la table `Recovery_Token`
--
ALTER TABLE `Recovery_Token`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`pro_id`);
 
--
-- AUTO_INCREMENT pour les tables déchargées
--
 
--
-- AUTO_INCREMENT pour la table `Messages`
--
ALTER TABLE `Messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT pour la table `Patients`
--
ALTER TABLE `Patients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `Pros`
--
ALTER TABLE `Pros`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Contraintes pour les tables déchargées
--
 
--
-- Contraintes pour la table `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `Messages_ibfk_1` FOREIGN KEY (`id_patient`) REFERENCES `Patients` (`id`),
  ADD CONSTRAINT `Messages_ibfk_2` FOREIGN KEY (`id_pro`) REFERENCES `Pros` (`id`);
 
--
-- Contraintes pour la table `Patients`
--
ALTER TABLE `Patients`
  ADD CONSTRAINT `Patients_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `Pros` (`id`);
 
--
-- Contraintes pour la table `Recovery_Token`
--
ALTER TABLE `Recovery_Token`
  ADD CONSTRAINT `Recovery_Token_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `Pros` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;