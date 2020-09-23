-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 23 sep. 2020 à 09:31
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP :  7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fredi`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `email_util` varchar(50) NOT NULL,
  `password_util` varchar(255) NOT NULL,
  `nom_util` varchar(50) NOT NULL,
  `prenom_util` varchar(50) NOT NULL,
  `statut_util` varchar(1) NOT NULL,
  `matricule_cont` varchar(10) NOT NULL,
  `id_type_util` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`email_util`, `password_util`, `nom_util`, `prenom_util`, `statut_util`, `matricule_cont`, `id_type_util`) VALUES
('admin@admin', '$2y$10$6scB8nwKtUFt7ft5NPgGo.gVvyR8GCsaK2RXHFOHJmnpemU49GVLG', 'admin', 'admin', '', '0001', 3),
('Controleur@Controleur', '$2y$10$fjFg.Q0FH.yRWWkfkoj/LOtQ783CwL0wjB3QtCqMwfsOTiJQYAUuu', 'Controleur', 'Controleur', '', '0002', 2),
('user@user', '$2y$10$vO0xK/iykI8AdE8BWDFsY.i5ekwHuxtJv3RMxBDDdKFkmHnmcf6mm', 'user', 'user', '', '0003', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`email_util`),
  ADD KEY `utilisateur_type_utilisateur_FK` (`id_type_util`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_type_utilisateur_FK` FOREIGN KEY (`id_type_util`) REFERENCES `type_utilisateur` (`id_type_util`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
