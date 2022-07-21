/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.4.20-MariaDB : Database - access-control
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`access-control` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `access-control`;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text DEFAULT NULL,
  `id_number` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`id_number`,`email`,`password`,`admin`,`created`) values (22,'nitro5','91060350258896','nic.mantzivis@gmail.com','$2y$10$hofVITzwDUnyZV0Dw7FOzu/lobYUO6CFt/sxNZw8hu61d92Us//T2',1,'2021-11-13 18:51:21'),(28,'Jared','1234567890','jarednaidoo6@gmail.com','$2y$10$yGq4/yXReKzeTq4YFr2Z2OCDPbjz4P5qEQ5HSPlJ3hBQDMjqjF6.u',1,'2021-11-13 19:06:52');

/*Table structure for table `visitors` */

DROP TABLE IF EXISTS `visitors`;

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `contact_number` varchar(256) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `time_of_entry` timestamp NOT NULL DEFAULT current_timestamp(),
  `time_of_exit` datetime DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `visitors` */

insert  into `visitors`(`id`,`name`,`email`,`contact_number`,`reason`,`time_of_entry`,`time_of_exit`,`created`) values (2,'James','james@jones.com','1234567489','Work','2021-11-13 17:08:26','2021-11-13 17:20:22','2021-11-13 17:08:26'),(3,'Raynard','ray@elemental.co.za','987984615651','Tenant','2021-11-13 17:09:02',NULL,'2021-11-13 17:09:02'),(4,'Chino','marino@deftones.com','9876543210','Performance','2021-11-13 17:10:36',NULL,'2021-11-13 17:10:36'),(5,'Jacob','jacob@cct.co.za','123456789','Cleaning','2021-11-13 17:11:08','2021-11-13 17:26:07','2021-11-13 17:11:08'),(6,'Maria','mar@username.co.za','651651651610310','Visiting','2021-11-13 19:02:07',NULL,'2021-11-13 19:02:07');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
