-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Mar 13 Janvier 2015 à 08:13
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
  `tt_code` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tt_designation` varchar(255) CHARACTER SET latin1 NOT NULL,
  `fk_entitetype` int(11) NOT NULL,
  `fk_categorie` int(11) NOT NULL,
  `in_order` int(11) NOT NULL,
  `tt_type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tt_data` varchar(255) NOT NULL,
  `tt_defaultvalue` varchar(255) NOT NULL,
  `in_modifiable` int(1) DEFAULT '1',
  `in_modificateur` int(1) NOT NULL DEFAULT '0',
  `in_jet` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2369 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `attribut`
--

INSERT INTO `attribut` (`pk_attribut`, `tt_code`, `tt_designation`, `fk_entitetype`, `fk_categorie`, `in_order`, `tt_type`, `tt_data`, `tt_defaultvalue`, `in_modifiable`, `in_modificateur`, `in_jet`) VALUES
(2293, 'ARMEDISTANCE_DESIGNATION', 'DÃ©signation', 315, 0, 0, 'Simple', '{}', '', 1, 0, 1),
(2294, 'ARMEDISTANCE_TYPE', 'Type', 315, 0, 0, 'Simple', '{}', '', 1, 0, 1),
(2295, 'ARMEDISTANCE_MILIEU', 'Milieu', 315, 0, 0, 'Simple', '{}', '', 1, 0, 1),
(2296, 'ARMEDISTANCE_DEGATSPHYS', 'DÃ©gats physiques', 315, 0, 0, 'Simple', '{}', '', 1, 0, 1),
(2297, 'ARMEDISTANCE_DEGATSCHOC', 'DÃ©gats de choc', 315, 0, 0, 'Simple', '{}', '', 1, 0, 1),
(2298, 'ARMEDISTANCE_MUNITIONS', 'Munitions', 315, 0, 0, 'Simple', '{}', '0', 1, 0, 1),
(2299, 'ARMEDISTANCE_EQUIPED', 'EquipÃ©', 315, 0, 0, 'Simple', '{}', '0', 1, 0, 1),
(2300, 'REF_ARMEDISTANCE_DESIGNATION', 'DÃ©signation', 316, 0, 0, 'Simple', '{}', '', 1, 0, 1),
(2301, 'REF_ARMEDISTANCE_TYPE', 'Type', 316, 0, 0, 'Simple', '{}', '', 1, 0, 1),
(2302, 'REF_ARMEDISTANCE_MILIEU', 'Milieu', 316, 0, 0, 'Simple', '{}', '', 1, 0, 1),
(2303, 'REF_ARMEDISTANCE_DEGATSPHYS', 'DÃ©gats physiques', 316, 0, 0, 'Simple', '{}', '', 1, 0, 1),
(2304, 'REF_ARMEDISTANCE_DEGATSCHOC', 'DÃ©gats de choc', 316, 0, 0, 'Simple', '{}', '', 1, 0, 1),
(2305, 'CONTACT_NOM', 'Nom', 317, 458, 0, 'Simple', '{}', '', 1, 0, 1),
(2306, 'CONTACT_LOCALISATION', 'DerniÃ¨re localisation connue', 317, 458, 0, 'Simple', '{}', '', 1, 0, 1),
(2307, 'CONTACT_TYPE', 'Type de contact', 317, 458, 0, 'Simple', '{}', '', 1, 0, 1),
(2308, 'CONTACT_DETAILS', 'DÃ©tails divers', 317, 458, 0, 'Simple', '{}', '', 1, 0, 1),
(2309, 'MODIFICATEUR_TYPE', 'Type de modificateur', 318, 459, 0, 'Simple', '{}', '', 1, 0, 1),
(2310, 'MODIFICATEUR_LABEL', 'Label', 318, 459, 0, 'Simple', '{}', '', 1, 0, 1),
(2311, 'MODIFICATEUR_CATEGORIE', 'CatÃ©gorie', 318, 459, 0, 'Simple', '{}', '', 1, 0, 1),
(2312, 'MODIFICATEUR_CATEGORIE_ID', 'Form ID cat', 318, 459, 0, 'Simple', '{}', '', 1, 0, 1),
(2313, 'MODIFICATEUR_DEFAUT', 'Defaut', 318, 459, 0, 'Simple', '{}', '0', 1, 0, 1),
(2314, 'MODIFICATEUR_VALUE', 'Valeur', 318, 459, 0, 'Simple', '{}', '', 1, 0, 1),
(2315, 'PROGRESSION_TALENT', 'Talent concernÃ©', 319, 460, 0, 'Simple', '{}', '', 1, 0, 1),
(2316, 'PROGRESSION_VALEUR', '% de progression', 319, 460, 0, 'Simple', '{}', '', 1, 0, 1),
(2317, 'PROGRESSION_RAISON', 'Raison de la progression', 319, 460, 0, 'Simple', '{}', '', 1, 0, 1),
(2318, 'PROGRESSION_LIBRE', 'Progression libre', 319, 460, 0, 'Simple', '{}', '', 1, 0, 1),
(2319, 'JOURNAL_TEXTE', 'Texte', 320, 461, 0, 'Simple', '{}', '', 1, 0, 1),
(2320, 'JOURNAL_DATE', 'Texte', 320, 461, 0, 'Simple', '{}', '', 1, 0, 1),
(2321, 'HEMORRAGIE_TYPE', 'Code du type d''hÃ©morragie', 321, 462, 0, 'Simple', '{}', '', 1, 0, 1),
(2322, 'POISON_DESIGNATION', 'DÃ©signation', 321, 463, 0, 'Simple', '{}', '', 1, 0, 1),
(2323, 'POISON_INTENSITE', 'IntensitÃ©', 321, 463, 0, 'Simple', '{}', '', 1, 0, 1),
(2324, 'POISON_EFFETS', 'Effets', 321, 463, 0, 'Simple', '{}', '', 1, 0, 1),
(2325, 'MALADIE_DESIGNATION', 'DÃ©signation', 321, 464, 0, 'Simple', '{}', '', 1, 0, 1),
(2326, 'MALADIE_INTENSITE', 'IntensitÃ©', 321, 464, 0, 'Simple', '{}', '', 1, 0, 1),
(2327, 'MALADIE_EFFETS', 'Effets', 321, 464, 0, 'Simple', '{}', '', 1, 0, 1),
(2328, 'FATIGUE', 'Fatigue', 321, 465, 0, 'cells', '{"max":"({ATTR:FO}+{ATTR:RES}+{ATTR:VOL})\\/3"}', '1', 1, 0, 0),
(2329, 'PROTECTION_JAMBEDROITE', 'Jambe droite', 321, 466, 0, 'Equipement', '{"localStart":1,"localEnd":11}', '{"equipement":"","usure":"","protection":0,"resistance":""}', 1, 0, 0),
(2330, 'BLESSURE_INCONSCIENCE', 'Inconscience', 321, 467, 0, 'cells', '{"max":"12"}', '0', 1, 0, 0),
(2331, 'BLESSURE_LEGERE', 'Blessures lÃ©gÃ¨res', 321, 467, 0, 'cells', '{"max":"8"}', '0', 1, 0, 0),
(2332, 'BLESSURE_GRAVE', 'Blessures graves', 321, 467, 0, 'cells', '{"max":"6"}', '0', 1, 0, 0),
(2333, 'BLESSURE_CRITIQUE', 'Blessures critiques', 321, 467, 0, 'cells', '{"max":"4"}', '0', 1, 0, 0),
(2334, 'BLESSURE_FATAL', 'Blessures fatales', 321, 467, 0, 'cells', '{"max":"2"}', '0', 1, 0, 0),
(2335, 'BLESSURE_MORT', 'Mort', 321, 467, 0, 'cells', '{"max":"1"}', '0', 1, 0, 0),
(2336, 'SEUIL_INCONSCIENCE', 'Inconscience', 321, 468, 0, 'caracsec', '{"total":"round(({ATTR:RES}+{ATTR:GAB}+{ATTR:VOL})\\/4)"}', '0', 0, 0, 0),
(2337, 'SEUIL_LEGERE', 'Blessure lÃ©gÃ¨re', 321, 468, 0, 'caracsec', '{"total":"round(({ATTR:RES}+{ATTR:GAB}+{ATTR:VOL})\\/6)"}', '0', 0, 0, 0),
(2338, 'SEUIL_GRAVE', 'Blessure grave', 321, 468, 0, 'caracsec', '{"total":"round(({ATTR:RES}+{ATTR:GAB}+{ATTR:VOL})\\/3)"}', '0', 0, 0, 0),
(2339, 'SEUIL_CRITIQUE', 'Inconscience', 321, 468, 0, 'caracsec', '{"total":"round(({ATTR:RES}+{ATTR:GAB}+{ATTR:VOL})\\/2)"}', '0', 0, 0, 0),
(2340, 'SEUIL_FATAL', 'Fatal', 321, 468, 0, 'caracsec', '{"total":"round(({ATTR:RES}+{ATTR:GAB}+{ATTR:VOL})\\/1)"}', '0', 0, 0, 0),
(2341, 'SEUIL_MORT', 'Mort', 321, 468, 0, 'caracsec', '{"total":"round(({ATTR:RES}+{ATTR:GAB}+{ATTR:VOL})*1.5)"}', '0', 0, 0, 0),
(2342, 'NOM', 'Nom', 321, 469, 0, 'Simple', '{}', '', 1, 0, 0),
(2343, 'DATENAISSANCE', 'Date de naissance', 321, 469, 0, 'Simple', '{}', '', 1, 0, 0),
(2344, 'AGE', 'Age', 321, 469, 0, 'Simple', '{}', '', 1, 0, 0),
(2345, 'SEXE', 'Sexe', 321, 469, 0, 'Simple', '{}', '', 1, 0, 0),
(2346, 'YEUX', 'Yeux', 321, 469, 0, 'Simple', '{}', '', 1, 0, 0),
(2347, 'CHEVEUX', 'Cheveux', 321, 469, 0, 'Simple', '{}', '', 1, 0, 0),
(2348, 'RACE', 'Race', 321, 469, 0, 'Simple', '{}', '', 1, 0, 0),
(2349, 'TAILLE', 'Taille', 321, 469, 0, 'Simple', '{}', '', 1, 0, 0),
(2350, 'POIDS', 'Poids', 321, 469, 0, 'Simple', '{}', '', 1, 0, 0),
(2351, 'LIEUNAISSANCE', 'Lieu de naissance', 321, 469, 0, 'Simple', '{}', '', 1, 0, 0),
(2352, 'FO', 'Force', 321, 470, 0, 'Carac', '{"total":"{VAL:initial}+{SPE:MODIFIER}"}', '{"initial":0}', 1, 1, 1),
(2353, 'GAB', 'Gabarit', 321, 470, 0, 'Carac', '{"total":"{VAL:initial}+{SPE:MODIFIER}"}', '{"initial":0}', 1, 1, 1),
(2354, 'CHA', 'Charisme', 321, 470, 0, 'Carac', '{"total":"{VAL:initial}+{SPE:MODIFIER}"}', '{"initial":0}', 1, 1, 1),
(2355, 'INT', 'Intelligence', 321, 470, 0, 'Carac', '{"total":"{VAL:initial}+{SPE:MODIFIER}"}', '{"initial":0}', 1, 1, 1),
(2356, 'VOL', 'VolontÃ©', 321, 470, 0, 'Carac', '{"total":"{VAL:initial}+{SPE:MODIFIER}"}', '{"initial":0}', 1, 1, 1),
(2357, 'RES', 'RÃ©sistance', 321, 470, 0, 'Carac', '{"total":"{VAL:initial}+{SPE:MODIFIER}"}', '{"initial":0}', 1, 1, 1),
(2358, 'AG', 'AgilitÃ©', 321, 470, 0, 'Carac', '{"total":"{VAL:initial}+{SPE:MODIFIER}"}', '{"initial":0}', 1, 1, 1),
(2359, 'SGF', 'Sang-froid', 321, 470, 0, 'Carac', '{"total":"{VAL:initial}+{SPE:MODIFIER}"}', '{"initial":0}', 1, 1, 1),
(2360, 'INS', 'Instinct', 321, 470, 0, 'Carac', '{"total":"{VAL:initial}+{SPE:MODIFIER}"}', '{"initial":0}', 1, 1, 1),
(2361, 'RAP', 'RapiditÃ©', 321, 470, 0, 'Carac', '{"total":"{VAL:initial}+{SPE:MODIFIER}"}', '{"initial":0}', 1, 1, 1),
(2362, 'PERCEPTION', 'Perception', 321, 471, 0, 'caracsec', '{"total":"round(({ATTR:INT}+{ATTR:INS})\\/2)+{SPE:MODIFIER}"}', '0', 0, 1, 0),
(2363, 'BONUSDEGATS', 'Bonus aux dÃ©gats', 321, 471, 0, 'caracsec', '{"total":"round({ATTR:FO}+({ATTR:GAB}\\/2))+{SPE:MODIFIER}"}', '0', 0, 1, 0),
(2364, 'TALENT_ABSENCE', 'Absence', 321, 472, 0, 'Talent', '{"bonus":"{ATTR:AG}+{ATTR:FO}","total":"({VAL:niveau}*10)+{VAL:initial}+{DATA:bonus}+{SPE:MODIFIER}"}', '{"niveau":3,"initial":7}', 1, 1, 1),
(2365, 'NOMMENU', 'Nom affichÃ© du menu', 322, 0, 0, 'Simple', '{}', '', 1, 0, 1),
(2366, 'CODEAPPZ', 'Code de l''applicatif', 322, 0, 0, 'Simple', '{}', '', 1, 0, 1),
(2367, 'ACTIONMENU_NOM', 'Nom affichÃ© du menu', 323, 0, 0, 'Simple', '{}', '', 1, 0, 1),
(2368, 'ACTIONMENU_CODE', 'Code du panel', 323, 0, 0, 'Simple', '{}', '', 1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
`pk_categorie` int(11) NOT NULL,
  `tt_designation` varchar(255) CHARACTER SET latin1 NOT NULL,
  `in_order` int(11) NOT NULL,
  `tt_code` varchar(255) CHARACTER SET latin1 NOT NULL,
  `fk_entitetype` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=473 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`pk_categorie`, `tt_designation`, `in_order`, `tt_code`, `fk_entitetype`) VALUES
(458, 'Contacts', 0, 'CONTACTS', 317),
(459, 'Modificateur', 0, 'MODIFICATEUR', 318),
(460, 'Progression', 0, 'PROGRESSION', 319),
(461, 'Journal', 0, 'JOURNAL', 320),
(462, 'HÃ©morragies', 0, 'HEMORRAGIE', 321),
(463, 'Poisons', 0, 'POISON', 321),
(464, 'Maladies', 0, 'MALADIE', 321),
(465, 'Fatigue', 0, 'FATIGUE', 321),
(466, 'Equipements de combat', 0, 'EQUIPEMENTCOMBAT', 321),
(467, 'Blessures', 0, 'BLESSURES', 321),
(468, 'Seuils de blessure', 0, 'SEUILSBLESSURES', 321),
(469, 'Informations gÃ©nÃ©rales', 0, 'GENERAL', 321),
(470, 'CaractÃ©ristiques', 0, 'CARACTERISTIQUES', 321),
(471, 'CaractÃ©ristiques secondaires', 0, 'CARACSEC', 321),
(472, 'Talents', 0, 'TALENTS', 321);

-- --------------------------------------------------------

--
-- Structure de la table `entite`
--

CREATE TABLE `entite` (
`pk_entite` int(11) NOT NULL,
  `fk_entitetype` int(11) NOT NULL,
  `fk_categorie` int(11) NOT NULL,
  `fk_entite` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1848 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `entite`
--

INSERT INTO `entite` (`pk_entite`, `fk_entitetype`, `fk_categorie`, `fk_entite`) VALUES
(1795, 316, 0, 0),
(1796, 316, 0, 0),
(1797, 318, 0, 0),
(1798, 318, 0, 0),
(1799, 318, 0, 0),
(1800, 318, 0, 0),
(1801, 318, 0, 0),
(1802, 318, 0, 0),
(1803, 318, 0, 0),
(1804, 318, 0, 0),
(1805, 318, 0, 0),
(1806, 318, 0, 0),
(1807, 318, 0, 0),
(1808, 318, 0, 0),
(1809, 318, 0, 0),
(1810, 318, 0, 0),
(1811, 318, 0, 0),
(1812, 318, 0, 0),
(1813, 318, 0, 0),
(1814, 318, 0, 0),
(1815, 318, 0, 0),
(1816, 318, 0, 0),
(1817, 318, 0, 0),
(1818, 318, 0, 0),
(1819, 318, 0, 0),
(1820, 318, 0, 0),
(1821, 318, 0, 0),
(1822, 318, 0, 0),
(1823, 318, 0, 0),
(1824, 318, 0, 0),
(1825, 318, 0, 0),
(1826, 321, 0, 0),
(1827, 321, 0, 0),
(1828, 322, 0, 0),
(1829, 322, 0, 0),
(1830, 322, 0, 0),
(1831, 322, 0, 0),
(1832, 322, 0, 0),
(1833, 322, 0, 0),
(1834, 323, 0, 0),
(1835, 323, 0, 0),
(1836, 323, 0, 0),
(1837, 323, 0, 0),
(1838, 323, 0, 0),
(1839, 323, 0, 0),
(1840, 323, 0, 0),
(1841, 323, 0, 0),
(1842, 323, 0, 0),
(1843, 323, 0, 0),
(1844, 323, 0, 0),
(1845, 315, 0, 1768),
(1847, 315, 0, 1826);

-- --------------------------------------------------------

--
-- Structure de la table `entitetype`
--

CREATE TABLE `entitetype` (
`pk_entitetype` int(11) NOT NULL,
  `tt_code` varchar(255) CHARACTER SET latin1 NOT NULL,
  `tt_designation` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=324 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `entitetype`
--

INSERT INTO `entitetype` (`pk_entitetype`, `tt_code`, `tt_designation`) VALUES
(315, 'ARMEDISTANCE', 'Armes Ã  distance'),
(316, 'REF_ARMEDISTANCE', 'Armes Ã  distance'),
(317, 'CONTACT', 'Contacts'),
(318, 'MODIFICATEUR', 'Modificateur'),
(319, 'PROGRESSION', 'Progression'),
(320, 'JOURNAL', 'EntrÃ©e du journal'),
(321, 'PJ', 'Personnage joueur'),
(322, 'MAINMENU', 'Menu principal'),
(323, 'ACTIONMENU', 'Menu d''action (GAME)');

-- --------------------------------------------------------

--
-- Structure de la table `modificateur`
--

CREATE TABLE `modificateur` (
`pk_modificateur` int(11) NOT NULL,
  `fk_entite` int(11) NOT NULL,
  `fk_attribut` int(11) NOT NULL,
  `tt_designation` varchar(255) CHARACTER SET latin1 NOT NULL,
  `fl_modificateur` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `palier`
--

CREATE TABLE `palier` (
`pk_palier` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `marge` int(11) NOT NULL,
  `palier` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2731 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `palier`
--

INSERT INTO `palier` (`pk_palier`, `min`, `max`, `marge`, `palier`) VALUES
(2626, 2, 9, 1, 1),
(2627, 2, 9, 2, 1),
(2628, 2, 9, 3, 1),
(2629, 2, 9, 4, 1),
(2630, 2, 9, 5, 1),
(2631, 2, 9, 6, 1),
(2632, 1, 1, 11, 1),
(2633, 10, 19, 1, 2),
(2634, 9, 9, 2, 2),
(2635, 8, 8, 3, 2),
(2636, 7, 7, 4, 2),
(2637, 6, 6, 5, 2),
(2638, 5, 5, 6, 2),
(2639, 4, 4, 7, 2),
(2640, 3, 3, 8, 2),
(2641, 2, 2, 9, 2),
(2642, 1, 1, 11, 2),
(2643, 20, 29, 1, 3),
(2644, 18, 19, 2, 3),
(2645, 16, 17, 3, 3),
(2646, 14, 15, 4, 3),
(2647, 12, 13, 5, 3),
(2648, 10, 11, 6, 3),
(2649, 8, 9, 7, 3),
(2650, 6, 7, 8, 3),
(2651, 4, 5, 9, 3),
(2652, 2, 3, 10, 3),
(2653, 1, 1, 11, 3),
(2654, 30, 39, 1, 4),
(2655, 27, 29, 2, 4),
(2656, 24, 26, 3, 4),
(2657, 21, 23, 4, 4),
(2658, 18, 20, 5, 4),
(2659, 15, 17, 6, 4),
(2660, 12, 14, 7, 4),
(2661, 9, 11, 8, 4),
(2662, 6, 8, 9, 4),
(2663, 3, 5, 10, 4),
(2664, 1, 2, 11, 4),
(2665, 40, 49, 1, 5),
(2666, 36, 39, 2, 5),
(2667, 32, 35, 3, 5),
(2668, 28, 31, 4, 5),
(2669, 24, 27, 5, 5),
(2670, 20, 23, 6, 5),
(2671, 16, 19, 7, 5),
(2672, 12, 15, 8, 5),
(2673, 8, 11, 9, 5),
(2674, 4, 7, 10, 5),
(2675, 1, 3, 11, 5),
(2676, 50, 59, 1, 6),
(2677, 45, 49, 2, 6),
(2678, 40, 44, 3, 6),
(2679, 35, 39, 4, 6),
(2680, 30, 34, 5, 6),
(2681, 25, 29, 6, 6),
(2682, 20, 24, 7, 6),
(2683, 15, 19, 8, 6),
(2684, 10, 14, 9, 6),
(2685, 5, 9, 10, 6),
(2686, 1, 4, 11, 6),
(2687, 60, 69, 1, 7),
(2688, 54, 59, 2, 7),
(2689, 48, 53, 3, 7),
(2690, 42, 47, 4, 7),
(2691, 36, 41, 5, 7),
(2692, 30, 35, 6, 7),
(2693, 24, 29, 7, 7),
(2694, 18, 23, 8, 7),
(2695, 12, 17, 9, 7),
(2696, 6, 11, 10, 7),
(2697, 1, 5, 11, 7),
(2698, 70, 79, 1, 8),
(2699, 63, 69, 2, 8),
(2700, 56, 62, 3, 8),
(2701, 49, 55, 4, 8),
(2702, 42, 48, 5, 8),
(2703, 35, 41, 6, 8),
(2704, 28, 34, 7, 8),
(2705, 21, 27, 8, 8),
(2706, 14, 20, 9, 8),
(2707, 7, 13, 10, 8),
(2708, 1, 6, 11, 8),
(2709, 80, 89, 1, 9),
(2710, 72, 79, 2, 9),
(2711, 64, 71, 3, 9),
(2712, 56, 63, 4, 9),
(2713, 48, 55, 5, 9),
(2714, 40, 47, 6, 9),
(2715, 32, 39, 7, 9),
(2716, 24, 31, 8, 9),
(2717, 16, 23, 9, 9),
(2718, 8, 15, 10, 9),
(2719, 1, 7, 11, 9),
(2720, 90, 99, 1, 10),
(2721, 81, 89, 2, 10),
(2722, 72, 80, 3, 10),
(2723, 63, 71, 4, 10),
(2724, 54, 62, 5, 10),
(2725, 45, 53, 6, 10),
(2726, 36, 44, 7, 10),
(2727, 27, 35, 8, 10),
(2728, 18, 26, 9, 10),
(2729, 9, 17, 10, 10),
(2730, 1, 8, 11, 10);

-- --------------------------------------------------------

--
-- Structure de la table `valeur`
--

CREATE TABLE `valeur` (
`pk_valeur` int(11) NOT NULL,
  `fk_attribut` int(11) NOT NULL,
  `tt_valeur` text NOT NULL,
  `fk_entite` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5962 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `valeur`
--

INSERT INTO `valeur` (`pk_valeur`, `fk_attribut`, `tt_valeur`, `fk_entite`) VALUES
(5743, 2300, 'Pistolet', 1795),
(5744, 2301, 'Armes de poing', 1795),
(5745, 2302, 'Surface', 1795),
(5746, 2303, '3', 1795),
(5747, 2304, '0', 1795),
(5748, 2300, 'Pistolet choc', 1796),
(5749, 2301, 'Armes de poing', 1796),
(5750, 2302, 'Surface', 1796),
(5751, 2303, '0', 1796),
(5752, 2304, '6', 1796),
(5753, 2309, 'ECOUTER', 1797),
(5754, 2311, 'Bruit Ã  percevoir', 1797),
(5755, 2310, 'Murmure', 1797),
(5756, 2312, 'mod_bruit', 1797),
(5757, 2314, '6', 1797),
(5758, 2309, 'ECOUTER', 1798),
(5759, 2311, 'Bruit Ã  percevoir', 1798),
(5760, 2310, 'Voix basse', 1798),
(5761, 2312, 'mod_bruit', 1798),
(5762, 2314, '2', 1798),
(5763, 2309, 'ECOUTER', 1799),
(5764, 2311, 'Bruit Ã  percevoir', 1799),
(5765, 2310, 'Voix normale', 1799),
(5766, 2312, 'mod_bruit', 1799),
(5767, 2314, '0', 1799),
(5768, 2313, '1', 1799),
(5769, 2309, 'ECOUTER', 1800),
(5770, 2311, 'Bruit Ã  percevoir', 1800),
(5771, 2310, 'Crier', 1800),
(5772, 2312, 'mod_bruit', 1800),
(5773, 2314, '-6', 1800),
(5774, 2309, 'ECOUTER', 1801),
(5775, 2311, 'Bruit Ã  percevoir', 1801),
(5776, 2310, 'Haut-parleur', 1801),
(5777, 2312, 'mod_bruit', 1801),
(5778, 2314, '-12', 1801),
(5779, 2309, 'ECOUTER', 1802),
(5780, 2311, 'Bruit de fond', 1802),
(5781, 2312, 'mod_bruitdefond', 1802),
(5782, 2310, 'Silence', 1802),
(5783, 2314, '0', 1802),
(5784, 2313, '1', 1802),
(5785, 2309, 'ECOUTER', 1803),
(5786, 2311, 'Bruit de fond', 1803),
(5787, 2312, 'mod_bruitdefond', 1803),
(5788, 2310, 'Ronronnement de machine', 1803),
(5789, 2314, '2', 1803),
(5790, 2309, 'ECOUTER', 1804),
(5791, 2311, 'Bruit de fond', 1804),
(5792, 2312, 'mod_bruitdefond', 1804),
(5793, 2310, 'Discussion animÃ©e', 1804),
(5794, 2314, '4', 1804),
(5795, 2309, 'ECOUTER', 1805),
(5796, 2311, 'Bruit de fond', 1805),
(5797, 2312, 'mod_bruitdefond', 1805),
(5798, 2310, 'Ambiance de bar', 1805),
(5799, 2314, '6', 1805),
(5800, 2309, 'ECOUTER', 1806),
(5801, 2311, 'Bruit de fond', 1806),
(5802, 2312, 'mod_bruitdefond', 1806),
(5803, 2310, 'Machinerie bruyante', 1806),
(5804, 2314, '12', 1806),
(5805, 2309, 'ECOUTER', 1807),
(5806, 2311, 'Terrain', 1807),
(5807, 2312, 'mod_terrain', 1807),
(5808, 2310, 'DÃ©gagÃ©', 1807),
(5809, 2314, '0', 1807),
(5810, 2313, '1', 1807),
(5811, 2309, 'ECOUTER', 1808),
(5812, 2311, 'Terrain', 1808),
(5813, 2312, 'mod_terrain', 1808),
(5814, 2310, 'ObstruÃ©', 1808),
(5815, 2314, '4', 1808),
(5816, 2309, 'ECOUTER', 1809),
(5817, 2311, 'Terrain', 1809),
(5818, 2312, 'mod_terrain', 1809),
(5819, 2310, 'Endroit clos', 1809),
(5820, 2314, '-3', 1809),
(5821, 2309, 'ECOUTER', 1810),
(5822, 2311, 'Terrain', 1810),
(5823, 2312, 'mod_terrain', 1810),
(5824, 2310, 'Endroit rÃ©sonnant', 1810),
(5825, 2314, '-6', 1810),
(5826, 2309, 'PERCEPTION', 1811),
(5827, 2311, 'DifficultÃ© de base', 1811),
(5828, 2312, 'difficultebase', 1811),
(5829, 2310, 'Le joueur somnole', 1811),
(5830, 2314, '24', 1811),
(5831, 2309, 'PERCEPTION', 1812),
(5832, 2311, 'DifficultÃ© de base', 1812),
(5833, 2312, 'difficultebase', 1812),
(5834, 2310, 'Le joueur ne fait pas attention', 1812),
(5835, 2314, '18', 1812),
(5836, 2313, '1', 1812),
(5837, 2309, 'PERCEPTION', 1813),
(5838, 2311, 'DifficultÃ© de base', 1813),
(5839, 2312, 'difficultebase', 1813),
(5840, 2310, 'Le joueur est attentif (sans se concentrer sur un sens)', 1813),
(5841, 2314, '12', 1813),
(5842, 2309, 'PERCEPTION', 1814),
(5843, 2311, 'DifficultÃ© de base', 1814),
(5844, 2312, 'difficultebase', 1814),
(5845, 2310, 'Le joueur est attentif (se concentre sur un sens)', 1814),
(5846, 2314, '8', 1814),
(5847, 2309, 'PERCEPTION', 1815),
(5848, 2311, 'DifficultÃ© de base', 1815),
(5849, 2312, 'difficultebase', 1815),
(5850, 2310, 'Le joueur est trÃ¨s attentif (sans se concentrer sur un sens)', 1815),
(5851, 2314, '10', 1815),
(5852, 2309, 'PERCEPTION', 1816),
(5853, 2311, 'DifficultÃ© de base', 1816),
(5854, 2312, 'difficultebase', 1816),
(5855, 2310, 'Le joueur est trÃ¨s attentif (se concentre sur un sens)', 1816),
(5856, 2314, '6', 1816),
(5857, 2309, 'VOIR', 1817),
(5858, 2311, 'Terrain', 1817),
(5859, 2312, 'mod1', 1817),
(5860, 2310, 'DÃ©gagÃ©', 1817),
(5861, 2314, '-3', 1817),
(5862, 2309, 'VOIR', 1818),
(5863, 2311, 'Terrain', 1818),
(5864, 2312, 'mod1', 1818),
(5865, 2310, 'Partiellement obstruÃ© (peu de vÃ©gÃ©tation, relief bas, quelques personnes)', 1818),
(5866, 2314, '0', 1818),
(5867, 2313, '1', 1818),
(5868, 2309, 'VOIR', 1819),
(5869, 2311, 'Terrain', 1819),
(5870, 2312, 'mod1', 1819),
(5871, 2310, 'ObstruÃ© (feuillage fourni, relief variÃ©, petite foule, eau sale)', 1819),
(5872, 2314, '3', 1819),
(5873, 2309, 'VOIR', 1820),
(5874, 2311, 'Terrain', 1820),
(5875, 2312, 'mod1', 1820),
(5876, 2310, 'TrÃ¨s obstruÃ© (vÃ©gÃ©tatuin dense, bcp de relief, rues Equinoxe, foule importante, eau egouts)', 1820),
(5877, 2314, '6', 1820),
(5878, 2309, 'VOIR', 1821),
(5879, 2311, 'LuminositÃ©', 1821),
(5880, 2312, 'mod2', 1821),
(5881, 2310, 'Forte (projecteurs, lumiÃ¨re solaire)', 1821),
(5882, 2314, '-3', 1821),
(5883, 2309, 'VOIR', 1822),
(5884, 2311, 'LuminositÃ©', 1822),
(5885, 2312, 'mod2', 1822),
(5886, 2310, 'Normale (Eclairage d''une citÃ©)', 1822),
(5887, 2314, '0', 1822),
(5888, 2313, '1', 1822),
(5889, 2309, 'VOIR', 1823),
(5890, 2311, 'LuminositÃ©', 1823),
(5891, 2312, 'mod2', 1823),
(5892, 2310, 'Moyenne (Torches, lampes Ã©lectriques)', 1823),
(5893, 2314, '3', 1823),
(5894, 2309, 'VOIR', 1824),
(5895, 2311, 'LuminositÃ©', 1824),
(5896, 2312, 'mod2', 1824),
(5897, 2310, 'Faible (veilleuse, fumigÃ¨nes, tempÃªte)', 1824),
(5898, 2314, '6', 1824),
(5899, 2309, 'VOIR', 1825),
(5900, 2311, 'LuminositÃ©', 1825),
(5901, 2312, 'mod2', 1825),
(5902, 2310, 'TrÃ¨s faible (ombre, tÃ©nÃ¨bre partielles, tempÃªte de sable)', 1825),
(5903, 2314, '9', 1825),
(5904, 2342, 'Joueur 1', 1826),
(5905, 2352, '{"initial":15}', 1826),
(5906, 2353, '{"initial":17}', 1826),
(5907, 2354, '{"initial":19}', 1826),
(5908, 2355, '{"initial":13}', 1826),
(5909, 2356, '{"initial":17}', 1826),
(5910, 2357, '{"initial":11}', 1826),
(5911, 2358, '{"initial":14}', 1826),
(5912, 2359, '{"initial":13}', 1826),
(5913, 2360, '{"initial":9}', 1826),
(5914, 2361, '{"initial":10}', 1826),
(5915, 2342, 'Joueur 2', 1827),
(5916, 2352, '{"initial":20}', 1827),
(5917, 2358, '{"initial":10}', 1827),
(5918, 2365, 'Gestion du jeu', 1828),
(5919, 2366, 'gestion', 1828),
(5920, 2365, 'Joueurs', 1829),
(5921, 2366, 'game', 1829),
(5922, 2365, 'Combats sous-marin', 1830),
(5923, 2366, 'submarine', 1830),
(5924, 2365, 'Journal', 1831),
(5925, 2366, 'journal', 1831),
(5926, 2365, 'Aventure', 1832),
(5927, 2366, 'aventure', 1832),
(5928, 2365, 'EncyclopÃ©die sous-marine', 1833),
(5929, 2366, 'encyclopedie', 1833),
(5930, 2367, 'CaractÃ©ristiques principales', 1834),
(5931, 2368, 'caracs', 1834),
(5932, 2367, 'CaractÃ©ristiques secondaires', 1835),
(5933, 2368, 'caracssec', 1835),
(5934, 2367, 'Talents', 1836),
(5935, 2368, 'talents', 1836),
(5936, 2367, 'Modificateurs', 1837),
(5937, 2368, 'modificateurs', 1837),
(5938, 2367, 'Etat de santÃ©', 1838),
(5939, 2368, 'blessures', 1838),
(5940, 2367, 'Aventure', 1839),
(5941, 2368, 'aventure', 1839),
(5942, 2367, 'Historique', 1840),
(5943, 2368, 'historique', 1840),
(5944, 2367, 'Equipement', 1841),
(5945, 2368, 'equipement', 1841),
(5946, 2367, 'Inventaire', 1842),
(5947, 2368, 'inventaire', 1842),
(5948, 2367, 'Ennemis / alliÃ©s / contacts', 1843),
(5949, 2368, 'contacts', 1843),
(5950, 2367, 'Notes', 1844),
(5951, 2368, 'notes', 1844),
(5957, 2293, 'Pistolet choc', 1847),
(5958, 2294, 'Armes de poing', 1847),
(5959, 2295, 'Surface', 1847),
(5960, 2296, '0', 1847),
(5961, 2297, '6', 1847);

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
-- Index pour la table `palier`
--
ALTER TABLE `palier`
 ADD PRIMARY KEY (`pk_palier`);

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
MODIFY `pk_attribut` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2369;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
MODIFY `pk_categorie` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=473;
--
-- AUTO_INCREMENT pour la table `entite`
--
ALTER TABLE `entite`
MODIFY `pk_entite` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1848;
--
-- AUTO_INCREMENT pour la table `entitetype`
--
ALTER TABLE `entitetype`
MODIFY `pk_entitetype` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=324;
--
-- AUTO_INCREMENT pour la table `modificateur`
--
ALTER TABLE `modificateur`
MODIFY `pk_modificateur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `palier`
--
ALTER TABLE `palier`
MODIFY `pk_palier` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2731;
--
-- AUTO_INCREMENT pour la table `valeur`
--
ALTER TABLE `valeur`
MODIFY `pk_valeur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5962;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
