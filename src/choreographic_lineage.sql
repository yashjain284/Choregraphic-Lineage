-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 02, 2017 at 06:22 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `choreographic_lineage`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist_education`
--

CREATE TABLE `artist_education` (
  `artist_email_id` varchar(100) NOT NULL,
  `artist_profile_id` int(255) NOT NULL,
  `education_type` varchar(200) NOT NULL,
  `institution_name` varchar(200) NOT NULL,
  `major` varchar(200) NOT NULL,
  `degree` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist_education`
--

INSERT INTO `artist_education` (`artist_email_id`, `artist_profile_id`, `education_type`, `institution_name`, `major`, `degree`) VALUES
('', 56, 'main', 'UB', 'CS', 'MS'),
('', 56, 'other', 'MAD', '', 'Associate'),
('', 82, 'main', 'UB', 'CS', 'MS'),
('', 82, 'other', 'Sathaye College', '', 'SSC'),
('', 72, 'main', 'University at Buffalo', 'Computer Science', 'Masters'),
('', 72, 'main', 'VJTI', 'Information Technology', 'B.Tech'),
('', 72, 'other', 'M.A.D', '', 'Fellowship'),
('', 72, 'other', 'S.R.A.', '', 'Senate'),
('', 83, 'main', 'UB', 'CS', 'MS'),
('', 83, 'other', 'Institute', '', 'Degree'),
('', 85, 'main', 'X', 'X', 'X'),
('', 85, 'main', 'X', 'Y', 'X'),
('', 85, 'other', 'A', '', 'A'),
('', 85, 'other', 'A', '', 'A'),
('', 88, 'main', '', '', ''),
('', 88, 'other', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `artist_profile`
--

CREATE TABLE `artist_profile` (
  `artist_profile_id` int(255) NOT NULL,
  `is_user_artist` varchar(10) NOT NULL,
  `profile_name` varchar(50) NOT NULL,
  `artist_first_name` varchar(50) NOT NULL,
  `artist_last_name` varchar(100) NOT NULL,
  `artist_email_address` varchar(50) NOT NULL,
  `artist_living_status` varchar(10) NOT NULL,
  `artist_dob` date NOT NULL,
  `artist_dod` date NOT NULL,
  `artist_genre` varchar(150) NOT NULL,
  `artist_ethnicity` varchar(50) NOT NULL,
  `artist_gender` varchar(50) NOT NULL,
  `gender_other` varchar(100) NOT NULL,
  `genre_other` varchar(100) NOT NULL,
  `ethnicity_other` varchar(100) NOT NULL,
  `artist_residence_city` varchar(100) NOT NULL,
  `artist_residence_state` varchar(100) NOT NULL,
  `artist_residence_province` varchar(100) NOT NULL,
  `artist_residence_country` varchar(100) NOT NULL,
  `artist_birth_country` varchar(100) NOT NULL,
  `artist_biography` varchar(500) NOT NULL,
  `artist_biography_text` varchar(1000) NOT NULL,
  `artist_photo_path` varchar(500) NOT NULL,
  `artist_website` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist_profile`
--

INSERT INTO `artist_profile` (`artist_profile_id`, `is_user_artist`, `profile_name`, `artist_first_name`, `artist_last_name`, `artist_email_address`, `artist_living_status`, `artist_dob`, `artist_dod`, `artist_genre`, `artist_ethnicity`, `artist_gender`, `gender_other`, `genre_other`, `ethnicity_other`, `artist_residence_city`, `artist_residence_state`, `artist_residence_province`, `artist_residence_country`, `artist_birth_country`, `artist_biography`, `artist_biography_text`, `artist_photo_path`, `artist_website`) VALUES
(1, '', 'test2@gmail.com', 'Test', '', 'test@email.com', '', '0000-00-00', '0000-00-00', '0', '', 'Male', '', '', '', 'Buffalo', 'New York', '', 'United States', 'United States', 'I am graduate student at UB!', '', '1492505381.jpg', '0'),
(2, '', 'test2@gmail.com', 'Test2', '', 'test2@email.com', '', '0000-00-00', '0000-00-00', '0', '', 'Not Selected', '', '', '', '', '', '', '', '', '', '', '1492508060.jpg', '0'),
(56, 'other', '', 'test1', 'test1', 'test1', 'living', '1989-01-02', '0000-00-00', ',Actor,Composer,Other', 'other', 'other', 'Transgender', 'Singer', 'Phili', 'Buffalo', '', 'Kabul', 'Afganistan', 'Afganistan', '', '', 'photo_upload_data/IMG_20170610_232036916.jpg', '0'),
(58, 'other', '', 'test2', 'test2', 'test2.com', 'living', '1975-03-05', '0000-00-00', ',Actor,Composer', 'cw', 'male', '', '', '', 'Buffalo', 'NY', '', 'United States of America', 'United States of America', '', '', '', 'website.com'),
(71, 'other', '', 'test3', 'test3', 'test3.com', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'website.com'),
(72, 'artist', 'sumedh0192@gmail.com', 'Sumedh', 'Ambokar', 'sumedh0192@gmail.com', 'living', '1992-01-01', '0000-00-00', ',Actor,Other', 'asian', 'male', '', 'Singer', '', 'Buffalo', 'NY', '', 'United States of America', 'India', 'biography_upload_data/Amazon.pdf', '', 'photo_upload_data/IMG-20160612-WA0009.jpg', 'sumedhambokar.com'),
(73, 'other', '', 'Yash', 'Jain', 'yashnavi@buffalo.edu', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'yashnavi.com'),
(74, 'other', '', 'Mitali', 'Bhiwande', 'mitalivi@buffalo.edu', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'acsu.buffalo.edu/~mitaliv'),
(75, 'other', '', 'Mitali', 'Bhiwande', 'mitalivi@buffalo.edu', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'acsu.buffalo.edu/~mitalivi/'),
(76, 'other', '', '', '', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(77, 'other', '', 'Test', 'test', 'test', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'test'),
(78, 'other', '', 'Akshay', 'Shah', 'akshaybh@buffalo.edu', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'akshaybh.com'),
(79, 'other', '', 'Yash', 'Jain', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'yashnavi.com'),
(80, 'other', '', 'Mitali', 'Bhiwande', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'acsu.buffalo.edu/~mitalivi/'),
(81, 'other', '', 'Akshay', 'Shah', '', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'akshaybh.com'),
(82, 'other', 'sumedh0192@gmail.com', 'Saurabh', 'Bajoria', 'sbajoria@buffalo.edu', 'living', '1990-08-14', '0000-00-00', ',Dancer,Filmmaker,Musician', 'other', 'male', '', '', 'Cannot Specify', 'Buffalo', 'NY', '', 'United States of America', 'United States of America', '', '', '', NULL),
(83, 'other', 'sumedh0192@gmail.com', 'Kaushik', 'Ramasubramanian', 'kaushik4r@gmail.com', 'deceased', '1989-01-02', '2017-08-10', ',Actor,Costume_Designer,Dancer,Poet,Visual_Artist,Scenic_Designer', 'aab', 'male', '', '', '', 'Buffalo', 'NY', '', 'United States of America', 'India', 'biography_upload_data/Semester Intent to Return fall 2017.doc', '', 'photo_upload_data/IMG_20170610_194324880.jpg', NULL),
(84, 'other', '', 'Saurabh', 'Bajoria', 'sbajoria@buffalo.edu', '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `artist_relation`
--

CREATE TABLE `artist_relation` (
  `relation_id` int(255) NOT NULL,
  `artist_profile_id_1` int(255) NOT NULL,
  `artist_profile_id_2` int(255) NOT NULL,
  `artist_name_1` varchar(255) NOT NULL,
  `artist_email_id_1` varchar(100) NOT NULL,
  `artist_name_2` varchar(255) NOT NULL,
  `artist_email_id_2` varchar(100) NOT NULL,
  `artist_website_2` varchar(200) NOT NULL,
  `artist_relation` varchar(100) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date NOT NULL,
  `duration_years` int(255) NOT NULL,
  `duration_months` int(255) NOT NULL,
  `relation_identifier` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist_relation`
--

INSERT INTO `artist_relation` (`relation_id`, `artist_profile_id_1`, `artist_profile_id_2`, `artist_name_1`, `artist_email_id_1`, `artist_name_2`, `artist_email_id_2`, `artist_website_2`, `artist_relation`, `start_date`, `end_date`, `duration_years`, `duration_months`, `relation_identifier`) VALUES
(66, 82, 72, 'Saurabh-Bajoria', '', 'Sumedh-Ambokar', 'sumedh0192@gmail.com', 'sumedhambokar.com', 'Studied With', '2016-08-15', '2017-08-18', 1, 0, ''),
(67, 82, 72, 'Saurabh-Bajoria', '', 'Sumedh-Ambokar', 'sumedh0192@gmail.com', 'sumedhambokar.com', 'Collaborated With', '2016-08-15', '2017-04-01', 0, 8, ''),
(68, 82, 78, 'Saurabh-Bajoria', '', 'Akshay-Shah', 'akshaybh@buffalo.edu', 'akshaybh.com', 'Studied With', '2016-08-15', '2017-08-18', 1, 0, ''),
(69, 72, 73, 'Sumedh-Ambokar', '', 'Yash-Jain', 'yashnavi@buffalo.edu', 'yashnavi.com', 'Studied With', '2016-08-01', '2017-08-18', 1, 1, ''),
(70, 72, 75, 'Sumedh-Ambokar', '', 'Mitali-Bhiwande', 'mitalivi@buffalo.edu', 'acsu.buffalo.edu/~mitalivi/', 'Collaborated With', '2017-04-01', '2017-08-18', 0, 5, ''),
(71, 72, 78, 'Sumedh-Ambokar', '', 'Akshay-Shah', 'akshaybh@buffalo.edu', 'akshaybh.com', 'Studied With', '2009-06-06', '2017-08-18', 8, 4, ''),
(72, 72, 78, 'Sumedh-Ambokar', '', 'Akshay-Shah', 'akshaybh@buffalo.edu', 'akshaybh.com', 'Collaborated With', '0000-00-00', '0000-00-00', 5, 0, ''),
(73, 83, 84, 'Kaushik-Ramasubramanian', '', 'Saurabh-Bajoria', 'sbajoria@buffalo.edu', '', 'Studied With', '2016-08-15', '2017-08-18', 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `phone_appointments`
--

CREATE TABLE `phone_appointments` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `note` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phone_appointments`
--

INSERT INTO `phone_appointments` (`id`, `first_name`, `last_name`, `email`, `contact`, `note`) VALUES
(1, 'Yash', 'jain', 'yashjain284@gmail.com', '7165454395', 'Yash'),
(2, 'Akshay', 'Shah', 'akshaybh@buffalo.edu', '7165454390', 'Gaali khaaya');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `user_id` int(255) NOT NULL,
  `user_first_name` varchar(100) NOT NULL,
  `user_last_name` varchar(100) NOT NULL,
  `user_email_address` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_one_time_password` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`user_id`, `user_first_name`, `user_last_name`, `user_email_address`, `user_password`, `user_one_time_password`) VALUES
(26, 'Sumedh', 'Ambokar', 'sumedh0192@gmail.com', 'sumedh123', 615941),
(27, 'Yash', 'Jain', 'test@test.com', 'test', 796976);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist_profile`
--
ALTER TABLE `artist_profile`
  ADD PRIMARY KEY (`artist_profile_id`);

--
-- Indexes for table `artist_relation`
--
ALTER TABLE `artist_relation`
  ADD PRIMARY KEY (`relation_id`),
  ADD UNIQUE KEY `relation_identifier` (`artist_profile_id_1`,`artist_profile_id_2`,`artist_relation`);

--
-- Indexes for table `phone_appointments`
--
ALTER TABLE `phone_appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email_address` (`user_email_address`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist_profile`
--
ALTER TABLE `artist_profile`
  MODIFY `artist_profile_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `artist_relation`
--
ALTER TABLE `artist_relation`
  MODIFY `relation_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `phone_appointments`
--
ALTER TABLE `phone_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
