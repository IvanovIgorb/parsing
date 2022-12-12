-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 12 2022 г., 23:16
-- Версия сервера: 8.0.24
-- Версия PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `parsing`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lots`
--

CREATE TABLE `lots` (
  `id` int NOT NULL,
  `torg_number` int NOT NULL,
  `lot_number` int NOT NULL,
  `link` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `start_price` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `lots`
--

INSERT INTO `lots` (`id`, `torg_number`, `lot_number`, `link`, `start_price`, `date`, `status`) VALUES
(6, 14172, 1, '/public/public-offers/view/14178/', '353 959,60', '2022-12-12 18:00:00', 'Прием заявок'),
(5, 14174, 1, '/public/auctions/view/14180/', '2 900 000,00', '2023-01-27 14:00:00', 'Извещение опубликовано'),
(4, 14175, 2, '/public/public-offers/view/14182/', '675 000,00', '2022-12-12 10:00:00', 'Прием заявок'),
(3, 14210, 1, '/public/public-offers/view/14225/', '2 939 838,30', '2022-12-16 18:00:00', 'Извещение опубликовано'),
(2, 14212, 1, '/public/auctions/view/14216/', '1 730 000,00', '2023-02-01 14:00:00', 'Извещение опубликовано'),
(1, 14213, 1, '/public/auctions/view/14221/', '3 071 079,00', '2023-01-24 13:00:00', 'Прием заявок');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lots`
--
ALTER TABLE `lots`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `torg_number` (`torg_number`,`lot_number`,`link`,`start_price`,`date`,`status`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lots`
--
ALTER TABLE `lots`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
