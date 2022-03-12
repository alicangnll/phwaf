-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 11 Mar 2022, 12:27:07
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, 'admin', '060323f33140b4a86b53d01d726a45c7584a3a2b', 'xxx@xxx.com', '060323f33140b4a86b53d01d726a45c7584a3a2b', '0');

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
(1, 'SQL Engelleme', 'SQL Engelleme', 'or¿¿order¿¿concat¿¿limit¿¿where¿¿by¿¿select¿¿drop¿¿from¿¿if¿¿else¿¿char¿¿from'),
(2, 'RFI Engelleme', 'RFI Engelleme', '//¿¿etc¿¿passwd¿¿conf¿¿myd¿¿myi¿¿ini¿¿{¿¿}¿¿/¿¿#¿¿[¿¿]¿¿%¿¿@¿¿??¿¿exec¿¿%¿¿unhex¿¿convert¿¿concat_ws¿¿char¿¿information_schema¿¿where¿¿hex¿¿%20¿¿and¿¿substring¿¿version¿¿ascii¿¿sleep¿¿md5¿¿%0c¿¿%a0¿¿mid¿¿like'),
(4, 'LogForJ', 'LogForJ', '://¿¿ldap¿¿jndi'),
(6, 'XSS Engelleme', 'XSS Engelleme', '>¿¿<¿¿script¿¿alert¿¿%¿¿#¿¿?¿¿data');

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
(4, 'GET', 'GET', 'GET');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vuln_exclude`
--

CREATE TABLE `vuln_exclude` (
  `id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `vuln_log`
--

CREATE TABLE `vuln_log` (
  `id` int(11) NOT NULL,
  `vuln_name` varchar(255) NOT NULL,
  `vuln_ip` varchar(255) NOT NULL,
  `vuln_url` varchar(255) NOT NULL,
  `vuln_date` datetime NOT NULL,
  `vuln_header` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `vuln_log`
--

INSERT INTO `vuln_log` (`id`, `vuln_name`, `vuln_ip`, `vuln_url`, `vuln_date`, `vuln_header`) VALUES
(11, 'POST Injection | SQL Engelleme', '::1', 'git=or', '2022-01-02 09:44:57', ''),
(12, 'POST Injection | SQL Engelleme', '::1', 'action=add-url&s=http://evil.example.com/backdoor.torrent', '2022-01-02 09:46:57', ''),
(13, 'POST Injection | RFI Engelleme', '::1', 'r=poc-1.xml%00', '2022-01-02 09:47:51', ''),
(15, 'Not Permission Method Try | ', '::1', 'GET', '2022-01-02 09:49:57', ''),
(16, 'Not Permission Method Try | ', '::1', 'GET', '2022-01-02 09:52:26', ''),
(17, 'Not Permission Method Try | ', '::1', 'GET', '2022-01-02 09:52:27', ''),
(18, 'Not Permission Method Try | ', '::1', 'GET', '2022-01-02 09:52:28', ''),
(19, 'IP Ban', '::1', 'IP', '2022-01-02 10:05:44', ''),
(20, 'POST Injection | LogForJ', '::1', 'git=jndi:', '2022-01-02 19:39:49', ''),
(21, 'POST Injection | LogForJ', '::1', 'd=jndi&df=jndi', '2022-01-03 08:28:15', ''),
(22, 'POST Injection | RFI Engelleme', '::1', 'd=ldap://&df=ldap://', '2022-01-03 08:29:28', ''),
(23, 'POST Injection | LogForJ', '::1', 'git=jndi:', '2022-01-08 19:39:51', ''),
(24, 'POST Injection | LogForJ', '::1', 'git=jndi:', '2022-01-08 19:43:04', ''),
(25, 'POST Injection | LogForJ', '::1', 'git=jndi:', '2022-01-08 19:43:32', ''),
(26, 'POST Injection | LogForJ', '::1', 'git=jndi:', '2022-01-08 19:43:33', ''),
(27, 'POST Injection | SQL Engelleme', '::1', 'd=&df=', '2022-01-12 09:52:48', ''),
(28, 'POST Injection | SQL Engelleme', '::1', 'git=%3cimg/src=x%20onerror=%22`${x}`;alert(`ex.mi`);%22%3e', '2022-01-12 09:53:05', ''),
(29, 'POST Injection | SQL Engelleme', '::1', 'd=alert(1) &df=alert(1) ', '2022-01-12 11:47:38', ''),
(30, 'POST Injection | SQL Engelleme', '::1', 'd=alert(1) &df=alert(1) ', '2022-01-12 11:47:52', ''),
(31, 'POST Injection | SQL Engelleme', '::1', 'd=alert(1) &df=alert(1) ', '2022-01-12 11:49:15', ''),
(32, 'POST Injection | SQL Engelleme', '::1', 'd=\">&df=\">', '2022-01-12 11:50:39', ''),
(33, 'POST Injection | SQL Engelleme', '::1', 'd=\'\';!--\"=&{()}&df=\'\';!--\"=&{()}\r\n', '2022-01-12 11:51:30', ''),
(34, 'POST Injection | SQL Engelleme', '::1', 'd=\'\';!--\"=&{()}&df=\'\';!--\"=&{()}\r\n', '2022-01-12 11:52:43', ''),
(35, 'POST Injection | SQL Engelleme', '::1', 'd=\">&df=', '2022-01-16 10:51:11', ''),
(36, 'POST Injection | SQL Engelleme', '::1', 'd=\">&df=', '2022-01-16 10:56:00', ''),
(37, 'POST Injection | SQL Engelleme', '::1', 'd=\">&df=', '2022-01-16 10:56:03', ''),
(38, 'POST Injection | SQL Engelleme', '::1', 'd=\">&df=', '2022-01-16 10:56:20', ''),
(39, 'POST Injection | SQL Engelleme', '::1', 'd=\">&df=', '2022-01-16 10:56:25', ''),
(40, 'IP Ban', '::1', 'IP', '2022-01-16 11:36:26', ''),
(41, 'IP Ban', '::1', 'IP', '2022-01-16 11:37:24', ''),
(42, 'IP Ban', '::1', 'IP', '2022-01-16 11:38:01', ''),
(43, 'IP Ban', '::1', 'IP', '2022-01-16 11:38:09', ''),
(44, 'IP Ban', '::1', 'IP', '2022-01-16 11:38:52', ''),
(45, 'IP Ban', '::1', 'IP', '2022-01-16 11:38:54', ''),
(46, 'IP Ban', '::1', 'IP', '2022-01-16 11:39:52', ''),
(47, 'IP Ban', '::1', 'IP', '2022-01-16 11:40:06', ''),
(48, 'IP Ban', '::1', 'IP', '2022-01-16 11:44:24', ''),
(49, 'IP Ban', '::1', 'IP', '2022-01-16 11:44:46', ''),
(50, 'IP Ban', '::1', 'IP', '2022-01-16 11:44:47', ''),
(51, 'IP Ban', '::1', 'IP', '2022-01-16 11:44:50', ''),
(52, 'IP Ban', '::1', 'IP', '2022-01-16 11:46:35', ''),
(53, 'IP Ban', '::1', 'IP', '2022-01-16 11:46:43', ''),
(54, 'Injection Error', '::1', 'd=../etc/passwd&df=../etc/passwd', '2022-01-16 11:48:44', ''),
(55, 'Injection Error', '::1', 'git=../etc/passwd', '2022-01-16 11:53:51', ''),
(56, 'Injection Error', '::1', 'git=../etc/passwd', '2022-01-16 11:55:44', ''),
(57, 'Injection Error', '::1', 'git=../etc/passwd', '2022-01-16 13:00:18', ''),
(58, 'Injection Error', '::1', 'git=../etc/passwd', '2022-01-16 13:00:57', ''),
(59, 'Injection Error', '::1', 'git=../etc/passwd', '2022-01-16 13:01:39', ''),
(60, 'Injection Error', '::1', 'd=str0d\"/> @keyframes  x{}&df=str0d\"/>\r\n@keyframes\r\n x{}', '2022-01-18 08:02:26', ''),
(61, 'Injection Error', '::1', 'd=numan&df=numan', '2022-01-20 14:29:11', ''),
(62, 'Injection Error', '::1', 'd=alican&df=alican', '2022-01-20 14:29:29', ''),
(63, 'Injection Error', '::1', 'd=numan&df=numan', '2022-01-20 14:35:57', ''),
(64, 'Injection Error', '::1', 'd=numan&df=numan', '2022-01-20 14:36:00', ''),
(65, 'Injection Error', '::1', 'd=numan&df=numan', '2022-01-20 14:36:30', ''),
(66, 'Injection Error', '::1', 'd=numan&df=numan', '2022-01-20 14:37:22', ''),
(67, 'Injection Error', '::1', 'd=numan&df=numan', '2022-01-20 14:38:20', ''),
(68, 'Injection Error', '::1', 'd=numan&df=numan', '2022-01-20 14:38:56', ''),
(69, 'Injection Error', '::1', 'd=numan&df=numan', '2022-01-20 14:39:05', ''),
(70, 'Injection Error', '::1', 'd=numan&df=numan', '2022-01-20 14:39:07', ''),
(71, 'Injection Error', '::1', 'd=numan&df=numan', '2022-01-20 14:40:17', ''),
(72, 'Injection Error', '::1', 'd=numan&df=numan', '2022-01-20 14:40:35', ''),
(73, 'Injection Error', '::1', 'd=numan&df=numan', '2022-01-20 14:41:00', ''),
(74, 'Injection Error', '::1', 'd=numan&df=numan', '2022-01-20 14:41:02', ''),
(75, 'Injection Error', '::1', 'd=data&df=data', '2022-01-20 14:41:32', ''),
(76, 'Injection Error', '::1', 'git=ppost', '2022-01-20 14:43:50', ''),
(77, 'Injection Error', '::1', 'git=ppost', '2022-01-20 14:43:57', ''),
(78, 'Injection Error', '::1', 'd=order&df=order', '2022-01-20 14:44:31', ''),
(79, 'Injection Error', '::1', 'd=order&df=order', '2022-01-20 14:44:51', ''),
(80, 'Injection Error', '::1', 'git=post\">', '2022-01-20 14:46:25', ''),
(81, 'Injection Error', '::1', 'd=\">&df=\">', '2022-01-20 14:57:02', ''),
(82, 'Injection Error', '::1', 'd=\">&df=\">', '2022-01-20 14:57:30', ''),
(83, 'Injection Error', '::1', 'd=\">&df=\">', '2022-01-20 14:57:37', ''),
(84, 'Injection Error', '::1', 'd=\">&df=\">', '2022-01-20 15:00:09', ''),
(85, 'Injection Error', '::1', 'd=\">&df=\">', '2022-01-20 15:00:22', ''),
(86, 'Injection Error', '::1', 'd=\">&df=\">', '2022-01-20 15:00:55', ''),
(87, 'Injection Error', '::1', 'd=\">&df=\">', '2022-01-20 15:01:31', ''),
(88, 'Injection Error', '::1', 'd=\">&df=\">', '2022-01-20 15:01:54', ''),
(89, 'Injection Error', '::1', 'd=\">&df=\">', '2022-01-20 15:02:42', ''),
(90, 'Injection Error', '::1', 'd=data&df=data', '2022-01-20 15:09:37', ''),
(91, 'Method Error', '::1', 'HTTP/1.1', '2022-01-20 15:18:10', ''),
(92, 'Method Error', '::1', 'HTTP/1.1', '2022-01-20 15:18:12', ''),
(93, 'Method Error', '::1', 'HTTP/1.1', '2022-01-20 15:18:13', ''),
(94, 'Method Error', '::1', 'HTTP/1.1', '2022-01-20 15:18:15', ''),
(95, 'Injection Error', '127.0.0.1', 'git=post\">', '2022-01-23 18:07:22', ''),
(96, 'Injection Error', '127.0.0.1', 'git=post\">', '2022-01-23 18:07:51', ''),
(97, 'Injection Error', '127.0.0.1', 'git=post\">', '2022-01-23 18:07:59', ''),
(98, 'Injection Error', '127.0.0.1', 'git=post\">', '2022-01-23 18:08:07', ''),
(99, 'Injection Error', '127.0.0.1', 'git=post\">', '2022-01-23 18:08:34', ''),
(100, 'Injection Error', '127.0.0.1', 'git=post\">', '2022-01-23 18:08:51', ''),
(101, 'Injection Error', '::1', 'd=\">&df=\">', '2022-02-01 13:00:32', ''),
(102, 'Injection Error', '::1', 'd=&quot;&gt;&amp;df=', '2022-03-11 12:25:14', '');

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
  `anti_ddos` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `debug` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `waf_ayar`
--

INSERT INTO `waf_ayar` (`ayar_id`, `ayar_adi`, `waf_aktif`, `ayar_aktif`, `oto_ban`, `anti_ddos`, `debug`) VALUES
(1, 'Yeni', '1', '1', '0', '1', '0');

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
-- Tablo için indeksler `vuln_exclude`
--
ALTER TABLE `vuln_exclude`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `vuln_log`
--
ALTER TABLE `vuln_log`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `kural_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `ip_ban`
--
ALTER TABLE `ip_ban`
  MODIFY `ip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `method_blok`
--
ALTER TABLE `method_blok`
  MODIFY `method_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `vuln_exclude`
--
ALTER TABLE `vuln_exclude`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `vuln_log`
--
ALTER TABLE `vuln_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- Tablo için AUTO_INCREMENT değeri `waf_ayar`
--
ALTER TABLE `waf_ayar`
  MODIFY `ayar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
