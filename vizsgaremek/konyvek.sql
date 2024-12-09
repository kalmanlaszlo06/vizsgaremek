-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Dec 09. 13:20
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
-- Tábla szerkezet ehhez a táblához `konyvek`
--

CREATE TABLE `konyvek` (
  `konyvid` int(11) NOT NULL,
  `kcim` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `alcim` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `borito` varchar(255) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `iro` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `kiado` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `kdatum` varchar(11) COLLATE utf8_hungarian_ci NOT NULL,
  `mufaj` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `statusz` varchar(2) COLLATE utf8_hungarian_ci NOT NULL,
  `leiras` text COLLATE utf8_hungarian_ci NOT NULL,
  `oldal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `konyvek`
--

INSERT INTO `konyvek` (`konyvid`, `kcim`, `alcim`, `borito`, `iro`, `kiado`, `kdatum`, `mufaj`, `statusz`, `leiras`, `oldal`) VALUES
(1, 'Research in action', 'Theories and practices for innovation and social change', 'http://books.google.com/books/content?id=Gs_7EAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'Conny Almekinders, Leni Beukema, Coyan Tromp', 'BRILL', '2023-09-04', 'Social Science', 'a', 'Research in action engages the researcher who wants to live up to the challenges of contemporary science and to contribute to innovation and social change. This ambition to contribute to change raises many questions. How to define the main target group of the research? What role does this group play in the research? Which methods of data collection are most appropriate? Who are the commissioners of the research and do their interests match with those of the prime target group? How to deal with power relations in research situations? What do these issues mean for the relation of researcher with the people in the researched situation? And, last but not least, what does it all imply for the researcher him- or herself? These questions have to be dealt with in situations in which the design and organization of the research is still open but also in situations where these have already been preformatted through the research proposal or earlier developments. In any case, they have to be framed in the theoretical considerations of what is science. This book aims to assist scholars and practitioners who would want to deal with this kind of research and questions. The book does not offer recipes, nor fixed scenarios. It presents a series of practical research cases and theoretical insights by experienced researchers who themselves struggled with what is probably the most meaningful questions of the science today. The practical examples of research in action are from different disciplines and include themes from health care, policy research, agricultural technology and education, in Northern and Southern context. Four leading themes of research in action are introduced in the first chapter. In the last chapter the editors return to the dilemmas research in action and try to clarify the options and responses that are possible in different situations.', 272),
(2, 'Controversies in Affirmative Action', 'nincs', 'http://books.google.com/books/content?id=HEXPEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 'James A. Beckman', 'Bloomsbury Publishing USA', '2014-07-23', 'Social Science', 'a', 'An engaging and eclectic collection of essays from leading scholars on the subject, which looks at affirmative action past and present, analyzes its efficacy, its legacy, and its role in the future of the United States. This comprehensive, three-volume set explores the ways the United States has interpreted affirmative action and probes the effects of the policy from the perspectives of economics, law, philosophy, psychology, sociology, political science, and race relations. Expert contributors tackle a host of knotty issues, ranging from the history of affirmative action to the theories underpinning it. They show how affirmative action has been implemented over the years, discuss its legality and constitutionality, and speculate about its future. Volume one traces the origin and evolution of affirmative action. Volume two discusses modern applications and debates, and volume three delves into such areas as international practices and critical race theory. Standalone essays link cause and effect and past and present as they tackle intriguing—and important—questions. When does \"affirmative action\" become \"reverse discrimination\"? How many decades are too many for a \"temporary\" policy to remain in existence? Does race- or gender-based affirmative action violate the equal protection of law guaranteed by the Fourteenth Amendment? In raising such issues, the work encourages readers to come to their own conclusions about the policy and its future application.', 973);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `konyvek`
--
ALTER TABLE `konyvek`
  ADD PRIMARY KEY (`konyvid`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `konyvek`
--
ALTER TABLE `konyvek`
  MODIFY `konyvid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
