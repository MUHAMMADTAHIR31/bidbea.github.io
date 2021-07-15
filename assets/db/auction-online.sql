-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2021 at 01:36 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction-online`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `lot_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bid_place_user` int(11) NOT NULL,
  `prod_cat_id` int(11) NOT NULL,
  `product_name` varchar(225) DEFAULT NULL,
  `price` varchar(225) DEFAULT NULL,
  `qty` varchar(225) DEFAULT NULL,
  `sizeOrweight` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `bid_price` varchar(225) DEFAULT NULL,
  `describtion` varchar(225) DEFAULT NULL,
  `is_availabe` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`lot_id`, `user_id`, `bid_place_user`, `prod_cat_id`, `product_name`, `price`, `qty`, `sizeOrweight`, `address`, `start_date`, `end_date`, `bid_price`, `describtion`, `is_availabe`) VALUES
(1, 3, 4, 1, 'Wireless Keyboard & Mouse Set HK6500', '500', '1', '', 'House Old Bath Road Colnbrook, Slough, Berkshire SL3 0NS', '2021-07-09 11:22:24', '2021-07-20 11:22:24', '215', 'Compact size & fashionable design\r\nUltra-thin, it looks very exquisite on the desktop\r\n2.4GHz ultra thin wireless desktop keyboard & mouse\r\nThe mouse has strong adaptive surface ability', 'yes'),
(2, 3, 4, 1, 'Yamaha PSR-F51 Y Portable Keyboard', '200', '1', '', 'House Old Bath Road Colnbrook, Slough, Berkshire SL852 0NS', '2021-07-09 11:22:24', '2021-07-13 11:22:24', '50', 'Easy, user-friendly and fun!Easy, user-friendly and fun!Our principal aim in designing the PSR-F51 was basic functionality that is both straightforward and user-friendly. As a result, we have developed a keyboard that anyone ', NULL),
(3, 3, 4, 1, 'Rolex Datejust Men\'s Watch Silver (116200RRJ)', '1000', '1', '', 'House Old Bath Road Colnbrook, Slough, Berkshire SL3852 0NS', '2021-07-09 11:22:24', '2021-07-14 11:22:24', '150', 'Model Year 2017, Item Shape Round,Display Type Analog,Case diameter 36 millimeters, Band Material Stainless Steel Rolex Jubilee, Dial color Rhodium', NULL),
(4, 3, 0, 1, 'Rolex Datejust II Ivory Men\'s Watch Two Tone (116333ISO)', '1500', '1', '', 'House Old Bath Road Colnbrook, Slough, Berkshire SL3852 0NS', '2021-07-09 11:22:24', '2021-07-15 11:22:24', '', 'Model Year 2017, Item Shape Round,Display Type Analog,Case diameter 36 millimeters, Band Material Stainless Steel Rolex Jubilee, Dial color Rhodium', NULL),
(5, 3, 4, 1, 'Rolex Submariner Men\'s Watch Silver (114060)', '50000', '1', '', 'House Old Bath Road Colnbrook, Slough, Berkshire SL3852 0NS', '2021-07-09 11:22:24', '2021-07-17 11:22:24', '600', 'Model Year 2017, Item Shape Round,Display Type Analog,Case diameter 36 millimeters, Band Material Stainless Steel Rolex Jubilee, Dial color Rhodium', NULL),
(13, 3, 0, 4, 'Black cotte', '1500', '1', '2kg', 'Canada', '2021-07-15 14:46:00', '2021-07-18 14:46:00', NULL, 'ok', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `prod_cat_id` int(11) UNSIGNED NOT NULL,
  `prod_cat_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`prod_cat_id`, `prod_cat_name`) VALUES
(1, 'Electronics'),
(2, 'Furniture'),
(3, 'Arts'),
(4, 'Clothing');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `govt_id` int(11) DEFAULT NULL,
  `first_name` varchar(225) DEFAULT NULL,
  `last_name` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `phone_number` varchar(225) DEFAULT NULL,
  `gender` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `user_type` enum('seller','buyer','admin') DEFAULT NULL,
  `is_aproved` enum('yes','no') DEFAULT NULL,
  `verification_code` varchar(225) DEFAULT NULL,
  `status` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `govt_id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `gender`, `address`, `date_of_birth`, `user_type`, `is_aproved`, `verification_code`, `status`) VALUES
(3, NULL, 'john', 'sin', 'ah150434@gmail.com', '$2y$10$PfiItllC.Ik1484jl7DcueXUHA4wAHTxS.3mYsn4r9TlmHLpjmH2O', '458752698', 'male', 'Canada', '2021-07-15', 'seller', 'no', 'cfa06c05d237a6cf6529a4cbeef1dd5e', '1'),
(4, NULL, 'jez', 'rok', 'tahirsindhi872@gmail.com', '$2y$10$PfiItllC.Ik1484jl7DcueXUHA4wAHTxS.3mYsn4r9TlmHLpjmH2O', '8445698252', 'male', 'Canada', '1998-05-13', 'buyer', 'no', '4e68f8110b53d32e46af24c0f726ff5a', '1'),
(5, NULL, 'Robbin', 'roy', 'robin.roy51@gmail.com', '$2y$10$2tylpsGnK9WAY3givSrtXONpG6HAnguDDsvpiAYxezkjIyFwfsvD.', NULL, NULL, NULL, NULL, 'admin', NULL, NULL, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`lot_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`prod_cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `lot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `prod_cat_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
