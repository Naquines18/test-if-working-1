-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2021 at 01:35 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barangaydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance_user`
--

CREATE TABLE `advance_user` (
  `advance_user_id` int(11) NOT NULL,
  `advance_user_name` varchar(255) NOT NULL,
  `advance_user_email` varchar(255) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `advance_user_role` varchar(255) NOT NULL,
  `advance_user_password` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL,
  `advance_user_created` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advance_user`
--

INSERT INTO `advance_user` (`advance_user_id`, `advance_user_name`, `advance_user_email`, `gender`, `advance_user_role`, `advance_user_password`, `profile_image`, `verified`, `advance_user_created`) VALUES
(1, 'Admin', 'admin@localhost.com', 'Male', '1', '21232f297a57a5a743894a0e4a801fc3', 'images/download.jpg', 1, '2021-04-19 00:00:00.000000'),
(5, 'Dr. Kian Naquines', 'dr.kiannaquines@gmail.com', 'Male', '2', '41f4baf14231bf57eac9cdd3dce15656', 'images/download.jpg', 1, '2021-04-26 21:07:28.000000'),
(21, 'Administrator', 'administrator@localhost.com', 'Male', '1', '200ceb26807d6bf99fd6f4f0d1ca54d4', 'images/download.jpg', 1, '2021-05-23 00:00:00.000000'),
(27, 'Staff Kian Naquines', 'goyec944922@geekale.com', 'Male', '2', '41f4baf14231bf57eac9cdd3dce15656', 'images/3443556.png', 1, '2021-06-29 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `advance_user_profile`
--

CREATE TABLE `advance_user_profile` (
  `admin_profile_id` int(11) NOT NULL,
  `admin_address` varchar(225) NOT NULL,
  `admin_bio` varchar(100) NOT NULL,
  `birthdate` varchar(255) NOT NULL,
  `admin_mobile` varchar(255) NOT NULL,
  `admin_advance_user_id` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advance_user_profile`
--

INSERT INTO `advance_user_profile` (`admin_profile_id`, `admin_address`, `admin_bio`, `birthdate`, `admin_mobile`, `admin_advance_user_id`, `city`, `specialization`) VALUES
(10, '96  Park Avenue', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Possimus corporis dignissimos.', '2002-10-20', '09796796967', '1', 'Roseville', 'n/a'),
(12, 'New Israel Makilala Cotabato', 'Im Kian Naquines the administrator of the system...', '2002-08-10', '09103630525', '15', 'Cotabato City', 'n/a'),
(13, 'New Israel Makilala Cotabato', 'used to demonstrate the visual form of a document or a typeface', '2002-10-10', '09103630525', '14', 'Cotabato City', 'n/a'),
(19, 'New Israel Makilala North Cotabato', 'Test Bio', '2021-09-18', '09103630525', '27', 'Cotabato', 'n/a');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `appointment_fullname` varchar(255) NOT NULL,
  `appointment_email` varchar(255) NOT NULL,
  `age` varchar(100) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `patient_comment` varchar(500) NOT NULL,
  `patient_doctor` varchar(255) NOT NULL,
  `establishment` int(11) NOT NULL,
  `appointment_created` datetime NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_charts`
--

CREATE TABLE `appointment_charts` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment_charts`
--

INSERT INTO `appointment_charts` (`id`, `email`, `status`) VALUES
(1, 'goyec44922@geekale.com', 'Pending'),
(2, 'goyec44922@geekale.com', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `browser`
--

CREATE TABLE `browser` (
  `id` int(11) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `no_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `browser`
--

INSERT INTO `browser` (`id`, `browser`, `no_user`) VALUES
(1, 'Firefox', '5'),
(2, 'Chrome', '6');

-- --------------------------------------------------------

--
-- Table structure for table `browser_logs`
--

CREATE TABLE `browser_logs` (
  `log_id` int(11) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `platform` varchar(255) NOT NULL,
  `device` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `loggedin_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `browser_logs`
--

INSERT INTO `browser_logs` (`log_id`, `browser`, `platform`, `device`, `ip`, `client_id`, `loggedin_date`) VALUES
(136, 'Firefox', 'Windows 8.1', 'Computer', '::1', '120', '2021-09-09'),
(137, 'Firefox', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-09'),
(138, 'Chrome', 'Windows 8.1', 'Computer', '::1', '5', '2021-09-09'),
(139, 'Firefox', 'Windows 8.1', 'Computer', '::1', '120', '2021-09-09'),
(140, 'Chrome', 'Windows 8.1', 'Computer', '::1', '121', '2021-09-10'),
(141, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-10'),
(142, 'Firefox', 'Windows 8.1', 'Computer', '::1', '5', '2021-09-10'),
(143, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-10'),
(144, 'Firefox', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-10'),
(145, 'Chrome', 'Windows 8.1', 'Computer', '::1', '121', '2021-09-10'),
(146, 'Android', 'Windows 8.1', 'Computer', '::1', '120', '2021-09-10'),
(147, 'Chrome', 'Windows 8.1', 'Computer', '::1', '121', '2021-09-10'),
(148, 'Android', 'Windows 8.1', 'Computer', '::1', '121', '2021-09-10'),
(149, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-10'),
(150, 'Chrome', 'Windows 8.1', 'Computer', '::1', '121', '2021-09-10'),
(151, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-10'),
(152, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-14'),
(153, 'Chrome', 'Windows 8.1', 'Computer', '::1', '122', '2021-09-14'),
(154, 'Android', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-14'),
(155, 'Chrome', 'Windows 8.1', 'Computer', '::1', '122', '2021-09-14'),
(156, 'Chrome', 'Windows 8.1', 'Computer', '::1', '122', '2021-09-18'),
(157, 'Android', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-18'),
(158, 'Chrome', 'Windows 8.1', 'Computer', '::1', '122', '2021-09-18'),
(159, 'Chrome', 'Windows 8.1', 'Computer', '::1', '27', '2021-09-18'),
(160, 'Chrome', 'Windows 8.1', 'Computer', '::1', '122', '2021-09-18'),
(161, 'Chrome', 'Windows 8.1', 'Computer', '::1', '27', '2021-09-18'),
(162, 'Chrome', 'Windows 8.1', 'Computer', '::1', '123', '2021-09-18'),
(163, 'Chrome', 'Windows 8.1', 'Computer', '::1', '123', '2021-09-18'),
(164, 'Chrome', 'Windows 8.1', 'Computer', '::1', '124', '2021-09-18'),
(165, 'Chrome', 'Windows 8.1', 'Computer', '::1', '27', '2021-09-18'),
(166, 'Chrome', 'Windows 8.1', 'Computer', '::1', '125', '2021-09-18'),
(167, 'Chrome', 'Windows 8.1', 'Computer', '::1', '126', '2021-09-18'),
(168, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-18'),
(169, 'Chrome', 'Windows 8.1', 'Computer', '::1', '121', '2021-09-18'),
(170, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-18'),
(171, 'Chrome', 'Windows 8.1', 'Computer', '::1', '121', '2021-09-18'),
(172, 'Chrome', 'Windows 8.1', 'Computer', '::1', '121', '2021-09-18'),
(173, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-18'),
(174, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-18'),
(175, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-18'),
(176, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-20'),
(177, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-20'),
(178, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-20'),
(179, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-20'),
(180, 'Chrome', 'Windows 8.1', 'Computer', '::1', '126', '2021-09-24'),
(181, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-24'),
(182, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-09-24'),
(183, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-10-05'),
(184, 'Chrome', 'Windows 8.1', 'Computer', '::1', '127', '2021-10-05'),
(185, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-10-09'),
(186, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-10-11'),
(187, 'Chrome', 'Windows 8.1', 'Computer', '::1', '128', '2021-10-17'),
(188, 'Chrome', 'Windows 8.1', 'Computer', '::1', '129', '2021-10-25'),
(189, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-10-25'),
(190, 'Chrome', 'Windows 8.1', 'Computer', '::1', '5', '2021-10-25'),
(191, 'Chrome', 'Windows 8.1', 'Computer', '::1', '129', '2021-10-25'),
(192, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-10-25'),
(193, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-10-28'),
(194, 'Chrome', 'Windows 8.1', 'Computer', '::1', '121', '2021-10-28'),
(195, 'Chrome', 'Windows 8.1', 'Computer', '::1', '130', '2021-11-09'),
(196, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-11-09'),
(197, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-11-10'),
(198, 'Chrome', 'Windows 8.1', 'Computer', '::1', '130', '2021-11-10'),
(199, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-11-10'),
(200, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-11-10'),
(201, 'Chrome', 'Windows 8.1', 'Computer', '::1', '130', '2021-11-11'),
(202, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-11-11'),
(203, 'Chrome', 'Windows 8.1', 'Computer', '::1', '27', '2021-11-11'),
(204, 'Chrome', 'Windows 8.1', 'Computer', '::1', '130', '2021-11-11'),
(205, 'Chrome', 'Windows 8.1', 'Computer', '::1', '130', '2021-11-11'),
(206, 'Chrome', 'Windows 8.1', 'Computer', '::1', '130', '2021-11-11'),
(207, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-11-11'),
(208, 'Chrome', 'Windows 8.1', 'Computer', '::1', '27', '2021-11-11'),
(209, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-11-11'),
(210, 'Chrome', 'Windows 8.1', 'Computer', '::1', '131', '2021-11-11'),
(211, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-11-12'),
(212, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-11-15'),
(213, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-11-15'),
(214, 'Chrome', 'Windows 8.1', 'Computer', '::1', '130', '2021-11-16'),
(215, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-11-16'),
(216, 'Chrome', 'Windows 8.1', 'Computer', '::1', '1', '2021-11-16'),
(217, 'Chrome', 'Windows 8.1', 'Computer', '::1', '130', '2021-11-16'),
(218, 'Chrome', 'Windows 8.1', 'Computer', '::1', '130', '2021-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `client_firstname` varchar(255) NOT NULL,
  `client_lastname` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_password` varchar(255) NOT NULL,
  `client_gender` varchar(50) NOT NULL,
  `client_image` varchar(255) NOT NULL,
  `account_created` datetime NOT NULL,
  `role` int(2) NOT NULL,
  `verified` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_firstname`, `client_lastname`, `client_email`, `client_password`, `client_gender`, `client_image`, `account_created`, `role`, `verified`) VALUES
(120, 'Kian', 'Naquines', 'sebiwe1370@sicmag.com', 'b22186e696085a0eeca8e8b254d71613', 'Male', 'images/3443556.png', '2021-09-09 00:00:00', 0, 1),
(121, 'Kenneth', 'Naquines', 'sotat65518@shensufu.com', '41f4baf14231bf57eac9cdd3dce15656', 'Male', 'images/3443556.png', '2021-09-10 00:00:00', 0, 1),
(122, 'Harry', 'Doe', '26um5rl4gp@coffeetimer24.com', '41f4baf14231bf57eac9cdd3dce15656', 'Male', 'images/3443556.png', '2021-09-14 00:00:00', 0, 1),
(123, 'Kian Jearard', 'Naquines', 'fpwjddbduccf@uniromax.com', '41f4baf14231bf57eac9cdd3dce15656', 'Male', 'images/default.png', '2021-09-18 00:00:00', 0, 1),
(124, 'Naruto', 'Uzumaki', 'tkfpsmdghoxffq@uniromax.com', '8c5b67109ac5f74e4e1e804206a696da', 'Male', 'images/3443556.png', '2021-09-18 00:00:00', 0, 1),
(125, 'Professor', 'James', 'wljmjt@uniromax.com', '41f4baf14231bf57eac9cdd3dce15656', 'Male', 'images/default.png', '2021-09-18 00:00:00', 0, 1),
(126, 'Herman', 'Lee', 'difyonomddtqk@uniromax.com', '1d205d7a2aef8d97e998bc2677292ab7', 'Male', 'images/default.png', '2021-09-18 00:00:00', 0, 1),
(127, 'Jennie', 'Mc Cartney', '0hvctpf8vd@bestparadize.com', '01d30d909610b87fe463e7a700a0c18a', 'Male', 'images/3443556.png', '2021-10-05 00:00:00', 0, 1),
(128, 'Harry', 'Potter', 'gabenom347@specialistblog.com', 'd2e880e6c655020fa3a556fff3b38094', 'Male', 'images/default.png', '2021-10-17 00:00:00', 0, 1),
(129, 'Test Me', 'Doe', 'virdunulma@vusra.com', 'b6236fb6f583f001ab06ce0fb8e22f1c', 'Male', 'images/default.png', '2021-10-25 00:00:00', 0, 1),
(131, 'Jearard Kian', 'Naquines', 'vapsozekna@vusra.com', 'c44037769f035b326a29aa22d295e8a0', 'Male', 'images/3443556.png', '2021-11-11 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `client_profile`
--

CREATE TABLE `client_profile` (
  `client_profile_id` int(11) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `client_profile_address` varchar(255) NOT NULL,
  `client_profile_birthday` varchar(255) NOT NULL,
  `client_profile_phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client_profile`
--

INSERT INTO `client_profile` (`client_profile_id`, `client_id`, `client_profile_address`, `client_profile_birthday`, `client_profile_phone`) VALUES
(19, '120', 'New Israel Makilala North Cotabato', '2002-09-09', '09103630525'),
(20, '121', 'New Israel Makilala North Cotabato', '2021-09-10', '09103630373'),
(21, '122', 'New Israel Makilala North Cotabato', '2002-08-10', '09103630646'),
(22, '124', 'Konoho Land of Fire', '2021-09-18', '09103730525'),
(23, '127', 'New Israel Makilala North Cotabato', '2002-08-10', '09103630525'),
(24, '129', 'New Israel Makilala North Cotabato', '1998-09-08', '09104545678'),
(26, '131', 'New Israel Makilala North Cotabato', '2002-09-10', '09103730626');

-- --------------------------------------------------------

--
-- Table structure for table `establishments`
--

CREATE TABLE `establishments` (
  `establishments_id` int(11) NOT NULL,
  `establishments_name` varchar(255) NOT NULL,
  `establishments_desc` varchar(255) NOT NULL,
  `establishment_payment_amout` int(11) NOT NULL,
  `establishments_mobile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `establishments`
--

INSERT INTO `establishments` (`establishments_id`, `establishments_name`, `establishments_desc`, `establishment_payment_amout`, `establishments_mobile`) VALUES
(3, 'ZipLine', 'ZipLine', 600, '09103630525'),
(4, 'Test Estab', 'Test Estab Desc', 700, '0910434343'),
(5, 'Test establishment name', 'Test establishment name', 7000, '0910374324234'),
(6, 'Zipline and Visiting Monkey', 'Please fill up all the fields with the correct information to avoid conflict in the feauture.', 1000, '09102526838');

-- --------------------------------------------------------

--
-- Table structure for table `establisment_payments`
--

CREATE TABLE `establisment_payments` (
  `payments_id` int(11) NOT NULL,
  `establishment` varchar(100) NOT NULL,
  `paid_by` varchar(265) NOT NULL,
  `amount` int(11) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `staff` varchar(100) NOT NULL,
  `date` varchar(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `establisment_payments`
--

INSERT INTO `establisment_payments` (`payments_id`, `establishment`, `paid_by`, `amount`, `gender`, `age`, `address`, `city`, `staff`, `date`) VALUES
(3, 'ZipLine', 'Tumlumerdu Tumlumerdu', 600, 'Male', 19, 'New Israel Makilala North Cotabato', 'Cotabato', 'Staff Kian Naquines', '2021-11-11 '),
(4, 'Test Estab', 'Tumlumerdu Tumlumerdu', 700, 'Male', 19, 'New Israel Makilala North Cotabato', 'Cotabato', 'Staff Kian Naquines', '2021-11-11 '),
(5, 'ZipLine', 'Tumlumerdu Tumlumerdu', 600, 'Male', 19, 'New Israel Makilala North Cotabato', 'Cotabato', 'Staff Kian Naquines', '2021-11-11 '),
(6, 'ZipLine', 'Tumlumerdu Tumlumerdu', 600, 'Male', 19, 'New Israel Makilala North Cotabato', 'Cotabato', 'Staff Kian Naquines', '2021-11-11 '),
(7, 'Test establishment name', 'Tumlumerdu Tumlumerdu', 1000, 'Male', 19, 'New Israel Makilala North Cotabato', 'Cotabato', 'Staff Kian Naquines', '2021-11-11 '),
(8, 'Test establishment name', 'Tumlumerdu Tumlumerdu', 1000, 'Male', 19, 'New Israel Makilala North Cotabato', 'Cotabato', 'Staff Kian Naquines', '2021-11-11 '),
(9, 'Test Estab', 'Tumlumerdu Tumlumerdu', 700, 'Male', 19, 'New Israel Makilala North Cotabato', 'Cotabato', 'Staff Kian Naquines', '2021-11-11 '),
(10, 'Test establishment name', 'Tumlumerdu Tumlumerdu', 1000, 'Male', 19, 'New Israel Makilala North Cotabato', 'Cotabato', 'Staff Kian Naquines', '2021-11-11 '),
(11, 'Test establishment name', 'Tumlumerdu Tumlumerdu', 1000, 'Male', 19, 'New Israel Makilala North Cotabato', 'Cotabato', 'Staff Kian Naquines', '2021-11-11 '),
(12, 'Test establishment name', 'Tumlumerdu Tumlumerdu', 1000, 'Male', 19, 'New Israel Makilala North Cotabato', 'Cotabato', 'Staff Kian Naquines', '2021-11-11 '),
(13, 'Test establishment name', 'Tumlumerdu Tumlumerdu', 1000, 'Male', 19, 'New Israel Makilala North Cotabato', 'Cotabato', 'Staff Kian Naquines', '2021-11-11 '),
(14, 'Test establishment name', 'Tumlumerdu Tumlumerdu', 1000, 'Male', 19, 'New Israel Makilala North Cotabato', 'Cotabato', 'Staff Kian Naquines', '2021-11-11 '),
(15, 'Test establishment name', 'Tumlumerdu Tumlumerdu', 1000, 'Male', 19, 'New Israel Makilala North Cotabato', 'Cotabato', 'Staff Kian Naquines', '2021-11-11 '),
(16, 'Test establishment name', 'Tumlumerdu Tumlumerdu', 7000, 'Male', 19, 'New Israel Makilala North Cotabato', 'Cotabato', 'Staff Kian Naquines', '2021-11-11 '),
(17, 'ZipLine', 'Tumlumerdu Tumlumerdu', 600, 'Male', 19, 'New Israel Makilala North Cotabato', 'Cotabato', 'Staff Kian Naquines', '2021-11-11 '),
(18, 'Test establishment name', 'Tumlumerdu Tumlumerdu', 7000, 'Male', 19, 'New Israel Makilala North Cotabato', 'Cotabato', 'Staff Kian Naquines', '2021-11-11 ');

-- --------------------------------------------------------

--
-- Table structure for table `log_qr`
--

CREATE TABLE `log_qr` (
  `log_id` int(11) NOT NULL,
  `id_no` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `time_in` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_qr`
--

INSERT INTO `log_qr` (`log_id`, `id_no`, `fullname`, `address`, `phone`, `time_in`, `status`) VALUES
(52, '456734273013', 'Harry Doe', 'New Israel Makilala North Cotabato', '09103630646', '2021-09-14 14:38:15', 'Arrived'),
(53, '456734273013', 'Harry Doe', 'New Israel Makilala North Cotabato', '09103630646', '2021-09-18 15:21:56', 'Arrived'),
(54, '456734634775', 'Test Me Doe', 'New Israel Makilala North Cotabato', '09104545678', '2021-10-25 09:02:33', 'Arrived'),
(55, '456734634775', 'Test Me Doe', 'New Israel Makilala North Cotabato', '09104545678', '2021-10-25 09:03:47', 'Arrived'),
(56, '456734237174', 'Tumlumerdu Tumlumerdu', 'New Israel Makilala North Cotabato', '09103630525', '2021-11-11 10:09:19', 'Arrived');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `body` varchar(255) NOT NULL,
  `from` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message_date` varchar(255) NOT NULL,
  `seen` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `money_accumulated`
--

CREATE TABLE `money_accumulated` (
  `id` int(11) NOT NULL,
  `money` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `money_accumulated`
--

INSERT INTO `money_accumulated` (`id`, `money`) VALUES
(1, '6600');

-- --------------------------------------------------------

--
-- Table structure for table `money_report`
--

CREATE TABLE `money_report` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `amount_payed` varchar(255) NOT NULL,
  `id_no` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `date_payed` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `money_report`
--

INSERT INTO `money_report` (`id`, `fullname`, `amount_payed`, `id_no`, `address`, `phone`, `date_payed`) VALUES
(2, 'Harry Doe', '100', '456734273013', 'New Israel Makilala North Cotabato', '09103630646', '2021-09-18 19:51:58'),
(3, 'Harry Doe', '100', '456734273013', 'New Israel Makilala North Cotabato', '09103630646', '2021-09-18 19:53:39'),
(4, 'Harry Doe', '100', '456734273013', 'New Israel Makilala North Cotabato', '09103630646', '2021-09-18 19:54:17'),
(5, 'Harry Doe', '100', '456734273013', 'New Israel Makilala North Cotabato', '09103630646', '2021-09-18 19:54:44'),
(6, 'Kenneth Naquines', '100', '456734229117', 'New Israel Makilala North Cotabato', '09103630373', '2021-09-18 20:07:49'),
(7, 'Kenneth Naquines', '100', '456734229117', 'New Israel Makilala North Cotabato', '09103630373', '2021-09-18 20:09:57'),
(8, 'Kenneth Naquines', '100', '456734229117', 'New Israel Makilala North Cotabato', '09103630373', '2021-09-18 20:10:33'),
(9, ' ', '100', '', '', '', '2021-10-25 08:57:26'),
(10, 'Test Me Doe', '100', '456734634775', 'New Israel Makilala North Cotabato', '09104545678', '2021-10-25 09:04:26'),
(11, 'Tumlumerdu Tumlumerdu', '100', '456734237174', 'New Israel Makilala North Cotabato', '09103630525', '2021-11-11 10:09:38'),
(12, 'Tumlumerdu Tumlumerdu', '100', '456734237174', 'New Israel Makilala North Cotabato', '09103630525', '2021-11-11 10:31:16'),
(13, 'Tumlumerdu Tumlumerdu', '100', '456734237174', 'New Israel Makilala North Cotabato', '09103630525', '2021-11-11 10:49:22'),
(14, 'Tumlumerdu Tumlumerdu', '100', '456734237174', 'New Israel Makilala North Cotabato', '09103630525', '2021-11-11 11:12:32'),
(15, 'Tumlumerdu Tumlumerdu', '100', '456734237174', 'New Israel Makilala North Cotabato', '09103630525', '2021-11-11 13:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_client`
--

CREATE TABLE `monthly_client` (
  `id` int(11) NOT NULL,
  `no_client` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monthly_client`
--

INSERT INTO `monthly_client` (`id`, `no_client`, `month`) VALUES
(1, '16', 'Jan'),
(2, '20', 'Feb'),
(4, '34', 'Mar'),
(6, '40', 'Apr'),
(8, '20', 'May'),
(11, '19', 'Jun'),
(12, '67', 'Jul'),
(14, '90', 'Aug'),
(16, '70', 'Sep'),
(18, '3', 'Oct'),
(20, '2', 'Nov'),
(22, '0', 'Dec');

-- --------------------------------------------------------

--
-- Table structure for table `qrcodes`
--

CREATE TABLE `qrcodes` (
  `qr_id` int(11) NOT NULL,
  `id_no` varchar(255) NOT NULL,
  `qr_image` varchar(155) NOT NULL,
  `qr_user_id` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `qrcodes`
--

INSERT INTO `qrcodes` (`qr_id`, `id_no`, `qr_image`, `qr_user_id`) VALUES
(120, '456734333273', 'qr_images/1631165075_QRCODE_013bcd211ac14f77b351e07da229261c.png', '120'),
(121, '456734229117', 'qr_images/1631241439_QRCODE_7744027fe817fc80f38ac94a960098c5.png', '121'),
(122, '456734646062', 'qr_images/1631242148_QRCODE_c1e23e333a6339f2ea23a1284920d016.png', '121'),
(123, '456734273013', 'qr_images/1631601272_QRCODE_17c299c33b6dc74d4d07e94ed49e3c62.png', '122'),
(124, '456734411964', 'qr_images/1631950585_QRCODE_8f63cc779bd9d2e85e46b789ba939661.png', '121'),
(125, '456734248302', 'qr_images/1631950809_QRCODE_883cee9e63203806e2d2bd266075c680.png', '121'),
(126, '456734311900', 'qr_images/1631950932_QRCODE_1329c1c5b06ec706d07f697cd034e613.png', '121'),
(127, '456734639567', 'qr_images/1631960639_QRCODE_0ed2e64bcac0f0c08d45d36fd376b4b7.png', '124'),
(128, '456734634775', 'qr_images/1635122964_QRCODE_7bd5525787b35a30f43996fd15a24d35.png', '129'),
(129, '456734237174', 'qr_images/1636514346_QRCODE_e4e0a72d238141bc3564865b7345a49c.png', '130');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int(11) NOT NULL,
  `user_role_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `user_role_name`) VALUES
(1, 'admin'),
(2, 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advance_user`
--
ALTER TABLE `advance_user`
  ADD PRIMARY KEY (`advance_user_id`);

--
-- Indexes for table `advance_user_profile`
--
ALTER TABLE `advance_user_profile`
  ADD PRIMARY KEY (`admin_profile_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `appointment_charts`
--
ALTER TABLE `appointment_charts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `browser`
--
ALTER TABLE `browser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `browser_logs`
--
ALTER TABLE `browser_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `client_profile`
--
ALTER TABLE `client_profile`
  ADD PRIMARY KEY (`client_profile_id`);

--
-- Indexes for table `establishments`
--
ALTER TABLE `establishments`
  ADD PRIMARY KEY (`establishments_id`);

--
-- Indexes for table `establisment_payments`
--
ALTER TABLE `establisment_payments`
  ADD PRIMARY KEY (`payments_id`);

--
-- Indexes for table `log_qr`
--
ALTER TABLE `log_qr`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `money_accumulated`
--
ALTER TABLE `money_accumulated`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `money_report`
--
ALTER TABLE `money_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_client`
--
ALTER TABLE `monthly_client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qrcodes`
--
ALTER TABLE `qrcodes`
  ADD PRIMARY KEY (`qr_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advance_user`
--
ALTER TABLE `advance_user`
  MODIFY `advance_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `advance_user_profile`
--
ALTER TABLE `advance_user_profile`
  MODIFY `admin_profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `appointment_charts`
--
ALTER TABLE `appointment_charts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `browser`
--
ALTER TABLE `browser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `browser_logs`
--
ALTER TABLE `browser_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `client_profile`
--
ALTER TABLE `client_profile`
  MODIFY `client_profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `establishments`
--
ALTER TABLE `establishments`
  MODIFY `establishments_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `establisment_payments`
--
ALTER TABLE `establisment_payments`
  MODIFY `payments_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `log_qr`
--
ALTER TABLE `log_qr`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `money_accumulated`
--
ALTER TABLE `money_accumulated`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `money_report`
--
ALTER TABLE `money_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `monthly_client`
--
ALTER TABLE `monthly_client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `qrcodes`
--
ALTER TABLE `qrcodes`
  MODIFY `qr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
