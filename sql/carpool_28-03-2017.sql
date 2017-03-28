-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 28, 2017 at 01:43 PM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carpool`
--

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_active_rides_listings`
--

CREATE TABLE `shri_carpool_active_rides_listings` (
  `arl_id` bigint(20) NOT NULL,
  `driver_id` bigint(20) NOT NULL,
  `source` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_seats` enum('1','2','3','4','5','6') COLLATE utf8mb4_unicode_ci NOT NULL,
  `available_seats` enum('0','1','2','3','4','5','6') COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_travel` int(11) NOT NULL,
  `posted_on` datetime NOT NULL,
  `status` enum('available','completed','dispute','full','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'active/cancelled by driver',
  `src_state` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `src_country` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `src_city` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` int(11) NOT NULL,
  `driver_comments` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dest_city` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dest_state` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dest_country` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `landmark` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lock_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Store active drivers posts for rides';

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_active_rides_requests`
--

CREATE TABLE `shri_carpool_active_rides_requests` (
  `arr_id` bigint(20) NOT NULL,
  `driver_id` bigint(20) NOT NULL,
  `rider_id` bigint(20) NOT NULL,
  `arl_id` bigint(20) NOT NULL COMMENT 'active_ride_listing',
  `seats_requested` int(11) NOT NULL,
  `rider_status` enum('requested','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'requested',
  `driver_status` enum('accepted','pending','cancelled','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `requested_on` datetime NOT NULL,
  `responded_on` datetime NOT NULL,
  `source` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destination` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost_of_ride` double(10,2) NOT NULL,
  `src_state` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `src_country` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `src_city` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dest_state` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dest_city` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dest_country` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `landmark` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_status` enum('finished','pending') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Store requests made by riders and display to users and store confirmation of both parties.';

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_administration`
--

CREATE TABLE `shri_carpool_administration` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `registered_on` datetime NOT NULL,
  `is_deleted` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `last_login_ip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shri_carpool_administration`
--

INSERT INTO `shri_carpool_administration` (`id`, `email`, `first_name`, `last_name`, `mobile`, `password`, `profile_image`, `dob`, `registered_on`, `is_deleted`, `last_login_ip`, `last_login_on`) VALUES
(1, 'admin@carpool.com', 'Shrikrishna', 'Shanbhag', 9876543210, '0e7517141fb53f21ee439b355b5a1d0a', '', '1993-11-06', '2017-03-24 14:01:00', '0', '127.0.0.1', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_drivers_profile`
--

CREATE TABLE `shri_carpool_drivers_profile` (
  `driver_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `vehicle_number` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_make_id` bigint(20) NOT NULL,
  `vehicle_model_id` bigint(20) NOT NULL,
  `model_year` int(11) NOT NULL,
  `driver_license_front` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_license_back` int(11) NOT NULL,
  `is_validated` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'is id verified?',
  `vehicle_insurance` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='all drivers listed.';

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_drivers_reviews`
--

CREATE TABLE `shri_carpool_drivers_reviews` (
  `review_id` bigint(20) NOT NULL,
  `driver_id` bigint(20) NOT NULL,
  `rider_id` bigint(20) NOT NULL,
  `rating` int(11) NOT NULL,
  `comments` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reviewed_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Store driver reviews made by the riders.';

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_drivers_rider_disputes`
--

CREATE TABLE `shri_carpool_drivers_rider_disputes` (
  `dispute_id` bigint(20) NOT NULL,
  `driver_id` bigint(20) NOT NULL,
  `rider_id` bigint(20) NOT NULL,
  `driver_comments` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rider_comments` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arr_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_driver_cancellation_log`
--

CREATE TABLE `shri_carpool_driver_cancellation_log` (
  `dcl_id` bigint(20) NOT NULL,
  `driver_id` bigint(20) NOT NULL,
  `cancelled_on` datetime NOT NULL,
  `reason_for_cancellation` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_comments` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arl_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Rides cancelled by drivers are noted with proper details.';

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_driver_payment_log`
--

CREATE TABLE `shri_carpool_driver_payment_log` (
  `dpl_id` bigint(20) NOT NULL,
  `driver_id` bigint(20) NOT NULL,
  `transaction_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_paid` double(10,3) NOT NULL,
  `paid_on` datetime NOT NULL,
  `arr_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Store details of payments made to the driver.';

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_email_templates`
--

CREATE TABLE `shri_carpool_email_templates` (
  `template_id` bigint(20) NOT NULL,
  `email_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_mail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply_to` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shri_carpool_email_templates`
--

INSERT INTO `shri_carpool_email_templates` (`template_id`, `email_type`, `message`, `from_mail`, `reply_to`, `email`, `password`, `subject`, `tags`) VALUES
(1, 'password_recovery_mail', '<p> Dear {first_name},<br><br>\r\n\r\n This mail is in response to the request you created for password reset. Please click on the link below to reset your account password.<br><br>\r\n\r\n{reset_link} <br><br>\r\n\r\n Regards,<br>\r\n{company}</p>', 'support@carpool.com', 'support@carpool.com', 'shrikrishna.shanbhag@intecons.com', 'intecons.com', 'Carpool Account password recovery', '{first_name},{reset_link},{company}'),
(2, 'account_verification_mail', '<p> Dear {first_name},<br><br>\r\n\r\nYour account has been successfully created. Please click on the link below to activate your account.<br><br>\r\n\r\n{activation_link} <br><br>\r\n\r\nRegards,<br>\r\n{company}</p>', 'support@carpool.com', 'support@carpool.com', 'shrikrishna.shanbhag@intecons.com', 'Admin@123', 'Verify your email account', '{first_name},{activation_link},{company}');

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_faq`
--

CREATE TABLE `shri_carpool_faq` (
  `faq_id` int(11) NOT NULL,
  `question` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_payment_info`
--

CREATE TABLE `shri_carpool_payment_info` (
  `payer_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `account_id` bigint(20) NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `registered_on` datetime NOT NULL,
  `primary_method` enum('na','debit','credit','paypal','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `isset_debit_card` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `isset_credit_card` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `isset_paytm` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Store users payments details.';

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_pricing`
--

CREATE TABLE `shri_carpool_pricing` (
  `pricing_id` int(11) NOT NULL,
  `distance` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` enum('kms','miles') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'kms',
  `price` double(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Store prices for each type.';

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_riders_payment_log`
--

CREATE TABLE `shri_carpool_riders_payment_log` (
  `rpl_id` bigint(20) NOT NULL,
  `rider_id` bigint(20) NOT NULL,
  `transaction_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_paid` double(10,3) NOT NULL,
  `paid_on` datetime NOT NULL,
  `arr_id` bigint(20) NOT NULL COMMENT 'Refers table active_ride_requests'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Store details of payments received from rider.';

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_riders_profile`
--

CREATE TABLE `shri_carpool_riders_profile` (
  `rider_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `id_proof` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_validated` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='all riders.';

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_riders_refund_log`
--

CREATE TABLE `shri_carpool_riders_refund_log` (
  `rrl_id` bigint(20) NOT NULL,
  `rider_id` bigint(20) NOT NULL,
  `amount_refunded` double(10,3) NOT NULL,
  `transaction_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refunded_on` datetime NOT NULL,
  `arr_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Store any refund details';

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_rider_cancellation_log`
--

CREATE TABLE `shri_carpool_rider_cancellation_log` (
  `rcl_id` bigint(20) NOT NULL,
  `arr_id` bigint(20) NOT NULL,
  `refund_status` enum('na','pending','paid','processing') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '''''na''''',
  `cancelled_on` datetime NOT NULL,
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rpl_id` bigint(20) NOT NULL,
  `rrl_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='store cancelled requests made by riders from active_ride_requests';

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_rides_completed_archive`
--

CREATE TABLE `shri_carpool_rides_completed_archive` (
  `rca_id` bigint(20) NOT NULL,
  `arr_id` bigint(20) NOT NULL,
  `driver_id` bigint(20) NOT NULL,
  `rider_id` bigint(20) NOT NULL,
  `completed_on` datetime NOT NULL,
  `driver_status` enum('completed','dispute','resolved') COLLATE utf8mb4_unicode_ci NOT NULL,
  `rider_status` enum('completed','dispute','resolved') COLLATE utf8mb4_unicode_ci NOT NULL,
  `seats_requested` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='stores completed rides from active ride requests.';

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_users`
--

CREATE TABLE `shri_carpool_users` (
  `user_id` bigint(20) NOT NULL,
  `first_name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `city` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `registered_on` datetime NOT NULL,
  `email_verified` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `mobile_verified` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `sign_up_ip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login_on` datetime NOT NULL,
  `last_login_ip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unique_token` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_token` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp_token` int(11) NOT NULL,
  `recovery_token` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verification_expiry` datetime NOT NULL,
  `reset_expiry` datetime NOT NULL,
  `verification_sent_stamp` datetime NOT NULL,
  `reset_sent_stamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Stores users information';

--
-- Dumping data for table `shri_carpool_users`
--

INSERT INTO `shri_carpool_users` (`user_id`, `first_name`, `last_name`, `email`, `mobile`, `city`, `state`, `country`, `profile_image`, `gender`, `dob`, `password`, `is_deleted`, `registered_on`, `email_verified`, `mobile_verified`, `sign_up_ip`, `last_login_on`, `last_login_ip`, `unique_token`, `email_token`, `otp_token`, `recovery_token`, `verification_expiry`, `reset_expiry`, `verification_sent_stamp`, `reset_sent_stamp`) VALUES
(45, 'Shrikrishna', 'Shanbhag', 'shrikrishna.shanbhag@intecons.com', 9876543210, '', '', '', '', 'male', '1993-11-06', '0e7517141fb53f21ee439b355b5a1d0a', '0', '2017-03-24 12:03:00', '1', '0', '::1', '2017-03-27 03:03:40', '::1', '', '83cdcec08fbf90370fcf53bdd56604ff', 0, '__recovered__', '2017-03-27 17:41:41', '2017-03-27 17:39:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Shrikrishna', 'Shanbhag', 'shrikrishna.shanbhag+1@intecons.com', 9876543210, '', '', '', '', 'male', '1993-11-06', '0e7517141fb53f21ee439b355b5a1d0a', '0', '2017-03-27 03:03:51', '1', '0', '::1', '0000-00-00 00:00:00', '', '', 'ff49cc40a8890e6a60f40ff3026d2730', 0, '', '2017-03-27 17:41:41', '2017-03-27 17:39:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Shrikrishna', 'Shanbhag', 'shrikrishna.shanbhag+2@intecons.com', 9876543210, '', '', '', '', 'male', '1993-11-06', '0e7517141fb53f21ee439b355b5a1d0a', '0', '2017-03-27 03:03:34', '1', '0', '::1', '2017-03-27 04:03:10', '::1', '', 'e449b9317dad920c0dd5ad0a2a2d5e49', 0, '__recovered__', '2017-03-27 17:41:41', '2017-03-27 17:39:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Shrikrishna', 'Shanbhag', 'shrikrishna.shanbhag+3@intecons.com', 9876543210, '', '', '', '', 'male', '1993-11-06', '0e7517141fb53f21ee439b355b5a1d0a', '0', '2017-03-27 04:03:31', '1', '0', '::1', '2017-03-27 04:03:26', '::1', '', '09b15d48a1514d8209b192a8b8f34e48', 0, '', '2017-03-27 17:41:41', '2017-03-27 17:39:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Shrikrishna', 'Shanbhag', 'shrikrishna.shanbhag+4@intecons.com', 9876543210, '', '', '', '', 'male', '1993-11-06', '0e7517141fb53f21ee439b355b5a1d0a', '0', '2017-03-27 04:03:32', '1', '0', '::1', '2017-03-27 04:03:59', '::1', '', '70feb62b69f16e0238f741fab228fec2', 0, '', '2017-03-27 17:41:41', '2017-03-27 17:39:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Shrikrishna', 'Shanbhag', 'shrikrishna.shanbhag+5@intecons.com', 9876543210, '', '', '', '', 'male', '1993-11-06', '0e7517141fb53f21ee439b355b5a1d0a', '0', '2017-03-27 06:03:07', '0', '0', '::1', '0000-00-00 00:00:00', '', '', '2d1b2a5ff364606ff041650887723470', 0, '', '2017-03-27 19:10:30', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Shrikrishna', 'Shanbhag', 'shrikrishna.shanbhag+6@intecons.com', 9876543210, '', '', '', '', 'male', '1993-11-06', '0e7517141fb53f21ee439b355b5a1d0a', '0', '2017-03-27 07:03:04', '0', '0', '::1', '0000-00-00 00:00:00', '', '', '1f1baa5b8edac74eb4eaa329f14a0361', 0, '', '2017-03-27 07:03:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Shrikrishna', 'Shanbhag', 'shrikrishna.shanbhag+7@intecons.com', 9876543210, '', '', '', '', 'male', '1993-11-06', '0e7517141fb53f21ee439b355b5a1d0a', '0', '2017-03-27 19:17:07', '1', '0', '::1', '0000-00-00 00:00:00', '', '', '69a5b5995110b36a9a347898d97a610e', 0, '', '2017-03-27 19:17:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Shrikrishna', 'Shanbhag', 'shrikrishna.shanbhag+10@intecons.com', 9876543210, '', '', '', '', 'male', '1993-11-06', '0e7517141fb53f21ee439b355b5a1d0a', '0', '2017-03-27 19:34:26', '0', '0', '::1', '0000-00-00 00:00:00', '', '', 'b9f94c77652c9a76fc8a442748cd54bd', 0, '', '0000-00-00 00:00:00', '2017-03-27 20:34:26', '0000-00-00 00:00:00', '2017-03-27 19:34:26'),
(54, 'Shrikrishna', 'Shanbhag', 'shrikrishna.shanbhag+11@intecons.com', 9876543210, '', '', '', '', 'male', '1993-11-06', '0e7517141fb53f21ee439b355b5a1d0a', '0', '2017-03-27 19:37:02', '1', '0', '::1', '0000-00-00 00:00:00', '', '', 'f542eae1949358e25d8bfeefe5b199f1', 0, '', '2017-03-27 20:37:02', '0000-00-00 00:00:00', '2017-03-27 19:37:02', '0000-00-00 00:00:00'),
(55, 'Shrikrishna', 'Shanbhag', 'shrikrishna.shanbhag+12@intecons.com', 9876543210, '', '', '', '', 'male', '1993-11-06', '0e7517141fb53f21ee439b355b5a1d0a', '0', '2017-03-28 10:52:28', '1', '0', '::1', '0000-00-00 00:00:00', '', '', '38ca89564b2259401518960f7a06f94b', 0, '', '2017-03-28 11:52:28', '0000-00-00 00:00:00', '2017-03-28 10:52:28', '0000-00-00 00:00:00'),
(56, 'Shrikrishna', 'Shanbhag', 'shrikrishna.shanbhag+13@intecons.com', 9876543210, '', '', '', '', 'male', '1993-11-06', '0e7517141fb53f21ee439b355b5a1d0a', '0', '2017-03-28 10:57:36', '0', '0', '::1', '0000-00-00 00:00:00', '', '', '0533a888904bd4867929dffd884d60b8', 0, '', '2017-03-28 12:17:37', '0000-00-00 00:00:00', '2017-03-28 11:17:37', '0000-00-00 00:00:00'),
(57, 'Shrikrishna', 'Shanbhag', 'shrikrishna.shanbhag+14@intecons.com', 9876543210, '', '', '', '', 'male', '1993-11-06', '0e7517141fb53f21ee439b355b5a1d0a', '0', '2017-03-28 11:42:47', '1', '0', '::1', '2017-03-28 11:03:45', '::1', '', 'd1a69640d53a32a9fb13e93d1c8f3104', 0, '__recovered__', '2017-03-28 12:46:52', '2017-03-28 14:29:24', '2017-03-28 11:42:47', '2017-03-28 13:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_vehicle_images`
--

CREATE TABLE `shri_carpool_vehicle_images` (
  `id` bigint(20) NOT NULL,
  `driver_id` bigint(20) NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_vehicle_make`
--

CREATE TABLE `shri_carpool_vehicle_make` (
  `make_id` bigint(20) NOT NULL,
  `make` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='store all vehicles details';

-- --------------------------------------------------------

--
-- Table structure for table `shri_carpool_vehicle_model`
--

CREATE TABLE `shri_carpool_vehicle_model` (
  `model_id` bigint(20) NOT NULL,
  `make_id` bigint(20) NOT NULL,
  `model_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specs` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shri_carpool_active_rides_listings`
--
ALTER TABLE `shri_carpool_active_rides_listings`
  ADD PRIMARY KEY (`arl_id`),
  ADD KEY `active_rides_listings_drivers_profile` (`driver_id`);

--
-- Indexes for table `shri_carpool_active_rides_requests`
--
ALTER TABLE `shri_carpool_active_rides_requests`
  ADD PRIMARY KEY (`arr_id`),
  ADD KEY `active_rides_requests_active_rides_listings` (`arl_id`),
  ADD KEY `active_rides_requests_drivers_profile` (`driver_id`),
  ADD KEY `active_rides_requests_riders_profile` (`rider_id`);

--
-- Indexes for table `shri_carpool_administration`
--
ALTER TABLE `shri_carpool_administration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shri_carpool_drivers_profile`
--
ALTER TABLE `shri_carpool_drivers_profile`
  ADD PRIMARY KEY (`driver_id`),
  ADD KEY `drivers_users` (`user_id`);

--
-- Indexes for table `shri_carpool_drivers_reviews`
--
ALTER TABLE `shri_carpool_drivers_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `driver_reviews_drivers_profile` (`driver_id`),
  ADD KEY `driver_reviews_riders_profile` (`rider_id`);

--
-- Indexes for table `shri_carpool_drivers_rider_disputes`
--
ALTER TABLE `shri_carpool_drivers_rider_disputes`
  ADD PRIMARY KEY (`dispute_id`),
  ADD KEY `driver_rider_disputes_drivers_profile` (`driver_id`),
  ADD KEY `driver_rider_disputes_riders_profile` (`rider_id`),
  ADD KEY `drivers_rider_disputes_active_rides_requests` (`arr_id`);

--
-- Indexes for table `shri_carpool_driver_cancellation_log`
--
ALTER TABLE `shri_carpool_driver_cancellation_log`
  ADD PRIMARY KEY (`dcl_id`),
  ADD KEY `driver_cancellation_log_active_rides_listings` (`arl_id`),
  ADD KEY `ride_cancellation_history_drivers_profile` (`driver_id`);

--
-- Indexes for table `shri_carpool_driver_payment_log`
--
ALTER TABLE `shri_carpool_driver_payment_log`
  ADD PRIMARY KEY (`dpl_id`),
  ADD KEY `driver_payment_history_active_rides_requests` (`arr_id`),
  ADD KEY `driver_payment_history_drivers` (`driver_id`);

--
-- Indexes for table `shri_carpool_email_templates`
--
ALTER TABLE `shri_carpool_email_templates`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `shri_carpool_faq`
--
ALTER TABLE `shri_carpool_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `shri_carpool_payment_info`
--
ALTER TABLE `shri_carpool_payment_info`
  ADD PRIMARY KEY (`payer_id`),
  ADD KEY `tbl_payment_info_idx_1` (`user_id`);

--
-- Indexes for table `shri_carpool_pricing`
--
ALTER TABLE `shri_carpool_pricing`
  ADD PRIMARY KEY (`pricing_id`);

--
-- Indexes for table `shri_carpool_riders_payment_log`
--
ALTER TABLE `shri_carpool_riders_payment_log`
  ADD PRIMARY KEY (`rpl_id`),
  ADD KEY `rider_payment_history_active_rides_requests` (`arr_id`),
  ADD KEY `rider_payment_history_riders_profile` (`rider_id`);

--
-- Indexes for table `shri_carpool_riders_profile`
--
ALTER TABLE `shri_carpool_riders_profile`
  ADD PRIMARY KEY (`rider_id`),
  ADD KEY `riders_users` (`user_id`);

--
-- Indexes for table `shri_carpool_riders_refund_log`
--
ALTER TABLE `shri_carpool_riders_refund_log`
  ADD PRIMARY KEY (`rrl_id`),
  ADD KEY `rider_refund_history_active_rides_requests` (`arr_id`),
  ADD KEY `rider_refund_history_riders_profile` (`rider_id`);

--
-- Indexes for table `shri_carpool_rider_cancellation_log`
--
ALTER TABLE `shri_carpool_rider_cancellation_log`
  ADD PRIMARY KEY (`rcl_id`),
  ADD KEY `rider_cancellation_log_active_rides_requests` (`arr_id`),
  ADD KEY `rider_cancellation_log_riders_payment_log` (`rpl_id`),
  ADD KEY `rider_cancellation_log_riders_refund_log` (`rrl_id`);

--
-- Indexes for table `shri_carpool_rides_completed_archive`
--
ALTER TABLE `shri_carpool_rides_completed_archive`
  ADD PRIMARY KEY (`rca_id`),
  ADD KEY `rides_completed_archive_active_rides_requests` (`arr_id`);

--
-- Indexes for table `shri_carpool_users`
--
ALTER TABLE `shri_carpool_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `shri_carpool_vehicle_images`
--
ALTER TABLE `shri_carpool_vehicle_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shri_carpool_vehicle_insurance_shri_carpool_drivers_profile` (`driver_id`);

--
-- Indexes for table `shri_carpool_vehicle_make`
--
ALTER TABLE `shri_carpool_vehicle_make`
  ADD PRIMARY KEY (`make_id`);

--
-- Indexes for table `shri_carpool_vehicle_model`
--
ALTER TABLE `shri_carpool_vehicle_model`
  ADD PRIMARY KEY (`model_id`),
  ADD KEY `shri_carpool_vehicle_model_shri_carpool_vehicle_make` (`make_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shri_carpool_active_rides_listings`
--
ALTER TABLE `shri_carpool_active_rides_listings`
  MODIFY `arl_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shri_carpool_active_rides_requests`
--
ALTER TABLE `shri_carpool_active_rides_requests`
  MODIFY `arr_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shri_carpool_administration`
--
ALTER TABLE `shri_carpool_administration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shri_carpool_drivers_reviews`
--
ALTER TABLE `shri_carpool_drivers_reviews`
  MODIFY `review_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shri_carpool_drivers_rider_disputes`
--
ALTER TABLE `shri_carpool_drivers_rider_disputes`
  MODIFY `dispute_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shri_carpool_driver_cancellation_log`
--
ALTER TABLE `shri_carpool_driver_cancellation_log`
  MODIFY `dcl_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shri_carpool_email_templates`
--
ALTER TABLE `shri_carpool_email_templates`
  MODIFY `template_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shri_carpool_payment_info`
--
ALTER TABLE `shri_carpool_payment_info`
  MODIFY `payer_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shri_carpool_pricing`
--
ALTER TABLE `shri_carpool_pricing`
  MODIFY `pricing_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shri_carpool_riders_payment_log`
--
ALTER TABLE `shri_carpool_riders_payment_log`
  MODIFY `rpl_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shri_carpool_users`
--
ALTER TABLE `shri_carpool_users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `shri_carpool_vehicle_make`
--
ALTER TABLE `shri_carpool_vehicle_make`
  MODIFY `make_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shri_carpool_vehicle_model`
--
ALTER TABLE `shri_carpool_vehicle_model`
  MODIFY `model_id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `shri_carpool_active_rides_listings`
--
ALTER TABLE `shri_carpool_active_rides_listings`
  ADD CONSTRAINT `active_rides_listings_drivers_profile` FOREIGN KEY (`driver_id`) REFERENCES `shri_carpool_drivers_profile` (`driver_id`);

--
-- Constraints for table `shri_carpool_active_rides_requests`
--
ALTER TABLE `shri_carpool_active_rides_requests`
  ADD CONSTRAINT `active_rides_requests_active_rides_listings` FOREIGN KEY (`arl_id`) REFERENCES `shri_carpool_active_rides_listings` (`arl_id`),
  ADD CONSTRAINT `active_rides_requests_drivers_profile` FOREIGN KEY (`driver_id`) REFERENCES `shri_carpool_drivers_profile` (`driver_id`),
  ADD CONSTRAINT `active_rides_requests_riders_profile` FOREIGN KEY (`rider_id`) REFERENCES `shri_carpool_riders_profile` (`rider_id`);

--
-- Constraints for table `shri_carpool_drivers_profile`
--
ALTER TABLE `shri_carpool_drivers_profile`
  ADD CONSTRAINT `drivers_users` FOREIGN KEY (`user_id`) REFERENCES `shri_carpool_users` (`user_id`);

--
-- Constraints for table `shri_carpool_drivers_reviews`
--
ALTER TABLE `shri_carpool_drivers_reviews`
  ADD CONSTRAINT `driver_reviews_drivers_profile` FOREIGN KEY (`driver_id`) REFERENCES `shri_carpool_drivers_profile` (`driver_id`),
  ADD CONSTRAINT `driver_reviews_riders_profile` FOREIGN KEY (`rider_id`) REFERENCES `shri_carpool_riders_profile` (`rider_id`);

--
-- Constraints for table `shri_carpool_drivers_rider_disputes`
--
ALTER TABLE `shri_carpool_drivers_rider_disputes`
  ADD CONSTRAINT `drivers_rider_disputes_active_rides_requests` FOREIGN KEY (`arr_id`) REFERENCES `shri_carpool_active_rides_requests` (`arr_id`),
  ADD CONSTRAINT `driver_rider_disputes_drivers_profile` FOREIGN KEY (`driver_id`) REFERENCES `shri_carpool_drivers_profile` (`driver_id`),
  ADD CONSTRAINT `driver_rider_disputes_riders_profile` FOREIGN KEY (`rider_id`) REFERENCES `shri_carpool_riders_profile` (`rider_id`);

--
-- Constraints for table `shri_carpool_driver_cancellation_log`
--
ALTER TABLE `shri_carpool_driver_cancellation_log`
  ADD CONSTRAINT `driver_cancellation_log_active_rides_listings` FOREIGN KEY (`arl_id`) REFERENCES `shri_carpool_active_rides_listings` (`arl_id`),
  ADD CONSTRAINT `ride_cancellation_history_drivers_profile` FOREIGN KEY (`driver_id`) REFERENCES `shri_carpool_drivers_profile` (`driver_id`);

--
-- Constraints for table `shri_carpool_driver_payment_log`
--
ALTER TABLE `shri_carpool_driver_payment_log`
  ADD CONSTRAINT `driver_payment_history_active_rides_requests` FOREIGN KEY (`arr_id`) REFERENCES `shri_carpool_active_rides_requests` (`arr_id`),
  ADD CONSTRAINT `driver_payment_history_drivers` FOREIGN KEY (`driver_id`) REFERENCES `shri_carpool_drivers_profile` (`driver_id`);

--
-- Constraints for table `shri_carpool_payment_info`
--
ALTER TABLE `shri_carpool_payment_info`
  ADD CONSTRAINT `payment_info_users` FOREIGN KEY (`user_id`) REFERENCES `shri_carpool_users` (`user_id`);

--
-- Constraints for table `shri_carpool_riders_payment_log`
--
ALTER TABLE `shri_carpool_riders_payment_log`
  ADD CONSTRAINT `rider_payment_history_active_rides_requests` FOREIGN KEY (`arr_id`) REFERENCES `shri_carpool_active_rides_requests` (`arr_id`),
  ADD CONSTRAINT `rider_payment_history_riders_profile` FOREIGN KEY (`rider_id`) REFERENCES `shri_carpool_riders_profile` (`rider_id`);

--
-- Constraints for table `shri_carpool_riders_profile`
--
ALTER TABLE `shri_carpool_riders_profile`
  ADD CONSTRAINT `riders_users` FOREIGN KEY (`user_id`) REFERENCES `shri_carpool_users` (`user_id`);

--
-- Constraints for table `shri_carpool_riders_refund_log`
--
ALTER TABLE `shri_carpool_riders_refund_log`
  ADD CONSTRAINT `rider_refund_history_active_rides_requests` FOREIGN KEY (`arr_id`) REFERENCES `shri_carpool_active_rides_requests` (`arr_id`),
  ADD CONSTRAINT `rider_refund_history_riders_profile` FOREIGN KEY (`rider_id`) REFERENCES `shri_carpool_riders_profile` (`rider_id`);

--
-- Constraints for table `shri_carpool_rider_cancellation_log`
--
ALTER TABLE `shri_carpool_rider_cancellation_log`
  ADD CONSTRAINT `rider_cancellation_log_active_rides_requests` FOREIGN KEY (`arr_id`) REFERENCES `shri_carpool_active_rides_requests` (`arr_id`),
  ADD CONSTRAINT `rider_cancellation_log_riders_payment_log` FOREIGN KEY (`rpl_id`) REFERENCES `shri_carpool_riders_payment_log` (`rpl_id`),
  ADD CONSTRAINT `rider_cancellation_log_riders_refund_log` FOREIGN KEY (`rrl_id`) REFERENCES `shri_carpool_riders_refund_log` (`rrl_id`);

--
-- Constraints for table `shri_carpool_rides_completed_archive`
--
ALTER TABLE `shri_carpool_rides_completed_archive`
  ADD CONSTRAINT `rides_completed_archive_active_rides_requests` FOREIGN KEY (`arr_id`) REFERENCES `shri_carpool_active_rides_requests` (`arr_id`);

--
-- Constraints for table `shri_carpool_vehicle_images`
--
ALTER TABLE `shri_carpool_vehicle_images`
  ADD CONSTRAINT `shri_carpool_vehicle_insurance_shri_carpool_drivers_profile` FOREIGN KEY (`driver_id`) REFERENCES `shri_carpool_drivers_profile` (`driver_id`);

--
-- Constraints for table `shri_carpool_vehicle_model`
--
ALTER TABLE `shri_carpool_vehicle_model`
  ADD CONSTRAINT `shri_carpool_vehicle_model_shri_carpool_vehicle_make` FOREIGN KEY (`make_id`) REFERENCES `shri_carpool_vehicle_make` (`make_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
