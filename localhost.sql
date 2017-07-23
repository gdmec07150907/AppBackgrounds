-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 07 月 23 日 14:18
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `speed`
--
CREATE DATABASE `speed` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `speed`;

-- --------------------------------------------------------

--
-- 表的结构 `think_administrators`
--

CREATE TABLE IF NOT EXISTS `think_administrators` (
  `administrators_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员id',
  `administrators_name` varchar(50) CHARACTER SET utf8mb4 NOT NULL COMMENT '用户名',
  `administrators_realName` varchar(20) DEFAULT NULL COMMENT '真实姓名',
  `administrators_phone` varchar(15) DEFAULT NULL,
  `administrators_email` varchar(100) DEFAULT NULL,
  `administrators_idNumber` char(18) DEFAULT NULL COMMENT '身份证号码',
  `administrators_sex` enum('男','女') DEFAULT NULL,
  `administrators_jurisdiction` enum('一般管理员','超级管理员') DEFAULT NULL COMMENT '管理员权限',
  `administrators_date` varchar(20) DEFAULT NULL COMMENT '注册日期',
  `administrators_portrait` varchar(500) DEFAULT NULL COMMENT '头像',
  `administrators_state` enum('可用','不可用') DEFAULT '可用' COMMENT '状态',
  PRIMARY KEY (`administrators_name`),
  KEY `administrators_id` (`administrators_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=34 ;

--
-- 转存表中的数据 `think_administrators`
--

INSERT INTO `think_administrators` (`administrators_id`, `administrators_name`, `administrators_realName`, `administrators_phone`, `administrators_email`, `administrators_idNumber`, `administrators_sex`, `administrators_jurisdiction`, `administrators_date`, `administrators_portrait`, `administrators_state`) VALUES
(31, 'admin', NULL, '13268028974', '', '', NULL, NULL, '2017-07-21 15:17:11', NULL, NULL),
(32, 'chan', NULL, '13268028973', '', '', NULL, NULL, '2017-07-21 20:55:10', NULL, NULL),
(33, 'heo', NULL, '13268038972', '', '', NULL, NULL, '2017-07-22 11:08:59', NULL, '可用');

--
-- 触发器 `think_administrators`
--
DROP TRIGGER IF EXISTS `administrators_delete`;
DELIMITER //
CREATE TRIGGER `administrators_delete` AFTER DELETE ON `think_administrators`
 FOR EACH ROW delete from think_administratorsregister where administrators_id=old.administrators_id
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `think_administratorsregister`
--

CREATE TABLE IF NOT EXISTS `think_administratorsregister` (
  `administrators_id` int(11) NOT NULL AUTO_INCREMENT,
  `administrators_name` varchar(50) NOT NULL,
  `administrators_password` varchar(32) NOT NULL,
  `administrators_phone` varchar(15) NOT NULL,
  `administrators_email` varchar(100) NOT NULL,
  `administrators_idNumber` char(18) NOT NULL,
  `administrators_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`administrators_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员注册' AUTO_INCREMENT=34 ;

--
-- 转存表中的数据 `think_administratorsregister`
--

INSERT INTO `think_administratorsregister` (`administrators_id`, `administrators_name`, `administrators_password`, `administrators_phone`, `administrators_email`, `administrators_idNumber`, `administrators_date`) VALUES
(31, 'admin', '123456', '13268028974', '', '', '2017-07-21 07:17:11'),
(32, 'chan', '123456', '13268028973', '', '', '2017-07-21 12:55:10'),
(33, 'heo', '123456', '13268038972', '', '', '2017-07-22 03:08:59');

--
-- 触发器 `think_administratorsregister`
--
DROP TRIGGER IF EXISTS `administrators_insert`;
DELIMITER //
CREATE TRIGGER `administrators_insert` AFTER INSERT ON `think_administratorsregister`
 FOR EACH ROW insert into think_administrators(administrators_id,administrators_name,administrators_phone,administrators_email,administrators_idNumber,administrators_date) values(new.administrators_id,new.administrators_name,new.administrators_phone,new.administrators_email,new.administrators_idNumber,new.administrators_date)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `think_carinfo`
--

CREATE TABLE IF NOT EXISTS `think_carinfo` (
  `driver_id` int(11) NOT NULL COMMENT '司机id',
  `car_number` char(7) NOT NULL COMMENT '车牌号',
  `car_state` varchar(20) NOT NULL COMMENT '车辆状态',
  `loading_quantity` varchar(10) NOT NULL COMMENT '容货量',
  PRIMARY KEY (`car_number`),
  KEY `driver_id` (`driver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='公司司机车辆表';

-- --------------------------------------------------------

--
-- 表的结构 `think_company`
--

CREATE TABLE IF NOT EXISTS `think_company` (
  `company_id` varchar(10) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_synopsis` varchar(100) NOT NULL COMMENT '公司简介',
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='配送公司表';

-- --------------------------------------------------------

--
-- 表的结构 `think_consigneeinfo`
--

CREATE TABLE IF NOT EXISTS `think_consigneeinfo` (
  `goods_id` varchar(50) NOT NULL COMMENT '快件id',
  `consignee_name` varchar(10) NOT NULL COMMENT '收货人姓名',
  `consignee_phone` varchar(20) NOT NULL COMMENT '收货人号码',
  `consignee_address` varchar(100) NOT NULL COMMENT '收货地址',
  `consignee_time` varchar(20) NOT NULL COMMENT '预计取件时间',
  PRIMARY KEY (`goods_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收货人信息表';

-- --------------------------------------------------------

--
-- 表的结构 `think_delivery`
--

CREATE TABLE IF NOT EXISTS `think_delivery` (
  `goods_id` varchar(50) NOT NULL COMMENT '货物id',
  `delivery_address` varchar(100) NOT NULL COMMENT '送货地址',
  `delivery_way` varchar(10) NOT NULL COMMENT '配送方式（普通，加急配送）',
  `budget_price` varchar(10) NOT NULL COMMENT '估计价格',
  `delivery_cod` double NOT NULL COMMENT '代收货款',
  `delivery_valuation` double NOT NULL COMMENT '保价',
  `delivery_time` varchar(20) NOT NULL COMMENT '预计收货时间',
  `arrival_time` varchar(20) NOT NULL COMMENT '预计送达时间',
  `delivery_state` varchar(10) NOT NULL COMMENT '状态',
  PRIMARY KEY (`goods_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='配送信息表';

--
-- 触发器 `think_delivery`
--
DROP TRIGGER IF EXISTS `goods_id_insert`;
DELIMITER //
CREATE TRIGGER `goods_id_insert` AFTER INSERT ON `think_delivery`
 FOR EACH ROW insert into think_deliveryaddressinfo(goods_id) values(new.goods_id)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `think_deliveryaddressinfo`
--

CREATE TABLE IF NOT EXISTS `think_deliveryaddressinfo` (
  `goods_id` varchar(50) NOT NULL COMMENT '快件id',
  `address_id` int(11) NOT NULL COMMENT '地址id',
  `delivery_province` varchar(10) NOT NULL COMMENT '省',
  `delivery_city` varchar(10) NOT NULL COMMENT '市',
  `delivery_area` varchar(10) NOT NULL COMMENT '区',
  `delivery_street` varchar(20) NOT NULL COMMENT '街道',
  `delivery_streetNO` varchar(20) NOT NULL COMMENT '门牌号',
  PRIMARY KEY (`address_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='发货地址信息表';

-- --------------------------------------------------------

--
-- 表的结构 `think_didicar`
--

CREATE TABLE IF NOT EXISTS `think_didicar` (
  `didi_id` int(11) NOT NULL COMMENT '滴滴司机id',
  `car_number` char(7) NOT NULL COMMENT '车牌号',
  `car_state` varchar(20) NOT NULL COMMENT '状态',
  `car_capacity` varchar(10) NOT NULL COMMENT '容货量',
  PRIMARY KEY (`car_number`),
  KEY `didi_id` (`didi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='滴滴司机车辆表';

-- --------------------------------------------------------

--
-- 表的结构 `think_dididriver`
--

CREATE TABLE IF NOT EXISTS `think_dididriver` (
  `didi_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '滴滴司机id',
  `didi_name` varchar(10) NOT NULL COMMENT '名字',
  `didi_phone` varchar(15) NOT NULL COMMENT '电话号码',
  PRIMARY KEY (`didi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='滴滴司机表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_driverinfo`
--

CREATE TABLE IF NOT EXISTS `think_driverinfo` (
  `driver_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '司机id',
  `driver_name` varchar(50) NOT NULL COMMENT '司机用户名',
  `driver_realName` varchar(30) NOT NULL COMMENT '司机真实姓名',
  `driver_phone` varchar(15) NOT NULL,
  `driver_email` varchar(30) NOT NULL,
  `driver_idNumber` varchar(18) NOT NULL COMMENT '身份证号',
  `driver_gender` enum('男','女') NOT NULL COMMENT '性别',
  `driver_credit` enum('1','2','3','4','5') DEFAULT NULL COMMENT '信用等级',
  `driver_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '注册日期',
  `driver_img` varchar(100) NOT NULL COMMENT '头像',
  `driver_state` enum('可用','不可用') DEFAULT NULL COMMENT '状态',
  `driver_star` enum('1','2','3','4','5') DEFAULT NULL COMMENT '星数',
  PRIMARY KEY (`driver_name`),
  UNIQUE KEY `driver_id` (`driver_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `think_driverinfo`
--

INSERT INTO `think_driverinfo` (`driver_id`, `driver_name`, `driver_realName`, `driver_phone`, `driver_email`, `driver_idNumber`, `driver_gender`, `driver_credit`, `driver_date`, `driver_img`, `driver_state`, `driver_star`) VALUES
(3, 'admin', '马帅', '15622117239', '1342367949@qq.com', '440582199612295896', '男', '1', '2017-05-23 17:14:51', '', '可用', '1'),
(4, 'chan', 'heo', '15622117288', '1342367949@163.com', '440582199612295869', '男', NULL, '2017-05-23 14:08:32', '', NULL, NULL);

--
-- 触发器 `think_driverinfo`
--
DROP TRIGGER IF EXISTS `driver_delete`;
DELIMITER //
CREATE TRIGGER `driver_delete` AFTER DELETE ON `think_driverinfo`
 FOR EACH ROW delete from think_driverregister where driver_id=old.driver_id
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `think_driverregister`
--

CREATE TABLE IF NOT EXISTS `think_driverregister` (
  `driver_id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_name` varchar(50) NOT NULL,
  `driver_password` varchar(32) NOT NULL,
  `driver_email` varchar(30) NOT NULL,
  `driver_phone` varchar(20) NOT NULL COMMENT '司机号码',
  `driver_realName` varchar(50) NOT NULL COMMENT '真实姓名',
  `driver_idNumber` varchar(20) NOT NULL COMMENT '身份证号',
  `driver_gender` enum('男','女') NOT NULL COMMENT '性别',
  `driver_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '注册时间',
  PRIMARY KEY (`driver_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='司机注册表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `think_driverregister`
--

INSERT INTO `think_driverregister` (`driver_id`, `driver_name`, `driver_password`, `driver_email`, `driver_phone`, `driver_realName`, `driver_idNumber`, `driver_gender`, `driver_date`) VALUES
(3, 'admin', '123456', '1342367949@qq.com', '15622117239', '马帅', '440582199612295896', '男', '2017-05-23 14:08:32'),
(4, 'chan', '123456', '1342367949@163.com', '15622117288', 'heo', '440582199612295869', '男', '2017-05-23 14:08:32');

--
-- 触发器 `think_driverregister`
--
DROP TRIGGER IF EXISTS `driver_insert`;
DELIMITER //
CREATE TRIGGER `driver_insert` AFTER INSERT ON `think_driverregister`
 FOR EACH ROW insert into think_driverinfo(driver_id,driver_name,driver_phone,driver_email,driver_realName,driver_idNumber,driver_gender,driver_date) values(new.driver_id,new.driver_name,new.driver_phone,new.driver_email,new.driver_realName,new.driver_idNumber,new.driver_gender,new.driver_date)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `think_evaluation`
--

CREATE TABLE IF NOT EXISTS `think_evaluation` (
  `evaluation_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '评价ID',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `driver_id` int(11) NOT NULL COMMENT '司机ID',
  `goods_id` varchar(50) NOT NULL COMMENT '快件ID',
  `evaluation_content` varchar(500) NOT NULL COMMENT '评价内容',
  `evaluation_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '评价时间',
  `delivery_speed` enum('1','2','3','4','5') NOT NULL COMMENT '送货速度星数',
  `service_attitude` enum('1','2','3','4','5') NOT NULL COMMENT '服务态度星数',
  `goods_state` enum('1','2','3','4','5') NOT NULL COMMENT '快件状态星数',
  PRIMARY KEY (`evaluation_id`),
  KEY `user_id` (`user_id`),
  KEY `driver_id` (`driver_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评价表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_goodsdescribe`
--

CREATE TABLE IF NOT EXISTS `think_goodsdescribe` (
  `goods_id` varchar(50) NOT NULL COMMENT '快件id',
  `goods_name` varchar(50) NOT NULL COMMENT '商品名称',
  `goods_long` varchar(20) NOT NULL COMMENT '商品长',
  `goods_wide` varchar(20) NOT NULL COMMENT '商品宽',
  `goods_weight` varchar(20) NOT NULL COMMENT '商品重量',
  `goods_type` varchar(10) NOT NULL COMMENT '商品类型',
  PRIMARY KEY (`goods_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品描述表';

--
-- 转存表中的数据 `think_goodsdescribe`
--

INSERT INTO `think_goodsdescribe` (`goods_id`, `goods_name`, `goods_long`, `goods_wide`, `goods_weight`, `goods_type`) VALUES
('2017060721261323', '', '', '', '21', '2'),
('2017060721390723', '', '', '', '21', '2');

-- --------------------------------------------------------

--
-- 表的结构 `think_pay`
--

CREATE TABLE IF NOT EXISTS `think_pay` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '支付id',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `driver_id` int(11) NOT NULL COMMENT '司机id',
  `goods_id` varchar(50) NOT NULL COMMENT '快件id',
  `method_payment` varchar(10) NOT NULL COMMENT '支付方式（货到付款、在线支付）',
  `pay_price` varchar(10) NOT NULL COMMENT '价钱',
  `payment_time` datetime NOT NULL COMMENT '支付时间',
  `payment_status` varchar(10) NOT NULL COMMENT '状态（未付款、已付款）',
  PRIMARY KEY (`pay_id`),
  KEY `user_id` (`user_id`),
  KEY `driver_id` (`driver_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='支付表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `think_recipientinfo`
--

CREATE TABLE IF NOT EXISTS `think_recipientinfo` (
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `recipient_name` varchar(20) NOT NULL COMMENT '发货人姓名',
  `recipient_phone` varchar(15) NOT NULL COMMENT '发货人号码',
  `delivery_address` varchar(100) NOT NULL COMMENT '发货地址',
  `api_key` varchar(200) NOT NULL,
  PRIMARY KEY (`recipient_phone`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`),
  KEY `api_key` (`api_key`),
  KEY `api_key_2` (`api_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='发货人信息表';

-- --------------------------------------------------------

--
-- 表的结构 `think_submit`
--

CREATE TABLE IF NOT EXISTS `think_submit` (
  `goods_id` varchar(50) NOT NULL,
  `recipient_name` varchar(20) NOT NULL COMMENT '寄件人姓名',
  `recipient_phone` varchar(15) NOT NULL COMMENT '寄件人号码',
  `consignee_name` varchar(20) NOT NULL COMMENT '收货人姓名',
  `consignee_phone` varchar(15) NOT NULL COMMENT '收货人号码',
  `goods_weight` varchar(20) NOT NULL COMMENT '物品重量',
  `goods_type` varchar(50) NOT NULL COMMENT '物品类型',
  `lng` double NOT NULL COMMENT '送货经度',
  `lat` double NOT NULL COMMENT '送货纬度',
  `delivery_address` varchar(100) NOT NULL COMMENT '送货地址',
  `lng2` double NOT NULL COMMENT '收货经度',
  `lat2` double NOT NULL COMMENT '收货纬度',
  `consignee_address` varchar(100) NOT NULL COMMENT '收货地址',
  `delivery_way` varchar(50) NOT NULL COMMENT '运送方式',
  `delivery_cod` double NOT NULL COMMENT '代收货款',
  `delivery_valuation` double NOT NULL COMMENT '保价',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='提交订单表';

--
-- 转存表中的数据 `think_submit`
--

INSERT INTO `think_submit` (`goods_id`, `recipient_name`, `recipient_phone`, `consignee_name`, `consignee_phone`, `goods_weight`, `goods_type`, `lng`, `lat`, `delivery_address`, `lng2`, `lat2`, `consignee_address`, `delivery_way`, `delivery_cod`, `delivery_valuation`) VALUES
('1', '12345', '1', '1', '1', '1', '1', 1, 1, '1', 1, 1, '1', '1', 1, 1),
('2', '12345', '2', '2', '2', '2', '2', 2, 2, '2', 2, 2, '2', '2', 2, 2),
('2017060721390723', '12345', '114.35', '44.55', '114.55', '21', '2', 10, 10.1, '1', 10.1, 10, '1', '1', 100000, 1);

--
-- 触发器 `think_submit`
--
DROP TRIGGER IF EXISTS `goods_insert`;
DELIMITER //
CREATE TRIGGER `goods_insert` AFTER INSERT ON `think_submit`
 FOR EACH ROW insert into think_goodsdescribe(goods_id,goods_weight,goods_type) values(new.goods_id,new.goods_weight,new.goods_type)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `think_usercertification`
--

CREATE TABLE IF NOT EXISTS `think_usercertification` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_positive` varchar(200) CHARACTER SET utf8 NOT NULL,
  `id_opposite` varchar(200) CHARACTER SET utf8 NOT NULL,
  `certification_state` enum('未认证','已认证') CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='用户认证表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `think_usercertification`
--

INSERT INTO `think_usercertification` (`user_id`, `id_positive`, `id_opposite`, `certification_state`) VALUES
(1, '', '', '未认证'),
(4, '', '', '未认证');

-- --------------------------------------------------------

--
-- 表的结构 `think_userinfo`
--

CREATE TABLE IF NOT EXISTS `think_userinfo` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_name` varchar(50) NOT NULL COMMENT '用户名',
  `user_realName` varchar(30) NOT NULL COMMENT '真实姓名',
  `user_phone` varchar(15) NOT NULL COMMENT '电话',
  `user_idNumber` varchar(18) NOT NULL COMMENT '身份证号',
  `user_email` varchar(100) NOT NULL COMMENT '用户邮箱',
  `user_credit` enum('1','2','3','4','5') DEFAULT NULL COMMENT '信用等级',
  `user_date` timestamp NULL DEFAULT NULL COMMENT '注册日期',
  `user_img` varchar(100) DEFAULT NULL COMMENT '头像',
  `user_state` enum('可用','不可用') DEFAULT '可用' COMMENT '账户状态',
  `user_gender` enum('男','女') NOT NULL COMMENT '性别',
  `api_key` varchar(200) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户信息表' AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `think_userinfo`
--

INSERT INTO `think_userinfo` (`user_id`, `user_name`, `user_realName`, `user_phone`, `user_idNumber`, `user_email`, `user_credit`, `user_date`, `user_img`, `user_state`, `user_gender`, `api_key`) VALUES
(1, 'heo', 'chan', '1368028974', '440582199612295896', '570941643@qq.com', '1', '2017-07-22 06:10:20', NULL, '可用', '女', 'c07a621b9e312775a3d06fb846aece54'),
(4, 'ma', 'mabb', '13268050404', '440582199612295896', '1234@163.com', '1', '2017-07-22 06:10:20', NULL, '可用', '女', 'c07a621b9e312775a3d06fb846aece53');

--
-- 触发器 `think_userinfo`
--
DROP TRIGGER IF EXISTS `user_delete`;
DELIMITER //
CREATE TRIGGER `user_delete` BEFORE DELETE ON `think_userinfo`
 FOR EACH ROW delete from think_userregister where user_id=old.user_id
//
DELIMITER ;
DROP TRIGGER IF EXISTS `user_insert2`;
DELIMITER //
CREATE TRIGGER `user_insert2` AFTER INSERT ON `think_userinfo`
 FOR EACH ROW insert into think_usercertification(user_id) values(new.user_id)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `think_userregister`
--

CREATE TABLE IF NOT EXISTS `think_userregister` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_phone` varchar(11) NOT NULL COMMENT '用户手机',
  `user_password` varchar(100) NOT NULL COMMENT '用户密码',
  `user_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `api_key` varchar(200) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户注册表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `think_userregister`
--

INSERT INTO `think_userregister` (`user_id`, `user_phone`, `user_password`, `user_date`, `api_key`) VALUES
(1, '1368028974', '123456', '2017-07-22 06:10:20', 'c07a621b9e312775a3d06fb846aece54'),
(4, '13268050404', '123456', '2017-07-22 06:10:20', 'c07a621b9e312775a3d06fb846aece53');

--
-- 触发器 `think_userregister`
--
DROP TRIGGER IF EXISTS `user_insert`;
DELIMITER //
CREATE TRIGGER `user_insert` AFTER INSERT ON `think_userregister`
 FOR EACH ROW insert into think_userinfo(user_id,user_phone,user_date,api_key) values(new.user_id,new.user_phone,new.user_date,new.api_key)
//
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `think_userrequire`
--

CREATE TABLE IF NOT EXISTS `think_userrequire` (
  `goods_id` varchar(50) NOT NULL COMMENT '快件id',
  `user_name` varchar(50) NOT NULL COMMENT '用户名',
  `delivery_requirements` varchar(300) NOT NULL COMMENT '送货要求',
  `arrival_time` varchar(100) NOT NULL COMMENT '要求时间',
  PRIMARY KEY (`user_name`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户要求表';

-- --------------------------------------------------------

--
-- 表的结构 `think_verification`
--

CREATE TABLE IF NOT EXISTS `think_verification` (
  `verification_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '验证码ID',
  `verification_phone` varchar(15) NOT NULL COMMENT '手机号码',
  `verification_code` char(6) NOT NULL COMMENT '验证码',
  `verification_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`verification_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='验证码表' AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `think_verification`
--

INSERT INTO `think_verification` (`verification_id`, `verification_phone`, `verification_code`, `verification_date`) VALUES
(3, '13268066136', '123456', '2017-06-01 07:20:52'),
(4, '13268066136', '925477', '2017-06-01 07:23:45'),
(5, '13268066136', '444052', '2017-06-01 07:39:06'),
(6, '13268066136', '913897', '2017-06-01 07:39:32'),
(7, '13268066136', '592166', '2017-06-01 07:41:58'),
(8, '15622114624', '148328', '2017-06-01 07:43:17'),
(9, '13268066136', '879300', '2017-06-01 07:48:51'),
(10, '13268066136', '870380', '2017-06-01 08:07:19'),
(11, '13268066136', '889832', '2017-06-01 15:13:28'),
(12, '13268066136', '769563', '2017-06-02 06:06:26'),
(13, '13268066136', '317373', '2017-06-06 05:41:55'),
(14, '13268066136', '491959', '2017-06-06 06:27:09'),
(15, '13268066136', '207342', '2017-06-06 06:28:01'),
(16, '13268066136', '301404', '2017-06-06 06:29:02'),
(17, '13268066136', '460235', '2017-06-06 06:37:30');

--
-- 限制导出的表
--

--
-- 限制表 `think_administrators`
--
ALTER TABLE `think_administrators`
  ADD CONSTRAINT `think_administrators_ibfk_1` FOREIGN KEY (`administrators_id`) REFERENCES `think_administratorsregister` (`administrators_id`);

--
-- 限制表 `think_carinfo`
--
ALTER TABLE `think_carinfo`
  ADD CONSTRAINT `think_carinfo_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `think_driverinfo` (`driver_id`);

--
-- 限制表 `think_consigneeinfo`
--
ALTER TABLE `think_consigneeinfo`
  ADD CONSTRAINT `think_consigneeinfo_ibfk_2` FOREIGN KEY (`goods_id`) REFERENCES `think_submit` (`goods_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `think_delivery`
--
ALTER TABLE `think_delivery`
  ADD CONSTRAINT `think_delivery_ibfk_1` FOREIGN KEY (`goods_id`) REFERENCES `think_submit` (`goods_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `think_deliveryaddressinfo`
--
ALTER TABLE `think_deliveryaddressinfo`
  ADD CONSTRAINT `think_deliveryaddressinfo_ibfk_2` FOREIGN KEY (`goods_id`) REFERENCES `think_goodsdescribe` (`goods_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `think_didicar`
--
ALTER TABLE `think_didicar`
  ADD CONSTRAINT `think_didicar_ibfk_1` FOREIGN KEY (`didi_id`) REFERENCES `think_dididriver` (`didi_id`);

--
-- 限制表 `think_driverinfo`
--
ALTER TABLE `think_driverinfo`
  ADD CONSTRAINT `think_driverinfo_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `think_driverregister` (`driver_id`);

--
-- 限制表 `think_evaluation`
--
ALTER TABLE `think_evaluation`
  ADD CONSTRAINT `think_evaluation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `think_userinfo` (`user_id`),
  ADD CONSTRAINT `think_evaluation_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `think_driverinfo` (`driver_id`),
  ADD CONSTRAINT `think_evaluation_ibfk_3` FOREIGN KEY (`goods_id`) REFERENCES `think_goodsdescribe` (`goods_id`);

--
-- 限制表 `think_pay`
--
ALTER TABLE `think_pay`
  ADD CONSTRAINT `think_pay_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `think_userinfo` (`user_id`),
  ADD CONSTRAINT `think_pay_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `think_driverinfo` (`driver_id`),
  ADD CONSTRAINT `think_pay_ibfk_3` FOREIGN KEY (`goods_id`) REFERENCES `think_goodsdescribe` (`goods_id`);

--
-- 限制表 `think_recipientinfo`
--
ALTER TABLE `think_recipientinfo`
  ADD CONSTRAINT `think_recipientinfo_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `think_userinfo` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `think_usercertification`
--
ALTER TABLE `think_usercertification`
  ADD CONSTRAINT `think_usercertification_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `think_userregister` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `think_userrequire`
--
ALTER TABLE `think_userrequire`
  ADD CONSTRAINT `think_userrequire_ibfk_2` FOREIGN KEY (`goods_id`) REFERENCES `think_goodsdescribe` (`goods_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
