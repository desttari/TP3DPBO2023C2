-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 23, 2023 at 04:00 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_artis`
--

-- --------------------------------------------------------

--
-- Table structure for table `agensi`
--

DROP TABLE IF EXISTS `agensi`;
CREATE TABLE IF NOT EXISTS `agensi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_agensi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `agensi`
--

INSERT INTO `agensi` (`id`, `nama_agensi`) VALUES
(2, 'SM'),
(5, 'YG'),
(6, 'StarHits'),
(7, 'BigHit'),
(9, 'JYP');

-- --------------------------------------------------------

--
-- Table structure for table `negara`
--

DROP TABLE IF EXISTS `negara`;
CREATE TABLE IF NOT EXISTS `negara` (
  `id` int NOT NULL AUTO_INCREMENT,
  `negara` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `negara`
--

INSERT INTO `negara` (`id`, `negara`) VALUES
(1, 'Korea Selatan'),
(4, 'Indo'),
(5, 'India'),
(6, 'Malay'),
(7, 'America');

-- --------------------------------------------------------

--
-- Table structure for table `penyanyi`
--

DROP TABLE IF EXISTS `penyanyi`;
CREATE TABLE IF NOT EXISTS `penyanyi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `tahun_debut` int DEFAULT NULL,
  `id_type` int DEFAULT NULL,
  `id_agensi` int DEFAULT NULL,
  `id_negara` int DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_type` (`id_type`),
  KEY `id_agensi` (`id_agensi`),
  KEY `id_negara` (`id_negara`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penyanyi`
--

INSERT INTO `penyanyi` (`id`, `nama`, `tahun_debut`, `id_type`, `id_agensi`, `id_negara`, `foto`) VALUES
(15, 'Reevs', 2033, 9, 2, 7, 'areena reevs11.png'),
(14, 'Shiena', 2023, 7, 6, 4, 'shiena holz.png'),
(13, 'Freea', 2043, 5, 7, 6, 'areena reevs8.png'),
(12, 'areena', 2043, 5, 5, 7, 'areena reevs5.png');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_nama` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `type_nama`) VALUES
(5, 'Solo'),
(6, 'Boys Group'),
(7, 'Girls Group'),
(8, 'Duet'),
(9, 'Anime_singers');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
