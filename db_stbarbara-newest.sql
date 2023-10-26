-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2023 at 08:42 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_stbarbara`
--
CREATE DATABASE IF NOT EXISTS `db_stbarbara` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_stbarbara`;

-- --------------------------------------------------------

--
-- Table structure for table `additional`
--

CREATE TABLE `additional` (
  `additional_id` int(10) UNSIGNED NOT NULL,
  `payroll_id` int(10) UNSIGNED NOT NULL,
  `additional_type_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `note` varchar(500) DEFAULT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `additional`
--

INSERT INTO `additional` (`additional_id`, `payroll_id`, `additional_type_id`, `date`, `amount`, `note`, `status_id`) VALUES
(1, 3, 2, '2021-06-30', '500.00', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `additional_type`
--

CREATE TABLE `additional_type` (
  `additional_type_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `additional_type`
--

INSERT INTO `additional_type` (`additional_type_id`, `name`) VALUES
(1, 'Bonus'),
(2, 'Overtime'),
(3, 'Referral Fee'),
(4, 'Others'),
(5, 'Override Cash'),
(6, 'Cash Advance'),
(7, 'Holidays');

-- --------------------------------------------------------

--
-- Table structure for table `amenity_house`
--

CREATE TABLE `amenity_house` (
  `amenity_house_id` int(11) NOT NULL,
  `amenity_type_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `amenity_project`
--

CREATE TABLE `amenity_project` (
  `amenity_project_id` int(11) NOT NULL,
  `amenity_type_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `amenity_type`
--

CREATE TABLE `amenity_type` (
  `amenity_type_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cash_advance`
--

CREATE TABLE `cash_advance` (
  `cash_advance_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `note` text,
  `staff_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cash_advance`
--

INSERT INTO `cash_advance` (`cash_advance_id`, `date`, `amount`, `note`, `staff_id`, `status_id`) VALUES
(2, '2021-05-21', '1000.00', 'test', 1, 1),
(3, '2021-05-24', '144.00', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `middle_name` varchar(45) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` varchar(45) DEFAULT NULL,
  `civil_status` varchar(45) DEFAULT NULL,
  `religion` varchar(45) DEFAULT NULL,
  `nationality` varchar(45) DEFAULT NULL,
  `height` varchar(45) DEFAULT NULL,
  `weight` varchar(45) DEFAULT NULL,
  `blood_type` varchar(45) DEFAULT NULL,
  `occupation` varchar(45) DEFAULT NULL,
  `id_name` varchar(45) DEFAULT NULL,
  `id_no` varchar(45) DEFAULT NULL,
  `id_registration_date` date DEFAULT NULL,
  `id_valid_until` date DEFAULT NULL,
  `id_place` varchar(45) DEFAULT NULL,
  `sss` varchar(45) DEFAULT NULL,
  `pagibig` varchar(45) DEFAULT NULL,
  `tin` varchar(45) DEFAULT NULL,
  `drivers_license` varchar(45) DEFAULT NULL,
  `residence_address` text,
  `provincial_address` text,
  `landline_no` varchar(45) DEFAULT NULL,
  `cellphone_no` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `last_name`, `first_name`, `middle_name`, `full_name`, `gender`, `birth_date`, `birth_place`, `civil_status`, `religion`, `nationality`, `height`, `weight`, `blood_type`, `occupation`, `id_name`, `id_no`, `id_registration_date`, `id_valid_until`, `id_place`, `sss`, `pagibig`, `tin`, `drivers_license`, `residence_address`, `provincial_address`, `landline_no`, `cellphone_no`, `email`, `status_id`) VALUES
(1, 'jerezon', 'mark', 'ancero', NULL, '1', '2021-05-22', 'cebu city', 'Single', '', '', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '', '', '', '', 'te', 'te', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deduction`
--

CREATE TABLE `deduction` (
  `deduction_id` int(10) UNSIGNED NOT NULL,
  `payroll_id` int(10) UNSIGNED NOT NULL,
  `deduction_type_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` decimal(18,2) UNSIGNED NOT NULL,
  `note` varchar(500) DEFAULT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deduction`
--

INSERT INTO `deduction` (`deduction_id`, `payroll_id`, `deduction_type_id`, `date`, `amount`, `note`, `status_id`) VALUES
(1, 3, 13, '2021-05-21', '300.00', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `deduction_type`
--

CREATE TABLE `deduction_type` (
  `deduction_type_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deduction_type`
--

INSERT INTO `deduction_type` (`deduction_type_id`, `name`) VALUES
(1, 'COLA'),
(2, 'Tax'),
(3, 'Pag-Ibig'),
(4, 'SSS'),
(5, 'PhilHealth'),
(6, 'GSIS'),
(7, 'Late/Absences'),
(8, 'Others'),
(9, 'Capital Gain Tax'),
(10, 'State Tax'),
(11, 'Withholding Tax'),
(12, 'Transfer'),
(13, 'Cash Advance');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` int(11) NOT NULL,
  `expense_name` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `or_no` varchar(45) DEFAULT NULL,
  `total` decimal(18,2) NOT NULL DEFAULT '0.00',
  `note` text,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `expense_category_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE `expense_category` (
  `expense_category_id` int(11) NOT NULL,
  `category_name` varchar(45) DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_category`
--

INSERT INTO `expense_category` (`expense_category_id`, `category_name`, `status_id`) VALUES
(1, 'Construction Materials', 1),
(2, 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `expense_item`
--

CREATE TABLE `expense_item` (
  `expense_item_id` int(11) NOT NULL,
  `item_name` varchar(45) DEFAULT NULL,
  `unit_price` decimal(18,2) DEFAULT NULL,
  `qty` decimal(18,2) DEFAULT NULL,
  `unit` varchar(45) DEFAULT NULL,
  `total` decimal(18,2) DEFAULT NULL,
  `expense_id` int(11) NOT NULL,
  `expense_category_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE `house` (
  `house_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lot_area` decimal(18,2) NOT NULL,
  `floor_area` decimal(18,2) NOT NULL,
  `suggested_price` decimal(18,2) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`house_id`, `name`, `lot_area`, `floor_area`, `suggested_price`, `status_id`) VALUES
(1, 'Hello Kitty', '100.00', '80.00', '5000000.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `house_on_project`
--

CREATE TABLE `house_on_project` (
  `house_on_project_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL,
  `price` decimal(18,2) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `material_id` int(11) NOT NULL,
  `particular` varchar(100) NOT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `no_of_stocks` int(11) NOT NULL DEFAULT '0',
  `last_stock_date` date DEFAULT NULL,
  `stock_level` int(2) NOT NULL DEFAULT '10',
  `material_category_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`material_id`, `particular`, `unit`, `no_of_stocks`, `last_stock_date`, `stock_level`, `material_category_id`, `status_id`) VALUES
(1, 'COCO LUMBER', 'PCS', 50, NULL, 10, 1, 1),
(3, 'boysen-white', 'pcs', 0, NULL, 10, 2, 1),
(4, 'electrical tape', 'pcs', 0, NULL, 10, 1, 1),
(21, 'concrete nail', 'kg', 25, NULL, 10, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `material_category`
--

CREATE TABLE `material_category` (
  `material_category_id` int(11) NOT NULL,
  `particular` varchar(100) NOT NULL,
  `priority_level` int(5) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_category`
--

INSERT INTO `material_category` (`material_category_id`, `particular`, `priority_level`, `status_id`) VALUES
(1, 'electrical materials', 0, 1),
(2, 'paints', 0, 1),
(3, 'painting materials', 0, 1),
(4, 'nails', 0, 1),
(5, 'screw', 0, 1),
(6, 'kitchen sink', 0, 1),
(7, 'bathroom', 0, 1),
(8, 'door', 0, 1),
(9, 'tiles', 0, 1),
(10, 'woods', 0, 1),
(11, 'masonry/concreting', 0, 1),
(12, 'ceiling & drywall partition', 0, 1),
(13, 'metal/steel materials', 0, 1),
(14, 'roofing materials', 0, 1),
(15, 'plumbing/sanitary materials', 0, 1),
(16, 'other materials', 0, 1),
(17, 'ceiling & drywall partitions', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `material_issuance`
--

CREATE TABLE `material_issuance` (
  `material_issuance_id` int(11) NOT NULL,
  `material_issuance_no` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `scope_of_work` varchar(150) DEFAULT NULL,
  `prepared_by` int(11) NOT NULL,
  `received_by` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `miscellaneous`
--

CREATE TABLE `miscellaneous` (
  `miscellaneous_id` int(11) NOT NULL,
  `miscellaneous_type_id` int(11) NOT NULL,
  `price` decimal(18,2) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `miscellaneous_type`
--

CREATE TABLE `miscellaneous_type` (
  `miscellaneous_type_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `suggested_price` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `payroll_id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT '0',
  `paydate` date NOT NULL,
  `daily_compensation` decimal(18,2) NOT NULL,
  `no_of_days` decimal(18,2) NOT NULL,
  `basepay` decimal(18,2) NOT NULL,
  `net_pay` decimal(18,2) NOT NULL,
  `total_additionals` decimal(18,2) DEFAULT '0.00',
  `total_deductions` decimal(18,2) DEFAULT '0.00',
  `note` varchar(100) DEFAULT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payroll_id`, `staff_id`, `project_id`, `paydate`, `daily_compensation`, `no_of_days`, `basepay`, `net_pay`, `total_additionals`, `total_deductions`, `note`, `status_id`) VALUES
(1, 1, 1, '2021-05-10', '500.00', '12.00', '6000.00', '6000.00', '0.00', '0.00', NULL, 2),
(2, 9, 0, '2021-05-10', '0.00', '12.00', '0.00', '0.00', '0.00', '0.00', NULL, 1),
(3, 1, 1, '2021-05-17', '500.00', '12.00', '6000.00', '6200.00', '500.00', '300.00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `person_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) DEFAULT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `first_name`, `last_name`, `middle_name`, `status_id`) VALUES
(1, 'juan', 'dela cruz', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `person_contact`
--

CREATE TABLE `person_contact` (
  `person_contact_id` int(11) NOT NULL,
  `residence_address` varchar(150) NOT NULL,
  `provincial_address` varchar(150) DEFAULT NULL,
  `landline_no` varchar(50) DEFAULT NULL,
  `mobile_no` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `person_detail`
--

CREATE TABLE `person_detail` (
  `person_detail_id` int(11) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` varchar(50) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `weight` varchar(10) DEFAULT NULL,
  `blood_type` varchar(10) DEFAULT NULL,
  `religion` varchar(20) DEFAULT NULL,
  `civil_status` varchar(20) DEFAULT NULL,
  `sss` varchar(20) DEFAULT NULL,
  `pagibig` varchar(20) DEFAULT NULL,
  `tin` varchar(20) DEFAULT NULL,
  `drivers_license` varchar(20) DEFAULT NULL,
  `start_of_contract` date DEFAULT NULL,
  `end_of_contract` date DEFAULT NULL,
  `daily_compensation` decimal(18,2) DEFAULT NULL,
  `daily_cola` decimal(18,2) DEFAULT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `total_area` decimal(18,2) NOT NULL,
  `total_units` decimal(18,2) NOT NULL,
  `location` varchar(100) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `name`, `total_area`, `total_units`, `location`, `status_id`) VALUES
(1, 'Project A', '10000.00', '25.00', 'talisay city, cebu', 1),
(2, 'ADS', '10000.00', '99.00', 'cebu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `purchase_order_id` int(11) NOT NULL,
  `purchase_order_no` int(11) DEFAULT NULL,
  `invoice_no` varchar(50) DEFAULT NULL,
  `invoice_img` varchar(100) DEFAULT NULL,
  `additional_fee` decimal(18,2) NOT NULL DEFAULT '0.00',
  `grand_total` decimal(18,2) NOT NULL DEFAULT '0.00',
  `requested_by` int(11) NOT NULL,
  `requested_date` date NOT NULL,
  `prepared_by` int(11) NOT NULL,
  `prepared_date` date NOT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `approved_date` date DEFAULT NULL,
  `user_note` varchar(200) DEFAULT NULL,
  `deletion_note` varchar(200) DEFAULT NULL,
  `admin_note` varchar(200) DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`purchase_order_id`, `purchase_order_no`, `invoice_no`, `invoice_img`, `additional_fee`, `grand_total`, `requested_by`, `requested_date`, `prepared_by`, `prepared_date`, `approved_by`, `approved_date`, `user_note`, `deletion_note`, `admin_note`, `warehouse_id`, `supplier_id`, `status_id`) VALUES
(1, 1910001, NULL, NULL, '0.00', '0.00', 2, '2019-09-30', 1, '2019-09-30', 1, '2019-09-30', '', NULL, NULL, 1, 1, 6),
(2, 2105002, NULL, NULL, '0.00', '0.00', 3, '2021-05-08', 1, '2021-05-08', NULL, NULL, '', NULL, NULL, 1, 1, 9),
(3, 2105003, NULL, NULL, '0.00', '0.00', 3, '2021-05-14', 1, '2021-05-14', NULL, NULL, 'test', NULL, NULL, 1, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_item`
--

CREATE TABLE `purchase_order_item` (
  `purchase_order_item_id` int(11) NOT NULL,
  `purchase_order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `unit_price` decimal(18,2) NOT NULL,
  `total` decimal(18,2) DEFAULT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order_item`
--

INSERT INTO `purchase_order_item` (`purchase_order_item_id`, `purchase_order_id`, `quantity`, `description`, `unit_price`, `total`, `status_id`) VALUES
(1, 1, 50, 'coco lumber', '80.00', '4000.00', 5),
(2, 2, 50, 'coco lumber', '78.00', '3900.00', 5),
(3, 1, 50, 'coco lumber', '75.00', '3750.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `spouse`
--

CREATE TABLE `spouse` (
  `spouse_id` int(11) NOT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `middle_name` varchar(45) DEFAULT NULL,
  `full_name` varchar(45) DEFAULT NULL,
  `birth_date` varchar(45) DEFAULT NULL,
  `birth_place` varchar(45) DEFAULT NULL,
  `occupation` varchar(45) DEFAULT NULL,
  `nationality` varchar(45) DEFAULT NULL,
  `sss` varchar(45) DEFAULT NULL,
  `tin` varchar(45) DEFAULT NULL,
  `pagibig` varchar(45) DEFAULT NULL,
  `drivers_license` varchar(45) DEFAULT NULL,
  `spouse_id_name` varchar(45) DEFAULT NULL,
  `spouse_id_no` varchar(45) DEFAULT NULL,
  `spouse_id_date_issued` varchar(45) DEFAULT NULL,
  `spouse_id_place_issued` varchar(45) DEFAULT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `full_name` varchar(40) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `employee_id` varchar(20) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `daily_compensation` decimal(18,2) DEFAULT NULL,
  `daily_cola` decimal(18,2) DEFAULT NULL,
  `job_description` varchar(50) DEFAULT NULL,
  `sss` varchar(20) DEFAULT NULL,
  `pagibig` varchar(20) DEFAULT NULL,
  `tin` varchar(20) DEFAULT NULL,
  `project_id` int(11) DEFAULT '0',
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `first_name`, `last_name`, `full_name`, `address`, `contact_no`, `gender`, `birth_date`, `employee_id`, `start_date`, `daily_compensation`, `daily_cola`, `job_description`, `sss`, `pagibig`, `tin`, `project_id`, `status_id`) VALUES
(1, 'mark daryl', 'jerezon', 'mark daryl jerezon', '', '', '', '0000-00-00', NULL, '0000-00-00', '500.00', NULL, 'Systems Administrator', '', '', '', 1, 1),
(9, 'test', 'test', 'test test', '', '', '1', '0000-00-00', NULL, '2021-05-08', '0.00', '0.00', '', '', '', '', 0, 1),
(10, '12', '12', '12 12', '', '', '1', '0000-00-00', NULL, '2021-05-11', '0.00', '0.00', '', '', '', '', 0, 1),
(11, 'test1', 'test1', 'test1 test1', '', '', '1', '0000-00-00', NULL, '2021-05-24', '0.00', '0.00', '', '', '', '', 0, 1),
(12, 'test2', 'test2', 'test2 test2', '', '', '1', '0000-00-00', NULL, '2021-05-24', '0.00', '0.00', '', '', '', '', 0, 1),
(13, 'test3', 'test3', 'test3 test3', '', '', '1', '0000-00-00', NULL, '2021-05-24', '0.00', '0.00', '', '', '', '', 0, 1),
(14, 'test4', 'test4', 'test4 test4', '', '', '1', '0000-00-00', NULL, '2021-05-24', '0.00', '0.00', '', '', '', '', 0, 1),
(15, 'test5', 'test5', 'test5 test5', '', '', '1', '0000-00-00', NULL, '2021-05-24', '0.00', '0.00', '', '', '', '', 0, 1),
(16, 'test6', 'test6', 'test6 test6', '', '', '1', '0000-00-00', NULL, '2021-05-24', '0.00', '0.00', '', '', '', '', 0, 1),
(17, 'test7', 'test7', 'test7 test7', '', '', '1', '0000-00-00', NULL, '2021-05-24', '0.00', '0.00', '', '', '', '', 0, 2),
(18, 'test8', 'test8', 'test8 test8', '', '', '1', '0000-00-00', NULL, '2021-05-24', '0.00', '0.00', '', '', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `color` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `name`, `color`) VALUES
(1, 'Active', '#28a745 !important'),
(2, 'Inactive', '#dc3545 !important'),
(3, 'Activated', '#28a745 !important'),
(4, 'Deactivated', '#dc3545 !important'),
(5, 'Void', '#dc3545 !important'),
(6, 'Approved', '#28a745 !important'),
(7, 'Disapproved', '#dc3545 !important'),
(8, 'Pending', '#ffc107 !important'),
(9, 'For approval', '#ffc107 !important'),
(10, 'For deletion', '#dc3545 !important');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `stock_in_id` int(11) DEFAULT NULL,
  `stock_out_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `remarks` varchar(150) DEFAULT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `stock_in_id`, `stock_out_id`, `date`, `quantity`, `warehouse_id`, `remarks`, `status_id`) VALUES
(4, 21, NULL, '2019-09-09', 21, 1, 'cfd', 1),
(7, 21, NULL, '2019-09-09', 4, 1, 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `name`, `description`, `address`, `contact_no`, `status_id`) VALUES
(1, 'ABC Enterprises', '', 'Talisay City, Cebu', '462-5340', 1),
(2, 'test', 'test', 'test test', '', 1),
(3, 'test', 'test', 'test test', '', 1),
(4, 'test', 'test', 'test test', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `full_name` varchar(40) DEFAULT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `user_modules` text,
  `user_type_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `full_name`, `user_name`, `password`, `user_modules`, `user_type_id`, `status_id`) VALUES
(1, 'marco', 'jerezon', 'marco jerezon', 'marco', '12345678', '65,66,69,71,63,64,1,2,3,41,44,45,46,47,61,51,52,53,54,55,56,57,58,62,67,68,72,73,74,31,32,33,35,36,39,4,5,6,40,59,60,7,8,9,10,11,37,38,43,48,49,50,70,75,12,13,14,42,15,16,17,18,19,20,21,34,22,24,25,26,27,28,29,30,76', 1, 1),
(2, 'john', 'doe', 'john doe', 'johndoe', 'password', '9,10', 4, 1),
(3, 'junhnel', 'bastida', 'junhnel bastida', 'jbastida', 'password', '9,10,12,13,14,7,8', 4, 1),
(4, 'Kendy', 'Peros', 'Kendy Peros', 'kendy', 'password', '52,53,54,48,49,50', 5, 1),
(5, 'Archie', 'Nishimura', 'Archie Nishimura', 'archie', 'password', '1,2,3,41,44,45,46,47,61,51,52,53,54,55,56,57,58,31,32,33,35,36,39,4,5,6,40,59,60,7,8,9,10,11,37,38,43,48,49,50,12,13,14,42,18,19,20,21,34,22,24,25,26,27,28,29,30,62', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_module`
--

CREATE TABLE `user_module` (
  `user_module_id` int(11) NOT NULL,
  `user_module_name` varchar(50) NOT NULL,
  `user_module_link` varchar(500) NOT NULL,
  `user_module_description` varchar(200) DEFAULT NULL,
  `user_module_category_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_module`
--

INSERT INTO `user_module` (`user_module_id`, `user_module_name`, `user_module_link`, `user_module_description`, `user_module_category_id`, `status_id`) VALUES
(1, '1. List', 'house/list_view,house/list_ss', '', 2, 1),
(2, '1.1. Create', 'house/create_view,house/create', '', 2, 1),
(3, '1.2. Update', 'house/update_view,house/update', '', 2, 1),
(4, '1. List', 'project/list_view,project/list', '', 3, 1),
(5, '1.1. Create', 'project/create_view,project/create', '', 3, 1),
(6, '1.3. Update', 'project/update_view,project/update', '', 3, 1),
(7, 'Approval List', 'purchaseorder/purchase_order_view,purchaseorder/approval_purchase_orders', '', 7, 1),
(8, 'Approved List', 'purchaseorder/purchase_order_view,purchaseorder/approved_purchase_orders', '', 7, 1),
(9, 'Create', 'purchaseorder/create_purchase_order_view,purchaseorder/create_purchase_order,purchaseorder/create_purchase_order_item_view,purchaseorder/create_purchase_order_item,supplier/list,purchaseorder/active_warehouses,purchaseorder/active_suppliers,purchaseorder/active_staffs', '', 7, 1),
(10, 'View', 'purchaseorder/get_purchase_order_view,purchaseorder/get_purchase_order,purchaseorder/purchase_order_item_view,purchaseorder/purchase_order_items,purchaseorder/delete_purchase_order_item', '', 7, 1),
(11, 'Update', 'purchaseorder/update_purchase_order_view,purchaseorder/update_purchase_order,purchaseorder/update_purchase_order_item_view,purchaseorder/update_purchase_order_item', '', 7, 1),
(12, 'List', 'supplier/list_view,supplier/list_ss', '', 5, 1),
(13, 'Create', 'supplier/create_view,supplier/create', '', 5, 1),
(14, 'Update', 'supplier/update_view,supplier/update,supplier/get', '', 5, 1),
(15, 'List', 'usermodulecategory/list_view,usermodulecategory/list,usermodule/list_view,usermodule/list', '', 6, 1),
(16, 'Create', 'usermodulecategory/create_view,usermodulecategory/create,usermodule/create_view,usermodule/create', '', 6, 1),
(17, 'Update', 'usermodulecategory/update_view,usermodulecategory/update,usermodule/update_view,usermodule/update', '', 6, 1),
(18, 'List', 'account/users,account/list_of_active_users', '', 1, 1),
(19, 'View', 'account/get_user_view', '', 1, 1),
(20, 'Create', 'account/create_user_view,account/create_user_process,account/list_of_user_types', '', 1, 1),
(21, 'Update', 'account/update_user_view,account/update_user_process', '', 1, 1),
(22, 'Warehouse List', 'warehouse/list_view,warehouse/list_ss', '', 4, 1),
(24, 'Warehouse Create', 'warehouse/create_view,warehouse/create', '', 4, 1),
(25, 'Warehouse Update', 'warehouse/update_view,warehouse/update', '', 4, 1),
(26, 'View all stocks', 'stock/list_view,stock/list,stock/all', '', 4, 1),
(27, 'View stock in', 'stock/list_view,stock/list,stock/in', '', 4, 1),
(28, 'View stock out', 'stock/list_view,stock/list,stock/out', '', 4, 1),
(29, 'Create Stock-in', 'stock/create_stock_in_view,stock/create_stock_in', '', 4, 1),
(30, 'Create Stock-out', 'stock/create_stock_out_view,stock/create_stock_out', '', 4, 1),
(31, '1. List', 'position/list_view,position/list', '', 8, 1),
(32, '1.1. Create', 'position/create_view,position/create', '', 8, 1),
(33, '1.2. Update', 'position/update_view,position/update', '', 8, 1),
(34, 'Modify Permissions', 'usermodule/assign_user_module_view,usermodule/get_assigned_user_modules,usermodule/assign_user_modules', 'Allowed to modify user\'s permissions', 1, 1),
(35, '1.4. View', 'position/view', '', 8, 1),
(36, '1.4.1. Modify Permissions', 'position/update_permissions_view,position/get_permissions,position/update_permissions', '', 8, 1),
(37, 'Print', 'purchaseorder/print', '', 7, 1),
(38, 'PO Approval', 'purchaseorder/approval_purchase_order_view,purchaseorder/approval_purchase_order', '', 7, 1),
(39, '1.3. Delete', 'position/delete', 'Deletion but users are not affected.', 8, 1),
(40, '1.4. Delete', 'project/delete', '', 3, 1),
(41, '1.3. Delete', 'house/delete', '', 2, 1),
(42, 'Delete', 'supplier/delete', '', 5, 1),
(43, 'PO Approved', 'purchaseorder/approved_purchase_order_view,purchaseorder/approved_purchase_order', '', 7, 1),
(44, '1. List', 'material/list_view,material/list_ss', '', 9, 1),
(45, '1.1. Create', 'material/create_view,material/create', '', 9, 1),
(46, '1.2. Update', 'material/update_view,material/update', '', 9, 1),
(47, 'View', 'material/view', '', 9, 1),
(48, 'List', 'staff/list_view,staff/list,staff/index', '', 10, 1),
(49, 'Create', 'staff/create_view,staff/create_staff_process', '', 10, 1),
(50, 'View', 'staff/view', '', 10, 1),
(51, '3. Create', 'payroll/create_view,payroll/create_payroll_process', '', 11, 1),
(52, '1. List', 'payroll/list_view,payroll/list_staff,payroll/index', '', 11, 1),
(53, '2. View', 'payroll/payroll_list_view,payroll/list,payroll/cash_advance_list', '', 11, 1),
(54, '4. View payroll details', 'payroll/payroll_details_view,payroll/get_payroll_additionals,payroll/get_payroll_deductions', '', 11, 1),
(55, '4.2. Create additional in payroll', 'payroll/create_addition_view,payroll/create_payroll_additional_process', '', 11, 1),
(56, '4.3. Create deduction in payroll', 'payroll/create_deduction_view,payroll/create_payroll_deduction_process', '', 11, 1),
(57, '4.4. Delete additional in payroll', 'payroll/delete_payroll_additional_process', '', 11, 1),
(58, '4.5. Delete deduction in payroll', 'payroll/delete_payroll_deduction_process', '', 11, 1),
(59, '1.2. View Project', 'project/project_view,project/get_staff_in_project', '', 3, 1),
(60, '1.2.1 Add Staff in a Project', 'staff/search,project/create_staff_in_project_view,project/create_staff_in_project_process', '', 3, 1),
(61, '1.3 Delete', 'material/delete', '', 9, 1),
(62, '4.1. Print Payslip', 'payroll/print', '', 11, 1),
(63, '1. List', 'expense/list_view,expense/index', '', 12, 1),
(64, '2. View', 'expense/list_view,expense/list', '', 12, 1),
(65, 'List', 'client/list_view,client/list_ss,client/index', '', 13, 1),
(66, 'Create', 'client/create_view,client/create_process', '', 13, 1),
(67, 'Delete Payroll', 'payroll/delete', '', 11, 1),
(68, 'Update Payroll', 'payroll/update_view,payroll/update_process', '', 11, 1),
(69, 'Delete', 'client/delete', '', 13, 1),
(70, 'update', 'staff/update_view,staff/update_staff_process', '', 10, 1),
(71, 'View', 'client/view', '', 13, 1),
(72, 'Create Cash Advance', 'payroll/create_cash_advance_view,payroll/create_cash_advance_process', '', 11, 1),
(73, 'Cash Advance List', 'payroll/cash_advance_list', '', 11, 1),
(74, 'Delete Cash Advance', 'payroll/delete_cash_advance', '', 11, 1),
(75, 'Delete', 'staff/delete', '', 10, 1),
(76, 'Delete Warehouse', 'warehouse/delete', '', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_module_category`
--

CREATE TABLE `user_module_category` (
  `user_module_category_id` int(11) NOT NULL,
  `user_module_category_name` varchar(20) NOT NULL,
  `module_count` int(11) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_module_category`
--

INSERT INTO `user_module_category` (`user_module_category_id`, `user_module_category_name`, `module_count`, `status_id`) VALUES
(1, 'users', 5, 1),
(2, 'house', 4, 1),
(3, 'projects', 6, 1),
(4, 'warehouse', 9, 1),
(5, 'supplier', 4, 1),
(6, 'user modules', 3, 1),
(7, 'purchase orders', 8, 1),
(8, 'positions', 6, 1),
(9, 'materials', 5, 1),
(10, 'staffs', 5, 1),
(11, 'payroll', 14, 1),
(12, 'Expenses', 2, 1),
(13, 'clients', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `default_user_modules` text NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `name`, `default_user_modules`, `status_id`) VALUES
(1, 'superuser', '65,66,69,71,63,64,1,2,3,41,44,45,46,47,61,51,52,53,54,55,56,57,58,62,67,68,72,73,74,31,32,33,35,36,39,4,5,6,40,59,60,7,8,9,10,11,37,38,43,48,49,50,70,75,12,13,14,42,15,16,17,18,19,20,21,34,22,24,25,26,27,28,29,30,76', 1),
(2, 'administrator', '1,2,3,41,44,45,46,47,61,51,52,53,54,55,56,57,58,31,32,33,35,36,39,4,5,6,40,59,60,7,8,9,10,11,37,38,2', 1),
(3, 'Production', '1,2,3,31,32,33,4,5,6', 1),
(4, 'Purchaser', '9,10,12,13,14', 1),
(5, 'Human Resource', '52,53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `warehouse_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `location` varchar(20) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`warehouse_id`, `name`, `location`, `contact_no`, `status_id`) VALUES
(1, 'W001', 'talisay', '0091029321', 1),
(2, 'W002', 'cebu', '12312312', 2),
(3, 'W003', 'Mingnilla', '12345677', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional`
--
ALTER TABLE `additional`
  ADD PRIMARY KEY (`additional_id`),
  ADD KEY `fk_additional_additional_type1_idx` (`additional_type_id`),
  ADD KEY `fk_additional_payroll1_idx` (`payroll_id`),
  ADD KEY `fk_additional_status1_idx` (`status_id`);

--
-- Indexes for table `additional_type`
--
ALTER TABLE `additional_type`
  ADD PRIMARY KEY (`additional_type_id`);

--
-- Indexes for table `amenity_house`
--
ALTER TABLE `amenity_house`
  ADD PRIMARY KEY (`amenity_house_id`),
  ADD KEY `amenity_type_id` (`amenity_type_id`),
  ADD KEY `house_id` (`house_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `amenity_project`
--
ALTER TABLE `amenity_project`
  ADD PRIMARY KEY (`amenity_project_id`),
  ADD KEY `amenity_type_id` (`amenity_type_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `fk_status_id_idx` (`status_id`);

--
-- Indexes for table `amenity_type`
--
ALTER TABLE `amenity_type`
  ADD PRIMARY KEY (`amenity_type_id`);

--
-- Indexes for table `cash_advance`
--
ALTER TABLE `cash_advance`
  ADD PRIMARY KEY (`cash_advance_id`),
  ADD KEY `fk_cash_advance_staff1_idx` (`staff_id`),
  ADD KEY `fk_cash_advance_status1_idx` (`status_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`),
  ADD KEY `fk_client_status1_idx` (`status_id`);

--
-- Indexes for table `deduction`
--
ALTER TABLE `deduction`
  ADD PRIMARY KEY (`deduction_id`),
  ADD KEY `fk_deduction_deduction_type1_idx` (`deduction_type_id`),
  ADD KEY `fk_deduction_status1_idx` (`status_id`),
  ADD KEY `fk_deduction_payroll1_idx` (`payroll_id`);

--
-- Indexes for table `deduction_type`
--
ALTER TABLE `deduction_type`
  ADD PRIMARY KEY (`deduction_type_id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`,`total`),
  ADD KEY `fk_expense_status1_idx` (`status_id`),
  ADD KEY `fk_expense_project1_idx` (`project_id`),
  ADD KEY `fk_expense_user1_idx` (`user_id`),
  ADD KEY `fk_expense_expense_category1_idx` (`expense_category_id`);

--
-- Indexes for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD PRIMARY KEY (`expense_category_id`),
  ADD KEY `fk_expense_category_status1_idx` (`status_id`);

--
-- Indexes for table `expense_item`
--
ALTER TABLE `expense_item`
  ADD PRIMARY KEY (`expense_item_id`),
  ADD KEY `fk_expense_item_expense1_idx` (`expense_id`),
  ADD KEY `fk_expense_item_status1_idx` (`status_id`),
  ADD KEY `fk_expense_item_expense_category1_idx` (`expense_category_id`);

--
-- Indexes for table `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`house_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `house_on_project`
--
ALTER TABLE `house_on_project`
  ADD PRIMARY KEY (`house_on_project_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `house_id` (`house_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `material_category_id` (`material_category_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `material_category`
--
ALTER TABLE `material_category`
  ADD PRIMARY KEY (`material_category_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `material_issuance`
--
ALTER TABLE `material_issuance`
  ADD PRIMARY KEY (`material_issuance_id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `prepared_by` (`prepared_by`),
  ADD KEY `received_by` (`received_by`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `miscellaneous`
--
ALTER TABLE `miscellaneous`
  ADD PRIMARY KEY (`miscellaneous_id`),
  ADD KEY `miscellaneous_type_id` (`miscellaneous_type_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `miscellaneous_type`
--
ALTER TABLE `miscellaneous_type`
  ADD PRIMARY KEY (`miscellaneous_type_id`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`payroll_id`),
  ADD KEY `fk_payroll_staff1_idx` (`staff_id`),
  ADD KEY `fk_payroll_status1_idx` (`status_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `person_contact`
--
ALTER TABLE `person_contact`
  ADD PRIMARY KEY (`person_contact_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `person_detail`
--
ALTER TABLE `person_detail`
  ADD PRIMARY KEY (`person_detail_id`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`purchase_order_id`),
  ADD KEY `requested_by` (`requested_by`),
  ADD KEY `prepared_by` (`prepared_by`),
  ADD KEY `warehouse_id` (`warehouse_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `purchase_order_item`
--
ALTER TABLE `purchase_order_item`
  ADD PRIMARY KEY (`purchase_order_item_id`),
  ADD KEY `purchase_order_id` (`purchase_order_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `spouse`
--
ALTER TABLE `spouse`
  ADD PRIMARY KEY (`spouse_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `fk_staff_status1_idx` (`status_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `stock_in_id` (`stock_in_id`),
  ADD KEY `stock_out_id` (`stock_out_id`),
  ADD KEY `warehouse_id` (`warehouse_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_type_id` (`user_type_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `user_module`
--
ALTER TABLE `user_module`
  ADD PRIMARY KEY (`user_module_id`),
  ADD KEY `user_module_category_id` (`user_module_category_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `user_module_category`
--
ALTER TABLE `user_module_category`
  ADD PRIMARY KEY (`user_module_category_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouse_id`),
  ADD KEY `status_id` (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional`
--
ALTER TABLE `additional`
  MODIFY `additional_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `additional_type`
--
ALTER TABLE `additional_type`
  MODIFY `additional_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `amenity_house`
--
ALTER TABLE `amenity_house`
  MODIFY `amenity_house_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `amenity_project`
--
ALTER TABLE `amenity_project`
  MODIFY `amenity_project_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `amenity_type`
--
ALTER TABLE `amenity_type`
  MODIFY `amenity_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_advance`
--
ALTER TABLE `cash_advance`
  MODIFY `cash_advance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deduction`
--
ALTER TABLE `deduction`
  MODIFY `deduction_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deduction_type`
--
ALTER TABLE `deduction_type`
  MODIFY `deduction_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `expense_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expense_item`
--
ALTER TABLE `expense_item`
  MODIFY `expense_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `house`
--
ALTER TABLE `house`
  MODIFY `house_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `house_on_project`
--
ALTER TABLE `house_on_project`
  MODIFY `house_on_project_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `material_category`
--
ALTER TABLE `material_category`
  MODIFY `material_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `material_issuance`
--
ALTER TABLE `material_issuance`
  MODIFY `material_issuance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `miscellaneous`
--
ALTER TABLE `miscellaneous`
  MODIFY `miscellaneous_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `miscellaneous_type`
--
ALTER TABLE `miscellaneous_type`
  MODIFY `miscellaneous_type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `payroll_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `person_contact`
--
ALTER TABLE `person_contact`
  MODIFY `person_contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `person_detail`
--
ALTER TABLE `person_detail`
  MODIFY `person_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `purchase_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_order_item`
--
ALTER TABLE `purchase_order_item`
  MODIFY `purchase_order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `spouse`
--
ALTER TABLE `spouse`
  MODIFY `spouse_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_module`
--
ALTER TABLE `user_module`
  MODIFY `user_module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `user_module_category`
--
ALTER TABLE `user_module_category`
  MODIFY `user_module_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `warehouse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `additional`
--
ALTER TABLE `additional`
  ADD CONSTRAINT `fk_additional_additional_type1` FOREIGN KEY (`additional_type_id`) REFERENCES `additional_type` (`additional_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_additional_payroll1` FOREIGN KEY (`payroll_id`) REFERENCES `payroll` (`payroll_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_additional_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `amenity_house`
--
ALTER TABLE `amenity_house`
  ADD CONSTRAINT `amenity_house_ibfk_1` FOREIGN KEY (`amenity_type_id`) REFERENCES `amenity_type` (`amenity_type_id`),
  ADD CONSTRAINT `amenity_house_ibfk_2` FOREIGN KEY (`house_id`) REFERENCES `house` (`house_id`),
  ADD CONSTRAINT `amenity_house_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `amenity_project`
--
ALTER TABLE `amenity_project`
  ADD CONSTRAINT `amenity_project_ibfk_1` FOREIGN KEY (`amenity_type_id`) REFERENCES `amenity_type` (`amenity_type_id`),
  ADD CONSTRAINT `amenity_project_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`),
  ADD CONSTRAINT `fk_status_id` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cash_advance`
--
ALTER TABLE `cash_advance`
  ADD CONSTRAINT `fk_cash_advance_staff1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cash_advance_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `fk_client_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `deduction`
--
ALTER TABLE `deduction`
  ADD CONSTRAINT `fk_deduction_deduction_type1` FOREIGN KEY (`deduction_type_id`) REFERENCES `deduction_type` (`deduction_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_deduction_payroll1` FOREIGN KEY (`payroll_id`) REFERENCES `payroll` (`payroll_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_deduction_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `fk_expense_expense_category1` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_category` (`expense_category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_expense_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_expense_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_expense_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD CONSTRAINT `fk_expense_category_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `expense_item`
--
ALTER TABLE `expense_item`
  ADD CONSTRAINT `fk_expense_item_expense1` FOREIGN KEY (`expense_id`) REFERENCES `expense` (`expense_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_expense_item_expense_category1` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_category` (`expense_category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_expense_item_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `house`
--
ALTER TABLE `house`
  ADD CONSTRAINT `house_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `house_on_project`
--
ALTER TABLE `house_on_project`
  ADD CONSTRAINT `house_on_project_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`),
  ADD CONSTRAINT `house_on_project_ibfk_2` FOREIGN KEY (`house_id`) REFERENCES `house` (`house_id`),
  ADD CONSTRAINT `house_on_project_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`),
  ADD CONSTRAINT `material_ibfk_2` FOREIGN KEY (`material_category_id`) REFERENCES `material_category` (`material_category_id`);

--
-- Constraints for table `material_category`
--
ALTER TABLE `material_category`
  ADD CONSTRAINT `material_category_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `material_issuance`
--
ALTER TABLE `material_issuance`
  ADD CONSTRAINT `material_issuance_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`),
  ADD CONSTRAINT `material_issuance_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`),
  ADD CONSTRAINT `material_issuance_ibfk_3` FOREIGN KEY (`prepared_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `material_issuance_ibfk_4` FOREIGN KEY (`received_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `miscellaneous`
--
ALTER TABLE `miscellaneous`
  ADD CONSTRAINT `miscellaneous_ibfk_1` FOREIGN KEY (`miscellaneous_type_id`) REFERENCES `miscellaneous_type` (`miscellaneous_type_id`),
  ADD CONSTRAINT `miscellaneous_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `fk_payroll_staff1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_payroll_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `person_contact`
--
ALTER TABLE `person_contact`
  ADD CONSTRAINT `person_contact_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `person_detail`
--
ALTER TABLE `person_detail`
  ADD CONSTRAINT `person_detail_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_ibfk_1` FOREIGN KEY (`requested_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `purchase_order_ibfk_2` FOREIGN KEY (`prepared_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `purchase_order_ibfk_3` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`warehouse_id`),
  ADD CONSTRAINT `purchase_order_ibfk_4` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `purchase_order_ibfk_5` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `purchase_order_item`
--
ALTER TABLE `purchase_order_item`
  ADD CONSTRAINT `purchase_order_item_ibfk_1` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_order` (`purchase_order_id`),
  ADD CONSTRAINT `purchase_order_item_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`stock_out_id`) REFERENCES `material` (`material_id`),
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`warehouse_id`),
  ADD CONSTRAINT `stock_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`),
  ADD CONSTRAINT `stock_ibfk_4` FOREIGN KEY (`stock_in_id`) REFERENCES `material` (`material_id`),
  ADD CONSTRAINT `stock_ibfk_5` FOREIGN KEY (`stock_out_id`) REFERENCES `material` (`material_id`);

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`user_type_id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `user_module`
--
ALTER TABLE `user_module`
  ADD CONSTRAINT `user_module_ibfk_1` FOREIGN KEY (`user_module_category_id`) REFERENCES `user_module_category` (`user_module_category_id`),
  ADD CONSTRAINT `user_module_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `user_module_category`
--
ALTER TABLE `user_module_category`
  ADD CONSTRAINT `user_module_category_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `user_type`
--
ALTER TABLE `user_type`
  ADD CONSTRAINT `user_type_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD CONSTRAINT `warehouse_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
