-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 03 Haz 2019, 00:08:19
-- Sunucu sürümü: 10.1.38-MariaDB
-- PHP Sürümü: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ali_waf`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `guard_watch`
--

CREATE TABLE `guard_watch` (
  `kural_id` int(11) NOT NULL,
  `kural_adi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `kural_hakkinda` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `kural_icerik` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `guard_watch`
--

INSERT INTO `guard_watch` (`kural_id`, `kural_adi`, `kural_hakkinda`, `kural_icerik`) VALUES
(1, 'SQL Engelleme KuralÄ±', 'SQL Zaafiyeti Engelleme', '..Â¿Â¿Â½Â¿Â¿%Â¿Â¿ORÂ¿Â¿\"Â¿Â¿\'Â¿Â¿`Â¿Â¿concatÂ¿Â¿joinÂ¿Â¿\\\"Â¿Â¿\\\\Â¿Â¿tablo_adimÂ¿Â¿kolon_adimÂ¿Â¿scriptÂ¿Â¿alertÂ¿Â¿JaVaScRiPTÂ¿Â¿&quot;Â¿Â¿fromCharCodeÂ¿Â¿onmouseoverÂ¿Â¿&#Â¿Â¿#&Â¿Â¿&#x09;Â¿Â¿!Â¿Â¿#Â¿Â¿$Â¿Â¿%Â¿Â¿(Â¿Â¿)Â¿Â¿*Â¿Â¿~Â¿Â¿+Â¿Â¿-Â¿Â¿_Â¿Â¿,Â¿Â¿:Â¿Â¿;Â¿Â¿?Â¿Â¿@[Â¿Â¿/Â¿Â¿|Â¿Â¿\\Â¿Â¿]Â¿Â¿^Â¿Â¿`Â¿Â¿//Â¿Â¿/Â¿Â¿livescriptÂ¿Â¿constructorÂ¿Â¿:Â¿Â¿\'\\ja\\vasc\\ript:alertÂ¿Â¿Â¾Â¿Â¿Â¢Â¿Â¿orderÂ¿Â¿byÂ¿Â¿unionÂ¿Â¿table_nameÂ¿Â¿column_nameÂ¿Â¿fromÂ¿Â¿concatÂ¿Â¿andÂ¿Â¿ANDÂ¿Â¿limitÂ¿Â¿SRCÂ¿Â¿srcÂ¿Â¿metaÂ¿Â¿embedÂ¿Â¿xmlÂ¿Â¿XMLÂ¿Â¿x;Â¿Â¿x27;Â¿Â¿quotÂ¿Â¿+Â¿Â¿UNIONÂ¿Â¿-Â¿Â¿-Â¿Â¿+Â¿Â¿*Â¿Â¿â€™Â¿Â¿|'),
(2, 'XSS Engelleme KuralÄ±', 'XSS Engelleyici', '..Â¿Â¿Â½Â¿Â¿%Â¿Â¿ORÂ¿Â¿\\\"Â¿Â¿\\\'Â¿Â¿`Â¿Â¿concatÂ¿Â¿joinÂ¿Â¿\\\\\\\"Â¿Â¿\\\\\\\\Â¿Â¿tablo_adimÂ¿Â¿kolon_adimÂ¿Â¿scriptÂ¿Â¿alertÂ¿Â¿JaVaScRiPTÂ¿Â¿&quot;Â¿Â¿fromCharCodeÂ¿Â¿onmouseoverÂ¿Â¿&#Â¿Â¿#&Â¿Â¿&#x09;Â¿Â¿!Â¿Â¿#Â¿Â¿$Â¿Â¿%Â¿Â¿(Â¿Â¿)Â¿Â¿*Â¿Â¿~Â¿Â¿+Â¿Â¿-Â¿Â¿_Â¿Â¿,Â¿Â¿:Â¿Â¿;Â¿Â¿?Â¿Â¿@[Â¿Â¿/Â¿Â¿|Â¿Â¿\\\\Â¿Â¿]Â¿Â¿^Â¿Â¿`Â¿Â¿//Â¿Â¿/Â¿Â¿livescriptÂ¿Â¿constructorÂ¿Â¿:Â¿Â¿\\\'\\\\ja\\\\vasc\\\\ript:alertÂ¿Â¿Â¾Â¿Â¿Â¢Â¿Â¿orderÂ¿Â¿byÂ¿Â¿unionÂ¿Â¿table_nameÂ¿Â¿column_nameÂ¿Â¿fromÂ¿Â¿concatÂ¿Â¿andÂ¿Â¿ANDÂ¿Â¿limitÂ¿Â¿SRCÂ¿Â¿srcÂ¿Â¿metaÂ¿Â¿embedÂ¿Â¿xmlÂ¿Â¿XMLÂ¿Â¿x;Â¿Â¿ltÂ¿Â¿&gtÂ¿Â¿x27;Â¿Â¿quotÂ¿Â¿+Â¿Â¿UNIONÂ¿Â¿-Â¿Â¿-Â¿Â¿+Â¿Â¿*Â¿Â¿â€™Â¿Â¿&Â¿Â¿|'),
(4, 'RFI Engelleme', 'RFI Engelleme', '//Â¿Â¿etcpasswdÂ¿Â¿confÂ¿Â¿MYDÂ¿Â¿MYIÂ¿Â¿ini');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kadi_giris`
--

CREATE TABLE `kadi_giris` (
  `usr_id` int(11) NOT NULL,
  `kadi` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ksifre` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `kadi_giris`
--

INSERT INTO `kadi_giris` (`usr_id`, `kadi`, `ksifre`) VALUES
(0, 'admin', '060323f33140b4a86b53d01d726a45c7584a3a2b');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `guard_watch`
--
ALTER TABLE `guard_watch`
  ADD PRIMARY KEY (`kural_id`);

--
-- Tablo için indeksler `kadi_giris`
--
ALTER TABLE `kadi_giris`
  ADD PRIMARY KEY (`usr_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
