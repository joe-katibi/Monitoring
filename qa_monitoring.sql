-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2023 at 05:15 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qa_monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `alert_forms`
--

CREATE TABLE `alert_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `agent_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qa_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fatal_error` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor_comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qa_signature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_by_qa` datetime NOT NULL,
  `supervisor_signature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_by_supervisor` datetime NOT NULL,
  `agent_signature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_by_agent` datetime NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `answer_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answer_name`, `answer_id`, `created_at`, `updated_at`) VALUES
(1, 'A', '1', NULL, NULL),
(2, 'B', '2', NULL, NULL),
(3, 'C', '3', NULL, NULL),
(4, 'D', '4', NULL, NULL),
(5, 'E', '5', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `answer_keys`
--

CREATE TABLE `answer_keys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `a_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `call_ratings`
--

CREATE TABLE `call_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `call_ratings`
--

INSERT INTO `call_ratings` (`id`, `rating_name`, `rating_id`, `created_at`, `updated_at`) VALUES
(1, 'Best', '1', NULL, NULL),
(2, 'Worst', '2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `call_trackers`
--

CREATE TABLE `call_trackers` (
  `id` int(11) NOT NULL,
  `call_tracker` varchar(255) NOT NULL,
  `service_id` varchar(255) DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `call_trackers`
--

INSERT INTO `call_trackers` (`id`, `call_tracker`, `service_id`, `category_id`) VALUES
(1, 'AAR ESCALATIONS', NULL, NULL),
(2, 'APPOINTMENTS', NULL, NULL),
(3, 'AREA OUTAGE', NULL, NULL),
(4, 'BILLING ISSUSE', NULL, NULL),
(5, 'CURRENT OFFERS', NULL, NULL),
(6, 'DROPPED CHANNELS', NULL, NULL),
(7, 'DTH CALL DIVERTED', NULL, NULL),
(8, 'SLOW SPEEDS', NULL, NULL),
(9, 'SLOW SPEEDS', NULL, NULL),
(10, 'SLOW SPEEDS', NULL, NULL),
(11, 'SLOW SPEEDS', NULL, NULL),
(12, 'SLOW SPEEDS', NULL, NULL),
(13, 'Smart Tv', NULL, NULL),
(14, 'Smart Tv', NULL, NULL),
(15, 'Smart Tv', NULL, NULL),
(16, 'Smart Tv', NULL, NULL),
(17, 'Account number inquiry', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 'Cable Billing', '1', NULL, NULL),
(2, 'Cable Churn', '1', NULL, NULL),
(3, 'Cable Digital', '1', NULL, NULL),
(4, 'Cable Inbound', '1', NULL, NULL),
(5, 'Cable Outbound', '1', NULL, NULL),
(6, 'Cable Shops', '1', NULL, NULL),
(7, 'Cable Service Support', '1', NULL, NULL),
(8, 'Cable Live Calls', '1', NULL, NULL),
(9, 'Cable Escalation Matrix', '1', NULL, NULL),
(10, 'Cable Welcome calls', '1', NULL, NULL),
(11, 'DTH Billing', '2', NULL, NULL),
(12, 'DTH Churn', '2', NULL, NULL),
(13, 'DTH Digital', '2', NULL, NULL),
(14, 'DTH Inbound', '2', NULL, NULL),
(15, 'DTH Outbound', '2', NULL, NULL),
(16, 'DTH Shops', '2', NULL, NULL),
(17, 'DTH Service Support', '2', NULL, NULL),
(18, 'DTH Live Calls', '2', NULL, NULL),
(19, 'DTH Escalation Matrix', '2', NULL, NULL),
(20, 'DTH Welcome calls', '2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `conduct_exams`
--

CREATE TABLE `conduct_exams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `schedule_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trainer_qa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completion_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conduct_exams`
--

INSERT INTO `conduct_exams` (`id`, `schedule_name`, `time`, `course`, `exam_name`, `service`, `category`, `trainer_qa`, `start_date`, `completion_date`, `created_at`, `updated_at`) VALUES
(18, 'Schedule Exams', '10:08', '1', 'Test VOIP', '1', '19', '80', '2023-01-15', '2023-01-15', '2023-01-15 16:58:40', '2023-01-15 16:58:40'),
(22, 'Schedule Exams', '23:09', '1', 'Test VOIP', '1', '18', '80', '2023-01-15', '2023-01-15', '2023-01-15 17:15:18', '2023-01-15 17:15:18'),
(24, 'Schedule Exams', '23:19', '1', 'Test VOIP', '1', '19', '80', '2023-01-15', '2023-01-15', '2023-01-15 17:19:50', '2023-01-15 17:19:50'),
(25, 'Schedule Exams', '23:21', '2', 'Test VOIP', '1', '19', '81', '2023-01-15', '2023-01-15', '2023-01-15 17:22:12', '2023-01-15 17:22:12'),
(26, 'Schedule Exams', '20:59', '3', 'GPON', '1', '1', '81', '2023-01-16', '2023-01-16', '2023-01-16 15:00:15', '2023-01-16 15:00:15'),
(27, 'Schedule Exams', '22:25', '4', 'types of Modems', '1', '6', '80', '2023-01-16', '2023-01-16', '2023-01-16 16:26:23', '2023-01-16 16:26:23'),
(39, 'Schedule Exams', '22:27', '5', 'RX', '1', '8', '80', '2023-01-16', '2023-01-16', '2023-01-16 16:56:12', '2023-01-16 16:56:12'),
(40, 'Schedule Exams', '22:57', '6', 'DTH TEST', '2', '19', '80', '2023-01-16', '2023-01-16', '2023-01-16 16:57:26', '2023-01-16 16:57:26'),
(48, 'Schedule Exams', '23:00', '6', 'panodic', '2', '14', '81', '2023-01-16', '2023-01-16', '2023-01-16 17:14:10', '2023-01-16 17:14:10'),
(49, 'Schedule Exams', '12:17', '1', 'Voip 2', '1', '18', '80', '2023-01-20', '2023-01-20', '2023-01-20 06:19:31', '2023-01-20 06:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 'Kenya', '1', NULL, NULL),
(2, 'Uganda', '2', NULL, NULL),
(3, 'Tanzania', '3', NULL, NULL),
(4, 'Malawi', '4', NULL, NULL),
(5, 'Zambia', '5', NULL, NULL),
(6, 'Global', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `service_id`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'Voip', NULL, NULL, NULL, NULL),
(2, 'HFC TV', NULL, NULL, NULL, NULL),
(3, 'GPON TV', NULL, NULL, NULL, NULL),
(4, 'HFC Internet', NULL, NULL, NULL, NULL),
(5, 'GPON internet', NULL, NULL, NULL, NULL),
(6, 'DTH TV', NULL, NULL, NULL, NULL),
(7, 'Billing', NULL, NULL, NULL, NULL),
(8, 'VOIP', NULL, NULL, NULL, NULL),
(9, 'Slow Speeds', NULL, NULL, NULL, NULL),
(10, 'Port Forwarding', NULL, NULL, NULL, NULL),
(11, 'Smart TV', NULL, '2023-01-15 07:57:46', '2023-01-15 07:57:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exams_questions`
--

CREATE TABLE `exams_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service` tinyint(1) NOT NULL,
  `question_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_c` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer_d` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams_questions`
--

INSERT INTO `exams_questions` (`id`, `service`, `question_weight`, `course`, `answer_key`, `question`, `answer_a`, `answer_b`, `answer_c`, `answer_d`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, '5', '1', '1', '<p>What is the price for a cordless phone?</p>', '<p>Ksh1500</p>', '<p>ksh1600</p>', '<p>ksh450</p>', '<p>ksh 750</p>', NULL, NULL, NULL),
(2, 1, '2', '7', '2', '<p>What is billing Cycle?</p>', '<p>a day before disconnection</p>', '<p>Disconnection date</p>', '<p>Due day</p>', '<p>28</p>', NULL, NULL, NULL),
(3, 2, '5', '6', '2', '<p>Define DTH?</p>', '<p>Direct Connect Home</p>', '<p>Direct To Home</p>', '<p>Dish To Home</p>', '<p>Decoder to Home</p>', NULL, '2023-01-15 08:08:14', '2023-01-15 08:08:14'),
(4, 1, '6', '1', '2', '<p>List down the type of Voip Phones we have?</p>', '<p>M2, M3, MD4, CVT</p>', '<p>PH1,PH2.PH3,PH4,PH5</p>', '<p>Panasonic, Sagem, Castlenet, dlink</p>', '<p>None of the above</p>', NULL, '2023-01-20 06:16:58', '2023-01-20 06:16:58');

-- --------------------------------------------------------

--
-- Table structure for table `exam_statuses`
--

CREATE TABLE `exam_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `schedule_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_statuses`
--

INSERT INTO `exam_statuses` (`id`, `schedule_id`, `exam_id`, `status`, `category_id`, `service_id`, `created_at`, `updated_at`) VALUES
(2, 'EXM-00000', '22', '1', NULL, NULL, '2023-01-15 17:15:18', '2023-01-15 17:15:18'),
(3, 'EXM-00001', '24', '1', NULL, NULL, '2023-01-15 17:19:50', '2023-01-15 17:19:50'),
(4, 'EXM-00002', '25', '1', NULL, NULL, '2023-01-15 17:22:12', '2023-01-15 17:22:12'),
(5, 'EXM-00003', '26', '1', NULL, NULL, '2023-01-16 15:00:15', '2023-01-16 15:00:15'),
(6, 'EXM-00000', '27', '1', NULL, NULL, '2023-01-16 16:26:23', '2023-01-16 16:26:23'),
(7, 'EXM-00000', '40', '1', NULL, NULL, '2023-01-16 16:57:26', '2023-01-16 16:57:26'),
(8, 'EXM-00000', '48', '1', NULL, NULL, '2023-01-16 17:14:10', '2023-01-16 17:14:10'),
(9, 'EXM-00000', '49', '1', NULL, NULL, '2023-01-20 06:19:31', '2023-01-20 06:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fiber_welcome_questions`
--

CREATE TABLE `fiber_welcome_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `number` tinyint(1) NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summarized` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fiber_welcome_questions`
--

INSERT INTO `fiber_welcome_questions` (`id`, `number`, `question`, `summarized`, `yes`, `no`, `service`, `category`, `created_at`, `updated_at`) VALUES
(1, 1, 'Standard Salutation Template', 'Salutation', '7', '0', '1', '1', NULL, NULL),
(2, 2, 'Responds to mails in a timely manner( TAT 2hrs).', 'TAT', '8', '0', '1', '1', NULL, NULL),
(3, 3, 'Checks and verifies all the information on the customer\'s services. In case of a site visit, should follow direction of any alert pertaining to the customer. Counter check previous notes or historical information on the customers account.', 'Check Historical data', '8', '0', '1', '1', NULL, NULL),
(4, 4, 'Notes on all Systems - BH, Presence and CRM The CSR ensures to select the appropriate category, proper spelling, grammar and includes a written note with an ISSUE and ACTION.', 'Dispositioning', '10', '0', '1', '1', NULL, NULL),
(5, 5, 'Standard Closing and signoff - Using Company signature and titles and contacts', 'Standard Closing and Signoff', '10', '0', '1', '1', NULL, NULL),
(6, 6, 'Courtesy: Polite and professional at all times. apologizes/Show empathy towards the customers.', 'Empathy', '7', '0', '1', '1', NULL, NULL),
(7, 7, 'Takes ownership/expresses willingness to help the customer and does not blame other departments/agents for the work not excecuted.', 'Ownership', '7', '0', '1', '1', NULL, NULL),
(8, 8, 'Communication: Converses in a clear manner, using appropriate grammar and a proper tone. . Avoids using jargon and technical language with the customer.', 'Communication:', '6', '0', '1', '1', NULL, NULL),
(9, 9, 'Follows accurate steps while troubleshooting using the correct rebuttals at all times and escalate using the appropriate channel while informing the customer. Escalates to the appropriate department/ team.', 'Troubleshooting Steps', '10', '0', '1', '1', NULL, NULL),
(10, 10, 'If unsuccessful, is the right work order raised? Checks with the customers\' schedule, Correct phone number together with the alternate number, exact location with the landmarks and name of the estate.', 'Work order process', '10', '0', '1', '1', NULL, NULL),
(11, 11, 'Products/Services: CSR answers questions with confidence, has knowledge of all products/services. Gives accurate and precise information to the customer.', 'Product Knowledge', '10', '0', '1', '1', NULL, NULL),
(12, 12, 'Rebuttals: Educate the customer while referring to the appropriate rebuttals in scripts/ Procesess for Billing issues, Suspension, Termination, HFC Internet/TV, VOIP, Metro Ethernet, GPON, Wimax, Emails domains, ETC.', 'Rebuttals', '10', '0', '1', '1', NULL, NULL),
(13, 1, 'Standard Opening Script (Greeting -Good Morning/Afternoon/Evening my name is ------I am calling you from Zuku Customer Relations)', 'Salutation', '7', '0', '1', '2', NULL, NULL),
(14, 2, 'Closing :Is there anything else I can do for you?/ Thank you for your time/Feeback , have a good day/Afternoon/Evening.', 'Closing', '8', '0', '1', '2', NULL, NULL),
(15, 3, 'Inform client on reason for calling.', 'Reason for Calling', '8', '0', '1', '2', NULL, NULL),
(16, 4, 'Courtesy: Polite and professional at all times. apologizes/Show empathy towards the customers.', 'Courtesy', '10', '0', '1', '2', NULL, NULL),
(17, 5, 'Takes ownership/expresses willingness to help the customer and does not blame other departments/agents for the work not excecuted.', 'Takes ownership', '10', '0', '1', '2', NULL, NULL),
(18, 6, 'Communication: Converses in a clear manner, using appropriate grammar and a proper tone. . Avoids using jargon and technical language with the customer..', 'Converses in a clear manner', '7', 'Auto Fail', '1', '2', NULL, NULL),
(19, 7, 'Ability to convince the customer.', 'Ability to convince the customer.', '7', '0', '1', '2', NULL, NULL),
(20, 8, 'Understanding requirements and neeeds of customers and using creative upselling ideas', 'Upselling Ideas', '6', '0', '1', '2', NULL, NULL),
(21, 9, 'Ability to upgrade/downgrade or cross sell across the available packages.', 'Cross Selling packages', '10', '0', '1', '2', NULL, NULL),
(22, 10, 'Capture the customer interaction on Broadhub', 'Disposition', '10', '0', '1', '2', NULL, NULL),
(23, 11, 'Proper Disposition/qualification of the call on Presence', 'Disposition', '10', '0', '1', '2', NULL, NULL),
(24, 12, 'Products/Services: CSR answers questions with confidence, has knowledge of all products/services. Gives accurate and precise information to the customer', 'Product Knowledge', '10', '0', '1', '2', NULL, NULL),
(25, 13, 'Educate and advise the customer while referring to the appropriate processes for Billing issues, Suspension, Termination, HFC Internet/TV, VOIP, GPON ETC', 'Customer Education', '10', '0', '1', '2', NULL, NULL),
(26, 1, 'Call opening: Audibility, Personalization, timely response, Branding, Introducing themselves', 'salutation', '5', '0', '1', '4', NULL, NULL),
(27, 2, 'Request for a/c number: Request client to confirm client\'s details. Adequate probing to know client\'s problem.', 'Account Details', '2', '0', '1', '4', NULL, NULL),
(28, 3, 'History of the a/c: Agent to Repeat calls, wrong troubleshooting, no escalation, FCR.', 'Account History', '3', '0', '1', '4', NULL, NULL),
(29, 4, 'Hold procedure & Muting: CSR requests permission from the customer to be placed on hold and upon returning \"Thank you for holding on the line. No unnecessary muting.', 'Hold procedure & Muting', '5', '0', '1', '4', NULL, NULL),
(30, 5, 'Call Flow: Agent build rapport with the client and does not have dead air in the calls', 'Call Flow', '5', '0', '1', '4', NULL, NULL),
(31, 6, 'Notes in all systems: Should include Issue, Action And VOC. Proper category, subcategory and ticket status in CRM.', 'Notes in all systems', '10', '0', '1', '4', NULL, NULL),
(32, 7, 'Notes: The CSR ensures to select the appropriate category, proper spelling, grammar and includes a written note with an ISSUE and ACTION.', 'Disposition', '5', '0', '1', '4', NULL, NULL),
(33, 8, 'Customer education : Educates clients as per nature of the call.', 'Customer education', '5', '0', '1', '4', NULL, NULL),
(34, 9, 'Ownership: No naming and blaming other departments in any conversation with clients.', 'Ownership:', '5', '0', '1', '4', NULL, NULL),
(35, 10, 'Listening skills: Does not interupt the clinet and paraphrases while conversing with the client.', 'Listening skills', '5', '0', '1', '4', NULL, NULL),
(36, 11, 'Communication: Converse in a clear manner and does not use jargon & technical terms. i.e Nodes, modem not locking, frequenting tuning, WAN blocking, FEC, etc', 'Communication', '5', '0', '1', '4', NULL, NULL),
(37, 12, 'Troubleshooting: Accurate troubleshooting done to ensure FCR is met. Agent to adhere to the correct troubleshooting processes.', 'Troubleshooting', '15', '0', '1', '4', NULL, NULL),
(38, 13, 'Agent confirms the exact location details , contact and alternative contact details from the client. Ensure they book the correct w/o.', 'Work orders', '5', '0', '1', '4', NULL, NULL),
(39, 14, 'Products, Services and Equipment: Packages, current active promos, clear understanding of ZUKU services, and types of both modems, decorders, extenders and VOIPs.', 'Products, Services and Equipment:', '5', '0', '1', '4', NULL, NULL),
(40, 15, 'FCR: Call Backs (Follow-up Calls), advising of TATs and uptime confirmation', 'FCR: Call Backs (Follow-up Calls)', '10', '0', '1', '4', NULL, NULL),
(41, 16, 'Offer further assistance.', 'Offer further assistance.', '5', '0', '1', '4', NULL, NULL),
(42, 17, 'Brands company and request to transfers call to CSAT.', 'Call closing:', '5', '0', '1', '4', NULL, NULL),
(43, 1, 'Standard Salutation Template', 'Standard Salutation', '7', '0', '1', '3', NULL, NULL),
(44, 2, 'Responds to mails in a timely manner( TAT 2hrs).', 'TAT 2hrs Chat 15 minutes', '8', '0', '1', '3', NULL, NULL),
(45, 3, 'Checks and verifies all the information on the customer\'s services. In case of a site visit, should follow direction of any alert pertaining to the customer. Counter check previous notes or historical information on the customers account.', 'Account History', '8', '0', '1', '3', NULL, NULL),
(46, 4, 'Notes on all Systems - BH and CRM, Presence The CSR ensures to select the appropriate category, proper spelling, grammar and includes a written note with an ISSUE and ACTION.', 'Disposition', '10', '0', '1', '3', NULL, NULL),
(47, 5, 'Standard Closing and signoff - Using Company signature and titles and contacts', 'Standard Closing and signoff', '10', '0', '1', '3', NULL, NULL),
(48, 6, 'Courtesy: Polite and professional at all times. apologizes/Show empathy towards the customers.', 'Courtesy', '7', '0', '1', '3', NULL, NULL),
(49, 7, 'Takes ownership/expresses willingness to help the customer and does not blame other departments/agents for the work not excecuted.', 'Takes ownership', '7', '0', '1', '3', NULL, NULL),
(50, 8, 'Communication: Converses in a clear manner, using appropriate grammar and a proper tone. . Avoids using jargon and technical language with the customer.', 'Communication', '6', '0', '1', '3', NULL, NULL),
(51, 9, 'Follows accurate steps while troubleshooting using the correct rebuttals at all times and escalate using the appropriate channel while informing the customer. Escalates to the appropriate department/ team.', 'Troubleshooting Steps', '10', '0', '1', '3', NULL, NULL),
(52, 10, 'If unsuccessful, is the right work order raised? Checks with the customers\' schedule, Correct phone number together with the alternate number, exact location with the landmarks and name of the estate.', 'Work order Process', '10', '0', '1', '3', NULL, NULL),
(53, 11, 'Products/Services: CSR answers questions with confidence, has knowledge of all products/services. Gives accurate and precise information to the customer.', 'Products/Services', '10', '0', '1', '3', NULL, NULL),
(54, 12, 'Rebuttals: Educate the customer while referring to the appropriate rebuttals in scripts/ Procesess for Billing issues, Suspension, Termination, HFC Internet/TV, VOIP, Metro Ethernet, GPON, Wimax, Emails domains, ETC.', 'Rebuttals', '10', '0', '1', '3', NULL, NULL),
(55, 1, 'Standard Salutation Template', 'Standard Salutation', '4', '0', '1', '11', NULL, NULL),
(56, 1, 'Standard Salutation Template', 'Salutation', '2', '0', '2', '14', NULL, NULL),
(57, 2, 'Confirmation of account Details', 'Account verification', '2', '0', '2', '14', '2023-01-15 10:36:22', '2023-01-15 10:36:22');

-- --------------------------------------------------------

--
-- Table structure for table `gap_summaries`
--

CREATE TABLE `gap_summaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gap_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gap_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gap_summaries`
--

INSERT INTO `gap_summaries` (`id`, `gap_title`, `gap_name`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 'Gap Summary', 'Customer education not done', NULL, '2023-01-21 10:01:52', '2023-01-21 10:01:52'),
(2, 'Gap Summary', 'call personalization not done', NULL, '2023-01-21 10:03:54', '2023-01-21 10:03:54'),
(3, 'Gap Summary', 'Further Assistance not Offered', NULL, '2023-01-21 10:04:05', '2023-01-21 10:04:05'),
(4, 'Gap Summary', 'Contacts Details verification not done', NULL, '2023-01-21 10:04:13', '2023-01-21 10:04:13'),
(5, 'Gap Summary', 'Poor Troubleshooting Steps', NULL, '2023-01-21 10:22:26', '2023-01-21 10:22:26');

-- --------------------------------------------------------

--
-- Table structure for table `issue_generals`
--

CREATE TABLE `issue_generals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_general_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue_generals`
--

INSERT INTO `issue_generals` (`id`, `name`, `issue_general_id`, `service_id`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'Agent', '1', NULL, NULL, NULL, NULL),
(2, 'technology', '2', NULL, NULL, NULL, NULL),
(3, 'Process', '3', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `live_calls`
--

CREATE TABLE `live_calls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tittle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quality_analysts` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `issue_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strength_summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `strength_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gaps_summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gaps_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voc_summary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voc_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `live_calls`
--

INSERT INTO `live_calls` (`id`, `tittle`, `account_number`, `date`, `quality_analysts`, `category`, `supervisor`, `agent`, `issue_summary`, `issue_description`, `strength_summary`, `strength_description`, `gaps_summary`, `gaps_description`, `voc_summary`, `voc_description`, `created_at`, `updated_at`) VALUES
(1, '', '12345', '2023-01-11', 'admin', '1', '#', '#', 'AREA OUTAGE', 'test 1', '5', 'test 2', '3', 's', 'Happy with Service', 'w', '2023-01-11 14:51:44', '2023-01-11 14:51:44'),
(2, '', '12345678', '2023-01-11', 'admin', '1', '#', '#', 'SLOW SPEEDS', 'clients complained of slow speeds', '5', 'agent did customer education, call personalization and confirmed account details', '3', 'further assistance not done', 'Poor Services', 'Complained of slow speeds', '2023-01-11 15:26:06', '2023-01-11 15:26:06'),
(3, '', '12324324', '2023-01-11', 'admin', '3', '#', '#', 'DROPPED CHANNELS', 'dropped', '2', 'agent did customer education', '3', 'Further assistance', 'Poor Services', 'complained', '2023-01-11 15:30:10', '2023-01-11 15:30:10'),
(4, '', '12324324', '2023-01-11', 'admin', '3', '#', '#', 'DROPPED CHANNELS', 'dropped', '2', 'agent did customer education', '3', 'Further assistance', 'Poor Services', 'complained', '2023-01-11 15:31:30', '2023-01-11 15:31:30'),
(5, '', '', '', 'admin', 'Cable Live Calls', '#', '#', '', '', '2', '', '1', '', '', '', '2023-01-11 15:32:17', '2023-01-11 15:32:17'),
(6, '', '', '', 'admin', 'Cable Live Calls', '#', '#', '', '', '2', '', '1', '', '', '', '2023-01-11 15:38:17', '2023-01-11 15:38:17'),
(7, '', '', '', 'admin', 'Cable Live Calls', '#', '#', '', '', '2', '', '1', '', '', '', '2023-01-11 15:40:19', '2023-01-11 15:40:19'),
(8, '', '', '', 'admin', 'Cable Live Calls', '#', '#', '', '', '2', '', '1', '', '', '', '2023-01-11 15:42:08', '2023-01-11 15:42:08'),
(9, '', '', '', 'admin', 'Cable Live Calls', '#', '#', '', '', '2', '', '1', '', '', '', '2023-01-11 15:42:39', '2023-01-11 15:42:39'),
(10, '', '', '', 'admin', 'Cable Live Calls', '#', '#', '', '', '2', '', '1', '', '', '', '2023-01-11 15:43:10', '2023-01-11 15:43:10'),
(11, '', '', '', 'admin', 'Cable Live Calls', '#', '#', '', '', '2', '', '1', '', '', '', '2023-01-11 15:43:52', '2023-01-11 15:43:52'),
(12, '', '', '', 'admin', 'Cable Live Calls', '#', '#', '', '', '2', '', '1', '', '', '', '2023-01-11 15:43:58', '2023-01-11 15:43:58'),
(13, '', '1212131', '2023-01-11', 'admin', '6', '#', '#', 'DTH CALL DIVERTED', '313131', '2', '21231', '1', '1131', 'Poor Services', '131313', '2023-01-11 15:57:21', '2023-01-11 15:57:21'),
(14, '', '', '', 'admin', 'Cable Live Calls', '#', '#', '', '', '2', '', '1', '', '', '', '2023-01-13 14:51:22', '2023-01-13 14:51:22'),
(16, '', '1234', '2023-01-21 11:12:30', 'admin', '19', '#', '#', 'AAR ESCALATIONS', '2143', '12', '13425', '5', '121432', 'Poor Services', 'qdqwdq', '2023-01-21 08:27:03', '2023-01-21 08:27:03'),
(17, '', '1234565', '2023-01-21 11:35:45', 'admin', '2', '#', '#', 'DROPPED CHANNELS', '1tgZGHXDM,K.L', '2', '14t', '1', 'adsfdgnh', 'Poor Services', 'ASGH', '2023-01-21 08:37:04', '2023-01-21 08:37:04'),
(18, '', '1234565', '2023-01-21 11:35:45', 'admin', '2', '#', '#', 'DROPPED CHANNELS', '1tgZGHXDM,K.L', '2', '14t', '1', 'adsfdgnh', 'Poor Services', 'ASGH', '2023-01-21 08:37:22', '2023-01-21 08:37:22'),
(19, '', '1324354675', '2023-01-21 12:30:20', 'admin', '16', '#', '#', 'DTH CALL DIVERTED', 'DdASA', '12', 'ADASDSADSAFDASFV', '1', 'ADASDAA', 'Happy with Service', 'ADASDSDFGFH', '2023-01-21 09:30:51', '2023-01-21 09:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `live_calls_results`
--

CREATE TABLE `live_calls_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `live_call_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `strength_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gaps_summary_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_16_104317_create_permission_tables', 1),
(6, '2022_11_14_130609_create_fiber_welcome_questions_table', 1),
(7, '2022_11_21_123539_create_alert_forms_table', 1),
(8, '2022_11_27_090626_create_services_table', 1),
(9, '2022_11_27_092426_create_countries_table', 1),
(10, '2022_11_27_093913_create_categories_table', 1),
(11, '2022_11_27_113704_create_positions_table', 1),
(12, '2022_12_01_174115_create_results_table', 1),
(13, '2022_12_04_171920_create_question_results_table', 2),
(14, '2022_12_16_184144_create_courses_table', 3),
(15, '2022_12_17_103905_create_answers_table', 4),
(16, '2022_12_17_111219_create_exams_questions_table', 5),
(17, '2022_12_18_123623_create_issue_general_table', 6),
(18, '2022_12_20_163618_create_call_tracker_table', 7),
(19, '2022_12_20_163618_create_call_trackers_table', 8),
(20, '2022_12_24_115859_create_sub_call_trackers_table', 9),
(21, '2022_12_18_123623_create_issue_generals_table', 10),
(22, '2023_01_02_185209_create_conduct_exams_table', 11),
(23, '2023_01_07_123736_create_live_calls_table', 12),
(24, '2023_01_10_162406_create_summaries_table', 13),
(25, '2023_01_15_184617_create_exam_status_table', 14),
(26, '2023_01_15_184617_create_exam_statuses_table', 15),
(27, '2023_01_21_105357_create_live_calls_results_table', 16),
(28, '2023_01_21_124318_create_gap_summaries_table', 17),
(29, '2023_01_21_124627_create_vo_c_summaries_table', 17),
(30, '2023_01_21_165608_create_answer_keys_table', 18),
(31, '2023_01_22_194414_create_upload_calls_table', 19),
(32, '2023_01_23_172714_create_call_ratings_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(15, 'App\\Models\\User', 6),
(15, 'App\\Models\\User', 7),
(15, 'App\\Models\\User', 8),
(15, 'App\\Models\\User', 9),
(15, 'App\\Models\\User', 10),
(15, 'App\\Models\\User', 11),
(15, 'App\\Models\\User', 12),
(15, 'App\\Models\\User', 13),
(15, 'App\\Models\\User', 14),
(15, 'App\\Models\\User', 15),
(15, 'App\\Models\\User', 16),
(15, 'App\\Models\\User', 17),
(15, 'App\\Models\\User', 18),
(15, 'App\\Models\\User', 20),
(15, 'App\\Models\\User', 21),
(15, 'App\\Models\\User', 22),
(15, 'App\\Models\\User', 23),
(15, 'App\\Models\\User', 24),
(15, 'App\\Models\\User', 33),
(15, 'App\\Models\\User', 36),
(15, 'App\\Models\\User', 37),
(15, 'App\\Models\\User', 38),
(15, 'App\\Models\\User', 39),
(15, 'App\\Models\\User', 40),
(15, 'App\\Models\\User', 41),
(15, 'App\\Models\\User', 42),
(15, 'App\\Models\\User', 43),
(15, 'App\\Models\\User', 44),
(15, 'App\\Models\\User', 45),
(15, 'App\\Models\\User', 46),
(15, 'App\\Models\\User', 47),
(15, 'App\\Models\\User', 48),
(15, 'App\\Models\\User', 49),
(15, 'App\\Models\\User', 50),
(15, 'App\\Models\\User', 51),
(15, 'App\\Models\\User', 52),
(15, 'App\\Models\\User', 53),
(15, 'App\\Models\\User', 54);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 6),
(5, 'App\\Models\\User', 7),
(5, 'App\\Models\\User', 8),
(5, 'App\\Models\\User', 9),
(5, 'App\\Models\\User', 10),
(5, 'App\\Models\\User', 11),
(5, 'App\\Models\\User', 12),
(5, 'App\\Models\\User', 13),
(5, 'App\\Models\\User', 14),
(5, 'App\\Models\\User', 15),
(5, 'App\\Models\\User', 16),
(5, 'App\\Models\\User', 17),
(5, 'App\\Models\\User', 18),
(5, 'App\\Models\\User', 20),
(5, 'App\\Models\\User', 21),
(5, 'App\\Models\\User', 22),
(5, 'App\\Models\\User', 23),
(5, 'App\\Models\\User', 24),
(5, 'App\\Models\\User', 33),
(5, 'App\\Models\\User', 36),
(5, 'App\\Models\\User', 37),
(5, 'App\\Models\\User', 38),
(5, 'App\\Models\\User', 39),
(5, 'App\\Models\\User', 40),
(5, 'App\\Models\\User', 41),
(5, 'App\\Models\\User', 42),
(5, 'App\\Models\\User', 43),
(5, 'App\\Models\\User', 44),
(5, 'App\\Models\\User', 45),
(5, 'App\\Models\\User', 46),
(5, 'App\\Models\\User', 47),
(5, 'App\\Models\\User', 48),
(5, 'App\\Models\\User', 49),
(5, 'App\\Models\\User', 50),
(5, 'App\\Models\\User', 51),
(5, 'App\\Models\\User', 52),
(5, 'App\\Models\\User', 53),
(5, 'App\\Models\\User', 54),
(5, 'App\\Models\\User', 55),
(5, 'App\\Models\\User', 56),
(5, 'App\\Models\\User', 57),
(5, 'App\\Models\\User', 58),
(5, 'App\\Models\\User', 59),
(5, 'App\\Models\\User', 60),
(5, 'App\\Models\\User', 61),
(5, 'App\\Models\\User', 62),
(5, 'App\\Models\\User', 64),
(5, 'App\\Models\\User', 65),
(5, 'App\\Models\\User', 66),
(5, 'App\\Models\\User', 67),
(5, 'App\\Models\\User', 68),
(5, 'App\\Models\\User', 69),
(5, 'App\\Models\\User', 70),
(5, 'App\\Models\\User', 71),
(5, 'App\\Models\\User', 72),
(5, 'App\\Models\\User', 73),
(5, 'App\\Models\\User', 74),
(5, 'App\\Models\\User', 75),
(5, 'App\\Models\\User', 76),
(5, 'App\\Models\\User', 77),
(5, 'App\\Models\\User', 78),
(5, 'App\\Models\\User', 79),
(5, 'App\\Models\\User', 80),
(5, 'App\\Models\\User', 81),
(5, 'App\\Models\\User', 82),
(7, 'App\\Models\\User', 55),
(7, 'App\\Models\\User', 63),
(8, 'App\\Models\\User', 56),
(8, 'App\\Models\\User', 58);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create:user', 'create user', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(2, 'read:user', 'read user', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(3, 'update:user', 'update user', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(4, 'delete:user', 'delete user', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(5, 'create:role', 'create role', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(6, 'read:role', 'read role', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(7, 'update:role', 'update role', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(8, 'delete:role', 'delete role', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(9, 'create:permission', 'create permission', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(10, 'read:permission', 'read permission', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(11, 'update:permission', 'update permission', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(12, 'delete:permission', 'delete permission', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(13, 'read:admin', 'read admin', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(14, 'update:admin', 'update admin', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(15, 'N/A', 'N/A', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `name`, `position_id`, `created_at`, `updated_at`) VALUES
(1, 'Agent', '1', NULL, NULL),
(2, 'Supervisor', '2', NULL, NULL),
(3, 'Quality Analyst', '3', NULL, NULL),
(4, 'Trainer', '4', NULL, NULL),
(5, 'System Admin', '5', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_results`
--

CREATE TABLE `question_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `results` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_results`
--

INSERT INTO `question_results` (`id`, `results`, `question_no`, `marks`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '7', '1', '2022-12-04 17:37:38', '2022-12-04 17:37:38'),
(2, '1', '2', '8', '1', '2022-12-04 17:37:38', '2022-12-04 17:37:38'),
(3, '1', '3', '8', '1', '2022-12-04 17:37:38', '2022-12-04 17:37:38'),
(4, '1', '4', '10', '1', '2022-12-04 17:37:38', '2022-12-04 17:37:38'),
(5, '1', '5', '0', '1', '2022-12-04 17:37:38', '2022-12-04 17:37:38'),
(6, '1', '6', '0', '1', '2022-12-04 17:37:38', '2022-12-04 17:37:38'),
(7, '1', '7', '0', '1', '2022-12-04 17:37:38', '2022-12-04 17:37:38'),
(8, '1', '8', '0', '1', '2022-12-04 17:37:38', '2022-12-04 17:37:38'),
(9, '1', '9', '10', '1', '2022-12-04 17:37:38', '2022-12-04 17:37:38'),
(10, '1', '10', '10', '1', '2022-12-04 17:37:38', '2022-12-04 17:37:38'),
(11, '1', '11', '10', '1', '2022-12-04 17:37:38', '2022-12-04 17:37:38'),
(12, '1', '12', '10', '1', '2022-12-04 17:37:38', '2022-12-04 17:37:38'),
(13, '37', '1', '7', '1', '2022-12-04 16:24:41', '2022-12-04 16:24:41'),
(14, '37', '2', '8', '1', '2022-12-04 16:24:41', '2022-12-04 16:24:41'),
(15, '37', '3', '8', '1', '2022-12-04 16:24:41', '2022-12-04 16:24:41'),
(16, '38', '1', '7', '1', '2022-12-04 16:32:28', '2022-12-04 16:32:28'),
(17, '38', '4', '10', '1', '2022-12-04 16:32:28', '2022-12-04 16:32:28'),
(18, '38', '5', '10', '1', '2022-12-04 16:32:28', '2022-12-04 16:32:28'),
(19, '38', '9', '10', '1', '2022-12-04 16:32:28', '2022-12-04 16:32:28'),
(20, '38', '10', '10', '1', '2022-12-04 16:32:28', '2022-12-04 16:32:28'),
(21, '39', '8', '6', '1', '2022-12-04 16:39:28', '2022-12-04 16:39:28'),
(22, '39', '9', '10', '1', '2022-12-04 16:39:28', '2022-12-04 16:39:28'),
(23, '39', '10', '10', '1', '2022-12-04 16:39:28', '2022-12-04 16:39:28'),
(24, '40', '1', '7', '1', '2022-12-04 16:41:20', '2022-12-04 16:41:20'),
(25, '40', '2', '8', '1', '2022-12-04 16:41:20', '2022-12-04 16:41:20'),
(26, '40', '4', '10', '1', '2022-12-04 16:41:20', '2022-12-04 16:41:20'),
(27, '40', '5', '10', '1', '2022-12-04 16:41:20', '2022-12-04 16:41:20'),
(28, '42', '11', '10', '1', '2022-12-05 15:05:25', '2022-12-05 15:05:25'),
(29, '42', '12', '10', '1', '2022-12-05 15:05:25', '2022-12-05 15:05:25'),
(30, '44', '7', '7', '1', '2022-12-07 09:50:14', '2022-12-07 09:50:14'),
(31, '44', '8', '6', '1', '2022-12-07 09:50:14', '2022-12-07 09:50:14'),
(32, '44', '9', '10', '1', '2022-12-07 09:50:14', '2022-12-07 09:50:14'),
(33, '44', '10', '10', '1', '2022-12-07 09:50:14', '2022-12-07 09:50:14'),
(34, '44', '11', '10', '1', '2022-12-07 09:50:14', '2022-12-07 09:50:14'),
(35, '44', '12', '10', '1', '2022-12-07 09:50:14', '2022-12-07 09:50:14'),
(36, '45', '11', '10', '1', '2022-12-08 14:46:19', '2022-12-08 14:46:19'),
(37, '45', '12', '10', '1', '2022-12-08 14:46:19', '2022-12-08 14:46:19'),
(38, '45', '13', '10', '1', '2022-12-08 14:46:19', '2022-12-08 14:46:19'),
(39, '46', '11', '10', '1', '2022-12-08 14:48:27', '2022-12-08 14:48:27'),
(40, '46', '12', '10', '1', '2022-12-08 14:48:27', '2022-12-08 14:48:27'),
(41, '46', '13', '10', '1', '2022-12-08 14:48:27', '2022-12-08 14:48:27'),
(42, '47', '1', '7', '1', '2022-12-08 14:50:52', '2022-12-08 14:50:52'),
(43, '48', '11', '10', '1', '2022-12-08 15:03:30', '2022-12-08 15:03:30'),
(44, '48', '12', '10', '1', '2022-12-08 15:03:30', '2022-12-08 15:03:30'),
(45, '49', '11', '10', '1', '2022-12-08 15:43:10', '2022-12-08 15:43:10'),
(46, '49', '12', '10', '1', '2022-12-08 15:43:10', '2022-12-08 15:43:10'),
(47, '50', '11', '10', '1', '2022-12-08 15:46:53', '2022-12-08 15:46:53'),
(48, '50', '12', '10', '1', '2022-12-08 15:46:53', '2022-12-08 15:46:53'),
(49, '51', '1', '7', '1', '2022-12-08 15:47:47', '2022-12-08 15:47:47'),
(50, '51', '2', '8', '1', '2022-12-08 15:47:47', '2022-12-08 15:47:47'),
(51, '51', '3', '8', '1', '2022-12-08 15:47:47', '2022-12-08 15:47:47'),
(52, '51', '4', '10', '1', '2022-12-08 15:47:47', '2022-12-08 15:47:47'),
(53, '51', '5', '10', '1', '2022-12-08 15:47:47', '2022-12-08 15:47:47'),
(54, '51', '6', '7', '1', '2022-12-08 15:47:47', '2022-12-08 15:47:47'),
(55, '51', '7', '7', '1', '2022-12-08 15:47:47', '2022-12-08 15:47:47'),
(56, '51', '8', '6', '1', '2022-12-08 15:47:47', '2022-12-08 15:47:47'),
(57, '51', '9', '10', '1', '2022-12-08 15:47:47', '2022-12-08 15:47:47'),
(58, '52', '1', '7', '1', '2022-12-08 16:10:50', '2022-12-08 16:10:50'),
(59, '52', '2', '8', '1', '2022-12-08 16:10:50', '2022-12-08 16:10:50'),
(60, '52', '3', '8', '1', '2022-12-08 16:10:50', '2022-12-08 16:10:50'),
(61, '52', '4', '10', '1', '2022-12-08 16:10:50', '2022-12-08 16:10:50'),
(62, '52', '5', '10', '1', '2022-12-08 16:10:50', '2022-12-08 16:10:50'),
(63, '52', '6', '7', '1', '2022-12-08 16:10:50', '2022-12-08 16:10:50'),
(64, '52', '7', '7', '1', '2022-12-08 16:10:50', '2022-12-08 16:10:50'),
(65, '52', '8', '6', '1', '2022-12-08 16:10:50', '2022-12-08 16:10:50'),
(66, '52', '9', '10', '1', '2022-12-08 16:10:50', '2022-12-08 16:10:50'),
(67, '53', '1', '7', '1', '2022-12-08 16:11:07', '2022-12-08 16:11:07'),
(68, '53', '2', '8', '1', '2022-12-08 16:11:07', '2022-12-08 16:11:07'),
(69, '53', '3', '8', '1', '2022-12-08 16:11:07', '2022-12-08 16:11:07'),
(70, '53', '4', '10', '1', '2022-12-08 16:11:07', '2022-12-08 16:11:07'),
(71, '53', '5', '10', '1', '2022-12-08 16:11:07', '2022-12-08 16:11:07'),
(72, '54', '1', '7', '1', '2022-12-08 16:18:09', '2022-12-08 16:18:09'),
(73, '54', '2', '8', '1', '2022-12-08 16:18:09', '2022-12-08 16:18:09'),
(74, '54', '3', '8', '1', '2022-12-08 16:18:09', '2022-12-08 16:18:09'),
(75, '54', '4', '10', '1', '2022-12-08 16:18:09', '2022-12-08 16:18:09'),
(76, '54', '5', '10', '1', '2022-12-08 16:18:09', '2022-12-08 16:18:09'),
(77, '55', '6', '7', '1', '2022-12-08 16:19:02', '2022-12-08 16:19:02'),
(78, '55', '7', '7', '1', '2022-12-08 16:19:02', '2022-12-08 16:19:02'),
(79, '55', '8', '6', '1', '2022-12-08 16:19:02', '2022-12-08 16:19:02'),
(80, '55', '9', '10', '1', '2022-12-08 16:19:02', '2022-12-08 16:19:02'),
(81, '55', '10', '10', '1', '2022-12-08 16:19:02', '2022-12-08 16:19:02'),
(82, '56', '1', '7', '1', '2022-12-09 02:09:16', '2022-12-09 02:09:16'),
(83, '56', '2', '8', '1', '2022-12-09 02:09:16', '2022-12-09 02:09:16'),
(84, '56', '3', '8', '1', '2022-12-09 02:09:16', '2022-12-09 02:09:16'),
(85, '56', '4', '10', '1', '2022-12-09 02:09:16', '2022-12-09 02:09:16'),
(86, '56', '5', '10', '1', '2022-12-09 02:09:16', '2022-12-09 02:09:16'),
(87, '56', '6', '7', '1', '2022-12-09 02:09:16', '2022-12-09 02:09:16'),
(88, '56', '7', '7', '1', '2022-12-09 02:09:16', '2022-12-09 02:09:16'),
(89, '56', '8', '6', '1', '2022-12-09 02:09:16', '2022-12-09 02:09:16'),
(90, '56', '9', '10', '1', '2022-12-09 02:09:16', '2022-12-09 02:09:16'),
(91, '56', '10', '10', '1', '2022-12-09 02:09:16', '2022-12-09 02:09:16'),
(92, '58', '1', '7', '1', '2022-12-09 08:09:23', '2022-12-09 08:09:23'),
(93, '58', '2', '8', '1', '2022-12-09 08:09:23', '2022-12-09 08:09:23'),
(94, '58', '3', '8', '1', '2022-12-09 08:09:23', '2022-12-09 08:09:23'),
(95, '59', '10', '10', '1', '2022-12-09 08:25:41', '2022-12-09 08:25:41'),
(96, '59', '11', '10', '1', '2022-12-09 08:25:41', '2022-12-09 08:25:41'),
(97, '59', '12', '10', '1', '2022-12-09 08:25:41', '2022-12-09 08:25:41'),
(98, '60', '10', '10', '1', '2022-12-09 08:26:59', '2022-12-09 08:26:59'),
(99, '60', '11', '10', '1', '2022-12-09 08:26:59', '2022-12-09 08:26:59'),
(100, '60', '12', '10', '1', '2022-12-09 08:26:59', '2022-12-09 08:26:59'),
(101, '62', '11', '10', '1', '2022-12-09 08:37:04', '2022-12-09 08:37:04'),
(102, '64', '11', '10', '1', '2022-12-09 08:37:58', '2022-12-09 08:37:58'),
(103, '64', '12', '10', '1', '2022-12-09 08:37:58', '2022-12-09 08:37:58'),
(104, '65', '11', '10', '1', '2022-12-09 08:37:58', '2022-12-09 08:37:58'),
(105, '65', '12', '10', '1', '2022-12-09 08:37:58', '2022-12-09 08:37:58'),
(106, '66', '1', '7', '1', '2022-12-09 08:44:07', '2022-12-09 08:44:07'),
(107, '66', '2', '8', '1', '2022-12-09 08:44:07', '2022-12-09 08:44:07'),
(108, '66', '3', '8', '1', '2022-12-09 08:44:07', '2022-12-09 08:44:07'),
(109, '66', '4', '10', '1', '2022-12-09 08:44:07', '2022-12-09 08:44:07'),
(110, '66', '5', '10', '1', '2022-12-09 08:44:07', '2022-12-09 08:44:07'),
(111, '66', '6', '7', '1', '2022-12-09 08:44:07', '2022-12-09 08:44:07'),
(112, '66', '7', '7', '1', '2022-12-09 08:44:07', '2022-12-09 08:44:07'),
(113, '66', '8', '6', '1', '2022-12-09 08:44:07', '2022-12-09 08:44:07'),
(114, '66', '9', '10', '1', '2022-12-09 08:44:07', '2022-12-09 08:44:07'),
(115, '66', '10', '10', '1', '2022-12-09 08:44:07', '2022-12-09 08:44:07'),
(116, '66', '11', '10', '1', '2022-12-09 08:44:07', '2022-12-09 08:44:07'),
(117, '66', '12', '10', '1', '2022-12-09 08:44:07', '2022-12-09 08:44:07'),
(118, '67', '11', '10', '1', '2022-12-09 08:48:15', '2022-12-09 08:48:15'),
(119, '67', '12', '10', '1', '2022-12-09 08:48:15', '2022-12-09 08:48:15'),
(120, '68', '11', '10', '1', '2022-12-09 08:51:29', '2022-12-09 08:51:29'),
(121, '68', '12', '10', '1', '2022-12-09 08:51:29', '2022-12-09 08:51:29'),
(122, '69', '11', '10', '1', '2022-12-09 08:53:27', '2022-12-09 08:53:27'),
(123, '69', '12', '10', '1', '2022-12-09 08:53:27', '2022-12-09 08:53:27'),
(124, '76', '12', '10', '1', '2022-12-09 09:10:09', '2022-12-09 09:10:09'),
(125, '77', '1', '7', '1', '2022-12-09 09:32:35', '2022-12-09 09:32:35'),
(126, '77', '2', '8', '1', '2022-12-09 09:32:35', '2022-12-09 09:32:35'),
(127, '77', '3', '8', '1', '2022-12-09 09:32:35', '2022-12-09 09:32:35'),
(128, '77', '4', '10', '1', '2022-12-09 09:32:35', '2022-12-09 09:32:35'),
(129, '77', '5', '10', '1', '2022-12-09 09:32:35', '2022-12-09 09:32:35'),
(130, '77', '6', '7', '1', '2022-12-09 09:32:35', '2022-12-09 09:32:35'),
(131, '77', '7', '7', '1', '2022-12-09 09:32:35', '2022-12-09 09:32:35'),
(132, '77', '8', '6', '1', '2022-12-09 09:32:35', '2022-12-09 09:32:35'),
(133, '77', '9', '10', '1', '2022-12-09 09:32:35', '2022-12-09 09:32:35'),
(134, '77', '10', '10', '1', '2022-12-09 09:32:35', '2022-12-09 09:32:35'),
(135, '77', '11', '10', '1', '2022-12-09 09:32:35', '2022-12-09 09:32:35'),
(136, '77', '12', '10', '1', '2022-12-09 09:32:35', '2022-12-09 09:32:35'),
(137, '78', '11', '10', '1', '2022-12-09 13:08:59', '2022-12-09 13:08:59'),
(138, '78', '12', '10', '1', '2022-12-09 13:08:59', '2022-12-09 13:08:59'),
(139, '79', '11', '10', '1', '2022-12-10 13:41:26', '2022-12-10 13:41:26'),
(140, '79', '12', '10', '1', '2022-12-10 13:41:26', '2022-12-10 13:41:26'),
(141, '80', '11', '10', '1', '2022-12-10 14:29:21', '2022-12-10 14:29:21'),
(142, '80', '12', '10', '1', '2022-12-10 14:29:21', '2022-12-10 14:29:21'),
(143, '81', '1', '7', '1', '2022-12-10 14:34:49', '2022-12-10 14:34:49'),
(144, '81', '2', '8', '1', '2022-12-10 14:34:49', '2022-12-10 14:34:49'),
(145, '81', '3', '8', '1', '2022-12-10 14:34:49', '2022-12-10 14:34:49'),
(146, '82', '1', '4', '1', '2022-12-11 06:24:37', '2022-12-11 06:24:37'),
(147, '84', '8', '6', '1', '2022-12-25 09:34:56', '2022-12-25 09:34:56'),
(148, '84', '9', '10', '1', '2022-12-25 09:34:56', '2022-12-25 09:34:56'),
(149, '84', '10', '10', '1', '2022-12-25 09:34:56', '2022-12-25 09:34:56'),
(150, '85', '1', '4', '1', '2022-12-31 04:52:21', '2022-12-31 04:52:21'),
(151, '86', '1', '7', '1', '2022-12-31 05:00:19', '2022-12-31 05:00:19'),
(152, '86', '2', '8', '1', '2022-12-31 05:00:19', '2022-12-31 05:00:19'),
(153, '86', '3', '8', '1', '2022-12-31 05:00:19', '2022-12-31 05:00:19'),
(154, '86', '4', '10', '1', '2022-12-31 05:00:19', '2022-12-31 05:00:19'),
(155, '86', '5', '10', '1', '2022-12-31 05:00:19', '2022-12-31 05:00:19'),
(156, '86', '6', '7', '1', '2022-12-31 05:00:19', '2022-12-31 05:00:19'),
(157, '86', '7', '7', '1', '2022-12-31 05:00:19', '2022-12-31 05:00:19'),
(158, '86', '8', '6', '1', '2022-12-31 05:00:19', '2022-12-31 05:00:19'),
(159, '86', '9', '10', '1', '2022-12-31 05:00:19', '2022-12-31 05:00:19'),
(160, '86', '10', '10', '1', '2022-12-31 05:00:19', '2022-12-31 05:00:19'),
(161, '87', '1', '4', '1', '2022-12-31 05:01:20', '2022-12-31 05:01:20'),
(162, '88', '1', '4', '1', '2022-12-31 05:21:03', '2022-12-31 05:21:03'),
(163, '89', '1', '4', '1', '2022-12-31 05:24:04', '2022-12-31 05:24:04'),
(164, '90', '1', '7', '1', '2022-12-31 13:32:11', '2022-12-31 13:32:11'),
(165, '90', '2', '8', '1', '2022-12-31 13:32:11', '2022-12-31 13:32:11'),
(166, '90', '3', '8', '1', '2022-12-31 13:32:11', '2022-12-31 13:32:11'),
(167, '90', '4', '10', '1', '2022-12-31 13:32:11', '2022-12-31 13:32:11'),
(168, '90', '5', '10', '1', '2022-12-31 13:32:11', '2022-12-31 13:32:11'),
(169, '90', '6', '7', '1', '2022-12-31 13:32:11', '2022-12-31 13:32:11'),
(170, '90', '7', '7', '1', '2022-12-31 13:32:11', '2022-12-31 13:32:11'),
(171, '90', '8', '6', '1', '2022-12-31 13:32:11', '2022-12-31 13:32:11'),
(172, '90', '9', '10', '1', '2022-12-31 13:32:11', '2022-12-31 13:32:11'),
(173, '90', '10', '10', '1', '2022-12-31 13:32:11', '2022-12-31 13:32:11'),
(174, '91', '11', '10', '1', '2023-01-04 13:27:25', '2023-01-04 13:27:25'),
(175, '91', '12', '10', '1', '2023-01-04 13:27:25', '2023-01-04 13:27:25'),
(176, '92', '6', '7', '1', '2023-01-04 13:29:12', '2023-01-04 13:29:12'),
(177, '92', '7', '7', '1', '2023-01-04 13:29:12', '2023-01-04 13:29:12'),
(178, '92', '8', '6', '1', '2023-01-04 13:29:12', '2023-01-04 13:29:12'),
(179, '92', '9', '10', '1', '2023-01-04 13:29:12', '2023-01-04 13:29:12'),
(180, '92', '10', '10', '1', '2023-01-04 13:29:12', '2023-01-04 13:29:12'),
(181, '93', '1', '7', '1', '2023-01-04 13:55:40', '2023-01-04 13:55:40'),
(182, '93', '2', '8', '1', '2023-01-04 13:55:40', '2023-01-04 13:55:40'),
(183, '93', '3', '8', '1', '2023-01-04 13:55:40', '2023-01-04 13:55:40'),
(184, '93', '4', '10', '1', '2023-01-04 13:55:40', '2023-01-04 13:55:40'),
(185, '94', '1', '7', '1', '2023-01-04 14:22:37', '2023-01-04 14:22:37'),
(186, '94', '2', '8', '1', '2023-01-04 14:22:37', '2023-01-04 14:22:37'),
(187, '94', '3', '8', '1', '2023-01-04 14:22:37', '2023-01-04 14:22:37'),
(188, '94', '5', '10', '1', '2023-01-04 14:22:37', '2023-01-04 14:22:37'),
(189, '95', '11', '10', '1', '2023-01-04 14:27:31', '2023-01-04 14:27:31'),
(190, '95', '12', '10', '1', '2023-01-04 14:27:31', '2023-01-04 14:27:31'),
(191, '96', '11', '10', '1', '2023-01-04 14:31:57', '2023-01-04 14:31:57'),
(192, '96', '12', '10', '1', '2023-01-04 14:31:57', '2023-01-04 14:31:57'),
(193, '96', '13', '10', '1', '2023-01-04 14:31:57', '2023-01-04 14:31:57'),
(194, '97', '11', '10', '1', '2023-01-04 14:33:39', '2023-01-04 14:33:39'),
(195, '97', '12', '10', '1', '2023-01-04 14:33:39', '2023-01-04 14:33:39'),
(196, '98', '1', '7', '1', '2023-01-04 14:34:34', '2023-01-04 14:34:34'),
(197, '98', '2', '8', '1', '2023-01-04 14:34:34', '2023-01-04 14:34:34'),
(198, '98', '3', '8', '1', '2023-01-04 14:34:34', '2023-01-04 14:34:34'),
(199, '98', '4', '10', '1', '2023-01-04 14:34:34', '2023-01-04 14:34:34'),
(200, '98', '5', '10', '1', '2023-01-04 14:34:34', '2023-01-04 14:34:34'),
(201, '98', '6', '7', '1', '2023-01-04 14:34:34', '2023-01-04 14:34:34'),
(202, '98', '7', '7', '1', '2023-01-04 14:34:34', '2023-01-04 14:34:34'),
(203, '98', '8', '6', '1', '2023-01-04 14:34:34', '2023-01-04 14:34:34'),
(204, '98', '9', '10', '1', '2023-01-04 14:34:34', '2023-01-04 14:34:34'),
(205, '98', '10', '10', '1', '2023-01-04 14:34:34', '2023-01-04 14:34:34'),
(206, '99', '1', '7', '1', '2023-01-04 14:36:03', '2023-01-04 14:36:03'),
(207, '99', '2', '8', '1', '2023-01-04 14:36:03', '2023-01-04 14:36:03'),
(208, '99', '3', '8', '1', '2023-01-04 14:36:03', '2023-01-04 14:36:03'),
(209, '99', '4', '10', '1', '2023-01-04 14:36:03', '2023-01-04 14:36:03'),
(210, '99', '5', '10', '1', '2023-01-04 14:36:03', '2023-01-04 14:36:03'),
(211, '99', '6', '7', '1', '2023-01-04 14:36:03', '2023-01-04 14:36:03'),
(212, '99', '7', '7', '1', '2023-01-04 14:36:03', '2023-01-04 14:36:03'),
(213, '99', '8', '6', '1', '2023-01-04 14:36:03', '2023-01-04 14:36:03'),
(214, '99', '9', '10', '1', '2023-01-04 14:36:03', '2023-01-04 14:36:03'),
(215, '99', '10', '10', '1', '2023-01-04 14:36:03', '2023-01-04 14:36:03'),
(216, '100', '1', '7', '1', '2023-01-04 14:38:05', '2023-01-04 14:38:05'),
(217, '100', '2', '8', '1', '2023-01-04 14:38:05', '2023-01-04 14:38:05'),
(218, '100', '3', '8', '1', '2023-01-04 14:38:05', '2023-01-04 14:38:05'),
(219, '100', '4', '10', '1', '2023-01-04 14:38:05', '2023-01-04 14:38:05'),
(220, '100', '5', '10', '1', '2023-01-04 14:38:05', '2023-01-04 14:38:05'),
(221, '100', '6', '7', '1', '2023-01-04 14:38:05', '2023-01-04 14:38:05'),
(222, '100', '7', '7', '1', '2023-01-04 14:38:05', '2023-01-04 14:38:05'),
(223, '100', '8', '6', '1', '2023-01-04 14:38:05', '2023-01-04 14:38:05'),
(224, '100', '9', '10', '1', '2023-01-04 14:38:05', '2023-01-04 14:38:05'),
(225, '100', '10', '10', '1', '2023-01-04 14:38:05', '2023-01-04 14:38:05'),
(226, '103', '1', '7', '1', '2023-01-13 14:31:38', '2023-01-13 14:31:38'),
(227, '103', '2', '8', '1', '2023-01-13 14:31:38', '2023-01-13 14:31:38'),
(228, '104', '9', '10', '1', '2023-01-13 14:33:50', '2023-01-13 14:33:50'),
(229, '104', '10', '10', '1', '2023-01-13 14:33:50', '2023-01-13 14:33:50'),
(230, '105', '9', '10', '1', '2023-01-13 14:34:48', '2023-01-13 14:34:48'),
(231, '105', '10', '10', '1', '2023-01-13 14:34:48', '2023-01-13 14:34:48'),
(232, '106', '6', '7', '1', '2023-01-13 14:35:35', '2023-01-13 14:35:35'),
(233, '106', '7', '7', '1', '2023-01-13 14:35:35', '2023-01-13 14:35:35'),
(234, '107', '8', '6', '1', '2023-01-13 14:36:11', '2023-01-13 14:36:11'),
(235, '107', '9', '10', '1', '2023-01-13 14:36:11', '2023-01-13 14:36:11'),
(236, '107', '10', '10', '1', '2023-01-13 14:36:11', '2023-01-13 14:36:11'),
(237, '108', '8', '6', '1', '2023-01-13 14:38:07', '2023-01-13 14:38:07'),
(238, '108', '9', '10', '1', '2023-01-13 14:38:07', '2023-01-13 14:38:07'),
(239, '108', '10', '10', '1', '2023-01-13 14:38:07', '2023-01-13 14:38:07'),
(240, '109', '6', '7', '1', '2023-01-13 14:40:22', '2023-01-13 14:40:22'),
(241, '109', '7', '7', '1', '2023-01-13 14:40:22', '2023-01-13 14:40:22'),
(242, '109', '8', '6', '1', '2023-01-13 14:40:22', '2023-01-13 14:40:22'),
(243, '109', '9', '10', '1', '2023-01-13 14:40:22', '2023-01-13 14:40:22'),
(244, '109', '10', '10', '1', '2023-01-13 14:40:22', '2023-01-13 14:40:22'),
(245, '110', '4', '10', '1', '2023-01-13 14:43:02', '2023-01-13 14:43:02'),
(246, '110', '5', '10', '1', '2023-01-13 14:43:02', '2023-01-13 14:43:02'),
(247, '110', '6', '7', '1', '2023-01-13 14:43:02', '2023-01-13 14:43:02'),
(248, '110', '7', '7', '1', '2023-01-13 14:43:02', '2023-01-13 14:43:02'),
(249, '110', '8', '6', '1', '2023-01-13 14:43:02', '2023-01-13 14:43:02'),
(250, '110', '9', '10', '1', '2023-01-13 14:43:02', '2023-01-13 14:43:02'),
(251, '110', '10', '10', '1', '2023-01-13 14:43:02', '2023-01-13 14:43:02'),
(252, '111', '1', '7', '1', '2023-01-13 14:48:12', '2023-01-13 14:48:12'),
(253, '111', '2', '8', '1', '2023-01-13 14:48:12', '2023-01-13 14:48:12'),
(254, '111', '3', '8', '1', '2023-01-13 14:48:12', '2023-01-13 14:48:12'),
(255, '112', '5', '10', '1', '2023-01-13 14:49:06', '2023-01-13 14:49:06'),
(256, '112', '6', '7', '1', '2023-01-13 14:49:06', '2023-01-13 14:49:06'),
(257, '112', '7', '7', '1', '2023-01-13 14:49:06', '2023-01-13 14:49:06'),
(258, '112', '8', '6', '1', '2023-01-13 14:49:06', '2023-01-13 14:49:06'),
(259, '112', '9', '10', '1', '2023-01-13 14:49:06', '2023-01-13 14:49:06'),
(260, '112', '10', '10', '1', '2023-01-13 14:49:06', '2023-01-13 14:49:06'),
(261, '113', '1', '7', '1', '2023-01-13 14:53:40', '2023-01-13 14:53:40'),
(262, '113', '2', '8', '1', '2023-01-13 14:53:40', '2023-01-13 14:53:40'),
(263, '114', '1', '7', '1', '2023-01-13 14:54:51', '2023-01-13 14:54:51'),
(264, '114', '2', '8', '1', '2023-01-13 14:54:51', '2023-01-13 14:54:51'),
(265, '114', '7', '7', '1', '2023-01-13 14:54:51', '2023-01-13 14:54:51'),
(266, '114', '8', '6', '1', '2023-01-13 14:54:51', '2023-01-13 14:54:51'),
(267, '114', '9', '10', '1', '2023-01-13 14:54:51', '2023-01-13 14:54:51'),
(268, '114', '10', '10', '1', '2023-01-13 14:54:51', '2023-01-13 14:54:51'),
(269, '115', '6', '7', '1', '2023-01-13 15:11:20', '2023-01-13 15:11:20'),
(270, '115', '7', '7', '1', '2023-01-13 15:11:20', '2023-01-13 15:11:20'),
(271, '115', '8', '6', '1', '2023-01-13 15:11:20', '2023-01-13 15:11:20'),
(272, '115', '9', '10', '1', '2023-01-13 15:11:20', '2023-01-13 15:11:20'),
(273, '116', '2', '8', '1', '2023-01-14 16:15:17', '2023-01-14 16:15:17'),
(274, '116', '3', '8', '1', '2023-01-14 16:15:17', '2023-01-14 16:15:17'),
(275, '116', '9', '10', '1', '2023-01-14 16:15:17', '2023-01-14 16:15:17'),
(276, '116', '10', '10', '1', '2023-01-14 16:15:17', '2023-01-14 16:15:17'),
(277, '116', '11', '10', '1', '2023-01-14 16:15:17', '2023-01-14 16:15:17'),
(278, '116', '12', '10', '1', '2023-01-14 16:15:17', '2023-01-14 16:15:17'),
(279, '117', '7', '7', '1', '2023-01-14 16:37:12', '2023-01-14 16:37:12'),
(280, '117', '8', '6', '1', '2023-01-14 16:37:12', '2023-01-14 16:37:12'),
(281, '117', '9', '10', '1', '2023-01-14 16:37:12', '2023-01-14 16:37:12'),
(282, '117', '12', '10', '1', '2023-01-14 16:37:12', '2023-01-14 16:37:12'),
(283, '118', '6', '7', '1', '2023-01-14 16:49:26', '2023-01-14 16:49:26'),
(284, '118', '7', '7', '1', '2023-01-14 16:49:26', '2023-01-14 16:49:26'),
(285, '119', '9', '10', '1', '2023-01-14 16:49:55', '2023-01-14 16:49:55'),
(286, '119', '10', '10', '1', '2023-01-14 16:49:55', '2023-01-14 16:49:55'),
(287, '120', '5', '10', '1', '2023-01-14 17:00:43', '2023-01-14 17:00:43'),
(288, '120', '6', '7', '1', '2023-01-14 17:00:43', '2023-01-14 17:00:43'),
(289, '120', '7', '7', '1', '2023-01-14 17:00:43', '2023-01-14 17:00:43'),
(290, '120', '8', '6', '1', '2023-01-14 17:00:43', '2023-01-14 17:00:43'),
(291, '121', '4', '10', '1', '2023-01-14 17:01:50', '2023-01-14 17:01:50'),
(292, '121', '5', '10', '1', '2023-01-14 17:01:50', '2023-01-14 17:01:50'),
(293, '122', '8', '6', '1', '2023-01-14 17:10:26', '2023-01-14 17:10:26'),
(294, '122', '9', '10', '1', '2023-01-14 17:10:26', '2023-01-14 17:10:26'),
(295, '122', '10', '10', '1', '2023-01-14 17:10:26', '2023-01-14 17:10:26'),
(296, '122', '11', '10', '1', '2023-01-14 17:10:26', '2023-01-14 17:10:26'),
(297, '123', '1', '7', '1', '2023-01-14 17:44:50', '2023-01-14 17:44:50'),
(298, '123', '2', '8', '1', '2023-01-14 17:44:50', '2023-01-14 17:44:50'),
(299, '123', '3', '8', '1', '2023-01-14 17:44:50', '2023-01-14 17:44:50'),
(300, '123', '4', '10', '1', '2023-01-14 17:44:50', '2023-01-14 17:44:50'),
(301, '123', '5', '10', '1', '2023-01-14 17:44:50', '2023-01-14 17:44:50'),
(302, '123', '6', '7', '1', '2023-01-14 17:44:50', '2023-01-14 17:44:50'),
(303, '124', '9', '10', '1', '2023-01-14 17:56:12', '2023-01-14 17:56:12'),
(304, '124', '10', '10', '1', '2023-01-14 17:56:12', '2023-01-14 17:56:12'),
(305, '124', '11', '10', '1', '2023-01-14 17:56:12', '2023-01-14 17:56:12'),
(306, '124', '12', '10', '1', '2023-01-14 17:56:12', '2023-01-14 17:56:12'),
(307, '125', '9', '10', '1', '2023-01-15 07:03:22', '2023-01-15 07:03:22'),
(308, '125', '10', '10', '1', '2023-01-15 07:03:22', '2023-01-15 07:03:22'),
(309, '125', '11', '10', '1', '2023-01-15 07:03:22', '2023-01-15 07:03:22'),
(310, '125', '12', '10', '1', '2023-01-15 07:03:22', '2023-01-15 07:03:22'),
(311, '125', '13', '10', '1', '2023-01-15 07:03:22', '2023-01-15 07:03:22'),
(312, '126', '4', '0', '1', '2023-01-15 07:04:04', '2023-01-15 07:04:04'),
(313, '126', '5', '0', '1', '2023-01-15 07:04:04', '2023-01-15 07:04:04'),
(314, '126', '6', '0', '1', '2023-01-15 07:04:04', '2023-01-15 07:04:04'),
(315, '126', '7', '0', '1', '2023-01-15 07:04:04', '2023-01-15 07:04:04'),
(316, '126', '8', '0', '1', '2023-01-15 07:04:04', '2023-01-15 07:04:04'),
(317, '126', '9', '0', '1', '2023-01-15 07:04:04', '2023-01-15 07:04:04'),
(318, '126', '10', '0', '1', '2023-01-15 07:04:04', '2023-01-15 07:04:04'),
(319, '126', '11', '0', '1', '2023-01-15 07:04:04', '2023-01-15 07:04:04'),
(320, '126', '12', '0', '1', '2023-01-15 07:04:04', '2023-01-15 07:04:04'),
(321, '129', '13', '10', '1', '2023-01-15 07:05:02', '2023-01-15 07:05:02'),
(322, '130', '15', '0', '1', '2023-01-15 07:05:46', '2023-01-15 07:05:46'),
(323, '130', '16', '0', '1', '2023-01-15 07:05:46', '2023-01-15 07:05:46'),
(324, '130', '17', '0', '1', '2023-01-15 07:05:46', '2023-01-15 07:05:46'),
(325, '131', '4', '10', '1', '2023-01-18 13:45:20', '2023-01-18 13:45:20'),
(326, '131', '5', '10', '1', '2023-01-18 13:45:20', '2023-01-18 13:45:20'),
(327, '131', '6', '7', '1', '2023-01-18 13:45:20', '2023-01-18 13:45:20'),
(328, '131', '7', '7', '1', '2023-01-18 13:45:20', '2023-01-18 13:45:20'),
(329, '131', '8', '6', '1', '2023-01-18 13:45:20', '2023-01-18 13:45:20'),
(330, '131', '9', '10', '1', '2023-01-18 13:45:20', '2023-01-18 13:45:20'),
(331, '132', '1', '4', '1', '2023-01-21 11:41:27', '2023-01-21 11:41:27');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supervisor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quality_analysts` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_recorded` datetime NOT NULL,
  `customer_account` int(11) DEFAULT NULL,
  `recording_id` int(11) DEFAULT NULL,
  `q1` int(11) DEFAULT NULL,
  `q2` int(11) DEFAULT NULL,
  `q3` int(11) DEFAULT NULL,
  `q4` int(11) DEFAULT NULL,
  `q5` int(11) DEFAULT NULL,
  `q6` int(11) DEFAULT NULL,
  `q7` int(11) DEFAULT NULL,
  `q8` int(11) DEFAULT NULL,
  `q9` int(11) DEFAULT NULL,
  `q10` int(11) DEFAULT NULL,
  `q11` int(11) DEFAULT NULL,
  `q12` int(11) DEFAULT NULL,
  `q13` int(11) DEFAULT NULL,
  `q14` int(11) DEFAULT NULL,
  `q15` int(11) DEFAULT NULL,
  `q16` int(11) DEFAULT NULL,
  `q17` int(11) DEFAULT NULL,
  `q18` int(11) DEFAULT NULL,
  `q19` int(11) DEFAULT NULL,
  `q20` int(11) DEFAULT NULL,
  `q21` int(11) DEFAULT NULL,
  `q22` int(11) DEFAULT NULL,
  `q23` int(11) DEFAULT NULL,
  `q24` int(11) DEFAULT NULL,
  `q25` int(11) DEFAULT NULL,
  `q26` int(11) DEFAULT NULL,
  `q27` int(11) DEFAULT NULL,
  `q28` int(11) DEFAULT NULL,
  `q29` int(11) DEFAULT NULL,
  `q30` int(11) DEFAULT NULL,
  `q31` int(11) DEFAULT NULL,
  `q32` int(11) DEFAULT NULL,
  `q33` int(11) DEFAULT NULL,
  `q34` int(11) DEFAULT NULL,
  `q35` int(11) DEFAULT NULL,
  `q36` int(11) DEFAULT NULL,
  `q37` int(11) DEFAULT NULL,
  `q38` int(11) DEFAULT NULL,
  `q39` int(11) DEFAULT NULL,
  `q40` int(11) DEFAULT NULL,
  `q41` int(11) DEFAULT NULL,
  `q42` int(11) DEFAULT NULL,
  `q43` int(11) DEFAULT NULL,
  `q44` int(11) DEFAULT NULL,
  `q45` int(11) DEFAULT NULL,
  `q46` int(11) DEFAULT NULL,
  `q47` int(11) DEFAULT NULL,
  `q48` int(11) DEFAULT NULL,
  `q49` int(11) DEFAULT NULL,
  `q50` int(11) DEFAULT NULL,
  `q51` int(11) DEFAULT NULL,
  `q52` int(11) DEFAULT NULL,
  `q53` int(11) DEFAULT NULL,
  `q54` int(11) DEFAULT NULL,
  `q55` int(11) DEFAULT NULL,
  `q56` int(11) DEFAULT NULL,
  `q57` int(11) DEFAULT NULL,
  `q58` int(11) DEFAULT NULL,
  `q59` int(11) DEFAULT NULL,
  `q60` int(11) DEFAULT NULL,
  `qa_call_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qa_call_nature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_call_category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_call_nature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `general_issue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specific_issue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feedback_from_qc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor_comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ticket_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `percentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `results` int(11) DEFAULT NULL,
  `totals` int(11) DEFAULT NULL,
  `date_updated` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `supervisor`, `agent_name`, `quality_analysts`, `date_recorded`, `customer_account`, `recording_id`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`, `q13`, `q14`, `q15`, `q16`, `q17`, `q18`, `q19`, `q20`, `q21`, `q22`, `q23`, `q24`, `q25`, `q26`, `q27`, `q28`, `q29`, `q30`, `q31`, `q32`, `q33`, `q34`, `q35`, `q36`, `q37`, `q38`, `q39`, `q40`, `q41`, `q42`, `q43`, `q44`, `q45`, `q46`, `q47`, `q48`, `q49`, `q50`, `q51`, `q52`, `q53`, `q54`, `q55`, `q56`, `q57`, `q58`, `q59`, `q60`, `qa_call_category`, `qa_call_nature`, `agent_call_category`, `agent_call_nature`, `general_issue`, `specific_issue`, `feedback_from_qc`, `supervisor_comment`, `agent_comment`, `ticket_status`, `percentage`, `results`, `totals`, `date_updated`, `created_at`, `updated_at`, `category`) VALUES
(1, 'John Peter', 'Simon Felix', 'admin', '2022-12-03 09:13:33', 12345, 54321, 7, 8, 8, 10, 0, 0, 0, 0, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'TESTIJ', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 09:13:33', NULL, NULL, 'Cable Billing'),
(2, 'John Peter', 'Simon Felix', 'admin', '2022-12-03 09:13:33', 12345, 54321, 7, 8, 8, 10, 0, 0, 0, 0, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'TESTIJ', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 09:13:33', NULL, NULL, 'Cable Billing'),
(3, 'John Peter', 'Simon Felix', 'admin', '2022-12-03 10:13:52', 654321, 1234533, 7, 0, 8, 10, 10, 7, 7, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'ASDFGHJKL', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 10:13:52', NULL, NULL, 'Cable Billing'),
(4, 'John Peter', 'Simon Felix', 'admin', '2022-12-03 13:29:55', 1436543, 432123, 7, 8, 8, 10, 10, 7, 7, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'testing', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 13:29:55', NULL, NULL, 'Cable Billing'),
(5, 'John Peter', 'Select Agent', 'admin', '2022-12-03 13:31:50', 65432, 1234, 7, 8, 8, 10, 10, 7, 7, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'aSDFGH', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 13:31:50', NULL, NULL, 'Cable Billing'),
(6, 'John Peter', 'Select Agent', 'admin', '2022-12-03 13:31:50', 65432, 1234, 7, 8, 8, 10, 10, 7, 7, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'aSDFGH', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 13:31:50', NULL, NULL, 'Cable Billing'),
(7, 'John Peter', 'Select Agent', 'admin', '2022-12-03 13:31:50', 65432, 1234, 7, 8, 8, 10, 10, 7, 7, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'aSDFGH', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 13:31:50', NULL, NULL, 'Cable Billing'),
(8, 'John Peter', 'Select Agent', 'admin', '2022-12-03 13:31:50', 65432, 1234, 7, 8, 8, 10, 10, 7, 7, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'aSDFGH', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 13:31:50', NULL, NULL, 'Cable Billing'),
(9, 'John Peter', 'Select Agent', 'admin', '2022-12-03 13:31:50', 65432, 1234, 7, 8, 8, 10, 10, 7, 7, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'aSDFGH', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 13:31:50', NULL, NULL, 'Cable Billing'),
(10, 'John Peter', 'Select Agent', 'admin', '2022-12-03 13:31:50', 65432, 1234, 7, 8, 8, 10, 10, 7, 7, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'aSDFGH', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 13:31:50', NULL, NULL, 'Cable Billing'),
(11, 'John Peter', 'Select Agent', 'admin', '2022-12-03 13:31:50', 65432, 1234, 7, 8, 8, 10, 10, 7, 7, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'aSDFGH', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 13:31:50', NULL, NULL, 'Cable Billing'),
(12, 'John Peter', 'Select Agent', 'admin', '2022-12-03 13:31:50', 65432, 1234, 7, 8, 8, 10, 10, 7, 7, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'aSDFGH', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 13:31:50', NULL, NULL, 'Cable Billing'),
(13, 'John Peter', 'Select Agent', 'admin', '2022-12-03 13:31:50', 65432, 1234, 7, 8, 8, 10, 10, 7, 7, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'aSDFGH', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 13:31:50', NULL, NULL, 'Cable Billing'),
(14, 'John Peter', 'Select Agent', 'admin', '2022-12-03 14:34:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 14:34:42', NULL, NULL, 'Cable Billing'),
(15, 'John Peter', 'Simon Felix', 'admin', '2022-12-03 14:38:41', 6543, 234, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'sghgfew', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 14:38:41', NULL, NULL, 'Cable Billing'),
(16, 'John Peter', 'Simon Felix', 'admin', '2022-12-03 14:38:41', 6543, 234, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'sghgfew', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 14:38:41', NULL, NULL, 'Cable Billing'),
(17, 'John Peter', 'Simon Felix', 'admin', '2022-12-03 14:38:41', 6543, 234, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'sghgfew', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 14:38:41', NULL, NULL, 'Cable Billing'),
(18, 'John Peter', 'Select Agent', 'admin', '2022-12-03 14:43:34', 9876543, 5432, 7, 8, 0, 10, 10, 7, 7, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'sdfghjk', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 14:43:34', NULL, NULL, 'Cable Billing'),
(19, 'John Peter', 'Select Agent', 'admin', '2022-12-03 14:45:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 14:45:52', NULL, NULL, 'Cable Billing'),
(20, 'John Peter', 'Select Agent', 'admin', '2022-12-03 14:45:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 14:45:52', NULL, NULL, 'Cable Billing'),
(21, 'John Peter', 'Select Agent', 'admin', '2022-12-03 14:45:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 14:45:52', NULL, NULL, 'Cable Billing'),
(22, 'John Peter', 'Select Agent', 'admin', '2022-12-03 14:51:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 14:51:14', NULL, NULL, 'Cable Billing'),
(23, 'John Peter', 'Select Agent', 'admin', '2022-12-03 14:51:14', 9876, 34566, 7, 8, 8, 10, 10, 7, 7, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'SDFGHJK', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 14:51:14', NULL, NULL, 'Cable Billing'),
(24, 'John Peter', 'Select Agent', 'admin', '2022-12-03 15:07:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 15:07:13', NULL, NULL, 'Cable Billing'),
(25, 'John Peter', 'Select Agent', 'admin', '2022-12-03 15:08:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 15:08:06', NULL, NULL, 'Cable Billing'),
(26, 'John Peter', 'Select Agent', 'admin', '2022-12-03 15:08:06', NULL, NULL, 7, 8, 8, 10, 10, 7, 7, 6, 10, NULL, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'asdsfdg', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 15:08:06', NULL, NULL, 'Cable Billing'),
(27, 'John Peter', 'Select Agent', 'admin', '2022-12-03 15:09:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 15:09:22', NULL, NULL, 'Cable Billing'),
(28, 'John Peter', 'Select Agent', 'admin', '2022-12-03 14:43:34', 9876543, 5432, 7, 8, 0, 10, 10, 7, 7, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'sdfghjk', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 14:43:34', NULL, NULL, 'Cable Billing'),
(29, 'John Peter', 'Select Agent', 'admin', '2022-12-03 15:24:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-03 15:24:51', NULL, NULL, 'Cable Billing'),
(30, 'John Peter', 'Simon Felix', 'admin', '2022-12-04 09:18:26', 5767, 36343, 0, 8, 8, 10, 10, 7, 7, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'asdsdff', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-04 09:18:26', NULL, NULL, 'Cable Billing'),
(31, 'John Peter', 'Simon Felix', 'admin', '2022-12-04 09:18:26', 1234, 23455, 7, 8, 8, 10, 10, 7, 7, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-04 09:18:26', NULL, NULL, 'Cable Billing'),
(32, 'John Peter', 'Simon Felix', 'admin', '2022-12-04 10:02:02', 9876, 87654, 7, 8, 8, 10, 10, 7, 0, 6, 10, 10, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', NULL, 'Issue Highlighted specific', 'yoh', NULL, NULL, NULL, NULL, NULL, NULL, '2022-12-04 10:02:02', NULL, NULL, 'Cable Billing'),
(37, 'John Peter', '56', 'admin', '2022-12-04 19:22:43', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 0, 0, '2022-12-04 19:22:43', '2022-12-04 16:24:41', '2022-12-04 16:24:41', 'Cable Billing'),
(38, 'John Peter', '56', 'admin', '2022-12-04 19:32:09', 123234545, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 0, 0, '2022-12-04 19:32:09', '2022-12-04 16:32:28', '2022-12-04 16:32:28', 'Cable Billing'),
(39, 'John Peter', '56', 'admin', '2022-12-04 19:38:56', 111, 222, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', 'wqeerwrteyy', '', '', '', '', 47, 0, '2022-12-04 19:38:56', '2022-12-04 16:39:28', '2022-12-04 16:39:28', 'Cable Billing'),
(40, 'John Peter', '56', 'admin', '2022-12-04 19:40:56', 11, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 35, 0, '2022-12-04 19:40:56', '2022-12-04 16:41:20', '2022-12-04 16:41:20', 'Cable Billing'),
(42, 'John Peter', 'Select Agent', 'admin', '2022-12-05 18:04:32', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 20, 0, '2022-12-05 18:04:32', '2022-12-05 15:05:24', '2022-12-05 15:05:25', 'Cable Billing'),
(44, 'John Peter', 'Select Agent', 'admin', '2022-12-07 12:49:50', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 53, 0, '2022-12-07 12:49:50', '2022-12-07 09:50:14', '2022-12-07 09:50:14', 'Cable Billing'),
(45, 'Churn Supervisor', '58', 'admin', '2022-12-08 17:45:50', 12131, 131313, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 30, 0, '2022-12-08 17:45:50', '2022-12-08 14:46:19', '2022-12-08 14:46:19', 'Cable Churn'),
(46, 'Churn Supervisor', 'Select Agent', 'admin', '2022-12-08 17:47:42', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', 'hello chunr', '', '', '', '', 30, 0, '2022-12-08 17:47:42', '2022-12-08 14:48:27', '2022-12-08 14:48:27', 'Cable Churn'),
(47, 'Churn Supervisor', 'Select Agent', 'admin', '2022-12-08 17:50:46', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 7, 0, '2022-12-08 17:50:46', '2022-12-08 14:50:52', '2022-12-08 14:50:52', 'Cable Churn'),
(48, 'John Peter', 'Select Agent', 'admin', '2022-12-08 18:03:08', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 20, 0, '2022-12-08 18:03:08', '2022-12-08 15:03:30', '2022-12-08 15:03:30', 'Cable Billing'),
(49, 'John Peter', '56', 'admin', '2022-12-08 18:42:28', 1234, 12134, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', 'test results one', '', '', '', '', 20, 0, '2022-12-08 18:42:28', '2022-12-08 15:43:10', '2022-12-08 15:43:10', 'Cable Billing'),
(50, 'John Peter', '56', 'admin', '2022-12-08 18:42:28', 1234, 12134, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', 'test results one', '', '', '', '', 20, 0, '2022-12-08 18:42:28', '2022-12-08 15:46:53', '2022-12-08 15:46:53', 'Cable Billing'),
(51, 'John Peter', 'Select Agent', 'admin', '2022-12-08 18:47:29', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', 'wert', '', '', '', '', 73, 0, '2022-12-08 18:47:29', '2022-12-08 15:47:47', '2022-12-08 15:47:47', 'Cable Billing'),
(52, 'John Peter', 'Select Agent', 'admin', '2022-12-08 18:47:29', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', 'wert', '', '', '', '', 73, 0, '2022-12-08 18:47:29', '2022-12-08 16:10:50', '2022-12-08 16:10:50', 'Cable Billing'),
(53, 'John Peter', 'Select Agent', 'admin', '2022-12-08 19:10:55', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 43, 0, '2022-12-08 19:10:55', '2022-12-08 16:11:07', '2022-12-08 16:11:07', 'Cable Billing'),
(54, 'John Peter', 'Select Agent', 'admin', '2022-12-08 19:10:55', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 43, 0, '2022-12-08 19:10:55', '2022-12-08 16:18:09', '2022-12-08 16:18:09', 'Cable Billing'),
(55, 'John Peter', 'Select Agent', 'admin', '2022-12-08 19:18:54', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 40, 0, '2022-12-08 19:18:54', '2022-12-08 16:19:02', '2022-12-08 16:19:02', 'Cable Billing'),
(56, 'John Peter', 'Select Agent', 'admin', '2022-12-09 05:08:24', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 83, 0, '2022-12-09 05:08:24', '2022-12-09 02:09:16', '2022-12-09 02:09:16', '1'),
(58, 'John Peter', '56', 'admin', '2022-12-09 11:08:42', 1133, 544, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', 'jh;;k', '', '', '', '', 23, 0, '2022-12-09 11:08:42', '2022-12-09 08:09:23', '2022-12-09 08:09:23', '1'),
(59, 'John Peter', 'Select Agent', 'admin', '2022-12-09 11:25:29', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 30, 0, '2022-12-09 11:25:29', '2022-12-09 08:25:41', '2022-12-09 08:25:41', '1'),
(60, 'John Peter', 'Select Agent', 'admin', '2022-12-09 11:26:49', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 30, 0, '2022-12-09 11:26:49', '2022-12-09 08:26:59', '2022-12-09 08:26:59', '1'),
(62, 'John Peter', 'Select Agent', 'admin', '2022-12-09 11:33:57', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 10, 0, '2022-12-09 11:33:57', '2022-12-09 08:37:04', '2022-12-09 08:37:04', '1'),
(64, 'John Peter', 'Select Agent', 'admin', '2022-12-09 11:37:13', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 20, 0, '2022-12-09 11:37:13', '2022-12-09 08:37:58', '2022-12-09 08:37:58', '1'),
(65, 'John Peter', 'Select Agent', 'admin', '2022-12-09 11:37:13', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 20, 0, '2022-12-09 11:37:13', '2022-12-09 08:37:58', '2022-12-09 08:37:58', '1'),
(66, 'John Peter', 'Select Agent', 'admin', '2022-12-09 11:37:13', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 103, 0, '2022-12-09 11:37:13', '2022-12-09 08:44:07', '2022-12-09 08:44:07', '1'),
(67, 'John Peter', 'Select Agent', 'admin', '2022-12-09 11:48:10', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 20, 0, '2022-12-09 11:48:10', '2022-12-09 08:48:15', '2022-12-09 08:48:15', '1'),
(68, 'John Peter', 'Select Agent', 'admin', '2022-12-09 11:48:10', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 20, 0, '2022-12-09 11:48:10', '2022-12-09 08:51:29', '2022-12-09 08:51:29', '1'),
(69, 'John Peter', 'Select Agent', 'admin', '2022-12-09 11:48:10', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 20, 0, '2022-12-09 11:48:10', '2022-12-09 08:53:27', '2022-12-09 08:53:27', '1'),
(76, 'John Peter', 'Select Agent', 'admin', '2022-12-09 12:09:59', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 10, 0, '2022-12-09 12:09:59', '2022-12-09 09:10:09', '2022-12-09 09:10:09', '1'),
(77, 'John Peter', '56', 'admin', '2022-12-09 12:09:59', 12, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', 'testing', '', '', '', '', 103, 0, '2022-12-09 12:09:59', '2022-12-09 09:32:35', '2022-12-09 09:32:35', '1'),
(78, 'John Peter', 'Select Agent', 'admin', '2022-12-09 12:01:20', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 20, 0, '2022-12-09 12:01:20', '2022-12-09 13:08:59', '2022-12-09 13:08:59', '1'),
(79, 'John Peter', 'Select Agent', 'admin', '2022-12-10 16:41:01', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', 'Well done', '', '', '', '', 20, 0, '2022-12-10 16:41:01', '2022-12-10 13:41:26', '2022-12-10 13:41:26', '1'),
(80, 'digital Supervisor', 'digital Agent', 'admin', '2022-12-10 17:28:49', 112, 1313, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', 'digital', '', '', '', '', 20, 0, '2022-12-10 17:28:49', '2022-12-10 14:29:20', '2022-12-10 14:29:21', '3'),
(81, 'digital Supervisor', 'Select Agent', 'admin', '2022-12-10 17:34:18', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 23, 0, '2022-12-10 17:34:18', '2022-12-10 14:34:49', '2022-12-10 14:34:49', '3'),
(82, 'DTH billing Supervisor', 'DTH billing Agent', 'admin', '2022-12-11 09:23:21', 3434, 3434, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'QA Call Category', 'QA Call Nature', 'Agent Call Category', 'Agent Call Nature', '', 'Issue Highlighted specific', '', '', '', '', '', 4, 0, '2022-12-11 09:23:21', '2022-12-11 06:24:37', '2022-12-11 06:24:37', '11'),
(84, 'John Peter', '', 'admin', '2022-12-25 12:33:17', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 26, 0, '2022-12-25 12:33:17', '2022-12-25 09:34:56', '2022-12-25 09:34:56', '1'),
(85, 'DTH billing Supervisor', 'DTH billing Agent', 'admin', '2022-12-31 07:51:20', 12121, 131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AAR ESCALATIONS', 'Agent', '', '', '', 'Issue Highlighted specific', 'q3e4131r24', '', '', '', '', 4, 0, '2022-12-31 07:51:20', '2022-12-31 04:52:21', '2022-12-31 04:52:21', '11'),
(86, 'Churn Supervisor', 'Churn Agent', 'admin', '2022-12-31 07:59:41', 765, 654, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'APPOINTMENTS', 'technology', '', '', '', 'Issue Highlighted specific', 'qacfdfqqwf', '', '', '', '', 83, 0, '2022-12-31 07:59:41', '2022-12-31 05:00:18', '2022-12-31 05:00:19', '2'),
(87, 'DTH billing Supervisor', 'DTH billing Agent', 'admin', '2022-12-31 07:51:20', 12121, 131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AAR ESCALATIONS', 'Agent', '', '', '', 'Issue Highlighted specific', 'q3e4131r24', '', '', '', '', 4, 0, '2022-12-31 07:51:20', '2022-12-31 05:01:20', '2022-12-31 05:01:20', '11'),
(88, 'DTH billing Supervisor', 'DTH billing Agent', 'admin', '2022-12-31 07:51:20', 12121, 131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AAR ESCALATIONS', 'Agent', '', '', '', 'Issue Highlighted specific', 'q3e4131r24', '', '', '', '', 4, 0, '2022-12-31 07:51:20', '2022-12-31 05:21:03', '2022-12-31 05:21:03', '11'),
(89, 'DTH billing Supervisor', '', 'admin', '2022-12-31 08:23:28', 876534, 543, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AREA OUTAGE', 'technology', '', '', '', 'Issue Highlighted specific', '324343t3yhq TGWbZGER', '', '', '', '', 4, 0, '2022-12-31 08:23:28', '2022-12-31 05:24:04', '2022-12-31 05:24:04', '11'),
(90, 'John Peter', '', 'admin', '2022-12-31 16:31:31', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AAR ESCALATIONS', 'technology', '', '', '', 'Issue Highlighted specific', 'yap', '', '', '', '', 83, 0, '2022-12-31 16:31:31', '2022-12-31 13:32:11', '2022-12-31 13:32:11', ''),
(91, 'John Peter', 'Simon Felix', 'admin', '2023-01-04 16:26:50', 123131, 13131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AAR ESCALATIONS', 'churn Offer', '', '', '', 'Issue Highlighted specific', 'tetst', '', '', '', '', 20, 0, '2023-01-04 16:26:50', '2023-01-04 13:27:25', '2023-01-04 13:27:25', 'Cable Billing'),
(92, 'John Peter', '', 'admin', '2023-01-04 16:29:02', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 40, 0, '2023-01-04 16:29:02', '2023-01-04 13:29:12', '2023-01-04 13:29:12', 'Cable Billing');
INSERT INTO `results` (`id`, `supervisor`, `agent_name`, `quality_analysts`, `date_recorded`, `customer_account`, `recording_id`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`, `q13`, `q14`, `q15`, `q16`, `q17`, `q18`, `q19`, `q20`, `q21`, `q22`, `q23`, `q24`, `q25`, `q26`, `q27`, `q28`, `q29`, `q30`, `q31`, `q32`, `q33`, `q34`, `q35`, `q36`, `q37`, `q38`, `q39`, `q40`, `q41`, `q42`, `q43`, `q44`, `q45`, `q46`, `q47`, `q48`, `q49`, `q50`, `q51`, `q52`, `q53`, `q54`, `q55`, `q56`, `q57`, `q58`, `q59`, `q60`, `qa_call_category`, `qa_call_nature`, `agent_call_category`, `agent_call_nature`, `general_issue`, `specific_issue`, `feedback_from_qc`, `supervisor_comment`, `agent_comment`, `ticket_status`, `percentage`, `results`, `totals`, `date_updated`, `created_at`, `updated_at`, `category`) VALUES
(93, 'John Peter', '', 'admin', '2023-01-04 16:55:29', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 33, 0, '2023-01-04 16:55:29', '2023-01-04 13:55:40', '2023-01-04 13:55:40', 'Cable Billing'),
(94, 'Churn Supervisor', 'Churn Agent', 'admin', '2023-01-04 17:21:51', 9876, 654, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 33, 0, '2023-01-04 17:21:51', '2023-01-04 14:22:37', '2023-01-04 14:22:37', 'Cable Churn'),
(95, 'John Peter', 'Simon Felix', 'admin', '2023-01-04 17:26:59', 12121, 12121, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', 'leoe loeoe', '', '', '', '', 20, 0, '2023-01-04 17:26:59', '2023-01-04 14:27:31', '2023-01-04 14:27:31', 'Cable Billing'),
(96, 'Churn Supervisor', 'Churn Agent', 'admin', '2023-01-04 17:31:22', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 30, 0, '2023-01-04 17:31:22', '2023-01-04 14:31:57', '2023-01-04 14:31:57', 'Cable Churn'),
(97, 'John Peter', 'Simon Felix', 'admin', '2023-01-04 17:33:10', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 20, 0, '2023-01-04 17:33:10', '2023-01-04 14:33:39', '2023-01-04 14:33:39', 'Cable Billing'),
(98, 'John Peter', '', 'admin', '2023-01-04 17:34:15', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 83, 0, '2023-01-04 17:34:15', '2023-01-04 14:34:34', '2023-01-04 14:34:34', 'Cable Billing'),
(99, 'digital Supervisor', 'digital Agent', 'admin', '2023-01-04 17:35:31', 764532, 321, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 83, 0, '2023-01-04 17:35:31', '2023-01-04 14:36:03', '2023-01-04 14:36:03', 'Cable Digital'),
(100, 'Churn Supervisor', 'Churn Agent', 'admin', '2023-01-04 17:37:43', 786543, 5434, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 83, 0, '2023-01-04 17:37:43', '2023-01-04 14:38:05', '2023-01-04 14:38:05', 'Cable Churn'),
(103, 'John Peter', '', 'admin', '2023-01-13 17:31:30', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 15, 0, '2023-01-13 17:31:30', '2023-01-13 14:31:38', '2023-01-13 14:31:38', 'Cable Billing'),
(104, 'John Peter', '', 'admin', '2023-01-13 17:33:45', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 20, 0, '2023-01-13 17:33:45', '2023-01-13 14:33:50', '2023-01-13 14:33:50', 'Cable Billing'),
(105, 'John Peter', '', 'admin', '2023-01-13 17:34:42', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 20, 0, '2023-01-13 17:34:42', '2023-01-13 14:34:48', '2023-01-13 14:34:48', 'Cable Billing'),
(106, 'John Peter', '', 'admin', '2023-01-13 17:35:29', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 14, 0, '2023-01-13 17:35:29', '2023-01-13 14:35:35', '2023-01-13 14:35:35', 'Cable Billing'),
(107, 'John Peter', '', 'admin', '2023-01-13 17:36:06', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 26, 0, '2023-01-13 17:36:06', '2023-01-13 14:36:11', '2023-01-13 14:36:11', 'Cable Billing'),
(108, 'John Peter', '', 'admin', '2023-01-13 17:38:02', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 26, 0, '2023-01-13 17:38:02', '2023-01-13 14:38:07', '2023-01-13 14:38:07', 'Cable Billing'),
(109, 'John Peter', '', 'admin', '2023-01-13 17:40:16', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 40, 0, '2023-01-13 17:40:16', '2023-01-13 14:40:22', '2023-01-13 14:40:22', 'Cable Billing'),
(110, 'John Peter', '', 'admin', '2023-01-13 17:42:51', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 60, 0, '2023-01-13 17:42:51', '2023-01-13 14:43:02', '2023-01-13 14:43:02', 'Cable Billing'),
(111, 'John Peter', '', 'admin', '2023-01-13 17:48:03', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 23, 0, '2023-01-13 17:48:03', '2023-01-13 14:48:12', '2023-01-13 14:48:12', 'Cable Billing'),
(112, 'John Peter', '', 'admin', '2023-01-13 17:48:57', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 50, 0, '2023-01-13 17:48:57', '2023-01-13 14:49:06', '2023-01-13 14:49:06', 'Cable Billing'),
(113, 'John Peter', 'Simon Felix', 'admin', '2023-01-13 17:53:31', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 15, 0, '2023-01-13 17:53:31', '2023-01-13 14:53:40', '2023-01-13 14:53:40', 'Cable Billing'),
(114, 'John Peter', 'Simon Felix', 'admin', '2023-01-13 17:53:31', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 48, 0, '2023-01-13 17:53:31', '2023-01-13 14:54:51', '2023-01-13 14:54:51', 'Cable Billing'),
(115, 'John Peter', '', 'admin', '2023-01-13 18:11:08', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 30, 0, '2023-01-13 18:11:08', '2023-01-13 15:11:20', '2023-01-13 15:11:20', 'Cable Billing'),
(116, 'John Peter', '', 'admin', '2023-01-14 19:15:05', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 56, 0, '2023-01-14 19:15:05', '2023-01-14 16:15:17', '2023-01-14 16:15:17', 'Cable Billing'),
(117, 'John Peter', '', 'admin', '2023-01-14 19:37:06', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 33, 0, '2023-01-14 19:37:06', '2023-01-14 16:37:12', '2023-01-14 16:37:12', 'Cable Billing'),
(118, 'John Peter', '', 'admin', '2023-01-14 19:48:33', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 14, 0, '2023-01-14 19:48:33', '2023-01-14 16:49:26', '2023-01-14 16:49:26', 'Cable Billing'),
(119, 'John Peter', '', 'admin', '2023-01-14 19:49:47', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 20, 0, '2023-01-14 19:49:47', '2023-01-14 16:49:55', '2023-01-14 16:49:55', 'Cable Billing'),
(120, 'John Peter', '', 'admin', '2023-01-14 20:00:36', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 30, 0, '2023-01-14 20:00:36', '2023-01-14 17:00:43', '2023-01-14 17:00:43', 'Cable Billing'),
(121, 'John Peter', '', 'admin', '2023-01-14 20:01:40', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 20, 0, '2023-01-14 20:01:40', '2023-01-14 17:01:50', '2023-01-14 17:01:50', 'Cable Billing'),
(122, 'John Peter', '', 'admin', '2023-01-14 20:10:18', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 36, 0, '2023-01-14 20:10:18', '2023-01-14 17:10:26', '2023-01-14 17:10:26', 'Cable Billing'),
(123, 'John Peter', '', 'admin', '2023-01-14 20:44:41', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 50, 0, '2023-01-14 20:44:41', '2023-01-14 17:44:50', '2023-01-14 17:44:51', 'Cable Billing'),
(124, 'John Peter', '', 'admin', '2023-01-14 20:56:05', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 40, 0, '2023-01-14 20:56:05', '2023-01-14 17:56:11', '2023-01-14 17:56:12', 'Cable Billing'),
(125, 'Churn Supervisor', '', 'admin', '2023-01-15 10:03:11', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 50, 0, '2023-01-15 10:03:11', '2023-01-15 07:03:22', '2023-01-15 07:03:22', 'Cable Churn'),
(126, 'John Peter', '', 'admin', '2023-01-15 10:03:48', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 0, 0, '2023-01-15 10:03:48', '2023-01-15 07:04:04', '2023-01-15 07:04:04', 'Cable Billing'),
(129, 'Churn Supervisor', '', 'admin', '2023-01-15 10:04:50', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 10, 0, '2023-01-15 10:04:50', '2023-01-15 07:05:02', '2023-01-15 07:05:02', 'Cable Churn'),
(130, 'inbound supervisor', '', 'admin', '2023-01-15 10:05:37', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 0, 0, '2023-01-15 10:05:37', '2023-01-15 07:05:46', '2023-01-15 07:05:46', 'Cable Inbound'),
(131, 'John Peter', '', 'admin', '2023-01-18 16:45:10', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', 'Issue Highlighted specific', '', '', '', '', '', 50, 0, '2023-01-18 16:45:10', '2023-01-18 13:45:20', '2023-01-18 13:45:20', 'Cable Billing'),
(132, 'DTH billing Supervisor', 'DTH billing Agent', 'admin', '2023-01-21 14:40:56', 1212121, 21212, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SLOW SPEEDS', 'technology', '', '', '', 'Issue Highlighted specific', 'wqergtryu', '', '', '', '', 4, 0, '2023-01-21 14:40:56', '2023-01-21 11:41:27', '2023-01-21 11:41:27', 'DTH Billing');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(2, 'admin', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(3, 'moderator', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(4, 'developer', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(5, 'user', 'web', '2022-12-03 04:47:20', '2022-12-03 04:47:20'),
(6, 'Quality Analysts', 'web', '2022-12-03 05:19:25', '2022-12-03 05:19:25'),
(7, 'Supervisor', 'web', '2022-12-03 05:19:48', '2022-12-03 05:19:48'),
(8, 'Agent', 'web', '2022-12-03 05:20:13', '2022-12-03 05:20:13'),
(9, 'Trainer', 'web', '2023-01-21 04:26:58', '2023-01-21 04:26:58'),
(10, 'Team Leader', 'web', '2023-01-21 04:31:58', '2023-01-21 04:31:58'),
(11, 'Test A', 'web', '2023-01-21 04:33:55', '2023-01-21 04:33:55');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(6, 3),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(10, 3),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(13, 3),
(13, 4),
(14, 1),
(14, 2),
(15, 5);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 'Cable', '1', NULL, NULL),
(2, 'DTH', '2', NULL, NULL),
(3, 'Global', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_call_trackers`
--

CREATE TABLE `sub_call_trackers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_call_tracker` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_tracker_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_call_trackers`
--

INSERT INTO `sub_call_trackers` (`id`, `sub_call_tracker`, `call_tracker_id`, `service_id`, `log`, `created_at`, `updated_at`) VALUES
(1, 'churn Offer', '5', NULL, NULL, NULL, NULL),
(2, 'Account number inquiry', '1', NULL, NULL, NULL, NULL),
(3, 'Acquiring network Ip', '1', NULL, NULL, NULL, NULL),
(4, 'Slow connection', '1', NULL, NULL, '2023-01-15 07:49:16', '2023-01-15 07:49:16');

-- --------------------------------------------------------

--
-- Table structure for table `summaries`
--

CREATE TABLE `summaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `summary_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `summaries`
--

INSERT INTO `summaries` (`id`, `summary_title`, `summary_name`, `service_id`, `created_at`, `updated_at`) VALUES
(2, 'Strength Summary', 'Customer education', NULL, '2023-01-10 13:44:28', '2023-01-10 13:44:28'),
(3, 'Strength Summary', 'call personalization', NULL, '2023-01-10 13:46:19', '2023-01-10 13:46:19'),
(4, 'Strength Summary', 'Offer Further Assistance', NULL, '2023-01-10 13:46:42', '2023-01-10 13:46:42'),
(5, 'Strength Summary', 'Contacts Details verification', NULL, '2023-01-10 13:46:56', '2023-01-10 13:46:56'),
(6, 'Strength Summary', 'Good Troubleshooting Steps', NULL, '2023-01-10 13:47:19', '2023-01-10 13:47:19'),
(12, 'Strength Summary', 'call control', NULL, '2023-01-10 15:30:19', '2023-01-10 15:30:19'),
(13, 'VOC Summary', 'Happy with Service', NULL, '2023-01-10 15:34:42', '2023-01-10 15:34:42'),
(14, 'VOC Summary', 'Poor Services', NULL, '2023-01-10 15:35:49', '2023-01-10 15:35:49'),
(15, 'VOC Summary', 'slow connection', NULL, '2023-01-10 15:36:15', '2023-01-10 15:36:15'),
(16, '', '', NULL, '2023-01-21 09:54:59', '2023-01-21 09:54:59');

-- --------------------------------------------------------

--
-- Table structure for table `upload_calls`
--

CREATE TABLE `upload_calls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `agent_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supervisor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qa_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_rating` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `upload_calls`
--

INSERT INTO `upload_calls` (`id`, `agent_name`, `supervisor_name`, `call_category`, `qa_name`, `call_rating`, `call_date`, `call_file`, `created_at`, `updated_at`) VALUES
(4, 'DTHChurn Agent', 'DTH inbound Supervisor', 'Cable Escalation Matrix', 'Quality Analysts 1', '1', '2023-01-24', 'C:\\xampp\\tmp\\phpD1D5.tmp', '2023-01-23 16:48:53', '2023-01-23 16:48:53'),
(5, 'Simon Felix', 'Churn Supervisor', 'Cable Churn', 'Quality Analysts 1', '1', '2023-01-24', 'C:\\xampp\\htdocs\\Wananchi\\zuku\\monitoring\\public\\assets\\1674502133.mp3', '2023-01-24 00:29:19', '2023-01-24 00:29:19'),
(6, 'DTHChurn Agent', 'digital Supervisor', 'Cable Service Support', 'Quality Analysts 1', '2', '2023-01-24', 'C:\\xampp\\tmp\\php7AF8.tmp', '2023-01-24 00:49:55', '2023-01-24 00:49:55'),
(7, 'DTHChurn Agent', 'DTH shops supervisor', 'DTH Billing', 'Quality Analysts 1', '2', '2023-01-24', 'C:\\xampp\\tmp\\phpCBB6.tmp', '2023-01-24 00:54:37', '2023-01-24 00:54:37'),
(8, 'Simon Felix', 'DTH billing Supervisor', 'Cable Outbound', 'Quality Analysts 1', '1', '2023-01-24', 'C:\\xampp\\tmp\\php1F78.tmp', '2023-01-24 01:12:27', '2023-01-24 01:12:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_status` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `log` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `is_admin`, `email`, `country`, `services`, `category`, `position`, `user_status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `log`) VALUES
(1, 'super admin', 1, 'super@admin.com', 'Global', '1', 'Global', 'System Admin', 1, '2022-12-03 04:47:20', '$2y$10$ogjapN.vmOG/m0AgXoPkKevMsFaE9Sue3A0IPJhKapTJl1PeOSRp2', 'vAuD4ZEWtf', '2022-12-03 04:47:20', '2022-12-03 04:47:20', NULL),
(2, 'admin', 1, 'admin@admin.com', 'Global', '0', 'Global', 'System Admin', 1, '2022-12-03 04:47:20', '$2y$10$fppT4xuH7HdBCf1H5NS3Gea8Abf7qZ1RnxK/BECBxEjaDiZxekejW', 'UlPO1whjOtBgQ8tSrDzMbjLIvypNOUgEain9e36whtlAIIjt4Ktzuq58WaaK', '2022-12-03 04:47:20', '2022-12-03 04:47:20', NULL),
(3, 'moderator', 1, 'moderator@admin.com', 'Global', '0', 'Global', 'System Admin', 1, '2022-12-03 04:47:20', '$2y$10$o1iTMtQEQy1MMfbGoJyekeM4u2EWkpp0XZ/ZDQz7H0K8Cj96DTnpW', 'XuVHsWWQtb', '2022-12-03 04:47:20', '2022-12-03 04:47:20', NULL),
(4, 'developer', 1, 'developer@admin.com', 'Global', '0', 'Global', 'System Admin', 1, '2022-12-03 04:47:20', '$2y$10$OF3GWDbeJBkK3r9GjAWTtuZthd3aYwzcZ0PkFeab5IjqtOP3mXJI.', 'lx3NjBkO2M', '2022-12-03 04:47:21', '2022-12-03 04:47:21', NULL),
(5, 'test', 0, 'test@test.com', 'Kenya', '1', 'inbound', 'Agent', 1, '2022-12-03 04:47:21', '$2y$10$Jh4V43VEnw1ySFImpRYzTeSj7JWTKTrilLF5wj8Cp5.YAKHlNh92W', '1qJzUiYJ63', '2022-12-03 04:47:21', '2022-12-03 04:47:21', NULL),
(55, 'John Peter', 0, 'Johnpeter@monitoring.com', 'Kenya', '1', '1', 'Supervisor', 1, NULL, '$2y$10$5Lvw8SV8yg/sfRyeslPV6eKkMjMLF4RdKBP3NHCJc/5LLIjLbObCa', NULL, '2022-12-03 05:17:28', '2022-12-03 05:17:28', NULL),
(56, 'Simon Felix', 0, 'simonfelix@monitoring', 'Kenya', '1', '1', 'Agent', 1, NULL, '$2y$10$BLcKM65ox3x7IMuWHeNAweJ4UNzuRbAa3F7K1QonBygyMoLTHwoWS', NULL, '2022-12-03 05:18:51', '2022-12-03 05:18:51', NULL),
(57, 'Churn Supervisor', 0, 'Churn@monitoring.com', 'Kenya', '1', '2', 'Supervisor', 1, NULL, '$2y$10$3SZw3Ev6DVcWYW7XVqIaM.ZYqF9g6Z56svdzXQhjeYZtBRP1qD.J2', NULL, '2022-12-07 15:05:01', '2022-12-07 15:05:01', NULL),
(58, 'Churn Agent', 0, 'agent@monitoring.com', 'Kenya', '1', '2', 'Agent', 1, NULL, '$2y$10$HCsjXnBl7DHfIphm3dHTN.i4lEDljD9/l8VnuMsnrPgr5IOF1kxg6', NULL, '2022-12-07 15:05:51', '2022-12-07 15:05:51', NULL),
(59, 'digital Supervisor', 0, 'Digital@monitoring.com', 'Kenya', '1', '3', 'Supervisor', 1, NULL, '$2y$10$eXoG5kGIY8tvF6SbHNqBgOyXEzF2V08ytUO7rOmHwaYgVTiCpjIRq', NULL, '2022-12-10 14:10:18', '2022-12-10 14:10:18', NULL),
(60, 'digital Agent', 0, 'dAgent@monitoring', 'Kenya', '1', '3', 'Agent', 1, NULL, '$2y$10$FZTXpt8bq7FSIrmDgrNtle991AP.305/Qj0Yz8oZSxn1qeGR7i10e', NULL, '2022-12-10 14:10:54', '2022-12-10 14:10:54', NULL),
(61, 'DTH billing Supervisor', 0, 'dthbillingSupervisor@monitoring.com', 'Kenya', '2', '11', 'Supervisor', 1, NULL, '$2y$10$O2yh62jUmZRYHVBskwDfeuvziK9JAKjpLVFfCfPY.uvUe28lVrfP.', NULL, '2022-12-10 15:00:11', '2022-12-10 15:00:11', NULL),
(62, 'DTH billing Agent', 0, 'Dthbillingagent@monitoring.com', 'Kenya', '2', '11', 'Agent', 1, NULL, '$2y$10$YJSNylaRuRH4SKGnQ76xvuS/KhZlltNAtazAfDrHGihufcaHyrTky', NULL, '2022-12-10 15:00:56', '2022-12-10 15:00:56', NULL),
(63, 'Dth churn Supervisor', 0, 'Dthchurn@monitoring.com', 'Kenya', '2', '12', 'Supervisor', 1, NULL, '$2y$10$sMws.fx5AmLWZqpNy44fhOoT7u3fpxatj4QgXxnHLgEPFfiBDBeRa', NULL, '2022-12-10 16:00:30', '2022-12-10 16:00:30', NULL),
(64, 'DTHChurn Agent', 0, 'Dthchurnagent@mony.com', 'Kenya', '2', '12', 'Agent', 1, NULL, '$2y$10$nJxjjWGKen9xlEAX91twMuzppR3Wqm0LvriTosd8XxFOs2LNLkPqy', NULL, '2022-12-10 16:01:36', '2022-12-10 16:01:36', NULL),
(65, 'DTH digital Supervisor', 0, 'dthcSupervisor@monitoring.com', 'Kenya', '2', '13', 'Supervisor', 1, NULL, '$2y$10$izAHPc1kJbevNSASJuahUunYFdHs/7Pb6xCGUGKHbQ6ai7tJG0Sli', NULL, '2022-12-10 16:04:23', '2022-12-10 16:04:23', NULL),
(66, 'DTH inbound Supervisor', 0, 'Dthinboundsupervisor@m.com', 'Kenya', '2', '14', 'Supervisor', 1, NULL, '$2y$10$qXoEtKuWZNS8J4k1XQiAvuNegLiBNVRXXV59j10oZ.niA7h0Dd9m2', NULL, '2022-12-10 16:05:52', '2022-12-10 16:05:52', NULL),
(67, 'DTH live calls Supervisor', 0, 'dthlivecallsSupervisor@m.com', 'Kenya', '2', '18', 'Supervisor', 1, NULL, '$2y$10$0VVkDpdrwJQnqq2Yz/8ycuXih2O1aVdMR8Hhn6ymaxWrNFwzJty2C', NULL, '2022-12-11 03:17:12', '2022-12-11 03:17:12', NULL),
(68, 'dth outbound Supervisor', 0, 'dthoutboudsup@m.com', 'Kenya', '2', '15', 'Supervisor', 1, NULL, '$2y$10$8OaJQxQrDgJHNo.Lw4MGLeSFsbvJ48f.aQIIhjh19ii4kpNjfuj1y', NULL, '2022-12-11 03:31:28', '2022-12-11 03:31:28', NULL),
(69, 'dth Service Support Supervisor', 0, 'DthSupersiver@m.com', 'Kenya', '2', '17', 'Supervisor', 1, NULL, '$2y$10$vcQDcc4IOMngqnO4IOZqIeXPf6rzNwkib9QcZjdltJhhElLGbuzzm', NULL, '2022-12-11 03:50:36', '2022-12-11 03:50:36', NULL),
(70, 'DTH shops supervisor', 0, 'dthshopsup@m.com', 'Kenya', '2', '16', 'Supervisor', 1, NULL, '$2y$10$1EqKoGcsgM5Qlas3.uK43O16zmf3ma0Wxn3wb5AsBkhUwk6b2dQXa', NULL, '2022-12-11 04:12:21', '2022-12-11 04:12:21', NULL),
(71, 'DTH Escalation Supervisor', 0, 'DEsup@m.com', 'Kenya', '2', '19', 'Supervisor', 1, NULL, '$2y$10$1msJXsS3Z2s2opfaPsvRZONjaO4U3pHgEdO9gIj4oCQ8UxQD5EaNS', NULL, '2022-12-11 04:17:57', '2022-12-11 04:17:57', NULL),
(72, 'Dth Welcome Supervisor', 0, 'dwsup@m.com', 'Kenya', '2', '20', 'Supervisor', 1, NULL, '$2y$10$SarOBgR5S/Hs05Woos7D8.HNTwy6HUniw7lRU7K3.AFcSr.HqLdHa', NULL, '2022-12-11 04:42:50', '2022-12-11 04:42:50', NULL),
(73, 'Welcome Supervisor', 0, 'Wecsup@mail.com', 'Kenya', '1', '10', 'Supervisor', 1, NULL, '$2y$10$HIvfvJJWoZZCFX1KzY6HgeRcAWs.uXQZo1cp65j28B8jFnB3YCWyq', NULL, '2022-12-11 05:08:28', '2022-12-11 05:08:28', NULL),
(74, 'Escalation Supervisor', 0, 'EscaSup@ma.com', 'Kenya', '1', '9', 'Supervisor', 1, NULL, '$2y$10$Fs8JxvbxUNPdRe1f07HAz.hX4UpSKhkJTXvgrx88F09VWJCvz4dwG', NULL, '2022-12-11 05:09:08', '2022-12-11 05:09:08', NULL),
(75, 'inbound supervisor', 0, 'inbdsup@m.com', 'Kenya', '1', '4', 'Supervisor', 1, NULL, '$2y$10$rjWcO4wuT2UlBrfi2kd1../DNHyRadkmGiSTfnLSKK6G5gy.VutZS', NULL, '2022-12-11 05:09:43', '2022-12-11 05:09:43', NULL),
(76, 'outbound Supervisor', 0, 'outbousup@m.com', 'Kenya', '1', '5', 'Supervisor', 1, NULL, '$2y$10$hHpMNk.teZEbY0shySOsbOHb5kxPeyJ3S15pIaECd8knVzXWss7/q', NULL, '2022-12-11 05:31:18', '2022-12-11 05:31:18', NULL),
(77, 'livecalls Supervisor', 0, 'livrca@m.com', 'Kenya', '1', '8', 'Supervisor', 1, NULL, '$2y$10$5ar6pDkJST1/oxCqby8LVup/Nss2PC1dIryMtHe07ctllvELRCaSW', NULL, '2022-12-11 05:31:45', '2022-12-11 05:31:45', NULL),
(78, 'Service Support Supervisor', 0, 'Sersuosop@m.com', 'Kenya', '1', '7', 'Supervisor', 1, NULL, '$2y$10$v/Gagr05gqT5a8XsoVUd5e8tnx67AsgpyKFRvbCmls90BRCt.3FMu', NULL, '2022-12-11 05:56:58', '2022-12-11 05:56:58', NULL),
(79, 'shops Supervisor', 0, 'shopsSup@m.com', 'Kenya', '1', '6', 'Supervisor', 1, NULL, '$2y$10$fSwKDJs39SqNoS4L4kAPO.PrpJp/yrz3WJka1T508JGN2Ev.uuNIW', NULL, '2022-12-11 06:12:40', '2022-12-11 06:12:40', NULL),
(80, 'Quality Analysts 1', 0, 'qualityanalyst@monitoring.com', 'Kenya', '1', '1', 'Quality Analyst', 1, NULL, '$2y$10$Iay0016zO2vpOFylDM4C.OCf2.uDJGhB8bDw2fyTAZFmCuzRgPa3G', NULL, '2023-01-15 12:46:29', '2023-01-15 12:46:29', NULL),
(81, 'Trainer', 0, 'Trainer@monitoring.com', 'Kenya', '1', '1', 'Trainer', 1, NULL, '$2y$10$1fupAe7upiTMgCnaCocrlet50rPq6BWOTUTvZ5YEsyZDsysr6.1fy', NULL, '2023-01-15 12:47:17', '2023-01-15 12:47:17', NULL),
(82, 'live Calls', 0, 'admin@live.com', 'Global', '3', '8', 'Supervisor', 1, NULL, '$2y$10$yXSzJeHTg8KG7FsMSy.mCulbQV2UZJLeCUPGfOUgZKIIZvYzhGcX6', NULL, '2023-01-21 11:26:24', '2023-01-21 11:26:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vo_c_summaries`
--

CREATE TABLE `vo_c_summaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `voc_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voc_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `service_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alert_forms`
--
ALTER TABLE `alert_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answer_keys`
--
ALTER TABLE `answer_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `call_ratings`
--
ALTER TABLE `call_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `call_trackers`
--
ALTER TABLE `call_trackers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conduct_exams`
--
ALTER TABLE `conduct_exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exams_questions`
--
ALTER TABLE `exams_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_statuses`
--
ALTER TABLE `exam_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fiber_welcome_questions`
--
ALTER TABLE `fiber_welcome_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gap_summaries`
--
ALTER TABLE `gap_summaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_generals`
--
ALTER TABLE `issue_generals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_calls`
--
ALTER TABLE `live_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_calls_results`
--
ALTER TABLE `live_calls_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_results`
--
ALTER TABLE `question_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_call_trackers`
--
ALTER TABLE `sub_call_trackers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `summaries`
--
ALTER TABLE `summaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_calls`
--
ALTER TABLE `upload_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vo_c_summaries`
--
ALTER TABLE `vo_c_summaries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alert_forms`
--
ALTER TABLE `alert_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `answer_keys`
--
ALTER TABLE `answer_keys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `call_ratings`
--
ALTER TABLE `call_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `call_trackers`
--
ALTER TABLE `call_trackers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `conduct_exams`
--
ALTER TABLE `conduct_exams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `exams_questions`
--
ALTER TABLE `exams_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam_statuses`
--
ALTER TABLE `exam_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fiber_welcome_questions`
--
ALTER TABLE `fiber_welcome_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `gap_summaries`
--
ALTER TABLE `gap_summaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `issue_generals`
--
ALTER TABLE `issue_generals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `live_calls`
--
ALTER TABLE `live_calls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `live_calls_results`
--
ALTER TABLE `live_calls_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `question_results`
--
ALTER TABLE `question_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sub_call_trackers`
--
ALTER TABLE `sub_call_trackers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `summaries`
--
ALTER TABLE `summaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `upload_calls`
--
ALTER TABLE `upload_calls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `vo_c_summaries`
--
ALTER TABLE `vo_c_summaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
