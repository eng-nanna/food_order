-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 26, 2021 at 11:40 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Nehal Karrar', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'Demo Admin', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229'),
(4, 'test admin', 'tester admin', 'f5d1278e8109edd94e1e4197e04873b9');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(7, 'Pizza', 'food_category_91.jpg', 'Yes', 'Yes'),
(8, 'Seafood', 'food_category_888.jpg', 'Yes', 'Yes'),
(9, 'Sandwich', 'food_category_991.jpg', 'Yes', 'Yes'),
(10, 'Desserts', 'food_category_372.jpg', 'Yes', 'Yes'),
(11, 'Soup', '', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

DROP TABLE IF EXISTS `tbl_food`;
CREATE TABLE IF NOT EXISTS `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(7, 'Crispy chicken ', 'Fried Crispy chicken ', '35', 'food_category_505.jpg', 9, 'No', 'Yes'),
(8, 'Club Sandwich', 'Layers of turkey with juicy tomatoes, crisp lettuce and cheddar cheese create the perfect bite!', '20', 'food_category_776.jpg', 9, 'Yes', 'Yes'),
(9, 'Fried Fish', 'This delicious, crispy & spicy fish fry makes for a great appetizer or a side to a meal. A simple vegetable salad or sliced onion compliment the fish fry. It can be served as a side with any variety rice like Ghee rice, cumin or Jeera rice, simple coconut rice.', '60', 'food_name_847.webp', 8, 'Yes', 'Yes'),
(10, 'Garlic Butter Shrimp', 'Garlic Butter Shrimp is tasty, spicy, and delicious. It makes a great appetizer before dinner', '110', 'food_name_169.jpg', 8, 'Yes', 'Yes'),
(13, 'Pizza', 'Chessy pizza', '50', 'food_category_649.jpg', 7, 'No', 'Yes'),
(14, 'pepperoni pizza', 'pepperoni pizza', '70', 'food_name_951.jpg', 7, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `food` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Garlic Butter Shrimp', '110', 3, '330', '2021-03-25 20:13:00', 'Delivered', 'Nehal Nabil', '+201032860655', 'pro.nehal@gmail.com', '63 Hai Alzohor - al shikh zaied'),
(2, 'Club Sandwich', '20', 10, '200', '2021-03-25 20:19:04', 'Cancelled', 'mera', '+2015616548', 'test@test.com', 'nfjeskdbngdjkfmn gm'),
(3, 'Crispy chicken ', '35', 4, '140', '2021-03-26 13:34:22', 'Delivered', 'Nehal Nabil', '+201032860655', 'pro.nehal@gmail.com', '63 Hai Alzohor - al shikh zaied');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
