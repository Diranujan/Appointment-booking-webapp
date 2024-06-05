-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 06:30 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tempdb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteOldStaffAvailableTime` ()   BEGIN
    DELETE FROM staff_available_time WHERE available_date < CURDATE();
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `coordinator` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `HOD` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `HOD`, `faculty_id`, `created_at`, `updated_at`) VALUES
(1, 'Department of Bio-science', 3, 1, '2024-01-05 06:42:39', '2024-01-05 06:42:39'),
(2, 'Department of Physical science', 3, 1, '2024-01-05 06:43:00', '2024-01-05 06:43:00'),
(3, 'Business Economics', 3, 2, '2024-01-05 06:43:26', '2024-01-05 06:43:26'),
(4, 'English Language Teaching', 3, 2, '2024-01-05 06:43:49', '2024-01-05 06:43:49'),
(5, 'Finance And Accountancy', 3, 2, '2024-01-05 06:44:07', '2024-01-05 06:44:07'),
(6, 'Human Resource Management', 3, 2, '2024-01-05 06:44:25', '2024-01-05 06:44:25'),
(7, 'Marketing Management', 3, 2, '2024-01-05 06:44:54', '2024-01-05 06:44:54'),
(8, 'Project Management', 3, 2, '2024-01-05 06:45:09', '2024-01-05 06:45:09'),
(9, 'Department of ICT', 3, 3, '2024-01-05 06:45:48', '2024-01-05 06:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dean` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`, `dean`, `created_at`, `updated_at`) VALUES
(1, 'Faculty of Applied Science', 1, '2024-01-05 06:38:13', '2024-01-05 06:38:13'),
(2, 'Faculty of Business Studies', 2, '2024-01-05 06:38:42', '2024-01-05 06:38:42'),
(3, 'Faculty of Technological Studies', 4, '2024-01-05 06:41:32', '2024-01-05 06:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `id` int(11) NOT NULL,
  `heading` varchar(100) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `outline` text NOT NULL,
  `pref_date` date NOT NULL,
  `pref_time` time NOT NULL,
  `status` varchar(100) NOT NULL,
  `reject_reason` text DEFAULT NULL,
  `additional_information` varchar(200) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `file_data` mediumblob DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`id`, `heading`, `purpose`, `outline`, `pref_date`, `pref_time`, `status`, `reject_reason`, `additional_information`, `filename`, `file_data`, `updated_at`, `created_at`) VALUES
(1, 'Approval for Registration', 'Get signature', 'I am Kapitharan (2019/AP/045). I prefer to enroll the \"Advance SQL Database System\" course which is offered by your department. ', '2024-01-06', '08:00:00', 'Approved', '', '', NULL, NULL, '2024-01-06 15:46:18', '2024-01-05 07:28:05'),
(3, 'Approval for Registration', 'Get signature', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2024-01-25', '10:00:00', 'Approved', '', 'lorelias perspiciatis fugiat laborum aperiam distinctio, sequi tempore nemo quas asperiores sapiente minus!', NULL, NULL, '2024-01-09 17:25:50', '2024-01-05 17:57:48'),
(15, 'finding the meeting id', 'finding the last input id', 'ettwwe', '2024-01-09', '10:30:00', 'Approved', '', '', NULL, NULL, '2024-01-08 03:50:04', '2024-01-08 03:49:23'),
(16, 'check the meeting', 'diamond', 'let me explain', '2024-01-08', '14:30:00', 'Pending Approval', NULL, '', NULL, NULL, '2024-01-08 11:27:03', '2024-01-08 11:27:03'),
(17, 'next meeting', 'buy a car', ' nothing to tell', '2024-01-08', '11:30:00', 'Rejected', '', '', NULL, NULL, '2024-01-09 15:16:54', '2024-01-08 11:28:48'),
(18, 'conversation about hostel', 'we are looking for hostel', 'hi sir,\r\nwe are 3rd year students', '2024-01-08', '14:30:00', 'Pending Approval', NULL, '', NULL, NULL, '2024-01-09 15:04:59', '2024-01-09 15:04:59'),
(19, 'conversation about hostel', 'we are looking for hostel', 'hi sir, we are looking for hostel facilities', '2024-01-09', '12:30:00', 'Approved', '', '', NULL, NULL, '2024-01-09 15:11:20', '2024-01-09 15:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `professions`
--

CREATE TABLE `professions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `professions`
--

INSERT INTO `professions` (`id`, `name`) VALUES
(0, 'SUPER ADMIN'),
(1, 'Dean'),
(2, 'HOD'),
(3, 'Coordinator'),
(4, 'Professor'),
(5, 'Lecturer'),
(6, 'Instructor'),
(7, 'Demo'),
(8, 'Vice-Chancellor'),
(9, 'Registrar'),
(10, 'Bursar'),
(11, 'Senior Assistant Librarian');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `profession_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `faculty_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `first_name`, `last_name`, `email`, `contact_email`, `password`, `gender`, `phone_number`, `department_id`, `profession_id`, `created_at`, `updated_at`, `faculty_id`) VALUES
(0, 'Super', 'Admin', 'admin@gmail.com', 'admin@gmail.com', '$2y$10$HvGZ5KH.BKMUNxFyMJ5dxOAvNAmidA64Cv4R2rinZGWiQGOQNDcF.', NULL, '0777123456', NULL, 0, '2023-12-27 10:02:51', '2024-01-05 03:49:02', NULL),
(1, 'Ms.Nimalan', 'J', 'dean@fas.lk', 'deanfas@vau.ac.lk', '$2y$10$sTEHNYCqnnYEb4u9RvQkDuoCR9cdW4R8qKsJMqN1LJQNR7Lmps7Zm', 'female', '0242220179', 0, 1, '2024-01-05 06:17:11', '2024-01-08 13:14:55', 1),
(2, 'Mr.Nanthagopan', 'Y', 'dean@fbs.lk', '', '$2y$10$vLYaMjMSNmAyZUvSRd4Q3u9KuXfFcIc5O5bKjdzi3GOsh1KfxY4ze', 'male', '0242228231', 0, 1, '2024-01-05 06:18:34', '2024-01-08 13:16:39', 2),
(3, 'Mr.Vinoharan', 'V', 'head.ict@fts.lk', 'headdict@vau.ac.lk', '$2y$10$sTEHNYCqnnYEb4u9RvQkDuoCR9cdW4R8qKsJMqN1LJQNR7Lmps7Zm', 'male', '0242228240', 9, 2, '2024-01-05 06:19:29', '2024-01-08 14:00:02', 3),
(4, 'Mr.Senthooran', 'V', 'dean@fts.lk', 'deanfts@vau.ac.lk', '$2y$10$jOP4lRSXGDWA99t5xp1KJeVUl2a9Ukv.yI3ZssgnhMcf4ijJ4q.QK', 'male', '0242228240', 0, 1, '2024-01-05 06:20:44', '2024-01-08 13:45:20', 3),
(5, 'Mahalingam', 'Prasanna', 'head.phy@fas.lk', 'headphy2vau.ac.lk', '$2y$10$sTEHNYCqnnYEb4u9RvQkDuoCR9cdW4R8qKsJMqN1LJQNR7Lmps7Zm', 'male', '0242220269', 0, 2, '2024-01-05 06:23:18', '2024-01-08 13:57:07', 0),
(6, 'Aarumugam', 'Kanesharaja', 'head.bio@fas.lk', '', '$2y$10$sTEHNYCqnnYEb4u9RvQkDuoCR9cdW4R8qKsJMqN1LJQNR7Lmps7Zm', 'male', '0777123456', 0, 2, '2024-01-05 06:33:13', '2024-01-08 13:57:33', 0),
(7, 'Shanmugam', 'Priyatharshan', 'head.be@fbs.lk', '', '$2y$10$sTEHNYCqnnYEb4u9RvQkDuoCR9cdW4R8qKsJMqN1LJQNR7Lmps7Zm', 'male', '0777123456', 0, 6, '2024-01-05 06:35:36', '2024-01-08 13:52:20', 0),
(9, 'Mangaleswaran', 'Thampoe', 'vc@vau.lk', 'vc@vau.ac.lk', '$2y$10$aZ038RpYxap6Em/pzZzK6u7UTyLgWhY8ceLZWhV3xx3EYqHYdf7mu', 'male', '0242222264', 0, 8, '2024-01-08 13:04:04', '2024-01-08 13:52:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_available_time`
--

CREATE TABLE `staff_available_time` (
  `staff_id` int(11) NOT NULL,
  `available_date` date NOT NULL,
  `time_0830` tinyint(1) DEFAULT NULL,
  `time_0930` tinyint(1) DEFAULT NULL,
  `time_1030` tinyint(1) DEFAULT NULL,
  `time_1130` tinyint(1) DEFAULT NULL,
  `time_1230` tinyint(1) DEFAULT NULL,
  `time_1330` tinyint(1) DEFAULT NULL,
  `time_1430` tinyint(1) DEFAULT NULL,
  `time_1530` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff_available_time`
--

INSERT INTO `staff_available_time` (`staff_id`, `available_date`, `time_0830`, `time_0930`, `time_1030`, `time_1130`, `time_1230`, `time_1330`, `time_1430`, `time_1530`) VALUES
(3, '2024-01-09', 1, 0, 1, 0, 1, 0, 1, 0),
(4, '2024-01-09', 1, 0, 0, 0, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `reg_num` varchar(50) NOT NULL,
  `year_of_study` int(4) DEFAULT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `contact_email` varchar(255) DEFAULT NULL,
  `verify_token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `email`, `password`, `gender`, `date_of_birth`, `phone_number`, `reg_num`, `year_of_study`, `faculty_id`, `department_id`, `status`, `created_at`, `updated_at`, `contact_email`, `verify_token`) VALUES
(1, 'Diranujan', 'Jeyajothirasa', 'diranu2000@gmail.com', '$2y$10$sTEHNYCqnnYEb4u9RvQkDuoCR9cdW4R8qKsJMqN1LJQNR7Lmps7Zm', 'male', '2000-05-11', '0777123456', '2019AP125', 3, 1, 2, 'ACTIVE', '2024-01-05 07:09:42', '2024-01-08 16:27:50', 'dinu@gmail.com', ''),
(2, 'Kabil', 'Praba', 'kapi@gmail.com', '$2y$10$GPGLCVSabCZdj9utjZSkB.j0tC710o8mzGZiUDiB3OvPG78jW3MxC', 'male', '2024-01-27', '0777123456', '2019AP045', 3, 1, 1, 'ACTIVE', '2024-01-05 07:10:46', '2024-01-09 17:09:48', 'kapi@gmail.com', ''),
(3, 'diranujan', 'jeyajothirasa', 'diranujan2000@gmail.com', '$2y$10$eBUBP5IOLimFVt5oTylUgeAVRthUfFPD.EGs41SA/aueNJv7WTkZu', 'male', '2000-05-11', '0775010056', '2019/ASP/88', 3, 1, 2, 'ACTIVE', '2024-01-07 13:08:55', '2024-01-09 17:09:04', 'diranujan2000@gmail.com', ''),
(4, 'sanjeevkanth', 'rasikumar', 'sanjeev2019@gmail.com', '$2y$10$5EfhDxlNy2b7ScSPXd8ZCOBbY1n9ufgepB/Y6H.mKtfCz/DRswxmG', 'male', '1999-01-07', '0785614345', '2019/ASP/72', 3, 1, 2, 'ACTIVE', '2024-01-08 03:44:05', '2024-01-08 03:49:23', 'sanjeev2019@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_meetings`
--

CREATE TABLE `user_meetings` (
  `id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_meetings`
--

INSERT INTO `user_meetings` (`id`, `meeting_id`, `student_id`, `staff_id`) VALUES
(1, 1, 2, 2),
(2, 2, 1, 3),
(3, 3, 1, 4),
(12, 12, 1, 3),
(13, 13, 1, 3),
(14, 14, 3, 4),
(15, 15, 4, 3),
(16, 16, 1, 3),
(17, 17, 1, 4),
(18, 18, 3, 3),
(19, 19, 3, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dept_course` (`department_id`),
  ADD KEY `fk_coordinator` (`coordinator`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fac_dept` (`faculty_id`),
  ADD KEY `fk_hod` (`HOD`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_faculty_name` (`name`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professions`
--
ALTER TABLE `professions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`) USING BTREE,
  ADD KEY `fk_profession` (`profession_id`),
  ADD KEY `fk_faculty` (`faculty_id`) USING BTREE,
  ADD KEY `fk_department` (`department_id`);

--
-- Indexes for table `staff_available_time`
--
ALTER TABLE `staff_available_time`
  ADD PRIMARY KEY (`staff_id`,`available_date`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `reg_num` (`reg_num`),
  ADD KEY `fk_faculty` (`faculty_id`),
  ADD KEY `fk_dept_student` (`department_id`);

--
-- Indexes for table `user_meetings`
--
ALTER TABLE `user_meetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_meeting` (`meeting_id`),
  ADD KEY `fk_student` (`student_id`),
  ADD KEY `fk_staff` (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `professions`
--
ALTER TABLE `professions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_meetings`
--
ALTER TABLE `user_meetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_coordinator` FOREIGN KEY (`coordinator`) REFERENCES `staffs` (`id`),
  ADD CONSTRAINT `fk_dept_course` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `fk_fac_dept` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`),
  ADD CONSTRAINT `fk_hod` FOREIGN KEY (`HOD`) REFERENCES `staffs` (`id`);

--
-- Constraints for table `staffs`
--
ALTER TABLE `staffs`
  ADD CONSTRAINT `fk_profession` FOREIGN KEY (`profession_id`) REFERENCES `professions` (`id`);

--
-- Constraints for table `staff_available_time`
--
ALTER TABLE `staff_available_time`
  ADD CONSTRAINT `fk_staff_id` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_dept_student` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `fk_faculty` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`);

--
-- Constraints for table `user_meetings`
--
ALTER TABLE `user_meetings`
  ADD CONSTRAINT `fk_meeting` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`),
  ADD CONSTRAINT `fk_staff` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`),
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `delete_old_records` ON SCHEDULE EVERY 1 DAY STARTS '2024-01-05 16:40:33' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    DELETE FROM staff_available_time WHERE available_date < CURDATE();
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
