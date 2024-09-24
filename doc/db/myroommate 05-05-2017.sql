-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 05, 2017 at 04:26 PM
-- Server version: 5.6.25
-- PHP Version: 5.5.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myroommate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE IF NOT EXISTS `admin_login` (
  `id` int(11) NOT NULL,
  `admin_username` varchar(256) NOT NULL,
  `admin_password` varchar(256) NOT NULL,
  `admin_email` varchar(256) NOT NULL,
  `profile_picture` text NOT NULL,
  `admin_contactus` varchar(200) NOT NULL,
  `admin_fax` varchar(128) NOT NULL,
  `admin_address` text NOT NULL,
  `site_status` enum('1','0') NOT NULL,
  `admin_address2` varchar(255) NOT NULL,
  `admin_address3` varchar(255) NOT NULL,
  `admin_country` varchar(255) NOT NULL,
  `admin_state` varchar(255) NOT NULL,
  `admin_city` varchar(255) NOT NULL,
  `admin_postcode` varchar(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `admin_username`, `admin_password`, `admin_email`, `profile_picture`, `admin_contactus`, `admin_fax`, `admin_address`, `site_status`, `admin_address2`, `admin_address3`, `admin_country`, `admin_state`, `admin_city`, `admin_postcode`) VALUES
(1, 'admin', 'room@room', 'rahuls@webwingtechnologies.com', '7286.jpg', '+353857558203', '55241123', '121 King Street, Melbourne, VIC, 3000, Australia', '1', '', '', 'Australia', 'Victoria', 'Melbourne City', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_addlisting`
--

CREATE TABLE IF NOT EXISTS `tbl_addlisting` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `mainphoto` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `payment_type` enum('free','paid') NOT NULL,
  `availability` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') NOT NULL,
  `is_delete` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_addlisting`
--

INSERT INTO `tbl_addlisting` (`id`, `cat_id`, `user_id`, `title`, `slug`, `description`, `mainphoto`, `mobile`, `email`, `price`, `payment_type`, `availability`, `created_date`, `status`, `is_delete`) VALUES
(1, 25, 1, 'sharing available for indian', 'sharing-available-for-indian', 'A big room having with all the facilities like  A big room having with all the facilities like  A big room having with all the facilities like  A big room having with all the facilities like  A big room having with all the facilities like  A big room having with all the facilities like  A big room having with all the facilities like  A big room having with all the facilities like A big room having with all the facilities like ', '3811249.jpg', '9876543215', 'test@gmail.com', '999.77', 'free', 'Within6Months', '2017-04-21 05:44:05', '1', '0'),
(2, 15, 1, 'Nice furnished', 'nice-furnished', 'One bedroom for sharing with decent lady in Cornich Alkhan , with crew member who does not stay most of the time at home. One bedroom for sharing with decent lady in Cornich Alkhan , with crew member who does not stay most of the time at home.', '2235034.jpg', '987654851', 'nice@gmail.com', '150.00', 'free', 'Within1Month', '2017-04-21 11:37:43', '1', '0'),
(63, 17, 1, 'chair title', 'chair-title', 'chair description', '6710988.jpg', '9876543210', 'testing@demo.com', '1299.00', 'paid', 'Immediately', '2017-05-02 06:27:15', '1', '0'),
(64, 15, 1, 'Demo editing', 'demo-editing', 'Demo editing qwerty', '1338376.jpg', '9876543210', 'testing@email.com', '1999.00', 'free', 'Within3Months', '2017-05-02 11:45:32', '1', '0'),
(68, 17, 1, 'Demo editing', 'demo-editing', 'qwerty', '6600273.jpg', '9876543210', 'testing@email.com', '1234.57', 'free', 'Within3Months', '2017-05-03 12:45:59', '1', '0'),
(69, 95, 1, 'whirphool', 'whirphool', 'Whirlpool 330 L Triple Door Refrigerator FP 343D PROTTON ROY', '6346931.jpeg', '9763993956', 'anklitaa@webwingtechnologies.com', '38000.00', 'paid', 'Immediately', '2017-05-04 04:49:23', '1', '0'),
(70, 25, 1, 'laptop', 'laptop', 'Dell Inspiron Core I3 6th Gen - 4 Gb/1 Tb Hdd/Windows 10', '7827274.jpeg', '9875644431', 'rahuls@webwingtechnology.com', '38000.00', 'paid', 'Immediately', '2017-05-04 04:54:33', '1', '0'),
(71, 97, 1, 'mistorious', 'mistorious', 'Harry Potter the Goblet of Stone', '2538126.jpeg', '9822444422', 'tushars@webwingtechnology.com', '400.00', 'paid', 'Immediately', '2017-05-04 04:58:07', '1', '0'),
(72, 92, 1, 'Television', 'television', 'Sony 80 cm (32) HD/HD Ready Smart LED TV ', '2712997.jpeg', '9877444432', 'jayantm@webwingtechnology.com', '40000.00', 'paid', 'Immediately', '2017-05-04 05:00:14', '1', '0'),
(73, 89, 1, 'pulsar', 'pulsar', 'pulsar 220cc', '9914801.jpeg', '9877444432', 'deepaks@webwingtechnology.com', '99000.00', 'paid', 'Immediately', '2017-05-04 05:08:26', '1', '0'),
(74, 102, 1, 'puma', 'puma', 'Puma Men Black Running Shoes', '398140.jpeg', '9763993956', 'nitishk@wsebwingtechnology.com', '2999.00', 'paid', 'Immediately', '2017-05-04 05:10:41', '1', '0'),
(75, 98, 1, 'shirts', 'shirts', 'puma shirt', '8954345.jpeg', '9763993956', 'anklitaa@webwingtechnologies.com', '900.00', 'paid', 'Immediately', '2017-05-04 05:29:17', '1', '0'),
(76, 17, 1, 'Demo editing', 'demo-editing-76', 'dfsngfrh', '7567041.png', '9028072075', 'rahuls@webwingtechnologies.com', '114125.00', 'free', 'Immediately', '2017-05-05 05:35:27', '1', '0'),
(77, 98, 1, 'puma', 'puma-77', 'shirt brand', '3206937.jpg', '9028072075', 'rahuls@webwingtechnologies.com', '987.00', 'free', 'Immediately', '2017-05-05 05:36:59', '1', '0'),
(78, 88, 1, 'motorola telephone', 'motorola-telephone', 'motorola telephone', '8833953.jpg', '9028072075', 'rahuls@webwingtechnologies.com', '123456.00', 'free', 'Immediately', '2017-05-05 05:45:36', '0', '0'),
(79, 107, 1, 'motorola telephone', 'motorola-telephone-79', 'motorola telephone', '227474.jpg', '9028072075', 'rahuls@webwingtechnologies.com', '986543.00', 'free', 'Within3Months', '2017-05-05 05:46:09', '0', '0'),
(80, 91, 1, 'motorola telephone', 'motorola-telephone-80', 'motorola telephone', '7342304.jpg', '9028072075', 'rahuls@webwingtechnologies.com', '9876543.00', 'free', 'Within1Month', '2017-05-05 05:46:45', '0', '0'),
(81, 21, 1, 'Demo editing', 'demo-editing-81', 'aefbnsafgnm ', '5391028.jpg', '9028072075', 'rahuls@webwingtechnologies.com', '987.21', 'free', 'Immediately', '2017-05-05 05:52:49', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_addlisting_data`
--

CREATE TABLE IF NOT EXISTS `tbl_addlisting_data` (
  `id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `attribute_slug` varchar(255) NOT NULL,
  `attribute_value` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_addlisting_data`
--

INSERT INTO `tbl_addlisting_data` (`id`, `listing_id`, `attribute_id`, `attribute_slug`, `attribute_value`) VALUES
(16, 11, 12, 'age', '32'),
(17, 11, 13, 'usage', 'Call'),
(18, 11, 14, 'condition', 'New'),
(19, 11, 15, 'warranty', 'warranty'),
(20, 11, 16, 'brand', 'brand'),
(21, 11, 17, 'address', 'address'),
(234, 2, 13, 'usage', 'Call'),
(235, 2, 14, 'condition', 'New'),
(236, 2, 15, 'warranty', '8 yrs'),
(237, 2, 16, 'brand', 'oppo'),
(238, 2, 17, 'address', 'this is test address qwerty'),
(240, 64, 12, 'age', '12 year'),
(241, 64, 13, 'usage', 'Call'),
(242, 64, 14, 'condition', 'Used'),
(243, 64, 15, 'warranty', '2 year'),
(244, 64, 16, 'brand', 'oppo'),
(245, 64, 17, 'address', 'this is test address qwerty');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_addlisting_transection`
--

CREATE TABLE IF NOT EXISTS `tbl_addlisting_transection` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `transaction_price` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pament_type` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_addlisting_transection`
--

INSERT INTO `tbl_addlisting_transection` (`id`, `user_id`, `listing_id`, `transaction_id`, `transaction_price`, `payment_status`, `payment_date`, `pament_type`) VALUES
(1, 1, 15, '0VR40517CJ038931G', '10.00', 'complete', '2017-04-29 04:03:04', 'credit_card'),
(2, 1, 16, '1BN60477RJ590084K', '15.00', 'complete', '2017-04-29 04:22:54', 'credit_card'),
(3, 1, 17, '16W30670529403206', '15.00', 'complete', '2017-04-29 04:29:15', 'credit_card'),
(4, 1, 22, '5XS15273A73844338', '10.00', 'complete', '2017-04-29 13:15:58', 'credit_card'),
(5, 1, 28, '70C881585X534600L', '10.00', 'complete', '2017-05-01 05:33:00', 'paypal'),
(6, 1, 27, '6LY06292GX734254B', '10.00', 'complete', '2017-05-01 05:33:05', 'paypal'),
(7, 1, 29, '6B4297254P601150L', '15.00', 'complete', '2017-05-01 05:32:39', 'paypal'),
(8, 1, 31, '6VX19078YY050842R', '10.00', 'complete', '2017-05-01 05:51:28', 'paypal'),
(9, 1, 32, '0XW65877ES542830U', '10.00', 'complete', '2017-05-01 06:02:47', 'paypal'),
(10, 1, 47, '09V24027583154627', '10.00', 'complete', '2017-05-01 09:34:34', 'paypal'),
(11, 1, 53, '6LR383484C876491E', '10.00', 'complete', '2017-05-01 09:44:55', 'credit_card'),
(12, 1, 61, '0WB93677J1244863C', '10.00', 'complete', '2017-05-01 10:01:08', 'paypal'),
(14, 1, 65, '74C79232W39307924', '10.00', 'complete', '2017-05-01 11:04:29', 'paypal'),
(15, 1, 63, '39F067160H4661100', '10.00', 'complete', '2017-05-02 06:27:41', 'paypal'),
(16, 1, 69, '7LK80140FC488590A', '10.00', 'complete', '2017-05-04 04:49:23', 'credit_card'),
(17, 1, 70, '6J667083481226627', '10.00', 'complete', '2017-05-04 04:54:33', 'credit_card'),
(18, 1, 71, '4R162471FP107662S', '10.00', 'complete', '2017-05-04 04:58:08', 'credit_card'),
(19, 1, 72, '10C64499N5827302C', '10.00', 'complete', '2017-05-04 05:04:03', 'paypal'),
(20, 1, 73, '3LM05644LG259082E', '10.00', 'complete', '2017-05-04 05:08:27', 'credit_card'),
(21, 1, 74, '8RL38103JX9561130', '10.00', 'complete', '2017-05-04 05:11:22', 'paypal'),
(22, 1, 75, '94D18454H75952444', '10.00', 'complete', '2017-05-04 05:29:17', 'credit_card');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advertisement`
--

CREATE TABLE IF NOT EXISTS `tbl_advertisement` (
  `id` int(11) NOT NULL,
  `adv_image` varchar(256) NOT NULL,
  `adv_name` varchar(256) NOT NULL,
  `is_delete` enum('1','0') NOT NULL,
  `status` enum('1','0','2') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_advertisement`
--

INSERT INTO `tbl_advertisement` (`id`, `adv_image`, `adv_name`, `is_delete`, `status`) VALUES
(1, '7340874.jpg', 'test', '1', '1'),
(2, '2219331.jpeg', 'kk', '1', '2'),
(3, '5185359.png', 'ankit', '1', '2'),
(4, '7190077.jpg', 'a', '1', '2'),
(5, '3295929.jpg', 'companies', '0', '1'),
(6, '3316601.jpeg', 'aa', '1', '2'),
(7, '8993191.jpg', 'hh', '1', '2'),
(8, '6894148.png', 'aaf', '1', '2'),
(9, '2506664.jpg', 'google', '1', '1'),
(10, '4836804.png', 'a', '1', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attribute_master`
--

CREATE TABLE IF NOT EXISTS `tbl_attribute_master` (
  `attribute_id` int(11) NOT NULL,
  `attribute_name` varchar(200) NOT NULL,
  `attribute_slug` varchar(255) NOT NULL,
  `attribute_status` enum('1','0') NOT NULL DEFAULT '1',
  `is_delete` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_attribute_master`
--

INSERT INTO `tbl_attribute_master` (`attribute_id`, `attribute_name`, `attribute_slug`, `attribute_status`, `is_delete`) VALUES
(5, 'Rent Per Month', 'rent-per-month', '1', '0'),
(6, 'Request Type', 'request-type', '1', '0'),
(7, 'Details', 'details', '1', '0'),
(8, 'Nationality Preference', 'nationality-preference', '1', '0'),
(9, 'Gender', 'gender', '1', '0'),
(10, 'Other Preferences', 'other', '1', '0'),
(11, 'Price', 'price', '1', '1'),
(12, 'Age', 'age', '1', '0'),
(13, 'Usage', 'usage', '1', '0'),
(14, 'Condition', 'condition', '1', '0'),
(15, 'Warranty', 'warranty', '1', '0'),
(16, 'Brand', 'brand', '1', '0'),
(17, 'Address', 'address', '1', '0'),
(23, 'Furnished', 'furnished', '1', '0'),
(24, 'Car Manufacturer', 'car-manufacturer', '1', '0'),
(25, 'Car Model', 'car-model', '1', '0'),
(26, 'Year', 'year', '1', '0'),
(27, 'Kilometers', 'kilometers', '1', '0'),
(28, 'Cylinders', 'cylinders', '1', '0'),
(29, 'Fuel Type', 'fuel-type', '1', '0'),
(30, 'Horsepower', 'horsepower', '1', '0'),
(31, 'Date Available', 'date-available', '1', '0'),
(32, 'Reason', 'reason', '1', '0'),
(33, 'Space', 'space', '1', '0'),
(34, 'Number of Rooms', 'number-of-rooms', '1', '0'),
(35, 'Bathrooms', 'bathrooms', '0', '0'),
(36, 'Car Mileage', 'car-mileage', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blogscategory_master`
--

CREATE TABLE IF NOT EXISTS `tbl_blogscategory_master` (
  `blogscategory_id` int(11) NOT NULL,
  `blogscategory_name` varchar(200) NOT NULL,
  `blogscategory_description` text NOT NULL,
  `blogscategory_status` enum('1','0') NOT NULL,
  `is_delete` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_blogscategory_master`
--

INSERT INTO `tbl_blogscategory_master` (`blogscategory_id`, `blogscategory_name`, `blogscategory_description`, `blogscategory_status`, `is_delete`) VALUES
(1, 'Diplomacy', 'Diplomacy\r\n', '1', '0'),
(2, 'Global Issues', 'Global Issues', '1', '0'),
(3, 'Lebanon', 'Lebanon', '1', '0'),
(4, 'Middle East', 'Middle East', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blogs_comments`
--

CREATE TABLE IF NOT EXISTS `tbl_blogs_comments` (
  `comm_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comm_blog_id` int(11) NOT NULL,
  `comm_parent_id` int(11) DEFAULT NULL,
  `comm_order_id` int(11) NOT NULL,
  `comm_name` char(250) CHARACTER SET latin1 NOT NULL,
  `comm_email` varchar(200) CHARACTER SET latin1 NOT NULL,
  `comm_website` varchar(128) NOT NULL,
  `comm_company` varchar(128) NOT NULL,
  `comm_message` text CHARACTER SET latin1 NOT NULL,
  `message_read` enum('0','1','2') CHARACTER SET latin1 NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_blogs_comments`
--

INSERT INTO `tbl_blogs_comments` (`comm_id`, `user_id`, `comm_blog_id`, `comm_parent_id`, `comm_order_id`, `comm_name`, `comm_email`, `comm_website`, `comm_company`, `comm_message`, `message_read`, `added_date`) VALUES
(1, 0, 12, 0, 0, 'Ankit', 'ankitaa@webwingtechnologies.com', '9763993956', '', 'Test', '1', '2017-04-28 11:19:08'),
(2, 0, 12, 0, 0, 'Bhavesh', 'bhavesh@gmail.com', '23423523453254', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled', '1', '2017-05-03 05:15:45'),
(3, 0, 11, 0, 0, 'ankit', 'tushara@webwingtechnologies.com', '9763993956', '', 'test', '1', '2017-05-03 05:51:43'),
(4, 0, 11, 0, 0, 'test', 'seemaj@webwingtechnologies.com', '9763993956', '', 'test', '0', '2017-05-03 06:07:32'),
(5, 0, 11, 0, 0, 'test', 'seemaj@webwingtechnologies.com', '9763993956', '', 'test', '0', '2017-05-03 06:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blogs_master`
--

CREATE TABLE IF NOT EXISTS `tbl_blogs_master` (
  `blogs_id` int(10) NOT NULL,
  `blogs_name_en` varchar(100) CHARACTER SET latin1 NOT NULL,
  `blogs_category_id` int(11) NOT NULL,
  `blogs_added_by` varchar(128) NOT NULL,
  `blogs_name_ar` varchar(255) NOT NULL,
  `blogs_description_en` text CHARACTER SET latin1 NOT NULL,
  `blogs_description_ar` text NOT NULL,
  `blogs_img` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT 'noimage.jpg    ' COMMENT 'news Image Name only',
  `blogs_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 - In Active/ 1 - Active / 2 - Deleted ',
  `blogs_front_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 - Hide on Front/ 1- Shown on Front ',
  `blogs_display_order` int(11) NOT NULL DEFAULT '0' COMMENT 'Front Display Order',
  `blogs_added_date` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_blogs_master`
--

INSERT INTO `tbl_blogs_master` (`blogs_id`, `blogs_name_en`, `blogs_category_id`, `blogs_added_by`, `blogs_name_ar`, `blogs_description_en`, `blogs_description_ar`, `blogs_img`, `blogs_status`, `blogs_front_status`, `blogs_display_order`, `blogs_added_date`) VALUES
(1, 'reter', 0, 'ertert', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into ', '', '6763373.jpeg', 1, 1, 0, '2016-06-22'),
(2, 'gfhgf', 0, 'Rahul', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into ', '', '2535832.jpg', 2, 0, 0, '2016-06-28'),
(3, 'gfhgfh', 2, 'gfhgfh', '', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into</p>', '', '1277342.jpg', 2, 0, 0, '2016-06-28'),
(4, 'trytrytrytrytry', 2, 'trytrytry', '', '<p style="list-style: none; margin: 0px 0px 20px; padding: 0px; border: 0px; box-sizing: inherit; font-size: 1.23em; line-height: 27px; font-family: NotoNashkArabic, ">Despite it being the ostensible focus of the present NDA government, &quot;ease of doing business&quot; in India seems stuck. Prime Minister Modi, in an attempt to make India one of the top 50 places to do business, has directed ministers and bureaucrats to reduce hindering procedures and paperwork&mdash;however, the country has only limped from&nbsp;<a href="http://www.livemint.com/Industry/uOrtVTE4CgFpPnwV3wATmK/India-ranked-130-in-World-Banks-Doing-Business-survey.html" rel="nofollow" style="list-style: none; margin: 0px; padding: 0px; border: 0px; box-sizing: inherit; color: rgb(13, 190, 152);">a position of 131 to 130 in the World Bank&#39;s ease of doing business rankings</a>&nbsp;despite the push for the last two or three years.</p>\r\n\r\n<div class="ad_spot entry-body--paragraph-ad " id="entry_paragraph_1" style="list-style: none; margin: 0px 0px 10px; padding: 0px; border: 0px; box-sizing: inherit; text-align: center; color: rgb(34, 34, 34); font-family: NotoNashkArabic, ">&nbsp;</div>\r\n\r\n<p style="list-style: none; margin: 0px 0px 20px; padding: 0px; border: 0px; box-sizing: inherit; font-size: 1.23em; line-height: 27px; font-family: NotoNashkArabic, ">So, why has the government not been able to solve this not-so-complex puzzle? Why has Modi&#39;s dynamic leadership and noble intentions not yielded dividends on this count?</p>', '', '660523.jpg', 2, 0, 0, '2016-06-30'),
(5, 'etretretertwwt', 1, 'erterter', '', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into</p>', '', '3466769.jpg', 2, 0, 0, '2016-06-27'),
(6, 'Writing an effective description', 3, 'ganesh', '', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap intoLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into</p>', '', '9002442.jpeg', 1, 1, 0, '2016-06-30'),
(10, 'I''m lucky I found a good friend', 4, 'Tushar ahire', '', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into</p>', '', '2117967.jpg', 1, 1, 0, '2016-06-29'),
(9, 'How to Be a Good Roommate', 1, 'Tushar ahire', '', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into</p>', '', '4198431.jpg', 1, 1, 0, '2016-06-29'),
(11, 'Writing an effective Listing your listing', 1, 'Tushar ahire', '', '<p style="list-style: none; margin: 0px 0px 20px; padding: 0px; border: 0px; box-sizing: inherit; font-size: 1.23em; line-height: 27px; font-family: NotoNashkArabic, ">Despite it being the ostensible focus of the present NDA government, &quot;ease of doing business&quot; in India seems stuck. Prime Minister Modi, in an attempt to make India one of the top 50 places to do business, has directed ministers and bureaucrats to reduce hindering procedures and paperwork&mdash;however, the country has only limped from&nbsp;<a href="http://www.livemint.com/Industry/uOrtVTE4CgFpPnwV3wATmK/India-ranked-130-in-World-Banks-Doing-Business-survey.html" rel="nofollow" style="list-style: none; margin: 0px; padding: 0px; border: 0px; box-sizing: inherit; color: rgb(13, 190, 152);">a position of 131 to 130 in the World Bank&#39;s ease of doing business rankings</a>&nbsp;despite the push for the last two or three years.</p>\r\n\r\n<div class="ad_spot entry-body--paragraph-ad " id="entry_paragraph_1" style="list-style: none; margin: 0px 0px 10px; padding: 0px; border: 0px; box-sizing: inherit; text-align: center; color: rgb(34, 34, 34); font-family: NotoNashkArabic, ">&nbsp;</div>\r\n\r\n<p style="list-style: none; margin: 0px 0px 20px; padding: 0px; border: 0px; box-sizing: inherit; font-size: 1.23em; line-height: 27px; font-family: NotoNashkArabic, ">So, why has the government not been able to solve this not-so-complex puzzle? Why has Modi&#39;s dynamic leadership and noble intentions not yielded dividends on this count?</p>', '', '288320.jpg', 1, 1, 0, '2016-06-29'),
(12, 'A dilemma for UAE residents', 2, 'Tushar ahire', '', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '', '6844559.jpg', 1, 1, 0, '2016-06-30'),
(13, 'Test', 0, 'test', '', '<p>\r\n	test</p>', '', '7554216.jpg', 2, 0, 0, '2016-07-25'),
(14, 'erter', 0, 'ertert', '', '<p>\r\n	werewr</p>', '', '8121829.jpg', 2, 0, 0, '2016-07-19'),
(15, 'rahul', 0, 'rahul', '', '<p>\r\n	<img alt="" src="http://gamewebsite.co.in/taskerhub/uploads/ckeditor/1467891769_01.jpg" style="width: 1920px; height: 860px;" /></p>', '', '9227591.jpg', 2, 0, 0, '2016-07-19'),
(16, 'Writing an effective Listing', 2, 'ankit', '', '<p>MyRoommate.me is specialized website to help people find bedspace, roommates and rooms in the UAE, and share apartments.&nbsp; If you are a student, an employee, or a small family,</p>', '', '4676571.jpg', 1, 1, 0, '2017-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_form_fields`
--

CREATE TABLE IF NOT EXISTS `tbl_category_form_fields` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `fields_type` varchar(100) NOT NULL,
  `fields_elements` text,
  `orderby` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `is_delete` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category_form_fields`
--

INSERT INTO `tbl_category_form_fields` (`id`, `cat_id`, `attribute_id`, `fields_type`, `fields_elements`, `orderby`, `status`, `is_delete`) VALUES
(5, 15, 11, 'text', NULL, 5, '1', '0'),
(6, 15, 12, 'text', NULL, 6, '1', '0'),
(7, 15, 13, 'radiobutton', 'Call|SMS|GAME', 7, '1', '0'),
(8, 15, 14, 'checkbox', 'New|Used|Not Applicable', 8, '1', '0'),
(9, 15, 15, 'text', NULL, 9, '1', '0'),
(10, 15, 16, 'text', NULL, 10, '1', '0'),
(11, 15, 17, 'text', NULL, 11, '1', '0'),
(13, 107, 5, 'radiobutton', '1 Day|1 Week|1 Month|1 Year', 1, '1', '0'),
(14, 14, 6, 'text', NULL, 12, '1', '0'),
(15, 14, 7, 'text', NULL, 13, '1', '0'),
(16, 15, 7, 'text', NULL, 14, '1', '0'),
(17, 16, 7, 'text', NULL, 15, '1', '0'),
(18, 14, 9, 'text', NULL, 16, '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_master`
--

CREATE TABLE IF NOT EXISTS `tbl_category_master` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `category_description` text NOT NULL,
  `featured` varchar(200) DEFAULT NULL,
  `profile_image` varchar(100) NOT NULL,
  `logo_image` varchar(200) NOT NULL,
  `category_status` enum('1','0') NOT NULL DEFAULT '1',
  `is_delete` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category_master`
--

INSERT INTO `tbl_category_master` (`category_id`, `parent_id`, `category_name`, `category_description`, `featured`, `profile_image`, `logo_image`, `category_status`, `is_delete`) VALUES
(1, 0, 'Furniture', 'High Defination Laptops', 'featured', '5529905.png', '2617406.png', '1', '0'),
(2, 0, 'Mobiles', 'mobile', NULL, '767023.png', '4403183.png', '1', '0'),
(3, 0, 'Cars', 'cars', NULL, '7356231.png', '2375481.png', '1', '0'),
(4, 0, 'Appliances', 'Appliance', NULL, '4893053.png', '2913798.png', '1', '0'),
(5, 0, 'Rooms', 'Rooms', NULL, '4032325.png', '371104.png', '1', '0'),
(6, 0, 'Jewelery', 'jewelery', NULL, '7477488.png', '7511967.png', '1', '0'),
(7, 0, 'Books', 'book', NULL, '4638231.png', '3720740.png', '1', '0'),
(8, 0, 'Electronics', 'Electronic', NULL, '2006673.png', '9714092.png', '1', '0'),
(9, 0, 'Maid', 'aa', NULL, '6737380.png', '8483921.png', '1', '0'),
(10, 0, 'Real Estate', 'real esteate', NULL, '3172873.png', '5769960.png', '1', '0'),
(11, 0, 'Bike', 'bike', NULL, '1394013.png', '4256602.png', '1', '0'),
(12, 1, 'Chaire', 'a', NULL, '1869516.jpeg', '993141.png', '1', '0'),
(13, 1, 'Sofa', '', '', '228688.jpg', '', '1', '0'),
(14, 2, 'Oppo', '', '', '794173.jpg', '', '1', '0'),
(15, 14, 'oppo fs', '', '', '8975890.jpg', '', '1', '0'),
(16, 14, 'Oppo fs plus', '', '', '7010600.jpg', '', '1', '0'),
(17, 12, 'Adirondack Chair', '', '', '8638311.jpeg', '', '1', '0'),
(18, 12, 'Aeron Chair', '', '', '9562600.jpeg', '', '0', '0'),
(19, 12, 'Armchair', '', '', '8445440.jpeg', '', '0', '0'),
(20, 13, 'Camel back', '', '', '6962327.jpeg', '', '1', '0'),
(21, 13, 'Bridgewater', '', '', '6252436.jpeg', '', '1', '0'),
(22, 0, 'Tests', 'Test Test', NULL, '1267042.png', '7959709.png', '1', '0'),
(23, 0, 'Computers  Laptops', 'computer laptoips', NULL, '2907471.png', '5106196.png', '1', '0'),
(24, 23, 'Servers', '', '', '2137970.jpg', '', '1', '0'),
(25, 24, 'Dell', '', '', '6274702.jpg', '', '1', '0'),
(26, 24, 'HP', '', '', '161733.jpg', '', '1', '0'),
(27, 3, 'maruti', 'white color maruthi car 8oo cc', 'featured', '4579915.jpeg', '', '0', '0'),
(28, 4, 'pasma', 'plasama Tv with High Defination Laptops, Home appliances, Mobile', 'featured', '6686484.jpeg', '', '0', '0'),
(29, 6, 'ring', 'Bags &amp; Beauty Products, Clothing - Female, Clothing - Male, Shoes', 'featured', '9448560.jpeg', '', '1', '0'),
(30, 1, 'table', 'Commercial & Offices, Farms, Home, Plaze & Property', 'featured', '4949625.jpg', '', '1', '0'),
(31, 30, 'A', 'A', 'featured', '8553725.jpeg', '2404670.jpg', '1', '1'),
(32, 30, 'a', 'a', 'featured', '7719229.jpeg', '714571.png', '1', '1'),
(33, 0, 'Cars & Vehicals', 'cars', 'featured', '722808.png', '9468149.png', '1', '0'),
(34, 33, 'Heavy Vehicles', 'Heavy Vehicles', NULL, '6076478.png', '3260299.png', '1', '0'),
(35, 33, 'Machinery & Construction', 'Machinery & Construction', NULL, '2860505.png', '7771303.png', '1', '0'),
(36, 33, 'Motorcycles & Bikes', 'Motorcycles & Bikes', NULL, '5471543.png', '4954527.png', '1', '0'),
(37, 33, 'Commercial Vehicles', 'Commercial Vehicles', NULL, '9227182.png', '3700255.png', '1', '0'),
(38, 33, 'Vehicle Accessories', 'Vehicle Accessories', NULL, '2911363.png', '9466387.png', '1', '0'),
(39, 0, 'Property', 'Property', NULL, '2281384.png', '760925.png', '1', '0'),
(40, 39, 'Commercial Property', 'Commercial Property', NULL, '9525297.png', '6615815.png', '1', '0'),
(41, 39, 'Houses & Apartments', 'Houses & Apartments', NULL, '1350351.png', '8008334.png', '1', '0'),
(42, 39, 'TV & LCD', 'TV &LCD', NULL, '6113797.png', '6877425.png', '1', '0'),
(43, 39, 'Land & Plots', 'Land & Plots', NULL, '875907.png', '4663186.png', '1', '0'),
(44, 39, 'Home & Office', 'Home & Office', NULL, '2831831.png', '9728247.png', '1', '0'),
(45, 39, 'Other Property', 'Other Property', NULL, '1815288.png', '9095776.png', '1', '0'),
(46, 8, 'Computers & Laptops', 'Computers & Laptops', NULL, '6168604.png', '5262291.png', '1', '0'),
(47, 8, 'Mobile & Tablets', 'Mobile & Tablets', NULL, '1132376.png', '4595242.png', '1', '0'),
(48, 8, 'TV & LCD', 'TV & LCD', NULL, '2136335.png', '3773649.png', '1', '0'),
(49, 8, 'Cameras & Camcorders', 'Cameras & Camcorders', NULL, '4164994.png', '2244502.png', '1', '0'),
(50, 8, 'Accessories', 'Accessories', NULL, '1641652.png', '6743245.png', '1', '0'),
(51, 0, 'Jobs', 'Jobs', NULL, '6388785.png', '9971872.png', '1', '0'),
(52, 51, 'Finace Jobs', 'Finace Jobs', NULL, '1344821.png', '38890.png', '1', '0'),
(53, 51, 'Private Jobs', 'Private Jobs', NULL, '6830440.png', '2982792.png', '1', '0'),
(54, 51, 'Government Jobs', 'Government Jobs', NULL, '6297879.png', '5259342.png', '1', '0'),
(55, 51, 'NGO Jobs', 'NGO Jobs', NULL, '7827044.png', '619120.png', '1', '0'),
(56, 51, 'Genaral Labour', 'Genaral Labour', NULL, '5243182.png', '9245600.png', '1', '0'),
(57, 0, 'Household', 'Household', NULL, '8758415.png', '3413421.png', '1', '0'),
(58, 57, 'Home Appliances', 'Home Appliances', NULL, '3547250.png', '7569730.png', '1', '0'),
(59, 57, 'Kitchen', 'Kitchen', NULL, '6962333.png', '869584.png', '1', '0'),
(60, 57, 'Children Item', 'Children Item', NULL, '7577566.png', '3037392.png', '1', '0'),
(61, 57, 'Others', 'Others', NULL, '7180424.png', '9128881.png', '1', '0'),
(62, 0, 'Books & Magazine', 'Books & Magazine', NULL, '1471639.png', '6890268.png', '1', '0'),
(63, 62, 'Fashion', 'Fashion', NULL, '7597669.png', '4915779.png', '1', '0'),
(64, 62, 'Design', 'Design', NULL, '7708691.png', '8877642.png', '1', '0'),
(65, 62, 'Poems & Rhymes', 'Poems & Rhymes', NULL, '4465896.png', '2451988.png', '1', '0'),
(66, 62, 'Documentary', 'Documentary', NULL, '3615519.png', '5262287.png', '1', '0'),
(67, 62, 'Historical', 'Historical', NULL, '5174300.png', '5285649.png', '1', '0'),
(68, 0, 'Service', 'Service', NULL, '7798144.png', '2017150.png', '1', '0'),
(69, 68, 'Financial', '\r\n    Financial', NULL, '1691495.png', '641169.png', '1', '0'),
(70, 68, 'Legal', 'Legal', NULL, '1787175.png', '8253237.png', '1', '0'),
(71, 68, 'Creative', 'Creative', NULL, '6391822.png', '3647254.png', '1', '0'),
(72, 68, 'Moving', 'Moving', NULL, '9520930.png', '7545490.png', '1', '0'),
(73, 68, 'Photography', 'Photography', NULL, '8196603.png', '8324238.png', '1', '0'),
(74, 0, 'Sports And Games', 'Sports And Games', NULL, '8244661.png', '9413193.png', '1', '0'),
(75, 74, 'Men Sports', 'Men Sports', NULL, '8511940.png', '9955376.png', '1', '0'),
(76, 74, 'Baby Sports', 'Baby Sports', NULL, '5861059.png', '2868706.png', '1', '0'),
(77, 74, 'Women Sports', 'Women Sports', NULL, '4529804.png', '8861259.png', '1', '0'),
(78, 74, 'Extreme Sports', 'Extreme Sports', NULL, '4550929.png', '8797095.png', '1', '0'),
(79, 74, 'Accessories', 'Accessories', NULL, '724510.png', '9456471.png', '1', '0'),
(80, 12, 'table chair', 'table chair', NULL, '1963872.png', '9668283.png', '0', '0'),
(81, 13, 'house sofa', 'house sofa', NULL, '2888540.png', '9191887.png', '1', '0'),
(82, 10, 'comericial property', 'comercial property', NULL, '257228.png', '249239.png', '1', '0'),
(83, 82, 'buliding', 'building', NULL, '3408747.png', '3753868.png', '1', '0'),
(84, 10, 'private property', 'private', NULL, '5165054.png', '5200802.png', '1', '0'),
(85, 84, 'private bulding', 'private', NULL, '9684859.png', '7512099.png', '1', '0'),
(86, 22, 'test', 'test', NULL, '5008947.png', '9026991.png', '1', '0'),
(87, 86, 'application', 'application', NULL, '9128565.png', '7059492.png', '1', '0'),
(88, 34, 'truck', 'trucks', NULL, '9394317.png', '9527930.png', '1', '0'),
(89, 36, 'bajaj', 'bajaj', NULL, '8829401.png', '2354989.png', '1', '0'),
(90, 37, 'taxi', 'taxi', NULL, '7028055.png', '6464962.png', '1', '0'),
(91, 40, 'commercial bulding', 'commercial', NULL, '5365264.png', '5228675.png', '1', '0'),
(92, 42, 'sony', 'sony', NULL, '9248727.png', '3274228.png', '1', '0'),
(93, 52, 'banking', 'banking', NULL, '9154871.png', '1457970.png', '1', '0'),
(94, 53, 'data entry', 'data entry', NULL, '7325798.png', '1520342.png', '1', '0'),
(95, 58, 'fridge', 'fridge', NULL, '3866104.png', '9401227.png', '1', '0'),
(96, 59, 'utensil', 'utensil', NULL, '4012913.png', '4366510.png', '1', '0'),
(97, 63, 'book', 'book', NULL, '8557321.png', '1876789.png', '1', '0'),
(98, 64, 'dress', 'dress', NULL, '1010632.png', '5617641.png', '1', '0'),
(99, 69, 'banking', 'banking', NULL, '5078844.png', '905340.png', '1', '0'),
(100, 67, 'city', 'city', NULL, '5571960.png', '2922641.png', '1', '0'),
(101, 70, 'laws', 'laws', NULL, '5158927.png', '268483.png', '1', '0'),
(102, 75, 'shoes', 'shoes', NULL, '8354183.png', '6191369.png', '1', '0'),
(103, 76, 'sliper', 'sliper', NULL, '6016884.png', '8553667.png', '1', '0'),
(104, 78, 'cycle', 'cylcle', NULL, '7076029.png', '4370753.png', '1', '0'),
(105, 10, 'public property', 'property', NULL, '', '8584352.png', '1', '0'),
(106, 5, 'test', 'test', NULL, '', '7475314.jpg', '1', '0'),
(107, 46, 'Lenovo', 'A Company Product', 'featured', '', '2396064.png', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_inquiries`
--

CREATE TABLE IF NOT EXISTS `tbl_contact_inquiries` (
  `contact_id` int(11) NOT NULL,
  `addlisting_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `type_of_business` varchar(50) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `message` text NOT NULL,
  `date_time` datetime NOT NULL,
  `seen_status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contact_inquiries`
--

INSERT INTO `tbl_contact_inquiries` (`contact_id`, `addlisting_id`, `user_id`, `name`, `email`, `subject`, `type_of_business`, `mobile_no`, `message`, `date_time`, `seen_status`) VALUES
(17, 1, 10, 'testing', 'testing@com.in', 'qwerty', '', '9876543210', 'poiuytrewq', '2017-05-01 17:05:22', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_us`
--

CREATE TABLE IF NOT EXISTS `tbl_contact_us` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `type_of_business` varchar(50) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `message` text NOT NULL,
  `date_time` datetime NOT NULL,
  `seen_status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contact_us`
--

INSERT INTO `tbl_contact_us` (`contact_id`, `name`, `email`, `subject`, `type_of_business`, `mobile_no`, `message`, `date_time`, `seen_status`) VALUES
(13, 'testing', 'testing@gmail.com', 'subject', '', '9876543210', 'message', '2017-04-29 17:04:59', '0'),
(12, 'Deepak', 'deepak@gmail.com', 'subject', '', '9876543210', 'message', '2017-04-29 17:04:11', '0'),
(14, 'Ankit', 'ankitaa@webwingtechnologies.com', '', '', '', 'test', '2017-04-29 18:04:10', '0'),
(26, 'tushar', 'tushara@webwingtechnologies.com', '', '', '', 'test', '2017-05-01 12:05:24', '0'),
(16, 'ankit', 'ankitaa@webwingtechnologies.com', '', '', '', 'test\r\n', '2017-04-29 18:04:23', '0'),
(27, 'deepak', 'deepaks@webwingtechno', '', '', '', 'test', '2017-05-01 12:05:57', '0'),
(28, 'deepak', 'seemaj@webwingtechnologies', '', '', '', 'test', '2017-05-01 12:05:59', '0'),
(29, '', '', '', '', '', '', '2017-05-01 12:05:05', '0'),
(30, '', '', '', '', '', '', '2017-05-01 12:05:23', '0'),
(31, 'a', 'seemaj@webwingtechnologies.com', '', '', '', 'test', '2017-05-01 12:05:45', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country_master`
--

CREATE TABLE IF NOT EXISTS `tbl_country_master` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(200) NOT NULL,
  `country_description` text NOT NULL,
  `profile_image` varchar(100) NOT NULL,
  `country_status` enum('1','0') NOT NULL DEFAULT '1',
  `is_delete` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_country_master`
--

INSERT INTO `tbl_country_master` (`country_id`, `country_name`, `country_description`, `profile_image`, `country_status`, `is_delete`) VALUES
(1, 'Afghanistan', '', '', '1', '0'),
(2, 'Albania ', '', '', '1', '0'),
(3, 'Algeria ', '', '', '1', '0'),
(4, 'American Samoa ', '', '', '1', '0'),
(5, 'Andorra ', '', '', '1', '0'),
(6, 'Angola ', '', '', '1', '0'),
(7, 'Anguilla ', '', '', '1', '0'),
(8, 'Antigua & Barbuda ', '', '', '1', '0'),
(9, 'Argentina ', '', '', '1', '0'),
(10, 'Armenia ', '', '', '1', '0'),
(11, 'Aruba ', '', '', '1', '0'),
(12, 'Australia ', '', '', '1', '0'),
(13, 'Austria ', '', '', '1', '0'),
(14, 'Azerbaijan ', '', '', '1', '0'),
(15, 'Bahamas', '', '', '1', '0'),
(16, 'Bahrain ', '', '', '1', '0'),
(17, 'Bangladesh', '', '', '1', '0'),
(18, 'Barbados ', '', '', '1', '0'),
(19, 'Belarus ', '', '', '1', '0'),
(20, 'Belgium', '', '', '1', '0'),
(21, 'Belize ', '', '', '1', '0'),
(22, 'Benin ', '', '', '1', '0'),
(23, 'Bermuda ', '', '', '1', '0'),
(24, 'Bhutan ', '', '', '1', '0'),
(25, 'Bolivia ', '', '', '1', '0'),
(26, 'Bosnia & Herzegovina ', '', '', '1', '0'),
(27, 'Botswana ', '', '', '1', '0'),
(28, 'Brazil ', '', '', '1', '0'),
(29, 'British Virgin Is. ', '', '', '1', '0'),
(30, 'Brunei ', '', '', '1', '0'),
(31, 'Bulgaria', '', '', '1', '0'),
(32, 'Burkina Faso ', '', '', '1', '0'),
(33, 'Burma ', '', '', '1', '0'),
(34, 'Burundi ', '', '', '1', '0'),
(35, 'Cambodia', '', '', '1', '0'),
(36, 'Cameroon ', '', '', '1', '0'),
(37, 'Canada ', '', '', '1', '0'),
(38, 'Cape Verde ', '', '', '1', '0'),
(39, 'Cayman Islands ', '', '', '1', '0'),
(40, 'Central African Rep. ', '', '', '1', '0'),
(41, 'Chad ', '', '', '1', '0'),
(42, 'Chile ', '', '', '1', '0'),
(43, 'China ', '', '', '1', '0'),
(44, 'Colombia ', '', '', '1', '0'),
(45, 'Comoros ', '', '', '1', '0'),
(46, 'Congo, Dem. Rep. ', '', '', '1', '0'),
(47, 'Congo, Repub', '', '', '1', '0'),
(48, 'Cook Islands ', '', '', '1', '0'),
(49, 'Costa Rica ', '', '', '1', '0'),
(50, 'Cote d''Ivoire ', '', '', '1', '0'),
(51, 'Croatia ', '', '', '1', '0'),
(52, 'Cuba ', '', '', '1', '0'),
(53, 'Cyprus ', '', '', '1', '0'),
(54, 'Czech Republic ', '', '', '1', '0'),
(55, 'Denmark ', '', '', '1', '0'),
(56, 'Djibouti ', '', '', '1', '0'),
(57, 'Dominica ', '', '', '1', '0'),
(58, 'Dominican Republic ', '', '', '1', '0'),
(59, 'East Timor ', '', '', '1', '0'),
(60, 'Ecuador ', '', '', '1', '0'),
(61, 'Egypt ', '', '', '1', '0'),
(62, 'El Salvador ', '', '', '1', '0'),
(63, 'Equatorial Guinea ', '', '', '1', '0'),
(64, 'Eritrea ', '', '', '1', '0'),
(65, 'Estonia ', '', '', '1', '0'),
(66, 'Ethiopia ', '', '', '1', '0'),
(67, 'Finland ', '', '', '1', '0'),
(68, 'French Guiana ', '', '', '1', '0'),
(69, 'French Polynesia ', '', '', '1', '0'),
(70, 'Gabon ', '', '', '1', '0'),
(71, 'Gambia, The ', '', '', '1', '0'),
(72, 'Gaza Strip ', '', '', '1', '0'),
(73, 'Georgia ', '', '', '1', '0'),
(74, 'Ghana ', '', '', '1', '0'),
(75, 'Gibraltar ', '', '', '1', '0'),
(76, 'Greece ', '', '', '1', '0'),
(77, 'Greenland ', '', '', '1', '0'),
(78, 'Grenada ', '', '', '1', '0'),
(79, 'Guadeloupe ', '', '', '1', '0'),
(80, 'Guam ', '', '', '1', '0'),
(81, 'Guatemala ', '', '', '1', '0'),
(82, 'Guernsey ', '', '', '1', '0'),
(83, 'Guinea ', '', '', '1', '0'),
(84, 'Guinea-Bissau ', '', '', '1', '0'),
(85, 'Guyana ', '', '', '1', '0'),
(86, 'Haiti ', '', '', '1', '0'),
(87, 'Honduras ', '', '', '1', '0'),
(88, 'Hong Kong ', '', '', '1', '0'),
(89, 'Hungary ', '', '', '1', '0'),
(90, 'Iceland ', '', '', '1', '0'),
(91, 'Indonesia ', '', '', '1', '0'),
(92, 'Iran ', '', '', '1', '0'),
(93, 'Iraq ', '', '', '1', '0'),
(94, 'Ireland ', '', '', '1', '0'),
(95, 'Isle of Man ', '', '', '1', '0'),
(96, 'Italy ', '', '', '1', '0'),
(97, 'Jamaica ', '', '', '1', '0'),
(98, 'Japan ', '', '', '1', '0'),
(99, 'Jersey ', '', '', '1', '0'),
(100, 'Jordan ', '', '', '1', '0'),
(101, 'Kazakhstan ', '', '', '1', '0'),
(102, 'Kenya ', '', '', '1', '0'),
(103, 'Kiribati ', '', '', '1', '0'),
(104, 'Korea, North ', '', '', '1', '0'),
(105, 'Korea, South ', '', '', '1', '0'),
(106, 'Kuwait ', '', '', '1', '0'),
(107, 'Kyrgyzstan ', '', '', '1', '0'),
(108, 'Laos ', '', '', '1', '0'),
(109, 'Latvia ', '', '', '1', '0'),
(110, 'Lebanon ', '', '', '1', '0'),
(111, 'Lesotho ', '', '', '1', '0'),
(112, 'Liberia ', '', '', '1', '0'),
(113, 'Libya ', '', '', '1', '0'),
(114, 'Liechtenstein ', '', '', '1', '0'),
(115, 'Lithuania ', '', '', '1', '0'),
(116, 'Luxembourg ', '', '', '1', '0'),
(117, 'Macau ', '', '', '1', '0'),
(118, 'Macedonia ', '', '', '1', '0'),
(119, 'Madagascar ', '', '', '1', '0'),
(120, 'Malawi ', '', '', '1', '0'),
(121, 'Maldives ', '', '', '1', '0'),
(122, 'Mali ', '', '', '1', '0'),
(123, 'Malta ', '', '', '1', '0'),
(124, 'Marshall Islands ', '', '', '1', '0'),
(125, 'Martinique ', '', '', '1', '0'),
(126, 'Mauritania ', '', '', '1', '0'),
(127, 'Mauritius ', '', '', '1', '0'),
(128, 'Mexico ', '', '', '1', '0'),
(129, 'Micronesia, Fed. St. ', '', '', '1', '0'),
(130, 'Moldova ', '', '', '1', '0'),
(131, 'Monaco ', '', '', '1', '0'),
(132, 'Mongolia ', '', '', '1', '0'),
(133, 'Montserrat ', '', '', '1', '0'),
(134, 'Morocco ', '', '', '1', '0'),
(135, 'Mozambique ', '', '', '1', '0'),
(136, 'Namibia ', '', '', '1', '0'),
(137, 'Nauru ', '', '', '1', '0'),
(138, 'Nepal ', '', '', '1', '0'),
(139, 'Netherlands ', '', '', '1', '0'),
(140, 'Netherlands Antilles ', '', '', '1', '0'),
(141, 'New Caledonia ', '', '', '1', '0'),
(142, 'New Zealand ', '', '', '1', '0'),
(143, 'Nicaragua ', '', '', '1', '0'),
(144, 'Niger ', '', '', '1', '0'),
(145, 'Nigeria ', '', '', '1', '0'),
(146, 'Norway ', '', '', '1', '0'),
(147, 'Oman ', '', '', '1', '0'),
(148, 'Pakistan ', '', '', '1', '0'),
(149, 'Palau ', '', '', '1', '0'),
(150, 'Panama ', '', '', '1', '0'),
(151, 'Papua New Guinea ', '', '', '1', '0'),
(152, 'Paraguay ', '', '', '1', '0'),
(153, 'Peru ', '', '', '1', '0'),
(154, 'Philippines ', '', '', '1', '0'),
(155, 'Poland ', '', '', '1', '0'),
(156, 'Portugal ', '', '', '1', '0'),
(157, 'Puerto Rico ', '', '', '1', '0'),
(158, 'Qatar ', '', '', '1', '0'),
(159, 'Reunion ', '', '', '1', '0'),
(160, 'Romania ', '', '', '1', '0'),
(161, 'Russia ', '', '', '1', '0'),
(162, 'Rwanda ', '', '', '1', '0'),
(163, 'Saint Helena ', '', '', '1', '0'),
(164, 'Saint Kitts & Nevis ', '', '', '1', '0'),
(165, 'Saint Lucia ', '', '', '1', '0'),
(166, 'St Pierre & Miquelon ', '', '', '1', '0'),
(167, 'Saint Vincent and the Grenadines ', '', '', '1', '0'),
(168, 'Samoa ', '', '', '1', '0'),
(169, 'San Marino ', '', '', '1', '0'),
(170, 'Sao Tome & Principe ', '', '', '1', '0'),
(171, 'Saudi Arabia ', '', '', '1', '0'),
(172, 'Senegal ', '', '', '1', '0'),
(173, 'Serbia ', '', '', '1', '0'),
(174, 'Seychelles ', '', '', '1', '0'),
(175, 'Sierra Leone ', '', '', '1', '0'),
(176, 'Slovakia ', '', '', '1', '0'),
(177, 'Slovenia ', '', '', '1', '0'),
(178, 'Solomon Islands ', '', '', '1', '0'),
(179, 'Somalia ', '', '', '1', '0'),
(180, 'South Africa ', '', '', '1', '0'),
(181, 'Spain ', '', '', '1', '0'),
(182, 'Sri Lanka ', '', '', '1', '0'),
(183, 'Sudan ', '', '', '1', '0'),
(184, 'Suriname ', '', '', '1', '0'),
(185, 'Swaziland ', '', '', '1', '0'),
(186, 'Sweden ', '', '', '1', '0'),
(187, 'Switzerland ', '', '', '1', '0'),
(188, 'Syria ', '', '', '1', '0'),
(189, 'Taiwan ', '', '', '1', '0'),
(190, 'Tajikistan ', '', '', '1', '0'),
(191, 'Tanzania ', '', '', '1', '0'),
(192, 'Thailand ', '', '', '1', '0'),
(193, 'Togo ', '', '', '1', '0'),
(194, 'Tonga ', '', '', '1', '0'),
(195, 'Trinidad & Tobago ', '', '', '1', '0'),
(196, 'Tunisia ', '', '', '1', '0'),
(197, 'Turkey ', '', '', '1', '0'),
(198, 'Turkmenistan ', '', '', '1', '0'),
(199, 'Turks & Caicos Is ', '', '', '1', '0'),
(200, 'Tuvalu ', '', '', '1', '0'),
(201, 'Uganda ', '', '', '1', '0'),
(202, 'Ukraine ', '', '', '1', '0'),
(203, 'Uruguay ', '', '', '1', '0'),
(204, 'Uzbekistan ', '', '', '1', '0'),
(205, 'Vanuatu ', '', '', '1', '0'),
(206, 'Venezuela ', '', '', '1', '0'),
(207, 'Vietnam ', '', '', '1', '0'),
(208, 'Virgin Islands ', '', '', '1', '0'),
(209, 'Wallis and Futuna ', '', '', '1', '0'),
(210, 'West Bank ', '', '', '1', '0'),
(211, 'Western Sahara ', '', '', '1', '0'),
(212, 'Yemen ', '', '', '1', '0'),
(213, 'Zambia ', '', '', '1', '0'),
(214, 'Zimbabwe ', '', '', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dynamic_pages`
--

CREATE TABLE IF NOT EXISTS `tbl_dynamic_pages` (
  `page_id` int(11) NOT NULL,
  `page_name` varchar(256) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `page_title` varchar(256) NOT NULL,
  `front_status` enum('0','1','2') NOT NULL DEFAULT '1',
  `page_description` longtext NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dynamic_pages`
--

INSERT INTO `tbl_dynamic_pages` (`page_id`, `page_name`, `slug`, `page_title`, `front_status`, `page_description`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(2, 'About Us', 'about-us', 'About Us', '1', '<p><span itemprop="articleBody">MyRoommate.me is specialized website to help people find bedspace, roommates and rooms in the UAE, and share apartments.&nbsp;</span></p>\r\n\r\n<p><span itemprop="articleBody">If you are a student, an employee, or a small family, MyRoommate.me&nbsp;&nbsp;can help you find what you need.We have customized it in such a way that it fits your requirements, whether it is a certain nationality, location, smoking preference, pets preference, or gender preference.</span></p>\r\n\r\n<p><span itemprop="articleBody">MyRoommate.me&nbsp;&nbsp;is a free website that does not require you to pay money for posting your ads, and will always be. It is a specialized site for rooms, roommates and bedspace, and it targets specifically those who are interested.</span></p>\r\n\r\n<p><span itemprop="articleBody">Hope you find what you are looking for with MyRoommate.me&nbsp;. If you do, please leave us a testimonial.</span></p>\r\n\r\n<p><span itemprop="articleBody">If you like MyRoommate.me&nbsp;&nbsp;to be a better website, please send us your suggestions and we will make sure to deliver.</span></p>\r\n', 'About Us', 'About Us', 'About Us'),
(3, 'How It Work', 'how-it-works', 'How It Work', '0', '<div class="page-head-block">\r\n<div class="page-head-overlay">&nbsp;</div>\r\n\r\n<div class="container">\r\n<div class="head-txt-block">How It Work</div>\r\n</div>\r\n</div>\r\n\r\n<div class="how-work">\r\n<div class="container">\r\n<div class="work-contant">Lorem ipsum dolor sit amet, option malorum lobortis et vim, te wisi dissentiet nam. Ad vix nobis scriptorem. Utroque legendos nec eu, qui paulo aliquip abhorreant eu, eu mel sanctus platonem. No possit possim vel, dictas gubergren vel te. No quo sale persequeris. Dicant molestie ex qui. Sed ei paulo oporteat reprehendunt, quaeque feugiat scribentur quo id.</div>\r\n\r\n<div class="how-it-work">\r\n<div class="work-image"><img alt="choose" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490880275_choose-icon.png" /></div>\r\n\r\n<div class="work-txt">\r\n<div class="work-head-title"><span>1.</span> For Buyers</div>\r\n\r\n<div class="work-sml-cont">\r\n<ul>\r\n	<li><span>Connect to sellers and add new contacts to your network</span></li>\r\n	<li><span>Post your needs at the Marketplace or in the Live market</span></li>\r\n	<li><span>Trade Live using our trading chat</span></li>\r\n</ul>\r\n</div>\r\n</div>\r\n\r\n<div class="clr">&nbsp;</div>\r\n</div>\r\n\r\n<div class="how-it-work find">\r\n<div class="work-image-left"><img alt="find" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490880322_find-what-image.png" /></div>\r\n\r\n<div class="work-txt">\r\n<div class="work-head-title"><span>2.</span> For Sellers</div>\r\n\r\n<div class="work-sml-cont">\r\n<ul>\r\n	<li><span>Connect to buyers and find new partners to buy your products</span></li>\r\n	<li><span>Update your profile with your available products or use the Live market to discover new market or business oportunities</span></li>\r\n	<li><span>Trade live using our trading chat</span></li>\r\n</ul>\r\n</div>\r\n</div>\r\n\r\n<div class="clr">&nbsp;</div>\r\n</div>\r\n</div>\r\n\r\n<div class="advanced-payment-block">\r\n<div class="overlay-block">&nbsp;</div>\r\n\r\n<div class="content-main-block">\r\n<div class="advanced-payment-head">Advanced Payments</div>\r\n\r\n<div class="steps-of-advanced">\r\n<div class="step-block-one">\r\n<div class="round-img-block"><img alt="" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490880363_payement-1.png" />\r\n<div class="count-block">1</div>\r\n</div>\r\n\r\n<div class="step-content-block">Buyer sends the<br />\r\nmoney</div>\r\n\r\n<div class="payament-arrow"><img alt="" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490880756_payement-arrow-img.png" style="width: 120px; height: 17px;" /></div>\r\n</div>\r\n\r\n<div class="step-block-one">\r\n<div class="round-img-block"><img alt="" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490880998_payement-2.png" />\r\n<div class="count-block">2</div>\r\n</div>\r\n\r\n<div class="step-content-block">Money holds at MERQANTIS<br />\r\nMONEYBOX</div>\r\n\r\n<div class="payament-arrow"><img alt="" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490880793_payement-arrow-img.png" style="width: 120px; height: 17px;" /></div>\r\n</div>\r\n\r\n<div class="step-block-one">\r\n<div class="round-img-block"><img alt="" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490881014_payement-3.png" />\r\n<div class="count-block">3</div>\r\n</div>\r\n\r\n<div class="step-content-block">Seller ships the<br />\r\nMerchandise</div>\r\n\r\n<div class="payament-arrow"><img alt="" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490880649_payement-arrow-img.png" style="width: 120px; height: 17px;" /></div>\r\n</div>\r\n\r\n<div class="step-block-one">\r\n<div class="round-img-block"><img alt="" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490880857_payement-4.png" style="width: 48px; height: 57px;" />\r\n<div class="count-block">4</div>\r\n</div>\r\n\r\n<div class="step-content-block">Buyer confirms reception<br />\r\nof goods</div>\r\n\r\n<div class="payament-arrow"><img alt="" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490880688_payement-arrow-img.png" style="width: 120px; height: 17px;" /></div>\r\n</div>\r\n\r\n<div class="step-block-one">\r\n<div class="round-img-block"><img alt="" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490880880_payement-5.png" style="width: 58px; height: 57px;" />\r\n<div class="count-block">5</div>\r\n</div>\r\n\r\n<div class="step-content-block">Moneybox unblock the<br />\r\nfunds to seller account</div>\r\n</div>\r\n</div>\r\n\r\n<div class="btn-password now"><button class="change-btn-pass get-start-now-block" type="button">Get Started Now</button></div>\r\n</div>\r\n</div>\r\n\r\n<div class="container">\r\n<div class="main-marketplace-block">\r\n<div class="advanced-payment-head head-marketplace">Marketplace</div>\r\n\r\n<div class="row">\r\n<div class="col-sm-6 col-md-3 col-lg-3">\r\n<div class="grid">\r\n<div class="effect-bubba"><img alt="img02" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490881054_marketplace-block-1.png" />\r\n<div class="bubba-effect-block">\r\n<h2>Market Network</h2>\r\n\r\n<p>Bubba likes to appear out of thin air.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="col-sm-6 col-md-3 col-lg-3">\r\n<div class="grid">\r\n<div class="effect-bubba"><img alt="img02" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490881065_marketplace-block-2.png" />\r\n<div class="bubba-effect-block">\r\n<h2>Business Development</h2>\r\n\r\n<p>Bubba likes to appear out of thin air.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="col-sm-6 col-md-3 col-lg-3">\r\n<div class="grid">\r\n<div class="effect-bubba"><img alt="img02" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490881076_marketplace-block-3.png" />\r\n<div class="bubba-effect-block">\r\n<h2>Customer Satisfaction</h2>\r\n\r\n<p>Bubba likes to appear out of thin air.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="col-sm-6 col-md-3 col-lg-3">\r\n<div class="grid">\r\n<div class="effect-bubba"><img alt="img02" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490881088_marketplace-block-4.png" />\r\n<div class="bubba-effect-block">\r\n<h2>Company Warehouse</h2>\r\n\r\n<p>Bubba likes to appear out of thin air.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="live-maket-main">\r\n<div class="advanced-payment-head head-marketplace">Live Market</div>\r\n\r\n<div class="row">\r\n<div class="col-sm-9 col-md-9 col-lg-9">\r\n<div class="live-market-img-main"><img alt="" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490881132_live-market-img.png" /></div>\r\n\r\n<div class="row">\r\n<div class="col-sm-7 col-md-7 col-lg-7">\r\n<div class="content-text-market">Market follow-up, online phone calls, live trading chat and interaction between users</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="col-sm-3 col-md-3 col-lg-3">\r\n<div class="live-market-conent">Meeting point for buyer and seller</div>\r\n\r\n<div class="img-diver"><img alt="" src="http://webwingdemo.com/node6/merqantis//uploads/editor_images/1490881157_marketplace-diver.png" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n', 'How It Work', 'How It Work', 'How It Work');
INSERT INTO `tbl_dynamic_pages` (`page_id`, `page_name`, `slug`, `page_title`, `front_status`, `page_description`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(4, 'Terms Of Use', 'terms-of-use', 'Terms Of Use', '0', '<div class="container">\n        <div class="testi-bx">\n            <h3> 1. Introduction</h3>\n            <p>\n               Welcome to Wellclik.com a website for finding and comparing wellness practitioners globally and a platform for connecting users and practitioners of wellness, health, fitness, holistic and similar services, and other services provided by parties listed on the website Wellclik.com (these services are referred to in these Terms of Use as "Services" and the providers of the Services are referred to as "Practitioners" and/or "Studios"). It gives you the opportunity to search for, find and contact services provided by Practitioners across the globe. It also provides a platform on which Registered Users (defined below) may purchase vouchers to avail of a Service. Wellclik.com and the facilities, services and materials available thereon (the "Website") is owned and operated by Wellclik Limited, an Irish registered company, number 592705 whose head office is at The LINC, Institute of Technology Blanchardstown, Blanchardstown Road North, Dublin 15, Ireland. For the purpose of these Terms of Use "we", "our" and "us" refers to Wellclik.com.\n            </p>\n\n            <h3> 2. Important Notice</h3>\n            <p>\n\n            1.Wellclik.com is not involved in the provision of any healthcare advice or diagnosis. Any information provided on the Website is intended as a guide only and should not be construed as a substitute for professional medical advice. The website is a service that displays information on Practitioners and/or Studios that has been gathered from the Healthcare Provider or the internet and which facilitate Registered Users purchasing Bookings and/or Vouchers. We do not screen or validate any content posted by Practitioners or Studios, nor do we endorse any particular Practitioner or Studio. \n            </p>\n            <p>\n              If you decide to engage a Practitioner to provide Services to you (including by purchasing a Booking and/or Voucher on our Website), you do so at your own risk. In this regard you should note that certain Practitioners or Studios listed on this Website are located in jurisdictions where insurance is not available or mandatory in respect of the services they offer. We would recommend that you undertake your own research into any Practitioner or Studio listed on the Website and that you should consult with your doctor or primary healthcare provider before engaging any Practitioner from this Website. You should be aware that the results of any search you perform on the Website for Practitioners or Studios should not be construed as endorsement by Wellclik.com. Where Practitioners ‘profile’ displays an ‘Accredited Badge’, this means we have checked with their certifying body that they are qualified by that certified body, but not that we endorse that Practitioner.\n            </p>\n            <h3>3. Services We Do Not Provide</h3>\n            <p>\n              1.Wellclik.com is not a medical referral service. We are not medical professionals nor do we present ourselves to be medical professionals and will not discuss or advise on any issues relating to medical treatment with Clients (defined below) or Practitioners.\n            </p>\n          <p>\n            2. Wellclik.com uses ‘Stripe’ for all transactions with Practitioners and Studios who use this Website. If you make a purchase, our only responsibility is to facilitate payment for the booking via Stripe. The responsibility for managing appointments and delivering the relevant services will be solely that of the relevant Practitioner or Studio on whose behalf we have facilitated the booking. We cannot assure that all transactions will be completed nor do we guarantee the ability or intent of any Practitioner or Studio to fulfil their obligations in any transactions.\n          </p>\n          <p>\n            3. As we cannot control the information provided by any Practitioner or Studio or information sourced by Wellclik.com from the Internet that is made available through this Website, Wellclik.com does not guarantee or endorse the quality, safety or legality of any Practitioner or Studio or the services provided or purported to be provided by any Practitioner or Studio, the accuracy of any listings or any Practitioner or Studio data we may provide to you, or the ability of any Practitioner and/or Studio to complete a transaction. Where Practitioners ‘profile’ displays an ‘Accredited Badge’, this means we have checked with their certifying body that they are qualified by that certified body, but not that we endorse that Practitioner. All matters in regard to their certification should be raised with the certifying body.\n\n          </p>\n            <h3>4. Services We Do Provide</h3>\n            <p>\n            1.Wellclik.com is a website for individuals seeking to access Wellness services ("Users", "Clients," "Your" or "You") and Practitioner and/or Studios situated around the world who want to provide Services. Wellclik.com facilitates introductions and bookings between Users and Practitioners and/or Studios through the Website.Wellclik.com also facilitates Registered Users purchasing Bookings and Vouchers for Services. Wellclik.com is not a provider of Services, and has no responsibility for managing appointments and/or delivering the Services, including where a Booking or Voucher has been purchased on the Website for any Services. You agree that if you purchase a Booking or Voucher through the Website, your contract for delivery of the Services is solely with the relevant Practitioner or Studio on whose behalf we have sold the Booking and/or Voucher, and not Wellclik.com, which is acting as an intermediary only in the sale. Specific terms and conditions relevant to purchasing a Booking and/or Voucher are set out at section 5 below.\n            </p>\n            <p>\n              2. Wellclik.com gathers information from various worldwide Practitioners and Studios about their facilities and services as well as from a large number of publicly available websites. You can access this information via our Website. This information should assist you in making a decision on choosing your preferred Practitioner or Studio whilst conducting your own research into such Practitioners or Studios. If you choose a Practitioner or Studio to provide services, then we will facilitate contact between you and the Practitioner and/or Studio, by providing your information to the Practitioner and/or Studio (the "Website Service"), facilitating a booking or providing you with the contact information of the Practitioner and/or Studio.\n            </p>\n            <p>\n              3.You may simply wish to browse through the Website to see what Wellclik.com has to offer. If this is the case, then only some of the provisions of these Terms of Use will be applicable to your use of the Website and other provisions will not be relevant.\n            </p>\n              <h3>5. Purchase of Bookings and/or Vouchers</h3>\n              <p>\n                1. If you wish to purchase a Booking and/or Voucher, you must create an account on the Website (and thereby become a "Registered User"), make a payment by credit or debit card, through your Stripe or PayPal account (or other payment mechanisms which we may provide from time to time) and agree to these Terms of Use. To become a Registered User, you must set up a personalised account with a password, give us certain personal information, such as your name, residential address, date of birth, e-mail address and mobile number, and agree to be bound by these Terms of Use. You may only set up one account with Wellclik.com and you may not create multiple accounts using different e-mail addresses.\n               \n              </p>\n               <p>\n                  2. Your completion of an order to purchase a Booking and/or Voucher represents your offer to purchase a Booking and/or Voucher on these Terms of Use, and must be accepted by Wellclik.com. Once an offer has been accepted by us, and purchase of the Booking and/or Voucher is complete we will email you a receipt and the Booking and/or Voucher will appear in your “Wellclik Wallet”. Your “Wellclik Wallet” represents an online record of all your bookings and/or vouchers purchased via Wellclik ltd. Wellclik.com is acting solely as an intermediary in the sale of Bookings and/or Vouchers and has no responsibility for any matters associated with the redemption of Bookings and/or Vouchers and/or the Services provided to you on redemption of Bookings and/or Vouchers, which are the sole responsibility of the relevant Practitioner and/or Studio.\n                </p>\n              <p>\n                3. By submitting an offer to purchase a Booking and/or Voucher you represent and warrant to us that you are at least eighteen years of age and resident in the Ireland or the United Kingdom and your purchase of the Voucher is for your personal, non-commercial use.\n              </p>\n              <p>\n                4. If we cannot process your offer to purchase a Booking and/or Voucher we will notify you, and (if we have taken payment for the Booking and/or Voucher via Stripe) we will refund you the price of the Booking and/or Voucher. The circumstances where your offer may not be accepted include the promotion no longer being available, or your payment not being authorised. You must provide payment in full to reserve your Booking and/or Voucher.\n              </p>\n              <p>\n                5. You may cancel your purchase of the Booking and/or Voucher within 24 hours in advance of the date of your intended redemption should you have not redeemed the Booking and/or Voucher during that time already. Partial refunds will not be given and monthly payments once billed are not eligible for cancellation or refund. Cancellations cannot be backdated.\n              </p>\n              <p>\n                6. Once you have purchased your Booking and/or Voucher, unless the relevant Practitioner and/or Studio allows otherwise, it may not be used in conjunction with any other offers and/or promotions of the Practitioner and/or Studio (whether such offers and/or promotions are made directly by the relevant Practitioner and/or Studio or through other third parties). Your redemption of the Booking and/or Voucher forms a separate contract between you and the relevant Practitioner and/or Studio for the Services and may be subject to the terms and conditions of the Practitioner and/or Studio.\n              </p>\n              <p>\n                7. You may not alter, reproduce or sell any Booking and/or Voucher. If you do any attempt to do so, we may, at our sole discretion, cancel the Voucher. Passes are valid for use by the named pass holder only and cannot be used by others.\n\n             </p>\n             <p>\n               8. Neither Wellclik.com, nor any Practitioner and/or Studio will have any responsibility to you for any lost or stolen Vouchers.\n             </p>\n             <p>\n               9. You agree that by becoming a Registered User and/or purchasing a Booking and/or Voucher we may send you emails with details of current promotions, your account activity, Booking and/or Vouchers purchased by you and/or updating you on policies, terms and conditions and similar matters relating to the Website. If you do not wish us to contact you for marketing purposes, you may notify us by following the "unsubscribe" links on email communications issued by us.\n             </p>\n             <p>\n               10. You agree by purchasing a Booking and/or Voucher from a Practitioner and/or Studio that Practitioner and/or Studio may send you emails and/or notifications via Wellclik Ltd with details of their own current promotions, upcoming events, video tutorials and/or podcasts and similar matters related to Bookings you have made with that Practitioners and/or Studio. If you do not wish the Practitioner and/or Studio to contact you for these purposes you may notify them directly.\n             </p>\n            <div class="career-list">\n             11. Subject to the additional Terms of Use set out at section 14 of these Terms of Use, by purchasing a Booking and/or Voucher you agree and acknowledge that:\n                <ul>\n                    <li><span><i class="fa fa-circle"></i></span> (a) Wellclik.com is acting merely as intermediary between you and the relevant Practitioner and/or Studio and our obligations are limited to processing payment for the Booking and/or Voucher via Stripe and sending you a notification of purchase; Wellclik.com gives no representations and/or warranties regarding the Services and has no responsibility or liability for any of the Services to be provided on redemption of the Booking and/or Voucher (including but not limited scheduling availability of the Practitioner and/or Studio); </li>\n                    <li><span><i class="fa fa-circle"></i></span>(b) The relevant Practitioner and/or Studio shall be solely responsible for all loss, liability, damages, costs, claims, injuries and/or illnesses suffered by you, caused in whole or in part by the relevant Practitioner and/or Studio and/or resulting from the relevant Services rendered on redemption of a Booking and/or Voucher; </li>\n                    <li><span><i class="fa fa-circle"></i></span>(c) Your remedies against Wellclik,com are limited to breach of contract of these Terms of Use;</li>\n                    <li><span><i class="fa fa-circle"></i></span>(d) The liability of Wellclik.com to you for any loss shall not in any circumstances exceed the of the price of the Booking and/or Voucher.of the price of the Booking and/or Voucher.</li>\n                </ul>\n            </div>\n             <h3>6. Content Policy</h3>\n             <p>1. Wellclik.com acts as a passive conduit for the online distribution and publication of information submitted through the Website, and has no obligation to screen content or information in advance and is not responsible for screening or monitoring material posted by you or Practitioners and/or Studios. You are solely responsible for the content and information you provide to us to be published on the Website through our data entry forms or otherwise. We reserve the right to edit or remove your content if we believe it is untrue or that it may create liability for us.</p>\n             <p>2. You acknowledge we may publish your reviews of Practitioners and/or Studios for the services provided to you by Practitioners and/or Studios either on the Website or on associated or linked websites and you consent to the unrestricted publication of such reviews. When posting a review of a Practitioner and/or Studio to Wellclik.com you must abide by current review policies which include:</p>\n             \n             <div class="career-list">\n                <ul>\n                    <li><span><i class="fa fa-circle"></i></span>Review cannot be defamatory  </li>\n                    <li><span><i class="fa fa-circle"></i></span>Review must be family friendly (no profanity, etc.)</li>\n                    <li><span><i class="fa fa-circle"></i></span>No hearsay. You cannot make a statement about what someone else has said.</li>\n                    <li><span><i class="fa fa-circle"></i></span>No personal insults</li>\n                    <li><span><i class="fa fa-circle"></i></span>No reports of criminal activity (these must be reported to the proper authority)</li>\n                    <li><span><i class="fa fa-circle"></i></span>Commercial information of any kind including email address or phone numbers</li>\n                    <li><span><i class="fa fa-circle"></i></span>Content not relevant to other potential customers</li>\n                    <li><span><i class="fa fa-circle"></i></span>Review must use standard email etiquette (not all CAPS, no HTML, etc.)</li>\n                    <li><span><i class="fa fa-circle"></i></span>We may choose to reject reviews where we cannot contact you by email or phone</li>\n                \n                </ul>\n            </div>\n            <p>3. Other terms of the content policy with regard to reviews and other user-provided text on the Website are covered in the review policy.</p>\n             <h3>7. Age and Responsibility</h3>\n            <p>1.You should note that the Website Service is only available to, and may only be used by individuals who are legally entitled to form such contracts under law in the jurisdiction in which they reside. If you are under the age of eighteen, you should not access and or use this Website or the Website Services or purchase (or attempt to purchase) any Booking and/or Voucher. By accessing and using this Website, you warrant that you are over the age of eighteen.</p>\n            <h3>8. Data Protection</h3>\n            <p>1.For the purpose of these Terms of Use "Data" means all electronic data or information, including personal data as defined in the Data Protection Acts, 1988 and 2003 (the "DP Acts") submitted by you onto the Website and transferred by Wellclik.com to the Practitioner and/or Studio, the processing of which is necessary to conclude the contract between you and the Practitioner and/or Studio. You recognise and acknowledge that in order to facilitate the provision of Services to you, we will need to provide certain details of your personal information, including any medical information you provide us with, to Practitioner and/or Studio whom you wish to arrange a consultation with. You explicitly consent to the transfer and disclosure of your personal information to such Practitioner and/or Studio even where such Practitioner and/or Studios are based in countries where protections for personal data are not as strong as those in Ireland under the DP Acts or in the European Union generally. We may also use your contact details, including your phone number and email address, to contact you from time to time to update you as to progress in relation to your consultation with a Practitioner and/or Studio and other matters concerning the Website Services. You consent to us contacting you in this regard.</p>\n            <p>2.Wellclik.com endeavours to protect your privacy and the privacy of others who access the Website and use its facilities. For full details of the manner in which Wellclik.com uses cookies, the type of information we collect, how we use it and further details concerning the circumstances upon which we disclose information, please read the Privacy Statement which is hereby incorporated into and forms part of these Terms of Use.</p>\n            <p>3.Wellclik.com operates servers outside of the European Union therefore you hereby agree to the transfer of personal data outside the European Union. By using this website, you agree to Wellclik.com holding and processing, both electronically and manually, personal data about you (including sensitive personal data as defined in the Data Protection Acts 1988-2003) for the operation, management, security and administration of Wellclik.com and complying with applicable laws, regulations and procedures, including transfer of personal data outside the European Union.</p>\n            \n            <p>4.Communication between you and a Practitioner and/or Studio via email may be sent through Wellclik.com. The content of these emails may be retained by Wellclik.com in order to assist Practitioner and/or Studios in tracking their communication.</p>\n            <p>5. By signing up to become a Registered User you agree that we may send you advertisements and/or promotional material by email, including information about Bookings and/or Vouchers you have purchased. If you do not wish us to contact you for marketing purposes, you may notify us by following the "unsubscribe" links on email communications issued by us.</p>\n            <h3>9. Provision of Information</h3>\n            <p>1. If you wish to arrange a consultation with a Practitioner and/or Studio, then you will be asked to provide certain information including details such as your contact details (phone number and email address), age and gender and some medical information to allow us to present your data to Practitioner and/or Studio who may be interested in providing Services to you. You warrant and undertake that the information provided by you is up-to-date, accurate in all material respects, not the confidential property of others or in violation of any third party''s rights, and is sufficient for us to facilitate the Website Services. Although Wellclik.com endeavours at all times to respect your privacy, you should not provide any information that may cause you personal damage if made public.</p>\n            <p>2.Information sent over the Internet cannot be guaranteed to be completely secure as it is subject to possible interception, loss or alteration. You understand and agree to assume the security risk for any information you provide using the Website. We are not responsible for any information sent over the Internet and will not be liable to you or anyone else for any damages or other loss incurred in connection with any information sent by you to us or to a Practitioner and/or Studio, or any information sent by us, a Practitioner and/or Studio or any third party to you over the internet.</p>\n            <h3>10. Suspension/ Termination</h3>\n            \n            <p>1.Wellclik.com may at any time, without notice to you, suspend or terminate your access to this Website, or any service forming part of this Website, wholly or partially, for any reason including, without limitation, where you have provided false or misleading information, or you are in breach of these Terms of Use, or if Wellclik.com cannot verify or authenticate any information submitted to the Website. Wellclik.com is not liable to you or any third party for any suspension or termination of access to this Website.</p>\n            <h3>11. Use of website</h3>\n            <p>1.You agree not to use this Website or any of its facilities and/or services for any purpose that is unlawful or prohibited by these Terms of Use including but not limited to:</p>\n            \n             <div class="career-list">\n                <ul>\n                    <li><span><i class="fa fa-circle"></i></span>(a). Any commercial purpose including but not limited to creating, checking, confirming, updating or amending your own or someone else''s databases, records, directories, customer lists, mailing or prospecting lists;  </li>\n                    <li><span><i class="fa fa-circle"></i></span>(b). Any purpose that is fraudulent, unlawful or prohibited by these Terms of Use;</li>\n                    <li><span><i class="fa fa-circle"></i></span>(c). Copying, modifying, transmitting, displaying, distributing, performing, reproducing, licensing, publishing, creating derivative works from, transferring or selling any information, software, products and services contained on or forming part of this Website, or otherwise using such content of the Website for resale, redistribution or for any other commercial use whatsoever including but not limited to any other website, surveys, contests or pyramid schemes.</li>\n                    <li><span><i class="fa fa-circle"></i></span>(d). Accessing or using the Website in and from jurisdictions which restricts or prohibits same by local law;</li>\n                     <li><span><i class="fa fa-circle"></i></span>(e). Accessing or using the Website in any manner which could damage, disable, overload, flood, mail bomb, crash or impair the Website or interfere with any other party''s use and/or enjoyment of the Website;  </li>\n                    <li><span><i class="fa fa-circle"></i></span>(f). Posting or transmitting, whether on a bulletin board, forum or otherwise, to or from the Website any unlawful, harassing, threatening, libellous, defamatory, tortious, obscene, hateful, scandalous, inflammatory, pornographic or profane material, or any other material that could give rise to any civil or criminal liability under law;</li>\n                    <li><span><i class="fa fa-circle"></i></span>(g). Transmitting material which may cause harm to Wellclik.com’s or any other party''s computer systems, including but not limited to any material which contains viruses, Trojan horses, worms, spyware, adware, time bombs, cancelbots or other computer programming routines or engines that are intended to damage, destroy or otherwise impair a computer''s functionality or the operation of the Website;</li>\n                    <li><span><i class="fa fa-circle"></i></span>(h). Harassing, harming or abusing another person, or contacting, advertising, soliciting, selling to any other person without their prior written consent or transmitting or relaying spam, junk email or chain letters;</li>\n                    <li><span><i class="fa fa-circle"></i></span>(i). Accessing data or materials not intended for your use; logging into a server or account which you are not authorised to access; attempting to probe, scan or test the vulnerability of a system or network or to breach security or authentication measures without proper authorisation; or impersonating any person or entity, or falsely stating or otherwise misrepresenting their identity or affiliation in any way;</li>\n                    <li><span><i class="fa fa-circle"></i></span>(j). Attempting to gain unauthorised access to the Website, or any computer systems or networks connected to any Wellclik.com website, through hacking, password miming or any other means; or</li>\n                    <li><span><i class="fa fa-circle"></i></span>(k). Harvesting or otherwise collecting by any means any programme material or information (including without limitation email address or details of other users) from the Website or monitoring, mirroring or copying any content of the Website without the prior written consent of Wellclik.com.</li>\n                    \n                </ul>\n            </div>\n            \n            <p>2.The pages contained in this Website may contain technical inaccuracies and typographical errors. The information on this Website may be updated from time to time but we do not accept any responsibility for keeping the information in these pages up-to-date, nor any liability for any failure to do so.</p>\n            <p>3.Wellclik.com reserves the right, at its sole discretion, to pursue all of its legal remedies upon breach by you of these Terms of Use, including but not limited to removal of your postings and content from this Website, closing your account and/or restricting your ability to access this Website and use the Website Services.</p>\n            <h3>12. Copyright Notice and Limited Licence</h3>\n            <p>1.The information, content, graphics, text, sounds, images, buttons, trademarks, service marks, get-up, business names, domain names, rights in good will, know-how, designs and rights in designs, trade names and logos (whether registered or unregistered) (the "Materials") contained in this Website are protected by copyright, trade mark, database right, sui generis right and other intellectual property laws and are also protected under national laws and international treaties. Wellclik.com and/or its licensors (as the case may be) retain all right, title, interest in and intellectual property rights to the Materials. Use of third party trademarks is for description and identification purposes only. Such trademarks are the registered trademarks of their registered owners. Wellclik.com asserts absolutely no ownership or other rights with respect to such third party trademarks.</p>\n            <p>2.Any other use of the Materials on this Website, including any form of copying or reproduction, modification, distribution, uploading, re-publication, extraction, re-utilisation, incorporation or integration with other Materials or works or re-delivery using framing technology, without the prior permission of Wellclik.com is strictly prohibited and is a violation of the proprietary rights of Wellclik.com. Other than as expressly provided herein, nothing in these Terms of Use should be construed as conferring, by implication or otherwise, any licence or right under any copyright, patent, trade mark, database right, sui generis right or other intellectual property or proprietary interest of Wellclik.com, its licensors or any third party.</p>\n            <p>3.You agree to grant Wellclik.com a non-exclusive, royalty free, world-wide, transferable perpetual licence, with the right to sub-licence, reproduce, distribute, transmit, create derivative works of, publicly display and publicly perform any Materials and other information, including without limitation ideas contained therein for new or improved services, when you submit to the Website either during the registration process or otherwise, including any information or materials you post to a bulletin board or evaluation forum on the website.</p>\n            <h3>13. Disclaimers</h3>\n            <p>1.This clause limits Wellclik.com''s legal liability to you for your access to and use of the Website. You should read this clause carefully. You acknowledge that you have agreed to these Terms of Use relying on the disclaimers stated herein and that those disclaimers are an essential basis of this contract.</p>\n            <p>2.The website is available to all users "as is" and, to the greatest extent permitted by applicable law, the website is made available without any representations or warranties of any kind, either express or implied. Wellclik.com makes no representations, warranties or undertakings about the services or materials available on the website, including without limitation, their merchantability, quality or fitness for a particular purpose. All information provided on the website is intended as a guide only and should not be construed as a substitute for professional medical advice and Wellclik.com makes no representations, warranties or undertakings as to the accuracy of any information provided on this website. Wellclik.com makes no representations, warranties or undertakings that the website, or the server that makes it available, will be free from defects, including, but not limited to viruses or other harmful elements. To the maximum extent permitted by applicable law, Wellclik.com accepts no liability for any infection by computer virus, bug, tampering, unauthorised access, intervention, alteration or use, fraud, theft, technical failure, error, omission, interruption, deletion, defect, delay, or any event or occurrence beyond the control of Wellclik.com, which corrupts or affects the administration, security, fairness and the integrity or proper conduct of any aspect of the Website. All use by you of the Website is at your own risk. You assume complete responsibility for, and all risk of loss resulting from, your downloading or using of, or referring to or relying on the facilities, services, materials or products provided on the Website, or any other information obtained from your use of the Website. You agree that, to the maximum extent permitted by applicable law, Wellclik.com and providers of telecommunications and network services to Wellclik.com will not be liable for damages arising out of your use or your inability to use the Website, and you hereby waive any and all claims with respect thereto, whether based on contract, tort or other grounds. No advice or information, whether oral or written, obtained by you from Wellclik.com shall be deemed to alter this disclaimer of warranty, or to create any warranty.</p>\n            <p>3.To the fullest extent permitted by applicable law, Wellclik.com assumes no responsibility nor do we grant any warranties, express or implied relating to the operation, safety, condition or service of any Practitioner and/or Studio or any healthcare professional that is used by, for or on behalf of, you. Wellclik.com is not liable for the acts, errors, omissions, representations, warranties, breaches or negligences of any Practitioner and/or Studio or any other persons associated with such Practitioner and/or Studio or for losses, damages or expenses resulting therefrom.</p>\n            <h3>14. Limitation of Liability</h3>\n            <p>1.To the fullest extent permitted by applicable law, neither Wellclik.com nor any of its officers, directors, employees, affiliates or other representatives will be liable for loss or damages arising out of or in connection with your use of any facilities, services and the website services offered or transactions entered into through or from this Website, including, for the avoidance of doubt, your transactions with Practitioner and/or Studio facilitated through this Website, including, but not limited to, direct, indirect or consequential losses or damages, loss of data, loss of income, profit or opportunity, loss of, or damage to, property and claims of third parties, even if Wellclik.com has been advised of the possibility of such loss or damages, or such loss or damages were reasonably foreseeable.</p>\n            <p>2.In no event shall Wellclik.com nor any of its officers, directors, employees, affiliates or other representatives be liable for any damages whatsoever resulting from the statements or conduct of any Practitioner and/or Studio or third party or the interruption, suspension or termination of the website services, whether such interruption, suspension or termination was justified or not, negligent or intentional, inadvertent or advertent.</p>\n            \n            <p>3.Without limiting the foregoing, under no circumstances shall Wellclik.com nor any of its officers, directors, employees, affiliates or other representatives be held liable for any delay or failure in performance of the website or the website services resulting directly or indirectly from acts of nature, forces or causes beyond its reasonable control, including, without limitation, internet failure, computer equipment failures, telecommunication failures, other equipment failures, electrical power failures, strikes, lay-way disputes, riots, interactions, civil disturbances, shortages of labour or materials, fires, floods, storms, explosions, acts of god, war, governmental actions, orders of domestic or foreign courts or tribunals or non-performance of third parties.</p>\n            <p>4.Wellclik.com does not exclude liability for death or personal injury, caused by its negligence or that of its employees or authorised representatives, or for fraud.</p>\n            <h3>15. Indemnity</h3>\n            <p>1.You agree to defend, indemnify and keep indemnified and hold Wellclik.com and, as applicable, its officers, directors, employees, affiliates or other representatives, harmless against any and all claims, proceedings, actions, costs, including legal costs, charges, expenses, damages, liabilities, losses and demands made by, or liabilities to, any third party resulting from any activities conducted under your account, your use or misuse of this Website, including but not limited to posting content on this Website, entering into transactions with Practitioner and/or Studio, contacting others as a result of their postings on this Website, infringing any third party''s intellectual property or other rights, or otherwise arising out of your breach or any breach of these terms of use.</p>\n            <h3>16. Links to Third Party Websites</h3>\n            <p>1.This Website contains links to third party websites. Your use of third party websites is subject to the terms and conditions of use contained within each of those websites. Access to any other website through this Website is at your own risk. Wellclik.com is not responsible for, nor liable for, the accuracy of any information, data, opinions, statements made on third party websites or the security of any link or communication with those websites. Wellclik.com reserves the right to terminate a link to a third party website at any time. The fact that Wellclik.com provides a link to a third party website does not mean that Wellclik.com endorses, authorises or sponsors that website, nor does it mean that Wellclik.com is affiliated with the third party websites, owners or sponsors. Wellclik.com provides these links merely as a convenience for those who use this Website.</p>\n            <h3>17. Availability</h3>\n            <p>1.Although Wellclik.com endeavours to ensure the Website is available at all times, there may be occasions when access to the Website may be interrupted, e.g. to allow maintenance, upgrades and emergency repairs to take place, or due to failure of telecommunications links and equipment that are beyond our control. You agree that Wellclik.com shall not be liable to you for any loss incurred by you resulting from the modification, suspension or discontinuance of the Website.</p>\n            <p>2.You have sole responsibility for adequate protection and back-up of any content and data you submit to the Website and for undertaking reasonable and appropriate precautions to scan for computer viruses or other destructive items.</p>\n            <h3>18. Changes in These Terms of Use</h3>\n            <p>1.Wellclik.com may modify or terminate any services offered through this website from time to time, for any reason and without notice, and without liability to you, any other client or any third party. Wellclik.com reserves the right to change the content, presentation, performance, user facilities and/or availability of any part of this Website, including these terms of use at its sole discretion from time to time. You should check these terms of use for any changes each time you access this Website. Your continued use of the Website and/or clicking on the "I accept" button will signify your acceptance of revised terms of use.</p>\n            <h3>19. Jurisdiction and Governing Law</h3>\n            <p>1.This Website is controlled and operated by Wellclik.com from Ireland. Wellclik.com does not make any representation that the facilities, services, including the website service, and/or materials offered through this Website are appropriate or suitable for use in countries other than Ireland, or that they comply with any legal or regulatory requirements in any other countries. In accessing this Website, you do so at your own risk and on your own initiative, and are responsible for compliance with local laws, to the extent any local laws are applicable. If it is prohibited to make this Website, facilities, services, including the website service, and/or materials offered through this Website or any part of them available in your country, or to you, whether by reason of nationality, residence or otherwise, this website, the facilities, services and/or materials offered through this website or any part of them are not directed at you.</p>\n            <p>2.These terms of use shall be governed by and construed in accordance with the laws of Ireland and you hereby agree, for the benefit of Wellclik.com, and without prejudice to the right of Wellclik.com to take proceedings in relation to these terms of use before any court of competent jurisdiction and that courts of Ireland shall have jurisdiction to hear and determine any actions or proceedings that may arise out of or in connection with these terms of use, and for such purposes you irrevocably submit to the jurisdiction of such courts.</p>\n            <p>3.The language of any dispute resolution procedure or any proceedings under these terms of use will be English.</p>\n            <h3>20. Miscellaneous</h3>\n            <p>1.Any waiver of any provision of these terms of use must be in writing and signed by Wellclik.com to be valid. Any waiver of any provision hereunder shall not operate as a waiver of any other provision, or a continuing waiver of any provision in the future. Each of the provisions of these terms of use is separate and severable and enforceable accordingly. If, at any time, any provision is judged by any court of competent jurisdiction to be void or unenforceable the validity, legality and enforceability of the remaining provisions shall not in any way be affected or impaired. Nothing in these terms of use shall constitute, or be deemed to constitute, a partnership between you and Wellclik.com, nor shall either party be deemed to be the agent of the other party. These terms of use represent the entire understanding and agreement between you and Wellclik.com relating to use of this website, its facilities and/or services, including the website service, and supersede any and all prior statements, understandings and agreements.</p>\n            <h3>Fees And Services</h3>\n            <p>In order to take payment online through Wellclik.com for your services, you must set up a merchant account that is linked to a payment gateway. Currently we integrated with Stripe, therefore you can create a Stripe account directly from your Wellclik profile.\nThere are standard fees applied to all online transactions by our payment gateway partners. For example, Stripe charge 1.4% + 25 cent per transaction for European cards (excluding VAT) for all transactions that are processed through their gateway. Stripe’s pricing can be found AT STRIPE.COM. Further, the Subscriber must maintain such Stripe Account to continue to use the Stripe Connect Platform integration.\nWellclik is a software as a service business and therefore charge a monthly subscription. We offer a free entry level plan for new customers for a duration of 30 days without payment processing.  Thereafter once payments are enabled a Practitioner is moved to a subscription plan. These subscription plans have varying levels of complexity, our fees for these are €45, €90 or €150 per month. View our pricing table for full details.\nIf you are accepting payment via Stripe merchant account you are the owner of the merchant account and are and are responsible for refunds. We help you improve communication with your client which limits the circumstances of refunds happening in the first place. However should a payment be disputed your Wellclik record can be used as evidence of a contact between you and your client. View Stripe dispute FAQ at stripe.com</p>\n            <p>Practitioners (Business’) are charged a monthly subscription fee. Wellcliks fees are subject to change, are incorporated into this Agreement by reference. Increase to the Features & Fees for Wellcliks services are effective after Wellclik provides you with at least thirty (30) days'' notice by posting the changes on the Site. However, Wellclik may choose to temporarily change the features and fees its services for promotional events; such changes are effective when Wellclik posts the temporary promotional event on the Site. Wellclik may decrease the fees as stated in the Features & Fees with no notice to you. Wellclik may, at its sole discretion, change some or all of Wellclik’s services at any time. In the event Wellclik introduces a new service, the fees for that service are effective at the launch of the new service. Unless otherwise stated, all fees are quoted in Euro (EUR).</p>\n            <p>Practitioners accounts must stay up-to-date with all fees owed or the account may be suspended until all outstanding fees are paid in full. In the event that a Practitioners business is inactive their profile will no longer show on site but the monthly subscription fee will still be debited from the Practitioners account until their account has been officially closed or downgraded. A Practitioners account can be closed or downgraded at any time and it is the responsibility of the Practitioner to manually terminate their business status from their My Account page.</p>\n            <p>You are responsible for paying all fees and applicable taxes associated with using Wellclik. Wellclik keeps accepted Practitioners payment information in accordance with its Privacy Policy. If fees are due to Wellclik then we will be invoice the seller for the amount due that month. This amount will be taken automatically by Wellclik from the seller’s registered Stripe account 2 working days later.</p>\n            <p>All fees are inclusive of VAT where applicable. In certain circumstances fees will not be subject to VAT but you may be liable to indirect taxes in your own country. Wellclik recommends that you research whether you are liable to declare such taxes to the relevant tax authorities. A valid VAT identification number is required from EU sellers who are VAT-registered. EU sellers are liable to notify ASOS Marketplace of any change in VAT status.\nFees and Termination: If Wellclik terminates a listing or your account, if you close your account, or if the payment of your Wellclik fees cannot be completed for any reason, you remain obligated to pay Wellclik for all unpaid fees plus any penalties, if applicable. If the Practitioners account is not paid in full, the Practitioner risks penalties such as the suspension of privileges, termination of the account and/or legal action. If you have a question or wish to dispute a charge, contact Wellclik.com</p>\n           <h3>2.Subscription</h3>\n            <p>Subject to the Subscriber paying the Subscriptions Fees, the restrictions set out and the other terms and conditions of this agreement, the Supplier hereby grants to the Subscriber a non-exclusive, non-transferable right to use the Services during the Subscription Term solely for the Subscriber''s business operations which includes publicly displaying information such as class and appointment schedules, products and services on the Subscriber’s website and on the Mobile Applications.</p>\n            <h4>The Subscriber shall not:</h4>\n            <p>except as may be allowed by any applicable law which is incapable of exclusion by agreement between the parties:\nand except to the extent expressly permitted under this agreement, attempt to copy, modify, duplicate, create derivative works from, frame, mirror, republish, download, display, transmit, or distribute all or any portion of the Software in any form or media or by any means; or\nattempt to reverse compile, disassemble, reverse engineer or otherwise reduce to human-perceivable form all or any part of the Software; or\naccess all or any part of the Services in order to build a product or service which competes with the Services; or\nlicense, sell, rent, lease, transfer, assign, distribute, display, disclose, or otherwise commercially exploit the Services or any part thereof.\nThe Subscriber shall use all reasonable endeavours to prevent any unauthorised access to, or use of, the Services and, in the event of any such unauthorised access or use, promptly notify the Supplier.</p>\n           <h4>Additional user subscriptions</h4>\n            <p>The Subscriber may, from time to time during any Subscription Term, purchase additional Subscriptions and the Supplier shall grant access to the Services to such additional users in accordance with the provisions of this agreement and at the price agreed between the Supplier and the Subscriber.</p>\n            <h4>Mobile Applications</h4>\n            <p>The Mobile Applications are included in the Services provided to the Subscriber under clause 2.\nThe Mobile Applications will be custom branded in accordance with the Subscriber’s instructions and the images and logos uploaded by the Subscriber via the User Website.\nThe Subscriber represents to the Supplier and unconditionally guarantees that any content, text, information, or graphics furnished to the Supplier for inclusion in the Mobile Applications are owned by the Subscriber, or that the Subscriber has permission from the rightful owner to use those elements, and will hold harmless, protect, and defend the Supplier and its subcontractors from any claim or suit arising from the use of such elements furnished by the Subscriber.\nAll content provided by the Subscriber, including textual and graphical content, will always remain the property of the Subscriber.\nFor the avoidance of any doubt and regardless of the custom branding of the Mobile Applications with the Subscriber’s branding, logos and trademarks, the Intellectual Property Rights in the Mobile Applications are, and at all times shall remain, the property of the Supplier (or the appropriate third-party rights-owner(s), if any).\nThe Supplier shall arrange for the publication of the Mobile Applications to the Apple App Store and the Google Play Store.</p>\n           <h3>2. Registration</h3>\n            <p>In order to register on the Wellclik.com site, you must live in the UK, Ireland, France, Germany, Netherlands or the USA.\nYou must be willing to provide personal information including (but not limited to) Your name, address, phone number and email address and this information must be factually correct.Wellclik will not take any responsibility for information which is false or misleading.\nWellclik requires that You update Your personal information if and when it changes from time to time.\nWellclik requires that all users of the Marketplace are over 18 years old.\nYou are responsible for maintaining the confidentiality of any passwords associated with Your account.\nYou are responsible for any activities under Your account. If You become aware of any unauthorised use of Your account You must notify Wellclik immediately via email at support@wellclik.com. \nYou must not transfer your account or passwords to another user. You may not have more than one account.\nTo register You must create a user identification ("Display Name") of Your own choice which will appear on the Wellclik.com site.</p>\n           <h4>Fees And Costs</h4>\n            <p>In order to take payment online through Wellclik.com for your services, you must set up a merchant account that is linked to a payment gateway. Currently we integrated with Stripe, therefore you can create a Stripe account directly from your Wellclik profile.\nThere are standard fees applied to all online transactions by our payment gateway partners. For example, Stripe charge 1.4% + 25 cent per transaction for European cards (excluding VAT) for all transactions that are processed through their gateway. Stripe’s pricing can be found AT STRIPE.COM. \nWellclik is a software as a service business and therefore charge a monthly subscription. We offer a free entry level plan for new customers for a duration of 30 days without payment processing.  Thereafter once payments are enabled a Practitioner is moved to a subscription plan. These subscription plans have varying levels of complexity, our fees for these are €45, €90 or €150 per month. View our pricing table for full details.\nIf you are accepting payment via Stripe merchant account you are the owner of the merchant account and are and are responsible for refunds. We help you improve communication with your client which limits the circumstances of refunds happening in the first place. However should a payment be disputed your Wellclik record can be used as evidence of a contact between you and your client. View Stripe dispute FAQ at stripe.com</p>\n            \n            <h4>Listing And Selling</h4>\n            <p>Listing Description: By listing an item on the Site you warrant that you and all aspects of the service comply with Wellcliks published policies. You also warrant that you may legally offer this service. You must accurately describe your service and all terms of sale in your listing. Your listings may only include text descriptions, pictures and other content relevant to the sale of that service. All services must be listed in an appropriate category with appropriate tags. You must not list a service more than once, unless the services listing has naturally expired. </p>\n            <p>Binding Sale: All sales are binding. The user is obligated to deliver appropriate payment for services purchased, unless there is an exceptional circumstance.</p>\n            <p>Fee Avoidance: The price stated in each service listing description must be an accurate representation of the sale. You may not alter the service price after a sale for the purpose of avoiding transaction fees, misrepresent the service location, or use another user''s account without permission. \nPromotional Codes: Practitioners may issue promotional codes for promotional purposes only and these are to be used against purchases from the issuing seller’s profile only. Promotional codes have no cash value and cannot be exchanged for money or credit. Sellers are expressly prohibited from selling promotional codes for their Profile, Wellclik service and/or the Wellclik website. If the Practitioner is found to be selling promotional codes this may constitute fee avoidance.\nBadge use: If a Seller would like to use the “Accredited Badge” badge to advertise and promote their listing on Wellclik, they will need Wellclik’s prior written permission to do so. Please contact your account manager for more information.</p>\n           <h3>2. Canceling an Order</h3>\n            <p>If you wish to cancel an order for a service on Wellclik.com you should contact the Practitioner directly immediately. Contract cancellations and returns are matters between the USER and PRACTITIONER. Wellclik is not a party to the sale or supply of any goods or services between the Practitioner and User.</p>\n            <p>2.2 You may not be able to cancel your service if it is within 6 hours of its time of occurrence. However, you may be entitled to a partial refund and if you wish to do so you should contact the Practitioner immediately upon cancellation.</p>\n            <p>2.3 You cannot cancel or receive a refund for a Service (including but not limited to training courses) if the proposed cancellation is to be made within 6 hours of the course or service commencing.</p>\n            <h4>Prohibited, Questionable And Infringing Items and Activities</h4>\n            \n            <p>You are solely responsible for your conduct and activities on and regarding to Wellclik.com and any and all data, text, information, usernames, graphics, images, photographs, profiles, audio, video, items, and links (together, "Content") that you submit, post, and display on Wellclik.com</p>\n            <h4>Copyright Policy.</h4>\n            <p>Restricted Activities: Your Content and your use of Wellclik:</p>\n            <div class="career-list">\n                <ul>\n                    <li><span><i class="fa fa-circle"></i></span>Must not be false, inaccurate or misleading</li>\n                   <li><span><i class="fa fa-circle"></i></span>Must not be fraudulent or involve the sale of illegal, counterfeit or stolen items</li>\n                   <li><span><i class="fa fa-circle"></i></span>Must not infringe upon any third-party''s copyright, patent, trademark, trade secret or other proprietary or intellectual property rights or rights of publicity or privacy (see also, ASOS Marketplace''s Copyright Policy)</li>\n                   <li><span><i class="fa fa-circle"></i></span>Must not breach this Agreement, any site policy or community guidelines, or any applicable law or regulation (including, but not limited to, those governing export control, consumer protection, unfair competition, anti-discrimination or false advertising)</li>\n                   <li><span><i class="fa fa-circle"></i></span>Must not contain items that have been identified as hazardous to consumers</li>\n                   <li><span><i class="fa fa-circle"></i></span>Must not be defamatory, libellous, unlawfully threatening, unlawfully harassing, impersonate or intimidate any person (including Wellclik staff or other users), or falsely state or otherwise misrepresent your affiliation with any person, through for example, the use of similar email address, nicknames, or creation of false account(s) or any other method or device</li>\n                   <li><span><i class="fa fa-circle"></i></span>Must not be obscene</li>\n                   <li><span><i class="fa fa-circle"></i></span>Must not contain or transmit any code of a destructive nature that may damage, interfere with, intercept or expropriate any system, data or personal information</li>\n                    <li><span><i class="fa fa-circle"></i></span>Must not modify, adapt or hack Wellclik.com or modify another website so as to falsely imply that it is associated with Wellclik.com;</li>\n                    <li><span><i class="fa fa-circle"></i></span>Must not link directly or indirectly, reference or contain descriptions of goods or services that are prohibited under this Agreement or other policy documents as posted on Wellclik.com. </li>\n                        \n                </ul>\n            </div>\n            <p>Furthermore, you must not list any item on Wellclik (or conclude any transaction that was initiated using Wellclik’s service) that could cause Wellclik to violate any applicable law, statute, ordinance or regulation, or that violates the Terms of Use.</p>\n            <h4>Content</h4>\n            \n            <p>License: Wellclik does not claim ownership rights in your Content. You grant Wellclik a license solely to enable Wellclik to use any information or Content you supply Wellclik with so that Wellclik is not violating any rights you might have in that Content. You grant Wellclik a non-exclusive, worldwide, perpetual, irrevocable, royalty-free, sublicensable (through multiple tiers) right to exercise the copyright, publicity, and database rights you have in the Content, in any media now known or not currently known, with respect to your Content. You agree to allow Wellclik to store or re-format your Content on Wellclik.com and display your Content on Wellclik.com in any way as Wellclik chooses. Wellclik will only use personal information in accordance with Wellclik’s Privacy Policy.</p>\n            <p>By uploading Content to Wellclik you promise that you own and/or have the right to use such Content in this manner and that such Content does not infringe any third party intellectual property rights. In the event that Wellclik receives a complaint in respect of any Content posted by you it shall be your sole responsibility to deal with such a complaint and to compensate Wellclik for any loss suffered. Wellclik reserves the right to remove any such Content immediately.\nAs part of a transaction, you may obtain personal information, including email address or phone number. Without obtaining prior permission from the other user, this personal information shall only be used for that transaction or for Wellclik-related communications. Wellclik has not granted you a license to use the information for unsolicited commercial messages. \nFor more information, see Wellclik’s Privacy Policy.\nBy uploading images to Wellclik, you agree that Wellclik has the right to use your images to promote Wellclik and/or your profile in any external press as well as across all Wellclik Websites and Wellclik social media channels.\nRe-Posting Content: By posting Content on Wellclik, it is possible for an outside website or a third party to re-post that Content. You agree to hold Wellclik harmless for any dispute concerning this use. If you choose to display your own Wellclik-hosted image on another website, the image must provide a link back to its listing page on Wellclik.com.</p>\n            <p>Idea Submissions: Wellclik considers any unsolicited suggestions, ideas, proposals or other material submitted to it by users via the Site or otherwise (other than the Content and the tangible items sold on the Site by users) (collectively, the "Material") to be non-confidential and non-proprietary, and Wellclik shall not be liable for the disclosure or use of such Material. If, at Wellclik’s request, any member sends Material to improve the site (for example to customer support), Wellclik will also consider that Material to be non-confidential and non-proprietary and will not be liable for use or disclosure of the Material. Any communication by you to Wellclik is subject to this Agreement. You hereby grant and agree to grant Wellclik, under all of your rights in the Material, a worldwide, non-exclusive, perpetual, irrevocable, royalty-free, fully-paid, sublicensable and transferable right and license to incorporate, use, publish and exploit such Material for any purpose whatsoever, commercial or otherwise, including but not limited to incorporating it in the systems, documentation, or any product or service, without compensation or accounting to you and without further recourse by you.</p>\n            <h3>Interactions with other users and private Messaging</h3>\n            \n            <p>Users are solely responsible for interactions with others. Users understand that Wellclik does not in any way screen its users. All users agree to exercise caution and good judgment in all interactions with others, particularly if meeting offline or in person.\nMessaging is your way to communicate privately with other Wellclik members. It’s essentially email, but purely for Wellclik members. Messages are primarily intended for communicating about transactions and services.</p>\n           <div class="career-list">\n                <ul>\n                    <li><span><i class="fa fa-circle"></i></span>You must not use Messages to send unsolicited advertising or promotions, request samples, loans, donations or "spam”. You must not pass on email addresses or any other information on to third parties.</li>\n                   <li><span><i class="fa fa-circle"></i></span>Spamming other Practitioners or Users in order to ask them to ‘follow’ your own profile will not be tolerated.</li>\n                   <li><span><i class="fa fa-circle"></i></span>Please use common sense when giving out personal information to others via messaging, for example don’t send someone your credit card details.</li>\n                   <li><span><i class="fa fa-circle"></i></span>You must not use messages to knowingly harass, threaten, blackmail or abuse another member.</li>\n                   <li><span><i class="fa fa-circle"></i></span>If someone explicitly tells you not to contact them, you must not use Messages to contact them again, unless you are involved in an open transaction.</li>\n                   <li><span><i class="fa fa-circle"></i></span>You must not use Messages to interfere with a transaction. This means…</li>\n                   <li><span><i class="fa fa-circle"></i></span>You must not contact another member to buy or sell an item listed on Wellclik outside of the Wellclik.com site. This may also constitute fee avoidance.</li>\n                   <li><span><i class="fa fa-circle"></i></span>You must not communicate with a member involved in an active or completed transaction to warn the member away from a particular Practitioner or service.</li>\n                </ul>\n            </div>\n            <p>As an anti-spam measure, sending too many messages too quickly may auto-disable your account. Contact  support@wellclik.com who will review account activity and enable your account if spam-free.</p>\n            <h3>Information Control</h3>\n           \n            <p>Wellclik does not control the Content provided by users that is made available on Wellclik. You may find some Content to be offensive, harmful, inaccurate, or deceptive. There are also risks of dealing with underage persons or people acting under false pretense.</p>\n            <p>Additionally, there may also be risks dealing with international trade. By using Wellclik, you agree to accept such risks and that Wellclik (and Wellclik''s officers, directors, agents, subsidiaries, joint ventures and employees) is not responsible for any acts or omissions of users on Wellclik. Please use caution, common sense, and practice safe buying and selling when using Wellclik.com.\nOther Resources: Wellclik is not responsible for the availability of outside websites or resources linked to or referenced on the Site. Wellclik is not responsible or liable for any content, advertising, products, or other materials on or available from such websites or resources. You agree that Wellclik shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with the use of or reliance on any such content, goods or services available on or through any such websites or resources or via pop ups which may appear when accessing the Site from your computer.</p>\n          \n           <h3>Resolution of Disputes and Release</h3>\n            <p>In the event a dispute arises between you and Wellclik.com, please contact Wellclik.com.\nFor transactions completed by Stripe: Wellclik will not make judgements regarding legal issues or claims and all disputes related to financial transactions will ultimately be determined by Stripe. Wellclik will only intervene when a Practitioner does resolve a financial transaction which they are rightfully obliged to, in line with these terms and conditions.</p>\n           \n           <h3>Terms</h3>\n            <p>Set Up Fees: the fees payable by the Subscriber to customise the software to the Subscriber’s specifications and the design of the Mobile Applications.\nServices: the software services provided by the Supplier to the Subscriber under this agreement via the User Website and the Mobile Applications. The services are identified in the invoice received by the Subscriber upon ordering the Services and is priced according to the particular features required by the Subscriber.\nSoftware: the software applications provided by the Supplier as part of the Services.\nSubscriber’s Customers: the individuals who purchase products and services from the Subscriber.\nSubscription Fees: the subscription fees payable by the Subscriber to the Supplier for the Services either annually or monthly.\nSubscription Term: being the Initial Subscription Term together with any subsequent Renewal Periods.</p>\n           <h4>Privacy Statement</h4>\n            <p>Wellclik Limited, respects and protects your right to privacy in relation to your interactions with this website. We have adopted the following policies to safeguard your personal information and to protect its confidentiality. Any information which is provided by you to wellclik.com via this website or otherwise will be treated in accordance with the terms of the Data Protection Acts 1988 and 2003 (the "Acts") and/or such amending or replacement legislation as may be adopted in Ireland from time to time. You should read this Privacy Statement carefully before using this website. If you do not read or if you disagree with any aspect of the Privacy Statement, you should not use this website. Your use of this website signifies your agreement to be bound by the terms of this Privacy Statement.</p>\n            <h4>Access by Minors</h4>\n            <p>If you are aged 18 or under, you should not use this website nor should you provide any personal information to us via the website.</p>\n            <h3>Collection and Use of Information</h3>\n            <h4>Information For Consumers</h4>\n            <p>Contacting Practitioner and/or Studios via our Website: If you are a consumer seeking to arrange a consultation with a Practitioner and/or Studios of healthcare, wellness, holistic and similar services and other parties listed on the website www.wellclik.com (a "Practitioner and/or Studio"), then you will be asked to provide certain personal information to us so that Practitioners and/or Studios who are registered with us can decide if they wish to offer services to you. Such information will include, without limitation, details such as your name, address, contact details (including email and telephone number) and relevant medical information. If you do not wish to provide your name to us, you may use an alias. If you wish to arrange a consultation with a Practitioner and/or Studio, then you acknowledge that we may provide all information that you have submitted to us via the website including any personal information to that Practitioner and/or Studio and you explicitly consent to such disclosure. This information may also include statistical information concerning your use of the Website.</p>\n            <p>Registered Users: Certain functions on our Website require you to set up an account and to become a registered user of our Website and requires you to give us details of your name, address, phone number, valid email address and certain other personal information. You may include other information to personalise your account, such as your gender and your reviews of Practitioner and/or Studio. You acknowledge and agree that information which is publicly available on your account (such as your user name, reviews and comments which you post on our Website) may become publicly available and used by third parties, and we have no obligations to you for any information which you made publicly available. You also explicitly consent to our processing your personal data and the transfer and disclosure of your personal information to Practitioner and/or Studio that are based in countries where protections for personal data are not as strong as those in Ireland under the Acts or in the European Union generally.</p>\n            <p>We use any personal information you provide to identify you as a prospective patient, to process your request for services, and to deliver relevant information about you to Practitioner and/or Studio and to facilitate consultations with Practitioner and/or Studio. We may also use your contact details, phone number and email address, to contact you from time to time to update you as to progress in relation to your consultation with a Practitioner and/or Studio and other matters concerning the service we provide. You consent to us contacting you in this regard. We will not sell your personal information to any third parties for marketing purposes without your consent.</p>\n            <p>We may from time to time transfer your data to one of our authorised service Practitioner and/or Studio for customer service or service quality purposes. We will ensure that our authorised service Practitioner and/or Studio process your information in a secure manner and in accordance with this Privacy Statement.</p>\n            <p>We may also receive anonymous data from third parties which, when combined with other data which we retain, may be capable of identifying you. This combined data will be safeguarded by us in the same way as other personal data as described in this Privacy Statement.</p>\n            <p>We may use the information you make available to us to send you details of promotions or offers. If you do not wish us to contact you for marketing purposes, you may notify us by following the "unsubscribe" links on email communications issued by us and/or contacting us directly at +353 (0)85 7558203</p>\n            <p>Apart from the information you provide us with during the course of our provision of Services to you, we may also collect and process the following data:\nWhen you contact us, we will keep a record of that correspondence;\nSite visit data, technical and statistical data. See the section on technical and statistical data later below.\nInformation we collect using cookies and/or selected third party websites. See the section on Cookies below.\nCommunication with Us, Practitioner and/or Studio, or other Users of our Services through comments, feedback and either private or public messaging on site services;</p>\n           <h3>Information For Practitioner and/or Studio</h3>\n            <p>If you are a Practitioner and/or Studio (or a representative of a Practitioner and/or Studio) who wishes to use wellclik.com’s online marketplace, then you will be asked to submit personal information as part of our registration process, for example, name, email address, phone number etc. This personal information will be used to facilitate medical consultations with prospective patients. You explicitly consent to the disclosure of all necessary personal information to prospective patients. Other than this authorised disclosure, wellclik.com will not release any personal information to any third parties without your prior consent except for the purposes of validating information or unless we reasonably believe that we are required to do so by operation of law. Wellclik.com retains the right at all times to contact you in relation to the services provided on this website.</p>\n            <p>We use any personal information you provide to identify you as a Practitioner and/or Studio, to process your registration, to verify credit or other charge card details, to process your credit card transactions and to deliver relevant information about you to prospective patients and to facilitate consultations with prospective patients. We will not give or sell your personal information to any third parties for marketing purposes without your consent.</p>\n            <p>You also acknowledge and agree that in certain circumstances we may be obliged to disclose personal information that you have provided to us to third parties, for example, to our credit card payment service provider, in order to conform to any requirements of law or to comply with any legal process, as well as to protect and defend our rights and/or the rights of prospective patients.</p>\n            <h3>General</h3>\n            <p>If at any time after giving us this information you decide that you no longer wish us to hold or use this information, or in the case that the information becomes out of date, you are free to notify us, and we will endeavour to remove or rectify the information promptly.\nWe do not collect or keep your personal data unless it is necessary for the purposes(s) set out in this Statement, nor do we keep your personal data for longer than is necessary.</p>\n           <h4>How we use your information</h4>\n            <p>Information collected is used by us in order to facilitate your enquiry to Practitioner and/or Studio listed on the site, and for any other purposes set out herein. This includes, in certain circumstances, the transfer of your information to our third party data processors who assist with the performance of certain Services or elements thereof. Your information may be processed in the following ways:</p>\n            <div class="career-list">\n                <ul>\n                   <li><span><i class="fa fa-circle"></i></span>for general account management</li>\n                   <li><span><i class="fa fa-circle"></i></span>to provide, monitor and improve our Services;</li>\n                   <li><span><i class="fa fa-circle"></i></span>to help identify you;</li>\n                   <li><span><i class="fa fa-circle"></i></span>to serve appropriate and tailored marketing material and content via SMS, email, phone, push notification, post or otherwise, in accordance with your marketing preferences;</li>\n                   <li><span><i class="fa fa-circle"></i></span>to help diagnose system problems and to administer our Website;</li>\n                   <li><span><i class="fa fa-circle"></i></span>to gather broad demographic information about you, such as determining your location in relation to the services that are most suitable for your needs;</li>\n                   <li><span><i class="fa fa-circle"></i></span>to carry out customer research, testing and analysis;</li>\n                   <li><span><i class="fa fa-circle"></i></span>to enable us to comply with any legal or regulatory requirements.</li>\n                </ul>\n            </div>\n            <h3>Sharing and Transfer of Information</h3>\n            <div class="career-list">\n                <ul>\n                    <li><span><i class="fa fa-circle"></i></span>a. Wellclik.com may share User or Practitioner and/or Studio information with trusted third parties to provide you with services you have indicated you are interested in, to increase site performance or to enhance the end-user experience.</li>\n                   <li><span><i class="fa fa-circle"></i></span>b. You also acknowledge and agree that in certain circumstances we may be obliged to disclose personal information that you have provided to us to third parties, including, but not limited to, any relevant regulator and law enforcement agencies for example, in order to conform to any requirements of law or to comply with any legal process, as well as to protect and defend our rights.</li>\n                   <li><span><i class="fa fa-circle"></i></span>c. Wellclik.com reserves the right to transfer information (including any personal information you provide) to a third party in the event of a sale, merger, liquidation, receivership or transfer of all or substantially all of the assets of Wellclik.com , a subsidiary or line of business associated with Wellclik.com.</li>\n                   <li><span><i class="fa fa-circle"></i></span>d. We may from time to time transfer your data to one of our authorised service providers for customer service, business management or for any of the purposes described herein. We will ensure that service providers process your information under strict contractual instruction, in a secure manner and in accordance with this Privacy Policy.</li>\n                </ul>\n            </div>\n            <h3>Links to Third Party Sites</h3>\n            <p>You should also be aware that where you link to another website from this website, that wellclik.com has no control over that other website. Accordingly, wellclik.com cannot guarantee that the controller of that website will respect your privacy in the same manner as Wellclik.com.</p>\n            <h3>Access to your Personal Information</h3>\n            <p>You have the right to request a copy of the information which we hold about you (for which we may charge you a small fee) and to have inaccuracies in your information corrected.</p>\n            <h3>Use of your Personal Information by Third Parties</h3>\n            <p>Except as otherwise set out in this Privacy Statement this policy only addresses the use and disclosure of information that wellclik.com collects from you. We cannot guarantee and accept no liability in the event that a Practitioner and/or Studio (if you are a consumer) or any other third party gives your personal data to third parties or in any way impinges upon your data protection or privacy rights.</p>\n            <h4>Technical and Statistical Data</h4>\n            <p>Due to the nature of the internet, we cannot guarantee the protection of your personal data and therefore we are not responsible for any loss or damage resulting to you when the website is used. You should be aware that each time you visit a website, two general levels of information about your visit can be retained. The first level comprises statistical and other analytical information collected on an aggregate and non-individual specific basis of all browsers who visit the website and the second is information which is personal or particular to a specific visitor who knowingly chooses to provide that information.\nThe statistical and analytical information provides us with a general and non-individual specific information about the number of people who visit this website; the number of people who return to the website; the pages that they visit; and where they were before they came to the website and the page in the website at which they exited. This information helps us monitor traffic on a website so that we can manage the website''s capacity and efficiency. This type of non-personal information and data can be collected through the standard operation for internet servers and logs as well as "cookies" and other technical mechanisms.</p>\n           <h4>IP Addresses and Cookies</h4>\n            <p>Like almost all commercial websites, Wellclik.com records statistical data and uses Cookies to improve site performance.</p>\n            <h4>Statistical data:</h4>\n            <p>The Wellclik.com site logs certain statistical data, such as IP address, the type of operating systems used and browser types used. This statistical data is not connected to personal information, and so user information is anonymous. For example, if we know that a growing number of users have a new type of browser, we know that it’s a good idea to test new pages and features in that browser.</p>\n            <h4>What are cookies?</h4>\n            <p>A Cookie allows websites to remember you, and it helps many of the features of the website to work better. We use Cookies to help our website load faster, and to make it easier and faster for users to log in. These small packets of information are stored on your computer by your browser. Cookies help us learn about how people interact with our site, and so we can make improvements based on the information.</p>\n            <h4>What kind of Cookies do we use?</h4>\n            <p>Our site uses two kinds of Cookies; our own, and Cookies from third parties. We use Cookies to operate and personalize the Wellclik.com. They help us to track page views and conversion and also return visits from users over a two year period.</p>\n            <h4>What third-party services do we use?</h4>\n            <p>‘Third parties’ are approved partner websites and those Cookies can be used for things like measurement and reporting, but may be also used to track your interests and to retarget you on other websites with advertising. We aim to be as transparent as possible around our use of Cookies, so we''ve listed all the third parties we work with below.\nGoogle Analytics is used to track general visitor interactions such as page views and conversion. We also use it for demographic and interest reporting and to understand our audience for remarketing purposes. We also use it to measure the success of marketing campaigns using Google Adwords and Bing Ads.</p>\n            <p>To learn more about Google''s data policy see here http://www.google.com/intl/en/policies/privacy/partners/. Google provides a tool to allow you to prevent your data from being used by Google Analytics. Click here https://tools.google.com/dlpage/gaoptout/ to download it.\nWe use AdRoll to track how you use the site to target ads to you on other websites. Information about how to opt out of AdRoll services can be found here https://help.adroll.com/hc/en-us/articles/203845070-How-do-I-opt-out-.\nWe use a Facebook Cookie for audience building and conversion tracking. Facebook''s Cookie policy can be found here https://www.facebook.com/help/cookies/</p>\n           <h3>How long do they last?</h3>\n            <p>Cookies generally have a ‘lifespan’ and after that period they expire. Some expire as soon as you log off, and some last for weeks or longer. Cookies on our site are renewed when you visit or log in, and usually expire after 7 to 30 days of inactivity. Cookies that we use to personalise the experience for returning visitors may have a lifespan of up to two years.</p>\n            <h3>Switching off cookies:</h3>\n            <p>Most web browsers automatically accept Cookies. Your browser should tell you how to turn off the automatic acceptance of Cookies if you look through settings. This will almost certainly create issues when using the Wellclik.com site. Unless you have adjusted your browser setting so that it will refuse all Cookies, our system will issue Cookies when you log on to our site. If you are concerned with 3rd party Cookies (other than our own) there is excellent advice available here: http://www.youronlinechoices.com/ie/</p>\n            <h3>Disclaimer</h3>\n            <p>Wellclik.com ITS DIRECTORS, EMPLOYEES, SERVANTS AND AGENTS, AFFILIATES OR OTHER REPRESENTATIVES AND THEIR RESPECTIVE PARENT AND SUBSIDIARY COMPANIES, SHALL NOT BE LIABLE IN RESPECT OF ANY CLAIMS, EMERGENCIES, DEMANDS, CAUSES OF ACTION, DAMAGES, LOSSES, EXPENSES, INCLUDING WITHOUT LIMITATION, REASONABLE LEGAL FEES AND COSTS OF PROCEEDINGS ARISING OUT OF OR IN CONNECTION WITH THE USE AND/OR DISSEMINATION OF PERSONAL INFORMATION RELATING TO YOU IN ACCORDANCE WITH THIS PRIVACY POLICY AND YOUR CONSENTS.</p>\n            <h4>Amendments</h4>\n            \n            <p>Wellclik.com reserves the right in its sole discretion to amend this privacy policy at any time, and you should regularly check this privacy policy for any amendments.</p>\n            <h4>Governing Law and Jurisdiction</h4>\n            <p>This Privacy Statement is governed by the laws of Ireland and you submit to the exclusive jurisdiction of the Irish courts.</p>\n          \n             \n            \n        </div>\n         </div>\n</div>', 'Terms Of Use', 'Terms Of Use', 'Terms Of Use');
INSERT INTO `tbl_dynamic_pages` (`page_id`, `page_name`, `slug`, `page_title`, `front_status`, `page_description`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(6, 'Learn', 'learn', 'Learn', '2', '<p>Learn</p>\r\n', 'Learn', 'Learn', 'Learn'),
(7, 'Lorem ipsum dolor sit ame', 'lorem-ipsum-dolor-sit-ame', 'Lorem ipsum dolor sit ame', '2', '<p><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif; font-size:12px">Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae&nbsp;Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae</span><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif; font-size:12px">Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae</span><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif; font-size:12px">Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae</span><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif; font-size:12px">Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae</span><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif; font-size:12px">Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae</span><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif; font-size:12px">Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae</span><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif; font-size:12px">Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae</span><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif; font-size:12px">Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae</span><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif; font-size:12px">Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae</span><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif; font-size:12px">Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitaeLorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae</span><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif; font-size:12px">Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae</span><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif; font-size:12px">Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae</span><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif; font-size:12px">Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae</span><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif; font-size:12px">Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae</span><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif; font-size:12px">Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae</span><span style="color:rgb(0, 0, 0); font-family:arial,helvetica,sans-serif; font-size:12px">Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae</span></p>\r\n', 'Lorem ipsum dolor sit ame Lorem ipsum dolor sit ame Lorem ipsum dolor sit ame', 'Lorem ipsum dolor sit ame', 'Lorem ipsum dolor sit ame'),
(8, 'Lorem Ipsum', 'lorem-ipsum', 'Lorem Ipsum', '2', '<p>Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae&amp;nbs...Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae&amp;nbs...Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae&amp;nbs...Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae&amp;nbs...Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae&amp;nbs...Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae&amp;nbs...Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae&amp;nbs...Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae&amp;nbs...</p>\n', 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Integer convallis libero lobortis ornare vulputate.Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae&nbs...', 'Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae&nbs...Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae&nbs...', 'Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae&nbs...Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae&nbs...Lorem ipsum dolor sit amet, convallis maecenas wisi mauris, lacus facilisis esse mollis in vitae&nbs...'),
(9, 'Connect with Us', 'connect-with-us', 'Connect with Us', '1', '<p>We regularly share wedding inspirations on our wedding blog, Pinterest and Instagram. If you want to talk to us, we are available on Facebook or just drop us an email at info@myroommate.com.</p>\r\n', 'Connect with Us', 'Connect with Us', 'Connect with Us');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_myfavorite`
--

CREATE TABLE IF NOT EXISTS `tbl_myfavorite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `addlisting_id` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_myfavorite`
--

INSERT INTO `tbl_myfavorite` (`id`, `user_id`, `addlisting_id`, `status`) VALUES
(1, 1, 1, '1'),
(2, 1, 2, '1'),
(3, 1, 29, '1'),
(4, 1, 68, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_newsletter_subscriber`
--

CREATE TABLE IF NOT EXISTS `tbl_newsletter_subscriber` (
  `sub_id` int(11) NOT NULL,
  `sub_email` varchar(128) NOT NULL,
  `is_sub_reg` enum('no','yes') NOT NULL,
  `sub_status` enum('1','0') NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_newsletter_subscriber`
--

INSERT INTO `tbl_newsletter_subscriber` (`sub_id`, `sub_email`, `is_sub_reg`, `sub_status`, `user_id`) VALUES
(1, 'tushara@webwingtechnologies.com', 'no', '1', 0),
(2, 'rahuls@webwingtechnologies.com', 'no', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_info`
--

CREATE TABLE IF NOT EXISTS `tbl_payment_info` (
  `id` int(11) NOT NULL,
  `paypal_username` varchar(255) NOT NULL,
  `paypal_api_key` varchar(255) NOT NULL,
  `paypal_password` varchar(255) NOT NULL,
  `sandbox_username` varchar(255) NOT NULL,
  `sandbox_api_key` varchar(255) NOT NULL,
  `sandbox_password` varchar(255) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_payment_info`
--

INSERT INTO `tbl_payment_info` (`id`, `paypal_username`, `paypal_api_key`, `paypal_password`, `sandbox_username`, `sandbox_api_key`, `sandbox_password`, `payment_mode`, `status`) VALUES
(1, 'accounts_api1.movit.com.au', 'AKQItHeV4iFwyQdPWyVr4cnDK2zxA1chJY9k6N6dq7neIlXylG9NRZDn', '58RTLQVEBGHSEHAR', 'seller_1328528795_biz_api1.gmail.com', 'AdwdBGIWQg1xwuI46PkE6bAmnLTRAwNM7efznbByMZLsCjiU1RwAcrvo', '1328528828', 'sandbox', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pricing_master`
--

CREATE TABLE IF NOT EXISTS `tbl_pricing_master` (
  `membership_id` int(11) NOT NULL,
  `pricing_name` varchar(200) NOT NULL,
  `membership_price` double(12,2) NOT NULL,
  `short_desc` varchar(1255) NOT NULL,
  `long_desc` varchar(1566) NOT NULL,
  `upload_qty` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pricing_master`
--

INSERT INTO `tbl_pricing_master` (`membership_id`, `pricing_name`, `membership_price`, `short_desc`, `long_desc`, `upload_qty`) VALUES
(1, '1 week', 10.00, '<p>test</p>\r\n', '', 0),
(2, '2 week', 15.00, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_residence_master`
--

CREATE TABLE IF NOT EXISTS `tbl_residence_master` (
  `residence_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `residence_name` varchar(200) NOT NULL,
  `residence_description` text NOT NULL,
  `residence_status` enum('1','0') NOT NULL,
  `is_delete` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_residence_master`
--

INSERT INTO `tbl_residence_master` (`residence_id`, `country_id`, `residence_name`, `residence_description`, `residence_status`, `is_delete`) VALUES
(1, 1, 'Afghanistan', '', '1', '0'),
(2, 12, 'Sydney ', '', '0', '0'),
(3, 12, 'Albury', '', '1', '0'),
(4, 12, 'Armidale', '', '1', '0'),
(5, 12, 'Blue Mountains', '', '1', '0'),
(6, 1, 'Kandahar', '', '1', '0'),
(7, 1, 'Herat', '', '1', '0'),
(8, 1, 'Kunduz', '', '1', '0'),
(9, 28, 'Sao Paulo', '', '1', '0'),
(10, 28, 'Rio de Janeiro', '', '1', '0'),
(11, 28, 'Salvador', '', '1', '0'),
(12, 37, 'Alberta', '', '1', '0'),
(13, 37, 'British Columbia', '', '1', '0'),
(14, 43, 'Beijing', '', '1', '0'),
(15, 43, 'Chongqing', '', '1', '0'),
(16, 43, 'Shanghai', '', '1', '0'),
(17, 91, 'Denpasar', '', '1', '0'),
(18, 91, '  Bandung', '', '1', '0'),
(19, 91, 'Banjar', '', '1', '0'),
(20, 88, 'Sha Tin', '', '1', '0'),
(21, 88, 'Tuen Mun New Town', '', '1', '0'),
(22, 91, 'Tai Po', '', '1', '0'),
(23, 61, 'Abnub', '', '1', '0'),
(24, 61, 'Abu Hummus', '', '1', '0'),
(25, 61, 'Abu Kebir', '', '1', '0'),
(26, 98, 'Nagoya', '', '1', '0'),
(27, 98, 'Toyohashi', '', '1', '0'),
(28, 98, 'Okazaki', '', '1', '0'),
(29, 92, 'Abadan', '', '1', '0'),
(30, 92, 'Abadeh', '', '1', '0'),
(31, 92, 'Abyek', '', '1', '0'),
(32, 93, 'Ad-Dawr', '', '1', '0'),
(33, 93, 'Afak', '', '1', '0'),
(34, 138, 'Kathmandu', '', '1', '0'),
(35, 138, 'Lalitpur', '', '1', '0'),
(36, 138, 'Biratnagar', '', '1', '0'),
(37, 106, 'Bayan', '', '1', '0'),
(38, 106, 'Hawalli', '', '1', '0'),
(39, 106, 'Sharq', '', '1', '0'),
(40, 187, 'Geneva', '', '1', '0'),
(41, 185, 'Basel', '', '1', '0'),
(42, 187, 'Lausanne', '', '1', '0'),
(43, 182, 'Colombo', '', '1', '0'),
(44, 182, 'Moratuwa', '', '1', '0'),
(45, 182, 'Kandy', '', '1', '0'),
(46, 102, 'Baragoi', '', '1', '0'),
(47, 102, 'Bungoma', '', '1', '0'),
(48, 102, 'Busia', '', '1', '0'),
(49, 127, 'Port Louis', '', '1', '0'),
(50, 127, 'Beau Bassin-Rose Hill', '', '1', '0'),
(51, 127, 'Curepipe', '', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_social`
--

CREATE TABLE IF NOT EXISTS `tbl_social` (
  `social_id` int(11) NOT NULL,
  `facebook_link` varchar(200) NOT NULL,
  `twitter_link` varchar(200) NOT NULL,
  `googleplus_link` varchar(200) NOT NULL,
  `youtube_link` varchar(200) NOT NULL,
  `pinterest_link` varchar(200) NOT NULL,
  `linkedin_link` varchar(200) NOT NULL,
  `instagram_link` varchar(200) NOT NULL,
  `secointile_link` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_social`
--

INSERT INTO `tbl_social` (`social_id`, `facebook_link`, `twitter_link`, `googleplus_link`, `youtube_link`, `pinterest_link`, `linkedin_link`, `instagram_link`, `secointile_link`) VALUES
(1, 'https://www.facebook.com/myroommateme', 'https://twitter.com/myroommateuae', 'https://plus.google.com/', 'https://www.youtube.com/', 'https://in.pinterest.com/', 'https://www.linkedin.com/', 'https://instagram.com/', 'http://secointile.houzz.com/');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory_master`
--

CREATE TABLE IF NOT EXISTS `tbl_subcategory_master` (
  `subcategory_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(200) NOT NULL,
  `subcategory_description` text NOT NULL,
  `subcategory_status` enum('1','0') NOT NULL,
  `is_delete` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subcategory_master`
--

INSERT INTO `tbl_subcategory_master` (`subcategory_id`, `category_id`, `subcategory_name`, `subcategory_description`, `subcategory_status`, `is_delete`) VALUES
(1, 2, 'Apple', '', '1', '0'),
(2, 2, 'Samsung', '', '1', '0'),
(3, 3, 'Ford', '', '1', '0'),
(4, 3, 'BMW', '', '1', '0'),
(5, 3, 'Audi', '', '1', '0'),
(6, 5, '3 BHK', '', '1', '0'),
(7, 5, '2 BHK', '', '1', '0'),
(8, 5, '1 BHK', '', '1', '0'),
(9, 2, 'Nokia', '', '0', '0'),
(10, 7, 'Don Quixote', '', '0', '0'),
(11, 7, 'Ulyesses', '', '0', '0'),
(12, 7, 'Hamlet', '', '0', '0'),
(13, 8, 'Audio System', '', '0', '0'),
(14, 8, 'Computer', '', '0', '0'),
(15, 1, 'Television', '', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_testimonials_master`
--

CREATE TABLE IF NOT EXISTS `tbl_testimonials_master` (
  `testimonials_id` int(10) NOT NULL,
  `testimonials_name_en` varchar(100) CHARACTER SET latin1 NOT NULL,
  `testimonials_added_by` varchar(128) NOT NULL,
  `testimonials_name_ar` varchar(255) NOT NULL,
  `testimonials_description_en` text CHARACTER SET latin1 NOT NULL,
  `testimonials_description_ar` text NOT NULL,
  `testimonials_img` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT 'noimage.jpg    ' COMMENT 'news Image Name only',
  `testimonials_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 - In Active/ 1 - Active / 2 - Deleted ',
  `testimonials_front_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 - Hide on Front/ 1- Shown on Front ',
  `testimonials_display_order` int(11) NOT NULL DEFAULT '0' COMMENT 'Front Display Order',
  `testimonials_added_date` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_testimonials_master`
--

INSERT INTO `tbl_testimonials_master` (`testimonials_id`, `testimonials_name_en`, `testimonials_added_by`, `testimonials_name_ar`, `testimonials_description_en`, `testimonials_description_ar`, `testimonials_img`, `testimonials_status`, `testimonials_front_status`, `testimonials_display_order`, `testimonials_added_date`) VALUES
(1, 'testimonials 1', 'testimonials 1', '', '<p>\r\n	testimonials1 testimonials1 testimonials1 testimonials1 testimonials1 testimonials1 testimonials1 testimonials1 testimonials1 testimonials1 testimonials1 testimonials1 testimonials1 testimonials1</p>', '', '4851440.jpg', 1, 1, 1, '2016-04-06 00:00:00'),
(2, 'testimonials2', 'testimonials2', '', '<p>\r\n	testimonials2 testimonials2 testimonials2 testimonials2 testimonials2 testimonials2 testimonials2 testimonials2 testimonials2 testimonials2 testimonials2 testimonials2 testimonials2 testimonials2</p>', '', '4851440.jpg', 1, 1, 1, '2016-04-06 00:00:00'),
(3, 'testimonials3', ' testimonials3', '', '<p>testimonials3 testimonials3 testimonials3 testimonials3 testimonials3 testimonials3 testimonials3 testimonials3 testimonials3 testimonials3 testimonials3 testimonials3 testimonials3 testimonials3</p>', '', '4851440.jpg', 1, 1, 1, '2016-04-06 00:00:00'),
(4, 'testimonials4', ' testimonials4', '', '<p>testimonials4 testimonials4 testimonials4 testimonials4 testimonials4 testimonials4 testimonials4 testimonials4 testimonials4 testimonials4 testimonials4 testimonials4 testimonials4 testimonials4</p>', '', '4851440.jpg', 1, 1, 1, '2016-04-06 00:00:00'),
(5, 'testimonials5', ' testimonials5', '', '<p>testimonials5 testimonials5 testimonials5 testimonials5 testimonials5 testimonials5 testimonials5 testimonials5 testimonials5 testimonials5 testimonials5 testimonials5 testimonials5 testimonials5</p>', '', '4851440.jpg', 1, 1, 1, '2016-04-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_master`
--

CREATE TABLE IF NOT EXISTS `tbl_user_master` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `mobile_number` text NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `countryofresidence` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `verification_status` enum('Verified','Unverified') NOT NULL,
  `status` enum('Block','Unblock','Delete') NOT NULL DEFAULT 'Unblock',
  `confirm_code` varchar(255) NOT NULL,
  `rating_avg` double(12,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_master`
--

INSERT INTO `tbl_user_master` (`id`, `firstname`, `lastname`, `gender`, `email`, `age`, `mobile_number`, `nationality`, `countryofresidence`, `address`, `password`, `created_date`, `update_date`, `verification_status`, `status`, `confirm_code`, `rating_avg`) VALUES
(1, 'Rahul', 'Shinde', 'male', 'rahuls@webwingtechnologies.com', 27, '9028072075', '12', '3', 'Dwaraka nashik', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2017-04-13 11:34:53', '2017-04-20 11:17:40', 'Verified', 'Unblock', 'd43d2dbde5bd1310418e532966aecdf98714e8bb', 0.00),
(8, '', '', '', 'tushara@webwingtechnologies.com', 0, '', '', '', '', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2017-04-24 10:04:36', '0000-00-00 00:00:00', 'Verified', 'Unblock', '', 0.00),
(9, 'Wissam', 'Baki', 'male', 'info@itessentials.me', 35, '0502648691', '12', '3', 'test', 'a41a9edbb1ed51baa2650b73c90e9b5ec4a114e1', '2017-04-24 16:04:27', '0000-00-00 00:00:00', 'Verified', 'Unblock', '', 0.00),
(10, '', '', '', 'adolf.rebelo@gmail.com', 0, '', '', '', '', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2017-04-25 07:04:13', '0000-00-00 00:00:00', 'Verified', 'Unblock', '', 0.00),
(11, '', '', '', 'rp7254653@gmail.com', 0, '', '', '', '', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2017-04-25 08:04:36', '0000-00-00 00:00:00', 'Verified', 'Unblock', '', 0.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_addlisting`
--
ALTER TABLE `tbl_addlisting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_addlisting_data`
--
ALTER TABLE `tbl_addlisting_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_addlisting_transection`
--
ALTER TABLE `tbl_addlisting_transection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_advertisement`
--
ALTER TABLE `tbl_advertisement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_attribute_master`
--
ALTER TABLE `tbl_attribute_master`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `tbl_blogscategory_master`
--
ALTER TABLE `tbl_blogscategory_master`
  ADD PRIMARY KEY (`blogscategory_id`);

--
-- Indexes for table `tbl_blogs_comments`
--
ALTER TABLE `tbl_blogs_comments`
  ADD PRIMARY KEY (`comm_id`);

--
-- Indexes for table `tbl_blogs_master`
--
ALTER TABLE `tbl_blogs_master`
  ADD PRIMARY KEY (`blogs_id`);

--
-- Indexes for table `tbl_category_form_fields`
--
ALTER TABLE `tbl_category_form_fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category_master`
--
ALTER TABLE `tbl_category_master`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_contact_inquiries`
--
ALTER TABLE `tbl_contact_inquiries`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tbl_contact_us`
--
ALTER TABLE `tbl_contact_us`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tbl_country_master`
--
ALTER TABLE `tbl_country_master`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `tbl_dynamic_pages`
--
ALTER TABLE `tbl_dynamic_pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `tbl_myfavorite`
--
ALTER TABLE `tbl_myfavorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_newsletter_subscriber`
--
ALTER TABLE `tbl_newsletter_subscriber`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `tbl_payment_info`
--
ALTER TABLE `tbl_payment_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pricing_master`
--
ALTER TABLE `tbl_pricing_master`
  ADD PRIMARY KEY (`membership_id`);

--
-- Indexes for table `tbl_residence_master`
--
ALTER TABLE `tbl_residence_master`
  ADD PRIMARY KEY (`residence_id`);

--
-- Indexes for table `tbl_social`
--
ALTER TABLE `tbl_social`
  ADD PRIMARY KEY (`social_id`);

--
-- Indexes for table `tbl_subcategory_master`
--
ALTER TABLE `tbl_subcategory_master`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `tbl_testimonials_master`
--
ALTER TABLE `tbl_testimonials_master`
  ADD PRIMARY KEY (`testimonials_id`);

--
-- Indexes for table `tbl_user_master`
--
ALTER TABLE `tbl_user_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_addlisting`
--
ALTER TABLE `tbl_addlisting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `tbl_addlisting_data`
--
ALTER TABLE `tbl_addlisting_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `tbl_addlisting_transection`
--
ALTER TABLE `tbl_addlisting_transection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tbl_advertisement`
--
ALTER TABLE `tbl_advertisement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_attribute_master`
--
ALTER TABLE `tbl_attribute_master`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `tbl_blogscategory_master`
--
ALTER TABLE `tbl_blogscategory_master`
  MODIFY `blogscategory_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_blogs_comments`
--
ALTER TABLE `tbl_blogs_comments`
  MODIFY `comm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_blogs_master`
--
ALTER TABLE `tbl_blogs_master`
  MODIFY `blogs_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_category_form_fields`
--
ALTER TABLE `tbl_category_form_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tbl_category_master`
--
ALTER TABLE `tbl_category_master`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `tbl_contact_inquiries`
--
ALTER TABLE `tbl_contact_inquiries`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_contact_us`
--
ALTER TABLE `tbl_contact_us`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `tbl_country_master`
--
ALTER TABLE `tbl_country_master`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=215;
--
-- AUTO_INCREMENT for table `tbl_dynamic_pages`
--
ALTER TABLE `tbl_dynamic_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_myfavorite`
--
ALTER TABLE `tbl_myfavorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_newsletter_subscriber`
--
ALTER TABLE `tbl_newsletter_subscriber`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_payment_info`
--
ALTER TABLE `tbl_payment_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_pricing_master`
--
ALTER TABLE `tbl_pricing_master`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_residence_master`
--
ALTER TABLE `tbl_residence_master`
  MODIFY `residence_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `tbl_social`
--
ALTER TABLE `tbl_social`
  MODIFY `social_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_subcategory_master`
--
ALTER TABLE `tbl_subcategory_master`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_testimonials_master`
--
ALTER TABLE `tbl_testimonials_master`
  MODIFY `testimonials_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_user_master`
--
ALTER TABLE `tbl_user_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
