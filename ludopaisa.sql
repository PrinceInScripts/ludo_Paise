-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 08:23 AM
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
-- Table structure for table `aadhaar_data`
--

CREATE TABLE `aadhaar_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `aadhaar_number` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `dist` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `po` varchar(100) DEFAULT NULL,
  `vtc` varchar(100) DEFAULT NULL,
  `subdist` varchar(100) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `house` varchar(50) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `mobile_hash` varchar(20) DEFAULT NULL,
  `share_code` varchar(20) DEFAULT NULL,
  `reference_id` varchar(100) DEFAULT NULL,
  `request_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `plain_password` varchar(255) NOT NULL,
  `role_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `plain_password`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'maverickxjames', 'e10adc3949ba59abbe56e057f20f883e', '123456', '1', '2024-10-24 22:52:52', '2024-10-24 22:52:52');

-- --------------------------------------------------------

--
-- Table structure for table `admin_earnings`
--

CREATE TABLE `admin_earnings` (
  `id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `game_id` varchar(100) DEFAULT NULL,
  `earned_from` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` int(11) NOT NULL,
  `type` enum('deposit','withdraw','battle') NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `msg` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `type`, `title`, `msg`, `status`, `created_at`, `updated_at`) VALUES
(1, 'deposit', 'Deposit Request', '100 INR Deposit is requested', 0, '2024-10-25 00:30:01', '2024-10-25 00:42:56'),
(2, 'withdraw', 'withdraw request', 'You got withdraw request of 200 INR', 0, '2024-10-25 00:42:10', '2024-10-25 11:58:21'),
(3, 'battle', 'Battle Conflict', 'Two Win SS Found', 0, '2024-10-25 00:42:10', '2024-10-25 11:58:25');

-- --------------------------------------------------------

--
-- Table structure for table `bankdetails`
--

CREATE TABLE `bankdetails` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_acc` varchar(100) NOT NULL,
  `bank_ifsc` varchar(50) DEFAULT NULL,
  `bank_holder` varchar(255) DEFAULT NULL,
  `bank_branch` varchar(255) DEFAULT NULL,
  `upi` varchar(255) DEFAULT NULL,
  `bank_status` int(11) NOT NULL DEFAULT 0,
  `upi_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `gamelists`
--

CREATE TABLE `gamelists` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `opacity` decimal(10,2) NOT NULL DEFAULT 1.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gamelists`
--

INSERT INTO `gamelists` (`id`, `title`, `slug`, `image`, `opacity`) VALUES
(1, 'Ludo Classic', 'ludo-classic', 'firstLudo.png', 1.00),
(2, 'Ludo Popular', 'ludo-popular', 'secondLudo.png', 0.50),
(3, 'Ludo No Cut', 'ludo-nocut', 'secondLudo.png', 0.50),
(5, 'Snake & Ladder', 'snake', 'snake.jpg', 0.50);

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `game_id` varchar(255) NOT NULL,
  `game_type` varchar(255) NOT NULL,
  `roomcode` varchar(50) DEFAULT NULL,
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
  `creator_join_ss` varchar(255) DEFAULT NULL,
  `acceptor_join_ss` varchar(255) DEFAULT NULL,
  `status_reason` varchar(255) DEFAULT NULL,
  `room_status` varchar(255) DEFAULT NULL,
  `winner` int(11) DEFAULT NULL,
  `isJoined` tinyint(1) NOT NULL DEFAULT 0,
  `remark` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game_record`
--

CREATE TABLE `game_record` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `game_id` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `ProfitAmount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `deposit_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `withdraw_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manualupi`
--

CREATE TABLE `manualupi` (
  `id` int(11) NOT NULL,
  `upi` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manualupi`
--

INSERT INTO `manualupi` (`id`, `upi`, `status`) VALUES
(1, 'maverickxjames@apl', 1);

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
-- Table structure for table `pan_data`
--

CREATE TABLE `pan_data` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `pan_no` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pan_data`
--

INSERT INTO `pan_data` (`id`, `userid`, `pan_no`, `full_name`, `category`, `created_at`) VALUES
(1, 1, 'FFNPR7212N', 'JAYKISHAN  RAWAT', 'individual', '2024-10-24 22:21:53'),
(2, 2, 'MAAPK3442C', 'PRINCE  KUMAR', 'individual', '2024-10-24 22:23:56');

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
  `payment_ss` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `utr` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'https://cdn.uxhack.co/product_logos/bhim_logo_2.png', 'QR PAY', 0, 'upigateway'),
(2, 'https://cdn-icons-png.flaticon.com/512/8984/8984290.png', 'UPI Manual', 1, 'manual'),
(3, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTo4x8kSTmPUq4PFzl4HNT0gObFuEhivHOFYg&s', 'Phonepe', 1, 'phonepe_api'),
(4, 'https://cdn-icons-png.flaticon.com/512/2830/2830289.png', 'Bank Deposit', 0, 'bankcard'),
(5, 'https://cdn-icons-png.flaticon.com/512/15207/15207964.png', 'USDT TRC20', 0, 'usdt');

-- --------------------------------------------------------

--
-- Table structure for table `penalties`
--

CREATE TABLE `penalties` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `admin_id` varchar(255) NOT NULL DEFAULT '0',
  `battle_id` varchar(255) DEFAULT NULL,
  `remark` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission_name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission_name`, `description`) VALUES
(1, 'create_user', 'Ability to create new users'),
(2, 'edit_user', 'Ability to edit user details'),
(3, 'delete_user', 'Ability to delete users'),
(4, 'view_reports', 'Ability to view reports'),
(5, 'manage_posts', 'Ability to manage posts');

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `description`) VALUES
(1, 'admin', 'Administrator with full access'),
(2, 'subadmin', 'Limited access for administration tasks'),
(3, 'manager', 'Manager with access to moderate users and content');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 4),
(2, 5),
(3, 5);

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
  `withdraw_msg` varchar(255) NOT NULL,
  `recharge_status` enum('on','off') NOT NULL DEFAULT 'on',
  `withdraw_status` enum('on','off') NOT NULL DEFAULT 'on',
  `withdraw_count` int(11) NOT NULL DEFAULT 3,
  `game_rules` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `minRecharge`, `minWithdraw`, `classic_fee`, `popular_fee`, `game3_fee`, `game4_fee`, `deposit_msg`, `withdraw_msg`, `recharge_status`, `withdraw_status`, `withdraw_count`, `game_rules`) VALUES
(1, '100', '200', '10', '10', '10', '10', 'Min Deposit is 1000', 'Withdrawals are temporarily suspended due to maintenance. Please check back later', 'on', 'on', 3, '<ol><li>All users have to upload their screenshot</li><li>All users have 3 Free withdrawals in a day&nbsp;</li></ol>');

-- --------------------------------------------------------

--
-- Table structure for table `tablename`
--

CREATE TABLE `tablename` (
  `id` int(11) NOT NULL,
  `Name` varchar(512) DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `Email` varchar(512) DEFAULT NULL,
  `Phone` varchar(512) DEFAULT NULL,
  `Wallet_balance` varchar(512) DEFAULT NULL,
  `referral` varchar(512) DEFAULT NULL,
  `referral_code` int(11) DEFAULT NULL,
  `verified` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tablename`
--

INSERT INTO `tablename` (`id`, `Name`, `otp`, `Email`, `Phone`, `Wallet_balance`, `referral`, `referral_code`, `verified`) VALUES
(1, 'Frा', 632284, 'meet.sharma0416@gmail.com', '7502600666', '31.5', '0', 882488, 'verified'),
(2, 'aao na...', 766813, 'sharmadilip801@gmail.com', '6376455536', '11.5', '0', 958256, 'verified'),
(3, 'ejQxc', 611603, '', '9571138810', '42.5', '0', 456244, 'unverified'),
(4, 'No fresh', 379362, 'mor405706@gamil.com', '9549105743', '0.5', '', 31092, 'verified'),
(5, 'dJCLX', 718630, '', '7740838936', '0', '', 765001, 'unverified'),
(6, 'Name m kya rakha hai ??', 124110, '', '8875956464', '0', '399634', 224396, 'unverified'),
(7, 'Hansraj', 866941, 'hrajmeenaips@gmail.com', '8800229972', '0.5', '', 899499, 'verified'),
(8, 'No. Papular', 631689, 'ramprasadmeena25071997@gmail.com', '7877070769', '0.5', '', 375314, 'verified'),
(9, 'OpQYQ', 661353, '', '7615874680', '0', '', 736825, 'unverified'),
(10, 'Qtrsk', 688044, 'aakilabram9900@gmail.com', '9610863130', '6.5', '', 880880, 'verified'),
(11, 'KALU', 559588, 'ashish0088pandit@gmail.com', '8890329291', '166', '', 276894, 'verified'),
(12, 'eJEdn', 349965, 'nitinrai75661191@gmail.com', '9244728039', '5.5', '', 208020, 'verified'),
(13, 'Rp', 183894, 'rakeshpandey41314131@gmail.com', '7037127586', '-45', '', 816625, 'verified'),
(14, 'CsKCf', 96274, '', '7627088152', '0.5', '', 17153, 'unverified'),
(15, 'Areas khan', 896036, 'Arsadkhan30@gmail.com', '8875896652', '0', '', 813289, 'verified'),
(16, 'DUfzY', 97882, '', '8875896652', '0', '', 376360, 'unverified'),
(17, 'King 666', 78139, 'Sadikkhan4414@gmail.com', '9529067547', '1', '', 665699, 'verified'),
(18, 'Vjsooso', 227167, 'Arunyadav84016@gmail.com', '9316781523', '1639', '', 815554, 'verified'),
(19, 'WJyfD', 655294, '', '7877330148', '0', '', 872720, 'unverified'),
(20, 'KdLqZ', 704837, 'Sadikkhan4414@gmail.com', '8079029499', '0', '', 722952, 'verified'),
(21, 'AtZTw', 358381, '', '8053955192', '0', '', 998472, 'unverified'),
(22, 'oxJPP', 556015, 'yk820106@gmail.com', '9783191794', '20.5', '', 984286, 'verified'),
(23, 'LAGmj', 701040, 'Namichand prajapat @gamil.com', '9257651509', '8.5', '', 566678, 'verified'),
(24, 'zbFWa', 448815, 'Saddampathan8686@gmail.com', '9785137878', '0', '', 10754, 'verified'),
(25, 'OK 👌👌', 503322, 'Rahulsharmapattya@gmail.com', '7240494661', '14800', '276894', 257507, 'verified'),
(26, 'Only classic mode', 566128, 'Ajayget111@gmail.com', '9001625020', '0.5', '', 641525, 'verified'),
(27, 'Kali nagani', 855555, 'hc27883@gmail.com', '7357169173', '33.5', '', 812134, 'verified'),
(28, 'Nirjharna aale', 723787, 'Vs628023@gmail.com', '7610027473', '0.5', '', 496438, 'verified'),
(29, 'A..A...E....M...B...', 100911, 'Mujahid6616@gmail.com', '9991764598', '3', '', 993715, 'verified'),
(30, 'yzUfk', 41510, 'khanajrudeen747@gmail.com', '9783580660', '43', '', 69894, 'verified'),
(31, '💃', 79623, 'GHANSHYAMMEENA2089@GIMAL.COM', '7877880250', '978', '', 864731, 'verified'),
(32, 'Irshad', 464505, 'Irshadkhan62998@gmail.com', '8875087490', '0', '', 797475, 'verified'),
(33, 'Kanu', 816380, 'majay0278@gmail.com', '7878036453', '3.5', '', 338936, 'verified'),
(34, 'zbrRo', 552895, 'RIHANking7073@GMAIL.COm', '7073285331', '1', '', 535173, 'verified'),
(35, 'rXlKf', 414721, '', '9024242472', '0', '', 78277, 'unverified'),
(36, '5 lach loss', 449338, 'dhanrajmeena968399@gmail.com', '9983968700', '0', '', 587809, 'verified'),
(37, 'RM', 659274, 'ramjilalmeena5795@gmail.com', '8741818045', '-199.5', '', 902471, 'verified'),
(38, 'Fast aajao', 488316, 'tk172366@gmail.com', '7424900510', '10', '', 393526, 'verified'),
(39, 'Bala ji sarkar 🚩🚩', 923873, 'papudevi9950@gmail.com', '9636794779', '32.5', '', 280272, 'unverified'),
(40, 'DbFfc', 909894, 'Jesutyping@gmail.com', '8058151918', '5.5', '', 579322, 'verified'),
(41, 'Kiss me, 💋, 😘😘', 54562, '', '9730594819', '3', '', 272588, 'unverified'),
(42, 'OLcpu', 845643, '', '9794626580', '0', '', 562000, 'unverified'),
(43, 'Abaaa', 415347, 'anurag25.09.99@gmail.com', '8955232101', '22', '', 597651, 'verified'),
(44, 'butfE', 108208, 'anees5811@gmail.com', '9794857050', '0', '', 566135, 'verified'),
(45, 'sIQES', 499343, 'jagmohankawat1978@gmail.com', '8949095721', '0', '', 607081, 'verified'),
(46, 'vPUmj', 141973, '', '8696703850', '0', '', 665660, 'unverified'),
(47, 'Babu ❣️', 660932, 'rm6579503@gmail.com', '9001543222', '5.5', '', 422123, 'verified'),
(48, 'Koi nhi h kya aaj', 193331, 'niteshgurjar336@gmail.com', '7014293620', '3', '', 21519, 'verified'),
(49, 'wZKYV', 340938, '', '7665795664', '0', '', 595488, 'unverified'),
(50, 'lubxe', 752858, '', '7852885169', '0', '', 224966, 'unverified'),
(51, 'hhOak', 786998, '', '9813524971', '0', '', 84829, 'unverified'),
(52, 'dVObU', 196612, 'mukeshmeena374@gmail.com', '6350124822', '42.5', '', 406393, 'verified'),
(53, 'Roki bhai', 390816, 'maheshmeena2021995@gmail.com', '8890994451', '32', '', 790601, 'verified'),
(54, 'ZvzKa', 17346, 'MohammedAzhar.6616@Gmail.com', '9401017571', '0', '', 786944, 'verified'),
(55, 'DAcbK', 82668, '', '9950991648', '0', '', 550616, 'unverified'),
(56, 'Cobra 🐍', 293803, 'rajendrameena6480@gmail.com', '7239976480', '29', '', 487438, 'verified'),
(57, 'WeEtt', 279332, '', '6367032992', '0', '', 167294, 'unverified'),
(58, 'HxBjr', 196243, 'warishkhan4158@gmail.com', '7027536912', '497', '', 500439, 'verified'),
(59, 'ANSARI', 498496, 'Alfejansari037@gmail.com', '7878233501', '7.5', '', 178833, 'verified'),
(60, 'EmvYf', 572, '', '6377736972', '0', '', 567246, 'unverified'),
(61, 'ZMupb', 328131, '', '9812609786', '0', '', 33907, 'unverified'),
(62, 'Gaurishankar 6', 691028, '', '8233824343', '0', '', 137993, 'unverified'),
(63, 'Roquk', 791856, 'aftabalam90908080@gmail.com', '9794176498', '32.5', '', 176630, 'verified'),
(64, 'bgQuk', 669848, '', '8955624662', '0', '', 188473, 'unverified'),
(65, 'xJDAh', 286742, '', '8058373542', '0', '', 401609, 'unverified'),
(66, 'MQECW', 896304, '', '9785127732', '0', '', 716184, 'unverified'),
(67, 'pgmgo', 660435, '', '8955407965', '0', '', 430173, 'unverified'),
(68, 'gPaOf', 766384, '', '8955407965', '0', '', 892448, 'unverified'),
(69, 'pdwwo', 789780, '', '9216255903', '0', '', 597177, 'unverified'),
(70, 'hBKXN', 14248, '', '6264697196', '0', '', 470841, 'unverified'),
(71, 'gzaaR', 548596, '', '9887415445', '0', '', 704963, 'unverified'),
(72, 'Gtrssv', 967793, 'rishimeena303504@gmail.com', '9649778824', '15.5', '', 755425, 'verified'),
(73, 'Dilkhush84', 113682, 'dilkhushmeena612268@gmail.com', '8441051661', '3.5', '', 399634, 'verified'),
(74, 'naiIx', 540610, '', '9818174134', '0', '', 889906, 'unverified'),
(75, 'RqMEw', 23261, '', '9664290931', '0', '', 814989, 'unverified'),
(76, 'SgFWt', 937139, 'pkgomladu12@gmail.com', '9667872229', '0.5', '', 924842, 'verified'),
(77, 'XHuQZ', 390582, '', '9119114956', '0', '', 421660, 'unverified'),
(78, 'Bharosi', 664904, 'zuber907954@gmail.com', '6377254260', '0.5', '', 895839, 'verified'),
(79, 'CeYDk', 486939, '', '7007399926', '1', '399634', 177918, 'unverified'),
(80, '❤️', 606149, 'javidak125@gmail.com', '9694962688', '131', '', 504059, 'verified'),
(81, 'fniIr', 892493, '', '7275808204', '0', '', 645467, 'unverified'),
(82, 'TGGeQ', 600601, '', '9653787796', '0', '', 244859, 'unverified'),
(83, 'efmlX', 403406, '', '8307762482', '0', '', 270681, 'unverified'),
(84, '9584661922', 552618, 'abhskel1233@gmail.com', '9584661922', '0', '', 567121, 'verified'),
(85, 'YHIVn', 941871, '', '9509552957', '0', '', 215805, 'unverified'),
(86, 'VEeoF', 616931, '', '9929213991', '0', '', 441332, 'unverified'),
(87, 'JUXIJ', 136027, '', '9817411240', '702', '', 318681, 'unverified'),
(88, 'LIorp', 16235, '', '6376371101', '0', '', 524304, 'unverified'),
(89, 'xUyye', 520553, '', '8290716348', '0', '', 643825, 'unverified'),
(90, 'pnNjv', 32106, 'pawanjaat8104811024@gmail.com', '7073758293', '41.5', '', 479576, 'verified'),
(91, 'MD Hasim Mewati', 245434, '', '9991463122', '0.5', '', 838020, 'unverified'),
(92, 'GFzOe', 246814, '', '8696437534', '0', '', 153472, 'unverified'),
(93, 'AHaus', 78750, 'ZABIRZ', '9509346720', '494', '399634', 90974, 'verified'),
(94, 'XsxNW', 826919, '', '9813719203', '0', '', 40161, 'unverified'),
(95, 'Jay shree Dev baba k', 928591, 'jg1269284@gmail.com', '9587527124', '0', '', 752329, 'verified'),
(96, 'SyLrB', 335214, 'Khana183518@gmail.com', '8684873122', '0', '', 616648, 'unverified'),
(97, 'pEBtN', 422902, '', '8959328636', '44', '', 812906, 'unverified'),
(98, 'kuThb', 960732, '', '8950351991', '0', '', 105317, 'unverified'),
(99, 'PVyPd', 798323, '', '9587921838', '0', '', 595289, 'unverified'),
(100, 'Ssssjt6i', 332905, 'Umeshhalduniyap9@gmail.com', '9509253578', '1', '', 992210, 'verified'),
(101, 'राधे-राधे', 123542, 'KAMALSINGHmeena0250@gamail.com', '9887211356', '24', '', 941618, 'verified'),
(102, 'Ludo ne mara', 405910, 'Khani21782@gmail.com', '7300472848', '46', '', 273180, 'verified'),
(103, 'qoiDb', 715561, '', '8000428377', '0', '', 499834, 'unverified'),
(104, 'kqcqT', 499201, '', '8000645672', '0', '', 107000, 'unverified'),
(105, 'wGdGr', 893055, 'sarukhkhan68399@gmail.com', '9982674213', '0', '', 768721, 'verified'),
(106, 'aOFkj', 622604, '', '7230021817', '0', '', 313294, 'unverified'),
(107, 'Zahid093', 758236, 'jk9703963@gmail.com', '9352171093', '0', '', 281517, 'verified'),
(108, 'dhwmK', 852277, 'Jgf', '8302473486', '0', '', 226456, 'verified'),
(109, 'Priya', 317440, '', '8875956425', '0', '399634', 0, 'unverified'),
(110, 'CZLoC', 780261, '', '6375824531', '0', '', 714370, 'unverified'),
(111, 'YufsR', 412741, '', '9306447936', '0', '', 890870, 'unverified'),
(112, 'Shehzada', 679590, 'rashidmansuri757@gmail.com', '7877472227', '0.5', '', 965183, 'verified'),
(113, 'DMjvP', 638186, 'khan643753@gmail.com', '7378290014', '0', '', 183988, 'verified'),
(114, 'NtQt', 951691, 'jas.vesingh95@gmail.com', '8319947260', '20.5', '', 265579, 'verified'),
(115, 'tDBYf', 717695, 'avneeshkumartanwar069@gmail.com', '9351641397', '0', '', 863521, 'verified'),
(116, 'rseBL', 49271, '', '8058144856', '0', '', 362780, 'unverified'),
(117, 'LMNcP', 820249, '', '9306936649', '0', '', 602310, 'unverified'),
(118, 'MaFiyaaa', 410801, 'akash702323@gmail.com', '7030212396', '19552', '576264', 576264, 'verified'),
(119, 'MUdbb', 830924, '', '6378943261', '0', '', 261778, 'unverified'),
(120, 'xzRqQ', 930697, '', '9161221060', '0', '', 453118, 'unverified'),
(121, 'XrxpJ', 586393, '', '9057660936', '0', '', 503361, 'unverified'),
(122, '2016', 305517, 'rahulchouhan8586@gmail.com', '7424945157', '1.5', '', 709438, 'verified'),
(123, 'fYDrT', 251943, '', '9352858397', '0', '', 676470, 'unverified'),
(124, 'JWeDs', 790220, '', '9664055456', '0', '', 191482, 'unverified'),
(125, 'VgGgC', 881344, '', '9509073112', '0', '', 581664, 'unverified'),
(126, 'bBbPB', 218470, '', '7877969886', '0', '', 225285, 'unverified'),
(127, 'zjEQi', 571460, '', '9352899921', '0', '', 283548, 'unverified'),
(128, 'Bas ker yaar', 641288, 'rukmudeen65701@okhdfcbank', '8000621017', '42.5', '', 134047, 'verified'),
(129, 'YASH JORWAL.KHEDI', 457655, 'mithleshmeena337@gmail.com', '9216515129', '1071.5', '', 333614, 'verified'),
(130, 'ChrVH', 346952, '', '7404509630', '0', '', 825793, 'unverified'),
(131, 'gQwWk', 394303, '', '7056323644', '0', '', 339938, 'unverified'),
(132, 'PcNZr', 546879, '', '7056323644', '0', '', 393897, 'unverified'),
(133, 'Dice ch', 419946, 'Jaggimanish79@gmail.com', '9456162108', '0', '', 95846, 'verified'),
(134, 'Rkm', 21470, 'Rk295942@gmail.com', '7733882026', '0.5', '', 96467, 'verified'),
(135, 'AsNrv', 825851, '', '8607497609', '0', '', 828420, 'unverified'),
(136, 'XdMgC', 787354, '', '8607497609', '0', '', 986936, 'unverified'),
(137, 'Pooja meena', 751090, 'mithleshmeena337@gmail.com', '9636415129', '1', '', 697606, 'verified'),
(138, 'FmPiF', 994136, '', '9636415129', '0', '', 126547, 'unverified'),
(139, 'BKwaH', 155600, '', '8959325636', '0', '', 586712, 'unverified'),
(140, 'zejCr', 394858, '', '8619701135', '0', '', 916672, 'unverified'),
(141, 'NletU', 197592, '', '9587195300', '0', '', 333795, 'unverified'),
(142, 'iBiaE', 844047, '', '9079399455', '0', '', 448342, 'unverified'),
(143, 'qQbpi', 74187, 'Kuldeeploveheart@gmail.com', '7011934962', '11', '', 661922, 'verified'),
(144, 'xEtWi', 642515, 'manojkumar301409@gmail.com', '9079330215', '5', '', 436406, 'verified'),
(145, 'gtvvd', 470657, '', '9813737995', '0', '', 759391, 'unverified'),
(146, 'HGjwr', 611231, '', '7240190888', '0', '', 47722, 'unverified'),
(147, 'LZElR', 4445, '', '7014757014', '0', '', 183344, 'unverified'),
(148, 'Mvhqk', 443223, 'mendiratta.bhanavi@gmail.com', '7014176329', '7.5', '', 384943, 'verified'),
(149, 'ePJgM', 247119, '', '9358599295', '0', '', 826413, 'unverified'),
(150, 'rmPrc', 914297, '', '9079718443', '0', '', 683634, 'unverified'),
(151, 'चीता 🐯', 711874, 'khanasif.935834@gmail.com', '8000620147', '2.5', '', 352263, 'verified'),
(152, 'KYivk', 268823, '', '9785696783', '0', '', 522429, 'unverified'),
(153, 'GygVX', 584888, '', '7878591683', '0', '', 68772, 'unverified'),
(154, 'gHeFH', 693096, 'lxkakarwad@gmail.com', '9351949336', '0', '', 909222, 'verified'),
(155, 'LQSYc', 936072, '', '7725900249', '0', '', 921329, 'unverified'),
(156, 'Cxzss', 208337, 'harkeshmeena759@gmail.com', '8290668554', '0', '', 269750, 'verified'),
(157, 'gbFhj', 238497, '', '8505012015', '0', '', 651869, 'unverified'),
(158, 'YVoEP', 636399, '', '8852892412', '0', '', 442221, 'unverified'),
(159, 'जाता कहा है आजा', 748285, 'airtelcall586@gmail.com', '9057038600', '1', '', 96280, 'verified'),
(160, 'Jhnbl', 237865, '', '7988012621', '0', '', 276197, 'unverified'),
(161, 'NPZcv', 670281, 'bk2098006@gmail.com', '8102778270', '44', '', 272366, 'verified'),
(162, 'HnaiN', 618761, '', '6377884779', '0', '', 568325, 'unverified'),
(163, 'RQcNv', 121387, 'rahuljangid12k@gmail.com', '7742258816', '0', '', 339895, 'verified'),
(164, 'yYxTe', 249698, '', '8290394225', '0', '', 347208, 'unverified'),
(165, 'Krishna', 175255, 'Arpitbeflwat@gmail.con', '9351313305', '0', '', 399621, 'verified'),
(166, 'Ajai', 832932, 'kshyapyash@gmail.com', '9557004688', '0.5', '', 51168, 'verified'),
(167, 'diaiM', 295629, '', '9664199300', '0', '', 776394, 'unverified'),
(168, 'fhsxo', 574122, '', '8848297948', '0', '', 46383, 'unverified'),
(169, 'wLxoX', 698906, 'Mahendrajmeena123@gmail.com', '9216145014', '33.5', '', 865739, 'verified'),
(170, 'SAR JI', 822857, 'sarfarajshaikh990@gmail.com', '7777871866', '0', '', 223172, 'verified'),
(171, 'EApyK', 213022, 'arsadkhan43522@gmail.com', '9813486382', '0.5', '', 489656, 'verified'),
(172, 'kKWpg', 448526, 'mousamkhan84273@gmail.com', '8307515077', '28.5', '', 655513, 'verified'),
(173, 'ReKzP', 168616, '', '8505045466', '0', '', 466404, 'unverified'),
(174, 'Hiiiii', 815400, 'mukeshmataji@gamil.com', '7733989862', '1', '', 691732, 'verified'),
(175, 'SVOqD', 379653, '', '9785953837', '0', '', 964863, 'unverified'),
(176, 'pzoMr', 669867, 'khansakil53142@gmail.com', '6367779513', '0.5', '', 728253, 'unverified'),
(177, 'hYFDd', 926476, 'talimkhan789090@gail.com', '8209715250', '0', '', 41700, 'verified'),
(178, 'cEpeo', 691292, '', '8742059129', '0', '', 465304, 'unverified'),
(179, 'मोनिका', 752928, 'bhaiyameena93@gmail.com', '8302353664', '3.5', '', 763415, 'verified'),
(180, 'ZcgAd', 10361, '', '8432807282', '0', '', 231020, 'unverified'),
(181, 'VRoRq', 107878, 'rajuverma2828@gmail.com', '7837867002', '0', '', 125361, 'verified'),
(182, 'DVVzs', 643042, '', '8107453621', '0', '', 291212, 'unverified'),
(183, 'SBZdA', 322689, '', '7597171714', '0', '', 455343, 'unverified'),
(184, '❌♥️', 67888, 'officialchaudharyyash@gmail.com', '9058879755', '47', '', 379039, 'verified'),
(185, 'JBQmR', 586106, 'yugsahu654@gmail.com', '6263811677', '42.5', '', 658647, 'verified'),
(186, 'ScZKL', 545933, '', '7986800549', '0', '', 666844, 'unverified'),
(187, 'wyRmR', 882127, '', '9813814250', '0', '', 424249, 'unverified'),
(188, 'KHANA', 822001, 'arjun7010sharma@gmail.com', '7020107398', '0', '', 394102, 'verified'),
(189, 'BrXtI', 619247, 'mk9414873485@gmail.com', '9414808453', '0', '', 587964, 'verified'),
(190, 'INipB', 455172, 'meghrajmeenarpsf@gmail.com', '8107539089', '47', '', 629628, 'verified'),
(191, 'VsaWc', 810291, '', '8949576956', '0', '', 625642, 'unverified'),
(192, 'Momi', 560975, 'gauravjareda1@gmail.com', '8740044834', '0.5', '', 189269, 'verified'),
(193, 'zPYgK', 141198, 'skverma05072000@gmail.com', '7340405298', '59', '', 982293, 'verified'),
(194, 'qAmnk', 591163, 'Vishnumahawar700@gmail.com', '9694661305', '0', '', 179460, 'verified'),
(195, 'JAI SHREE SHYAM BABA', 66180, 'ravisagarmeena116@gmail.com', '9610878742', '50', '', 603868, 'verified'),
(196, 'URlpU', 681180, 'ravisagarmeena116@gmail.com', '6378150983', '0', '', 132014, 'verified'),
(197, '🆒😎', 176054, 'kamaltajwani4440gmail.com', '9351589005', '0', '', 648032, 'verified'),
(198, 'MBUvF', 392443, '', '9050272567', '0', '', 255532, 'unverified'),
(199, 'Om Namh siway', 230009, 'Mamerijan933@gmail.com', '8058586558', '24.5', '', 755533, 'verified'),
(200, 'Kumar', 992568, 'monuk28988@gmail.com', '8871234624', '0', '', 998005, 'verified'),
(201, '👑👑👑👑❌❌', 765054, 'gorwalkhan3579@gmail.com', '9610565748', '0', '', 483726, 'verified'),
(202, 'pRQnU', 940646, 'rinkumeen04011999@gmail.com', '9166579293', '0', '', 585519, 'verified'),
(203, '🙏❤️💕💕💕🙏', 582826, 'sm837804@gmail.con', '9649675757', '35.5', '', 993867, 'verified'),
(204, 'hYPPZ', 521694, '', '7878461937', '0', '', 170091, 'unverified'),
(205, 'wiybY', 57534, '', '9982238657', '0', '', 537661, 'unverified'),
(206, 'फ़ास्ट खलने वालेआये', 308269, 'kaifnawliya667@gmail.com', '8168853553', '5.5', '', 187270, 'verified'),
(207, 'FcdWF.', 688438, 'munfedkhan94419@gmail.com', '6376071108', '38.5', '', 850300, 'verified'),
(208, 'Jdhd', 70046, 'munfedkhan6975@gmail.com', '6376990630', '0', '', 234142, 'verified'),
(209, 'usfPk', 584384, '', '7340434232', '0', '', 82899, 'unverified'),
(210, 'mwply', 188735, 'prakashagrawal689@gmail.com', '9131477708', '11.5', '', 322720, 'verified'),
(211, 'Kallu ke kaki', 46381, 'Balrammeena0527@gmail.com', '7014448745', '1714', '', 214026, 'verified'),
(212, 'nTYzP', 127745, 'gmonu2805@gmail.com', '9057444887', '14.5', '', 97579, 'verified'),
(213, 'MJTbI', 532757, '', '7878974693', '0', '', 302903, 'unverified'),
(214, 'PypNN', 194954, '', '8619241757', '0', '', 765270, 'unverified'),
(215, 'Raj jareda', 161819, 'waseemhaidar441@gmail.com', '6378429020', '0', '', 373299, 'verified'),
(216, 'Kanu 2', 831256, 'pintumeena20181920@gmail.com', '6376833323', '9', '', 7600, 'verified'),
(217, 'uotGT', 660776, '', '9530351306', '0', '', 423990, 'unverified'),
(218, 'GSxuB', 301067, '', '8209811675', '0', '', 949895, 'unverified'),
(219, 'PrqcI', 29272, '', '9813709383', '0', '', 758914, 'unverified'),
(220, 'BjCxr', 864253, '', '9813709387', '0', '', 621131, 'unverified'),
(221, 'dVBpk', 690846, '', '9050431272', '0', '', 133653, 'unverified'),
(222, 'bntkK', 139661, '', '8955149281', '0', '', 203648, 'unverified'),
(223, 'YGYdk', 559045, '', '9518600093', '0', '', 729484, 'unverified'),
(224, 'HGpwj', 138923, '', '9728888893', '0', '', 253458, 'unverified'),
(225, 'JoPsS', 853507, '', '6376280592', '0', '', 868982, 'unverified'),
(226, 'tuXEV', 795833, '', '8278629965', '0', '', 125789, 'unverified'),
(227, 'DVWlN', 949902, '', '9166421200', '0', '', 105424, 'unverified'),
(228, 'EjPiC', 529863, 'sonasumaiya0786@gamail.com', '9891539764', '0', '', 640719, 'unverified'),
(229, 'xyneq', 838952, '', '9991727628', '0', '', 832249, 'unverified'),
(230, 'SDSoi', 644701, 'dharmrajmeena435@gmail.com', '8239636780', '8', '', 14923, 'verified'),
(231, '786', 534657, 'shokatshoen18@gmail.com', '8426958940', '0.5', '', 100582, 'verified'),
(232, 'Aaaaaja', 5199, 'aalimkhan123@gmail.com', '9996571261', '301.5', '', 511250, 'verified'),
(233, 'goYxF', 808182, '', '9828576674', '0', '', 663636, 'unverified'),
(234, 'Jai masani maa', 425622, 'meenuchauhan4625@gmail.com', '705200000', '1', '', 680316, 'verified'),
(235, 'rihmn', 400244, '', '9671166580', '0', '', 78487, 'unverified'),
(236, 'aFwFq', 566918, '', '8279292038', '100', '', 969511, 'unverified'),
(237, 'WwkqF', 814344, '', '8306932038', '0', '', 134881, 'unverified'),
(238, 'Fffff', 745354, 'sunil9667417999@gmail.com', '9667417999', '20', '', 270982, 'verified'),
(239, '1 NAHI AATA', 410844, 'alisherkhan3786@gmail.com', '9992983786', '0.5', '', 256433, 'verified'),
(240, 'grSPN', 196453, '', '9996089906', '0', '', 747394, 'unverified'),
(241, '007', 297252, 'vm102092@gmail.com', '8503994279', '0.5', '', 352166, 'verified'),
(242, 'Mamata', 570732, '8827509124', '8827509124', '47', '330665', 684747, 'verified'),
(243, 'ocLTW', 691041, '', '9352374013', '0', '', 898599, 'unverified'),
(244, 'Syeja', 627733, '', '8949197953', '0', '', 273267, 'unverified'),
(245, 'mFMKM', 239414, 'virendrasinghrajput805@gmail.com', '9351518658', '14.5', '', 167897, 'verified'),
(246, 'Gjcdg', 206363, 'kashifkhan2395@gmail.com', '7974891755', '0', '', 610942, 'verified'),
(247, 'elkoH', 7722, '', '7581991156', '0', '', 895060, 'unverified'),
(248, 'Lalsot tiger 🐅', 56332, 'vishnumeena969484@gmail.com', '9694843241', '0.5', '399634', 294706, 'verified'),
(249, 'NZoDi', 258013, '', '7340574849', '0', '', 99010, 'unverified'),
(250, 'Utkarsh Kumar', 998644, 'Being.abdur@gmail.com', '9956940786', '247', '', 514868, 'verified'),
(251, 'UxgGN', 667673, 'Sarukkhan98134@gmail com', '9813483463', '0', '', 667851, 'verified'),
(252, 'AJAY MEENA_RJ_34', 606883, 'ajaymeena281004@gmail.com', '9256255256', '6.5', '', 797040, 'verified'),
(253, 'pszWj', 283637, '', '9571918032', '0', '', 623775, 'unverified'),
(254, 'gQVLw', 87592, '', '8000845083', '0', '', 618359, 'unverified'),
(255, 'xdQde', 582891, '', '8279203953', '0', '', 477803, 'unverified'),
(256, 'WpUPr', 649488, '', '8690422412', '0', '', 60522, 'unverified'),
(257, 'vWjzn', 501977, '', '8145344963', '0', '', 281571, 'unverified'),
(258, 'pUAMp', 821287, '', '9671865526', '0', '', 547803, 'unverified'),
(259, 'Badenam', 770903, 'Maimuna akhana2003@gmail.com', '7300210956', '5.5', '', 569181, 'verified'),
(260, 'Minki', 392678, 'vikshanameena@gmail.com', '9079164953', '1', '', 940213, 'verified'),
(261, 'cHUKf', 833620, 'maheshmm9414@gmail.com', '9414223238', '51', '', 923160, 'verified'),
(262, 'Khan Shab', 367301, '', '7690972109', '15.5', '', 550749, 'unverified'),
(263, 'Todabhim', 282929, '', '9785291020', '0', '', 367467, 'unverified'),
(264, 'Dev ji', 241029, 'Sachinkumargurjar1622@gmail.com', '7878463758', '8', '', 327488, 'verified'),
(265, 'uEjTG', 88891, '', '6375554287', '0', '', 632146, 'unverified'),
(266, 'A.k.', 118147, 'Indrajeetgoutam87@gmail.com', '7300467930', '0', '', 687485, 'unverified'),
(267, 'vDAUa', 225197, '', '9610102166', '0', '', 808982, 'unverified'),
(268, 'Soni', 689897, 'sonisystm001@gmail.com', '7877805400', '3', '', 557904, 'verified'),
(269, 'raja5', 872944, 'rssaini01999@gmail.com', '6378422252', '124', '', 497402, 'verified'),
(270, 'Code tu de classic', 415902, 'ramkeshmeena786raj@gmail.com', '9352372322', '9', '', 137536, 'verified'),
(271, 'buwue', 738598, '', '6367477181', '0', '', 11711, 'unverified'),
(272, 'LsOBc', 296462, '', '8561937607', '0', '', 567899, 'unverified'),
(273, 'SK SAINI', 949785, 'shashikantsaini261@gmail.com', '8439641894', '10', '', 544597, 'verified'),
(274, 'VOME', 513240, 'GOPALID175@gmail.com', '6377799346', '0', '', 722117, 'verified'),
(275, 'YCnpH', 430771, '', '7851930487', '0', '', 689541, 'unverified'),
(276, 'rchmw', 293579, '', '7023932124', '0', '', 968510, 'unverified'),
(277, 'Xxx.com', 230163, 'Jkmmeena9@gmail.com', '7734953654', '22', '', 643507, 'verified'),
(278, 'ZxfXI', 952342, '', '7427828026', '0', '', 422577, 'unverified'),
(279, 'Rewad', 34878, 'Lokeshmeena33512@gmail.com', '9636035890', '1', '755533', 657139, 'verified'),
(280, 'oiXKy', 701221, 'layakkhan111@gmail.com', '9667929111', '713.5', '', 163865, 'verified'),
(281, 'No popular bro 😎', 735933, 'ahmeadgorwal55@gmail.com', '8397836606', '985', '', 744996, 'verified'),
(282, 'tnStH', 381850, '', '9571920974', '0', '', 366191, 'unverified'),
(283, 'JgPAT', 803641, 'vm3238762@gmail.com', '9079023287', '0', '', 175170, 'unverified'),
(284, 'uIgOV', 572632, '', '7665334422', '0', '', 850111, 'unverified'),
(285, 'zDzBV', 507469, '', '9912354582', '0', '', 75093, 'unverified'),
(286, 'qBdkE', 684995, '', '9700647461', '0', '', 441863, 'unverified'),
(287, 'Jagdish', 744251, 'nitinmeena6028@gmail.com', '8000430355', '100.5', '', 327377, 'verified'),
(288, 'UEcEF', 194553, 'chauhanjinal02@gmail.com', '9328387897', '44', '', 58775, 'verified'),
(289, 'qHzyK', 85553, '', '7222055507', '0', '', 354930, 'unverified'),
(290, 'DP868 500++', 597521, 'dkbedwal91@gmail.com', '8875790325', '0.5', '', 570003, 'verified'),
(291, 'usSbB', 355934, '', '9664128266', '0', '', 167704, 'unverified'),
(292, 'kLCKA', 800096, '', '8058633839', '0', '', 231821, 'unverified'),
(293, 'fKPPJ', 455849, '', '8529451477', '0', '', 936855, 'unverified'),
(294, 'KbmrA', 912268, '', '8890068410', '0', '', 58743, 'unverified'),
(295, 'Ooo', 328162, 'ssss2933074@gamil.com', '8690811415', '4', '', 125265, 'verified'),
(296, 'zJPlk', 572010, '', '8740086149', '0', '', 722772, 'unverified'),
(297, 'iRPkj', 795128, '', '9462537073', '0', '', 881343, 'unverified'),
(298, 'EvtKS', 992113, '', '7372907264', '0', '', 570387, 'unverified'),
(299, 'GKqJq', 907378, '', '9079475736', '0', '', 901717, 'unverified'),
(300, 'dyjJk', 724891, '', '7001303980', '0', '', 90821, 'unverified'),
(301, 'mSNgX', 698426, '', '7063000675', '0', '', 451294, 'unverified'),
(302, 'LmyIP', 388682, '', '8001305498', '0', '', 530745, 'unverified'),
(303, 'LbSSV', 694843, '', '9602592648', '0', '', 314191, 'unverified'),
(304, 'vnTXn', 382913, 'arjundada6390@gmail.com', '8889262054', '4.5', '', 283588, 'verified'),
(305, 'YxGxl', 791003, 'tk172391@gmail.com', '9694232583', '0', '', 596406, 'verified'),
(306, 'tpSlN', 293679, '', '9057799017', '0', '', 424678, 'unverified'),
(307, 'dnOTr', 810209, '', '8758811299', '0', '', 622026, 'unverified'),
(308, 'Dkdkd', 250967, 'KM185360@GMAIL.com', '8949218735', '0.5', '', 328723, 'verified'),
(309, 'S k', 803502, 'Sapila@gmail.com', '7073997228', '40.5', '', 630015, 'verified'),
(310, 'Eaani', 959404, '', '9991754196', '0', '', 369188, 'unverified'),
(311, 'UbyBb', 316054, '', '9991754188', '0', '', 979192, 'unverified'),
(312, 'GNAwQ', 862850, '', '8690558447', '0', '', 713752, 'unverified'),
(313, 'QBbnh', 718540, 'rohitmewal266@gmail.com', '7850899823', '0', '', 872758, 'verified'),
(314, '🤪🤪🤪😜😜😝🤔😛😛', 883282, 'Sarpu khan 9772@gamail.com', '9772334991', '20', '', 794258, 'verified'),
(315, 'PhNko', 900264, 'aabidkha94720@gmail', '9991574720', '0.5', '', 195201, 'verified'),
(316, 'Wbhjy', 258783, '', '7877769082', '0', '', 828383, 'unverified'),
(317, 'NYLmQ', 392045, '', '7300113812', '0', '', 216551, 'unverified'),
(318, 'SjYzo', 862101, '', '8741981178', '0', '', 108801, 'unverified'),
(319, 'Nikku', 417118, 'Balkrishankumawat2001@gmail.com', '9783408889', '46.5', '', 909432, 'verified'),
(320, 'JARzK', 518406, '', '7297981709', '0', '', 979821, 'unverified'),
(321, 'XHnPM', 60853, '', '9813044425', '0', '', 931981, 'unverified'),
(322, 'SPZWe', 863429, '', '7412825182', '0', '', 783542, 'unverified'),
(323, 'WJHcO', 857991, 'jakamk644@gmail.com', '9992911943', '48.5', '', 308102, 'verified'),
(324, 'MtiYy', 790120, '', '8764090708', '0', '', 78746, 'unverified'),
(325, 'mFZbt', 588376, '', '9024250543', '0', '', 578355, 'unverified'),
(326, 'Anupama', 802364, 'rkb26062002@gmail.com', '6377674906', '0', '', 515164, 'verified'),
(327, 'ZNGFx', 832420, '', '8955996935', '0', '', 220471, 'unverified'),
(328, 'Uxbyx', 834646, 'somujana84@gmail.com', '6294586709', '500.5', '', 589455, 'verified'),
(329, 'UnQZi', 179012, '', '7610865857', '0', '', 282433, 'unverified'),
(330, 'iAeEg', 243787, '', '9875840216', '0', '', 445051, 'unverified'),
(331, 'Zohan khan 786', 883985, 'feroj1030@gmail.com', '9140103263', '47', '', 282934, 'verified'),
(332, 'A 💕', 748055, '8239golu@gmail.com', '9828575945', '0', '', 390998, 'verified'),
(333, 'CkAoz', 813110, '', '8619797690', '0', '', 436395, 'unverified'),
(334, 'uCiUw', 954058, '', '9813068413', '0', '', 860095, 'unverified'),
(335, 'Aoalalagagagaga', 894116, 'Sm3727340@gmail.com', '8854929152', '25.5', '', 252650, 'verified'),
(336, 'ZckAg', 246982, '', '9896600997', '0', '', 912652, 'unverified'),
(337, 'ZoNHH', 284221, '', '8619040447', '0', '', 952809, 'unverified'),
(338, 'Hkyef', 954893, 'sss.rajumeena2352@gmail.com', '6376632352', '0', '', 547954, 'unverified'),
(339, 'bBVwv', 480844, 'mdhanraj177@gmail.com', '7852090295', '6', '', 847083, 'verified'),
(340, 'lSVAe', 200107, '', '8000529496', '0', '', 345905, 'unverified'),
(341, 'VVQGN', 621449, '', '9784015945', '0', '', 682583, 'unverified'),
(342, 'FKhwo', 901898, '', '9462334422', '0', '', 873482, 'unverified'),
(343, 'tWJGD', 517690, 'Harkeshmeena1996m@gimal.com', '8949114826', '8', '', 884098, 'verified'),
(344, 'kFxpL', 917843, '', '9783854286', '0', '', 549694, 'unverified'),
(345, 'SuGAe', 380912, '', '7062224075', '0', '', 470400, 'unverified'),
(346, 'Ziddi hu m', 511078, 'Rinkukumarmeena897@gmail.com', '8209509884', '35', '', 374681, 'verified'),
(347, 'VuHxI', 325520, 'udhamsingh80642@gmail.com', '9455006667', '0.5', '', 166756, 'verified'),
(348, '#₹^%=<', 732089, 'Devkishanmeenameena@gmail.com', '8890809802', '0', '', 801945, 'verified'),
(349, 'pwbcu', 325909, 'ankitsamaaspuriya8683@gmail.com', '7027012516', '48.5', '', 249779, 'verified'),
(350, 'BTgTQ', 473298, '', '9950986972', '43', '', 524861, 'unverified'),
(351, 'K K T', 381389, 'Saniashaikh4503@gamil.com', '9752212812', '40', '', 681004, 'verified'),
(352, 'UEYNx', 919333, '', '7023830904', '0', '', 933048, 'unverified'),
(353, 'dVvTD', 785353, '', '9887265153', '0', '', 748795, 'unverified'),
(354, 'UAITy', 828795, 'kamal8107307678@gmail.com', '8107307678', '0', '', 894462, 'verified'),
(355, 'NFWhA', 320331, '', '7878158093', '0', '', 843530, 'unverified'),
(356, 'घंटा जीतेगा 😜', 522595, 'ghunawatsubham040@gmail.com', '7732829495', '0.5', '', 817498, 'verified'),
(357, 'maSfl', 630576, '', '9588007947', '0', '', 190881, 'unverified'),
(358, 'UNlNP', 336845, '', '7062819764', '0', '', 938374, 'unverified'),
(359, 'S ....', 699827, 'Injikhan@gmail.com', '9053625163', '45', '', 228321, 'verified'),
(360, 'Plbmj', 578110, 'samadali99957@gmail.com', '8307299132', '14.5', '', 209492, 'verified'),
(361, 'jbxNh', 29013, '', '7850059520', '0', '', 331135, 'unverified'),
(362, 'kRvaR', 933577, '', '7988054179', '0', '', 812415, 'unverified'),
(363, 'UjIkL', 505750, 'ratanlalmeena440@gmail.com', '9785957616', '42.5', '', 925484, 'verified'),
(364, 'ZWVBn', 898007, '', '9755112217', '0', '', 874158, 'unverified'),
(365, 'Rvuhk', 641151, '', '8426865346', '0', '', 371305, 'unverified'),
(366, 'YxwXw', 43266, '', '9257525036', '0', '', 594205, 'unverified'),
(367, 'Subm172004', 493742, 'sheetalawasthi165@gmail.com', '8690497817', '44', '', 683114, 'verified'),
(368, 'YlbtQ', 526241, '', '9166097160', '0', '', 60480, 'unverified'),
(369, 'QhyNy', 9054, 'Pv676615@gmail.com', '7665718535', '11.5', '', 325426, 'verified'),
(370, 'Rtcsr', 579452, '', '8003918535', '0', '', 1929, 'unverified'),
(371, 'BoIWD', 236704, '', '6375787661', '6000', '', 942389, 'unverified'),
(372, 'PToCi', 946775, '', '9602256536', '0', '', 123160, 'unverified'),
(373, 'BHqTi', 538876, '', '7991508152', '0', '', 772189, 'unverified'),
(374, 'JrIqK', 941789, '', '9636331705', '0', '', 111762, 'unverified'),
(375, 'cyOqc', 432850, '', '6260943197', '0', '', 231486, 'unverified'),
(376, 'RQMyA', 468197, 'vija.kuma.tail.1992@gmail.com', '8955089719', '18.5', '', 172075, 'verified'),
(377, 'zAdYw', 64821, '', '7728917713', '0', '', 624227, 'unverified'),
(378, 'rotRB', 899096, '', '9050376969', '0', '', 301459, 'unverified'),
(379, 'UOgzM', 908802, '', '9694152100', '0', '', 13357, 'unverified'),
(380, 'Har.ne ke baad call.', 259669, 'aadilkhan41054@gmail.com', '7851845059', '10.5', '', 710900, 'verified'),
(381, 'MsMmq', 288704, '', '7240267906', '0', '', 985944, 'unverified'),
(382, 'EIhzD', 388952, '', '9024517328', '0', '', 630290, 'unverified'),
(383, 'Iyftx', 847339, '', '8295204183', '0', '', 309093, 'unverified'),
(384, 'owiQq', 417037, '', '9166080272', '0', '', 270582, 'unverified'),
(385, 'AdKbY', 270928, 'aleemkhan8629@gmail.com', '8930308629', '0', '', 684189, 'verified'),
(386, 'fZewU', 13817, '', '9024199113', '0', '', 254374, 'unverified'),
(387, 'Ftqdi', 743980, 'madansainath1@gmail.com', '8855837962', '47', '', 736892, 'verified'),
(388, 'आठ झाट ना आए 🤏', 906174, 'bhaid5664@gmail.com', '9424303340', '3.5', '', 330665, 'verified'),
(389, 'jGKbP', 64432, 'ATRASINGH96@GMAIL.com', '9306155657', '36.5', '', 382875, 'verified'),
(390, 'BEKAR HE...', 468914, 'jaykaran4797@gmail.com', '7325046826', '7.5', '640071', 332564, 'verified'),
(391, 'JAYHO....', 669880, 'johnyadav485@gmail.com', '9102202733', '27', '', 640071, 'verified'),
(392, 'EuChe', 111444, '', '9672216809', '0', '', 716695, 'unverified'),
(393, 'CDeTb', 799148, '', '9050421190', '0', '', 965572, 'unverified'),
(394, 'VgSdG', 65015, '', '9660682959', '0', '', 917384, 'unverified'),
(395, 'XWuqQ', 555387, '', '8306192369', '0', '', 581299, 'unverified'),
(396, 'YVBEB', 887140, '', '8769759085', '0', '', 575869, 'unverified'),
(397, 'caisL', 67264, '', '9256733149', '0', '', 657406, 'unverified'),
(398, 'XqRaG', 830845, 'khananish1462@gmail.com', '8955578453', '0', '', 104554, 'verified'),
(399, 'PlhjL', 367046, '', '9027767240', '0', '', 700843, 'unverified'),
(400, 'sDSsT', 835352, '', '8290056306', '35', '', 923164, 'unverified'),
(401, 'Hanuman sahay Meena', 279051, '', '8000098266', '0', '', 525459, 'unverified'),
(402, 'OTfoa', 653601, '', '6299430884', '0', '', 247627, 'unverified'),
(403, 'Hvfii', 794469, 'luckymeena3412@gmail.com', '8955613412', '100', '', 150228, 'unverified'),
(404, 'EtWwM', 788805, 'kuldeepmeena0454@gmail.com', '7877090454', '0', '', 428096, 'verified'),
(405, 'IBjiM', 964802, '', '8302807591', '0', '', 858828, 'unverified'),
(406, 'iUKFp', 451573, '', '8233675788', '0', '', 309342, 'unverified'),
(407, 'TnUwJ', 94480, '', '9929142009', '0', '', 313357, 'unverified'),
(408, 'MBSPF', 348903, '', '9279167728', '0', '', 723646, 'unverified'),
(409, 'jaNth', 720094, '', '8824539995', '0', '', 49159, 'unverified'),
(410, 'annu', 635248, '', '9525262071', '0', '399634', 587061, 'unverified'),
(411, 'TGFPF', 571630, '', '7061896697', '100', '', 171539, 'unverified'),
(412, 'HKugq', 661712, '', '9099260046', '0', '', 228613, 'unverified'),
(413, 'Najir khan', 857004, 'najirkhan96492@gmail.com', '9649277624', '12.5', '', 72817, 'verified'),
(414, 'DDDD', 619796, 'SAHILKHAN334A@GMAIL.COm', '9813375145', '0.5', '', 647660, 'verified'),
(415, 'Aaja Liii', 97975, 'dhanrffgggh@gmail.com', '7014670902', '0', '', 328206, 'verified'),
(416, 'DkmahAr', 8395, '', '7877612728', '0', '', 713210, 'unverified'),
(417, 'Siraj khan', 645970, 'skb291018@gmail.com', '9728029594', '0', '', 148250, 'verified'),
(418, 'gHJzv', 673230, '', '9461071382', '0', '', 188289, 'unverified'),
(419, 'MCWcO', 821592, 'lokeshmeena42458@gmail.com', '8426030705', '1', '', 152224, 'verified'),
(420, 'tIxlv', 972295, '', '7387866317', '0', '', 534966, 'unverified'),
(421, '11k', 766989, 'adityashrivastava0322@gmail.com', '8770416006', '29.5', '', 455972, 'verified'),
(422, 'Zlfib', 932026, '', '7499860317', '0', '', 756775, 'unverified'),
(423, 'qTyLv', 597857, '', '7424994681', '0', '', 987976, 'unverified'),
(424, '121212', 714461, 'mkrajalwal6214@gmail.com', '8058026214', '0.5', '', 183725, 'verified'),
(425, 'xWYGB', 931708, 'Sakeemkhan@gmail.com', '6367552730', '0', '', 436608, 'verified'),
(426, 'Koi to nhi hai', 182828, 'rm1204627@gmail.com', '7878915922', '44', '', 916604, 'verified'),
(427, 'ZrMry', 45606, '', '9588803385', '0', '', 192965, 'unverified'),
(428, 'QXlNL', 673601, '', '9950994816', '0', '', 81486, 'unverified'),
(429, '**** king', 896545, 'tk253472@gmail.com', '7877653814', '42.5', '', 494858, 'verified'),
(430, 'vYbEU', 627334, 'jim824723@gmail.com', '9783727291', '0', '', 252663, 'verified'),
(431, 'IItjs', 327466, '', '8233661545', '0', '', 283415, 'unverified'),
(432, 'kAGjY', 238406, '', '9992298886', '0', '', 487614, 'unverified'),
(433, 'GGKCp', 9241, 'Umashankarmeena357@gmail.com', '9783630011', '47.5', '', 907117, 'verified'),
(434, 'AOMMu', 22870, 'opkanota101@gmail.com', '9610951918', '4', '', 903710, 'verified'),
(435, 'qweaQ', 286299, '', '9079282308', '0', '', 769013, 'unverified'),
(436, 'mFUti', 669503, '', '9694885858', '0', '', 250877, 'unverified'),
(437, 'zNCzd', 984285, '', '7728970940', '0', '', 954411, 'unverified'),
(438, 'DbiEz', 534530, '', '8504974805', '100', '', 613401, 'unverified'),
(439, 'QeuYA', 287786, '', '6375065934', '0', '', 404800, 'unverified'),
(440, 'IlmWO', 362399, '', '6375065934', '0', '', 272556, 'unverified'),
(441, 'mvlwn', 775816, '', '7976437258', '0', '', 850523, 'unverified'),
(442, 'UPejV', 833970, '', '7988585810', '0', '', 438347, 'unverified'),
(443, 'fYwVx', 793023, '', '9530131323', '0', '', 970580, 'unverified'),
(444, 'vNpoH', 57266, '', '9050746739', '0', '', 119530, 'unverified'),
(445, 'OqNXV', 671936, '', '8930988948', '0', '', 287899, 'unverified'),
(446, 'ppdWh', 164373, '', '9771241425', '0', '', 912222, 'unverified'),
(447, 'lHexu', 521368, '', '9685710407', '0', '', 61192, 'unverified'),
(448, 'Dkdkdk', 203833, 'ikhan@gmail.com', '8053014578', '3', '', 128319, 'verified'),
(449, 'PYSTUW', 695641, 'saprash980@gmail.com', '6200645568', '0', '', 437620, 'verified'),
(450, 'XrLto', 848390, '', '8949874839', '0', '', 75298, 'unverified'),
(451, 'bJAWX', 427689, 'Meenadharmendra69@gmail.com', '9772829223', '0', '', 691302, 'verified'),
(452, 'Choudhary', 277627, 'ajitjakhar111@gmail.com', '9050100297', '4.5', '', 220458, 'verified'),
(453, 'IDdgL', 459582, '', '8824410625', '0', '', 316710, 'unverified'),
(454, 'बर्बाद', 869995, 'aalimkhan8600@gmail.com', '9050932926', '3.5', '', 156940, 'verified'),
(455, 'iykkW', 337414, '', '9050932926', '0', '', 292361, 'unverified'),
(456, 'hRUlV', 530434, 'sahabsinghverma261@gmail.com', '9509812040', '2.5', '', 678363, 'verified'),
(457, 'TXXjO', 212340, 'sainip4604@gmail.com', '9216815032', '0', '', 138026, 'verified'),
(458, 'QyRJB', 27282, '', '9395945007', '0', '', 689266, 'unverified'),
(459, 'joDHl', 315299, '', '7878565121', '0', '', 663999, 'unverified'),
(460, 'ZrhVB', 281353, '', '8962782657', '30', '', 247836, 'unverified'),
(461, 'OjmxA', 62444, 'Lokeshmeena33512@gmail.com', '6378327340', '1', '755533', 576645, 'verified'),
(462, 'GgLEh', 784539, 'Bholenath 3692@gmail.com', '8302323840', '2538.5', '732668', 732660, 'verified'),
(463, 'Jahid Akhtar', 530539, 'akhtarjahid5@gmail.com', '9571658953', '9', '', 631801, 'verified'),
(464, 'crKBl', 871545, 'Wajidakraam@gmail.com', '9813856587', '0', '', 650984, 'verified'),
(465, 'HIzZN', 535966, '', '9813856587', '0', '', 649297, 'unverified'),
(466, 'DjqtA', 87467, '', '9813856587', '0', '', 164769, 'unverified'),
(467, 'Hanifboss', 71002, 'hanifkhan322211@gmail.com', '9358226040', '108.5', '', 652276, 'verified'),
(468, 'ipPuM', 227621, 'hanifkhan322211@gmail.com', '9358226048', '299', '', 388476, 'verified'),
(469, 'Raj', 961136, '', '7688878197', '41', '', 684849, 'unverified'),
(470, 'lAbVO', 153177, '', '8878515100', '0', '', 379478, 'unverified'),
(471, 'cSrZr', 965853, '', '6295586709', '0', '', 577338, 'unverified'),
(472, 'Jiazo', 704289, '', '6295586709', '0', '', 1431, 'unverified'),
(473, 'OScLj', 452905, 'mayankmeena4517@gmail.com', '8104711113', '0.5', '', 978800, 'verified'),
(474, 'TdtlL', 938899, '', '8104711113', '0', '', 444192, 'unverified'),
(475, 'IxSGa', 816435, '', '8815328360', '0', '', 159423, 'unverified'),
(476, 'aPQYI', 402801, '', '8815328360', '0', '', 199446, 'unverified'),
(477, 'SJpHS', 663395, '', '8815328360', '0', '', 833687, 'unverified'),
(478, 'wFtxG', 582310, 'amitkasana7742@gmail.com', '7742937196', '0', '', 266389, 'unverified'),
(479, 'WqmaT', 596779, '', '9260929464', '0', '', 162307, 'unverified'),
(480, 'BieJR', 692676, '', '8602407382', '0', '', 33597, 'unverified'),
(481, 'ahveg', 598870, '', '8602407382', '0', '', 130301, 'unverified'),
(482, 'RYtvR', 932532, '', '8602407382', '0', '', 140224, 'unverified'),
(483, 'zuhKK', 658282, '', '8319115519', '0', '', 252749, 'unverified'),
(484, 'BGSpi', 601183, '', '8319115519', '0', '', 566856, 'unverified'),
(485, 'vGZbJ', 88341, '', '8319115519', '0', '', 500940, 'unverified'),
(486, 'Jai bala sa', 857193, 'harimohanmeena20893@gmail.com', '9571011392', '2371.5', '', 346385, 'verified'),
(487, 'Babul ki duaa', 557193, 'Manishkhanna85052@gmail.com', '7410981246', '4', '', 310333, 'verified'),
(488, 'kXavS', 52796, '', '9358920695', '0', '', 893601, 'unverified'),
(489, '100', 624871, 'ajeet787856@gmail.com', '7691839814', '48', '', 738327, 'verified'),
(490, 'xUdUo', 479099, 'chintumahswachintu@gmail.com', '8000885623', '0', '', 133853, 'verified'),
(491, 'upUXf', 299775, '', '9672096840', '0', '', 157695, 'unverified'),
(492, 'WgRIr', 595340, '', '9672096840', '0', '', 768788, 'unverified'),
(493, 'VhwhF', 155108, '', '8949032263', '0', '', 448852, 'unverified'),
(494, 'WtVzw', 34212, '', '9352078180', '0', '', 846942, 'unverified'),
(495, 'QhcGW', 656879, 'noushadmajid3@gmail.com', '9817669616', '0', '', 539345, 'verified'),
(496, 'BkOoS', 58431, 'talimkhan @gmail.com', '8000030736', '47', '', 875376, 'verified'),
(497, 'spDWm', 516875, '', '7611960715', '0', '', 149403, 'unverified'),
(498, 'itzXx', 965030, '', '9509997929', '0', '', 963737, 'unverified'),
(499, 'Mango 🥭🥭🍍', 876441, 'pkgomladu12@gmail.com', '9928443171', '15', '', 938131, 'verified'),
(500, 'XwbQf', 480746, '', '9694572017', '0', '', 289372, 'unverified'),
(501, 'mDwhw', 27339, 'Rabeenkhan540@gmail.com', '8814835540', '47', '', 512373, 'verified'),
(502, 'YoGuz', 56933, '', '6350266284', '106', '', 148787, 'unverified'),
(503, 'Crazy', 100212, 'vijjumeena3393@gmail.com', '9414440613', '5', '', 588331, 'verified'),
(504, 'hehze', 283279, '', '7378131834', '0', '', 895791, 'unverified'),
(505, 'TGHCg', 469047, '', '9050048617', '0', '', 184660, 'unverified'),
(506, 'Qmgjh', 918828, '', '9644496313', '0', '', 500766, 'unverified'),
(507, 'Evtjg', 50181, '', '6350688360', '0', '', 345499, 'unverified'),
(508, 'Risk', 880986, 'salim246@gmail.com', '7240084704', '85', '', 551954, 'verified'),
(509, 'Arsad khan', 260620, 'Arsadkhan07@gmail.com', '8696347534', '35', '', 863569, 'verified'),
(510, 'Gdfh', 279601, '', '8851821237', '24', '', 872957, 'unverified'),
(511, 'IssYZ', 709730, '', '9456162140', '0', '', 408965, 'unverified'),
(512, 'Karan', 664604, 'santoshmeena 8000430355@Gmail.com', '7297932646', '0.5', '', 638882, 'verified'),
(513, 'rKxRz', 887293, '', '9587329705', '0', '', 331144, 'unverified'),
(514, 'XmIAa', 760445, 'rm1803860@gmail.com', '7878489420', '0', '', 262777, 'verified'),
(515, 'ljSDS', 697925, '', '8302552979', '0', '', 948105, 'unverified'),
(516, 'OiuGg', 5948, '', '8503939685', '0', '', 618731, 'unverified'),
(517, 'hDbuv', 715751, '', '8690543171', '15.5', '', 681736, 'unverified'),
(518, 'Klcgjt', 64126, 'sarukhkhan68399@gmail.com', '9587984213', '0.5', '', 62495, 'verified'),
(519, 'BoioO', 377933, '', '9352054424', '0', '', 301196, 'unverified'),
(520, 'kXqcJ', 69596, 'Prince.taneja007@gmail.com', '7877265446', '0', '', 396109, 'verified'),
(521, 'GNNMz', 290132, '', '7073495887', '0', '', 113237, 'unverified'),
(522, 'NgGAn', 984558, '', '7426924081', '0', '', 159150, 'unverified'),
(523, 'yzlyU', 415696, '', '7742649218', '2', '', 457789, 'unverified'),
(524, 'Govjchvkhkx', 60110, 'azizkhan17974@gmail.com', '9996942410', '0', '', 852976, 'verified'),
(525, 'yHHod', 30446, '', '9996942410', '0', '', 128418, 'unverified'),
(526, 'Kdock', 287027, '', '8708417743', '0', '', 468545, 'unverified'),
(527, 'tvKxF', 599083, '', '8708417743', '0', '', 135856, 'unverified'),
(528, 'usQmq', 824755, '', '8708417743', '0', '', 36729, 'unverified'),
(529, 'sjUeN', 639204, 'Khans775741@gmail.com', '7665157015', '42.5', '', 738060, 'verified'),
(530, 'PPCGP', 336255, '', '7728933539', '0', '755533', 119980, 'unverified'),
(531, 'Arvind meena', 925780, 'Tatawatvishwas2@gmail.com', '7891828688', '0.5', '', 430013, 'verified'),
(532, 'Ajay gorda', 904106, 'ajaymeenagorda@gmail.com', '8209075852', '45', '', 155589, 'verified'),
(533, 'Sailent killer', 317884, 'pk6927236@gmail.com', '9602144242', '24.5', '', 612690, 'unverified'),
(534, 'nMjRj', 861083, '', '9079554574', '0', '', 36545, 'unverified'),
(535, 'WRQSc', 677815, '', '8769935037', '0', '', 623077, 'unverified'),
(536, 'oIdmi', 567355, '', '8200536993', '0', '', 23635, 'unverified'),
(537, 'Nhi khelna prkash mc', 937788, 'somendrasharma8432@gmail.com', '9875038921', '1031', '', 172963, 'verified'),
(538, 'NbfTe', 293531, 'Abrarkhan37000@gmail', '9352436074', '5', '', 348386, 'verified'),
(539, 'Manvee', 705937, 'maheshmm9414@gmail.com', '9414263238', '50', '', 337020, 'verified'),
(540, 'KK_DAUSA', 862998, 'Kuldeepmeena', '8441969618', '41.5', '', 538938, 'verified'),
(541, 'Fghfh', 388009, 'arjun7010sharma@gmail.com', '7877943990', '0', '', 637134, 'verified'),
(542, 'hAauS', 792219, '', '8529441874', '0', '', 359782, 'unverified'),
(543, 'pSbwF', 378954, 'khanwasim43763@gmail.com', '6350338872', '0', '', 330599, 'verified'),
(544, 'oUJyr', 699504, '', '9783447139', '0', '', 832910, 'unverified'),
(545, 'DM', 603703, 'mohanchoudhary008@gmail.com', '9610000785', '100', '', 413457, 'verified'),
(546, 'Chal na yaar', 240219, 'fm6550507@gmail.com', '8209848840', '4.5', '', 951670, 'verified'),
(547, 'RuDby', 312919, '', '8299491069', '0', '', 162050, 'unverified'),
(548, 'nPVkg', 455980, 'sarukhkhan68399@gmail.com', '9785071874', '63', '', 554754, 'verified'),
(549, 'Dharm', 744768, '', '7240522892', '0', '', 81539, 'unverified'),
(550, 'gCYnB', 351087, '', '9499372995', '0', '', 836116, 'unverified'),
(551, 'ICSnf', 168635, '', '9508864475', '0', '', 389388, 'unverified'),
(552, 'FVpJh', 613869, '', '9588221390', '5', '', 467815, 'verified'),
(553, 'HlvJU', 192961, '', '8851821337', '0', '', 392811, 'unverified'),
(554, 'Goti gang', 88713, 'Saurabhkhedi7878@gmail.com', '6375692066', '35', '', 331952, 'verified'),
(555, 'Aamir Khan', 542262, '', '9813550225', '0', '', 652338, 'unverified'),
(556, 'Nbgddf', 233335, 'Khans775741@gmail.com', '6367108106', '41', '62495', 443779, 'verified'),
(557, 'Rider mewati', 234279, 'Mohdqayyum7998@gmail.com', '9813538345', '10.5', '', 875570, 'verified'),
(558, 'sell', 734783, 'khardya40@gmail.com', '9571893035', '77', '', 747805, 'verified'),
(559, 'Ys khan', 211730, '', '9992318786', '2', '', 861482, 'unverified'),
(560, 'NO FRESH ID', 595092, 'ramkaranchhareda07@gmail.com', '7014344431', '0.5', '', 48611, 'verified'),
(561, 'nBEBN', 229579, '', '7665544713', '0', '', 783025, 'unverified'),
(562, 'cApnt', 66015, '', '7414065133', '0', '', 893577, 'unverified'),
(563, 'fRcgU', 563587, '', '7740818384', '0', '', 618884, 'unverified'),
(564, 'RnfhD', 930258, '', '6378422255', '0', '618884', 108897, 'unverified'),
(565, 'FiedQ', 771417, '', '7691819142', '0', '', 335530, 'unverified'),
(566, 'Jay Shri sanvariya S', 885096, 'Mukesh22sharma@gmail.com', '9468967606', '17.5', '', 327949, 'verified'),
(567, 'ERNdl', 629788, '', '9813677651', '0', '', 764676, 'unverified'),
(568, 'yNYYn', 321691, '', '9337608926', '0', '', 759658, 'unverified'),
(569, 'Rk', 73966, 'rihankhan869041@gmail.com', '6378546516', '33.5', '916604', 431482, 'verified'),
(570, 'quFCU', 672642, 'momin123@gmail.com', '6378636158', '0', '', 814740, 'verified'),
(571, 'qYEkw', 506107, '', '9813444494', '0', '', 227948, 'unverified'),
(572, 'JzUdq', 479094, '', '9024506098', '0', '62495', 159529, 'unverified'),
(573, 'FcdWF', 27026, '', '8824080696', '3', '', 413189, 'verified'),
(574, 'Oymonish6842', 327886, 'imsajidsajji@mail.com', '9137743283', '99', '90514', 784291, 'verified'),
(575, 'राधे राधे 🙏🙏', 493850, 'shivraj9929523344@gmail.com', '8426849560', '15.5', '', 54887, 'verified'),
(576, 'aaaID', 145130, '', '8619823722', '0', '', 494777, 'unverified'),
(577, 'QQqEL', 738575, '', '8708765227', '0', '', 563428, 'unverified'),
(578, 'QxkDH', 351682, '', '7201998519', '0', '', 201981, 'unverified'),
(579, 'Siya ♥️', 137513, 'rameshchandm1371998@gmail.com', '7023301106', '2', '', 688240, 'verified'),
(580, 'Ravsa', 621787, 'MSSHARMA@gmail.com', '8005747925', '5.5', '276894', 191054, 'verified'),
(581, 'UDXAV', 910082, '', '8306613151', '0', '', 981131, 'unverified'),
(582, 'NaABp', 604795, '', '9680701272', '0', '', 134998, 'unverified'),
(583, 'NUUVZ', 77996, '', '9817055972', '0', '', 417032, 'unverified'),
(584, 'bVKaC', 758130, '', '9829476375', '0', '', 395797, 'unverified'),
(585, 'pyvNI', 835805, 'ankitsamaaspuriya8683@gmail.com', '9518841848', '45.5', '', 543182, 'verified'),
(586, 'rVpjB', 366339, '', '9126978056', '0', '', 178288, 'unverified'),
(587, 'Yash', 385929, 'zvvxvsghd@gmail.com', '8890315654', '0', '', 591814, 'unverified'),
(588, 'bmNKu', 195886, 'vakeelkhan96383@gmail.com', '7419070890', '0', '', 138464, 'verified'),
(589, 'pgfbB', 755919, '', '8107586473', '0', '', 79566, 'unverified'),
(590, 'Nk meena', 296680, 'nareshmeenank9610@gmail.com', '8078645180', '6.5', '', 310703, 'verified'),
(591, 'Gcalh', 609043, '', '8078645180', '0', '', 555070, 'unverified'),
(592, 'FMkJg', 269038, '', '8078645180', '0', '', 399017, 'unverified'),
(593, 'GpBXd', 905173, '', '9610686514', '0', '', 982257, 'unverified'),
(594, 'zfQsJ', 788113, '', '8963893189', '0', '', 962476, 'unverified'),
(595, 'qAzUf', 726322, 'rajnishmeena930@gmail.com', '6375228255', '1.5', '', 158899, 'verified'),
(596, 'ijvad', 618253, '', '7665358303', '0', '', 532472, 'unverified'),
(597, 'Rajkumar', 71668, '', '7568325399', '0', '', 598524, 'unverified'),
(598, 'EJGHC', 331254, '', '9664212905', '0', '', 708242, 'unverified'),
(599, 'hMvWs', 421849, '', '9321487567', '0', '', 935813, 'unverified'),
(600, 'Sam khan', 251447, 'aasam6591@gmail.com', '8209239899', '9.5', '', 654493, 'verified'),
(601, 'SOGRN', 525443, '', '6375136290', '0', '', 891767, 'unverified'),
(602, 'IcDuN', 248983, '', '8905898579', '0', '', 608343, 'unverified'),
(603, 'MdeiC', 727153, '', '7041943366', '0', '', 690317, 'unverified'),
(604, 'gcWDR', 339477, 'aarifkhan8304@gmail.com', '9306909781', '43.5', '', 606440, 'verified'),
(605, 'HSWeW', 547354, '', '8824706025', '0', '', 473040, 'unverified'),
(606, 'AvWDL', 600819, '', '7891353514', '250', '', 250540, 'unverified'),
(607, 'Radhe', 95347, 'kaushalmeena730@gmail.com', '7851840040', '47.5', '', 134388, 'verified'),
(608, 'uZKAu', 49790, '', '8053015976', '0', '', 843536, 'unverified'),
(609, 'DOmqZ', 903525, '', '8949248058', '0', '', 571, 'unverified');
INSERT INTO `tablename` (`id`, `Name`, `otp`, `Email`, `Phone`, `Wallet_balance`, `referral`, `referral_code`, `verified`) VALUES
(610, 'BPRaf', 479229, '', '9817740792', '0', '', 794641, 'unverified'),
(611, 'QwELZ', 445229, '', '7891066721', '0', '', 923333, 'unverified'),
(612, 'KofVn', 793819, '', '8708015421', '0', '', 691170, 'unverified'),
(613, 'doBUd', 308132, '', '9772543725', '0', '', 318328, 'unverified'),
(614, 'EwWAm', 33088, '', '9050102087', '0', '', 144190, 'unverified'),
(615, 'GQKch', 370673, '', '7878120413', '0', '', 537695, 'unverified'),
(616, 'dEFjy', 785178, '', '7878120413', '0', '', 680094, 'unverified'),
(617, 'YcbWv', 951818, '', '7878120413', '0', '', 515378, 'unverified'),
(618, 'HwXMY', 147752, '', '9587724235', '0', '', 419195, 'unverified'),
(619, 'yzvlb', 598367, '', '8094898670', '0', '', 134807, 'unverified'),
(620, 'AGWIu', 28379, '', '7340141709', '0', '', 945362, 'unverified'),
(621, 'bQmDa', 765743, '', '8279218656', '0', '', 75479, 'unverified'),
(622, 'Boss', 658932, 'Bhardwajom195@gmail.com', '6378011897', '1035.5', '', 898927, 'verified'),
(623, 'ZZkNZ', 361957, '', '9828123197', '0', '', 13860, 'unverified'),
(624, 'ZfEQx', 439147, '', '9828123197', '0', '', 358179, 'unverified'),
(625, 'QFjZg', 109144, 'jsk483681@gmail.com', '9306434378', '10.5', '', 836696, 'verified'),
(626, 'EtJty', 563205, '', '9812132416', '0', '', 187161, 'unverified'),
(627, 'elHGl', 315764, '', '9376552837', '0', '', 669313, 'unverified'),
(628, 'OPfta', 688035, 'ARBAJKHAN0686AGMAIl:COm', '9784629686', '0', '', 980503, 'verified'),
(629, 'wahgg', 27154, 'rakeshsaini902494@gmail.com', '9024947760', '0', '', 396306, 'verified'),
(630, 'jErwI', 815677, 'mk5995620@gmail.com', '7340341454', '0.5', '', 193273, 'verified'),
(631, 'SwUaV', 521822, '', '7340341454', '0', '', 127646, 'unverified'),
(632, 'Only.classic', 377554, 'Abhishekx7tiwari@gmail.com', '9079110800', '45.5', '', 516544, 'verified'),
(633, 'oYcqd', 656117, '', '9352169078', '0', '', 510776, 'unverified'),
(634, 'yvImB', 931353, 'Dharmendrasingh76490@gmail', '7062042548', '9.5', '', 696519, 'verified'),
(635, 'JeKEW', 837580, 'ugupta059@gmail.com', '7000451390', '3303', '', 735166, 'verified'),
(636, 'bPXaf', 508306, '', '9050128929', '0', '', 554149, 'unverified'),
(637, 'mJqMu', 221233, '', '7734846791', '0', '', 660823, 'unverified'),
(638, 'Rijwankhan', 371972, 'rijwankhan4252@gmail.com', '9950446457', '297', '', 908394, 'verified'),
(639, 'YFQqB', 96880, '', '8560842009', '0', '', 985041, 'unverified'),
(640, 'ckClF', 251016, '', '9587546563', '0', '', 711587, 'unverified'),
(641, 'Ashok Meena', 192572, 'ashokmeena80807@gmail.com', '9694808071', '0', '', 492179, 'verified'),
(642, 'ofETI', 819191, '', '9829689315', '0', '', 420286, 'unverified'),
(643, 'vDdLV', 808305, 'rahulkumarmeena0123456799@gmail.com', '8058462327', '0', '', 463740, 'verified'),
(644, 'ncQmG', 461409, '', '8058462327', '0', '', 127745, 'unverified'),
(645, 'qdNUp', 434839, '', '8058462327', '0', '', 634596, 'unverified'),
(646, 'UeqNp', 540511, '', '8058462327', '0', '', 813892, 'unverified'),
(647, 'ObXDu', 72244, '', '8058851674', '0', '399634', 794999, 'unverified'),
(648, 'Game cancel', 893510, '', '8690028840', '0.5', '399634', 858270, 'unverified'),
(649, 'VAZzK', 832964, 'Rinkukumarmeena897@gmail.com', '9782872966', '0', '399634', 438370, 'verified'),
(650, 'tLQHK', 882061, '', '9782872963', '0', '', 463866, 'unverified'),
(651, 'rJZaE', 97821, '', '8875956446', '0', '399634', 839746, 'unverified'),
(652, 'MKvKM', 529752, '', '9219936571', '0', '', 772160, 'unverified'),
(653, 'WwWAM', 235379, '', '9696682039', '0', '', 229349, 'unverified'),
(654, 'fOYTy', 807539, '', '9219936572', '0', '', 620618, 'unverified'),
(655, 'aFHfl', 281664, '', '8769596271', '21.5', '755533', 358926, 'unverified'),
(656, 'fPVSx', 205986, '', '6367140618', '0', '', 603989, 'unverified'),
(657, 'qFLBL', 965836, '', '8875956465', '10100', 'null', 514653, 'unverified'),
(658, 'SbAsE', 437798, '', '8875956466', '0', '399634', 59882, 'unverified'),
(659, 'rKdkY', 673444, '', '8875956467', '0', '399634', 864944, 'unverified'),
(660, 'wxnOz', 41168, '', '8875956468', '0', '399634', 328693, 'unverified'),
(661, 'ePPDg', 364736, '', '8875956469', '0', '399634', 107164, 'unverified'),
(662, 'hCzEN', 521688, '', '8875956470', '0', '399634', 361967, 'unverified'),
(663, 'wLlnE', 622468, '', '8875956471', '0', '399634', 883650, 'unverified'),
(664, 'Bqxlr', 874586, '', '8875956472', '0', '399634', 254545, 'unverified'),
(665, 'ScNTn', 484360, '', '8875956473', '0', '399634', 945028, 'unverified'),
(666, 'EAiws', 862252, '', '8875956474', '0', '399634', 786675, 'unverified'),
(667, 'nGvVu', 169690, '', '9024742722', '0', '', 944793, 'unverified'),
(668, 'DolBJ', 240134, '', '9875290366', '32', '', 694015, 'unverified'),
(669, 'VHhie', 388826, '', '8209011423', '0', '', 913375, 'unverified'),
(670, 'tlbLb', 708786, '', '8441925567', '0', '', 232589, 'unverified'),
(671, 'gvDfK', 531960, '', '7239974576', '0', '', 982511, 'unverified'),
(672, 'iFVzI', 311209, '', '9694320949', '0', '', 725901, 'unverified'),
(673, 'rghRB', 376747, 'ashokkhatana378@gmail.com', '7665766088', '47', '', 895638, 'verified'),
(674, 'Ntdgq', 847560, '', '6377746610', '0', '', 623698, 'unverified'),
(675, 'Rahulrd', 988627, 'rahulbarwarsuperkingrj23@gmail.com', '9667592791', '0.5', '', 103400, 'verified'),
(676, 'eqMkW', 907784, '', '9929503461', '0', '', 329428, 'unverified'),
(677, 'Amit', 696241, 'GHANSHYAMMEENA2089@GIMAL.COM', '9571923800', '364.5', '', 678256, 'verified'),
(678, 'Rummy book', 831851, 'shashiduggal10@gmail.com', '9729090910', '15.5', '', 625249, 'verified'),
(679, 'jMjhM', 706826, '', '7988865349', '0', '', 919761, 'unverified'),
(680, 'Sayari Gurjar', 866039, 'Dilrajg89@gmail.com', '8302946736', '0', '', 492398, 'verified'),
(681, '5523', 911134, 'Kamalmeena0495@gmail.com', '8766662866', '250.5', '', 947576, 'verified'),
(682, 'tSRYW', 361456, '', '8018956942', '0', '', 65319, 'unverified'),
(683, 'wQGOS', 473308, 'ravimeena38578100303@gmail.com', '9079289544', '0.5', '', 533115, 'verified'),
(684, 'Aaja vera', 799855, 'dhanrajmeena968399@gmail.com', '6376057095', '14837.5', '', 184227, 'verified'),
(685, 'AajAa', 25041, 'dhsdfhbbbn@gmail.com', '9929909200', '0', '', 382656, 'verified'),
(686, 'RSfOV', 717365, 'SaifAli Khan68659@gamil.com', '9813760355', '1', '', 570606, 'verified'),
(687, 'Gardish', 442874, 'Smartymanojkr@gmail.com', '8383916460', '6.5', '', 219596, 'verified'),
(688, 'UJtFK', 7440, '', '8383916460', '0', '', 177776, 'unverified'),
(689, 'pzoPU', 269106, '', '8383916460', '0', '', 799648, 'unverified'),
(690, 'Zxcvj', 856489, 'arbazman9@gmail.com', '9131677933', '1', '330665', 410526, 'verified'),
(691, 'xMqki', 752950, 'Atalsinghal8955@gmail.com', '9928788080', '-2481.5', '', 969282, 'verified'),
(692, 'No fresh ok', 788170, 'narendrameena01331193@gmail.com', '6378215739', '1001', '', 668237, 'verified'),
(693, 'jyzYH', 416651, '', '9057500121', '0', '', 136786, 'unverified'),
(694, 'bxUGW', 757571, '', '6378263451', '0', '', 582979, 'unverified'),
(695, 'ykgrE', 799359, '', '9050022355', '0', '', 256578, 'unverified'),
(696, 'SsAUi', 197913, '', '9672104482', '0', '', 521631, 'unverified'),
(697, 'AnRDs', 760152, 'Sanamkhan@gmail.com', '9817546807', '0', '', 367504, 'verified'),
(698, 'Royal', 953379, 'Brandbaghodiya', '7988881865', '4161', '', 497774, 'verified'),
(699, 'Tera yrr', 64803, 'jansisaiwar@gmail.com', '9829375824', '44', '', 499649, 'verified'),
(700, 'KcRbJ', 498916, '', '7688986319', '0', '', 707890, 'unverified'),
(701, 'DdchD', 694292, '', '9509688521', '0', '', 974250, 'unverified'),
(702, 'AHvsZ', 541047, '', '8824664976', '255', '', 229038, 'unverified'),
(703, 'FUnYJ', 682947, '', '9812859965', '0', '', 847572, 'unverified'),
(704, 'IFJqj', 140428, 'mohinkhanmilakpuri@gmail.com', '9694430951', '0', '', 747390, 'verified'),
(705, 'egaIz', 129496, 'teekammeena138@gmail.com', '7737192750', '31', '', 88748, 'verified'),
(706, 'fQMZf', 564139, '', '7014881447', '0', '', 12163, 'unverified'),
(707, 'xFiGK', 224374, '', '9928018506', '0', '', 632144, 'unverified'),
(708, 'DnZPX', 522177, '', '9991290271', '0', '', 15969, 'unverified'),
(709, 'uQYYS', 35329, '', '9813630220', '0', '', 299359, 'unverified'),
(710, 'wRpnd', 497864, '', '8000931305', '0', '', 496868, 'unverified'),
(711, 'crbPd', 882818, '', '9660931730', '0', '755533', 305309, 'unverified'),
(712, 'UPauc', 60449, 'khanmoin1553@gmail.com', '7849935803', '0', '', 236155, 'verified'),
(713, 'wrjOA', 920832, '', '9694785756', '0', '', 48354, 'unverified'),
(714, 'NdOdc', 498346, '', '9694785756', '0', '', 312641, 'unverified'),
(715, 'qFltK', 771720, '', '9694785756', '0', '', 479701, 'unverified'),
(716, 'SbzGt', 735125, '', '9694785756', '0', '', 947084, 'unverified'),
(717, 'HfnrM', 673916, 'mchintu029@Eamil.com', '9257418458', '0', '', 721334, 'unverified'),
(718, 'Must', 597960, 'mustkeemmansoori44@gmail.com', '8742886448', '0', '', 629747, 'verified'),
(719, 'nmHCp', 764016, 'mbijendra24@gmail.com', '9256090681', '0.5', '694015', 762897, 'verified'),
(720, 'QdDwf', 577470, '', '9350656587', '0', '', 430374, 'unverified'),
(721, 'Bhai jeet apki', 361900, 'madhav.mandal3535@gmail.com', '9205535635', '0', '', 484024, 'verified'),
(722, 'Aarij-pahat', 89031, 'nasirkhan9887480344@gmail.com', '9887480344', '0', '', 425930, 'verified'),
(723, 'pMACQ', 316718, '', '9991090407', '0', '', 140317, 'unverified'),
(724, 'dnmrA', 547120, '', '9351717085', '0', '', 977532, 'unverified'),
(725, 'bwveJ', 646169, 'Kamalmeenakm786@gmail.com', '9829969397', '0', '', 846460, 'verified'),
(726, 'yxmNX', 845689, '', '6367520059', '0', '', 49273, 'unverified'),
(727, 'Classic only', 39217, '', '6367366422', '44', '', 810594, 'unverified'),
(728, 'murWL', 29129, '', '8949987115', '0', '', 717077, 'unverified'),
(729, 'RgJVS', 303487, '', '8426887476', '0', '', 102899, 'unverified'),
(730, 'zZall', 383885, 'khanmajid46785@gmail.com', '9034426832', '0', '', 367005, 'verified'),
(731, 'kZWcP', 898558, '', '9053715367', '0', '', 132729, 'unverified'),
(732, 'JWoDW', 284350, '', '9257448746', '0', '', 868863, 'unverified'),
(733, 'LRhPW', 399062, 'kujaffar47@gmail.com', '9034816019', '8', '', 827112, 'verified'),
(734, 'kdxny', 136594, 'AABID', '9253201488', '7', '', 695911, 'verified'),
(735, 'O', 328205, 'rukmudeen65701@gmail.com', '6376065701', '0', '', 604216, 'verified'),
(736, 'RJ29', 87278, 'Abhishek meena', '7427066397', '0.5', '', 476324, 'verified'),
(737, 'XAKJi', 344729, '', '9050992573', '0', '', 874742, 'unverified'),
(738, 'iwaNh', 823381, 'srk77569@gmail.com', '8930857064', '0.5', '', 794923, 'verified'),
(739, 'kBlus', 958326, '', '8814079333', '0', '', 142100, 'unverified'),
(740, 'VDDju', 531414, '', '7878704450', '0', '', 415210, 'unverified'),
(741, 'fDGaF', 68838, '', '9050160576', '0', '', 693841, 'unverified'),
(742, 'XsJUI', 294953, 'Tahirkhan08410@gmail.com', '6376308410', '0', '', 725249, 'verified'),
(743, 'xwKtL', 844910, '', '6376308410', '0', '', 43824, 'unverified'),
(744, 'HXNnI', 571164, '', '6376308410', '0', '', 377066, 'unverified'),
(745, 'VytgM', 847488, '', '6376308410', '0', '', 369060, 'unverified'),
(746, 'DnqTa', 74410, '', '6376308410', '0', '', 683291, 'unverified'),
(747, 'Ppvwf', 859474, '', '6376308410', '0', '', 889044, 'unverified'),
(748, 'vomjv', 305709, '', '6376308410', '0', '', 97866, 'unverified'),
(749, 'PKTZt', 480675, '', '6376308410', '0', '', 239739, 'unverified'),
(750, 'Alisha', 720143, 'Prahladmeena1995@gamail.com', '9785702212', '15', '691732', 974144, 'verified'),
(751, 'NVFev', 590601, '', '7404862638', '0', '', 82873, 'unverified'),
(752, 'sjPIT', 477522, 'Tahirkhan08410@gmail.com', '7737897159', '7', '', 767100, 'verified'),
(753, 'xsraj', 925852, '', '9896737293', '0', '', 361640, 'unverified'),
(754, 'JAI SHREE SYAMA', 909880, 'mukeshmataji@gamil.com', '9785340662', '32', '691732', 226724, 'verified'),
(755, 'EDsKt', 700444, '', '9050352986', '0', '', 337081, 'unverified'),
(756, 'Kismat 🥲', 969115, 'ADILKHANPHARMACY2017@gmail.com', '9050951261', '0.5', '511250', 362392, 'verified'),
(757, 'MUNNA MAYKAL', 120008, 'munnabhai271994@gmail.com', '9785659507', '0', '', 386432, 'verified'),
(758, 'oTSoc', 854027, 'dilshadkhan9300@gmail.com', '8053879148', '0', '', 254886, 'unverified'),
(759, 'EEsqy', 457813, '', '8053879148', '0', '', 462750, 'unverified'),
(760, 'JQlpC', 48481, 'sharmasachin24899@gmail.com', '9680984912', '0', '', 834997, 'verified'),
(761, 'Ggvy', 374919, 'mewatiirsadkhan25@gmail.com', '7665092298', '585', '', 811888, 'verified'),
(762, 'XPorZ', 185636, '', '8222063756', '0', '', 589845, 'unverified'),
(763, 'vdbte', 665116, '', '7878470981', '0', '', 630888, 'unverified'),
(764, 'Iisbt', 315598, 'karnisingh9934@gmail.com', '9057294043', '0', '', 302319, 'pending'),
(765, 'yuwDP', 262485, '', '9682162752', '0', '', 738308, 'unverified'),
(766, 'svNYH', 794327, '', '1234567890', '0', '', 111637, 'unverified'),
(767, 'gGKMA', 253817, 'danishdx336@gmail.com', '8279273450', '0', '', 439842, 'unverified'),
(768, 'KZdTl', 877306, '', '8168037643', '0', '', 831199, 'unverified'),
(769, 'eulIO', 404460, '', '9991204441', '0', '', 188968, 'unverified'),
(770, 'TbqGd', 475893, 'Ashumansuri99@gmail.com', '9664488749', '0', '', 39226, 'verified'),
(771, 'ADeia', 182297, '', '8058655696', '0', '', 933770, 'unverified'),
(772, 'NrgHq', 314035, '', '9910911787', '4', '', 7795, 'unverified'),
(773, 'iMtBf', 164296, '', '7015282034', '0', '', 120371, 'unverified'),
(774, 'CDBSP', 187148, '', '8929369186', '0', '', 957913, 'unverified'),
(775, 'rvRAG', 468702, 'khanw82312@gmail.com', '9079332794', '24', '', 823545, 'verified'),
(776, 'BvAHi', 342186, '', '9812727628', '0', '', 804646, 'unverified'),
(777, 'Ram', 436869, '', '7240383996', '0', '', 957254, 'unverified'),
(778, 'LkpdB', 885162, '', '9785221207', '0', '', 936629, 'unverified'),
(779, 'QbyhV', 913339, '', '7877612758', '0', '', 105984, 'unverified'),
(780, 'VIKRAM HARDI', 52590, 'sanjuvikram496@gmail.com', '8094394431', '0', '', 312412, 'verified'),
(781, 'Sardar', 408567, 'dhoolchandmeena9950@gmail.com', '7791931744', '20.5', '', 404877, 'verified'),
(782, 'Aaja yaar bhai', 357462, 'sainlokeshkhedi829085@gmail.com', '8290852895', '15', '', 385082, 'verified'),
(783, 'qTtnI', 440746, '', '6375857261', '0', '', 365029, 'unverified'),
(784, 'DskyU', 720556, '', '9216558226', '0', '', 527025, 'unverified'),
(785, 'IRcRs', 610917, 'meenababulal576@gmail.com', '7665880619', '0', '', 403177, 'verified'),
(786, 'aqVeN', 829702, 'Kgurjar10969@gmail.com', '7568298459', '3', '', 200206, 'verified'),
(787, 'hWUmL', 160301, '', '7357498831', '0', '', 972828, 'unverified'),
(788, 'diDZD', 851704, '', '9728371261', '0', '', 206015, 'unverified'),
(789, 'Classiconly007', 433175, 'jangidchetan134@gmail.com', '9983940852', '44', '', 601649, 'verified'),
(790, 'DAvGO', 692574, '', '7404057007', '0', '', 559498, 'unverified'),
(791, 'rpsXq', 865127, 'barketkhanmewati@gmail.com', '7374964584', '2', '', 303546, 'verified'),
(792, 'OjEGK', 794003, '', '6375706127', '5', '', 874176, 'unverified'),
(793, 'ASNsj', 645862, '', '7000758715', '0', '', 487981, 'unverified'),
(794, 'MrnVq', 511199, '', '9671561073', '0', '', 725211, 'unverified'),
(795, 'Ravindra', 741929, 'choudharysajjan5077@gmail.com', '9772175077', '0.5', '', 58782, 'verified'),
(796, 'Karan chor hai sala', 984025, 'prehladsinghsingh@gmail.com', '9991144864', '10.5', '', 303695, 'verified'),
(797, 'YDKRV', 129085, '', '7891759557', '0', '', 881637, 'unverified'),
(798, 'oucMX', 862066, '', '7878556167', '0', '', 801212, 'unverified'),
(799, 'Ldkcg', 310545, '', '7878556167', '0', '', 874022, 'unverified'),
(800, 'OTKqJ', 705439, '', '7878556167', '0', '', 688996, 'unverified'),
(801, 'TfDeY', 855201, '', '7878556167', '0', '', 485154, 'unverified'),
(802, 'aPtZt', 614336, '', '7878556167', '0', '', 119338, 'unverified'),
(803, 'wsfqC', 413257, '', '7878556167', '0', '', 442547, 'unverified'),
(804, 'tvdkj', 341223, '', '7878556167', '0', '', 804881, 'unverified'),
(805, 'qnHMA', 396117, '', '7878556167', '0', '', 452529, 'unverified'),
(806, 'ksKur', 248982, '', '7878556167', '0', '', 923414, 'unverified'),
(807, 'AdPNK', 873342, '', '9875115991', '8', '', 903929, 'unverified'),
(808, 'BfIUz', 214695, '', '9414171725', '0', '957254', 688777, 'unverified'),
(809, 'LCEdz', 387369, '', '8081509897', '0', '815554', 638235, 'unverified'),
(810, 'SWKTg', 809874, '', '8740065078', '0', '', 493488, 'unverified'),
(811, 'GK (No Fresh ID)', 985273, 'gpofficial236@gmail.com', '7015187967', '0', '', 335620, 'verified'),
(812, 'PkArT', 340575, '', '7073846078', '0', '', 293603, 'unverified'),
(813, 'PFLRf', 113878, '', '8904105969', '0', '', 421352, 'unverified'),
(814, 'VlHWl', 765872, '', '7877625067', '0', '', 46479, 'unverified'),
(815, 'PUSHPA RAJ', 811032, 'aashishjangid86900@gmail.com', '8690024150', '28.5', '', 233584, 'verified'),
(816, 'hbCFu', 621149, '', '8726080604', '0', '', 545176, 'unverified'),
(817, 'Warish6842', 991969, 'khanwarish39211@gmail.com', '9992893691', '0.5', '90514', 7236, 'verified'),
(818, 'UEjgN', 394596, '', '6376057092', '0', '', 123594, 'unverified'),
(819, 'VLddG', 47895, 'bharatlalm346@gmail.com', '8003629737', '0', '', 586007, 'verified'),
(820, 'oCCLv', 200915, '', '7240794233', '0', '', 500263, 'unverified'),
(821, 'Zaaaw', 377502, 'harkeshmeena759@gmail.com', '6378139468', '247', '', 875550, 'verified'),
(822, 'CrrFX', 49324, '', '9783065131', '0', '', 721732, 'unverified'),
(823, 'sGPNk', 338183, '', '9783065103', '0', '', 230180, 'unverified'),
(824, 'Raju', 438662, '', '6378457717', '38.5', '', 406729, 'unverified'),
(825, 'JUFNz', 502909, '', '7878848661', '0', '230180', 488794, 'unverified'),
(826, 'KVUIV', 626437, 'meenagokul107@gmail.com', '9256842389', '0.5', '', 201680, 'verified'),
(827, 'RAMRAJ MEENA', 386397, 'rmchanda29@gmil.com', '7062932116', '0.5', '', 5832, 'verified'),
(828, 'HKspQ', 867191, '', '9376819110', '0', '', 432316, 'unverified'),
(829, 'cjxBV', 399255, '', '9982775947', '0', '', 103232, 'unverified'),
(830, 'ddxlu', 901165, '', '9982775947', '0', '', 799332, 'unverified'),
(831, 'lBLau', 220667, '', '9982775947', '0', '', 749349, 'unverified'),
(832, 'LRXKk', 442531, '', '9982775947', '0', '', 903087, 'unverified'),
(833, 'mfNUH', 541931, '', '9982775947', '0', '', 351755, 'unverified'),
(834, 'dJsTi', 466525, '', '9982775947', '0', '', 172027, 'unverified'),
(835, 'vQLCH', 512577, 'khanaakil3881@gmail.com', '8302205972', '0', '', 218082, 'verified'),
(836, 'MEV', 235504, 'imarmankhan7100@gmail.com', '8302333582', '9.5', '', 956458, 'unverified'),
(837, 'pClZH', 80927, '', '8055686464', '0', '', 836431, 'unverified'),
(838, 'Babu 2', 656839, 'asivastav0146@gmail.com', '9305664390', '0', '', 491134, 'verified'),
(839, 'kWJBd', 973362, '', '9729763598', '0', '', 724019, 'unverified'),
(840, 'Pay Leger hogi', 560781, 'Nisarkhan6475@gmail.com', '9817497957', '6.5', '', 858621, 'verified'),
(841, 'tmqJH', 192533, 'meenadilkush1444@gmail.com', '8306265490', '19', '755533', 534834, 'verified'),
(842, 'Rony', 993802, 'rahulsattawan9882@gmail.com', '9116854949', '0.5', '', 211169, 'verified'),
(843, 'Here here', 201043, 'erfanmohlaka@gmail.com', '9991139727', '13', '', 767678, 'verified'),
(844, 'poRuu', 3293, '', '9784977752', '38', '', 551314, 'unverified'),
(845, 'NrZfV', 506876, '', '8053838837', '0', '', 571838, 'unverified'),
(846, 'qrsnw', 59480, '', '8285879742', '0', '', 84908, 'unverified'),
(847, 'VZPXh', 516572, '', '8869089395', '0', '', 276881, 'unverified'),
(848, 'Rider', 702583, 'Chaudharyvinay601@gmail.com', '8285849742', '0', '', 503291, 'verified'),
(849, 'tezTB', 618652, '', '9813871393', '0', '', 933514, 'unverified'),
(850, 'VXSmG', 737827, 'gujjarrandheer62@gmail.com', '7357383299', '0.5', '', 409644, 'verified'),
(851, 'PoLjj', 473328, '', '9950766952', '0', '', 608890, 'unverified'),
(852, 'zbRou', 700818, '', '9509164358', '0', '', 706907, 'unverified'),
(853, 'HyvEz', 525229, '', '8058724176', '0', '', 422933, 'unverified'),
(854, 'Nasir-Aarij', 554567, 'aakilkhan2006@gmail.com', '7015803428', '7', '425930', 184799, 'verified'),
(855, 'TCSPY', 934481, '', '9680284816', '0', '', 198707, 'unverified'),
(856, 'gQCeY', 62336, 'rkbabudausa143@gmail.com', '9950566399', '2.5', '', 219708, 'verified'),
(857, 'GmcNM', 207093, '', '7229835153', '0', '', 41, 'unverified'),
(858, 'Jai shree ram', 683058, 'vv2462154@gmail.com', '9782646280', '1', '', 276736, 'verified'),
(859, 'LMBJB', 286848, '', '7338905710', '0', '', 840580, 'unverified'),
(860, 'OuBFQ', 609236, '', '8950136616', '0', '', 348338, 'unverified'),
(861, 'WOMma', 409596, '', '9521231433', '0', '', 703617, 'unverified'),
(862, '❤️Ajay gorda💞', 867954, 'loleshmeena944@gmail.com', '9982063749', '0', '', 242081, 'unverified'),
(863, '❤️❤️', 536923, 'Tinkalgunawat@gmail.com', '9950042344', '1', '', 278856, 'unverified'),
(864, 'imjOi', 457489, '', '8302502247', '0', '', 672463, 'unverified'),
(865, 'Rj 29', 799574, 'rakeshmeena64870@gmail.com', '7851034940', '1', '', 162983, 'verified'),
(866, 'QjPpa', 111709, '', '7976432610', '0', '', 945411, 'unverified'),
(867, 'ayUjY', 293270, 'akhlak9050611581@gmail.com', '9050611581', '0', '', 67600, 'pending'),
(868, 'TGmNi', 55401, '', '9509962181', '0', '', 265932, 'unverified'),
(869, 'Saleem Mewati', 666683, 'Khans010261@gmail.com', '9813287450', '0', '', 886574, 'verified'),
(870, 'wwQyk', 890094, '', '8233191837', '0', '', 518636, 'unverified'),
(871, 'Ludo king', 294181, 'nr716571@gmail.com', '8233898511', '0', '', 938811, 'verified'),
(872, 'xKiJM', 599924, 'rkkhan3853agamil.com@gmail.com', '7737303502', '0', '', 187692, 'verified'),
(873, 'ACIIz', 258731, '', '9057616278', '0', '', 316518, 'unverified'),
(874, 'HPejX', 600686, '', '9509401634', '0', '', 86243, 'unverified'),
(875, 'Viraj', 96742, '', '8862028713', '0', '', 820188, 'unverified'),
(876, 'aNFJZ', 783136, '', '9785570297', '0', '', 138040, 'unverified'),
(877, 'ymCAM', 517270, 'khans494263@gmail.com', '7734851824', '47', '', 288912, 'verified'),
(878, 'UMsmo', 146334, '', '7877630139', '0', '', 519429, 'unverified'),
(879, 'zkSpN', 401164, '', '6367812267', '0', '', 119098, 'unverified'),
(880, 'Xyz 000', 853312, 'khankadir6205@gmail.com', '8059005392', '42.5', '', 994660, 'verified'),
(881, 'wAcmK', 233962, '', '9680079500', '0', '', 154845, 'unverified'),
(882, 'kjrAr', 922361, '', '6261992269', '0', '', 749957, 'unverified'),
(883, 'Yogesh', 470614, 'yogeshkumarmeena665@gmail.com', '8005524236', '0', '', 752318, 'verified'),
(884, 'AZoOP', 865942, 'mahendrameena16329@gmail.com', '9116072194', '0', '', 279717, 'verified'),
(885, 'yJeQv', 764267, 'khanfardeen59758@gamil.com', '7027214770', '6', '', 984562, 'verified'),
(886, 'Samrat Singh', 207430, 'neeraj.singh54354@gmail.com', '9795122170', '46', '', 413938, 'verified'),
(887, 'Aahil classes mein a', 420747, 'kasimkhan198@gmail.com', '8595161522', '2.5', '', 447623, 'verified'),
(888, 'YXtzi', 246532, '', '9664129455', '0', '', 140179, 'unverified'),
(889, 'KDBZY', 107353, '', '8233724234', '0', '', 33537, 'unverified'),
(890, 'QEszG', 914316, '', '9680903590', '0', '', 760484, 'unverified'),
(891, 'HgyNU', 513662, '', '9672198452', '0', '', 796465, 'unverified'),
(892, 'Xhxjn', 659802, 'kepiyev212@bcnwalk.com', '8107644832', '100', '', 244549, 'verified'),
(893, 'PxeeB', 265743, '', '9672198454', '0', '', 455291, 'unverified'),
(894, 'WXMji', 757812, '', '9649125627', '0', '', 852451, 'unverified'),
(895, 'yPgJY', 427055, '', '9649397390', '0', '', 27749, 'unverified'),
(896, 'aIdYa', 397753, '', '8233380807', '0', '', 132256, 'unverified'),
(897, 'aTGsS', 698982, '', '8696512627', '0', '', 947818, 'unverified'),
(898, 'Aahil khan', 315102, 'Aumar9520@gmail.com', '8058281786', '0', '', 946974, 'verified'),
(899, 'Al Amin and', 211397, 'asifansari123nnn@gmail.com', '6393126458', '46.5', '', 96193, 'verified'),
(900, 'QdJDD', 23613, '', '8053200417', '0', '', 740895, 'unverified'),
(901, 'EOpOE', 602657, '', '7727065989', '0', '', 945885, 'unverified'),
(902, 'PgKmB', 265972, '', '9636931730', '0', '755533', 614942, 'unverified'),
(903, 'XWjID', 500229, '', '9636931731', '0', '755533', 541168, 'unverified'),
(904, 'zyvKr', 667251, '', '9636931732', '0', '755533', 97471, 'unverified'),
(905, 'NFKfG', 832994, '', '9636931733', '0', '755533', 811159, 'unverified'),
(906, 'HRIos', 402955, '', '9636931734', '0', '755533', 565962, 'unverified'),
(907, 'bpADO', 283248, '', '9636931735', '0', '755533', 37888, 'unverified'),
(908, 'nTLzm', 762067, '', '9636931736', '0', '755533', 933829, 'unverified'),
(909, 'RAovV', 733784, '', '9636931737', '0', '755533', 298851, 'unverified'),
(910, 'DYCxE', 938550, '', '9636931738', '0', '755533', 770861, 'unverified'),
(911, 'yCuna', 782753, '', '9636931739', '0', '755533', 40936, 'unverified'),
(912, 'zJduy', 546754, '', '9636931740', '0', '755533', 979271, 'unverified'),
(913, 'btOKr', 298223, '', '9636931741', '0', '755533', 184307, 'unverified'),
(914, 'Nguix', 33194, '', '9636931742', '0', '755533', 192111, 'unverified'),
(915, 'zQKxO', 651419, '', '9636931743', '0', '755533', 578684, 'unverified'),
(916, 'cyYvN', 933641, '', '9636931744', '0', '755533', 676595, 'unverified'),
(917, 'FMQGC', 16608, '', '9636931745', '0', '755533', 909259, 'unverified'),
(918, 'jondj', 558695, '', '9636931746', '0', '755533', 996617, 'unverified'),
(919, 'uIhZx', 839492, '', '9636931747', '0', '755533', 307315, 'unverified'),
(920, 'IZueQ', 2944, '', '9636931748', '0', '755533', 2564, 'unverified'),
(921, 'hxsJZ', 908514, '', '9636931749', '0', '', 65882, 'unverified'),
(922, 'BuOhj', 852023, '', '7014981569', '0', '', 214332, 'unverified'),
(923, 'pLOjt', 334181, '', '7850924082', '0', '', 243209, 'unverified'),
(924, 'Qfadw', 27937, '', '9572923808', '0', '', 435879, 'unverified'),
(925, 'Unsla', 514148, '', '9817566794', '0', '', 87693, 'unverified'),
(926, 'DSP', 970590, 'maxwell7707@gmail.com', '9016316025', '5.5', '', 342217, 'verified'),
(927, 'yAGTE', 461344, '', '9518425350', '0', '', 298392, 'unverified'),
(928, 'RGHOz', 396946, '', '7357626569', '0', '', 556221, 'unverified'),
(929, 'Arvind Meena', 683221, '', '9057124863', '0', '', 613679, 'unverified'),
(930, 'Rajkumar ❣️', 947593, 'rajm768992@gmail.com', '7413844142', '0.5', '', 430667, 'verified'),
(931, 'uflXY', 799818, '', '7378075703', '0', '', 18930, 'unverified'),
(932, 'KyCuW', 888299, '', '8949243849', '0', '', 345855, 'unverified'),
(933, 'Caption', 634172, 'choudharyji3346@gmail.com', '8003789570', '45.5', '', 488844, 'verified'),
(934, 'Rambir', 377693, 'rambirtalwani@gmail.com', '9050188699', '3', '', 329987, 'verified'),
(935, 'LJDVz', 691845, '', '8295065699', '0', '220458', 426775, 'unverified'),
(936, 'rjaVd', 193008, 'rattirammeena609@com', '9680316829', '0', '', 311610, 'unverified'),
(937, 'nwGIk', 57577, 'mustkeemmansoori44@gmail.com', '6378114786', '0.5', '', 375832, 'verified'),
(938, 'APCbg', 642424, '', '9982293190', '0', '', 213213, 'unverified'),
(939, 'SwWnG', 315029, '', '7877733380', '0', '', 244655, 'unverified'),
(940, 'QBByS', 852446, '', '9001204617', '0', '', 775051, 'unverified'),
(941, 'DHARMENDRA MEENA', 158118, 'dharmendrameena2112@gmail.com', '9950307603', '0.5', '', 153178, 'verified'),
(942, 'VMGxG', 429373, '', '9950307603', '0', '', 900302, 'unverified'),
(943, 'hpYFD', 85021, '', '9119113330', '0', '', 816362, 'unverified'),
(944, 'YNtCz', 308186, '', '9797075419', '0', '', 814285, 'unverified'),
(945, 'LqPtM', 605469, '', '9079139037', '0', '', 835086, 'unverified'),
(946, 'myHSQ', 957536, 'jahidkhan0038@gmail.com', '9992848859', '0', '', 955080, 'verified'),
(947, 'Jay', 86027, '', '7014426162', '44.5', '', 479435, 'unverified'),
(948, 'byf k', 478438, 'golumeena6545@gamil.com', '8000512792', '0', '', 711375, 'verified'),
(949, 'BVGvy', 419012, '', '8000433158', '0', '', 285271, 'unverified'),
(950, 'ipgYu', 195191, 'rinkumeena706219@gmail.com', '7073836819', '28', '', 459801, 'verified'),
(951, 'Hdbdb', 882566, 'souravhsen41@gmail.com', '9302606392', '0', '', 925889, 'verified'),
(952, 'fHENJ', 978658, '', '8875904388', '0', '', 103459, 'unverified'),
(953, 'mklCq', 206167, '', '9462218990', '0', '', 836919, 'unverified'),
(954, 'Ginpf', 734068, '', '8058091905', '0', '', 418132, 'unverified'),
(955, 'QQRuQ', 209777, '', '7015188261', '0', '', 292858, 'unverified'),
(956, 'XlyeF', 933784, '', '9351655280', '0', '722772', 609813, 'unverified'),
(957, 'VjfUk', 61314, '', '9351484417', '0', '', 325240, 'unverified'),
(958, 'qPzSL', 317834, '', '9813631466', '0', '', 621003, 'unverified'),
(959, 'WrtWJ', 502564, '', '7734818384', '0', '', 749399, 'unverified'),
(960, 'NQHMD', 121196, '', '9166601974', '0', '', 988722, 'unverified'),
(961, 'IMwQl', 517906, '', '9358826185', '0', '', 694598, 'unverified'),
(962, 'wtJFK', 974512, '', '7427066394', '0', '', 231832, 'unverified'),
(963, 'nsKlk', 41621, '', '9799919246', '0', '', 439650, 'unverified'),
(964, 'sIsyv', 152972, '', '7413967214', '0', '', 157655, 'unverified'),
(965, 'rWMQD', 579624, 'jaredaaman68@gmail.com', '9462645509', '0', '', 176174, 'verified'),
(966, 'eDeGM', 266786, 'Raghavsharma123@gmail.com', '8930452348', '0', '', 365876, 'verified'),
(967, 'PMjnK', 349046, '', '9887275788', '0', '768721', 17099, 'unverified'),
(968, 'LEqjT', 479404, '', '8505002748', '0', '', 171036, 'unverified'),
(969, 'ozHux', 90853, '', '8505002748', '0', '', 469329, 'unverified'),
(970, 'CsSvn', 111686, '', '8107335724', '0', '', 605403, 'unverified'),
(971, 'FkPgh', 200940, '', '9588009979', '0', '', 554333, 'unverified'),
(972, 'KGF', 165614, 'neerajmeena8055@gmail.com', '7891258686', '47.5', '', 354418, 'verified'),
(973, 'owSBW', 107644, 'Khushirammeena', '8058205905', '0', '', 404481, 'verified'),
(974, 'No फ्रेश आईडी', 292809, '', '7976145203', '19', '', 486524, 'verified'),
(975, 'SiyaRam', 181188, 'kantimeenakalapapda@gmail.com', '7023104608', '10', '', 903260, 'verified'),
(976, 'FhjLz', 601489, '', '9610323027', '0', '', 924951, 'unverified'),
(977, 'gzYqC', 286472, '', '9610323024', '0', '', 27857, 'unverified'),
(978, '𝗻𝗶𝘁𝗶𝗻 𝗸𝗼𝗹', 997980, '𝗸𝗼𝗹374806@𝗴𝗺𝗾𝗹𝗶 𝗰𝗼𝗺', '9329027224', '42.5', '', 995554, 'verified'),
(979, 'GaCYu', 397498, '', '8607269009', '0', '', 275796, 'unverified'),
(980, 'Raja9', 66645, 'rssaini0198@GMAIL.com', '9057003866', '6482', '497402', 809733, 'verified'),
(981, 'OfPOt', 538470, 'udaymeena201@gmail.com', '9783603770', '100', '', 203248, 'verified'),
(982, 'IbqXZ', 403441, '', '6267191836', '0', '', 721753, 'unverified'),
(983, 'dRsHB', 139842, '', '9887513234', '0', '', 214958, 'unverified'),
(984, 'Pradeep Gupta', 971676, 'pg77469@gmail.com', '8085689607', '9.5', '', 619433, 'verified'),
(985, 'Gklag', 159572, '', '8764085339', '0', '', 733822, 'unverified'),
(986, 'Fhggy', 793789, 'kasamkhan45592@gmail.com', '9875786530', '12', '', 618795, 'verified'),
(987, 'NEVZf', 37089, '', '9799888698', '0', '', 992573, 'unverified'),
(988, 'vYMIX', 644444, '', '9799888698', '0', '', 460423, 'unverified'),
(989, 'Kiqax', 210030, 'Vishalmewal', '8302761437', '0', '', 503213, 'verified'),
(990, 'IvNhg', 941527, '', '9376931780', '0', '', 84751, 'unverified'),
(991, 'nPzRK', 582167, '', '9982749130', '0', '', 385718, 'unverified'),
(992, 'NVuGd', 274854, '', '8053821400', '0', '', 4509, 'unverified'),
(993, 'Meokhan', 928404, 'Parvejaalam5596@gmail.com', '9991595177', '244', '', 220383, 'unverified'),
(994, 'qkVss', 514086, '', '6375276849', '0', '', 991188, 'unverified'),
(995, 'khVgn', 336073, 'amitjhajhriaj@gmail.com', '9694947961', '40', '', 258118, 'verified'),
(996, 'wdZdU', 737174, '', '9352465957', '0', '', 355844, 'unverified'),
(997, 'EdsBO', 426183, '', '9996543419', '0', '', 131282, 'unverified'),
(998, 'BBG', 940364, 'jahirkhan5634@gmail.com', '8955220033', '0', '', 906002, 'verified'),
(999, 'xJIUj', 316159, '', '9602530492', '0', '', 470352, 'unverified'),
(1000, 'qRwaw', 850684, '', '7087360936', '0', '', 492687, 'unverified'),
(1001, 'ZPTAh', 374723, '', '9334336179', '0', '640071', 668853, 'unverified'),
(1002, 'RJulb', 183889, '', '6377406669', '0', '', 777907, 'unverified'),
(1003, 'mEjzq', 474068, '', '7877680166', '0', '', 594344, 'unverified'),
(1004, 'cMocj', 731390, 'brijeshjareda099@gmail.com', '7378173220', '18', '133853', 349727, 'verified'),
(1005, 'Rahul08', 580121, '', '9050789608', '0', '', 593314, 'unverified'),
(1006, 'ddRBt', 94165, '', '8005624871', '0', '133853', 876219, 'unverified'),
(1007, 'rEhvN', 621592, '', '8307973503', '0', '', 884471, 'unverified'),
(1008, 'bauCI', 884790, 'aafakansari483@gmail.com', '8887679383', '22.5', '562000', 480929, 'verified'),
(1009, 'ZVkQT', 347166, 'Talim,geil.com', '9509950493', '0.5', '', 178191, 'verified'),
(1010, 'rBNDQ', 559841, 'deepakindora998@gmail.com', '8813838917', '45.5', '', 850370, 'verified'),
(1011, 'ETHdw', 601188, '', '8824258189', '0', '', 119453, 'unverified'),
(1012, 'GEzsH', 679349, 'sahunkhan10051986@gmail.com', '9664070575', '66.5', '', 438846, 'verified'),
(1013, 'EyYTL', 158458, '', '9610397237', '0', '', 327669, 'unverified'),
(1014, 'tjgTm', 576867, '', '7878165414', '0', '', 617837, 'unverified'),
(1015, 'iwACR', 88064, '', '9672814951', '0', '', 372202, 'unverified'),
(1016, 'sftgo', 269786, 'Ashokmeeba338@gmail.com', '9982982100', '98.5', '', 77686, 'verified'),
(1017, 'eeveo', 223178, '', '8930584544', '10', '', 663930, 'unverified'),
(1018, 'King Khan', 140267, 'ajjikhan935086@gmail.com', '9350865371', '0.5', '', 591710, 'verified'),
(1019, 'ILXfU', 269829, '', '8000637535', '0', '', 780140, 'unverified'),
(1020, 'Sarpanch', 576689, 'sahibkhan562000@gmail.com', '9350213057', '21.5', '', 923973, 'verified'),
(1021, 'qGtQD', 520619, '', '7014780906', '0', '', 154309, 'unverified'),
(1022, 'tNfCN', 808463, '', '8290654533', '0', '399634', 635125, 'unverified'),
(1023, 'D k gumanpura', 434036, '', '8764666776', '5', '', 923639, 'unverified'),
(1024, 'dfbJh', 820505, '', '7878184284', '0', '', 662700, 'unverified'),
(1025, 'nfLUP', 171085, '', '9414906043', '0', '', 396273, 'unverified'),
(1026, 'Turyz', 129479, '', '7340313114', '64', '', 787917, 'unverified'),
(1027, 'Last chance 🤞🏻', 108483, 'balotneeraj001@gmail.com', '7073507039', '1', '', 988593, 'verified'),
(1028, 'Mustfa155', 415641, '', '9813287155', '0', '744996', 605006, 'unverified'),
(1029, 'bELTA', 494197, 'wariskhan66190@gmail.com', '8619040941', '0.5', '104554', 540611, 'verified'),
(1030, 'Aman gupta', 8974, '', '8299361236', '0', '', 947635, 'unverified'),
(1031, 'kxGdO', 701776, 'ashumansuri99@gmail.com', '9116770428', '0', '', 734994, 'verified'),
(1032, 'rUYaE', 474505, '', '9351307249', '0', '', 719850, 'unverified'),
(1033, 'Khan sahab', 443002, 'talimmalabiya@gmail.com', '9991450346', '0', '', 818321, 'verified'),
(1034, 'WxaGo', 186896, '', '9664209428', '0', '', 247592, 'unverified'),
(1035, 'zizpZ', 469596, '', '9610201905', '0', '', 507748, 'unverified'),
(1036, 'SYpim', 986742, '', '9041041778', '0', '640071', 164004, 'unverified'),
(1037, 'MYGNa', 457710, '', '7878873130', '0', '', 680161, 'unverified'),
(1038, 'xbmNn', 981109, 'rkhan714000@gmail.com', '8003094616', '48', '', 905352, 'verified'),
(1039, 'JLtAQ', 962243, '', '8859851717', '0', '', 21659, 'unverified'),
(1040, 'hNvsL', 317245, 'shishupalverma7575@gmail.com', '8769314202', '0', '', 390224, 'verified'),
(1041, 'acDIx', 774123, '', '6375936214', '0', '', 998308, 'unverified'),
(1042, 'sLXpE', 517984, '', '7889162692', '0', '', 289636, 'unverified'),
(1043, 'sQcKL', 576096, 'dk4877689@gmail.com', '7889167692', '50', '', 692806, 'verified'),
(1044, '𝔹ℝ𝔸ℕ𝔻 𝕄𝔼𝕎𝔸𝕋', 702714, 'Sahibmohd275@gmail.com', '9812653198', '0.5', '', 820947, 'verified'),
(1045, 'UoTmI', 562732, 'Abhaysharma12842@gmail.com', '7849980798', '0', '', 15532, 'verified'),
(1046, 'Kismat kharab', 483273, 'rjs28566@gmail.com', '6376389907', '13.5', '', 551406, 'verified'),
(1047, 'Jfcxa', 923174, '', '9817722311', '0', '', 371675, 'unverified'),
(1048, 'VqvcR', 904491, 'Maharmeena@gmail.com', '8890995821', '0', '', 299599, 'verified'),
(1049, 'xczUn', 97744, '', '8949996208', '0', '', 840336, 'unverified'),
(1050, 'wuluZ', 334623, '', '8949996208', '0', '', 464642, 'unverified'),
(1051, 'DgxLc', 841278, '', '8949996208', '0', '', 417082, 'unverified'),
(1052, 'ofEJb', 830598, '', '8949996208', '0', '', 799551, 'unverified'),
(1053, 'zpddf', 648629, '', '8949996208', '0', '', 333211, 'unverified'),
(1054, 'LnFRF', 644348, '', '8949996208', '0', '', 525205, 'unverified'),
(1055, 'Raku gomladu', 390174, 'Rkmeena5033@gmail.com', '9636503350', '26.5', '', 89467, 'unverified'),
(1056, 'rYNBO', 212866, '', '8077696391', '0', '794258', 532770, 'unverified'),
(1057, '300+++on', 892449, 'alamsiddique992@gmail.com', '6375164312', '42.5', '', 676085, 'verified'),
(1058, 'TONud', 284270, '', '8607488619', '0', '', 242859, 'unverified'),
(1059, 'VbqrM', 698188, '', '7877166497', '0', '', 568411, 'unverified'),
(1060, 'JSUkc', 5536, 'promotionishqiyaan@gmail.com', '9602836004', '0', '39226', 463331, 'unverified'),
(1061, 'Jahid mannaka', 301084, '', '8696804283', '48.5', '946974', 354007, 'unverified'),
(1062, 'eOuNx', 890783, '', '8696804283', '0', '946974', 226144, 'unverified'),
(1063, 'kJXsk', 861878, '', '7597088788', '0', '', 285605, 'unverified'),
(1064, 'Kgbft', 178565, 'sanjaylalawat61@gmail.com', '8107317604', '2', '', 801487, 'verified'),
(1065, 'OVJwY', 896503, '', '9636084863', '0', '', 601175, 'unverified'),
(1066, 'Kaali', 156791, 'rkesmeena0786@gmail.com', '7976434375', '0', '', 143953, 'verified'),
(1067, 'bmcND', 745985, '', '6378867174', '0', '', 342406, 'unverified'),
(1068, 'Alfija khan aaja bet', 521513, 'Ahmeadhussain2528@gmail.com', '8930002528', '1880.5', '744996', 516696, 'verified'),
(1069, 'SHmDw', 375986, '', '9306611701', '0', '', 281012, 'unverified'),
(1070, 'yPUbk', 628045, '', '9462620432', '0', '', 869305, 'unverified'),
(1071, 'IAtXK', 503828, '', '7727011631', '0', '', 872622, 'unverified'),
(1072, 'SjNLx', 46343, '', '7082094980', '0', '', 399945, 'unverified'),
(1073, 'bed luck', 584727, 'pintumeena1409@gmail.com', '9414818012', '34', '', 933027, 'verified'),
(1074, 'Ebed gj', 520231, 'khanliyakat6694@gmail.com', '7023212438', '35', '', 29745, 'unverified'),
(1075, 'BSCgR', 520187, '', '9052014000', '0', '', 781394, 'unverified'),
(1076, 'Withdrawal kar', 654353, 'rohitsharmajibusiness@gmail.com', '9785728293', '34', '', 939104, 'verified'),
(1077, 'JKSRV', 447833, '', '8115564257', '0', '', 287376, 'unverified'),
(1078, 'pLJSO', 191494, '', '8115564257', '0', '', 723855, 'unverified'),
(1079, 'hkVDj', 674682, '', '9350976322', '0', '', 504462, 'unverified'),
(1080, 'VoBDW', 891122, 'aamirkhan889100@gmail.com', '8168889100', '5', '', 228105, 'verified'),
(1081, 'JGacA', 238559, 'bhagatmaharajmaharaj@gmail.com', '7898861902', '35', '', 759838, 'unverified'),
(1082, 'Only clasic', 908164, 'mahmoodkhan6785@gmail.com', '9813947568', '588', '', 267802, 'verified'),
(1083, 'BSwXA', 599815, '', '8053161620', '0', '', 223053, 'unverified'),
(1084, 'DFTid', 378031, '', '6005595461', '0', '', 503750, 'unverified'),
(1085, 'ngdOp', 350919, 'virendrasinghrajput805@gmail.com', '8278663397', '35', '', 998720, 'verified'),
(1086, 'yIRJP', 245967, '', '7737604182', '0', '', 385666, 'unverified'),
(1087, 'mTudJ', 907636, '', '9571923805', '0', '', 567602, 'unverified'),
(1088, 'AWnQV', 621260, '', '8946878748', '0', '', 526409, 'unverified'),
(1089, 'esvVA', 829489, '', '8949846524', '0', '', 728523, 'unverified'),
(1090, 'RsZGs', 693394, '', '8955893567', '0', '', 417685, 'unverified'),
(1091, 'kbUmE', 557777, '', '8696658659', '0', '', 686969, 'unverified'),
(1092, 'Nosad', 580529, 'khannosad977@gmail.com', '9784712652', '7', '', 230124, 'verified'),
(1093, 'rzXDe', 684817, '', '7860922688', '0', '', 708159, 'unverified'),
(1094, 'Hhhhhh', 193076, 'punitdhayal7@gmail.com', '6350286006', '0', '', 882046, 'verified'),
(1095, 'Sreya', 25019, 'rajoriyasachin556@gmail.com', '7014200762', '35.5', '', 513493, 'verified'),
(1096, 'DASI BOYS', 258302, 'rkhan901027@gmail.com', '9983419652', '6', '', 151606, 'verified'),
(1097, 'inCZp', 126458, '', '9306403828', '0', '', 796158, 'unverified'),
(1098, 'RmMAB', 806015, '', '9680684346', '0', '755533', 638623, 'unverified'),
(1099, 'रोध', 795057, 'deepakmeena4868@gmail.com', '7728923778', '0', '', 248431, 'verified'),
(1100, '200+ no iphn', 181060, 'Amanchanda137@gmail.com', '9518695586', '47.5', '', 503823, 'verified'),
(1101, 'King player', 486780, '', '9334135809', '0', '', 320811, 'unverified'),
(1102, 'VaJCn', 651923, '', '9509995428', '0', '', 767928, 'unverified'),
(1103, 'zKSkA', 811026, 'mehuldesai484@gmail.com', '8849025031', '14', '', 556630, 'verified'),
(1104, 'egsxy', 313780, 'golumeena6545@gamil.com', '9079213925', '0', '', 484600, 'verified'),
(1105, 'HZAdF', 73545, '', '7877087798', '0', '', 80937, 'unverified'),
(1106, 'ofrLF', 946435, '', '9414819651', '0', '', 685401, 'unverified'),
(1107, 'wqJKo', 220912, '', '7805933465', '0', '', 721211, 'unverified'),
(1108, 'irLTo', 722903, '', '9329592413', '0', '', 950647, 'unverified'),
(1109, 'yKmon', 62576, 'akhileshkparihar@gmail.com', '9425334895', '0', '', 131148, 'verified'),
(1110, 'zoqEA', 639703, '', '7232015549', '0', '', 557995, 'unverified'),
(1111, 'peybj', 354856, '', '9694927049', '0', '', 922873, 'unverified'),
(1112, '✌️✌️✌️2222', 858588, 'gorwalkhan3579@gmail.com', '9079824898', '0', '483726', 385174, 'verified'),
(1113, 'cmeFU', 834295, '', '9350102954', '0', '', 667633, 'unverified'),
(1114, 'QgSSc', 498813, '', '8755513432', '0', '', 33611, 'unverified'),
(1115, 'YHoem', 651592, '', '8929826424', '0', '133853', 257304, 'unverified'),
(1116, 'Kings', 668441, 'narru7937@gmail.com', '8690707259', '0', '', 333546, 'verified'),
(1117, 'Komal', 74610, 'buavyakumar74@gmail.com', '6376109210', '20', '', 716738, 'verified'),
(1118, 'EsvMJ', 973776, '', '6263002785', '0', '', 172064, 'unverified'),
(1119, 'dRAiS', 184292, '', '8696330193', '0', '', 200165, 'unverified'),
(1120, 'Bgvj', 754254, 'amarjeetgoutam4@gmail.com', '7073764390', '47', '', 777193, 'verified'),
(1121, 'llbhM', 859011, '', '8968627504', '0', '', 85557, 'unverified'),
(1122, 'ylyIh', 468618, '', '8769535757', '0', '', 625761, 'unverified'),
(1123, 'zhSnC', 500861, '', '7230883739', '0', '', 130845, 'unverified'),
(1124, 'UbHRC', 462192, '', '9782560029', '0', '', 940523, 'unverified'),
(1125, 'vRrOx', 422959, '', '9024905432', '0', '', 962583, 'unverified'),
(1126, 'WosGW', 824018, '', '9376651473', '0', '', 848091, 'unverified'),
(1127, 'aAlap', 944941, '', '8168082355', '0', '', 294547, 'unverified'),
(1128, 'V........R😔', 386547, 'vikameena9664@gmail.com', '9664060344', '0.5', '', 396269, 'verified'),
(1129, 'ZsXfr', 21487, '', '8963896189', '0', '', 403833, 'unverified'),
(1130, '๛ROYALS๛', 381030, 'Anand Kumar mandal @gmail.com', '9813531389', '2', '228321', 362050, 'verified'),
(1131, 'vGBjF', 140281, '', '9813531389', '0', '228321', 484556, 'unverified'),
(1132, 'JBJlT', 589255, '', '9813531389', '0', '228321', 19765, 'unverified'),
(1133, 'CRphM', 748225, '', '9813531389', '0', '228321', 630930, 'unverified'),
(1134, 'xnxPo', 139874, '', '9813531389', '0', '228321', 5416, 'unverified'),
(1135, 'bssXp', 474084, '', '8619783539', '0', '', 172620, 'unverified'),
(1136, 'ZOrHz', 942541, 'ast8055ast@gmail.com', '7806082070', '1', '', 661780, 'verified'),
(1137, 'Manish pattya', 628733, 'Shyamnarimeena@gmail.com', '9929927471', '0', '', 510510, 'verified'),
(1138, 'LErKd', 796012, '', '8003223730', '0', '', 660891, 'unverified'),
(1139, 'JgrEZ', 635053, '', '9610020248', '0', '', 354025, 'unverified'),
(1140, 'PjUlo', 548764, '', '7073582003', '0', '', 491773, 'unverified'),
(1141, 'IFGmk', 403420, 'vikas8058375941@gmail.com', '8058375941', '0', '', 565971, 'verified'),
(1142, 'hZewb', 357865, '', '9024615625', '0', '', 566185, 'unverified'),
(1143, 'iTAhA', 884484, 'rbmeena9982@gmail.com', '9982385172', '0', '', 869293, 'verified'),
(1144, 'Raj🥰', 674145, 'samaysing9636@gmail.com', '6376079429', '0', '', 549580, 'verified'),
(1145, 'arqpf', 818312, '', '9785019531', '0', '', 200245, 'unverified'),
(1146, 'Tapu', 759792, 'yadrammeena2005@gmail.com', '7878704619', '4', '', 403089, 'verified'),
(1147, 'EDCko', 605655, '', '9680894258', '0', '', 109123, 'unverified'),
(1148, 'Ludo Paisa best', 670912, 'sitarohit2580@gmail.com', '8619705696', '1.5', '', 30395, 'verified'),
(1149, 'nBBmv', 341680, '', '9057950207', '0', '', 527472, 'unverified'),
(1150, 'Mahesh kgc', 213450, '', '9636745777', '0', '', 746052, 'unverified'),
(1151, 'SqEiY', 834538, '', '8082668714', '0', '', 987378, 'unverified'),
(1152, 'AnFNN', 173475, '', '9813080198', '0.5', '', 209277, 'unverified'),
(1153, 'bKqvm', 183570, '', '8168585327', '0', '', 715635, 'unverified'),
(1154, '[ NAWALIYA ]', 618575, 'Munfedsehjad@gmail.com', '9991566168', '10', '', 210056, 'verified'),
(1155, 'dQEyb', 692111, '', '9306621220', '0', '', 471510, 'unverified'),
(1156, 'kPtcO', 630414, '', '7891817512', '0', '', 141373, 'unverified'),
(1157, 'IhXDx', 304975, '', '9813030480', '0', '', 474266, 'unverified'),
(1158, 'heVpq', 594634, '', '9671125624', '0', '', 653854, 'unverified'),
(1159, 'Nawagqu', 818174, 'Arunyadav84016@gmail.com', '9315655480', '9', '815554', 414650, 'verified'),
(1160, 'Rrrt', 639283, 'rajkumar967112562@gmli.com', '9813375624', '46', '', 636106, 'verified'),
(1161, 'NfAsf', 74482, '', '9057935125', '0', '', 16694, 'unverified'),
(1162, 'ZrySd', 265471, '', '8000660532', '0', '', 887563, 'unverified'),
(1163, 'nTLBK', 470731, 'Balram7878@gamil.com', '7878392439', '85.5', '', 364782, 'verified'),
(1164, 'niVca', 996768, '', '7878258881', '0', '', 911539, 'unverified'),
(1165, 'SutzW', 512514, '', '9772840747', '0', '', 832113, 'unverified'),
(1166, 'WRFlr', 890676, '', '8930065101', '0', '744996', 257723, 'unverified'),
(1167, 'rYeMC', 1498, '', '9728987155', '0', '744996', 793736, 'unverified'),
(1168, 'mcxfv', 149734, '', '7240912973', '0', '', 146377, 'unverified'),
(1169, 'MvxGy', 354791, 'Mrlokesh@gmail.com', '8955672934', '0', '', 219120, 'verified'),
(1170, 'wKcqJ', 755690, '', '9116318445', '0', '', 189487, 'unverified'),
(1171, 'bfitH', 203793, '', '8824442741', '0', '', 73230, 'unverified'),
(1172, 'YFLBU', 104518, '', '9773357966', '0', '', 860450, 'unverified'),
(1173, 'YEsIJ', 562356, '', '9773357966', '0', '', 959080, 'unverified'),
(1174, 'Tipper', 320438, 'Siyarammeena463@gmail.com', '8209393405', '112.5', '', 106420, 'verified'),
(1175, 'SANAM TERI KASAM', 8635, 'smeena36740@gmail.com', '8740929905', '35', '', 770516, 'verified'),
(1176, 'OAPtg', 556960, 'kshoyabkhan38@gmail.com', '9024241483', '8.5', '', 660355, 'verified'),
(1177, 'VjLHE', 470219, '', '9001597643', '0', '', 837603, 'unverified'),
(1178, 'hxuHs', 883787, 'abhishekmarmat582@gmail.com', '9680370796', '2', '', 834628, 'verified'),
(1179, 'DXXlR', 619263, '', '7891636794', '0', '', 268342, 'unverified'),
(1180, 'tycQZ', 887122, 'rakeshpandey41314131@gmail.com', '8449247488', '50', '', 8253, 'verified'),
(1181, 'WkQBp', 1582, '', '9887686514', '0', '', 418406, 'unverified'),
(1182, 'sYQCO', 380374, '', '7733825670', '0', '', 986245, 'unverified'),
(1183, 'iBAMh', 496688, '', '7891301000', '0', '', 949877, 'unverified'),
(1184, 'CWWRL', 264916, '', '7665444627', '0', '21519', 887736, 'unverified'),
(1185, 'mflhf', 86901, '', '9648903967', '0', '', 912978, 'unverified'),
(1186, 'Boss 😔', 643424, 'Sg2025420@gmail.com', '7073525719', '4', '', 985304, 'verified'),
(1187, 'YcHMO', 326887, '', '6350561727', '0', '', 981799, 'unverified'),
(1188, 'Urmi', 84225, 'Pavanmeen9694@gmail.com', '9694248347', '18.5', '', 350594, 'verified'),
(1189, 'HoUnz', 227388, '', '8955081312', '0', '', 35901, 'unverified'),
(1190, 'kwiMc', 27175, '', '8955081312', '0', '', 204617, 'unverified'),
(1191, 'xyTjQ', 856801, '', '8890905036', '0.5', '', 758534, 'unverified'),
(1192, 'jNOMI', 642513, '', '7627057099', '0', '', 915873, 'unverified'),
(1193, 'SeNbR', 253202, 'sanjaymeena03022004@gmail.com', '9672166846', '0', '', 555093, 'verified'),
(1194, 'CzNrN', 253690, '', '8441055956', '0', '', 798421, 'unverified'),
(1195, 'diprS', 603999, '', '8302829184', '0', '835086', 692147, 'unverified'),
(1196, 'Djhgk', 893301, '', '9509403165', '0', '', 286458, 'unverified'),
(1197, '*********', 659957, 'mohdasif555nnn@gmail.com', '7860900991', '0.5', '', 149581, 'verified'),
(1198, 'Kguqx', 788777, '', '9671302575', '0', '', 574503, 'unverified'),
(1199, 'XzKRM', 512771, '', '9671302575', '0', '', 882794, 'unverified'),
(1200, 'eMpwi', 310439, '', '9672967196', '0', '', 684549, 'unverified'),
(1201, 'iinru', 780525, '', '9828995890', '0', '', 58012, 'unverified'),
(1202, 'TvOVM', 638875, '', '9057539757', '0', '', 593927, 'unverified'),
(1203, 'fdjXF', 45081, 'meenalaxman238@gmail.com', '9057539754', '0', '', 568949, 'verified'),
(1204, 'Koi hai kya', 539243, 'sharma958754@gmail.com', '8504018164', '0.5', '', 435181, 'verified'),
(1205, 'Jt', 249619, 'meenasanjaymeena307@gmail.com', '9785243107', '19', '', 612586, 'verified'),
(1206, 'HfsON', 743266, '', '9257690766', '0', '', 385061, 'unverified'),
(1207, 'Sanjay Kumar', 97651, 'SanjayGautam 6400@gmail.com', '8115341802', '103', '', 808499, 'verified'),
(1208, 'dUhiH', 447964, '', '9024185699', '0', '', 523671, 'unverified'),
(1209, 'JzLCI', 69764, '', '9694349559', '0', '', 556882, 'unverified'),
(1210, 'Mai ka bhosda gurb m', 893520, 'ghanshyamkoli123456789@gmail.com', '7240068770', '1000', '', 906343, 'verified'),
(1211, 'rhBMg', 513943, '', '7976287937', '0', '', 887351, 'unverified'),
(1212, 'ReOwg', 458525, 'sunitameena2250@gmail.com', '8302658547', '2025', '', 74310, 'verified'),
(1213, 'JtftS', 266651, '', '9351996596', '0', '', 706852, 'unverified'),
(1214, 'Diesel', 460889, 'mdafedar11@gmail.com', '8123370083', '10.5', '', 854501, 'verified'),
(1215, 'Mahendra Meena', 821627, 'israelkhan642@gmail.com', '7477043275', '0', '', 136274, 'verified'),
(1216, 'dvakZ', 613920, 'Meenadharmendra69@gmail.com', '9024319513', '0.5', '', 240063, 'verified'),
(1217, 'OJohT', 103743, 'akash310123@gmail.com', '7850937304', '0.5', '', 651766, 'verified'),
(1218, 'hImYg', 9574, '', '6367364704', '0', '', 114631, 'unverified'),
(1219, 'TTQmW', 508347, 'fareedwakeel5@gmail.com', '8429832063', '0', '562000', 793034, 'verified'),
(1220, 'cJvRI', 126276, '', '9887709362', '0', '', 545812, 'unverified'),
(1221, 'IQsPN', 519353, '', '9991889064', '0', '', 973194, 'unverified'),
(1222, 'RANI BABY🖤', 463926, 'www.rizwanmalik645@gmail.com', '6006083729', '14', '', 54022, 'verified'),
(1223, 'ztrox', 971328, '', '7725936847', '0', '', 136213, 'unverified'),
(1224, 'IhMed', 341092, 'mdilrajmeena236@gmali.com', '9509852361', '17.5', '', 783040, 'verified'),
(1225, 'mQIBt', 123308, 'meenapawan90638@gmial.com', '9351774564', '0', '', 299263, 'verified'),
(1226, 'Raju bhai', 223728, 'amratmeena9851@gmail.com', '7340185325', '6052.5', '', 646661, 'verified'),
(1227, 'TaRod', 416587, 'balmukandnayawas@gmail.com', '8306266399', '0.5', '219708', 480892, 'verified');
INSERT INTO `tablename` (`id`, `Name`, `otp`, `Email`, `Phone`, `Wallet_balance`, `referral`, `referral_code`, `verified`) VALUES
(1228, 'iksEr', 174724, '', '9166326845', '0', '', 648767, 'unverified'),
(1229, 'tfyf', 853844, 'G', '7042536432', '0', '750333', 750333, 'verified'),
(1230, 'KgkkG', 945475, '', '8005606622', '0', '', 448910, 'unverified'),
(1231, 'Random', 714902, 'drhussain3032@gmail.com', '9057423655', '4.5', '', 760796, 'verified'),
(1232, 'aCiSc', 871461, '', '8529342690', '0', '', 573575, 'unverified'),
(1233, 'eCIDK', 724774, '', '7071525719', '0', '', 545777, 'unverified'),
(1234, 'NY', 556045, 'Farhanwani7777@gmail.com', '7780818584', '0', '', 655114, 'verified'),
(1235, 'ObsfK', 602206, '', '9929582357', '0', '', 253376, 'unverified'),
(1236, 'Prem', 89370, 'premkumarjangid88@gmail.com', '7878750593', '0.5', '', 66398, 'verified'),
(1237, 'PUVth', 180918, '', '9991166116', '0', '', 197425, 'unverified'),
(1238, 'QpBEg', 334688, '', '9053716154', '0', '', 721779, 'unverified'),
(1239, 'XraYi', 405995, '', '9039047299', '0', '', 614693, 'unverified'),
(1240, 'Dibbi', 347715, 'malikshoaibm0786@gmail.com', '9784931534', '0', '', 704910, 'verified'),
(1241, 'CvTYV', 757101, 'arbazman9@gmail.com', '7440259619', '0', '', 361936, 'unverified'),
(1242, 'uPJoF', 620544, '', '8890918354', '0', '', 75917, 'unverified'),
(1243, 'आओ हवेली में', 615307, 'www.vasimg45@gmail.com', '9630231661', '33', '330665', 673620, 'verified'),
(1244, 'Zkyas', 795972, '', '6262172501', '0', '', 135512, 'unverified'),
(1245, 'hfcTU', 649238, '', '7733887082', '0', '', 508295, 'unverified'),
(1246, 'tCtvH', 93606, 'pawansonone60@gmail.com', '7804922606', '0', '', 104350, 'verified'),
(1247, 'Isla khan', 489261, '', '8441040235', '0', '', 467187, 'unverified'),
(1248, 'PSztO', 619384, '', '6350587166', '0', '', 313774, 'unverified'),
(1249, 'fysEw', 260023, '', '7309323536', '0', '', 703545, 'unverified'),
(1250, 'vZlJg', 682796, '', '8398053086', '0', '512373', 626563, 'unverified'),
(1251, 'xBscC', 864873, 'lalsotsklodwal@gmail.com', '7850020560', '0', '', 292959, 'verified'),
(1252, 'bQfQY', 469714, '', '9983202954', '0', '', 319034, 'unverified'),
(1253, 'NFymL', 82702, '', '9983649736', '0', '', 91146, 'unverified'),
(1254, 'UqvyZ', 172692, '', '9772214963', '0', '', 217966, 'unverified'),
(1255, 'AddGS', 422096, '', '9001140125', '0', '', 78224, 'unverified'),
(1256, 'heXDZ', 364907, '', '9001483198', '0', '', 778028, 'unverified'),
(1257, 'PremRaj meena', 381387, 'dhanrajmeena968399@gmail.com', '7878686435', '0.5', '587809', 834406, 'verified'),
(1258, 'PQvQb', 442756, '', '9664402323', '0', '', 571524, 'unverified'),
(1259, 'Indian ludo', 613346, 'sk1292248@gmail.com', '9783330986', '31', '', 210818, 'verified'),
(1260, 'wkxpM', 358266, '', '8740067887', '0', '', 729690, 'unverified'),
(1261, 'EfsFb', 626955, '', '9306826484', '0', '', 673531, 'unverified'),
(1262, 'nRFHZ', 439372, '', '8950595253', '0', '', 108147, 'unverified'),
(1263, 'kyIZv', 261438, '', '8209606014', '0', '', 991984, 'unverified'),
(1264, 'No theme no k+', 852564, 'Murarigurjer783@gmail.com', '8209303216', '60.5', '', 843332, 'verified'),
(1265, 'UedVR', 11758, '', '7978686435', '0', '', 223716, 'unverified'),
(1266, 'oQkmW', 132683, '', '7737123197', '0', '', 553969, 'unverified'),
(1267, 'oweaa', 289593, '', '8429832062', '0', '', 466641, 'unverified'),
(1268, 'SbBVB', 150975, '', '7357377376', '0', '', 729035, 'unverified'),
(1269, 'kSdoU', 50454, '', '9887277890', '0', '', 141467, 'unverified'),
(1270, 'Rafik646', 396654, '', '9813038646', '0', '744996', 231786, 'unverified'),
(1271, 'HoyoT', 199510, '', '8690359219', '0', '', 499987, 'unverified'),
(1272, 'FTLMf', 117646, '', '6378909104', '0', '', 957610, 'unverified'),
(1273, 'Sajid monish', 418769, 'Oymonish@mail.com', '9050136162', '139', '', 90514, 'verified'),
(1274, 'IlMIw', 542268, '', '9050806034', '7', '', 879982, 'unverified'),
(1275, 'Khaa gya aaja', 100869, '', '9982627500', '0', '', 431917, 'verified'),
(1276, 'UhaDd', 259575, '', '9018380380', '0', '', 934990, 'unverified'),
(1277, 'blzyC', 795063, 'rajindersingh380@gmail.com', '9622380380', '0.5', '934990', 658933, 'verified'),
(1278, 'YDxsc', 383865, '', '9983786228', '39.5', '', 314320, 'unverified'),
(1279, 'QiNXS', 102009, '', '8000879299', '0', '', 222920, 'unverified'),
(1280, 'lycce', 50062, '', '8882433137', '0', '', 831186, 'unverified'),
(1281, 'dgmzf', 981608, '', '9518169407', '0', '', 610240, 'unverified'),
(1282, 'imFNN', 922912, 'rohitmeena4863@gmail.com', '6376220385', '0', '', 59572, 'verified'),
(1283, '******* game', 930564, 'rashidkhanpharmacist2019@gmail.com', '9996721261', '10.5', '511250', 898859, 'verified'),
(1284, 'SprVr', 282829, '', '8696009797', '0', '', 962641, 'unverified'),
(1285, 'rNAnb', 289808, '', '9782004146', '0', '', 734704, 'unverified'),
(1286, 'TCnIj', 793433, '', '9520592262', '0', '', 94210, 'unverified'),
(1287, 'Jat', 529028, 'papuj550@gmail.com', '9587627894', '0', '', 305146, 'verified'),
(1288, 'BmRjL', 446416, '', '9680380796', '0', '', 592611, 'unverified'),
(1289, 'VjVkE', 208798, 'rs5439348@gmail.com', '9664042381', '30.5', '', 482740, 'verified'),
(1290, 'UvGWS', 592959, '', '7985145868', '0', '', 68286, 'unverified'),
(1291, 'Fast khelny valy', 55797, 'ajayget111@gmail.com', '8209963148', '4', '641525', 884505, 'verified'),
(1292, '₹1 अभी विद्रोह नहीं', 248024, 'TOCHANKING402@gmail.com', '7726088032', '15.5', '', 83878, 'verified'),
(1293, 'Khanan mafiya', 350577, 'kravi03303@gmail.com', '9785634787', '-92', '', 591054, 'verified'),
(1294, '9340842731', 871100, 'Lodhijatin287@gmail.com', '9340842731', '0.5', '', 795155, 'verified'),
(1295, 'Hagava', 885954, 'Prk373737@gmail.com', '8839987338', '62', '', 327514, 'verified'),
(1296, 'EBHFL', 664310, '', '9784922291', '0', '', 808259, 'unverified'),
(1297, 'omvau', 115379, '', '7690080591', '0', '', 931169, 'unverified'),
(1298, 'vWbBJ', 645880, 'sohilkhan407200@gmail.com', '9352051150', '0.5', '', 600631, 'verified'),
(1299, 'dULAe', 292439, '', '8168327070', '0', '', 975358, 'unverified'),
(1300, 'nGuPC', 993738, 'sakuvayasahab@gmail.com', '9414908972', '0', '', 254955, 'unverified'),
(1301, 'Digg', 19846, 'shrawankumar0836@gmail.com', '9116956531', '0.5', '', 311815, 'verified'),
(1302, 'No magical dice no t', 264828, 'sanjaypandit1444@gmail.com', '7017593272', '27', '640071', 620766, 'verified'),
(1303, 'ylTWM', 445829, '', '9079651608', '0', '', 117140, 'unverified'),
(1304, '5544', 975702, 'khanirshad33865@gmail.com', '9991509092', '2736', '', 494733, 'verified'),
(1305, 'lORHJ', 490202, '', '7096496386', '0', '', 633827, 'unverified'),
(1306, 'BbogW', 211321, '', '6376843695', '0', '', 745399, 'unverified'),
(1307, 'hlqVh', 324120, '', '8000433569', '0', '', 846810, 'unverified'),
(1308, 'lrGPc', 708638, '', '6350148211', '0', '', 245586, 'unverified'),
(1309, 'YmfnF', 652254, '', '9352230768', '35', '', 918815, 'unverified'),
(1310, 'wMXrj', 867861, '', '7676395866', '0', '', 314053, 'unverified'),
(1311, 'EfAoC', 637056, 'ajjuk2736@gmail.com', '8813070235', '48.5', '', 14335, 'verified'),
(1312, 'AKS', 186641, 'anwarkhan307474@gmail.com', '9050603074', '26', '818321', 100559, 'verified'),
(1313, 'pzuxz', 931153, 'mubeenkotiya@gmail.com', '9671828021', '208', '', 614140, 'verified'),
(1314, 'NKtbF', 615494, '', '9602017457', '47', '', 38933, 'unverified'),
(1315, 'dLfmt', 255430, '', '8307031116', '0', '393526', 375852, 'unverified'),
(1316, 'Uuuuiuui', 934119, '', '7240622765', '8', '', 814244, 'unverified'),
(1317, 'DaXgd', 348699, '', '8396878930', '0', '', 839536, 'unverified'),
(1318, 'SHMrA', 341189, '', '9816877891', '0', '', 960468, 'unverified'),
(1319, 'kLLrN', 476159, 'Bijendarmeena2002@gmail.com', '9571034133', '0', '', 343212, 'verified'),
(1320, 'QAxen', 8292, '', '7878827611', '0', '', 840741, 'unverified'),
(1321, 'LqIrI', 777749, '', '8441987184', '0', '', 274366, 'unverified'),
(1322, 'wutrL', 208589, '', '8441987184', '0', '', 410630, 'unverified'),
(1323, 'oyQOs', 861026, '', '9928419708', '0', '', 333058, 'unverified'),
(1324, 'sIWeF', 12729, '', '9694904801', '0', '', 687053, 'unverified'),
(1325, 'iqEhJ', 863326, '', '8209062941', '0', '947576', 646351, 'unverified'),
(1326, 'SNlFp', 100171, '', '9026533700', '15', '', 627635, 'unverified'),
(1327, 'OriJo', 212828, '', '8107847571', '0', '', 800126, 'unverified'),
(1328, 'HTNkK', 746376, 'soyabkhan80058@gmail.com', '8005886629', '0', '', 867701, 'verified'),
(1329, 'opCqs', 431788, '', '6367796967', '0', '', 531083, 'unverified'),
(1330, 'htZRz', 125435, 'Rinkuayushrinku@gmail.com', '9992751200', '0', '', 434344, 'unverified'),
(1331, 'PwMYE', 924095, '', '9772972915', '0', '', 25820, 'unverified'),
(1332, 'zhnjj', 881147, '', '7056507175', '0', '', 719609, 'unverified'),
(1333, 'SKjpA', 340176, 'nitharwalvhotidevi@gmail.com', '6378849098', '0', '516544', 159664, 'verified'),
(1334, 'Sohilkhan', 920390, 'superchoradedwal@gmail.com', '8003815056', '0', '', 883375, 'verified'),
(1335, 'uVwGR', 3660, '', '9602058290', '0', '', 213913, 'unverified'),
(1336, 'yCpeL', 265729, '', '7988414950', '0', '', 255581, 'unverified'),
(1337, 'cFdLl', 919793, '', '6375124312', '0', '', 460304, 'unverified'),
(1338, 'DDjRw', 287518, '', '7000744008', '0.5', '', 95745, 'verified'),
(1339, 'Aao koi', 276028, 'baljeetgurjar3737@gmail.com', '7414820709', '22', '', 316220, 'verified'),
(1340, 'OFjom', 394906, '', '9050767277', '0', '', 611525, 'unverified'),
(1341, 'MKIqK', 588381, 'Shakirkhan48752@gmail.com', '7727019340', '0', '', 287273, 'verified'),
(1342, 'voaVb', 347365, 'Yarrjitu52@gmail.com', '8708687194', '21', '', 67488, 'verified'),
(1343, 'IUmQJ', 937744, '', '8269924747', '0', '', 878747, 'unverified'),
(1344, 'Sajid6842', 871195, 'Oymonish@mail.com', '9671746842', '44', '90514', 173491, 'verified'),
(1345, 'IpEBC', 302660, 'Vedpalddugky148@gmail.com', '6399409269', '2', '', 559207, 'verified'),
(1346, 'hAfTU', 557506, '', '7976215265', '0', '', 279028, 'unverified'),
(1347, 'xTVjL', 531405, '', '7734032402', '0', '', 674674, 'unverified'),
(1348, 'KmQLQ', 600967, '', '9817694914', '0', '', 34935, 'unverified'),
(1349, 'mDUdN', 624670, '', '6378784746', '0', '', 744801, 'unverified'),
(1350, 'lEGyj', 269240, '', '8307803551', '17', '511250', 422201, 'unverified'),
(1351, 'pZypb', 182327, '', '8386868593', '0', '', 170288, 'unverified'),
(1352, 'Sanni', 818307, 'aslamsingarjamidar2814@gmail.com', '9728452814', '7.5', '90514', 384307, 'verified'),
(1353, 'Papa ji', 326540, 'sumersingh5885@gmail.com', '9672205885', '1948', '', 438465, 'verified'),
(1354, 'TEDXh', 898055, 'WaseemAkram 21145@gmail.com', '9991756430', '3.5', '890870', 558733, 'verified'),
(1355, 'qwUTa', 997128, '', '7983174353', '0', '', 281717, 'unverified'),
(1356, 'kexfz', 225632, 'harkeshmeena2010@gmail.com', '9983013232', '689', '', 620126, 'verified'),
(1357, 'aieyl', 854108, 'santoshpattya8200@gmail.com', '8200853926', '12.5', '', 982626, 'verified'),
(1358, 'bphJf', 728914, '', '9896212253', '0', '', 464161, 'unverified'),
(1359, 'oWooC', 614922, '', '7792894422', '0', '', 165443, 'unverified'),
(1360, 'Haseen', 273125, 'Haseen806884@gmail.com', '8168487979', '0', '', 346085, 'verified'),
(1361, 'kvWKb', 484455, 'Pkrjp03@gmaul.com', '7878636379', '33', '', 700028, 'verified'),
(1362, 'tARse', 711359, '', '7340162423', '0', '', 951255, 'unverified'),
(1363, 'TEBEH', 894831, '', '8005783843', '0', '', 467228, 'unverified'),
(1364, 'Raewy', 307943, 'fkpawarkyara@gmail.com', '9079561988', '0', '', 737604, 'verified'),
(1365, 'aMWKy', 427184, 'Aasukhan370@gmail.com', '9813709384', '26.5', '', 948591, 'verified'),
(1366, 'Soyab dedwal', 576907, 'Soyabkhan9817526@gmail.com', '9817526974', '3', '', 800471, 'verified'),
(1367, 'hDLFo', 647878, '', '9812171932', '0', '', 245570, 'unverified'),
(1368, 'DTuQU', 780060, 'lekhrajmeena2211@gmail.com', '9166125457', '0', '', 954491, 'verified'),
(1369, 'Play kar fast', 272679, 'sufyankhanarmy@gmail.com', '8816846396', '41.5', '', 245838, 'verified'),
(1370, 'gJwXP', 794734, '', '9588955229', '0', '', 948937, 'unverified'),
(1371, 'oMMNR', 780571, '', '9944435065', '0', '', 294307, 'unverified'),
(1372, 'Shakuni', 893913, 'uttammeenaji02@gmail.com', '7742723789', '0.5', '', 467076, 'verified'),
(1373, 'Only kaam25', 779877, '', '7722991978', '0', '', 791701, 'unverified'),
(1374, 'Tayyab Mohammad', 631508, 'taiyab42136@gmail.com', '8387042136', '32.5', '431482', 354121, 'verified'),
(1375, 'Oy monish 6842', 922438, 'imsajidsajji@mail.com', '7426927827', '20', '90514', 840255, 'verified'),
(1376, 'cFoqf', 912228, 'BittuAnsari3753@gmail.com', '9079842207', '0.5', '', 705952, 'verified'),
(1377, 'Oy raheesh 6842', 208852, 'Oymonish@mail.com', '9306266605', '0', '', 444064, 'unverified'),
(1378, 'SBmfx', 948088, '', '7073897362', '0', '', 492785, 'unverified'),
(1379, 'gmRmA', 788326, '', '7688940132', '0', '', 580877, 'unverified'),
(1380, 'rYMlW', 353354, '', '8440804386', '0', '', 222395, 'unverified'),
(1381, 'QHHGn', 633293, '', '9660268401', '0', '', 666417, 'unverified'),
(1382, 'lLQFr', 143583, '', '7014256501', '0', '', 535971, 'unverified'),
(1383, 'KING KHAN', 134362, 'aadilkane91@gmail.com', '9399521051', '36', '', 856514, 'verified'),
(1384, 'JAAN', 206829, 'Leethomars@gmail.com', '7015675150', '48', '', 255897, 'verified'),
(1385, 'Bnl', 868083, 'jk7093169@gmail.com', '8307951386', '26', '', 513412, 'verified'),
(1386, 'UBEPw', 864267, '', '9971233679', '0', '', 239417, 'unverified'),
(1387, 'NCEkS', 690835, '', '8273558382', '0', '', 241791, 'unverified'),
(1388, 'ilmWS', 439157, '', '9982627500', '0', '', 304149, 'verified'),
(1389, 'iUYbd', 114209, '', '7014670922', '0', '', 497739, 'verified'),
(1390, 'opiMn', 248616, '', '9983968700', '0', '', 629605, 'verified'),
(1391, 'Aana mafiya mc', 793377, '', '9131477798', '5277', '0', 36947, 'verified'),
(1392, 'Pandit', 991433, '', '7877943998', '0', '276894', 99485, 'verified'),
(1393, '🦁🦁🦁🦁', 643486, '', '8875757577', '1000', '0', 270612, 'verified'),
(1394, 'Pari', 874766, 'ny4624491@gmail.com', '6367972269', '38', '', 317252, 'verified'),
(1395, 'RBCxW', 676, '', '9928907712', '0', '', 33228, 'unverified'),
(1396, 'hNfVx', 172129, '', '9899426700', '0', '', 588288, 'unverified'),
(1397, 'tvuql', 104011, '', '9461258576', '0', '', 603642, 'unverified'),
(1398, 'jtWJe', 255275, '', '8503800052', '0', '', 795430, 'unverified'),
(1399, 'GKsKR', 243521, '', '9216713409', '0', '', 215052, 'unverified'),
(1400, 'RsWyY', 770417, 'khansharukh991056182@gmail.com', '9813235854', '30', '', 747895, 'verified'),
(1401, 'ndzQd', 433769, '', '9829157124', '0', '', 708195, 'unverified'),
(1402, 'pChgX', 201136, '', '9118307173', '0', '', 673589, 'unverified'),
(1403, 'Hhusu', 802496, 'Arunyadav84016@gmail.com', '8401686120', '15', '', 268835, 'verified'),
(1404, 'kczAW', 588086, '', '8319237003', '0', '', 180389, 'unverified'),
(1405, 'Baby jaan ki beta', 538572, 'Jaggimanish79@gmail.com', '9456162148', '0.5', '', 510987, 'verified'),
(1406, 'Jai shree Ram', 274669, 'Yash861970@gmail.com', '8619707887', '0.5', '', 762896, 'verified'),
(1407, 'uihAs', 350497, 'Siyarammeena10k@gmail.com', '7742136210', '4', '', 797919, 'verified'),
(1408, 'rVlat', 740661, 'meenaprasadgirraj@gmail.com', '8739873992', '20', '', 568209, 'verified'),
(1409, 'Astnw', 988382, '', '7737192750', '475', '', 910973, 'verified'),
(1410, 'QUvmI', 534833, 'Musharaffkhan@gmail.com', '8398967786', '0', '', 726875, 'verified'),
(1411, 'XDRak', 558241, '', '8502989533', '0', '', 841244, 'unverified'),
(1412, 'Fywq', 894775, 'tk6989650@gmail.com', '8302161758', '0', '', 578161, 'verified'),
(1413, 'jareda brother', 15423, 'nishantmeena528@gmail.com', '9649680611', '5.5', '', 274822, 'verified'),
(1414, '7042536431@axisbank', 536014, 'roshanmeena8000596809@gmail.com', '8000596809', '0', '', 144253, 'verified'),
(1415, 'mteYj', 826529, '', '9636588044', '36.5', '', 634874, 'unverified'),
(1416, 'yrZBX', 841417, '', '8890388301', '0', '', 945387, 'unverified'),
(1417, 'Saleem6842', 643193, 'Oymonish@gmail.com', '9813866292', '0', '90514', 65343, 'verified'),
(1418, 'htiMB', 89601, '', '8000300733', '0', '', 545005, 'unverified'),
(1419, 'imoLv❌', 458268, 'mohdsaif55yb@gmail.com', '9610059121', '23', '504059', 317061, 'verified'),
(1420, 'QEZPG', 113080, '', '8178668604', '0', '923973', 642739, 'unverified'),
(1421, 'NTcIV', 352922, '', '9828722017', '100', '', 88364, 'unverified'),
(1422, 'Lon', 132392, 'Anand Kumar mandal @gmail.com', '8532924968', '28', '228321', 787860, 'verified'),
(1423, 'XnnPH', 356588, '', '7400624931', '0', '', 323110, 'unverified'),
(1424, 'Saruk 312', 223084, '', '7027417312', '15.5', '818321', 7681, 'unverified'),
(1425, 'Shahid6842', 725230, 'Oymonish@mail.com', '9813637827', '1', '90514', 300528, 'verified'),
(1426, 'Hffdd', 644060, 'dalipyogi1864@gmail.com', '9896971864', '55', '', 170616, 'verified'),
(1427, 'YeOBK', 604092, '', '6355597168', '0', '687485', 17842, 'unverified'),
(1428, 'WHzKQ', 488569, '', '8000847313', '0', '', 174157, 'unverified'),
(1429, 'Loda 2.2', 13541, 'pcmeena717@gmail.com', '6350689617', '29', '', 420652, 'verified'),
(1430, 'Chiku', 46985, 'sk5673166@gmial.com', '9116761049', '400', '504049', 556374, 'verified'),
(1431, 'ROYKHANKHAN FELLOW F', 256456, 'sabbirkhann721@gmail.com', '7701970184', '36', '', 760763, 'verified'),
(1432, 'PImWq', 652072, 'sahusaurabh835@gmail.com', '8109363424', '32', '', 32500, 'unverified'),
(1433, 'UNOJt', 118661, 'shanirathor09@gmail.com', '9098709134', '0', '', 192360, 'unverified'),
(1434, 'Stuv', 96199, 'yadrammeena2005@gmail.com', '6367736517', '0', '', 987897, 'verified'),
(1435, 'OwfuV', 796328, '', '9166134791', '0', '', 374394, 'unverified'),
(1436, 'TeDVx', 867324, '', '8740037065', '0', '', 430738, 'unverified'),
(1437, 'Aasim Rana', 27723, 'aasimrana534@gmail.com', '9257941960', '0.5', '504049', 499186, 'verified'),
(1438, 'Ludu', 953141, 'HANSEEDKHAN218@gmail.com', '9813650147', '1.5', '', 112206, 'verified'),
(1439, 'jsBII', 805201, 'altafhussain98134@gmail.com', '9813489560', '44.5', '', 643704, 'verified'),
(1440, 'Fkskcf', 984155, 'Ankit8619@gmail.com', '8619249343', '93.5', '', 710171, 'verified'),
(1441, 'ykdYT', 584756, '', '9818878832', '0', '', 399650, 'unverified'),
(1442, 'Mulli6842', 749422, 'aamirsuhail3637@gmail.com', '9518878832', '1', '90514', 121950, 'verified'),
(1443, 'iLKVx', 39578, '', '9509084629', '0', '', 799552, 'unverified'),
(1444, 'mhNGp', 387833, 'Vk5049966@gmail.com', '7689048073', '0.5', '', 493893, 'verified'),
(1445, 'wtgay', 897897, '', '8824775157', '0', '', 818912, 'unverified'),
(1446, 'KAgym', 61531, 'suhailchaudhry85@gmail.com', '9991198912', '0', '', 277903, 'verified'),
(1447, 'JDwJK', 360549, 'ghanshyammeena20889@gmail.com', '8302122156', '0.5', '', 809943, 'verified'),
(1448, 'fWfmg', 168529, '', '6367086992', '0', '', 750198, 'unverified'),
(1449, 'azQUY', 761244, '', '6367086992', '0', '', 855044, 'unverified'),
(1450, 'tWHxo', 352278, 'aloriyaabhisgek92@gmail.com', '8094843752', '0', '', 27347, 'verified'),
(1451, 'CeuRK', 541252, '', '8000995103', '0', '', 885390, 'unverified'),
(1452, 'kismat', 326286, 'rajmeenajjjj8890@gmail.com', '8890220641', '0', '', 383001, 'verified'),
(1453, 'Iddjkf', 559620, 'dilshadkhan1666@gmail.com', '8398012681', '2.5', '', 623811, 'verified'),
(1454, 'jMLGM', 450916, '', '9664381512', '0', '', 208297, 'unverified'),
(1455, 'Vishu sharma', 532737, '5625pawansharma@gmail.com', '9664381542', '0.5', '', 817748, 'verified'),
(1456, 'VfDEQ', 89498, '', '9466064271', '0', '', 946506, 'unverified'),
(1457, 'MoXGA', 5593, '', '6265002678', '1000', '', 152909, 'unverified'),
(1458, 'nYJiP', 545321, '', '8290998696', '0', '', 744324, 'unverified'),
(1459, 'qwJQS', 976592, '', '9261212142', '0', '', 37513, 'unverified'),
(1460, 'TlJnC', 178099, '', '9351597480', '0', '', 532928, 'unverified'),
(1461, 'YUTpO', 402145, '', '9950567439', '0', '', 842480, 'unverified'),
(1462, 'UwbkV', 242395, '', '7014465973', '0', '', 166392, 'unverified'),
(1463, 'GkOmx', 772125, '', '76.0972109', '0', '', 699280, 'unverified'),
(1464, 'Vicit', 123593, '', '7240139187', '0', '', 426655, 'unverified'),
(1465, 'kPuFx', 896508, '', '9887103875', '0', '', 769066, 'unverified'),
(1466, 'Safar', 203474, 'khanemitra71@gmail.com', '8306954067', '4.5', '', 283877, 'verified'),
(1467, 'BKups', 859351, '', '9817660253', '0', '', 275637, 'unverified'),
(1468, 'Kejij', 425616, 'waseemkhan2081992@gmail.com', '9584103202', '0', '', 835911, 'verified'),
(1469, 'Islam', 121836, 'ESLAMKHANK80@gmail.com', '7239831108', '48', '', 376877, 'verified'),
(1470, 'iXQTm', 912703, '', '9694078752', '0', '', 36831, 'unverified'),
(1471, 'rjMpT', 339956, 'rajabhaduriya50@gmil.com', '8957434774', '27.5', '', 183031, 'verified'),
(1472, 'BnjaW', 308315, '', '9588540679', '0', '', 547683, 'unverified'),
(1473, 'utsZf', 553704, 'rk2078964zgmail.com', '7015263773', '27.5', '', 365706, 'verified'),
(1474, 'gpgBY', 56249, '', '7027077062', '0', '640071', 844274, 'unverified'),
(1475, 'GF GF 😏', 971239, 'ksihin61@gmail.co', '8813921277', '0.5', '365706', 529302, 'verified'),
(1476, 'cmfPk', 607060, '', '8708633468', '0', '', 731073, 'unverified'),
(1477, 'Aasif', 185058, 'kasimshikrawar@gmail.com', '8239295396', '0.5', '', 980629, 'verified'),
(1478, 'sqGIj', 114460, 'satishalariya178@gmail.com', '8502028671', '48.5', '', 533586, 'pending'),
(1479, 'IuLWl', 138197, '', '9050802014', '0', '', 946598, 'unverified'),
(1480, 'ZUGqu', 627318, '', '9610828445', '0', '', 374346, 'unverified'),
(1481, 'MUHhu', 703646, '', '9991451966', '0', '', 195306, 'unverified'),
(1482, 'lKvHj', 94156, '', '9671753102', '0', '', 86300, 'unverified'),
(1483, 'qjMQZ', 979325, 'rahulkuamar9050@gamil.com', '9050898702', '0', '', 315844, 'verified'),
(1484, 'Gidas', 6353, 'tk5454882@gmail.com', '8955479939', '197.5', '', 660450, 'verified'),
(1485, 'pnuTr', 521777, '', '9588211827', '0', '', 297493, 'unverified'),
(1486, 'UrErx', 352717, '', '6299754166', '0', '', 715864, 'unverified'),
(1487, 'nqCzZ', 159561, 'SONUMANGLA9255884092@gmail.com', '9255884092', '20.5', '195201', 157302, 'verified'),
(1488, 'dHqku', 529445, '', '9950296388', '0', '', 255669, 'unverified'),
(1489, 'LRrXN', 585334, 'md.javeed.g@gmail.com', '9160241164', '6.5', '', 203562, 'verified'),
(1490, '317276', 453431, '', '8930767231', '0', '744996', 698800, 'unverified'),
(1491, 'dPqcU', 145074, 'Pooja8528@gmaio.com', '9649519859', '0', '', 729222, 'verified'),
(1492, 'welqj', 731038, '', '7891350133', '0', '', 681519, 'unverified'),
(1493, 'bylMN', 7414, 'vinod9649519859@gmail.com', '9001755869', '0.5', '', 614469, 'verified'),
(1494, 'PLUWt', 448257, '', '9376907909', '0', '', 734145, 'unverified'),
(1495, 'PIYVu', 63650, '', '9991573160', '15', '', 430847, 'unverified'),
(1496, 'JBsHK', 150644, '', '6376681981', '0', '', 333533, 'unverified'),
(1497, 'bkenN', 207710, '', '8826526703', '0', '', 871186, 'unverified'),
(1498, 'Fast chalta h to aaj', 20923, '', '7878928281', '47.5', '', 937177, 'unverified'),
(1499, 'WiDzs', 501309, '', '9817741265', '45.5', '', 615455, 'unverified'),
(1500, 'iHBFJ', 995379, 'santoshmeena5271@gmail.com', '9887485271', '0', '', 396531, 'verified'),
(1501, 'WfOVe', 273903, '', '7340569185', '0', '', 277119, 'unverified'),
(1502, 'YOkCp', 80219, '', '7297981302', '0', '', 595419, 'unverified'),
(1503, 'Pogbds', 749783, 'KaluramMeena5077@gmail.com', '8529384690', '40.5', '', 80706, 'verified'),
(1504, 'UNSKM', 83673, '', '9636443433', '0', '', 564994, 'unverified'),
(1505, 'Aao Bhai jaan 😊', 523860, 'maliksoyel26@gmail.com', '9358014250', '1127.5', '504059', 572421, 'verified'),
(1506, 'SALAR 💪', 809603, 'khansohid3222010@gmail.com', '9571667079', '10', '', 461452, 'verified'),
(1507, 'JOcGv', 640977, '', '6375429004', '0', '', 556442, 'unverified'),
(1508, 'RwJbk', 345021, '', '7014803350', '0', '', 921033, 'unverified'),
(1509, 'EqGzA', 141545, '', '8708189808', '0', '', 801951, 'unverified'),
(1510, 'niswN', 303195, '', '7850877891', '0', '', 894329, 'unverified'),
(1511, 'palgR', 928397, '', '7340008574', '0', '', 488441, 'unverified'),
(1512, 'jdDZF', 646515, '', '9785434397', '0', '', 913424, 'unverified'),
(1513, 'Khatu wale', 246278, 'devilalmeena1174@gmail.com', '6377287206', '7', '', 768449, 'unverified'),
(1514, 'iNxLa', 487645, '', '7340639064', '0', '', 864335, 'unverified'),
(1515, 'GclDo', 834548, '', '8949700144', '0', '', 776065, 'unverified'),
(1516, 'AJGGK', 859095, '', '8005972984', '0', '', 96381, 'unverified'),
(1517, 'Ravi', 4834, 'r48295610@gmail.com', '9636277060', '0', '', 309721, 'unverified'),
(1518, 'qLzzU', 293178, '', '9109455164', '0', '', 652799, 'unverified'),
(1519, 'vavDH', 443774, 'naseem199696@gmail.com', '9518208380', '343', '', 188284, 'verified'),
(1520, 'VGtxZ', 945909, '', '9509424711', '0', '', 950758, 'unverified'),
(1521, 'ARPac', 849279, '', '7414873753', '0', '', 834470, 'unverified'),
(1522, 'Matwa', 249260, 'deepakmatwa851@gmail.com', '8949483828', '1.5', '', 521703, 'verified'),
(1523, 'nsaty', 665594, '', '7891465710', '0', '', 163289, 'unverified'),
(1524, 'RAOiz', 16735, '', '9649329066', '0', '', 875834, 'unverified'),
(1525, 'KrWMC', 865044, '', '9812877971', '0', '', 796077, 'unverified'),
(1526, 'tdzqL', 782847, '', '9671470179', '0', '', 618088, 'unverified'),
(1527, 'EpuJg', 633361, '', '6350178418', '0', '', 323075, 'unverified'),
(1528, 'ichFA', 201248, '', '9336237402', '0', '', 743808, 'unverified'),
(1529, 'yHMdM', 311810, '', '9236600436', '0', '', 421861, 'unverified'),
(1530, 'kaNeE', 878184, 'sukhdevchaudhary162@gmail.com', '9870817256', '0', '', 558208, 'pending'),
(1531, 'CDoJv', 952453, '', '9798809537', '0', '', 744667, 'unverified'),
(1532, 'CGfGK', 836706, '', '7374020533', '5', '', 807916, 'unverified'),
(1533, 'iVGoY', 399776, '', '9518428266', '0', '', 125202, 'unverified'),
(1534, 'ODvcT', 36093, 'Ekram khan 41900@gmil.com', '8059441590', '50', '', 310934, 'verified'),
(1535, 'OZWmw', 365539, '', '9813135837', '0', '', 240335, 'unverified'),
(1536, 'uMEEs', 937469, 'oyejahid536@gmail.com', '8168287951', '0', '', 477462, 'verified'),
(1537, 'Rp Meena', 136663, '', '9529131030', '0', '399634', 991778, 'unverified'),
(1538, 'YzwTo', 40512, '', '7742342209', '0', '', 705954, 'unverified'),
(1539, 'nDTSr', 227831, '', '9461424826', '42.5', '', 733211, 'unverified'),
(1540, 'Maa chudale apni', 384629, 'Mohdazhar2762@gmail.com', '8930288786', '13.5', '', 377707, 'verified'),
(1541, 'eMewN', 263864, 'MN8701720@gmail.com', '8307624840', '0.5', '', 704843, 'verified'),
(1542, 'YWGzy', 671826, '', '9588784846', '0', '', 933953, 'unverified'),
(1543, 'hZqmR', 847046, '', '9588784846', '0', '', 655973, 'unverified'),
(1544, 'Zhdfm', 110927, '', '9588784846', '0', '', 688857, 'unverified'),
(1545, 'oHLrO', 908425, '', '9588784846', '0', '', 802070, 'unverified'),
(1546, 'bTjpD', 687270, 'p3031510@gmail.com', '6376262858', '46.5', '', 505540, 'verified'),
(1547, 'ATCNf', 873687, '', '8239900198', '0', '', 29308, 'unverified'),
(1548, 'Affa', 480242, '', '8930191432', '0', '744996', 430525, 'unverified'),
(1549, 'Saddam6842', 63337, 'Oymonish@mail.com', '9991514609', '0', '90514', 312661, 'verified'),
(1550, 'LQScO', 609662, '', '9680934627', '0', '', 686042, 'unverified'),
(1551, 'kqdHp', 666234, 'Ayub62527655@gamil', '9461459049', '0', '504059', 732532, 'verified'),
(1552, 'M k', 840320, 'MAMURAKHAN8279@GMAIL.COM', '8279200149', '1477.5', '', 239003, 'verified'),
(1553, 'BMFZT', 180299, 'khanmansar854@gmail.com', '9983483562', '35', '', 109986, 'verified'),
(1554, 'IakqY', 25929, '', '8426025863', '0', '', 753011, 'unverified'),
(1555, 'Dilsad, 6842', 701523, 'khandilsahd9053507172@gmail.mon', '9053507172', '0', '', 474324, 'verified'),
(1556, 'Sheetal', 17091, 'ajayjorwal21@gmail.com', '7891532208', '38', '', 795259, 'verified'),
(1557, 'hLoGH', 403650, '', '6375830910', '0', '', 999670, 'unverified'),
(1558, 'kUCMf', 336125, 'Indrajeetgoutam87@gmail.com', '7300467938', '0', '', 137024, 'verified'),
(1559, 'oBsgc', 890060, '', '9828541806', '0', '', 195235, 'unverified'),
(1560, 'CbWIo', 890334, 'Pallumeena2001', '9351292951', '0', '', 503833, 'verified'),
(1561, 'Mumtaj khan', 200043, 'bdk673572@gmail.com', '8233031526', '45', '', 358498, 'verified'),
(1562, 'SSodk', 13079, '', '7878762206', '0', '', 407781, 'unverified'),
(1563, 'XUwkY', 569787, '', '7976484249', '0', '', 936853, 'unverified'),
(1564, 'Filpkart', 636645, 'Anuradhadevi8542@gmail.com', '8542966615', '0', '', 886797, 'verified'),
(1565, 'JK NO FRESH', 715191, 'Jsharma17029@gmail.com', '9588727707', '6.5', '335620', 552014, 'unverified'),
(1566, 'zGYMt', 740519, '', '6378982605', '0', '', 688423, 'unverified'),
(1567, 'NaRbw', 612737, 'Parveenkr1588@gmail.com', '8059509614', '41.5', '', 31914, 'verified'),
(1568, 'Meena ji', 737900, 'singvirendra478@gmail.com', '7597680730', '0', '', 872021, 'verified'),
(1569, 'Dharmendra meena 😈', 878436, 'arbazman9@gmail.com', '9039885899', '0.5', '', 995220, 'unverified'),
(1570, 'KTCaU', 378494, 'Pankaj25011995@gmail.com', '9782454100', '0.5', '', 658936, 'verified'),
(1571, 'fPneo', 794483, '', '8209833369', '0', '', 296427, 'unverified'),
(1572, 'KLaQO', 412494, '', '7230953153', '0', '', 338242, 'unverified'),
(1573, 'yITDn', 345382, '', '9671746843', '0', '', 318560, 'unverified'),
(1574, 'GogQC', 68515, '', '8058851670', '0', '', 74127, 'unverified'),
(1575, 'EVxlf', 617101, '', '9983968702', '0', '', 34345, 'unverified'),
(1576, 'DfRFq', 683283, '', '9982627509', '0', '', 807781, 'unverified'),
(1577, 'eNbXR', 123429, '', '8085743814', '0', '', 628243, 'unverified'),
(1578, 'JROxW', 676227, '', '9671694092', '221.5', '', 639364, 'verified'),
(1579, 'Tofere230', 464741, '', '8950230252', '0', '744996', 751616, 'unverified'),
(1580, 'wGcHt', 413844, '', '8278676100', '0', '', 445289, 'unverified'),
(1581, 'VtARu', 458188, '', '8278676100', '0', '', 537301, 'unverified'),
(1582, 'EWSNg', 628657, '', '8278676100', '0', '', 803161, 'unverified'),
(1583, 'hFhTT', 262070, '', '9305594033', '0', '', 601388, 'unverified'),
(1584, 'xImbk', 544736, '', '9050129979', '0', '', 617194, 'unverified'),
(1585, 'Vkmeena', 705196, 'Vikashmeena2992@gmail.com', '7742852992', '0.5', '', 226524, 'unverified'),
(1586, 'voRRS', 13506, '', '9929909240', '0', '', 935738, 'unverified'),
(1587, 'Ms', 143566, 'Aaseefkhan2000@gmail.com', '9352696994', '27', '', 805833, 'verified'),
(1588, 'Always won', 465113, 'nitinahirwar36@gmail.com', '6261435993', '13.5', '', 764266, 'verified'),
(1589, 'qicow', 193795, '', '8983958026', '0', '309721', 808764, 'unverified'),
(1590, 'BslSE', 416924, '', '7417058123', '0', '309721', 998825, 'unverified'),
(1591, 'Rishi', 470098, 'neerajsahni7236@gmail.com', '7236977705', '0', '601388', 863065, 'verified'),
(1592, 'PlwJf', 631625, 'islamkhan726990@gmail.com', '9588726990', '47.5', '', 382372, 'verified'),
(1593, 'QmALs', 706303, '', '7357852482', '0', '', 930947, 'unverified'),
(1594, 'pyJcM', 311599, '', '7735766207', '0', '', 876029, 'unverified'),
(1595, 'vvnSE', 194192, 'ok883911@gmail.com', '9509099363', '47', '', 47007, 'verified'),
(1596, 'lSSQV', 296928, '', '8426993498', '0', '309721', 748665, 'unverified'),
(1597, 'UkvYW', 77717, '', '8003955814', '0', '309721', 563809, 'unverified'),
(1598, 'Hjgjgvh', 477024, 'chandraprakash7004@gmail.com', '9929777004', '0', '', 194667, 'verified'),
(1599, 'Nosad khan', 388874, '', '6377308561', '36.5', '', 399579, 'unverified'),
(1600, 'MEWATI CHHORA', 951139, '', '6350428741', '0', '', 612920, 'unverified'),
(1601, 'gyyur', 255632, '', '9137088757', '0', '', 119323, 'unverified'),
(1602, 'WmwfS', 790551, '', '9649340275', '0', '', 424912, 'unverified'),
(1603, 'Ak', 896962, 'ashokamrabad@gmail.com', '8302894859', '4.5', '', 98174, 'verified'),
(1604, 'Tera papa', 165294, 'ashokmeena83028@gmail.com', '7732813218', '0', '', 853614, 'verified'),
(1605, 'Ak s', 404302, 'juberkhan5917@gmail.com', '9351685917', '38', '', 162412, 'verified'),
(1606, 'zAget', 932734, '', '9024275327', '0', '', 573508, 'unverified'),
(1607, 'hGAqo', 986981, '', '9024275327', '0', '', 866546, 'unverified'),
(1608, 'HR w', 310415, '', '8094187447', '24.5', '', 371263, 'unverified'),
(1609, 'hQUjn', 558090, '', '9982820908', '0', '', 897875, 'unverified'),
(1610, 'GxGLI', 39557, '', '8875757575', '0', '', 77408, 'unverified'),
(1611, 'rtFQi', 102157, '', '8269927722', '0', '', 99694, 'unverified'),
(1612, 'HDnqE', 683060, '', '9558829042', '27.5', '', 222756, 'unverified'),
(1613, 'wkykg', 860176, '', '9509049842', '0', '', 195909, 'unverified'),
(1614, 'Itbnb', 460932, 'vakeelk684@gmail.com', '6377051025', '0', '', 90238, 'verified'),
(1615, 'btkOc', 156836, '', '9460179340', '0', '', 955292, 'unverified'),
(1616, 'VUUwT', 242345, '', '8949561205', '0', '456244', 558504, 'unverified'),
(1617, 'LyxDY', 118378, 'smeo914000@gmail.com', '9991427923', '0', '', 485908, 'verified'),
(1618, 'Tumhari bahan ke log', 556416, 'smeo914000@gmail.com', '8307671120', '49', '485908', 181392, 'pending'),
(1619, 'XbNuC', 441887, '', '9896171353', '0', '', 926959, 'unverified'),
(1620, 'YLHOC', 148557, '', '7995820221', '0', '', 900468, 'unverified'),
(1621, 'iQiAg', 597862, '', '9636277797', '0', '', 46386, 'unverified'),
(1622, 'fmGGe', 267401, 'DHARAsingh0098@gmail.com', '9785920654', '24.5', '', 565923, 'verified'),
(1623, 'tdeRE', 153643, '', '9950019351', '0', '', 408087, 'unverified'),
(1624, 'WSCtw', 259341, '', '8442060043', '0', '', 846211, 'unverified'),
(1625, 'ERhfI', 887178, '', '8996056031', '0', '', 935270, 'unverified'),
(1626, 'Bbtar', 145503, '', '7996056031', '0', '', 41122, 'unverified'),
(1627, 'gLPNs', 416319, '', '7976056031', '0', '', 610691, 'unverified'),
(1628, 'FdOoI', 437911, 'darshangurjar815@gmail.com', '8619503577', '5.5', '', 573533, 'verified'),
(1629, 'FdINJ', 435621, 'aarsad0098@gmail.com', '8685890448', '35', '', 751702, 'verified'),
(1630, 'hjVKy', 729222, 'rinkukmrmn21@gmail.com', '6376562818', '20', '', 911315, 'verified'),
(1631, 'DngKK', 63354, '', '9057700131', '0', '', 727033, 'unverified'),
(1632, 'neQyB', 803599, '', '7014216429', '0', '', 977186, 'unverified'),
(1633, 'frfsg6842', 342782, '', '8887685985', '0.5', '90514', 892850, 'unverified'),
(1634, 'JAWPw', 214583, '', '9797573851', '0', '90514', 524730, 'unverified'),
(1635, 'MiOPO', 766200, '', '9256528754', '0', '', 656085, 'unverified'),
(1636, 'Jmpqc', 910709, '', '9256528754', '0', '', 59873, 'unverified'),
(1637, 'YLdjB', 957923, '', '9256528754', '0', '', 290462, 'unverified'),
(1638, 'hEhpy', 919791, '', '9660463049', '0', '', 231850, 'unverified'),
(1639, 'Rahul', 718208, 'Vinod 96631@GMAIL.com', '7839063342', '14', '', 791562, 'verified'),
(1640, 'GIcjp', 283529, '', '7839063342', '0', '', 148147, 'unverified'),
(1641, 'Msadgfasi', 315989, 'Maksud Ali 34511@Gmail.com', '9653786796', '97', '504059', 715770, 'verified'),
(1642, 'Jeeva', 336807, 'sehraprakash@gmail.com', '9785142946', '2.5', '', 958019, 'verified'),
(1643, 'BBWip', 128012, '', '8441091740', '0', '974144', 180465, 'unverified'),
(1644, 'Dyere', 917180, '', '8199867475', '0', '90514', 971660, 'unverified'),
(1645, 'wwcVs', 963727, '7', '7042536431', '0', '953202', 0, 'verified'),
(1646, 'kJhjH', 307106, '', '6367342524', '0', '', 542410, 'unverified'),
(1647, 'Rohit kumar', 234672, 'Ummark8294@Gmail.com', '9413588943', '0.5', '', 646014, 'verified'),
(1648, 'Anjali sharma', 263339, '', '9930206464', '15048.5', '304618', 304618, 'unverified'),
(1649, 'pqxfD', 646061, '', '8559944426', '0', '', 137543, 'unverified'),
(1650, 'lpFEz', 114239, '', '9828676778', '0', '', 358704, 'unverified'),
(1651, 'yRbhk', 362481, '', '9588267963', '0', '869293', 154486, 'unverified'),
(1652, 'OyrBD', 771826, '', '7375030533', '0', '', 833037, 'unverified'),
(1653, 'iSYUw', 886077, '', '9414404698', '0', '', 380465, 'unverified'),
(1654, 'nkumX', 933019, '', '8764018269', '0', '', 716661, 'unverified'),
(1655, 'UnlmW', 956161, '', '8949165059', '0', '90514', 822612, 'unverified'),
(1656, 'wJqZN', 54920, 'khantk7665190734@gmail.com', '7665190734', '1', '90514', 166222, 'verified'),
(1657, 'johuv', 440745, 'salimkhantijara07851@gmail.com', '7891608974', '0', '', 981427, 'verified'),
(1658, 'FUOil', 131601, 'meenapradeep7240@gmail.com', '9772144765', '0', '', 507218, 'verified'),
(1659, 'OGtZB', 749505, '', '9509347651', '0', '', 569070, 'unverified'),
(1660, 'IpSRZ', 400105, '', '7000112992', '0', '', 399012, 'unverified'),
(1661, 'ggoSA', 991631, '', '9926315242', '0', '', 140311, 'unverified'),
(1662, 'RBCeI', 596667, '', '9549082580', '0', '', 762112, 'unverified'),
(1663, 'XUhFy', 873362, '', '9549161344', '0', '892850', 736467, 'unverified'),
(1664, 'mIwxE', 335134, '', '7737586462', '0', '', 165680, 'unverified'),
(1665, 'Raja king', 299198, 'rajanmahawar2005@gmail.com', '7878044253', '37', '179460', 705931, 'unverified'),
(1666, 'cnMQY', 242310, '', '6378909857', '0', '', 70372, 'unverified'),
(1667, 'lsvsa', 885347, '', '8187907315', '0', '', 104494, 'unverified'),
(1668, 'rMTLN', 313417, '', '8107907315', '0', '', 10712, 'unverified'),
(1669, 'LyuHp', 66361, '', '7877584513', '0', '', 734327, 'unverified'),
(1670, 'xsiuP', 69062, '', '9513211794', '0', '100559', 607366, 'unverified'),
(1671, 'Rina', 471521, 'anwarkhan42423074@gmail.com', '9813211794', '3.5', '100559', 948219, 'verified'),
(1672, 'No fresh ID', 651215, '', '8302323846', '4', '498443', 498443, 'verified'),
(1673, 'CbIio', 969446, '', '8239717220', '0', '', 556844, 'unverified'),
(1674, 'OHKcx', 382319, '', '7877249077', '0', '', 773785, 'unverified'),
(1675, 'Ekekkw', 257969, 'Sakilkhan@gamil.com', '7027593658', '46.5', '228321', 108529, 'unverified'),
(1676, 'nlBBu', 482338, '', '6368909857', '0', '', 381514, 'unverified'),
(1677, 'USQup', 833764, '', '9467584295', '0', '', 771517, 'unverified'),
(1678, 'ZFBNs', 342020, 'soyabhussain70@gmail.com', '9813480908', '10.5', '', 854091, 'verified'),
(1679, 'Kalicharan', 351927, '', '7015400100', '400.5', '854091', 850026, 'unverified'),
(1680, 'drQpX', 473358, '', '8690176332', '0', '', 491454, 'unverified'),
(1681, 'CfXTe', 522460, '', '9334820467', '0', '', 968131, 'unverified'),
(1682, 'PrjHL', 867846, '', '9950325713', '0', '', 221400, 'unverified'),
(1683, 'mBBwf', 549689, '', '6378321768', '0', '', 547595, 'unverified'),
(1684, 'bbnPn', 523733, '', '9887387668', '0', '', 522592, 'unverified'),
(1685, 'Jay shree shyam 🌹', 36138, 'sain35351@gmail.com', '9887387055', '24.5', '', 249657, 'verified'),
(1686, 'iqnvz', 846388, '', '8619900926', '0', '', 308798, 'unverified'),
(1687, 'ALKGc', 823242, '', '6376456473', '0', '', 60230, 'unverified'),
(1688, 'HJSQY', 663331, '', '6376456473', '0', '', 293288, 'unverified'),
(1689, 'Killer BoY', 191063, '', '8058412300', '0', '', 192745, 'unverified'),
(1690, 'ftFjY', 984142, '', '7023049187', '0', '', 527707, 'unverified'),
(1691, 'aXWCf', 347167, '', '8302787499', '0', '', 527569, 'unverified'),
(1692, 'nMJtL', 518963, '', '8854914830', '0', '', 357708, 'unverified'),
(1693, 'FvknE', 31732, '', '9887676249', '0', '', 74954, 'unverified'),
(1694, 'MD Khan', 800129, 'Fazilkhan83076@gmail.com', '8307679126', '0.5', '90514', 336021, 'verified'),
(1695, 'oMJke', 342677, '', '9813125893', '0', '393526', 665360, 'unverified'),
(1696, 'King 👑 12', 16239, 'pawanmeenaalwar2017@gmail.com', '6350055303', '47.5', '', 997196, 'verified'),
(1697, 'Only क्लासिक', 762650, 'dayameena5430@gmail.com', '7014366211', '1', '', 951379, 'verified'),
(1698, 'VVtCn', 791014, '', '8303954067', '0', '', 172986, 'unverified'),
(1699, 'NnMtS', 188710, '', '7297859951', '0', '', 122992, 'unverified'),
(1700, 'GAjNR', 765041, '', '7976322310', '0', '386432', 530985, 'unverified'),
(1701, 'AtXsX', 738241, '', '8003220811', '0', '', 365914, 'unverified'),
(1702, 'jkcez', 526060, '', '6375717194', '0', '', 841573, 'unverified'),
(1703, 'ZUspF', 382772, '', '8432735649', '0', '', 388430, 'unverified'),
(1704, 'Love', 91058, 'Injmamulhaq@gmail.com', '9350167049', '10.5', '228321', 372087, 'verified'),
(1705, 'Jai shree krishna', 697430, 'nemisattawan786@gmail.com', '9166352577', '14.5', '', 66541, 'verified'),
(1706, 'VgmxU', 213178, '', '9671369464', '0', '', 230486, 'unverified'),
(1707, 'NIbzh', 822030, '', '7340126113', '0', '', 196898, 'unverified'),
(1708, 'Yaro ka yr', 603675, 'pankajdlp15797@gmail.com', '6376607557', '28.5', '', 821414, 'verified'),
(1709, 'nYrSs', 484418, '', '8949061607', '0', '', 326451, 'unverified'),
(1710, 'aIIkY', 397165, '', '8708713296', '0', '', 969172, 'unverified'),
(1711, 'EhlHD', 592527, 'Vishramvishu7@gmail.com', '7232074031', '22.5', '', 319550, 'verified'),
(1712, 'JCpjL', 289060, 'ravimahwa5268@gmail.com', '8209097302', '4.5', '', 364356, 'verified'),
(1713, 'Shroek', 171066, 'meenasarkar009@gmail.com', '8302320396', '0', '', 694787, 'verified'),
(1714, 'dStHh', 522757, '', '9024165439', '0', '', 315934, 'unverified'),
(1715, 'CSLcG', 943419, '', '9509106855', '0', '', 791749, 'unverified'),
(1716, 'sEBnZ', 661045, 'nareshsharmapattya@gmail.com', '7062610516', '2.5', '', 733622, 'verified'),
(1717, 'Sskd', 407614, 'dkmeenachurani2035@gmail.com', '7073084974', '5', '', 79209, 'verified'),
(1718, 'XZqwb', 635713, '', '9671359464', '0', '', 448261, 'unverified'),
(1719, 'Priyanka Sharma', 167337, 'nktrakeshkumarverma@gmail.com', '7691007475', '0.5', '', 603080, 'verified'),
(1720, 'LzMOT', 547165, '', '9887969186', '0', '', 350162, 'unverified'),
(1721, 'Froad link hai', 615710, 'mamrej959@gmail.com', '7240509964', '1', '', 942793, 'verified'),
(1722, 'KfOQZ', 949165, 'BHUPENDRASINGHRAJAWAT@gmail.com', '9950159462', '0', '', 564038, 'verified'),
(1723, 'J m', 298569, 'sintusim834@gmail.com', '6377189750', '0', '797040', 969458, 'verified'),
(1724, 'wQPPr', 439185, '', '8824747780', '0', '557904', 570305, 'unverified'),
(1725, 'Naresh onli500++game', 562553, 'meena.ramnaresh010@gmail.com', '9318351865', '9.5', '', 268247, 'verified'),
(1726, 'gTYRR', 947447, 'najismewati9@gmail.com', '9812526375', '0.5', '', 72739, 'verified'),
(1727, 'pdxGZ', 783263, '', '9351233857', '0', '570305', 208763, 'unverified'),
(1728, 'gOcNI', 698354, 'phajidakhanakhana@gmail.com', '8875628046', '10', '', 745382, 'verified'),
(1729, 'qYCOm', 677818, '', '8369467191', '33.5', '', 530501, 'unverified'),
(1730, 'NMXGy', 197666, '', '9887527858', '0', '', 488059, 'unverified'),
(1731, 'Kiaki', 116511, '', '9887527858', '0', '', 706904, 'unverified'),
(1732, 'rXhuz', 461575, 'meenarajnesh498@gmail.com', '8955513164', '8', '', 114292, 'verified'),
(1733, 'wmwOx', 879999, '', '9558781964', '0', '', 574043, 'unverified'),
(1734, 'lUSIh', 286568, '', '8058371634', '0', '', 367608, 'unverified'),
(1735, 'Hszpi', 582147, '', '8421023962', '0', '', 716369, 'unverified'),
(1736, 'eZdiJ', 491806, '', '9116817937', '0', '', 866440, 'unverified'),
(1737, 'Sk__Meena__420', 707953, '', '9785001891', '0', '', 538597, 'unverified'),
(1738, 'Ytuhd', 193303, 'Rajveer Prajapat654@gmail.com', '8955225323', '0', '', 316914, 'unverified'),
(1739, 'BADuC', 971605, '', '9648974365', '0', '', 864525, 'unverified'),
(1740, 'hQqli', 803588, '', '9518047966', '0', '', 666145, 'unverified'),
(1741, 'TKVsy', 64684, '', '9414685325', '0', '', 451297, 'unverified'),
(1742, 'AtGJK', 629434, '', '9799451553', '0', '755533', 228053, 'unverified'),
(1743, 'hqGye', 580961, '', '9079080198', '390', '', 719259, 'unverified'),
(1744, 'pAiwC', 965756, '', '7221872283', '0', '', 374067, 'unverified'),
(1745, 'KTBgA', 452237, '', '8302223121', '0', '', 644974, 'unverified'),
(1746, 'qraBv', 340089, 'rajeshmeena0336@gmail.com', '8385999010', '42.5', '', 980953, 'verified'),
(1747, 'R A M', 409765, 'shrigirrajnettech@gmail.com', '9785600666', '200.5', '', 338361, 'verified'),
(1748, 'ZsZnd', 750716, 'chandkham250@gmail.com', '7988879173', '0.5', '', 680172, 'verified'),
(1749, 'Meena.jaipur', 317934, 'vakeelkhan2574@gmail.com', '8930922574', '0', '', 885959, 'verified'),
(1750, 'Khan', 845119, 'Shammuk06@gmail.com', '9813336585', '27.5', '', 413181, 'verified'),
(1751, 'ujEbU', 997143, '', '9910041288', '0', '', 110817, 'unverified'),
(1752, 'FPZOa', 338351, '', '9772141537', '0', '', 357282, 'unverified'),
(1753, 'fhNGq', 466389, '', '8769665709', '0', '125265', 985968, 'unverified'),
(1754, 'jkDmJ', 578780, 'ssss2933074@gamil.com', '8181814154', '0', '', 567630, 'verified'),
(1755, 'Sarup6842', 377782, 'shahrukhkhan160873@gmail.com', '9024160873', '0', '90514', 444786, 'verified'),
(1756, 'cIMdr', 505799, '', '7427066697', '0', '', 660078, 'unverified'),
(1757, 'Hdirriifj', 872559, 'Ritikjareda84@gmail.com', '8824727339', '150', '', 745986, 'verified'),
(1758, 'JsHsa', 787230, '', '9783268892', '0', '', 431762, 'unverified'),
(1759, 'Golu patel007', 113600, '', '9608009595', '997', '', 678784, 'unverified'),
(1760, 'RBTxu', 600378, '', '9610595596', '0', '', 810540, 'unverified'),
(1761, 'WgImN', 722691, '', '9887836093', '0', '', 565165, 'unverified'),
(1762, 'oKOZl', 459499, '', '8168035045', '47', '', 118037, 'unverified'),
(1763, 'RQQdU', 601066, '', '9351934357', '0', '', 220093, 'unverified'),
(1764, 'sIfir', 966490, '', '7023136955', '0', '', 951580, 'unverified'),
(1765, 'fExcK', 798563, '', '7737502358', '0', '', 769643, 'unverified'),
(1766, 'Vaibhav', 711286, 'Vaibhavpal538@gmail.com', '9982811911', '0', '', 557704, 'verified'),
(1767, 'Gopal', 677463, 'GHANSHYAMMEENA2089@GIMAL.COM', '9571923808', '98.5', '', 159857, 'verified'),
(1768, 'Arpita', 759103, 'ghanshyammeena20889@gmail.com', '7877880256', '0', '', 103743, 'verified'),
(1769, 'HFGCd', 199645, '', '7015400190', '0', '', 491706, 'unverified'),
(1770, 'KZLdY', 400694, '', '9713480908', '0', '', 727731, 'unverified'),
(1771, 'TZfLz', 703800, 'DollyMeena5860@gmail.com', '8955169695', '0', '', 897036, 'verified'),
(1772, 'Sajid', 921952, 'sajidkhan32466@gmail.com', '7988926374', '48.5', '90514', 55145, 'verified'),
(1773, 'ttQFz', 274141, '', '9319323044', '0', '90514', 635342, 'unverified'),
(1774, 'ooaFA', 819381, '', '8740965924', '19', '', 686232, 'unverified'),
(1775, 'Kundan', 655324, '', '9509692429', '50', '', 263379, 'unverified'),
(1776, 'NAWLIYA', 251143, 'skhan341800@gmail.com', '8683845376', '22', '', 223779, 'verified'),
(1777, 'nOvYa', 51700, 'ZABIRZ', '9509346721', '0', '951379', 753570, 'verified'),
(1778, 'bRVWK', 94871, '', '6376109212', '0', '', 890504, 'unverified'),
(1779, 'QOmCf', 710623, '', '9591533084', '0', '', 119305, 'unverified'),
(1780, 'PpPTq', 658963, '', '8690638091', '0', '', 132123, 'unverified'),
(1781, '550 ludo back hota h', 929848, 'Tinkurammeena0143@gmail', '9929410042', '200', '', 837535, 'verified'),
(1782, 'WfoSb', 992911, '', '9896971834', '0', '', 575919, 'unverified'),
(1783, 'oSRJE', 118876, '', '9649643049', '0', '', 710499, 'unverified'),
(1784, 'xENRj', 910208, 'Neeraj kumar 78695à,gimail', '9336842455', '0', '', 855646, 'unverified'),
(1785, 'XgVjg', 22835, '', '8875619980', '0', '504059', 884769, 'unverified'),
(1786, 'pEZeG', 509709, '', '7302393944', '0', '', 369977, 'unverified'),
(1787, 'kancha', 146275, 'meenavishanpal99@gmail.com', '9351497706', '36.5', '', 829366, 'verified'),
(1788, 'Sarwar6842', 467081, 'SARWARKHANSUNHEDA12345@gmail.com', '9813805329', '31.5', '90514', 46215, 'verified'),
(1789, 'nijMD', 765764, '', '9602671075', '0', '', 522077, 'unverified'),
(1790, 'J🌹L', 986827, 'Aasamkhan879@gmail.com', '9772894434', '1', '', 783595, 'verified'),
(1791, 'TisWP', 945778, '', '7489122486', '0', '', 394728, 'unverified'),
(1792, 'LHISa', 883033, '', '9413588946', '0', '', 243175, 'unverified'),
(1793, 'daZUB', 566216, '', '9817411244', '0', '', 48583, 'unverified'),
(1794, 'lobiN', 937519, 'Vasimkhan2354@gamil.com', '9350245638', '0.5', '', 40816, 'verified'),
(1795, 'CDoKV', 426231, '', '7852863395', '48.5', '', 186327, 'unverified'),
(1796, 'MtMIU', 473717, '', '7568601326', '0', '', 524078, 'unverified'),
(1797, 'fxcJT', 524568, 'hemrajmeena964@gmil.com', '9694860457', '7.5', '', 356818, 'verified'),
(1798, 'uWvBB', 850477, '', '9671245665', '0', '', 467974, 'unverified'),
(1799, 'sekTB', 980677, '', '7690061638', '0', '715770', 668164, 'unverified'),
(1800, 'WqUsf', 173426, 'Chourasiyapradum726@gmail.com', '9131148053', '0', '', 785122, 'verified'),
(1801, 'Soyab khan', 73032, 'suhaikhan2678@gmail.com', '7375882678', '38', '', 348252, 'verified'),
(1802, '👑👑👑 king', 163949, '', '9991638981', '0', '', 463931, 'unverified'),
(1803, 'mhuZZ', 168841, 's75170853@gmail.com', '9813301320', '0', '', 249295, 'unverified'),
(1804, 'YXoxr', 65565, '', '7388092943', '40', '', 669957, 'unverified'),
(1805, 'aHHof', 483956, '', '9414777187', '45.5', '', 163265, 'unverified'),
(1806, 'Jiyalal meena', 435016, '', '9785114276', '0', '', 489351, 'unverified'),
(1807, 'ulahG', 197122, '', '7428730894', '0', '', 730932, 'unverified'),
(1808, 'YbvzO', 309541, '', '8955783570', '0', '', 502732, 'unverified'),
(1809, '😲', 281699, '', '7073374036', '6', '', 312063, 'unverified'),
(1810, 'CaLQD', 816451, '', '8209147751', '0.5', '504049', 741661, 'unverified'),
(1811, 'Pop', 301740, 'vm1060770@gmail.com', '7240262622', '342', '', 974330, 'verified'),
(1812, 'EDVmt', 677268, 'IK9687733@gmail.com', '9660907506', '0', '504059', 926095, 'verified'),
(1813, 'IyZrs', 128705, '', '6350019719', '0', '', 78880, 'unverified'),
(1814, 'JSZKw💓', 513551, 'nk9660456538@gmail.com', '7073887616', '49', '504059', 323017, 'verified'),
(1815, 'RZTWl', 847956, '', '8058616032', '0', '', 372250, 'unverified'),
(1816, 'GDDyL', 184863, '', '8003681759', '0', '', 184564, 'unverified'),
(1817, 'IVcTM', 814079, 'sanjayjeenwal91@gmail.com', '7733901064', '0', '', 583296, 'verified'),
(1818, 'F&A', 268710, 'faisal.ali.4985@gmail.com', '7897894985', '0.5', '', 343886, 'verified'),
(1819, 'Harisingh', 368952, '321611@gmail.com', '9610480145', '32.5', '', 583161, 'unverified'),
(1820, 'Mahadev Prasad Meena', 536212, 'meena611518@gmail.com', '8619891500', '0', '', 763614, 'verified'),
(1821, 'Khan boy', 977078, 'shermohammad97746@gmail.com', '9887597746', '1', '', 776971, 'verified'),
(1822, 'CuZKD', 745783, '', '8290952646', '0', '', 7165, 'unverified'),
(1823, 'jcHlr', 135929, '', '9040272544', '0', '', 600682, 'unverified'),
(1824, 'vJfPH', 34742, '', '9040272544', '0', '', 803979, 'unverified'),
(1825, 'TYbvT', 263294, '', '9040272544', '0', '', 209996, 'unverified'),
(1826, 'SzJee,😭😭😭', 548190, 'mamud3509@gmail.com', '9928821480', '48.5', '504049', 22053, 'unverified'),
(1827, 'Deepak0057', 730187, 'dm570102@gmail.com', '7374947657', '100', '', 120030, 'verified'),
(1828, 'Kha gye', 32938, 'subhashprajapati42244@gmail.com', '9782372272', '12976.5', '', 796622, 'verified'),
(1829, 'nkHlX', 182998, '', '8290069600', '12.5', '', 96851, 'unverified'),
(1830, 'vrRmV', 491463, '', '6375759706', '0', '', 133843, 'unverified'),
(1831, 'fTnxS', 906252, '', '6377390104', '0', '638882', 105663, 'unverified'),
(1832, 'Jk', 543245, 'pratapgarh992@gmail.com', '9950361833', '0', '', 66490, 'verified'),
(1833, 'oWYiv', 474817, '', '9713851097', '0', '', 341965, 'unverified');
INSERT INTO `tablename` (`id`, `Name`, `otp`, `Email`, `Phone`, `Wallet_balance`, `referral`, `referral_code`, `verified`) VALUES
(1834, 'QhbKk', 5883, 'ramdayalmeena406@gmail.com', '9887920157', '0.5', '691732', 811453, 'verified'),
(1835, 'HQRLA', 569042, 'aspak8842@gmail.com', '8000498916', '0', '', 347373, 'verified'),
(1836, 'Vcnkl', 793094, '', '9891915965', '0', '', 611309, 'unverified'),
(1837, 'Gulam', 470196, 'tareefkhan9057@gmail.com', '9057688210', '0', '', 633961, 'verified'),
(1838, 'TSibc', 262918, '', '9783414448', '0', '', 518129, 'unverified'),
(1839, 'slnnn', 460186, 'UpI  ID, 9306292720@ibl', '9306292720', '30.5', '', 390776, 'verified'),
(1840, 'fzhpU', 376112, 'sk1982061@gmail.com', '7027148286', '47', '', 569765, 'verified'),
(1841, 'pLnnf', 910711, '', '9521185397', '0', '', 199816, 'unverified'),
(1842, 'XOZIO', 179466, '', '9784139950', '0', '', 297221, 'unverified'),
(1843, 'Aamir6842', 796188, 'aamirkhan7850@gmail.com', '8607036273', '0', '90514', 848666, 'verified'),
(1844, 'AZMYg', 136101, '', '8890372219', '0', '309721', 127622, 'unverified'),
(1845, 'lpiRI', 208791, 'soyelkhan031@gmail.com', '9024364154', '25', '504059', 110920, 'verified'),
(1846, 'pumrG', 225541, '', '8952987985', '0', '', 866538, 'unverified'),
(1847, 'EFVBB', 846864, 'lekhrajmaher1441@gmail.com', '9694768982', '52', '', 111311, 'verified'),
(1848, 'kqEqw', 878798, '', '6377291916', '0', '', 897785, 'unverified'),
(1849, 'IgIAf', 241502, 'Sourabhjangir247@gmail.com', '9119201048', '0', '', 434524, 'verified'),
(1850, 'Rakesh', 945286, '', '7878890265', '0', '309721', 728118, 'unverified'),
(1851, 'VIeiR', 504494, '', '9610734514', '31.5', '', 374149, 'unverified'),
(1852, 'hLVKT', 247388, '', '9813865683', '35', '', 99933, 'unverified'),
(1853, 'foVnf', 85664, '', '9461411720', '0', '', 203129, 'unverified'),
(1854, 'miPUQ', 466264, 'lavkushmeena408@gmail.com', '9461411728', '0.5', '', 683077, 'verified'),
(1855, 'sdIqB', 616541, '', '7691002723', '47', '', 434139, 'unverified'),
(1856, 'Papaji', 730190, '', '8397836605', '0', '744996', 574976, 'unverified'),
(1857, 'Papajiboll557', 531972, '', '9813432557', '0', '744996', 254742, 'unverified'),
(1858, 'kVMjE💋', 839678, '9785981586naved@gmail.com', '9785981586', '30', '', 702237, 'verified'),
(1859, 'Papa se jeetoge ludo', 954133, 'akashchauhan0722@gmail.com', '8765810803', '0.5', '', 195545, 'verified'),
(1860, 'Fcmuf', 522513, 'shahidkhan03748@gmail.com', '9991753444', '0', '', 27427, 'verified'),
(1861, 'ECtSm', 432260, '', '9813346869', '0', '', 746549, 'unverified'),
(1862, 'TEyFV', 806459, '', '7976556992', '0', '', 376120, 'unverified'),
(1863, 'miMQk', 752839, '', '9588211127', '0', '', 45014, 'unverified'),
(1864, 'PhyXe', 307107, '', '8104444856', '0', '', 923046, 'unverified'),
(1865, 'Raja4', 205211, 'hosiyarsinghmeena1965@gmail.com', '8955214986', '3', '497402', 226647, 'verified'),
(1866, 'FadiG', 951125, '', '9693223273', '0', '', 374513, 'unverified'),
(1867, 'nCGFP', 571299, 'khansaddam55443@gmail.com', '8875476688', '0', '', 81263, 'verified'),
(1868, 'qiKgg', 369178, '', '7015912447', '0', '', 738276, 'unverified'),
(1869, 'Table pakad', 622791, 'Khanbhai660584@gmail.com', '8950577044', '15.5', '', 463703, 'unverified'),
(1870, 'ypkAK', 579675, 'Munfed khan @gmail.com', '9024381693', '6.5', '', 676293, 'verified'),
(1871, 'BckNJ', 116698, '', '6378092837', '0', '504059', 695069, 'unverified'),
(1872, 'Jeet', 601062, 'Vs8740970073@gmail.com', '8619833083', '38', '497402', 72920, 'verified'),
(1873, 'DpHsj', 66622, '', '6378495380', '0', '', 565662, 'unverified'),
(1874, 'LadTI', 537, '', '6378495380', '0', '', 997979, 'unverified'),
(1875, 'OMPIb', 144955, '', '6378495380', '0', '', 399400, 'unverified'),
(1876, 'GuwRw', 122863, '', '6378495380', '0', '', 982054, 'unverified'),
(1877, 'vnPSH', 899352, '', '6375335148', '0', '309721', 27964, 'unverified'),
(1878, 'CsDct', 351027, 'lokeshmeena46120@gmail.com', '7878953272', '0', '', 67844, 'verified'),
(1879, 'Nejek', 30330, 'somusharma28551@gmail.com', '7249249707', '34.5', '', 718546, 'verified'),
(1880, '200+++only ok', 106455, 'sarpukhan9772@gmail.com', '7737566946', '47.5', '', 687980, 'verified'),
(1881, 'owBvW', 900377, '', '8690918627', '0', '715770', 322450, 'unverified'),
(1882, 'EEPMp', 41681, '', '7340094048', '25', '715770', 903427, 'unverified'),
(1883, 'cAbdf', 10661, 'soyail7781@gmail.com', '7726813419', '0', '504059', 691585, 'verified'),
(1884, 'NDiNL', 741147, 'wahidkhan1359792@gmail.com', '9116470969', '36.5', '504059', 729912, 'unverified'),
(1885, 'BABA Tillu😅', 264373, '', '8005996180', '6.5', '', 9580, 'unverified'),
(1886, 'QJofD', 74543, 'kps281202@gmail.com', '9772502528', '0', '', 907866, 'verified'),
(1887, 'muLUR', 42838, '', '9315781623', '0', '', 848368, 'unverified'),
(1888, 'Only classic no fres', 421110, 'dilshadkhan1666@gmail.com', '9817438529', '31.5', '', 867396, 'verified'),
(1889, 'iJazU', 272410, 'meenamusic777@gmail.com', '8503896855', '47', '', 937544, 'verified'),
(1890, 'jgUks', 616456, '', '9216304257', '0', '', 98917, 'unverified'),
(1891, 'LMwKF', 882781, 'Asharamgadhora2800@gamil.com', '7976332800', '0', '691732', 902906, 'verified'),
(1892, 'Muna', 507499, 'ashishs062001@gmail.com', '8003539003', '45.5', '', 264044, 'verified'),
(1893, 'GOLU MEENA', 345181, '', '9887674946', '0', '', 599927, 'unverified'),
(1894, 'tAgGS', 543263, '', '8076502739', '0', '', 791105, 'unverified'),
(1895, 'bWLNS', 447074, '', '9680299565', '0', '', 283566, 'unverified'),
(1896, 'JuhLM', 950138, '', '8209101682', '0', '', 156485, 'unverified'),
(1897, 'rEklQ', 909972, '', '9414800557', '0', '', 890530, 'unverified'),
(1898, 'XbYnq', 299180, '', '8395950242', '0', '', 857060, 'unverified'),
(1899, 'SNFkO', 503152, '', '9799274647', '0', '', 856508, 'unverified'),
(1900, 'lwHYn', 23928, '', '9929410024', '0', '', 719620, 'unverified'),
(1901, 'uteFY', 551154, '', '8209963140', '0', '', 917817, 'unverified'),
(1902, 'Mewati DULOT', 442105, 'mewatibilal105@gmail.com', '7297090177', '0', '', 176928, 'verified'),
(1903, 'iRvQb', 801543, 'dilkeshmeena5505@gmail.com', '9694658514', '8', '467076', 710588, 'verified'),
(1904, 'wNxUT', 480039, '', '9588812079', '0', '', 505782, 'unverified'),
(1905, 'XAhyz', 208687, '', '9521649177', '0', '', 948584, 'unverified'),
(1906, 'eVbhQ', 614274, '', '9887568479', '0', '', 693305, 'unverified'),
(1907, 'xCTVg', 723973, '', '7568497775', '0', '', 259785, 'unverified'),
(1908, 'I.love.you', 53308, 'ashokkumarmeena6122@gmail.com', '9352861125', '36', '755533', 968178, 'verified'),
(1909, 'Aalim khan 5077', 657340, 'Nyamatkhan5077', '8824390446', '0', '', 652122, 'verified'),
(1910, 'XteZy', 414880, 'sunilmeenathangazi@gmail.com', '7851052192', '0', '', 205207, 'verified'),
(1911, 'zRTxr', 215693, 'Kundanlalmeena1234@gmail.com', '8003641158', '20', '', 763183, 'verified'),
(1912, 'TXGOe', 164963, '', '8107946501', '200', '', 245195, 'unverified'),
(1913, 'Chiku ❤️FK❤️', 583386, '', '9116761046', '0', '504049', 64436, 'verified'),
(1914, 'sPjTF', 532577, '', '9680845599', '71.5', '', 853675, 'unverified'),
(1915, 'YUdEw', 474744, 'Manishmeenam2004@gmail.com', '8000817432', '0', '', 358265, 'verified'),
(1916, 'XQKTj', 513472, '', '9116761040', '0', '504049', 356952, 'verified'),
(1917, 'QWSxq', 944531, 'manishmeenam2004@gmail.com', '9351188735', '0', '', 337844, 'verified'),
(1918, 'MzGtv', 334626, '', '8607014143', '42.5', '', 844738, 'unverified'),
(1919, '*Sam04*', 655390, 'SAMARTHT55@gmail.com', '8889424992', '0', '', 665513, 'verified'),
(1920, 'IDeTK', 784579, 'anilsarmaha@gmail.com', '7099965686', '30', '', 474153, 'verified'),
(1921, 'eUqxm', 529649, 'ARSHAD4567V@gmail.com', '9813235097', '41', '', 863779, 'unverified'),
(1922, '🥰🥰🥰', 850836, 'jk8091251@gmail.com', '8053993805', '10', '', 282074, 'verified'),
(1923, 'tXlNq', 393023, '', '9057702212', '0', '974144', 748699, 'unverified'),
(1924, 'WaEnB', 940012, 'asminaaasif@gmail.com', '9306954859', '0', '511250', 495726, 'verified'),
(1925, 'kVtBM', 689665, '', '9001166520', '0', '', 9601, 'unverified'),
(1926, 'DaEHq', 507447, 'sunitameena2250@gmail.com', '9653884021', '0', '', 227545, 'verified'),
(1927, 'OEHLY', 514396, 'atins596@gmail.com', '9235979700', '15.5', '', 782003, 'verified'),
(1928, 'ADQLP', 315795, 'vishalmewal786@gmail.com', '9256971541', '0', '', 122757, 'verified'),
(1929, 'fAwCC', 482322, '', '7084033330', '0', '', 391010, 'unverified'),
(1930, 'mmldd', 579173, '', '8085693621', '0', '998005', 413140, 'unverified'),
(1931, 'UnjWV', 521110, '', '9856336982', '0', '998005', 28588, 'unverified'),
(1932, 'kBLWM', 5328, '', '7508962536', '0', '998005', 627709, 'unverified'),
(1933, 'XOOxz', 159333, '', '6260226860', '0', '998005', 206680, 'unverified'),
(1934, 'GuUeR', 952939, '', '7415256868', '0', '998005', 126747, 'unverified'),
(1935, 'LNfpf', 908163, '', '8982126895', '0', '998005', 100790, 'unverified'),
(1936, 'ivzvM', 397894, '', '7000371802', '0', '998005', 913092, 'unverified'),
(1937, 'hTDxV', 652144, '', '9171961257', '0', '998005', 10638, 'unverified'),
(1938, 'hGqdm', 172612, '', '9179646116', '0', '998005', 633978, 'unverified'),
(1939, 'SdcZx', 251634, '', '9977017524', '0', '998005', 423373, 'unverified'),
(1940, 'uFlGV', 365658, '', '8269602409', '0', '998005', 381106, 'unverified'),
(1941, 'TsWcR', 347708, '', '9303447047', '0', '998005', 804558, 'unverified'),
(1942, 'pbbTX', 154110, '', '7587188169', '0', '998005', 50070, 'unverified'),
(1943, 'tFUlR', 782423, '', '6266408566', '0', '998005', 19339, 'unverified'),
(1944, 'nWvrA', 832589, '', '8889600686', '0', '998005', 29802, 'unverified'),
(1945, 'lpvDI', 484358, '', '6265605415', '0', '998005', 983351, 'unverified'),
(1946, 'mDeLS', 395662, '', '7987442005', '0', '998005', 707149, 'unverified'),
(1947, 'lZnny', 412128, '', '7828078090', '0', '998005', 375688, 'unverified'),
(1948, 'KSQfW', 880464, '', '8871006560', '0', '998005', 162550, 'unverified'),
(1949, 'nFSoM', 709797, '', '7581087322', '0', '998005', 773631, 'unverified'),
(1950, 'XJxwI', 62285, '', '9174906460', '0', '998005', 686071, 'unverified'),
(1951, 'DwMki', 52868, '', '8529450803', '0', '', 759621, 'unverified'),
(1952, 'SzboJ', 28730, 'ashokmeenaraj12@gmail.com', '7878912428', '0', '759621', 769085, 'verified'),
(1953, 'dDMWa', 583371, '', '9461249323', '0', '', 999679, 'unverified'),
(1954, 'OUPsN', 927535, '', '7470321176', '0', '', 590936, 'unverified'),
(1955, 'njbKs', 280342, 'r48295610@gmail.com', '9928019098', '3', '309721', 515802, 'verified'),
(1956, 'oWeAC', 884725, 'rahulmeenam345@gmail.com', '9352198093', '0.5', '', 713046, 'verified'),
(1957, 'Wcqzg', 963922, 'Sahjad khan 7823@.com', '8302197518', '47', '', 142477, 'verified'),
(1958, 'Teri', 714922, 'hariompawar@gmail.com', '7976807652', '0', '', 194263, 'verified'),
(1959, 'OlgSu', 325946, 'mramlakhan984@gmail.com', '8875568544', '39.5', '', 998996, 'verified'),
(1960, 'uLNvs', 9840, '', '7846834587', '0', '', 727436, 'unverified'),
(1961, 'SABIR', 157266, 'Khansabir62816@gmail.com', '7015381370', '5', '', 135372, 'verified'),
(1962, 'Xyjwf', 908678, '', '8690426259', '0', '', 906206, 'unverified'),
(1963, 'edRRZ', 49478, '', '8307860949', '0', '', 637378, 'unverified'),
(1964, 'Surendar kumar', 495208, 'surendarkumar1387@gmail.com', '9256720827', '400', '', 746346, 'verified'),
(1965, 'aDjdM', 419834, '', '7610003501', '0', '276736', 798132, 'unverified'),
(1966, 'epxlb', 114317, 'jeetramjaat87@gmail.com', '8279276529', '0', '', 558464, 'verified'),
(1967, 'Nothemeallow', 216530, 'ajaykumarmeena0258@gmail', '8306129265', '0', '', 839626, 'verified'),
(1968, 'IiopK', 44370, 'rahulmeenam345@gmail.com', '7339924287', '4', '', 784507, 'verified'),
(1969, 'ykCdY', 796670, '', '7850937307', '0', '834628', 534434, 'unverified'),
(1970, 'DHFAk', 727628, '', '9785513947', '0', '', 195071, 'unverified'),
(1971, 'CrmeW', 804535, '', '8930083078', '0', '', 441845, 'unverified'),
(1972, 'Gvzgh', 672538, '', '7240753130', '0', '', 901535, 'unverified'),
(1973, 'LWklo', 284062, '', '9610097725', '20', '', 475087, 'unverified'),
(1974, 'RRxwt', 428874, '', '9967024720', '0', '', 142198, 'unverified'),
(1975, 'NZkPL', 328320, 'sakirmilakpuri@gmail.com', '9887119570', '0', '', 336207, 'verified'),
(1976, 'Yusuf Khan', 427173, '', '9509231559', '0', '', 463997, 'unverified'),
(1977, 'EyZLl', 5141, 'Gkfkvmoc', '7742238440', '0', '', 973326, 'unverified'),
(1978, 'wUCRr', 995687, '', '7489554307', '0', '998005', 118140, 'unverified'),
(1979, 'glyvl', 937358, '', '7470606691', '0', '998005', 97218, 'unverified'),
(1980, 'yLRUh', 410449, 'yograjprajapat6@gmail.com', '8955236171', '0', '', 512649, 'verified'),
(1981, 'vyzSY', 634654, '', '7987442002', '0', '998005', 195045, 'unverified'),
(1982, 'RsibP', 504551, '', '6260549755', '0', '998005', 485841, 'unverified'),
(1983, 'nOkXW', 870165, '', '7415206931', '0', '998005', 313170, 'unverified'),
(1984, 'OXsOA', 163816, '', '6266394573', '0', '998005', 233199, 'unverified'),
(1985, 'iFXmy', 112984, '', '6260414780', '0', '998005', 631606, 'unverified'),
(1986, 'eKBva', 540785, '', '8962784420', '0', '998005', 850142, 'unverified'),
(1987, 'GtSMA', 578670, '', '8871531300', '0', '998005', 136789, 'unverified'),
(1988, 'Jgqni', 784795, '', '9171638641', '0', '998005', 458773, 'unverified'),
(1989, 'wqHAz', 479524, '', '7970131403', '0', '998005', 345020, 'unverified'),
(1990, 'pTsKQ', 129293, '', '7828728823', '0', '998005', 779778, 'unverified'),
(1991, 'AgtXd', 61073, '', '6232782217', '0', '998005', 17229, 'unverified'),
(1992, 'biYsT', 905622, '', '9981284411', '0', '998005', 749971, 'unverified'),
(1993, 'PItai', 317821, '', '7828144410', '0', '998005', 930302, 'unverified'),
(1994, 'Lusxb', 356273, '', '8269959107', '0', '998005', 628554, 'unverified'),
(1995, 'AnrAT', 86587, '', '9399233080', '0', '998005', 565653, 'unverified'),
(1996, 'NkRPS', 208266, '', '7415005087', '0', '998005', 877071, 'unverified'),
(1997, 'dIkPj', 228908, '', '9770150539', '0', '998005', 30775, 'unverified'),
(1998, 'HGvKc', 11460, '', '7231805302', '0', '998005', 528031, 'unverified'),
(1999, 'MBAgK', 510713, '', '9244928134', '0', '998005', 802242, 'unverified'),
(2000, 'aEXLL', 803274, '', '9244524821', '0', '998005', 547992, 'unverified'),
(2001, 'qYYvY', 416036, '', '9826741219', '0', '998005', 738059, 'unverified'),
(2002, 'nUkFZ', 835955, '', '8959367450', '0', '998005', 691165, 'unverified'),
(2003, 'kpzSS', 3324, '', '7999176960', '0', '998005', 706083, 'unverified'),
(2004, 'SKYuk', 798672, '', '9399578879', '0', '998005', 394146, 'unverified'),
(2005, 'QnHEx', 128533, '', '9302261108', '0', '998005', 456395, 'unverified'),
(2006, 'AkspI', 626011, '', '9977718576', '0', '998005', 755341, 'unverified'),
(2007, 'qPoCy', 41833, '', '7770851071', '0', '998005', 568848, 'unverified'),
(2008, 'aDWZC', 392950, '', '7771883218', '0', '998005', 75277, 'unverified'),
(2009, 'HroYu', 228275, '', '7000599573', '0', '998005', 140101, 'unverified'),
(2010, 'Aalim6842', 204522, 'khanaalim33791@gmail.com', '9588509672', '30.5', '90514', 752204, 'verified'),
(2011, 'Yo baby', 570443, 'SAMEERSHRIVASTAVA0108@GMAIL.Com', '8626063942', '63', '', 545941, 'verified'),
(2012, 'fPViZ', 307709, '', '8387003373', '0', '', 317219, 'unverified'),
(2013, 'zshIj', 255461, 'tk5454882@gmail.com', '6375967184', '0.5', '234142', 312348, 'verified'),
(2014, 'vOiBZ', 27104, 'ramkeshmeena785raj@gmail.com', '9660772597', '0.5', '', 476315, 'verified'),
(2015, 'bzpfZ', 202067, '', '9992273775', '0', '744996', 994414, 'unverified'),
(2016, 'bRrcd', 42050, '', '9992273774', '0', '744996', 909461, 'unverified'),
(2017, 'Hfvhgg7384', 7104, '', '9992273784', '0', '744996', 372127, 'unverified'),
(2018, 'opSbV', 127079, '', '9928689068', '0', '317061', 381942, 'unverified'),
(2019, 'gvJje', 682657, '', '8003661373', '0', '', 936059, 'unverified'),
(2020, 'King khan', 446860, 'Sohilmansuri7568@gmail.com', '7568109024', '0', '', 188391, 'verified'),
(2021, 'nRfbt', 849681, '', '7357181072', '0', '', 274489, 'unverified'),
(2022, 'yCdCe', 334148, 'Antimkanwar140@gmail.com', '6376074572', '31', '', 603956, 'verified'),
(2023, 'SzWMD', 781398, 'gurjarkuldeep895@gmail.com', '7611938995', '37', '', 699646, 'verified'),
(2024, 'Khatu shyam', 625757, 'Irfankhan852940@gmail.com', '8529331072', '19.5', '188391', 92685, 'verified'),
(2025, 'AnKOa', 667262, '', '8306614660', '0', '', 839785, 'unverified'),
(2026, 'ipWGc', 465270, '', '7357274075', '0', '', 864736, 'unverified'),
(2027, 'pVKIB', 363431, '', '7801717000', '0', '998005', 968380, 'unverified'),
(2028, 'HqViN', 979109, '', '7801817000', '0', '998005', 208766, 'unverified'),
(2029, 'ZaYju', 165486, '', '9257856823', '0', '', 892023, 'unverified'),
(2030, 'Cjuzj', 828707, '', '7877440499', '0', '', 544573, 'unverified'),
(2031, 'jTSbI', 987917, '', '7808176045', '0', '', 882535, 'unverified'),
(2032, 'xbFQU', 345889, '', '8107586135', '0', '694787', 913157, 'unverified'),
(2033, 'Tarifgbb2474', 180335, '', '8930702474', '0', '744996', 196360, 'unverified'),
(2034, 'tZlUG8004', 883138, '', '9541808004', '0', '744996', 616490, 'unverified'),
(2035, 'Clgfu', 373396, 'alijankhan34532@gmail.com', '9783427509', '992', '', 836926, 'verified'),
(2036, 'Bindas.no1😘💸', 668790, 'wk4028755@gmail.com', '7497803385', '4.5', '', 468718, 'verified'),
(2037, 'AbMEd', 506499, '', '7240068775', '0', '', 542151, 'unverified'),
(2038, 'RczYr', 302204, 'ghanshyamkoli123456789@gmail.com', '9166398547', '1128', '', 22474, 'verified'),
(2039, 'wPKFl', 937407, '', '7665443480', '0', '', 803760, 'unverified'),
(2040, 'lBRnp', 13149, '', '8769894671', '0', '', 643483, 'unverified'),
(2041, 'xBlZa', 563650, '', '8302323046', '0', '', 864209, 'unverified'),
(2042, '5566gv', 796044, 'Salmaibrahimsiddiqui1971@gmail.com', '9580098534', '17878.5', '514868', 298616, 'verified'),
(2043, 'xyhkP', 997098, 'lokeshgorda1@gmail.com', '7014332799', '20', '', 806249, 'unverified'),
(2044, 'uQkxL', 156894, '', '9664497730', '0', '', 146449, 'unverified'),
(2045, 'DYMRM', 4531, '', '8740970073', '0', '', 78979, 'unverified'),
(2046, 'Qcnmk', 642314, '', '9079731292', '0', '', 751797, 'unverified'),
(2047, 'zllKV', 213426, '', '8307437955', '0', '744996', 42065, 'unverified'),
(2048, 'eQGTJ', 46384, '', '9671910479', '0', '744996', 222232, 'unverified'),
(2049, 'Mowgli😍', 757938, 'sonumeenadulet@gmail.com', '8690563795', '0', '837535', 734317, 'verified'),
(2050, 'Classic game', 967102, 'shahidshah45039@gmail.com', '9399496075', '106', '330665', 282202, 'verified'),
(2051, 'Hiiii', 925241, 'Ramdyalmaharajpura6377@gmail.com', '6377778551', '303.5', '90514', 39437, 'verified'),
(2052, 'majnu bhai', 542346, 'mukeshprajapat4330@gmail.com', '7339828477', '19', '', 338073, 'verified'),
(2053, 'MSGJc', 945394, '', '8824514203', '0', '', 122925, 'unverified'),
(2054, 'Pavan meena', 251075, 'PAVANMEENA@1842GMAIL.COM', '9785506593', '0', '', 958529, 'verified'),
(2055, 'nKSXT', 20859, '', '9784593638', '0', '', 384475, 'unverified'),
(2056, 'tWxGs', 166794, '', '9885506593', '0', '', 663695, 'unverified'),
(2057, 'Zgquf', 153690, '', '7877887066', '0', '', 798241, 'unverified'),
(2058, 'RXmOd', 265789, '', '7426890310', '0', '', 104086, 'unverified'),
(2059, 'Nishar 6842', 836921, 'Khannishar667@gmail.com', '9996135637', '29', '90514', 910586, 'unverified'),
(2060, 'tyxrW', 963305, '', '8168803528', '0', '', 764833, 'unverified'),
(2061, 'jjeAh', 203527, '', '7976066889', '0', '', 355702, 'unverified'),
(2062, 'xJRSM', 548447, '', '9024135510', '0', '', 570693, 'unverified'),
(2063, 'Mustufa6842', 111274, '', '7027070386', '0', '90514', 639593, 'unverified'),
(2064, 'xTURh', 707647, '', '6378953298', '0', '', 715577, 'unverified'),
(2065, 'AvLsu', 692051, '', '7690961018', '0', '', 629777, 'unverified'),
(2066, 'wSOFd', 443697, '', '9024320019', '0', '89467', 576543, 'unverified'),
(2067, 'JljjR', 514084, '', '7046668156', '0', '414650', 909620, 'unverified'),
(2068, 'HWGlK', 170977, 'jk7093169@gmail.com', '9813877891', '0.5', '', 567622, 'verified'),
(2069, 'lsfxo', 813914, '', '8094778309', '0', '', 575584, 'unverified'),
(2070, '☀️ sumit raja', 341929, 'panmeenaa@gmail.com', '9782638767', '2616', '', 577067, 'verified'),
(2071, 'Shyam sarkar', 590076, 'Vishal22pattya@gmail.com', '8000882618', '44', '276894', 683623, 'verified'),
(2072, 'yefaC', 173949, '', '9660717573', '0', '', 729235, 'unverified'),
(2073, 'EioQz', 213979, '', '7495001136', '3', '', 544030, 'unverified'),
(2074, 'TELis', 112346, 'ajaymahawar8557@gmail.com', '8529576457', '0.5', '', 544312, 'verified'),
(2075, 'Jai shree krishna..', 734467, 'nssattawan@gmail.com', '8233469868', '591.5', '', 68433, 'verified'),
(2076, 'HqmHM', 814141, '', '8053199486', '0', '', 554762, 'unverified'),
(2077, 'MQLuf', 968148, '', '8053507818', '0', '', 325872, 'unverified'),
(2078, 'sanju', 593091, 'vinodmeena322212@gmail.com', '9414959693', '4060', '', 28121, 'verified'),
(2079, 'msSGa', 786462, '', '9216828410', '0', '', 337719, 'unverified'),
(2080, 'xAbdd', 625780, '', '8053591619', '0', '', 286859, 'unverified'),
(2081, 'EGnUR', 81679, '', '6378267026', '0', '', 451436, 'unverified'),
(2082, 'szYgc', 941929, '', '9950049188', '0', '', 632821, 'unverified'),
(2083, 'Wjqiwb', 740069, '', '9311781708', '2.5', '228321', 647471, 'unverified'),
(2084, 'nlJxC', 643367, 'aashimsjaan@gmail.com', '7878963814', '45', '', 853905, 'verified'),
(2085, 'hbFMC', 287224, '', '8769326379', '0', '', 313150, 'unverified'),
(2086, 'EsbxQ', 278379, '', '9929579958', '0', '', 215104, 'unverified'),
(2087, 'Rashid khan', 727550, 'rkhan34961@gmail.com', '8290598497', '35', '', 31873, 'pending'),
(2088, 'rHAaN', 201636, 'mk5194486@gmail.com', '8708337523', '38', '', 662654, 'verified'),
(2089, 'oXwNO', 264514, 'Tofik mo. Mot251399@gimail com', '8209147750', '6.5', '504059', 902249, 'unverified'),
(2090, 'Nasir khan', 508913, 'nasirkhanbichhor789@gamil.com', '7015189960', '0.5', '90514', 468682, 'verified'),
(2091, 'Jhh', 2414, 'aakib98126@gmail.com', '9812663348', '377.5', '90514', 706681, 'verified'),
(2092, 'aZUor', 441364, 'meenachandu019@gmail.com', '8503939176', '48.5', '', 482711, 'verified'),
(2093, 'gdnlV', 140682, 'https://ludopaisa.com/login/497402', '7877126675', '0', '', 53326, 'verified'),
(2094, 'uqkDs', 879824, '', '7737646871', '0', '', 854347, 'unverified'),
(2095, 'Pavan', 648554, '', '6375518919', '49', '333533', 240644, 'unverified'),
(2096, 'LfLKj', 646509, '', '6280552993', '0', '', 829149, 'unverified'),
(2097, 'mHhRo', 352891, '', '9257696354', '0', '', 16696, 'unverified'),
(2098, 'AJAIp', 106906, '', '6377783537', '0', '', 733477, 'unverified'),
(2099, 'SYFEc', 188787, '', '8302765962', '0', '', 443464, 'unverified'),
(2100, 'ThbWB', 730505, '', '7976683035', '0', '', 665208, 'unverified'),
(2101, 'BAZIGAR', 519739, 'Intzargamingbusiness@gmail.com', '6378603641', '0', '', 617236, 'unverified'),
(2102, 'BrzqJ', 383908, 'Khanaalim913246@gmail.com', '8570913246', '0.5', '', 701573, 'verified'),
(2103, 'tVyMe', 350199, '', '8824340169', '0', '', 545964, 'unverified'),
(2104, 'JHJgi', 355321, '', '9983673890', '0', '', 55908, 'unverified'),
(2105, 'qTczg', 789669, '', '6350302071', '0', '', 345516, 'unverified'),
(2106, 'Billa srpanch6842', 123077, '', '9813836231', '20.5', '90514', 582869, 'unverified'),
(2107, 'JBWYc', 561983, '', '9813638231', '0', '', 402984, 'unverified'),
(2108, 'Sab ka dushman', 346827, '', '7275765750', '42', '', 70506, 'unverified'),
(2109, 'koThv', 36963, '', '8306532778', '0', '', 587632, 'unverified'),
(2110, 'ZlpSe', 359111, '', '3264889319', '0', '', 165669, 'unverified'),
(2111, 'cncTM', 432863, '', '3107900699', '0', '', 125865, 'unverified'),
(2112, 'DjVri', 566730, '', '7355526976', '0', '', 594931, 'unverified'),
(2113, 'OnmeX', 227515, 'WajidAkram178@gmail.com', '9350187976', '0', '', 284161, 'verified'),
(2114, 'WEcII', 940456, '', '9672031157', '0', '', 696009, 'unverified'),
(2115, 'dlSko', 391595, 'rkatheriya44@gmail.com', '8511795507', '0', '', 139557, 'verified'),
(2116, 'CpeEX', 28906, '', '9785463680', '0', '', 489592, 'unverified'),
(2117, 'PwFbm', 665394, '', '9772669554', '0', '', 395835, 'unverified'),
(2118, 'zHnZG', 651532, 'Sajidmundana@gmail.com', '9887157128', '4', '', 67991, 'verified'),
(2119, '💚❤️👆💔👌👈💗4629', 477505, 'Salleshil3@gmail.com', '8875117772', '5.5', '', 493067, 'verified'),
(2120, 'WwdCH', 732447, 'hariompawar072@gmail.com', '7240715169', '0', '', 102364, 'verified'),
(2121, 'paLnY', 631906, 'khanahsan02022@gmail.com', '8058805540', '0', '', 78396, 'verified'),
(2122, 'hUjaj', 989106, '', '9955520518', '0', '', 520737, 'unverified'),
(2123, 'Oo', 307996, 'najimkhankhan1341@gmail.com', '9828975938', '13', '493067', 315761, 'verified'),
(2124, 'poRup', 373971, '', '7093543717', '0', '', 124075, 'unverified'),
(2125, 'JuIrs', 862345, '', '7093543717', '0', '', 586802, 'unverified'),
(2126, 'HR 93 mewat', 274469, '', '9818253518', '0', '', 248114, 'unverified'),
(2127, 'bhhrf', 105175, '', '9601272169', '0', '', 11771, 'unverified'),
(2128, 'SSIFk', 400769, '', '7426903090', '0', '', 745488, 'unverified'),
(2129, 'PCxlu', 978988, '', '7976834660', '0', '', 2012, 'unverified'),
(2130, 'Haseen Roda', 495637, 'kirshad123456@gmail.com', '9351593738', '36.5', '', 484830, 'verified'),
(2131, 'OXSLe', 173159, '', '9671568484', '0', '', 965543, 'unverified'),
(2132, 'fgWxj', 860981, '', '9413888854', '0', '', 180120, 'unverified'),
(2133, 'AwGde', 331737, '', '7300139942', '0', '', 809424, 'unverified'),
(2134, 'YzrYf', 376060, '', '8808123533', '0', '', 237317, 'unverified'),
(2135, 'QweuM', 578923, '', '6350029320', '0', '', 420574, 'unverified'),
(2136, 'upKgC', 488254, '', '8930723305', '0', '965543', 542579, 'unverified'),
(2137, 'Azruddin5287', 807996, '', '9728975287', '0', '744996', 101730, 'unverified'),
(2138, 'Aasim Rangaraj', 940148, 'aasimrana534@gmail.com', '9257941962', '87.5', '', 299994, 'verified'),
(2139, 'Avi.lucifet', 987642, 'avikumar3105@gmail.com', '7856968613', '47', '', 383824, 'verified'),
(2140, 'raRYC', 865900, '', '6376213161', '0', '80706', 669209, 'unverified'),
(2141, 'Znyno', 858949, '', '8279102258', '0', '80706', 661198, 'unverified'),
(2142, 'SKsKq', 526514, '', '8209839094', '0', '', 48589, 'unverified'),
(2143, 'cVCOB', 991774, '', '7976505620', '0', '', 135521, 'unverified'),
(2144, 'mrUud', 557716, '', '9521541892', '0', '', 30196, 'unverified'),
(2145, 'qvpVV', 741210, '', '9887128412', '0', '268247', 817608, 'unverified'),
(2146, 'Onli 300+++game walehiaay', 26105, 'SKM562002@gmail.com', '9024317282', '1', '268247', 825911, 'verified'),
(2147, 'UFCwk', 775724, '', '6367353662', '0', '', 248821, 'unverified'),
(2148, 'hpdPX', 729472, '', '9028631228', '0', '998005', 250864, 'unverified'),
(2149, 'TRmhd', 556406, 'tahirkhan9845t@gmail.com', '9982829845', '2.5', '', 197560, 'verified'),
(2150, 'Àß', 339809, 'ay1395348@gmail.com', '9140184393', '44', '', 329204, 'verified'),
(2151, 'CFCAS', 642766, 'Jiendrameena5467@gmil.com', '9783954470', '0', '', 830027, 'unverified'),
(2152, 'DqbKj', 514419, '', '6377252792', '0', '', 508061, 'unverified'),
(2153, 'sdxfs', 455055, 'waseemjafar801@gmail.com', '9896349972', '1', '', 140454, 'verified'),
(2154, 'fuwvz', 674257, '', '9671475658', '0', '', 529585, 'unverified'),
(2155, 'EHyoX', 363448, 'mkaransingh521@gmail.com', '7239940034', '100', '', 669447, 'unverified'),
(2156, 'BQBrz', 653279, '', '9813968511', '0', '', 453889, 'unverified'),
(2157, 'Nitesh Rao', 50959, '', '7494885811', '0', '', 301663, 'unverified'),
(2158, 'EJoWI', 498959, '', '9991738690', '0', '', 71595, 'unverified'),
(2159, 'CPdyJ', 146134, '', '9050815135', '0', '', 408447, 'unverified'),
(2160, 'TFjtB', 921949, '', '6350319040', '0', '', 651375, 'unverified'),
(2161, 'Deieb', 303629, 'Samratsingh940223@gmail.com', '9414908792', '1014.5', '', 355256, 'verified'),
(2162, 'hAgkv', 582600, 'ak4455299@gmail.com', '9783676146', '0', '', 200131, 'unverified'),
(2163, 'rQiEd', 726500, 'yogeshmeena7473@gmail.com', '7375073781', '0', '', 101463, 'verified'),
(2164, 'Meena', 778308, '', '7733879390', '34', '', 35100, 'unverified'),
(2165, 'VKPKo', 429105, '', '9001036659', '0', '', 385601, 'unverified'),
(2166, 'FjErB', 169733, '', '9813507974', '0', '', 341687, 'unverified'),
(2167, 'uDEfa', 825796, '', '9547551208', '0', '', 980609, 'unverified'),
(2168, 'ETklU', 960419, '', '8741092089', '0', '', 987368, 'unverified'),
(2169, 'AJAY MEENA', 307105, 'ajaym65643@gmail.com', '8905251717', '38', '', 516631, 'verified'),
(2170, 'BeBCh', 993649, '', '7426877097', '0', '', 540603, 'unverified'),
(2171, 'Yzqoa', 163965, 'aryanjhajhria6@gmail.com', '9024493652', '0', '', 731451, 'verified'),
(2172, 'Trust #Me', 578801, 'sahidahmed3113@gmail.com', '9896604641', '6', '', 223968, 'verified'),
(2173, 'OWJpu', 856624, 'mamud3509@gmail.com', '9928821488', '551.5', '504059', 19364, 'verified'),
(2174, 'zWFYx', 543876, '', '9785869470', '0', '', 389976, 'unverified'),
(2175, 'VmAsO', 937325, '', '9602474018', '0', '', 876176, 'unverified'),
(2176, 'YDiLN', 612689, '', '7073462547', '0', '', 978139, 'unverified'),
(2177, 'pCBnl', 952572, '', '9799451159', '0', '', 337811, 'unverified'),
(2178, 'BcTUf', 490974, '', '8690453369', '0', '', 936084, 'unverified'),
(2179, 'Shakeel nawaliya', 382054, 'khansakil3880@gmail.com', '9050806690', '0', '', 964274, 'verified'),
(2180, 'EtRNu', 612755, '', '9303959252', '0', '', 501490, 'unverified'),
(2181, 'Ok ghud6842', 403466, 'Khandilsahd9053507172@gmali.com', '9560786886', '0', '90514', 498746, 'verified'),
(2182, 'Sandep', 447130, '', '9016567092', '49', '', 920695, 'unverified'),
(2183, 'mwQAv', 674706, '', '8003562573', '0', '998005', 661009, 'unverified'),
(2184, 'Om namah Shivay', 960387, 'sundarbhawad267@gmail.com', '8949948828', '11.5', '', 718967, 'verified'),
(2185, 'Sahun581', 736256, '', '8813886581', '0', '744996', 337730, 'unverified'),
(2186, 'PlEav', 61229, '', '6375339040', '0', '', 850354, 'unverified'),
(2187, 'HrwWf', 440158, '', '9304217235', '0', '', 557997, 'unverified'),
(2188, 'Pnixz', 105797, 'saleemk7741@gmail.com', '8814843505', '0.5', '', 982928, 'verified'),
(2189, 'Faq', 17395, 'kkmmeena2389@gmail.com', '7627093177', '0', '', 504237, 'verified'),
(2190, 'SwqOa', 163728, 'khananish84319@gmail.com', '9588132976', '0', '', 650250, 'verified'),
(2191, 'yJiLw', 50843, '', '8168320798', '0', '', 395668, 'unverified'),
(2192, 'FMAav', 505250, '', '9991377150', '0', '', 324243, 'unverified'),
(2193, 'Jagga daku', 875076, 'majharmd980@gmail.com', '7974046020', '0', '', 102753, 'verified'),
(2194, 'vrvDs', 545500, '', '9950343040', '0', '', 372938, 'unverified'),
(2195, 'hYbLx', 2777, 'chorloffero3@mail.com', '9216249835', '0.5', '', 759335, 'verified'),
(2196, 'APGQJ', 502123, '', '9084282061', '0', '', 104235, 'unverified'),
(2197, 'Jay shree ram', 314701, 'hansramjat33@gmail.com', '6375707128', '44.5', '', 119789, 'verified'),
(2198, 'pemMW', 817401, '', '7858937304', '0', '', 42723, 'unverified'),
(2199, 'JSZoq', 464959, '', '8950653873', '0', '', 53395, 'unverified'),
(2200, 'AKM', 623453, 'ashokmatwadadiya@gmail.com', '9660393541', '29', '', 812208, 'verified'),
(2201, 'CnkjB', 386501, 'sakirkhan0508@gmail.com', '6375195811', '20', '', 392115, 'verified'),
(2202, 'pjvgC', 290838, '', '7891157366', '0', '364356', 457459, 'unverified'),
(2203, 'ZUqOc', 433900, 'sammy32771@gamil.com', '9817410051', '0', '', 545605, 'verified'),
(2204, 'CMrGT', 505940, '', '8529076357', '0', '', 847466, 'unverified'),
(2205, 'fKUCL', 798687, '', '9636606122', '0', '', 781108, 'unverified'),
(2206, 'AK JaaN😘', 946477, 'aadilkhan9813497905@gmail.com', '9813497905', '0.5', '', 4401, 'verified'),
(2207, 'Kismat kharab hai', 234367, 'mosimkhan3120@gmail.com', '7015961542', '0.5', '', 843995, 'verified'),
(2208, 'xKhVd', 740869, '', '9050472978', '0', '', 922094, 'unverified'),
(2209, 'GlcFX', 186474, '', '9813646686', '0', '', 622072, 'unverified'),
(2210, 'JaYgh', 44935, 'raghuvirmeena040@gmail.com', '9829982354', '233.5', '', 452521, 'verified'),
(2211, 'Looser', 890560, 'kaif71531@gmail.com', '9729349186', '33', '', 728143, 'verified'),
(2212, 'rFtUK', 287962, '', '9828325424', '0', '612690', 989993, 'unverified'),
(2213, 'cWuee', 981467, 'M45917307@gmail.com', '9664159478', '0', '', 986278, 'verified'),
(2214, 'HuwBL', 449986, '', '8168099486', '0', '', 862159, 'unverified'),
(2215, '4234 S.....k', 218152, 'khanr98805@gmail.co', '9772424172', '0.5', '', 312539, 'verified'),
(2216, 'dzpjC', 927528, '', '8209357104', '44', '', 130956, 'unverified'),
(2217, 'UQagc', 519871, '', '9813820941', '0', '', 726406, 'unverified'),
(2218, 'MImNo', 42807, '', '7067386574', '0', '', 47457, 'unverified'),
(2219, 'jgANk', 397398, '', '9549802214', '0', '', 320750, 'unverified'),
(2220, 'GoNJZ', 519915, '', '9340460928', '44', '', 814706, 'unverified'),
(2221, 'aBeCE', 306851, '', '9301040842', '0', '', 787945, 'unverified'),
(2222, 'MgHOa', 701274, '', '7489142320', '0', '', 847006, 'unverified'),
(2223, 'xoFXJ', 662722, '', '8302756339', '0', '', 125288, 'unverified'),
(2224, 'Hamkiin77', 117648, '', '8053703077', '0', '744996', 539935, 'unverified'),
(2225, 'Ram Ram ji', 909243, 'rahulsharmapattya1234@gmail.com', '9352141672', '0', '', 398734, 'verified'),
(2226, 'bEujq', 972390, '', '6367650727', '0', '', 859768, 'unverified'),
(2227, 'ahDEd', 916964, '', '8000054169', '0', '', 959852, 'unverified'),
(2228, 'tnDmJ', 552410, '', '8000054169', '0', '', 913465, 'unverified'),
(2229, 'lyVhI', 476762, '', '8000054169', '0', '', 372475, 'unverified'),
(2230, 'dwZln', 441111, '', '8000054169', '0', '', 365141, 'unverified'),
(2231, 'VGaAj', 131871, '', '8000054169', '0', '', 521615, 'unverified'),
(2232, 'CrqYh', 719130, 'sonugaming893@gmail.com', '6375357757', '0', '834628', 945227, 'pending'),
(2233, 'KTEqs', 589097, '', '9511573358', '0', '', 372230, 'unverified'),
(2234, 'pUdiL', 1268, '', '9511583357', '0', '', 170583, 'unverified'),
(2235, 'Mominn4444', 787269, '', '8053444109', '0', '744996', 329645, 'unverified'),
(2236, '@Kantya2', 441822, 'pintoomeena20@gmail.com', '9414931490', '0', '', 140227, 'verified'),
(2237, 'FKgEv', 207851, '', '7852837501', '0', '', 900830, 'unverified'),
(2238, 'nwbCp', 344727, 'irfankhan77562@gmail.com', '9813177562', '10', '', 48021, 'verified'),
(2239, 'stSZQ', 332751, '', '9549583108', '0', '', 916207, 'unverified'),
(2240, 'CaCsc', 197826, '', '9216274983', '0', '', 904930, 'unverified'),
(2241, 'GARUD', 734802, 'rakesh963620@gmail.com', '9785117072', '24.5', '', 807402, 'verified'),
(2242, 'lgfFV', 606344, '', '9257720781', '0', '', 409312, 'unverified'),
(2243, 'GbCBX', 209744, '', '8561807472', '0', '', 904282, 'unverified'),
(2244, 'wYeNs', 358127, '', '7688894165', '0', '', 95107, 'unverified'),
(2245, 'CAqAj', 549576, 'drm161718@gmail.com', '9928958359', '6', '', 914605, 'verified'),
(2246, 'DQepj', 775528, 'akahn0540@gmail.com', '9828683206', '0.5', '', 511368, 'verified'),
(2247, 'KiatN', 101505, '', '9782551311', '0', '658936', 470831, 'unverified'),
(2248, 'CreGD', 154073, '', '8529290362', '0', '', 20219, 'unverified'),
(2249, 'ILqYg', 788563, '', '9813764158', '0', '', 523637, 'unverified'),
(2250, 'Khamosh', 655449, 'rosanr34@gmail.com', '9893068287', '12', '', 505349, 'verified'),
(2251, 'rpCYR', 907721, 'SUNNYSHARMA0950@GMAIL.COM', '8529384695', '0', '', 752360, 'verified'),
(2252, '🤑🤑🤑🤑🤑', 63996, 'Devkishanmeenameena@gmail.com', '9079464824', '45.5', '', 93076, 'verified'),
(2253, 'wQYyE', 477661, '', '9001316790', '0', '', 576566, 'unverified'),
(2254, 'NKrWg', 330672, '', '8294047469', '0', '', 201273, 'unverified'),
(2255, 'Arun Rajput', 297834, 'rajputarunrajput488@gmail.com', '9103900798', '0.5', '934990', 116917, 'verified'),
(2256, 'D ...', 168790, 'Anand Kumar mandal @gamil.com', '8376948626', '14.5', '228321', 290316, 'verified'),
(2257, 'oEvIs', 524913, '', '7852874845', '0', '', 669066, 'unverified'),
(2258, 'lsLHE', 870901, 'somrajput6352598913@gmail.com', '6006951737', '0', '116917', 440169, 'verified'),
(2259, 'Shiv shankar', 996424, 'sharmadheeraj98400@gmail.com', '7006198400', '0.5', '116917', 282244, 'verified'),
(2260, 'GykGL', 427198, 'SunnySharma7821@gmail.com', '9521464319', '0', '', 463439, 'verified'),
(2261, 'DMYDE', 424707, 'akhan87935@gmail.com', '9991580275', '0.5', '', 575026, 'verified'),
(2262, 'Sharda', 836400, 'shardasengar2219@gmail.com', '9919265882', '24', '', 211922, 'verified'),
(2263, 'Raja rani', 481576, 'rakeshkumarmeena1125@ybl', '9680116133', '1', '', 393934, 'verified'),
(2264, 'kHRuN', 446493, '', '6375308352', '0', '', 151339, 'unverified'),
(2265, 'Rahul kumar meena', 92044, 'rahulsihra2000@gmail.com', '9166998320', '7.5', '', 418435, 'verified'),
(2266, 'nBZfE', 349985, 'dilshadisshu5544@gmail.com', '8813828982', '0', '', 439053, 'verified'),
(2267, 'Dada. g🤫🤠', 932208, 'khanalijan3094@gmail.com', '9898349812', '301.5', '', 353509, 'verified'),
(2268, 'KJjfv', 439492, 'Chandumeena2743@gmail.com', '9971848597', '47', '', 531956, 'verified'),
(2269, 'PwMOD', 761309, '', '7014648392', '0', '', 62929, 'unverified'),
(2270, 'bZdxA', 456445, '', '8400580866', '0', '', 163114, 'unverified'),
(2271, 'xESVo', 500593, '', '9610816484', '0', '', 95711, 'unverified'),
(2272, 'VshJg', 516258, '', '9373573043', '0', '', 221698, 'unverified'),
(2273, 'Wahid vk', 754649, 'wahid9672211431@gmail.com', '9672211431', '2.5', '', 432215, 'verified'),
(2274, 'ELHNL', 505381, '', '7459009802', '38.5', '', 50213, 'unverified'),
(2275, 'D....', 160212, 'sharmadilip801@gmail.com', '9079747869', '0', '958256', 756065, 'verified'),
(2276, 'Jhgfds', 295631, 'Moinalikhan8901@gmail.com', '9529822443', '70', '', 42728, 'verified'),
(2277, 'hdDAG', 108059, '', '9610392867', '0', '', 433738, 'unverified'),
(2278, 'SopRa', 907924, '', '8209124450', '0', '', 508032, 'unverified'),
(2279, 'pRJvy', 749498, '', '8209124450', '0', '', 559282, 'unverified'),
(2280, 'lTSsr', 968577, '', '9784004016', '0', '', 248288, 'unverified'),
(2281, 'A Shikari', 589373, 'aryangautam2703@gmail.com', '7310978131', '47', '', 619415, 'verified'),
(2282, 'XEcBb', 727978, '', '7230931146', '0', '', 603907, 'unverified'),
(2283, 'Mukeem6842', 824708, 'Mukeemkhan0002@gmaul.com', '8920114030', '35', '90514', 654250, 'verified'),
(2284, 'jnsyC', 207061, '', '8273574671', '0', '', 662662, 'unverified'),
(2285, 'whlQc', 632837, '', '9456162178', '0', '', 789982, 'unverified'),
(2286, 'bbpBe', 25967, '', '9991272474', '0', '744996', 438553, 'unverified'),
(2287, 'Last game h koi ajao', 611145, 'sabirgorwal0724@gmail.com', '8307585295', '306', '744996', 893323, 'verified'),
(2288, 'BEjzv', 396408, 'mustkimkhan05789@gmail.com', '7027222544', '0.5', '744996', 581540, 'verified'),
(2289, 'Sarra6842', 284345, 'sarfarazmewati576@gmail.com', '9813731765', '0', '90514', 260439, 'unverified'),
(2290, 'iekqQ', 410564, '', '9813731764', '0', '', 833287, 'unverified'),
(2291, 'KSBch', 375139, '', '9350361590', '0.5', '', 903456, 'unverified'),
(2292, 'vVOHm', 986263, '', '9460128035', '0', '', 804483, 'unverified'),
(2293, 'akLGa', 36984, '', '8302736698', '0', '', 387938, 'unverified'),
(2294, 'The rock', 360717, 'Vlshaltawar830@gmail.com', '7014878782', '0', '', 998262, 'verified'),
(2295, 'fnfHP', 333793, '', '9936290154', '0', '', 336410, 'unverified'),
(2296, 'QZSjT', 502586, '', '7240139072', '0', '984286', 724739, 'unverified'),
(2297, 'yhhkZ', 416042, '', '6307265899', '0', '', 594156, 'unverified'),
(2298, 'BGMI', 417329, 'Usmannida123@gmail.com', '9451854743', '40.5', '', 4279, 'verified'),
(2299, 'iatbx', 852208, '', '9451584743', '0', '', 473346, 'unverified'),
(2300, 'WIYCZ', 523143, '', '8949009247', '0', '', 967143, 'unverified'),
(2301, 'VmveC', 422647, '', '8826873110', '0', '', 578680, 'unverified'),
(2302, 'duNlw', 754923, 'Aaryankhan8744@gmail.com', '9784619436', '0.5', '', 392195, 'verified'),
(2303, 'FZFzQ', 169375, '', '9004223355', '0', '', 167959, 'unverified'),
(2304, 'Madharchod ludo haये', 818800, 'ashish.benito@gmail.com', '7982607677', '30', '', 942729, 'verified'),
(2305, 'FPyFY', 444805, '', '8279236764', '9.5', '', 134450, 'unverified'),
(2306, 'arwZG', 904276, '', '7240556270', '0', '', 935140, 'unverified'),
(2307, 'Fdhjej', 157766, 'Dharmendra BAIRWA 322030@gmail.com', '8107269684', '21', '', 683280, 'verified'),
(2308, 'DQfLY', 456950, '', '9351317004', '0', '', 168448, 'unverified'),
(2309, 'EFgzj', 686555, 'Kinner', '7404590218', '0', '', 949987, 'verified'),
(2310, 'GOGwD', 699784, 'yusufkhan37235@gmail.com', '9991806485', '0', '', 131036, 'verified'),
(2311, 'TUGpt', 890746, '', '9350276533', '0', '', 341593, 'unverified'),
(2312, 'apKtg', 402901, '', '9610178067', '0', '', 733665, 'unverified'),
(2313, 'Vishnu', 444206, 'vkmmukandpura@gmail.com', '9216220583', '0.5', '683114', 983183, 'verified'),
(2314, 'Arsha khan6842', 213119, '', '8930001616', '11.5', '90514', 410103, 'unverified'),
(2315, 'YYxfp', 480668, '', '9671260091', '0', '', 788110, 'unverified'),
(2316, 'oDViD', 375571, '', '9785961059', '0', '', 656611, 'unverified'),
(2317, 'Khatu Shyam ka diwan', 702486, 'kkmeena0093@gmail.com', '8619757563', '35.5', '', 469969, 'verified'),
(2318, 'uclBc', 423717, 'aryankhan890153@gmail.com', '9828574600', '36.5', '', 671381, 'verified'),
(2319, 'uoHIe', 114748, '', '9053371643', '0', '744996', 415311, 'unverified'),
(2320, 'zIDug', 280145, '', '9813994921', '0', '', 175027, 'unverified'),
(2321, 'ZCTlD', 306422, '', '7733093461', '0', '', 442797, 'unverified'),
(2322, 'zzIgc', 536346, '', '8003498149', '0', '', 787892, 'unverified'),
(2323, 'aRdXl', 893177, '', '9651058129', '0', '', 712924, 'unverified'),
(2324, 'hBbre', 556067, 'jaanbewfa753@gmail.com', '8890899929', '29', '', 925273, 'verified'),
(2325, 'NfQfo', 662860, '', '9660996501', '0', '', 725890, 'unverified'),
(2326, 'gwvGd', 101179, '', '8059432494', '18.5', '', 288059, 'unverified'),
(2327, 'CjvEO', 254230, '', '8084307683', '0', '', 315068, 'unverified'),
(2328, 'Raushan yadav', 618310, 'kumarraushan64837@gmail.com', '8084607683', '48.5', '', 210444, 'verified'),
(2329, 'tyIFp', 783611, '', '9414929325', '0', '', 454201, 'unverified'),
(2330, 'FZFpv', 109276, '', '9991289371', '0', '', 240427, 'unverified'),
(2331, 'uJnRo', 140594, '', '8638268366', '0', '', 280911, 'unverified'),
(2332, 'LzSaU', 331357, '', '7252098402', '0', '', 577529, 'unverified'),
(2333, '♥️Ismail❣️', 364626, 'ik6488727@gmail.com', '9817044758', '9.5', '', 55751, 'verified'),
(2334, 'pKmcM', 880273, 'RakeshPrajapat@gmail.com', '9783954476', '0', '', 640964, 'verified'),
(2335, 'AFNCn', 772473, 'Islamicy718@gmail.com', '8053273099', '0', '', 660297, 'verified'),
(2336, 'Sk 6842', 968, '', '9540746842', '0', '90514', 651230, 'unverified'),
(2337, 'kjdcj', 242033, 'chavanchand960@gmail.com', '7027010960', '0', '', 67625, 'verified'),
(2338, 'Nafis', 309087, 'dinfakru638@gmail.com', '8003009643', '6.5', '', 374531, 'pending'),
(2339, 'AViXa', 396867, '', '9058879758', '0', '', 660531, 'unverified'),
(2340, 'dUuFP', 138158, '', '9654358543', '0', '', 886362, 'unverified'),
(2341, 'JZRbl', 382501, '', '8401686123', '0', '', 311321, 'unverified'),
(2342, 'iIdEL', 26641, '', '7860733074', '0', '', 895811, 'unverified'),
(2343, 'DLiSR', 275367, '', '8955275468', '0', '', 41825, 'unverified'),
(2344, 'LevJW', 318812, '', '7732996463', '0', '', 503527, 'unverified'),
(2345, 'LxalB', 155888, '', '9350939543', '0', '', 231290, 'unverified'),
(2346, 'rkLzl', 203020, '', '9359790711', '8.5', '309721', 18119, 'unverified'),
(2347, 'nAOLq', 79287, '', '7988458990', '0', '', 843523, 'unverified'),
(2348, 'YiUYl', 713230, '', '7505641716', '0', '', 592281, 'unverified'),
(2349, 'zAXwG', 739244, 'bannajiloveraj007@gmail.com', '9950820091', '33.5', '', 797189, 'verified'),
(2350, 'RjoEF', 348585, 'khalidkhan56496@gmali.com', '9813662451', '0', '', 772085, 'verified'),
(2351, 'Bjnsk', 1758, '', '8595833469', '0', '', 955365, 'unverified'),
(2352, 'uNBCf', 611719, '', '9024499356', '0', '', 266723, 'unverified'),
(2353, 'RMovG', 593904, '', '9813442845', '0', '', 644459, 'unverified'),
(2354, 'NdquV', 158416, 'saddamnawliya@gmail.com', '9509896936', '0', '', 108333, 'verified'),
(2355, 'YFUdg', 41299, '', '8824940775', '0', '511368', 307629, 'unverified'),
(2356, 'AGGFx', 710583, '', '9813976687', '0', '', 11774, 'unverified'),
(2357, 'zDmHl', 405192, 'Mustufakhan34012@gmail.com', '9813976684', '49', '', 202783, 'verified'),
(2358, 'CcGDs', 65284, '', '9257869819', '5.5', '', 716601, 'unverified'),
(2359, 'OfTJA', 258639, '', '8279287392', '0', '', 896006, 'unverified'),
(2360, 'CoaYU', 692692, 'Tasileemkhan @gmail.com', '9310844979', '0', '', 691677, 'verified'),
(2361, 'xlAVs', 328076, '', '7850847112', '0', '', 929454, 'unverified'),
(2362, 'wxNlL', 61980, 'ak0157060@gmail.com', '7340660268', '0', '', 948586, 'verified'),
(2363, 'scfCd', 825031, '', '8890061274', '0', '504059', 912490, 'unverified'),
(2364, 'aQTUQ', 22192, 'skhan880345@gmail.com', '9518287697', '14', '', 264604, 'verified'),
(2365, 'Aalish Nawliya', 359978, 'nawliyaaalish@gmail.com', '9813529203', '0', '', 439588, 'verified'),
(2366, 'FrnPY', 655869, 'aslamkshop@gmail.com', '8696621240', '160.5', '', 288793, 'verified'),
(2367, 'WWTDk', 874988, '', '6375977496', '0', '', 281147, 'unverified'),
(2368, 'PJAmX', 11511, '', '9671690736', '0', '', 302499, 'unverified'),
(2369, 'OZvHt', 525544, 'hansramjat33@gmail.com', '9030852632', '0', '', 693384, 'unverified'),
(2370, 'MIIxn3586', 795314, '', '9813833586', '0', '744996', 543885, 'unverified'),
(2371, 'Blmet', 549700, '', '9671439595', '86.5', '', 57487, 'unverified'),
(2372, 'Manish choudhary', 490880, 'Mc779477@gmailcom', '7568868945', '145', '', 584674, 'verified'),
(2373, 'RwkJl', 253474, '', '8233697943', '0', '', 980138, 'unverified'),
(2374, 'uPlyL', 278183, '', '9588781909', '0', '744996', 286649, 'unverified'),
(2375, 'txVyv', 871705, '', '8955347790', '0', '', 703226, 'unverified'),
(2376, 'Raaj Kapoor', 144455, 'Chandra9983676475@gmail.com', '9983676475', '0', '', 778824, 'unverified'),
(2377, 'uiTTM', 483191, '', '7302805665', '0', '', 426712, 'unverified'),
(2378, 'TeNta', 57244, '', '7818020091', '0', '', 556158, 'unverified'),
(2379, 'zwBPZ', 180502, '', '8930983274', '0', '90514', 328334, 'unverified'),
(2380, 'Simple boyyy 🫶🫶', 41110, 'Talimkhan 84582@gmail .com', '9813561669', '0', '', 718897, 'verified'),
(2381, 'samKX', 664975, '', '8104230773', '0', '', 620748, 'unverified'),
(2382, 'IWRJk', 810467, '', '8955684328', '0', '', 933515, 'unverified'),
(2383, 'orLPO', 120063, 'khanjuned05053@gmail.com', '8279209204', '0', '', 271052, 'verified'),
(2384, 'ncHJw', 743101, '', '7726999012', '0', '', 702796, 'unverified'),
(2385, 'TiqZv', 233459, '', '7728016464', '0', '', 843648, 'unverified'),
(2386, 'cjtlT', 52270, '', '8357970186', '0', '', 913095, 'unverified'),
(2387, 'QQHzl', 648861, '', '9813548445', '47', '', 152407, 'unverified'),
(2388, 'TRKFp', 48145, 'AKHLAQK616@GMAIL.com', '8278929474', '0', '', 64545, 'verified'),
(2389, 'AmTmu', 616601, '', '8930490972', '0', '', 641258, 'unverified'),
(2390, 'Xfchm', 689868, 'wk0841838@gmail.com', '9671670972', '47', '', 426371, 'verified'),
(2391, 'igMvS', 888901, '', '7240600531', '0', '', 639017, 'unverified'),
(2392, 'TikQi', 588273, '', '7240600531', '0', '', 797878, 'unverified'),
(2393, 'qYsFw', 821225, '', '7240600531', '0', '', 827795, 'unverified'),
(2394, 'jdpsu', 622904, '', '7240600531', '0', '', 830821, 'unverified'),
(2395, 'sMeGv', 611964, '', '7240600531', '0', '', 272341, 'unverified'),
(2396, 'KsqWM', 68085, '', '7240600531', '0', '', 829435, 'unverified'),
(2397, 'RmnDL', 424301, '', '7240600531', '0', '', 581109, 'unverified'),
(2398, 'REtXU', 586988, '', '7240600531', '0', '', 51917, 'unverified'),
(2399, 'qNWNs', 961824, '', '9929349522', '0', '', 186946, 'unverified'),
(2400, 'cnakG', 7076, 'djat3546@gmail.com in', '9983941457', '38', '', 160135, 'verified'),
(2401, 'bmEBE', 266793, 'mewatirahees71@gmail.com', '9306617089', '588', '', 270702, 'verified'),
(2402, 'yVHMu', 626811, '', '8103771865', '0', '', 734137, 'unverified'),
(2403, 'vOUpE', 239445, '', '9053128609', '0', '', 630223, 'unverified'),
(2404, 'qjBNT', 353532, '', '8233997289', '643', '', 743403, 'unverified'),
(2405, 'FwJoC', 775224, '', '7099648001', '0', '', 587854, 'unverified'),
(2406, 'Xxxxxxx', 179428, '', '7727993730', '17.5', '629628', 589795, 'unverified'),
(2407, 'qDriI', 799654, '', '9521732933', '0', '', 101644, 'unverified'),
(2408, 'rFHat', 6740, '', '6367665647', '0', '', 257095, 'unverified'),
(2409, 'fbuYl', 855927, '', '9509787896', '0', '', 478517, 'unverified'),
(2410, 'zYXgY', 322689, '', '6378742794', '0', '', 459485, 'unverified'),
(2411, 'yFyLA', 138475, 'aakilkhan5449@gmail.com', '9813106238', '0', '', 161937, 'verified'),
(2412, 'LsliJ', 751785, 'Soyab4400@gmail.com', '9899813851', '0', '', 797032, 'verified'),
(2413, '👑💖', 569441, 'Injmamulhaq@gmail.com', '9310745189', '48', '228321', 420335, 'verified'),
(2414, 'EVNEN', 200906, '', '9234579089', '0', '', 401696, 'unverified'),
(2415, 'FBkkx', 566867, '', '9671560646', '0', '744996', 115466, 'unverified'),
(2416, 'Banta86', 463692, '', '9992273786', '0', '744996', 254142, 'unverified'),
(2417, 'OTKaC', 418620, 'nisarghasoli@gmail.com', '9602098406', '0', '', 500461, 'verified'),
(2418, 'dYHCS', 830248, '', '9549983744', '0', '', 256656, 'unverified'),
(2419, 'jTOaC', 73144, 'Saddam Khansaddam61255@gmail.com', '8306155068', '267.5', '504059', 105009, 'verified'),
(2420, 'YtoEW', 925706, '', '7300151293', '0', '', 615714, 'unverified'),
(2421, 'rdpIy', 684011, '', '8084686861', '0', '', 131150, 'unverified'),
(2422, 'sZkWC', 649310, '', '6376899253', '0', '', 130336, 'unverified'),
(2423, 'cUOve', 967517, '', '6376099253', '0', '', 425208, 'unverified'),
(2424, 'LaLyJ', 780199, '', '8440823851', '0', '', 787658, 'unverified'),
(2425, 'Vicky', 859260, '', '8769246341', '29', '', 861747, 'unverified'),
(2426, 'fJSHH', 28050, '', '8955385911', '0', '', 720633, 'unverified'),
(2427, 'Ofisa bano', 322266, 'khanmubeen0296@gmail.com', '9784645836', '21.5', '', 447007, 'verified'),
(2428, 'jnDTx', 372936, '', '9784645836', '0', '', 46043, 'unverified'),
(2429, 'JrMvv', 552057, 'Shera7773@gmail com', '7665588650', '45.5', '504059', 909110, 'verified'),
(2430, 'dPdYl', 19706, '', '9672737451', '48.5', '', 915493, 'unverified'),
(2431, 'cEFrX', 5270, '', '9813320045', '0', '', 890354, 'unverified'),
(2432, 'MqnbY', 39722, '', '6389369512', '0', '', 987091, 'unverified'),
(2433, 'ZypXn', 769711, '', '8824890153', '0', '', 261658, 'unverified'),
(2434, 'GDGZH', 735564, '', '9050668944', '0', '', 20151, 'unverified'),
(2435, 'oOueN', 403423, 'mk7025262@gmail.com', '9991537785', '0', '', 925057, 'unverified'),
(2436, 'fWqfc', 7618, '', '8529878326', '0', '288793', 458462, 'unverified'),
(2437, 'Kgvherj0023', 494308, '', '9380023522', '0', '744996', 340532, 'unverified'),
(2438, 'uHtsr', 832949, '', '8233313954', '0', '', 633323, 'unverified'),
(2439, 'OBMFA', 550682, 'Mk5995620@gmail.com', '9024905627', '0', '', 449163, 'verified'),
(2440, 'qyyyw', 383300, 'Mujahid6616@gmail.com', '9813493592', '3.5', '993715', 353101, 'verified');
INSERT INTO `tablename` (`id`, `Name`, `otp`, `Email`, `Phone`, `Wallet_balance`, `referral`, `referral_code`, `verified`) VALUES
(2441, 'gyygT', 602813, 'meenuchauhan4625@gmail.com', '6392811387', '0.5', '', 361698, 'verified'),
(2442, 'lHiEp', 251052, '', '7229919159', '0', '', 458050, 'unverified'),
(2443, 'nCUXy', 68555, '', '7739631547', '0', '', 618473, 'unverified'),
(2444, 'Junaid mewati', 905403, '', '8930964780', '0', '', 557632, 'unverified'),
(2445, 'tqRnE', 35868, '', '6378846245', '0', '', 239462, 'unverified'),
(2446, 'HzUQS', 945608, '', '9772022517', '0', '', 830848, 'unverified'),
(2447, 'ZPKPK', 342007, '', '8252920322', '0', '', 602623, 'unverified'),
(2448, 'Knigh3864', 806477, '', '9671386463', '0', '744996', 436728, 'unverified'),
(2449, 'YoBfT', 268613, '', '8529690578', '0', '', 393662, 'unverified'),
(2450, 'Jatin', 876927, 'Lodhijatin287@gmail.com', '6266974362', '141', '795155', 843432, 'verified'),
(2451, 'oZtYe', 381117, '', '9782787784', '0', '', 229352, 'unverified'),
(2452, 'sbjGQ', 60176, '', '9306859540', '0', '365706', 121423, 'unverified'),
(2453, 'QkHjl', 601210, '', '9306459557', '0', '', 884878, 'unverified'),
(2454, 'XycmS', 644306, '', '9530182264', '0', '', 701329, 'unverified'),
(2455, 'yBjeQ', 401746, '', '9996712161', '0', '', 209509, 'unverified'),
(2456, 'Robin6842', 542950, 'rahatkhan122033@gmail.com', '9813915141', '975.5', '90514', 397982, 'verified'),
(2457, 'CzLxA', 740657, '', '7742896167', '0', '', 15185, 'unverified'),
(2458, 'wfdId', 278383, '', '9813500187', '0', '', 839361, 'unverified'),
(2459, 'OLeFD', 984601, '', '9509770119', '0', '', 60873, 'unverified'),
(2460, 'Momin07', 731740, '', '7988935807', '0', '744996', 698642, 'unverified'),
(2461, 'sndLs', 987755, '', '9813931192', '0', '744996', 993609, 'unverified'),
(2462, 'kDvtS', 615834, '', '9813555278', '0.5', '', 656051, 'unverified'),
(2463, 'JHUMq', 681557, '', '7856925852', '0', '', 35841, 'unverified'),
(2464, 'qIdpu', 672037, '', '8770416009', '0', '', 284188, 'unverified'),
(2465, 'XSmVm', 796347, '', '9896604642', '0', '', 195033, 'unverified'),
(2466, 'CUZxM', 939807, '', '9813412263', '0', '', 688114, 'unverified'),
(2467, 'aExDA', 72692, 'Mubarikkhan@123gmail.com', '9306641524', '36', '', 792167, 'verified'),
(2468, 'nZunm', 584616, 'monusheoran472@gmail.com', '9813270770', '0', '', 345327, 'verified'),
(2469, 'Ab gaad fat rhi mc', 103152, '', '8720039867', '0.5', '', 458724, 'unverified'),
(2470, 'xacOK', 151531, '', '7263023674', '0.5', '', 169871, 'unverified'),
(2471, '๛J U L M I๛', 93999, '', '9711071590', '0.5', '228321', 27903, 'unverified'),
(2472, 'sHSEy', 224209, '', '7240772463', '0', '', 347750, 'unverified'),
(2473, 'yxlzv', 641184, '', '6378967740', '0', '', 825187, 'unverified'),
(2474, 'CHORA SRP', 222291, 'shahroopkhan25@gmail.come', '8955619496', '0.5', '', 764915, 'verified'),
(2475, 'LfSXR', 254639, '', '9455061470', '0', '', 758736, 'unverified'),
(2476, 'CbDwU', 353657, '', '7300310149', '0', '', 687701, 'unverified'),
(2477, '500++ Game no Theme', 770057, 'Lekhraj@gmail.com', '7877479975', '43.5', '719259', 115347, 'verified'),
(2478, 'wiEyb', 103007, '', '9929444563', '0', '', 992372, 'unverified'),
(2479, 'KHBzs7803', 379181, 'rahulgorwal38@gmail.com', '9050789603', '0.5', '744996', 482621, 'verified'),
(2480, 'YCsKO', 299578, '', '9993446801', '0', '', 531527, 'unverified'),
(2481, 'mBgvY', 502530, '', '7879844848', '0', '', 775523, 'unverified'),
(2482, 'zOlqG', 794472, '', '9166823676', '0', '665699', 149754, 'unverified'),
(2483, 'Aslam Bhai', 815956, 'aslam.pahat@gmail.com', '9828818131', '27.5', '', 880778, 'pending'),
(2484, 'aOpaf', 365637, '', '9509368667', '0', '', 987565, 'unverified'),
(2485, 'CZNUI', 734765, '', '6350293718', '0', '', 814760, 'unverified'),
(2486, 'OuKvY', 123131, '', '9521609617', '30.5', '', 930050, 'unverified'),
(2487, 'nCtQr', 175889, 'SK5995620@gmail.com', '9571613769', '0.5', '', 582323, 'verified'),
(2488, 'vvBKW', 954691, '', '9053727358', '0', '', 622947, 'unverified'),
(2489, 'DrMLD', 490496, '', '6398679261', '0', '', 231271, 'unverified'),
(2490, 'zIrmk', 559970, 'farmankhan03866@gmail.com', '8708756108', '0.5', '', 164272, 'verified'),
(2491, 'Dholi darling', 693496, 'rahulkhan769688@gmail.com', '9813769688', '49', '', 565877, 'verified'),
(2492, 'Tera yr', 816520, 'brijeshmeena1772002@gmail.com', '7357682197', '100.5', '', 96528, 'verified'),
(2493, 'Chhotu', 64865, '', '9680575316', '0', '', 928781, 'unverified'),
(2494, 'SYdPs', 191577, '', '9649240580', '0', '', 814431, 'unverified'),
(2495, 'Mubarik', 855403, 'sk8824883@gmail.com', '6378527162', '0', '', 331909, 'verified'),
(2496, 'eDDJv', 724981, '', '6378841077', '0', '', 631756, 'unverified'),
(2497, 'EodpF', 433761, '', '9050969052', '0', '', 664054, 'unverified'),
(2498, 'fggRH', 773277, '', '9116885119', '0', '', 568977, 'unverified'),
(2499, 'Bswqo', 805818, '', '8239764582', '0', '183725', 944222, 'unverified'),
(2500, 'QcntU', 502113, '', '8290208090', '0', '', 32275, 'unverified'),
(2501, 'Rocky Jareda', 336065, 'sachinmeenameena112@gmail.com', '7378090057', '0', '', 688088, 'verified'),
(2502, 'rYIuN', 799910, 'kmakul396@gmail.com', '8396080575', '0.5', '', 714672, 'verified'),
(2503, 'aPuoi', 81425, '', '9785014212', '0', '', 725642, 'unverified'),
(2504, 'PmdSL', 77267, 'mansukhtejaka@gmail.com', '9057501579', '0', '531956', 916197, 'verified'),
(2505, 'nbEFb', 114361, '', '8619080762', '0', '', 935173, 'unverified'),
(2506, 'ZIMzE', 266897, 'kshokin975@gmail.com', '9166680954', '0', '', 857336, 'verified'),
(2507, 'IYHHh', 33021, '', '9350612874', '0', '', 132994, 'unverified'),
(2508, 'FZINp', 319743, '', '9053583649', '0', '', 678673, 'unverified'),
(2509, 'NnqRo', 855228, '', '9828129083', '0', '303546', 460655, 'unverified'),
(2510, 'cftrN', 543666, '', '9351018518', '0', '303546', 329466, 'unverified'),
(2511, 'CsEel', 182996, '', '7378158384', '0', '', 60075, 'unverified'),
(2512, 'cpzhf', 257272, 'Pramodbadsara18899@gmail.com', '9521841516', '0', '', 979207, 'verified'),
(2513, 'Kloklo', 316712, 'ravimeena@gmail.com', '8386949458', '0', '', 813810, 'verified'),
(2514, 'zRfVH', 508362, '', '6378603676', '47', '', 810217, 'unverified'),
(2515, 'doLPr', 347919, '', '6299797835', '0', '829366', 787083, 'unverified'),
(2516, 'jrrOB', 657277, 'amintoppo1@gmail.com', '8651345064', '0', '140227', 653049, 'verified'),
(2517, 'RAmXU', 195580, 'Ashokmeeba338@gmail.com', '9982982130', '0', '', 160897, 'verified'),
(2518, 'mFGdP', 139364, '', '8930617452', '0', '744996', 608151, 'unverified'),
(2519, 'VcCwz', 97441, '', '9991243586', '0', '744996', 126010, 'unverified'),
(2520, '@Kantya', 648610, 'meenaaj016@gmail.com', '7814557207', '0', '', 926665, 'verified'),
(2521, 'UrxJj', 657921, '', '9982258164', '0', '', 912427, 'unverified'),
(2522, 'kcznD', 469330, '', '9518080798', '0', '', 958646, 'unverified'),
(2523, 'zUDbD', 444449, 'islamuddin9671946869@gmail.com', '9671946869', '0', '', 810212, 'unverified'),
(2524, 'S .......', 92297, '', '9518457547', '20', '228321', 376110, 'unverified'),
(2525, 'Munnu', 784855, 'Lodhijatin287@gmail.com', '6268783302', '3.5', '795155', 664289, 'verified'),
(2526, 'qeYUn', 844509, 'mohanlalsharma9500@gmail.com', '7568280580', '0', '327377', 285278, 'verified'),
(2527, 'Ufqkf', 933192, '', '9694607834', '0', '', 915446, 'unverified'),
(2528, 'Viru', 833463, 'sanil1359@gmail.com', '9783853965', '16', '', 478899, 'verified'),
(2529, 'PZkFH', 126478, '', '8723424198', '0', '', 49498, 'unverified'),
(2530, 'gHlgz', 398727, '', '8726424198', '0', '', 716050, 'unverified'),
(2531, 'rxuZN', 770305, '', '8726424198', '0', '', 270471, 'unverified'),
(2532, 'nGBUQ', 670301, 'mewatiirsadkhan25@gmail.com', '7073862547', '0', '', 521406, 'verified'),
(2533, 'EOtoy', 66970, '', '9850668944', '0', '', 637891, 'unverified'),
(2534, 'RhEKk', 830577, '', '9586115622', '0', '', 961043, 'unverified'),
(2535, 'Last game h', 40118, 'ajitjakhar111@gmail.com', '9588115622', '137', '', 867869, 'verified'),
(2536, 'xTOod', 824443, '', '9340386233', '0', '', 243868, 'unverified'),
(2537, 'hXUpF', 890775, '', '7891039012', '0', '', 37394, 'unverified'),
(2538, 'tAoVi', 542935, '', '7734906150', '0', '', 776389, 'unverified'),
(2539, 'pMvJd', 113197, '', '9772731748', '0', '', 759561, 'unverified'),
(2540, 'dhCNC', 482264, '', '9680290498', '0', '759561', 423209, 'unverified'),
(2541, 'jUWBy', 533883, 'sahidkhan567788@gmail.com', '9991865547', '98.5', '', 746790, 'verified'),
(2542, 'MrljV', 827396, 'sumitdorata1010@gmail.com', '9462671010', '100', '', 331580, 'verified'),
(2543, 'FzVnL', 68261, '', '8595359326', '0', '', 821478, 'unverified'),
(2544, 'iMIoL', 363270, '', '7597510827', '0', '', 570835, 'unverified'),
(2545, 'oKBfY', 862329, '', '8290034230', '0', '', 654921, 'unverified'),
(2546, 'GMvhs', 435417, '', '9660645376', '0', '', 724745, 'unverified'),
(2547, 'qdTrl', 623488, 'pashasharif327@gmail.com', '8445729515', '0', '', 467556, 'unverified'),
(2548, 'CvRQJ', 391056, '', '8445729512', '0', '', 213282, 'unverified'),
(2549, 'Rqbfk', 292255, '', '6377446646', '0', '413189', 465967, 'unverified'),
(2550, 'BkiRn', 201670, '', '9257781065', '0', '', 492488, 'unverified'),
(2551, 'Mosam khan tijara', 922286, 'mosamkhanalapur000786@gmail.com', '9351836037', '1250.5', '744996', 666705, 'verified'),
(2552, 'BSfzV', 645029, 'kdmeena316@gmail.com', '8890006674', '0', '', 996525, 'verified'),
(2553, 'No fresh id aana', 623220, 'danishdx336@gmail.com', '8279273457', '0', '', 50330, 'verified'),
(2554, 'eKkhA', 289809, '', '8946889917', '0', '', 422654, 'unverified'),
(2555, 'iOomW', 535660, '', '9811841358', '97', '', 495790, 'unverified'),
(2556, 'USLNP', 263887, '', '9548722122', '0', '', 588368, 'unverified'),
(2557, 'ueNub', 971620, '', '7568175364', '0', '', 459779, 'unverified'),
(2558, 'PlUcN', 474299, 'singhalnishu1998@gmail.com', '9983182582', '4184', '', 438358, 'verified'),
(2559, 'oaJkF', 609792, '', '7976251757', '0', '', 86453, 'unverified'),
(2560, 'kGoSr', 939024, '', '9460520503', '0', '86453', 270693, 'unverified'),
(2561, 'iUfjn', 323312, '', '8442056127', '0', '', 776061, 'unverified'),
(2562, 'RnKVd', 921212, '', '9376056127', '0', '', 731520, 'unverified'),
(2563, 'IFuFL', 152772, '', '9889487008', '0', '', 117771, 'unverified'),
(2564, 'Mahakal_6', 773893, '', '6367120781', '950', '', 519951, 'unverified');

-- --------------------------------------------------------

--
-- Table structure for table `usdt`
--

CREATE TABLE `usdt` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `network` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usdt`
--

INSERT INTO `usdt` (`id`, `address`, `network`, `status`) VALUES
(1, 'TF3seZLkjNnHBWGPCTKyDPmD7ZTUfzmKeQ', 'trc20', 1);

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
  `fname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `deposit_wallet` decimal(10,2) NOT NULL DEFAULT 0.00,
  `withdraw_wallet` decimal(10,2) NOT NULL DEFAULT 0.00,
  `referrer_id` varchar(100) NOT NULL,
  `level_1` varchar(100) DEFAULT NULL,
  `level_2` varchar(100) DEFAULT NULL,
  `level_3` varchar(100) DEFAULT NULL,
  `withdraw_status` int(11) NOT NULL DEFAULT 1,
  `withdraw_count` int(11) NOT NULL DEFAULT 0,
  `adhaar_no` varchar(255) DEFAULT NULL,
  `pan_no` varchar(255) DEFAULT NULL,
  `pan_status` int(11) NOT NULL DEFAULT 0,
  `kyc_status` tinyint(1) NOT NULL DEFAULT 0,
  `login_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `verified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `mobile`, `profile_pic`, `role`, `otp`, `fname`, `username`, `email`, `deposit_wallet`, `withdraw_wallet`, `referrer_id`, `level_1`, `level_2`, `level_3`, `withdraw_status`, `withdraw_count`, `adhaar_no`, `pan_no`, `pan_status`, `kyc_status`, `login_token`, `created_at`, `status`, `verified_at`) VALUES
(1, '9588221390', '2', 'user', 12345, NULL, 'LuEHdLPe', NULL, 0.00, 0.00, '8RVqPC4wj3', '', NULL, NULL, 1, 0, '654261303144', NULL, 0, 0, 'e90982372a705127750df9a2f218d956', '2024-10-28 12:41:56', 2, '2024-10-29 09:29:29'),
(4, '1234567890', '19', 'user', 12345, NULL, 'juAnoaEX', NULL, 0.00, 0.00, 'gwIrKS1VMW', '8RVqPC4wj3', NULL, NULL, 1, 0, NULL, NULL, 0, 0, 'b8bb54617a95616ae2d06fb2012eb0b0', '2024-10-28 17:47:06', 2, '2024-10-28 17:47:12'),
(5, '9784597208', '17', 'user', 12345, 'Hello', 'DsmpZoQS', '', 0.00, 0.00, '7sCBqjudVw', '8RVqPC4wj3', NULL, NULL, 1, 0, NULL, NULL, 0, 0, '5b069faf5be9929232cae0dd6f2c828a', '2024-10-28 18:04:29', 2, '2024-10-28 18:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdrawrecord`
--

CREATE TABLE `withdrawrecord` (
  `id` int(11) NOT NULL,
  `txnid` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `type` enum('upi','bank') NOT NULL,
  `payment_info` varchar(255) NOT NULL DEFAULT '{"is_upi":false,"is_bank":false,"upi":null,"bank" : {"ac":null,"ifsc":null}}',
  `status` int(11) NOT NULL DEFAULT 0,
  `remark` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_modes`
--

CREATE TABLE `withdraw_modes` (
  `id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `pay_name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `withdraw_modes`
--

INSERT INTO `withdraw_modes` (`id`, `icon`, `pay_name`, `slug`, `status`) VALUES
(1, 'https://cdn.uxhack.co/product_logos/bhim_logo_2.png', 'UPI Withdraw', 'upi', 1),
(2, 'https://cdn-icons-png.flaticon.com/512/2830/2830289.png', 'Bank Withdraw', 'bankcard', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aadhaar_data`
--
ALTER TABLE `aadhaar_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_earnings`
--
ALTER TABLE `admin_earnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bankdetails`
--
ALTER TABLE `bankdetails`
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
-- Indexes for table `game_record`
--
ALTER TABLE `game_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manualupi`
--
ALTER TABLE `manualupi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pan_data`
--
ALTER TABLE `pan_data`
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
-- Indexes for table `penalties`
--
ALTER TABLE `penalties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penalty`
--
ALTER TABLE `penalty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permission_name` (`permission_name`);

--
-- Indexes for table `profile_pic`
--
ALTER TABLE `profile_pic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tablename`
--
ALTER TABLE `tablename`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usdt`
--
ALTER TABLE `usdt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `withdrawrecord`
--
ALTER TABLE `withdrawrecord`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw_modes`
--
ALTER TABLE `withdraw_modes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aadhaar_data`
--
ALTER TABLE `aadhaar_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_earnings`
--
ALTER TABLE `admin_earnings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bankdetails`
--
ALTER TABLE `bankdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bonus`
--
ALTER TABLE `bonus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gamelists`
--
ALTER TABLE `gamelists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_record`
--
ALTER TABLE `game_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manualupi`
--
ALTER TABLE `manualupi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pan_data`
--
ALTER TABLE `pan_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paymenthistory`
--
ALTER TABLE `paymenthistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_modes`
--
ALTER TABLE `payment_modes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penalties`
--
ALTER TABLE `penalties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penalty`
--
ALTER TABLE `penalty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profile_pic`
--
ALTER TABLE `profile_pic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tablename`
--
ALTER TABLE `tablename`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2565;

--
-- AUTO_INCREMENT for table `usdt`
--
ALTER TABLE `usdt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `withdrawrecord`
--
ALTER TABLE `withdrawrecord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdraw_modes`
--
ALTER TABLE `withdraw_modes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
