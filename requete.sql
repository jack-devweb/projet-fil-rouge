-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 29 mars 2023 à 07:57
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mobi`
--

-- --------------------------------------------------------

--
-- Structure de la table `amis_utilisateur`
--

CREATE TABLE `amis_utilisateur` (
  `id` int NOT NULL,
  `utilisateur_id` int NOT NULL,
  `ami_id` int NOT NULL,
  `statut` enum('en_attente','acceptee','rejetee') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `amis_utilisateur`
--

INSERT INTO `amis_utilisateur` (`id`, `utilisateur_id`, `ami_id`, `statut`) VALUES
(4, 38, 33, 'en_attente'),
(5, 38, 34, 'en_attente'),
(6, 38, 35, 'en_attente'),
(7, 38, 36, 'en_attente'),
(8, 38, 37, 'en_attente');

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

CREATE TABLE `appartient` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `id_game` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `appartient`
--

INSERT INTO `appartient` (`id`, `user_id`, `id_game`) VALUES
(5, 9, 9),
(6, 9, 9),
(9, 14, 2),
(11, 9, NULL),
(12, 9, NULL),
(13, 9, NULL),
(14, 9, NULL),
(15, 9, NULL),
(16, 9, NULL),
(17, 9, NULL),
(18, 9, NULL),
(19, 9, NULL),
(20, 9, NULL),
(21, 9, NULL),
(22, 9, NULL),
(23, 9, NULL),
(24, 9, NULL),
(25, 9, NULL),
(26, 9, NULL),
(27, 9, NULL),
(28, 9, NULL),
(29, 9, NULL),
(30, 9, NULL),
(31, 9, NULL),
(32, 9, NULL),
(33, 9, NULL),
(34, 9, NULL),
(35, 9, NULL),
(36, 9, NULL),
(37, 9, NULL),
(38, 9, NULL),
(39, 9, NULL),
(40, 9, NULL),
(41, 9, NULL),
(42, 9, NULL),
(43, 9, NULL),
(44, 9, NULL),
(45, 9, NULL),
(46, 15, NULL),
(47, 15, NULL),
(48, 15, NULL),
(49, 15, NULL),
(50, 15, NULL),
(51, 15, NULL),
(52, 9, NULL),
(53, 9, NULL),
(54, 9, NULL),
(55, 9, NULL),
(56, 9, NULL),
(57, 9, NULL),
(58, 9, NULL),
(59, 9, NULL),
(60, 9, NULL),
(61, 9, NULL),
(62, 9, NULL),
(63, 9, NULL),
(64, 9, NULL),
(65, 9, NULL),
(66, 9, NULL),
(67, 9, NULL),
(68, 9, NULL),
(69, 9, NULL),
(70, 9, NULL),
(71, 9, NULL),
(72, 9, NULL),
(73, 9, NULL),
(74, 9, NULL),
(75, 9, 6),
(85, 9, 3),
(86, 9, 3),
(5, 9, 9),
(6, 9, 9),
(9, 14, 2),
(11, 9, NULL),
(12, 9, NULL),
(13, 9, NULL),
(14, 9, NULL),
(15, 9, NULL),
(16, 9, NULL),
(17, 9, NULL),
(18, 9, NULL),
(19, 9, NULL),
(20, 9, NULL),
(21, 9, NULL),
(22, 9, NULL),
(23, 9, NULL),
(24, 9, NULL),
(25, 9, NULL),
(26, 9, NULL),
(27, 9, NULL),
(28, 9, NULL),
(29, 9, NULL),
(30, 9, NULL),
(31, 9, NULL),
(32, 9, NULL),
(33, 9, NULL),
(34, 9, NULL),
(35, 9, NULL),
(36, 9, NULL),
(37, 9, NULL),
(38, 9, NULL),
(39, 9, NULL),
(40, 9, NULL),
(41, 9, NULL),
(42, 9, NULL),
(43, 9, NULL),
(44, 9, NULL),
(45, 9, NULL),
(46, 15, NULL),
(47, 15, NULL),
(48, 15, NULL),
(49, 15, NULL),
(50, 15, NULL),
(51, 15, NULL),
(52, 9, NULL),
(53, 9, NULL),
(54, 9, NULL),
(55, 9, NULL),
(56, 9, NULL),
(57, 9, NULL),
(58, 9, NULL),
(59, 9, NULL),
(60, 9, NULL),
(61, 9, NULL),
(62, 9, NULL),
(63, 9, NULL),
(64, 9, NULL),
(65, 9, NULL),
(66, 9, NULL),
(67, 9, NULL),
(68, 9, NULL),
(69, 9, NULL),
(70, 9, NULL),
(71, 9, NULL),
(72, 9, NULL),
(73, 9, NULL),
(74, 9, NULL),
(75, 9, 6),
(85, 9, 3),
(86, 9, 3),
(1, 9, 6),
(2, 9, 6),
(3, 9, 6),
(4, 9, 6),
(5, 9, 9),
(6, 9, 9),
(9, 14, 2),
(10, 9, 3),
(11, 9, NULL),
(12, 9, NULL),
(13, 9, NULL),
(14, 9, NULL),
(15, 9, NULL),
(16, 9, NULL),
(17, 9, NULL),
(18, 9, NULL),
(19, 9, NULL),
(20, 9, NULL),
(21, 9, NULL),
(22, 9, NULL),
(23, 9, NULL),
(24, 9, NULL),
(25, 9, NULL),
(26, 9, NULL),
(27, 9, NULL),
(28, 9, NULL),
(29, 9, NULL),
(30, 9, NULL),
(31, 9, NULL),
(32, 9, NULL),
(33, 9, NULL),
(34, 9, NULL),
(35, 9, NULL),
(36, 9, NULL),
(37, 9, NULL),
(38, 9, NULL),
(39, 9, NULL),
(40, 9, NULL),
(41, 9, NULL),
(42, 9, NULL),
(43, 9, NULL),
(44, 9, NULL),
(45, 9, NULL),
(87, 9, 2),
(88, 9, 2),
(89, 9, 4),
(90, 9, 4),
(91, 18, 4);

-- --------------------------------------------------------

--
-- Structure de la table `discussions`
--

CREATE TABLE `discussions` (
  `id` int UNSIGNED NOT NULL,
  `user1_id` int NOT NULL,
  `user2_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `discussions`
--

INSERT INTO `discussions` (`id`, `user1_id`, `user2_id`) VALUES
(5, 34, 33),
(6, 34, 32),
(7, 34, 35),
(8, 33, 32),
(9, 36, 33),
(10, 33, 33),
(11, 38, 33),
(12, 38, 37),
(13, 38, 36),
(14, 38, 35),
(15, 33, 37),
(16, 34, 36),
(17, 34, 37),
(18, 34, 38),
(19, 43, 42),
(20, 43, 36),
(21, 43, 33),
(22, 43, 34),
(23, 43, 35),
(24, 35, 36),
(25, 33, 35),
(26, 38, 40),
(27, 38, 43);

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `description` text,
  `lieu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `favorite_games`
--

CREATE TABLE `favorite_games` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `game_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `favorite_games`
--

INSERT INTO `favorite_games` (`id`, `user_id`, `game_id`) VALUES
(16, 33, 1),
(17, 33, 3),
(18, 33, 7),
(19, 35, 1),
(20, 33, 10),
(21, 38, 1);

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE `friends` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `statut` enum('en_attente','accepte','refuse') DEFAULT 'en_attente',
  `date_demande` datetime DEFAULT NULL,
  `friend_id` int NOT NULL DEFAULT '0',
  `friend_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `statut`, `date_demande`, `friend_id`, `friend_name`) VALUES
(44, 38, 'accepte', '2023-03-26 18:19:56', 34, 'Lina'),
(45, 38, 'accepte', '2023-03-26 18:19:58', 35, 'Oxane'),
(46, 38, 'accepte', '2023-03-26 18:20:01', 36, 'Thibault'),
(47, 38, 'en_attente', '2023-03-26 18:20:03', 37, 'Julie'),
(48, 33, 'en_attente', '2023-03-26 18:33:06', 38, 'Chris'),
(49, 33, 'en_attente', '2023-03-26 18:33:07', 37, 'Julie'),
(50, 33, 'accepte', '2023-03-26 18:33:08', 36, 'Thibault'),
(53, 34, 'en_attente', '2023-03-26 18:57:12', 38, 'Chris'),
(54, 34, 'en_attente', '2023-03-26 18:57:13', 37, 'Julie'),
(55, 34, 'accepte', '2023-03-26 18:57:14', 36, 'Thibault'),
(56, 34, 'accepte', '2023-03-26 18:57:15', 35, 'Oxane'),
(57, 34, 'en_attente', '2023-03-26 18:57:16', 33, 'Arnaud'),
(59, 35, 'accepte', '2023-03-26 18:59:30', 34, 'Lina'),
(60, 35, 'accepte', '2023-03-26 18:59:32', 36, 'Thibault'),
(61, 35, 'en_attente', '2023-03-26 18:59:34', 37, 'Julie'),
(62, 35, 'en_attente', '2023-03-26 18:59:35', 38, 'Chris'),
(63, 36, 'en_attente', '2023-03-26 20:51:28', 37, 'Julie'),
(64, 36, 'en_attente', '2023-03-26 20:51:45', 38, 'Chris'),
(65, 36, 'accepte', '2023-03-26 20:51:47', 35, 'Oxane'),
(68, 43, 'en_attente', '2023-03-26 22:05:36', 33, 'Arnaud'),
(69, 43, 'en_attente', '2023-03-26 22:05:40', 34, 'Lina'),
(70, 43, 'en_attente', '2023-03-26 22:05:43', 40, 'lucas'),
(71, 43, 'en_attente', '2023-03-26 22:05:45', 41, 'Camille'),
(72, 35, 'en_attente', '2023-03-27 11:57:12', 33, 'Arnaud'),
(74, 33, 'en_attente', '2023-03-27 12:15:32', 35, 'Oxane'),
(75, 33, 'en_attente', '2023-03-27 14:09:58', 42, 'jules'),
(76, 38, 'en_attente', '2023-03-27 23:03:55', 43, 'hugo'),
(77, 38, 'en_attente', '2023-03-27 23:21:27', 33, 'Arnaud'),
(78, 36, 'en_attente', '2023-03-28 10:15:59', 43, 'hugo'),
(80, 34, 'en_attente', '2023-03-28 12:05:04', 39, 'john'),
(81, 34, 'en_attente', '2023-03-28 12:05:26', 40, 'lucas');

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE `game` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `annee_de_sortie` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `game`
--

INSERT INTO `game` (`id`, `name`, `description`, `annee_de_sortie`) VALUES
(1, 'Fortnite', 'Fortnite est un jeu de survie et de construction de base en monde ouvert.', '2017-07-25 00:00:00'),
(2, 'Apex Legends', 'Apex Legends est un jeu de tir à la première personne multijoueur en ligne.', '2019-02-04 00:00:00'),
(3, 'Valheim', 'Valheim est un jeu de survie en monde ouvert se déroulant dans un univers inspiré de la mythologie nordique.', '2021-02-02 00:00:00'),
(4, 'Cyberpunk 2077', 'Cyberpunk 2077 est un jeu de rôle en monde ouvert se déroulant dans un univers dystopique futuriste.', '2020-12-10 00:00:00'),
(5, 'Resident Evil Village', 'Resident Evil Village est un jeu d\'horreur et d\'aventure à la première personne.', '2021-05-07 00:00:00'),
(6, 'COD Warzone', 'Call of Duty: Warzone est un jeu de tir à la première personne multijoueur en ligne.', '2020-03-10 00:00:00'),
(7, 'Outriders', 'Outriders est un jeu de tir à la troisième personne et de rôle en ligne se déroulant dans un univers de science-fiction.', '2021-04-01 00:00:00'),
(8, 'It Takes Two', 'It Takes Two est un jeu de plateforme et de coopération en ligne.', '2021-03-26 00:00:00'),
(9, 'Hitman 3', 'Hitman 3 est un jeu d\'infiltration et d\'aventure en monde ouvert.', '2021-01-20 00:00:00'),
(10, 'Deathloop', 'Deathloop est un jeu de tir à la première personne et d\'aventure se déroulant dans un univers de science-fiction.', '2021-09-14 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id_message` int NOT NULL,
  `contenu` text NOT NULL,
  `date` datetime NOT NULL,
  `id` int NOT NULL,
  `discussion_id` int NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id_message`, `contenu`, `date`, `id`, `discussion_id`, `is_read`) VALUES
(320, 'bonjour ', '2023-03-24 01:25:56', 34, 7, 0),
(321, '', '2023-03-24 01:26:09', 34, 7, 0),
(322, 'aaa', '2023-03-24 01:27:30', 34, 6, 0),
(323, 'aaaaaaaa', '2023-03-24 01:28:03', 34, 5, 0),
(324, 'salut ', '2023-03-24 13:20:34', 34, 5, 0),
(325, 'gfgh', '2023-03-24 13:22:42', 34, 5, 0),
(326, 'salut', '2023-03-24 13:24:07', 36, 9, 0),
(327, 'bonjour comment ca va', '2023-03-25 11:47:49', 34, 5, 0),
(328, 'OUI CA VA ET TOI', '2023-03-25 11:49:34', 33, 5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  `date` datetime NOT NULL,
  `id_users` int NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`id`, `title`, `contenu`, `date`, `id_users`, `titre`, `image_path`) VALUES
(1, 'aaa', 'aaaa', '2023-03-28 14:55:58', 34, NULL, ''),
(2, 'aaa', 'aaa', '2023-03-28 14:56:10', 34, NULL, 'images/6423000aabf84.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `id` int NOT NULL,
  `id_evenement` int NOT NULL,
  `id_utilisateur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `possede`
--

CREATE TABLE `possede` (
  `id` int NOT NULL,
  `id_game` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_jeu`
--

CREATE TABLE `type_jeu` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `type_jeu`
--

INSERT INTO `type_jeu` (`id`, `nom`) VALUES
(1, 'Jeu de stratégie'),
(2, 'Jeu de rôle'),
(3, 'Jeu de sport');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nom` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `bio` text NOT NULL,
  `jeux_favoris` varchar(100) NOT NULL,
  `est_connecte` tinyint(1) NOT NULL DEFAULT '1',
  `last_active` int NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `password`, `email`, `date`, `bio`, `jeux_favoris`, `est_connecte`, `last_active`, `image`) VALUES
(33, 'Arnaud', 'aaa', 'AAA@AAA.AA', '2023-03-23', 'Arnaud, passionné de jeux vidéo depuis l\'enfance, j\'ai grandi en explorant des mondes virtuels et en relevant des défis épiques. ', 'pc', 1, 0, '2023-03-23-44.user-307993_640.png'),
(34, 'Lina', 'aaa', 'bbb@bbb.bb', '2023-03-23', 'Je suis une fan inconditionnelle de jeux d\'aventure et de plateforme. J\'adore explorer des univers colorés et captivants, et je m\'épanouis en résolvant des énigmes complexes.', 'xbox', 1, 0, NULL),
(35, 'Oxane', 'aaa', 'bbb@bb.bb', '2023-03-23', 'Je me considère comme une adepte des jeux multijoueurs en ligne, principalement des FPS et des MOBA. Rien ne me plaît plus que de former des équipes avec mes amis et de relever ensemble des défis compétitifs.', 'pc', 1, 0, '2023-03-23-39.user-310807_640.png'),
(36, 'Thibault', 'aaa', 'vvv@vvv.vv', '2023-03-24', ' Passionné de jeux de stratégie et de simulation, je passe des heures à bâtir des empires et à gérer des ressources. J\'aime échanger des astuces avec d\'autres joueurs pour améliorer mes compétences.', 'xbox,pc', 1, 0, '2023-03-24-31.user-310807_640.png'),
(37, 'Julie', 'aaa', 'aaa@aa.aa', '2023-03-25', '\"Salut ! Je m\'appelle julie, et je suis un passionnée de jeux vidéo depuis mon plus jeune âge. J\'ai grandi en explorant les mondes fantastiques de Zelda et en affrontant des adversaires redoutables dans Street Fighter. Aujourd\'hui, je suis une joueuse assidue de jeux en ligne compétitifs tels que Fortnite et Overwatch,', 'pc', 1, 0, '2023-03-25-54.avatar-1606916_640.png'),
(38, 'Chris', 'aaa', 'aaa@aaa.aa', '2023-03-25', 'Passionné de jeux de stratégie et de simulation, je passe des heures à bâtir des empires et à gérer des ressources. J\'aime échanger des astuces avec d\'autres joueurs pour améliorer mes compétences.', 'pc', 1, 0, '641f87ce12039.png'),
(39, 'john', 'aaa', 'john@jim.com', '2023-03-26', 'Passionné de jeux de course et de sport, je suis toujours à la recherche de nouveaux défis à relever avec mes amis.', 'playstation', 1, 0, '2023-03-26-56.profil.png'),
(40, 'lucas', 'aaa', 'luca@gmail.com', '2023-03-26', 'J\\\'adore les jeux de stratégie et les jeux de cartes. Je suis toujours prêt pour un bon duel entre amis.', 'pc', 1, 0, '2023-03-26-21.homme-daffaire (1).png'),
(41, 'Camille', 'aaa', 'camille@gmail.com', '2023-03-26', 'Fan de jeux d\\\'action et de plateforme, je suis constamment à la recherche de nouveaux défis et de records à battre.', 'nintendo switch', 1, 0, '2023-03-26-49.utilisateur (1).png'),
(42, 'jules', 'aaa', 'jules@gmail.com', '2023-03-26', 'Je suis un joueur occasionnel qui aime les jeux de puzzle et de réflexion. Les jeux de société en ligne sont également mes favoris', 'xbox', 1, 0, NULL),
(43, 'hugo', 'aaa', 'hugho@gmail.com', '2023-03-26', 'Je suis un fan de jeux de tir à la première personne et de jeux d\\\'action. J\\\'aime me plonger dans des univers futuristes et réaliser des exploits héroïques.', 'xbox', 1, 0, '2023-03-26-00.homme.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `amis_utilisateur`
--
ALTER TABLE `amis_utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_utilisateur_idx` (`utilisateur_id`),
  ADD KEY `fk_ami_idx` (`ami_id`);

--
-- Index pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD KEY `id` (`id`);

--
-- Index pour la table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `favorite_games`
--
ALTER TABLE `favorite_games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Index pour la table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `messages_users_FK` (`id`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_users_FK` (`id_users`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participe_evenements_FK` (`id_evenement`),
  ADD KEY `participe_users_FK` (`id_utilisateur`);

--
-- Index pour la table `possede`
--
ALTER TABLE `possede`
  ADD PRIMARY KEY (`id`,`id_game`),
  ADD KEY `possede_game0_FK` (`id_game`);

--
-- Index pour la table `type_jeu`
--
ALTER TABLE `type_jeu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `amis_utilisateur`
--
ALTER TABLE `amis_utilisateur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `appartient`
--
ALTER TABLE `appartient`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT pour la table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `favorite_games`
--
ALTER TABLE `favorite_games`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=329;

--
-- AUTO_INCREMENT pour la table `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `type_jeu`
--
ALTER TABLE `type_jeu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `amis_utilisateur`
--
ALTER TABLE `amis_utilisateur`
  ADD CONSTRAINT `fk_ami` FOREIGN KEY (`ami_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`utilisateur_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `favorite_games`
--
ALTER TABLE `favorite_games`
  ADD CONSTRAINT `favorite_games_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `favorite_games_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_users_FK` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_users_FK` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `participe`
--
ALTER TABLE `participe`
  ADD CONSTRAINT `participe_evenements_FK` FOREIGN KEY (`id_evenement`) REFERENCES `evenements` (`id`),
  ADD CONSTRAINT `participe_users_FK` FOREIGN KEY (`id_utilisateur`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `possede`
--
ALTER TABLE `possede`
  ADD CONSTRAINT `possede_game0_FK` FOREIGN KEY (`id_game`) REFERENCES `game` (`id`),
  ADD CONSTRAINT `possede_users_FK` FOREIGN KEY (`id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
