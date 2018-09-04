-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mar. 04 sep. 2018 à 06:57
-- Version du serveur :  5.6.38
-- Version de PHP :  7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `report` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(255) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `comment`, `comment_date`, `report`, `status`) VALUES
(1, 1, 'Pierrot', 'comm 1', '2018-07-02 00:00:00', 0, 'disapproved'),
(3, 1, 'Chris', 'Très bel article', '2018-07-09 08:12:40', 0, 'disapproved'),
(4, 1, 'Jean Christophe', 'Bravo ! c\'est beau et chouette\r\n', '2018-07-09 19:13:11', 0, 'disapproved'),
(5, 1, 'alex', 'super\r\n zd5', '2018-07-11 18:34:15', 1, 'approved'),
(6, 1, 'rené', 'bonjour encore', '2018-08-07 11:01:21', 0, 'approved'),
(7, 1, 'rené', 'salut', '2018-08-07 11:01:46', 0, 'approved'),
(8, 1, 'andré', 'salut', '2018-08-07 11:02:52', 0, 'approved'),
(9, 1, 'jean yves', 'super bien\r\n', '2018-08-07 11:03:13', 0, 'approved'),
(10, 1, 'charly', 'byuenor', '2018-08-07 11:32:08', 1, 'approved'),
(12, 1, 'théo', 'pas mauvaiseeir\r\n', '2018-08-07 13:33:45', 1, 'approved'),
(13, 1, 'hugues', 'jolizzaa', '2018-08-10 08:27:06', 1, 'disapproved'),
(15, 5, 'André', 'Mais quel bel article !!', '2018-08-24 13:39:30', 1, 'pending'),
(16, 5, 'Alex', 'saluttt', '2018-08-24 13:42:32', 1, 'pending'),
(17, 5, 'jc', 'bravo', '2018-08-28 08:18:41', 0, 'approved'),
(18, 5, 'jm', 'excellent', '2018-08-28 08:22:14', 0, 'pending'),
(19, 6, 'jr', 'gg', '2018-08-28 08:23:13', 1, 'pending'),
(20, 6, 'js', 'yy', '2018-08-28 08:23:59', 0, 'pending'),
(21, 1, 'CArlos', 'yyy', '2018-08-28 18:41:25', 0, 'approved'),
(22, 8, 'Tez', 'pas', '2018-08-28 18:46:31', 0, 'approved'),
(23, 9, 'alex', 'yy', '2018-08-29 13:10:16', 0, 'pending'),
(24, 1, 'jean', 'p', '2018-09-03 07:49:32', 1, 'approved');

-- --------------------------------------------------------

--
-- Structure de la table `password`
--

CREATE TABLE `password` (
  `id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `password`
--

INSERT INTO `password` (`id`, `content`) VALUES
(1, '$2y$10$0Z8Fe8Ug0lELJ.LlRBGJleiHqUO1CpfG7EmKH1NtIIBy5.0kgNqv.');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reportedComments` int(255) NOT NULL,
  `commentsWaitingForModeration` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `creation_date`, `reportedComments`, `commentsWaitingForModeration`) VALUES
(1, 'Article id 1', '<div id=\"lipsum\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vel fermentum nibh. Phasellus quis neque efficitur, dapibus metus in, elementum mi. Suspendisse quis mattis metus, non pretium nisi. Nullam at odio sed dui tempor imperdiet id ac enim. Fusce pharetra maximus tortor, sit amet malesuada diam tristique venenatis. In rutrum vitae elit eget sagittis. Vivamus feugiat tempus augue, non blandit mauris pellentesque non. Sed massa justo, ullamcorper ac dolor nec, maximus viverra tortor. Cras sed orci vehicula, facilisis tellus vel, blandit tellus. Donec tristique sed erat sit amet scelerisque. Sed vulputate nisl a massa congue, nec tincidunt est cursus. Integer sit amet justo tortor. In semper neque nec bibendum interdum. Pellentesque pulvinar tempus quam sed mollis. Nam luctus elementum velit nec commodo. Aliquam non ligula condimentum, rutrum dolor cursus, fringilla purus.</p>\r\n<p>Mauris ut tincidunt orci, quis pulvinar nulla. Cras viverra ante libero, in luctus risus laoreet vitae. Quisque mattis vel est at vestibulum. Vestibulum tincidunt, orci et blandit vestibulum, tortor nisl congue lacus, id faucibus dolor dolor eu lacus. Ut libero felis, faucibus sit amet malesuada ac, pellentesque a erat. Etiam sit amet lacus in leo vulputate viverra. Nam laoreet sapien in ante fermentum, nec laoreet felis pulvinar. In in dui eget eros condimentum sagittis. Donec in sapien et arcu vulputate facilisis eget vel erat. Donec eu risus finibus, interdum orci id, cursus metus. Morbi vel lacus sagittis, mollis tellus nec, feugiat leo. Praesent ultrices eget est quis feugiat. In nulla metus, bibendum nec pretium auctor, eleifend sit amet nulla. Integer maximus enim a mauris posuere, sed ultrices risus malesuada.</p>\r\n<p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Nulla suscipit tortor blandit augue vulputate, vitae laoreet magna tristique. Aliquam a risus feugiat, lacinia enim in, sodales sem. Duis mattis libero et massa aliquam suscipit. Nullam placerat, ante vitae pharetra consequat, metus felis ullamcorper mauris, id faucibus tellus urna at felis. In convallis rhoncus massa, nec fermentum mauris viverra in. Ut egestas ante non cursus sodales. Morbi sed elit ut nisl interdum tempor. Praesent ut tincidunt nisi, eu pellentesque diam. Vestibulum a rhoncus elit. Praesent sagittis aliquet blandit. Mauris rutrum, arcu venenatis placerat consequat, arcu ante ultrices purus, pulvinar mollis velit lorem et dui. Etiam nec leo velit. Nam ac tempor metus, sit amet tincidunt sapien. Fusce ex dolor, gravida iaculis ante vel, venenatis efficitur sem.</p>\r\n<p>Fusce eget dui et tellus tempus scelerisque ut congue justo. Vestibulum luctus ante nec nibh dictum, ac cursus urna posuere. In non malesuada odio, quis semper ante. Morbi facilisis odio ac luctus efficitur. Sed eget hendrerit ex. Vestibulum ultricies sem in ligula auctor, vel lobortis odio fermentum. Suspendisse potenti. Sed efficitur elit vel libero tincidunt viverra.</p>\r\n<p>Nunc risus erat, interdum at ligula rutrum, facilisis vestibulum metus. Pellentesque venenatis est dolor, sed vehicula elit ullamcorper sed. Integer lacinia a risus nec tincidunt. Integer a ipsum in elit efficitur ultricies. Sed pulvinar tincidunt varius. Integer vestibulum sem sed purus posuere dictum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>\r\n</div>', '2018-08-28 08:13:52', 0, 0),
(5, 'Article sur le nouveau chapitre', 'Chapitre sur la rando', '2018-08-24 13:35:55', 0, 0),
(6, 'la montagne', 'corps', '2018-08-24 13:43:52', 0, 0),
(8, 'nouvel article', 'article tout ça', '2018-08-28 08:13:24', 0, 0),
(9, 'nouvel article', '<ul>\r\n<li><span style=\"background-color: #3366ff;\">Magnifique nouvel article</span></li>\r\n</ul>', '2018-08-29 08:12:16', 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Index pour la table `password`
--
ALTER TABLE `password`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `password`
--
ALTER TABLE `password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_post_comment` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
