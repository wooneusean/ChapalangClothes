-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 26, 2021 at 08:07 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chapalang`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `BannerId` int NOT NULL AUTO_INCREMENT,
  `BannerName` varchar(140) NOT NULL,
  `BannerDescription` varchar(250) NOT NULL,
  `BannerImage` varchar(140) NOT NULL,
  PRIMARY KEY (`BannerId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`BannerId`, `BannerName`, `BannerDescription`, `BannerImage`) VALUES
(1, 'India Free Shipping', 'We now provide free shipping across India!', 'images/banners/shipping-banner.png'),
(2, 'Keluarga Gader @ Bangi Wonderland', 'Jom! Bersama-sama dengan keluarga di Bangi Wonderland! Terdapat banyak aktiviti menarik! RSVP Segera!', 'images/banners/keluarga-gader.jpg'),
(3, 'Chapalang Clothes 9.9 Sale', 'The annual Chapalang Clothes 9.9 sale is coming soon! Don\'t miss out on MASSIVE deals this Septemper on Chapalang Clothes!', 'images/banners/99sale.png'),
(4, 'Clothes n Fashion', 'Clothes n Fashion', 'images/banners/cloth_fashion.png'),
(10, 'Port Dickson Physical Store Now Open!', 'A Chapalang Clothes physical store has been opened in Port Dickson! Come around and check out our MASSIVE deals today!', 'images/banners/f248f276e39fb65408e85109ae2c2524594a774f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `EmployeeId` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(140) NOT NULL,
  `Password` varchar(140) NOT NULL,
  `Email` varchar(140) NOT NULL,
  PRIMARY KEY (`EmployeeId`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeId`, `Username`, `Password`, `Email`) VALUES
(1, 'test', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'test@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `FeedbackId` int NOT NULL AUTO_INCREMENT,
  `FeedbackName` varchar(100) NOT NULL,
  `FeedbackEmail` varchar(100) NOT NULL,
  `FeedbackMessage` varchar(240) NOT NULL,
  PRIMARY KEY (`FeedbackId`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedbackId`, `FeedbackName`, `FeedbackEmail`, `FeedbackMessage`) VALUES
(1, 'John Doe', 'john.doe@mail.com', 'Please add x and y thanks.'),
(6, 'Jane Doe', 'jane@mail.com', 'Please change the color of the site to blue. Thanks.');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `MessageId` int NOT NULL AUTO_INCREMENT,
  `UserId` int NOT NULL,
  `VendorId` int NOT NULL,
  `Sender` int NOT NULL,
  `MessageBody` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `MessageTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MessageReadUser` int NOT NULL DEFAULT '0',
  `MessageReadVendor` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`MessageId`),
  KEY `UserId` (`UserId`),
  KEY `VendorId` (`VendorId`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`MessageId`, `UserId`, `VendorId`, `Sender`, `MessageBody`, `MessageTimestamp`, `MessageReadUser`, `MessageReadVendor`) VALUES
(1, 1, 1, 0, 'Hello, for this product, can you lower the price? I feel that it is a bit unreasonable.', '2020-12-04 16:20:31', 1, 0),
(2, 1, 1, 1, 'What do you mean by unreasonable? The prices are following the market rates currently.', '2020-12-04 16:20:31', 1, 0),
(3, 1, 3, 0, 'asdasda sdasd asda sd\r\nasdasd a\r\ndas\r\ndasdasdasd\r\nasd', '2020-12-04 16:22:45', 1, 0),
(4, 1, 3, 1, 'asdasda sdasd asda sd\r\nasdasd a\r\ndas\r\ndasdasdasd\r\nasd', '2020-12-04 16:22:45', 1, 0),
(5, 1, 1, 0, 'No, no, I have seen cheaper listings of this products.', '2020-12-04 16:25:43', 1, 0),
(6, 1, 1, 1, 'Then why don\'t you buy from those sellers instead?', '2020-12-04 16:25:43', 1, 0),
(7, 2, 1, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,\r\nsed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\r\nNulla malesuada pellentesque elit eget gravida cum sociis natoque.\r\nLorem ipsum dolor sit amet.\r\nMalesuada fames ac turpis egestas maecenas pharetra convallis posuere morbi.\r\nSed odio morbi quis commodo odio aenean sed.\r\nMaecenas accumsan lacus vel facilisis volutpat est velit egestas dui.\r\nEget egestas purus viverra accumsan in nisl.\r\nIn fermentum posuere urna nec tincidunt.\r\nConsectetur libero id faucibus nisl tincidunt eget nullam.\r\nFermentum leo vel orci porta.', '2020-12-05 11:26:28', 0, 1),
(8, 2, 1, 1, 'Elementum curabitur vitae nunc sed velit dignissim.\r\nIn dictum non consectetur a erat.\r\nEst velit egestas dui id ornare arcu odio.\r\nNam aliquam sem et tortor consequat id porta nibh.\r\nNon curabitur gravida arcu ac tortor dignissim convallis aenean.\r\nCurabitur vitae nunc sed velit dignissim.\r\nNunc eget lorem dolor sed viverra.\r\nIn mollis nunc sed id semper.\r\nPretium vulputate sapien nec sagittis aliquam malesuada bibendum arcu vitae.\r\nPraesent elementum facilisis leo vel fringilla est ullamcorper eget nulla.\r\nViverra suspendisse potenti nullam ac tortor vitae.\r\nDiam maecenas sed enim ut sem viverra aliquet eget sit.\r\nCras ornare arcu dui vivamus arcu felis.\r\nSit amet mauris commodo quis imperdiet massa tincidunt nunc pulvinar.\r\nUt pharetra sit amet aliquam.\r\nMassa tincidunt dui ut ornare.\r\nQuisque id diam vel quam elementum pulvinar etiam.\r\nQuam viverra orci sagittis eu volutpat odio facilisis mauris.', '2020-12-05 11:26:28', 0, 1),
(9, 1, 1, 0, 'Hey bro, I\'m trying to give you business and all I\'m asking is for you to lower the price on this product. Why do you have to be so hostile?', '2020-12-05 12:25:45', 1, 0),
(10, 1, 3, 0, 'Hello is this product for sale?', '2020-12-05 12:26:57', 1, 0),
(11, 2, 1, 1, 'dorime dorime ameno latire', '2020-12-05 13:44:00', 0, 1),
(12, 1, 1, 1, 'I don\'t need business from broke people that don\'t know their own positions.', '2020-12-05 13:45:45', 1, 0),
(13, 2, 1, 0, 'Dori me, ameno, oma nare imperavi ameno\r\nDimere, dimere, mantiro, mantire mo', '2020-12-05 13:50:32', 0, 1),
(14, 2, 3, 1, 'Hello pls buy our shit, our stuff real good check it out thx\r\n\r\nya yeet,\r\nryjyshop', '2020-12-05 13:57:09', 0, 0),
(15, 2, 3, 0, 'nah bro ur shit wack\r\nget outta here with yo shit bruh', '2020-12-05 13:57:47', 0, 0),
(16, 2, 3, 1, 'mans just trynna husstle ya feel me\r\nhelp a brother out mayn', '2020-12-05 13:58:25', 0, 0),
(17, 2, 9, 0, 'Hello please add JoJo clothes thanks.', '2020-12-05 14:29:21', 1, 1),
(18, 2, 9, 1, 'Ok lol', '2020-12-05 14:29:28', 1, 1),
(19, 11, 9, 0, 'ay bro i like your clothes \r\nbe cool if  you had some demon slayer hoodies', '2020-12-05 14:32:41', 0, 1),
(20, 11, 9, 1, 'lol ok bro no prob ill add it soon', '2020-12-05 14:32:54', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

DROP TABLE IF EXISTS `orderitem`;
CREATE TABLE IF NOT EXISTS `orderitem` (
  `OrderItemId` int NOT NULL AUTO_INCREMENT,
  `OrderId` int NOT NULL,
  `ProductId` int NOT NULL,
  `ProductQuantity` int NOT NULL,
  `OrderStatus` varchar(140) NOT NULL,
  PRIMARY KEY (`OrderItemId`),
  KEY `OrderId` (`OrderId`),
  KEY `ProductId` (`ProductId`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`OrderItemId`, `OrderId`, `ProductId`, `ProductQuantity`, `OrderStatus`) VALUES
(1, 1, 32, 1, 'RefundPending'),
(2, 2, 9, 1, 'Shipped'),
(3, 2, 16, 1, 'To Ship'),
(4, 2, 30, 1, 'Shipped'),
(5, 3, 15, 2, 'To Ship'),
(6, 3, 18, 2, 'Shipped'),
(7, 4, 23, 1, 'To Ship'),
(8, 4, 32, 1, 'Shipped'),
(9, 4, 52, 1, 'To Ship'),
(10, 5, 57, 1, 'To Ship'),
(11, 6, 45, 2, 'To Ship'),
(12, 6, 50, 8, 'Shipped'),
(13, 6, 55, 2, 'Shipped'),
(14, 6, 58, 4, 'Shipped'),
(15, 6, 63, 4, 'Shipped'),
(16, 7, 30, 1, 'RefundPending'),
(17, 7, 32, 2, 'RefundPending'),
(18, 7, 37, 1, 'RefundPending'),
(19, 7, 49, 1, 'RefundPending'),
(20, 7, 57, 1, 'RefundPending'),
(21, 8, 54, 8, 'To Ship'),
(22, 9, 15, 2, 'To Ship'),
(23, 9, 16, 1, 'To Ship'),
(24, 9, 23, 1, 'To Ship'),
(25, 10, 57, 2, 'To Ship'),
(26, 11, 39, 50, 'To Ship'),
(27, 12, 52, 1, 'To Ship'),
(28, 13, 52, 1, 'To Ship'),
(29, 14, 50, 82, 'Shipped'),
(30, 15, 2, 7, 'Shipped'),
(31, 15, 16, 10, 'To Ship'),
(32, 16, 57, 2, 'To Ship'),
(33, 17, 64, 10, 'Shipped'),
(34, 18, 54, 1, 'Shipped'),
(35, 19, 36, 1, 'To Ship'),
(36, 19, 39, 19, 'RefundPending'),
(37, 19, 49, 7, 'To Ship'),
(38, 20, 44, 2, 'RefundPending'),
(39, 20, 46, 1, 'RefundPending'),
(40, 21, 69, 5, 'To Ship'),
(41, 22, 40, 10, 'RefundPending'),
(42, 22, 61, 6, 'Shipped'),
(43, 23, 36, 1, 'To Ship'),
(44, 24, 6, 2, 'Refund'),
(45, 25, 61, 1, 'Refund'),
(46, 26, 8, 3, 'Refund'),
(47, 27, 9, 1, 'Refund'),
(48, 28, 6, 4, 'To Ship'),
(49, 29, 61, 5, 'RefundPending'),
(50, 30, 9, 3, 'To Ship'),
(51, 31, 73, 5, 'RefundPending'),
(52, 32, 17, 2, 'RefundPending'),
(53, 33, 61, 1, 'RefundPending'),
(54, 34, 44, 2, 'RefundPending'),
(55, 34, 49, 3, 'To Ship'),
(56, 34, 55, 1, 'To Ship'),
(57, 34, 58, 2, 'To Ship'),
(58, 34, 69, 2, 'To Ship'),
(59, 35, 40, 1, 'Shipped'),
(60, 36, 2, 6, 'RefundPending'),
(61, 36, 3, 6, 'To Ship'),
(62, 37, 3, 7, 'Refund'),
(63, 37, 40, 7, 'RefundPending'),
(64, 38, 5, 3, 'Refund'),
(65, 39, 4, 33, 'Refund'),
(66, 40, 3, 1, 'To Ship'),
(67, 40, 4, 4, 'Shipped'),
(68, 41, 4, 1, 'Shipped'),
(69, 42, 4, 1, 'Shipped'),
(70, 43, 61, 1, 'RefundPending'),
(71, 44, 39, 1, 'To Ship'),
(72, 45, 1, 1, 'RefundPending'),
(73, 45, 2, 1, 'RefundPending'),
(74, 46, 39, 2, 'To Ship'),
(75, 46, 50, 1, 'To Ship'),
(76, 46, 55, 1, 'To Ship'),
(77, 46, 58, 5, 'To Ship'),
(78, 46, 67, 2, 'To Ship'),
(79, 47, 9, 1, 'RefundPending'),
(80, 47, 16, 1, 'To Ship'),
(81, 48, 50, 1, 'To Ship'),
(82, 49, 15, 2, 'To Ship'),
(83, 49, 44, 2, 'To Ship'),
(84, 49, 50, 1, 'To Ship'),
(85, 49, 57, 1, 'To Ship'),
(86, 49, 63, 1, 'To Ship');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `ProductId` int NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(140) NOT NULL,
  `ProductDescription` varchar(140) NOT NULL,
  `ProductTags` varchar(500) NOT NULL,
  `ProductImage` varchar(500) NOT NULL,
  `ProductPrice` decimal(10,2) NOT NULL,
  `ProductStock` int NOT NULL,
  `ProductStatus` varchar(140) NOT NULL,
  `VendorId` int NOT NULL,
  PRIMARY KEY (`ProductId`),
  KEY `VendorId` (`VendorId`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductId`, `ProductName`, `ProductDescription`, `ProductTags`, `ProductImage`, `ProductPrice`, `ProductStock`, `ProductStatus`, `VendorId`) VALUES
(1, 'Fancy Highheels', 'Black colour, Size UK 4 - 6, 4cm Heels, Leather straps are replaceable\r\n\r\n\r\n', 'shoes, black, working, formal, highheels, office, women', 'images/items/highheel1.1.jfif,images/items/highheel1.2.jpg', '70.00', 39, 'Approved', 1),
(2, 'String highheels', 'Black in colour, wide fit, 5 cm heels\r\n', 'shoes, black, working, formal, highheels, office, women', 'images/items/highheel2.jfif', '66.00', 21, 'Blacklisted', 1),
(3, 'Pink Purse', 'Made from leather, pink colour, very popular among teenage girls', 'pink, working, bag, office, women', 'images/items/Purse1.jfif', '105.00', 31, 'Approved', 1),
(4, 'Woman T-shirt Ballerina', 'White colour  T-shirt, with a good looking pattern that is a ballerina girls dancing', 'shirt, white, women, cotton, tshirt, informal', 'images/items/womenballerina.jfif', '30.00', 81, 'Approved', 1),
(5, 'Keep Calm and Ballet Dance T-shirt', 'Keep calm and DANCE LIKE A PROFFESIONAL BALLET DANCER', 'shirt, black, cotton, tshirt, women, informal', 'images/items/womenballerina2.jfif', '35.00', 107, 'Approved', 1),
(6, 'Blazer - Male', 'High quality formal blazer for you, clean and smart looking on you . Black colour only available', 'shirt, men, formal, black', 'images/items/Blazer1.1.jfif,images/items/Blazer1.2.jpg', '120.00', 34, 'Approved', 3),
(7, 'Black Blazer for Men', '100% made out of cotton, black colour only', 'shirt, men, formal, black', 'images/items/Blazer2.jfif', '100.00', 55, 'Denied', 3),
(8, 'Black Leather Shoe', 'Perfect for office wear, for UK size 9 and black in colour', 'shoes, leather, black, working, formal, office, men', 'images/items/Formalshoe1.jpg', '65.00', 67, 'Approved', 3),
(9, 'Instant Insert Formal Shoe', 'No strings, just insert your feet into the shoe and you are ready to go. Black colour and UK size 7 ', 'shoes, black, working, formal, office, men', 'images/items/Formalshoe4.jpg', '70.00', 24, 'Approved', 3),
(10, 'Office Shoe', 'Formal shoe available for UK size 9 and black in colour', 'shoes, black, working, formal, office, men', 'images/items/Formalshoe5.jpeg', '55.00', 75, 'Denied', 3),
(11, 'Light Blue Jeans', 'Unisex light blue jeans. Super stretchy and soft fabric for comfortable wear', 'blue, jeans, pants, men, women, informal', 'images/items/Jeans1.jfif', '70.00', 80, 'Denied', 4),
(12, 'Unisex dark blue jeans ', 'Dark Blue Jeans, super stretchy and soft fabric for comfortable wear. Wash seperately. Size M\r\n', 'blue, jeans, pants, women, men, informal', 'images/items/Jeans2.jpg', '65.00', 80, 'Approved', 4),
(13, 'Comfortable Long Pants', 'Unisex. Loose on your calves, will be very comfortable for you. Some people wear it as pyjamas. Dark blue only available', 'blue, pants, long, women, informal, men', 'images/items/Pants1.jpg', '44.00', 100, 'Approved', 4),
(14, 'Wifi Shirt', 'Whats your wifi password? Only blue in colour for both men and women', 'blue, shirt, women, men, informal', 'images/items/Shirt1.jpg', '35.00', 150, 'Approved', 4),
(15, 'Saitama Oppai T-shirt', 'For both diehard One Punch Man fans for men and women', 'white, shirt, red, yellow, men, women, informal', 'images/items/shirt3.1.jpg,images/items/shirt3.2.jpg', '69.00', 164, 'Approved', 4),
(16, 'Kiryu set', 'Contains both his shirt and blazer only. Dress as the famous Yakuza 0 character', 'orange, white, men, formal, shirt', 'images/items/kiryublazerandshirtset.png', '220.00', 2, 'Approved', 4),
(17, 'Brown Suitcase', 'Made from high quality leather, brown colour. Suitable for work', 'brown, working, bag, office, men', 'images/items/Briefcase1.1.jfif,images/items/Briefcase1.2.jpg', '135.00', 23, 'Approved', 5),
(18, 'Grey Formal Pants ', 'Grey formal pants, tight fitted for men', 'grey, working, pants, office, men', 'images/items/formalpants1.1.jfif,images/items/formalpants1.2.jpg', '70.00', 63, 'Approved', 5),
(19, '100% Leather Shoe for men', 'Made from 100% leather, high quality, will take a decade for it to spoil', 'black, office, men, shoe', 'images/items/Formalshoe2.jpg', '150.00', 25, 'Approved', 5),
(20, 'Comfy Office shoe ', 'So comfy, that you can feel you are floating on air. UK Size 9', 'black, men, shoe, office, formal', 'images/items/comfyofficeshoe.jpg', '120.00', 22, 'Denied', 5),
(21, 'Black Adidas with White Stripe', 'Suitable for both men and women. Usually used for running', 'black, sneakers, white, shoe, men, women', 'images/items/Adidas1.jpg', '230.00', 33, 'Approved', 6),
(22, 'White Adidas', 'Fully white coloured Adidas sneaker with red stripe. Suitable for jogging', 'white, men, shoe, women, sneakers', 'images/items/adidas2.jpg', '140.00', 36, 'Approved', 6),
(23, 'LIMITED EDITION WhiteBlue Nike Sneakers', 'The future is now people, this shoe looks like it came straight from the future.', 'shoes, sneakers, men, black, blue, women', 'images/items/Nike1.jfif', '300.00', 8, 'Approved', 6),
(24, 'Full White Nike', 'You prefer white Nike instead of the usual dark?\r\nHere is the newly released Full White Nike', 'white, men, women, sneakers, shoe', 'images/items/nike2.1.jpg,images/items/nike2.2.jpg', '170.00', 56, 'Approved', 6),
(25, 'Jordanz Basket Nike ', 'Limited Edition Jordanz lookalike Nike shoe.\r\nVery good looking and made for playing basketball', 'black, white, red, men, women, shoe, sneakers', 'images/items/nike3.jfif', '270.00', 20, 'Denied', 6),
(26, 'Jog Puma', 'Specially for jogging, very stylish, comfortable wear', 'black, men, shoe, office, formal', 'images/items/Puma1.jpg', '199.00', 60, 'Approved', 7),
(27, 'UV Blocking Sunglasses', 'Metal Frame\r\nBlue Tint\r\nProtects eyes from harm UV rays\r\n1 year warranty', 'sunglasses, eyes, glasses, blue, unisex, UV, sunlight', 'images/items/asdadadada.jfif,images/items/asdadsadas.jfif', '40.00', 80, 'Approved', 11),
(28, 'Cool Guy Sunglasses', 'Metal Frame\r\nBlack Tint\r\nProtects eyes from harm UV rays\r\n1 year warranty\r\nSuitable for the guys who want to get those ladies', 'sunglasses, sunlight, eyes, glasses, UV, black', 'images/items/Avi083_IMG_2048x2048_copy_2048x2048_1.png,images/items/asdsadasdasdadadsas.jfif,images/items/police-spl872-sunglasses-0700-angle.jpg', '45.00', 70, 'Denied', 11),
(29, 'Girly Puma', 'White coloured Puma with some pink on it. Usually for women, but also suitable for men', 'white, women, men, shoe, sneakers', 'images/items/Puma2.jfif', '155.00', 65, 'Approved', 7),
(30, 'Golden Tint Sunglasses', 'Metal Frame\r\nGolden Tint\r\nProtects eyes from harmful UV rays\r\n1 year warranty\r\nPerfect to wear with any clothes !!!', 'sunglasses, yellow, golden, sunlight, UV, unisex, metal frame', 'images/items/download.jfif,images/items/546767414_tp.jpg,images/items/s_5843acd9fbf6f9693200c26f.jpg,images/items/a42.jpg', '60.00', 53, 'Approved', 11),
(31, 'Whitish Puma', 'Fully white Puma\r\nSize UK 7\r\nUnisex', 'white, men, women, shoe, sneakers', 'images/items/Puma3.1.jfif,images/items/Puma3.2.jfif', '99.00', 40, 'Denied', 7),
(32, 'Superior Meme Glasses', 'Pixel art glasses\r\nWear it if you think you are a meme daddy\r\n\r\n17cm x 13cm', 'sunglasses, sunlight, meme, funny, cool, unisex, pixel', 'images/items/0b72a91a-4895-4ccc-b494-975a99c2d3ae_1.1f6fa28e531f4456e90b7083ec2f344c.jpeg,images/items/5d5f8f158662510694c37150-large.jpg,images/items/Deal-With-It-Thug-Life-Glasses-Meme-MLG-Shades-8-Bit-pixelated-Unisex-Sunglasses-Mosaic-Vintage.jpg', '20.00', 66, 'Approved', 11),
(33, 'Thicc Sunglasses', 'EXTRA THICC sunglasses for THICC PEOPLE', 'black, men, women, kid, sunglass', 'images/items/Sunglasses7.jfif', '30.00', 66, 'Approved', 7),
(34, 'Kids Swimming Goggles', 'Goggles suitable for kids aged 12 and under', 'swimming, goggles, kids, unisex, pink, blue, black', 'images/items/download (1).jfif,images/items/download (2).jfif,images/items/bbdfda48b59ad4c8cf6458a775c5180e.jfif', '25.00', 60, 'Approved', 11),
(35, 'Blood Red Shirt', 'Get BLOODY, get reddish. L size only for now ', 'red, men, women, shirt, informal', 'images/items/shirt1.jpg', '20.00', 420, 'Denied', 8),
(36, 'Spooderman Necklace Pendant Locket', 'If you love memes you sure gonna love this ya yeet skrrt skrrt', 'meme, locket, necklace, pendant, funny, spiderman, spooderman, chain, unisex', 'images/items/2016-Hot-Sale-Meme-Necklace-Spoderman-Pendant-Dolan-Jewelry-Fashion-27MM-Round-Pendant-Choker-Necklace-Men.webp,images/items/hot-sale-meme-necklace-spoderman-pendant.jpg,images/items/HTB16k12di6guuRkSnb4q6zu4XXau.jpg,images/items/Spooderm-cjxvobukj00nm01uyto62a311.png', '20.00', 58, 'Approved', 11),
(37, 'Buff Muscle Tshirt SHREDDED', 'wanna look buff but dont wanna put in the effort? look no further baby get shredded like some shredded cabbage', 'tshirt, muscle, buff, weights, men, unisex, women, meme, funny', 'images/items/dc2316f6-46e9-44c4-b4d9-9ae7cd2079b0_1.d16063dec5f7438df39c1c34ce0f9347.jpeg,images/items/61TQgcBJ7uL._AC_UX569_.jpg,images/items/_pdp_sq_.webp,images/items/FORUDESIGNS-Funny-3D-Muscle-Print-T-Shirt-for-Men-Designer-Crossfit-Male-Casual-Tee-Shirts-Summer.webp', '35.00', 89, 'Approved', 10),
(38, 'Plain black v-neck shirt', 'Plain like your life and stale bread if you get what I mean', 'black, shirt, white, men, women, informal', 'images/items/tshirt1.1.jpg,images/items/tshirt1.2.png', '33.00', 420, 'Approved', 8),
(39, 'Meme Daddy Shirt', 'Why get sugar daddy when you can get a meme daddy', 'black, rainbow, men, women, kid, shirt', 'images/items/memedaddy.jfif', '69.00', 6897, 'Approved', 8),
(40, 'FUNNY HEE HEE SHIRT OUI OUI', 'get this if you are a meme daddy', 'funny, meme, unisex, men, women, colour', 'images/items/51Ykt1xT0fL._AC_UL1021_.jpg', '40.00', 32, 'Approved', 10),
(41, 'Women Black Pants', 'Cool Pants for women\r\nonly available in black colour ', 'pants, black, women, shirt', 'images/items/womentshirt1.1.jpg,images/items/womentshirt1.2.jpg', '666.00', 999, 'Denied', 8),
(42, 'OBAMA PYRAMID BABY TRIANGLE UR ASS', 'obama is pyramid obaningles my jingles', 'meme,funny,unisex,cotton,black,gray,men', 'images/items/redirect-14.jpg', '30.00', 50, 'Approved', 10),
(43, 'Whitey White Women Shirt', 'I bet Karens are gonna buy this anyways\r\nwhite colour only\r\nL size', 'white, women, shirt, informal', 'images/items/womentshirt2.jfif', '42.00', 22, 'Approved', 8),
(44, 'HIDE THE PAIN HAROLD FUNNY MEME SHIRT', 'it makes you go hee hee when u go out', 'unisex, meme, funny, tshirt, men, harold, pain, depression', 'images/items/30806565.jfif,images/items/5f53fec9e677ce959e4bb2eac19e8ec4.png,images/items/Harold-Sad_1024x1024.webp', '40.00', 44, 'Approved', 10),
(45, 'y tho MEME SHIRT FOR MEME GODS', 'if you are cultured u would buy this', 'unisex, men ,women, black, meme, funny, cotton', 'images/items/raisevern-y-tho-memes-t-shirts-men-women.jpg', '40.00', 48, 'Approved', 10),
(46, 'Hide the Pain Harold Bag', 'MEMES bag, where Harold hides his pain :( ', 'white, men, women, bag, kid', 'images/items/hidethepainbag.png,images/items/hidethepainbag2.jpg', '77.00', 99, 'Approved', 8),
(48, 'MEGA MILK SHIRT', 'MEGA MILK SHIRT from Hinnyuu Kyonyuu History', 'tshirt,unisex,meme,anime,weed,manga,hentai', 'images/items/megamilk.jfif,images/items/megamilk2.jpg', '50.00', 120, 'Approved', 9),
(49, 'Ducky Home Slippers', 'comfy home slippers made from soft cotton', 'slippers, shoes, unisex, men, women, kids, yellow, ducks, feet, foot', 'images/items/duckckck.jpg,images/items/duckslippers.jpg,images/items/ducky.jpg', '60.00', 29, 'Approved', 10),
(50, 'Weaboo Trash T-shirt', 'Embrace your inner weaboo and buy yourself this shirt to show off that you are a filthy weaboo', 'tshirt,unisex,meme,anime,weed,manga,white,weaboo,trash', 'images/items/weabootrash.jfif,images/items/weabootrash1.jpg,images/items/weabootrash2.jpg', '60.00', 2, 'Approved', 9),
(51, 'Superman Shirt', 'Gotta get your kids away from Kryptonite or else they gonna be weak like your grandma', 'shirt, kid, blue', 'images/items/kidsuperman1.1.jfif', '44.00', 78, 'Approved', 7),
(52, 'GORILLA SUIT TO SCARE YOUR FAMILY', 'ooga booga i come to scare your mah da', 'suit, gorilla, men, women, unisex, fullbody, banana', 'images/items/61BJ5quNMUL._AC_UL1200_.jpg,images/items/61jMDpb9lcL._AC_UY445_.jpg,images/items/Gorilla_suit_1.jpg', '110.00', 12, 'Approved', 10),
(53, 'Ahegao Shirt', '177013 is the best family friendly shirt ever', 'white, men, shirt, women', 'images/items/Agegao2.jpg,images/items/Ahegao1.jpg,images/items/Ahegao3.jpg', '69.00', 690, 'Denied', 7),
(54, 'Monkey Helmets BUT ON MOTORBIKE', 'first i bang the drum then i bang your mum', 'motorbike, helmet, gorilla, monkey, men, women, unisex', 'images/items/gettyimages-1129452793-612x612.jpg,images/items/Orangutang-e1319533556552.jpg,images/items/imageproxy.jfif', '50.00', 2, 'Approved', 11),
(55, 'Fairytail Shirts', 'Fairytail shirt so you can imagine you are natsu dragneel and be a weeaboo', 'tshirt,unisex,anime,weed,manga,white,fairytail,fairy,tail', 'images/items/fairytailshirt.webp,images/items/fairytailshirt1.jpg,images/items/fairytail3.JPG,images/items/fairytailshirt2.jpg', '80.00', 296, 'Approved', 9),
(56, 'CBT shirt', 'CBT torture for masochist especially', 'black, white, men, women, shirt', 'images/items/cbt.jpg,images/items/cbt2.jfif', '66.00', 666, 'Denied', 5),
(57, 'Gorilla face masks so you can hide your ugly face', 'feel ugly? feel no more because you can now cover that ugly disgrace of shit that you call a face', 'gorilla, mask, face, cover, unisex, men, women', 'images/items/images.jfif,images/items/41780-19933-0.jpg,images/items/trading_places_monkey.jpg', '30.00', 13, 'Approved', 11),
(58, 'Bleach Tshirt', 'Bleach Tshirt fits all size\r\nunisex size 10 US\r\nbuy buy now discount low price!', 'tshirt,unisex,anime,manga,anime,white,bleach,weeb,weeaboo', 'images/items/bleachtshirt1.jfif,images/items/bleachtshirt3.jpg,images/items/bleach2tshirt.png', '75.00', 229, 'Approved', 9),
(59, 'APEX LEGENDS HACKS', 'HACKS FOR APEX LEGENDS EASY TO INSTALL AND EASY TO USE. REKT THEM NOOBS IN RANKED MATCHES', 'hacks, easy, apex legends, scrubs, walls, aimbot', 'images/items/apex-legends-hack-gameplay-aimbot-wallhack.jpg,images/items/hqdefault.jpg', '10.00', 2147483647, 'Denied', 11),
(60, 'Caesar Rohan Body Pillow', 'No boyfriend?\r\nThis be your favourite body pillow to plow away your disgrace', 'men, women, white', 'images/items/causer.jpg,images/items/rohan.jfif', '55.00', 33, 'Denied', 5),
(61, 'Air Asia Style Formal Dress ', 'Wanna be like one of those Air Asia Stewardess?\r\nSay no more ', 'red, white, women, formal, office', 'images/items/formalwomen1.1.jpg,images/items/formalwomen1.2.jfif', '190.00', 85, 'Approved', 3),
(62, 'Wing Chun Wooden Training Dummy', 'you wanna beat the shit outta people like bruce lee or IP man ?\r\nbuy this even better than ubat kuat lelaki', 'wingchun, unisex, men, women, dummy, training, kungfu', 'images/items/41SgQrMm0aL._AC_.jpg,images/items/HTB1aZyMPpXXXXa_apXXq6xXFXXXR.jpg,images/items/H939f4fc7917b44fcb866bf4c5cb98f73z.jpg_350x350.jpg', '350.00', 5, 'Denied', 10),
(63, 'NARUTO SHIPPUDEN, BORUTO\'S FATHER TSHIRTS', 'BUY NARUTO\'S SON\'S GRANDFATHER\'S SON TSHIRTS, \r\nBE A NINJA AND CHIDORI YOUR SELF.', 'tshirt,unisex,anime,manga,anime,white,naruto,boruto,minato,weeb,weeaboo', 'images/items/narutoshirt1.jpg,images/items/narutoshirt2.jpg,images/items/narutoshirt3.jfif,images/items/narutoshirt4.jpg', '80.00', 195, 'Approved', 9),
(64, 'COVID-19-FREE AIR, OXYGEN', 'OXYGEN, AIR FREE FROM COVID-19!\r\nAIR TREATED WITH ANTISEPTIC TO KILL COVID-19. \r\nBUY NOW WHEN CHEAP!!!', 'air,covid,covid-19,cheap,oxygen', 'images/items/air.png,images/items/air2.png,images/items/air3.png,images/items/air4.png', '30.00', 1990, 'Approved', 9),
(65, 'Tesco Plastic Bag', 'high quality plastic made from finest petroleum \r\nextracted from the deepest lands of dubai', 'plastic, bag, unisex, men, women, blue, white, carry, hold', 'images/items/e8b1abb645147eae96b48ac8df66ae8e.jpg,images/items/1879253_Reuters_TESCO-Shopping-Bags_trans_NvBQzQNjv4BqlvNMyDsYm_dR9EW8DZzPho8rf1MRfmBO5vpT7CXaZ6g.jpg,images/items/image001.jpg', '1.00', 100, 'Removed', 1),
(66, 'Tesco T-Shirt Unisex', 'high quality 95% cotton and 5% nylon made tshirt\r\nsuitable for men and women\r\n\r\ncomes in black, white or orange', 'white, black, tshirt, cotton, shirt, tesco', 'images/items/ssrco.jpg,images/items/2b9929025d495cc9c1dc548d0d3260ae.jfif,images/items/51V-FUeEjKL._SY500_.jpg', '25.00', 190, 'Approved', 1),
(67, 'Sugoi Dekai Anime T-Shirt', 'Made from 100% cotton.\r\nHas sizes from S to XL.\r\nUnisex', 'unisex, cotton, white, blue, men, women, anime, sugoi dekai', 'images/items/shirt4.1.jpg,images/items/shirt4.2.jpg,images/items/shirt4.jpg,images/items/sugoidekai4.jpg', '49.00', 68, 'Approved', 9),
(68, 'Zettai Ryouiki Black T-Shirt', 'The sacred area of t-shirts.\r\nMade from 100% cotton.\r\nSizes from S - XXL', 'black, tshirt, cotton, male, female, unisex, zettai', 'images/items/zettairyouiki1.jpg,images/items/zettairyouiki2.png,images/items/zettairyouiki3.jpg', '35.00', 80, 'Approved', 9),
(69, 'JOTARO COSPLAY OUTFIT YARE YARE DAZE MEME GOD STAR PLATINUM', 'are you a jojo fan but dont know how to show it?\r\nLook no further because you can yare yare daze right here', 'jojo, cosplay, outfit, men, women, unisex, clothing, shirt, pants', 'images/items/jotaro1.jpg,images/items/jotaro2.jpg,images/items/jotaro3.jpg,images/items/jotaro4.jpg', '150.00', 23, 'Approved', 9),
(70, 'Sagiri Eromanga Anime Tshirt Long & Short Sleeve', '100% Cotton Shirt from Eromanga Sensei Anime\r\nAvailable in Short and Long sleeve\r\n\r\nDifferent designs available\r\n\r\nUnisex', 'unisex, men, women, sagiri, anime, eromanga, cotton, white', 'images/items/sagiri1.jpg,images/items/sagiri2.jpg,images/items/sagiri3.webp', '40.00', 70, 'Approved', 9),
(71, 'Blue IKEA Recyclable Carrier Bag', 'Made from recyclable materials\r\nCan be used for carrying groceries or large items\r\nDimensions: 60cm x 40cm x 40cm\r\nGive 1 ', 'bag, recycle, shopping, carrier, blue, IKEA', 'images/items/ikea1.webp,images/items/ikea2.webp,images/items/ikea3.jpg', '5.00', 95, 'Pending', 5),
(72, 'Kids Unicorn Sling Bag For Girls', 'Small sling bags for girls\r\nMade from PVC cushion and cloth\r\nDimensions : 20cm x 10cm x 15cm\r\nPlease allow 1-2cm of margin', 'unicorn,bag,kids,sling,girls,women', 'images/items/unicorn1.jpeg,images/items/unicorn2.jpeg,images/items/unicorn3.jpeg', '35.00', 50, 'Pending', 5),
(73, 'Hello Kitty Bag For Girls', 'Hello Kitty Sling Bag suitable for girls\r\nMade from mock leather and velvet interior\r\nDimensions : 18cm x 8cm x 12cm\r\nAllo', 'hellokitty,bag,pink,white,girls,women,sling', 'images/items/hk1.jpeg,images/items/hk2.jpeg,images/items/hk3.jpeg', '25.00', 45, 'Approved', 5),
(74, 'Ajinomoto Shirt, King Of Flavour, Umami', 'Ajinomoto Shirt\r\nS - XL Size\r\nKing of Flavour buy now!\r\nFirst 500 buyer get free Ajinomoto Packet!', 'shirt,umami,ajinomoto,men,women,unisex,flavour,meme', 'images/items/ajinomotoshirt2.jpeg,images/items/ajinomotoshirt1.jpg,images/items/ajinomoto.jpg', '37.50', 120, 'Approved', 6),
(75, 'Blue Formal Pants', 'Blue formal pants, tight fit for male', 'blue, pants, long, formal', 'images/items/pants.jpg', '55.00', 33, 'Pending', 3),
(76, 'Grey Sport Shirt Male', 'Sport Shirt specially for male only\r\nWorkout shirt time!!', 'shirt, grey, informal, workout', 'images/items/shirt.jpg', '300.00', 50, 'Pending', 1),
(77, 'Yahallo Shirt', 'YAHALLO from My Youth Romantic Comedy Is Wrong, As I Expected', 'white, woman, men, child', 'images/items/yahallo.jpg,images/items/yahallo1.jpg,images/items/yahallo3.jpg,images/items/yahallo4.jpg', '40.00', 100, 'Pending', 9),
(78, 'Batman Children Suit', 'Batman Suit for children only Batman cosplay', 'child, white, black, batman', 'images/items/batman1.jfif,images/items/batman2.png,images/items/batman3.jpg,images/items/batman4.jpg', '100.00', 100, 'Pending', 1),
(79, 'asdasda', 'dasdasda asda sdasd asd asda da da sdas d', 'asdasd', 'images/items/DFD0 v3.jpg', '100.00', 23, 'Removed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `productorder`
--

DROP TABLE IF EXISTS `productorder`;
CREATE TABLE IF NOT EXISTS `productorder` (
  `OrderId` int NOT NULL AUTO_INCREMENT,
  `UserId` int NOT NULL,
  `PurchaseDate` date NOT NULL,
  `OrderTotal` decimal(12,2) NOT NULL,
  PRIMARY KEY (`OrderId`),
  KEY `UserId` (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `productorder`
--

INSERT INTO `productorder` (`OrderId`, `UserId`, `PurchaseDate`, `OrderTotal`) VALUES
(1, 2, '2020-09-02', '22.26'),
(2, 2, '2020-09-02', '389.55'),
(3, 2, '2020-09-02', '309.41'),
(4, 3, '2020-09-02', '478.59'),
(5, 3, '2020-09-02', '33.39'),
(6, 2, '2020-07-02', '1491.42'),
(7, 4, '2020-09-02', '250.43'),
(8, 2, '2020-09-02', '445.20'),
(9, 5, '2020-09-02', '732.35'),
(10, 5, '2020-06-02', '66.78'),
(11, 5, '2020-09-02', '3839.85'),
(12, 4, '2020-09-02', '122.43'),
(13, 2, '2020-09-02', '122.43'),
(14, 3, '2020-04-02', '5475.96'),
(15, 6, '2020-09-02', '2962.81'),
(16, 2, '2020-09-02', '66.78'),
(17, 2, '2020-05-02', '333.90'),
(18, 7, '2020-09-02', '55.65'),
(19, 4, '2020-09-03', '1948.86'),
(20, 4, '2020-09-03', '174.74'),
(21, 8, '2020-08-03', '834.75'),
(22, 8, '2020-09-03', '1714.02'),
(23, 2, '2020-09-03', '22.26'),
(24, 5, '2020-09-03', '267.12'),
(25, 5, '2020-09-03', '211.47'),
(26, 5, '2020-09-03', '217.04'),
(27, 5, '2020-09-03', '77.91'),
(28, 5, '2020-09-03', '534.24'),
(29, 5, '2020-09-03', '1057.35'),
(30, 5, '2020-09-03', '233.73'),
(31, 5, '2020-09-04', '139.13'),
(32, 5, '2020-09-04', '300.51'),
(33, 5, '2020-09-04', '211.47'),
(34, 2, '2020-07-04', '879.27'),
(35, 10, '2020-09-08', '44.52'),
(36, 4, '2020-09-08', '1141.94'),
(37, 1, '2020-09-08', '1129.70'),
(38, 5, '2020-09-08', '116.87'),
(39, 4, '2020-09-08', '1101.87'),
(40, 5, '2020-09-08', '250.43'),
(41, 4, '2020-09-08', '33.39'),
(42, 4, '2020-09-08', '33.39'),
(43, 4, '2020-09-08', '211.47'),
(44, 11, '2020-09-09', '76.80'),
(45, 4, '2020-09-09', '151.37'),
(46, 2, '2020-05-09', '835.86'),
(47, 1, '2020-10-28', '322.77'),
(48, 1, '2020-10-30', '66.78'),
(49, 1, '2021-01-19', '431.84');

-- --------------------------------------------------------

--
-- Table structure for table `refund`
--

DROP TABLE IF EXISTS `refund`;
CREATE TABLE IF NOT EXISTS `refund` (
  `RefundId` int NOT NULL AUTO_INCREMENT,
  `OrderId` int NOT NULL,
  `ProductId` int NOT NULL,
  `Reason` varchar(255) NOT NULL,
  `RefundStatus` varchar(140) NOT NULL,
  `DateRequested` date NOT NULL,
  `Images` varchar(510) NOT NULL,
  PRIMARY KEY (`RefundId`),
  KEY `OrderId` (`OrderId`),
  KEY `ProductId` (`ProductId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `refund`
--

INSERT INTO `refund` (`RefundId`, `OrderId`, `ProductId`, `Reason`, `RefundStatus`, `DateRequested`, `Images`) VALUES
(2, 1, 32, 'Woi this thing broke in 2 mins leh really like pxiels oni weyh damn broke bro, i attach image of my face to show disgust bro yux', 'Pending', '2020-09-02', 'images/refund/ew.jpg'),
(3, 7, 30, 'the sunglasses came with no yellow tint. it was transparent as shown in image attached', 'Pending', '2020-09-03', 'images/refund/617Ho4ClLKL._AC_UY395_.jpg'),
(4, 7, 49, 'shit product give me money back', 'Denied', '2020-09-03', 'images/refund/Emoji_Icon_-_Clown_emoji_1024x1024.png'),
(5, 7, 57, 'i feel personally offended', 'Pending', '2020-09-03', 'images/refund/tank.png'),
(6, 19, 39, 'the shirt tore after 1 wash', 'Pending', '2020-09-03', 'images/refund/7ff144f54d56244272424788f10d9604.jpg'),
(7, 20, 46, 'the bag came with no design', 'Pending', '2020-09-03', 'images/refund/e8b1abb645147eae96b48ac8df66ae8e.jpg'),
(8, 20, 44, 'the shirt came with the wrong design', 'Pending', '2020-09-03', 'images/refund/ssrco.jpg'),
(9, 22, 40, 'it made me laugh whenever i looked in the mirror when i was wearing it so i tore the shirt', 'Pending', '2020-09-03', 'images/refund/swimsuit miku.jpg'),
(10, 24, 6, 'Full of holes according to the picture i sent', 'Approved', '2020-09-03', 'images/refund/holes.jfif'),
(11, 25, 61, 'Dark Spots around ', 'Approved', '2020-09-03', 'images/refund/dirty.jpg'),
(12, 26, 8, 'Does not look alike ', 'Approved', '2020-09-03', 'images/refund/comfyofficeshoe.jpg'),
(13, 27, 9, 'Does not look alike at all >:(', 'Approved', '2020-09-03', 'images/refund/Formalshoe2.jpg'),
(15, 29, 61, 'YOU GAVE ME THIS SHIRT INSTEAD!!!', 'Denied', '2020-09-03', 'images/refund/Shirt1.jpg'),
(16, 31, 73, 'You gave me this instead, what the heck is your problem?', 'Denied', '2020-09-04', 'images/refund/kidsbackpack2.jpg'),
(17, 32, 17, 'WRONG PRODUCT ONCE AGAIN!!!', 'Denied', '2020-09-04', 'images/refund/kidsbackpack1.jfif'),
(18, 33, 61, 'You gave me this Blazer instead :/', 'Pending', '2020-09-04', 'images/refund/Blazer1.2.jpg'),
(19, 34, 44, 'Shirt color is wash away when washed.', 'Pending', '2020-09-04', 'images/refund/whiteshirt.png'),
(21, 36, 2, 'these high heels broke like how aunty ryan broke my heart', 'Pending', '2020-09-08', 'images/refund/ryan.jpeg'),
(22, 37, 3, 'its green in colour not pink !!!', 'Pending', '2020-09-08', 'images/refund/11374754-6843213-image-m-2_1553383937020.jpg'),
(23, 39, 4, 'this is the wrong tshirt it has no ballerina print', 'Approved', '2020-09-08', 'images/refund/sharveen.png'),
(24, 38, 5, 'WRONG SHIRT DAMMIT, YOU GAVE ME A SPORT SHIRT ', 'Approved', '2020-09-08', 'images/refund/shirt.jpg'),
(25, 45, 1, 'asdadad', 'Pending', '2020-09-09', 'images/refund/mFZRSgff.jpeg'),
(26, 45, 2, 'asdadda', 'Pending', '2020-09-09', 'images/refund/Capture.PNG'),
(27, 43, 61, 'asdadadad', 'Pending', '2020-09-09', 'images/refund/woon4.jpeg'),
(28, 47, 9, 'weweawewae', 'Pending', '2020-10-28', 'images/refund/class diag.jpg'),
(29, 37, 40, 'yeet', 'Pending', '2020-12-10', 'images/refund/DFD0 v3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `ReportId` int NOT NULL AUTO_INCREMENT,
  `ProductId` int NOT NULL,
  `ReportReason` varchar(140) NOT NULL,
  PRIMARY KEY (`ReportId`),
  KEY `ProductId` (`ProductId`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`ReportId`, `ProductId`, `ReportReason`) VALUES
(3, 32, 'Fake'),
(4, 32, 'Fake'),
(5, 32, 'InappropriatePicture'),
(6, 54, 'FalseAd'),
(7, 57, 'Fake'),
(8, 36, 'FalseAd'),
(9, 36, 'InappropriateName'),
(11, 49, 'FalseAd'),
(12, 52, 'Fake'),
(13, 57, 'FalseAd'),
(15, 49, 'FalseAd'),
(16, 44, 'InappropriatePicture'),
(17, 44, 'FalseAd'),
(18, 46, 'InappropriateName'),
(19, 44, 'InappropriateName'),
(34, 61, 'FalseAd'),
(35, 61, 'InappropriatePicture');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `ReviewId` int NOT NULL AUTO_INCREMENT,
  `ProductId` int NOT NULL,
  `UserId` int NOT NULL,
  `ReviewRating` int NOT NULL,
  `ReviewTitle` varchar(140) NOT NULL,
  `ReviewComment` varchar(240) NOT NULL,
  `ReviewDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ReviewId`),
  KEY `ProductId` (`ProductId`),
  KEY `UserId` (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`ReviewId`, `ProductId`, `UserId`, `ReviewRating`, `ReviewTitle`, `ReviewComment`) VALUES
(2, 32, 2, 5, 'Dank meme bro', '100% quality meme material. Would buy again.'),
(3, 9, 2, 4, 'is good instant shoe', 'i just pour water and wait 1 minute ez 10/10'),
(4, 16, 2, 5, 'i can be my dream', 'i always want to be yakuza now i can\r\nthankx 10/10'),
(5, 30, 2, 3, 'this glasses too yellow', 'this glass make everything yellow not nice :('),
(6, 57, 3, 1, 'bullshit', 'I am beautiful >.<'),
(7, 32, 4, 5, 'meme god', 'made me real good mayn got me all the ladies'),
(8, 57, 4, 5, 'Cool mask', 'product mantap. quality beb shipping pun cepat xde komplain. boleh repeat'),
(9, 54, 2, 2, 'i only get helmet', 'NO MONKEYS THIS IS SCAME!!!'),
(10, 23, 5, 5, 'Fuh', 'Fuh really form the future eh, imma living in Cyberpunk 2077'),
(11, 16, 5, 5, 'Dame Dane', 'DAME DANE '),
(12, 30, 4, 5, 'Nice glasses', 'good quality, worth for price. would buy again'),
(14, 15, 5, 5, 'I don\'t have any oppai :( ', 'But now I do :D '),
(15, 45, 2, 4, 'this shirt make me less fat', 'people will see the shirt and not my fat stomach so i fell less fat. 10/10'),
(16, 55, 2, 3, 'i liek fairytail', 'i like faritail so i buy this shirt very nice material.'),
(17, 49, 4, 5, 'Comfortable home slippers', 'produk berkualiti. seller baik bungkus cantik. shipping pun cepat'),
(18, 57, 5, 2, 'Kinda fake', 'Looks good in picture, doesn\'t look good in real life '),
(19, 39, 5, 5, 'Bought it for my whole family', 'THey LIKED IT'),
(20, 52, 4, 5, 'WORKS LIKE IN TITLE', 'i tried scaring my mom wearing this while holding a knife and she ran away giving me her money. ez cash bruh'),
(22, 50, 3, 5, 'Weebo', 'Weeb fans here bois!!!'),
(23, 57, 2, 5, 'i buy 2', 'one for myself and one for myself. i rate 10/10\r\nape shall not kill ape'),
(24, 52, 2, 4, 'i feel safe in this suit', 'best furry suit i buy thanks.'),
(25, 15, 2, 5, 'i now can be one punch man', 'i can one punch my oppai'),
(26, 18, 2, 5, 'i use this for cosplay', 'i cosplay crypto from apex legends.'),
(27, 64, 2, 5, 'i buy this air', 'and i wait 2 weeks and i didnt get covid. this is good quality air 5/5'),
(29, 36, 2, 5, 'berts nekclasle', 'I boughy for my neck, he like it'),
(30, 63, 2, 5, 'i love naruto', 'i like naruto i use this shirt to naruto run'),
(31, 44, 2, 4, 'Good quality material', 'Nice face I wear outside all the time. Shipping is fast. 10/10'),
(32, 4, 4, 4, 'It has nice tippy toes', 'yo this mad soft cloth'),
(33, 61, 5, 5, 'Wow ', 'Suits me real good '),
(34, 61, 4, 5, 'Great for those kinky nights', 'red in colour like your mother'),
(35, 4, 5, 3, 'Kinda plain', 'the pattern is actually quite small, mostly white shirt'),
(36, 3, 4, 3, 'Could be better', 'stitching is off\r\npvc leather feels cheap\r\nwouldnt reorder'),
(37, 39, 2, 3, 'fake item', 'dont buy is fake item'),
(45, 50, 1, 4, 'good product', 'good nice'),
(46, 15, 1, 4, 'is not good ', 'yuck');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

DROP TABLE IF EXISTS `shopping_cart`;
CREATE TABLE IF NOT EXISTS `shopping_cart` (
  `UserId` int NOT NULL,
  `ProductId` int NOT NULL,
  `CartQuantity` int NOT NULL,
  PRIMARY KEY (`UserId`,`ProductId`),
  KEY `UserId` (`UserId`),
  KEY `ProductId` (`ProductId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`UserId`, `ProductId`, `CartQuantity`) VALUES
(1, 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `UserId` int NOT NULL AUTO_INCREMENT,
  `UserImage` varchar(140) NOT NULL DEFAULT 'images/users/user.jpg',
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `DOB` date NOT NULL,
  `Address` varchar(255) NOT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserId`, `UserImage`, `Username`, `Password`, `Email`, `Gender`, `DOB`, `Address`) VALUES
(1, 'images/users/8ccb87405482939261b5b5de2d2d17865cd6ace4.jpg', 'test', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'test@test.com', 'Female', '2019-11-01', 'No 1 Jalan Terus,\r\nTaman Permainan,\r\n57700 Seri Pintu\r\nSelangor'),
(2, 'images/users/462d1b4aa420b98275dd5728624041fd7e2b7ddb.jpg', 'woon', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'euseanwoon2016@gmail.com', 'Female', '2006-07-05', 'No. 50 Jalan Meme\r\nTaman Meme\r\n60000 Kingo\r\nSeleangor'),
(3, 'images/users/3ef4e8750702ad77a50e54feb111e954348a091f.png', 'onn', '068a90f127c721ab9acd248ea23d827c96906ff9', 'onn@mail.com', 'Male', '1970-01-01', '16-1, Jalan 17/105, Taman Midah, Cheras, 56000 K.L.'),
(4, 'images/users/db6082cb7bcadf7512ba3710cc99ec889d3a5c10.jpg', 'khor', '7ee3e81504e14c3e5b67ff2dbe8b4d987e91967b', 'khor@khor.com', 'Male', '1970-01-01', 'wooncity'),
(5, 'images/users/a1a2c8b4af31cb58a67772ed7578c1cd92e3b2c8.jpg', 'PaulYJY', 'de0e6e0e01d3a2c3b5d6e6d46079241c780cab2f', 'paulyjy@mail.com', 'Male', '2000-08-26', 'PaulYJY Town, Taiping, Perak Malaysia'),
(6, 'images/users/user.jpg', 'limphangzhen', '7623067fd91a1e8a99c9ff3f4c2f9924eb1a065a', 'glenn.phangzhen@gmail.com', '', '0000-00-00', ''),
(7, 'images/users/user.jpg', 'Cibai', '88ea39439e74fa27c09a4fc0bc8ebe6d00978392', 'sohaihamkachan@gmail.com', '', '0000-00-00', ''),
(8, 'images/users/c2d27607eef7280c1407141af4c3458fbcbe2b0c.png', 'carrot', 'd8bfad4b74d554312313bd842f4d05364c1ffadd', 'carrot@carrot.com', 'Male', '1970-01-01', 'carrot road'),
(9, 'images/users/user.jpg', 'potato', '3e2e95f5ad970eadfa7e17eaf73da97024aa5359', 'potato@email.com', '', '0000-00-00', ''),
(10, 'images/users/user.jpg', 'boy', 'ceac9b04aced67dceaf6577b30208737b9047093', 'boy@boy.com', 'Male', '1970-01-01', 'boy city'),
(11, 'images/users/403185da77250b0f5662a5fa5c7e8794bdfa0ded.jpg', 'wooneusean', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TP055977@mail.apu.edu.my', 'Male', '1970-01-01', 'woontown'),
(12, 'images/users/user.jpg', 'khorzhenwin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'TP055619@mail.apu.edu.my', '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `VendorId` int NOT NULL AUTO_INCREMENT,
  `ShopName` varchar(140) NOT NULL,
  `Username` varchar(140) NOT NULL,
  `Password` varchar(140) NOT NULL,
  `Email` varchar(140) NOT NULL,
  `Description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Address` varchar(140) NOT NULL,
  `Balance` decimal(10,2) NOT NULL,
  `VendorImage` varchar(150) NOT NULL DEFAULT 'images/vendors/vendor.jpg',
  PRIMARY KEY (`VendorId`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`VendorId`, `ShopName`, `Username`, `Password`, `Email`, `Description`, `Address`, `Balance`, `VendorImage`) VALUES
(1, 'Seller Test', 'test', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'euseanwoon2015@gmail.com', 'Yeeeeeeet\r\n\r\n123\r\n\r\n4567', 'No1. Taman Tasik Permai Taiping', '0.00', 'images/vendors/Extra1.png'),
(3, 'RyjyShop', 'ryjy', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ryjy@mail.com', 'Good looking clothes just for you', '12 Wolf Street, Street Of The Wolf', '260.00', 'images/vendors/vendor1.png'),
(4, 'WhoonBiccShop', 'whoonbicc', '2c4ca15a88cafa94e27d09bab379c522ea72007a', 'whoonbicc@mail.com', 'Hippity Hoppity I shall provide clothes based on my property', '44 Harry Potter Land, Unmagical World', '3274.00', 'images/vendors/vendor2.png'),
(5, 'KhorCoreShop', 'khorcore', '64108b00996a4da76aa700b233735caffb9bffad', 'khorcore@mail.com', 'I SELL ONLY THE MOST 🔥🔥🔥🔥🔥 FIRE 🔥🔥🔥🔥🔥 CLOTHES\r\n🔥🔥🔥 BUY IT IF U ARE LIT AND PART OF THE LOGANG 🔥🔥🔥', '88 Corresponder Corresponding, Core Hore', '535.00', 'images/vendors/vendor3.png'),
(6, 'WokHayShop', 'wokhay', '0b8b326a7b6187619313ebfae603f1e8d533f4c5', 'wokhay@mail.com', 'HAIYAAAA WHY YOU WEAR NOT GOOD LOOKING CLOTHES, BUY MY CLOTHES LAH\r\n\r\nMSG, KING OF FLAVOUR, BETTER SALT. BUY MY MSG!', '78 Msg flavour, Better Salt', '600.00', 'images/vendors/vendor4.png'),
(7, 'UncleRogerShop', 'uncleroger', '693a11c4ced06c48ac6dc34a7029e4c3e898550c', 'uncleroger@mail.com', 'Uncle Roger give you high quality clothes unlike any other shops, come have a look ', '23 Aiyoyo Yaya, Ek Fryet Rize', '0.00', 'images/vendors/vendor5.jpg'),
(8, 'AndreOnnShop', 'andreonn', '4f195ece9cf0f46ed93a9dc5fdaca1336ca655c9', 'andreonn@mail.com', 'My clothes damn unique, once you have a glance of it, you can never turn your back to it', '96 Alatreon Safi, Jiva Fatalis', '5045.00', 'images/vendors/vendor6.jpg'),
(9, 'Glenn69Shop', 'glenn69', '6a2692c78e66eb83db160c9d56d79e3fe3d5af6c', 'glenn69@mail.com', 'Left Right Up Down, no matter how everyone looks at you in any direction, they gonna be jealous of your fashion sense', '48 Geena Gregg, Glennchotan Gleeno', '8573.00', 'images/vendors/687444329039659075.png'),
(10, 'FrancFrunkShop', 'francfrunk', '7a1ea28b0173bdb742a05fbaf75e42735fc5b77d', 'francfrunk@mail.com', 'I come from the East, but my sales of clothes rise like yeast', '57 Tenom Coffee, Kopi Susu', '2065.00', 'images/vendors/vendor8.png'),
(11, 'Organ Harvester', 'kidneyfailure', '30632c306ba7c5de34561bf6a06ff09e62d805cd', 'kidneyfailure@mail.com', 'Here to provide you fantastic looking clothes like never before. Prepare the horror!!!', '5 KidneyKidnapper, Doctornurse Road', '900.00', 'images/vendors/vendor9.jpg');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`VendorId`) REFERENCES `vendor` (`VendorId`);

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `productorder` (`OrderId`),
  ADD CONSTRAINT `orderitem_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `product` (`ProductId`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`VendorId`) REFERENCES `vendor` (`VendorId`);

--
-- Constraints for table `productorder`
--
ALTER TABLE `productorder`
  ADD CONSTRAINT `productorder_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`);

--
-- Constraints for table `refund`
--
ALTER TABLE `refund`
  ADD CONSTRAINT `refund_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `productorder` (`OrderId`),
  ADD CONSTRAINT `refund_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `product` (`ProductId`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `product` (`ProductId`);

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`ProductId`) REFERENCES `product` (`ProductId`),
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `user` (`UserId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
