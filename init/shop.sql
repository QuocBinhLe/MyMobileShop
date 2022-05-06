-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2021 at 10:57 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(250) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `name` varchar(250) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL,
  `phone` varchar(13) NOT NULL,
  `address` varchar(250) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `email`, `name`, `phone`, `address`) VALUES
('admin', 'YWRtaW4=', 'gaughegom@gmail.com', 'Admin', '0774447653', '119 Hoàng Hoa Thám, Quy Nhơn, Bình Định');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `total_price` int(11) NOT NULL,
  `date` date NOT NULL,
  `state` int(11) NOT NULL,
  `address` varchar(400) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `note` varchar(20000) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `username`, `total_price`, `date`, `state`, `address`, `note`) VALUES
(4, 'gaughegom', 18000000, '2021-06-10', 1, '261 nguyen thai son', ''),
(5, 'gaughegom', 24000000, '2021-06-08', 1, '48 dong da', ''),
(59, 'test123', 18500000, '2021-06-19', 0, '132trg', 'zxczsh'),
(60, 'ngocanh123', 0, '2021-06-19', 0, '123 Nguyenx Ttrai Street', 'giao cho chi anh'),
(58, 'test123', 12500000, '2021-06-19', 0, '12345gha', 'sha132');

-- --------------------------------------------------------

--
-- Table structure for table `bill_info`
--

DROP TABLE IF EXISTS `bill_info`;
CREATE TABLE IF NOT EXISTS `bill_info` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_product`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `bill_info`
--

INSERT INTO `bill_info` (`id`, `id_product`, `number`) VALUES
(4, 1, 1),
(4, 2, 1),
(5, 1, 2),
(5, 2, 1),
(58, 2, 1),
(59, 2, 1),
(59, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `content_intro`
--

DROP TABLE IF EXISTS `content_intro`;
CREATE TABLE IF NOT EXISTS `content_intro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slogan` varchar(500) NOT NULL,
  `content_1` varchar(500) NOT NULL,
  `content_2` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `content_intro`
--

INSERT INTO `content_intro` (`id`, `slogan`, `content_1`, `content_2`) VALUES
(1, 'Web shop mobile', 'Slogan content 1 ...', 'Slogan content 2 ...');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `message` varchar(20000) NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `id_product`, `username`, `message`, `date`) VALUES
(16, 1, 'gaughegom', '1 sản phẩm tuyệt vời', '2021-06-19 00:00:00'),
(15, 2, 'gaughegom', 'Sản phẩm đáng giá', '2021-06-19 00:00:00'),
(17, 1, 'gaughegom', 'Tuyệt vời Nokia !!! ^^', '2021-06-19 09:30:30'),
(18, 2, 'gaughegom', 'Fan apple &lt;3 I love U 3000 apple', '2021-06-19 09:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_1` varchar(50) NOT NULL,
  `member_2` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `member_1`, `member_2`) VALUES
(1, 'Tráº§n BÃ¬nh', 'member 2');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `price` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `screen` varchar(100) NOT NULL,
  `ram` varchar(20) NOT NULL,
  `rom` varchar(20) NOT NULL,
  `cpu` varchar(30) NOT NULL,
  `gpu` varchar(30) NOT NULL,
  `camera_back` varchar(50) NOT NULL,
  `camera_front` varchar(50) NOT NULL,
  `pin` varchar(30) NOT NULL,
  `sim` varchar(30) NOT NULL,
  `operator` varchar(30) NOT NULL,
  `description` varchar(20000) DEFAULT NULL,
  `image` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `number`, `screen`, `ram`, `rom`, `cpu`, `gpu`, `camera_back`, `camera_front`, `pin`, `sim`, `operator`, `description`, `image`) VALUES
(1, 'Nokia 8.1', 6000000, 33, '6.18', '4 GB', '64 GB', '', 'Adreno 616', '12.0 MP + 13.0 MP', '', '3500 mAh', '2, Nano SIM', 'Android 9.0', '<h3><strong>Chá»¥p áº£nh selfie tuyá»‡t Ä‘áº¹p, d&ugrave; l&agrave; ng&agrave;y hay Ä‘&ecirc;m</strong></h3>\r\n\r\n<p>Vá»›i t&iacute;nh nÄƒng chá»¥p áº£nh thiáº¿u s&aacute;ng n&acirc;ng cao, camera selfie Ä‘á»™ ph&acirc;n giáº£i l&ecirc;n tá»›i 20MP cá»§a Nokia 8.1 váº«n chá»¥p tuyá»‡t Ä‘áº¹p d&ugrave; trong Ä‘iá»u kiá»‡n &aacute;nh s&aacute;ng yáº¿u. C&ocirc;ng nghá»‡ cáº£m biáº¿n th&iacute;ch á»©ng káº¿t há»£p 4 Ä‘iá»ƒm áº£nh l&agrave;m má»™t, thu s&aacute;ng vÆ°á»£t trá»™i. Äá»“ng thá»i Google Lens v&agrave; Motion Photo ngay trong á»©ng dá»¥ng camera máº·c Ä‘á»‹nh mang Ä‘áº¿n kháº£ nÄƒng quay video mÆ°á»£t m&agrave;, Ä‘á»ƒ báº¡n lÆ°u láº¡i cáº£ tháº¿ giá»›i trong khung h&igrave;nh.</p>\r\n\r\n<p><img alt="" src="https://fptshop.com.vn/Uploads/images/2015/Tin-Tuc/QuanLNH2/nokia-81-2.jpg" /></p>\r\n\r\n<h3><strong>Camera k&eacute;p á»‘ng k&iacute;nh ZEISS chuy&ecirc;n nghiá»‡p</strong></h3>\r\n\r\n<p>Nhá»¯ng th&ocirc;ng sá»‘ pháº§n cá»©ng tuyá»‡t vá»i gi&uacute;p Ä‘iá»‡n thoáº¡i Nokia 8.1 chá»¥p áº£nh nhÆ° m&aacute;y áº£nh chuy&ecirc;n nghiá»‡p. Nhá» cá»¥m camera k&eacute;p 12MP + 13MP á»‘ng k&iacute;nh ZEISS, Nokia 8.1 mang tá»›i nhá»¯ng bá»©c áº£nh ch&acirc;n thá»±c Ä‘áº¿n kh&oacute; tin. C&ocirc;ng nghá»‡ chá»‘ng rung quang há»c OIS v&agrave; cáº£m biáº¿n si&ecirc;u nháº¡y sáº½ cá»±c ká»³ c&oacute; &iacute;ch khi chá»¥p Ä‘&ecirc;m, &aacute;nh s&aacute;ng Ä‘Æ°á»£c thu láº¡i Ä‘áº§y Ä‘á»§, h&igrave;nh áº£nh Ä‘áº¹p lung linh d&ugrave; l&agrave; trong Ä‘&ecirc;m tá»‘i.</p>\r\n', 'nokia-8.1.jpg'),
(2, 'Iphone 12 pro max', 12500000, 32, '6.7", Super Retina XDR, AMOLED, 2778 x 1284 Pixel 6.7"', '6 GB', '128 GB', 'A14 Bionic', 'Apple GPU 4 nhÃ¢n', '12.0 MP + 12.0 MP + 12.0 MP', '', '3687 mAh', '2, 1 eSIM, 1 Nano SIM', 'iOS 14', '<p>Iphone 12 vá»›i hiá»‡u nÄƒng máº¡nh máº½ l&agrave; 1 sáº£n pháº©m Ä‘&aacute;ng mong chá» trong nÄƒm 2021</p>\r\n\r\n<p>Vá»›i kiá»ƒu d&aacute;ng sang trá»ng cháº¯c cháº¯n iphone sáº½ kh&ocirc;ng l&agrave;m báº¡n tháº¥t vá»ng</p>\r\n', 'Iphone-12-plus.png'),
(11, 'Sumsung A51', 3500000, 24, '', '', '', '', '', '', '', '', '', '', '', 'samsung-a51.jpg'),
(12, 'Iphone 11 64GB', 15900000, 1, '6.1", Liquid Retina HD, IPS LCD, 828 x 1792 Pixel', '4 GB', '64 GB', 'A13 Bionic', 'Apple GPU 4 nhÃ¢n', '12.0 MP + 12.0 MP', '', '3110 mAh', '2, 1 eSIM, 1 Nano SIM', 'iOS 14', '<p style="text-align:justify"><span style="font-size:11pt"><span style="background-color:white"><span style="font-family:Arial,sans-serif"><strong><span style="font-size:12.0pt"><span style="font-family:Roboto"><span style="color:#212529">Rá»±c rá»¡ sáº¯c m&agrave;u, thá»ƒ hiá»‡n c&aacute; t&iacute;nh</span></span></span></strong></span></span></span></p>\r\n\r\n<p style="text-align:justify"><span style="font-size:11pt"><span style="background-color:white"><span style="font-family:Arial,sans-serif"><span style="font-size:12.0pt"><span style="font-family:Roboto"><span style="color:#495057">C&oacute; tá»›i 6 sá»± lá»±a chá»n m&agrave;u sáº¯c cho iPhone 11 64GB, bao gá»“m T&iacute;m, V&agrave;ng, Xanh lá»¥c, Äen, Tráº¯ng v&agrave; Äá», tha há»“ Ä‘á»ƒ báº¡n lá»±a chá»n m&agrave;u ph&ugrave; há»£p vá»›i sá»Ÿ th&iacute;ch, c&aacute; t&iacute;nh ri&ecirc;ng cá»§a báº£n th&acirc;n. Váº» Ä‘áº¹p cá»§a iPhone 11 Ä‘áº¿n tá»« thiáº¿t káº¿ cao cáº¥p khi Ä‘Æ°á»£c l&agrave;m tá»« khung nh&ocirc;m nguy&ecirc;n khá»‘i v&agrave; máº·t lÆ°ng liá»n láº¡c vá»›i má»™t táº¥m k&iacute;nh duy nháº¥t. á»ž máº·t trÆ°á»›c, báº¡n sáº½ Ä‘Æ°á»£c chi&ecirc;m ngÆ°á»¡ng m&agrave;n h&igrave;nh Liquid Retina lá»›n 6,1 inch, m&agrave;u sáº¯c v&ocirc; c&ugrave;ng ch&acirc;n thá»±c. Táº¥t cáº£ táº¡o n&ecirc;n chiáº¿c Ä‘iá»‡n thoáº¡i tr&agrave;n Ä‘áº§y há»©ng khá»Ÿi.</span></span></span></span></span></span></p>\r\n\r\n<h3 style="text-align:justify"><span style="font-size:13.5pt"><span style="background-color:white"><span style="font-family:&quot;Times New Roman&quot;,serif"><strong><strong><span style="font-size:12.0pt"><span style="font-family:Roboto"><span style="color:#212529">Há»‡ thá»‘ng camera k&eacute;p má»›i</span></span></span></strong></strong></span></span></span></h3>\r\n\r\n<p style="text-align:justify"><span style="font-size:12pt"><span style="background-color:white"><span style="font-family:&quot;Times New Roman&quot;,serif"><span style="font-family:Roboto"><span style="color:#495057">Apple iPhone 11 sá»Ÿ há»¯u cá»¥m camera k&eacute;p máº·t sau, bao gá»“m camera g&oacute;c rá»™ng v&agrave; camera g&oacute;c si&ecirc;u rá»™ng. Cáº£m biáº¿n camera g&oacute;c rá»™ng 12MP c&oacute; kháº£ nÄƒng láº¥y n&eacute;t tá»± Ä‘á»™ng nhanh gáº¥p 3 láº§n trong Ä‘iá»u kiá»‡n thiáº¿u s&aacute;ng. B&ecirc;n cáº¡nh Ä‘&oacute; cáº£m biáº¿n g&oacute;c si&ecirc;u rá»™ng cho kháº£ nÄƒng chá»¥p cáº£nh rá»™ng gáº¥p 4 láº§n, l&agrave; phÆ°Æ¡ng tiá»‡n ghi h&igrave;nh tuyá»‡t vá»i cho nhá»¯ng chuyáº¿n du lá»‹ch, chá»¥p h&igrave;nh nh&oacute;m. Nhanh ch&oacute;ng chá»¥p áº£nh, quay video, chá»‰nh sá»­a v&agrave; chia sáº» ngay tr&ecirc;n&nbsp;iPhone, báº¡n sáº½ kh&ocirc;ng bá» lá»¡ báº¥t cá»© khoáº£nh kháº¯c Ä‘&aacute;ng nhá»› n&agrave;o.</span></span></span></span></span></p>\r\n', 'iphone-11.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_hot`
--

DROP TABLE IF EXISTS `product_hot`;
CREATE TABLE IF NOT EXISTS `product_hot` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_hot`
--

INSERT INTO `product_hot` (`id`) VALUES
(2),
(12);

-- --------------------------------------------------------

--
-- Table structure for table `social_network`
--

DROP TABLE IF EXISTS `social_network`;
CREATE TABLE IF NOT EXISTS `social_network` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotline` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `youtube` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `social_network`
--

INSERT INTO `social_network` (`id`, `hotline`, `email`, `facebook`, `youtube`, `instagram`, `twitter`) VALUES
(1, '0345333666', 'shop123@mail.com', 'https://www.facebook.com/', 'https://www.youtube.com/', 'https://www.instagram.com/', 'https://twitter.com/?lang=vi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(250) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 NOT NULL,
  `phone` varchar(13) CHARACTER SET utf8 DEFAULT NULL,
  `realname` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `date_create` date DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `email`, `phone`, `realname`, `date_create`, `level`) VALUES
('gaughegom', 'MTIzNDU2', 'gaughegom@gmail.com', '7747547654', 'Hung Nguyen', '2021-06-10', 0),
('test123', 'MTIz', 'gaughegom@gmail.com', '0935224785', 'Test user 123', '2021-06-18', 0),
('ngocanh123', 'MTIzMTIz', 'ngoc@gmail.com', '123132132', 'NGoc Anh', NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
