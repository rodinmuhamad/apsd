/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 5.7.28 : Database - apsd
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`apsd` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `apsd`;

/*Table structure for table `akses` */

DROP TABLE IF EXISTS `akses`;

CREATE TABLE `akses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `akses` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `akses` */

insert  into `akses`(`id`,`user_id`,`akses`,`created_at`,`updated_at`) values 
(1,1,'akses','2023-01-31 04:45:41','2023-01-31 04:45:41'),
(2,1,'produk','2023-01-31 04:45:45','2023-01-31 04:45:45'),
(3,1,'order','2023-01-31 04:45:48','2023-01-31 04:45:48'),
(4,1,'user','2023-01-31 04:45:52','2023-01-31 04:45:52');

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `produk` */

insert  into `produk`(`id`,`name`,`harga`,`image`,`created_at`,`updated_at`) values 
(1,'produk roti','1000','assets/user/369100.jpeg','2023-01-31 05:42:10','2023-01-31 05:42:56');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`level`,`email`,`email_verified_at`,`password`,`remember_token`,`image`,`created_at`,`updated_at`) values 
(1,'Muhamad Rodin','admin','muhamadrodin@gmail.com',NULL,'$2y$10$XezFHADDsX8D8buFjO2.fO1kQN0PZ/fFrDkQ7ETGOOnlK0Tc2z.8e','esr0p1IjiMre7f3FFuRcydur8lbOKLXTAVyYzRoAUrwhOWUGfswMcza8wK4s',NULL,'2023-01-30 06:14:39','2023-01-30 06:14:39'),
(2,'user','user','user@mail.com',NULL,'$2y$10$ZLFjfK7LCO8O9iBVNFFU3.2wd1NVEJC8xovMZGAljmoV9Lk3fViGK','JRax6oXW3r2epLjgb8slObkBrLA7OvZTfq6le8C2xQ0zgbpVXF6mnURP6fCC',NULL,'2023-01-30 06:37:04','2023-01-30 06:37:04'),
(3,'tes1a','user','tes1@gmail.com',NULL,'$2y$10$WjacHqnyxsG.CHByArkbsu6293hlHUvEhgVE8oY4qs/Ya4SduVCwK','YvB2WuXn5aLwxy6C3iP7cr0zLBLfiMRZMYLZfN9FfZjpMIh8Zlfe01CQeyvj','assets/user/240487.jpeg','2023-01-30 08:57:20','2023-01-31 03:14:33'),
(18,'a','admin','a@a.v',NULL,'$2y$10$5lMY2EbRk/WmeMNjMfq0YeF0ZINwOimLctAtCYk.7p7FKOOJfeej6','wAeYifcDqbc0M9TVnjVHIk5bnEqSr7jtdpTKEfL1ZxvrB1IGj66GAHRRUp5g',NULL,'2023-01-31 02:34:23','2023-01-31 02:34:23');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
