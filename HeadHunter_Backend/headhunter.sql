-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Máj 03. 21:23
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `headhunter`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allaskeresos`
--

CREATE TABLE `allaskeresos` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nem` varchar(5) NOT NULL,
  `szul_ido` date NOT NULL,
  `cim` varchar(120) DEFAULT NULL,
  `telefonszam` varchar(12) DEFAULT NULL,
  `fax` varchar(12) DEFAULT NULL,
  `anyanyelv` varchar(20) NOT NULL DEFAULT 'magyar',
  `allampolgarsag` varchar(20) NOT NULL DEFAULT 'magyar',
  `jogositvany` tinyint(1) DEFAULT NULL,
  `szoc_keszseg` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `allaskeresos`
--

INSERT INTO `allaskeresos` (`user_id`, `nem`, `szul_ido`, `cim`, `telefonszam`, `fax`, `anyanyelv`, `allampolgarsag`, `jogositvany`, `szoc_keszseg`, `created_at`, `updated_at`) VALUES
(3, 'nő', '1999-09-09', '1111 Budapest, Kis Pál utca 12/B. 1/1.', '+36301234567', '+361123456', 'magyar', 'magyar', 0, 'jó kommunikációs készség, kiváló munka csapatban és önállóan egyeránt', '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(4, 'férfi', '2002-02-02', '5000 Szolnok, Pacsirta utca 8.', '+36709876543', NULL, 'román', 'magyar', 1, 'úgy gondolom, jó velem együtt dolgozni', '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(7, 'férfi', '1986-10-23', '1112 Budapest, Szép utca 3.', '+36201234567', '1234567', 'magyar', 'magyar', 1, 'Értékesítés', '2024-05-03 17:15:17', '2024-05-03 17:15:34'),
(8, 'nő', '2005-01-01', '9330 Kapuvár Kapu tér20.', '+36203663655', '+1777777', 'magyar', 'magyar', NULL, 'Értékesítés', '2024-05-03 17:19:28', '2024-05-03 17:20:06');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allaskereso_ismerets`
--

CREATE TABLE `allaskereso_ismerets` (
  `allaskereso` bigint(20) UNSIGNED NOT NULL,
  `szakmai_ismeret` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allaskereso_nyelvtudass`
--

CREATE TABLE `allaskereso_nyelvtudass` (
  `allaskereso` bigint(20) UNSIGNED NOT NULL,
  `nyelvtudas` varchar(4) NOT NULL,
  `nyelvvizsga` tinyint(1) NOT NULL DEFAULT 0,
  `iras` varchar(15) DEFAULT NULL,
  `olvasas` varchar(15) DEFAULT NULL,
  `beszed` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `allaskereso_nyelvtudass`
--

INSERT INTO `allaskereso_nyelvtudass` (`allaskereso`, `nyelvtudas`, `nyelvvizsga`, `iras`, `olvasas`, `beszed`) VALUES
(3, 'DEB2', 0, 'középszint', 'középszint', 'alapszint'),
(3, 'ENB2', 1, 'B2', 'B2', 'B2'),
(4, 'DEA2', 0, 'alapszint', 'alapszint', 'középszint'),
(7, 'DEA2', 1, 'haladó', 'anyanyelvi', 'anynalevi'),
(8, 'DEA1', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allaskereso_tanulmanys`
--

CREATE TABLE `allaskereso_tanulmanys` (
  `allaskereso` bigint(20) UNSIGNED NOT NULL,
  `intezmeny` varchar(100) NOT NULL,
  `szak` varchar(50) NOT NULL,
  `vegzettseg` bigint(20) UNSIGNED NOT NULL,
  `kezdes` date NOT NULL,
  `vegzes` date DEFAULT NULL,
  `erintett_targytev` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `allaskereso_tanulmanys`
--

INSERT INTO `allaskereso_tanulmanys` (`allaskereso`, `intezmeny`, `szak`, `vegzettseg`, `kezdes`, `vegzes`, `erintett_targytev`) VALUES
(3, 'Budapesti Műszaki és Gazdaságtudományi Egyetem', 'Mérnökinformatikus', 5, '2019-09-01', '2023-07-01', 'HTML, CSS, Javascript, JQuery, REACT, C#'),
(7, 'Neumann János Szakközép iskola', 'informatika', 2, '1990-10-10', '1998-06-10', 'matek, angol'),
(7, 'Óbudai Egyetem', 'mérnöki informatika', 6, '2010-01-01', '2014-06-20', 'fejlesztés'),
(8, 'Báthoty István Gimnázium', 'Valamilyen szak', 3, '2008-06-01', '2012-06-20', 'irodalom, történelem');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allaskereso_tapasztalats`
--

CREATE TABLE `allaskereso_tapasztalats` (
  `allaskereso` bigint(20) UNSIGNED NOT NULL,
  `cegnev` varchar(40) NOT NULL,
  `ceg_cim` varchar(120) NOT NULL,
  `pozicio` varchar(6) NOT NULL,
  `kezdes` date NOT NULL,
  `vegzes` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `allaskereso_tapasztalats`
--

INSERT INTO `allaskereso_tapasztalats` (`allaskereso`, `cegnev`, `ceg_cim`, `pozicio`, `kezdes`, `vegzes`) VALUES
(3, 'Magyar Telekom Nyrt.', '1097 Budapest, Könyves Kálmán krt. 36.', 'INFFRO', '2023-01-04', '2024-02-01'),
(7, 'MVM Zrt', '1081 Budapest II.JPPT 20.', 'GYTPEN', '2000-10-01', '2005-08-14'),
(8, 'Erbe Zrt', '1081 Budapest II.JPPT 20.', 'GRFUIX', '2001-06-30', '2015-01-10');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allass`
--

CREATE TABLE `allass` (
  `allas_id` bigint(20) UNSIGNED NOT NULL,
  `munkaltato` bigint(20) UNSIGNED NOT NULL,
  `megnevezes` varchar(30) NOT NULL,
  `pozicio` varchar(6) NOT NULL,
  `statusz` varchar(40) NOT NULL,
  `leiras` longtext NOT NULL,
  `fejvadasz` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `allass`
--

INSERT INTO `allass` (`allas_id`, `munkaltato`, `megnevezes`, `pozicio`, `statusz`, `leiras`, `fejvadasz`, `created_at`, `updated_at`) VALUES
(1, 1, 'szoftver fejlesztő', 'INFFRO', 'nyitott', 'Applikáció fejlesztőként feladatod lesz cégünk jelenlegi, React Native nyelven írt iOS, illetve.', 2, '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(2, 1, 'Szoftvermérnök', 'INFSEN', 'nyitott', 'Izgalmas mérnöki munka.', 2, '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(3, 1, 'Adattudós', 'INFDSC', 'nyitott', 'Csatlakozzon adattudományi csapatunkhoz, hogy cutting-edge projekteken dolgozzon. Olyan személyeket keresünk, akik jártasak az adatelemzésben, a gépi tanulásban és az adatvizualizációban. Az R vagy Python programozási nyelvek ismerete előnyös.', 2, '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(4, 1, 'Termékmenedzser', 'GYTPEN', 'nyitott', 'Vezesse a termékfejlesztést és az innovációs kezdeményezéseket. Olyan személyeket keresünk, akik erős vezetői készségekkel rendelkeznek, és tapasztalattal rendelkeznek a termék életciklusának kezelésében. Kiváló kommunikációs és problémamegoldó képességek elengedhetetlenek ennek a szerepnek.', 5, '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(5, 1, 'UX/UI Tervező', 'GRFUIX', 'nyitott', 'Keresünk egy kreatív UX/UI tervezőt, aki javítja a felhasználói élményt. Az ideális jelöltnek erős portfólióval kell rendelkeznie, amely bemutatja tervezői készségeit, valamint tapasztalattal kell rendelkeznie drótvázak és prototípusok készítésében. A felhasználói kutatási módszerek ismerete előny.', 5, '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(6, 1, 'Marketing Szakértő', 'MARMGR', 'nyitott', 'Vezesse a marketingkampányokat és -stratégiákat termékeinkhez. A jelöltnek mélyrehatóan kell ismernie a digitális marketingcsatornákat és az analitikát. A tartalom létrehozásának, az SEO-nak és a közösségi média marketingnek való tapasztalata nagyra értékelhető.', 5, '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(7, 1, 'Frontend Fejlesztő', 'INFFRO', 'nyitott', 'Lehetőség egy frontend fejlesztőnek felhasználói felületek készítésére. Olyan jelölteket keresünk, akik jártasak a frontend technológiákban, mint például az HTML, CSS és JavaScript keretrendszerek, például a React vagy az Angular. A reszponzív tervezés és a böngészőkompatibilitás is fontos.', 2, '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(8, 1, 'Backend Mérnök', 'INFBCK', 'nyitott', 'Csatlakozzon backend mérnöki csapatunkhoz, hogy skálázható rendszereket fejlesszen. Az ideális jelöltnek jártassága kell, hogy legyen backend technológiákban, például a Node.js, Python vagy Java terén. Tapasztalat szükséges adatbázis-kezelési rendszerekben és API fejlesztésben.', 2, '2024-05-03 17:09:34', '2024-05-03 17:09:34');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allas_ismerets`
--

CREATE TABLE `allas_ismerets` (
  `allas` bigint(20) UNSIGNED NOT NULL,
  `szakmai_ismeret` bigint(20) UNSIGNED NOT NULL,
  `elvaras_szint` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allas_jelentkezos`
--

CREATE TABLE `allas_jelentkezos` (
  `allas` bigint(20) UNSIGNED NOT NULL,
  `allaskereso` bigint(20) UNSIGNED NOT NULL,
  `statusz` varchar(12) NOT NULL DEFAULT 'jelentkezett',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `allas_jelentkezos`
--

INSERT INTO `allas_jelentkezos` (`allas`, `allaskereso`, `statusz`, `created_at`, `updated_at`) VALUES
(4, 8, 'jelentkezett', '2024-05-03 17:22:28', '2024-05-03 17:22:28');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allas_nyelvtudass`
--

CREATE TABLE `allas_nyelvtudass` (
  `allas` bigint(20) UNSIGNED NOT NULL,
  `nyelvtudas` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allas_tapasztalats`
--

CREATE TABLE `allas_tapasztalats` (
  `allas` bigint(20) UNSIGNED NOT NULL,
  `pozicio` varchar(6) NOT NULL,
  `tapasztalat_ido` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allas_vegzettsegs`
--

CREATE TABLE `allas_vegzettsegs` (
  `allas` bigint(20) UNSIGNED NOT NULL,
  `vegzettseg` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `allas_vegzettsegs`
--

INSERT INTO `allas_vegzettsegs` (`allas`, `vegzettseg`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `fejvadaszs`
--

CREATE TABLE `fejvadaszs` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `telefonszam` varchar(12) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `fejvadaszs`
--

INSERT INTO `fejvadaszs` (`user_id`, `telefonszam`, `created_at`, `updated_at`) VALUES
(2, '+36201234567', '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(5, '+36201239876', '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(6, '36201234567', NULL, NULL),
(6, '36201234567', NULL, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `fejvadasz_terulets`
--

CREATE TABLE `fejvadasz_terulets` (
  `fejvadasz` bigint(20) UNSIGNED NOT NULL,
  `terulet` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `fejvadasz_terulets`
--

INSERT INTO `fejvadasz_terulets` (`fejvadasz`, `terulet`) VALUES
(2, 1),
(6, 1),
(6, 2);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_03_173918_create_allaskeresos_table', 1),
(6, '2024_02_03_173945_create_fejvadaszs_table', 1),
(7, '2024_02_03_174010_create_munkaltatos_table', 1),
(8, '2024_02_03_174029_create_nyelvtudas_table', 1),
(9, '2024_02_03_174055_create_szakmai_ismerets_table', 1),
(10, '2024_02_03_174119_create_tapasztalat_idos_table', 1),
(11, '2024_02_03_174129_create_terulets_table', 1),
(12, '2024_02_03_174157_create_vegzettsegs_table', 1),
(13, '2024_02_16_164056_create_pozicios_table', 1),
(14, '2024_02_16_170429_create_fejvadasz_terulets_table', 1),
(15, '2024_02_16_173552_create_allas_table', 1),
(16, '2024_03_12_220519_create_allas_ismerets_table', 1),
(17, '2024_03_13_174801_create_allas_vegzettsegs_table', 1),
(18, '2024_03_13_175317_create_allas_nyelvtudas_table', 1),
(19, '2024_03_13_175421_create_allaskereso_ismerets_table', 1),
(20, '2024_03_13_175836_create_allas_tapasztalats_table', 1),
(21, '2024_03_13_181953_create_allaskereso_nyelvtudas_table', 1),
(22, '2024_03_17_144850_create_allaskereso_tapasztalats_table', 1),
(23, '2024_03_17_152651_create_allaskereso_tanulmanys_table', 1),
(24, '2024_04_27_095714_create_allas_jelentkezos_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `munkaltatos`
--

CREATE TABLE `munkaltatos` (
  `munkaltato_id` bigint(20) UNSIGNED NOT NULL,
  `cegnev` varchar(60) NOT NULL,
  `szekhely` varchar(80) NOT NULL,
  `kapcsolattarto` varchar(40) NOT NULL,
  `telefonszam` varchar(30) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `munkaltatos`
--

INSERT INTO `munkaltatos` (`munkaltato_id`, `cegnev`, `szekhely`, `kapcsolattarto`, `telefonszam`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Kreatív Design Stúdió Kft.', 'Budapest, Kreatív út 12.', 'Anna Kovács', '+36301234567', 'info@kreativdesign.hu', '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(2, 'TechnoLogistic Solutions Zrt.', 'Debrecen, Innovációs park 5.', 'Péter Nagy', '+36209876543', 'info@technologisticsolutions.com', '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(3, 'FoodMaster Élelmiszeripari Kft.', 'Szeged, Ízletes út 8.', 'Éva Szabó', '+36705551234', 'eva.szabo@foodmaster.hu', '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(4, 'HealthyLife Egészségközpont', 'Budapest, Egészség tér 1.', 'Dr. Gábor Kis', '+3612345678', 'info@healthylife.hu', '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(5, 'EcoTech Környezetvédelmi Kft.', 'Szombathely, Zöld utca 20.', 'Gizella Varga', '+36709876543', 'info@ecotech.hu', '2024-05-03 17:09:34', '2024-05-03 17:09:34');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `nyelvtudass`
--

CREATE TABLE `nyelvtudass` (
  `nyelvkod` varchar(4) NOT NULL,
  `nyelv` varchar(20) NOT NULL,
  `szint` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `nyelvtudass`
--

INSERT INTO `nyelvtudass` (`nyelvkod`, `nyelv`, `szint`) VALUES
('DEA1', 'Német', 'A1'),
('DEA2', 'Német', 'A2'),
('DEB1', 'Német', 'B1'),
('DEB2', 'Német', 'B2'),
('DEC1', 'Német', 'C1'),
('DEC2', 'Német', 'C2'),
('ENA1', 'Angol', 'A1'),
('ENA2', 'Angol', 'A2'),
('ENB1', 'Angol', 'B1'),
('ENB2', 'Angol', 'B2'),
('ENC1', 'Angol', 'C1'),
('ENC2', 'Angol', 'C2');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `pozicios`
--

CREATE TABLE `pozicios` (
  `pozkod` varchar(6) NOT NULL,
  `terulet` bigint(20) UNSIGNED NOT NULL,
  `pozicio` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `pozicios`
--

INSERT INTO `pozicios` (`pozkod`, `terulet`, `pozicio`) VALUES
('GRFUIX', 4, 'UX/UI tervező'),
('GYTPEN', 5, 'termékmérnök'),
('INFBCK', 1, 'backend fejlesztő'),
('INFDSC', 1, 'adattudós'),
('INFFRO', 1, 'frontend fejlesztő'),
('INFSEN', 1, 'szoftvermérnök'),
('MARMGR', 3, 'marketing manager');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szakmai_ismerets`
--

CREATE TABLE `szakmai_ismerets` (
  `ismeret_id` bigint(20) UNSIGNED NOT NULL,
  `megnevezes` varchar(40) NOT NULL,
  `szint` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `szakmai_ismerets`
--

INSERT INTO `szakmai_ismerets` (`ismeret_id`, `megnevezes`, `szint`) VALUES
(1, 'Webfejlesztés', 'Középhaladó'),
(2, 'Adatbázis tervezés', 'Haladó'),
(3, 'Projektmenedzsment', 'Haladó'),
(4, 'Grafikai tervezés', 'Kezdő'),
(5, 'Mobilalkalmazás fejlesztés', 'Haladó'),
(6, 'Tesztelés', 'Középhaladó'),
(7, 'UI/UX design', 'Haladó'),
(8, 'Hálózati ismeretek', 'Középhaladó'),
(9, 'Operációs rendszerek ismerete', 'Haladó'),
(10, 'Felhasználói felület tervezés', 'Kezdő'),
(11, 'Kommunikáció', 'Kiváló'),
(12, 'Problémamegoldás', 'Haladó'),
(13, 'Időmenedzsment', 'Kiváló'),
(14, 'Csapatmunka', 'Haladó'),
(15, 'Kreativitás', 'Kiváló'),
(16, 'Empátia', 'Haladó'),
(17, 'Rugalmas gondolkodás', 'Kiváló'),
(18, 'Stresszkezelés', 'Haladó'),
(19, 'Érdekérvényesítés', 'Kiváló'),
(20, 'Konfliktuskezelés', 'Haladó');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tapasztalat_idos`
--

CREATE TABLE `tapasztalat_idos` (
  `tapasztalat_id` bigint(20) UNSIGNED NOT NULL,
  `leiras` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `tapasztalat_idos`
--

INSERT INTO `tapasztalat_idos` (`tapasztalat_id`, `leiras`) VALUES
(1, 'pályakezdő (0-1 év)'),
(2, '1-3 év tapasztalat'),
(3, '3-5 év tapasztalat'),
(4, '5+ év tapasztalat');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `terulets`
--

CREATE TABLE `terulets` (
  `terulet_id` bigint(20) UNSIGNED NOT NULL,
  `megnevezes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `terulets`
--

INSERT INTO `terulets` (`terulet_id`, `megnevezes`) VALUES
(1, 'Informatika'),
(2, 'Értékesítés'),
(3, 'Marketing'),
(4, 'Grafikai tervezés'),
(5, 'Gyártás-termelés');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nev` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `jogosultsag` varchar(12) NOT NULL,
  `fenykep` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`user_id`, `nev`, `email`, `email_verified_at`, `password`, `jogosultsag`, `fenykep`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@headhunter.com', NULL, '$2y$12$YqcWVez8os1j2Cj5TOn5gecd2gNtycfzqvzUUjgW6003Iou14SjlC', 'admin', NULL, NULL, '2024-05-03 17:09:32', '2024-05-03 17:09:32'),
(2, 'Minta-Fejvadász András', 'a.minta-fejv@headhunter.com', NULL, '$2y$12$6M/4dkEQZmfFsKfPw1j4gubxvV1naOlGLOUKcnrJU3lGqLsWAwxYq', 'fejvadász', NULL, NULL, '2024-05-03 17:09:33', '2024-05-03 17:09:33'),
(3, 'Példa-Álláskereső Lilla', 'lilla-pallker@gmail.com', NULL, '$2y$12$5nIuV3ccoY8dWeF2WkHY..Anq5BS/Y3WTEstfVcPfH884OePm8UBS', 'álláskereső', NULL, NULL, '2024-05-03 17:09:33', '2024-05-03 17:09:33'),
(4, 'Holameló Béla', 'bela-the-king@freemail.hu', NULL, '$2y$12$lbJ3/5ET7C/GlHnJQ41zCeKLjE0eAB5H6IBawDPKUTPdqr53.wdbq', 'álláskereső', NULL, NULL, '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(5, 'Beoszt Tivadar', 't.beoszt@headhunter.com', NULL, '$2y$12$z6hMv7xrtSn47ZpvEqjP/eb8bFZSTltvrAmcTXx7If2.N/FzIGUba', 'fejvadász', NULL, NULL, '2024-05-03 17:09:34', '2024-05-03 17:09:34'),
(6, 'Huba István', 'huba@headhunter.com', NULL, '$2y$12$HFSWebvZOxDxQN.DP5uB2elIHMGBYlOpDjuUaoxrhNg.Z6uFlikQC', 'fejvadász', 'fenykepek/66353730b70d6_1714763568.jpg', NULL, '2024-05-03 17:09:34', '2024-05-03 17:12:48'),
(7, 'Teszt Elek', 'elek@gmail.hu', NULL, '$2y$12$K3hWSBV6HUl0ArgcCxC3wu4fMD0FKCbMuWk0KZm8NPNeqPveq5SHW', 'álláskereső', NULL, NULL, '2024-05-03 17:15:17', '2024-05-03 17:15:17'),
(8, 'Nagy Hajnalka', 'hajni@gmail.com', NULL, '$2y$12$ftmyH5Xu0dOhiJMc0K0Lxe5g2zWRgjESpmLn/Zqo949RzOh.gm5jK', 'álláskereső', 'fenykepek/663538d179eef_1714763985.jpg', NULL, '2024-05-03 17:19:28', '2024-05-03 17:19:45');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vegzettsegs`
--

CREATE TABLE `vegzettsegs` (
  `vegzettseg_id` bigint(20) UNSIGNED NOT NULL,
  `megnevezes` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `vegzettsegs`
--

INSERT INTO `vegzettsegs` (`vegzettseg_id`, `megnevezes`) VALUES
(1, 'általános iskola'),
(2, 'középiskola - érettségi'),
(3, 'középfokú szakképzés'),
(4, 'felsőfokú szakképzés'),
(5, 'főiskola/egyetem - BA/BSC'),
(6, 'egyetem - MA/MSC'),
(7, 'egyetem - DR');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `allaskeresos`
--
ALTER TABLE `allaskeresos`
  ADD KEY `allaskeresos_user_id_foreign` (`user_id`);

--
-- A tábla indexei `allaskereso_ismerets`
--
ALTER TABLE `allaskereso_ismerets`
  ADD PRIMARY KEY (`allaskereso`,`szakmai_ismeret`),
  ADD KEY `allaskereso_ismerets_szakmai_ismeret_foreign` (`szakmai_ismeret`);

--
-- A tábla indexei `allaskereso_nyelvtudass`
--
ALTER TABLE `allaskereso_nyelvtudass`
  ADD PRIMARY KEY (`allaskereso`,`nyelvtudas`),
  ADD KEY `allaskereso_nyelvtudass_nyelvtudas_foreign` (`nyelvtudas`);

--
-- A tábla indexei `allaskereso_tanulmanys`
--
ALTER TABLE `allaskereso_tanulmanys`
  ADD PRIMARY KEY (`allaskereso`,`intezmeny`,`szak`),
  ADD KEY `allaskereso_tanulmanys_vegzettseg_foreign` (`vegzettseg`);

--
-- A tábla indexei `allaskereso_tapasztalats`
--
ALTER TABLE `allaskereso_tapasztalats`
  ADD PRIMARY KEY (`allaskereso`,`cegnev`,`pozicio`),
  ADD KEY `allaskereso_tapasztalats_pozicio_foreign` (`pozicio`);

--
-- A tábla indexei `allass`
--
ALTER TABLE `allass`
  ADD PRIMARY KEY (`allas_id`),
  ADD KEY `allass_munkaltato_foreign` (`munkaltato`),
  ADD KEY `allass_pozicio_foreign` (`pozicio`),
  ADD KEY `allass_fejvadasz_foreign` (`fejvadasz`);

--
-- A tábla indexei `allas_ismerets`
--
ALTER TABLE `allas_ismerets`
  ADD PRIMARY KEY (`allas`,`szakmai_ismeret`),
  ADD KEY `allas_ismerets_szakmai_ismeret_foreign` (`szakmai_ismeret`);

--
-- A tábla indexei `allas_jelentkezos`
--
ALTER TABLE `allas_jelentkezos`
  ADD PRIMARY KEY (`allas`,`allaskereso`),
  ADD KEY `allas_jelentkezos_allaskereso_foreign` (`allaskereso`);

--
-- A tábla indexei `allas_nyelvtudass`
--
ALTER TABLE `allas_nyelvtudass`
  ADD PRIMARY KEY (`allas`,`nyelvtudas`),
  ADD KEY `allas_nyelvtudass_nyelvtudas_foreign` (`nyelvtudas`);

--
-- A tábla indexei `allas_tapasztalats`
--
ALTER TABLE `allas_tapasztalats`
  ADD PRIMARY KEY (`allas`),
  ADD KEY `allas_tapasztalats_pozicio_foreign` (`pozicio`),
  ADD KEY `allas_tapasztalats_tapasztalat_ido_foreign` (`tapasztalat_ido`);

--
-- A tábla indexei `allas_vegzettsegs`
--
ALTER TABLE `allas_vegzettsegs`
  ADD PRIMARY KEY (`allas`),
  ADD KEY `allas_vegzettsegs_vegzettseg_foreign` (`vegzettseg`);

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- A tábla indexei `fejvadaszs`
--
ALTER TABLE `fejvadaszs`
  ADD KEY `fejvadaszs_user_id_foreign` (`user_id`);

--
-- A tábla indexei `fejvadasz_terulets`
--
ALTER TABLE `fejvadasz_terulets`
  ADD PRIMARY KEY (`fejvadasz`,`terulet`),
  ADD KEY `fejvadasz_terulets_terulet_foreign` (`terulet`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `munkaltatos`
--
ALTER TABLE `munkaltatos`
  ADD PRIMARY KEY (`munkaltato_id`),
  ADD UNIQUE KEY `munkaltatos_email_unique` (`email`);

--
-- A tábla indexei `nyelvtudass`
--
ALTER TABLE `nyelvtudass`
  ADD PRIMARY KEY (`nyelvkod`);

--
-- A tábla indexei `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- A tábla indexei `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- A tábla indexei `pozicios`
--
ALTER TABLE `pozicios`
  ADD PRIMARY KEY (`pozkod`),
  ADD KEY `pozicios_terulet_foreign` (`terulet`);

--
-- A tábla indexei `szakmai_ismerets`
--
ALTER TABLE `szakmai_ismerets`
  ADD PRIMARY KEY (`ismeret_id`);

--
-- A tábla indexei `tapasztalat_idos`
--
ALTER TABLE `tapasztalat_idos`
  ADD PRIMARY KEY (`tapasztalat_id`);

--
-- A tábla indexei `terulets`
--
ALTER TABLE `terulets`
  ADD PRIMARY KEY (`terulet_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A tábla indexei `vegzettsegs`
--
ALTER TABLE `vegzettsegs`
  ADD PRIMARY KEY (`vegzettseg_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `allass`
--
ALTER TABLE `allass`
  MODIFY `allas_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT a táblához `munkaltatos`
--
ALTER TABLE `munkaltatos`
  MODIFY `munkaltato_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `szakmai_ismerets`
--
ALTER TABLE `szakmai_ismerets`
  MODIFY `ismeret_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT a táblához `tapasztalat_idos`
--
ALTER TABLE `tapasztalat_idos`
  MODIFY `tapasztalat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `terulets`
--
ALTER TABLE `terulets`
  MODIFY `terulet_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `vegzettsegs`
--
ALTER TABLE `vegzettsegs`
  MODIFY `vegzettseg_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `allaskeresos`
--
ALTER TABLE `allaskeresos`
  ADD CONSTRAINT `allaskeresos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Megkötések a táblához `allaskereso_ismerets`
--
ALTER TABLE `allaskereso_ismerets`
  ADD CONSTRAINT `allaskereso_ismerets_allaskereso_foreign` FOREIGN KEY (`allaskereso`) REFERENCES `allaskeresos` (`user_id`),
  ADD CONSTRAINT `allaskereso_ismerets_szakmai_ismeret_foreign` FOREIGN KEY (`szakmai_ismeret`) REFERENCES `szakmai_ismerets` (`ismeret_id`);

--
-- Megkötések a táblához `allaskereso_nyelvtudass`
--
ALTER TABLE `allaskereso_nyelvtudass`
  ADD CONSTRAINT `allaskereso_nyelvtudass_allaskereso_foreign` FOREIGN KEY (`allaskereso`) REFERENCES `allaskeresos` (`user_id`),
  ADD CONSTRAINT `allaskereso_nyelvtudass_nyelvtudas_foreign` FOREIGN KEY (`nyelvtudas`) REFERENCES `nyelvtudass` (`nyelvkod`);

--
-- Megkötések a táblához `allaskereso_tanulmanys`
--
ALTER TABLE `allaskereso_tanulmanys`
  ADD CONSTRAINT `allaskereso_tanulmanys_allaskereso_foreign` FOREIGN KEY (`allaskereso`) REFERENCES `allaskeresos` (`user_id`),
  ADD CONSTRAINT `allaskereso_tanulmanys_vegzettseg_foreign` FOREIGN KEY (`vegzettseg`) REFERENCES `vegzettsegs` (`vegzettseg_id`);

--
-- Megkötések a táblához `allaskereso_tapasztalats`
--
ALTER TABLE `allaskereso_tapasztalats`
  ADD CONSTRAINT `allaskereso_tapasztalats_allaskereso_foreign` FOREIGN KEY (`allaskereso`) REFERENCES `allaskeresos` (`user_id`),
  ADD CONSTRAINT `allaskereso_tapasztalats_pozicio_foreign` FOREIGN KEY (`pozicio`) REFERENCES `pozicios` (`pozkod`);

--
-- Megkötések a táblához `allass`
--
ALTER TABLE `allass`
  ADD CONSTRAINT `allass_fejvadasz_foreign` FOREIGN KEY (`fejvadasz`) REFERENCES `fejvadaszs` (`user_id`),
  ADD CONSTRAINT `allass_munkaltato_foreign` FOREIGN KEY (`munkaltato`) REFERENCES `munkaltatos` (`munkaltato_id`),
  ADD CONSTRAINT `allass_pozicio_foreign` FOREIGN KEY (`pozicio`) REFERENCES `pozicios` (`pozkod`);

--
-- Megkötések a táblához `allas_ismerets`
--
ALTER TABLE `allas_ismerets`
  ADD CONSTRAINT `allas_ismerets_allas_foreign` FOREIGN KEY (`allas`) REFERENCES `allass` (`allas_id`),
  ADD CONSTRAINT `allas_ismerets_szakmai_ismeret_foreign` FOREIGN KEY (`szakmai_ismeret`) REFERENCES `szakmai_ismerets` (`ismeret_id`);

--
-- Megkötések a táblához `allas_jelentkezos`
--
ALTER TABLE `allas_jelentkezos`
  ADD CONSTRAINT `allas_jelentkezos_allas_foreign` FOREIGN KEY (`allas`) REFERENCES `allass` (`allas_id`),
  ADD CONSTRAINT `allas_jelentkezos_allaskereso_foreign` FOREIGN KEY (`allaskereso`) REFERENCES `allaskeresos` (`user_id`);

--
-- Megkötések a táblához `allas_nyelvtudass`
--
ALTER TABLE `allas_nyelvtudass`
  ADD CONSTRAINT `allas_nyelvtudass_allas_foreign` FOREIGN KEY (`allas`) REFERENCES `allass` (`allas_id`),
  ADD CONSTRAINT `allas_nyelvtudass_nyelvtudas_foreign` FOREIGN KEY (`nyelvtudas`) REFERENCES `nyelvtudass` (`nyelvkod`);

--
-- Megkötések a táblához `allas_tapasztalats`
--
ALTER TABLE `allas_tapasztalats`
  ADD CONSTRAINT `allas_tapasztalats_allas_foreign` FOREIGN KEY (`allas`) REFERENCES `allass` (`allas_id`),
  ADD CONSTRAINT `allas_tapasztalats_pozicio_foreign` FOREIGN KEY (`pozicio`) REFERENCES `pozicios` (`pozkod`),
  ADD CONSTRAINT `allas_tapasztalats_tapasztalat_ido_foreign` FOREIGN KEY (`tapasztalat_ido`) REFERENCES `tapasztalat_idos` (`tapasztalat_id`);

--
-- Megkötések a táblához `allas_vegzettsegs`
--
ALTER TABLE `allas_vegzettsegs`
  ADD CONSTRAINT `allas_vegzettsegs_allas_foreign` FOREIGN KEY (`allas`) REFERENCES `allass` (`allas_id`),
  ADD CONSTRAINT `allas_vegzettsegs_vegzettseg_foreign` FOREIGN KEY (`vegzettseg`) REFERENCES `vegzettsegs` (`vegzettseg_id`);

--
-- Megkötések a táblához `fejvadaszs`
--
ALTER TABLE `fejvadaszs`
  ADD CONSTRAINT `fejvadaszs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Megkötések a táblához `fejvadasz_terulets`
--
ALTER TABLE `fejvadasz_terulets`
  ADD CONSTRAINT `fejvadasz_terulets_fejvadasz_foreign` FOREIGN KEY (`fejvadasz`) REFERENCES `fejvadaszs` (`user_id`),
  ADD CONSTRAINT `fejvadasz_terulets_terulet_foreign` FOREIGN KEY (`terulet`) REFERENCES `terulets` (`terulet_id`);

--
-- Megkötések a táblához `pozicios`
--
ALTER TABLE `pozicios`
  ADD CONSTRAINT `pozicios_terulet_foreign` FOREIGN KEY (`terulet`) REFERENCES `terulets` (`terulet_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
