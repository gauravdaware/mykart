-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2023 at 08:10 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mykart`
--

-- --------------------------------------------------------

--
-- Table structure for table `mk_admin_tbl`
--

CREATE TABLE `mk_admin_tbl` (
  `id` int(11) NOT NULL,
  `admin_email` varchar(500) NOT NULL,
  `admin_password` varchar(500) NOT NULL,
  `admin_last_login_date` date DEFAULT NULL,
  `admin_last_login_ip` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mk_admin_tbl`
--

INSERT INTO `mk_admin_tbl` (`id`, `admin_email`, `admin_password`, `admin_last_login_date`, `admin_last_login_ip`) VALUES
(1, 'daware.gaurav@gmail.com', '7df5ded56f9b5b0dd69f55ff9973a326', '2023-03-06', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `mk_categories_tbl`
--

CREATE TABLE `mk_categories_tbl` (
  `category_id` int(11) NOT NULL,
  `category_status` int(11) NOT NULL,
  `category_name` varchar(500) NOT NULL,
  `trash` int(11) NOT NULL,
  `category_priority` int(11) NOT NULL,
  `created_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mk_categories_tbl`
--

INSERT INTO `mk_categories_tbl` (`category_id`, `category_status`, `category_name`, `trash`, `category_priority`, `created_on`) VALUES
(2, 1, 'Mens', 0, 0, NULL),
(3, 1, 'Womens', 0, 2, '2023-03-06');

-- --------------------------------------------------------

--
-- Table structure for table `mk_products_tbl`
--

CREATE TABLE `mk_products_tbl` (
  `prod_id` int(11) NOT NULL,
  `prod_status` smallint(6) NOT NULL,
  `prod_name` text NOT NULL,
  `prod_image` text NOT NULL,
  `prod_brand` text NOT NULL,
  `prod_mrp` int(11) NOT NULL,
  `prod_sp` int(11) NOT NULL,
  `prod_shipping_charge` int(11) NOT NULL,
  `prod_stock` int(11) NOT NULL,
  `added_on` datetime NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `trash` smallint(6) NOT NULL,
  `prod_description` text NOT NULL,
  `prod_code` varchar(100) NOT NULL,
  `prod_features` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mk_products_tbl`
--

INSERT INTO `mk_products_tbl` (`prod_id`, `prod_status`, `prod_name`, `prod_image`, `prod_brand`, `prod_mrp`, `prod_sp`, `prod_shipping_charge`, `prod_stock`, `added_on`, `category_id`, `sub_category_id`, `trash`, `prod_description`, `prod_code`, `prod_features`) VALUES
(1, 1, 'Men Black Slim Fit Casual Shirt', '2766370.png', 'United Colors of Benneton', 100, 90, 5, 100, '2023-03-06 00:00:00', 2, 0, 0, 'Black Solid Opaque Casual Shirt ,has A Spread Collar, Button Placket, Na Pocket, Short Regular Sleeves, Straight Hem', 'SHIRT01', 'Size & Fit\r\nFit: Slim Fit\r\nThe Model (height 6\') Is Wearing A Size 40\r\n\r\nMaterial & Care\r\nViscose Rayon\r\nMachine Wash');

-- --------------------------------------------------------

--
-- Table structure for table `mk_sub_categories_tbl`
--

CREATE TABLE `mk_sub_categories_tbl` (
  `sub_category_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_name` varchar(500) NOT NULL,
  `sub_category_status` int(11) NOT NULL,
  `trash` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `sub_category_priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mk_sub_categories_tbl`
--

INSERT INTO `mk_sub_categories_tbl` (`sub_category_id`, `category_id`, `sub_category_name`, `sub_category_status`, `trash`, `created_on`, `sub_category_priority`) VALUES
(0, 2, 'Shirts', 1, 0, '2023-03-06', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mk_admin_tbl`
--
ALTER TABLE `mk_admin_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mk_categories_tbl`
--
ALTER TABLE `mk_categories_tbl`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `mk_products_tbl`
--
ALTER TABLE `mk_products_tbl`
  ADD PRIMARY KEY (`prod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mk_admin_tbl`
--
ALTER TABLE `mk_admin_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mk_categories_tbl`
--
ALTER TABLE `mk_categories_tbl`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mk_products_tbl`
--
ALTER TABLE `mk_products_tbl`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
