-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Lut 2019, 12:13
-- Wersja serwera: 10.1.28-MariaDB
-- Wersja PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `panda_db`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`news_id`, `name`, `description`, `is_active`, `created_at`, `updated_at`, `user_id`) VALUES
(5, 'Wiadomosc test edycja', 'testaasdasddsadadsda', 1, '2019-02-22 16:45:02', '2019-02-22 21:41:44', 14),
(8, 'test', 'test2', 1, '2019-02-22 18:51:00', '2019-02-22 18:51:00', 14),
(12, 'test', 'opis', 1, '2019-02-22 18:58:00', '2019-02-22 18:58:00', 14),
(14, 'test', 'opis', 1, '2019-02-22 18:59:41', '2019-02-22 18:59:41', 14),
(20, 'test', 'opis', 1, '2019-02-22 19:02:26', '2019-02-22 19:02:26', 14),
(21, 'test', 'opis', 1, '2019-02-22 19:02:54', '2019-02-22 19:02:54', 14),
(22, 'test3', 'opis3', 1, '2019-02-22 19:04:10', '2019-02-22 19:04:10', 14),
(23, 'test4', 'opis4', 1, '2019-02-22 19:09:51', '2019-02-22 19:09:51', 14),
(24, 'test5', 'opis5', 1, '2019-02-22 19:10:27', '2019-02-22 19:10:27', 14),
(25, 'addas', 'daasds', 1, '2019-02-22 19:10:48', '2019-02-22 19:10:48', 14),
(26, 'dadsa', 'dsadas', 1, '2019-02-22 19:14:56', '2019-02-22 19:14:56', 14),
(27, 'test', 'testowy', 1, '2019-02-22 19:28:40', '2019-02-22 19:28:40', 14),
(28, 'teest', 'dfdsfdsdf', 1, '2019-02-22 19:29:23', '2019-02-22 19:29:23', 14),
(29, 'dsdas', 'asddsasd', 1, '2019-02-22 19:30:46', '2019-02-22 19:30:46', 14),
(30, 'saddad', 'dsadaasd', 1, '2019-02-22 19:31:35', '2019-02-22 19:31:35', 14),
(31, 'asaddas', 'sadadadas3231333', 1, '2019-02-22 19:32:05', '2019-02-22 19:32:05', 14),
(32, 'test edycja ', 'edycja', 1, '2019-02-22 22:34:22', '2019-02-24 20:16:17', 21),
(33, 'moja wiadomosc', 'similique odio autem tempore. Quaerat be', 1, '2019-02-25 10:29:19', '2019-02-25 10:33:36', 30),
(34, 'test', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore sequi adipisci distinctio doloremque, dignissimos fugiat quod eos saepe sit, facere ipsum? Vero saepe iste quo ipsum perferendis tenetur maxime laborum nobis eos dolorum iusto, alias magnam temporibus deserunt maiores voluptatem, minus consectetur expedita aut. In delectus maiores eos obcaecati. Dolor repellendus voluptatem commodi impedit, ipsum necessitatibus similique odio autem tempore. Quaerat beatae, ullam deserunt a numquam dignissimos recusandae molestias neque vel. Eum non delectus, officia earum, labore quis doloremque tempore praesentium illo aut beatae porro ducimus cupiditate aperiam incidunt neque nulla dicta vero odio. Aut doloremque assumenda alias deserunt vel.', 1, '2019-02-25 10:30:01', '2019-02-25 10:30:01', 21);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `register`
--

CREATE TABLE `register` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` enum('boys','girls') NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `pass` char(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `register`
--

INSERT INTO `register` (`user_id`, `first_name`, `last_name`, `email`, `gender`, `is_active`, `pass`, `created_at`, `updated_at`) VALUES
(1, 'Andrzej', 'Nowak', 'andrzej@nowak.pl', 'boys', 0, '81dc9bdb52d04dc20036dbd8313ed055sdsads9aud0auda0du', '2019-02-22 08:27:45', '2019-02-22 08:27:45'),
(2, 'Anna ', 'Nowak', 'aneczka@nowak.pl', 'girls', 0, '81dc9bdb52d04dc20036dbd8313ed055sdsads9aud0auda0du', '2019-02-22 10:41:47', '2019-02-22 10:41:47'),
(3, 'Anna', 'Nowak', 'anna@nowak.pl', 'girls', 0, '81dc9bdb52d04dc20036dbd8313ed055sdsads9aud0auda0du', '2019-02-22 08:29:35', '2019-02-22 08:29:35'),
(4, 'Anna', 'Kowalska', 'anna@p.pl', 'girls', 0, '098f6bcd4621d373cade4e832627b4f6sdsads9aud0auda0du', '2019-02-21 22:22:43', '2019-02-21 22:22:43'),
(5, '', '', 'dasdsa@g.pl', '', 0, '824adc61faf08c32ef279ee37320c6absdsads9aud0auda0du', '2019-02-21 14:29:10', '2019-02-21 14:29:10'),
(6, 'Jan', 'Kowalczyk', 'jan@kowal.pl', 'boys', 1, 'f83d36fde7b8ee5bc58cb24d0db73238sdsads9aud0auda0du', '2019-02-21 15:03:32', '2019-02-21 15:03:32'),
(7, 'Jan', 'Nowak', 'jan@nowak.pl', 'boys', 0, '81dc9bdb52d04dc20036dbd8313ed055sdsads9aud0auda0du', '2019-02-22 08:43:07', '2019-02-22 08:43:07'),
(8, 'Janina', 'Nowak', 'janina@nowak.pl', 'girls', 0, '81dc9bdb52d04dc20036dbd8313ed055sdsads9aud0auda0du', '2019-02-22 08:34:46', '2019-02-22 08:34:46'),
(9, 'Kuba ', 'Nowak', 'kuba@nowak.pl', 'boys', 0, '81dc9bdb52d04dc20036dbd8313ed055sdsads9aud0auda0du', '2019-02-22 08:39:43', '2019-02-22 08:39:43'),
(10, 'Michal', 'Kaczmarek', 'm@p.pl', 'boys', 0, '1234', '2019-02-20 20:47:13', '2019-02-20 20:47:13'),
(11, 'Maria', 'Kowalski', 'm@p.pldasda', 'girls', 0, '1234', '2019-02-20 21:42:47', '2019-02-20 21:42:47'),
(12, 'Marek', 'Kowalski', 'marek@kowal.pl', 'boys', 0, '81dc9bdb52d04dc20036dbd8313ed055sdsads9aud0auda0du', '2019-02-22 08:26:18', '2019-02-22 08:26:18'),
(13, 'Marek', 'Nowak', 'marek@nowak.pl', 'boys', 0, '81dc9bdb52d04dc20036dbd8313ed055sdsads9aud0auda0du', '2019-02-22 08:21:07', '2019-02-22 08:21:07'),
(14, 'Maria', 'Kowalik', 'marysia@kowal.pl', 'girls', 0, '81dc9bdb52d04dc20036dbd8313ed055sdsads9aud0auda0du', '2019-02-22 10:45:07', '2019-02-22 10:45:07'),
(15, 'MichaÅ‚', 'Kaczmarek', 'mi@p.pl', 'boys', 0, '81dc9bdb52d04dc20036dbd8313ed055sdsads9aud0auda0du', '2019-02-21 13:32:43', '2019-02-21 13:32:43'),
(16, 'Michał', 'Kaczmarek', 'mi@p.plll', 'boys', 0, '81dc9bdb52d04dc20036dbd8313ed055sdsads9aud0auda0du', '2019-02-21 13:35:29', '2019-02-21 13:35:29'),
(17, 'Michał', 'Nowak', 'michal@nowak.pl', 'boys', 0, '81dc9bdb52d04dc20036dbd8313ed055sdsads9aud0auda0du', '2019-02-22 08:33:55', '2019-02-22 08:33:55'),
(18, 'Michał', 'Nowak', 'michalek@nowak.pl', 'boys', 0, '81dc9bdb52d04dc20036dbd8313ed055sdsads9aud0auda0du', '2019-02-22 08:45:57', '2019-02-22 08:45:57'),
(19, 'Michał', 'Kaczmarek', 'michalrugby11@poczta.onet.pl', 'boys', 0, '1234', '2019-02-20 21:05:08', '2019-02-20 21:05:08'),
(20, 'Jan', 'Nowak', 'n@p.pl', 'boys', 0, '1234', '2019-02-20 21:20:21', '2019-02-20 21:20:21'),
(21, 'test', 'test', 'test@test.pl', 'boys', 0, '16d7a4fca7442dda3ad93c9a726597e4sdsads9aud0auda0du', '2019-02-21 13:36:29', '2019-02-21 13:36:29'),
(22, 'Tomasz', 'Nowak', 'tomasz@nowak.pl', 'boys', 0, '81dc9bdb52d04dc20036dbd8313ed055sdsads9aud0auda0du', '2019-02-22 08:37:14', '2019-02-22 08:37:14'),
(23, 'Waldemar', 'Kowal', 'waldek@kowal.pl', 'boys', 0, '81dc9bdb52d04dc20036dbd8313ed055sdsads9aud0auda0du', '2019-02-22 08:43:56', '2019-02-22 08:43:56'),
(24, 'Waldemar', 'Kowalski', 'w@test.pl', 'boys', 0, '81dc9bdb52d04dc20036dbd8313ed055sdsads9aud0auda0du', '2019-02-22 13:03:20', '2019-02-22 13:03:20'),
(25, 's', 's', 'sadads@a.pl', 'boys', 0, '03c7c0ace395d80182db07ae2c30f034sdsads9aud0auda0du', '2019-02-24 17:24:47', '2019-02-24 17:24:47'),
(26, 'e`', 's', 'sadads@a.pl', 'boys', 0, '03c7c0ace395d80182db07ae2c30f034sdsads9aud0auda0du', '2019-02-24 17:25:29', '2019-02-24 17:25:29'),
(27, 's', 's', 'sadads@a.pl', 'boys', 0, '03c7c0ace395d80182db07ae2c30f034sdsads9aud0auda0du', '2019-02-24 17:29:07', '2019-02-24 17:29:07'),
(28, 's', 's', 'sadads@a.pl', 'boys', 0, '03c7c0ace395d80182db07ae2c30f034sdsads9aud0auda0du', '2019-02-24 17:33:44', '2019-02-24 17:33:44'),
(29, 'dfds', 'fdfsdf', 'dsadasd@h.pl', 'boys', 0, 'd9729feb74992cc3482b350163a1a010sdsads9aud0auda0du', '2019-02-24 20:35:51', '2019-02-24 20:35:51'),
(30, 'Michał', 'test', 'michaltest@test.pl', 'boys', 1, '098f6bcd4621d373cade4e832627b4f6sdsads9aud0auda0du', '2019-02-25 10:26:57', '2019-02-25 10:26:57');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `news_user` (`user_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT dla tabeli `register`
--
ALTER TABLE `register`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_user` FOREIGN KEY (`user_id`) REFERENCES `register` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
