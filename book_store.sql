-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2025 at 09:19 AM
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
-- Database: `book_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Web developer', 'lumbhanijanvi59@gmail.com', '$2y$10$YBSxXykCJfnqNlWdQITaPOztKnVsGQ9kxENJvzXcCFKoyLk9DY59u', '2025-06-18 15:57:40');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `content`, `image`, `created_at`, `file_name`) VALUES
(1, '5 Tips to Choose the Perfect Book', '  Choosing the perfect book involves understanding your interests, reading reviews, and exploring different genres. \r\n        Start by asking yourself what mood you\'re in and what you want to learn or feel. \r\n        Don\'t hesitate to ask friends or librarians for recommendations.\r\n        Also, preview the first chapter if possible to see if the writing style suits you. \r\n        Finally, keep an open mind and try new authors!\r\n      ', 'images/blog1.jpg', '2025-06-07 21:42:28', 'blog.php'),
(2, 'Unlock Growth Through Reading', '\r\n        Reading a book is more than just a pastime — it’s a gateway to personal growth and lifelong learning. On our platform, you’ll find a curated selection of books that not only entertain but also inspire and educate. Books help expand your horizons, introduce new perspectives, and deepen your understanding of the world around you. Whether you’re diving into fiction to spark creativity or exploring non-fiction to gain practical knowledge, reading fuels your mind and empowers you to grow.\r\n\r\nMoreover, reading enhances critical thinking and improves communication skills, essential qualities in today’s fast-paced world. Our platform offers a diverse range of genres and authors, so you can discover stories and ideas that resonate with your unique interests. Embrace the joy of reading with us — every book you pick up is a step toward becoming a better, more informed version of yourself.\r\n\r\n', 'images/blog2.jpg', '2025-06-07 21:44:40', 'blog1.php'),
(3, '10 Smuttiest Books You Will Ever Read', 'In ancient India, love and sensuality were not only accepted but celebrated as vital aspects of human experience. Unlike many cultures that have historically viewed eroticism as taboo, Hindu culture, through its vast literary and spiritual traditions, has embraced the exploration of desire, love, and intimacy as a path toward both personal fulfillment and spiritual awakening.<br><br>\r\n\r\nBelow, we explore 10 important Hindu-related texts that delve deeply into eroticism, love, and the arts of romance — some of which are considered timeless classics in world literature.<br><br>\r\n\r\n1. Kama Sutra<br>\r\nThe Kama Sutra, composed by Vatsyayana around the 3rd century CE, remains the most famous Indian treatise on love, relationships, and sexual pleasure. Contrary to popular misconception, it is much more than a sex manual. The Kama Sutra explores how to live a balanced life, including the importance of emotional intimacy, social etiquette, and the pursuit of desire as part of human well-being.<br><br>\r\n\r\n2. Ananga Ranga<br>\r\nWritten by Kalyanamalla in the 15th century, Ananga Ranga is another classical guide to the art of love and intimacy. Its verses emphasize enhancing pleasure in marriage, focusing on the mutual enjoyment and understanding between partners, complete with advice on physical techniques and emotional connection.<br><br>\r\n\r\n3. Ratirahasya (Koka Shastra)<br>\r\nThe Ratirahasya, or Koka Shastra, attributed to Kokkoka, is a detailed Sanskrit text on erotics and love, covering topics like courtship, lovemaking, and sexual compatibility. This work, much like the Kama Sutra, aims to harmonize the sensual with the spiritual, offering a holistic approach to intimacy.<br><br>\r\n\r\n4. Jayamangala<br>\r\nJayamangala is a classical commentary on the Kama Sutra that further explains and elaborates on the nuances of love and sexual pleasure. This text helped popularize Vatsyayana’s work and served as a guide for lovers and scholars alike.<br><br>\r\n\r\n5. Gita Govinda<br>\r\nWritten by the 12th-century poet Jayadeva, the Gita Govinda is a lyrical and devotional poem celebrating the divine love between Lord Krishna and Radha. Though primarily spiritual, the poetry is rich with sensual imagery and expressions of longing, depicting love as both a worldly and divine experience.<br><br>\r\n\r\n6. Vatsyayana’s Commentary on Kama Sutra<br>\r\nBesides authoring the Kama Sutra, Vatsyayana also provided commentary that explores the philosophical and spiritual underpinnings of the text, framing desire and love as essential elements of life’s purpose.<br><br>\r\n\r\n7. Bharata’s Natya Shastra<br>\r\nWhile the Natya Shastra is primarily a foundational text on drama, dance, and music, it includes extensive discussions on the Rasas — the emotional flavors of art. Among these, Shringara Rasa (erotic sentiment) is considered the king of emotions, highlighting the central role of love and sensuality in Indian aesthetics.<br><br>\r\n\r\n8. Mṛcchakatika (The Little Clay Cart)<br>\r\nThis classical Sanskrit play by Shudraka combines political intrigue, social commentary, and a romantic plot. The play’s depiction of love scenes and the complex relationships between characters reflects the sophisticated approach to sensuality and romance in ancient Indian theatre.<br><br>\r\n\r\n9. Erotic Stories in the Puranas<br>\r\nMany Puranas, ancient Hindu texts chronicling legends and myths, include stories filled with erotic symbolism and passionate love stories between gods and mortals. These narratives often illustrate the union of the divine and earthly through the metaphor of love and desire.<br><br>\r\n\r\n10. Sringara Prakasa<br>\r\nWritten by Kshemendra, the Sringara Prakasa is a classical treatise on the erotic sentiment in poetry and art. It analyzes how love and desire inspire creativity and beauty, underlining the cultural reverence for Shringara as a foundational aesthetic experience.\r\n', 'images/blog3.jpg', '2025-06-18 21:45:10', 'blog2.php');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `author` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rating_star` varchar(100) DEFAULT NULL,
  `feature` enum('Yes','No') DEFAULT 'No',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `price`, `image`, `rating_star`, `feature`, `created_at`) VALUES
(1, 'Sita: Warrior of Mithila\r\n', 'Amish', 349.00, 'book1.jpg', '4.0', 'Yes', '2025-06-08 22:04:21'),
(2, 'Draupadi: India\'s First Daughter\r\n', 'Vamshi Krishna', 249.00, 'book2.jpg', '3.9', 'Yes', '2025-06-08 21:54:09'),
(3, 'On The Way to Krishna', 'A.C. Bhaktivedanta Swami Prabhupada', 100.00, 'book4.jpg', '4.5', 'Yes', '2025-06-08 22:08:20'),
(4, 'Krsna', 'A.C. Bhaktivedanta Swami Prabhupada and others', 179.00, 'book5.jpg', '5.0', 'Yes', '2025-06-08 22:08:20'),
(5, 'Rukmini: Krishna\'s Wife', 'Satya Saran', 343.00, 'book6.jpg', '4.2', 'Yes', '2025-06-08 22:14:41'),
(6, 'Krishna\'s Sister', 'Priyanka Bhuyan', 228.00, 'book7.jpg', '3.4', 'Yes', '2025-06-08 22:14:41'),
(7, 'Karma: A Yogi\'s Guide to Crafting Your Destiny', 'Sadhguru', 400.00, 'book10.jpg', '3.8', 'Yes', '2025-06-08 22:22:24'),
(8, 'The Curse of Nalanda\r\n', 'Manna Bahadur\r\n', 400.00, 'book8.jpg', '3.8', 'Yes', '2025-06-08 22:18:15'),
(10, 'Why I Am a Hindu\r\n\r\n', 'Shashi Tharoor\r\n', 600.00, 'book11.jpg', '5.0', 'Yes', '2025-06-08 22:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `flash_sales`
--

CREATE TABLE `flash_sales` (
  `id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `original_price` decimal(10,2) DEFAULT NULL,
  `image` varchar(300) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `book_author` varchar(100) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `is_active` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flash_sales`
--

INSERT INTO `flash_sales` (`id`, `book_id`, `original_price`, `image`, `book_title`, `book_author`, `sale_price`, `start_time`, `end_time`, `is_active`) VALUES
(1, 1, 450.00, 'images/book11.jpg', 'Why I Am Hindu', 'Aeny Scello', 300.00, '2025-06-08 21:26:07', '2025-06-10 21:26:07', 0),
(2, 1, 400.00, 'images/book5.jpg', 'Krishna : The Story of Krishna\'s Life', 'Shreela Prabhu p\\ad', 300.00, '2025-06-08 21:26:07', '2025-06-10 21:26:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `status` enum('new','read','replied') DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `fullname`, `email`, `subject`, `message`, `status`, `created_at`) VALUES
(1, 'jigna Vadhvana', 'jigna03@gmail.com', 'Order Tracking Query', 'Where is my order??', 'replied', '2025-06-18 16:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `book_id` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `book_id`, `price`, `customer_name`, `address`, `phone`, `order_date`, `status`) VALUES
(4, 6846863, 8, 400.00, 'janvi lumbhani', 'rajkot,gujarat', '09945678934', '2025-06-09 08:59:08', 'Pending'),
(5, 6846868, 8, 400.00, 'janvi lumbhani', 'rajkot,gujarat', '09945678934', '2025-06-09 09:00:30', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `phone`, `address`, `dob`, `gender`, `password`, `reset_token`) VALUES
(1, 'janvi lumbhani', 'Web developer', 'lumbhanijanvi59@gmail.com', '9945678934', 'rajkot,gujarat', '2025-06-02', 'female', '$2y$10$jefmpzeqm1V3WZfxesV8SepW4eOVPADFGtICuOOTxb8bu1Q.ty3s6', '1fc8e885acb64d806554c1d2cad3d162'),
(2, 'jigna vadhvana', 'jigna', 'jigna@gmail.com', '1234567891', 'Web developer', '2025-06-11', 'female', '$2y$10$p/SqoNfeZCeWe77T2.jqX.B/sX8PsJF/TmDQMN5QSzw/ev1dm8BYq', '2ece9c97c215a255a6b39082a4e9d143'),
(3, 'janvi kakkad', 'kjanvi', 'janvikakkad59@gmail.com', '3455678991', 'rajkot,gujarat', '2025-06-02', 'female', '$2y$10$/71oFHzLltlgz.9d3UQeruX6siUNBwmwThQx2AIPghl9foBvHym6q', NULL),
(4, 'jinal lunagariya', 'Web designer', 'jinal02@gmail.com', '9823450209', 'Green view park, opp mtv hotel ,kalavad road', '2025-06-19', 'female', '$2y$10$6epiiHWM1kAudU4qLY2HkuRrAHDCpupkbxLNjjDw45Ba9mFq4KJ2i', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flash_sales`
--
ALTER TABLE `flash_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `flash_sales`
--
ALTER TABLE `flash_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
