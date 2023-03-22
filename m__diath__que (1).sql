-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 22 mars 2023 à 13:42
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `médiathèque`
--

-- --------------------------------------------------------

--
-- Structure de la table `adhérents`
--

CREATE TABLE `adhérents` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `cin` varchar(10) NOT NULL,
  `date_naissance` date NOT NULL,
  `type` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `date_d_ouverture` datetime DEFAULT current_timestamp(),
  `profile_pic` varchar(255) DEFAULT 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `adhérents`
--

INSERT INTO `adhérents` (`id`, `name`, `adresse`, `email`, `phone_number`, `cin`, `date_naissance`, `type`, `last_name`, `password`, `date_d_ouverture`, `profile_pic`) VALUES
(6, 'yassine', 'Florida, USA', 'mond@gmail.com', '0605466397', 'k457557', '2023-03-10', 'Employé', 'moundelssi', 'TangerTanger2022#', '2023-03-10 04:29:48', 'download-round-morocco-flag-icon-png-11644872267qtb77vqxpi.png'),
(7, 'yassine', 'Florida, USA', 'moundelssi.yassine@gmail.com', '0605466397', 'k457557', '2023-03-21', 'Employé', 'moundelssi', 'TangerTanger2022#', '2023-03-21 23:05:55', 'images.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `ouvrage`
--

CREATE TABLE `ouvrage` (
  `id_ouvrage` int(11) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `auteur` varchar(255) DEFAULT NULL,
  `image_couverture` varchar(255) DEFAULT NULL,
  `etat` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `date_edition` date DEFAULT NULL,
  `date_achat` date DEFAULT NULL,
  `nombre_pages` int(11) DEFAULT NULL,
  `description` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ouvrage`
--

INSERT INTO `ouvrage` (`id_ouvrage`, `titre`, `auteur`, `image_couverture`, `etat`, `type`, `date_edition`, `date_achat`, `nombre_pages`, `description`) VALUES
(1, 'Le Petit Prince', 'Antoine de Saint-Exupéry', 'https://www.tirryaq.com/wp-content/uploads/2020/12/41jhYyjRAJL._SX346_BO1204203200_.jpg', 'Bon état', 'Roman', '1943-04-06', '2022-01-01', 128, 'Lorem ipsum is probably the most popular dummy text.'),
(2, 'Pride and Prejudice', 'Jane Austen', 'https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1457789308l/157996._SY475_.jpg', 'Acceptable', 'Fiction', '1813-01-28', '2023-03-09', 432, 'Lorem ipsum is probably the most popular dummy text.'),
(3, 'To Kill a Mockingbird', 'Harper Lee', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyL8x45edGsDKCjvzzC7MFMv_aWtno0pf9oA&usqp=CAU', 'Acceptable', 'Fiction', '1960-07-11', '2022-12-25', 281, 'Lorem ipsum is probably the most popular dummy text.'),
(4, 'The Catcher in the Rye', 'J.D. Salinger', 'https://ik.imagekit.io/panmac/tr:f-auto,di-placeholder_portrait_aMjPtD9YZ.jpg,w-171/edition/9781529063370.jpg', 'Acceptable', 'Fiction', '1951-07-16', '2023-02-28', 277, 'Lorem ipsum is probably the most popular dummy text.'),
(5, 'The Hobbit', 'J.R.R. Tolkien', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRiNFQxhpTet49-RBXuyKHfn2s64efTRS_gZaCBbUjEec7B5U18wrx-ddPFi0XQ-dSqPmU&usqp=CAU', 'Acceptable', 'Fantasy', '1937-09-21', '2022-11-01', 310, 'Lorem ipsum is probably the most popular dummy text.'),
(6, 'The Lord of the Rings', 'J.R.R. Tolkien', 'https://m.media-amazon.com/images/I/41AM6B4kVhL._SX436_BO1,204,203,200_.jpg', 'Acceptable', 'Fantasy', '1954-07-29', '2022-11-01', 1178, 'Lorem ipsum is probably the most popular dummy text.'),
(7, 'The Hitchhiker\'s ', 'Douglas Adams', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQFFoZoErs4e0WooEcVi_dpNmomXj-rwlC7NsvFzXuk2rqPAKkFaLkBt5Nzq0Gx7dyvxhM&usqp=CAU', 'Acceptable', 'Science Fiction', '1979-10-12', '2023-01-15', 193, 'Lorem ipsum is probably the most popular dummy text.');

-- --------------------------------------------------------

--
-- Structure de la table `réservations`
--

CREATE TABLE `réservations` (
  `id_réservation` int(11) NOT NULL,
  `id_adhérent` int(6) UNSIGNED NOT NULL,
  `id_ouvrage` int(11) NOT NULL,
  `date_emprunt` date NOT NULL,
  `date_retour` date NOT NULL,
  `reservation_code` varchar(11) NOT NULL,
  `reservation_valid` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `réservations`
--

INSERT INTO `réservations` (`id_réservation`, `id_adhérent`, `id_ouvrage`, `date_emprunt`, `date_retour`, `reservation_code`, `reservation_valid`) VALUES
(3, 6, 3, '2023-03-22', '0000-00-00', 'a0iAIEWxiw', 0),
(4, 6, 3, '2023-03-22', '0000-00-00', 't9EBfMKoy0', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adhérents`
--
ALTER TABLE `adhérents`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  ADD PRIMARY KEY (`id_ouvrage`);

--
-- Index pour la table `réservations`
--
ALTER TABLE `réservations`
  ADD PRIMARY KEY (`id_réservation`),
  ADD KEY `fk_adhérents` (`id_adhérent`),
  ADD KEY `fk_ouvrage` (`id_ouvrage`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adhérents`
--
ALTER TABLE `adhérents`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `ouvrage`
--
ALTER TABLE `ouvrage`
  MODIFY `id_ouvrage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `réservations`
--
ALTER TABLE `réservations`
  MODIFY `id_réservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `réservations`
--
ALTER TABLE `réservations`
  ADD CONSTRAINT `fk_adhérents` FOREIGN KEY (`id_adhérent`) REFERENCES `adhérents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ouvrage` FOREIGN KEY (`id_ouvrage`) REFERENCES `ouvrage` (`id_ouvrage`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
