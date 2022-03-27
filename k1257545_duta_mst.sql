/*
SQLyog Professional v10.42 
MySQL - 5.5.34 : Database - k1257545_duta_mst
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `ms_anggota` */

DROP TABLE IF EXISTS `ms_anggota`;

CREATE TABLE `ms_anggota` (
  `cKdAnggota` varchar(30) NOT NULL,
  `vNmAnggota` varchar(150) DEFAULT NULL,
  `cKdGroupAgt` char(5) DEFAULT NULL,
  `cAlamat` varchar(150) DEFAULT NULL,
  `cKota` varchar(50) DEFAULT NULL,
  `cTelp` varchar(15) DEFAULT NULL,
  `cEmail` varchar(150) DEFAULT NULL,
  `cTmpLahir` varchar(50) DEFAULT NULL,
  `dTglLahir` datetime DEFAULT NULL,
  `cJenisKelamin` char(4) DEFAULT NULL,
  `cAgama` char(4) DEFAULT NULL,
  `cLimitPinjam` decimal(18,2) DEFAULT NULL,
  `dTglMulai` datetime DEFAULT NULL,
  `dTglAkhir` datetime DEFAULT NULL,
  `vBidangUsaha` varchar(100) DEFAULT NULL,
  `cFoto` blob,
  `cStatus` char(4) DEFAULT NULL,
  `cKdEntity` char(4) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  `cKdSubGroupAgt` char(10) DEFAULT NULL,
  `cKdPegawai` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cKdAnggota`),
  UNIQUE KEY `PK_Ms_Anggota` (`cKdAnggota`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_anggota` */

/*Table structure for table `ms_anggota_simpanan` */

DROP TABLE IF EXISTS `ms_anggota_simpanan`;

CREATE TABLE `ms_anggota_simpanan` (
  `cIdx` int(10) DEFAULT NULL,
  `cAngDt` varchar(35) NOT NULL,
  `cKdAnggota` varchar(30) DEFAULT NULL,
  `cKdProduk` varchar(5) DEFAULT NULL,
  `vNilai` decimal(18,2) DEFAULT NULL,
  `cStatus` char(3) DEFAULT NULL,
  PRIMARY KEY (`cAngDt`),
  UNIQUE KEY `PK_Ms_Anggota_Produk` (`cAngDt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_anggota_simpanan` */

/*Table structure for table `ms_anggotagrp` */

DROP TABLE IF EXISTS `ms_anggotagrp`;

CREATE TABLE `ms_anggotagrp` (
  `cKdGroupAgt` char(5) NOT NULL,
  `cNmGroupAgt` varchar(50) DEFAULT NULL,
  `vNmCP` varchar(150) DEFAULT NULL,
  `cTelpCP` varchar(15) DEFAULT NULL,
  `cEmailCP` varchar(150) DEFAULT NULL,
  `cKdEntity` char(3) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdGroupAgt`),
  UNIQUE KEY `PK_Ms_AnggotaGrp` (`cKdGroupAgt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_anggotagrp` */

/*Table structure for table `ms_anggotasubgrp` */

DROP TABLE IF EXISTS `ms_anggotasubgrp`;

CREATE TABLE `ms_anggotasubgrp` (
  `cKdSubGroupAgt` char(10) NOT NULL,
  `cNmSubGroupAgt` varchar(50) DEFAULT NULL,
  `cKdGroupAgt` char(5) DEFAULT NULL,
  `vNmCP` varchar(150) DEFAULT NULL,
  `cTelpCP` varchar(15) DEFAULT NULL,
  `cEmailCP` varchar(150) DEFAULT NULL,
  `cKdEntity` char(3) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdSubGroupAgt`),
  UNIQUE KEY `PK_Ms_AnggotaSubGrp` (`cKdSubGroupAgt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_anggotasubgrp` */

/*Table structure for table `ms_bank` */

DROP TABLE IF EXISTS `ms_bank`;

CREATE TABLE `ms_bank` (
  `cKdBank` char(3) NOT NULL,
  `vNmBank` varchar(100) DEFAULT NULL,
  `cAlamat` varchar(250) DEFAULT NULL,
  `cKota` varchar(50) DEFAULT NULL,
  `cTelp` varchar(15) DEFAULT NULL,
  `cFax` varchar(15) DEFAULT NULL,
  `cEmail` varchar(150) DEFAULT NULL,
  `cNoRekening` varchar(50) DEFAULT NULL,
  `cKdCOA` varchar(15) DEFAULT NULL,
  `cStatus` char(1) DEFAULT NULL,
  `cNoTransIn` varchar(5) DEFAULT NULL,
  `cNoTransOut` varchar(5) DEFAULT NULL,
  `cKdEntity` char(3) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdBank`),
  UNIQUE KEY `PK_Ms_Bank` (`cKdBank`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_bank` */

/*Table structure for table `ms_barang` */

DROP TABLE IF EXISTS `ms_barang`;

CREATE TABLE `ms_barang` (
  `cKdBarang` char(30) NOT NULL,
  `vNamaBarang` varchar(250) DEFAULT NULL,
  `cKdGrupBarang` char(5) DEFAULT NULL,
  `cSatuan` char(3) DEFAULT NULL,
  `cJenis` char(1) DEFAULT NULL,
  `cFlagProdKey` char(1) DEFAULT NULL,
  `cStatus` char(1) DEFAULT NULL,
  `vStockMinimum` decimal(18,2) DEFAULT NULL,
  `cKeterangan` varchar(250) DEFAULT NULL,
  `cStock` char(3) DEFAULT NULL,
  `cCOAStock` varchar(15) DEFAULT NULL,
  `cBeli` char(3) DEFAULT NULL,
  `cCOABeli` varchar(15) DEFAULT NULL,
  `cJual` char(3) DEFAULT NULL,
  `cCOAJual` varchar(15) DEFAULT NULL,
  `vHargaJual` decimal(18,2) DEFAULT NULL,
  `vHargaBeli` decimal(18,2) DEFAULT NULL,
  `vImagePath` varchar(255) DEFAULT NULL,
  `cShowAndroid` char(1) DEFAULT 'F',
  `cKdEntity` char(3) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdBarang`),
  UNIQUE KEY `PK_Ms_Barang` (`cKdBarang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_barang` */

insert  into `ms_barang`(`cKdBarang`,`vNamaBarang`,`cKdGrupBarang`,`cSatuan`,`cJenis`,`cFlagProdKey`,`cStatus`,`vStockMinimum`,`cKeterangan`,`cStock`,`cCOAStock`,`cBeli`,`cCOABeli`,`cJual`,`cCOAJual`,`vHargaJual`,`vHargaBeli`,`vImagePath`,`cShowAndroid`,`cKdEntity`,`cUserCreated`,`dDateCreated`,`cUserModify`,`dDateModify`) values ('A01','BURGER','MKN','PCS','1',NULL,'F',0.00,'TEST',NULL,NULL,NULL,NULL,NULL,NULL,24000.00,NULL,'/uploads/files/hidup_sehat_hindari_makanan_cepat_saji.jpg','T',NULL,'1','2015-01-16 23:13:28','1','2015-03-31 09:53:36'),('A02','PIE','MKN','PCS','1',NULL,'T',0.00,'',NULL,NULL,NULL,NULL,NULL,NULL,25000.00,NULL,'/uploads/files/Kue-Pie-Cherry.jpg','T',NULL,'1','2015-01-17 03:07:48','1','2015-03-14 15:07:12'),('123','pizza','MKN','PCS','1',NULL,'T',0.00,'makaroni',NULL,NULL,NULL,NULL,NULL,NULL,5000.00,NULL,'/uploads/files/pizza.jpg','T',NULL,'1','2015-01-17 07:56:36','1','2015-03-14 15:16:06'),('2232','pangsit','MKN','PCS','1',NULL,'T',0.00,'',NULL,NULL,NULL,NULL,NULL,NULL,23000.00,NULL,'/uploads/files/makanan-Indonesia.jpeg','T',NULL,'1','2015-02-06 16:14:26','1','2015-03-14 15:07:03'),('43434','spagheti','MKN','PCS','1',NULL,'T',0.00,'',NULL,NULL,NULL,NULL,NULL,NULL,25000.00,NULL,'/uploads/files/sphageti.jpg','T',NULL,'1','2015-02-06 16:15:04','1','2015-03-14 15:16:23'),('5454','late','MNU','PCS','1',NULL,'F',0.00,'',NULL,NULL,NULL,NULL,NULL,NULL,19000.00,NULL,'/uploads/files/vanila-late.jpg','T',NULL,'1','2015-02-06 16:15:38','1','2015-02-06 16:15:38'),('12133','SALAD','2332','PCS','1',NULL,'T',0.00,'',NULL,NULL,NULL,NULL,NULL,NULL,15000.00,NULL,'/uploads/files/SALAD.jpg','T',NULL,'1','2015-02-06 16:18:23','1','2015-02-06 16:18:23'),('8989','JUS ALPUKAT','MNU','PCS','1',NULL,'F',0.00,'',NULL,NULL,NULL,NULL,NULL,NULL,15000.00,NULL,'/uploads/files/jus_alpukat.JPG','T',NULL,'1','2015-02-06 16:24:31','1','2015-02-06 16:24:31'),('090778','es selasih','MNU','PCS','1',NULL,'T',0.00,'',NULL,NULL,NULL,NULL,NULL,NULL,20000.00,NULL,'/uploads/files/es_buah.jpg','T',NULL,'1','2015-02-06 16:26:16','1','2015-02-06 16:26:16'),('344411','Teh manis','MNU','PCS','1',NULL,'T',0.00,'',NULL,NULL,NULL,NULL,NULL,NULL,9000.00,NULL,'/uploads/files/Foto-1-Minuman-Unik-di-Indonesia.jpg','T',NULL,'1','2015-02-06 16:29:48','1','2015-02-06 16:29:48'),('23456','kopi','MNU','PCS','1',NULL,'F',0.00,'2000',NULL,NULL,NULL,NULL,NULL,NULL,2500.00,NULL,'/uploads/files/1280X800_04.jpg','T',NULL,'1','2015-02-08 08:14:16','7','2015-03-25 14:47:27'),('R0001','TERIGU','RAW','GRM','1',NULL,'T',0.00,'',NULL,NULL,NULL,NULL,NULL,NULL,0.00,NULL,'','F',NULL,'1','2015-03-14 17:04:34','1','2015-03-14 17:05:12'),('R0002','TELOR','RAW','GRM','1',NULL,'T',0.00,'',NULL,NULL,NULL,NULL,NULL,NULL,0.00,NULL,'','F',NULL,'1','2015-03-14 17:05:04','1','2015-03-14 17:05:04'),('R0003','ROTI','RAW','PCS','1',NULL,'T',0.00,'',NULL,NULL,NULL,NULL,NULL,NULL,0.00,NULL,'','F',NULL,'1','2015-03-14 17:05:40','1','2015-03-14 17:05:40'),('R0004','KEJU','RAW','PCS','1',NULL,'T',0.00,'',NULL,NULL,NULL,NULL,NULL,NULL,0.00,NULL,'','F',NULL,'1','2015-03-14 17:06:04','1','2015-03-14 17:06:04'),('R0005','DAGING','RAW','PCS','1',NULL,'T',0.00,'',NULL,NULL,NULL,NULL,NULL,NULL,0.00,NULL,'','F',NULL,'1','2015-03-14 17:06:35','1','2015-03-14 17:06:35'),('paket2','fish & potato','MKN','PCS','1',NULL,'F',0.00,'paket hemat pagi',NULL,NULL,NULL,NULL,NULL,NULL,20000.00,NULL,'/uploads/files/dvqIxEAMaz.jpg','T',NULL,'1','2015-03-28 07:47:49','1','2015-03-31 09:53:50'),('dlg-main-01','Bee Hoon','DLG04','PCS','1',NULL,'F',0.00,'fried vermicelli with chicken, shrimps and vegetables served with prickles',NULL,NULL,NULL,NULL,NULL,NULL,40000.00,NULL,'/uploads/files/behoon_1_1.jpg','F',NULL,'1','2015-03-31 05:22:48','1','2015-03-31 05:22:48'),('DLG-DES-01','APPLE PIE','DLG06','PCS','1',NULL,'F',0.00,'home made apple pie from dia.lo.gue',NULL,NULL,NULL,NULL,NULL,NULL,30000.00,NULL,'/uploads/files/apple_pie_1_1.jpg','F',NULL,'1','2015-03-31 05:07:32','1','2015-03-31 05:07:32'),('dlg-papiz-01','DIA.LO.GUE PIZZA','DLG03','PCS','1',NULL,'F',0.00,'crusty pizza topped with beef salami, mozarella cheese sprinkle and with black olive',NULL,NULL,NULL,NULL,NULL,NULL,60000.00,NULL,'/uploads/files/dialogue_pizza_1_1.jpg','F',NULL,'1','2015-03-31 05:24:20','1','2015-03-31 05:24:20'),('dlg-main-02','GINDARA FISH AND CHIPS','DLG04','PCS','1',NULL,'F',0.00,'gindara fish and chips with tartare sauce sered with french fries and green salads',NULL,NULL,NULL,NULL,NULL,NULL,65000.00,NULL,'/uploads/files/fish_and_chips.jpg','F',NULL,'1','2015-03-31 05:21:09','1','2015-03-31 05:21:09'),('dlg-bfast-01','French Toast','DLG01','PCS','1',NULL,'F',0.00,'french toast served with fresh strawberry and mapple syrup',NULL,NULL,NULL,NULL,NULL,NULL,30000.00,NULL,'/uploads/files/french_toast.jpg','F',NULL,'1','2015-03-31 05:27:10','1','2015-03-31 05:27:10'),('LCD-DES-01','ZUCCOTTO','LCD12','PCS','1',NULL,'T',0.00,'layer of chocolate, vanilla and strawberry ice cream with chocolate counventure',NULL,NULL,NULL,NULL,NULL,NULL,55000.00,NULL,'/uploads/files/zucotto_1_1.jpg','T',NULL,'1','2015-03-31 06:37:06','1','2015-03-31 10:18:08'),('dlg-sosalfoods-01','Goulash Soup','DLG02','PCS','1',NULL,'F',0.00,'aussie beef goulash soup served with slice of toasted bread',NULL,NULL,NULL,NULL,NULL,NULL,40000.00,NULL,'/uploads/files/goulash_soup_1_1.jpg','F',NULL,'1','2015-03-31 05:35:26','1','2015-03-31 05:35:26'),('dlg-drnks-01','Ice Chocolate','DLG07','PCS','1',NULL,'F',0.00,'ice with chocolate',NULL,NULL,NULL,NULL,NULL,NULL,40000.00,NULL,'/uploads/files/ice_chocolate.jpg','F',NULL,'1','2015-03-31 05:37:07','1','2015-03-31 05:37:07'),('dlg-main-03','KWETIAU GORENG','DLG04','PCS','1',NULL,'F',0.00,'kwetiau goreng stirred pan-fried flat wide rice noodles with chicken/shrimp topped with bean sprouts, coliander leaf and chili ',NULL,NULL,NULL,NULL,NULL,NULL,40000.00,NULL,'/uploads/files/kwetiaw.jpg','F',NULL,'1','2015-03-31 05:39:39','1','2015-03-31 05:39:39'),('dlg-main-04','MEXICANA BURGER','DLG04','PCS','1',NULL,'F',0.00,'grilled beef served with homemade potato chips and salsa',NULL,NULL,NULL,NULL,NULL,NULL,58000.00,NULL,'/uploads/files/mexicana_burger.jpg','F',NULL,'1','2015-03-31 05:40:55','1','2015-03-31 05:40:55'),('dlg-drnks-02','NATURAL MOJITO','DLG07','PCS','1',NULL,'F',0.00,'',NULL,NULL,NULL,NULL,NULL,NULL,35000.00,NULL,'/uploads/files/natural_mojito.jpg','F',NULL,'1','2015-03-31 05:42:02','1','2015-03-31 05:42:02'),('dlg-drnks-03','ice flavoured tea ICE LYCHEE / PEPPERMINT / PEPPERMINT APPLE','DLG07','PCS','1',NULL,'F',0.00,'ice flavoured tea with 3 different choices, ice lychee, peppermint, or peppermint apple',NULL,NULL,NULL,NULL,NULL,NULL,35000.00,NULL,'/uploads/files/peppermint_ice_tea.jpg','F',NULL,'1','2015-03-31 05:45:05','1','2015-03-31 05:45:05'),('dlg-drnks-04','FRESH JUICES watermellon / melo / lime','DLG07','PCS','1',NULL,'F',0.00,'fresh juice made from fresh fruits. with 3 choices, watermelon, melon, or lime',NULL,NULL,NULL,NULL,NULL,NULL,25000.00,NULL,'/uploads/files/water_melon_juice.jpg','F',NULL,'1','2015-03-31 05:47:21','1','2015-03-31 05:47:21'),('LCD-APP-01','SINCHOS','LCD06','PCS','1',NULL,'T',0.00,'traditional singkong crackers, yellow cheddar sauce and truffle oil',NULL,NULL,NULL,NULL,NULL,NULL,55000.00,NULL,'/uploads/files/sinchos_55k_1.jpg','T',NULL,'1','2015-03-31 06:35:34','1','2015-03-31 09:24:06'),('LCD-DES-02','BAILEYS MARTABAK','LCD12','PCS','1',NULL,'T',0.00,'chcolate baileys mousse and strawberry',NULL,NULL,NULL,NULL,NULL,NULL,60000.00,NULL,'/uploads/files/baileys_martabak_1.jpg','T',NULL,'1','2015-03-31 06:38:19','1','2015-03-31 10:16:50'),('LCD-APP-02','CAESAR SALAD','LCD06','PCS','1',NULL,'T',0.00,'caesar salad with classic dressing, grilled chicken breast and cheese ravioli',NULL,NULL,NULL,NULL,NULL,NULL,60000.00,NULL,'/uploads/files/caesar_salad.jpg','T',NULL,'1','2015-03-31 06:40:55','1','2015-03-31 09:23:47'),('LCD-NOR-01','SPAGHETTI TELOR ASIN','LCD04','PCS','1',NULL,'T',0.00,'spicy telor asin and crispy duck',NULL,NULL,NULL,NULL,NULL,NULL,90000.00,NULL,'/uploads/files/spagheti_telor_asin.jpg','T',NULL,'1','2015-03-31 06:44:03','1','2015-03-31 09:55:00'),('LCD-PIZ-01','WHITE TRUFFLE PIZZA','LCD08','PCS','1',NULL,'T',0.00,'mozarella, tomato, and italian parma ham',NULL,NULL,NULL,NULL,NULL,NULL,85000.00,NULL,'/uploads/files/white_truffle_pizza.jpg','T',NULL,'1','2015-03-31 06:45:43','1','2015-03-31 09:55:17'),('LCD-NOR-02','KLUWEK FRIED RICE','LCD04','PCS','1',NULL,'T',0.00,'with chicken leg, prawn and crackers',NULL,NULL,NULL,NULL,NULL,NULL,95000.00,NULL,'/uploads/files/nasi_goreng_kluwek.jpg','T',NULL,'1','2015-03-31 06:48:01','1','2015-03-31 09:57:10'),('LCD-PAS-01','FETTUCCINE MUSHROOMS AND HAM','LCD09','PCS','1',NULL,'T',0.00,'homemade fettuccine pasta with speck ham and wild mushroom',NULL,NULL,NULL,NULL,NULL,NULL,85000.00,NULL,'/uploads/files/Fettucinii_mushroom_and_ham.jpg','T',NULL,'1','2015-03-31 06:53:25','1','2015-03-31 09:56:13'),('LCD-PAS-02','RAVIOLI SPINACH','LCD09','PCS','1',NULL,'T',0.00,'homemade ravioli filled with spinach, ricotta cheese and tomato',NULL,NULL,NULL,NULL,NULL,NULL,85000.00,NULL,'/uploads/files/ravioli_spinach.jpg','T',NULL,'1','2015-03-31 06:56:44','1','2015-03-31 09:55:41'),('LCD-PAS-03','PULLED PORK RAVIOLONE','LCD09','PCS','1',NULL,'T',0.00,'pulled pork raviolone with smoked mozzarella and truffle oil',NULL,NULL,NULL,NULL,NULL,NULL,80000.00,NULL,'/uploads/files/pulled_pork_raviolone.jpg','T',NULL,'1','2015-03-31 07:01:20','1','2015-03-31 09:55:58'),('LCD-MSE-01','GRILLED SALMON','LCD10','PCS','1',NULL,'T',0.00,'grilled salmon with potato, baby long bean and mediteranian sauce',NULL,NULL,NULL,NULL,NULL,NULL,125000.00,NULL,'/uploads/files/salmon_steak.jpg','T',NULL,'1','2015-03-31 07:04:34','1','2015-03-31 09:54:18'),('LCD-DES-03','MELTED CHOCO CAKE','LCD12','PCS','1',NULL,'T',0.00,'melted choco cake with wild berry and rum raisin ice cream',NULL,NULL,NULL,NULL,NULL,NULL,60000.00,NULL,'/uploads/files/lava_cake.jpg','T',NULL,'1','2015-03-31 07:06:28','1','2015-03-31 10:17:52'),('LCD-PAS-04','ANGEL HAIR','LCD09','PCS','1',NULL,'T',0.00,'with tiger prawn, garlic and chili olive oil',NULL,NULL,NULL,NULL,NULL,NULL,120000.00,NULL,'/uploads/files/angel_hair_120.jpg','T',NULL,'1','2015-03-31 07:54:02','1','2015-03-31 09:56:24'),('LCD-DES-04','CASTANGEL MOLLICA','LCD12','PCS','1',NULL,'T',0.00,'mama cookies crumbld modified on our special cake',NULL,NULL,NULL,NULL,NULL,NULL,55000.00,NULL,'/uploads/files/castangel_mollica.jpg','T',NULL,'1','2015-03-31 07:56:10','1','2015-03-31 10:17:08'),('LCD-EBT-01','CIGAR PRAWNS','LCD07','PCS','1',NULL,'T',0.00,'cigar prawns with sweet sour chilli',NULL,NULL,NULL,NULL,NULL,NULL,60000.00,NULL,'/uploads/files/cigar_prawn_1.jpg','T',NULL,'1','2015-03-31 08:10:08','1','2015-03-31 09:50:48'),('LCD-MSE-02','GRILLED SPRING CHICKEN','LCD10','PCS','1',NULL,'T',0.00,'grilled spring chicken with mashed tomatoes and spiced tomato sauce',NULL,NULL,NULL,NULL,NULL,NULL,120000.00,NULL,'/uploads/files/garlic_spring_chicken.jpg','T',NULL,'1','2015-03-31 08:12:37','1','2015-03-31 09:54:37'),('LCD-SEA-01','KAI PAD PRIK KLEA','LCD02','PCS','1',NULL,'T',0.00,'fried king prawn with black pepper',NULL,NULL,NULL,NULL,NULL,NULL,80000.00,NULL,'/uploads/files/kai_phad_prik_klea.jpg','T',NULL,'1','2015-03-31 08:15:01','1','2015-03-31 10:26:11'),('LCD-DES-05','LUK CHUP','LCD12','PCS','1',NULL,'T',0.00,'mixed ice, jack fruit, yioung coconut, and jikama ala thai',NULL,NULL,NULL,NULL,NULL,NULL,40000.00,NULL,'/uploads/files/luk_chup_50.jpg','T',NULL,'1','2015-03-31 08:16:40','1','2015-03-31 10:17:24'),('LCD-DES-06','MANCIAM','LCD12','PCS','1',NULL,'T',0.00,'thai cassava cake with coconut milk',NULL,NULL,NULL,NULL,NULL,NULL,50000.00,NULL,'/uploads/files/manciam_50k.jpg','T',NULL,'1','2015-03-31 08:17:49','1','2015-03-31 10:17:40'),('LCD-SOU-01','TOM YAM KUNG','LCD05','PCS','1',NULL,'T',0.00,'spicy and sour prawn soup',NULL,NULL,NULL,NULL,NULL,NULL,65000.00,NULL,'/uploads/files/tom_yum_kum.jpg','T',NULL,'1','2015-03-31 08:19:06','1','2015-03-31 09:54:48'),('LCD-NOR-03','UDON GORENG JAWA','LCD04','PCS','1',NULL,'T',0.00,'japanese noodle, beef, vegetables in javanese style',NULL,NULL,NULL,NULL,NULL,NULL,70000.00,NULL,'/uploads/files/udon_goreng_jawa.jpg','T',NULL,'1','2015-03-31 08:20:31','1','2015-03-31 09:56:51'),('dlg-drnks-05','avocado / vanilla ICE BLEND + OREO','DLG07','PCS','1',NULL,'F',0.00,'Ice blend with 2 flavour choices, avocado or vanilla. \r\navailable in 30k or 35k',NULL,NULL,NULL,NULL,NULL,NULL,35000.00,NULL,'/uploads/files/avocado_oreo.jpg','F',NULL,'1','2015-03-31 08:48:11','1','2015-03-31 08:48:11'),('dlg-drnks-07','CAPPUCINNO, COFFEE LATTE','DLG07','PCS','1',NULL,'F',0.00,'',NULL,NULL,NULL,NULL,NULL,NULL,35000.00,NULL,'/uploads/files/cappucino.jpg','F',NULL,'1','2015-03-31 08:49:41','1','2015-03-31 08:49:41'),('DLG-DES-02','POFFERTJES with vanilla or choco ice cream','DLG06','PCS','1',NULL,'F',0.00,'poffertjes served with ice cream',NULL,NULL,NULL,NULL,NULL,NULL,35000.00,NULL,'/uploads/files/poffertjes_with_vanilla_ice_cream.jpg','F',NULL,'1','2015-03-31 08:59:16','1','2015-03-31 08:59:16'),('dlg-main-05','exotic GREEN GRILLED CHICKEN / SHRIMP','DLG04','PCS','1',NULL,'F',0.00,'served with sunny egg, shrimp crackers and prickles\r\nAvailable at 50k and 55k',NULL,NULL,NULL,NULL,NULL,NULL,55000.00,NULL,'/uploads/files/grilled_chicken_spaghety.jpg','F',NULL,'1','2015-03-31 09:07:59','1','2015-03-31 09:07:59'),('dlg-main-06','GRILLED CHICKEN with spagetti','DLG04','PCS','1',NULL,'F',0.00,'served with spagetti rosemary, oregano and fresh salads',NULL,NULL,NULL,NULL,NULL,NULL,55000.00,NULL,'/uploads/files/grilled_chicken_spaghety_1.jpg','F',NULL,'1','2015-03-31 09:10:01','1','2015-03-31 09:10:01'),('dlg-papiz-02','SMOKED BEEF PIZZA','DLG03','PCS','1',NULL,'F',0.00,'served with onion, paprika, mushrooms, black olive, mozarella',NULL,NULL,NULL,NULL,NULL,NULL,50000.00,NULL,'/uploads/files/smoked_beef_pizza.jpg','F',NULL,'1','2015-03-31 09:12:11','1','2015-03-31 09:12:11'),('dlg-papiz-03','PIZZA CON FUNGHI','DLG03','PCS','1',NULL,'F',0.00,'crunchy italian pizza con funghi with mushrooms, mozarella and parmesan cheese',NULL,NULL,NULL,NULL,NULL,NULL,40000.00,NULL,'/uploads/files/crunchy_italian_pizza.jpg','F',NULL,'1','2015-03-31 09:15:06','1','2015-03-31 09:15:06');

/*Table structure for table `ms_coa` */

DROP TABLE IF EXISTS `ms_coa`;

CREATE TABLE `ms_coa` (
  `cKdCOA` varchar(15) NOT NULL,
  `vNmCOA` varchar(150) DEFAULT NULL,
  `cType` char(1) DEFAULT NULL,
  `cJurnal` char(1) DEFAULT NULL,
  `cCB` char(1) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdCOA`),
  UNIQUE KEY `PK_Ms_COA` (`cKdCOA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_coa` */

insert  into `ms_coa`(`cKdCOA`,`vNmCOA`,`cType`,`cJurnal`,`cCB`,`cUserCreated`,`dDateCreated`,`cUserModify`,`dDateModify`) values ('10000','AKTIVA','1','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('11000','Kas','2','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('11001','Kas','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('11002','Kas Kecil','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('12000','Bank','2','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('12001','Mandiri Bank','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('12002','BCA Bank','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('13000','Piutang','2','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('13001','Piutang Pinjaman Anggota','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('13002','Piutang PinjamanNon Anggota','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('13003','Piutang Supplier','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('14000','Lain-lain','2','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('14001','Perlengkapan Kantor','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('14002','Penyisihan Piutang Tak Tertagih','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('15000','Berwujud','2','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('15001','Kendaraan','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('15002','Akumulasi Penyusutan Kendaraan','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('15003','Peralatan Kantor','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('15004','Akumulasi Penyusutan Peralatan','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('20000','KEWAJIBAN ','1','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('21000','Utang Lancar','2','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('21001','Utang Usaha','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('22000','Utang Jangka Panjang','2','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('22001','Utang Bank','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('22002','Utang Simp. Sukarela Anggota','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('22003','Utang Simp. Sukarela Non Anggota','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('22004','Utang Simp. Berjangka Anggota','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('22005','Utang Simp. Berjangka Non Anggota','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('22006','Utang Pajak','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('23000','Dana-dana SHU','2','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('23001','Dana Anggota','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('23002','Dana Pengurus','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('23003','Dana Pendidikan','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('23004','Dana Pembangunan Daerah Kerja','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('23005','Dana Sosial','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('30000','MODAL  ','1','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('31000','Modal Koperasi','2','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('31001','Simpanan Wajib','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('31002','Simpanan Pokok','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('31003','Cadangan Umum','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('31004','Cadangan Resiko Kredit','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('31005','Modal Penyertaan','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('31006','Modal Sumbangan','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('31007','SHU Periode Berjalan dari Anggota','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('31008','SHU Periode Berjalan dari Non Anggota','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('40000','PENDAPATAN','1','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('41000','Partisipasi Bruto','2','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('41001','Partisipasi Jasa Pinjaman','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('41002','Partisipasi Provisi','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('41003','Partisipasi Administrasi','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('41004','Partisipasi Denda','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('42000','Pendapatan Non Anggota','2','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('42001','Pendapatan Bunga Pinjaman','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('42002','Pendapatan Provisi','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('42003','Pendapatan Administrasi','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('42004','Pendapatan Denda','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('50000','BEBAN','1','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('51000','Beban Pokok','2','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('51001','Beban Bunga Simpanan Anggota','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('51002','Beban Bunga Simpanan Non Anggota','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('51003','Beban Bunga Simpanan Berjangka Anggota','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('51004','Beban Bunga Simpanan Berjangka Non Anggota','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('52000','Beban Operasional','2','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('52001','Biaya Utilitas (Air, Listrik, Telepon, dll)','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('52002','Biaya Kantor Lain','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('52003','Biaya Gaji Karyawan','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('52004','Biaya Pemeliharaan Kendaraan','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('52005','Biaya Penyusutan Kendaraan','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('52006','Biaya Pemeliharaan Peralatan Kantor','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('52007','Biaya Penyusutan Peralatan Kantor','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('52008','Biaya Rapat Anggota','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('52009','Biaya Pembinaan & Penyuluhan','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('53000','Beban Non Operasional','2','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('53001','Biaya atas Penyertaan','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('53002','Rugi Penjualan Aktiva Tetap','3','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('70000','BEBAN KOPERASI','1','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('80000','PENDAPATAN DAN BEBAN NON KOPERASI','1','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10'),('90000','PENDAPATAN DAN BEBAN LUAR BIASA','1','F','F','SYSTEM','2014-10-05 16:55:10','SYSTEM','2014-10-05 16:55:10');

/*Table structure for table `ms_currency` */

DROP TABLE IF EXISTS `ms_currency`;

CREATE TABLE `ms_currency` (
  `cKdCurrency` char(3) NOT NULL,
  `vNmCurrency` varchar(50) DEFAULT NULL,
  `cStatus` char(1) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdCurrency`),
  UNIQUE KEY `PK_Ms_Currency` (`cKdCurrency`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_currency` */

/*Table structure for table `ms_customer` */

DROP TABLE IF EXISTS `ms_customer`;

CREATE TABLE `ms_customer` (
  `cKdCustomer` char(10) NOT NULL,
  `vNmCustomer` varchar(250) DEFAULT NULL,
  `cKdGrupCustomer` char(3) DEFAULT NULL,
  `vAlamat` varchar(250) DEFAULT NULL,
  `cKota` varchar(50) DEFAULT NULL,
  `cTelp` varchar(15) DEFAULT NULL,
  `cFax` varchar(15) DEFAULT NULL,
  `vAlamatShip` varchar(250) DEFAULT NULL,
  `cKotaShip` varchar(50) DEFAULT NULL,
  `cTelpShip` varchar(15) DEFAULT NULL,
  `cFaxShip` varchar(15) DEFAULT NULL,
  `cEmail` varchar(150) DEFAULT NULL,
  `cJenisKelamin` char(1) DEFAULT NULL,
  `cKdSales` char(5) DEFAULT NULL,
  `cTermPay` int(10) DEFAULT NULL,
  `cNPWP` varchar(50) DEFAULT NULL,
  `cNPWPName` varchar(250) DEFAULT NULL,
  `cNPWPAddress` varchar(250) DEFAULT NULL,
  `cStatus` char(1) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdCustomer`),
  UNIQUE KEY `PK_Ms_Customer` (`cKdCustomer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_customer` */

/*Table structure for table `ms_dept` */

DROP TABLE IF EXISTS `ms_dept`;

CREATE TABLE `ms_dept` (
  `cKdDept` varchar(3) NOT NULL,
  `vNmDept` varchar(50) DEFAULT NULL,
  `cUserCreated` int(11) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` int(11) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdDept`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ms_dept` */

insert  into `ms_dept`(`cKdDept`,`vNmDept`,`cUserCreated`,`dDateCreated`,`cUserModify`,`dDateModify`) values ('MIS','Management Information System',1,'2015-01-16 15:51:02',1,'2015-01-16 15:51:02'),('WTR','Waiter',1,'2015-01-15 22:18:17',1,'2015-01-16 15:51:32'),('FIN','Finance',1,'2015-01-17 06:24:08',1,'2015-01-17 06:24:08'),('','',1,'2015-03-28 08:22:10',1,'2015-03-28 08:22:10'),('TST','Test',1,'2015-03-28 10:30:14',1,'2015-03-28 10:30:14'),('546','Kjh',1,'2015-04-01 04:29:48',1,'2015-04-01 04:29:48'),('dep','kasir',1,'2015-04-02 07:45:16',1,'2015-04-02 07:45:16');

/*Table structure for table `ms_entity` */

DROP TABLE IF EXISTS `ms_entity`;

CREATE TABLE `ms_entity` (
  `cKdEntity` char(3) NOT NULL,
  `vNmEntity` varchar(100) DEFAULT NULL,
  `vAlamat` varchar(250) DEFAULT NULL,
  `cKota` varchar(50) DEFAULT NULL,
  `cTelp` varchar(15) DEFAULT NULL,
  `cFax` varchar(15) DEFAULT NULL,
  `cEmail` varchar(150) DEFAULT NULL,
  `cApp` varchar(3) DEFAULT NULL,
  `cDefault` char(1) DEFAULT 'F',
  `cStatus` char(1) DEFAULT NULL,
  `cPassword` varchar(100) NOT NULL,
  `cUserCreated` int(11) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` int(11) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdEntity`),
  UNIQUE KEY `PK_Ms_Entity` (`cKdEntity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_entity` */

insert  into `ms_entity`(`cKdEntity`,`vNmEntity`,`vAlamat`,`cKota`,`cTelp`,`cFax`,`cEmail`,`cApp`,`cDefault`,`cStatus`,`cPassword`,`cUserCreated`,`dDateCreated`,`cUserModify`,`dDateModify`) values ('CB1','Cabang 1',NULL,NULL,NULL,NULL,NULL,'RST','F',NULL,'sbc1RA3OJTr0hGhr1YKpbcT4D8tYpuraC6qq99ba9E8=',1,'2015-01-16 21:40:05',1,'2015-01-16 21:40:05'),('HO','HEAD OFFICE',NULL,NULL,NULL,NULL,'admin@localhost.com','RST','F',NULL,'sbc1RA3OJTr0hGhr1YKpbcT4D8tYpuraC6qq99ba9E8=',1,'2015-01-15 23:54:35',1,'2015-01-15 23:54:35'),('CB2','Cabang 2',NULL,NULL,NULL,NULL,NULL,'RST','F',NULL,'',1,'2015-03-28 10:28:03',1,'2015-03-28 10:28:12');

/*Table structure for table `ms_grpjurnal` */

DROP TABLE IF EXISTS `ms_grpjurnal`;

CREATE TABLE `ms_grpjurnal` (
  `cKdGroup` varchar(5) NOT NULL,
  `vNmGroup` varchar(100) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdGroup`),
  UNIQUE KEY `PK_Ms_GrpJurnal` (`cKdGroup`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_grpjurnal` */

/*Table structure for table `ms_grupbarang` */

DROP TABLE IF EXISTS `ms_grupbarang`;

CREATE TABLE `ms_grupbarang` (
  `cKdGrupBarang` char(5) NOT NULL,
  `vNmGrupBarang` varchar(100) DEFAULT NULL,
  `cShowAndroid` char(1) DEFAULT 'F',
  `cPaket` char(1) DEFAULT 'F',
  `cUserCreated` int(11) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` int(11) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdGrupBarang`),
  UNIQUE KEY `PK_Ms_GrupBarang` (`cKdGrupBarang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_grupbarang` */

insert  into `ms_grupbarang`(`cKdGrupBarang`,`vNmGrupBarang`,`cShowAndroid`,`cPaket`,`cUserCreated`,`dDateCreated`,`cUserModify`,`dDateModify`) values ('MKN','MAKANAN','F','F',1,'2015-01-15 22:03:47',1,'2015-03-31 09:43:34'),('MNU','MINUMAN','F','F',1,'2015-01-15 22:03:59',1,'2015-03-31 09:43:45'),('2332','PENUTUP','F','F',1,'2015-02-06 16:16:28',1,'2015-03-31 09:43:00'),('RAW','RAW MATERIAL','F','F',1,'2015-03-14 17:02:33',1,'2015-03-14 17:02:33'),('PKT','PAKET OKE','F','T',1,'2015-03-14 18:11:57',1,'2015-03-31 09:46:00'),('pahe2','paket hemat 2','F','T',1,'2015-03-28 07:45:23',1,'2015-03-31 09:45:50'),('DLG01','BREAKFAST','F','F',1,'2015-03-31 04:57:38',1,'2015-03-31 04:57:38'),('DLG02','SOUP, SALADS AND LIGHTS FOOD','F','F',1,'2015-03-31 04:58:04',1,'2015-03-31 05:33:05'),('DLG03','PASTA AND PIZZA','F','F',1,'2015-03-31 04:59:51',1,'2015-03-31 04:59:51'),('DLG04','MAIN MEAL','F','F',1,'2015-03-31 04:58:39',1,'2015-03-31 04:58:39'),('DLG05','KIDZ MENU','F','F',1,'2015-03-31 04:58:53',1,'2015-03-31 04:58:53'),('DLG06','DESSERT1','F','F',1,'2015-03-31 04:59:12',1,'2015-03-31 10:16:18'),('DLG07','DRINKS','F','F',1,'2015-03-31 04:59:29',1,'2015-03-31 04:59:29'),('LCD01','SEAFOOD','T','F',1,'2015-03-31 06:13:30',1,'2015-03-31 09:27:57'),('LCD02','CHICKEN AND MEAT','T','F',1,'2015-03-31 06:16:07',1,'2015-03-31 09:28:02'),('LCD03','VEGETABLES','T','F',1,'2015-03-31 06:16:28',1,'2015-03-31 09:28:09'),('LCD04','NOODLE AND RICE','T','F',1,'2015-03-31 06:16:45',1,'2015-03-31 09:28:24'),('LCD05','SOUPS','T','T',1,'2015-03-31 06:16:59',1,'2015-03-31 10:47:14'),('LCD06','APPETIZER','T','T',1,'2015-03-31 06:17:21',1,'2015-03-31 10:45:55'),('LCD07','EASY BITES','T','F',1,'2015-03-31 06:17:57',1,'2015-03-31 09:29:17'),('LCD08','PIZZA','T','F',1,'2015-03-31 06:18:17',1,'2015-03-31 09:29:05'),('LCD09','PASTA','T','F',1,'2015-03-31 06:18:41',1,'2015-03-31 09:28:51'),('LCD10','MEAT AND SEAFOOD','T','F',1,'2015-03-31 06:19:13',1,'2015-03-31 09:28:46'),('LCD11','GRILLS','T','F',1,'2015-03-31 06:19:24',1,'2015-03-31 09:28:42'),('LCD12','DESSERT','T','F',1,'2015-03-31 06:19:40',1,'2015-03-31 10:04:51');

/*Table structure for table `ms_grupcustomer` */

DROP TABLE IF EXISTS `ms_grupcustomer`;

CREATE TABLE `ms_grupcustomer` (
  `cKdGrupCustomer` char(3) NOT NULL,
  `vNmGrupCustomer` varchar(100) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdGrupCustomer`),
  UNIQUE KEY `PK_Ms_GrupCustomer` (`cKdGrupCustomer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_grupcustomer` */

/*Table structure for table `ms_grupsupplier` */

DROP TABLE IF EXISTS `ms_grupsupplier`;

CREATE TABLE `ms_grupsupplier` (
  `cKdGrupSupplier` char(3) NOT NULL,
  `vNmGrupSupplier` varchar(100) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdGrupSupplier`),
  UNIQUE KEY `PK_Ms_GrupSupplier` (`cKdGrupSupplier`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_grupsupplier` */

/*Table structure for table `ms_gudang` */

DROP TABLE IF EXISTS `ms_gudang`;

CREATE TABLE `ms_gudang` (
  `cKdGudang` char(5) NOT NULL,
  `vNmGudang` varchar(50) DEFAULT NULL,
  `vAlamat` varchar(250) DEFAULT NULL,
  `cStatus` char(1) DEFAULT NULL,
  `cKeterangan` varchar(250) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdGudang`),
  UNIQUE KEY `PK_Ms_Gudang` (`cKdGudang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_gudang` */

insert  into `ms_gudang`(`cKdGudang`,`vNmGudang`,`vAlamat`,`cStatus`,`cKeterangan`,`cUserCreated`,`dDateCreated`,`cUserModify`,`dDateModify`) values ('PST','GUDANG PUSAT',NULL,NULL,NULL,'1','2015-03-28 07:35:39','1','2015-03-28 07:35:39');

/*Table structure for table `ms_kartu` */

DROP TABLE IF EXISTS `ms_kartu`;

CREATE TABLE `ms_kartu` (
  `cKdKartu` varchar(5) NOT NULL,
  `vNnKartu` varchar(100) DEFAULT NULL,
  `cKdBank` char(3) DEFAULT NULL,
  `cStatus` char(1) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdKartu`),
  UNIQUE KEY `PK_Ms_Kartu` (`cKdKartu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_kartu` */

/*Table structure for table `ms_kas` */

DROP TABLE IF EXISTS `ms_kas`;

CREATE TABLE `ms_kas` (
  `cKdKas` varchar(3) NOT NULL,
  `vNmKas` varchar(100) DEFAULT NULL,
  `cKdCOA` varchar(15) DEFAULT NULL,
  `cNoTransIn` varchar(5) DEFAULT NULL,
  `cNoTransOut` varchar(5) DEFAULT NULL,
  `cStatus` char(1) DEFAULT NULL,
  `cKdEntity` char(3) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdKas`),
  UNIQUE KEY `PK_Ms_Kas` (`cKdKas`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_kas` */

/*Table structure for table `ms_kurs_bi` */

DROP TABLE IF EXISTS `ms_kurs_bi`;

CREATE TABLE `ms_kurs_bi` (
  `cIdx` char(20) NOT NULL,
  `dTglPosting` timestamp NULL DEFAULT NULL,
  `dTglKurs` timestamp NULL DEFAULT NULL,
  `cMataUang` char(4) DEFAULT NULL,
  `vNilaiJual` decimal(18,2) DEFAULT NULL,
  `vNilaiBeli` decimal(18,2) DEFAULT NULL,
  `vNilaiTengah` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`cIdx`),
  UNIQUE KEY `PK_Ms_Kurs_BI` (`cIdx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_kurs_bi` */

/*Table structure for table `ms_paketbrgdt` */

DROP TABLE IF EXISTS `ms_paketbrgdt`;

CREATE TABLE `ms_paketbrgdt` (
  `cKdPaketDt` int(11) NOT NULL AUTO_INCREMENT,
  `cKdPaket` varchar(30) DEFAULT NULL,
  `cKdBarang` varchar(30) DEFAULT NULL,
  `nQty` decimal(9,2) DEFAULT NULL,
  `cSatuan` char(3) DEFAULT NULL,
  PRIMARY KEY (`cKdPaketDt`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `ms_paketbrgdt` */

insert  into `ms_paketbrgdt`(`cKdPaketDt`,`cKdPaket`,`cKdBarang`,`nQty`,`cSatuan`) values (14,'SUKA','2232',2.00,'PCS'),(13,'SUKA','43434',1.00,'PCS'),(15,'1234','123',1.00,'PCS'),(16,'1234','344411',1.00,'PCS');

/*Table structure for table `ms_pakethd` */

DROP TABLE IF EXISTS `ms_pakethd`;

CREATE TABLE `ms_pakethd` (
  `cKdPaket` varchar(30) NOT NULL,
  `vNmPaket` varchar(100) DEFAULT NULL,
  `cKdGrupBarang` char(5) DEFAULT NULL,
  `vHargaBeli` decimal(18,2) DEFAULT NULL,
  `vHargaJual` decimal(18,2) DEFAULT NULL,
  `vImagePath` varchar(255) DEFAULT NULL,
  `cKeterangan` text,
  `cAktif` char(1) DEFAULT 'T',
  `cKdEntity` varchar(3) DEFAULT NULL,
  `cUserCreated` int(11) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` int(11) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdPaket`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ms_pakethd` */

insert  into `ms_pakethd`(`cKdPaket`,`vNmPaket`,`cKdGrupBarang`,`vHargaBeli`,`vHargaJual`,`vImagePath`,`cKeterangan`,`cAktif`,`cKdEntity`,`cUserCreated`,`dDateCreated`,`cUserModify`,`dDateModify`) values ('SUKA','SUKA SUKA','PKT',NULL,50000.00,'/uploads/files/Koala.jpg','OKEEE','F',NULL,1,'2015-03-14 15:19:49',1,'2015-03-14 19:30:21'),('1234','la carte','pahe2',NULL,40000.00,'','pizza minum','T',NULL,1,'2015-03-28 08:04:46',1,'2015-03-28 08:04:46');

/*Table structure for table `ms_paramacc` */

DROP TABLE IF EXISTS `ms_paramacc`;

CREATE TABLE `ms_paramacc` (
  `cParamCode` varchar(50) NOT NULL,
  `cParamLabel` varchar(100) DEFAULT NULL,
  `cParamType` varchar(10) DEFAULT NULL,
  `cParamValue` varchar(200) DEFAULT NULL,
  `cParamDesc` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`cParamCode`),
  UNIQUE KEY `PK_Ms_ParamACC` (`cParamCode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_paramacc` */

insert  into `ms_paramacc`(`cParamCode`,`cParamLabel`,`cParamType`,`cParamValue`,`cParamDesc`) values ('cCOA_Gol_DB_1','Golongan D/K COA Header 1','VARCHAR','D',NULL),('cCOA_Gol_DB_2','Golongan D/K COA Header 2','VARCHAR','D',NULL),('cCOA_Gol_DB_3','Golongan D/K COA Header 3','VARCHAR','D',NULL),('cCOA_Gol_DB_4','Golongan D/K COA Header 4','VARCHAR','D',NULL),('cCOA_Gol_DB_5','Golongan D/K COA Header 5','VARCHAR','D',NULL),('cCOA_Gol_DB_6','Golongan D/K COA Header 6','VARCHAR','D',NULL),('cCOA_Gol_DB_7','Golongan D/K COA Header 7','VARCHAR','D',NULL),('cCOA_Gol_DB_8','Golongan D/K COA Header 8','VARCHAR','D',NULL),('cCOA_Gol_DB_9','Golongan D/K COA Header 9','VARCHAR','D',NULL),('cCOA_Laba_Ditahan','COA LABA DI TAHAN','VARCHAR','31007',NULL),('cCOA_Laba_Tahun_Berjalan','COA LABA TAHUN BERJALAN','VARCHAR','31008',NULL),('cCOA_Pajak_Dibayar_Dimuka','COA PAJAK DI BAYAR DIMUKA','VARCHAR','22006',NULL),('cCOA_PPN_Keluaran','COA PPN KELUARAN','VARCHAR','14000',NULL),('cCOA_PPN_Masukan','COA PPN MASUKAN','VARCHAR','42004',NULL),('cDef_Currecny','Default Cuurency','VARCHAR','IDR',NULL);

/*Table structure for table `ms_paramerp` */

DROP TABLE IF EXISTS `ms_paramerp`;

CREATE TABLE `ms_paramerp` (
  `cParamCode` varchar(50) NOT NULL,
  `cParamLabel` varchar(100) DEFAULT NULL,
  `cParamType` varchar(10) DEFAULT NULL,
  `cParamValue` varchar(200) DEFAULT NULL,
  `cParamDesc` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`cParamCode`),
  UNIQUE KEY `PK_Ms_ParamERP` (`cParamCode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_paramerp` */

insert  into `ms_paramerp`(`cParamCode`,`cParamLabel`,`cParamType`,`cParamValue`,`cParamDesc`) values ('cDefBarcode','Default Barcode Scanner','BOOLEAN','True',NULL),('cDefCurrency','Default Kode Currency','VARCHAR','IDR',NULL),('cDefGudang','Default Kode Gudang','VARCHAR','123',NULL),('cDefGudangBBM','Default Kode Gudang BBM','VARCHAR','234',NULL),('cKdKas','KODE KAS','VARCHAR','K01',NULL),('cPrefixAPPO','Prefix AP PO','VARCHAR','PO',NULL),('cPrefixAPPR','Prefix AP PR','VARCHAR','PR',NULL),('cPrefixAPRetur','Prefix AP Retur','VARCHAR','RET',NULL),('cPrefixARFaktur','Prefix AR Faktur','VARCHAR','INV',NULL),('cPrefixARFakturPOS','Prefix AR Faktur POS','VARCHAR','POS',NULL),('cPrefixARPayment','Prefix AR Payment','VARCHAR','PAY',NULL),('cPrefixARRetur','Prefix AR Retur','VARCHAR','RET',NULL),('cPrefixARSO','Prefix AR SO','VARCHAR','SO',NULL),('cPrefixICBBK','Prefix IC BBK','VARCHAR','BBK',NULL),('cPrefixICBBM','Prefix IC BBM','VARCHAR','BBM',NULL),('cPrefixICMutasi','Prefix IC Mutasi','VARCHAR','MUT',NULL);

/*Table structure for table `ms_paramksp` */

DROP TABLE IF EXISTS `ms_paramksp`;

CREATE TABLE `ms_paramksp` (
  `cParamCode` varchar(50) NOT NULL,
  `cParamLabel` varchar(100) DEFAULT NULL,
  `cParamType` varchar(10) DEFAULT NULL,
  `cParamValue` varchar(200) DEFAULT NULL,
  `cParamDesc` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`cParamCode`),
  UNIQUE KEY `PK_Ms_ParamKSP` (`cParamCode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_paramksp` */

insert  into `ms_paramksp`(`cParamCode`,`cParamLabel`,`cParamType`,`cParamValue`,`cParamDesc`) values ('cFlagAutoJurnal','AUTO JURNAL','BOOLEAN','True','PARAMETER AUTO GENERATE JURNAL CASH BANK'),('cFlagAutoRealisasi','AUTO REALISASI','BOOLEAN','True','PARAMETER AUTO GENERATE TANGGAL REALISASI CASH BANK'),('cKdGroupJurBayarPinjam','GROUP JURNAL PEMBAYARAN PINJAMAN','VARCHAR','0004','PARAMETER GROUP JURNAL PEMBAYARAN PINJAMAN'),('cKdGroupJurBayarSimpan','GROUP JURNAL PEMBAYARAN SIMPANAN','VARCHAR','0002','PARAMETER GROUP JURNAL PEMBAYARAN SIMPANAN'),('cKdGroupJurCairPinjam','GROUP JURNAL PENCAIRAN PINJAMAN','VARCHAR','0005','PARAMETER GROUP JURNAL PENCAIRAN PINJAMAN'),('cKdGroupJurCairSimpan','GROUP JURNAL PENCAIRAN SIMPANAN','VARCHAR','0003','PARAMETER GROUP JURNAL PENCAIRAN SIMPANAN'),('cKdKas','KODE KAS','VARCHAR','K01','PARAMETER KODE COA KAS'),('cPrefixByrPinjam','Prefix Pembayaran Pinjaman','VARCHAR','BPJ','Prefix Pembayaran Pinjaman'),('cPrefixByrSimpan','Prefix Pembayaran Simpanan','VARCHAR','BSP','Prefix Pembayaran Simpanan'),('cPrefixCairPinjam','Prefix Pencairan Pinjaman','VARCHAR','CPJ','Prefix Pencairan Pinjaman'),('cPrefixCairSimpan','Prefix Pencairan Simpanan','VARCHAR','CSP','Prefix Pencairan Simpanan'),('cPrefixNoAnggota','Prefix Nomor Anggota','VARCHAR','ANG','Prefix Nomor Anggota'),('cPrefixPinjaman','Prefix Pinjaman','VARCHAR','PJM','Prefix Pinjaman');

/*Table structure for table `ms_pegawai` */

DROP TABLE IF EXISTS `ms_pegawai`;

CREATE TABLE `ms_pegawai` (
  `cKdPegawai` int(11) NOT NULL AUTO_INCREMENT,
  `vNamaPegawai` varchar(100) DEFAULT NULL,
  `vNmSingkat` varchar(30) DEFAULT NULL,
  `cKdDept` varchar(3) DEFAULT NULL,
  `cPelayan` varchar(1) DEFAULT NULL,
  `cFlag` int(11) NOT NULL,
  `cPIN` varchar(6) NOT NULL,
  `cKdEntity` varchar(3) DEFAULT NULL,
  `cUserCreated` int(11) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` int(11) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdPegawai`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `ms_pegawai` */

insert  into `ms_pegawai`(`cKdPegawai`,`vNamaPegawai`,`vNmSingkat`,`cKdDept`,`cPelayan`,`cFlag`,`cPIN`,`cKdEntity`,`cUserCreated`,`dDateCreated`,`cUserModify`,`dDateModify`) values (1,'Admin','Admin','MIS','F',0,'1234','HO',1,'2015-01-16 15:53:51',1,'2015-01-16 15:53:51'),(2,'RIDWAN','RIDWAN','WTR','T',1,'1234','HO',1,'2015-01-15 23:57:00',1,'2015-01-16 00:18:29'),(4,'MONTEZARI','MONTE','WTR','T',2,'1234','HO',1,'2015-01-16 01:06:09',1,'2015-01-16 01:06:09'),(5,'IWAN','IWAN','WTR',NULL,3,'1234','HO',1,'2015-02-14 17:47:26',1,'2015-02-14 17:47:26'),(6,'kitchen','kitchen','WTR',NULL,4,'1234','HO',1,'2015-02-14 18:18:24',1,'2015-02-14 18:18:24'),(7,'manager','manager','FIN',NULL,9,'1234','HO',7,'2015-02-14 18:55:09',7,'2015-02-14 18:55:09'),(8,'AeroSmith','aero','TST',NULL,1,'123456','CB2',1,'2015-03-28 10:31:56',1,'2015-03-28 10:31:56');

/*Table structure for table `ms_produkpinjam` */

DROP TABLE IF EXISTS `ms_produkpinjam`;

CREATE TABLE `ms_produkpinjam` (
  `cKdProduk` varchar(5) NOT NULL,
  `vNmProduk` varchar(50) DEFAULT NULL,
  `vBungaHarian` decimal(9,2) DEFAULT NULL,
  `vBungaMingguan` decimal(9,2) DEFAULT NULL,
  `vBungaBulanan` decimal(9,2) DEFAULT NULL,
  `vBungaTahunan` decimal(9,2) DEFAULT NULL,
  `vLimitKredit` decimal(18,2) DEFAULT NULL,
  `cJatuhTempo` int(10) DEFAULT NULL,
  `cStatus` char(1) DEFAULT NULL,
  `cKdCOAHutang` varchar(15) DEFAULT NULL,
  `cKdCOABunga` varchar(15) DEFAULT NULL,
  `cKdCOADenda` varchar(15) DEFAULT NULL,
  `cKdEntity` char(3) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdProduk`),
  UNIQUE KEY `PK_Ms_ProdukPinjam` (`cKdProduk`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_produkpinjam` */

/*Table structure for table `ms_produksimpan` */

DROP TABLE IF EXISTS `ms_produksimpan`;

CREATE TABLE `ms_produksimpan` (
  `cKdProduk` varchar(5) NOT NULL,
  `vNmProduk` varchar(50) DEFAULT NULL,
  `cJenisProduk` char(1) DEFAULT NULL,
  `cJenisBunga` char(1) DEFAULT NULL,
  `vBungaHarian` decimal(9,2) DEFAULT NULL,
  `vBungaBulanan` decimal(9,2) DEFAULT NULL,
  `vBungaTahunan` decimal(9,2) DEFAULT NULL,
  `cPeriodeBayar` char(3) DEFAULT NULL,
  `vNilaiBayar` decimal(18,2) DEFAULT NULL,
  `cStatus` char(3) DEFAULT NULL,
  `cKdCOASimpan` varchar(15) DEFAULT NULL,
  `cKdCOABunga` varchar(15) DEFAULT NULL,
  `cKdEntity` char(3) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdProduk`),
  UNIQUE KEY `PK_Ms_ProdukSimpan` (`cKdProduk`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_produksimpan` */

/*Table structure for table `ms_sales` */

DROP TABLE IF EXISTS `ms_sales`;

CREATE TABLE `ms_sales` (
  `cKdSales` char(5) NOT NULL,
  `vNmSales` varchar(150) DEFAULT NULL,
  `cAlamat` varchar(250) DEFAULT NULL,
  `cTelp` varchar(15) DEFAULT NULL,
  `cEmail` varchar(150) DEFAULT NULL,
  `cStatus` char(1) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdSales`),
  UNIQUE KEY `PK_Ms_Sales` (`cKdSales`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_sales` */

/*Table structure for table `ms_satuan` */

DROP TABLE IF EXISTS `ms_satuan`;

CREATE TABLE `ms_satuan` (
  `cSatuan` char(3) NOT NULL,
  `cAlias` varchar(15) DEFAULT NULL,
  `cParent` char(3) DEFAULT NULL,
  `cKeterangan` varchar(50) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cSatuan`),
  UNIQUE KEY `PK_Ms_Satuan` (`cSatuan`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_satuan` */

insert  into `ms_satuan`(`cSatuan`,`cAlias`,`cParent`,`cKeterangan`,`cUserCreated`,`dDateCreated`,`cUserModify`,`dDateModify`) values ('PCS','PIECES',NULL,NULL,'1','2015-03-14 15:06:24','1','2015-03-14 15:06:24'),('GRM','GRAM',NULL,NULL,'1','2015-03-14 17:03:27','1','2015-03-14 17:03:27');

/*Table structure for table `ms_supplier` */

DROP TABLE IF EXISTS `ms_supplier`;

CREATE TABLE `ms_supplier` (
  `cKdSupplier` char(10) NOT NULL,
  `vNmSupplier` varchar(200) DEFAULT NULL,
  `cKdGrupSupplier` char(3) DEFAULT NULL,
  `vAlamat` varchar(250) DEFAULT NULL,
  `cKota` varchar(50) DEFAULT NULL,
  `cTelp` varchar(15) DEFAULT NULL,
  `cFax` varchar(15) DEFAULT NULL,
  `cEmail` varchar(150) DEFAULT NULL,
  `cStatus` char(1) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdSupplier`),
  UNIQUE KEY `PK_Ms_Supplier` (`cKdSupplier`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_supplier` */

insert  into `ms_supplier`(`cKdSupplier`,`vNmSupplier`,`cKdGrupSupplier`,`vAlamat`,`cKota`,`cTelp`,`cFax`,`cEmail`,`cStatus`,`cUserCreated`,`dDateCreated`,`cUserModify`,`dDateModify`) values ('S0001','PT. JAYA ABADI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','2015-03-14 17:07:54','1','2015-03-28 10:16:50');

/*Table structure for table `ms_tablelayout` */

DROP TABLE IF EXISTS `ms_tablelayout`;

CREATE TABLE `ms_tablelayout` (
  `cKdTable` int(11) NOT NULL AUTO_INCREMENT,
  `vNmTable` varchar(50) DEFAULT NULL,
  `cOrder` int(11) DEFAULT NULL,
  `cStatus` char(1) DEFAULT NULL,
  `cUserCreated` int(11) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` int(11) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdTable`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `ms_tablelayout` */

insert  into `ms_tablelayout`(`cKdTable`,`vNmTable`,`cOrder`,`cStatus`,`cUserCreated`,`dDateCreated`,`cUserModify`,`dDateModify`) values (1,'A1',NULL,'T',1,'2015-01-16 00:11:11',1,'2015-01-16 00:19:41'),(2,'A2',NULL,'T',1,'2015-01-16 23:01:41',1,'2015-01-16 23:01:41'),(3,'A3',NULL,'T',1,'2015-01-16 23:02:02',1,'2015-01-16 23:02:02'),(4,'A4',NULL,'T',1,'2015-01-17 06:35:42',1,'2015-01-17 06:35:42'),(5,'A5',NULL,'T',1,'2015-01-17 06:35:49',1,'2015-01-17 06:35:49'),(8,'A6',NULL,'T',1,'2015-03-02 15:23:36',1,'2015-03-02 15:23:36'),(9,'A7',NULL,'F',1,'2015-03-02 15:23:44',1,'2015-03-02 15:23:44'),(10,'A8',NULL,'T',1,'2015-03-02 15:23:54',1,'2015-03-02 15:23:54');

/*Table structure for table `ms_tanggal` */

DROP TABLE IF EXISTS `ms_tanggal`;

CREATE TABLE `ms_tanggal` (
  `cDay` int(11) NOT NULL,
  PRIMARY KEY (`cDay`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ms_tanggal` */

insert  into `ms_tanggal`(`cDay`) values (1),(2),(3),(4),(5),(6),(7),(8),(9),(10),(11),(12),(13),(14),(15),(16),(17),(18),(19),(20),(21),(22),(23),(24),(25),(26),(27),(28),(29),(30),(31);

/*Table structure for table `ms_transaksi` */

DROP TABLE IF EXISTS `ms_transaksi`;

CREATE TABLE `ms_transaksi` (
  `cKdTransaksi` varchar(10) NOT NULL,
  `vNmTransaksi` varchar(200) DEFAULT NULL,
  `cKdGroup` varchar(5) DEFAULT NULL,
  `cKdCOA` varchar(15) DEFAULT NULL,
  `cKdTreasury` varchar(15) DEFAULT NULL,
  `cStatus` char(1) DEFAULT NULL,
  `cKdEntity` char(3) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdTransaksi`),
  UNIQUE KEY `PK_Ms_Transaksi` (`cKdTransaksi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_transaksi` */

/*Table structure for table `ms_treasury` */

DROP TABLE IF EXISTS `ms_treasury`;

CREATE TABLE `ms_treasury` (
  `cKdTreasury` varchar(15) NOT NULL,
  `vNmTreasury` varchar(150) DEFAULT NULL,
  `cInOut` char(1) DEFAULT NULL,
  `cType` char(1) DEFAULT NULL,
  `cKdEntity` char(3) DEFAULT NULL,
  `cUserCreated` varchar(30) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` varchar(30) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdTreasury`),
  UNIQUE KEY `PK_Ms_Treasury` (`cKdTreasury`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `ms_treasury` */

/*Table structure for table `sys_notrans` */

DROP TABLE IF EXISTS `sys_notrans`;

CREATE TABLE `sys_notrans` (
  `cApp` varchar(3) DEFAULT NULL,
  `cNoTrans` varchar(5) DEFAULT NULL,
  `cNumTrans` int(10) DEFAULT NULL,
  `cYearTrans` char(4) DEFAULT NULL,
  `cMonthTrans` char(2) DEFAULT NULL,
  `cKdEntity` char(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `sys_notrans` */

/*Table structure for table `tm_recipebrgdt` */

DROP TABLE IF EXISTS `tm_recipebrgdt`;

CREATE TABLE `tm_recipebrgdt` (
  `cKdRecipeBrgDt` int(11) NOT NULL AUTO_INCREMENT,
  `cKdRecipe` int(11) DEFAULT NULL,
  `cKdBarang` varchar(30) DEFAULT NULL,
  `nQty` float DEFAULT NULL,
  `cSatuan` char(3) DEFAULT NULL,
  PRIMARY KEY (`cKdRecipeBrgDt`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tm_recipebrgdt` */

insert  into `tm_recipebrgdt`(`cKdRecipeBrgDt`,`cKdRecipe`,`cKdBarang`,`nQty`,`cSatuan`) values (3,3,'R0003',2,'PCS'),(4,3,'R0004',1,'PCS'),(5,3,'R0005',1,'PCS'),(6,4,'R0004',1,'PCS');

/*Table structure for table `tm_recipehd` */

DROP TABLE IF EXISTS `tm_recipehd`;

CREATE TABLE `tm_recipehd` (
  `cKdRecipe` int(11) NOT NULL AUTO_INCREMENT,
  `cKdBarang` varchar(30) DEFAULT NULL,
  `cKeterangan` text,
  `cAktif` char(1) DEFAULT NULL,
  `cKdEntity` varchar(3) DEFAULT NULL,
  `cUserCreated` int(11) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` int(11) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cKdRecipe`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tm_recipehd` */

insert  into `tm_recipehd`(`cKdRecipe`,`cKdBarang`,`cKeterangan`,`cAktif`,`cKdEntity`,`cUserCreated`,`dDateCreated`,`cUserModify`,`dDateModify`) values (3,'A01','test','T',NULL,1,'2015-03-14 17:07:30',1,'2015-03-14 17:07:30'),(4,'123','','F',NULL,1,'2015-03-28 08:13:18',1,'2015-03-28 08:13:18');

/*Table structure for table `tr_appodt` */

DROP TABLE IF EXISTS `tr_appodt`;

CREATE TABLE `tr_appodt` (
  `cIdPODt` int(11) NOT NULL AUTO_INCREMENT,
  `cIdPO` int(11) DEFAULT NULL,
  `cNoPO` varchar(30) DEFAULT NULL,
  `dTglPO` datetime DEFAULT NULL,
  `cKdBarang` varchar(30) DEFAULT NULL,
  `nQtyBeli` decimal(9,2) DEFAULT NULL,
  `nQtyRetur` decimal(9,2) DEFAULT NULL,
  `cSatuan` char(3) DEFAULT NULL,
  `nHarga` decimal(18,2) DEFAULT NULL,
  `nTotalHarga` decimal(18,2) DEFAULT NULL,
  PRIMARY KEY (`cIdPODt`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tr_appodt` */

/*Table structure for table `tr_appohd` */

DROP TABLE IF EXISTS `tr_appohd`;

CREATE TABLE `tr_appohd` (
  `cIdPO` int(11) NOT NULL AUTO_INCREMENT,
  `cNoPO` varchar(30) DEFAULT NULL,
  `dTglPO` datetime DEFAULT NULL,
  `cKdSupplier` char(10) DEFAULT NULL,
  `cTermPay` int(11) DEFAULT NULL,
  `dTglJT` date DEFAULT NULL,
  `nTotal` decimal(18,2) DEFAULT NULL,
  `cKeterangan` text,
  `cStatus` char(1) DEFAULT NULL,
  `cKdEntity` varchar(3) DEFAULT NULL,
  `cUserCreated` int(11) DEFAULT NULL,
  `dDateCreated` datetime DEFAULT NULL,
  `cUserModify` int(11) DEFAULT NULL,
  `dDateModify` datetime DEFAULT NULL,
  PRIMARY KEY (`cIdPO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tr_appohd` */

/*Table structure for table `tr_rate` */

DROP TABLE IF EXISTS `tr_rate`;

CREATE TABLE `tr_rate` (
  `cUserId` char(10) DEFAULT NULL,
  `dLastUpdate` datetime DEFAULT NULL,
  `cJnsRate` char(1) DEFAULT NULL,
  `dTglRate` datetime DEFAULT NULL,
  `cKdCurrency1` char(3) DEFAULT NULL,
  `cKdCurrency2` char(3) DEFAULT NULL,
  `nRate` decimal(18,2) DEFAULT NULL,
  `dTglInput` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tr_rate` */

/*Table structure for table `vw_ms_recipe` */

DROP TABLE IF EXISTS `vw_ms_recipe`;

/*!50001 DROP VIEW IF EXISTS `vw_ms_recipe` */;
/*!50001 DROP TABLE IF EXISTS `vw_ms_recipe` */;

/*!50001 CREATE TABLE  `vw_ms_recipe`(
 `cKdRecipe` int(11) ,
 `cKdBarang_FG` varchar(30) ,
 `cKdBarang_RAW` varchar(30) ,
 `nQty` double ,
 `cSatuan` char(3) 
)*/;

/*View structure for view vw_ms_recipe */

/*!50001 DROP TABLE IF EXISTS `vw_ms_recipe` */;
/*!50001 DROP VIEW IF EXISTS `vw_ms_recipe` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_ms_recipe` AS select `hd`.`cKdRecipe` AS `cKdRecipe`,`hd`.`cKdBarang` AS `cKdBarang_FG`,`dt`.`cKdBarang` AS `cKdBarang_RAW`,sum(`dt`.`nQty`) AS `nQty`,`dt`.`cSatuan` AS `cSatuan` from (`tm_recipebrgdt` `dt` left join `tm_recipehd` `hd` on((`hd`.`cKdRecipe` = `dt`.`cKdRecipe`))) group by `hd`.`cKdRecipe`,`hd`.`cKdBarang`,`dt`.`cKdBarang`,`dt`.`cSatuan` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
