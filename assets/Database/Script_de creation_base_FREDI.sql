-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 05 nov. 2018 à 14:01
-- Version du serveur :  10.1.29-MariaDB
-- Version de PHP :  7.1.12

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
CREATE DATABASE IF NOT EXISTS fredi  
DEFAULT charset=utf8
COLLATE utf8_general_ci;

--
-- Structure de la table `adherent`
--

CREATE TABLE `csv` (
  `NumLicenceCSV` varchar(25) NOT NULL,
  `SexeAdh` varchar(1) DEFAULT NULL,
  `NomAdh` varchar(20) DEFAULT NULL,
  `PrenomAdh` varchar(20) DEFAULT NULL,
  `DateNaissance` date DEFAULT NULL,
  `Adresse` varchar(50) DEFAULT NULL,
  `CodePostal` varchar(10) DEFAULT NULL,
  `Ville` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `adherent` (
  `NumLicence` varchar(25) NOT NULL,
  `SexeAdh` varchar(1) DEFAULT NULL,
  `NomAdh` varchar(20) DEFAULT NULL,
  `PrenomAdh` varchar(20) DEFAULT NULL,
  `DateNaissance` date DEFAULT NULL,
  `AdresseMail` varchar(30) DEFAULT NULL,
  `Telephone` varchar(10) DEFAULT NULL,
  `Adresse` varchar(100) DEFAULT NULL,
  `CodePostal` varchar(10) DEFAULT NULL,
  `Ville` varchar(20) DEFAULT NULL,
  `IdClub` int(11) DEFAULT NULL,
  `IdRespLegal` int(11) DEFAULT NULL,
  `MDP` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `bordereau`
--

CREATE TABLE `bordereau` (
  `IdBordereau` int(11) NOT NULL,
  `Année` varchar(4) DEFAULT NULL,
  `NumLicence` varchar(25) NOT NULL,
  `IdTresorier` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

CREATE TABLE `club` (
  `IdClub` int(11) NOT NULL,
  `NomClub` varchar(30) DEFAULT NULL,
  `IdLigue` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ligne_de_frais`
--

CREATE TABLE `ligne_de_frais` (
  `IdFrais` int(11) NOT NULL,
  `DateFrais` date DEFAULT NULL,
  `Trajet` varchar(25) DEFAULT NULL,
  `Km` int(11) DEFAULT NULL,
  `CoutTrajet` decimal(15,2) DEFAULT NULL,
  `CoutPeage` decimal(15,2) DEFAULT NULL,
  `CoutRepas` decimal(15,2) DEFAULT NULL,
  `CoutHebergement` decimal(15,2) DEFAULT NULL,
  `CoutTotal` decimal(15,2) DEFAULT NULL,
  `IdBordereau` int(11) DEFAULT NULL,
  `IdMotifs` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ligue`
--

CREATE TABLE `ligue` (
  `IdLigue` int(11) NOT NULL,
  `NomLigue` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `motifs`
--

CREATE TABLE `motifs` (
  `IdMotifs` int(11) NOT NULL,
  `LibelleMotifs` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `p_km`
--

CREATE TABLE `p_km` (
  `Année` int(11) NOT NULL,
  `PrixKM` decimal(4,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `responsable_crib`
--

CREATE TABLE `responsable_crib` (
  `IdRespCrib` int(11) NOT NULL,
  `NomRespCrib` varchar(25) DEFAULT NULL,
  `PrenomRespCrib` varchar(25) DEFAULT NULL,
  `AdresseMail` varchar(30) DEFAULT NULL,
  `IdLigue` int(11) DEFAULT NULL,
  `MDP` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `responsable_legal`
--

CREATE TABLE `responsable_legal` (
  `IdRespLegal` int(11) NOT NULL,
  `NomRespLegal` varchar(20) DEFAULT NULL,
  `PrenomRespLegal` varchar(20) DEFAULT NULL,
  `AdresseMail` varchar(30) DEFAULT NULL,
  `MDP` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tresorier`
--

CREATE TABLE `tresorier` (
  `IdTresorier` int(11) NOT NULL,
  `NomTresorier` varchar(25) DEFAULT NULL,
  `PrenomTresorier` varchar(25) DEFAULT NULL,
  `AdresseMail` varchar(30) DEFAULT NULL,
  `IdClub` int(11) DEFAULT NULL,
  `MDP` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD PRIMARY KEY (`NumLicence`),
  ADD KEY `FK_Adherent_IdClub` (`IdClub`),
  ADD KEY `FK_Adherent_IdRespLegal` (`IdRespLegal`);

--
-- Index pour la table `bordereau`
--
ALTER TABLE `bordereau`
  ADD PRIMARY KEY (`IdBordereau`,`NumLicence`),
  ADD KEY `FK_Bordereau_NumLicence` (`NumLicence`),
  ADD KEY `FK_Bordereau_IdTresorier` (`IdTresorier`);

--
-- Index pour la table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`IdClub`),
  ADD KEY `FK_Club_IdLigue` (`IdLigue`);

--
-- Index pour la table `ligne_de_frais`
--
ALTER TABLE `ligne_de_frais`
  ADD PRIMARY KEY (`IdFrais`),
  ADD KEY `FK_Ligne_de_Frais_IdMotifs` (`IdMotifs`),
  ADD KEY `FK_Ligne_de_Frais_IdBordereau` (`IdBordereau`);

--
-- Index pour la table `ligue`
--
ALTER TABLE `ligue`
  ADD PRIMARY KEY (`IdLigue`);

--
-- Index pour la table `motifs`
--
ALTER TABLE `motifs`
  ADD PRIMARY KEY (`IdMotifs`);

--
-- Index pour la table `p_km`
--
ALTER TABLE `p_km`
  ADD PRIMARY KEY (`Année`);

--
-- Index pour la table `responsable_crib`
--
ALTER TABLE `responsable_crib`
  ADD PRIMARY KEY (`IdRespCrib`),
  ADD KEY `FK_ResponsableCRIB_IdLigue` (`IdLigue`);

--
-- Index pour la table `responsable_legal`
--
ALTER TABLE `responsable_legal`
  ADD PRIMARY KEY (`IdRespLegal`);

--
-- Index pour la table `tresorier`
--
ALTER TABLE `tresorier`
  ADD PRIMARY KEY (`IdTresorier`),
  ADD KEY `FK_Tresorier_IdClub` (`IdClub`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bordereau`
--
ALTER TABLE `bordereau`
  MODIFY `IdBordereau` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `club`
--
ALTER TABLE `club`
  MODIFY `IdClub` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligne_de_frais`
--
ALTER TABLE `ligne_de_frais`
  MODIFY `IdFrais` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ligue`
--
ALTER TABLE `ligue`
  MODIFY `IdLigue` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `motifs`
--
ALTER TABLE `motifs`
  MODIFY `IdMotifs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `p_km`
--
ALTER TABLE `p_km`
  MODIFY `Année` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `responsable_crib`
--
ALTER TABLE `responsable_crib`
  MODIFY `IdRespCrib` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `responsable_legal`
--
ALTER TABLE `responsable_legal`
  MODIFY `IdRespLegal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tresorier`
--
ALTER TABLE `tresorier`
  MODIFY `IdTresorier` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adherent`
--
ALTER TABLE `adherent`
  ADD CONSTRAINT `FK_Adherent_IdClub` FOREIGN KEY (`IdClub`) REFERENCES `club` (`IdClub`),
  ADD CONSTRAINT `FK_Adherent_IdRespLegal` FOREIGN KEY (`IdRespLegal`) REFERENCES `responsable_legal` (`IdRespLegal`);

--
-- Contraintes pour la table `bordereau`
--
ALTER TABLE `bordereau`
  ADD CONSTRAINT `FK_Bordereau_IdTresorier` FOREIGN KEY (`IdTresorier`) REFERENCES `tresorier` (`IdTresorier`),
  ADD CONSTRAINT `FK_Bordereau_NumLicence` FOREIGN KEY (`NumLicence`) REFERENCES `adherent` (`NumLicence`);

--
-- Contraintes pour la table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `FK_Club_IdLigue` FOREIGN KEY (`IdLigue`) REFERENCES `ligue` (`IdLigue`);

--
-- Contraintes pour la table `ligne_de_frais`
--
ALTER TABLE `ligne_de_frais`
  ADD CONSTRAINT `FK_Ligne_de_Frais_IdBordereau` FOREIGN KEY (`IdBordereau`) REFERENCES `bordereau` (`IdBordereau`),
  ADD CONSTRAINT `FK_Ligne_de_Frais_IdMotifs` FOREIGN KEY (`IdMotifs`) REFERENCES `motifs` (`IdMotifs`);

--
-- Contraintes pour la table `responsable_crib`
--
ALTER TABLE `responsable_crib`
  ADD CONSTRAINT `FK_ResponsableCRIB_IdLigue` FOREIGN KEY (`IdLigue`) REFERENCES `ligue` (`IdLigue`);

--
-- Contraintes pour la table `tresorier`
--
ALTER TABLE `tresorier`
  ADD CONSTRAINT `FK_Tresorier_IdClub` FOREIGN KEY (`IdClub`) REFERENCES `club` (`IdClub`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
