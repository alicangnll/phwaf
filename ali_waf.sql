-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 22 Eki 2019, 23:05:11
-- Sunucu sürümü: 10.4.6-MariaDB
-- PHP Sürümü: 7.1.31

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
-- Tablo için tablo yapısı `guncelleme_table`
--

CREATE TABLE `guncelleme_table` (
  `guncelleme_id` int(11) NOT NULL,
  `guncelleme_adi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `guncelleme_kodu` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `guncelleme_tarih` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `guncelleme_table`
--

INSERT INTO `guncelleme_table` (`guncelleme_id`, `guncelleme_adi`, `guncelleme_kodu`, `guncelleme_tarih`) VALUES
(1, 'AliWAF V2', '201910', '10.2019');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `header_blok`
--

CREATE TABLE `header_blok` (
  `ayar_id` int(11) NOT NULL,
  `ayar_adi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_icerik` text COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `header_blok`
--

INSERT INTO `header_blok` (`ayar_id`, `ayar_adi`, `ayar_icerik`) VALUES
(1, 'SQL POST Enjeksiyon', '¿¿[¿¿]¿¿');

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

--
-- Tablo döküm verisi `ip_ban`
--

INSERT INTO `ip_ban` (`ip_id`, `ip_adresi`, `ip_usragent`, `ip_suresi`) VALUES
(6, '::1', '{\"Host\":\"localhost\",\"Connection\":\"keep-alive\",\"Cache-Control\":\"max-age=0\",\"Upgrade-Insecure-Requests\":\"1\",\"User-Agent\":\"Mozilla\\/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/77.0.3865.120 Safari\\/537.36\",\"Sec-Fetch-Mode\":\"navigate\",\"Sec-Fetch-User\":\"?1\",\"Accept\":\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/webp,image\\/apng,*\\/*;q=0.8,application\\/signed-exchange;v=b3\",\"Sec-Fetch-Site\":\"none\",\"Accept-Encoding\":\"gzip, deflate, br\",\"Accept-Language\":\"tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7\",\"Cookie\":\"PHPSESSID=h50snqj6cdd53hupmkqvefakge\"}', '23:04:25');

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
  `oto_ban` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `waf_ayar`
--

INSERT INTO `waf_ayar` (`ayar_id`, `ayar_adi`, `waf_aktif`, `ayar_aktif`, `oto_ban`) VALUES
(1, 'Yeni', '1', '1', '1');

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
-- Tablo için indeksler `guncelleme_table`
--
ALTER TABLE `guncelleme_table`
  ADD PRIMARY KEY (`guncelleme_id`);

--
-- Tablo için indeksler `header_blok`
--
ALTER TABLE `header_blok`
  ADD PRIMARY KEY (`ayar_id`);

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
-- Tablo için AUTO_INCREMENT değeri `guncelleme_table`
--
ALTER TABLE `guncelleme_table`
  MODIFY `guncelleme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `header_blok`
--
ALTER TABLE `header_blok`
  MODIFY `ayar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
