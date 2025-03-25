-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 25 mars 2025 à 16:16
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données : `pdo_exe_c2`
--
DROP DATABASE IF EXISTS `pdo_exe_c2`;
CREATE DATABASE IF NOT EXISTS `pdo_exe_c2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pdo_exe_c2`;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
                                          `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
                                          `titre` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                                          `texte` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
                                          `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                          PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `texte`, `date_creation`) VALUES
                                                                     (1, 'Premier titre', 'Voici notre premier texte', '2025-03-25 15:05:01'),
                                                                     (2, 'Deuxième article', 'Voici mon deuxième article', '2025-03-25 15:43:39'),
                                                                     (3, 'Troisième article', 'Encore un article !', '2025-03-25 15:46:57');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
