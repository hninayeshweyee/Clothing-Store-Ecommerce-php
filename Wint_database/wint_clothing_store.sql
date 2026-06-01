-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2025 at 06:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wint_clothing_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandID` int(11) NOT NULL,
  `brandName` varchar(50) NOT NULL,
  `status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandID`, `brandName`, `status`) VALUES
(1, 'Ecoware', NULL),
(2, 'Monowear', NULL),
(9, 'Bebe', NULL),
(10, 'Micheal Kors', NULL),
(11, 'CostWay', NULL),
(12, 'Champion', NULL),
(13, 'Polo', NULL),
(14, 'Levi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(50) NOT NULL,
  `status` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`, `status`) VALUES
(1, 'Kids', NULL),
(2, 'Men', NULL),
(3, 'Women', NULL),
(8, 'Girls ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `colorID` int(11) NOT NULL,
  `colorName` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`colorID`, `colorName`, `image`) VALUES
(1, 'Yellow', '../images/ColorImage/images (3).png'),
(2, 'Blue', '../images/ColorImage/blue0517-4dfc85cb0200460ab717b101ac07888f.jpg'),
(6, 'GreenBlack', '../images/ColorImage/images (4).png'),
(7, 'Ivory', '../images/ColorImage/images (1).png'),
(8, 'Taupe', '../images/ColorImage/images.png'),
(9, 'Orchid', '../images/ColorImage/Orchid-Purple.png'),
(11, 'White', '../images/ColorImage/images.jpg'),
(12, 'Black', '../images/ColorImage/_images (2).png'),
(13, 'Navy', '../images/ColorImage/_8984_915x0_fit_478b24840a.jpg'),
(14, 'Gray', '../images/ColorImage/_2128-40-oxfordgray_e4446d27-280a-4f78-a919-b5931e7ff7e1_4096x.webp'),
(15, 'LightPink', '../images/ColorImage/_light.avif'),
(17, 'Red', '../images/ColorImage/_images (5).png'),
(18, 'Mid Summer', '../images/ColorImage/_images (1).jpg'),
(19, 'Sand', '../images/ColorImage/_images (6).png'),
(20, 'CafeTan', '../images/ColorImage/_design-space-paper-textured-background_53876-41743.avif'),
(21, 'Pinstripe', '../images/ColorImage/muse-wall-studio-perfect-pinstripes-in-pink-peel-and-stick-wallpaper-perfect-pinstripes-in-pink-12485851381846.png'),
(22, 'Blushing', '../images/ColorImage/_gjhhfgdd.png'),
(23, 'Rich Black', '../images/ColorImage/_gghfgdfgd.png'),
(24, 'LightGrey', '../images/ColorImage/_vhgfhgf.png'),
(25, 'Floral', '../images/ColorImage/_fkkakf.png'),
(26, 'Orange', '../images/ColorImage/_images (7).png'),
(27, 'Shell Pink', '../images/ColorImage/_29605520_fpx.webp'),
(28, 'Brown', '../images/ColorImage/_gjffgdr.png'),
(29, 'Baby-Blue', '../images/ColorImage/_28839648_fpx.webp'),
(30, 'Baby-Pink', '../images/ColorImage/_28840311_fpx.webp'),
(31, 'Desert Orange', '../images/ColorImage/_Screenshot 2024-12-29 233358.png'),
(32, 'BlackWhite', '../images/ColorImage/_kghjghg.png');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contactID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contactID`, `name`, `email`, `message`) VALUES
(1, 'Hnin Aye Shwe Yee', 'h@gmail.com', 'Hello'),
(2, 'Pwint Thaw', 'p@gmail.com', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL,
  `customerName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `gender` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `customerName`, `email`, `phoneNumber`, `dateOfBirth`, `gender`, `password`, `image`) VALUES
(1, 'Hnin Aye Shwe Yee', 'hnin@gmail.com', '09765579200', '2003-09-23', 'Female', 'Hnin123!@#', '../images/CustomerImage_1 photo added.jpg'),
(2, 'Pwint', 'pw@gmail.com', '0988766776', '2025-01-09', 'Female', '', '../images/CustomerImage_ghfhhg.png'),
(3, 'Pwint', 'pwu@gmail.com', '0988766776', '2025-01-20', 'Female', '', '../images/CustomerImage_ghfhhg.png'),
(4, '', '', '0988766776', '2025-01-14', 'Female', 'Pwint123!@#', '../images/CustomerImage_ghfhhg.png'),
(5, 'Pwint', 'pwn@gmail.com', '0988766776', '2025-01-22', 'Female', 'Pwint123!@#', '../images/CustomerImage_ghfhhg.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `subTotal` decimal(10,0) NOT NULL,
  `tax` decimal(10,0) NOT NULL,
  `totalAmount` decimal(10,0) NOT NULL,
  `location` varchar(255) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `customerID` int(11) NOT NULL,
  `paymentType` varchar(50) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderDate`, `subTotal`, `tax`, `totalAmount`, `location`, `phoneNumber`, `customerID`, `paymentType`, `remarks`, `status`) VALUES
(92, '2024-12-27', 10000, 500, 10500, 'Yangon', '2024-12-27', 1, 'WavePay', '', 'Confirmed'),
(93, '2024-12-27', 46000, 2300, 48300, 'Yangon', '2024-12-27', 1, 'Kpay', '', 'Confirmed'),
(94, '2024-12-27', 49500, 2475, 51975, 'Yangon', '2024-12-27', 1, 'Kpay', '', 'Pending'),
(95, '2024-12-27', 15000, 750, 15750, 'Yangon', '2024-12-27', 1, 'WavePay', '', 'Pending'),
(96, '2024-12-29', 86000, 4300, 90300, 'Yangon', '2024-12-29', 1, 'Kpay', '', 'Pending'),
(97, '2025-01-02', 30000, 1500, 31500, 'Yangon', '0988766776', 1, 'Kpay', '', 'Pending'),
(98, '2025-01-02', 10000, 500, 10500, 'Yangon', '0988766776', 1, 'Kpay', '', 'Pending'),
(99, '2025-01-04', 10000, 500, 10500, 'Yangon', '0988766776', 1, 'WavePay', '', 'Pending'),
(100, '2025-01-06', 8500, 425, 8925, 'Yangon', '0988766776', 1, 'WavePay', '', 'Pending'),
(101, '2025-01-06', 60500, 3025, 63525, 'Yangon ', '0988766776 ', 1, 'Kpay', '', 'Pending'),
(102, '2025-01-19', 60000, 3000, 63000, 'Yangon ', '09765579200', 1, 'Kpay', '', 'Pending'),
(103, '2025-01-25', 136000, 6800, 142800, 'Hlaing, Yangon', '09765537878', 1, 'Kpay', '', 'Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `orderDetailID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `variationID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchasePrice` decimal(11,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`orderDetailID`, `orderID`, `variationID`, `quantity`, `purchasePrice`) VALUES
(37, 90, 44, 1, 10000),
(38, 91, 44, 1, 10000),
(39, 92, 44, 1, 10000),
(40, 93, 44, 1, 10000),
(41, 93, 29, 2, 18000),
(42, 94, 28, 1, 15000),
(43, 94, 36, 1, 16500),
(44, 94, 22, 1, 18000),
(45, 95, 28, 1, 15000),
(46, 96, 139, 1, 40000),
(47, 96, 123, 1, 46000),
(48, 97, 16, 1, 30000),
(49, 98, 33, 1, 10000),
(50, 99, 44, 1, 10000),
(51, 100, 48, 1, 8500),
(52, 101, 47, 1, 8500),
(53, 101, 75, 1, 52000),
(54, 102, 20, 1, 30000),
(55, 102, 27, 2, 15000),
(56, 103, 70, 2, 50000),
(57, 103, 31, 2, 18000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `description` varchar(225) NOT NULL,
  `brandID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `description`, `brandID`, `categoryID`) VALUES
(16, 'Women Pleated Single-Breasted Coat', '-', 1, 3),
(17, 'Women Puff Sleeve Quilted Sweater Dress', 'sold by Bebe', 9, 3),
(18, 'Womens Long-Sleeve Wrap Dress', '-', 2, 3),
(19, 'Women Studded Cut-Out Mock-Neck Top', '-', 2, 3),
(21, 'Men Powerblend Fleece Hoodie', '-', 2, 2),
(22, 'Toddler & Little Girls Puffer with Sherpa Collar', '-', 2, 1),
(23, 'Baby Girls Cable-Knit Cotton Cardigan', '-', 13, 1),
(24, 'Women Halsey', 'Summer Clothes', 14, 3),
(25, 'Men Relaxed Fit Twill ', '-', 14, 2),
(26, 'Cotton Flannel Packaged Pajamas Set', '-', 13, 3),
(27, 'Women Star-Print Long-Sleeve Crewneck Sweater', '-', 12, 3),
(28, ' Fit Crew Neck Pocket T-Shirt', '-', 14, 2),
(29, 'Women Tiered High Low Gown', '-', 9, 3),
(30, 'Women Strapless  Bandage Midi', 'sold by Bebe', 9, 3),
(31, 'Women Cape Sleeve Midi Dress', 'sold by Bebe', 9, 3),
(32, 'Baby Boys Car-Print T-Shirt', '-', 2, 1),
(33, 'Toddler Girls Rainbow Smiley T-Shirt', '-', 13, 1),
(34, 'Baby Boys Winnie', '-', 14, 1),
(35, 'Baby Faux-Sherpa Hooded Jacket', '-', 11, 1),
(36, 'Men Windward Lined Plaid Shirt Jacket', '-', 10, 2),
(37, 'Men Modern-Fit TH Flex Stretch Pants', '-', 2, 2),
(38, 'Men Rivers Printed Sleeve Shirt', '-', 12, 2),
(39, 'Women Crisscross Fit & Flare Dress', '-', 13, 3),
(40, 'Women Relaxed Long Sleeve Tunic', '-', 14, 3),
(41, 'Long-Sleeve V Sweater Dress', '-', 2, 3),
(42, 'Little Girls Lurex Stripe Knit Dress ', '-', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `variationID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `sizeID` int(11) NOT NULL,
  `colorID` int(11) NOT NULL,
  `productPrice` decimal(10,2) NOT NULL,
  `productQuantity` int(11) NOT NULL,
  `image_1` varchar(255) DEFAULT NULL,
  `image_2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`variationID`, `productID`, `sizeID`, `colorID`, `productPrice`, `productQuantity`, `image_1`, `image_2`) VALUES
(9, 16, 3, 12, 25000.00, 4, '../images/ProductImage/_image1.webp', '../images/ProductImage/_image2.webp'),
(10, 16, 3, 7, 25000.00, 3, '../images/ProductImage/_image3.webp', '../images/ProductImage/_image4.webp'),
(11, 16, 2, 12, 25000.00, 2, '../images/ProductImage/_image1.webp', '../images/ProductImage/_image2.webp'),
(12, 16, 1, 12, 25000.00, 3, '../images/ProductImage/_image1.webp', '../images/ProductImage/_image2.webp'),
(13, 16, 2, 7, 25000.00, 17, '../images/ProductImage/_image3.webp', '../images/ProductImage/_image4.webp'),
(14, 16, 1, 7, 25000.00, 2, '../images/ProductImage/_image3.webp', '../images/ProductImage/_image4.webp'),
(15, 17, 3, 9, 30000.00, 6, '../images/ProductImage/26530264_fpx.webp', '../images/ProductImage/_image6.webp'),
(16, 17, 2, 9, 35000.00, 3, '../images/ProductImage/26530264_fpx.webp', '../images/ProductImage/_image6.webp'),
(17, 17, 1, 9, 35000.00, 8, '../images/ProductImage/26530264_fpx.webp', '../images/ProductImage/_image6.webp'),
(18, 17, 6, 9, 35000.00, 13, '../images/ProductImage/26530264_fpx.webp', '../images/ProductImage/_image6.webp'),
(19, 17, 3, 8, 35000.00, 5, '../images/ProductImage/_image7.webp', '../images/ProductImage/_image8.webp'),
(20, 17, 2, 8, 35000.00, 10, '../images/ProductImage/_image7.webp', '../images/ProductImage/_image8.webp'),
(21, 18, 3, 6, 35000.00, 18, '../images/ProductImage/_image9.webp', '../images/ProductImage/_image10.webp'),
(22, 19, 3, 1, 18000.00, 9, '../images/ProductImage/_image11.webp', '../images/ProductImage/_image11.webp'),
(24, 21, 2, 13, 15000.00, 11, '../images/ProductImage/image5.webp', '../images/ProductImage/_30348917_fpx.webp'),
(25, 21, 1, 13, 15000.00, 7, '../images/ProductImage/image5.webp', '../images/ProductImage/_30348917_fpx.webp'),
(26, 21, 6, 13, 15000.00, 3, '../images/ProductImage/image5.webp', '../images/ProductImage/_30348917_fpx.webp'),
(27, 21, 6, 14, 15000.00, 2, '../images/ProductImage/_3876895_fpx.webp', '../images/ProductImage/_30348717_fpx.webp'),
(28, 21, 1, 14, 15000.00, 7, '../images/ProductImage/_3876895_fpx.webp', '../images/ProductImage/_30348717_fpx.webp'),
(29, 22, 16, 15, 18000.00, 5, '../images/ProductImage/_29126997_fpx.webp', '../images/ProductImage/_29126996_fpx.webp'),
(30, 22, 17, 15, 18000.00, 9, '../images/ProductImage/_29126997_fpx.webp', '../images/ProductImage/_29126996_fpx.webp'),
(31, 22, 18, 11, 18000.00, 8, '../images/ProductImage/_29126991_fpx.webp', '../images/ProductImage/_29126994_fpx.webp'),
(32, 23, 9, 17, 10000.00, 24, '../images/ProductImage/_29516401_fpx.webp', '../images/ProductImage/_29516402_fpx.webp'),
(33, 23, 9, 13, 10000.00, 33, '../images/ProductImage/_9266762_fpx.webp', '../images/ProductImage/_9266761_fpx.webp'),
(34, 24, 6, 18, 16500.00, 16, '../images/ProductImage/_27842688_fpx.webp', '../images/ProductImage/_27842690_fpx.webp'),
(35, 24, 2, 18, 16500.00, 29, '../images/ProductImage/_27842688_fpx.webp', '../images/ProductImage/_27842690_fpx.webp'),
(36, 24, 1, 18, 16500.00, 7, '../images/ProductImage/_27842688_fpx.webp', '../images/ProductImage/_27842690_fpx.webp'),
(37, 25, 1, 19, 20000.00, 7, '../images/ProductImage/_9465445_fpx.webp', '../images/ProductImage/_9465447_fpx.webp'),
(38, 25, 2, 19, 20000.00, 6, '../images/ProductImage/_9465445_fpx.webp', '../images/ProductImage/_9465447_fpx.webp'),
(39, 25, 3, 19, 20000.00, 6, '../images/ProductImage/_9465445_fpx.webp', '../images/ProductImage/_9465447_fpx.webp'),
(40, 25, 2, 20, 20000.00, 9, '../images/ProductImage/_9465441_fpx.webp', '../images/ProductImage/_9465443_fpx.webp'),
(41, 25, 1, 20, 20000.00, 5, '../images/ProductImage/_9465441_fpx.webp', '../images/ProductImage/_9465443_fpx.webp'),
(44, 26, 6, 21, 10000.00, 33, '../images/ProductImage/_28445106_fpx.webp', '../images/ProductImage/_28445108_fpx.webp'),
(45, 27, 6, 22, 8500.00, 6, '../images/ProductImage/_30698591_fpx.webp', '../images/ProductImage/_30698592_fpx.webp'),
(46, 27, 3, 22, 8500.00, 6, '../images/ProductImage/_30698591_fpx.webp', '../images/ProductImage/_30698592_fpx.webp'),
(47, 27, 2, 23, 8500.00, 6, '../images/ProductImage/_30698612_fpx.webp', '../images/ProductImage/_30698613_fpx.webp'),
(48, 27, 1, 23, 8500.00, 5, '../images/ProductImage/_30698612_fpx.webp', '../images/ProductImage/_30698613_fpx.webp'),
(49, 27, 7, 23, 8500.00, 7, '../images/ProductImage/_30698612_fpx.webp', '../images/ProductImage/_30698613_fpx.webp'),
(50, 27, 1, 24, 8500.00, 7, '../images/ProductImage/_30698600_fpx.webp', '../images/ProductImage/_30698601_fpx.webp'),
(51, 27, 2, 24, 8500.00, 5, '../images/ProductImage/_30698600_fpx.webp', '../images/ProductImage/_30698601_fpx.webp'),
(52, 27, 3, 24, 8500.00, 3, '../images/ProductImage/_30698600_fpx.webp', '../images/ProductImage/_30698601_fpx.webp'),
(53, 27, 6, 24, 8500.00, 5, '../images/ProductImage/_30698600_fpx.webp', '../images/ProductImage/_30698601_fpx.webp'),
(54, 28, 1, 18, 11000.00, 8, '../images/ProductImage/_29584478_fpx.webp', '../images/ProductImage/_29584480_fpx.webp'),
(55, 28, 2, 18, 11000.00, 7, '../images/ProductImage/_29584478_fpx.webp', '../images/ProductImage/_29584480_fpx.webp'),
(56, 28, 3, 18, 11000.00, 6, '../images/ProductImage/_29584478_fpx.webp', '../images/ProductImage/_29584480_fpx.webp'),
(57, 28, 6, 11, 11000.00, 7, '../images/ProductImage/_9755026_fpx.webp', '../images/ProductImage/_9755028_fpx.webp'),
(58, 28, 2, 11, 11000.00, 7, '../images/ProductImage/_9755026_fpx.webp', '../images/ProductImage/_9755028_fpx.webp'),
(59, 28, 2, 12, 11000.00, 5, '../images/ProductImage/_9755022_fpx.webp', '../images/ProductImage/_9755024_fpx.webp'),
(60, 28, 3, 12, 11000.00, 3, '../images/ProductImage/_9755022_fpx.webp', '../images/ProductImage/_9755024_fpx.webp'),
(61, 29, 3, 12, 55000.00, 5, '../images/ProductImage/_30004415_fpx.webp', '../images/ProductImage/_30004428_fpx.webp'),
(62, 29, 2, 12, 55000.00, 5, '../images/ProductImage/_30004415_fpx.webp', '../images/ProductImage/_30004428_fpx.webp'),
(63, 29, 1, 25, 55000.00, 6, '../images/ProductImage/_30004418_fpx.webp', '../images/ProductImage/_30004417_fpx.webp'),
(64, 29, 2, 25, 55000.00, 5, '../images/ProductImage/_30004418_fpx.webp', '../images/ProductImage/_30004417_fpx.webp'),
(65, 29, 3, 25, 55000.00, 7, '../images/ProductImage/_30004418_fpx.webp', '../images/ProductImage/_30004417_fpx.webp'),
(66, 30, 1, 2, 50000.00, 7, '../images/ProductImage/_28671344_fpx.webp', '../images/ProductImage/_28671345_fpx.webp'),
(67, 30, 2, 2, 50000.00, 9, '../images/ProductImage/_28671344_fpx.webp', '../images/ProductImage/_28671345_fpx.webp'),
(68, 30, 3, 2, 50000.00, 6, '../images/ProductImage/_28671344_fpx.webp', '../images/ProductImage/_28671345_fpx.webp'),
(69, 30, 7, 2, 50000.00, 3, '../images/ProductImage/_28671344_fpx.webp', '../images/ProductImage/_28671345_fpx.webp'),
(70, 30, 6, 26, 50000.00, 9, '../images/ProductImage/_28799789_fpx.webp', '../images/ProductImage/_28799792_fpx.webp'),
(71, 30, 1, 26, 50000.00, 5, '../images/ProductImage/_28799789_fpx.webp', '../images/ProductImage/_28799792_fpx.webp'),
(72, 30, 2, 26, 50000.00, 16, '../images/ProductImage/_28799789_fpx.webp', '../images/ProductImage/_28799792_fpx.webp'),
(73, 31, 7, 15, 52000.00, 5, '../images/ProductImage/_29885913_fpx.webp', '../images/ProductImage/_29885923_fpx.webp'),
(74, 31, 3, 15, 52000.00, 13, '../images/ProductImage/_29885913_fpx.webp', '../images/ProductImage/_29885923_fpx.webp'),
(75, 31, 2, 15, 52000.00, 6, '../images/ProductImage/_29885913_fpx.webp', '../images/ProductImage/_29885923_fpx.webp'),
(76, 31, 1, 15, 52000.00, 7, '../images/ProductImage/_29885913_fpx.webp', '../images/ProductImage/_29885923_fpx.webp'),
(77, 32, 9, 13, 12000.00, 5, '../images/ProductImage/_28641113_fpx.webp', '../images/ProductImage/_28641144_fpx.webp'),
(78, 32, 10, 13, 12000.00, 6, '../images/ProductImage/_28641113_fpx.webp', '../images/ProductImage/_28641144_fpx.webp'),
(79, 32, 11, 13, 12000.00, 7, '../images/ProductImage/_28641113_fpx.webp', '../images/ProductImage/_28641144_fpx.webp'),
(80, 33, 13, 27, 18000.00, 5, '../images/ProductImage/_29605517_fpx.webp', '../images/ProductImage/_29605519_fpx.webp'),
(81, 33, 14, 27, 18000.00, 7, '../images/ProductImage/_29605517_fpx.webp', '../images/ProductImage/_29605519_fpx.webp'),
(82, 33, 15, 27, 18000.00, 7, '../images/ProductImage/_29605517_fpx.webp', '../images/ProductImage/_29605519_fpx.webp'),
(83, 34, 8, 28, 13500.00, 7, '../images/ProductImage/_29849865_fpx.webp', '../images/ProductImage/_29851078_fpx.webp'),
(84, 34, 9, 28, 13500.00, 6, '../images/ProductImage/_29849865_fpx.webp', '../images/ProductImage/_29851078_fpx.webp'),
(85, 34, 10, 28, 13500.00, 6, '../images/ProductImage/_29849865_fpx.webp', '../images/ProductImage/_29851078_fpx.webp'),
(87, 34, 11, 28, 13500.00, 6, '../images/ProductImage/_29849865_fpx.webp', '../images/ProductImage/_29851078_fpx.webp'),
(88, 35, 13, 29, 19000.00, 9, '../images/ProductImage/_28833243_fpx.webp', '../images/ProductImage/_28839648_fpx.webp'),
(89, 35, 14, 29, 19000.00, 8, '../images/ProductImage/_28833243_fpx.webp', '../images/ProductImage/_28839648_fpx.webp'),
(90, 35, 13, 30, 19000.00, 7, '../images/ProductImage/_28833294_fpx.webp', '../images/ProductImage/_28840311_fpx.webp'),
(91, 35, 14, 30, 19000.00, 6, '../images/ProductImage/_28833294_fpx.webp', '../images/ProductImage/_28840311_fpx.webp'),
(92, 36, 3, 28, 25000.00, 6, '../images/ProductImage/_29824124_fpx.webp', '../images/ProductImage/_29824141_fpx.webp'),
(93, 36, 2, 28, 25000.00, 7, '../images/ProductImage/_29824124_fpx.webp', '../images/ProductImage/_29824141_fpx.webp'),
(94, 36, 1, 28, 25000.00, 5, '../images/ProductImage/_29824124_fpx.webp', '../images/ProductImage/_29824141_fpx.webp'),
(95, 36, 6, 28, 25000.00, 5, '../images/ProductImage/_29824124_fpx.webp', '../images/ProductImage/_29824141_fpx.webp'),
(96, 36, 3, 2, 25000.00, 6, '../images/ProductImage/_29824125_fpx.webp', '../images/ProductImage/_29824145_fpx.webp'),
(97, 36, 1, 2, 25000.00, 7, '../images/ProductImage/_29824125_fpx.webp', '../images/ProductImage/_29824145_fpx.webp'),
(98, 36, 6, 2, 25000.00, 7, '../images/ProductImage/_29824125_fpx.webp', '../images/ProductImage/_29824145_fpx.webp'),
(99, 36, 3, 12, 25000.00, 8, '../images/ProductImage/_29824122_fpx.webp', '../images/ProductImage/_29824126_fpx.webp'),
(100, 36, 2, 12, 25000.00, 4, '../images/ProductImage/_29824122_fpx.webp', '../images/ProductImage/_29824126_fpx.webp'),
(101, 36, 1, 12, 25000.00, 9, '../images/ProductImage/_29824122_fpx.webp', '../images/ProductImage/_29824126_fpx.webp'),
(102, 36, 1, 6, 25000.00, 9, '../images/ProductImage/_29824123_fpx.webp', '../images/ProductImage/_29824137_fpx.webp'),
(103, 36, 2, 6, 25000.00, 4, '../images/ProductImage/_29824123_fpx.webp', '../images/ProductImage/_29824137_fpx.webp'),
(104, 36, 3, 6, 25000.00, 6, '../images/ProductImage/_29824123_fpx.webp', '../images/ProductImage/_29824137_fpx.webp'),
(105, 36, 6, 6, 25000.00, 6, '../images/ProductImage/_29824123_fpx.webp', '../images/ProductImage/_29824137_fpx.webp'),
(106, 37, 6, 19, 35000.00, 12, '../images/ProductImage/_22928358_fpx.webp', '../images/ProductImage/_22928356_fpx.webp'),
(107, 37, 7, 19, 35000.00, 7, '../images/ProductImage/_22928358_fpx.webp', '../images/ProductImage/_22928356_fpx.webp'),
(108, 37, 1, 19, 35000.00, 9, '../images/ProductImage/_22928358_fpx.webp', '../images/ProductImage/_22928356_fpx.webp'),
(109, 37, 2, 19, 35000.00, 9, '../images/ProductImage/_22928358_fpx.webp', '../images/ProductImage/_22928356_fpx.webp'),
(110, 37, 3, 19, 35000.00, 4, '../images/ProductImage/_22928358_fpx.webp', '../images/ProductImage/_22928356_fpx.webp'),
(111, 37, 3, 18, 35000.00, 7, '../images/ProductImage/_23205408_fpx.webp', '../images/ProductImage/_23205407_fpx.webp'),
(112, 37, 2, 18, 35000.00, 7, '../images/ProductImage/_23205408_fpx.webp', '../images/ProductImage/_23205407_fpx.webp'),
(113, 37, 1, 18, 35000.00, 3, '../images/ProductImage/_23205408_fpx.webp', '../images/ProductImage/_23205407_fpx.webp'),
(114, 37, 2, 13, 35000.00, 7, '../images/ProductImage/_9248304_fpx.webp', '../images/ProductImage/_9248367_fpx.webp'),
(115, 37, 3, 13, 35000.00, 7, '../images/ProductImage/_9248304_fpx.webp', '../images/ProductImage/_9248367_fpx.webp'),
(116, 37, 1, 13, 35000.00, 5, '../images/ProductImage/_9248304_fpx.webp', '../images/ProductImage/_9248367_fpx.webp'),
(117, 38, 1, 31, 20000.00, 5, '../images/ProductImage/_23547796_fpx.webp', '../images/ProductImage/_23547831_fpx.webp'),
(118, 38, 2, 31, 20000.00, 6, '../images/ProductImage/_23547796_fpx.webp', '../images/ProductImage/_23547831_fpx.webp'),
(119, 38, 3, 31, 20000.00, 9, '../images/ProductImage/_23547796_fpx.webp', '../images/ProductImage/_23547831_fpx.webp'),
(120, 38, 6, 31, 20000.00, 7, '../images/ProductImage/_23547796_fpx.webp', '../images/ProductImage/_23547831_fpx.webp'),
(121, 39, 7, 11, 46000.00, 4, '../images/ProductImage/_26375023_fpx.webp', '../images/ProductImage/_26375024_fpx.webp'),
(122, 39, 3, 11, 46000.00, 3, '../images/ProductImage/_26375023_fpx.webp', '../images/ProductImage/_26375024_fpx.webp'),
(123, 39, 2, 11, 46000.00, 5, '../images/ProductImage/_26375023_fpx.webp', '../images/ProductImage/_26375024_fpx.webp'),
(124, 39, 1, 11, 46000.00, 5, '../images/ProductImage/_26375023_fpx.webp', '../images/ProductImage/_26375024_fpx.webp'),
(125, 40, 1, 28, 31000.00, 5, '../images/ProductImage/_29788565_fpx.webp', '../images/ProductImage/_29788584_fpx.webp'),
(126, 40, 2, 28, 31000.00, 5, '../images/ProductImage/_29788565_fpx.webp', '../images/ProductImage/_29788584_fpx.webp'),
(127, 40, 3, 28, 31000.00, 7, '../images/ProductImage/_29788565_fpx.webp', '../images/ProductImage/_29788584_fpx.webp'),
(128, 40, 7, 28, 31000.00, 3, '../images/ProductImage/_29788565_fpx.webp', '../images/ProductImage/_29788584_fpx.webp'),
(129, 40, 1, 14, 31000.00, 6, '../images/ProductImage/_29788588_fpx.webp', '../images/ProductImage/_29788577_fpx.webp'),
(130, 40, 2, 14, 31000.00, 6, '../images/ProductImage/_29788588_fpx.webp', '../images/ProductImage/_29788577_fpx.webp'),
(131, 40, 6, 14, 31000.00, 2, '../images/ProductImage/_29788588_fpx.webp', '../images/ProductImage/_29788577_fpx.webp'),
(132, 40, 3, 13, 31000.00, 6, '../images/ProductImage/_29788589_fpx.webp', '../images/ProductImage/_29788575_fpx.webp'),
(133, 40, 2, 13, 31000.00, 8, '../images/ProductImage/_29788589_fpx.webp', '../images/ProductImage/_29788575_fpx.webp'),
(134, 40, 1, 13, 31000.00, 3, '../images/ProductImage/_29788589_fpx.webp', '../images/ProductImage/_29788575_fpx.webp'),
(135, 40, 6, 13, 31000.00, 5, '../images/ProductImage/_29788589_fpx.webp', '../images/ProductImage/_29788575_fpx.webp'),
(136, 41, 2, 30, 40000.00, 5, '../images/ProductImage/_30420215_fpx.webp', '../images/ProductImage/_30420216_fpx.webp'),
(137, 41, 1, 30, 40000.00, 3, '../images/ProductImage/_30420215_fpx.webp', '../images/ProductImage/_30420216_fpx.webp'),
(138, 41, 2, 17, 40000.00, 5, '../images/ProductImage/29520092_fpx.webp', '../images/ProductImage/29520091_fpx.webp'),
(139, 41, 1, 17, 40000.00, 7, '../images/ProductImage/29520092_fpx.webp', '../images/ProductImage/29520091_fpx.webp'),
(140, 41, 6, 17, 40000.00, 4, '../images/ProductImage/29520092_fpx.webp', '../images/ProductImage/29520091_fpx.webp'),
(141, 42, 13, 32, 13000.00, 5, '../images/ProductImage/_30408632_fpx.webp', '../images/ProductImage/_30408633_fpx.webp'),
(142, 42, 14, 32, 13000.00, 9, '../images/ProductImage/_30408632_fpx.webp', '../images/ProductImage/_30408633_fpx.webp'),
(145, 42, 15, 32, 13000.00, 7, '../images/ProductImage/_30408632_fpx.webp', '../images/ProductImage/_30408633_fpx.webp');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchaseID` int(11) NOT NULL,
  `purchaseDate` date NOT NULL,
  `subTotal` decimal(10,0) NOT NULL,
  `tax` decimal(10,0) NOT NULL,
  `totalAmount` decimal(10,0) NOT NULL,
  `staffID` int(10) NOT NULL,
  `supplierID` int(10) NOT NULL,
  `status` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchaseID`, `purchaseDate`, `subTotal`, `tax`, `totalAmount`, `staffID`, `supplierID`, `status`) VALUES
(38, '2024-12-27', 18000, 900, 18900, 5, 12, 'Pending'),
(39, '2024-12-27', 28000, 1400, 29400, 5, 12, 'Pending'),
(40, '2024-12-27', 540000, 27000, 567000, 5, 12, 'Pending'),
(41, '2024-12-27', 20000, 1000, 21000, 5, 12, 'Pending'),
(42, '2024-12-27', 36000, 1800, 37800, 5, 12, 'Pending'),
(43, '2024-12-27', 2700, 135, 2835, 5, 12, 'Pending'),
(44, '2024-12-27', 81063, 4053, 85116, 5, 12, 'Pending'),
(45, '2024-12-27', 810, 41, 851, 5, 12, 'Confirmed'),
(46, '2025-01-03', 12000, 600, 12600, 5, 13, 'Confirmed'),
(47, '2025-01-03', 9000, 450, 9450, 5, 12, 'Pending'),
(48, '2025-01-09', 230000, 11500, 241500, 5, 13, 'Pending'),
(49, '2025-01-21', 41000, 2050, 43050, 5, 13, 'Confirmed'),
(50, '2025-01-25', 80000, 4000, 84000, 5, 13, 'Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_detail`
--

CREATE TABLE `purchase_order_detail` (
  `purchaseOrderDetailID` int(11) NOT NULL,
  `purchaseID` int(11) NOT NULL,
  `variationID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchasePrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_order_detail`
--

INSERT INTO `purchase_order_detail` (`purchaseOrderDetailID`, `purchaseID`, `variationID`, `quantity`, `purchasePrice`) VALUES
(36, 42, 22, 4, 9000.00),
(37, 43, 32, 3, 900.00),
(38, 44, 32, 9, 9007.00),
(39, 45, 35, 9, 90.00),
(40, 46, 142, 1, 12000.00),
(41, 47, 136, 1, 9000.00),
(42, 48, 13, 10, 23000.00),
(43, 49, 74, 3, 9000.00),
(44, 49, 24, 2, 7000.00),
(45, 50, 72, 4, 20000.00);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `sizeID` int(11) NOT NULL,
  `sizeName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`sizeID`, `sizeName`) VALUES
(1, 'Large (L)'),
(2, 'Medium (M)'),
(3, 'Small (S)'),
(6, 'X-Large (XL)'),
(7, 'X-Small (XS)'),
(8, '0-3M'),
(9, '3-6M'),
(10, '6-9M'),
(11, '12M'),
(12, '8M'),
(13, '2T'),
(14, '3T'),
(15, '4T'),
(16, 'XS(4/5)'),
(17, 'S(6/7)'),
(18, 'M(8)'),
(19, 'L(10-12)'),
(20, 'XL(14-16)');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffID` int(11) NOT NULL,
  `staffName` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `role` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffID`, `staffName`, `email`, `address`, `phoneNumber`, `role`, `password`, `image`, `status`) VALUES
(5, 'Aung Aung', 'aung1@gmail.com', 'Yangon', '0987690897', 'Website Admin', 'Aung123!@#', '../images/StaffImage_profile.png', 'Active'),
(7, 'Htun Htun', 'htun@gmail.com', 'Yangon', '09765582899', 'Website Admin', 'Hnin123!@#', '../images/ProductImage/3135715.png', 'Active'),
(8, 'Ko Ko', 'Koko1@gmail.com', 'Yangon', '09765579200', 'Website Admin', 'Koko123!@#', '../images/StaffImage_ghfhhg.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(50) NOT NULL,
  `supplierAddress` varchar(255) NOT NULL,
  `supplierEmail` varchar(50) NOT NULL,
  `supplierPhone` varchar(15) NOT NULL,
  `contactName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierID`, `supplierName`, `supplierAddress`, `supplierEmail`, `supplierPhone`, `contactName`) VALUES
(12, 'Fashion ', 'Yangon', 'fashion@gmail.com', '0965645647', 'Jane Smith'),
(13, 'Oliva', 'Yangon ', 'oliva@gmail.com', '0965645647', 'Jane');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlistID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlistID`, `customerID`, `productID`) VALUES
(14, 1, 17),
(15, 1, 30),
(16, 1, 42);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`colorID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `customerID` (`customerID`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`orderDetailID`),
  ADD UNIQUE KEY `order_detail` (`variationID`,`orderID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `brandID` (`brandID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`variationID`),
  ADD KEY `sizeID` (`sizeID`),
  ADD KEY `productID` (`productID`) USING BTREE,
  ADD KEY `colorID` (`colorID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchaseID`),
  ADD KEY `fk_staffID` (`staffID`),
  ADD KEY `supplierID` (`supplierID`);

--
-- Indexes for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  ADD PRIMARY KEY (`purchaseOrderDetailID`),
  ADD UNIQUE KEY `unique_purchase_variation` (`purchaseID`,`variationID`),
  ADD KEY `variationID` (`variationID`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`sizeID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierID`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlistID`),
  ADD KEY `customerID` (`customerID`),
  ADD KEY `productID` (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `colorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `orderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `variationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  MODIFY `purchaseOrderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `sizeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`brandID`) REFERENCES `brand` (`brandID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `fk_product_variation_color` FOREIGN KEY (`colorID`) REFERENCES `color` (`colorID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `productID` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_variations_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_variations_ibfk_2` FOREIGN KEY (`sizeID`) REFERENCES `size` (`sizeID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `product_variations_ibfk_3` FOREIGN KEY (`colorID`) REFERENCES `color` (`colorID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `fk_staffID` FOREIGN KEY (`staffID`) REFERENCES `staff` (`staffID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  ADD CONSTRAINT `purchase_order_detail_ibfk_1` FOREIGN KEY (`purchaseID`) REFERENCES `purchase` (`purchaseID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_order_detail_ibfk_2` FOREIGN KEY (`variationID`) REFERENCES `product_variations` (`variationID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`customerID`) REFERENCES `customer` (`customerID`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
