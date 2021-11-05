-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2021 at 04:36 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel_articles`
--

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `title`, `description`, `image`, `location`, `article`, `reference`, `password`, `create_date`) VALUES
('DOaj3abw', 'Ella Pavilion', 'Situated in the eastern part of misty central hills; 200M from te city center and 10 minutes walk from Ella train station. With a view of World famous Ella Gap and Ella rock. We serve authentic SriLankan food, Cocktails and Beer.', 'hotelsimages/DOaj3abwMicrosoftTeams-image (1).png', '', 'https://g.page/ellapavilion?share', 'https://g.page/ellapavilion?share', 'ell123Pavil', '2021-09-01 14:44:32'),
('racYugqF', 'Orchid Villa Kandy', 'Orchid Villa Kandy, the beautiful boutique villa unfolds beautiful panoramic views towards the hills where you can watch the sunset fade into the sculpted mountainside. The hotel is elevated making it the perfect serene hideaway with luxurious appointments to fascinate and mesmerize every guest. This villa is perfect for families, friends and for intimate gatherings. The unique and boutique style of Orchid Villa is truly a transformative experience. Apart from the luxurious bedrooms within the main hotel, t', 'hotelsimages/racYugqFMicrosoftTeams-image (2).png', 'https://goo.gl/maps/Thn75DefMNPAXDxb6', 'https://www.booking.com/hotel/lk/orchid-villa-kandy.html', 'https://www.booking.com/', 'Orchid123la', '2021-09-01 14:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `title`, `description`, `image`, `location`, `article`, `reference`, `password`, `create_date`) VALUES
('764tJl3H', 'Ella', 'Ella (Sinhala: ඇල්ල; Lit. \"water fall\"; Tamil: எல்ல) is a small town in the Badulla District of Uva Province, Sri Lanka governed by an Urban Council. It is approximately 200 kilometres (120 mi) east of Colombo and is situated at an elevation of 1,041 metres (3,415 ft) above sea level. The area has a rich bio-diversity, dense with numerous varieties of flora and fauna. Ella is surrounded by hills covered with cloud forests and tea plantations. The town has a cooler climate than surrounding lowlands, due t', 'placesimages/764tJl3HMicrosoftTeams-image.png', 'https://goo.gl/maps/hLaWEYZxnEF1jFgi9', 'https://en.wikipedia.org/wiki/Ella,_Sri_Lanka', 'https://en.wikipedia.org/wiki/Main_Page', 'ella123El', '2021-09-01 14:24:21'),
('Ej7IXKMr', 'Temple of the Tooth', 'Temple of the Sacred Tooth Relic commonly known as the ශ්‍රී දළදා මාළිගාව (Glorious Tooth Temple), is a Buddhist temple in Kandy, Sri Lanka. It is located in the royal palace complex of the former Kingdom of Kandy, which houses the relic of the tooth of the Buddha.', 'placesimages/Ej7IXKMrTemple.jpg', 'Link https://goo.gl/maps/t6ogFnvf2EJrxjdi6 by IHA PRAVEEN\r\nIHA PRAVEEN5:10 PM\r\nhttps://goo.gl/maps/t6ogFnvf2EJrxjdi6', 'https://en.wikipedia.org/wiki/Temple_of_the_Tooth', 'https://en.wikipedia.org/wiki/Main_Page', 'Temple123df', '2021-09-01 13:44:23'),
('Q2xM0GOs', 'Yala National Park', 'Yala National Park is a huge area of forest, grassland and lagoons bordering the Indian Ocean, in southeast Sri Lanka. It’s home to wildlife such as leopards, elephants and crocodiles, as well as hundreds of bird species. Inland, Sithulpawwa is an ancient Buddhist monastery. Nearby caves contain centuries-old rock paintings. Southwest, Magul Maha Viharaya also has ancient Buddhist ruins. ', 'placesimages/Q2xM0GOsYala.jpg', 'https://g.page/yalasrilanka?share', 'https://www.yalasrilanka.lk/about-yala.html', 'www.yalasrilanka.lk', 'yala123La', '2021-09-01 14:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

CREATE TABLE `transport` (
  `id` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `article` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transport`
--

INSERT INTO `transport` (`id`, `title`, `description`, `image`, `location`, `article`, `reference`, `password`, `create_date`) VALUES
('mrmo0nm4', 'travellogic.lk', 'Enjoy your freedom with travellogiclk We are travellogiclk . We provide easy way to organise hiring a motor bike while you were in Srilanka. business is to give customers easy and affordable alternative of travelling because most of the young tourists organize and travel themselves without any travel agent or travel guide consult', 'transportimages/mrmo0nm4MicrosoftTeams-image (3).png', '', 'https://travellogic.lk/', 'https://travellogic.lk/', 'travel123Logic', '2021-09-01 14:47:01'),
('TVmrjosX', 'Private safari Tours at Yala national park (Fullday/Halfday/4Hours)', 'Yala harbours 215 bird species including six endemic species of Sri Lanka. The number of mammals that has been recorded from the park is 44, and it has one of the highest leopard densities in the world. You can see wild life animals specially Leopard, Sloth Bear, Elephants, Spotted Deers,Crocodiles, Wild Boars, Wild Buffalos, Sambur Deers and lot of animals and nature. There are so much beautiful places to see.', 'transportimages/TVmrjosX75.jpg', '', 'https://www.viator.com/tours/Yala-National-Park/Yala-National-Park/d24382-134659P2', 'https://www.viator.com/Sri-Lanka-tours/Transfers-and-Ground-Transport/d19-g15', 'yala123Safari', '2021-09-01 15:09:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
