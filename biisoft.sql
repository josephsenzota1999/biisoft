-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 09:06 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biisoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `bot`
--

CREATE TABLE `bot` (
  `bot_id` int(11) NOT NULL,
  `item_name` varchar(48) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `bot_number` varchar(100) NOT NULL,
  `tables_ID` int(11) NOT NULL,
  `tableItems_id` int(11) NOT NULL,
  `recorded_by` varchar(48) NOT NULL,
  `saved_by` varchar(48) NOT NULL,
  `bot_status` int(11) NOT NULL DEFAULT 0,
  `bot_datetime` int(11) NOT NULL,
  `deletedby` varchar(48) DEFAULT NULL,
  `deleted_time` int(11) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(50) NOT NULL,
  `categories_status` varchar(45) NOT NULL DEFAULT 'active',
  `categories_time` int(11) NOT NULL,
  `categories_deleted` int(11) NOT NULL DEFAULT 0,
  `categories_dlt_date` int(11) DEFAULT NULL,
  `categories_dlt_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_status`, `categories_time`, `categories_deleted`, `categories_dlt_date`, `categories_dlt_by`) VALUES
(37, 'Soft Drinks', 'active', 1631791969, 0, NULL, NULL),
(38, 'Whiskey', 'active', 1631792016, 0, NULL, NULL),
(39, 'Gin', 'active', 1631792022, 0, NULL, NULL),
(40, 'RUM', 'active', 1631792030, 0, NULL, NULL),
(41, 'Liquer', 'active', 1631792054, 0, NULL, NULL),
(42, 'Vodka', 'active', 1631792065, 0, NULL, NULL),
(43, 'Wine', 'active', 1631792075, 0, NULL, NULL),
(44, 'Cider', 'active', 1631792091, 0, NULL, NULL),
(45, 'Local Beer', 'active', 1631792105, 0, NULL, NULL),
(46, 'Imported Beer', 'active', 1631792126, 0, NULL, NULL),
(47, 'Energy Drinks', 'active', 1631792139, 0, NULL, NULL),
(48, 'Local Food', 'active', 1631792220, 0, NULL, NULL),
(49, 'Breakfast', 'active', 1631792232, 0, NULL, NULL),
(50, 'Cognac', 'active', 1631794912, 0, NULL, NULL),
(51, 'Aperitif', 'active', 1631799958, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `creditors`
--

CREATE TABLE `creditors` (
  `creditors_id` int(11) NOT NULL,
  `refNumber` varchar(255) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `dept_to_pay` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date_issued` date NOT NULL,
  `issued_by` varchar(100) NOT NULL,
  `creditors_returns` int(11) NOT NULL DEFAULT 0,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `time_issued` int(11) NOT NULL,
  `deleted_by` varchar(100) DEFAULT NULL,
  `deleted_date` date DEFAULT NULL,
  `creditors_status` int(11) NOT NULL DEFAULT 0 COMMENT '0 = not clear the dept\n1 = cleared the dept\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foodmenu`
--

CREATE TABLE `foodmenu` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(50) NOT NULL,
  `food_cat` int(11) NOT NULL,
  `food_price` int(11) NOT NULL DEFAULT 0 COMMENT '\n',
  `food_status` varchar(45) NOT NULL DEFAULT 'active',
  `food_time` int(11) NOT NULL,
  `food_deleted` int(11) NOT NULL DEFAULT 0,
  `food_dlt_date` int(11) DEFAULT NULL,
  `food_dlt_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kot`
--

CREATE TABLE `kot` (
  `kot_id` int(11) NOT NULL,
  `item_name` varchar(48) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `kot_number` varchar(255) NOT NULL,
  `tables_ID` int(11) NOT NULL,
  `tableItems_id` int(11) NOT NULL,
  `recorded_by` int(11) NOT NULL,
  `saved_by` int(11) NOT NULL,
  `kot_datetime` int(11) NOT NULL,
  `deletedby` varchar(48) DEFAULT NULL,
  `deleted_time` int(11) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `orders_name` varchar(50) NOT NULL,
  `orders_cat` varchar(50) NOT NULL,
  `orders_qty` int(11) NOT NULL,
  `orders_price` int(11) NOT NULL,
  `orders_total` int(11) NOT NULL,
  `orders_time` int(11) NOT NULL,
  `issued_by` varchar(45) NOT NULL,
  `orders_profitPerPc` int(11) NOT NULL DEFAULT 0,
  `orders_VAT` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `products_id` int(11) NOT NULL,
  `products_name` varchar(50) NOT NULL,
  `products_cat` int(11) NOT NULL,
  `products_qty` int(11) NOT NULL DEFAULT 0 COMMENT 'this will be updated when product is ourchased\n',
  `products_price` int(11) NOT NULL DEFAULT 0 COMMENT 'this will be updated when product is ourchased\n',
  `products_status` varchar(45) NOT NULL DEFAULT 'active',
  `products_time` int(11) NOT NULL,
  `products_deleted` int(11) NOT NULL DEFAULT 0,
  `products_dlt_date` int(11) DEFAULT NULL,
  `products_dlt_by` varchar(45) DEFAULT NULL,
  `products_profitPerPc` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`products_id`, `products_name`, `products_cat`, `products_qty`, `products_price`, `products_status`, `products_time`, `products_deleted`, `products_dlt_date`, `products_dlt_by`, `products_profitPerPc`) VALUES
(197, 'Redbull', 37, 98, 3000, 'active', 1672603324, 0, NULL, NULL, 1500),
(198, 'Fanta', 37, 0, 0, 'active', 1672654268, 0, NULL, NULL, 0),
(199, 'Black&White ', 41, 20, 1200, 'active', 1686885255, 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchases_id` int(11) NOT NULL,
  `purchases_name` varchar(50) NOT NULL COMMENT 'Purchase Name\n\n',
  `purchases_qty` int(11) NOT NULL,
  `purchases_buy_price` int(11) NOT NULL,
  `purchases_sell_price` int(11) NOT NULL,
  `purchased_by` varchar(50) NOT NULL,
  `purchases_date` date NOT NULL,
  `purchases_time` int(11) NOT NULL,
  `purchases_deleted` int(11) NOT NULL DEFAULT 0,
  `purchases_dlt_date` int(11) DEFAULT NULL,
  `purchases_dlt_by` varchar(45) DEFAULT NULL,
  `purchases_totalAfterSell` int(11) NOT NULL DEFAULT 0,
  `purchases_profitAfterSell` int(11) NOT NULL DEFAULT 0,
  `purchases_buyingPricePc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchases_id`, `purchases_name`, `purchases_qty`, `purchases_buy_price`, `purchases_sell_price`, `purchased_by`, `purchases_date`, `purchases_time`, `purchases_deleted`, `purchases_dlt_date`, `purchases_dlt_by`, `purchases_totalAfterSell`, `purchases_profitAfterSell`, `purchases_buyingPricePc`) VALUES
(317, 'Redbull', 100, 1500, 3000, 'ibra', '2023-01-01', 1672603376, 0, NULL, NULL, 300000, 150000, 1500),
(318, 'Black&White ', 20, 1200, 1200, 'admin', '2023-06-16', 1686885291, 0, NULL, NULL, 24000, 0, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `sales_paymentMethod` varchar(45) NOT NULL,
  `sales_refNumber` varchar(255) NOT NULL,
  `sales_discount` int(11) NOT NULL,
  `sales_paid` int(11) NOT NULL COMMENT 'amount paid\n\n',
  `sales_total` int(11) NOT NULL COMMENT 'Total before discount\n\n',
  `sales_balance` int(11) NOT NULL COMMENT 'Total before discount\n\n',
  `sales_qty` int(11) NOT NULL,
  `sales_date` date NOT NULL,
  `sales_isssed_by` varchar(100) NOT NULL,
  `sales_deleted` int(11) NOT NULL DEFAULT 0,
  `sales_time` int(11) NOT NULL,
  `sales_dlt_date` int(11) DEFAULT NULL,
  `sales_dlt_by` varchar(45) DEFAULT NULL,
  `sales_totalNProfit` int(11) NOT NULL DEFAULT 0,
  `sales_VAT` varchar(45) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `sales_paymentMethod`, `sales_refNumber`, `sales_discount`, `sales_paid`, `sales_total`, `sales_balance`, `sales_qty`, `sales_date`, `sales_isssed_by`, `sales_deleted`, `sales_time`, `sales_dlt_date`, `sales_dlt_by`, `sales_totalNProfit`, `sales_VAT`) VALUES
(752, 'cash', 'd20230414190706', 0, 3000, 3000, 0, 1, '2023-04-14', 'jose', 0, 1681488426, NULL, NULL, 1042, '458');

-- --------------------------------------------------------

--
-- Table structure for table `salesdetails`
--

CREATE TABLE `salesdetails` (
  `salesDetails_id` int(11) NOT NULL,
  `salesDetails_name` varchar(45) NOT NULL,
  `salesDetails_cat` varchar(45) NOT NULL,
  `salesDetails_qty` int(11) NOT NULL,
  `salesDetails_price` int(11) NOT NULL,
  `salesDetails_total` int(11) NOT NULL,
  `salesDetails_saledID` int(11) NOT NULL,
  `salesDetails_dlt` int(11) NOT NULL DEFAULT 0,
  `salesDetails_dlt_time` int(11) DEFAULT NULL,
  `salesDetails_dlt_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `salesdetails`
--

INSERT INTO `salesdetails` (`salesDetails_id`, `salesDetails_name`, `salesDetails_cat`, `salesDetails_qty`, `salesDetails_price`, `salesDetails_total`, `salesDetails_saledID`, `salesDetails_dlt`, `salesDetails_dlt_time`, `salesDetails_dlt_by`) VALUES
(1236, 'Redbull', 'Soft Drinks', 1, 3000, 3000, 752, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `category` int(11) NOT NULL,
  `instore` int(11) NOT NULL DEFAULT 0,
  `sold` int(11) NOT NULL DEFAULT 0,
  `store_deleted` int(11) NOT NULL DEFAULT 0,
  `store_deletedby` varchar(45) DEFAULT NULL,
  `store_timeDeleted` varchar(45) DEFAULT NULL,
  `updates_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `created_on` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `quantity_updated` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `product_name`, `category`, `instore`, `sold`, `store_deleted`, `store_deletedby`, `store_timeDeleted`, `updates_at`, `created_on`, `quantity_updated`) VALUES
(197, 'Redbull', 37, 37, 2, 0, NULL, NULL, '2023-06-20 07:02:06.358488', '0000-00-00 00:00:00.000000', ''),
(198, 'Fanta', 37, 24, 0, 0, NULL, NULL, '2023-06-20 06:58:48.191347', '0000-00-00 00:00:00.000000', '4'),
(199, 'Black&White ', 41, 113, 0, 0, NULL, NULL, '2023-06-20 06:35:37.792509', '0000-00-00 00:00:00.000000', '10');

-- --------------------------------------------------------

--
-- Table structure for table `tableitems`
--

CREATE TABLE `tableitems` (
  `tableItems_id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_cat` varchar(100) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_price` int(11) NOT NULL,
  `item_total` int(11) NOT NULL,
  `item_time` int(11) NOT NULL,
  `issued_by` varchar(48) NOT NULL,
  `item_savedby` varchar(48) NOT NULL,
  `item_profitPerPc` int(11) NOT NULL,
  `item_VAT` int(11) NOT NULL,
  `tables_ID` int(11) NOT NULL,
  `item_dlt` int(11) NOT NULL DEFAULT 0,
  `item_dlt_time` int(11) DEFAULT NULL,
  `item_dlt_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tableitems`
--

INSERT INTO `tableitems` (`tableItems_id`, `item_name`, `item_cat`, `item_qty`, `item_price`, `item_total`, `item_time`, `issued_by`, `item_savedby`, `item_profitPerPc`, `item_VAT`, `tables_ID`, `item_dlt`, `item_dlt_time`, `item_dlt_by`) VALUES
(76, 'Redbull', 'Soft Drinks', 1, 3000, 3000, 1687244526, 'admin', 'John Doe', 1042, 458, 30, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `table_id` int(11) NOT NULL,
  `table_number` int(255) NOT NULL,
  `table_status` int(11) NOT NULL DEFAULT 0,
  `table_deleted` int(11) NOT NULL DEFAULT 0,
  `table_deleted_date` int(11) DEFAULT NULL,
  `table_deleted_by` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_id`, `table_number`, `table_status`, `table_deleted`, `table_deleted_date`, `table_deleted_by`) VALUES
(29, 101, 0, 0, NULL, NULL),
(30, 102, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tracker`
--

CREATE TABLE `tracker` (
  `tracker_id` int(11) NOT NULL,
  `page` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `time` int(11) NOT NULL,
  `user` varchar(45) NOT NULL DEFAULT 'unknown'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tracker`
--

INSERT INTO `tracker` (`tracker_id`, `page`, `ip`, `time`, `user`) VALUES
(16050, '/biisoft/pos.php', '127.0.0.1', 1648667361, 'Unkwon'),
(16051, '/biisoft/login.php', '127.0.0.1', 1648667361, 'Unkwon'),
(16052, '/biisoft/pos.php', '127.0.0.1', 1655831101, 'Unkwon'),
(16053, '/biisoft/login.php', '127.0.0.1', 1655831102, 'Unkwon'),
(16054, '/posv1/index.php', '::1', 1672569170, 'Unkwon'),
(16055, '/posv1/login.php', '::1', 1672569170, 'Unkwon'),
(16056, '/posv1/startHere.php', '::1', 1672569264, 'Unkwon'),
(16057, '/posv1/startHere.php', '::1', 1672569285, 'Unkwon'),
(16058, '/posv1/login.php', '::1', 1672569285, 'Unkwon'),
(16059, '/posv1/login.php', '::1', 1672569295, 'Unkwon'),
(16060, '/posv1/index.php', '::1', 1672569295, 'ibra'),
(16061, '/biisoft/sales.php', '127.0.0.1', 1672569309, 'Unkwon'),
(16062, '/biisoft/login.php', '127.0.0.1', 1672569309, 'Unkwon'),
(16063, '/biisoft/login.php', '127.0.0.1', 1672569327, 'Unkwon'),
(16064, '/biisoft/index.php', '127.0.0.1', 1672569332, 'ibra'),
(16065, '/biisoft/salesCat.php', '127.0.0.1', 1672569368, 'ibra'),
(16066, '/biisoft/creditors.php', '127.0.0.1', 1672569374, 'ibra'),
(16067, '/biisoft/sales.php', '127.0.0.1', 1672569377, 'ibra'),
(16068, '/biisoft/profit.php', '127.0.0.1', 1672569379, 'ibra'),
(16069, '/biisoft/pos.php', '127.0.0.1', 1672569404, 'ibra'),
(16070, '/biisoft/cat.php', '127.0.0.1', 1672569423, 'ibra'),
(16071, '/biisoft/drinks.php', '127.0.0.1', 1672569437, 'ibra'),
(16072, '/biisoft/addDrink.php', '127.0.0.1', 1672569463, 'ibra'),
(16073, '/biisoft/drinks.php', '127.0.0.1', 1672569480, 'ibra'),
(16074, '/biisoft/drinks.php', '127.0.0.1', 1672569484, 'ibra'),
(16075, '/biisoft/food.php', '127.0.0.1', 1672569522, 'ibra'),
(16076, '/biisoft/addFood.php', '127.0.0.1', 1672569527, 'ibra'),
(16077, '/biisoft/index.php', '127.0.0.1', 1672569532, 'ibra'),
(16078, '/biisoft/pos.php', '127.0.0.1', 1672569543, 'ibra'),
(16079, '/biisoft/tables.php', '127.0.0.1', 1672569546, 'ibra'),
(16080, '/biisoft/pos.php', '127.0.0.1', 1672601104, 'Unkwon'),
(16081, '/biisoft/login.php', '127.0.0.1', 1672601104, 'Unkwon'),
(16082, '/biisoft/index.php', '127.0.0.1', 1672601106, 'Unkwon'),
(16083, '/biisoft/login.php', '127.0.0.1', 1672601106, 'Unkwon'),
(16084, '/biisoft/addFood.php', '127.0.0.1', 1672601109, 'Unkwon'),
(16085, '/biisoft/login.php', '127.0.0.1', 1672601109, 'Unkwon'),
(16086, '/biisoft/food.php', '127.0.0.1', 1672601110, 'Unkwon'),
(16087, '/biisoft/login.php', '127.0.0.1', 1672601110, 'Unkwon'),
(16088, '/biisoft/drinks.php', '127.0.0.1', 1672601115, 'Unkwon'),
(16089, '/biisoft/login.php', '127.0.0.1', 1672601115, 'Unkwon'),
(16090, '/biisoft/addDrink.php', '127.0.0.1', 1672601115, 'Unkwon'),
(16091, '/biisoft/login.php', '127.0.0.1', 1672601115, 'Unkwon'),
(16092, '/biisoft/drinks.php', '127.0.0.1', 1672601115, 'Unkwon'),
(16093, '/biisoft/login.php', '127.0.0.1', 1672601115, 'Unkwon'),
(16094, '/biisoft/cat.php', '127.0.0.1', 1672601115, 'Unkwon'),
(16095, '/biisoft/login.php', '127.0.0.1', 1672601115, 'Unkwon'),
(16096, '/biisoft/pos.php', '127.0.0.1', 1672601116, 'Unkwon'),
(16097, '/biisoft/login.php', '127.0.0.1', 1672601116, 'Unkwon'),
(16098, '/biisoft/profit.php', '127.0.0.1', 1672601116, 'Unkwon'),
(16099, '/biisoft/login.php', '127.0.0.1', 1672601116, 'Unkwon'),
(16100, '/biisoft/sales.php', '127.0.0.1', 1672601116, 'Unkwon'),
(16101, '/biisoft/login.php', '127.0.0.1', 1672601116, 'Unkwon'),
(16102, '/biisoft/creditors.php', '127.0.0.1', 1672601116, 'Unkwon'),
(16103, '/biisoft/login.php', '127.0.0.1', 1672601116, 'Unkwon'),
(16104, '/posv1/login.php', '127.0.0.1', 1672601126, 'Unkwon'),
(16105, '/posv1/index.php', '127.0.0.1', 1672601466, 'Unkwon'),
(16106, '/posv1/login.php', '127.0.0.1', 1672601466, 'Unkwon'),
(16107, '/posv1/login.php', '127.0.0.1', 1672601470, 'Unkwon'),
(16108, '/posv1/login.php', '127.0.0.1', 1672601517, 'Unkwon'),
(16109, '/posv1/login.php', '127.0.0.1', 1672601529, 'Unkwon'),
(16110, '/posv1/index.php', '127.0.0.1', 1672601529, 'ibra'),
(16111, '/posv1/pos.php', '127.0.0.1', 1672601536, 'ibra'),
(16112, '/posv1/cat.php', '127.0.0.1', 1672601539, 'ibra'),
(16113, '/posv1/drinks.php', '127.0.0.1', 1672601540, 'ibra'),
(16114, '/posv1/food.php', '127.0.0.1', 1672601542, 'ibra'),
(16115, '/posv1/pos.php', '127.0.0.1', 1672601544, 'ibra'),
(16116, '/posv1/pos.php', '127.0.0.1', 1672601563, 'ibra'),
(16117, '/posv1/login.php', '127.0.0.1', 1672601563, 'Unkwon'),
(16118, '/posv1/login.php', '127.0.0.1', 1672601664, 'Unkwon'),
(16119, '/posv1/login.php', '127.0.0.1', 1672601670, 'Unkwon'),
(16120, '/posv1/login.php', '127.0.0.1', 1672601701, 'Unkwon'),
(16121, '/posv1/login.php', '127.0.0.1', 1672601784, 'Unkwon'),
(16122, '/posv1/index.php', '127.0.0.1', 1672601784, 'ibra'),
(16123, '/posv1/smanage.php', '127.0.0.1', 1672601795, 'ibra'),
(16124, '/posv1/food.php', '127.0.0.1', 1672601802, 'ibra'),
(16125, '/posv1/food.php', '127.0.0.1', 1672601902, 'ibra'),
(16126, '/posv1/food.php', '127.0.0.1', 1672601930, 'ibra'),
(16127, '/posv1/food.php', '127.0.0.1', 1672601942, 'ibra'),
(16128, '/posv1/smanage.php', '127.0.0.1', 1672601945, 'ibra'),
(16129, '/posv1/smanage.php', '127.0.0.1', 1672601947, 'ibra'),
(16130, '/posv1/smanage.php', '127.0.0.1', 1672601953, 'ibra'),
(16131, '/posv1/smanage.php', '127.0.0.1', 1672601985, 'ibra'),
(16132, '/posv1/cat.php', '127.0.0.1', 1672602017, 'ibra'),
(16133, '/posv1/drinks.php', '127.0.0.1', 1672602023, 'ibra'),
(16134, '/posv1/store.php', '127.0.0.1', 1672602158, 'ibra'),
(16135, '/posv1/drinks.php', '127.0.0.1', 1672602161, 'ibra'),
(16136, '/posv1/addDrink.php', '127.0.0.1', 1672602163, 'ibra'),
(16137, '/posv1/drinks.php', '127.0.0.1', 1672602166, 'ibra'),
(16138, '/posv1/purchase.php', '127.0.0.1', 1672602174, 'ibra'),
(16139, '/posv1/drinks.php', '127.0.0.1', 1672602181, 'ibra'),
(16140, '/posv1/drinks.php', '127.0.0.1', 1672602760, 'ibra'),
(16141, '/posv1/drinks.php', '127.0.0.1', 1672602776, 'ibra'),
(16142, '/posv1/drinks.php', '127.0.0.1', 1672602814, 'ibra'),
(16143, '/posv1/login.php', '127.0.0.1', 1672602814, 'Unkwon'),
(16144, '/posv1/login.php', '127.0.0.1', 1672602839, 'Unkwon'),
(16145, '/posv1/index.php', '127.0.0.1', 1672602839, 'ibra'),
(16146, '/posv1/drinks.php', '127.0.0.1', 1672603002, 'ibra'),
(16147, '/posv1/drinks.php', '127.0.0.1', 1672603192, 'ibra'),
(16148, '/posv1/pos.php', '127.0.0.1', 1672603204, 'ibra'),
(16149, '/posv1/drinks.php', '127.0.0.1', 1672603280, 'ibra'),
(16150, '/posv1/addDrink.php', '127.0.0.1', 1672603281, 'ibra'),
(16151, '/posv1/addDrink.php', '127.0.0.1', 1672603324, 'ibra'),
(16152, '/posv1/pos.php', '127.0.0.1', 1672603332, 'ibra'),
(16153, '/posv1/pos.php', '127.0.0.1', 1672603336, 'ibra'),
(16154, '/posv1/drinks.php', '127.0.0.1', 1672603341, 'ibra'),
(16155, '/posv1/purchase.php', '127.0.0.1', 1672603346, 'ibra'),
(16156, '/posv1/purchase.php', '127.0.0.1', 1672603376, 'ibra'),
(16157, '/posv1/drinks.php', '127.0.0.1', 1672603437, 'ibra'),
(16158, '/posv1/store.php', '127.0.0.1', 1672603439, 'ibra'),
(16159, '/posv1/pos.php', '127.0.0.1', 1672603442, 'ibra'),
(16160, '/posv1/pos.php', '127.0.0.1', 1672603511, 'ibra'),
(16161, '/posv1/pos.php', '127.0.0.1', 1672603511, 'ibra'),
(16162, '/posv1/pos.php', '127.0.0.1', 1672603541, 'ibra'),
(16163, '/posv1/pos.php', '127.0.0.1', 1672605987, 'ibra'),
(16164, '/posv1/pos.php', '127.0.0.1', 1672605987, 'ibra'),
(16165, '/posv1/pos.php', '127.0.0.1', 1672653274, 'ibra'),
(16166, '/posv1/drinks.php', '127.0.0.1', 1672653322, 'ibra'),
(16167, '/posv1/pos.php', '127.0.0.1', 1672653630, 'ibra'),
(16168, '/posv1/products.php', '127.0.0.1', 1672653632, 'ibra'),
(16169, '/posv1/products.php', '127.0.0.1', 1672653840, 'ibra'),
(16170, '/posv1/addproduct.php', '127.0.0.1', 1672653842, 'ibra'),
(16171, '/posv1/addproduct.php', '127.0.0.1', 1672653850, 'ibra'),
(16172, '/posv1/addproduct.php', '127.0.0.1', 1672653854, 'ibra'),
(16173, '/posv1/products.php', '127.0.0.1', 1672653857, 'ibra'),
(16174, '/posv1/purchase.php', '127.0.0.1', 1672653859, 'ibra'),
(16175, '/posv1/products.php', '127.0.0.1', 1672653863, 'ibra'),
(16176, '/posv1/store.php', '127.0.0.1', 1672653865, 'ibra'),
(16177, '/posv1/products.php', '127.0.0.1', 1672653866, 'ibra'),
(16178, '/posv1/addproduct.php', '127.0.0.1', 1672653871, 'ibra'),
(16179, '/posv1/addproduct.php', '127.0.0.1', 1672654087, 'ibra'),
(16180, '/posv1/products.php', '127.0.0.1', 1672654089, 'ibra'),
(16181, '/posv1/addproduct.php', '127.0.0.1', 1672654091, 'ibra'),
(16182, '/posv1/addproduct.php', '127.0.0.1', 1672654110, 'ibra'),
(16183, '/posv1/addproduct.php', '127.0.0.1', 1672654135, 'ibra'),
(16184, '/posv1/addproduct.php', '127.0.0.1', 1672654138, 'ibra'),
(16185, '/posv1/addproduct.php', '127.0.0.1', 1672654141, 'ibra'),
(16186, '/posv1/products.php', '127.0.0.1', 1672654156, 'ibra'),
(16187, '/posv1/purchase.php', '127.0.0.1', 1672654158, 'ibra'),
(16188, '/posv1/products.php', '127.0.0.1', 1672654171, 'ibra'),
(16189, '/posv1/addproduct.php', '127.0.0.1', 1672654172, 'ibra'),
(16190, '/posv1/addproduct.php', '127.0.0.1', 1672654259, 'ibra'),
(16191, '/posv1/addproduct.php', '127.0.0.1', 1672654268, 'ibra'),
(16192, '/posv1/products.php', '127.0.0.1', 1672654337, 'ibra'),
(16193, '/posv1/purchase.php', '127.0.0.1', 1672654341, 'ibra'),
(16194, '/posv1/products.php', '127.0.0.1', 1672654361, 'ibra'),
(16195, '/posv1/addproduct.php', '127.0.0.1', 1672654363, 'ibra'),
(16196, '/posv1/products.php', '127.0.0.1', 1672654366, 'ibra'),
(16197, '/posv1/purchase.php', '127.0.0.1', 1672654367, 'ibra'),
(16198, '/posv1/purchase.php', '127.0.0.1', 1672654583, 'ibra'),
(16199, '/posv1/products.php', '127.0.0.1', 1672654585, 'ibra'),
(16200, '/posv1/purchase.php', '127.0.0.1', 1672654587, 'ibra'),
(16201, '/posv1/cat.php', '127.0.0.1', 1672654602, 'ibra'),
(16202, '/posv1/index.php', '127.0.0.1', 1672654604, 'ibra'),
(16203, '/posv1/sales.php', '127.0.0.1', 1672654608, 'ibra'),
(16204, '/posv1/salesCat.php', '127.0.0.1', 1672654612, 'ibra'),
(16205, '/posv1/creditors.php', '127.0.0.1', 1672654613, 'ibra'),
(16206, '/posv1/pos.php', '127.0.0.1', 1672654616, 'ibra'),
(16207, '/posv1/pos.php', '127.0.0.1', 1672654619, 'ibra'),
(16208, '/posv1/pos.php', '127.0.0.1', 1672654619, 'ibra'),
(16209, '/posv1/pos.php', '127.0.0.1', 1672654688, 'ibra'),
(16210, '/posv1/pos.php', '127.0.0.1', 1672654692, 'ibra'),
(16211, '/posv1/pos.php', '127.0.0.1', 1672654692, 'ibra'),
(16212, '/posv1/smanage.php', '127.0.0.1', 1672654698, 'ibra'),
(16213, '/posv1/smanage.php', '127.0.0.1', 1672655391, 'ibra'),
(16214, '/posv1/login.php', '127.0.0.1', 1672655391, 'Unkwon'),
(16215, '/posv1/login.php', '127.0.0.1', 1672655404, 'Unkwon'),
(16216, '/posv1/index.php', '127.0.0.1', 1672655404, 'ibra'),
(16217, '/posv1/index.php', '127.0.0.1', 1672655445, 'ibra'),
(16218, '/posv1/login.php', '127.0.0.1', 1672655445, 'Unkwon'),
(16219, '/posv1/login.php', '127.0.0.1', 1672655459, 'Unkwon'),
(16220, '/posv1/index.php', '127.0.0.1', 1672655459, 'ibra'),
(16221, '/posv1/index.php', '127.0.0.1', 1672656998, 'ibra'),
(16222, '/posv1/login.php', '127.0.0.1', 1672656998, 'Unkwon'),
(16223, '/posv1/pos.php', '127.0.0.1', 1672659540, 'Unkwon'),
(16224, '/posv1/login.php', '127.0.0.1', 1672659540, 'Unkwon'),
(16225, '/biisoft/index.php', '::1', 1681488012, 'asajile'),
(16226, '/biisoft/pos.php', '127.0.0.1', 1681488041, 'Unkwon'),
(16227, '/biisoft/login.php', '127.0.0.1', 1681488042, 'Unkwon'),
(16228, '/biisoft/login.php', '127.0.0.1', 1681488053, 'Unkwon'),
(16229, '/biisoft/login.php', '127.0.0.1', 1681488054, 'Unkwon'),
(16230, '/biisoft/login.php', '127.0.0.1', 1681488168, 'Unkwon'),
(16231, '/biisoft/login.php', '127.0.0.1', 1681488169, 'Unkwon'),
(16232, '/biisoft/startHere.php', '127.0.0.1', 1681488183, 'Unkwon'),
(16233, '/biisoft/startHere.php', '127.0.0.1', 1681488198, 'Unkwon'),
(16234, '/biisoft/login.php', '127.0.0.1', 1681488199, 'Unkwon'),
(16235, '/biisoft/login.php', '127.0.0.1', 1681488205, 'Unkwon'),
(16236, '/biisoft/index.php', '127.0.0.1', 1681488207, 'jose'),
(16237, '/biisoft/tables.php', '127.0.0.1', 1681488210, 'jose'),
(16238, '/biisoft/tables.php', '127.0.0.1', 1681488222, 'jose'),
(16239, '/biisoft/tables.php', '127.0.0.1', 1681488224, 'jose'),
(16240, '/biisoft/tables.php', '127.0.0.1', 1681488229, 'jose'),
(16241, '/biisoft/tables.php', '127.0.0.1', 1681488230, 'jose'),
(16242, '/biisoft/table.orders.php', '127.0.0.1', 1681488239, 'jose'),
(16243, '/biisoft/pos.php', '127.0.0.1', 1681488258, 'jose'),
(16244, '/biisoft/pos.php', '127.0.0.1', 1681488262, 'jose'),
(16245, '/biisoft/pos.php', '127.0.0.1', 1681488262, 'jose'),
(16246, '/biisoft/pos.php', '127.0.0.1', 1681488292, 'jose'),
(16247, '/biisoft/tables.php', '127.0.0.1', 1681488293, 'jose'),
(16248, '/biisoft/table.orders.php', '127.0.0.1', 1681488297, 'jose'),
(16249, '/biisoft/kotandbot.php', '127.0.0.1', 1681488326, 'jose'),
(16250, '/biisoft/table.orders.php', '127.0.0.1', 1681488330, 'jose'),
(16251, '/biisoft/kotandbot.php', '127.0.0.1', 1681488337, 'jose'),
(16252, '/biisoft/bot.print.php', '127.0.0.1', 1681488337, 'jose'),
(16253, '/biisoft/table.orders.php', '127.0.0.1', 1681488375, 'jose'),
(16254, '/biisoft/bill.php', '127.0.0.1', 1681488384, 'jose'),
(16255, '/biisoft/table.orders.php', '127.0.0.1', 1681488397, 'jose'),
(16256, '/biisoft/table.orders.php', '127.0.0.1', 1681488426, 'jose'),
(16257, '/biisoft/print.php', '127.0.0.1', 1681488426, 'jose'),
(16258, '/biisoft/pos.php', '127.0.0.1', 1681488505, 'jose'),
(16259, '/biisoft/index.php', '127.0.0.1', 1681488509, 'jose'),
(16260, '/biisoft/sales.php', '127.0.0.1', 1681488513, 'jose'),
(16261, '/biisoft/sales.php', '127.0.0.1', 1681488530, 'jose'),
(16262, '/biisoft/sales.php', '127.0.0.1', 1681488540, 'jose'),
(16263, '/biisoft/profit.php', '127.0.0.1', 1681488549, 'jose'),
(16264, '/biisoft/pos.php', '127.0.0.1', 1681488602, 'jose'),
(16265, '/POS/login.php', '::1', 1686882863, 'Unkwon'),
(16266, '/POS/login.php', '::1', 1686882896, 'Unkwon'),
(16267, '/POS/login.php', '::1', 1686882901, 'Unkwon'),
(16268, '/POS/login.php', '::1', 1686882906, 'Unkwon'),
(16269, '/POS/login.php', '::1', 1686882910, 'Unkwon'),
(16270, '/POS/starthere.php', '::1', 1686883008, 'Unkwon'),
(16271, '/POS/starthere.php', '::1', 1686883028, 'Unkwon'),
(16272, '/POS/login.php', '::1', 1686883029, 'Unkwon'),
(16273, '/POS/login.php', '::1', 1686883047, 'Unkwon'),
(16274, '/POS/index.php', '::1', 1686883051, 'admin'),
(16275, '/POS/drinks.php', '::1', 1686883131, 'admin'),
(16276, '/POS/store.php', '::1', 1686883135, 'admin'),
(16277, '/POS/store.php', '::1', 1686883338, 'admin'),
(16278, '/POS/store.php', '::1', 1686883367, 'admin'),
(16279, '/POS/store.php', '::1', 1686883386, 'admin'),
(16280, '/POS/store.php', '::1', 1686883486, 'admin'),
(16281, '/POS/store.php', '::1', 1686883537, 'admin'),
(16282, '/POS/store.php', '::1', 1686883801, 'admin'),
(16283, '/POS/ongeza.php', '::1', 1686883807, 'admin'),
(16284, '/POS/store.php', '::1', 1686884123, 'admin'),
(16285, '/POS/ongeza.php', '::1', 1686884128, 'admin'),
(16286, '/POS/store.php', '::1', 1686884146, 'admin'),
(16287, '/POS/ongeza.php', '::1', 1686884151, 'admin'),
(16288, '/POS/store.php', '::1', 1686884190, 'admin'),
(16289, '/POS/store.php', '::1', 1686884196, 'admin'),
(16290, '/POS/ongeza.php', '::1', 1686884200, 'admin'),
(16291, '/POS/ongeza.php', '::1', 1686884230, 'admin'),
(16292, '/POS/drinks.php', '::1', 1686884250, 'admin'),
(16293, '/POS/store.php', '::1', 1686884262, 'admin'),
(16294, '/POS/ongeza.php', '::1', 1686884391, 'admin'),
(16295, '/POS/ongeza.php', '::1', 1686884447, 'admin'),
(16296, '/POS/ongeza.php', '::1', 1686884479, 'admin'),
(16297, '/POS/ongeza.php', '::1', 1686884691, 'admin'),
(16298, '/POS/ongeza.php', '::1', 1686884886, 'admin'),
(16299, '/POS/ongeza.php', '::1', 1686884957, 'admin'),
(16300, '/POS/ongeza.php', '::1', 1686884969, 'admin'),
(16301, '/POS/store.php', '::1', 1686884969, 'admin'),
(16302, '/POS/store.php', '::1', 1686885130, 'admin'),
(16303, '/POS/ongeza.php', '::1', 1686885136, 'admin'),
(16304, '/POS/ongeza.php', '::1', 1686885144, 'admin'),
(16305, '/POS/store.php', '::1', 1686885144, 'admin'),
(16306, '/POS/ongeza.php', '::1', 1686885155, 'admin'),
(16307, '/POS/ongeza.php', '::1', 1686885166, 'admin'),
(16308, '/POS/store.php', '::1', 1686885166, 'admin'),
(16309, '/POS/store.php', '::1', 1686885201, 'admin'),
(16310, '/POS/drinks.php', '::1', 1686885210, 'admin'),
(16311, '/POS/purchase.php', '::1', 1686885216, 'admin'),
(16312, '/POS/drinks.php', '::1', 1686885233, 'admin'),
(16313, '/POS/addDrink.php', '::1', 1686885237, 'admin'),
(16314, '/POS/addDrink.php', '::1', 1686885254, 'admin'),
(16315, '/POS/addDrink.php', '::1', 1686885259, 'admin'),
(16316, '/POS/drinks.php', '::1', 1686885268, 'admin'),
(16317, '/POS/purchase.php', '::1', 1686885272, 'admin'),
(16318, '/POS/purchase.php', '::1', 1686885291, 'admin'),
(16319, '/POS/purchase.php', '::1', 1686885297, 'admin'),
(16320, '/POS/drinks.php', '::1', 1686885305, 'admin'),
(16321, '/POS/store.php', '::1', 1686885309, 'admin'),
(16322, '/POS/ongeza.php', '::1', 1686885317, 'admin'),
(16323, '/POS/ongeza.php', '::1', 1686885326, 'admin'),
(16324, '/POS/store.php', '::1', 1686885326, 'admin'),
(16325, '/POS/store.php', '::1', 1686885385, 'admin'),
(16326, '/POS/ongeza.php', '::1', 1686885388, 'admin'),
(16327, '/POS/ongeza.php', '::1', 1686885403, 'admin'),
(16328, '/POS/ongeza.php', '::1', 1686885710, 'admin'),
(16329, '/POS/ongeza.php', '::1', 1686885721, 'admin'),
(16330, '/POS/ongeza.php', '::1', 1686886609, 'admin'),
(16331, '/POS/purchase.php', '::1', 1686902460, 'Unkwon'),
(16332, '/POS/login.php', '::1', 1686902465, 'Unkwon'),
(16333, '/POS/login.php', '::1', 1686902492, 'Unkwon'),
(16334, '/POS/index.php', '::1', 1686902499, 'admin'),
(16335, '/POS/drinks.php', '::1', 1686902507, 'admin'),
(16336, '/POS/store.php', '::1', 1686902512, 'admin'),
(16337, '/POS/drinks.php', '::1', 1686902556, 'admin'),
(16338, '/POS/login.php', '127.0.0.1', 1687155554, 'Unkwon'),
(16339, '/POS/login.php', '127.0.0.1', 1687155556, 'Unkwon'),
(16340, '/POS/login.php', '::1', 1687155628, 'Unkwon'),
(16341, '/POS/index.php', '::1', 1687155664, 'admin'),
(16342, '/POS/drinks.php', '127.0.0.1', 1687155746, 'admin'),
(16343, '/POS/store.php', '::1', 1687155753, 'admin'),
(16344, '/POS/store.php', '::1', 1687155833, 'admin'),
(16345, '/POS/store.php', '::1', 1687156077, 'admin'),
(16346, '/POS/store.php', '::1', 1687156106, 'admin'),
(16347, '/POS/store.php', '::1', 1687156131, 'admin'),
(16348, '/POS/store.php', '::1', 1687156190, 'admin'),
(16349, '/POS/store.php', '::1', 1687156232, 'admin'),
(16350, '/POS/store.php', '::1', 1687156279, 'admin'),
(16351, '/POS/store.php', '::1', 1687156301, 'admin'),
(16352, '/POS/store.php', '::1', 1687156387, 'admin'),
(16353, '/POS/purchase.php', '::1', 1687241633, 'Unkwon'),
(16354, '/POS/login.php', '::1', 1687241634, 'Unkwon'),
(16355, '/POS/login.php', '::1', 1687241648, 'Unkwon'),
(16356, '/POS/index.php', '::1', 1687241661, 'admin'),
(16357, '/POS/drinks.php', '::1', 1687241676, 'admin'),
(16358, '/POS/store.php', '::1', 1687241680, 'admin'),
(16359, '/POS/store.php', '::1', 1687241681, 'admin'),
(16360, '/POS/store.php', '::1', 1687241863, 'admin'),
(16361, '/POS/store.php', '::1', 1687241888, 'admin'),
(16362, '/POS/ongeza.php', '::1', 1687241892, 'admin'),
(16363, '/POS/ongeza.php', '::1', 1687241903, 'admin'),
(16364, '/POS/store.php', '::1', 1687241904, 'admin'),
(16365, '/POS/ongeza.php', '::1', 1687241911, 'admin'),
(16366, '/POS/ongeza.php', '::1', 1687241930, 'admin'),
(16367, '/POS/store.php', '::1', 1687241930, 'admin'),
(16368, '/POS/store.php', '::1', 1687241958, 'admin'),
(16369, '/POS/ongeza.php', '::1', 1687241961, 'admin'),
(16370, '/POS/ongeza.php', '::1', 1687241968, 'admin'),
(16371, '/POS/store.php', '::1', 1687241968, 'admin'),
(16372, '/POS/store.php', '::1', 1687241995, 'admin'),
(16373, '/POS/store.php', '::1', 1687242196, 'admin'),
(16374, '/POS/store.php', '::1', 1687242303, 'admin'),
(16375, '/POS/store.php', '::1', 1687242766, 'admin'),
(16376, '/POS/store.php', '::1', 1687242792, 'admin'),
(16377, '/POS/store.php', '::1', 1687242807, 'admin'),
(16378, '/POS/store.php', '::1', 1687242863, 'admin'),
(16379, '/POS/ongeza.php', '::1', 1687242867, 'admin'),
(16380, '/POS/ongeza.php', '::1', 1687242873, 'admin'),
(16381, '/POS/ongeza.php', '::1', 1687242924, 'admin'),
(16382, '/POS/store.php', '::1', 1687242924, 'admin'),
(16383, '/POS/ongeza.php', '::1', 1687242930, 'admin'),
(16384, '/POS/ongeza.php', '::1', 1687242937, 'admin'),
(16385, '/POS/store.php', '::1', 1687242937, 'admin'),
(16386, '/POS/store.php', '::1', 1687243430, 'admin'),
(16387, '/POS/store.php', '::1', 1687243468, 'admin'),
(16388, '/POS/store.php', '::1', 1687243485, 'admin'),
(16389, '/POS/ongeza.php', '::1', 1687243494, 'admin'),
(16390, '/POS/store.php', '::1', 1687243497, 'admin'),
(16391, '/POS/store.php', '::1', 1687243523, 'admin'),
(16392, '/POS/ongeza.php', '::1', 1687243526, 'admin'),
(16393, '/POS/store.php', '::1', 1687243531, 'admin'),
(16394, '/POS/store.php', '::1', 1687243607, 'admin'),
(16395, '/POS/store.php', '::1', 1687243624, 'admin'),
(16396, '/POS/store.php', '::1', 1687243664, 'admin'),
(16397, '/POS/store.php', '::1', 1687243704, 'admin'),
(16398, '/POS/store.php', '::1', 1687243719, 'admin'),
(16399, '/POS/store.php', '::1', 1687243730, 'admin'),
(16400, '/POS/store.php', '::1', 1687243779, 'admin'),
(16401, '/POS/store.php', '::1', 1687243825, 'admin'),
(16402, '/POS/store.php', '::1', 1687243851, 'admin'),
(16403, '/POS/store.php', '::1', 1687243899, 'admin'),
(16404, '/POS/ongeza.php', '::1', 1687243928, 'admin'),
(16405, '/POS/drinks.php', '::1', 1687244297, 'admin'),
(16406, '/POS/store.php', '::1', 1687244301, 'admin'),
(16407, '/POS/ongeza.php', '::1', 1687244322, 'admin'),
(16408, '/POS/ongeza.php', '::1', 1687244328, 'admin'),
(16409, '/POS/store.php', '::1', 1687244328, 'admin'),
(16410, '/POS/pos.php', '::1', 1687244476, 'admin'),
(16411, '/POS/tables.php', '::1', 1687244489, 'admin'),
(16412, '/POS/table.orders.php', '::1', 1687244504, 'admin'),
(16413, '/POS/tables.php', '::1', 1687244509, 'admin'),
(16414, '/POS/pos.php', '::1', 1687244522, 'admin'),
(16415, '/POS/pos.php', '::1', 1687244526, 'admin'),
(16416, '/POS/pos.php', '::1', 1687244526, 'admin'),
(16417, '/POS/pos.php', '::1', 1687244537, 'admin'),
(16418, '/POS/tables.php', '::1', 1687244540, 'admin'),
(16419, '/POS/table.orders.php', '::1', 1687244548, 'admin'),
(16420, '/POS/table.orders.php', '::1', 1687244578, 'admin'),
(16421, '/POS/login.php', '::1', 1687244578, 'Unkwon'),
(16422, '/POS/login.php', '::1', 1687244592, 'Unkwon'),
(16423, '/POS/login.php', '::1', 1687244594, 'Unkwon'),
(16424, '/POS/starthere.php', '::1', 1687244611, 'Unkwon'),
(16425, '/POS/starthere.php', '::1', 1687244636, 'Unkwon'),
(16426, '/POS/login.php', '::1', 1687244637, 'Unkwon'),
(16427, '/POS/login.php', '::1', 1687244656, 'Unkwon'),
(16428, '/POS/sales.php', '::1', 1687244661, 'Accountant');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_name` varchar(50) NOT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_status` int(11) NOT NULL DEFAULT 1 COMMENT '2 = not active\n1 = active\n',
  `users_role` int(11) NOT NULL DEFAULT 1 COMMENT '3 = sales\n2= accountant\n1 = admin\n',
  `employeeID` int(11) NOT NULL,
  `users_deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_name`, `users_password`, `users_status`, `users_role`, `employeeID`, `users_deleted`) VALUES
(24, 'admin', '$2y$10$OGTmYhLomXiFRboKPpw1MOPijbSlYKV6qNVLa7AL5RNDTP89H.OPu', 1, 1, 1702694229, 0),
(25, 'Accountant', '$2y$10$NOCHzOX32zbmG0UcznAV1euq5W4Fn6ikpC1U6zObsX.a5gHhrSQH2', 1, 2, 1703055837, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bot`
--
ALTER TABLE `bot`
  ADD PRIMARY KEY (`bot_id`),
  ADD KEY `botToTable` (`tables_ID`),
  ADD KEY `botToItems` (`tableItems_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `creditors`
--
ALTER TABLE `creditors`
  ADD PRIMARY KEY (`creditors_id`);

--
-- Indexes for table `foodmenu`
--
ALTER TABLE `foodmenu`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `fk_products_categories_idx` (`food_cat`);

--
-- Indexes for table `kot`
--
ALTER TABLE `kot`
  ADD PRIMARY KEY (`kot_id`),
  ADD KEY `kotToTable` (`tables_ID`),
  ADD KEY `kotToItems` (`tableItems_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`products_id`),
  ADD KEY `fk_products_categories_idx` (`products_cat`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchases_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `salesdetails`
--
ALTER TABLE `salesdetails`
  ADD PRIMARY KEY (`salesDetails_id`),
  ADD KEY `fk_salesDetails_sales1_idx` (`salesDetails_saledID`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`),
  ADD KEY `fk_store_categories1_idx` (`category`);

--
-- Indexes for table `tableitems`
--
ALTER TABLE `tableitems`
  ADD PRIMARY KEY (`tableItems_id`),
  ADD KEY `itemsToTable` (`tables_ID`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `tracker`
--
ALTER TABLE `tracker`
  ADD PRIMARY KEY (`tracker_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `users_name_UNIQUE` (`users_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bot`
--
ALTER TABLE `bot`
  MODIFY `bot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `creditors`
--
ALTER TABLE `creditors`
  MODIFY `creditors_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=503;

--
-- AUTO_INCREMENT for table `foodmenu`
--
ALTER TABLE `foodmenu`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `kot`
--
ALTER TABLE `kot`
  MODIFY `kot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1345;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `products_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchases_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=753;

--
-- AUTO_INCREMENT for table `salesdetails`
--
ALTER TABLE `salesdetails`
  MODIFY `salesDetails_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1237;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `tableitems`
--
ALTER TABLE `tableitems`
  MODIFY `tableItems_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tracker`
--
ALTER TABLE `tracker`
  MODIFY `tracker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16429;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bot`
--
ALTER TABLE `bot`
  ADD CONSTRAINT `botToItems` FOREIGN KEY (`tableItems_id`) REFERENCES `tableitems` (`tableItems_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `botToTable` FOREIGN KEY (`tables_ID`) REFERENCES `tables` (`table_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `foodmenu`
--
ALTER TABLE `foodmenu`
  ADD CONSTRAINT `fk_products_categories0` FOREIGN KEY (`food_cat`) REFERENCES `categories` (`categories_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kot`
--
ALTER TABLE `kot`
  ADD CONSTRAINT `kotToItems` FOREIGN KEY (`tableItems_id`) REFERENCES `tableitems` (`tableItems_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_categories` FOREIGN KEY (`products_cat`) REFERENCES `categories` (`categories_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesdetails`
--
ALTER TABLE `salesdetails`
  ADD CONSTRAINT `fk_salesDetails_sales1` FOREIGN KEY (`salesDetails_saledID`) REFERENCES `sales` (`sales_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `fk_store_categories1` FOREIGN KEY (`category`) REFERENCES `categories` (`categories_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tableitems`
--
ALTER TABLE `tableitems`
  ADD CONSTRAINT `itemsToTable` FOREIGN KEY (`tables_ID`) REFERENCES `tables` (`table_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
