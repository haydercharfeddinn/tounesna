-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 14 déc. 2024 à 10:39
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

-- table recl/reponse
CREATE TABLE `reclamation` (
    idrec INT AUTO_INCREMENT PRIMARY KEY,  -- Identifiant unique
    nom VARCHAR(100) NOT NULL,             -- Nom de l'utilisateur
    prenom VARCHAR(100) NOT NULL,          -- Prénom de l'utilisateur
    ville VARCHAR(100) NOT NULL,           -- Ville de résidence
    date_creation DATE NOT NULL,           -- Date de la réclamation
    sujetrec TEXT NOT NULL                 -- Sujet ou description
);

CREATE TABLE `reponse` (
    idrep INT AUTO_INCREMENT PRIMARY KEY,  -- Identifiant unique de la réponse
    reponse TEXT NOT NULL,                 -- Contenu de la réponse
    idrec INT NOT NULL,                    -- Clé étrangère vers la table reclamation
    FOREIGN KEY (idrec) REFERENCES reclamation(idrec) ON DELETE CASCADE
);

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
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`nom_prod`) REFERENCES `produit` (`nom`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
