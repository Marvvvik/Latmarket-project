-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 10 2025 г., 06:25
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
-- База данных: `Transports`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Cars`
--

CREATE TABLE `Cars` (
  `Cars_ID` int NOT NULL,
  `Marka` varchar(255) NOT NULL,
  `Modelis` varchar(255) NOT NULL,
  `Dzinejs` float NOT NULL,
  `Foto_URL` varchar(255) NOT NULL,
  `Izladuma_gads` int NOT NULL,
  `Bezina_tips` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Atrumkarba_tips` varchar(255) NOT NULL,
  `Nobrakums` int NOT NULL,
  `Piedzina` varchar(255) NOT NULL,
  `Krasa` varchar(255) NOT NULL,
  `Cena` float NOT NULL,
  `Apraksts` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Skatijumi` int DEFAULT NULL,
  `Virsbuves_tips` varchar(255) NOT NULL,
  `Tehniska_apskate` varchar(255) NOT NULL,
  `Jauda` int DEFAULT NULL,
  `Vin` varchar(255) NOT NULL,
  `dtp` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Cars`
--

INSERT INTO `Cars` (`Cars_ID`, `Marka`, `Modelis`, `Dzinejs`, `Foto_URL`, `Izladuma_gads`, `Bezina_tips`, `Atrumkarba_tips`, `Nobrakums`, `Piedzina`, `Krasa`, `Cena`, `Apraksts`, `Skatijumi`, `Virsbuves_tips`, `Tehniska_apskate`, `Jauda`, `Vin`, `dtp`) VALUES
(1, 'Audi', 'A6', 3, 'https://primeauto.lv/img/oDcwAtsplURqEhQnvEB8Ow~e~e/1000/AUDI-A6-S-Line-17.jpg', 2014, 'Benzīns', 'Automāts', 150355, 'Pilnpiedziņa', 'Peleka', 20000, '<h1>Pārdodu Audi A6 2014 3.0 TDI Quattro</h1>\n  <p>Meklējat elegantu, jaudīgu un uzticamu automašīnu? Šis Audi A6 2014. gada modelis ar 3.0 litru TDI dzinēju un Quattro piedziņu ir tieši tas, kas jums vajadzīgs. Perfekts gan pilsētas braucieniem, gan garākiem ceļojumiem, šis luksusa sedans piedāvā izcilu veiktspēju, komfortu un stilu.</p>\n  \n  <h2>Galvenās īpašības:</h2>\n  <ul>\n    <li>Dzinējs: 3.0 litru TDI V6, 245 ZS</li>\n    <li>Piedziņa: Quattro (pilnpiedziņa)</li>\n    <li>Transmisija: Automātiskā 7-pakāpju S tronic</li>\n    <li>Nobraukums: 150,000 km</li>\n    <li>Krāsa: Metāliska melna</li>\n    <li>Interjers: Ādas salons, melns</li>\n  </ul>\n  \n  <h2>Tehniskās specifikācijas un aprīkojums:</h2>\n  <ul>\n    <li>Degvielas patēriņš: Vidēji 6.0 l/100 km</li>\n    <li>Maksimālais ātrums: 250 km/h</li>\n    <li>Paātrinājums no 0-100 km/h: 5.9 sekundes</li>\n    <li>Multimediju sistēma: MMI navigācijas sistēma, Bluetooth, Bose skaņas sistēma</li>\n    <li>Komforts: Divu zonu klimata kontrole, elektriski regulējami un apsildāmi sēdekļi, atmiņas funkcija sēdekļiem un stūrei</li>\n    <li>Drošība: ABS, ESP, vairāki gaisa spilveni, distances kontrole, joslu maiņas asistents</li>\n    <li>Papildus: Xenon priekšējie lukturi, LED dienas gaitas lukturi, parkošanās sensori priekšā un aizmugurē, bagažnieka automātiskā atvēršana</li>\n  </ul>\n  \n  <h2>Tehniskais stāvoklis:</h2>\n  <p>Automašīna ir teicamā tehniskā un vizuālā stāvoklī. Visi nepieciešamie apkopes darbi ir veikti regulāri autorizētā servisa centrā. Nesen mainīta eļļa, filtri un bremžu kluči. Automašīnai nav nekādu tehnisku problēmu, gatava lietošanai uzreiz.</p>\n  \n  <h2>Cena:</h2>\n  <p>20,000 EUR</p>\n  \n  <p>Šis Audi A6 ir ideāls risinājums tiem, kas novērtē kvalitāti, komfortu un drošību. Nepalaidiet garām šo lielisko piedāvājumu!</p>', 64, 'Universāls', '24.12.2025', 171, '1HGCM82633A123456', 0),
(2, 'Audi', 'A7', 3, 'https://s4.auto.drom.ru/24180/sales/checked/49554/264751.jpg', 2016, 'Dīzelis', 'Automāts', 90433, 'Pilnpiedziņa', 'Peleka', 23000, '', 10, 'Liftbeks', '0', 223, '2T3BFREV9GW125789', 0),
(3, 'BMW', 'M4', 3, 'https://www.h-r.com/wp-content/uploads/2024/08/BMW-M4-Competition-Coupe-2WD-Typ-G234M-HR-DCS-Gewindefahrwerk-47616-1VS-Front.jpg', 2024, 'Benzīns', 'Automāts', 3553, 'Aizmugurējā piedziņa', 'Sarkana', 95499, '', 6, 'Kupē', '0', 410, 'JHMFA16507S010203', 0),
(4, 'Mercedes', 'Cls63', 6.3, 'https://a.d-cd.net/YYHx0FTFxEnxLiiE5rXnR5tPiXc-1920.jpg', 2014, 'Benzīns', 'Automāts', 45377, 'Pilnpiedziņa', 'Melna', 35200, '', 5, 'Sedans', '0', 378, '5YJSA1E23GF006789', 0),
(5, 'Opel', 'Astra', 2, 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e3/Opel_Astra_J_front_20100725.jpg/800px-Opel_Astra_J_front_20100725.jpg', 2007, 'Dīzelis', 'Manuāla', 315542, 'Priekšējā piedziņa', 'Peleka', 4000, '', 3, 'Hečbeks', '0', 100, 'WBA3A5C57CF123456', 0),
(6, 'WV', 'Passat ', 2, 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c4/VW_Passat_CC_2.0_TDI_DSG_Reflexsilber.JPG/800px-VW_Passat_CC_2.0_TDI_DSG_Reflexsilber.JPG', 2006, 'Dīzelis', 'Automāts', 295404, 'Priekšējā piedziņa', 'Peleka', 3000, '', 1, 'Sedans', '0', 92, '3N1BC1CP3CL123456', 0),
(7, 'Skoda', 'Superb', 2, 'https://3dnews.ru/assets/external/illustrations/2017/02/27/948214/0.jpg', 2019, 'Benzīns', 'Manuāla', 26049, 'Priekšējā piedziņa', 'Melna', 17000, '', 2, 'Sedans', '0', 0, '4T1BF1FK7FU287654', 0),
(8, 'Dodge', 'Chalenger ', 6.7, 'https://www.carpro.com/hs-fs/hubfs/2023-Dodge-Challenger-Shakedown-credit-carpro..jpg?width=1020&name=2023-Dodge-Challenger-Shakedown-credit-carpro..jpg', 2018, 'Benzīns', 'Automāts', 18483, 'Aizmugurējā piedziņa', 'Melna', 24000, '', 6, 'Kupē', '0', 0, '1FTRX12W7XFA12345', 0),
(9, 'BMW', 'M3', 3, 'https://avatars.mds.yandex.net/get-autoru-vos/5267071/8d3af368b316a9a3915992430e8c88bf/1200x900', 2024, 'Benzīns', 'Automāts', 2533, 'Aizmugurējā piedziņa', 'Sarkana', 100000, '', 10, 'Sedans', '0', 0, 'KNAGM4A79E1234567', 0),
(12, 'Mercedes', 'C-300', 2, 'https://avatars.mds.yandex.net/get-autoru-vos/2144388/1802b918bc54dec9b01146901876f898/1200x900', 2015, 'Benzīns', 'Automāts', 167000, 'Pilnpiedziņa', 'Melna', 11500, '', 0, 'Sedans', '0', 150, 'KGHGM4A79E1766567', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Truck`
--

CREATE TABLE `Truck` (
  `Truck_ID` int NOT NULL,
  `Marka` varchar(255) NOT NULL,
  `Modelis` varchar(255) NOT NULL,
  `Dzinejs` float NOT NULL,
  `Foto_URL` varchar(255) NOT NULL,
  `Izladuma_gads` int NOT NULL,
  `Bezina_tips` varchar(255) NOT NULL,
  `Atrumkarba_tips` varchar(255) NOT NULL DEFAULT '1',
  `Nobrakums` int NOT NULL,
  `Piedzina` varchar(255) NOT NULL DEFAULT '1',
  `Krasa` varchar(255) NOT NULL,
  `Cena` float NOT NULL,
  `Apraksts` varchar(255) NOT NULL,
  `Skatijumi` int NOT NULL,
  `Virsbuves_tips` varchar(255) NOT NULL,
  `Tehniska_apskate` varchar(255) NOT NULL,
  `Jauda` int NOT NULL,
  `Vin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Truck`
--

INSERT INTO `Truck` (`Truck_ID`, `Marka`, `Modelis`, `Dzinejs`, `Foto_URL`, `Izladuma_gads`, `Bezina_tips`, `Atrumkarba_tips`, `Nobrakums`, `Piedzina`, `Krasa`, `Cena`, `Apraksts`, `Skatijumi`, `Virsbuves_tips`, `Tehniska_apskate`, `Jauda`, `Vin`) VALUES
(1, 'Madrog', 'Smb', 5, 'https://tdc.ua/image/catalog/vbmp/Road%20repir/madrog_sdm_webp1.webp', 2024, 'Benzīns', 'Automāts', 2543, 'Pilnpiedziņa', 'Oraņža', 40000, '', 6, '', '24.06.2026', 250, '46H3HGU6G3GHDF8D7F6');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Cars`
--
ALTER TABLE `Cars`
  ADD PRIMARY KEY (`Cars_ID`);

--
-- Индексы таблицы `Truck`
--
ALTER TABLE `Truck`
  ADD PRIMARY KEY (`Truck_ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Cars`
--
ALTER TABLE `Cars`
  MODIFY `Cars_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `Truck`
--
ALTER TABLE `Truck`
  MODIFY `Truck_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
