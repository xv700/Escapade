# Host: localhost  (Version: 5.5.53)
# Date: 2020-09-24 14:20:49
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

#
# Data for table "users"
#

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'JspStudy','JspStudy','JspStudy'),(2,'JspStudy','JspStudy','JspStudy'),(3,'mysql测试','mysql测试','mysql测试'),(4,'JspStudy','JspStudy','JspStudy'),(5,'dsdfdsf','dsfdfsghdsfg','aaaaaaaaa'),(6,'dsdsffds','ddd','dddddd'),(7,'666666','6666','7777777'),(8,'cccccccccc','bbbbbbbbbb','aaaaaaaaa'),(9,'1111111111','dddddddddd','999999999999'),(10,'fffffffff','vvvvvvvvvvv','94656544');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
