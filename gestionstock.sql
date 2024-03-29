-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 29, 2024 at 02:12 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestionstock`
--

-- --------------------------------------------------------

--
-- Table structure for table `affecter`
--

CREATE TABLE `affecter` (
  `idUser` int NOT NULL DEFAULT '0',
  `numSerie` varchar(50) NOT NULL DEFAULT '',
  `dateAffectation` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `affecter`
--

INSERT INTO `affecter` (`idUser`, `numSerie`, `dateAffectation`) VALUES
(36, '00321', '2024-02-28 15:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `numSerie` varchar(50) NOT NULL,
  `dateArr` datetime DEFAULT CURRENT_TIMESTAMP,
  `dateSortie` datetime DEFAULT NULL,
  `idModele` int NOT NULL,
  `idType` int DEFAULT NULL,
  `nomCategorie` varchar(50) NOT NULL,
  `nomSousCategorie` varchar(50) NOT NULL,
  `idFournisseur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`numSerie`, `dateArr`, `dateSortie`, `idModele`, `idType`, `nomCategorie`, `nomSousCategorie`, `idFournisseur`) VALUES
('00321', '2024-02-21 08:47:52', NULL, 1, 63, 'AUTRES', 'AUTRES', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `nomCategorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`nomCategorie`) VALUES
('AUTRES'),
('COMMUNICATION'),
('IMG'),
('INFORMATIQUE'),
('LOGISTIQUE'),
('RADIO'),
('REPORTAGE'),
('TV'),
('WEB');

-- --------------------------------------------------------

--
-- Table structure for table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `idFournisseur` int NOT NULL,
  `nomFournisseur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `fournisseur`
--

INSERT INTO `fournisseur` (`idFournisseur`, `nomFournisseur`) VALUES
(1, 'CARREFOUR');

-- --------------------------------------------------------

--
-- Table structure for table `modele`
--

CREATE TABLE `modele` (
  `idModele` int NOT NULL,
  `nomModele` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `modele`
--

INSERT INTO `modele` (`idModele`, `nomModele`) VALUES
(1, 'LENOVO'),
(2, 'LC'),
(3, 'DELL'),
(4, 'ACER');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `idprofil` varchar(20) NOT NULL DEFAULT '',
  `nomprofil` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`idprofil`, `nomprofil`) VALUES
('ADMIN', 'ADMINISTRATEUR'),
('VISIT', 'VISITEUR');

-- --------------------------------------------------------

--
-- Table structure for table `souscategorie`
--

CREATE TABLE `souscategorie` (
  `nomCategorie` varchar(50) NOT NULL DEFAULT '',
  `nomSousCategorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `souscategorie`
--

INSERT INTO `souscategorie` (`nomCategorie`, `nomSousCategorie`) VALUES
('AUTRES', 'AUTRES'),
('RADIO', 'CDM'),
('RADIO', 'OPS'),
('RADIO', 'REGIE'),
('RADIO', 'STUDIO'),
('REPORTAGE', 'JRI'),
('REPORTAGE', 'OPV'),
('REPORTAGE', 'WEB'),
('TV', 'NODAL'),
('TV', 'OPS'),
('TV', 'OPV'),
('TV', 'REGIE'),
('TV', 'STUDIO');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `idType` int NOT NULL,
  `nomType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`idType`, `nomType`) VALUES
(1, 'Ecran'),
(2, 'Television'),
(3, 'Clavier'),
(4, 'Cable'),
(5, 'Smartphone'),
(21, 'Casque'),
(58, 'Tour'),
(63, 'Cable HDMI'),
(66, 'Disque dur externe'),
(70, 'Carte graphique');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUser` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `login` varchar(50) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `idprofil` varchar(20) NOT NULL,
  `selUser` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`idUser`, `nom`, `prenom`, `login`, `hashed_password`, `idprofil`, `selUser`, `createdAt`) VALUES
(36, 'Marsu', 'Pilami', 'pilami.marsu', '$2y$10$F0.deSN9UEQ1n3qLPesatulrpCA4UlMzSRBRbQPXx3OEMX5JnLMOS', 'ADMIN', 'de8c2f768d1485741cb374e7131d96f5', '2024-02-21 11:21:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affecter`
--
ALTER TABLE `affecter`
  ADD PRIMARY KEY (`idUser`,`numSerie`),
  ADD KEY `numSerie` (`numSerie`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`numSerie`),
  ADD KEY `idModele` (`idModele`),
  ADD KEY `idType` (`idType`),
  ADD KEY `nomCategorie` (`nomCategorie`,`nomSousCategorie`),
  ADD KEY `idFournisseur` (`idFournisseur`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`nomCategorie`);

--
-- Indexes for table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`idFournisseur`);

--
-- Indexes for table `modele`
--
ALTER TABLE `modele`
  ADD PRIMARY KEY (`idModele`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`idprofil`);

--
-- Indexes for table `souscategorie`
--
ALTER TABLE `souscategorie`
  ADD PRIMARY KEY (`nomCategorie`,`nomSousCategorie`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`idType`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `idprofil` (`idprofil`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `idFournisseur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `modele`
--
ALTER TABLE `modele`
  MODIFY `idModele` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affecter`
--
ALTER TABLE `affecter`
  ADD CONSTRAINT `affecter_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `utilisateur` (`idUser`),
  ADD CONSTRAINT `affecter_ibfk_2` FOREIGN KEY (`numSerie`) REFERENCES `article` (`numSerie`);

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`idModele`) REFERENCES `modele` (`idModele`),
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`idType`) REFERENCES `type` (`idType`),
  ADD CONSTRAINT `article_ibfk_3` FOREIGN KEY (`nomCategorie`,`nomSousCategorie`) REFERENCES `souscategorie` (`nomCategorie`, `nomSousCategorie`),
  ADD CONSTRAINT `article_ibfk_4` FOREIGN KEY (`idFournisseur`) REFERENCES `fournisseur` (`idFournisseur`);

--
-- Constraints for table `souscategorie`
--
ALTER TABLE `souscategorie`
  ADD CONSTRAINT `souscategorie_ibfk_1` FOREIGN KEY (`nomCategorie`) REFERENCES `categorie` (`nomCategorie`);

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`idprofil`) REFERENCES `profil` (`idprofil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
