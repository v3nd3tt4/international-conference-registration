/*
SQLyog Ultimate v10.3 
MySQL - 8.0.30 : Database - db_icgc
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_icgc` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `db_icgc`;

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(40) COLLATE utf8mb3_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb3_unicode_ci NOT NULL,
  `timestamp` int unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

/*Data for the table `ci_sessions` */

insert  into `ci_sessions`(`id`,`ip_address`,`timestamp`,`data`) values ('asprqd2ln6j3akptu5jja5lccq3b7v6c','127.0.0.1',1728704619,'__ci_last_regenerate|i:1728704600;is_login|b:1;username|s:4:\"goku\";level|s:5:\"admin\";nama|s:4:\"goku\";photo|N;paper|N;revisi|N;'),('el58j80rnmv97je5fl9bcglo60eqe17g','127.0.0.1',1728695405,'__ci_last_regenerate|i:1728695222;'),('umd5r12kdeqotre27u8thp2gkhjgbcqf','127.0.0.1',1728704145,'__ci_last_regenerate|i:1728703965;');

/*Table structure for table `tb_file_upload` */

DROP TABLE IF EXISTS `tb_file_upload`;

CREATE TABLE `tb_file_upload` (
  `id_file_upload` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tb_file_upload` */

/*Table structure for table `tb_jenis_peserta` */

DROP TABLE IF EXISTS `tb_jenis_peserta`;

CREATE TABLE `tb_jenis_peserta` (
  `id_jenis_peserta` int NOT NULL AUTO_INCREMENT,
  `nama_jenis_peserta` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jenis_peserta`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_jenis_peserta` */

insert  into `tb_jenis_peserta`(`id_jenis_peserta`,`nama_jenis_peserta`) values (1,'soc'),(2,'loc'),(3,'reguler'),(4,'business meeting');

/*Table structure for table `tb_pendaftar` */

DROP TABLE IF EXISTS `tb_pendaftar`;

CREATE TABLE `tb_pendaftar` (
  `id_pendaftar` int NOT NULL AUTO_INCREMENT,
  `nama_pendaftar` varchar(255) DEFAULT NULL,
  `id_negara` int DEFAULT NULL,
  `nama_negara` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `affiliation` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `id_jenis_peserta` varchar(255) DEFAULT NULL,
  `no_reg` varchar(255) DEFAULT NULL,
  `paper` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `abstract` varchar(255) DEFAULT NULL,
  `full_paper` varchar(255) DEFAULT NULL,
  `tittle` varchar(255) DEFAULT NULL,
  `abstract_text` text,
  `id_topics` int DEFAULT NULL,
  `keyword_abstract` varchar(255) DEFAULT NULL,
  `status_verifikasi` varchar(255) DEFAULT NULL,
  `komentar` text,
  `file_revisi` varchar(255) DEFAULT NULL,
  `file_after_revisi` varchar(255) DEFAULT NULL,
  `join_excursion` varchar(5) DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pendaftar`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pendaftar` */


/*Table structure for table `tb_ref_negara` */

DROP TABLE IF EXISTS `tb_ref_negara`;

CREATE TABLE `tb_ref_negara` (
  `id_ref_negara` int NOT NULL AUTO_INCREMENT,
  `nama_negara` varchar(255) NOT NULL,
  PRIMARY KEY (`id_ref_negara`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `tb_ref_negara` */

insert  into `tb_ref_negara`(`id_ref_negara`,`nama_negara`) values (1,'Indonesian'),(2,'Philippines'),(3,'Malaysia'),(4,'Singapore'),(5,'Thailand'),(6,'Brunei'),(7,'Vietnam'),(8,'Laos'),(9,'Myanmar'),(10,'Cambodia'),(11,'Timor Leste'),(12,'Others');

/*Table structure for table `tb_revisi` */

DROP TABLE IF EXISTS `tb_revisi`;

CREATE TABLE `tb_revisi` (
  `id_revisi` int NOT NULL AUTO_INCREMENT,
  `id_pendaftar` int DEFAULT NULL,
  `hasil_revisi` varchar(255) DEFAULT NULL,
  `status_paper` varchar(255) DEFAULT NULL,
  `file_hrs_direvisi` varchar(255) DEFAULT NULL,
  `file_setelah_revisi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_revisi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_revisi` */

/*Table structure for table `tb_topics` */

DROP TABLE IF EXISTS `tb_topics`;

CREATE TABLE `tb_topics` (
  `id_topics` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id_topics`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tb_topics` */

insert  into `tb_topics`(`id_topics`,`title`) values (1,'Theoretical Astronomy and Astrophysics'),(2,'Optical Astronomy'),(3,'Radio Astronomy'),(4,'Solar Physics and Neutrino'),(5,'Space Science Education Interdisciplinary (Earth and Disaster)'),(6,'Interdisciplinary Topics Related to Earth and Planetary Sciences');

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tb_user` */

insert  into `tb_user`(`id_user`,`username`,`password`,`level`) values (1,'pilopaokta@gmail.com','$2y$10$rgf8Bex/0HgqM87lhF/6yO7r4ozWD5EuI880/qy3t5YMbbKPNQ.DW','pendaftar'),(2,'goku','$2y$10$rgf8Bex/0HgqM87lhF/6yO7r4ozWD5EuI880/qy3t5YMbbKPNQ.DW','admin'),(3,'wsphidjo@gmail.com','$2y$10$sKMLIOLu01INStElkJJZGuyEx0IoifIQlFzolE/wPqsmHKG06tOXC','pendaftar'),(4,'oktapilopa27@gmail.com','$2y$10$uZ4Jr7jh9EJIoOhm3o1Yc.uBdtTD7Uw4MGG4PUwj6JBZV1YQP7ENe','pendaftar'),(5,'heri@gmail.com','$2y$10$7TH4U4iziwhvUsBY4ZcscuM0xlZQS8k8yErCARbHGyh1bskiYhpoO','pendaftar'),(6,'heri@it.ac.id','$2y$10$zJEDj.GEwix4EBTWa0uMYOGvofr4Ai4BbxuScVIf8nhP2OoJZfwm.','pendaftar'),(7,'okta.pilopa@staff.itera.ac.id','$2y$10$90teEg3k2nsrAXt5xtbgVOvTaK1toLG3EVul6tGBaSi1EmQqZorR6','pendaftar'),(8,'okta.pilopa@staff.itera.ac.id','$2y$10$P2cNIBvpmOVvLGhOCU2w8eOQWGCA8QQDeT6kSiJq9TQ.99FtGCjZ.','pendaftar');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
