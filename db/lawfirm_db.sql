-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2023 at 10:45 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lawfirm_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `awards` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`, `awards`, `created_date`) VALUES
(1, 'juan', 2, '2023-06-13 17:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `publish` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `author_id`, `name`, `publish`) VALUES
(1, 1, 'sample', 'sample');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_case_list`
--

CREATE TABLE `tbl_case_list` (
  `id` int(11) NOT NULL,
  `case_number` varchar(1000) NOT NULL,
  `client_user_id` int(11) NOT NULL,
  `case_type` varchar(100) NOT NULL,
  `case_sub_type` varchar(100) NOT NULL,
  `lawyer_user_id` int(11) NOT NULL,
  `client_type` varchar(100) NOT NULL,
  `case_status` varchar(100) NOT NULL,
  `case_details` varchar(1000) NOT NULL,
  `remarks` varchar(1000) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `task` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_case_list`
--

INSERT INTO `tbl_case_list` (`id`, `case_number`, `client_user_id`, `case_type`, `case_sub_type`, `lawyer_user_id`, `client_type`, `case_status`, `case_details`, `remarks`, `start_date`, `end_date`, `task`) VALUES
(24, 'CN-64881402', 101, 'Corporate', 'Criminal', 45, 'Petitioner', 'Ongoing', '', 'Sample', NULL, NULL, ''),
(43, 'CN-64832872', 99, 'Corporate', 'Family', 0, '', 'Ongoing', '', '', NULL, NULL, ''),
(44, 'CN-64834497', 98, 'Case Type', 'Case Sub type', 0, '', '', '', '', '2023-06-09 00:00:00', '2023-06-29 00:00:00', ''),
(45, 'CN-64835393', 98, 'Case Type', 'Case Sub type', 0, '', '', '', '', NULL, NULL, ''),
(47, 'CN-64830140', 99, 'Litigation', 'Criminal', 0, 'Petitioner', '', '', '', NULL, NULL, ''),
(49, 'CN-64833350', 98, 'Corporate', 'Family', 44, 'Petitioner', '', '', '', NULL, NULL, ''),
(50, 'CN-64836014', 99, 'Corporate', 'Criminal', 44, 'Petitioner', '', '', '', NULL, NULL, ''),
(57, 'CN-64915624', 98, 'Litigation', 'Family', 47, 'Petitioner', '', '', '', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_list`
--

CREATE TABLE `tbl_client_list` (
  `id` int(11) NOT NULL,
  `client_id` varchar(1000) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `first_email` varchar(100) NOT NULL,
  `second_email` varchar(100) NOT NULL,
  `first_contact` varchar(100) NOT NULL,
  `second_contact` varchar(100) NOT NULL,
  `first_address` varchar(200) NOT NULL,
  `second_address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_client_list`
--

INSERT INTO `tbl_client_list` (`id`, `client_id`, `lastname`, `firstname`, `middlename`, `gender`, `first_email`, `second_email`, `first_contact`, `second_contact`, `first_address`, `second_address`) VALUES
(98, '2023-64829329', 'Nicolasss', 'Reyes', 'John', 'Male', 'Nicolas@gmail.com', '', '0987654322', '', 'Purok 1 Cupang Muntilupa', ''),
(99, '2023-64829562', 'DelaCruss', 'Joaquins', 'Reyes', 'Male', 'Joaquin@mail.com', '', '0999998861', '', 'Alabang Montillano', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_entity_list`
--

CREATE TABLE `tbl_entity_list` (
  `id` int(11) NOT NULL,
  `case_id` varchar(1000) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_address` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `first_email` varchar(100) NOT NULL,
  `second_email` varchar(100) NOT NULL,
  `first_contact` varchar(100) NOT NULL,
  `second_contact` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_entity_list`
--

INSERT INTO `tbl_entity_list` (`id`, `case_id`, `company_name`, `company_address`, `firstname`, `middlename`, `lastname`, `first_email`, `second_email`, `first_contact`, `second_contact`) VALUES
(21, '2023-64813497', 'Sample', 'samples', 'samples', 'sample', 'Ss', 'samps@gmail.com', '', '09876564321', ''),
(28, '2023-64817449', 'samplesss', 'Ssample', 'Sample', 'S', 'S', 'ss@gmail.coms', '', '0998765654431', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_list`
--

CREATE TABLE `tbl_task_list` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `lawyer_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `task_description` varchar(255) NOT NULL,
  `case_number` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `priority` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_task_list`
--

INSERT INTO `tbl_task_list` (`id`, `client_id`, `lawyer_id`, `task_id`, `task_description`, `case_number`, `remarks`, `priority`, `status`, `start_date`, `end_date`) VALUES
(3, 0, 0, 0, '', 'CN-64832872', 'sample', 'High', 'On-going', '2023-06-21', '2023-06-21'),
(7, 0, 0, 0, '', 'CN-64832872', 'sample', 'High', 'On-going', '2023-06-22', '2023-06-22'),
(8, 0, 0, 0, '', 'CN-64830140', 'Sample Only', 'Medium', 'On-going', '2023-06-22', '2023-06-23'),
(9, 0, 0, 0, '', 'CN-64833350', 'sample', 'High', 'On-going', '2023-06-22', '2023-06-22'),
(10, 0, 0, 0, 'For Filling Of cases', 'CN-64836014', 'Need To File Immediately', 'High', 'On-going', '2023-06-23', '2023-06-23'),
(11, 0, 0, 0, 'Sampe Only', 'CN-64915624', 'Filling', 'Medium', 'On-going', '2023-06-22', '2023-06-23'),
(12, 0, 0, 0, 'sample', 'CN-64836014', 'sample', 'Medium', 'On-going', '2023-06-23', '2023-06-24'),
(13, 0, 0, 0, 'try', 'CN-64836014', 'tryt', 'Medium', 'On-going', '2023-06-23', '2023-06-23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_list`
--

CREATE TABLE `tbl_user_list` (
  `id` int(11) NOT NULL,
  `user_fullname` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(10000) NOT NULL,
  `user_role` varchar(100) NOT NULL,
  `user_access` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_list`
--

INSERT INTO `tbl_user_list` (`id`, `user_fullname`, `user_email`, `user_password`, `user_role`, `user_access`) VALUES
(44, 'Jacinto  Jeromes', 'jerome@gmail.com', '$2y$10$M1.KXV.GssxgJ8ncQCnFCedET0hINVCC3jdK.nZjvx6qgVycOaFOK', 'Associate Lawyer', 'Create Read Update Delete '),
(45, 'Nicolas John  Sajots', 'sample@mail.com', '$2y$10$tyfbsWXvOwvYrLI7lqCDRuIC.c2e52t5/o3NAhT5uZppJ7rDcBUoy', 'Chief Lawyer', 'Create Read Update Delete '),
(47, 'admin  admin', 'admin@admin.com', '$2y$10$tyfbsWXvOwvYrLI7lqCDRuIC.c2e52t5/o3NAhT5uZppJ7rDcBUoy', 'Chief Lawyer', 'Create Read Update Delete '),
(50, 'Juan Dela Cruz', 'sample@gmail.com', '$2y$10$7tOh3SkgbncJt4gpVgaWCejmjAWcvvZiPTP5OKeZ5YFjTrjGPZbYW', 'Chief Lawyer', 'Create Read Update Delete '),
(51, 'Cardo dalisays', 'Dalisay@gmail.com', '$2y$10$ZfGPLamui96g.VM1430jOucja5LAhYdWON2ElXx7iUW6jgqTJ6Uum', 'Chief Lawyer', 'Create Read Update'),
(52, 'admin  admin', 'admin@mail.com', '$2y$10$vCRpHZj1tJnACpDRHxBWpOlEmM8nxYnzBt7a3pFu4ZOPmT9I8Pmni', 'Admin', 'Create Read Update Delete ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_case_list`
--
ALTER TABLE `tbl_case_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_client_list`
--
ALTER TABLE `tbl_client_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_entity_list`
--
ALTER TABLE `tbl_entity_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_task_list`
--
ALTER TABLE `tbl_task_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_list`
--
ALTER TABLE `tbl_user_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_case_list`
--
ALTER TABLE `tbl_case_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_client_list`
--
ALTER TABLE `tbl_client_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tbl_entity_list`
--
ALTER TABLE `tbl_entity_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_task_list`
--
ALTER TABLE `tbl_task_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_user_list`
--
ALTER TABLE `tbl_user_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
