-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Lun 05 Janvier 2015 à 13:01
-- Version du serveur :  5.5.38
-- Version de PHP :  5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `polaris`
--

-- --------------------------------------------------------

--
-- Structure de la table `attribut`
--

CREATE TABLE `attribut` (
`pk_attribut` int(11) NOT NULL,
  `tt_code` varchar(255) NOT NULL,
  `tt_designation` varchar(255) NOT NULL,
  `fk_entitetype` int(11) NOT NULL,
  `fk_categorie` int(11) NOT NULL,
  `in_order` int(11) NOT NULL,
  `tt_type` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `attribut`
--

INSERT INTO `attribut` (`pk_attribut`, `tt_code`, `tt_designation`, `fk_entitetype`, `fk_categorie`, `in_order`, `tt_type`) VALUES
(1, 'FO', 'Force', 1, 2, 1, 'Carac'),
(2, 'GAB', 'Gabarit', 1, 2, 2, 'Carac'),
(3, 'CHA', 'Charisme', 1, 2, 3, 'Carac'),
(4, 'INT', 'Intelligence', 1, 2, 4, 'Carac'),
(5, 'VOL', 'Volonté', 1, 2, 5, 'Carac'),
(6, 'RES', 'Résistance', 1, 2, 6, 'Carac'),
(7, 'AG', 'Agilité', 1, 2, 7, 'Carac'),
(8, 'SGFD', 'Sang-froid', 1, 2, 8, 'Carac'),
(9, 'INS', 'Instinct', 1, 2, 9, 'Carac'),
(10, 'RAP', 'Rapidité', 1, 2, 10, 'Carac');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
`pk_categorie` int(11) NOT NULL,
  `tt_designation` varchar(255) NOT NULL,
  `in_order` int(11) NOT NULL,
  `tt_code` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`pk_categorie`, `tt_designation`, `in_order`, `tt_code`) VALUES
(1, 'Généralités', 1, 'PJ_GENERALITES'),
(2, 'Attributs', 2, 'PJ_ATTRIBUTS');

-- --------------------------------------------------------

--
-- Structure de la table `entite`
--

CREATE TABLE `entite` (
`pk_entite` int(11) NOT NULL,
  `fk_entitetype` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `entite`
--

INSERT INTO `entite` (`pk_entite`, `fk_entitetype`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `entitetype`
--

CREATE TABLE `entitetype` (
`pk_entitetype` int(11) NOT NULL,
  `tt_code` varchar(255) NOT NULL,
  `tt_designation` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `entitetype`
--

INSERT INTO `entitetype` (`pk_entitetype`, `tt_code`, `tt_designation`) VALUES
(1, 'PJ', 'Personnage joueur');

-- --------------------------------------------------------

--
-- Structure de la table `modificateur`
--

CREATE TABLE `modificateur` (
`pk_modificateur` int(11) NOT NULL,
  `fk_entite` int(11) NOT NULL,
  `fk_attribut` int(11) NOT NULL,
  `tt_designation` varchar(255) NOT NULL,
  `fL_modificateur` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `valeur`
--

CREATE TABLE `valeur` (
`pk_valeur` int(11) NOT NULL,
  `fk_attribut` int(11) NOT NULL,
  `tt_valeur` text NOT NULL,
  `fk_entite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `attribut`
--
ALTER TABLE `attribut`
 ADD PRIMARY KEY (`pk_attribut`), ADD UNIQUE KEY `tt_code` (`tt_code`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
 ADD PRIMARY KEY (`pk_categorie`), ADD UNIQUE KEY `tt_code` (`tt_code`);

--
-- Index pour la table `entite`
--
ALTER TABLE `entite`
 ADD PRIMARY KEY (`pk_entite`);

--
-- Index pour la table `entitetype`
--
ALTER TABLE `entitetype`
 ADD PRIMARY KEY (`pk_entitetype`), ADD UNIQUE KEY `tt_code` (`tt_code`);

--
-- Index pour la table `modificateur`
--
ALTER TABLE `modificateur`
 ADD PRIMARY KEY (`pk_modificateur`);

--
-- Index pour la table `valeur`
--
ALTER TABLE `valeur`
 ADD PRIMARY KEY (`pk_valeur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `attribut`
--
ALTER TABLE `attribut`
MODIFY `pk_attribut` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
MODIFY `pk_categorie` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `entite`
--
ALTER TABLE `entite`
MODIFY `pk_entite` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `entitetype`
--
ALTER TABLE `entitetype`
MODIFY `pk_entitetype` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `modificateur`
--
ALTER TABLE `modificateur`
MODIFY `pk_modificateur` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `valeur`
--
ALTER TABLE `valeur`
MODIFY `pk_valeur` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
