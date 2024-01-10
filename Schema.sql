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

-- Dumping structure for procedure griniaris.block
DELIMITER //
CREATE PROCEDURE `block`()
BEGIN
 SELECT 
    SUM(CASE WHEN p1_piece1 IS NOT NULL  THEN 1 ELSE 0 END +
        CASE WHEN p1_piece2 IS NOT NULL THEN 1 ELSE 0 END +
        CASE WHEN p1_piece3 IS NOT NULL THEN 1 ELSE 0 END +
        CASE WHEN p1_piece4 IS NOT NULL THEN 1 ELSE 0 END) AS piece_count
FROM board
WHERE POSITION=1;

END//
DELIMITER ;

-- Dumping structure for table griniaris.board
CREATE TABLE IF NOT EXISTS `board` (
  `position` int(11) NOT NULL DEFAULT 0,
  `p1_piece1` enum('B1','Y1','R1','G1') DEFAULT NULL,
  `p1_piece2` enum('B2','Y2','R2','G2') DEFAULT NULL,
  `p1_piece3` enum('B3','Y3','R3','G3') DEFAULT NULL,
  `p1_piece4` enum('B4','Y4','R4','G4') DEFAULT NULL,
  `p2_piece1` enum('B1','Y1','R1','G1') DEFAULT NULL,
  `p2_piece2` enum('B2','Y2','R2','G2') DEFAULT NULL,
  `p2_piece3` enum('B3','Y3','R3','G3') DEFAULT NULL,
  `p2_piece4` enum('B4','Y4','R4','G4') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table griniaris.board: ~44 rows (approximately)
DELETE FROM `board`;
INSERT INTO `board` (`position`, `p1_piece1`, `p1_piece2`, `p1_piece3`, `p1_piece4`, `p2_piece1`, `p2_piece2`, `p2_piece3`, `p2_piece4`) VALUES
	(1, 'B1', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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

-- Dumping data for table griniaris.board_empty: ~1 rows (approximately)
DELETE FROM `board_empty`;
INSERT INTO `board_empty` (`p_color`, `game_id`, `position`, `p_number`) VALUES
	('', NULL, NULL, NULL);

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
  `status` enum('not active','initialized','started','ended','aborted') DEFAULT 'not active',
  `p_turn` enum('B','Y','R','G') DEFAULT NULL,
  `result` enum('B','Y','R','G','D') DEFAULT NULL,
  `last_change` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table griniaris.game_status: ~0 rows (approximately)
DELETE FROM `game_status`;
INSERT INTO `game_status` (`status`, `p_turn`, `result`, `last_change`) VALUES
	(NULL, 'B', 'D', '2024-01-10 18:06:02');

-- Dumping structure for procedure griniaris.move2_piece1
DELIMITER //
CREATE PROCEDURE `move2_piece1`(
	IN `piece1` ENUM('B1','Y1','R1','G1'),
	IN `old_position` INT,
	IN `new_position` INT
)
BEGIN
	UPDATE board SET p2_piece1 = piece1  where position = new_position;
	UPDATE board SET p2_piece1 = NULL AND position = NULL WHERE position = old_position ;
	UPDATE players SET last_action = NOW();
END//
DELIMITER ;

-- Dumping structure for procedure griniaris.move2_piece2
DELIMITER //
CREATE PROCEDURE `move2_piece2`(
	IN `piece2` ENUM('B2','Y2','R2','G2'),
	IN `old_position` INT,
	IN `new_position` INT
)
BEGIN
	UPDATE board SET p2_piece2 = piece2  where position = new_position;
	UPDATE board SET p2_piece2 = NULL AND position = NULL WHERE position = old_position ;
	UPDATE players SET last_action = NOW();
END//
DELIMITER ;

-- Dumping structure for procedure griniaris.move2_piece3
DELIMITER //
CREATE PROCEDURE `move2_piece3`(
	IN `piece3` ENUM('B3','Y3','R3','G3'),
	IN `old_position` INT,
	IN `new_position` INT
)
BEGIN
	UPDATE board SET p1_piece1 = piece1  where position = new_position;
	UPDATE board SET p1_piece1 = NULL AND position = NULL WHERE position = old_position ;
	UPDATE players SET last_action = NOW();
END//
DELIMITER ;

-- Dumping structure for procedure griniaris.move2_piece4
DELIMITER //
CREATE PROCEDURE `move2_piece4`(
	IN `piece4` ENUM('B4','Y4','R4','G4'),
	IN `old_position` INT,
	IN `new_position` INT
)
BEGIN
	UPDATE board SET p1_piece1 = piece1  where position = new_position;
	UPDATE board SET p1_piece1 = NULL AND position = NULL WHERE position = old_position ;
	UPDATE players SET last_action = NOW();
END//
DELIMITER ;

-- Dumping structure for procedure griniaris.move_piece1
DELIMITER //
CREATE PROCEDURE `move_piece1`(
	IN `piece1` ENUM('B1','Y1','R1','G1'),
	IN `old_position` INT,
	IN `new_position` INT
)
BEGIN

UPDATE board SET p1_piece1 = piece1  where position = new_position;
UPDATE board SET p1_piece1 = NULL AND position = NULL WHERE position = old_position ;
UPDATE players SET last_action = NOW();
END//
DELIMITER ;

-- Dumping structure for procedure griniaris.move_piece2
DELIMITER //
CREATE PROCEDURE `move_piece2`(
	IN `piece2` ENUM('B2','Y2','R2','G2'),
	IN `oldposition` INT,
	IN `newposition` INT
)
BEGIN

UPDATE board SET p1_piece2 = piece2  where position = new_position;
UPDATE board SET p1_piece2 = NULL AND position = NULL WHERE position = old_position ;
UPDATE players SET last_action = NOW();

END//
DELIMITER ;

-- Dumping structure for procedure griniaris.move_piece3
DELIMITER //
CREATE PROCEDURE `move_piece3`(
	IN `piece3` ENUM('B3' ,'Y3','R3','G3'),
	IN `old_position` INT,
	IN `new_position` INT
)
BEGIN

	UPDATE board SET p1_piece3 = piece3  where position = new_position;
	UPDATE board SET p1_piece3 = NULL AND position = NULL WHERE position = old_position ;
	UPDATE players SET last_action = NOW();

END//
DELIMITER ;

-- Dumping structure for procedure griniaris.move_piece4
DELIMITER //
CREATE PROCEDURE `move_piece4`(
	IN `piece4` ENUM('B4','R4','G4','Y4'),
	IN `old_position` INT,
	IN `new_position` INT
)
BEGIN
UPDATE board SET p1_piece4 = piece4  where position = new_position;
UPDATE board SET p1_piece4 = NULL AND position = NULL WHERE position = old_position ;
UPDATE players SET last_action = NOW();

END//
DELIMITER ;

-- Dumping structure for table griniaris.pieces
CREATE TABLE IF NOT EXISTS `pieces` (
  `Color` char(1) DEFAULT NULL,
  `Number` int(4) DEFAULT 4
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table griniaris.pieces: ~4 rows (approximately)
DELETE FROM `pieces`;
INSERT INTO `pieces` (`Color`, `Number`) VALUES
	('B', 4),
	('R', 4),
	('Y', 4),
	('G', 4);

-- Dumping structure for table griniaris.players
CREATE TABLE IF NOT EXISTS `players` (
  `username` varchar(20) DEFAULT NULL,
  `piece_color` enum('B','R','Y','G') DEFAULT NULL,
  `spawn_pieces` int(4) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `last_action` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table griniaris.players: ~3 rows (approximately)
DELETE FROM `players`;
INSERT INTO `players` (`username`, `piece_color`, `spawn_pieces`, `token`, `last_action`) VALUES
	('Iraklis', 'B', 4, '4f95535f9847ebca9884e0003037034f', '2024-01-10 22:27:06'),
	('Antonis', 'Y', 4, '403320733eda02093dbe62de5996ae45', '2024-01-10 22:27:06'),
	(NULL, 'R', 4, NULL, '2024-01-10 22:27:06'),
	(NULL, 'G', 4, NULL, '2024-01-10 22:27:06');

-- Dumping structure for table griniaris.players_logged
CREATE TABLE IF NOT EXISTS `players_logged` (
  `Column 1` int(11) DEFAULT NULL,
  `Column 2` int(11) DEFAULT NULL,
  `Column 3` int(11) DEFAULT NULL,
  `Column 4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table griniaris.players_logged: ~0 rows (approximately)
DELETE FROM `players_logged`;

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
