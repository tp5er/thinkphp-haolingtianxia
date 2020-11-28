/*
Navicat MySQL Data Transfer

Source Server         : 118.190.173.36
Source Server Version : 50549
Source Host           : 118.190.173.36:3306
Source Database       : hao

Target Server Type    : MYSQL
Target Server Version : 50549
File Encoding         : 65001

Date: 2017-10-06 14:24:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_attri
-- ----------------------------
DROP TABLE IF EXISTS `tp_attri`;
CREATE TABLE `tp_attri` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `phone` varchar(100) DEFAULT NULL,
  `num` int(11) unsigned zerofill DEFAULT NULL,
  `prov` varchar(100) DEFAULT NULL,
  `ret_code` varchar(100) DEFAULT NULL,
  `areaCode` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `cityCode` varchar(100) DEFAULT NULL,
  `postCode` varchar(100) DEFAULT NULL,
  `provCode` varchar(100) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `way` int(11) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
