-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  Dim 06 jan. 2019 à 18:42
-- Version du serveur :  5.7.24-0ubuntu0.18.04.1
-- Version de PHP :  7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `MonAMAP`
--

-- --------------------------------------------------------

--
-- Structure de la table `Adherent`
--

CREATE TABLE `Adherent` (
                          `idAdherent` varchar(30) NOT NULL,
                          `mailPersonne` varchar(50) NOT NULL,
                          `adressepostaleAdherent` varchar(50) NOT NULL,
                          `PW_Adherent` varchar(64) NOT NULL,
                          `estProducteur` tinyint(1) NOT NULL,
                          `estAdministrateur` tinyint(1) NOT NULL,
                          `dateinscription` datetime NOT NULL,
                          `dateproducteur` datetime DEFAULT NULL,
                          `photo` varchar(300) DEFAULT NULL,
                          `description` varchar(500) DEFAULT NULL,
                          `ville` varchar(50) NOT NULL,
                          `isValid` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Adherent`
--

INSERT INTO `Adherent` (`idAdherent`, `mailPersonne`, `adressepostaleAdherent`, `PW_Adherent`, `estProducteur`, `estAdministrateur`, `dateinscription`, `dateproducteur`, `photo`, `description`, `ville`, `isValid`) VALUES
('aezrytyjuy', 'aezrtyt@efzgrhtryjt', 'aerzt', '44ffa0af7ba28bfe3d7c1aa5b5f66c1ee973bb65c072948165c3ecca373f9b67', 0, 1, '2019-01-05 22:42:11', NULL, './images/Producteur6.png', '', 'aztretryt', 1),
('issoezgru', 'fezgrhty@ezretryt', 'azrethr', '44ffa0af7ba28bfe3d7c1aa5b5f66c1ee973bb65c072948165c3ecca373f9b67', 1, 0, '2019-01-04 16:04:59', '2019-01-04 16:04:59', './images/Producteur5.png', '', 'azertyu', 1),
('issou', 'ezfrgtryt@ezretryt', 'azrethr', '44ffa0af7ba28bfe3d7c1aa5b5f66c1ee973bb65c072948165c3ecca373f9b67', 1, 0, '2019-01-04 16:04:59', '2019-01-04 16:04:59', './images/Producteur7.png', '', 'azertyu', 1),
('mabrouazfegrkl', 'mabzaegrroukl@icloud.com', '75 chemin des plantiers', '64fb57e333a3ab729ebc1f4c8f31354db5b150fafd2fe3d08722f00bf9a2a575', 0, 1, '2018-12-24 09:40:18', '2018-12-24 09:40:18', './images/Producteur4.png', 'Je suis productrice de pommes depuis près de 50 ans. J\'aime les chats.', 'Lagnes', 1),
('mabroukl', 'mabroukl@icloud.com', '75 chemin des plantiers', '64fb57e333a3ab729ebc1f4c8f31354db5b150fafd2fe3d08722f00bf9a2a575', 0, 0, '2018-12-24 09:40:18', '2018-12-24 09:40:18', 'https://images.ecosia.org/RC1B-XW9-56MMnJlDUTk8BBFaWg=/0x390/smart/https%3A%2F%2Fwww.fc-photos.com%2Fwp-content%2Fuploads%2F2016%2F09%2Ffc-photos-Weynacht-0001.jpg', 'Je suis productrice de pommes depuis près de 50 ans. J\'aime les chats.', 'Lagnes', 0),
('pandav', 'dsambuc@free.fr', '11, rue des étangs', '9327cfdac7c820149a65789a387dc9dda64694e9c7c3850536f0302302bf7f13', 1, 1, '2018-12-23 18:07:08', '2018-12-23 18:07:08', './images/pandab.png', 'a\r\ntest', 'Montpellier', 0),
('pandzafegrhtav', 'dsaaezgrhtrmbuc@free.fr', '11, rue des étangs', '9327cfdac7c820149a65789a387dc9dda64694e9c7c3850536f0302302bf7f13', 1, 1, '2018-12-23 18:07:08', '2018-12-23 18:07:08', './images/Producteur3.png', 'a\r\ntest', 'Montpellier', 1),
('zefgrhtryjtuy', 'aezrtyt@efzgrhtrt', 'aerzt', '44ffa0af7ba28bfe3d7c1aa5b5f66c1ee973bb65c072948165c3ecca373f9b67', 0, 0, '2019-01-05 22:42:11', NULL, './images/Producteur2.png', '', 'aztretryt', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Article`
--

CREATE TABLE `Article` (
                         `idArticle` int(11) NOT NULL,
                         `titreArticle` varchar(50) NOT NULL,
                         `photo` varchar(500) DEFAULT NULL,
                         `date` datetime NOT NULL,
                         `description` varchar(1000) NOT NULL,
                         `mailPersonne` varchar(32) NOT NULL,
                         `isValid` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Article`
--

INSERT INTO `Article` (`idArticle`, `titreArticle`, `photo`, `date`, `description`, `mailPersonne`, `isValid`) VALUES
(1, 'La viande de veau', './images/Article1.jpg', '2018-11-26 00:00:00', 'Les Français gardent un attachement particulier pour la viande de veau qui continue de figurer parmi leurs viandes préférées, de l’escalope de veau à la blanquette de veau.\r\n\r\nMais d’abord, il faut s’assurer que sa couleur est légèrement rosée avec un gras clair et nacré. C’est le gage d’une viande tendre.\r\n\r\nIl est à noter que la viande de veau, pour conserver la finesse de son grain doit être consommée à peine rosée ou cuite à point mais jamais saignante et encore moins trop cuite.', 'dsambuc@free.fr', 0),
(2, 'Cuisinez le butternut au four', './images/Article2.jpg', '2018-11-27 13:29:31', 'C\'est tout simple !\r\ntest', 'mabroukl@icloud.com', 0),
(4, 'Chandeleur avec l\'AMAP', 'https://images.ecosia.org/_666ebrNLPj6GZwFScgpmnEhtsc=/0x390/smart/https%3A%2F%2Fstatic3.hervecuisine.com%2Fwp-content%2Fuploads%2F2010%2F11%2Frecette-crepes-chandeleur-2018.jpg%3Fx89858', '2018-12-24 15:22:31', 'Les crêpes de l\'AMAP', 'mabroukl@icloud.com', 0),
(5, 'Crème brulée aux marrons', 'https://images.ecosia.org/Qh6P0TQkLqwTBSPMaRjFY_mWeAU=/0x390/smart/http%3A%2F%2Fcdn-elle.ladmedia.fr%2Fvar%2Fplain_site%2Fstorage%2Fimages%2Felle-a-table%2Frecettes-de-cuisine%2Fcreme-brulee-facile-2894406%2F52734072-1-fre-FR%2FCreme-brulee-facile.jpeg', '2018-12-24 15:25:04', 'Creme brulée avec les marrons de mon panier !', 'mabroukl@icloud.com', 1),
(6, 'Galette des rois aux pommes', 'https://2.bp.blogspot.com/-huQ7BfjHTPA/WGwUXGhN-dI/AAAAAAAAV5w/Y_CMLzYRl70nb-w4TebubGBzeQ0yuzehwCLcB/s1600/galette-des-rois-pommes.jpg', '2018-12-26 19:46:03', 'Recette délicieuse à tester', 'mabroua@icloud.com', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Contrat`
--

CREATE TABLE `Contrat` (
                         `idContrat` int(11) NOT NULL,
                         `tailleContrat` varchar(1) NOT NULL,
                         `typeContrat` varchar(32) NOT NULL,
                         `frequenceContrat` varchar(20) NOT NULL,
                         `idAdherent` int(11) NOT NULL,
                         `encours` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Contrat`
--

INSERT INTO `Contrat` (`idContrat`, `tailleContrat`, `typeContrat`, `frequenceContrat`, `idAdherent`, `encours`) VALUES
(12, 'L', 'carné', 'bimensuel', 96, 0),
(13, 'L', 'carné', 'bimensuel', 96, 0),
(14, 'L', 'carné', 'hebdomadaire', 48, 0),
(15, 'M', 'végétal', 'mensuel', 48, 0),
(16, 'M', 'végétal', 'mensuel', 48, 0),
(17, 'L', 'carné', 'mensuel', 384, 0),
(18, 'S', 'laitier', 'hebdomadaire', 96, 0),
(19, 'S', 'carné', 'hebdomadaire', 48, 0),
(20, 'M', 'carné', 'mensuel', 48, 0),
(21, 'M', 'végétal', 'mensuel', 3069, 0),
(22, 'S', 'laitier', 'hebdomadaire', 96, 0),
(23, 'S', 'laitier', 'hebdomadaire', 96, 0),
(24, 'S', 'laitier', 'hebdomadaire', 96, 0),
(25, 'S', 'laitier', 'hebdomadaire', 96, 0),
(26, 'M', 'végétal', 'bimensuel', 96, 0),
(27, 'M', 'laitier', 'hebdomadaire', 48, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Don`
--

CREATE TABLE `Don` (
                     `idDon` int(11) NOT NULL,
                     `montantDon` int(11) NOT NULL,
                     `mailAddressDonnateur` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Don`
--

INSERT INTO `Don` (`idDon`, `montantDon`, `mailAddressDonnateur`) VALUES
(1, 10, 'Bertouille@wannado.fr'),
(2, 20, 'Bertouille@wannado.fr'),
(3, 20, 'Bertouille@wannado.fr'),
(4, 9, 'fatfatfat@gmail.com'),
(5, 9, 'fatfatfat@gmail.com'),
(6, 9, 'fatfatfat@gmail.com'),
(7, 9, 'fatfatfat@gmail.com'),
(8, 130, 'julian.bourdes@gmail.com'),
(9, 150, 'prybyslouis@gmail.com'),
(10, 16, 'louiserobert2510@gmail.com'),
(11, 52, 'ouah@wahoo.com'),
(12, 15, 'jeanPetitQuiDanse@gmail.com'),
(13, 15, 'jeanPetitQuiDanse@gmail.com'),
(14, 32, 'julien.saurel11@gmail.com'),
(15, 500, 'julian.bourdes@gmail.com'),
(16, 10, 'jacquesHaddiToucheTonNez@wannado.fr'),
(17, 10, 'julian.bourdes@gmail.com'),
(18, 7, 'louiserobert2510@gmail.com'),
(19, 51, 'jacquesHaddiToucheTonNez@wannado.fr'),
(20, 11, 'jujujujujujuju@jujuju.juju'),
(21, 5, 'dsambuc@free.fr'),
(22, 5, 'dsambuc@free.fr'),
(23, 5, 'dsambuc@free.fr'),
(24, 5, 'dsambuc@free.fr'),
(25, 5, 'dsambuc@free.fr'),
(26, 3, 'eddie.vallier@gmail.com'),
(27, 3, 'eddie.vallier@gmail.com'),
(28, 10, 'jeanPetitQuiDanse@gmail.com'),
(29, 20, 'leila.mabrouk@gmail.com'),
(30, 30, 'julien.saurel11@gmail.com'),
(31, 30, 'julien.saurel11@gmail.com'),
(32, 30, 'julien.saurel11@gmail.com'),
(33, 30, 'julien.saurel11@gmail.com'),
(34, 30, 'julien.saurel11@gmail.com'),
(35, 2, 'julien.saurel11@gmail.com'),
(36, 6, 'julien.saurel11@gmail.com'),
(37, 6, 'julien.saurel11@gmail.com'),
(38, 5, 'julien.saurel11@gmail.com'),
(39, 1, 'zdaf@gmail.com'),
(40, 2, 'louiserobert2510@gmail.com'),
(41, 7, 'fatfatfat@gmail.com'),
(42, 1000, 'julien.saurel11@gmail.com'),
(43, 39, 'paulmpx@mail.com'),
(44, 666, 'undeadanchor@gmail.com'),
(45, 700, 'michmich@yopail.fr'),
(46, 9, 'julien.saurel11@gmail.com'),
(47, 100, 'elisabeth.foulon@gmail.com'),
(48, 54, 'julien.saurel11@gmail.com'),
(49, 12, 'louiserobert2510@gmail.com'),
(50, 44, 'lachancla@issou'),
(51, 2, 'dsambuc@free.fr'),
(52, 7, 'mabroukl@icloud.com'),
(53, 578, 'mabroukl@icloud.com');

-- --------------------------------------------------------

--
-- Structure de la table `Donnateur`
--

CREATE TABLE `Donnateur` (
                           `mailAddressDonnateur` varchar(70) NOT NULL,
                           `nomDonnateur` varchar(20) NOT NULL,
                           `prenomDonnateur` varchar(20) NOT NULL,
                           `montantTotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Donnateur`
--

INSERT INTO `Donnateur` (`mailAddressDonnateur`, `nomDonnateur`, `prenomDonnateur`, `montantTotal`) VALUES
('aa-nousnesommespasmechant@gmail.com', 'Dupin', 'Angéline', 100),
('angelineedupin@gmail.com', 'Dupin', 'Angéline', 100),
('BeccaLaCouz@gmail.com', 'Cémakouzine', 'Bécassine', 12),
('Bertouille@wannado.fr', 'Barbaste', 'Berte', 640),
('champagnepapi@drake.fr', 'TheRapper', 'Drake', 1000000),
('dsambuc@free.fr', 'Sambuc', 'David', 132),
('eddie.vallier@gmail.com', 'Vallier', 'Eddie', 6),
('elisabeth.foulon@gmail.com', 'FOULON', 'ELISABETH', 120),
('enilegna.d@gmail.com', 'Dupin', 'Angéline', 4),
('fatfatfat@gmail.com', 'Regali', 'Fatima', 64),
('jaccuzi@gmail.com', 'Ouzi', 'Jacques ', 70),
('jacquesHaddiToucheTonNez@wannado.fr', 'Haddi', 'Jacques', 160),
('jeanPetitQuiDanse@gmail.com', 'Petit', 'Jean', 206),
('jujujujujujuju@jujuju.juju', 'Saurel', 'Julien', 11),
('julian.bourdes@gmail.com', 'Bourdes', 'Julian', 645),
('julien.saurel11@gmail.com', 'Saurel', 'Julien', 1277),
('juliensaurel@juju.com', 'Saurel', 'Julien', 555),
('lachancla@issou', 'lachancla', 'issou', 44),
('leila.mabrouk@gmail.com', 'Mabrouk', 'Leila', 20),
('louiserobert2510@gmail.com', 'Robert', 'Louise', 152),
('loulou30@gmail.com', 'Prybys', 'Louis', 100),
('mabroukl@icloud.com', 'MABROUK', 'Leila', 585),
('mecnul@nullite.com', 'nul', 'mec', 10),
('michel@michel.fr', 'Barbaste', 'Michel', 5),
('MichelBarbaste@gmail.com', 'Barbaste', 'Michel', 45),
('michmich@yopail.fr', 'Michel', 'Michouille', 700),
('moi@moi.com', 'Dupont', 'Henri', 10),
('muriellelaurent11@free.fr', 'Saurel', 'Laurent', 100),
('ouah@wahoo.com', 'deJulien', 'Bite', 52),
('paulmpx@mail.com', 'Mirepoix', 'Paul', 39),
('prybyslouis@gmail.com', 'Prybys', 'Louis', 150),
('sebastien.gagne@umontpellier.fr', 'Gagné', 'Sébastien', 10),
('toutvecu@immortel.com', 'Alain', 'Sabatier', 2),
('undeadanchor@gmail.com', 'Mirepoix', 'Paul', 666),
('valentin.kmp@gmail.com', 'Kemper', 'Valentin', 5),
('zdaf@gmail.com', 'zea', 'aé', 6);

-- --------------------------------------------------------

--
-- Structure de la table `Homepage`
--

CREATE TABLE `Homepage` (
                          `pagetitle` varchar(100) NOT NULL,
                          `welcomephrase` varchar(100) NOT NULL,
                          `descbannerphrase` varchar(100) NOT NULL,
                          `newsnameandtext` varchar(1000) NOT NULL,
                          `namearticlelink` varchar(100) NOT NULL,
                          `firstarticledisplayed` varchar(100) NOT NULL,
                          `secondarticledisplayed` varchar(100) NOT NULL,
                          `firstparagraph` varchar(1000) NOT NULL,
                          `maptitle` varchar(100) NOT NULL,
                          `firstimagetitle` varchar(100) NOT NULL,
                          `firstimage` varchar(100) NOT NULL,
                          `firstimagephrase` varchar(1000) NOT NULL,
                          `secondimagetitle` varchar(100) NOT NULL,
                          `secondimage` varchar(100) NOT NULL,
                          `secondimageparagraph` varchar(1000) NOT NULL,
                          `idHomepage` varchar(100) NOT NULL,
                          `firstimagelist` text NOT NULL,
                          `firstparagraphlink` varchar(100) NOT NULL,
                          `maplink` varchar(1000) NOT NULL,
                          `banner` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Homepage`
--

INSERT INTO `Homepage` (`pagetitle`, `welcomephrase`, `descbannerphrase`, `newsnameandtext`, `namearticlelink`, `firstarticledisplayed`, `secondarticledisplayed`, `firstparagraph`, `maptitle`, `firstimagetitle`, `firstimage`, `firstimagephrase`, `secondimagetitle`, `secondimage`, `secondimageparagraph`, `idHomepage`, `firstimagelist`, `firstparagraphlink`, `maplink`, `banner`) VALUES
('Accueil', ' Bienvenue sur le site de l\'AMAP de la région Occitanie ', 'Présentation de l\'AMAP.', 'Actualités\r\n\r\nProchaine rencontre à Saint-Jean-de-Védas.\r\nplus de renseignements ici.', 'Derniers articles', '5', '6', ' L\'AMAP d\'O regroupe plusieurs maraîchers et éveleurs de la région Occitanie, qui vous proposent leurs produits BIO. Mauris ante tellus, egestas nec arcu eget, hendrerit laoreet velit. Pellentesque id urna in massa scelerisque fermentum ac vel leo. Curabitur sem sapien, feugiat vel varius sed, condimentum vitae erat. Vestibulum non velit augue. Maecenas pretium in ex sed luctus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Duis vel sodales lacus. Phasellus diam massa, tincidunt a dui a, porttitor posuere nisi. Maecenas arcu risus, volutpat sit amet cursus sed, facilisis in nisi.\r\n', 'Nous trouver', 'Q\'est-ce qu\'une AMAP ?', './images/section2-accueil.jpg', ' À travers notre site, vous pouvez profiter d\'une multitude de fonctionnalités :\r\n', 'Notre engagement dans le BI0', './images/section3-accueil.jpg', 'Ut hendrerit ex ac libero venenatis, sit amet elementum dolor porttitor. Vivamus semper, erat non facilisis pellentesque, mauris ipsum ullamcorper lacus, ac egestas tortor turpis eu ligula. Nulla lacinia hendrerit libero, nec sollicitudin enim fermentum vitae. Nullam vestibulum, leo gravida luctus vehicula, diam dolor condimentum nulla, in pretium orci massa non erat. Duis gravida est porttitor, efficitur tellus ut, tincidunt est. In hac habitasse platea dictumst. Aliquam semper imperdiet ligula, sed vulputate dolor ultrices ut. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras feugiat maximus libero, in ultrices diam eleifend nec. Sed ut erat porttitor, vulputate dui quis, volutpat lorem.', 'Accueil', 'Découvrir les valeurs de l\'AMAP\r\n Profiter des articles, des recettes et s\'informer sur les évenements organisés par les adhérents\r\n Consulter les contrats que nos partenaires proposent\r\n Adhérer à l\'AMAP et choisir son ou ses contrats', 'En savoir plus...', 'https://www.google.com/maps/d/embed?mid=1jXR-N1Ge3qSqQ48tiTxcWRYDfhcAoGb2', 'images/pasteque.jpg images/fruit.jpg images/leg.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `LivreDor`
--

CREATE TABLE `LivreDor` (
                          `id_message` int(11) NOT NULL,
                          `pseudo` varchar(25) NOT NULL,
                          `message` text NOT NULL,
                          `isValid` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `LivreDor`
--

INSERT INTO `LivreDor` (`id_message`, `pseudo`, `message`, `isValid`) VALUES
(1, 'a1', 'issou test', 1),
(6, 'a6', 'azrfze', 1),
(7, 'a7', 'azrzed', 1),
(8, 'a8', 'zareza', 1),
(9, 'a9', 'zaraa', 1),
(10, 'a10', 'zaraezraz', 0),
(11, 'a11', 'eazr', 1),
(12, 'robertl', 'niquel j\'adore cette AMAP !!', 1),
(13, 'julien', 'Ouah super l\'AMAP elle est géniale', 1),
(14, 'JUJU', 'excellent !', 1),
(15, 'issou', 'ezrtry', 1),
(16, 'kezfrgthydyjf', 'kezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjf', 1),
(17, 'kezfrgthydyjf', 'kezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjf', 0),
(18, 'kezfrgthydyjf', 'kezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjf', 0),
(19, 'kezfrgthydyjf', 'kezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjf', 1),
(20, 'kezfrgthydyjf', 'kezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjfkezfrgthydyjf', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Personne`
--

CREATE TABLE `Personne` (
                          `nomPersonne` varchar(32) NOT NULL,
                          `prenomPersonne` varchar(32) NOT NULL,
                          `mailPersonne` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Personne`
--

INSERT INTO `Personne` (`nomPersonne`, `prenomPersonne`, `mailPersonne`) VALUES
('eheqthesqwbeq', 'thqehqegbdq', 'aezrtyt@efzgrhtrt'),
('ezrty', 'azezretryt', 'aezrtyt@efzgrhtryjt'),
('ezret', 'zareter', 'azeretr@aezteyrt'),
('muhlihu', 'ihmhm', 'dsaaezgrhtrmbuc@free.fr'),
('Sambuc', 'David', 'dsambuc@free.fr'),
('ezrthyjy', 'azretry', 'ezfrgtryt@ezretryt'),
('ANDRE', 'Andrea', 'fezgrhty@ezretryt'),
('mabrouk', 'anas', 'mabroua@icloud.com'),
('mabrouk', 'anas', 'mabrouka@icloud.com'),
('Mabrouk', 'Leila', 'mabroukl@icloud.com'),
('sdfgsf', 'sfdbgwsf', 'mabzaegrroukl@icloud.com'),
('ezrety', 'rteyrtuy', 'panda@gmail.com'),
('eszutrd', 'trst', 'rts@ytdjyt.fr');

-- --------------------------------------------------------

--
-- Structure de la table `Produit`
--

CREATE TABLE `Produit` (
                         `nomProduit` varchar(20) NOT NULL,
                         `image` varchar(300) NOT NULL,
                         `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Produit`
--

INSERT INTO `Produit` (`nomProduit`, `image`, `description`) VALUES
('Courgettes', './images/courgette.jpeg', 'courgettes bio de Lagnes');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Adherent`
--
ALTER TABLE `Adherent`
  ADD PRIMARY KEY (`idAdherent`),
  ADD KEY `idPersonne` (`mailPersonne`);

--
-- Index pour la table `Article`
--
ALTER TABLE `Article`
  ADD PRIMARY KEY (`idArticle`),
  ADD KEY `idAdherent` (`mailPersonne`);

--
-- Index pour la table `Contrat`
--
ALTER TABLE `Contrat`
  ADD PRIMARY KEY (`idContrat`),
  ADD KEY `idAdherent` (`idAdherent`);

--
-- Index pour la table `Don`
--
ALTER TABLE `Don`
  ADD PRIMARY KEY (`idDon`),
  ADD KEY `mailAddressDonnateur` (`mailAddressDonnateur`);

--
-- Index pour la table `Donnateur`
--
ALTER TABLE `Donnateur`
  ADD PRIMARY KEY (`mailAddressDonnateur`);

--
-- Index pour la table `Homepage`
--
ALTER TABLE `Homepage`
  ADD PRIMARY KEY (`idHomepage`);

--
-- Index pour la table `LivreDor`
--
ALTER TABLE `LivreDor`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `Personne`
--
ALTER TABLE `Personne`
  ADD PRIMARY KEY (`mailPersonne`);

--
-- Index pour la table `Produit`
--
ALTER TABLE `Produit`
  ADD PRIMARY KEY (`nomProduit`),
  ADD KEY `nomProduit` (`nomProduit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Article`
--
ALTER TABLE `Article`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Contrat`
--
ALTER TABLE `Contrat`
  MODIFY `idContrat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `Don`
--
ALTER TABLE `Don`
  MODIFY `idDon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `LivreDor`
--
ALTER TABLE `LivreDor`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Don`
--
ALTER TABLE `Don`
  ADD CONSTRAINT `fk_mailAddressDonnateur` FOREIGN KEY (`mailAddressDonnateur`) REFERENCES `Donnateur` (`mailAddressDonnateur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;