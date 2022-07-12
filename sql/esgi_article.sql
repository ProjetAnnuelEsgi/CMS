-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : mar. 12 juil. 2022 à 01:46
-- Version du serveur : 5.7.38
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mvcdocker2`
--

-- --------------------------------------------------------

--
-- Structure de la table `esgi_article`
--

CREATE TABLE `esgi_article` (
  `id` int(11) NOT NULL,
  `article_title` text NOT NULL,
  `article_slug` varchar(255) NOT NULL,
  `article_content` longtext NOT NULL,
  `article_status` tinyint(4) NOT NULL,
  `article_publishAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `article_authorId` int(11) DEFAULT NULL,
  `article_categoryId` int(11) DEFAULT NULL,
  `article_createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `article_updatedAt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `esgi_article`
--
ALTER TABLE `esgi_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`article_categoryId`),
  ADD KEY `article_authorId` (`article_authorId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `esgi_article`
--
ALTER TABLE `esgi_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `esgi_article`
--
ALTER TABLE `esgi_article`
  ADD CONSTRAINT `article_authorId` FOREIGN KEY (`article_authorId`) REFERENCES `esgi_author` (`id`),
  ADD CONSTRAINT `category_id` FOREIGN KEY (`article_categoryId`) REFERENCES `esgi_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
