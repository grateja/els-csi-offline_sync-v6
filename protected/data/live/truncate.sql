/* 10:32:08 PM localhost appward_pos_live */ TRUNCATE TABLE `user_based_access`;
/* 10:33:45 PM localhost appward_pos_live */ TRUNCATE TABLE `purchases`;
/* 10:33:52 PM localhost appward_pos_live */ TRUNCATE TABLE `pos_transactions`;
/* 10:33:58 PM localhost appward_pos_live */ TRUNCATE TABLE `pos_payment_headers`;
/* 10:34:02 PM localhost appward_pos_live */ TRUNCATE TABLE `pos_payment_details`;
/* 10:34:29 PM localhost appward_pos_live */ TRUNCATE TABLE `machine_usage_headers`;
/* 10:34:32 PM localhost appward_pos_live */ TRUNCATE TABLE `machine_usage_details`;
/* 10:35:23 PM localhost appward_pos_live */ TRUNCATE TABLE `inventories`;
/* 10:35:31 PM localhost appward_pos_live */ TRUNCATE TABLE `expenses`;
/* 10:35:37 PM localhost appward_pos_live */ TRUNCATE TABLE `employees`;
/* 10:35:50 PM localhost appward_pos_live */ TRUNCATE TABLE `customers`;
/* 10:35:58 PM localhost appward_pos_live */ TRUNCATE TABLE `customer_transactions`;
/* 10:36:04 PM localhost appward_pos_live */ TRUNCATE TABLE `customer_cards`;
/* 10:36:11 PM localhost appward_pos_live */ TRUNCATE TABLE `controllers`;
/* 10:36:18 PM localhost appward_pos_live */ TRUNCATE TABLE `clients`;
/* 10:36:24 PM localhost appward_pos_live */ TRUNCATE TABLE `branches`;
/* 10:36:31 PM localhost appward_pos_live */ TRUNCATE TABLE `authToken`;
/* 10:36:36 PM localhost appward_pos_live */ TRUNCATE TABLE `audit_trails`;
/* 10:36:42 PM localhost appward_pos_live */ TRUNCATE TABLE `actions`;

/*01232019*/
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
	(1,'0000-00-00 00:00:00','2018-12-01 09:36:07','ELS','Phils','Inc','ELS Phil Inc','tst','teset@test.test','093213131','12321323',0,1,NULL,NULL,NULL);





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
	(1,'2018-08-29 00:46:41','2018-08-29 00:46:41','wservice.washndry','','21232f297a57a5a743894a0e4a801fc3',1,'2018-10-13 13:44:11',0,0,1,0,1,'1970-08-01 00:00:00',0,0,NULL,1),
	(2,'2018-07-16 12:54:18','2018-08-28 22:31:09','admin','admin@pos.com','21232f297a57a5a743894a0e4a801fc3',2,'2018-11-29 11:28:43',0,0,1,0,1,'1970-08-01 00:00:00',0,NULL,0,2);

