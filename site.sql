-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Sam 24 Décembre 2016 à 18:25
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `site`
--

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_inscription` date NOT NULL,
  `lastvote` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `pseudo`, `email`, `password`, `date_inscription`, `lastvote`) VALUES
(1, 'Emil3f', 'emile@infomaniak.ch', '29c44cc3d9c16d96b34f584e1fcdcec18b728672', '2016-11-08', 1482527577),
(2, '', 'emile@test.ch', 'a16358be6e2306b153b1f071477e68837266075e', '2016-11-25', 0),
(3, 'emiletest', 'emile@caca.com', 'ce485ec0086fb7b0056c866f74ceb26ebd5b459f', '2016-11-27', 0),
(4, 'caca', 'pipi@gmail.com', '356a192b7913b04c54574d18c28d46e6395428ab', '2016-11-27', 0),
(5, 'celine', 'prout@gmail.com', '7afeeac0445ee96ea7b04c5365228ffe9aaa6683', '2016-11-28', 0),
(6, 'anus', 'caacaasdsa@ga.com', '356a192b7913b04c54574d18c28d46e6395428ab', '2016-11-28', 0),
(7, 'emile2', 'emile2@gmail.com', '29c44cc3d9c16d96b34f584e1fcdcec18b728672', '2016-11-30', 0);

-- --------------------------------------------------------

--
-- Structure de la table `stars`
--

CREATE TABLE `stars` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `nb_points` int(11) NOT NULL,
  `date_creation` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `stars`
--

INSERT INTO `stars` (`id`, `nom`, `pays`, `occupation`, `nb_points`, `date_creation`) VALUES
(1, 'Emile Fontanet', 'Suisse', 'Physicien', 145, '2016-11-11'),
(2, 'Donald Trump', 'Etats-Unis', 'Politicien', 15, '2016-11-18'),
(3, 'Eminem', 'Etats-Unis', 'Musicien', 94, '2016-11-19'),
(4, 'Guizmo', 'France', 'Musicien', 64, '2016-11-19'),
(5, 'Mezut Ozil', 'Allemagne', 'sportif', 51, '2016-11-29'),
(6, 'Céline Ries', 'Suisse', 'Chanteuse', 59, '2016-11-17'),
(7, 'Gérard Baste', 'France', 'Rappeur', 2, '2016-11-17'),
(8, 'test', 'test', 'test', 1, '2016-11-17'),
(9, 'Martin Fontanet', 'Suisse', 'Salsa', 3, '2016-11-19'),
(10, 'Martin Fontanet', 'Suisse', 'Boucher', 2, '2016-11-19'),
(11, 'Arthur Papinot', 'Suisse', 'Artiste', 1, '2016-11-19');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stars`
--
ALTER TABLE `stars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `stars`
--
ALTER TABLE `stars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
