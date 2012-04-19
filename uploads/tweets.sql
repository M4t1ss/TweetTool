-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2012 at 01:52 PM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `riks`
--

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

DROP TABLE IF EXISTS `tweets`;
CREATE TABLE IF NOT EXISTS `tweets` (
  `id` bigint(20) unsigned NOT NULL,
  `text` varchar(150) CHARACTER SET utf8 NOT NULL,
  `screen_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `created_at` datetime NOT NULL,
  `geo` text CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`id`, `text`, `screen_name`, `created_at`, `geo`) VALUES
(177681835860570000, '#xray #photography http://t.co/V0754xt1', 'ElbunitR', '2012-03-08 11:06:39', ''),
(177681836951090000, 'Amazing photography http://t.co/O76XbWpZ', 'AshLindley', '2012-03-08 11:06:39', ''),
(177681855020150000, 'Discount on wedding photography and cake packages. http://t.co/Jbou6Ccz', 'cakencamera', '2012-03-08 11:06:43', ''),
(177681866944560000, 'Commercial photography style.... imitating famous fasion Ads from: HUGI BOSS/ GUCCI/ BONT BLANC/ SALVADORE... http://t.co/LsA1M0ua', 'Haithamtaha', '2012-03-08 11:06:46', ''),
(177682831756100000, 'Top 10 Stunning WordPress Photography Themes http://t.co/8Kitk6Tp', 'rohitsa98120405', '2012-03-08 11:10:36', ''),
(177682861300790000, 'Wedding Photography - a brief debate http://t.co/DPXvhpFJ via @Photography49', 'Jorcamon', '2012-03-08 11:10:43', ''),
(177685384589870000, 'Una mirada al siglo pasado a través de los retratos de E.O. Hoppé #photography #fotografía #vintage #retro #fashion http://t.co/6TiS0Er1', 'RetroChicBCN', '2012-03-08 11:20:45', ''),
(177685395134360000, 'RT @culture_jammer2012Living Root Bridges #travel #culture #nature #photography  http://t.co/ir48tPaO http://t.co/KVazmBpl', 'jmTracking', '2012-03-08 11:20:47', ''),
(177685396120020000, 'RT @allensolly2012''Greenery'' at its poetic best #colorsofseason #photography #nature http://t.co/RRFRyhmj http://t.co/9TWbZppn', 'jmTracking', '2012-03-08 11:20:47', ''),
(177686724107970000, '#Photography - Themed Engagement Shoots - I love engagement shoots. Having the opportunity to capture a couple&#8217... http://t.co/NDg9X10Z', 'badaliator', '2012-03-08 11:26:04', ''),
(177686753489060000, 'Quotes Photography, Page Photography, Black And White Photography http://t.co/EKH29rbA', 'FaithJereza_1D', '2012-03-08 11:26:11', ''),
(177691429693420000, 'does anybody ( @KermodeMovie ?) know if Ken Russell''s stills photography ever made it into a book? The TopFoto stuff that was discovered', 'real_dubversion', '2012-03-08 11:44:46', ''),
(177691430620380000, 'Android photography yg suka foto editing bisa pake aplikasi kyak action snap,vignette,retrocamera,lomocamera,psexpress,camera360 ayo downlod', 'catfizerjabar', '2012-03-08 11:44:46', ''),
(177691448785900000, 'Personal photography http://t.co/3wbaAUKi', 'Lixchiber', '2012-03-08 11:44:51', ''),
(177693027324800000, 'Tulsa library employee and photography enthusiast Fancher captures shooting at ... Tulsa… http://t.co/pNkAcYGU', 'cameracompare', '2012-03-08 11:51:07', ''),
(177693035574990000, 'Save 83% on a half-day photography course in Bristol http://t.co/j1zN8aOW via @dealprobe', 'DealProbe', '2012-03-08 11:51:09', 'South Gloucestershire'),
(177693052440290000, '@JasmineRBradley should have took photography!! Easy way to get an A!! Keep trying xxxxxx', 'curlygirlywurly', '2012-03-08 11:51:13', ''),
(177693058576560000, 'Rave Reviews for Professional Images #Photography''s Tradeshow Photography and Onsite Printing Photography http://t.co/Qq2kfg1s', 'MarzanoPhotos', '2012-03-08 11:51:14', ''),
(177693062917660000, 'Did you know that Lucien Bull (1876-1972) was among others pioneer of High-Speed Photography and inventor of an... http://t.co/hvRf0I8D', 'waxplus', '2012-03-08 11:51:15', ''),
(177693082224030000, 'Made myself a little timeline cover for Cinamon Laughton Photography.... not a bad effort. Take a look and tell me what you think .', 'CinamonPicichic', '2012-03-08 11:51:20', ''),
(177693096497260000, '@raissanindya makasih ( ื▿ ืʃƪ) .cha liat si suka photography deh ava nya di ', 'andrea_sabilun', '2012-03-08 11:51:23', ''),
(177693099328420000, 'I''m at Azmieibra Photography Office (988, Lorong Serai Wangi 3/3, Taman Serai Wangi, Padang Serai) http://t.co/qnJ0TERW', 'azmieibra', '2012-03-08 11:51:24', ''),
(177693124796230000, 'Beautiful Photography by Tadeu Glowacki http://t.co/Z6QV9OYz', 'PhotographyBoss', '2012-03-08 11:51:30', ''),
(177693134510240000, 'Editing wedding images | cloning http://t.co/POe5ntz8', 'Inframe_Wedding', '2012-03-08 11:51:32', ''),
(177693147227370000, '40 Intriguing Examples of City Light Photography http://t.co/CqoR0YZm via @iznogoodgood @paul_steele @dbbstubbs @IvanTerzic', 'mathiasmattos', '2012-03-08 11:51:36', ''),
(177693148343060000, 'Inspirations found Photography Inspiration Week-26 http://t.co/EgdHrCwf #design #products', 'himundher', '2012-03-08 11:51:36', ''),
(177693155804710000, 'Cape Argus Cycle Tour 2012  Jurgens Photography http://t.co/AYEkCtw5', 'Francegbwis', '2012-03-08 11:51:37', ''),
(177693160712040000, 'Photographer t-shirt &gt; Nikon d4 http://t.co/zoUTZ6Lo #redbubble #nikon #photography #LeapYear.', 'g8keds', '2012-03-08 11:51:39', ''),
(177693162586900000, '@ConciergeUAE - Our highlights. Photo of Sheik Zayed Mosque on p14 (the word wow was used a lot) and Astrid Harrison''s horse photography!', 'AllThingsArabic', '2012-03-08 11:51:39', ''),
(177693174024770000, 'RT @HaidaPrincess: 75 #Landscapes & Seascapes #Photography by D Brightwell:  http://t.co/jMMLQPvH', 'tiger6300', '2012-03-08 11:51:42', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
