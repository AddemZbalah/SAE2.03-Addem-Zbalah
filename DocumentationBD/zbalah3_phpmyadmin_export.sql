-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 18 avr. 2025 à 13:14
-- Version du serveur : 10.11.11-MariaDB-0+deb12u1
-- Version de PHP : 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zbalah3`
--

-- --------------------------------------------------------

--
-- Structure de la table `Category`
--

CREATE TABLE `Category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `Category`
--

INSERT INTO `Category` (`id`, `name`) VALUES
(1, 'Action'),
(2, 'Comédie'),
(3, 'Drame'),
(4, 'Science-fiction'),
(5, 'Animation'),
(6, 'Thriller'),
(7, 'Horreur'),
(8, 'Aventure'),
(9, 'Fantaisie'),
(10, 'Documentaire');

-- --------------------------------------------------------

--
-- Structure de la table `Favorites`
--

CREATE TABLE `Favorites` (
  `profile_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Favorites`
--

INSERT INTO `Favorites` (`profile_id`, `movie_id`) VALUES
(5, 52),
(5, 59),
(5, 60),
(5, 62);

-- --------------------------------------------------------

--
-- Structure de la table `Movie`
--

CREATE TABLE `Movie` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `trailer` varchar(255) DEFAULT NULL,
  `min_age` int(11) DEFAULT NULL,
  `recommandes` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `Movie`
--

INSERT INTO `Movie` (`id`, `name`, `year`, `length`, `description`, `director`, `id_category`, `image`, `trailer`, `min_age`, `recommandes`) VALUES
(7, 'Interstellar', 2014, 169, 'Un groupe d\'explorateurs voyage à travers un trou de ver pour sauver l\'humanité.', 'Christopher Nolan', 4, 'interstellar.jpg', 'https://www.youtube.com/embed/VaOijhK3CRU?si=76Ke4uw4LYjuLuQ6', 12, 0),
(12, 'La Liste de Schindler', 1993, 195, 'Un industriel allemand sauve des milliers de Juifs pendant l\'Holocauste.', 'Steven Spielberg', 3, 'schindler.webp', 'https://www.youtube.com/embed/ONWtyxzl-GE?si=xC3ASGGPy5Ib-aPn', 16, 0),
(17, 'Your Name', 2016, 107, 'Deux adolescents échangent leurs corps de manière mystérieuse.', 'Makoto Shinkai', 5, 'your_name.jpg', 'https://www.youtube.com/embed/AROOK45LXXg?si=aUQyGk2VMCb_ToUL', 10, 0),
(27, 'Le Bon, la Brute et le Truand', 1966, 161, 'Trois hommes se lancent à la recherche d\'un trésor caché.', 'Sergio Leone', 8, 'bon_brute_truand.jpg', 'https://www.youtube.com/embed/WA1hCZFOPqs?si=TwNZAoM4oj4KpGja', 12, 0),
(51, 'John Wick 4', 2023, 169, 'John Wick découvre un moyen de vaincre l\'organisation criminelle connue sous le nom de la Grande Table.', 'Chad Stahelski', 1, 'johnwick4.jpg', 'https://www.youtube.com/embed/qEVUtrk8_B4', 16, 0),
(52, 'Mission Impossible: Dead Reckoning', 2023, 163, 'Ethan Hunt et son équipe s\'embarquent dans leur mission la plus périlleuse à ce jour.', 'Christopher McQuarrie', 1, 'mi7.jpg', 'https://www.youtube.com/embed/2m1drlOZSDw', 12, 0),
(53, 'Dune: Part Two', 2024, 166, 'Paul Atreides s\'unit aux Fremen pour venger sa famille et reconquérir Arrakis.', 'Denis Villeneuve', 2, 'dune2.jpg', 'https://www.youtube.com/embed/P2QwbBxbucU', 12, 0),
(54, 'Blade Runner 2049', 2017, 163, 'Un blade runner découvre un secret enfoui qui le lance dans une quête pour retrouver Rick Deckard.', 'Denis Villeneuve', 2, 'bladerunner2049.jpg', 'https://www.youtube.com/embed/gCcx85zbxz4', 12, 0),
(55, 'Spider-Man: Across the Spider-Verse', 2023, 140, 'Miles Morales voyage à travers le multivers et rencontre d\'autres versions de Spider-Man.', 'Joaquim Dos Santos', 3, 'spiderverse2.jpg', 'https://www.youtube.com/embed/cqGjhVJWtEg', 8, 0),
(56, 'Le Garçon et le Héron', 2023, 124, 'Un jeune garçon découvre un monde magique guidé par un héron mystérieux.', 'Hayao Miyazaki', 3, 'miyazaki.jpg', 'https://www.youtube.com/embed/t5khm-VjEu4', 8, 0),
(57, 'Oppenheimer', 2023, 180, 'L\'histoire du père de la bombe atomique, J. Robert Oppenheimer.', 'Christopher Nolan', 4, 'oppenheimer.jpg', 'https://www.youtube.com/embed/uYPbbksJxIg', 12, 0),
(58, 'The Whale', 2022, 117, 'Un professeur d\'anglais reclus tente de renouer avec sa fille adolescente.', 'Darren Aronofsky', 4, 'whale.jpg', 'https://www.youtube.com/embed/D30r0CwtIKc', 12, 0),
(59, 'Barbie', 2023, 114, 'Barbie, qui vit à Barbieland, est expulsée du pays pour être loin d\'être une poupée parfaite.', 'Greta Gerwig', 5, 'barbie.jpg', 'https://www.youtube.com/embed/pBk4NYhWNMM', 6, 0),
(60, 'Asteroid City', 2023, 105, 'Une convention de jeunes astronomes est interrompue par des événements qui changent le monde.', 'Wes Anderson', 5, 'asteroidcity.jpg', 'https://www.youtube.com/embed/pe9pdRqt9_4', 10, 0),
(61, 'Talk to Me', 2023, 95, 'Des adolescents deviennent accros à un nouveau type de frisson impliquant des esprits possédés.', 'Danny Philippou', 6, 'talktome.jpg', 'https://www.youtube.com/embed/aLAKJu9aJys', 16, 0),
(62, 'M3GAN', 2023, 102, 'Une créatrice de jouets développe une poupée AI qui devient dangereusement surprotectrice.', 'Gerard Johnstone', 6, 'm3gan.jpg', 'https://www.youtube.com/embed/BRb4U99OU80', 12, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Profile`
--

CREATE TABLE `Profile` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `min_age` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Profile`
--

INSERT INTO `Profile` (`id`, `name`, `avatar`, `min_age`) VALUES
(1, 'addemsan', 'goku.jpg', 3),
(4, 'addemleneuil', 'goku.jpg', 5),
(5, 'arthurtetedeneuil', 'barbie.jpg', 55),
(6, 'lev', 'lev.jpg', 7);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Favorites`
--
ALTER TABLE `Favorites`
  ADD PRIMARY KEY (`profile_id`,`movie_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Index pour la table `Movie`
--
ALTER TABLE `Movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Index pour la table `Profile`
--
ALTER TABLE `Profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Category`
--
ALTER TABLE `Category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Movie`
--
ALTER TABLE `Movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `Profile`
--
ALTER TABLE `Profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Favorites`
--
ALTER TABLE `Favorites`
  ADD CONSTRAINT `Favorites_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `Profile` (`id`),
  ADD CONSTRAINT `Favorites_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `Movie` (`id`);

--
-- Contraintes pour la table `Movie`
--
ALTER TABLE `Movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `Category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
