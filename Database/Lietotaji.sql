-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 27 2025 г., 01:54
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Lietotaji`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lietotaji`
--

CREATE TABLE `lietotaji` (
  `lietotaji_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `parole` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `lietotaji`
--

INSERT INTO `lietotaji` (`lietotaji_id`, `username`, `parole`) VALUES
(1, 'test1', '$2y$10$wQSDbJhixwXJqkXpYefDXe8iTNhqYkrlkfZgvAmKE9y2FKebrY32K');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lietotaji`
--
ALTER TABLE `lietotaji`
  ADD PRIMARY KEY (`lietotaji_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lietotaji`
--
ALTER TABLE `lietotaji`
  MODIFY `lietotaji_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
