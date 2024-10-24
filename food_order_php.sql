-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2024 at 08:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_order_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `email`) VALUES
(1, 'test admin', 'test@admin', '$2y$10$3kPUiSRM/ZlG/AEYFlpLaeYWrL8weldj7gSevO7xRLuPrTpVXisci', 'test@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `heading1` varchar(255) NOT NULL,
  `heading2` varchar(255) NOT NULL,
  `btn_txt` varchar(255) DEFAULT NULL,
  `btn_link` varchar(55) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `order_no` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `heading1`, `heading2`, `btn_txt`, `btn_link`, `image`, `order_no`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'test heading 1', 'test heading 2', 'view', 'http://localhost:3000', '6717afc3be174.jpg', 1, 1, '2024-10-22 13:59:31', '2024-10-22 13:59:31'),
(2, 'test heading 1 updated', 'test product 4 heading 2', 'view', 'http://localhost:3000', '6717afd31558e.png', 2, 1, '2024-10-22 13:59:47', '2024-10-22 13:59:47'),
(3, 'test product 4 heading 1', 'test product 1 heading 2', 'view', 'http://localhost:3000', '6717afe12226f.jpg', 3, 1, '2024-10-22 14:00:01', '2024-10-22 14:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `createdAt`, `updatedAt`) VALUES
(2, 'indian', 1, '2024-10-22 13:52:38', '2024-10-22 13:52:38'),
(3, 'south indian', 1, '2024-10-22 13:52:47', '2024-10-22 13:52:47'),
(4, 'chines', 1, '2024-10-22 13:52:59', '2024-10-22 13:52:59'),
(5, 'punjabi', 1, '2024-10-22 13:53:08', '2024-10-22 13:53:08');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `message` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `mobile`, `message`, `createdAt`, `updatedAt`) VALUES
(1, 'test user', 'test@user.com', '7777777777', 'this is a test message with some dummy content is going here', '2024-10-03 09:21:32', '2024-10-03 09:21:32'),
(2, 'test user', 'test@user.com', '4444444444', 'this is a test message, with some dummy content is going here', '2024-10-08 08:28:37', '2024-10-08 08:28:37'),
(4, 'test user', 'test@user.com', '4444444444', 'this is a test message with some dummy content is going here', '2024-10-24 04:24:20', '2024-10-24 04:24:20');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(50) NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `coupon_type` varchar(10) NOT NULL,
  `cart_min_value` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `coupon_value`, `coupon_type`, `cart_min_value`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'welcome500', 500, 'Rupee', 3000, 1, '2024-10-22 13:56:43', '2024-10-22 13:57:18'),
(2, 'year24', 24, 'Percentage', 5000, 1, '2024-10-22 13:57:04', '2024-10-22 13:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy`
--

CREATE TABLE `delivery_boy` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `delivery_boy`
--

INSERT INTO `delivery_boy` (`id`, `name`, `email`, `mobile`, `password`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'processing', 'processing', 'processing', 'processing', 1, '2024-10-24 03:59:07', '2024-10-24 03:59:07'),
(2, 'john doe', 'john@doe.com', '2222222222', '$2y$10$gmamw1wByZg/8.715nJlQ.t6lqCFEKPILYdb48YSugMwd96fTGd6q', 1, '2024-10-23 13:31:31', '2024-10-23 13:31:31'),
(3, 'jane dae', 'jane@dae.com', '3333333333', '$2y$10$.c3DD.bZB6VRE0DWZoq9HOe9AH4LxFdaI8iC4Enr4am1sKxkPujYG', 1, '2024-10-23 13:31:57', '2024-10-23 13:31:57');

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE `dish` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `dish` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `type` enum('veg','non-veg') NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`id`, `category_id`, `dish`, `image`, `type`, `status`, `createdAt`, `updatedAt`) VALUES
(4, 2, 'indian veg title', '6717c390c5b8b.png', 'veg', 1, '2024-10-22 15:24:00', '2024-10-22 15:24:00'),
(5, 2, 'indian non veg title', '6717c39edc765.jpg', 'non-veg', 1, '2024-10-22 15:24:14', '2024-10-22 15:24:14'),
(6, 3, 'south indian veg title', '6717c3ae55d77.jpg', 'veg', 1, '2024-10-22 15:24:30', '2024-10-22 15:24:30'),
(7, 3, 'south indian non veg', '6717c3c39dd6a.jpg', 'non-veg', 1, '2024-10-22 15:24:51', '2024-10-22 15:24:51'),
(8, 4, 'chines veg title', '6717c3dbe9de8.png', 'veg', 1, '2024-10-22 15:25:15', '2024-10-22 15:25:15'),
(9, 4, 'chines non veg title', '6717c3ea29dcb.jpg', 'non-veg', 1, '2024-10-22 15:25:30', '2024-10-22 15:25:30'),
(10, 5, 'punjabi veg title', '6717c3fa1ce1b.png', 'veg', 1, '2024-10-22 15:25:46', '2024-10-22 15:25:46'),
(11, 5, 'punjabi non veg title', '6717c407e60e3.jpg', 'non-veg', 1, '2024-10-22 15:25:59', '2024-10-22 15:25:59');

-- --------------------------------------------------------

--
-- Table structure for table `dish_details`
--

CREATE TABLE `dish_details` (
  `id` int(11) NOT NULL,
  `dish_id` int(11) NOT NULL,
  `attribute` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dish_details`
--

INSERT INTO `dish_details` (`id`, `dish_id`, `attribute`, `price`, `createdAt`, `updatedAt`) VALUES
(5, 4, 'half', 50, '2024-10-22 15:26:34', '2024-10-22 15:26:34'),
(6, 4, 'full', 100, '2024-10-22 15:26:37', '2024-10-22 15:26:37'),
(7, 5, 'half', 200, '2024-10-22 15:26:46', '2024-10-22 15:26:46'),
(8, 5, 'full', 400, '2024-10-22 15:26:50', '2024-10-22 15:26:50'),
(9, 6, 'half', 100, '2024-10-22 15:27:01', '2024-10-22 15:27:01'),
(10, 6, 'full', 200, '2024-10-22 15:27:05', '2024-10-22 15:27:05'),
(11, 7, 'half', 250, '2024-10-22 15:27:20', '2024-10-22 15:27:20'),
(12, 7, 'full', 500, '2024-10-22 15:27:24', '2024-10-22 15:27:24'),
(13, 8, 'half', 125, '2024-10-22 15:27:37', '2024-10-22 15:27:37'),
(14, 8, 'full', 250, '2024-10-22 15:27:40', '2024-10-22 15:27:40'),
(15, 9, 'half', 50, '2024-10-22 15:27:47', '2024-10-22 15:27:47'),
(16, 9, 'full', 100, '2024-10-22 15:27:51', '2024-10-22 15:27:51'),
(17, 10, 'half', 300, '2024-10-22 15:28:00', '2024-10-22 15:28:00'),
(18, 10, 'full', 600, '2024-10-22 15:28:03', '2024-10-22 15:28:03'),
(19, 11, 'half', 500, '2024-10-22 15:28:09', '2024-10-22 15:28:09'),
(20, 11, 'full', 600, '2024-10-22 15:28:13', '2024-10-22 15:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivery_boy_id` int(11) NOT NULL DEFAULT 1,
  `address` varchar(250) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `coupon_value` varchar(50) DEFAULT NULL,
  `coupon_code` varchar(50) DEFAULT NULL,
  `total_price` float NOT NULL,
  `net_price` int(11) NOT NULL,
  `paymentResultId` varchar(255) DEFAULT NULL,
  `paymentResultStatus` varchar(255) DEFAULT NULL,
  `paymentResultOrderId` varchar(255) DEFAULT NULL,
  `paymentResultPaymentId` varchar(255) DEFAULT NULL,
  `paymentResultRazorpaySignature` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `delivery_boy_id`, `address`, `city`, `pincode`, `order_status`, `coupon_id`, `coupon_value`, `coupon_code`, `total_price`, `net_price`, `paymentResultId`, `paymentResultStatus`, `paymentResultOrderId`, `paymentResultPaymentId`, `paymentResultRazorpaySignature`, `createdAt`, `updatedAt`) VALUES
(1, 1, 2, 'abc road kolkata', 'kolkata', 700000, 4, NULL, NULL, NULL, 500, 500, 'payment-result-id', 'success', 'payment-result-order-id', 'payment-result-payment-id', 'payment-result-razorpay-signature', '2024-10-23 13:51:56', '2024-10-24 04:05:48'),
(6, 3, 3, 'abc road kolkata', 'kolkata', 222222, 4, 1, '500', 'welcome500', 3450, 2950, 'order_PClYkTNSJzgspF', 'success', 'order_PClYkTNSJzgspF', 'pay_PClYs1gYzGmrBt', '84d3b995b7e4277e8c0ad7dc584e69d12172542b5bb662448cfcccd057ad7ba8', '2024-10-24 05:51:36', '2024-10-24 06:11:23'),
(7, 3, 3, 'abc road kolkata', 'kolkata', 222222, 4, NULL, NULL, NULL, 500, 500, 'order_PClagZhPu7f4uv', 'success', 'order_PClagZhPu7f4uv', 'pay_PClaoco4DQm4LN', '3416c68c324d18d5c1cc91b3b00c5cd09a87892118b1d52f6ac408a8c54f784a', '2024-10-24 05:53:26', '2024-10-24 06:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `dish_details_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `dish_details_id`, `price`, `qty`) VALUES
(1, 1, 10, 400, 2),
(2, 1, 15, 100, 2),
(3, 6, 17, 900, 3),
(4, 6, 18, 2400, 4),
(5, 6, 15, 150, 3),
(6, 7, 11, 500, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Pending'),
(2, 'Cooking '),
(3, 'On the Way'),
(4, 'Delivered'),
(5, 'Cancel');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `mobile`, `createdAt`, `updatedAt`) VALUES
(1, 'test user', '$2y$10$ZTdKdqAIpdS0/ngLDRZZOupjgGeJu9wkZ4PPNtAo0pC4CODmJWQam', 'test@user.com', '7777777777', '2024-10-22 13:55:00', '2024-10-22 13:55:00'),
(3, 'sumanta ghosh', '$2y$10$w2GTQ/TpV1X8wKznE6YqheZRLES0PkX6rOgO4OHUcEsK9I8q2Rr36', 'sumanta@ghosh.com', '2222222222', '2024-10-24 04:20:44', '2024-10-24 04:22:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish`
--
ALTER TABLE `dish`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dish_details`
--
ALTER TABLE `dish_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delivery_boy`
--
ALTER TABLE `delivery_boy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dish`
--
ALTER TABLE `dish`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dish_details`
--
ALTER TABLE `dish_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
