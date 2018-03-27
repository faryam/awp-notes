-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2017 at 02:45 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'Fashion', 'Category for anything related to fashion.', '2014-06-01 00:35:07', '2014-05-30 07:34:33'),
(2, 'Electronics', 'Gadgets, drones and more.', '2014-06-01 00:35:07', '2014-05-30 07:34:33'),
(3, 'Motors', 'Motor sports and more', '2014-06-01 00:35:07', '2014-05-30 07:34:54'),
(5, 'Movies', 'Movie products.', '0000-00-00 00:00:00', '2016-01-08 03:27:26'),
(6, 'Books', 'Kindle books, audio books and more.', '0000-00-00 00:00:00', '2016-01-08 03:27:47'),
(13, 'Sports', 'Drop into new winter gear.', '2016-01-09 02:24:24', '2016-01-08 15:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `productImage` varchar(250) NOT NULL DEFAULT 'upload/default.jpg',
  `category_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `productImage`, `category_id`, `created`, `modified`) VALUES
(1, 'LG P880 4X HD', 'My first awesome phone!', '336', 'upload/default.jpg', 3, '2014-06-01 01:12:26', '2014-05-31 12:12:26'),
(2, 'Google Nexus 4', 'The most awesome phone of 2013!', '299', 'upload/default.jpg', 2, '2014-06-01 01:12:26', '2014-05-31 12:12:26'),
(3, 'Samsung Galaxy S4', 'How about no?', '600', 'upload/default.jpg', 3, '2014-06-01 01:12:26', '2014-05-31 12:12:26'),
(4, 'Bench Shirt', 'The best shirt!', '29', 'upload/default.jpg', 1, '2014-06-01 01:12:26', '2014-05-30 21:12:21'),
(5, 'Lenovo Laptop', 'My business partner.', '399', 'upload/default.jpg', 2, '2014-06-01 01:13:45', '2014-05-30 21:13:39'),
(6, 'Samsung Galaxy Tab 10.1', 'Good tablet.', '259', 'upload/default.jpg', 2, '2014-06-01 01:14:13', '2014-05-30 21:14:08'),
(7, 'Spalding Watch', 'My sports watch.', '199', 'upload/default.jpg', 1, '2014-06-01 01:18:36', '2014-05-30 21:18:31'),
(8, 'Sony Smart Watch', 'The coolest smart watch!', '300', 'upload/default.jpg', 2, '2014-06-06 17:10:01', '2014-06-05 13:09:51'),
(9, 'Huawei Y300', 'For testing purposes.', '100', 'upload/default.jpg', 2, '2014-06-06 17:11:04', '2014-06-05 13:10:54'),
(10, 'Abercrombie Lake Arnold Shirt', 'Perfect as gift!', '60', 'upload/default.jpg', 1, '2014-06-06 17:12:21', '2014-06-05 13:12:11'),
(11, 'Abercrombie Allen Brook Shirt', 'Cool red shirt!', '70', 'upload/default.jpg', 1, '2014-06-06 17:12:59', '2014-06-05 13:12:49'),
(12, 'Another product', 'Awesome product!', '555', 'upload/default.jpg', 2, '2014-11-22 19:07:34', '2014-11-21 15:07:34'),
(13, 'Wallet', 'You can absolutely use this one!', '799', 'upload/default.jpg', 6, '2014-12-04 21:12:03', '2014-12-03 17:12:03'),
(14, 'Amanda Waller Shirt', 'New awesome shirt!', '333', 'upload/default.jpg', 1, '2014-12-13 00:52:54', '2014-12-11 20:52:54'),
(15, 'Nike Shoes for Men', 'Nike Shoes', '12999', 'upload/default.jpg', 3, '2015-12-12 06:47:08', '2015-12-12 00:47:08'),
(16, 'Bristol Shoes', 'Awesome shoes.', '999', 'upload/default.jpg', 5, '2016-01-08 06:36:37', '2016-01-08 00:36:37'),
(17, 'Rolex Watch', 'Luxury watch.', '25000', 'upload/default.jpg', 1, '2016-01-11 15:46:02', '2016-01-11 09:46:02'),
(18, 'Recommended', 'description', '45454', 'upload/im1.png', 1, '2017-12-09 13:55:15', '2017-12-09 13:55:15'),
(19, 'New Product', 'description', '45454', 'upload/overview2.png', 1, '2017-12-09 13:56:06', '2017-12-09 13:56:06'),
(20, 'New Product 2', 'description', '45454', 'upload/overview2.png', 1, '2017-12-09 13:57:05', '2017-12-09 13:57:05'),
(21, 'new 1', 'description', '454', 'upload/overview2.png', 1, '2017-12-09 14:43:55', '2017-12-09 14:43:55'),
(22, 'New 2', 'des', '4', 'upload/im1.png', 1, '2017-12-09 14:44:53', '2017-12-09 14:44:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `userImage` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
