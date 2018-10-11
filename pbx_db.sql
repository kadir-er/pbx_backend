-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 11 Eki 2018, 21:13:01
-- Sunucu sürümü: 5.7.14
-- PHP Sürümü: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `pbx_db`
--
CREATE DATABASE IF NOT EXISTS `pbx_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pbx_db`;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `billing`
--

CREATE TABLE `billing` (
  `id` int(12) NOT NULL,
  `firm_id` int(6) NOT NULL,
  `transaction_date` varchar(10) NOT NULL,
  `amount` float NOT NULL,
  `selected_number_count` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `firm`
--

CREATE TABLE `firm` (
  `id` int(6) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` varchar(500) NOT NULL,
  `sector` varchar(200) NOT NULL,
  `tax_office` varchar(200) NOT NULL,
  `tax_id` int(10) NOT NULL,
  `representer_id` int(8) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `firm`
--

INSERT INTO `firm` (`id`, `name`, `address`, `sector`, `tax_office`, `tax_id`, `representer_id`) VALUES
(1, 'asd', 'asdssdasd', 'asda', 'asdas', 1, 0),
(2, 'asd', 'asdssdasd', 'asda', 'asdas', 1, 0),
(3, 'new firm', 'example firm address', 'example firm sector', 'example tax office', 0, 0),
(4, 'new firm', 'example firm address', 'example firm sector', 'example tax office', 123321, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `number_pool`
--

CREATE TABLE `number_pool` (
  `id` int(11) NOT NULL,
  `firm_id` int(11) DEFAULT NULL,
  `number` varchar(15) NOT NULL,
  `number_type` tinyint(2) DEFAULT NULL,
  `contract_starts_date` varchar(10) DEFAULT NULL,
  `contract_end_date` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `number_pool`
--

INSERT INTO `number_pool` (`id`, `firm_id`, `number`, `number_type`, `contract_starts_date`, `contract_end_date`) VALUES
(1, 0, '054528375371', 0, '', ''),
(2, 1, '054528375372', 0, '', ''),
(3, 0, '054528375373', 0, '', ''),
(4, 0, '054528375374', 0, '', ''),
(5, 0, '054528375375', 0, '', ''),
(6, 0, '054528375376', 0, '', ''),
(7, 0, '054528375378', 0, '', ''),
(8, 0, '054528375377', 0, '', ''),
(9, 0, '054528375379', 0, '', ''),
(10, 0, '05452837531', 0, '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `representers`
--

CREATE TABLE `representers` (
  `id` int(8) NOT NULL,
  `firm_id` int(6) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` varchar(80) NOT NULL,
  `tel` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `firm`
--
ALTER TABLE `firm`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `number_pool`
--
ALTER TABLE `number_pool`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `representers`
--
ALTER TABLE `representers`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `firm`
--
ALTER TABLE `firm`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `number_pool`
--
ALTER TABLE `number_pool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `representers`
--
ALTER TABLE `representers`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
