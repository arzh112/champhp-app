-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 10 sep. 2023 à 14:17
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `champhp-db`
--

-- --------------------------------------------------------

--
-- Structure de la table `mushrooms`
--

DROP TABLE IF EXISTS `mushrooms`;
CREATE TABLE IF NOT EXISTS `mushrooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `latin_name` varchar(45) DEFAULT NULL,
  `genus` varchar(45) DEFAULT NULL,
  `habitat` text,
  `category` enum('Comestible','Indigeste','Toxique','Mortel') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` mediumtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `main_picture` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `mushrooms`
--

INSERT INTO `mushrooms` (`id`, `name`, `latin_name`, `genus`, `habitat`, `category`, `description`, `main_picture`) VALUES
(1, 'Amanite tue-mouche', 'Amanita muscaria', 'Amanita', 'Amanita muscaria est un champignon cosmopolite, qui croît dans les forêts de conifères et de feuillus de toutes les régions tempérées et boréales de l\'hémisphère nord.', 'Toxique', 'Amanita muscaria développe un sporophore de grande taille facilement identifiable. L\'amanite tue-mouches émerge du sol sous l\'apparence d\'un œuf, enveloppé dans le tissu pelucheux du voile universel. La dissection du champignon à ce stade révèle une couche jaune sous le voile, caractéristique qui aide à l\'identifier. Au cours de la croissance, la couleur rouge apparaît à travers le voile rompu, et les verrues deviennent moins proéminentes ; elles ne changent pas de taille mais semblent peu à peu rétrécir par rapport à la surface de chair rouge. Le chapeau, initialement globuleux, change de forme pour devenir hémisphérique, puis de plus en plus plat à mesure de la maturation1. ', 'Fly_Agaric_mushroom.jpg'),
(2, 'Cèpe de Bordeaux', 'Boletu edulis', 'Boletus', 'Le cèpe de Bordeaux est un champignon mycorhizien, c\'est-à-dire qu\'il vit en symbiose avec certains arbres hôtes comme le chêne, le châtaignier, le hêtre, l\'épicéa et le sapin pectiné (mais pas avec le sapin de douglas, dont les plantations en masse constituent une menace pour le cèpe). Il pousse le plus souvent sur sols acides, dans les endroits dégagés ou aérés, les clairières, les talus bordés d\'arbres et les bords des chemins. Cependant, il affectionne également les sous-bois denses et peu exposés à la lumière, comme ceux formés par les jeunes plantations d\'épicéas. ', 'Comestible', 'Le champignon est formé d\'un chapeau, d\'un pied et du mycelium qui lui permet pendant des années d\'échanger avec certains arbres des substances nutritives. La surface du chapeau présente une couleur de brun clair à brun foncé, avec une marge ornée d\'un fin liseré blanc. Adulte, le chapeau va s\'étaler, prendre la forme d\'un coussinet, ses bords vont se relever et son pied va s\'enfler. La chair est blanche et ne change pas de couleur quand on tranche le champignon.', 'boletus_edulis.jpg'),
(3, 'Girolle', 'Cantharellus cibarius', 'Cantharellus', 'Cantharellus cibarius pousse dans les contrées tempérées, sous les arbres feuillus (bouleau) comme sous résineux, plutôt sur terrain acide, du tout début de l\'été à la fin de l\'automne selon les régions : de la mi-juillet à mi-septembre au Québec, de la fin du mois d\'août à la fin d\'octobre dans les Ardennes. Elle disparaît aux premières gelées mais peut se récolter à Noël près de la Méditerranée. Elle est parfois grégaire et est fidèle à ses emplacements.', 'Comestible', 'Chapeau de 4 à 10 cm de diamètre, d\'abord convexe puis s\'aplatissant et se creusant en coupe ou calice, pour devenir typiquement infundibuliforme. Cuticule jaune pâle à jaune d\'œuf plus ou moins orangé ; marge un peu enroulée, sinueuse et même lobée.\r\n\r\nHyménium concolore, constitué, comme chez toutes les espèces du genre Cantharellus, de plis lamelliformes ramifiés et interveinés, très décurrents sur le pied.\r\n\r\nChair épaisse, un peu fibreuse dans le pied, blanc crème, rarement véreuse, plutôt ferme mais éventuellement imbue après des pluies répétées.\r\n\r\nOdeur fruitée, parfois comparée à celle de la mirabelle, mais surtout proche de l\'abricot22. Saveur dite \"douce\" (au sens des mycologues = non âcre ni amère, donc \"neutre\"). Selon Roger Heim, Ramain, Fauvel... la girole fraîche et crue a une saveur acidulée caractéristique, devenant très agréable après la cuisson.  ', 'cantharellus_cibarius.jpg'),
(4, 'Trompette de la mort', 'Craterellus cornucopioides', 'Craterellus', 'Cette espèce, très répandue, pousse par groupes essentiellement dans les forêts de feuillus (hêtres, chênes, châtaigniers, noisetiers) ou parfois sous les forêts de conifères, appréciant les sols lourds et très humides (argileux, par exemple). Ces chanterelles poussent en troupes, presque en tapis au sein de la litière des feuilles mortes, dans les lieux sombres. Elles apparaissent en automne (d\'août à novembre), et peuvent être très abondantes après de fortes pluies. Ce champignon est parfois difficile à distinguer du sol à cause de sa couleur sombre, de sa forme irrégulière, de sa petite taille et parce qu\'il est souvent recouvert de feuilles mortes.', 'Comestible', 'Le sporophore qui dépasse rarement 10 cm est très peu charnu et entièrement creux, en forme de trompette (cantharelloïde), évasé en entonnoir avec une marge largement festonnée et irrégulière. La cuticule est couverte d\'écailles (squameuse), gris noir à brun sombre ou fauve en fonction du degré hygrométrique ; le pied est creux, de la même couleur que le chapeau et s\'amincissant à la base. La face externe qui porte l\'hyménium onduleux est gris bleuté. Son odeur est agréable : mélange humide, fongique et fruité rappelant la mirabelle', 'craterellus_cornucopioides.jpg'),
(5, 'Amanite phalloïde', 'Amanita phalloides', 'Amanita', 'Il est associé par mycorhize avec de nombreuses espèces d\'arbres. En Europe, cela inclut de nombreux feuillus et, moins fréquemment, des conifères. Il apparaît communément sous des chênes, mais également sous des hêtres, des châtaigniers, des marronniers, des bouleaux, des noisetiers, des charmes, des pins et des épicéas. Dans certaines régions, A. phalloides peut également être associée avec ces arbres en général ou bien seulement certains d\'entre eux. Sur le littoral californien, par exemple, A. phalloides est associée avec des chênes, mais pas avec les espèces locales de pins, comme le pin de Monterey.', 'Mortel', 'L’amanite phalloïde apparaît après une période de pluie de la fin de l’été jusqu\'en automne. Son odeur est décrite comme initialement faible et sucrée, mais se renforçant au cours du temps pour devenir écœurante et désagréable.\r\nAmanite phalloïde jeune.\r\n\r\nLes jeunes spécimens émergeant du sol ressemblent à un œuf blanc couvert d\'un voile, dont la volve et l\'anneau sont des reliquats. Ils présentent ensuite un corps large, avec un chapeau de 5 à 15 cm, rond et hémisphérique au début, puis aplati avec l’âge. La couleur du chapeau peut être vert pâle, vert-jaune ou vert olive, souvent plus pâle sur les bords et après la pluie. La surface du chapeau est gluante quand elle est mouillée et s\'épluche facilement, caractère naïvement attribué aux champignons comestibles. Une partie du voile initial forme un anneau mou, comme une jupe, d’environ 1 à 1,5 cm sous le chapeau. Les lames blanches sont nombreuses et libres. Le pied est blanc, chiné de gris olivâtre, long de 8 à 15 cm et épais de 1 à 2 cm, avec à sa base une volve blanche membraneuse en forme de sac. La présence de la volve est une caractéristique principale pour permettre l\'identification du champignon, il est donc important de bien déblayer autour du pied pour chercher sa présence. Elle peut toutefois manquer, mangée par des limaces. ', 'amanita_phalloides.jpg'),
(6, 'Galère marginée', 'Galerina marginata', 'Galerina', 'Galerina marginata est très répandu dans l\'hémisphère nord, y compris en Europe, Amérique du Nord et en Asie et a également été trouvé en Australie. Il s\'agit d\'un champignon poussant principalement sur les bois de conifères en décomposition. ', 'Mortel', 'Galerina marginata, la galère marginée, est une espèce de champignons basidiomycètes vénéneux de l\'hémisphère nord du genre Galerina, de la famille des Hymenogastraceae et de l\'ordre des Agaricales.\r\n\r\nLes sporophores de ce champignon sont bruns à beiges, perdent leur couleur au séchage, Ils sont hygrophanes. Les lames sont brunâtres et donnent une impression de spores rouille.\r\n\r\nUn anneau membraneux bien net est généralement visible sur le stipe de jeunes spécimens, mais disparaît souvent avec l\'âge. Sur les vieux sporophores, les hyménophores sont plus plats et les lames et les pieds sont bruns. \r\nHyménophore convexe, d\'un diamètre de 3 à 5 centimètres. Le stipe mesure de 2 à 6 cm, et porte un petit anneau fragile.\r\nL\'espèce est un classique petit champignon brun et peut être facilement confondu avec plusieurs espèces comestibles. Sa confusion avec Kuehneromyces mutabilis, la Pholiote changeante, peut être très facile.', 'galerina_marginata.jpg'),
(7, 'Bolet de Satan', 'Rubroboletus satanas', 'Rhubroboletus', 'Appréciant les sols calcaires, il apparaît en été et au début de l’automne dans les régions méridionales dans les bois de feuillus, sous les hêtres, les chênes, ou les charmes. Assez rare, surtout dans les régions du nord, le bolet ne pousse que pendant les périodes chaudes et ensoleillées. ', 'Toxique', 'Le Bolet satan est le plus gros des Bolets d\'Europe, son chapeau généralement de 10 à 25 cm de diamètre peut atteindre voire dépasser 30 cm. Blanc pur au départ, il ressemble alors à une boule de neige, il s\'étale ensuite en un large dôme aplati et tourne au grisâtre aux reflets verdâtres. Il est le seul bolet à chapeau blanchâtre sans nuance de rose, avec des pores rouge vif, et un pied très gros et nettement renflé à la base. Il dégage une odeur forte, de plus en plus écœurante avec l\'âge, et sa chair blanchâtre, bleuissant au contact de l\'air, pourrit facilement. Le pied court et renflé fait 5 à 15 cm de long pour 4 à 12 cm de large, et est rouge au milieu avec les deux extrémités plus jaunes. Les pores sont au départ orangés, et virent au rouge vif avec l\'âge.\r\nMalgré son nom, le Bolet satan n\'est pas réellement dangereux pour un adulte en bonne santé, mais sa consommation entraînera nausées, diarrhées et vomissements et sa toxicité apparaît variable selon les individus. Même cuite, sa chair reste nocive, des intoxications sévères ayant été observées chez des personnes qui ont consommé des sujets jeunes et bien cuits. Ces intoxications sont extrêmement rares, son aspect caractéristique, son odeur repoussante et le fait qu\'il devienne très rapidement véreux dissuadant de la consommer.', 'rubroboletus_satanas.jpg'),
(8, 'Marasme des Oréades', 'Marasmius oreades', 'Marasmius', 'Le Marasme des Oréades pousse du printemps à l\'automne, souvent en grand nombre (en touffes, alignés formant des veines qui suivent les racines sous-jacentes ou parfois en ronds de sorcières) dans les clairières, prairies, voire pelouses, et au bord des chemins4. Dans l\'Est du Canada, il pousse de juin à octobre, uniquement sur les pelouses.\r\n\r\nLa larve du coléoptère Pseudovadonia livida se développe dans l\'humus et s\'y nourrit du mycélium du Marasme des Oréades.', 'Comestible', 'Le marasme des Oréades (Marasmius oreades), ou faux mousseron, cariolette, coriolette ou carrioleta, appelé aussi « bouton de guêtres », est une espèce de champignons basidiomycètes de la famille des Marasmiaceae.\r\n\r\nLe genre Marasmius auquel il appartient compte de nombreuses espèces caractérisées par leur résistance à la pourriture et leur aptitude à reprendre après dessiccation leur consistance première si on les humecte.\r\n\r\nBien que l\'on trouve ce champignon jusqu\'en plaine, les Oréades auxquelles il est dédié sont, comme leur nom1 l\'indique, des nymphes des montagnes.\r\n\r\nQuant à l\'appellation « faux mousseron », elle le distingue des nombreuses autres espèces baptisées « mousseron » selon les régions, dont le tricholome de la Saint-Georges qui pour les puristes serait le mousseron vrai. Lequel d\'entre les mousserons est à l\'origine de l\'anglais mushroom est bien difficile à dire. \r\nLes marasmes comptent, comme dit plus haut, de très nombreuses espèces assez semblables, ne différant parfois que par des caractères microscopiques, et qui ne sont pas toutes aussi goûteuses, voire pas toutes comestibles.\r\n\r\nLes débutants pourront également confondre, sans grand danger, Marasmius oreades avec certains laccaires, à la couleur plus uniforme et l\'habitat plus forestier. D\'autres confusions plus grossières avec de petits clitocybes comme le clitocybe laiteux, de taille similaire, avec un pied légèrement plus épais et un peu plus blanc avec des lamelles plus serrées et décurrentes ou inocybes poussant dans l\'herbe ont été signalées. La prudence est de mise, car par exemple, le clitocybe laiteux est considéré comme très toxique. ', 'marasmius_oreades.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `picture_path` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `size` int DEFAULT NULL,
  `upload_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `mushrooms_id` int NOT NULL,
  `users_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pictures_mushrooms1_idx` (`mushrooms_id`),
  KEY `fk_pictures_users1_idx` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `pictures`
--

INSERT INTO `pictures` (`id`, `title`, `picture_path`, `type`, `size`, `upload_date`, `mushrooms_id`, `users_id`) VALUES
(2, 'am_tue_mouche_3.jpg', 'am_tue_mouche_3.jpg', 'image/jpeg', 580291, '2023-09-10 12:35:06', 1, 2),
(3, 'cepe_bordeaux.jpg', 'cepe_bordeaux.jpg', 'image/jpeg', 12667, '2023-09-10 12:43:33', 2, 2),
(4, 'girolle_3.jpg', 'girolle_3.jpg', 'image/jpeg', 8381, '2023-09-10 12:50:14', 3, 2),
(5, 'trompette_2.jpg', 'trompette_2.jpg', 'image/jpeg', 8647, '2023-09-10 12:51:29', 4, 1),
(6, 'amanite_p_2.jpg', 'amanite_p_2.jpg', 'image/jpeg', 7377, '2023-09-10 12:51:44', 5, 1),
(7, 'cepe_2.jpg', 'cepe_2.jpg', 'image/jpeg', 9648, '2023-09-10 12:52:22', 2, 2),
(8, 'girolle_2.jpg', 'girolle_2.jpg', 'image/jpeg', 5373, '2023-09-10 12:52:51', 3, 2),
(9, 'trompette_3.jpg', 'trompette_3.jpg', 'image/jpeg', 9416, '2023-09-10 12:53:04', 4, 2),
(10, 'gal_marg_2.jpg', 'gal_marg_2.jpg', 'image/jpeg', 12938, '2023-09-10 12:53:18', 6, 2),
(11, 'cepe_3.jpg', 'cepe_3.jpg', 'image/jpeg', 8973, '2023-09-10 12:53:39', 2, 1),
(12, 'gal_marg_3.jpg', 'gal_marg_3.jpg', 'image/jpeg', 10281, '2023-09-10 12:53:52', 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `admin_status` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `admin_status`) VALUES
(1, 'admin@admin.com', 'admin', '$2y$10$wEq8B8z6dsTlG52w/csXgesgHAXOGfDilrMycXkYvFFJeHkHJkWwK', 1),
(2, 'user@user.com', 'user', '$2y$10$9P00clv2YMqA7w4Z.y9zg.ihu.0vdi599ILw9CsIEAS9uO2/qMr/C', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `fk_pictures_mushrooms1` FOREIGN KEY (`mushrooms_id`) REFERENCES `mushrooms` (`id`),
  ADD CONSTRAINT `fk_pictures_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
