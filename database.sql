SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `transactions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint(20) NOT NULL,
  `status` enum('Pending','Paid','Failed') NOT NULL DEFAULT 'Pending',
  `item_name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_type` enum('virtual_account','credit_card') NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `merchant_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `merchant_id` (`merchant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `transactions` (`id`, `invoice_id`, `status`, `item_name`, `amount`, `payment_type`, `customer_name`, `merchant_id`) VALUES
(1,	100101,	'Pending',	'Gelas',	10,	'virtual_account',	'Ilham Gusti',	1),
(2,	100101,	'Pending',	'Setrika',	10,	'virtual_account',	'Wibowo Gusti',	2),
(3,	100101,	'Pending',	'Meja', 	10,	'credit_card',	    'Ilham Wibowo',	3),
(4,	100101,	'Pending',	'Charger',	10,	'virtual_account',	'Gusti Ilham',	4),
(5,	100101,	'Pending',	'Keyboard',	10,	'virtual_account',	'Wibowo Ilham',	5),
(6,	100101,	'Pending',	'Kipas',	10,	'virtual_account',	'Wibowo Gusti',	6),
(7,	2201211,'Pending',	'Kabel',	30,	'virtual_account',	'Gusti Wibowo',	7);
