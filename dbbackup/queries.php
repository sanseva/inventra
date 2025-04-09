--Siddhi Mirashi 11-11-2024

CREATE TABLE `system_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(11) NOT NULL,
  `ord_id` int(11) NOT NULL,
  `operation` varchar(50) NOT NULL,
  `module_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `fields` text NOT NULL COMMENT 'Mostly we''ll use while updating fields',
  `processed_data` varchar(2000) NOT NULL COMMENT 'Added data which go unbder processing in json format',
  `added_by` int(11) NOT NULL,
  `added_date` date NOT NULL DEFAULT current_timestamp(),
  `added_time` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `system_log` CHANGE `fields` `fields` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'null' COMMENT 'Mostly we\'ll use while updating fields';

ALTER TABLE `billednodetails` ADD `created_by` INT(11) NULL DEFAULT NULL AFTER `created_date`;

<!-- priyanshi 12-11-2024 -->
ALTER TABLE `retailersinformation` ADD `created_by` VARCHAR(255) NULL DEFAULT NULL AFTER `updated_by`, ADD `created_at` TIMESTAMP NULL DEFAULT NULL AFTER `created_by`;

ALTER TABLE `system_log` CHANGE `processed_data` `processed_data` VARCHAR(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'null' COMMENT 'Added data which go unbder processing in json format';

ALTER TABLE `retailersinformation` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;

ALTER TABLE `collection` ADD `created_by` INT(11) NOT NULL AFTER `created`;