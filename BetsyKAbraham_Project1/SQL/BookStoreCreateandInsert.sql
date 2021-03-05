-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2021 at 05:49 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `firstname` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `lastname`, `firstname`) VALUES
(1, 'Bronte', 'Emily'),
(2, 'Dickens', 'Charles'),
(3, 'Tolstoy', 'Leo');

-- --------------------------------------------------------

--
-- Table structure for table `bookinventory`
--

CREATE TABLE `bookinventory` (
  `book_id` int(11) NOT NULL,
  `book_Name` varchar(128) NOT NULL,
  `book_AuthorID` int(11) NOT NULL,
  `book_GenreID` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookinventory`
--

INSERT INTO `bookinventory` (`book_id`, `book_Name`, `book_AuthorID`, `book_GenreID`, `quantity`, `price`) VALUES
(1, 'Wuthering Heights', 1, 3, 97, '150'),
(2, 'Great Expectations', 2, 1, 198, '250'),
(3, 'War and Peace', 3, 1, 98, '150'),
(4, 'Oliver Twist', 2, 1, 98, '150'),
(5, 'Anna Karenina', 3, 1, 98, '100');

-- --------------------------------------------------------

--
-- Table structure for table `bookinventoryorder`
--

CREATE TABLE `bookinventoryorder` (
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `order_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookinventoryorder`
--

INSERT INTO `bookinventoryorder` (`order_id`, `book_id`, `order_count`) VALUES
(33, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `genre_name` varchar(128) NOT NULL,
  `genre_description` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `genre_name`, `genre_description`) VALUES
(1, 'Novel', 'English Serial Novel'),
(2, 'Fiction', 'English Fiction'),
(3, 'Tragedy', 'Tragedy or Gothic');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `bookinventory`
--
ALTER TABLE `bookinventory`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `authorID` (`book_AuthorID`),
  ADD KEY `genreID` (`book_GenreID`);

--
-- Indexes for table `bookinventoryorder`
--
ALTER TABLE `bookinventoryorder`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookinventory`
--
ALTER TABLE `bookinventory`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bookinventoryorder`
--
ALTER TABLE `bookinventoryorder`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookinventory`
--
ALTER TABLE `bookinventory`
  ADD CONSTRAINT `authorID` FOREIGN KEY (`book_AuthorID`) REFERENCES `author` (`author_id`),
  ADD CONSTRAINT `genreID` FOREIGN KEY (`book_GenreID`) REFERENCES `genre` (`genre_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
