-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 11, 2018 at 05:02 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appward_live`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_updateMachineStatus` ()  BEGIN
	    DECLARE machineID INT DEFAULT 0;
	    DECLARE currentDateTime DATETIME;
	    DECLARE machineUsageHdrID INT DEFAULT 0;
	     
		DECLARE done INT DEFAULT 0;
	
		DECLARE cur CURSOR FOR 
		SELECT  
			id, machine_id
	     FROM 
			`machine_usage_headers` 
	     WHERE 
			`is_running_completed` = 0 AND `end_datetime` <= (SELECT NOW());
		
		DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;	
			
		OPEN cur;			
		read_loop: LOOP				
			
			FETCH cur INTO machineUsageHdrID, machineID;
						
			IF done THEN
				LEAVE read_loop;
			END IF;
			
			UPDATE `machines` SET `machine_status_id` = 1 WHERE `id` = machineID;
			UPDATE `machine_usage_headers` SET `is_running_completed` = 1 WHERE `id` = machineUsageHdrID;
			
		END LOOP;
		CLOSE cur;	     
		
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `landing_module` varchar(100) NOT NULL,
  `landing_controller` varchar(100) NOT NULL,
  `landing_action` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `created_at`, `updated_at`, `name`, `landing_module`, `landing_controller`, `landing_action`, `is_deleted`) VALUES
(1, '2014-10-09 22:02:44', '2014-10-11 02:46:44', 'Web Service', 'webservice', 'api', 'quote', 0),
(2, '2014-10-09 22:02:44', '2014-10-11 02:46:44', 'approver', 'user', 'default', 'index', 0),
(3, '2017-06-14 12:10:30', '2017-06-14 04:10:30', 'checker', 'user', 'default', 'index', 0),
(4, '2017-06-14 12:11:11', '2017-06-14 04:11:11', 'preparer', 'user', 'default', 'index', 0);

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `created_at`, `updated_at`, `name`, `is_deleted`) VALUES
(1, '2017-10-28 19:03:52', '2017-10-28 08:03:52', 'index', 0),
(2, '2017-10-28 19:04:00', '2017-10-28 08:04:00', 'admin', 0),
(3, '2017-10-28 19:04:26', '2017-10-28 08:04:26', 'delete', 0),
(4, '2017-10-28 19:05:04', '2017-10-28 08:05:04', 'create', 0),
(5, '2017-10-28 19:05:24', '2017-10-28 08:05:24', 'print', 0),
(6, '2017-10-28 19:05:48', '2017-10-28 08:05:48', 'jobOrder', 0),
(7, '2017-10-28 19:06:08', '2017-10-28 08:06:08', 'finishedJobOrder', 0),
(8, '2017-10-28 19:06:14', '2017-10-28 08:06:14', 'forApproval', 0),
(9, '2017-10-28 19:06:34', '2017-10-28 08:06:34', 'adminRequisition', 0),
(10, '2017-10-28 19:06:53', '2017-10-28 08:06:53', 'override', 0),
(11, '2017-10-28 19:07:19', '2017-10-28 08:07:19', 'deliveryReceipts', 0),
(12, '2017-10-28 19:07:48', '2017-10-28 08:07:48', 'adminForIssuance', 0),
(13, '2017-10-28 19:07:54', '2017-10-28 08:07:54', 'selectLocation', 0),
(14, '2017-10-28 19:10:05', '2017-10-28 08:10:05', 'manualDisposal', 0),
(15, '2017-10-28 19:12:05', '2017-10-28 08:12:05', 'adminDisposal', 0),
(16, '2017-10-28 19:12:17', '2017-10-28 08:12:17', 'adminSOApproval', 0),
(17, '2017-10-28 19:12:53', '2017-10-28 08:12:53', 'adminDelivery', 0),
(18, '2017-10-28 19:13:27', '2017-10-28 08:13:27', 'adminConfirmation', 0),
(19, '2017-10-28 19:16:55', '2017-10-28 08:16:55', 'transactionReport', 0),
(20, '2017-10-28 19:17:10', '2017-10-28 08:17:10', 'salesOrderReport', 0),
(21, '2017-10-28 19:17:21', '2017-10-28 08:17:21', 'deliveryReport', 0),
(22, '2017-10-28 19:17:31', '2017-10-28 08:17:31', 'paymentReport', 0),
(23, '2017-10-28 19:17:55', '2017-10-28 08:17:55', 'jobOrderReport', 0),
(24, '2017-10-28 19:18:02', '2017-10-28 08:18:02', 'changePassword', 0),
(25, '2018-02-05 08:33:35', '2018-02-04 22:33:35', 'adminViewOverride', 0),
(26, '2018-03-13 14:22:51', '2018-03-13 03:22:53', 'adminApproval', 0);

-- --------------------------------------------------------

--
-- Table structure for table `audit_trails`
--

CREATE TABLE `audit_trails` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `table_name` varchar(100) NOT NULL COMMENT 'table name',
  `column_name` varchar(100) NOT NULL COMMENT 'column name',
  `data_id` int(11) NOT NULL DEFAULT '0' COMMENT 'primary key of the table',
  `old_value` varchar(255) NOT NULL,
  `new_value` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `emp_id` int(11) NOT NULL DEFAULT '0',
  `trans_type` int(1) NOT NULL DEFAULT '1' COMMENT '1=create,2=update,3=delete',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `audit_trails`
--

INSERT INTO `audit_trails` (`id`, `created_at`, `updated_at`, `table_name`, `column_name`, `data_id`, `old_value`, `new_value`, `user_id`, `emp_id`, `trans_type`, `is_deleted`) VALUES
(1, '2018-09-19 21:48:30', '2018-09-19 13:48:30', 'employees', 'file_pics', 1, '000001.png', '000001.jpg', 2, 1, 2, 0),
(2, '2018-09-26 21:36:34', '2018-09-26 13:36:34', 'employees', 'firstname', 1, 'WashLand1', 'WashLand', 2, 1, 2, 0),
(3, '2018-09-26 21:36:34', '2018-09-26 13:36:34', 'employees', 'lastname', 1, 'One', 'WashLand', 2, 1, 2, 0),
(4, '2018-09-26 21:36:34', '2018-09-26 13:36:34', 'employees', 'birthdate', 1, '2018-09-02', '09/26/2018', 2, 1, 2, 0),
(5, '2018-09-26 21:39:50', '2018-09-26 13:39:50', 'employees', 'file_pics', 3, '00003.', '00003.jpg', 2, 3, 2, 0),
(6, '2018-09-26 21:40:27', '2018-09-26 13:40:27', 'employees', 'lastname', 1, 'WashLand', 'Two', 2, 3, 2, 0),
(7, '2018-09-26 21:40:43', '2018-09-26 13:40:43', 'employees', 'lastname', 1, 'Two', 'One', 2, 3, 2, 0),
(8, '2018-09-27 16:07:45', '2018-09-27 08:07:45', 'employees', 'file_pics', 3, '00003.jpg', '00003.png', 2, 3, 2, 0),
(9, '2018-09-27 16:08:06', '2018-09-27 08:08:06', 'employees', 'file_pics', 1, '00001.jpg', '00001.png', 2, 3, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `client_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to clients.id',
  `address` varchar(100) DEFAULT NULL,
  `latitude` double(15,6) NOT NULL,
  `longitude` double(15,6) NOT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `created_at`, `updated_at`, `client_id`, `address`, `latitude`, `longitude`, `is_sync`, `is_deleted`, `name`) VALUES
(1, '2018-08-29 00:00:47', '2018-09-26 09:25:12', 1, '46 Irving street New Asinan Olongapo City', 14.830995, 120.285799, 0, 0, 'ELS');

-- --------------------------------------------------------

--
-- Table structure for table `civil_statuses`
--

CREATE TABLE `civil_statuses` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dealer_id` int(11) DEFAULT NULL COMMENT 'refd to dealers.id',
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `created_at`, `updated_at`, `dealer_id`, `firstname`, `middlename`, `lastname`, `company_name`, `address`, `email`, `mobile`, `phone`, `is_sync`, `is_deleted`) VALUES
(1, '2018-08-28 23:47:49', '2018-08-28 15:47:49', 1, 'test', '', 'client', 'test laundry', '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `controllers`
--

CREATE TABLE `controllers` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `controllers`
--

INSERT INTO `controllers` (`id`, `created_at`, `updated_at`, `name`, `is_deleted`) VALUES
(1, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'actions', 0),
(2, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'dealers', 0),
(3, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'clients', 0),
(4, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'expensesTypes', 0),
(5, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'inventoryCategories', 0),
(6, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'loyaltyTypes', 0),
(7, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'paymentTypes', 0),
(8, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'serviceTypes', 0),
(9, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'subscriptionTypes', 0),
(10, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerContacts', 0),
(11, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerInventoryItems', 0),
(12, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerMobileNumbers', 0),
(13, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerPaymentHeaders', 0),
(14, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerPaymentTransactions', 0),
(15, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerPdcPaymentDetails', 0),
(16, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerPdcPaymentHeaders', 0),
(17, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerPhoneNumbers', 0),
(18, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerSalesOrderDeliveryDetails', 0),
(19, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerSalesOrderDeliveryHeaders', 0),
(20, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerSalesOrderDetails', 0),
(21, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerSalesOrderHeaders', 0),
(22, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerSalesOrderStatuses', 0),
(23, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerSoDeliveryConfirmationHeaders', 0),
(24, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerSoDetailForApproval', 0),
(25, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerSoHeaderForApproval', 0),
(26, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customerTransactions', 0),
(27, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'customers', 0),
(28, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'default', 0),
(29, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'departments', 0),
(30, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'employeeEmploymentHistory', 0),
(31, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'employeeMobileNumbers', 0),
(32, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'employeePhoneNumbers', 0),
(33, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'employees', 0),
(34, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'employmentStatuses', 0),
(35, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'floors', 0),
(36, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'inventories', 0),
(37, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'inventoryAdjustments', 0),
(38, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'inventoryCustomerPrices', 0),
(39, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'inventoryDetails', 0),
(40, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'itemTypes', 0),
(41, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'locationInventories', 0),
(42, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'locations', 0),
(43, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'menus', 0),
(44, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'modules', 0),
(45, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'municipalities', 0),
(46, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'occupations', 0),
(47, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'paymentTerms', 0),
(48, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'propertiesDisposableDetails', 0),
(49, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'propertiesDisposableHeaders', 0),
(50, '2017-10-27 15:51:34', '2017-10-27 04:51:34', 'propertiesIssuanceDetails', 0),
(51, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'propertiesIssuanceHeaders', 0),
(52, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'propertiesRequisitionDetails', 0),
(53, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'propertiesRequisitionHeaders', 0),
(54, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'propertiesRequisitionStatuses', 0),
(55, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'propertiesTransferDetails', 0),
(56, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'propertiesTransferHeaders', 0),
(57, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'propertyGroups', 0),
(58, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'provinces', 0),
(59, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'purchaseOrderDetails', 0),
(60, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'purchaseOrderHeaders', 0),
(61, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'purchaseOrderSuppliesDetails', 0),
(62, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'purchaseOrderSuppliesHeaders', 0),
(63, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'purchaseReceivingDetails', 0),
(64, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'purchaseReceivingHeaders', 0),
(65, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'regions', 0),
(66, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'roleBasedAccess', 0),
(67, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'roleBasedViews', 0),
(68, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'roles', 0),
(69, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'roomInventories', 0),
(70, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'roomTypes', 0),
(71, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'rooms', 0),
(72, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'segments', 0),
(73, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'statusSalesORder', 0),
(74, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'suppliers', 0),
(75, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'suppliesIssuanceDetails', 0),
(76, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'suppliesIssuanceHeaders', 0),
(77, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'suppliesReceivingDetails', 0),
(78, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'suppliesReceivingHeaders', 0),
(79, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'suppliesRequisitionDetails', 0),
(80, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'suppliesRequisitionForpoDetails', 0),
(81, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'suppliesRequisitionForpoHeaders', 0),
(82, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'suppliesRequisitionHeaders', 0),
(83, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'units', 0),
(84, '2017-10-27 15:51:35', '2017-10-27 04:51:35', 'users', 0),
(85, '2018-04-13 13:41:52', '2018-04-12 13:41:52', 'purchaseRequisitionHeaders', 0),
(86, '2018-04-13 13:42:08', '2018-04-12 13:42:08', 'purchaseRequisitionDetails', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `branch_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to brnaches.id',
  `client_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to clients.id',
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `birthdate` date DEFAULT NULL,
  `token_wash` int(11) DEFAULT '0',
  `token_dry` int(11) DEFAULT '0',
  `token_titan` int(11) DEFAULT '0',
  `is_activated` tinyint(1) DEFAULT '0' COMMENT '0 =rfid not registered 1= rfid registered',
  `points` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `created_at`, `updated_at`, `branch_id`, `client_id`, `firstname`, `middlename`, `lastname`, `company_name`, `address`, `email`, `mobile`, `phone`, `is_sync`, `is_deleted`, `birthdate`, `token_wash`, `token_dry`, `token_titan`, `is_activated`, `points`) VALUES
(1, '2018-09-25 20:41:23', '2018-09-26 13:13:28', 1, 1, 'ELS', 'MASTER', 'Card1', 'ELS', '46 Irving Street Asinan Olongapo City', '', '09292210602', '09292210602', 0, 0, '2018-09-25', 24, 17, 0, 1, 0),
(2, '2018-09-26 21:05:02', '2018-09-26 13:13:54', 1, 1, 'ELS', 'MASTER', 'Card2', '', '46 Irving Street Asinan Olongapo City', '', '09292210602', '09292210602', 0, 0, '2018-09-17', 2, 2, 0, 1, 0),
(3, '2018-10-08 21:53:30', '2018-10-08 13:53:30', 1, 1, 'test1', '', 'test1', '', '', '', '', '', 0, 0, '2018-10-31', 0, 0, 0, 0, 0),
(4, '2018-10-08 21:53:37', '2018-10-08 13:53:37', 1, 1, 'test2', '', 'test2', '', '', '', '', '', 0, 0, '2018-10-31', 0, 0, 0, 0, 0),
(5, '2018-10-08 21:53:43', '2018-10-08 13:53:43', 1, 1, 'test3', '', 'test3', '', '', '', '', '', 0, 0, '2018-10-31', 0, 0, 0, 0, 0),
(6, '2018-10-08 21:54:27', '2018-10-08 13:54:27', 1, 1, 'test4', '', 'test4', '', '', '', '', '', 0, 0, '2018-10-23', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_cards`
--

CREATE TABLE `customer_cards` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reg_date` date NOT NULL,
  `last_trans_date` date NOT NULL,
  `exp_date` date NOT NULL COMMENT 'expiration date',
  `card_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd rewardcards_created_details.id',
  `card_no` varchar(12) NOT NULL,
  `rf_id` varchar(15) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `laundry_shop_id` int(11) NOT NULL DEFAULT '0',
  `branch_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `emp_id` int(11) NOT NULL DEFAULT '0',
  `is_sales` tinyint(1) NOT NULL DEFAULT '1',
  `is_activated` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `amount` decimal(12,2) DEFAULT '0.00' COMMENT 'amount the card was bought',
  `point` int(11) DEFAULT '0' COMMENT 'customer earned points',
  `card_type_id` int(11) DEFAULT '0',
  `card_user_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_cards`
--

INSERT INTO `customer_cards` (`id`, `created_at`, `updated_at`, `reg_date`, `last_trans_date`, `exp_date`, `card_id`, `card_no`, `rf_id`, `customer_id`, `client_id`, `laundry_shop_id`, `branch_id`, `user_id`, `emp_id`, `is_sales`, `is_activated`, `is_deleted`, `amount`, `point`, `card_type_id`, `card_user_id`) VALUES
(1, '2018-09-26 21:13:28', '2018-09-26 13:13:28', '2018-09-26', '2018-09-26', '2019-09-26', 1, '158c4994', '158c4994', 1, 1, 0, 1, 3, 1, 1, 1, 0, '0.00', 0, 2, 3),
(2, '2018-09-26 21:13:54', '2018-09-26 13:13:54', '2018-09-26', '2018-09-26', '2019-09-26', 1, '7be56259', '7be56259', 2, 1, 0, 1, 3, 1, 1, 1, 0, '0.00', 0, 2, 4),
(3, '2018-09-27 16:54:13', '2018-09-27 08:54:13', '2018-09-27', '2018-09-27', '2019-09-27', 1, '12345678', '12345678', 5, 1, 0, 1, 2, 3, 1, 1, 0, '0.00', 0, 1, NULL),
(4, '2018-09-27 17:54:01', '2018-09-27 09:54:01', '2018-09-27', '2018-09-27', '2019-09-27', 1, '87654321', '87654321', 6, 1, 0, 1, 3, 1, 1, 1, 0, '0.00', 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_card_transactions`
--

CREATE TABLE `customer_card_transactions` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL COMMENT 'refd to branches.id',
  `client_id` int(11) DEFAULT NULL COMMENT 'refd to clients.id',
  `customer_id` int(11) NOT NULL DEFAULT '0' COMMENT 'ref to customers.id',
  `card_id` int(11) DEFAULT NULL COMMENT 'ref to customer cards . id',
  `card_no` varchar(12) NOT NULL,
  `transaction_id` int(11) NOT NULL COMMENT 'ref to transactions.id',
  `credited` decimal(12,2) NOT NULL DEFAULT '0.00',
  `debited` decimal(12,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(12,2) DEFAULT NULL,
  `user_id` int(11) NOT NULL COMMENT 'ref to users.id',
  `remarks` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer_machine_usages`
--

CREATE TABLE `customer_machine_usages` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_transaction_id` int(11) NOT NULL DEFAULT '0',
  `client_id` int(11) NOT NULL DEFAULT '0',
  `laundry_shop_id` int(11) NOT NULL DEFAULT '0',
  `branch_id` int(11) NOT NULL DEFAULT '11',
  `transaction_id` int(11) NOT NULL COMMENT 'ref to transactions.id',
  `machine_id` int(11) NOT NULL DEFAULT '0',
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `start_machine_status` int(11) NOT NULL DEFAULT '0',
  `end_machine_status` int(11) NOT NULL DEFAULT '0',
  `total_minutes` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT 'ref to users.id',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer_transactions`
--

CREATE TABLE `customer_transactions` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `machine_id` int(11) NOT NULL COMMENT 'ref to machines.id',
  `rf_id` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT '0' COMMENT 'ref to customers.id',
  `customer_card_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd customer_cards.id',
  `card_no` varchar(12) NOT NULL,
  `transaction_id` int(11) NOT NULL COMMENT 'ref to transactions.id',
  `credited` decimal(12,2) NOT NULL DEFAULT '0.00',
  `debited` decimal(12,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(12,2) DEFAULT NULL,
  `user_id` int(11) NOT NULL COMMENT 'ref to users.id',
  `remarks` varchar(255) DEFAULT NULL,
  `is_sales` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'tag as sales in report',
  `branch_id` int(11) DEFAULT NULL COMMENT 'refd to branches.id',
  `client_id` int(11) DEFAULT NULL COMMENT 'refd to clients.id',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dealers`
--

CREATE TABLE `dealers` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dealers`
--

INSERT INTO `dealers` (`id`, `created_at`, `updated_at`, `firstname`, `middlename`, `lastname`, `company_name`, `address`, `email`, `mobile`, `phone`, `is_sync`, `is_deleted`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Test', 'test', 'test', 'test', 'tst', 'teset@test.test', '093213131', '12321323', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `client_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to clients.id',
  `branch_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to branches.id',
  `name` varchar(50) DEFAULT NULL,
  `discount_type_id` int(11) NOT NULL DEFAULT '0' COMMENT '= amount, 2 = percentage',
  `value` decimal(12,2) DEFAULT '0.00',
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `created_at`, `updated_at`, `client_id`, `branch_id`, `name`, `discount_type_id`, `value`, `is_sync`, `is_deleted`) VALUES
(1, '2018-09-09 02:27:53', '2018-09-08 18:27:53', 1, 1, 'Senior Citizen\'s Discount (12 %)', 2, '12.00', 0, 0),
(2, '2018-09-09 02:28:02', '2018-09-08 18:28:02', 1, 1, 'Others', 1, '0.00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_no` varchar(20) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `civil_status_id` int(11) NOT NULL DEFAULT '0',
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `municipality_id` int(11) DEFAULT NULL,
  `barangay_id` int(11) DEFAULT NULL,
  `office_id` int(11) NOT NULL DEFAULT '0',
  `citizenship_id` int(11) NOT NULL DEFAULT '0',
  `branch_id` int(11) NOT NULL,
  `contact_person_id` int(11) NOT NULL,
  `occupation_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `manager_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL DEFAULT '0',
  `is_agent` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `client_id` int(11) DEFAULT NULL COMMENT 'ref to clients.id',
  `is_account_created` tinyint(1) DEFAULT '0' COMMENT '0= no account 1 = account created',
  `file_path` varchar(100) DEFAULT NULL,
  `file_pics` varchar(100) DEFAULT NULL,
  `is_owner` int(11) DEFAULT NULL,
  `is_employee` int(11) DEFAULT NULL,
  `is_with_card` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `created_at`, `updated_at`, `employee_no`, `firstname`, `middlename`, `lastname`, `mobile`, `phone`, `email`, `birthdate`, `civil_status_id`, `address1`, `address2`, `region_id`, `province_id`, `municipality_id`, `barangay_id`, `office_id`, `citizenship_id`, `branch_id`, `contact_person_id`, `occupation_id`, `department_id`, `manager_id`, `location_id`, `is_agent`, `is_active`, `is_deleted`, `client_id`, `is_account_created`, `file_path`, `file_pics`, `is_owner`, `is_employee`, `is_with_card`) VALUES
(1, '2018-09-26 21:02:36', '2018-09-27 08:08:06', '00001', 'ELS', '', 'One', '', '', '', '0000-00-00', 0, '', NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 'images/employees/', '00001.png', NULL, 1, 1),
(2, '2018-09-26 21:03:14', '2018-09-27 08:07:56', '00002', 'ELS', '', 'Two', '', '', '', '2018-09-26', 0, '', NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 'images/employees/', '00002.png', NULL, 1, 1),
(3, '2018-09-26 21:37:50', '2018-09-27 08:07:45', '00003', 'ELS', '', 'Main', '', '', '', '2018-09-26', 0, '', NULL, NULL, NULL, NULL, NULL, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 'images/employees/', '00003.png', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date` date NOT NULL,
  `ref_no` varchar(20) NOT NULL,
  `branch_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to branches.id',
  `client_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to clients.id',
  `expenses_type_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to expenses_types.id',
  `title` varchar(20) NOT NULL,
  `amount` decimal(12,2) DEFAULT '0.00',
  `remarks` varchar(500) NOT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `created_at`, `updated_at`, `date`, `ref_no`, `branch_id`, `client_id`, `expenses_type_id`, `title`, `amount`, `remarks`, `is_sync`, `is_deleted`) VALUES
(1, '2018-09-26 20:54:12', '2018-09-26 12:54:12', '2018-09-26', '1809000001', 0, 1, 4, 'Purchases', '957.60', 'Purchase of Downy', 0, 0),
(2, '2018-09-27 16:09:19', '2018-09-27 08:09:19', '2018-09-27', '1809000002', 0, 1, 4, 'Purchases', '1000.00', 'Purchase of Ariel', 0, 0),
(3, '2018-09-27 16:09:42', '2018-09-27 08:09:42', '2018-09-27', '1809000003', 0, 1, 4, 'Purchases', '1500.00', 'Purchase of Breeze', 0, 0),
(4, '2018-09-27 16:10:01', '2018-09-27 08:10:01', '2018-09-27', '1809000004', 0, 1, 4, 'Purchases', '1000.00', 'Purchase of Downy', 0, 0),
(5, '2018-09-27 16:10:13', '2018-09-27 08:10:13', '2018-09-27', '1809000005', 0, 1, 4, 'Purchases', '500.00', 'Purchase of Laundry Plastic', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `expenses_types`
--

CREATE TABLE `expenses_types` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expenses_types`
--

INSERT INTO `expenses_types` (`id`, `created_at`, `updated_at`, `name`, `is_sync`, `is_deleted`) VALUES
(1, '2018-09-08 09:43:46', '2018-09-08 01:49:21', 'Utility Expeses', 0, 0),
(2, '2018-09-08 09:49:36', '2018-09-08 01:49:36', 'Rental', 0, 0),
(3, '2018-09-08 09:49:52', '2018-09-08 01:49:52', 'Salaries', 0, 0),
(4, '2018-09-08 09:49:59', '2018-09-08 01:49:59', 'Purchases', 0, 0),
(5, '2018-09-08 09:50:07', '2018-09-08 01:50:07', 'Others', 0, 0),
(6, '2018-09-19 21:53:22', '2018-09-19 13:53:22', 'laundry Supplies', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `branch_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd branches.id',
  `client_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd clients.id',
  `name` varchar(100) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `bar_code` varchar(50) DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd categories.id',
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `cost` decimal(12,2) NOT NULL DEFAULT '0.00',
  `tax` decimal(12,2) NOT NULL DEFAULT '0.00',
  `margin` decimal(12,2) NOT NULL DEFAULT '0.00',
  `qty_stock` int(11) NOT NULL DEFAULT '0',
  `qty_reorder` int(11) NOT NULL DEFAULT '0',
  `file_path` varchar(100) DEFAULT NULL,
  `file_pics` varchar(100) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `topup_amount` decimal(12,2) DEFAULT NULL COMMENT 'amount will be added  to top up',
  `token` int(11) DEFAULT NULL,
  `service_type_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `created_at`, `updated_at`, `branch_id`, `client_id`, `name`, `desc`, `bar_code`, `category_id`, `price`, `cost`, `tax`, `margin`, `qty_stock`, `qty_reorder`, `file_path`, `file_pics`, `is_sync`, `is_deleted`, `topup_amount`, `token`, `service_type_id`, `group_id`, `color`) VALUES
(1, '2018-09-25 20:35:58', '2018-09-25 12:35:58', 1, 1, 'Regular Wash', 'Regular Wash 39mins', '', 2, '60.00', '0.00', '0.00', '0.00', 0, 0, 'images/inventories/', 'regular_wash.', 0, 0, NULL, 1, 1, 1, NULL),
(2, '2018-09-25 20:37:14', '2018-09-25 12:37:14', 1, 1, 'Regular Dry', 'Regular Dry 10mins', '', 2, '15.00', '0.00', '0.00', '0.00', 0, 0, 'images/inventories/', 'regular_dry.', 0, 0, NULL, 1, 2, 1, NULL),
(3, '2018-09-25 21:07:13', '2018-09-25 13:07:13', 1, 1, 'Regular Wash', 'Regular Wash 39mins', '', 2, '60.00', '0.00', '0.00', '0.00', 0, 0, 'images/inventories/', 'regular_wash.', 0, 0, NULL, 1, 1, 2, NULL),
(4, '2018-09-25 21:09:54', '2018-09-25 13:09:54', 1, 1, 'Regular Dry', 'Regular Dry 10mins', '', 2, '15.00', '0.00', '0.00', '0.00', 0, 0, 'images/inventories/', 'regular_dry.', 0, 0, NULL, 1, 2, 2, NULL),
(5, '2018-09-25 21:10:20', '2018-09-25 13:10:20', 1, 1, 'Fold', 'Fold', '', 2, '20.00', '0.00', '0.00', '0.00', 0, 0, 'images/inventories/', 'fold.', 0, 0, NULL, 0, 1, 2, NULL),
(6, '2018-09-25 21:13:48', '2018-09-25 13:13:48', 1, 1, 'Ariel', 'Ariel', '1', 1, '15.00', '10.00', '0.00', '0.00', 81, 50, 'images/inventories/', 'ariel.', 0, 0, NULL, NULL, NULL, NULL, NULL),
(7, '2018-09-25 21:14:49', '2018-09-25 13:14:49', 1, 1, 'Breeze', 'Breeze', '', 1, '15.00', '15.00', '0.00', '0.00', 82, 50, 'images/inventories/', 'breeze.', 0, 0, NULL, NULL, NULL, NULL, NULL),
(8, '2018-09-25 21:15:25', '2018-09-25 13:15:25', 1, 1, 'Downy', 'Downy', '', 1, '15.00', '10.00', '0.00', '0.00', 231, 50, 'images/inventories/', 'downy.', 0, 0, NULL, NULL, NULL, NULL, NULL),
(9, '2018-09-25 21:15:45', '2018-09-25 13:15:45', 1, 1, 'Surf', 'Surf', '', 1, '15.00', '0.00', '0.00', '0.00', 0, 50, 'images/inventories/', 'surf.', 0, 0, NULL, NULL, NULL, NULL, NULL),
(10, '2018-09-25 21:16:09', '2018-09-25 13:16:09', 1, 1, 'Zonrox', 'Zonrox', '', 1, '10.00', '0.00', '0.00', '0.00', 0, 50, 'images/inventories/', 'zonrox.', 0, 0, NULL, NULL, NULL, NULL, NULL),
(11, '2018-09-25 21:17:10', '2018-09-25 13:17:10', 1, 1, 'Promo Wash (FREE)', 'Regular Wash 39mins', '', 2, '0.00', '0.00', '0.00', '0.00', 0, 0, 'images/inventories/', 'promo_wash_(free).', 0, 0, NULL, 1, 1, 1, NULL),
(12, '2018-09-25 21:17:45', '2018-09-25 13:17:45', 1, 1, 'Laundry Plastic', 'Laundry Plastic', '', 1, '3.00', '5.00', '0.00', '0.00', 90, 50, 'images/inventories/', 'laundry_plastic.', 0, 0, NULL, NULL, NULL, NULL, NULL),
(13, '2018-09-26 19:07:21', '2018-09-26 11:07:21', 1, 1, 'SuperWash', 'SuperWash', '', 2, '60.00', '0.00', '0.00', '0.00', 0, 0, 'images/inventories/', 'superwash.', 0, 0, NULL, 2, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_categories`
--

CREATE TABLE `inventory_categories` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventory_categories`
--

INSERT INTO `inventory_categories` (`id`, `created_at`, `updated_at`, `name`, `is_deleted`) VALUES
(1, '2018-07-19 14:40:44', '2018-07-18 22:40:44', 'Products', 0),
(2, '2018-07-19 14:40:55', '2018-07-18 22:40:55', 'Services', 0),
(3, '2018-07-19 14:41:03', '2018-07-18 22:41:03', 'Others', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loyalty_settings`
--

CREATE TABLE `loyalty_settings` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `client_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to clients.id',
  `branch_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to branches.id',
  `loyalty_type_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to loyalty_types.id',
  `value` decimal(12,2) DEFAULT '0.00',
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `percentage` decimal(12,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `loyalty_types`
--

CREATE TABLE `loyalty_types` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE `machines` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `laundry_shop_id` int(11) NOT NULL DEFAULT '0',
  `branch_id` int(11) NOT NULL DEFAULT '11',
  `ip_address` varchar(50) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `machine_type_id` int(11) NOT NULL COMMENT 'ref to machine_types.id',
  `machine_status_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd machine_statuses.id',
  `url_machine_activator` varchar(255) NOT NULL COMMENT 'url local machine activator',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT 'ref to users.id',
  `img_file_path` varchar(255) DEFAULT '/images/machine/tmp/',
  `img_file` varchar(255) DEFAULT 'washingmachine.jpg',
  `minutes_per_washdry` int(11) NOT NULL DEFAULT '0',
  `minutes_per_cycle` int(11) NOT NULL DEFAULT '0',
  `serial_no` varchar(15) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `is_status_pending_approval` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`id`, `created_at`, `updated_at`, `client_id`, `laundry_shop_id`, `branch_id`, `ip_address`, `name`, `machine_type_id`, `machine_status_id`, `url_machine_activator`, `user_id`, `img_file_path`, `img_file`, `minutes_per_washdry`, `minutes_per_cycle`, `serial_no`, `is_deleted`, `is_status_pending_approval`) VALUES
(1, '2018-09-25 20:27:11', '2018-09-26 12:16:35', 1, 0, 1, '192.168.1.101', 'Washer 1', 1, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 39, 39, '', 0, 0),
(2, '2018-09-25 20:27:33', '2018-09-26 10:48:30', 1, 0, 1, '192.168.1.102', 'Washer 2', 1, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 39, 39, '', 0, 0),
(3, '2018-09-25 20:27:52', '2018-09-25 12:27:52', 1, 0, 1, '192.168.1.103', 'Washer 3', 1, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 39, 39, '', 0, 0),
(4, '2018-09-25 20:28:27', '2018-09-26 12:07:28', 1, 0, 1, '192.168.1.104', 'Washer 4', 1, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 39, 39, '', 0, 0),
(5, '2018-09-25 20:29:34', '2018-09-25 12:29:34', 1, 0, 1, '192.168.1.105', 'Washer 5', 1, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 39, 39, '', 0, 0),
(6, '2018-09-25 20:29:55', '2018-09-25 12:29:55', 1, 0, 1, '192.168.1.106', 'Washer 6', 1, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 39, 39, '', 0, 0),
(7, '2018-09-25 20:30:05', '2018-09-25 12:30:05', 1, 0, 1, '192.168.1.107', 'Washer 7', 1, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 39, 39, '', 0, 0),
(8, '2018-09-25 20:30:17', '2018-09-25 12:30:17', 1, 0, 1, '192.168.1.108', 'Washer 8', 1, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 39, 39, '', 0, 0),
(9, '2018-09-25 20:30:29', '2018-09-25 12:30:29', 1, 0, 1, '192.168.1.109', 'Washer 9', 1, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 39, 39, '', 0, 0),
(10, '2018-09-25 20:30:41', '2018-09-25 12:30:41', 1, 0, 1, '192.168.1.110', 'Washer 10', 1, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 39, 39, '', 0, 0),
(11, '2018-09-25 20:30:56', '2018-09-25 12:30:56', 1, 0, 1, '192.168.1.111', 'Dryer 1', 2, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 10, 10, '', 0, 0),
(12, '2018-09-25 20:31:50', '2018-09-25 12:31:50', 1, 0, 1, '192.168.1.112', 'Dryer 2', 2, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 10, 10, '', 0, 0),
(13, '2018-09-25 20:32:11', '2018-09-25 12:32:11', 1, 0, 1, '192.168.1.113', 'Dryer 3', 2, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 10, 10, '', 0, 0),
(14, '2018-09-25 20:32:27', '2018-09-26 12:07:47', 1, 0, 1, '192.168.1.114', 'Dryer 4', 2, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 10, 10, '', 0, 0),
(15, '2018-09-25 20:32:41', '2018-09-25 12:32:41', 1, 0, 1, '192.168.1.115', 'Dryer 5', 2, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 10, 10, '', 0, 0),
(16, '2018-09-25 20:32:52', '2018-09-25 12:32:52', 1, 0, 1, '192.168.1.116', 'Dryer 6', 2, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 10, 10, '', 0, 0),
(17, '2018-09-25 20:33:06', '2018-09-25 12:33:06', 1, 0, 1, '192.168.1.117', 'Dryer 7', 2, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 10, 10, '', 0, 0),
(18, '2018-09-25 20:33:44', '2018-09-25 12:33:44', 1, 0, 1, '192.168.1.118', 'Dryer 8', 2, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 10, 10, '', 0, 0),
(19, '2018-09-25 20:34:38', '2018-09-25 12:34:38', 1, 0, 1, '192.168.1.119', 'Dryer 9', 2, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 10, 10, '', 0, 0),
(20, '2018-09-25 20:34:50', '2018-09-25 12:34:50', 1, 0, 1, '192.168.1.120', 'Dryer 10', 2, 1, '', 3, '/images/machine/tmp/', 'washingmachine.jpg', 10, 10, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `machine_statuses`
--

CREATE TABLE `machine_statuses` (
  `id` int(11) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `seq` int(2) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `machine_statuses`
--

INSERT INTO `machine_statuses` (`id`, `created_at`, `updated_at`, `name`, `seq`, `is_deleted`) VALUES
(1, '2017-09-18 23:48:59', '2017-09-17 23:48:59', 'Idle', 1, 0),
(2, '2017-09-18 23:49:15', '2017-09-17 23:49:15', 'Running', 2, 0),
(3, '2017-09-18 23:49:20', '2017-09-17 23:49:20', 'Paused', 3, 0),
(4, '2017-12-11 04:54:00', '2017-12-10 12:54:00', 'Defective', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `machine_types`
--

CREATE TABLE `machine_types` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `minutes_per_usage` int(11) NOT NULL DEFAULT '0' COMMENT 'minutes per wash/dryer',
  `minutes_per_cycle` int(11) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `machine_types`
--

INSERT INTO `machine_types` (`id`, `created_at`, `updated_at`, `name`, `minutes_per_usage`, `minutes_per_cycle`, `is_deleted`) VALUES
(1, '2017-04-27 13:27:22', '2017-04-26 13:27:22', 'Washer', 39, 39, 0),
(2, '2017-04-27 13:27:31', '2017-04-26 13:27:31', 'Dryer', 10, 10, 0),
(3, '2018-08-15 00:00:00', '2018-08-14 16:00:00', 'Titan', 39, 39, 0);

-- --------------------------------------------------------

--
-- Table structure for table `machine_usage_details`
--

CREATE TABLE `machine_usage_details` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `header_id` int(11) NOT NULL DEFAULT '0',
  `customer_transaction_id` int(11) NOT NULL DEFAULT '0',
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `machine_id` int(11) NOT NULL DEFAULT '0',
  `rf_id` varchar(15) NOT NULL,
  `transaction_id` int(11) NOT NULL DEFAULT '0',
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `total_minutes` int(11) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `machine_usage_headers`
--

CREATE TABLE `machine_usage_headers` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_card_id` int(11) NOT NULL DEFAULT '0',
  `rf_id` varchar(15) NOT NULL,
  `branch_id` int(11) NOT NULL DEFAULT '0',
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `machine_id` int(11) NOT NULL DEFAULT '0',
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `total_minutes` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `is_running_completed` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `module_id` int(11) NOT NULL DEFAULT '0',
  `is_main_menu` tinyint(1) NOT NULL DEFAULT '0',
  `is_parent` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `is_url` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'with url',
  `controller_id` int(11) NOT NULL DEFAULT '0',
  `controller_name` varchar(100) DEFAULT NULL,
  `action_id` int(11) NOT NULL DEFAULT '0',
  `action_name` varchar(100) DEFAULT NULL,
  `params` varchar(255) DEFAULT NULL,
  `orders` int(2) NOT NULL DEFAULT '0',
  `li_class` varchar(100) DEFAULT NULL,
  `i_class` varchar(100) DEFAULT 'fa fa-lg fa-fw fa-gear',
  `span_class` varchar(100) DEFAULT 'menu-item-parent',
  `link_class` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `created_at`, `updated_at`, `name`, `module_id`, `is_main_menu`, `is_parent`, `parent_id`, `is_url`, `controller_id`, `controller_name`, `action_id`, `action_name`, `params`, `orders`, `li_class`, `i_class`, `span_class`, `link_class`, `is_deleted`) VALUES
(1, '2017-11-05 02:46:13', '2017-11-04 02:46:13', 'User Access', 1, 1, 1, 0, 0, 0, NULL, 0, NULL, NULL, 1, 'treeview', 'fa fa-lg fa-fw fa-gear', 'menu-item-parent', NULL, 0),
(3, '2017-11-05 02:48:20', '2017-11-04 02:48:20', 'Manage', 1, 0, 0, 1, 1, 0, 'users', 0, 'admin', NULL, 2, 'treeview-menu\"', NULL, NULL, NULL, 0),
(4, '2017-11-05 02:50:36', '2017-11-04 02:50:36', 'Change Password', 1, 0, 0, 1, 1, 0, 'users', 0, 'changePassword', NULL, 3, 'treeview-menu\"', NULL, NULL, NULL, 0),
(5, '2018-07-20 14:52:06', '2018-07-19 22:52:06', 'Dealers', 1, 1, 1, 0, 0, 0, '', 0, '', NULL, 0, 'treeview', 'fa fa-lg fa-fw fa-gear', 'menu-item-parent', NULL, 0),
(6, '2018-07-20 14:54:00', '2018-07-19 22:54:00', 'Mange', 1, 0, 0, 5, 1, 2, 'dealers', 2, 'admin', NULL, 0, 'treeview-menu\"', NULL, NULL, NULL, 0),
(7, '2018-07-22 21:33:14', '2018-07-22 05:33:14', 'Clients', 1, 1, 1, 0, 0, 0, NULL, 0, NULL, NULL, 0, 'treeview', 'fa fa-lg fa-fw fa-gear', 'menu-item-parent', NULL, 0),
(8, '2018-07-22 21:37:26', '2018-07-22 05:37:26', 'Mange', 1, 0, 0, 7, 1, 3, 'clients', 2, 'admin', NULL, 0, NULL, 'fa fa-lg fa-fw fa-gear', 'menu-item-parent', NULL, 0),
(9, '2018-07-22 21:43:31', '2018-07-22 05:43:31', 'Settings', 1, 0, 1, 0, 0, 0, '', 0, '', NULL, 0, NULL, 'fa fa-lg fa-fw fa-gear', 'menu-item-parent', NULL, 0),
(10, '2018-07-22 21:49:40', '2018-07-22 05:49:40', 'Expenses', 1, 0, 0, 9, 1, 4, 'expensesTypes', 2, 'admin', NULL, 0, NULL, 'fa fa-lg fa-fw fa-gear', 'menu-item-parent', NULL, 0),
(11, '2018-07-22 21:50:10', '2018-07-22 05:50:10', 'Inventory Categories', 1, 0, 0, 9, 1, 5, 'inventoryCategories', 2, 'admin', NULL, 0, NULL, 'fa fa-lg fa-fw fa-gear', 'menu-item-parent', NULL, 0),
(12, '2018-07-22 21:50:41', '2018-07-22 05:50:41', 'Loyalties', 1, 0, 0, 9, 1, 6, 'loyaltyTypes', 2, 'admin', NULL, 0, NULL, 'fa fa-lg fa-fw fa-gear', 'menu-item-parent', NULL, 0),
(13, '2018-07-22 21:51:15', '2018-07-22 05:51:15', 'Payment Types', 1, 0, 0, 9, 1, 7, 'paymentTypes', 2, 'admin', NULL, 0, NULL, 'fa fa-lg fa-fw fa-gear', 'menu-item-parent', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `brand_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `created_at`, `updated_at`, `name`, `brand_id`) VALUES
(1, '2015-09-24', '2015-09-24 10:07:23', 'Jazz 2015', 1),
(2, '2015-09-24', '2015-09-24 10:07:30', 'Civic 2015', 1),
(3, '2015-09-24', '2015-09-24 10:07:39', 'Innov 2015', 2),
(4, '2015-09-24', '2015-09-24 10:08:45', 'Mirage 2014', 3),
(5, '2015-09-24', '2015-09-24 10:08:56', 'Avanaza 2015', 2);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `created_at`, `updated_at`, `name`, `is_deleted`) VALUES
(1, '2017-07-15 15:26:05', '2017-07-14 20:26:05', 'siteadmin', 0),
(2, '2018-07-11 12:31:41', '2018-07-10 20:31:45', 'dealer', 0),
(3, '2018-07-11 12:31:56', '2018-07-10 20:31:58', 'backoffice', 0),
(4, '0000-00-00 00:00:00', '2018-07-15 19:53:21', 'user', 0);

-- --------------------------------------------------------

--
-- Table structure for table `occupations`
--

CREATE TABLE `occupations` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `created_at`, `updated_at`, `name`, `is_sync`, `is_deleted`) VALUES
(1, '2018-09-10 11:34:24', '2018-09-10 03:34:24', 'Cash', 0, 0),
(2, '2018-09-10 11:34:24', '2018-09-10 03:34:24', 'Card', 0, 0),
(3, '2018-09-10 11:34:24', '2018-09-10 03:34:24', 'Points', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pos_payment_details`
--

CREATE TABLE `pos_payment_details` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `header_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd pos_payment_headers.id',
  `transaction_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd pos_transactions.id',
  `inventory_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd inventories.id',
  `qty` int(11) DEFAULT '0',
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `amount_paid` decimal(12,2) NOT NULL DEFAULT '0.00',
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_payment_details`
--

INSERT INTO `pos_payment_details` (`id`, `created_at`, `updated_at`, `header_id`, `transaction_id`, `inventory_id`, `qty`, `price`, `amount_paid`, `is_sync`, `is_deleted`) VALUES
(1, '2018-09-27 16:11:23', '2018-09-27 08:11:23', 1, 1, 6, 1, '15.00', '15.00', 0, 0),
(2, '2018-09-27 16:11:23', '2018-09-27 08:11:23', 1, 2, 7, 1, '15.00', '15.00', 0, 0),
(3, '2018-09-27 16:11:23', '2018-09-27 08:11:23', 1, 3, 8, 1, '15.00', '15.00', 0, 0),
(4, '2018-09-27 16:11:23', '2018-09-27 08:11:23', 1, 4, 12, 1, '3.00', '3.00', 0, 0),
(5, '2018-09-27 16:11:23', '2018-09-27 08:11:23', 1, 5, 11, 1, '0.00', '0.00', 0, 0),
(6, '2018-09-27 16:11:23', '2018-09-27 08:11:23', 1, 6, 2, 1, '15.00', '15.00', 0, 0),
(7, '2018-09-27 16:11:23', '2018-09-27 08:11:23', 1, 7, 1, 1, '60.00', '60.00', 0, 0),
(8, '2018-09-27 17:26:25', '2018-09-27 09:26:25', 2, 8, 6, 1, '15.00', '15.00', 0, 0),
(9, '2018-09-27 17:26:25', '2018-09-27 09:26:25', 2, 9, 7, 1, '15.00', '15.00', 0, 0),
(10, '2018-09-27 17:26:25', '2018-09-27 09:26:25', 2, 10, 8, 1, '15.00', '15.00', 0, 0),
(11, '2018-09-27 17:26:25', '2018-09-27 09:26:25', 2, 11, 12, 1, '3.00', '3.00', 0, 0),
(12, '2018-09-27 17:26:25', '2018-09-27 09:26:25', 2, 12, 2, 1, '15.00', '15.00', 0, 0),
(13, '2018-09-27 17:26:25', '2018-09-27 09:26:25', 2, 13, 1, 1, '60.00', '60.00', 0, 0),
(14, '2018-09-27 17:26:25', '2018-09-27 09:26:25', 2, 14, 2, 1, '15.00', '15.00', 0, 0),
(15, '2018-09-27 17:26:25', '2018-09-27 09:26:25', 2, 15, 1, 1, '60.00', '60.00', 0, 0),
(16, '2018-09-27 17:27:42', '2018-09-27 09:27:42', 3, 16, 6, 2, '15.00', '30.00', 0, 0),
(17, '2018-09-27 17:27:42', '2018-09-27 09:27:42', 3, 17, 7, 2, '15.00', '30.00', 0, 0),
(18, '2018-09-27 17:27:42', '2018-09-27 09:27:42', 3, 18, 8, 2, '15.00', '30.00', 0, 0),
(19, '2018-09-27 17:27:42', '2018-09-27 09:27:42', 3, 19, 12, 2, '3.00', '6.00', 0, 0),
(20, '2018-09-27 17:27:42', '2018-09-27 09:27:42', 3, 20, 11, 2, '0.00', '0.00', 0, 0),
(21, '2018-09-27 17:27:42', '2018-09-27 09:27:42', 3, 21, 2, 2, '15.00', '30.00', 0, 0),
(22, '2018-09-27 17:27:42', '2018-09-27 09:27:42', 3, 22, 1, 2, '60.00', '120.00', 0, 0),
(23, '2018-09-27 17:28:24', '2018-09-27 09:28:24', 4, 23, 6, 1, '15.00', '15.00', 0, 0),
(24, '2018-09-27 17:32:49', '2018-09-27 09:32:49', 5, 24, 6, 1, '15.00', '15.00', 0, 0),
(25, '2018-09-27 17:33:54', '2018-09-27 09:33:54', 6, 25, 6, 1, '15.00', '15.00', 0, 0),
(26, '2018-09-27 17:35:13', '2018-09-27 09:35:13', 7, 26, 6, 1, '15.00', '15.00', 0, 0),
(27, '2018-09-27 17:36:20', '2018-09-27 09:36:20', 8, 27, 7, 2, '15.00', '30.00', 0, 0),
(28, '2018-09-27 17:38:44', '2018-09-27 09:38:44', 9, 28, 8, 2, '15.00', '30.00', 0, 0),
(29, '2018-09-27 17:39:28', '2018-09-27 09:39:28', 10, 29, 6, 1, '15.00', '15.00', 0, 0),
(30, '2018-09-27 17:39:28', '2018-09-27 09:39:28', 10, 30, 7, 1, '15.00', '15.00', 0, 0),
(31, '2018-09-27 17:39:28', '2018-09-27 09:39:28', 10, 31, 8, 1, '15.00', '15.00', 0, 0),
(32, '2018-09-27 17:39:45', '2018-09-27 09:39:45', 11, 32, 6, 1, '15.00', '15.00', 0, 0),
(33, '2018-09-27 17:39:45', '2018-09-27 09:39:45', 11, 33, 7, 1, '15.00', '15.00', 0, 0),
(34, '2018-09-27 17:39:45', '2018-09-27 09:39:45', 11, 34, 8, 1, '15.00', '15.00', 0, 0),
(35, '2018-09-27 17:41:12', '2018-09-27 09:41:12', 12, 35, 7, 1, '15.00', '15.00', 0, 0),
(36, '2018-09-27 17:41:12', '2018-09-27 09:41:12', 12, 36, 8, 1, '15.00', '15.00', 0, 0),
(37, '2018-09-27 17:42:14', '2018-09-27 09:42:14', 13, 37, 8, 1, '15.00', '15.00', 0, 0),
(38, '2018-09-27 17:46:17', '2018-09-27 09:46:17', 14, 38, 7, 1, '15.00', '15.00', 0, 0),
(39, '2018-09-27 17:49:33', '2018-09-27 09:49:33', 15, 39, 6, 1, '15.00', '15.00', 0, 0),
(40, '2018-09-27 17:54:48', '2018-09-27 09:54:48', 16, 40, 6, 1, '15.00', '15.00', 0, 0),
(41, '2018-09-27 17:54:48', '2018-09-27 09:54:48', 16, 41, 7, 1, '15.00', '15.00', 0, 0),
(42, '2018-09-27 17:54:48', '2018-09-27 09:54:48', 16, 42, 8, 1, '15.00', '15.00', 0, 0),
(43, '2018-10-08 16:27:24', '2018-10-08 08:27:24', 17, 45, 11, 1, '0.00', '0.00', 0, 0),
(44, '2018-10-08 16:27:24', '2018-10-08 08:27:24', 17, 46, 2, 1, '15.00', '15.00', 0, 0),
(45, '2018-10-08 16:27:24', '2018-10-08 08:27:24', 17, 47, 1, 1, '60.00', '60.00', 0, 0),
(46, '2018-10-08 17:45:13', '2018-10-08 09:45:13', 18, 48, 2, 1, '15.00', '15.00', 0, 0),
(47, '2018-10-08 17:45:13', '2018-10-08 09:45:13', 18, 49, 1, 1, '60.00', '60.00', 0, 0),
(48, '2018-10-08 18:05:01', '2018-10-08 10:05:01', 19, 50, 2, 1, '15.00', '15.00', 0, 0),
(49, '2018-10-08 18:05:01', '2018-10-08 10:05:01', 19, 51, 1, 1, '60.00', '60.00', 0, 0),
(50, '2018-10-08 18:05:39', '2018-10-08 10:05:39', 20, 52, 2, 1, '15.00', '15.00', 0, 0),
(51, '2018-10-08 18:05:39', '2018-10-08 10:05:39', 20, 53, 1, 1, '60.00', '60.00', 0, 0),
(52, '2018-10-08 18:07:06', '2018-10-08 10:07:06', 21, 54, 1, 1, '60.00', '60.00', 0, 0),
(53, '2018-10-08 18:07:06', '2018-10-08 10:07:06', 21, 55, 2, 1, '15.00', '15.00', 0, 0),
(54, '2018-10-08 18:09:54', '2018-10-08 10:09:54', 22, 56, 12, 2, '3.00', '6.00', 0, 0),
(55, '2018-10-08 18:09:54', '2018-10-08 10:09:54', 22, 57, 12, 2, '3.00', '6.00', 0, 0),
(56, '2018-10-08 18:09:54', '2018-10-08 10:09:54', 22, 58, 7, 2, '15.00', '30.00', 0, 0),
(57, '2018-10-08 18:09:54', '2018-10-08 10:09:54', 22, 59, 2, 2, '15.00', '30.00', 0, 0),
(58, '2018-10-08 18:09:54', '2018-10-08 10:09:54', 22, 60, 1, 2, '60.00', '120.00', 0, 0),
(59, '2018-10-08 18:10:12', '2018-10-08 10:10:12', 23, 61, 2, 1, '15.00', '15.00', 0, 0),
(60, '2018-10-08 18:10:12', '2018-10-08 10:10:12', 23, 62, 1, 1, '60.00', '60.00', 0, 0),
(61, '2018-10-08 21:14:08', '2018-10-08 13:14:08', 24, 63, 2, 1, '15.00', '15.00', 0, 0),
(62, '2018-10-08 21:14:08', '2018-10-08 13:14:08', 24, 64, 1, 1, '60.00', '60.00', 0, 0),
(63, '2018-10-08 21:20:15', '2018-10-08 13:20:15', 25, 65, 12, 2, '3.00', '6.00', 0, 0),
(64, '2018-10-08 21:20:15', '2018-10-08 13:20:15', 25, 66, 8, 2, '15.00', '30.00', 0, 0),
(65, '2018-10-08 21:20:15', '2018-10-08 13:20:15', 25, 67, 7, 2, '15.00', '30.00', 0, 0),
(66, '2018-10-08 21:20:15', '2018-10-08 13:20:15', 25, 68, 6, 2, '15.00', '30.00', 0, 0),
(67, '2018-10-08 21:20:15', '2018-10-08 13:20:15', 25, 69, 1, 2, '60.00', '120.00', 0, 0),
(68, '2018-10-08 21:20:15', '2018-10-08 13:20:15', 25, 70, 1, 2, '60.00', '120.00', 0, 0),
(69, '2018-10-08 21:22:15', '2018-10-08 13:22:15', 26, 71, 2, 1, '15.00', '15.00', 0, 0),
(70, '2018-10-08 21:22:15', '2018-10-08 13:22:15', 26, 72, 1, 1, '60.00', '60.00', 0, 0),
(71, '2018-10-08 21:23:17', '2018-10-08 13:23:17', 27, 73, 2, 1, '15.00', '15.00', 0, 0),
(72, '2018-10-08 21:23:17', '2018-10-08 13:23:17', 27, 74, 1, 2, '60.00', '120.00', 0, 0),
(73, '2018-10-08 21:26:29', '2018-10-08 13:26:29', 28, 75, 2, 1, '15.00', '15.00', 0, 0),
(74, '2018-10-08 21:26:29', '2018-10-08 13:26:29', 28, 76, 1, 1, '60.00', '60.00', 0, 0),
(75, '2018-10-08 21:28:37', '2018-10-08 13:28:37', 29, 77, 2, 1, '15.00', '15.00', 0, 0),
(76, '2018-10-08 21:28:37', '2018-10-08 13:28:37', 29, 78, 1, 1, '60.00', '60.00', 0, 0),
(77, '2018-10-08 21:31:37', '2018-10-08 13:31:37', 30, 79, 2, 1, '15.00', '15.00', 0, 0),
(78, '2018-10-08 21:31:37', '2018-10-08 13:31:37', 30, 80, 1, 1, '60.00', '60.00', 0, 0),
(79, '2018-10-08 21:36:46', '2018-10-08 13:36:46', 31, 81, 2, 1, '15.00', '15.00', 0, 0),
(80, '2018-10-08 21:36:46', '2018-10-08 13:36:46', 31, 82, 1, 1, '60.00', '60.00', 0, 0),
(81, '2018-10-08 21:38:41', '2018-10-08 13:38:41', 32, 83, 2, 1, '15.00', '15.00', 0, 0),
(82, '2018-10-08 21:38:41', '2018-10-08 13:38:41', 32, 84, 1, 1, '60.00', '60.00', 0, 0),
(83, '2018-10-08 21:39:22', '2018-10-08 13:39:22', 33, 85, 2, 1, '15.00', '15.00', 0, 0),
(84, '2018-10-08 21:39:22', '2018-10-08 13:39:22', 33, 86, 1, 1, '60.00', '60.00', 0, 0),
(85, '2018-10-09 22:26:59', '2018-10-09 14:26:59', 34, 87, 1, 1, '60.00', '60.00', 0, 0),
(86, '2018-10-09 22:26:59', '2018-10-09 14:26:59', 34, 88, 2, 1, '15.00', '15.00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pos_payment_headers`
--

CREATE TABLE `pos_payment_headers` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date` date NOT NULL,
  `payment_type_id` int(11) NOT NULL DEFAULT '0',
  `ref_no` varchar(20) NOT NULL,
  `or_no` varchar(20) NOT NULL,
  `branch_id` int(11) NOT NULL COMMENT 'refd to branches.id',
  `client_id` int(11) NOT NULL COMMENT 'refd to clients.id',
  `employee_id` int(11) NOT NULL COMMENT 'refd to employees.id',
  `customer_id` int(11) NOT NULL COMMENT 'refd to customers.id',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `payable` decimal(12,2) NOT NULL DEFAULT '0.00',
  `amount_cash` decimal(12,2) NOT NULL DEFAULT '0.00',
  `amount_card` decimal(12,2) DEFAULT '0.00',
  `amount_points` decimal(12,2) DEFAULT '0.00',
  `points` int(11) DEFAULT '0',
  `discount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `tax` decimal(12,2) NOT NULL DEFAULT '0.00',
  `amount_net` decimal(12,2) NOT NULL DEFAULT '0.00',
  `is_email_sent` tinyint(1) NOT NULL DEFAULT '0',
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_payment_headers`
--

INSERT INTO `pos_payment_headers` (`id`, `created_at`, `updated_at`, `date`, `payment_type_id`, `ref_no`, `or_no`, `branch_id`, `client_id`, `employee_id`, `customer_id`, `quantity`, `payable`, `amount_cash`, `amount_card`, `amount_points`, `points`, `discount`, `tax`, `amount_net`, `is_email_sent`, `is_sync`, `is_deleted`) VALUES
(1, '2018-09-27 16:11:23', '2018-09-27 08:11:23', '2018-09-27', 1, '0000001', '0001', 1, 1, 3, 5, 7, '123.00', '123.00', '0.00', '0.00', 0, '0.00', '0.00', '123.00', 0, 0, 0),
(2, '2018-09-27 17:26:25', '2018-09-27 09:26:25', '2018-09-27', 1, '0000002', '0002', 1, 1, 3, 5, 8, '198.00', '0.00', '198.00', '0.00', 0, '0.00', '0.00', '198.00', 0, 0, 0),
(3, '2018-09-27 17:27:42', '2018-09-27 09:27:42', '2018-09-27', 1, '0000003', '0003', 1, 1, 3, 5, 14, '246.00', '0.00', '246.00', '0.00', 0, '0.00', '0.00', '246.00', 0, 0, 0),
(4, '2018-09-27 17:28:24', '2018-09-27 09:28:24', '2018-09-27', 1, '0000004', '0004', 1, 1, 3, 5, 1, '15.00', '15.00', '0.00', '0.00', 0, '0.00', '0.00', '15.00', 0, 0, 0),
(5, '2018-09-27 17:32:49', '2018-09-27 09:32:49', '2018-09-27', 1, '0000005', '0005', 1, 1, 3, 5, 1, '15.00', '15.00', '0.00', '0.00', 0, '0.00', '0.00', '15.00', 0, 0, 0),
(6, '2018-09-27 17:33:54', '2018-09-27 09:33:54', '2018-09-27', 1, '0000006', '0006', 1, 1, 3, 5, 1, '15.00', '15.00', '0.00', '0.00', 0, '0.00', '0.00', '15.00', 0, 0, 0),
(7, '2018-09-27 17:35:13', '2018-09-27 09:35:13', '2018-09-27', 1, '0000007', '0007', 1, 1, 3, 5, 1, '15.00', '15.00', '0.00', '0.00', 0, '0.00', '0.00', '15.00', 0, 0, 0),
(8, '2018-09-27 17:36:20', '2018-09-27 09:36:20', '2018-09-27', 1, '0000008', '0008', 1, 1, 3, 5, 2, '30.00', '30.00', '0.00', '0.00', 0, '0.00', '0.00', '30.00', 0, 0, 0),
(9, '2018-09-27 17:38:44', '2018-09-27 09:38:44', '2018-09-27', 1, '0000009', '0009', 1, 1, 3, 5, 2, '30.00', '30.00', '0.00', '0.00', 0, '0.00', '0.00', '30.00', 0, 0, 0),
(10, '2018-09-27 17:39:28', '2018-09-27 09:39:28', '2018-09-27', 1, '0000010', '0010', 1, 1, 3, 5, 3, '45.00', '45.00', '0.00', '0.00', 0, '0.00', '0.00', '45.00', 0, 0, 0),
(11, '2018-09-27 17:39:45', '2018-09-27 09:39:45', '2018-09-27', 1, '0000011', '0011', 1, 1, 3, 5, 3, '45.00', '45.00', '0.00', '0.00', 0, '0.00', '0.00', '45.00', 0, 0, 0),
(12, '2018-09-27 17:41:12', '2018-09-27 09:41:12', '2018-09-27', 1, '0000012', '0012', 1, 1, 3, 5, 2, '30.00', '30.00', '0.00', '0.00', 0, '0.00', '0.00', '30.00', 0, 0, 0),
(13, '2018-09-27 17:42:14', '2018-09-27 09:42:14', '2018-09-27', 1, '0000013', '0013', 1, 1, 3, 5, 1, '15.00', '15.00', '0.00', '0.00', 0, '0.00', '0.00', '15.00', 0, 0, 0),
(14, '2018-09-27 17:46:17', '2018-09-27 09:46:17', '2018-09-27', 1, '0000014', '0014', 1, 1, 3, 5, 1, '15.00', '15.00', '0.00', '0.00', 0, '0.00', '0.00', '15.00', 0, 0, 0),
(15, '2018-09-27 17:49:33', '2018-09-27 09:49:33', '2018-09-27', 1, '0000015', '0015', 1, 1, 3, 5, 1, '15.00', '15.00', '0.00', '0.00', 0, '0.00', '0.00', '15.00', 0, 0, 0),
(16, '2018-09-27 17:54:48', '2018-09-27 09:54:48', '2018-09-27', 1, '0000016', '0016', 1, 1, 1, 6, 3, '45.00', '0.00', '45.00', '0.00', 0, '0.00', '0.00', '45.00', 0, 0, 0),
(17, '2018-10-08 16:27:24', '2018-10-08 08:27:24', '2018-10-08', 1, '0000017', '0017', 1, 1, 1, 1, 3, '75.00', '65.00', '0.00', '0.00', 0, '0.00', '0.00', '65.00', 0, 0, 0),
(18, '2018-10-08 17:45:13', '2018-10-08 09:45:13', '2018-10-08', 1, '0000018', '0018', 1, 1, 3, 1, 2, '75.00', '75.00', '0.00', '0.00', 0, '0.00', '0.00', '75.00', 0, 0, 0),
(19, '2018-10-08 18:05:01', '2018-10-08 10:05:01', '2018-10-08', 1, '0000019', '0019', 1, 1, 3, 1, 2, '75.00', '75.00', '0.00', '0.00', 0, '0.00', '0.00', '75.00', 0, 0, 0),
(20, '2018-10-08 18:05:39', '2018-10-08 10:05:39', '2018-10-08', 1, '0000020', '0020', 1, 1, 3, 1, 2, '75.00', '75.00', '0.00', '0.00', 0, '0.00', '0.00', '75.00', 0, 0, 0),
(21, '2018-10-08 18:07:06', '2018-10-08 10:07:06', '2018-10-08', 1, '0000021', '0021', 1, 1, 3, 1, 2, '75.00', '75.00', '0.00', '0.00', 0, '0.00', '0.00', '75.00', 0, 0, 0),
(22, '2018-10-08 18:09:54', '2018-10-08 10:09:54', '2018-10-08', 1, '0000022', '0022', 1, 1, 3, 1, 10, '192.00', '192.00', '0.00', '0.00', 0, '0.00', '0.00', '192.00', 0, 0, 0),
(23, '2018-10-08 18:10:12', '2018-10-08 10:10:12', '2018-10-08', 1, '0000023', '0023', 1, 1, 3, 2, 2, '75.00', '75.00', '0.00', '0.00', 0, '10.00', '0.00', '85.00', 0, 0, 0),
(24, '2018-10-08 21:14:08', '2018-10-08 13:14:08', '2018-10-08', 1, '0000024', '0024', 1, 1, 3, 1, 2, '75.00', '65.00', '0.00', '0.00', 0, '10.00', '0.00', '75.00', 0, 0, 0),
(25, '2018-10-08 21:20:15', '2018-10-08 13:20:15', '2018-10-08', 1, '0000025', '0025', 1, 1, 3, 1, 12, '336.00', '336.00', '0.00', '0.00', 0, '20.00', '0.00', '356.00', 0, 0, 0),
(26, '2018-10-08 21:22:15', '2018-10-08 13:22:15', '2018-10-08', 1, '0000026', '0026', 1, 1, 3, 1, 2, '75.00', '75.00', '0.00', '0.00', 0, '10.00', '0.00', '85.00', 0, 0, 0),
(27, '2018-10-08 21:23:17', '2018-10-08 13:23:17', '2018-10-08', 1, '0000027', '0027', 1, 1, 3, 1, 3, '135.00', '135.00', '0.00', '0.00', 0, '20.00', '0.00', '155.00', 0, 0, 0),
(28, '2018-10-08 21:26:29', '2018-10-08 13:26:29', '2018-10-08', 1, '0000028', '0028', 1, 1, 3, 2, 2, '75.00', '75.00', '0.00', '0.00', 0, '10.00', '0.00', '85.00', 0, 0, 0),
(29, '2018-10-08 21:28:37', '2018-10-08 13:28:37', '2018-10-08', 1, '0000029', '0029', 1, 1, 3, 1, 2, '75.00', '75.00', '0.00', '0.00', 0, '10.00', '0.00', '85.00', 0, 0, 0),
(30, '2018-10-08 21:31:37', '2018-10-08 13:31:37', '2018-10-08', 1, '0000030', '0030', 1, 1, 3, 1, 2, '75.00', '75.00', '0.00', '0.00', 0, '10.00', '0.00', '85.00', 0, 0, 0),
(31, '2018-10-08 21:36:46', '2018-10-08 13:36:46', '2018-10-08', 1, '0000031', '0031', 1, 1, 1, 1, 2, '75.00', '75.00', '0.00', '0.00', 0, '10.00', '0.00', '85.00', 0, 0, 0),
(32, '2018-10-08 21:38:41', '2018-10-08 13:38:41', '2018-10-08', 1, '0000032', '0032', 1, 1, 1, 1, 2, '75.00', '65.00', '0.00', '0.00', 0, '10.00', '0.00', '75.00', 0, 0, 0),
(33, '2018-10-08 21:39:22', '2018-10-08 13:39:22', '2018-10-08', 1, '0000033', '0033', 1, 1, 1, 1, 2, '75.00', '65.00', '0.00', '0.00', 0, '10.00', '0.00', '75.00', 0, 0, 0),
(34, '2018-10-09 22:26:59', '2018-10-09 14:26:59', '2018-10-09', 1, '0000034', '0034', 1, 1, 3, 1, 2, '75.00', '65.00', '0.00', '0.00', 0, '10.00', '0.00', '75.00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pos_transactions`
--

CREATE TABLE `pos_transactions` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `trans_date` date NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `cust_id` int(11) NOT NULL COMMENT 'refd to customers.id',
  `branch_id` int(11) NOT NULL COMMENT 'refd to branches.id',
  `client_id` int(11) NOT NULL COMMENT 'ref to clients',
  `inv_id` int(11) NOT NULL COMMENT 'ref to inventories.id',
  `transaction_id` int(11) NOT NULL COMMENT 'ref to transactions.id',
  `transaction_name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `amount_net` decimal(12,2) NOT NULL,
  `balance` decimal(12,2) DEFAULT NULL,
  `user_id` int(11) NOT NULL COMMENT 'ref to users.id',
  `is_fully_paid` int(11) DEFAULT '2' COMMENT '1=paid; 2=unpaid',
  `is_inventory` tinyint(1) DEFAULT NULL COMMENT '1=inventory; 2=services',
  `remarks` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL,
  `is_saved` tinyint(1) DEFAULT '0' COMMENT 'transactions on pos cannot be modified once saved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pos_transactions`
--

INSERT INTO `pos_transactions` (`id`, `created_at`, `updated_at`, `trans_date`, `ref_no`, `cust_id`, `branch_id`, `client_id`, `inv_id`, `transaction_id`, `transaction_name`, `qty`, `price`, `amount_net`, `balance`, `user_id`, `is_fully_paid`, `is_inventory`, `remarks`, `is_deleted`, `deleted_by`, `is_saved`) VALUES
(1, '2018-09-27 16:10:25', '2018-09-27 08:10:25', '2018-09-27', '0001', 5, 1, 1, 6, 1, 'Ariel', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(2, '2018-09-27 16:10:27', '2018-09-27 08:10:27', '2018-09-27', '0002', 5, 1, 1, 7, 1, 'Breeze', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(3, '2018-09-27 16:10:29', '2018-09-27 08:10:29', '2018-09-27', '0003', 5, 1, 1, 8, 1, 'Downy', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(4, '2018-09-27 16:10:31', '2018-09-27 08:10:31', '2018-09-27', '0004', 5, 1, 1, 12, 1, 'Laundry Plastic', 1, '3.00', '3.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(5, '2018-09-27 16:10:34', '2018-09-27 08:10:34', '2018-09-27', '0005', 5, 1, 1, 11, 1, 'Promo Wash (FREE)', 1, '0.00', '0.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(6, '2018-09-27 16:10:36', '2018-09-27 08:10:36', '2018-09-27', '0006', 5, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(7, '2018-09-27 16:10:40', '2018-09-27 08:10:40', '2018-09-27', '0007', 5, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(8, '2018-09-27 16:54:36', '2018-09-27 08:54:36', '2018-09-27', '0008', 5, 1, 1, 6, 1, 'Ariel', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(9, '2018-09-27 16:54:37', '2018-09-27 08:54:37', '2018-09-27', '0009', 5, 1, 1, 7, 1, 'Breeze', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(10, '2018-09-27 16:54:40', '2018-09-27 08:54:40', '2018-09-27', '0010', 5, 1, 1, 8, 1, 'Downy', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(11, '2018-09-27 16:54:42', '2018-09-27 08:54:42', '2018-09-27', '0011', 5, 1, 1, 12, 1, 'Laundry Plastic', 1, '3.00', '3.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(12, '2018-09-27 16:54:45', '2018-09-27 08:54:45', '2018-09-27', '0012', 5, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(13, '2018-09-27 16:54:48', '2018-09-27 08:54:48', '2018-09-27', '0013', 5, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(14, '2018-09-27 16:54:52', '2018-09-27 08:54:52', '2018-09-27', '0014', 5, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(15, '2018-09-27 16:54:56', '2018-09-27 08:54:56', '2018-09-27', '0015', 5, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(16, '2018-09-27 17:27:21', '2018-09-27 09:27:21', '2018-09-27', '0016', 5, 1, 1, 6, 1, 'Ariel', 2, '15.00', '30.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(17, '2018-09-27 17:27:22', '2018-09-27 09:27:22', '2018-09-27', '0017', 5, 1, 1, 7, 1, 'Breeze', 2, '15.00', '30.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(18, '2018-09-27 17:27:24', '2018-09-27 09:27:24', '2018-09-27', '0018', 5, 1, 1, 8, 1, 'Downy', 2, '15.00', '30.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(19, '2018-09-27 17:27:25', '2018-09-27 09:27:25', '2018-09-27', '0019', 5, 1, 1, 12, 1, 'Laundry Plastic', 2, '3.00', '6.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(20, '2018-09-27 17:27:29', '2018-09-27 09:27:29', '2018-09-27', '0020', 5, 1, 1, 11, 1, 'Promo Wash (FREE)', 2, '0.00', '0.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(21, '2018-09-27 17:27:30', '2018-09-27 09:27:30', '2018-09-27', '0021', 5, 1, 1, 2, 1, 'Regular Dry', 2, '15.00', '30.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(22, '2018-09-27 17:27:32', '2018-09-27 09:27:32', '2018-09-27', '0022', 5, 1, 1, 1, 1, 'Regular Wash', 2, '60.00', '120.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(23, '2018-09-27 17:28:12', '2018-09-27 09:28:12', '2018-09-27', '0023', 5, 1, 1, 6, 1, 'Ariel', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(24, '2018-09-27 17:32:44', '2018-09-27 09:32:44', '2018-09-27', '0024', 5, 1, 1, 6, 1, 'Ariel', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(25, '2018-09-27 17:33:50', '2018-09-27 09:33:50', '2018-09-27', '0025', 5, 1, 1, 6, 1, 'Ariel', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(26, '2018-09-27 17:35:08', '2018-09-27 09:35:08', '2018-09-27', '0026', 5, 1, 1, 6, 1, 'Ariel', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(27, '2018-09-27 17:36:16', '2018-09-27 09:36:16', '2018-09-27', '0027', 5, 1, 1, 7, 1, 'Breeze', 2, '15.00', '30.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(28, '2018-09-27 17:38:36', '2018-09-27 09:38:36', '2018-09-27', '0028', 5, 1, 1, 8, 1, 'Downy', 2, '15.00', '30.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(29, '2018-09-27 17:39:21', '2018-09-27 09:39:21', '2018-09-27', '0029', 5, 1, 1, 6, 1, 'Ariel', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(30, '2018-09-27 17:39:23', '2018-09-27 09:39:23', '2018-09-27', '0030', 5, 1, 1, 7, 1, 'Breeze', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(31, '2018-09-27 17:39:24', '2018-09-27 09:39:24', '2018-09-27', '0031', 5, 1, 1, 8, 1, 'Downy', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(32, '2018-09-27 17:39:39', '2018-09-27 09:39:39', '2018-09-27', '0032', 5, 1, 1, 6, 1, 'Ariel', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(33, '2018-09-27 17:39:41', '2018-09-27 09:39:41', '2018-09-27', '0033', 5, 1, 1, 7, 1, 'Breeze', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(34, '2018-09-27 17:39:42', '2018-09-27 09:39:42', '2018-09-27', '0034', 5, 1, 1, 8, 1, 'Downy', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(35, '2018-09-27 17:41:06', '2018-09-27 09:41:06', '2018-09-27', '0035', 5, 1, 1, 7, 1, 'Breeze', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(36, '2018-09-27 17:41:09', '2018-09-27 09:41:09', '2018-09-27', '0036', 5, 1, 1, 8, 1, 'Downy', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(37, '2018-09-27 17:42:06', '2018-09-27 09:42:06', '2018-09-27', '0037', 5, 1, 1, 8, 1, 'Downy', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(38, '2018-09-27 17:46:12', '2018-09-27 09:46:12', '2018-09-27', '0038', 5, 1, 1, 7, 1, 'Breeze', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(39, '2018-09-27 17:49:29', '2018-09-27 09:49:29', '2018-09-27', '0039', 5, 1, 1, 6, 1, 'Ariel', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(40, '2018-09-27 17:54:22', '2018-09-27 09:54:22', '2018-09-27', '0040', 6, 1, 1, 6, 1, 'Ariel', 1, '15.00', '15.00', '0.00', 3, 1, 1, '', 0, NULL, 1),
(41, '2018-09-27 17:54:25', '2018-09-27 09:54:25', '2018-09-27', '0041', 6, 1, 1, 7, 1, 'Breeze', 1, '15.00', '15.00', '0.00', 3, 1, 1, '', 0, NULL, 1),
(42, '2018-09-27 17:54:26', '2018-09-27 09:54:26', '2018-09-27', '0042', 6, 1, 1, 8, 1, 'Downy', 1, '15.00', '15.00', '0.00', 3, 1, 1, '', 0, NULL, 1),
(43, '2018-09-27 18:00:38', '2018-09-27 10:00:38', '2018-09-27', '0043', 5, 1, 1, 6, 1, 'Ariel', 5, '15.00', '75.00', '75.00', 3, 0, 1, '', 0, NULL, 1),
(44, '2018-09-27 18:01:31', '2018-09-27 10:01:31', '2018-09-27', '0044', 5, 1, 1, 7, 1, 'Breeze', 3, '15.00', '45.00', '45.00', 3, 0, 1, '', 0, NULL, 1),
(45, '2018-10-08 13:48:27', '2018-10-08 05:48:27', '2018-10-08', '0045', 1, 1, 1, 11, 1, 'Promo Wash (FREE)', 1, '0.00', '0.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(46, '2018-10-08 13:48:29', '2018-10-08 05:48:29', '2018-10-08', '0046', 1, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(47, '2018-10-08 13:48:32', '2018-10-08 05:48:32', '2018-10-08', '0047', 1, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '10.00', 2, 1, 1, '', 0, NULL, 1),
(48, '2018-10-08 17:44:51', '2018-10-08 09:44:51', '2018-10-08', '0048', 1, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(49, '2018-10-08 17:44:53', '2018-10-08 09:44:53', '2018-10-08', '0049', 1, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(50, '2018-10-08 18:01:30', '2018-10-08 10:01:30', '2018-10-08', '0050', 1, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(51, '2018-10-08 18:01:32', '2018-10-08 10:01:32', '2018-10-08', '0051', 1, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(52, '2018-10-08 18:05:27', '2018-10-08 10:05:27', '2018-10-08', '0052', 1, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(53, '2018-10-08 18:05:29', '2018-10-08 10:05:29', '2018-10-08', '0053', 1, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(54, '2018-10-08 18:06:55', '2018-10-08 10:06:55', '2018-10-08', '0054', 1, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(55, '2018-10-08 18:06:56', '2018-10-08 10:06:56', '2018-10-08', '0055', 1, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(56, '2018-10-08 18:09:06', '2018-10-08 10:09:06', '2018-10-08', '0056', 1, 1, 1, 12, 1, 'Laundry Plastic', 2, '3.00', '6.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(57, '2018-10-08 18:09:10', '2018-10-08 10:09:10', '2018-10-08', '0057', 1, 1, 1, 12, 1, 'Laundry Plastic', 2, '3.00', '6.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(58, '2018-10-08 18:09:14', '2018-10-08 10:09:14', '2018-10-08', '0058', 1, 1, 1, 7, 1, 'Breeze', 2, '15.00', '30.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(59, '2018-10-08 18:09:18', '2018-10-08 10:09:18', '2018-10-08', '0059', 1, 1, 1, 2, 1, 'Regular Dry', 2, '15.00', '30.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(60, '2018-10-08 18:09:20', '2018-10-08 10:09:20', '2018-10-08', '0060', 1, 1, 1, 1, 1, 'Regular Wash', 2, '60.00', '120.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(61, '2018-10-08 18:10:03', '2018-10-08 10:10:03', '2018-10-08', '0061', 2, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(62, '2018-10-08 18:10:05', '2018-10-08 10:10:05', '2018-10-08', '0062', 2, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(63, '2018-10-08 21:13:33', '2018-10-08 13:13:33', '2018-10-08', '0063', 1, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(64, '2018-10-08 21:13:35', '2018-10-08 13:13:35', '2018-10-08', '0064', 1, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '10.00', 2, 1, 1, '', 0, NULL, 1),
(65, '2018-10-08 21:19:46', '2018-10-08 13:19:46', '2018-10-08', '0065', 1, 1, 1, 12, 1, 'Laundry Plastic', 2, '3.00', '6.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(66, '2018-10-08 21:19:47', '2018-10-08 13:19:47', '2018-10-08', '0066', 1, 1, 1, 8, 1, 'Downy', 2, '15.00', '30.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(67, '2018-10-08 21:19:48', '2018-10-08 13:19:48', '2018-10-08', '0067', 1, 1, 1, 7, 1, 'Breeze', 2, '15.00', '30.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(68, '2018-10-08 21:19:52', '2018-10-08 13:19:52', '2018-10-08', '0068', 1, 1, 1, 6, 1, 'Ariel', 2, '15.00', '30.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(69, '2018-10-08 21:19:56', '2018-10-08 13:19:56', '2018-10-08', '0069', 1, 1, 1, 1, 1, 'Regular Wash', 2, '60.00', '120.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(70, '2018-10-08 21:19:57', '2018-10-08 13:19:57', '2018-10-08', '0070', 1, 1, 1, 1, 1, 'Regular Wash', 2, '60.00', '120.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(71, '2018-10-08 21:22:03', '2018-10-08 13:22:03', '2018-10-08', '0071', 1, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(72, '2018-10-08 21:22:05', '2018-10-08 13:22:05', '2018-10-08', '0072', 1, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(73, '2018-10-08 21:22:58', '2018-10-08 13:22:58', '2018-10-08', '0073', 1, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(74, '2018-10-08 21:23:01', '2018-10-08 13:23:01', '2018-10-08', '0074', 1, 1, 1, 1, 1, 'Regular Wash', 2, '60.00', '120.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(75, '2018-10-08 21:26:17', '2018-10-08 13:26:17', '2018-10-08', '0075', 2, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(76, '2018-10-08 21:26:19', '2018-10-08 13:26:19', '2018-10-08', '0076', 2, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(77, '2018-10-08 21:28:24', '2018-10-08 13:28:24', '2018-10-08', '0077', 1, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(78, '2018-10-08 21:28:26', '2018-10-08 13:28:26', '2018-10-08', '0078', 1, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(79, '2018-10-08 21:29:14', '2018-10-08 13:29:14', '2018-10-08', '0079', 1, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(80, '2018-10-08 21:29:16', '2018-10-08 13:29:16', '2018-10-08', '0080', 1, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(81, '2018-10-08 21:36:33', '2018-10-08 13:36:33', '2018-10-08', '0081', 1, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 3, 1, 1, '', 0, NULL, 1),
(82, '2018-10-08 21:36:35', '2018-10-08 13:36:35', '2018-10-08', '0082', 1, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '0.00', 3, 1, 1, '', 0, NULL, 1),
(83, '2018-10-08 21:38:28', '2018-10-08 13:38:28', '2018-10-08', '0083', 1, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 3, 1, 1, '', 0, NULL, 1),
(84, '2018-10-08 21:38:30', '2018-10-08 13:38:30', '2018-10-07', '0084', 1, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '10.00', 3, 1, 1, '', 0, NULL, 1),
(85, '2018-10-08 21:39:11', '2018-10-08 13:39:11', '2018-10-07', '0085', 1, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '0.00', 3, 1, 1, '', 0, NULL, 1),
(86, '2018-10-08 21:39:12', '2018-10-08 13:39:12', '2018-10-07', '0086', 1, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '10.00', 3, 1, 1, '', 0, NULL, 1),
(87, '2018-10-09 22:25:07', '2018-10-09 14:25:07', '2018-10-09', '0087', 1, 1, 1, 1, 1, 'Regular Wash', 1, '60.00', '60.00', '0.00', 2, 1, 1, '', 0, NULL, 1),
(88, '2018-10-09 22:25:10', '2018-10-09 14:25:10', '2018-10-09', '0088', 1, 1, 1, 2, 1, 'Regular Dry', 1, '15.00', '15.00', '10.00', 2, 1, 1, '', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date` date DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL COMMENT 'refd to suppliers.id',
  `received_by_empid` varchar(11) DEFAULT NULL COMMENT 'refd to employee.id',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to users.id',
  `inv_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to inventories.id',
  `qty` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `expenses_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `client_id` int(11) DEFAULT NULL COMMENT 'ref to clients.id',
  `branch_id` int(11) DEFAULT NULL COMMENT 'ref to branches.id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `created_at`, `updated_at`, `date`, `supplier_id`, `received_by_empid`, `user_id`, `inv_id`, `qty`, `price`, `total`, `expenses_id`, `is_deleted`, `client_id`, `branch_id`) VALUES
(1, '2018-09-26 20:54:12', '2018-09-26 12:54:12', '2018-09-26', 1, '', 3, 8, 144, '6.65', '957.60', 1, 0, 1, 1),
(2, '2018-09-27 16:09:19', '2018-09-27 08:09:19', '2018-09-27', 1, '1', 2, 6, 100, '10.00', '1000.00', 2, 0, 1, 1),
(3, '2018-09-27 16:09:42', '2018-09-27 08:09:42', '2018-09-27', 1, '1', 2, 7, 100, '15.00', '1500.00', 3, 0, 1, 1),
(4, '2018-09-27 16:10:01', '2018-09-27 08:10:01', '2018-09-27', 1, '1', 2, 8, 100, '10.00', '1000.00', 4, 0, 1, 1),
(5, '2018-09-27 16:10:13', '2018-09-27 08:10:13', '2018-09-27', 1, '1', 2, 12, 100, '5.00', '500.00', 5, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `raw_data`
--

CREATE TABLE `raw_data` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date` date NOT NULL,
  `branch` varchar(255) NOT NULL,
  `job_order` int(11) NOT NULL DEFAULT '0',
  `customer_name` varchar(255) NOT NULL,
  `wdf` decimal(12,2) NOT NULL DEFAULT '0.00',
  `wdp` decimal(12,2) NOT NULL DEFAULT '0.00',
  `hand_wash` int(11) NOT NULL DEFAULT '0',
  `dry_clean` int(11) NOT NULL DEFAULT '0',
  `press_only` int(11) NOT NULL DEFAULT '0',
  `total_volume` decimal(12,2) NOT NULL DEFAULT '0.00',
  `revenue_wdf` decimal(12,2) NOT NULL DEFAULT '0.00',
  `revenue_wdp` decimal(12,2) NOT NULL DEFAULT '0.00',
  `revenue_hand_wash` decimal(12,2) NOT NULL DEFAULT '0.00',
  `revenue_dry_clean` decimal(12,2) NOT NULL DEFAULT '0.00',
  `revenue_press_only` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total_revenue` decimal(12,2) NOT NULL DEFAULT '0.00',
  `payments` decimal(12,2) NOT NULL DEFAULT '0.00',
  `accounts_receivable` decimal(12,2) NOT NULL DEFAULT '0.00',
  `rent` decimal(12,2) NOT NULL DEFAULT '0.00',
  `salaries` decimal(12,2) NOT NULL DEFAULT '0.00',
  `electricity` decimal(12,2) NOT NULL DEFAULT '0.00',
  `water` decimal(12,2) NOT NULL DEFAULT '0.00',
  `supplies` decimal(12,2) NOT NULL DEFAULT '0.00',
  `total_expenses` decimal(12,2) NOT NULL DEFAULT '0.00',
  `is_deleted` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `receipt_settings`
--

CREATE TABLE `receipt_settings` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `client_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to clients.id',
  `branch_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to branches.id',
  `file_path` varchar(100) DEFAULT NULL,
  `file_pics` varchar(100) DEFAULT NULL,
  `header` varchar(50) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `footer` varchar(50) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) NOT NULL,
  `module_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `created_at`, `updated_at`, `name`, `module_id`, `is_deleted`) VALUES
(1, '2017-11-05 20:05:14', '2017-11-05 18:05:14', 'Web Service', 1, 0),
(2, '2015-02-21 16:58:21', '2015-02-21 20:57:57', 'Super Admin', 2, 0),
(3, '2015-02-21 16:58:26', '2015-02-21 20:58:02', 'Dealer', 3, 0),
(4, '2018-07-16 11:55:14', '2018-07-16 03:55:14', 'Client', 4, 0),
(5, '2018-07-16 11:55:14', '2018-07-16 11:55:14', 'Staff', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role_based_access`
--

CREATE TABLE `role_based_access` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `menu_id` int(12) NOT NULL COMMENT 'rerd to menus.id',
  `module_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd modules.id',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `controller_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd controllers.id',
  `controller_name` varchar(100) NOT NULL,
  `action_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd actions.id',
  `action_name` varchar(100) NOT NULL,
  `is_accesible` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role_based_views`
--

CREATE TABLE `role_based_views` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT '0',
  `menu_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd menu.id',
  `menu_name` varchar(100) NOT NULL,
  `is_viewable` tinyint(1) NOT NULL DEFAULT '0',
  `module_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd menus.module_id',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_released` date NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `emp_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to employees.id',
  `branch_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to brnaches.id',
  `client_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to clients.id',
  `expenses_type_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to expenses_types.id',
  `title` varchar(20) NOT NULL,
  `amount` decimal(12,2) DEFAULT '0.00',
  `remarks` varchar(500) NOT NULL,
  `account_no` varchar(20) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `branch_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to branches.id',
  `name` varchar(50) DEFAULT NULL,
  `service_type_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to service_types.id',
  `amount` decimal(12,2) DEFAULT '0.00',
  `file_path` varchar(100) DEFAULT NULL,
  `file_pics` varchar(100) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `service_prices`
--

CREATE TABLE `service_prices` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `laundry_shop_id` int(11) NOT NULL DEFAULT '0',
  `branch_id` int(11) NOT NULL DEFAULT '0',
  `transaction_id` int(11) NOT NULL DEFAULT '0',
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `pulse` int(11) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_prices`
--

INSERT INTO `service_prices` (`id`, `created_at`, `updated_at`, `client_id`, `laundry_shop_id`, `branch_id`, `transaction_id`, `price`, `pulse`, `is_deleted`) VALUES
(1, '2017-12-11 03:26:44', '2017-12-10 19:26:44', 0, 0, 1, 1, '70.00', 0, 0),
(2, '2017-12-11 03:26:55', '2017-12-10 19:26:55', 0, 0, 1, 2, '10.00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_types`
--

INSERT INTO `service_types` (`id`, `created_at`, `updated_at`, `name`, `is_sync`, `is_deleted`) VALUES
(1, '2018-07-22 21:46:33', '2018-07-22 05:46:33', 'Washer ', 0, 0),
(2, '2018-07-22 21:46:49', '2018-07-22 05:46:49', 'Dryer', 0, 0),
(3, '2018-07-22 21:46:49', '2018-07-22 13:46:49', 'Titan', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `var` varchar(50) NOT NULL COMMENT 'variable name',
  `value` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_display` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `created_at`, `updated_at`, `var`, `value`, `description`, `is_display`) VALUES
(1, '2017-10-07 19:19:47', '2017-10-07 03:19:47', 'branch_code', 'cd3te', 'unique branch code', 1),
(2, '2017-11-24 20:26:51', '2017-11-24 04:26:51', 'laundry_shop_name', 'AppWard POS', 'laundry shop name', 1),
(3, '2017-11-24 20:27:32', '2017-11-24 04:27:32', 'branch_name', 'ELS', 'branch name', 1),
(4, '2017-11-28 06:50:42', '2017-11-27 14:50:42', 'branch_id', '2', 'branch id', 1),
(5, '2017-12-09 16:04:32', '2017-12-09 00:04:32', 'minutes_per_washdry', '10', 'minutes per wash and dry', 1),
(6, '2017-12-09 16:05:29', '2017-12-09 00:05:29', 'minutes_per_cycle', '40', 'minutes per cycle', 1),
(7, '2017-12-10 01:40:56', '2017-12-09 09:40:56', 'card_initial_load', '0', 'card initial load', 1),
(8, '2017-12-10 12:05:59', '2017-12-09 20:05:59', 'card_no_length', '8', 'card no length', 1),
(9, '2017-12-10 12:14:51', '2017-12-09 20:14:51', 'card_code', 'APWD', '1st 4 digit codes', 1),
(10, '2017-12-10 22:43:49', '2017-12-10 06:43:49', 'card_expiration_days', '365', 'card expiration days', 1),
(11, '2018-02-10 00:00:00', '2018-02-09 08:00:00', 'environment_setup', '2', 'environment setup. 1=QA,2=Production', 1),
(12, '2018-02-10 23:38:25', '2018-02-10 07:38:25', 'apps_name', 'POS', 'application name', 1),
(13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'config_company_name', 'Appward POS', 'Company Name', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `details` varchar(100) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_types`
--

CREATE TABLE `subscription_types` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `branch_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to brnaches.id',
  `client_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to clients.id',
  `firstname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `created_at`, `updated_at`, `branch_id`, `client_id`, `firstname`, `middlename`, `lastname`, `company_name`, `address`, `email`, `mobile`, `phone`, `is_sync`, `is_deleted`) VALUES
(1, '2018-09-26 19:54:14', '2018-09-26 11:54:14', 0, 0, 'Grocery', 'Grocery', 'Grocery', 'YBC Supermarket', '580 Rizal Avenue East Tapinac Olongapo City', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tax_settings`
--

CREATE TABLE `tax_settings` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `client_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to clients.id',
  `branch_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to branches.id',
  `loyalty_type_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to loyalty_types.id',
  `name` varchar(100) DEFAULT NULL,
  `precentage` decimal(12,2) DEFAULT '0.00',
  `tax_type_id` int(11) NOT NULL DEFAULT '0' COMMENT '1= included in item 2 =added to items',
  `tax_option_id` int(11) NOT NULL DEFAULT '0' COMMENT '1= apply to new 2= apply  to existing 3= apply to all',
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `seq` int(11) NOT NULL DEFAULT '0',
  `machine_type_id` int(11) NOT NULL DEFAULT '0',
  `is_services` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `created_at`, `updated_at`, `name`, `seq`, `machine_type_id`, `is_services`, `is_deleted`) VALUES
(1, '2017-04-27 13:26:18', '2017-04-28 13:48:52', 'Washer', 1, 1, 1, 0),
(2, '2017-04-27 13:26:53', '2017-04-26 05:26:53', 'Dryer', 2, 2, 1, 0),
(3, '2017-05-11 21:54:43', '2017-05-10 13:54:43', 'Titan', 3, 3, 1, 0),
(4, '2017-04-28 22:57:46', '2017-04-27 14:57:46', 'Top up', 4, 1, 1, 0),
(5, '2017-04-30 17:30:54', '2017-04-29 09:30:54', 'Top down', 5, 2, 1, 0),
(6, '2017-06-24 16:09:05', '2017-06-23 16:09:05', 'Card registration', 6, 0, 0, 0),
(7, '2017-06-24 16:09:05', '2017-06-24 16:09:05', 'Payment', 7, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pword_hash` varchar(255) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '2' COMMENT '1=super, 2=owner, 3=employee',
  `last_login` timestamp NULL DEFAULT NULL,
  `emp_id` int(11) NOT NULL DEFAULT '0',
  `client_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to clients.id',
  `is_override_useraccess` tinyint(1) NOT NULL DEFAULT '0',
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `last_sync` datetime DEFAULT '1970-08-01 00:00:00',
  `branch_id` int(11) DEFAULT NULL COMMENT 'ref to branches.id',
  `is_password_changed` tinyint(1) DEFAULT '0' COMMENT '0 = no 1 = yes',
  `is_employee` tinyint(1) DEFAULT NULL COMMENT '0=client 1 = employee',
  `account_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_at`, `updated_at`, `username`, `email`, `pword_hash`, `role`, `last_login`, `emp_id`, `client_id`, `is_override_useraccess`, `is_sync`, `is_active`, `last_sync`, `branch_id`, `is_password_changed`, `is_employee`, `account_type_id`) VALUES
(1, '2018-08-29 00:46:41', '2018-08-28 16:46:41', 'wservice.washndry', '', '21232f297a57a5a743894a0e4a801fc3', 1, '2018-09-24 17:37:08', 1, 1, 1, 0, 1, '1970-08-01 00:00:00', 1, 0, NULL, 1),
(2, '2018-07-16 12:54:18', '2018-08-28 14:31:09', 'admin', 'admin@pos.com', '21232f297a57a5a743894a0e4a801fc3', 3, '2018-10-09 14:24:39', 3, 1, 1, 0, 1, '1970-08-01 00:00:00', 1, NULL, 0, 3),
(3, '2018-09-26 21:03:57', '2018-09-26 05:03:57', 'user1', 'test@test.com', '24c9e15e52afc47c225b757e7bee1f9d', 4, '2018-10-08 13:36:27', 1, 1, 0, 0, 1, '1970-08-01 00:00:00', 1, 0, 1, NULL),
(4, '2018-09-26 21:04:17', '2018-09-26 05:04:17', 'user2', 'test@test.com', '7e58d63b60197ceb55a1c487989a3720', 4, '2018-09-26 05:14:47', 2, 1, 0, 0, 1, '1970-08-01 00:00:00', 1, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_based_access`
--

CREATE TABLE `user_based_access` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `menu_id` int(12) NOT NULL COMMENT 'rerd to menus.id',
  `module_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd modules.id',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `controller_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd controllers.id',
  `controller_name` varchar(100) NOT NULL,
  `action_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd actions.id',
  `action_name` varchar(100) NOT NULL,
  `is_accesible` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_based_access`
--

INSERT INTO `user_based_access` (`id`, `created_at`, `updated_at`, `menu_id`, `module_id`, `user_id`, `controller_id`, `controller_name`, `action_id`, `action_name`, `is_accesible`, `parent_id`, `is_deleted`) VALUES
(1, '2018-07-22 21:39:22', '2018-07-22 05:39:21', 5, 1, 1, 0, '', 0, '', 1, 0, 0),
(2, '2018-07-22 21:39:22', '2018-07-22 05:39:22', 6, 1, 1, 2, 'dealers', 2, 'admin', 1, 5, 0),
(3, '2018-07-22 21:39:22', '2018-07-22 05:39:22', 7, 1, 1, 0, '', 0, '', 1, 0, 0),
(4, '2018-07-22 21:39:22', '2018-07-22 05:39:22', 8, 1, 1, 3, 'clients', 2, 'admin', 1, 7, 0),
(5, '2018-07-22 21:39:22', '2018-07-22 05:39:22', 1, 1, 1, 0, '', 0, '', 1, 0, 0),
(6, '2018-07-22 21:39:22', '2018-07-22 05:39:22', 3, 1, 1, 0, 'users', 0, 'admin', 1, 1, 0),
(7, '2018-07-22 21:39:22', '2018-07-22 05:39:22', 4, 1, 1, 0, 'users', 0, 'changePassword', 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_trails`
--
ALTER TABLE `audit_trails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `civil_statuses`
--
ALTER TABLE `civil_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `controllers`
--
ALTER TABLE `controllers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `customer_cards`
--
ALTER TABLE `customer_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_card_transactions`
--
ALTER TABLE `customer_card_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_transactions`
--
ALTER TABLE `customer_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers`
--
ALTER TABLE `dealers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses_types`
--
ALTER TABLE `expenses_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_categories`
--
ALTER TABLE `inventory_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loyalty_settings`
--
ALTER TABLE `loyalty_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loyalty_types`
--
ALTER TABLE `loyalty_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine_statuses`
--
ALTER TABLE `machine_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine_usage_details`
--
ALTER TABLE `machine_usage_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine_usage_headers`
--
ALTER TABLE `machine_usage_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occupations`
--
ALTER TABLE `occupations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_payment_details`
--
ALTER TABLE `pos_payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_payment_headers`
--
ALTER TABLE `pos_payment_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pos_transactions`
--
ALTER TABLE `pos_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_data`
--
ALTER TABLE `raw_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt_settings`
--
ALTER TABLE `receipt_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_based_access`
--
ALTER TABLE `role_based_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_based_views`
--
ALTER TABLE `role_based_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_prices`
--
ALTER TABLE `service_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_types`
--
ALTER TABLE `subscription_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_settings`
--
ALTER TABLE `tax_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_based_access`
--
ALTER TABLE `user_based_access`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `audit_trails`
--
ALTER TABLE `audit_trails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `civil_statuses`
--
ALTER TABLE `civil_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `controllers`
--
ALTER TABLE `controllers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_cards`
--
ALTER TABLE `customer_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_card_transactions`
--
ALTER TABLE `customer_card_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_transactions`
--
ALTER TABLE `customer_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers`
--
ALTER TABLE `dealers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expenses_types`
--
ALTER TABLE `expenses_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `inventory_categories`
--
ALTER TABLE `inventory_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loyalty_settings`
--
ALTER TABLE `loyalty_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loyalty_types`
--
ALTER TABLE `loyalty_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `machines`
--
ALTER TABLE `machines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `machine_statuses`
--
ALTER TABLE `machine_statuses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `machine_usage_details`
--
ALTER TABLE `machine_usage_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `machine_usage_headers`
--
ALTER TABLE `machine_usage_headers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `occupations`
--
ALTER TABLE `occupations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pos_payment_details`
--
ALTER TABLE `pos_payment_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `pos_payment_headers`
--
ALTER TABLE `pos_payment_headers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pos_transactions`
--
ALTER TABLE `pos_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `raw_data`
--
ALTER TABLE `raw_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receipt_settings`
--
ALTER TABLE `receipt_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role_based_access`
--
ALTER TABLE `role_based_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_based_views`
--
ALTER TABLE `role_based_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_prices`
--
ALTER TABLE `service_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription_types`
--
ALTER TABLE `subscription_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tax_settings`
--
ALTER TABLE `tax_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_based_access`
--
ALTER TABLE `user_based_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `eventUpdateMachineStatus` ON SCHEDULE EVERY 15 SECOND STARTS '2018-01-15 03:30:14' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN	
		call sp_updateMachineStatus();
	END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
