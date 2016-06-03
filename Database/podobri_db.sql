-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Версия на сървъра: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `podobri_db`
--

-- --------------------------------------------------------

--
-- Структура на таблица `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_slug`) VALUES
(1, 'Корупция', 'Korupciq'),
(2, 'Финансови измами', 'FinansoviIzmami'),
(3, 'Околна среда', 'OkolnaSreda'),
(4, 'Образование', 'Obrazovanie'),
(5, 'Тютюнопушене', 'Tiutiunopushene'),
(6, 'Изгубени домашни любимци', 'IzgubeniDomashniLiubimci'),
(7, 'Инциденти', 'Incidenti'),
(8, 'Насилие', 'Nasilie'),
(9, 'Други', 'Drugi');

-- --------------------------------------------------------

--
-- Структура на таблица `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Схема на данните от таблица `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`) VALUES
(1, 'Банско'),
(2, 'Белица'),
(3, 'Благоевград'),
(4, 'Гоце Делчев'),
(5, 'Добринище'),
(6, 'Кресна'),
(7, 'Мелник'),
(8, 'Петрич'),
(9, 'Разлог'),
(10, 'Сандански'),
(11, 'Симитли'),
(12, 'Хаджидимово'),
(13, 'Якоруда'),
(14, 'Айтос'),
(15, 'Ахтопол'),
(16, 'Бургас'),
(17, 'Долни чифлик'),
(18, 'Каблешково'),
(19, 'Камено'),
(20, 'Карнобат'),
(21, 'Китен'),
(22, 'Малко Търново'),
(23, 'Несебър'),
(24, 'Обзор'),
(25, 'Поморие'),
(26, 'Приморско'),
(27, 'Свети Влас'),
(28, 'Созопол'),
(29, 'Средец'),
(30, 'Сунгурларе'),
(31, 'Царево'),
(32, 'Ахелой'),
(33, 'Аксаково'),
(34, 'Белослав'),
(35, 'Бяла'),
(36, 'Варна'),
(37, 'Вълчидол'),
(38, 'Девня'),
(39, 'Дългопол'),
(40, 'Провадия'),
(41, 'Суворово'),
(42, 'Игнатиево'),
(43, 'Бяла черква'),
(44, 'Велико Търново'),
(45, 'Горна Оряховица'),
(46, 'Дебелец'),
(47, 'Долна Оряховица'),
(48, 'Елена'),
(49, 'Златарица'),
(50, 'Килифарево'),
(51, 'Лясковец'),
(52, 'Павликени'),
(53, 'Полски Тръмбеш'),
(54, 'Свищов'),
(55, 'Стражица'),
(56, 'Сухиндол'),
(57, 'Белоградчик'),
(58, 'Брегово'),
(59, 'Видин'),
(60, 'Грамада'),
(61, 'Димово'),
(62, 'Дунавци'),
(63, 'Кула'),
(64, 'Бяла Слатина'),
(65, 'Враца'),
(66, 'Козлодуй'),
(67, 'Криводол'),
(68, 'Мездра'),
(69, 'Мизия'),
(70, 'Оряхово'),
(71, 'Роман'),
(72, 'Габрово'),
(73, 'Дряново'),
(74, 'Плачковци'),
(75, 'Севлиево'),
(76, 'Трявна'),
(77, 'Балчик'),
(78, 'Генерал Тошево'),
(79, 'Добрич'),
(80, 'Каварна'),
(81, 'Тервел'),
(82, 'Шабла'),
(83, 'Ардино'),
(84, 'Джебел'),
(85, 'Крумовград'),
(86, 'Кърджали'),
(87, 'Момчилград'),
(88, 'Бобов дол'),
(89, 'Бобошево'),
(90, 'Дупница'),
(91, 'Кочериново'),
(92, 'Кюстендил'),
(93, 'Рила'),
(94, 'Сапарева баня'),
(95, 'Априлци'),
(96, 'Летница'),
(97, 'Ловеч'),
(98, 'Луковит'),
(99, 'Тетевен'),
(100, 'Троян'),
(101, 'Угърчин'),
(102, 'Ябланица'),
(103, 'Берковица'),
(104, 'Бойчиновци'),
(105, 'Брусарци'),
(106, 'Вълчедръм'),
(107, 'Вършец'),
(108, 'Лом'),
(109, 'Монтана'),
(110, 'Чипровци'),
(111, 'Батак'),
(112, 'Белово'),
(113, 'Брацигово'),
(114, 'Велинград'),
(115, 'Ветрен'),
(116, 'Костандово'),
(117, 'Пазарджик'),
(118, 'Панагюрище'),
(119, 'Пещера'),
(120, 'Ракитово'),
(121, 'Септември'),
(122, 'Стрелча'),
(123, 'Сърница'),
(124, 'Батановци'),
(125, 'Брезник'),
(126, 'Земен'),
(127, 'Перник'),
(128, 'Радомир'),
(129, 'Трън'),
(130, 'Белене'),
(131, 'Гулянци'),
(132, 'Долна Митрополия'),
(133, 'Долни Дъбник'),
(134, 'Искър'),
(135, 'Кнежа'),
(136, 'Койнаре'),
(137, 'Левски'),
(138, 'Никопол'),
(139, 'Плевен'),
(140, 'Пордим'),
(141, 'Славяново'),
(142, 'Тръстеник'),
(143, 'Червен бряг'),
(144, 'Асеновград'),
(145, 'Баня'),
(146, 'Брезово'),
(147, 'Калофер'),
(148, 'Карлово'),
(149, 'Клисура'),
(150, 'Кричим'),
(151, 'Куклен'),
(152, 'Лъки'),
(153, 'Перущица'),
(154, 'Пловдив'),
(155, 'Първомай'),
(156, 'Раковски'),
(157, 'Садово'),
(158, 'Сопот'),
(159, 'Стамболийски'),
(160, 'Съединение'),
(161, 'Хисаря'),
(162, 'Баня'),
(163, 'Завет'),
(164, 'Исперих'),
(165, 'Кубрат'),
(166, 'Лозница'),
(167, 'Разград'),
(168, 'Цар Калоян'),
(169, 'Борово'),
(170, 'Бяла'),
(171, 'Ветово'),
(172, 'Глоджево'),
(173, 'Две могили'),
(174, 'Мартен'),
(175, 'Русе'),
(176, 'Сеново'),
(177, 'Сливо поле'),
(178, 'Алфатар'),
(179, 'Главиница'),
(180, 'Дулово'),
(181, 'Силистра'),
(182, 'Тутракан'),
(183, 'Кермен'),
(184, 'Котел'),
(185, 'Нова Загора'),
(186, 'Сливен'),
(187, 'Твърдица'),
(188, 'Шивачево'),
(189, 'Девин'),
(190, 'Доспат'),
(191, 'Златоград'),
(192, 'Мадан'),
(193, 'Неделино'),
(194, 'Рудозем'),
(195, 'Смолян'),
(196, 'Чепеларе'),
(197, 'Банкя'),
(198, 'Божурище'),
(199, 'Ботевград'),
(200, 'Бухово'),
(201, 'Българово'),
(202, 'Годеч'),
(203, 'Долна баня'),
(204, 'Драгоман'),
(205, 'Елин Пелин'),
(206, 'Етрополе'),
(207, 'Златица'),
(208, 'Ихтиман'),
(209, 'Копривщица'),
(210, 'Костенец'),
(211, 'Костинброд'),
(212, 'Момин проход'),
(213, 'Нови Искър'),
(214, 'Пирдоп'),
(215, 'Правец'),
(216, 'Самоков'),
(217, 'Своге'),
(218, 'Сливница'),
(219, 'София'),
(220, 'Гурково'),
(221, 'Гълъбово'),
(222, 'Казанлък'),
(223, 'Мъглиж'),
(224, 'Николаево'),
(225, 'Павел баня'),
(226, 'Раднево'),
(227, 'Стара Загора'),
(228, 'Чирпан'),
(229, 'Шипка'),
(230, 'Антоново'),
(231, 'Омуртаг'),
(232, 'Опака'),
(233, 'Попово'),
(234, 'Търговище'),
(235, 'Върбица'),
(236, 'Димитровград'),
(237, 'Ивайловград'),
(238, 'Любимец'),
(239, 'Маджарово'),
(240, 'Меричлери'),
(241, 'Свиленград'),
(242, 'Симеоновград'),
(243, 'Тополовград'),
(244, 'Харманли'),
(245, 'Хасково'),
(246, 'Върбица'),
(247, 'Димитровград'),
(248, 'Ивайловград'),
(249, 'Любимец'),
(250, 'Маджарово'),
(251, 'Меричлери'),
(252, 'Свиленград'),
(253, 'Симеоновград'),
(254, 'Тополовград'),
(255, 'Харманли'),
(256, 'Хасково'),
(257, 'Елхово'),
(258, 'Стралджа'),
(259, 'Ямбол');

-- --------------------------------------------------------

--
-- Структура на таблица `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `problem_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `comment_body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `kryptonit3_counter_page`
--

CREATE TABLE `kryptonit3_counter_page` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `kryptonit3_counter_page_visitor`
--

CREATE TABLE `kryptonit3_counter_page_visitor` (
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `visitor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `kryptonit3_counter_visitor`
--

CREATE TABLE `kryptonit3_counter_visitor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visitor` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `likeable`
--

CREATE TABLE `likeable` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `likeable_id` int(11) NOT NULL,
  `likeable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Схема на данните от таблица `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_11_28_180914_create_users_table', 1),
('2015_11_30_135457_create_problems_table', 2),
('2015_11_30_144157_create_problems_table', 3),
('2015_12_01_190032_create_problems_table', 4),
('2015_12_02_163544_create_problems_table', 5),
('2015_12_02_165750_create_solutions_table', 6),
('2015_12_02_170438_create_solutions_table', 7),
('2015_12_02_183804_create_solutions_table', 8),
('2015_12_02_185802_create_problems_table', 9),
('2015_12_03_163213_create_comments_table', 10),
('2015_12_03_191446_create_comments_table', 11),
('2015_12_05_130826_create_likeable_table', 12),
('2015_12_05_131504_create_problems_table', 12),
('2015_12_05_161142_create_problems_table', 13),
('2015_12_06_131844_create_problems_table', 14),
('2015_12_06_132409_create_reportable_table', 15),
('2015_12_06_133813_create_reportable_table', 16),
('2015_12_08_195716_create_pictures_table', 17),
('2015_12_09_120432_create_problems_table', 18),
('2015_12_09_204135_create_solutions_table', 19),
('2015_12_28_231225_create_maintenance_table', 20),
('2016_01_04_221724_create_users_table', 21),
('2016_01_08_234825_create_password_resets_table', 22),
('2016_01_09_144619_create_password_resets_table', 23),
('2016_01_09_203406_create_categories_table', 24),
('2016_01_09_210558_create_problems_table', 25),
('2016_01_09_212909_create_problems_table', 26),
('2016_01_10_131744_create_problems_table', 27),
('2016_01_10_140810_create_solutions_table', 28),
('2016_01_11_183923_create_users_table', 29),
('2015_06_21_181359_create_kryptonit3_counter_page_table', 30),
('2015_06_21_193003_create_kryptonit3_counter_visitor_table', 30),
('2015_06_21_193059_create_kryptonit3_counter_page_visitor_table', 30),
('2016_03_26_111322_create_videos_table', 31),
('2016_03_26_121042_create_videos_table', 32);

-- --------------------------------------------------------

--
-- Структура на таблица `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `pictures`
--

CREATE TABLE `pictures` (
  `id` int(10) UNSIGNED NOT NULL,
  `problem_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `solution_id` int(11) DEFAULT NULL,
  `picture_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `problems`
--

CREATE TABLE `problems` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `problem_title` text COLLATE utf8_unicode_ci NOT NULL,
  `problem_description` text COLLATE utf8_unicode_ci,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `reportable`
--

CREATE TABLE `reportable` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `reportable_id` int(11) NOT NULL,
  `reportable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `solutions`
--

CREATE TABLE `solutions` (
  `id` int(10) UNSIGNED NOT NULL,
  `problem_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `solution_condition` int(11) NOT NULL,
  `solution_description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `day` int(11) NOT NULL,
  `month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_admin` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `is_owner` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура на таблица `videos`
--

CREATE TABLE `videos` (
  `id` int(10) UNSIGNED NOT NULL,
  `problem_id` int(11) NOT NULL,
  `video_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kryptonit3_counter_page`
--
ALTER TABLE `kryptonit3_counter_page`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kryptonit3_counter_page_page_unique` (`page`);

--
-- Indexes for table `kryptonit3_counter_page_visitor`
--
ALTER TABLE `kryptonit3_counter_page_visitor`
  ADD KEY `kryptonit3_counter_page_visitor_page_id_index` (`page_id`),
  ADD KEY `kryptonit3_counter_page_visitor_visitor_id_index` (`visitor_id`);

--
-- Indexes for table `kryptonit3_counter_visitor`
--
ALTER TABLE `kryptonit3_counter_visitor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kryptonit3_counter_visitor_visitor_unique` (`visitor`);

--
-- Indexes for table `likeable`
--
ALTER TABLE `likeable`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_index` (`user_id`,`likeable_id`,`likeable_type`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reportable`
--
ALTER TABLE `reportable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solutions`
--
ALTER TABLE `solutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kryptonit3_counter_page`
--
ALTER TABLE `kryptonit3_counter_page`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kryptonit3_counter_visitor`
--
ALTER TABLE `kryptonit3_counter_visitor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `likeable`
--
ALTER TABLE `likeable`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reportable`
--
ALTER TABLE `reportable`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `solutions`
--
ALTER TABLE `solutions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `kryptonit3_counter_page_visitor`
--
ALTER TABLE `kryptonit3_counter_page_visitor`
  ADD CONSTRAINT `kryptonit3_counter_page_visitor_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `kryptonit3_counter_page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kryptonit3_counter_page_visitor_visitor_id_foreign` FOREIGN KEY (`visitor_id`) REFERENCES `kryptonit3_counter_visitor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
