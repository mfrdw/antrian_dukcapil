-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2025 at 01:40 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antrian_dukcapil`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id` int NOT NULL,
  `loket_antri` varchar(50) NOT NULL,
  `no_antri` varchar(50) NOT NULL,
  `jumlah_antri` int NOT NULL,
  `nama_loket` varchar(50) DEFAULT NULL,
  `user` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id`, `loket_antri`, `no_antri`, `jumlah_antri`, `nama_loket`, `user`, `created_at`) VALUES
(1, 'PELAYANAN', 'A001', 0, NULL, 'Fikri', '2025-06-12 02:38:58'),
(2, 'PELAYANAN', 'A002', 0, NULL, 'Fikri', '2025-06-12 02:39:09'),
(3, 'PELAYANAN', 'A003', 0, NULL, 'Fikri', '2025-06-12 02:39:17'),
(4, 'PELAYANAN', 'A004', 0, NULL, 'Fikri', '2025-06-12 02:39:28'),
(5, 'PELAYANAN', 'A005', 0, NULL, 'Fikri', '2025-06-12 04:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `loket`
--

CREATE TABLE `loket` (
  `id` int NOT NULL,
  `loket_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `loket`
--

INSERT INTO `loket` (`id`, `loket_name`) VALUES
(1, 'PELAYANAN'),
(2, 'PEREKAMAN');

-- --------------------------------------------------------

--
-- Table structure for table `no_antrian`
--

CREATE TABLE `no_antrian` (
  `id` int NOT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `no_antrian` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `no_antrian`
--

INSERT INTO `no_antrian` (`id`, `kategori`, `no_antrian`) VALUES
(1, 'PELAYANAN', 'A001'),
(2, 'PELAYANAN', 'A002'),
(3, 'PELAYANAN', 'A003'),
(4, 'PELAYANAN', 'A004'),
(5, 'PELAYANAN', 'A005'),
(6, 'PELAYANAN', 'A006'),
(7, 'PELAYANAN', 'A007'),
(8, 'PELAYANAN', 'A008'),
(9, 'PELAYANAN', 'A009'),
(10, 'PELAYANAN', 'A010'),
(11, 'PELAYANAN', 'A011'),
(12, 'PELAYANAN', 'A012'),
(13, 'PELAYANAN', 'A013'),
(14, 'PELAYANAN', 'A014'),
(15, 'PELAYANAN', 'A015'),
(16, 'PELAYANAN', 'A016'),
(17, 'PELAYANAN', 'A017'),
(18, 'PELAYANAN', 'A018'),
(19, 'PELAYANAN', 'A019'),
(20, 'PELAYANAN', 'A020'),
(21, 'PELAYANAN', 'A021'),
(22, 'PELAYANAN', 'A022'),
(23, 'PELAYANAN', 'A023'),
(24, 'PELAYANAN', 'A024'),
(25, 'PELAYANAN', 'A025'),
(26, 'PELAYANAN', 'A026'),
(27, 'PELAYANAN', 'A027'),
(28, 'PELAYANAN', 'A028'),
(29, 'PELAYANAN', 'A029'),
(30, 'PELAYANAN', 'A030'),
(31, 'PELAYANAN', 'A031'),
(32, 'PELAYANAN', 'A032'),
(33, 'PELAYANAN', 'A033'),
(34, 'PELAYANAN', 'A034'),
(35, 'PELAYANAN', 'A035'),
(36, 'PELAYANAN', 'A036'),
(37, 'PELAYANAN', 'A037'),
(38, 'PELAYANAN', 'A038'),
(39, 'PELAYANAN', 'A039'),
(40, 'PELAYANAN', 'A040'),
(41, 'PELAYANAN', 'A041'),
(42, 'PELAYANAN', 'A042'),
(43, 'PELAYANAN', 'A043'),
(44, 'PELAYANAN', 'A044'),
(45, 'PELAYANAN', 'A045'),
(46, 'PELAYANAN', 'A046'),
(47, 'PELAYANAN', 'A047'),
(48, 'PELAYANAN', 'A048'),
(49, 'PELAYANAN', 'A049'),
(50, 'PELAYANAN', 'A050'),
(51, 'PEREKEMAN', 'B001'),
(52, 'PEREKEMAN', 'B002'),
(53, 'PEREKEMAN', 'B003'),
(54, 'PEREKEMAN', 'B004'),
(55, 'PEREKEMAN', 'B005'),
(56, 'PEREKEMAN', 'B006'),
(57, 'PEREKEMAN', 'B007'),
(58, 'PEREKEMAN', 'B008'),
(59, 'PEREKEMAN', 'B009'),
(60, 'PEREKEMAN', 'B010'),
(61, 'PEREKEMAN', 'B011'),
(62, 'PEREKEMAN', 'B012'),
(63, 'PEREKEMAN', 'B013'),
(64, 'PEREKEMAN', 'B014'),
(65, 'PEREKEMAN', 'B015'),
(66, 'PEREKEMAN', 'B016'),
(67, 'PEREKEMAN', 'B017'),
(68, 'PEREKEMAN', 'B018'),
(69, 'PEREKEMAN', 'B019'),
(70, 'PEREKEMAN', 'B020'),
(71, 'PEREKEMAN', 'B021'),
(72, 'PEREKEMAN', 'B022'),
(73, 'PEREKEMAN', 'B023'),
(74, 'PEREKEMAN', 'B024'),
(75, 'PEREKEMAN', 'B025'),
(76, 'PEREKEMAN', 'B026'),
(77, 'PEREKEMAN', 'B027'),
(78, 'PEREKEMAN', 'B028'),
(79, 'PEREKEMAN', 'B029'),
(80, 'PEREKEMAN', 'B030'),
(81, 'PEREKEMAN', 'B031'),
(82, 'PEREKEMAN', 'B032'),
(83, 'PEREKEMAN', 'B033'),
(84, 'PEREKEMAN', 'B034'),
(85, 'PEREKEMAN', 'B035'),
(86, 'PEREKEMAN', 'B036'),
(87, 'PEREKEMAN', 'B037'),
(88, 'PEREKEMAN', 'B038'),
(89, 'PEREKEMAN', 'B039'),
(90, 'PEREKEMAN', 'B040'),
(91, 'PEREKEMAN', 'B041'),
(92, 'PEREKEMAN', 'B042'),
(93, 'PEREKEMAN', 'B043'),
(94, 'PEREKEMAN', 'B044'),
(95, 'PEREKEMAN', 'B045'),
(96, 'PEREKEMAN', 'B046'),
(97, 'PEREKEMAN', 'B047'),
(98, 'PEREKEMAN', 'B048'),
(99, 'PEREKEMAN', 'B049'),
(100, 'PEREKEMAN', 'B050');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_loket` enum('Loket 1','Loket 2','Loket 3','Loket 4','Loket 5','Loket 6') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role_loket`) VALUES
(1, 'Muhammad Fikri Ridwan', 'fikri', '123', 'Loket 1'),
(2, 'Aditya Fathurrahman', 'patur', '123', 'Loket 6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loket`
--
ALTER TABLE `loket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `no_antrian`
--
ALTER TABLE `no_antrian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loket`
--
ALTER TABLE `loket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `no_antrian`
--
ALTER TABLE `no_antrian`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
