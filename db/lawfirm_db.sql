-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2023 at 10:21 AM
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
-- Stand-in structure for view `case_list_view`
-- (See below for the actual view)
--
CREATE TABLE `case_list_view` (
);

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
  `remarks` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_case_list`
--

INSERT INTO `tbl_case_list` (`id`, `case_number`, `client_user_id`, `case_type`, `case_sub_type`, `lawyer_user_id`, `client_type`, `case_status`, `case_details`, `remarks`) VALUES
(6, 'CN-64813311', 98, 'Corporate', 'Family', 48, 'Petitioner', '', '', ''),
(7, 'CN-64815628', 79, 'Special Project', 'Labor', 0, 'Respondents', '', '', ''),
(8, 'CN-64827881', 79, 'Corporate', 'Labor', 0, 'Petitioner', '', '', ''),
(9, 'CN-64829027', 98, 'Corporate', 'Criminal', 47, 'Petitioner', '', '', 'ss'),
(10, 'CN-64829063', 98, 'Corporate', 'Labor', 45, 'Petitioner', '', '', ''),
(11, 'CN-64829517', 99, 'Corporate', 'Labor', 48, 'Respondents', '', '', ''),
(12, 'CN-64823776', 100, 'Corporate', 'Criminal', 47, 'Petitioner', '', '', 'Sample Remarks'),
(13, 'CN-64821911', 99, 'Special Project', 'Criminal', 44, 'Petitioner', '', '', 'Sample'),
(14, 'CN-64821898', 99, 'Special Project', 'Criminal', 47, 'Petitioner', '', '', 'sample'),
(15, 'CN-64820049', 99, 'Litigation', 'Criminal', 45, 'Petitioner', '', '', 'SAMPLE');

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
(98, '2023-64829329', 'Nicolas', 'Reyes', 'John', '0', 'Nicolas@gmail.com', '', '09999988', '', 'Purok 1 Cupang Muntilupa', ''),
(99, '2023-64829562', 'Dela Crus', 'Joaquin', 'Reyes', '0', 'Joaquin@mail.com', '', '099999888', '', 'Alabang Montillano', ''),
(101, '2023-64825972', 'Sample', 'Sample', 'Sple', 'Male', 's@mail.com', '', '09999', '', 'Purok 1 Cupang', '');

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
(18, '2023-648274', 'Jollibee Corporation', 'Alabang Motillano', 'Pia', 'Sachez', 'Reyes', 'Jollibey@mail.com', '', '0987654321', '');

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
(44, 'Jacinto  Jerome', 'jerome@gmail.com', '$2y$10$M1.KXV.GssxgJ8ncQCnFCedET0hINVCC3jdK.nZjvx6qgVycOaFOK', 'Chief Lawyer', 'Create Read Update Delete '),
(45, 'Nicolas John  Sajot', 'nic@yahoo.com', '$2y$10$l6/G3H4ycw/E8LFGgFxOR.5NVXPc6zxsXSwKgeByP4WwOtl0CjlZK', 'Chief Lawyer', 'Create Read Update Delete '),
(47, 'admin  admin', 'admin@admin.com', '$2y$10$tyfbsWXvOwvYrLI7lqCDRuIC.c2e52t5/o3NAhT5uZppJ7rDcBUoy', 'Chief Lawyer', 'Create Read Update Delete '),
(48, 'Pedro  Dela juan', 'pedro@yahoo.com', '$2y$10$OIz3ian2/Y0BPxZDl70J0.O.Iu32Q9uaFU318mOHVYzy0Oj/bwnvK', 'Chief Lawyer', 'Create Read Update Delete ');

-- --------------------------------------------------------

--
-- Structure for view `case_list_view`
--
DROP TABLE IF EXISTS `case_list_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `case_list_view`  AS SELECT `tbl_client_list`.`firstname` AS `firstname`, `tbl_user_list`.`user_fullname` AS `user_fullname` FROM ((`tbl_case_list` join `tbl_client_list` on(`tbl_case_list`.`client_user_id` = `tbl_client_list`.`id`)) join `tbl_user_list` on(`tbl_case_list`.`user_user_id` = `tbl_user_list`.`id`)) ;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `tbl_user_list`
--
ALTER TABLE `tbl_user_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_case_list`
--
ALTER TABLE `tbl_case_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_client_list`
--
ALTER TABLE `tbl_client_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `tbl_entity_list`
--
ALTER TABLE `tbl_entity_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_user_list`
--
ALTER TABLE `tbl_user_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
