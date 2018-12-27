-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  mer. 26 déc. 2018 à 19:50
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
  `ville` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Adherent`
--

INSERT INTO `Adherent` (`idAdherent`, `mailPersonne`, `adressepostaleAdherent`, `PW_Adherent`, `estProducteur`, `estAdministrateur`, `dateinscription`, `dateproducteur`, `photo`, `description`, `ville`) VALUES
('lightnaruto', 'mabroua@icloud.com', '71 chemin des plantier', '84ada0e4bf93886610c494fd36acc11bfc43790b62445c46f4a0396d4e7d5a41', 0, 0, '2018-12-26 12:01:41', NULL, 'https://figuya.com/uploads/product/profile_picture/10582/profile_light-yagami-kira-und-ryuuk-ryuk-diorama20171214-28947-1gms6ny', NULL, 'cavaillon'),
('mabroukl', 'mabroukl@icloud.com', '75 chemin des plantiers', '64fb57e333a3ab729ebc1f4c8f31354db5b150fafd2fe3d08722f00bf9a2a575', 1, 1, '2018-12-24 09:40:18', '2018-12-24 09:40:18', 'https://images.ecosia.org/RC1B-XW9-56MMnJlDUTk8BBFaWg=/0x390/smart/https%3A%2F%2Fwww.fc-photos.com%2Fwp-content%2Fuploads%2F2016%2F09%2Ffc-photos-Weynacht-0001.jpg', 'Je suis productrice de pommes depuis près de 50 ans. J\'aime les chats.', 'Lagnes'),
('pandav', 'dsambuc@free.fr', '11, rue des étangs', '9327cfdac7c820149a65789a387dc9dda64694e9c7c3850536f0302302bf7f13', 1, 0, '2018-12-23 18:07:08', '2018-12-23 18:07:08', NULL, NULL, 'Montpellier'),
('Popola', 'ANDRE@yahoo.fr', '56 Rue des paniers MIX', '64fb57e333a3ab729ebc1f4c8f31354db5b150fafd2fe3d08722f00bf9a2a575', 0, 0, '2018-12-24 16:42:21', NULL, 'https://images.ecosia.org/Oh5dAT4YGWmW3WHQoZVpc54NG-c=/0x390/smart/https%3A%2F%2Fblog.fotolia.com%2Ffr%2Ffiles%2F2015%2F09%2FScreenshot2-575x600.png', NULL, 'Lagnes');

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
  `mailPersonne` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Article`
--

INSERT INTO `Article` (`idArticle`, `titreArticle`, `photo`, `date`, `description`, `mailPersonne`) VALUES
(1, 'La viande de veau', './images/Article1.jpg', '2018-11-26 00:00:00', 'Les Français gardent un attachement particulier pour la viande de veau qui continue de figurer parmi leurs viandes préférées, de l’escalope de veau à la blanquette de veau.\r\n\r\nMais d’abord, il faut s’assurer que sa couleur est légèrement rosée avec un gras clair et nacré. C’est le gage d’une viande tendre.\r\n\r\nIl est à noter que la viande de veau, pour conserver la finesse de son grain doit être consommée à peine rosée ou cuite à point mais jamais saignante et encore moins trop cuite.', 'mabroukl@icloud.com'),
(2, 'Cuisinez le butternut au four', './images/Article2.jpg', '2018-11-27 13:29:31', 'C\'est tout simple !', 'mabroukl@icloud.com'),
(4, 'Chandeleur avec l\'AMAP', 'https://images.ecosia.org/_666ebrNLPj6GZwFScgpmnEhtsc=/0x390/smart/https%3A%2F%2Fstatic3.hervecuisine.com%2Fwp-content%2Fuploads%2F2010%2F11%2Frecette-crepes-chandeleur-2018.jpg%3Fx89858', '2018-12-24 15:22:31', 'Les crêpes de l\'AMAP', 'mabroukl@icloud.com'),
(5, 'Crème brulée aux marrons', 'https://images.ecosia.org/Qh6P0TQkLqwTBSPMaRjFY_mWeAU=/0x390/smart/http%3A%2F%2Fcdn-elle.ladmedia.fr%2Fvar%2Fplain_site%2Fstorage%2Fimages%2Felle-a-table%2Frecettes-de-cuisine%2Fcreme-brulee-facile-2894406%2F52734072-1-fre-FR%2FCreme-brulee-facile.jpeg', '2018-12-24 15:25:04', 'Creme brulée avec les marrons de mon panier !', 'mabroukl@icloud.com'),
(6, 'Galette des rois aux pommes', 'https://2.bp.blogspot.com/-huQ7BfjHTPA/WGwUXGhN-dI/AAAAAAAAV5w/Y_CMLzYRl70nb-w4TebubGBzeQ0yuzehwCLcB/s1600/galette-des-rois-pommes.jpg', '2018-12-26 19:46:03', 'Recette délicieuse à tester', 'mabroua@icloud.com');

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

CREATE TABLE `contrat` (
  `idContrat` int(11) NOT NULL,
  `tailleContrat` varchar(1) NOT NULL,
  `typeContrat` varchar(32) NOT NULL,
  `frequenceContrat` varchar(20) NOT NULL,
  `idAdherent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contrat`
--

INSERT INTO `contrat` (`idContrat`, `tailleContrat`, `typeContrat`, `frequenceContrat`, `idAdherent`) VALUES
(12, 'L', 'carné', 'bimensuel', 96),
(13, 'L', 'carné', 'bimensuel', 96),
(14, 'L', 'carné', 'hebdomadaire', 48),
(15, 'M', 'végétal', 'mensuel', 48),
(16, 'M', 'végétal', 'mensuel', 48),
(17, 'L', 'carné', 'mensuel', 384),
(18, 'S', 'laitier', 'hebdomadaire', 96),
(19, 'S', 'carné', 'hebdomadaire', 48),
(20, 'M', 'carné', 'mensuel', 48),
(21, 'M', 'végétal', 'mensuel', 3069),
(22, 'S', 'laitier', 'hebdomadaire', 96),
(23, 'S', 'laitier', 'hebdomadaire', 96),
(24, 'S', 'laitier', 'hebdomadaire', 96),
(25, 'S', 'laitier', 'hebdomadaire', 96),
(26, 'M', 'végétal', 'bimensuel', 96),
(27, 'M', 'laitier', 'hebdomadaire', 48);

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
-- Structure de la table `LivreDor`
--

CREATE TABLE `LivreDor` (
  `id_message` int(11) NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `LivreDor`
--

INSERT INTO `LivreDor` (`id_message`, `pseudo`, `message`) VALUES
(1, 'a1', 'issou'),
(2, 'a2', 'azere'),
(3, 'a3', 'azr'),
(4, 'a4', 'eztgzer'),
(5, 'a5', 'ezrtre'),
(6, 'a6', 'azrfze'),
(7, 'a7', 'azrzed'),
(8, 'a8', 'zareza'),
(9, 'a9', 'zaraa'),
(10, 'a10', 'zaraezraz'),
(11, 'a11', 'eazr'),
(12, 'robertl', 'niquel j\'adore cette AMAP !!'),
(13, 'julien', 'Ouah super l\'AMAP elle est géniale'),
(14, 'JUJU', 'excellent !');

--
-- Déclencheurs `LivreDor`
--
DELIMITER $$
CREATE TRIGGER `mysql_s` BEFORE INSERT ON `LivreDor` FOR EACH ROW SET NEW.pseudo="DTC", NEW.message="Dans ton cul"
$$
DELIMITER ;

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
('ANDRE', 'Andrea', 'ANDRE@yahoo.fr'),
('sdfgsf', 'sfdbgwsf', 'dfb@dfb.fr'),
('Sambuc', 'David', 'dsambuc@free.fr'),
('muhlihu', 'ihmhm', 'liuhlihb@luh.fr'),
('mabrouk', 'anas', 'mabroua@icloud.com'),
('mabrouk', 'anas', 'mabrouka@icloud.com'),
('Mabrouk', 'Leila', 'mabroukl@icloud.com'),
('eheqthesqwbeq', 'thqehqegbdq', 'qebqegfb@lbmoub.fr'),
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
('Courgettes', 'https://tse4.mm.bing.net/th?id=OIP.iLKY88RipxGb68SLOHz5hwHaHa&pid=Api', 'courgettes bio de Lagnes');

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
-- Index pour la table `contrat`
--
ALTER TABLE `contrat`
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
-- AUTO_INCREMENT pour la table `contrat`
--
ALTER TABLE `contrat`
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
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Don`
--
ALTER TABLE `Don`
  ADD CONSTRAINT `fk_mailAddressDonnateur` FOREIGN KEY (`mailAddressDonnateur`) REFERENCES `Donnateur` (`mailAddressDonnateur`) ON DELETE CASCADE ON UPDATE CASCADE;
