-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2023 at 11:44 PM
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
-- Database: `floodranger`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_table`
--

CREATE TABLE `address_table` (
  `id` int(11) NOT NULL,
  `address_id` varchar(50) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `municipality` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `priority_id` int(11) NOT NULL,
  `evacuation_id` varchar(50) NOT NULL,
  `device_covered_by` text NOT NULL,
  `addr_mapping_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address_table`
--

INSERT INTO `address_table` (`id`, `address_id`, `barangay`, `municipality`, `province`, `priority_id`, `evacuation_id`, `device_covered_by`, `addr_mapping_name`) VALUES
(1, 'ADR01', 'Anonas', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD02', 'anonas'),
(2, 'ADR02', 'Bactad East', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'bactad_east'),
(3, 'ADR03', 'Bayaoas', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'bayaoas'),
(4, 'ADR04', 'Bolaoen', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'bolaoen'),
(5, 'ADR05', 'Cabaruan', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD04', 'cabaruan'),
(6, 'ADR06', 'Cabuloan', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'cabuloan'),
(7, 'ADR07', 'Camanang', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'camanang'),
(8, 'ADR08', 'Camantiles', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD02', 'camantiles'),
(9, 'ADR08', 'Camantiles', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD03', 'camantiles'),
(10, 'ADR09', 'Casantaan', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'casantaan'),
(11, 'ADR10', 'Catablan', 'Urdaneta', 'Pangasinan', 3, 'EVAC01', 'URDFLD04', 'catablan'),
(12, 'ADR11', 'Cayambanan', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD02', 'cayambanan'),
(13, 'ADR11', 'Cayambanan', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'cayambanan'),
(14, 'ADR12', 'Consolacion', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'consolacion'),
(15, 'ADR13', 'Dilan Paurido', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'dilan_paurido'),
(16, 'ADR14', 'Dr. Pedro T. Orata', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'pedro_orata'),
(17, 'ADR15', 'Labit Proper', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD04', 'labit_proper'),
(18, 'ADR16', 'Labit West', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD04', 'labit_west'),
(19, 'ADR17', 'Mabanogbog', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD02', 'mabanogbog'),
(20, 'ADR17', 'Mabanogbog', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'mabanogbog'),
(21, 'ADR18', 'Macalong', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'macalong'),
(22, 'ADR19', 'Nancalobasaan', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'nancalobasaan'),
(23, 'ADR20', 'Nancamaliran East', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'nancamaliran_east'),
(24, 'ADR21', 'Nancamaliran West', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'nancamaliran_west'),
(25, 'ADR22', 'Nancayasan', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'nancayasan'),
(26, 'ADR23', 'Oltama', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD04', 'oltama'),
(27, 'ADR24', 'Palina East', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD04', 'palina_east'),
(28, 'ADR25', 'Palina West', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD03', 'palina_west'),
(29, 'ADR26', 'Pinmaludpod', 'Urdaneta', 'Pangasinan', 3, 'EVAC01', 'URDFLD04', 'pinmaludpod'),
(30, 'ADR27', 'Poblacion', 'Urdaneta', 'Pangasinan', 2, 'EVAC01', 'URDFLD01', 'poblacion'),
(31, 'ADR28', 'San Jose', 'Urdaneta', 'Pangasinan', 3, 'EVAC01', 'URDFLD04', 'san_jose'),
(32, 'ADR29', 'San Vicente', 'Urdaneta', 'Pangasinan', 2, 'EVAC01', 'URDFLD02', 'san_vicente'),
(33, 'ADR29', 'San Vicente', 'Urdaneta', 'Pangasinan', 2, 'EVAC01', 'URDFLD01', 'san_vicente'),
(34, 'ADR30', 'Santa Lucia', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD02', 'sta_lucia'),
(35, 'ADR30', 'Santa Lucia', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD02', 'sta_lucia'),
(36, 'ADR31', 'Santo Domingo', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'sto_domingo'),
(37, 'ADR32', 'Sugcong', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD04', 'sugcong'),
(38, 'ADR33', 'Tipuso', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD01', 'tipuso'),
(39, 'ADR34', 'Tulong', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD03', 'tulong'),
(40, 'ADR34', 'Tulong', 'Urdaneta', 'Pangasinan', 1, 'EVAC01', 'URDFLD02', 'tulong');

-- --------------------------------------------------------

--
-- Table structure for table `alert_adapter`
--

CREATE TABLE `alert_adapter` (
  `id` int(11) NOT NULL,
  `is_sms_sender_recognized` varchar(10) NOT NULL,
  `is_email_sender_recognized` varchar(10) NOT NULL,
  `frm_device_api_key` varchar(50) NOT NULL,
  `alert_remark_id` varchar(20) NOT NULL,
  `is_sms_sender_success` varchar(10) NOT NULL,
  `sms_sender_api_key` varchar(200) NOT NULL DEFAULT 'NOT_PRESENT',
  `is_email_sender_success` varchar(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alert_adapter`
--

INSERT INTO `alert_adapter` (`id`, `is_sms_sender_recognized`, `is_email_sender_recognized`, `frm_device_api_key`, `alert_remark_id`, `is_sms_sender_success`, `sms_sender_api_key`, `is_email_sender_success`, `timestamp`, `is_active`) VALUES
(61, 'no', 'yes', 'URDFLD01', 'FLDLVLA', 'no', 'NOT_PRESENT', 'done', '2023-01-31 09:29:15', 0),
(62, 'no', 'yes', 'URDFLD01', 'FLDLVLB', 'no', 'NOT_PRESENT', 'done', '2023-01-31 09:29:24', 0),
(63, 'no', 'yes', 'URDFLD01', 'FLDLVLC', 'no', 'NOT_PRESENT', 'done', '2023-01-31 09:29:29', 0),
(64, 'no', 'yes', 'URDFLD01', 'FLDLVLA', 'no', 'NOT_PRESENT', 'done', '2023-01-31 20:53:02', 0),
(65, 'no', 'yes', 'URDFLD01', 'FLDLVLA', 'no', 'NOT_PRESENT', 'done', '2023-02-01 06:33:57', 0),
(66, 'no', 'yes', 'URDFLD01', 'FLDLVLB', 'no', 'NOT_PRESENT', 'done', '2023-02-01 06:37:35', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `email` tinytext NOT NULL,
  `phone_number` text NOT NULL,
  `contact_name` tinytext NOT NULL,
  `address_id` tinytext NOT NULL,
  `assoc_user_id` int(11) NOT NULL DEFAULT 1,
  `is_permitted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `email`, `phone_number`, `contact_name`, `address_id`, `assoc_user_id`, `is_permitted`) VALUES
(53, '', '2535', '5353', 'ADR01', 1, 0),
(54, '', '535353', '525252', 'ADR01', 1, 0),
(55, '', '52353', '5353', 'ADR01', 1, 0),
(57, '', '6547567657', '525252', 'ADR01', 1, 1),
(58, '', 'kfzmjfvpeapnxxnace@kvhrw.com', 'lvf14242@nezid.com', 'ADR01', 1, 0),
(59, '', '9042342', 'None', 'ADR06', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `device_api_key` tinytext NOT NULL,
  `authorized_user_id` int(11) NOT NULL,
  `module_name` tinytext NOT NULL,
  `module_type` varchar(50) NOT NULL,
  `module_description` text NOT NULL,
  `module_location` text NOT NULL,
  `sync_type` varchar(50) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `device_api_key`, `authorized_user_id`, `module_name`, `module_type`, `module_description`, `module_location`, `sync_type`, `last_update`) VALUES
(1, 'URDFLD01', 1, 'Macalong river', 'floodMon', 'River monitoring in macalong river', 'Urdaneta', 'realtime', '2023-01-26 15:01:45'),
(2, 'URDFLD02', 1, 'Mitura river', 'floodMon', 'River monitoring in mitura river', 'Urdaneta', 'realtime', '2023-01-26 15:01:50'),
(3, 'URDFLD03', 1, 'Tagamusing river', 'floodMon', 'River monitoring in tagamusing river', 'Urdaneta', 'realtime', '2023-01-26 15:01:54'),
(4, 'URDFLD04', 1, 'Sinocalan river', 'floodMon', 'Sinocalan river monitoring', 'Urdaneta', 'realtime', '2022-12-01 17:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `device_overflow_status`
--

CREATE TABLE `device_overflow_status` (
  `id` int(11) NOT NULL,
  `device_api_key` varchar(255) NOT NULL,
  `is_overflow` tinyint(1) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `device_overflow_status`
--

INSERT INTO `device_overflow_status` (`id`, `device_api_key`, `is_overflow`, `timestamp`) VALUES
(1, 'URDFLD01', 0, '2022-12-10 13:57:29'),
(2, 'URDFLD02', 0, '2022-12-06 03:58:05'),
(3, 'URDFLD03', 0, '2022-12-06 03:58:08'),
(4, 'URDFLD04', 0, '2022-12-06 03:58:11');

-- --------------------------------------------------------

--
-- Table structure for table `email_req_login_token`
--

CREATE TABLE `email_req_login_token` (
  `id` int(11) NOT NULL,
  `req_token_id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `email_verify_token`
--

CREATE TABLE `email_verify_token` (
  `id` int(11) NOT NULL,
  `auth_token_id` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `evacuation`
--

CREATE TABLE `evacuation` (
  `id` int(11) NOT NULL,
  `evac_id` tinytext NOT NULL,
  `evacuation_center_name` varchar(100) NOT NULL,
  `evacuation_center_location` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evacuation`
--

INSERT INTO `evacuation` (`id`, `evac_id`, `evacuation_center_name`, `evacuation_center_location`) VALUES
(1, 'EVAC01', 'URDANETA CULTURAL CENTER', 'URD PANGASINAN');

-- --------------------------------------------------------

--
-- Table structure for table `flood_alert_email`
--

CREATE TABLE `flood_alert_email` (
  `id` int(11) NOT NULL,
  `email_alert_id` text NOT NULL,
  `email_message` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flood_alert_email`
--

INSERT INTO `flood_alert_email` (`id`, `email_alert_id`, `email_message`) VALUES
(1, 'EMAILFLDA1', '            <p><span style=\"font-size: 24px;\"><b>Flood alert level 1 Yellow alert level</b></span></p><p>Maging alerto sa possibleng baha lalo na sa mababang lugar. Manatiling nakatututok sa official na news tungkol sa maaring baha at paglakas ng ulan.</p>'),
(2, 'EMAILFLDA2', '        <h1><span style=\"font-size: 24px;\"><font color=\"#000000\">Flood alert level 2 : Orange alert</font></span></h1><h1><span style=\"font-size: 14px;\">Maging alerto sa possibleng pagtaas ng baha lalo na sa mababang lugar. Maging maingat at maghintay ng kaukulang abiso sa awtoridad para sa evacuation</span></h1>'),
(3, 'EMAILFLDA3', '    <p style=\"text-align: left;\"><b><font color=\"#000000\"><span style=\"font-size: 24px;\">Floodranger Alert level 3 red alert</span></font></b></p><p style=\"\">Kung nakakaranas na ng baha. Inirerekomenda na lumikas na sa malapit na evacuation area.Possibleng mawalan ng kuryente ay inaasahan sa loob ng 24 oras. Maging maingat.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `flood_alert_levels`
--

CREATE TABLE `flood_alert_levels` (
  `id` int(11) NOT NULL,
  `sms_alert_id` varchar(50) NOT NULL,
  `email_alert_id` varchar(50) NOT NULL,
  `alert_remark_id` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flood_alert_levels`
--

INSERT INTO `flood_alert_levels` (`id`, `sms_alert_id`, `email_alert_id`, `alert_remark_id`) VALUES
(1, 'SMSFLDA1', 'EMAILFLDA1', 'FLDLVLA'),
(2, 'SMSFLDA2', 'EMAILFLDA2', 'FLDLVLB'),
(3, 'SMSFLDA3', 'EMAILFLDA3', 'FLDLVLC');

-- --------------------------------------------------------

--
-- Table structure for table `flood_alert_sms`
--

CREATE TABLE `flood_alert_sms` (
  `id` int(11) NOT NULL,
  `sms_alert_id` text NOT NULL,
  `sms_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flood_alert_sms`
--

INSERT INTO `flood_alert_sms` (`id`, `sms_alert_id`, `sms_message`) VALUES
(1, 'SMSFLDA1', 'Floodranger Alert level 1 yellow alerts: Maging alerto sa possibleng baha lalo na sa mababang lugar.'),
(2, 'SMSFLDA2', 'Floodranger Alert level 2 orange alert: Maging alerto sa possibleng pagtaas ng baha lalo na sa mababang lugar.'),
(3, 'SMSFLDA3', 'Floodranger Alert level 3 red alert: Kung nakakaranas  na ng baha. Inirerekomenda na lumikas na sa malapit na evacuation area.');

-- --------------------------------------------------------

--
-- Table structure for table `flood_sensor_alerts_cm`
--

CREATE TABLE `flood_sensor_alerts_cm` (
  `id` int(11) NOT NULL,
  `sensor_id` varchar(50) NOT NULL,
  `alert_a` int(11) DEFAULT NULL,
  `alert_b` int(11) DEFAULT NULL,
  `alert_c` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flood_sensor_alerts_cm`
--

INSERT INTO `flood_sensor_alerts_cm` (`id`, `sensor_id`, `alert_a`, `alert_b`, `alert_c`) VALUES
(1, 'URDULTRSNR01', NULL, NULL, NULL),
(2, 'URDULTRSNR02', NULL, NULL, NULL),
(3, 'URDULTRSNR03', NULL, NULL, NULL),
(4, 'URDULTRSNR04', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification_table`
--

CREATE TABLE `notification_table` (
  `id` int(11) NOT NULL,
  `device_api_key` tinytext NOT NULL,
  `notification_title` tinytext NOT NULL,
  `notification_body` tinytext NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `id` int(11) NOT NULL,
  `pref_id` varchar(50) NOT NULL,
  `pref_desc` varchar(200) NOT NULL,
  `pref_val` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`id`, `pref_id`, `pref_desc`, `pref_val`) VALUES
(1, 'PREFHRINTERVAL', 'Hour interaval in offsetting alerts', '5'),
(2, 'SMSTOKENTRACCAR', 'Sms token traccar', 'ejMeOhsPQSiN5M7pMjdfXn:APA91bE6c42wnKrr80p-dpXcOPYEGA3jiVreo5VOFrWC1qhUhiyN_woKo2z-XdyB3-2dsVnbjRUdoQaXpZFBsFGlobRsBTstQotoH0Z-3AEQn8Rs6J8PtsIKvNR1KHzbSXGFJfQJr-fV');

-- --------------------------------------------------------

--
-- Table structure for table `sensor_logs`
--

CREATE TABLE `sensor_logs` (
  `id` int(11) NOT NULL,
  `sensor_id` varchar(50) NOT NULL,
  `sensor_value` int(11) DEFAULT NULL,
  `remarks_id` varchar(50) NOT NULL,
  `timestamps` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sensor_logs`
--

INSERT INTO `sensor_logs` (`id`, `sensor_id`, `sensor_value`, `remarks_id`, `timestamps`, `is_active`) VALUES
(1, 'URDULTRSNR01', 25, 'FLDNRML', '2023-02-01 06:33:47', 0),
(2, 'URDULTRSNR02', NULL, 'FLDNRML', '2023-01-31 20:42:52', 1),
(3, 'URDULTRSNR03', NULL, 'FLDNRML', '2023-01-31 20:42:52', 1),
(4, 'URDULTRSNR04', NULL, 'FLDNRML', '2023-01-31 20:42:52', 1),
(862, 'URDULTRSNR01', NULL, 'FLDNRML', '2023-01-31 20:53:02', 1),
(863, 'URDULTRSNR01', 26, 'FLDLVLA', '2023-02-01 06:33:57', 0),
(864, 'URDULTRSNR01', 27, 'FLDLVLB', '2023-02-01 06:37:35', 0),
(865, 'URDULTRSNR01', 25, 'FLDNRML', '2023-01-31 20:53:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sensor_profiles`
--

CREATE TABLE `sensor_profiles` (
  `id` int(11) NOT NULL,
  `sensor_id` varchar(50) NOT NULL,
  `device_api_key` varchar(50) NOT NULL,
  `sensor_desc` varchar(50) NOT NULL,
  `sensor_type` varchar(50) NOT NULL,
  `sensor_val_unit` varchar(10) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sensor_profiles`
--

INSERT INTO `sensor_profiles` (`id`, `sensor_id`, `device_api_key`, `sensor_desc`, `sensor_type`, `sensor_val_unit`, `updated_at`) VALUES
(1, 'URDULTRSNR01', 'URDFLD01', 'Flood monitoring sensor in Macalong river', 'ultrasonic', 'cm', '2022-10-20 12:17:25'),
(4, 'URDULTRSNR02', 'URDFLD02', 'Flood monitoring sensor in Mitura river', 'ultrasonic', 'cm', '2022-10-19 02:40:26'),
(5, 'URDULTRSNR03', 'URDFLD03', 'Flood monitoring sensor logs in Tagamusing river', 'ultrasonic', 'cm', '2022-12-01 17:35:41'),
(6, 'URDULTRSNR04', 'URDFLD04', 'Flood monitoring sensor logs in Sinocalan river', 'ultrasonic', 'cm', '2022-10-22 18:07:47');

-- --------------------------------------------------------

--
-- Table structure for table `sensor_val_remarks`
--

CREATE TABLE `sensor_val_remarks` (
  `id` int(11) NOT NULL,
  `remark_id` varchar(50) NOT NULL,
  `remark_description` varchar(50) NOT NULL,
  `remark_color` varchar(50) NOT NULL,
  `priority_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sensor_val_remarks`
--

INSERT INTO `sensor_val_remarks` (`id`, `remark_id`, `remark_description`, `remark_color`, `priority_id`) VALUES
(1, 'FLDNRML', 'Normal water level', '#187498', 1),
(2, 'FLDLVLA', 'Flood yellow allert', '#FFB200', 2),
(3, 'FLDLVLB', 'Flood orange alert', '#FF731D', 3),
(4, 'FLDLVLC', 'Flood red alert', '#B73E3E', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sms_messages_queue`
--

CREATE TABLE `sms_messages_queue` (
  `id` int(11) NOT NULL,
  `queue_message_id` varchar(50) NOT NULL,
  `alert_adapter_id` int(11) NOT NULL,
  `queue_message_txt` varchar(300) NOT NULL,
  `is_done_sending` tinyint(1) NOT NULL,
  `is_recog_by_device` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sms_messages_queue`
--

INSERT INTO `sms_messages_queue` (`id`, `queue_message_id`, `alert_adapter_id`, `queue_message_txt`, `is_done_sending`, `is_recog_by_device`, `created_at`, `updated_at`) VALUES
(49, '63d8df6b6e9d7', 61, 'Floodranger Alert level 1 yellow alerts: Maging alerto sa possibleng baha lalo na sa mababang lugar.', 0, 0, '2023-01-31 09:29:15', '2023-01-31 09:29:15'),
(50, '63d8df742a611', 62, 'Floodranger Alert level 2 orange alert: Maging alerto sa possibleng pagtaas ng baha lalo na sa mababang lugar.', 0, 0, '2023-01-31 09:29:24', '2023-01-31 09:29:24'),
(51, '63d8df7922458', 63, 'Floodranger Alert level 3 red alert: Kung nakakaranas  na ng baha. Inirerekomenda na lumikas na sa malapit na evacuation area.', 0, 0, '2023-01-31 09:29:29', '2023-01-31 09:29:29'),
(52, '63d97faecb6fb', 64, 'Floodranger Alert level 1 yellow alerts: Maging alerto sa possibleng baha lalo na sa mababang lugar.', 0, 0, '2023-01-31 20:53:02', '2023-01-31 20:53:02'),
(53, '63da07d621f12', 65, 'Floodranger Alert level 1 yellow alerts: Maging alerto sa possibleng baha lalo na sa mababang lugar.', 0, 0, '2023-02-01 06:33:58', '2023-02-01 06:33:58'),
(54, '63da08afc792e', 66, 'Floodranger Alert level 2 orange alert: Maging alerto sa possibleng pagtaas ng baha lalo na sa mababang lugar.', 0, 0, '2023-02-01 06:37:35', '2023-02-01 06:37:35');

-- --------------------------------------------------------

--
-- Table structure for table `sms_numbers_queue`
--

CREATE TABLE `sms_numbers_queue` (
  `id` int(11) NOT NULL,
  `queue_message_id` varchar(50) NOT NULL,
  `queue_phone_number` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `traccar_sms_devices`
--

CREATE TABLE `traccar_sms_devices` (
  `id` int(11) NOT NULL,
  `sms_device_id` varchar(255) NOT NULL,
  `sms_device_name` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `traccar_sms_devices`
--

INSERT INTO `traccar_sms_devices` (`id`, `sms_device_id`, `sms_device_name`, `timestamp`) VALUES
(1, 'SMS01TRACCAR', 'Sms gateway 1', '2023-01-17 06:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_credentials`
--

CREATE TABLE `user_credentials` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `name` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `is_email_verified` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_credentials`
--

INSERT INTO `user_credentials` (`id`, `role_name`, `name`, `email`, `password`, `is_email_verified`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'urdroot', 'Fadmin', 'Fpass', 1, 1, '2022-04-17 00:16:32', '2023-01-19 15:07:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_table`
--
ALTER TABLE `address_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alert_adapter`
--
ALTER TABLE `alert_adapter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_overflow_status`
--
ALTER TABLE `device_overflow_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_req_login_token`
--
ALTER TABLE `email_req_login_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_verify_token`
--
ALTER TABLE `email_verify_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evacuation`
--
ALTER TABLE `evacuation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flood_alert_email`
--
ALTER TABLE `flood_alert_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flood_alert_levels`
--
ALTER TABLE `flood_alert_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flood_alert_sms`
--
ALTER TABLE `flood_alert_sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flood_sensor_alerts_cm`
--
ALTER TABLE `flood_sensor_alerts_cm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_table`
--
ALTER TABLE `notification_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensor_logs`
--
ALTER TABLE `sensor_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensor_profiles`
--
ALTER TABLE `sensor_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensor_val_remarks`
--
ALTER TABLE `sensor_val_remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_messages_queue`
--
ALTER TABLE `sms_messages_queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_numbers_queue`
--
ALTER TABLE `sms_numbers_queue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `traccar_sms_devices`
--
ALTER TABLE `traccar_sms_devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_credentials`
--
ALTER TABLE `user_credentials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_table`
--
ALTER TABLE `address_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `alert_adapter`
--
ALTER TABLE `alert_adapter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `device_overflow_status`
--
ALTER TABLE `device_overflow_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `email_req_login_token`
--
ALTER TABLE `email_req_login_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_verify_token`
--
ALTER TABLE `email_verify_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `evacuation`
--
ALTER TABLE `evacuation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `flood_alert_email`
--
ALTER TABLE `flood_alert_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `flood_alert_levels`
--
ALTER TABLE `flood_alert_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `flood_alert_sms`
--
ALTER TABLE `flood_alert_sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `flood_sensor_alerts_cm`
--
ALTER TABLE `flood_sensor_alerts_cm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notification_table`
--
ALTER TABLE `notification_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sensor_logs`
--
ALTER TABLE `sensor_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=866;

--
-- AUTO_INCREMENT for table `sensor_profiles`
--
ALTER TABLE `sensor_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sensor_val_remarks`
--
ALTER TABLE `sensor_val_remarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sms_messages_queue`
--
ALTER TABLE `sms_messages_queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `sms_numbers_queue`
--
ALTER TABLE `sms_numbers_queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `traccar_sms_devices`
--
ALTER TABLE `traccar_sms_devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_credentials`
--
ALTER TABLE `user_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
