--
-- Table structure for table `learning_account`
--

CREATE TABLE IF NOT EXISTS `#__learning_account` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL,
  `contact_number` bigint(15),
  `payment_details` varchar(600),
  `address` varchar(700),
  `published` tinyint(1) NOT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;
