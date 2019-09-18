-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2019 at 09:08 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.26

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
(2, 'CONCRETE NAILS', 'KG', 30, NULL, 10, 4, 1);

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
  `project_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `invoice_no` varchar(20) DEFAULT NULL,
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
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`purchase_order_id`, `project_id`, `supplier_id`, `invoice_no`, `grand_total`, `requested_by`, `requested_date`, `prepared_by`, `prepared_date`, `approved_by`, `approved_date`, `user_note`, `deletion_note`, `admin_note`, `status_id`) VALUES
(1, 1, 1, NULL, '0.00', 2, '2019-08-10', 1, '2019-08-10', 1, '2019-08-23', 'testing purchase order', NULL, NULL, 9),
(2, 1, 1, NULL, '0.00', 1, '2019-08-11', 1, '2019-08-11', 1, '2019-08-27', 'test', NULL, 'fdfdfd', 6);

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
(1, 1, 50, 'coco lumber', '80.00', '4000.00', 1),
(2, 2, 50, 'coco lumber', '78.00', '3900.00', 1);

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
(1, 1, NULL, '2019-07-03', 50, 1, 'test stocking', 1),
(2, 1, NULL, '2019-07-03', 20, 1, 'test', 1),
(3, 1, NULL, '2019-07-03', 12, 1, '1212', 1),
(4, NULL, 1, '2019-07-03', 1, 1, '1', 1),
(5, 2, NULL, '2019-09-10', 26, 1, 'TEST', 1),
(6, 2, NULL, '2019-09-10', 4, 1, 'TESTS', 1);

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
(1, 'ABC Enterprises', 'hardware & construction materials', 'linao, talisay city, cebu', '09394789920', 2),
(2, 'ABC Enterprise', 'hardware & construction materials', 'linao, talisay city, cebu', '09394789920', 1);

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
  `user_modules` varchar(300) DEFAULT NULL,
  `user_type_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `full_name`, `user_name`, `password`, `user_modules`, `user_type_id`, `status_id`) VALUES
(1, 'marco', 'jerezon', 'marco jerezon', 'livil', 'password', '1,2,3,41,32,33,35,36,39,4,5,6,40,7,8,9,10,11,37,38,43,12,13,14,42,15,16,17,18,19,20,21,34,22,24,25,26,27,28,29,30,44,45,46,47,31', 1, 1),
(2, 'john', 'doe', 'john doe', 'johndoe', '12345678', '9,10', 4, 1),
(3, 'junhnel', 'bastida', 'junhnel bastida', 'jbastida', '12345678', '9,10,12,13,14,7,8', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_module`
--

CREATE TABLE `user_module` (
  `user_module_id` int(11) NOT NULL,
  `user_module_name` varchar(20) NOT NULL,
  `user_module_link` varchar(500) NOT NULL,
  `user_module_description` varchar(200) DEFAULT NULL,
  `user_module_category_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_module`
--

INSERT INTO `user_module` (`user_module_id`, `user_module_name`, `user_module_link`, `user_module_description`, `user_module_category_id`, `status_id`) VALUES
(1, 'List', 'house/list_view,house/list', '', 2, 1),
(2, 'Create', 'house/create_view,house/create', '', 2, 1),
(3, 'Update', 'house/update_view,house/update', '', 2, 1),
(4, 'List', 'project/list_view,project/list', '', 3, 1),
(5, 'Create', 'project/create_view,project/create', '', 3, 1),
(6, 'Update', 'project/update_view,project/update', '', 3, 1),
(7, 'Approval List', 'purchaseorder/purchase_order_view,purchaseorder/approval_purchase_orders', '', 7, 1),
(8, 'Approved List', 'purchaseorder/purchase_order_view,purchaseorder/approved_purchase_orders', '', 7, 1),
(9, 'Create', 'purchaseorder/create_purchase_order_view,purchaseorder/create_purchase_order,purchaseorder/create_purchase_order_item_view,purchaseorder/create_purchase_order_item,supplier/list,purchaseorder/active_projects,purchaseorder/active_staffs', '', 7, 1),
(10, 'View', 'purchaseorder/get_purchase_order_view,purchaseorder/get_purchase_order,purchaseorder/purchase_order_item_view,purchaseorder/purchase_order_items,purchaseorder/delete_purchase_order_item', '', 7, 1),
(11, 'Update', 'purchaseorder/update_purchase_order_view,purchaseorder/update_purchase_order,purchaseorder/update_purchase_order_item_view,purchaseorder/update_purchase_order_item', '', 7, 1),
(12, 'List', 'supplier/list_view,supplier/list', '', 5, 1),
(13, 'Create', 'supplier/create_view,supplier/create', '', 5, 1),
(14, 'Update', 'supplier/update_view,supplier/update,supplier/get', '', 5, 1),
(15, 'List', 'usermodulecategory/list_view,usermodulecategory/list,usermodule/list_view,usermodule/list', '', 6, 1),
(16, 'Create', 'usermodulecategory/create_view,usermodulecategory/create,usermodule/create_view,usermodule/create', '', 6, 1),
(17, 'Update', 'usermodulecategory/update_view,usermodulecategory/update,usermodule/update_view,usermodule/update', '', 6, 1),
(18, 'List', 'account/users,account/list_of_active_users', '', 1, 1),
(19, 'View', 'account/get_user_view', '', 1, 1),
(20, 'Create', 'account/create_user_view,account/create_user_process,account/list_of_user_types', '', 1, 1),
(21, 'Update', 'account/update_user_view,account/update_user_process', '', 1, 1),
(22, 'Warehouse List', 'warehouse/list_view,warehouse/list', '', 4, 1),
(24, 'Warehouse Create', 'warehouse/create_view,warehouse/create', '', 4, 1),
(25, 'Warehouse Update', 'warehouse/update_view,warehouse/updates', '', 4, 1),
(26, 'View all stocks', 'stock/list_view,stock/list,stock/all', '', 4, 1),
(27, 'View stock in', 'stock/list_view,stock/list,stock/in', '', 4, 1),
(28, 'View stock out', 'stock/list_view,stock/list,stock/out', '', 4, 1),
(29, 'Create Stock-in', 'stock/create_stock_in_view,stock/create_stock_in', '', 4, 1),
(30, 'Create Stock-out', 'stock/create_stock_out_view,stock/create_stock_out', '', 4, 1),
(31, 'List', 'position/list_view,position/list', '', 8, 1),
(32, 'Create', 'position/create_view,position/create', '', 8, 1),
(33, 'Update', 'position/update_view,position/update', '', 8, 1),
(34, 'Modify Permissions', 'usermodule/assign_user_module_view,usermodule/get_assigned_user_modules,usermodule/assign_user_modules', 'Allowed to modify user\'s permissions', 1, 1),
(35, 'View', 'position/view', '', 8, 1),
(36, 'Modify Permissions', 'position/update_permissions_view,position/get_permissions,position/update_permissions', '', 8, 1),
(37, 'Print', 'purchaseorder/print', '', 7, 1),
(38, 'PO Approval', 'purchaseorder/approval_purchase_order_view,purchaseorder/approval_purchase_order', '', 7, 1),
(39, 'Delete', 'position/delete', 'Deletion but users are not affected.', 8, 1),
(40, 'Delete', 'project/delete', '', 3, 1),
(41, 'Delete', 'house/delete', '', 2, 1),
(42, 'Delete', 'supplier/delete', '', 5, 1),
(43, 'PO Approved', 'purchaseorder/approved_purchase_order_view,purchaseorder/approved_purchase_order', '', 7, 1),
(44, 'List', 'material/list_view,material/list', '', 9, 1),
(45, 'Create', 'material/create_view,material/create', '', 9, 1),
(46, 'Update', 'material/update_view,material/update', '', 9, 1),
(47, 'View', 'material/view', '', 9, 1);

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
(3, 'projects', 4, 1),
(4, 'warehouse', 8, 1),
(5, 'supplier', 4, 1),
(6, 'user modules', 3, 1),
(7, 'purchase orders', 8, 1),
(8, 'positions', 6, 1),
(9, 'materials', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `default_user_modules` varchar(100) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `name`, `default_user_modules`, `status_id`) VALUES
(1, 'superuser', '1,2,3,31,32,33,4,5,6,7,8,9,10,11,12,13,14,15,17,18,19,20,21,22,24,25,26,27,28,29,30', 1),
(2, 'administrator', '1,2,3', 1),
(3, 'Production', '1,2,3,31,32,33,4,5,6', 1),
(4, 'Purchaser', '9,10,12,13,14', 1);

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
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `amenity_type`
--
ALTER TABLE `amenity_type`
  ADD PRIMARY KEY (`amenity_type_id`);

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
  ADD KEY `project_id` (`project_id`),
  ADD KEY `prepared_by` (`prepared_by`),
  ADD KEY `approved_by` (`approved_by`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `requested_by` (`requested_by`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `purchase_order_item`
--
ALTER TABLE `purchase_order_item`
  ADD PRIMARY KEY (`purchase_order_item_id`),
  ADD KEY `purchase_order_id` (`purchase_order_id`),
  ADD KEY `status_id` (`status_id`);

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
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `purchase_order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_order_item`
--
ALTER TABLE `purchase_order_item`
  MODIFY `purchase_order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_module`
--
ALTER TABLE `user_module`
  MODIFY `user_module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `user_module_category`
--
ALTER TABLE `user_module_category`
  MODIFY `user_module_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `warehouse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `amenity_project_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`);

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
  ADD CONSTRAINT `purchase_order_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`),
  ADD CONSTRAINT `purchase_order_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `purchase_order_ibfk_3` FOREIGN KEY (`requested_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `purchase_order_ibfk_4` FOREIGN KEY (`prepared_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `purchase_order_ibfk_5` FOREIGN KEY (`approved_by`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `purchase_order_ibfk_6` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `purchase_order_item`
--
ALTER TABLE `purchase_order_item`
  ADD CONSTRAINT `purchase_order_item_ibfk_1` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_order` (`purchase_order_id`),
  ADD CONSTRAINT `purchase_order_item_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

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
