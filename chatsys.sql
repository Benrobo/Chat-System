-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2021 at 05:15 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11
-- Created By : Alumona Benaiah

--
-- Database: `chatsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(30) NOT NULL,
  `userId` int(225) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_img` text NOT NULL,
  `active_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

-- Default Data inside user_info table


-- INSERT INTO `user_info` (`id`, `userId`, `username`, `password`, `email`, `user_img`, `active_at`, `status`) VALUES
-- (1, 326718, 'Benrobo', '$2y$10$3yVoONdnrWZZXqYB73otPeRsC.ZBl7OTvsRaDrmKm0WVOBOd6kwJW', 'benrobo@mail.com', '180617.png', '2021-03-12 04:04:33', 'Off'),
-- (2, 377886, 'Benaiah', '$2y$10$.YBXqb6x3zz285qXe/lCqefHKMI1KiZ.JzLPura.8nV4amtnm0Vku', 'alumonabenaiah456@gmail.com', '96828.png', '2021-03-12 04:04:04', 'Off'),
-- (3, 108660, 'Goodness', '$2y$10$htxmu77iL2PiAzrig7OgMuZdfZW7.CmD5flgh6X4WFyzH3vmvJ/1S', 'goodness@mail.com', '284820.png', '2021-03-12 04:04:52', 'On');

-- --------------------------------------------------------

--
-- Table structure for table `user_msg`
--

CREATE TABLE `user_msg` (
  `id` int(30) NOT NULL,
  `incoming_id` int(255) NOT NULL,
  `outgoing_id` int(255) NOT NULL,
  `messages` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_msg`
--
ALTER TABLE `user_msg`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_msg`
--
ALTER TABLE `user_msg`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;
COMMIT;
