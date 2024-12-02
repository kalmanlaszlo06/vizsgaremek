-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Nov 11. 11:50
-- Kiszolgáló verziója: 10.4.6-MariaDB
-- PHP verzió: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `kl_registration`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ertekelesek`
--

CREATE TABLE `ertekelesek` (
  `eid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `konyvid` int(11) NOT NULL,
  `ertekeles` int(11) NOT NULL,
  `eszoveg` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `edatum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoriak`
--

CREATE TABLE `kategoriak` (
  `kid` int(11) NOT NULL,
  `knev` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `konyvek`
--

CREATE TABLE `konyvek` (
  `konyvid` int(11) NOT NULL,
  `kcim` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `mdatum` date NOT NULL,
  `mufaj` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `statusz` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `leiras` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `login`
--

CREATE TABLE `login` (
  `logid` int(255) NOT NULL,
  `logdate` datetime NOT NULL,
  `logip` varchar(48) COLLATE utf8_hungarian_ci NOT NULL,
  `logsession` varchar(8) COLLATE utf8_hungarian_ci NOT NULL,
  `luid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `login`
--

INSERT INTO `login` (`logid`, `logdate`, `logip`, `logsession`, `luid`) VALUES
(1, '0000-00-00 00:00:00', '', '', 0),
(2, '2024-10-21 12:23:18', '::1', 'beq9t3ek', 12),
(3, '2024-10-21 12:24:08', '::1', 'beq9t3ek', 17),
(4, '2024-10-21 12:58:49', '::1', 'beq9t3ek', 17),
(5, '2024-10-24 10:31:32', '::1', 'pl2r83pi', 12),
(6, '2024-10-24 10:32:59', '::1', 'pl2r83pi', 12),
(7, '2024-10-24 10:33:21', '::1', 'pl2r83pi', 12),
(8, '2024-10-24 10:35:16', '::1', 'pl2r83pi', 12),
(9, '2024-10-24 10:55:38', '::1', 'pl2r83pi', 12),
(10, '2024-10-24 10:57:42', '::1', 'pl2r83pi', 12),
(11, '2024-10-24 10:57:49', '::1', 'pl2r83pi', 12),
(12, '2024-10-24 11:01:38', '::1', 'pl2r83pi', 12),
(13, '2024-10-24 11:02:13', '::1', 'pl2r83pi', 12),
(14, '2024-10-24 11:02:52', '::1', 'pl2r83pi', 12),
(15, '2024-10-24 11:04:22', '::1', 'pl2r83pi', 12),
(16, '2024-10-24 11:11:58', '::1', 'pl2r83pi', 12),
(17, '2024-10-24 11:17:45', '::1', 'pl2r83pi', 12),
(18, '2024-10-24 11:18:02', '::1', 'pl2r83pi', 12),
(19, '2024-10-24 11:23:33', '::1', 'pl2r83pi', 0),
(20, '2024-10-24 11:23:41', '::1', 'pl2r83pi', 0),
(21, '2024-10-24 11:24:09', '::1', 'pl2r83pi', 12),
(22, '2024-10-24 11:25:31', '::1', 'pl2r83pi', 0),
(23, '2024-10-24 11:30:02', '::1', 'pl2r83pi', 12),
(24, '2024-10-24 11:31:35', '::1', 'pl2r83pi', 0),
(25, '2024-10-24 11:34:43', '::1', 'pl2r83pi', 12),
(26, '2024-11-04 11:51:54', '::1', '1uujvuv9', 12),
(27, '2024-11-04 12:28:41', '::1', '1uujvuv9', 12),
(28, '2024-11-04 12:41:17', '::1', '1uujvuv9', 12),
(29, '2024-11-04 12:43:00', '::1', '1uujvuv9', 0),
(30, '2024-11-04 12:43:11', '::1', '1uujvuv9', 0),
(31, '2024-11-04 12:43:24', '::1', '1uujvuv9', 0),
(32, '2024-11-04 12:43:49', '::1', '1uujvuv9', 0),
(33, '2024-11-04 12:43:55', '::1', '1uujvuv9', 12),
(34, '2024-11-04 12:47:09', '::1', '1uujvuv9', 12),
(35, '2024-11-04 12:58:10', '::1', '1uujvuv9', 12),
(36, '2024-11-04 13:04:13', '::1', '1uujvuv9', 12),
(37, '2024-11-04 13:07:56', '::1', '1uujvuv9', 0),
(38, '2024-11-04 13:08:14', '::1', '1uujvuv9', 0),
(39, '2024-11-04 13:09:10', '::1', '1uujvuv9', 0),
(40, '2024-11-04 13:09:47', '::1', '1uujvuv9', 0),
(41, '2024-11-04 13:10:06', '::1', '1uujvuv9', 0),
(42, '2024-11-04 13:10:48', '::1', '1uujvuv9', 0),
(43, '2024-11-04 13:12:12', '::1', '1uujvuv9', 0),
(44, '2024-11-04 13:12:39', '::1', '1uujvuv9', 19),
(45, '2024-11-04 13:33:57', '::1', '1uujvuv9', 19),
(46, '2024-11-04 13:35:26', '::1', '1uujvuv9', 0),
(47, '2024-11-04 13:35:34', '::1', '1uujvuv9', 19),
(48, '2024-11-04 13:55:35', '::1', '1uujvuv9', 19),
(49, '2024-11-04 14:24:04', '::1', '1uujvuv9', 0),
(50, '2024-11-04 14:24:11', '::1', '1uujvuv9', 19),
(51, '2024-11-04 14:30:05', '::1', '1uujvuv9', 19);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `naplo`
--

CREATE TABLE `naplo` (
  `nid` int(255) NOT NULL,
  `ndate` datetime NOT NULL,
  `nip` varchar(48) COLLATE utf8_hungarian_ci NOT NULL,
  `nsession` varchar(8) COLLATE utf8_hungarian_ci NOT NULL,
  `nuid` int(255) NOT NULL,
  `nurl` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `naplo`
--

INSERT INTO `naplo` (`nid`, `ndate`, `nip`, `nsession`, `nuid`, `nurl`) VALUES
(1, '0000-00-00 00:00:00', '', '', 0, ''),
(2, '2024-10-21 12:11:39', '::1', 'beq9t3ek', 12, '/klaci/20240923/?p=adatlapom'),
(3, '2024-10-21 12:11:41', '::1', 'beq9t3ek', 12, '/klaci/20240923/?p=adatlapom'),
(4, '2024-10-21 12:12:03', '::1', 'beq9t3ek', 0, '/klaci/20240923/'),
(5, '2024-10-21 12:12:28', '::1', 'beq9t3ek', 0, '/klaci/20240923/?p=login'),
(6, '2024-10-21 12:12:34', '::1', 'beq9t3ek', 0, '/klaci/20240923/?p=login'),
(7, '2024-10-21 12:12:44', '::1', 'beq9t3ek', 0, '/klaci/20240923/?p=login'),
(8, '2024-10-21 12:13:01', '::1', 'beq9t3ek', 0, '/klaci/20240923/'),
(9, '2024-10-21 12:13:20', '::1', 'beq9t3ek', 0, '/klaci/20240923/?p=login'),
(10, '2024-10-21 12:13:25', '::1', 'beq9t3ek', 12, '/klaci/20240923/'),
(11, '2024-10-21 12:13:29', '::1', 'beq9t3ek', 12, '/klaci/20240923/?p=login'),
(12, '2024-10-21 12:13:30', '::1', 'beq9t3ek', 12, '/klaci/20240923/'),
(13, '2024-10-21 12:13:32', '::1', 'beq9t3ek', 0, '/klaci/20240923/'),
(14, '2024-10-21 12:13:33', '::1', 'beq9t3ek', 0, '/klaci/20240923/?p=login'),
(15, '2024-10-21 12:13:37', '::1', 'beq9t3ek', 12, '/klaci/20240923/'),
(16, '2024-10-21 12:14:08', '::1', 'beq9t3ek', 0, '/klaci/20240923/'),
(17, '2024-10-21 12:14:09', '::1', 'beq9t3ek', 0, '/klaci/20240923/?p=login'),
(18, '2024-10-21 12:14:35', '::1', 'beq9t3ek', 0, '/klaci/20240923/?p=login'),
(19, '2024-10-21 12:14:39', '::1', 'beq9t3ek', 12, '/klaci/20240923/'),
(20, '2024-10-21 12:14:42', '::1', 'beq9t3ek', 12, '/klaci/20240923/?p=adatlapom'),
(21, '2024-10-21 12:22:39', '::1', 'beq9t3ek', 0, '/klaci/20240923/'),
(22, '2024-10-21 12:22:41', '::1', 'beq9t3ek', 0, '/klaci/20240923/?p=login'),
(23, '2024-10-21 12:23:02', '::1', 'beq9t3ek', 0, '/klaci/20240923/?p=login'),
(24, '2024-10-21 12:23:14', '::1', 'beq9t3ek', 0, '/klaci/20240923/?p=login'),
(25, '2024-10-21 12:23:14', '::1', 'beq9t3ek', 0, '/klaci/20240923/?p=login'),
(26, '2024-10-21 12:23:18', '::1', 'beq9t3ek', 12, '/klaci/20240923/'),
(27, '2024-10-21 12:23:38', '::1', 'beq9t3ek', 0, '/klaci/20240923/'),
(28, '2024-10-21 12:23:39', '::1', 'beq9t3ek', 0, '/klaci/20240923/?p=login'),
(29, '2024-10-21 12:24:03', '::1', 'beq9t3ek', 0, '/klaci/20240923/?p=login'),
(30, '2024-10-21 12:24:08', '::1', 'beq9t3ek', 17, '/klaci/20240923/'),
(31, '2024-10-21 12:57:55', '::1', 'beq9t3ek', 17, '/klaci/20240923/?p=adatlapom'),
(32, '2024-10-21 12:58:17', '::1', 'beq9t3ek', 17, '/klaci/20240923/?p=adatlapom'),
(33, '2024-10-21 12:58:18', '::1', 'beq9t3ek', 17, '/klaci/20240923/?p=adatlapom'),
(34, '2024-10-21 12:58:42', '::1', 'beq9t3ek', 0, '/klaci/20240923/'),
(35, '2024-10-21 12:58:43', '::1', 'beq9t3ek', 0, '/klaci/20240923/?p=login'),
(36, '2024-10-21 12:58:49', '::1', 'beq9t3ek', 17, '/klaci/20240923/'),
(37, '2024-10-24 10:25:24', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(38, '2024-10-24 10:25:31', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(39, '2024-10-24 10:29:42', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(40, '2024-10-24 10:29:53', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(41, '2024-10-24 10:29:54', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(42, '2024-10-24 10:29:55', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(43, '2024-10-24 10:29:55', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(44, '2024-10-24 10:29:58', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(45, '2024-10-24 10:30:02', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(46, '2024-10-24 10:31:13', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(47, '2024-10-24 10:31:14', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(48, '2024-10-24 10:31:22', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(49, '2024-10-24 10:31:26', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(50, '2024-10-24 10:31:32', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(51, '2024-10-24 10:31:35', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(52, '2024-10-24 10:32:55', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(53, '2024-10-24 10:32:59', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(54, '2024-10-24 10:33:21', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(55, '2024-10-24 10:33:52', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(56, '2024-10-24 10:33:52', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(57, '2024-10-24 10:34:00', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=belsolap'),
(58, '2024-10-24 10:35:13', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(59, '2024-10-24 10:35:16', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(60, '2024-10-24 10:48:17', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=login'),
(61, '2024-10-24 10:48:32', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(62, '2024-10-24 10:48:36', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(63, '2024-10-24 10:48:36', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=login'),
(64, '2024-10-24 10:48:36', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(65, '2024-10-24 10:48:38', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(66, '2024-10-24 10:48:49', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(67, '2024-10-24 10:49:10', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(68, '2024-10-24 10:49:10', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(69, '2024-10-24 10:50:17', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(70, '2024-10-24 10:50:18', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(71, '2024-10-24 10:51:11', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(72, '2024-10-24 10:51:11', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(73, '2024-10-24 10:51:11', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(74, '2024-10-24 10:51:24', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(75, '2024-10-24 10:51:24', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(76, '2024-10-24 10:51:24', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(77, '2024-10-24 10:52:22', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(78, '2024-10-24 10:52:22', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(79, '2024-10-24 10:52:22', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(80, '2024-10-24 10:52:22', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(81, '2024-10-24 10:52:34', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=login'),
(82, '2024-10-24 10:52:41', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=login'),
(83, '2024-10-24 10:52:41', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=login'),
(84, '2024-10-24 10:52:41', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=login'),
(85, '2024-10-24 10:52:42', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=login'),
(86, '2024-10-24 10:52:49', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=login'),
(87, '2024-10-24 10:52:49', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=login'),
(88, '2024-10-24 10:52:49', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=login'),
(89, '2024-10-24 10:52:53', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(90, '2024-10-24 10:53:34', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(91, '2024-10-24 10:53:34', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(92, '2024-10-24 10:53:34', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(93, '2024-10-24 10:53:34', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(94, '2024-10-24 10:53:57', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(95, '2024-10-24 10:53:57', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(96, '2024-10-24 10:53:58', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(97, '2024-10-24 10:54:36', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(98, '2024-10-24 10:54:36', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(99, '2024-10-24 10:54:36', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(100, '2024-10-24 10:55:09', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(101, '2024-10-24 10:55:10', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(102, '2024-10-24 10:55:10', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(103, '2024-10-24 10:55:31', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(104, '2024-10-24 10:55:31', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(105, '2024-10-24 10:55:31', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(106, '2024-10-24 10:55:32', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(107, '2024-10-24 10:55:33', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(108, '2024-10-24 10:55:38', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(109, '2024-10-24 10:55:42', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(110, '2024-10-24 10:57:36', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(111, '2024-10-24 10:57:37', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(112, '2024-10-24 10:57:42', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(113, '2024-10-24 10:57:43', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(114, '2024-10-24 10:57:44', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(115, '2024-10-24 10:57:49', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(116, '2024-10-24 10:57:53', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(117, '2024-10-24 10:57:59', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(118, '2024-10-24 10:58:00', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(119, '2024-10-24 10:59:55', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(120, '2024-10-24 10:59:56', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(121, '2024-10-24 10:59:59', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(122, '2024-10-24 11:01:21', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(123, '2024-10-24 11:01:22', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(124, '2024-10-24 11:01:22', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(125, '2024-10-24 11:01:25', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(126, '2024-10-24 11:01:29', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(127, '2024-10-24 11:01:34', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(128, '2024-10-24 11:01:38', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(129, '2024-10-24 11:02:07', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(130, '2024-10-24 11:02:08', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(131, '2024-10-24 11:02:08', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(132, '2024-10-24 11:02:08', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(133, '2024-10-24 11:02:08', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(134, '2024-10-24 11:02:09', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(135, '2024-10-24 11:02:13', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(136, '2024-10-24 11:02:34', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(137, '2024-10-24 11:02:34', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(138, '2024-10-24 11:02:34', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(139, '2024-10-24 11:02:35', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(140, '2024-10-24 11:02:43', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(141, '2024-10-24 11:02:44', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(142, '2024-10-24 11:02:45', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(143, '2024-10-24 11:02:45', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(144, '2024-10-24 11:02:48', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(145, '2024-10-24 11:02:52', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(146, '2024-10-24 11:02:55', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(147, '2024-10-24 11:03:13', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(148, '2024-10-24 11:03:45', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(149, '2024-10-24 11:04:05', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(150, '2024-10-24 11:04:05', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(151, '2024-10-24 11:04:06', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(152, '2024-10-24 11:04:15', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(153, '2024-10-24 11:04:18', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(154, '2024-10-24 11:04:22', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(155, '2024-10-24 11:04:35', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(156, '2024-10-24 11:04:36', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(157, '2024-10-24 11:08:35', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(158, '2024-10-24 11:08:36', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(159, '2024-10-24 11:08:36', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(160, '2024-10-24 11:08:38', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(161, '2024-10-24 11:08:39', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(162, '2024-10-24 11:08:52', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(163, '2024-10-24 11:08:52', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(164, '2024-10-24 11:08:52', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(165, '2024-10-24 11:10:11', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(166, '2024-10-24 11:10:11', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(167, '2024-10-24 11:11:44', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(168, '2024-10-24 11:11:44', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(169, '2024-10-24 11:11:44', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(170, '2024-10-24 11:11:44', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(171, '2024-10-24 11:11:45', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(172, '2024-10-24 11:11:50', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(173, '2024-10-24 11:11:50', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(174, '2024-10-24 11:11:51', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(175, '2024-10-24 11:11:51', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(176, '2024-10-24 11:11:55', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(177, '2024-10-24 11:11:58', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(178, '2024-10-24 11:12:19', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(179, '2024-10-24 11:12:20', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(180, '2024-10-24 11:12:20', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(181, '2024-10-24 11:14:25', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(182, '2024-10-24 11:14:26', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(183, '2024-10-24 11:14:26', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(184, '2024-10-24 11:14:26', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(185, '2024-10-24 11:14:27', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(186, '2024-10-24 11:14:53', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(187, '2024-10-24 11:14:54', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(188, '2024-10-24 11:14:57', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(189, '2024-10-24 11:14:58', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(190, '2024-10-24 11:15:55', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(191, '2024-10-24 11:15:56', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(192, '2024-10-24 11:17:37', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(193, '2024-10-24 11:17:38', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(194, '2024-10-24 11:17:38', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(195, '2024-10-24 11:17:38', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(196, '2024-10-24 11:17:38', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(197, '2024-10-24 11:17:40', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(198, '2024-10-24 11:17:45', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(199, '2024-10-24 11:17:47', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(200, '2024-10-24 11:17:48', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(201, '2024-10-24 11:17:58', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(202, '2024-10-24 11:18:02', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(203, '2024-10-24 11:20:11', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(204, '2024-10-24 11:20:11', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(205, '2024-10-24 11:20:11', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(206, '2024-10-24 11:20:12', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(207, '2024-10-24 11:20:12', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(208, '2024-10-24 11:20:26', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(209, '2024-10-24 11:20:26', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(210, '2024-10-24 11:20:45', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(211, '2024-10-24 11:20:46', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(212, '2024-10-24 11:20:53', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(213, '2024-10-24 11:22:28', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(214, '2024-10-24 11:22:28', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(215, '2024-10-24 11:22:28', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(216, '2024-10-24 11:22:30', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(217, '2024-10-24 11:23:25', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(218, '2024-10-24 11:23:25', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(219, '2024-10-24 11:23:26', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(220, '2024-10-24 11:23:34', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(221, '2024-10-24 11:23:36', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(222, '2024-10-24 11:23:42', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(223, '2024-10-24 11:24:02', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(224, '2024-10-24 11:24:04', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(225, '2024-10-24 11:24:04', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(226, '2024-10-24 11:24:04', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(227, '2024-10-24 11:24:05', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(228, '2024-10-24 11:24:09', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(229, '2024-10-24 11:24:10', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(230, '2024-10-24 11:24:11', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(231, '2024-10-24 11:24:32', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(232, '2024-10-24 11:25:06', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(233, '2024-10-24 11:25:14', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(234, '2024-10-24 11:25:14', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(235, '2024-10-24 11:25:23', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(236, '2024-10-24 11:25:23', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(237, '2024-10-24 11:25:32', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(238, '2024-10-24 11:25:33', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(239, '2024-10-24 11:26:15', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(240, '2024-10-24 11:26:16', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(241, '2024-10-24 11:26:16', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(242, '2024-10-24 11:26:18', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(243, '2024-10-24 11:26:18', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(244, '2024-10-24 11:26:31', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(245, '2024-10-24 11:26:31', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(246, '2024-10-24 11:26:31', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(247, '2024-10-24 11:26:41', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(248, '2024-10-24 11:26:45', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(249, '2024-10-24 11:26:45', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(250, '2024-10-24 11:28:41', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(251, '2024-10-24 11:28:41', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(252, '2024-10-24 11:28:42', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(253, '2024-10-24 11:29:01', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(254, '2024-10-24 11:29:01', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(255, '2024-10-24 11:29:02', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(256, '2024-10-24 11:29:41', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(257, '2024-10-24 11:29:41', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(258, '2024-10-24 11:29:41', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(259, '2024-10-24 11:29:41', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(260, '2024-10-24 11:29:42', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(261, '2024-10-24 11:29:43', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(262, '2024-10-24 11:29:45', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(263, '2024-10-24 11:30:02', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(264, '2024-10-24 11:30:06', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(265, '2024-10-24 11:30:08', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(266, '2024-10-24 11:31:34', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(267, '2024-10-24 11:31:37', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(268, '2024-10-24 11:31:48', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(269, '2024-10-24 11:31:48', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(270, '2024-10-24 11:31:48', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/'),
(271, '2024-10-24 11:31:49', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(272, '2024-10-24 11:31:50', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(273, '2024-10-24 11:31:50', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(274, '2024-10-24 11:31:50', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(275, '2024-10-24 11:32:56', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(276, '2024-10-24 11:32:56', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(277, '2024-10-24 11:32:56', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(278, '2024-10-24 11:33:27', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(279, '2024-10-24 11:33:27', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(280, '2024-10-24 11:33:27', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(281, '2024-10-24 11:33:31', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(282, '2024-10-24 11:33:58', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(283, '2024-10-24 11:33:58', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(284, '2024-10-24 11:33:58', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(285, '2024-10-24 11:34:30', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(286, '2024-10-24 11:34:30', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(287, '2024-10-24 11:34:30', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(288, '2024-10-24 11:34:30', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(289, '2024-10-24 11:34:34', '::1', 'pl2r83pi', 0, '/klaci/vizsgaremek/?p=login'),
(290, '2024-10-24 11:34:43', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(291, '2024-10-24 11:34:45', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(292, '2024-10-24 11:35:05', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(293, '2024-10-24 11:35:05', '::1', 'pl2r83pi', 12, '/klaci/vizsgaremek/'),
(294, '2024-11-04 11:51:45', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(295, '2024-11-04 11:51:49', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(296, '2024-11-04 11:51:54', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(297, '2024-11-04 11:51:56', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(298, '2024-11-04 11:52:14', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(299, '2024-11-04 11:52:22', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(300, '2024-11-04 11:57:08', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(301, '2024-11-04 11:57:22', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(302, '2024-11-04 11:57:27', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(303, '2024-11-04 11:57:35', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(304, '2024-11-04 11:57:43', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(305, '2024-11-04 12:00:02', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(306, '2024-11-04 12:00:14', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(307, '2024-11-04 12:02:20', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(308, '2024-11-04 12:02:34', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(309, '2024-11-04 12:04:26', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(310, '2024-11-04 12:04:27', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(311, '2024-11-04 12:04:31', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(312, '2024-11-04 12:04:32', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(313, '2024-11-04 12:04:32', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(314, '2024-11-04 12:05:40', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(315, '2024-11-04 12:05:45', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(316, '2024-11-04 12:05:48', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(317, '2024-11-04 12:06:21', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(318, '2024-11-04 12:06:23', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(319, '2024-11-04 12:06:24', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(320, '2024-11-04 12:06:57', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(321, '2024-11-04 12:06:58', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(322, '2024-11-04 12:06:58', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(323, '2024-11-04 12:07:11', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(324, '2024-11-04 12:07:12', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(325, '2024-11-04 12:07:39', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(326, '2024-11-04 12:08:33', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(327, '2024-11-04 12:08:51', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(328, '2024-11-04 12:08:52', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=login'),
(329, '2024-11-04 12:08:53', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(330, '2024-11-04 12:08:53', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=login'),
(331, '2024-11-04 12:08:54', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(332, '2024-11-04 12:08:55', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=login'),
(333, '2024-11-04 12:08:55', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(334, '2024-11-04 12:09:01', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(335, '2024-11-04 12:09:07', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(336, '2024-11-04 12:09:19', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(337, '2024-11-04 12:10:13', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(338, '2024-11-04 12:11:36', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(339, '2024-11-04 12:17:01', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(340, '2024-11-04 12:17:02', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(341, '2024-11-04 12:17:02', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(342, '2024-11-04 12:19:18', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(343, '2024-11-04 12:21:35', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(344, '2024-11-04 12:24:20', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(345, '2024-11-04 12:25:34', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(346, '2024-11-04 12:25:34', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(347, '2024-11-04 12:25:36', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(348, '2024-11-04 12:25:40', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(349, '2024-11-04 12:25:44', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(350, '2024-11-04 12:25:50', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=login'),
(351, '2024-11-04 12:25:51', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(352, '2024-11-04 12:25:51', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=login'),
(353, '2024-11-04 12:25:51', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(354, '2024-11-04 12:25:51', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=login'),
(355, '2024-11-04 12:25:53', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(356, '2024-11-04 12:25:55', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=login'),
(357, '2024-11-04 12:26:22', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(358, '2024-11-04 12:26:26', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(359, '2024-11-04 12:26:32', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(360, '2024-11-04 12:26:34', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(361, '2024-11-04 12:26:42', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(362, '2024-11-04 12:26:47', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(363, '2024-11-04 12:26:48', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(364, '2024-11-04 12:27:52', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(365, '2024-11-04 12:27:54', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(366, '2024-11-04 12:27:58', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(367, '2024-11-04 12:28:11', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(368, '2024-11-04 12:28:41', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(369, '2024-11-04 12:28:42', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(370, '2024-11-04 12:28:46', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(371, '2024-11-04 12:40:43', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(372, '2024-11-04 12:41:09', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(373, '2024-11-04 12:41:09', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(374, '2024-11-04 12:41:10', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(375, '2024-11-04 12:41:13', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(376, '2024-11-04 12:41:13', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(377, '2024-11-04 12:41:17', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(378, '2024-11-04 12:41:18', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=login'),
(379, '2024-11-04 12:41:19', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(380, '2024-11-04 12:41:21', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(381, '2024-11-04 12:41:22', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(382, '2024-11-04 12:43:01', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(383, '2024-11-04 12:43:02', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(384, '2024-11-04 12:43:13', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(385, '2024-11-04 12:43:25', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(386, '2024-11-04 12:43:26', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(387, '2024-11-04 12:43:33', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(388, '2024-11-04 12:43:33', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(389, '2024-11-04 12:43:34', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(390, '2024-11-04 12:43:34', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(391, '2024-11-04 12:43:35', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(392, '2024-11-04 12:43:50', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(393, '2024-11-04 12:43:52', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(394, '2024-11-04 12:43:55', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(395, '2024-11-04 12:43:57', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(396, '2024-11-04 12:47:02', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(397, '2024-11-04 12:47:03', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(398, '2024-11-04 12:47:03', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=login'),
(399, '2024-11-04 12:47:04', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(400, '2024-11-04 12:47:05', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(401, '2024-11-04 12:47:09', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(402, '2024-11-04 12:58:03', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(403, '2024-11-04 12:58:04', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(404, '2024-11-04 12:58:10', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(405, '2024-11-04 12:58:12', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(406, '2024-11-04 13:04:06', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(407, '2024-11-04 13:04:06', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(408, '2024-11-04 13:04:06', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=login'),
(409, '2024-11-04 13:04:08', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(410, '2024-11-04 13:04:09', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(411, '2024-11-04 13:04:13', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(412, '2024-11-04 13:04:15', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(413, '2024-11-04 13:04:28', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(414, '2024-11-04 13:04:32', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(415, '2024-11-04 13:07:40', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(416, '2024-11-04 13:07:45', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(417, '2024-11-04 13:07:49', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=adatlapom'),
(418, '2024-11-04 13:07:49', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/'),
(419, '2024-11-04 13:07:50', '::1', '1uujvuv9', 12, '/klaci/vizsgaremek/?p=login'),
(420, '2024-11-04 13:07:51', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(421, '2024-11-04 13:07:51', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(422, '2024-11-04 13:07:57', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(423, '2024-11-04 13:08:08', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(424, '2024-11-04 13:08:15', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(425, '2024-11-04 13:08:16', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(426, '2024-11-04 13:09:06', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(427, '2024-11-04 13:09:11', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(428, '2024-11-04 13:09:12', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(429, '2024-11-04 13:09:44', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(430, '2024-11-04 13:09:48', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(431, '2024-11-04 13:10:01', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(432, '2024-11-04 13:10:02', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(433, '2024-11-04 13:10:07', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(434, '2024-11-04 13:10:19', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(435, '2024-11-04 13:10:42', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(436, '2024-11-04 13:10:44', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(437, '2024-11-04 13:10:49', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(438, '2024-11-04 13:12:09', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(439, '2024-11-04 13:12:09', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(440, '2024-11-04 13:12:09', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(441, '2024-11-04 13:12:13', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(442, '2024-11-04 13:12:35', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(443, '2024-11-04 13:12:36', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(444, '2024-11-04 13:12:39', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/'),
(445, '2024-11-04 13:12:56', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/?p=adatlapom'),
(446, '2024-11-04 13:19:13', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/?p=adatlapom'),
(447, '2024-11-04 13:19:13', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/'),
(448, '2024-11-04 13:19:13', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/?p=login'),
(449, '2024-11-04 13:19:15', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/?p=adatlapom'),
(450, '2024-11-04 13:33:36', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/?p=login'),
(451, '2024-11-04 13:33:46', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/?p=login'),
(452, '2024-11-04 13:33:47', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/?p=adatlapom'),
(453, '2024-11-04 13:33:48', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/?p=login'),
(454, '2024-11-04 13:33:50', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(455, '2024-11-04 13:33:50', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(456, '2024-11-04 13:33:57', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/'),
(457, '2024-11-04 13:35:10', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(458, '2024-11-04 13:35:10', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(459, '2024-11-04 13:35:27', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(460, '2024-11-04 13:35:28', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(461, '2024-11-04 13:35:34', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/'),
(462, '2024-11-04 13:55:29', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/'),
(463, '2024-11-04 13:55:31', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(464, '2024-11-04 13:55:32', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(465, '2024-11-04 13:55:35', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/'),
(466, '2024-11-04 13:55:38', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/?p=adatlapom'),
(467, '2024-11-04 13:56:52', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/?p=adatlapom'),
(468, '2024-11-04 13:56:55', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/'),
(469, '2024-11-04 14:23:54', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(470, '2024-11-04 14:23:55', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(471, '2024-11-04 14:24:05', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(472, '2024-11-04 14:24:07', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(473, '2024-11-04 14:24:11', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/'),
(474, '2024-11-04 14:24:20', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/?p=adatlapom'),
(475, '2024-11-04 14:24:25', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/'),
(476, '2024-11-04 14:29:52', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/'),
(477, '2024-11-04 14:29:54', '::1', '1uujvuv9', 0, '/klaci/vizsgaremek/?p=login'),
(478, '2024-11-04 14:30:05', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/'),
(479, '2024-11-04 14:30:08', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/?p=adatlapom'),
(480, '2024-11-04 14:31:20', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/?p=adatlapom'),
(481, '2024-11-04 14:53:34', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/'),
(482, '2024-11-04 14:53:36', '::1', '1uujvuv9', 19, '/klaci/vizsgaremek/?p=adatlapom'),
(483, '2024-11-07 10:16:02', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/'),
(484, '2024-11-07 10:16:53', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/'),
(485, '2024-11-07 10:17:10', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/'),
(486, '2024-11-07 10:17:46', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/'),
(487, '2024-11-07 10:17:58', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/'),
(488, '2024-11-07 10:18:51', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=userek'),
(489, '2024-11-07 10:20:22', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=userek'),
(490, '2024-11-07 10:20:35', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=userek'),
(491, '2024-11-07 10:20:36', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=userek'),
(492, '2024-11-07 10:20:37', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=userek'),
(493, '2024-11-07 10:24:21', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/'),
(494, '2024-11-07 10:24:22', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=userek'),
(495, '2024-11-07 10:24:24', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=ertekelesek'),
(496, '2024-11-07 10:24:31', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=ertekelesek'),
(497, '2024-11-07 10:25:30', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=userek'),
(498, '2024-11-07 10:25:43', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=userek'),
(499, '2024-11-07 10:27:30', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=ertekelesek'),
(500, '2024-11-07 10:29:07', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/'),
(501, '2024-11-07 10:29:10', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=userek'),
(502, '2024-11-07 10:29:14', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=ertekelesek'),
(503, '2024-11-07 10:35:06', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/'),
(504, '2024-11-07 10:35:07', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=userek'),
(505, '2024-11-07 10:35:09', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=kerdesek'),
(506, '2024-11-07 10:35:11', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=ertekelesek'),
(507, '2024-11-07 10:35:13', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/'),
(508, '2024-11-07 10:35:15', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=kerdesek'),
(509, '2024-11-07 10:55:47', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=userek'),
(510, '2024-11-07 10:55:59', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=userek'),
(511, '2024-11-07 10:55:59', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=userek'),
(512, '2024-11-07 10:56:01', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=userek'),
(513, '2024-11-07 10:56:06', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=userek'),
(514, '2024-11-07 10:58:00', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/'),
(515, '2024-11-07 10:58:05', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=kerdesek'),
(516, '2024-11-07 10:58:07', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=kerdesek'),
(517, '2024-11-07 10:58:10', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=kerdesek'),
(518, '2024-11-07 10:58:12', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=ertekelesek'),
(519, '2024-11-07 11:09:34', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/'),
(520, '2024-11-07 11:11:44', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/'),
(521, '2024-11-07 11:11:46', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=kerdesek'),
(522, '2024-11-07 11:13:06', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/'),
(523, '2024-11-07 11:13:11', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=ertekelesek'),
(524, '2024-11-07 11:13:14', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=ertekelesek'),
(525, '2024-11-07 11:20:14', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/'),
(526, '2024-11-07 11:20:16', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=kerdesek'),
(527, '2024-11-07 11:20:17', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/?p=ertekelesek'),
(528, '2024-11-07 11:20:20', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/'),
(529, '2024-11-07 11:30:16', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/'),
(530, '2024-11-07 11:33:59', '::1', '4afvigk9', 0, '/klaci/vizsgaremek/');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user`
--

CREATE TABLE `user` (
  `uid` int(255) NOT NULL,
  `username` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `uemail` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_hungarian_ci NOT NULL,
  `uszuldatum` date NOT NULL,
  `uprofkepnev` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `uprofkepnev_eredetinev` varchar(250) COLLATE utf8_hungarian_ci NOT NULL,
  `udatum` datetime NOT NULL,
  `uip` varchar(48) COLLATE utf8_hungarian_ci NOT NULL,
  `usession` varchar(8) COLLATE utf8_hungarian_ci NOT NULL,
  `ustatusz` varchar(2) COLLATE utf8_hungarian_ci NOT NULL,
  `ukomment` text COLLATE utf8_hungarian_ci NOT NULL,
  `ufirstname` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `ulastname` varchar(255) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `user`
--

INSERT INTO `user` (`uid`, `username`, `uemail`, `password`, `uszuldatum`, `uprofkepnev`, `uprofkepnev_eredetinev`, `udatum`, `uip`, `usession`, `ustatusz`, `ukomment`, `ufirstname`, `ulastname`) VALUES
(12, 'asdasds', 'asd@asd.com', 'b23cf2d0fb74b0ffa0cf4c70e6e04926', '2000-02-10', '12_241024113458_7hsfu8xp3t.png', 'randomkep.png', '2024-10-14 11:51:01', '', '', '', '', 'asdasdasdasdasdasdasd', 'asd'),
(14, 'asdasdsadas', 'asd@asd.com', '7815696ecbf1c96e6894b779456d330e', '2020-02-21', '14_241014143939_hdhcabvjb0.png', 'randomkep.png', '2024-10-14 14:37:17', '', '', '', '', 'asdas', 'asdasd'),
(15, 'asdasd12', 'asd@asd.com', 'bbba0cdac12dbd5917cc24cc90d4b23a', '0000-00-00', '15_241014144650_bkzj371vzd.png', 'randomkep.png', '2024-10-14 14:41:27', '', '', '', '', 'asd', 'asdasdas'),
(16, 'asd', 'asd@asd.com', 'b23cf2d0fb74b0ffa0cf4c70e6e04926', '2002-12-12', '', '', '2024-10-21 11:54:09', '', '', '', '', 'asdasd', 'asdasdasd'),
(17, 'asdasd12', 'asd@asd.com', '52b0c5448cacc00a8df06267afeffd0d', '2111-12-12', '', '', '2024-10-21 12:23:59', '', '', '', '', 'asdasd', 'asdasdasd'),
(18, 'aaa', 'asd@asd.com', 'aaa1', '2024-11-07', '', '', '2024-11-04 12:42:43', '', '', '', '', 'asd', 'asdasdas'),
(19, 'asdadsdsdsdsdsdsdsdsdsdd', 'asd@asd.com', 'aaa123', '1999-10-22', '19_241104143109_9is383lq2x.jpg', 'alapprofilkep.jfif', '2024-11-04 13:09:01', '', '', '', '', 'sdsdsd', 'asdasd'),
(20, 'lacika1234567', 'asd@asd.com', 'aaa123', '2024-11-30', '', '', '2024-11-04 13:10:37', '', '', '', '', 'asdasd', 'asdasdas');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `ertekelesek`
--
ALTER TABLE `ertekelesek`
  ADD PRIMARY KEY (`eid`);

--
-- A tábla indexei `kategoriak`
--
ALTER TABLE `kategoriak`
  ADD PRIMARY KEY (`kid`);

--
-- A tábla indexei `konyvek`
--
ALTER TABLE `konyvek`
  ADD PRIMARY KEY (`konyvid`);

--
-- A tábla indexei `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`logid`);

--
-- A tábla indexei `naplo`
--
ALTER TABLE `naplo`
  ADD PRIMARY KEY (`nid`);

--
-- A tábla indexei `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `ertekelesek`
--
ALTER TABLE `ertekelesek`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `kategoriak`
--
ALTER TABLE `kategoriak`
  MODIFY `kid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `konyvek`
--
ALTER TABLE `konyvek`
  MODIFY `konyvid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `login`
--
ALTER TABLE `login`
  MODIFY `logid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT a táblához `naplo`
--
ALTER TABLE `naplo`
  MODIFY `nid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=531;

--
-- AUTO_INCREMENT a táblához `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
