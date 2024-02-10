-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 10 fév. 2024 à 02:00
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rajashoop_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(6, 'jaliladmin', '0000');

-- --------------------------------------------------------

--
-- Structure de la table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(3, 6, 'Jalil EL Mehdi', 'jalilmehdi300@gmail.com', '112', 'J&#39;ai Une Probleme &#34;Retard de Livraison&#34;');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` char(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`, `description`) VALUES
(6, 'Maillot Pré-Match', 'Entrainement', 420, 'p33.png', 'Maillot Pré-Match Raja Club Athletic Umbro - Édition Florale'),
(7, 'Maiillot Pré-Match', 'Entrainement', 420, 'mailot1.png', 'Maillot Pré-Match Raja Club Athletic Umbro - Bleu Dynamique'),
(8, 'Maillot Domicile Green', 'Tenues de Match', 490, 'mailo2.png', 'Maillot Domicile Green Raja Club Athletic UMBRO 23/24'),
(9, 'Maillot Extérieur Blanc', 'Tenues de Match', 490, 'maillot-blanc.png', 'Maillot Extérieur White Raja Club Athletic UMBRO 23/24'),
(10, 'Maillot Extérieur Noir', 'Tenues de Match', 490, 'maillot-noir.png', 'Maillot Extérieur Black Raja Club Athletic UMBRO 23/24'),
(11, 'Doudoune Umbro', 'Mode', 590, 'v6.png', 'Doudoune Umbro Édition Spéciale Raja Club Athletic'),
(12, 'Sweat College Noir', 'Mode', 490, 'v1.png', 'Sweat College Noir Raja Club Athletic 1949 - Édition Designer'),
(13, 'Sweat College Blanc', 'Mode', 490, 'v2.png', 'Sweat College Blanc Raja Club Athletic 1949 - Édition Designer'),
(14, 'T-shirt Tricolore', 'Mode', 149, 'mailot4.png', 'T-shirt Tricolore Raja Club Athletic - Édition Noir, Blanc et Vert'),
(15, 'Lunettes', 'Cadeaux et Accessoires', 299, 'n3.png', 'Lunettes &#34;MajesticMeadow&#34; Raja Club - Rectangle Unisexe'),
(16, 'Lunettes &#34;EagleGaze&#34; ', 'Cadeaux et Accessoires', 319, 'mailot5.png', 'Lunettes &#34;EagleGaze&#34; Raja Club - Carrées Unisexe'),
(17, 'Lunettes &#34;VerdeRaptor&#34; ', 'Cadeaux et Accessoires', 319, 'lun-0003-calque-3.png', 'Lunettes &#34;VerdeRaptor&#34; Raja Club - Carrées Unisexe'),
(18, 'T-shirt 1949', 'Mode', 129, 't3.png', 'T-shirt 1949 - Édition Blanc Classique'),
(19, 'T-shirt Noir ', 'Mode', 129, 'tshirt-noir.png', 'T-shirt Black Raja Club Athletic - Édition Noir Intemporel'),
(22, 'Survêtement-Noir', 'Mode', 449, 's4.png', 'Survêtement-Black Raja Club Athletic 1949 black-Vert, Blanc et Gris'),
(23, 'Survêtement-Vert', 'Mode', 449, 's2.png', 'Survêtement-Vert Raja Club Athletic 1949 black-Vert, Blanc et Gris'),
(24, 'Survêtement-Blanc', 'Mode', 449, 's3.png', 'Survêtement-BlancRaja Club Athletic 1949 black-Vert, Blanc et Gris'),
(25, 'Bob-Blanc', 'Cadeaux et Accessoires', 99, 'ch2.png', 'Bob Édition Spéciale Raja Club Athletic - Blanc Élégant'),
(26, 'Bob-Noir', 'Cadeaux et Accessoires', 99, 'ch1.png', 'Bob Édition Spéciale Raja Club Athletic - Noir Élégant'),
(27, 'Bob-Vert', 'Cadeaux et Accessoires', 99, 'ch3.png', 'Bob Édition Spéciale Raja Club Athletic - Vert Élégant'),
(28, 'Casquette Noire ', 'Cadeaux et Accessoires', 99, 'r-0007-calque-1.png', 'Casquette Noire Officielle du Raja Club Athletic'),
(29, 'Casquette Vert', 'Cadeaux et Accessoires', 99, 'r-0005-calque-3.png', 'Casquette Verte Officielle du Raja Club Athletic 1949'),
(30, 'Casquette Blanc', 'Cadeaux et Accessoires', 99, 'MAILOT6.png', 'Casquette Blanc Officielle du Raja Club Athletic 1949'),
(31, 'Sac de Voyage', 'Cadeaux et Accessoires', 1490, 'cartable1.png', 'Sac de Voyage Keepall en Cuir'),
(32, 'Trousse en Cuir', 'Cadeaux et Accessoires', 690, 'cartable2.png', 'Trousse en Cuir - Style Élégant pour vos Essentiels'),
(33, 'Sac à Dos', 'Cadeaux et Accessoires', 1490, 'cartable3.png', 'Sac à Dos en Cuir'),
(34, 'Mallette', 'Cadeaux et Accessoires', 1290, 'cartable4.png', 'Mallette en Cuir pour Ordinateur Portable'),
(35, 'Cartable', 'Cadeaux et Accessoires', 990, 'cartable5.png', 'Cartable en Cuir'),
(36, 'Sac Banane', 'Cadeaux et Accessoires', 640, 'cartable7.png', ' Style et Praticité Redéfinis'),
(37, 'T-shirt 1949 V', 'Mode', 129, 'pod-0001-calque-8-1.png', 'T-shirt 1949 - Édition Vert Élégant'),
(38, 'Lunettes -EagleSight', 'Cadeaux et Accessoires', 289, 'lun-0004-calque-2.png', 'Vision Hexagonale Unisexe'),
(39, 'Hoodie Unisexe Vert', 'Mode', 2969, 'v5.png', 'Hoodie Unisexe Vert'),
(40, 'Hoodie Unisexe Noir', 'Mode', 269, 'v4.png', 'Hoodie Unisexe Noir');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`) VALUES
(6, 'Jalil EL Mehdi', 'jalilmehdi300@gmail.com', '0699692523', 'mehdi123');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
