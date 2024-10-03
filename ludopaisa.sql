-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2024 at 11:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ludopaisa`
--

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `bid_type` varchar(255) NOT NULL,
  `bid_value` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `profitAmount` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `game_id`, `bid_type`, `bid_value`, `amount`, `profitAmount`, `status`, `remark`, `created_at`) VALUES
(1, 1, 'single', '5', 100.00, 100.00, 2, 'Result Declared', '2024-09-05 19:14:17'),
(2, 2, 'Jodi', '23', 250.00, 500.00, 1, 'Result Declared', '2024-09-05 19:43:52'),
(3, 1, 'Single', '6', 200.00, 200.00, 0, 'Result Awaiting', '2024-09-05 19:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `bonus`
--

CREATE TABLE `bonus` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bonus`
--

INSERT INTO `bonus` (`id`, `userid`, `amount`, `created_by`, `created_at`, `remark`) VALUES
(1, '2', '20', '1', '2024-10-03 13:30:49', 'Asea Hi');

-- --------------------------------------------------------

--
-- Table structure for table `gamelists`
--

CREATE TABLE `gamelists` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gamelists`
--

INSERT INTO `gamelists` (`id`, `title`, `slug`, `image`) VALUES
(1, 'Ludo Classic', 'ludo-classic', 'firstLudo.png'),
(2, 'Ludo Popular', 'ludo-popular', 'secondLudo.png'),
(3, 'Ludo No Cut', 'ludo-nocut', 'secondLudo.png'),
(4, 'Ludo Ulta', 'ludo-ulta', 'secondLudo.png');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `game_id` varchar(255) NOT NULL,
  `game_type` varchar(255) NOT NULL,
  `roomcode` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `winAmount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_by` varchar(255) NOT NULL,
  `accepted_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `status` enum('pending','running','complete','conflict','cancel') NOT NULL DEFAULT 'pending',
  `is_complete` int(11) NOT NULL DEFAULT 0,
  `creator_ss` varchar(255) DEFAULT NULL,
  `acceptor_ss` varchar(255) DEFAULT NULL,
  `status_reason` varchar(255) DEFAULT NULL,
  `room_status` varchar(255) DEFAULT NULL,
  `winner` int(11) DEFAULT NULL,
  `isJoined` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `game_id`, `game_type`, `roomcode`, `amount`, `winAmount`, `created_by`, `accepted_by`, `created_at`, `updated_at`, `status`, `is_complete`, `creator_ss`, `acceptor_ss`, `status_reason`, `room_status`, `winner`, `isJoined`) VALUES
(45, '', 'battle', 1359757, 1000.00, 0.00, '1', '6', '2024-10-03 15:45:13', '2024-10-03 17:56:36', 'pending', 0, '66fedad4072f69.76432324.png', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymenthistory`
--

CREATE TABLE `paymenthistory` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` varchar(255) NOT NULL,
  `upi` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `utr` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymenthistory`
--

INSERT INTO `paymenthistory` (`id`, `userid`, `order_id`, `amount`, `type`, `upi`, `status`, `remark`, `utr`, `created_at`) VALUES
(1, 1, '467589734549385', 100.00, 'deposit', 'payment@upi', 2, 'Recharge is Pending', '432432423', '2024-09-13 04:20:33'),
(2, 1, '56438564354', 200.00, 'withdraw', 'payment@upi', 0, 'Withdraw is applied', NULL, '2024-09-13 04:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `payment_modes`
--

CREATE TABLE `payment_modes` (
  `id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `pay_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_modes`
--

INSERT INTO `payment_modes` (`id`, `icon`, `pay_name`, `status`, `slug`) VALUES
(1, 'https://cdn.uxhack.co/product_logos/bhim_logo_2.png', 'UPI G', 1, '#0'),
(2, 'https://cdn-icons-png.flaticon.com/512/8984/8984290.png', 'UPI Manual', 1, '#0'),
(3, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTo4x8kSTmPUq4PFzl4HNT0gObFuEhivHOFYg&s', 'Phonepe', 1, '#0');

-- --------------------------------------------------------

--
-- Table structure for table `penalty`
--

CREATE TABLE `penalty` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `game_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penalty`
--

INSERT INTO `penalty` (`id`, `userid`, `amount`, `game_id`, `created_at`, `created_by`) VALUES
(1, '3', '30', '1011', '2024-10-03 13:55:39', '1');

-- --------------------------------------------------------

--
-- Table structure for table `profile_pic`
--

CREATE TABLE `profile_pic` (
  `id` int(11) NOT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile_pic`
--

INSERT INTO `profile_pic` (`id`, `profile`) VALUES
(1, 'p1.png'),
(2, 'p2.png'),
(3, 'p3.png'),
(4, 'p4.png'),
(5, 'p5.png'),
(6, 'p6.png'),
(7, 'p7.png'),
(8, 'p8.png'),
(9, 'p9.png'),
(10, 'p10.png'),
(11, 'p11.png'),
(12, 'p12.png'),
(13, 'p13.png'),
(14, 'p14.png'),
(15, 'p15.png'),
(16, 'p16.png'),
(17, 'p17.png'),
(18, 'p18.png'),
(19, 'p19.png'),
(20, 'p20.png'),
(21, 'p21.png'),
(22, 'p22.png');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `minRecharge` varchar(255) NOT NULL,
  `minWithdraw` varchar(255) NOT NULL,
  `classic_fee` varchar(255) NOT NULL,
  `popular_fee` varchar(255) NOT NULL,
  `game3_fee` varchar(255) NOT NULL,
  `game4_fee` varchar(255) NOT NULL,
  `deposit_msg` varchar(255) NOT NULL,
  `withdraw_msg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `minRecharge`, `minWithdraw`, `classic_fee`, `popular_fee`, `game3_fee`, `game4_fee`, `deposit_msg`, `withdraw_msg`) VALUES
(1, '100', '200', '10', '10', '10', '10', 'Manual Gateway', 'Withdraw Message');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `otp` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `deposit_wallet` decimal(10,2) NOT NULL,
  `withdraw_wallet` decimal(10,2) NOT NULL,
  `adhaar_no` varchar(255) NOT NULL,
  `kyc_status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `mobile`, `profile_pic`, `role`, `otp`, `username`, `email`, `deposit_wallet`, `withdraw_wallet`, `adhaar_no`, `kyc_status`, `created_at`, `status`, `verified_at`) VALUES
(1, '9588221390', '8', 'admin', 12345, 'xGDhd', '', 2000.00, 200.00, '', 0, '2024-09-13 03:21:26', 2, '2024-10-03 18:48:13'),
(2, '9784597208', '3', 'admin', 48762, '', '', 0.00, 0.00, '', 0, '2024-09-14 06:31:01', 2, '2024-10-03 18:34:17'),
(3, '9608009595', '4', 'user', 51903, '', '', 0.00, 0.00, '', 0, '2024-09-14 06:55:55', 2, '2024-10-03 18:34:20'),
(4, '8085888876', '5', 'user', 16994, '', '', 0.00, 0.00, '', 0, '2024-09-14 07:00:48', 2, '2024-10-03 18:34:24'),
(5, '6375468344', '6', 'user', 36339, '', '', 0.00, 0.00, '', 0, '2024-09-14 07:05:24', 2, '2024-10-03 18:34:29'),
(6, '8955783570', '7', 'admin', 12345, 'fHGDG', '', 1000.00, 0.00, '', 1, '2024-09-29 06:42:49', 2, '2024-10-03 18:34:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bonus`
--
ALTER TABLE `bonus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gamelists`
--
ALTER TABLE `gamelists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymenthistory`
--
ALTER TABLE `paymenthistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_modes`
--
ALTER TABLE `payment_modes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penalty`
--
ALTER TABLE `penalty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_pic`
--
ALTER TABLE `profile_pic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bonus`
--
ALTER TABLE `bonus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gamelists`
--
ALTER TABLE `gamelists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paymenthistory`
--
ALTER TABLE `paymenthistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_modes`
--
ALTER TABLE `payment_modes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penalty`
--
ALTER TABLE `penalty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profile_pic`
--
ALTER TABLE `profile_pic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
