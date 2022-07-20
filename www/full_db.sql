-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : mer. 20 juil. 2022 à 10:06
-- Version du serveur : 5.7.38
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Structure de la table `esgi_admin`
--

CREATE TABLE `esgi_admin` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Structure de la table `esgi_page`
--

CREATE TABLE `esgi_page` (
  `id` int(11) NOT NULL,
  `page_title` varchar(100) NOT NULL,
  `page_slug` varchar(255) NOT NULL,
  `page_content` longtext NOT NULL,
  `page_authorId` int(11) DEFAULT NULL,
  `page_createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `esgi_user`
--

CREATE TABLE `esgi_user` (
  `id` int(11) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `role` int(2) NOT NULL DEFAULT '0',
  `token` char(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) NOT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `reset_link_token` varchar(100) DEFAULT NULL,
  `activation_expiry` timestamp NULL DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `esgi_admin`
--
ALTER TABLE `esgi_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_users` (`user_id`);

--
-- Index pour la table `esgi_article`
--
ALTER TABLE `esgi_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`article_categoryId`),
  ADD KEY `article_authorId` (`article_authorId`);

--
-- Index pour la table `esgi_page`
--
ALTER TABLE `esgi_page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`page_authorId`);

--
-- Index pour la table `esgi_user`
--
ALTER TABLE `esgi_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `esgi_admin`
--
ALTER TABLE `esgi_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `esgi_article`
--
ALTER TABLE `esgi_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `esgi_page`
--
ALTER TABLE `esgi_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT pour la table `esgi_user`
--
ALTER TABLE `esgi_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `esgi_admin`
--
ALTER TABLE `esgi_admin`
  ADD CONSTRAINT `admin_users` FOREIGN KEY (`user_id`) REFERENCES `esgi_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
