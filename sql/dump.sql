-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jan 05, 2015 at 02:56 PM
-- Server version: 5.6.17-debug-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `polaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `attribut`
--

CREATE TABLE IF NOT EXISTS `attribut` (
`pk_attribut` int(11) NOT NULL,
  `tt_code` varchar(255) NOT NULL,
  `tt_designation` varchar(255) NOT NULL,
  `fk_entitetype` int(11) NOT NULL,
  `fk_categorie` int(11) NOT NULL,
  `in_order` int(11) NOT NULL,
  `tt_type` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `attribut`
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
(10, 'RAP', 'Rapidité', 1, 2, 10, 'Carac'),
(11, 'NOM', 'Nom', 1, 1, 1, 'Simple');

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
`pk_categorie` int(11) NOT NULL,
  `tt_designation` varchar(255) NOT NULL,
  `in_order` int(11) NOT NULL,
  `tt_code` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`pk_categorie`, `tt_designation`, `in_order`, `tt_code`) VALUES
(1, 'Généralités', 1, 'PJ_GENERALITES'),
(2, 'Attributs', 2, 'PJ_ATTRIBUTS');

-- --------------------------------------------------------

--
-- Table structure for table `entite`
--

CREATE TABLE IF NOT EXISTS `entite` (
`pk_entite` int(11) NOT NULL,
  `fk_entitetype` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `entite`
--

INSERT INTO `entite` (`pk_entite`, `fk_entitetype`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `entitetype`
--

CREATE TABLE IF NOT EXISTS `entitetype` (
`pk_entitetype` int(11) NOT NULL,
  `tt_code` varchar(255) NOT NULL,
  `tt_designation` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `entitetype`
--

INSERT INTO `entitetype` (`pk_entitetype`, `tt_code`, `tt_designation`) VALUES
(1, 'PJ', 'Personnage joueur');

-- --------------------------------------------------------

--
-- Table structure for table `modificateur`
--

CREATE TABLE IF NOT EXISTS `modificateur` (
`pk_modificateur` int(11) NOT NULL,
  `fk_entite` int(11) NOT NULL,
  `fk_attribut` int(11) NOT NULL,
  `tt_designation` varchar(255) NOT NULL,
  `fL_modificateur` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `valeur`
--

CREATE TABLE IF NOT EXISTS `valeur` (
`pk_valeur` int(11) NOT NULL,
  `fk_attribut` int(11) NOT NULL,
  `tt_valeur` text NOT NULL,
  `fk_entite` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `valeur`
--

INSERT INTO `valeur` (`pk_valeur`, `fk_attribut`, `tt_valeur`, `fk_entite`) VALUES
(1, 11, 'perso 1', 1),
(2, 11, 'perso 2', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attribut`
--
ALTER TABLE `attribut`
 ADD PRIMARY KEY (`pk_attribut`), ADD UNIQUE KEY `tt_code` (`tt_code`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
 ADD PRIMARY KEY (`pk_categorie`), ADD UNIQUE KEY `tt_code` (`tt_code`);

--
-- Indexes for table `entite`
--
ALTER TABLE `entite`
 ADD PRIMARY KEY (`pk_entite`);

--
-- Indexes for table `entitetype`
--
ALTER TABLE `entitetype`
 ADD PRIMARY KEY (`pk_entitetype`), ADD UNIQUE KEY `tt_code` (`tt_code`);

--
-- Indexes for table `modificateur`
--
ALTER TABLE `modificateur`
 ADD PRIMARY KEY (`pk_modificateur`);

--
-- Indexes for table `valeur`
--
ALTER TABLE `valeur`
 ADD PRIMARY KEY (`pk_valeur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attribut`
--
ALTER TABLE `attribut`
MODIFY `pk_attribut` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
MODIFY `pk_categorie` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `entite`
--
ALTER TABLE `entite`
MODIFY `pk_entite` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `entitetype`
--
ALTER TABLE `entitetype`
MODIFY `pk_entitetype` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `modificateur`
--
ALTER TABLE `modificateur`
MODIFY `pk_modificateur` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `valeur`
--
ALTER TABLE `valeur`
MODIFY `pk_valeur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
