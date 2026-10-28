-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2025 at 02:50 PM
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
-- Database: `hotel_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `room_id`, `check_in_date`, `check_out_date`, `status`) VALUES
(3, 2, 2, '2025-07-21', '2025-07-22', 'pending'),
(4, 3, 7, '2025-07-30', '2025-07-31', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status` enum('available','unavailable') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `description`, `price`, `image_path`, `status`) VALUES
(2, 'Standard Room', 'The Standard Room comprises of 1 Double Bed or 2 Twin Beds, 2 Bedside Tables, a Desk & Chair. The room is furnished with wall to wall carpeting, trendy furnishings and a balcony. Our ultramodern glass bathroom is equipped with hairdryer, magnifying shaving and make up mirror as well as all the amenities you could possible need during your stay.\r\nA Complimentary Bottle of Wine, Fresh Fruit and Mineral Water, are provided on arrival. Electric current: 220 Volts. Smoking rooms & inter-connecting rooms are also available.', 2000.00, NULL, 'available'),
(3, 'Deluxe Room', 'An incredible retreat enhanced with ultimate comfort and elegant furnishings, the thoughtfully-designed Deluxe Room delights with a calm space for relaxation. Luxuriously spacious, the room has an atmosphere of contemporary Japanese elegance and is the perfect haven for business travelers or small families, with a choice of one King or twin bed configuration', 5000.00, NULL, 'available'),
(4, 'Grand Deluxe Room', 'Enjoy a well-earned night’s sleep in a Grand Deluxe Room. Spacious and impeccably stylish with a dash of timeless grand dame glamour, cozy up into fine cotton linens, comfy duvet and soft pillows on a king sized bed.\r\n\r\n', 10000.00, NULL, 'available'),
(5, 'Superior Twin Room', 'Perfect for friends or colleagues traveling together, the Superior Twin Room features two comfortable single beds, modern décor, a work desk, and a spacious bathroom. Enjoy complimentary Wi-Fi, a flat-screen TV, and a minibar for your convenience.', 3500.00, NULL, 'available'),
(6, 'Family Suite', 'Designed for families, this spacious suite includes a master bedroom with a queen bed, a separate room with twin beds, and a cozy living area. The Family Suite offers two bathrooms, a kitchenette, and a private balcony with city views.', 7500.00, 'room_6880f895050255.85452566.jpg', 'available'),
(7, 'Penthouse Suite', 'Our most exclusive accommodation, the Penthouse Suite, boasts panoramic views, a private terrace, a luxurious king bedroom, a spacious living room, and a dining area for six. Enjoy a private jacuzzi, 24-hour butler service, and complimentary airport transfers.', 25000.00, 'room_6880f8458d3b89.31264829.jpg', 'available'),
(9, 'Deluxe Ocean View Suite', 'A spacious 45 m² suite with a private balcony overlooking the ocean. Features a king-sized bed with premium linens, a seating area with a sofa, a 55″ smart TV, complimentary high‑speed Wi‑Fi, and a luxurious marble bathroom with a rain shower and soaking tub. Guests also enjoy free breakfast and access to the rooftop infinity pool.', 15500.00, 'room_6880f816e663d7.26197069.jpg', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `remember_token`) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$8B3XFXaT8OEZdQ3I7ruxWuFYWJbavWxgCnrCSqGbHHrtsqNClgM1.', 'admin', '2025-07-20 03:32:37', NULL),
(2, 'testuser', 'user@example.com', '$2y$10$8B3XFXaT8OEZdQ3I7ruxWuFYWJbavWxgCnrCSqGbHHrtsqNClgM1.', 'user', '2025-07-20 09:57:34', NULL),
(3, 'ruz', 'ruz@gmail.com', '$2y$10$E4dqvJh07p3m6maqM3PG7uWpFcUL.wI3Npb84ZJRg/L1GV2JepU.m', 'user', '2025-07-20 10:55:19', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`user_id`),
  ADD KEY `fk_room` (`room_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
