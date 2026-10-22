-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 08, 2025 at 02:59 AM
-- Server version: 8.0.39
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prop`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `name`, `designation`, `phone`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'John Smith', 'Senior Property Manager', '(555) 123-4567', NULL, 1, '2025-09-22 07:12:52', '2025-09-22 07:12:52'),
(2, 'Sarah Johnson', 'Property Consultant', '(555) 234-5678', NULL, 1, '2025-09-22 07:12:52', '2025-09-22 07:12:52'),
(3, 'Michael Brown', 'Leasing Specialist', '(555) 345-6789', NULL, 1, '2025-09-22 07:12:52', '2025-09-22 07:12:52'),
(4, 'Emily Davis', 'Property Analyst', '(555) 456-7890', NULL, 1, '2025-09-22 07:12:52', '2025-09-22 07:12:52'),
(5, 'David Wilson', 'Maintenance Coordinator', '(555) 567-8901', NULL, 1, '2025-09-22 07:12:52', '2025-09-22 07:12:52'),
(6, 'Lisa Anderson', 'Client Relations Manager', '(555) 678-9012', NULL, 1, '2025-09-22 07:12:52', '2025-09-22 07:12:52'),
(7, 'Robert Taylor', 'Property Inspector', '(555) 789-0123', NULL, 0, '2025-09-22 07:12:52', '2025-09-22 07:12:52'),
(8, 'Jennifer Martinez', 'Marketing Coordinator', '(555) 890-1234', NULL, 1, '2025-09-22 07:12:52', '2025-09-22 07:12:52'),
(9, 'Default Agent', 'Property Consultant', '9999999999', NULL, 1, '2025-09-30 12:54:57', '2025-09-30 12:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `name`, `icon`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Wifi', 'bi bi-wifi', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(2, 'Gym', 'bi bi-activity', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(3, 'Air Conditioner', 'bi bi-thermometer', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(4, 'Pool', 'bi bi-water', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(5, 'Sports Arena', 'bi bi-star', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(6, 'Car parking', 'bi bi-car-front', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(7, 'Security services', 'bi bi-shield-check', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(8, 'Water supply', 'bi bi-droplet', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(9, 'Elevators', 'bi bi-arrow-up-circle', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(10, 'Power backup', 'bi bi-lightning', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(11, 'Walking/Jogging track', 'bi bi-person-walking', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(12, 'Play area', 'bi bi-controller', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(13, 'Club house', 'bi bi-house', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(14, 'Swimming pool', 'bi bi-water', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(15, 'Rooftop garden', 'bi bi-building', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(16, 'Sky lounge', 'bi bi-cup-hot', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(17, 'Spa and salon', 'bi bi-heart', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(18, 'Concierge services', 'bi bi-person-badge', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(19, 'Restaurants', 'bi bi-cup-hot', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(20, 'Party hall', 'bi bi-music-note', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(21, 'Cinema hall', 'bi bi-film', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(22, 'Squash Court', 'bi bi-trophy', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(23, 'Spa', 'bi bi-heart', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(24, 'Library', 'bi bi-book', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(25, 'Lawn Tennis Court', 'bi bi-trophy', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(26, 'Badminton Court', 'bi bi-trophy', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(27, 'Indoor Games', 'bi bi-controller', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(28, 'CCTV Camera Security', 'bi bi-shield-check', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(29, 'Landscaped Greens', 'bi bi-star', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(30, 'Fitness Station', 'bi bi-activity', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(31, 'Multi-tier Security', 'bi bi-shield-check', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(32, 'Cycling & Jogging Track', 'bi bi-person-running', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(33, 'Golf Course', 'bi bi-trophy', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(34, 'Landscaped Garden', 'bi bi-flower1', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(35, 'Multi Cuisine Bar & Restaurant', 'bi bi-cup-hot', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(36, 'Temperature Controlled Pool', 'bi bi-water', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(37, 'Global Standard Fitness Centre', 'bi bi-activity', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(38, 'Foot Friendly Running Track', 'bi bi-star', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(39, 'World Class Gymnasium', 'bi bi-activity', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(40, 'Kids Paradise Fun Club', 'bi bi-star', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(41, 'Super Stylish Kitchen', 'bi bi-house-gear', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(42, 'Smart Lock', 'bi bi-cpu', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(43, 'Smart Camera', 'bi bi-camera', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(44, 'Smart Light Panel', 'bi bi-cpu', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(45, 'Mood Light Panel', 'bi bi-lightbulb', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(46, 'Intercom', 'bi bi-telephone', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(47, '5 Level Smart Security System', 'bi bi-shield-check', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(48, 'Helipad on Rooftop', 'bi bi-building', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(49, 'Amphitheater', 'bi bi-mic', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(50, 'Cafeteria', 'bi bi-cup-hot', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(51, 'Rain Water Harvesting', 'bi bi-cloud-rain', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(52, 'Sauna', 'bi bi-thermometer', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(53, 'Fire Fighting Systems', 'bi bi-fire', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(54, 'RO System', 'bi bi-star', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(55, 'Aerobics Centre', 'bi bi-activity', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(56, 'Card Room', 'bi bi-suit-spade', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(57, 'Billiards', 'bi bi-circle', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(58, 'Banquet Hall', 'bi bi-calendar-event', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(59, 'Sun Deck', 'bi bi-sun', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(60, 'Multipurpose Court', 'bi bi-trophy', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(61, 'Party Lawn', 'bi bi-flower1', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(62, ' Community Hall', 'bi bi-people', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(63, 'Table Tennis', 'bi bi-trophy', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(64, 'Vastu Compliant', 'bi bi-compass', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(65, ' Entrance Lobby', 'bi bi-door-open', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(66, 'Multipurpose Hall', 'bi bi-grid-3x3', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(67, 'Yoga/Meditation Area', 'bi bi-heart', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(68, '24/7 Power Backup', 'bi bi-lightning', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(69, 'Children\'s Play Area', 'bi bi-controller', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(70, 'Mini theatre', 'bi bi-film', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(71, 'Card room', 'bi bi-suit-spade', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(72, 'Basket ball court', 'bi bi-trophy', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(73, 'Steam and sauna', 'bi bi-cloud', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(74, 'Massage rooms', 'bi bi-hand-index', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(75, 'Sky Pond on Rooftop', 'bi bi-building', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(76, 'Servant room', 'bi bi-person', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(77, 'Laundry room', 'bi bi-basket', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(78, 'Jacuzzi', 'bi bi-water', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(79, 'Garden area', 'bi bi-flower1', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(80, 'Power room', 'bi bi-star', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(81, 'Italian Kitchen', 'bi bi-house-gear', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(82, 'Lakeside', 'bi bi-water', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(83, 'Boardwalk', 'bi bi-walk', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(84, 'Toddlers\' Pool', 'bi bi-water', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(85, 'Heated Pool', 'bi bi-water', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(86, 'Skywalk', 'bi bi-walk', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(87, 'Art & Crafts Zone', 'bi bi-palette', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(88, 'Infinity Swimming Pool', 'bi bi-water', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(89, 'Hammock Area', 'bi bi-moon', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(90, 'Outdoor Table Tennis', 'bi bi-trophy', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(91, 'Banquet Area', 'bi bi-calendar-event', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(92, 'Sunset View Deck', 'bi bi-sun', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(93, 'Acupressure Walk', 'bi bi-heart', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(94, 'Outdoor Gym', 'bi bi-activity', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(95, 'Grand Entry/Exit', 'bi bi-star', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18'),
(96, 'World Class Concierge Services', 'bi bi-person-badge', 90, 1, '2025-09-30 13:07:18', '2025-09-30 13:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `bedroom_options`
--

CREATE TABLE `bedroom_options` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bedroom_options`
--

INSERT INTO `bedroom_options` (`id`, `name`, `value`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '1 BHK', '1', 1, 1, '2025-10-02 20:47:42', '2025-10-04 12:34:55'),
(2, '2 BHK', '2', 2, 1, '2025-10-02 20:47:42', '2025-10-02 20:47:42'),
(3, '3 BHK', '3', 3, 1, '2025-10-02 20:47:42', '2025-10-02 20:47:42'),
(4, '4 BHK', '4', 4, 1, '2025-10-02 20:47:42', '2025-10-02 20:47:42'),
(5, '5 BHK', '5', 5, 1, '2025-10-02 20:47:42', '2025-10-02 20:47:42'),
(6, '5.5 BHK', '5.5', 6, 1, '2025-10-02 20:47:42', '2025-10-02 20:47:42'),
(7, '10 BHK', '10', 7, 1, '2025-10-02 20:47:42', '2025-10-02 20:47:42'),
(8, '2, 3 BHK', '2,3', 8, 1, '2025-10-02 20:47:42', '2025-10-02 20:47:42'),
(9, '2, 3, 4 BHK', '2,3,4', 9, 1, '2025-10-02 20:47:42', '2025-10-02 20:47:42'),
(10, '3, 4 BHK', '3,4', 10, 1, '2025-10-02 20:47:42', '2025-10-02 20:47:42'),
(11, '3, 4, 5 BHK', '3,4,5', 11, 1, '2025-10-02 20:47:42', '2025-10-02 20:47:42'),
(12, '4, 5 BHK', '4,5', 12, 1, '2025-10-02 20:47:42', '2025-10-02 20:47:42'),
(13, 'Studios & 1 BHK', 'studio,1', 13, 1, '2025-10-02 20:47:42', '2025-10-02 20:47:42');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `description`, `meta_title`, `meta_description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Technology', 'technology', '<p>Latest trends, innovations, and insights in the world of technology. From artificial intelligence to web development, we cover it all.</p>', 'Technology Blog - Latest Tech News & Insights', 'Stay updated with the latest technology trends, innovations, and insights. Expert analysis and practical guides for tech enthusiasts.', 1, '2025-09-22 22:06:04', '2025-09-22 22:06:04'),
(2, 'Business', 'business', '<p>Business strategies, entrepreneurship, and industry insights. Learn from successful business leaders and stay ahead in the competitive market.</p>', 'Business Blog - Strategies & Entrepreneurship', 'Expert business advice, entrepreneurship tips, and industry insights. Learn from successful leaders and grow your business.', 1, '2025-09-22 22:06:04', '2025-09-22 22:06:04'),
(3, 'Marketing', 'marketing', '<p>Digital marketing strategies, SEO tips, social media marketing, and content creation. Boost your online presence and reach your audience effectively.</p>', 'Marketing Blog - Digital Marketing & SEO Tips', 'Digital marketing strategies, SEO tips, and social media marketing insights. Boost your online presence and grow your audience.', 1, '2025-09-22 22:06:04', '2025-09-22 22:06:04'),
(4, 'Web Development', 'web-development', '<p>Web development tutorials, coding tips, and best practices. From frontend to backend, learn the skills you need to build amazing websites.</p>', 'Web Development Blog - Coding Tutorials & Tips', 'Web development tutorials, coding tips, and best practices. Learn frontend and backend development skills.', 1, '2025-09-22 22:06:04', '2025-09-22 22:06:04'),
(5, 'Design', 'design', '<p>UI/UX design principles, graphic design tips, and creative inspiration. Learn how to create beautiful and functional designs.</p>', 'Design Blog - UI/UX & Graphic Design Tips', 'UI/UX design principles, graphic design tips, and creative inspiration. Learn to create beautiful and functional designs.', 1, '2025-09-22 22:06:04', '2025-09-22 22:06:04'),
(6, 'Lifestyle', 'lifestyle', '<p>Lifestyle tips, productivity hacks, and personal development. Improve your daily life with practical advice and inspiring stories.</p>', 'Lifestyle Blog - Tips for Better Living', 'Lifestyle tips, productivity hacks, and personal development advice. Improve your daily life with practical insights.', 1, '2025-09-22 22:06:04', '2025-09-22 22:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_category_id` bigint UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `slug`, `blog_category_id`, `description`, `meta_title`, `meta_description`, `is_active`, `is_featured`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'The Future of Artificial Intelligence in 2024', 'future-artificial-intelligence-2024', 1, '<h2>Introduction</h2><p>Artificial Intelligence continues to evolve at an unprecedented pace, reshaping industries and transforming how we work and live. As we move through 2024, several key trends are emerging that will define the future of AI.</p><h2>Key Trends</h2><p>From machine learning advancements to ethical AI considerations, the landscape is rapidly changing. Companies are investing heavily in AI research and development, leading to breakthrough innovations.</p><h2>Conclusion</h2><p>The future of AI holds immense promise, but it also requires careful consideration of ethical implications and responsible development practices.</p>', 'Future of AI 2024 - Latest Trends & Predictions', 'Explore the latest trends and predictions in artificial intelligence for 2024. Learn about emerging technologies and their impact on various industries.', 1, 1, '2025-09-20 22:06:08', '2025-09-22 22:06:08', '2025-09-22 22:06:08'),
(2, '10 Essential Business Strategies for Startups', 'essential-business-strategies-startups', 2, '<h2>Starting Your Journey</h2><p>Starting a business is an exciting but challenging endeavor. Having the right strategies in place can make the difference between success and failure.</p><h2>Key Strategies</h2><p>From market research to financial planning, these essential strategies will help you build a solid foundation for your startup.</p><h2>Implementation</h2><p>Success requires careful planning, execution, and continuous adaptation to market conditions.</p>', '10 Essential Startup Business Strategies 2024', 'Discover 10 essential business strategies every startup should implement. Learn from successful entrepreneurs and avoid common pitfalls.', 1, 0, '2025-09-17 22:06:08', '2025-09-22 22:06:08', '2025-09-22 22:06:08'),
(3, 'Complete Guide to Digital Marketing in 2024', 'complete-guide-digital-marketing-2024', 3, '<h2>Digital Marketing Landscape</h2><p>The digital marketing landscape is constantly evolving, with new platforms and strategies emerging regularly. Staying updated is crucial for success.</p><h2>Core Strategies</h2><p>From SEO to social media marketing, this comprehensive guide covers all aspects of digital marketing that matter in 2024.</p><h2>Best Practices</h2><p>Learn the best practices that top marketers use to achieve outstanding results in their campaigns.</p>', 'Digital Marketing Guide 2024 - Complete Strategy', 'Complete guide to digital marketing in 2024. Learn SEO, social media, content marketing, and other essential strategies.', 1, 1, '2025-09-15 22:06:08', '2025-09-22 22:06:08', '2025-09-22 22:06:08'),
(4, 'Modern Web Development: React vs Vue vs Angular', 'modern-web-development-react-vue-angular', 4, '<h2>Framework Comparison</h2><p>Choosing the right JavaScript framework is crucial for modern web development. Each framework has its strengths and use cases.</p><h2>React</h2><p>React, developed by Facebook, is known for its component-based architecture and large ecosystem.</p><h2>Vue</h2><p>Vue.js offers a gentle learning curve and excellent documentation, making it popular among developers.</p><h2>Angular</h2><p>Angular, by Google, provides a complete framework with built-in tools and features for enterprise applications.</p>', 'React vs Vue vs Angular - Web Development 2024', 'Compare React, Vue, and Angular for modern web development. Learn which framework to choose for your next project.', 1, 0, '2025-09-12 22:06:08', '2025-09-22 22:06:08', '2025-09-22 22:06:08'),
(5, 'UI/UX Design Principles Every Designer Should Know', 'ui-ux-design-principles-every-designer', 5, '<h2>Design Fundamentals</h2><p>Great UI/UX design is built on solid principles that ensure user satisfaction and business success.</p><h2>User-Centered Design</h2><p>Always prioritize the user\'s needs and create intuitive experiences that solve real problems.</p><h2>Visual Hierarchy</h2><p>Use typography, color, and spacing to guide users through your interface effectively.</p><h2>Consistency</h2><p>Maintain consistent design patterns throughout your application to build user trust and familiarity.</p>', 'UI/UX Design Principles - Essential Guide 2024', 'Learn essential UI/UX design principles every designer should know. Improve user experience and create better digital products.', 1, 0, '2025-09-10 22:06:08', '2025-09-22 22:06:08', '2025-09-22 22:06:08'),
(6, 'Productivity Hacks for Remote Workers', 'productivity-hacks-remote-workers', 6, '<h2>Remote Work Challenges</h2><p>Working remotely comes with unique challenges that can impact productivity and work-life balance.</p><h2>Time Management</h2><p>Effective time management is crucial for remote workers. Learn techniques to maximize your productivity.</p><h2>Workspace Setup</h2><p>Create a dedicated workspace that promotes focus and minimizes distractions.</p><h2>Communication</h2><p>Maintain clear communication with your team and establish boundaries between work and personal time.</p>', 'Remote Work Productivity Hacks - Work From Home Tips', 'Discover productivity hacks for remote workers. Learn time management, workspace setup, and communication strategies.', 1, 0, '2025-09-07 22:06:08', '2025-09-22 22:06:08', '2025-09-22 22:06:08'),
(7, 'The Rise of No-Code Development Platforms', 'rise-no-code-development-platforms', 1, '<h2>No-Code Revolution</h2><p>No-code platforms are democratizing software development, allowing non-technical users to build applications.</p><h2>Popular Platforms</h2><p>From Webflow to Bubble, explore the leading no-code platforms and their capabilities.</p><h2>Benefits and Limitations</h2><p>Understand when to use no-code solutions and when traditional development might be necessary.</p>', 'No-Code Development Platforms - Complete Guide 2024', 'Explore the rise of no-code development platforms. Learn about popular tools and when to use them for your projects.', 1, 0, '2025-09-04 22:06:08', '2025-09-22 22:06:08', '2025-09-22 22:06:08'),
(8, 'Building a Strong Brand Identity', 'building-strong-brand-identity', 2, '<h2>Brand Identity Essentials</h2><p>A strong brand identity is crucial for business success. It helps differentiate your company from competitors.</p><h2>Visual Elements</h2><p>Logo, color palette, typography, and imagery all contribute to your brand\'s visual identity.</p><h2>Brand Voice</h2><p>Develop a consistent brand voice that resonates with your target audience across all touchpoints.</p>', 'How to Build a Strong Brand Identity - Business Guide', 'Learn how to build a strong brand identity for your business. Essential tips for visual design and brand voice.', 1, 0, '2025-09-02 22:06:08', '2025-09-22 22:06:08', '2025-09-22 22:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('propnkey-cache-site_config_about_button_text', 's:9:\"View More\";', 1759604987),
('propnkey-cache-site_config_about_button_url', 's:9:\"/services\";', 1759604987),
('propnkey-cache-site_config_about_company_name', 's:8:\"PROP&KEY\";', 1759604987),
('propnkey-cache-site_config_about_description', 's:578:\"An international collective of best-in-class real estate aficionados who have come together to pioneer a shared vision of innovative excellence. Headquartered in Dubai, the most exciting luxury real estate market on the planet, it is our philosophy to offer world class service, advice and access to the finest homes. Hosting an award winning and highly experienced team drawn from leading international brands we offer a refreshing, dynamic and highly effective approach to the global citizen with regards to their real estate and related lifestyle and investment requirements.\";', 1759604987),
('propnkey-cache-site_config_about_image_1', 's:32:\"/frontassets/images/aabyshsj.png\";', 1759604987),
('propnkey-cache-site_config_about_image_2', 's:63:\"/frontassets/images/66d07f4b36221a2de3acc724_Rectangle_25_1.png\";', 1759604987),
('propnkey-cache-site_config_about_title', 's:5:\"About\";', 1759604987),
('propnkey-cache-site_config_company_name', 's:33:\"Luxury Residences Real Estate LLC\";', 1759607989),
('propnkey-cache-site_config_contact_email', 's:17:\"info@propnkey.com\";', 1759607989),
('propnkey-cache-site_config_contact_phone', 's:10:\"9717672008\";', 1759607989),
('propnkey-cache-site_config_copyright_text', 's:38:\"Copyright © All rights reserved. 2025\";', 1759607989),
('propnkey-cache-site_config_developers_title', 's:10:\"Developers\";', 1759604987),
('propnkey-cache-site_config_facebook_url', 's:1:\"#\";', 1759607989),
('propnkey-cache-site_config_header_tagline', 's:84:\"Elegant Luxury<br>properties in the heart <br><span class=\"of-dubai\">of Dubai</span>\";', 1759607989),
('propnkey-cache-site_config_hero_description', 's:132:\"A boutique prime real estate agency specialising in penthouse and mansion villa communities, with a penchant for branded residences.\";', 1759604987),
('propnkey-cache-site_config_hero_subtitle', 's:6:\"living\";', 1759604987),
('propnkey-cache-site_config_hero_title_line1', 's:25:\"The home of sophisticated\";', 1759604987),
('propnkey-cache-site_config_hero_title_line2', 's:13:\"and luxurious\";', 1759604987),
('propnkey-cache-site_config_hero_video_url', 's:120:\"https://cdn.prod.website-files.com/66a8e4e8bd6f32dc4680818f%2F66c6fc7bf2332cb0f1fe48cd_LR%20video%20coming-transcode.mp4\";', 1759604987),
('propnkey-cache-site_config_homepage_description', 's:132:\"A boutique prime real estate agency specialising in penthouse and mansion villa communities, with a penchant for branded residences.\";', 1759607989),
('propnkey-cache-site_config_homepage_keywords', 's:95:\"luxury real estate, penthouse, mansion, villa, branded residences, property, real estate agency\";', 1759607989),
('propnkey-cache-site_config_homepage_og_description', 's:132:\"A boutique prime real estate agency specialising in penthouse and mansion villa communities, with a penchant for branded residences.\";', 1759607989),
('propnkey-cache-site_config_homepage_og_image', 's:28:\"/frontassets/images/logo.svg\";', 1759607989),
('propnkey-cache-site_config_homepage_og_title', 's:29:\"Propnkey - Luxury Real Estate\";', 1759607989),
('propnkey-cache-site_config_homepage_title', 's:29:\"Propnkey - Luxury Real Estate\";', 1759607989),
('propnkey-cache-site_config_homepage_twitter_description', 's:132:\"A boutique prime real estate agency specialising in penthouse and mansion villa communities, with a penchant for branded residences.\";', 1759607989),
('propnkey-cache-site_config_homepage_twitter_image', 's:28:\"/frontassets/images/logo.svg\";', 1759607989),
('propnkey-cache-site_config_homepage_twitter_title', 's:29:\"Propnkey - Luxury Real Estate\";', 1759607989),
('propnkey-cache-site_config_instagram_url', 's:1:\"#\";', 1759607989),
('propnkey-cache-site_config_linkedin_url', 's:1:\"#\";', 1759607989),
('propnkey-cache-site_config_locations_title', 's:9:\"Locations\";', 1759604987),
('propnkey-cache-site_config_new_developments_description', 's:115:\"A curated selection of the finest new developments that perfectly embody world class design, lifestyle and quality.\";', 1759604987),
('propnkey-cache-site_config_new_developments_title', 's:16:\"New Developments\";', 1759604987),
('propnkey-cache-site_config_office_address', 's:74:\"Office 410, The Onyx Tower 2<br>The Greens, Dubai, UAE,<br>P.O. Box 451733\";', 1759607989),
('propnkey-cache-site_config_our_services_description', 's:262:\"Luxury Residences provide a singular destination for your real estate, financial, lifestyle, legal and immigration requirements. Our suite of specialist services will ensure all of your needs are dealt with effectively and discreetly to your utmost satisfaction.\";', 1759604987),
('propnkey-cache-site_config_our_services_title', 's:12:\"Our services\";', 1759604987),
('propnkey-cache-site_config_privacy_policy_url', 's:1:\"#\";', 1759607989),
('propnkey-cache-site_config_private_residences_title', 's:18:\"Private Residences\";', 1759604987),
('propnkey-cache-site_config_rera_number', 's:31:\"HRERA No- GGM/2037/1632/2023/50\";', 1759607989),
('propnkey-cache-site_config_search_icon_url', 's:95:\"https://cdn.prod.website-files.com/66a8e4e8bd6f32dc4680818f/66cc2cef03ccf308a49ba730_search.svg\";', 1759604987),
('propnkey-cache-site_config_search_placeholder', 's:20:\"3 BHK Apartments, Gurgaon\";', 1759604987),
('propnkey-cache-site_config_similar_properties_budget_range', 's:2:\"50\";', 1759603992),
('propnkey-cache-site_config_site_favicon', 's:28:\"/frontassets/img/favicon.png\";', 1759607989),
('propnkey-cache-site_config_site_logo', 's:28:\"/frontassets/images/logo.svg\";', 1759607989),
('propnkey-cache-site_config_site_name', 's:8:\"Propnkey\";', 1759607989),
('propnkey-cache-site_config_testimonials_title', 's:12:\"Testimonials\";', 1759604987),
('propnkey-cache-site_config_tiktok_url', 's:1:\"#\";', 1759607989),
('propnkey-cache-site_config_whatsapp_number', 's:12:\"919999964462\";', 1759606481),
('propnkey-cache-site_config_youtube_url', 's:1:\"#\";', 1759607989),
('propnkey-cache-site_configs_all', 'O:29:\"Illuminate\\Support\\Collection\":2:{s:8:\"\0*\0items\";a:69:{s:9:\"site_name\";s:8:\"Propnkey\";s:16:\"site_description\";s:101:\"A powerful property management platform that helps you manage your real estate portfolio efficiently.\";s:13:\"site_keywords\";s:43:\"property, management, real estate, platform\";s:9:\"site_logo\";s:28:\"/frontassets/images/logo.svg\";s:12:\"site_favicon\";s:28:\"/frontassets/img/favicon.png\";s:13:\"contact_email\";s:17:\"info@propnkey.com\";s:13:\"contact_phone\";s:10:\"9717672008\";s:15:\"contact_address\";s:53:\"123 Property Street\\nCity, State 12345\\nUnited States\";s:12:\"facebook_url\";s:1:\"#\";s:11:\"twitter_url\";s:28:\"https://twitter.com/propnkey\";s:12:\"linkedin_url\";s:1:\"#\";s:13:\"instagram_url\";s:1:\"#\";s:19:\"maintenance_message\";s:75:\"We are currently performing scheduled maintenance. Please check back later.\";s:15:\"welcome_message\";s:55:\"Welcome to Propnkey! Your property management solution.\";s:16:\"terms_of_service\";s:0:\"\";s:14:\"privacy_policy\";s:0:\"\";s:9:\"smtp_host\";s:14:\"smtp.gmail.com\";s:9:\"smtp_port\";s:3:\"587\";s:13:\"smtp_username\";s:20:\"noreply@propnkey.com\";s:15:\"smtp_encryption\";s:3:\"tls\";s:8:\"currency\";s:3:\"USD\";s:8:\"timezone\";s:16:\"America/New_York\";s:11:\"date_format\";s:5:\"Y-m-d\";s:11:\"time_format\";s:5:\"H:i:s\";s:14:\"analytics_code\";s:69:\"<!-- Google Analytics Code -->\\n<!-- Add your analytics code here -->\";s:10:\"custom_css\";s:58:\"/* Custom CSS styles */\\n/* Add your custom styles here */\";s:9:\"custom_js\";s:53:\"// Custom JavaScript\\n// Add your custom scripts here\";s:11:\"user_manual\";s:0:\"\";s:17:\"api_documentation\";s:0:\"\";s:14:\"header_tagline\";s:84:\"Elegant Luxury<br>properties in the heart <br><span class=\"of-dubai\">of Dubai</span>\";s:12:\"company_name\";s:33:\"Luxury Residences Real Estate LLC\";s:14:\"office_address\";s:74:\"Office 410, The Onyx Tower 2<br>The Greens, Dubai, UAE,<br>P.O. Box 451733\";s:14:\"copyright_text\";s:38:\"Copyright © All rights reserved. 2025\";s:11:\"youtube_url\";s:1:\"#\";s:10:\"tiktok_url\";s:1:\"#\";s:18:\"privacy_policy_url\";s:1:\"#\";s:11:\"rera_number\";s:31:\"HRERA No- GGM/2037/1632/2023/50\";s:14:\"hero_video_url\";s:120:\"https://cdn.prod.website-files.com/66a8e4e8bd6f32dc4680818f%2F66c6fc7bf2332cb0f1fe48cd_LR%20video%20coming-transcode.mp4\";s:16:\"hero_title_line1\";s:25:\"The home of sophisticated\";s:16:\"hero_title_line2\";s:13:\"and luxurious\";s:13:\"hero_subtitle\";s:6:\"living\";s:16:\"hero_description\";s:132:\"A boutique prime real estate agency specialising in penthouse and mansion villa communities, with a penchant for branded residences.\";s:18:\"search_placeholder\";s:20:\"3 BHK Apartments, Gurgaon\";s:15:\"search_icon_url\";s:95:\"https://cdn.prod.website-files.com/66a8e4e8bd6f32dc4680818f/66cc2cef03ccf308a49ba730_search.svg\";s:24:\"private_residences_title\";s:18:\"Private Residences\";s:22:\"new_developments_title\";s:16:\"New Developments\";s:28:\"new_developments_description\";s:115:\"A curated selection of the finest new developments that perfectly embody world class design, lifestyle and quality.\";s:15:\"locations_title\";s:9:\"Locations\";s:18:\"our_services_title\";s:12:\"Our services\";s:24:\"our_services_description\";s:262:\"Luxury Residences provide a singular destination for your real estate, financial, lifestyle, legal and immigration requirements. Our suite of specialist services will ensure all of your needs are dealt with effectively and discreetly to your utmost satisfaction.\";s:16:\"developers_title\";s:10:\"Developers\";s:18:\"testimonials_title\";s:12:\"Testimonials\";s:11:\"about_title\";s:5:\"About\";s:18:\"about_company_name\";s:8:\"PROP&KEY\";s:13:\"about_image_1\";s:32:\"/frontassets/images/aabyshsj.png\";s:13:\"about_image_2\";s:63:\"/frontassets/images/66d07f4b36221a2de3acc724_Rectangle_25_1.png\";s:17:\"about_description\";s:578:\"An international collective of best-in-class real estate aficionados who have come together to pioneer a shared vision of innovative excellence. Headquartered in Dubai, the most exciting luxury real estate market on the planet, it is our philosophy to offer world class service, advice and access to the finest homes. Hosting an award winning and highly experienced team drawn from leading international brands we offer a refreshing, dynamic and highly effective approach to the global citizen with regards to their real estate and related lifestyle and investment requirements.\";s:16:\"about_button_url\";s:9:\"/services\";s:17:\"about_button_text\";s:9:\"View More\";s:14:\"homepage_title\";s:29:\"Propnkey - Luxury Real Estate\";s:20:\"homepage_description\";s:132:\"A boutique prime real estate agency specialising in penthouse and mansion villa communities, with a penchant for branded residences.\";s:17:\"homepage_keywords\";s:95:\"luxury real estate, penthouse, mansion, villa, branded residences, property, real estate agency\";s:17:\"homepage_og_title\";s:29:\"Propnkey - Luxury Real Estate\";s:23:\"homepage_og_description\";s:132:\"A boutique prime real estate agency specialising in penthouse and mansion villa communities, with a penchant for branded residences.\";s:17:\"homepage_og_image\";s:28:\"/frontassets/images/logo.svg\";s:22:\"homepage_twitter_title\";s:29:\"Propnkey - Luxury Real Estate\";s:28:\"homepage_twitter_description\";s:132:\"A boutique prime real estate agency specialising in penthouse and mansion villa communities, with a penchant for branded residences.\";s:22:\"homepage_twitter_image\";s:28:\"/frontassets/images/logo.svg\";s:31:\"similar_properties_budget_range\";s:2:\"50\";}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1759607989);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `footer_items`
--

CREATE TABLE `footer_items` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sorting` int NOT NULL DEFAULT '0',
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `footer_items`
--

INSERT INTO `footer_items` (`id`, `title`, `slug`, `url`, `sorting`, `category_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Luxury Apartment in Whitefield', 'luxury-apartment-in-whitefield', 'http://127.0.0.1:8000/new-residential-townhouse', 1, 'Resources', 1, '2025-09-29 05:21:52', '2025-09-29 05:46:25'),
(2, 'dd1', 'd', 'https://aktourandtourisum.com', 2, 'Company', 1, '2025-09-29 05:45:35', '2025-09-29 05:46:17'),
(3, 'dd2', 'dd', 'https://aktourandtourisum.com', 3, 'Services', 1, '2025-09-29 05:46:02', '2025-09-29 05:46:02'),
(4, 'dd4', 'ddddd', 'https://aktourandtourisum.com', 4, 'Support', 1, '2025-09-29 05:46:47', '2025-09-29 05:46:47'),
(5, 'ddd5', 'dddf', 'https://aktourandtourisum.com', 5, 'Legal', 1, '2025-09-29 05:47:06', '2025-09-29 05:47:06'),
(6, 'dd6', 'dder', 'https://aktourandtourisum.com', 6, 'Properties', 1, '2025-09-29 05:57:55', '2025-09-29 05:57:55'),
(7, 'about', 'addff', 'http://127.0.0.1:8000/new-residential-townhouse', 7, 'Quick Links', 1, '2025-09-29 05:58:24', '2025-09-29 05:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `image_redirections`
--

CREATE TABLE `image_redirections` (
  `id` bigint UNSIGNED NOT NULL,
  `old_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_id` bigint UNSIGNED DEFAULT NULL,
  `image_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'project',
  `property_image_id` bigint UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `redirect_count` int NOT NULL DEFAULT '0',
  `last_redirected_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image_redirections`
--

INSERT INTO `image_redirections` (`id`, `old_path`, `new_path`, `original_filename`, `property_id`, `image_type`, `property_image_id`, `is_active`, `redirect_count`, `last_redirected_at`, `created_at`, `updated_at`) VALUES
(1, 'uploads/6f86a2bb5fb7bee51e223de2f26b5749.jpg', 'properties/13/project/31651f31-09f3-43d4-9918-c96712d894cc.jpg', '6f86a2bb5fb7bee51e223de2f26b5749.jpg', 13, 'project', 158, 1, 1, '2025-10-01 02:42:11', '2025-10-01 02:28:04', '2025-10-01 02:42:11'),
(2, 'uploads/d3b30bbfb4c25f0d25fd04c2b895f5d8.png', 'properties/13/project/db9cff26-ec1e-4eff-9166-becf4613eb59.png', 'd3b30bbfb4c25f0d25fd04c2b895f5d8.png', 13, 'project', 159, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(3, 'uploads/05d70bc53c3b14473ea3070a788e083d.png', 'properties/13/project/58905ac0-0b6e-4008-a3f0-0eeee987fe8e.png', '05d70bc53c3b14473ea3070a788e083d.png', 13, 'project', 160, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(4, 'uploads/02f2ba6cc260fa2e24d9d8229cbb80a2.png', 'properties/13/project/772a937d-fff7-4bd3-952e-20bbd67c4532.png', '02f2ba6cc260fa2e24d9d8229cbb80a2.png', 13, 'project', 161, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(5, 'uploads/e4212e2234674e76acdf4f9727c8ff22.png', 'properties/13/project/732aa0be-5c16-45ef-8e86-727da4003621.png', 'e4212e2234674e76acdf4f9727c8ff22.png', 13, 'project', 162, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(6, 'uploads/3da5243ac7240804183102281c300b6b.png', 'properties/13/project/019f9ee2-4b23-4ae0-ba6f-487d0d9f37cd.png', '3da5243ac7240804183102281c300b6b.png', 13, 'project', 163, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(7, 'uploads/9b1a985a04785499b4b064cf6f5f13ad.png', 'properties/13/project/18ceb4d5-f5f2-468f-bc05-2eb08581424f.png', '9b1a985a04785499b4b064cf6f5f13ad.png', 13, 'project', 164, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(8, 'uploads/e640131940054f2d840a02b3439a1bd8.png', 'properties/13/project/510050d7-ccb0-4a63-8a5c-b3a9b75c3b46.png', 'e640131940054f2d840a02b3439a1bd8.png', 13, 'project', 165, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(9, 'uploads/d8e17e1ea489dc037b7ced09f865e8fb.png', 'properties/14/project/c1c740c1-b475-4890-946c-0fe41c9ba7d4.png', 'd8e17e1ea489dc037b7ced09f865e8fb.png', 14, 'project', 166, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(10, 'uploads/ab4b64ae0dd91348ada3879b6330f920.jpg', 'properties/14/project/fecebe99-c828-40fe-a248-b3ee1704fee8.jpg', 'ab4b64ae0dd91348ada3879b6330f920.jpg', 14, 'project', 167, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(11, 'uploads/6b1a2a8e401f3b30b29975eb6b1ce4e7.jpg', 'properties/14/project/f65a7a42-9c19-4a27-8ad7-45a17121ddca.jpg', '6b1a2a8e401f3b30b29975eb6b1ce4e7.jpg', 14, 'project', 168, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(12, 'uploads/3139278b6fe4a9fe408484bb5fa5a354.jpg', 'properties/14/project/26ac146e-48b4-4c35-8989-0c9221eae602.jpg', '3139278b6fe4a9fe408484bb5fa5a354.jpg', 14, 'project', 169, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(13, 'uploads/a0e9fd3bc6b356f90f155c0f61b15502.jpg', 'properties/14/project/e20bd953-49f9-44ff-a281-7439be9dee0e.jpg', 'a0e9fd3bc6b356f90f155c0f61b15502.jpg', 14, 'project', 170, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(14, 'uploads/fed4a137d9361160ff8a4bb5f2500f07.jpg', 'properties/14/project/27bcb506-96ef-4a7b-a144-294793919632.jpg', 'fed4a137d9361160ff8a4bb5f2500f07.jpg', 14, 'project', 171, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(15, 'uploads/a9384f74ae0d343954b2d87d12f57a68.jpg', 'properties/14/project/0fd991a2-f737-4ccd-912a-21ff3245181b.jpg', 'a9384f74ae0d343954b2d87d12f57a68.jpg', 14, 'project', 172, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(16, 'uploads/d19b69c1c8ab231ab851d40fd550294a.jpg', 'properties/14/project/a091ce47-f1d7-4893-89cd-9ec1d68811ee.jpg', 'd19b69c1c8ab231ab851d40fd550294a.jpg', 14, 'project', 173, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(17, 'uploads/4843d94bd6a7f28aeef6908bfae1f318.jpg', 'properties/14/project/6b8475f5-9532-4b76-b6c6-cf99d9878a16.jpg', '4843d94bd6a7f28aeef6908bfae1f318.jpg', 14, 'project', 174, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(18, 'uploads/1a430ec05fe4d28421f541d721f893f7.jpg', 'properties/14/project/fe3604bf-e8e4-4eaf-92ca-24c48d933cf8.jpg', '1a430ec05fe4d28421f541d721f893f7.jpg', 14, 'project', 175, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(19, 'uploads/5a305bd8c63ddd8edf7d2a0a1fac35a6.jpg', 'properties/16/project/cdebb13a-fb04-4cbc-aa84-8e8b17f6c852.jpg', '5a305bd8c63ddd8edf7d2a0a1fac35a6.jpg', 16, 'project', 182, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(20, 'uploads/999429845446cee996a708aaaf58ed96.jpg', 'properties/16/project/6b60bca1-c9ee-4d12-b733-8a1bae886684.jpg', '999429845446cee996a708aaaf58ed96.jpg', 16, 'project', 183, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(21, 'uploads/ff29c817ccb424ca28be81f6dda5ba03.jpg', 'properties/16/project/68d63ab2-3648-4e62-8dd1-e07c86a424d1.jpg', 'ff29c817ccb424ca28be81f6dda5ba03.jpg', 16, 'project', 184, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(22, 'uploads/9f6c674aeaa2130efd2ef66c60934fb9.jpg', 'properties/16/project/b4db33cc-4ea3-4808-9a04-c9dd52438b53.jpg', '9f6c674aeaa2130efd2ef66c60934fb9.jpg', 16, 'project', 185, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(23, 'uploads/32fc58aeb73a4d5de4d7ab27f90e33af.jpg', 'properties/16/project/d9843a6c-4856-4265-a6a2-2107e215f52c.jpg', '32fc58aeb73a4d5de4d7ab27f90e33af.jpg', 16, 'project', 186, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(24, 'uploads/5fad9c4817bf59aa072f23f17726e68c.jpg', 'properties/16/project/a8d39d90-6182-4aed-9d08-49ee746e5af3.jpg', '5fad9c4817bf59aa072f23f17726e68c.jpg', 16, 'project', 187, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(25, 'uploads/c535bd42631ead69883f86a986d7f0c5.jpg', 'properties/16/project/1bf1b0f1-ac47-4bb0-84e6-dbcd65a90add.jpg', 'c535bd42631ead69883f86a986d7f0c5.jpg', 16, 'project', 188, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(26, 'uploads/bee5f1065091212dae263a38a8de823e.jpg', 'properties/16/project/5acf9aa8-b410-4ea4-beae-068bab63d9f0.jpg', 'bee5f1065091212dae263a38a8de823e.jpg', 16, 'project', 189, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(27, 'uploads/040d1301c78a2f793843c2c7a5907173.jpg', 'properties/17/project/bd416c9a-64c3-49fa-b103-695e77b42fb3.jpg', '040d1301c78a2f793843c2c7a5907173.jpg', 17, 'project', 190, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(28, 'uploads/48c3d76b21bccb99d6b3abfacaa97200.jpg', 'properties/17/project/31665205-bec8-40d5-ac02-d7b7e2ea013e.jpg', '48c3d76b21bccb99d6b3abfacaa97200.jpg', 17, 'project', 191, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(29, 'uploads/6c85c06090e77a3b4abb4a9f58679c9d.jpg', 'properties/17/project/1a375040-15bc-4745-b893-e1c3c8b45307.jpg', '6c85c06090e77a3b4abb4a9f58679c9d.jpg', 17, 'project', 192, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(30, 'uploads/e903c9a938ab06de1fe4c02729954a98.jpg', 'properties/17/project/9e14bbbb-a55e-41a1-82e8-a3185fbe62c6.jpg', 'e903c9a938ab06de1fe4c02729954a98.jpg', 17, 'project', 193, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(31, 'uploads/68bae8307057d2dbfaa1aa09e3ccac23.jpg', 'properties/17/project/3e7978db-9df4-4d22-b9e0-4fab7694b726.jpg', '68bae8307057d2dbfaa1aa09e3ccac23.jpg', 17, 'project', 194, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(32, 'uploads/855519751e277e086753a02b4e53e44c.jpg', 'properties/17/project/ddcb27c8-d568-45ec-8b3e-d8f2ae91d9d2.jpg', '855519751e277e086753a02b4e53e44c.jpg', 17, 'project', 195, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(33, 'uploads/e02dc4cde4142bad5b3a1de77ec852af.jpg', 'properties/17/project/07dc00de-88fd-438e-92a1-e98c11523caa.jpg', 'e02dc4cde4142bad5b3a1de77ec852af.jpg', 17, 'project', 196, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(34, 'uploads/4775bf810f1ebd999aa85ac3e3f58ccf.jpg', 'properties/17/project/61ece840-119a-4eb5-93a8-a709f4bf292b.jpg', '4775bf810f1ebd999aa85ac3e3f58ccf.jpg', 17, 'project', 197, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(35, 'uploads/63a46b23926056c8618b175741e944e9.jpg', 'properties/17/project/368b9b80-b73f-4587-978a-87ecb52dff31.jpg', '63a46b23926056c8618b175741e944e9.jpg', 17, 'project', 198, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(36, 'uploads/5277761f21070fb99ccad8c1967e9240.jpg', 'properties/17/project/73685543-c3d5-443c-83bc-0b533b273782.jpg', '5277761f21070fb99ccad8c1967e9240.jpg', 17, 'project', 199, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(37, 'uploads/5517ba713ed5c53ab7872dafd0b7e162.jpg', 'properties/17/project/cc5c52ce-1428-4d76-b3ba-071546661bfc.jpg', '5517ba713ed5c53ab7872dafd0b7e162.jpg', 17, 'project', 200, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(38, 'uploads/9bc83f7d8ea2c869bc6ac3933c9b6196.jpg', 'properties/20/project/07206112-7098-4a35-b8b4-08aa83cfa9e1.jpg', '9bc83f7d8ea2c869bc6ac3933c9b6196.jpg', 20, 'project', 221, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(39, 'uploads/72c0197444356acf067211f08db043dd.jpg', 'properties/20/project/e4ffadf2-7d53-44d1-97e7-ead594bd4eeb.jpg', '72c0197444356acf067211f08db043dd.jpg', 20, 'project', 222, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(40, 'uploads/fe92dcc13e50c08cdbc322e5de62d878.jpg', 'properties/21/project/5fcff2fc-ebdb-4685-8524-9f835416ba3f.jpg', 'fe92dcc13e50c08cdbc322e5de62d878.jpg', 21, 'project', 223, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(41, 'uploads/62f399ab3c307a4103f1b783782bcb0e.jpg', 'properties/21/project/abdf1f03-d433-4a58-957f-b408edf16e76.jpg', '62f399ab3c307a4103f1b783782bcb0e.jpg', 21, 'project', 224, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(42, 'uploads/bc7a79313446c7db8be4f79651fab394.jpg', 'properties/21/project/afdeeab4-a0a6-4d9a-8b20-7d5c1c3da06b.jpg', 'bc7a79313446c7db8be4f79651fab394.jpg', 21, 'project', 225, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(43, 'uploads/2e5cc780e08255bf6f8e8865a8dbbe68.jpg', 'properties/21/project/aad2df64-2650-4a12-8c50-d797227bce08.jpg', '2e5cc780e08255bf6f8e8865a8dbbe68.jpg', 21, 'project', 226, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(44, 'uploads/f8d1bc5629f0f152ac395c252e1d6f81.jpg', 'properties/21/project/18194ca0-14f0-489b-a699-08af95785ed7.jpg', 'f8d1bc5629f0f152ac395c252e1d6f81.jpg', 21, 'project', 227, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(45, 'uploads/6a154d9f7e826c853534b3d67c6260e1.jpg', 'properties/21/project/1323577c-2613-4f48-a374-fefb895f7234.jpg', '6a154d9f7e826c853534b3d67c6260e1.jpg', 21, 'project', 228, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(46, 'uploads/9d97b8290d679da4e170d70136365820.jpg', 'properties/21/project/e8bfcb2a-d64b-436c-8e35-4b888678986a.jpg', '9d97b8290d679da4e170d70136365820.jpg', 21, 'project', 229, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(47, 'uploads/e53fa33ed2726b2018302aa683f189be.jpg', 'properties/21/project/32a9844f-760b-4f57-8e0c-63b6aefa5a06.jpg', 'e53fa33ed2726b2018302aa683f189be.jpg', 21, 'project', 230, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(48, 'uploads/d057d816aab899ed903968f9d2b3fee8.jpg', 'properties/21/project/854c1273-88d2-4dd2-bfd3-4d8475bec769.jpg', 'd057d816aab899ed903968f9d2b3fee8.jpg', 21, 'project', 231, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(49, 'uploads/66fa83752ab9f0167079eaafc4114457.jpg', 'properties/21/project/c8e8e89d-a548-4144-8716-ed8caaea84f0.jpg', '66fa83752ab9f0167079eaafc4114457.jpg', 21, 'project', 232, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(50, 'uploads/6cf3253709c86f5d3d94c237123d46f6.jpg', 'properties/21/project/b451a6fe-6b4b-4eeb-8dcc-0e4764ec6c33.jpg', '6cf3253709c86f5d3d94c237123d46f6.jpg', 21, 'project', 233, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(51, 'uploads/e324421ec63df137031b25c955955505.jpg', 'properties/21/project/4de0ff1a-f9bb-4247-bd02-95c2d42837dd.jpg', 'e324421ec63df137031b25c955955505.jpg', 21, 'project', 234, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(52, 'uploads/7dcc3f5355abc2ac0e25409720a47cf2.jpg', 'properties/21/project/c3cd081d-0012-47ee-be95-9379d5966c25.jpg', '7dcc3f5355abc2ac0e25409720a47cf2.jpg', 21, 'project', 235, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(53, 'uploads/36a39cd51f6d09f762789fdcb3cd6877.jpg', 'properties/21/project/20765736-6870-4745-9502-f42c79fa2378.jpg', '36a39cd51f6d09f762789fdcb3cd6877.jpg', 21, 'project', 236, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(54, 'uploads/50f2b373de865e9d3fda2ea03c803c58.jpg', 'properties/21/project/49ab9e34-6693-4e04-a129-1cd249ff656e.jpg', '50f2b373de865e9d3fda2ea03c803c58.jpg', 21, 'project', 237, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(55, 'uploads/99fe168a8af1277102f223f7422ac738.jpg', 'properties/22/project/8a4a1dba-7437-462e-ba56-79ea7ef0d5af.jpg', '99fe168a8af1277102f223f7422ac738.jpg', 22, 'project', 238, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(56, 'uploads/f373fa89a64ffd0aed0b8fa218fe0be7.jpg', 'properties/22/project/51e80557-7f06-497c-9138-cd03797ef4e9.jpg', 'f373fa89a64ffd0aed0b8fa218fe0be7.jpg', 22, 'project', 239, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(57, 'uploads/dd05ffea8ec36d3d640946ef5ddd70fe.jpg', 'properties/22/project/5cd4342d-fcd5-4d84-84f6-c64b5fc3b769.jpg', 'dd05ffea8ec36d3d640946ef5ddd70fe.jpg', 22, 'project', 240, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(58, 'uploads/e7a786cb151675843f99208153089d1c.jpg', 'properties/22/project/2a4b7d28-b501-43c7-97f0-d7a20f99f150.jpg', 'e7a786cb151675843f99208153089d1c.jpg', 22, 'project', 241, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(59, 'uploads/8a6c149403eb8c2568f6d6936e45be23.jpg', 'properties/22/project/2f8b0b87-d45d-45b9-b680-406d5933eed9.jpg', '8a6c149403eb8c2568f6d6936e45be23.jpg', 22, 'project', 242, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(60, 'uploads/74a9535ec5b83cda0afd567934ab3c38.jpg', 'properties/22/project/83b8fe0e-ebe8-4fb3-a589-3fccada820c5.jpg', '74a9535ec5b83cda0afd567934ab3c38.jpg', 22, 'project', 243, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(61, 'uploads/16b13c3343543e7afdc240afcdd852b5.jpg', 'properties/22/project/547729a5-2f52-457b-89fd-1e168922b9b0.jpg', '16b13c3343543e7afdc240afcdd852b5.jpg', 22, 'project', 244, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(62, 'uploads/df41582a2d84879af3f0824f2b03c438.jpg', 'properties/22/project/6616df35-73a1-4b4e-acae-5b3aed5c75b8.jpg', 'df41582a2d84879af3f0824f2b03c438.jpg', 22, 'project', 245, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(63, 'uploads/e85e1a6414c27160e3c6aec3a1b62c3d.jpg', 'properties/22/project/66d8171d-db0c-4743-a7a7-c287fec9b4df.jpg', 'e85e1a6414c27160e3c6aec3a1b62c3d.jpg', 22, 'project', 246, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(64, 'uploads/d0a7de579200e871fde213f789e06705.jpg', 'properties/22/project/12493e72-2662-489a-ac67-7abf714df8dc.jpg', 'd0a7de579200e871fde213f789e06705.jpg', 22, 'project', 247, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(65, 'uploads/f50aa8b08707cc5d0a33cea0cf443df8.jpg', 'properties/22/project/28d7fc51-a21b-48b0-a0ef-26aff945800e.jpg', 'f50aa8b08707cc5d0a33cea0cf443df8.jpg', 22, 'project', 248, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(66, 'uploads/42bda82a3e2f0c38f92de23dc244e3df.jpg', 'properties/22/project/7812ba3b-c53b-4846-90f4-fa02ab165fd4.jpg', '42bda82a3e2f0c38f92de23dc244e3df.jpg', 22, 'project', 249, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(67, 'uploads/6708d6463cedf4184f76e0f8a0ce90ff.jpg', 'properties/23/project/f5e61fe3-1302-413e-b140-3f85e278713a.jpg', '6708d6463cedf4184f76e0f8a0ce90ff.jpg', 23, 'project', 250, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(68, 'uploads/e45f0fbc9d8f8111b8db589c067dc1bc.jpg', 'properties/23/project/c537e488-dd8e-4d40-8674-1e3a6af68cb6.jpg', 'e45f0fbc9d8f8111b8db589c067dc1bc.jpg', 23, 'project', 251, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(69, 'uploads/95e3e571820258b13fc5b3c19165ec72.jpg', 'properties/23/project/b632727c-833d-4b6d-b456-45ffebf43d9a.jpg', '95e3e571820258b13fc5b3c19165ec72.jpg', 23, 'project', 252, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(70, 'uploads/ef69ce10c5c5b75915c9801589f05795.jpg', 'properties/23/project/83e9b8bf-5e99-422e-9377-51a129fd7a9d.jpg', 'ef69ce10c5c5b75915c9801589f05795.jpg', 23, 'project', 253, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(71, 'uploads/60ce1d7bc45a8efce77bc2eaafb348a3.jpg', 'properties/23/project/1c3ed8b7-f3fc-4741-8a94-37dea9d6e56d.jpg', '60ce1d7bc45a8efce77bc2eaafb348a3.jpg', 23, 'project', 254, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(72, 'uploads/c1569952aefab961b1810d3a0f4c6685.jpg', 'properties/23/project/dfd8c7b9-afab-4a1c-9354-7f6f0bce0d96.jpg', 'c1569952aefab961b1810d3a0f4c6685.jpg', 23, 'project', 255, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(73, 'uploads/3cb3a9f6934a508be2e21f07646a013f.jpg', 'properties/23/project/b7238300-dda1-4c83-b9a2-2a9b3906b6c4.jpg', '3cb3a9f6934a508be2e21f07646a013f.jpg', 23, 'project', 256, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(74, 'uploads/9a6d26081b59df7099dc8aa867e46b4a.jpg', 'properties/23/project/9caa4ae8-a406-4fad-9918-3be098aade94.jpg', '9a6d26081b59df7099dc8aa867e46b4a.jpg', 23, 'project', 257, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(75, 'uploads/6300a0f81489f032dcdaa06d1b264510.jpg', 'properties/23/project/b99fdd51-215a-4566-a22b-ac1c0a8d2018.jpg', '6300a0f81489f032dcdaa06d1b264510.jpg', 23, 'project', 258, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(76, 'uploads/8facc43ef079a3232d94d44b5a96cebe.jpg', 'properties/23/project/c8a0108f-c908-4a9f-a301-1032047a237e.jpg', '8facc43ef079a3232d94d44b5a96cebe.jpg', 23, 'project', 259, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(77, 'uploads/c80f25fda9db3c59287ccac76d75009f.jpg', 'properties/24/project/20d25a51-4b56-4f8d-bc57-c70dbc213b08.jpg', 'c80f25fda9db3c59287ccac76d75009f.jpg', 24, 'project', 260, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(78, 'uploads/d11c90bfcd625cd02da086ac862aba47.jpg', 'properties/24/project/0b9805e5-b092-4f75-9868-54d1bfdb2c41.jpg', 'd11c90bfcd625cd02da086ac862aba47.jpg', 24, 'project', 261, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(79, 'uploads/922d3adeadcb845f7cc64528b8f02fc9.jpg', 'properties/24/project/c6b99da3-6fdc-4660-8ff9-cddaf87dac96.jpg', '922d3adeadcb845f7cc64528b8f02fc9.jpg', 24, 'project', 262, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(80, 'uploads/c45934ac0643d767313f6d8e1a68a97a.jpg', 'properties/24/project/ca0879dc-7e85-45e4-bbb0-828eeb5ff643.jpg', 'c45934ac0643d767313f6d8e1a68a97a.jpg', 24, 'project', 263, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(81, 'uploads/67ca9be1c887637781ac925ac0666fe2.jpg', 'properties/24/project/2d9462a3-8a6c-43bc-a395-767a71c95684.jpg', '67ca9be1c887637781ac925ac0666fe2.jpg', 24, 'project', 264, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(82, 'uploads/b43f3c3f4ed94237a3cb178171c89839.jpg', 'properties/24/project/c12b82c6-1bec-4d19-a9cd-87acf7be540a.jpg', 'b43f3c3f4ed94237a3cb178171c89839.jpg', 24, 'project', 265, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(83, 'uploads/66e9abf4c8dbbf5e09b830d33cde80b0.jpg', 'properties/24/project/24034c2e-1873-44c5-bf73-18446d07add8.jpg', '66e9abf4c8dbbf5e09b830d33cde80b0.jpg', 24, 'project', 266, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(84, 'uploads/3aad819d1c8bff9802da2104eb2c75b0.jpg', 'properties/24/project/368e8bb6-c114-4bf5-b347-d7bdbf8a6b97.jpg', '3aad819d1c8bff9802da2104eb2c75b0.jpg', 24, 'project', 267, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(85, 'uploads/1fb0be1f3fb458ca3e3c6ab5d93f2ac6.jpg', 'properties/25/project/f4308b84-7d18-4f32-99af-b5c856dd0d50.jpg', '1fb0be1f3fb458ca3e3c6ab5d93f2ac6.jpg', 25, 'project', 268, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(86, 'uploads/afb61f7bc8f894fd6eb790991f86409c.jpg', 'properties/25/project/48b5f00b-229d-411c-9ee1-a081d49b4c4e.jpg', 'afb61f7bc8f894fd6eb790991f86409c.jpg', 25, 'project', 269, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(87, 'uploads/13104fe107f483dfe129bc1d6fc1f90e.jpg', 'properties/25/project/c51a1b80-721a-4639-b8b2-6b7ff5e6b80c.jpg', '13104fe107f483dfe129bc1d6fc1f90e.jpg', 25, 'project', 270, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(88, 'uploads/2848c89e9acc11e8c8298f6a7417e20f.jpg', 'properties/25/project/540883ce-3e74-44f3-8d14-01429c9dfbdf.jpg', '2848c89e9acc11e8c8298f6a7417e20f.jpg', 25, 'project', 271, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(89, 'uploads/727b108cc6f596d51ff945e53cf74720.jpg', 'properties/25/project/b8e158f3-7e35-4212-856f-920950fc8723.jpg', '727b108cc6f596d51ff945e53cf74720.jpg', 25, 'project', 272, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(90, 'uploads/53bfbd42ca8510bd5600dd29ce7919a1.jpg', 'properties/25/project/189213fa-e4c3-4a63-b259-8338e963601f.jpg', '53bfbd42ca8510bd5600dd29ce7919a1.jpg', 25, 'project', 273, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(91, 'uploads/56061b521cfecd105bd4cf104a158f99.jpg', 'properties/25/project/2a6c427c-59a9-466d-a3e7-0ab3b3b08a85.jpg', '56061b521cfecd105bd4cf104a158f99.jpg', 25, 'project', 274, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(92, 'uploads/10a215f16d63186dac18e24e62e43cdf.jpg', 'properties/25/project/1ffedc56-13e4-4282-8146-6e2b13720ff8.jpg', '10a215f16d63186dac18e24e62e43cdf.jpg', 25, 'project', 275, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(93, 'uploads/3bb4b3a1a46fab7550c9e133b95f661c.jpg', 'properties/25/project/fa6bc062-0c5e-4c4d-879f-7bee042c13c7.jpg', '3bb4b3a1a46fab7550c9e133b95f661c.jpg', 25, 'project', 276, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(94, 'uploads/cc6c148bd3c0398ce23b38554dd48e00.jpg', 'properties/25/project/253cbf0b-c5c9-4167-b2ac-0a43e0346077.jpg', 'cc6c148bd3c0398ce23b38554dd48e00.jpg', 25, 'project', 277, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(95, 'uploads/d6f9dcd827c25c2ef79a127ee1c7284b.jpg', 'properties/25/project/f0a9a73a-623c-42af-82b2-83128824a42f.jpg', 'd6f9dcd827c25c2ef79a127ee1c7284b.jpg', 25, 'project', 278, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(96, 'uploads/a7c8610b4687b2f83e92deb96cd07af4.jpg', 'properties/25/project/d76860ef-3e78-451f-b9f8-2bd64dc2b57a.jpg', 'a7c8610b4687b2f83e92deb96cd07af4.jpg', 25, 'project', 279, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(97, 'uploads/0f8d58e42e9378b141102bb53b32241d.jpeg', 'properties/26/project/842a8b38-5b34-4029-ab2d-7c07af689ac7.jpeg', '0f8d58e42e9378b141102bb53b32241d.jpeg', 26, 'project', 280, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(98, 'uploads/557394e606c4dee519f5d0c4954f3057.jpeg', 'properties/26/project/9ade07b9-fd51-4d17-b7dd-1be2da2ebb33.jpeg', '557394e606c4dee519f5d0c4954f3057.jpeg', 26, 'project', 281, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(99, 'uploads/131d90e391886815b996de175d5d0da5.jpeg', 'properties/26/project/b0134858-c591-49d7-be6d-934910cb7389.jpeg', '131d90e391886815b996de175d5d0da5.jpeg', 26, 'project', 282, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(100, 'uploads/80f8c72eb429d5484537998e1416cfeb.jpeg', 'properties/26/project/5df68056-d213-4d32-854e-a807a53b2e1c.jpeg', '80f8c72eb429d5484537998e1416cfeb.jpeg', 26, 'project', 283, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(101, 'uploads/8c6453f48164fda779292dbdf6d475a3.jpeg', 'properties/26/project/69b8e4ee-37c6-45e3-b3a2-97aa6d11d7aa.jpeg', '8c6453f48164fda779292dbdf6d475a3.jpeg', 26, 'project', 284, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(102, 'uploads/557e4aef6fa4750c74c8a9aa28443af6.jpeg', 'properties/26/project/3adc3ce2-1b86-457f-85e2-2329e15a26b9.jpeg', '557e4aef6fa4750c74c8a9aa28443af6.jpeg', 26, 'project', 285, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(103, 'uploads/67b6cdb089ea6b8bd54658fc12649ead.jpeg', 'properties/26/project/84b23e84-481d-4f65-bffb-818f80afe84f.jpeg', '67b6cdb089ea6b8bd54658fc12649ead.jpeg', 26, 'project', 286, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(104, 'uploads/a82a2c84b9063f35c309506d2a764f56.jpeg', 'properties/26/project/185943e1-a3dc-4ba4-b136-4d55e1119c66.jpeg', 'a82a2c84b9063f35c309506d2a764f56.jpeg', 26, 'project', 287, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(105, 'uploads/9ff1ca3f60f6104cb78c01342ac172fa.jpeg', 'properties/26/project/004efad9-6459-4f13-9324-148e6908f3df.jpeg', '9ff1ca3f60f6104cb78c01342ac172fa.jpeg', 26, 'project', 288, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(106, 'uploads/3f30bdb7d8c22fc6f9bfc0fbed0b9eed.jpeg', 'properties/26/project/257800d4-6a13-4fec-bf3e-bd18640fc9c3.jpeg', '3f30bdb7d8c22fc6f9bfc0fbed0b9eed.jpeg', 26, 'project', 289, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(107, 'uploads/767e81ab895ec5245499e9c1cb3b9468.jpeg', 'properties/26/project/e2517039-bb68-4cfb-9743-0651fd3c6949.jpeg', '767e81ab895ec5245499e9c1cb3b9468.jpeg', 26, 'project', 290, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(108, 'uploads/02fbbf02c44199424ed484984986bc49.jpeg', 'properties/26/project/dc86a429-877e-4fcf-9757-a52d9989286e.jpeg', '02fbbf02c44199424ed484984986bc49.jpeg', 26, 'project', 291, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(109, 'uploads/34ebf7aec175554c9287a047526bf649.jpeg', 'properties/26/project/77bc4e14-815f-4715-93fa-063a82f9eda0.jpeg', '34ebf7aec175554c9287a047526bf649.jpeg', 26, 'project', 292, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(110, 'uploads/bce6da73b0819ceb8a50616ad885af6a.jpeg', 'properties/26/project/e02df5cb-06d3-44c9-9032-e322b8677ad7.jpeg', 'bce6da73b0819ceb8a50616ad885af6a.jpeg', 26, 'project', 293, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(111, 'uploads/684c9deb7039578f86d23241ad734b47.jpeg', 'properties/26/project/ce853ef6-05c7-4509-bd75-f49bd4c08acd.jpeg', '684c9deb7039578f86d23241ad734b47.jpeg', 26, 'project', 294, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(112, 'uploads/124af9ea76ac2cfb3903c141e7616ffd.jpeg', 'properties/26/project/e5c066f9-6cf0-4eec-8b9a-a9d35fba2678.jpeg', '124af9ea76ac2cfb3903c141e7616ffd.jpeg', 26, 'project', 295, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(113, 'uploads/6f5e5af0c94b44b6492c15f2743c2239.jpg', 'properties/27/project/6829960a-5a00-42c7-a72a-e1bcfb8f62f9.jpg', '6f5e5af0c94b44b6492c15f2743c2239.jpg', 27, 'project', 296, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(114, 'uploads/0e68b0f1746fe523ffad0e358ba71629.jpg', 'properties/27/project/6a4307bf-e87f-4b87-b80f-a1620763b058.jpg', '0e68b0f1746fe523ffad0e358ba71629.jpg', 27, 'project', 297, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(115, 'uploads/d33a7495516b0c21fa2b7b1193d8d163.jpg', 'properties/27/project/394169ba-5043-495f-a7cd-177ce190158e.jpg', 'd33a7495516b0c21fa2b7b1193d8d163.jpg', 27, 'project', 298, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(116, 'uploads/267c53c1c71c8950efec8011094b1591.jpg', 'properties/27/project/53a68198-84b1-493b-bba7-ccc0bbb809df.jpg', '267c53c1c71c8950efec8011094b1591.jpg', 27, 'project', 299, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(117, 'uploads/874c8d0e26cb1d404e82935425478fa0.jpg', 'properties/27/project/661b4a72-9253-42f1-8699-8559acd29cc3.jpg', '874c8d0e26cb1d404e82935425478fa0.jpg', 27, 'project', 300, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(118, 'uploads/b089b7230498fcc0f992077a9d7fdfa7.jpg', 'properties/27/project/8ed4f72e-2fee-4229-9efc-6c14a5223bde.jpg', 'b089b7230498fcc0f992077a9d7fdfa7.jpg', 27, 'project', 301, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(119, 'uploads/ef30f6cb91889f3f9d95942498ed16ae.jpg', 'properties/27/project/5826b09a-713c-4e12-9d51-cb78857d7cef.jpg', 'ef30f6cb91889f3f9d95942498ed16ae.jpg', 27, 'project', 302, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(120, 'uploads/6586390719edc01a5e7117b948743181.jpg', 'properties/27/project/143cdee9-2f39-4a9c-b4f6-dc03bae70e70.jpg', '6586390719edc01a5e7117b948743181.jpg', 27, 'project', 303, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(121, 'uploads/22c22e07cd73dbed4b372938d387a18c.jpg', 'properties/29/project/1ebd9df5-9ad4-4573-910f-d2505203d2fc.jpg', '22c22e07cd73dbed4b372938d387a18c.jpg', 29, 'project', 311, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(122, 'uploads/dbdfc258568a3dd558a9991809b52a9d.jpeg', 'properties/29/project/5c147c88-5a45-4d4e-9378-26ec234b369b.jpeg', 'dbdfc258568a3dd558a9991809b52a9d.jpeg', 29, 'project', 312, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(123, 'uploads/6de1ba45a7fe10ce8c381514f8b2ff9f.jpg', 'properties/29/project/9296a821-3121-4726-83be-eeae45234493.jpg', '6de1ba45a7fe10ce8c381514f8b2ff9f.jpg', 29, 'project', 313, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(124, 'uploads/6dc4d51643dc357f50db3314dd199665.jpg', 'properties/29/project/5081f7d6-df7f-4a3b-ba0c-177370ad15a0.jpg', '6dc4d51643dc357f50db3314dd199665.jpg', 29, 'project', 314, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(125, 'uploads/3c6d0a66b64a82ad9b173321780de709.jpg', 'properties/29/project/fd119ac1-544c-4acd-abdc-6b6fb888c4a2.jpg', '3c6d0a66b64a82ad9b173321780de709.jpg', 29, 'project', 315, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(126, 'uploads/02c278592ea8b2f883afcaa6279ec599.jpg', 'properties/29/project/c45d17fb-7467-41e3-b770-856a1c12b9d3.jpg', '02c278592ea8b2f883afcaa6279ec599.jpg', 29, 'project', 316, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(127, 'uploads/64d055592be82ba3c9994cb33d221d07.jpg', 'properties/29/project/898be726-29ff-4eec-8e43-8fd9c7727518.jpg', '64d055592be82ba3c9994cb33d221d07.jpg', 29, 'project', 317, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(128, 'uploads/000c13bf725508885babdb39b5d96667.jpg', 'properties/29/project/f9323c74-2bcf-457f-9167-9aaf2c9b60a8.jpg', '000c13bf725508885babdb39b5d96667.jpg', 29, 'project', 318, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(129, 'uploads/f62b1406545981ccd99a85059bc6a1ef.jpg', 'properties/29/project/bdb0d8be-9c4e-4b00-957f-17df6aa8468f.jpg', 'f62b1406545981ccd99a85059bc6a1ef.jpg', 29, 'project', 319, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(130, 'uploads/a125e2255d0073ae437d236b54e455fb.jpg', 'properties/29/project/c9555ee6-ede7-43e4-9791-e6c2ab2ae775.jpg', 'a125e2255d0073ae437d236b54e455fb.jpg', 29, 'project', 320, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(131, 'uploads/31e5625a880ab8daadb3c40d15bf6fd2.jpeg', 'properties/29/project/0989123f-d677-4093-bccc-8d9c359c17fc.jpeg', '31e5625a880ab8daadb3c40d15bf6fd2.jpeg', 29, 'project', 321, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(132, 'uploads/3b2d9eaa6eb2e8605a3bacaee24f2bc5.jpeg', 'properties/29/project/82dc77e5-c111-4bad-9933-d7885c341c4e.jpeg', '3b2d9eaa6eb2e8605a3bacaee24f2bc5.jpeg', 29, 'project', 322, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(133, 'uploads/449cc3309001dd944d5bbde7ee3d8e1a.jpeg', 'properties/29/project/0ddf42c4-3215-4655-9198-c2cdf0100507.jpeg', '449cc3309001dd944d5bbde7ee3d8e1a.jpeg', 29, 'project', 323, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(134, 'uploads/464d487832e35f6b1b8889dbc181924a.jpeg', 'properties/29/project/b26ad678-e826-4786-98a8-dd1158ebd0eb.jpeg', '464d487832e35f6b1b8889dbc181924a.jpeg', 29, 'project', 324, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(135, 'uploads/90a689bb631bd3ffe7463529504c6fea.jpeg', 'properties/29/project/1f39634b-e0cb-4da4-bb9b-ce2c79382d62.jpeg', '90a689bb631bd3ffe7463529504c6fea.jpeg', 29, 'project', 325, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(136, 'uploads/75b6d2921794c8a35cc5c2cc6c53368d.jpeg', 'properties/29/project/4d4f0102-5871-4c79-81c6-b4decda0576f.jpeg', '75b6d2921794c8a35cc5c2cc6c53368d.jpeg', 29, 'project', 326, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(137, 'uploads/f0f2b69a4d4724511817bd3438549342.jpg', 'properties/31/project/47582d13-4585-4195-abaa-29500d2cd762.jpg', 'f0f2b69a4d4724511817bd3438549342.jpg', 31, 'project', 343, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(138, 'uploads/d49e1876b4b0d7cda54d4ecbce2317fe.jpeg', 'properties/31/project/af4ab1e4-97a4-4287-a84d-4d890e2dfc24.jpeg', 'd49e1876b4b0d7cda54d4ecbce2317fe.jpeg', 31, 'project', 344, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(139, 'uploads/18a0f5387b10f91ac1232e8a643ebc98.jpg', 'properties/31/project/ddc0c34a-8697-434a-b852-4d85cb18bd32.jpg', '18a0f5387b10f91ac1232e8a643ebc98.jpg', 31, 'project', 345, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(140, 'uploads/f217791b83e3b242358b38e37b02e824.jpg', 'properties/31/project/20e889c7-ff19-4a92-a462-5b70619f5547.jpg', 'f217791b83e3b242358b38e37b02e824.jpg', 31, 'project', 346, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(141, 'uploads/f4f43880f194530c243583be1db7a1c9.jpg', 'properties/31/project/246223a6-610c-470a-821a-e573eae4ca69.jpg', 'f4f43880f194530c243583be1db7a1c9.jpg', 31, 'project', 347, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(142, 'uploads/4c817af3f8315ff06d6184463c59d57d.jpeg', 'properties/32/project/e8319984-779b-4b3b-8e2e-5ba5942a9427.jpeg', '4c817af3f8315ff06d6184463c59d57d.jpeg', 32, 'project', 348, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(143, 'uploads/b5f07372bb7209ba2b2f6e0224fea161.jpeg', 'properties/32/project/653f7bb6-2ece-4bf3-ad4b-10a91cd9ce6d.jpeg', 'b5f07372bb7209ba2b2f6e0224fea161.jpeg', 32, 'project', 349, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(144, 'uploads/41d63fc6a747a1052b43b93fe82728e3.jpeg', 'properties/32/project/fef2aaf3-c751-4715-a9e0-20689da45c9a.jpeg', '41d63fc6a747a1052b43b93fe82728e3.jpeg', 32, 'project', 350, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(145, 'uploads/ef0b5663e54792a8c6ac0e12ed212625.jpeg', 'properties/32/project/8120fb92-b732-482f-b21b-d97dce9f8520.jpeg', 'ef0b5663e54792a8c6ac0e12ed212625.jpeg', 32, 'project', 351, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(146, 'uploads/a9346d6e28e1caec498b812e95566128.jpeg', 'properties/32/project/c04e6a34-e2a6-42dd-99b0-b28f5ad7cfdc.jpeg', 'a9346d6e28e1caec498b812e95566128.jpeg', 32, 'project', 352, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(147, 'uploads/bec6f25bf474df5900093c6b5a2bef7c.jpeg', 'properties/32/project/48cbcab4-7cc1-445e-aefb-8e2cb94278a3.jpeg', 'bec6f25bf474df5900093c6b5a2bef7c.jpeg', 32, 'project', 353, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(148, 'uploads/9433564ff2e1354248950a2f900d9de2.jpeg', 'properties/32/project/fa585c64-634c-4172-ad10-fb90df78c397.jpeg', '9433564ff2e1354248950a2f900d9de2.jpeg', 32, 'project', 354, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(149, 'uploads/123e003336b5a8a603fe2cfcabbc5bd5.jpeg', 'properties/32/project/0b1fbe2d-0795-4e0c-8b85-06e48add0403.jpeg', '123e003336b5a8a603fe2cfcabbc5bd5.jpeg', 32, 'project', 355, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(150, 'uploads/868b33e238f1af3b523714f5f5532dcf.jpeg', 'properties/32/project/b636c062-cb50-4d97-ad74-d3f0883d476f.jpeg', '868b33e238f1af3b523714f5f5532dcf.jpeg', 32, 'project', 356, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(151, 'uploads/7654fbff86b2aac0faaac02b3a1f100c.jpeg', 'properties/32/project/f8328cd9-f81d-44fb-9c09-cd885c811d0e.jpeg', '7654fbff86b2aac0faaac02b3a1f100c.jpeg', 32, 'project', 357, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(152, 'uploads/9f45b8a0bbddd50c906c2e8e1ac0d628.jpg', 'properties/32/project/7182e1e0-0b54-44e8-b7b2-b8a7b53df362.jpg', '9f45b8a0bbddd50c906c2e8e1ac0d628.jpg', 32, 'project', 358, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(153, 'uploads/02c4756384fdc0c05fed2c1b834c4d51.jpg', 'properties/32/project/e5ed7521-acdb-4477-9feb-0744d0778670.jpg', '02c4756384fdc0c05fed2c1b834c4d51.jpg', 32, 'project', 359, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(154, 'uploads/8edcc14e20882d53c33bec680e79e889.jpg', 'properties/32/project/fb10340c-d88f-46f9-8970-a2217de339ce.jpg', '8edcc14e20882d53c33bec680e79e889.jpg', 32, 'project', 360, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(155, 'uploads/b7a862b4250cd55ad55608156f0f7c0e.jpg', 'properties/32/project/0768616f-1093-44ef-8aaa-ad3563a996d0.jpg', 'b7a862b4250cd55ad55608156f0f7c0e.jpg', 32, 'project', 361, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(156, 'uploads/95ee5eaa6b62d9373acbc0864a8c6615.jpg', 'properties/32/project/35bc451c-1a0a-45ea-9008-8a19fe245251.jpg', '95ee5eaa6b62d9373acbc0864a8c6615.jpg', 32, 'project', 362, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(157, 'uploads/ab2682e58d850b668d03af3947a6b027.jpg', 'properties/32/project/6a201f97-feb2-41c7-afd1-4060dcf7a1b9.jpg', 'ab2682e58d850b668d03af3947a6b027.jpg', 32, 'project', 363, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(158, 'uploads/fa3f0f8e93a0af08ab6ca787ed6d2c65.jpeg', 'properties/33/project/9e37f1b4-8ac9-4b71-9418-a941eb4832f1.jpeg', 'fa3f0f8e93a0af08ab6ca787ed6d2c65.jpeg', 33, 'project', 364, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(159, 'uploads/b85a2dcd016b2e272c75786c35f16155.jpeg', 'properties/33/project/2fe19d55-11c7-49a8-b4a6-36353aed35d9.jpeg', 'b85a2dcd016b2e272c75786c35f16155.jpeg', 33, 'project', 365, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(160, 'uploads/fb36d6c54fb4419fb603e1c507358e05.jpeg', 'properties/33/project/2e6aec24-98c2-4287-9c78-6fd720a1b749.jpeg', 'fb36d6c54fb4419fb603e1c507358e05.jpeg', 33, 'project', 366, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(161, 'uploads/719b9b648521408d54f547562075c257.jpeg', 'properties/33/project/64afc60b-20ad-4d55-b42b-4b84f7e4dc15.jpeg', '719b9b648521408d54f547562075c257.jpeg', 33, 'project', 367, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(162, 'uploads/964b46d1f28577f6bde420dd437fb278.jpeg', 'properties/33/project/2e9cb59f-9615-4a3f-9da3-22b099379ae2.jpeg', '964b46d1f28577f6bde420dd437fb278.jpeg', 33, 'project', 368, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(163, 'uploads/85baebb502b1232f0b7cad444d222dc7.jpeg', 'properties/33/project/a6b2bd05-b101-4f14-bdd6-615b69ead998.jpeg', '85baebb502b1232f0b7cad444d222dc7.jpeg', 33, 'project', 369, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(164, 'uploads/1044924e752c749f0626470e65e63bf8.jpeg', 'properties/33/project/cf1cf540-79d5-494f-973c-6351fd9c4d11.jpeg', '1044924e752c749f0626470e65e63bf8.jpeg', 33, 'project', 370, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(165, 'uploads/4dff608e7e4ae76f7a1b1c29c077b8bf.jpeg', 'properties/33/project/68c29cc9-716a-4a93-9ba6-77dc110c3fff.jpeg', '4dff608e7e4ae76f7a1b1c29c077b8bf.jpeg', 33, 'project', 371, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(166, 'uploads/c592fb5ebe2fd8f6a91411eaa6bf95ca.jpeg', 'properties/33/project/fc5f1dac-be78-4d38-bda4-2c1f28db319a.jpeg', 'c592fb5ebe2fd8f6a91411eaa6bf95ca.jpeg', 33, 'project', 372, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(167, 'uploads/81baa7262550d9713e67152246543afd.jpeg', 'properties/33/project/dafe675c-2e34-41ff-9c25-75396ef45962.jpeg', '81baa7262550d9713e67152246543afd.jpeg', 33, 'project', 373, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(168, 'uploads/3516039295648b5d1b4889e695848431.jpeg', 'properties/33/project/a6e0c76f-0bbe-4df3-b08a-c60be3a7ff3b.jpeg', '3516039295648b5d1b4889e695848431.jpeg', 33, 'project', 374, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(169, 'uploads/52533eb35cab0689a4118d263008d014.jpeg', 'properties/33/project/6a456b95-ee75-4be0-876d-5d0f723c04d2.jpeg', '52533eb35cab0689a4118d263008d014.jpeg', 33, 'project', 375, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(170, 'uploads/f090cdc9fdb73d9516ea52456d64e4d3.jpeg', 'properties/36/project/d3532140-cc22-46be-b908-e4f1d76d9b39.jpeg', 'f090cdc9fdb73d9516ea52456d64e4d3.jpeg', 36, 'project', 398, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(171, 'uploads/e49bdd800d18918eb9a10e0427b4221f.jpeg', 'properties/36/project/79c880b6-60dc-4de0-b730-bce8f5e69b3a.jpeg', 'e49bdd800d18918eb9a10e0427b4221f.jpeg', 36, 'project', 399, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(172, 'uploads/82eae7aa3d85d3f801c2e277de123e24.jpeg', 'properties/36/project/a1bbdcb0-d1af-42bd-aeba-38dc9471a68a.jpeg', '82eae7aa3d85d3f801c2e277de123e24.jpeg', 36, 'project', 400, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(173, 'uploads/6d062fb7f5dfecbacc33184bea2343a4.jpeg', 'properties/36/project/dd572cbe-bc53-44fa-94a8-c66cc33ad81a.jpeg', '6d062fb7f5dfecbacc33184bea2343a4.jpeg', 36, 'project', 401, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(174, 'uploads/c2a4824784ec1e2e754d483edf3a2393.jpeg', 'properties/36/project/75c6545e-ab5c-408e-857d-38a36b516d3c.jpeg', 'c2a4824784ec1e2e754d483edf3a2393.jpeg', 36, 'project', 402, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(175, 'uploads/f7e1180bda76338dccd3f8d0440d1d43.jpeg', 'properties/36/project/70632152-0b0c-4353-ab49-1fd059d3ecc9.jpeg', 'f7e1180bda76338dccd3f8d0440d1d43.jpeg', 36, 'project', 403, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(176, 'uploads/4872c7c7abfafbbaade488375bc77b7f.jpeg', 'properties/36/project/8fa4aeb7-7070-4c85-96ed-30b920dca6e6.jpeg', '4872c7c7abfafbbaade488375bc77b7f.jpeg', 36, 'project', 404, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(177, 'uploads/3a8e0cb3e2d5311443475bbdc44534b2.jpeg', 'properties/36/project/4fb436bb-9e46-42e9-9677-422a16766057.jpeg', '3a8e0cb3e2d5311443475bbdc44534b2.jpeg', 36, 'project', 405, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(178, 'uploads/572334a9a780e223db7169586769c01e.jpeg', 'properties/36/project/e6e8bf66-ac1b-4940-9791-312996c87c3d.jpeg', '572334a9a780e223db7169586769c01e.jpeg', 36, 'project', 406, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(179, 'uploads/416dbb0a884ed1fab665eae1384de414.jpeg', 'properties/36/project/0e6b78be-dd0d-4845-82f5-31c14d54eb46.jpeg', '416dbb0a884ed1fab665eae1384de414.jpeg', 36, 'project', 407, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(180, 'uploads/0c3bd2dca1de95117d9bd392deefa2da.jpeg', 'properties/36/project/ef2e3d4f-4e4b-4468-94cd-d0e496876bda.jpeg', '0c3bd2dca1de95117d9bd392deefa2da.jpeg', 36, 'project', 408, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(181, 'uploads/5bce8914e627947fc19b8b5f3cd62359.jpeg', 'properties/36/project/95284954-9820-4ce2-ade7-b5b392f18556.jpeg', '5bce8914e627947fc19b8b5f3cd62359.jpeg', 36, 'project', 409, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(182, 'uploads/03082199ad5c651393fd5567e8a0f26f.jpeg', 'properties/36/project/98780efb-8ea9-4b79-b5ff-ae0202ed3314.jpeg', '03082199ad5c651393fd5567e8a0f26f.jpeg', 36, 'project', 410, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(183, 'uploads/44a052e553792535fcb4fd524422f227.jpeg', 'properties/36/project/4f0dca22-520c-4cdd-868a-0aa6db92f152.jpeg', '44a052e553792535fcb4fd524422f227.jpeg', 36, 'project', 411, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(184, 'uploads/e4a7e56fde0d974e5b15e377bb5aa7a9.jpeg', 'properties/36/project/8fc3cdf5-2856-4ae4-ac8d-418b5082c9aa.jpeg', 'e4a7e56fde0d974e5b15e377bb5aa7a9.jpeg', 36, 'project', 412, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(185, 'uploads/f397cd3ce549527a0a57277017f6a652.jpeg', 'properties/36/project/6e4775c2-6871-4cb7-a0b0-f0c6ad81cb02.jpeg', 'f397cd3ce549527a0a57277017f6a652.jpeg', 36, 'project', 413, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(186, 'uploads/f058cafc896c7ea8f80995c9df26c247.jpg', 'properties/38/project/6e460098-4b52-4976-9906-dd62d5bcf420.jpg', 'f058cafc896c7ea8f80995c9df26c247.jpg', 38, 'project', 422, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(187, 'uploads/693351460396211f872b3eacec0697c7.png', 'properties/38/logo/d3fc79e2-fa4e-4e1b-a5d9-759f87e7466c.png', '693351460396211f872b3eacec0697c7.png', 38, 'logo', 423, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(188, 'uploads/a26dc5906a56dbd55e639adc63727eef.jpg', 'properties/38/project/d45d2bc4-ea0a-4197-9422-fb26fc81b602.jpg', 'a26dc5906a56dbd55e639adc63727eef.jpg', 38, 'project', 424, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(189, 'uploads/1ffbbd88a26cf53b658cf2639072cc4b.jpg', 'properties/38/project/ff1efcef-d4f7-4462-a9ca-5c849669db02.jpg', '1ffbbd88a26cf53b658cf2639072cc4b.jpg', 38, 'project', 425, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(190, 'uploads/dlf-alameda-floors-dlf-alameda-floors-exteriors-1641807092.jpg', 'properties/38/project/3f964ab1-2128-41ab-a8ad-6e8a1177d251.jpg', 'dlf-alameda-floors-dlf-alameda-floors-exteriors-1641807092.jpg', 38, 'project', 426, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(191, 'uploads/dlf-alameda-floors-dlf-alameda-floors-exterior-photos-1641807092.jpg', 'properties/38/project/137cc386-c72a-4675-b7f5-849b21db1c02.jpg', 'dlf-alameda-floors-dlf-alameda-floors-exterior-photos-1641807092.jpg', 38, 'project', 427, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(192, 'uploads/dlf-alameda-floors-dlf-alameda-floors-exteriors-16418070921.jpg', 'properties/38/project/1aabc66f-5c18-41c9-a374-6596afaee4be.jpg', 'dlf-alameda-floors-dlf-alameda-floors-exteriors-16418070921.jpg', 38, 'project', 428, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(193, 'uploads/dlf-alameda-floors-dlf-alameda-floors-exterior-photos-16418070921.jpg', 'properties/38/project/487e3ca6-d4f7-4e2c-a573-5947e0221ee5.jpg', 'dlf-alameda-floors-dlf-alameda-floors-exterior-photos-16418070921.jpg', 38, 'project', 429, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(194, 'uploads/dlf-alameda-floors-dlf-alameda-floors-exteriors-16418070922.jpg', 'properties/38/project/d0ac2d61-346b-4fe0-b327-6c3d17141358.jpg', 'dlf-alameda-floors-dlf-alameda-floors-exteriors-16418070922.jpg', 38, 'project', 430, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(195, 'uploads/m3m-skycity-logo-1640077820.jpg', 'properties/41/logo/7fdae689-43d1-4cba-b5ad-e5515b2dcf9c.jpg', 'm3m-skycity-logo-1640077820.jpg', 41, 'logo', 453, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(196, 'uploads/m3m-skycity-m3m-skycity-exterior-photos-1640078617.jpg', 'properties/41/project/b2ae3759-498e-4072-91da-1a49c309c991.jpg', 'm3m-skycity-m3m-skycity-exterior-photos-1640078617.jpg', 41, 'project', 454, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(197, 'uploads/m3m-skycity-m3m-skycity-inner-photos-1640078681.jpg', 'properties/41/project/0d241053-05aa-4e7a-b019-567e5476b877.jpg', 'm3m-skycity-m3m-skycity-inner-photos-1640078681.jpg', 41, 'project', 455, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(198, 'uploads/m3m-skycity-m3m-skycity-inner-photos-16400786811.jpg', 'properties/41/project/fdbdb88c-ae12-4d38-957c-c20a785083a2.jpg', 'm3m-skycity-m3m-skycity-inner-photos-16400786811.jpg', 41, 'project', 456, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(199, 'uploads/m3m-skycity-m3m-skycity-exterior-photos-1640078760.jpg', 'properties/41/project/3e50668d-ba3e-4ee9-95f3-0a2e81f9d562.jpg', 'm3m-skycity-m3m-skycity-exterior-photos-1640078760.jpg', 41, 'project', 457, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(200, 'uploads/m3m-skycity-m3m-skycity-exterior-photos-16400787601.jpg', 'properties/41/project/a7b8ea5a-4dfd-4713-9666-29894771677f.jpg', 'm3m-skycity-m3m-skycity-exterior-photos-16400787601.jpg', 41, 'project', 458, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(201, 'uploads/m3m-skycity-m3m-skycity-exterior-photos-16400787602.jpg', 'properties/41/project/832a1727-b268-4ed2-bd4e-1ee3bd5eb2d4.jpg', 'm3m-skycity-m3m-skycity-exterior-photos-16400787602.jpg', 41, 'project', 459, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(202, 'uploads/m3m-skycity-m3m-skycity-exterior-photos-16400787603.jpg', 'properties/41/project/32197a13-a980-45e5-ba92-8a1b343c53e5.jpg', 'm3m-skycity-m3m-skycity-exterior-photos-16400787603.jpg', 41, 'project', 460, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(203, 'uploads/m3m-skycity-m3m-skycity-exteriors-1640078760.jpg', 'properties/41/project/e3ef0cc7-45f8-4bfe-981f-296de1e4b1c4.jpg', 'm3m-skycity-m3m-skycity-exteriors-1640078760.jpg', 41, 'project', 461, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(204, 'uploads/aipl-autograph-logo-1641801239.jpg', 'properties/43/logo/89606afe-6224-4122-b882-85829b1f22d7.jpg', 'aipl-autograph-logo-1641801239.jpg', 43, 'logo', 463, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(205, 'uploads/aipl-autograph-aipl-autograph-exterior-photos-1641801322.jpg', 'properties/43/project/38206b44-e3e7-4aa2-af92-17b329bdb1b9.jpg', 'aipl-autograph-aipl-autograph-exterior-photos-1641801322.jpg', 43, 'project', 464, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(206, 'uploads/aipl-autograph-aipl-autograph-exteriors-1641801707.jpg', 'properties/43/project/de2ab018-05ba-489c-b80c-4b8998b04294.jpg', 'aipl-autograph-aipl-autograph-exteriors-1641801707.jpg', 43, 'project', 465, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04');
INSERT INTO `image_redirections` (`id`, `old_path`, `new_path`, `original_filename`, `property_id`, `image_type`, `property_image_id`, `is_active`, `redirect_count`, `last_redirected_at`, `created_at`, `updated_at`) VALUES
(207, 'uploads/aipl-autograph-aipl-autograph-exteriors-16418017071.jpg', 'properties/43/project/c0860a9c-43f8-4671-8763-4c82abf83beb.jpg', 'aipl-autograph-aipl-autograph-exteriors-16418017071.jpg', 43, 'project', 466, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(208, 'uploads/aipl-autograph-aipl-autograph-inner-photos-1641801736.jpg', 'properties/43/project/c6adf75d-8e43-4a6b-bfad-796e781bbac5.jpg', 'aipl-autograph-aipl-autograph-inner-photos-1641801736.jpg', 43, 'project', 467, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(209, 'uploads/aipl-autograph-aipl-autograph-inner-photos-16418017361.jpg', 'properties/43/project/98df7be5-e085-4306-bba8-f29bee535d2c.jpg', 'aipl-autograph-aipl-autograph-inner-photos-16418017361.jpg', 43, 'project', 468, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(210, 'uploads/aipl-autograph-aipl-autograph-inner-photos-16418017362.jpg', 'properties/43/project/5ca11227-225b-46b7-98b4-65e54ac5d556.jpg', 'aipl-autograph-aipl-autograph-inner-photos-16418017362.jpg', 43, 'project', 469, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(211, 'uploads/dlf-garden-city-floors-exteriors-164387967684.jpg', 'properties/44/project/1eb1006b-eb10-4281-91bc-76bb90fa6671.jpg', 'dlf-garden-city-floors-exteriors-164387967684.jpg', 44, 'project', 470, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(212, 'uploads/dlf-garden-city-floors-exterior-photos-164387972059.jpg', 'properties/44/project/9ca8a387-de75-4f8f-8ec3-1ba7acaf894c.jpg', 'dlf-garden-city-floors-exterior-photos-164387972059.jpg', 44, 'project', 471, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(213, 'uploads/dlf-garden-city-floors-exteriors-164387972057.jpg', 'properties/44/project/72ee07a7-d99a-476f-88b8-ac8674b79eeb.jpg', 'dlf-garden-city-floors-exteriors-164387972057.jpg', 44, 'project', 472, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(214, 'uploads/dlf-garden-city-floors-exteriors-164387972015.jpg', 'properties/44/project/e9866521-06f3-4190-bb6e-936828ab52fd.jpg', 'dlf-garden-city-floors-exteriors-164387972015.jpg', 44, 'project', 473, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(215, 'uploads/dlf-garden-city-floors-exterior-photos-164387972014.jpg', 'properties/44/project/2cbd1c99-2804-4f93-a2bf-d0cd512ddf98.jpg', 'dlf-garden-city-floors-exterior-photos-164387972014.jpg', 44, 'project', 474, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(216, 'uploads/fully-furnished-ground-floor-with-private-garden-interiors-164390945312.jpg', 'properties/45/project/7752374d-7d3e-4e2b-96ed-bd0b93325245.jpg', 'fully-furnished-ground-floor-with-private-garden-interiors-164390945312.jpg', 45, 'project', 475, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(217, 'uploads/fully-furnished-ground-floor-with-private-garden-interiors-164390952212.jpg', 'properties/45/project/71db216f-ef87-425b-b590-0dddbcf25641.jpg', 'fully-furnished-ground-floor-with-private-garden-interiors-164390952212.jpg', 45, 'project', 476, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(218, 'uploads/fully-furnished-ground-floor-with-private-garden-interiors-164390952229.jpg', 'properties/45/project/7ec942cc-4ad5-45dc-9910-8db4017607f9.jpg', 'fully-furnished-ground-floor-with-private-garden-interiors-164390952229.jpg', 45, 'project', 477, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(219, 'uploads/fully-furnished-ground-floor-with-private-garden-inner-photos-164390952224.jpg', 'properties/45/project/37f257c7-1de8-4ade-ad51-4d0b4c387b8a.jpg', 'fully-furnished-ground-floor-with-private-garden-inner-photos-164390952224.jpg', 45, 'project', 478, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(220, 'uploads/fully-furnished-ground-floor-with-private-garden-inner-photos-164390952235.jpg', 'properties/45/project/61defd34-4b07-4c7c-af0e-b947b24ea314.jpg', 'fully-furnished-ground-floor-with-private-garden-inner-photos-164390952235.jpg', 45, 'project', 479, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(221, 'uploads/fully-furnished-ground-floor-with-private-garden-inner-photos-164390952234.jpg', 'properties/45/project/ca36b936-c9b2-4842-bb0e-aa33fd69a765.jpg', 'fully-furnished-ground-floor-with-private-garden-inner-photos-164390952234.jpg', 45, 'project', 480, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(222, 'uploads/fully-furnished-ground-floor-with-private-garden-interiors-164390952273.jpg', 'properties/45/project/b86f88a3-e6f3-4269-94e1-9a8ac345c393.jpg', 'fully-furnished-ground-floor-with-private-garden-interiors-164390952273.jpg', 45, 'project', 481, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(223, 'uploads/fully-furnished-ground-floor-with-private-garden-interiors-16439095226.jpg', 'properties/45/project/c343850e-7553-433d-bb2f-1f52ff999d8e.jpg', 'fully-furnished-ground-floor-with-private-garden-interiors-16439095226.jpg', 45, 'project', 482, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(224, 'uploads/5-bhk-house-with-swimming-pool-exteriors-164416572927.jpg', 'properties/46/project/f8dff180-2415-4d96-8672-98de1c14895d.jpg', '5-bhk-house-with-swimming-pool-exteriors-164416572927.jpg', 46, 'project', 483, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(225, 'uploads/5-bhk-house-with-swimming-pool-inner-photos-164416579290.jpg', 'properties/46/project/076740e4-4eb9-4044-b7c4-72df00a1f794.jpg', '5-bhk-house-with-swimming-pool-inner-photos-164416579290.jpg', 46, 'project', 484, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(226, 'uploads/5-bhk-house-with-swimming-pool-inner-photos-164416579221.jpg', 'properties/46/project/7b9688fb-ac15-4dd5-9470-86f360ab5645.jpg', '5-bhk-house-with-swimming-pool-inner-photos-164416579221.jpg', 46, 'project', 485, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(227, 'uploads/5-bhk-house-with-swimming-pool-inner-photos-164416579242.jpg', 'properties/46/project/f26db799-9e43-4e94-96bd-051a7508e306.jpg', '5-bhk-house-with-swimming-pool-inner-photos-164416579242.jpg', 46, 'project', 486, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(228, 'uploads/5-bhk-house-with-swimming-pool-inner-photos-164416579223.jpg', 'properties/46/project/ea131821-97c4-499d-9def-c20a9ada82cb.jpg', '5-bhk-house-with-swimming-pool-inner-photos-164416579223.jpg', 46, 'project', 487, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(229, 'uploads/5-bhk-house-with-swimming-pool-interiors-16441657921.jpg', 'properties/46/project/f14d6155-4639-4b01-958c-0184e190f8f9.jpg', '5-bhk-house-with-swimming-pool-interiors-16441657921.jpg', 46, 'project', 488, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(230, 'uploads/5-bhk-house-with-swimming-pool-interiors-164416579280.jpg', 'properties/46/project/4ec411bc-51f9-481f-8d14-96d01eea8a93.jpg', '5-bhk-house-with-swimming-pool-interiors-164416579280.jpg', 46, 'project', 489, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(231, 'uploads/5-bhk-house-with-swimming-pool-interiors-164416579270.jpg', 'properties/46/project/7e24c6e3-1310-4218-9259-a03ee5c36265.jpg', '5-bhk-house-with-swimming-pool-interiors-164416579270.jpg', 46, 'project', 490, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(232, 'uploads/5-bhk-house-with-swimming-pool-interiors-164416579290.jpg', 'properties/46/project/64c87dff-8121-4783-a484-5d06fb8a2ba8.jpg', '5-bhk-house-with-swimming-pool-interiors-164416579290.jpg', 46, 'project', 491, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(233, 'uploads/5-bhk-house-with-swimming-pool-interiors-164416579240.jpg', 'properties/46/project/4d385919-2d2a-4a5e-9aad-92bf66888a4d.jpg', '5-bhk-house-with-swimming-pool-interiors-164416579240.jpg', 46, 'project', 492, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(234, 'uploads/5-bhk-house-with-swimming-pool-interiors-164416579248.jpg', 'properties/46/project/dc1192d9-d62e-45a4-903f-e539ac16426f.jpg', '5-bhk-house-with-swimming-pool-interiors-164416579248.jpg', 46, 'project', 493, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(235, 'uploads/5-bhk-house-with-swimming-pool-exterior-photos-164416582018.jpg', 'properties/46/project/c641a353-5925-433a-b180-dfa8ff00c2c6.jpg', '5-bhk-house-with-swimming-pool-exterior-photos-164416582018.jpg', 46, 'project', 494, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(236, 'uploads/5-bhk-house-with-swimming-pool-exterior-photos-164416586352.jpg', 'properties/46/project/d1a6f1e7-91f3-4df0-a138-9b80f345de8c.jpg', '5-bhk-house-with-swimming-pool-exterior-photos-164416586352.jpg', 46, 'project', 495, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(237, 'uploads/5-bhk-house-with-swimming-pool-exteriors-164416601449.jpg', 'properties/46/project/fa214647-a976-46ad-838f-cfd686ee7246.jpg', '5-bhk-house-with-swimming-pool-exteriors-164416601449.jpg', 46, 'project', 496, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(238, 'uploads/5-bhk-house-with-swimming-pool-exterior-photos-164416601481.jpg', 'properties/46/project/75c66e64-6e65-431a-bfcd-3f241a324b2c.jpg', '5-bhk-house-with-swimming-pool-exterior-photos-164416601481.jpg', 46, 'project', 497, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(239, 'uploads/5-bhk-house-with-swimming-pool-exterior-photos-16441660145.jpg', 'properties/46/project/fd7d3fdd-655c-4afa-8688-6e11915c812d.jpg', '5-bhk-house-with-swimming-pool-exterior-photos-16441660145.jpg', 46, 'project', 498, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(240, 'uploads/4bhk-villa-with-pool-facing-mandovi-river-exteriors-164457836834.jpg', 'properties/47/project/aea6364e-33bf-4672-a90a-e564e754dc32.jpg', '4bhk-villa-with-pool-facing-mandovi-river-exteriors-164457836834.jpg', 47, 'project', 499, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(241, 'uploads/4bhk-villa-with-pool-facing-mandovi-river-exteriors-164457851662.jpg', 'properties/47/project/540fb6d2-849b-4857-a072-fee8b9752a3d.jpg', '4bhk-villa-with-pool-facing-mandovi-river-exteriors-164457851662.jpg', 47, 'project', 500, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(242, 'uploads/4bhk-villa-with-pool-facing-mandovi-river-exteriors-164457851681.jpg', 'properties/47/project/5149e6f3-3740-4d01-b9fc-67577b2ebd47.jpg', '4bhk-villa-with-pool-facing-mandovi-river-exteriors-164457851681.jpg', 47, 'project', 501, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(243, 'uploads/4bhk-villa-with-pool-facing-mandovi-river-exterior-photos-164457851632.jpg', 'properties/47/project/7e5df095-998c-4b2b-8c4b-81b694e607d0.jpg', '4bhk-villa-with-pool-facing-mandovi-river-exterior-photos-164457851632.jpg', 47, 'project', 502, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(244, 'uploads/4bhk-villa-with-pool-facing-mandovi-river-exteriors-164457851654.jpg', 'properties/47/project/9ae37c46-a7dd-4506-8129-ae2f1c1d331d.jpg', '4bhk-villa-with-pool-facing-mandovi-river-exteriors-164457851654.jpg', 47, 'project', 503, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(245, 'uploads/4bhk-villa-with-pool-facing-mandovi-river-exteriors-164457851753.jpg', 'properties/47/project/414b8043-d2e5-4274-b69a-45884d6c2720.jpg', '4bhk-villa-with-pool-facing-mandovi-river-exteriors-164457851753.jpg', 47, 'project', 504, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(246, 'uploads/4bhk-villa-with-pool-facing-mandovi-river-exteriors-164457851780.jpg', 'properties/47/project/1f70608c-8aa5-4100-a2fb-821ab0d324af.jpg', '4bhk-villa-with-pool-facing-mandovi-river-exteriors-164457851780.jpg', 47, 'project', 505, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(247, 'uploads/4bhk-villa-with-pool-facing-mandovi-river-exterior-photos-164457851760.jpg', 'properties/47/project/ecbbcf2f-dd93-4238-a189-984e45c311a7.jpg', '4bhk-villa-with-pool-facing-mandovi-river-exterior-photos-164457851760.jpg', 47, 'project', 506, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(248, 'uploads/4bhk-villa-with-pool-facing-mandovi-river-inner-photos-16445785684.jpg', 'properties/47/project/2c8f111b-f707-4866-95bc-b99979bc0e5a.jpg', '4bhk-villa-with-pool-facing-mandovi-river-inner-photos-16445785684.jpg', 47, 'project', 507, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(249, 'uploads/4bhk-villa-with-pool-facing-mandovi-river-interiors-164457856837.jpg', 'properties/47/project/25d4372d-3b30-4030-ac87-4520dc1f083b.jpg', '4bhk-villa-with-pool-facing-mandovi-river-interiors-164457856837.jpg', 47, 'project', 508, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(250, 'uploads/4bhk-villa-with-pool-facing-mandovi-river-interiors-164457856836.jpg', 'properties/47/project/8474e5a2-51af-4fde-8b8f-7969f1511ef1.jpg', '4bhk-villa-with-pool-facing-mandovi-river-interiors-164457856836.jpg', 47, 'project', 509, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(251, 'uploads/4bhk-villa-with-pool-facing-mandovi-river-interiors-164457856832.jpg', 'properties/47/project/743431b4-fdad-482d-b749-1cd3da222309.jpg', '4bhk-villa-with-pool-facing-mandovi-river-interiors-164457856832.jpg', 47, 'project', 510, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(252, 'uploads/maintained-portuguese-house-exterior-photos-164458004153.jpg', 'properties/48/project/8f54bceb-155d-4fdf-a940-ac29802164ff.jpg', 'maintained-portuguese-house-exterior-photos-164458004153.jpg', 48, 'project', 511, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(253, 'uploads/maintained-portuguese-house-inner-photos-16445800929.jpg', 'properties/48/project/8f0d1253-a25b-4378-b1ce-9703c9edf3df.jpg', 'maintained-portuguese-house-inner-photos-16445800929.jpg', 48, 'project', 512, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(254, 'uploads/maintained-portuguese-house-inner-photos-164458009224.jpg', 'properties/48/project/8ed2dc99-0ca2-4875-97e2-ebc1053fb96d.jpg', 'maintained-portuguese-house-inner-photos-164458009224.jpg', 48, 'project', 513, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(255, 'uploads/maintained-portuguese-house-inner-photos-164458009215.jpg', 'properties/48/project/04c5d2f4-823f-4181-868e-ffe3a6e0abdd.jpg', 'maintained-portuguese-house-inner-photos-164458009215.jpg', 48, 'project', 514, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(256, 'uploads/maintained-portuguese-house-inner-photos-164458009252.jpg', 'properties/48/project/acc7d4fa-39bf-41bb-999f-de918782870e.jpg', 'maintained-portuguese-house-inner-photos-164458009252.jpg', 48, 'project', 515, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(257, 'uploads/maintained-portuguese-house-inner-photos-164458009219.jpg', 'properties/48/project/9936800b-2b60-411d-a83c-9bd30b2af4af.jpg', 'maintained-portuguese-house-inner-photos-164458009219.jpg', 48, 'project', 516, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(258, 'uploads/maintained-portuguese-house-interiors-164458009227.jpg', 'properties/48/project/baf271ff-915e-485d-b458-023655b4274a.jpg', 'maintained-portuguese-house-interiors-164458009227.jpg', 48, 'project', 517, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(259, 'uploads/maintained-portuguese-house-exterior-photos-164458013288.jpg', 'properties/48/project/ecfb0ce9-bf8a-4524-84d4-ec89eb6290e4.jpg', 'maintained-portuguese-house-exterior-photos-164458013288.jpg', 48, 'project', 518, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(260, 'uploads/independent-private-pool-villa-exteriors-164458202783.jpg', 'properties/49/project/a5862544-f1e9-4979-815f-d6d923195aa6.jpg', 'independent-private-pool-villa-exteriors-164458202783.jpg', 49, 'project', 519, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(261, 'uploads/independent-private-pool-villa-interiors-16445822161.jpg', 'properties/49/project/0b5f6852-3075-4ee3-8180-2c36d70b0853.jpg', 'independent-private-pool-villa-interiors-16445822161.jpg', 49, 'project', 520, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(262, 'uploads/independent-private-pool-villa-inner-photos-164458221690.jpg', 'properties/49/project/0a833f84-31d4-4a07-ae94-def5280ed8f8.jpg', 'independent-private-pool-villa-inner-photos-164458221690.jpg', 49, 'project', 521, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(263, 'uploads/independent-private-pool-villa-inner-photos-164458221633.jpg', 'properties/49/project/dad4bc7e-8602-439f-aa6f-ee1fcecd4bc3.jpg', 'independent-private-pool-villa-inner-photos-164458221633.jpg', 49, 'project', 522, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(264, 'uploads/independent-private-pool-villa-inner-photos-164458221680.jpg', 'properties/49/project/e8fcf9ad-f37c-4f81-b4d9-94619ff30b7a.jpg', 'independent-private-pool-villa-inner-photos-164458221680.jpg', 49, 'project', 523, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(265, 'uploads/independent-private-pool-villa-inner-photos-164458221671.jpg', 'properties/49/project/ec8237b7-d390-4acb-a926-a32a1b7e777a.jpg', 'independent-private-pool-villa-inner-photos-164458221671.jpg', 49, 'project', 524, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(266, 'uploads/independent-private-pool-villa-interiors-164458221682.jpg', 'properties/49/project/ff6bada3-b65d-4218-9fc6-dc5f6cc8d673.jpg', 'independent-private-pool-villa-interiors-164458221682.jpg', 49, 'project', 525, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(267, 'uploads/independent-private-pool-villa-interiors-164458221611.jpg', 'properties/49/project/1c43b466-cf4d-452a-9b98-5accc38d5059.jpg', 'independent-private-pool-villa-interiors-164458221611.jpg', 49, 'project', 526, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(268, 'uploads/independent-private-pool-villa-inner-photos-164458221654.jpg', 'properties/49/project/c3227f77-fc53-4724-aa24-6cdbfaaff5b5.jpg', 'independent-private-pool-villa-inner-photos-164458221654.jpg', 49, 'project', 527, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(269, 'uploads/independent-private-pool-villa-exterior-photos-164458225389.jpg', 'properties/49/project/673fe785-1490-4b90-bcd4-88e9efb82e5e.jpg', 'independent-private-pool-villa-exterior-photos-164458225389.jpg', 49, 'project', 528, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(270, 'uploads/independent-private-pool-villa-exteriors-16445822534.jpg', 'properties/49/project/832bf93b-38ea-4370-93df-0fef3556f876.jpg', 'independent-private-pool-villa-exteriors-16445822534.jpg', 49, 'project', 529, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(271, 'uploads/independent-private-pool-villa-exterior-photos-164458225382.jpg', 'properties/49/project/8c53a3e6-4b3b-412f-b649-61cce50890be.jpg', 'independent-private-pool-villa-exterior-photos-164458225382.jpg', 49, 'project', 530, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(272, 'uploads/luxury-portuguese-villa-with-pool--164458407432.jpg', 'properties/50/project/c33ccc22-849b-48b0-a827-9cdcee0180ed.jpg', 'luxury-portuguese-villa-with-pool--164458407432.jpg', 50, 'project', 531, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(273, 'uploads/luxury-portuguese-villa-with-pool-inner-photos-164458411190.jpg', 'properties/50/project/75685aea-27e2-47a2-a1ea-25641e6ed251.jpg', 'luxury-portuguese-villa-with-pool-inner-photos-164458411190.jpg', 50, 'project', 532, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(274, 'uploads/luxury-portuguese-villa-with-pool-interiors-164458411128.jpg', 'properties/50/project/4b620cef-6752-4e11-9ffd-67151f2bf64f.jpg', 'luxury-portuguese-villa-with-pool-interiors-164458411128.jpg', 50, 'project', 533, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(275, 'uploads/luxury-portuguese-villa-with-pool-inner-photos-164458411126.jpg', 'properties/50/project/130dae6a-4644-4791-b0e4-ac9e86b32172.jpg', 'luxury-portuguese-villa-with-pool-inner-photos-164458411126.jpg', 50, 'project', 534, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(276, 'uploads/luxury-portuguese-villa-with-pool-inner-photos-16445841117.jpg', 'properties/50/project/3ef33f7d-4a2c-4a86-baf2-622c8fa0fd8e.jpg', 'luxury-portuguese-villa-with-pool-inner-photos-16445841117.jpg', 50, 'project', 535, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(277, 'uploads/luxury-portuguese-villa-with-pool-exterior-photos-164458415838.jpg', 'properties/50/project/1a3cd9b0-3c09-4987-b13e-1c234ff94336.jpg', 'luxury-portuguese-villa-with-pool-exterior-photos-164458415838.jpg', 50, 'project', 536, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(278, 'uploads/luxury-portuguese-villa-with-pool-exterior-photos-164458415860.jpg', 'properties/50/project/74ae131b-c018-447e-931f-fae7d200bb21.jpg', 'luxury-portuguese-villa-with-pool-exterior-photos-164458415860.jpg', 50, 'project', 537, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(279, 'uploads/luxury-portuguese-villa-with-pool-exterior-photos-164458415817.jpg', 'properties/50/project/404bcf1f-c371-4e5e-8f9f-fa3cb6026ae1.jpg', 'luxury-portuguese-villa-with-pool-exterior-photos-164458415817.jpg', 50, 'project', 538, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(280, 'uploads/imperial-residences-by-dlf-logo-1648525088.jpg', 'properties/51/logo/46df4888-5f9a-4016-8118-38c1d6baed76.jpg', 'imperial-residences-by-dlf-logo-1648525088.jpg', 51, 'logo', 539, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(281, 'uploads/imperial-residences-by-dlf-exteriors-164852553011.jpg', 'properties/51/project/575a98be-b1ab-4668-935e-4bb5426a4faa.jpg', 'imperial-residences-by-dlf-exteriors-164852553011.jpg', 51, 'project', 540, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(282, 'uploads/imperial-residences-by-dlf-exteriors-164852556877.jpg', 'properties/51/project/699a1126-b43d-489a-9c58-cc5253943faa.jpg', 'imperial-residences-by-dlf-exteriors-164852556877.jpg', 51, 'project', 541, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(283, 'uploads/imperial-residences-by-dlf-exteriors-164852556879.jpg', 'properties/51/project/9a8f5b35-df21-44b6-8f54-bcef24b5fada.jpg', 'imperial-residences-by-dlf-exteriors-164852556879.jpg', 51, 'project', 542, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(284, 'uploads/imperial-residences-by-dlf-exteriors-164852556811.jpg', 'properties/51/project/26aa2f31-5528-4d12-aa94-0fe4eb275a78.jpg', 'imperial-residences-by-dlf-exteriors-164852556811.jpg', 51, 'project', 543, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(285, 'uploads/imperial-residences-by-dlf-exteriors-164852556834.jpg', 'properties/51/project/17dde52f-2dab-4c23-b12b-86b9982d9adb.jpg', 'imperial-residences-by-dlf-exteriors-164852556834.jpg', 51, 'project', 544, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(286, 'uploads/bennet-and-bernard-luxury-home-front-view-164865903627.jpg', 'properties/52/project/d25ad553-e615-43f3-9889-33f7ad4e76af.jpg', 'bennet-and-bernard-luxury-home-front-view-164865903627.jpg', 52, 'project', 545, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(287, 'uploads/bennet-and-bernard-luxury-home-interiors-164865908988.jpg', 'properties/52/project/77f44f52-b7f1-4aae-af7b-ad4a60c77f79.jpg', 'bennet-and-bernard-luxury-home-interiors-164865908988.jpg', 52, 'project', 546, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(288, 'uploads/bennet-and-bernard-luxury-home-interiors-16486590893.jpg', 'properties/52/project/da0fb71c-7b1b-4109-9137-5ea525265694.jpg', 'bennet-and-bernard-luxury-home-interiors-16486590893.jpg', 52, 'project', 547, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(289, 'uploads/bennet-and-bernard-luxury-home-interiors-164865908989.jpg', 'properties/52/project/a957c9c0-62d8-4518-a084-343a91f549c5.jpg', 'bennet-and-bernard-luxury-home-interiors-164865908989.jpg', 52, 'project', 548, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(290, 'uploads/bennet-and-bernard-luxury-home-bedroom-16486591425.jpg', 'properties/52/project/d42dac51-5007-481f-aa47-7a71c9e76e6c.jpg', 'bennet-and-bernard-luxury-home-bedroom-16486591425.jpg', 52, 'project', 549, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(291, 'uploads/bennet-and-bernard-luxury-home-bedroom-164865914272.jpg', 'properties/52/project/f8fdaa8b-6e25-4fe6-9968-2d81acbfb32d.jpg', 'bennet-and-bernard-luxury-home-bedroom-164865914272.jpg', 52, 'project', 550, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(292, 'uploads/bennet-and-bernard-luxury-home-kitchen-164865917044.jpg', 'properties/52/project/a6102087-5d5a-40a0-b7f2-a0ddc0997bff.jpg', 'bennet-and-bernard-luxury-home-kitchen-164865917044.jpg', 52, 'project', 551, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(293, 'uploads/bennet-and-bernard-luxury-home-bathroom-164865919255.jpg', 'properties/52/project/2c725af8-3cde-43ce-9af0-1360c4131e31.jpg', 'bennet-and-bernard-luxury-home-bathroom-164865919255.jpg', 52, 'project', 552, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(294, 'uploads/bennet-and-bernard-luxury-home-swimming-pool-164865922957.jpg', 'properties/52/project/8a51dee9-9d0e-4fb7-9163-12c8ea111741.jpg', 'bennet-and-bernard-luxury-home-swimming-pool-164865922957.jpg', 52, 'project', 553, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(295, 'uploads/bennet-and-bernard-luxury-home-swimming-pool-164865922927.jpg', 'properties/52/project/2625d9ac-f29b-4aec-b5c5-1a53d42cc2d5.jpg', 'bennet-and-bernard-luxury-home-swimming-pool-164865922927.jpg', 52, 'project', 554, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(296, 'uploads/4bhk-independent-villa-landscape-garden-164866416942.jpg', 'properties/53/project/341ef66d-bc3b-4d3b-ba22-74e95593b4f1.jpg', '4bhk-independent-villa-landscape-garden-164866416942.jpg', 53, 'project', 555, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(297, 'uploads/4bhk-independent-villa-bedroom-164866419890.jpg', 'properties/53/project/9f3329e2-b53d-4b7f-ab08-bf9384955b42.jpg', '4bhk-independent-villa-bedroom-164866419890.jpg', 53, 'project', 556, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(298, 'uploads/4bhk-independent-villa-interiors-164866423120.jpg', 'properties/53/project/88b7e9c3-fff4-47de-baa1-3d8a24a616eb.jpg', '4bhk-independent-villa-interiors-164866423120.jpg', 53, 'project', 557, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(299, 'uploads/4bhk-independent-villa-interiors-164866423175.jpg', 'properties/53/project/b42d553f-0011-4c50-9623-c947af672271.jpg', '4bhk-independent-villa-interiors-164866423175.jpg', 53, 'project', 558, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(300, 'uploads/4bhk-independent-villa-interiors-1648664231201.jpg', 'properties/53/project/5fe219bc-8395-402f-abda-a60bff9fe13a.jpg', '4bhk-independent-villa-interiors-1648664231201.jpg', 53, 'project', 559, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(301, 'uploads/4bhk-independent-villa-interiors-164866423122.jpg', 'properties/53/project/a427a897-70bf-48aa-834c-c2488ada1632.jpg', '4bhk-independent-villa-interiors-164866423122.jpg', 53, 'project', 560, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(302, 'uploads/4bhk-independent-villa-interiors-164866423146.jpg', 'properties/53/project/6680280a-34f4-461c-ac5e-127789a779cb.jpg', '4bhk-independent-villa-interiors-164866423146.jpg', 53, 'project', 561, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(303, 'uploads/4bhk-independent-villa-exteriors-164866429437.jpg', 'properties/53/project/a9cc35bb-a759-4654-b90c-07895e9aa8f5.jpg', '4bhk-independent-villa-exteriors-164866429437.jpg', 53, 'project', 562, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(304, 'uploads/4bhk-independent-villa-exteriors-164866429445.jpg', 'properties/53/project/4676897e-92fc-41c0-920e-9cf72fa36a85.jpg', '4bhk-independent-villa-exteriors-164866429445.jpg', 53, 'project', 563, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(305, 'uploads/4bhk-independent-villa-exteriors-164866429460.jpg', 'properties/53/project/80b94bd6-ed05-41a5-897e-88f86c7ceec5.jpg', '4bhk-independent-villa-exteriors-164866429460.jpg', 53, 'project', 564, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(306, 'uploads/upcoming-puri-construction-project-front-view-165647059754.jpg', 'properties/55/project/a2cb815c-16a5-4c91-811c-c66010209f4c.jpg', 'upcoming-puri-construction-project-front-view-165647059754.jpg', 55, 'project', 574, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(307, 'uploads/upcoming-puri-construction-project-logo-1656471003.jpg', 'properties/55/logo/3a369153-b467-47b3-ab1a-594256e7963a.jpg', 'upcoming-puri-construction-project-logo-1656471003.jpg', 55, 'logo', 575, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(308, 'uploads/godrej-connaught-one-interiors-165765038751.jpg', 'properties/56/project/ab66f854-3b5d-4ada-badf-6ea1dbcc9390.jpg', 'godrej-connaught-one-interiors-165765038751.jpg', 56, 'project', 576, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(309, 'uploads/godrej-connaught-one-interiors-165765045847.jpg', 'properties/56/project/7f10aa47-b27b-451b-9cee-a389ad6bc72c.jpg', 'godrej-connaught-one-interiors-165765045847.jpg', 56, 'project', 577, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(310, 'uploads/godrej-connaught-one-interiors-165765045822.jpg', 'properties/56/project/aaf79f7d-ddc1-4e9b-9088-3e87b566a717.jpg', 'godrej-connaught-one-interiors-165765045822.jpg', 56, 'project', 578, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(311, 'uploads/godrej-connaught-one-interiors-165765045871.jpg', 'properties/56/project/1fb602cf-ebfb-467a-8a24-60d11d0bb3ae.jpg', 'godrej-connaught-one-interiors-165765045871.jpg', 56, 'project', 579, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(312, 'uploads/godrej-connaught-one-interiors-165765045860.jpg', 'properties/56/project/d9f7adee-001c-4136-9ed6-abbef00d47b7.jpg', 'godrej-connaught-one-interiors-165765045860.jpg', 56, 'project', 580, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(313, 'uploads/godrej-connaught-one-interiors-165765045825.jpg', 'properties/56/project/b8509046-beaa-4683-b123-b2dd2691109f.jpg', 'godrej-connaught-one-interiors-165765045825.jpg', 56, 'project', 581, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(314, 'uploads/duplex-villa-banner.jpg', 'properties/59/project/21a5d638-feea-41d7-ae57-c4a580e9d183.jpg', 'duplex-villa-banner.jpg', 59, 'project', 587, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(315, 'uploads/duplex-villa---malibu-towne-gurgaon-interiors-166282652660.jpg', 'properties/59/project/d66f4883-e9e0-4180-a3de-d941f46df2d3.jpg', 'duplex-villa---malibu-towne-gurgaon-interiors-166282652660.jpg', 59, 'project', 588, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(316, 'uploads/duplex-villa---malibu-towne-gurgaon-interiors-166282652625.jpg', 'properties/59/project/c0927bee-49f6-454b-9af5-ae1c2c073011.jpg', 'duplex-villa---malibu-towne-gurgaon-interiors-166282652625.jpg', 59, 'project', 589, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(317, 'uploads/duplex-villa---malibu-towne-gurgaon-bedroom-166282660553.jpg', 'properties/59/project/5be5b1d2-0f33-4653-b94e-b2ab34cba693.jpg', 'duplex-villa---malibu-towne-gurgaon-bedroom-166282660553.jpg', 59, 'project', 590, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(318, 'uploads/duplex-villa---malibu-towne-gurgaon-bedroom-166282660540.jpg', 'properties/59/project/d7a5cb42-720d-420d-9ee2-b8a5f51da534.jpg', 'duplex-villa---malibu-towne-gurgaon-bedroom-166282660540.jpg', 59, 'project', 591, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(319, 'uploads/duplex-villa---malibu-towne-gurgaon-bedroom-166282660576.jpg', 'properties/59/project/ced619d0-7e10-4031-af2a-5c82d369c55e.jpg', 'duplex-villa---malibu-towne-gurgaon-bedroom-166282660576.jpg', 59, 'project', 592, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(320, 'uploads/duplex-villa---malibu-towne-gurgaon-landscape-garden-166282663852.jpg', 'properties/59/project/b52c8507-2890-4ac3-b51e-514127966717.jpg', 'duplex-villa---malibu-towne-gurgaon-landscape-garden-166282663852.jpg', 59, 'project', 593, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(321, 'uploads/duplex-villa---malibu-towne-gurgaon-landscape-garden-166282663836.jpg', 'properties/59/project/62424ca9-83f5-4ed1-911c-08f3c5cb3817.jpg', 'duplex-villa---malibu-towne-gurgaon-landscape-garden-166282663836.jpg', 59, 'project', 594, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(322, 'uploads/duplex-villa---malibu-towne-gurgaon-lobby-166282667652.jpg', 'properties/59/project/caf87136-c2f5-468c-897c-139e12b0c449.jpg', 'duplex-villa---malibu-towne-gurgaon-lobby-166282667652.jpg', 59, 'project', 595, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(323, 'uploads/duplex-villa---malibu-towne-gurgaon-front-view-166282676575.jpg', 'properties/59/project/1532d4cc-344f-4fdb-b764-f47c07c0db1e.jpg', 'duplex-villa---malibu-towne-gurgaon-front-view-166282676575.jpg', 59, 'project', 596, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(324, 'uploads/duplex-villa---malibu-towne-gurgaon-landscape-garden-166282679858.jpg', 'properties/59/project/ac456f02-87c4-4c16-bc5a-48e08f30be5f.jpg', 'duplex-villa---malibu-towne-gurgaon-landscape-garden-166282679858.jpg', 59, 'project', 597, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(325, 'uploads/dlf-the-grove-exteriors-166325971684.jpg', 'properties/60/project/bc19d485-43ad-4010-b7d8-53da4f48935e.jpg', 'dlf-the-grove-exteriors-166325971684.jpg', 60, 'project', 598, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(326, 'uploads/dlf-the-grove-interiors-166326075424.jpg', 'properties/60/project/b49e4a22-cd25-499e-91ba-80e0e9554e22.jpg', 'dlf-the-grove-interiors-166326075424.jpg', 60, 'project', 599, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(327, 'uploads/dlf-the-grove-exteriors-16632607817.jpg', 'properties/60/project/af1bb0e2-14cd-4334-b0e8-61040640de1b.jpg', 'dlf-the-grove-exteriors-16632607817.jpg', 60, 'project', 600, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(328, 'uploads/dlf-the-grove-floor-plan-166326341760.jpg', 'properties/60/project/6c5a98fb-5c0b-42ff-bf16-7d345b2e2047.jpg', 'dlf-the-grove-floor-plan-166326341760.jpg', 60, 'project', 601, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(329, 'uploads/dlf-the-grove-bedroom-166392094142.jpg', 'properties/60/project/347b539b-2f24-450a-8fc4-99a20cb991a1.jpg', 'dlf-the-grove-bedroom-166392094142.jpg', 60, 'project', 602, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(330, 'uploads/dlf-the-grove-lobby-16639209682.jpg', 'properties/60/project/024fc969-5993-4af9-9c3f-6521225be69d.jpg', 'dlf-the-grove-lobby-16639209682.jpg', 60, 'project', 603, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(331, 'uploads/dlf-the-grove-bathroom-166392098662.jpg', 'properties/60/project/c6eb38b2-f9dd-4e3a-9aba-435cd4842183.jpg', 'dlf-the-grove-bathroom-166392098662.jpg', 60, 'project', 604, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(332, 'uploads/dlf-the-grove-kitchen-166392100328.jpg', 'properties/60/project/f5b1e99c-142d-4eee-a724-50469a8af29a.jpg', 'dlf-the-grove-kitchen-166392100328.jpg', 60, 'project', 605, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(333, 'uploads/dlf-the-grove-exteriors-166392102111.jpg', 'properties/60/project/9b17ac71-69d5-4e32-bb36-6a3fa1f9669d.jpg', 'dlf-the-grove-exteriors-166392102111.jpg', 60, 'project', 606, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(334, 'uploads/dlf-the-grove-interiors-166392106826.jpg', 'properties/60/project/1db1d04c-d098-41ee-b281-df5d776f74ab.jpg', 'dlf-the-grove-interiors-166392106826.jpg', 60, 'project', 607, 1, 0, NULL, '2025-10-01 02:28:04', '2025-10-01 02:28:04'),
(335, 'uploads/4-bhk-luxury-independent-villa-swimming-pool-166687566977.jpg', 'properties/61/project/50842ee0-b413-4cc4-8ffa-08308241b60d.jpg', '4-bhk-luxury-independent-villa-swimming-pool-166687566977.jpg', 61, 'project', 608, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(336, 'uploads/4-bhk-luxury-independent-villa-exteriors-166687581030.jpg', 'properties/61/project/8d466b9e-6fe9-4afc-a45f-52e7dc6d5e8b.jpg', '4-bhk-luxury-independent-villa-exteriors-166687581030.jpg', 61, 'project', 609, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(337, 'uploads/4-bhk-luxury-independent-villa-exteriors-166687581082.jpg', 'properties/61/project/b59162b3-1cb4-4534-9224-675b084929c2.jpg', '4-bhk-luxury-independent-villa-exteriors-166687581082.jpg', 61, 'project', 610, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(338, 'uploads/4-bhk-luxury-independent-villa-landscape-garden-166687585180.jpg', 'properties/61/project/227ad78b-8c22-4802-aacd-0e798690711c.jpg', '4-bhk-luxury-independent-villa-landscape-garden-166687585180.jpg', 61, 'project', 611, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(339, 'uploads/4-bhk-luxury-independent-villa-interiors-16668758923.jpg', 'properties/61/project/df234ea4-1435-4043-a61f-6d94a6efcffc.jpg', '4-bhk-luxury-independent-villa-interiors-16668758923.jpg', 61, 'project', 612, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(340, 'uploads/4-bhk-luxury-independent-villa-lobby-166687593657.jpg', 'properties/61/project/c696c4a0-8adb-414d-a770-5302e975bcd0.jpg', '4-bhk-luxury-independent-villa-lobby-166687593657.jpg', 61, 'project', 613, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(341, 'uploads/4-bhk-luxury-independent-villa-bedroom-16668759693.jpg', 'properties/61/project/e8bacdad-1c20-4c64-9714-c6b40f4b8c47.jpg', '4-bhk-luxury-independent-villa-bedroom-16668759693.jpg', 61, 'project', 614, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(342, 'uploads/elan-the-presidential--166957229239.jpg', 'properties/63/project/3ffedf7c-2876-45fb-a8d8-da89cc9d661b.jpg', 'elan-the-presidential--166957229239.jpg', 63, 'project', 615, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(343, 'uploads/elan-the-presidential-exteriors-167197963370.jpg', 'properties/63/project/9e67164d-2ed1-480b-8302-cd2378c3c3a4.jpg', 'elan-the-presidential-exteriors-167197963370.jpg', 63, 'project', 616, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(344, 'uploads/elan-the-presidential-exteriors-167197963348.jpg', 'properties/63/project/fee3438b-91d2-45aa-8c14-a914aad0a23d.jpg', 'elan-the-presidential-exteriors-167197963348.jpg', 63, 'project', 617, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(345, 'uploads/dlf-upcoming-project-exteriors-167372075929.jpg', 'properties/64/project/38e1fe8e-80dc-4f42-8700-85c75046900e.jpg', 'dlf-upcoming-project-exteriors-167372075929.jpg', 64, 'project', 618, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(346, 'uploads/pursuit-of-a-radical-rhapsody-(poarr)-landscape-garden-168201441342.jpg', 'properties/65/project/19c8c01b-b3e6-4e99-bb96-c627c7b948ab.jpg', 'pursuit-of-a-radical-rhapsody-(poarr)-landscape-garden-168201441342.jpg', 65, 'project', 619, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(347, 'uploads/pursuit-of-a-radical-rhapsody-(poarr)-exteriors-168201474921.jpg', 'properties/65/project/d6347886-1d90-4f40-b6ce-94559dce1f24.jpg', 'pursuit-of-a-radical-rhapsody-(poarr)-exteriors-168201474921.jpg', 65, 'project', 620, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(348, 'uploads/pursuit-of-a-radical-rhapsody-(poarr)-exteriors-168201474970.jpg', 'properties/65/project/e19c4342-8cc2-4e20-a0c4-900c86d4298b.jpg', 'pursuit-of-a-radical-rhapsody-(poarr)-exteriors-168201474970.jpg', 65, 'project', 621, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(349, 'uploads/pursuit-of-a-radical-rhapsody-(poarr)-exteriors-168201474923.jpg', 'properties/65/project/c00cecab-52e3-4fd0-87ed-9b9fc1da184a.jpg', 'pursuit-of-a-radical-rhapsody-(poarr)-exteriors-168201474923.jpg', 65, 'project', 622, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(350, 'uploads/pursuit-of-a-radical-rhapsody-(poarr)-exteriors-168201474924.jpg', 'properties/65/project/734c839f-d56f-4a7a-acba-890c47fd95db.jpg', 'pursuit-of-a-radical-rhapsody-(poarr)-exteriors-168201474924.jpg', 65, 'project', 623, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(351, 'uploads/pursuit-of-a-radical-rhapsody-(poarr)-interiors-168201479054.jpg', 'properties/65/project/5ce4e752-bcf4-4907-9b3d-9b554cf1b3e4.jpg', 'pursuit-of-a-radical-rhapsody-(poarr)-interiors-168201479054.jpg', 65, 'project', 624, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(352, 'uploads/pursuit-of-a-radical-rhapsody-(poarr)-interiors-168201479048.jpg', 'properties/65/project/42255b20-21fe-4870-8989-6237593b18e4.jpg', 'pursuit-of-a-radical-rhapsody-(poarr)-interiors-168201479048.jpg', 65, 'project', 625, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(353, 'uploads/pursuit-of-a-radical-rhapsody-(poarr)-interiors-168201479017.jpg', 'properties/65/project/80ef44dc-4414-40dd-8a62-afaf031f3724.jpg', 'pursuit-of-a-radical-rhapsody-(poarr)-interiors-168201479017.jpg', 65, 'project', 626, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(354, 'uploads/pursuit-of-a-radical-rhapsody-(poarr)-interiors-168201479066.jpg', 'properties/65/project/67fca3b2-02d5-45cc-8778-eaa2c6f2ebf1.jpg', 'pursuit-of-a-radical-rhapsody-(poarr)-interiors-168201479066.jpg', 65, 'project', 627, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(355, 'uploads/pursuit-of-a-radical-rhapsody-(poarr)-landscape-garden-168201481375.jpg', 'properties/65/project/819ff7e9-9b92-462a-a266-b0c89da5e03a.jpg', 'pursuit-of-a-radical-rhapsody-(poarr)-landscape-garden-168201481375.jpg', 65, 'project', 628, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(356, 'uploads/pursuit-of-a-radical-rhapsody-(poarr)-landscape-garden-16820148136.jpg', 'properties/65/project/f07a6f6d-bcb3-4f98-9d0a-a3393f2d1782.jpg', 'pursuit-of-a-radical-rhapsody-(poarr)-landscape-garden-16820148136.jpg', 65, 'project', 629, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(357, 'uploads/pursuit-of-a-radical-rhapsody-(poarr)-landscape-garden-168201481352.jpg', 'properties/65/project/0bb5147f-d5a1-4133-8dbe-9739928b5ae9.jpg', 'pursuit-of-a-radical-rhapsody-(poarr)-landscape-garden-168201481352.jpg', 65, 'project', 630, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(358, 'uploads/in-that-quiet-earth-(itqe)-lobby-168244853468.jpg', 'properties/66/project/a47fbbc1-608f-481a-a3e2-311126181903.jpg', 'in-that-quiet-earth-(itqe)-lobby-168244853468.jpg', 66, 'project', 631, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(359, 'uploads/in-that-quiet-earth-(itqe)-interiors-16828788859.jpg', 'properties/66/project/8ba229df-ee56-4d25-9ea2-2b9b895a27d6.jpg', 'in-that-quiet-earth-(itqe)-interiors-16828788859.jpg', 66, 'project', 632, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(360, 'uploads/in-that-quiet-earth-(itqe)-interiors-16828788856.jpg', 'properties/66/project/1844f717-b715-48af-9fac-f64e5ce0301c.jpg', 'in-that-quiet-earth-(itqe)-interiors-16828788856.jpg', 66, 'project', 633, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(361, 'uploads/in-that-quiet-earth-(itqe)-interiors-168287888547.jpg', 'properties/66/project/1b8f929c-ea01-4aff-9ec1-43e00dd56961.jpg', 'in-that-quiet-earth-(itqe)-interiors-168287888547.jpg', 66, 'project', 634, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(362, 'uploads/in-that-quiet-earth-(itqe)-swimming-pool-168287891684.jpg', 'properties/66/project/578adaca-efa7-4380-960b-474cb07cb684.jpg', 'in-that-quiet-earth-(itqe)-swimming-pool-168287891684.jpg', 66, 'project', 635, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(363, 'uploads/in-that-quiet-earth-(itqe)-exteriors-168287893827.jpg', 'properties/66/project/b22c9ba6-e494-4833-93da-6e8267e99ff3.jpg', 'in-that-quiet-earth-(itqe)-exteriors-168287893827.jpg', 66, 'project', 636, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(364, 'uploads/in-that-quiet-earth-(itqe)-exteriors-16828789387.jpg', 'properties/66/project/014cdce4-729c-4cce-a233-1f2dfe94c171.jpg', 'in-that-quiet-earth-(itqe)-exteriors-16828789387.jpg', 66, 'project', 637, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(365, 'uploads/in-that-quiet-earth-(itqe)-interiors-168287903276.jpg', 'properties/66/project/5ccdaa70-741b-408d-83c0-ef5f0d5e0bfd.jpg', 'in-that-quiet-earth-(itqe)-interiors-168287903276.jpg', 66, 'project', 638, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(366, 'uploads/3-bhk-apartment-for-sale-exteriors-168293167766.jpg', 'properties/67/project/d133ea46-d015-4648-a3a9-1786489b0fb4.jpg', '3-bhk-apartment-for-sale-exteriors-168293167766.jpg', 67, 'project', 639, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(367, 'uploads/3-bhk-apartment-for-sale-bedroom-168293176916.jpg', 'properties/67/project/1b5360f7-e675-44b1-9418-5f655e4dd2dd.jpg', '3-bhk-apartment-for-sale-bedroom-168293176916.jpg', 67, 'project', 640, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(368, 'uploads/3-bhk-apartment-for-sale-bedroom-16829317692.jpg', 'properties/67/project/88fd2fb7-025b-482f-89e7-f9f3530a5c34.jpg', '3-bhk-apartment-for-sale-bedroom-16829317692.jpg', 67, 'project', 641, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(369, 'uploads/3-bhk-apartment-for-sale-bedroom-168293176914.jpg', 'properties/67/project/a87b2e80-75b2-402f-a0dc-0c1ff3ff17fe.jpg', '3-bhk-apartment-for-sale-bedroom-168293176914.jpg', 67, 'project', 642, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(370, 'uploads/3-bhk-apartment-for-sale-kitchen-168293179340.jpg', 'properties/67/project/8180a0de-b857-488e-84c9-12cbad56f1bc.jpg', '3-bhk-apartment-for-sale-kitchen-168293179340.jpg', 67, 'project', 643, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(371, 'uploads/3-bhk-apartment-for-sale-interiors-168293181377.jpg', 'properties/67/project/3d3b2837-2f3e-4658-96ca-ab053d167441.jpg', '3-bhk-apartment-for-sale-interiors-168293181377.jpg', 67, 'project', 644, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(372, 'uploads/3-bhk-apartment-for-sale-interiors-168293181349.jpg', 'properties/67/project/5a9ba2d8-3c6e-4851-8c93-b1cf584a6bda.jpg', '3-bhk-apartment-for-sale-interiors-168293181349.jpg', 67, 'project', 645, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(373, 'uploads/3-bhk-apartment-for-sale-interiors-168293181374.jpg', 'properties/67/project/dced743a-e3d7-411a-b898-941c0e6076bd.jpg', '3-bhk-apartment-for-sale-interiors-168293181374.jpg', 67, 'project', 646, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(374, 'uploads/3-bhk-apartment-for-sale-exteriors-168293186658.jpg', 'properties/67/project/fbf99ce4-69e9-43a1-ad0d-ab6ddcf37b0f.jpg', '3-bhk-apartment-for-sale-exteriors-168293186658.jpg', 67, 'project', 647, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(375, 'uploads/3-bhk-apartment-for-sale-exteriors-168293186614.jpg', 'properties/67/project/59468dfd-42b6-48cd-a0d4-a7e02e89ba37.jpg', '3-bhk-apartment-for-sale-exteriors-168293186614.jpg', 67, 'project', 648, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(376, 'uploads/3-bhk-apartment-for-sale-exteriors-16829318669.jpg', 'properties/67/project/51467671-01f4-467d-baa4-1e28f1721d97.jpg', '3-bhk-apartment-for-sale-exteriors-16829318669.jpg', 67, 'project', 649, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(377, 'uploads/3-bhk-apartment-for-sale-lobby-168293191571.jpg', 'properties/67/project/efb9d12d-91aa-489a-83be-d2dd6a4bf271.jpg', '3-bhk-apartment-for-sale-lobby-168293191571.jpg', 67, 'project', 650, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(378, 'uploads/villa-for-resale-in-marsierra-exteriors-168294627525.jpg', 'properties/68/project/b18c27d6-56ed-4a58-84dc-c8e7efe59b68.jpg', 'villa-for-resale-in-marsierra-exteriors-168294627525.jpg', 68, 'project', 651, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(379, 'uploads/villa-for-resale-in-marsierra-interiors-16829463313.jpg', 'properties/68/project/e63585f5-9811-4adb-ba87-77ed169af2a4.jpg', 'villa-for-resale-in-marsierra-interiors-16829463313.jpg', 68, 'project', 652, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(380, 'uploads/villa-for-resale-in-marsierra-interiors-168294633184.jpg', 'properties/68/project/a824c45a-36ec-4ea7-bf73-6666f72c1e1f.jpg', 'villa-for-resale-in-marsierra-interiors-168294633184.jpg', 68, 'project', 653, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(381, 'uploads/villa-for-resale-in-marsierra-interiors-168294633190.jpg', 'properties/68/project/da999716-44f3-4706-b089-d8fdf3c4355d.jpg', 'villa-for-resale-in-marsierra-interiors-168294633190.jpg', 68, 'project', 654, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(382, 'uploads/villa-for-resale-in-marsierra-interiors-168294633171.jpg', 'properties/68/project/f81cb28e-7138-4eec-b8d3-0817930359a5.jpg', 'villa-for-resale-in-marsierra-interiors-168294633171.jpg', 68, 'project', 655, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(383, 'uploads/villa-for-resale-in-marsierra-interiors-168294633176.jpg', 'properties/68/project/68f32e7b-10ae-4e71-b658-563b37ffa281.jpg', 'villa-for-resale-in-marsierra-interiors-168294633176.jpg', 68, 'project', 656, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(384, 'uploads/villa-for-resale-in-marsierra-bedroom-168294635111.jpg', 'properties/68/project/b028c5ba-2aa2-4eb8-8f2a-a6dda5a72258.jpg', 'villa-for-resale-in-marsierra-bedroom-168294635111.jpg', 68, 'project', 657, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05');
INSERT INTO `image_redirections` (`id`, `old_path`, `new_path`, `original_filename`, `property_id`, `image_type`, `property_image_id`, `is_active`, `redirect_count`, `last_redirected_at`, `created_at`, `updated_at`) VALUES
(385, 'uploads/villa-for-resale-in-marsierra-bedroom-168294635177.jpg', 'properties/68/project/45784621-62e2-47b3-be4c-ab0ae8f26121.jpg', 'villa-for-resale-in-marsierra-bedroom-168294635177.jpg', 68, 'project', 658, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(386, 'uploads/villa-for-resale-in-marsierra-swimming-pool-168294637170.jpg', 'properties/68/project/b9bdcbf7-8553-4cb4-a982-1099f76ddd13.jpg', 'villa-for-resale-in-marsierra-swimming-pool-168294637170.jpg', 68, 'project', 659, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(387, 'uploads/villa-for-resale-in-marsierra-swimming-pool-168294637121.jpg', 'properties/68/project/fd8f5a66-7f7c-472f-91ca-6ac27528891b.jpg', 'villa-for-resale-in-marsierra-swimming-pool-168294637121.jpg', 68, 'project', 660, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(388, 'uploads/villa-for-resale-in-marsierra-landscape-garden-168294642960.jpg', 'properties/68/project/2bc043f7-b9e8-42bc-8b2d-3dd233b16c0c.jpg', 'villa-for-resale-in-marsierra-landscape-garden-168294642960.jpg', 68, 'project', 661, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(389, 'uploads/villa-for-resale-in-marsierra-landscape-garden-168294642932.jpg', 'properties/68/project/0c95166d-3576-4dca-912c-1d53563d9f8c.jpg', 'villa-for-resale-in-marsierra-landscape-garden-168294642932.jpg', 68, 'project', 662, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(390, 'uploads/code-66-interiors-168338569321.jpg', 'properties/69/project/526379ec-3ea8-4845-a7cf-141d6cb935ae.jpg', 'code-66-interiors-168338569321.jpg', 69, 'project', 663, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(391, 'uploads/code-66-interiors-168338572256.jpg', 'properties/69/project/351809f1-e850-42e7-8a36-e8f851517688.jpg', 'code-66-interiors-168338572256.jpg', 69, 'project', 664, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(392, 'uploads/code-66-interiors-168338572281.jpg', 'properties/69/project/6f93fedc-5c6c-499b-b9cd-d2c08954dced.jpg', 'code-66-interiors-168338572281.jpg', 69, 'project', 665, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(393, 'uploads/code-66-interiors-168338572217.jpg', 'properties/69/project/3513c717-4c96-48ee-94b7-3023bcfe355d.jpg', 'code-66-interiors-168338572217.jpg', 69, 'project', 666, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(394, 'uploads/code-66-bathroom-168338573747.jpg', 'properties/69/project/43906c26-4f16-484e-a0d0-7d778e3dd8aa.jpg', 'code-66-bathroom-168338573747.jpg', 69, 'project', 667, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(395, 'uploads/code-66-bathroom-168338573765.jpg', 'properties/69/project/dee3a881-594d-47fc-9e92-8ef123a4ab0c.jpg', 'code-66-bathroom-168338573765.jpg', 69, 'project', 668, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(396, 'uploads/code-66-kitchen-168338574889.jpg', 'properties/69/project/98424227-8bcf-405c-89e7-99fdcc340693.jpg', 'code-66-kitchen-168338574889.jpg', 69, 'project', 669, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(397, 'uploads/code-66-bedroom-168338586055.jpg', 'properties/69/project/aea5feb2-ca71-4d1e-9a96-dee52ff6dcca.jpg', 'code-66-bedroom-168338586055.jpg', 69, 'project', 670, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(398, 'uploads/smart-world-one-dxp-exteriors-168517401439.jpg', 'properties/70/project/e0888b1b-1509-4ed4-bd68-bedaae6d3f88.jpg', 'smart-world-one-dxp-exteriors-168517401439.jpg', 70, 'project', 671, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(399, 'uploads/conscient-vista-arrozal-exteriors-168734013263.jpg', 'properties/71/project/c8545e2c-31ae-4f16-8d02-aeea0b4b3077.jpg', 'conscient-vista-arrozal-exteriors-168734013263.jpg', 71, 'project', 672, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(400, 'uploads/conscient-vista-arrozal-bathroom-168734016990.jpg', 'properties/71/project/c4ff0d3d-757f-491f-8ed0-3df180701e49.jpg', 'conscient-vista-arrozal-bathroom-168734016990.jpg', 71, 'project', 673, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(401, 'uploads/conscient-vista-arrozal-bedroom-168734018586.jpg', 'properties/71/project/ef889618-e70b-4954-a50d-d632392c8e2b.jpg', 'conscient-vista-arrozal-bedroom-168734018586.jpg', 71, 'project', 674, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(402, 'uploads/conscient-vista-arrozal-swimming-pool-168734022026.jpg', 'properties/71/project/bbe995be-7340-467b-8089-9d4e19888ac9.jpg', 'conscient-vista-arrozal-swimming-pool-168734022026.jpg', 71, 'project', 675, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(403, 'uploads/conscient-vista-arrozal-kitchen-168734023938.jpg', 'properties/71/project/dec4116b-ff66-4718-b64f-58cc34ce773d.jpg', 'conscient-vista-arrozal-kitchen-168734023938.jpg', 71, 'project', 676, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(404, 'uploads/conscient-vista-arrozal-exteriors-168734030250.jpg', 'properties/71/project/1bbbd9df-7209-44ee-a174-91efa8d5a8df.jpg', 'conscient-vista-arrozal-exteriors-168734030250.jpg', 71, 'project', 677, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(405, 'uploads/conscient-vista-arrozal-exteriors-168734030230.jpg', 'properties/71/project/63eaac16-cfb9-42c6-86f2-22ecede5ff8c.jpg', 'conscient-vista-arrozal-exteriors-168734030230.jpg', 71, 'project', 678, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(406, 'uploads/conscient-vista-arrozal-exteriors-168734030262.jpg', 'properties/71/project/f08b7bd4-07ae-4bea-a30a-fea2ceab935c.jpg', 'conscient-vista-arrozal-exteriors-168734030262.jpg', 71, 'project', 679, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(407, 'uploads/conscient-vista-arrozal-exteriors-168734030279.jpg', 'properties/71/project/39f68b9a-62e2-46dc-9d9e-d08cfeae6d29.jpg', 'conscient-vista-arrozal-exteriors-168734030279.jpg', 71, 'project', 680, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(408, 'uploads/emaar-urban-oasis-exteriors-168762858975.jpg', 'properties/72/project/b3737fb0-b1ea-4b69-b2eb-9b36c3f3c953.jpg', 'emaar-urban-oasis-exteriors-168762858975.jpg', 72, 'project', 681, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(409, 'uploads/m3m-crown-exteriors-168819711427.jpg', 'properties/73/project/0a62d6ba-c1a3-4924-a92c-b28608170a7d.jpg', 'm3m-crown-exteriors-168819711427.jpg', 73, 'project', 682, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(410, 'uploads/m3m-crown-interiors-168820091114.jpg', 'properties/73/project/f489d8b1-1370-4d48-a6ca-5e0b7d9b49c4.jpg', 'm3m-crown-interiors-168820091114.jpg', 73, 'project', 683, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(411, 'uploads/m3m-crown-interiors-168820091175.jpg', 'properties/73/project/05c4bf95-f301-4546-906b-f6afa14cc63d.jpg', 'm3m-crown-interiors-168820091175.jpg', 73, 'project', 684, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(412, 'uploads/m3m-crown-bedroom-168820092831.jpg', 'properties/73/project/15d7109c-fa14-4926-9ece-a38a2129e835.jpg', 'm3m-crown-bedroom-168820092831.jpg', 73, 'project', 685, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(413, 'uploads/m3m-crown-exteriors-168820099228.jpg', 'properties/73/project/0a6131ee-9b0a-40a9-860b-ac5d5d7b3110.jpg', 'm3m-crown-exteriors-168820099228.jpg', 73, 'project', 686, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(414, 'uploads/m3m-crown-exteriors-168820099214.jpg', 'properties/73/project/b1d12259-149b-45f8-a89e-0220ba0d97fc.jpg', 'm3m-crown-exteriors-168820099214.jpg', 73, 'project', 687, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(415, 'uploads/m3m-crown-exteriors-168820099264.jpg', 'properties/73/project/1f0fda2f-9984-49cd-ac88-7e453c8d13a7.jpg', 'm3m-crown-exteriors-168820099264.jpg', 73, 'project', 688, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(416, 'uploads/m3m-crown-lobby-168820100872.jpg', 'properties/73/project/7edc69f1-e88f-4fd3-b2e2-7b149bf46ec3.jpg', 'm3m-crown-lobby-168820100872.jpg', 73, 'project', 689, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(417, 'uploads/purva-zenium-exteriors-168849572543.jpg', 'properties/74/project/69e77771-b024-4b7a-827b-134ab3528204.jpg', 'purva-zenium-exteriors-168849572543.jpg', 74, 'project', 690, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(418, 'uploads/purva-zenium-landscape-garden-168849574856.jpg', 'properties/74/project/c5041626-4104-4518-9ccd-dbe38129b200.jpg', 'purva-zenium-landscape-garden-168849574856.jpg', 74, 'project', 691, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(419, 'uploads/purva-zenium-landscape-garden-168849574865.jpg', 'properties/74/project/61c6075c-42eb-4f1f-9fcb-f57eae197e4c.jpg', 'purva-zenium-landscape-garden-168849574865.jpg', 74, 'project', 692, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(420, 'uploads/purva-zenium-exteriors-168849576412.jpg', 'properties/74/project/084a3a36-ce17-4afa-b1ac-8d579cf2755c.jpg', 'purva-zenium-exteriors-168849576412.jpg', 74, 'project', 693, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(421, 'uploads/purva-meraki-exteriors-168966970764.jpg', 'properties/75/project/9443abd6-cc3c-46f0-9ab0-ff85f49be9b7.jpg', 'purva-meraki-exteriors-168966970764.jpg', 75, 'project', 694, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(422, 'uploads/purva-meraki-bedroom-169000463010.jpg', 'properties/75/project/a864e6ef-9859-438e-8070-d44c184b63d4.jpg', 'purva-meraki-bedroom-169000463010.jpg', 75, 'project', 695, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(423, 'uploads/purva-meraki-bedroom-169000463071.jpg', 'properties/75/project/d79a64db-b14e-42f6-b8de-2139cacfafe1.jpg', 'purva-meraki-bedroom-169000463071.jpg', 75, 'project', 696, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(424, 'uploads/purva-meraki-kitchen-169000464847.jpg', 'properties/75/project/93db60df-7f41-4bdd-ad27-2a369310257f.jpg', 'purva-meraki-kitchen-169000464847.jpg', 75, 'project', 697, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(425, 'uploads/purva-meraki-interiors-169000467455.jpg', 'properties/75/project/cb6c4530-9a1b-4dd4-bca9-5ed75080ecbe.jpg', 'purva-meraki-interiors-169000467455.jpg', 75, 'project', 698, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(426, 'uploads/purva-meraki-exteriors-169000469455.jpg', 'properties/75/project/2382d8dd-aa50-4bc6-8cec-9732b624cab0.jpg', 'purva-meraki-exteriors-169000469455.jpg', 75, 'project', 699, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(427, 'uploads/prestige-park-grove-front-view-168987935181.jpg', 'properties/76/project/dae9e5e6-942a-49f7-a4bd-2ffad45f3719.jpg', 'prestige-park-grove-front-view-168987935181.jpg', 76, 'project', 700, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(428, 'uploads/prestige-park-grove-interiors-169160130316.jpg', 'properties/76/project/80df80d8-1467-4503-84a5-ec6e2efefc03.jpg', 'prestige-park-grove-interiors-169160130316.jpg', 76, 'project', 701, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(429, 'uploads/prestige-park-grove-interiors-169160130344.jpg', 'properties/76/project/e230fc8c-ee55-4221-8ed6-902290be9647.jpg', 'prestige-park-grove-interiors-169160130344.jpg', 76, 'project', 702, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(430, 'uploads/prestige-park-grove-interiors-169160130366.jpg', 'properties/76/project/e04f381c-8c24-486e-b2c9-49fc30690452.jpg', 'prestige-park-grove-interiors-169160130366.jpg', 76, 'project', 703, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(431, 'uploads/prestige-park-grove-interiors-169160130358.jpg', 'properties/76/project/d10b8c40-f9ae-4351-805b-1960126f0fb0.jpg', 'prestige-park-grove-interiors-169160130358.jpg', 76, 'project', 704, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(432, 'uploads/prestige-park-grove-interiors-169160130342.jpg', 'properties/76/project/20f04d23-6041-43ae-9aaf-20e823c4d01b.jpg', 'prestige-park-grove-interiors-169160130342.jpg', 76, 'project', 705, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(433, 'uploads/sobha-manhattan-towers-exteriors-169160513160.jpg', 'properties/77/project/dd6e1cac-d76c-4a59-b79f-d5047c064dc1.jpg', 'sobha-manhattan-towers-exteriors-169160513160.jpg', 77, 'project', 706, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(434, 'uploads/m3m-altitude-exteriors-171575982284.jpg', 'properties/78/project/5eca8e2b-0964-47ce-bc0e-b8021f49cd4c.jpg', 'm3m-altitude-exteriors-171575982284.jpg', 78, 'project', 707, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(435, 'uploads/m3m-altitude-interiors-171575986975.jpg', 'properties/78/project/aa2ed677-8909-4c39-b0e5-4e1fcbdafa79.jpg', 'm3m-altitude-interiors-171575986975.jpg', 78, 'project', 708, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(436, 'uploads/m3m-altitude-interiors-171575986954.jpg', 'properties/78/project/1521c9ef-ed95-495e-b7fd-dd4a02220d10.jpg', 'm3m-altitude-interiors-171575986954.jpg', 78, 'project', 709, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(437, 'uploads/m3m-altitude-exteriors-17157599035.jpg', 'properties/78/project/a85c8f96-1cf3-4f80-9abb-1602ca24e956.jpg', 'm3m-altitude-exteriors-17157599035.jpg', 78, 'project', 710, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(438, 'uploads/m3m-altitude-exteriors-171575990390.jpg', 'properties/78/project/001c6d54-1c57-488f-bbe3-52b2ae4f3547.jpg', 'm3m-altitude-exteriors-171575990390.jpg', 78, 'project', 711, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(439, 'uploads/m3m-altitude-exteriors-171575990388.jpg', 'properties/78/project/739b8f81-2c3b-4e96-9799-960d9defc90d.jpg', 'm3m-altitude-exteriors-171575990388.jpg', 78, 'project', 712, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(440, 'uploads/m3m-altitude-exteriors-171575990348.jpg', 'properties/78/project/15d93a02-332e-4210-916d-c725f75c5a9c.jpg', 'm3m-altitude-exteriors-171575990348.jpg', 78, 'project', 713, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(441, 'uploads/m3m-altitude-front-view-171575992443.jpg', 'properties/78/project/c443a17c-1437-4d37-9236-578f5e8a8f0b.jpg', 'm3m-altitude-front-view-171575992443.jpg', 78, 'project', 714, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(442, 'uploads/4-bhk-vianaar-standalone-luxury-indo-portuguese-villa-exteriors-171731310773.jpg', 'properties/79/project/71da2847-c6e4-49de-8aaf-e1455822d19b.jpg', '4-bhk-vianaar-standalone-luxury-indo-portuguese-villa-exteriors-171731310773.jpg', 79, 'project', 715, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(443, 'uploads/4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731314410.jpg', 'properties/79/project/e1674971-8072-4fa6-96b3-40506043c22d.jpg', '4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731314410.jpg', 79, 'project', 716, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(444, 'uploads/4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731314439.jpg', 'properties/79/project/8d7de66d-d6f4-4275-b6e9-117ad0825215.jpg', '4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731314439.jpg', 79, 'project', 717, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(445, 'uploads/4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--17173131445.jpg', 'properties/79/project/e830fd83-f0c9-4659-b616-6d7b0eebd79b.jpg', '4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--17173131445.jpg', 79, 'project', 718, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(446, 'uploads/4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731314433.jpg', 'properties/79/project/14b71be6-c3eb-4cfa-9289-3beb611d9ee9.jpg', '4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731314433.jpg', 79, 'project', 719, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(447, 'uploads/4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731314485.jpg', 'properties/79/project/74e26379-4e8a-4d9b-963f-ac828a2286f6.jpg', '4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731314485.jpg', 79, 'project', 720, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(448, 'uploads/4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731314466.jpg', 'properties/79/project/bc98d397-2565-41ff-92d5-ef0750bfcacd.jpg', '4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731314466.jpg', 79, 'project', 721, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(449, 'uploads/4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731314428.jpg', 'properties/79/project/a2fcdb0e-d911-4b44-8f8a-156b6531d4b8.jpg', '4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731314428.jpg', 79, 'project', 722, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(450, 'uploads/4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731320085.jpg', 'properties/79/project/b0167828-488e-4362-9aa5-c4d21fe90563.jpg', '4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731320085.jpg', 79, 'project', 723, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(451, 'uploads/4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731320054.jpg', 'properties/79/project/681cbf5d-6ec9-4417-9934-7b4d0281265f.jpg', '4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731320054.jpg', 79, 'project', 724, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(452, 'uploads/4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731320088.jpg', 'properties/79/project/3e65fab2-3bf2-4705-bec0-de0ac411fd0e.jpg', '4-bhk-vianaar-standalone-luxury-indo-portuguese-villa--171731320088.jpg', 79, 'project', 725, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(453, 'uploads/dlf-privana-south-exteriors-171774924430.jpg', 'properties/80/project/c60d39b2-a146-4896-bc0d-06bdb3829212.jpg', 'dlf-privana-south-exteriors-171774924430.jpg', 80, 'project', 726, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(454, 'uploads/dlf-privana-south--171775121262.jpg', 'properties/80/project/a2c2600e-dc4f-4b69-b8a9-47f8eb94fc7d.jpg', 'dlf-privana-south--171775121262.jpg', 80, 'project', 727, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(455, 'uploads/dlf-privana-south--171775121263.jpg', 'properties/80/project/8dec97de-bdbd-445d-8be2-b16e7b4a949d.jpg', 'dlf-privana-south--171775121263.jpg', 80, 'project', 728, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(456, 'uploads/dlf-privana-south--17177512124.jpg', 'properties/80/project/e2675844-ff74-431b-86fc-96be48149c4d.jpg', 'dlf-privana-south--17177512124.jpg', 80, 'project', 729, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(457, 'uploads/dlf-privana-west-front-view-171968560661.jpg', 'properties/81/project/57156f15-57bd-4f94-8a69-ee09f770c2a5.jpg', 'dlf-privana-west-front-view-171968560661.jpg', 81, 'project', 730, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(458, 'uploads/dlf-villas-reis-magos-exteriors-172155888013.jpg', 'properties/82/project/a888aa8d-dd0c-49d8-b645-5ca16cc9c448.jpg', 'dlf-villas-reis-magos-exteriors-172155888013.jpg', 82, 'project', 731, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(459, 'uploads/dlf-villas-reis-magos-exteriors-172216915851.jpg', 'properties/82/project/44dc09fc-ca15-4c95-a089-7a937fd35f84.jpg', 'dlf-villas-reis-magos-exteriors-172216915851.jpg', 82, 'project', 732, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(460, 'uploads/dlf-villas-reis-magos-exteriors-17221691583.jpg', 'properties/82/project/691539fd-0ec2-4d2b-b6e6-ccc8316cfa7d.jpg', 'dlf-villas-reis-magos-exteriors-17221691583.jpg', 82, 'project', 733, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(461, 'uploads/dlf-villas-reis-magos-exteriors-172216915878.jpg', 'properties/82/project/f9410cb7-c45b-4315-ad24-f7e1f576bc0b.jpg', 'dlf-villas-reis-magos-exteriors-172216915878.jpg', 82, 'project', 734, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(462, 'uploads/dlf-villas-reis-magos-exteriors-172216915855.jpg', 'properties/82/project/1d54f8a8-ba08-4492-8c5b-c926440f8664.jpg', 'dlf-villas-reis-magos-exteriors-172216915855.jpg', 82, 'project', 735, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(463, 'uploads/dlf-villas-reis-magos-exteriors-172216915819.jpg', 'properties/82/project/39197d1e-ad06-482c-8bda-124e86f8c546.jpg', 'dlf-villas-reis-magos-exteriors-172216915819.jpg', 82, 'project', 736, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(464, 'uploads/dlf-villas-reis-magos-exteriors-172216915841.jpg', 'properties/82/project/3e75d191-a55f-47bc-9747-c406b790ec46.jpg', 'dlf-villas-reis-magos-exteriors-172216915841.jpg', 82, 'project', 737, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(465, 'uploads/dlf-villas-reis-magos-exteriors-172216915836.jpg', 'properties/82/project/2fa5f10a-1c2c-4c66-8b32-fff89396674b.jpg', 'dlf-villas-reis-magos-exteriors-172216915836.jpg', 82, 'project', 738, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(466, 'uploads/tarc-ishva-exteriors-172702615645.jpg', 'properties/83/project/8c876490-28da-4c02-9fc7-b163550de4d7.jpg', 'tarc-ishva-exteriors-172702615645.jpg', 83, 'project', 739, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(467, 'uploads/tarc-ishva-exteriors-172702654770.jpg', 'properties/83/project/046d2e24-dc67-4515-80c7-c9377b56c2f4.jpg', 'tarc-ishva-exteriors-172702654770.jpg', 83, 'project', 740, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(468, 'uploads/tarc-ishva-exteriors-172702654771.jpg', 'properties/83/project/c96a64c7-0483-4e6c-99bd-5bbe8880c17b.jpg', 'tarc-ishva-exteriors-172702654771.jpg', 83, 'project', 741, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(469, 'uploads/tarc-ishva-exteriors-172702654762.jpg', 'properties/83/project/991c870a-a56b-4afe-8975-d75c162dabca.jpg', 'tarc-ishva-exteriors-172702654762.jpg', 83, 'project', 742, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(470, 'uploads/tarc-ishva-interiors-17270265658.jpg', 'properties/83/project/14ec0da3-935b-44b0-93ce-3c5e95e712d1.jpg', 'tarc-ishva-interiors-17270265658.jpg', 83, 'project', 743, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(471, 'uploads/tarc-ishva-exteriors-172702660037.jpg', 'properties/83/project/861698eb-8d59-4129-b6b3-27b20e0f3ba7.jpg', 'tarc-ishva-exteriors-172702660037.jpg', 83, 'project', 744, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(472, 'uploads/silverglades---the-legacy-exteriors-172702743053.jpg', 'properties/84/project/b8752d3e-64da-482f-aceb-4f294f00cc19.jpg', 'silverglades---the-legacy-exteriors-172702743053.jpg', 84, 'project', 745, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(473, 'uploads/silverglades---the-legacy-exteriors-172702745820.jpg', 'properties/84/project/25c91f1e-b129-43b4-a7bf-ac20dd2055bc.jpg', 'silverglades---the-legacy-exteriors-172702745820.jpg', 84, 'project', 746, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(474, 'uploads/silverglades---the-legacy-exteriors-172702745811.jpg', 'properties/84/project/4ee7c1c7-651d-4f88-b546-3df2034d7203.jpg', 'silverglades---the-legacy-exteriors-172702745811.jpg', 84, 'project', 747, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(475, 'uploads/silverglades---the-legacy-exteriors-172702745861.jpg', 'properties/84/project/5585da60-044a-4f56-8a31-ed2c2d26232b.jpg', 'silverglades---the-legacy-exteriors-172702745861.jpg', 84, 'project', 748, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(476, 'uploads/silverglades---the-legacy-exteriors-172702745877.jpg', 'properties/84/project/fb98c651-a96f-4532-b788-af7b7e879381.jpg', 'silverglades---the-legacy-exteriors-172702745877.jpg', 84, 'project', 749, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(477, 'uploads/silverglades---the-legacy-exteriors-172702745815.jpg', 'properties/84/project/9be9756a-1371-44a0-8264-75f32538a34b.jpg', 'silverglades---the-legacy-exteriors-172702745815.jpg', 84, 'project', 750, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(478, 'uploads/silverglades---the-legacy-exteriors-172702745875.jpg', 'properties/84/project/783d40fe-89c4-40cf-bd1d-a0057c572dd8.jpg', 'silverglades---the-legacy-exteriors-172702745875.jpg', 84, 'project', 751, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(479, 'uploads/silverglades---the-legacy-kitchen-172702747660.jpg', 'properties/84/project/eaa2c1ac-d8db-4187-80f4-1d4ba1ab255b.jpg', 'silverglades---the-legacy-kitchen-172702747660.jpg', 84, 'project', 752, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(480, 'uploads/silverglades---the-legacy-bedroom-172702749359.jpg', 'properties/84/project/5584fe2e-577d-4ea8-9b19-11e4ecabeac0.jpg', 'silverglades---the-legacy-bedroom-172702749359.jpg', 84, 'project', 753, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(481, 'uploads/silverglades---the-legacy-interiors-17270275126.jpg', 'properties/84/project/f8cb3515-f49d-4a3b-bafe-754e413bd46f.jpg', 'silverglades---the-legacy-interiors-17270275126.jpg', 84, 'project', 754, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(482, 'uploads/silverglades---the-legacy-interiors-172702751229.jpg', 'properties/84/project/c46ca6a0-fccf-4287-8f61-914998d9c380.jpg', 'silverglades---the-legacy-interiors-172702751229.jpg', 84, 'project', 755, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(483, 'uploads/silverglades---the-legacy-interiors-172702751227.jpg', 'properties/84/project/4f03f998-7a95-4319-83b0-92a169e7a74e.jpg', 'silverglades---the-legacy-interiors-172702751227.jpg', 84, 'project', 756, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(484, 'uploads/3-bhk-field-view-villa-in-morjim-exteriors-172702842586.jpg', 'properties/85/project/8ab55efe-1f92-44cf-9518-27b430dd86c3.jpg', '3-bhk-field-view-villa-in-morjim-exteriors-172702842586.jpg', 85, 'project', 757, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(485, 'uploads/3-bhk-field-view-villa-in-morjim-exteriors-172702842575.jpg', 'properties/85/project/f84907d9-2d22-410b-8809-4c73b6328fda.jpg', '3-bhk-field-view-villa-in-morjim-exteriors-172702842575.jpg', 85, 'project', 758, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(486, 'uploads/3-bhk-field-view-villa-in-morjim-exteriors-172702842565.jpg', 'properties/85/project/5609caf5-3abe-4e47-aa1f-b6d727c10a33.jpg', '3-bhk-field-view-villa-in-morjim-exteriors-172702842565.jpg', 85, 'project', 759, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(487, 'uploads/4-bhk-fully-furnished-villa-in-mandrem-exteriors-172702890521.jpg', 'properties/86/project/c0c4a7a7-3030-4f4f-acd8-0e89fb830c7b.jpg', '4-bhk-fully-furnished-villa-in-mandrem-exteriors-172702890521.jpg', 86, 'project', 760, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(488, 'uploads/4-bhk-fully-furnished-villa-in-mandrem-bedroom-172702892671.jpg', 'properties/86/project/8715d64b-5534-41e2-bc1b-887c205cc477.jpg', '4-bhk-fully-furnished-villa-in-mandrem-bedroom-172702892671.jpg', 86, 'project', 761, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(489, 'uploads/4-bhk-fully-furnished-villa-in-mandrem-bedroom-172702892658.jpg', 'properties/86/project/7ceb106b-f98f-4179-9c94-ccb7e2c4fa03.jpg', '4-bhk-fully-furnished-villa-in-mandrem-bedroom-172702892658.jpg', 86, 'project', 762, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(490, 'uploads/4-bhk-fully-furnished-villa-in-mandrem-bedroom-172702892645.jpg', 'properties/86/project/f91717a3-d513-48a2-83b4-5eb27b2f9497.jpg', '4-bhk-fully-furnished-villa-in-mandrem-bedroom-172702892645.jpg', 86, 'project', 763, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(491, 'uploads/4-bhk-fully-furnished-villa-in-mandrem-bedroom-172702892677.jpg', 'properties/86/project/a4578684-f08f-479a-8cfe-083d701114c2.jpg', '4-bhk-fully-furnished-villa-in-mandrem-bedroom-172702892677.jpg', 86, 'project', 764, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(492, 'uploads/4-bhk-fully-furnished-villa-in-mandrem-bedroom-172702892690.jpg', 'properties/86/project/fbd574f4-6d5f-4864-91d0-50951aa7e14c.jpg', '4-bhk-fully-furnished-villa-in-mandrem-bedroom-172702892690.jpg', 86, 'project', 765, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(493, 'uploads/4-bhk-fully-furnished-villa-in-mandrem-kitchen-172702893973.jpg', 'properties/86/project/64fcbfda-3318-4733-bd11-ea7c60e81f85.jpg', '4-bhk-fully-furnished-villa-in-mandrem-kitchen-172702893973.jpg', 86, 'project', 766, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(494, 'uploads/4-bhk-fully-furnished-villa-in-mandrem-bathroom-172702895022.jpg', 'properties/86/project/6b5fed28-2ca6-40c8-a675-6643e0f1c2f5.jpg', '4-bhk-fully-furnished-villa-in-mandrem-bathroom-172702895022.jpg', 86, 'project', 767, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(495, 'uploads/dlf-the-dahlias-exteriors-173281430279.jpg', 'properties/87/project/cc31718c-d54e-4e74-b003-9077daac9f92.jpg', 'dlf-the-dahlias-exteriors-173281430279.jpg', 87, 'project', 768, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(496, 'uploads/dlf-the-dahlias-bedroom-173281432376.jpg', 'properties/87/project/71422f1d-2a75-4bcc-a90b-d86ca58514a0.jpg', 'dlf-the-dahlias-bedroom-173281432376.jpg', 87, 'project', 769, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(497, 'uploads/dlf-the-dahlias-bedroom-173281432379.jpg', 'properties/87/project/9d5ba98e-8877-4f4d-80cf-91310ae2a210.jpg', 'dlf-the-dahlias-bedroom-173281432379.jpg', 87, 'project', 770, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(498, 'uploads/dlf-the-dahlias-bathroom-173281434056.jpg', 'properties/87/project/5a446c6a-e92e-4807-a389-c35b1d60975f.jpg', 'dlf-the-dahlias-bathroom-173281434056.jpg', 87, 'project', 771, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(499, 'uploads/dlf-the-dahlias-interiors-173281437342.jpg', 'properties/87/project/5114e95a-95d7-413a-89d8-c989721f1ba1.jpg', 'dlf-the-dahlias-interiors-173281437342.jpg', 87, 'project', 772, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(500, 'uploads/dlf-the-dahlias-interiors-173281437312.jpg', 'properties/87/project/d3680670-5d67-4e83-bf5e-3a640c4671aa.jpg', 'dlf-the-dahlias-interiors-173281437312.jpg', 87, 'project', 773, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(501, 'uploads/dlf-the-dahlias-interiors-173281437353.jpg', 'properties/87/project/0233842f-0e71-4a86-891f-dca4386b1c2e.jpg', 'dlf-the-dahlias-interiors-173281437353.jpg', 87, 'project', 774, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(502, 'uploads/dlf-the-dahlias-lobby-173281438673.jpg', 'properties/87/project/0e53d981-6db6-4b85-9300-fb41b468bf1d.jpg', 'dlf-the-dahlias-lobby-173281438673.jpg', 87, 'project', 775, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(503, 'uploads/trump-towers-2-front-view-173700817069.jpg', 'properties/88/project/8238fbb6-e1ff-46bc-945d-71028f0348d9.jpg', 'trump-towers-2-front-view-173700817069.jpg', 88, 'project', 776, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(504, 'uploads/trump-towers-2-interiors-174369334957.jpg', 'properties/88/project/e2a85481-de54-4c76-bd7f-e78abb8a04e7.jpg', 'trump-towers-2-interiors-174369334957.jpg', 88, 'project', 777, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(505, 'uploads/trump-towers-2-interiors-174369334937.jpg', 'properties/88/project/d423cc1c-dcf8-475d-831a-938278e874e6.jpg', 'trump-towers-2-interiors-174369334937.jpg', 88, 'project', 778, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(506, 'uploads/trump-towers-2-interiors-174369365074.jpg', 'properties/88/project/efd91c8d-32ea-42d2-b35a-cbf3856eff9e.jpg', 'trump-towers-2-interiors-174369365074.jpg', 88, 'project', 779, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(507, 'uploads/trump-towers-2-interiors-174369367229.jpg', 'properties/88/project/d685c7aa-de21-44c7-8d74-c151cca9cca5.jpg', 'trump-towers-2-interiors-174369367229.jpg', 88, 'project', 780, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(508, 'uploads/trump-towers-2-interiors-174369367231.jpg', 'properties/88/project/2be5a70d-5c9f-473e-993e-29c467b9824e.jpg', 'trump-towers-2-interiors-174369367231.jpg', 88, 'project', 781, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(509, 'uploads/trump-towers-2-interiors-174369367260.jpg', 'properties/88/project/e03c6336-278d-4a58-8bf8-1d53ac527faa.jpg', 'trump-towers-2-interiors-174369367260.jpg', 88, 'project', 782, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(510, 'uploads/trump-towers-2-interiors-17436936724.jpg', 'properties/88/project/9d98fcaa-eb5f-4ba0-a329-8be70e615695.jpg', 'trump-towers-2-interiors-17436936724.jpg', 88, 'project', 783, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(511, 'uploads/trump-towers-2-exteriors-174369368351.jpg', 'properties/88/project/27c9bfd9-e0dc-44b9-abcd-661c4bf61980.jpg', 'trump-towers-2-exteriors-174369368351.jpg', 88, 'project', 784, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(512, 'uploads/lodha-hosa-road-exteriors-173964274922.jpg', 'properties/89/project/1eb92c47-5d97-402b-b9e1-c91d6d48c915.jpg', 'lodha-hosa-road-exteriors-173964274922.jpg', 89, 'project', 785, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(513, 'uploads/lodha-hosa-road-exteriors-173964276765.jpg', 'properties/89/project/9eecf71a-674d-49eb-bf16-2e26f3bb6ac4.jpg', 'lodha-hosa-road-exteriors-173964276765.jpg', 89, 'project', 786, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(514, 'uploads/lodha-hosa-road-exteriors-17396427671.jpg', 'properties/89/project/3a57e697-e88f-4a15-850f-aa283fd2f992.jpg', 'lodha-hosa-road-exteriors-17396427671.jpg', 89, 'project', 787, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(515, 'uploads/lodha-hosa-road-exteriors-173964276755.jpg', 'properties/89/project/822b0695-6453-404f-a8e5-bb0a876cae64.jpg', 'lodha-hosa-road-exteriors-173964276755.jpg', 89, 'project', 788, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(516, 'uploads/adani-samsara-ivana-exteriors-175450450071.jpg', 'properties/90/project/de1419e1-6bfc-4b2a-83ab-5b003d406de3.jpg', 'adani-samsara-ivana-exteriors-175450450071.jpg', 90, 'project', 789, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(517, 'uploads/adani-samsara-ivana-landscape-garden-17545045239.jpg', 'properties/90/project/26ea2d89-d50d-4508-aa06-3e18e1fc7703.jpg', 'adani-samsara-ivana-landscape-garden-17545045239.jpg', 90, 'project', 790, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(518, 'uploads/adani-samsara-ivana-landscape-garden-175450452348.jpg', 'properties/90/project/ec4e4ead-897a-4d15-9714-cf9d30efcdd8.jpg', 'adani-samsara-ivana-landscape-garden-175450452348.jpg', 90, 'project', 791, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(519, 'uploads/adani-samsara-ivana-front-view-175450455441.jpg', 'properties/90/project/81747ed4-cf0b-4480-baf3-ce5db1bd4623.jpg', 'adani-samsara-ivana-front-view-175450455441.jpg', 90, 'project', 792, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(520, 'uploads/adani-samsara-ivana-front-view-175450455421.jpg', 'properties/90/project/29472521-8440-42e5-83bd-bf015a2662b3.jpg', 'adani-samsara-ivana-front-view-175450455421.jpg', 90, 'project', 793, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(521, 'uploads/adani-samsara-ivana-swimming-pool-175450458130.jpg', 'properties/90/project/d38d18ac-1d1a-4c6e-b831-198bbf82b8b4.jpg', 'adani-samsara-ivana-swimming-pool-175450458130.jpg', 90, 'project', 794, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05'),
(522, 'uploads/adani-samsara-ivana-lobby-175450459759.jpg', 'properties/90/project/555642d8-1c14-4389-b672-e68ef3f61633.jpg', 'adani-samsara-ivana-lobby-175450459759.jpg', 90, 'project', 795, 1, 0, NULL, '2025-10-01 02:28:05', '2025-10-01 02:28:05');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `slug`, `sort_order`, `meta_title`, `meta_description`, `heading`, `site_description`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Gurgaon', 'gurgaon', 1, 'Luxury Property in Gurgaon for Sale - Property in Gurgaon', 'Discover exclusive luxury properties for sale in Gurgaon, perfect for modern living and investment. Check photo\'s, price list, and property details. Schedule a free site visit today!', 'Luxury Property in Gurgaon', 'Step into a world of sophistication with our curated selection of luxury properties in Gurgaon. From exquisite independent villas to stunning apartments and commercial spaces, each property is crafted to perfection by renowned developers like DLF, Godrej Properties, M3M, and SmartWorld Developers. Whether you\'re seeking a serene residential haven or a prestigious business address, we offer options that redefine luxury living. Explore prime locations, state-of-the-art amenities, and architectural brilliance that match your elevated lifestyle. Begin your journey to finding the perfect property today!', 'locations/1cf4387e9f14cf0692a0dc010cd07145.jpg', 1, '2025-09-30 13:09:47', '2025-09-30 13:09:47'),
(2, 'Delhi', 'delhi', 2, 'Luxury Properties for Sale in Delhi | Property in Delhi', 'Luxury Properties for Sale in Delhi - Explore luxury properties for sale in Delhi, offering premium living experiences in prime locations. Book free site visit!', 'Luxury Properties for Sale in Delhi', 'Discover the finest luxury properties in New Delhi, designed for those who demand nothing but the best. From regal independent homes to plush apartments and commercial landmarks, explore exclusive listings by top developers like DLF, Godrej Properties, M3M, and others. Situated in prime locations, these properties offer unmatched sophistication, world-class amenities, and timeless architectural charm. Whether it\'s a residence that reflects your stature or a commercial space that elevates your brand, New Delhi\'s luxury real estate has it all. Start your journey to owning a prestigious property today!', 'locations/44ea4df4c57feb05a6c7b70ca8bfc421.jpg', 1, '2025-09-30 13:09:47', '2025-09-30 13:09:47'),
(3, 'Noida', 'noida', 3, NULL, NULL, NULL, NULL, 'locations/12246ddbdb356a5b72dd341da513bcad.jpg', 0, '2025-09-30 13:09:47', '2025-09-30 13:09:47'),
(4, 'Kasauli', 'kasauli', 5, 'Holiday Homes For Sale In Kasauli, Buy Vaccation Homes in Kasauli', 'Luxury Apartments for Sale in Kasauli, Himachal. Luxury apartments/flats at best prices. Price starting from 29 Lacs. View Floor Plan, Images, Brochure.', 'Holiday Homes For Sale In Kasauli', '', 'locations/62c15c8888ec02b6e0a38c5b46e1e078.jpg', 1, '2025-09-30 13:09:48', '2025-09-30 13:09:48'),
(5, 'Goa', 'goa', 4, 'Vacation Homes in Goa | Properties for Sale in Goa', 'Search best vacation homes, independent villas, holiday homes, independent houses, and properties for sale in Goa. 2/3/4BHK villa, apartments, and flats for sale. Browse photo\'s, price list, and prope', 'Vacation Homes in Goa for Sale', 'Indulge in the charm of Goa with our exclusive collection of luxury holiday homes for sale. From elegant 2/3/4 BHK apartments to breathtaking independent villas and authentic Portuguese-style houses, find properties that blend comfort and sophistication. Perfectly situated amidst Goa’s serene beaches and vibrant culture, these vacation homes redefine leisure living. Explore properties for sale in Goa crafted by top developers, offering world-class amenities and timeless architecture. Whether it\'s a peaceful retreat or a smart investment, your dream holiday home in Goa is waiting for you!', 'locations/8523e02d6266c9acdc547a0fa3cc324f.jpg', 1, '2025-09-30 13:09:48', '2025-09-30 13:09:48'),
(6, 'Manesar', 'manesar', 8, 'Vacation Homes in Tarudhan Valley for Sale | Buy Holiday Homes @ 65 Lakhs', 'Holiday homes for sale in Tarudhan Valley. 2/3/4BHK apartments and flats for sale in Manesar. Browse photo\'s, price list, floor plan and property details.', 'Vacation Homes in Manesar for Sale', '', 'locations/b0852c71151fe482c2376667ea0494a4.jpg', 1, '2025-09-30 13:09:50', '2025-09-30 13:09:50'),
(7, 'Chail', 'chail', 9, 'Holiday Homes in Chail, Cottage for Sale in Chail | PropNKey', 'Luxury residential property in Chail - Discover your dream home among our modern houses, penthouses and villas for sale in Chail. Check price list and more.', 'Vacation Homes for Sale in Chail', '', 'locations/e83e50e44966f21ccb33e91eb940569b.jpg', 1, '2025-09-30 13:09:50', '2025-09-30 13:09:50'),
(8, 'Shimla', 'shimla', 7, 'Holiday Homes in Shimla, Vacation Homes in Shimla | PropNKey', 'Holiday Homes in Shimla - Luxury Hills apartments in Shimla for sale. Price starting from 1.2 crore.', 'Holiday Homes in Shimla', '', 'locations/3dde60002f0e69f8432b25ab558f087b.jpg', 1, '2025-09-30 13:09:51', '2025-09-30 13:09:51'),
(9, 'Bangalore', 'bangalore', 6, 'Luxury Property For Sale in Bangalore | PropNKey', 'Discover luxury properties for sale in Bangalore with our expert real estate agents. Find your dream home today! Contact us to schedule a site visit.', 'Luxury Property in Bangalore', '', 'locations/ab38d536c1f2d530e082e20277174b48.jpg', 1, '2025-09-30 13:09:51', '2025-09-30 13:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `url`, `parent_id`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Home', '/', NULL, 1, 1, '2025-09-22 06:51:36', '2025-09-22 06:51:36'),
(2, 'About Us', '/about', NULL, 2, 1, '2025-09-22 06:51:36', '2025-09-22 06:51:36'),
(14, 'Blog', '/blog', NULL, 5, 0, '2025-09-22 06:51:36', '2025-09-22 07:05:24'),
(15, 'News', '/news', NULL, 6, 0, '2025-09-22 06:51:36', '2025-09-22 06:51:36'),
(16, 'Home', '/', NULL, 1, 1, '2025-10-02 01:13:52', '2025-10-02 01:13:52'),
(17, 'Buy', '/all-properties', NULL, 2, 1, '2025-10-02 01:13:52', '2025-10-02 01:13:52'),
(18, 'Rent', '/all-properties?type=rent', NULL, 3, 1, '2025-10-02 01:13:52', '2025-10-02 01:13:52'),
(19, 'Sell', '/sell', NULL, 4, 1, '2025-10-02 01:13:52', '2025-10-02 01:13:52'),
(20, 'Our Services', '/services', NULL, 5, 1, '2025-10-02 01:13:52', '2025-10-02 01:13:52'),
(21, 'About Us', '/about', NULL, 6, 1, '2025-10-02 01:13:52', '2025-10-02 01:13:52'),
(22, 'Contact Us', '/contact', NULL, 7, 1, '2025-10-02 01:13:52', '2025-10-02 01:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_19_044737_create_site_configs_table', 2),
(5, '2025_09_19_045754_remove_is_active_from_site_configs_table', 3),
(6, '2025_09_22_105630_create_locations_table', 4),
(7, '2025_09_22_110754_create_partners_table', 5),
(8, '2025_09_22_112113_create_amenities_table', 6),
(9, '2025_09_22_113252_create_pages_table', 7),
(10, '2025_09_22_114914_create_slug_list_table', 8),
(11, '2025_09_22_121008_create_menus_table', 9),
(12, '2025_09_22_122625_create_agents_table', 10),
(13, '2025_09_23_031833_create_testimonials_table', 11),
(14, '2025_09_23_032624_create_blog_categories_table', 12),
(15, '2025_09_23_032634_create_blog_posts_table', 12),
(16, '2025_09_23_033840_create_property_categories_table', 13),
(17, '2025_09_23_050106_create_property_conditions_table', 14),
(18, '2025_09_23_050656_create_property_types_table', 15),
(19, '2025_09_23_051325_add_property_category_id_to_property_types_table', 16),
(20, '2025_09_23_053013_create_properties_table', 17),
(21, '2025_09_23_053040_create_property_amenities_table', 17),
(22, '2025_09_23_055827_create_property_images_table', 18),
(23, '2025_09_23_080357_add_residential_fields_to_properties_table', 19),
(25, '2025_09_29_093531_create_footer_items_table', 20),
(26, '2025_09_30_073919_create_inquiries_table', 21),
(27, '2025_09_30_181610_create_property_faqs_table', 22),
(28, '2025_09_30_184532_add_property_category_condition_to_properties_table', 23),
(29, '2025_09_30_185754_simplify_property_types_table', 24),
(30, '2025_09_30_190000_add_fields_to_property_types_table', 25),
(31, '2025_10_01_041242_add_highlight_images_to_properties_table', 26),
(32, '2025_10_01_075302_create_image_redirections_table', 27),
(33, '2025_10_03_021552_create_bedroom_options_table', 28),
(34, '2025_10_03_022052_add_property_category_id_to_property_types_table', 29),
(35, '2025_10_03_022101_update_properties_table_for_bedroom_options', 29),
(36, '2025_10_04_164412_add_similar_properties_budget_range_to_site_configs', 30),
(37, '2025_10_04_175930_remove_price_unit_from_properties_table', 31),
(38, '2025_10_04_182227_add_rent_fields_to_properties_table', 32);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'about-us', '<h2>Welcome to Our Company</h2><p>We are a leading property management company dedicated to providing exceptional service to our clients. With over 10 years of experience in the industry, we have built a reputation for excellence and reliability.</p><h3>Our Mission</h3><p>To provide comprehensive property management solutions that maximize value for property owners while ensuring tenant satisfaction.</p><h3>Our Vision</h3><p>To be the most trusted and innovative property management company in the region.</p><h3>Why Choose Us?</h3><ul><li>Experienced and professional team</li><li>24/7 customer support</li><li>Advanced technology solutions</li><li>Competitive pricing</li><li>Proven track record</li></ul>', 1, 1, '2025-09-22 06:14:20', '2025-09-22 06:14:20'),
(2, 'Services', 'services', '<h2>Our Services</h2><p>We offer a comprehensive range of property management services designed to meet your specific needs.</p><h3>Property Management</h3><p>Complete property management services including tenant screening, rent collection, maintenance coordination, and financial reporting.</p><h3>Property Maintenance</h3><p>Regular maintenance and repair services to keep your properties in excellent condition and maximize their value.</p><h3>Tenant Services</h3><p>Professional tenant services including application processing, lease management, and customer support.</p><h3>Financial Management</h3><p>Comprehensive financial management including rent collection, expense tracking, and detailed reporting.</p>', 2, 1, '2025-09-22 06:14:20', '2025-09-22 06:14:20'),
(3, 'Contact Us', 'contact-us', '<h2>Get in Touch</h2><p>We would love to hear from you. Contact us today to learn more about our services or to discuss your property management needs.</p><h3>Office Information</h3><p><strong>Address:</strong> 123 Property Street, City, State 12345</p><p><strong>Phone:</strong> (555) 123-4567</p><p><strong>Email:</strong> info@propnkey.com</p><h3>Business Hours</h3><p>Monday - Friday: 9:00 AM - 6:00 PM</p><p>Saturday: 10:00 AM - 4:00 PM</p><p>Sunday: Closed</p><h3>Emergency Contact</h3><p>For urgent matters outside business hours, please call our emergency line at (555) 123-4568.</p>', 3, 1, '2025-09-22 06:14:20', '2025-09-22 06:14:20'),
(4, 'Privacy Policy', 'privacy-policy', '<h2>Privacy Policy</h2><p>This privacy policy explains how we collect, use, and protect your personal information.</p><h3>Information We Collect</h3><p>We collect information you provide directly to us, such as when you create an account, contact us, or use our services.</p><h3>How We Use Your Information</h3><p>We use the information we collect to provide, maintain, and improve our services, communicate with you, and ensure the security of our platform.</p><h3>Information Sharing</h3><p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as described in this policy.</p><h3>Data Security</h3><p>We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.</p>', 4, 1, '2025-09-22 06:14:20', '2025-09-22 06:14:20'),
(5, 'Terms of Service', 'terms-of-service', '<h2>Terms of Service</h2><p>These terms of service govern your use of our website and services.</p><h3>Acceptance of Terms</h3><p>By accessing or using our services, you agree to be bound by these terms and conditions.</p><h3>Use of Services</h3><p>You may use our services only for lawful purposes and in accordance with these terms.</p><h3>User Accounts</h3><p>You are responsible for maintaining the confidentiality of your account and password and for all activities that occur under your account.</p><h3>Limitation of Liability</h3><p>To the maximum extent permitted by law, we shall not be liable for any indirect, incidental, special, consequential, or punitive damages.</p>', 5, 0, '2025-09-22 06:14:20', '2025-09-22 06:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `slug`, `image`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'M3M India', 'm3m-india', 'partners/a9ba8cba889aee5ba67ae7d68a00606b.png', 1, 1, '2025-09-30 13:11:57', '2025-09-30 13:11:57'),
(2, 'AIPL', 'aipl', 'partners/bd2c6a109b742718256dcb6f9a3f08a4.png', 2, 1, '2025-09-30 13:12:00', '2025-09-30 13:12:00'),
(3, 'Conscient', 'conscient', 'partners/a4d54a87c150bc43e77f0409230d0620.png', 3, 1, '2025-09-30 13:12:01', '2025-09-30 13:12:01'),
(4, 'DLF', 'dlf', 'partners/a206a7759e83915ad2c26722a00f6fd2.png', 4, 1, '2025-09-30 13:12:01', '2025-09-30 13:12:01'),
(5, 'Godrej Properties', 'godrej-properties', 'partners/cc0ffbd9a7907a4db1c211bb66c8cdfa.png', 5, 1, '2025-09-30 13:12:01', '2025-09-30 13:12:01'),
(6, 'Risland', 'risland', 'partners/6574fe5eba575f2155072372d6b6ebb0.png', 6, 0, '2025-09-30 13:12:02', '2025-09-30 13:12:02'),
(7, 'Raheja Developers', 'raheja-developers', 'partners/de750a5af27e583f2076b6bda2a9c4e5.png', 7, 0, '2025-09-30 13:12:02', '2025-09-30 13:12:02'),
(8, 'TATA Housing', 'tata-housing', 'partners/46dae12709179df661e1852686d505bc.png', 8, 1, '2025-09-30 13:12:02', '2025-09-30 13:12:02'),
(9, 'Silverglades', 'silverglades', 'partners/5a6c963508582d1a29da8c4ad38b1cf9.png', 9, 1, '2025-09-30 13:12:03', '2025-09-30 13:12:03'),
(10, 'SUSHMA Group', 'sushma-group', 'partners/807eda38bfe9584b6fb6be499af32d29.png', 10, 1, '2025-09-30 13:12:03', '2025-09-30 13:12:03'),
(11, 'Omaxe', 'omaxe', 'partners/4075402b42df8bf6a20e130f3009663a.png', 11, 1, '2025-09-30 13:12:04', '2025-09-30 13:12:04'),
(12, 'Central Park Resorts', 'central-park-resorts', 'partners/27ae527d35d8c9639842faffb17e533c.png', 12, 1, '2025-09-30 13:12:06', '2025-09-30 13:12:06'),
(13, 'Paras Buildtech', 'paras-buildtech', 'partners/a65a58a6a3bfd6645a8fcbad07e0e746.jpg', 13, 1, '2025-09-30 13:12:06', '2025-09-30 13:12:06'),
(14, 'Mahindra Lifespaces', 'mahindra-lifespaces', 'partners/c1460f230f377a418949b078c41fb6a0.jpg', 14, 1, '2025-09-30 13:12:07', '2025-09-30 13:12:07'),
(15, 'Other', 'other', 'partners/ab005862ffcdce303d1c16a8e3881501.png', 15, 0, '2025-09-30 13:12:07', '2025-09-30 13:12:07'),
(16, 'Total Environment', 'total-environment', 'partners/94d00aa9edbfa9ef0ee46a83b55e9b86.png', 16, 0, '2025-09-30 13:12:07', '2025-09-30 13:12:07'),
(17, 'Puravankara Limited', 'puravankara-limited', 'partners/77917b81990bce3e9e62bfc747bf6ab9.png', 17, 0, '2025-09-30 13:12:08', '2025-09-30 13:12:08');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint UNSIGNED NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partner_id` bigint UNSIGNED DEFAULT NULL,
  `agent_id` bigint UNSIGNED DEFAULT NULL,
  `location_id` bigint UNSIGNED DEFAULT NULL,
  `property_type_id` bigint UNSIGNED DEFAULT NULL,
  `bedroom_option_id` bigint UNSIGNED DEFAULT NULL,
  `property_category_id` bigint UNSIGNED DEFAULT NULL,
  `property_condition_id` bigint UNSIGNED DEFAULT NULL,
  `rating` decimal(3,2) DEFAULT NULL,
  `review_count` int NOT NULL DEFAULT '0',
  `badge` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `rera_reg_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `home_sort` int NOT NULL DEFAULT '0',
  `price` decimal(15,2) DEFAULT NULL,
  `monthly_rent` decimal(15,2) DEFAULT NULL,
  `security_deposit` decimal(15,2) DEFAULT NULL,
  `one_time_fees` decimal(15,2) DEFAULT NULL,
  `total_payable` decimal(15,2) DEFAULT NULL,
  `rent_includes` text COLLATE utf8mb4_unicode_ci,
  `rent_excludes` text COLLATE utf8mb4_unicode_ci,
  `rental_process` text COLLATE utf8mb4_unicode_ci,
  `dos_donts` text COLLATE utf8mb4_unicode_ci,
  `lock_in_period_days` int DEFAULT NULL,
  `notice_period_days` int DEFAULT NULL,
  `terms_conditions` text COLLATE utf8mb4_unicode_ci,
  `is_rental` tinyint(1) NOT NULL DEFAULT '0',
  `area_sq_ft` int DEFAULT NULL,
  `rise` enum('high','low') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `possession` date DEFAULT NULL,
  `property_status` enum('newly_launched','ready_to_move','under_construction') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_sold` tinyint(1) NOT NULL DEFAULT '0',
  `amenities_description` text COLLATE utf8mb4_unicode_ci,
  `property_description` longtext COLLATE utf8mb4_unicode_ci,
  `gallery_description` text COLLATE utf8mb4_unicode_ci,
  `floor_plan_description` longtext COLLATE utf8mb4_unicode_ci,
  `offer_text` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `airport` text COLLATE utf8mb4_unicode_ci,
  `entertainment` text COLLATE utf8mb4_unicode_ci,
  `national_highway` text COLLATE utf8mb4_unicode_ci,
  `hospitals` text COLLATE utf8mb4_unicode_ci,
  `education` text COLLATE utf8mb4_unicode_ci,
  `project_highlights_title` longtext COLLATE utf8mb4_unicode_ci,
  `highlight_images` json DEFAULT NULL,
  `location_features` longtext COLLATE utf8mb4_unicode_ci,
  `price_list` longtext COLLATE utf8mb4_unicode_ci,
  `map_code` text COLLATE utf8mb4_unicode_ci,
  `map_text` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `is_featured`, `name`, `slug`, `alias_name`, `partner_id`, `agent_id`, `location_id`, `property_type_id`, `bedroom_option_id`, `property_category_id`, `property_condition_id`, `rating`, `review_count`, `badge`, `locality`, `address`, `rera_reg_no`, `sort_order`, `home_sort`, `price`, `monthly_rent`, `security_deposit`, `one_time_fees`, `total_payable`, `rent_includes`, `rent_excludes`, `rental_process`, `dos_donts`, `lock_in_period_days`, `notice_period_days`, `terms_conditions`, `is_rental`, `area_sq_ft`, `rise`, `possession`, `property_status`, `is_sold`, `amenities_description`, `property_description`, `gallery_description`, `floor_plan_description`, `offer_text`, `meta_title`, `meta_description`, `airport`, `entertainment`, `national_highway`, `hospitals`, `education`, `project_highlights_title`, `highlight_images`, `location_features`, `price_list`, `map_code`, `map_text`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 0, 'Updated Test Name 1759600985', 'm3m-golfestate-sector-65-gurgaon', NULL, 1, 1, 1, 1, NULL, 1, 1, 4.60, 68, '', 'Sector 65', 'Golf Course Extn. Road', '', 90, 90, 53000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2850, 'high', NULL, 'newly_launched', 0, 'M3M Golf Estate promises its citizens breath-taking views in the heart of a metropolis! Also, the project is a perfect marriage of design and conveniences. The charming complex of M3M Golf Estate is set in a picturesque setting with aesthetic outdoor spaces to liven up your spirits. ', '<p>M3M Golf Estate&nbsp;makes heads turn with its premium architectural aesthetic fused with luxury in sector 65 Gurgaon. The enchanting residential complex is priced to sell fast. The complex has lush green landscapes to enamor its residents and inspire joyful living with a vibrant lifestyle. The project is the epitome of start-of-the-art architecture that goes hand-in-hand with the stunning naturescape. So, gift yourself and your loved ones luxurious living with deluxe utilities and enthralling beauty.</p>\r\n\r\n<p>M3M Golf estate Gurgaon stands for magnificence in the trinity of men material and money. We strongly believes in quality projects and their timely delivery and known for state of the art condominiums and commercial complexes across different micro markets in Gurgaon. M3M Golfestate is synonymous with Uber luxury living as It offers a distinctive lifestyle with state of the art amenities.</p>\r\n\r\n<ul>\r\n	<li>3 &amp; 4 BHK Condominiums starting from 3000 sq ft onwards amidst 56+ acres of Uber Luxury Golf Living.</li>\r\n	<li>Located in Sector 65, Golf Corse Extension Road, Gurgaon.</li>\r\n	<li>Designed by world renowned architects Arcop International, Canada</li>\r\n	<li>Apartments are overlooking a magnificent 9 hole Executive Golf Course</li>\r\n</ul>\r\n', '', '<p>The project offers 3 BHK &amp; 4 BHK apartments, and penthouses to cater to families of all sizes. The penthouses offer a 360-degree panoramic view as they have attached balconies with each bedroom. 3 &amp; 4 BHK condominiums starting from 2850 sq. ft. onwards amidst 56+ acres of Uber Luxury Golf Living.</p>\r\n', '', 'M3M Golf Estate Gurgaon Sector 65 - Know Price, Floor Plan', 'M3M Golfestate in Sector 65 offers Ultra luxury condominium for sale at the most prime location of Gurugram. Price starting at 5.3 crores* Onwards. Book today!', '30', '10', '10', '8', '2', '<ul>\r\n	<li>M3M Gold Estate Gurgaon won the &quot;<em><strong>Ultra-luxury project of 2019 - North</strong></em>&quot; from Zee Business.</li>\r\n	<li>The open area around the complex includes a 9-hole executive golf course, a treat for the golf connoisseurs.</li>\r\n	<li>The tower&#39;s lobbies exude intricate designing and creative genius as they have been thought by the US interior design specialist <em><strong>Bilkey Llinas Designs</strong></em>.</li>\r\n	<li>This green paradise is protected from all sides by a 5-level security system.</li>\r\n	<li>M3M Golf Estate gives equal importance to convenience as it gives to luxury. Each tower has a meticulously designed drop-off zone for residents.&nbsp;</li>\r\n	<li>M3M Golf Estate, Sector 65, is the <strong><em>biggest luxury condominium project in the city of Gurgaon</em></strong>.</li>\r\n	<li>M3M Golf Estate boasts 101 lifestyle amenities and high-end specifications, similar to the finest of 7-star resorts, which aim to redefine luxurious living.</li>\r\n</ul>\r\n', '\"properties/highlights/test_highlight_1.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>3 BHK</td>\r\n			<td>2850 sq.ft.</td>\r\n			<td>₹5.3 Crore*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK</td>\r\n			<td>2952 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK</td>\r\n			<td>3043 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK</td>\r\n			<td>3505 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:11', '2025-10-04 12:33:05'),
(2, 0, 'Emaar Digi Homes', 'emaar-digi-homes-sector-62-gurgaon', NULL, 2, 1, 1, 1, NULL, 1, 1, 4.80, 76, '', 'Sector 62', 'Golf Course Extension Road', '', 90, 90, 24000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1508, 'high', NULL, 'newly_launched', 0, 'Emaar DigiHomes offers a fortune of amenities for its price list, while being close to everything. From well-being to having a well-balanced social life, there is something for you and your little one. So, expect spending quality family time at the temperature-controlled infinity-edge pool and a dedicated Culture Court.', '<p>Enter the magical world of Emaar Digi Homes, a residential project that ushers in the new era with voice-enabled homes and controls. The property is designed to suit the new generation of people fusing luxury with technology. The project inspires the active lifestyle of couples as it has been intricately designed to put aestheticism and utility hand-in-hand.</p>\r\n\r\n<p>&nbsp;Each square inch of the gated residential complex inspires awe. The residents can have a gala time in the majestic luxury clubhouse with several innovative facilities and amenities. These intelligent installations are meant to add a new dimension to your life and elevate your standard of complete living. Emaar DigiHomes Gurgaon is slated to become a landmark on the Golf Course Extension Road with its pristine design and high-rise mono towers.&nbsp;Emaar DigiHomes is located close to schools, hospitals, malls, and other commercial amenities, giving you the feel of residing in the central downtown.</p>\r\n\r\n<p><strong>WELCOME TO THE WORLD OF EMAAR DIGI HOMES - UBER LUXURY APARTMENTS THAT LISTEN.</strong></p>\r\n\r\n<p>At Emaar Digihomes Sector 62, life is made easy with our voice and touch activated digital apartments and entertain your guests and yourself at the rooftop restaurant and the open and semi-open party terrace. Emaar India is a real estate developer, mainly involved in developing integrated townships, residential, commercial, mutistorey buildings, villas, apartments having its presence across different parts if India including Delhi/ NCR, Mohali, Lucknow, Chennai.</p>\r\n', '', '<p>The complex has 2BHK and 3BHK apartments with sizes ranging from 1508.26 sq. ft. to 2588.79 sq. ft. Emaar DigiHomes is spread out over an area of 5.64 acres that has 80% of open spaces to inspire outdoor living. The construction is of 3 towers having 32 floors on each building. So, the total accommodation at Emaar DigiHomes is 504 units.</p>\r\n', 'Pay 20% now and rest amount on possession.', 'Emaar Digi Homes in Sector 62 Gurgaon | Location, Price, Reviews', 'Welcome to the World of Emaar Digi Homes, Sector 62, Gurgaon - Uber Luxury Apartments That Listen. Check out the Price, Floor Plan, Amenities, Payment Plan etc.', '15', '10', '10', '5', '5', '<p>Emaar DigiHomes offers a comprehensive package of specifications to look after the well-being of the residents.</p>\r\n\r\n<ul>\r\n	<li>Emaar DigiHomes has gone next level with voice-enabled automated homes.</li>\r\n	<li>The striking design of the high-rise mono towers looks straight out of a leaf of an architectural magazine.</li>\r\n	<li>The project has a grand 3 level clubhouse that is loaded with a number of amenities.</li>\r\n	<li>Relax and unwind your stress at the temperature-controlled swimming pool.</li>\r\n	<li>Live close to nature while enjoying the panoramic views of the Aravalli Mountains and soothe your soul with awe-inspiring greenery.</li>\r\n	<li>Enjoy your me-time with a wholesome yoga session at the dedicated yoga terrace at Emaar DigiHomes.</li>\r\n	<li>Feel secured all-time at your home in Emaar DigiHomes with a panic button installed in master bedrooms, gas, and smoke leak kitchen sensors, biometric authorization, etc.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_emaar-digi-homes-sector-62-gurgaon_1759292237.jpg\"', NULL, '', NULL, NULL, 1, '2025-09-30 13:52:11', '2025-09-30 22:54:04'),
(3, 0, 'Birla Navya', 'birla-navya-sector-63a-gurgaon', NULL, 5, 1, 1, 1, NULL, 1, 1, 4.70, 84, '', 'Sector 63A', 'Golf Course Extension', '', 90, 1, 36200000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1400, 'low', NULL, 'newly_launched', 0, 'At Birla Navya, live the stress-free zen life. With its power-packed, never-ending list of amenities, the project marches well ahead of its competition. Besides showering indoor amenities to the residents to elevate their lifestyle, Birla Navya is located right in the center of the essential commercial establishments. So, you can enjoy all the goodness of nature while sitting right in the center of the city! The gated community has the Unitech business zone, HDFC bank, and W Pratiksha Hospital close to it.', '<p>Birla Navya Gurgaon is a nature lover&#39;s paradise. It brings together the tantalizing world of luxurious living with premium features. The prime focus of the project has been the central greens to invoke a feeling of being one with nature. If that was not enough, Birla Navya in Sector 63A boasts of a nature trail and treehouse as well to make sure that you enjoy nature like no other.</p>\r\n\r\n<p>Birla Navya is a township project of premium floor residences spread across 1,90,202 sq mts and five individual pockets. The first phase features projects Drisha &amp; Amoda. Each pockets planning and infrastructure has a differest approach with its own distinctive offerings. The name Navya connotes newness or Freshness in Sanskrit.</p>\r\n\r\n<p>The promise of a new beginning and start of a new life designed around Harmony. Key focus is on sustainibility and with provision for water conservation and organic waste management. With the&nbsp;IGBC Gold pre certification the project is set to be one of the first green rated township in gurugram.&nbsp;Located on&nbsp;Golf Course Extension, Sector 63A at Gurugram, Haryana.&nbsp;</p>\r\n\r\n<p>The complex has a reflexology park, too, so that you can massage your acupressure points on your feet&#39;s soles and stimulate them to relax your body and mind. This green project takes the wellness of the residents an inch further by including a dedicated yoga room and a meditation pavilion. So, indulge in the goodness of greenery by calling a zen-like space in Birla Navya your home.<br />\r\n&nbsp;</p>\r\n', '', '<p>Birla Navya has started construction and will make ready 300 units for possession by June 2024. The total project is spread out over an area of 47.54 acres and includes five towers for residential units. The residential complex has 2BHK, 3BHK, and 4 BHK apartments for families of differing needs and budgets. Birla Navya is presenting LifeDesigned&reg; 2/3/4 BHK Layouts designed to get more from each square foot. Premium Floor Residences at Birla Navya Gurugram have been designed around harmony and with our philosophy of creating built-environments which are meticulously perfected to understand, nurture and enrich your lives.</p>\r\n', 'Book Today and Get Amazon Voucher Worth 10K.', 'Birla Navya Sector 63A Gurgaon | Price List, Floor Plan, Location', 'Birla Navya Sector-63A Gurgaon is a 2 BHK, 3 BHK, 4 BHK Premium Floor Residences at Golf Course Extension. Birla Navya Price List. Birla Navya Floor Plan available.', '20', '2', '15', '5', '5', '<ul>\r\n	<li>Birla Navya takes contemporary living ahead of its game by getting certified gold for its green township building by IGBC (Indian Green Building Council).</li>\r\n	<li>Give your pets the care they deserve at the indoor pet care services.</li>\r\n	<li>The complex has one-of-its&#39;s-kind Reflexology Park that takes relaxation and stress relief to a whole new level.</li>\r\n	<li>Spoil yourself endlessly at the 1.5L sq. ft. big indoor clubhouse with a plethora of lifestyle amenities.</li>\r\n	<li>Reshape working from home at Birla Navya Gurgaon by sharing occasional laughs and chats with your buddies at the indoor co-working spaces.</li>\r\n	<li>Birla Navya Gurgaon is a residential township project spanning across 47.54 acres</li>\r\n	<li>Birla Navya Gurugram comprises of four finest deluxe floor residencies.</li>\r\n	<li>There are lush green gardens and beautiful landscapes thus ensuring greenery all around.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_birla-navya-sector-63a-gurgaon_1759292237.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>2 BHK + 2T</td>\r\n			<td>1400 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK + 3T</td>\r\n			<td>2076 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK + UTILITY</td>\r\n			<td>2165 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>4 BHK + UTILITY</td>\r\n			<td>3105 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:11', '2025-09-30 22:54:04'),
(4, 0, 'Conscient Hines Elevate', 'conscient-hines-elevate-sector-59-gurgaon', NULL, 3, 1, 1, 1, NULL, 1, 1, 4.60, 51, '', 'Sector 59', 'Golf Course Extension Road', '', 90, 90, 35000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2095, 'high', NULL, 'newly_launched', 0, 'The property is loaded with amenities that look after the residents\' well-being. From a yoga center to a sauna, from a cafeteria to an amphitheater, Conscient Elevate has everything. Thus if you are working from home or wish to practice mindfulness, at Conscient Elevate you will have it all.', '<p><strong>Conscient Hines Elevate</strong> is the height of luxury and grand living at Sector 59, Gurgaon. Beautiful residential communities boasting the finest luxuries and ultimate convenience that will make you feel on top of the world. This exclusive luxury destination in Gurgaon is a brainchild of Conscient.</p>\r\n\r\n<p>We offer <em><strong>luxurious 3 &amp; 4 BHK apartments</strong></em> with eye-catching natural views and surroundings while maintaining the great balance of daylight, height, and ventilation in your apartment through smart floor planning. Here Mother Nature&rsquo;s vast green cover is ever ready to play its melodious tunes and take you into a state of peaceful, while these wide ranges of resort-style amenities are an ideal break from your daily mundane routine. With over 75% open green space, bring the harmony of nature into every apartment.</p>\r\n\r\n<p>Situated just 25 kilometers away from the Delhi Airport, <em><strong>Conscient Elevate Gurgaon</strong></em> is a stone&#39;s throw distance away from all the basic amenities. These include hospitals, medical stores, schools, Cyber City offices, and a golf course. Thus bid goodbye to hours of commute by investing in Conscient Elevate.</p>\r\n\r\n<p>Conscient Elevate also promises ample green spaces. Its elaborate plan includes large open lawns with well-manicured gardens. So, at Conscient Elevate, you can own a home close to nature without sacrificing on the amenities.</p>\r\n', 'Conscient Elevate is a product of the marriage of affordability and luxury. With this project, Conscient Elevate breaks the myth of either choosing affordability or luxury. Thus opt for extravagance with utility by choosing Conscient Elevate as your home.', '<p>Conscient Elevate is an 8 acre property that will have 556 palatial homes for possession. Residents can opt for 3 or 4 BHK apartments ranging from 2095 square feet to 3395 square feet to be constructed in 5 towers. Conscient Elevate is currently under construction and will be available for possession from December 2022.</p>\r\n', 'Pay only 10% now and nothing till possession. Get interest saving upto 45 lacs.', 'Conscient Hines Elevate Sector 59 Gurgaon - Check Price, Floor Plan', 'Conscient Hines Elevate offers 3 & 4 BHK luxury apartments with eye-catching natural views in Sector 59, Gurgaon . Check floor plan & price list.', '25', '10', '8', '5', '5', '<ul>\r\n	<li>Conscient Elevate lies in a great neighborhood close to the Delhi Airport and Cyber City, thus lessening the pain of commute.</li>\r\n	<li>The architectures have taken deliberate care to make the project environment-friendly. It has a rainwater harvesting system and a sewage treatment facility in the compound. So, invest in an eco-friendly home at Conscient Elevate.</li>\r\n	<li>The project brings affordability with luxury, thus providing the best of both worlds to its residents.</li>\r\n	<li>Situated near Golf Course Extension Road in Sector 59</li>\r\n	<li>Luxury amenities include a unique, underground parking experience with natural light and exclusive drop-off and pick-up zones.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_conscient-hines-elevate-sector-59-gurgaon_1759292238.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>3 BHK + SQ</td>\r\n			<td>2095 Sq.Ft.</td>\r\n			<td>₹3.5 Crore Onwards</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK + SQ</td>\r\n			<td>2295 Sq.Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK + SQ</td>\r\n			<td>2595 Sq.Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>4 BHK + SQ</td>\r\n			<td>3300 Sq.Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:11', '2025-09-30 22:54:04'),
(5, 0, 'DLF The Camellias', 'dlf-the-camellias-sector-42-gurgaon', NULL, 4, 1, 1, 1, NULL, 1, 1, 4.50, 64, '', 'Sector 42', 'Golf Links, DLF Phase 5', '', 90, 90, 450000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 7196, 'high', NULL, 'newly_launched', 0, 'At DLF–The Camellias Sector 42 expect to up the ante with the super-luxurious amenities. The project has been given \'Sustainable Super Luxury Development\' with a LEED platinum certification. Thus DLF–The Camellias brought sustainability to the fore with its meticulous design.', '<p>A ready-to-move residential project, the design of the <em><strong>The Camellias by DLF</strong></em> was inspired by the idea to make bungalow-like apartments. Borne out of the mind of the Padmashree Awardee architect Hafeez Contractor, every inch of the apartment oozes out grandeur. So, unwind and relax at your home while looking at the plush lakes facing the towers.</p>\r\n\r\n<p>The super-luxurious apartments do not cut down on sustainability. <strong>DLF The Camellias Gurgaon</strong> merge sustainability with class, a feat that is the first in India. Besides the lakes, the project also has two golf courses designed by the masterminds Arnold Palmer and Gary Player. So, you can now practice your golf strokes with ease at your own home.</p>\r\n\r\n<p>The project has a dedicated 5.7 hectares green landscape to make greenery a part of your everyday life. Thus at The Camellias Sector 42 promises serenity and mindfulness like no other.</p>\r\n\r\n<p>The Camellias is the latest residential offering in the DLF&#39;s acclaimed super-luxury portfolio located in the Golf Drive DLF5. Lake facing <strong>super luxurious Apartments in DLF5</strong>, Gurgaon.</p>\r\n\r\n<p>The spacious Apartment at <strong>The Camellias in DLF5</strong> comes with a Golf Course view and many modern amenities including Cycling &amp; Jogging Track, 24x7 Security, Children&#39;s Play Area, Swimming Pool, and Gymnasium.</p>\r\n\r\n<p>The Apartment size starts from 7196.0 sq ft. Sector 42 is well-connected to other parts of the city by road, which passes through the heart of this suburb.</p>\r\n\r\n<p>Life here is designed to exceed the expectations of discerning residents. Entry to Golf Drive is a welcome into a land of serenity. The newest addition to this exclusive area the golf drive communities promises to take this experience to an even higher level, making a pride for its owners and also a slice of unparalleled luxury for those who are looking to own it.</p>\r\n', '', '<p>Calm, serene and flanked by acres of greenery, The Camellias in DLF5 is home to some of the most exclusive communities in India. The designs of the 4BHK, 5BHK, and 6BHK apartments are inspired by the native Asian plant &ndash; the Camellias. The 429 units are constructed in 38 floors in 9 towers spread out over 17.5 acres. This peerless, record-breaking project is now ready for possession.</p>\r\n', '', 'The Camellias Gurgaon - Super Luxury Homes by DLF | PropNKey', 'DLF The Camellias is a ready-to-move residential project in Sector 42 Gurgaon that offer super luxury homes in the configurations of 4,5 & 6 BHK flats and penthouses.', '15', '5', '5', '5', '5', '<ul>\r\n	<li>The Camellias DLF5 is known to make a mark in the architectural world. Fusing sustainability into architectural design, DLF- The Camellias is the first of its kind.</li>\r\n	<li>The interior of the clubhouse and the tower lobbies are designed by Shawn Sullivan, Rockwell Group from New York.</li>\r\n	<li>The concierge service at the complex is exclusive to its residents and is a notch above its competitors.</li>\r\n	<li>Residents can enjoy the views of sprawling greenery and crystal clear waters of the lake from each apartment.</li>\r\n	<li>Each apartment is constructed in a way to give the residents the feel of living in a bungalow.</li>\r\n	<li>DLF - The Camellias in DLF5 defines class and panache as the clubhouse too is designed by 6 of the best masters of luxury designing from the world.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_dlf-the-camellias-sector-42-gurgaon_1759292238.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>4 BHK</td>\r\n			<td>7196 sq.ft</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>5 BHK</td>\r\n			<td>9000 sq.ft</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>5.5 BHK</td>\r\n			<td>9419 sq.ft</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:11', '2025-09-30 22:54:04'),
(6, 0, 'Risland Sky Mansion', 'risland-sky-mansion-chattarpur-delhi', NULL, 6, 1, 2, 2, NULL, 1, 1, 4.60, 77, '', 'Chattarpur', 'Opp. Radhe Mohan Drive', 'DLRERA2018P0014', 90, 90, 56700000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3255, 'high', NULL, 'newly_launched', 0, 'The amenities of Risland Sky Mansion Chhatarpur will surely redefine the relationship your share with your home. The property is planned in a way to satiate the personal needs of all kinds of residents. From the plush cafeteria to a reading lounge, indoor games area, to the indoor grocery shop, Risland Sky Mansion has fused utilities with luxuriousness. Risland Sky Mansion has also paid attention to the needs of bibliophiles by planning an indoor library for them.', '<p>Risland Sky Mansion is an exemplary benchmark of luxury living in the heart of Chhatarpur, South Delhi, stands as the first 100 metres sky scrapper in the area. One of India&rsquo;s most premium projects with well-crafted <strong>3BHK / 4BHK penthouses</strong> and uninterrupted views of Aravalli Greens.</p>\r\n\r\n<p>Located in the heart of Delhi&rsquo;s Chattarpur, surrounded by approximately 2000 sprawling farmhouses owned by Delhi&rsquo;s affluent communities, creating a cr&egrave;me de la neighbourhood. A short 3km drive from the Asola Bird Sanctuary makes the project one of the greenest in Delhi, assuring residents a healthy lifestyle.</p>\r\n\r\n<p>Tucked away in private, <strong>Sky Mansion by Risland </strong>in <strong>Chattarpur</strong>, offers deluxe living in the greenest part of Delhi. Risland Sky Mansion is the only <strong>100m skyscraper in South Delhi</strong>, thus offering open panoramic views of the Aravalli Greens. So, live a healthy lifestyle by owning a property in the cr&egrave;me de la cr&egrave;me neighborhood in Delhi.</p>\r\n\r\n<p>Spread out over an area of 700 acres, <em><strong>Risland Sky Mansion&nbsp;Delhi</strong></em> provides unhindered views of the skyline. The design of each apartment ensures cross-ventilation, thus making nature an essential element in your everyday living. Enjoying breezy evenings with your friends and family while sitting in your apartment is now a raging reality. So, live a more fulfilling life at the plush Sky Mansion by Risland and experience premium living amidst the serenity of nature.</p>\r\n', '', 'Only 2 apartments per floor with north & south oriented balconies, ensures ample sunlight and proper ventilation in all the corners of the house. This also provides enhanced privacy and exclusivity giving your house a new definition of luxury.   The design of Risland Sky Mansion, South Delhi, is that of an architectural marvel, setting a standard for luxury living in the future. The complex is extremely spacious in its design. Each apartment has a 12.6ft ceiling to make you feel at home. The Risland Sky Mansion Floor Plan includes only two apartments per floor, offering 3 BHK and 4BHK residential flats. The Risland Sky Mansion price list includes apartments ranging from 3255 sq.ft. to 9449 sq.ft. in size. So, own a home next to the mega-celebrities and be neighbors with world-cup winning-cricket personalities at Risland Sky Mansion, Delhi.', 'Pay now 10% and rest amount on possession.', 'Risland Sky Mansion Chattarpur - Check Price, Floor Plan', 'Sky Mansion Delhi is a Uber Luxury residential project by Risland India that offers 3 & 4 BHK penthouses in Chattarpur. Price 5.67 crore onwards. Book now!', '20', '12', '10', '15', '10', '<ul>\r\n	<li>Risland Sky Mansion has one of the largest clubhouses in South Delhi, with 33000 sq. ft. of club facilities.</li>\r\n	<li>Breathe fresh air 24x7 with the centralized air purification system with 2.5 mm filters installed at all apartments.</li>\r\n	<li>Swim away your worries with your buddies at the <em><strong>temperature-controlled pool in Risland Sky Mansion Delhi</strong></em>.</li>\r\n	<li>With the 100% power backup provided for all apartments, you will never lose access to amenities. &nbsp;</li>\r\n	<li>Each apartment of the property has sound-proof and temperature-controlled glass doors and windows.</li>\r\n	<li>The curators of the property have ensured extra safety measures for its residents by incorporating gas leak detector and air purification system.&nbsp;</li>\r\n	<li>At <strong><em>Risland Sky Mansion Delhi</em></strong>, gone are the days when you had to jostle for car parking spaces. The residential complex has three-level car parking so that you have ample room to park your cars.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_risland-sky-mansion-chattarpur-delhi_1759292239.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>3 BHK - TYPE A TYPICAL</td>\r\n			<td>3255 sq.ft.</td>\r\n			<td>₹5.67 Cr.*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4 BHK TYPE A TYPICAL</td>\r\n			<td>3898 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>PENTHOUSE TYPE A</td>\r\n			<td>9449 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(8, 0, 'The Leela Sky Villas', 'the-leela-sky-villas-central-delhi-delhi', NULL, 7, 1, 2, 1, NULL, 1, 1, 4.70, 88, '', 'Central Delhi', 'Shadipur', 'DLRERA2018P0005', 90, 90, 60000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2306, 'high', NULL, 'newly_launched', 0, 'With the amenities it has, The Leelas Sky Villas should be on the cover of a magazine! This 5-star branded residential complex has everything that any 5-star hotel boasts of. The Leela Sky Villas Delhi has them all from a bar/chill-out lounge to a concierge service, a business lounge to a valet parking service. Apart from luxurious services, The Leela Sky Villas has excellent utility services too. The residential complex provides a perfect blend of practicality and grandeur, from a dedicated bus shelter to laundry, high-speed elevators, and daycare.', '<p>The Leela Sky Villas - The address of power at New Delhi. A lucky few will be able to call these Super Luxury Hotel Residences in New Delhi, their home. Your own property designed and built to the standard of one of the best 5-star hotel chains. These luxury residences would include legendary 5-star hotel services and amenities where your daily life is at par with resort/hotel style living.</p>\r\n\r\n<p>Who wouldn&#39;t want to have a view from the tallest tower in all of Delhi? No, we are not talking of an observatory tower in Delhi but a residential project! At The Leela Sky Villas Delhi Central, you can enjoy unhindered views of the cityscape with zero distractions. So, see the capital city of the country like no one ever has at The Leela Sky Villas.</p>\r\n\r\n<p>Along with a unique perspective of the city, The Leela Sky Villas is the most ambitious project of Delhi that offers 5-star branded residencies, the first of its kind. And the series of firsts doesn&#39;t end there. The Leelas has taken a step further in ensuring the safety of the residents to build the first underground nuclear bunker project in the entire country! So, live a contemporary, comforting, and fulfilling life with your loved ones at The Leela Sky Villas West Delhi.</p>\r\n\r\n<h3><strong>Some Salient features are:</strong></h3>\r\n\r\n<ul>\r\n	<li>The Tallest Building in Delhi, where every 4 &amp; 5 BHK apartment comes with its private lap pool.</li>\r\n	<li>The First 5-star hotel residences in Delhi with Leela Hotels, with all services like Housekeeping, Laundry, Concierge, Valet, Room Services, Spa management, etc.</li>\r\n	<li>Most of the apartments overlook views of Rashtrapati Bhawan, ITC, Taj, Delhi Ridge, Connaught Place.</li>\r\n	<li>First mix-use development in Delhi with Shopping Mall, Food Court, Showrooms, Movies, and Luxury Residences in the same complex. Along with Delhi&rsquo;s first and only Gold Souk with attached Multi-Level Car Park.</li>\r\n	<li>First residences in India with 13 feet floor to floor height, making them villas in the sky with 3, 4, 5 BHK typologies starting from approx 6 Cr.* onwards.</li>\r\n	<li>Highest Helipad Restaurant in India with World&rsquo;s Highest Glass Bottom Pool.</li>\r\n	<li>Available in 3 different specifications options- Bare Shell, with Hard Fittings and with fully fitted &amp; customized Hotel-style interiors.</li>\r\n</ul>\r\n', '', 'The elite residences would include the facilities and amenities of legendary 5 star hotels which only few can be able to call their own homes in New Delhi. Priced below the appraisal amount, The Leela Sky Villas price list includes 3BHK, 4BHK, 5BHK, and 8 BHK premium apartments with sizes ranging from 2306 sq.ft. to 9773 sq.ft. So, The Leela Sky Villas takes care to cater to the needs of families of all sizes.', '', 'The Leela Sky Villas Central Delhi - Price List, Floor Plan', 'The The Leela Sky Villas located in Central Delhi is an Uber Luxury Lifestyle project designed only for the well-travelled achievers of the country. Check Price List, Floor Plan and Payment Structure.', '30', '5', '25', '5', '5', '<ul>\r\n	<li>The Leela Sky Villas Shadipur Delhi Central is the tallest tower in Delhi. So, see your city in a new light from your home at The Leela Sky Villas Delhi.</li>\r\n	<li>The Leela Sky Villas has taken is changing the norms of safety protocols with their project. They have introduced the very first underground nuclear bunker project to keep the citizens safe in the direst situations.</li>\r\n	<li>Enjoy an unparalleled view of the horizon and the skyline while swimming at the highest glass-bottom pool in the country.</li>\r\n	<li>Have a quick swim with your loved ones at the private lap pool situated on each floor of the residential project.</li>\r\n	<li>Located in the prime location of Delhi Central, the popular hotspots of the city, along with schools and hospitals, are in close vicinity of The Leela Sky Villas.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_the-leela-sky-villas-central-delhi-delhi_1759292240.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>3 BHK</td>\r\n			<td>2306 Sq.ft.</td>\r\n			<td><strong>₹6 Cr.*</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>4 BHK</td>\r\n			<td>3901 Sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>5 BHK</td>\r\n			<td>4688 Sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>5 BHK Penthouse</td>\r\n			<td>7277 Sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>8 BHK Penthouse</td>\r\n			<td>9773 Sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(9, 0, 'Tata Housing Primanti Vertillas', 'tata-housing-primanti-vertillas-sector-72-gurgaon', NULL, 8, 1, 1, 3, 4, 1, 1, 4.80, 42, NULL, 'Sector 72', 'Southern Peripheral Road', '98 of 2017', 90, 90, 80000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 7000, 'high', NULL, 'newly_launched', 0, 'Located on Southern Peripheral Road (SPR), Tata Primanti sits in the center of all downtown amenities. Tata Primanti Vertillas Sector 72 is at a stone’s throw distance away from Intellion Edge, a 1.26 million sq. ft. high-end development featuring commercial and retail spaces. So, walking to your workplace will become a part of your everyday reality if you choose Tata Housing Primanti Vertillas as your home.', '<p>Tata Primanti Vertillas is heavily inspired by functional architecture and European-style living to offer unmatched amenities amidst nature. This breath-taking gated residential complex is the epitome of modern and luxury living. In addition to modernity, the project also holds its ground on eco-sustainability and energy conservation as it has been rated platinum by the Indian Green Building Council (IGBC).</p>\r\n\r\n<p>Spread out over an area of 36 acres, life at <em><strong>Tata Primanti Vertillas, Sector 72, Gurgaon</strong></em> will look like a day out of the leaf of your favourite fairy tale. Your friends will be especially envious of the indoor space that has a series of enchanting features like beautiful meadows, interconnected orchards, and gardens that run through the entire complex. So, experience a life of legacy and luxury amid a prime location at Tata Primanti Vertillas at Gurgaon.</p>\r\n\r\n<p>Large independent Villas as an exclusive part of TATA Primanti with two sizes 7000 &amp; 8500 sq ft. Tastefully curated for the selected few. It has its own basement with a sunken court and a private lap pool with garden gazebo. Uber-chic, stylish, and exclusive residence will make a unique fashion statement. Kohn Pedersen Fox Associates&rsquo; work of art is marked not only in these residences but everywhere the development - from the massive common areas to the luxurious clubhouses.</p>', NULL, '<p>TATA Primanti offers Apartments, Duplexes, and Vertillas. Each type of residence is thoughtfully designed to bring you closer to nature. This landmark architectural marvel integrates lifestyle, sustainability, and legacy through its array of super-premium villas and apartments. Tata Primanti price list gives buyers options to choose from 3, 4, and 5 BHK, 4 BHK independent floors, or 4 BHK villas ready to move in properties.</p>', NULL, 'TATA Primanti Vertillas Gurgaon - Check Price, Floor Plan', 'Tata Primanti Vertillas is located in Sector 72 the most promising location & heart of the bustling suburb of Gurgaon. Uber luxury independent Villas in Gurugram.', '20', '10', '5', '5', '10', '<ul>\r\n	<li>Weekend at your home in Tata Housing Primanti will never be the same with the temperature-controlled indoor pool.</li>\r\n	<li>Never worry about your loved ones with an A-class security system. Tata Housing Primanti Vertillas also includes amenities like security-controlled access and home automation.</li>\r\n	<li>Invoke the artist in you in the Mughal-inspired Delhi landscape indoor garden area.</li>\r\n	<li>Entertain yourself thoroughly in the indoor clubhouse, which is 2647 m2 big.</li>\r\n	<li>Sip your cuppa while enjoying panoramic views of the city. In addition, the architecture of the residential complex is such that residents get unparalleled access to daylight.</li>\r\n	<li>These 30 to 40 storey high-rise towers offer you breathtaking views of the surroundings.</li>\r\n</ul>', '\"properties/highlights/highlight_tata-housing-primanti-vertillas-sector-72-gurgaon_1759292241.png\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>4 BHK Villa</td>\r\n			<td>7000 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>4 BHK Villa</td>\r\n			<td>8500 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-10-02 20:54:34'),
(10, 0, 'Central Park Resorts Bellavista Towers', 'central-park-resorts-bellavista-towers-sector-48-gurgaon', NULL, 12, 1, 1, 1, NULL, 1, 1, 4.60, 58, '', 'Sector 48', 'Sohna Road', '', 90, 90, 30000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1065, 'high', NULL, 'newly_launched', 0, '', '<p>Central Park unveils Bellavista Tower - a fully furnished ultra-luxury, serviced apartments at Central Park Resorts, Gurugram. Central Park is known for developing unique concept living spaces and with Bellavista, it is setting a new benchmark. Central Park Resorts is home to over 500+ expats from over 30+ nationalities, out of which 300 are Japanese residents. Bellavista Tower is inspired by Japanese culture and way of life, these apartments will bring the cutting edge of Japanese luxury to life. The concept stems from the grand success of Central Park The Room, the fully serviced apartments, that yields one of the highest ROIs both in terms of appreciation and rental value, in the residential space.&nbsp;</p>\r\n', '', '', '', 'Central Park Resorts Gurgaon Sector 48 - PropNKey', 'Central Park Resorts Gurgaon is a premium residential complex Resorts with modern amenities and located on Sohna Road, Sector 48. Check price or book a call today!', '20', '5', '10', '5', '5', '<ul>\r\n	<li>Club house along with Olympic Sized Pool and all modern amenities.</li>\r\n	<li>Huge green area with in the project, both green facing and city facing homes.</li>\r\n	<li>In close proximity to renowned healthcare facilities like Medanta hospital, Fortis hospital, Max healthcare, Paras hospital, Artemis hospital etc.</li>\r\n	<li>Recreational &amp; Health Wellness areas with multiple celebration areas.</li>\r\n	<li>Temprature controlled Rooftop infinity pool.</li>\r\n	<li>Basement having 310 meters tunnel of international level making ZERO vehicles on surface.</li>\r\n	<li>Air conditioned lounges, World class gymnasium, cafeteria for the maids &amp; drivers.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_central-park-resorts-bellavista-towers-sector-48-gurgaon_1759292241.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>1 BHK</td>\r\n			<td>1065.00 sq.ft</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get Quote</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>1 BHK</td>\r\n			<td>1217.00 sq.ft</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get Quote</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>1 BHK</td>\r\n			<td>1356.00 sq.ft</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get Quote</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(11, 0, 'Silverglades Hightown Residences', 'silverglades-hightown-residences-sector-28-gurgaon', NULL, 9, 1, 1, 1, NULL, 1, 1, 4.60, 77, '', 'Sector 28', 'Sushant Lok 1', 'APRIL/2026', 90, 1, 50000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2150, 'high', NULL, 'newly_launched', 0, 'The three-tower project is a powerhouse of amenities. From senior citizen\'s area to an amphitheatre, reading lounge to household help accommodation, Hightown Residencies has it all. Thus, each square foot of the Hightown Residencies caters to your lifestyle and needs.', '<p>Situated in the city&#39;s heart, <strong>Hightown Residencies</strong> is an ambitious project that promises ultimate luxurious living. The project has the finest amenities, enabling residents to enjoy and nurture their lives at the <strong>Silverglades Hightown Residencies</strong>.</p>\r\n\r\n<p>It is spread across a sprawling 5 acres of land, thus giving residents access to large open spaces and greenery. At <strong>Hightown Residencies Gurgaon</strong>, you can expect cutting-edge technology of security as well in Hightown Residencies. Your home will be earthquake-resistant and include a 3-tier security system to give you a sound, peaceful sleep.</p>\r\n\r\n<p>Besides these, <strong>Hightown Residencies has 3 &amp; 4BHK apartments</strong> to let you immerse yourself in the beauty and tranquility of nature. So, relish the little joys in life with your loved ones at Hightown Residences like never before.</p>\r\n\r\n<p>With 3 and 4BHK apartments, <strong>Hightown Residencies Sector 28</strong> caters to the needs of one and all. The project has a theme-based architecture, thus making your home a landmark of the city!</p>\r\n\r\n<p>The bar and the rooftop infinity pool make Hightown Residencies the epitome of luxurious living.</p>\r\n\r\n<div class=\"row col-md-12\">\r\n<h3><strong>Hightown Residences Payment Plan</strong></h3>\r\n</div>\r\n\r\n<div class=\"row col-md-12\">\r\n<ul>\r\n	<li>30% in 4 months</li>\r\n	<li>30% on Super structure</li>\r\n	<li>40% on Possession</li>\r\n</ul>\r\n</div>\r\n', '', '<p>The 3 and 4 BHK apartments are designed to fuse luxury and utility. The premium homes built in the three-tower residency project has 260 plush homes in an area of 5 acres, carefully curated to give every resident a fulfilling life. Hightown Residencies is currently under construction and will be available for possession by March 2025. Here you can find the complete floor plan of Hightown Residences by Silverglades:</p>\r\n', 'Limited period offer. Payment plan of project is 30% in 4 months, 30% on Super structure and 40% on possession.', 'Hightown Residences Gurgaon | Hightown Sector 28', 'Hightown Residences by Silverglades located in Sector 28, Sushant Lok 1 Gurgaon. Price starting from 5 crore* onwards. Check floor plan, pictures and reviews.', '10', '2', '2', '2', '2', '<ul>\r\n	<li>Sitting pretty opposite to the Laburnum, <strong>Hightown Residencies</strong> is located in the middle of Gurgaon.</li>\r\n	<li>Hightown Residencies successfully harmonizes utility and luxury by delivering a ton of amenities.</li>\r\n	<li>Environmental consciousness is of great concern with added conveniences like solar energy, sewage treatment, rainwater harvesting, etc.</li>\r\n	<li>The towers are Vaastu-compliant and have a building plan which inspires outdoor living. So be it the outdoor garden area or the infinity pool, basketball court, or the wine cellar, the entire complex is carefully planned.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_silverglades-hightown-residences-sector-28-gurgaon_1759292241.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Super Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Carpet Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>3 BHK</td>\r\n			<td>2150 sq.ft.</td>\r\n			<td>1150 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK</td>\r\n			<td>2500 sq.ft.</td>\r\n			<td>1447 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>4 BHK</td>\r\n			<td>3300 sq.ft.</td>\r\n			<td>1980 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(12, 0, 'Sushma Elementa', 'sushma-elementa-dharampur-kasauli', NULL, 10, 1, 4, 1, NULL, 1, 1, 4.90, 68, 'Holiday Home', 'Dharampur', 'Dharampur', '', 90, 90, 3690000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 630, 'low', NULL, 'newly_launched', 0, '', '<p>Spread over 6 acres, Elementa is an uphill property where the stunning view of the valley&nbsp;fills your soul with calmness. And the whistling woods transport you to a world unknown.</p>\r\n\r\n<p>A breezy 60-minute drive from Chandigarh and 10 minutes from Highway, on the road to Kasauli lies the sleepy quaint little hill town of Dharampur. Surrounded by the mighty Himalayas, this undiscovered gem with misty hills and majestic pine trees is home to Elementa.</p>\r\n', '', '', 'Get 9% assured return ill possession!!', 'Sushma Elementa in Kasauli, Best Holiday Homes - Price List, Brochure', 'Sushma Elementa in Kasauli is a residential Holiday Homes project By Sushma Group. Sushma Elementa price ranges from 39.9 Lacs to 80 Lacs. Check Floor Plan, Brochure.', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12');
INSERT INTO `properties` (`id`, `is_featured`, `name`, `slug`, `alias_name`, `partner_id`, `agent_id`, `location_id`, `property_type_id`, `bedroom_option_id`, `property_category_id`, `property_condition_id`, `rating`, `review_count`, `badge`, `locality`, `address`, `rera_reg_no`, `sort_order`, `home_sort`, `price`, `monthly_rent`, `security_deposit`, `one_time_fees`, `total_payable`, `rent_includes`, `rent_excludes`, `rental_process`, `dos_donts`, `lock_in_period_days`, `notice_period_days`, `terms_conditions`, `is_rental`, `area_sq_ft`, `rise`, `possession`, `property_status`, `is_sold`, `amenities_description`, `property_description`, `gallery_description`, `floor_plan_description`, `offer_text`, `meta_title`, `meta_description`, `airport`, `entertainment`, `national_highway`, `hospitals`, `education`, `project_highlights_title`, `highlight_images`, `location_features`, `price_list`, `map_code`, `map_text`, `is_active`, `created_at`, `updated_at`) VALUES
(13, 0, 'Villa Anjuna', '3bhk-luxury-villa-anjuna-beach-goa', NULL, 1, 1, 5, 3, NULL, 1, 1, 4.70, 71, 'Holiday Home', 'Anjuna Beach', 'Anjuna Village', '', 90, 90, 45000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 5112, 'low', NULL, 'newly_launched', 0, '', '<p>Anjuna Villa is a 3 BHK luxury holiday home villa located in Anjuna Beach, which is one of the best places to have unlimited fun &amp; entertainment in North Goa. The villa is close to some of the happening places in Anjuna including the Vagator beach, Ashwem Beach, Saturday night market, Ciao Bella, and more. You can reach the airport from the villa within an hour.</p>\r\n\r\n<ul>\r\n	<li>2 mins from The German bakery</li>\r\n	<li>5 mins from Cafe Orange Bloom</li>\r\n	<li>10 mins from Anjuna Flea Market</li>\r\n	<li>15 mins from Anjuna Beach</li>\r\n	<li>15 mins from Curlies Shack</li>\r\n</ul>\r\n', '', '', '', 'Villa Anjuna  3 BHK Luxury Holiday Stays In Goa', 'Anjuna Villa is a 3 BHK luxury holiday home villa located in Anjuna Beach, which is one of the best places to have unlimited fun & entertainment in North Goa.', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(14, 0, '4BHK Villa Anjuna', '4bhk-independent-villa-anjuna-beach-goa', NULL, 1, 1, 5, 3, NULL, 1, 1, 4.50, 60, 'Holiday Home', 'Anjuna Beach', 'Anjuna Village', '', 90, 90, 40000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2255, 'low', NULL, 'newly_launched', 0, '', '<p>4BHK recently renovated semi-furnished Portuguese Luxury Villa near Anjuna Beach with a swimming pool, park, visitor parking features. It&#39;s an authentic 4 bedroom sprawling villa in Anjuna Village, North Goa.</p>\r\n\r\n<ul>\r\n	<li>Plot size:&nbsp;57 5 sq meters</li>\r\n	<li>Built-up: 208 sq meters</li>\r\n</ul>\r\n', '', '', '', '4 BHK Luxury Villa For Sale in Anjuna, North Goa', 'Buy 4 BHK Luxury Independent House / Villa in Anjuna, North Goa. View contact number for free. Click for complete details on propnkey.com', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(15, 0, 'Omaxe Chandni Chowk', 'omaxe-chandni-chowk-chandni-chowk-delhi', NULL, 11, 1, 2, 5, NULL, 1, 1, 4.60, 47, '', 'Chandni Chowk', '', '', 90, 90, 5000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 200, 'high', NULL, 'newly_launched', 0, 'Omaxe Chandni Chowk is where all the action happens. Because of its central location, you can commute to any part of Delhi in minutes. It is just minutes away from the Chandni Chowk Metro Station, Old Delhi Railway Station, Paranthe Wali Gali, Hardayal Municipal Heritage Public Library. At Omaxe Chandni Chowk, you will be investing in a place which is the crème-de-la-crème of all commercial spaces in Delhi. So, expect your business to sky-rocket in days at Omaxe, Delhi Central.', '<p>Omaxe Chandni Chowk is the largest wholesale market development in Chandni Chowk, New Delhi.&nbsp;This 22-metre high building is expected to encompass around 3.6 lakh sq. ft. space for retail and 1.5 lakh sq. ft. for food &amp; beverages.&nbsp;</p>\r\n\r\n<p>The building is situated on the 100 Ft wide HC Sen Marg, adjacent to Chandni Chowk metro station. The well-planned placement of Omaxe Chowk makes it proximal to all important locations like Sis Ganj Gurudwara, 3 min. walk from Old Delhi Railway Station, 5 min. walk from Red Fort and several other heritage properties which millions of tourists visit every year.</p>\r\n\r\n<p>If you are a connoisseur of art and architecture, Omaxe Chandni Chowk is the right address for you. This commercial project is inspired by Mughal and Indo-British architectures, a unique fusion of different cultures in our history. So, at Omaxe Chandni Chowk, Delhi Central, you can own a palace-like business arena at the heart of the city.</p>\r\n\r\n<p>The project is the most extensive development in the Chandni Chowk area and is GRIHA 5-star rated eco-friendly construction. So, at Omaxe Chandni Chowk, Delhi you can own a carbon-neutral commercial space built with the greenest construction methods. Thus, own a luxurious space at Omaxe with the promise of the most modern amenities at a super-envious location.</p>\r\n', '', 'Omaxe Chandni Chowk offers an old-world charm with modern amenities. The interior spaces are inspired by the Mughal area and Indo-British history, giving the project a touch of royal elegance. The project is spread out over 4.6 acres of land, including 3.3 lakh sq. ft. for retail and commercial establishments. Omaxe Chandni Chowk price list includes a built-up area from 50 to 1116 sq. ft. So, there are business spaces for commercial establishments of all sizes, needs, and types.', '', 'Omaxe Chandni Chowk - Retail Shops @ 50 Lakhs*', 'Omaxe Chandni Chowk is the largest wholesale market development in Chandni Chowk, New Delhi. Check floor plan, price, review and more.', '0', '0', '0', '0', '0', '<ul>\r\n	<li>Omaxe Chandni Chowk will revolutionize the way businesses are carried out with architecture and location making your commercial establishment a highlight of the city. At Omaxe, you can have access to a range of shops and modern amenities.</li>\r\n	<li>Omaxe has 5-level parking and exclusive valet service for its owners.</li>\r\n	<li>The project sports an iconic architectural look resulting from the fusion of Mughal and Indo-British architectures.</li>\r\n	<li>For the owners, there is a dedicated area measuring more than 10000 m2 for food and beverages.</li>\r\n	<li>The project will have a proposed entry from Chandni Chowk Metro Station. Therefore, business owners will have direct access to easy metro transportation.</li>\r\n	<li>There is a provision of exclusive privileged business cards for business owners at Omaxe.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_omaxe-chandni-chowk-chandni-chowk-delhi_1759292242.png\"', NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(16, 0, 'AIPL Joy Gallery', 'aipl-joy-gallery-sector-66-gurgaon', NULL, 2, 1, 1, 5, NULL, 1, 1, 4.60, 66, '', 'Sector 66', '', '', 90, 90, 6402000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 388, 'low', NULL, 'newly_launched', 0, '', '<p>AIPL Joy Gallery in Sector 66 Gurgaon is a high-end mixed-use retail development that elevates of retail and F&amp;B experience by a good few notches. Located on the main Golf Course Extension Road, these retail shops are characterized by a lot of strategic features, including.</p>\r\n\r\n<ul>\r\n	<li>The entire project covers an area of 4.28 acres in which the super area covers 3,41,564 sq. ft. in total.</li>\r\n	<li>A prominent commercial development, AIPL Joy Gallery is located on the main Golf Course Extn. Road in Sector 66, Gurgaon which ensures that you face no connectivity issues.</li>\r\n	<li>AIPL Joy Gallery is a high-end mixed-use retail development where you can find some of the most top-notch Retail Shops on Golf Course Extension Road.</li>\r\n	<li>Joy Gallery offers a joyful mix of experiences, ranging from premium high-street retail and F&amp;B outlets with a food court to restaurants &amp; cafes and an entertainment zone.</li>\r\n</ul>\r\n', '', '', '', 'AIPL Joy Gallery Sector 66 Gurgaon | Price List, Floor Plan', 'AIPL Joy Gallery in Gurugram is the commercial evolution based in Sector 66, created by AIPL. Check the Price List, Floor Plan and Reviews. ', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(17, 0, 'Silverglades Golf Resort & Studio Apartments', 'silverglades-studio-apartments-villa-tarudhan-valley-manesar', NULL, 1, 1, 6, 6, NULL, 1, 1, 4.90, 48, 'Holiday Home', 'Tarudhan Valley', '', '', 90, 90, 6500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1000, 'low', NULL, 'newly_launched', 0, '', '<p>Tarudhan Valley Studio Apartments and Villas, a residential project that gives you the scope to enjoy countryside living along with all the facilities of modern life.&nbsp;</p>\r\n\r\n<p>Villas &amp; Studio apartments craft-fully designed for the selected few. All homes overlooking a serene and beautiful 9 hole Golf Course designed by the renowned Golfer &amp; Architect Graham Cooke! The resort has its own Clubhouse and a fully functional lemon tree Hotel. Beautifully managed with the most advanced security systems.</p>\r\n\r\n<ul>\r\n	<li>Villas 2500 sq.ft.</li>\r\n	<li>GF Living</li>\r\n	<li>Dining FF</li>\r\n	<li>2 Bedrooms along with basement</li>\r\n	<li>Studio apartments 1000 sq.ft. - 1200 sq.ft.</li>\r\n</ul>\r\n', '', '', '', 'Silverglades Studio Apartments & Villa for Sale in Tarudhan Valley, Manesar', 'Silverglades Studio Apartments & Villa for Sale in Tarudhan Valley Manesar - View floor plan, price list, and review.', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(18, 0, 'Paras Quartier', 'paras-quartier-gwal-pahari-gurgaon', NULL, 13, 1, 1, 1, 2, 1, 1, 4.70, 55, NULL, 'Gwal Pahari', 'Gurgaon Road, Sector 2', NULL, 90, 90, 85000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 5, 'high', NULL, 'newly_launched', 0, 'Paras Quartier is nestled amid nature. It also packs in a ton of features. The residential complex is only a 5-minute drive away from all the necessary amenities like a market, temple, bank, ATM, medical store, school, hospital, etc.', '<p>Offering contemporary architecture with comfortable living, <strong>Paras Quartier</strong> is the epitome of living in Gwal Pahari, Gurgaon. It is the tallest project in the city and offers 300 degrees view of the Aravallis. Also, the residential towers give unparalleled access to natural light. So, sip away your morning and evening teas while enjoying the views of the Aravallis.</p>\r\n\r\n<p>With only two apartments per floor, the <strong>4 BHK flats</strong> are spacious and well-ventilated. Thus have a happening weekend party at your balcony or the complex clubhouse.</p>\r\n\r\n<p>And that is not all. You will also get the benefit of private elevator access.</p>\r\n\r\n<p>Located in Gwal Pahari, <strong>Paras Quartier</strong> offers many amenities, including a plush rooftop infinity pool, a mesmerizing sun deck, and a well-equipped gymnasium to work those muscles, indoor recreational areas like squash court, banquet hall, community hall, etc.</p>\r\n\r\n<p>The residential complex conforms to the norms of Vastu. Besides, the residents will get 10.09 acres of total area. The residential complex is well-planned to leave 50% of the total area as open space. So, nurture your life with nature&#39;s gifts at Paras Quartier Gurgaon.</p>', NULL, '<p>The complex has two towers and each floor is designed to deliver unparalleled luxury and comfort to our buyers. Each tower is constructed to make the Aravallis a visual pleasure for the residents while giving them access to ample natural light and air. Currently, the project is under construction with possession starting from December 2021.</p>', NULL, 'Paras Quartier Gurgaon - Check Price, Floor Plan | PropNKey', 'Paras Quartier Gurgaon - An Ultra Luxury residential project by Paras Buildtech based in Gwal Pahari, Gurugram. Book your Ready to move 4 BHK apartment today!', '20', '10', '15', '5', '5', '<ul>\r\n	<li>Paras Quartier is engineered around premium build quality that offers 4BHK apartments for all, with just two apartments per floor.</li>\r\n	<li>Each apartment provides an unhindered 300 degrees view of the Aravallis and luxurious amenities like an infinity pool, sun deck, etc.</li>\r\n	<li>The project is the tallest in all of Gurgaon.</li>\r\n	<li>The project offers Apartments with a perfect combination of contemporary architecture and features to provide a comfortable living.</li>\r\n</ul>', '\"properties/highlights/highlight_paras-quartier-gwal-pahari-gurgaon_1759292243.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>4 BHK Apartments</td>\r\n			<td>5360 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>4 BHK Apartments</td>\r\n			<td>6000 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-10-02 20:54:27'),
(19, 0, 'Mahindra Luminare', 'mahindra-luminare-sector-59-gurgaon', NULL, 14, 1, 1, 1, NULL, 1, 1, 4.60, 90, '', 'Sector 59', 'Golf Course Extn. Road', '', 90, 90, 52000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2985, 'high', NULL, 'newly_launched', 0, 'Mahindra Luminare Gurgaon packs in exceptional amenities for its residents. Private lift lobbies, wrap-around balconies, urban river with gazebos, Mahindra Luminare Sector 59 has them all. Thus if you wish to soak in the peace or want to jot down your thoughts, you will discover such spaces in ample in the complex. ', '<p>Mahindra Luminare is an ultra-luxurious project with coveted corner apartments and wrap-around L-shaped balconies with a panoramic view of Aravalli greens. Fancy yourself painting innumerable pictures in the blue canvas of the sky!</p>\r\n\r\n<p><strong>Mahindra Luminare&nbsp;Sector 59</strong> helps you find solitude without compromising on the contemporary amenities. Close to the Delhi Airport, <strong>Mahindra Luminare</strong> provides a unique mixture of calm and convenience. So, enjoy the fusion of modern architecture with comfortable living in Mahindra Luminare.</p>\r\n\r\n<p>Located 25 minutes away from DLF Cyber Hub, you can now while your worries of daily traffic away. Different educational institutes are also near the residential area. Thus, <strong>Mahindra Luminare Gurgaon</strong> offers the unparalleled advantage of seclusion in one of the best neighborhoods in Gurgaon.</p>\r\n', '', '<p>Mahindra Luminare has 360 units of 3, 4, and 5 BHK apartments and penthouses on offer, spread out over 7 acres. Each of these luxury flats, ranging from 2985 square feet to 3625 square feet, has wrap-around balconies, a private lift, a lobby, and corner homes to offer extraordinary living. So, at Mahindra Luminare Gurgaon, you can experience life among the clouds while embracing nature.</p>\r\n', 'Mahindra Luminare New Tower B Launched. Book Now', 'Mahindra Luminare Gurgaon - Check price,  Floor Plan | PropNKey', 'Mahindra Luminare is offering Ready-to-move 3 & 4 BHK Luxury Homes in Sector 59 Gurgaon with unmatched modern amenities. Schedule free visit today!', '25', '10', '10', '10', '10', '<ul>\r\n	<li>Mahindra Luminare is a marriage of solitude and contemporary amenities.</li>\r\n	<li>Intricate attention has been paid to each detail, including a <em><strong>swimming pool for kids</strong></em> to not miss out on the fun.</li>\r\n	<li>An urban river landscape with gazebos to give you the perfect area to recollect and create.</li>\r\n	<li>The residential project will inspire the sportsperson in you with spaces like a Squash court, Basketball court, banquet hall, etc.</li>\r\n	<li>The complex has a plush swimming pool and a gymnasium for residents to maintain their fitness.</li>\r\n	<li>A life marked with <strong><em>Unseen Exclusivity and Utmost privacy</em></strong>.</li>\r\n	<li>An environment that evokes a sense of comfort among the clouds.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_mahindra-luminare-sector-59-gurgaon_1759292243.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>3BHK+SQ</td>\r\n			<td>2985 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>4BHK+SQ</td>\r\n			<td>3625 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>4 BHK Penthouse</td>\r\n			<td>4887 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>5 BHK Penthouse</td>\r\n			<td>6085 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(20, 0, 'AIPL The Peaceful Homes', 'aipl-the-peaceful-homes-sector-70-a-gurgaon', NULL, 2, 1, 1, 1, NULL, 1, 1, 4.60, 42, '', 'Sector 70-A', 'Southern Peripheral Road', '', 90, 90, 17000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1565, 'high', NULL, 'newly_launched', 0, '', '<p>Part of 11.5 acre group housing in&nbsp;<b>Sector 70-A, SPR, Gurgaon</b>, AIPL Peaceful Homes are 2 / 3 / 4 BHK residences with premium specifications. Construction is currently on in the various towers.&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Located in Sector 70-A, SPR, Gurgaon with the main entry from 60-meter wide sector road and a secondary entry from 24-meter sector road;</li>\r\n	<li>In close proximity to existing developments Golf Course Extension Road and Sohna Road. Habitation has already commenced in Sector 70-A and neighboring sectors including Sector 69;</li>\r\n	<li>In close proximity to premium retail, office complexes, reputed schools, colleges and entertainment, and F&amp;B outlets;</li>\r\n	<li>Easy access to IGI Airport and New Delhi through NH8 and NH236;</li>\r\n	<li>Close to the proposed metro corridor on SPR;</li>\r\n	<li>Surrounded by premium low rise development.</li>\r\n</ul>\r\n', '', '<p>Designed to maximize efficiency and space, each residential unit at The Peaceful Homes is a study in design. Each premium residence in has been crafted with the delicate balance of planning and practicality to create spaces as endless as your dreams.</p>\r\n', '', 'AIPL The Peaceful Homes Sector-70A Gurgaon | Price & Floor Plan', 'AIPL The Peaceful Homes Gurgaon is an exclusive Project located in Sector 70A. Checkout price list, floor plan, review and more. ', '20', '10', '5', '10', '10', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(21, 0, '1 BHK Apartment in Kasauli', '1-bhk-apartment-in-kasauli-dagshai-kasauli', NULL, 1, 1, 4, 1, NULL, 4, 1, 4.50, 54, 'Holiday Home', 'Dagshai', 'Nahan Road', NULL, 90, 90, 3900000.00, 13200.00, 13500.00, 10000.00, 222000.00, 'nothing', 'nothing', NULL, NULL, 180, 45, NULL, 1, 600, NULL, NULL, 'newly_launched', 0, NULL, '<p>Kasauli is a peaceful , picturesque hillstation in the charming state of Himachal Pradesh. Pefect for those looking for a quick getaway from Chandigarh and Delhi, Own your apartment in this beautiful hill station which is very well connected from Chandigarh and Delhi.Located at the Nahan Highway 3 kms from Kumarhatti chowk, and a 15 minutes drive from Dharampur. Surrounded by forests are these fully services 1 BHK units</p>\r\n\r\n<p>Housekeeping facilities, power back up, covered car parking, 24*7 water supply&nbsp;both cold &amp; hot and to top it all a terrace with Gazebos ,&nbsp;outdoor barbeque and sit out overlooking the valley.</p>\r\n\r\n<p>1 BHK- 600&nbsp;Sq ft apartment.</p>', NULL, NULL, 'Get Return on Investment @ 5.5% Per Annum.', '1 BHK Apartment For Sale in Kasauli | Flats for Sale in Kasauli', 'Ready-to-move 1 BHK Flats/Apartments for Sale in Kasauli - Buy 1 BHK residential 600 sq.ft. flats for sale at best price in Kasauli, Solan. Call us at 09717672008', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-09-30 13:52:12', '2025-10-04 13:04:12'),
(22, 0, 'Villa Resort in Chail', 'villa-resort-in-chail-kasauli', NULL, 1, 1, 7, 3, NULL, 1, 1, 4.70, 54, 'Holiday Home', 'Chail', 'Chail ', '', 90, 90, 15000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1800, 'low', NULL, 'newly_launched', 0, '', '<p>Chail, stay in the lap of nature known for its salubrious beauty and virgin forests are these 10 luxury cottages overlooking the valley which offers magnificent and panoramic views of the surrounding countryside.</p>\r\n\r\n<p>Easily connected by all major roads, 45 kms from Shimla, 7 hours from Delhi, and only 3 hours from Chandigarh.</p>\r\n\r\n<p>Total Land over 15 Bighas. Cottage sizes vary from 1800 sq ft. to over 3300 sq ft.&nbsp;</p>\r\n', '', '', '', 'Resort for Sale in Chail | 3 BHK Villa for Sale in Kasauli', 'Resort for sale in Chail Shimla - Residential independent 3BHK Villa, Resort with valley view available for sale in Chail Road, Himachal Pradesh. Contact us now! ', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(23, 0, 'Super Luxury Cottage in Kasauli', 'super-luxury-cottage-in-divine-valley-kasauli', NULL, 1, 1, 4, 7, NULL, 1, 1, 4.60, 67, 'Holiday Home', 'Divine Valley', '', '', 90, 90, 65000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 5500, 'low', NULL, 'newly_launched', 0, '', '<p>Very tastefully furnished is this cottage designed by one of the renowned architects in India, located in the Divine Valley a prestigious community with just 20 minutes drive to Kasauli, a small hill town and a cantonment in Himachal. Connected by all major roads, an hours drive from Chandigarh and 6 hours from Delhi. It&#39;s part of a gated community with a large landscaped garden and car parking space for atleast 10 cars.&nbsp;</p>\r\n\r\n<p>Total land area- 500 Sq yards with 5500 sq ft built up. The cottage has a configuration of 5 bedrooms with attached bathrooms, 2 separate living rooms, one large fully equipped kitchen, 1 small kitchen, dining area, a big loft, 2 big verandahs, and a beautiful garden. It also has 2 servant quarters with an attached toilet and kitchen plus 2 store rooms.&nbsp;</p>\r\n', '', '', '', 'Super Luxury Cottage in Kasauli for Sale | 5BHK Villa for Sale', 'Buy Super Luxury Cottage in Kasauli - 5 BHK Luxury Villa Cottage for Sale in near Kasauli. Ready-to-move Luxury Villa for sale.   ', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(24, 0, 'The Calissa- Luxury Holiday Homes by Greenambit', 'the-calissa-luxury-holiday-homes-by-greenambit-north-goa-goa', NULL, 1, 1, 5, 1, NULL, 1, 1, 4.60, 82, 'Holiday Home', 'North Goa', 'Calangute, Dongarpur', '', 90, 90, 6500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 550, 'low', NULL, 'newly_launched', 0, '', '<p>It may be interesting for you to know us as we come with an unbound vision dressed for success. We bring you an address way beyond a recognition. An address what you call &lsquo;<strong>A Greenambit Living</strong>&rsquo;.</p>\r\n\r\n<p>The Calissa, an eco elegant edition of one BHK apartments crafted with opulence of nature. It is a perfect installment to spend time with your loved ones &amp; rejuvenate your senses.</p>\r\n\r\n<p><strong>Some special features we offer are:</strong></p>\r\n\r\n<ul>\r\n	<li>Concierge services</li>\r\n	<li>Oxygen Pool</li>\r\n	<li>Car Parking Facility</li>\r\n	<li>Lift</li>\r\n	<li>Spacious Living</li>\r\n	<li>Panoramic Green View</li>\r\n	<li>Organic life</li>\r\n	<li>24*7 Manned &amp; Automatic Security</li>\r\n	<li>Provision for power back up</li>\r\n	<li>Water Proofing</li>\r\n	<li>Rent Management Services</li>\r\n	<li>Housekeeping Services</li>\r\n</ul>\r\n', '', '', '', 'Luxury Holiday Homes by Greenambit | Greenambit Homes Goa for Sale', 'The Calissa by Greenambit Goa - Luxury Holiday Homes for Sale in Goa. Book 1 BHK Apartment starting from Rs 65 Lacs onwards. Book free site visit today!', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(25, 0, 'DLF Samavana ', 'dlf-samavana-kasauli-himachal-pradesh', NULL, 4, 1, 4, 1, NULL, 1, 1, 4.60, 69, 'Holiday Home', 'Kasauli', 'Jagjit Nagar Ridge', '', 90, 90, 11000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 915, 'low', NULL, 'newly_launched', 0, '', '<p>Samavana is a ready to move in project by India most coveted brand DLF, spread across 58 acres at an altitude of 4800 ft. Its located amidst the most dense and huge pine forests located in close proximity to the finest schools in the region like Lawrence school Sanawar, Pinegrove etc. Samavana has&nbsp;got an excellent connectivity from National Highway to Garkhal shortening the drive to Kasauli by 40 minutes. Samavana has 1 BHK (915 Sq ft) 2.5 BHK(1384 Sq ft) and Plots starting from 669 sq yards to 2400 Sq yards.</p>\r\n', '', '', '', 'DLF Samavana Kasauli Apartments | Property in Kasauli for Sale', 'DLF Samavana Apartments & Villa Kasauli - Ready to move, luxury flats, 1 bhk, 2.5 bhk apartments and villas for sale in Kasauli. Click for project details.', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(26, 0, 'Uber Luxury Cottage in Goa', 'uber-luxury-cottage-in-anjuna-beach-goa', NULL, 1, 1, 5, 7, NULL, 1, 1, 4.90, 57, 'Holiday Home', 'Anjuna Beach', 'Anjuna Beach', '', 90, 90, 160000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 6000, 'low', NULL, 'newly_launched', 0, '', '<p>This is the one of the best Villa in the entire North Goa, close to the Anjuna Beach. which is 19 kms from Panaji and&nbsp; 8 kms to the west of Mapusa. Anjuna&nbsp;is famous for its parties and flea market which happens every Saturday where products from all over the India can be purchased.</p>\r\n', '', '', '', 'Uber Luxury Cottage for Sale in Anjuna Beach, Goa', 'Uber Luxury Cottage for Sale in Anjuna Beach Goa - Luxury 5 BHK Cottage for Sale in Goa. Book 5 BHK Apartment starting from Rs 16 crore onwards. Book free site visit today!', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(27, 0, 'Hill View Apartments Mashobra', 'hill-view-apartments-for-sale-mashobra-kasauli', NULL, 1, 1, 4, 1, NULL, 1, 1, 4.70, 41, 'Holiday Home', 'Mashobra', 'Near Mahasu House', '', 90, 90, 4900000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 600, 'low', NULL, 'newly_launched', 0, '', '<p>A small and relatively less explored town, A mere 10 kms from Shimla. Favorite for tourists who come here to relax and unwind in the lap of nature where richness in flora &amp; fauna is in abundance. This lush green place has a myriad variety of wild animals and is a haven for wildlife enthusiasts. This place also hosts the annual sipi fair in June. The apartments have got an excellent view of the hills something the tourists long for.</p>\r\n', '', '', '', 'Hill View Apartments For Sale in Mashobra, Kasauli', 'Hill View Apartments in Mashobra & Kasauli – Wake up to breathtaking mountain views, fresh air, and serene surroundings. Enquire now!', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(28, 0, 'AIPL Zen Residences', 'aipl-zen-residences-sector-70a-gurgaon', NULL, 2, 1, 1, 1, NULL, 1, 1, 4.60, 44, '', 'Sector 70-A', 'Southern Peripheral Road', '', 90, 90, 14000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1262, 'high', NULL, 'newly_launched', 0, 'Spread over vast, lush green splendor, The Zen Residences will leave you with absolute tranquillity. Breathe in the fresh air and breathe out all the stress. You are at The Zen Residences Now.', '<p>Offering some of the best <strong>residential apartments in Gurgaon</strong> that have been thoughtfully designed, <strong>AIPL Zen Residences</strong> are all about absolute tranquillity. The residences comprise of 2 and 3 BHK flats that are available in sizes of 1262 sq. ft. and 1655 sq. ft., respectively. Moreover, <strong>Zen Residences</strong> benefit from a prime location which offers an endearing view of the Aravalli range as well.</p>\r\n\r\n<h3>Best Residential Property In Gurgaon With&nbsp; Modern Amenities</h3>\r\n\r\n<ul>\r\n	<li><a>Pet garden</a></li>\r\n	<li><a>Meditation garden</a></li>\r\n	<li><a>Driver waiting area</a></li>\r\n	<li><a>Separate service elevators for domestic help</a></li>\r\n	<li><a>Dual-energy prepaid billing system</a></li>\r\n	<li><a>Access for Disabled</a></li>\r\n	<li><a>Services Convenience for support staff</a></li>\r\n	<li><a>Provision for intercom facility</a></li>\r\n	<li><a>Eco-friendly design concepts</a></li>\r\n	<li><a>Stormwater drainage &amp; recharge system</a></li>\r\n	<li><a>Re-use of treated water from central STP for flushing and horticulture</a></li>\r\n	<li><a>Solid waste management through efficient collection and transportation systems</a></li>\r\n</ul>\r\n', '', '<p>Designed to maximize efficiency and space, each residential unit at The AIPL Zen Residences is a study in design. Each premium residence in has been crafted with the delicate balance of planning and practicality to create spaces as endless as your dreams.</p>\r\n', '', 'AIPL Zen Residences Sector-70A Gurgaon - Check Price & Floor Plan', 'AIPL Zen Residences Gurgaon is an exclusive Project located in Sector 70A. Checkout price list, floor plan, review and more. ', '20', '10', '5', '10', '10', '<ul>\r\n	<li>Outdoor Sports facilities including Jogging track, Badminton/Basketball/Football practice courts, Swimming Pool, Kids Pool.</li>\r\n	<li>Double height air-conditioned &amp; furnished entrance lobby under each tower</li>\r\n	<li>Convenient location of amenities like a nursery, primary schools, recreational club, retail areas</li>\r\n	<li>This project is a part of 11.7 acres of The Peaceful Homes project</li>\r\n	<li>100% groundwater recharge through rainwater harvesting structure</li>\r\n	<li>Provision of the Grocery store, Florist, ATM, Laundromat, Mobile shop, Courier collection shop, Facility shop, Dry cleaning/Ironing, First aid room/Pathology lab/Chemist, Bakery, Fruits &amp; Vegetables, Saloon, Stationery, Tailor, Shoe shop/cobbler, Small departmental store</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_aipl-zen-residences-sector-70a-gurgaon_1759292244.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>2 BHK</td>\r\n			<td>1262 sq. ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK</td>\r\n			<td>1655 sq. ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(29, 0, 'Luxury Hills Apartments In Shimla', 'luxury-hills-apartments-for-sale-in-shimla', NULL, 15, 1, 8, 1, NULL, 1, 1, 4.60, 59, 'Holiday Home', 'Naldehra', '', '', 90, 90, 12000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1500, 'low', NULL, 'newly_launched', 0, '', '<p>An ideal township and the perfect Himalayan hideaway that offers you a home in the lap of nature. It has been inspired by countryside living and offers luxury, peace, and a healthy environment.&nbsp;Each single home at this township&nbsp;has a view facing the woods, valleys, or the mountains. The earthy &ndash; burnt brick and stone exteriors merge into the hues of the environment, placating the observer&rsquo;s soul and transporting it to a state of bliss.&nbsp;</p>\r\n', '', '', '', 'Luxury Hills Apartments for Sale in Shimla | Property In Shimla', 'Luxury Apartments for Sale in Shimla - Ready to move, luxury flats, apartments and villas for sale in Shimla. Click for project details and price.', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(30, 0, 'Luxury Villas With Private Pool for Sale in Goa', 'luxury-villas-with-private-pool-for-sale-in-siolim-goa', NULL, 15, 1, 5, 3, NULL, 1, 1, 4.60, 70, 'Holiday Home', 'Siolim', '', '', 90, 90, 57500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4981, 'low', NULL, 'newly_launched', 0, '', '<p>Just few minutes away from the morjim beach, it&#39;s the perfect place to relax, swim or arrange surf lession during the day and have a refreshing drink at sunset.&nbsp;</p>\r\n', '', '', '', 'Luxury Villas With Private Pool for Sale in Gola', 'Luxury Villas for Sale in Gola - Ready to move, luxury apartments, independent villas for sale in Siolim, Goa. Click for project details and price.', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(31, 0, 'Elan - Nirvana ', 'elan-sector-50-gurgaon', NULL, 15, 1, 1, 5, NULL, 1, 1, 4.50, 85, '', 'Sector 50', 'Nirvana Country', '', 90, 90, 15000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 600, 'low', NULL, 'newly_launched', 0, '', '<p>Elan Group is amongst Gurgaon&#39;s leading and fast emerging commercial developers. They&nbsp;launching their highly sought after project in Nirvana Country,sector 50 .The project is a combination of high end retail units facing a massive atrium, food court and restaurant spaces with a multiplex which will the only multiplex in Nirvana Country.</p>\r\n\r\n<p>High Street Retail with Multiplex and Restaurant options in the Elite Neighbourhood of Nirvana Country. It&#39;s one of the very carefully designed commercial complexes which Gurgaon will be witnessing. Encircled by Luxury Township&#39;s, Elite Schools, and IT SEZ&#39;s. etc.</p>\r\n\r\n<p>Lower Ground Floor, Ground Floor and First Floor will have retail shops facing the central atrium, Second and Third Floor will comprise of Multiplex and gourmet FnB options.</p>\r\n', '', '', '', 'Elan Nirvana Country, Gurgaon | Elan Sector 50 Gurgaon', 'Elan Nirvana, Sector 50 in Gurgaon is one of the most demanding commercial project in Gurgaon. Commercial Retail Shops in Elan Sector 50 Gurgaon.', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(32, 0, 'Luxury Sea View Apartments in Goa @ Anantam', 'luxury-sea-view-apartments-in-goa-anantam-dona-paula-goa', NULL, 15, 1, 5, 1, NULL, 1, 1, 4.50, 71, 'Holiday Home', 'Dona Paula', '', '', 90, 90, 20000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1722, 'low', NULL, 'newly_launched', 0, '', '<p>Anantam blends your soul with nature, infusing life into its very meaning - infinite, boundless, endless. Designed across a rich expanse area, it has apartments spanning across the ocean with a minimum 180 degree sea view from each apartment. These homes are built as per international standards with the key pillars of quality, service and facility.</p>\r\n\r\n<h3><strong>Key Project Highlights :</strong></h3>\r\n\r\n<p><strong>Location:</strong> One of the last pieces of land with a Sea-View at Dona Paula (&quot;The Address of Goa&quot;) - a piece of land with all the possible amenities. Proximity to major attractions of the city and 5 minutes drive to the capital.</p>\r\n\r\n<p><strong>Key landmarks with 3 km radius:</strong> Manipal Hospital, Dona Paula Jetty, International Centre, Cidade De Goa Hotel, Goa University Proposed IT Park, Proposed International Film Festival of India (IFFI) Village.</p>\r\n\r\n<p><strong>View:</strong> 180 degree unobstructed sea-view from each apartment. Well-designed architecture using the natural contours of the land to maximize the angles for a perfect sea view from each home.</p>\r\n\r\n<p><strong>Architecture:</strong> Contemporary designs by internationally acclaimed architect Mr. Sanjay Puri - Mr. Sanjay Puri has won more than 38 International awards and 35 Indian Awards for his Architecture.</p>\r\n\r\n<p>&nbsp;</p>\r\n', '', 'Anantam Goa is a ready to move project in Dona Paula, North Goa. Check floor plan here.', '', 'Anantam Goa | Luxury Sea View Apartments in Goa', 'Anantam Goa - Luxury Sea View 2,3BHK Apartments for sale in Dona Paula, Goa with world class amenities. Price starting at Rs. 2 cr. Check photos, floor plan etc.', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(33, 0, 'Portuguese Independent Cottage House', 'portuguese-independent-cottage-house-south-goa-goa', NULL, NULL, 1, 5, NULL, NULL, 1, 1, 4.80, 62, 'Holiday Home', 'South Goa', NULL, NULL, 90, 90, 65000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4000, 'low', NULL, 'newly_launched', 0, NULL, NULL, NULL, NULL, NULL, '3BHK Portuguese Cottage House for Sale in South Goa', '3BHK Portuguese Cottage House for Sale in South Goa with 2268 sqm land area with beautiful veranda. Checkout photos, pricing, and reviews.', '0', '0', '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2025-09-30 13:52:12', '2025-10-04 12:22:37'),
(34, 0, 'Suncity Platinum Towers', 'suncity-platinum-towers-mg-road-gurgaon', NULL, 15, 1, 1, 1, NULL, 1, 1, 4.90, 56, '', 'MG Road', 'Opposite Westin Hotel, IFFCO Chowk, Sector–28', '', 90, 90, 52000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2685, 'high', NULL, 'newly_launched', 0, '', '<p>Precious as Platinum, the location is just priceless of Platinum Towers Gurgaon. Located in the heart of Gurugram, at MG Road, next to IFFCO CHOWK Metro Station, the property is in vicinity to all the coveted shopping malls, luxury hotels, commercial hub and prime areas like Golf Course and Cyber City.</p>\r\n', '', '', '', 'Suncity Platinum Towers Gurgaon, MG Road | Check Price List', 'Buy 3, 4 BHK luxury apartments in Suncity Platinum Towers MG Road, Gurgaon. Check location, updated price and read reviews. Buy residential property in Sector 28 Gurgaon.', '15', '5', '10', '5', '5', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(35, 0, 'Emaar Marbella Villas', 'emaar-marbella-villas-sector-66-gurgaon', NULL, 15, 1, 1, 3, NULL, 1, 1, 4.70, 56, '', 'Sector 66', '', '', 90, 90, 52000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 5605, 'low', NULL, 'newly_launched', 0, '', '<p>Welcome to a lifestyle designed to satiate all your senses. A space exquisitely shaped to transform every moment into a treasure. In a setting that is far from the crowd, yet close to all you desire. Step in, and the lavishly appointed interiors transport you into a higher realm of luxury. Walk out, and the skillfully landscaped greens fill you with a sense of rapture. Every exquisite little detail gives you a glimpse of the passion and craft that has shaped it. This is Marbella. Opulence redefined. Fully air conditioned with 100% power back up, concierge, best in class facility management services, premium finishes with dedicated elevator and best in class clubhouse truly defines your way of living.</p>\r\n\r\n<p><strong>Highlights</strong></p>\r\n\r\n<ul>\r\n	<li>Exterior and elevation maintenance, ensuring villa enclaves retain look and feel for years</li>\r\n	<li>Subscribed services for lawn and horticulture maintenance</li>\r\n	<li>Fully air-conditioned with 100% backup</li>\r\n	<li>Concierge and facility management services</li>\r\n	<li>Premium finishes (Specifications) with dedicated elevator</li>\r\n	<li>Affluent neighborhood with a best in DHAULA class clubhouse</li>\r\n</ul>\r\n', '', '', '', 'Emaar Marbella Villas Sector 66, Gurgaon | Check Price List', 'Buy 4,5 BHK luxury villas in Emaar Marbella Villas Sector 66, Gurgaon. Check location, updated price and read reviews. Buy residential property in Sector 66 Gurgaon.', '20', '15', '10', '10', '10', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(36, 0, 'Beautifully Renovated Portuguese 5 Bedroom Villa', 'beautifully-renovated-portuguese-5-bedroom-villa-anjuna-goa', NULL, 15, 1, 5, 3, NULL, 1, 1, 4.80, 73, 'Holiday Home', 'Anjuna', '', '', 90, 90, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4500, 'low', NULL, 'newly_launched', 0, '', '<p>This is a modern 5 bedroom villa with a children&rsquo;s room in the attic being the 6th room for kids and It has a vast backyard area with stunning waterfalls, two fishponds, a swimming pool, veranda, balconies, and a gazebo. You can relax your body in your personal steam and sauna room and also the Villa has a large kitchen and an expert chef to cater you with delectable food.&nbsp;You can also indulge in amazing food by visiting the nearby restaurants or cafes like Thalassa Restaurant, Gun Powder, Mums Kitchen, Assagao, Curlies, Antares, Ciao Bella, and Baba AU Rhum.</p>\r\n\r\n<p>This is a luxury five bedroom villa plus an attic room for children, where each room is facilitated with rich wooden furniture and modern-day amenities. Every room has tall ceilings and large windows that let in the bright morning sunlight and fresh Goan air. This Villa is not just sumptuous but also spacious and pleasant for relaxing. It also comes with a steam and a sauna room to detox yourself after partying. It also has a sound proof party room with mounted speakers and a player mixer installed inside.&nbsp;</p>\r\n\r\n<p><strong>Specification</strong></p>\r\n\r\n<ul>\r\n	<li>Total Area - 775 sq metres.</li>\r\n	<li>Built Up Area - 420 sq metres (4500 sq ft.)</li>\r\n	<li>Swimming Pool: 40 X 13 sq. ft.</li>\r\n	<li>4BHK with attached bathrooms + 2 outdoor shower</li>\r\n	<li>Indoor living room &amp; reception&nbsp;</li>\r\n	<li>Outdoor living room&nbsp;</li>\r\n	<li>Dining room &amp; bar&nbsp;</li>\r\n	<li>Kitchen &amp; service veranda<br />\r\n	&nbsp;</li>\r\n</ul>\r\n', '', '', '', 'Beautifully Renovated Portuguese 5 Bedroom Villa + 1 Children’s Attic ', 'This Portuguese 5 Bedroom Villa in Goa has a stunning huge lounge area with a moon roof for the cozy get-togethers with your loved ones.', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(37, 0, 'Smart World Orchard', 'smart-world-floors-sector-61-gurgaon', NULL, 1, 1, 1, 1, NULL, 1, 1, 4.70, 55, '', 'Sector 61', 'Golf Course Extension Road', '74 OF 2021', 90, 90, 12000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1150, 'low', NULL, 'newly_launched', 0, 'This set of the low-rise residential project is nestled amid the Aravallis. Thus, expect to wake up with the views of the mountains while breathing fresh air. There are ample open green parks and lawns inside the complex to enable residents to soak in the morning sun during their walks.', '<p>Smart World Developers offers 2.5 &amp; 3 BHK Luxury Lifestyle low rise floors with private terrace &amp; personal office space. <strong>Smart World Sector 61&nbsp;Gurgaon</strong> brings together all the latest technologies in this residential project to give its residents the ultimate luxurious living.</p>\r\n\r\n<p>The residential project has been specially designed to make its layout and amenities customer-centric. So, although many residential projects boast the most modern amenities, seldom do they deliver.</p>\r\n\r\n<p>So, while <strong>Smart World Orchard Gurgaon</strong> takes care of the utilities of its residents, its beautiful architectural design will take your breath away. Thus, at Smart World, you can indulge in hi-tech living with state-of-the-art amenities and upgraded services.</p>\r\n\r\n<ul>\r\n</ul>\r\n\r\n<div class=\"col-md-12\">\r\n<div class=\"row\">\r\n<h4><strong>Offer</strong></h4>\r\n</div>\r\n\r\n<ul>\r\n	<li>On spot offer upto Rs. 30000/- on instant booking.</li>\r\n	<li>Get Rs. 30000/- rent per month till possession on 2.5 BHK (1150 sqft.).</li>\r\n	<li>Get Rs. 50000/- rent per month till possession on 3 BHK (1542 sqft. &amp; 1630sqft).</li>\r\n</ul>\r\n</div>\r\n\r\n<div class=\"col-md-12\">\r\n<div class=\"row\">\r\n<h4><strong>Payment Plans</strong></h4>\r\n</div>\r\n\r\n<p>Book your dream home by paying only 2 Lacs:</p>\r\n</div>\r\n\r\n<div class=\"col-md-12\">\r\n<div class=\"row\">\r\n<p><strong>Payment Plan #1&nbsp;- 30:30:40</strong></p>\r\n</div>\r\n\r\n<p>&nbsp;- 30% within a month of booking.</p>\r\n\r\n<p>&nbsp;- 30% on completion of super structure</p>\r\n\r\n<p>&nbsp;- 40% on possession.</p>\r\n</div>\r\n\r\n<div class=\"col-md-12\">\r\n<div class=\"row\">\r\n<p><strong>Payment Plan #2&nbsp;- 15:85 subvention till possession</strong></p>\r\n</div>\r\n\r\n<p>&nbsp;- 15% within a month from booking.</p>\r\n\r\n<p>&nbsp;- 75% loan with no emi and interest till possession</p>\r\n\r\n<p>&nbsp;- 10% on Possession.</p>\r\n</div>\r\n', '', '', 'Pay only 15% & nothing till possession Or 30:30:40 payment plan.', 'Smart World Sector 61 Gurgaon | SmartWorld Orchard Gurgaon', 'Smart World Gurgaon - A newly lunched Luxury 2.5 & 3 BHK SmartWorld Orchard low rise floors is situated in Sector 61. Book today & get upto 30K Amazon gift voucher.', '30', '10', '10', '10', '5', '<p>So, surprise your family by investing in one of a kind project and gift them an enhanced lifestyle.</p>\r\n\r\n<ul>\r\n	<li>The residential area is strategically situated in New Gurgaon, close to hospitals, shopping complexes, multiples, ATMs, banks, clubs, etc.&nbsp;</li>\r\n	<li>Smart World Orchard promises high-utility homes by providing <strong><em>a private terrace and a personal office space</em></strong>.</li>\r\n	<li>Observe the sunrise and sunset at the Observatory Desk against the city skyline.</li>\r\n	<li>Chill out with your friends and family at the floating sauna and the scenic pool.</li>\r\n	<li>The whole complex is designed in a way so that each corner is well-aerated and well-lit.</li>\r\n	<li><strong><em>Smart World Orchard Gurgaon</em></strong> has private office space, an exclusive clubhouse area, a reading lounge, a kids&#39; plunge pool and play area, a cafeteria, etc.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_smart-world-floors-sector-61-gurgaon_1759292245.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT.)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>2.5 BHK + Private Office + Terrace</td>\r\n			<td>1150</td>\r\n			<td>₹1.2 Cr.*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK + Private Office + Terrace (Type - A)</td>\r\n			<td>1542</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK + Private Office + Terrace (Type - B)</td>\r\n			<td>1630</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04');
INSERT INTO `properties` (`id`, `is_featured`, `name`, `slug`, `alias_name`, `partner_id`, `agent_id`, `location_id`, `property_type_id`, `bedroom_option_id`, `property_category_id`, `property_condition_id`, `rating`, `review_count`, `badge`, `locality`, `address`, `rera_reg_no`, `sort_order`, `home_sort`, `price`, `monthly_rent`, `security_deposit`, `one_time_fees`, `total_payable`, `rent_includes`, `rent_excludes`, `rental_process`, `dos_donts`, `lock_in_period_days`, `notice_period_days`, `terms_conditions`, `is_rental`, `area_sq_ft`, `rise`, `possession`, `property_status`, `is_sold`, `amenities_description`, `property_description`, `gallery_description`, `floor_plan_description`, `offer_text`, `meta_title`, `meta_description`, `airport`, `entertainment`, `national_highway`, `hospitals`, `education`, `project_highlights_title`, `highlight_images`, `location_features`, `price_list`, `map_code`, `map_text`, `is_active`, `created_at`, `updated_at`) VALUES
(38, 0, 'DLF Alameda Floors', 'dlf-alameda-floors-sector-73-gurgaon', NULL, 4, 1, 1, 1, NULL, 1, 1, 4.60, 67, '', 'Sector 73', '', 'HRERA- 59 of 2021', 90, 90, 40000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3750, 'low', NULL, 'newly_launched', 0, 'DLF Alameda Floors Sector 73 Gurgaon comes with best-in-class of modern amenities where it promotes active and robust lifestyle for every house owner.', '<p>Enjoy the benefits of urban living with the added privilege of independence and privacy at DLF Alameda Floors, Sector-73, Gurugaon. Alameda Independent Floors is a new residential limited inventory launch in Gurgaon by the famous realty developer DLF Ltd. DLF Alameda Floors is a low dense residential development that generally brings higher return over investment and from that point of view it can easily attract many benefits.</p>\r\n', '', '', 'Special Inaugural Rebate offer for Early Birds.', 'DLF Alameda Floors Gurgaon, 4BHK Independent Floors | PropNKey', 'DLF Alameda Floors Sector 73 Gurgaon - Alameda Independent Floors is a new residential launch in Gurugram by the famous realty developer DLF. Check price. Pre-booking open now.', '35', '10', '15', '10', '10', '<ul>\r\n	<li>4BHK low rise Luxurious independent floors (Stilt + 4).</li>\r\n	<li>Limited Inventory of 116 Luxurious Floors for the selected few</li>\r\n	<li>Spacious floor size ranges from 3750 Sq ft to 4700 Sq ft.</li>\r\n	<li>Dedicated car parking at stilt level for each floor.</li>\r\n	<li>Separate staff room and store room in the basement for each floor.</li>\r\n	<li>Air Conditioning in Beedrooms, Living and Dining areas.</li>\r\n	<li>Fully loaded Kitchen with appliances (Modular kitchen with hob, Chimney, Oven, Microwave, Dishwasher, Refrigerator, Washing Machine (at balcony) - all from reputed brands.</li>\r\n	<li>Elevator (With a capacity of 6 persons).</li>\r\n	<li>Power backup with DG set up to 9 KVA.</li>\r\n	<li>CCTV in driveway of Parking and Ground floor entrance lobby.</li>\r\n	<li>Good Hospitals, Malls, Schools and Office spaces within 2 km radius.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_dlf-alameda-floors-sector-73-gurgaon_1759292245.jpg\"', NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(39, 0, 'Ambience Caitriona', 'ambience-caitriona-sector-24-gurgaon', NULL, 15, 1, 1, 1, NULL, 1, 1, 4.80, 82, '', 'Sector 24', 'NH 8 Next to Ambience Mall', '', 90, 90, 105000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 7000, 'low', NULL, 'newly_launched', 0, '', '', '', '', '', 'Ambience Caitriona in Sector 24, Gurgaon | Ultra Luxury Condominiums', 'Ambience Caitriona Gurgaon - Luxuries of Seven Star Living. Ready to move-in 4BHK & 5BHK Apartments and Condominiums. Check price and floor plan.', '20', '2', '2', '5', '5', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(40, 0, 'M3M St. Andrews', 'm3m-st-andrews-sector-65-gurgaon', NULL, 1, 1, 1, 1, NULL, 1, 1, 4.80, 65, '', 'Sector 65', 'SPR, Golf Course Extension Road', 'Not Applicable', 90, 90, 94500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 6365, 'high', NULL, 'newly_launched', 0, '', '', '', '', '', 'M3M St. Andrews Golf Luxury Residences in Sector 65, Gurgaon', 'M3M St. Andrews 4/5 BHK Luxury Residences in Sector 65, Gurgaon is inspired by contemporary modern architecture and crafted to create tranquility. Visit today.', '30', '10', '10', '5', '5', '<ul>\r\n	<li>Lavish balconies with 6&rsquo; to 11&rsquo;width, which would serve as your extended living spaces &ndash; your own private Golf Living Experience.</li>\r\n	<li>Clear Ceiling Height of 10&rsquo; with every apartment configuration.</li>\r\n	<li>Fully loaded top of line, ultra luxury specifications in kitchen and washrooms in all units.</li>\r\n	<li>Rooftop Swimming Pools on Tower 9 &amp; 17 in Golf Estate Fairway West</li>\r\n	<li>Designer 9-hole Executive Golf Course and multiple sport areas spread across the project.</li>\r\n	<li>Iconic Club spread over 1.2 lakh sq.ft, Designed by Upton Hansen Associates- London. The club will have amenities comparable to a 7- Star Resort including International Spa, Private Art Gallery, Unisex Gym and Salon, multi-cuisine restaurants and multiple recreational areas.</li>\r\n	<li>Sweeping Views of the expansive Golf Themed Landscaping from the Master Suites, Living room, main balcony in all units</li>\r\n	<li>Part of one of the Largest Luxury Golf themed Group housing developments &ldquo;Golf Estate&rdquo; spread over 75 acres.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_m3m-st-andrews-sector-65-gurgaon_1759292246.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>4 BHK + Den + Puja</td>\r\n			<td>6365 sq.ft.</td>\r\n			<td>14450 (Per sq.ft)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>5 BHK + Den + Puja</td>\r\n			<td>6371 sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<div class=\"row pt-3\">\r\n<h3 class=\"main-heading\">Payment Plans</h3>\r\n\r\n<p class=\"heading-p\">There are a multitude of payment plans available to cater to varying requirements of the customers, these include the Down-Payment Plan, Subvention Plan and Construction Linked Payment Plan. Home Finance options are available from all the major lenders including Nationalized as well as PSU Banks. For further information on the payment plans, please feel free to contact us.</p>\r\n</div>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(41, 0, 'M3M Skycity', 'm3m-skycity-sector-65-gurgaon', NULL, 1, 1, 1, 1, NULL, 1, 1, 4.60, 40, '', 'Sector 65', 'Golf Course Extension Road', '01 of 2017', 90, 90, 16000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1261, 'high', NULL, 'newly_launched', 0, '', '', '', '', '', 'M3M Sky City - Luxury Apartment in Sector 65 Gurgaon | PropNKey', 'Skycity Sector 65 Gurgaon - M3M Skycity is a new luxurious residential project with modern amenities in Golf Course Extn. Road, Gurugram. Book today and get 18% assured return till possession.', '30', '5', '10', '5', '5', '<ul>\r\n	<li>The one minute lifestyle destination that offers an exhilarating version of urbane living</li>\r\n	<li>Unique blend of Modern Retail &amp; Uber Residence</li>\r\n	<li>Companies like NTT Data, Pepsico, Mckinsey in the close vicinity</li>\r\n	<li>Just 30 Min drive away from IGI Airport</li>\r\n	<li>Number of Schools, Hospitals, markets, and a proposed metro corridor (Metro Connectivity) in close vicinity.</li>\r\n	<li>Excusive Air-Conditioned Double-Height Entrance Lobbies at Ground Level</li>\r\n	<li>Exclusive Clubhouse to Sooth your Soul</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_m3m-skycity-sector-65-gurgaon_1759292246.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>2 BHK</td>\r\n			<td>1261 - 1433</td>\r\n			<td>₹1.60 Cr</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK + 3T</td>\r\n			<td>1828</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK + 3T + SQ</td>\r\n			<td>2040 - 2054</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<div class=\"row pt-3\">\r\n<h3 class=\"main-heading\">Payment Plans</h3>\r\n\r\n<p class=\"heading-p\">There are a multitude of payment plans available to cater to varying requirements of the customers, these include the Down-Payment Plan, Subvention Plan and Construction Linked Payment Plan. Home Finance options are available from all the major lenders including Nationalized as well as PSU Banks. For further information on the payment plans, please feel free to contact us.</p>\r\n\r\n<p class=\"heading-p\"><strong>Payment Plan : 50:50</strong></p>\r\n\r\n<ul>\r\n	<li><strong>50%:</strong> 2-4 months</li>\r\n	<li><strong>50%:</strong> 40% application of OC and 10% on possession</li>\r\n	<li><em>*18* Assured Return till possession</em></li>\r\n</ul>\r\n\r\n<p><strong>Subvention Plan:&nbsp;10:75:15</strong></p>\r\n\r\n<ul>\r\n	<li>10% on booking</li>\r\n	<li>75% Bank Loan</li>\r\n	<li>15% on Possession</li>\r\n	<li>*9*% Assured Return till possession</li>\r\n</ul>\r\n\r\n<p><strong><em>Offer: 18% assured return till possession.</em></strong></p>\r\n</div>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(42, 0, 'M3M Heights', 'm3m-heights-sector-65-gurgaon', NULL, 1, 1, 1, 1, NULL, 1, 1, 4.70, 68, '', 'Sector 65', 'Golf Course Extension Road', '01 of 2017', 90, 90, 16000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1261, 'high', NULL, 'newly_launched', 0, 'The M3M Heights project is designed to provide a lifestyle away from hustle-bustle but still close to the basic amenities. Residents can find everything in the immediate vicinity.', '<p>M3M Heights is a top-notch residential project in Sector 65, Gurgaon featuring the best-in-class facilities and amenities. This real estate property provides apartments ranging from 2,3 BHK, which are very spacious. The entire project has been well thought out and designed, keeping in mind a proper blend of comfort and luxury. This residential place offers uber facilities, the icing on the cake.<br />\r\n&nbsp;<br />\r\nSome of the primary facilities and features of the project include an exclusive clubhouse, location advantages, air-conditioned high entrance lobbies, smart locks, gaming lounge, sports arena, gym center, etc.</p>\r\n', '', 'At M3M Heights, one can find 2 and 3 BHK apartments. There are two types of 2 BHK apartments, 2 and 2.5. There are 2 types of 3 BHK apartments, 3 and SQ + 3 BHK. ', '', 'M3M Heights Gurgaon - Luxury Apartments in Sector 65 | PropNKey', 'M3M Heights Gurgaon - M3M Heights is a new luxurious residential project with modern amenities in Golf Course Extn. Road, Sector 65, Gurgaon. Book today and 18% assured return till possession.', '30', '5', '10', '5', '5', '<ul>\r\n	<li>The one-minute lifestyle destination that offers an exhilarating version of urbane living.</li>\r\n	<li>The biggest highlight of the M3M Heights project is its excellent connectivity. All the basic places such as hospitals, colleges, corporate houses, and malls are nearby.</li>\r\n	<li>The companies such as NTT Data, PepsiCo, McKinsey, etc., are just a few kms away. Moreover, the IGI airport is a drive of 30 minutes.</li>\r\n	<li>It consists of an exclusive clubhouse to Sooth your Soul.</li>\r\n	<li>The project includes a jogging track, rooftop garden, power backup, parking area, etc.</li>\r\n	<li>The clubhouse is a one-stop destination for multiple indoor activities.</li>\r\n	<li>Number of Schools, Hospitals, markets, and a proposed metro corridor (Metro Connectivity) in close vicinity.</li>\r\n	<li>Excusive Air-Conditioned Double-Height Entrance Lobbies at Ground Level.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_m3m-heights-sector-65-gurgaon_1759292248.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>2 BHK</td>\r\n			<td>1261 - 1433</td>\r\n			<td>₹1.60 Cr*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK + 3T</td>\r\n			<td>1828</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK + 3T + SQ</td>\r\n			<td>2040 - 2054</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<div class=\"row pt-3\">\r\n<h3 class=\"main-heading\">Payment Plans</h3>\r\n\r\n<p class=\"heading-p\">There are a multitude of payment plans available to cater to varying requirements of the customers, these include the Down-Payment Plan, Subvention Plan and Construction Linked Payment Plan. Home Finance options are available from all the major lenders including Nationalized as well as PSU Banks. For further information on the payment plans, please feel free to contact us.</p>\r\n\r\n<p class=\"heading-p\"><strong>Payment Plan : 50:50</strong></p>\r\n\r\n<ul>\r\n	<li><strong>50%:</strong> 2-4 months</li>\r\n	<li><strong>50%:</strong> 40% application of OC and 10% on possession</li>\r\n	<li><em>*18* Assured Return till possession</em></li>\r\n</ul>\r\n\r\n<p><strong>Subvention Plan:&nbsp;10:75:15</strong></p>\r\n\r\n<ul>\r\n	<li>10% on booking</li>\r\n	<li>75% Bank Loan</li>\r\n	<li>15% on Possession</li>\r\n	<li>*9*% Assured Return till possession</li>\r\n</ul>\r\n\r\n<p><strong><em>Offer: 18% assured return till possession.</em></strong></p>\r\n</div>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(43, 0, 'AIPL Autograph', 'aipl-autograph-sector-66-gurgaon', NULL, 2, 1, 1, 5, NULL, 1, 1, 4.60, 77, '', 'Sector 66', 'Badshahpur', 'HARERA/GGM/481/213/2021/49', 90, 90, 6500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 500, 'high', NULL, 'newly_launched', 0, '', '<p>AIPL Autograph, located in Sector 66, is a leading commercial space that has been newly launched and offers excellent facilities to the commercial owners.</p>\r\n\r\n<p>Located in Sector 66, Gurgaon, AIPL Autograph is an ideal development for <a href=\"https://www.propnkey.com/commercial/retail-shops/\">Commercial and Retail shops</a>. Construction is now underway, so the units will be ready soon enough. An array of high-end amenities can be found at AIPL Autograph, a cutting-edge business center in Gurgaon. Gurgaon&#39;s AIPL Autograph Sector 66 has a spectacular appearance. The lobby and lounge of AIPL Autograph are both three stories high. Despite its size, it creates an indelible impression on visitors. Since all the shops are so well-lit, every business has an equal chance of being noticed. Tower 2 has an elite club with a lap pool and a state-of-the-art gym. In addition, a clubhouse is offered for corporate events.&nbsp;</p>\r\n\r\n<p>The business center and the corporate floor are located in the complex. It also meets the needs of the corporate sector. Another option is a building management system. The project&#39;s entrance and departure points are guarded to ensure only authorized individuals get access. Since CCTV cameras are watching all activity at AIPL Autograph, it is possible to record it without fear of being observed. High-speed lifts are available for commercial use, ensuring smooth and orderly movement.</p>\r\n', '', 'The entrance lobby and lounge have a combined floor area of 20,000 square feet, with triple-height ceilings. One million square feet is the total super area of the project. From 4400 to 11000 square feet, you can find the project\'s floor plates. At the AIPL Autograph Gurgaon, one can find three types of properties – 500 sq. ft., 1700 sq. ft. onwards & 600 sq. ft. onwards.', 'Assured return @10% till possession.', 'AIPL Autograph Gurgaon | Commercial & Retail Space in Sector 66', 'AIPL Autograph Gurugram is an ultra-modern lockable corporate office center with present-day amenities you may need. The total project size is approx 6.5 acre.', '30', '10', '5', '5', '5', '<p>AIPL Autograph serves as the ideal destination for your business and makes sure that you get top-notch amenities for your office.</p>\r\n\r\n<ul>\r\n	<li>Approx 1 million sq. ft. of office development spread over 3 towers.</li>\r\n	<li>Located in <strong>Golf Course Extension Road, Sector 66</strong>, Gurugram.</li>\r\n	<li><strong>Triple height entrance lobby</strong> and a lounge that spread over an area of approx. 20,000 sq. ft.</li>\r\n	<li>State-of-the-art <strong>business centre / co-working floor</strong>.</li>\r\n	<li>Large <strong>Open-To-Sky Piazza</strong> connecting 3 Towers.</li>\r\n	<li>There are 3 levels of underground parking and plenty of open-air parking spaces.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_aipl-autograph-sector-66-gurgaon_1759292249.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>Office space</td>\r\n			<td>500 sq.ft. Onwards</td>\r\n			<td>₹65 Lacs* onwards</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Lockable Office Spaces</td>\r\n			<td>1700 sq.ft. Onwards</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Food Courts</td>\r\n			<td>600 sq.ft. Onwards</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-10-04 12:13:41'),
(44, 0, 'DLF Garden City Floors', 'dlf-garden-city-floors-sector-92-gurgaon', NULL, 4, 1, 1, 1, NULL, 1, 1, 4.70, 42, '', 'Sector 92', '', '90 of 2021', 90, 90, 16000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 618, 'low', NULL, 'newly_launched', 0, 'At Garden City Floors, you\'ll be able to live in luxury every day of your life. The clubhouse, other communal areas, and the entrance lobby are only enhanced by employing only the highest quality finishes. This is a place where every step and every moment is treasured.', '<p style=\"margin-bottom:13px\"><span style=\"font-size:11pt\"><span style=\"line-height:115%\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"color:#0e101a\">DLF Garden City Floors</span>, located in <span style=\"color:#0e101a\">Sector 92, Gurgaon</span>, is a residential project set to offer the best facilities to the residents. <span style=\"color:#0e101a\">It&#39;s one of the best residential project in Gurgaon and one of the most sought-after residences. In the meantime, the units in this project are being constructed. Low-rise floors, and other unit kinds are available at the site, all of which are built to meet the needs of the residents. This meticulously thought-out undertaking has now been given the green light to start. At DLF Garden City Floors, you may take advantage of all the modern conveniences at your fingertips to live a comfortable existence.</span></span></span></span></p>\r\n', '', 'In Sector 92, Gurgaon, DLF Garden City Floors is a well-thought-out project. DLF Garden City Floors offers well-built residences.  View the unit floor plans to get a sense of how the house is laid out and how the various rooms and areas relate to one another. There are ten different floor layouts to choose from in DLF Garden City Floors. There are 618 sq. ft. super area options for the 4 BHK Low-rise floors. ', 'Pay 25% Now - 75% near Possession.', 'Luxury DLF Garden City Floors Sector-92 Gurgaon - PropNKey', 'Buy Luxurious residential floors in Gurgaon Sec 92 with Ultra-Modern amenities. Low-Rise floors by DLF in Sector 92, 5km from DLF Cyber City. Book today with 25:75 payment plan.', '0', '0', '0', '0', '0', '<ul>\r\n	<li>Spectacularly Modern and Luxurious Low-rise floors in Sector 91,92 Gurgaon.</li>\r\n	<li>Located near a thousand acres of lush green open space surrounded by trees.</li>\r\n	<li>As well as the modern facilities of a world-class educational institution.</li>\r\n	<li>The project&#39;s floors include a great blend of contemporary architecture and features for a comfortable lifestyle.</li>\r\n	<li>Exclusively for those who value privacy and exclusivity in their lifestyles.</li>\r\n	<li>Gurugram&#39;s DLF Garden City has low-rise four-bedroom apartments.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_dlf-garden-city-floors-sector-92-gurgaon_1759292250.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th>Block Name</th>\r\n			<th>Area (in SQYD)</th>\r\n			<th>Builtup Area (in SQFT)</th>\r\n			<th>Accomodation</th>\r\n			<th>Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>G7C</td>\r\n			<td>263 - 287</td>\r\n			<td>2094 - 2286</td>\r\n			<td>4 BHK+SQ+ST</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>G17</td>\r\n			<td>393</td>\r\n			<td>3024</td>\r\n			<td>4 BHK+SQ+ST</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>E3</td>\r\n			<td>445</td>\r\n			<td>3202</td>\r\n			<td>4 BHK+SQ+ST</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>NCA</td>\r\n			<td>411</td>\r\n			<td>2993</td>\r\n			<td>4 BHK+SQ+ST</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>A5</td>\r\n			<td>464 - 502</td>\r\n			<td>3446 - 3471</td>\r\n			<td>4 BHK+SQ+ST</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>A8</td>\r\n			<td>502</td>\r\n			<td>3471</td>\r\n			<td>4 BHK+SQ+ST</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>A9</td>\r\n			<td>431 - 527</td>\r\n			<td>3116 - 3478</td>\r\n			<td>4 BHK+SQ+ST</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>A10</td>\r\n			<td>269 - 287</td>\r\n			<td>2134 - 2303</td>\r\n			<td>4 BHK+SQ+ST</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>A15</td>\r\n			<td>377 - 428</td>\r\n			<td>2610 - 3017</td>\r\n			<td>4 BHK+SQ+ST</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>A16</td>\r\n			<td>336</td>\r\n			<td>2364</td>\r\n			<td>4 BHK+SQ+ST</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Get price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(45, 0, 'Fully Furnished Ground Floor With Private Garden', 'fully-furnished-ground-floor-with-private-garden-assagao-goa', NULL, 15, 1, 5, 1, NULL, 1, 1, 4.90, 42, 'Holiday Home', 'Assagao', '', '', 90, 90, 12000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1088, 'low', NULL, 'newly_launched', 0, '', '', '', '', '', 'Fully Furnished Ground Floor for Sale in Assagao, Goa', 'Buy this Fully Furnished Ground Floor with Private Garden property in Goa\'s finest location, Assagao. ', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(46, 0, '5 BHK House with Swimming Pool', '5-bhk-house-with-swimming-pool-saligao-goa', NULL, 15, 1, 5, 8, NULL, 1, 1, 4.60, 43, 'Holiday Home', 'Saligao', 'Assagao, Anjuna Road', '', 90, 90, 60000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 9140, 'low', NULL, 'newly_launched', 0, '', '', '', '', '', '5 BHK House with Swimming Pool for Sale in Goa - PropNKey', '5 BHK House with Swimming Pool for at the most promising location of Saligao, Goa. Plot size 850 square metres and 341 sqaure metres built up area. Enquire now!', '0', '0', '0', '0', '0', '', NULL, NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Plot Size(in SQ.MT)</th>\r\n			<th scope=\"col\">Built-up Area (in SQ.MT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>5 BHK House</td>\r\n			<td>850</td>\r\n			<td>341</td>\r\n			<td>₹6 Crore (Negotiable)</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(47, 0, '4BHK Villa With Pool Facing Mandovi River', '4bhk-villa-with-pool-facing-mandovi-river-reis-magos-goa', NULL, 15, 1, 5, 3, NULL, 1, 1, 4.90, 48, 'Holiday Home', 'Reis Magos', 'Verem', '', 90, 90, 40000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3767, 'low', NULL, 'newly_launched', 0, '', '', '', '', '', 'Luxury 4BHK Villa With Panoramic Mandovi River View for Sale', 'Luxury 4BHK Villa for Sale - Imagine living in a luxury dream home with an exclusive amenities like pool and panoramic Mandovi river view. Book now!', '0', '0', '0', '0', '0', '', NULL, NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Plot Area (in SQM)</th>\r\n			<th scope=\"col\">Built Area (in SQM)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>4 BHK Villa + SQ + 1 Living Room</td>\r\n			<td>350 SQM</td>\r\n			<td>250 SQM</td>\r\n			<td>Rs. 4 Crore</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(48, 0, 'Maintained Portuguese House', 'maintained-portuguese-house-anjuna-goa', NULL, 15, 1, 5, 8, NULL, 1, 1, 4.60, 72, 'Holiday Home', 'Anjuna', '', '', 90, 90, 60000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 6455, 'low', NULL, 'newly_launched', 0, '', '', '', '', '', 'Maintained Portuguese House For Sale in Goa | PropNKey', 'Maintained Portuguese House for Sale in Anjuna Beach Goa. 600 sqm plot area. Good for rental income. Enquire now.', '0', '0', '0', '0', '0', '', NULL, NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Plot Area (in SQM)</th>\r\n			<th scope=\"col\">Built Area (in SQM)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>4 BHK</td>\r\n			<td>600 sqm.</td>\r\n			<td>400 sqm.</td>\r\n			<td>Rs. 6 Crore</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(49, 0, 'Independent Private Pool Villa', 'independent-private-pool-villa-arpora-goa', NULL, 15, 1, 5, 3, NULL, 1, 1, 4.90, 76, 'Holiday Home', 'Arpora', 'Nagoa Junction', '', 90, 90, 24500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3225, 'low', NULL, 'newly_launched', 0, '', '', '', '', '', 'Independent Private Pool Villa for Sale in Goa', 'Independent Villa With Private Pool for Sale - It\'s luxurious independent private pool Villa located in Nagoa Junction, Arpora available for sale at price of Rs. 2.45 crore.', '0', '0', '0', '0', '0', '', NULL, NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Config.</th>\r\n			<th scope=\"col\">Plot Area (in SQM)</th>\r\n			<th scope=\"col\">Built Area (in SQM)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>3 BHK</td>\r\n			<td>300 SQM.</td>\r\n			<td>147 SQM.</td>\r\n			<td>Rs. 2.45 Crore</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(50, 0, 'Luxury Portuguese Villa With Pool', 'luxury-portuguese-villa-with-pool-candolim-goa', NULL, 15, 1, 5, 3, NULL, 1, 1, 4.80, 74, 'Holiday Home', 'Candolim', '', '', 90, 90, 80000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 7265, 'low', NULL, 'newly_launched', 0, '', '', '', '', '', 'Luxury Portuguese Villa With Pool for Sale in Goa', 'Luxury Portuguese Villa with Pool with all modern day amenities, comes with a pool, Italian kitchen and Powder room located near Candolim Goa.', '0', '0', '0', '0', '0', '', NULL, NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Config.</th>\r\n			<th scope=\"col\">Area (in SQM)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>3 Ensuite Bedroom</td>\r\n			<td>675 SQM</td>\r\n			<td>Rs. 8 Crore</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(51, 0, 'Imperial Residences by DLF', 'imperial-residences-by-dlf-dlf-city-phase-1-2-3-gurgaon', NULL, 4, 1, 1, 1, NULL, 1, 1, 4.60, 50, '', 'DLF City Phase 1, 2 & 3', '', '', 90, 90, 35000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 'low', NULL, 'newly_launched', 0, '', '', '', '', '25:25:50 Payment Plan. Initial Booking Amount Rs. 10 Lacs', '', '', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(52, 0, 'Bennet and Bernard Luxury Home', 'bennet-and-bernard-luxury-home-moira-north-goa-goa', NULL, 15, 1, 5, 3, NULL, 1, 1, 4.80, 40, 'Holiday Home', 'Moira North Goa', '', '', 90, 90, 27000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 'low', NULL, 'newly_launched', 0, '', '<p>The villa have its own private pool and a stunning private landscaped garden artfully laid out with tropical palms, lawns and local plan.</p>\r\n', '', '', '', 'Bennet and Bernard - Luxury Home in Goa', 'Luxury Villa Home by Bennet and Bernard - A residential luxury home with unique and exclusive modern day amenities in Goa.', '0', '0', '0', '0', '0', '<ul>\r\n	<li>Spanish Colonial Style</li>\r\n	<li>French wooden doors with access to Pool &amp; Garden</li>\r\n	<li>Hand Painted exclusive Portuguese insert tiles.</li>\r\n	<li>High Grade Granite Stone Kitchen Counter</li>\r\n	<li>Private Car Parking</li>\r\n	<li>Rental Management</li>\r\n	<li>Attached terraces for each bedroom</li>\r\n	<li>Exhausts and Solar Water heating system</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_bennet-and-bernard-luxury-home-moira-north-goa-goa_1759292251.jpeg\"', NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(53, 0, '4BHK Independent Villa', '4bhk-independent-villa-salvador-do-mundo-goa', NULL, 15, 1, 5, 3, NULL, 1, 1, 4.70, 61, 'Holiday Home', 'Salvador Do Mundo', '', '', 90, 90, 50000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 8, 'low', NULL, 'newly_launched', 0, '', '', '', '', '', '4BHK Independent Villa in Salvador Do Mundo, Goa', '4 BHK Independent villa house for sale in Salvador do Mundo, Goa. 4 BHK with 6 bathrooms. 8880 sqft plot size. ', '0', '0', '0', '0', '0', '<ul>\r\n	<li>4 bedrooms</li>\r\n	<li>Independent studio room</li>\r\n	<li>Spacious living room and kitchen</li>\r\n	<li>Staff room</li>\r\n	<li>6 bathrooms</li>\r\n	<li>Large wrap around garden</li>\r\n	<li>Driveway and parking.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_4bhk-independent-villa-salvador-do-mundo-goa_1759292251.jpeg\"', NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(54, 0, 'Tulip Monsella', 'tulip-monsella-ultra-luxury-apartments-sector-53-gurgaon', NULL, 15, 1, 1, 1, NULL, 1, 1, 4.80, 44, '', 'Sector 53', 'Golf Course Road', '', 90, 90, 57400000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2874, 'high', NULL, 'newly_launched', 0, 'Tulip Monsella has been designed precisely to achieve a sophisticated, peaceful, and secure lifestyle. The amenities reflect elegance while ensuring that residents can find all the facilities within reach.', '<p>Tulip Monsella is a ultra luxury project launched by Tulip Group which is located in sector 53, Golf Course Road, Gurgaon. It offers 3/4/5 BHK high-end premium apartments with the world class amenities like Sky hub, Tower lobbies with access control, digital door lock at main gate, double height tower lobby, High speed elevators and other top-class facilities for peaceful and cheerful living.</p>\r\n\r\n<p>Tulip Monsella is a plush residential real estate project in Sector 53, Golf Course Road, Gurgaon. You can choose 3, 4, and 5 BHK apartments at this ultra luxury residential project. Each apartment has been designed aesthetically to render top-class comfort and sophistication in living. Moreover, the ultra-modern facilities of this residential complex look after the dwellers&#39; security, comfort, peace, and happiness.</p>\r\n\r\n<p>Some notable project facilities are high-speed elevators, double-height tower lobbies, access-controlled tower lobbies, digital door locks, and many more. In addition, Tulip Monsella Gurgaon includes a clubhouse with a cigar lounge, a swimming pool, a snooker lounge, a mini theatre, a gaming lounge, a banquet hall, a gym, and many more.</p>\r\n', '', '<p>At Tulip Monsella Gurgaon, you will find 3, 4, and 5 BHK apartments. There are two types of 3BHK apartments, divided into Units 1, 2, and 3. The floor plans of 3BHK apartments in Unit 2 are different from the floor plans of apartments in Units 1 and 3.</p>\r\n', 'Inaugural Offer : Save Up to 90 Lakhs.', 'Tulip Monsella Sector 53, Gurgaon - Ultra Luxury Apartments', 'Tulip Monsella is a ultra luxury project launched by Tulip Group which is located in sector 53, Golf Course Road, Gurgaon. Check Price, Floor plan, and more', '0', '0', '0', '0', '0', '<ul>\r\n	<li>3 /&nbsp;4 / 5 BHK High - end Luxury Apartments located on Golf Course Road, Sector 53, Gurgaon.</li>\r\n	<li>The Main USP of Project is Sky hub.</li>\r\n	<li>Tulip Monsella Sector 53 has excellent connectivity from different parts of Gurgaon. You can find schools, colleges, shopping malls, hospitals, and other facilities in the vicinity.</li>\r\n	<li>There are two clubhouses, one on the G+4 level and the other on the 41st floor. Dining Restaurant, Bars, Mini Theater, and Card Lounge are all available at the clubhouse.</li>\r\n	<li>It takes only five minutes to reach the Huda City Centre Metro Station from this residential project in Gurgaon.</li>\r\n	<li>Zero vehicle movement on the ground level, 5-tier security, and digital door lock facilities ensure secure and peaceful living.</li>\r\n	<li>The project includes a well-facilitated gym and a yoga deck. In addition, fitness enthusiasts will find separate jogging tracks, cycling tracks, etc.</li>\r\n	<li>The clubhouse is stocked with many amusements for the residents. Additionally, there are courts for basketball, badminton, etc. A separate playing ground is also available for kids.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_tulip-monsella-ultra-luxury-apartments-sector-53-gurgaon_1759292252.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in Sq.Ft)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>3 Bedroom Unit 2</td>\r\n			<td>2874 Sq.Ft.</td>\r\n			<td>5.74 Cr.*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK Unit 1, 3</td>\r\n			<td>2892 Sq.Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>4 BHK</td>\r\n			<td>3684 Sq.Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>5 BHK</td>\r\n			<td>4503 Sq. Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(55, 0, 'Puri Construction Sector 61', 'puri-sector-61-gurgaon', NULL, 1, 1, 1, 1, NULL, 1, 1, 4.90, 49, '', 'Sector 61', 'Golf Course Extension Road', '', 90, 90, 35000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2250, 'high', NULL, 'newly_launched', 0, 'The Puri Sector 61, Gurgaon project has been designed to provide all the basic amenities to the residents so they can enjoy everything in and around the vicinity.', '<p>Puri Sector 61 is one of the best luxury residential project on Golf Course Extension Road.&nbsp; It is laced with all the modern amenities and is located diagonally differing from Lemon Tree &amp; Red Fox Hotel in Gurgaon.&nbsp;The project is properly laced with multiple modern amenities. The entire project site is &ndash; 10 acres approx. consisting of very spacious 3 &amp; 4 BHK high-rise apartments which simultaneously provide utmost luxury and comfort.&nbsp;<br />\r\n&nbsp;<br />\r\n<span style=\"font-size:11.0pt\"><span style=\"line-height:115%\"><span calibri=\"\" style=\"font-family:\"><span style=\"color:#0e101a\">Puri sector 61, Gurgaon, is a leading luxurious residential project situated on the Golf Course Extension Road. </span></span></span></span>The majority of the features and facilities of the project include a huge sports area, a fully air-conditioned area, 24*7 power back-up, CCTV camera security, indoor games, a clubhouse, smart locks, etc.&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Project Site: 10 Acre approx</li>\r\n	<li>3 &amp; 4 BHK Luxury Apartments</li>\r\n	<li>High Rise Apartments</li>\r\n	<li>Location- Opposite Lemon Tree and Red Fox Hotel on Golf Course Extension Road</li>\r\n</ul>\r\n', '', 'At Puri Sector 61, Gurgaon, the area covers approximately 10 acres, with 3 & 4 BHK high-rise apartments. ', '', 'Puri Sector 61 Gurgaon - 3 & 4 BHK Luxury Apartments', 'Puri Sector 61 Gurgaon is a upcoming residential project that offers 3 & 4 BHK luxury apartments designed with modern amenities. Book now!', '0', '0', '0', '0', '0', '<ul>\r\n	<li>Location- Opposite Lemon Tree and Red Fox Hotel on Golf Course Extension Road.</li>\r\n	<li>The major feature of Puri Sector 61, Gurgaon project includes its utmost ease of connectivity to all areas such as malls, hospitals, colleges, grocery stores, etc.&nbsp;</li>\r\n	<li>The general location of the project is excellent as it is opposite the Lemon Tree hotel and the Red Fox Hotel on the prime face of Golf Course Extension Road.</li>\r\n	<li>The area is surrounded by a lush green space, allowing people to breathe fresh air.</li>\r\n	<li>A dedicated indoor and outdoor sporting activity zone provides ample activities.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_puri-sector-61-gurgaon_1759292252.jpg\"', NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(56, 0, 'Godrej Connaught One', 'godrej-connaught-one-central-delhi-delhi', NULL, 5, 1, 2, 1, NULL, 1, 1, 4.80, 75, '', 'Central Delhi', '14, Lady Hardinge Road, Connaught Place', 'DLRERA2022P0001', 90, 90, 160600000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2201, 'high', NULL, 'newly_launched', 0, 'Connaught Place is the epicenter of everything you love about Delhi, with its broad, winding streets, lovely golf course, leafy avenues, and majestic homes radiating a calm elegance. An impressive double-height lobby raced by, leaving a lasting impression.', '<p><strong>Godrej Connaught One</strong> is one of the newly launched luxurious projects in <strong>Connaught place, Delhi</strong>. These bespoke luxury residential flats are like a dream come true for people looking forward to living in the best location at affordable prices. Residents here can get all the amenities, as everything is close to the area.</p>\r\n\r\n<p>With a beautiful golf course, leafy avenues, elegance, and wide roads, Connaught place is situated at the heart of everything one loves in the national capital.&nbsp;</p>\r\n\r\n<p>With the very new Godrej Connaught One, modern, luxurious families can experience living in high-rising towers and get a spectacular, uninterrupted view of the starry city! The apartments are presented here with a huge modern look, and everything is properly planned and executed to let the luxury speak volumes for itself.&nbsp;</p>\r\n\r\n<p>The residential <em><strong>Godrej Connaught One project caters to luxury apartments for 46 elite-class families</strong></em>. The total project size is 1 acre, and a single high-rise tower is built on it.&nbsp;</p>\r\n\r\n<p><strong>Appreciate Extravagant Indoor Luxuries</strong></p>\r\n\r\n<p>Perfect indoor luxuries with opulent spa and salon amenities especially designed for you by <strong>Warren Tricomi</strong>. The world-famous Holyfield gym offers customized concierge services that personalize the gym experience.</p>\r\n\r\n<p><strong>An Enthralling View From A Terrace</strong></p>\r\n\r\n<p>Refresh your senses with a private party deck for every occasion, a dining lounge, and a caf&eacute; lounge. A lavish body of water with cutting-edge climate control and water that is always just right for you.</p>\r\n', '', 'At Godrej Connaught Place, there are 3 and 4 BHK apartments available, and the apartments here are extremely spacious and huge. Experience the lavish residences with a 7-star experience, curated only by invites. ', '', 'Godrej Connaught One Delhi - New Ultra Luxury Project in CP', 'Godrej Connaught One, Delhi is designed to amaze you with amenities like eminent double-height lobby, clubhouse, & 5 star security system. Call us to Book now!', '25', '2', '10', '2', '2', '<ul>\r\n	<li>The biggest perk of Godrej Connaught One, Central Delhi, is the connectivity it offers to its residents. For instance, the international airport is just 25 minutes away. All the other necessities, such as hospitals, grocery stores, and schools, are in the vicinity.&nbsp;</li>\r\n	<li>There is a terrace with breathtaking views. Residents get a chance to rejuvenate themselves with a huge seating lounge and a luxurious body of water with state-of-the-art temperature control.&nbsp;</li>\r\n	<li>Connaught Place is a hub for a huge variety of eating joints, cinemas, clothes, accessories, and whatnot. Hence, it&rsquo;s the best entertainment hub nearby.&nbsp;</li>\r\n	<li>Major attention is given to making the area look lush green to create an eco-friendly ambiance. Multiple efforts are made, such as adding air-purifying plants, water bodies, and dense greenery to the site to let residents enjoy fresh air 24*7.</li>\r\n	<li>There is adequate parking space as a dedicated 3-level basement has been built.&nbsp;</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_godrej-connaught-one-central-delhi-delhi_1759292253.jpg\"', NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(57, 0, 'Puri - The Aravallis', 'puri-the-aravallis-sector-61-gurgaon', NULL, 15, 1, 1, 1, NULL, 1, 1, 4.90, 83, '', 'Sector 61', 'Golf Course Extension Road', '67 Of 2022', 90, 90, 35000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2250, 'high', NULL, 'newly_launched', 0, 'Puri Aravallis Sector 61 assures a luxurious lifestyle with the availability of ultra-modern amenities for the dwellers. Some notable amenities of this lodging complex are a swimming pool, jogging area, kids\' parks, multi-purpose hall, sports facilities, an amphitheater, a public gym, and many more.', '<p><strong>Puri Aravallis</strong> is a luxury lifestyle living residential project in Sector 61, Gurgaon. Poised with <a href=\"https://www.propnkey.com/apartments-in-gurgaon/\" target=\"_blank\"><strong>3 BHK and 4 BHK luxurious apartments</strong></a>, this project can end your search for the dream home in Gurgaon.</p>\r\n\r\n<p>Puri - The Aravallis Gurgaon is an upcoming luxury residential development in Gurugram, featuring elegant high-rise towers facilitated with top-notch amenities. The residential complex will feature four buildings, and each tower will have a G+42 structure.</p>\r\n\r\n<p>Puri Aravallis project is packed with modern urban charm and features ample greenery in its surroundings. The Golf Course Extension Road&#39;s proximity makes the residential complex easily accessible. Moreover, the lodging complex is poised with advanced security features and high-class amenities to provide residents with the best living experience.</p>\r\n', '', '<p>The overall residential project will have four residential towers, while the total number of apartments is 360. Buyers can find two types of floor plans: 3 BHK and 4 BHK. The apartment sizes range from 2250 square feet to 2750 square feet.</p>\r\n', '', 'Puri Aravallis Sector 61, Gurgaon - Check Floor Plan, Price', 'Puri The Aravallis is a newly launched residential project by Puri Constructions. It offers 3 & 4 BHK luxury flats in Sector 61, Gurgaon. For bookings, Call now!', '0', '0', '0', '0', '0', '<ul>\r\n	<li><strong>Puri - The Aravallis</strong> enjoy close proximity to the Indira Gandhi International (IGI) Airport. At the same time, it is well-connected to the Delhi-Faridabad expressway and the NH-8 expressway.</li>\r\n	<li>The DLF Golf Course &amp; DLF Horizon Centre is reachable within 10 minutes, while Delhi&#39;s largest transportation hub is only 7 minutes away.</li>\r\n	<li>Residents will find multiple retail shopping centers near the residential complex. Moreover, you can find a hospital, healthcare clinics, banks, ATMs, and many other civic facilities within a 1 to 2 KM radius of the residential project.</li>\r\n	<li>The entire Puri Aravallis Gurugram residential complex possesses 360 apartments, which are divided into <strong>3 BHK and 4 BHK flats</strong>. The apartments offer spacious rooms, modern bathrooms, kitchens, high-quality fittings, etc.</li>\r\n	<li>The entire residential complex will be under the vigilance of a centralized security room. Modern security cameras, fire alarms, and other safety equipment have been installed to ensure peaceful living.</li>\r\n	<li>A <strong>hassle-free parking facility</strong> is another significant highlight of this residential complex. Vehicle owners will also find an electric vehicle charging station.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_puri-the-aravallis-sector-61-gurgaon_1759292253.jpg\"', NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04');
INSERT INTO `properties` (`id`, `is_featured`, `name`, `slug`, `alias_name`, `partner_id`, `agent_id`, `location_id`, `property_type_id`, `bedroom_option_id`, `property_category_id`, `property_condition_id`, `rating`, `review_count`, `badge`, `locality`, `address`, `rera_reg_no`, `sort_order`, `home_sort`, `price`, `monthly_rent`, `security_deposit`, `one_time_fees`, `total_payable`, `rent_includes`, `rent_excludes`, `rental_process`, `dos_donts`, `lock_in_period_days`, `notice_period_days`, `terms_conditions`, `is_rental`, `area_sq_ft`, `rise`, `possession`, `property_status`, `is_sold`, `amenities_description`, `property_description`, `gallery_description`, `floor_plan_description`, `offer_text`, `meta_title`, `meta_description`, `airport`, `entertainment`, `national_highway`, `hospitals`, `education`, `project_highlights_title`, `highlight_images`, `location_features`, `price_list`, `map_code`, `map_text`, `is_active`, `created_at`, `updated_at`) VALUES
(58, 0, 'Whiteland Blissville', 'whiteland-blissville-sector-76-gurgaon', NULL, 15, 1, 1, 1, NULL, 1, 1, 4.70, 52, '', 'Sector 76', '', 'HARERA No. 79 of 2022', 90, 90, 12500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1400, 'low', NULL, 'newly_launched', 0, 'Whiteland Blissville project in Gurugram has been planned to provide a modern lifestyle to the dwellers by designing beautiful luxury low-rise floors. At the same time, the Whiteland Corporation has kept the recreational provisions in mind. Living in a good apartment is not satisfying if the surroundings do not offer a peaceful aura and lavish facilities like you will get in Whiteland Blissville luxury floors. ', '<p><strong>Whiteland corporation</strong> proudly presents its first jewel in the series of the residential project &lsquo;<strong>BlissVille</strong>&rsquo; &ndash; <strong>Luxury Low-rise Floors in Sector 76, Gurugram</strong>. Whiteland corporation is a famous real estate developer with a reputation of developing <strong>luxury residential and commercial properties in Gurugram</strong>. Whiteland Blissville is strategically located on Southern Peripheral Road with proximity to NH-8, Dwarka Expressway, with multiple existing access routes.</p>\r\n\r\n<p>Whiteland Blissville is a newly launched <strong>&#39;Ultra luxury low-rise residential project&#39;</strong> in Sector 76, Gurgaon, featuring proximity to major connecting highways of Delhi NCR. Good connectivity with Delhi through NH-8 &amp; Dwarka Expressway makes <a href=\"https://www.propnkey.com/property/whiteland-blissville-sector-76-gurgaon/\"><strong>Whiteland Blissville</strong></a> a perfect destination for home buyers.</p>\r\n\r\n<h4><strong>Exclusivities of Whiteland Blissville</strong></h4>\r\n\r\n<ul>\r\n	<li>Master design architecture by <strong>Hafeez Contractor.</strong></li>\r\n	<li>Exquisite landscape design by Oracle landscapes &amp; world renowned <strong>Chris Jones.</strong></li>\r\n	<li>Unprecedented specifications &amp; amenities including <em><strong>Fully loaded modular kitchen and VRV Air conditioning</strong></em>.</li>\r\n	<li><strong>Vastu compliant</strong> architecture development</li>\r\n	<li>Breathtaking views overlooking the <strong>Aravali range</strong></li>\r\n	<li>Dedicated green belts for outdoor play, <strong>yoga &amp; meditation</strong> sessions.</li>\r\n</ul>\r\n', 'Take a virtual tour of the Whiteland Blissville by sitting at home. The following photographs of Blissville Sector 76 will give glimpses of the planned project and its surroundings.', '<p>Whiteland Blissville Sector 76 offers two types of low-rise luxury floors with ultra-modern amenities. You can book &#39;3 BHK + 2T &amp; 3 BHK +3T&#39; apartments at the starting price of approximately 1.25Cr.* onwards.</p>\r\n', '', 'Whiteland Blissville Sector 76 | Low-rise Luxury Floors in Gurgaon', 'Whiteland Blissville is a most promising newly launched Low-rise Luxury Floors in Sector 76, Gurgaon by Whiteland Corporation. Call now for details, price, & Brochure.', '0', '0', '0', '0', '0', '<p><meta charset=\"utf-8\" /></p>\r\n\r\n<p>Modern, spacious, and kids-friendly 3 BHK + 3T luxury apartments are the main highlights of Whiteland Blissville. The low-rise residential floors create a beautiful aura for a sophisticated and charming lifestyle. Some notable highlights of Whiteland Blissville are:</p>\r\n\r\n<p><strong>Config:</strong> 3 Bedrooms + 3 Toilets + Dedicated Terrace &amp; Sunken Basement space for WFH, kids room, Lounge &amp; gym zone</p>\r\n\r\n<p><strong>Location:</strong> In the most promising growth corridor of Gurugram in Sector 76.</p>\r\n\r\n<p><strong>Connectivity: </strong>Located on SPR with proximity to NH-8, Cloverleaf Flyover, Dwarka Expressway, with multiple existing access routes.</p>\r\n\r\n<p><strong>Amenities:</strong> Exclusively designed commercial arcade, Clubhouse, Swimming pool, Yoga center, Landscape Garden, Jogging Trail, Kids parks and activities, Gymnasium, and many more.</p>\r\n\r\n<p><strong>Security:&nbsp;</strong>CCTV coverage in parking areas and entrance lobby.</p>\r\n\r\n<p>Clubhouse offering holistic lifestyle amenities like Swimming pool, gymnasium, sports activity zones, Banquet hall &amp; Restaurant</p>\r\n', '\"properties/highlights/highlight_whiteland-blissville-sector-76-gurgaon_1759292254.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<tbody>\r\n	</tbody>\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>3BHK + 2T</td>\r\n			<td>1311 Sq.Ft.</td>\r\n			<td>1.25Cr.* Onwards</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3BHK + 3T</td>\r\n			<td>1600 Sq.Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know Best Price &amp; Offer</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(59, 0, 'Duplex Villa - Malibu Towne Gurgaon', 'north-east-facing-duplex-villa-malibu-towne-gurgaon', NULL, 15, 1, 1, 3, NULL, 1, 1, 4.70, 72, '', 'Malibu Towne', '', '', 90, 90, 170000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 5000, 'low', NULL, 'newly_launched', 0, '', '<p>This exquisite <strong>10 BHK Independent Duplex Villa in Gurgaon</strong> is available for sale in one of the finest locations of Malibu Towne. The meticulously designed Villa aims to elevate your quality of life and is <strong>Vastu compliant facing north-east</strong>. This ultra-luxurious Duplex villa in Gurgaon is spread over <strong>614 square yards</strong> with a private parking space for up to 5 cars and bikes. The villa is conveniently located close to social infrastructures like shopping centers, hospitals, restaurants, parks, and schools.&nbsp;</p>\r\n\r\n<p>This Duplex Villa has a great front and back yard that gives it a lush green setting. This villa has light-filled, roomy interiors with <em><strong>4 floors, 10 bedrooms, 2 lounges, 3 dining and living rooms, 3 kitchens, 3 servant rooms, and 1 terrace</strong></em>. This villa in Malibu Towne, inspired by American gated communities, embraces a surreal feel, extensive green areas, low traffic mobility, multi-tier security system, and it&#39;s a fully gated community to ensure residents&rsquo; peace of mind always. It has the best internal and external city connectivity and is central to all social and commercial amenities. This well-designed <strong>individual villa in Gurgaon</strong> is ready to move into and comes at a great price of INR 17 Cr. It has a clean environment and enchants you with its style and beauty.</p>\r\n\r\n<h3>Total 4-floor specifications:</h3>\r\n\r\n<ul>\r\n	<li><strong>LF:</strong> 3 Bedroom, lounge, drawing and dining hall, kitchen, servant room;</li>\r\n	<li><strong>GF:</strong> 3 Bedroom, drawing and dining hall, kitchen, servant room;</li>\r\n	<li><strong>FF:</strong> 4 Bedroom, drawing and dining hall, kitchen;</li>\r\n	<li><strong>SF:</strong> Terrace, 1 lounge cum bar, 1 servant room</li>\r\n</ul>\r\n', '', '<p>This 10 BHK villa has large bedrooms, spacious living rooms, modular kitchens, a lounge cum bar, a large parking area, a backyard, a front yard, a large terrace, and servant rooms. The lower ground floor encompasses 3 bedrooms, a lounge, a drawing and dining hall, a kitchen, and a servant room. The ground floor consists of 3 bedrooms, a drawing and dining hall, a kitchen, and a servant room. The first floor includes&nbsp; 4 bedrooms, drawing and dining hall, and a kitchen. Finally, the second floor includes a terrace, 1 lounge cum bar, and 1 servant room.&nbsp;<br />\r\nAll floors are effectively planned to maximize usable space. Each room is planned to allow the circulation of fresh air and sunlight throughout the day. It has the best security setup so you can relish both home&#39;s comfort and peace of mind with your family. Get the best price on this magnificent luxury villa in Gurgaon and own the house of your dreams.</p>\r\n', '', 'North East Facing Duplex Villa For Sale in Malibu Towne, Gurgaon', '', '0', '0', '0', '0', '0', '<ul>\r\n	<li><strong>Parking: </strong>Huge private parking space for 4-5 cars in the front</li>\r\n	<li><strong>View:</strong> This Guamukhi plot has open land at its back with a panoramic view</li>\r\n	<li><strong>Connectivity: </strong>Well-developed internal roads connecting to nearby expressways</li>\r\n	<li><strong>Limited edition: </strong>Ultra-luxury North East facing Individual Villa with Gaumukhi plot in Malibu Towne, Gurgaon.</li>\r\n	<li><strong>Security:</strong> Multi-tier security system</li>\r\n	<li><strong>Green landscape:</strong> Large private backyard and front yard for sports and gardening.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_north-east-facing-duplex-villa-malibu-towne-gurgaon_1759292255.jpg\"', NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(60, 0, 'DLF The Grove', 'dlf-the-grove-golf-course-road-gurgaon', NULL, 4, 1, 1, 1, NULL, 1, 1, 4.80, 63, '', 'Golf Course Road', 'DLF Phase 5', '13 OF 2022', 90, 90, 52000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2430, 'low', NULL, 'newly_launched', 0, 'A leisurely lifestyle close to nature awaits you at The Grove. A host of world-class amenities ensure you lead a healthy, safe and active lifestyle.​​ This dream home lets your family enjoy abundant nature, lush green meadows, and excellent infrastructure. The Grove, with its array of ultra-premium residences, has established itself as the landmark of luxury living in Gurgaon by integrating location, lifestyle, legacy, and luxury. ', '<p>DLF is thrilled to present, <strong>DLF&nbsp;The Grove</strong> -&nbsp;its first <strong>low-rise ultra-luxurious development in DLF Phase 5, Gurgaon</strong>. In the most prominent location of Gurgaon, this project offers lavish <strong>4 BHK and 5 BHK independent floors</strong> with a variety of ultra-modern amenities.&nbsp;</p>\r\n\r\n<p><strong>DLF The Grove</strong> is surrounded by Gurgaon&#39;s express lifelines connecting Delhi-Jaipur Expressway, Mehrauli-Gurugram Road, and Raghvendra Marg. Relish the bliss of urban living with the added privilege of independence and privacy.&nbsp;</p>\r\n\r\n<p><br />\r\nDLF The Grove offers fully equipped homes with exquisite <strong>private rooftop gardens</strong> to ensure a luxurious lifestyle. It will provide your family with the best environment ever. The builder has planned it as a low rise luxury residence with a separate store room and servant room for every unit. It offers easy road connectivity via Gurgaon-Faridabad Road, Golf Course Marg, and Southern Peripheral Road.</p>\r\n\r\n<p>DLF is the largest publicly listed real estate company and known for its uncompromising integrity in quality assurance and customer engagement. It offers an unmatched legacy of providing excellent customer service on a remarkable scale. DLF recently launched <strong>The Grove in Phase 5 Gurgaon</strong> - a Low-rise living, independent floors with excellent connectivity &amp; <strong>exclusive payment plans</strong>.</p>\r\n\r\n<p>DLF The Grove is a best-in-class futuristic development with cutting-edge amenities that enable an extravagant and comfortable life. This is redesigned by the renowned MPFP and ARCOP. Pursue modern living and grab this opportunity where you can completely immerse yourself in this grandiose residence. Adore the zest and bliss of living at The Grove in millennium city, Golf Course Road, Gurgaon.</p>\r\n\r\n<p><span style=\"font-size:11pt; font-variant:normal; white-space:pre-wrap\"><span style=\"font-family:Arial\"><span style=\"color:#000000\"><span style=\"font-weight:700\"><span style=\"font-style:normal\"><span style=\"text-decoration:none\">Initial pre-launch phase with limited inventory before the price hike. Book now!</span></span></span></span></span></span></p>\r\n', 'The exceptional architectural design perfectly captures the ideal fusion of indulgence and luxury influencing an aesthetic lifestyle. A plethora of natural beauty ensures that there is never a dull moment in your life at DLF The Grove, Phase 5 Gurgaon. This development is a perfect blend of urban tranquillity and modern civilization. It allows your family to immerse in the opulent experience of a grand lifestyle. Discover the perks of living at The Grove, designed to meet the highest standards of living.', '<p>DLF The Grove is a 5.3 acre luxury low rise residential project having 290 homes for sale in Gurgaon. Residents can opt for 4 or 5 BHK apartments ranging from 270 sq yards to 500 sq yards. The construction is under construction and will be ready for possession in 2025.</p>\r\n', 'Limited Inventory. Book your home by paying just Rs. 10 lacs. ', 'DLF The Grove - Phase 5, Golf Course Road, Gurgaon', 'DLF unveils \'DLF Grove\' - ultra luxurious low-rise residences in the most prominent address of Gurgaon, DLF 5. Limited Inventory, Book now!', '25', '5', '10', '5', '5', '<ul>\r\n	<li>1st <strong>luxury low-rise project in DLF Phase 5</strong>, Golf Course Road, Gurgaon by <strong>DLF</strong>.</li>\r\n	<li>Gated Community with Top notch <strong>biometric security</strong> for residences</li>\r\n	<li>Amenities like <strong>Home Automation</strong>, Fire and Gas leakage alarm systems, Luxurious Interior finishes, <strong>Private Roof top gardens</strong>, and more</li>\r\n	<li><strong>5 Minutes&rsquo; drive</strong> to multiple international schools and top hospitals</li>\r\n	<li>Separate <strong>staff room and store room</strong> in the basement for each floor with attached toilet</li>\r\n	<li>Well connected to Golf Course Road, Gurgaon Golf Links, NH8, Golf Course Extension Road, MG Road</li>\r\n	<li aria-level=\"1\"><strong>1.5 acre Central Park</strong> in the community for family recreation and fitness.</li>\r\n	<li aria-level=\"1\">Fully air-conditioned entrance lobby with RFID for security.</li>\r\n	<li aria-level=\"1\">The entire floor is equipped with <strong>VRV high-wall air conditioning</strong>.</li>\r\n	<li aria-level=\"1\">2 <strong>private elevators</strong> with 500 sq yards and above layouts.</li>\r\n	<li aria-level=\"1\">Paul Friedberg&#39;s exquisitely designed and landscaped terrace gardens.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_dlf-the-grove-golf-course-road-gurgaon_1759292255.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<tbody>\r\n	</tbody>\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Configuration Type</th>\r\n			<th scope=\"col\">Area (in SQ.YD.)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>4 BHK + Servant, Store in Basement</td>\r\n			<td>269 Sq. Yards</td>\r\n			<td>5.2 Cr.* Onwards</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4 BHK + Servant, Store in Basement + Terrace</td>\r\n			<td>340 Sq. Yards</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Request Best Price &amp; Offer</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>5 BHK + Servant + Store + Terrace</td>\r\n			<td>500 Sq. Yards</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Request Best Price &amp; Offer</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(61, 0, '4 BHK Luxury Independent Villa', '4-bhk-luxury-independent-villa-assagao-goa', NULL, 15, 1, 5, 3, NULL, 1, 1, 4.50, 58, 'Holiday Home', 'Assagao', '', '', 90, 90, 175000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4778, 'low', NULL, 'newly_launched', 0, '', '', '', '', '', '4 BHK Luxury Independent Villa for Sale in Assagao, Goa', '4 BHK Luxury Independent Villa for Sale at very prominent location in Assagao, Goa. Contact us for more details.', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(62, 0, 'EMAAR EBD89', 'emaar-ebd89-sector-89-gurgaon', NULL, 1, 1, 1, 5, NULL, 1, 1, 4.70, 64, '', 'Sector 89', '', '', 90, 90, 23000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 'low', NULL, 'newly_launched', 0, '', '', '', '', '', 'Emaar EBD89 - Commercial SCO Plots in Gurgaon', '', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 0, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(63, 0, 'Elan The Presidential', 'elan-the-presidential-sector-106-gurgaon', NULL, 15, 1, 1, 1, NULL, 1, 1, 4.60, 54, '', 'Sector 106', '', 'HARERA No. 101 of 2022', 90, 90, 36000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2600, 'high', NULL, 'newly_launched', 0, '', '<p>Elan The Presidential is a newly launched luxury residential project in Sector 106, Gurgaon-Dwarka Expressway, Gurugram. Elan Presidential offers well-designed apartment choices just to deliver you a wonderful home space with sun-filled rooms &amp; proper ventilation where people will experience approximately reasonably and enhanced.</p>\r\n\r\n<p>Elan Presidential is new launched project on Gurgaon-Dwarka Expressway, Gurugram by Elan Group. It offers 3BHK, 4BHK &amp; 5BHK luxury high-rise apartments for best lifestyle with the advantage of world-class amenities to live in the lap of extravagance for life.&nbsp; It also offers a range of amenities and facilities to its residents, including a swimming pool, gym, outdoor sports facilities, and more. Elan the Presidential has a variety of units available, including apartments and penthouses, with prices starting at 3.6 Cr.* onwards.</p>\r\n\r\n<p>Elan Group is one of the fastest-growing real estate firm&nbsp;in the country. The Elan Group has been assigned to construct the habitat to create extraordinary work on the land of the nation. Elan Group has furnished their best work as a project named by Mercado, Elan Town Centre, and Elan Sector 106 in Gurgaon, just created in a notable period of four years.&nbsp;It sets landmarks in the Commercial real estate industry of the Town. Elan Group has an enormous number of followers, who believe in their work and efficiency towered furnishing projects a significant time duration.</p>\r\n', '', '', '', 'Elan The Presidential Sector 106, Gurgaon', 'Elan The Presidential - A Newly launched luxury residential project in Sector 106, Dwarka - Gurgaon Expressway Road, Gurgaon. Enquire now to avail best offer!', '15', '5', '10', '10', '5', '<p>Some of the major property highlights and location advantages of <strong>Elan The Presidential in Gurgaon</strong> includes:</p>\r\n\r\n<ul>\r\n	<li><strong>Luxurious amenities:</strong> Elan The Presidential offers a range of luxurious amenities to its residents, including a swimming pool, clubhouse, Walking/Jogging track, Multi-tier Security, outdoor sports facilities, and more.</li>\r\n	<li><strong>Variety of units:</strong> Elan Presidential&nbsp;by Elan Group offers a variety of units, including 3, 4, 5 BHK apartments and penthouses, to suit the needs of different home buyers.</li>\r\n	<li><strong>Prime location:</strong> Elan The Presidential is located in sector-106, Dwarka Expressway, Gurgaon, which is a prime location with easy access to all the major landmarks and amenities of the city.</li>\r\n	<li><strong>Gated community:</strong> Elan Presidential housing society&nbsp;is a gated community with round-the-clock 3 tier security, ensuring the safety and privacy of its residents.</li>\r\n	<li><strong>Proximity to major transportation hubs:</strong> Elan The Presidential is located in close proximity to major transportation hubs, including airports, highways, and public transportation, making it convenient for residents to travel.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_elan-the-presidential-sector-106-gurgaon_1759292256.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in SQ.FT)</th>\r\n			<th scope=\"col\">Price &amp; Offers</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>3 BHK + Servant</td>\r\n			<td>2600 SQ. FT.</td>\r\n			<td>3.6 Cr*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4 BHK + Servant</td>\r\n			<td>3100 SQ. FT.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Enquire Best Price &amp; Offer</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>5 BHK + Servant</td>\r\n			<td>4100 SQ. FT.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Enquire Best Price &amp; Offer</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(64, 1, 'DLF - The Arbour', 'dlf-crest-2-sector-63-gurgaon', NULL, 4, 1, 1, 1, NULL, 1, 1, 4.70, 88, '', 'Sector 63', 'Golf Course Extension', '', 90, 90, 75000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3800, 'high', NULL, 'newly_launched', 0, '', '<p>DLF&#39;s upcoming project in Sector 63, Gurugram is a luxury residential high-rise project featuring 4 BHK apartments with prices starting from 7.5 crores onwards. The project offers a variety of modern amenities and boasts a major attraction of a 100,000 sqft Clubhouse on 14 acres of land. The project is an upcoming residential development, and is ideal for those looking for a luxurious living experience with state-of-the-art amenities in a prime location of Golf Course Extension, Gurgaon.</p>\r\n', '', '', 'Hurry up! Pay just 1.9 Cr.* now and rest after 2.5 years.', 'DLF The Arbour, Sector 63, Gurugram | DLF Luxury Residential Projects', 'Experience luxury living at its finest with DLF\'s upcoming project in Sector 63, Gurugram. Don\'t miss out on this prime opportunity.', '20', '5', '10', '5', '5', '<p><strong>DLF - The Arbour</strong> is an upcoming luxury residential development, offering a variety of location &amp; project highlights such as:</p>\r\n\r\n<ul>\r\n	<li>Convenient access to a variety of shopping, dining, and entertainment options, including malls, restaurants, cafes,&nbsp;and major transportation routes, including the Delhi-Gurgaon Expressway, making it easy to commute to nearby cities and business hubs.</li>\r\n	<li>A rapidly developing area with a variety of new commercial and residential developments, making it a great choice for those looking for a modern and dynamic environment.</li>\r\n	<li>The project is in the close proximity to Cyber city &amp; Golf course road, which is a major hub for IT and corporate companies.</li>\r\n	<li>Luxury residential high-rise project featuring 4 BHK apartments with prices starting from 7.5 crores.</li>\r\n	<li>Offers a variety of modern amenities such as a 100,000 sqft Clubhouse on 14 acres of land.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n', '\"properties/highlights/highlight_dlf-crest-2-sector-63-gurgaon_1759292256.jpg\"', NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(65, 0, 'Pursuit of a Radical Rhapsody (POARR)', 'pursuit-of-a-radical-rhapsody-poarr-whitefield-bangalore', NULL, 16, 1, 9, 1, NULL, 1, 1, 4.80, 89, '', 'Whitefield', '', 'PRM/KA/RERA/1251/446/PR/171014/000433', 90, 90, 17500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1384, 'high', NULL, 'newly_launched', 0, '', '<p>Pursuit of a Radical Rhapsody (POARR) is an exclusive community of apartments located in Whitefield, Bangalore - the heart of India&#39;s Silicon Valley. The project offers beautiful homes with green roofs, a central community park, and is situated at the edge of a small lake.</p>\r\n\r\n<p>The community features a variety of signature earth-sheltered homes with 4 bedrooms, including the popular C20 layout. The unique lake-facing L30 three-bedroom apartments offer stunning views, while the special L45 <strong><a href=\"https://www.propnkey.com/property/in-that-quiet-earth-itqe-hennur-road-bangalore/\">four-bedroom apartments</a></strong> step back from the lake and feature open-to-sky gardens.</p>\r\n\r\n<p>Tower 8 offers 3-bedroom homes in L20, L22, R25, and duplex-D35 configurations, providing residents with a range of options to choose from.</p>\r\n\r\n<p>Pursuit of a Radical Rhapsody was built with an innovative idea in mind: a garden on every terrace, even as high as on the 27th floor. This unique feature allows residents to enjoy the benefits of greenery and nature even in the heart of the city.</p>\r\n\r\n<p>In addition to the beautiful homes and lush greenery, the community also includes a central community park, providing a space for residents to gather and enjoy the outdoors together.</p>\r\n\r\n<p>Overall, Pursuit of a Radical Rhapsody offers a unique and innovative living experience in the heart of Bangalore&#39;s bustling Silicon Valley, combining beautiful homes with green roofs and a commitment to bringing nature and the outdoors into every aspect of the community.</p>\r\n', '', '', '', 'Pursuit of a Radical Rhapsody (POARR), Whitefield, Bangalore', 'Discover the exclusive community of Pursuit of a Radical Rhapsody (POARR) in Whitefield, Bangalore - the vibrant heart of India\'s Silicon Valley. Book Free Site Visit.', '0', '0', '0', '0', '0', '', NULL, NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Product</th>\r\n			<th scope=\"col\">Saleable Area (in Sq.Ft)</th>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>R11 - 2 BHK</td>\r\n			<td>1384 Sq.Ft.</td>\r\n			<td>2 Bed | 2 Bath</td>\r\n			<td>1.75 Cr.*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>R22 - 3 BHK</td>\r\n			<td>2804 Sq.Ft.</td>\r\n			<td>3 Bed + Family Room + 3 Bath</td>\r\n			<td>3.74 Cr.*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>L20 - 3 BHK</td>\r\n			<td>2430 Sq.Ft.</td>\r\n			<td>3 Bed | 3 Bath</td>\r\n			<td>3.54 Cr.*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>L22 - 3 BHK</td>\r\n			<td>2530 Sq.Ft.</td>\r\n			<td>3 Bed + 3 Bath + Office</td>\r\n			<td>3.59 Cr.*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>R25 - 3.5 BHK</td>\r\n			<td>3434 Sq.Ft.</td>\r\n			<td>3 Bedroom Unit + Family Room</td>\r\n			<td>4.59 Cr.*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D35 - Duplex</td>\r\n			<td>4596 Sq.Ft.</td>\r\n			<td>3.5 Bedroom Duplex</td>\r\n			<td>6.80 Cr.*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>C20 - 3 BHK</td>\r\n			<td>2753 Sq.Ft.</td>\r\n			<td>3 Bedroom | 3 Bathroom</td>\r\n			<td>3.79 Cr.*</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(66, 0, 'In That Quiet Earth (ITQE)', 'in-that-quiet-earth-itqe-hennur-road-bangalore', NULL, 16, 1, 9, 1, NULL, 1, 1, 4.80, 88, '', 'Hennur Main Road', '', 'PRM/KA/RERA/1251/446/PR/180519/001745', 90, 90, 15300000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1431, 'high', NULL, 'newly_launched', 0, '', '<p>In That Quiet Earth (ITQE) is an exclusive residential project developed by <strong>Total Environment</strong>, located off Hennur Main Road in North Bangalore. The project is designed to offer a luxurious and comfortable living experience for property buyers who value quality, convenience, and style.</p>\r\n\r\n<p>ITQE comprises <strong>2, 3, and 4-bedroom homes</strong> that are thoughtfully crafted to meet the functional needs and lifestyle preferences of residents. Each home is designed with the utmost care and attention to detail, ensuring that it seamlessly blends with its surroundings while providing a serene and tranquil living environment.</p>\r\n\r\n<p>The location of ITQE is one of the project&#39;s strongest selling points. North Bangalore is a fast-growing economic hub that offers easy access to essential social infrastructure such as reputed schools, colleges, hospitals, malls, and hotels. This makes ITQE an excellent choice for families looking to live in a well-connected and thriving urban community.</p>\r\n\r\n<p>One of the unique features of ITQE is its emphasis on sustainable living. Total Environment has taken great care to ensure that the project is <strong>eco-friendly and energy-efficient</strong>, with features such as rainwater harvesting, solar water heating, and waste management systems. These sustainable features not only reduce the project&#39;s environmental impact but also help residents save on utility bills, making ITQE a cost-effective and environmentally responsible choice for property buyers.</p>\r\n', '', '', '', 'In That Quiet Earth, ITQE Bangalore | 2/3/4 BHK Flats Near Hennur Road', 'Discover a tranquil living experience at In That Quiet Earth (ITQE) Bangalore - an exclusive community of thoughtfully-designed homes located near Hennur Main Road.', '50', '5', '10', '5', '5', '', NULL, NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Product</th>\r\n			<th scope=\"col\">Saleable Area (in Sq.Ft)</th>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>L25 - 4-Bedroom Homes</td>\r\n			<td>3188 Sq.Ft.</td>\r\n			<td>4 Bed | 4 Bath</td>\r\n			<td>3.63 Cr.*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>L21 - 3-Bedroom Homes</td>\r\n			<td>2628 Sq.Ft.</td>\r\n			<td>3 Bed + 3 Bath</td>\r\n			<td>3.02 Cr.*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>U10 - 2-Bedroom Homes</td>\r\n			<td>1431 Sq.Ft.</td>\r\n			<td>2 Bed | 2 Bath</td>\r\n			<td>1.53 Cr.*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>H20 - 3-Bedroom Homes</td>\r\n			<td>2305 &amp; 2409 Sq.Ft.</td>\r\n			<td>3 Bed + 3 Bath</td>\r\n			<td>2.53 Cr.*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>U20 - 4-Bedroom Homes</td>\r\n			<td>2890 Sq.Ft.</td>\r\n			<td>4 Bedroom + 4 Bath</td>\r\n			<td>3.33 Cr.*</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(67, 0, '3 BHK Apartment for Sale', '3-bhk-apartment-for-sale-siolim-goa', NULL, 15, 1, 5, 1, NULL, 1, 1, 4.50, 84, '', 'Siolim', '', '', 90, 90, 22000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1720, 'low', NULL, 'newly_launched', 0, '', '<p>Looking for a luxurious 3BHK apartment in one of the most beautiful and serene locations in Goa, then this <a href=\"https://www.propnkey.com/property/luxury-villas-with-private-pool-for-sale-in-siolim-goa/\">property located in Siolim</a> is the perfect fit for you. With a built-up area of 160 square metres, this spacious apartment offers ample room for comfortable living.</p>\r\n\r\n<p>One of the unique features of this property is its six balconies, which provide stunning panoramic views of the beautiful surroundings. Whether you want to enjoy the cool breeze or soak in the stunning views, these balconies offer the perfect space for it.</p>\r\n\r\n<p>The apartment comes fully furnished and is ready for you to move in right away. With premium quality fittings and fixtures, comfortable beds, modern kitchen appliances, and stylish decor, this apartment offers the ultimate living experience.</p>\r\n\r\n<p>The apartment is perfect for families or individuals who want to enjoy a luxurious living experience in one of the most beautiful locations in Goa.</p>\r\n\r\n<p>In addition to its stunning features, Siolim is a prime location in Goa with excellent connectivity to nearby attractions, restaurants, and markets. You&#39;ll never run out of things to do, and the stunning beaches are just a short drive away.</p>\r\n\r\n<p>If you&#39;re looking for a premium quality, <a href=\"https://www.propnkey.com/goa-properties/\">fully furnished 3BHK apartment in Siolim, Goa</a>, then this property is the perfect investment opportunity. Contact us today to schedule a viewing and experience the beauty and comfort of this stunning property for yourself.</p>\r\n\r\n<p><strong>Note:&nbsp;</strong>It&#39;s important to note that the recliner, sofa, and TV are not included in the deal, but the rest of the furniture and appliances are.</p>\r\n', '', '', '', 'Fully Furnished 3BHK Apartment for Sale in Siolim, Goa', 'Looking for a luxurious 3BHK apartment in Goa? Invest in this fully furnished property in Siolim with stunning views, premium fittings, modern appliances, and a prime location. Contact us to schedule ', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(68, 0, 'Villa for Resale in Marsierra', 'villa-for-resale-in-marsierra-siolim-goa', NULL, 15, 1, 5, 3, NULL, 1, 1, 4.50, 63, 'Holiday Home', 'Siolim', '', '', 90, 90, 60000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1915, 'low', NULL, 'newly_launched', 0, '', '<p>Escape to a <strong><a href=\"https://www.propnkey.com/villa-in-goa\">luxurious villa for resale</a></strong> in the serene and picturesque location of Siolim, North Goa. Designed with the perfect blend of elegance and tropical charm, this Hampton-style holiday Villa&nbsp;is wrapped in lush tropical foliage, offering an intimate and resort-like setting for friends and families.</p>\r\n\r\n<p>The villa features an open and spacious floor plan that maximizes natural light and air ventilation, creating a peaceful and warm ambiance that&#39;s perfect for relaxation and unwinding. With large windows that showcase the stunning views and natural surroundings, the villa is the perfect retreat from the hustle and bustle of city life.</p>\r\n\r\n<p>At Marsierra by Jaglax Homes, we wanted to create the perfect <strong><a href=\"https://www.propnkey.com/holiday-home/\">holiday homes</a></strong> for friends and families to stay together and not be confined to the closed environment of a hotel room. The villa is designed to offer the luxury amenities of a resort, while also providing a cozy and intimate setting for creating memories that will last a lifetime.</p>\r\n\r\n<p>This luxurious <strong><a href=\"https://www.propnkey.com/villa-in-goa\">villa is available for resale</a></strong> at a price of 6 crore, offering the ultimate investment opportunity for those seeking a high-end living experience in North Goa. Contact us today to schedule a viewing and experience the beauty and luxury of this stunning property for yourself.</p>\r\n', '', '', '', 'Luxury Villa for Resale in Marsierra, Siolim North Goa', 'Luxury Villa for Resale in North Goa - Invest in a luxury villa for resale in the serene and picturesque location of Marsierra, Siolim North Goa. ', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(69, 0, 'SmartWorld - The Edition', 'code-66-sector-66-gurgaon', NULL, 15, 1, 1, 1, NULL, 1, 1, 4.90, 77, '', 'Sector 66', 'Golf Course Extension Road', '', 90, 90, 52000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2950, 'high', NULL, 'newly_launched', 0, '', '<p>Experience ultra-luxury living in &#39;SmartWorld - The Edition&#39; exquisite apartments located in the heart of Gurgaon&#39;s Golf Course Extension Road. SmartWorld - The Edition offers all the modern amenities that one could desire, including a private plunge pool, private terrace for moon-lit celebrations, and a double-height living-dining lounge.</p>\r\n\r\n<p>The Edition features master bedrooms with lavish bathrooms and jacuzzi, as well as a master glamorous bathroom with a bathtub. The luxurious kitchen comes with both wet and dry areas, perfect for entertaining guests.</p>\r\n\r\n<p>The Edition, this exclusive community is designed for the most discerning individuals who appreciate the finer things in life.&nbsp;</p>\r\n\r\n<p>Explore our exclusive limited collection of penthouses, each priced at 11.99 crores, representing an authentic investment in the lap of luxury. Enjoy a lifestyle of indulgence and sophistication in this exceptional penthouse, located in one of the most desirable neighborhoods in Gurgaon.</p>\r\n\r\n<p data-sourcepos=\"5:1-5:41\"><strong>Step into a haven of refined comfort:</strong></p>\r\n\r\n<ul data-sourcepos=\"6:1-6:59\">\r\n	<li data-sourcepos=\"6:1-6:59\"><strong>Master bedrooms:</strong>&nbsp;Wake up to the embrace of lavishness,&nbsp;featuring en-suite bathrooms with indulgent jacuzzis and a glamorous master bath with a soaking tub.</li>\r\n	<li data-sourcepos=\"7:1-7:168\"><strong>Double-height living-dining lounge:</strong>&nbsp;Elevate your gatherings in a grand,&nbsp;double-height space bathed in natural light,&nbsp;the perfect canvas for unforgettable soir&eacute;es.</li>\r\n	<li data-sourcepos=\"8:1-8:128\"><strong>Private terrace:</strong>&nbsp;Bask in the moonlight and city lights on your private terrace,&nbsp;creating intimate moments under the stars.</li>\r\n	<li data-sourcepos=\"9:1-10:0\"><strong>Gourmet kitchen:</strong>&nbsp;Craft culinary masterpieces in a luxurious kitchen boasting dedicated wet and dry areas,&nbsp;ideal for hosting and entertaining your guests.</li>\r\n</ul>\r\n\r\n<p data-sourcepos=\"11:1-11:67\"><strong>Beyond your residence, discover a world of exclusive amenities:</strong></p>\r\n\r\n<ul data-sourcepos=\"13:1-13:73\">\r\n	<li data-sourcepos=\"13:1-13:73\"><strong>Plunge pool:</strong>&nbsp;Dive into refreshing privacy in your own private pool,&nbsp;a serene oasis amidst the city&#39;s buzz.</li>\r\n	<li data-sourcepos=\"14:1-14:133\"><strong>State-of-the-art fitness center:</strong>&nbsp;Maintain your wellness routine in a fully equipped gym,&nbsp;designed to invigorate and rejuvenate.</li>\r\n	<li data-sourcepos=\"15:1-15:112\"><strong>Spa &amp; wellness sanctuary:</strong>&nbsp;Unwind and pamper yourself in a haven of blissful treatments and relaxation.</li>\r\n	<li data-sourcepos=\"16:1-17:0\"><strong>Exquisite landscaping:</strong>&nbsp;Immerse yourself in the beauty of meticulously designed green spaces,&nbsp;offering tranquility and a breath of fresh air.</li>\r\n</ul>\r\n', '', '', '', 'SmartWorld - The Edition Gurgaon | Lavish Penthouse with Private Pool + Terrace', ' Looking for luxury apartments for sale in Gurgaon? Discover an exclusive community on Golf Course Extension Road, offering only 11 exquisite penthouses.', '30', '10', '5', '5', '5', '<ul>\r\n	<li>Ducted VRV Air Conditioning for personalized climate control</li>\r\n	<li>Italian Marble flooring that exudes elegance and luxury</li>\r\n	<li>Air purification system seamlessly integrated into the Aircon for a fresh living environment</li>\r\n	<li>Ceiling height of 3.45 meters, the highest in the segment, creating a spacious and grand ambiance</li>\r\n	<li>Unique concept of Private Jacuzzi &amp; Deck Living for an exclusive and indulgent experience</li>\r\n	<li>Large party deck designed to accommodate up to 45 guests, perfect for hosting grand gatherings</li>\r\n	<li>Sun deck providing an ideal space to enjoy the warmth of the winter sun</li>\r\n	<li>Moon deck designed for intimate candlelight dinners, creating a romantic ambiance</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_code-66-sector-66-gurgaon_1759292257.jpg\"', NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Product</th>\r\n			<th scope=\"col\">Saleable Area (in Sq.Ft)</th>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>3 BHK Homes</td>\r\n			<td>2950 Sq. Ft.</td>\r\n			<td>3 BHK + Study + Utility</td>\r\n			<td>₹5.2 Cr*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK Homes</td>\r\n			<td>3035 Sq. Ft.</td>\r\n			<td>4 BHK + Study + Utility</td>\r\n			<td>₹5.35 Cr*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4 BHK Homes</td>\r\n			<td>3505 Sq. Ft.</td>\r\n			<td>4 BHK + Study + Utility</td>\r\n			<td>₹6.2 Cr*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4 BHK Homes</td>\r\n			<td>3660 Sq. Ft.</td>\r\n			<td>4 BHK + Study + Utility</td>\r\n			<td>₹6.45 Cr*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Penthouse</td>\r\n			<td>7000 Sq.Ft.</td>\r\n			<td>4 BHK + Study + Utility + Servant</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(70, 1, 'Smart World One DXP', 'smart-world-one-dxp-sector-113-dwarka-expressway-gurgaon', NULL, 15, 1, 1, 1, NULL, 1, 1, 4.80, 52, '', 'Sector 113', 'Dwarka Expressway', 'RC/REP/HARERA/GGM/645/377/2022/120', 90, 90, 16400000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1380, 'high', NULL, 'newly_launched', 0, '', '<p>Welcome to Smartworld ONE DXP, a prestigious residential project brought to you by M3M Smartworld, situated in the coveted Sector 113, Dwarka Expressway, Gurgaon. Nestled in the heart of one of Delhi NCR&#39;s most sought-after locations, this exquisite development promises an unparalleled living experience that combines luxury, convenience, and innovation.&nbsp;As you step into Smartworld ONE DXP, you will be greeted by a host of remarkable highlights that set this project apart from the rest.</p>\r\n\r\n<p>The homes at Smartworld ONE DXP are a testament to meticulous craftsmanship and attention to detail. Offering 2.5, 3.5, and 4.5 BHK smart homes powered by SCHNEIDER, residents can experience a seamless integration of cutting-edge technology and comfort. Exclusive interiors exude elegance, while magnificent balconies invite you to indulge in stunning views and soak in the serenity of the surroundings.</p>\r\n\r\n<p>Smartworld ONE DXP aims to redefine the concept of efficient living. With highly efficient homes, residents can revel in the advantages of sustainable and environmentally conscious living, without compromising on style or luxury.</p>\r\n\r\n<p>The project boasts a sprawling club that encompasses social, sports, and satellite clubbing zones, allowing residents to socialize, unwind, and indulge in their favorite recreational activities. Additionally, a host of lifestyle amenities are at your disposal, ensuring that every aspect of your life is enriched within the confines of this magnificent development.</p>\r\n\r\n<p>Smartworld ONE DXP is not just a residential project; it&#39;s a testament to the pursuit of luxury, innovation, and an elevated lifestyle. Discover a world where opulence meets practicality, where every day is filled with infinite joys of living. Welcome to Smartworld ONE DXP, where luxury truly finds its home.</p>\r\n', '', '', '', 'Smartworld ONE DXP: Luxury Living Redefined on Dwarka Expressway, Gurgaon', 'Experience luxury living at Smartworld ONE DXP on Dwarka Expressway, Gurgaon. Discover sophistication, unmatched amenities, and elevate your lifestyle. Enquire now!', '15', '10', '5', '5', '5', '<p>Smartworld ONE DXP offers a blend of opulence, convenience, and innovation, creating an unparalleled living experience. Some of the main project highlights are:</p>\r\n\r\n<ul>\r\n	<li><strong>Premium Landmark of Dwarka Expressway:</strong> Smartworld ONE DXP stands as a prominent and prestigious residential project in a prime location.</li>\r\n	<li><strong>Special Deck Homes for Super Premium Lifestyle Seekers:</strong> Indulge in the epitome of luxury living with meticulously designed special deck homes.</li>\r\n	<li><strong>Aqua and Terra Amusement Areas for Kids:</strong> Engage children with dedicated aqua and terra amusement areas, filled with interactive elements.</li>\r\n	<li><strong>SCHNEIDER-Powered 2.5, 3.5, 4.5 BHK Smart Homes:</strong> Experience seamless integration of technology and comfort in these highly efficient homes.</li>\r\n	<li><strong>Exclusive Interiors and Magnificent Balconies:</strong> Immerse yourself in elegance with exclusive interiors and enjoy the serenity from magnificent balconies.</li>\r\n	<li><strong>Lifestyle Amenities and Club:</strong> Explore a club offering social, sports, and satellite clubbing zones, accompanied by a host of lifestyle amenities.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_smart-world-one-dxp-sector-113-dwarka-expressway-gurgaon_1759292257.jpg\"', NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(71, 0, 'Conscient Vista Arrozal', 'conscient-vista-arrozal-candolim-goa', NULL, 15, 1, 5, 1, NULL, 1, 1, 4.60, 43, 'Holiday Home', 'Candolim', '', 'PRGO01231866', 90, 90, 40000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1775, 'low', NULL, 'newly_launched', 0, '', '<p>Nestled amidst the picturesque landscape of Goa, <strong>Vista Arrozal</strong> is an exquisite luxury residential project that offers a truly enchanting living experience. As you step into this haven of tranquility, you will be instantly captivated by the serene ambiance and breathtaking natural beauty that surrounds you.</p>\r\n\r\n<p>The <strong>Conscient&nbsp;Vista Arrozal</strong> is strategically located in Candolim, Goa,&nbsp; allowing residents to witness the mesmerizing spectacle of the sun rising over a verdant canopy of the forest, casting a golden hue on the emerald paddy fields that stretch as far as the eye can see. The rhythmic sound of the babbling Nerul River adds a soothing melody to the air, creating a symphony of nature&#39;s finest elements.</p>\r\n\r\n<p>One of the most captivating features of <strong>Conscient&nbsp;Vista Arrozal</strong> is the captivating Goan chapel that stands gracefully on the property. With its rich historical significance and architectural splendor, the chapel adds a touch of grandeur to the surroundings, serving as a reminder of the cultural heritage of Goa.</p>\r\n\r\n<p>Beyond the confines of your residence, Vista Arrozal offers an array of world-class facilities for residents to indulge in. Dive into the shimmering infinity pool that seems to merge seamlessly with the horizon, providing a refreshing respite from the tropical heat.&nbsp;Vista Arrozal stands as one of the best <strong><a href=\"https://www.propnkey.com/holiday-home-in-goa/\">holiday home destinations in Goa</a></strong>, where you can escape the everyday and immerse yourself in a world of luxury, tranquility, and unforgettable experiences.</p>\r\n\r\n<p>At Vista Arrozal, nature and luxury converge to create an unparalleled living experience. It is here that you will find your personal sanctuary, where you can reconnect with yourself and revel in the beauty that surrounds you. Prepare to embark on a journey of <strong><a href=\"https://www.propnkey.com/goa-properties/\">luxury home</a></strong>, serenity, and self-discovery as you make Vista Arrozal your home in the heart of Goa.</p>\r\n', '', '', '', 'Vista Arrozal Candolim, Goa - 2, 3 & 4 BHK Apartments', 'Welcome to Conscient Vista Arrozal - a luxury living spaces in the heart of Candolim, Goa. Surrounded by lush paddy fields and set against the Nerul river.', '0', '0', '0', '0', '0', '', NULL, NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th>Config.</th>\r\n			<th>Total Area (in Sq.Ft.)</th>\r\n			<th>Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>2 BHK</td>\r\n			<td>1775 Sq.Ft.</td>\r\n			<td>₹3.67 Cr.*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK</td>\r\n			<td>2595</td>\r\n			<td>₹5.37 Cr.*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4 BHK</td>\r\n			<td>3445 Sq.Ft.</td>\r\n			<td>₹7.1 Cr.*</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(72, 0, 'Emaar Urban Oasis', 'emaar-urban-oasis-sector-62-gurgaon', NULL, 15, 1, 1, 1, NULL, 1, 1, 4.60, 70, '', 'Sector 62', '', '', 90, 90, 43000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2400, 'high', NULL, 'newly_launched', 0, '', '', '', '', '', 'Emaar Urban Oasis Sector 62, Gurgaon', 'The Urban Oasis Sector 62 offers luxurious living in the prime location of Gurgaon. Enquire for Best Offers & Site Visit.', '20', '10', '10', '5', '5', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12');
INSERT INTO `properties` (`id`, `is_featured`, `name`, `slug`, `alias_name`, `partner_id`, `agent_id`, `location_id`, `property_type_id`, `bedroom_option_id`, `property_category_id`, `property_condition_id`, `rating`, `review_count`, `badge`, `locality`, `address`, `rera_reg_no`, `sort_order`, `home_sort`, `price`, `monthly_rent`, `security_deposit`, `one_time_fees`, `total_payable`, `rent_includes`, `rent_excludes`, `rental_process`, `dos_donts`, `lock_in_period_days`, `notice_period_days`, `terms_conditions`, `is_rental`, `area_sq_ft`, `rise`, `possession`, `property_status`, `is_sold`, `amenities_description`, `property_description`, `gallery_description`, `floor_plan_description`, `offer_text`, `meta_title`, `meta_description`, `airport`, `entertainment`, `national_highway`, `hospitals`, `education`, `project_highlights_title`, `highlight_images`, `location_features`, `price_list`, `map_code`, `map_text`, `is_active`, `created_at`, `updated_at`) VALUES
(73, 0, 'M3M Crown', 'm3m-crown-sector-111-gurgaon', NULL, 1, 1, 1, 1, NULL, 1, 1, 4.60, 78, '', 'Sector 111 ', 'Dwarka Expressway', 'RC/REP/HARERA/GGM/687/419/2023/31', 90, 90, 23500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1605, 'high', NULL, 'newly_launched', 0, '', '<p>M3M Crown is a prestigious residential project brought to you by M3M, known for its commitment to luxury and excellence. Located in Sector 111, Dwarka Expressway, Gurgaon, this exclusive development offers an unmatched living experience that surpasses all expectations.</p>\r\n\r\n<p>Immerse yourself in a world where grandeur thrives and royalty prevails. M3M Crown caters to individuals with discerning tastes, ensuring an unforgettable impression that lasts a lifetime.</p>\r\n\r\n<p>With captivating views overlooking a meticulously maintained 2-acre lake, courtesy of M3M, every moment at M3M Crown is a visual delight. The grand lobby sets the tone for a regal entrance, making a statement that resonates with opulence.</p>\r\n\r\n<p>Step onto the spacious balconies and revel in breathtaking panoramas, allowing you to savor the stunning surroundings. Indulge in the royal treatment with an extravagant club that boasts a rooftop sitting area, providing the perfect spot to unwind and relax in style.</p>\r\n\r\n<p>M3M Crown transcends expectations with its array of modern sports and lifestyle amenities. Whether it&#39;s indulging in golf putting, bowling, squash, taking a refreshing dip in the swimming pool, or exploring the lawn tennis and cricket facilities, this development caters to every aspect of a luxurious lifestyle. Additional offerings include a Zen garden, yoga and meditation lawn, open gym, indoor gym, and much more.</p>\r\n\r\n<p>Choose from the meticulously designed 3 and 4 BHK luxury apartments that epitomize elegance and sophistication. M3M Crown showcases architectural brilliance, seamlessly blending comfort, opulence, and refined living.</p>\r\n\r\n<p>Discover the epitome of luxury living at M3M Crown, where every detail has been thoughtfully curated to provide you with a royal lifestyle unparalleled in its grandeur.</p>\r\n', '', '', '', 'M3M Crown Sector 111, Dwarka Expressway, Gurgaon', 'Luxury redefined at M3M Crown in Sector 111, Gurgaon. Royal-inspired residences with stunning views, lavish amenities, and unmatched grandeur.', '0', '0', '0', '0', '0', '', NULL, NULL, '<table class=\"table table-bordered text-center\">\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Type</th>\r\n			<th scope=\"col\">Area (in Sq.Ft)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>3 BHK</td>\r\n			<td>1605 Sq.Ft.</td>\r\n			<td>₹2.35 Cr*</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK + DECK</td>\r\n			<td>1665 Sq. Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK + STUDY</td>\r\n			<td>1825 Sq. Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK + STUDY With DECK</td>\r\n			<td>1895 Sq. Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>3 BHK + STUDY + UTILITY</td>\r\n			<td>2080 Sq. Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>3BHK + STUDY + UTILITY WITH DECK</td>\r\n			<td>2170 Sq. Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>4 BHK + UTILITY</td>\r\n			<td>2305 Sq. Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>4BHK + UTILITY WITH DECK</td>\r\n			<td>2400 Sq. Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>4BHK + STUDY + UTILITY</td>\r\n			<td>2570 Sq. Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>4BHK + STUDY+ UTILITY WITH DECK</td>\r\n			<td>2670 Sq. Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(74, 0, 'Purva Zenium', 'purva-zenium-hosahalli-bangalore', NULL, 17, 1, 9, 1, NULL, 1, 1, 4.70, 40, '', 'Hosahalli', 'International Airport Road', 'PRM/KA/RERA/1251/309/PR/190129/002311', 90, 90, 11600000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1314, 'high', NULL, 'newly_launched', 0, '', '<p>We at Puravankara take great pride in introducing our next-gen intelligent homes, &#39;Purva Zenium,&#39; located on the high-growth Bangalore International Airport Road corridor. Immerse yourself in a world where futuristic living meets unparalleled luxury.</p>\r\n\r\n<p>Our meticulously crafted <strong><a href=\"https://www.propnkey.com/apartments-in-bangalore/\">2 &amp; 3 BHK premium apartments</a></strong> redefine the art of contemporary living. With an ideal location on the Airport Corridor, enjoy seamless connectivity to Yelahanka &amp; KIADB within a 20-minute drive.</p>\r\n\r\n<p>Purva Zenium is more than just a residential project; it&#39;s a part of a sprawling 150-acre township that brings together <a href=\"https://www.propnkey.com/bangalore-properties/\">Premium Homes</a>, Retail, and Leisure. Embrace a life of convenience and leisure with 25+ lifestyle amenities, including a Swimming Pool, Amphitheatre, Tennis Court, and Party Hall.</p>\r\n\r\n<p>Experience the future of living with our revolutionary BluNex Technology, offering 15+ intelligent features that cater to your every need. From smart home solutions to cutting-edge security, we&#39;ve curated an environment that anticipates your desires.</p>\r\n\r\n<p>Step outside and relish 80% open spaces, thoughtfully designed and landscaped to perfection, providing an oasis of tranquility amidst the city&#39;s hustle and bustle.</p>\r\n\r\n<p>At Purva Zenium, we&#39;ve envisioned a lifestyle that embraces modernity and luxury in perfect harmony. Welcome to a world of intelligent living where every aspect of your life is elevated to a whole new level. Embrace the future at <a href=\"https://www.propnkey.com/property/purva-zenium-hosahalli-bangalore/\">Purva Zenium,&nbsp;Hosahalli, Bangaluru</a> your haven of sophistication and comfort.</p>\r\n', '', '', '', 'Purva Zenium Hosahalli, Bangalore', ' Experience luxury living at Purva Zenium, Hosahalli the next-gen intelligent homes on Bangalore International Airport Road corridor.', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(75, 0, 'Purva Meraki', 'purva-meraki-hsr-layout-bangalore', NULL, 17, 1, 9, 1, NULL, 1, 1, 4.90, 78, '', 'HSR Layout', '', 'PRM/KA/RERA/1251/310/PR/071022/005307', 90, 90, 36500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2519, 'high', NULL, 'newly_launched', 0, 'Your dream home comes with world-class amenities.', '<p>Introducing Purva Meraki, the epitome of luxury living in Bangalore! Nestled at the heart of HSR Layout, near Sarjapur Road, this exquisite Lakeview residential apartment project promises an enchanting lifestyle. Immerse yourself in the picturesque views of the serene lake, as each residence is meticulously designed to offer unmatched comfort and elegance. Embrace a world of opulence and tranquility in your dream home at Purva Meraki, where every moment is a celebration of refined living. Explore the pinnacle of modern living and indulge in the finest amenities in this exclusive South East Bangalore address.</p>\r\n\r\n<p>Experience <strong>unparalleled passion and unmatched results</strong> in 44 limited edition 3 &amp; 4 BHK palatial homes starting at <strong>just 3.83 Cr*</strong>. Nestled in HSR Layout, South East Bengaluru, this iconic landmark showcases the zenith of fine living.</p>\r\n\r\n<p>Indulge in sheer spatial extravagance with each residence, meticulously built upon your aspirations and choices. Discover the epitome of luxury living with modern amenities and a vibrant neighborhood.</p>\r\n\r\n<p>Embrace a lifestyle of opulence and refinement in your dream home at Purva Meraki. Welcome to a world where fine living meets unmatched craftsmanship. Explore your perfect home now.</p>\r\n', '', '', '', 'Purva Meraki, HSR Layout, Bangalore | Check Price, Floor Plan', 'Purva Meraki is located in the heart of the Bangalore at HSR Layout next to Ishaa Lake Front in South East Bengaluru. Book Free Site Visit Today!', '45', '10', '15', '10', '10', '', NULL, NULL, '<table class=\"table table-bordered text-center\">\r\n	<tbody class=\"thead-dark\">\r\n		<tr>\r\n			<th>Configuration Type</th>\r\n			<th>Super Build-Up Area</th>\r\n			<th>Price</th>\r\n		</tr>\r\n		<tr>\r\n			<td>Purva Meraki 3 BHK</td>\r\n			<td>2519 - 2770 Sq.ft</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">On Request</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Purva Meraki 4 BHK</td>\r\n			<td>3745 Sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">On Request</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(76, 0, 'Prestige Park Grove', 'prestige-park-grove-whitefield-bangalore', NULL, 15, 1, 9, 1, NULL, 1, 1, 4.50, 80, '', 'Whitefield', 'Kadugudi Main Road', '', 90, 90, 10000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1173, 'high', NULL, 'newly_launched', 0, '', '<p>Discover the essence of refined living at Prestige Park Grove, nestled in the vibrant enclave of Whitefield, Bangalore. Spanning an impressive 75 acres of prime land, this visionary residential project embodies innovation and opulence. Offering thoughtfully designed apartments and villas that blend seamlessly with the lush surroundings, residents are treated to an exceptional living experience. Welcome to a world of sophistication and luxury at <strong>Prestige Park Grove</strong>, where your dreams of an elevated lifestyle come to life.</p>\r\n\r\n<p><strong>Prestige Park Grove Apartments and Villas</strong>, located in Kadugodi, Whitefield, Bangalore, offer an idyllic residential experience. Spread across 75&nbsp;acres of lush landscape, the township&#39;s name &quot;Park Grove&quot; perfectly complements its surroundings. Meticulously planned by Prestige Construction, this residential hideaway promises a life of serenity and sophistication. Embrace luxury and nature in perfect harmony at Prestige Park Grove.</p>\r\n', '', '', 'Pay as low as 7 Lakhs to Book your Dream home. Limited time offer!', 'Prestige Park Grove, Whitefield, Bangalore - Check Price & Pre-Launch Offer', 'Unveiling Prestige Park Grove, Whitefield, Bangalore – Your gateway to sophisticated living amidst nature\'s embrace. Don\'t miss the exclusive Pre-Launch Offer!', '40', '10', '10', '10', '10', '', NULL, NULL, '<table class=\"table table-bordered text-center\">\r\n	<tbody class=\"thead-dark\">\r\n		<tr>\r\n			<th>Type</th>\r\n			<th>Area</th>\r\n			<th>Price</th>\r\n		</tr>\r\n		<tr>\r\n			<td>Prestige Park Grove 1 BHK</td>\r\n			<td>680 Sq.ft</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Prestige Park Grove 2 BHK</td>\r\n			<td>1173 Sq.ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Prestige Park Grove 3 BHK - C</td>\r\n			<td>1459 Sq.ft</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Prestige Park Grove 3 BHK - R</td>\r\n			<td>1837 Sq.ft</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Prestige Park Grove 3 BHK - L</td>\r\n			<td>2133 Sq.ft</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Prestige Park Grove 4 BHK - R</td>\r\n			<td>2750 Sq.ft</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Prestige Park Grove 4 BHK - L</td>\r\n			<td>3773 Sq.ft</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Prestige Park Grove - Villa</td>\r\n			<td>3900 Sq.ft</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Know price</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(77, 1, 'SOBHA Manhattan Towers', 'sobha-manhattan-towers-townpark-bangalore', NULL, 15, 1, 9, 1, NULL, 1, 1, 4.60, 75, '', 'Townpark', 'Near Electronic City', 'PRM/KA/RERA/1251/308/PR/210518/004150', 90, 90, 15600000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1498, 'high', NULL, 'newly_launched', 0, '', '', '', '', '', 'Sobha Manhattan Towers Town Park, Bangalore | Price, Reviews, Floor Plan', 'Sobha Manhattan Towers Town Park is an new launch residential township near Electronic City, Bengaluru. Schedule free site visit today!', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(78, 0, 'M3M Altitude', 'm3m-altitude-sector-65-gurgaon', NULL, 1, 1, 1, 1, NULL, 1, 1, 4.60, 43, '', 'Sector 65', '', 'RC/REP/HARERA/GGM/821/553/2024/48', 90, 90, 98000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3755, 'high', NULL, 'newly_launched', 0, '', '<p>M3M Altitude, a luxurious residential project by M3M Group, is coming soon to Sector 65, Gurgaon. This project is offering 2 BHK, 3 BHK, and 4-BHK luxurious apartments, offering an experience of unparalleled luxury and comfort. Spacious layouts and elegant interiors create a haven of tranquility, perfect for unwinding after a long day.</p>\r\n\r\n<p>Residents of M3M Altitude will enjoy a plethora of modern amenities for a truly enriching lifestyle. M3M Altitude offers not just homes but an experience of elevated living.</p>\r\n\r\n<p><strong>Prime Location:</strong> Situated next to the Golf Course Road Extension, M3M Altitude enjoys proximity to iconic luxury projects like Trump Towers and M3M Golfestate, as well as international schools, top-notch retail options, and fantastic dining spots.</p>\r\n\r\n<p><strong>Modern Engineering Marvel:</strong> Our state-of-the-art living spaces are designed to offer a world-class experience. With exceptional architecture and hotel-style services, M3M Altitude is the ultimate urban resort.</p>\r\n\r\n<p><strong>Unique Design:</strong> Our building&#39;s facade is a testament to luxury and sophistication. Every unit provides an outdoor view, and our innovative 4-to-a-core cluster design ensures that corner units offer a two-sided outdoor experience, maximizing natural light and ventilation.</p>\r\n\r\n<p>Experience luxury living like never before at M3M Altitude, where every aspect is crafted to enhance your lifestyle. Book your dream home today and elevate your living experience!</p>\r\n', '', '', 'Special 20:80 Payment Plan!', 'M3M Altitude Sector 65, Gurgaon', 'Find your dream home at M3M Altitude in Sector 65, Gurgaon. Enjoy luxurious living with modern amenities and stunning views. Book now for the ultimate urban lifestyle experience!', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(79, 0, '4 BHK Vianaar Standalone Luxury Indo Portuguese Villa', '4-bhk-vianaar-standalone-luxury-indo-portuguese-villa-badem-assagaon-goa', NULL, 15, 1, 5, 3, NULL, 1, 1, 4.80, 52, '', 'Badem-Assagaon', '', '', 90, 90, 120000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3500, 'low', NULL, 'newly_launched', 0, '', '<p>Located in the peaceful village of Badem in the Assagaon area of Goa, this 4BHK villa property sits in one of the most beautiful and serene parts of the region. Assagaon is often called the &quot;Beverly Hills of Goa&quot; because of its upscale homes and tranquil atmosphere. It&#39;s a perfect mix of the calm Goan village life and the convenience of being close to the lively beaches and markets. The area is rich in culture and history, making it an ideal spot for a dream home.</p>\r\n\r\n<p><strong>Luxurious 4 BHK Villa</strong><br />\r\nThis impressive 4 BHK villa offers a built-up area of 3500 sq. ft. on a plot of 425 sq. meters. Priced at 12 Crore, the villa is designed for those who appreciate luxury and comfort.</p>\r\n\r\n<p><strong>Spacious Interiors:</strong> The villa has four large bedrooms, each providing plenty of space and privacy.</p>\r\n\r\n<p><strong>Modern Kitchen:</strong> The stylish kitchen comes with modern appliances and a sleek design, perfect for anyone who loves to cook.</p>\r\n\r\n<p><strong>Swimming Pool:</strong> Enjoy your own private swimming pool, perfect for relaxation and fun.</p>\r\n\r\n<p><strong>Parking Lawn: </strong>There&rsquo;s a well-kept lawn for parking, ensuring secure and convenient space for multiple vehicles.</p>\r\n\r\n<p><strong>Large Living Areas:</strong> The villa includes big living and dining areas, great for entertaining guests and family gatherings.</p>\r\n\r\n<p><strong>Luxurious Bathrooms:</strong> Each bathroom is equipped with high-end fixtures, offering a spa-like feel.</p>\r\n\r\n<p><strong>Beautiful Gardens:</strong> Surrounded by lush greenery and lovely landscaped gardens, the villa provides a peaceful and picturesque environment.</p>\r\n\r\n<p>This 4 BHK villa in Badem - Assagaon is not just a house, but a luxurious and sophisticated home. Whether you&rsquo;re looking for a permanent residence or a vacation home, this villa offers elegance, comfort, and exclusivity. Experience the best of Goan lifestyle in this stunning villa, where every detail is designed for premium living.</p>\r\n', '', '', '', '4 BHK Vianaar Standalone Luxury Indo Portuguese Villa Available for Sale', '4 BHK Vianaar Standalone Luxury Indo Portuguese Villa Available for Sale In Badem Assagaon, Goa', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(80, 0, 'DLF Privana South', 'dlf-privana-south-sector-77-gurgaon', NULL, 4, 1, 1, 1, NULL, 1, 1, 4.80, 43, '', 'Sector 77', '', 'RC/REP/HARERA/GGM/772/504/2023/116', 90, 90, 60000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3577, 'high', NULL, 'newly_launched', 0, '', '<p>DLF Privana South, a prestigious new launch by DLF, is strategically located in Sector 76 &amp; 77, Gurgaon, offering an unparalleled living experience. Imagine living in one of the seven stunning towers that rise gracefully above the city, with the beautiful Aravalli mountain range as your backdrop.</p>\r\n\r\n<p>Privana South is all about luxury and comfort. There are 1,113 apartments in total, with each tower featuring two gorgeous penthouses on the top. Below them, each floor has just four spacious and luxurious apartments, ensuring plenty of privacy and space for everyone.</p>\r\n\r\n<p>The 4 BHK apartments and penthouses range from 3,577 to 5,500 square feet, offering plenty of room for your family. Each home also includes a study and a servant room, adding to the convenience and comfort. The thoughtful design and spacious layout make these homes perfect for those who love an urban lifestyle but also crave the peace and beauty of nature.</p>\r\n\r\n<p>Living at Privana South means becoming part of a vibrant and like-minded community. You&#39;ll enjoy spectacular views and world-class amenities that make life here truly special. This project isn&#39;t just about providing a home; it&#39;s about offering a complete living experience where every detail is designed to meet your needs and desires.</p>\r\n\r\n<p>DLF Privana South promises a luxurious, comfortable, and convenient lifestyle. It&#39;s a place where the price is justified by the quality and size of the homes, offering true value. This project is set to redefine luxury living in Gurgaon, and we can&#39;t wait for you to be a part of it.</p>\r\n', '', '', '', 'DLF Privana South, Sector 76 & 77, Gurgaon', 'Discover DLF Privana South in Sector 76 & 77, Gurgaon. Luxurious 4 BHK apartments and penthouses ranging from 3,577 to 5,500 sq. ft., offering stunning views of the Aravalli mountain range.', '20', '10', '10', '10', '10', '<p><strong>Prime Location:</strong> Situated in Sector 76 &amp; 77, Gurgaon, offering easy access to major city hubs.<br />\r\n<strong>Majestic Towers:</strong> 7 Stunning towers rising above the city with beautiful views of the Aravalli mountain range.<br />\r\n<strong>Limited Apartments:</strong> Only 1,113 apartments, ensuring exclusivity and privacy.<br />\r\n<strong>Spacious Living:</strong> 4 BHK apartments and penthouses ranging from 3,577 to 5,500 sq. ft.<br />\r\n<strong>Thoughtful Design:</strong> Each unit includes a study and a servant room for added convenience.<br />\r\n<strong>Luxury and Comfort:</strong> High-end finishes and amenities designed for a luxurious lifestyle.<br />\r\n<strong>Spectacular Views:</strong> Enjoy panoramic views of the lush greenery and the city skyline.<br />\r\n<strong>World-Class Amenities:</strong> Access to top-notch facilities and services for a complete living experience.</p>\r\n', '\"properties/highlights/highlight_dlf-privana-south-sector-77-gurgaon_1759292258.jpg\"', NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(81, 0, 'DLF Privana West', 'dlf-privana-west-sector-76-gurgaon', NULL, 4, 1, 1, 1, NULL, 1, 1, 4.50, 67, '', 'Sector 76', '', 'HARERA/GGM/819/551/2024/46', 90, 90, 65000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3500, 'high', NULL, 'newly_launched', 0, '', '<p>Step into the epitome of luxury living at DLF Privana West, a stunning new development in Sector 76, Gurugram. This exclusive residential project covers 15 acres with 85% dedicated to lush green spaces, providing residents with a tranquil and refreshing environment. The breathtaking views of the Aravalli mountain range, combined with world-class design by HB Design (Singapore) and Thornton Tomasetti (New York), make DLF Privana West a truly unique and desirable place to call home. Each spacious 4 BHK apartment includes 3 car parks, while the luxurious penthouses offer 4 car parks, ensuring ample space for your vehicles.</p>\r\n\r\n<p>DLF Privana West is designed to offer a lifestyle of luxury and comfort, with meticulous attention to detail evident in every aspect of the development. The impressive 11.2 feet floor-to-ceiling height in each apartment enhances the sense of space and light, creating an airy and inviting atmosphere. The tower lobbies, designed by Blink Thailand, exude elegance and sophistication, welcoming residents and guests alike into a world of refined living. This residential community is more than just a place to live; it is a sanctuary where you can relax and rejuvenate amidst beautiful green surroundings.</p>\r\n\r\n<p>Discover a new standard of living at DLF Privana West, where luxury meets convenience in the heart of Gurugram. With 800 opulent apartments across five iconic towers, this is your chance to be part of an exclusive and vibrant community. The expansive green spaces and stunning views provide a serene backdrop for your everyday life, while the thoughtfully designed amenities cater to your every need. Don&#39;t miss the opportunity to experience the best of luxury living in one of Gurugram&#39;s most sought-after locations.</p>\r\n', '', '', '', 'DLF Privana West Sector 76, Gurugram ', 'DLF Privana West, where luxury meets comfort in the heart of Sector 76, Gurgaon. ', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(82, 0, 'DLF Villas Reis Magos', 'dlf-villas-reis-magos-reis-magos-goa', NULL, 4, 1, 5, 3, NULL, 1, 1, 4.70, 68, '', 'Reis Magos', '', '', 90, 90, 400000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 9500, 'low', NULL, 'newly_launched', 0, '', '<p>DLF Villas in Reis Magos, Goa, represents the pinnacle of luxury living, nestled atop a scenic hill having mesmerizing views of the Arabian Sea. This exclusive residential project spans 38 across acres and features 62 meticulously designed villas, each offering breathtaking views and unparalleled privacy.</p>\r\n\r\n<p><strong>About Reis Magos, Goa</strong><br />\r\nReis Magos is a charming location in North Goa, known for its historical significance and serene beauty. Home to the iconic Reis Magos Fort and Church, this area combines the rich cultural heritage of Goa with modern amenities and scenic landscapes. Overlooking the Mandovi River, Reis Magos offers a tranquil and picturesque environment, making it a coveted destination for luxury living.</p>\r\n\r\n<p><strong>Project Features and Sizes</strong></p>\r\n\r\n<ul>\r\n	<li>950 sq. mts (10,225 sq. ft) Carpet Area: Villas with this plot size feature multi-utility spaces that can be customized to suit your lifestyle needs.</li>\r\n	<li>1500 sq. mts (16,145 sq. ft) Carpet Area: These spacious villas come with three multi-utility spaces, offering ample room for personalization.</li>\r\n</ul>\r\n\r\n<p><strong>Frontage and Amenities:</strong></p>\r\n\r\n<ul>\r\n	<li>Each villa boasts a wide 38-meter frontage, providing space for lush gardens, infinity pools, and stylish bars, perfect for entertaining and relaxation.</li>\r\n	<li>Designed for privacy, each villa ensures a secluded living experience, ideal for those seeking tranquility.</li>\r\n</ul>\r\n\r\n<p><strong>Architecture and Layout:</strong></p>\r\n\r\n<p>The villas are structured as G+2, offering ample living space across three levels. Each villa is a 5 BHK unit, fully furnished with high-end finishes and state-of-the-art amenities, epitomizing luxury and comfort.</p>\r\n\r\n<p>DLF Villas Reis Magos in Goa combines elegant design with superior functionality, offering residents a unique blend of opulence and convenience in one of Goa&rsquo;s most desirable locations.</p>\r\n', '', '', '', 'DLF Villas Reis Magos Goa | Sea View Villa in Goa ', 'Luxury sea-views facing Villas by DLF for sale in Reis Magos, Goa. Offering world-class amenities, and elegant designs for your dream seaside retreat. Book your visit today!', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(83, 1, 'Tarc Ishva', 'tarc-ishva-sector-63a-gurgaon', NULL, 15, 1, 1, 1, NULL, 1, 1, 4.80, 46, '', 'Sector 63A', '', 'RC/REP/HARERA/GGM/865/597/2024/92', 90, 90, 58000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, 'high', NULL, 'newly_launched', 0, '', '<p>Welcome to Tarc Ishva, where luxury meets comfort in the heart of Sector 63A, Gurugram. These meticulously designed 3 &amp; 4 BHK apartments offer an unparalleled lifestyle starting at just ₹5.84 Crore*. Embrace the finest in modern living, with every amenity you could wish for at your fingertips.</p>\r\n\r\n<p>Nestled behind DLF Arbour, Tarc Ishva boasts stunning panoramic views of the Aravalli hills, set amidst lush green landscapes. With spacious, efficient layouts and first-ever four-side open apartments, this is truly a rare opportunity to own a luxurious home in one of Gurugram&#39;s most coveted locations.</p>\r\n', '', '', '', 'Tarc Ishva Sector 63A Gurgaon | 4 Side Open Luxury Apartments', 'Experience a True Peaceful Heaven with Luxurious World Class Amenities at Tarc Ishva, Sector 63A, Gurgaon. Presenting Luxurious 3 & 4 BHK Apartments in Gurgaon - Enquire Now to Know More.', '20', '10', '10', '10', '10', '<ul>\r\n	<li>Located just behind DLF Arbour, Tarc Ishva offers the perfect blend of prime positioning and serene surroundings.</li>\r\n	<li>Enjoy sweeping, panoramic views of the Aravalli hills, adding a natural touch to your luxurious lifestyle.</li>\r\n	<li>A first-of-its-kind development featuring true four-side open apartments for enhanced ventilation and privacy.</li>\r\n	<li>Indulge in world-class amenities spread across 1.15 lac square feet, providing everything you need under one roof.</li>\r\n	<li>The grand 45,000 sq.ft. clubhouse is the perfect place to unwind and socialize with friends and family.</li>\r\n	<li>Surround yourself with lush, beautifully maintained green landscapes that bring nature right to your doorstep.</li>\r\n	<li>The project features an eco-friendly rainwater harvesting system, promoting sustainability and water conservation.</li>\r\n	<li>Spread over 7 acres of prime land, Tarc Ishva offers a gated community of 5 towers housing 400 exclusive units.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_tarc-ishva-sector-63a-gurgaon_1759292259.jpg\"', NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(84, 0, 'Silverglades - The Legacy', 'silverglades-the-legacy-sector-63a-gurgaon', NULL, 9, 1, 1, 1, NULL, 1, 1, 4.80, 90, '', 'Sector 63A', 'Golf Course Ext Road', '', 90, 90, 60000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2800, 'high', NULL, 'newly_launched', 0, '', '<p>Silverglades Legacy 63A redefines luxury living with its upcoming launch of spacious 3 BHK and 4 BHK apartments and penthouses on Golf Course Extension Road, Gurugram. Offering generous layouts of approximately 2800 to 3800 sq.ft., these residences are designed to provide a harmonious blend of opulence and functionality. With starting prices from ₹5.5 Crore*, Silverglades Legacy 63A offers a rare investment opportunity in a high-end residential project that promises unmatched comfort and timeless elegance.</p>\r\n\r\n<p>This exclusive development features 450 units with world-class amenities, including a swimming pool, gym, and clubhouse, all within a peaceful and secure environment. The project&#39;s strategic location ensures proximity to essential conveniences such as schools, hospitals, and supermarkets, while its gated community with security offers a sense of privacy and peace of mind.</p>\r\n', '', '', '', 'Silverglades - The Legacy, Sector 63 Gurgaon', 'Discover Silverglades Legacy 63A, offering luxurious 3 BHK and 4 BHK apartments with spacious layouts of approximately 2800 sq.ft. and 3800 sq.ft.', '25', '10', '10', '10', '10', '<ul>\r\n	<li>Thoughtfully designed 3 BHK and 4 BHK apartments, including family lounges, utility rooms, and powder rooms for added convenience.</li>\r\n	<li>A high-end residential project with 450 spacious units, ensuring ample space for luxurious living.</li>\r\n	<li>Apartments and penthouses range from an estimated 2800 sq.ft. to 3800 sq.ft., offering generous layouts and high-quality construction.</li>\r\n	<li>The project is located on the prestigious Golf Course Extension Road, a prime area in Gurugram.</li>\r\n	<li>World-class amenities, including a swimming pool, gym, and clubhouse, promote recreation and socialization among residents.</li>\r\n	<li>Gated community with 24/7 security ensures privacy and safety for all residents.</li>\r\n	<li>Proximity to major connectivities, including schools, hospitals, and supermarkets, enhances daily convenience.</li>\r\n	<li>Silverglades Legacy 63A promises high returns on investment, making it a great opportunity for those seeking ultra-luxury residences in Gurugram.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_silverglades-the-legacy-sector-63a-gurgaon_1759292260.jpg\"', NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04'),
(85, 0, '3 BHK Field View Villa in Morjim', '3-bhk-field-view-villa-in-morjim-morjim-goa', NULL, 15, 1, 5, 3, NULL, 1, 1, 4.50, 67, '', 'Morjim', '', '', 90, 90, 65000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 'low', NULL, 'newly_launched', 0, '', '<p>Discover the perfect blend of luxury and serenity with this stunning 3 BHK field view villa in the heart of Morjim, Goa. Designed to offer an unparalleled living experience, this villa boasts spacious interiors, modern amenities, and breathtaking views of lush green fields. Whether you&rsquo;re looking for a peaceful retreat or a place to entertain, this villa provides a sanctuary of comfort and elegance, all set against the backdrop of Goa&#39;s natural beauty.</p>\r\n\r\n<p><strong>Prime Location and Investment Opportunity</strong></p>\r\n\r\n<p>Morjim is rapidly becoming one of the most sought-after locations in Goa, thanks to its picturesque surroundings and tranquil lifestyle. Known for its pristine beaches, vibrant culture, and relaxed atmosphere, Morjim offers a unique opportunity to own property in an area where land prices are rising daily. As demand continues to grow, investing in a villa here not only provides an exceptional living experience but also promises high returns on investment, making it a smart choice for buyers looking to secure a prime piece of real estate in Goa&rsquo;s booming property market.</p>\r\n', '', '', '', '3 BHK Field View Villa for Sale in Morjim, Goa', 'Experience luxury living in a 3 BHK field view villa in Morjim, Goa. Nestled in one of the most sought-after locations, this villa offers serene views and a prime investment opportunity as land prices', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(86, 0, '4 BHK Fully Furnished Villa', '4-bhk-fully-furnished-villa-in-mandrem-goa', NULL, 15, 1, 5, 3, NULL, 1, 1, 4.70, 76, '', 'Mandrem', '', '', 90, 90, 75000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4000, 'low', NULL, 'newly_launched', 0, '', '<p>This elegant 4 BHK villa in the scenic area of Mandrem, Goa, offers an unparalleled luxury living experience. Spread across a plot area of 462 square yards with a super built-up area of 4000 sq.ft., the villa features 4 spacious bedrooms, each with attached bathrooms, and is fully furnished for immediate occupancy. The property also includes a large living room, dining area, modern kitchen, and a powder toilet, providing comfort and convenience for the entire family. With a private swimming pool and ample car parking space, this villa is perfect for those seeking a blend of luxury and relaxation.</p>\r\n\r\n<p>Located in the tranquil and picturesque area of Mandrem, this villa is priced at ₹7.50 crore, offering a great investment opportunity in one of Goa&#39;s most desirable neighborhoods. Mandrem&#39;s peaceful beaches and lush greenery make it an ideal location for both holiday homes and permanent residences. As property values continue to rise in this area, investing in this luxurious villa promises not only an exquisite living experience but also significant appreciation over time.</p>\r\n', '', '', '', 'Luxurious 4 BHK Villa with Private Pool in Mandrem, Goa', 'Explore this fully furnished 4 BHK villa in Mandrem, Goa, featuring a private swimming pool, 4000 sq.ft. of luxury living space, and top-notch amenities. ', '0', '0', '0', '0', '0', '', NULL, NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(87, 1, 'DLF The Dahlias', 'dlf-the-dahlias-sector-54-gurgaon', NULL, 4, 1, 1, 1, NULL, 1, 1, 4.70, 88, '', 'Sector 54', 'Golf Course Road Gurgaon', '', 90, 90, 650000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 10, 'high', NULL, 'newly_launched', 0, 'The DLF Dahlias amenities include a 2-million sq. ft. clubhouse, infinity pool, tennis courts, and landscaped gardens, designed for a luxurious lifestyle for its residents. The project also features landscaped gardens, a private spa, and a state-of-the-art gym, making the DLF Dahlias a perfect blend of comfort and exclusivity in Gurgaon.', '<p>Strategically located in Sector 54, Gurgaon, on the prestigious Golf Course Road, <strong>DLF The Dahlias</strong> is an ultra-luxury residential project that promises an elite living experience. Spread across 17 acres and features <strong>420 ultra-luxury residences</strong>. The <strong>prices of DLF Dahlias Gurgaon</strong> start from ₹65 crore for units measuring 10,300 sq. ft. and go beyond ₹100 crore for the expansive 12,000 sq. ft. penthouses, making it one of India&#39;s costliest real estate ventures.&nbsp;The project is designed to cater to high-net-worth individuals with its exclusive amenities, world-class infrastructure, and unmatched connectivity to prime locations. Its proximity to the Sector 54 Chowk Metro Station, NH-48, and prominent hubs like DLF Cyber City ensures seamless accessibility.&nbsp;</p>\r\n\r\n<p><strong>Project Highlights</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Architecture &amp; Layout</strong>: Nine meticulously designed towers offer panoramic views of the Aravallis or the man-made 50-acre lake.</li>\r\n	<li><strong>Exclusive Residences</strong>: Apartments feature floor-to-ceiling heights of 4 meters and 17-foot-wide balcony decks.</li>\r\n</ul>\r\n\r\n<p><strong>Residential Configurations</strong></p>\r\n\r\n<p>The project offers 420 meticulously designed residences across nine towers with panoramic views of the Aravallis or the pristine man-made 50-acre lake. The details are as follows:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><strong>Lake-Facing Towers (1A/B - 5A/B):</strong></p>\r\n\r\n	<ul>\r\n		<li><strong>Unit Size:</strong> 10,300 to 12,000 sq. ft.</li>\r\n		<li><strong>Pricing:</strong> Starts from ₹70 crore for lower floors and goes up to ₹100 crore for penthouses.</li>\r\n	</ul>\r\n	</li>\r\n	<li>\r\n	<p><strong>Aravalli-Facing Towers (6A/B - 8A/B):</strong></p>\r\n\r\n	<ul>\r\n		<li><strong>Unit Size:</strong> 9,600 sq. ft.</li>\r\n		<li><strong>Pricing:</strong> Starts from ₹65 crore onwards.</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n\r\n<p>Key architectural features include a 4-meter floor-to-ceiling height and expansive 17-foot balcony decks, enhancing the sense of grandeur and openness.</p>\r\n\r\n<p><strong>World-Class Amenities</strong><br />\r\nDLF The Dahlias sets itself apart with its luxurious offerings, designed for those who seek the extraordinary:</p>\r\n\r\n<ul>\r\n	<li><strong>Iconic Clubhouse</strong>: A sprawling 2 million sq. ft. space with top-notch recreational and wellness facilities.</li>\r\n	<li><strong>Man-Made Lake</strong>: A serene 50-acre water body that adds to the project&rsquo;s exclusivity.</li>\r\n	<li><strong>Recreation</strong>: Private golf course access, landscaped gardens, and jogging tracks.</li>\r\n	<li><strong>Luxury Services</strong>: Concierge facilities, private lounges, and valet services ensure a seamless lifestyle experience.</li>\r\n	<li><strong>Fitness &amp; Wellness</strong>: State-of-the-art gym, swimming pools, yoga rooms, and spa facilities.</li>\r\n</ul>\r\n\r\n<p><strong>Connectivity and Nearby Essentials</strong><br />\r\nThe location adds to the project&rsquo;s allure, offering proximity to key lifestyle and infrastructure landmarks:</p>\r\n\r\n<ul>\r\n	<li><strong>Schools</strong>: The Shri Ram School and DPS International within 3 km.</li>\r\n	<li><strong>Hospitals</strong>: Fortis Memorial Research Institute (2 km) and Medanta (5 km).</li>\r\n	<li><strong>Retail &amp; Dining</strong>: DLF CyberHub and Ambience Mall within 7 km.</li>\r\n	<li><strong>Recreation</strong>: Adjacent to the DLF Golf &amp; Country Club and close to Aravalli Biodiversity Park.</li>\r\n</ul>\r\n', 'The DLF Dahlias Gurgaon image gallery showcases the epitome of ultra-luxury living in Golf Course Road, Gurgaon. Each visual highlights the grandeur of this prestigious project, from its sprawling 17-acre layout and panoramic Aravali views to the 50-acre man-made lake and meticulously designed 420 exclusive residences. The gallery captures the essence of the DLF Dahlias, featuring stunning interiors with 4-meter ceiling heights, expansive 17-foot balconies, and world-class amenities like the 2-million sq. ft. clubhouse, landscaped gardens, and infinity pools.', '', '', 'DLF The Dahlias Sector 54, Gurgaon | DLF Dahlias Golf Course Road | Ultra Luxury Penthouses', 'DLF The Dahlias, an ultra-luxury residential masterpiece in Sector 54, Golf Course Road, Gurgaon. Experience opulent living in one of India\'s most prestigious and exclusive properties.', '30', '10', '10', '5', '5', '', NULL, NULL, '<p><strong>DLF The Dahlias, Golf Course Road, Gurgaon</strong> offers ultra-luxury apartments with prices starting at ₹65 crore for Aravali-facing units and ₹70 crore for lake-facing homes. Apartment sizes range from 9,600 sq. ft. to 12,000 sq. ft., with premium features like 4-meter ceilings and 17-foot balconies. Check detailed <strong>DLF Dahlias&nbsp;pricing</strong> for each configuration.</p>\r\n\r\n<table class=\"table table-bordered text-center\">\r\n	<tbody>\r\n	</tbody>\r\n	<thead class=\"thead-dark\">\r\n		<tr>\r\n			<th scope=\"col\">Configuration Type</th>\r\n			<th scope=\"col\">Area (in SQ.YD.)</th>\r\n			<th scope=\"col\">Price</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>TOWER 1A,B-5A,B (G+29) - NORTH FACING (LAKE)</td>\r\n			<td>10,300 Sq.Ft.</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Request Best Price &amp; Offer</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>TOWER 1A,B - 5A,B (G+29) - NORTH FACING (LAKE)</td>\r\n			<td>12,000 Sq.Ft</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Request Best Price &amp; Offer</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>TOWER 6A,B - 8A,B (ARAVALI FACING)</td>\r\n			<td>9600 Sq.Ft</td>\r\n			<td><a data-bs-target=\"#popup-form\" data-bs-toggle=\"modal\" href=\"#\">Request Best Price &amp; Offer</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 13:52:12'),
(88, 1, 'Trump Towers 2', 'trump-towers-2-sector-69-gurgaon', NULL, 15, 1, 1, 2, NULL, 1, 1, 4.50, 71, '', 'Sector 69', 'SPR Road', '', 90, 90, 79900000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3100, 'high', NULL, 'newly_launched', 0, 'Trump Tower 2 is designed to deliver not just a home but an all-encompassing luxury lifestyle. Every amenity has been carefully curated to ensure comfort, convenience, and sophistication, elevating daily living into an extraordinary experience. Trump Tower 2’s amenities redefine the concept of luxury, providing spaces that blend functionality with elegance. Every aspect is meticulously planned to ensure that your experience as a resident is truly exceptional.', '<p><strong>Discover Exclusive Living at Trump Tower 2, Gurgaon</strong></p>\r\n\r\n<p>Trump Towers 2 in Sector 69, Gurgaon offers ultra-luxurious 3.5 &amp; 4.5 BHK apartments with modern amenities, unmatched elegance, and a premium residential development by Tribeca Creators LLP. Combining modern architecture with thoughtfully designed interiors, this project offers a lifestyle that&rsquo;s both elegant and practical.</p>\r\n\r\n<p><strong>Residences That Reflect Your Taste</strong></p>\r\n\r\n<p>Trump Tower 2 features spacious 3 and 4 BHK homes ranging from 3,100 to 5,000 sq. ft. Each residence is carefully designed to balance comfort with style, incorporating interiors by renowned Italian designer Matteo Nunziati. These homes are crafted to suit those who appreciate attention to detail and timeless design.</p>\r\n\r\n<p><strong>Built on a Foundation of Excellence</strong></p>\r\n\r\n<p>Known globally for their expertise in luxury developments, Trump Tower 2 assures high construction standards. Additionally, residents will have access to personalized services through the Trump White Glove experience, ensuring convenience and care at every step.</p>\r\n\r\n<p><strong>Perfectly Connected, Yet Serene</strong></p>\r\n\r\n<p>Situated in Sector 69, the project enjoys proximity to upcoming <strong>DLF Phase 6 and the new Cyber city 2 on SPR</strong>&nbsp;and key business hubs, premium hotels, and vibrant marketplaces. The location ensures easy connectivity while providing a peaceful retreat from the hustle of city life.</p>\r\n\r\n<p><strong>Pricing and Availability</strong></p>\r\n\r\n<p>The starting price for a 3 BHK apartment at Trump Tower 2 is ₹7.99 Cr.*</p>\r\n\r\n<p>Discover the difference of living in a thoughtfully designed space that combines luxury with practicality. Contact us today for more information or to schedule a private viewing.</p>\r\n', 'Explore the stunning architecture, elegant interiors, and thoughtfully designed spaces that define these luxury residences. From the striking all-glass facade to the double-height living rooms, every detail is captured to give you a glimpse of the lifestyle awaiting you.', '', 'Special 30:70 Payment Plan & No EMI Option! Booking starts from 45 Lakhs. ', 'Trump Towers 2 Sector 69, SPR Road Gurgaon ', 'Trump Tower 2 in Sector 69, Gurgaon – ultra-luxury 3 & 4 BHK residences with Italian interiors by Matteo Nunziati, iconic architecture, premium amenities, and seamless connectivity. Starting at ₹7.5 C', '30', '10', '10', '10', '5', '<p>Why Choose Trump Tower 2?</p>\r\n\r\n<ul>\r\n	<li><strong>Prime Location:</strong> Strategically located in Sector 69, Gurgaon, near Vatika Chowk, offering excellent connectivity to major hubs.</li>\r\n	<li><strong>Spacious Residences:</strong> 3 &amp; 4 BHK apartments with double-height ceilings, ranging from 3,100 to 5,000 sq. ft.</li>\r\n	<li><strong>Elegant Interiors:</strong> Designed by Matteo Nunziati, blending modern aesthetics with functionality.</li>\r\n	<li><strong>Iconic Architecture:</strong> Striking glass facade that stands out on the Gurgaon skyline.</li>\r\n	<li><strong>Trusted Development:</strong> Crafted by Tribeca Creators LLP and M3M Group.</li>\r\n	<li><strong>Exclusive Services:</strong> Trump White Glove Services for unmatched convenience.</li>\r\n	<li><strong>Flexible Payment Plan:</strong> Convenient 30:30:40 structure to ease your purchase journey.</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_trump-towers-2-sector-69-gurgaon_1759292260.jpg\"', NULL, '', NULL, NULL, 1, '2025-09-30 13:52:12', '2025-09-30 22:54:04');
INSERT INTO `properties` (`id`, `is_featured`, `name`, `slug`, `alias_name`, `partner_id`, `agent_id`, `location_id`, `property_type_id`, `bedroom_option_id`, `property_category_id`, `property_condition_id`, `rating`, `review_count`, `badge`, `locality`, `address`, `rera_reg_no`, `sort_order`, `home_sort`, `price`, `monthly_rent`, `security_deposit`, `one_time_fees`, `total_payable`, `rent_includes`, `rent_excludes`, `rental_process`, `dos_donts`, `lock_in_period_days`, `notice_period_days`, `terms_conditions`, `is_rental`, `area_sq_ft`, `rise`, `possession`, `property_status`, `is_sold`, `amenities_description`, `property_description`, `gallery_description`, `floor_plan_description`, `offer_text`, `meta_title`, `meta_description`, `airport`, `entertainment`, `national_highway`, `hospitals`, `education`, `project_highlights_title`, `highlight_images`, `location_features`, `price_list`, `map_code`, `map_text`, `is_active`, `created_at`, `updated_at`) VALUES
(89, 1, 'Lodha Hosa Road1', 'lodha-hosa-road-hsr-layout-extension-bangalore', NULL, NULL, 1, 9, 1, NULL, 1, 1, 4.70, 53, NULL, 'HSR Layout Extension', NULL, NULL, 90, 90, 23000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1700, 'high', NULL, 'newly_launched', 1, NULL, '<p data-sourcepos=\"3:1-3:447\">Imagine waking up to the gentle sounds of nature, with breathtaking lake views stretching out before you. At Lodha Hosa Road, this dream becomes a reality. Lodha, India&#39;s No.1 developer, presents a truly exceptional forest-themed residential address in the heart of HSR Extension, South East Bangalore&#39;s most sought-after locale. Here, amidst lush greenery and serene surroundings, you&#39;ll discover a life of unparalleled luxury and convenience.</p>\r\n\r\n<p data-sourcepos=\"5:1-5:351\">These aren&#39;t just homes; they&#39;re thoughtfully crafted living spaces designed to elevate your lifestyle. Choose from spacious 3, 3.5 &amp; 4 BHK residences, each featuring expansive decks perfect for relaxing and entertaining. The forest-themed central greens create a tranquil oasis, while the shimmering lake views add a touch of magic to every day.</p>\r\n\r\n<p data-sourcepos=\"7:1-7:242\">Lodha Hosa Road offers more than just a beautiful home; it offers a complete lifestyle. Enjoy world-class amenities, seamless connectivity, and the prestige of a Lodha address. This is your chance to experience the best of Bangalore living.</p>\r\n\r\n<p data-end=\"788\" data-start=\"570\">Enjoy seamless connectivity to <strong data-end=\"668\" data-start=\"601\">Outer Ring Road, Electronic City, Silk Board, and Sarjapur Road</strong>, along with top-tier schools, major IT hubs, and upcoming metro access&mdash;placing everything you need just minutes away.</p>\r\n\r\n<p data-end=\"896\" data-start=\"790\">Experience <strong data-end=\"841\" data-start=\"801\">luxury, tranquility, and convenience</strong> in a home designed for those who seek the very best.</p>', NULL, NULL, NULL, 'Lodha Hosa Road | New Launch in HSR Layout Extension, Bangalore', 'Lodha Hosa Road, a landmark address nestled in the prestigious HSR Layout Extension. This luxury forest-themed residential project by Lodha Group offers an unparalleled blend of modernity and nature-i', '30', '15', '10', '10', '10', '<ul>\r\n	<li>Luxury forest-themed development in Bangalore&rsquo;s prime location</li>\r\n	<li>Spacious homes with premium finishes and private decks</li>\r\n	<li>Unobstructed lake views for a peaceful living experience</li>\r\n	<li>World-class amenities &ndash; landscaped gardens, wellness zones, and more</li>\r\n	<li>Exclusive pre-launch benefits for early buyers</li>\r\n	<li>Spacious 3, 3.5 &amp; 4 BHK homes with expansive decks</li>\r\n	<li>Seamless connectivity to ORR, Electronic City, Silk Board, and Sarjapur Road</li>\r\n	<li>Close proximity to top schools, major IT hubs, and metro access</li>\r\n	<li>Exclusive pre-launch benefits available<br />\r\n	&nbsp;</li>\r\n</ul>', '\"properties/highlights/highlight_lodha-hosa-road-hsr-layout-extension-bangalore_1759292261.jpeg\"', NULL, NULL, NULL, NULL, 1, '2025-09-30 13:52:12', '2025-10-04 12:35:31'),
(90, 1, 'Adani Samsara Ivana', 'adani-samsara-ivana-sector-63-gurgaon', NULL, 15, 1, 1, 1, NULL, 2, 1, 4.80, 154, '', 'Sector 63', '', '123 of 2024 dated 18.12.2024', 90, 90, 56700000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1702, 'low', NULL, 'newly_launched', 0, 'Life at Ivana comes with access to a rich bouquet of lifestyle experiences — including a designer clubhouse, infinity-edge pool, wellness spa, gymnasium, kids’ play zone, and beautifully landscaped walking trails. Every amenity is tailored to elevate everyday living.', '<p data-end=\"949\" data-start=\"416\">Introducing <strong data-end=\"451\" data-start=\"428\">Adani Samsara Ivana</strong> &mdash; a rare blend of timeless elegance and contemporary comfort, crafted by <strong data-end=\"541\" data-start=\"525\">Adani Realty</strong>, one of India&rsquo;s most trusted names in real estate, in collaboration with <strong data-end=\"631\" data-start=\"615\">Brahma Group</strong>. Known for creating landmark residential communities across the country, Adani Realty now brings its signature touch to Gurgaon&rsquo;s most sought-after corridor. Samsara Ivana is more than just a residential address; it&rsquo;s a lifestyle statement designed for those who appreciate exclusivity, space, and refined aesthetics.</p>\r\n\r\n<p data-end=\"1589\" data-start=\"951\">Tucked within a low-density, gated community, Samsara Ivana features thoughtfully designed <strong data-end=\"1086\" data-start=\"1042\">4 BHK residences and spacious penthouses</strong> &mdash; each crafted to feel like a private sanctuary. The project is currently <strong data-end=\"1183\" data-start=\"1161\">under construction</strong>, with possession expected in a phased manner. Spread across acres of manicured greens, the development offers low-rise structures that ensure privacy, peaceful living, and a strong sense of community. With private lift lobbies, smart home automation, and a modern urban design that merges seamlessly with nature, Ivana invites you to experience Gurgaon like never before &mdash; quiet, elegant, and truly yours.</p>\r\n\r\n<h3 data-end=\"1623\" data-start=\"1596\"><strong>Location Overview</strong></h3>\r\n\r\n<p data-end=\"2257\" data-start=\"1625\"><strong data-end=\"1638\" data-start=\"1625\">Sector 63</strong>, located just off <strong data-end=\"1687\" data-start=\"1657\">Golf Course Extension Road</strong>, is one of Gurgaon&rsquo;s fastest-evolving luxury residential zones &mdash; and for good reason. Adani Samsara Ivana enjoys excellent connectivity to <strong data-end=\"1866\" data-start=\"1827\">Golf Course Road, Sohna Road, NH-48</strong>, and is well-aligned with the <strong data-end=\"1924\" data-start=\"1897\">upcoming metro corridor</strong>, significantly cutting travel time to Delhi and IGI Airport. Whether it&#39;s <strong data-end=\"2021\" data-start=\"1999\">top-ranked schools</strong>, <strong data-end=\"2045\" data-start=\"2023\">renowned hospitals</strong>, <strong data-end=\"2072\" data-start=\"2047\">premium office spaces</strong>, or <strong data-end=\"2100\" data-start=\"2077\">upscale retail hubs</strong> like M3M Urbana and South Point Mall, everything you need is just a short drive away. This isn&rsquo;t just convenience &mdash; it&rsquo;s curated luxury in the truest sense.</p>\r\n', 'Step into the world of Samsara Ivana through our curated gallery — featuring 3D renders, real-time construction shots, elegant interiors, and immersive visuals of the landscapes and amenities. These visuals capture the grandeur, light-filled spaces, and bespoke detailing that define this luxury enclave.', '<p>Samsara Ivana offers a limited collection of <strong data-end=\"3181\" data-start=\"3146\">4 BHK residences and penthouses</strong>, each ranging from approximately 1702<strong data-end=\"3250\" data-start=\"3215\">&nbsp;sq. ft.</strong>. Spacious floor plans with wide living areas, private terraces, and thoughtful zoning make each home ideal for modern families that value both luxury and privacy.</p>\r\n', '', 'Adani Samsara Ivana Sector 63, Gurgaon', '', '30', '10', '10', '10', '10', '<ul data-end=\"2712\" data-start=\"2294\">\r\n	<li data-end=\"2361\" data-start=\"2294\">\r\n	<p data-end=\"2361\" data-start=\"2296\">Ultra-luxury <strong data-end=\"2359\" data-start=\"2309\">4 BHK low-rise residences &amp; private penthouses</strong></p>\r\n	</li>\r\n	<li data-end=\"2428\" data-start=\"2362\">\r\n	<p data-end=\"2428\" data-start=\"2364\">Located in the elite <strong data-end=\"2426\" data-start=\"2385\">Sector 63, Golf Course Extension Road</strong></p>\r\n	</li>\r\n	<li data-end=\"2504\" data-start=\"2429\">\r\n	<p data-end=\"2504\" data-start=\"2431\">Private elevator lobbies, smart home features, and large deck balconies</p>\r\n	</li>\r\n	<li data-end=\"2577\" data-start=\"2505\">\r\n	<p data-end=\"2577\" data-start=\"2507\">Developed by <strong data-end=\"2536\" data-start=\"2520\">Adani Realty</strong> in collaboration with <strong data-end=\"2575\" data-start=\"2559\">Brahma Group</strong></p>\r\n	</li>\r\n	<li data-end=\"2656\" data-start=\"2578\">\r\n	<p data-end=\"2656\" data-start=\"2580\">Construction in progress, with <strong data-end=\"2654\" data-start=\"2611\">possession timelines in phased delivery</strong></p>\r\n	</li>\r\n	<li data-end=\"2712\" data-start=\"2657\">\r\n	<p data-end=\"2712\" data-start=\"2659\">RERA Approved: <strong data-end=\"2712\" data-start=\"2674\">HRERA-123 of 2024 dated 18.12.2024</strong></p>\r\n	</li>\r\n</ul>\r\n', '\"properties/highlights/highlight_adani-samsara-ivana-sector-63-gurgaon_1759292262.jpg\"', NULL, '', NULL, NULL, 0, '2025-09-30 13:52:12', '2025-09-30 22:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `property_amenities`
--

CREATE TABLE `property_amenities` (
  `id` bigint UNSIGNED NOT NULL,
  `property_id` bigint UNSIGNED NOT NULL,
  `amenity_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_amenities`
--

INSERT INTO `property_amenities` (`id`, `property_id`, `amenity_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 5, NULL, NULL),
(5, 1, 6, NULL, NULL),
(6, 1, 7, NULL, NULL),
(7, 1, 9, NULL, NULL),
(8, 1, 10, NULL, NULL),
(9, 1, 11, NULL, NULL),
(10, 1, 12, NULL, NULL),
(11, 1, 13, NULL, NULL),
(12, 1, 14, NULL, NULL),
(13, 1, 15, NULL, NULL),
(14, 1, 16, NULL, NULL),
(15, 1, 17, NULL, NULL),
(16, 1, 19, NULL, NULL),
(17, 1, 20, NULL, NULL),
(18, 1, 21, NULL, NULL),
(19, 1, 26, NULL, NULL),
(20, 1, 29, NULL, NULL),
(21, 1, 30, NULL, NULL),
(22, 1, 33, NULL, NULL),
(23, 1, 34, NULL, NULL),
(24, 1, 46, NULL, NULL),
(25, 1, 47, NULL, NULL),
(26, 1, 50, NULL, NULL),
(27, 1, 55, NULL, NULL),
(28, 1, 63, NULL, NULL),
(29, 1, 67, NULL, NULL),
(30, 1, 68, NULL, NULL),
(31, 1, 70, NULL, NULL),
(32, 1, 73, NULL, NULL),
(33, 2, 1, NULL, NULL),
(34, 2, 2, NULL, NULL),
(35, 2, 3, NULL, NULL),
(36, 2, 4, NULL, NULL),
(37, 2, 5, NULL, NULL),
(38, 2, 6, NULL, NULL),
(39, 2, 7, NULL, NULL),
(40, 2, 8, NULL, NULL),
(41, 2, 9, NULL, NULL),
(42, 2, 10, NULL, NULL),
(43, 2, 12, NULL, NULL),
(44, 2, 13, NULL, NULL),
(45, 2, 14, NULL, NULL),
(46, 2, 15, NULL, NULL),
(47, 2, 16, NULL, NULL),
(48, 2, 17, NULL, NULL),
(49, 2, 18, NULL, NULL),
(50, 2, 19, NULL, NULL),
(51, 2, 20, NULL, NULL),
(52, 2, 22, NULL, NULL),
(53, 2, 23, NULL, NULL),
(54, 2, 24, NULL, NULL),
(55, 2, 34, NULL, NULL),
(56, 2, 38, NULL, NULL),
(57, 2, 39, NULL, NULL),
(58, 2, 46, NULL, NULL),
(59, 2, 47, NULL, NULL),
(60, 3, 2, NULL, NULL),
(61, 3, 3, NULL, NULL),
(62, 3, 4, NULL, NULL),
(63, 3, 5, NULL, NULL),
(64, 3, 6, NULL, NULL),
(65, 3, 7, NULL, NULL),
(66, 3, 9, NULL, NULL),
(67, 3, 10, NULL, NULL),
(68, 3, 11, NULL, NULL),
(69, 3, 12, NULL, NULL),
(70, 3, 13, NULL, NULL),
(71, 3, 14, NULL, NULL),
(72, 3, 15, NULL, NULL),
(73, 3, 16, NULL, NULL),
(74, 3, 17, NULL, NULL),
(75, 3, 19, NULL, NULL),
(76, 3, 20, NULL, NULL),
(77, 3, 22, NULL, NULL),
(78, 3, 23, NULL, NULL),
(79, 3, 25, NULL, NULL),
(80, 3, 26, NULL, NULL),
(81, 3, 27, NULL, NULL),
(82, 3, 28, NULL, NULL),
(83, 3, 29, NULL, NULL),
(84, 3, 30, NULL, NULL),
(85, 3, 31, NULL, NULL),
(86, 3, 34, NULL, NULL),
(87, 3, 35, NULL, NULL),
(88, 3, 46, NULL, NULL),
(89, 4, 1, NULL, NULL),
(90, 4, 2, NULL, NULL),
(91, 4, 3, NULL, NULL),
(92, 4, 5, NULL, NULL),
(93, 4, 6, NULL, NULL),
(94, 4, 8, NULL, NULL),
(95, 4, 12, NULL, NULL),
(96, 4, 14, NULL, NULL),
(97, 4, 15, NULL, NULL),
(98, 4, 17, NULL, NULL),
(99, 4, 20, NULL, NULL),
(100, 4, 21, NULL, NULL),
(101, 4, 25, NULL, NULL),
(102, 4, 26, NULL, NULL),
(103, 4, 28, NULL, NULL),
(104, 4, 30, NULL, NULL),
(105, 5, 1, NULL, NULL),
(106, 5, 2, NULL, NULL),
(107, 5, 10, NULL, NULL),
(108, 5, 11, NULL, NULL),
(109, 5, 12, NULL, NULL),
(110, 5, 13, NULL, NULL),
(111, 5, 14, NULL, NULL),
(112, 5, 17, NULL, NULL),
(113, 5, 20, NULL, NULL),
(114, 5, 28, NULL, NULL),
(115, 5, 29, NULL, NULL),
(116, 5, 31, NULL, NULL),
(117, 5, 32, NULL, NULL),
(118, 5, 33, NULL, NULL),
(119, 6, 1, NULL, NULL),
(120, 6, 2, NULL, NULL),
(121, 6, 4, NULL, NULL),
(122, 6, 5, NULL, NULL),
(123, 6, 6, NULL, NULL),
(124, 6, 10, NULL, NULL),
(125, 6, 13, NULL, NULL),
(126, 6, 14, NULL, NULL),
(127, 6, 15, NULL, NULL),
(128, 6, 16, NULL, NULL),
(129, 6, 17, NULL, NULL),
(130, 6, 19, NULL, NULL),
(131, 6, 23, NULL, NULL),
(132, 6, 27, NULL, NULL),
(133, 6, 28, NULL, NULL),
(134, 6, 32, NULL, NULL),
(135, 6, 35, NULL, NULL),
(136, 6, 36, NULL, NULL),
(137, 6, 37, NULL, NULL),
(138, 6, 38, NULL, NULL),
(139, 6, 39, NULL, NULL),
(140, 6, 40, NULL, NULL),
(141, 6, 41, NULL, NULL),
(142, 6, 42, NULL, NULL),
(143, 6, 43, NULL, NULL),
(144, 6, 44, NULL, NULL),
(145, 6, 45, NULL, NULL),
(146, 6, 46, NULL, NULL),
(147, 6, 47, NULL, NULL),
(160, 8, 6, NULL, NULL),
(161, 8, 7, NULL, NULL),
(162, 8, 13, NULL, NULL),
(163, 8, 14, NULL, NULL),
(164, 8, 17, NULL, NULL),
(165, 8, 19, NULL, NULL),
(166, 8, 21, NULL, NULL),
(167, 8, 28, NULL, NULL),
(168, 8, 35, NULL, NULL),
(169, 8, 39, NULL, NULL),
(170, 8, 46, NULL, NULL),
(171, 9, 1, NULL, NULL),
(172, 9, 2, NULL, NULL),
(173, 9, 4, NULL, NULL),
(174, 9, 5, NULL, NULL),
(175, 9, 6, NULL, NULL),
(176, 9, 7, NULL, NULL),
(177, 9, 9, NULL, NULL),
(178, 9, 13, NULL, NULL),
(179, 9, 17, NULL, NULL),
(180, 9, 19, NULL, NULL),
(181, 9, 21, NULL, NULL),
(182, 9, 22, NULL, NULL),
(183, 9, 25, NULL, NULL),
(184, 9, 26, NULL, NULL),
(185, 9, 29, NULL, NULL),
(186, 9, 30, NULL, NULL),
(187, 9, 32, NULL, NULL),
(188, 9, 34, NULL, NULL),
(189, 9, 35, NULL, NULL),
(190, 9, 38, NULL, NULL),
(191, 9, 48, NULL, NULL),
(192, 10, 1, NULL, NULL),
(193, 10, 5, NULL, NULL),
(194, 10, 6, NULL, NULL),
(195, 10, 9, NULL, NULL),
(196, 10, 12, NULL, NULL),
(197, 10, 13, NULL, NULL),
(198, 10, 14, NULL, NULL),
(199, 10, 16, NULL, NULL),
(200, 10, 17, NULL, NULL),
(201, 10, 22, NULL, NULL),
(202, 10, 26, NULL, NULL),
(203, 10, 29, NULL, NULL),
(204, 10, 39, NULL, NULL),
(205, 10, 42, NULL, NULL),
(206, 10, 43, NULL, NULL),
(207, 10, 44, NULL, NULL),
(208, 10, 46, NULL, NULL),
(209, 10, 47, NULL, NULL),
(210, 10, 48, NULL, NULL),
(211, 10, 49, NULL, NULL),
(212, 11, 1, NULL, NULL),
(213, 11, 2, NULL, NULL),
(214, 11, 3, NULL, NULL),
(215, 11, 5, NULL, NULL),
(216, 11, 6, NULL, NULL),
(217, 11, 7, NULL, NULL),
(218, 11, 11, NULL, NULL),
(219, 11, 12, NULL, NULL),
(220, 11, 13, NULL, NULL),
(221, 11, 14, NULL, NULL),
(222, 11, 16, NULL, NULL),
(223, 11, 17, NULL, NULL),
(224, 11, 19, NULL, NULL),
(225, 11, 20, NULL, NULL),
(226, 11, 21, NULL, NULL),
(227, 11, 27, NULL, NULL),
(228, 11, 28, NULL, NULL),
(229, 11, 29, NULL, NULL),
(230, 11, 30, NULL, NULL),
(231, 11, 34, NULL, NULL),
(232, 11, 35, NULL, NULL),
(233, 11, 39, NULL, NULL),
(234, 11, 41, NULL, NULL),
(235, 11, 42, NULL, NULL),
(236, 11, 43, NULL, NULL),
(237, 11, 46, NULL, NULL),
(238, 12, 1, NULL, NULL),
(239, 12, 2, NULL, NULL),
(240, 12, 3, NULL, NULL),
(241, 12, 4, NULL, NULL),
(242, 12, 5, NULL, NULL),
(243, 12, 6, NULL, NULL),
(244, 12, 7, NULL, NULL),
(245, 12, 9, NULL, NULL),
(246, 12, 10, NULL, NULL),
(247, 12, 11, NULL, NULL),
(248, 12, 13, NULL, NULL),
(249, 12, 14, NULL, NULL),
(250, 12, 16, NULL, NULL),
(251, 12, 17, NULL, NULL),
(252, 12, 18, NULL, NULL),
(253, 12, 19, NULL, NULL),
(254, 12, 22, NULL, NULL),
(255, 12, 23, NULL, NULL),
(256, 12, 24, NULL, NULL),
(257, 12, 26, NULL, NULL),
(258, 12, 28, NULL, NULL),
(259, 12, 29, NULL, NULL),
(260, 12, 30, NULL, NULL),
(261, 12, 34, NULL, NULL),
(262, 12, 35, NULL, NULL),
(263, 12, 42, NULL, NULL),
(264, 12, 47, NULL, NULL),
(265, 13, 1, NULL, NULL),
(266, 13, 3, NULL, NULL),
(267, 13, 6, NULL, NULL),
(268, 13, 7, NULL, NULL),
(269, 13, 8, NULL, NULL),
(270, 13, 10, NULL, NULL),
(271, 13, 14, NULL, NULL),
(272, 13, 18, NULL, NULL),
(273, 13, 28, NULL, NULL),
(274, 13, 34, NULL, NULL),
(275, 13, 41, NULL, NULL),
(276, 13, 42, NULL, NULL),
(277, 13, 46, NULL, NULL),
(278, 14, 3, NULL, NULL),
(279, 14, 6, NULL, NULL),
(280, 14, 10, NULL, NULL),
(281, 14, 14, NULL, NULL),
(282, 14, 46, NULL, NULL),
(283, 15, 6, NULL, NULL),
(284, 15, 7, NULL, NULL),
(285, 15, 8, NULL, NULL),
(286, 15, 9, NULL, NULL),
(287, 15, 19, NULL, NULL),
(288, 15, 28, NULL, NULL),
(289, 15, 53, NULL, NULL),
(290, 15, 65, NULL, NULL),
(291, 15, 68, NULL, NULL),
(292, 17, 2, NULL, NULL),
(293, 17, 6, NULL, NULL),
(294, 17, 10, NULL, NULL),
(295, 17, 12, NULL, NULL),
(296, 17, 13, NULL, NULL),
(297, 17, 28, NULL, NULL),
(298, 17, 34, NULL, NULL),
(299, 17, 50, NULL, NULL),
(300, 17, 51, NULL, NULL),
(301, 17, 52, NULL, NULL),
(302, 17, 53, NULL, NULL),
(303, 18, 1, NULL, NULL),
(304, 18, 6, NULL, NULL),
(305, 18, 9, NULL, NULL),
(306, 18, 10, NULL, NULL),
(307, 18, 11, NULL, NULL),
(308, 18, 13, NULL, NULL),
(309, 18, 14, NULL, NULL),
(310, 18, 17, NULL, NULL),
(311, 18, 22, NULL, NULL),
(312, 18, 23, NULL, NULL),
(313, 18, 26, NULL, NULL),
(314, 18, 27, NULL, NULL),
(315, 18, 28, NULL, NULL),
(316, 18, 29, NULL, NULL),
(317, 18, 31, NULL, NULL),
(318, 18, 39, NULL, NULL),
(319, 18, 46, NULL, NULL),
(320, 18, 51, NULL, NULL),
(321, 18, 53, NULL, NULL),
(322, 18, 54, NULL, NULL),
(323, 18, 55, NULL, NULL),
(324, 18, 56, NULL, NULL),
(325, 18, 57, NULL, NULL),
(326, 18, 58, NULL, NULL),
(327, 18, 59, NULL, NULL),
(328, 18, 60, NULL, NULL),
(329, 18, 61, NULL, NULL),
(330, 18, 62, NULL, NULL),
(331, 18, 63, NULL, NULL),
(332, 18, 64, NULL, NULL),
(333, 18, 65, NULL, NULL),
(334, 18, 66, NULL, NULL),
(335, 18, 67, NULL, NULL),
(336, 18, 68, NULL, NULL),
(337, 18, 69, NULL, NULL),
(338, 19, 1, NULL, NULL),
(339, 19, 5, NULL, NULL),
(340, 19, 6, NULL, NULL),
(341, 19, 9, NULL, NULL),
(342, 19, 10, NULL, NULL),
(343, 19, 13, NULL, NULL),
(344, 19, 14, NULL, NULL),
(345, 19, 17, NULL, NULL),
(346, 19, 18, NULL, NULL),
(347, 19, 22, NULL, NULL),
(348, 19, 26, NULL, NULL),
(349, 19, 27, NULL, NULL),
(350, 19, 31, NULL, NULL),
(351, 19, 35, NULL, NULL),
(352, 19, 36, NULL, NULL),
(353, 19, 39, NULL, NULL),
(354, 19, 49, NULL, NULL),
(355, 19, 66, NULL, NULL),
(356, 20, 5, NULL, NULL),
(357, 20, 6, NULL, NULL),
(358, 20, 9, NULL, NULL),
(359, 20, 11, NULL, NULL),
(360, 20, 13, NULL, NULL),
(361, 20, 14, NULL, NULL),
(362, 20, 17, NULL, NULL),
(363, 20, 18, NULL, NULL),
(364, 20, 26, NULL, NULL),
(365, 20, 27, NULL, NULL),
(366, 20, 29, NULL, NULL),
(367, 20, 61, NULL, NULL),
(368, 20, 67, NULL, NULL),
(369, 20, 69, NULL, NULL),
(370, 22, 1, NULL, NULL),
(371, 22, 6, NULL, NULL),
(372, 22, 7, NULL, NULL),
(373, 22, 10, NULL, NULL),
(374, 22, 54, NULL, NULL),
(375, 22, 65, NULL, NULL),
(376, 22, 69, NULL, NULL),
(377, 23, 6, NULL, NULL),
(378, 23, 8, NULL, NULL),
(379, 23, 10, NULL, NULL),
(380, 24, 3, NULL, NULL),
(381, 24, 6, NULL, NULL),
(382, 24, 7, NULL, NULL),
(383, 24, 8, NULL, NULL),
(384, 24, 14, NULL, NULL),
(385, 24, 28, NULL, NULL),
(386, 24, 42, NULL, NULL),
(387, 24, 46, NULL, NULL),
(388, 24, 68, NULL, NULL),
(389, 25, 1, NULL, NULL),
(390, 25, 2, NULL, NULL),
(391, 25, 3, NULL, NULL),
(392, 25, 6, NULL, NULL),
(393, 25, 7, NULL, NULL),
(394, 25, 10, NULL, NULL),
(395, 25, 11, NULL, NULL),
(396, 25, 13, NULL, NULL),
(397, 25, 17, NULL, NULL),
(398, 25, 27, NULL, NULL),
(399, 25, 28, NULL, NULL),
(400, 25, 30, NULL, NULL),
(401, 25, 41, NULL, NULL),
(402, 25, 42, NULL, NULL),
(403, 25, 43, NULL, NULL),
(404, 25, 46, NULL, NULL),
(405, 25, 53, NULL, NULL),
(406, 25, 54, NULL, NULL),
(407, 25, 57, NULL, NULL),
(408, 25, 67, NULL, NULL),
(409, 26, 1, NULL, NULL),
(410, 26, 3, NULL, NULL),
(411, 26, 8, NULL, NULL),
(412, 26, 14, NULL, NULL),
(413, 26, 29, NULL, NULL),
(414, 26, 41, NULL, NULL),
(415, 26, 42, NULL, NULL),
(416, 26, 46, NULL, NULL),
(417, 26, 53, NULL, NULL),
(418, 26, 54, NULL, NULL),
(419, 26, 59, NULL, NULL),
(420, 26, 67, NULL, NULL),
(421, 26, 68, NULL, NULL),
(422, 27, 1, NULL, NULL),
(423, 27, 2, NULL, NULL),
(424, 27, 5, NULL, NULL),
(425, 27, 6, NULL, NULL),
(426, 27, 10, NULL, NULL),
(427, 27, 14, NULL, NULL),
(428, 27, 17, NULL, NULL),
(429, 27, 18, NULL, NULL),
(430, 27, 29, NULL, NULL),
(431, 27, 39, NULL, NULL),
(432, 27, 46, NULL, NULL),
(433, 27, 47, NULL, NULL),
(434, 27, 50, NULL, NULL),
(435, 27, 58, NULL, NULL),
(436, 27, 65, NULL, NULL),
(437, 27, 66, NULL, NULL),
(438, 27, 68, NULL, NULL),
(439, 27, 69, NULL, NULL),
(440, 28, 1, NULL, NULL),
(441, 28, 3, NULL, NULL),
(442, 28, 5, NULL, NULL),
(443, 28, 6, NULL, NULL),
(444, 28, 7, NULL, NULL),
(445, 28, 8, NULL, NULL),
(446, 28, 9, NULL, NULL),
(447, 28, 10, NULL, NULL),
(448, 28, 11, NULL, NULL),
(449, 28, 12, NULL, NULL),
(450, 28, 13, NULL, NULL),
(451, 28, 14, NULL, NULL),
(452, 28, 25, NULL, NULL),
(453, 28, 28, NULL, NULL),
(454, 28, 29, NULL, NULL),
(455, 28, 39, NULL, NULL),
(456, 28, 42, NULL, NULL),
(457, 28, 43, NULL, NULL),
(458, 28, 46, NULL, NULL),
(459, 28, 51, NULL, NULL),
(460, 28, 61, NULL, NULL),
(461, 28, 65, NULL, NULL),
(462, 28, 67, NULL, NULL),
(463, 28, 69, NULL, NULL),
(464, 29, 5, NULL, NULL),
(465, 29, 6, NULL, NULL),
(466, 29, 7, NULL, NULL),
(467, 29, 13, NULL, NULL),
(468, 29, 29, NULL, NULL),
(469, 29, 43, NULL, NULL),
(470, 29, 46, NULL, NULL),
(471, 29, 49, NULL, NULL),
(472, 29, 54, NULL, NULL),
(473, 29, 68, NULL, NULL),
(474, 30, 3, NULL, NULL),
(475, 30, 4, NULL, NULL),
(476, 30, 6, NULL, NULL),
(477, 30, 7, NULL, NULL),
(478, 30, 28, NULL, NULL),
(479, 30, 29, NULL, NULL),
(480, 30, 31, NULL, NULL),
(481, 30, 41, NULL, NULL),
(482, 30, 51, NULL, NULL),
(483, 30, 68, NULL, NULL),
(484, 31, 3, NULL, NULL),
(485, 31, 6, NULL, NULL),
(486, 31, 7, NULL, NULL),
(487, 31, 9, NULL, NULL),
(488, 31, 10, NULL, NULL),
(489, 31, 19, NULL, NULL),
(490, 31, 21, NULL, NULL),
(491, 31, 28, NULL, NULL),
(492, 31, 35, NULL, NULL),
(493, 31, 50, NULL, NULL),
(494, 31, 53, NULL, NULL),
(495, 31, 68, NULL, NULL),
(496, 32, 3, NULL, NULL),
(497, 32, 4, NULL, NULL),
(498, 32, 6, NULL, NULL),
(499, 32, 7, NULL, NULL),
(500, 32, 8, NULL, NULL),
(501, 32, 9, NULL, NULL),
(502, 32, 10, NULL, NULL),
(503, 32, 14, NULL, NULL),
(504, 32, 18, NULL, NULL),
(505, 32, 28, NULL, NULL),
(506, 32, 34, NULL, NULL),
(507, 32, 41, NULL, NULL),
(508, 32, 42, NULL, NULL),
(509, 32, 43, NULL, NULL),
(510, 32, 46, NULL, NULL),
(511, 32, 47, NULL, NULL),
(512, 32, 53, NULL, NULL),
(513, 32, 54, NULL, NULL),
(514, 32, 59, NULL, NULL),
(515, 32, 65, NULL, NULL),
(516, 32, 67, NULL, NULL),
(517, 32, 68, NULL, NULL),
(518, 33, 6, NULL, NULL),
(519, 33, 10, NULL, NULL),
(520, 33, 11, NULL, NULL),
(521, 33, 12, NULL, NULL),
(522, 33, 29, NULL, NULL),
(523, 33, 32, NULL, NULL),
(524, 33, 34, NULL, NULL),
(525, 33, 42, NULL, NULL),
(526, 33, 46, NULL, NULL),
(527, 33, 67, NULL, NULL),
(528, 33, 68, NULL, NULL),
(529, 34, 1, NULL, NULL),
(530, 34, 3, NULL, NULL),
(531, 34, 5, NULL, NULL),
(532, 34, 6, NULL, NULL),
(533, 34, 7, NULL, NULL),
(534, 34, 8, NULL, NULL),
(535, 34, 9, NULL, NULL),
(536, 34, 10, NULL, NULL),
(537, 34, 11, NULL, NULL),
(538, 34, 12, NULL, NULL),
(539, 34, 13, NULL, NULL),
(540, 34, 14, NULL, NULL),
(541, 34, 17, NULL, NULL),
(542, 34, 19, NULL, NULL),
(543, 34, 23, NULL, NULL),
(544, 34, 24, NULL, NULL),
(545, 34, 25, NULL, NULL),
(546, 34, 26, NULL, NULL),
(547, 34, 28, NULL, NULL),
(548, 34, 29, NULL, NULL),
(549, 34, 34, NULL, NULL),
(550, 34, 37, NULL, NULL),
(551, 34, 40, NULL, NULL),
(552, 34, 41, NULL, NULL),
(553, 34, 42, NULL, NULL),
(554, 34, 46, NULL, NULL),
(555, 34, 47, NULL, NULL),
(556, 34, 53, NULL, NULL),
(557, 34, 54, NULL, NULL),
(558, 34, 58, NULL, NULL),
(559, 34, 65, NULL, NULL),
(560, 34, 67, NULL, NULL),
(561, 34, 68, NULL, NULL),
(562, 34, 69, NULL, NULL),
(563, 34, 70, NULL, NULL),
(564, 34, 56, NULL, NULL),
(565, 34, 72, NULL, NULL),
(566, 34, 73, NULL, NULL),
(567, 34, 74, NULL, NULL),
(568, 35, 1, NULL, NULL),
(569, 35, 2, NULL, NULL),
(570, 35, 3, NULL, NULL),
(571, 35, 7, NULL, NULL),
(572, 35, 13, NULL, NULL),
(573, 35, 14, NULL, NULL),
(574, 35, 17, NULL, NULL),
(575, 35, 20, NULL, NULL),
(576, 35, 22, NULL, NULL),
(577, 35, 26, NULL, NULL),
(578, 35, 29, NULL, NULL),
(579, 35, 31, NULL, NULL),
(580, 35, 37, NULL, NULL),
(581, 35, 42, NULL, NULL),
(582, 35, 43, NULL, NULL),
(583, 35, 46, NULL, NULL),
(584, 35, 53, NULL, NULL),
(585, 35, 56, NULL, NULL),
(586, 35, 57, NULL, NULL),
(587, 35, 63, NULL, NULL),
(588, 35, 68, NULL, NULL),
(589, 35, 69, NULL, NULL),
(590, 35, 70, NULL, NULL),
(591, 35, 73, NULL, NULL),
(592, 35, 74, NULL, NULL),
(593, 36, 1, NULL, NULL),
(594, 36, 3, NULL, NULL),
(595, 36, 6, NULL, NULL),
(596, 36, 7, NULL, NULL),
(597, 36, 10, NULL, NULL),
(598, 36, 14, NULL, NULL),
(599, 36, 28, NULL, NULL),
(600, 36, 29, NULL, NULL),
(601, 36, 34, NULL, NULL),
(602, 36, 41, NULL, NULL),
(603, 36, 46, NULL, NULL),
(604, 36, 53, NULL, NULL),
(605, 36, 59, NULL, NULL),
(606, 36, 64, NULL, NULL),
(607, 36, 67, NULL, NULL),
(608, 36, 68, NULL, NULL),
(609, 36, 73, NULL, NULL),
(610, 37, 1, NULL, NULL),
(611, 37, 6, NULL, NULL),
(612, 37, 7, NULL, NULL),
(613, 37, 13, NULL, NULL),
(614, 37, 14, NULL, NULL),
(615, 37, 15, NULL, NULL),
(616, 37, 28, NULL, NULL),
(617, 37, 29, NULL, NULL),
(618, 37, 53, NULL, NULL),
(619, 37, 55, NULL, NULL),
(620, 37, 59, NULL, NULL),
(621, 37, 67, NULL, NULL),
(622, 37, 68, NULL, NULL),
(623, 37, 69, NULL, NULL),
(624, 38, 1, NULL, NULL),
(625, 38, 2, NULL, NULL),
(626, 38, 3, NULL, NULL),
(627, 38, 6, NULL, NULL),
(628, 38, 7, NULL, NULL),
(629, 38, 8, NULL, NULL),
(630, 38, 9, NULL, NULL),
(631, 38, 13, NULL, NULL),
(632, 38, 14, NULL, NULL),
(633, 38, 17, NULL, NULL),
(634, 38, 28, NULL, NULL),
(635, 38, 31, NULL, NULL),
(636, 38, 34, NULL, NULL),
(637, 38, 40, NULL, NULL),
(638, 38, 61, NULL, NULL),
(639, 38, 67, NULL, NULL),
(640, 38, 68, NULL, NULL),
(641, 38, 69, NULL, NULL),
(642, 39, 3, NULL, NULL),
(643, 39, 6, NULL, NULL),
(644, 39, 13, NULL, NULL),
(645, 39, 14, NULL, NULL),
(646, 39, 17, NULL, NULL),
(647, 39, 28, NULL, NULL),
(648, 39, 29, NULL, NULL),
(649, 39, 31, NULL, NULL),
(650, 39, 32, NULL, NULL),
(651, 39, 33, NULL, NULL),
(652, 39, 34, NULL, NULL),
(653, 39, 37, NULL, NULL),
(654, 39, 41, NULL, NULL),
(655, 39, 42, NULL, NULL),
(656, 39, 47, NULL, NULL),
(657, 39, 53, NULL, NULL),
(658, 39, 67, NULL, NULL),
(659, 39, 68, NULL, NULL),
(660, 39, 69, NULL, NULL),
(661, 40, 5, NULL, NULL),
(662, 40, 6, NULL, NULL),
(663, 40, 7, NULL, NULL),
(664, 40, 8, NULL, NULL),
(665, 40, 9, NULL, NULL),
(666, 40, 14, NULL, NULL),
(667, 40, 15, NULL, NULL),
(668, 40, 16, NULL, NULL),
(669, 40, 17, NULL, NULL),
(670, 40, 18, NULL, NULL),
(671, 40, 19, NULL, NULL),
(672, 40, 20, NULL, NULL),
(673, 40, 28, NULL, NULL),
(674, 40, 29, NULL, NULL),
(675, 40, 33, NULL, NULL),
(676, 40, 34, NULL, NULL),
(677, 40, 35, NULL, NULL),
(678, 40, 39, NULL, NULL),
(679, 40, 47, NULL, NULL),
(680, 40, 50, NULL, NULL),
(681, 40, 65, NULL, NULL),
(682, 40, 68, NULL, NULL),
(683, 40, 73, NULL, NULL),
(684, 41, 3, NULL, NULL),
(685, 41, 5, NULL, NULL),
(686, 41, 6, NULL, NULL),
(687, 41, 13, NULL, NULL),
(688, 41, 14, NULL, NULL),
(689, 41, 15, NULL, NULL),
(690, 41, 17, NULL, NULL),
(691, 41, 25, NULL, NULL),
(692, 41, 26, NULL, NULL),
(693, 41, 29, NULL, NULL),
(694, 41, 31, NULL, NULL),
(695, 41, 33, NULL, NULL),
(696, 41, 34, NULL, NULL),
(697, 41, 37, NULL, NULL),
(698, 41, 39, NULL, NULL),
(699, 41, 47, NULL, NULL),
(700, 41, 53, NULL, NULL),
(701, 41, 60, NULL, NULL),
(702, 41, 61, NULL, NULL),
(703, 41, 66, NULL, NULL),
(704, 41, 67, NULL, NULL),
(705, 41, 68, NULL, NULL),
(706, 41, 69, NULL, NULL),
(707, 41, 73, NULL, NULL),
(708, 42, 3, NULL, NULL),
(709, 42, 6, NULL, NULL),
(710, 42, 9, NULL, NULL),
(711, 42, 10, NULL, NULL),
(712, 42, 13, NULL, NULL),
(713, 42, 14, NULL, NULL),
(714, 42, 15, NULL, NULL),
(715, 42, 17, NULL, NULL),
(716, 42, 26, NULL, NULL),
(717, 42, 29, NULL, NULL),
(718, 42, 31, NULL, NULL),
(719, 42, 37, NULL, NULL),
(720, 42, 39, NULL, NULL),
(721, 42, 41, NULL, NULL),
(722, 42, 42, NULL, NULL),
(723, 42, 46, NULL, NULL),
(724, 42, 53, NULL, NULL),
(725, 42, 60, NULL, NULL),
(726, 42, 67, NULL, NULL),
(727, 42, 68, NULL, NULL),
(728, 42, 69, NULL, NULL),
(729, 42, 73, NULL, NULL),
(730, 43, 4, NULL, NULL),
(731, 43, 6, NULL, NULL),
(732, 43, 9, NULL, NULL),
(733, 43, 19, NULL, NULL),
(734, 43, 28, NULL, NULL),
(735, 43, 29, NULL, NULL),
(736, 43, 31, NULL, NULL),
(737, 43, 39, NULL, NULL),
(738, 43, 50, NULL, NULL),
(739, 43, 53, NULL, NULL),
(740, 43, 65, NULL, NULL),
(741, 43, 68, NULL, NULL),
(742, 44, 1, NULL, NULL),
(743, 44, 5, NULL, NULL),
(744, 44, 6, NULL, NULL),
(745, 44, 11, NULL, NULL),
(746, 44, 13, NULL, NULL),
(747, 44, 14, NULL, NULL),
(748, 44, 17, NULL, NULL),
(749, 44, 22, NULL, NULL),
(750, 44, 26, NULL, NULL),
(751, 44, 28, NULL, NULL),
(752, 44, 29, NULL, NULL),
(753, 44, 32, NULL, NULL),
(754, 44, 34, NULL, NULL),
(755, 44, 46, NULL, NULL),
(756, 44, 61, NULL, NULL),
(757, 44, 68, NULL, NULL),
(758, 45, 6, NULL, NULL),
(759, 45, 10, NULL, NULL),
(760, 45, 14, NULL, NULL),
(761, 45, 29, NULL, NULL),
(762, 45, 34, NULL, NULL),
(763, 45, 41, NULL, NULL),
(764, 45, 53, NULL, NULL),
(765, 46, 3, NULL, NULL),
(766, 46, 6, NULL, NULL),
(767, 46, 14, NULL, NULL),
(768, 46, 34, NULL, NULL),
(769, 46, 64, NULL, NULL),
(770, 46, 74, NULL, NULL),
(771, 46, 76, NULL, NULL),
(772, 46, 77, NULL, NULL),
(773, 46, 78, NULL, NULL),
(774, 46, 79, NULL, NULL),
(775, 47, 6, NULL, NULL),
(776, 47, 9, NULL, NULL),
(777, 47, 10, NULL, NULL),
(778, 47, 14, NULL, NULL),
(779, 47, 41, NULL, NULL),
(780, 47, 76, NULL, NULL),
(781, 47, 79, NULL, NULL),
(782, 48, 6, NULL, NULL),
(783, 48, 10, NULL, NULL),
(784, 48, 14, NULL, NULL),
(785, 48, 41, NULL, NULL),
(786, 48, 79, NULL, NULL),
(787, 49, 6, NULL, NULL),
(788, 49, 8, NULL, NULL),
(789, 49, 10, NULL, NULL),
(790, 49, 14, NULL, NULL),
(791, 49, 41, NULL, NULL),
(792, 50, 3, NULL, NULL),
(793, 50, 6, NULL, NULL),
(794, 50, 10, NULL, NULL),
(795, 50, 14, NULL, NULL),
(796, 50, 59, NULL, NULL),
(797, 50, 79, NULL, NULL),
(798, 50, 80, NULL, NULL),
(799, 50, 81, NULL, NULL),
(800, 51, 1, NULL, NULL),
(801, 51, 6, NULL, NULL),
(802, 51, 9, NULL, NULL),
(803, 51, 13, NULL, NULL),
(804, 51, 17, NULL, NULL),
(805, 51, 25, NULL, NULL),
(806, 51, 29, NULL, NULL),
(807, 51, 47, NULL, NULL),
(808, 51, 65, NULL, NULL),
(809, 51, 68, NULL, NULL),
(810, 51, 79, NULL, NULL),
(811, 52, 3, NULL, NULL),
(812, 52, 6, NULL, NULL),
(813, 52, 14, NULL, NULL),
(814, 52, 29, NULL, NULL),
(815, 52, 34, NULL, NULL),
(816, 52, 53, NULL, NULL),
(817, 52, 59, NULL, NULL),
(818, 52, 77, NULL, NULL),
(819, 52, 79, NULL, NULL),
(820, 53, 3, NULL, NULL),
(821, 53, 6, NULL, NULL),
(822, 53, 10, NULL, NULL),
(823, 53, 29, NULL, NULL),
(824, 53, 34, NULL, NULL),
(825, 53, 41, NULL, NULL),
(826, 53, 76, NULL, NULL),
(827, 54, 6, NULL, NULL),
(828, 54, 9, NULL, NULL),
(829, 54, 14, NULL, NULL),
(830, 54, 15, NULL, NULL),
(831, 54, 21, NULL, NULL),
(832, 54, 28, NULL, NULL),
(833, 54, 29, NULL, NULL),
(834, 54, 32, NULL, NULL),
(835, 54, 34, NULL, NULL),
(836, 54, 35, NULL, NULL),
(837, 54, 36, NULL, NULL),
(838, 54, 38, NULL, NULL),
(839, 54, 39, NULL, NULL),
(840, 54, 41, NULL, NULL),
(841, 54, 47, NULL, NULL),
(842, 54, 68, NULL, NULL),
(843, 54, 69, NULL, NULL),
(844, 54, 75, NULL, NULL),
(845, 55, 3, NULL, NULL),
(846, 55, 5, NULL, NULL),
(847, 55, 6, NULL, NULL),
(848, 55, 7, NULL, NULL),
(849, 55, 9, NULL, NULL),
(850, 55, 10, NULL, NULL),
(851, 55, 11, NULL, NULL),
(852, 55, 13, NULL, NULL),
(853, 55, 14, NULL, NULL),
(854, 55, 17, NULL, NULL),
(855, 55, 25, NULL, NULL),
(856, 55, 27, NULL, NULL),
(857, 55, 28, NULL, NULL),
(858, 55, 29, NULL, NULL),
(859, 55, 32, NULL, NULL),
(860, 55, 37, NULL, NULL),
(861, 55, 41, NULL, NULL),
(862, 55, 42, NULL, NULL),
(863, 55, 45, NULL, NULL),
(864, 55, 46, NULL, NULL),
(865, 55, 47, NULL, NULL),
(866, 55, 50, NULL, NULL),
(867, 55, 59, NULL, NULL),
(868, 55, 61, NULL, NULL),
(869, 55, 65, NULL, NULL),
(870, 55, 68, NULL, NULL),
(871, 55, 69, NULL, NULL),
(872, 55, 76, NULL, NULL),
(873, 55, 77, NULL, NULL),
(874, 55, 79, NULL, NULL),
(875, 56, 6, NULL, NULL),
(876, 56, 9, NULL, NULL),
(877, 56, 11, NULL, NULL),
(878, 56, 13, NULL, NULL),
(879, 56, 15, NULL, NULL),
(880, 56, 17, NULL, NULL),
(881, 56, 18, NULL, NULL),
(882, 56, 29, NULL, NULL),
(883, 56, 47, NULL, NULL),
(884, 56, 53, NULL, NULL),
(885, 56, 65, NULL, NULL),
(886, 56, 67, NULL, NULL),
(887, 56, 68, NULL, NULL),
(888, 56, 73, NULL, NULL),
(889, 57, 3, NULL, NULL),
(890, 57, 5, NULL, NULL),
(891, 57, 6, NULL, NULL),
(892, 57, 8, NULL, NULL),
(893, 57, 10, NULL, NULL),
(894, 57, 12, NULL, NULL),
(895, 57, 13, NULL, NULL),
(896, 57, 14, NULL, NULL),
(897, 57, 17, NULL, NULL),
(898, 57, 18, NULL, NULL),
(899, 57, 20, NULL, NULL),
(900, 57, 25, NULL, NULL),
(901, 57, 29, NULL, NULL),
(902, 57, 30, NULL, NULL),
(903, 57, 31, NULL, NULL),
(904, 57, 34, NULL, NULL),
(905, 57, 37, NULL, NULL),
(906, 57, 41, NULL, NULL),
(907, 57, 46, NULL, NULL),
(908, 57, 47, NULL, NULL),
(909, 57, 53, NULL, NULL),
(910, 57, 61, NULL, NULL),
(911, 57, 65, NULL, NULL),
(912, 57, 66, NULL, NULL),
(913, 57, 67, NULL, NULL),
(914, 57, 68, NULL, NULL),
(915, 57, 69, NULL, NULL),
(916, 57, 79, NULL, NULL),
(917, 58, 6, NULL, NULL),
(918, 58, 11, NULL, NULL),
(919, 58, 13, NULL, NULL),
(920, 58, 14, NULL, NULL),
(921, 58, 29, NULL, NULL),
(922, 58, 31, NULL, NULL),
(923, 58, 34, NULL, NULL),
(924, 58, 38, NULL, NULL),
(925, 58, 39, NULL, NULL),
(926, 58, 40, NULL, NULL),
(927, 58, 41, NULL, NULL),
(928, 58, 67, NULL, NULL),
(929, 58, 79, NULL, NULL),
(930, 59, 3, NULL, NULL),
(931, 59, 6, NULL, NULL),
(932, 59, 10, NULL, NULL),
(933, 59, 13, NULL, NULL),
(934, 59, 64, NULL, NULL),
(935, 59, 67, NULL, NULL),
(936, 59, 68, NULL, NULL),
(937, 59, 69, NULL, NULL),
(938, 59, 79, NULL, NULL),
(939, 60, 3, NULL, NULL),
(940, 60, 6, NULL, NULL),
(941, 60, 11, NULL, NULL),
(942, 60, 13, NULL, NULL),
(943, 60, 14, NULL, NULL),
(944, 60, 15, NULL, NULL),
(945, 60, 17, NULL, NULL),
(946, 60, 28, NULL, NULL),
(947, 60, 29, NULL, NULL),
(948, 60, 34, NULL, NULL),
(949, 60, 37, NULL, NULL),
(950, 60, 39, NULL, NULL),
(951, 60, 41, NULL, NULL),
(952, 60, 47, NULL, NULL),
(953, 60, 53, NULL, NULL),
(954, 60, 65, NULL, NULL),
(955, 60, 68, NULL, NULL),
(956, 60, 69, NULL, NULL),
(957, 60, 76, NULL, NULL),
(958, 60, 81, NULL, NULL),
(959, 61, 3, NULL, NULL),
(960, 61, 6, NULL, NULL),
(961, 61, 8, NULL, NULL),
(962, 61, 10, NULL, NULL),
(963, 61, 14, NULL, NULL),
(964, 61, 41, NULL, NULL),
(965, 61, 46, NULL, NULL),
(966, 61, 59, NULL, NULL),
(967, 61, 79, NULL, NULL),
(968, 63, 3, NULL, NULL),
(969, 63, 6, NULL, NULL),
(970, 63, 11, NULL, NULL),
(971, 63, 13, NULL, NULL),
(972, 63, 14, NULL, NULL),
(973, 63, 17, NULL, NULL),
(974, 63, 25, NULL, NULL),
(975, 63, 29, NULL, NULL),
(976, 63, 31, NULL, NULL),
(977, 63, 37, NULL, NULL),
(978, 63, 41, NULL, NULL),
(979, 63, 42, NULL, NULL),
(980, 63, 46, NULL, NULL),
(981, 63, 53, NULL, NULL),
(982, 63, 61, NULL, NULL),
(983, 63, 68, NULL, NULL),
(984, 63, 69, NULL, NULL),
(985, 63, 73, NULL, NULL),
(986, 63, 79, NULL, NULL),
(987, 64, 6, NULL, NULL),
(988, 64, 9, NULL, NULL),
(989, 64, 13, NULL, NULL),
(990, 64, 14, NULL, NULL),
(991, 64, 17, NULL, NULL),
(992, 64, 28, NULL, NULL),
(993, 64, 29, NULL, NULL),
(994, 64, 31, NULL, NULL),
(995, 64, 37, NULL, NULL),
(996, 64, 38, NULL, NULL),
(997, 64, 40, NULL, NULL),
(998, 64, 41, NULL, NULL),
(999, 64, 53, NULL, NULL),
(1000, 64, 60, NULL, NULL),
(1001, 64, 65, NULL, NULL),
(1002, 64, 67, NULL, NULL),
(1003, 64, 69, NULL, NULL),
(1004, 64, 79, NULL, NULL),
(1005, 65, 14, NULL, NULL),
(1006, 65, 22, NULL, NULL),
(1007, 65, 24, NULL, NULL),
(1008, 65, 39, NULL, NULL),
(1009, 65, 57, NULL, NULL),
(1010, 65, 63, NULL, NULL),
(1011, 65, 66, NULL, NULL),
(1012, 65, 82, NULL, NULL),
(1013, 65, 83, NULL, NULL),
(1014, 65, 84, NULL, NULL),
(1015, 65, 85, NULL, NULL),
(1016, 66, 11, NULL, NULL),
(1017, 66, 14, NULL, NULL),
(1018, 66, 22, NULL, NULL),
(1019, 66, 24, NULL, NULL),
(1020, 66, 26, NULL, NULL),
(1021, 66, 27, NULL, NULL),
(1022, 66, 33, NULL, NULL),
(1023, 66, 39, NULL, NULL),
(1024, 66, 57, NULL, NULL),
(1025, 66, 63, NULL, NULL),
(1026, 66, 66, NULL, NULL),
(1027, 66, 68, NULL, NULL),
(1028, 66, 69, NULL, NULL),
(1029, 66, 73, NULL, NULL),
(1030, 66, 84, NULL, NULL),
(1031, 66, 85, NULL, NULL),
(1032, 67, 2, NULL, NULL),
(1033, 67, 4, NULL, NULL),
(1034, 67, 5, NULL, NULL),
(1035, 67, 27, NULL, NULL),
(1036, 67, 29, NULL, NULL),
(1037, 67, 41, NULL, NULL),
(1038, 67, 53, NULL, NULL),
(1039, 67, 61, NULL, NULL),
(1040, 68, 3, NULL, NULL),
(1041, 68, 6, NULL, NULL),
(1042, 68, 8, NULL, NULL),
(1043, 68, 10, NULL, NULL),
(1044, 68, 12, NULL, NULL),
(1045, 68, 14, NULL, NULL),
(1046, 68, 15, NULL, NULL),
(1047, 68, 29, NULL, NULL),
(1048, 68, 46, NULL, NULL),
(1049, 68, 59, NULL, NULL),
(1050, 68, 61, NULL, NULL),
(1051, 68, 68, NULL, NULL),
(1052, 68, 79, NULL, NULL),
(1053, 69, 2, NULL, NULL),
(1054, 69, 3, NULL, NULL),
(1055, 69, 5, NULL, NULL),
(1056, 69, 6, NULL, NULL),
(1057, 69, 7, NULL, NULL),
(1058, 69, 9, NULL, NULL),
(1059, 69, 10, NULL, NULL),
(1060, 69, 13, NULL, NULL),
(1061, 69, 14, NULL, NULL),
(1062, 69, 29, NULL, NULL),
(1063, 69, 41, NULL, NULL),
(1064, 69, 61, NULL, NULL),
(1065, 69, 65, NULL, NULL),
(1066, 69, 76, NULL, NULL),
(1067, 70, 3, NULL, NULL),
(1068, 70, 6, NULL, NULL),
(1069, 70, 9, NULL, NULL),
(1070, 70, 10, NULL, NULL),
(1071, 70, 11, NULL, NULL),
(1072, 70, 14, NULL, NULL),
(1073, 70, 17, NULL, NULL),
(1074, 70, 26, NULL, NULL),
(1075, 70, 29, NULL, NULL),
(1076, 70, 30, NULL, NULL),
(1077, 70, 39, NULL, NULL),
(1078, 70, 47, NULL, NULL),
(1079, 70, 79, NULL, NULL),
(1080, 71, 3, NULL, NULL),
(1081, 71, 6, NULL, NULL),
(1082, 71, 7, NULL, NULL),
(1083, 71, 9, NULL, NULL),
(1084, 71, 10, NULL, NULL),
(1085, 71, 11, NULL, NULL),
(1086, 71, 14, NULL, NULL),
(1087, 71, 29, NULL, NULL),
(1088, 71, 34, NULL, NULL),
(1089, 71, 41, NULL, NULL),
(1090, 71, 61, NULL, NULL),
(1091, 71, 69, NULL, NULL),
(1092, 71, 79, NULL, NULL),
(1093, 71, 84, NULL, NULL),
(1094, 72, 3, NULL, NULL),
(1095, 72, 6, NULL, NULL),
(1096, 72, 14, NULL, NULL),
(1097, 72, 28, NULL, NULL),
(1098, 72, 29, NULL, NULL),
(1099, 72, 31, NULL, NULL),
(1100, 72, 38, NULL, NULL),
(1101, 72, 41, NULL, NULL),
(1102, 72, 61, NULL, NULL),
(1103, 72, 65, NULL, NULL),
(1104, 72, 66, NULL, NULL),
(1105, 72, 67, NULL, NULL),
(1106, 72, 68, NULL, NULL),
(1107, 72, 69, NULL, NULL),
(1108, 72, 77, NULL, NULL),
(1109, 72, 79, NULL, NULL),
(1110, 73, 5, NULL, NULL),
(1111, 73, 6, NULL, NULL),
(1112, 73, 11, NULL, NULL),
(1113, 73, 13, NULL, NULL),
(1114, 73, 14, NULL, NULL),
(1115, 73, 17, NULL, NULL),
(1116, 73, 22, NULL, NULL),
(1117, 73, 25, NULL, NULL),
(1118, 73, 26, NULL, NULL),
(1119, 73, 27, NULL, NULL),
(1120, 73, 29, NULL, NULL),
(1121, 73, 30, NULL, NULL),
(1122, 73, 33, NULL, NULL),
(1123, 73, 34, NULL, NULL),
(1124, 73, 39, NULL, NULL),
(1125, 73, 41, NULL, NULL),
(1126, 73, 42, NULL, NULL),
(1127, 73, 53, NULL, NULL),
(1128, 73, 65, NULL, NULL),
(1129, 73, 66, NULL, NULL),
(1130, 73, 68, NULL, NULL),
(1131, 73, 82, NULL, NULL),
(1132, 74, 2, NULL, NULL),
(1133, 74, 3, NULL, NULL),
(1134, 74, 6, NULL, NULL),
(1135, 74, 14, NULL, NULL),
(1136, 74, 26, NULL, NULL),
(1137, 74, 31, NULL, NULL),
(1138, 74, 49, NULL, NULL),
(1139, 74, 61, NULL, NULL),
(1140, 74, 65, NULL, NULL),
(1141, 74, 67, NULL, NULL),
(1142, 74, 69, NULL, NULL),
(1143, 74, 79, NULL, NULL),
(1144, 75, 6, NULL, NULL),
(1145, 75, 30, NULL, NULL),
(1146, 75, 38, NULL, NULL),
(1147, 75, 40, NULL, NULL),
(1148, 75, 61, NULL, NULL),
(1149, 75, 65, NULL, NULL),
(1150, 75, 67, NULL, NULL),
(1151, 75, 69, NULL, NULL),
(1152, 75, 82, NULL, NULL),
(1153, 75, 86, NULL, NULL),
(1154, 75, 87, NULL, NULL),
(1155, 75, 88, NULL, NULL),
(1156, 75, 89, NULL, NULL),
(1157, 75, 90, NULL, NULL),
(1158, 75, 91, NULL, NULL),
(1159, 75, 92, NULL, NULL),
(1160, 75, 93, NULL, NULL),
(1161, 75, 94, NULL, NULL),
(1162, 75, 95, NULL, NULL),
(1163, 76, 6, NULL, NULL),
(1164, 76, 9, NULL, NULL),
(1165, 76, 10, NULL, NULL),
(1166, 76, 14, NULL, NULL),
(1167, 76, 22, NULL, NULL),
(1168, 76, 25, NULL, NULL),
(1169, 76, 27, NULL, NULL),
(1170, 76, 29, NULL, NULL),
(1171, 76, 30, NULL, NULL),
(1172, 76, 35, NULL, NULL),
(1173, 76, 39, NULL, NULL),
(1174, 76, 55, NULL, NULL),
(1175, 76, 58, NULL, NULL),
(1176, 76, 61, NULL, NULL),
(1177, 76, 63, NULL, NULL),
(1178, 76, 65, NULL, NULL),
(1179, 76, 67, NULL, NULL),
(1180, 76, 69, NULL, NULL),
(1181, 77, 5, NULL, NULL),
(1182, 77, 11, NULL, NULL),
(1183, 77, 14, NULL, NULL),
(1184, 77, 22, NULL, NULL),
(1185, 77, 25, NULL, NULL),
(1186, 77, 26, NULL, NULL),
(1187, 77, 29, NULL, NULL),
(1188, 77, 31, NULL, NULL),
(1189, 77, 34, NULL, NULL),
(1190, 77, 37, NULL, NULL),
(1191, 77, 38, NULL, NULL),
(1192, 77, 41, NULL, NULL),
(1193, 77, 65, NULL, NULL),
(1194, 77, 67, NULL, NULL),
(1195, 77, 69, NULL, NULL),
(1196, 77, 79, NULL, NULL),
(1197, 77, 81, NULL, NULL),
(1198, 77, 85, NULL, NULL),
(1199, 77, 90, NULL, NULL),
(1200, 78, 3, NULL, NULL),
(1201, 78, 5, NULL, NULL),
(1202, 78, 6, NULL, NULL),
(1203, 78, 13, NULL, NULL),
(1204, 78, 17, NULL, NULL),
(1205, 78, 22, NULL, NULL),
(1206, 78, 25, NULL, NULL),
(1207, 78, 26, NULL, NULL),
(1208, 78, 29, NULL, NULL),
(1209, 78, 35, NULL, NULL),
(1210, 78, 37, NULL, NULL),
(1211, 78, 38, NULL, NULL),
(1212, 78, 41, NULL, NULL),
(1213, 78, 47, NULL, NULL),
(1214, 78, 51, NULL, NULL),
(1215, 78, 53, NULL, NULL),
(1216, 78, 60, NULL, NULL),
(1217, 78, 67, NULL, NULL),
(1218, 78, 68, NULL, NULL),
(1219, 78, 69, NULL, NULL),
(1220, 78, 72, NULL, NULL),
(1221, 78, 76, NULL, NULL),
(1222, 78, 95, NULL, NULL),
(1223, 79, 6, NULL, NULL),
(1224, 79, 10, NULL, NULL),
(1225, 79, 14, NULL, NULL),
(1226, 79, 41, NULL, NULL),
(1227, 79, 46, NULL, NULL),
(1228, 79, 54, NULL, NULL),
(1229, 79, 59, NULL, NULL),
(1230, 79, 79, NULL, NULL),
(1231, 80, 5, NULL, NULL),
(1232, 80, 6, NULL, NULL),
(1233, 80, 11, NULL, NULL),
(1234, 80, 13, NULL, NULL),
(1235, 80, 14, NULL, NULL),
(1236, 80, 25, NULL, NULL),
(1237, 80, 27, NULL, NULL),
(1238, 80, 28, NULL, NULL),
(1239, 80, 29, NULL, NULL),
(1240, 80, 30, NULL, NULL),
(1241, 80, 31, NULL, NULL),
(1242, 80, 34, NULL, NULL),
(1243, 80, 39, NULL, NULL),
(1244, 80, 41, NULL, NULL),
(1245, 80, 47, NULL, NULL),
(1246, 80, 53, NULL, NULL),
(1247, 80, 61, NULL, NULL),
(1248, 80, 65, NULL, NULL),
(1249, 80, 67, NULL, NULL),
(1250, 80, 68, NULL, NULL),
(1251, 80, 69, NULL, NULL),
(1252, 80, 76, NULL, NULL),
(1253, 81, 3, NULL, NULL),
(1254, 81, 6, NULL, NULL),
(1255, 81, 10, NULL, NULL),
(1256, 81, 11, NULL, NULL),
(1257, 81, 13, NULL, NULL),
(1258, 81, 25, NULL, NULL),
(1259, 81, 28, NULL, NULL),
(1260, 81, 29, NULL, NULL),
(1261, 81, 31, NULL, NULL),
(1262, 81, 34, NULL, NULL),
(1263, 81, 37, NULL, NULL),
(1264, 81, 41, NULL, NULL),
(1265, 81, 47, NULL, NULL),
(1266, 81, 67, NULL, NULL),
(1267, 81, 69, NULL, NULL),
(1268, 81, 79, NULL, NULL),
(1269, 81, 90, NULL, NULL),
(1270, 81, 93, NULL, NULL),
(1271, 82, 3, NULL, NULL),
(1272, 82, 6, NULL, NULL),
(1273, 82, 10, NULL, NULL),
(1274, 82, 11, NULL, NULL),
(1275, 82, 14, NULL, NULL),
(1276, 82, 29, NULL, NULL),
(1277, 82, 39, NULL, NULL),
(1278, 82, 41, NULL, NULL),
(1279, 82, 47, NULL, NULL),
(1280, 82, 65, NULL, NULL),
(1281, 82, 67, NULL, NULL),
(1282, 82, 76, NULL, NULL),
(1283, 82, 96, NULL, NULL),
(1284, 83, 5, NULL, NULL),
(1285, 83, 6, NULL, NULL),
(1286, 83, 11, NULL, NULL),
(1287, 83, 14, NULL, NULL),
(1288, 83, 18, NULL, NULL),
(1289, 83, 25, NULL, NULL),
(1290, 83, 27, NULL, NULL),
(1291, 83, 28, NULL, NULL),
(1292, 83, 29, NULL, NULL),
(1293, 83, 37, NULL, NULL),
(1294, 83, 38, NULL, NULL),
(1295, 83, 40, NULL, NULL),
(1296, 83, 41, NULL, NULL),
(1297, 83, 47, NULL, NULL),
(1298, 83, 53, NULL, NULL),
(1299, 83, 60, NULL, NULL),
(1300, 83, 61, NULL, NULL),
(1301, 83, 65, NULL, NULL),
(1302, 83, 66, NULL, NULL),
(1303, 83, 69, NULL, NULL),
(1304, 83, 90, NULL, NULL),
(1305, 83, 96, NULL, NULL),
(1306, 84, 6, NULL, NULL),
(1307, 84, 7, NULL, NULL),
(1308, 84, 11, NULL, NULL),
(1309, 84, 12, NULL, NULL),
(1310, 84, 25, NULL, NULL),
(1311, 84, 26, NULL, NULL),
(1312, 84, 27, NULL, NULL),
(1313, 84, 28, NULL, NULL),
(1314, 84, 29, NULL, NULL),
(1315, 84, 31, NULL, NULL),
(1316, 84, 34, NULL, NULL),
(1317, 84, 37, NULL, NULL),
(1318, 84, 38, NULL, NULL),
(1319, 84, 39, NULL, NULL),
(1320, 84, 40, NULL, NULL),
(1321, 84, 41, NULL, NULL),
(1322, 84, 53, NULL, NULL),
(1323, 84, 67, NULL, NULL),
(1324, 84, 68, NULL, NULL),
(1325, 84, 69, NULL, NULL),
(1326, 84, 81, NULL, NULL),
(1327, 84, 90, NULL, NULL),
(1328, 84, 93, NULL, NULL),
(1329, 84, 95, NULL, NULL),
(1330, 87, 5, NULL, NULL),
(1331, 87, 6, NULL, NULL),
(1332, 87, 13, NULL, NULL),
(1333, 87, 14, NULL, NULL),
(1334, 87, 17, NULL, NULL),
(1335, 87, 22, NULL, NULL),
(1336, 87, 25, NULL, NULL),
(1337, 87, 26, NULL, NULL),
(1338, 87, 27, NULL, NULL),
(1339, 87, 35, NULL, NULL),
(1340, 87, 36, NULL, NULL),
(1341, 87, 37, NULL, NULL),
(1342, 87, 38, NULL, NULL),
(1343, 87, 39, NULL, NULL),
(1344, 87, 47, NULL, NULL),
(1345, 87, 49, NULL, NULL),
(1346, 87, 53, NULL, NULL),
(1347, 87, 57, NULL, NULL),
(1348, 87, 60, NULL, NULL),
(1349, 87, 64, NULL, NULL),
(1350, 87, 65, NULL, NULL),
(1351, 87, 66, NULL, NULL),
(1352, 87, 67, NULL, NULL),
(1353, 87, 68, NULL, NULL),
(1354, 87, 69, NULL, NULL),
(1355, 87, 70, NULL, NULL),
(1356, 87, 73, NULL, NULL),
(1357, 87, 76, NULL, NULL),
(1358, 87, 77, NULL, NULL),
(1359, 87, 81, NULL, NULL),
(1360, 87, 83, NULL, NULL),
(1361, 87, 90, NULL, NULL),
(1362, 87, 93, NULL, NULL),
(1363, 88, 6, NULL, NULL),
(1364, 88, 9, NULL, NULL),
(1365, 88, 11, NULL, NULL),
(1366, 88, 13, NULL, NULL),
(1367, 88, 14, NULL, NULL),
(1368, 88, 17, NULL, NULL),
(1369, 88, 25, NULL, NULL),
(1370, 88, 26, NULL, NULL),
(1371, 88, 27, NULL, NULL),
(1372, 88, 29, NULL, NULL),
(1373, 88, 31, NULL, NULL),
(1374, 88, 34, NULL, NULL),
(1375, 88, 35, NULL, NULL),
(1376, 88, 36, NULL, NULL),
(1377, 88, 37, NULL, NULL),
(1378, 88, 38, NULL, NULL),
(1379, 88, 40, NULL, NULL),
(1380, 88, 47, NULL, NULL),
(1381, 88, 53, NULL, NULL),
(1382, 88, 60, NULL, NULL),
(1383, 88, 62, NULL, NULL),
(1384, 88, 65, NULL, NULL),
(1385, 88, 66, NULL, NULL),
(1386, 88, 67, NULL, NULL),
(1387, 88, 68, NULL, NULL),
(1388, 88, 69, NULL, NULL),
(1389, 88, 81, NULL, NULL),
(1390, 88, 88, NULL, NULL),
(1391, 88, 90, NULL, NULL),
(1392, 88, 93, NULL, NULL),
(1393, 89, 6, NULL, NULL),
(1394, 89, 11, NULL, NULL),
(1395, 89, 13, NULL, NULL),
(1396, 89, 14, NULL, NULL),
(1397, 89, 18, NULL, NULL),
(1398, 89, 25, NULL, NULL),
(1399, 89, 31, NULL, NULL),
(1400, 89, 32, NULL, NULL),
(1401, 89, 34, NULL, NULL),
(1402, 89, 37, NULL, NULL),
(1403, 89, 38, NULL, NULL),
(1404, 89, 39, NULL, NULL),
(1405, 89, 41, NULL, NULL),
(1406, 89, 53, NULL, NULL),
(1407, 89, 55, NULL, NULL),
(1408, 89, 60, NULL, NULL),
(1409, 89, 62, NULL, NULL),
(1410, 89, 68, NULL, NULL),
(1411, 89, 69, NULL, NULL),
(1412, 89, 90, NULL, NULL),
(1413, 89, 93, NULL, NULL),
(1414, 90, 6, NULL, NULL),
(1415, 90, 7, NULL, NULL),
(1416, 90, 11, NULL, NULL),
(1417, 90, 13, NULL, NULL),
(1418, 90, 14, NULL, NULL),
(1419, 90, 17, NULL, NULL),
(1420, 90, 25, NULL, NULL),
(1421, 90, 28, NULL, NULL),
(1422, 90, 29, NULL, NULL),
(1423, 90, 37, NULL, NULL),
(1424, 90, 38, NULL, NULL),
(1425, 90, 41, NULL, NULL),
(1426, 90, 47, NULL, NULL),
(1427, 90, 66, NULL, NULL),
(1428, 90, 69, NULL, NULL),
(1429, 90, 79, NULL, NULL),
(1430, 90, 93, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_categories`
--

CREATE TABLE `property_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_categories`
--

INSERT INTO `property_categories` (`id`, `name`, `slug`, `heading`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Residential', 'residential', 'Residential Properties', '<h3>Find Your Dream Home</h3><p>Discover a wide range of residential properties including apartments, houses, villas, and condominiums. Whether you\'re looking for your first home, upgrading to a larger space, or investing in real estate, we have the perfect residential property for you.</p><h4>Property Types:</h4><ul><li>Apartments & Condos</li><li>Single Family Homes</li><li>Townhouses</li><li>Villas & Luxury Homes</li><li>Duplexes & Multi-family</li></ul><p>Our residential properties are located in prime areas with excellent amenities, schools, and transportation links.</p>', 1, '2025-09-22 22:13:14', '2025-09-22 22:13:14'),
(2, 'Commercial', 'commercial', 'Commercial Properties', '<h3>Grow Your Business</h3><p>Explore our extensive portfolio of commercial properties including office spaces, retail units, warehouses, and industrial facilities. Perfect for businesses looking to establish or expand their operations in prime locations.</p><h4>Property Types:</h4><ul><li>Office Buildings &amp; Spaces</li><li>Retail Shops &amp; Malls</li><li>Warehouses &amp; Industrial</li><li>Restaurants &amp; Hotels</li><li>Medical &amp; Professional Centers</li></ul><p>Our commercial properties offer excellent visibility, accessibility, and growth potential for your business ventures.</p>', 1, '2025-09-22 22:13:14', '2025-10-04 12:09:12'),
(3, 'Happy Homes', 'happy-homes', 'Happy Homes Collection', '<h3>Where Happiness Lives</h3><p>Welcome to our exclusive Happy Homes collection - carefully curated properties that offer the perfect blend of comfort, style, and functionality. These special properties are designed to bring joy and satisfaction to their residents.</p><h4>Special Features:</h4><ul><li>Premium Locations</li><li>Modern Amenities</li><li>Eco-Friendly Design</li><li>Smart Home Technology</li><li>Community Living</li></ul><p>Each Happy Home is selected for its unique character, excellent condition, and potential to create lasting memories for families and individuals alike.</p>', 1, '2025-09-22 22:13:14', '2025-09-22 22:13:14'),
(4, 'Rental', 'rental', NULL, NULL, 1, '2025-10-04 12:09:16', '2025-10-04 12:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `property_conditions`
--

CREATE TABLE `property_conditions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_conditions`
--

INSERT INTO `property_conditions` (`id`, `name`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'New', 'new', 1, '2025-09-22 23:35:03', '2025-09-22 23:35:03'),
(2, 'Resale', 'resale', 1, '2025-09-22 23:35:03', '2025-09-22 23:35:03');

-- --------------------------------------------------------

--
-- Table structure for table `property_faqs`
--

CREATE TABLE `property_faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `property_id` bigint UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` bigint UNSIGNED NOT NULL,
  `property_id` bigint UNSIGNED NOT NULL,
  `type` enum('logo','project','floor_plan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'project',
  `alt_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_banner` tinyint(1) NOT NULL DEFAULT '0',
  `is_thumbnail` tinyint(1) NOT NULL DEFAULT '0',
  `is_thumbnail_2` tinyint(1) NOT NULL DEFAULT '0',
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_images`
--

INSERT INTO `property_images` (`id`, `property_id`, `type`, `alt_type`, `image_path`, `caption`, `is_banner`, `is_thumbnail`, `is_thumbnail_2`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(7, 1, 'project', '', 'properties/1/project/f36ba9c4-354e-4a67-9cc5-be1cec3c7310.jpeg', '', 0, 0, 0, 1, 1, '2025-09-30 23:06:24', '2025-09-30 23:06:24'),
(8, 1, 'project', '', 'properties/1/project/6b740b7d-0696-435d-9bbe-749a771b276e.jpeg', '', 0, 0, 0, 2, 1, '2025-09-30 23:06:25', '2025-09-30 23:06:25'),
(9, 1, 'project', '', 'properties/1/project/fad8d065-33fc-43b9-a55b-99f00c24197d.jpeg', '', 0, 0, 0, 3, 1, '2025-09-30 23:06:25', '2025-09-30 23:06:25'),
(10, 1, 'project', '', 'properties/1/project/a02d49cb-a1d7-4f1c-b30c-d86fcd0c664e.jpeg', '', 0, 0, 0, 4, 1, '2025-09-30 23:06:26', '2025-09-30 23:06:26'),
(11, 1, 'project', '', 'properties/1/project/9a34dfaf-9007-46b4-824f-1bd7424780d6.jpeg', '', 0, 0, 0, 5, 1, '2025-09-30 23:06:27', '2025-09-30 23:06:27'),
(12, 1, 'project', '', 'properties/1/project/0732f492-206a-4292-971b-bcd9bc146a80.jpeg', '', 0, 0, 0, 6, 1, '2025-09-30 23:06:27', '2025-09-30 23:06:27'),
(13, 1, 'project', '', 'properties/1/project/ab6233da-6e1a-438e-946b-f67f62bd66bb.jpeg', '', 0, 0, 0, 7, 1, '2025-09-30 23:06:28', '2025-09-30 23:06:28'),
(14, 1, 'project', '', 'properties/1/project/23a15881-41a9-415e-badf-dccf0f4778fa.jpeg', '', 0, 0, 0, 8, 1, '2025-09-30 23:06:28', '2025-09-30 23:06:28'),
(15, 1, 'project', '', 'properties/1/project/da5a254e-063b-4744-9878-99241a452428.jpeg', '', 0, 0, 0, 9, 1, '2025-09-30 23:06:29', '2025-09-30 23:06:29'),
(16, 1, 'project', '', 'properties/1/project/60baa51b-386e-4623-aaf2-41fb8b3a2c23.jpeg', '', 0, 0, 0, 10, 1, '2025-09-30 23:06:30', '2025-09-30 23:06:30'),
(17, 1, 'project', '', 'properties/1/project/ad2cd66e-b5e9-4341-b175-fb99a5875a70.jpeg', '', 0, 0, 0, 11, 1, '2025-09-30 23:06:30', '2025-09-30 23:06:30'),
(18, 1, 'project', '', 'properties/1/project/bfad30a8-5be5-4947-b873-33115ab543d7.jpeg', '', 0, 0, 0, 12, 1, '2025-09-30 23:06:31', '2025-09-30 23:06:31'),
(19, 2, 'project', '', 'properties/2/project/fde4ef0a-a75d-4991-9261-6aab9e8df995.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:06:32', '2025-09-30 23:06:32'),
(20, 2, 'project', '', 'properties/2/project/9481a016-d8f9-47f6-940f-549117227cb1.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:06:33', '2025-09-30 23:06:33'),
(21, 2, 'project', '', 'properties/2/project/8ae9260b-3a34-478a-8c4f-6af117729faf.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:06:34', '2025-09-30 23:06:34'),
(22, 2, 'project', '', 'properties/2/project/7800c8b1-526e-4242-826e-6a8d22b2a18f.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:06:34', '2025-09-30 23:06:34'),
(23, 2, 'project', '', 'properties/2/project/c545268a-2ecf-4864-91d1-c8fd31c26dcc.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:06:35', '2025-09-30 23:06:35'),
(24, 2, 'project', '', 'properties/2/project/1c1225ed-78f7-4875-9b9c-06604188d8d4.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:06:36', '2025-09-30 23:06:36'),
(25, 3, 'project', '', 'properties/3/project/2793b17b-1076-423e-a000-e5b8f6e2a65f.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:06:37', '2025-09-30 23:06:37'),
(26, 3, 'project', '', 'properties/3/project/3d3ad416-d6cc-4d13-9aca-d71e7db2c029.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:06:38', '2025-09-30 23:06:38'),
(27, 3, 'project', '', 'properties/3/project/8b230863-9c2b-41bb-b529-38c2b1c9f760.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:06:39', '2025-09-30 23:06:39'),
(28, 3, 'project', '', 'properties/3/project/6828e6ca-68b1-47c3-b11b-d5b91f520c8d.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:06:39', '2025-09-30 23:06:39'),
(29, 3, 'project', '', 'properties/3/project/9e40e877-1737-4823-adfe-ec33f47a048e.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:06:40', '2025-09-30 23:06:40'),
(30, 3, 'project', '', 'properties/3/project/ab7771e8-7c1b-49a4-8fc6-b7ad413ee49e.png', '', 0, 0, 0, 6, 1, '2025-09-30 23:06:41', '2025-09-30 23:06:41'),
(31, 3, 'project', '', 'properties/3/project/43ffd767-7504-4138-9d30-d60b858427f2.png', '', 0, 0, 0, 7, 1, '2025-09-30 23:06:42', '2025-09-30 23:06:42'),
(32, 3, 'project', '', 'properties/3/project/fc1b9a5c-6a9e-4d05-9f8f-9cfe4410cb98.png', '', 0, 0, 0, 8, 1, '2025-09-30 23:06:42', '2025-09-30 23:06:42'),
(33, 4, 'project', '', 'properties/4/project/8c2e2259-7857-4941-975f-67dd7d1a251e.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:06:44', '2025-09-30 23:06:44'),
(34, 4, 'project', '', 'properties/4/project/a4f1b62a-88d7-4931-8143-04287f4f553c.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:06:44', '2025-09-30 23:06:44'),
(35, 1, 'project', '', 'properties/1/project/c966ffc9-a809-439a-aaf4-a73803db53b1.jpeg', '', 0, 0, 0, 13, 1, '2025-09-30 23:06:49', '2025-09-30 23:06:49'),
(36, 1, 'project', '', 'properties/1/project/feb717d7-a717-4706-b7a2-03e44d51dc4f.jpeg', '', 0, 0, 0, 14, 1, '2025-09-30 23:06:49', '2025-09-30 23:06:49'),
(37, 1, 'project', '', 'properties/1/project/4975eaaf-a0fc-4682-9994-d6eb0689df17.jpeg', '', 0, 0, 0, 15, 1, '2025-09-30 23:06:50', '2025-09-30 23:06:50'),
(38, 1, 'project', '', 'properties/1/project/1d1705ab-e28e-4071-a2ab-851ba14fb752.jpeg', '', 0, 0, 0, 16, 1, '2025-09-30 23:06:51', '2025-09-30 23:06:51'),
(39, 1, 'project', '', 'properties/1/project/b57da752-c192-42f9-934e-a4e651afbb62.jpeg', '', 0, 0, 0, 17, 1, '2025-09-30 23:06:51', '2025-09-30 23:06:51'),
(40, 1, 'project', '', 'properties/1/project/5de2fe1d-a191-4c6f-aa23-74371874d579.jpeg', '', 0, 0, 0, 18, 1, '2025-09-30 23:06:52', '2025-09-30 23:06:52'),
(41, 1, 'project', '', 'properties/1/project/bfc9cfcf-65d0-45d8-8609-01b1c4fd77e7.jpeg', '', 0, 0, 0, 19, 1, '2025-09-30 23:06:53', '2025-09-30 23:06:53'),
(42, 1, 'project', '', 'properties/1/project/72378ada-c9d2-455c-a143-d4f5cc573f32.jpeg', '', 0, 0, 0, 20, 1, '2025-09-30 23:06:53', '2025-09-30 23:06:53'),
(43, 1, 'project', '', 'properties/1/project/4f625ca2-0064-4eb8-aeb0-66ede1894d1d.jpeg', '', 0, 0, 0, 21, 1, '2025-09-30 23:06:54', '2025-09-30 23:06:54'),
(44, 1, 'project', '', 'properties/1/project/53336c48-9627-4ac9-b242-1e1e79ad8ef3.jpeg', '', 0, 0, 0, 22, 1, '2025-09-30 23:06:55', '2025-09-30 23:06:55'),
(45, 1, 'project', '', 'properties/1/project/30625648-b06a-40a2-af91-bbfbe033fecc.jpeg', '', 0, 0, 0, 23, 1, '2025-09-30 23:06:56', '2025-09-30 23:06:56'),
(46, 1, 'project', '', 'properties/1/project/81d8de46-671b-45d6-9944-9ccbd27ba679.jpeg', '', 0, 0, 0, 24, 1, '2025-09-30 23:06:57', '2025-09-30 23:06:57'),
(47, 2, 'project', '', 'properties/2/project/8bb36097-f53a-479f-a402-c036f29d0b3e.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:06:58', '2025-09-30 23:06:58'),
(48, 2, 'project', '', 'properties/2/project/ba809530-2621-4381-b8ec-b6d22d2cb159.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:06:59', '2025-09-30 23:06:59'),
(49, 2, 'project', '', 'properties/2/project/5c12166f-d3c1-448f-9ceb-c673dfc0fe63.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:07:00', '2025-09-30 23:07:00'),
(50, 2, 'project', '', 'properties/2/project/8fcc6667-82c9-4476-979f-93dd4b0e5ee9.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:07:00', '2025-09-30 23:07:00'),
(51, 2, 'project', '', 'properties/2/project/bd275eb0-91c3-4c10-9578-d56ae47e1aa9.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:07:01', '2025-09-30 23:07:01'),
(52, 2, 'project', '', 'properties/2/project/c0f05143-2e09-43c0-9695-db872eeaee35.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:07:01', '2025-09-30 23:07:01'),
(53, 3, 'project', '', 'properties/3/project/de848fcc-d148-4fd5-8cb7-9f35a35caed2.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:07:03', '2025-09-30 23:07:03'),
(54, 3, 'project', '', 'properties/3/project/e85658c5-71d0-4677-a3db-471d0d47e445.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:07:03', '2025-09-30 23:07:03'),
(55, 3, 'project', '', 'properties/3/project/927614d4-00a7-4cad-ba98-98292463f8f2.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:07:04', '2025-09-30 23:07:04'),
(56, 3, 'project', '', 'properties/3/project/7dbb2667-1750-4a16-8258-1d8e4ad35b01.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:07:05', '2025-09-30 23:07:05'),
(57, 3, 'project', '', 'properties/3/project/db6dc2f1-da79-4673-a4cf-77e24f4f9e99.jpg', '', 0, 0, 0, 13, 1, '2025-09-30 23:07:05', '2025-09-30 23:07:05'),
(58, 3, 'project', '', 'properties/3/project/3bc72208-6f75-4b7c-961d-31de2897834f.png', '', 0, 0, 0, 14, 1, '2025-09-30 23:07:06', '2025-09-30 23:07:06'),
(59, 3, 'project', '', 'properties/3/project/bf70f338-2245-4ea7-81ca-113f154d52bf.png', '', 0, 0, 0, 15, 1, '2025-09-30 23:07:07', '2025-09-30 23:07:07'),
(60, 3, 'project', '', 'properties/3/project/a341b5be-cfe5-4859-8173-14cf2648fe49.png', '', 0, 0, 0, 16, 1, '2025-09-30 23:07:08', '2025-09-30 23:07:08'),
(61, 1, 'project', '', 'properties/1/project/2c979c1b-b72a-4ef5-b1db-3016d72654d1.jpeg', '', 0, 0, 0, 25, 1, '2025-09-30 23:07:12', '2025-09-30 23:07:12'),
(62, 1, 'project', '', 'properties/1/project/7181ea5a-1757-4c58-8907-96d37accd06a.jpeg', '', 0, 0, 0, 26, 1, '2025-09-30 23:07:13', '2025-09-30 23:07:13'),
(63, 1, 'project', '', 'properties/1/project/a3a989f2-190e-4bb0-96de-2a64273e2b59.jpeg', '', 0, 0, 0, 27, 1, '2025-09-30 23:07:14', '2025-09-30 23:07:14'),
(64, 1, 'project', '', 'properties/1/project/82d68a86-084e-41f6-9d20-83bf10e1bb7c.jpeg', '', 0, 0, 0, 28, 1, '2025-09-30 23:07:14', '2025-09-30 23:07:14'),
(65, 1, 'project', '', 'properties/1/project/01bd3afc-0c4f-4eb1-a0b4-97777420cdb4.jpeg', '', 0, 0, 0, 29, 1, '2025-09-30 23:07:15', '2025-09-30 23:07:15'),
(66, 1, 'project', '', 'properties/1/project/7907b0f0-436c-4e32-ad2d-ba6495597261.jpeg', '', 0, 0, 0, 30, 1, '2025-09-30 23:07:16', '2025-09-30 23:07:16'),
(67, 1, 'project', '', 'properties/1/project/3ccc7590-93af-413d-b6c2-f34b8bf46766.jpeg', '', 0, 0, 0, 31, 1, '2025-09-30 23:07:16', '2025-09-30 23:07:16'),
(68, 1, 'project', '', 'properties/1/project/d5c09c9d-d32b-450a-8ffc-87ac7abec1af.jpeg', '', 0, 0, 0, 32, 1, '2025-09-30 23:07:17', '2025-09-30 23:07:17'),
(69, 1, 'project', '', 'properties/1/project/4265cb0e-a50d-4c1e-b63d-fe7ea3a8fb99.jpeg', '', 0, 0, 0, 33, 1, '2025-09-30 23:07:18', '2025-09-30 23:07:18'),
(70, 1, 'project', '', 'properties/1/project/c4ca0edd-5f88-40cb-bd04-0e3bf4f236b3.jpeg', '', 0, 0, 0, 34, 1, '2025-09-30 23:07:18', '2025-09-30 23:07:18'),
(71, 1, 'project', '', 'properties/1/project/0ddec8ba-e51b-4bbe-90cd-d71c3cb4cddb.jpeg', '', 0, 0, 0, 35, 1, '2025-09-30 23:07:19', '2025-09-30 23:07:19'),
(72, 1, 'project', '', 'properties/1/project/d42fdea6-f8c5-4091-a64c-7f64c10a50bc.jpeg', '', 0, 0, 0, 36, 1, '2025-09-30 23:07:20', '2025-09-30 23:07:20'),
(73, 2, 'project', '', 'properties/2/project/dd6211f3-2d61-4d56-9010-1eace8762c2f.jpg', '', 0, 0, 0, 13, 1, '2025-09-30 23:07:21', '2025-09-30 23:07:21'),
(74, 2, 'project', '', 'properties/2/project/829ebc0f-3981-41ad-bced-eb165da1be28.jpg', '', 0, 0, 0, 14, 1, '2025-09-30 23:07:22', '2025-09-30 23:07:22'),
(75, 2, 'project', '', 'properties/2/project/0b08f501-f347-472c-805b-76431d993fb5.jpg', '', 0, 0, 0, 15, 1, '2025-09-30 23:07:22', '2025-09-30 23:07:22'),
(76, 2, 'project', '', 'properties/2/project/8311c35f-1114-46e0-afb4-1f31ef792677.jpg', '', 0, 0, 0, 16, 1, '2025-09-30 23:07:23', '2025-09-30 23:07:23'),
(77, 2, 'project', '', 'properties/2/project/8fc4f58e-d086-4e37-848b-d68f99d018db.jpg', '', 0, 0, 0, 17, 1, '2025-09-30 23:07:23', '2025-09-30 23:07:23'),
(78, 2, 'project', '', 'properties/2/project/73d3f5dd-cebd-493f-bcbd-0445ff01547b.jpg', '', 0, 0, 0, 18, 1, '2025-09-30 23:07:24', '2025-09-30 23:07:24'),
(79, 3, 'project', '', 'properties/3/project/cc102f36-135f-4d31-9307-c71d2ef9cf82.jpg', '', 0, 0, 0, 17, 1, '2025-09-30 23:07:25', '2025-09-30 23:07:25'),
(80, 3, 'project', '', 'properties/3/project/4355b5fc-2533-499e-9cc5-4834a4e2cffc.jpg', '', 0, 0, 0, 18, 1, '2025-09-30 23:07:26', '2025-09-30 23:07:26'),
(81, 3, 'project', '', 'properties/3/project/ece9b5f3-6a70-4090-bcd8-d2aa2db26396.jpg', '', 0, 0, 0, 19, 1, '2025-09-30 23:07:27', '2025-09-30 23:07:27'),
(82, 3, 'project', '', 'properties/3/project/a386e5b6-bbfa-4695-bea8-61aebf784686.jpg', '', 0, 0, 0, 20, 1, '2025-09-30 23:07:27', '2025-09-30 23:07:27'),
(83, 3, 'project', '', 'properties/3/project/2c849e47-9b8a-45f2-aabb-b5310ac1f9a7.jpg', '', 0, 0, 0, 21, 1, '2025-09-30 23:07:28', '2025-09-30 23:07:28'),
(84, 3, 'project', '', 'properties/3/project/bc23187b-f06d-4e96-a803-9d7ab344e59e.png', '', 0, 0, 0, 22, 1, '2025-09-30 23:07:30', '2025-09-30 23:07:30'),
(85, 3, 'project', '', 'properties/3/project/60acc2f8-c6ce-4fc2-99dc-d55b36c8cf01.png', '', 0, 0, 0, 23, 1, '2025-09-30 23:07:30', '2025-09-30 23:07:30'),
(86, 3, 'project', '', 'properties/3/project/2daf9146-5c5f-4d5a-a91a-9deded166564.png', '', 0, 0, 0, 24, 1, '2025-09-30 23:07:31', '2025-09-30 23:07:31'),
(87, 4, 'project', '', 'properties/4/project/cefa7f8c-8dbc-49b6-b5ce-01aeb48869f5.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:07:33', '2025-09-30 23:07:33'),
(88, 4, 'project', '', 'properties/4/project/1bf0c6ee-ff19-42d3-b5ae-efcb8336624e.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:07:34', '2025-09-30 23:07:34'),
(89, 4, 'project', '', 'properties/4/project/aab3ac07-11c1-48c7-a399-19aef13c2314.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:07:35', '2025-09-30 23:07:35'),
(90, 4, 'project', '', 'properties/4/project/ca75d0cd-ceec-4305-b50d-51d69b815d6a.png', '', 0, 0, 0, 6, 1, '2025-09-30 23:07:35', '2025-09-30 23:07:35'),
(91, 4, 'project', '', 'properties/4/project/11f1438a-8a38-4b2a-95f1-009e1708dda0.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:07:36', '2025-09-30 23:07:36'),
(92, 4, 'project', '', 'properties/4/project/d40d380b-3325-4049-8823-a4d4c35e0b56.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:07:36', '2025-09-30 23:07:36'),
(93, 4, 'project', '', 'properties/4/project/01aa3572-f994-4147-810b-ed1cbfde0a80.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:07:37', '2025-09-30 23:07:37'),
(94, 4, 'project', '', 'properties/4/project/549ce821-ccc6-45e2-83c2-0e7222639656.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:07:37', '2025-09-30 23:07:37'),
(95, 4, 'project', '', 'properties/4/project/301c4f4c-9af4-430d-9e40-bedb735043ab.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:07:38', '2025-09-30 23:07:38'),
(96, 4, 'project', '', 'properties/4/project/fffac058-ff82-48a6-806a-12b06aa31dcb.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:07:38', '2025-09-30 23:07:38'),
(97, 4, 'project', '', 'properties/4/project/29f0242b-42f4-4558-b848-00789b137d9b.jpg', '', 0, 0, 0, 13, 1, '2025-09-30 23:07:39', '2025-09-30 23:07:39'),
(98, 4, 'project', '', 'properties/4/project/476993e8-ddc0-4bfd-899c-1ca7bc535d54.jpg', '', 0, 0, 0, 14, 1, '2025-09-30 23:07:39', '2025-09-30 23:07:39'),
(99, 5, 'project', '', 'properties/5/project/b1f777c7-d395-4038-ac02-1c4be2f3d9cc.png', '', 0, 0, 0, 1, 1, '2025-09-30 23:07:41', '2025-09-30 23:07:41'),
(100, 5, 'project', '', 'properties/5/project/11be825a-1d1f-4f8b-82d5-2b0d0a556b9c.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:07:41', '2025-09-30 23:07:41'),
(101, 5, 'project', '', 'properties/5/project/8ec28ea6-d7c3-4af2-b05f-3a6c35454e6e.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:07:42', '2025-09-30 23:07:42'),
(102, 5, 'project', '', 'properties/5/project/ebed8777-45f7-42f2-9ae1-ac9af5a39a81.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:07:42', '2025-09-30 23:07:42'),
(103, 5, 'project', '', 'properties/5/project/d84998bf-e3dd-42e1-88bb-157979dd6d0b.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:07:43', '2025-09-30 23:07:43'),
(104, 5, 'project', '', 'properties/5/project/ed960bc8-a629-4826-8461-e163c646ccde.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:07:43', '2025-09-30 23:07:43'),
(105, 5, 'project', '', 'properties/5/project/70770e37-f5ee-48ed-a2e7-a0dbde5662f7.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:07:44', '2025-09-30 23:07:44'),
(106, 5, 'project', '', 'properties/5/project/9b70ca90-a767-4e23-9b78-0de0f89cb185.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:07:44', '2025-09-30 23:07:44'),
(107, 6, 'project', '', 'properties/6/project/17101418-10fc-4802-bcfa-564b3fa5b039.png', '', 0, 0, 0, 1, 1, '2025-09-30 23:07:46', '2025-09-30 23:07:46'),
(108, 6, 'project', '', 'properties/6/project/9d881a8b-cc23-410d-be01-0a9b862589e4.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:07:46', '2025-09-30 23:07:46'),
(109, 6, 'project', '', 'properties/6/project/6326899f-4f83-4b33-b93f-910c0d6ecc1f.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:07:47', '2025-09-30 23:07:47'),
(110, 6, 'project', '', 'properties/6/project/6b1a78b7-32c8-43d8-ac8e-1beb731b5c83.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:07:47', '2025-09-30 23:07:47'),
(119, 8, 'project', '', 'properties/8/project/49c9e964-25a6-4ddf-af22-86593722b5fe.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:07:55', '2025-09-30 23:07:55'),
(120, 8, 'project', '', 'properties/8/project/07dac0b7-f8d2-4f0f-ac13-e0f7ef38a391.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:07:56', '2025-09-30 23:07:56'),
(121, 8, 'project', '', 'properties/8/project/110293f5-f1a6-4de5-978a-05cad7919264.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:07:56', '2025-09-30 23:07:56'),
(122, 8, 'project', '', 'properties/8/project/ca74fff9-55b6-48ff-aef4-19a58d2a72fd.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:07:57', '2025-09-30 23:07:57'),
(123, 9, 'project', '', 'properties/9/project/c3aa8500-25e3-48f1-9b79-569bccd2df79.jpeg', '', 0, 0, 0, 1, 1, '2025-09-30 23:07:58', '2025-09-30 23:07:58'),
(124, 9, 'project', '', 'properties/9/project/a3291493-13a4-4bba-837b-123abeae8859.jpeg', '', 0, 0, 0, 2, 1, '2025-09-30 23:07:59', '2025-09-30 23:07:59'),
(125, 9, 'project', '', 'properties/9/project/efb5f17f-5e7b-4184-b7b3-58e56ff9dc69.jpeg', '', 0, 0, 0, 3, 1, '2025-09-30 23:08:00', '2025-09-30 23:08:00'),
(126, 9, 'project', '', 'properties/9/project/21ab764a-f3f6-4b0b-abb5-878fd7b53f63.jpeg', '', 0, 0, 0, 4, 1, '2025-09-30 23:08:01', '2025-09-30 23:08:01'),
(127, 9, 'project', '', 'properties/9/project/d82c2ff1-50c8-49ad-97c6-ae35445cd949.jpeg', '', 0, 0, 0, 5, 1, '2025-09-30 23:08:01', '2025-09-30 23:08:01'),
(128, 9, 'project', '', 'properties/9/project/9e63b148-9b1d-4c9d-b94a-948b587327f9.jpeg', '', 0, 0, 0, 6, 1, '2025-09-30 23:08:02', '2025-09-30 23:08:02'),
(129, 9, 'project', '', 'properties/9/project/dd3fbb68-dbd9-4323-b21f-a8a52d9915e8.jpeg', '', 0, 0, 0, 7, 1, '2025-09-30 23:08:02', '2025-09-30 23:08:02'),
(130, 9, 'project', '', 'properties/9/project/28156ba6-0acf-410a-9041-7365330b21fc.jpeg', '', 0, 0, 0, 8, 1, '2025-09-30 23:08:03', '2025-09-30 23:08:03'),
(131, 10, 'project', '', 'properties/10/project/86d2e54c-5823-42c3-93ee-f94ff5bd8f35.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:08:04', '2025-09-30 23:08:04'),
(132, 10, 'project', '', 'properties/10/project/82365fd6-4c3a-460a-9c52-68a0899f3460.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:08:05', '2025-09-30 23:08:05'),
(133, 10, 'project', '', 'properties/10/project/98a375e3-2df8-4784-a1a8-296a0ba7982b.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:08:05', '2025-09-30 23:08:05'),
(134, 10, 'project', '', 'properties/10/project/c94f69c0-42a7-40f7-83b7-0515c1ffb289.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:08:06', '2025-09-30 23:08:06'),
(135, 10, 'project', '', 'properties/10/project/109d29ca-c30b-40d8-a2db-b873c12570fb.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:08:07', '2025-09-30 23:08:07'),
(136, 10, 'project', '', 'properties/10/project/1af8cbc0-06e3-4354-8465-61117042ccd1.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:08:07', '2025-09-30 23:08:07'),
(137, 10, 'project', '', 'properties/10/project/31db7a6e-3e29-4b7a-8410-e5eba810a037.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:08:08', '2025-09-30 23:08:08'),
(138, 10, 'project', '', 'properties/10/project/1db9fa0d-1ca0-485f-ac0f-0ec972d3e79a.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:08:08', '2025-09-30 23:08:08'),
(139, 12, 'project', '', 'properties/12/project/74c08ad6-e18a-4403-8f51-1d2a034dbd1a.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:08:11', '2025-09-30 23:08:11'),
(140, 12, 'project', '', 'properties/12/project/e3191a42-3b9d-4028-bee7-c07c9d79b5a7.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:08:12', '2025-09-30 23:08:12'),
(141, 12, 'project', '', 'properties/12/project/812faca2-3382-46d8-81eb-a741c9c7f8ca.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:08:13', '2025-09-30 23:08:13'),
(142, 12, 'project', '', 'properties/12/project/735a9939-a5d4-4ed9-bac8-3b27ada8b0a9.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:08:14', '2025-09-30 23:08:14'),
(143, 12, 'project', '', 'properties/12/project/d7473963-19be-4cd8-9152-893bad9c6f62.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:08:15', '2025-09-30 23:08:15'),
(144, 12, 'project', '', 'properties/12/project/42d46bae-e505-441d-bd70-61818e0dac75.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:08:16', '2025-09-30 23:08:16'),
(145, 12, 'project', '', 'properties/12/project/ae142ed3-b472-4190-a3a9-bd5949712845.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:08:17', '2025-09-30 23:08:17'),
(146, 12, 'project', '', 'properties/12/project/6f10a526-8982-4a35-ad2f-0929aed45784.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:08:18', '2025-09-30 23:08:18'),
(147, 12, 'project', '', 'properties/12/project/9787c5ce-2c75-4d7f-9a10-6ac6867ba8e3.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:08:19', '2025-09-30 23:08:19'),
(148, 12, 'project', '', 'properties/12/project/93099431-74cc-4309-93fa-9d01817f3cc6.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:08:20', '2025-09-30 23:08:20'),
(149, 12, 'project', '', 'properties/12/project/658abda5-6bf0-46f5-aa88-072736f48ade.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:08:21', '2025-09-30 23:08:21'),
(150, 12, 'project', '', 'properties/12/project/e54c41a5-5646-4e86-b3b4-20f29794ac34.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:08:25', '2025-09-30 23:08:25'),
(151, 12, 'project', '', 'properties/12/project/599b6b28-56cd-40ba-958b-65422148d74b.JPG', '', 0, 0, 0, 13, 1, '2025-09-30 23:08:27', '2025-09-30 23:08:27'),
(152, 12, 'project', '', 'properties/12/project/0b830c71-f2da-4b9e-be55-c323b8bf65ec.jpg', '', 0, 0, 0, 14, 1, '2025-09-30 23:08:28', '2025-09-30 23:08:28'),
(153, 12, 'project', '', 'properties/12/project/7ccf943b-9b20-4313-92de-58eb1f7f2e67.jpg', '', 0, 0, 0, 15, 1, '2025-09-30 23:08:28', '2025-09-30 23:08:28'),
(154, 12, 'project', '', 'properties/12/project/eabd2622-131f-4995-926f-2e5034a6892d.jpg', '', 0, 0, 0, 16, 1, '2025-09-30 23:08:29', '2025-09-30 23:08:29'),
(155, 12, 'project', '', 'properties/12/project/4f5aadd5-db65-459a-8243-6cfa7cb2cfcc.jpg', '', 0, 0, 0, 17, 1, '2025-09-30 23:08:30', '2025-09-30 23:08:30'),
(156, 12, 'project', '', 'properties/12/project/0b498458-87a7-4eed-88b7-c2ddaf18464b.jpg', '', 0, 0, 0, 18, 1, '2025-09-30 23:08:30', '2025-09-30 23:08:30'),
(157, 12, 'project', '', 'properties/12/project/87d71486-a937-4bb2-809a-d96681ef5030.jpg', '', 0, 0, 0, 19, 1, '2025-09-30 23:08:31', '2025-09-30 23:08:31'),
(158, 13, 'project', '', 'properties/13/project/31651f31-09f3-43d4-9918-c96712d894cc.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:08:33', '2025-09-30 23:08:33'),
(159, 13, 'project', '', 'properties/13/project/db9cff26-ec1e-4eff-9166-becf4613eb59.png', '', 0, 0, 0, 2, 1, '2025-09-30 23:08:33', '2025-09-30 23:08:33'),
(160, 13, 'project', '', 'properties/13/project/58905ac0-0b6e-4008-a3f0-0eeee987fe8e.png', '', 0, 0, 0, 3, 1, '2025-09-30 23:08:34', '2025-09-30 23:08:34'),
(161, 13, 'project', '', 'properties/13/project/772a937d-fff7-4bd3-952e-20bbd67c4532.png', '', 0, 0, 0, 4, 1, '2025-09-30 23:08:35', '2025-09-30 23:08:35'),
(162, 13, 'project', '', 'properties/13/project/732aa0be-5c16-45ef-8e86-727da4003621.png', '', 0, 0, 0, 5, 1, '2025-09-30 23:08:36', '2025-09-30 23:08:36'),
(163, 13, 'project', '', 'properties/13/project/019f9ee2-4b23-4ae0-ba6f-487d0d9f37cd.png', '', 0, 0, 0, 6, 1, '2025-09-30 23:08:36', '2025-09-30 23:08:36'),
(164, 13, 'project', '', 'properties/13/project/18ceb4d5-f5f2-468f-bc05-2eb08581424f.png', '', 0, 0, 0, 7, 1, '2025-09-30 23:08:37', '2025-09-30 23:08:37'),
(165, 13, 'project', '', 'properties/13/project/510050d7-ccb0-4a63-8a5c-b3a9b75c3b46.png', '', 0, 0, 0, 8, 1, '2025-09-30 23:08:37', '2025-09-30 23:08:37'),
(166, 14, 'project', '', 'properties/14/project/c1c740c1-b475-4890-946c-0fe41c9ba7d4.png', '', 0, 0, 0, 1, 1, '2025-09-30 23:08:39', '2025-09-30 23:08:39'),
(167, 14, 'project', '', 'properties/14/project/fecebe99-c828-40fe-a248-b3ee1704fee8.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:08:39', '2025-09-30 23:08:39'),
(168, 14, 'project', '', 'properties/14/project/f65a7a42-9c19-4a27-8ad7-45a17121ddca.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:08:40', '2025-09-30 23:08:40'),
(169, 14, 'project', '', 'properties/14/project/26ac146e-48b4-4c35-8989-0c9221eae602.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:08:40', '2025-09-30 23:08:40'),
(170, 14, 'project', '', 'properties/14/project/e20bd953-49f9-44ff-a281-7439be9dee0e.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:08:41', '2025-09-30 23:08:41'),
(171, 14, 'project', '', 'properties/14/project/27bcb506-96ef-4a7b-a144-294793919632.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:08:42', '2025-09-30 23:08:42'),
(172, 14, 'project', '', 'properties/14/project/0fd991a2-f737-4ccd-912a-21ff3245181b.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:08:42', '2025-09-30 23:08:42'),
(173, 14, 'project', '', 'properties/14/project/a091ce47-f1d7-4893-89cd-9ec1d68811ee.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:08:43', '2025-09-30 23:08:43'),
(174, 14, 'project', '', 'properties/14/project/6b8475f5-9532-4b76-b6c6-cf99d9878a16.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:08:44', '2025-09-30 23:08:44'),
(175, 14, 'project', '', 'properties/14/project/fe3604bf-e8e4-4eaf-92ca-24c48d933cf8.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:08:44', '2025-09-30 23:08:44'),
(176, 15, 'project', '', 'properties/15/project/9fa34b3d-796b-40df-8b70-b91ca963aba4.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:08:45', '2025-09-30 23:08:45'),
(177, 15, 'project', '', 'properties/15/project/2de0e8a1-3c44-4b1a-bf5e-1bd1b7dbfda0.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:08:46', '2025-09-30 23:08:46'),
(178, 15, 'project', '', 'properties/15/project/36501fb8-54f6-4937-a41f-c652f8dc5539.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:08:46', '2025-09-30 23:08:46'),
(179, 15, 'project', '', 'properties/15/project/cfb5a4c6-e615-4311-9f75-e0063708ff5a.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:08:47', '2025-09-30 23:08:47'),
(180, 15, 'project', '', 'properties/15/project/6c06cd23-046d-4e2d-af40-9915f1f18e29.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:08:47', '2025-09-30 23:08:47'),
(181, 15, 'project', '', 'properties/15/project/727f2c08-12c2-41b3-a330-186b71a0001f.jpeg', '', 0, 0, 0, 6, 1, '2025-09-30 23:08:48', '2025-09-30 23:08:48'),
(182, 16, 'project', '', 'properties/16/project/cdebb13a-fb04-4cbc-aa84-8e8b17f6c852.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:08:49', '2025-09-30 23:08:49'),
(183, 16, 'project', '', 'properties/16/project/6b60bca1-c9ee-4d12-b733-8a1bae886684.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:08:50', '2025-09-30 23:08:50'),
(184, 16, 'project', '', 'properties/16/project/68d63ab2-3648-4e62-8dd1-e07c86a424d1.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:08:51', '2025-09-30 23:08:51'),
(185, 16, 'project', '', 'properties/16/project/b4db33cc-4ea3-4808-9a04-c9dd52438b53.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:08:52', '2025-09-30 23:08:52'),
(186, 16, 'project', '', 'properties/16/project/d9843a6c-4856-4265-a6a2-2107e215f52c.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:08:52', '2025-09-30 23:08:52'),
(187, 16, 'project', '', 'properties/16/project/a8d39d90-6182-4aed-9d08-49ee746e5af3.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:08:53', '2025-09-30 23:08:53'),
(188, 16, 'project', '', 'properties/16/project/1bf1b0f1-ac47-4bb0-84e6-dbcd65a90add.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:08:54', '2025-09-30 23:08:54'),
(189, 16, 'project', '', 'properties/16/project/5acf9aa8-b410-4ea4-beae-068bab63d9f0.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:08:55', '2025-09-30 23:08:55'),
(190, 17, 'project', '', 'properties/17/project/bd416c9a-64c3-49fa-b103-695e77b42fb3.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:08:57', '2025-09-30 23:08:57'),
(191, 17, 'project', '', 'properties/17/project/31665205-bec8-40d5-ac02-d7b7e2ea013e.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:08:58', '2025-09-30 23:08:58'),
(192, 17, 'project', '', 'properties/17/project/1a375040-15bc-4745-b893-e1c3c8b45307.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:08:59', '2025-09-30 23:08:59'),
(193, 17, 'project', '', 'properties/17/project/9e14bbbb-a55e-41a1-82e8-a3185fbe62c6.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:08:59', '2025-09-30 23:08:59'),
(194, 17, 'project', '', 'properties/17/project/3e7978db-9df4-4d22-b9e0-4fab7694b726.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:09:00', '2025-09-30 23:09:00'),
(195, 17, 'project', '', 'properties/17/project/ddcb27c8-d568-45ec-8b3e-d8f2ae91d9d2.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:09:01', '2025-09-30 23:09:01'),
(196, 17, 'project', '', 'properties/17/project/07dc00de-88fd-438e-92a1-e98c11523caa.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:09:02', '2025-09-30 23:09:02'),
(197, 17, 'project', '', 'properties/17/project/61ece840-119a-4eb5-93a8-a709f4bf292b.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:09:03', '2025-09-30 23:09:03'),
(198, 17, 'project', '', 'properties/17/project/368b9b80-b73f-4587-978a-87ecb52dff31.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:09:04', '2025-09-30 23:09:04'),
(199, 17, 'project', '', 'properties/17/project/73685543-c3d5-443c-83bc-0b533b273782.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:09:04', '2025-09-30 23:09:04'),
(200, 17, 'project', '', 'properties/17/project/cc5c52ce-1428-4d76-b3ba-071546661bfc.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:09:05', '2025-09-30 23:09:05'),
(201, 18, 'project', '', 'properties/18/project/beda3041-4d9b-4bce-b97b-bb3794a5773d.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:09:06', '2025-09-30 23:09:06'),
(202, 18, 'project', '', 'properties/18/project/a17c1b90-8bca-4fe0-874a-a16cdd8bf0c1.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:09:07', '2025-09-30 23:09:07'),
(203, 18, 'project', '', 'properties/18/project/5a3e446d-497e-42c5-a0ce-dfe551382cd5.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:09:07', '2025-09-30 23:09:07'),
(204, 18, 'project', '', 'properties/18/project/7d6c24ad-4fcd-4f5f-9d8e-e03a889b89d6.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:09:08', '2025-09-30 23:09:08'),
(205, 18, 'project', '', 'properties/18/project/38524993-f3f8-46ce-848c-f94c00cf3ec8.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:09:08', '2025-09-30 23:09:08'),
(206, 18, 'project', '', 'properties/18/project/b9915d7b-7c2e-4be6-a5fd-4602907f163f.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:09:09', '2025-09-30 23:09:09'),
(207, 18, 'project', '', 'properties/18/project/f43cc6b4-2a15-497b-849f-c10c9d0cda4a.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:09:10', '2025-09-30 23:09:10'),
(208, 18, 'project', '', 'properties/18/project/ca74452c-6c40-4a74-9332-4322873eb365.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:09:11', '2025-09-30 23:09:11'),
(209, 18, 'project', '', 'properties/18/project/683671c6-4ed7-4514-a154-d528a133ad34.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:09:12', '2025-09-30 23:09:12'),
(210, 18, 'project', '', 'properties/18/project/32d107bc-fc77-4827-99e4-09c97167d78c.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:09:12', '2025-09-30 23:09:12'),
(211, 18, 'project', '', 'properties/18/project/616c1242-41f0-455c-8374-151c55b6cd62.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:09:13', '2025-09-30 23:09:13'),
(212, 18, 'project', '', 'properties/18/project/b3153c2a-3b47-4d48-8598-04113aa4d595.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:09:14', '2025-09-30 23:09:14'),
(213, 19, 'project', '', 'properties/19/project/7da987a0-6176-485b-a814-58c63782687e.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:09:15', '2025-09-30 23:09:15'),
(214, 19, 'project', '', 'properties/19/project/5130342a-6e75-40ee-83d4-96e8dfc51ad7.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:09:16', '2025-09-30 23:09:16'),
(215, 19, 'project', '', 'properties/19/project/ca10a212-123a-467f-9ff5-fae1bf753e74.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:09:17', '2025-09-30 23:09:17'),
(216, 19, 'project', '', 'properties/19/project/cffa2bee-2155-40a3-850d-939164e21e14.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:09:17', '2025-09-30 23:09:17'),
(217, 19, 'project', '', 'properties/19/project/546c3563-0ae6-4abf-a247-5fb7516b7fb9.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:09:19', '2025-09-30 23:09:19'),
(218, 19, 'project', '', 'properties/19/project/16364ac5-0978-4f24-b663-c5e75f36cccd.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:09:20', '2025-09-30 23:09:20'),
(219, 19, 'project', '', 'properties/19/project/26d70494-099e-4e29-b7db-f38b26f1b2e4.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:09:21', '2025-09-30 23:09:21'),
(220, 19, 'project', '', 'properties/19/project/17ad3b45-ce80-4864-93f4-6f566cb1a6f0.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:09:22', '2025-09-30 23:09:22'),
(221, 20, 'project', '', 'properties/20/project/07206112-7098-4a35-b8b4-08aa83cfa9e1.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:09:23', '2025-09-30 23:09:23'),
(222, 20, 'project', '', 'properties/20/project/e4ffadf2-7d53-44d1-97e7-ead594bd4eeb.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:09:24', '2025-09-30 23:09:24'),
(223, 21, 'project', '', 'properties/21/project/5fcff2fc-ebdb-4685-8524-9f835416ba3f.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:09:24', '2025-09-30 23:09:24'),
(224, 21, 'project', '', 'properties/21/project/abdf1f03-d433-4a58-957f-b408edf16e76.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:09:25', '2025-09-30 23:09:25'),
(225, 21, 'project', '', 'properties/21/project/afdeeab4-a0a6-4d9a-8b20-7d5c1c3da06b.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:09:26', '2025-09-30 23:09:26'),
(226, 21, 'project', '', 'properties/21/project/aad2df64-2650-4a12-8c50-d797227bce08.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:09:26', '2025-09-30 23:09:26'),
(227, 21, 'project', '', 'properties/21/project/18194ca0-14f0-489b-a699-08af95785ed7.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:09:27', '2025-09-30 23:09:27'),
(228, 21, 'project', '', 'properties/21/project/1323577c-2613-4f48-a374-fefb895f7234.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:09:28', '2025-09-30 23:09:28'),
(229, 21, 'project', '', 'properties/21/project/e8bfcb2a-d64b-436c-8e35-4b888678986a.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:09:28', '2025-09-30 23:09:28'),
(230, 21, 'project', '', 'properties/21/project/32a9844f-760b-4f57-8e0c-63b6aefa5a06.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:09:29', '2025-09-30 23:09:29'),
(231, 21, 'project', '', 'properties/21/project/854c1273-88d2-4dd2-bfd3-4d8475bec769.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:09:30', '2025-09-30 23:09:30'),
(232, 21, 'project', '', 'properties/21/project/c8e8e89d-a548-4144-8716-ed8caaea84f0.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:09:31', '2025-09-30 23:09:31'),
(233, 21, 'project', '', 'properties/21/project/b451a6fe-6b4b-4eeb-8dcc-0e4764ec6c33.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:09:32', '2025-09-30 23:09:32'),
(234, 21, 'project', '', 'properties/21/project/4de0ff1a-f9bb-4247-bd02-95c2d42837dd.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:09:33', '2025-09-30 23:09:33'),
(235, 21, 'project', '', 'properties/21/project/c3cd081d-0012-47ee-be95-9379d5966c25.jpg', '', 0, 0, 0, 13, 1, '2025-09-30 23:09:33', '2025-09-30 23:09:33'),
(236, 21, 'project', '', 'properties/21/project/20765736-6870-4745-9502-f42c79fa2378.jpg', '', 0, 0, 0, 14, 1, '2025-09-30 23:09:34', '2025-09-30 23:09:34'),
(237, 21, 'project', '', 'properties/21/project/49ab9e34-6693-4e04-a129-1cd249ff656e.jpg', '', 0, 0, 0, 15, 1, '2025-09-30 23:09:34', '2025-09-30 23:09:34'),
(238, 22, 'project', '', 'properties/22/project/8a4a1dba-7437-462e-ba56-79ea7ef0d5af.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:09:35', '2025-09-30 23:09:35'),
(239, 22, 'project', '', 'properties/22/project/51e80557-7f06-497c-9138-cd03797ef4e9.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:09:36', '2025-09-30 23:09:36'),
(240, 22, 'project', '', 'properties/22/project/5cd4342d-fcd5-4d84-84f6-c64b5fc3b769.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:09:36', '2025-09-30 23:09:36'),
(241, 22, 'project', '', 'properties/22/project/2a4b7d28-b501-43c7-97f0-d7a20f99f150.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:09:37', '2025-09-30 23:09:37'),
(242, 22, 'project', '', 'properties/22/project/2f8b0b87-d45d-45b9-b680-406d5933eed9.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:09:37', '2025-09-30 23:09:37'),
(243, 22, 'project', '', 'properties/22/project/83b8fe0e-ebe8-4fb3-a589-3fccada820c5.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:09:38', '2025-09-30 23:09:38'),
(244, 22, 'project', '', 'properties/22/project/547729a5-2f52-457b-89fd-1e168922b9b0.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:09:39', '2025-09-30 23:09:39'),
(245, 22, 'project', '', 'properties/22/project/6616df35-73a1-4b4e-acae-5b3aed5c75b8.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:09:39', '2025-09-30 23:09:39'),
(246, 22, 'project', '', 'properties/22/project/66d8171d-db0c-4743-a7a7-c287fec9b4df.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:09:40', '2025-09-30 23:09:40'),
(247, 22, 'project', '', 'properties/22/project/12493e72-2662-489a-ac67-7abf714df8dc.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:09:41', '2025-09-30 23:09:41'),
(248, 22, 'project', '', 'properties/22/project/28d7fc51-a21b-48b0-a0ef-26aff945800e.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:09:41', '2025-09-30 23:09:41'),
(249, 22, 'project', '', 'properties/22/project/7812ba3b-c53b-4846-90f4-fa02ab165fd4.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:09:42', '2025-09-30 23:09:42'),
(250, 23, 'project', '', 'properties/23/project/f5e61fe3-1302-413e-b140-3f85e278713a.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:09:43', '2025-09-30 23:09:43'),
(251, 23, 'project', '', 'properties/23/project/c537e488-dd8e-4d40-8674-1e3a6af68cb6.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:09:43', '2025-09-30 23:09:43'),
(252, 23, 'project', '', 'properties/23/project/b632727c-833d-4b6d-b456-45ffebf43d9a.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:09:44', '2025-09-30 23:09:44'),
(253, 23, 'project', '', 'properties/23/project/83e9b8bf-5e99-422e-9377-51a129fd7a9d.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:09:44', '2025-09-30 23:09:44'),
(254, 23, 'project', '', 'properties/23/project/1c3ed8b7-f3fc-4741-8a94-37dea9d6e56d.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:09:45', '2025-09-30 23:09:45'),
(255, 23, 'project', '', 'properties/23/project/dfd8c7b9-afab-4a1c-9354-7f6f0bce0d96.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:09:45', '2025-09-30 23:09:45'),
(256, 23, 'project', '', 'properties/23/project/b7238300-dda1-4c83-b9a2-2a9b3906b6c4.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:09:46', '2025-09-30 23:09:46'),
(257, 23, 'project', '', 'properties/23/project/9caa4ae8-a406-4fad-9918-3be098aade94.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:09:46', '2025-09-30 23:09:46'),
(258, 23, 'project', '', 'properties/23/project/b99fdd51-215a-4566-a22b-ac1c0a8d2018.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:09:47', '2025-09-30 23:09:47'),
(259, 23, 'project', '', 'properties/23/project/c8a0108f-c908-4a9f-a301-1032047a237e.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:09:47', '2025-09-30 23:09:47'),
(260, 24, 'project', '', 'properties/24/project/20d25a51-4b56-4f8d-bc57-c70dbc213b08.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:09:48', '2025-09-30 23:09:48'),
(261, 24, 'project', '', 'properties/24/project/0b9805e5-b092-4f75-9868-54d1bfdb2c41.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:09:49', '2025-09-30 23:09:49'),
(262, 24, 'project', '', 'properties/24/project/c6b99da3-6fdc-4660-8ff9-cddaf87dac96.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:09:50', '2025-09-30 23:09:50'),
(263, 24, 'project', '', 'properties/24/project/ca0879dc-7e85-45e4-bbb0-828eeb5ff643.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:09:51', '2025-09-30 23:09:51'),
(264, 24, 'project', '', 'properties/24/project/2d9462a3-8a6c-43bc-a395-767a71c95684.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:09:51', '2025-09-30 23:09:51'),
(265, 24, 'project', '', 'properties/24/project/c12b82c6-1bec-4d19-a9cd-87acf7be540a.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:09:52', '2025-09-30 23:09:52'),
(266, 24, 'project', '', 'properties/24/project/24034c2e-1873-44c5-bf73-18446d07add8.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:09:52', '2025-09-30 23:09:52'),
(267, 24, 'project', '', 'properties/24/project/368e8bb6-c114-4bf5-b347-d7bdbf8a6b97.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:09:53', '2025-09-30 23:09:53'),
(268, 25, 'project', '', 'properties/25/project/f4308b84-7d18-4f32-99af-b5c856dd0d50.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:09:54', '2025-09-30 23:09:54'),
(269, 25, 'project', '', 'properties/25/project/48b5f00b-229d-411c-9ee1-a081d49b4c4e.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:09:54', '2025-09-30 23:09:54'),
(270, 25, 'project', '', 'properties/25/project/c51a1b80-721a-4639-b8b2-6b7ff5e6b80c.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:09:55', '2025-09-30 23:09:55'),
(271, 25, 'project', '', 'properties/25/project/540883ce-3e74-44f3-8d14-01429c9dfbdf.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:09:56', '2025-09-30 23:09:56'),
(272, 25, 'project', '', 'properties/25/project/b8e158f3-7e35-4212-856f-920950fc8723.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:09:56', '2025-09-30 23:09:56'),
(273, 25, 'project', '', 'properties/25/project/189213fa-e4c3-4a63-b259-8338e963601f.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:09:57', '2025-09-30 23:09:57'),
(274, 25, 'project', '', 'properties/25/project/2a6c427c-59a9-466d-a3e7-0ab3b3b08a85.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:09:58', '2025-09-30 23:09:58'),
(275, 25, 'project', '', 'properties/25/project/1ffedc56-13e4-4282-8146-6e2b13720ff8.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:09:58', '2025-09-30 23:09:58'),
(276, 25, 'project', '', 'properties/25/project/fa6bc062-0c5e-4c4d-879f-7bee042c13c7.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:09:59', '2025-09-30 23:09:59'),
(277, 25, 'project', '', 'properties/25/project/253cbf0b-c5c9-4167-b2ac-0a43e0346077.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:09:59', '2025-09-30 23:09:59'),
(278, 25, 'project', '', 'properties/25/project/f0a9a73a-623c-42af-82b2-83128824a42f.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:10:00', '2025-09-30 23:10:00'),
(279, 25, 'project', '', 'properties/25/project/d76860ef-3e78-451f-b9f8-2bd64dc2b57a.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:10:01', '2025-09-30 23:10:01'),
(280, 26, 'project', '', 'properties/26/project/842a8b38-5b34-4029-ab2d-7c07af689ac7.jpeg', '', 0, 0, 0, 1, 1, '2025-09-30 23:10:02', '2025-09-30 23:10:02'),
(281, 26, 'project', '', 'properties/26/project/9ade07b9-fd51-4d17-b7dd-1be2da2ebb33.jpeg', '', 0, 0, 0, 2, 1, '2025-09-30 23:10:02', '2025-09-30 23:10:02'),
(282, 26, 'project', '', 'properties/26/project/b0134858-c591-49d7-be6d-934910cb7389.jpeg', '', 0, 0, 0, 3, 1, '2025-09-30 23:10:03', '2025-09-30 23:10:03'),
(283, 26, 'project', '', 'properties/26/project/5df68056-d213-4d32-854e-a807a53b2e1c.jpeg', '', 0, 0, 0, 4, 1, '2025-09-30 23:10:03', '2025-09-30 23:10:03'),
(284, 26, 'project', '', 'properties/26/project/69b8e4ee-37c6-45e3-b3a2-97aa6d11d7aa.jpeg', '', 0, 0, 0, 5, 1, '2025-09-30 23:10:04', '2025-09-30 23:10:04'),
(285, 26, 'project', '', 'properties/26/project/3adc3ce2-1b86-457f-85e2-2329e15a26b9.jpeg', '', 0, 0, 0, 6, 1, '2025-09-30 23:10:05', '2025-09-30 23:10:05'),
(286, 26, 'project', '', 'properties/26/project/84b23e84-481d-4f65-bffb-818f80afe84f.jpeg', '', 0, 0, 0, 7, 1, '2025-09-30 23:10:05', '2025-09-30 23:10:05'),
(287, 26, 'project', '', 'properties/26/project/185943e1-a3dc-4ba4-b136-4d55e1119c66.jpeg', '', 0, 0, 0, 8, 1, '2025-09-30 23:10:06', '2025-09-30 23:10:06'),
(288, 26, 'project', '', 'properties/26/project/004efad9-6459-4f13-9324-148e6908f3df.jpeg', '', 0, 0, 0, 9, 1, '2025-09-30 23:10:06', '2025-09-30 23:10:06'),
(289, 26, 'project', '', 'properties/26/project/257800d4-6a13-4fec-bf3e-bd18640fc9c3.jpeg', '', 0, 0, 0, 10, 1, '2025-09-30 23:10:07', '2025-09-30 23:10:07'),
(290, 26, 'project', '', 'properties/26/project/e2517039-bb68-4cfb-9743-0651fd3c6949.jpeg', '', 0, 0, 0, 11, 1, '2025-09-30 23:10:08', '2025-09-30 23:10:08'),
(291, 26, 'project', '', 'properties/26/project/dc86a429-877e-4fcf-9757-a52d9989286e.jpeg', '', 0, 0, 0, 12, 1, '2025-09-30 23:10:08', '2025-09-30 23:10:08'),
(292, 26, 'project', '', 'properties/26/project/77bc4e14-815f-4715-93fa-063a82f9eda0.jpeg', '', 0, 0, 0, 13, 1, '2025-09-30 23:10:09', '2025-09-30 23:10:09'),
(293, 26, 'project', '', 'properties/26/project/e02df5cb-06d3-44c9-9032-e322b8677ad7.jpeg', '', 0, 0, 0, 14, 1, '2025-09-30 23:10:09', '2025-09-30 23:10:09'),
(294, 26, 'project', '', 'properties/26/project/ce853ef6-05c7-4509-bd75-f49bd4c08acd.jpeg', '', 0, 0, 0, 15, 1, '2025-09-30 23:10:10', '2025-09-30 23:10:10'),
(295, 26, 'project', '', 'properties/26/project/e5c066f9-6cf0-4eec-8b9a-a9d35fba2678.jpeg', '', 0, 0, 0, 16, 1, '2025-09-30 23:10:11', '2025-09-30 23:10:11'),
(296, 27, 'project', '', 'properties/27/project/6829960a-5a00-42c7-a72a-e1bcfb8f62f9.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:10:12', '2025-09-30 23:10:12'),
(297, 27, 'project', '', 'properties/27/project/6a4307bf-e87f-4b87-b80f-a1620763b058.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:10:12', '2025-09-30 23:10:12'),
(298, 27, 'project', '', 'properties/27/project/394169ba-5043-495f-a7cd-177ce190158e.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:10:13', '2025-09-30 23:10:13'),
(299, 27, 'project', '', 'properties/27/project/53a68198-84b1-493b-bba7-ccc0bbb809df.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:10:13', '2025-09-30 23:10:13'),
(300, 27, 'project', '', 'properties/27/project/661b4a72-9253-42f1-8699-8559acd29cc3.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:10:14', '2025-09-30 23:10:14'),
(301, 27, 'project', '', 'properties/27/project/8ed4f72e-2fee-4229-9efc-6c14a5223bde.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:10:14', '2025-09-30 23:10:14'),
(302, 27, 'project', '', 'properties/27/project/5826b09a-713c-4e12-9d51-cb78857d7cef.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:10:15', '2025-09-30 23:10:15'),
(303, 27, 'project', '', 'properties/27/project/143cdee9-2f39-4a9c-b4f6-dc03bae70e70.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:10:16', '2025-09-30 23:10:16'),
(304, 28, 'project', '', 'properties/28/project/a65080c6-97ef-4fbe-b82d-24ddf5772614.jpeg', '', 0, 0, 0, 1, 1, '2025-09-30 23:10:17', '2025-09-30 23:10:17'),
(305, 28, 'project', '', 'properties/28/project/a152dbde-187d-427e-bc47-c4fcd32c6029.jpeg', '', 0, 0, 0, 2, 1, '2025-09-30 23:10:17', '2025-09-30 23:10:17'),
(306, 28, 'project', '', 'properties/28/project/e06f8bd8-0867-4e4d-be25-f497b33ae49e.jpeg', '', 0, 0, 0, 3, 1, '2025-09-30 23:10:18', '2025-09-30 23:10:18'),
(307, 28, 'project', '', 'properties/28/project/6035f818-3702-48b7-8c62-abe9591de018.jpeg', '', 0, 0, 0, 4, 1, '2025-09-30 23:10:18', '2025-09-30 23:10:18'),
(308, 28, 'project', '', 'properties/28/project/bc0d6b6d-647b-476d-a589-1c394a643fad.jpeg', '', 0, 0, 0, 5, 1, '2025-09-30 23:10:19', '2025-09-30 23:10:19'),
(309, 28, 'project', '', 'properties/28/project/246f360a-6624-4b73-aacc-e33cca634ea2.jpeg', '', 0, 0, 0, 6, 1, '2025-09-30 23:10:20', '2025-09-30 23:10:20'),
(310, 28, 'project', '', 'properties/28/project/368dc726-d900-48ac-934c-ec0b9a6a9fc1.jpeg', '', 0, 0, 0, 7, 1, '2025-09-30 23:10:20', '2025-09-30 23:10:20'),
(311, 29, 'project', '', 'properties/29/project/1ebd9df5-9ad4-4573-910f-d2505203d2fc.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:10:22', '2025-09-30 23:10:22'),
(312, 29, 'project', '', 'properties/29/project/5c147c88-5a45-4d4e-9378-26ec234b369b.jpeg', '', 0, 0, 0, 2, 1, '2025-09-30 23:10:22', '2025-09-30 23:10:22'),
(313, 29, 'project', '', 'properties/29/project/9296a821-3121-4726-83be-eeae45234493.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:10:23', '2025-09-30 23:10:23'),
(314, 29, 'project', '', 'properties/29/project/5081f7d6-df7f-4a3b-ba0c-177370ad15a0.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:10:24', '2025-09-30 23:10:24'),
(315, 29, 'project', '', 'properties/29/project/fd119ac1-544c-4acd-abdc-6b6fb888c4a2.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:10:24', '2025-09-30 23:10:24'),
(316, 29, 'project', '', 'properties/29/project/c45d17fb-7467-41e3-b770-856a1c12b9d3.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:10:25', '2025-09-30 23:10:25'),
(317, 29, 'project', '', 'properties/29/project/898be726-29ff-4eec-8e43-8fd9c7727518.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:10:26', '2025-09-30 23:10:26'),
(318, 29, 'project', '', 'properties/29/project/f9323c74-2bcf-457f-9167-9aaf2c9b60a8.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:10:26', '2025-09-30 23:10:26'),
(319, 29, 'project', '', 'properties/29/project/bdb0d8be-9c4e-4b00-957f-17df6aa8468f.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:10:27', '2025-09-30 23:10:27'),
(320, 29, 'project', '', 'properties/29/project/c9555ee6-ede7-43e4-9791-e6c2ab2ae775.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:10:28', '2025-09-30 23:10:28'),
(321, 29, 'project', '', 'properties/29/project/0989123f-d677-4093-bccc-8d9c359c17fc.jpeg', '', 0, 0, 0, 11, 1, '2025-09-30 23:10:28', '2025-09-30 23:10:28'),
(322, 29, 'project', '', 'properties/29/project/82dc77e5-c111-4bad-9933-d7885c341c4e.jpeg', '', 0, 0, 0, 12, 1, '2025-09-30 23:10:29', '2025-09-30 23:10:29'),
(323, 29, 'project', '', 'properties/29/project/0ddf42c4-3215-4655-9198-c2cdf0100507.jpeg', '', 0, 0, 0, 13, 1, '2025-09-30 23:10:29', '2025-09-30 23:10:29'),
(324, 29, 'project', '', 'properties/29/project/b26ad678-e826-4786-98a8-dd1158ebd0eb.jpeg', '', 0, 0, 0, 14, 1, '2025-09-30 23:10:30', '2025-09-30 23:10:30'),
(325, 29, 'project', '', 'properties/29/project/1f39634b-e0cb-4da4-bb9b-ce2c79382d62.jpeg', '', 0, 0, 0, 15, 1, '2025-09-30 23:10:31', '2025-09-30 23:10:31'),
(326, 29, 'project', '', 'properties/29/project/4d4f0102-5871-4c79-81c6-b4decda0576f.jpeg', '', 0, 0, 0, 16, 1, '2025-09-30 23:10:31', '2025-09-30 23:10:31'),
(327, 30, 'project', '', 'properties/30/project/ba3ae713-6c9a-4fdb-879b-1298bf3d648d.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:10:32', '2025-09-30 23:10:32'),
(328, 30, 'project', '', 'properties/30/project/3fd1bd98-a150-4199-bbf5-cc118fcc9f8b.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:10:33', '2025-09-30 23:10:33'),
(329, 30, 'project', '', 'properties/30/project/44d5fd70-a1d3-46a8-83d8-805c877199b8.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:10:34', '2025-09-30 23:10:34'),
(330, 30, 'project', '', 'properties/30/project/0615ee41-e24f-4534-95da-985585ed68ba.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:10:34', '2025-09-30 23:10:34'),
(331, 30, 'project', '', 'properties/30/project/674bbd88-ff7d-4843-9a88-0792affabaab.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:10:35', '2025-09-30 23:10:35'),
(332, 30, 'project', '', 'properties/30/project/c830ee53-4d74-448a-9aba-8d3d130ed655.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:10:35', '2025-09-30 23:10:35'),
(333, 30, 'project', '', 'properties/30/project/8e31f845-715b-4baa-ac8a-7c7cf1ab676e.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:10:36', '2025-09-30 23:10:36'),
(334, 30, 'project', '', 'properties/30/project/de5db061-1878-4900-bb73-3a3f680ebba5.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:10:37', '2025-09-30 23:10:37'),
(335, 30, 'project', '', 'properties/30/project/c4cc4ad0-295d-4b26-88e0-22f41effcae3.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:10:37', '2025-09-30 23:10:37'),
(336, 30, 'project', '', 'properties/30/project/9944b874-e6a1-401e-857e-00953eeb5b76.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:10:38', '2025-09-30 23:10:38');
INSERT INTO `property_images` (`id`, `property_id`, `type`, `alt_type`, `image_path`, `caption`, `is_banner`, `is_thumbnail`, `is_thumbnail_2`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(337, 30, 'project', '', 'properties/30/project/d5eea393-a9eb-4486-ab99-e458649563fd.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:10:39', '2025-09-30 23:10:39'),
(338, 30, 'project', '', 'properties/30/project/7f6e25ea-9fc8-4a96-b908-fedbbb74013f.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:10:40', '2025-09-30 23:10:40'),
(339, 30, 'project', '', 'properties/30/project/d44d16cb-5eb1-4840-89fd-97cf8bc0e687.jpg', '', 0, 0, 0, 13, 1, '2025-09-30 23:10:41', '2025-09-30 23:10:41'),
(340, 30, 'project', '', 'properties/30/project/57fa92db-ca17-492a-a17c-8fb6b3734a95.jpg', '', 0, 0, 0, 14, 1, '2025-09-30 23:10:41', '2025-09-30 23:10:41'),
(341, 30, 'project', '', 'properties/30/project/d28d05fb-ffd8-4d5c-95bd-fb5570d0771f.jpg', '', 0, 0, 0, 15, 1, '2025-09-30 23:10:42', '2025-09-30 23:10:42'),
(342, 30, 'project', '', 'properties/30/project/0a216ae1-571f-4c0d-a12e-6467873ad38a.jpg', '', 0, 0, 0, 16, 1, '2025-09-30 23:10:42', '2025-09-30 23:10:42'),
(343, 31, 'project', '', 'properties/31/project/47582d13-4585-4195-abaa-29500d2cd762.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:10:44', '2025-09-30 23:10:44'),
(344, 31, 'project', '', 'properties/31/project/af4ab1e4-97a4-4287-a84d-4d890e2dfc24.jpeg', '', 0, 0, 0, 2, 1, '2025-09-30 23:10:45', '2025-09-30 23:10:45'),
(345, 31, 'project', '', 'properties/31/project/ddc0c34a-8697-434a-b852-4d85cb18bd32.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:10:46', '2025-09-30 23:10:46'),
(346, 31, 'project', '', 'properties/31/project/20e889c7-ff19-4a92-a462-5b70619f5547.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:10:46', '2025-09-30 23:10:46'),
(347, 31, 'project', '', 'properties/31/project/246223a6-610c-470a-821a-e573eae4ca69.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:10:47', '2025-09-30 23:10:47'),
(348, 32, 'project', '', 'properties/32/project/e8319984-779b-4b3b-8e2e-5ba5942a9427.jpeg', '', 0, 0, 0, 1, 1, '2025-09-30 23:10:48', '2025-09-30 23:10:48'),
(349, 32, 'project', '', 'properties/32/project/653f7bb6-2ece-4bf3-ad4b-10a91cd9ce6d.jpeg', '', 0, 0, 0, 2, 1, '2025-09-30 23:10:48', '2025-09-30 23:10:48'),
(350, 32, 'project', '', 'properties/32/project/fef2aaf3-c751-4715-a9e0-20689da45c9a.jpeg', '', 0, 0, 0, 3, 1, '2025-09-30 23:10:49', '2025-09-30 23:10:49'),
(351, 32, 'project', '', 'properties/32/project/8120fb92-b732-482f-b21b-d97dce9f8520.jpeg', '', 0, 0, 0, 4, 1, '2025-09-30 23:10:49', '2025-09-30 23:10:49'),
(352, 32, 'project', '', 'properties/32/project/c04e6a34-e2a6-42dd-99b0-b28f5ad7cfdc.jpeg', '', 0, 0, 0, 5, 1, '2025-09-30 23:10:50', '2025-09-30 23:10:50'),
(353, 32, 'project', '', 'properties/32/project/48cbcab4-7cc1-445e-aefb-8e2cb94278a3.jpeg', '', 0, 0, 0, 6, 1, '2025-09-30 23:10:51', '2025-09-30 23:10:51'),
(354, 32, 'project', '', 'properties/32/project/fa585c64-634c-4172-ad10-fb90df78c397.jpeg', '', 0, 0, 0, 7, 1, '2025-09-30 23:10:51', '2025-09-30 23:10:51'),
(355, 32, 'project', '', 'properties/32/project/0b1fbe2d-0795-4e0c-8b85-06e48add0403.jpeg', '', 0, 0, 0, 8, 1, '2025-09-30 23:10:52', '2025-09-30 23:10:52'),
(356, 32, 'project', '', 'properties/32/project/b636c062-cb50-4d97-ad74-d3f0883d476f.jpeg', '', 0, 0, 0, 9, 1, '2025-09-30 23:10:52', '2025-09-30 23:10:52'),
(357, 32, 'project', '', 'properties/32/project/f8328cd9-f81d-44fb-9c09-cd885c811d0e.jpeg', '', 0, 0, 0, 10, 1, '2025-09-30 23:10:53', '2025-09-30 23:10:53'),
(358, 32, 'project', '', 'properties/32/project/7182e1e0-0b54-44e8-b7b2-b8a7b53df362.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:10:54', '2025-09-30 23:10:54'),
(359, 32, 'project', '', 'properties/32/project/e5ed7521-acdb-4477-9feb-0744d0778670.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:10:54', '2025-09-30 23:10:54'),
(360, 32, 'project', '', 'properties/32/project/fb10340c-d88f-46f9-8970-a2217de339ce.jpg', '', 0, 0, 0, 13, 1, '2025-09-30 23:10:55', '2025-09-30 23:10:55'),
(361, 32, 'project', '', 'properties/32/project/0768616f-1093-44ef-8aaa-ad3563a996d0.jpg', '', 0, 0, 0, 14, 1, '2025-09-30 23:10:56', '2025-09-30 23:10:56'),
(362, 32, 'project', '', 'properties/32/project/35bc451c-1a0a-45ea-9008-8a19fe245251.jpg', '', 0, 0, 0, 15, 1, '2025-09-30 23:10:56', '2025-09-30 23:10:56'),
(363, 32, 'project', '', 'properties/32/project/6a201f97-feb2-41c7-afd1-4060dcf7a1b9.jpg', '', 0, 0, 0, 16, 1, '2025-09-30 23:10:57', '2025-09-30 23:10:57'),
(364, 33, 'project', '', 'properties/33/project/9e37f1b4-8ac9-4b71-9418-a941eb4832f1.jpeg', '', 0, 0, 0, 1, 1, '2025-09-30 23:10:58', '2025-09-30 23:10:58'),
(365, 33, 'project', '', 'properties/33/project/2fe19d55-11c7-49a8-b4a6-36353aed35d9.jpeg', '', 0, 0, 0, 2, 1, '2025-09-30 23:10:58', '2025-09-30 23:10:58'),
(366, 33, 'project', '', 'properties/33/project/2e6aec24-98c2-4287-9c78-6fd720a1b749.jpeg', '', 0, 0, 0, 3, 1, '2025-09-30 23:10:59', '2025-09-30 23:10:59'),
(367, 33, 'project', '', 'properties/33/project/64afc60b-20ad-4d55-b42b-4b84f7e4dc15.jpeg', '', 0, 0, 0, 4, 1, '2025-09-30 23:10:59', '2025-09-30 23:10:59'),
(368, 33, 'project', '', 'properties/33/project/2e9cb59f-9615-4a3f-9da3-22b099379ae2.jpeg', '', 0, 0, 0, 5, 1, '2025-09-30 23:11:00', '2025-09-30 23:11:00'),
(369, 33, 'project', '', 'properties/33/project/a6b2bd05-b101-4f14-bdd6-615b69ead998.jpeg', '', 0, 0, 0, 6, 1, '2025-09-30 23:11:01', '2025-09-30 23:11:01'),
(370, 33, 'project', '', 'properties/33/project/cf1cf540-79d5-494f-973c-6351fd9c4d11.jpeg', '', 0, 0, 0, 7, 1, '2025-09-30 23:11:01', '2025-09-30 23:11:01'),
(371, 33, 'project', '', 'properties/33/project/68c29cc9-716a-4a93-9ba6-77dc110c3fff.jpeg', '', 0, 0, 0, 8, 1, '2025-09-30 23:11:02', '2025-09-30 23:11:02'),
(372, 33, 'project', '', 'properties/33/project/fc5f1dac-be78-4d38-bda4-2c1f28db319a.jpeg', '', 0, 0, 0, 9, 1, '2025-09-30 23:11:03', '2025-09-30 23:11:03'),
(373, 33, 'project', '', 'properties/33/project/dafe675c-2e34-41ff-9c25-75396ef45962.jpeg', '', 0, 0, 0, 10, 1, '2025-09-30 23:11:03', '2025-09-30 23:11:03'),
(374, 33, 'project', '', 'properties/33/project/a6e0c76f-0bbe-4df3-b08a-c60be3a7ff3b.jpeg', '', 0, 0, 0, 11, 1, '2025-09-30 23:11:04', '2025-09-30 23:11:04'),
(375, 33, 'project', '', 'properties/33/project/6a456b95-ee75-4be0-876d-5d0f723c04d2.jpeg', '', 0, 0, 0, 12, 1, '2025-09-30 23:11:04', '2025-09-30 23:11:04'),
(376, 34, 'project', '', 'properties/34/project/393ed328-19f8-433f-bfdb-6f4b3749d9d2.jpeg', '', 0, 0, 0, 1, 1, '2025-09-30 23:11:05', '2025-09-30 23:11:05'),
(377, 34, 'project', '', 'properties/34/project/b9cfe6e4-d54a-444c-854b-0b8b864f87c2.jpeg', '', 0, 0, 0, 2, 1, '2025-09-30 23:11:06', '2025-09-30 23:11:06'),
(378, 34, 'project', '', 'properties/34/project/081a5027-6e28-46c4-b4b5-366efb7944e9.jpeg', '', 0, 0, 0, 3, 1, '2025-09-30 23:11:06', '2025-09-30 23:11:06'),
(379, 34, 'project', '', 'properties/34/project/2522b68f-4059-42fa-8fd0-fc8163e33f4e.jpeg', '', 0, 0, 0, 4, 1, '2025-09-30 23:11:07', '2025-09-30 23:11:07'),
(380, 34, 'project', '', 'properties/34/project/6f2b9ca2-da78-4784-8c6a-b5abe4ee8230.jpeg', '', 0, 0, 0, 5, 1, '2025-09-30 23:11:09', '2025-09-30 23:11:09'),
(381, 34, 'project', '', 'properties/34/project/769723b1-8da4-4d00-b3a8-61c72b77ddac.jpeg', '', 0, 0, 0, 6, 1, '2025-09-30 23:11:10', '2025-09-30 23:11:10'),
(382, 34, 'project', '', 'properties/34/project/eb77681f-1121-410c-bd53-fff766439314.jpeg', '', 0, 0, 0, 7, 1, '2025-09-30 23:11:11', '2025-09-30 23:11:11'),
(383, 34, 'project', '', 'properties/34/project/5029341e-46b2-453f-8074-07ff107fb58f.jpeg', '', 0, 0, 0, 8, 1, '2025-09-30 23:11:12', '2025-09-30 23:11:12'),
(384, 34, 'project', '', 'properties/34/project/b34e6503-51a8-47e3-979a-6190ebd154d9.jpeg', '', 0, 0, 0, 9, 1, '2025-09-30 23:11:13', '2025-09-30 23:11:13'),
(385, 34, 'project', '', 'properties/34/project/79d15540-b1b2-46d2-bddb-141244af09fe.jpeg', '', 0, 0, 0, 10, 1, '2025-09-30 23:11:14', '2025-09-30 23:11:14'),
(386, 34, 'project', '', 'properties/34/project/e17519e8-8085-493c-a370-02affc8aad18.jpeg', '', 0, 0, 0, 11, 1, '2025-09-30 23:11:14', '2025-09-30 23:11:14'),
(387, 34, 'project', '', 'properties/34/project/1726a0f4-ea16-479f-a9fd-aa1c36f2278d.jpeg', '', 0, 0, 0, 12, 1, '2025-09-30 23:11:15', '2025-09-30 23:11:15'),
(388, 34, 'project', '', 'properties/34/project/00b6a633-a56a-471a-beaa-25e3a3b27482.jpeg', '', 0, 0, 0, 13, 1, '2025-09-30 23:11:15', '2025-09-30 23:11:15'),
(389, 34, 'project', '', 'properties/34/project/b23e5a2d-7198-4a75-87f6-2431b5c2ebe8.jpeg', '', 0, 0, 0, 14, 1, '2025-09-30 23:11:16', '2025-09-30 23:11:16'),
(390, 34, 'project', '', 'properties/34/project/f80ba392-e658-41ca-aa08-23425f8d6b19.jpeg', '', 0, 0, 0, 15, 1, '2025-09-30 23:11:17', '2025-09-30 23:11:17'),
(391, 34, 'project', '', 'properties/34/project/80cda7b8-cbc9-455a-be82-b2361286639c.jpeg', '', 0, 0, 0, 16, 1, '2025-09-30 23:11:17', '2025-09-30 23:11:17'),
(392, 35, 'project', '', 'properties/35/project/29ea8bd8-7039-461f-aa8b-840b9eac4071.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:11:19', '2025-09-30 23:11:19'),
(393, 35, 'project', '', 'properties/35/project/4e70d3ec-8205-4f7c-bed9-fedac0934415.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:11:19', '2025-09-30 23:11:19'),
(394, 35, 'project', '', 'properties/35/project/5fdb9a31-42bf-462d-b325-250f04024697.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:11:20', '2025-09-30 23:11:20'),
(395, 35, 'project', '', 'properties/35/project/c239fa0d-9aa3-4450-8400-428cbdd87bbc.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:11:21', '2025-09-30 23:11:21'),
(396, 35, 'project', '', 'properties/35/project/b88272aa-00bd-49d5-967e-80a5f971fea9.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:11:21', '2025-09-30 23:11:21'),
(397, 35, 'project', '', 'properties/35/project/934d8293-cf09-4f19-8829-5684668cd65e.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:11:22', '2025-09-30 23:11:22'),
(398, 36, 'project', '', 'properties/36/project/d3532140-cc22-46be-b908-e4f1d76d9b39.jpeg', '', 0, 0, 0, 1, 1, '2025-09-30 23:11:23', '2025-09-30 23:11:23'),
(399, 36, 'project', '', 'properties/36/project/79c880b6-60dc-4de0-b730-bce8f5e69b3a.jpeg', '', 0, 0, 0, 2, 1, '2025-09-30 23:11:24', '2025-09-30 23:11:24'),
(400, 36, 'project', '', 'properties/36/project/a1bbdcb0-d1af-42bd-aeba-38dc9471a68a.jpeg', '', 0, 0, 0, 3, 1, '2025-09-30 23:11:24', '2025-09-30 23:11:24'),
(401, 36, 'project', '', 'properties/36/project/dd572cbe-bc53-44fa-94a8-c66cc33ad81a.jpeg', '', 0, 0, 0, 4, 1, '2025-09-30 23:11:25', '2025-09-30 23:11:25'),
(402, 36, 'project', '', 'properties/36/project/75c6545e-ab5c-408e-857d-38a36b516d3c.jpeg', '', 0, 0, 0, 5, 1, '2025-09-30 23:11:26', '2025-09-30 23:11:26'),
(403, 36, 'project', '', 'properties/36/project/70632152-0b0c-4353-ab49-1fd059d3ecc9.jpeg', '', 0, 0, 0, 6, 1, '2025-09-30 23:11:26', '2025-09-30 23:11:26'),
(404, 36, 'project', '', 'properties/36/project/8fa4aeb7-7070-4c85-96ed-30b920dca6e6.jpeg', '', 0, 0, 0, 7, 1, '2025-09-30 23:11:27', '2025-09-30 23:11:27'),
(405, 36, 'project', '', 'properties/36/project/4fb436bb-9e46-42e9-9677-422a16766057.jpeg', '', 0, 0, 0, 8, 1, '2025-09-30 23:11:27', '2025-09-30 23:11:27'),
(406, 36, 'project', '', 'properties/36/project/e6e8bf66-ac1b-4940-9791-312996c87c3d.jpeg', '', 0, 0, 0, 9, 1, '2025-09-30 23:11:28', '2025-09-30 23:11:28'),
(407, 36, 'project', '', 'properties/36/project/0e6b78be-dd0d-4845-82f5-31c14d54eb46.jpeg', '', 0, 0, 0, 10, 1, '2025-09-30 23:11:29', '2025-09-30 23:11:29'),
(408, 36, 'project', '', 'properties/36/project/ef2e3d4f-4e4b-4468-94cd-d0e496876bda.jpeg', '', 0, 0, 0, 11, 1, '2025-09-30 23:11:29', '2025-09-30 23:11:29'),
(409, 36, 'project', '', 'properties/36/project/95284954-9820-4ce2-ade7-b5b392f18556.jpeg', '', 0, 0, 0, 12, 1, '2025-09-30 23:11:30', '2025-09-30 23:11:30'),
(410, 36, 'project', '', 'properties/36/project/98780efb-8ea9-4b79-b5ff-ae0202ed3314.jpeg', '', 0, 0, 0, 13, 1, '2025-09-30 23:11:31', '2025-09-30 23:11:31'),
(411, 36, 'project', '', 'properties/36/project/4f0dca22-520c-4cdd-868a-0aa6db92f152.jpeg', '', 0, 0, 0, 14, 1, '2025-09-30 23:11:31', '2025-09-30 23:11:31'),
(412, 36, 'project', '', 'properties/36/project/8fc3cdf5-2856-4ae4-ac8d-418b5082c9aa.jpeg', '', 0, 0, 0, 15, 1, '2025-09-30 23:11:32', '2025-09-30 23:11:32'),
(413, 36, 'project', '', 'properties/36/project/6e4775c2-6871-4cb7-a0b0-f0c6ad81cb02.jpeg', '', 0, 0, 0, 16, 1, '2025-09-30 23:11:32', '2025-09-30 23:11:32'),
(414, 37, 'project', '', 'properties/37/project/69f8c256-c0d4-43c7-93b3-144f77c06d88.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:11:33', '2025-09-30 23:11:33'),
(415, 37, 'project', '', 'properties/37/project/94af325c-369a-45e5-91c4-8b9ecca9a5f5.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:11:34', '2025-09-30 23:11:34'),
(416, 37, 'project', '', 'properties/37/project/e594ab9b-28af-4b7e-8165-b71165c0312b.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:11:35', '2025-09-30 23:11:35'),
(417, 37, 'project', '', 'properties/37/project/384c36e5-f5b2-4c0f-837e-81d18ecfabc8.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:11:35', '2025-09-30 23:11:35'),
(418, 37, 'project', '', 'properties/37/project/90e16975-4cc1-4c4e-9a83-738a247972cd.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:11:36', '2025-09-30 23:11:36'),
(419, 37, 'project', '', 'properties/37/project/88cbdbb2-4b23-4c47-9c23-5fae2e094242.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:11:36', '2025-09-30 23:11:36'),
(420, 37, 'project', '', 'properties/37/project/cac7e430-bcf1-452b-8e51-38ceb5dd4bfa.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:11:37', '2025-09-30 23:11:37'),
(421, 37, 'logo', '', 'properties/37/logo/3d3e10b2-8399-4136-a3e0-c75da1471c80.png', '', 0, 0, 0, 1, 1, '2025-09-30 23:11:38', '2025-09-30 23:11:38'),
(422, 38, 'project', '', 'properties/38/project/6e460098-4b52-4976-9906-dd62d5bcf420.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:11:39', '2025-09-30 23:11:39'),
(423, 38, 'logo', '', 'properties/38/logo/d3fc79e2-fa4e-4e1b-a5d9-759f87e7466c.png', '', 0, 0, 0, 1, 1, '2025-09-30 23:11:39', '2025-09-30 23:11:39'),
(424, 38, 'project', '', 'properties/38/project/d45d2bc4-ea0a-4197-9422-fb26fc81b602.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:11:40', '2025-09-30 23:11:40'),
(425, 38, 'project', '', 'properties/38/project/ff1efcef-d4f7-4462-a9ca-5c849669db02.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:11:41', '2025-09-30 23:11:41'),
(426, 38, 'project', 'DLF Alameda Floors Exteriors', 'properties/38/project/3f964ab1-2128-41ab-a8ad-6e8a1177d251.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:11:41', '2025-09-30 23:11:41'),
(427, 38, 'project', 'DLF Alameda Floors Exterior Photos', 'properties/38/project/137cc386-c72a-4675-b7f5-849b21db1c02.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:11:42', '2025-09-30 23:11:42'),
(428, 38, 'project', 'DLF Alameda Floors Exteriors', 'properties/38/project/1aabc66f-5c18-41c9-a374-6596afaee4be.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:11:42', '2025-09-30 23:11:42'),
(429, 38, 'project', 'DLF Alameda Floors Exterior Photos', 'properties/38/project/487e3ca6-d4f7-4e2c-a573-5947e0221ee5.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:11:43', '2025-09-30 23:11:43'),
(430, 38, 'project', 'DLF Alameda Floors Exteriors', 'properties/38/project/d0ac2d61-346b-4fe0-b327-6c3d17141358.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:11:43', '2025-09-30 23:11:43'),
(431, 39, 'logo', '', 'properties/39/logo/7d6f5eee-17b2-40f6-b7bf-a68b7eea5458.png', '', 0, 0, 0, 1, 1, '2025-09-30 23:11:44', '2025-09-30 23:11:44'),
(432, 39, 'project', '', 'properties/39/project/38a664ad-72de-4fac-bc27-311ae469d25d.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:11:45', '2025-09-30 23:11:45'),
(433, 39, 'project', '', 'properties/39/project/e61645e7-8dc7-4813-bce2-0273cd7ace56.jpeg', '', 0, 0, 0, 2, 1, '2025-09-30 23:11:45', '2025-09-30 23:11:45'),
(434, 39, 'project', '', 'properties/39/project/20a57408-2c25-422a-9e50-661770edbe03.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:11:46', '2025-09-30 23:11:46'),
(435, 39, 'project', '', 'properties/39/project/a2aa6cd9-b31b-46d6-97cd-8385ac04c82e.jpeg', '', 0, 0, 0, 4, 1, '2025-09-30 23:11:47', '2025-09-30 23:11:47'),
(436, 39, 'project', '', 'properties/39/project/3befa055-fcd6-4995-a737-6e94d13c7ef2.jpeg', '', 0, 0, 0, 5, 1, '2025-09-30 23:11:47', '2025-09-30 23:11:47'),
(437, 39, 'project', '', 'properties/39/project/f878b90c-ea59-4388-acbf-178172452cc5.jpeg', '', 0, 0, 0, 6, 1, '2025-09-30 23:11:48', '2025-09-30 23:11:48'),
(438, 39, 'project', '', 'properties/39/project/1258173b-7f96-42f3-affa-97fae0884c51.jpeg', '', 0, 0, 0, 7, 1, '2025-09-30 23:11:48', '2025-09-30 23:11:48'),
(439, 39, 'project', '', 'properties/39/project/02499572-ff77-42fe-b2ff-6dfa5f1e0540.jpeg', '', 0, 0, 0, 8, 1, '2025-09-30 23:11:49', '2025-09-30 23:11:49'),
(440, 39, 'project', '', 'properties/39/project/79ee0d53-5cd5-4bb4-a911-b44b726ef43b.jpeg', '', 0, 0, 0, 9, 1, '2025-09-30 23:11:49', '2025-09-30 23:11:49'),
(441, 39, 'project', '', 'properties/39/project/f67b828f-436d-444e-bacb-694a763e1849.jpeg', '', 0, 0, 0, 10, 1, '2025-09-30 23:11:50', '2025-09-30 23:11:50'),
(442, 39, 'project', '', 'properties/39/project/7059c4c5-3b93-4fd7-82cd-79605af32651.jpeg', '', 0, 0, 0, 11, 1, '2025-09-30 23:11:50', '2025-09-30 23:11:50'),
(443, 39, 'project', '', 'properties/39/project/99e6b895-0218-46b9-b44f-ee174f6de903.jpeg', '', 0, 0, 0, 12, 1, '2025-09-30 23:11:51', '2025-09-30 23:11:51'),
(444, 40, 'project', 'M3M St. Andrews Exteriors', 'properties/40/project/e2695180-0560-4401-b07b-72c3b7861e17.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:11:52', '2025-09-30 23:11:52'),
(445, 40, 'logo', 'M3M St. Andrews Logo', 'properties/40/logo/74c90160-7021-4ad0-9baf-3d0f8441d3eb.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:11:53', '2025-09-30 23:11:53'),
(446, 40, 'project', 'M3M St. Andrews Inner Photos', 'properties/40/project/eb1500e7-1f7b-4156-b7ab-d6252eec035a.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:11:53', '2025-09-30 23:11:53'),
(447, 40, 'project', 'M3M St. Andrews Interiors', 'properties/40/project/03e41415-70ad-4a07-b7ad-ed3498a47382.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:11:54', '2025-09-30 23:11:54'),
(448, 40, 'project', 'M3M St. Andrews Interiors', 'properties/40/project/182cb467-d7d7-4a80-b694-b91ed0fcd6f7.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:11:55', '2025-09-30 23:11:55'),
(449, 40, 'project', 'M3M St. Andrews Interiors', 'properties/40/project/1b148212-0f1c-44a6-9a86-269a0ccf956e.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:11:55', '2025-09-30 23:11:55'),
(450, 40, 'project', 'M3M St. Andrews Interiors', 'properties/40/project/aea23023-45df-4c27-95a4-df45883397d3.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:11:56', '2025-09-30 23:11:56'),
(451, 40, 'project', 'M3M St. Andrews Exterior Photos', 'properties/40/project/afb82d26-6673-4b6f-b697-c80002a09635.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:11:56', '2025-09-30 23:11:56'),
(452, 40, 'project', 'M3M St. Andrews Exteriors', 'properties/40/project/883d1ea6-e603-45cf-bed5-170bb41ace5b.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:11:57', '2025-09-30 23:11:57'),
(453, 41, 'logo', 'M3M Skycity Logo', 'properties/41/logo/7fdae689-43d1-4cba-b5ad-e5515b2dcf9c.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:11:58', '2025-09-30 23:11:58'),
(454, 41, 'project', 'M3M Skycity Exterior Photos', 'properties/41/project/b2ae3759-498e-4072-91da-1a49c309c991.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:11:59', '2025-09-30 23:11:59'),
(455, 41, 'project', 'M3M Skycity Inner Photos', 'properties/41/project/0d241053-05aa-4e7a-b019-567e5476b877.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:11:59', '2025-09-30 23:11:59'),
(456, 41, 'project', 'M3M Skycity Inner Photos', 'properties/41/project/fdbdb88c-ae12-4d38-957c-c20a785083a2.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:12:00', '2025-09-30 23:12:00'),
(457, 41, 'project', 'M3M Skycity Exterior Photos', 'properties/41/project/3e50668d-ba3e-4ee9-95f3-0a2e81f9d562.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:12:00', '2025-09-30 23:12:00'),
(458, 41, 'project', 'M3M Skycity Exterior Photos', 'properties/41/project/a7b8ea5a-4dfd-4713-9666-29894771677f.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:12:01', '2025-09-30 23:12:01'),
(459, 41, 'project', 'M3M Skycity Exterior Photos', 'properties/41/project/832a1727-b268-4ed2-bd4e-1ee3bd5eb2d4.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:12:02', '2025-09-30 23:12:02'),
(460, 41, 'project', 'M3M Skycity Exterior Photos', 'properties/41/project/32197a13-a980-45e5-ba92-8a1b343c53e5.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:12:02', '2025-09-30 23:12:02'),
(461, 41, 'project', 'M3M Skycity Exteriors', 'properties/41/project/e3ef0cc7-45f8-4bfe-981f-296de1e4b1c4.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:12:03', '2025-09-30 23:12:03'),
(462, 42, 'logo', 'M3M Heights Logo', 'properties/42/logo/1dbb2769-7db5-4adc-8d57-196bd96b9bbc.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:12:04', '2025-09-30 23:12:04'),
(463, 43, 'logo', 'AIPL Autograph Logo', 'properties/43/logo/89606afe-6224-4122-b882-85829b1f22d7.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:12:05', '2025-09-30 23:12:05'),
(464, 43, 'project', 'AIPL Autograph Exterior Photos', 'properties/43/project/38206b44-e3e7-4aa2-af92-17b329bdb1b9.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:12:06', '2025-09-30 23:12:06'),
(465, 43, 'project', 'AIPL Autograph Exteriors', 'properties/43/project/de2ab018-05ba-489c-b80c-4b8998b04294.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:12:06', '2025-09-30 23:12:06'),
(466, 43, 'project', 'AIPL Autograph Exteriors', 'properties/43/project/c0860a9c-43f8-4671-8763-4c82abf83beb.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:12:08', '2025-09-30 23:12:08'),
(467, 43, 'project', 'AIPL Autograph Inner Photos', 'properties/43/project/c6adf75d-8e43-4a6b-bfad-796e781bbac5.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:12:08', '2025-09-30 23:12:08'),
(468, 43, 'project', 'AIPL Autograph Inner Photos', 'properties/43/project/98df7be5-e085-4306-bba8-f29bee535d2c.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:12:09', '2025-09-30 23:12:09'),
(469, 43, 'project', 'AIPL Autograph Inner Photos', 'properties/43/project/5ca11227-225b-46b7-98b4-65e54ac5d556.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:12:09', '2025-09-30 23:12:09'),
(470, 44, 'project', 'DLF Garden City Floors Exteriors', 'properties/44/project/1eb1006b-eb10-4281-91bc-76bb90fa6671.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:12:10', '2025-09-30 23:12:10'),
(471, 44, 'project', 'DLF Garden City Floors Exterior Photos', 'properties/44/project/9ca8a387-de75-4f8f-8ec3-1ba7acaf894c.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:12:10', '2025-09-30 23:12:10'),
(472, 44, 'project', 'DLF Garden City Floors Exteriors', 'properties/44/project/72ee07a7-d99a-476f-88b8-ac8674b79eeb.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:12:11', '2025-09-30 23:12:11'),
(473, 44, 'project', 'DLF Garden City Floors Exteriors', 'properties/44/project/e9866521-06f3-4190-bb6e-936828ab52fd.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:12:12', '2025-09-30 23:12:12'),
(474, 44, 'project', 'DLF Garden City Floors Exterior Photos', 'properties/44/project/2cbd1c99-2804-4f93-a2bf-d0cd512ddf98.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:12:12', '2025-09-30 23:12:12'),
(475, 45, 'project', 'Fully Furnished Ground Floor With Private Garden Interiors', 'properties/45/project/7752374d-7d3e-4e2b-96ed-bd0b93325245.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:12:13', '2025-09-30 23:12:13'),
(476, 45, 'project', 'Fully Furnished Ground Floor With Private Garden Interiors', 'properties/45/project/71db216f-ef87-425b-b590-0dddbcf25641.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:12:13', '2025-09-30 23:12:13'),
(477, 45, 'project', 'Fully Furnished Ground Floor With Private Garden Interiors', 'properties/45/project/7ec942cc-4ad5-45dc-9910-8db4017607f9.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:12:14', '2025-09-30 23:12:14'),
(478, 45, 'project', 'Fully Furnished Ground Floor With Private Garden Inner Photos', 'properties/45/project/37f257c7-1de8-4ade-ad51-4d0b4c387b8a.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:12:14', '2025-09-30 23:12:14'),
(479, 45, 'project', 'Fully Furnished Ground Floor With Private Garden Inner Photos', 'properties/45/project/61defd34-4b07-4c7c-af0e-b947b24ea314.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:12:15', '2025-09-30 23:12:15'),
(480, 45, 'project', 'Fully Furnished Ground Floor With Private Garden Inner Photos', 'properties/45/project/ca36b936-c9b2-4842-bb0e-aa33fd69a765.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:12:15', '2025-09-30 23:12:15'),
(481, 45, 'project', 'Fully Furnished Ground Floor With Private Garden Interiors', 'properties/45/project/b86f88a3-e6f3-4269-94e1-9a8ac345c393.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:12:16', '2025-09-30 23:12:16'),
(482, 45, 'project', 'Fully Furnished Ground Floor With Private Garden Interiors', 'properties/45/project/c343850e-7553-433d-bb2f-1f52ff999d8e.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:12:16', '2025-09-30 23:12:16'),
(483, 46, 'project', '5 BHK House with Swimming Pool Exteriors', 'properties/46/project/f8dff180-2415-4d96-8672-98de1c14895d.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:12:17', '2025-09-30 23:12:17'),
(484, 46, 'project', '5 BHK House with Swimming Pool Inner Photos', 'properties/46/project/076740e4-4eb9-4044-b7c4-72df00a1f794.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:12:18', '2025-09-30 23:12:18'),
(485, 46, 'project', '5 BHK House with Swimming Pool Inner Photos', 'properties/46/project/7b9688fb-ac15-4dd5-9470-86f360ab5645.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:12:18', '2025-09-30 23:12:18'),
(486, 46, 'project', '5 BHK House with Swimming Pool Inner Photos', 'properties/46/project/f26db799-9e43-4e94-96bd-051a7508e306.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:12:19', '2025-09-30 23:12:19'),
(487, 46, 'project', '5 BHK House with Swimming Pool Inner Photos', 'properties/46/project/ea131821-97c4-499d-9def-c20a9ada82cb.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:12:19', '2025-09-30 23:12:19'),
(488, 46, 'project', '5 BHK House with Swimming Pool Interiors', 'properties/46/project/f14d6155-4639-4b01-958c-0184e190f8f9.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:12:20', '2025-09-30 23:12:20'),
(489, 46, 'project', '5 BHK House with Swimming Pool Interiors', 'properties/46/project/4ec411bc-51f9-481f-8d14-96d01eea8a93.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:12:21', '2025-09-30 23:12:21'),
(490, 46, 'project', '5 BHK House with Swimming Pool Interiors', 'properties/46/project/7e24c6e3-1310-4218-9259-a03ee5c36265.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:12:21', '2025-09-30 23:12:21'),
(491, 46, 'project', '5 BHK House with Swimming Pool Interiors', 'properties/46/project/64c87dff-8121-4783-a484-5d06fb8a2ba8.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:12:22', '2025-09-30 23:12:22'),
(492, 46, 'project', '5 BHK House with Swimming Pool Interiors', 'properties/46/project/4d385919-2d2a-4a5e-9aad-92bf66888a4d.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:12:22', '2025-09-30 23:12:22'),
(493, 46, 'project', '5 BHK House with Swimming Pool Interiors', 'properties/46/project/dc1192d9-d62e-45a4-903f-e539ac16426f.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:12:23', '2025-09-30 23:12:23'),
(494, 46, 'project', '5 BHK House with Swimming Pool Exterior Photos', 'properties/46/project/c641a353-5925-433a-b180-dfa8ff00c2c6.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:12:24', '2025-09-30 23:12:24'),
(495, 46, 'project', '5 BHK House with Swimming Pool Exterior Photos', 'properties/46/project/d1a6f1e7-91f3-4df0-a138-9b80f345de8c.jpg', '', 0, 0, 0, 13, 1, '2025-09-30 23:12:24', '2025-09-30 23:12:24'),
(496, 46, 'project', '5 BHK House with Swimming Pool Exteriors', 'properties/46/project/fa214647-a976-46ad-838f-cfd686ee7246.jpg', '', 0, 0, 0, 14, 1, '2025-09-30 23:12:25', '2025-09-30 23:12:25'),
(497, 46, 'project', '5 BHK House with Swimming Pool Exterior Photos', 'properties/46/project/75c66e64-6e65-431a-bfcd-3f241a324b2c.jpg', '', 0, 0, 0, 15, 1, '2025-09-30 23:12:25', '2025-09-30 23:12:25'),
(498, 46, 'project', '5 BHK House with Swimming Pool Exterior Photos', 'properties/46/project/fd7d3fdd-655c-4afa-8688-6e11915c812d.jpg', '', 0, 0, 0, 16, 1, '2025-09-30 23:12:26', '2025-09-30 23:12:26'),
(499, 47, 'project', '4BHK Villa With Pool Facing Mandovi River Exteriors', 'properties/47/project/aea6364e-33bf-4672-a90a-e564e754dc32.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:12:27', '2025-09-30 23:12:27'),
(500, 47, 'project', '4BHK Villa With Pool Facing Mandovi River Exteriors', 'properties/47/project/540fb6d2-849b-4857-a072-fee8b9752a3d.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:12:27', '2025-09-30 23:12:27'),
(501, 47, 'project', '4BHK Villa With Pool Facing Mandovi River Exteriors', 'properties/47/project/5149e6f3-3740-4d01-b9fc-67577b2ebd47.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:12:28', '2025-09-30 23:12:28'),
(502, 47, 'project', '4BHK Villa With Pool Facing Mandovi River Exterior Photos', 'properties/47/project/7e5df095-998c-4b2b-8c4b-81b694e607d0.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:12:28', '2025-09-30 23:12:28'),
(503, 47, 'project', '4BHK Villa With Pool Facing Mandovi River Exteriors', 'properties/47/project/9ae37c46-a7dd-4506-8129-ae2f1c1d331d.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:12:29', '2025-09-30 23:12:29'),
(504, 47, 'project', '4BHK Villa With Pool Facing Mandovi River Exteriors', 'properties/47/project/414b8043-d2e5-4274-b69a-45884d6c2720.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:12:30', '2025-09-30 23:12:30'),
(505, 47, 'project', '4BHK Villa With Pool Facing Mandovi River Exteriors', 'properties/47/project/1f70608c-8aa5-4100-a2fb-821ab0d324af.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:12:30', '2025-09-30 23:12:30'),
(506, 47, 'project', '4BHK Villa With Pool Facing Mandovi River Exterior Photos', 'properties/47/project/ecbbcf2f-dd93-4238-a189-984e45c311a7.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:12:31', '2025-09-30 23:12:31'),
(507, 47, 'project', '4BHK Villa With Pool Facing Mandovi River Inner Photos', 'properties/47/project/2c8f111b-f707-4866-95bc-b99979bc0e5a.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:12:31', '2025-09-30 23:12:31'),
(508, 47, 'project', '4BHK Villa With Pool Facing Mandovi River Interiors', 'properties/47/project/25d4372d-3b30-4030-ac87-4520dc1f083b.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:12:32', '2025-09-30 23:12:32'),
(509, 47, 'project', '4BHK Villa With Pool Facing Mandovi River Interiors', 'properties/47/project/8474e5a2-51af-4fde-8b8f-7969f1511ef1.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:12:32', '2025-09-30 23:12:32'),
(510, 47, 'project', '4BHK Villa With Pool Facing Mandovi River Interiors', 'properties/47/project/743431b4-fdad-482d-b749-1cd3da222309.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:12:33', '2025-09-30 23:12:33'),
(511, 48, 'project', 'Maintained Portuguese House Exterior Photos', 'properties/48/project/8f54bceb-155d-4fdf-a940-ac29802164ff.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:12:33', '2025-09-30 23:12:33'),
(512, 48, 'project', 'Maintained Portuguese House Inner Photos', 'properties/48/project/8f0d1253-a25b-4378-b1ce-9703c9edf3df.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:12:34', '2025-09-30 23:12:34'),
(513, 48, 'project', 'Maintained Portuguese House Inner Photos', 'properties/48/project/8ed2dc99-0ca2-4875-97e2-ebc1053fb96d.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:12:34', '2025-09-30 23:12:34'),
(514, 48, 'project', 'Maintained Portuguese House Inner Photos', 'properties/48/project/04c5d2f4-823f-4181-868e-ffe3a6e0abdd.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:12:35', '2025-09-30 23:12:35'),
(515, 48, 'project', 'Maintained Portuguese House Inner Photos', 'properties/48/project/acc7d4fa-39bf-41bb-999f-de918782870e.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:12:35', '2025-09-30 23:12:35'),
(516, 48, 'project', 'Maintained Portuguese House Inner Photos', 'properties/48/project/9936800b-2b60-411d-a83c-9bd30b2af4af.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:12:36', '2025-09-30 23:12:36'),
(517, 48, 'project', 'Maintained Portuguese House Interiors', 'properties/48/project/baf271ff-915e-485d-b458-023655b4274a.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:12:36', '2025-09-30 23:12:36'),
(518, 48, 'project', 'Maintained Portuguese House Exterior Photos', 'properties/48/project/ecfb0ce9-bf8a-4524-84d4-ec89eb6290e4.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:12:37', '2025-09-30 23:12:37'),
(519, 49, 'project', 'Independent Private Pool Villa Exteriors', 'properties/49/project/a5862544-f1e9-4979-815f-d6d923195aa6.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:12:37', '2025-09-30 23:12:37'),
(520, 49, 'project', 'Independent Private Pool Villa Interiors', 'properties/49/project/0b5f6852-3075-4ee3-8180-2c36d70b0853.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:12:38', '2025-09-30 23:12:38'),
(521, 49, 'project', 'Independent Private Pool Villa Inner Photos', 'properties/49/project/0a833f84-31d4-4a07-ae94-def5280ed8f8.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:12:39', '2025-09-30 23:12:39'),
(522, 49, 'project', 'Independent Private Pool Villa Inner Photos', 'properties/49/project/dad4bc7e-8602-439f-aa6f-ee1fcecd4bc3.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:12:39', '2025-09-30 23:12:39'),
(523, 49, 'project', 'Independent Private Pool Villa Inner Photos', 'properties/49/project/e8fcf9ad-f37c-4f81-b4d9-94619ff30b7a.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:12:40', '2025-09-30 23:12:40'),
(524, 49, 'project', 'Independent Private Pool Villa Inner Photos', 'properties/49/project/ec8237b7-d390-4acb-a926-a32a1b7e777a.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:12:40', '2025-09-30 23:12:40'),
(525, 49, 'project', 'Independent Private Pool Villa Interiors', 'properties/49/project/ff6bada3-b65d-4218-9fc6-dc5f6cc8d673.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:12:41', '2025-09-30 23:12:41'),
(526, 49, 'project', 'Independent Private Pool Villa Interiors', 'properties/49/project/1c43b466-cf4d-452a-9b98-5accc38d5059.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:12:41', '2025-09-30 23:12:41'),
(527, 49, 'project', 'Independent Private Pool Villa Inner Photos', 'properties/49/project/c3227f77-fc53-4724-aa24-6cdbfaaff5b5.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:12:42', '2025-09-30 23:12:42'),
(528, 49, 'project', 'Independent Private Pool Villa Exterior Photos', 'properties/49/project/673fe785-1490-4b90-bcd4-88e9efb82e5e.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:12:42', '2025-09-30 23:12:42'),
(529, 49, 'project', 'Independent Private Pool Villa Exteriors', 'properties/49/project/832bf93b-38ea-4370-93df-0fef3556f876.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:12:43', '2025-09-30 23:12:43'),
(530, 49, 'project', 'Independent Private Pool Villa Exterior Photos', 'properties/49/project/8c53a3e6-4b3b-412f-b649-61cce50890be.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:12:44', '2025-09-30 23:12:44'),
(531, 50, 'project', 'Luxury Portuguese Villa With Pool ', 'properties/50/project/c33ccc22-849b-48b0-a827-9cdcee0180ed.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:12:45', '2025-09-30 23:12:45'),
(532, 50, 'project', 'Luxury Portuguese Villa With Pool Inner Photos', 'properties/50/project/75685aea-27e2-47a2-a1ea-25641e6ed251.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:12:46', '2025-09-30 23:12:46'),
(533, 50, 'project', 'Luxury Portuguese Villa With Pool Interiors', 'properties/50/project/4b620cef-6752-4e11-9ffd-67151f2bf64f.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:12:46', '2025-09-30 23:12:46'),
(534, 50, 'project', 'Luxury Portuguese Villa With Pool Inner Photos', 'properties/50/project/130dae6a-4644-4791-b0e4-ac9e86b32172.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:12:47', '2025-09-30 23:12:47'),
(535, 50, 'project', 'Luxury Portuguese Villa With Pool Inner Photos', 'properties/50/project/3ef33f7d-4a2c-4a86-baf2-622c8fa0fd8e.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:12:48', '2025-09-30 23:12:48'),
(536, 50, 'project', 'Luxury Portuguese Villa With Pool Exterior Photos', 'properties/50/project/1a3cd9b0-3c09-4987-b13e-1c234ff94336.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:12:48', '2025-09-30 23:12:48'),
(537, 50, 'project', 'Luxury Portuguese Villa With Pool Exterior Photos', 'properties/50/project/74ae131b-c018-447e-931f-fae7d200bb21.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:12:49', '2025-09-30 23:12:49'),
(538, 50, 'project', 'Luxury Portuguese Villa With Pool Exterior Photos', 'properties/50/project/404bcf1f-c371-4e5e-8f9f-fa3cb6026ae1.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:12:50', '2025-09-30 23:12:50'),
(539, 51, 'logo', 'Imperial Residences by DLF Logo', 'properties/51/logo/46df4888-5f9a-4016-8118-38c1d6baed76.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:12:51', '2025-09-30 23:12:51'),
(540, 51, 'project', 'Imperial Residences by DLF Exteriors', 'properties/51/project/575a98be-b1ab-4668-935e-4bb5426a4faa.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:12:51', '2025-09-30 23:12:51'),
(541, 51, 'project', 'Imperial Residences by DLF Exteriors', 'properties/51/project/699a1126-b43d-489a-9c58-cc5253943faa.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:12:52', '2025-09-30 23:12:52'),
(542, 51, 'project', 'Imperial Residences by DLF Exteriors', 'properties/51/project/9a8f5b35-df21-44b6-8f54-bcef24b5fada.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:12:53', '2025-09-30 23:12:53'),
(543, 51, 'project', 'Imperial Residences by DLF Exteriors', 'properties/51/project/26aa2f31-5528-4d12-aa94-0fe4eb275a78.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:12:53', '2025-09-30 23:12:53'),
(544, 51, 'project', 'Imperial Residences by DLF Exteriors', 'properties/51/project/17dde52f-2dab-4c23-b12b-86b9982d9adb.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:12:54', '2025-09-30 23:12:54'),
(545, 52, 'project', 'Bennet and Bernard Luxury Home Front View', 'properties/52/project/d25ad553-e615-43f3-9889-33f7ad4e76af.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:12:55', '2025-09-30 23:12:55'),
(546, 52, 'project', 'Bennet and Bernard Luxury Home Interiors', 'properties/52/project/77f44f52-b7f1-4aae-af7b-ad4a60c77f79.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:12:55', '2025-09-30 23:12:55'),
(547, 52, 'project', 'Bennet and Bernard Luxury Home Interiors', 'properties/52/project/da0fb71c-7b1b-4109-9137-5ea525265694.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:12:56', '2025-09-30 23:12:56'),
(548, 52, 'project', 'Bennet and Bernard Luxury Home Interiors', 'properties/52/project/a957c9c0-62d8-4518-a084-343a91f549c5.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:12:56', '2025-09-30 23:12:56'),
(549, 52, 'project', 'Bennet and Bernard Luxury Home Bedroom', 'properties/52/project/d42dac51-5007-481f-aa47-7a71c9e76e6c.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:12:57', '2025-09-30 23:12:57'),
(550, 52, 'project', 'Bennet and Bernard Luxury Home Bedroom', 'properties/52/project/f8fdaa8b-6e25-4fe6-9968-2d81acbfb32d.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:12:57', '2025-09-30 23:12:57'),
(551, 52, 'project', 'Bennet and Bernard Luxury Home Kitchen', 'properties/52/project/a6102087-5d5a-40a0-b7f2-a0ddc0997bff.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:12:58', '2025-09-30 23:12:58'),
(552, 52, 'project', 'Bennet and Bernard Luxury Home Bathroom', 'properties/52/project/2c725af8-3cde-43ce-9af0-1360c4131e31.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:12:58', '2025-09-30 23:12:58'),
(553, 52, 'project', 'Bennet and Bernard Luxury Home Swimming Pool', 'properties/52/project/8a51dee9-9d0e-4fb7-9163-12c8ea111741.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:12:59', '2025-09-30 23:12:59'),
(554, 52, 'project', 'Bennet and Bernard Luxury Home Swimming Pool', 'properties/52/project/2625d9ac-f29b-4aec-b5c5-1a53d42cc2d5.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:12:59', '2025-09-30 23:12:59'),
(555, 53, 'project', '4BHK Independent Villa Landscape Garden', 'properties/53/project/341ef66d-bc3b-4d3b-ba22-74e95593b4f1.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:13:00', '2025-09-30 23:13:00'),
(556, 53, 'project', '4BHK Independent Villa Bedroom', 'properties/53/project/9f3329e2-b53d-4b7f-ab08-bf9384955b42.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:13:01', '2025-09-30 23:13:01'),
(557, 53, 'project', '4BHK Independent Villa Interiors', 'properties/53/project/88b7e9c3-fff4-47de-baa1-3d8a24a616eb.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:13:02', '2025-09-30 23:13:02'),
(558, 53, 'project', '4BHK Independent Villa Interiors', 'properties/53/project/b42d553f-0011-4c50-9623-c947af672271.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:13:02', '2025-09-30 23:13:02'),
(559, 53, 'project', '4BHK Independent Villa Interiors', 'properties/53/project/5fe219bc-8395-402f-abda-a60bff9fe13a.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:13:03', '2025-09-30 23:13:03'),
(560, 53, 'project', '4BHK Independent Villa Interiors', 'properties/53/project/a427a897-70bf-48aa-834c-c2488ada1632.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:13:04', '2025-09-30 23:13:04'),
(561, 53, 'project', '4BHK Independent Villa Interiors', 'properties/53/project/6680280a-34f4-461c-ac5e-127789a779cb.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:13:05', '2025-09-30 23:13:05'),
(562, 53, 'project', '4BHK Independent Villa Exteriors', 'properties/53/project/a9cc35bb-a759-4654-b90c-07895e9aa8f5.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:13:05', '2025-09-30 23:13:05'),
(563, 53, 'project', '4BHK Independent Villa Exteriors', 'properties/53/project/4676897e-92fc-41c0-920e-9cf72fa36a85.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:13:06', '2025-09-30 23:13:06'),
(564, 53, 'project', '4BHK Independent Villa Exteriors', 'properties/53/project/80b94bd6-ed05-41a5-897e-88f86c7ceec5.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:13:07', '2025-09-30 23:13:07'),
(565, 54, 'logo', 'Tulip Monsella Sector 53, Gurgaon - Ultra Luxury Apartments Logo', 'properties/54/logo/686269ee-cdfa-4194-a477-7b43b2d5fd47.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:13:07', '2025-09-30 23:13:07'),
(566, 54, 'project', 'Tulip Monsella Ultra Luxury Apartments Landscape Garden', 'properties/54/project/0c0ad9af-9e8c-46e6-b4d0-8d8be35ed4c1.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:13:08', '2025-09-30 23:13:08'),
(567, 54, 'project', 'Tulip Monsella Sector 53 Landscape Garden', 'properties/54/project/4b62ba19-4c04-4e94-aad8-e6e40264deda.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:13:09', '2025-09-30 23:13:09'),
(568, 54, 'project', 'Tulip Monsella Gurgaon Interiors', 'properties/54/project/6167e130-7424-4839-b5b3-0afdde6d7d98.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:13:09', '2025-09-30 23:13:09'),
(569, 54, 'project', 'Tulip Monsella Sector 53 Interiors', 'properties/54/project/bc43c263-f744-4341-b823-0d2a18f89caa.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:13:10', '2025-09-30 23:13:10'),
(570, 54, 'project', 'Tulip Monsella Gurgaon Interiors', 'properties/54/project/7ca1758d-77d4-476b-8c75-c1f002a50a68.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:13:11', '2025-09-30 23:13:11'),
(571, 54, 'project', 'Tulip Monsella Apartments Exteriors', 'properties/54/project/0d50247d-ea69-4c7d-a3c1-75d5ac3fec1f.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:13:11', '2025-09-30 23:13:11'),
(572, 54, 'project', 'Tulip Monsella Sector 53 Exteriors', 'properties/54/project/7a35108f-51e6-4ee8-b64b-cb6a09e925e5.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:13:12', '2025-09-30 23:13:12'),
(573, 54, 'project', 'Tulip Monsella Gurgaon Exteriors', 'properties/54/project/fed730cf-6569-4789-a519-e0ec6e8471d8.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:13:13', '2025-09-30 23:13:13'),
(574, 55, 'project', 'Upcoming Puri Construction Project Front View', 'properties/55/project/a2cb815c-16a5-4c91-811c-c66010209f4c.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:13:14', '2025-09-30 23:13:14'),
(575, 55, 'logo', 'Upcoming Puri Construction Project Logo', 'properties/55/logo/3a369153-b467-47b3-ab1a-594256e7963a.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:13:15', '2025-09-30 23:13:15'),
(576, 56, 'project', 'Godrej Connaught One Interiors', 'properties/56/project/ab66f854-3b5d-4ada-badf-6ea1dbcc9390.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:13:16', '2025-09-30 23:13:16'),
(577, 56, 'project', 'Godrej Connaught One Interiors', 'properties/56/project/7f10aa47-b27b-451b-9cee-a389ad6bc72c.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:13:17', '2025-09-30 23:13:17'),
(578, 56, 'project', 'Godrej Connaught One Interiors', 'properties/56/project/aaf79f7d-ddc1-4e9b-9088-3e87b566a717.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:13:17', '2025-09-30 23:13:17'),
(579, 56, 'project', 'Godrej Connaught One Interiors', 'properties/56/project/1fb602cf-ebfb-467a-8a24-60d11d0bb3ae.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:13:18', '2025-09-30 23:13:18'),
(580, 56, 'project', 'Godrej Connaught One Interiors', 'properties/56/project/d9f7adee-001c-4136-9ed6-abbef00d47b7.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:13:20', '2025-09-30 23:13:20'),
(581, 56, 'project', 'Godrej Connaught One Interiors', 'properties/56/project/b8509046-beaa-4683-b123-b2dd2691109f.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:13:20', '2025-09-30 23:13:20'),
(582, 58, 'project', 'Whiteland Blissville Front View', 'properties/58/project/042ccd01-79be-42b2-8af0-3fba9ea02197.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:13:24', '2025-09-30 23:13:24'),
(583, 58, 'project', 'Whiteland Blissville ', 'properties/58/project/c2990bd8-2f57-40cf-a599-e067dde69913.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:13:25', '2025-09-30 23:13:25'),
(584, 58, 'project', 'Whiteland Blissville ', 'properties/58/project/ab972401-d7c4-494b-88bc-a1fa0af66a4f.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:13:25', '2025-09-30 23:13:25'),
(585, 58, 'project', 'Whiteland Blissville ', 'properties/58/project/70e67bfd-8862-444d-8de7-1806603e6a49.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:13:26', '2025-09-30 23:13:26'),
(586, 58, 'project', 'Whiteland Blissville ', 'properties/58/project/bf2ca8a1-8c2b-4ce0-9359-91c5b2a31810.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:13:27', '2025-09-30 23:13:27'),
(587, 59, 'project', 'Duplex Villa - Malibu Towne Gurgaon Exteriors', 'properties/59/project/21a5d638-feea-41d7-ae57-c4a580e9d183.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:13:28', '2025-09-30 23:13:28'),
(588, 59, 'project', 'Duplex Villa - Malibu Towne Gurgaon Interiors', 'properties/59/project/d66f4883-e9e0-4180-a3de-d941f46df2d3.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:13:29', '2025-09-30 23:13:29'),
(589, 59, 'project', 'Duplex Villa - Malibu Towne Gurgaon Interiors', 'properties/59/project/c0927bee-49f6-454b-9af5-ae1c2c073011.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:13:30', '2025-09-30 23:13:30'),
(590, 59, 'project', 'Duplex Villa - Malibu Towne Gurgaon Bedroom', 'properties/59/project/5be5b1d2-0f33-4653-b94e-b2ab34cba693.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:13:30', '2025-09-30 23:13:30'),
(591, 59, 'project', 'Duplex Villa - Malibu Towne Gurgaon Bedroom', 'properties/59/project/d7a5cb42-720d-420d-9ee2-b8a5f51da534.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:13:31', '2025-09-30 23:13:31'),
(592, 59, 'project', 'Duplex Villa - Malibu Towne Gurgaon Bedroom', 'properties/59/project/ced619d0-7e10-4031-af2a-5c82d369c55e.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:13:32', '2025-09-30 23:13:32'),
(593, 59, 'project', 'Duplex Villa - Malibu Towne Gurgaon Landscape Garden', 'properties/59/project/b52c8507-2890-4ac3-b51e-514127966717.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:13:33', '2025-09-30 23:13:33'),
(594, 59, 'project', 'Duplex Villa - Malibu Towne Gurgaon Landscape Garden', 'properties/59/project/62424ca9-83f5-4ed1-911c-08f3c5cb3817.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:13:33', '2025-09-30 23:13:33'),
(595, 59, 'project', 'Duplex Villa - Malibu Towne Gurgaon Lobby', 'properties/59/project/caf87136-c2f5-468c-897c-139e12b0c449.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:13:34', '2025-09-30 23:13:34'),
(596, 59, 'project', 'Duplex Villa - Malibu Towne Gurgaon Front View', 'properties/59/project/1532d4cc-344f-4fdb-b764-f47c07c0db1e.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:13:34', '2025-09-30 23:13:34'),
(597, 59, 'project', 'Duplex Villa - Malibu Towne Gurgaon Landscape Garden', 'properties/59/project/ac456f02-87c4-4c16-bc5a-48e08f30be5f.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:13:35', '2025-09-30 23:13:35'),
(598, 60, 'project', 'DLF The Grove Exteriors', 'properties/60/project/bc19d485-43ad-4010-b7d8-53da4f48935e.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:13:36', '2025-09-30 23:13:36'),
(599, 60, 'project', 'DLF The Grove Interiors', 'properties/60/project/b49e4a22-cd25-499e-91ba-80e0e9554e22.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:13:37', '2025-09-30 23:13:37'),
(600, 60, 'project', 'DLF The Grove Exteriors', 'properties/60/project/af1bb0e2-14cd-4334-b0e8-61040640de1b.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:13:38', '2025-09-30 23:13:38'),
(601, 60, 'project', 'DLF The Grove Floor Plan', 'properties/60/project/6c5a98fb-5c0b-42ff-bf16-7d345b2e2047.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:13:39', '2025-09-30 23:13:39'),
(602, 60, 'project', 'DLF The Grove Bedroom', 'properties/60/project/347b539b-2f24-450a-8fc4-99a20cb991a1.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:13:39', '2025-09-30 23:13:39'),
(603, 60, 'project', 'DLF The Grove Lobby', 'properties/60/project/024fc969-5993-4af9-9c3f-6521225be69d.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:13:40', '2025-09-30 23:13:40'),
(604, 60, 'project', 'DLF The Grove Bathroom', 'properties/60/project/c6eb38b2-f9dd-4e3a-9aba-435cd4842183.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:13:41', '2025-09-30 23:13:41'),
(605, 60, 'project', 'DLF The Grove Kitchen', 'properties/60/project/f5b1e99c-142d-4eee-a724-50469a8af29a.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:13:41', '2025-09-30 23:13:41'),
(606, 60, 'project', 'DLF The Grove Exteriors', 'properties/60/project/9b17ac71-69d5-4e32-bb36-6a3fa1f9669d.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:13:42', '2025-09-30 23:13:42'),
(607, 60, 'project', 'DLF The Grove Interiors', 'properties/60/project/1db1d04c-d098-41ee-b281-df5d776f74ab.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:13:42', '2025-09-30 23:13:42'),
(608, 61, 'project', '4 BHK Luxury Independent Villa Swimming Pool', 'properties/61/project/50842ee0-b413-4cc4-8ffa-08308241b60d.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:13:43', '2025-09-30 23:13:43'),
(609, 61, 'project', '4 BHK Luxury Independent Villa Exteriors', 'properties/61/project/8d466b9e-6fe9-4afc-a45f-52e7dc6d5e8b.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:13:44', '2025-09-30 23:13:44'),
(610, 61, 'project', '4 BHK Luxury Independent Villa Exteriors', 'properties/61/project/b59162b3-1cb4-4534-9224-675b084929c2.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:13:44', '2025-09-30 23:13:44'),
(611, 61, 'project', '4 BHK Luxury Independent Villa Landscape Garden', 'properties/61/project/227ad78b-8c22-4802-aacd-0e798690711c.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:13:45', '2025-09-30 23:13:45'),
(612, 61, 'project', '4 BHK Luxury Independent Villa Interiors', 'properties/61/project/df234ea4-1435-4043-a61f-6d94a6efcffc.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:13:46', '2025-09-30 23:13:46'),
(613, 61, 'project', '4 BHK Luxury Independent Villa Lobby', 'properties/61/project/c696c4a0-8adb-414d-a770-5302e975bcd0.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:13:46', '2025-09-30 23:13:46'),
(614, 61, 'project', '4 BHK Luxury Independent Villa Bedroom', 'properties/61/project/e8bacdad-1c20-4c64-9714-c6b40f4b8c47.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:13:47', '2025-09-30 23:13:47');
INSERT INTO `property_images` (`id`, `property_id`, `type`, `alt_type`, `image_path`, `caption`, `is_banner`, `is_thumbnail`, `is_thumbnail_2`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(615, 63, 'project', 'Elan The Presidential ', 'properties/63/project/3ffedf7c-2876-45fb-a8d8-da89cc9d661b.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:13:48', '2025-09-30 23:13:48'),
(616, 63, 'project', 'Elan The Presidential Exteriors', 'properties/63/project/9e67164d-2ed1-480b-8302-cd2378c3c3a4.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:13:49', '2025-09-30 23:13:49'),
(617, 63, 'project', 'Elan The Presidential Exteriors', 'properties/63/project/fee3438b-91d2-45aa-8c14-a914aad0a23d.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:13:49', '2025-09-30 23:13:49'),
(618, 64, 'project', 'DLF Upcoming Project Exteriors', 'properties/64/project/38e1fe8e-80dc-4f42-8700-85c75046900e.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:13:50', '2025-09-30 23:13:50'),
(619, 65, 'project', 'Pursuit of a Radical Rhapsody (POARR) Landscape Garden', 'properties/65/project/19c8c01b-b3e6-4e99-bb96-c627c7b948ab.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:13:51', '2025-09-30 23:13:51'),
(620, 65, 'project', 'Pursuit of a Radical Rhapsody (POARR) Exteriors', 'properties/65/project/d6347886-1d90-4f40-b6ce-94559dce1f24.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:13:52', '2025-09-30 23:13:52'),
(621, 65, 'project', 'Pursuit of a Radical Rhapsody (POARR) Exteriors', 'properties/65/project/e19c4342-8cc2-4e20-a0c4-900c86d4298b.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:13:53', '2025-09-30 23:13:53'),
(622, 65, 'project', 'Pursuit of a Radical Rhapsody (POARR) Exteriors', 'properties/65/project/c00cecab-52e3-4fd0-87ed-9b9fc1da184a.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:13:53', '2025-09-30 23:13:53'),
(623, 65, 'project', 'Pursuit of a Radical Rhapsody (POARR) Exteriors', 'properties/65/project/734c839f-d56f-4a7a-acba-890c47fd95db.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:13:54', '2025-09-30 23:13:54'),
(624, 65, 'project', 'Pursuit of a Radical Rhapsody (POARR) Interiors', 'properties/65/project/5ce4e752-bcf4-4907-9b3d-9b554cf1b3e4.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:13:55', '2025-09-30 23:13:55'),
(625, 65, 'project', 'Pursuit of a Radical Rhapsody (POARR) Interiors', 'properties/65/project/42255b20-21fe-4870-8989-6237593b18e4.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:13:56', '2025-09-30 23:13:56'),
(626, 65, 'project', 'Pursuit of a Radical Rhapsody (POARR) Interiors', 'properties/65/project/80ef44dc-4414-40dd-8a62-afaf031f3724.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:13:57', '2025-09-30 23:13:57'),
(627, 65, 'project', 'Pursuit of a Radical Rhapsody (POARR) Interiors', 'properties/65/project/67fca3b2-02d5-45cc-8778-eaa2c6f2ebf1.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:13:57', '2025-09-30 23:13:57'),
(628, 65, 'project', 'Pursuit of a Radical Rhapsody (POARR) Landscape Garden', 'properties/65/project/819ff7e9-9b92-462a-a266-b0c89da5e03a.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:13:58', '2025-09-30 23:13:58'),
(629, 65, 'project', 'Pursuit of a Radical Rhapsody (POARR) Landscape Garden', 'properties/65/project/f07a6f6d-bcb3-4f98-9d0a-a3393f2d1782.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:13:59', '2025-09-30 23:13:59'),
(630, 65, 'project', 'Pursuit of a Radical Rhapsody (POARR) Landscape Garden', 'properties/65/project/0bb5147f-d5a1-4133-8dbe-9739928b5ae9.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:14:00', '2025-09-30 23:14:00'),
(631, 66, 'project', 'In That Quiet Earth (ITQE) Lobby', 'properties/66/project/a47fbbc1-608f-481a-a3e2-311126181903.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:14:01', '2025-09-30 23:14:01'),
(632, 66, 'project', 'In That Quiet Earth (ITQE) Interiors', 'properties/66/project/8ba229df-ee56-4d25-9ea2-2b9b895a27d6.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:14:02', '2025-09-30 23:14:02'),
(633, 66, 'project', 'In That Quiet Earth (ITQE) Interiors', 'properties/66/project/1844f717-b715-48af-9fac-f64e5ce0301c.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:14:03', '2025-09-30 23:14:03'),
(634, 66, 'project', 'In That Quiet Earth (ITQE) Interiors', 'properties/66/project/1b8f929c-ea01-4aff-9ec1-43e00dd56961.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:14:04', '2025-09-30 23:14:04'),
(635, 66, 'project', 'In That Quiet Earth (ITQE) Swimming Pool', 'properties/66/project/578adaca-efa7-4380-960b-474cb07cb684.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:14:05', '2025-09-30 23:14:05'),
(636, 66, 'project', 'In That Quiet Earth (ITQE) Exteriors', 'properties/66/project/b22c9ba6-e494-4833-93da-6e8267e99ff3.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:14:05', '2025-09-30 23:14:05'),
(637, 66, 'project', 'In That Quiet Earth (ITQE) Exteriors', 'properties/66/project/014cdce4-729c-4cce-a233-1f2dfe94c171.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:14:07', '2025-09-30 23:14:07'),
(638, 66, 'project', 'In That Quiet Earth (ITQE) Interiors', 'properties/66/project/5ccdaa70-741b-408d-83c0-ef5f0d5e0bfd.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:14:08', '2025-09-30 23:14:08'),
(639, 67, 'project', '3 BHK Apartment for Sale Exteriors', 'properties/67/project/d133ea46-d015-4648-a3a9-1786489b0fb4.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:14:09', '2025-09-30 23:14:09'),
(640, 67, 'project', '3 BHK Apartment for Sale Bedroom', 'properties/67/project/1b5360f7-e675-44b1-9418-5f655e4dd2dd.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:14:10', '2025-09-30 23:14:10'),
(641, 67, 'project', '3 BHK Apartment for Sale Bedroom', 'properties/67/project/88fd2fb7-025b-482f-89e7-f9f3530a5c34.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:14:10', '2025-09-30 23:14:10'),
(642, 67, 'project', '3 BHK Apartment for Sale Bedroom', 'properties/67/project/a87b2e80-75b2-402f-a0dc-0c1ff3ff17fe.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:14:11', '2025-09-30 23:14:11'),
(643, 67, 'project', '3 BHK Apartment for Sale Kitchen', 'properties/67/project/8180a0de-b857-488e-84c9-12cbad56f1bc.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:14:11', '2025-09-30 23:14:11'),
(644, 67, 'project', '3 BHK Apartment for Sale Interiors', 'properties/67/project/3d3b2837-2f3e-4658-96ca-ab053d167441.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:14:12', '2025-09-30 23:14:12'),
(645, 67, 'project', '3 BHK Apartment for Sale Interiors', 'properties/67/project/5a9ba2d8-3c6e-4851-8c93-b1cf584a6bda.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:14:13', '2025-09-30 23:14:13'),
(646, 67, 'project', '3 BHK Apartment for Sale Interiors', 'properties/67/project/dced743a-e3d7-411a-b898-941c0e6076bd.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:14:13', '2025-09-30 23:14:13'),
(647, 67, 'project', '3 BHK Apartment for Sale Exteriors', 'properties/67/project/fbf99ce4-69e9-43a1-ad0d-ab6ddcf37b0f.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:14:14', '2025-09-30 23:14:14'),
(648, 67, 'project', '3 BHK Apartment for Sale Exteriors', 'properties/67/project/59468dfd-42b6-48cd-a0d4-a7e02e89ba37.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:14:15', '2025-09-30 23:14:15'),
(649, 67, 'project', '3 BHK Apartment for Sale Exteriors', 'properties/67/project/51467671-01f4-467d-baa4-1e28f1721d97.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:14:15', '2025-09-30 23:14:15'),
(650, 67, 'project', '3 BHK Apartment for Sale Lobby', 'properties/67/project/efb9d12d-91aa-489a-83be-d2dd6a4bf271.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:14:16', '2025-09-30 23:14:16'),
(651, 68, 'project', 'Villa for Resale in Marsierra Exteriors', 'properties/68/project/b18c27d6-56ed-4a58-84dc-c8e7efe59b68.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:14:16', '2025-09-30 23:14:16'),
(652, 68, 'project', 'Villa for Resale in Marsierra Interiors', 'properties/68/project/e63585f5-9811-4adb-ba87-77ed169af2a4.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:14:17', '2025-09-30 23:14:17'),
(653, 68, 'project', 'Villa for Resale in Marsierra Interiors', 'properties/68/project/a824c45a-36ec-4ea7-bf73-6666f72c1e1f.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:14:18', '2025-09-30 23:14:18'),
(654, 68, 'project', 'Villa for Resale in Marsierra Interiors', 'properties/68/project/da999716-44f3-4706-b089-d8fdf3c4355d.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:14:18', '2025-09-30 23:14:18'),
(655, 68, 'project', 'Villa for Resale in Marsierra Interiors', 'properties/68/project/f81cb28e-7138-4eec-b8d3-0817930359a5.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:14:19', '2025-09-30 23:14:19'),
(656, 68, 'project', 'Villa for Resale in Marsierra Interiors', 'properties/68/project/68f32e7b-10ae-4e71-b658-563b37ffa281.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:14:20', '2025-09-30 23:14:20'),
(657, 68, 'project', 'Villa for Resale in Marsierra Bedroom', 'properties/68/project/b028c5ba-2aa2-4eb8-8f2a-a6dda5a72258.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:14:21', '2025-09-30 23:14:21'),
(658, 68, 'project', 'Villa for Resale in Marsierra Bedroom', 'properties/68/project/45784621-62e2-47b3-be4c-ab0ae8f26121.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:14:21', '2025-09-30 23:14:21'),
(659, 68, 'project', 'Villa for Resale in Marsierra Swimming Pool', 'properties/68/project/b9bdcbf7-8553-4cb4-a982-1099f76ddd13.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:14:22', '2025-09-30 23:14:22'),
(660, 68, 'project', 'Villa for Resale in Marsierra Swimming Pool', 'properties/68/project/fd8f5a66-7f7c-472f-91ca-6ac27528891b.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:14:23', '2025-09-30 23:14:23'),
(661, 68, 'project', 'Villa for Resale in Marsierra Landscape Garden', 'properties/68/project/2bc043f7-b9e8-42bc-8b2d-3dd233b16c0c.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:14:23', '2025-09-30 23:14:23'),
(662, 68, 'project', 'Villa for Resale in Marsierra Landscape Garden', 'properties/68/project/0c95166d-3576-4dca-912c-1d53563d9f8c.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:14:24', '2025-09-30 23:14:24'),
(663, 69, 'project', 'Code 66 Interiors', 'properties/69/project/526379ec-3ea8-4845-a7cf-141d6cb935ae.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:14:25', '2025-09-30 23:14:25'),
(664, 69, 'project', 'Code 66 Interiors', 'properties/69/project/351809f1-e850-42e7-8a36-e8f851517688.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:14:25', '2025-09-30 23:14:25'),
(665, 69, 'project', 'Code 66 Interiors', 'properties/69/project/6f93fedc-5c6c-499b-b9cd-d2c08954dced.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:14:26', '2025-09-30 23:14:26'),
(666, 69, 'project', 'Code 66 Interiors', 'properties/69/project/3513c717-4c96-48ee-94b7-3023bcfe355d.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:14:27', '2025-09-30 23:14:27'),
(667, 69, 'project', 'Code 66 Bathroom', 'properties/69/project/43906c26-4f16-484e-a0d0-7d778e3dd8aa.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:14:28', '2025-09-30 23:14:28'),
(668, 69, 'project', 'Code 66 Bathroom', 'properties/69/project/dee3a881-594d-47fc-9e92-8ef123a4ab0c.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:14:28', '2025-09-30 23:14:28'),
(669, 69, 'project', 'Code 66 Kitchen', 'properties/69/project/98424227-8bcf-405c-89e7-99fdcc340693.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:14:29', '2025-09-30 23:14:29'),
(670, 69, 'project', 'Code 66 Bedroom', 'properties/69/project/aea5feb2-ca71-4d1e-9a96-dee52ff6dcca.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:14:30', '2025-09-30 23:14:30'),
(671, 70, 'project', 'Smart World One DXP Exteriors', 'properties/70/project/e0888b1b-1509-4ed4-bd68-bedaae6d3f88.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:14:31', '2025-09-30 23:14:31'),
(672, 71, 'project', 'Conscient Vista Arrozal Exteriors', 'properties/71/project/c8545e2c-31ae-4f16-8d02-aeea0b4b3077.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:14:32', '2025-09-30 23:14:32'),
(673, 71, 'project', 'Conscient Vista Arrozal Bathroom', 'properties/71/project/c4ff0d3d-757f-491f-8ed0-3df180701e49.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:14:33', '2025-09-30 23:14:33'),
(674, 71, 'project', 'Conscient Vista Arrozal Bedroom', 'properties/71/project/ef889618-e70b-4954-a50d-d632392c8e2b.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:14:34', '2025-09-30 23:14:34'),
(675, 71, 'project', 'Conscient Vista Arrozal Swimming Pool', 'properties/71/project/bbe995be-7340-467b-8089-9d4e19888ac9.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:14:34', '2025-09-30 23:14:34'),
(676, 71, 'project', 'Conscient Vista Arrozal Kitchen', 'properties/71/project/dec4116b-ff66-4718-b64f-58cc34ce773d.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:14:35', '2025-09-30 23:14:35'),
(677, 71, 'project', 'Conscient Vista Arrozal Exteriors', 'properties/71/project/1bbbd9df-7209-44ee-a174-91efa8d5a8df.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:14:36', '2025-09-30 23:14:36'),
(678, 71, 'project', 'Conscient Vista Arrozal Exteriors', 'properties/71/project/63eaac16-cfb9-42c6-86f2-22ecede5ff8c.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:14:37', '2025-09-30 23:14:37'),
(679, 71, 'project', 'Conscient Vista Arrozal Exteriors', 'properties/71/project/f08b7bd4-07ae-4bea-a30a-fea2ceab935c.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:14:38', '2025-09-30 23:14:38'),
(680, 71, 'project', 'Conscient Vista Arrozal Exteriors', 'properties/71/project/39f68b9a-62e2-46dc-9d9e-d08cfeae6d29.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:14:39', '2025-09-30 23:14:39'),
(681, 72, 'project', 'Emaar Urban Oasis Exteriors', 'properties/72/project/b3737fb0-b1ea-4b69-b2eb-9b36c3f3c953.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:14:40', '2025-09-30 23:14:40'),
(682, 73, 'project', 'M3M Crown Exteriors', 'properties/73/project/0a62d6ba-c1a3-4924-a92c-b28608170a7d.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:14:42', '2025-09-30 23:14:42'),
(683, 73, 'project', 'M3M Crown Interiors', 'properties/73/project/f489d8b1-1370-4d48-a6ca-5e0b7d9b49c4.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:14:42', '2025-09-30 23:14:42'),
(684, 73, 'project', 'M3M Crown Interiors', 'properties/73/project/05c4bf95-f301-4546-906b-f6afa14cc63d.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:14:43', '2025-09-30 23:14:43'),
(685, 73, 'project', 'M3M Crown Bedroom', 'properties/73/project/15d7109c-fa14-4926-9ece-a38a2129e835.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:14:44', '2025-09-30 23:14:44'),
(686, 73, 'project', 'M3M Crown Exteriors', 'properties/73/project/0a6131ee-9b0a-40a9-860b-ac5d5d7b3110.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:14:45', '2025-09-30 23:14:45'),
(687, 73, 'project', 'M3M Crown Exteriors', 'properties/73/project/b1d12259-149b-45f8-a89e-0220ba0d97fc.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:14:45', '2025-09-30 23:14:45'),
(688, 73, 'project', 'M3M Crown Exteriors', 'properties/73/project/1f0fda2f-9984-49cd-ac88-7e453c8d13a7.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:14:46', '2025-09-30 23:14:46'),
(689, 73, 'project', 'M3M Crown Lobby', 'properties/73/project/7edc69f1-e88f-4fd3-b2e2-7b149bf46ec3.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:14:47', '2025-09-30 23:14:47'),
(690, 74, 'project', 'Purva Zenium Exteriors', 'properties/74/project/69e77771-b024-4b7a-827b-134ab3528204.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:14:48', '2025-09-30 23:14:48'),
(691, 74, 'project', 'Purva Zenium Landscape Garden', 'properties/74/project/c5041626-4104-4518-9ccd-dbe38129b200.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:14:49', '2025-09-30 23:14:49'),
(692, 74, 'project', 'Purva Zenium Landscape Garden', 'properties/74/project/61c6075c-42eb-4f1f-9fcb-f57eae197e4c.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:14:50', '2025-09-30 23:14:50'),
(693, 74, 'project', 'Purva Zenium Exteriors', 'properties/74/project/084a3a36-ce17-4afa-b1ac-8d579cf2755c.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:14:50', '2025-09-30 23:14:50'),
(694, 75, 'project', 'Purva Meraki Exteriors', 'properties/75/project/9443abd6-cc3c-46f0-9ab0-ff85f49be9b7.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:14:51', '2025-09-30 23:14:51'),
(695, 75, 'project', 'Purva Meraki Bedroom', 'properties/75/project/a864e6ef-9859-438e-8070-d44c184b63d4.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:14:52', '2025-09-30 23:14:52'),
(696, 75, 'project', 'Purva Meraki Bedroom', 'properties/75/project/d79a64db-b14e-42f6-b8de-2139cacfafe1.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:14:52', '2025-09-30 23:14:52'),
(697, 75, 'project', 'Purva Meraki Kitchen', 'properties/75/project/93db60df-7f41-4bdd-ad27-2a369310257f.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:14:53', '2025-09-30 23:14:53'),
(698, 75, 'project', 'Purva Meraki Interiors', 'properties/75/project/cb6c4530-9a1b-4dd4-bca9-5ed75080ecbe.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:14:54', '2025-09-30 23:14:54'),
(699, 75, 'project', 'Purva Meraki Exteriors', 'properties/75/project/2382d8dd-aa50-4bc6-8cec-9732b624cab0.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:14:54', '2025-09-30 23:14:54'),
(700, 76, 'project', 'Prestige Park Grove Front View', 'properties/76/project/dae9e5e6-942a-49f7-a4bd-2ffad45f3719.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:14:55', '2025-09-30 23:14:55'),
(701, 76, 'project', 'Prestige Park Grove Interiors', 'properties/76/project/80df80d8-1467-4503-84a5-ec6e2efefc03.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:14:56', '2025-09-30 23:14:56'),
(702, 76, 'project', 'Prestige Park Grove Interiors', 'properties/76/project/e230fc8c-ee55-4221-8ed6-902290be9647.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:14:56', '2025-09-30 23:14:56'),
(703, 76, 'project', 'Prestige Park Grove Interiors', 'properties/76/project/e04f381c-8c24-486e-b2c9-49fc30690452.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:14:57', '2025-09-30 23:14:57'),
(704, 76, 'project', 'Prestige Park Grove Interiors', 'properties/76/project/d10b8c40-f9ae-4351-805b-1960126f0fb0.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:14:58', '2025-09-30 23:14:58'),
(705, 76, 'project', 'Prestige Park Grove Interiors', 'properties/76/project/20f04d23-6041-43ae-9aaf-20e823c4d01b.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:14:59', '2025-09-30 23:14:59'),
(706, 77, 'project', 'SOBHA Manhattan Towers Exteriors', 'properties/77/project/dd6e1cac-d76c-4a59-b79f-d5047c064dc1.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:15:00', '2025-09-30 23:15:00'),
(707, 78, 'project', 'M3M Altitude Exteriors', 'properties/78/project/5eca8e2b-0964-47ce-bc0e-b8021f49cd4c.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:15:01', '2025-09-30 23:15:01'),
(708, 78, 'project', 'M3M Altitude Interiors', 'properties/78/project/aa2ed677-8909-4c39-b0e5-4e1fcbdafa79.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:15:01', '2025-09-30 23:15:01'),
(709, 78, 'project', 'M3M Altitude Interiors', 'properties/78/project/1521c9ef-ed95-495e-b7fd-dd4a02220d10.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:15:02', '2025-09-30 23:15:02'),
(710, 78, 'project', 'M3M Altitude Exteriors', 'properties/78/project/a85c8f96-1cf3-4f80-9abb-1602ca24e956.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:15:03', '2025-09-30 23:15:03'),
(711, 78, 'project', 'M3M Altitude Exteriors', 'properties/78/project/001c6d54-1c57-488f-bbe3-52b2ae4f3547.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:15:04', '2025-09-30 23:15:04'),
(712, 78, 'project', 'M3M Altitude Exteriors', 'properties/78/project/739b8f81-2c3b-4e96-9799-960d9defc90d.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:15:05', '2025-09-30 23:15:05'),
(713, 78, 'project', 'M3M Altitude Exteriors', 'properties/78/project/15d93a02-332e-4210-916d-c725f75c5a9c.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:15:06', '2025-09-30 23:15:06'),
(714, 78, 'project', 'M3M Altitude Front View', 'properties/78/project/c443a17c-1437-4d37-9236-578f5e8a8f0b.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:15:07', '2025-09-30 23:15:07'),
(715, 79, 'project', '4 BHK Vianaar Standalone Luxury Indo Portuguese Villa Exteriors', 'properties/79/project/71da2847-c6e4-49de-8aaf-e1455822d19b.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:15:08', '2025-09-30 23:15:08'),
(716, 79, 'project', '4 BHK Vianaar Standalone Luxury Indo Portuguese Villa ', 'properties/79/project/e1674971-8072-4fa6-96b3-40506043c22d.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:15:09', '2025-09-30 23:15:09'),
(717, 79, 'project', '4 BHK Vianaar Standalone Luxury Indo Portuguese Villa ', 'properties/79/project/8d7de66d-d6f4-4275-b6e9-117ad0825215.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:15:09', '2025-09-30 23:15:09'),
(718, 79, 'project', '4 BHK Vianaar Standalone Luxury Indo Portuguese Villa ', 'properties/79/project/e830fd83-f0c9-4659-b616-6d7b0eebd79b.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:15:10', '2025-09-30 23:15:10'),
(719, 79, 'project', '4 BHK Vianaar Standalone Luxury Indo Portuguese Villa ', 'properties/79/project/14b71be6-c3eb-4cfa-9289-3beb611d9ee9.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:15:12', '2025-09-30 23:15:12'),
(720, 79, 'project', '4 BHK Vianaar Standalone Luxury Indo Portuguese Villa ', 'properties/79/project/74e26379-4e8a-4d9b-963f-ac828a2286f6.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:15:12', '2025-09-30 23:15:12'),
(721, 79, 'project', '4 BHK Vianaar Standalone Luxury Indo Portuguese Villa ', 'properties/79/project/bc98d397-2565-41ff-92d5-ef0750bfcacd.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:15:13', '2025-09-30 23:15:13'),
(722, 79, 'project', '4 BHK Vianaar Standalone Luxury Indo Portuguese Villa ', 'properties/79/project/a2fcdb0e-d911-4b44-8f8a-156b6531d4b8.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:15:14', '2025-09-30 23:15:14'),
(723, 79, 'project', '4 BHK Vianaar Standalone Luxury Indo Portuguese Villa ', 'properties/79/project/b0167828-488e-4362-9aa5-c4d21fe90563.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:15:15', '2025-09-30 23:15:15'),
(724, 79, 'project', '4 BHK Vianaar Standalone Luxury Indo Portuguese Villa ', 'properties/79/project/681cbf5d-6ec9-4417-9934-7b4d0281265f.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:15:15', '2025-09-30 23:15:15'),
(725, 79, 'project', '4 BHK Vianaar Standalone Luxury Indo Portuguese Villa ', 'properties/79/project/3e65fab2-3bf2-4705-bec0-de0ac411fd0e.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:15:16', '2025-09-30 23:15:16'),
(726, 80, 'project', 'DLF Privana South Exteriors', 'properties/80/project/c60d39b2-a146-4896-bc0d-06bdb3829212.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:15:18', '2025-09-30 23:15:18'),
(727, 80, 'project', 'DLF Privana South ', 'properties/80/project/a2c2600e-dc4f-4b69-b8a9-47f8eb94fc7d.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:15:18', '2025-09-30 23:15:18'),
(728, 80, 'project', 'DLF Privana South ', 'properties/80/project/8dec97de-bdbd-445d-8be2-b16e7b4a949d.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:15:19', '2025-09-30 23:15:19'),
(729, 80, 'project', 'DLF Privana South ', 'properties/80/project/e2675844-ff74-431b-86fc-96be48149c4d.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:15:20', '2025-09-30 23:15:20'),
(730, 81, 'project', 'DLF Privana West Front View', 'properties/81/project/57156f15-57bd-4f94-8a69-ee09f770c2a5.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:15:21', '2025-09-30 23:15:21'),
(731, 82, 'project', 'DLF Villas Reis Magos Exteriors', 'properties/82/project/a888aa8d-dd0c-49d8-b645-5ca16cc9c448.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:15:22', '2025-09-30 23:15:22'),
(732, 82, 'project', 'DLF Villas Reis Magos Exteriors', 'properties/82/project/44dc09fc-ca15-4c95-a089-7a937fd35f84.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:15:23', '2025-09-30 23:15:23'),
(733, 82, 'project', 'DLF Villas Reis Magos Exteriors', 'properties/82/project/691539fd-0ec2-4d2b-b6e6-ccc8316cfa7d.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:15:23', '2025-09-30 23:15:23'),
(734, 82, 'project', 'DLF Villas Reis Magos Exteriors', 'properties/82/project/f9410cb7-c45b-4315-ad24-f7e1f576bc0b.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:15:24', '2025-09-30 23:15:24'),
(735, 82, 'project', 'DLF Villas Reis Magos Exteriors', 'properties/82/project/1d54f8a8-ba08-4492-8c5b-c926440f8664.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:15:24', '2025-09-30 23:15:24'),
(736, 82, 'project', 'DLF Villas Reis Magos Exteriors', 'properties/82/project/39197d1e-ad06-482c-8bda-124e86f8c546.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:15:25', '2025-09-30 23:15:25'),
(737, 82, 'project', 'DLF Villas Reis Magos Exteriors', 'properties/82/project/3e75d191-a55f-47bc-9747-c406b790ec46.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:15:25', '2025-09-30 23:15:25'),
(738, 82, 'project', 'DLF Villas Reis Magos Exteriors', 'properties/82/project/2fa5f10a-1c2c-4c66-8b32-fff89396674b.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:15:26', '2025-09-30 23:15:26'),
(739, 83, 'project', 'Tarc Ishva Exteriors', 'properties/83/project/8c876490-28da-4c02-9fc7-b163550de4d7.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:15:27', '2025-09-30 23:15:27'),
(740, 83, 'project', 'Tarc Ishva Exteriors', 'properties/83/project/046d2e24-dc67-4515-80c7-c9377b56c2f4.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:15:28', '2025-09-30 23:15:28'),
(741, 83, 'project', 'Tarc Ishva Exteriors', 'properties/83/project/c96a64c7-0483-4e6c-99bd-5bbe8880c17b.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:15:28', '2025-09-30 23:15:28'),
(742, 83, 'project', 'Tarc Ishva Exteriors', 'properties/83/project/991c870a-a56b-4afe-8975-d75c162dabca.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:15:29', '2025-09-30 23:15:29'),
(743, 83, 'project', 'Tarc Ishva Interiors', 'properties/83/project/14ec0da3-935b-44b0-93ce-3c5e95e712d1.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:15:30', '2025-09-30 23:15:30'),
(744, 83, 'project', 'Tarc Ishva Exteriors', 'properties/83/project/861698eb-8d59-4129-b6b3-27b20e0f3ba7.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:15:31', '2025-09-30 23:15:31'),
(745, 84, 'project', 'Silverglades - The Legacy Exteriors', 'properties/84/project/b8752d3e-64da-482f-aceb-4f294f00cc19.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:15:32', '2025-09-30 23:15:32'),
(746, 84, 'project', 'Silverglades - The Legacy Exteriors', 'properties/84/project/25c91f1e-b129-43b4-a7bf-ac20dd2055bc.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:15:33', '2025-09-30 23:15:33'),
(747, 84, 'project', 'Silverglades - The Legacy Exteriors', 'properties/84/project/4ee7c1c7-651d-4f88-b546-3df2034d7203.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:15:33', '2025-09-30 23:15:33'),
(748, 84, 'project', 'Silverglades - The Legacy Exteriors', 'properties/84/project/5585da60-044a-4f56-8a31-ed2c2d26232b.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:15:34', '2025-09-30 23:15:34'),
(749, 84, 'project', 'Silverglades - The Legacy Exteriors', 'properties/84/project/fb98c651-a96f-4532-b788-af7b7e879381.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:15:35', '2025-09-30 23:15:35'),
(750, 84, 'project', 'Silverglades - The Legacy Exteriors', 'properties/84/project/9be9756a-1371-44a0-8264-75f32538a34b.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:15:36', '2025-09-30 23:15:36'),
(751, 84, 'project', 'Silverglades - The Legacy Exteriors', 'properties/84/project/783d40fe-89c4-40cf-bd1d-a0057c572dd8.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:15:36', '2025-09-30 23:15:36'),
(752, 84, 'project', 'Silverglades - The Legacy Kitchen', 'properties/84/project/eaa2c1ac-d8db-4187-80f4-1d4ba1ab255b.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:15:37', '2025-09-30 23:15:37'),
(753, 84, 'project', 'Silverglades - The Legacy Bedroom', 'properties/84/project/5584fe2e-577d-4ea8-9b19-11e4ecabeac0.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:15:38', '2025-09-30 23:15:38'),
(754, 84, 'project', 'Silverglades - The Legacy Interiors', 'properties/84/project/f8cb3515-f49d-4a3b-bafe-754e413bd46f.jpg', '', 0, 0, 0, 10, 1, '2025-09-30 23:15:38', '2025-09-30 23:15:38'),
(755, 84, 'project', 'Silverglades - The Legacy Interiors', 'properties/84/project/c46ca6a0-fccf-4287-8f61-914998d9c380.jpg', '', 0, 0, 0, 11, 1, '2025-09-30 23:15:39', '2025-09-30 23:15:39'),
(756, 84, 'project', 'Silverglades - The Legacy Interiors', 'properties/84/project/4f03f998-7a95-4319-83b0-92a169e7a74e.jpg', '', 0, 0, 0, 12, 1, '2025-09-30 23:15:40', '2025-09-30 23:15:40'),
(757, 85, 'project', '3 BHK Field View Villa in Morjim Exteriors', 'properties/85/project/8ab55efe-1f92-44cf-9518-27b430dd86c3.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:15:41', '2025-09-30 23:15:41'),
(758, 85, 'project', '3 BHK Field View Villa in Morjim Exteriors', 'properties/85/project/f84907d9-2d22-410b-8809-4c73b6328fda.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:15:41', '2025-09-30 23:15:41'),
(759, 85, 'project', '3 BHK Field View Villa in Morjim Exteriors', 'properties/85/project/5609caf5-3abe-4e47-aa1f-b6d727c10a33.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:15:42', '2025-09-30 23:15:42'),
(760, 86, 'project', '4 BHK Fully Furnished Villa in Mandrem Exteriors', 'properties/86/project/c0c4a7a7-3030-4f4f-acd8-0e89fb830c7b.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:15:43', '2025-09-30 23:15:43'),
(761, 86, 'project', '4 BHK Fully Furnished Villa in Mandrem Bedroom', 'properties/86/project/8715d64b-5534-41e2-bc1b-887c205cc477.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:15:43', '2025-09-30 23:15:43'),
(762, 86, 'project', '4 BHK Fully Furnished Villa in Mandrem Bedroom', 'properties/86/project/7ceb106b-f98f-4179-9c94-ccb7e2c4fa03.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:15:44', '2025-09-30 23:15:44'),
(763, 86, 'project', '4 BHK Fully Furnished Villa in Mandrem Bedroom', 'properties/86/project/f91717a3-d513-48a2-83b4-5eb27b2f9497.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:15:44', '2025-09-30 23:15:44'),
(764, 86, 'project', '4 BHK Fully Furnished Villa in Mandrem Bedroom', 'properties/86/project/a4578684-f08f-479a-8cfe-083d701114c2.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:15:45', '2025-09-30 23:15:45'),
(765, 86, 'project', '4 BHK Fully Furnished Villa in Mandrem Bedroom', 'properties/86/project/fbd574f4-6d5f-4864-91d0-50951aa7e14c.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:15:46', '2025-09-30 23:15:46'),
(766, 86, 'project', '4 BHK Fully Furnished Villa in Mandrem Kitchen', 'properties/86/project/64fcbfda-3318-4733-bd11-ea7c60e81f85.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:15:46', '2025-09-30 23:15:46'),
(767, 86, 'project', '4 BHK Fully Furnished Villa in Mandrem Bathroom', 'properties/86/project/6b5fed28-2ca6-40c8-a675-6643e0f1c2f5.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:15:47', '2025-09-30 23:15:47'),
(768, 87, 'project', 'DLF The Dahlias Exteriors', 'properties/87/project/cc31718c-d54e-4e74-b003-9077daac9f92.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:15:48', '2025-09-30 23:15:48'),
(769, 87, 'project', 'DLF The Dahlias Bedroom', 'properties/87/project/71422f1d-2a75-4bcc-a90b-d86ca58514a0.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:15:49', '2025-09-30 23:15:49'),
(770, 87, 'project', 'DLF The Dahlias Bedroom', 'properties/87/project/9d5ba98e-8877-4f4d-80cf-91310ae2a210.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:15:50', '2025-09-30 23:15:50'),
(771, 87, 'project', 'DLF The Dahlias Bathroom', 'properties/87/project/5a446c6a-e92e-4807-a389-c35b1d60975f.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:15:50', '2025-09-30 23:15:50'),
(772, 87, 'project', 'DLF The Dahlias Interiors', 'properties/87/project/5114e95a-95d7-413a-89d8-c989721f1ba1.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:15:51', '2025-09-30 23:15:51'),
(773, 87, 'project', 'DLF The Dahlias Interiors', 'properties/87/project/d3680670-5d67-4e83-bf5e-3a640c4671aa.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:15:51', '2025-09-30 23:15:51'),
(774, 87, 'project', 'DLF The Dahlias Interiors', 'properties/87/project/0233842f-0e71-4a86-891f-dca4386b1c2e.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:15:52', '2025-09-30 23:15:52'),
(775, 87, 'project', 'DLF The Dahlias Lobby', 'properties/87/project/0e53d981-6db6-4b85-9300-fb41b468bf1d.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:15:53', '2025-09-30 23:15:53'),
(776, 88, 'project', 'Trump Towers 2 Front View', 'properties/88/project/8238fbb6-e1ff-46bc-945d-71028f0348d9.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:15:54', '2025-09-30 23:15:54'),
(777, 88, 'project', 'Trump Towers 2 Interiors', 'properties/88/project/e2a85481-de54-4c76-bd7f-e78abb8a04e7.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:15:54', '2025-09-30 23:15:54'),
(778, 88, 'project', 'Trump Towers 2 Interiors', 'properties/88/project/d423cc1c-dcf8-475d-831a-938278e874e6.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:15:55', '2025-09-30 23:15:55'),
(779, 88, 'project', 'Trump Towers 2 Interiors', 'properties/88/project/efd91c8d-32ea-42d2-b35a-cbf3856eff9e.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:15:56', '2025-09-30 23:15:56'),
(780, 88, 'project', 'Trump Towers 2 Interiors', 'properties/88/project/d685c7aa-de21-44c7-8d74-c151cca9cca5.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:15:56', '2025-09-30 23:15:56'),
(781, 88, 'project', 'Trump Towers 2 Interiors', 'properties/88/project/2be5a70d-5c9f-473e-993e-29c467b9824e.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:15:57', '2025-09-30 23:15:57'),
(782, 88, 'project', 'Trump Towers 2 Interiors', 'properties/88/project/e03c6336-278d-4a58-8bf8-1d53ac527faa.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:15:58', '2025-09-30 23:15:58'),
(783, 88, 'project', 'Trump Towers 2 Interiors', 'properties/88/project/9d98fcaa-eb5f-4ba0-a329-8be70e615695.jpg', '', 0, 0, 0, 8, 1, '2025-09-30 23:15:59', '2025-09-30 23:15:59'),
(784, 88, 'project', 'Trump Towers 2 Exteriors', 'properties/88/project/27c9bfd9-e0dc-44b9-abcd-661c4bf61980.jpg', '', 0, 0, 0, 9, 1, '2025-09-30 23:15:59', '2025-09-30 23:15:59'),
(785, 89, 'project', 'Lodha Hosa Road Exteriors', 'properties/89/project/1eb92c47-5d97-402b-b9e1-c91d6d48c915.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:16:00', '2025-09-30 23:16:00'),
(786, 89, 'project', 'Lodha Hosa Road Exteriors', 'properties/89/project/9eecf71a-674d-49eb-bf16-2e26f3bb6ac4.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:16:01', '2025-09-30 23:16:01'),
(787, 89, 'project', 'Lodha Hosa Road Exteriors', 'properties/89/project/3a57e697-e88f-4a15-850f-aa283fd2f992.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:16:02', '2025-09-30 23:16:02'),
(788, 89, 'project', 'Lodha Hosa Road Exteriors', 'properties/89/project/822b0695-6453-404f-a8e5-bb0a876cae64.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:16:02', '2025-09-30 23:16:02'),
(789, 90, 'project', 'Adani Samsara Ivana Exteriors', 'properties/90/project/de1419e1-6bfc-4b2a-83ab-5b003d406de3.jpg', '', 0, 0, 0, 1, 1, '2025-09-30 23:16:04', '2025-09-30 23:16:04'),
(790, 90, 'project', 'Adani Samsara Ivana Landscape Garden', 'properties/90/project/26ea2d89-d50d-4508-aa06-3e18e1fc7703.jpg', '', 0, 0, 0, 2, 1, '2025-09-30 23:16:04', '2025-09-30 23:16:04'),
(791, 90, 'project', 'Adani Samsara Ivana Landscape Garden', 'properties/90/project/ec4e4ead-897a-4d15-9714-cf9d30efcdd8.jpg', '', 0, 0, 0, 3, 1, '2025-09-30 23:16:05', '2025-09-30 23:16:05'),
(792, 90, 'project', 'Adani Samsara Ivana Front View', 'properties/90/project/81747ed4-cf0b-4480-baf3-ce5db1bd4623.jpg', '', 0, 0, 0, 4, 1, '2025-09-30 23:16:05', '2025-09-30 23:16:05'),
(793, 90, 'project', 'Adani Samsara Ivana Front View', 'properties/90/project/29472521-8440-42e5-83bd-bf015a2662b3.jpg', '', 0, 0, 0, 5, 1, '2025-09-30 23:16:06', '2025-09-30 23:16:06'),
(794, 90, 'project', 'Adani Samsara Ivana Swimming Pool', 'properties/90/project/d38d18ac-1d1a-4c6e-b831-198bbf82b8b4.jpg', '', 0, 0, 0, 6, 1, '2025-09-30 23:16:07', '2025-09-30 23:16:07'),
(795, 90, 'project', 'Adani Samsara Ivana Lobby', 'properties/90/project/555642d8-1c14-4389-b672-e68ef3f61633.jpg', '', 0, 0, 0, 7, 1, '2025-09-30 23:16:08', '2025-09-30 23:16:08'),
(796, 9, 'floor_plan', NULL, 'properties/9/floor_plan/1629bea9-561d-4ef5-b8be-3f27d66b6ee2.png', NULL, 0, 0, 0, 1, 1, '2025-10-04 10:38:17', '2025-10-04 10:38:17'),
(797, 9, 'floor_plan', NULL, 'properties/9/floor_plan/fb5f0fc3-14c5-4f9e-9087-4fc1fdf79f31.png', NULL, 0, 0, 0, 2, 1, '2025-10-04 10:38:21', '2025-10-04 10:38:21'),
(798, 9, 'floor_plan', NULL, 'properties/9/floor_plan/d21bd187-cccb-4e6f-90d5-068969bf7d01.png', NULL, 0, 0, 0, 3, 1, '2025-10-04 10:38:28', '2025-10-04 10:38:28'),
(799, 9, 'floor_plan', 'exterior', 'properties/9/floor_plan/46579d1c-5c69-41b4-9e3c-3659a5b1b33a.png', NULL, 0, 0, 0, 4, 1, '2025-10-04 10:38:31', '2025-10-04 10:38:31'),
(800, 9, 'floor_plan', 'exterior', 'properties/9/floor_plan/69911102-e97d-4e80-a24c-5e9743731357.png', 'test', 0, 0, 0, 5, 1, '2025-10-04 10:38:33', '2025-10-04 10:38:33'),
(801, 9, 'logo', 'exterior', 'properties/9/logo/48759cdb-6298-4778-aefa-e8e154c7575e.png', 'test', 0, 0, 0, 1, 1, '2025-10-04 10:38:49', '2025-10-04 10:38:49'),
(802, 9, 'floor_plan', NULL, 'properties/9/floor_plan/c52f206b-89b9-4ea7-8346-766eec0ef7d1.png', NULL, 0, 0, 0, 6, 1, '2025-10-04 10:40:33', '2025-10-04 10:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint UNSIGNED NOT NULL,
  `property_category_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `property_category_id`, `name`, `slug`, `heading`, `description`, `meta_title`, `meta_description`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Apartments', 'apartments', 'Luxury Apartments in Gurgaon for Sale', NULL, 'Luxury Apartments in Gurgaon for Sale - PropNKey', 'Search and buy the best Luxury Apartments in Gurgaon at affordable rates. 4 & 5 BHK apartments with modern amenities and ready to live the life of luxury you deserve.', 90, 1, '2025-09-30 13:38:57', '2025-10-04 12:09:39'),
(2, 1, 'Penthouses', 'penthouse', 'Luxury Penthouse for Sale', NULL, 'Luxury Penthouses for Sale in India - PropNKey', 'Luxury Penthouses for Sale - Your destination for buying 3, 4, 5 BHK ultra luxury penthouses in India with modern amenities at best prices. Check payment plan and more.', 90, 1, '2025-09-30 13:38:57', '2025-10-02 20:53:48'),
(3, 1, 'Villa', 'villa', 'Luxury Villas for Sale', NULL, 'Luxury Villas For Sale | Villa For Sale', 'Luxury Villas for Sale - Buy luxury villa in Delhi NCR at affordable prices. Call now for Free Site Visit.', 90, 1, '2025-09-30 13:38:57', '2025-10-02 20:54:01'),
(4, 3, 'Holiday Homes', 'holiday-homes', NULL, NULL, 'Hello', NULL, 90, 0, '2025-09-30 13:38:57', '2025-10-02 20:53:35'),
(5, 2, 'Retail Shops', 'retail-shops', 'Commercial Retail Shops For Sale', NULL, 'Commercial Retail Shops For Sale - Shop for Sale in Gurgaon', 'Commercial Shops For Sale - Buy your own Retail Shop in Delhi NCR at affordable prices. Front road facing, Parking, Lowest maintenance cost etc. Call now.', 90, 1, '2025-09-30 13:38:57', '2025-10-02 20:53:52'),
(6, 1, 'Studio Apartments', 'studio-apartments', 'Studio Apartments For Sale', NULL, 'Studio Apartments For Sale | Studio Apartments For Sale Near me', 'Studio Apartments For Sale in Gurgaon - Buy your own Studio Apartments in Delhi NCR at affordable prices. Parking, Lowest maintenance cost etc. Call now.', 90, 1, '2025-09-30 13:38:57', '2025-10-02 20:53:57'),
(7, 1, 'Cottage', 'cottage', 'Independent Cottage for Sale', NULL, 'Cottage for Sale in India | Cottages for Sale in Hill Stations', 'Find beautiful Cottage Houses for sale in Goa, Himachal Pradesh. You can buy cottages and independent houses in Shimla, Goa, Himachal Pradesh. Price starting at 1.5 cr.', 90, 1, '2025-09-30 13:38:57', '2025-10-02 20:53:31'),
(8, 1, 'House', 'house', NULL, NULL, NULL, NULL, 90, 0, '2025-09-30 13:38:57', '2025-10-02 20:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_configs`
--

CREATE TABLE `site_configs` (
  `id` bigint UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `content` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_configs`
--

INSERT INTO `site_configs` (`id`, `label`, `type`, `content`, `description`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'text', 'Propnkey', 'The name of the website', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(2, 'site_description', 'textarea', 'A powerful property management platform that helps you manage your real estate portfolio efficiently.', 'Brief description of the website', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(3, 'site_keywords', 'text', 'property, management, real estate, platform', 'SEO keywords for the website', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(4, 'site_logo', 'text', '/frontassets/images/logo.svg', 'Site Logo Path', '2025-09-18 23:33:36', '2025-10-02 01:32:28'),
(5, 'site_favicon', 'text', '/frontassets/img/favicon.png', 'Site Favicon Path', '2025-09-18 23:33:36', '2025-10-02 01:32:28'),
(6, 'contact_email', 'text', 'info@propnkey.com', 'Main contact email address', '2025-09-18 23:33:36', '2025-10-02 20:29:32'),
(7, 'contact_phone', 'text', '9717672008', 'Main contact phone number', '2025-09-18 23:33:36', '2025-10-02 20:30:02'),
(8, 'contact_address', 'textarea', '123 Property Street\\nCity, State 12345\\nUnited States', 'Physical address of the company', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(9, 'facebook_url', 'text', '#', 'Facebook page URL', '2025-09-18 23:33:36', '2025-10-02 01:13:49'),
(10, 'twitter_url', 'text', 'https://twitter.com/propnkey', 'Twitter profile URL', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(11, 'linkedin_url', 'text', '#', 'LinkedIn company page URL', '2025-09-18 23:33:36', '2025-10-02 01:13:49'),
(12, 'instagram_url', 'text', '#', 'Instagram profile URL', '2025-09-18 23:33:36', '2025-10-02 01:13:49'),
(13, 'maintenance_message', 'textarea', 'We are currently performing scheduled maintenance. Please check back later.', 'Message to display during maintenance mode', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(14, 'welcome_message', 'textarea', 'Welcome to Propnkey! Your property management solution.', 'Welcome message for new users', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(15, 'terms_of_service', 'file', '', 'Terms of service document', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(16, 'privacy_policy', 'file', '', 'Privacy policy document', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(17, 'smtp_host', 'text', 'smtp.gmail.com', 'SMTP server hostname', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(18, 'smtp_port', 'text', '587', 'SMTP server port', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(19, 'smtp_username', 'text', 'noreply@propnkey.com', 'SMTP username', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(20, 'smtp_encryption', 'text', 'tls', 'SMTP encryption type', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(21, 'currency', 'text', 'USD', 'Default currency code', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(22, 'timezone', 'text', 'America/New_York', 'Default timezone', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(23, 'date_format', 'text', 'Y-m-d', 'Default date format', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(24, 'time_format', 'text', 'H:i:s', 'Default time format', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(25, 'analytics_code', 'textarea', '<!-- Google Analytics Code -->\\n<!-- Add your analytics code here -->', 'Google Analytics tracking code', '2025-09-18 23:33:36', '2025-09-23 04:32:57'),
(26, 'custom_css', 'textarea', '/* Custom CSS styles */\\n/* Add your custom styles here */', 'Custom CSS styles for the site', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(27, 'custom_js', 'textarea', '// Custom JavaScript\\n// Add your custom scripts here', 'Custom JavaScript code for the site', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(28, 'user_manual', 'file', '', 'User manual document', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(29, 'api_documentation', 'file', '', 'API documentation file', '2025-09-18 23:33:36', '2025-09-18 23:33:36'),
(31, 'header_tagline', 'textarea', 'Elegant Luxury<br>properties in the heart <br><span class=\"of-dubai\">of Dubai</span>', 'Header tagline text', '2025-10-02 01:13:49', '2025-10-02 01:13:49'),
(32, 'company_name', 'text', 'Luxury Residences Real Estate LLC', 'Company name', '2025-10-02 01:13:49', '2025-10-02 01:13:49'),
(34, 'office_address', 'textarea', 'Office 410, The Onyx Tower 2<br>The Greens, Dubai, UAE,<br>P.O. Box 451733', 'Office address', '2025-10-02 01:13:49', '2025-10-02 01:13:49'),
(35, 'copyright_text', 'text', 'Copyright © All rights reserved. 2025', 'Copyright text', '2025-10-02 01:13:49', '2025-10-02 01:13:49'),
(36, 'youtube_url', 'text', '#', 'YouTube channel URL', '2025-10-02 01:13:49', '2025-10-02 01:13:49'),
(37, 'tiktok_url', 'text', '#', 'TikTok profile URL', '2025-10-02 01:13:49', '2025-10-02 01:13:49'),
(38, 'privacy_policy_url', 'text', '#', 'Privacy policy page URL', '2025-10-02 01:13:49', '2025-10-02 01:13:49'),
(39, 'rera_number', 'text', 'HRERA No- GGM/2037/1632/2023/50', 'RERA Registration Number', '2025-10-02 01:25:12', '2025-10-02 01:25:12'),
(40, 'hero_video_url', 'text', 'https://cdn.prod.website-files.com/66a8e4e8bd6f32dc4680818f%2F66c6fc7bf2332cb0f1fe48cd_LR%20video%20coming-transcode.mp4', 'Hero Video URL', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(41, 'hero_title_line1', 'text', 'The home of sophisticated', 'Hero Title Line 1', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(42, 'hero_title_line2', 'text', 'and luxurious', 'Hero Title Line 2', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(43, 'hero_subtitle', 'text', 'living', 'Hero Subtitle', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(44, 'hero_description', 'text', 'A boutique prime real estate agency specialising in penthouse and mansion villa communities, with a penchant for branded residences.', 'Hero Description', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(45, 'search_placeholder', 'text', '3 BHK Apartments, Gurgaon', 'Search Placeholder Text', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(46, 'search_icon_url', 'text', 'https://cdn.prod.website-files.com/66a8e4e8bd6f32dc4680818f/66cc2cef03ccf308a49ba730_search.svg', 'Search Icon URL', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(47, 'private_residences_title', 'text', 'Private Residences', 'Private Residences Section Title', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(48, 'new_developments_title', 'text', 'New Developments', 'New Developments Section Title', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(49, 'new_developments_description', 'text', 'A curated selection of the finest new developments that perfectly embody world class design, lifestyle and quality.', 'New Developments Description', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(50, 'locations_title', 'text', 'Locations', 'Locations Section Title', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(51, 'our_services_title', 'text', 'Our services', 'Our Services Section Title', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(52, 'our_services_description', 'text', 'Luxury Residences provide a singular destination for your real estate, financial, lifestyle, legal and immigration requirements. Our suite of specialist services will ensure all of your needs are dealt with effectively and discreetly to your utmost satisfaction.', 'Our Services Description', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(53, 'developers_title', 'text', 'Developers', 'Developers Section Title', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(54, 'testimonials_title', 'text', 'Testimonials', 'Testimonials Section Title', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(55, 'about_title', 'text', 'About', 'About Section Title', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(56, 'about_company_name', 'text', 'PROP&KEY', 'About Company Name', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(57, 'about_image_1', 'text', '/frontassets/images/aabyshsj.png', 'About Image 1', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(58, 'about_image_2', 'text', '/frontassets/images/66d07f4b36221a2de3acc724_Rectangle_25_1.png', 'About Image 2', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(59, 'about_description', 'text', 'An international collective of best-in-class real estate aficionados who have come together to pioneer a shared vision of innovative excellence. Headquartered in Dubai, the most exciting luxury real estate market on the planet, it is our philosophy to offer world class service, advice and access to the finest homes. Hosting an award winning and highly experienced team drawn from leading international brands we offer a refreshing, dynamic and highly effective approach to the global citizen with regards to their real estate and related lifestyle and investment requirements.', 'About Description', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(60, 'about_button_url', 'text', '/services', 'About Button URL', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(61, 'about_button_text', 'text', 'View More', 'About Button Text', '2025-10-02 01:28:35', '2025-10-02 01:28:35'),
(62, 'homepage_title', 'text', 'Propnkey - Luxury Real Estate', 'Homepage Title', '2025-10-02 01:32:28', '2025-10-02 01:32:28'),
(63, 'homepage_description', 'text', 'A boutique prime real estate agency specialising in penthouse and mansion villa communities, with a penchant for branded residences.', 'Homepage Meta Description', '2025-10-02 01:32:28', '2025-10-02 01:32:28'),
(64, 'homepage_keywords', 'text', 'luxury real estate, penthouse, mansion, villa, branded residences, property, real estate agency', 'Homepage Meta Keywords', '2025-10-02 01:32:28', '2025-10-02 01:32:28'),
(65, 'homepage_og_title', 'text', 'Propnkey - Luxury Real Estate', 'Homepage Open Graph Title', '2025-10-02 01:32:28', '2025-10-02 01:32:28'),
(66, 'homepage_og_description', 'text', 'A boutique prime real estate agency specialising in penthouse and mansion villa communities, with a penchant for branded residences.', 'Homepage Open Graph Description', '2025-10-02 01:32:28', '2025-10-02 01:32:28'),
(67, 'homepage_og_image', 'text', '/frontassets/images/logo.svg', 'Homepage Open Graph Image', '2025-10-02 01:32:28', '2025-10-02 01:32:28'),
(68, 'homepage_twitter_title', 'text', 'Propnkey - Luxury Real Estate', 'Homepage Twitter Title', '2025-10-02 01:32:28', '2025-10-02 01:32:28'),
(69, 'homepage_twitter_description', 'text', 'A boutique prime real estate agency specialising in penthouse and mansion villa communities, with a penchant for branded residences.', 'Homepage Twitter Description', '2025-10-02 01:32:28', '2025-10-02 01:32:28'),
(70, 'homepage_twitter_image', 'text', '/frontassets/images/logo.svg', 'Homepage Twitter Image', '2025-10-02 01:32:28', '2025-10-02 01:32:28'),
(71, 'similar_properties_budget_range', 'text', '50', 'Budget range percentage for similar properties (e.g., 20 means 20% less to 20% more)', '2025-10-04 11:14:39', '2025-10-04 11:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `slug_list`
--

CREATE TABLE `slug_list` (
  `id` bigint UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slug_list`
--

INSERT INTO `slug_list` (`id`, `url`, `meta_title`, `meta_description`, `heading`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'about-us', 'About Us - Property Management Company', 'Learn about our property management company, our mission, and how we help property owners maximize their investments.', 'About Our Company', '<h2>Welcome to Our Property Management Company</h2><p>We are a leading property management company dedicated to providing exceptional service to our clients. With over 10 years of experience in the industry, we have built a reputation for excellence and reliability.</p><h3>Our Mission</h3><p>To provide comprehensive property management solutions that maximize value for property owners while ensuring tenant satisfaction.</p><h3>Our Vision</h3><p>To be the most trusted and innovative property management company in the region.</p><h3>Why Choose Us?</h3><ul><li>Experienced and professional team</li><li>24/7 customer support</li><li>Advanced technology solutions</li><li>Competitive pricing</li><li>Proven track record</li></ul>', 1, '2025-09-22 06:31:28', '2025-09-22 06:31:28'),
(2, 'services', 'Property Management Services - Complete Solutions', 'Discover our comprehensive property management services including tenant screening, maintenance, rent collection, and more.', 'Our Services', '<h2>Comprehensive Property Management Services</h2><p>We offer a full range of property management services designed to meet your specific needs and maximize your property\'s potential.</p><h3>Property Management</h3><p>Complete property management services including tenant screening, rent collection, maintenance coordination, and financial reporting.</p><h3>Property Maintenance</h3><p>Regular maintenance and repair services to keep your properties in excellent condition and maximize their value.</p><h3>Tenant Services</h3><p>Professional tenant services including application processing, lease management, and customer support.</p><h3>Financial Management</h3><p>Comprehensive financial management including rent collection, expense tracking, and detailed reporting.</p>', 1, '2025-09-22 06:31:28', '2025-09-22 06:31:28'),
(3, 'contact', 'Contact Us - Get in Touch Today', 'Contact our property management team today. We\'re here to help with all your property management needs.', 'Contact Our Team', '<h2>Get in Touch</h2><p>We would love to hear from you. Contact us today to learn more about our services or to discuss your property management needs.</p><h3>Office Information</h3><p><strong>Address:</strong> 123 Property Street, City, State 12345</p><p><strong>Phone:</strong> (555) 123-4567</p><p><strong>Email:</strong> info@propnkey.com</p><h3>Business Hours</h3><p>Monday - Friday: 9:00 AM - 6:00 PM</p><p>Saturday: 10:00 AM - 4:00 PM</p><p>Sunday: Closed</p><h3>Emergency Contact</h3><p>For urgent matters outside business hours, please call our emergency line at (555) 123-4568.</p>', 1, '2025-09-22 06:31:28', '2025-09-22 06:31:28'),
(4, 'privacy-policy', 'Privacy Policy - Data Protection', 'Read our privacy policy to understand how we collect, use, and protect your personal information.', 'Privacy Policy', '<h2>Privacy Policy</h2><p>This privacy policy explains how we collect, use, and protect your personal information.</p><h3>Information We Collect</h3><p>We collect information you provide directly to us, such as when you create an account, contact us, or use our services.</p><h3>How We Use Your Information</h3><p>We use the information we collect to provide, maintain, and improve our services, communicate with you, and ensure the security of our platform.</p><h3>Information Sharing</h3><p>We do not sell, trade, or otherwise transfer your personal information to third parties without your consent, except as described in this policy.</p><h3>Data Security</h3><p>We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.</p>', 1, '2025-09-22 06:31:28', '2025-09-22 06:31:28'),
(5, 'terms-of-service', 'Terms of Service - Legal Agreement', 'Read our terms of service that govern your use of our website and property management services.', 'Terms of Service', '<h2>Terms of Service</h2><p>These terms of service govern your use of our website and services.</p><h3>Acceptance of Terms</h3><p>By accessing or using our services, you agree to be bound by these terms and conditions.</p><h3>Use of Services</h3><p>You may use our services only for lawful purposes and in accordance with these terms.</p><h3>User Accounts</h3><p>You are responsible for maintaining the confidentiality of your account and password and for all activities that occur under your account.</p><h3>Limitation of Liability</h3><p>To the maximum extent permitted by law, we shall not be liable for any indirect, incidental, special, consequential, or punitive damages.</p>', 0, '2025-09-22 06:31:28', '2025-09-22 06:31:28');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `designation`, `comment`, `image`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Sarah Johnson', 'CEO, Tech Solutions Inc.', 'The service provided was exceptional. Our team productivity increased by 40% after implementing their solution. Highly recommended!', NULL, 1, 1, '2025-09-22 21:54:32', '2025-09-22 21:54:32'),
(2, 'Michael Chen', 'Marketing Director, Global Corp', 'Outstanding support and incredible results. The team went above and beyond to meet our requirements. Truly professional!', NULL, 2, 1, '2025-09-22 21:54:32', '2025-09-22 21:54:32'),
(3, 'Emily Rodriguez', 'Project Manager, Innovate Labs', 'Working with this team has been a game-changer for our business. Their expertise and dedication are unmatched.', NULL, 3, 1, '2025-09-22 21:54:32', '2025-09-22 21:54:32'),
(4, 'David Thompson', 'Founder, StartupXYZ', 'The quality of work and attention to detail exceeded our expectations. We couldn\'t be happier with the results.', NULL, 4, 1, '2025-09-22 21:54:32', '2025-09-22 21:54:32'),
(5, 'Lisa Wang', 'Operations Manager, Enterprise Co.', 'Professional, reliable, and innovative. They delivered exactly what we needed on time and within budget.', NULL, 5, 1, '2025-09-22 21:54:32', '2025-09-22 21:54:32'),
(6, 'James Wilson', 'CTO, Digital Innovations', 'The technical expertise and problem-solving approach were impressive. They turned our vision into reality perfectly.', NULL, 6, 1, '2025-09-22 21:54:32', '2025-09-22 21:54:32'),
(7, 'Maria Garcia', 'Head of Sales, Growth Co.', 'Exceptional service and incredible results. Our sales team saw immediate improvements after their implementation.', NULL, 7, 1, '2025-09-22 21:54:32', '2025-09-22 21:54:32'),
(8, 'Robert Brown', 'Managing Director, Success Ltd.', 'Outstanding work ethic and commitment to excellence. They are now our go-to partner for all major projects.', NULL, 8, 1, '2025-09-22 21:54:32', '2025-09-22 21:54:32'),
(9, 'Jennifer Lee', 'VP of Operations, Mega Corp', 'The team\'s professionalism and technical skills are top-notch. We achieved our goals faster than expected.', NULL, 9, 1, '2025-09-22 21:54:32', '2025-09-22 21:54:32'),
(10, 'Christopher Davis', 'Business Owner, Local Services', 'Amazing results and excellent customer service. They helped us streamline our operations significantly.', NULL, 10, 1, '2025-09-22 21:54:32', '2025-09-22 21:54:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@propnkey.com', '2025-09-18 13:47:41', '$2y$12$UP/i3SNCro4HKcEWn2WPpOKyhjjliEhcg2lpAXutc2t8o3Jxfumz6', NULL, '2025-09-18 13:47:41', '2025-09-18 13:47:41'),
(2, 'John Doe', 'john@example.com', '2025-09-18 13:47:41', '$2y$12$jT200OXRYF7uZc7ZvpddCupgENFPSJqOowJOKHZENw4YdcZ8H8V4K', NULL, '2025-09-18 13:47:41', '2025-09-18 13:47:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bedroom_options`
--
ALTER TABLE `bedroom_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_categories_slug_unique` (`slug`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blog_posts_slug_unique` (`slug`),
  ADD KEY `blog_posts_blog_category_id_foreign` (`blog_category_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `footer_items`
--
ALTER TABLE `footer_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `footer_items_slug_unique` (`slug`);

--
-- Indexes for table `image_redirections`
--
ALTER TABLE `image_redirections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `image_redirections_old_path_unique` (`old_path`),
  ADD KEY `image_redirections_old_path_index` (`old_path`),
  ADD KEY `image_redirections_property_id_index` (`property_id`),
  ADD KEY `image_redirections_is_active_index` (`is_active`),
  ADD KEY `image_redirections_property_image_id_foreign` (`property_image_id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locations_slug_unique` (`slug`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_parent_id_sort_order_index` (`parent_id`,`sort_order`),
  ADD KEY `menus_is_active_index` (`is_active`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `partners_slug_unique` (`slug`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `properties_slug_unique` (`slug`),
  ADD KEY `properties_partner_id_foreign` (`partner_id`),
  ADD KEY `properties_agent_id_foreign` (`agent_id`),
  ADD KEY `properties_location_id_foreign` (`location_id`),
  ADD KEY `properties_property_type_id_foreign` (`property_type_id`),
  ADD KEY `properties_property_category_id_foreign` (`property_category_id`),
  ADD KEY `properties_property_condition_id_foreign` (`property_condition_id`),
  ADD KEY `properties_bedroom_option_id_foreign` (`bedroom_option_id`);

--
-- Indexes for table `property_amenities`
--
ALTER TABLE `property_amenities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `property_amenities_property_id_amenity_id_unique` (`property_id`,`amenity_id`),
  ADD KEY `property_amenities_amenity_id_foreign` (`amenity_id`);

--
-- Indexes for table `property_categories`
--
ALTER TABLE `property_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `property_categories_slug_unique` (`slug`);

--
-- Indexes for table `property_conditions`
--
ALTER TABLE `property_conditions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `property_conditions_slug_unique` (`slug`);

--
-- Indexes for table `property_faqs`
--
ALTER TABLE `property_faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_faqs_property_id_foreign` (`property_id`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_images_property_id_type_index` (`property_id`,`type`),
  ADD KEY `property_images_property_id_sort_order_index` (`property_id`,`sort_order`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `property_types_slug_unique` (`slug`),
  ADD KEY `property_types_property_category_id_foreign` (`property_category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_configs`
--
ALTER TABLE `site_configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_configs_label_unique` (`label`);

--
-- Indexes for table `slug_list`
--
ALTER TABLE `slug_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug_list_url_unique` (`url`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `bedroom_options`
--
ALTER TABLE `bedroom_options`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `footer_items`
--
ALTER TABLE `footer_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `image_redirections`
--
ALTER TABLE `image_redirections`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=523;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `property_amenities`
--
ALTER TABLE `property_amenities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1431;

--
-- AUTO_INCREMENT for table `property_categories`
--
ALTER TABLE `property_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `property_conditions`
--
ALTER TABLE `property_conditions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `property_faqs`
--
ALTER TABLE `property_faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=803;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `site_configs`
--
ALTER TABLE `site_configs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `slug_list`
--
ALTER TABLE `slug_list`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `image_redirections`
--
ALTER TABLE `image_redirections`
  ADD CONSTRAINT `image_redirections_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `image_redirections_property_image_id_foreign` FOREIGN KEY (`property_image_id`) REFERENCES `property_images` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `properties_bedroom_option_id_foreign` FOREIGN KEY (`bedroom_option_id`) REFERENCES `bedroom_options` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `properties_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `properties_partner_id_foreign` FOREIGN KEY (`partner_id`) REFERENCES `partners` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `properties_property_category_id_foreign` FOREIGN KEY (`property_category_id`) REFERENCES `property_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `properties_property_condition_id_foreign` FOREIGN KEY (`property_condition_id`) REFERENCES `property_conditions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `properties_property_type_id_foreign` FOREIGN KEY (`property_type_id`) REFERENCES `property_types` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `property_amenities`
--
ALTER TABLE `property_amenities`
  ADD CONSTRAINT `property_amenities_amenity_id_foreign` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_amenities_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_faqs`
--
ALTER TABLE `property_faqs`
  ADD CONSTRAINT `property_faqs_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `property_images_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_types`
--
ALTER TABLE `property_types`
  ADD CONSTRAINT `property_types_property_category_id_foreign` FOREIGN KEY (`property_category_id`) REFERENCES `property_categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
