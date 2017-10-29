/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.7.14 : Database - myrclhome
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`myrclhome` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `myrclhome`;

/*Table structure for table `application_users` */

DROP TABLE IF EXISTS `application_users`;

CREATE TABLE `application_users` (
  `id` int(21) NOT NULL,
  `user_id` int(21) NOT NULL,
  `application_id` int(12) NOT NULL,
  `role_id` int(12) DEFAULT NULL,
  `updated_by` int(21) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(21) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `application_users` */

insert  into `application_users`(`id`,`user_id`,`application_id`,`role_id`,`updated_by`,`updated_at`,`created_by`,`created_at`,`deleted_at`) values (1,1,1,1,1,'2017-10-29 19:46:49',1,'2017-10-29 19:46:52',NULL);

/*Table structure for table `applications` */

DROP TABLE IF EXISTS `applications`;

CREATE TABLE `applications` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `description` text,
  `url` text,
  `updated_by` int(12) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(12) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `applications` */

insert  into `applications`(`id`,`code`,`name`,`description`,`url`,`updated_by`,`updated_at`,`created_by`,`created_at`,`deleted_at`) values (1,'MRCLCT1','My RCL Crew Travel','This is For the Application is For the RCL Crew Travel','https://www.myrclcrewtravel.com',1,'2017-10-29 17:57:08',NULL,'2017-10-29 17:35:19',NULL);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `application_id` int(12) NOT NULL,
  `code` varchar(30) NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` text,
  `updated_by` int(12) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(21) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `roles` */

/*Table structure for table `tokens` */

DROP TABLE IF EXISTS `tokens`;

CREATE TABLE `tokens` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `user_id` int(21) DEFAULT NULL,
  `token` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `expires_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `tokens` */

insert  into `tokens`(`id`,`user_id`,`token`,`created_at`,`updated_at`,`expires_at`) values (1,1,'abakjshdfkjashd','2017-12-31 17:21:12','2017-10-29 23:06:34','2017-10-29 23:06:34'),(2,1,'c3d51eaaa2d33ed2215a91078ac6edb7','2017-10-29 20:41:11','2017-10-29 23:06:34','2017-10-29 23:06:34'),(3,1,'54c483205d7aa646508b49cb9faa11b9','2017-10-29 21:40:19','2017-10-29 23:06:34','2017-10-29 23:06:34'),(4,1,'6d94406fdc4b1940b17444e0dbaee4b4','2017-10-29 22:47:49','2017-10-29 23:06:34','2017-10-29 23:06:34'),(5,1,'ec3f2bbdcd0a3a131ae30bc6e1017f06','2017-10-29 22:47:59','2017-10-29 23:06:34','2017-10-29 23:06:34'),(6,1,'00b1f3679f15ce71c61f80f6a2acd87e','2017-10-29 22:53:16','2017-10-29 23:06:34','2017-10-29 23:06:34'),(7,1,'4e95f130ae4e64d558c8cd2787452998','2017-10-29 22:56:37','2017-10-29 23:06:34','2017-10-29 23:06:34'),(8,1,'47386f0cb3a6970614fabc24ee93770f','2017-10-29 23:02:38','2017-10-29 23:06:34','2017-10-29 23:06:34'),(9,1,'3fe6d8d5c40ac1e1e8018516835eb55c','2017-10-29 23:03:25','2017-10-29 23:06:34','2017-10-29 23:06:34'),(10,1,'72752c184ae86b7521a3a4978665b943','2017-10-29 23:05:17','2017-10-29 23:06:34','2017-10-29 23:06:34'),(11,1,'db1b5697726f92439a59cd11cb9e634b','2017-10-29 23:05:53','2017-10-29 23:06:34','2017-10-29 23:06:34'),(12,1,'2895a06a3713e34832ea213c69e5c132','2017-10-29 23:06:13','2017-10-29 23:06:34','2017-10-29 23:06:34'),(13,1,'25e53e3c375139ff236d9951a78daf0f','2017-10-29 23:06:34','2017-10-29 23:07:39','2017-10-29 23:07:39');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL,
  `password` varchar(120) NOT NULL,
  `first_name` varchar(70) DEFAULT NULL,
  `middle_name` varchar(60) DEFAULT NULL,
  `last_name` varchar(70) DEFAULT NULL,
  `updated_by` int(12) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`password`,`first_name`,`middle_name`,`last_name`,`updated_by`,`updated_at`,`created_by`,`created_at`,`deleted_at`) values (1,'admin@myrclhome.com','e19d5cd5af0378da05f63f891c7467af','Karl','Marasigan','Pandacan',NULL,'2017-10-29 14:40:54',NULL,'2017-10-29 05:08:30',NULL),(2,'superadmin@myrclhome.com','e99a18c428cb38d5f260853678922e03','Karl','Marasigan','Pandacan',NULL,'2017-10-29 15:37:42',NULL,'2017-10-29 13:10:56','2017-10-29 15:37:42');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
