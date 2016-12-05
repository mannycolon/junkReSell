-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2016 at 10:44 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `junkReSell_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `adminID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`adminID`, `email`, `password`, `fullName`) VALUES
(1, 'admin@aol.com', 'testing1234', 'John Admin');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`) VALUES
(1, 'Electronics'),
(2, 'Sporting Goods'),
(3, 'Home and Garden'),
(4, 'Clothing'),
(5, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `orderItems`
--

CREATE TABLE `orderItems` (
  `id` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `abbrvName` varchar(60) DEFAULT NULL,
  `productPrice` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `dateAdded` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(1, 1, 'Samsung 720p LED TV (2014 Model)', 'samsungTV', '650.00', 'Ideal for placement in a bedroom or dorm room, this\n 720p Samsung HDTV delivers a wide variety of colors and clarity, allowing you to relax and enjoy your\n favorite movies and shows. Connect your USB device directly for access to your photos, videos and music.', '2016-09-23'),
(2, 1, 'Apple iPad Air 16GB WiFi', 'iPad', '379.00', 'For tech connoisseurs, the lighter and thinner the design, the more desirable\n  that piece of hardware is. Designed for true techies, the Apple iPad Air is 20 percent thinner than the standard iPad,\n  and weighs just one pound, so it feels unbelievably light in your hand. It comes with a 9.7" Retina display, the A7\n  chip with 64-bit architecture, ultrafast wireless, powerful apps, and up to 10 hours of battery life. And over 475,000\n  apps in the App Store are just a tap away on the Apple iPad Air. ', '2016-10-06'),
(3, 1, 'Apple MacBook Pro 13.3" With Touch Bar', 'macbook-pro-2016', '1799.00', 'It is faster and more powerful than before,\n  yet remarkably thinner and lighter. It has the brightest, most colorful Mac notebook display ever. And it introduces\n  the Touch Bar: a Multi-Touch enabled strip of glass built into the keyboard for instant access to the tools you want,\n  right when you want them. The new MacBook Pro is built on groundbreaking ideas. And it is ready for yours.', '2016-11-26'),
(4, 1, 'Amazon Echo Dot', 'echodot', '50.00', 'Deliver your favorite playlist anywhere in your home with the Amazon Echo\n  Dot voice-controlled device. Control most electric devices through voice activation, or schedule a ride with Uber and\n  order a pizza. The Amazon Echo Dot voice-controlled device turns any home into a smart home with the Alexa app on a\n  smartphone or tablet.', '2016-11-26'),
(5, 2, 'TRUE Xcore 9 Hockey Stick', 'hockeystick', '279.00', 'If you thought TRUE was a new company, guess again. With over 14 years\n  of experience and over 2 million sticks produced for leading hockey companies, TRUE is making a splash into the stick market\n   by coming direct to you! As the world leader of golf shaft technology TRUE is set on providing the hockey industry with\n   superior stick designs made from the highest quality materials and strictest manufacturing processes. Bent on providing pure\n    domination at every level of the game, our latest elite pro stick, the Xcore 9 was designed with just that in mind.', '2016-11-26'),
(6, 2, 'adidas Euro 16 Top Glider Soccer Ball', 'soccerball', '32.00', 'Part of the Euro 2016 Collection, this ball is a 1:1 takedown\n  of the official match ball used by professional soccer players in the European Championship games. Machine stitched construction\n  and internal nylon wound carcass for maximum durability and long-lasting performance.', '2016-11-26'),
(7, 2, 'Silverback In-Ground Basketball System', 'basketballhoop', '499.00', 'The\n  Silverback SB60 and SB54, our premier in-ground basketball goals, are anchored into the ground and feature a tempered\n  glass backboard and an all-steel pole, offering the performance of a gymnasium style goal.', '2016-11-26'),
(8, 2, 'MD Sports 84 in. Arcade Billiard Table', 'billiardtable', '599.00', 'This handsome billiard table offers a more\n  modern style, with a playing surface of red felt that is perfectly contrasted by the black-and-metal color scheme of\n  the body. The steel frame keeps the body flat and level at all times, while all those balls you are putting away are\n  tucked safely in fabric nets on each hole. The block legs have a sleek, contemporary style while employing adjustable\n  levelers to make sure that your table is always on sure footing. This table also includes a rack, a full set of balls and\n   cues, so you are ready to start hustling the room as soon as it arrives.', '2016-11-26'),
(9, 3, 'Madison Park Maxwell Chair (Red)', 'maxwellchair', '297.00', 'This classic wing chair with its button tufted detailing and\n  sloped arms adds a casual twist with its russet red casual woven fabric.', '2016-11-26'),
(10, 3, 'Char-Broil Classic 4-Burner Gas Grill', 'grill', '200.00', 'For larger families or cookouts, the Char-Broil Classic\n  4-burner gas grill has the features and performance providing everything you need in a grill and more. Features a large\n  480 square inch cooking area and 180 square inch swing-away warming rack, both providing plenty of cooking space. Grill\n  up your favorites with the powerful and durable burners that heat up quickly and deliver even grilling. ', '2016-11-26'),
(11, 3, 'GardenHOME Ergonomic Garden Tools 4 Piece Tool Set', 'gardentools', '15.00', 'The GardenHOME Ergonomic Garden Tool 4-pack\n  includes a trowel, a cultivator, a trans-planter and a fork. High resistance cast-aluminum heads are easy to clean, rust\n  resistant and great looking. Each ergonomically-designed handle fits your hand naturally, encouraging a neutral wrist position,\n  which in turn helps reduce hand stress and fatigue.', '2016-11-26'),
(12, 3, 'Oster 6595 Inspire 2-Slice Toaster, Red/Black', 'ostertoaster', '30.00', 'Beautifully housed in a red metallic housing\n  with black accents, this two-slice toaster from Oster not only looks great in any contemporary kitchen, but it also features\n  extra-wide slots that can accommodate a variety of bread types, including thick bagel halves, hamburger buns, English muffins,\n  hearty slices of artisan-style bread, frozen waffles, and other toast-able favorites. Dual bread guides automatically adjust to\n  the thickness of the slices for perfect alignment and even browning on both sides, while a high-lift lever promotes safe removal\n  of toasted items-even smaller pieces. ', '2016-11-26'),
(13, 4, 'Face N Face Womens High Waisted A line Street Skirt', 'skirt', '19.00', 'Superior in material and excellent in workmanship,\n  this skirt is perfect for everyday and formal wear. Fit for all 4 seasons, easy to match your favorite tops and shoes.', '2016-11-26'),
(14, 4, 'Gildan G185 Heavy Blend Adult Hooded Sweatshirt', 'gildanhoodie', '14.00', 'Snug and comfortable sweatshirt which is\n  made of 50% cotton 50% polyester, has double-needle stitching throughout, and a pouch pocket.', '2016-11-26'),
(15, 4, 'Harry Potter Girls Hogwarts Long Sleeve T-Shirt with Scarf', 'hpshirt', '17.00', 'The perfect shirt for the Hufflepuff girl in\n  your family. Made from 60% cotton and 40% polyester.', '2016-11-26'),
(16, 4, 'Under Armour Boys Sportstyle Fleece Bomber Jacket', 'fleece', '59.00', 'Maximize your young sons performance and\n  outdoor adventures with the Under Armour Boys Sportstyle Fleece Bomber Jacket. An ultra-soft fleece construction with a\n  brushed interior delivers locked-in warmth for a comfortable fit and feel. Moisture-wicking properties draw sweat away\n  to keep him dry, while stretch fabric allows him to move without restriction. Give him on-trend, sporty style with the\n  UA Sportstyle Fleece Bomber Jacket.', '2016-11-26'),
(17, 5, 'Hot Wheels Criss Cross Crash Track Set', 'hotwheels', '57.00', 'With more than 16 feet of track that includes\n  hairpin turns, motorized boosters and a giant crash zone, kids can enjoy crash-and-bash fun for hours on end. Watching\n  cars maneuver loops and the Criss Cross intersections is riveting.', '2016-11-26'),
(18, 5, 'Pearl EXX725/C 5-Piece Export Standard Drum Set with Hardware (Red Wine)', 'pearldrums', '649.00', 'The drums blended\n  Poplar/Asian Mahogany shell delivers strong volume and sustained low-end. The three-way tom mount allows the shell to resonate\n  freely with wobble-free performance. Upgraded for the serious student, featuring double-braced stands and chain-drive\n  bass drum pedal.', '2016-11-26'),
(19, 5, 'Motorcycle Street Bike Helmet', 'helmet', '39.00', 'This motorcycle helmet comes with 2 visors: clear + smoked and 1\n  neck scarf for winter use. The streamline design reduces wind noise. It also has an advanced lightweight durable ABS shell\n  with a quick release strap for easy use.', '2016-11-26'),
(20, 5, 'Zootopia (Blue-Ray)', 'zootopia', '25.00', 'From Walt Disney Animation Studios comes a comedy-adventure set in\n  the modern mammal metropolis of Zootopia. Determined to prove herself, Officer Judy Hopps, the first bunny on Zootopias\n  police force, jumps at the chance to crack her first case even if it means partnering with scam-artist fox Nick Wilde to\n  solve the mystery. Bring home this hilarious adventure full of action, heart and tons of bonus extras that take you deeper\n  into the world of Zootopia. It s big fun for all shapes and species!', '2016-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `shipAddressID` int(11) DEFAULT NULL,
  `billingAddressID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `email`, `password`, `firstname`, `lastname`, `shipAddressID`, `billingAddressID`) VALUES
(7, 'colonmanuel7@gmail.com', 'mama', 'Manuel', 'Colon', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `orderItems`
--
ALTER TABLE `orderItems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `orderItems`
--
ALTER TABLE `orderItems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderItems`
--
ALTER TABLE `orderItems`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
