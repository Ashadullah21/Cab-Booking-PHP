-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2022 at 07:31 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbsphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_list`
--

CREATE TABLE `booking_list` (
  `id` int(30) NOT NULL,
  `ref_code` varchar(100) NOT NULL,
  `client_id` int(30) NOT NULL,
  `cab_id` int(30) NOT NULL,
  `pickup_zone` text NOT NULL,
  `drop_zone` text NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 = Pending,\r\n1 = Driver has Confirmed,\r\n2 = Pickup,\r\n3 = drop-off,\r\n4 = cancelled',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_list`
--

INSERT INTO `booking_list` (`id`, `ref_code`, `client_id`, `cab_id`, `pickup_zone`, `drop_zone`, `status`, `date_created`, `date_updated`) VALUES
(2, '202202-00003', 1, 2, '74 Frosty Lane', '15 Franklee Lane', 4, '2022-02-16 13:53:27', '2022-03-26 22:07:49'),
(3, '202202-00003', 1, 2, '79 Shobe Lane', '48 Clinton Street', 3, '2022-02-16 15:33:10', '2022-03-26 22:08:01'),
(24, '202203-00013', 12, 6, '144 Test Location', '522 Test Location', 4, '2022-03-27 22:54:41', '2022-03-27 22:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `cab_list`
--

CREATE TABLE `cab_list` (
  `id` int(30) NOT NULL,
  `reg_code` varchar(100) NOT NULL,
  `category_id` int(30) NOT NULL,
  `cab_reg_no` varchar(200) NOT NULL,
  `body_no` varchar(100) NOT NULL,
  `cab_model` text NOT NULL,
  `cab_driver` text NOT NULL,
  `driver_contact` text NOT NULL,
  `driver_address` text NOT NULL,
  `password` text NOT NULL,
  `image_path` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cab_list`
--

INSERT INTO `cab_list` (`id`, `reg_code`, `category_id`, `cab_reg_no`, `body_no`, `cab_model`, `cab_driver`, `driver_contact`, `driver_address`, `password`, `image_path`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, '202202-00002', 1, 'ASTR0306', 'Fusion-130', 'Ford Fusion', 'Abdullah', '09123456789', 'Small Street, Melapalayam', '5f4dcc3b5aa765d61d8327deb882cf99', 'uploads/dirvers/1.png?v=1644981064', 1, 0, '2022-03-02 10:59:12', '2022-03-27 22:04:44'),
(2, '202202-00001', 2, 'ASTR0715', 'Camry-440', 'Toyota Camry', 'Riyaz', '09456987123', 'Big Street, Melapalayam', '7ad1aea197a92805ac70f71bdec579d3', 'uploads/dirvers/2.png?v=1644981833', 1, 0, '2022-03-02 11:13:30', '2022-03-27 22:04:51'),
(3, '202203-00001', 1, 'ASTR0123', 'Prius-1010', 'Toyota Prius', 'Saifullah', '7485658965', 'Hameem puram, Melapalayam', '5f4dcc3b5aa765d61d8327deb882cf99', 'uploads/dirvers/3.png?v=1648051050', 1, 0, '2022-03-02 21:42:30', '2022-03-27 22:05:00'),
(4, '202203-00002', 1, 'ASTR0770', 'Soul-009', 'Kia Soul', 'Thameem', '7896478540', 'West Street, Aarampannai', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-02 21:59:17', '2022-03-27 14:44:37'),
(5, '202203-00003', 1, 'ASTR0741', 'Civic-7781', 'Honda Civic', 'Imran', '7895410000', 'NGO Colony, Tirunelveli', '5f4dcc3b5aa765d61d8327deb882cf99', 'uploads/dirvers/5.png?v=1648311707', 1, 0, '2022-03-02 22:06:47', '2022-03-27 14:44:40'),
(6, '202203-00004', 2, 'ASTR0850', 'ESV-7700', 'Cadillac Escalade ESV', 'Bilal', '7850001010', 'KTC Nagar, Tirunelveli', '5f4dcc3b5aa765d61d8327deb882cf99', 'uploads/dirvers/6.png?v=1648311872', 1, 0, '2022-03-02 22:09:32', '2022-03-27 14:44:43'),
(7, '202203-00005', 1, 'ASTR0555', 'iTen-1010', 'Hyundai i10', 'Yahees', '9785478500', 'Quaide Millath Street, Melapalayam', '5f4dcc3b5aa765d61d8327deb882cf99', 'uploads/dirvers/7.png?v=1648312063', 1, 0, '2022-03-02 22:12:43', '2022-03-02 22:12:43'),
(8, '202203-00006', 1, 'ASTR0020', 'Skoda-162TSI', 'Skoda Superb 162TSI', 'Ajith', '9547854444', 'Vannarpettai, Tirunelveli', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-02 22:16:57', '2022-03-27 14:44:48'),
(9, '202203-00007', 1, 'ASTRO0022', 'Picanto-7785', 'Kia Picanto', 'Vijay', '7558889850', 'New Bus stand Road,Tirunelveli', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-02 22:18:41', '2022-03-27 14:44:51'),
(10, '202203-00008', 3, 'ASTR0089', 'Galaxy-7777', 'Ford Galaxy', 'Rajini', '9589654570', 'Junction, Tirunelveli', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-02 13:00:24', '2022-03-27 14:44:53'),
(11, '202203-00009', 1, 'ASTR0047', 'Passat-7890', 'Volkswagen Passat', 'Surya', '7896666666', 'Town, Tirunelveli', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-02 13:02:37', '2022-03-27 14:44:57'),
(12, '202203-00010', 3, 'ASTR0258', 'Touran-8989', 'Volkswagen Touran', 'Dhanush', '7412563250', 'Shanthi Nagar, Tirunelveli', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-02 13:04:26', '2022-03-27 14:44:59'),
(13, '202203-00011', 1, 'ASTR0885', 'Toledo-5555', 'SEAT Toledo', 'Kamal', '7895555540', 'Aandavar Street, Melapalayam', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-02 13:05:37', '2022-03-27 14:45:02'),
(14, '202203-00012', 1, 'ASTR0135', 'i30T-0135', 'Hyundai i30 Tourer', 'STR', '7412580000', 'Thaalayuthu, Tirunelveli', '5f4dcc3b5aa765d61d8327deb882cf99', 'uploads/dirvers/14.png?v=1648366006', 1, 0, '2022-03-02 13:11:46', '2022-03-27 13:11:46');

-- --------------------------------------------------------

--
-- Table structure for table `category_list`
--

CREATE TABLE `category_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_list`
--

INSERT INTO `category_list` (`id`, `name`, `description`, `delete_flag`, `status`, `date_created`, `date_updated`) VALUES
(1, '5 Seater', 'A 4-door passenger car with a trunk that is separate from the passengers with a three-box body: the engine, the area for passengers, and the trunk.', 0, 1, '2022-03-01 10:03:54', '2022-03-02 13:03:14'),
(2, '6 Seater', 'Quisque iaculis ipsum egestas nisi pharetra, ac laoreet felis tincidunt. Cras id gravida justo. Nulla non gravida risus, vel finibus leo. Phasellus vel eros ligula. Fusce a erat sed quam vehicula convallis.', 0, 1, '2022-03-01 10:08:10', '2022-03-27 14:45:51'),
(3, '7 Seater', 'Flexible, allowing you to switch between lots of seats or lots of boot space. The biggest manage to do both - comfortably taking six passengers and their stuff.', 0, 1, '2022-03-03 12:59:29', '2022-03-27 14:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `client_list`
--

CREATE TABLE `client_list` (
  `id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text,
  `lastname` text NOT NULL,
  `gender` text NOT NULL,
  `contact` text NOT NULL,
  `address` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `image_path` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_list`
--

INSERT INTO `client_list` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `contact`, `address`, `email`, `password`, `image_path`, `status`, `delete_flag`, `date_created`, `date_added`) VALUES
(1, 'Ash', '', 'adullah', 'Male', '9025797924', 'QMS Melapalayam, Tirunelveli', 'ashadullah@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'uploads/clients/1.png?v=1644995661', 1, 0, '2022-02-27 13:06:42', '2022-03-27 21:10:54'),
(2, 'Christine', 'M.', 'Moore', 'Female', '7412589666', '12 Bleck Street, PA', 'christine@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'uploads/clients/2.png?v=1648043485', 1, 0, '2022-03-01 19:36:24', '2022-03-27 21:10:40'),
(17, 'Norma', 'K.', 'Gravelle', 'Female', '1458965555', '66 Blane Street', 'normak@mail.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 1, 0, '2022-03-27 22:24:54', NULL);


-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Kupido Cab Booking System'),
(6, 'short_name', 'KCBS'),
(11, 'logo', 'uploads/1648050060_cbslg.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/1648048980_cbss22.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Ash', 'adullah', 'admin', 'd00f5d5217896fb7fd601412cb890830', 'uploads/1624000_adminicn.png', NULL, 1, '2022-01-19 14:02:37', '2022-03-27 21:51:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_list`
--
ALTER TABLE `booking_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cab_id` (`cab_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `cab_list`
--
ALTER TABLE `cab_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_list`
--
ALTER TABLE `client_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING HASH;

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_list`
--
ALTER TABLE `booking_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `cab_list`
--
ALTER TABLE `cab_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `client_list`
--
ALTER TABLE `client_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_list`
--
ALTER TABLE `booking_list`
  ADD CONSTRAINT `booking_list_ibfk_1` FOREIGN KEY (`cab_id`) REFERENCES `cab_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_list_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `client_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cab_list`
--
ALTER TABLE `cab_list`
  ADD CONSTRAINT `cab_list_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_list` (`id`) ON DELETE CASCADE;


/* REMOVE THE BELOW LINES IF DATABASE NOT IMPORTED CORRECTLY OR SHOWING ERROR WHILE IMPORTING */	

/* sql -> copy the below table -> go */
/*
CREATE TABLE contact (
  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
*/
/* cbsphp -> booking_list table -> sql -> copy this two line */
/*

Alter table booking_list add created_at timestamp default current_timestamp;
Alter table booking_list modify status enum('0', '1', '2', '3', '4') default '0';

*/
/* cbsphp -> client_list table -> sql -> copy the below line  */
/*

alter TABLE cab_list add COLUMN driver_license_no varchar(100) not null after driver_contact;

Alter table client_list add COLUMN email_verified tinyint(1) DEFAULT 0;

*/

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
