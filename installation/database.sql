DROP DATABASE IF EXISTS `db_phonify`;
CREATE DATABASE `db_phonify`;

USE `db_phonify`;

CREATE TABLE IF NOT EXISTS `tbl_products` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `img_url` VARCHAR(100) NOT NULL,
    `category` VARCHAR(20) NOT NULL,
    `os` VARCHAR(10),
    `price` DECIMAL(7, 2) NOT NULL,
    `description` VARCHAR(200),
    PRIMARY KEY(`id`)
)engine=INNODB;

/* SMARTPHONES - 6 */
INSERT INTO `tbl_products`(`name`, `img_url`, `category`, `os`, `price`, `description`) VALUES ('Samsung Galaxy S20 Ultra', './assets/images/s20-ultra.png','sp', 'android', '1399.99', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus velit saepe quam');
INSERT INTO `tbl_products`(`name`, `img_url`, `category`, `os`, `price`, `description`) VALUES ('iPhone 11 Pro Max', './assets/images/iphone-11-pro-max.png', 'sp', 'ios', '1199.99', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus velit saepe quam');
INSERT INTO `tbl_products`(`name`, `img_url`, `category`, `os`, `price`, `description`) VALUES ('Huawei Mate 30 Pro', './assets/images/huawei-mate-30-pro.png', 'sp', 'android', '899.99', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus velit saepe quam');
INSERT INTO `tbl_products`(`name`, `img_url`, `category`, `os`, `price`, `description`) VALUES ('iPhone X', './assets/images/apple-iphone-x.png', 'sp', 'ios', '699.00', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus velit saepe quam');
INSERT INTO `tbl_products`(`name`, `img_url`, `category`, `os`, `price`, `description`) VALUES ('Samsung Galaxy Note 10+', './assets/images/note-10-plus.png','sp', 'android', '849.99', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus velit saepe quam');
INSERT INTO `tbl_products`(`name`, `img_url`, `category`, `os`, `price`, `description`) VALUES ('iPhone 11', './assets/images/iphone-11.png','sp', 'ios', '699.99', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Doloribus velit saepe quam');

/* ACCESSORIES - 4 */

INSERT INTO `tbl_products`(`name`, `img_url`, `category`, `os`, `price`, `description`) VALUES ('Samsung Galaxy Note 10 Case', './assets/images/note-10-case.png','accessories', 'android', '49.99', 'A premium case manfactured and designed by Samsung Electronics for the Note 10.');
INSERT INTO `tbl_products`(`name`, `img_url`, `category`, `os`, `price`, `description`) VALUES ('Huawei Mate 30 Pro Case', './assets/images/mate-30-pro-case.png','accessories', 'android', '34.99', 'A premium case designed by Huawei for their Mate 30 Pro flagship.');
INSERT INTO `tbl_products`(`name`, `img_url`, `category`, `os`, `price`, `description`) VALUES ('iPhone 11 Pro Max Case', './assets/images/11-pro-max-case.png','accessories', 'ios', '51.99', 'A premium leather case designed by Apple for iPhone 11 Pro Max.');
INSERT INTO `tbl_products`(`name`, `img_url`, `category`, `os`, `price`, `description`) VALUES ('Apple Airpods', './assets/images/airpods.png','accessories', 'ios', '199.00', 'Wireless Earpods with wireless charing case for IOS products.');

/* REPAIR KITS - 1 */
INSERT INTO `tbl_products`(`name`, `img_url`, `category`, `os`, `price`, `description`) VALUES ('iFixit Essentials', './assets/images/ifixit-repair-kit.png','repairkits', '', '24.00', 'A repair kit to assist in the maintenance of smartphones and laptops.');

CREATE TABLE IF NOT EXISTS `tbl_users` (
    `id` INT(11) AUTO_INCREMENT NOT NULL,
    `username` TINYTEXT NOT NULL,
    `email` TINYTEXT NOT NULL,
    `password` LONGTEXT NOT NULL,
    PRIMARY KEY (`id`)
)engine=innodb;

/*
    username - admin
    email - admin@phonify.co.uk  
    password - Password123.
----------------------------------------------------
    username - user
    email - example@gmail.com
    password - Password
*/

INSERT INTO `tbl_users` VALUES (NULL, 'admin', 'admin@phonify.co.uk', '$2y$10$3786HoCTKMszVf1WojbdyuNQeYK0Iaq60aP.XJMUkn8TYiWRJZIZ2');
INSERT INTO `tbl_users` VALUES (NULL, 'user', 'example@gmail.com', '$2y$10$geoKby1NjjGSShDnCeTYLew.2NlEVbrg1IznGLGeWXHtfWxFb7Sda');