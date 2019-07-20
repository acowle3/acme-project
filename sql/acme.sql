-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2019 at 12:48 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acme`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(10) UNSIGNED NOT NULL,
  `categoryName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Category classifications of inventory items';

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'Cannon'),
(2, 'Explosive'),
(3, 'Misc'),
(4, 'Rocket'),
(5, 'Trap');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comments`) VALUES
(6, 'Aaron', 'Cowley', 'aconditioner@gmail.com', '$2y$10$4j6N0JwG4m/tIqU/IlPHF.7dm0Ad0m.22mYymwHi.qrlQIT6J4X9K', '2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) NOT NULL,
  `imgPath` varchar(150) NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`) VALUES
(5, 8, 'anvil.png', '/cow12005-acme/images/products/anvil.png', '2019-07-07 05:24:32'),
(6, 8, 'anvil-tn.png', '/cow12005-acme/images/products/anvil-tn.png', '2019-07-07 05:24:32'),
(7, 1, 'rocket.png', '/cow12005-acme/images/products/rocket.png', '2019-07-07 05:24:49'),
(8, 1, 'rocket-tn.png', '/cow12005-acme/images/products/rocket-tn.png', '2019-07-07 05:24:49'),
(9, 3, 'catapult.png', '/cow12005-acme/images/products/catapult.png', '2019-07-07 05:25:02'),
(10, 3, 'catapult-tn.png', '/cow12005-acme/images/products/catapult-tn.png', '2019-07-07 05:25:02'),
(11, 14, 'helmet.png', '/cow12005-acme/images/products/helmet.png', '2019-07-07 05:25:13'),
(12, 14, 'helmet-tn.png', '/cow12005-acme/images/products/helmet-tn.png', '2019-07-07 05:25:13'),
(13, 4, 'roadrunner.jpg', '/cow12005-acme/images/products/roadrunner.jpg', '2019-07-07 05:25:28'),
(14, 4, 'roadrunner-tn.jpg', '/cow12005-acme/images/products/roadrunner-tn.jpg', '2019-07-07 05:25:28'),
(15, 5, 'trap.jpg', '/cow12005-acme/images/products/trap.jpg', '2019-07-07 05:25:54'),
(16, 5, 'trap-tn.jpg', '/cow12005-acme/images/products/trap-tn.jpg', '2019-07-07 05:25:54'),
(17, 13, 'piano.jpg', '/cow12005-acme/images/products/piano.jpg', '2019-07-07 05:26:06'),
(18, 13, 'piano-tn.jpg', '/cow12005-acme/images/products/piano-tn.jpg', '2019-07-07 05:26:06'),
(19, 6, 'hole.png', '/cow12005-acme/images/products/hole.png', '2019-07-07 05:26:14'),
(20, 6, 'hole-tn.png', '/cow12005-acme/images/products/hole-tn.png', '2019-07-07 05:26:14'),
(21, 7, 'no-image.png', '/cow12005-acme/images/products/no-image.png', '2019-07-07 05:28:36'),
(22, 7, 'no-image-tn.png', '/cow12005-acme/images/products/no-image-tn.png', '2019-07-07 05:28:36'),
(23, 10, 'mallet.png', '/cow12005-acme/images/products/mallet.png', '2019-07-07 05:29:15'),
(24, 10, 'mallet-tn.png', '/cow12005-acme/images/products/mallet-tn.png', '2019-07-07 05:29:15'),
(25, 9, 'rubberband.jpg', '/cow12005-acme/images/products/rubberband.jpg', '2019-07-07 05:29:31'),
(26, 9, 'rubberband-tn.jpg', '/cow12005-acme/images/products/rubberband-tn.jpg', '2019-07-07 05:29:32'),
(27, 2, 'mortar.jpg', '/cow12005-acme/images/products/mortar.jpg', '2019-07-07 05:29:54'),
(28, 2, 'mortar-tn.jpg', '/cow12005-acme/images/products/mortar-tn.jpg', '2019-07-07 05:29:54'),
(29, 15, 'rope.jpg', '/cow12005-acme/images/products/rope.jpg', '2019-07-07 05:30:20'),
(30, 15, 'rope-tn.jpg', '/cow12005-acme/images/products/rope-tn.jpg', '2019-07-07 05:30:20'),
(31, 12, 'seed.jpg', '/cow12005-acme/images/products/seed.jpg', '2019-07-07 05:30:54'),
(32, 12, 'seed-tn.jpg', '/cow12005-acme/images/products/seed-tn.jpg', '2019-07-07 05:30:54'),
(33, 16, 'bomb.png', '/cow12005-acme/images/products/bomb.png', '2019-07-07 05:31:10'),
(34, 16, 'bomb-tn.png', '/cow12005-acme/images/products/bomb-tn.png', '2019-07-07 05:31:10'),
(35, 11, 'tnt.png', '/cow12005-acme/images/products/tnt.png', '2019-07-07 05:31:24'),
(36, 11, 'tnt-tn.png', '/cow12005-acme/images/products/tnt-tn.png', '2019-07-07 05:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invName` varchar(50) NOT NULL DEFAULT '',
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL DEFAULT '/cow12005-acme/images/products/no-image.png',
  `invThumbnail` varchar(50) NOT NULL DEFAULT '/cow12005-acme/images/products/no-image.png',
  `invPrice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `invStock` smallint(6) NOT NULL DEFAULT '0',
  `invSize` smallint(6) NOT NULL DEFAULT '0',
  `invWeight` smallint(6) NOT NULL DEFAULT '0',
  `invLocation` varchar(35) NOT NULL DEFAULT '',
  `categoryId` int(10) UNSIGNED NOT NULL,
  `invVendor` varchar(20) NOT NULL DEFAULT '',
  `invStyle` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Acme Inc. Inventory Table';

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invName`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invSize`, `invWeight`, `invLocation`, `categoryId`, `invVendor`, `invStyle`) VALUES
(1, 'Acme Rocket', 'The Acme Rocket meets multiple purposes. This can be launched independently to deliver a payload or strapped on to help get you to where you want to be FAST!!! Really Fast! Launch stand is included.', '/cow12005-acme/images/products/rocket.png', '/cow12005-acme/images/products/rocket-tn.png', '132000.00', 5, 60, 90, 'Albuquerque, New Mexico', 4, 'Goddard', 'metal'),
(2, 'Mortar', 'Our Mortar is very powerful. This cannon can launch a projectile or bomb 3 miles. Made of solid steel and mounted on cement or metal stands [not included].', '/cow12005-acme/images/products/mortar.jpg', '/cow12005-acme/images/products/mortar-tn.jpg', '1500.00', 26, 250, 750, 'San Jose', 1, 'Smith & Wesson', 'Metal'),
(3, 'Catapult', 'Our best wooden catapult. Ideal for hurling objects for up to 1000 yards. Payloads of up to 300 lbs.', '/cow12005-acme/images/products/catapult.png', '/cow12005-acme/images/products/catapult-tn.png', '2500.00', 4, 1569, 400, 'Cedar Point, IO', 1, 'Wooden Creations', 'Wood'),
(4, 'Female RoadRuner Cutout', 'This carbon fiber backed cutout of a female roadrunner is sure to catch the eye of any male roadrunner.', '/cow12005-acme/images/products/roadrunner.jpg', '/cow12005-acme/images/products/roadrunner-tn.jpg', '20.00', 500, 27, 2, 'San Jose', 5, 'Picture Perfect', 'Carbon Fiber'),
(5, 'Giant Mouse Trap', 'Our big mouse trap. This trap is multifunctional. It can be used to catch dogs, mountain lions, road runners or even muskrats. Must be staked for larger varmints [stakes not included] and baited with approptiate bait [sold seperately].\r\n', '/cow12005-acme/images/products/trap.jpg', '/cow12005-acme/images/products/trap-tn.jpg', '20.00', 34, 470, 28, 'Cedar Point, IO', 5, 'Rodent Control', 'Wood'),
(6, 'Instant Hole', 'Instant hole - Wonderful for creating the appearance of openings.', '/cow12005-acme/images/products/hole.png', '/cow12005-acme/images/products/hole-tn.png', '25.00', 269, 24, 2, 'San Jose', 3, 'Hidden Valley', 'Ether'),
(7, 'Koenigsegg CCX Car', 'This high performance car is sure to get you where you are going fast. It holds the production car land speed record at an amazing 250mph.', '/cow12005-acme/images/products/no-image.png', '/cow12005-acme/images/products/no-image.png', '99999999.99', 1, 25000, 3000, 'Stockholm, Sweden', 3, 'Koenigsegg', 'Metal'),
(8, 'Anvil', '50 lb. Anvil - perfect for any task requireing lots of weight. Made of solid, tempered steel.', '/cow12005-acme/images/products/anvil.png', '/cow12005-acme/images/products/anvil-tn.png', '150.00', 15, 80, 50, 'San Jose', 5, 'Steel Made', 'Metal'),
(9, 'Monster Rubber Band', '                These are not tiny rubber bands. These are MONSTERS! These bands can stop a train locamotive or be used as a slingshot for cows. Only the best materials are used!            ', '/cow12005-acme/images/products/rubberband.jpg', '/cow12005-acme/images/products/rubberband-tn.jpg', '4.00', 4589, 75, 1, 'Cedar Point, IO', 3, 'Rubbermaid', 'Rubbe'),
(10, 'Mallet', 'Ten pound mallet for bonking roadrunners on the head. Can also be used for bunny rabbits.', '/cow12005-acme/images/products/mallet.png', '/cow12005-acme/images/products/mallet-tn.png', '25.00', 100, 36, 10, 'Cedar Point, IA', 3, 'Wooden Creations', 'Wood'),
(11, 'TNT', 'The biggest bang for your buck with our nitro-based TNT. Price is per stick.', '/cow12005-acme/images/products/tnt.png', '/cow12005-acme/images/products/tnt-tn.png', '10.00', 1000, 25, 2, 'San Jose', 2, 'Nobel Enterprises', 'Plastic'),
(12, 'Roadrunner Custom Bird Seed Mix', '                Our best varmint seed mix - varmints on two or four legs cannot resist this mix. Contains meat, nuts, cereals and our own special ingredient. Guaranteed to bring them in. Can be used with our monster trap.            ', '/cow12005-acme/images/products/seed.jpg', '/cow12005-acme/images/products/seed-tn.jpg', '8.00', 150, 24, 3, 'San Jose', 5, 'Acme', 'Plasti'),
(13, 'Grand Piano', 'This upright grand piano is guaranteed to play well and smash anything beneath it if dropped from a height.', '/cow12005-acme/images/products/piano.jpg', '/cow12005-acme/images/products/piano-tn.jpg', '3500.00', 36, 500, 1200, 'Cedar Point, IA', 3, 'Wulitzer', 'Wood'),
(14, 'Crash Helmet', 'This carbon fiber and plastic helmet is the ultimate in protection for your head. comes in assorted colors.', '/cow12005-acme/images/products/helmet.png', '/cow12005-acme/images/products/helmet-tn.png', '100.00', 25, 48, 9, 'San Jose', 3, 'Suzuki', 'Carbon Fiber'),
(15, 'Nylon Rope', '                This nylon rope is ideal for all uses. Each rope is the highest quality nylon and comes in 100 foot lengths.            ', '/cow12005-acme/images/products/rope.jpg', '/cow12005-acme/images/products/rope-tn.jpg', '15.00', 200, 200, 6, 'San Jose', 3, 'Marina Sales', 'Nylo'),
(16, 'Small Bomb', 'Bomb with a fuse - A little old fashioned, but highly effective. This bomb has the ability to devistate anything within 30 feet.', '/cow12005-acme/images/products/bomb.png', '/cow12005-acme/images/products/bomb-tn.png', '275.00', 58, 30, 12, 'San Jose', 2, 'Nobel Enterprises', 'Metal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`),
  ADD UNIQUE KEY `clientEmail` (`clientEmail`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FK_inv_image` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_image` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `FK_inv_categories` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
