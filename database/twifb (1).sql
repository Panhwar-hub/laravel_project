-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2023 at 02:13 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twifb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `remember_token` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `type` tinyint(4) NOT NULL DEFAULT 1,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `type`, `is_active`, `is_deleted`) VALUES
(1, 'Admin', 'admin@twifb.com', '$2y$10$OI0LtvhLLzNfpvaEayjRheADYjch8w9GprrLyYRkxjS4ZBBfAXf02', NULL, '2021-11-02 04:13:26', '2023-03-28 22:18:03', 1, 1, 0),
(2, 'Mini Admin', 'miniadmin@edusaurus.com', '$2y$10$6J6TIyS9OukhUja3eDgAWeKkFmuf79qdkqsFkO27IbuG03MVOD.Fq', NULL, '2021-12-16 00:49:41', '2021-12-16 00:49:41', 2, 1, 0),
(3, 'Micro Admin', 'microadmin@edusaurus.com', '$2y$10$USir5ABhvNFAxrHKfP/7q.W/Aq.ILS9nfIWMGtp.guxXCrlmtsuTe', NULL, '2021-12-16 00:50:01', '2021-12-16 00:50:01', 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` text CHARACTER SET utf8 DEFAULT NULL,
  `short_desc` text CHARACTER SET utf8 DEFAULT NULL,
  `long_desc` text CHARACTER SET utf8 NOT NULL,
  `posted_by` varchar(255) DEFAULT NULL,
  `blog_img` text CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `slug`, `short_desc`, `long_desc`, `posted_by`, `blog_img`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
(7, 'Place Your Title Here', 'place-your-title-here', '<p>Lorem ipsum dolor sit amet, consectetur</p>', '<p>Lorem ipsum dolor sit amet, consectetur</p>', NULL, 'Uploads/news/thumbnails/742946701718/GAiM42MLj30j0SiK7nnbyEIQFPfMHDaP2e915JCh.jpg', '2022-04-21 11:48:29', '2022-04-27 21:00:58', 1, 0),
(8, 'Place Your Title Here 2', 'place-your-title-here-2', '<p>Lorem ipsum dolor sit amet, consectetur</p>', '<p>Lorem ipsum dolor sit amet, consectetur</p>', NULL, 'Uploads/news/thumbnails/8136277658542/yeOAU97XfVWCwdP3mnktURjp5UW9BtzrcX8byxjP.jpg', '2022-04-21 11:49:25', '2022-04-21 11:49:25', 1, 0),
(9, 'Place Your Title Here 3', 'place-your-title-here-3', '<p>Lorem ipsum dolor sit amet, consectetur</p>', '<p>Lorem ipsum dolor sit amet, consectetur</p>', NULL, 'Uploads/news/thumbnails/9188037345385/EOV5jQ4oxiQOZvqFsJwsMRXbUhRGXiNfPCUdmH6X.jpg', '2022-04-21 11:49:54', '2022-04-21 11:49:54', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_menu` tinyint(11) DEFAULT 0,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `title`, `slug`, `img_path`, `is_active`, `is_menu`, `is_deleted`, `created_at`, `updated_at`) VALUES
(3, 'Voyager', 'voyager', NULL, 1, 0, 0, '2022-06-17 10:51:46', '2023-03-10 18:46:02'),
(4, 'Mariner', 'mariner', NULL, 1, 0, 0, '2022-06-17 10:52:19', '2023-03-10 18:46:13'),
(5, 'Atlantis', 'atlantis', NULL, 1, 0, 0, '2022-06-17 10:52:50', '2023-03-10 18:46:22'),
(6, 'ORCA Shower Valves', 'orca-shower-valves', NULL, 1, 0, 0, '2022-06-17 10:53:40', '2023-03-28 20:10:32'),
(7, 'ORCA 2 Shower Valves', 'orca-2-shower-valves', NULL, 1, 0, 0, '2023-03-10 18:46:44', '2023-03-28 20:10:51'),
(8, 'Beacon', 'beacon', NULL, 1, 0, 0, '2023-03-10 18:46:52', '2023-03-10 18:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_menu` int(3) DEFAULT 0,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `slug`, `title`, `is_active`, `is_menu`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'restaurants', 'Restaurants', 1, 1, 0, '2023-03-30 13:43:26', '2023-03-30 13:43:26'),
(2, 'music', 'Music', 1, 1, 0, '2023-03-30 13:43:38', '2023-03-30 13:43:38'),
(3, 'events', 'Events', 1, 1, 0, '2023-03-30 13:43:48', '2023-03-30 13:43:48'),
(4, 'lifestyle', 'Lifestyle', 1, 1, 0, '2023-03-30 13:44:01', '2023-03-30 13:44:01'),
(5, 'art-and-museums', 'Art & Museums', 1, 1, 0, '2023-03-30 17:02:07', '2023-04-10 19:52:27'),
(6, 'new_to_the_area', 'New To The Area', 1, 1, 0, '2023-03-30 17:17:12', '2023-03-30 17:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `product_id`, `price`, `name`, `code`, `qty`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
(1, 2, 10, 'Red', '#ff0000', 5, '2023-03-16 16:34:16', '2023-03-23 19:59:52', 1, 0),
(2, 2, 25, 'Blue', '#0000ff', 20, '2023-03-16 16:34:39', '2023-03-23 19:59:52', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `flag_type` varchar(255) DEFAULT NULL,
  `flag_value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `flag_additionalText` text DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  `is_deleted` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `flag_type`, `flag_value`, `created_at`, `updated_at`, `flag_additionalText`, `is_active`, `is_deleted`) VALUES
(1963, 'FACEBOOK', 'https://www.facebook.com/', '2021-11-10 03:49:50', '2021-11-10 03:49:50', 'https://www.facebook.com/', 1, 0),
(1964, 'INSTAGRAM', 'https://www.instagram.com/', '2021-11-10 03:49:50', '2021-11-10 03:49:50', 'https://www.instagram.com/', 1, 0),
(1965, 'YOUTUBE', 'https://www.youtube.com/', '2021-11-10 03:49:50', '2023-03-29 20:02:22', 'https://www.youtube.com/', 1, 0),
(1966, 'COMPANYEMAIL', 'info@showerbuddy.com', '2021-11-10 03:49:50', '2023-03-07 18:58:06', 'example@example.com', 1, 0),
(1967, 'COMPANYPHONE', '1-888-287-1757', '2021-11-10 03:49:50', '2023-03-07 18:57:32', '888-508-1933', 1, 0),
(1968, 'COMPANYADDRESS', 'Address: 9419 E. San Salvador Dr. Suite # 102 Scottsdale, AZ 85258', '2021-11-10 03:49:50', '2023-03-07 20:06:03', '199 Lee Ave Suite 987 Brooklyn,NY', 1, 0),
(1969, 'EXTERNALEMAIL', 'sales@showerbuddy.com', '2022-02-21 16:25:48', '2023-03-07 20:07:00', 'recoveryhub@recoveryhub.com', 1, 0),
(1970, 'TWITTER', 'https://www.twitter.com/', '2022-02-21 16:26:17', '2023-03-29 20:02:29', 'https://www.twitter.com/', 1, 0),
(1971, 'EXTRADELIVERYFEE', '5', '2022-04-18 18:17:53', '2023-03-07 20:11:11', '5', 0, 0),
(1972, 'TAX', '7', '2022-04-18 18:19:36', '2023-03-07 20:11:14', '7', 0, 0),
(1973, 'DAMAGEWAIVER', '10', '2022-04-18 18:20:54', '2023-03-07 20:11:15', '10', 0, 0),
(1974, 'PINTEREST', 'https://www.pinterest.com/', '2022-04-20 22:12:22', '2023-03-07 20:11:18', 'https://www.pinterest.com/', 0, 0),
(1975, 'LINKEDIN', 'https://www.linkedin.com/', '2022-04-20 22:12:50', '2023-03-29 20:02:35', 'https://www.linkedin.com/', 1, 0),
(1976, 'APPLICATIONPRICE', '150', '2022-12-19 22:06:48', '2023-03-07 20:11:24', '150', 0, 0),
(1977, 'PROGRAMPRICE', '200', '2022-12-19 22:15:21', '2023-03-07 20:11:26', '200', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `page_name` varchar(500) DEFAULT NULL,
  `page_heading` text CHARACTER SET utf8 DEFAULT NULL,
  `content1` text CHARACTER SET utf8 DEFAULT NULL,
  `content2` text CHARACTER SET utf8 DEFAULT NULL,
  `content3` text CHARACTER SET utf8 DEFAULT NULL,
  `content4` text CHARACTER SET utf8 DEFAULT NULL,
  `content5` text CHARACTER SET utf8 DEFAULT NULL,
  `content6` text CHARACTER SET utf8 DEFAULT NULL,
  `content7` text CHARACTER SET utf8 DEFAULT NULL,
  `img1` text CHARACTER SET utf8 DEFAULT NULL,
  `img2` text CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `page_name`, `page_heading`, `content1`, `content2`, `content3`, `content4`, `content5`, `content6`, `content7`, `img1`, `img2`, `created_at`, `updated_at`) VALUES
(1, 'HOME-PAGE', 'Check It Out Let’s Explore', '<h5 class=\"black-30\" data-aos=\"fade-up\" data-aos-duration=\"1500\">To Do...</h5>\r\n\r\n<p class=\"web-p\" data-aos=\"fade-up\" data-aos-duration=\"2500\">Explore and navigate for activities, games, puzzles and let your imagination go wild&hellip;</p>', '<h5 class=\"black-30\" data-aos=\"fade-up\" data-aos-duration=\"1500\">To Know...</h5>\r\n\r\n<p class=\"web-p\" data-aos=\"fade-up\" data-aos-duration=\"2500\">What do you want to know? Explore our portal, and find the answers&hellip;</p>', '<h5 class=\"black-30\" data-aos=\"fade-up\" data-aos-duration=\"1500\">To Be...</h5>\r\n\r\n<p class=\"web-p\" data-aos=\"fade-up\" data-aos-duration=\"2500\">Imagine yourself as an Astronaut, Doctor, Inventor Scientist &ndash; It is all possible here&hellip;</p>', '<p>Here we hope you will find, explore, and contribute helpful educational and learning content links and that helps educators and learners be more successful in enriching their lives, relationships, and the human condition. Our community services are offered at no cost and promotes no-cost, no-subscription, no-advertising online educational content.</p>\r\n\r\n<p>Community members benefit with unlimited content search results and weblink click-throughs, educator tools, content contributor features, and student user dynamic learning.</p>', '<h5 class=\"dark-gren-46 py-2\" data-aos=\"fade-up\" data-aos-duration=\"1500\">About US</h5>\r\n\r\n<p class=\"web-p\" data-aos=\"fade-up\" data-aos-duration=\"1500\">Edusuaras.Works is brought to you by the technically creative people at The V.I.E.W. Program, a non-profit organization created to help improve online learning content for use by Educators with Students that sparks interests, curiosity, learning, and retention through ever increasingly meaningful, interactive, and immersive learning materials offered online by hundreds of external providers.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p class=\"web-p\" data-aos=\"fade-up\" data-aos-duration=\"2000\">Learn more about our mission, programs, and initiatives at <a class=\"orng-txt\" href=\"www.viewprogram.org\" target=\"_blank\">www.viewprogram.org</a>.</p>\r\n\r\n<p>&nbsp;</p>', '<h5 class=\"dark-gren-46 py-2\" data-aos=\"fade-up\" data-aos-duration=\"1500\">Our Mission</h5>\r\n\r\n<p class=\"web-p\" data-aos=\"fade-up\" data-aos-duration=\"1500\">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Loremnonumy eirmod tempor invidunt ut labore.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p class=\"web-p\" data-aos=\"fade-up\" data-aos-duration=\"2000\">At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna.</p>\r\n\r\n<p>&nbsp;</p>', '<h4 class=\"whit-txt-46\" data-aos=\"fade-up\" data-aos-duration=\"2000\">What Our Families are Saying</h4>\r\n\r\n<p class=\"web-p-whit\" data-aos=\"fade-up\" data-aos-duration=\"3000\">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,<br />\r\nsed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus<br />\r\nest Loremnonumy eirmod tempor invidunt ut labore.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p class=\"web-p-whit\" data-aos=\"fade-up\" data-aos-duration=\"3000\">At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br />\r\nLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna.</p>\r\n\r\n<p>&nbsp;</p>', 'Uploads/cms_images/167245057384/NtT8QfTy3BFTqD1u9jmAh1Z655mmT3TQOfjSClFR.png', 'Uploads/cms_images/1149086253271/tx9X5ZEYknwmqqOwb50FQuijCW0Sz0QoW8l7f3vP.png', '2021-11-16 06:12:26', '2021-11-17 00:54:38'),
(2, 'EXPLORER', 'Explore your imagination, interests, and the human experience…', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-17 03:50:04', '2021-11-17 01:00:28'),
(3, 'EDUCATOR', 'Open a child’s mind to the opportunities, possibilities, courage, and resilience of life’s lessons…', '<p class=\"text-center text-box\">The V.I.E.W. Program, the non-profit organization that brought you Edusauras.Works, has an initiative to develop ‘Lesson Subpages’ for teachers to make interactive lessons for students using online learning content links.</p>\r\n                <p class=\"mb-3\">Educators will have the ability to assign to students a URL with entry password for the created lessons and assign students a unique Name ID used for performance tracking purposes.   Actual student names and emails are not required to complete the lessons.</p>\r\n                <p class=\"mb-3\">Educators will be able to mark created lessons as ‘private’ or ‘public’ whereby with the later the created lesson will be made available as a template to other Educators within our community for customization and use in their own Lesson Subpage student activities.</p>', '<p class=\"mb-3\">We greatly value your suggestions, comments, and discussion on any of our features or community service deliverables.</p>\r\n                <p class=\"mb-3\">Thank you for your service to children!</p>\r\n                <p>Al Sutcavage, <br>\r\n                    Executive Director <br>\r\n                    The V.I.E.W. Program\r\n                </p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-17 04:02:08', '2021-11-16 23:15:34'),
(4, 'CONTRIBUTE', 'Help contribute to our future…', '<p class=\"text-center\">While we appreciate cash donations <a href=\"#\" target=\"_blank\" class=\"orng-txt\">(click here to donate)</a>, there are many other significant ways to help contribute to our community service</p>', '<h5 class=\"dark-gren-24 mb-3\">Contribute Website Content Links</h5>\r\n                    <p class=\"web-p\">We encourage you to submit any and all online educational content links that you have found and feel might benefit our community via our website service.   Links can be added online manually, via CSV file upload, or emailed to <a href=\"mailto:contact@edusauras.works\" class=\"orng-txt\">contact@edusauras.works</a>. We seek quality learning content links to websites that do not require purchase, subscription, or use distracting commercial advertising. <a href=\"#\" target=\"_blank\" class=\"orng-txt\">Click here to Contribute Links</a>.</p>', '<h5 class=\"dark-gren-24 mb-3\">Educator Pages</h5>\r\n\r\n<p class=\"web-p\">Teachers are welcome to create Lesson Subpages for their own use with students and for template use by other Teachers. This feature is in stage one of development, but we hope to gain further Educator feedback and funding to develop it into an advanced and attractive tool for Teachers. Click here to build <a class=\"orng-txt\" href=\"#\" target=\"_blank\">Educator Subpages</a>.</p>', '<h5 class=\"dark-gren-24 mb-3\">Help Manage Content</h5>\r\n\r\n<p class=\"web-p mb-2\">Help us bring more content available to our community that is otherwise not so easily found on the Internet. We need volunteers to help us review and publish content links found by our exclusive web crawler technology and lists submitted by users.</p>\r\n\r\n<p class=\"web-p\">Contact us at <a class=\"orng-txt\" href=\"contact@edusauras.works\">contact@edusauras.works</a> to talk with us about the many ways you may help by contributing a portion of your time, skills, or knowledge to better our service to our community.</p>', '<h5 class=\"dark-gren-24 mb-3\">Innovation</h5>\r\n\r\n<p class=\"web-p mb-2\">We look to constantly improve our value to our community of Teachers and Students that inspires interest, exploration, and positive impact on young people&rsquo;s lives.</p>\r\n\r\n<p class=\"web-p\">We seek partnerships and collaboration with experienced educators, developmental experts, content creators, and technologists who can add to our expertise and effectiveness in better serving our mission and community outcomes.</p>', NULL, NULL, NULL, NULL, '2021-11-17 04:18:29', '2021-11-16 23:33:50'),
(5, 'NEWS', 'Look here for the latest News, Blogs, and Information about our growth, opportunities, and initiatives!', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-17 04:37:56', '2021-11-16 23:39:09'),
(6, 'PARTNERS', 'Please check out our partners, for whom we appreciate so much in contributing and funding our community services efforts', '<p class=\"text-center\">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod\r\n                    tempor invidunt ut\r\n                    labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores\r\n                    et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.\r\n                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut\r\n                    labore et dolore magna aliquyam erat, sed diam voluptua.</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-17 04:40:25', '2021-11-16 23:43:38'),
(7, 'CONTACT-US', 'Contact Us', '<p class=\"black-txt text-center py-2\">Get In Touch</p>\r\n                    <h4 class=\"dark-gren-24 text-center\">Got Any Queries? Fill the form below!</h4>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-17 04:45:00', '2021-11-16 23:47:38'),
(8, 'NEWS-DETAIL', 'News Detail', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-17 04:48:35', '2021-11-16 23:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `question` text CHARACTER SET utf8 DEFAULT NULL,
  `answer` text CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `product_id`, `name`, `email`, `question`, `answer`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
(1, 5, 'hutevaz@mailinator.com', 'hutevaz@mailinator.com', 'Eum doloremque in de', NULL, '2023-03-31 20:03:56', '2023-03-31 20:03:56', 0, 0),
(2, 5, 'hutevaz@mailinator.com', 'hutevaz@mailinator.com', 'Eum doloremque in de', NULL, '2023-03-31 20:04:18', '2023-03-31 20:04:18', 0, 0),
(3, 5, 'fimekopup@mailinator.com', 'fimekopup@mailinator.com', 'Nostrum ea porro nos', '<p>Nostrum ea porro nos&nbsp;Nostrum ea porro nos&nbsp;Nostrum ea porro nos&nbsp;Nostrum ea porro nos&nbsp;Nostrum ea porro nos</p>', '2023-03-31 20:04:26', '2023-03-31 20:21:01', 1, 0),
(4, 5, 'fimekopup@mailinator.com', 'fimekopup@mailinator.com', 'Nostrum ea porro nos', '<p>Nostrum ea porro nos&nbsp;Nostrum ea porro nos&nbsp;Nostrum ea porro nos&nbsp;Nostrum ea porro nos</p>', '2023-03-31 20:11:59', '2023-03-31 20:20:53', 1, 0),
(5, 5, 'fimekopup@mailinator.com', 'fimekopup@mailinator.com', 'Nostrum ea porro nos', '<p>Nostrum ea porro nos&nbsp;Nostrum ea porro nos</p>', '2023-03-31 20:12:12', '2023-03-31 20:20:23', 1, 0),
(6, 5, 'fimekopup@mailinator.com', 'fimekopup@mailinator.com', 'Nostrum ea porro nos', '<p>dummy answer</p>', '2023-03-31 20:14:02', '2023-03-31 20:19:59', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `feature`
--

CREATE TABLE `feature` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feature`
--

INSERT INTO `feature` (`id`, `name`, `slug`, `category_id`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
(1, 'Grady Stafford', 'grady-stafford', 1, '2023-04-10 19:04:58', '2023-04-10 19:04:58', 1, 0),
(3, 'Hilda Marquez', 'hilda-marquez', 6, '2023-04-10 19:09:53', '2023-04-10 19:09:53', 1, 0),
(4, 'Fiona Greene', 'fiona-greene', 1, '2023-04-11 16:22:16', '2023-04-11 16:22:16', 1, 0),
(5, 'Gabriel Stephenson', 'gabriel-stephenson', 1, '2023-04-11 16:22:27', '2023-04-11 16:22:27', 1, 0),
(6, 'Nichole Hawkins', 'nichole-hawkins', 2, '2023-04-11 16:22:36', '2023-04-11 16:22:36', 1, 0),
(7, 'Blossom Sparks', 'blossom-sparks', 2, '2023-04-11 16:22:45', '2023-04-11 16:22:45', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `imagetable`
--

CREATE TABLE `imagetable` (
  `id` int(11) NOT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `img_path` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `headings` text CHARACTER SET utf8 DEFAULT NULL,
  `long_desc` tinytext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ref_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT 1,
  `is_active_img` varchar(1) DEFAULT '1',
  `additional_attributes` text DEFAULT NULL,
  `img_href` text DEFAULT NULL,
  `img_width` varchar(255) DEFAULT NULL,
  `img_height` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imagetable`
--

INSERT INTO `imagetable` (`id`, `table_name`, `img_path`, `headings`, `long_desc`, `created_at`, `updated_at`, `ref_id`, `type`, `is_active_img`, `additional_attributes`, `img_href`, `img_width`, `img_height`) VALUES
(1, 'logo', 'Uploads/Logo/118872755194/jtfs3B9UZWOli1nusR7nnthOpamzY5TkD8z8ZMHr.png', NULL, NULL, '2023-02-14 11:15:19', '2023-02-14 11:15:19', NULL, 1, '1', NULL, NULL, NULL, NULL),
(2, 'home-slider', 'Uploads/homeslider/95125636160/faOJCZULYKy7scsIxVjMTI2XzWMFKa1UVQ1RMGta.png', 'Home-1', NULL, '2023-02-15 11:45:30', '2023-02-15 11:45:30', NULL, 2, '1', NULL, NULL, NULL, NULL),
(4, 'home-slider', 'Uploads/homeslider/199004024888/iUDuI7s7dkF4NjBYIyrzIERRNKERV8E6AQ1yh82a.png', 'Products', NULL, '2023-02-15 11:48:43', '2023-02-15 11:48:43', NULL, 2, '1', NULL, NULL, NULL, NULL),
(5, 'home-slider', 'Uploads/homeslider/62875485751/LaavjgJmL1PvQtOobcX6vT0WPJH953eLjzgy5rvx.png', 'products-detail', NULL, '2023-02-15 11:49:36', '2023-02-15 11:49:36', NULL, 2, '1', NULL, NULL, NULL, NULL),
(6, 'home-slider', 'Uploads/homeslider/88722540935/Ads6l06NNOj7cOgqlb9r1mZ95psgjXuGlvhQlWz5.png', 'about-us', NULL, '2023-02-15 11:51:38', '2023-02-15 11:51:38', NULL, 2, '1', NULL, NULL, NULL, NULL),
(7, 'home-slider', 'Uploads/homeslider/156065760891/juEm3hxFVAu3QvyN3XMCuYBztNXzhkjDX7Vwgpkx.png', 'cart', NULL, '2023-02-15 11:52:16', '2023-02-15 11:52:16', NULL, 2, '1', NULL, NULL, NULL, NULL),
(8, 'home-slider', 'Uploads/homeslider/97044780023/KnBXsyZ6j0mcMIfWkOJx5ja9TifDwnjXmFzr7MZt.png', 'contact-us', NULL, '2023-02-15 11:52:35', '2023-02-15 11:52:35', NULL, 2, '1', NULL, NULL, NULL, NULL),
(9, 'home-slider', 'Uploads/homeslider/150955175891/7dUgRaHXUeYeprhYIe4ca5JYrxB3tS2ZUOyrVfLg.png', 'login', NULL, '2023-02-15 11:53:00', '2023-02-15 11:53:00', NULL, 2, '1', NULL, NULL, NULL, NULL),
(10, 'home-slider', 'Uploads/homeslider/43906891996/bDjsOBc4AnFlNUJS6RH52hZQCat1uNIeDp8IWemq.png', 'sign-up', NULL, '2023-02-15 11:53:16', '2023-02-15 11:53:16', NULL, 2, '1', NULL, NULL, NULL, NULL),
(11, 'home-slider', 'Uploads/homeslider/621050196100/nWrtqXposVAgmhXfnQrPknduBhksIesywix9uiz8.png', 'privacy-policy', NULL, '2023-02-15 11:53:57', '2023-02-15 11:53:57', NULL, 2, '1', NULL, NULL, NULL, NULL),
(12, 'home-slider', 'Uploads/homeslider/89188417819/IC8SoXXo1uvznMiyCbGrnLHV2RZgNVMVaDYIJAjT.png', 'checkout', NULL, '2023-02-15 12:00:04', '2023-02-15 12:00:04', NULL, 2, '1', NULL, NULL, NULL, NULL),
(13, 'logo', 'Uploads/Logo/1156993012936/EYee3R3otjRbgPaT4FcxyAzqTB01lkjwwVoSnSfY.png', NULL, NULL, '2023-03-02 20:25:15', '2023-03-02 20:25:15', NULL, 1, '1', NULL, NULL, NULL, NULL),
(17, 'logo', 'Uploads/Logo/1192546962021/qQfuvGzfS9uqyUY0tx7m9VmccBn6EAoSPTLc2LY3.png', NULL, NULL, '2023-03-10 17:30:33', '2023-03-10 17:30:33', NULL, 1, '1', NULL, NULL, NULL, NULL),
(18, 'wishlist-banner', 'Uploads/welcomeslider/1669347323090/Ns9hl1Nr72FxfJzJvyfxsNIgg9aAXcZzx74k9QI5.png', NULL, NULL, '2023-03-16 21:54:43', '2023-03-16 21:54:43', NULL, 2, '1', NULL, NULL, NULL, NULL),
(19, 'checkout-landing-banner', 'Uploads/homeslider/89188417819/IC8SoXXo1uvznMiyCbGrnLHV2RZgNVMVaDYIJAjT.png', 'checkout', NULL, '2023-02-15 12:00:04', '2023-02-15 12:00:04', NULL, 2, '1', NULL, NULL, NULL, NULL),
(21, 'welcome-slider', 'Uploads/welcomeslider/6494808751/NRg1xTcPiMSn6HiZF3gfNuHQtv4EVf0VMkVm4NIa.png', NULL, '<h1 class=\"banner-content__subHeading\">Restaurant Weeks’ casual offshoot kicks off with diverse new dining options</h1>', '2023-03-29 21:49:05', '2023-03-29 16:49:05', NULL, 3, '1', NULL, NULL, NULL, NULL),
(22, 'restaurants', 'Uploads/welcomeslider/105061666723/UxQWT1CFkfzDLQlJae7WfVarSIiuFQohMrlooM6C.png', NULL, '<h1 class=\"banner-content__heading bg-line\">Restaurants</h1>', '2023-03-29 21:54:19', '2023-03-29 16:54:19', NULL, 3, '1', NULL, NULL, NULL, NULL),
(23, 'events', 'Uploads/welcomeslider/82908195299/vwUbO4X8kHGtcNmEYR5i60iXipsW7J5iCbWyelpU.png', NULL, '<h1 class=\"banner-content__heading bg-line\">Events</h1>', '2023-03-29 21:56:57', '2023-03-29 16:56:57', NULL, 3, '1', NULL, NULL, NULL, NULL),
(24, 'art-and-museums', 'Uploads/welcomeslider/91613129486/QeSkUByf4EynQt0oZrNPco3fcItTW2tMiwgCDknb.png', NULL, '<h1 class=\"banner-content__heading bg-line\">Art & Museums</h1>', '2023-04-10 20:02:56', '2023-04-10 20:02:56', NULL, 3, '1', NULL, NULL, NULL, NULL),
(25, 'lifestyle', 'Uploads/welcomeslider/107059510087/gISTPLmLzw4fXi3TKW7egnMF97D6zPqMMTg7tkj5.png', NULL, '<p>&lt;h1 class=&quot;banner-content__heading bg-line&quot;&gt;Life Style&lt;/h1&gt;</p>', '2023-03-29 21:57:54', '2023-03-29 16:57:54', NULL, 3, '1', NULL, NULL, NULL, NULL),
(26, 'new_to_the_area', 'Uploads/welcomeslider/92293474663/VFnE232KotPdPh5spuBT6KqphcgxPRJjE8nkZ3qj.png', NULL, '<h1 class=\"banner-content__heading bg-line\">New To The Area?</h1>', '2023-03-29 21:58:26', '2023-03-29 16:58:26', NULL, 3, '1', NULL, NULL, NULL, NULL),
(27, 'contact_us', 'Uploads/welcomeslider/63603967955/AcYkQAcqW5ku8q31XS3SYAg8aC6z57wIJaz4TztM.png', NULL, '<h1 class=\"banner-content__heading bg-line\">Contact Us</h1>', '2023-03-29 21:58:46', '2023-03-29 16:58:46', NULL, 3, '1', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` text CHARACTER SET utf8 DEFAULT NULL,
  `certificate` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text CHARACTER SET utf8 DEFAULT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id`, `fname`, `lname`, `email`, `certificate`, `subject`, `message`, `is_read`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
(1, 'Laurel Dennis', 'Hanae Sosa', 'girikimod@mailinator.com', NULL, NULL, 'Impedit omnis place', 0, '2023-03-17 14:30:29', '2023-03-17 14:30:29', 1, 0),
(2, NULL, NULL, 'jiwyzenut@mailinator.com', NULL, NULL, 'Quos adipisicing asp', 0, '2023-03-29 17:12:46', '2023-03-29 17:12:46', 1, 0),
(3, NULL, NULL, 'harefo@mailinator.com', NULL, NULL, 'Et mollit architecto', 0, '2023-03-29 17:21:04', '2023-03-29 17:21:04', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `id` int(11) NOT NULL,
  `keywords` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `keywords`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
(1, 'ejuice vape, vape,titanic,we transfer', '2021-11-03 02:14:00', '2021-11-03 02:14:00', 1, 0),
(8, 'test,network,speed', '2021-11-03 19:34:22', '2021-11-03 19:34:22', 1, 0),
(9, 'education', '2021-11-17 23:29:51', '2021-11-17 23:29:51', 1, 0),
(10, 'courses,biology', '2021-11-17 23:40:08', '2021-11-17 23:40:08', 1, 0),
(11, 'test,speed,vape', '2021-11-17 23:43:23', '2021-11-17 23:43:23', 1, 0),
(12, 'test', '2021-11-17 23:43:53', '2021-11-17 23:43:53', 1, 0),
(13, 'education', '2021-11-18 01:39:06', '2021-11-18 01:39:06', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `id` int(11) NOT NULL,
  `match_type` varchar(255) DEFAULT NULL,
  `team1_id` int(11) DEFAULT NULL,
  `team2_id` int(11) DEFAULT NULL,
  `img_path` text DEFAULT NULL,
  `dated` varchar(255) DEFAULT NULL,
  `broadcast` varchar(255) DEFAULT NULL,
  `live_stream` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`id`, `match_type`, `team1_id`, `team2_id`, `img_path`, `dated`, `broadcast`, `live_stream`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
(3, '1', 1, 3, 'Uploads/matches/thumbnails/313373404498/71JNu9SzDkV3NVDyvaKZ8MorqHETFZNlIejpFpS7.png', '2022-02-28', 'The Company PVT', 'https://www.youtube.com/', '2022-02-23 14:17:31', '2022-02-25 16:00:05', 1, 0),
(4, '2', 1, 3, 'Uploads/matches/thumbnails/4159984134864/2i6yfh6sEdEeDsXWAxaaMjVJYeIuV8861bezp7xR.png', '2022-03-01', 'The Company PVT', '', '2022-02-24 12:51:21', '2022-02-28 18:09:27', 1, 0),
(5, '1', 2, 4, 'Uploads/matches/thumbnails/5212553765487/ALDHWXc7WtqwLosE5Ijb2N7rh0iWhRETrbHK0MxR.png', '2022-03-03', 'The Company PVT', 'https://www.youtube.com/', '2022-02-28 11:11:36', '2022-02-28 11:11:36', 1, 0),
(6, '1', 1, 2, 'Uploads/matches/thumbnails/6129309451286/frg2jZBfzGxACWSn9o9dOPsIukJo3AgTL2uBvz5S.png', '2022-03-08T13:00', 'The Company PVT', 'https://www.youtube.com/', '2022-02-28 13:00:07', '2022-02-28 13:04:32', 1, 0),
(7, '1', 6, 7, 'Uploads/matches/thumbnails/7107612966666/DyU9yE7BRNI9C2CGPpEF7lhRmZ6SS4aB9HGaugkk.png', '2022-03-03T20:00', 'JACOB PVT LTD', 'https://www.youtube.com/', '2022-03-01 20:07:42', '2022-03-01 20:07:42', 1, 0),
(8, '2', 3, 6, 'Uploads/matches/thumbnails/8132489190354/2bDUrCJzMTmdc4i3WY8CXlPczVxIyXKx1Ki20nNd.jpg', '2022-03-10T21:43', 'JACOB PVT LTD', 'https://www.youtube.com/', '2022-03-04 21:44:31', '2022-03-04 23:30:08', 1, 0),
(9, '1', 2, 1, 'Uploads/matches/thumbnails/981885571822/0doymfc4vVIIAg5pOqxAcP51Oai4AZ4HUzeNLjYZ.png', '2022-03-16T22:30', 'Super Sports', NULL, '2022-03-08 22:32:17', '2022-03-08 22:32:53', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `merchandise`
--

CREATE TABLE `merchandise` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 2,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `qty` int(11) DEFAULT 0,
  `short_desc` text DEFAULT NULL,
  `long_desc` text DEFAULT NULL,
  `info_desc` text DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `depth` varchar(255) DEFAULT NULL,
  `weight_pound` varchar(255) DEFAULT NULL,
  `weight_kg` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `merchandise`
--

INSERT INTO `merchandise` (`id`, `type`, `name`, `slug`, `price`, `qty`, `short_desc`, `long_desc`, `info_desc`, `width`, `height`, `depth`, `weight_pound`, `weight_kg`, `category_id`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
(1, 2, 'Adults Away Jersey CA', 'adults-away-jersey-ca', '4.79', 20, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s...</p>', '<h4 class=\"mc-b-2\">Products Infomation</h4>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries. , but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s.</p>\r\n\r\n<h4 class=\"mc-b-2\">Material used</h4>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries. , but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s.</p>', '<h4 class=\"mc-b-2\">Products Infomation</h4>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries. , but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s.</p>', '37.00', '38.00', '37.00', '63', '27.5', 1, '2022-02-23 11:51:45', '2022-03-08 23:13:09', 1, 0),
(2, 2, 'Jacob Merchjandise 1', 'jacob-merchjandise-1', '30', 10, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s...</p>', '<h4>Products Infomation</h4>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries. , but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s.</p>\r\n\r\n<h4>Material used</h4>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries. , but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s.</p>', '<h4>Products Infomation</h4>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries. , but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s.</p>', '20', '20', '20', '1', '2', 4, '2022-03-01 19:56:47', '2022-03-08 23:12:10', 1, 0);

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
(20, '2022_12_09_001750_create_role_table', 2),
(21, '2022_12_15_165016_create-application-table', 2),
(22, '2022_12_15_192020_create-subject_experties-table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `m_flag`
--

CREATE TABLE `m_flag` (
  `id` int(11) NOT NULL,
  `flag_type` varchar(100) NOT NULL,
  `flag_value` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `flag_additionalText` text DEFAULT NULL,
  `has_image` varchar(1) DEFAULT '0',
  `is_active` varchar(1) DEFAULT '1',
  `is_config` varchar(1) DEFAULT '0',
  `flag_show_text` text DEFAULT NULL,
  `is_featured` int(11) DEFAULT 0,
  `is_deleted` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_flag`
--

INSERT INTO `m_flag` (`id`, `flag_type`, `flag_value`, `created_at`, `updated_at`, `flag_additionalText`, `has_image`, `is_active`, `is_config`, `flag_show_text`, `is_featured`, `is_deleted`, `user_id`) VALUES
(2, 'process-word-1', 'process-word-1', '2022-12-14 23:41:12', '2022-12-14 23:41:12', '&lt;p&gt;Lorem&amp;nbsp;ipsum dolor sit amet consectetur adipisicing elit. Consequuntur molestiae cupiditate tempore fugiat ratione sed! Possimus voluptatibus quod sit delectus, cumque aliquid animi nisi, non sint deleniti sed dolor iste.&lt;/p&gt;', '0', '1', '0', '', 1, 0, 0),
(3, 'zoeindustriesFOOTERTXT2', 'zoeindustriesFOOTERTXT2', '2023-03-10 22:31:05', '2023-03-10 22:31:05', 'Copyright 2023 Zoe Industries. All Rights Reserved.', '0', '1', '0', '', 1, 0, 0),
(6, 'zoecontentb1', 'zoecontentb1', '2023-03-10 23:43:29', '2023-03-10 23:43:29', '&lt;h3&gt;Useful Tips for Purchasing a Shower Head&lt;/h3&gt;\n\n&lt;h5&gt;Your Source for Online Plumbing Supplies and Fixtures&lt;/h5&gt;\n\n&lt;p&gt;We are a small business specializing in high quality held held shower heads that are uniquely ours.&lt;/p&gt;\n\n&lt;p&gt;Our warehouse and showroom are located in Scottsdale Arizona, if you&amp;rsquo;re in the area we encourage you to drop by and take a look at our great shower heads, you&amp;rsquo;ll see and feel the quality of our products.&lt;/p&gt;\n\n&lt;p&gt;Our customers include wholesalers, remodelers, contractors and internet shoppers looking for a shower head that&amp;rsquo;s not only beautiful to look at, but also a shower head that performs well and is built to last.&lt;/p&gt;\n\n&lt;p&gt;As the manufacturer and distributor, our shower heads are always in stock, in our warehouse.&lt;/p&gt;', '0', '1', '0', '', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `slug` text CHARACTER SET utf8 DEFAULT NULL,
  `title` text CHARACTER SET utf8 DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `short_desc` text CHARACTER SET utf8 DEFAULT NULL,
  `long_desc` text CHARACTER SET utf8 DEFAULT NULL,
  `news_img` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
(1, 'john@gmail.com', '2023-03-29 18:45:32', '2023-03-29 18:45:32', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `address` text CHARACTER SET utf8 DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `payment_intent` varchar(255) DEFAULT NULL,
  `payment_intent_client_secret` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `order_amount` varchar(255) DEFAULT NULL,
  `delivery_fees` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pay_status` tinyint(4) NOT NULL DEFAULT 0,
  `redirect_status` varchar(255) DEFAULT NULL,
  `order_response` text CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `fname`, `lname`, `country`, `address`, `town`, `state`, `zip`, `phone`, `email`, `note`, `payment_intent`, `payment_intent_client_secret`, `total_amount`, `order_amount`, `delivery_fees`, `user_id`, `pay_status`, `redirect_status`, `order_response`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
(1, 'Carla', 'Dexter', 'Orla', 'George', 'Orson', NULL, 'Nomlanga', 'Freya', 'nedywa@mailinator.com', 'Dakota', NULL, NULL, '227', '227', NULL, 1, 0, NULL, NULL, '2023-02-16 13:12:11', '2023-02-16 13:12:11', 1, 0),
(2, 'Elvis', 'Beverly', 'Denise', 'Wing', 'Summer', NULL, 'Brenda', 'Addison', 'qizecubyky@mailinator.com', 'Hope', NULL, NULL, '227', '227', NULL, 1, 0, NULL, NULL, '2023-02-16 14:04:28', '2023-02-16 14:04:28', 1, 0),
(3, 'Astra', 'Lee', 'Chaim', 'Quincy', 'Julian', 'Jocelyn', 'TaShya', 'Scott', 'mesudicek@mailinator.com', NULL, 'pi_3McDUtKxSgsjPrfN2qqMTncR', 'pi_3McDUtKxSgsjPrfN2qqMTncR_secret_MRiR95QUHGEZLcs4uYvHiRvRZ', '294', '294', NULL, 1, 0, NULL, NULL, '2023-02-16 15:18:45', '2023-02-16 15:18:45', 1, 0),
(4, 'Astra', 'Lee', 'Chaim', 'Quincy', 'Julian', 'Jocelyn', 'TaShya', 'Scott', 'mesudicek@mailinator.com', NULL, 'pi_3McDUtKxSgsjPrfN2qqMTncR', 'pi_3McDUtKxSgsjPrfN2qqMTncR_secret_MRiR95QUHGEZLcs4uYvHiRvRZ', '294', '294', NULL, 1, 0, NULL, NULL, '2023-02-16 15:19:41', '2023-02-16 15:19:41', 1, 0),
(5, 'Astra', 'Lee', 'Chaim', 'Quincy', 'Julian', 'Jocelyn', 'TaShya', 'Scott', 'mesudicek@mailinator.com', NULL, 'pi_3McDUtKxSgsjPrfN2qqMTncR', 'pi_3McDUtKxSgsjPrfN2qqMTncR_secret_MRiR95QUHGEZLcs4uYvHiRvRZ', '294', '294', NULL, 1, 0, NULL, NULL, '2023-02-16 15:20:12', '2023-02-16 15:20:12', 1, 0),
(6, 'Astra', 'Lee', 'Chaim', 'Quincy', 'Julian', 'Jocelyn', 'TaShya', 'Scott', 'mesudicek@mailinator.com', NULL, 'pi_3McDUtKxSgsjPrfN2qqMTncR', 'pi_3McDUtKxSgsjPrfN2qqMTncR_secret_MRiR95QUHGEZLcs4uYvHiRvRZ', '294', '294', NULL, 1, 0, NULL, NULL, '2023-02-16 15:21:18', '2023-02-16 15:21:18', 1, 0),
(7, 'Astra', 'Lee', 'Chaim', 'Quincy', 'Julian', 'Jocelyn', 'TaShya', 'Scott', 'mesudicek@mailinator.com', NULL, 'pi_3McDUtKxSgsjPrfN2qqMTncR', 'pi_3McDUtKxSgsjPrfN2qqMTncR_secret_MRiR95QUHGEZLcs4uYvHiRvRZ', '294', '294', NULL, 1, 0, NULL, NULL, '2023-02-16 15:24:04', '2023-02-16 15:24:04', 1, 0),
(8, 'Astra', 'Lee', 'Chaim', 'Quincy', 'Julian', 'Jocelyn', 'TaShya', 'Scott', 'mesudicek@mailinator.com', NULL, 'pi_3McDUtKxSgsjPrfN2qqMTncR', 'pi_3McDUtKxSgsjPrfN2qqMTncR_secret_MRiR95QUHGEZLcs4uYvHiRvRZ', '294', '294', NULL, 1, 0, NULL, NULL, '2023-02-16 15:24:51', '2023-02-16 15:24:51', 1, 0),
(9, 'Astra', 'Lee', 'Chaim', 'Quincy', 'Julian', 'Jocelyn', 'TaShya', 'Scott', 'mesudicek@mailinator.com', NULL, 'pi_3McDUtKxSgsjPrfN2qqMTncR', 'pi_3McDUtKxSgsjPrfN2qqMTncR_secret_MRiR95QUHGEZLcs4uYvHiRvRZ', '294', '294', NULL, 1, 0, NULL, NULL, '2023-02-16 15:25:32', '2023-02-16 15:25:32', 1, 0),
(10, 'Astra', 'Lee', 'Chaim', 'Quincy', 'Julian', 'Jocelyn', 'TaShya', 'Scott', 'mesudicek@mailinator.com', NULL, 'pi_3McDUtKxSgsjPrfN2qqMTncR', 'pi_3McDUtKxSgsjPrfN2qqMTncR_secret_MRiR95QUHGEZLcs4uYvHiRvRZ', '294', '294', NULL, 1, 0, NULL, NULL, '2023-02-16 15:32:13', '2023-02-16 15:32:13', 1, 0),
(11, 'Astra', 'Lee', 'Chaim', 'Quincy', 'Julian', 'Jocelyn', 'TaShya', 'Scott', 'mesudicek@mailinator.com', NULL, 'pi_3McDUtKxSgsjPrfN2qqMTncR', 'pi_3McDUtKxSgsjPrfN2qqMTncR_secret_MRiR95QUHGEZLcs4uYvHiRvRZ', '294', '294', NULL, 1, 0, NULL, NULL, '2023-02-16 15:32:35', '2023-02-16 15:32:35', 1, 0),
(12, 'Astra', 'Lee', 'Chaim', 'Quincy', 'Julian', 'Jocelyn', 'TaShya', 'Scott', 'mesudicek@mailinator.com', NULL, 'pi_3McDUtKxSgsjPrfN2qqMTncR', 'pi_3McDUtKxSgsjPrfN2qqMTncR_secret_MRiR95QUHGEZLcs4uYvHiRvRZ', '294', '294', NULL, 1, 0, NULL, NULL, '2023-02-16 15:33:32', '2023-02-16 15:33:32', 1, 0),
(13, 'Astra', 'Lee', 'Chaim', 'Quincy', 'Julian', 'Jocelyn', 'TaShya', 'Scott', 'mesudicek@mailinator.com', NULL, 'pi_3McDUtKxSgsjPrfN2qqMTncR', 'pi_3McDUtKxSgsjPrfN2qqMTncR_secret_MRiR95QUHGEZLcs4uYvHiRvRZ', '294', '294', NULL, 1, 0, NULL, NULL, '2023-02-16 15:33:37', '2023-02-16 15:33:37', 1, 0),
(14, 'Astra', 'Lee', 'Chaim', 'Quincy', 'Julian', 'Jocelyn', 'TaShya', 'Scott', 'mesudicek@mailinator.com', NULL, 'pi_3McDUtKxSgsjPrfN2qqMTncR', 'pi_3McDUtKxSgsjPrfN2qqMTncR_secret_MRiR95QUHGEZLcs4uYvHiRvRZ', '294', '294', NULL, 1, 0, NULL, NULL, '2023-02-16 15:34:20', '2023-02-16 15:34:20', 1, 0),
(15, 'Astra', 'Lee', 'Chaim', 'Quincy', 'Julian', 'Jocelyn', 'TaShya', 'Scott', 'mesudicek@mailinator.com', NULL, 'pi_3McDUtKxSgsjPrfN2qqMTncR', 'pi_3McDUtKxSgsjPrfN2qqMTncR_secret_MRiR95QUHGEZLcs4uYvHiRvRZ', '294', '294', NULL, 1, 0, NULL, NULL, '2023-02-16 15:34:46', '2023-02-16 15:34:46', 1, 0),
(16, 'Astra', 'Lee', 'Chaim', 'Quincy', 'Julian', 'Jocelyn', 'TaShya', 'Scott', 'mesudicek@mailinator.com', NULL, 'pi_3McDUtKxSgsjPrfN2qqMTncR', 'pi_3McDUtKxSgsjPrfN2qqMTncR_secret_MRiR95QUHGEZLcs4uYvHiRvRZ', '294', '294', NULL, 1, 0, NULL, NULL, '2023-02-16 15:35:10', '2023-02-16 15:35:10', 1, 0),
(17, 'Astra', 'Lee', 'Chaim', 'Quincy', 'Julian', 'Jocelyn', 'TaShya', 'Scott', 'mesudicek@mailinator.com', NULL, 'pi_3McDUtKxSgsjPrfN2qqMTncR', 'pi_3McDUtKxSgsjPrfN2qqMTncR_secret_MRiR95QUHGEZLcs4uYvHiRvRZ', '294', '294', NULL, 1, 0, NULL, NULL, '2023-02-16 15:35:30', '2023-02-16 15:35:30', 1, 0),
(18, 'Astra', 'Lee', 'Chaim', 'Quincy', 'Julian', 'Jocelyn', 'TaShya', 'Scott', 'mesudicek@mailinator.com', NULL, 'pi_3McDUtKxSgsjPrfN2qqMTncR', 'pi_3McDUtKxSgsjPrfN2qqMTncR_secret_MRiR95QUHGEZLcs4uYvHiRvRZ', '294', '294', NULL, 1, 0, NULL, NULL, '2023-02-16 15:37:07', '2023-02-16 15:37:07', 1, 0),
(19, 'Eugenia', 'Scarlett', 'Harper', 'Liberty', 'Christine', 'Lionel', 'Sasha', 'Bernard', 'lideq@mailinator.com', NULL, 'pi_3McEDJKxSgsjPrfN1tSY4iCJ', 'pi_3McEDJKxSgsjPrfN1tSY4iCJ_secret_MVsHw0LNsjWuBwbiXqhKKPR2F', '68', '68', NULL, 1, 0, NULL, NULL, '2023-02-16 15:38:23', '2023-02-16 15:38:23', 1, 0),
(20, 'Dara', 'Beverly', 'Davis', 'Odessa', 'Lysandra', 'Gretchen', 'Amery', 'Kamal', 'xatuwezoz@mailinator.com', NULL, 'pi_3McEHKKxSgsjPrfN1mJLqUbi', 'pi_3McEHKKxSgsjPrfN1mJLqUbi_secret_Oxwzo9Lvaltn3yW9PzdAwen1t', '113', '113', NULL, 1, 0, 'succeeded', NULL, '2023-02-16 15:45:43', '2023-02-16 15:45:43', 1, 0),
(21, 'Eleanor', 'Tana', 'Zahir', 'Dane', 'Ulla', 'Kelly', 'Ori', 'George', 'hujurakatu@mailinator.com', NULL, 'pi_3McEZCKxSgsjPrfN1lFIDJAd', 'pi_3McEZCKxSgsjPrfN1lFIDJAd_secret_wLjTWzkn1DsXi3xS06RxDTYJD', '68', '68', NULL, 1, 0, 'succeeded', NULL, '2023-02-16 21:01:01', '2023-02-16 21:01:01', 1, 0),
(22, 'Eleanor', 'Tana', 'Zahir', 'Dane', 'Ulla', 'Kelly', 'Ori', 'George', 'hujurakatu@mailinator.com', NULL, 'pi_3McEZCKxSgsjPrfN1lFIDJAd', 'pi_3McEZCKxSgsjPrfN1lFIDJAd_secret_wLjTWzkn1DsXi3xS06RxDTYJD', '68', '68', NULL, 1, 0, 'succeeded', NULL, '2023-02-16 21:01:26', '2023-02-16 21:01:26', 1, 0),
(23, 'Bertha', 'Herman', NULL, 'Jada', 'Yen', NULL, 'Austin', 'Unity', 'Kermit', 'Sara', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, '2023-03-21 14:29:59', '2023-03-21 14:29:59', 1, 0),
(24, 'Brynn', 'Rhonda', NULL, 'Adam', 'Linda', NULL, 'Jonas', 'Quentin', 'Tanya', 'Evelyn', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, '2023-03-21 14:35:48', '2023-03-21 14:35:48', 1, 0),
(25, 'Thomas', 'Laurel', NULL, 'Brent', 'Cadman', NULL, 'Sybil', 'Macaulay', 'Celeste', 'John', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, '2023-03-21 15:30:53', '2023-03-21 15:30:53', 1, 0),
(26, 'Louis', 'Silas', NULL, 'Basia', 'Sonya', NULL, 'Arden', 'Jaime', 'Felix', 'Cameron', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, '2023-03-21 15:31:02', '2023-03-21 15:31:02', 1, 0),
(27, 'Melyssa', 'Chava', NULL, 'Reed', 'Barrett', NULL, 'Aaron', 'Nissim', 'Ruby', 'Paloma', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, '2023-03-21 15:31:13', '2023-03-21 15:31:13', 1, 0),
(28, 'Abraham', 'Ulric', NULL, 'Marvin', 'Kevyn', NULL, 'Mona', 'Doris', 'Carson', 'Reuben', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, '2023-03-21 15:32:37', '2023-03-21 15:32:37', 1, 0),
(29, 'Carly', 'Iona', NULL, 'Jael', 'Linda', NULL, 'James', 'Giacomo', 'Jessamine', 'Kiona', NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, '2023-03-21 15:33:57', '2023-03-21 15:33:57', 1, 0),
(30, 'Jade', 'Minerva', NULL, 'Quon', 'Lillith', NULL, 'Melyssa', 'Amethyst', 'qawobudy@mailinator.com', 'Barry', NULL, NULL, '10', NULL, NULL, 1, 0, NULL, NULL, '2023-03-21 15:41:05', '2023-03-21 15:41:05', 1, 0),
(31, 'Azalia', 'Quinn', NULL, 'Vera', 'Myles', NULL, 'Lewis', 'Kenyon', 'xehu@mailinator.com', 'Clinton', NULL, NULL, '10', NULL, NULL, 1, 0, NULL, NULL, '2023-03-21 15:41:50', '2023-03-21 15:41:50', 1, 0),
(32, 'Sydney', 'Renee', NULL, 'Craig', 'Gannon', NULL, 'Addison', 'Xyla', 'kuzequ@mailinator.com', 'Shaine', 'pi_3MoC8JKxSgsjPrfN0woFCGpd', 'pi_3MoC8JKxSgsjPrfN0woFCGpd_secret_P5nPeaksxsioGv3dqex5055et', '10', '10', NULL, 1, 0, 'succeeded', NULL, '2023-03-21 15:50:11', '2023-03-21 16:05:11', 1, 0),
(33, 'Josiah', 'Raphael', NULL, 'Petra', 'Lucy', NULL, 'Kerry', 'Baxter', 'pucabo@mailinator.com', 'Giselle', 'pi_3MoCQ3KxSgsjPrfN0kOYkuXp', 'pi_3MoCQ3KxSgsjPrfN0kOYkuXp_secret_RNSucAnW1Hra7UvoV2JlEGwYs', '10', '10', NULL, 1, 0, 'succeeded', NULL, '2023-03-21 16:08:31', '2023-03-21 16:12:15', 1, 0),
(34, 'Erica', 'Nelle', NULL, 'Constance', 'Nathaniel', NULL, 'Cally', 'Ruby', 'bofifebezy@mailinator.com', 'Driscoll', 'pi_3MoCUJKxSgsjPrfN2mE8mfTI', 'pi_3MoCUJKxSgsjPrfN2mE8mfTI_secret_rtNN0skxwDY63AwiI2RybPw43', '963', '963', NULL, 1, 0, 'succeeded', NULL, '2023-03-21 16:12:55', '2023-03-21 16:13:19', 1, 0),
(35, 'Victoria', 'Heather', NULL, 'Mark', 'Rina', NULL, 'Michelle', 'Cade', 'kumawe@mailinator.com', 'Yael', 'pi_3MoCXhKxSgsjPrfN137HD2rV', 'pi_3MoCXhKxSgsjPrfN137HD2rV_secret_YzKA7kJNZQTHRhYabCaHDjw5x', '963', '963', NULL, 1, 1, 'succeeded', NULL, '2023-03-21 16:16:25', '2023-03-21 16:17:14', 1, 0),
(36, 'Devel', 'Dev', NULL, 'ABC Street', 'Los Angeles', NULL, '10001', '5102954751', '1develdev@gmail.com', 'asdasdasd', NULL, NULL, '155', NULL, NULL, 2, 0, NULL, NULL, '2023-03-22 00:53:37', '2023-03-22 00:53:37', 1, 0),
(37, 'Devel', 'Dev', NULL, 'ABC Street', 'Los Angeles', NULL, '10001', '5102954751', '1develdev@gmail.com', 'asasdasdas', NULL, NULL, '155', NULL, NULL, 2, 0, NULL, NULL, '2023-03-22 00:53:55', '2023-03-22 00:53:55', 1, 0),
(38, 'Lunea', 'Boris', NULL, 'Jocelyn', 'Paki', NULL, 'Patrick', 'Damian', 'muhihotate@mailinator.com', 'Cecilia', NULL, NULL, '60', NULL, NULL, 1, 0, NULL, NULL, '2023-03-23 19:14:53', '2023-03-23 19:14:53', 1, 0),
(39, 'Meredith', 'Aretha', NULL, 'Abel', 'Rudyard', NULL, 'Deacon', 'Graham', 'fanoga@mailinator.com', 'Abra', NULL, NULL, '70', NULL, NULL, 1, 0, NULL, NULL, '2023-03-23 19:29:06', '2023-03-23 19:29:06', 1, 0),
(40, 'Alec', 'Zia', NULL, 'Francesca', 'Hyacinth', NULL, 'Ulysses', 'Wynne', 'fanikyfyq@mailinator.com', 'Miriam', NULL, NULL, '70', NULL, NULL, 1, 0, NULL, NULL, '2023-03-23 19:30:21', '2023-03-23 19:30:21', 1, 0),
(41, 'Megan', 'Quinn', NULL, 'Fitzgerald', 'Rachel', NULL, 'Nehru', 'Ciaran', 'fyfeliteje@mailinator.com', 'Giselle', NULL, NULL, '70', NULL, NULL, 1, 0, NULL, NULL, '2023-03-23 19:36:25', '2023-03-23 19:36:25', 1, 0),
(42, 'Byron', 'Kalia', NULL, 'Raven', 'Mia', NULL, 'Kamal', 'Imelda', 'putimigu@mailinator.com', 'Marcia', 'pi_3Mou9XKxSgsjPrfN2Qmt72Hp', 'pi_3Mou9XKxSgsjPrfN2Qmt72Hp_secret_BrKLPjbyRlYCHFrl1G1qvYki7', '70', '70', NULL, 1, 1, 'succeeded', NULL, '2023-03-23 19:37:58', '2023-03-23 19:50:51', 1, 0),
(43, 'Petra', 'Nyssa', NULL, 'Wynne', 'Sierra', NULL, 'Quail', 'Portia', 'peetra@demo.com', 'Trevor', 'pi_3MouHsKxSgsjPrfN1v8fKhVW', 'pi_3MouHsKxSgsjPrfN1v8fKhVW_secret_BhmIGyjfvQWbjrabRRMCefVHR', '105', '105', NULL, 1, 1, 'succeeded', NULL, '2023-03-23 19:53:49', '2023-03-23 19:59:52', 1, 0),
(44, 'Carolyn', 'Odette', NULL, 'Eos ab impedit iur', 'Chanda', NULL, 'Rylee', '+1 (855) 825-9094', 'jorrhn@gmail.com', 'Josephine', NULL, NULL, '78.96000000000001', NULL, NULL, 1, 0, NULL, NULL, '2023-03-24 16:48:03', '2023-03-24 16:48:03', 1, 0),
(45, 'Carolyn', 'Mollie Ware', NULL, 'Eos ab impedit iur', 'Chanda', NULL, 'Rylee', '+1 (755) 658-5612', 'admin@sms.com', 'Josephine', NULL, NULL, '78.96000000000001', NULL, NULL, 1, 0, NULL, NULL, '2023-03-24 16:54:44', '2023-03-24 16:54:44', 1, 0),
(46, 'Demetrius Schneider', 'Raja Gallagher', NULL, 'Neque dolore quis ut', 'Chanda', NULL, 'Rylee', '+1 (755) 658-5612', 'admisn@sms.com', 'Josephine', NULL, NULL, '78.96000000000001', '60', '18.96', 1, 0, NULL, NULL, '2023-03-24 16:56:51', '2023-03-24 16:56:51', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `details` text CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `details`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
(1, 1, 'a:3:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"2\";s:9:\"sub_total\";d:90;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"4\";s:9:\"sub_total\";d:92;}i:31;a:5:{s:7:\"cart_id\";s:2:\"31\";s:10:\"product_id\";s:1:\"3\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"1\";s:9:\"sub_total\";d:45;}}', '2023-02-16 13:12:11', '2023-02-16 13:12:11', 1, 0),
(2, 2, 'a:3:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"2\";s:9:\"sub_total\";d:90;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"4\";s:9:\"sub_total\";d:92;}i:31;a:5:{s:7:\"cart_id\";s:2:\"31\";s:10:\"product_id\";s:1:\"3\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"1\";s:9:\"sub_total\";d:45;}}', '2023-02-16 14:04:28', '2023-02-16 14:04:28', 1, 0),
(3, 3, 'a:4:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";i:3;s:9:\"sub_total\";d:135;}s:15:\"billing_address\";a:12:{s:6:\"_token\";s:40:\"XtPAR58orXE3L5sRIL3BSaBbEF5vFqUXOjK2wfKp\";s:5:\"fname\";s:6:\"Olivia\";s:5:\"lname\";s:6:\"Cailin\";s:7:\"country\";s:5:\"Renee\";s:7:\"address\";s:6:\"Denise\";s:4:\"town\";s:6:\"Phoebe\";s:5:\"state\";s:5:\"Jerry\";s:3:\"zip\";s:7:\"Giselle\";s:5:\"phone\";s:5:\"Caryn\";s:5:\"email\";s:21:\"fosati@mailinator.com\";s:4:\"note\";s:6:\"Fatima\";s:12:\"total_amount\";s:3:\"294\";}i:31;a:5:{s:7:\"cart_id\";s:2:\"31\";s:10:\"product_id\";s:1:\"3\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"2\";s:9:\"sub_total\";d:90;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"3\";s:9:\"sub_total\";d:69;}}', '2023-02-16 15:18:45', '2023-02-16 15:18:45', 1, 0),
(4, 4, 'a:4:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";i:3;s:9:\"sub_total\";d:135;}s:15:\"billing_address\";a:12:{s:6:\"_token\";s:40:\"XtPAR58orXE3L5sRIL3BSaBbEF5vFqUXOjK2wfKp\";s:5:\"fname\";s:6:\"Olivia\";s:5:\"lname\";s:6:\"Cailin\";s:7:\"country\";s:5:\"Renee\";s:7:\"address\";s:6:\"Denise\";s:4:\"town\";s:6:\"Phoebe\";s:5:\"state\";s:5:\"Jerry\";s:3:\"zip\";s:7:\"Giselle\";s:5:\"phone\";s:5:\"Caryn\";s:5:\"email\";s:21:\"fosati@mailinator.com\";s:4:\"note\";s:6:\"Fatima\";s:12:\"total_amount\";s:3:\"294\";}i:31;a:5:{s:7:\"cart_id\";s:2:\"31\";s:10:\"product_id\";s:1:\"3\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"2\";s:9:\"sub_total\";d:90;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"3\";s:9:\"sub_total\";d:69;}}', '2023-02-16 15:19:41', '2023-02-16 15:19:41', 1, 0),
(5, 5, 'a:4:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";i:3;s:9:\"sub_total\";d:135;}s:15:\"billing_address\";a:12:{s:6:\"_token\";s:40:\"XtPAR58orXE3L5sRIL3BSaBbEF5vFqUXOjK2wfKp\";s:5:\"fname\";s:6:\"Olivia\";s:5:\"lname\";s:6:\"Cailin\";s:7:\"country\";s:5:\"Renee\";s:7:\"address\";s:6:\"Denise\";s:4:\"town\";s:6:\"Phoebe\";s:5:\"state\";s:5:\"Jerry\";s:3:\"zip\";s:7:\"Giselle\";s:5:\"phone\";s:5:\"Caryn\";s:5:\"email\";s:21:\"fosati@mailinator.com\";s:4:\"note\";s:6:\"Fatima\";s:12:\"total_amount\";s:3:\"294\";}i:31;a:5:{s:7:\"cart_id\";s:2:\"31\";s:10:\"product_id\";s:1:\"3\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"2\";s:9:\"sub_total\";d:90;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"3\";s:9:\"sub_total\";d:69;}}', '2023-02-16 15:20:12', '2023-02-16 15:20:12', 1, 0),
(6, 6, 'a:4:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";i:3;s:9:\"sub_total\";d:135;}s:15:\"billing_address\";a:12:{s:6:\"_token\";s:40:\"XtPAR58orXE3L5sRIL3BSaBbEF5vFqUXOjK2wfKp\";s:5:\"fname\";s:6:\"Olivia\";s:5:\"lname\";s:6:\"Cailin\";s:7:\"country\";s:5:\"Renee\";s:7:\"address\";s:6:\"Denise\";s:4:\"town\";s:6:\"Phoebe\";s:5:\"state\";s:5:\"Jerry\";s:3:\"zip\";s:7:\"Giselle\";s:5:\"phone\";s:5:\"Caryn\";s:5:\"email\";s:21:\"fosati@mailinator.com\";s:4:\"note\";s:6:\"Fatima\";s:12:\"total_amount\";s:3:\"294\";}i:31;a:5:{s:7:\"cart_id\";s:2:\"31\";s:10:\"product_id\";s:1:\"3\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"2\";s:9:\"sub_total\";d:90;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"3\";s:9:\"sub_total\";d:69;}}', '2023-02-16 15:21:18', '2023-02-16 15:21:18', 1, 0),
(7, 10, 'a:4:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";i:3;s:9:\"sub_total\";d:135;}s:15:\"billing_address\";a:12:{s:6:\"_token\";s:40:\"XtPAR58orXE3L5sRIL3BSaBbEF5vFqUXOjK2wfKp\";s:5:\"fname\";s:6:\"Olivia\";s:5:\"lname\";s:6:\"Cailin\";s:7:\"country\";s:5:\"Renee\";s:7:\"address\";s:6:\"Denise\";s:4:\"town\";s:6:\"Phoebe\";s:5:\"state\";s:5:\"Jerry\";s:3:\"zip\";s:7:\"Giselle\";s:5:\"phone\";s:5:\"Caryn\";s:5:\"email\";s:21:\"fosati@mailinator.com\";s:4:\"note\";s:6:\"Fatima\";s:12:\"total_amount\";s:3:\"294\";}i:31;a:5:{s:7:\"cart_id\";s:2:\"31\";s:10:\"product_id\";s:1:\"3\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"2\";s:9:\"sub_total\";d:90;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"3\";s:9:\"sub_total\";d:69;}}', '2023-02-16 15:32:13', '2023-02-16 15:32:13', 1, 0),
(8, 11, 'a:4:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";i:3;s:9:\"sub_total\";d:135;}s:15:\"billing_address\";a:12:{s:6:\"_token\";s:40:\"XtPAR58orXE3L5sRIL3BSaBbEF5vFqUXOjK2wfKp\";s:5:\"fname\";s:6:\"Olivia\";s:5:\"lname\";s:6:\"Cailin\";s:7:\"country\";s:5:\"Renee\";s:7:\"address\";s:6:\"Denise\";s:4:\"town\";s:6:\"Phoebe\";s:5:\"state\";s:5:\"Jerry\";s:3:\"zip\";s:7:\"Giselle\";s:5:\"phone\";s:5:\"Caryn\";s:5:\"email\";s:21:\"fosati@mailinator.com\";s:4:\"note\";s:6:\"Fatima\";s:12:\"total_amount\";s:3:\"294\";}i:31;a:5:{s:7:\"cart_id\";s:2:\"31\";s:10:\"product_id\";s:1:\"3\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"2\";s:9:\"sub_total\";d:90;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"3\";s:9:\"sub_total\";d:69;}}', '2023-02-16 15:32:35', '2023-02-16 15:32:35', 1, 0),
(9, 12, 'a:4:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";i:3;s:9:\"sub_total\";d:135;}s:15:\"billing_address\";a:12:{s:6:\"_token\";s:40:\"XtPAR58orXE3L5sRIL3BSaBbEF5vFqUXOjK2wfKp\";s:5:\"fname\";s:6:\"Olivia\";s:5:\"lname\";s:6:\"Cailin\";s:7:\"country\";s:5:\"Renee\";s:7:\"address\";s:6:\"Denise\";s:4:\"town\";s:6:\"Phoebe\";s:5:\"state\";s:5:\"Jerry\";s:3:\"zip\";s:7:\"Giselle\";s:5:\"phone\";s:5:\"Caryn\";s:5:\"email\";s:21:\"fosati@mailinator.com\";s:4:\"note\";s:6:\"Fatima\";s:12:\"total_amount\";s:3:\"294\";}i:31;a:5:{s:7:\"cart_id\";s:2:\"31\";s:10:\"product_id\";s:1:\"3\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"2\";s:9:\"sub_total\";d:90;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"3\";s:9:\"sub_total\";d:69;}}', '2023-02-16 15:33:32', '2023-02-16 15:33:32', 1, 0),
(10, 13, 'a:4:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";i:3;s:9:\"sub_total\";d:135;}s:15:\"billing_address\";a:12:{s:6:\"_token\";s:40:\"XtPAR58orXE3L5sRIL3BSaBbEF5vFqUXOjK2wfKp\";s:5:\"fname\";s:6:\"Olivia\";s:5:\"lname\";s:6:\"Cailin\";s:7:\"country\";s:5:\"Renee\";s:7:\"address\";s:6:\"Denise\";s:4:\"town\";s:6:\"Phoebe\";s:5:\"state\";s:5:\"Jerry\";s:3:\"zip\";s:7:\"Giselle\";s:5:\"phone\";s:5:\"Caryn\";s:5:\"email\";s:21:\"fosati@mailinator.com\";s:4:\"note\";s:6:\"Fatima\";s:12:\"total_amount\";s:3:\"294\";}i:31;a:5:{s:7:\"cart_id\";s:2:\"31\";s:10:\"product_id\";s:1:\"3\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"2\";s:9:\"sub_total\";d:90;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"3\";s:9:\"sub_total\";d:69;}}', '2023-02-16 15:33:37', '2023-02-16 15:33:37', 1, 0),
(11, 14, 'a:4:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";i:3;s:9:\"sub_total\";d:135;}s:15:\"billing_address\";a:12:{s:6:\"_token\";s:40:\"XtPAR58orXE3L5sRIL3BSaBbEF5vFqUXOjK2wfKp\";s:5:\"fname\";s:6:\"Olivia\";s:5:\"lname\";s:6:\"Cailin\";s:7:\"country\";s:5:\"Renee\";s:7:\"address\";s:6:\"Denise\";s:4:\"town\";s:6:\"Phoebe\";s:5:\"state\";s:5:\"Jerry\";s:3:\"zip\";s:7:\"Giselle\";s:5:\"phone\";s:5:\"Caryn\";s:5:\"email\";s:21:\"fosati@mailinator.com\";s:4:\"note\";s:6:\"Fatima\";s:12:\"total_amount\";s:3:\"294\";}i:31;a:5:{s:7:\"cart_id\";s:2:\"31\";s:10:\"product_id\";s:1:\"3\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"2\";s:9:\"sub_total\";d:90;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"3\";s:9:\"sub_total\";d:69;}}', '2023-02-16 15:34:20', '2023-02-16 15:34:20', 1, 0),
(12, 15, 'a:4:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";i:3;s:9:\"sub_total\";d:135;}s:15:\"billing_address\";a:12:{s:6:\"_token\";s:40:\"XtPAR58orXE3L5sRIL3BSaBbEF5vFqUXOjK2wfKp\";s:5:\"fname\";s:6:\"Olivia\";s:5:\"lname\";s:6:\"Cailin\";s:7:\"country\";s:5:\"Renee\";s:7:\"address\";s:6:\"Denise\";s:4:\"town\";s:6:\"Phoebe\";s:5:\"state\";s:5:\"Jerry\";s:3:\"zip\";s:7:\"Giselle\";s:5:\"phone\";s:5:\"Caryn\";s:5:\"email\";s:21:\"fosati@mailinator.com\";s:4:\"note\";s:6:\"Fatima\";s:12:\"total_amount\";s:3:\"294\";}i:31;a:5:{s:7:\"cart_id\";s:2:\"31\";s:10:\"product_id\";s:1:\"3\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"2\";s:9:\"sub_total\";d:90;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"3\";s:9:\"sub_total\";d:69;}}', '2023-02-16 15:34:46', '2023-02-16 15:34:46', 1, 0),
(13, 16, 'a:4:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";i:3;s:9:\"sub_total\";d:135;}s:15:\"billing_address\";a:12:{s:6:\"_token\";s:40:\"XtPAR58orXE3L5sRIL3BSaBbEF5vFqUXOjK2wfKp\";s:5:\"fname\";s:6:\"Olivia\";s:5:\"lname\";s:6:\"Cailin\";s:7:\"country\";s:5:\"Renee\";s:7:\"address\";s:6:\"Denise\";s:4:\"town\";s:6:\"Phoebe\";s:5:\"state\";s:5:\"Jerry\";s:3:\"zip\";s:7:\"Giselle\";s:5:\"phone\";s:5:\"Caryn\";s:5:\"email\";s:21:\"fosati@mailinator.com\";s:4:\"note\";s:6:\"Fatima\";s:12:\"total_amount\";s:3:\"294\";}i:31;a:5:{s:7:\"cart_id\";s:2:\"31\";s:10:\"product_id\";s:1:\"3\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"2\";s:9:\"sub_total\";d:90;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"3\";s:9:\"sub_total\";d:69;}}', '2023-02-16 15:35:10', '2023-02-16 15:35:10', 1, 0),
(14, 17, 'a:4:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";i:3;s:9:\"sub_total\";d:135;}s:15:\"billing_address\";a:12:{s:6:\"_token\";s:40:\"XtPAR58orXE3L5sRIL3BSaBbEF5vFqUXOjK2wfKp\";s:5:\"fname\";s:6:\"Olivia\";s:5:\"lname\";s:6:\"Cailin\";s:7:\"country\";s:5:\"Renee\";s:7:\"address\";s:6:\"Denise\";s:4:\"town\";s:6:\"Phoebe\";s:5:\"state\";s:5:\"Jerry\";s:3:\"zip\";s:7:\"Giselle\";s:5:\"phone\";s:5:\"Caryn\";s:5:\"email\";s:21:\"fosati@mailinator.com\";s:4:\"note\";s:6:\"Fatima\";s:12:\"total_amount\";s:3:\"294\";}i:31;a:5:{s:7:\"cart_id\";s:2:\"31\";s:10:\"product_id\";s:1:\"3\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"2\";s:9:\"sub_total\";d:90;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"3\";s:9:\"sub_total\";d:69;}}', '2023-02-16 15:35:30', '2023-02-16 15:35:30', 1, 0),
(15, 18, 'a:4:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";i:3;s:9:\"sub_total\";d:135;}s:15:\"billing_address\";a:12:{s:6:\"_token\";s:40:\"XtPAR58orXE3L5sRIL3BSaBbEF5vFqUXOjK2wfKp\";s:5:\"fname\";s:6:\"Olivia\";s:5:\"lname\";s:6:\"Cailin\";s:7:\"country\";s:5:\"Renee\";s:7:\"address\";s:6:\"Denise\";s:4:\"town\";s:6:\"Phoebe\";s:5:\"state\";s:5:\"Jerry\";s:3:\"zip\";s:7:\"Giselle\";s:5:\"phone\";s:5:\"Caryn\";s:5:\"email\";s:21:\"fosati@mailinator.com\";s:4:\"note\";s:6:\"Fatima\";s:12:\"total_amount\";s:3:\"294\";}i:31;a:5:{s:7:\"cart_id\";s:2:\"31\";s:10:\"product_id\";s:1:\"3\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"2\";s:9:\"sub_total\";d:90;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"3\";s:9:\"sub_total\";d:69;}}', '2023-02-16 15:37:07', '2023-02-16 15:37:07', 1, 0),
(16, 19, 'a:2:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"1\";s:9:\"sub_total\";d:45;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"1\";s:9:\"sub_total\";d:23;}}', '2023-02-16 15:38:23', '2023-02-16 15:38:23', 1, 0),
(17, 20, 'a:3:{i:31;a:5:{s:7:\"cart_id\";s:2:\"31\";s:10:\"product_id\";s:1:\"3\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"1\";s:9:\"sub_total\";d:45;}i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"1\";s:9:\"sub_total\";d:45;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"1\";s:9:\"sub_total\";d:23;}}', '2023-02-16 15:45:43', '2023-02-16 15:45:43', 1, 0),
(18, 21, 'a:2:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"1\";s:9:\"sub_total\";d:45;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"1\";s:9:\"sub_total\";d:23;}}', '2023-02-16 21:01:01', '2023-02-16 21:01:01', 1, 0),
(19, 22, 'a:2:{i:21;a:5:{s:7:\"cart_id\";s:2:\"21\";s:10:\"product_id\";s:1:\"2\";s:5:\"price\";s:5:\"45.00\";s:8:\"quantity\";s:1:\"1\";s:9:\"sub_total\";d:45;}i:11;a:5:{s:7:\"cart_id\";s:2:\"11\";s:10:\"product_id\";s:1:\"1\";s:5:\"price\";s:5:\"23.00\";s:8:\"quantity\";s:1:\"1\";s:9:\"sub_total\";d:23;}}', '2023-02-16 21:01:26', '2023-02-16 21:01:26', 1, 0),
(20, 23, 'a:1:{i:2;a:14:{s:7:\"cart_id\";s:1:\"2\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:1;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:8:\"#9F9F9F;\";s:5:\"price\";i:10;s:9:\"sub_total\";i:10;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-21 14:29:59', '2023-03-21 14:29:59', 1, 0),
(21, 24, 'a:1:{i:2;a:14:{s:7:\"cart_id\";s:1:\"2\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:1;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:8:\"#9F9F9F;\";s:5:\"price\";i:10;s:9:\"sub_total\";i:10;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-21 14:35:48', '2023-03-21 14:35:48', 1, 0),
(22, 25, 'a:1:{i:2;a:14:{s:7:\"cart_id\";s:1:\"2\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:1;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:8:\"#9F9F9F;\";s:5:\"price\";i:10;s:9:\"sub_total\";i:10;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-21 15:30:53', '2023-03-21 15:30:53', 1, 0),
(23, 26, 'a:1:{i:2;a:14:{s:7:\"cart_id\";s:1:\"2\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:1;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:8:\"#9F9F9F;\";s:5:\"price\";i:10;s:9:\"sub_total\";i:10;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-21 15:31:02', '2023-03-21 15:31:02', 1, 0),
(24, 27, 'a:1:{i:2;a:14:{s:7:\"cart_id\";s:1:\"2\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:1;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:8:\"#9F9F9F;\";s:5:\"price\";i:10;s:9:\"sub_total\";i:10;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-21 15:31:13', '2023-03-21 15:31:13', 1, 0),
(25, 28, 'a:1:{i:2;a:14:{s:7:\"cart_id\";s:1:\"2\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:1;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:8:\"#9F9F9F;\";s:5:\"price\";i:10;s:9:\"sub_total\";i:10;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-21 15:32:37', '2023-03-21 15:32:37', 1, 0),
(26, 29, 'a:1:{i:2;a:14:{s:7:\"cart_id\";s:1:\"2\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:1;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:8:\"#9F9F9F;\";s:5:\"price\";i:10;s:9:\"sub_total\";i:10;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-21 15:33:57', '2023-03-21 15:33:57', 1, 0),
(27, 30, 'a:1:{i:2;a:14:{s:7:\"cart_id\";s:1:\"2\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:1;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:8:\"#9F9F9F;\";s:5:\"price\";i:10;s:9:\"sub_total\";i:10;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-21 15:41:05', '2023-03-21 15:41:05', 1, 0),
(28, 31, 'a:1:{i:2;a:14:{s:7:\"cart_id\";s:1:\"2\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:1;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:8:\"#9F9F9F;\";s:5:\"price\";i:10;s:9:\"sub_total\";i:10;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-21 15:41:50', '2023-03-21 15:41:50', 1, 0),
(29, 32, 'a:1:{i:2;a:14:{s:7:\"cart_id\";s:1:\"2\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:1;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:8:\"#9F9F9F;\";s:5:\"price\";i:10;s:9:\"sub_total\";i:10;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-21 15:50:11', '2023-03-21 15:50:11', 1, 0),
(30, 33, 'a:1:{i:2;a:14:{s:7:\"cart_id\";s:1:\"2\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:1;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:8:\"#9F9F9F;\";s:5:\"price\";i:10;s:9:\"sub_total\";i:10;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-21 16:08:31', '2023-03-21 16:08:31', 1, 0),
(31, 34, 'a:1:{i:2;a:14:{s:7:\"cart_id\";s:1:\"2\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:1;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:8:\"#9F9F9F;\";s:5:\"price\";s:3:\"963\";s:9:\"sub_total\";i:963;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-21 16:12:55', '2023-03-21 16:12:55', 1, 0),
(32, 35, 'a:1:{i:2;a:14:{s:7:\"cart_id\";s:1:\"2\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:1;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:8:\"#9F9F9F;\";s:5:\"price\";s:3:\"963\";s:9:\"sub_total\";i:963;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-21 16:16:25', '2023-03-21 16:16:25', 1, 0),
(33, 36, 'a:2:{i:22;a:14:{s:7:\"cart_id\";s:2:\"22\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:8;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:7:\"#ff0000\";s:5:\"price\";i:10;s:9:\"sub_total\";i:80;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}i:23;a:14:{s:7:\"cart_id\";s:2:\"23\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";s:1:\"3\";s:8:\"color_id\";s:1:\"2\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:4:\"Blue\";s:4:\"code\";s:7:\"#0000ff\";s:5:\"price\";i:25;s:9:\"sub_total\";i:75;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-22 00:53:37', '2023-03-22 00:53:37', 1, 0),
(34, 37, 'a:2:{i:22;a:14:{s:7:\"cart_id\";s:2:\"22\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:8;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:7:\"#ff0000\";s:5:\"price\";i:10;s:9:\"sub_total\";i:80;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}i:23;a:14:{s:7:\"cart_id\";s:2:\"23\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";s:1:\"3\";s:8:\"color_id\";s:1:\"2\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:4:\"Blue\";s:4:\"code\";s:7:\"#0000ff\";s:5:\"price\";i:25;s:9:\"sub_total\";i:75;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-22 00:53:55', '2023-03-22 00:53:55', 1, 0),
(35, 38, 'a:2:{i:21;a:14:{s:7:\"cart_id\";s:2:\"21\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";s:1:\"1\";s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:7:\"#ff0000\";s:5:\"price\";i:10;s:9:\"sub_total\";i:10;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}i:22;a:14:{s:7:\"cart_id\";s:2:\"22\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";s:1:\"2\";s:8:\"color_id\";s:1:\"2\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:4:\"Blue\";s:4:\"code\";s:7:\"#0000ff\";s:5:\"price\";i:25;s:9:\"sub_total\";i:50;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-23 19:14:53', '2023-03-23 19:14:53', 1, 0),
(36, 39, 'a:2:{i:21;a:14:{s:7:\"cart_id\";s:2:\"21\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:2;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:7:\"#ff0000\";s:5:\"price\";i:10;s:9:\"sub_total\";i:20;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}i:22;a:14:{s:7:\"cart_id\";s:2:\"22\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";s:1:\"2\";s:8:\"color_id\";s:1:\"2\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:4:\"Blue\";s:4:\"code\";s:7:\"#0000ff\";s:5:\"price\";i:25;s:9:\"sub_total\";i:50;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-23 19:29:06', '2023-03-23 19:29:06', 1, 0),
(37, 40, 'a:2:{i:21;a:14:{s:7:\"cart_id\";s:2:\"21\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:2;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:7:\"#ff0000\";s:5:\"price\";i:10;s:9:\"sub_total\";i:20;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}i:22;a:14:{s:7:\"cart_id\";s:2:\"22\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";s:1:\"2\";s:8:\"color_id\";s:1:\"2\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:4:\"Blue\";s:4:\"code\";s:7:\"#0000ff\";s:5:\"price\";i:25;s:9:\"sub_total\";i:50;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-23 19:30:21', '2023-03-23 19:30:21', 1, 0),
(38, 41, 'a:2:{i:21;a:14:{s:7:\"cart_id\";s:2:\"21\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:2;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:7:\"#ff0000\";s:5:\"price\";i:10;s:9:\"sub_total\";i:20;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}i:22;a:14:{s:7:\"cart_id\";s:2:\"22\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";s:1:\"2\";s:8:\"color_id\";s:1:\"2\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:4:\"Blue\";s:4:\"code\";s:7:\"#0000ff\";s:5:\"price\";i:25;s:9:\"sub_total\";i:50;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-23 19:36:25', '2023-03-23 19:36:25', 1, 0),
(39, 42, 'a:2:{i:21;a:14:{s:7:\"cart_id\";s:2:\"21\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:2;s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:7:\"#ff0000\";s:5:\"price\";i:10;s:9:\"sub_total\";i:20;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}i:22;a:14:{s:7:\"cart_id\";s:2:\"22\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";s:1:\"2\";s:8:\"color_id\";s:1:\"2\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:4:\"Blue\";s:4:\"code\";s:7:\"#0000ff\";s:5:\"price\";i:25;s:9:\"sub_total\";i:50;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-23 19:37:58', '2023-03-23 19:37:58', 1, 0),
(40, 43, 'a:2:{i:21;a:14:{s:7:\"cart_id\";s:2:\"21\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";i:3;s:8:\"color_id\";s:1:\"2\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:4:\"Blue\";s:4:\"code\";s:7:\"#0000ff\";s:5:\"price\";i:25;s:9:\"sub_total\";i:75;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}i:23;a:14:{s:7:\"cart_id\";s:2:\"23\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";s:1:\"3\";s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:7:\"#ff0000\";s:5:\"price\";i:10;s:9:\"sub_total\";i:30;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-23 19:53:49', '2023-03-23 19:53:49', 1, 0),
(41, 44, 'a:2:{i:21;a:14:{s:7:\"cart_id\";s:2:\"21\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";s:1:\"1\";s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:7:\"#ff0000\";s:5:\"price\";i:10;s:9:\"sub_total\";i:10;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}i:22;a:14:{s:7:\"cart_id\";s:2:\"22\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";s:1:\"2\";s:8:\"color_id\";s:1:\"2\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:4:\"Blue\";s:4:\"code\";s:7:\"#0000ff\";s:5:\"price\";i:25;s:9:\"sub_total\";i:50;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-24 16:48:03', '2023-03-24 16:48:03', 1, 0),
(42, 45, 'a:2:{i:21;a:14:{s:7:\"cart_id\";s:2:\"21\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";s:1:\"1\";s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:7:\"#ff0000\";s:5:\"price\";i:10;s:9:\"sub_total\";i:10;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}i:22;a:14:{s:7:\"cart_id\";s:2:\"22\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";s:1:\"2\";s:8:\"color_id\";s:1:\"2\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:4:\"Blue\";s:4:\"code\";s:7:\"#0000ff\";s:5:\"price\";i:25;s:9:\"sub_total\";i:50;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-24 16:54:44', '2023-03-24 16:54:44', 1, 0),
(43, 46, 'a:2:{i:21;a:14:{s:7:\"cart_id\";s:2:\"21\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";s:1:\"1\";s:8:\"color_id\";s:1:\"1\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:3:\"Red\";s:4:\"code\";s:7:\"#ff0000\";s:5:\"price\";i:10;s:9:\"sub_total\";i:10;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}i:22;a:14:{s:7:\"cart_id\";s:2:\"22\";s:9:\"stock_qty\";i:0;s:10:\"product_id\";s:1:\"2\";s:4:\"name\";s:10:\"Vanna Cruz\";s:4:\"slug\";s:11:\"vanna-cruzs\";s:17:\"quantity_selected\";s:1:\"2\";s:8:\"color_id\";s:1:\"2\";s:7:\"size_id\";N;s:10:\"color_name\";N;s:5:\"color\";s:4:\"Blue\";s:4:\"code\";s:7:\"#0000ff\";s:5:\"price\";i:25;s:9:\"sub_total\";i:50;s:5:\"image\";s:86:\"Uploads/products/main_image/2100425966494/UtKnXWBnSG7P3ljVeAUcHW55ylvmPCKzRX0EA96S.png\";}}', '2023-03-24 16:56:51', '2023-03-24 16:56:51', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_inquiry`
--

CREATE TABLE `order_inquiry` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `partner`
--

CREATE TABLE `partner` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `img_path` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partner`
--

INSERT INTO `partner` (`id`, `title`, `img_path`, `category_id`, `sub_category_id`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(7, 'MGHL', 'Uploads/partner/thumbnails/7183287528931/0Xd7sebnqLkuFfBT8jsVWuKJg2a7vNvFXQVjvGsz.png', NULL, NULL, 1, 0, '2022-02-21 15:49:44', '2022-02-21 15:51:34'),
(8, 'NJHL', 'Uploads/partner/thumbnails/838049451642/cwqxPWeMzuK0cXkxl74X5aDFYec5K8lfLL9fmIh8.png', NULL, NULL, 1, 0, '2022-02-21 15:50:02', '2022-02-21 15:50:02'),
(9, 'MWHL', 'Uploads/partner/thumbnails/9205220976036/zWER1Xc1HTCnhtW3x7bBroAbPzdKfxS3mmDzPJ6C.png', NULL, NULL, 1, 0, '2022-02-21 15:50:16', '2022-02-21 15:50:17'),
(10, 'MGHL', 'Uploads/partner/thumbnails/1057453577293/uD54n4joTQyP7Cyh1WhGUf0tFe3d8N7gD4Xj2VLw.png', NULL, NULL, 1, 0, '2022-02-21 15:50:46', '2022-02-21 15:50:46');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(1, 'test@test.com', 'RzreHdkxOCMHYM7jOYokMQHFLaQMo8VceUthW537P4fVdOvD5FAceYyICf1afOlm', '2021-11-22 20:45:32'),
(2, 'test@test.com', 'k1cV2VgsHGG6QWS5NO47G767jl4TWWW1fGNKGvPPhxkzYdUomZxK0myJk3QDJeC5', '2021-11-22 20:46:05');

-- --------------------------------------------------------

--
-- Table structure for table `payment_logs`
--

CREATE TABLE `payment_logs` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `amount` float(8,2) DEFAULT NULL,
  `name_on_card` varchar(255) DEFAULT NULL,
  `response_code` varchar(255) DEFAULT NULL,
  `transaction_id` text DEFAULT NULL,
  `auth_id` varchar(255) DEFAULT NULL,
  `message_code` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `flavor` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `short_desc` text DEFAULT NULL,
  `long_desc` text DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `img_path` text DEFAULT NULL,
  `link_product` longtext DEFAULT NULL,
  `start_time` text DEFAULT NULL,
  `end_time` text DEFAULT NULL,
  `outdoor` int(11) DEFAULT NULL,
  `delivery` int(11) DEFAULT NULL,
  `takeout` int(11) DEFAULT NULL,
  `feature` text DEFAULT NULL,
  `suggestion` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `type`, `name`, `slug`, `price`, `flavor`, `size`, `short_desc`, `long_desc`, `category_id`, `img_path`, `link_product`, `start_time`, `end_time`, `outdoor`, `delivery`, `takeout`, `feature`, `suggestion`, `status`, `created_at`, `updated_at`, `is_active`, `is_deleted`, `is_featured`) VALUES
(1, 1, 'Sade Barnes', 'sade-barnes', '757', NULL, NULL, '<p>Qui magnam natus mag.</p>', '<p>Officia laboriosam, .</p>', 1, 'Uploads/products/main_image/1123820688457/bJpqQr4xdmgqhW8Exb32kuCfZqmBMPzI764rK3tm.png', NULL, '00:17', '19:47', 1, 1, 0, NULL, NULL, 1, '2023-03-31 14:46:46', '2023-03-31 14:46:46', 1, 0, 0),
(2, 1, 'Tyrone Holloway', 'tyrone-holloway', '93', NULL, NULL, '<p>Nobis minus quibusda.</p>', '<p>A aperiam aliquip om.</p>', 1, 'Uploads/products/main_image/262001775812/vPlPtTVfgvIKlpZPyOVwOWzVyem1ofzzuPQ2n3WV.png', NULL, '08:18', '18:22', 0, 1, 1, NULL, NULL, 1, '2023-03-31 14:53:46', '2023-03-31 14:53:46', 1, 0, 0),
(3, 1, 'Dennis Summers', 'dennis-summers', '147', NULL, NULL, '<p>Sint quae magnam arc.</p>', '<p>Aliquam dolor ullamc.</p>', 2, 'Uploads/products/main_image/3138675927739/9mU42EBJm4xsUAo5Wha9wERH089aHhI8RQT1W7sv.png', NULL, '13:10', '11:52', 0, 1, 0, NULL, NULL, 0, '2023-03-31 15:24:08', '2023-03-31 15:24:08', 1, 0, 0),
(4, 1, 'Forrest Golden', 'forrest-golden', '263', NULL, NULL, '<p>Vitae dolorem delect.</p>', '<p>Est, dolores dicta d.</p>', 2, 'Uploads/products/main_image/47072740876/2ykrxqN43Yzc0mUidrdNevSJf5uZDXXrfDyh2OA6.png', NULL, '19:32', '17:20', 1, 1, 0, NULL, NULL, 1, '2023-03-31 15:24:32', '2023-03-31 15:24:32', 1, 0, 0),
(5, 1, 'Hunter Hays', 'hunter-hays', '660', NULL, NULL, '<p>Nam illum, et dolore.</p>', '<p>Voluptas consequatur.</p>', 1, 'Uploads/products/main_image/5100859412335/1DoUkzQJ3df2Ujlt4yEbYdkaJUXtgN8lWVyPDGaK.png', NULL, '18:57', '13:24', 1, 0, 1, NULL, NULL, 1, '2023-03-31 15:24:51', '2023-03-31 15:24:51', 1, 0, 0),
(6, 1, 'Kevin Deleon', 'kevin-deleon', '201', NULL, NULL, '<p>In aut officiis assu.</p>', '<p>Saepe nesciunt, iure.</p>', 5, 'Uploads/products/main_image/6211661157397/akY0eDaTshNIX1YZBPpIXAQBubEl7QgnAdvmjQjP.png', NULL, '20:56', '01:40', 1, 0, 0, NULL, NULL, 1, '2023-03-31 15:26:31', '2023-03-31 15:26:31', 1, 0, 0),
(7, 1, 'Regina Butler', 'regina-butler', '992', NULL, NULL, '<p>Aliquam perspiciatis.</p>', '<p>Sint perspiciatis, a.</p>', 5, 'Uploads/products/main_image/7144349243979/8ZW5m8WCYkmEU5C3d48lw77A0HQSniERHzadpZpt.png', NULL, '05:07', '02:20', 0, 1, 0, NULL, NULL, 1, '2023-03-31 15:26:56', '2023-03-31 15:26:56', 1, 0, 0),
(8, 1, 'Aubrey Dalton', 'aubrey-dalton', '464', NULL, NULL, '<p>Sit, praesentium cor.</p>', '<p>Id, ipsum duis offic.</p>', 5, 'Uploads/products/main_image/864215084337/xdObp6nwNi0F4DcFFMFVSgua05IGnoMaxR4B7iPW.png', NULL, '18:47', '03:48', 0, 0, 1, NULL, NULL, 1, '2023-03-31 15:27:29', '2023-03-31 15:27:29', 1, 0, 0),
(9, 1, 'Morgan Odom', 'morgan-odom', '242', NULL, NULL, '<p>Magni aliqua. Velit .</p>', '<p>Pariatur. Rerum porr.</p>', 3, 'Uploads/products/main_image/9175001356116/zP0jjjhwqeEHodsXF5F38BQ6nCgiSEesJk6L3I1f.png', NULL, '15:03', '07:37', 0, 1, 1, NULL, NULL, 1, '2023-03-31 15:28:20', '2023-03-31 15:28:20', 1, 0, 0),
(10, 1, 'Fallon Carlson', 'fallon-carlson', '149', NULL, NULL, '<p>Natus dolore esse qu.</p>', '<p>Magnam quia voluptat.</p>', 3, 'Uploads/products/main_image/10166188907232/oGB5QWyIjgTvPYKbYK9NcqTLerS2LwsxCs3hPJWk.png', NULL, '08:23', '04:36', 1, 1, 1, NULL, NULL, 1, '2023-03-31 15:28:50', '2023-03-31 15:28:50', 1, 0, 0),
(11, 1, 'Byron Dawson', 'byron-dawson', '10', NULL, NULL, '<p>Dolorem molestiae an.</p>', '<p>Aute excepturi vel a.</p>', 3, 'Uploads/products/main_image/1183877347821/VE7hGaoqyCtaFLJ4greAGc5iJ0p6Bo7XyYCDw8hF.png', NULL, '13:31', '10:25', 1, 1, 1, NULL, NULL, 0, '2023-03-31 15:29:21', '2023-03-31 15:29:21', 1, 0, 0),
(12, 1, 'Gwendolyn Pickett', 'gwendolyn-pickett', '708', NULL, NULL, '<p>Ullam magnam quo sit.</p>', '<p>Necessitatibus autem.</p>', 4, 'Uploads/products/main_image/1231534020342/R0s9vl2xFdSFGkD8Y8Ug4EBXVIFPcRbT1LzZFte4.png', NULL, '14:32', '18:46', 1, 0, 1, NULL, NULL, 1, '2023-03-31 15:29:59', '2023-04-10 20:23:19', 1, 0, 0),
(13, 1, 'Uma Cardenas', 'uma-cardenas', '66', NULL, NULL, '<p>Distinctio. Ipsam de.</p>', '<p>Enim nihil consequat.</p>', 5, 'Uploads/products/main_image/13114866822863/4JPQpVv8jp4uuHl8K1JxIIOEWbIitmdzmjT1inOk.png', NULL, '01:53', '06:26', 1, 1, 0, NULL, NULL, 0, '2023-04-10 13:34:26', '2023-04-10 13:34:27', 1, 0, 0),
(14, 1, 'Grant Hurst', 'grant-hurst', '288', NULL, NULL, '<p>Sed velit ratione ev.</p>', '<p>Consequatur, est id.</p>', 1, 'Uploads/products/main_image/13114866822863/4JPQpVv8jp4uuHl8K1JxIIOEWbIitmdzmjT1inOk.png', NULL, '00:05', '21:09', 0, 1, 1, 'a:3:{i:0;s:13:\"good_for_Kids\";i:1;s:6:\"has_tv\";i:2;s:15:\"outdoor_seating\";}', NULL, 0, '2023-04-10 13:36:28', '2023-04-10 18:54:05', 1, 0, 0),
(15, 1, 'Marcia Dalton', 'marcia-dalton', '158', NULL, NULL, '<p>Sint labore error eu.</p>', '<p>Reprehenderit molest.</p>', 1, 'Uploads/products/main_image/1582681547281/6iG4NW9AIVSfygGmSsIEHWovsqoE8D50clruOg30.png', NULL, '09:31', '01:17', 0, 0, 0, NULL, NULL, 0, '2023-04-11 16:53:04', '2023-04-11 16:53:04', 1, 0, 0),
(16, 1, 'Ethan Lara', 'ethan-lara', '530', NULL, NULL, '<p>Placeat, excepturi q.</p>', '<p>Qui incidunt, assume.</p>', 1, NULL, NULL, '17:43', '22:35', 0, 0, 0, NULL, NULL, 0, '2023-04-11 16:59:59', '2023-04-11 16:59:59', 1, 0, 0),
(17, 1, 'Ethan Lara', 'ethan-lara', '530', NULL, NULL, '<p>Placeat, excepturi q.</p>', '<p>Qui incidunt, assume.</p>', 1, NULL, NULL, '17:43', '22:35', 0, 0, 0, NULL, NULL, 0, '2023-04-11 18:16:46', '2023-04-11 18:16:46', 1, 0, 0),
(18, 1, 'Ethan Lara', 'ethan-lara', '530', NULL, NULL, '<p>Placeat, excepturi q.</p>', '<p>Qui incidunt, assume.</p>', 1, NULL, NULL, '17:43', '22:35', 0, 0, 0, NULL, NULL, 0, '2023-04-11 18:17:13', '2023-04-11 18:17:13', 1, 0, 0),
(19, 1, 'Simone Castillo', 'simone-castillo', '687', NULL, NULL, '<p>Voluptates corporis .</p>', '<p>Eligendi nesciunt, e.</p>', 1, NULL, NULL, '00:25', '19:29', 0, 0, 0, NULL, 'a:4:{i:0;s:13:\"kasimir-evans\";i:1;s:13:\"bruno-sampson\";i:2;s:14:\"grady-stafford\";i:3;s:18:\"gabriel-stephenson\";}', 0, '2023-04-11 18:18:19', '2023-04-11 18:18:19', 1, 0, 0),
(20, 1, 'Colton Davenport', 'colton-davenport', '93', NULL, NULL, '<p>Sint iure adipisicin.</p>', '<p>Est qui ut ut ut eaq.</p>', 1, NULL, NULL, '19:21', '05:44', 0, 0, 0, NULL, 'a:4:{i:0;s:13:\"kasimir-evans\";i:1;s:15:\"octavius-dalton\";i:2;s:14:\"grady-stafford\";i:3;s:18:\"gabriel-stephenson\";}', 0, '2023-04-11 18:19:12', '2023-04-11 18:19:12', 1, 0, 0),
(21, 1, 'Colton Davenport', 'colton-davenport', '93', NULL, NULL, '<p>Sint iure adipisicin.</p>', '<p>Est qui ut ut ut eaq.</p>', 1, 'Uploads/products/main_image/215143903639/ckrToFhHFJPVC2XNVVu6PZdQCE9OkXpy758ShE1C.png', NULL, '19:21', '05:44', 0, 0, 0, NULL, 'a:4:{i:0;s:13:\"kasimir-evans\";i:1;s:15:\"octavius-dalton\";i:2;s:14:\"grady-stafford\";i:3;s:18:\"gabriel-stephenson\";}', 0, '2023-04-11 18:20:08', '2023-04-11 18:20:08', 1, 0, 0),
(22, 1, 'Kaitlin Macdonald', 'kaitlin-macdonald', '600', NULL, NULL, '<p>Sed dolores temporib.</p>', '<p>Et reprehenderit pro.</p>', 1, 'Uploads/products/main_image/2243647495947/a1FOHS4b0cElB9h2lLEIsQE0Y4t7aSWVyNjcOGXI.png', NULL, '00:55', '10:50', 0, 0, 0, NULL, 'a:4:{i:0;s:13:\"bruno-sampson\";i:1;s:15:\"octavius-dalton\";i:2;s:14:\"grady-stafford\";i:3;s:12:\"fiona-greene\";}', 0, '2023-04-11 18:20:40', '2023-04-11 18:20:40', 1, 0, 0),
(23, 1, 'Amanda Stokes', 'amanda-stokes', '230', NULL, NULL, '<p>In eveniet, quia est.</p>', '<p>Anim quam et rem min.</p>', 1, 'Uploads/products/main_image/23121500127275/T6rvAHgH9qdFfO46V2s7ZV3B3KqJJIXymUY1DUBz.png', NULL, '02:31', '14:16', 0, 0, 0, NULL, 'a:4:{i:0;s:13:\"bruno-sampson\";i:1;s:15:\"octavius-dalton\";i:2;s:12:\"fiona-greene\";i:3;s:18:\"gabriel-stephenson\";}', 0, '2023-04-11 19:05:22', '2023-04-11 19:05:22', 1, 0, 0),
(24, 1, 'Blair Maldonado', 'blair-maldonado', '258', NULL, NULL, '<p>Et fuga. Ut est magn.</p>', '<p>Aut veniam, deserunt.</p>', 1, 'Uploads/products/main_image/24178122996142/siz0MTs3eg91YS0Y1ClYpZfFXaczrSEBfI7Pu5XA.png', NULL, '04:00', '07:43', 0, 0, 0, 'a:2:{i:0;s:14:\"grady-stafford\";i:1;s:12:\"fiona-greene\";}', 'a:2:{i:0;s:13:\"bruno-sampson\";i:1;s:15:\"octavius-dalton\";}', 0, '2023-04-11 19:10:53', '2023-04-11 19:10:53', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `attempt_no` int(11) DEFAULT NULL,
  `pay_status` tinyint(4) NOT NULL DEFAULT 0,
  `total_amount` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `percentage` varchar(255) DEFAULT NULL,
  `order_response` text DEFAULT NULL,
  `order_merchant` varchar(255) DEFAULT NULL,
  `certificate` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `name`, `email`, `phone`, `user_id`, `type`, `item_id`, `review`, `rating`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
(6, 'bad', 'abc@abc.com', '12321312321', 6, 2, 1, 'bad', '1', '2022-02-28 12:33:37', '2022-02-28 17:33:56', 1, 0),
(7, 'nice', 'abc@abc.com', '12321312321', 6, 2, 1, 'nice', '4', '2022-02-28 12:34:57', '2022-02-28 17:36:17', 1, 0),
(8, 'asdasd', 'abc@abc.com', '12321312321', 6, 2, 1, 'asdasd', '3', '2022-02-28 12:36:06', '2022-02-28 17:36:20', 1, 0),
(9, 'nice', 'abc@abc.com', '12321312321', 6, 1, 2, 'nice', '5', '2022-02-28 12:36:56', '2023-03-20 14:32:02', 1, 0),
(10, 'asda', 'abc@abc.com', '12321312321', 6, 1, 2, 'qq', '3', '2022-02-28 12:38:44', '2023-03-23 20:29:30', 1, 0),
(14, 'jhon doe', '1999chrisaustin@gmail.com', '5252145632', 23, 1, 2, 'afsasf', '5', '2022-03-05 00:36:21', '2023-03-20 14:31:56', 1, 0),
(15, 'chirsaustin', '1999chrisaustin@gmail.com', '5421366578', 22, 1, 2, 'ZAD', '3', '2022-06-17 13:10:25', '2023-03-23 20:36:51', 1, 0),
(16, 'Hasad Townsend', 'burekorud@mailinator.com', '+1 (989) 189-4338', 1, 1, 2, 'Beatae qui delectus', '5', '2023-03-20 14:29:14', '2023-03-23 20:29:44', 1, 0),
(17, 'Sade Rosa', 'tibidefeju@mailinator.com', '+1 (247) 672-9089', 1, 1, 1, 'Repudiandae cupidita', '4', '2023-03-20 16:46:49', '2023-03-23 20:38:05', 1, 0),
(18, 'Dahlia Randall', 'xydihobu@mailinator.com', '+1 (894) 281-4892', 1, NULL, 13, 'Cupiditate ut ration', '2', '2023-03-24 19:27:54', '2023-03-24 19:28:20', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Seller', '2023-01-14 00:19:39', '2023-01-14 00:19:39'),
(2, 'Buyer', '2023-01-14 00:19:39', '2023-01-14 00:19:39'),
(3, 'Lender', '2023-01-14 00:19:39', '2023-01-14 00:19:39');

-- --------------------------------------------------------

--
-- Table structure for table `shop_image`
--

CREATE TABLE `shop_image` (
  `id` int(11) NOT NULL,
  `cat_type` varchar(255) DEFAULT NULL,
  `img_path` text DEFAULT NULL,
  `ref_id` int(11) DEFAULT NULL,
  `img_type` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_image`
--

INSERT INTO `shop_image` (`id`, `cat_type`, `img_path`, `ref_id`, `img_type`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
(10, 'products', 'Uploads/products/other_image/430799248590/LXp7KSXCS1st5aj8jNOTn428CgZXEFGXEEh1qNON.png', 1, 2, '2023-03-16 14:40:54', '2023-03-16 14:40:54', 1, 0),
(11, 'products', 'Uploads/products/other_image/1146325987842/hxySIHcMQtzIqfsKLo2u92L8PMo1aFJrmBjcrBHg.png', 1, 2, '2023-03-16 14:40:54', '2023-03-16 14:40:54', 1, 0),
(12, 'products', 'Uploads/products/other_image/366851919462/1a0MIvg6qJiq0PvZXt1QGPACRL7cFd5NpvVyMGX2.png', 2, 2, '2023-03-16 14:42:19', '2023-03-16 14:42:19', 1, 0),
(13, 'products', 'Uploads/products/other_image/1440252912848/8CAPH3u3080GZZsr0pCknVhN8zo01FAegzK0C8yo.png', 2, 2, '2023-03-16 14:42:19', '2023-03-16 14:42:19', 1, 0),
(14, 'products', 'Uploads/products/other_image/934821851658/bqg5nEaURVQVgzWCkRBUruw6GSxtnafXdi1Gn4Tz.jpg', 1, 2, '2023-03-28 22:51:38', '2023-03-28 22:51:38', 1, 0),
(15, 'products', 'Uploads/products/other_image/1178651363465/Pi3c4SN7Yk36Ji67d8e788cEUZNl3eysVNT9UgU7.jpg', 1, 2, '2023-03-28 22:51:38', '2023-03-28 22:51:38', 1, 0),
(16, 'products', 'Uploads/products/other_image/1594647096628/BMQcx1gWZXdUuEUvLWJphndF60lhXjVoLjUrNXzZ.jpg', 2, 2, '2023-03-28 23:03:48', '2023-03-28 23:03:48', 1, 0),
(17, 'products', 'Uploads/products/other_image/15632505556/4WmuhISBc64YygFJhGGcmHLnMUdaTnWnPnwuqCwF.jpg', 2, 2, '2023-03-28 23:03:48', '2023-03-28 23:03:48', 1, 0),
(18, 'products', 'Uploads/products/other_image/519339564834/Oop2H4FTVmVmk158pxqDdKBnXXLyu7g4UydtS6XP.jpg', 3, 2, '2023-03-28 23:08:17', '2023-03-28 23:08:17', 1, 0),
(19, 'products', 'Uploads/products/other_image/74174378793/mNCYcUpauolXJWQIIy36XyVjL49JlGhoAkBM3g9o.jpg', 3, 2, '2023-03-28 23:08:17', '2023-03-28 23:08:17', 1, 0),
(20, 'products', 'Uploads/products/other_image/921095262366/vUH0tKNykYERdcRb7LWgWTstMkMyyniugeN93SVI.jpg', 3, 2, '2023-03-28 23:08:17', '2023-03-28 23:08:17', 1, 0),
(21, 'products', 'Uploads/products/other_image/4563385055/7o5bnRl9zrTuMtuv7RpeVK85D2K5XhhZWxwqb28k.jpg', 3, 2, '2023-03-28 23:08:17', '2023-03-28 23:08:17', 1, 0),
(22, 'products', 'Uploads/products/other_image/613257576586/G0YUKOyoqZzTwbXauwgPjDHRhtRuNRfgZ1v5lEI0.jpg', 3, 2, '2023-03-28 23:08:17', '2023-03-28 23:08:17', 1, 0),
(23, 'products', 'Uploads/products/other_image/1514458792971/0w5eGrT4DGavWOUITTjkUvZjuN21Qb1XMCSOGJjr.jpg', 4, 2, '2023-03-28 23:15:14', '2023-03-28 23:15:14', 1, 0),
(24, 'products', 'Uploads/products/other_image/1608169827111/A0jW2TsXgxvvsKSdkF5WyJ1Jduz3fGxK6VgXny7Y.jpg', 4, 2, '2023-03-28 23:15:14', '2023-03-28 23:15:14', 1, 0),
(25, 'products', 'Uploads/products/other_image/530726811841/RumV4H4zvQUIeGQlsNJnm4u8kPdBRrdm9Dcpj6ZC.jpg', 4, 2, '2023-03-28 23:15:14', '2023-03-28 23:15:14', 1, 0),
(26, 'products', 'Uploads/products/other_image/338748843850/TrS9o35TgkC8q8MnmdR8PRXm6ZId0PDrF8tEe1Uu.jpg', 4, 2, '2023-03-28 23:15:14', '2023-03-28 23:15:14', 1, 0),
(27, 'products', 'Uploads/products/other_image/381702767728/Q3Ih5h4ECgrJMtsrk2dSae5COm64W16CHweJzKGy.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(28, 'products', 'Uploads/products/other_image/1684569094258/GGATyXY60N6BwfFhw7XIjGmi7L8UTltX8kmPbV2D.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(29, 'products', 'Uploads/products/other_image/1748107016630/rx2vjfzRNOL3vHkiJie3rbpXjSjErpU2Pwa5fRti.png', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(30, 'products', 'Uploads/products/other_image/1375280427741/UxF91IB93ErELJSGdJpqiQtLGeZa7WQ33wrBvyt3.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(31, 'products', 'Uploads/products/other_image/387206551560/HjMiphb9DHaTWdQ5fdZJ5jDdGCnQ4BEOT7annqTU.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(32, 'products', 'Uploads/products/other_image/142938726818/Cbi8CIYmK753mCNnZcNeT8n4DxRqiJggRd8onZjB.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(33, 'products', 'Uploads/products/other_image/130743422079/JXcWIlRbtvi6FypGsC2kSnGIiR3zgYRiE1LlpJiS.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(34, 'products', 'Uploads/products/other_image/331031723913/qm46sph6wte9xtJaMT5eYL2MwboziVfmN5luFzSm.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(35, 'products', 'Uploads/products/other_image/567434687402/oUvxZpIn2kimEiQm6UnkGEGW4cjcGbODZhPz66DX.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(36, 'products', 'Uploads/products/other_image/745162423844/kbUXm4dwH4IuTq7w4lwUQpcPnNjHe8q3SuCjVqPX.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(37, 'products', 'Uploads/products/other_image/1706574727526/tVSX8frqh5yCyMDKLBbdqPgIGc5Nd0oQwzNQMKxw.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(38, 'products', 'Uploads/products/other_image/1349825120572/apBQpGsPXCP82gZo3hDBNbmT0XiDppYalt4zfv87.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(39, 'products', 'Uploads/products/other_image/1485813522877/bbRkz3hKICGspikbA7os3P9C6MllBT3GUuaNZj5s.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(40, 'products', 'Uploads/products/other_image/1765282248369/sOfpEK9nuFy1TFjXjlcnUX9GPv2kEtGZ8Y2yCrBL.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(41, 'products', 'Uploads/products/other_image/1305776188925/hoCI5b7oacniSc6QBqG2fFluK7aiLDKoSOcNbGhk.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(42, 'products', 'Uploads/products/other_image/1557688879208/2UcTKO5TSWyIxCGxzQUT48s1V4Dno1ZtdUgxfunj.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(43, 'products', 'Uploads/products/other_image/537431036726/GXfUVZsNVg702s6DqInbh8s4wkl4pk1R4NVqKpys.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(44, 'products', 'Uploads/products/other_image/60200677802/bsiaiLBw6Wz8U36KlXdd4pLhIj3cKzJxNvYT03g3.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(45, 'products', 'Uploads/products/other_image/134135374730/lYnBqhC3hCQGc4cwutqBRq8SRjiQRZxFItCZlKuM.jpg', 1, 2, '2023-03-30 14:03:07', '2023-03-30 14:03:07', 1, 0),
(46, 'products', 'Uploads/products/other_image/907740425171/thK3VA3FmQzm6INNswVgo6V9HQCz9rlOcKG2sTNS.jpg', 2, 2, '2023-03-30 14:19:19', '2023-03-30 14:19:19', 1, 0),
(47, 'products', 'Uploads/products/other_image/1243496780775/3pjVwPoWTybZQoJOjweldq9Z7aldP0cOfQZcpZQ7.jpg', 2, 2, '2023-03-30 14:19:19', '2023-03-30 14:19:19', 1, 0),
(48, 'products', 'Uploads/products/other_image/1767064254314/0Du0aybdWn9XyRDACF4d1sSzHVfN5K24pvlKuMXn.jpg', 2, 2, '2023-03-30 14:19:19', '2023-03-30 14:19:19', 1, 0),
(49, 'products', 'Uploads/products/other_image/1416750672861/RTXZ3xLXtgQ2auN2To6BL2fqEDGRcP60LYBKmleA.jpg', 2, 2, '2023-03-30 14:19:19', '2023-03-30 14:19:19', 1, 0),
(50, 'products', 'Uploads/products/other_image/1166932934762/wNc4JvBJp5XQZZ7nYRmYxQT0NDzsfWNt72XmnpSU.jpg', 2, 2, '2023-03-30 14:19:19', '2023-03-30 14:19:19', 1, 0),
(51, 'products', 'Uploads/products/other_image/952806957903/Kg2H81a7nPdlU66uaPGyhlCZlQHl7irdcb9JoV9I.jpg', 2, 2, '2023-03-30 14:19:19', '2023-03-30 14:19:19', 1, 0),
(52, 'products', 'Uploads/products/other_image/318814523173/qg89taU98iFZIpaxg8SRRQQjCsJm5BSuCiNU2VEQ.jpg', 2, 2, '2023-03-30 14:19:19', '2023-03-30 14:19:19', 1, 0),
(53, 'products', 'Uploads/products/other_image/1841478413558/GEBRWhZTnhjNc8s9BfQNZ4zfejXvpMJfBrXERN6k.jpg', 2, 2, '2023-03-30 14:19:19', '2023-03-30 14:19:19', 1, 0),
(54, 'products', 'Uploads/products/other_image/1087886837105/xL7ZO1yAH3va8tGhSBXT08hBSa0lDdzmD6EZCfs1.jpg', 2, 2, '2023-03-30 14:19:20', '2023-03-30 14:19:20', 1, 0),
(55, 'products', 'Uploads/products/other_image/1963538150695/KkkSDg3OBx4I5Zig49r6F7EzY6v2GIlWLIt7tGw1.jpg', 2, 2, '2023-03-30 14:19:20', '2023-03-30 14:19:20', 1, 0),
(56, 'products', 'Uploads/products/other_image/655147880811/wwWjDMfqsdZ8T6Gx0EanHM46GEg1tHJU8yDDC0Vj.jpg', 2, 2, '2023-03-30 14:19:20', '2023-03-30 14:19:20', 1, 0),
(57, 'products', 'Uploads/products/other_image/292493098597/BgacKtQCuVlXn1XBlPbIYVRE7wZn6e0Wv6jKFcMt.jpg', 2, 2, '2023-03-30 14:19:20', '2023-03-30 14:19:20', 1, 0),
(58, 'products', 'Uploads/products/other_image/1134318380597/R5NhVNBWzBL4t4S6X8XMpVJCBSsyWNmIOtqHV7BB.jpg', 2, 2, '2023-03-30 14:19:20', '2023-03-30 14:19:20', 1, 0),
(59, 'products', 'Uploads/products/other_image/1618399006900/1JjdWB8qS7Y69UecAwJEaUDXScadtEHhOUEnD0hO.jpg', 2, 2, '2023-03-30 14:19:20', '2023-03-30 14:19:20', 1, 0),
(60, 'products', 'Uploads/products/other_image/1228986442995/e53cfcYDDxMA4Z8i1DU9zwqfrBhZFTycDiwOv2Mc.jpg', 2, 2, '2023-03-30 14:19:20', '2023-03-30 14:19:20', 1, 0),
(61, 'products', 'Uploads/products/other_image/1323027017805/WeVN5x6CEOIYKELa9A6KEf5pxUBiIG2nC6flbyYx.jpg', 2, 2, '2023-03-30 14:19:20', '2023-03-30 14:19:20', 1, 0),
(62, 'products', 'Uploads/products/other_image/416316944176/RrwS5cn21GE0QqdfV0eLuvSMdBGtSWLkaoNb0c2C.jpg', 2, 2, '2023-03-30 14:19:20', '2023-03-30 14:19:20', 1, 0),
(63, 'products', 'Uploads/products/other_image/521277763495/jEqk5HPGgWPDLuDqD3YJqVYcUHF7e2Rq803rU12r.jpg', 2, 2, '2023-03-30 14:19:20', '2023-03-30 14:19:20', 1, 0),
(64, 'products', 'Uploads/products/other_image/684867356378/IwkMEBkH41NFTTfPPyLBENRspUdqt2E61PrfvtSQ.jpg', 2, 2, '2023-03-30 14:19:20', '2023-03-30 14:19:20', 1, 0),
(65, 'products', 'Uploads/products/other_image/599004239524/tu5nzzXKPhsq5rzTqJ5O6SPO1f8ySSEkrJt19nH4.jpg', 3, 2, '2023-03-30 14:29:40', '2023-03-30 14:29:40', 1, 0),
(66, 'products', 'Uploads/products/other_image/190862857289/LQWu1HQ7LCRESRdykjjglYsyiKfHikVbKtvuqldt.webp', 3, 2, '2023-03-30 14:29:40', '2023-03-30 14:29:40', 1, 0),
(67, 'products', 'Uploads/products/other_image/104212247863/qNYvVM4Io6k1O4RdfMQ1XEAuvOxGFU2BvEXwfJvc.webp', 3, 2, '2023-03-30 14:29:40', '2023-03-30 14:29:40', 1, 0),
(68, 'products', 'Uploads/products/other_image/915991383125/yr04oljX3szB7CZEuFrpE7TAWghRzJCZEkfGitbn.webp', 3, 2, '2023-03-30 14:29:40', '2023-03-30 14:29:40', 1, 0),
(69, 'products', 'Uploads/products/other_image/1514033416639/BoiPPeUAip5MlqtJPfOh2Gt7V2YDQmxJk7Lckyaz.webp', 3, 2, '2023-03-30 14:29:41', '2023-03-30 14:29:41', 1, 0),
(70, 'products', 'Uploads/products/other_image/1413993248305/BetTOqHzqeLJAywoEcBBaX6JNliU33a79A77jQrj.webp', 3, 2, '2023-03-30 14:29:41', '2023-03-30 14:29:41', 1, 0),
(71, 'products', 'Uploads/products/other_image/2108489410658/zpubAX5L2WsTCdVIPJwqjilvXXkMWM0ozkO7bDkr.webp', 3, 2, '2023-03-30 14:29:41', '2023-03-30 14:29:41', 1, 0),
(72, 'products', 'Uploads/products/other_image/1369634665552/I6Y3o8yHBRsZZMYyIilmLFtGQllzgP1Fh7qah8gk.webp', 3, 2, '2023-03-30 14:29:41', '2023-03-30 14:29:41', 1, 0),
(73, 'products', 'Uploads/products/other_image/705387238453/jXowbvOv1liRXI2E2j5dWDqFO43ih0OdOIhM2lUi.webp', 3, 2, '2023-03-30 14:29:41', '2023-03-30 14:29:41', 1, 0),
(74, 'products', 'Uploads/products/other_image/2134286782800/LVnc2Sx6HLSayGOgvtI4wBC2iFGmj7YvDUxnoO8s.webp', 3, 2, '2023-03-30 14:29:41', '2023-03-30 14:29:41', 1, 0),
(75, 'products', 'Uploads/products/other_image/148628165494/sprIdV9P4Omt1kWpIBmKMmVvYjxxGNfqUohef3Wp.webp', 3, 2, '2023-03-30 14:29:41', '2023-03-30 14:29:41', 1, 0),
(76, 'products', 'Uploads/products/other_image/1286869871960/lFyA9FrP8jcAMzhBX1MSRJDh9KZIytejPS3Nkv9X.webp', 3, 2, '2023-03-30 14:29:41', '2023-03-30 14:29:41', 1, 0),
(77, 'products', 'Uploads/products/other_image/1688703147774/ZDvSGZ4NBNthX27O3RHbho5sMCfK9gWTG5RW8ldK.webp', 3, 2, '2023-03-30 14:29:41', '2023-03-30 14:29:41', 1, 0),
(78, 'products', 'Uploads/products/other_image/1991756126139/E4Qm7BrG4sVdMBahYPweDL53NVqJtm52YnX0RJ38.webp', 3, 2, '2023-03-30 14:29:41', '2023-03-30 14:29:41', 1, 0),
(79, 'products', 'Uploads/products/other_image/371288103964/qgV1VVCj8YxN6iGNHnTbfrfXeAJDbwXc0U3FSP3I.webp', 3, 2, '2023-03-30 14:29:41', '2023-03-30 14:29:41', 1, 0),
(80, 'products', 'Uploads/products/other_image/226574654511/3XF1ru55HSbfaCRXAJEuP9Wc6ZOWsrRMaVfWySQd.webp', 3, 2, '2023-03-30 14:29:41', '2023-03-30 14:29:41', 1, 0),
(81, 'products', 'Uploads/products/other_image/523373434701/dVCc1CWiChW3vtqaI16DLvwPYWz0xg8sZyiqVMN9.webp', 3, 2, '2023-03-30 14:29:41', '2023-03-30 14:29:41', 1, 0),
(82, 'products', 'Uploads/products/other_image/941922800978/46dkioSP6moU3knhkZJlzVhK90s8B2I8u4dcS9h5.webp', 3, 2, '2023-03-30 14:29:41', '2023-03-30 14:29:41', 1, 0),
(83, 'products', 'Uploads/products/other_image/1685602893157/FjAS051EOstDBjwgLhXdhB5VbDKK0op3BdWwEVVW.webp', 3, 2, '2023-03-30 14:29:41', '2023-03-30 14:29:41', 1, 0),
(84, 'products', 'Uploads/products/other_image/1738650895793/DLgx1WBlZC0OyUMKHFJebSzHf7e7E7xYiAGTpC9a.jpg', 4, 2, '2023-03-30 16:50:14', '2023-03-30 16:50:14', 1, 0),
(85, 'products', 'Uploads/products/other_image/1795958888134/Xp46jK8W49kTdcCHJ8bFCV3JmbYOJTsERD3JdjJE.jpg', 5, 2, '2023-03-30 19:14:01', '2023-03-30 19:14:01', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `title`, `slug`, `category_id`, `is_active`, `is_deleted`, `created_at`, `updated_at`) VALUES
(2, 'Wallets', 'wallets', 1, 1, 0, '2022-05-02 05:14:53', '2022-05-13 10:11:03'),
(3, 'Table Runners', 'table-runners', 2, 1, 0, '2022-05-02 05:15:23', '2022-05-13 10:11:16'),
(5, 'Business', 'business', 1, 1, 0, '2022-05-06 19:32:58', '2022-05-23 20:16:47'),
(6, 'Handbags', 'handbags', 1, 1, 0, '2022-05-06 19:33:06', '2022-05-13 10:11:49'),
(7, 'Backpacks', 'backpacks', 1, 1, 0, '2022-05-06 19:33:27', '2022-05-13 10:12:08'),
(8, 'Accessories', 'accessories', 1, 1, 0, '2022-05-06 19:33:42', '2022-05-13 10:12:18'),
(12, 'Potstands', 'potstands', 2, 1, 0, '2022-05-06 19:34:35', '2022-05-13 10:13:26'),
(13, 'Coasters', 'coasters', 2, 1, 0, '2022-05-06 19:34:45', '2022-05-13 10:13:43'),
(14, 'Placemats', 'placemats', 2, 1, 0, '2022-05-06 19:34:53', '2022-05-13 15:14:34'),
(15, 'Oven Mitts', 'oven-mitts', 2, 1, 0, '2022-05-06 19:35:03', '2022-05-23 06:45:46'),
(16, 'Silk Proteas', 'silkproteas', 3, 1, 0, '2022-05-06 19:35:16', '2022-05-13 15:15:00'),
(17, 'Scatter cushion covers', 'scatter-cushion-covers', 3, 1, 0, '2022-05-06 19:35:30', '2022-05-13 15:15:12'),
(18, 'Kitchen Mats', 'kitchen-mats', 3, 1, 0, '2022-05-06 19:35:41', '2022-05-13 15:15:32'),
(20, 'Pumps', 'pumps - women', 5, 1, 0, '2022-05-06 19:36:24', '2022-05-22 03:55:20'),
(21, 'Vellies (Veldskoen)', 'vellies-veldskoen', 4, 1, 0, '2022-05-06 19:36:37', '2022-05-22 16:14:31'),
(22, 'Boots', 'boots', 4, 1, 0, '2022-05-06 19:36:47', '2022-05-13 15:16:11'),
(23, 'Sneakers', 'sneakers', 4, 1, 0, '2022-05-06 19:36:57', '2022-05-13 15:16:18'),
(32, 'Bags', 'bags', 1, 1, 0, '2022-05-19 19:35:25', '2022-05-19 19:52:43'),
(33, 'Vellies (Veldskoen) - Ladies', 'vellies-veldskoen-ladies', 5, 1, 0, '2022-05-22 16:14:01', '2022-05-22 16:14:01'),
(34, 'Boots', 'boots - ladies', 5, 1, 0, '2022-05-22 16:15:19', '2022-05-22 16:15:19'),
(35, 'Sneakers', 'sneakers - ladies', 5, 1, 0, '2022-05-22 16:16:02', '2022-05-22 16:16:02'),
(36, 'Gift Card - $10', 'gift-card-10', 7, 1, 0, '2022-06-07 13:30:11', '2022-06-07 13:31:13'),
(37, 'Gift Card - $20', 'gift-card-20', 7, 1, 0, '2022-06-07 13:31:30', '2022-06-07 13:31:30'),
(38, 'Gift Cards - $50', 'gift-cards-50', 7, 1, 0, '2022-06-07 13:32:05', '2022-06-07 13:32:05');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `member_since` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `img_path` text DEFAULT NULL,
  `description` text CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `user_id`, `member_since`, `name`, `designation`, `img_path`, `description`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
(17, 0, NULL, 'FERGUS', 'Product Manager @yelp', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.survived not only five centuries', '2022-05-06 17:48:50', '2022-06-03 19:43:19', 0, 0),
(18, 0, NULL, 'Devel Dev', 'Sr. Manager', NULL, 'adsasdasdasd adsasdasdasd adsasdasdasd adsasdasdasd adsasdasdasd adsasdasdasd adsasdasdasd adsasdasdasd adsasdasdasd', '2022-06-03 03:02:36', '2022-06-03 19:43:23', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `name`, `slug`, `category_id`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
(1, 'Galvin Ryan', 'galvin-ryan', 4, '2023-04-10 19:15:36', '2023-04-10 19:15:36', 1, 0),
(2, 'Kasimir Evans', 'kasimir-evans', 1, '2023-04-10 19:16:57', '2023-04-10 19:19:53', 1, 0),
(3, 'Britanney Gilbert', 'britanney-gilbert', 2, '2023-04-10 19:18:42', '2023-04-10 19:18:42', 1, 0),
(4, 'Bruno Sampson', 'bruno-sampson', 1, '2023-04-11 16:20:57', '2023-04-11 16:20:57', 1, 0),
(5, 'Octavius Dalton', 'octavius-dalton', 1, '2023-04-11 16:21:09', '2023-04-11 16:21:09', 1, 0),
(6, 'Merritt Stephenson', 'merritt-stephenson', 4, '2023-04-11 16:21:25', '2023-04-11 16:21:25', 1, 0),
(7, 'Karly Stanton', 'karly-stanton', 4, '2023-04-11 16:21:39', '2023-04-11 16:21:39', 1, 0),
(8, 'Bernard Lloyd', 'bernard-lloyd', 2, '2023-04-11 16:21:48', '2023-04-11 16:21:48', 1, 0),
(9, 'Piper Wilder', 'piper-wilder', 2, '2023-04-11 16:21:58', '2023-04-11 16:21:58', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img_path` text CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `fullname`, `fname`, `lname`, `dob`, `age`, `img_path`, `phone`, `address`, `city`, `country`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_active`, `is_deleted`) VALUES
(1, 1, 'John Remy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'john@gmail.com', NULL, '$2y$10$Oh279jOAPStQWkgVG0KX1ewCVDh8wGLbITD2RZPCDRC4yNPZW3oXG', NULL, '2023-03-29 14:51:16', '2023-03-29 14:51:16', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `img_path` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature`
--
ALTER TABLE `feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagetable`
--
ALTER TABLE `imagetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merchandise`
--
ALTER TABLE `merchandise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_flag`
--
ALTER TABLE `m_flag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_inquiry`
--
ALTER TABLE `order_inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partner`
--
ALTER TABLE `partner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_logs`
--
ALTER TABLE `payment_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_image`
--
ALTER TABLE `shop_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1978;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feature`
--
ALTER TABLE `feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `imagetable`
--
ALTER TABLE `imagetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `merchandise`
--
ALTER TABLE `merchandise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `m_flag`
--
ALTER TABLE `m_flag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `order_inquiry`
--
ALTER TABLE `order_inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `partner`
--
ALTER TABLE `partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_logs`
--
ALTER TABLE `payment_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shop_image`
--
ALTER TABLE `shop_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
