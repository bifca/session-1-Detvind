-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 02, 2020 at 02:24 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chiupimusic`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `albumID` int(30) NOT NULL,
  `albumName` varchar(40) NOT NULL,
  `coverUrl` varchar(100) NOT NULL,
  `language` varchar(40) NOT NULL,
  `releaseDate` date NOT NULL,
  `onlineUrl` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`albumID`, `albumName`, `coverUrl`, `language`, `releaseDate`, `onlineUrl`) VALUES
(1, 'LE MONDE', 'img/album/LE-MONDE.jpg', 'mandarin', '2019-12-20', 'https://www.xiami.com/album/nnpN9r5e293'),
(2, 'PY', 'img/album/PY.jpg', 'mandarin', '2019-11-22', 'https://www.xiami.com/album/9cLsugf5d54'),
(3, 'DAZED', 'img/album/DAZED.jpg', 'mandarin', '2019-10-24', 'https://www.xiami.com/album/yhZQV69a623'),
(4, 'Martyr', 'img/album/Martyr.jpg', 'mandarin', '2018-12-28', 'https://www.xiami.com/album/b1C3L0o420fd'),
(5, 'AQUARIUS', 'img/album/AQUARIUS.jpg', 'mandarin', '2018-12-04', 'https://www.xiami.com/album/nnkz9n9f759'),
(6, 'Echo of SPLENDOR', 'img/album/Echo-of-SPLENDOR.jpg', 'Pure music', '2018-06-01', 'https://www.xiami.com/album/yhSXU497839'),
(7, 'SPLENDOR', 'img/album/SPLENDOR.jpg', 'mandarin', '2017-12-22', 'https://www.xiami.com/album/nneRxA5765e?spm=a2oj1.12028104.relatedalb.20.4c0078fcdHmAzQ'),
(8, 'Tea time(bibi 16)', 'img/album/Tea-time.jpg', 'Pure music', '2017-02-24', 'https://www.xiami.com/album/9c9Eg718f35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`albumID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
