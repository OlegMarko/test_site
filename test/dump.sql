-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 15 2016 г., 09:04
-- Версия сервера: 5.6.17
-- Версия PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dump`
--

CREATE TABLE IF NOT EXISTS `dump` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `input` varchar(1) NOT NULL,
  `output` varchar(1) NOT NULL,
  `time` double NOT NULL,
  `distance` double NOT NULL,
  `price` double NOT NULL,
  `transit` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `dump`
--

INSERT INTO `dump` (`id`, `name`, `input`, `output`, `time`, `distance`, `price`, `transit`) VALUES
(1, 'AB', 'A', 'B', 40, 80, 225, NULL),
(2, 'AC', 'A', 'C', 55, 110, 275, NULL),
(3, 'AE', 'A', 'E', 240, 330, 420, NULL),
(4, 'BF', 'B', 'F', 230, 340, 355, NULL),
(5, 'CD', 'C', 'D', 20, 60, 180, NULL),
(6, 'CE', 'C', 'E', 80, 205, 365, NULL),
(7, 'EF', 'E', 'F', 40, 80, 215, NULL),
(8, 'DF', 'D', 'F', 110, 192, 305, NULL),
(9, 'ABF', 'A', 'F', 270, 450, 580, 'AB, BF'),
(10, 'ACDF', 'A', 'F', 185, 362, 160, 'AC, CD, DF'),
(11, 'ACEF', 'A', 'F', 175, 395, 855, 'AC, CE, EF'),
(12, 'AEF', 'A', 'F', 280, 410, 635, 'AE, EF'),
(13, 'CDF', 'C', 'F', 130, 252, 485, 'CD, DF'),
(14, 'CEF', 'C', 'F', 120, 285, 580, 'CE, EF'),
(15, 'ACD', 'A', 'D', 75, 170, 455, 'AC, CD');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
