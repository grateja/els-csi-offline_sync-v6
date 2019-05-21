# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.34-MariaDB)
# Database: appward_pos_live
# Generation Time: 2018-12-16 16:56:17 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table account_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `account_types`;

CREATE TABLE `account_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `landing_module` varchar(100) NOT NULL,
  `landing_controller` varchar(100) NOT NULL,
  `landing_action` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `account_types` WRITE;
/*!40000 ALTER TABLE `account_types` DISABLE KEYS */;

INSERT INTO `account_types` (`id`, `created_at`, `updated_at`, `name`, `landing_module`, `landing_controller`, `landing_action`, `is_deleted`)
VALUES
	(1,'2014-10-09 22:02:44','2014-10-11 23:46:44','Web Service','webservice','api','quote',0),
	(2,'2014-10-09 22:02:44','2014-10-11 23:46:44','approver','user','default','index',0),
	(3,'2017-06-14 12:10:30','2017-06-15 01:10:30','checker','user','default','index',0),
	(4,'2017-06-14 12:11:11','2017-06-15 01:11:11','preparer','user','default','index',0);

/*!40000 ALTER TABLE `account_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table actions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `actions`;

CREATE TABLE `actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table audit_trails
# ------------------------------------------------------------

DROP TABLE IF EXISTS `audit_trails`;

CREATE TABLE `audit_trails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `audit_trails` WRITE;
/*!40000 ALTER TABLE `audit_trails` DISABLE KEYS */;

INSERT INTO `audit_trails` (`id`, `created_at`, `updated_at`, `table_name`, `column_name`, `data_id`, `old_value`, `new_value`, `user_id`, `emp_id`, `trans_type`, `is_deleted`)
VALUES
	(1,'2018-12-16 23:42:03','2018-12-16 23:42:03','employees','file_pics',2,'00002.jpg','00002.png',5,2,2,0);

/*!40000 ALTER TABLE `audit_trails` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table authToken
# ------------------------------------------------------------

DROP TABLE IF EXISTS `authToken`;

CREATE TABLE `authToken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`,`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `authToken` WRITE;
/*!40000 ALTER TABLE `authToken` DISABLE KEYS */;

INSERT INTO `authToken` (`id`, `userId`, `token`, `created_at`, `updated_at`)
VALUES
	(1,3,'1fj449reof0rb56navl8q03b70','2018-11-30 20:43:13','2018-12-16 23:19:22');

/*!40000 ALTER TABLE `authToken` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table banks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `banks`;

CREATE TABLE `banks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table branches
# ------------------------------------------------------------

DROP TABLE IF EXISTS `branches`;

CREATE TABLE `branches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `client_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to clients.id',
  `address` varchar(100) DEFAULT NULL,
  `latitude` double(15,6) NOT NULL,
  `longitude` double(15,6) NOT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `contact_no` varchar(255) DEFAULT NULL,
  `header_rcpt_msg` varchar(255) DEFAULT NULL,
  `footer_rcpt_msg` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `file_path` varchar(100) DEFAULT NULL,
  `file_pics` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL COMMENT 'ref to cities.id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;

INSERT INTO `branches` (`id`, `created_at`, `updated_at`, `client_id`, `address`, `latitude`, `longitude`, `is_sync`, `is_deleted`, `name`, `contact_no`, `header_rcpt_msg`, `footer_rcpt_msg`, `email_address`, `file_path`, `file_pics`, `user_id`, `city_id`)
VALUES
	(1,'2018-11-30 20:36:18','2018-12-16 23:54:53',1,'QC',0.000000,0.000000,0,0,'The Spin Doctors','09174203981 / 3690404','Client 1 Branch 1','Thank you.','thespindoctors@gmail.com','images/','the_spin_doctors.png',2,1),
	(2,'2018-11-30 20:42:35','2018-12-01 10:42:35',1,'QC',0.000000,0.000000,0,0,'WashingTime','09174203981 / 3690404','Client 1 Branch 2','Thank you for your business!','washingtime@gmail.com','images/','washingtime.png',2,NULL),
	(3,'2018-11-30 22:40:08','2018-12-01 12:40:08',2,'QC',0.000000,0.000000,0,0,'Yay!','12345671234','Yay Full Service Laundry','See you again!','yay@gmail.com','images/','yay!.png',2,NULL);

/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table civil_statuses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `civil_statuses`;

CREATE TABLE `civil_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table clients
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `file_path` varchar(100) DEFAULT NULL,
  `file_pics` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `is_account_created` tinyint(1) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;

INSERT INTO `clients` (`id`, `created_at`, `updated_at`, `dealer_id`, `firstname`, `middlename`, `lastname`, `company_name`, `address`, `email`, `mobile`, `phone`, `is_sync`, `file_path`, `file_pics`, `is_deleted`, `is_account_created`, `user_id`)
VALUES
	(1,'2018-11-30 20:07:57','2018-12-01 11:46:27',NULL,'Cris','Claud','Carrillo','LaundryLabs','QC','cris@gmail.com','09174203981','3690404',0,'images/clients/','laundrylabs.png',0,NULL,2),
	(2,'2018-11-30 22:39:03','2018-12-01 12:39:03',2,'Atty','','Choi','Yay!','QC','attychoi@gmail.com','12345671234','1234567',0,'images/clients/','yay!.jpg',0,NULL,2);

/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table controllers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `controllers`;

CREATE TABLE `controllers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table customer_card_transactions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer_card_transactions`;

CREATE TABLE `customer_card_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table customer_cards
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer_cards`;

CREATE TABLE `customer_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `card_user_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table customer_machine_usages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer_machine_usages`;

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



# Dump of table customer_transactions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer_transactions`;

CREATE TABLE `customer_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table customers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `points` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;

INSERT INTO `customers` (`id`, `created_at`, `updated_at`, `branch_id`, `client_id`, `firstname`, `middlename`, `lastname`, `company_name`, `address`, `email`, `mobile`, `phone`, `is_sync`, `is_deleted`, `birthdate`, `token_wash`, `token_dry`, `token_titan`, `is_activated`, `points`)
VALUES
	(1,'2018-11-30 21:41:56','2018-12-01 11:41:56',1,1,'Yvette','','Terence','','','','','',0,0,'1970-01-01',0,0,0,0,0),
	(2,'2018-11-30 21:42:10','2018-12-01 11:42:10',1,1,'Atty','','Angelo','','','','','',0,0,'1970-01-01',0,0,0,0,0),
	(3,'2018-11-30 21:42:29','2018-12-01 11:42:29',2,1,'Lyn','','Alejandro','','','','','',0,0,'1970-01-01',0,0,0,0,0),
	(4,'2018-11-30 21:42:45','2018-12-01 11:42:45',2,1,'Major','','Gabriel','','','','','',0,0,'1970-01-01',0,0,0,0,0),
	(5,'2018-11-30 22:48:41','2018-12-01 12:48:41',3,2,'Yay','','Customer','','','','','',0,0,'1970-01-01',0,0,0,0,0),
	(6,'2018-11-30 22:49:06','2018-12-01 12:49:06',3,2,'Vitto','','Bratta','','','','','',0,0,'1970-01-01',0,0,0,0,0),
	(7,'2018-12-17 00:16:35','2018-12-17 00:16:35',1,1,'teststt1','','test','','','','','',0,0,'2018-12-26',0,0,0,0,0);

/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dealers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dealers`;

CREATE TABLE `dealers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `file_path` varchar(100) DEFAULT NULL,
  `file_pics` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `dealers` WRITE;
/*!40000 ALTER TABLE `dealers` DISABLE KEYS */;

INSERT INTO `dealers` (`id`, `created_at`, `updated_at`, `firstname`, `middlename`, `lastname`, `company_name`, `address`, `email`, `mobile`, `phone`, `is_sync`, `is_deleted`, `file_path`, `file_pics`, `user_id`)
VALUES
	(1,'2018-12-01 11:36:19','2018-12-01 11:36:19','test','tset','tst','test','test','test@test.test','','',0,0,'images/dealers/','test.png',2),
	(2,'2018-12-09 17:23:23','2018-12-09 17:23:23','test','estset','tetstst','','','','','',0,0,'images/dealers/',NULL,11);

/*!40000 ALTER TABLE `dealers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table discounts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `discounts`;

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `client_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to clients.id',
  `branch_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to branches.id',
  `name` varchar(50) DEFAULT NULL,
  `discount_type_id` int(11) NOT NULL DEFAULT '0' COMMENT '= amount, 2 = percentage',
  `value` decimal(12,2) DEFAULT '0.00',
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `discounts` WRITE;
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;

INSERT INTO `discounts` (`id`, `created_at`, `updated_at`, `client_id`, `branch_id`, `name`, `discount_type_id`, `value`, `is_sync`, `is_deleted`)
VALUES
	(1,'2018-09-09 02:27:53','2018-09-09 15:27:53',1,1,'Senior Citizen\'s Discount (12 %)',2,12.00,0,0),
	(2,'2018-09-09 02:28:02','2018-09-09 15:28:02',1,1,'Others',1,0.00,0,0);

/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table employees
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_with_card` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;

INSERT INTO `employees` (`id`, `created_at`, `updated_at`, `employee_no`, `firstname`, `middlename`, `lastname`, `mobile`, `phone`, `email`, `birthdate`, `civil_status_id`, `address1`, `address2`, `region_id`, `province_id`, `municipality_id`, `barangay_id`, `office_id`, `citizenship_id`, `branch_id`, `contact_person_id`, `occupation_id`, `department_id`, `manager_id`, `location_id`, `is_agent`, `is_active`, `is_deleted`, `client_id`, `is_account_created`, `file_path`, `file_pics`, `is_owner`, `is_employee`, `is_with_card`)
VALUES
	(1,'2018-11-30 21:24:25','2018-12-01 11:24:25','00001','Jommel','','Rey','','','','1970-01-01',0,'',NULL,NULL,NULL,NULL,NULL,0,0,1,0,0,0,0,0,0,1,0,1,1,'images/employees/','00001.png',NULL,1,0),
	(2,'2018-11-30 21:25:04','2018-12-16 23:42:03','00002','Macy','','Rey','','','','1970-01-01',0,'',NULL,NULL,NULL,NULL,NULL,0,0,1,0,0,0,0,0,0,1,0,1,1,'images/employees/','00002.png',NULL,1,0),
	(3,'2018-11-30 21:32:38','2018-12-01 11:32:38','00003','Aris','','Dailo','','','','1970-01-01',0,'',NULL,NULL,NULL,NULL,NULL,0,0,2,0,0,0,0,0,0,1,0,1,1,'images/employees/','00003.png',NULL,1,0),
	(4,'2018-11-30 21:33:04','2018-12-01 11:33:04','00004','Donna','','Enerio','','','','1970-01-01',0,'',NULL,NULL,NULL,NULL,NULL,0,0,2,0,0,0,0,0,0,1,0,1,1,'images/employees/','00004.jpg',NULL,1,0),
	(5,'2018-11-30 22:44:29','2018-12-01 12:44:29','00005','Yay','','Aris','','','','1970-01-01',0,'',NULL,NULL,NULL,NULL,NULL,0,0,3,0,0,0,0,0,0,1,0,2,1,'images/employees/','00005.png',NULL,1,0),
	(6,'2018-11-30 22:44:54','2018-12-01 12:44:54','00006','Yay','','Donna','','','','1970-01-01',0,'',NULL,NULL,NULL,NULL,NULL,0,0,3,0,0,0,0,0,0,1,0,2,1,'images/employees/','00006.jpg',NULL,1,0);

/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table expenses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `expenses`;

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `emp_id` int(11) DEFAULT NULL COMMENT 'ref to employees.id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;

INSERT INTO `expenses` (`id`, `created_at`, `updated_at`, `date`, `ref_no`, `branch_id`, `client_id`, `expenses_type_id`, `title`, `amount`, `remarks`, `is_sync`, `is_deleted`, `emp_id`)
VALUES
	(1,'2018-11-30 22:12:29','2018-12-01 12:12:29','2018-11-30','1811000001',1,1,4,'Purchases',1200.00,'Purchase of Ariel Blue',0,0,NULL),
	(2,'2018-11-30 22:12:56','2018-12-01 12:12:56','2018-11-30','1811000002',1,1,4,'Purchases',1200.00,'Purchase of Ariel Green',0,0,NULL),
	(3,'2018-11-30 22:14:12','2018-12-01 12:14:12','2018-11-30','1811000003',2,1,4,'Purchases',1200.00,'Purchase of Ariel Blue WT',0,0,NULL),
	(4,'2018-11-30 22:14:32','2018-12-01 12:14:32','2018-11-30','1811000004',2,1,4,'Purchases',1200.00,'Purchase of Ariel Green WT',0,0,NULL),
	(5,'2018-11-30 22:17:03','2018-12-01 12:17:03','1970-01-01','1811000005',1,1,3,'Salaries',3000.00,'Nov 26-30',0,0,1),
	(6,'2018-11-30 22:17:23','2018-12-01 12:17:23','1970-01-01','1811000005',1,1,3,'Salaries',2500.00,'Nov 26-30',0,0,2),
	(7,'2018-11-30 22:17:45','2018-12-01 12:17:45','1970-01-01','1811000005',2,1,3,'Salaries',3000.00,'Aris Nov 26-30',0,0,3),
	(8,'2018-11-30 22:18:05','2018-12-01 12:18:05','1970-01-01','1811000005',2,1,3,'Salaries',2500.00,'DOnna Nov 26-30',0,0,4),
	(9,'2018-11-30 22:18:37','2018-12-01 12:19:12','0000-00-00','1811000005',1,1,2,'Rental',15000.00,'November Rental - TSD',0,0,1),
	(10,'2018-11-30 22:19:40','2018-12-01 12:19:40','1970-01-01','1811000005',2,1,2,'Rental',7000.00,'November Rental WT',0,0,3),
	(11,'2018-11-30 22:20:36','2018-12-01 12:20:36','1970-01-01','1811000005',1,1,1,'Utility Expeses',4000.00,'Water Nov  TSD',0,0,2),
	(12,'2018-11-30 22:23:38','2018-12-01 12:23:38','1970-01-01','1811000005',1,1,1,'Utility Expeses',3500.00,'Meralco Nov TSD',0,0,2),
	(13,'2018-11-30 22:24:18','2018-12-01 12:24:18','1970-01-01','1811000005',2,1,1,'Utility Expeses',3500.00,'Meralco Nov WT',0,0,4),
	(14,'2018-11-30 22:24:58','2018-12-01 12:24:58','1970-01-01','1811000005',2,1,5,'Others',1000.00,'Testing Aris creating expense for Macy - diff branch',0,0,2),
	(15,'2018-11-30 22:51:02','2018-12-01 12:51:02','2018-11-30','1811000005',3,2,4,'Purchases',1200.00,'Purchase of Yay Ariel Blue',0,0,NULL),
	(16,'2018-11-30 22:51:19','2018-12-01 12:51:19','2018-11-30','1811000006',3,2,4,'Purchases',1200.00,'Purchase of Yay Downy Blue',0,0,NULL),
	(17,'2018-12-01 23:39:02','2018-12-01 23:39:02','2018-12-01','1812000001',2,1,1,'Utility Expeses',1000.00,'test',0,0,1),
	(18,'2018-12-01 23:40:15','2018-12-01 23:40:15','2018-01-12','1812000002',1,1,2,'Rental',1000.00,'test',0,0,NULL),
	(19,'2018-12-01 23:45:58','2018-12-01 23:45:58','2018-01-12','1812000002',1,1,1,'Utility Expeses',1000.00,'test',0,0,NULL),
	(20,'2018-12-01 23:46:55','2018-12-01 23:46:55','2018-01-12','1812000002',1,1,1,'Utility Expeses',1000.00,'test',0,0,1),
	(21,'2018-12-01 23:47:14','2018-12-01 23:47:14','2018-12-08','1812000002',1,1,2,'Rental',1000.00,'test',0,0,1),
	(22,'2018-12-02 00:04:09','2018-12-02 00:04:09','2018-12-02','1812000003',1,1,4,'Purchases',1000.00,'Purchase of Ariel Blue',0,0,NULL),
	(23,'2018-12-02 00:04:26','2018-12-02 00:04:26','2018-12-13','1812000004',1,1,2,'Rental',100.00,'TEST',0,0,1),
	(24,'2018-12-02 00:09:58','2018-12-02 00:09:58','2018-12-02','1812000005',1,1,2,'Rental',100.00,'test',0,0,1),
	(25,'2018-12-02 00:10:27','2018-12-02 00:10:27','2018-12-02','1812000006',1,1,4,'Purchases',10000.00,'Purchase of Ariel Blue',0,0,NULL),
	(26,'2018-12-02 00:20:26','2018-12-02 00:20:26','2018-12-02','1812000007',2,1,4,'Purchases',100000.00,'Purchase of Ariel Blue WT',0,0,NULL),
	(27,'2018-12-09 17:36:29','2018-12-09 17:36:29','2018-09-12','1812000008',1,1,3,'Salaries',1000.00,'test',0,0,NULL),
	(28,'2018-12-09 17:38:15','2018-12-09 17:38:15','2018-09-12','1812000008',1,1,3,'Salaries',1000.00,'test',0,0,1),
	(29,'2018-12-09 17:40:38','2018-12-09 17:40:38','2018-09-12','1812000008',1,1,1,'Utility Expeses',1000.00,'test',0,0,1),
	(30,'2018-12-09 17:40:55','2018-12-09 17:40:55','2018-09-12','1812000008',1,1,3,'Salaries',1000.00,'test',0,0,1),
	(31,'2018-12-09 20:38:48','2018-12-09 20:38:48','2018-09-12','1812000008',1,1,3,'Salaries',1000.00,'test',0,0,1),
	(32,'2018-12-09 20:39:56','2018-12-13 11:33:01','0000-00-00','1812000008',1,1,2,'Rental',1000.00,'test',0,0,2),
	(33,'2018-12-13 11:33:35','2018-12-13 11:33:35','1970-01-01','1812000008',1,1,1,'Utility Expeses',1000.00,'test',0,0,1);

/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table expenses_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `expenses_types`;

CREATE TABLE `expenses_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `expenses_types` WRITE;
/*!40000 ALTER TABLE `expenses_types` DISABLE KEYS */;

INSERT INTO `expenses_types` (`id`, `created_at`, `updated_at`, `name`, `is_sync`, `is_deleted`)
VALUES
	(1,'2018-09-08 09:43:46','2018-09-08 22:49:21','Utility Expeses',0,0),
	(2,'2018-09-08 09:49:36','2018-09-08 22:49:36','Rental',0,0),
	(3,'2018-09-08 09:49:52','2018-09-08 22:49:52','Salaries',0,0),
	(4,'2018-09-08 09:49:59','2018-09-08 22:49:59','Purchases',0,0),
	(5,'2018-09-08 09:50:07','2018-09-08 22:50:07','Others',0,0),
	(6,'2018-09-19 21:53:22','2018-11-18 05:11:12','Laundry Supplies',0,0);

/*!40000 ALTER TABLE `expenses_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table inventories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `inventories`;

CREATE TABLE `inventories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `color` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `inventories` WRITE;
/*!40000 ALTER TABLE `inventories` DISABLE KEYS */;

INSERT INTO `inventories` (`id`, `created_at`, `updated_at`, `branch_id`, `client_id`, `name`, `desc`, `bar_code`, `category_id`, `price`, `cost`, `tax`, `margin`, `qty_stock`, `qty_reorder`, `file_path`, `file_pics`, `is_sync`, `is_deleted`, `topup_amount`, `token`, `service_type_id`, `group_id`, `color`)
VALUES
	(1,'2018-11-30 21:08:41','2018-12-01 11:08:41',1,1,'Ariel Blue','','',1,15.00,1000.00,0.00,0.00,204,50,'images/inventories/','ariel_blue.jpg',0,0,NULL,NULL,NULL,NULL,NULL),
	(2,'2018-11-30 21:09:09','2018-12-01 11:09:09',1,1,'Ariel Green','','',1,15.00,12.00,0.00,0.00,98,50,'images/inventories/','ariel_green.jpg',0,0,NULL,NULL,NULL,NULL,NULL),
	(3,'2018-11-30 21:09:39','2018-12-01 11:09:39',1,1,'Regular Wash','','',2,65.00,0.00,0.00,0.00,0,0,'images/inventories/','regular_wash.jpg',0,0,NULL,1,1,1,NULL),
	(4,'2018-11-30 21:10:04','2018-12-01 11:10:04',1,1,'Standard Dry','','',2,70.00,0.00,0.00,0.00,0,0,'images/inventories/','standard_dry.jpg',0,0,NULL,4,2,1,NULL),
	(5,'2018-11-30 21:10:33','2018-12-01 11:10:33',1,1,'Folding','','',2,30.00,0.00,0.00,0.00,0,0,'images/inventories/','folding.jpg',0,0,NULL,NULL,4,2,NULL),
	(6,'2018-11-30 21:11:00','2018-12-01 11:11:00',1,1,'Ironing','','',2,100.00,0.00,0.00,0.00,0,0,'images/inventories/','ironing.jpg',0,0,NULL,NULL,4,2,NULL),
	(7,'2018-11-30 21:11:25','2018-12-13 11:33:15',1,1,'Dry Clean','','',2,500.00,0.00,0.00,0.00,0,0,'images/inventories/','.jpg',0,0,NULL,NULL,4,2,NULL),
	(8,'2018-11-30 22:01:04','2018-12-01 12:01:04',2,1,'Ariel Blue WT','','',1,15.00,1000.00,0.00,0.00,198,50,'images/inventories/','ariel_blue_wt.jpg',0,0,NULL,NULL,NULL,NULL,NULL),
	(9,'2018-11-30 22:01:26','2018-12-01 12:01:26',2,1,'Ariel Green WT','','',1,15.00,12.00,0.00,0.00,100,50,'images/inventories/','ariel_green_wt.jpg',0,0,NULL,NULL,NULL,NULL,NULL),
	(10,'2018-11-30 22:02:05','2018-12-01 12:02:05',2,1,'Regular Wash','','',2,65.00,0.00,0.00,0.00,0,0,'images/inventories/','regular_wash.jpg',0,0,NULL,1,1,1,NULL),
	(11,'2018-11-30 22:02:30','2018-12-01 12:02:30',2,1,'Standard Dry','','',2,70.00,0.00,0.00,0.00,0,0,'images/inventories/','standard_dry.jpg',0,0,NULL,4,2,1,NULL),
	(12,'2018-11-30 22:02:57','2018-12-01 12:02:57',2,1,'Folding WT','','',2,30.00,0.00,0.00,0.00,0,0,'images/inventories/','folding_wt.jpg',0,0,NULL,NULL,4,2,NULL),
	(13,'2018-11-30 22:03:21','2018-12-01 12:03:21',2,1,'Dry Clean','','',2,500.00,0.00,0.00,0.00,0,0,'images/inventories/','dry_clean.jpg',0,0,NULL,NULL,4,2,NULL),
	(14,'2018-11-30 22:03:53','2018-12-01 12:03:53',2,1,'Ironing','','',2,100.00,0.00,0.00,0.00,0,0,'images/inventories/','ironing.jpg',0,0,NULL,NULL,4,2,NULL),
	(15,'2018-11-30 22:03:54','2018-12-01 12:05:33',2,1,'Ironing','','',2,100.00,0.00,0.00,0.00,0,0,'images/inventories/','ironing.jpg',0,1,NULL,NULL,4,2,NULL),
	(16,'2018-11-30 22:45:25','2018-12-01 12:45:25',3,2,'Yay Ariel Blue','','',1,15.00,12.00,0.00,0.00,100,0,'images/inventories/','yay_ariel_blue.jpg',0,0,NULL,NULL,NULL,NULL,NULL),
	(17,'2018-11-30 22:45:46','2018-12-01 12:45:46',3,2,'Yay Downy Blue','','',1,15.00,12.00,0.00,0.00,100,0,'images/inventories/','yay_downy_blue.jpg',0,0,NULL,NULL,NULL,NULL,NULL),
	(18,'2018-11-30 22:46:17','2018-12-01 12:46:17',3,2,'Yay Wash','','',2,65.00,0.00,0.00,0.00,0,0,'images/inventories/','yay_wash.jpg',0,0,NULL,1,1,1,NULL),
	(19,'2018-11-30 22:46:44','2018-12-01 12:46:44',3,2,'Yay Dry','','',2,70.00,0.00,0.00,0.00,0,0,'images/inventories/','yay_dry.jpg',0,0,NULL,4,2,1,NULL),
	(20,'2018-11-30 22:47:14','2018-12-01 12:47:14',3,2,'Yay DC','','',2,300.00,0.00,0.00,0.00,0,0,'images/inventories/','yay_dc.jpg',0,0,NULL,NULL,4,2,NULL);

/*!40000 ALTER TABLE `inventories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table inventory_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `inventory_categories`;

CREATE TABLE `inventory_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `inventory_categories` WRITE;
/*!40000 ALTER TABLE `inventory_categories` DISABLE KEYS */;

INSERT INTO `inventory_categories` (`id`, `created_at`, `updated_at`, `name`, `is_deleted`)
VALUES
	(1,'2018-07-19 14:40:44','2018-07-19 19:40:44','Products',0),
	(2,'2018-07-19 14:40:55','2018-07-19 19:40:55','Services',0),
	(3,'2018-07-19 14:41:03','2018-07-19 19:41:03','Others',0);

/*!40000 ALTER TABLE `inventory_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table loyalty_settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `loyalty_settings`;

CREATE TABLE `loyalty_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `client_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to clients.id',
  `branch_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to branches.id',
  `loyalty_type_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to loyalty_types.id',
  `value` decimal(12,2) DEFAULT '0.00',
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `percentage` decimal(12,2) DEFAULT '0.00',
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table loyalty_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `loyalty_types`;

CREATE TABLE `loyalty_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table machine_statuses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `machine_statuses`;

CREATE TABLE `machine_statuses` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `seq` int(2) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `machine_statuses` WRITE;
/*!40000 ALTER TABLE `machine_statuses` DISABLE KEYS */;

INSERT INTO `machine_statuses` (`id`, `created_at`, `updated_at`, `name`, `seq`, `is_deleted`)
VALUES
	(1,'2017-09-18 23:48:59','2017-09-18 20:48:59','Idle',1,0),
	(2,'2017-09-18 23:49:15','2017-09-18 20:49:15','Running',2,0),
	(3,'2017-09-18 23:49:20','2017-09-18 20:49:20','Paused',3,0),
	(4,'2017-12-11 04:54:00','2017-12-11 10:54:00','Defective',5,0);

/*!40000 ALTER TABLE `machine_statuses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table machine_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `machine_types`;

CREATE TABLE `machine_types` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `minutes_per_usage` int(11) NOT NULL DEFAULT '0' COMMENT 'minutes per wash/dryer',
  `minutes_per_cycle` int(11) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `machine_types` WRITE;
/*!40000 ALTER TABLE `machine_types` DISABLE KEYS */;

INSERT INTO `machine_types` (`id`, `created_at`, `updated_at`, `name`, `minutes_per_usage`, `minutes_per_cycle`, `is_deleted`)
VALUES
	(1,'2017-04-27 13:27:22','2017-04-27 10:27:22','Washer',39,39,0),
	(2,'2017-04-27 13:27:31','2017-04-27 10:27:31','Dryer',10,10,0),
	(3,'2018-08-15 00:00:00','2018-08-15 13:00:00','Titan',39,39,0);

/*!40000 ALTER TABLE `machine_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table machine_usage_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `machine_usage_details`;

CREATE TABLE `machine_usage_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table machine_usage_headers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `machine_usage_headers`;

CREATE TABLE `machine_usage_headers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table machines
# ------------------------------------------------------------

DROP TABLE IF EXISTS `machines`;

CREATE TABLE `machines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_status_pending_approval` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `machines` WRITE;
/*!40000 ALTER TABLE `machines` DISABLE KEYS */;

INSERT INTO `machines` (`id`, `created_at`, `updated_at`, `client_id`, `laundry_shop_id`, `branch_id`, `ip_address`, `name`, `machine_type_id`, `machine_status_id`, `url_machine_activator`, `user_id`, `img_file_path`, `img_file`, `minutes_per_washdry`, `minutes_per_cycle`, `serial_no`, `is_deleted`, `is_status_pending_approval`)
VALUES
	(1,'2018-10-13 13:22:08','2018-11-18 04:25:07',1,0,1,'192.168.1.101','Washer 1',1,1,'',2,'/images/machine/tmp/','washingmachine.jpg',39,39,'',0,0),
	(2,'2018-10-13 13:22:35','2018-10-14 02:22:35',1,0,1,'192.168.1.102','Washer 2',1,1,'',2,'/images/machine/tmp/','washingmachine.jpg',39,39,'',0,0),
	(3,'2018-10-13 13:22:48','2018-10-14 02:22:48',1,0,1,'192.168.1.103','Washer 3',1,1,'',2,'/images/machine/tmp/','washingmachine.jpg',39,39,'',0,0),
	(4,'2018-10-13 13:23:01','2018-10-14 02:23:01',1,0,1,'192.168.1.104','Washer 4',1,1,'',2,'/images/machine/tmp/','washingmachine.jpg',39,39,'',0,0),
	(5,'2018-10-13 13:23:18','2018-10-14 02:23:18',1,0,1,'192.168.1.105','Dryer 1',2,1,'',2,'/images/machine/tmp/','washingmachine.jpg',10,10,'',0,0),
	(6,'2018-10-13 13:23:28','2018-10-14 02:23:28',1,0,1,'192.168.1.106','Dryer 2',2,1,'',2,'/images/machine/tmp/','washingmachine.jpg',10,10,'',0,0),
	(7,'2018-10-13 13:23:52','2018-10-14 02:23:52',1,0,1,'192.168.1.107','Dryer 3',2,1,'',2,'/images/machine/tmp/','washingmachine.jpg',10,10,'',0,0),
	(8,'2018-10-13 13:24:09','2018-10-14 02:24:09',1,0,1,'192.168.1.108','Dryer 4',2,1,'',2,'/images/machine/tmp/','washingmachine.jpg',10,10,'',0,0);

/*!40000 ALTER TABLE `machines` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table menus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;

INSERT INTO `menus` (`id`, `created_at`, `updated_at`, `name`, `module_id`, `is_main_menu`, `is_parent`, `parent_id`, `is_url`, `controller_id`, `controller_name`, `action_id`, `action_name`, `params`, `orders`, `li_class`, `i_class`, `span_class`, `link_class`, `is_deleted`)
VALUES
	(1,'2017-11-05 02:46:13','2017-11-04 23:46:13','User Access',1,1,1,0,0,0,NULL,0,NULL,NULL,1,'treeview','fa fa-lg fa-fw fa-gear','menu-item-parent',NULL,0),
	(3,'2017-11-05 02:48:20','2017-11-04 23:48:20','Manage',1,0,0,1,1,0,'users',0,'admin',NULL,2,'treeview-menu\"',NULL,NULL,NULL,0),
	(4,'2017-11-05 02:50:36','2017-11-04 23:50:36','Change Password',1,0,0,1,1,0,'users',0,'changePassword',NULL,3,'treeview-menu\"',NULL,NULL,NULL,0),
	(5,'2018-07-20 14:52:06','2018-07-20 19:52:06','Dealers',1,1,1,0,0,0,'',0,'',NULL,0,'treeview','fa fa-lg fa-fw fa-gear','menu-item-parent',NULL,0),
	(6,'2018-07-20 14:54:00','2018-07-20 19:54:00','Mange',1,0,0,5,1,2,'dealers',2,'admin',NULL,0,'treeview-menu\"',NULL,NULL,NULL,0),
	(7,'2018-07-22 21:33:14','2018-07-23 02:33:14','Clients',1,1,1,0,0,0,NULL,0,NULL,NULL,0,'treeview','fa fa-lg fa-fw fa-gear','menu-item-parent',NULL,0),
	(8,'2018-07-22 21:37:26','2018-07-23 02:37:26','Mange',1,0,0,7,1,3,'clients',2,'admin',NULL,0,NULL,'fa fa-lg fa-fw fa-gear','menu-item-parent',NULL,0),
	(9,'2018-07-22 21:43:31','2018-07-23 02:43:31','Settings',1,0,1,0,0,0,'',0,'',NULL,0,NULL,'fa fa-lg fa-fw fa-gear','menu-item-parent',NULL,0),
	(10,'2018-07-22 21:49:40','2018-07-23 02:49:40','Expenses',1,0,0,9,1,4,'expensesTypes',2,'admin',NULL,0,NULL,'fa fa-lg fa-fw fa-gear','menu-item-parent',NULL,0),
	(11,'2018-07-22 21:50:10','2018-07-23 02:50:10','Inventory Categories',1,0,0,9,1,5,'inventoryCategories',2,'admin',NULL,0,NULL,'fa fa-lg fa-fw fa-gear','menu-item-parent',NULL,0),
	(12,'2018-07-22 21:50:41','2018-07-23 02:50:41','Loyalties',1,0,0,9,1,6,'loyaltyTypes',2,'admin',NULL,0,NULL,'fa fa-lg fa-fw fa-gear','menu-item-parent',NULL,0),
	(13,'2018-07-22 21:51:15','2018-07-23 02:51:15','Payment Types',1,0,0,9,1,7,'paymentTypes',2,'admin',NULL,0,NULL,'fa fa-lg fa-fw fa-gear','menu-item-parent',NULL,0);

/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table models
# ------------------------------------------------------------

DROP TABLE IF EXISTS `models`;

CREATE TABLE `models` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` date NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `brand_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `models` WRITE;
/*!40000 ALTER TABLE `models` DISABLE KEYS */;

INSERT INTO `models` (`id`, `created_at`, `updated_at`, `name`, `brand_id`)
VALUES
	(1,'2015-09-24','2015-09-25 07:07:23','Jazz 2015',1),
	(2,'2015-09-24','2015-09-25 07:07:30','Civic 2015',1),
	(3,'2015-09-24','2015-09-25 07:07:39','Innov 2015',2),
	(4,'2015-09-24','2015-09-25 07:08:45','Mirage 2014',3),
	(5,'2015-09-24','2015-09-25 07:08:56','Avanaza 2015',2);

/*!40000 ALTER TABLE `models` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table modules
# ------------------------------------------------------------

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;

INSERT INTO `modules` (`id`, `created_at`, `updated_at`, `name`, `is_deleted`)
VALUES
	(1,'2017-07-15 15:26:05','2017-07-15 17:26:05','webservice',0),
	(2,'2018-07-11 12:31:41','2018-07-11 17:31:45','siteadmin',0),
	(3,'2018-07-11 12:31:56','2018-07-11 17:31:58','client',0),
	(4,'2018-07-11 12:31:56','2018-07-16 16:53:21','backoffice',0),
	(5,'2018-07-11 12:31:56','2018-07-16 16:53:21','user',0);

/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table municipalities
# ------------------------------------------------------------

DROP TABLE IF EXISTS `municipalities`;

CREATE TABLE `municipalities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `province_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `munProvinceID` (`province_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `municipalities` WRITE;
/*!40000 ALTER TABLE `municipalities` DISABLE KEYS */;

INSERT INTO `municipalities` (`id`, `created_at`, `updated_at`, `province_id`, `name`, `is_deleted`)
VALUES
	(1,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Adams',0),
	(2,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Bacarra',0),
	(3,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Badoc',0),
	(4,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Bangui',0),
	(5,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'City Of Batac',0),
	(6,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Burgos',0),
	(7,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Carasi',0),
	(8,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Currimao',0),
	(9,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Dingras',0),
	(10,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Dumalineg',0),
	(11,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Banna',0),
	(12,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Laoag',0),
	(13,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Marcos',0),
	(14,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Nueva Era',0),
	(15,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Pagudpud',0),
	(16,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Paoay',0),
	(17,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Pasuquin',0),
	(18,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Piddig',0),
	(19,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Pinili',0),
	(20,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'San Nicolas',0),
	(21,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Sarrat',0),
	(22,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Solsona',0),
	(23,'2014-10-15 16:31:04','2014-10-17 20:31:04',1,'Vintar',0),
	(24,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Alilem',0),
	(25,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Banayoyo',0),
	(26,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Bantay',0),
	(27,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Burgos',0),
	(28,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Cabugao',0),
	(29,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'City Of Candon',0),
	(30,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Caoayan',0),
	(31,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Cervantes',0),
	(32,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Galimuyod',0),
	(33,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Gregorio Del Pilar',0),
	(34,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Lidliddan',0),
	(35,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Magsingal',0),
	(36,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Nagbukel',0),
	(37,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Narvacan',0),
	(38,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Quirino',0),
	(39,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Salcedo',0),
	(40,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'San Emilio',0),
	(41,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'San Esteban',0),
	(42,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'San Ildefonso',0),
	(43,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'San Juan',0),
	(44,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'San Vicente',0),
	(45,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Santa',0),
	(46,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Santa Catalina',0),
	(47,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Santa Cruz',0),
	(48,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Santa Lucia',0),
	(49,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Santa Maria',0),
	(50,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Santiago',0),
	(51,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Santo Domingo',0),
	(52,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Sigay',0),
	(53,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Sinait',0),
	(54,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Sugpon',0),
	(55,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Suyo',0),
	(56,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'Tagudin',0),
	(57,'2014-10-15 16:31:04','2014-10-17 20:31:04',4,'City Of Vigan',0),
	(58,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Agoo',0),
	(59,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Aringay',0),
	(60,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Bacnotan',0),
	(61,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Bagulin',0),
	(62,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Balaoan',0),
	(63,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Bangar',0),
	(64,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Bauang',0),
	(65,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Burgos',0),
	(66,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Caba',0),
	(67,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Luna',0),
	(68,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Naguilian',0),
	(69,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Pugo',0),
	(70,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Rosario',0),
	(71,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'City Of San Fernando',0),
	(72,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'San Gabriel',0),
	(73,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'San Juan',0),
	(74,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Santo Tomas',0),
	(75,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Santol',0),
	(76,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Sudipen',0),
	(77,'2014-10-15 16:31:04','2014-10-17 20:31:04',3,'Tubao',0),
	(78,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Agno',0),
	(79,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Aguilar',0),
	(80,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'City Of Alaminos',0),
	(81,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Alcala',0),
	(82,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Anda',0),
	(83,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Asingan',0),
	(84,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Balungao',0),
	(85,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Bani',0),
	(86,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Basista',0),
	(87,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Bautista',0),
	(88,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Bayambang',0),
	(89,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Binalonan',0),
	(90,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Binmaley',0),
	(91,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Bolinao',0),
	(92,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Bugallon',0),
	(93,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Burgos',0),
	(94,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Calasiao',0),
	(95,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Dagupan City',0),
	(96,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Dasol',0),
	(97,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Infanta',0),
	(98,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Labrador',0),
	(99,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Lingayen',0),
	(100,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Mabini',0),
	(101,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Malasiqui',0),
	(102,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Manaoag',0),
	(103,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Mangaldan',0),
	(104,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Mangatarem',0),
	(105,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Mapandan',0),
	(106,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Natividad',0),
	(107,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Pozorubbio',0),
	(108,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Rosales',0),
	(109,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'San Carlos City',0),
	(110,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'San Fabian',0),
	(111,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'san Jacinto',0),
	(112,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'San Manuel',0),
	(113,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'San Nicolas',0),
	(114,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'San Quintin',0),
	(115,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Santa Barbara',0),
	(116,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Santa Maria',0),
	(117,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Santo Tomas',0),
	(118,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Sison',0),
	(119,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Sual',0),
	(120,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Tayug',0),
	(121,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Umingan',0),
	(122,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Urbiztondo',0),
	(123,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'City Of Urdaneta',0),
	(124,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Villasis',0),
	(125,'2014-10-15 16:31:04','2014-10-17 20:31:04',2,'Laoac',0),
	(126,'2014-10-15 16:31:04','2014-10-17 20:31:04',9,'Basco',0),
	(127,'2014-10-15 16:31:04','2014-10-17 20:31:04',9,'Itbayat',0),
	(128,'2014-10-15 16:31:04','2014-10-17 20:31:04',9,'Ivana',0),
	(129,'2014-10-15 16:31:04','2014-10-17 20:31:04',9,'Mahatao',0),
	(130,'2014-10-15 16:31:04','2014-10-17 20:31:04',9,'Sabtang',0),
	(131,'2014-10-15 16:31:04','2014-10-17 20:31:04',9,'Uyugan',0),
	(132,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Abulug',0),
	(133,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Alcala',0),
	(134,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Allacapan',0),
	(135,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Amulung',0),
	(136,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Aparri',0),
	(137,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Baggao',0),
	(138,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Ballesteros',0),
	(139,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Buguey',0),
	(140,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Calayan',0),
	(141,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Camalaniugan',0),
	(142,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Claveria',0),
	(143,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Enrile',0),
	(144,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Gattaran',0),
	(145,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Gonzaga',0),
	(146,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Iguig',0),
	(147,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Lal-lo',0),
	(148,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Lasam',0),
	(149,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Pamplona',0),
	(150,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'PeÑablanca',0),
	(151,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Piat',0),
	(152,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Rizal',0),
	(153,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Sanchez-Mira',0),
	(154,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Santa Ana',0),
	(155,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Santa Praxedes',0),
	(156,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Santa Teresita',0),
	(157,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Santo NiÑo',0),
	(158,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Solana',0),
	(159,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Tuao',0),
	(160,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'Tuguegarao',0),
	(161,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Alicia',0),
	(162,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Angadanan',0),
	(163,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Aurora',0),
	(164,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Benito Soliven',0),
	(165,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Burgos',0),
	(166,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Cabagan',0),
	(167,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Cabatuan',0),
	(168,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'City Of Cauayan',0),
	(169,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Cordon',0),
	(170,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Dinapigue',0),
	(171,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Divilacan',0),
	(172,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Echague',0),
	(173,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Gamu',0),
	(174,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Ilagan',0),
	(175,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Jones',0),
	(176,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Luna',0),
	(177,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Maconacon',0),
	(178,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Delfin Albano',0),
	(179,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Mallig',0),
	(180,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Naguilian',0),
	(181,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Palanan',0),
	(182,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Quezon',0),
	(183,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Quirino',0),
	(184,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Ramon',0),
	(185,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Reina Mercedes',0),
	(186,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Roxas',0),
	(187,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'San Agustin',0),
	(188,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'San Guillermo',0),
	(189,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'San Isidro',0),
	(190,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'San Manuel',0),
	(191,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'San Mariano',0),
	(192,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'San Mateo',0),
	(193,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'San Pablo',0),
	(194,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Santa Maria',0),
	(195,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'City Of Santiago',0),
	(196,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Santo Tomas',0),
	(197,'2014-10-15 16:31:04','2014-10-17 20:31:04',6,'Tumauini',0),
	(198,'2014-10-15 16:31:04','2014-10-17 20:31:04',7,'Ambaguio',0),
	(199,'2014-10-15 16:31:04','2014-10-17 20:31:04',7,'Aritao',0),
	(200,'2014-10-15 16:31:04','2014-10-17 20:31:04',7,'Bagabag',0),
	(201,'2014-10-15 16:31:04','2014-10-17 20:31:04',7,'BAmbang',0),
	(202,'2014-10-15 16:31:04','2014-10-17 20:31:04',7,'Bayombong',0),
	(203,'2014-10-15 16:31:04','2014-10-17 20:31:04',7,'Diadi',0),
	(204,'2014-10-15 16:31:04','2014-10-17 20:31:04',7,'Dupax Del Norte',0),
	(205,'2014-10-15 16:31:04','2014-10-17 20:31:04',7,'Dupax Del Sur',0),
	(206,'2014-10-15 16:31:04','2014-10-17 20:31:04',7,'Kasibu',0),
	(207,'2014-10-15 16:31:04','2014-10-17 20:31:04',7,'Kayapa',0),
	(208,'2014-10-15 16:31:04','2014-10-17 20:31:04',7,'Quezon',0),
	(209,'2014-10-15 16:31:04','2014-10-17 20:31:04',7,'Santa',0),
	(210,'2014-10-15 16:31:04','2014-10-17 20:31:04',7,'Solano',0),
	(211,'2014-10-15 16:31:04','2014-10-17 20:31:04',7,'Villaverde',0),
	(212,'2014-10-15 16:31:04','2014-10-17 20:31:04',7,'Alfonso Castaneda',0),
	(213,'2014-10-15 16:31:04','2014-10-17 20:31:04',8,'Aglipay',0),
	(214,'2014-10-15 16:31:04','2014-10-17 20:31:04',8,'Cabarroguis',0),
	(215,'2014-10-15 16:31:04','2014-10-17 20:31:04',8,'Diffun',0),
	(216,'2014-10-15 16:31:04','2014-10-17 20:31:04',8,'Maddela',0),
	(217,'2014-10-15 16:31:04','2014-10-17 20:31:04',8,'Saguday',0),
	(218,'2014-10-15 16:31:04','2014-10-17 20:31:04',8,'Nagtipunan',0),
	(219,'2014-10-15 16:31:04','2014-10-17 20:31:04',16,'Abucay',0),
	(220,'2014-10-15 16:31:04','2014-10-17 20:31:04',16,'Bagac',0),
	(221,'2014-10-15 16:31:04','2014-10-17 20:31:04',16,'City Of Balanga',0),
	(222,'2014-10-15 16:31:04','2014-10-17 20:31:04',16,'Dinalupihan',0),
	(223,'2014-10-15 16:31:04','2014-10-17 20:31:04',16,'Hermosa',0),
	(224,'2014-10-15 16:31:04','2014-10-17 20:31:04',16,'Limay',0),
	(225,'2014-10-15 16:31:04','2014-10-17 20:31:04',16,'Mariveles',0),
	(226,'2014-10-15 16:31:04','2014-10-17 20:31:04',16,'Morong',0),
	(227,'2014-10-15 16:31:04','2014-10-17 20:31:04',16,'Orani',0),
	(228,'2014-10-15 16:31:04','2014-10-17 20:31:04',16,'Orion',0),
	(229,'2014-10-15 16:31:04','2014-10-17 20:31:04',16,'Pilar',0),
	(230,'2014-10-15 16:31:04','2014-10-17 20:31:04',16,'Samal',0),
	(231,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Angat',0),
	(232,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Balagtas',0),
	(233,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Baliuag',0),
	(234,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Bocaue',0),
	(235,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Bulacan',0),
	(236,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Bustos',0),
	(237,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Calumpit',0),
	(238,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Guiguinto',0),
	(239,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Hagonoy',0),
	(240,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'City Of Malolos',0),
	(241,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Marilao',0),
	(242,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'City Of Meycauayan',0),
	(243,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Norzagaray',0),
	(244,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Obando',0),
	(245,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Pandi',0),
	(246,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Paombong',0),
	(247,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Plaridel',0),
	(248,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Pulilan',0),
	(249,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'San Ildefonso',0),
	(250,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'City Of San Jose Del Monte',0),
	(251,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'San Miguel',0),
	(252,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'San Rafael',0),
	(253,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'Santa Maria',0),
	(254,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'DoÑa Remedios Trinidad',0),
	(255,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Aliaga',0),
	(256,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Bongabon',0),
	(257,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Cabanatuan City',0),
	(258,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Cabiao',0),
	(259,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Carranglan',0),
	(260,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Cuyapo',0),
	(261,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Gabaldon',0),
	(262,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'City Of Gapan',0),
	(263,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'General Mamerto Natividad',0),
	(264,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'General Tinio',0),
	(265,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Guimba',0),
	(266,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Jaen',0),
	(267,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Laur',0),
	(268,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Licab',0),
	(269,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Llanera',0),
	(270,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Lupao',0),
	(271,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Science City Of Muñoz',0),
	(272,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Nampicuan',0),
	(273,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Palayan City',0),
	(274,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Pantabangan',0),
	(275,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'PeÑaranda',0),
	(276,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Quezon',0),
	(277,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Rizal',0),
	(278,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'San Antonio',0),
	(279,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'San Isidro',0),
	(280,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'San Jose City',0),
	(281,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'San Leonardo',0),
	(282,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Santa Rosa',0),
	(283,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Santo Domingo',0),
	(284,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Talavera',0),
	(285,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Talugtug',0),
	(286,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'Zaragoza',0),
	(287,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Angeles City',0),
	(288,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Apalit',0),
	(289,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Arayat',0),
	(290,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Bacolor',0),
	(291,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Candaba',0),
	(292,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Floridablanca',0),
	(293,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Guagua',0),
	(294,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Lubao',0),
	(295,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Mabalacat',0),
	(296,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Macabebe',0),
	(297,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Magalang',0),
	(298,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Masantol',0),
	(299,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Mexico',0),
	(300,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Minalin',0),
	(301,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Porac',0),
	(302,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'City Of San Fernando',0),
	(303,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'San Luis',0),
	(304,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'San Simon',0),
	(305,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Santa ANa',0),
	(306,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Santa Rita',0),
	(307,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Santo Tomas',0),
	(308,'2014-10-15 16:31:04','2014-10-17 20:31:04',13,'Sasmuan',0),
	(309,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'Anao',0),
	(310,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'Bamban',0),
	(311,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'Camiling',0),
	(312,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'Capas',0),
	(313,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'Conception',0),
	(314,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'Gerona',0),
	(315,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'La Paz',0),
	(316,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'Mayantoc',0),
	(317,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'Moncada',0),
	(318,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'Paniqui',0),
	(319,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'Pura',0),
	(320,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'Ramos',0),
	(321,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'San Clemente',0),
	(322,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'San Manuel',0),
	(323,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'Santa Ignacia',0),
	(324,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'City Of Tarlac',0),
	(325,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'Victoria',0),
	(326,'2014-10-15 16:31:04','2014-10-17 20:31:04',14,'San Jose',0),
	(327,'2014-10-15 16:31:04','2014-10-17 20:31:04',15,'Botolan',0),
	(328,'2014-10-15 16:31:04','2014-10-17 20:31:04',15,'Cabangan',0),
	(329,'2014-10-15 16:31:04','2014-10-17 20:31:04',15,'Candelaria',0),
	(330,'2014-10-15 16:31:04','2014-10-17 20:31:04',15,'Castillejos',0),
	(331,'2014-10-15 16:31:04','2014-10-17 20:31:04',15,'Iba',0),
	(332,'2014-10-15 16:31:04','2014-10-17 20:31:04',15,'Masinloc',0),
	(333,'2014-10-15 16:31:04','2014-10-17 20:31:04',15,'Olongapo City',0),
	(334,'2014-10-15 16:31:04','2014-10-17 20:31:04',15,'Palauig',0),
	(335,'2014-10-15 16:31:04','2014-10-17 20:31:04',15,'San Atonio',0),
	(336,'2014-10-15 16:31:04','2014-10-17 20:31:04',15,'San Felipe',0),
	(337,'2014-10-15 16:31:04','2014-10-17 20:31:04',15,'San Marcelino',0),
	(338,'2014-10-15 16:31:04','2014-10-17 20:31:04',15,'San Narciso',0),
	(339,'2014-10-15 16:31:04','2014-10-17 20:31:04',15,'Santa Cruz',0),
	(340,'2014-10-15 16:31:04','2014-10-17 20:31:04',15,'Subic',0),
	(341,'2014-10-15 16:31:04','2014-10-17 20:31:04',10,'Baler',0),
	(342,'2014-10-15 16:31:04','2014-10-17 20:31:04',10,'Casiguran',0),
	(343,'2014-10-15 16:31:04','2014-10-17 20:31:04',10,'Dilasag',0),
	(344,'2014-10-15 16:31:04','2014-10-17 20:31:04',10,'Dinalungan',0),
	(345,'2014-10-15 16:31:04','2014-10-17 20:31:04',10,'Dingalan',0),
	(346,'2014-10-15 16:31:04','2014-10-17 20:31:04',10,'Dipaculao',0),
	(347,'2014-10-15 16:31:04','2014-10-17 20:31:04',10,'Maria Aurora',0),
	(348,'2014-10-15 16:31:04','2014-10-17 20:31:04',10,'San Luis',0),
	(349,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Agoncillo',0),
	(350,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Alitagtag',0),
	(351,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Balayan',0),
	(352,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Balete',0),
	(353,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Batangas City',0),
	(354,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Bauan',0),
	(355,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Calaca',0),
	(356,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Calatagan',0),
	(357,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Cuenca',0),
	(358,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Ibaan',0),
	(359,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Laurel',0),
	(360,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Lemery',0),
	(361,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Lian',0),
	(362,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Lipa City',0),
	(363,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Lobo',0),
	(364,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Mabini',0),
	(365,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Malvar',0),
	(366,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Mataasnakahoy',0),
	(367,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Nasugbu',0),
	(368,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Padre Garcia',0),
	(369,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Rosario',0),
	(370,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'San Jose',0),
	(371,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'San Juan',0),
	(372,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'San Luis',0),
	(373,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'San Nicolas',0),
	(374,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'San Pascual',0),
	(375,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Santa Teresita',0),
	(376,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Santo Tomas',0),
	(377,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Taal',0),
	(378,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Talisay',0),
	(379,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'City Of Tanauan',0),
	(380,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Taysan',0),
	(381,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Tingloy',0),
	(382,'2014-10-15 16:31:04','2014-10-17 20:31:04',20,'Tuy',0),
	(383,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Alfonso',0),
	(384,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Amadeo',0),
	(385,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Bacoor City',0),
	(386,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Carmona',0),
	(387,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Cavite City',0),
	(388,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'City Of Dasmariñas',0),
	(389,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'General Emilio Aguinaldo',0),
	(390,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'General Trias',0),
	(391,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Imus City',0),
	(392,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Indang',0),
	(393,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Kawait',0),
	(394,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Magallanes',0),
	(395,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Maragondon',0),
	(396,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Mendez',0),
	(397,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Naic',0),
	(398,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Noveleta',0),
	(399,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Rosario',0),
	(400,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Silang',0),
	(401,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Tagaytay City',0),
	(402,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Tanza',0),
	(403,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Ternate',0),
	(404,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Trece Martires City',0),
	(405,'2014-10-15 16:31:04','2014-10-17 20:31:04',19,'Gen.Mariano Alvarez',0),
	(406,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Alaminos',0),
	(407,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Bay',0),
	(408,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'City Of Biñan',0),
	(409,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Cabuyao',0),
	(410,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'City Of Calamba',0),
	(411,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Calauan',0),
	(412,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Cavinti',0),
	(413,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Famy',0),
	(414,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Kalayaan',0),
	(415,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Liliw',0),
	(416,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Los Baños',0),
	(417,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Luisiana',0),
	(418,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Lumban',0),
	(419,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Mabitac',0),
	(420,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Magdalena',0),
	(421,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Majayjay',0),
	(422,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Nagcarlan',0),
	(423,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Paete',0),
	(424,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Pagsanjan',0),
	(425,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Pakil',0),
	(426,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Pangil',0),
	(427,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Pila',0),
	(428,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Rizal',0),
	(429,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'San Pablo City',0),
	(430,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'San Pedro',0),
	(431,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Santa Cruz',0),
	(432,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Santa Maria',0),
	(433,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'City Of Santa Rosa',0),
	(434,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Siniloan',0),
	(435,'2014-10-15 16:31:04','2014-10-17 20:31:04',18,'Victoria',0),
	(436,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Agdangan',0),
	(437,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Alabat',0),
	(438,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Atimonan',0),
	(439,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Buenavista',0),
	(440,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Burdeos',0),
	(441,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Calauag',0),
	(442,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Candelaria',0),
	(443,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Catanauan',0),
	(444,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Dolores',0),
	(445,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'General Luna',0),
	(446,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'General Nakar',0),
	(447,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Guinayangan',0),
	(448,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Gumaca',0),
	(449,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Infanta',0),
	(450,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Jomalig',0),
	(451,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Lopez',0),
	(452,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Lucban',0),
	(453,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Lucena City',0),
	(454,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Macalelon',0),
	(455,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Mauban',0),
	(456,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Mulanay',0),
	(457,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Padre Burgos',0),
	(458,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Pagbilao',0),
	(459,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Panukulan',0),
	(460,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Patnanungan',0),
	(461,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Perez',0),
	(462,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Pitogo',0),
	(463,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Plaridel',0),
	(464,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Polillo',0),
	(465,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Quezon',0),
	(466,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Real',0),
	(467,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Sampaloc',0),
	(468,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'San Andres',0),
	(469,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'San Antonio',0),
	(470,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'San Francisco',0),
	(471,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'San Narciso',0),
	(472,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Sariaya',0),
	(473,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Tagkawayan',0),
	(474,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'City Of Tayabas',0),
	(475,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Tiaong',0),
	(476,'2014-10-15 16:31:04','2014-10-17 20:31:04',17,'Unisan',0),
	(477,'2014-10-15 16:31:04','2014-10-17 20:31:04',21,'Angono',0),
	(478,'2014-10-15 16:31:04','2014-10-17 20:31:04',21,'City Of Antipolo',0),
	(479,'2014-10-15 16:31:04','2014-10-17 20:31:04',21,'Baras',0),
	(480,'2014-10-15 16:31:04','2014-10-17 20:31:04',21,'Binangonan',0),
	(481,'2014-10-15 16:31:04','2014-10-17 20:31:04',21,'Cainta',0),
	(482,'2014-10-15 16:31:04','2014-10-17 20:31:04',21,'Cardona',0),
	(483,'2014-10-15 16:31:04','2014-10-17 20:31:04',21,'Jala-Jala',0),
	(484,'2014-10-15 16:31:04','2014-10-17 20:31:04',21,'Rodriguez',0),
	(485,'2014-10-15 16:31:04','2014-10-17 20:31:04',21,'Morong',0),
	(486,'2014-10-15 16:31:04','2014-10-17 20:31:04',21,'Pililla',0),
	(487,'2014-10-15 16:31:04','2014-10-17 20:31:04',21,'San Mateo',0),
	(488,'2014-10-15 16:31:04','2014-10-17 20:31:04',21,'Tanay',0),
	(489,'2014-10-15 16:31:04','2014-10-17 20:31:04',21,'Taytay',0),
	(490,'2014-10-15 16:31:04','2014-10-17 20:31:04',21,'Teresa',0),
	(491,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'Bacacay',0),
	(492,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'Camalig',0),
	(493,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'Daraga',0),
	(494,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'Guinobatan',0),
	(495,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'Jovellar',0),
	(496,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'Legazpi City',0),
	(497,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'Libon',0),
	(498,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'City Of Ligao',0),
	(499,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'Malilipot',0),
	(500,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'Malinao',0),
	(501,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'Manito',0),
	(502,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'OAS',0),
	(503,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'Pio Duran',0),
	(504,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'Polangui',0),
	(505,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'Rapu-Rapu',0),
	(506,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'Santo Domingo',0),
	(507,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'City Of Tabaco',0),
	(508,'2014-10-15 16:31:04','2014-10-17 20:31:04',23,'Tiwi',0),
	(509,'2014-10-15 16:31:04','2014-10-17 20:31:04',25,'Basud',0),
	(510,'2014-10-15 16:31:04','2014-10-17 20:31:04',25,'Capalonga',0),
	(511,'2014-10-15 16:31:04','2014-10-17 20:31:04',25,'Daet',0),
	(512,'2014-10-15 16:31:04','2014-10-17 20:31:04',25,'San Lorenzo Ruiz',0),
	(513,'2014-10-15 16:31:04','2014-10-17 20:31:04',25,'Jose Panganiban',0),
	(514,'2014-10-15 16:31:04','2014-10-17 20:31:04',25,'Labo',0),
	(515,'2014-10-15 16:31:04','2014-10-17 20:31:04',25,'Mercedes',0),
	(516,'2014-10-15 16:31:04','2014-10-17 20:31:04',25,'Paracale',0),
	(517,'2014-10-15 16:31:04','2014-10-17 20:31:04',25,'San Vicente',0),
	(518,'2014-10-15 16:31:04','2014-10-17 20:31:04',25,'Santa Elena',0),
	(519,'2014-10-15 16:31:04','2014-10-17 20:31:04',25,'Talisay',0),
	(520,'2014-10-15 16:31:04','2014-10-17 20:31:04',25,'Vinzons',0),
	(521,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Baao',0),
	(522,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Balatan',0),
	(523,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Bato',0),
	(524,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Bombon',0),
	(525,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Buhi',0),
	(526,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Bula',0),
	(527,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Cabusao',0),
	(528,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Calabanga',0),
	(529,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Camaligan',0),
	(530,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Canaman',0),
	(531,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Caramoan',0),
	(532,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Del Gallego',0),
	(533,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Gainza',0),
	(534,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Garchitorena',0),
	(535,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'GOA',0),
	(536,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Iriga City',0),
	(537,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Lagonoy',0),
	(538,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Libmahan',0),
	(539,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Lupi',0),
	(540,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Magarao',0),
	(541,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Milaor',0),
	(542,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Minalabac',0),
	(543,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Nabua',0),
	(544,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Naga City',0),
	(545,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Ocampo',0),
	(546,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Pamplona',0),
	(547,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Pasacao',0),
	(548,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Pili',0),
	(549,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Presentacion',0),
	(550,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Ragay',0),
	(551,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Sagñay',0),
	(552,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'San Fernando',0),
	(553,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'San Jose',0),
	(554,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Sipocot',0),
	(555,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Siruma',0),
	(556,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Tigaon',0),
	(557,'2014-10-15 16:31:04','2014-10-17 20:31:04',24,'Tinambac',0),
	(558,'2014-10-15 16:31:04','2014-10-17 20:31:04',22,'Bagamanoc',0),
	(559,'2014-10-15 16:31:04','2014-10-17 20:31:04',22,'Baras',0),
	(560,'2014-10-15 16:31:04','2014-10-17 20:31:04',22,'Bat0',0),
	(561,'2014-10-15 16:31:04','2014-10-17 20:31:04',22,'Caramoran',0),
	(562,'2014-10-15 16:31:04','2014-10-17 20:31:04',22,'Gigmoto',0),
	(563,'2014-10-15 16:31:04','2014-10-17 20:31:04',22,'Pandan',0),
	(564,'2014-10-15 16:31:04','2014-10-17 20:31:04',22,'Panganiban',0),
	(565,'2014-10-15 16:31:04','2014-10-17 20:31:04',22,'San Andres',0),
	(566,'2014-10-15 16:31:04','2014-10-17 20:31:04',22,'San Miguel',0),
	(567,'2014-10-15 16:31:04','2014-10-17 20:31:04',22,'Viga',0),
	(568,'2014-10-15 16:31:04','2014-10-17 20:31:04',22,'Virac',0),
	(569,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Aroroy',0),
	(570,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Baleno',0),
	(571,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Balud',0),
	(572,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Batuan',0),
	(573,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Cataingan',0),
	(574,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Cawayan',0),
	(575,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Claveria',0),
	(576,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Dimasalang',0),
	(577,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Esperanza',0),
	(578,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Mandaon',0),
	(579,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'City Of Masbate',0),
	(580,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Milagros',0),
	(581,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Mobo',0),
	(582,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Monreal',0),
	(583,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Palanas',0),
	(584,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Pio V.Corpuz',0),
	(585,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Placer',0),
	(586,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'San Fernando',0),
	(587,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'San Jacinto',0),
	(588,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'San Pascual',0),
	(589,'2014-10-15 16:31:04','2014-10-17 20:31:04',27,'Uson',0),
	(590,'2014-10-15 16:31:04','2014-10-17 20:31:04',26,'Barcelona',0),
	(591,'2014-10-15 16:31:04','2014-10-17 20:31:04',26,'Bulan',0),
	(592,'2014-10-15 16:31:04','2014-10-17 20:31:04',26,'Bulusan',0),
	(593,'2014-10-15 16:31:04','2014-10-17 20:31:04',26,'Casiguran',0),
	(594,'2014-10-15 16:31:04','2014-10-17 20:31:04',26,'Castilla',0),
	(595,'2014-10-15 16:31:04','2014-10-17 20:31:04',26,'Donsol',0),
	(596,'2014-10-15 16:31:04','2014-10-17 20:31:04',26,'Gubat',0),
	(597,'2014-10-15 16:31:04','2014-10-17 20:31:04',26,'Irosin',0),
	(598,'2014-10-15 16:31:04','2014-10-17 20:31:04',26,'Juban',0),
	(599,'2014-10-15 16:31:04','2014-10-17 20:31:04',26,'Magallanes',0),
	(600,'2014-10-15 16:31:04','2014-10-17 20:31:04',26,'Matnog',0),
	(601,'2014-10-15 16:31:04','2014-10-17 20:31:04',26,'Pilar',0),
	(602,'2014-10-15 16:31:04','2014-10-17 20:31:04',26,'Prieto Diaz',0),
	(603,'2014-10-15 16:31:04','2014-10-17 20:31:04',26,'Santa Magdalena',0),
	(604,'2014-10-15 16:31:04','2014-10-17 20:31:04',26,'City Of Sorsogon',0),
	(605,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'Altavas',0),
	(606,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'Balete',0),
	(607,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'Banga',0),
	(608,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'Batan',0),
	(609,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'Buruanga',0),
	(610,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'Ibajay',0),
	(611,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'Kalibo',0),
	(612,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'Lezo',0),
	(613,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'Libacao',0),
	(614,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'Madalag',0),
	(615,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'Makato',0),
	(616,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'Malay',0),
	(617,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'Malinao',0),
	(618,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'Nabas',0),
	(619,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'New Washington',0),
	(620,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'Numancia',0),
	(621,'2014-10-15 16:31:04','2014-10-17 20:31:04',32,'Tangalan',0),
	(622,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'Anini-Y',0),
	(623,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'Barbaza',0),
	(624,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'Belison',0),
	(625,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'Bugasong',0),
	(626,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'Caluya',0),
	(627,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'Culasi',0),
	(628,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'Tobias Fornier',0),
	(629,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'Hamtic',0),
	(630,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'Laua-An',0),
	(631,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'Libertad',0),
	(632,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'Pandan',0),
	(633,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'Patnongan',0),
	(634,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'San Jose',0),
	(635,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'San Remigio',0),
	(636,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'Sebaste',0),
	(637,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'Sibalom',0),
	(638,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'Tibiao',0),
	(639,'2014-10-15 16:31:04','2014-10-17 20:31:04',30,'Valderrama',0),
	(640,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'Cuartero',0),
	(641,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'DAO',0),
	(642,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'Dumalag',0),
	(643,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'Dumarao',0),
	(644,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'Ivisan',0),
	(645,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'Jamindan',0),
	(646,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'Ma-Ayon',0),
	(647,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'Mambusao',0),
	(648,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'Panay',0),
	(649,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'Panitan',0),
	(650,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'Pilar',0),
	(651,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'Pontevedra',0),
	(652,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'President Roxas',0),
	(653,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'Roxas City',0),
	(654,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'Sapi-An',0),
	(655,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'Sigma',0),
	(656,'2014-10-15 16:31:04','2014-10-17 20:31:04',31,'Tapaz',0),
	(657,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Ajuy',0),
	(658,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Alimodian',0),
	(659,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Anilao',0),
	(660,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Badiangan',0),
	(661,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Balasan',0),
	(662,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Banate',0),
	(663,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Barotac Nuevo',0),
	(664,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Barotac Viejo',0),
	(665,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Batad',0),
	(666,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Bingawan',0),
	(667,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Cabatuan',0),
	(668,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Calinog',0),
	(669,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Carles',0),
	(670,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Concepcion',0),
	(671,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Dingle',0),
	(672,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Dueñas',0),
	(673,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Dumangas',0),
	(674,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Estancia',0),
	(675,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Guimbal',0),
	(676,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Igbaras',0),
	(677,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Iloilo City',0),
	(678,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Janiuay',0),
	(679,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Lambunao',0),
	(680,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Leganes',0),
	(681,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Lemery',0),
	(682,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Leon',0),
	(683,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Maasin',0),
	(684,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Miagao',0),
	(685,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Mina',0),
	(686,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'New Lucena',0),
	(687,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Oton',0),
	(688,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'City Of Passi',0),
	(689,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Pavia',0),
	(690,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Pototan',0),
	(691,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'San Dionisio',0),
	(692,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'San Enrique',0),
	(693,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'San Joaquin',0),
	(694,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'San Miguel',0),
	(695,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'San Rafael',0),
	(696,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Santa Barbara',0),
	(697,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Sara',0),
	(698,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Tigbauan',0),
	(699,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Tubungan',0),
	(700,'2014-10-15 16:31:04','2014-10-17 20:31:04',28,'Zarraga',0),
	(701,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Bacolod City',0),
	(702,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Bago City',0),
	(703,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Binalbagan',0),
	(704,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Cadiz City',0),
	(705,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Calatrava',0),
	(706,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Candoni',0),
	(707,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Cauayan',0),
	(708,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Enrique B.Magalona',0),
	(709,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'City Of Escalante',0),
	(710,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'City Of Himamaylan',0),
	(711,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Hinigaran',0),
	(712,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Hinoba-An',0),
	(713,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Ilog',0),
	(714,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Isabela',0),
	(715,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'City Of Kabankalan',0),
	(716,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'La Carlota City',0),
	(717,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'La Castellana',0),
	(718,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Manapla',0),
	(719,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Moises Padilla',0),
	(720,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Murcia',0),
	(721,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Pontevedra',0),
	(722,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Pulupandan',0),
	(723,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Sagay City',0),
	(724,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'San Carlos City',0),
	(725,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'San Enrique',0),
	(726,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Silay City',0),
	(727,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'City Of Sipalay',0),
	(728,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'City Of Talisay',0),
	(729,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Toboso',0),
	(730,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Villadolid',0),
	(731,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'City Of VIctorias',0),
	(732,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Salvador Benedicto',0),
	(733,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Toboso',0),
	(734,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Villadolid',0),
	(735,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'City Of Victorias',0),
	(736,'2014-10-15 16:31:04','2014-10-17 20:31:04',33,'Salvador Benedicto',0),
	(737,'2014-10-15 16:31:04','2014-10-17 20:31:04',29,'Buenavista',0),
	(738,'2014-10-15 16:31:04','2014-10-17 20:31:04',29,'Jordan',0),
	(739,'2014-10-15 16:31:04','2014-10-17 20:31:04',29,'Nueva Valencia',0),
	(740,'2014-10-15 16:31:04','2014-10-17 20:31:04',29,'San Lorenzo',0),
	(741,'2014-10-15 16:31:04','2014-10-17 20:31:04',29,'Sibunag',0),
	(742,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Alburquerque',0),
	(743,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Alicia',0),
	(744,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Anda',0),
	(745,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Antequera',0),
	(746,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Baclayon',0),
	(747,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Balilihan',0),
	(748,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Batuan',0),
	(749,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Bilar',0),
	(750,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Buenavista',0),
	(751,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Calape',0),
	(752,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Candijay',0),
	(753,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Carmen',0),
	(754,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Catigbian',0),
	(755,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Clarin',0),
	(756,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Corella',0),
	(757,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Cortes',0),
	(758,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Dagohoy',0),
	(759,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Danao',0),
	(760,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Dauis',0),
	(761,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Dimiao',0),
	(762,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Duero',0),
	(763,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Garcia Hernandez',0),
	(764,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Guindulman',0),
	(765,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Inabanga',0),
	(766,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Jagna',0),
	(767,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Getafe',0),
	(768,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Lila',0),
	(769,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Loay',0),
	(770,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Loboc',0),
	(771,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Loon',0),
	(772,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Mabini',0),
	(773,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Maribojoc',0),
	(774,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Panglao',0),
	(775,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Pilar',0),
	(776,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Pres.Carlos P.Garcia',0),
	(777,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Sagbayan',0),
	(778,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'San Isidro',0),
	(779,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'San Miguel',0),
	(780,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Sevilla',0),
	(781,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Sierra Bullones',0),
	(782,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Sikatuna',0),
	(783,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Tagbilaran',0),
	(784,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Talibon',0),
	(785,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Trinidad',0),
	(786,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Tubigon',0),
	(787,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Ubay',0),
	(788,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Valencia',0),
	(789,'2014-10-15 16:31:04','2014-10-17 20:31:04',35,'Bien Unido',0),
	(790,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Alcantara',0),
	(791,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Alcoy',0),
	(792,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Alegria',0),
	(793,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Aloguinsan',0),
	(794,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Argao',0),
	(795,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Asturias',0),
	(796,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Badian',0),
	(797,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Balamban',0),
	(798,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Bantayan',0),
	(799,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Barili',0),
	(800,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'City Of Bogo',0),
	(801,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Bolioon',0),
	(802,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Borbon',0),
	(803,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'City Of Carcar',0),
	(804,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Carmen',0),
	(805,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Catmon',0),
	(806,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Cebu City',0),
	(807,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Compostela',0),
	(808,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Consolacion',0),
	(809,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Cordoba',0),
	(810,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Daanbantayan',0),
	(811,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Dalaguete',0),
	(812,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Danao City',0),
	(813,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Dumanjug',0),
	(814,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Ginatilan',0),
	(815,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Lapu-Lapu City',0),
	(816,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Liloan',0),
	(817,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Madridejos',0),
	(818,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Malabuyoc',0),
	(819,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Mandaue City',0),
	(820,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Medellin',0),
	(821,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Minglanilla',0),
	(822,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Moalboal',0),
	(823,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'City Of Naga',0),
	(824,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Oslob',0),
	(825,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Pilar',0),
	(826,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Pinamungahan',0),
	(827,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Poro',0),
	(828,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Ronda',0),
	(829,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Samboan',0),
	(830,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'San Fernando',0),
	(831,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'San Francisco',0),
	(832,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'San Remigio',0),
	(833,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Santa Fe',0),
	(834,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Santander',0),
	(835,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Sibonga',0),
	(836,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Sogod',0),
	(837,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Tabogon',0),
	(838,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Tabuelan',0),
	(839,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'City Of Talisay',0),
	(840,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Toledo City',0),
	(841,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Tuburan',0),
	(842,'2014-10-15 16:31:04','2014-10-17 20:31:04',36,'Tudela',0),
	(843,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Amlan',0),
	(844,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Ayungon',0),
	(845,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Bacong',0),
	(846,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Bais City',0),
	(847,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Basay',0),
	(848,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'City Of Bayawan',0),
	(849,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Bindoy',0),
	(850,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Canlaon City',0),
	(851,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Dauin',0),
	(852,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Dumaguete City',0),
	(853,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'City Of Guihulngan',0),
	(854,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Jimalalud',0),
	(855,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'La Libertad',0),
	(856,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Mabinay',0),
	(857,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Manjuyod',0),
	(858,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Pamplona',0),
	(859,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'San Jose',0),
	(860,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Santa Catalina',0),
	(861,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Siaton',0),
	(862,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Sibulan',0),
	(863,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'City Of Tanjay',0),
	(864,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Tayasan',0),
	(865,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Valencia',0),
	(866,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Vallehermosa',0),
	(867,'2014-10-15 16:31:04','2014-10-17 20:31:04',37,'Zamboangguita',0),
	(868,'2014-10-15 16:31:04','2014-10-17 20:31:04',34,'Enrique Villanueva',0),
	(869,'2014-10-15 16:31:04','2014-10-17 20:31:04',34,'Larena',0),
	(870,'2014-10-15 16:31:04','2014-10-17 20:31:04',34,'Lazi',0),
	(871,'2014-10-15 16:31:04','2014-10-17 20:31:04',34,'Maria',0),
	(872,'2014-10-15 16:31:04','2014-10-17 20:31:04',34,'San Juan',0),
	(873,'2014-10-15 16:31:04','2014-10-17 20:31:04',34,'Siquijor',0),
	(874,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Arteche',0),
	(875,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Balangiga',0),
	(876,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Balangkayan',0),
	(877,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'City Of Borongan',0),
	(878,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Can-Avid',0),
	(879,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Dolores',0),
	(880,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'General Macarthur',0),
	(881,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Giporlos',0),
	(882,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Guiuan',0),
	(883,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Hernani',0),
	(884,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Jipapad',0),
	(885,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Lawaan',0),
	(886,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Llorente',0),
	(887,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Maslog',0),
	(888,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Maydolong',0),
	(889,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Mercedes',0),
	(890,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Oras',0),
	(891,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Quinapondan',0),
	(892,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Salcedo',0),
	(893,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'San Julian',0),
	(894,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'San Policarpo',0),
	(895,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Sulat',0),
	(896,'2014-10-15 16:31:04','2014-10-17 20:31:04',41,'Taft',0),
	(897,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Abuyog',0),
	(898,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Alangalang',0),
	(899,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Albuera',0),
	(900,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Babatngon',0),
	(901,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Barugo',0),
	(902,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Bato',0),
	(903,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'City Of Baybay',0),
	(904,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Burauen',0),
	(905,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Calubian',0),
	(906,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Capoocan',0),
	(907,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Carigara',0),
	(908,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Dagami',0),
	(909,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Dulag',0),
	(910,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Hilongos',0),
	(911,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Hindang',0),
	(912,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Inopacan',0),
	(913,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Isabel',0),
	(914,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Jaro',0),
	(915,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Javier',0),
	(916,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Julita',0),
	(917,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Kananga',0),
	(918,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'La Paz',0),
	(919,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Leyte',0),
	(920,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Macarthur',0),
	(921,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Mahaplag',0),
	(922,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Matag-Ob',0),
	(923,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Matalom',0),
	(924,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Mayorga',0),
	(925,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Merida',0),
	(926,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Ormoc City',0),
	(927,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Palo',0),
	(928,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Palompon',0),
	(929,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Pastrana',0),
	(930,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'San Isidro',0),
	(931,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'San Miguel',0),
	(932,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Santa Fe',0),
	(933,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Tabango',0),
	(934,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Tabontabon',0),
	(935,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Tacloban City',0),
	(936,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Tanauan',0),
	(937,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Tolosa',0),
	(938,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Tunga',0),
	(939,'2014-10-15 16:31:04','2014-10-17 20:31:04',40,'Villaba',0),
	(940,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Allen',0),
	(941,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Biri',0),
	(942,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Bobon',0),
	(943,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Capul',0),
	(944,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Catarman',0),
	(945,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Catubig',0),
	(946,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Gamay',0),
	(947,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Laoang',0),
	(948,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Lapinig',0),
	(949,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Las Navas',0),
	(950,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Lavezares',0),
	(951,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Mapanas',0),
	(952,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Mondragon',0),
	(953,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Palapag',0),
	(954,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Pambujan',0),
	(955,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Rosario',0),
	(956,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'San Antonio',0),
	(957,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'San Isidro',0),
	(958,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'San Jose',0),
	(959,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'San Roque',0),
	(960,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'San Vicente',0),
	(961,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Silvino Lobos',0),
	(962,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Victoria',0),
	(963,'2014-10-15 16:31:04','2014-10-17 20:31:04',42,'Lope De Vega',0),
	(964,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Almagro',0),
	(965,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Basey',0),
	(966,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Calbayog City',0),
	(967,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Calbiga',0),
	(968,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'City Of Catbalogan',0),
	(969,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Daram',0),
	(970,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Gandara',0),
	(971,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Hinabangan',0),
	(972,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Jiabong',0),
	(973,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Marabut',0),
	(974,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Matuguinao',0),
	(975,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Motiong',0),
	(976,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Pinabacdao',0),
	(977,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'San Jose De Buan',0),
	(978,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'San Sebastian',0),
	(979,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Santa Margarita',0),
	(980,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Santa Rita',0),
	(981,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Santo Niño',0),
	(982,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Talalora',0),
	(983,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Tarangnan',0),
	(984,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Villareal',0),
	(985,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Paranas',0),
	(986,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Zumarraga',0),
	(987,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Tagapul-An',0),
	(988,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'San Jorge',0),
	(989,'2014-10-15 16:31:04','2014-10-17 20:31:04',38,'Pagsanghan',0),
	(990,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'Anahawan',0),
	(991,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'Bontoc',0),
	(992,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'Hinunangan',0),
	(993,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'Hinundayan',0),
	(994,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'Libagon',0),
	(995,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'Liloan',0),
	(996,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'City Of Maasin',0),
	(997,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'Macrohon',0),
	(998,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'Malitbog',0),
	(999,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'Padre Burgos',0),
	(1000,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'Pintuyan',0),
	(1001,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'Saint Bernard',0),
	(1002,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'San Francisco',0),
	(1003,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'San Juan',0),
	(1004,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'San Ricardo',0),
	(1005,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'Silago',0),
	(1006,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'Sogod',0),
	(1007,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'Tomas Oppus',0),
	(1008,'2014-10-15 16:31:04','2014-10-17 20:31:04',39,'Limasawa',0),
	(1009,'2014-10-15 16:31:04','2014-10-17 20:31:04',43,'Almeria',0),
	(1010,'2014-10-15 16:31:04','2014-10-17 20:31:04',43,'Biliran',0),
	(1011,'2014-10-15 16:31:04','2014-10-17 20:31:04',43,'Cabucgayan',0),
	(1012,'2014-10-15 16:31:04','2014-10-17 20:31:04',43,'Caibiran',0),
	(1013,'2014-10-15 16:31:04','2014-10-17 20:31:04',43,'Culaba',0),
	(1014,'2014-10-15 16:31:04','2014-10-17 20:31:04',43,'Kawayan',0),
	(1015,'2014-10-15 16:31:04','2014-10-17 20:31:04',43,'Maripipi',0),
	(1016,'2014-10-15 16:31:04','2014-10-17 20:31:04',43,'Naval',0),
	(1017,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Dapitan City',0),
	(1018,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Dipolog City',0),
	(1019,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Katipunan',0),
	(1020,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'La Libertad',0),
	(1021,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Labason',0),
	(1022,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Liloy',0),
	(1023,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Manukan',0),
	(1024,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Mutia',0),
	(1025,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Piñan',0),
	(1026,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Polanco',0),
	(1027,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Pres.Manuel A.Roxas',0),
	(1028,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Rizal',0),
	(1029,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Salug',0),
	(1030,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Sergio Osmeña SR.',0),
	(1031,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Siayan',0),
	(1032,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Sibuco',0),
	(1033,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Sibutad',0),
	(1034,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Sindangan',0),
	(1035,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Siocon',0),
	(1036,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Sirawai',0),
	(1037,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Tampilisan',0),
	(1038,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Jose Dalman',0),
	(1039,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Gutalac',0),
	(1040,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Baliguian',0),
	(1041,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Godod',0),
	(1042,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Bacungan',0),
	(1043,'2014-10-15 16:31:04','2014-10-17 20:31:04',44,'Kalawit',0),
	(1044,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Aurora',0),
	(1045,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Bayog',0),
	(1046,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Dimataling',0),
	(1047,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Dinas',0),
	(1048,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Dumalinao',0),
	(1049,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Dumingag',0),
	(1050,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Kumalarang',0),
	(1051,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Labangan',0),
	(1052,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Lapuyan',0),
	(1053,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Mahayag',0),
	(1054,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Margosatubig',0),
	(1055,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Midsalip',0),
	(1056,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Molave',0),
	(1057,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Pagadian City',0),
	(1058,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Ramon Magsaysay',0),
	(1059,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'San Miguel',0),
	(1060,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'San Pablo',0),
	(1061,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Tabina',0),
	(1062,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Tambulig',0),
	(1063,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Tukuran',0),
	(1064,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Zamboanga City',0),
	(1065,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Lakewood',0),
	(1066,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Josefina',0),
	(1067,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Pitogo',0),
	(1068,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Sominot',0),
	(1069,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Vincenzo A.Sagun',0),
	(1070,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Guipos',0),
	(1071,'2014-10-15 16:31:04','2014-10-17 20:31:04',47,'Tigbao',0),
	(1072,'2014-10-15 16:31:04','2014-10-17 20:31:04',46,'Alicia',0),
	(1073,'2014-10-15 16:31:04','2014-10-17 20:31:04',46,'Buug',0),
	(1074,'2014-10-15 16:31:04','2014-10-17 20:31:04',46,'Diplahan',0),
	(1075,'2014-10-15 16:31:04','2014-10-17 20:31:04',46,'Imelda',0),
	(1076,'2014-10-15 16:31:04','2014-10-17 20:31:04',46,'Ipil',0),
	(1077,'2014-10-15 16:31:04','2014-10-17 20:31:04',46,'Kabasalan',0),
	(1078,'2014-10-15 16:31:04','2014-10-17 20:31:04',46,'Mabuhay',0),
	(1079,'2014-10-15 16:31:04','2014-10-17 20:31:04',46,'Malangas',0),
	(1080,'2014-10-15 16:31:04','2014-10-17 20:31:04',46,'Naga',0),
	(1081,'2014-10-15 16:31:04','2014-10-17 20:31:04',46,'Olutanga',0),
	(1082,'2014-10-15 16:31:04','2014-10-17 20:31:04',46,'Payao',0),
	(1083,'2014-10-15 16:31:04','2014-10-17 20:31:04',46,'Roseller Lim',0),
	(1084,'2014-10-15 16:31:04','2014-10-17 20:31:04',46,'Siay',0),
	(1085,'2014-10-15 16:31:04','2014-10-17 20:31:04',46,'Talusan',0),
	(1086,'2014-10-15 16:31:04','2014-10-17 20:31:04',46,'Titay',0),
	(1087,'2014-10-15 16:31:04','2014-10-17 20:31:04',46,'Tungawan',0),
	(1088,'2014-10-15 16:31:04','2014-10-17 20:31:04',45,'City Of Isabela',0),
	(1089,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Baungon',0),
	(1090,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Damulog',0),
	(1091,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Dangcagan',0),
	(1092,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Don Carlos',0),
	(1093,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Impasug-Ong',0),
	(1094,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Kadingilan',0),
	(1095,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Kalilangan',0),
	(1096,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Kibawe',0),
	(1097,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Kitaotao',0),
	(1098,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Lantapan',0),
	(1099,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Libona',0),
	(1100,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'City Of Malaybalay',0),
	(1101,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Malitbog',0),
	(1102,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Manolo',0),
	(1103,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Maramag',0),
	(1104,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Pangantucan',0),
	(1105,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Quezon',0),
	(1106,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'San Fernando',0),
	(1107,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Sumilao',0),
	(1108,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Talakag',0),
	(1109,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'City Of Valencia',0),
	(1110,'2014-10-15 16:31:04','2014-10-17 20:31:04',50,'Cabanglasan',0),
	(1111,'2014-10-15 16:31:04','2014-10-17 20:31:04',51,'Catarman',0),
	(1112,'2014-10-15 16:31:04','2014-10-17 20:31:04',51,'Guinsiliban',0),
	(1113,'2014-10-15 16:31:04','2014-10-17 20:31:04',51,'Mahinog',0),
	(1114,'2014-10-15 16:31:04','2014-10-17 20:31:04',51,'Mambajao',0),
	(1115,'2014-10-15 16:31:04','2014-10-17 20:31:04',51,'Sagay',0),
	(1116,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Lanao Del Norte',0),
	(1117,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Bacolod',0),
	(1118,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Baroy',0),
	(1119,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Iligan City',0),
	(1120,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Kapatagan',0),
	(1121,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Sultan Naga Dimaporo',0),
	(1122,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Kauswagan',0),
	(1123,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Kolambugan',0),
	(1124,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Lala',0),
	(1125,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Linamon',0),
	(1126,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Magsaysay',0),
	(1127,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Maigo',0),
	(1128,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Matungao',0),
	(1129,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Munai',0),
	(1130,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Nunungan',0),
	(1131,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Pantao Ragat',0),
	(1132,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Poona Piagapo',0),
	(1133,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Salvador',0),
	(1134,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Sapad',0),
	(1135,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Tagoloan',0),
	(1136,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Tangcal',0),
	(1137,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Tubod',0),
	(1138,'2014-10-15 16:31:04','2014-10-17 20:31:04',49,'Pantar',0),
	(1139,'2014-10-15 16:31:04','2014-10-17 20:31:04',48,'Aloran',0),
	(1140,'2014-10-15 16:31:04','2014-10-17 20:31:04',48,'Baliangao',0),
	(1141,'2014-10-15 16:31:04','2014-10-17 20:31:04',48,'Bonifacio',0),
	(1142,'2014-10-15 16:31:04','2014-10-17 20:31:04',48,'Calamba',0),
	(1143,'2014-10-15 16:31:04','2014-10-17 20:31:04',48,'Clarin',0),
	(1144,'2014-10-15 16:31:04','2014-10-17 20:31:04',48,'Conception',0),
	(1145,'2014-10-15 16:31:04','2014-10-17 20:31:04',48,'Jimenez',0),
	(1146,'2014-10-15 16:31:04','2014-10-17 20:31:04',48,'Lopez Jaena',0),
	(1147,'2014-10-15 16:31:04','2014-10-17 20:31:04',48,'Oroquieta',0),
	(1148,'2014-10-15 16:31:04','2014-10-17 20:31:04',48,'Ozamis City',0),
	(1149,'2014-10-15 16:31:04','2014-10-17 20:31:04',48,'Aloran',0),
	(1150,'2014-10-15 16:31:04','2014-10-17 20:31:04',65,'Tondo I/II',0),
	(1151,'2014-10-15 16:31:04','2014-10-17 20:31:04',65,'Binondo',0),
	(1152,'2014-10-15 16:31:04','2014-10-17 20:31:04',65,'Quiapo',0),
	(1153,'2014-10-15 16:31:04','2014-10-17 20:31:04',65,'San Nicolas',0),
	(1154,'2014-10-15 16:31:04','2014-10-17 20:31:04',65,'Santa Cruz',0),
	(1155,'2014-10-15 16:31:04','2014-10-17 20:31:04',65,'Sampaloc',0),
	(1156,'2014-10-15 16:31:04','2014-10-17 20:31:04',65,'San Miguel',0),
	(1157,'2014-10-15 16:31:04','2014-10-17 20:31:04',65,'Ermita',0),
	(1158,'2014-10-15 16:31:04','2014-10-17 20:31:04',65,'Intramuros',0),
	(1159,'2014-10-15 16:31:04','2014-10-17 20:31:04',65,'Malate',0),
	(1160,'2014-10-15 16:31:04','2014-10-17 20:31:04',65,'Paco',0),
	(1161,'2014-10-15 16:31:04','2014-10-17 20:31:04',65,'Pandacan',0),
	(1162,'2014-10-15 16:31:04','2014-10-17 20:31:04',65,'Port Area',0),
	(1163,'2014-10-15 16:31:04','2014-10-17 20:31:04',65,'Santa Ana',0),
	(1164,'2014-10-15 16:31:04','2014-10-17 20:31:04',62,'city Of Mandaluyong',0),
	(1165,'2014-10-15 16:31:04','2014-10-17 20:31:04',62,'city Of Marikina',0),
	(1166,'2014-10-15 16:31:04','2014-10-17 20:31:04',62,'city Of Pasig',0),
	(1167,'2014-10-15 16:31:04','2014-10-17 20:31:04',62,'Quezon City',0),
	(1168,'2014-10-15 16:31:04','2014-10-17 20:31:04',62,'city Of San Juan',0),
	(1169,'2014-10-15 16:31:04','2014-10-17 20:31:04',63,'Caloocan City',0),
	(1170,'2014-10-15 16:31:04','2014-10-17 20:31:04',63,'City Of Malabon',0),
	(1171,'2014-10-15 16:31:04','2014-10-17 20:31:04',63,'City Of Navotas',0),
	(1172,'2014-10-15 16:31:04','2014-10-17 20:31:04',63,'City Of Valenzuela',0),
	(1173,'2014-10-15 16:31:04','2014-10-17 20:31:04',64,'city Of Las PiÑas',0),
	(1174,'2014-10-15 16:31:04','2014-10-17 20:31:04',64,'City Of Makati',0),
	(1175,'2014-10-15 16:31:04','2014-10-17 20:31:04',64,'City Of Muntinlupa',0),
	(1176,'2014-10-15 16:31:04','2014-10-17 20:31:04',64,'city Of ParaÑaque',0),
	(1177,'2014-10-15 16:31:04','2014-10-17 20:31:04',64,'Pasay City',0),
	(1178,'2014-10-15 16:31:04','2014-10-17 20:31:04',64,'Pateros',0),
	(1179,'2014-10-15 16:31:04','2014-10-17 20:31:04',64,'Taguig City',0),
	(1180,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Bangued',0),
	(1181,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Bolinay',0),
	(1182,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Bucay',0),
	(1183,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Bucloc',0),
	(1184,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Daguioman',0),
	(1185,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'DanglaS',0),
	(1186,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Dolores',0),
	(1187,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'La Paz',0),
	(1188,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Lacub',0),
	(1189,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Lagangilang',0),
	(1190,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Lagayan',0),
	(1191,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Langiden',0),
	(1192,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Licuan-Baay',0),
	(1193,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Luba',0),
	(1194,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Malibcong',0),
	(1195,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Manabo',0),
	(1196,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Peñarrubia',0),
	(1197,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Pidigan',0),
	(1198,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Pilar',0),
	(1199,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Sallapadan',0),
	(1200,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'San Isidro',0),
	(1201,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'San Juan',0),
	(1202,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'San Quintin',0),
	(1203,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Tayum',0),
	(1204,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Tineg',0),
	(1205,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Tubo',0),
	(1206,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'Villaviciosa',0),
	(1207,'2014-10-15 16:31:04','2014-10-17 20:31:04',68,'Atok',0),
	(1208,'2014-10-15 16:31:04','2014-10-17 20:31:04',68,'Baguio City',0),
	(1209,'2014-10-15 16:31:04','2014-10-17 20:31:04',68,'Bakun',0),
	(1210,'2014-10-15 16:31:04','2014-10-17 20:31:04',68,'Bokod',0),
	(1211,'2014-10-15 16:31:04','2014-10-17 20:31:04',68,'Buguias',0),
	(1212,'2014-10-15 16:31:04','2014-10-17 20:31:04',68,'Itogon',0),
	(1213,'2014-10-15 16:31:04','2014-10-17 20:31:04',68,'Kabayan',0),
	(1214,'2014-10-15 16:31:04','2014-10-17 20:31:04',68,'Kapangan',0),
	(1215,'2014-10-15 16:31:04','2014-10-17 20:31:04',68,'Kibungan',0),
	(1216,'2014-10-15 16:31:04','2014-10-17 20:31:04',68,'La Trinidad',0),
	(1217,'2014-10-15 16:31:04','2014-10-17 20:31:04',68,'Mankayan',0),
	(1218,'2014-10-15 16:31:04','2014-10-17 20:31:04',68,'Sablan',0),
	(1219,'2014-10-15 16:31:04','2014-10-17 20:31:04',68,'Tuba',0),
	(1220,'2014-10-15 16:31:04','2014-10-17 20:31:04',68,'Tublay',0),
	(1221,'2014-10-15 16:31:04','2014-10-17 20:31:04',67,'Banaue',0),
	(1222,'2014-10-15 16:31:04','2014-10-17 20:31:04',67,'Hungduan',0),
	(1223,'2014-10-15 16:31:04','2014-10-17 20:31:04',67,'Kiangan',0),
	(1224,'2014-10-15 16:31:04','2014-10-17 20:31:04',67,'Lagawe',0),
	(1225,'2014-10-15 16:31:04','2014-10-17 20:31:04',67,'Lamut',0),
	(1226,'2014-10-15 16:31:04','2014-10-17 20:31:04',67,'Mayoyao',0),
	(1227,'2014-10-15 16:31:04','2014-10-17 20:31:04',67,'Alfonso Lista',0),
	(1228,'2014-10-15 16:31:04','2014-10-17 20:31:04',67,'Aguinaldo',0),
	(1229,'2014-10-15 16:31:04','2014-10-17 20:31:04',67,'Hingyon',0),
	(1230,'2014-10-15 16:31:04','2014-10-17 20:31:04',67,'Tinoc',0),
	(1231,'2014-10-15 16:31:04','2014-10-17 20:31:04',67,'Asipulo',0),
	(1232,'2014-10-15 16:31:04','2014-10-17 20:31:04',66,'Balbalan',0),
	(1233,'2014-10-15 16:31:04','2014-10-17 20:31:04',66,'Lubuagan',0),
	(1234,'2014-10-15 16:31:04','2014-10-17 20:31:04',66,'Pasil',0),
	(1235,'2014-10-15 16:31:04','2014-10-17 20:31:04',66,'Pinukpuk',0),
	(1236,'2014-10-15 16:31:04','2014-10-17 20:31:04',66,'Rizal',0),
	(1237,'2014-10-15 16:31:04','2014-10-17 20:31:04',66,'City Of Tabuk',0),
	(1238,'2014-10-15 16:31:04','2014-10-17 20:31:04',66,'Tanudan',0),
	(1239,'2014-10-15 16:31:04','2014-10-17 20:31:04',66,'Tinglayan',0),
	(1240,'2014-10-15 16:31:04','2014-10-17 20:31:04',71,'Barlig',0),
	(1241,'2014-10-15 16:31:04','2014-10-17 20:31:04',71,'Bauko',0),
	(1242,'2014-10-15 16:31:04','2014-10-17 20:31:04',71,'Besao',0),
	(1243,'2014-10-15 16:31:04','2014-10-17 20:31:04',71,'Bontoc',0),
	(1244,'2014-10-15 16:31:04','2014-10-17 20:31:04',71,'Natonin',0),
	(1245,'2014-10-15 16:31:04','2014-10-17 20:31:04',71,'Paracelis',0),
	(1246,'2014-10-15 16:31:04','2014-10-17 20:31:04',71,'Sabangan',0),
	(1247,'2014-10-15 16:31:04','2014-10-17 20:31:04',71,'Sadanga',0),
	(1248,'2014-10-15 16:31:04','2014-10-17 20:31:04',71,'Sagada',0),
	(1249,'2014-10-15 16:31:04','2014-10-17 20:31:04',71,'Tadian',0),
	(1250,'2014-10-15 16:31:04','2014-10-17 20:31:04',69,'Calanasan',0),
	(1251,'2014-10-15 16:31:04','2014-10-17 20:31:04',69,'Conner',0),
	(1252,'2014-10-15 16:31:04','2014-10-17 20:31:04',69,'Flora',0),
	(1253,'2014-10-15 16:31:04','2014-10-17 20:31:04',69,'Kabugao',0),
	(1254,'2014-10-15 16:31:04','2014-10-17 20:31:04',69,'Luna',0),
	(1255,'2014-10-15 16:31:04','2014-10-17 20:31:04',69,'Pudtol',0),
	(1256,'2014-10-15 16:31:04','2014-10-17 20:31:04',69,'Santa Marcela',0),
	(1257,'2014-10-15 16:31:04','2014-10-17 20:31:04',81,'BUENAVISTA',0),
	(1258,'2014-10-15 16:31:04','2014-10-17 20:31:04',81,'BUTUAN CITY (Capital)',0),
	(1259,'2014-10-15 16:31:04','2014-10-17 20:31:04',81,'CITY OF CABADBARAN',0),
	(1260,'2014-10-15 16:31:04','2014-10-17 20:31:04',81,'CARMEN',0),
	(1261,'2014-10-15 16:31:04','2014-10-17 20:31:04',81,'JABONGA',0),
	(1262,'2014-10-15 16:31:04','2014-10-17 20:31:04',81,'KITCHARAO',0),
	(1263,'2014-10-15 16:31:04','2014-10-17 20:31:04',81,'LAS NIEVES',0),
	(1264,'2014-10-15 16:31:04','2014-10-17 20:31:04',81,'MAGALLANES',0),
	(1265,'2014-10-15 16:31:04','2014-10-17 20:31:04',81,'NASIPIT',0),
	(1266,'2014-10-15 16:31:04','2014-10-17 20:31:04',81,'SANTIAGO',0),
	(1267,'2014-10-15 16:31:04','2014-10-17 20:31:04',81,'TUBAY',0),
	(1268,'2014-10-15 16:31:04','2014-10-17 20:31:04',81,'REMEDIOS T. ROMUALDEZ',0),
	(1269,'2014-10-15 16:31:04','2014-10-17 20:31:04',80,'CITY OF BAYUGAN',0),
	(1270,'2014-10-15 16:31:04','2014-10-17 20:31:04',80,'BUNAWAN',0),
	(1271,'2014-10-15 16:31:04','2014-10-17 20:31:04',80,'ESPERANZA',0),
	(1272,'2014-10-15 16:31:04','2014-10-17 20:31:04',80,'LA PAZ',0),
	(1273,'2014-10-15 16:31:04','2014-10-17 20:31:04',80,'LORETO',0),
	(1274,'2014-10-15 16:31:04','2014-10-17 20:31:04',80,'PROSPERIDAD (Capital)',0),
	(1275,'2014-10-15 16:31:04','2014-10-17 20:31:04',80,'ROSARIO',0),
	(1276,'2014-10-15 16:31:04','2014-10-17 20:31:04',80,'SAN FRANCISCO',0),
	(1277,'2014-10-15 16:31:04','2014-10-17 20:31:04',80,'SAN LUIS',0),
	(1278,'2014-10-15 16:31:04','2014-10-17 20:31:04',80,'SANTA JOSEFA',0),
	(1279,'2014-10-15 16:31:04','2014-10-17 20:31:04',80,'TALACOGON',0),
	(1280,'2014-10-15 16:31:04','2014-10-17 20:31:04',80,'TRENTO',0),
	(1281,'2014-10-15 16:31:04','2014-10-17 20:31:04',80,'VERUELA',0),
	(1282,'2014-10-15 16:31:04','2014-10-17 20:31:04',80,'SIBAGAT',0),
	(1283,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'ALEGRIA',0),
	(1284,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'BACUAG',0),
	(1285,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'BURGOS',0),
	(1286,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'CLAVER',0),
	(1287,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'DAPA',0),
	(1288,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'DEL CARMEN',0),
	(1289,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'GENERAL LUNA',0),
	(1290,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'GIGAQUIT',0),
	(1291,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'MAINIT',0),
	(1292,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'MALIMONO',0),
	(1293,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'PILAR',0),
	(1294,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'PLACER',0),
	(1295,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'SAN BENITO',0),
	(1296,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'SAN FRANCISCO (ANAO-AON)',0),
	(1297,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'SAN ISIDRO',0),
	(1298,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'SANTA MONICA (SAPAO)',0),
	(1299,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'SISON',0),
	(1300,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'SOCORRO',0),
	(1301,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'SURIGAO CITY (Capital)',0),
	(1302,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'TAGANA-AN',0),
	(1303,'2014-10-15 16:31:04','2014-10-17 20:31:04',78,'TUBOD',0),
	(1304,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'BAROBO',0),
	(1305,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'BAYABAS',0),
	(1306,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'CITY OF BISLIG',0),
	(1307,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'CAGWAIT',0),
	(1308,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'CANTILAN',0),
	(1309,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'CARMEN',0),
	(1310,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'CARRASCAL',0),
	(1311,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'CORTES',0),
	(1312,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'HINATUAN',0),
	(1313,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'LANUZA',0),
	(1314,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'LIANGA',0),
	(1315,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'LINGIG',0),
	(1316,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'MADRID',0),
	(1317,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'MARIHATAG',0),
	(1318,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'SAN AGUSTIN',0),
	(1319,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'SAN MIGUEL',0),
	(1320,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'TAGBINA',0),
	(1321,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'TAGO',0),
	(1322,'2014-10-15 16:31:04','2014-10-17 20:31:04',77,'CITY OF TANDAG (Capital)',0),
	(1323,'2014-10-15 16:31:04','2014-10-17 20:31:04',79,'BASILISA (RIZAL)',0),
	(1324,'2014-10-15 16:31:04','2014-10-17 20:31:04',79,'CAGDIANAO',0),
	(1325,'2014-10-15 16:31:04','2014-10-17 20:31:04',79,'DINAGAT',0),
	(1326,'2014-10-15 16:31:04','2014-10-17 20:31:04',79,'LIBJO (ALBOR)',0),
	(1327,'2014-10-15 16:31:04','2014-10-17 20:31:04',79,'LORETO',0),
	(1328,'2014-10-15 16:31:04','2014-10-17 20:31:04',79,'SAN JOSE (Capital)',0),
	(1329,'2014-10-15 16:31:04','2014-10-17 20:31:04',79,'TUBAJON',0),
	(1330,'2014-10-15 16:31:04','2014-10-17 20:31:04',83,'Boac',0),
	(1331,'2014-10-15 16:31:04','2014-10-17 20:31:04',83,'Buenavista',0),
	(1332,'2014-10-15 16:31:04','2014-10-17 20:31:04',83,'Gasan',0),
	(1333,'2014-10-15 16:31:04','2014-10-17 20:31:04',83,'Mogpog',0),
	(1334,'2014-10-15 16:31:04','2014-10-17 20:31:04',83,'Santa Cruz',0),
	(1335,'2014-10-15 16:31:04','2014-10-17 20:31:04',83,'Torrijos',0),
	(1336,'2014-10-15 16:31:04','2014-10-17 20:31:04',84,'Abra De Ilog',0),
	(1337,'2014-10-15 16:31:04','2014-10-17 20:31:04',84,'Calintaan',0),
	(1338,'2014-10-15 16:31:04','2014-10-17 20:31:04',84,'Looc',0),
	(1339,'2014-10-15 16:31:04','2014-10-17 20:31:04',84,'Lubang',0),
	(1340,'2014-10-15 16:31:04','2014-10-17 20:31:04',84,'Magsaysay',0),
	(1341,'2014-10-15 16:31:04','2014-10-17 20:31:04',84,'Mamburao',0),
	(1342,'2014-10-15 16:31:04','2014-10-17 20:31:04',84,'Paluan',0),
	(1343,'2014-10-15 16:31:04','2014-10-17 20:31:04',84,'Rizal',0),
	(1344,'2014-10-15 16:31:04','2014-10-17 20:31:04',84,'Sablayan',0),
	(1345,'2014-10-15 16:31:04','2014-10-17 20:31:04',84,'San Jose',0),
	(1346,'2014-10-15 16:31:04','2014-10-17 20:31:04',84,'Santa Cruz',0),
	(1347,'2014-10-15 16:31:04','2014-10-17 20:31:04',82,'Baco',0),
	(1348,'2014-10-15 16:31:04','2014-10-17 20:31:04',82,'Bansud',0),
	(1349,'2014-10-15 16:31:04','2014-10-17 20:31:04',82,'Bongabong',0),
	(1350,'2014-10-15 16:31:04','2014-10-17 20:31:04',82,'Bulalacao',0),
	(1351,'2014-10-15 16:31:04','2014-10-17 20:31:04',82,'City Of Calapan',0),
	(1352,'2014-10-15 16:31:04','2014-10-17 20:31:04',82,'Gloria',0),
	(1353,'2014-10-15 16:31:04','2014-10-17 20:31:04',82,'Mansalay',0),
	(1354,'2014-10-15 16:31:04','2014-10-17 20:31:04',82,'Naujan',0),
	(1355,'2014-10-15 16:31:04','2014-10-17 20:31:04',82,'Pinamalayan',0),
	(1356,'2014-10-15 16:31:04','2014-10-17 20:31:04',82,'Pola',0),
	(1357,'2014-10-15 16:31:04','2014-10-17 20:31:04',82,'Puerto Galera',0),
	(1358,'2014-10-15 16:31:04','2014-10-17 20:31:04',82,'Roxas',0),
	(1359,'2014-10-15 16:31:04','2014-10-17 20:31:04',82,'San Teodoro',0),
	(1360,'2014-10-15 16:31:04','2014-10-17 20:31:04',82,'Socorro',0),
	(1361,'2014-10-15 16:31:04','2014-10-17 20:31:04',82,'Victoria',0),
	(1362,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Aborlan',0),
	(1363,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Agutaya',0),
	(1364,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Araceli',0),
	(1365,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Balabac',0),
	(1366,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Bataraza',0),
	(1367,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Brooke`s Point',0),
	(1368,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Busuanga',0),
	(1369,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Cagayancillo',0),
	(1370,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Coron',0),
	(1371,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Cuyo',0),
	(1372,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Dumaran',0),
	(1373,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'El Nido',0),
	(1374,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Linapacan',0),
	(1375,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Magsaysay',0),
	(1376,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Narra',0),
	(1377,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Puerto Princesa City',0),
	(1378,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Quezon',0),
	(1379,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Roxas',0),
	(1380,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'San Vicente',0),
	(1381,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Taytay',0),
	(1382,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Kalayaan',0),
	(1383,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Culion',0),
	(1384,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Rizal',0),
	(1385,'2014-10-15 16:31:04','2014-10-17 20:31:04',85,'Sofronio',0),
	(1386,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'Alcantara',0),
	(1387,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'Banton',0),
	(1388,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'Cajidiocan',0),
	(1389,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'Calatrava',0),
	(1390,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'Conception',0),
	(1391,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'Corcuera',0),
	(1392,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'Looc',0),
	(1393,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'Magdiwang',0),
	(1394,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'Odiongan',0),
	(1395,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'Romblon',0),
	(1396,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'San Agustin',0),
	(1397,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'San Andres',0),
	(1398,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'San Fernando',0),
	(1399,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'San Jose',0),
	(1400,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'Santa Fe',0),
	(1401,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'Ferrol',0),
	(1402,'2014-10-15 16:31:04','2014-10-17 20:31:04',86,'Santa Maria',0),
	(1403,'2014-10-15 16:31:04','2014-10-17 20:31:04',72,'AKBAR',0),
	(1404,'2014-10-15 16:31:04','2014-10-17 20:31:04',72,'AL-BARKA',0),
	(1405,'2014-10-15 16:31:04','2014-10-17 20:31:04',60,'ALABEL (Capital)',0),
	(1406,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'ALAMADA',0),
	(1407,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'ALEOSAN',0),
	(1408,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'AMPATUAN',0),
	(1409,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'ANTIPAS',0),
	(1410,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'ARAKAN',0),
	(1411,'2014-10-15 16:31:04','2014-10-17 20:31:04',54,'ASUNCION (SAUG)',0),
	(1412,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'BACOLOD-KALAWI (BACOLOD GRANDE)',0),
	(1413,'2014-10-15 16:31:04','2014-10-17 20:31:04',53,'BAGANGA',0),
	(1414,'2014-10-15 16:31:04','2014-10-17 20:31:04',58,'BAGUMBAYAN',0),
	(1415,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'BALABAGAN',0),
	(1416,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'BALINDONG (WATU)',0),
	(1417,'2014-10-15 16:31:04','2014-10-17 20:31:04',53,'BANAYBANAY',0),
	(1418,'2014-10-15 16:31:04','2014-10-17 20:31:04',61,'BANGA',0),
	(1419,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'BANISILAN',0),
	(1420,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'BANSALAN',0),
	(1421,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'BARIRA',0),
	(1422,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'BAYANG',0),
	(1423,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'BINIDAYAN',0),
	(1424,'2014-10-15 16:31:04','2014-10-17 20:31:04',76,'BONGAO (Capital)',0),
	(1425,'2014-10-15 16:31:04','2014-10-17 20:31:04',53,'BOSTON',0),
	(1426,'2014-10-15 16:31:04','2014-10-17 20:31:04',54,'BRAULIO E. DUJALI',0),
	(1427,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'BUADIPOSO-BUNTONG',0),
	(1428,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'BUBONG',0),
	(1429,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'BULDON',0),
	(1430,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'BULUAN',0),
	(1431,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'BUMBARAN',0),
	(1432,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'BUTIG',0),
	(1433,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'CALANOGAS',0),
	(1434,'2014-10-15 16:31:04','2014-10-17 20:31:04',53,'CARAGA',0),
	(1435,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'CARMEN',0),
	(1436,'2014-10-15 16:31:04','2014-10-17 20:31:04',54,'CARMEN',0),
	(1437,'2014-10-15 16:31:04','2014-10-17 20:31:04',53,'CATEEL',0),
	(1438,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'CITY OF DIGOS (Capital)',0),
	(1439,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'CITY OF KIDAPAWAN (Capital)',0),
	(1440,'2014-10-15 16:31:04','2014-10-17 20:31:04',61,'CITY OF KORONADAL (Capital)',0),
	(1441,'2014-10-15 16:31:04','2014-10-17 20:31:04',72,'CITY OF LAMITAN',0),
	(1442,'2014-10-15 16:31:04','2014-10-17 20:31:04',53,'CITY OF MATI (Capital)',0),
	(1443,'2014-10-15 16:31:04','2014-10-17 20:31:04',54,'CITY OF PANABO',0),
	(1444,'2014-10-15 16:31:04','2014-10-17 20:31:04',58,'CITY OF TACURONG',0),
	(1445,'2014-10-15 16:31:04','2014-10-17 20:31:04',54,'CITY OF TAGUM (Capital)',0),
	(1446,'2014-10-15 16:31:04','2014-10-17 20:31:04',58,'COLUMBIO',0),
	(1447,'2014-10-15 16:31:04','2014-10-17 20:31:04',56,'COMPOSTELA',0),
	(1448,'2014-10-15 16:31:04','2014-10-17 20:31:04',59,'COTABATO CITY',0),
	(1449,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'DATU ABDULLAH SANGKI',0),
	(1450,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'DATU ANGGAL MIDTIMBANG',0),
	(1451,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'DATU BLAH T. SINSUAT',0),
	(1452,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'DATU HOFFER AMPATUAN',0),
	(1453,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'DATU ODIN SINSUAT (DINAIG)',0),
	(1454,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'DATU PAGLAS',0),
	(1455,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'DATU PIANG',0),
	(1456,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'DATU SALIBO',0),
	(1457,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'DATU SAUDI-AMPATUAN',0),
	(1458,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'DATU UNSAY',0),
	(1459,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'DAVAO CITY',0),
	(1460,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'DITSAAN-RAMAIN',0),
	(1461,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'DON MARCELINO',0),
	(1462,'2014-10-15 16:31:04','2014-10-17 20:31:04',58,'ESPERANZA',0),
	(1463,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'GANASSI',0),
	(1464,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'GEN. S. K. PENDATUN',0),
	(1465,'2014-10-15 16:31:04','2014-10-17 20:31:04',61,'GENERAL SANTOS CITY (DADIANGAS)',0),
	(1466,'2014-10-15 16:31:04','2014-10-17 20:31:04',60,'GLAN',0),
	(1467,'2014-10-15 16:31:04','2014-10-17 20:31:04',53,'GOVERNOR GENEROSO',0),
	(1468,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'GUINDULUNGAN',0),
	(1469,'2014-10-15 16:31:04','2014-10-17 20:31:04',72,'HADJI MOHAMMAD AJUL',0),
	(1470,'2014-10-15 16:31:04','2014-10-17 20:31:04',72,'HADJI MUHTAMAD',0),
	(1471,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'HADJI PANGLIMA TAHIL (MARUNGGAS)',0),
	(1472,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'HAGONOY',0),
	(1473,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'INDANAN',0),
	(1474,'2014-10-15 16:31:04','2014-10-17 20:31:04',54,'ISLAND GARDEN CITY OF SAMAL',0),
	(1475,'2014-10-15 16:31:04','2014-10-17 20:31:04',58,'ISULAN (Capital)',0),
	(1476,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'JOLO (Capital)',0),
	(1477,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'JOSE ABAD SANTOS (TRINIDAD)',0),
	(1478,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'KABACAN',0),
	(1479,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'KABUNTALAN (TUMBAO)',0),
	(1480,'2014-10-15 16:31:04','2014-10-17 20:31:04',58,'KALAMANSIG',0),
	(1481,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'KALINGALAN CALUANG',0),
	(1482,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'KAPAI',0),
	(1483,'2014-10-15 16:31:04','2014-10-17 20:31:04',54,'KAPALONG',0),
	(1484,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'KAPATAGAN',0),
	(1485,'2014-10-15 16:31:04','2014-10-17 20:31:04',60,'KIAMBA',0),
	(1486,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'KIBLAWAN',0),
	(1487,'2014-10-15 16:31:04','2014-10-17 20:31:04',56,'LAAK (SAN VICENTE)',0),
	(1488,'2014-10-15 16:31:04','2014-10-17 20:31:04',61,'LAKE SEBU',0),
	(1489,'2014-10-15 16:31:04','2014-10-17 20:31:04',58,'LAMBAYONG (MARIANO MARCOS)',0),
	(1490,'2014-10-15 16:31:04','2014-10-17 20:31:04',76,'LANGUYAN',0),
	(1491,'2014-10-15 16:31:04','2014-10-17 20:31:04',72,'LANTAWAN',0),
	(1492,'2014-10-15 16:31:04','2014-10-17 20:31:04',58,'LEBAK',0),
	(1493,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'LIBUNGAN',0),
	(1494,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'LUGUS',0),
	(1495,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'LUMBA-BAYABAO (MAGUING)',0),
	(1496,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'LUMBACA-UNAYAN',0),
	(1497,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'LUMBATAN',0),
	(1498,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'LUMBAYANAGUE',0),
	(1499,'2014-10-15 16:31:04','2014-10-17 20:31:04',53,'LUPON',0),
	(1500,'2014-10-15 16:31:04','2014-10-17 20:31:04',58,'LUTAYAN',0),
	(1501,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'LUUK',0),
	(1502,'2014-10-15 16:31:04','2014-10-17 20:31:04',60,'MAASIM',0),
	(1503,'2014-10-15 16:31:04','2014-10-17 20:31:04',56,'MABINI (DOÑA ALICIA)',0),
	(1504,'2014-10-15 16:31:04','2014-10-17 20:31:04',56,'MACO',0),
	(1505,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'MADALUM',0),
	(1506,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'MADAMBA',0),
	(1507,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'MAGPET',0),
	(1508,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'MAGSAYSAY',0),
	(1509,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'MAGUING',0),
	(1510,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'MAIMBUNG',0),
	(1511,'2014-10-15 16:31:04','2014-10-17 20:31:04',60,'MAITUM',0),
	(1512,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'MAKILALA',0),
	(1513,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'MALABANG',0),
	(1514,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'MALALAG',0),
	(1515,'2014-10-15 16:31:04','2014-10-17 20:31:04',60,'MALAPATAN',0),
	(1516,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'MALITA',0),
	(1517,'2014-10-15 16:31:04','2014-10-17 20:31:04',60,'MALUNGON',0),
	(1518,'2014-10-15 16:31:04','2014-10-17 20:31:04',72,'MALUSO',0),
	(1519,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'MAMASAPANO',0),
	(1520,'2014-10-15 16:31:04','2014-10-17 20:31:04',53,'MANAY',0),
	(1521,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'MANGUDADATU',0),
	(1522,'2014-10-15 16:31:04','2014-10-17 20:31:04',76,'MAPUN (CAGAYAN DE TAWI-TAWI)',0),
	(1523,'2014-10-15 16:31:04','2014-10-17 20:31:04',56,'MARAGUSAN (SAN MARIANO)',0),
	(1524,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'MARANTAO',0),
	(1525,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'MARAWI CITY (Capital)',0),
	(1526,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'MAROGONG',0),
	(1527,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'MASIU',0),
	(1528,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'MATALAM',0),
	(1529,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'MATANAO',0),
	(1530,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'MATANOG',0),
	(1531,'2014-10-15 16:31:04','2014-10-17 20:31:04',56,'MAWAB',0),
	(1532,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'MIDSAYAP',0),
	(1533,'2014-10-15 16:31:04','2014-10-17 20:31:04',56,'MONKAYO',0),
	(1534,'2014-10-15 16:31:04','2014-10-17 20:31:04',56,'MONTEVISTA',0),
	(1535,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'MULONDO',0),
	(1536,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'M`LANG',0),
	(1537,'2014-10-15 16:31:04','2014-10-17 20:31:04',56,'NABUNTURAN (Capital)',0),
	(1538,'2014-10-15 16:31:04','2014-10-17 20:31:04',56,'NEW BATAAN',0),
	(1539,'2014-10-15 16:31:04','2014-10-17 20:31:04',54,'NEW CORELLA',0),
	(1540,'2014-10-15 16:31:04','2014-10-17 20:31:04',61,'NORALA',0),
	(1541,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'NORTHERN KABUNTALAN',0),
	(1542,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'OLD PANAMAO',0),
	(1543,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'OMAR',0),
	(1544,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'PADADA',0),
	(1545,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'PAGAGAWAN',0),
	(1546,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'PAGALUNGAN',0),
	(1547,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'PAGAYAWAN (TATARIKAN)',0),
	(1548,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'PAGLAT',0),
	(1549,'2014-10-15 16:31:04','2014-10-17 20:31:04',58,'PALIMBANG',0),
	(1550,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'PANDAG',0),
	(1551,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'PANDAMI',0),
	(1552,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'PANGLIMA ESTINO (NEW PANAMAO)',0),
	(1553,'2014-10-15 16:31:04','2014-10-17 20:31:04',76,'PANGLIMA SUGALA (BALIMBING)',0),
	(1554,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'PANGUTARAN',0),
	(1555,'2014-10-15 16:31:04','2014-10-17 20:31:04',56,'PANTUKAN',0),
	(1556,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'PARANG',0),
	(1557,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'PARANG',0),
	(1558,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'PATA',0),
	(1559,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'PATIKUL',0),
	(1560,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'PIAGAPO',0),
	(1561,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'PICONG (SULTAN GUMANDER)',0),
	(1562,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'PIGKAWAYAN',0),
	(1563,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'PIKIT',0),
	(1564,'2014-10-15 16:31:04','2014-10-17 20:31:04',61,'POLOMOLOK',0),
	(1565,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'POONA BAYABAO (GATA)',0),
	(1566,'2014-10-15 16:31:04','2014-10-17 20:31:04',58,'PRESIDENT QUIRINO',0),
	(1567,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'PRESIDENT ROXAS',0),
	(1568,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'PUALAS',0),
	(1569,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'RAJAH BUAYAN',0),
	(1570,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'SAGUIARAN',0),
	(1571,'2014-10-15 16:31:04','2014-10-17 20:31:04',54,'SAN ISIDRO',0),
	(1572,'2014-10-15 16:31:04','2014-10-17 20:31:04',53,'SAN ISIDRO',0),
	(1573,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'SANTA CRUZ',0),
	(1574,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'SANTA MARIA',0),
	(1575,'2014-10-15 16:31:04','2014-10-17 20:31:04',61,'SANTO NIÑO',0),
	(1576,'2014-10-15 16:31:04','2014-10-17 20:31:04',54,'SANTO TOMAS',0),
	(1577,'2014-10-15 16:31:04','2014-10-17 20:31:04',76,'SAPA-SAPA',0),
	(1578,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'SARANGANI',0),
	(1579,'2014-10-15 16:31:04','2014-10-17 20:31:04',58,'SEN. NINOY AQUINO',0),
	(1580,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'SHARIFF AGUAK (MAGANOY) (Capital)',0),
	(1581,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'SHARIFF SAYDONA MUSTAPHA',0),
	(1582,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'SIASI',0),
	(1583,'2014-10-15 16:31:04','2014-10-17 20:31:04',76,'SIBUTU',0),
	(1584,'2014-10-15 16:31:04','2014-10-17 20:31:04',76,'SIMUNUL',0),
	(1585,'2014-10-15 16:31:04','2014-10-17 20:31:04',76,'SITANGKAI',0),
	(1586,'2014-10-15 16:31:04','2014-10-17 20:31:04',76,'SOUTH UBIAN',0),
	(1587,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'SOUTH UPI',0),
	(1588,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'SULOP',0),
	(1589,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'SULTAN DUMALONDONG',0),
	(1590,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'SULTAN KUDARAT (NULING)',0),
	(1591,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'SULTAN MASTURA',0),
	(1592,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'SULTAN SA BARONGIS (LAMBAYONG)',0),
	(1593,'2014-10-15 16:31:04','2014-10-17 20:31:04',72,'SUMISIP',0),
	(1594,'2014-10-15 16:31:04','2014-10-17 20:31:04',61,'SURALLAH',0),
	(1595,'2014-10-15 16:31:04','2014-10-17 20:31:04',72,'TABUAN-LASA',0),
	(1596,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'TAGOLOAN II',0),
	(1597,'2014-10-15 16:31:04','2014-10-17 20:31:04',54,'TALAINGOD',0),
	(1598,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'TALAYAN',0),
	(1599,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'TALIPAO',0),
	(1600,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'TALITAY',0),
	(1601,'2014-10-15 16:31:04','2014-10-17 20:31:04',61,'TAMPAKAN',0),
	(1602,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'TAMPARAN',0),
	(1603,'2014-10-15 16:31:04','2014-10-17 20:31:04',76,'TANDUBAS',0),
	(1604,'2014-10-15 16:31:04','2014-10-17 20:31:04',61,'TANTANGAN',0),
	(1605,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'TAPUL',0),
	(1606,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'TARAKA',0),
	(1607,'2014-10-15 16:31:04','2014-10-17 20:31:04',53,'TARRAGONA',0),
	(1608,'2014-10-15 16:31:04','2014-10-17 20:31:04',72,'TIPO-TIPO',0),
	(1609,'2014-10-15 16:31:04','2014-10-17 20:31:04',75,'TONGKIL',0),
	(1610,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'TUBARAN',0),
	(1611,'2014-10-15 16:31:04','2014-10-17 20:31:04',72,'TUBURAN',0),
	(1612,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'TUGAYA',0),
	(1613,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'TULUNAN',0),
	(1614,'2014-10-15 16:31:04','2014-10-17 20:31:04',61,'TUPI',0),
	(1615,'2014-10-15 16:31:04','2014-10-17 20:31:04',76,'TURTLE ISLANDS',0),
	(1616,'2014-10-15 16:31:04','2014-10-17 20:31:04',61,'T`BOLI',0),
	(1617,'2014-10-15 16:31:04','2014-10-17 20:31:04',72,'UNGKAYA PUKAN',0),
	(1618,'2014-10-15 16:31:04','2014-10-17 20:31:04',74,'UPI',0),
	(1619,'2014-10-15 16:31:04','2014-10-17 20:31:04',73,'WAO',0),
	(1620,'2014-10-15 16:31:04','2014-10-17 20:31:04',52,'Alubijid',0),
	(1621,'2014-10-15 16:31:04','2014-10-17 20:31:04',61,'general santos',0),
	(1622,'2014-10-15 16:31:04','2014-10-17 20:31:04',61,'general santos city',0),
	(1623,'2014-10-15 16:31:04','2014-10-17 20:31:04',71,'chakchakan',0),
	(1624,'2014-10-15 16:31:04','2014-10-17 20:31:04',71,'bontoc',0),
	(1625,'2014-10-15 16:31:04','2014-10-17 20:31:04',61,'koronadal city',0),
	(1626,'2014-10-15 16:31:04','2014-10-17 20:31:04',12,'cabanatuan city',0),
	(1627,'2014-10-15 16:31:04','2014-10-17 20:31:04',5,'lower balulang',0),
	(1628,'2014-10-15 16:31:04','2014-10-17 20:31:04',52,'cagayan de oro',0),
	(1629,'2014-10-15 16:31:04','2014-10-17 20:31:04',61,'tboli',0),
	(1630,'2014-10-15 16:31:04','2014-10-17 20:31:04',70,'dolores',0),
	(1631,'2014-10-15 16:31:04','2014-10-17 20:31:04',11,'City of Meycauayan',0),
	(1632,'2014-10-15 16:31:04','2014-10-17 20:31:04',55,'Davao City',0),
	(1633,'2014-10-15 16:31:04','2014-10-17 20:31:04',56,'Compostela',0),
	(1634,'2014-10-15 16:31:04','2014-10-17 20:31:04',57,'kabacan',0),
	(1635,'2014-10-15 16:31:04','2014-10-17 20:31:04',54,'city of tagum',0),
	(1636,'2014-10-15 16:31:04','2014-10-17 20:31:04',7,'Alfonso castaneda',0),
	(1637,'2014-10-15 16:31:04','2014-10-17 20:31:04',0,'Pigcawayan',0),
	(1638,'2014-10-15 16:31:04','2014-10-17 20:31:04',59,'Pigcawayan',0),
	(1639,'2014-10-15 16:31:04','2014-10-17 20:31:04',48,'panalsalan',0);

/*!40000 ALTER TABLE `municipalities` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table occupations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `occupations`;

CREATE TABLE `occupations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table payment_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payment_types`;

CREATE TABLE `payment_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `payment_types` WRITE;
/*!40000 ALTER TABLE `payment_types` DISABLE KEYS */;

INSERT INTO `payment_types` (`id`, `created_at`, `updated_at`, `name`, `is_sync`, `is_deleted`)
VALUES
	(1,'2018-09-10 11:34:24','2018-09-11 00:34:24','Cash',0,0),
	(2,'2018-09-10 11:34:24','2018-09-11 00:34:24','Card',0,0),
	(3,'2018-09-10 11:34:24','2018-09-11 00:34:24','Points',0,0);

/*!40000 ALTER TABLE `payment_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pos_payment_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pos_payment_details`;

CREATE TABLE `pos_payment_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `header_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd pos_payment_headers.id',
  `transaction_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd pos_transactions.id',
  `inventory_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd inventories.id',
  `qty` int(11) DEFAULT '0',
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `amount_paid` decimal(12,2) NOT NULL DEFAULT '0.00',
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pos_payment_details` WRITE;
/*!40000 ALTER TABLE `pos_payment_details` DISABLE KEYS */;

INSERT INTO `pos_payment_details` (`id`, `created_at`, `updated_at`, `header_id`, `transaction_id`, `inventory_id`, `qty`, `price`, `amount_paid`, `is_sync`, `is_deleted`)
VALUES
	(1,'2018-11-30 22:30:43','2018-12-01 12:30:43',1,1,1,2,15.00,30.00,0,0),
	(2,'2018-11-30 22:30:43','2018-12-01 12:30:43',1,2,2,2,15.00,30.00,0,0),
	(3,'2018-11-30 22:30:43','2018-12-01 12:30:43',1,3,3,2,65.00,130.00,0,0),
	(4,'2018-11-30 22:30:43','2018-12-01 12:30:43',1,4,4,2,70.00,140.00,0,0),
	(5,'2018-11-30 22:34:17','2018-12-01 12:34:17',2,5,3,2,65.00,130.00,0,0),
	(6,'2018-11-30 22:34:17','2018-12-01 12:34:17',2,6,4,2,70.00,140.00,0,0),
	(7,'2018-11-30 22:34:17','2018-12-01 12:34:17',2,7,1,2,15.00,30.00,0,0),
	(8,'2018-11-30 22:34:17','2018-12-01 12:34:17',2,8,5,2,30.00,60.00,0,0),
	(9,'2018-12-02 00:27:23','2018-12-02 00:27:23',3,9,8,2,15.00,30.00,0,0),
	(10,'2018-12-02 00:27:23','2018-12-02 00:27:23',3,10,10,2,65.00,130.00,0,0),
	(11,'2018-12-02 00:27:23','2018-12-02 00:27:23',3,11,11,2,70.00,140.00,0,0),
	(12,'2018-12-02 00:27:23','2018-12-02 00:27:23',3,12,12,2,30.00,60.00,0,0),
	(13,'2018-12-02 00:27:23','2018-12-02 00:27:23',3,13,14,2,100.00,200.00,0,0),
	(14,'2018-12-02 00:27:37','2018-12-02 00:27:37',4,13,14,2,100.00,160.00,0,0);

/*!40000 ALTER TABLE `pos_payment_details` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pos_payment_headers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pos_payment_headers`;

CREATE TABLE `pos_payment_headers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pos_payment_headers` WRITE;
/*!40000 ALTER TABLE `pos_payment_headers` DISABLE KEYS */;

INSERT INTO `pos_payment_headers` (`id`, `created_at`, `updated_at`, `date`, `payment_type_id`, `ref_no`, `or_no`, `branch_id`, `client_id`, `employee_id`, `customer_id`, `quantity`, `payable`, `amount_cash`, `amount_card`, `amount_points`, `points`, `discount`, `tax`, `amount_net`, `is_email_sent`, `is_sync`, `is_deleted`)
VALUES
	(1,'2018-11-30 22:30:43','2018-12-01 12:30:43','2018-11-30',1,'0000001','0001',1,1,1,1,8,330.00,500.00,0.00,0.00,0,0.00,0.00,500.00,0,0,0),
	(2,'2018-11-30 22:34:17','2018-12-01 12:34:17','2018-11-30',1,'0000002','0002',1,1,1,2,8,360.00,1000.00,0.00,0.00,0,10.00,0.00,1010.00,0,0,0),
	(3,'2018-12-02 00:27:23','2018-12-02 00:27:23','2018-12-02',1,'0000003','0003',2,1,3,4,10,560.00,400.00,0.00,0.00,0,0.00,0.00,400.00,0,0,0),
	(4,'2018-12-02 00:27:37','2018-12-02 00:27:37','2018-12-02',1,'0000004','0004',2,1,3,4,2,160.00,160.00,0.00,0.00,0,0.00,0.00,160.00,0,0,0);

/*!40000 ALTER TABLE `pos_payment_headers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pos_transactions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pos_transactions`;

CREATE TABLE `pos_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_saved` tinyint(1) DEFAULT '0' COMMENT 'transactions on pos cannot be modified once saved',
  `numberOfTransactions` int(11) NOT NULL DEFAULT '0',
  `inventory_type_id` int(11) DEFAULT NULL,
  `service_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pos_transactions` WRITE;
/*!40000 ALTER TABLE `pos_transactions` DISABLE KEYS */;

INSERT INTO `pos_transactions` (`id`, `created_at`, `updated_at`, `trans_date`, `ref_no`, `cust_id`, `branch_id`, `client_id`, `inv_id`, `transaction_id`, `transaction_name`, `qty`, `price`, `amount_net`, `balance`, `user_id`, `is_fully_paid`, `is_inventory`, `remarks`, `is_deleted`, `deleted_by`, `is_saved`, `numberOfTransactions`, `inventory_type_id`, `service_type_id`)
VALUES
	(1,'2018-11-30 22:30:02','2018-12-01 12:30:02','2018-10-30','0001',1,1,1,1,1,'Ariel Blue',2,15.00,30.00,0.00,4,1,1,'',0,NULL,1,0,1,NULL),
	(2,'2018-11-30 22:30:09','2018-12-01 12:30:09','2018-11-30','0002',1,1,1,2,1,'Ariel Green',2,15.00,30.00,0.00,4,1,1,'',0,NULL,1,0,1,NULL),
	(3,'2018-11-30 22:30:16','2018-12-01 12:30:16','2018-11-30','0003',1,1,1,3,1,'Regular Wash',2,65.00,130.00,0.00,4,1,1,'',0,NULL,1,0,2,1),
	(4,'2018-11-30 22:30:21','2018-12-01 12:30:21','2018-11-30','0004',1,1,1,4,1,'Standard Dry',2,70.00,140.00,0.00,4,1,1,'',0,NULL,1,0,2,2),
	(5,'2018-11-30 22:33:33','2018-12-01 12:33:33','2018-11-30','0005',2,1,1,3,1,'Regular Wash',2,65.00,130.00,0.00,4,1,1,'',0,NULL,1,0,2,1),
	(6,'2018-11-30 22:33:39','2018-12-01 12:33:39','2018-11-30','0006',2,1,1,4,1,'Standard Dry',2,70.00,140.00,0.00,4,1,1,'',0,NULL,1,0,2,2),
	(7,'2018-11-30 22:33:46','2018-12-01 12:33:46','2018-11-30','0007',2,1,1,1,1,'Ariel Blue',2,15.00,30.00,0.00,4,1,1,'',0,NULL,1,0,1,NULL),
	(8,'2018-11-30 22:33:51','2018-12-01 12:33:51','2018-11-30','0008',2,1,1,5,1,'Folding',2,30.00,60.00,0.00,4,1,1,'',0,NULL,1,0,2,4),
	(9,'2018-11-30 22:35:49','2018-12-01 12:35:49','2018-11-30','0009',4,2,1,8,1,'Ariel Blue WT',2,15.00,30.00,0.00,7,1,1,'',0,NULL,1,0,1,NULL),
	(10,'2018-11-30 22:35:57','2018-12-01 12:35:57','2018-11-30','0010',4,2,1,10,1,'Regular Wash',2,65.00,130.00,0.00,7,1,1,'',0,NULL,1,0,2,1),
	(11,'2018-11-30 22:36:02','2018-12-01 12:36:02','2018-11-30','0011',4,2,1,11,1,'Standard Dry',2,70.00,140.00,0.00,7,1,1,'',0,NULL,1,0,2,2),
	(12,'2018-11-30 22:36:10','2018-12-01 12:36:10','2018-11-30','0012',4,2,1,12,1,'Folding WT',2,30.00,60.00,0.00,7,1,1,'',0,NULL,1,0,2,4),
	(13,'2018-11-30 22:36:15','2018-12-01 12:36:15','2018-11-30','0013',4,2,1,14,1,'Ironing',2,100.00,200.00,0.00,7,1,1,'',0,NULL,1,0,2,4),
	(14,'2018-12-09 17:32:54','2018-12-09 17:32:54','2018-12-09','0014',2,1,1,1,1,'Ariel Blue',1,15.00,15.00,15.00,4,0,1,'',0,NULL,1,0,1,NULL),
	(15,'2018-12-09 20:03:28','2018-12-09 20:03:28','2018-12-09','0015',3,1,1,1,1,'Ariel Blue',1,15.00,15.00,15.00,4,0,1,'',0,NULL,1,0,1,NULL),
	(16,'2018-12-09 20:03:44','2018-12-09 20:03:44','2018-12-09','0016',3,1,1,4,1,'Standard Dry',1,70.00,70.00,70.00,4,0,1,'',0,NULL,0,0,2,2);

/*!40000 ALTER TABLE `pos_transactions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table purchases
# ------------------------------------------------------------

DROP TABLE IF EXISTS `purchases`;

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `branch_id` int(11) DEFAULT NULL COMMENT 'ref to branches.id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;

INSERT INTO `purchases` (`id`, `created_at`, `updated_at`, `date`, `supplier_id`, `received_by_empid`, `user_id`, `inv_id`, `qty`, `price`, `total`, `expenses_id`, `is_deleted`, `client_id`, `branch_id`)
VALUES
	(1,'2018-11-30 22:12:29','2018-12-01 12:12:29','2018-11-30',7,'1',4,1,100,12.00,1200.00,1,0,1,1),
	(2,'2018-11-30 22:12:56','2018-12-01 12:12:56','2018-11-30',7,'2',4,2,100,12.00,1200.00,2,0,1,1),
	(3,'2018-11-30 22:14:12','2018-12-01 12:14:12','2018-11-30',8,'3',6,8,100,12.00,1200.00,3,0,1,2),
	(4,'2018-11-30 22:14:32','2018-12-01 12:14:32','2018-11-30',8,'4',6,9,100,12.00,1200.00,4,0,1,2),
	(5,'2018-11-30 22:51:02','2018-12-01 12:51:02','2018-11-30',9,'5',9,16,100,12.00,1200.00,15,0,2,3),
	(6,'2018-11-30 22:51:19','2018-12-01 12:51:19','2018-11-30',9,'6',9,17,100,12.00,1200.00,16,0,2,3),
	(7,'2018-12-02 00:04:09','2018-12-02 00:04:09','2018-12-02',7,'1',5,1,100,10.00,1000.00,22,0,1,1),
	(8,'2018-12-02 00:10:27','2018-12-13 11:34:01','2018-12-02',7,'1',5,1,10,1000.00,10000.00,25,0,1,1),
	(9,'2018-12-02 00:20:26','2018-12-02 00:20:26','2018-12-02',7,'1',6,8,100,1000.00,100000.00,26,0,1,2);

/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table raw_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `raw_data`;

CREATE TABLE `raw_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table receipt_settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `receipt_settings`;

CREATE TABLE `receipt_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table role_based_access
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_based_access`;

CREATE TABLE `role_based_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table role_based_views
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_based_views`;

CREATE TABLE `role_based_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT '0',
  `menu_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd menu.id',
  `menu_name` varchar(100) NOT NULL,
  `is_viewable` tinyint(1) NOT NULL DEFAULT '0',
  `module_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd menus.module_id',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) NOT NULL,
  `module_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `created_at`, `updated_at`, `name`, `module_id`, `is_deleted`)
VALUES
	(1,'2017-11-05 20:05:14','2017-11-06 16:05:14','Web Service',1,0),
	(2,'2015-02-21 16:58:21','2015-02-22 18:57:57','Super Admin',2,0),
	(3,'2015-02-21 16:58:26','2015-02-22 18:58:02','Owner',3,0),
	(4,'2018-07-16 11:55:14','2018-07-17 00:55:14','Branch Manager',4,0),
	(5,'2018-07-16 11:55:14','2018-07-17 08:55:14','Staff',5,0);

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table salaries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `salaries`;

CREATE TABLE `salaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table service_prices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `service_prices`;

CREATE TABLE `service_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `client_id` int(11) NOT NULL DEFAULT '0',
  `laundry_shop_id` int(11) NOT NULL DEFAULT '0',
  `branch_id` int(11) NOT NULL DEFAULT '0',
  `transaction_id` int(11) NOT NULL DEFAULT '0',
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `pulse` int(11) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `service_prices` WRITE;
/*!40000 ALTER TABLE `service_prices` DISABLE KEYS */;

INSERT INTO `service_prices` (`id`, `created_at`, `updated_at`, `client_id`, `laundry_shop_id`, `branch_id`, `transaction_id`, `price`, `pulse`, `is_deleted`)
VALUES
	(1,'2017-12-11 03:26:44','2017-12-11 17:26:44',0,0,1,1,70.00,0,0),
	(2,'2017-12-11 03:26:55','2017-12-11 17:26:55',0,0,1,2,10.00,0,0);

/*!40000 ALTER TABLE `service_prices` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table service_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `service_types`;

CREATE TABLE `service_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `service_types` WRITE;
/*!40000 ALTER TABLE `service_types` DISABLE KEYS */;

INSERT INTO `service_types` (`id`, `created_at`, `updated_at`, `name`, `is_sync`, `is_deleted`)
VALUES
	(1,'2018-07-22 21:46:33','2018-07-23 02:46:33','Washer ',0,0),
	(2,'2018-07-22 21:46:49','2018-07-23 02:46:49','Dryer',0,0),
	(3,'2018-07-22 21:46:49','2018-07-23 10:46:49','Titan',0,0),
	(4,'2018-07-22 21:46:49','2018-07-23 10:46:49','Others',0,0);

/*!40000 ALTER TABLE `service_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table services
# ------------------------------------------------------------

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `branch_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to branches.id',
  `name` varchar(50) DEFAULT NULL,
  `service_type_id` int(11) NOT NULL DEFAULT '0' COMMENT 'refd to service_types.id',
  `amount` decimal(12,2) DEFAULT '0.00',
  `file_path` varchar(100) DEFAULT NULL,
  `file_pics` varchar(100) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `var` varchar(50) NOT NULL COMMENT 'variable name',
  `value` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_display` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`id`, `created_at`, `updated_at`, `var`, `value`, `description`, `is_display`)
VALUES
	(1,'2017-10-07 19:19:47','2017-10-08 00:19:47','branch_code','cd3te','unique branch code',1),
	(2,'2017-11-24 20:26:51','2017-11-25 02:26:51','laundry_shop_name','AppWard POS','laundry shop name',1),
	(3,'2017-11-24 20:27:32','2017-11-25 02:27:32','branch_name','The Spin Doctors','branch name',1),
	(4,'2017-11-28 06:50:42','2017-11-28 12:50:42','branch_id','2','branch id',1),
	(5,'2017-12-09 16:04:32','2017-12-09 22:04:32','minutes_per_washdry','10','minutes per wash and dry',1),
	(6,'2017-12-09 16:05:29','2017-12-09 22:05:29','minutes_per_cycle','40','minutes per cycle',1),
	(7,'2017-12-10 01:40:56','2017-12-10 07:40:56','card_initial_load','0','card initial load',1),
	(8,'2017-12-10 12:05:59','2017-12-10 18:05:59','card_no_length','8','card no length',1),
	(9,'2017-12-10 12:14:51','2017-12-10 18:14:51','card_code','APWD','1st 4 digit codes',1),
	(10,'2017-12-10 22:43:49','2017-12-11 04:43:49','card_expiration_days','365','card expiration days',1),
	(11,'2018-02-10 00:00:00','2018-02-10 06:00:00','environment_setup','2','environment setup. 1=QA,2=Production',1),
	(12,'2018-02-10 23:38:25','2018-02-11 05:38:25','apps_name','POS','application name',1),
	(13,'0000-00-00 00:00:00','0000-00-00 00:00:00','config_company_name','Appward POS','Company Name',1);

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table subscription_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `subscription_types`;

CREATE TABLE `subscription_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table subscriptions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `subscriptions`;

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) DEFAULT NULL,
  `details` varchar(100) DEFAULT NULL,
  `is_sync` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table suppliers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;

INSERT INTO `suppliers` (`id`, `created_at`, `updated_at`, `branch_id`, `client_id`, `firstname`, `middlename`, `lastname`, `company_name`, `address`, `email`, `mobile`, `phone`, `is_sync`, `is_deleted`)
VALUES
	(1,'2018-09-26 19:54:14','2018-12-01 11:52:33',1,1,'Grocery','Grocery','Grocery','YBC Supermarket','580 Rizal Avenue East Tapinac Olongapo City','','','',0,1),
	(2,'2018-11-29 14:28:33','2018-11-30 04:28:33',0,0,'Supplier','','','Puregold','QC','','','',0,0),
	(3,'2018-11-29 15:06:56','2018-11-30 05:06:56',0,0,'Supplier','','Test','Puregold','QC','','','',0,0),
	(4,'2018-11-29 15:07:38','2018-11-30 05:07:38',0,0,'Supplier','','Test','Puregold','QC','','','',0,0),
	(5,'2018-11-29 15:08:43','2018-11-30 05:08:43',0,0,'Supplier','','Test','Puregold','','','','',0,0),
	(6,'2018-11-29 16:18:17','2018-11-30 06:18:17',6,7,'Supplier','','Test','Puregold','QC','','','',0,0),
	(7,'2018-11-30 21:50:25','2018-12-01 11:50:25',1,1,'Laundry','','Supplier','GristChem','','','','',0,0),
	(8,'2018-11-30 21:51:03','2018-12-01 11:51:03',2,1,'WT','','Supplier','OxyChem','','','','',0,0),
	(9,'2018-11-30 22:50:16','2018-12-01 12:50:16',3,2,'Yay','','Supplier','YaySupplier','QC','yaysupplier@gmail.com','12345671234','1234567',0,0),
	(10,'2018-12-01 12:00:25','2018-12-01 12:00:25',1,1,'test','','test','test1','','','','',0,0);

/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tax_settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tax_settings`;

CREATE TABLE `tax_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table transactions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `seq` int(11) NOT NULL DEFAULT '0',
  `machine_type_id` int(11) NOT NULL DEFAULT '0',
  `is_services` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;

INSERT INTO `transactions` (`id`, `created_at`, `updated_at`, `name`, `seq`, `machine_type_id`, `is_services`, `is_deleted`)
VALUES
	(0,'0000-00-00 00:00:00',NULL,'',0,0,0,0),
	(1,'2017-04-27 13:26:18','2017-04-29 10:48:52','Washer',1,1,1,0),
	(2,'2017-04-27 13:26:53','2017-04-27 02:26:53','Dryer',2,2,1,0),
	(3,'2017-05-11 21:54:43','2017-05-11 10:54:43','Titan',3,3,1,0),
	(4,'2017-04-28 22:57:46','2017-04-28 11:57:46','Top up',4,1,1,0),
	(5,'2017-04-30 17:30:54','2017-04-30 06:30:54','Top down',5,2,1,0),
	(6,'2017-06-24 16:09:05','2017-06-24 13:09:05','Card registration',6,0,0,0),
	(7,'2017-06-24 16:09:05','2017-06-25 13:09:05','Payment',7,0,0,0);

/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_based_access
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_based_access`;

CREATE TABLE `user_based_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(100) NOT NULL DEFAULT '',
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
  `account_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `created_at`, `updated_at`, `username`, `email`, `pword_hash`, `role`, `last_login`, `emp_id`, `client_id`, `is_override_useraccess`, `is_sync`, `is_active`, `last_sync`, `branch_id`, `is_password_changed`, `is_employee`, `account_type_id`)
VALUES
	(1,'2018-08-29 00:46:41','2018-08-29 13:46:41','wservice.washndry','','21232f297a57a5a743894a0e4a801fc3',1,'2018-10-14 02:44:11',0,0,1,0,1,'1970-08-01 00:00:00',0,0,NULL,1),
	(2,'2018-07-16 12:54:18','2018-08-29 11:31:09','admin','admin@pos.com','21232f297a57a5a743894a0e4a801fc3',2,'2018-12-13 11:08:25',0,0,1,0,1,'1970-08-01 00:00:00',0,NULL,0,3),
	(3,'2018-11-30 20:07:57','2018-12-01 10:07:57','cris@gmail.com','cris@gmail.com','21232f297a57a5a743894a0e4a801fc3',3,'2018-12-10 14:41:39',0,1,0,0,1,'1970-08-01 00:00:00',NULL,0,0,NULL),
	(4,'2018-11-30 21:31:38','2018-12-01 11:31:38','jommel','jommel@gmail.com','21232f297a57a5a743894a0e4a801fc3',4,'2018-12-16 23:43:06',1,1,0,0,1,'1970-08-01 00:00:00',1,0,1,NULL),
	(5,'2018-11-30 21:32:01','2018-12-01 11:32:01','macy','macy@gmail.com','21232f297a57a5a743894a0e4a801fc3',5,'2018-12-16 23:38:09',2,1,0,0,1,'1970-08-01 00:00:00',1,0,1,NULL),
	(6,'2018-11-30 21:54:46','2018-12-01 11:54:46','aris','','21232f297a57a5a743894a0e4a801fc3',4,'2018-12-02 00:10:53',3,1,0,0,1,'1970-08-01 00:00:00',2,0,1,NULL),
	(7,'2018-11-30 21:55:11','2018-12-01 11:55:11','donna','donna@gmail.com','21232f297a57a5a743894a0e4a801fc3',5,'2018-12-01 23:30:14',4,1,0,0,1,'1970-08-01 00:00:00',2,0,1,NULL),
	(8,'2018-11-30 22:39:03','2018-12-01 12:39:03','attychoi@gmail.com','attychoi@gmail.com','21232f297a57a5a743894a0e4a801fc3',3,'2018-12-01 12:43:12',0,2,0,0,1,'1970-08-01 00:00:00',NULL,0,0,NULL),
	(9,'2018-11-30 22:47:53','2018-12-01 12:47:53','yayaris','yayaris@gmail.com','21232f297a57a5a743894a0e4a801fc3',4,'2018-12-01 12:53:52',5,2,0,0,1,'1970-08-01 00:00:00',3,0,1,NULL),
	(10,'2018-11-30 22:48:19','2018-12-01 12:48:19','yaydonna','yaydonna@gmail.com','21232f297a57a5a743894a0e4a801fc3',5,'2018-12-01 12:51:31',6,2,0,0,1,'1970-08-01 00:00:00',3,0,1,NULL),
	(11,'2018-12-09 17:13:21','2018-12-09 17:13:21','testadmin','','21232f297a57a5a743894a0e4a801fc3',2,'2018-12-09 17:13:33',0,0,0,0,1,'1970-08-01 00:00:00',NULL,0,0,NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
