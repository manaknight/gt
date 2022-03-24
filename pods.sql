-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 20, 2021 at 06:55 PM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game_tournament`
--

-- --------------------------------------------------------

--
-- Table structure for table `mkd_contest`
--

CREATE TABLE `mkd_contest` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `no_of_particpants` int DEFAULT NULL,
  `no_of_left` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `total_prize_pool` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `winner_1` int DEFAULT NULL,
  `winner_2` int DEFAULT NULL,
  `winner_3` int DEFAULT NULL,
  `winner_4` int DEFAULT NULL,
  `winner_5` varchar(255) DEFAULT NULL,
  `draw_winner` varchar(255) DEFAULT NULL,
  `num_winners` varchar(255) DEFAULT NULL,
  `prize_1` varchar(255) DEFAULT NULL,
  `prize_2` varchar(255) DEFAULT NULL,
  `prize_3` varchar(255) DEFAULT NULL,
  `prize_4` varchar(255) DEFAULT NULL,
  `prize_5` varchar(255) DEFAULT NULL,
  `prize_draw` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mkd_pods`
--

CREATE TABLE `mkd_pods` (
  `id` int NOT NULL,
  `contest_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mkd_pod_competitors`
--

CREATE TABLE `mkd_pod_competitors` (
  `id` int NOT NULL,
  `pod_id` int NOT NULL,
  `portfolio_id` int NOT NULL,
  `votes` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mkd_pod_competitor_votes`
--

CREATE TABLE `mkd_pod_competitor_votes` (
  `id` int NOT NULL,
  `mkd_pod_competitors_id` int NOT NULL,
  `voter_id` int NOT NULL,
  `pod_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mkd_portfolio`
--

CREATE TABLE `mkd_portfolio` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `font_id` int NOT NULL,
  `category_id` int NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `psuedoname` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `submitted_to_contest` varchar(255) NOT NULL,
  `visibility` varchar(255) NOT NULL,
  `looser_status` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mkd_contest`
--
ALTER TABLE `mkd_contest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mkd_pods`
--
ALTER TABLE `mkd_pods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mkd_pod_competitors`
--
ALTER TABLE `mkd_pod_competitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mkd_pod_competitor_votes`
--
ALTER TABLE `mkd_pod_competitor_votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mkd_portfolio`
--
ALTER TABLE `mkd_portfolio`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mkd_contest`
--
ALTER TABLE `mkd_contest`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mkd_pods`
--
ALTER TABLE `mkd_pods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mkd_pod_competitors`
--
ALTER TABLE `mkd_pod_competitors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mkd_pod_competitor_votes`
--
ALTER TABLE `mkd_pod_competitor_votes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mkd_portfolio`
--
ALTER TABLE `mkd_portfolio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
