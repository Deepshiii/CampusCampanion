-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 03:17 PM
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
-- Database: `studentdbsem2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `education` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `phone`, `email`, `address`, `education`, `password`, `role`) VALUES
(1, 'admin', '9876543210', 'admin@gmail.com', 'pune', 'BCA', '123', 'admin'),
(2, 'teacher', '9867543568', 'teacher@gmail.com', 'pune,maharashtra', 'Ph.D in Computer Science and Engineering', 'teacher@123', 'teacher'),
(3, 'principal', '9945347612', 'principal@gmail.com', 'Mumbai, Maharashtra', 'P.hd in electronics Enginerring', '123', 'principal');

-- --------------------------------------------------------

--
-- Table structure for table `admission`
--

CREATE TABLE `admission` (
  `ad_id` int(20) NOT NULL,
  `date_of_admission` date NOT NULL DEFAULT current_timestamp(),
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `father` varchar(50) DEFAULT NULL,
  `mother` varchar(50) DEFAULT NULL,
  `gender` varchar(20) NOT NULL,
  `bgroup` varchar(20) NOT NULL,
  `pcontact` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `pincode` int(50) DEFAULT NULL,
  `10th_school` varchar(30) NOT NULL,
  `10_institute_name` varchar(30) NOT NULL,
  `10_passing_year` date NOT NULL,
  `10th_marks` int(30) NOT NULL,
  `10_percentage` int(30) NOT NULL,
  `12_board` varchar(30) NOT NULL,
  `12_clg` varchar(30) NOT NULL,
  `12_passing_year` date NOT NULL,
  `12_marks` int(30) NOT NULL,
  `12_percentage` int(30) NOT NULL,
  `grad_uni` varchar(30) NOT NULL,
  `grad_clg` varchar(30) NOT NULL,
  `grad_passing_year` date NOT NULL,
  `grad_marks` int(30) NOT NULL,
  `grad_percentage` int(30) NOT NULL,
  `cet_roll` int(30) NOT NULL,
  `cet_center_code` varchar(30) NOT NULL,
  `cet_center_name` varchar(30) NOT NULL,
  `cet_percentile` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admission`
--

INSERT INTO `admission` (`ad_id`, `date_of_admission`, `name`, `phone`, `email`, `father`, `mother`, `gender`, `bgroup`, `pcontact`, `address`, `city`, `state`, `pincode`, `10th_school`, `10_institute_name`, `10_passing_year`, `10th_marks`, `10_percentage`, `12_board`, `12_clg`, `12_passing_year`, `12_marks`, `12_percentage`, `grad_uni`, `grad_clg`, `grad_passing_year`, `grad_marks`, `grad_percentage`, `cet_roll`, `cet_center_code`, `cet_center_name`, `cet_percentile`) VALUES
(202431, '2024-05-22', 'mansi', '9876543123', 'mansi@gmail.com', 'sunil', 'pammi', 'female', ' b+', '9763846147', 'akurdi', 'pune', 'maharastra', 800008, 'cbse', 'ijs', '2024-04-21', 2017, 475, 'cbse', 'ijs', '2024-04-21', 2019, 380, 'pu', 'bnc', '2024-04-21', 2022, 1200, 908, 'abc1256', ' iondigital', 90),
(202432, '2024-05-19', 'sumit', '8793547157', 'sumit@gmail.com', 'suman', 'pammi', 'male', ' b+', '87654321', 'JALLA GALI', 'patna', 'Bihar', 800008, 'cbse', 'ijs', '2024-04-23', 2017, 475, 'cbse', 'ijs', '2024-04-23', 2019, 380, 'pu', 'bnc', '2024-04-23', 2022, 1200, 908, 'abc1256', ' iondigital', 90),
(202433, '2024-05-25', 'deep', '7890123456', 'deep@gmail.com', 'amit', 'suman', 'male', ' b+', '80515151799', 'JALLA GALI', 'patna', 'BIHAR', 800008, 'cbse', 'ijs', '2024-05-29', 879, 879, 'sbse', 'ijs', '2024-05-29', 98, 980, 'pu', 'ijs', '2024-05-29', 89, 890, 908, 'abc1256', ' iondigital', 90),
(202435, '2024-05-27', 'Atul Gaurav', '8051515179', 'atulgaurav786@gmail.com', 'sunil', 'pammi', 'male', ' b+', '9334636355', 'akurdi', 'pune', 'Maharastra', 800008, 'cbse', 'ijs', '2024-05-15', 879, 87, 'sbse', 'ijs', '2024-05-15', 98, 98, 'pu', 'ijs', '2024-05-15', 89, 87, 908, 'abc1256', ' iondigital', 90);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(10) NOT NULL,
  `class` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class`, `section`, `subject`, `creationdate`) VALUES
(1, 'fymca', 'a', 'python', '2024-03-23 14:52:14'),
(2, 'fymca', 'b', 'ait', '2024-03-23 14:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `collegefeedback`
--

CREATE TABLE `collegefeedback` (
  `student_id` int(20) NOT NULL,
  `id` int(20) NOT NULL,
  `college_experience` int(20) NOT NULL,
  `teacher_effectiveness` int(21) NOT NULL,
  `classroom_facilities` int(20) NOT NULL,
  `support_services` int(20) NOT NULL,
  `campus_infrastructure` int(20) NOT NULL,
  `suggestion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collegefeedback`
--

INSERT INTO `collegefeedback` (`student_id`, `id`, `college_experience`, `teacher_effectiveness`, `classroom_facilities`, `support_services`, `campus_infrastructure`, `suggestion`) VALUES
(202411, 1, 4, 2, 3, 4, 5, 'na'),
(202412, 2, 4, 3, 3, 2, 1, 'very good');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `ad_id` int(12) NOT NULL,
  `doc_id` int(10) NOT NULL,
  `tenth_marksheet` longblob NOT NULL,
  `tewelfth_marksheet` longblob NOT NULL,
  `grad_marksheet` longblob NOT NULL,
  `cet_scorecard` longblob NOT NULL,
  `domicile` longblob NOT NULL,
  `aadhar_card` longblob NOT NULL,
  `nationality` longblob NOT NULL,
  `income` longblob NOT NULL,
  `photograph` longblob NOT NULL,
  `signature` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`ad_id`, `doc_id`, `tenth_marksheet`, `tewelfth_marksheet`, `grad_marksheet`, `cet_scorecard`, `domicile`, `aadhar_card`, `nationality`, `income`, `photograph`, `signature`) VALUES
(202431, 11, 0x30375f4174756c4761757261765f52656163744a532e706466, 0x30375f4174756c4761757261765f52656163744a532e706466, 0x30375f4174756c4761757261765f52656163744a532e706466, 0x30375f4174756c4761757261765f52656163744a532e706466, 0x30375f4174756c4761757261765f52656163744a532e706466, 0x30375f4174756c4761757261765f52656163744a532e706466, 0x30375f4174756c4761757261765f52656163744a532e706466, 0x30375f4174756c4761757261765f52656163744a532e706466, 0x7065616b70782e6a7067, 0x333135343035392e6a7067),
(202435, 14, 0x31307468206d61726b73686565742e706466, 0x31327468206d61726b73686565742e706466, 0x424341204d41524b53484545542e706466, 0x6d61685f73636f7265636172642e706466, 0x416164686161725f6e65772e706466, 0x416164686161725f6e65772e706466, 0x416164686161725f6e65772e706466, 0x416164686161725f6e65772e706466, 0x506963736172745f32332d30312d32385f31362d34362d34372d3538302e6a7067, 0x7369676e2e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `e_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`e_id`, `name`, `email`, `phone`, `message`) VALUES
(1, 'Atul Gaurav', 'atulgaurav786@gmail.com', '+918051515179', 'hello\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `notes_id` int(50) NOT NULL,
  `course_id` int(50) NOT NULL,
  `teacher_id` int(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`notes_id`, `course_id`, `teacher_id`, `subject`, `filename`) VALUES
(5, 101, 432, 'SPM', 'certificate_Git_644573.pdf'),
(6, 102, 401, 'python', '07_AtulGaurav_SPM_CBA1.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `message` varchar(100) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `title`, `message`, `creationdate`) VALUES
(16, 'holidays', 'holidays', '2024-05-24 17:14:26'),
(18, 'exam', 'ends term finish', '2024-05-24 17:17:08'),
(19, 'exam', 'ends term finish', '2024-05-24 17:17:22'),
(20, 'project submission-fymca', 'notice example', '2024-05-25 10:22:14');

-- --------------------------------------------------------

--
-- Table structure for table `paymentdetails`
--

CREATE TABLE `paymentdetails` (
  `paymentDate` date NOT NULL DEFAULT current_timestamp(),
  `payment_id` varchar(50) NOT NULL,
  `amount` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ad_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymentdetails`
--

INSERT INTO `paymentdetails` (`paymentDate`, `payment_id`, `amount`, `name`, `contact_number`, `email`, `ad_id`) VALUES
('2024-05-24', '8a393f1f815747be931f4b40860e8341', 91709, 'mansi', '08051515179', 'atulgaurav786@gmail.com', 202431),
('2024-05-24', '93c4b788b9734b029305b595fc407624', 91709, 'sumesh', '08051515179', 'atulgaurav786@gmail.com', 202430),
('2024-05-24', 'aa332a62a1cd461a950d4c7ac9ee3859', 91709, 'atul', '08051515179', 'atulgaurav786@gmail.com', 202432),
('2024-05-24', 'c63c56dd4ba14527a0a14c97d4c1a07f', 91709, 'mansi', '08051515179', 'atulgaurav786@gmail.com', 202431),
('2024-05-26', 'd3b708351f7a4254af0f60cb7725e1cf', 91709, 'Atul Gaurav', '08051515179', 'atulgaurav786@gmail.com', 202434),
('2024-05-24', 'f6dbd121603b46a5a4beac0410ceb033', 91709, 'Gaurav', '08051515179', 'atulgaurav786@gmail.com', 202429);

-- --------------------------------------------------------

--
-- Table structure for table `payment_receipt`
--

CREATE TABLE `payment_receipt` (
  `receipt_id` varchar(50) NOT NULL,
  `payment_id` varchar(50) NOT NULL,
  `payment_request_id` varchar(50) NOT NULL,
  `amount` int(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(20) NOT NULL,
  `feedback_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `feedback_active`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(20) NOT NULL,
  `ad_id` int(12) NOT NULL,
  `role` varchar(11) NOT NULL,
  `password` varchar(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `father` varchar(50) DEFAULT NULL,
  `mother` varchar(50) DEFAULT NULL,
  `gender` varchar(20) NOT NULL,
  `bgroup` varchar(20) NOT NULL,
  `pcontact` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `pincode` int(50) DEFAULT NULL,
  `10th_school` varchar(30) NOT NULL,
  `10_institute_name` varchar(30) NOT NULL,
  `10_passing_year` date NOT NULL,
  `10th_marks` int(30) NOT NULL,
  `10_percentage` int(30) NOT NULL,
  `12_board` varchar(30) NOT NULL,
  `12_clg` varchar(30) NOT NULL,
  `12_passing_year` date NOT NULL,
  `12_marks` int(30) NOT NULL,
  `12_percentage` int(30) NOT NULL,
  `grad_uni` varchar(30) NOT NULL,
  `grad_clg` varchar(30) NOT NULL,
  `grad_passing_year` date NOT NULL,
  `grad_marks` int(30) NOT NULL,
  `grad_percentage` int(30) NOT NULL,
  `cet_roll` int(30) NOT NULL,
  `cet_center_code` varchar(30) NOT NULL,
  `cet_center_name` varchar(30) NOT NULL,
  `cet_percentile` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `ad_id`, `role`, `password`, `name`, `phone`, `email`, `father`, `mother`, `gender`, `bgroup`, `pcontact`, `address`, `city`, `state`, `pincode`, `10th_school`, `10_institute_name`, `10_passing_year`, `10th_marks`, `10_percentage`, `12_board`, `12_clg`, `12_passing_year`, `12_marks`, `12_percentage`, `grad_uni`, `grad_clg`, `grad_passing_year`, `grad_marks`, `grad_percentage`, `cet_roll`, `cet_center_code`, `cet_center_name`, `cet_percentile`) VALUES
(202412, 202431, 'student', 'Q0WDre4s', 'mansi', '8342857624', 'mansi@gmail.com', 'sunil', 'pammi', 'female', ' b-', '87654321', 'akurdi', 'pune', 'maharastra', 800008, 'ijs', 'cbse', '2017-05-17', 480, 80, 'cbse', 'ijs', '2019-07-24', 450, 78, 'pu', 'dyp', '2022-05-26', 1200, 84, 908, 'abc1256', '  iondigital', 90),
(202413, 202432, 'student', 'Hy732Fua', 'sumit', '8735185673', 'sumit@gmail.com', 'sunil', 'pammi', 'male', ' o-', '9876512345', 'JALLA GALI', 'patna', 'Bihar', 800008, 'ijs', 'cbse', '2018-05-17', 400, 70, 'cbse', 'ijs', '2019-05-25', 450, 80, 'pu', 'bnc', '2024-05-23', 1200, 84, 908, 'abc1256', '  iondigital', 90),
(202414, 202433, 'student', 'kmYa9Ne7', 'deep', '9871234768', 'deep@gmail.com', 'sunil', 'pammi', 'male', ' a+', '8765432112', 'JALLA GALI', 'PATNA', 'Bihar', 800008, 'ijs', 'cbse', '2024-05-16', 400, 70, 'cbse', 'ijs', '2019-05-22', 480, 95, 'pu', 'bnc', '2022-05-24', 1100, 80, 908, 'abc1256', '  iondigital', 90);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `experience` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `name`, `phone`, `email`, `address`, `qualification`, `experience`, `password`, `role`) VALUES
(6, 'Atul Gaurav', '08051515179', 'atulgaurav786@gmail.com', 'JALLA GALI', 'mca', '1', 'tJtbRodP', 'teacher'),
(8, 'Deep Shikha', '07645899273', 'deep.shikhash2219@gmail.com', 'wrwer', 'mcca', '0', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission`
--
ALTER TABLE `admission`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collegefeedback`
--
ALTER TABLE `collegefeedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`doc_id`),
  ADD KEY `documents_ibfk_1` (`ad_id`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`notes_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentdetails`
--
ALTER TABLE `paymentdetails`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `ad_id` (`ad_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_id` (`ad_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admission`
--
ALTER TABLE `admission`
  MODIFY `ad_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202436;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `collegefeedback`
--
ALTER TABLE `collegefeedback`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `doc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `e_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `notes_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202417;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `admission` (`ad_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`ad_id`) REFERENCES `admission` (`ad_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
