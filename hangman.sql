-- --------------------------------------------------------
-- Хост:                         localhost
-- Server version:               10.1.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for hangman
DROP DATABASE IF EXISTS `hangman`;
CREATE DATABASE IF NOT EXISTS `hangman` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `hangman`;


-- Dumping structure for table hangman.categorys
DROP TABLE IF EXISTS `categorys`;
CREATE TABLE IF NOT EXISTS `categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table hangman.categorys: ~2 rows (approximately)
DELETE FROM `categorys`;
/*!40000 ALTER TABLE `categorys` DISABLE KEYS */;
INSERT INTO `categorys` (`id`, `category_name`) VALUES
	(1, 'Animals'),
	(3, 'Cars'),
	(2, 'Cities');
/*!40000 ALTER TABLE `categorys` ENABLE KEYS */;


-- Dumping structure for table hangman.statistics
DROP TABLE IF EXISTS `statistics`;
CREATE TABLE IF NOT EXISTS `statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `victory_game` int(11) NOT NULL DEFAULT '0',
  `waste_game` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__users` (`user_id`),
  CONSTRAINT `FK__users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Dumping data for table hangman.statistics: ~6 rows (approximately)
DELETE FROM `statistics`;
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
INSERT INTO `statistics` (`id`, `victory_game`, `waste_game`, `user_id`) VALUES
	(7, 83, 50, 1),
	(9, 2, 0, 3),
	(13, 2, 0, 18),
	(14, 13, 11, 7),
	(15, 21, 6, 29),
	(16, 0, 0, 13),
	(19, 0, 0, 23);
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;


-- Dumping structure for table hangman.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL DEFAULT '0',
  `password` varchar(250) NOT NULL DEFAULT '0',
  `email` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- Dumping data for table hangman.users: ~13 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
	(1, 'Pesho', '123', 'pesho@abv.bg'),
	(2, 'das', 'das', 'adsa'),
	(3, '?', '?', '?'),
	(5, 'aaa', '123', 'dsadas@anb.nh'),
	(7, 'Hristo', '123', 'hristostoqnov@gmail.com'),
	(13, 'Ivan', '123', 'p.belakov89@gmail.com'),
	(17, 'Svetla', '123', 'hristostoqnov@gmail.com'),
	(18, 'Peter Belakov', '123', 'p_e_t_i_o_1989@abv.bg'),
	(19, 'Ivanka', '123', 'ndnjsdns@dsdsd.bg'),
	(21, 'Dimitrova', '123', 'dimitrowa@abv.bg'),
	(23, 'Petrov', '123', 'petrov@abv.bg'),
	(27, 'Sasho', '123', 'p_e_t_i_o_1989@abv.bg'),
	(29, 'Gosho', '123', 'gosho123@abv.bg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table hangman.words
DROP TABLE IF EXISTS `words`;
CREATE TABLE IF NOT EXISTS `words` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `word` (`word`),
  KEY `FK_words_categorys` (`category_id`),
  CONSTRAINT `FK_words_categorys` FOREIGN KEY (`category_id`) REFERENCES `categorys` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Dumping data for table hangman.words: ~9 rows (approximately)
DELETE FROM `words`;
/*!40000 ALTER TABLE `words` DISABLE KEYS */;
INSERT INTO `words` (`id`, `word`, `description`, `category_id`) VALUES
	(1, 'MONKEY', 'Bouncy animal.', 1),
	(2, 'GIRAFFE', 'African even-toed ungulate mammals.', 1),
	(3, 'BORDEAUX', 'City of wine in France.', 2),
	(4, 'SOFIA', 'The capital of Bulgaria.', 2),
	(5, 'BMW', 'German car brand.', 3),
	(6, 'ROME', 'The capital of Italy.', 2),
	(7, 'PARIS', 'The capital of France.', 2),
	(8, 'VOLKSWAGEN', 'Car for people.', 3),
	(9, 'CEEHTAH', 'It is the fastest land animal.', 1);
/*!40000 ALTER TABLE `words` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
