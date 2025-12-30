-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 10, 2024 at 11:22 AM
-- Server version: 5.6.38
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `BlueTriple4`
--

-- --------------------------------------------------------

--
-- Table structure for table `apks`
--

CREATE TABLE `apks` (
  `id` int(11) NOT NULL,
  `apk_name` varchar(255) DEFAULT NULL,
  `apk_name_show` varchar(255) DEFAULT NULL,
  `apk_version` varchar(255) DEFAULT NULL,
  `apk_size` varchar(255) NOT NULL,
  `apk_downloads` varchar(255) DEFAULT NULL,
  `apk_path` varchar(255) DEFAULT NULL,
  `apk_status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `free`
--

CREATE TABLE `free` (
  `id` int(11) NOT NULL,
  `status` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `free`
--

INSERT INTO `free` (`id`, `status`) VALUES
(1, 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `function`
--

CREATE TABLE `function` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `function`
--

INSERT INTO `function` (`id`, `name`, `status`) VALUES
(1, 'Option A', 'Enable'),
(2, 'Option 2', 'Enable'),
(3, 'Option 3', 'Enable'),
(4, 'Option 4', 'Enable'),
(5, 'Option 5', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `lib`
--

CREATE TABLE `lib` (
  `id` int(11) NOT NULL,
  `lib_name` varchar(255) DEFAULT NULL,
  `lib_name_show` varchar(255) DEFAULT NULL,
  `lib_version` varchar(255) DEFAULT NULL,
  `lib_size` varchar(255) NOT NULL,
  `lib_downloads` varchar(255) DEFAULT NULL,
  `lib_path` varchar(255) DEFAULT NULL,
  `lib_status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mod`
--

CREATE TABLE `mod` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `check` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mod`
--

INSERT INTO `mod` (`id`, `name`, `check`) VALUES
(1, 'Blue Triple 4', 'old');

-- --------------------------------------------------------

--
-- Table structure for table `nt`
--

CREATE TABLE `nt` (
  `id` int(11) NOT NULL,
  `n` varchar(30) NOT NULL,
  `nt` varchar(30) NOT NULL,
  `dt` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nt`
--

INSERT INTO `nt` (`id`, `n`, `nt`, `dt`) VALUES
(0, 'all', 'BT4 Team', 'Sat-10-Feb-2024');

-- --------------------------------------------------------

--
-- Table structure for table `online_lib`
--

CREATE TABLE `online_lib` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `size` varchar(30) NOT NULL,
  `last_update` datetime NOT NULL,
  `path` varchar(300) NOT NULL,
  `no` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `panel`
--

CREATE TABLE `panel` (
  `_user_id` int(11) NOT NULL,
  `_username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `_password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `_token` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `_v_status` text COLLATE utf8_unicode_ci NOT NULL,
  `_status` text COLLATE utf8_unicode_ci NOT NULL,
  `_reg_date` timestamp NULL DEFAULT NULL,
  `_exp_date` timestamp NULL DEFAULT NULL,
  `_curr_time` timestamp NULL DEFAULT NULL,
  `_uid` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `_user_type` text COLLATE utf8_unicode_ci NOT NULL,
  `_registrar` text COLLATE utf8_unicode_ci NOT NULL,
  `_version` text COLLATE utf8_unicode_ci NOT NULL,
  `_p_status` text COLLATE utf8_unicode_ci NOT NULL,
  `_credits` int(11) NOT NULL,
  `_resets` int(11) NOT NULL,
  `_r_resets` int(11) NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verification_code` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_verified` int(11) DEFAULT NULL,
  `paid` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'paid',
  `by` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'paid',
  `profile` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '../assets/img/avatars/1.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `panel`
--

INSERT INTO `panel` (`_user_id`, `_username`, `_password`, `_token`, `_v_status`, `_status`, `_reg_date`, `_exp_date`, `_curr_time`, `_uid`, `_user_type`, `_registrar`, `_version`, `_p_status`, `_credits`, `_resets`, `_r_resets`, `email`, `verification_code`, `is_verified`, `paid`, `by`, `profile`) VALUES
(1, 'BlueTriple4', '1', 'BlueTriple4', 'verified', 'active', NULL, NULL, NULL, NULL, 'owner', 'Owner', 'injector', 'paid', 999999939, 0, 999999, NULL, NULL, 1, 'paid', 'paid', '../assets/img/avatars/1.png'),
(2, 'blueisthebest', 'blueisthebest', 'blueisthebest', 'verified', 'active', NULL, NULL, NULL, NULL, 'server', 'BlueTriple4', 'injector', 'paid', 999999939, 0, 999999, NULL, NULL, 1, 'paid', 'paid', '../assets/img/avatars/1.png'),
(3, '', '', '', '', '', NULL, NULL, NULL, NULL, '', '', '', '', 0, 0, 0, NULL, NULL, NULL, 'paid', 'paid', '../assets/img/avatars/1.png');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_name_show` varchar(255) DEFAULT NULL,
  `product_version` varchar(255) DEFAULT NULL,
  `product_size` varchar(255) NOT NULL,
  `product_downloads` varchar(255) DEFAULT NULL,
  `product_path` varchar(255) DEFAULT NULL,
  `product_status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_token` varchar(300) NOT NULL,
  `pd_type` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_name_show`, `product_version`, `product_size`, `product_downloads`, `product_path`, `product_status`, `created_at`, `product_token`, `pd_type`) VALUES
(1, 'IMG-20240210-WA0000.jpg', 'Blue Triple 4', '10$', '103944', '0', 'product-image/IMG-20240210-WA0000.jpg', 'Dndj\r\nJdjd\r\nDjdj\r\nUdudh\r\nUdud', '2024-02-10 12:17:46', 'ce3366db93d158628cd03945af7a3041175d8a7b84bec363ca5d6ae85b7006d0', 'hack');

-- --------------------------------------------------------

--
-- Table structure for table `safe_or_not`
--

CREATE TABLE `safe_or_not` (
  `srv_id` int(11) NOT NULL,
  `server_name` text COLLATE utf8_unicode_ci NOT NULL,
  `safe_or_not` text COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `safe_or_not`
--

INSERT INTO `safe_or_not` (`srv_id`, `server_name`, `safe_or_not`, `text`) VALUES
(1, 'panel', 'Safe', 'Ujj');

-- --------------------------------------------------------

--
-- Table structure for table `script`
--

CREATE TABLE `script` (
  `id` int(11) NOT NULL,
  `script_name` varchar(255) DEFAULT NULL,
  `script_name_show` varchar(255) DEFAULT NULL,
  `script_version` varchar(255) DEFAULT NULL,
  `script_size` varchar(255) NOT NULL,
  `script_downloads` varchar(255) DEFAULT NULL,
  `script_path` varchar(255) DEFAULT NULL,
  `script_status` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `server`
--

CREATE TABLE `server` (
  `srv_id` int(11) NOT NULL,
  `server_name` text COLLATE utf8_unicode_ci NOT NULL,
  `total_sessions` int(11) NOT NULL,
  `server_status` text COLLATE utf8_unicode_ci NOT NULL,
  `server_h_status` text COLLATE utf8_unicode_ci NOT NULL,
  `main_text` text COLLATE utf8_unicode_ci NOT NULL,
  `off_text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `server`
--

INSERT INTO `server` (`srv_id`, `server_name`, `total_sessions`, `server_status`, `server_h_status`, `main_text`, `off_text`) VALUES
(1, 'BT4 Team', 117, 'online', 'online', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `transaction` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `type` varchar(200) NOT NULL,
  `price` varchar(300) NOT NULL,
  `name` varchar(300) NOT NULL,
  `pd_type` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `username`, `transaction`, `email`, `status`, `token`, `type`, `price`, `name`, `pd_type`) VALUES
(1, 'S', 'DJJDN8SH2HHSH1', 'bluetriple4official@gmail.com', 'done', 'ce3366db93d158628cd03945af7a3041175d8a7b84bec363ca5d6ae85b7006d0', 'binance', '10$', 'Blue Triple 4', 'hack');

-- --------------------------------------------------------

--
-- Table structure for table `update`
--

CREATE TABLE `update` (
  `_upd_id` int(11) NOT NULL,
  `_username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `_password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `_title` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `_msg` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `_name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `_path` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `_update` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `update`
--

INSERT INTO `update` (`_upd_id`, `_username`, `_password`, `_title`, `_msg`, `_name`, `_path`, `_update`) VALUES
(4, '1.0', '1.0', 'New Update Available', 'User Please Update the apk', '', '/update/x.php.bak', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apks`
--
ALTER TABLE `apks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `free`
--
ALTER TABLE `free`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `function`
--
ALTER TABLE `function`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lib`
--
ALTER TABLE `lib`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mod`
--
ALTER TABLE `mod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `online_lib`
--
ALTER TABLE `online_lib`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panel`
--
ALTER TABLE `panel`
  ADD PRIMARY KEY (`_user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `safe_or_not`
--
ALTER TABLE `safe_or_not`
  ADD PRIMARY KEY (`srv_id`);

--
-- Indexes for table `script`
--
ALTER TABLE `script`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `server`
--
ALTER TABLE `server`
  ADD PRIMARY KEY (`srv_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `update`
--
ALTER TABLE `update`
  ADD PRIMARY KEY (`_upd_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apks`
--
ALTER TABLE `apks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `free`
--
ALTER TABLE `free`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `function`
--
ALTER TABLE `function`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mod`
--
ALTER TABLE `mod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `online_lib`
--
ALTER TABLE `online_lib`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `panel`
--
ALTER TABLE `panel`
  MODIFY `_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `safe_or_not`
--
ALTER TABLE `safe_or_not`
  MODIFY `srv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `server`
--
ALTER TABLE `server`
  MODIFY `srv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `update`
--
ALTER TABLE `update`
  MODIFY `_upd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;