-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 06 Juillet 2016 à 12:20
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `candidat`
--

INSERT INTO `candidat` (`id_candidat`, `Nom`, `Prenom`, `E_Mail`) VALUES
(1, 'Duhamel', 'Baptiste', 'baptiste.duhamel@hotmail.com'),
(2, 'Butin', 'Pierrick', 'Pierrick.butin@hotmail.fr'),
(3, 'Salengro', 'Marc-Antoine', 'Msalengro@gmail.fr');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `passer`
--

INSERT INTO `passer` (`Date_exe`, `id_candidat`, `id_test`) VALUES
('2016-06-24', 1, 1),
('2016-06-27', 1, 2),
('2016-06-22', 2, 1),
('2016-06-12', 2, 2),
('2016-06-29', 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `Intitule` text,
  `id_test` int(11) NOT NULL,
  PRIMARY KEY (`id_question`),
  KEY `FK_Question_id_test` (`id_test`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`id_question`, `Intitule`, `id_test`) VALUES
(1, 'Qu’est-ce qu’une enumeration ?\r\n', 1),
(2, 'Une variable declaree à l’interieur d’une methode est appelee :\r\n', 1),
(3, 'Une interface peut-elle etre instanciee directement ?', 1),
(4, 'Quelle est la caracteristique d’une variable locale ?', 1),
(5, 'Est-il possible de stocker plusieurs types de donnees au sein d’un System.Array ?', 1),
(6, 'Definir : Deux methodes avec le meme nom et des parametres differents :', 1),
(7, 'Definir : Deux methodes avec le meme nom, les memes parametres dans 2 classes qui heritent l’une de l’autre se comportant differemment : ', 1),
(8, 'Le C# ne supporte pas :', 1),
(9, 'Qu’est ce qui est VRAI à propos des Interfaces et des Methodes abstraites ?', 1),
(10, 'Lequel de ces espaces de nom (namespace) est utilisé en C# .NET ?', 1),
(11, 'Quel est la resultante du code suivant : public class B : A { }', 1),
(12, 'Quelle type de classe ne peut etre herite ?', 1),
(13, 'Quels actions ne sont PAS effectuees par le ramasse-miettes (Garbage Collector) ?\r\n1)      Libérer la mémoire de la pile (stack)\r\n2)      Eviter les fuites memoires\r\n3)      Liberer la memoire occupee par des objets non references\r\n4)      Fermer les connexion de base de donnees ouvertes\r\n5)      Fermer les fichiers non fermes', 1),
(14, 'Quels sont les principaux constituants du Framework .NET ?\r\n1)      Applications ASP.NET\r\n2)      CLR\r\n3)      Bibliotheque de classes du Framework (Framework Class Library)\r\n4)      Applications WinForm\r\n5)      Services Windows', 1),
(15, 'Dans un DataReader, que peut-on utiliser avant la methode Read() ?', 1),
(16, 'Quel est le comportement de la methode Dispose() avec les objets comprenant une connexion ?', 1),
(17, 'Comment trier les elements d’un tableau dans un ordre decroissant ?', 1),
(18, 'Quelle est la difference entre l’appel Convert.ToString(str) et str.ToString() en considerant str comme une variable de type String ?', 1),
(19, 'A quel type le mot cle « int » fait-il reference en .NET ?', 1),
(20, 'Durant une mise a jour (Update), quelle methode de SqlCommand est la plus optimale ?', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `repondre`
--

INSERT INTO `repondre` (`id_reponse`, `id_candidat`) VALUES
(2, 1),
(6, 1),
(10, 1),
(11, 1),
(15, 1),
(17, 1),
(24, 1),
(27, 1),
(30, 1),
(36, 1),
(38, 1),
(42, 1),
(46, 1),
(50, 1),
(56, 1),
(60, 1),
(64, 1),
(67, 1),
(72, 1),
(76, 1),
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
(74, 2);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `id_reponse` int(11) NOT NULL AUTO_INCREMENT,
  `Intitule` text,
  `Juste` tinyint(1) DEFAULT NULL,
  `id_question` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_reponse`),
  KEY `FK_Reponse_id_question` (`id_question`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reponse`
--

INSERT INTO `reponse` (`id_reponse`, `Intitule`, `Juste`, `id_question`) VALUES
(1, 'Une enumeration est utilisee pour initialiser des variables', 0, 1),
(2, 'Une enumeration est utilisee pour definir des constantes', 1, 1),
(3, 'Une énumération est utilisée pour définir des variables', 0, 1),
(4, 'Rien', 0, 1),
(5, 'Variable statique', 0, 2),
(6, 'Variable privee', 0, 2),
(7, 'Variable locale', 1, 2),
(8, 'Variable de serie', 0, 2),
(9, 'Oui', 0, 3),
(10, 'Non', 1, 3),
(11, 'Elle doit etre declaree dans une methode', 1, 4),
(12, 'elle represente un objet de classe', 0, 4),
(13, 'Elle peut etre utilisee partout dans le programme', 0, 4),
(14, 'Elle doit accepter une classe', 0, 4),
(15, 'Oui', 0, 5),
(16, 'Non', 1, 5),
(17, 'Surcharge (overloading)', 1, 6),
(18, 'Heritage', 0, 6),
(19, 'Abstraction', 0, 6),
(20, 'Polymorphisme (overriding)', 0, 6),
(21, 'Surcharge', 0, 7),
(22, 'Heritage', 0, 7),
(23, 'Abstraction', 0, 7),
(24, 'Polymorphisme (overriding)', 1, 7),
(25, 'L''abstraction', 0, 8),
(26, 'Le polymorphisme', 0, 8),
(27, 'L''heritage multiple', 1, 8),
(28, 'L''heritage', 0, 8),
(29, 'On ne peut ecrire qu’une seule methode abstraite au sein d’une interface', 0, 9),
(30, 'Aucune methode n''est abstraite  a l''interieur d''une interface', 0, 9),
(31, 'Toutes les methode a l''interieur d''une interface sont abstraites', 1, 9),
(32, 'Aucune proposition n''est vraie', 0, 9),
(33, 'using System;', 0, 10),
(34, 'using System.Collections.Generic;', 0, 10),
(35, 'using System.Windows.Forms', 0, 10),
(36, 'Touts les espaces de noms cites', 1, 10),
(37, 'La definition d''une classe qui herite UNIQUEMENT des methodes publiques de A', 0, 11),
(38, 'La definition d’une classe qui herite de TOUTES les methodes de A. Les membres privees ne pourront pas etre accedees', 1, 11),
(39, 'Une erreur de compilation', 0, 11),
(40, 'La definition de A et de B', 0, 11),
(41, 'Abstrait', 0, 12),
(42, 'Scelle', 1, 12),
(43, 'Les deux', 0, 12),
(44, 'Aucun', 0, 12),
(45, '1, 2 et 3', 0, 13),
(46, '1,4 et 5', 1, 13),
(47, '3 et 5', 0, 13),
(48, '3 et 4', 0, 13),
(49, '2 et 5', 0, 14),
(50, '1 et 2', 0, 14),
(51, '2 et 3', 1, 14),
(52, '3 et 4', 0, 14),
(53, 'GetValue()', 0, 15),
(54, 'GetString()', 0, 15),
(55, 'GetNumber()', 0, 15),
(56, 'Aucunes de ces propositions', 1, 15),
(57, 'Toutes ces propositions', 0, 15),
(58, 'Fermer la connexion', 0, 16),
(59, 'Met temporairement en pause la connexion', 0, 16),
(60, 'Supprime l''objet en memoire', 1, 16),
(61, 'Toutes les propositions', 0, 16),
(62, 'En appelant la methode SortDescending()', 0, 17),
(63, 'En appelant la methode Sort()', 0, 17),
(64, 'En appelant la methode Sort() puis la methode Reverse()', 1, 17),
(65, 'En appelant la methode SortReverse()', 0, 17),
(66, 'L’appel Convert.ToString(str) gere le cas du NULL alors que l’appel str.ToString() ne le fait pas et envoie une exception de type NullReferenceException', 1, 18),
(67, ' L’appel str.ToString() gere le cas du NULL alors que l’appel Convert.ToString(str) ne le fait pas et envoie une exception de type NullReferenceException', 0, 18),
(68, 'Ces deux appels peuvent gerer le cas du pointeur NULL', 0, 18),
(69, 'Aucun de ces deux appels ne peuvent gerer le cas du pointeur NULL', 0, 18),
(70, 'System.lnt8', 0, 19),
(71, 'System.lnt16', 0, 19),
(72, 'System.lnt32', 1, 19),
(73, 'System.lnt64', 0, 19),
(74, 'ExecuteQuery', 0, 20),
(75, 'ExecuteUpdate', 0, 20),
(76, 'ExecuteNonQuery', 1, 20),
(77, 'ExecuteCommand', 0, 20);

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
  PRIMARY KEY (`id_resultat`),
  KEY `FK_Resultat_id_test` (`id_test`),
  KEY `FK_Resultat_id_candidat` (`id_candidat`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `resultat`
--

INSERT INTO `resultat` (`id_resultat`, `Score`, `id_test`, `id_candidat`) VALUES
(1, 15, 1, 1),
(2, 10, 1, 2),
(3, 12, 2, 1),
(4, 16, 2, 2),
(5, 14, 2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id_test` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(25) DEFAULT NULL,
  `Categorie` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_test`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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
  `Login` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Nom` varchar(100) CHARACTER SET utf8 NOT NULL,
  `Prenom` varchar(100) CHARACTER SET utf16 NOT NULL,
  `BU_origine` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Login` (`Login`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `Login`, `Password`, `Nom`, `Prenom`, `BU_origine`) VALUES
(2, 'Marion.Lefevre@admin.fr', 'admin1234', 'Lefevre', 'Marion', 'Villeneuve d''ascq'),
(3, 'Pierrick.Butin@sogeti.com', 'support2424', 'Butin', 'Pierrick', 'Lens'),
(11, 'Alex.carp@sog.fr', '1234', 'Carpentier', 'Alexandre', 'Lille'),
(13, 'baptiste.duhamel@hotmail.com', '12345', 'Duhamel', 'Baptiste', 'Lens');

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
