-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 18 Septembre 2015 à 12:43
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `fraide_service`
--

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE IF NOT EXISTS `factures` (
  `id_fa` int(11) NOT NULL AUTO_INCREMENT,
  `num_fac` int(4) unsigned zerofill NOT NULL,
  `date_creation_facture` int(11) NOT NULL,
  `mode_reglement` varchar(20) NOT NULL,
  `tva` float(10,2) NOT NULL,
  `prix_unitaire` float(10,2) NOT NULL,
  `nb_heure` float(10,2) NOT NULL,
  `acompte` float(10,2) NOT NULL,
  `date_paiement` int(11) NOT NULL,
  PRIMARY KEY (`id_fa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `factures`
--

INSERT INTO `factures` (`id_fa`, `num_fac`, `date_creation_facture`, `mode_reglement`, `tva`, `prix_unitaire`, `nb_heure`, `acompte`, `date_paiement`) VALUES
(21, 0003, 1435439244, 'Chèque', 5.00, 30.00, 5.50, 0.00, 1435536000),
(22, 0004, 1435478482, 'Chèque', 5.00, 30.00, 8.50, 0.00, 0),
(23, 0005, 1441644302, 'Chèque', 5.00, 30.00, 12.00, 0.00, 1441584000),
(24, 0006, 1441983820, 'Espèce', 5.50, 30.00, 1.00, 0.00, 1441929600),
(25, 0007, 1442134277, 'Espèce', 5.50, 30.00, 2.00, 0.00, 0),
(26, 0008, 1442304396, 'Chèque', 5.50, 30.00, 5.50, 0.00, 0),
(27, 0009, 1442304954, 'Chèque', 5.50, 30.00, 1.50, 0.00, 0),
(28, 0010, 1442305201, 'Chèque', 5.50, 30.00, 5.50, 0.00, 0),
(29, 0011, 1442305610, 'Chèque', 5.50, 30.00, 1.00, 0.00, 0),
(30, 0012, 1442305718, 'Espèce', 5.50, 30.00, 1.00, 0.00, 1442275200);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
