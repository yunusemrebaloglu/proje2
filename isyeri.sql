-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 21 Oca 2017, 22:06:37
-- Sunucu sürümü: 10.1.19-MariaDB
-- PHP Sürümü: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `isyeri`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `uploaded_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `media`
--

INSERT INTO `media` (`id`, `user_id`, `path`, `uploaded_at`) VALUES
(20, 1, 'b0011b3d758a07f88a1a7a50f09f994a60b5f017.jpg', '19.01.2017 14:35 '),
(21, 36, '8079459f659af9556abcc8252d5ee025f99d473a.jpg', '19.01.2017 14:36 ');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `medias`
--

CREATE TABLE `medias` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `uploaded_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `medias`
--

INSERT INTO `medias` (`id`, `user_id`, `path`, `uploaded_at`) VALUES
(11, 22, '587e761209170.jpg', '17.01.2017 21:52 '),
(12, 21, '587e84976db0b.jpeg', '17.01.2017 22:54 '),
(24, 24, '83cce86ea4fabc08379d03c6a0c67fba18712b6a.jpg', '21.01.2017 14:46 ');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `paylasim`
--

CREATE TABLE `paylasim` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `kadi` varchar(100) NOT NULL,
  `kurumunadi` varchar(100) NOT NULL,
  `neturis` text NOT NULL,
  `kactan` int(11) NOT NULL,
  `kaca` int(11) NOT NULL,
  `ucret` varchar(100) NOT NULL,
  `cinsiyet` varchar(5) NOT NULL,
  `arama` varchar(100) NOT NULL,
  `kayittarihi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `paylasim`
--

INSERT INTO `paylasim` (`id`, `pid`, `kadi`, `kurumunadi`, `neturis`, `kactan`, `kaca`, `ucret`, `cinsiyet`, `arama`, `kayittarihi`) VALUES
(1, 0, 'qq', 'qq', ' dsads', 5, 18, '2212112', '', 'aran?yor', '16.01.2017 15:20 '),
(2, 0, 'qq', 'qq', ' dsads', 5, 18, '2212112', '', 'aran?yor', '16.01.2017 15:23 '),
(4, 0, 'qq', 'qq', ' sdasdas', 0, 4, '33', 'bay', 'araniyor', '16.01.2017 15:30 '),
(5, 0, 'qq', 'qq', ' dsdasd', 0, 5, '332', 'bay', 'araniyor', '16.01.2017 15:32 '),
(6, 24, 'qq', 'qq', ' dffsdfdf', 13, 16, '33', 'bay', 'araniyor', '16.01.2017 16:05 '),
(7, 24, 'qq', 'qq', ' dsasddas', 0, 16, '324', 'bay', 'araniyor', '16.01.2017 16:20 '),
(8, 24, 'qq', 'qq', ' dsd', 0, 19, '33', 'bay', 'araniyor', '16.01.2017 16:30 '),
(9, 21, 'aa', 'aa', ' 21221', 9, 16, '55', 'bay', 'araniyor', '17.01.2017 11:48 '),
(10, 22, 'bb', 'bb', ' sdasd', 0, 12, '323', 'bay', 'araniyor', '17.01.2017 21:32 '),
(12, 24, 'qq', 'qq', ' ddd', 0, 22, '33', 'bay', 'araniyor', '20.01.2017 22:42 '),
(13, 24, 'qq', 'qq', ' dssadasdasdasdsdssdsd dssadsddsadaasd sdasad sdadsa dsasad sdadsa dsa asd dsa dsa  sda asd asd sda asd sda sad sda sda sda dsa ads sda ds dsa sda sda sda  sd sd ds sd ds dsa  f g t hfghgfghgffff g g gggggggggggg gggggggggggggggg ggggggggggggggggggggg dsdsd ', 0, 3, '33', 'bay', 'bulundu', '20.01.2017 22:47 '),
(14, 24, 'qq', 'qq', ' dd', 0, 1, '3', 'bay', 'araniyor', '20.01.2017 23:33 '),
(16, 24, 'qq', 'qq', ' 2', 0, 20, '2', 'bay', 'araniyor', '20.01.2017 23:34 ');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sirketler`
--

CREATE TABLE `sirketler` (
  `id` int(11) NOT NULL,
  `kadi` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kurumunadi` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `telefonnumarasi` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `ozelid` int(11) NOT NULL DEFAULT '1',
  `kayittarihi` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `adres` text COLLATE utf8_turkish_ci NOT NULL,
  `gsorusu` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `gcevap` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `engel` int(11) NOT NULL DEFAULT '1',
  `para` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sirketler`
--

INSERT INTO `sirketler` (`id`, `kadi`, `email`, `sifre`, `kurumunadi`, `telefonnumarasi`, `ozelid`, `kayittarihi`, `adres`, `gsorusu`, `gcevap`, `engel`, `para`) VALUES
(8, 'kullanıcıadı', '1@gmailks', 'c4ca4238a0b923820dcc509a6f75849b', 'kurumunadı', '11', 1, '', '', '', '', 1, 1),
(9, 'd', 'd', 'd', 'd', 'd', 1, '', '', '', '', 1, 1),
(12, 'ss', '', '', '', '', 1, '', '', '', '', 1, 1),
(21, 'aa', 'ad@gma.cm5415', '4124bc0a9335c27f086f24ba207a4912', 'aa', '12', 1, '', '', '', '', 1, 1),
(22, 'bb', 'bddee@gmail.com2', '21ad0bd836b90d08f4cf640b4c298e7c', 'bb', '24584', 1, '', '', '', '', 1, 2),
(23, 'cc', 'cc@cc', 'e0323a9039add2978bf5b49550572c7c', 'cc', '565', 1, '', '', '', '', 1, 1),
(24, 'qq', 'qq@qq', '6512bd43d9caa6e02c990b0a82652dca', 'KURUMUN ADI', '225445', 1, '16.01.2017 14:43:55', 'sdasdsadsd', '', '', 1, 2),
(25, '2', '2@g22', '8277e0910d750195b448797616e091ad', '22', '2222', 1, '19.01.2017 18:03:51', '22222222 ', '22', 'c81e728d9d4c2f636f067f89cc14862c', 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `isciler`
--

CREATE TABLE `isciler` (
  `id` int(11) NOT NULL,
  `kadi` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `isciadi` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `ogretim` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `bolum` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `yas` int(11) NOT NULL,
  `tc` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  `oncekiisi` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `isistegi` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kactan` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kaca` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `kac` int(11) NOT NULL,
  `telefonnumarasi` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  `ozelid` int(11) NOT NULL DEFAULT '2',
  `kayittarihi` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `gsorusu` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `gcevap` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `engel` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `isciler`
--

INSERT INTO `isciler` (`id`, `kadi`, `email`, `sifre`, `isciadi`, `ogretim`, `bolum`, `yas`, `tc`, `oncekiisi`, `isistegi`, `kactan`, `kaca`, `kac`, `telefonnumarasi`, `ozelid`, `kayittarihi`, `gsorusu`, `gcevap`, `engel`) VALUES
(26, 'a', 'ad@gma.cm', '0cc175b9c0f1b6a831c399e269772661', '1', 'Birinci Öğretim', '1', 20, '1001', 'a', 'a', '00.00', '11.00', 11, '1', 2, '0000-00-00', '', '', 1),
(28, 'yunus', '1@gmailk', '0cc175b9c0f1b6a831c399e269772661', 'ff', 'Birinci Öğretim', 'hemşirelik', 3, '13', 's', 's', '10.00', '11.00', 1, '1222255', 2, '0000-00-00', '', '', 1),
(29, '', '', '0cc175b9c0f1b6a831c399e269772661', '', '', '', 0, '', '', '', '', '', 0, '', 2, '0000-00-00', '', '', 1),
(30, 'adana', 'ad@gma.cmdsa', '6e50876a0875e8c7c24c6085227b9504', 'dfdd', 'Birinci Öğretim', 'dssa', 21, '44584', 'dsadsas ', 'dsadassadsad ', '10.00', '11.00', 1, '545545546', 2, '0000-00-00', '', '', 1),
(31, 'ben', 'bddee@gmail.com', '7fe4771c008a22eb763df47d19e2c6aa', 'sddf', 'Birinci Öğretim', 'dads', 55, '249976', 'asdsdas ', 'dssadssd ', '10.00', '11.00', 1, '5454', 2, '0000-00-00', '', '', 1),
(32, 'ss', 'sss@gmail', '3691308f2a4c2f6983f2880d32e29c84', 'ss ss', 'Birinci Öğretim', '12', 12, '253', 'sadads ', 'dsaasd ', '00.00', '02.00', 2, '1235456', 2, '0000-00-00', '', '', 1),
(33, 'özgün', 'bee@gmail.comdddd', 'c4ca4238a0b923820dcc509a6f75849b', 'dsasddsa', 'Birinci Öğretim', 'ds', 26, '13407200327', 'dssad ', 'dasdsa ', '08.00', '18.00', 10, '25555556226', 2, '0000-00-00', '', '', 1),
(36, 'qq', 'qq@qq', '099b3b060154898840f0ebdfb46ec78f', 'qq', 'Birinci Öğretim', 'qq', 212, '54158793', 'qq ', 'qq ', '10.00', '11.00', 1, '3333333300', 2, '16.01.2017 14:38:31', '', '', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `medias`
--
ALTER TABLE `medias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `paylasim`
--
ALTER TABLE `paylasim`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kayittarihi` (`kayittarihi`);

--
-- Tablo için indeksler `sirketler`
--
ALTER TABLE `sirketler`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kadi` (`kadi`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `isciler`
--
ALTER TABLE `isciler`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `kadi` (`kadi`),
  ADD UNIQUE KEY `tc` (`tc`),
  ADD UNIQUE KEY `telefonnumarasi` (`telefonnumarasi`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Tablo için AUTO_INCREMENT değeri `medias`
--
ALTER TABLE `medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Tablo için AUTO_INCREMENT değeri `paylasim`
--
ALTER TABLE `paylasim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Tablo için AUTO_INCREMENT değeri `sirketler`
--
ALTER TABLE `sirketler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Tablo için AUTO_INCREMENT değeri `isciler`
--
ALTER TABLE `isciler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
