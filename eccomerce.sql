-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2024 at 01:57 AM
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
-- Database: `eccomerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_amount` decimal(11,0) NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `about` varchar(300) NOT NULL,
  `product_image` longblob NOT NULL,
  `category` varchar(200) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status_order` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(300) NOT NULL,
  `role` varchar(100) NOT NULL,
  `profile_picture` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fullname`, `username`, `password`, `role`, `profile_picture`) VALUES
(1, 'Rene O Salvacion', 'jayjay@gmail.com', '$2y$10$Z0lBm8ovaGP4kWLYpfyRhuSw/LVfpkr.IuKu/4OGAuM1stwgkYQa2', 'User', 0x2e2f75706c6f6164732f6372657461746976652073686f742e6a7067),
(2, 'Jayjay', 'jayr@gmail.com', '$2y$10$taaNfaoOG7NT7wLEqNmQN.fFfjiq8BrDyIP0Y1DVNsmuUQTDB7V2i', 'Admin', 0x2e2f75706c6f6164732f57494e5f32303231303931305f30305f32305f35355f50726f2e6a7067),
(3, 'AKO to', 'jayjay@gmail.com', '$2y$10$QZqBAE3iUlGoAmh0/yKmHOpNPMcT5YNgSSkWwKr7Yxt0Gak7lI4a6', 'User', 0x2e2f75706c6f6164732f63686169722e706e67),
(4, 'akoto', 'jayjay@gmail.com', '$2y$10$4pSdXPOXqnrN.f2wUKRe8u7uqqym8IxAgsuqFZpju6.85yT2MAZgG', 'User', 0x2e2f75706c6f6164732f6368616972735f636f2e6a7067),
(5, 'akoto', 'rene@gmail.com', '$2y$10$g9hI3lwB2Pf309nuHlxtPuyc4FzPcs.Kcumh43WfxBAX.NruEc1Ry', 'Admin', 0x2e2f75706c6f6164732f),
(6, 'akoto', 'rene@gmail.com', '$2y$10$RvU.msyxKGPU3DViSXjWM.Phle0iUwHRAEsnkLevTebZOxMYp.eM6', 'User', 0x2e2f75706c6f6164732f6368616972735f636f2e6a7067),
(7, 'akoto', 'rene12@gmail.com', '$2y$10$NGJ/o7fAqEIAIS9YKpD67.ReAsuVvMs4dpbxjgqA04RVRqB4Mloka', 'Admin', 0x2e2f75706c6f6164732f61636365736f726965735f7374796c652e6a7067),
(8, 'das', 'erica@gmail.com', '$2y$10$Of2Y./.SRgScPlQBPugO2.j4pwsACZakVUeP51mBZ.xB5D8g8ROF2', 'User', 0x2e2f75706c6f6164732f63686169722e706e67),
(9, 'jackie', 'jakielyn@gmail.com', '$2y$10$KHhZYXV6KSqtmGZ1kbH1I.8eJ83Pp1/SzEjZXoR7GMAw4O2.SIW5O', 'User', 0x2e2f75706c6f6164732f61636365736f726965735f7374796c652e6a7067),
(10, 'okie', 'okie@gmail.com', '$2y$10$b6z2Jee5BVdkqx./5rtPneUamSGDTGmWn3zdR/To55IZDLapnNtne', 'Admin', 0x2e2f75706c6f6164732f686f6d655f61636365736f726965732e6a7067),
(11, 'kyrie', 'kyrie@gmail.com', '$2y$10$UuUY2MbE9nsej.km9JgLRu2VPSSMQM1aV5JuWn1NxeF7D2i/HmFLC', 'User', 0x2e2f75706c6f6164732f666f726b2e6a7067);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
