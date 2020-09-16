-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 16 sep. 2020 à 08:32
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
CREATE DATABASE IF NOT EXISTS `fredi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fredi`;

-- --------------------------------------------------------

--
-- Structure de la table `adherent`
--

CREATE TABLE `adherent` (
  `email_util` varchar(50) NOT NULL,
  `lic_adh` varchar(50) NOT NULL,
  `sexe_adh` varchar(1) NOT NULL,
  `date_naissance_adh` date NOT NULL,
  `adr1_adh` varchar(50) NOT NULL,
  `adr2_adh` varchar(50) NOT NULL,
  `adr3_adh` varchar(50) NOT NULL,
  `id_club` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

CREATE TABLE `club` (
  `id_club` int(11) NOT NULL,
  `lib_club` varchar(50) NOT NULL,
  `adr1_club` varchar(50) NOT NULL,
  `adr2_club` varchar(50) NOT NULL,
  `adr3_club` varchar(50) NOT NULL,
  `id_ligue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_de_frais`
--

CREATE TABLE `ligne_de_frais` (
  `id_ldf` int(11) NOT NULL,
  `date_ldf` date NOT NULL,
  `lib_trajet_ldf` varchar(50) NOT NULL,
  `cout_peage_ldf` decimal(10,0) NOT NULL,
  `cout_repas_ldf` decimal(10,0) NOT NULL,
  `cout_hebergement_ldf` decimal(10,0) NOT NULL,
  `nb_km_ldf` int(11) NOT NULL,
  `total_km_ldf` decimal(10,0) NOT NULL,
  `total_ldf` decimal(10,0) NOT NULL,
  `id_mdf` int(11) NOT NULL,
  `annee_per` int(11) NOT NULL,
  `email_util` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ligue`
--

CREATE TABLE `ligue` (
  `id_ligue` int(11) NOT NULL,
  `lib_ligue` varchar(50) NOT NULL,
  `URL_ligue` varchar(50) NOT NULL,
  `contact_ligue` varchar(50) NOT NULL,
  `telephone_ligue` varchar(50) NOT NULL,
  `email_util` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `motif_de_frais`
--

CREATE TABLE `motif_de_frais` (
  `id_mdf` int(11) NOT NULL,
  `lib_mdf` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

CREATE TABLE `periode` (
  `annee_per` int(11) NOT NULL,
  `forfait_km_per` decimal(10,0) NOT NULL,
  `statut_per` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `type_utilisateur`
--

CREATE TABLE `type_utilisateur` (
  `id_type_util` int(11) NOT NULL,
  `lib_type_util` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD PRIMARY KEY (`email_util`),
  ADD KEY `adherent_club0_FK` (`id_club`);

--
-- Index pour la table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`id_club`),
  ADD KEY `club_ligue_FK` (`id_ligue`);

--
-- Index pour la table `ligne_de_frais`
--
ALTER TABLE `ligne_de_frais`
  ADD PRIMARY KEY (`id_ldf`),
  ADD KEY `ligne_de_frais_motif_de_frais_FK` (`id_mdf`),
  ADD KEY `ligne_de_frais_periode0_FK` (`annee_per`),
  ADD KEY `ligne_de_frais_adherent1_FK` (`email_util`);

--
-- Index pour la table `ligue`
--
ALTER TABLE `ligue`
  ADD PRIMARY KEY (`id_ligue`),
  ADD KEY `ligue_utilisateur_FK` (`email_util`);

--
-- Index pour la table `motif_de_frais`
--
ALTER TABLE `motif_de_frais`
  ADD PRIMARY KEY (`id_mdf`);

--
-- Index pour la table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`annee_per`);

--
-- Index pour la table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  ADD PRIMARY KEY (`id_type_util`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`email_util`),
  ADD KEY `utilisateur_type_utilisateur_FK` (`id_type_util`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `club`
--
ALTER TABLE `club`
  MODIFY `id_club` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligue`
--
ALTER TABLE `ligue`
  MODIFY `id_ligue` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `motif_de_frais`
--
ALTER TABLE `motif_de_frais`
  MODIFY `id_mdf` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_utilisateur`
--
ALTER TABLE `type_utilisateur`
  MODIFY `id_type_util` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD CONSTRAINT `adherent_club0_FK` FOREIGN KEY (`id_club`) REFERENCES `club` (`id_club`),
  ADD CONSTRAINT `adherent_utilisateur_FK` FOREIGN KEY (`email_util`) REFERENCES `utilisateur` (`email_util`);

--
-- Contraintes pour la table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `club_ligue_FK` FOREIGN KEY (`id_ligue`) REFERENCES `ligue` (`id_ligue`);

--
-- Contraintes pour la table `ligne_de_frais`
--
ALTER TABLE `ligne_de_frais`
  ADD CONSTRAINT `ligne_de_frais_adherent1_FK` FOREIGN KEY (`email_util`) REFERENCES `adherent` (`email_util`),
  ADD CONSTRAINT `ligne_de_frais_motif_de_frais_FK` FOREIGN KEY (`id_mdf`) REFERENCES `motif_de_frais` (`id_mdf`),
  ADD CONSTRAINT `ligne_de_frais_periode0_FK` FOREIGN KEY (`annee_per`) REFERENCES `periode` (`annee_per`);

--
-- Contraintes pour la table `ligue`
--
ALTER TABLE `ligue`
  ADD CONSTRAINT `ligue_utilisateur_FK` FOREIGN KEY (`email_util`) REFERENCES `utilisateur` (`email_util`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_type_utilisateur_FK` FOREIGN KEY (`id_type_util`) REFERENCES `type_utilisateur` (`id_type_util`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
