-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 10 Tem 2019, 21:44:50
-- Sunucu sürümü: 10.2.19-MariaDB
-- PHP Sürümü: 7.2.7

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
-- Tablo için tablo yapısı `admin_giris`
--

CREATE TABLE `admin_giris` (
  `admin_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `pass_word` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `admin_giris`
--

INSERT INTO `admin_giris` (`admin_id`, `user_name`, `pass_word`) VALUES
(2, 'admin', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1');

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
(1, 'SQL Engelleme Kuralı', 'SQL Zaafiyeti Engelleme', '..¿¿½¿¿%¿¿OR¿¿\"¿¿\'¿¿`¿¿concat¿¿join¿¿\\\"¿¿\\\\¿¿tablo_adim¿¿kolon_adim¿¿script¿¿alert¿¿JaVaScRiPT¿¿&quot;¿¿fromCharCode¿¿onmouseover¿¿&#¿¿#&¿¿&#x09;¿¿!¿¿#¿¿$¿¿%¿¿(¿¿)¿¿*¿¿~¿¿+¿¿-¿¿_¿¿,¿¿:¿¿;¿¿?¿¿@[¿¿/¿¿|¿¿\\¿¿]¿¿^¿¿`¿¿//¿¿/¿¿livescript¿¿constructor¿¿:¿¿\'\\ja\\vasc\\ript:alert¿¿¾¿¿¢¿¿order¿¿by¿¿union¿¿table_name¿¿column_name¿¿from¿¿concat¿¿and¿¿AND¿¿limit¿¿SRC¿¿src¿¿meta¿¿embed¿¿xml¿¿XML¿¿x;¿¿x27;¿¿quot¿¿+¿¿UNION¿¿-¿¿-¿¿+¿¿*¿¿’¿¿|'),
(2, 'XSS Engelleme Kuralı', 'XSS Engelleyici', '..¿¿½¿¿%¿¿OR¿¿\\\"¿¿\\\'¿¿`¿¿concat¿¿join¿¿\\\\\\\"¿¿\\\\\\\\¿¿tablo_adim¿¿kolon_adim¿¿script¿¿alert¿¿JaVaScRiPT¿¿&quot;¿¿fromCharCode¿¿onmouseover¿¿&#¿¿#&¿¿&#x09;¿¿!¿¿#¿¿$¿¿%¿¿(¿¿)¿¿*¿¿~¿¿+¿¿-¿¿_¿¿,¿¿:¿¿;¿¿?¿¿@[¿¿/¿¿|¿¿\\\\¿¿]¿¿^¿¿`¿¿//¿¿/¿¿livescript¿¿constructor¿¿:¿¿\\\'\\\\ja\\\\vasc\\\\ript:alert¿¿¾¿¿¢¿¿order¿¿by¿¿union¿¿table_name¿¿column_name¿¿from¿¿concat¿¿and¿¿AND¿¿limit¿¿SRC¿¿src¿¿meta¿¿embed¿¿xml¿¿XML¿¿x;¿¿lt¿¿&gt¿¿x27;¿¿quot¿¿+¿¿UNION¿¿-¿¿-¿¿+¿¿*¿¿’¿¿'),
(3, 'RFI Engelleme', 'RFI Engelleme', '//¿¿etcpasswd¿¿conf¿¿MYD¿¿MYI¿¿ini¿¿{¿¿}¿¿/¿¿#¿¿[¿¿]¿¿&#37;¿¿@¿¿¢¿¿¤¿¿¥¿¿¦¿¿§¿¿©¿¿ª¿¿«¿¿¬¿¿&shy;¿¿®¿¿¯¿¿°¿¿±¿¿²¿¿³¿¿µ¿¿¶¿¿·¿¿¸¿¿¹¿¿º¿¿¼¿¿¾¿¿À¿¿');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ip_ban`
--

CREATE TABLE `ip_ban` (
  `ip_id` int(11) NOT NULL,
  `ip_adresi` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `ip_ban`
--

INSERT INTO `ip_ban` (`ip_id`, `ip_adresi`) VALUES
(2, '127.0.0.1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `method_blok`
--

CREATE TABLE `method_blok` (
  `method_id` int(11) NOT NULL,
  `method_adi` varchar(255) NOT NULL,
  `method_bilgisi` varchar(255) NOT NULL,
  `method_turu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `method_blok`
--

INSERT INTO `method_blok` (`method_id`, `method_adi`, `method_bilgisi`, `method_turu`) VALUES
(2, 'POST', 'POST', 'POST'),
(3, 'GET', 'GET', 'GET');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `port_blok`
--

CREATE TABLE `port_blok` (
  `port_id` int(11) NOT NULL,
  `port_adi` varchar(255) NOT NULL,
  `port_bilgisi` varchar(50) NOT NULL,
  `port_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `port_blok`
--

INSERT INTO `port_blok` (`port_id`, `port_adi`, `port_bilgisi`, `port_no`) VALUES
(1, 'Port1', 'Port1', '8080');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin_giris`
--
ALTER TABLE `admin_giris`
  ADD PRIMARY KEY (`admin_id`);

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
-- Tablo için indeksler `port_blok`
--
ALTER TABLE `port_blok`
  ADD PRIMARY KEY (`port_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin_giris`
--
ALTER TABLE `admin_giris`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `guard_watch`
--
ALTER TABLE `guard_watch`
  MODIFY `kural_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `ip_ban`
--
ALTER TABLE `ip_ban`
  MODIFY `ip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `method_blok`
--
ALTER TABLE `method_blok`
  MODIFY `method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `port_blok`
--
ALTER TABLE `port_blok`
  MODIFY `port_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
