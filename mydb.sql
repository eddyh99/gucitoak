/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.4.4-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: trxspider_gucitoak
-- ------------------------------------------------------
-- Server version	11.4.4-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `assignsales`
--

DROP TABLE IF EXISTS `assignsales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assignsales` (
  `id_sales` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  PRIMARY KEY (`id_sales`,`id_barang`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `assignsales_ibfk_1` FOREIGN KEY (`id_sales`) REFERENCES `sales` (`id`),
  CONSTRAINT `assignsales_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignsales`
--

LOCK TABLES `assignsales` WRITE;
/*!40000 ALTER TABLE `assignsales` DISABLE KEYS */;
INSERT INTO `assignsales` VALUES
(2,5),
(2,6),
(2,8);
/*!40000 ALTER TABLE `assignsales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namabarang` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `stokmin` int(11) NOT NULL,
  `is_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `id_user` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kategori` (`id_kategori`),
  KEY `barang_ibfk_2` (`id_satuan`),
  KEY `barang_ibfk_3` (`id_user`),
  CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`),
  CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang`
--

LOCK TABLES `barang` WRITE;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
INSERT INTO `barang` VALUES
(1,'Snack Pilihan Kita',1,1,10,'yes',0,'2024-10-04 07:32:43','2024-10-16 07:19:36',NULL),
(2,'Snack Pilihan Kita',2,1,10,'no',0,'2024-10-04 07:34:05','2025-01-21 09:51:45',''),
(3,'Snack Pilihan Kami',1,1,10,'yes',0,'2024-10-16 04:38:08','2024-10-16 07:20:06',NULL),
(4,'Snack Pilihan Kami',1,1,10,'yes',0,'2024-10-16 05:40:04','2024-10-16 07:22:38',NULL),
(5,'Teh Gelas',1,1,10,'no',0,'2024-10-16 05:54:48',NULL,NULL),
(6,'Teh Botol',2,1,10,'no',0,'2024-10-16 06:00:34','2025-01-21 15:41:18',NULL),
(7,'Teh Kaca',1,1,10,'yes',0,'2024-10-16 06:12:37','2024-10-16 07:23:18',NULL),
(8,'Udang Rambutan',2,1,10,'no',0,'2024-10-16 06:13:17','2025-01-21 15:44:10',''),
(9,'Kepiting Uenak',2,1,500,'no',0,'2024-10-16 06:51:42','2025-01-21 15:41:24',NULL),
(10,'Buku Tulis',34,4,100,'no',0,'2024-10-17 04:30:02','2025-01-21 16:36:10','');
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barang_detail`
--

DROP TABLE IF EXISTS `barang_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barang_detail` (
  `barcode` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `barang_id` int(11) NOT NULL,
  `expired` date NOT NULL,
  `entry_date` datetime NOT NULL,
  PRIMARY KEY (`barcode`),
  KEY `barang_id` (`barang_id`),
  CONSTRAINT `barang_detail_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang_detail`
--

LOCK TABLES `barang_detail` WRITE;
/*!40000 ALTER TABLE `barang_detail` DISABLE KEYS */;
INSERT INTO `barang_detail` VALUES
('139875032890250525',10,'2025-05-25','2024-11-02 16:28:46'),
('139875032890250625',8,'2025-06-25','2024-11-02 16:28:46');
/*!40000 ALTER TABLE `barang_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cabang`
--

DROP TABLE IF EXISTS `cabang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cabang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namacabang` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `long` varchar(50) NOT NULL,
  `is_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cabang`
--

LOCK TABLES `cabang` WRITE;
/*!40000 ALTER TABLE `cabang` DISABLE KEYS */;
INSERT INTO `cabang` VALUES
(1,'Kantor Utama 1','Jl Cendana 10A','10.00029','-195.22299','yes','2024-10-04 06:35:35','2024-10-04 06:38:05'),
(2,'Kantor Utama','Jln Gatsu Timur Gang Cemara no 5','12','1234','no','2024-10-17 04:47:59','2024-10-17 05:23:56'),
(3,'Gudang Barang','Jln kartika 123','41.40338','2.17403','yes','2024-10-17 05:13:06','2024-10-17 05:22:49'),
(4,'Gudang Barang','jln sari kuning','22222','111111','no','2024-10-17 05:24:21','2024-10-17 05:36:50'),
(5,'Test Cabang','Mengwi','38.9071923','2.17403','yes','2024-10-17 05:24:35','2024-10-17 05:24:39');
/*!40000 ALTER TABLE `cabang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cicilansuplier`
--

DROP TABLE IF EXISTS `cicilansuplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cicilansuplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_nota` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cicilansuplier_ibfk_1` (`id_nota`),
  CONSTRAINT `cicilansuplier_ibfk_1` FOREIGN KEY (`id_nota`) REFERENCES `pembelian` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cicilansuplier`
--

LOCK TABLES `cicilansuplier` WRITE;
/*!40000 ALTER TABLE `cicilansuplier` DISABLE KEYS */;
INSERT INTO `cicilansuplier` VALUES
(3,1),
(9,1),
(10,2),
(13,2),
(16,2),
(17,2),
(12,3),
(15,3);
/*!40000 ALTER TABLE `cicilansuplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cicilansuplier_detail`
--

DROP TABLE IF EXISTS `cicilansuplier_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cicilansuplier_detail` (
  `cicilan_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `amount` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  KEY `cicilan_id` (`cicilan_id`),
  CONSTRAINT `cicilansuplier_detail_ibfk_1` FOREIGN KEY (`cicilan_id`) REFERENCES `cicilansuplier` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cicilansuplier_detail`
--

LOCK TABLES `cicilansuplier_detail` WRITE;
/*!40000 ALTER TABLE `cicilansuplier_detail` DISABLE KEYS */;
INSERT INTO `cicilansuplier_detail` VALUES
(3,'2023-11-21',20,'retur'),
(9,'2023-11-21',20,'retur'),
(10,'2023-11-21',15,'retur'),
(12,'2023-11-21',14999,'retur'),
(13,'2023-11-21',10000,'retur'),
(15,'2025-01-14',2,'retur'),
(16,'2025-01-14',7,'valid'),
(17,'2025-01-14',1,'oke');
/*!40000 ALTER TABLE `cicilansuplier_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disposal_detail`
--

DROP TABLE IF EXISTS `disposal_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disposal_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `barcode` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `alasan` tinytext DEFAULT NULL,
  `approved` tinyint(4) DEFAULT 0 CHECK (`approved` in (0,1,2)),
  PRIMARY KEY (`id`),
  KEY `disposal_detail_ibfk_2` (`barcode`),
  CONSTRAINT `disposal_detail_ibfk_2` FOREIGN KEY (`barcode`) REFERENCES `barang_detail` (`barcode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disposal_detail`
--

LOCK TABLES `disposal_detail` WRITE;
/*!40000 ALTER TABLE `disposal_detail` DISABLE KEYS */;
INSERT INTO `disposal_detail` VALUES
(2,'2024-11-28','139875032890250525',5,'Rusak',1);
/*!40000 ALTER TABLE `disposal_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gaji`
--

DROP TABLE IF EXISTS `gaji`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gaji` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_id` int(11) NOT NULL,
  `bulan` char(7) NOT NULL,
  `gajipokok` int(11) NOT NULL,
  `uangharian` int(11) DEFAULT 0,
  `insentif` int(11) DEFAULT 0,
  `komisi` int(11) NOT NULL,
  `detailnota` text DEFAULT NULL,
  `status` enum('dibayar','belum') NOT NULL DEFAULT 'belum',
  PRIMARY KEY (`id`),
  KEY `fk_sales` (`sales_id`),
  CONSTRAINT `fk_sales` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gaji`
--

LOCK TABLES `gaji` WRITE;
/*!40000 ALTER TABLE `gaji` DISABLE KEYS */;
INSERT INTO `gaji` VALUES
(13,4,'2024-11',1500000,50000,80000,3200,'000003,000002','dibayar');
/*!40000 ALTER TABLE `gaji` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `harga`
--

DROP TABLE IF EXISTS `harga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `harga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `harga1` int(11) NOT NULL,
  `harga2` int(11) NOT NULL,
  `harga3` int(11) NOT NULL,
  `disc_fxd` int(11) NOT NULL,
  `disc_pct` decimal(6,4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `harga_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `harga`
--

LOCK TABLES `harga` WRITE;
/*!40000 ALTER TABLE `harga` DISABLE KEYS */;
INSERT INTO `harga` VALUES
(1,2,'2024-10-04 00:00:00',10000,12000,12500,5000,1.0000),
(2,3,'2024-10-16 00:00:00',10000,12000,12500,5000,1.0000),
(4,3,'2024-10-16 04:57:37',100000,12000,12500,5000,1.0000),
(5,4,'2024-10-16 05:40:04',10000,12000,12500,5000,1.0000),
(6,5,'2024-10-16 05:54:48',10000,12000,12500,1000,8.0000),
(7,3,'2024-10-16 05:58:25',100000,12000,12500,5000,1.0000),
(8,6,'2024-10-16 06:00:34',10000,12000,12500,1000,2.0000),
(9,3,'2024-10-16 06:04:31',100000,12000,12500,5000,0.0010),
(10,7,'2024-10-16 06:12:37',10000,12000,12500,1000,2.0000),
(11,8,'2024-10-16 06:13:17',10000,12000,12500,1000,0.0100),
(12,9,'2024-10-16 06:51:42',20000,19800,0,0,0.5000),
(13,10,'2024-10-17 04:30:02',30000,29000,0,0,0.5000),
(14,10,'2024-12-05 04:39:13',31000,30000,0,0,1.5000),
(19,10,'2025-01-21 09:51:11',31000,30000,0,0,1.5000),
(21,2,'2025-01-21 09:51:45',10000,12000,12500,5000,1.0000),
(24,10,'2025-01-21 10:02:47',31000,30000,0,0,1.5000),
(28,10,'2025-01-21 10:12:12',31000,30000,0,0,1.5000),
(52,10,'2025-01-21 11:00:49',31000,30000,0,0,1.5000),
(54,10,'2025-01-21 11:02:19',31000,30000,0,0,1.5000),
(55,10,'2025-01-21 11:02:38',31000,30000,0,0,1.5000),
(56,10,'2025-01-21 11:02:54',31000,30000,0,0,1.5000),
(80,10,'2025-01-21 15:24:31',31000,30000,0,0,1.5000),
(81,10,'2025-01-21 15:24:54',31000,30000,0,0,1.5000),
(82,6,'2025-01-21 15:41:18',10000,12000,12500,1000,2.0000),
(83,9,'2025-01-21 15:41:24',20000,19800,0,0,0.5000),
(84,10,'2025-01-21 15:41:47',31000,30000,0,0,1.5000),
(85,10,'2025-01-21 15:42:36',31000,30000,0,0,1.5000),
(86,8,'2025-01-21 15:43:01',10000,12000,12500,1000,0.0100),
(87,8,'2025-01-21 15:43:22',10000,12000,12500,1000,0.0100),
(88,8,'2025-01-21 15:44:10',10000,12000,12500,1000,0.0100),
(89,10,'2025-01-21 16:36:10',31000,30000,0,0,1.5000);
/*!40000 ALTER TABLE `harga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namakategori` varchar(20) NOT NULL,
  `is_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `namakategori` (`namakategori`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES
(1,'Dry Food','yes','2024-09-12 23:58:48','2024-10-12 08:47:55'),
(2,'Frozen Food','no','2024-09-13 02:42:26',NULL),
(24,'Fast Food','yes','2024-10-12 03:44:06','2024-10-12 14:06:04'),
(25,'Snacks','yes','2024-10-12 07:34:05','2024-10-12 08:50:32'),
(26,'Kitchen Tools','yes','2024-10-12 07:52:34','2024-10-12 08:52:21'),
(27,'Skincare','yes','2024-10-12 07:54:13','2024-10-12 08:52:10'),
(33,'Bathroom Tools','no','2024-10-12 08:32:55',NULL),
(34,'Book','no','2024-10-12 08:53:04',NULL),
(35,'Alat Sekolah','no','2024-10-12 14:02:51','2024-10-12 14:04:59');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelanggan`
--

DROP TABLE IF EXISTS `pelanggan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namapelanggan` varchar(100) NOT NULL,
  `pemilik` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `plafon` int(11) NOT NULL,
  `maxnota` int(11) NOT NULL DEFAULT 3,
  `harga` enum('Harga 1','Harga 2','Harga 3','') NOT NULL DEFAULT 'Harga 1',
  `is_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `gmaps` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelanggan`
--

LOCK TABLES `pelanggan` WRITE;
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;
INSERT INTO `pelanggan` VALUES
(1,'Sari Roti','sari ayu','jl Semarang A!','Denpasar','0182302392',0,10,'Harga 2','no','2024-09-14 04:00:34','2025-02-03 04:55:20','https://maps.app.goo.gl/3Pap1r9V9'),
(2,'Toko Kelontong Madura','Muhammad','mengwi','Badung','0811111111111',300000,0,'Harga 1','no','2024-10-16 01:07:11',NULL,NULL),
(3,'Toko Kelontong Makmur','Wayan makmur','Jln Gatsu Timur Gang Cemara no 5','Denpasar','0831232131231',500000,1,'Harga 3','yes','2024-10-16 01:14:05','2024-10-16 01:18:13',NULL);
/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pembayaran_ibfk_1` (`nonota`),
  CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`nonota`) REFERENCES `penjualan` (`nonota`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran`
--

LOCK TABLES `pembayaran` WRITE;
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
INSERT INTO `pembayaran` VALUES
(3,'000001'),
(1,'000002'),
(2,'000002'),
(4,'000002'),
(5,'000002');
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayaran_detail`
--

DROP TABLE IF EXISTS `pembayaran_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pembayaran_detail` (
  `bayar_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `amount` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  KEY `detail_pembayaran_ibfk_1` (`bayar_id`),
  CONSTRAINT `detail_pembayaran_ibfk_1` FOREIGN KEY (`bayar_id`) REFERENCES `pembayaran` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran_detail`
--

LOCK TABLES `pembayaran_detail` WRITE;
/*!40000 ALTER TABLE `pembayaran_detail` DISABLE KEYS */;
INSERT INTO `pembayaran_detail` VALUES
(1,'2024-12-05',10000,'y'),
(4,'2025-01-14',19,''),
(5,'2025-01-14',12,'maknyus');
/*!40000 ALTER TABLE `pembayaran_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembelian`
--

DROP TABLE IF EXISTS `pembelian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nonota` varchar(30) NOT NULL,
  `id_suplier` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `method` enum('cash','tempo') NOT NULL,
  `waktu` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pembelian_ibfk_1` (`id_suplier`),
  CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_suplier`) REFERENCES `suplier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembelian`
--

LOCK TABLES `pembelian` WRITE;
/*!40000 ALTER TABLE `pembelian` DISABLE KEYS */;
INSERT INTO `pembelian` VALUES
(1,'09/XII/2025',1,'2024-12-23','cash',0),
(2,'09x22',1,'2024-12-28','cash',0),
(3,'09x23',1,'2024-12-28','cash',0);
/*!40000 ALTER TABLE `pembelian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembelian_detail`
--

DROP TABLE IF EXISTS `pembelian_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pembelian_detail` (
  `id` int(11) NOT NULL,
  `barcode` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  KEY `pembelian_detail_ibfk_2` (`barcode`),
  KEY `pembelian_detail_ibfk_1` (`id`),
  CONSTRAINT `pembelian_detail_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pembelian` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pembelian_detail_ibfk_2` FOREIGN KEY (`barcode`) REFERENCES `barang_detail` (`barcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembelian_detail`
--

LOCK TABLES `pembelian_detail` WRITE;
/*!40000 ALTER TABLE `pembelian_detail` DISABLE KEYS */;
INSERT INTO `pembelian_detail` VALUES
(1,'139875032890250525',2,0),
(2,'139875032890250525',5,25000),
(3,'139875032890250525',1,15000);
/*!40000 ALTER TABLE `pembelian_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengguna`
--

DROP TABLE IF EXISTS `pengguna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `role` enum('admin','kasir','sales') NOT NULL DEFAULT 'admin',
  `status` enum('active','disabled') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengguna`
--

LOCK TABLES `pengguna` WRITE;
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` VALUES
(1,'admin','f865b53623b121fd34ee5426c792e5c33af8c227','admin','active','2024-09-05 16:17:19','2024-10-17 02:23:23'),
(2,'kasir','40bd001563085fc35165329ea1ff5c5ecbdbbeef','kasir','disabled','2024-10-16 04:04:58','2024-10-17 02:50:53'),
(5,'ari','d58a1a35e01b9a894fae8677c08062ec90f07c91','admin','disabled','2024-10-17 02:39:55','2024-10-17 02:49:26'),
(7,'adi','40bd001563085fc35165329ea1ff5c5ecbdbbeef','admin','disabled','2024-10-17 02:51:31','2024-10-17 02:52:04'),
(8,'admin1','f865b53623b121fd34ee5426c792e5c33af8c227','admin','disabled','2024-10-17 03:03:26','2024-10-17 03:03:34'),
(9,'agus','434e43a262c95c5a345542cdf327222adf18aa93','kasir','active','2025-01-16 13:38:34','2025-01-24 06:08:54'),
(10,'supersales','f865b53623b121fd34ee5426c792e5c33af8c227','sales','active','2025-01-23 07:36:37','2025-01-24 07:20:22');
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penjualan`
--

DROP TABLE IF EXISTS `penjualan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penjualan` (
  `nonota` varchar(6) NOT NULL,
  `tanggal` datetime NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `method` enum('cash','tempo') NOT NULL,
  `waktu` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `is_terima` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`nonota`),
  KEY `pelanggan_id` (`pelanggan_id`),
  KEY `penjualan_ibfk_2` (`sales_id`),
  CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`),
  CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penjualan`
--

LOCK TABLES `penjualan` WRITE;
/*!40000 ALTER TABLE `penjualan` DISABLE KEYS */;
INSERT INTO `penjualan` VALUES
('000001','2024-12-03 14:26:13',1,1,'tempo',7,0,1),
('000002','2024-11-13 02:25:36',2,4,'tempo',5,0,0),
('000003','2024-11-13 02:25:36',2,4,'tempo',5,0,1),
('000004','2025-01-21 07:54:27',1,3,'cash',0,0,0);
/*!40000 ALTER TABLE `penjualan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penjualan_detail`
--

DROP TABLE IF EXISTS `penjualan_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penjualan_detail` (
  `nonota` varchar(6) NOT NULL,
  `barcode` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL,
  KEY `penjualan_detail_ibfk_2` (`barcode`),
  KEY `penjualan_detail_ibfk_1` (`nonota`),
  CONSTRAINT `penjualan_detail_ibfk_1` FOREIGN KEY (`nonota`) REFERENCES `penjualan` (`nonota`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penjualan_detail_ibfk_2` FOREIGN KEY (`barcode`) REFERENCES `barang_detail` (`barcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penjualan_detail`
--

LOCK TABLES `penjualan_detail` WRITE;
/*!40000 ALTER TABLE `penjualan_detail` DISABLE KEYS */;
INSERT INTO `penjualan_detail` VALUES
('000001','139875032890250525',2),
('000002','139875032890250525',8),
('000003','139875032890250625',8),
('000004','139875032890250625',1);
/*!40000 ALTER TABLE `penjualan_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penyesuaian`
--

DROP TABLE IF EXISTS `penyesuaian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penyesuaian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1: approve, 0: not approve',
  PRIMARY KEY (`id`),
  KEY `penyesuaian_ibfk_1` (`barcode`),
  CONSTRAINT `penyesuaian_ibfk_1` FOREIGN KEY (`barcode`) REFERENCES `barang_detail` (`barcode`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penyesuaian`
--

LOCK TABLES `penyesuaian` WRITE;
/*!40000 ALTER TABLE `penyesuaian` DISABLE KEYS */;
INSERT INTO `penyesuaian` VALUES
(1,'139875032890250525','2024-11-02',10,'Stok Awal',1),
(2,'139875032890250525','2024-11-02',10,'Stok Awal',1),
(3,'139875032890250525','2024-11-02',10,'Stok Awal',1),
(5,'139875032890250525','2024-11-05',-5,'Rusak',0),
(10,'139875032890250625','2025-01-21',10,'Stok Awal',1);
/*!40000 ALTER TABLE `penyesuaian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retur_beli`
--

DROP TABLE IF EXISTS `retur_beli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retur_beli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_suplier` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('proses','tukar') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `retur_beli_ibfk_1` (`id_suplier`),
  CONSTRAINT `retur_beli_ibfk_1` FOREIGN KEY (`id_suplier`) REFERENCES `suplier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retur_beli`
--

LOCK TABLES `retur_beli` WRITE;
/*!40000 ALTER TABLE `retur_beli` DISABLE KEYS */;
INSERT INTO `retur_beli` VALUES
(1,1,'2024-12-28','proses');
/*!40000 ALTER TABLE `retur_beli` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retur_beli_detail`
--

DROP TABLE IF EXISTS `retur_beli_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retur_beli_detail` (
  `id` int(11) NOT NULL,
  `barcode` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL,
  KEY `retur_beli_detail_ibfk_2` (`barcode`),
  KEY `retur_beli_detail_ibfk_1` (`id`),
  CONSTRAINT `retur_beli_detail_ibfk_1` FOREIGN KEY (`id`) REFERENCES `retur_beli` (`id`),
  CONSTRAINT `retur_beli_detail_ibfk_2` FOREIGN KEY (`barcode`) REFERENCES `barang_detail` (`barcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retur_beli_detail`
--

LOCK TABLES `retur_beli_detail` WRITE;
/*!40000 ALTER TABLE `retur_beli_detail` DISABLE KEYS */;
INSERT INTO `retur_beli_detail` VALUES
(1,'139875032890250525',6);
/*!40000 ALTER TABLE `retur_beli_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retur_jual`
--

DROP TABLE IF EXISTS `retur_jual`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retur_jual` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `alasan` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `retur_jual_ibfk_1` (`pelanggan_id`),
  CONSTRAINT `retur_jual_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retur_jual`
--

LOCK TABLES `retur_jual` WRITE;
/*!40000 ALTER TABLE `retur_jual` DISABLE KEYS */;
INSERT INTO `retur_jual` VALUES
(1,'2024-12-28 11:13:31',1,'');
/*!40000 ALTER TABLE `retur_jual` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retur_jual_detail`
--

DROP TABLE IF EXISTS `retur_jual_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retur_jual_detail` (
  `id` int(11) NOT NULL,
  `barcode` varchar(30) NOT NULL,
  `jumlah` int(11) NOT NULL,
  KEY `retur_jual_detail_ibfk_2` (`barcode`),
  KEY `retur_jual_detail_ibfk_1` (`id`),
  CONSTRAINT `retur_jual_detail_ibfk_1` FOREIGN KEY (`id`) REFERENCES `retur_jual` (`id`),
  CONSTRAINT `retur_jual_detail_ibfk_2` FOREIGN KEY (`barcode`) REFERENCES `barang_detail` (`barcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retur_jual_detail`
--

LOCK TABLES `retur_jual_detail` WRITE;
/*!40000 ALTER TABLE `retur_jual_detail` DISABLE KEYS */;
INSERT INTO `retur_jual_detail` VALUES
(1,'139875032890250525',3);
/*!40000 ALTER TABLE `retur_jual_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namasales` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `omzet` int(11) NOT NULL,
  `komisi` decimal(10,4) NOT NULL,
  `gajipokok` int(11) NOT NULL,
  `is_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES
(1,'Agus Budiman','Balis','Balis','082282887855',500000,0.0000,0,'yes','2024-09-13 11:59:05','2024-10-12 13:58:01',NULL,NULL,NULL),
(2,'Agus Santoso','Jl HOS cokroaminoto 10','Badung Selatan','082555220',100000000,2.0000,0,'no','2024-09-13 12:26:21','2024-09-13 12:35:36',NULL,NULL,NULL),
(3,'Wayan Sales Marketing','Mengwi 01','Denpasar','0999',1000000,2.0000,0,'no','2024-10-07 12:48:58','2024-10-12 07:06:42',NULL,NULL,NULL),
(4,'Agus Budiharto','Bali','Bali','082282887855',100000000,0.0100,1500000,'no','2024-10-07 14:50:12','2025-01-23 15:24:56','','agus','f865b53623b121fd34ee5426c792e5c33af8c227'),
(5,'ardi','Mengwi','Badung','0811111111111',100000,0.0000,0,'no','2024-10-12 05:26:29',NULL,NULL,NULL,NULL),
(6,'ardi','Mengwi','Badung','0811111111111',100000,0.0000,0,'yes','2024-10-12 05:45:05','2024-10-12 06:39:06',NULL,NULL,NULL),
(7,'Nama Ari','Jln Gatsu Timur Gang Cemara no 5','Badung','123333',1234,0.0000,0,'yes','2024-10-12 05:45:42','2024-10-12 06:53:44',NULL,NULL,NULL),
(8,'Nama Ari','Jln Gatsu Timur Gang Cemara no 5','Badung','123333',1234,0.0000,0,'yes','2024-10-12 05:46:11','2024-10-12 06:53:35',NULL,NULL,NULL),
(9,'Nama Ari','Jln Gatsu Timur Gang Cemara no 5','Badung','123333',1234,0.0000,0,'yes','2024-10-12 05:46:38','2024-10-12 06:45:18',NULL,NULL,NULL),
(10,'Kadek','jln sari kuning','Tabanan','123333',123333,0.0000,0,'no','2024-10-12 05:50:19',NULL,NULL,NULL,NULL),
(11,'Herman','Jln Raya Baturiti','Tabanan','0888888888888',500000,0.0000,0,'no','2024-10-12 06:18:12',NULL,NULL,NULL,NULL),
(12,'Kurniawan','jln mawar','Denpasar','0812341231231',0,0.0000,0,'no','2024-10-12 07:08:36',NULL,NULL,NULL,NULL),
(13,'Sidik','Jln Gatsu Barat Gang Jelantik','Denpasar','08765432132323',0,0.0000,0,'no','2024-10-12 07:21:03','2024-10-12 14:00:49',NULL,NULL,NULL),
(14,'test 2','alamat 2','kota 2','2',2,0.0000,0,'yes','2024-10-12 07:21:23','2024-10-12 13:58:45',NULL,NULL,NULL),
(15,'test 2','alamat 2','kota 2','2',2,0.0000,0,'yes','2024-10-12 07:21:24','2024-10-12 13:58:32',NULL,NULL,NULL),
(16,'test 3','test 3','kota 3','3',3,0.0000,0,'yes','2024-10-12 07:21:45','2024-10-12 13:56:39',NULL,NULL,NULL),
(17,'test 4','alamat 4','kota 4','4',4,0.0000,0,'yes','2024-10-12 07:22:02','2024-10-12 13:57:36',NULL,NULL,NULL),
(19,'Badai','jln Antasura','Denpasar','0921222222222',2000000,0.0000,0,'no','2024-10-12 13:54:27',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `satuan`
--

DROP TABLE IF EXISTS `satuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namasatuan` varchar(10) NOT NULL,
  `is_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `satuan` (`namasatuan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `satuan`
--

LOCK TABLES `satuan` WRITE;
/*!40000 ALTER TABLE `satuan` DISABLE KEYS */;
INSERT INTO `satuan` VALUES
(1,'pcs','no','2024-09-13 06:51:08','2024-09-13 06:52:35'),
(2,'box','yes','2024-09-13 06:52:39','2024-09-13 06:55:39'),
(3,'Buahs','yes','2024-10-14 13:35:43','2024-10-14 14:24:11'),
(4,'Lusin','no','2024-10-14 13:49:09',NULL);
/*!40000 ALTER TABLE `satuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suplier`
--

DROP TABLE IF EXISTS `suplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namasuplier` varchar(100) NOT NULL,
  `pemilik` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `norek` varchar(50) NOT NULL,
  `namabank` varchar(50) NOT NULL,
  `anbank` varchar(50) NOT NULL,
  `is_delete` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suplier`
--

LOCK TABLES `suplier` WRITE;
/*!40000 ALTER TABLE `suplier` DISABLE KEYS */;
INSERT INTO `suplier` VALUES
(1,'Dry Food','Jojo','alamat 123','Kota A','081234234234','1370000001111','Mandiri','Sumanto','no','2024-09-14 00:18:03','2024-10-16 01:39:17'),
(2,'Romusha','Andik','alamat 123','Kota A','081234234234','1370000001111','Mandiri','Sumanto','no','2024-10-14 14:41:39','2024-10-16 04:39:40'),
(3,'Red Hat','','jln sari kuning no 123','Jakarta','08512312312333333333','122222','BNI','Jeniffer Lopes','yes','2024-10-15 09:48:41','2024-10-15 10:10:29');
/*!40000 ALTER TABLE `suplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pengguna_id` int(11) NOT NULL,
  `akses` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`akses`)),
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengguna_id_2` (`pengguna_id`),
  KEY `pengguna_id` (`pengguna_id`),
  CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` VALUES
(22,9,'{\"setup\":[\"daftar_pengguna\",\"daftar_sales\"],\"laporan\":[\"mutasi_stok\",\"outlet_idle\"]}'),
(30,10,'[]');
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-02-03 11:59:38
