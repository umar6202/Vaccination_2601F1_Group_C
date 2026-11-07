-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2026 at 01:27 PM
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
-- Database: `evaccination_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_messages`
--

CREATE TABLE `admin_messages` (
  `id` int(11) NOT NULL,
  `sender_name` varchar(100) NOT NULL,
  `sender_email` varchar(100) NOT NULL,
  `sender_role` enum('admin','parent','hospital') NOT NULL,
  `sender_message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `vaccine_name` varchar(100) NOT NULL,
  `appointment_date` date NOT NULL,
  `status` enum('Pending','Approved','Rejected','Completed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `parent_id`, `child_id`, `hospital_id`, `vaccine_name`, `appointment_date`, `status`) VALUES
(1, 2, 1, 1, 'Typhoid & Polio Booster', '2026-11-05', 'Pending'),
(2, 2, 2, 1, 'Tetanus Toxoid (TT)', '2026-11-06', 'Approved'),
(3, 3, 3, 2, 'Typhoid & Polio Booster', '2026-11-10', 'Pending'),
(4, 3, 4, 2, 'Hepatitis B Booster', '2026-11-12', 'Approved'),
(5, 4, 5, 3, 'Measles & Rubella', '2026-11-15', 'Pending'),
(6, 4, 6, 3, 'Typhoid & Polio Booster', '2026-11-18', 'Approved'),
(7, 5, 7, 4, 'Tetanus Toxoid (TT)', '2026-11-20', 'Pending'),
(8, 5, 8, 4, 'Hepatitis B Booster', '2026-11-22', 'Rejected'),
(9, 6, 9, 5, 'Typhoid & Polio Booster', '2026-11-25', 'Approved'),
(10, 6, 10, 5, 'Measles & Rubella', '2026-11-28', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `children`
--

CREATE TABLE `children` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `child_name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `grade` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `children`
--

INSERT INTO `children` (`id`, `parent_id`, `child_name`, `age`, `gender`, `grade`) VALUES
(1, 2, 'Hassan Ali Khan', 10, 'Male', '5th Grade'),
(2, 2, 'Fatima Ali Khan', 8, 'Female', '3rd Grade'),
(3, 3, 'Zainab Malik', 12, 'Female', '7th Grade'),
(4, 3, 'Umer Malik', 9, 'Male', '4th Grade'),
(5, 4, 'Ibrahim Ahmed', 11, 'Male', '6th Grade'),
(6, 4, 'Ayesha Ahmed', 7, 'Female', '2nd Grade'),
(7, 5, 'Bilal Noor', 14, 'Male', '9th Grade'),
(8, 5, 'Maryam Noor', 10, 'Female', '5th Grade'),
(9, 6, 'Hamza Bibi', 13, 'Male', '8th Grade'),
(10, 6, 'Khadija Bibi', 6, 'Female', '1st Grade'),
(11, 2, 'Ali Jr.', 3, 'Male', 'Nursery'),
(12, 2, 'Alina Ali', 1, 'Female', 'Infant'),
(13, 3, 'Ahmed Malik', 4, 'Male', 'Preschool'),
(14, 3, 'Areeba Malik', 2, 'Female', 'Toddler'),
(15, 4, 'Zayan Ahmed', 5, 'Male', 'Grade 1'),
(16, 4, 'Zohra Ahmed', 2, 'Female', 'Toddler'),
(17, 5, 'Hassan Noor', 3, 'Male', 'Nursery'),
(18, 5, 'Hira Noor', 1, 'Female', 'Infant'),
(19, 6, 'Ibrahim Bibi', 4, 'Male', 'Preschool'),
(20, 6, 'Inaya Bibi', 2, 'Female', 'Toddler');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hospital_name` varchar(150) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `user_id`, `hospital_name`, `address`, `contact_number`) VALUES
(1, 7, 'City Children Hospital', 'Main Rashid Minhas Road, Gulshan, Karachi', '021-111-222-333'),
(2, 8, 'Aga Khan Health Centre', 'Stadium Road, Karachi', '021-333-444-555'),
(3, 9, 'National Medical Centre', 'NMC Complex, Korangi Road, Karachi', '021-555-666-777'),
(4, 10, 'Indus Hospital', 'Crossing Near Korangi, Karachi', '021-777-888-999'),
(5, 11, 'Liaquat National Hospital', 'Stadium Road, Karachi', '021-999-000-111');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_requests`
--

CREATE TABLE `hospital_requests` (
  `id` int(11) NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `hospital_email` varchar(255) NOT NULL,
  `hospital_location` varchar(255) NOT NULL,
  `hospital_phone` varchar(50) NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','parent','hospital') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'System Administrator', 'admin@evaccination.com', 'admin123', 'admin'),
(2, 'Ali Khan', 'ali.parent@gmail.com', 'parent123', 'parent'),
(3, 'Ayesha Malik', 'ayesha.parent@gmail.com', 'parent123', 'parent'),
(4, 'Muhammad Ahmed', 'ahmed.parent@gmail.com', 'parent123', 'parent'),
(5, 'Fatima Noor', 'fatima.parent@gmail.com', 'parent123', 'parent'),
(6, 'Zainab Bibi', 'zainab.parent@gmail.com', 'parent123', 'parent'),
(7, 'City Children Hospital', 'cityhospital@gmail.com', 'hosp123', 'hospital'),
(8, 'Aga Khan Health Centre', 'agakhan@gmail.com', 'hosp123', 'hospital'),
(9, 'National Medical Centre', 'nmc@gmail.com', 'hosp123', 'hospital'),
(10, 'Indus Hospital', 'indus@gmail.com', 'hosp123', 'hospital'),
(11, 'Liaquat National Hospital', 'liaquat@gmail.com', 'hosp123', 'hospital');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_messages`
--
ALTER TABLE `admin_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `child_id` (`child_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `children`
--
ALTER TABLE `children`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `hospital_requests`
--
ALTER TABLE `hospital_requests`
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
-- AUTO_INCREMENT for table `admin_messages`
--
ALTER TABLE `admin_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `children`
--
ALTER TABLE `children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hospital_requests`
--
ALTER TABLE `hospital_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`child_id`) REFERENCES `children` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `children`
--
ALTER TABLE `children`
  ADD CONSTRAINT `children_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD CONSTRAINT `hospitals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
