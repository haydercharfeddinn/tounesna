-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 17 déc. 2024 à 18:44
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date_pub` date NOT NULL DEFAULT current_timestamp(),
  `image` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `blog`
--

INSERT INTO `blog` (`id`, `contenu`, `date_pub`, `image`) VALUES
(16, 'Sur le plan historique, la Tunisie est un véritable carrefour des civilisations. Berceau de Carthage, une des plus grandes puissances antiques, elle a également été marquée par l’Empire romain, l’arrivée de l’Islam, et plus tard par l’influence ottomane et française. Ses sites historiques, comme l’amphithéâtre d’El Jem, la médina de Tunis et les ruines de Dougga, témoignent de ce riche passé. Ces joyaux du patrimoine mondial inscrits à l’UNESCO attirent les passionnés d’histoire et d’architecture de tous horizons.', '2024-12-17', NULL),
(17, 'La culture tunisienne est un mélange harmonieux entre tradition et modernité. Les souks animés, où l\'on trouve des tapis, des poteries et des épices, côtoient des festivals modernes comme le Festival international de Carthage. La gastronomie tunisienne, célèbre pour ses saveurs épicées, propose des plats emblématiques tels que le couscous, la brik et la harissa. Ce mélange unique de traditions ancestrales et d’influences contemporaines fait de la Tunisie une destination aussi captivante que chaleureuse.', '2024-12-17', 0x75706c6f6164732f61626f75742d696d67312e706e67),
(18, 'La Tunisie, située au cœur de l\'Afrique du Nord, est un pays riche en histoire, en culture et en paysages variés. Bordée par la mer Méditerranée au nord et à l\'est, elle bénéficie d’un climat méditerranéen qui favorise des plages paradisiaques, notamment celles de Hammamet, Djerba et Mahdia. Au-delà de son littoral, la Tunisie offre des montagnes verdoyantes dans le nord-ouest, contrastant avec les dunes dorées du Sahara dans le sud. Cette diversité géographique attire chaque année des millions de visiteurs en quête de soleil, d\'aventure et de détente.', '2024-12-17', 0x75706c6f6164732f61626f75742d696d672e706e67),
(19, 'La Tunisie, située au cœur de l\'Afrique du Nord, est un pays riche en histoire, en culture et en paysages variés. Bordée par la mer Méditerranée au nord et à l\'est, elle bénéficie d’un climat méditerranéen qui favorise des plages paradisiaques, notamment celles de Hammamet, Djerba et Mahdia. Au-delà de son littoral, la Tunisie offre des montagnes verdoyantes dans le nord-ouest, contrastant avec les dunes dorées du Sahara dans le sud. Cette diversité géographique attire chaque année des millions de visiteurs en quête de soleil, d\'aventure et de détente. Parmi les joyaux naturels les plus célèbres, le lac salé de Chott el-Jerid et les oasis de Tozeur et Douz émerveillent par leur beauté singulière.', '2024-12-17', 0x75706c6f6164732f61626f75742d696d672e706e67);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nbrp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `event_id`, `email`, `nbrp`) VALUES
(1, 4, 'dhia.elghak1@gmail.com', 4);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `numero_telephone` int(15) NOT NULL,
  `adresse` text NOT NULL,
  `produit_nom` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `type_` enum('Cinema','Theatre','Concert','') DEFAULT NULL,
  `nom_eve` varchar(50) DEFAULT NULL,
  `date_` datetime DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `type_`, `nom_eve`, `date_`, `price`) VALUES
(4, 'Theatre', 'visa', '2024-11-27 00:57:24', 25),
(5, 'Cinema', 'Bolice', '2024-11-26 00:57:24', 15),
(6, 'Concert', 'nouba', '2024-11-23 00:58:41', 30),
(7, 'Theatre', 'Big Bossa', '2024-11-30 00:58:41', 20),
(14, 'Cinema', 'Walf of wall street', '2024-11-30 00:00:00', 20);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `nom_prod` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `nom_prod`) VALUES
(71, 'Fouta Traditionnelle');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `nom` varchar(50) NOT NULL,
  `descr` varchar(1000) NOT NULL,
  `prix` int(11) NOT NULL,
  `taille` varchar(50) NOT NULL,
  `img` varchar(500) NOT NULL,
  `catégorie` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`nom`, `descr`, `prix`, `taille`, `img`, `catégorie`) VALUES
('Barnous Traditionnel', 'Barnous en laine, parfait pour les occasions spéciales et les cérémonies.', 200, 's', 'barnous.png', 'vêtements '),
('Chachia Traditionnelle', 'Chachia traditionnelle en laine, confortable et élégante.', 30, 's', 'chachia.png', 'accessoires '),
('Dengri Traditionnel', 'Dengri traditionnel parfait pour l\'été.', 160, 's', 'dengri.png', 'vêtements '),
('Fouta Traditionnelle', 'Fouta légère, parfaite pour les bains et les plages.', 40, '', 'fouta.png', 'accessoires '),
('Jeba Traditionnelle', 'Jeba traditionnelle faite main, parfaite pour les occasions spéciales', 120, 's', 'jebba.png', 'vêtements '),
('Jebba Traditionnelle Pour Femme', 'Jebba élégante pour les femmes, idéale pour les cérémonies.', 200, 's', 'jebba2.png', 'vêtements '),
('Mdhala Traditionnelle', 'Mdhala traditionnelle, parfaite pour les journées ensoleillées.', 70, 's', 'mdhala.png', 'accessoires '),
('Safseri Traditionnel', 'Le sefsari de soie naturelle tunisien est un grand morceau de tissu qui sert à recouvrir les femmes.', 250, 's', 'safseri.png', 'accessoires ');

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE `reclamation` (
  `idrec` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `date_creation` date NOT NULL,
  `sujetrec` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `idrep` int(11) NOT NULL,
  `reponse` text NOT NULL,
  `idrec` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL,
  `reset_code` varchar(255) DEFAULT NULL,
  `reset_expiry` int(11) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`, `reset_code`, `reset_expiry`, `banned`) VALUES
(11, 'mihoubbbbb', 'mihoubbb@gmail.com', '1fdd7d6e3e53811ffc122b99d25512d0', 'user', '420201438_1736724413486432_3034627631924993484_n.jpg', 'b4212c31af908d7d55671a20e88439fe3a13ed659b8eee94b7e08a1cad3a79ed25f7e9434ca4167508abdf30bacb7f7960b5', 2024, 1),
(13, 'iheb', 'iheb@gmail.com', '61fca7d67f6e4120643b876a9bc50127', 'user', '420201438_1736724413486432_3034627631924993484_n.jpg', 'c87af952336d7e1f91816679ecda1c4d7febd90c83220854c5426edb50d23fcb27dfb7a527123f13b3bd7d6add522e0d4e64', 2024, 0),
(14, 'hiba', 'hiba@gmail.com', '05c30a524c57ef2c2d841ce7d8058c32', 'user', '453533406_1075006370993688_8532771373172277638_n.jpg', 'bb337d21b5c7fb2522da865fe12dbd93e1aac75ab829168eb980c031f7ec0bea898843e79ceb1c5898418f67ab121b81a898', 2024, 0),
(15, 'dhia', 'dhia@gmail.com', 'bd56248397f29f50fd3b998f0de6f928', 'user', '420201438_1736724413486432_3034627631924993484_n.jpg', NULL, NULL, 0),
(16, 'nour', 'nour@gmail.com', 'ccbc1770bb10486495d127a7d65c252b', 'user', '420201438_1736724413486432_3034627631924993484_n.jpg', NULL, NULL, 0),
(17, 'yaraa', 'yaraa@gmail.com', '29c69463124c1bb734ff32b361a19531', 'user', '420201438_1736724413486432_3034627631924993484_n.jpg', NULL, NULL, 0),
(19, 'mortadha', 'mortadha.zagh@gmail.com', '001f9944737a46f1f50f206eb9419102', 'user', '453533406_1075006370993688_8532771373172277638_n.jpg', 'b1a98afec5739e955fa9e851d1e847fd98cadf2120bc118028e90faef18b85cb3da110ce9bf75158d75db366fab19f836773', 2024, 1),
(20, 'hay', 'hay79245@gmail.com', '4982b37aa4ff1d1761d9567323d2cf38', 'user', '453533406_1075006370993688_8532771373172277638_n.jpg', '0de4f5b7e282400db96284f62612e0acef9143b0b8801cc82a9a6d57660a95c8bc170e9a9d7318a7c1cc6407989d11c36ac8', 2024, 0),
(21, 'ghailen', 'ghailen@gmail.com', 'b4f526d1059d8487e90c634d58fcf7ae', 'user', '453533406_1075006370993688_8532771373172277638_n.jpg', NULL, NULL, 0),
(22, 'mouayed', 'mouayed@gmail.com', '0d9225ca7bcb93786c5e8b95c433f397', 'user', '453533406_1075006370993688_8532771373172277638_n.jpg', NULL, NULL, 0),
(23, 'Dhia', 'dhia.elghak19@gmail.com', '26a778f38c5dfb5874bbb1d3225409ff', 'user', '462550768_1270863663927476_839552372016859237_n.jpg', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `views`
--

CREATE TABLE `views` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `view_date` date NOT NULL,
  `view_count` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `views`
--

INSERT INTO `views` (`id`, `user_id`, `view_date`, `view_count`) VALUES
(1, 15, '2024-12-10', 1),
(2, 13, '2024-12-10', 1),
(3, 19, '2024-12-10', 1),
(4, 13, '2024-12-11', 1),
(5, 21, '2024-12-11', 1),
(6, 19, '2024-12-11', 1),
(7, 21, '2024-12-15', 1),
(8, 22, '2024-12-15', 1),
(9, 23, '2024-12-17', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nom` (`nom`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nom_prod` (`nom_prod`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`nom`);

--
-- Index pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`idrec`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`idrep`),
  ADD KEY `idrec` (`idrec`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `idrec` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `idrep` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`nom_prod`) REFERENCES `produit` (`nom`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`idrec`) REFERENCES `reclamation` (`idrec`) ON DELETE CASCADE;

--
-- Contraintes pour la table `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `views_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
