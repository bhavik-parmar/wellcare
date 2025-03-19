-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2025 at 05:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wellcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `reset_token` varchar(255) NOT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `pass`, `reset_token`, `token_expiry`) VALUES
(1, 'bhavik', 'bhavikp12102@gmail.com', '101010', '59d465f0284bb53d0ef1d365ab86e339614c88138f03241e96c9c639c913ad6076b0d6cbf6bf01d3425b043c412c603d4078', '2025-01-29 11:21:22');

-- --------------------------------------------------------

--
-- Table structure for table `appoinment`
--

CREATE TABLE `appoinment` (
  `id` int(11) NOT NULL,
  `doctor_id` int(7) DEFAULT NULL,
  `fname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `date` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `status` enum('Approved','Pending','Cancled','Completed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appoinment`
--

INSERT INTO `appoinment` (`id`, `doctor_id`, `fname`, `email`, `phone`, `date`, `msg`, `status`) VALUES
(1, NULL, 'Bhavik Parmar', 'p369369@gmail.com', '6352930418', '2025/01/13 11:34', 'kjk', 'Pending'),
(2, 1, 'Bhavik Parmar', 'p369369@gmail.com', '6565656565', '2025/01/13 11:34', 'dfdf', 'Pending'),
(3, 1, 'Bhavik Parmar', 'parmar369369@gmail.com', '6352930418', '2025-02-27', '', 'Pending'),
(4, 1, 'nimesh kumar', 'nimesh@gmail.com', '6352930418', '2025/01/10 11:25', '232000', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(7) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reset_token` varchar(255) NOT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `uname`, `email`, `phone`, `speciality`, `pass`, `create_at`, `reset_token`, `token_expiry`) VALUES
(1, 'Dr.Raval', 'bhavikp12102@gmail.com', '6352930415', 'M.D', 'raval00', '2025-02-19 07:13:49', '', NULL),
(2, 'Dr.Maheshwari', 'parmar369369@gmail.com', '8966325142', 'MBBS', 'maheswari00', '2025-02-19 07:13:49', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(100) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `m_manufacturer` varchar(255) NOT NULL,
  `m_expiry` varchar(255) NOT NULL,
  `m_quantity` varchar(255) NOT NULL,
  `m_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `m_name`, `m_manufacturer`, `m_expiry`, `m_quantity`, `m_price`) VALUES
(1, 'paracitamol', 'p-Pharma', '2027-07-01', '222', '12'),
(3, 'lopox', 'p-Pharma', '2025-02-07', '42', '32'),
(4, 'crosin', 'p-Pharma', '2025-02-13', '232', '2');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(100) NOT NULL,
  `p_name` varchar(225) NOT NULL,
  `p_age` int(100) NOT NULL,
  `p_gender` varchar(50) NOT NULL,
  `p_email` varchar(100) NOT NULL,
  `date` varchar(250) NOT NULL,
  `symptoms` text NOT NULL,
  `test` text NOT NULL,
  `m_name` text NOT NULL,
  `m_dosage` text NOT NULL,
  `m_freq` text NOT NULL,
  `m_duration` text NOT NULL,
  `d_notes` text NOT NULL,
  `doctor_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `p_name`, `p_age`, `p_gender`, `p_email`, `date`, `symptoms`, `test`, `m_name`, `m_dosage`, `m_freq`, `m_duration`, `d_notes`, `doctor_name`) VALUES
(1, 'bhavik', 25, 'male', 'parmar369369@gmail.com', '2025-01-29', 'fever ', 'Blood Test', 'peracitamol,crocin', '2,6', '20,20', '2 days,2 days', 'need rest eat haldy food', ''),
(2, 'eeeee', 25, 'male', '', '2025-01-16', 'hhhhhhhhhhhhh', 'Sonography', 'peracitamol', '2', '.5', '2 daysh', 'hhhhhhhhhh', ''),
(3, 'Bhavik Parmar', 22, '', '', '2025-01-15', 'cvvc', 'Blood Test', 'cxvcxv,dfdfd', '2,6', '5,.20', '2 days,4', 'vfffdgdhncvccnccncncncncncnnnncnn', ''),
(4, 'Bhavik Parmar', 22, '', '', '2025-01-15', 'cvvc', 'Blood Test', 'cxvcxv,dfdfd', '2,6', '5,.20', '2 days,4', 'vfffdgdhncvccnccncncncncncnnnncnn', ''),
(5, 'Bhavik Parmar', 22, '', '', '2025-01-15', 'cvvc', 'Blood Test', 'cxvcxv,dfdfd', '2,6', '5,.20', '2 days,4', 'vfffdgdhncvccnccncncncncncnnnncnn', ''),
(6, 'Bhavik Parmar', 55, '', '', '2025-02-23', 'sedsdfsdf', 'X-ray', 'sdfsdf', '55', '45', '2 days', 'sdffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', ''),
(7, 'Bhavik Parmar', 22, '', '', '2025-02-11', 'dgdfgdfgdfg', 'X-ray', 'ggg,wes,dsfsdf', '5,asdasd,44', '9,.20,44', '11,2 days,4', 'fffffffffffffffffffffff', ''),
(8, 'Bhavik Parmar', 25, 'female', '', '2025-02-11', 'sssssssssssssssssssssssssssss', 'Blood Test', 'peracitamol', '2', '20', '2 days', 'ssaaasccc', ''),
(9, 'Bhavik Parmar', 25, 'female', '', '2025-02-11', 'sssssssssssssssssssssssssssss', 'Blood Test', 'peracitamol,fcvb,dsfsdf', '2,6,44', '20,.20,44', '2 days,2 days,4', 'ssaaasccc', ''),
(10, 'shreeman parekh', 22, 'male', '', '2025-02-19', 'bvvjhvb nbbjbmjbmnmnmnbmnbmnbmnb bnmbmnbmnbnmnbmnbnmbmn', '', '1,2', '2,6', '.5,.20', '2 days,2 days', 'ret', ''),
(11, 'shreeman parekh', 22, 'male', '', '2025-02-19', 'bvvjhvb nbbjbmjbmnmnmnbmnbmnbmnb bnmbmnbmnbnmnbmnbnmbmn', '', '1,2', '2,6', '.5,.20', '2 days,2 days', 'ret', ''),
(12, 'shreeman parekh', 25, 'male', '', '2025-02-20', 'kjbbj', '', 'paracitamol', '2', '.5', '2 days', 'ouul', ''),
(13, 'shreeman parekh', 22, 'female', '', '2025-02-20', 'dcxczxc', '', 'paracitamol', 'adasd', '20', '2 days', 'xzczxc', ''),
(14, 'shreeman parekh', 22, 'female', '', '2025-02-20', 'dcxczxc', '', 'paracitamol', 'adasd', '20', '2 days', 'xzczxc', ''),
(15, 'shreeman parekh', 25, 'female', '', '2025-02-20', 'dsfsdf', '', 'crosin', '2', '20', '2 daysh', 'dssssssssssssssssssssssssss', ''),
(16, 'shreeman parekh', 25, '', '', '2025-02-13', 'szxx', '', 'paracitamol', '2', '20', '2 days', 'xzxz', ''),
(17, 'shreeman parekh', 22, 'male', '', '2025-02-06', 'sdfd', '', 'paracitamol', '2', '.5', '2 days', 'dwdsdsd', ''),
(18, 'shreeman parekh', 22, 'male', '', '2025-02-27', 'ddd', '', 'paracitamol', '2', '20', '2 days', '2eesd', 'Dr.Raval'),
(19, 'Bhavik Parmar', 25, 'other', '0', '2025-02-14', 'rota', '', 'paracitamol', '2', '20', '2 days', 'eedsd', 'Dr.Raval'),
(20, 'Bhavik Parmar', 25, 'other', 'parmar369369@gmail.com', '2025-02-14', 'rota', '', 'paracitamol', '2', '20', '2 days', 'eedsd', 'Dr.Raval');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `fname` varchar(225) NOT NULL,
  `lname` varchar(225) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `dob` varchar(225) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `fname`, `lname`, `gender`, `dob`, `email`, `pass`) VALUES
(1, 'Bhavik', 'Parmar', 'male', '2025-01-01', 'parmar369369@gmail.com', '1234'),
(2, 'Bhavik', 'Parmar', 'male', '2025-01-02', 'p369369@gmail.com', '1010');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `appoinment`
--
ALTER TABLE `appoinment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appoinment`
--
ALTER TABLE `appoinment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appoinment`
--
ALTER TABLE `appoinment`
  ADD CONSTRAINT `appoinment_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
