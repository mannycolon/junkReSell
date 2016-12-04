-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2016 at 06:45 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Table structure for table `category`
--
CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) NOT NULL,
  PRIMARY KEY (categoryID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--
INSERT INTO `category`(`categoryID`, `categoryName`) VALUES
(1,'Electronics'),
(2,'Sporting Goods'),
(3,'Home and Garden'),
(4,'Clothing'),
(5,'Other');

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productPrice` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `dateAdded` date NOT NULL,
  PRIMARY KEY (productID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `productPrice`, `description`, `dateAdded`) VALUES
(1, 1, 'Samsung 720p LED TV (2014 Model)', '650.00', 'Ideal for placement in a bedroom or dorm room, this
 720p Samsung HDTV delivers a wide variety of colors and clarity, allowing you to relax and enjoy your
 favorite movies and shows. Connect your USB device directly for access to your photos, videos and music.', '2016-09-23');

ALTER TABLE product ADD abbrvName VARCHAR(60) AFTER productName;
UPDATE product SET abbrvName='samsungTV'WHERE productID=1;

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(2, 1, 'Apple iPad Air 16GB WiFi', 'iPad', '379.00', 'For tech connoisseurs, the lighter and thinner the design, the more desirable
  that piece of hardware is. Designed for true techies, the Apple iPad Air is 20 percent thinner than the standard iPad,
  and weighs just one pound, so it feels unbelievably light in your hand. It comes with a 9.7" Retina display, the A7
  chip with 64-bit architecture, ultrafast wireless, powerful apps, and up to 10 hours of battery life. And over 475,000
  apps in the App Store are just a tap away on the Apple iPad Air. ', '2016-10-06');

 INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(3, 1, 'Apple MacBook Pro 13.3" With Touch Bar', 'macbook-pro-2016', '1799.00', 'It is faster and more powerful than before,
  yet remarkably thinner and lighter. It has the brightest, most colorful Mac notebook display ever. And it introduces
  the Touch Bar: a Multi-Touch enabled strip of glass built into the keyboard for instant access to the tools you want,
  right when you want them. The new MacBook Pro is built on groundbreaking ideas. And it is ready for yours.', '2016-11-26');

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(4, 1, 'Amazon Echo Dot', 'echodot', '50.00', 'Deliver your favorite playlist anywhere in your home with the Amazon Echo
  Dot voice-controlled device. Control most electric devices through voice activation, or schedule a ride with Uber and
  order a pizza. The Amazon Echo Dot voice-controlled device turns any home into a smart home with the Alexa app on a
  smartphone or tablet.', '2016-11-26');


--
-- Dumping data for table `product` into Sporting Goods category
--

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(5, 2, 'TRUE Xcore 9 Hockey Stick', 'hockeystick', '279.00', 'If you thought TRUE was a new company, guess again. With over 14 years
  of experience and over 2 million sticks produced for leading hockey companies, TRUE is making a splash into the stick market
   by coming direct to you! As the world leader of golf shaft technology TRUE is set on providing the hockey industry with
   superior stick designs made from the highest quality materials and strictest manufacturing processes. Bent on providing pure
    domination at every level of the game, our latest elite pro stick, the Xcore 9 was designed with just that in mind.', '2016-11-26');

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(6, 2, 'adidas Euro 16 Top Glider Soccer Ball', 'soccerball', '32.00', 'Part of the Euro 2016 Collection, this ball is a 1:1 takedown
  of the official match ball used by professional soccer players in the European Championship games. Machine stitched construction
  and internal nylon wound carcass for maximum durability and long-lasting performance.', '2016-11-26');

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(7, 2, 'Silverback In-Ground Basketball System', 'basketballhoop', '499.00', 'The
  Silverback SB60 and SB54, our premier in-ground basketball goals, are anchored into the ground and feature a tempered
  glass backboard and an all-steel pole, offering the performance of a gymnasium style goal.', '2016-11-26');

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(8, 2, 'MD Sports 84 in. Arcade Billiard Table', 'billiardtable', '599.00', 'This handsome billiard table offers a more
  modern style, with a playing surface of red felt that is perfectly contrasted by the black-and-metal color scheme of
  the body. The steel frame keeps the body flat and level at all times, while all those balls you are putting away are
  tucked safely in fabric nets on each hole. The block legs have a sleek, contemporary style while employing adjustable
  levelers to make sure that your table is always on sure footing. This table also includes a rack, a full set of balls and
   cues, so you are ready to start hustling the room as soon as it arrives.', '2016-11-26');

--
-- Dumping data for table `product` into Home and Garden cartegory
--

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(9, 3, 'Madison Park Maxwell Chair (Red)', 'maxwellchair', '297.00', 'This classic wing chair with its button tufted detailing and
  sloped arms adds a casual twist with its russet red casual woven fabric.', '2016-11-26');

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(10, 3, 'Char-Broil Classic 4-Burner Gas Grill', 'grill', '200.00', 'For larger families or cookouts, the Char-Broil Classic
  4-burner gas grill has the features and performance providing everything you need in a grill and more. Features a large
  480 square inch cooking area and 180 square inch swing-away warming rack, both providing plenty of cooking space. Grill
  up your favorites with the powerful and durable burners that heat up quickly and deliver even grilling. ', '2016-11-26');

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(11, 3, 'GardenHOME Ergonomic Garden Tools 4 Piece Tool Set', 'gardentools', '15.00', 'The GardenHOME Ergonomic Garden Tool 4-pack
  includes a trowel, a cultivator, a trans-planter and a fork. High resistance cast-aluminum heads are easy to clean, rust
  resistant and great looking. Each ergonomically-designed handle fits your hand naturally, encouraging a neutral wrist position,
  which in turn helps reduce hand stress and fatigue.', '2016-11-26');

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(12, 3, 'Oster 6595 Inspire 2-Slice Toaster, Red/Black', 'ostertoaster', '30.00', 'Beautifully housed in a red metallic housing
  with black accents, this two-slice toaster from Oster not only looks great in any contemporary kitchen, but it also features
  extra-wide slots that can accommodate a variety of bread types, including thick bagel halves, hamburger buns, English muffins,
  hearty slices of artisan-style bread, frozen waffles, and other toast-able favorites. Dual bread guides automatically adjust to
  the thickness of the slices for perfect alignment and even browning on both sides, while a high-lift lever promotes safe removal
  of toasted items-even smaller pieces. ', '2016-11-26');

--
-- Dumping data for table `product` into Clothing cartegory
--

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(13, 4, 'Face N Face Womens High Waisted A line Street Skirt', 'skirt', '19.00', 'Superior in material and excellent in workmanship,
  this skirt is perfect for everyday and formal wear. Fit for all 4 seasons, easy to match your favorite tops and shoes.', '2016-11-26');

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(14, 4, 'Gildan G185 Heavy Blend Adult Hooded Sweatshirt', 'gildanhoodie', '14.00', 'Snug and comfortable sweatshirt which is
  made of 50% cotton 50% polyester, has double-needle stitching throughout, and a pouch pocket.', '2016-11-26');

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(15, 4, 'Harry Potter Girls Hogwarts Long Sleeve T-Shirt with Scarf', 'hpshirt', '17.00', 'The perfect shirt for the Hufflepuff girl in
  your family. Made from 60% cotton and 40% polyester.', '2016-11-26');

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(16, 4, 'Under Armour Boys Sportstyle Fleece Bomber Jacket', 'fleece', '59.00', 'Maximize your young sons performance and
  outdoor adventures with the Under Armour Boys Sportstyle Fleece Bomber Jacket. An ultra-soft fleece construction with a
  brushed interior delivers locked-in warmth for a comfortable fit and feel. Moisture-wicking properties draw sweat away
  to keep him dry, while stretch fabric allows him to move without restriction. Give him on-trend, sporty style with the
  UA Sportstyle Fleece Bomber Jacket.', '2016-11-26');

--
-- Dumping data for table `product` into Other cartegory
--

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(17, 5, 'Hot Wheels Criss Cross Crash Track Set', 'hotwheels', '57.00', 'With more than 16 feet of track that includes
  hairpin turns, motorized boosters and a giant crash zone, kids can enjoy crash-and-bash fun for hours on end. Watching
  cars maneuver loops and the Criss Cross intersections is riveting.', '2016-11-26');

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(18, 5, 'Pearl EXX725/C 5-Piece Export Standard Drum Set with Hardware (Red Wine)', 'pearldrums', '649.00', 'The drums blended
  Poplar/Asian Mahogany shell delivers strong volume and sustained low-end. The three-way tom mount allows the shell to resonate
  freely with wobble-free performance. Upgraded for the serious student, featuring double-braced stands and chain-drive
  bass drum pedal.', '2016-11-26');

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(19, 5, 'Motorcycle Street Bike Helmet', 'helmet', '39.00', 'This motorcycle helmet comes with 2 visors: clear + smoked and 1
  neck scarf for winter use. The streamline design reduces wind noise. It also has an advanced lightweight durable ABS shell
  with a quick release strap for easy use.', '2016-11-26');

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(20, 5, 'Zootopia (Blue-Ray)', 'zootopia', '25.00', 'From Walt Disney Animation Studios comes a comedy-adventure set in
  the modern mammal metropolis of Zootopia. Determined to prove herself, Officer Judy Hopps, the first bunny on Zootopias
  police force, jumps at the chance to crack her first case even if it means partnering with scam-artist fox Nick Wilde to
  solve the mystery. Bring home this hilarious adventure full of action, heart and tons of bonus extras that take you deeper
  into the world of Zootopia. It s big fun for all shapes and species!', '2016-11-26');
  
 --
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  PRIMARY KEY (adminID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrators` 
--

INSERT INTO `administrators` (`adminID`, `email`, `password`, `fullName`) VALUES
(1, 'admin@aol.com', 'testing1234', 'John Admin');

