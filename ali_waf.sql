-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 25 Eki 2019, 21:15:19
-- Sunucu sürümü: 10.4.8-MariaDB
-- PHP Sürümü: 7.3.10

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
-- Tablo için tablo yapısı `admin_bilgi`
--

CREATE TABLE `admin_bilgi` (
  `id` int(11) NOT NULL,
  `kadi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `passwd` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `admin_yetki` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `admin_bilgi`
--

INSERT INTO `admin_bilgi` (`id`, `kadi`, `passwd`, `email`, `token`, `admin_yetki`) VALUES
(1, 'admin', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'xxx@xxx.com', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `guard_watch`
--

CREATE TABLE `guard_watch` (
  `kural_id` int(11) NOT NULL,
  `kural_adi` varchar(255) CHARACTER SET utf32 COLLATE utf32_turkish_ci NOT NULL,
  `kural_hakkinda` varchar(255) CHARACTER SET utf32 COLLATE utf32_turkish_ci NOT NULL,
  `kural_icerik` text CHARACTER SET utf32 COLLATE utf32_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `guard_watch`
--

INSERT INTO `guard_watch` (`kural_id`, `kural_adi`, `kural_hakkinda`, `kural_icerik`) VALUES
(4, 'SQL Engelleme', '', '..¿¿½¿¿%¿¿OR¿¿\"¿¿\'¿¿`¿¿concat¿¿join¿¿\\\"¿¿\\\\¿¿tablo_adim¿¿kolon_adim¿¿script¿¿alert¿¿JaVaScRiPT¿¿\"¿¿fromCharCode¿¿onmouseover¿¿&#¿¿#&¿¿	¿¿!¿¿#¿¿$¿¿%¿¿(¿¿)¿¿*¿¿~¿¿+¿¿-¿¿_¿¿,¿¿:¿¿;¿¿@[¿¿/¿¿|¿¿\\¿¿]¿¿^¿¿`¿¿//¿¿/¿¿livescript¿¿constructor¿¿:¿¿\'\\ja\\vasc\\ript:alert¿¿¾¿¿¢¿¿order¿¿by¿¿union¿¿table_name¿¿column_name¿¿from¿¿concat¿¿and¿¿AND¿¿limit¿¿SRC¿¿src¿¿meta¿¿embed¿¿xml¿¿XML¿¿x;¿¿x27;¿¿quot¿¿+¿¿UNION¿¿-¿¿-¿¿+¿¿*¿¿’¿¿|¿¿\"¿¿?¿¿₺¿¿@¿¿,¿¿/¿¿“¿¿€¿¿£¿¿$¿¿~¿¿\\¿¿[¿¿]¿¿{¿¿}¿¿>¿¿<¿¿'),
(2, 'XSS Engelleme Kuralı', 'XSS Engelleyici', '..¿¿½¿¿%¿¿OR¿¿\\\"¿¿\\\'¿¿`¿¿concat¿¿join¿¿\\\\\\\"¿¿\\\\\\\\¿¿tablo_adim¿¿kolon_adim¿¿script¿¿alert¿¿JaVaScRiPT¿¿\"¿¿fromCharCode¿¿onmouseover¿¿&#¿¿#&¿¿	¿¿!¿¿#¿¿$¿¿%¿¿(¿¿)¿¿*¿¿~¿¿+¿¿-¿¿_¿¿,¿¿:¿¿;¿¿@[¿¿/¿¿|¿¿\\\\¿¿]¿¿^¿¿`¿¿//¿¿/¿¿livescript¿¿constructor¿¿:¿¿\\\'\\\\ja\\\\vasc\\\\ript:alert¿¿¾¿¿¢¿¿order¿¿by¿¿union¿¿table_name¿¿column_name¿¿from¿¿concat¿¿and¿¿AND¿¿limit¿¿SRC¿¿src¿¿meta¿¿embed¿¿xml¿¿XML¿¿x;¿¿lt¿¿>¿¿x27;¿¿quot¿¿+¿¿UNION¿¿-¿¿-¿¿+¿¿*¿¿’¿¿?¿¿'),
(3, 'RFI Engelleme', 'RFI Engelleme', '//¿¿etc¿¿passwd¿¿conf¿¿MYD¿¿MYI¿¿ini¿¿{¿¿}¿¿/¿¿#¿¿[¿¿]¿¿&#37;¿¿@¿¿¢¿¿¤¿¿¥¿¿¦¿¿§¿¿©¿¿ª¿¿«¿¿¬¿¿&shy;¿¿®¿¿¯¿¿°¿¿±¿¿²¿¿³¿¿µ¿¿¶¿¿·¿¿¸¿¿¹¿¿º¿¿¼¿¿¾¿¿À¿¿exec¿¿%¿¿unhex¿¿ CONVERT¿¿CONCAT_WS¿¿CHAR¿¿InfORmaTion_scHema¿¿WHERE¿¿hex¿¿%20¿¿AND¿¿substring¿¿version¿¿ascii¿¿SLEEP¿¿md5¿¿%0C¿¿%A0¿¿MID¿¿LIKE¿¿');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ip_ban`
--

CREATE TABLE `ip_ban` (
  `ip_id` int(11) NOT NULL,
  `ip_adresi` varchar(255) NOT NULL,
  `ip_usragent` text NOT NULL,
  `ip_suresi` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `method_blok`
--

CREATE TABLE `method_blok` (
  `method_id` int(11) NOT NULL,
  `method_adi` varchar(255) NOT NULL,
  `method_bilgisi` varchar(255) NOT NULL,
  `method_turu` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `method_blok`
--

INSERT INTO `method_blok` (`method_id`, `method_adi`, `method_bilgisi`, `method_turu`) VALUES
(2, 'POST', 'POST', 'POST'),
(3, 'GET', '', 'GET');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `waf_ayar`
--

CREATE TABLE `waf_ayar` (
  `ayar_id` int(11) NOT NULL,
  `ayar_adi` text COLLATE utf8_turkish_ci NOT NULL,
  `waf_aktif` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_aktif` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `oto_ban` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `anti_ddos` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `waf_ayar`
--

INSERT INTO `waf_ayar` (`ayar_id`, `ayar_adi`, `waf_aktif`, `ayar_aktif`, `oto_ban`, `anti_ddos`) VALUES
(1, 'Yeni', '1', '1', '0', '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin_bilgi`
--
ALTER TABLE `admin_bilgi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `guard_watch`
--
ALTER TABLE `guard_watch`
  ADD PRIMARY KEY (`kural_id`);

--
-- Tablo için indeksler `ip_ban`
--
ALTER TABLE `ip_ban`
  ADD PRIMARY KEY (`ip_id`);

--
-- Tablo için indeksler `method_blok`
--
ALTER TABLE `method_blok`
  ADD PRIMARY KEY (`method_id`);

--
-- Tablo için indeksler `waf_ayar`
--
ALTER TABLE `waf_ayar`
  ADD PRIMARY KEY (`ayar_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `guard_watch`
--
ALTER TABLE `guard_watch`
  MODIFY `kural_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `ip_ban`
--
ALTER TABLE `ip_ban`
  MODIFY `ip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `method_blok`
--
ALTER TABLE `method_blok`
  MODIFY `method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `waf_ayar`
--
ALTER TABLE `waf_ayar`
  MODIFY `ayar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
