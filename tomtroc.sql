-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 13 oct. 2025 à 14:57
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tomtroc`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `availability` enum('Disponible','Indisponible','','') NOT NULL,
  `publication_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `id_user`, `title`, `author`, `cover`, `description`, `availability`, `publication_date`) VALUES
(1, 4, 'Esther', 'Alabaster', './assets/books/book01.jpg', 'Le Livre d\'Esther: Curieux et excitant, l\'éclat d\'Esther est dans son mystérieux et unique mélange de hasard et de providence divine. Bien que son complot paraisse aléatoire, et rempli de hasard au début, c\'est une invitation à le voir comme une rencontre fatidique avec Dieu. C\'est un encouragement pour nous tous, d\'observer et d\'écouter - avec curiosité et attention - pour le fonctionnement implicite de Dieu dans les moments de l\'autre. Ce n\'est peut-être pas explicite ou ce que nous attendions, mais Dieu est certainement là.', 'Disponible', '2023-03-12 10:15:22'),
(2, 2, 'The Kinfolk Table', 'Nathan Williams', './assets/books/book02.jpg', 'J\'ai récemment plongé dans les pages de \'The Kinfolk Table\' et j\'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. \'The Kinfolk Table\' incarne parfaitement l\'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes.', 'Disponible', '2023-05-08 14:32:10'),
(3, 1, 'Wabi Sabi', 'Beth Kempton', './assets/books/book03.jpg', 'Wabi sabi (\'wah-bi sah-bi\') est un concept captivant de l\'esthétique japonaise, qui nous aide à voir la beauté dans l\'imperfection, à apprécier la simplicité et à accepter la nature transitoire de toutes choses. Avec les racines du zen et la voie du thé, la sagesse intemporelle du wabi sabi est plus pertinente que jamais pour la vie moderne, alors que nous recherchons de nouvelles façons d\'aborder les défis de la vie et de chercher un sens au-delà du matérialisme. Le wabi sabi est un antidote rafraîchissant à notre monde rapide et axé sur la consommation, qui vous encouragera à ralentir, à renouer avec la nature, et à être plus doux sur vous-même. Cela vous aidera à tout simplifier et à vous concentrer sur ce qui compte vraiment. De l\'honneur du rythme des saisons à la création d\'une maison accueillante, de la recadrage au vieillissement à la grâce, le wabi sabi vous apprendra à trouver plus de joie et d\'inspiration tout au long de votre vie parfaitement imparfaite.', 'Disponible', '2023-06-22 09:45:55'),
(4, 6, 'Delight!', 'Justin Rossow', './assets/books/book05.jpg', 'voici le voyage d\'une survie grâce à la poésie voici mes larmes, ma sueur et mon sang de vingt et un ans voici mon cœur dans tes mains voici la blessure l\'amour la rupture la guérison', 'Indisponible', '2023-07-14 16:10:33'),
(5, 8, 'Minimalist Graphics', 'Julia Schonlau', './assets/books/book07.jpg', 'Maia Francisco présente une approche de pointe, moins d\'is-remardes, de design graphique dans le graphisme minimaliste révolutionnaire. À la suite de son label Sourcebook of Contemporary Graphic Design , Francisco présente ce regard éclairant sur les dernières tendances et concepts les plus recherchés de l\'industrie - une ressource efficace et indispensable pour le graphiste moderne., Maia Francisco présente une approche de pointe, moins - plus - plus importante de la conception graphique dans le Minimalist Graphics révolutionnaire. À la suite de son label Sourcebook of Contemporary Graphic Design, Francisco présente ce regard éclairant sur les dernières tendances et concepts les plus recherchés de l\'industrie - une ressource efficace et indispensable pour le concepteur graphique moderne., Les clients et les consommateurs ont besoin de designs, ils peuvent rapidement comprendre des conceptions qui utilisent des lignes et des formes claires, des images et des textes clairs. De cette manière, l\'œuvre de Graphics minimalistes illustre des designs faciles à lire et intemporels de graphistes contemporains qui adoptent des principes minimalistes pour une communication efficace. Avec une introduction explorant l\'histoire et l\'importance du design minimaliste, le graphicsis minimaliste s\'est organisé en sections révélant une richesse de projets d\'identité minimaliste, de publication et de design imprimé. Des informations générales sont fournies pour chaque conception par l\'entreprise qui l\'a créée, et une section de biographie révèle comment chaque entreprise s\'est établie. Le résultat est un livre moderne et très inspirant sur un principe de design intemporel, qui est plus et généralement meilleur.', 'Disponible', '2023-08-01 11:55:44'),
(6, 7, 'Milwaukee Mission', 'Elder Cooper Low', './assets/books/book06.jpg', '  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus id lacus ac risus sodales maximus et eget odio. Morbi gravida leo in eros dapibus, eget cursus odio dapibus. Curabitur consectetur purus viverra maximus dapibus. Praesent porta accumsan lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce in quam nibh. Donec eu fringilla ipsum. Sed feugiat mi et vehicula aliquet. Nam viverra neque nec felis volutpat sagittis. Aenean vel sodales quam, et faucibus velit.  Praesent ut tempor tellus. Donec dictum nibh ex, in faucibus nunc sollicitudin aliquam. Maecenas leo risus, bibendum et nulla et, eleifend finibus justo. Proin a dolor nulla. Donec tincidunt, ipsum sit amet commodo imperdiet, eros arcu vulputate urna, et viverra neque nunc sit amet elit. Vestibulum lacinia pulvinar odio vitae commodo. Pellentesque porttitor sit amet neque sed auctor. Aliquam erat volutpat. Pellentesque accumsan metus eu ipsum tincidunt, vitae mattis nisl commodo. Proin egestas massa est, non vulputate diam sagittis a. Mauris at mi sit amet purus blandit tempor. Aenean vehicula ex quis metus vulputate mollis. Nulla ac felis dolor. Curabitur mollis at ante non gravida. Nam massa lacus, auctor nec convallis sit amet, lacinia a erat. Vestibulum in dui nibh.', 'Disponible', '2023-08-20 08:20:11'),
(7, 5, 'Hygge', 'Meik Wiking', './assets/books/book08.jpg', 'Dans ce best-seller, Meik Wiking, expert en bonheur et PDG de l\'Institut de Recherche sur le Bonheur à Copenhague, présente le concept danois du bien-être, le Hygge. Il explique comment créer une atmosphère chaleureuse et confortable, propice au bonheur, en s\'entourant de choses simples et en partageant des moments de convivialité avec ses proches. À travers des conseils pratiques sur l\'éclairage, la décoration, les repas et même le dressing, il vous apprendra à intégrer le Hygge dans votre quotidien pour vous sentir plus heureux et épanoui', 'Disponible', '2023-09-05 13:47:28'),
(8, 9, 'Innovation', 'Matt Ridley', './assets/books/book09.jpg', 'Sir James Dyson Construit sur son best-seller The Rational Optimist, Matt Ridley relate l\'histoire de l\'innovation et la manière dont nous devons changer notre façon de penser sur le sujet. L\'innovation est le principal événement de l\'ère moderne, la raison pour laquelle nous connaissons à la fois des améliorations spectaculaires de notre niveau de vie et des changements troublants dans notre société. C\'est l\'innovation qui façonnera le XXIe siècle. Pourtant, l\'innovation reste un processus mystérieux, mal compris par les décideurs et les hommes d\'affaires. Matt Ridley fait valoir que nous devons considérer l\'innovation comme un processus incrémental, ascendant et fortuit qui résulte directement de l\'habitude humaine d\'échange, plutôt qu\'un processus descendant ordonné se développant selon un plan. L\'innovation est particulièrement différente de l\'invention, car elle est la transformation d\'inventions en objets d\'utilisation pratique et abordable pour les gens. Elle s\'accélère dans certains secteurs et ralentit dans d\'autres. C\'est toujours un phénomène collectif et collaboratif, impliquant des tâtonnements et des erreurs, et non une question de génie solitaire. Il ne peut toujours pas être modélisé correctement par les économistes, mais il peut facilement être découragé par les politiciens. Loin d\'être trop d\'innovation, nous sommes peut-être au bord d\'une famine de l\'innovation. Ridley tire ces leçons et d\'autres des histoires animées de dizaines d\'innovations – des moteurs à vapeur aux moteurs de recherche – comment ils ont commencé et pourquoi ils ont réussi ou échoué.', 'Disponible', '2023-09-20 17:33:05'),
(9, 10, 'Psalms', 'Alabaster', './assets/books/book10.jpg', 'Des poèmes bruts et honnêtes racontant les histoires des humains et le désir de connaître Dieu. Ce livre ancien et intemporel de poésie et de chants souligne toute la gamme des expériences émotionnelles et spirituelles que nous vivons en tant qu\'êtres humains. Nous apprenons sur le deuil, le chagrin, la lamentation, l\'amour, la joie, le pardon, et ce que cela signifie de se connecter avec Dieu au milieu de nos vies complexes. «Notez-vous, l\'image présentant à la fois la taille standard Mini et Softcover est présentée pour référence visuelle uniquement. Votre commande comprendra un livre dans la taille que vous choisissez.', 'Disponible', '2023-10-02 12:12:50'),
(10, 3, 'Thinking, Fast & Slow', 'Daniel Kahneman', 'assets/books/book11.jpg', 'Un des livres les plus influents du 21ème siècle : le classique de la psychologie révolutionnaire - plus de 10 millions d\'exemplaires vendus - qui a changé notre façon de penser «Il y a eu de nombreux bons livres sur la rationalité humaine et l\'irrationalité, mais un seul chef-d\'œuvre. Ce chef-d\'œuvre est le Financial Times de la pensée, du ralentissement et du ralentissement\'Une vie vaut la sagesse\' Steven D. Levitt, co-auteur de Freakonomics Pourquoi prenons-nous les décisions que nous prenons? Le prix Nobel Daniel Kahneman a révolutionné notre compréhension du comportement humain avec Thinking, Fast and Slow. En distinguant le travail de sa vie, Kahneman a montré qu\'il y a deux façons de faire des choix : une pensée rapide, intuitive et une pensée lente et rationnelle. Son livre révèle comment nos esprits sont trébuchés par l\'erreur, le biais et les préjugés (même lorsque nous pensons que nous sommes logiques) et donne des techniques pratiques qui nous permettent à tous d\'améliorer notre prise de décision. Cette exploration profonde des merveilles et des limites de l\'esprit humain a eu un impact durable sur notre façon de nous voir nous-mêmes. \'Le parrain de la science du comportement ... son analyse aciere de l\'esprit humain et ses nombreux défauts reste peut-être le guide le plus utile pour rester sain d\'esprit et de veille\'.', 'Indisponible', '2023-10-18 15:28:40'),
(11, 11, 'A Book Full Of Hope', 'Rupi Kaur', './assets/books/book12.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus id lacus ac risus sodales maximus et eget odio. Morbi gravida leo in eros dapibus, eget cursus odio dapibus. Curabitur consectetur purus viverra maximus dapibus. Praesent porta accumsan lacus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce in quam nibh. Donec eu fringilla ipsum. Sed feugiat mi et vehicula aliquet. Nam viverra neque nec felis volutpat sagittis. Aenean vel sodales quam, et faucibus velit.  Praesent ut tempor tellus. Donec dictum nibh ex, in faucibus nunc sollicitudin aliquam. Maecenas leo risus, bibendum et nulla et, eleifend finibus justo. Proin a dolor nulla. Donec tincidunt, ipsum sit amet commodo imperdiet, eros arcu vulputate urna, et viverra neque nunc sit amet elit. Vestibulum lacinia pulvinar odio vitae commodo. Pellentesque porttitor sit amet neque sed auctor. Aliquam erat volutpat. Pellentesque accumsan metus eu ipsum tincidunt, vitae mattis nisl commodo. Proin egestas massa est, non vulputate diam sagittis a. Mauris at mi sit amet purus blandit tempor. Aenean vehicula ex quis metus vulputate mollis. Nulla ac felis dolor. Curabitur mollis at ante non gravida. Nam massa lacus, auctor nec convallis sit amet, lacinia a erat. Vestibulum in dui nibh.', 'Disponible', '2023-11-01 09:05:15'),
(12, 13, 'The Subtle Art Of...', 'Mark Manson', './assets/books/book13.jpg', 'Dans ce guide d\'auto-assistance, un blogueur superstar coupe à travers la merde pour nous montrer comment arrêter d\'essayer d\'être \'positifs\' tout le temps afin que nous puissions vraiment devenir des gens meilleurs et plus heureux. Depuis des décennies, on nous dit que la pensée positive est la clé d\'une vie heureuse et riche. « La profane de la population », dit Mark Manson. \'Soyons honnêtes, merde est f-ked et nous devons vivre avec.\' Dans son blog très populaire sur Internet, Manson ne protège pas le sucre ni l\'équipe. Il le dit comme s\'il s\'agissait d\'une dose de vérité brute, rafraîchissante et honnête qui fait cruellement défaut aujourd\'hui. L\'art subtil de ne pas donner un Fôk est son antidote à la morgue, un état d\'esprit tout à fait bien qui a infecté la société américaine et gâché une génération, les récompensant avec des médailles d\'or juste pour se présenter. Manson fait valoir, soutenu à la fois par des recherches universitaires et des blagues de caca bien opportunes, que l\'amélioration de nos vies dépend non pas de notre capacité à transformer les citrons en limonade, mais en apprenant mieux à l\'estomac des citrons. Les êtres humains sont imparfaits et limités. \'Tout le monde ne peut pas être extraordinaire, il y a des gagnants et des perdants dans la société, et certains d\'entre eux ne sont pas justes ou de votre faute.\' Manson nous conseille de connaître nos limites et de les accepter. Une fois que nous embrasserons nos peurs, nos fautes et nos incertitudes, une fois que nous arrêtons de courir et d\'éviter et commencer à faire face à des vérités douloureuses, nous pouvons commencer à trouver le courage, la persévérance, l\'honnêteté, la responsabilité, la curiosité et le pardon que nous recherchons. Il n\'y a que tant de choses que nous pouvons donner à un fôk donc nous devons déterminer lesquelles sont vraiment importantes, Manson le dit clairement. Alors que l\'argent est bien, se soucier de ce que vous faites de votre vie est meilleur, parce que la vraie richesse est une question d\'expérience. Un moment de dialogue réel, rempli d\'histoires divertissantes et profanes, l\'humour impitoyable, l\'art subtil de ne pas donner un flot est une bourdonnement rafraîchissante pour une génération pour les aider à mener des vies contentées et ancrées.', 'Disponible', '2023-11-18 18:45:50'),
(13, 12, 'Narnia', 'C.S Lewis', './assets/books/book14.jpg', 'Le Monde de Narnia est une série de sept romans de fantasy écrits par C.S. Lewis. Les enfants Peter, Susan, Edmund et Lucy Pevensie découvrent par le biais d\'une armoire magique un monde enchanté peuplé de créatures fantastiques. Ils y vivent des aventures extraordinaires, aidés par le puissant Lion Aslan, dans leur lutte contre la Sorcière Blanche. Cette saga mêle merveilleux, courage et valeurs morales.', 'Indisponible', '2023-12-02 14:33:22'),
(14, 13, 'Company Of One', 'Paul Jarvis', './assets/books/book15.jpg', 'Et si la vraie clé d\'une carrière plus riche et plus épanouissante n\'était pas de créer et d\'étendre une nouvelle start-up, mais plutôt de pouvoir travailler pour vous-même, de déterminer vos propres heures et de devenir une entreprise (hautement rentable) et durable d\'une seule? Supposons que la solution la meilleure et plus intelligente soit simplement de rester petite ? Ce livre explique comment faire exactement cela. L\'entreprise de One est une nouvelle approche rafraîchissante centrée sur le fait de rester petit et d\'éviter la croissance, pour toutes les tailles d\'entreprises. Pas en tant que freein qui n\'est payé qu\'à titre individuel, et non pas en tant que start-up entrepreneuriale qui veut s\'étendre le plus rapidement possible, mais en tant que petite entreprise qui s\'engage délibérément à rester ainsi. En restant petit, on peut avoir la liberté de rechercher des plaisirs plus significatifs dans la vie, et d\'éviter les maux de tête qui résultent du traitement des employés, des longues réunions ou de l\'inquiétude à propos de l\'expansion. Company of One présente cette stratégie commerciale unique et explique comment le faire fonctionner pour vous, y compris comment générer des flux de trésorerie sur une base continue. Paul Jarvis a quitté le monde de l\'entreprise quand il s\'est rendu compte que travailler dans un monde à haute pression et très médiatisé n\'était pas son idée de succès. Au lieu de cela, il travaille maintenant pour lui-même hors de sa maison sur une petite île luxuriante au large de Vancouver, et vit une vie beaucoup plus gratifiante et productive. Il n\'a plus à faire face à un environnement qui exige constamment plus de productivité, plus de production et plus de croissance.   Dans Company of One, Jarvis explique comment vous pouvez trouver la bonne voie pour faire de même, y compris la planification de la mise en place de votre magasin, la détermination de vos revenus souhaités, la gestion des crises inattendues, le fait de garder vos clients clés heureux, et bien sûr, de faire tout cela par vous-même.', 'Disponible', '2024-01-05 11:50:30'),
(15, 14, 'The two towers', 'J.R.R. Tolkien', './assets/books/book16.jpg', 'Frodo et les Compagnons de l\'Anneau ont été assaillis par le danger pendant leur quête pour empêcher l\'anneau de décision de tomber entre les mains du Seigneur Noir en le détruisant dans les Cracks of Doom. Ils ont perdu le sorcier Gandalf, dans la bataille avec un esprit maléfique dans les Mines de Moria, et aux chutes de Rauros, Boromir, séduits par la puissance de l\'Anneau, ont essayé de le saisir par la force. Alors que Frodon et Sam s\'échappèrent, le reste de la compagnie fut attaqué par les Orques. Maintenant ils continuent leur voyage seul le long de la grande rivière Anduin - seul, c\'est-à-dire, à l\'exception du mystérieux personnage rampant qui suit partout où ils vont', 'Disponible', '2024-02-10 16:22:44'),
(16, 5, 'Milk & Honey', 'Rupi Kaur', './assets/books/book04.jpg', 'Recueil de poésie de l\'auteure Rupi Kaur, Milk and Honey aborde des thèmes tels que l\'amour, la douleur, la guérison et l\'émancipation. Divisé en quatre parties, ce livre explore les différentes facettes des relations interpersonnelles et de la croissance personnelle, avec des illustrations poignantes accompagnant les poèmes. Les vers simples mais percutants de Kaur ont touché de nombreux lecteurs à travers le monde.', 'Disponible', '2024-03-01 12:10:12'),
(22, 44, 'Le Petit Prince', 'Antoine de Saint-Exupéry', 'https://upload.wikimedia.org/wikipedia/commons/b/b3/Le_Petit_Prince.jpg', 'Un conte poétique et philosophique racontant la rencontre d’un aviateur perdu dans le désert avec un petit prince venu d’une autre planète.', 'Disponible', '1943-04-06 00:00:00'),
(23, 44, 'L\'Étranger', 'Albert Camus', 'https://upload.wikimedia.org/wikipedia/commons/9/97/L%27%C3%89tranger_-_Albert_Camus.jpg', 'Roman existentiel majeur explorant l’absurdité de la vie à travers l’histoire de Meursault.', 'Disponible', '1942-05-19 00:00:00'),
(24, 44, '1984', 'George Orwell', 'https://upload.wikimedia.org/wikipedia/commons/5/51/1984_first_edition_cover.jpg', 'Un roman dystopique sur un futur totalitaire où Big Brother surveille chaque citoyen.', 'Indisponible', '1949-06-08 00:00:00'),
(25, 44, 'Madame Bovary', 'Gustave Flaubert', 'https://upload.wikimedia.org/wikipedia/commons/9/9f/Madame_Bovary_1857_%28hi-res%29.jpg', 'Roman centré sur la vie et les illusions d\'Emma Bovary dans la société provinciale du XIXe siècle.', 'Disponible', '1857-01-01 00:00:00'),
(26, 44, 'Les Misérables', 'Victor Hugo', 'https://upload.wikimedia.org/wikipedia/commons/f/f6/Couverture_de_livraison_pour_une_%C3%A9dition_illustr%C3%A9e_des_Mis%C3%A9rables%2C_2017.0.2918.1.jpg', 'Une fresque puissante de la société française du XIXe siècle, centrée sur la rédemption de Jean Valjean.', 'Disponible', '1862-04-03 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `send_at` datetime NOT NULL,
  `message_read` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `content`, `send_at`, `message_read`) VALUES
(1, 1, 5, 'Bonjour, le livre \"1984\" est-il toujours disponible ?', '2025-09-20 09:15:23', 1),
(2, 5, 1, 'Oui, il est disponible ! Tu veux que je te le réserve ?', '2025-09-20 09:18:45', 1),
(3, 2, 8, 'Peux-tu me dire si \"Le Seigneur des Anneaux\" est facile à lire ?', '2025-09-21 14:32:10', 0),
(4, 8, 2, 'Oui, il se lit très bien, surtout si tu aimes la fantasy.', '2025-09-21 15:10:52', 1),
(5, 3, 6, 'Salut, tu as déjà lu \"L’Étranger\" ? Il vaut le coup ?', '2025-09-22 18:45:01', 1),
(6, 6, 3, 'Oui, c’est un classique, très intéressant à lire !', '2025-09-22 19:05:22', 1),
(7, 4, 7, 'Est-ce que \"La Peste\" est encore emprunté ?', '2025-09-23 11:23:40', 0),
(8, 7, 4, 'Non, il vient d’être rendu hier. Tu veux que je te le prête ?', '2025-09-23 11:50:31', 1),
(9, 9, 12, 'J’ai adoré \"Harry Potter\" que tu m’as prêté, merci !', '2025-09-24 08:12:09', 1),
(10, 12, 9, 'Content que ça t’ait plu 😊 Tu veux la suite ?', '2025-09-24 08:20:44', 1),
(11, 10, 2, 'Salut, pourrais-tu me prêter \"Le Petit Prince\" ?', '2025-09-25 16:44:11', 0),
(12, 2, 10, 'Bien sûr ! Je peux te le donner demain matin.', '2025-09-25 17:01:56', 1),
(13, 11, 13, 'Est-ce que \"Les Misérables\" est très long à lire ?', '2025-09-26 10:22:37', 1),
(14, 13, 11, 'Il est un peu long, oui, mais l’histoire est superbe.', '2025-09-26 10:45:12', 1),
(15, 14, 1, 'As-tu fini \"Dune\" ? Je voudrais l’emprunter ensuite.', '2025-09-27 13:33:59', 1),
(16, 1, 14, 'Presque ! Je te le passe dès que j’ai terminé.', '2025-09-27 13:45:21', 1),
(17, 8, 5, 'Recommandes-tu \"Le Nom du Vent\" ?', '2025-09-28 15:10:00', 1),
(18, 5, 8, 'Absolument, c’est l’un de mes romans préférés.', '2025-09-28 15:34:28', 1),
(19, 12, 3, 'Le livre \"Sapiens\" est-il disponible dans ta bibliothèque ?', '2025-09-29 20:11:17', 1),
(20, 3, 12, 'Oui, il est libre. Tu veux que je te le prête cette semaine ?', '2025-09-29 20:20:41', 1),
(26, 1, 5, 'oui je veut bien merci', '2025-09-30 17:05:04', 1),
(27, 5, 1, 'super je le fait de suite', '2025-09-30 17:24:27', 1),
(28, 1, 5, 'merci !', '2025-10-02 10:34:31', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'assets/users/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `email`, `password`, `creation_date`, `avatar`) VALUES
(1, 'Alexlecture', 'Alexlecture@example.com', '$2y$10$4TTyuqOH8fnTbepaAkU.Uu.3CNkMWw3dn49kbffgS6d3nJvEqIBIm', '2024-01-15 10:23:45', 'assets/users/Alexlecture.jpg'),
(2, 'Nathalire', 'Nathalire@example.com', '$2y$10$uFZl5Rt9fJY6dqXzBgRyM.3QvgxvrBp6Eqv3gp7zZAaLaIykvPLje', '2024-02-03 14:52:12', 'assets/users/Nathalire.jpg'),
(3, 'Sas634', 'Sas634@example.com', '$2y$10$X/bZ9Z4DfysQAMe07wqCXeyI.t4jhyulFP5cufpG4XH6VcEwxZEvu', '2024-03-22 09:18:30', 'assets/users/Sas634.jpg'),
(4, 'CamilleClubLit', 'CamilleClubLit@example.com', '$2y$10$aofrpuqz.LtJIfoMdYTvo.MlEnzZkUWFDRgHYZuMEU7GW/DtBNQRC', '2024-04-05 11:05:20', 'assets/users/default.png'),
(5, 'Hugo1990_12', 'Hugo1990_12@example.com', '$2y$10$dHG0CKjk4NlnYe1vMkc49exNxHjvmYsmjWd.8IbAQWsuTa5sY7Pjq', '2024-04-18 16:42:10', 'assets/users/default.png'),
(6, 'Juju1432', 'Juju1432@example.com', '$2y$10$/ma/gNUgQO4/Lvo.PU6Pw.WcSWZyg9s1u6OJsXjH8L1OyMBAvZZeK', '2024-05-02 08:30:55', 'assets/users/default.png'),
(7, 'Christiane75014', 'Christiane75014@example.com', '$2y$10$58JlTe1HTa7Ug/HWEF6zG.GTgsSAU88BxstfM6XCQTUIq6TsyKyqm', '2024-05-15 12:17:40', 'assets/users/default.png'),
(8, 'Hamzalecture', 'Hamzalecture@example.com', '$2y$10$qPrPhpQTsTbKOUEJj2WFhOcY.L/5N5rpvnybUbVkIZiLmm5nzdgi6', '2024-06-01 09:55:30', 'assets/users/default.png'),
(9, 'Lou&Ben50', 'Lou&Ben50@example.com', '$2y$10$.aJhMn6ZXL4IyWfOVWOc8OsatLI0hcBAa.rn0cchTeS0NtsVkpfMe', '2024-06-18 15:40:05', 'assets/users/default.png'),
(10, 'Lolobzh', 'Lolobzh@example.com', '$2y$10$MUVGoXUzOFFpfhiPkf8uP.Rif/mq4YAxH9jmCcgNZzLAwFkqlE4fq', '2024-07-05 10:20:50', 'assets/users/default.png'),
(11, 'ML95', 'ML95@example.com', '$2y$10$VXxZ44qMWF9VnwL.NSVgDuudS2fuAjEMM9dmcKTkSIezIEYOtD7r6', '2024-07-22 18:05:15', 'assets/users/default.png'),
(12, 'AnnikaBrahms', 'AnnikaBrahms@example.com', '$2y$10$MVCTISRUTXG5fgxDTw.65.sgul484N5sb2HDX4tGNj0sQB4P.lhJK', '2024-08-10 13:33:00', 'assets/users/default.png'),
(13, 'Victoirefabr912', 'Victoirefabr912@example.com', '$2y$10$3znqR0ORjMiT3snOhHNKPO1k5YvAkQrvFq5rjOQm3DoWpeQEkqaIi', '2024-08-28 11:10:45', 'assets/users/default.png'),
(14, 'Lotrfanclub67', 'Lotrfanclub67@example.com', '$2y$10$pIq6pO1kUk4xWWHe.T0HE.1NObIjWInzhgbxeMkwdTOL1Nk27/7s2', '2024-09-12 09:45:30', 'assets/users/default.png'),
(44, 'Greg', 'gregoryvericel6@gmail.com', '$2y$10$xg83sHfnS3v018CaLjYYDuY8ewo7eW/pK1ZW82866MLs4IfegdWum', '2025-05-24 09:51:16', 'assets/users/68da6fd6f2a1a_greg.jpg'),
(45, 'Greg2', 'melvericel@yahoo.fr', '$2y$10$E37JZW9dkwKAbdX8ija72OwA0xTEE2g7Zct53kP3aV3WmzJvKuoGS', '2025-09-29 10:51:16', 'assets/users/default.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_user_fk_1` (`id_user`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_fk_1` (`sender_id`),
  ADD KEY `messages_user_fk_2` (`receiver_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `books_user_fk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `messages_user_fk_1` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_user_fk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
