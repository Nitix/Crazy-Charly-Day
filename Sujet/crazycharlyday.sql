-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 20, 2014 at 10:33 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `easydejeuner-new`
--

-- --------------------------------------------------------

--
-- Table structure for table `plats`
--

CREATE TABLE `plats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `prix` float NOT NULL,
  `photo` varchar(256) NOT NULL,
  `id_resto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_resto` (`id_resto`),
  KEY `id_resto_2` (`id_resto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=159 ;

--
-- Dumping data for table `plats`
--

INSERT INTO `plats` (`id`, `nom`, `description`, `prix`, `photo`, `id_resto`) VALUES
(1, 'Classique', 'Tomate, Mozarella, Olives', 8, 'pizza_classique.jpg', 1),
(2, 'Koop-izz-a', 'Tomate, Mozarella, Olives noires.', 10, 'pizza_koopa.jpg', 1),
(3, 'Pizza Peach', 'Crème Fraîche, Mozzarella, Brocoli, Pepperoni, Artichaud.', 11, 'pizza_peach.jpg', 1),
(4, 'Donkey Kong Pizza ', 'Sauce Barbecue, mozzarella, Tomate, Chorizo, Pepperoni.', 12, 'Pizza_donkey.jpg', 1),
(26, 'Boeuf aux Champignons Noirs', 'Boeuf aux Champignons Noirs', 6.2, 'boeufChampignonsNoirs.jpg', 2),
(27, 'Boeuf au Curry', 'Du Boeuf avec du Curry', 6, 'BoeufCurry.jpg', 2),
(28, 'Poulet Ananas', 'Poulet A l''ananas Sauce Aigre Douce', 7.1, 'PouletAnanas.jpg', 2),
(29, 'Porc aux legumes', 'Porc aux legumes à la Sauce piquante', 6.8, 'Porcauxlegumes.jpg', 2),
(30, 'Riz Cantonais', 'Il ne faut pas s''y cantoner.', 3, 'RizCantonais.jpg', 2),
(31, 'Nouilles sautés au poulet', 'Nouilles sautés au poulet', 6, 'NouillesPoulet.jpg', 2),
(32, 'Légumes Chop-Suey', 'Légumes Chop-Suey', 5, 'LegumesChop-Suey.jpg', 2),
(53, 'Maki Concombre', 'Maki Concombre', 4, 'MakiConcombre.jpg', 3),
(54, 'Maki Saumon', 'Maki Saumon', 4.5, 'MakiSaumon.jpg', 3),
(55, 'Maki California Saumon Avocat', 'Maki California Saumon Avocat', 5, 'MakiCalifornia.jpg', 3),
(56, 'Sushi Crevette (2 pièces)', 'Sushi à la Crevette ', 4, 'SushiCrevette.jpg', 3),
(57, ' Sushi Thon (2 pièces)', 'Sushi Thon', 4.5, ' SushiThon.jpg', 3),
(58, 'Sushi Anguille', 'Une occasion comme cela, il ne faut pas la laisser filer.', 7, 'SushiAnguille.jpg', 3),
(59, 'Yakitori Boulettes de Poulet', 'Yakitori Boulettes de Poulet', 3, 'YakitoriPoulet.jpg', 3),
(60, 'Yakitori Boeuf au Fromage', 'Les traditionnelles !!', 4.3, 'YakitoriBoeufFromage.jpg', 3),
(61, 'Yakitori Champignons', 'Yakitori Champignons', 3, 'YakitoriChampignons.jpg', 3),
(62, 'Perle de Coco', 'Perle de Coco', 3, 'PerledeCoco.jpg', 3),
(81, 'Nougat chinois', 'Nougat chinois', 3, 'Nougat.jpg', 3),
(82, 'El chili de los golosos', 'Haricots rouges, boeuf mijoté, riz, fromage, concombre, crème fraîche.', 10.9, 'Elchilidelosgolosos.jpg', 4),
(83, 'Enchilado de queso', 'galette de blé roulée, farcie au fromage, et sa sauce chili.', 9.5, 'Enchilado.jpg', 4),
(84, 'Burrito poulet', 'tortillas de maïs, boeuf, chili, fromage, concombre et sa sauce verte.', 11.2, 'BurritoPoulet.jpg', 4),
(85, 'Burrito boeuf', 'galette croustillante de maïs, boeuf, fromage', 9.9, 'Burritoboeuf.jpg', 4),
(86, 'Fajitas boeuf', 'Fajitas boeuf', 13.5, 'Fajitasboeuf.jpg', 4),
(87, 'Fajitas gambas', 'Fajitas gambas', 17, 'Fajitasgambas.jpg', 4),
(88, 'Las tostadas de la casa', 'Entrée: galettes de maïs croustillantes, boeuf ou poulet, sauce chili, salade', 6, 'Lastostadasdelacasa.jpg', 4),
(89, 'Nachos', 'chips de maïs nappées de fromage fondu avec haricots rouges et jalapenos', 6.5, 'Nachos', 4),
(130, 'Jambon Champignon', 'Sauce Tomate, Mozzarella, Jambon, Champignon.', 12.5, 'pizza_Champi.jpg', 7),
(131, 'Provençale', 'Sauce tomate, mozzarella, tomates fraîches, ail, basilic, olives', 12.5, 'Pizza_Provencale.jpg', 7),
(132, 'Recursive', 'Sauce tomate, pizzas variées.', 11, 'pizza_recursive.jpeg', 7),
(133, 'Aubergina', 'Sauce tomate, mozzarella, aubergines, tomates fraîches', 13, 'Pizza_Aubergina.jpg', 7),
(134, 'Schtroumpf', 'Mini pizzas au bleu.', 13, 'pizza_schroumpf.jpg', 7),
(135, 'Mexicaine', 'Sauce tomate, sauce barbecue, mozzarella, viande hachée, chorizo, champignons, piments forts', 12, 'Pizza_Mexicaine.jpg', 7),
(136, 'Chorizone', 'Crème fraîche, Chorizo, Fromage.', 11, 'pizza_chorizon.jpg', 7),
(137, 'Cyclopéenne', 'Crème fraîche, Mozzarella, Poivron, Olives, Oeuf.', 12, 'pizza_oeuf.jpg', 7),
(138, 'Poulégume', 'Crème fraîche, Poulet, Poivrons, Oignons doux.', 14, 'pizza_poulegume.jpg', 7),
(140, 'Sushi Poulpe', 'Sushi Poulpe', 5.5, 'SushiPoulpe.jpg', 8),
(142, 'Sushi Avocat', 'Sushi Avocat', 3.8, 'SushiAvocat.jpg', 8),
(143, 'Sushi Oeufs de Saumon', 'Sushi Oeufs de Saumon', 5, 'SushiOeufsdeSaumon.jpg', 8),
(144, 'Temaki Saumon Avocat', 'Du Saumon et de l''avocat enroulés dans une feuille d''algue.', 4.5, 'TemakiSaumonAvocat.jpg', 8),
(145, 'Temaki Oeuf de Saumon', 'Temaki Oeuf de Saumon', 6, 'TemakiOeuf.jpg', 8),
(146, 'California Saumon Avocat', 'California Saumon Avocat', 4.5, 'CaliforniaSaumonAvocat.jpg', 8),
(149, 'Maki Homard', 'Avocat, Mayonnaise à l''Estragon', 7.6, 'MakiHomard.jpg', 8),
(150, 'Maki Wasabi', 'Il ne vous restera que les yeux pour pleurer', 6, 'MakiWasabi.jpg', 8),
(153, 'Brochette Boulettes de Poulet', 'Brochette Boulettes de Poulet', 3.5, 'BrochetteBoulettesdePoulet.jpg', 8),
(154, 'Brochette Boeuf', 'Brochette Boeuf', 4, 'BrochetteBoeuf.jpg', 8),
(155, 'Brochette Boeuf au Fromage', 'Brochette Boeuf au Fromage', 4, 'BrochetteBoeufFromage.jpg', 8),
(156, 'Sushi Thon', 'Sushi Thon', 4.5, 'SushiThon.jpg', 8),
(157, 'Aloo Gobi', 'Ca se gobe bien.', 12.95, 'Allo_gobi.jpg', 9),
(158, 'Poulet Tandoori ', 'Très tendre.', 13.75, 'TandooriChicken.jpg', 10);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `adresse` text NOT NULL,
  `contact` varchar(128) NOT NULL,
  `id_theme` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_theme` (`id_theme`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `nom`, `description`, `adresse`, `contact`, `id_theme`) VALUES
(1, 'Chez Mario et Luigi', 'Les pizzaiolos du jeu video !!', '8 rue sous le tuyau.\r\nMarioLand', 'mario@marioland', 4),
(2, 'Fu Mange Tout', 'Le meilleur restaurant chinois de toute la ville.', 'Shangai', 'Fu@MangTout', 1),
(3, 'Les sushis sont secs', 'Une tradition directement venue du Japon. Tous les sushis de vos souhaits !', '32 Rue de Totoro\r\nNancy', 'Sushi@sonsecs', 3),
(4, 'SMSexicain', 'Le meilleur restaurant de TextMex. Tapas et Fajitas à volonté (et plus encore).\r\n\r\nPour ceux qui n''ont pas froid aux yeux', '14 rue de la grand place\r\nLaxouVille\r\n', 'sms@xicain', 2),
(7, 'Pizza the Hut', 'La seule pizzeria qui possède l''achtusse.', '2 impasse de la galaxie\r\nLuxembourgVille', 'pizza@thehut', 4),
(8, 'Yamazaki', 'De nombreux sushis fait avec amour et avec le poisson le plus frais du marché.', '5 Grand Rue\r\nMalzéville', 'yama@saki', 3),
(9, 'Little Pakistan', 'Délices du Pakistan', '12 rue du Faubour des Trois Maison, 54000, nancy', 'little@pakistan', 5),
(10, 'Le Taj Mahal', 'On aime les épices', '45 rue des Fabrique, 54000 Nancy', 'taj@mahal', 5);

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(128) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id`, `nom`, `description`) VALUES
(1, 'Chinois', 'Les saveurs asiatiques prés de chez vous'),
(2, 'Mexicain', 'Ayaya, Caramba !'),
(3, 'Japonais', 'Les livraisons, cela ne pose pas de sushi.'),
(4, 'Pizza', 'Une catégorie a part (!) entière. '),
(5, 'Indien', 'Cuisine Indienne et pakistanaise.');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `plats`
--
ALTER TABLE `plats`
  ADD CONSTRAINT `resto_plat` FOREIGN KEY (`id_resto`) REFERENCES `restaurant` (`id`);

--
-- Constraints for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `resto_theme` FOREIGN KEY (`id_theme`) REFERENCES `theme` (`id`);
