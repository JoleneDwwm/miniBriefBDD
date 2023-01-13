-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 13 jan. 2023 à 14:54
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `brief5`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `numero` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`numero`, `description`) VALUES
(0, 'Front End'),
(1, 'Back End'),
(2, 'Outils');

-- --------------------------------------------------------

--
-- Structure de la table `langages`
--

CREATE TABLE `langages` (
  `html` tinyint(1) DEFAULT NULL,
  `css` tinyint(1) DEFAULT NULL,
  `javaScript` tinyint(1) DEFAULT NULL,
  `php` tinyint(1) DEFAULT NULL,
  `sql` tinyint(1) DEFAULT NULL,
  `python` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `liens`
--

CREATE TABLE `liens` (
  `numero` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `categoriesId` int(11) DEFAULT NULL,
  `langagesId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `liens`
--

INSERT INTO `liens` (`numero`, `nom`, `url`, `description`, `categoriesId`, `langagesId`) VALUES
(2, 'Scratch', 'https://scratch.mit.edu/', 'Programme développé par le MIT qui permet une approche ludique de la logique du codage', 2, 0),
(3, 'Cartes Scratch', 'https://resources.scratch.mit.edu/www/cards/fr/scratch-cards-all.pdf', 'manuel d\'utilisation de Scratch', 2, 0),
(4, 'Github', 'https://github.com/', 'repositoire de dossiers, indispensable pour le travail en équipe', 2, 0),
(5, 'LearnGitBranching', 'https://learngitbranching.js.org/?locale=fr_FR', 'Une application servant à apprendre l\'usage des branches git', 2, 0),
(6, 'Commandes Git', 'https://www.hostinger.fr/tutoriels/commandes-git', 'liste de commandes git', 2, 0),
(7, 'Miro', 'https://miro.com/fr/', 'plateforme de collaboration visuelle en ligne pour le travail en équipe', 0, 0),
(8, 'Figma', 'https://www.figma.com/', 'outil en ligne pour designer des websites', 0, 0),
(9, 'Tutoriel Figma Grafikart', 'https://youtu.be/e68PKFYWfoQ', 'vidéo de tutoriel figma', 0, 0),
(10, 'Definition et exemple Wireframe', 'https://www.usabilis.com/definition-wireframe/', 'définition et exemples de Wireframe', 0, 0),
(11, 'Optimiser l\'ergonomie d\'un site web', 'https://www.openstudio.fr/2022/10/27/comment-optimiser-lergonomie-de-son-site-web/', 'Comment optimiser l\'ergonomie d\'un site web', 2, 0),
(12, 'tutoriel HTML', 'https://developer.mozilla.org/fr/docs/Learn/Getting_started_with_the_web/HTML_basics', 'tutoriel mozilla pour apprendre à utiliser HTML', 0, 0),
(13, 'Références HTML', 'https://developer.mozilla.org/fr/docs/Web/HTML/Element', 'Référence des balises et des éléments HTML', 0, 0),
(14, 'tutoriel HTML', 'https://openclassrooms.com/fr/courses/1603881-apprenez-a-creer-votre-site-web-avec-html5-et-css3', 'tutoriel openclassrooms pour apprendre à utiliser HTML', 0, 0),
(15, 'tutoriel HTML', 'https://www.youtube.com/watch?v=qsbkZ7gIKnc', 'tutoriel youtube pour apprendre à utiliser HTML', 0, 0),
(16, 'créer un site vitrine', 'https://www.youtube.com/watch?v=Cwm9qX9onq4', 'tutoriel pour créer un site vitrine en HTML et CSS', 0, 0),
(17, 'tutoriel création de site', 'https://openclassrooms.com/fr/courses/1603881-apprenez-a-creer-votre-site-web-avec-html5-et-css3', 'tutoriel openclassrooms pour apprendre à créer un site avec HTML et CSS', 2, 0),
(18, 'méthodologie BEM', 'https://alticreation.com/bem-pour-le-css/', 'méthodologie BEM pour le CSS', 0, 0),
(19, 'guide Flexbox', 'https://css-tricks.com/snippets/css/a-guide-to-flexbox/', 'un guide sur l\'utilisation de Flexbox en CSS', 0, 0),
(20, 'tutoriel Flexbox', 'https://youtu.be/UcC76tcvLgA', 'tutoriel youtube pour apprendre l\'utilisation de Flexbox', 0, 0),
(21, 'Froggy Flexbox', 'https://flexboxfroggy.com/#fr', 'jeu ludique pour s\'entraîner à l\'utilisation de Flexbox', 0, 0),
(22, 'tutoriel JavaScript', 'https://openclassrooms.com/fr/courses/6175841-apprenez-a-programmer-avec-javascript', 'tutoriel openclassrooms pour apprendre à utiliser JavaScript', 0, 0),
(23, 'tableaux JavaScript', 'https://www.youtube.com/watch?v=kUXNmv4ZcWA', 'tutoriel sur l\'utilisation des tableaux en JavaScript', 0, 0),
(24, 'Algobox', 'https://www.xm1math.net/algobox/doc.html', 'outil pour apprendre et s\'exercer à la logique algorithmique', 2, 0),
(25, 'tutoriel sur les algorithmes', 'https://openclassrooms.com/fr/courses/7527306-decouvrez-le-fonctionnement-des-algorithmes?archived-source=4366701', 'tutoriel pour apprendre à utiliser les algorithmes', 2, 0),
(26, 'Cours pixees', 'https://pixees.fr/classcode/formations/module1/', 'cours sur la programmation créative', 2, 0),
(27, 'Cours sur les boucles', 'https://studylibfr.com/doc/179347/cours-sur-les-boucles-ou-instructions-r%C3%A9p%C3%A9titives#', 'cours sur les boucles et la programmation créative', 2, 0),
(28, 'Cours constantes et variables', 'https://www.youtube.com/watch?v=cEK4cPTP5qE&ab_channel=HassanELBAHI', 'cours youtube sur les constantes et les variables', 2, 0),
(29, 'Documentation PHP', 'https://www.php.net/manual/fr/', 'Documentation officielle PHP', 1, 0),
(30, 'Cours SQL', 'https://openclassrooms.com/fr/courses/1959476-administrez-vos-bases-de-donnees-avec-mysql', 'cours sur l\'administration des données avec SQL', 1, 0),
(31, 'Cours SQL', 'https://openclassrooms.com/fr/courses/6971126-implementez-vos-bases-de-donnees-relationnelles-avec-sql', 'cours sur l\'implémentation d\'une base de données SQL', 1, 0),
(32, 'Cours PHP et SQL', 'https://openclassrooms.com/fr/courses/918836-concevez-votre-site-web-avec-php-et-mysql', 'cours openclassrooms sur la conception d\'un site web avec php et mysql', 1, 0),
(33, 'Cours SQL', 'https://sql.sh/', 'cours sur le langage sql', 1, 0),
(34, 'Aide-mémoire SQL', 'https://sql.sh/919-aide-memoire-mysql', 'aide-mémoire SQL', 1, 0),
(35, 'Responsive Web Design', 'https://www.usabilis.com/responsive-web-design-site-web-adaptatif/', 'Cours et astuces sur le responsive web design', 2, 0),
(36, 'Jeu Codingame', 'https://www.codingame.com/start', 'jeu en ligne pour s\'entraîner à coder', 2, 0),
(37, 'Cours Merise', 'https://sqlpro.developpez.com/cours/modelisation/merise/', 'cours sur le système Merise', 2, 0),
(38, 'Banque de liens Clickup', 'https://doc.clickup.com/37460291/p/13q6a3-464/150-tools-websitesfor-developers/13q6a3-464/150-tools-websites-for-developers', 'banque de liens pour s\'entraîner à coder', 2, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`numero`);

--
-- Index pour la table `liens`
--
ALTER TABLE `liens`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `categoriesId` (`categoriesId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `liens`
--
ALTER TABLE `liens`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `liens`
--
ALTER TABLE `liens`
  ADD CONSTRAINT `liens_ibfk_1` FOREIGN KEY (`categoriesId`) REFERENCES `categories` (`numero`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
