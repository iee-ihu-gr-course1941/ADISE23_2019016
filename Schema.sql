-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for griniaris
CREATE DATABASE IF NOT EXISTS `griniaris` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `griniaris`;

-- Dumping structure for table griniaris.board
CREATE TABLE IF NOT EXISTS `board` (
  `p_color` enum('B','Y','R','G') NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `p_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`p_color`),
  KEY `position` (`position`),
  KEY `p_number` (`p_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table griniaris.board_empty
CREATE TABLE IF NOT EXISTS `board_empty` (
  `p_color` enum('B','Y','R','G') NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `p_number` int(11) DEFAULT NULL,
  PRIMARY KEY (`p_color`),
  KEY `position` (`position`),
  KEY `p_number` (`p_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for procedure griniaris.clean_board
DELIMITER //
CREATE PROCEDURE `clean_board`()
BEGIN
 	TRUNCATE board;
	INSERT INTO board SELECT * FROM board_empty;
END//
DELIMITER ;

-- Dumping structure for table griniaris.game_status
CREATE TABLE IF NOT EXISTS `game_status` (
  `status` enum('not active','initialized','started','ended','aborded') DEFAULT 'not active',
  `p_turn` enum('B','Y','R','G') DEFAULT NULL,
  `result` enum('B','Y','R','G','D') DEFAULT NULL,
  `last_change` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table griniaris.pieces
CREATE TABLE IF NOT EXISTS `pieces` (
  `Color` char(1) DEFAULT NULL,
  `Number` int(4) DEFAULT 4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table griniaris.players
CREATE TABLE IF NOT EXISTS `players` (
  `username` varchar(20) DEFAULT NULL,
  `piece_color` enum('B','R','Y','G') DEFAULT NULL,
  `spawn_pieces` int(4) DEFAULT NULL,
  `token` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for procedure griniaris.show_login
DELIMITER //
CREATE PROCEDURE `show_login`()
BEGIN
	SELECT * FROM players WHERE token IS NOT NULL;
END//
DELIMITER ;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
