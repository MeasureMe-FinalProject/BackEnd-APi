-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 28, 2024 at 05:27 AM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u805139855_MeasureMeDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `measure`
--

CREATE TABLE `measure` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `size_recommendation` varchar(11) NOT NULL,
  `height` double NOT NULL,
  `bust_circumference` double NOT NULL,
  `waist_circumference` double NOT NULL,
  `hip_circumference` double NOT NULL,
  `shoulder_width` double NOT NULL,
  `sleeve_length` double NOT NULL,
  `pants_length` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `measure`
--

INSERT INTO `measure` (`id`, `id_user`, `size_recommendation`, `height`, `bust_circumference`, `waist_circumference`, `hip_circumference`, `shoulder_width`, `sleeve_length`, `pants_length`) VALUES
(1, 1, 'S', 160, 20, 20, 30, 40, 40, 41),
(2, 1, 'S', 160, 20, 20, 30, 40, 40, 41),
(3, 1, 'S', 160, 20, 20, 30, 40, 40, 41);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `age` int(10) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `height` int(10) NOT NULL,
  `weight` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `age`, `gender`, `height`, `weight`) VALUES
(1, 'adam', 'adam@gmail.com', 'adam', 0, '', 0, 0),
(2, 'zieq', 'zieq@gmail.com', 'zieq', 0, '', 0, 0),
(3, 'andi', 'andi@gmail.com', 'andi', 0, '', 0, 0),
(4, 'diki', 'diki@gmail.com', 'diki', 0, '', 0, 0),
(5, 'andii', 'andii@gmail.com', 'andi', 0, '', 0, 0),
(6, 'diki', 'dikii@gmail.com', 'diki', 0, '', 0, 0),
(7, 'andiidd', 'anddii@gmail.com', 'andi', 0, '', 0, 0),
(8, 'Diki Dwi Diro', 'wdwd', 'dwdwd3', 0, '', 0, 0),
(9, 'Diki Dwi Diro', 'fikifeif@gmail.com', 'dwdwd3', 0, '', 0, 0),
(10, 'Diki Dwi Diro', 'dikidwid000@gmail.com', 'dikidwid0123', 0, '', 0, 0),
(11, 'Diki Dwi Diro', 'dikiwdwd@gmal.com', '22', 0, '', 0, 0),
(12, 'Diki Dwi Diro', 'dikidwid-23@gmail.com232', '33', 0, '', 0, 0),
(13, 'Diki Dwi Diroooo', 'dikidwid0@gmail.com', 'dikidwid0123', 0, '', 0, 0),
(14, 'Diki Dwi Diro', 'd1323', 'awdawd', 0, '', 0, 0),
(15, 'wdwdwdwdwd', 'anddidwdwdwdi@gmail.com', 'wdwdwdwdwdwd', 0, '', 0, 0),
(16, 'Diki Dwi Diro', 'diki@gmail.commmm', '234234234234234', 0, '', 0, 0),
(17, 'Diki Dwi Diro', 'dwdwd@gmail.com', 'dwadawdawd', 0, '', 0, 0),
(18, 'Diki', 'dwadwda@gmail.com', 'adwdwdwdwdw', 0, '', 0, 0),
(19, 'Diki Dwi Diro', 'dwdwdw@gmail.com', 'wdawdwadawdad', 0, '', 0, 0),
(20, 'rizieq ghifari wijaya', 'rizieq@gmail.com', 'rizieqwijaya', 0, '', 0, 0),
(21, 'fikriansyah', 'ian@gmail.com', 'ian12345', 0, '', 0, 0),
(22, 'ddjdncxx', 'dxxx@gmail.com', 'ccxxxcccc', 0, '', 0, 0),
(23, 'Dimas Triadi', 'dimas@gmail.com', 'dimas123', 0, '', 0, 0),
(24, 'Diki Dwi Diro ', 'djdjdjd@gmail.com', 'shshsdjsisjs', 0, '', 0, 0),
(25, 'budi', 'budi@gmail.com', 'budi', 0, '', 0, 0),
(26, 'budi', 'budis@gmail.com', 'budi', 0, '', 0, 0),
(27, 'budi', 'budisa@gmail.com', 'budi', 0, '', 0, 0),
(28, 'budi', 'udisa@gmail.com', 'budi', 0, '', 0, 0),
(29, 'budi', 'disa@gmail.com', 'budi', 0, '', 0, 0),
(30, 'budi', 'disad@gmail.com', 'budi', 0, '', 0, 0),
(31, 'budi', 'disad@gmail.coms', 'budi', 0, '', 0, 0),
(32, 'Diki Dwi Diro', 'test@gmail.commm', 'dikidwid', 0, '', 0, 0),
(33, 'Diki Dwi Diro', 'test@gmai.com', 'dikidwid', 0, '', 0, 0),
(34, 'Diki Dwi Diro', 'test@t2.com', 'dikidwid', 0, '', 0, 0),
(35, 'Diki Dwi', 't1@t1.com', 'dikidwid', 0, '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `measure`
--
ALTER TABLE `measure`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `measure`
--
ALTER TABLE `measure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `measure`
--
ALTER TABLE `measure`
  ADD CONSTRAINT `foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
