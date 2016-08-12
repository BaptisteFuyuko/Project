-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 08 Août 2016 à 12:29
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test_technique`
--

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

DROP TABLE IF EXISTS `candidat`;
CREATE TABLE IF NOT EXISTS `candidat` (
  `id_candidat` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(25) DEFAULT NULL,
  `Prenom` varchar(25) DEFAULT NULL,
  `E_Mail` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_candidat`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `candidat`
--

INSERT INTO `candidat` (`id_candidat`, `Nom`, `Prenom`, `E_Mail`) VALUES
(1, 'Duhamel', 'Baptiste', 'baptiste.duhamel@hotmail.com'),
(2, 'Butin', 'Pierrick', 'Pierrick.butin@hotmail.fr'),
(3, 'Salengro', 'Marc-Antoine', 'Msalengro@gmail.fr'),
(10, 'Nom', 'Prenom', 'prenom.nom@mail.fr'),
(11, 'Richard', 'Edouard', 'r.edouard@gmail.com'),
(12, 'Marion', 'Lefevre', 'm.lefevre@sog.fr'),
(13, 'Lefevre', 'Marion', 'marion.lefevre@sogeti.fr');

-- --------------------------------------------------------

--
-- Structure de la table `passer`
--

DROP TABLE IF EXISTS `passer`;
CREATE TABLE IF NOT EXISTS `passer` (
  `Date_exe` date DEFAULT NULL,
  `id_candidat` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  PRIMARY KEY (`id_candidat`,`id_test`),
  KEY `FK_Passer_id_test` (`id_test`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `passer`
--

INSERT INTO `passer` (`Date_exe`, `id_candidat`, `id_test`) VALUES
('2016-07-28', 1, 1),
('2016-06-06', 1, 2),
('2016-07-21', 1, 3),
('2016-08-05', 1, 8),
('2016-06-22', 2, 1),
('2016-06-12', 2, 2),
('2016-06-29', 3, 2),
('2016-08-05', 10, 1),
('2016-08-05', 10, 4),
('2016-08-05', 10, 6),
('2016-08-05', 10, 10),
('2016-07-28', 11, 1),
('2016-07-28', 12, 1),
('2016-08-02', 13, 1);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `Intitule` text NOT NULL,
  `id_test` int(11) NOT NULL,
  `Multiple` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_question`),
  KEY `FK_Question_id_test` (`id_test`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`id_question`, `Intitule`, `id_test`, `Multiple`) VALUES
(1, 'Qu''est-ce qu''une énumération ?\r\n', 1, 0),
(2, 'Une variable déclarée à l''intérieur d''une méthode est appelée :\r\n', 1, 0),
(3, 'Une interface peut-elle être instanciée directement ?', 1, 0),
(4, 'Quelle est la caractéristique d''une variable locale ?', 1, 0),
(5, 'Est-il possible de stocker plusieurs types de données au sein d''un System.Array ?', 1, 0),
(6, 'Définir : Deux méthodes avec le même nom et des paramètres différents :', 1, 0),
(7, 'Définir : Deux méthodes avec le même nom, les mêmes paramètres dans 2 classes qui héritent l''une de l''autre se comportant diffèremment :', 1, 0),
(8, 'Le C# ne supporte pas :', 1, 0),
(9, 'Qu''est ce qui est VRAI a propos des Interfaces et des Méthodes abstraites ?', 1, 0),
(10, 'Lequel de ces espaces de nom (namespace) est utilisé en C# .NET ?', 1, 0),
(11, 'Quel est la résultante du code suivant : public class B : A { }', 1, 0),
(12, 'Quelle type de classe ne peut être hérité ?', 1, 0),
(13, 'Quels actions ne sont PAS effectuées par le ramasse-miettes (Garbage Collector) ?', 1, 1),
(14, 'Quels sont les principaux constituants du Framework .NET ?', 1, 1),
(15, 'Dans un DataReader, que peut-on utiliser avant la methode Read() ?', 1, 0),
(16, 'Quel est le comportement de la méthode Dispose() avec les objets comprenant une connexion ?', 1, 0),
(17, 'Comment trier les éléments d''un tableau dans un ordre décroissant ?', 1, 0),
(18, 'Quelle est la difference entre l''appel Convert.ToString(str) et str.ToString() en considerant str comme une variable de type String ?', 1, 0),
(19, 'A quel type le mot clé "int" fait-il référence en .NET ?', 1, 0),
(20, 'Durant une mise a jour (Update), quelle méthode de SqlCommand est la plus optimale ?', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `repondre`
--

DROP TABLE IF EXISTS `repondre`;
CREATE TABLE IF NOT EXISTS `repondre` (
  `id_reponse` int(11) NOT NULL,
  `id_candidat` int(11) NOT NULL,
  PRIMARY KEY (`id_reponse`,`id_candidat`),
  KEY `FK_Repondre_id_candidat` (`id_candidat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `repondre`
--

INSERT INTO `repondre` (`id_reponse`, `id_candidat`) VALUES
(1, 1),
(6, 1),
(13, 1),
(20, 1),
(21, 1),
(26, 1),
(31, 1),
(36, 1),
(37, 1),
(42, 1),
(45, 1),
(47, 1),
(50, 1),
(52, 1),
(55, 1),
(61, 1),
(62, 1),
(67, 1),
(72, 1),
(77, 1),
(78, 1),
(81, 1),
(2, 2),
(5, 2),
(10, 2),
(12, 2),
(16, 2),
(18, 2),
(24, 2),
(26, 2),
(31, 2),
(34, 2),
(38, 2),
(43, 2),
(46, 2),
(49, 2),
(56, 2),
(58, 2),
(64, 2),
(67, 2),
(72, 2),
(74, 2),
(101, 10),
(105, 10),
(110, 10),
(111, 10),
(112, 10),
(114, 10),
(2, 12),
(5, 12),
(10, 12),
(12, 12),
(15, 12),
(18, 12),
(22, 12),
(28, 12),
(30, 12),
(35, 12),
(38, 12),
(42, 12),
(47, 12),
(51, 12),
(52, 12),
(53, 12),
(60, 12),
(64, 12),
(66, 12),
(72, 12),
(75, 12),
(78, 12),
(79, 12),
(80, 12),
(1, 13),
(6, 13),
(9, 13),
(12, 13),
(15, 13),
(18, 13),
(23, 13),
(26, 13),
(31, 13),
(34, 13),
(37, 13),
(42, 13),
(47, 13),
(48, 13),
(50, 13),
(52, 13),
(54, 13),
(59, 13),
(65, 13),
(66, 13),
(71, 13),
(75, 13),
(78, 13),
(80, 13);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id_reponse` int(11) NOT NULL AUTO_INCREMENT,
  `Intitule` text NOT NULL,
  `Juste` tinyint(1) DEFAULT NULL,
  `id_question` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_reponse`),
  KEY `FK_Reponse_id_question` (`id_question`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `reponse`
--

INSERT INTO `reponse` (`id_reponse`, `Intitule`, `Juste`, `id_question`) VALUES
(1, 'Une énumération est utilisée pour initialiser des variables', 0, 1),
(2, 'Une énumération est utilisée pour définir des constantes', 1, 1),
(3, 'Une énumération est utilisée pour définir des variables', 0, 1),
(4, 'Rien', 0, 1),
(5, 'Variable statique', 0, 2),
(6, 'Variable privée', 0, 2),
(7, 'Variable locale', 1, 2),
(8, 'Variable de série', 0, 2),
(9, 'Oui', 0, 3),
(10, 'Non', 1, 3),
(11, 'Elle doit être déclarée dans une méthode', 1, 4),
(12, 'elle représente un objet de classe', 0, 4),
(13, 'Elle peut etre utilisée partout dans le programme', 0, 4),
(14, 'Elle doit accepter une classe', 0, 4),
(15, 'Oui', 0, 5),
(16, 'Non', 1, 5),
(17, 'Surcharge (overloading)', 1, 6),
(18, 'Héritage', 0, 6),
(19, 'Abstraction', 0, 6),
(20, 'Polymorphisme (overriding)', 0, 6),
(21, 'Surcharge', 0, 7),
(22, 'Héritage', 0, 7),
(23, 'Abstraction', 0, 7),
(24, 'Polymorphisme (overriding)', 1, 7),
(25, 'L''abstraction', 0, 8),
(26, 'Le polymorphisme', 0, 8),
(27, 'L''héritage multiple', 1, 8),
(28, 'L''héritage', 0, 8),
(29, 'On ne peut écrire qu''une seule méthode abstraite au sein d''une interface', 0, 9),
(30, 'Aucune méthode n''est abstraite à l''interieur d''une interface', 0, 9),
(31, 'Toutes les méthode à l''interieur d''une interface sont abstraites', 1, 9),
(32, 'Aucune proposition n''est vraie', 0, 9),
(33, 'using System;', 0, 10),
(34, 'using System.Collections.Generic;', 0, 10),
(35, 'using System.Windows.Forms', 0, 10),
(36, 'Touts les espaces de noms cites', 1, 10),
(37, 'La définition d''une classe qui hérite UNIQUEMENT des méthodes publiques de A', 0, 11),
(38, 'La définition d''une classe qui hérite de TOUTES les méthodes de A. Les membres priveés ne pourront pas être accedés', 1, 11),
(39, 'Une erreur de compilation', 0, 11),
(40, 'La définition de A et de B', 0, 11),
(41, 'Abstrait', 0, 12),
(42, 'Scellé', 1, 12),
(43, 'Les deux', 0, 12),
(44, 'Aucun', 0, 12),
(45, 'Libérer la mémoire de la pile (stack)', 1, 13),
(46, 'Eviter les fuites mémoires', 0, 13),
(47, 'Libérer la mémoire occupée par des objets non référencés', 0, 13),
(48, 'Fermer les connexions de base de données ouvertes', 1, 13),
(49, 'Applications ASP.NET', 0, 14),
(50, 'CLR', 1, 14),
(51, 'Bibliothèque de classes du Framework (Framework Class Library)', 1, 14),
(52, 'Applications WinForm', 0, 14),
(53, 'GetValue()', 0, 15),
(54, 'GetString()', 0, 15),
(55, 'GetNumber()', 0, 15),
(56, 'Aucunes de ces propositions', 1, 15),
(57, 'Toutes ces propositions', 0, 15),
(58, 'Fermer la connexion', 0, 16),
(59, 'Met temporairement en pause la connexion', 0, 16),
(60, 'Supprime l''objet en mémoire', 1, 16),
(61, 'Toutes les propositions', 0, 16),
(62, 'En appelant la meéhode SortDescending()', 0, 17),
(63, 'En appelant la méthode Sort()', 0, 17),
(64, 'En appelant la méthode Sort() puis la méthode Reverse()', 1, 17),
(65, 'En appelant la méthode SortReverse()', 0, 17),
(66, 'L''appel Convert.ToString(str) gère le cas du NULL alors que l''appel str.ToString() ne le fait pas et envoie une exception de type NullReferenceException', 1, 18),
(67, 'L''appel str.ToString() gère le cas du NULL alors que l''appel Convert.ToString(str) ne le fait pas et envoie une exception de type NullReferenceException', 0, 18),
(68, 'Ces deux appels peuvent gérer le cas du pointeur NULL', 0, 18),
(69, 'Aucun de ces deux appels ne peuvent gérer le cas du pointeur NULL', 0, 18),
(70, 'System.lnt8', 0, 19),
(71, 'System.lnt16', 0, 19),
(72, 'System.lnt32', 1, 19),
(73, 'System.lnt64', 0, 19),
(74, 'ExecuteQuery', 0, 20),
(75, 'ExecuteUpdate', 0, 20),
(76, 'ExecuteNonQuery', 1, 20),
(77, 'ExecuteCommand', 0, 20),
(78, 'Fermer les fichiers non fermés', 1, 13),
(79, 'Aucune', 0, 13),
(80, 'Services Windows', 0, 14),
(81, 'Aucune', 0, 14);

-- --------------------------------------------------------

--
-- Structure de la table `resultat`
--

DROP TABLE IF EXISTS `resultat`;
CREATE TABLE IF NOT EXISTS `resultat` (
  `id_resultat` int(11) NOT NULL AUTO_INCREMENT,
  `Score` int(11) DEFAULT NULL,
  `id_test` int(11) NOT NULL,
  `id_candidat` int(11) DEFAULT NULL,
  `Date_exe` date NOT NULL,
  PRIMARY KEY (`id_resultat`),
  KEY `FK_Resultat_id_test` (`id_test`),
  KEY `FK_Resultat_id_candidat` (`id_candidat`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `resultat`
--

INSERT INTO `resultat` (`id_resultat`, `Score`, `id_test`, `id_candidat`, `Date_exe`) VALUES
(1, 15, 1, 1, '0000-00-00'),
(2, 10, 1, 2, '0000-00-00'),
(3, 12, 2, 1, '0000-00-00'),
(4, 16, 2, 2, '0000-00-00'),
(5, 14, 2, 3, '0000-00-00'),
(7, 1, 1, 10, '0000-00-00'),
(8, 7, 1, 10, '0000-00-00'),
(9, 6, 1, 10, '0000-00-00'),
(10, 7, 1, 11, '0000-00-00'),
(11, 3, 1, 10, '0000-00-00'),
(12, 8, 1, 12, '0000-00-00'),
(13, 18, 1, 1, '0000-00-00'),
(14, 16, 1, 1, '0000-00-00'),
(15, 14, 1, 1, '0000-00-00'),
(16, 20, 1, 10, '0000-00-00'),
(17, 20, 1, 10, '0000-00-00'),
(18, 14, 1, 10, '0000-00-00'),
(19, -3, 1, 10, '0000-00-00'),
(20, 20, 1, 10, '0000-00-00'),
(21, -2, 1, 10, '0000-00-00'),
(22, -2, 1, 10, '0000-00-00'),
(23, 3, 1, 10, '0000-00-00'),
(24, -2, 1, 10, '0000-00-00'),
(25, 4, 1, 10, '0000-00-00'),
(26, -3, 1, 10, '0000-00-00'),
(27, -1, 1, 10, '0000-00-00'),
(28, 0, 1, 10, '0000-00-00'),
(29, 0, 1, 10, '2016-08-01'),
(30, 0, 1, 10, '2016-08-01'),
(31, 0, 1, 10, '2016-08-01'),
(32, 0, 1, 10, '2016-08-01'),
(33, 0, 1, 10, '2016-08-01'),
(34, 3, 1, 13, '2016-08-02'),
(35, 0, 1, 10, '2016-08-02'),
(36, 0, 6, 10, '2016-08-05'),
(37, 0, 10, 10, '2016-08-05');

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id_test` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  `Categorie` varchar(25) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_test`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `test`
--

INSERT INTO `test` (`id_test`, `Nom`, `Categorie`) VALUES
(1, 'Test C#', 'Digital'),
(2, 'Test Java', 'Digital'),
(3, 'Test C#', 'Infra');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `Login` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Prenom` varchar(100) NOT NULL,
  `BU_origine` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Login` (`Login`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `Login`, `Password`, `Nom`, `Prenom`, `BU_origine`) VALUES
(2, 'Marion.Lefevre@admin.fr', 'admin1234', 'Lefevre', 'Marion', 'Villeneuve d''ascq'),
(3, 'Pierrick.Butin@sogeti.com', '1234', 'Butin', 'Pierrick', 'Villeneuve d''ascq'),
(11, 'Alex.carp@sog.fr', '1234', 'Carpentier', 'Alexandre', 'Villeneuve d''ascq'),
(13, 'baptiste.duhamel@hotmail.com', '12345', 'Duhamel', 'Baptiste', 'Lens'),
(15, 'abcde@fghi.jkl', '12345', 'Nom', 'Prenom', 'Villeneuve d''ascq');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `passer`
--
ALTER TABLE `passer`
  ADD CONSTRAINT `FK_Passer_id_candidat` FOREIGN KEY (`id_candidat`) REFERENCES `candidat` (`id_candidat`),
  ADD CONSTRAINT `FK_Passer_id_test` FOREIGN KEY (`id_test`) REFERENCES `test` (`id_test`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_Question_id_test` FOREIGN KEY (`id_test`) REFERENCES `test` (`id_test`);

--
-- Contraintes pour la table `repondre`
--
ALTER TABLE `repondre`
  ADD CONSTRAINT `FK_Repondre_id_candidat` FOREIGN KEY (`id_candidat`) REFERENCES `candidat` (`id_candidat`),
  ADD CONSTRAINT `FK_Repondre_id_reponse` FOREIGN KEY (`id_reponse`) REFERENCES `reponse` (`id_reponse`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_Reponse_id_question` FOREIGN KEY (`id_question`) REFERENCES `question` (`id_question`);

--
-- Contraintes pour la table `resultat`
--
ALTER TABLE `resultat`
  ADD CONSTRAINT `FK_Resultat_id_candidat` FOREIGN KEY (`id_candidat`) REFERENCES `candidat` (`id_candidat`),
  ADD CONSTRAINT `FK_Resultat_id_test` FOREIGN KEY (`id_test`) REFERENCES `test` (`id_test`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
