-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2023 at 03:57 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(51, 'Aperitif', 'active', 1631799958, 0, NULL, NULL),
(52, 'LIght DRINK', 'active', 1685705350, 0, NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `creditors`
--

INSERT INTO `creditors` (`creditors_id`, `refNumber`, `full_name`, `dept_to_pay`, `total`, `qty`, `date_issued`, `issued_by`, `creditors_returns`, `deleted`, `time_issued`, `deleted_by`, `deleted_date`, `creditors_status`) VALUES
(503, 'd20230530104606', 'Room 5', 3000, 3000, 1, '2023-05-30', 'Admin', 1000, 0, 1685432766, NULL, NULL, 0),
(504, 'd20230602133513', '10000', 3600, 3600, 2, '2023-06-02', 'Admin', 3600, 0, 1685702113, NULL, NULL, 1),
(505, 'd20230602134347', '10000', 24000, 24000, 2, '2023-06-02', 'Admin', 24000, 0, 1685702627, NULL, NULL, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foodmenu`
--

INSERT INTO `foodmenu` (`food_id`, `food_name`, `food_cat`, `food_price`, `food_status`, `food_time`, `food_deleted`, `food_dlt_date`, `food_dlt_by`) VALUES
(85, 'Ugali nyama', 37, 2000, 'notactive', 1685524327, 0, NULL, NULL),
(86, 'Wali Mahare', 49, 2500, 'active', 1685701231, 0, NULL, NULL),
(87, 'Biriani', 37, 7000, 'active', 1685701249, 0, NULL, NULL),
(88, 'Burger', 48, 5000, 'active', 1685701265, 0, NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`products_id`, `products_name`, `products_cat`, `products_qty`, `products_price`, `products_status`, `products_time`, `products_deleted`, `products_dlt_date`, `products_dlt_by`, `products_profitPerPc`) VALUES
(197, 'Redbull', 37, 99, 3000, 'active', 1672603324, 0, NULL, NULL, 1500),
(198, 'Fanta', 37, 22, 600, 'active', 1672654268, 0, NULL, NULL, 100),
(199, 'Dompo', 43, 13, 12000, 'active', 1685701137, 0, NULL, NULL, 2000),
(200, 'Badwiser', 45, 20, 5000, 'active', 1685701152, 0, NULL, NULL, 1000);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchases_id`, `purchases_name`, `purchases_qty`, `purchases_buy_price`, `purchases_sell_price`, `purchased_by`, `purchases_date`, `purchases_time`, `purchases_deleted`, `purchases_dlt_date`, `purchases_dlt_by`, `purchases_totalAfterSell`, `purchases_profitAfterSell`, `purchases_buyingPricePc`) VALUES
(317, 'Redbull', 115, 1500, 3000, 'Admin', '2023-06-09', 1686302134, 0, NULL, NULL, 345000, 172500, 1500),
(318, 'Badwiser', 20, 4000, 5000, 'Admin', '2023-06-02', 1685701171, 0, NULL, NULL, 100000, 20000, 4000),
(319, 'Dompo', 15, 10000, 12000, 'Admin', '2023-06-02', 1685701189, 0, NULL, NULL, 180000, 30000, 10000),
(320, 'Fanta', 24, 500, 600, 'Admin', '2023-06-02', 1685701209, 0, NULL, NULL, 14400, 2400, 500);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `sales_paymentMethod`, `sales_refNumber`, `sales_discount`, `sales_paid`, `sales_total`, `sales_balance`, `sales_qty`, `sales_date`, `sales_isssed_by`, `sales_deleted`, `sales_time`, `sales_dlt_date`, `sales_dlt_by`, `sales_totalNProfit`, `sales_VAT`) VALUES
(752, 'cash', 'd20230414190706', 0, 3000, 3000, 0, 1, '2023-04-14', 'jose', 0, 1681488426, NULL, NULL, 1042, '458'),
(753, 'cash', 'd20230530104355', 1000, 5000, 6000, 0, 2, '2023-05-30', 'Admin', 0, 1685432635, NULL, NULL, 2084, '916'),
(754, 'credit', 'd20230530104606', 0, 3000, 3000, 0, 1, '2023-05-30', 'Admin', 0, 1685432766, NULL, NULL, 1042, '458'),
(755, 'cash', 'd20230530231120', 0, 3000, 3000, 0, 1, '2023-05-30', 'Admin', 0, 1685477480, NULL, NULL, 1042, '458'),
(756, 'cash', 'd20230531114105', 0, 6000, 6000, 0, 2, '2023-05-31', 'Admin', 0, 1685522465, NULL, NULL, 2084, '916'),
(757, 'cash', 'd20230531122011', 0, 3000, 3000, 0, 1, '2023-05-31', 'Admin', 0, 1685524811, NULL, NULL, 1042, '458'),
(758, 'cash', 'd20230531122142', 0, 3000, 3000, 0, 1, '2023-05-31', 'Admin', 0, 1685524902, NULL, NULL, 1042, '458'),
(759, 'cash', 'd20230531122155', 0, 3000, 3000, 0, 1, '2023-05-31', 'Admin', 0, 1685524915, NULL, NULL, 1042, '458'),
(760, 'cash', 'd20230602132128', 1000, 7600, 8600, 0, 3, '2023-06-02', 'Admin', 0, 1685701288, NULL, NULL, 1050, '1450'),
(761, 'credit', 'd20230602133513', 0, 3600, 3600, 0, 2, '2023-06-02', 'Admin', 0, 1685702113, NULL, NULL, 1050, '550'),
(762, 'credit', 'd20230602134347', 0, 24000, 24000, 0, 2, '2023-06-02', 'Admin', 0, 1685702627, NULL, NULL, 338, '3662'),
(763, 'cash', 'd20230602143031', 0, 12000, 12000, 0, 4, '2023-06-02', 'Admin', 0, 1685705431, NULL, NULL, 4168, '1832');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salesdetails`
--

INSERT INTO `salesdetails` (`salesDetails_id`, `salesDetails_name`, `salesDetails_cat`, `salesDetails_qty`, `salesDetails_price`, `salesDetails_total`, `salesDetails_saledID`, `salesDetails_dlt`, `salesDetails_dlt_time`, `salesDetails_dlt_by`) VALUES
(1236, 'Redbull', 'Soft Drinks', 1, 3000, 3000, 752, 0, NULL, NULL),
(1237, 'Redbull', 'Soft Drinks', 1, 3000, 3000, 753, 0, NULL, NULL),
(1239, 'Redbull', 'Soft Drinks', 1, 3000, 3000, 754, 0, NULL, NULL),
(1240, 'Redbull', 'Soft Drinks', 1, 3000, 3000, 755, 0, NULL, NULL),
(1242, 'Redbull', 'Soft Drinks', 1, 3000, 3000, 756, 0, NULL, NULL),
(1243, 'Redbull', 'Soft Drinks', 1, 3000, 3000, 757, 0, NULL, NULL),
(1244, 'Redbull', 'Soft Drinks', 1, 3000, 3000, 758, 0, NULL, NULL),
(1245, 'Redbull', 'Soft Drinks', 1, 3000, 3000, 759, 0, NULL, NULL),
(1246, 'Redbull', 'Soft Drinks', 1, 3000, 3000, 760, 0, NULL, NULL),
(1249, 'Redbull', 'Soft Drinks', 1, 3000, 3000, 761, 0, NULL, NULL),
(1252, 'Dompo', 'Wine', 1, 12000, 12000, 762, 0, NULL, NULL);

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
  `store_timeDeleted` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `product_name`, `category`, `instore`, `sold`, `store_deleted`, `store_deletedby`, `store_timeDeleted`) VALUES
(197, 'Redbull', 37, 99, 16, 0, NULL, NULL),
(198, 'Fanta', 37, 22, 2, 0, NULL, NULL),
(199, 'Dompo', 43, 13, 2, 0, NULL, NULL),
(200, 'Badwiser', 45, 20, 0, 0, NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tableitems`
--

INSERT INTO `tableitems` (`tableItems_id`, `item_name`, `item_cat`, `item_qty`, `item_price`, `item_total`, `item_time`, `issued_by`, `item_savedby`, `item_profitPerPc`, `item_VAT`, `tables_ID`, `item_dlt`, `item_dlt_time`, `item_dlt_by`) VALUES
(78, 'Redbull', 'Soft Drinks', 1, 3000, 3000, 1685432666, 'Admin', 'joseph genes', 1042, 458, 29, 1, 1685701310, 'Admin'),
(79, 'Redbull', 'Soft Drinks', 1, 3000, 3000, 1685432666, 'Admin', 'joseph genes', 1042, 458, 29, 1, 1685701312, 'Admin'),
(80, 'Redbull', 'Soft Drinks', 1, 3000, 3000, 1685432667, 'Admin', 'joseph genes', 1042, 458, 29, 1, 1685701317, 'Admin'),
(83, 'Badwiser', 'Local Beer', 1, 5000, 5000, 1685701294, 'Admin', 'John Doe', 237, 763, 29, 1, 1685702582, 'Admin'),
(84, 'Wali Mahare', 'Breakfast', 1, 2500, 2500, 1685701294, 'Admin', 'John Doe', 0, 450, 29, 1, 1685702584, 'Admin'),
(85, 'Dompo', 'Wine', 1, 12000, 12000, 1685701295, 'Admin', 'John Doe', 169, 1831, 29, 1, 1685702586, 'Admin'),
(86, 'Fanta', 'Soft Drinks', 1, 600, 600, 1685702120, 'Admin', 'John Doe', 8, 92, 29, 1, 1685702587, 'Admin');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_id`, `table_number`, `table_status`, `table_deleted`, `table_deleted_date`, `table_deleted_by`) VALUES
(29, 101, 0, 0, NULL, NULL),
(30, 102, 0, 0, NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(16265, '/pos/index.php', '::1', 1685432434, 'Unkwon'),
(16266, '/pos/login.php', '::1', 1685432434, 'Unkwon'),
(16267, '/pos/login.php', '::1', 1685432449, 'Unkwon'),
(16268, '/pos/login.php', '::1', 1685432451, 'Unkwon'),
(16269, '/pos/login.php', '::1', 1685432459, 'Unkwon'),
(16270, '/pos/login.php', '::1', 1685432465, 'Unkwon'),
(16271, '/pos/starthere.php', '::1', 1685432488, 'Unkwon'),
(16272, '/pos/starthere.php', '::1', 1685432509, 'Unkwon'),
(16273, '/pos/login.php', '::1', 1685432509, 'Unkwon'),
(16274, '/pos/login.php', '::1', 1685432518, 'Unkwon'),
(16275, '/pos/index.php', '::1', 1685432520, 'Admin'),
(16276, '/POS/sales.php', '::1', 1685432540, 'Admin'),
(16277, '/POS/salesCat.php', '::1', 1685432542, 'Admin'),
(16278, '/POS/salesCat.php', '::1', 1685432545, 'Admin'),
(16279, '/POS/sales.php', '::1', 1685432547, 'Admin'),
(16280, '/POS/drinks.php', '::1', 1685432550, 'Admin'),
(16281, '/POS/store.php', '::1', 1685432552, 'Admin'),
(16282, '/POS/drinks.php', '::1', 1685432557, 'Admin'),
(16283, '/POS/cat.php', '::1', 1685432560, 'Admin'),
(16284, '/POS/food.php', '::1', 1685432565, 'Admin'),
(16285, '/POS/addFood.php', '::1', 1685432566, 'Admin'),
(16286, '/POS/smanage.php', '::1', 1685432568, 'Admin'),
(16287, '/POS/index.php', '::1', 1685432572, 'Admin'),
(16288, '/POS/creditors.php', '::1', 1685432574, 'Admin'),
(16289, '/POS/sales.php', '::1', 1685432576, 'Admin'),
(16290, '/POS/salesCat.php', '::1', 1685432577, 'Admin'),
(16291, '/POS/creditors.php', '::1', 1685432579, 'Admin'),
(16292, '/POS/sales.php', '::1', 1685432581, 'Admin'),
(16293, '/POS/pos.php', '::1', 1685432582, 'Admin'),
(16294, '/POS/pos.php', '::1', 1685432584, 'Admin'),
(16295, '/POS/pos.php', '::1', 1685432584, 'Admin'),
(16296, '/POS/pos.php', '::1', 1685432585, 'Admin'),
(16297, '/POS/pos.php', '::1', 1685432585, 'Admin'),
(16298, '/POS/pos.php', '::1', 1685432605, 'Admin'),
(16299, '/POS/tables.php', '::1', 1685432607, 'Admin'),
(16300, '/POS/table.orders.php', '::1', 1685432609, 'Admin'),
(16301, '/POS/table.orders.php', '::1', 1685432610, 'Admin'),
(16302, '/POS/tables.php', '::1', 1685432612, 'Admin'),
(16303, '/POS/table.orders.php', '::1', 1685432616, 'Admin'),
(16304, '/POS/table.orders.php', '::1', 1685432635, 'Admin'),
(16305, '/POS/print.php', '::1', 1685432636, 'Admin'),
(16306, '/POS/pos.php', '::1', 1685432639, 'Admin'),
(16307, '/POS/tables.php', '::1', 1685432650, 'Admin'),
(16308, '/POS/table.orders.php', '::1', 1685432652, 'Admin'),
(16309, '/POS/table.orders.php', '::1', 1685432653, 'Admin'),
(16310, '/POS/tables.php', '::1', 1685432655, 'Admin'),
(16311, '/POS/kot.php', '::1', 1685432658, 'Admin'),
(16312, '/POS/bot.php', '::1', 1685432659, 'Admin'),
(16313, '/POS/pos.php', '::1', 1685432664, 'Admin'),
(16314, '/POS/pos.php', '::1', 1685432665, 'Admin'),
(16315, '/POS/pos.php', '::1', 1685432666, 'Admin'),
(16316, '/POS/pos.php', '::1', 1685432667, 'Admin'),
(16317, '/POS/pos.php', '::1', 1685432667, 'Admin'),
(16318, '/POS/pos.php', '::1', 1685432675, 'Admin'),
(16319, '/POS/tables.php', '::1', 1685432677, 'Admin'),
(16320, '/POS/table.orders.php', '::1', 1685432678, 'Admin'),
(16321, '/POS/kotandbot.php', '::1', 1685432681, 'Admin'),
(16322, '/POS/table.orders.php', '::1', 1685432692, 'Admin'),
(16323, '/POS/kotandbot.php', '::1', 1685432695, 'Admin'),
(16324, '/POS/bot.print.php', '::1', 1685432695, 'Admin'),
(16325, '/POS/table.orders.php', '::1', 1685432700, 'Admin'),
(16326, '/POS/kotandbot.php', '::1', 1685432704, 'Admin'),
(16327, '/POS/table.orders.php', '::1', 1685432705, 'Admin'),
(16328, '/POS/bot.php', '::1', 1685432714, 'Admin'),
(16329, '/POS/bot.php', '::1', 1685432716, 'Admin'),
(16330, '/POS/kot.php', '::1', 1685432717, 'Admin'),
(16331, '/POS/bot.php', '::1', 1685432724, 'Admin'),
(16332, '/POS/bot.php', '::1', 1685432734, 'Admin'),
(16333, '/POS/pos.php', '::1', 1685432735, 'Admin'),
(16334, '/POS/pos.php', '::1', 1685432737, 'Admin'),
(16335, '/POS/pos.php', '::1', 1685432737, 'Admin'),
(16336, '/POS/pos.php', '::1', 1685432739, 'Admin'),
(16337, '/POS/pos.php', '::1', 1685432739, 'Admin'),
(16338, '/POS/pos.php', '::1', 1685432741, 'Admin'),
(16339, '/POS/pos.php', '::1', 1685432741, 'Admin'),
(16340, '/POS/pos.php', '::1', 1685432766, 'Admin'),
(16341, '/POS/print.php', '::1', 1685432767, 'Admin'),
(16342, '/POS/pos.php', '::1', 1685432775, 'Admin'),
(16343, '/POS/pos.php', '::1', 1685432793, 'Admin'),
(16344, '/POS/index.php', '127.0.0.1', 1685477250, 'Unkwon'),
(16345, '/POS/login.php', '127.0.0.1', 1685477250, 'Unkwon'),
(16346, '/POS/login.php', '127.0.0.1', 1685477372, 'Unkwon'),
(16347, '/POS/index.php', '127.0.0.1', 1685477375, 'Admin'),
(16348, '/POS/tables.php', '127.0.0.1', 1685477382, 'Admin'),
(16349, '/POS/pos.php', '127.0.0.1', 1685477387, 'Admin'),
(16350, '/POS/tables.php', '127.0.0.1', 1685477389, 'Admin'),
(16351, '/POS/index.php', '127.0.0.1', 1685477390, 'Admin'),
(16352, '/POS/smanage.php', '127.0.0.1', 1685477401, 'Admin'),
(16353, '/POS/food.php', '127.0.0.1', 1685477411, 'Admin'),
(16354, '/POS/addFood.php', '127.0.0.1', 1685477413, 'Admin'),
(16355, '/POS/pos.php', '127.0.0.1', 1685477430, 'Admin'),
(16356, '/POS/pos.php', '127.0.0.1', 1685477439, 'Admin'),
(16357, '/POS/pos.php', '127.0.0.1', 1685477440, 'Admin'),
(16358, '/POS/pos.php', '127.0.0.1', 1685477465, 'Admin'),
(16359, '/POS/pos.php', '127.0.0.1', 1685477480, 'Admin'),
(16360, '/POS/print.php', '127.0.0.1', 1685477480, 'Admin'),
(16361, '/POS/pos.php', '127.0.0.1', 1685477528, 'Admin'),
(16362, '/POS/index.php', '127.0.0.1', 1685477532, 'Admin'),
(16363, '/POS/sales.php', '127.0.0.1', 1685477538, 'Admin'),
(16364, '/POS/smanage.php', '127.0.0.1', 1685477609, 'Admin'),
(16365, '/POS/tables.php', '127.0.0.1', 1685477616, 'Admin'),
(16366, '/POS/table.orders.php', '127.0.0.1', 1685477618, 'Admin'),
(16367, '/POS/tables.php', '127.0.0.1', 1685477632, 'Admin'),
(16368, '/POS/table.orders.php', '127.0.0.1', 1685477635, 'Admin'),
(16369, '/POS/tables.php', '127.0.0.1', 1685477641, 'Admin'),
(16370, '/POS/bot.php', '127.0.0.1', 1685477651, 'Admin'),
(16371, '/POS/kot.php', '127.0.0.1', 1685477656, 'Admin'),
(16372, '/POS/includes/delete.kot.php', '127.0.0.1', 1685477661, 'Unkwon'),
(16373, '/POS/kot.php', '127.0.0.1', 1685477665, 'Admin'),
(16374, '/POS/kot.php', '127.0.0.1', 1685477669, 'Admin'),
(16375, '/POS/login.php', '127.0.0.1', 1685477669, 'Unkwon'),
(16376, '/pos/index.php', '::1', 1685522220, 'Unkwon'),
(16377, '/pos/login.php', '::1', 1685522222, 'Unkwon'),
(16378, '/pos/login.php', '::1', 1685522238, 'Unkwon'),
(16379, '/pos/index.php', '::1', 1685522242, 'Admin'),
(16380, '/POS/profit.php', '::1', 1685522288, 'Admin'),
(16381, '/POS/creditors.php', '::1', 1685522299, 'Admin'),
(16382, '/POS/creditorsReturns.php', '::1', 1685522310, 'Admin'),
(16383, '/POS/creditors.php', '::1', 1685522313, 'Admin'),
(16384, '/POS/index.php', '::1', 1685522316, 'Admin'),
(16385, '/POS/sales.php', '::1', 1685522328, 'Admin'),
(16386, '/POS/sales.php', '::1', 1685522330, 'Admin'),
(16387, '/POS/food.php', '::1', 1685522365, 'Admin'),
(16388, '/POS/drinks.php', '::1', 1685522370, 'Admin'),
(16389, '/POS/cat.php', '::1', 1685522378, 'Admin'),
(16390, '/POS/tables.php', '::1', 1685522381, 'Admin'),
(16391, '/POS/pos.php', '::1', 1685522388, 'Admin'),
(16392, '/POS/pos.php', '::1', 1685522391, 'Admin'),
(16393, '/POS/pos.php', '::1', 1685522392, 'Admin'),
(16394, '/POS/pos.php', '::1', 1685522394, 'Admin'),
(16395, '/POS/pos.php', '::1', 1685522395, 'Admin'),
(16396, '/POS/pos.php', '::1', 1685522409, 'Admin'),
(16397, '/POS/tables.php', '::1', 1685522411, 'Admin'),
(16398, '/POS/table.orders.php', '::1', 1685522421, 'Admin'),
(16399, '/POS/kotandbot.php', '::1', 1685522440, 'Admin'),
(16400, '/POS/table.orders.php', '::1', 1685522453, 'Admin'),
(16401, '/POS/table.orders.php', '::1', 1685522465, 'Admin'),
(16402, '/POS/print.php', '::1', 1685522466, 'Admin'),
(16403, '/pos/index.php', '::1', 1685523695, 'Unkwon'),
(16404, '/pos/login.php', '::1', 1685523697, 'Unkwon'),
(16405, '/pos/login.php', '::1', 1685523728, 'Unkwon'),
(16406, '/pos/index.php', '::1', 1685523732, 'Admin'),
(16407, '/POS/pos.php', '::1', 1685523777, 'Admin'),
(16408, '/POS/pos.php', '::1', 1685523827, 'Admin'),
(16409, '/POS/pos.php', '::1', 1685523828, 'Admin'),
(16410, '/POS/pos.php', '::1', 1685523847, 'Admin'),
(16411, '/POS/pos.php', '::1', 1685523848, 'Admin'),
(16412, '/POS/tables.php', '::1', 1685523855, 'Admin'),
(16413, '/POS/cat.php', '::1', 1685523868, 'Admin'),
(16414, '/POS/drinks.php', '::1', 1685523892, 'Admin'),
(16415, '/POS/addDrink.php', '::1', 1685523900, 'Admin'),
(16416, '/POS/pos.php', '::1', 1685523964, 'Admin'),
(16417, '/POS/drinks.php', '::1', 1685523973, 'Admin'),
(16418, '/POS/purchase.php', '::1', 1685524015, 'Admin'),
(16419, '/POS/food.php', '::1', 1685524025, 'Admin'),
(16420, '/POS/drinks.php', '::1', 1685524026, 'Admin'),
(16421, '/POS/food.php', '::1', 1685524214, 'Admin'),
(16422, '/POS/addFood.php', '::1', 1685524217, 'Admin'),
(16423, '/POS/addFood.php', '::1', 1685524299, 'Admin'),
(16424, '/POS/addFood.php', '::1', 1685524319, 'Admin'),
(16425, '/POS/addFood.php', '::1', 1685524327, 'Admin'),
(16426, '/POS/addFood.php', '::1', 1685524328, 'Admin'),
(16427, '/POS/index.php', '::1', 1685524337, 'Admin'),
(16428, '/POS/food.php', '::1', 1685524345, 'Admin'),
(16429, '/POS/index.php', '::1', 1685524372, 'Admin'),
(16430, '/POS/sales.php', '::1', 1685524377, 'Admin'),
(16431, '/POS/sales.php', '::1', 1685524422, 'Admin'),
(16432, '/POS/pos.php', '::1', 1685524790, 'Admin'),
(16433, '/POS/pos.php', '::1', 1685524796, 'Admin'),
(16434, '/POS/pos.php', '::1', 1685524800, 'Admin'),
(16435, '/POS/pos.php', '::1', 1685524810, 'Admin'),
(16436, '/POS/print.php', '::1', 1685524812, 'Admin'),
(16437, '/POS/pos.php', '::1', 1685524814, 'Admin'),
(16438, '/POS/pos.php', '::1', 1685524817, 'Admin'),
(16439, '/POS/pos.php', '::1', 1685524817, 'Admin'),
(16440, '/POS/pos.php', '::1', 1685524902, 'Admin'),
(16441, '/POS/print.php', '::1', 1685524903, 'Admin'),
(16442, '/POS/pos.php', '::1', 1685524908, 'Admin'),
(16443, '/POS/pos.php', '::1', 1685524910, 'Admin'),
(16444, '/POS/pos.php', '::1', 1685524911, 'Admin'),
(16445, '/POS/pos.php', '::1', 1685524915, 'Admin'),
(16446, '/POS/print.php', '::1', 1685524916, 'Admin'),
(16447, '/POS/pos.php', '::1', 1685524920, 'Admin'),
(16448, '/POS/index.php', '::1', 1685524923, 'Admin'),
(16449, '/POS/sales.php', '::1', 1685524925, 'Admin'),
(16450, '/POS/sales.php', '::1', 1685524945, 'Admin'),
(16451, '/POS/sales.php', '::1', 1685524979, 'Admin'),
(16452, '/POS/drinks.php', '::1', 1685525156, 'Admin'),
(16453, '/POS/store.php', '::1', 1685525159, 'Admin'),
(16454, '/POS/index.php', '::1', 1685525369, 'Admin'),
(16455, '/POS/salesCat.php', '::1', 1685525455, 'Admin'),
(16456, '/POS/salesCat.php', '::1', 1685525576, 'Admin'),
(16457, '/POS/profit.php', '::1', 1685525699, 'Admin'),
(16458, '/POS/creditors.php', '::1', 1685525723, 'Admin'),
(16459, '/pos/index.php', '::1', 1685700068, 'Unkwon'),
(16460, '/pos/login.php', '::1', 1685700069, 'Unkwon'),
(16461, '/pos/login.php', '::1', 1685700075, 'Unkwon'),
(16462, '/pos/index.php', '::1', 1685700077, 'Admin'),
(16463, '/POS/pos.php', '::1', 1685700081, 'Admin'),
(16464, '/POS/pos.php', '::1', 1685700082, 'Admin'),
(16465, '/POS/pos.php', '::1', 1685700083, 'Admin'),
(16466, '/POS/pos.php', '::1', 1685700084, 'Admin'),
(16467, '/POS/pos.php', '::1', 1685700084, 'Admin'),
(16468, '/POS/pos.php', '::1', 1685700105, 'Admin'),
(16469, '/POS/pos.php', '::1', 1685700105, 'Admin'),
(16470, '/POS/pos.php', '::1', 1685700107, 'Admin'),
(16471, '/pos/index.php', '::1', 1685701083, 'Unkwon'),
(16472, '/pos/login.php', '::1', 1685701083, 'Unkwon'),
(16473, '/pos/login.php', '::1', 1685701088, 'Unkwon'),
(16474, '/pos/index.php', '::1', 1685701091, 'Admin'),
(16475, '/POS/profit.php', '::1', 1685701097, 'Admin'),
(16476, '/POS/sales.php', '::1', 1685701105, 'Admin'),
(16477, '/POS/drinks.php', '::1', 1685701107, 'Admin'),
(16478, '/POS/purchase.php', '::1', 1685701108, 'Admin'),
(16479, '/POS/drinks.php', '::1', 1685701114, 'Admin'),
(16480, '/POS/addDrink.php', '::1', 1685701115, 'Admin'),
(16481, '/POS/addDrink.php', '::1', 1685701137, 'Admin'),
(16482, '/POS/addDrink.php', '::1', 1685701152, 'Admin'),
(16483, '/POS/drinks.php', '::1', 1685701154, 'Admin'),
(16484, '/POS/purchase.php', '::1', 1685701156, 'Admin'),
(16485, '/POS/purchase.php', '::1', 1685701171, 'Admin'),
(16486, '/POS/purchase.php', '::1', 1685701172, 'Admin'),
(16487, '/POS/purchase.php', '::1', 1685701189, 'Admin'),
(16488, '/POS/purchase.php', '::1', 1685701190, 'Admin'),
(16489, '/POS/purchase.php', '::1', 1685701209, 'Admin'),
(16490, '/POS/purchase.php', '::1', 1685701210, 'Admin'),
(16491, '/POS/drinks.php', '::1', 1685701213, 'Admin'),
(16492, '/POS/food.php', '::1', 1685701218, 'Admin'),
(16493, '/POS/addFood.php', '::1', 1685701219, 'Admin'),
(16494, '/POS/addFood.php', '::1', 1685701231, 'Admin'),
(16495, '/POS/addFood.php', '::1', 1685701249, 'Admin'),
(16496, '/POS/addFood.php', '::1', 1685701265, 'Admin'),
(16497, '/POS/pos.php', '::1', 1685701270, 'Admin'),
(16498, '/POS/pos.php', '::1', 1685701277, 'Admin'),
(16499, '/POS/pos.php', '::1', 1685701277, 'Admin'),
(16500, '/POS/pos.php', '::1', 1685701278, 'Admin'),
(16501, '/POS/pos.php', '::1', 1685701279, 'Admin'),
(16502, '/POS/pos.php', '::1', 1685701287, 'Admin'),
(16503, '/POS/print.php', '::1', 1685701288, 'Admin'),
(16504, '/POS/pos.php', '::1', 1685701292, 'Admin'),
(16505, '/POS/pos.php', '::1', 1685701294, 'Admin'),
(16506, '/POS/pos.php', '::1', 1685701294, 'Admin'),
(16507, '/POS/pos.php', '::1', 1685701294, 'Admin'),
(16508, '/POS/pos.php', '::1', 1685701295, 'Admin'),
(16509, '/POS/pos.php', '::1', 1685701295, 'Admin'),
(16510, '/POS/pos.php', '::1', 1685701304, 'Admin'),
(16511, '/POS/tables.php', '::1', 1685701306, 'Admin'),
(16512, '/POS/table.orders.php', '::1', 1685701307, 'Admin'),
(16513, '/POS/includes/tableordersdelete.php', '::1', 1685701310, 'Admin'),
(16514, '/POS/table.orders.php', '::1', 1685701310, 'Admin'),
(16515, '/POS/includes/tableordersdelete.php', '::1', 1685701312, 'Admin'),
(16516, '/POS/table.orders.php', '::1', 1685701312, 'Admin'),
(16517, '/POS/includes/tableordersdelete.php', '::1', 1685701317, 'Admin'),
(16518, '/POS/table.orders.php', '::1', 1685701317, 'Admin'),
(16519, '/POS/table.orders.php', '::1', 1685701557, 'Admin'),
(16520, '/POS/table.orders.php', '::1', 1685701559, 'Admin'),
(16521, '/POS/table.orders.php', '::1', 1685701664, 'Admin'),
(16522, '/POS/table.orders.php', '::1', 1685701756, 'Admin'),
(16523, '/POS/table.orders.php', '::1', 1685701785, 'Admin'),
(16524, '/POS/table.orders.php', '::1', 1685701814, 'Admin'),
(16525, '/POS/table.orders.php', '::1', 1685701844, 'Admin'),
(16526, '/POS/table.orders.php', '::1', 1685701870, 'Admin'),
(16527, '/POS/table.orders.php', '::1', 1685701920, 'Admin'),
(16528, '/POS/bill.php', '::1', 1685701921, 'Admin'),
(16529, '/POS/table.orders.php', '::1', 1685701934, 'Admin'),
(16530, '/POS/table.orders.php', '::1', 1685702006, 'Admin'),
(16531, '/POS/table.orders.php', '::1', 1685702046, 'Admin'),
(16532, '/POS/pos.php', '::1', 1685702097, 'Admin'),
(16533, '/POS/pos.php', '::1', 1685702103, 'Admin'),
(16534, '/POS/pos.php', '::1', 1685702103, 'Admin'),
(16535, '/POS/pos.php', '::1', 1685702104, 'Admin'),
(16536, '/POS/pos.php', '::1', 1685702113, 'Admin'),
(16537, '/POS/print.php', '::1', 1685702114, 'Admin'),
(16538, '/POS/pos.php', '::1', 1685702119, 'Admin'),
(16539, '/POS/pos.php', '::1', 1685702120, 'Admin'),
(16540, '/POS/pos.php', '::1', 1685702121, 'Admin'),
(16541, '/POS/pos.php', '::1', 1685702121, 'Admin'),
(16542, '/POS/pos.php', '::1', 1685702121, 'Admin'),
(16543, '/POS/pos.php', '::1', 1685702263, 'Admin'),
(16544, '/POS/tables.php', '::1', 1685702266, 'Admin'),
(16545, '/POS/table.orders.php', '::1', 1685702267, 'Admin'),
(16546, '/POS/includes/tableordersdelete.php', '::1', 1685702582, 'Admin'),
(16547, '/POS/table.orders.php', '::1', 1685702582, 'Admin'),
(16548, '/POS/includes/tableordersdelete.php', '::1', 1685702584, 'Admin'),
(16549, '/POS/table.orders.php', '::1', 1685702584, 'Admin'),
(16550, '/POS/includes/tableordersdelete.php', '::1', 1685702586, 'Admin'),
(16551, '/POS/table.orders.php', '::1', 1685702586, 'Admin'),
(16552, '/POS/includes/tableordersdelete.php', '::1', 1685702587, 'Admin'),
(16553, '/POS/table.orders.php', '::1', 1685702588, 'Admin'),
(16554, '/POS/kotandbot.php', '::1', 1685702589, 'Admin'),
(16555, '/POS/table.orders.php', '::1', 1685702590, 'Admin'),
(16556, '/POS/kotandbot.php', '::1', 1685702593, 'Admin'),
(16557, '/POS/bot.print.php', '::1', 1685702593, 'Admin'),
(16558, '/POS/table.orders.php', '::1', 1685702598, 'Admin'),
(16559, '/POS/kotandbot.php', '::1', 1685702600, 'Admin'),
(16560, '/POS/table.orders.php', '::1', 1685702603, 'Admin'),
(16561, '/POS/kotandbot.php', '::1', 1685702613, 'Admin'),
(16562, '/POS/table.orders.php', '::1', 1685702615, 'Admin'),
(16563, '/POS/tables.php', '::1', 1685702617, 'Admin'),
(16564, '/POS/table.orders.php', '::1', 1685702618, 'Admin'),
(16565, '/POS/table.orders.php', '::1', 1685702627, 'Admin'),
(16566, '/POS/print.php', '::1', 1685702627, 'Admin'),
(16567, '/POS/pos.php', '::1', 1685702636, 'Admin'),
(16568, '/POS/tables.php', '::1', 1685702640, 'Admin'),
(16569, '/POS/table.orders.php', '::1', 1685702640, 'Admin'),
(16570, '/POS/table.orders.php', '::1', 1685702641, 'Admin'),
(16571, '/POS/tables.php', '::1', 1685702643, 'Admin'),
(16572, '/POS/table.orders.php', '::1', 1685702644, 'Admin'),
(16573, '/POS/table.orders.php', '::1', 1685702645, 'Admin'),
(16574, '/POS/tables.php', '::1', 1685702646, 'Admin'),
(16575, '/POS/index.php', '::1', 1685702649, 'Admin'),
(16576, '/POS/creditors.php', '::1', 1685702650, 'Admin'),
(16577, '/POS/creditorsReturns.php', '::1', 1685702655, 'Admin'),
(16578, '/POS/creditors.php', '::1', 1685702658, 'Admin'),
(16579, '/POS/creditorsReturns.php', '::1', 1685702667, 'Admin'),
(16580, '/POS/creditorsReturns.php', '::1', 1685702673, 'Admin'),
(16581, '/POS/creditors.php', '::1', 1685702673, 'Admin'),
(16582, '/POS/creditorsReturns.php', '::1', 1685702678, 'Admin'),
(16583, '/POS/creditorsReturns.php', '::1', 1685702684, 'Admin'),
(16584, '/POS/creditors.php', '::1', 1685702684, 'Admin'),
(16585, '/POS/creditorsReturns.php', '::1', 1685702688, 'Admin'),
(16586, '/POS/creditorsReturns.php', '::1', 1685702692, 'Admin'),
(16587, '/POS/creditors.php', '::1', 1685702692, 'Admin'),
(16588, '/POS/creditorsReturns.php', '::1', 1685702695, 'Admin'),
(16589, '/POS/creditorsReturns.php', '::1', 1685702698, 'Admin'),
(16590, '/POS/creditors.php', '::1', 1685702699, 'Admin'),
(16591, '/POS/creditors.php', '::1', 1685702703, 'Admin'),
(16592, '/POS/login.php', '::1', 1685702703, 'Unkwon'),
(16593, '/pos/index.php', '::1', 1685705075, 'Unkwon'),
(16594, '/pos/login.php', '::1', 1685705076, 'Unkwon'),
(16595, '/pos/login.php', '::1', 1685705082, 'Unkwon'),
(16596, '/pos/index.php', '::1', 1685705087, 'Admin'),
(16597, '/POS/profit.php', '::1', 1685705176, 'Admin'),
(16598, '/POS/pos.php', '::1', 1685705213, 'Admin'),
(16599, '/POS/pos.php', '::1', 1685705215, 'Admin'),
(16600, '/POS/pos.php', '::1', 1685705215, 'Admin'),
(16601, '/POS/pos.php', '::1', 1685705216, 'Admin'),
(16602, '/POS/pos.php', '::1', 1685705217, 'Admin'),
(16603, '/POS/pos.php', '::1', 1685705256, 'Admin'),
(16604, '/POS/pos.php', '::1', 1685705257, 'Admin'),
(16605, '/POS/pos.php', '::1', 1685705260, 'Admin'),
(16606, '/POS/pos.php', '::1', 1685705260, 'Admin'),
(16607, '/POS/pos.php', '::1', 1685705262, 'Admin'),
(16608, '/POS/pos.php', '::1', 1685705262, 'Admin'),
(16609, '/POS/pos.php', '::1', 1685705263, 'Admin'),
(16610, '/POS/pos.php', '::1', 1685705263, 'Admin'),
(16611, '/POS/cat.php', '::1', 1685705311, 'Admin'),
(16612, '/POS/cat.php', '::1', 1685705324, 'Admin'),
(16613, '/POS/cat.php', '::1', 1685705332, 'Admin'),
(16614, '/POS/cat.php', '::1', 1685705341, 'Admin'),
(16615, '/POS/cat.php', '::1', 1685705345, 'Admin'),
(16616, '/POS/cat.php', '::1', 1685705349, 'Admin'),
(16617, '/POS/cat.php', '::1', 1685705350, 'Admin'),
(16618, '/POS/index.php', '::1', 1685705368, 'Admin'),
(16619, '/POS/sales.php', '::1', 1685705394, 'Admin'),
(16620, '/POS/pos.php', '::1', 1685705424, 'Admin'),
(16621, '/POS/pos.php', '::1', 1685705431, 'Admin'),
(16622, '/POS/print.php', '::1', 1685705431, 'Admin'),
(16623, '/POS/pos.php', '::1', 1685705435, 'Admin'),
(16624, '/POS/index.php', '::1', 1685705438, 'Admin'),
(16625, '/POS/index.php', '::1', 1685705441, 'Admin'),
(16626, '/POS/sales.php', '::1', 1685705443, 'Admin'),
(16627, '/POS/sales.php', '::1', 1685705461, 'Admin'),
(16628, '/POS/print.php', '::1', 1685705588, 'Admin'),
(16629, '/POS/pos.php', '::1', 1685705592, 'Admin'),
(16630, '/POS/index.php', '::1', 1685705595, 'Admin'),
(16631, '/POS/sales.php', '::1', 1685705600, 'Admin'),
(16632, '/POS/drinks.php', '::1', 1685705613, 'Admin'),
(16633, '/POS/index.php', '127.0.0.1', 1686031234, 'Unkwon'),
(16634, '/POS/login.php', '127.0.0.1', 1686031234, 'Unkwon'),
(16635, '/POS/login.php', '127.0.0.1', 1686031244, 'Unkwon'),
(16636, '/POS/index.php', '127.0.0.1', 1686031247, 'Admin'),
(16637, '/POS/pos.php', '127.0.0.1', 1686031254, 'Admin'),
(16638, '/POS/pos.php', '127.0.0.1', 1686031255, 'Admin'),
(16639, '/POS/pos.php', '127.0.0.1', 1686031256, 'Admin'),
(16640, '/POS/pos.php', '127.0.0.1', 1686031269, 'Admin'),
(16641, '/POS/pos.php', '127.0.0.1', 1686031269, 'Admin'),
(16642, '/POS/drinks.php', '127.0.0.1', 1686031610, 'Admin'),
(16643, '/POS/purchase.php', '127.0.0.1', 1686031612, 'Admin'),
(16644, '/POS/pos.php', '127.0.0.1', 1686031719, 'Admin'),
(16645, '/POS/index.php', '127.0.0.1', 1686031721, 'Admin'),
(16646, '/POS/creditors.php', '127.0.0.1', 1686031727, 'Admin'),
(16647, '/POS/index.php', '127.0.0.1', 1686031731, 'Admin'),
(16648, '/POS/sales.php', '127.0.0.1', 1686031734, 'Admin'),
(16649, '/POS/sales.php', '127.0.0.1', 1686031864, 'Admin'),
(16650, '/POS/sales.php', '127.0.0.1', 1686031886, 'Admin'),
(16651, '/POS/drinks.php', '127.0.0.1', 1686031927, 'Admin'),
(16652, '/POS/purchase.php', '127.0.0.1', 1686031928, 'Admin'),
(16653, '/POS/purchase.php', '127.0.0.1', 1686031941, 'Admin'),
(16654, '/POS/drinks.php', '127.0.0.1', 1686033812, 'Admin'),
(16655, '/POS/store.php', '127.0.0.1', 1686033814, 'Admin'),
(16656, '/POS/drinks.php', '127.0.0.1', 1686037908, 'Admin'),
(16657, '/POS/purchase.php', '127.0.0.1', 1686037909, 'Admin'),
(16658, '/POS/purchase.php', '127.0.0.1', 1686037932, 'Admin'),
(16659, '/POS/purchase.php', '127.0.0.1', 1686038160, 'Admin'),
(16660, '/POS/purchase.php', '127.0.0.1', 1686038217, 'Admin'),
(16661, '/POS/purchase.php', '127.0.0.1', 1686038256, 'Admin'),
(16662, '/POS/purchase.php', '127.0.0.1', 1686038277, 'Admin'),
(16663, '/POS/drinks.php', '127.0.0.1', 1686038294, 'Admin'),
(16664, '/POS/purchase.php', '127.0.0.1', 1686038296, 'Admin'),
(16665, '/POS/drinks.php', '127.0.0.1', 1686038315, 'Admin'),
(16666, '/POS/store.php', '127.0.0.1', 1686038317, 'Admin'),
(16667, '/POS/purchase.php', '127.0.0.1', 1686038342, 'Admin'),
(16668, '/POS/purchase.php', '127.0.0.1', 1686038377, 'Admin'),
(16669, '/POS/purchase.php', '127.0.0.1', 1686038489, 'Admin'),
(16670, '/POS/purchase.php', '127.0.0.1', 1686039036, 'Admin'),
(16671, '/POS/purchase.php', '127.0.0.1', 1686039123, 'Admin'),
(16672, '/POS/purchase.php', '127.0.0.1', 1686039237, 'Admin'),
(16673, '/POS/purchase.php', '127.0.0.1', 1686039294, 'Admin'),
(16674, '/POS/purchase.php', '127.0.0.1', 1686039362, 'Admin'),
(16675, '/POS/purchase.php', '127.0.0.1', 1686039396, 'Admin'),
(16676, '/POS/purchase.php', '127.0.0.1', 1686039640, 'Admin'),
(16677, '/POS/purchase.php', '127.0.0.1', 1686039750, 'Admin'),
(16678, '/POS/purchase.php', '127.0.0.1', 1686039770, 'Admin'),
(16679, '/POS/purchase.php', '127.0.0.1', 1686039813, 'Admin'),
(16680, '/POS/purchase.php', '127.0.0.1', 1686039841, 'Admin'),
(16681, '/POS/index.php', '127.0.0.1', 1686039865, 'Admin'),
(16682, '/POS/sales.php', '127.0.0.1', 1686039867, 'Admin'),
(16683, '/POS/sales.php', '127.0.0.1', 1686039874, 'Admin'),
(16684, '/pos/index.php', '::1', 1686045235, 'Unkwon'),
(16685, '/pos/login.php', '::1', 1686045236, 'Unkwon'),
(16686, '/pos/login.php', '::1', 1686045240, 'Unkwon'),
(16687, '/pos/index.php', '::1', 1686045243, 'Admin'),
(16688, '/POS/sales.php', '::1', 1686045248, 'Admin'),
(16689, '/POS/sales.php', '::1', 1686045755, 'Admin'),
(16690, '/POS/drinks.php', '::1', 1686045977, 'Admin'),
(16691, '/POS/purchase.php', '::1', 1686045979, 'Admin'),
(16692, '/POS/drinks.php', '::1', 1686045981, 'Admin'),
(16693, '/POS/purchase.php', '::1', 1686045986, 'Admin'),
(16694, '/POS/purchase.php', '::1', 1686046093, 'Admin'),
(16695, '/POS/drinks.php', '::1', 1686046244, 'Admin'),
(16696, '/POS/store.php', '::1', 1686046246, 'Admin'),
(16697, '/POS/drinks.php', '::1', 1686046252, 'Admin'),
(16698, '/POS/purchase.php', '::1', 1686046435, 'Admin'),
(16699, '/POS/purchase.php', '::1', 1686046444, 'Admin'),
(16700, '/POS/drinks.php', '::1', 1686047646, 'Admin'),
(16701, '/POS/drinks.php', '::1', 1686047653, 'Admin'),
(16702, '/POS/purchase.php', '::1', 1686047654, 'Admin'),
(16703, '/pos/index.php', '::1', 1686296340, 'Unkwon'),
(16704, '/pos/login.php', '::1', 1686296341, 'Unkwon'),
(16705, '/pos/login.php', '::1', 1686296348, 'Unkwon'),
(16706, '/pos/index.php', '::1', 1686296350, 'Admin'),
(16707, '/POS/sales.php', '::1', 1686296352, 'Admin'),
(16708, '/POS/sales.php', '::1', 1686296365, 'Admin'),
(16709, '/POS/sales.php', '::1', 1686296419, 'Admin'),
(16710, '/POS/login.php', '::1', 1686296419, 'Unkwon'),
(16711, '/POS/login.php', '::1', 1686296422, 'Unkwon'),
(16712, '/POS/index.php', '::1', 1686296423, 'Admin'),
(16713, '/POS/sales.php', '::1', 1686296425, 'Admin'),
(16714, '/POS/sales.php', '::1', 1686296570, 'Admin'),
(16715, '/POS/sales.php', '::1', 1686296922, 'Admin'),
(16716, '/POS/sales.php', '::1', 1686297189, 'Admin'),
(16717, '/POS/sales.php', '::1', 1686297285, 'Admin'),
(16718, '/POS/sales.php', '::1', 1686297299, 'Admin'),
(16719, '/POS/sales.php', '::1', 1686297423, 'Admin'),
(16720, '/POS/sales.php', '::1', 1686297452, 'Admin'),
(16721, '/POS/sales.php', '::1', 1686297483, 'Admin'),
(16722, '/POS/sales.php', '::1', 1686297522, 'Admin'),
(16723, '/POS/sales.php', '::1', 1686297724, 'Admin'),
(16724, '/POS/sales.php', '::1', 1686297740, 'Admin'),
(16725, '/POS/sales.php', '::1', 1686297756, 'Admin'),
(16726, '/POS/sales.php', '::1', 1686297908, 'Admin'),
(16727, '/POS/drinks.php', '::1', 1686297928, 'Admin'),
(16728, '/POS/food.php', '::1', 1686297929, 'Admin'),
(16729, '/POS/drinks.php', '::1', 1686297931, 'Admin'),
(16730, '/POS/purchase.php', '::1', 1686297932, 'Admin'),
(16731, '/POS/purchase.php', '::1', 1686297950, 'Admin'),
(16732, '/POS/drinks.php', '::1', 1686298291, 'Admin'),
(16733, '/POS/purchase.php', '::1', 1686298292, 'Admin'),
(16734, '/POS/purchase.php', '::1', 1686298876, 'Admin'),
(16735, '/POS/purchase.php', '::1', 1686298917, 'Admin'),
(16736, '/POS/purchase.php', '::1', 1686299029, 'Admin'),
(16737, '/POS/purchase.php', '::1', 1686299043, 'Admin'),
(16738, '/POS/purchase.php', '::1', 1686299086, 'Admin'),
(16739, '/POS/drinks.php', '::1', 1686299089, 'Admin'),
(16740, '/POS/store.php', '::1', 1686299090, 'Admin'),
(16741, '/POS/drinks.php', '::1', 1686299129, 'Admin'),
(16742, '/POS/purchase.php', '::1', 1686299134, 'Admin'),
(16743, '/POS/purchase.php', '::1', 1686299240, 'Admin'),
(16744, '/POS/purchase.php', '::1', 1686299258, 'Admin'),
(16745, '/POS/drinks.php', '::1', 1686299282, 'Admin'),
(16746, '/POS/store.php', '::1', 1686299295, 'Admin'),
(16747, '/POS/drinks.php', '::1', 1686299297, 'Admin'),
(16748, '/POS/purchase.php', '::1', 1686299299, 'Admin'),
(16749, '/POS/drinks.php', '::1', 1686299315, 'Admin'),
(16750, '/POS/store.php', '::1', 1686299316, 'Admin'),
(16751, '/POS/drinks.php', '::1', 1686299325, 'Admin'),
(16752, '/POS/store.php', '::1', 1686299327, 'Admin'),
(16753, '/POS/drinks.php', '::1', 1686299330, 'Admin'),
(16754, '/POS/food.php', '::1', 1686299334, 'Admin'),
(16755, '/POS/cat.php', '::1', 1686299336, 'Admin'),
(16756, '/POS/cat.php', '::1', 1686299342, 'Admin'),
(16757, '/POS/login.php', '::1', 1686299342, 'Unkwon'),
(16758, '/pos/index.php', '::1', 1686301276, 'Unkwon'),
(16759, '/pos/login.php', '::1', 1686301277, 'Unkwon'),
(16760, '/pos/login.php', '::1', 1686301308, 'Unkwon'),
(16761, '/pos/index.php', '::1', 1686301313, 'Admin'),
(16762, '/POS/profit.php', '::1', 1686301336, 'Admin'),
(16763, '/POS/sales.php', '::1', 1686301337, 'Admin'),
(16764, '/POS/sales.php', '::1', 1686301412, 'Admin'),
(16765, '/POS/drinks.php', '::1', 1686301452, 'Admin'),
(16766, '/POS/store.php', '::1', 1686301461, 'Admin'),
(16767, '/POS/store.php', '::1', 1686301510, 'Admin'),
(16768, '/POS/drinks.php', '::1', 1686301534, 'Admin'),
(16769, '/pos/index.php', '::1', 1686301818, 'Unkwon'),
(16770, '/pos/login.php', '::1', 1686301819, 'Unkwon'),
(16771, '/pos/login.php', '::1', 1686301823, 'Unkwon'),
(16772, '/pos/index.php', '::1', 1686301826, 'Admin'),
(16773, '/POS/sales.php', '::1', 1686301830, 'Admin'),
(16774, '/POS/sales.php', '::1', 1686301958, 'Admin'),
(16775, '/POS/drinks.php', '::1', 1686301975, 'Admin'),
(16776, '/POS/store.php', '::1', 1686301977, 'Admin'),
(16777, '/POS/pos.php', '::1', 1686302014, 'Admin'),
(16778, '/POS/pos.php', '::1', 1686302027, 'Admin'),
(16779, '/POS/pos.php', '::1', 1686302027, 'Admin'),
(16780, '/POS/pos.php', '::1', 1686302028, 'Admin'),
(16781, '/POS/pos.php', '::1', 1686302028, 'Admin'),
(16782, '/POS/pos.php', '::1', 1686302036, 'Admin'),
(16783, '/POS/pos.php', '::1', 1686302037, 'Admin'),
(16784, '/POS/pos.php', '::1', 1686302069, 'Admin'),
(16785, '/POS/pos.php', '::1', 1686302069, 'Admin'),
(16786, '/POS/drinks.php', '::1', 1686302074, 'Admin'),
(16787, '/POS/purchase.php', '::1', 1686302076, 'Admin'),
(16788, '/POS/purchase.php', '::1', 1686302083, 'Admin'),
(16789, '/POS/purchase.php', '::1', 1686302133, 'Admin'),
(16790, '/POS/purchase.php', '::1', 1686302134, 'Admin'),
(16791, '/POS/drinks.php', '::1', 1686302162, 'Admin'),
(16792, '/POS/drinks.php', '::1', 1686302165, 'Admin');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_name`, `users_password`, `users_status`, `users_role`, `employeeID`, `users_deleted`) VALUES
(24, 'Admin', '$2y$10$tjD67GDVdwskk9qU5v9KeurZWcBdsyLy2gK/jBKnaNvtVc.uRiglu', 1, 1, 1701330109, 0);

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
  MODIFY `bot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `creditors`
--
ALTER TABLE `creditors`
  MODIFY `creditors_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=506;

--
-- AUTO_INCREMENT for table `foodmenu`
--
ALTER TABLE `foodmenu`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `kot`
--
ALTER TABLE `kot`
  MODIFY `kot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1378;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `products_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchases_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=764;

--
-- AUTO_INCREMENT for table `salesdetails`
--
ALTER TABLE `salesdetails`
  MODIFY `salesDetails_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1257;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `tableitems`
--
ALTER TABLE `tableitems`
  MODIFY `tableItems_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tracker`
--
ALTER TABLE `tracker`
  MODIFY `tracker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16793;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
