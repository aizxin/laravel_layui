/*
Navicat MySQL Data Transfer

Source Server         : phpstudy
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : doucar

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2017-04-13 19:43:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ads
-- ----------------------------
DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `adsId` int(11) NOT NULL AUTO_INCREMENT COMMENT '广告id',
  `adsThumb` text COMMENT '广告图片',
  `adsTitle` varchar(255) DEFAULT NULL COMMENT '广告标题',
  `adsUrl` varchar(255) DEFAULT NULL COMMENT '广告图片链接',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`adsId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='首页广告轮播图';

-- ----------------------------
-- Records of ads
-- ----------------------------

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `articleId` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `articleCategoryId` int(11) NOT NULL COMMENT '文章分类的id',
  `title` varchar(255) DEFAULT NULL COMMENT '文章标题',
  `content` text COMMENT '文章内容',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`articleId`),
  KEY `cid` (`articleCategoryId`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of article
-- ----------------------------

-- ----------------------------
-- Table structure for article_category
-- ----------------------------
DROP TABLE IF EXISTS `article_category`;
CREATE TABLE `article_category` (
  `articleCategoryId` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章分类Id',
  `parent_id` int(11) DEFAULT NULL COMMENT '文章分类父id',
  `name` varchar(255) NOT NULL COMMENT '文章分类名称',
  `status` int(1) DEFAULT '1' COMMENT '0:待处理1:显示,-1:隐藏',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`articleCategoryId`),
  KEY `parent_id` (`parent_id`),
  KEY `name` (`name`),
  KEY `status` (`status`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章分类表';

-- ----------------------------
-- Records of article_category
-- ----------------------------

-- ----------------------------
-- Table structure for car
-- ----------------------------
DROP TABLE IF EXISTS `car`;
CREATE TABLE `car` (
  `carId` int(11) NOT NULL AUTO_INCREMENT COMMENT '驾校车辆id',
  `schoolId` int(11) NOT NULL COMMENT '车辆属于哪个驾校(关联school表schoolId）',
  `license` varchar(11) NOT NULL COMMENT '车牌照号',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`carId`),
  UNIQUE KEY `license` (`license`) USING BTREE,
  KEY `schoolId` (`schoolId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='车辆信息表';

-- ----------------------------
-- Records of car
-- ----------------------------

-- ----------------------------
-- Table structure for cheat
-- ----------------------------
DROP TABLE IF EXISTS `cheat`;
CREATE TABLE `cheat` (
  `cheatId` int(11) NOT NULL AUTO_INCREMENT COMMENT '秘籍id',
  `cheatCategoryId` int(11) NOT NULL COMMENT '文章所属秘籍分类的cheatCategoryId',
  `cheatName` varchar(50) NOT NULL COMMENT '秘籍标题',
  `thumb` text COMMENT '文章图片',
  `content` text COMMENT '文章内容',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`cheatId`),
  KEY `cheatCategoryId` (`cheatCategoryId`),
  KEY `cheatName` (`cheatName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='秘籍表';

-- ----------------------------
-- Records of cheat
-- ----------------------------

-- ----------------------------
-- Table structure for cheat_category
-- ----------------------------
DROP TABLE IF EXISTS `cheat_category`;
CREATE TABLE `cheat_category` (
  `cheatCategoryId` int(10) NOT NULL AUTO_INCREMENT COMMENT '秘籍分类id',
  `name` varchar(50) NOT NULL COMMENT '秘籍分类名称',
  `parentId` int(10) NOT NULL DEFAULT '0' COMMENT '秘籍分类父id（与当前表关联）',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`cheatCategoryId`),
  KEY `parentId` (`parentId`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='秘籍分类表';

-- ----------------------------
-- Records of cheat_category
-- ----------------------------

-- ----------------------------
-- Table structure for check
-- ----------------------------
DROP TABLE IF EXISTS `check`;
CREATE TABLE `check` (
  `checkId` int(11) NOT NULL AUTO_INCREMENT COMMENT '登记表Id',
  `memberId` int(11) DEFAULT NULL COMMENT '是哪个用户登记（关联member表的memberId）',
  `name` varchar(50) DEFAULT NULL COMMENT '登记姓名',
  `phone` int(50) DEFAULT NULL COMMENT '登记电话',
  `carType` int(1) DEFAULT NULL COMMENT '登记车型 1：c1   2：c2',
  `province` int(50) DEFAULT NULL COMMENT 'areaId    用户学车的省id',
  `city` int(50) DEFAULT NULL COMMENT 'areaId    用户学车的市id',
  `district` int(50) DEFAULT NULL COMMENT 'areaId    用户学车的区id',
  `address` varchar(255) DEFAULT NULL COMMENT '用户的地址详情',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`checkId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户学车登记表';

-- ----------------------------
-- Records of check
-- ----------------------------

-- ----------------------------
-- Table structure for coach
-- ----------------------------
DROP TABLE IF EXISTS `coach`;
CREATE TABLE `coach` (
  `coachId` int(11) NOT NULL AUTO_INCREMENT COMMENT '教练Id',
  `menberId` int(11) DEFAULT '0' COMMENT '会员Id',
  `schoolId` int(11) NOT NULL COMMENT '关联驾校表（school）Id',
  `coachName` varchar(50) NOT NULL COMMENT '教练姓名',
  `coachPhone` varchar(50) NOT NULL COMMENT '教练电话',
  `sex` int(1) DEFAULT '0' COMMENT '1:男,2:女',
  `headPortrait` varchar(255) DEFAULT NULL COMMENT '教练头像',
  `description` text COMMENT '教练详细介绍',
  `overview` text COMMENT '教练简介',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0:待审核,1:审核成功,-1:审核失败',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`coachId`),
  KEY `schoolId` (`schoolId`) USING BTREE,
  KEY `memberId` (`menberId`) USING BTREE,
  KEY `coachName` (`coachName`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='教练表';

-- ----------------------------
-- Records of coach
-- ----------------------------

-- ----------------------------
-- Table structure for coach_approve
-- ----------------------------
DROP TABLE IF EXISTS `coach_approve`;
CREATE TABLE `coach_approve` (
  `coachApproveId` int(11) NOT NULL COMMENT '教练认证id',
  `name` varchar(50) DEFAULT NULL COMMENT '教练名字',
  `phone` int(50) DEFAULT NULL COMMENT '教练电话',
  `thumb` varchar(255) DEFAULT NULL COMMENT '教练头像',
  `sex` int(255) DEFAULT NULL COMMENT '教练性别 1：男  2：女',
  `school` varchar(50) DEFAULT NULL COMMENT '教练所属驾校名称',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`coachApproveId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='教练认证表';

-- ----------------------------
-- Records of coach_approve
-- ----------------------------

-- ----------------------------
-- Table structure for coach_comment
-- ----------------------------
DROP TABLE IF EXISTS `coach_comment`;
CREATE TABLE `coach_comment` (
  `coachCommentId` int(11) NOT NULL AUTO_INCREMENT,
  `coachId` int(11) NOT NULL COMMENT '关联教练表（coach）id',
  `memberId` int(11) NOT NULL COMMENT '关联用户（member）id',
  `comment` text COMMENT '用户对教练评价',
  `star` int(2) DEFAULT '0' COMMENT '教练评价星数',
  `status` int(1) DEFAULT '0' COMMENT '0:待审核,1:显示,-1:隐藏',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`coachCommentId`),
  KEY `coach_id` (`coachId`),
  KEY `member_id` (`memberId`),
  KEY `status` (`status`) USING BTREE,
  KEY `star` (`star`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='教练评价表';

-- ----------------------------
-- Records of coach_comment
-- ----------------------------

-- ----------------------------
-- Table structure for coach_gallery
-- ----------------------------
DROP TABLE IF EXISTS `coach_gallery`;
CREATE TABLE `coach_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coachId` int(11) DEFAULT NULL COMMENT '关联教练表（coach）id',
  `gallery` text NOT NULL COMMENT '教练图集',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `coach_id` (`coachId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='教练相册表';

-- ----------------------------
-- Records of coach_gallery
-- ----------------------------

-- ----------------------------
-- Table structure for coach_sign
-- ----------------------------
DROP TABLE IF EXISTS `coach_sign`;
CREATE TABLE `coach_sign` (
  `coachSignId` varchar(255) DEFAULT NULL COMMENT '签到教练id',
  `signSchoolId` int(11) DEFAULT NULL COMMENT '签到车辆属于哪个驾校',
  `signLicense` varchar(11) DEFAULT NULL COMMENT '签到车牌照号',
  `signAddress` varchar(255) DEFAULT NULL COMMENT '签到地点',
  `signTime` datetime DEFAULT NULL COMMENT '签到时间',
  `signThumb` varchar(255) DEFAULT NULL COMMENT '签到照片',
  `memberId` int(11) DEFAULT NULL COMMENT '签到的学员id（关联member表的memberId）',
  `name` varchar(50) DEFAULT NULL COMMENT '签到学员姓名',
  `phone` varchar(255) DEFAULT NULL COMMENT '签到学员电话',
  `signCode` varchar(255) DEFAULT NULL COMMENT 'member识别码',
  `status` int(1) DEFAULT '1' COMMENT ' 1：审核通过  -1：审核不通过',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='教练签到表';

-- ----------------------------
-- Records of coach_sign
-- ----------------------------

-- ----------------------------
-- Table structure for complain
-- ----------------------------
DROP TABLE IF EXISTS `complain`;
CREATE TABLE `complain` (
  `complainId` int(11) NOT NULL COMMENT '投诉Id',
  `content` text COMMENT '投诉内容',
  `memberId` int(10) DEFAULT NULL COMMENT '投诉人Id(关联Member表memberId）',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`complainId`),
  KEY `memberId` (`memberId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户投诉表';

-- ----------------------------
-- Records of complain
-- ----------------------------

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `configId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '配置名称',
  `code` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL COMMENT '配置内容对应的值',
  `type` varchar(50) DEFAULT NULL COMMENT '配置类型',
  `sort` int(10) DEFAULT NULL COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`configId`),
  KEY `type` (`type`),
  KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统配置表';

-- ----------------------------
-- Records of config
-- ----------------------------

-- ----------------------------
-- Table structure for feed_back
-- ----------------------------
DROP TABLE IF EXISTS `feed_back`;
CREATE TABLE `feed_back` (
  `feedbackId` int(11) NOT NULL AUTO_INCREMENT COMMENT '意见反馈id',
  `writebackId` int(11) DEFAULT NULL COMMENT '关联writeback表的writebackId',
  `memberId` int(11) NOT NULL COMMENT '反馈意见人的用户id(memberId）',
  `content` varchar(255) NOT NULL COMMENT '反馈的意见内容',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`feedbackId`),
  KEY `memberId` (`memberId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='意见反馈表';

-- ----------------------------
-- Records of feed_back
-- ----------------------------

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `memberId` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `openId` varchar(128) DEFAULT NULL COMMENT '第三方ID',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `memberPhone` varchar(11) DEFAULT NULL COMMENT '手机号',
  `nickname` varchar(20) DEFAULT NULL COMMENT '用户名',
  `headPortrait` varchar(255) DEFAULT NULL COMMENT '头像',
  `accountType` tinyint(1) DEFAULT NULL COMMENT '账号类型:1.手机 2.QQ 3.微信',
  `isCoach` int(1) DEFAULT '0' COMMENT '0:学员 1：教练',
  `active` tinyint(1) unsigned DEFAULT '0' COMMENT '1.启用 -1.禁用',
  `signCode` varchar(255) DEFAULT NULL COMMENT '签到识别码',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`memberId`),
  UNIQUE KEY `openId` (`openId`),
  UNIQUE KEY `memberPhone` (`memberPhone`) USING BTREE,
  KEY `nickname` (`nickname`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of member
-- ----------------------------

-- ----------------------------
-- Table structure for member_sign
-- ----------------------------
DROP TABLE IF EXISTS `member_sign`;
CREATE TABLE `member_sign` (
  `memberSigninId` int(11) NOT NULL,
  `signSchoolId` int(11) DEFAULT NULL COMMENT '签到/退车辆属于哪个驾校',
  `signLicense` varchar(11) DEFAULT NULL COMMENT '签到/退车牌照号',
  `signAddress` varchar(255) DEFAULT NULL COMMENT '签到/退地点',
  `signTime` datetime DEFAULT NULL COMMENT '签到/退时间',
  `memberId` int(11) DEFAULT NULL COMMENT '签到的学员id（关联member表的memberId）',
  `name` varchar(50) DEFAULT NULL COMMENT '签到学员姓名',
  `phone` varchar(255) DEFAULT NULL COMMENT '签到学员电话',
  `signCode` varchar(255) DEFAULT NULL COMMENT 'member识别码',
  `type` int(1) DEFAULT NULL COMMENT '1：签到 2：签退',
  `status` int(1) DEFAULT '1' COMMENT ' 1：审核通过  -1：审核不通过',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`memberSigninId`),
  KEY `memberId` (`memberId`),
  KEY `phone` (`phone`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='学员签到表';

-- ----------------------------
-- Records of member_sign
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('3', '2015_01_15_105324_create_roles_table', '1');
INSERT INTO `migrations` VALUES ('4', '2015_01_15_114412_create_role_user_table', '1');
INSERT INTO `migrations` VALUES ('5', '2015_01_26_115212_create_permissions_table', '1');
INSERT INTO `migrations` VALUES ('6', '2015_01_26_115523_create_permission_role_table', '1');
INSERT INTO `migrations` VALUES ('7', '2015_02_09_132439_create_permission_user_table', '1');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `memberId` int(11) NOT NULL COMMENT '用户id，关联member表memberId',
  `schoolId` int(11) NOT NULL COMMENT '用户报名的驾校id，关联school表schoolId',
  `coachId` int(11) NOT NULL COMMENT '用户报名的教练Id，关联coach表的coachId',
  `orderNo` int(11) NOT NULL COMMENT '订单号',
  `money` float(10,0) NOT NULL DEFAULT '0' COMMENT '订单金额',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT '用户订单类型，1：普通报名订单  2：团购报名订单',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '订单状态  0：未支付 1：已支付 -1：订单已失效',
  `payWay` int(1) DEFAULT NULL COMMENT '支付方式',
  `carType` int(1) NOT NULL COMMENT '报考车型 1：c1  2 : c2',
  `name` varchar(255) DEFAULT NULL COMMENT '报名用户姓名',
  `phone` varchar(255) NOT NULL COMMENT '报名用户电话',
  `province` int(10) DEFAULT NULL COMMENT 'areaId    用户学车的省id',
  `city` int(10) DEFAULT NULL COMMENT 'areaId    用户学车的市id',
  `district` int(10) DEFAULT NULL COMMENT 'areaId    用户学车的区id',
  `address` varchar(255) DEFAULT NULL COMMENT '用户的地主详情',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '订单创建时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '订单更新时间',
  PRIMARY KEY (`orderId`),
  KEY `orderNo` (`orderNo`),
  KEY `memberId` (`memberId`),
  KEY `schoolId` (`schoolId`),
  KEY `coachId` (`coachId`),
  KEY `name` (`name`),
  KEY `phone` (`phone`),
  KEY `status` (`status`),
  KEY `type` (`type`),
  KEY `区域` (`province`,`city`,`district`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='报名订单表';

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL DEFAULT '0' COMMENT '权限父id',
  `ismenu` int(1) NOT NULL DEFAULT '0' COMMENT '是否是菜单',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '权限图标',
  `issort` int(255) NOT NULL DEFAULT '0' COMMENT '权限排序',
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', '0', '1', '主页管理', 'admin.manage', '主页管理', 'fa fa-reddit-alien', '1', null, '2017-04-11 20:28:42', '2017-04-12 21:25:29');
INSERT INTO `permissions` VALUES ('2', '0', '1', '权限管理', 'rbac.manage', '权限管理', 'fa fa-sitemap', '1', null, '2017-04-11 20:29:47', '2017-04-13 11:58:36');
INSERT INTO `permissions` VALUES ('3', '1', '1', '网站主页', 'admin.index', '网站主页', 'fa fa-home', '0', null, '2017-04-13 17:02:54', '2017-04-13 17:02:57');
INSERT INTO `permissions` VALUES ('4', '2', '1', '管理员管理', 'user.index', '管理员管理', 'fa fa-user', '1', null, '2017-04-13 11:58:19', '2017-04-13 11:59:33');
INSERT INTO `permissions` VALUES ('5', '2', '1', '角色管理', 'role.index', '角色管理', 'fa fa-bullhorn', '1', null, '2017-04-13 12:20:44', '2017-04-13 12:20:44');
INSERT INTO `permissions` VALUES ('6', '2', '1', '节点管理', 'permission.index', '节点管理', 'fa fa-arrows', '1', null, '2017-04-13 12:21:31', '2017-04-13 12:21:31');
INSERT INTO `permissions` VALUES ('7', '6', '0', '节点添加视图', 'permission.create', '节点添加视图', null, '1', null, '2017-04-13 12:22:21', '2017-04-13 12:30:32');
INSERT INTO `permissions` VALUES ('8', '6', '0', '节点添加操作', 'permission.store', '节点添加操作', null, '2', null, '2017-04-13 12:23:11', '2017-04-13 12:30:44');
INSERT INTO `permissions` VALUES ('9', '6', '0', '节点更新视图', 'permission.edit', '节点更新视图', null, '1', null, '2017-04-13 12:24:18', '2017-04-13 12:30:56');
INSERT INTO `permissions` VALUES ('10', '6', '0', '节点更新操作', 'permission.update', '节点更新操作', null, '1', null, '2017-04-13 12:25:02', '2017-04-13 12:25:02');
INSERT INTO `permissions` VALUES ('11', '6', '0', '节点删除', 'permission.destroy', '节点删除', null, '1', null, '2017-04-13 12:25:55', '2017-04-13 12:42:53');
INSERT INTO `permissions` VALUES ('12', '5', '0', '角色添加视图', 'role.create', '角色添加视图', null, '1', null, '2017-04-13 12:32:26', '2017-04-13 12:32:26');
INSERT INTO `permissions` VALUES ('13', '5', '0', '角色添加操作', 'role.store', '角色添加操作', null, '1', null, '2017-04-13 12:44:37', '2017-04-13 12:44:37');
INSERT INTO `permissions` VALUES ('14', '5', '0', '角色更新视图', 'role.edit', '角色更新视图', null, '1', null, '2017-04-13 12:58:03', '2017-04-13 12:58:03');
INSERT INTO `permissions` VALUES ('15', '5', '0', '角色更新操作', 'role.update', '角色更新操作', null, '1', null, '2017-04-13 13:01:53', '2017-04-13 13:01:53');
INSERT INTO `permissions` VALUES ('16', '5', '0', '角色删除操作', 'role.destroy', '角色删除操作', null, '1', null, '2017-04-13 13:07:18', '2017-04-13 13:07:18');
INSERT INTO `permissions` VALUES ('17', '4', '0', '管理员添加视图', 'user.create', '管理员添加视图', null, '1', null, '2017-04-13 13:15:47', '2017-04-13 13:15:47');
INSERT INTO `permissions` VALUES ('18', '4', '0', '管理员添加操作', 'user.store', '管理员添加操作', null, '1', null, '2017-04-13 13:17:28', '2017-04-13 13:17:28');
INSERT INTO `permissions` VALUES ('19', '4', '0', '管理员更新视图', 'user.edit', '管理员更新视图', null, '1', null, '2017-04-13 13:18:14', '2017-04-13 13:18:14');
INSERT INTO `permissions` VALUES ('20', '4', '0', '管理员更新操作', 'user.update', '管理员更新操作', null, '1', null, '2017-04-13 13:18:40', '2017-04-13 13:18:40');
INSERT INTO `permissions` VALUES ('21', '4', '0', '管理员删除操作', 'user.destroy', '管理员删除操作', null, '1', null, '2017-04-13 13:19:58', '2017-04-13 13:19:58');
INSERT INTO `permissions` VALUES ('22', '0', '0', 'demo', 'demo', 'demo', null, '0', null, '2017-04-13 16:39:42', '2017-04-13 16:39:42');
INSERT INTO `permissions` VALUES ('24', '5', '0', '角色权限', 'role.show', '角色权限', null, '1', null, '2017-04-13 18:53:10', '2017-04-13 18:53:10');

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES ('1', '1', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('2', '2', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('3', '3', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('4', '4', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('5', '5', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('6', '6', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('7', '7', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('8', '8', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('9', '9', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('10', '10', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('11', '11', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('12', '12', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('13', '13', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('14', '14', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('15', '15', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('16', '16', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('17', '17', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('18', '18', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('19', '19', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('20', '20', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('21', '21', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('22', '22', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('23', '23', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('24', '24', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('25', '25', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('26', '26', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('27', '27', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('28', '28', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('29', '29', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('30', '30', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('31', '1', '2', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `permission_role` VALUES ('32', '2', '2', '2017-04-07 13:07:50', '2017-04-07 13:07:50');

-- ----------------------------
-- Table structure for permission_user
-- ----------------------------
DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE `permission_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of permission_user
-- ----------------------------

-- ----------------------------
-- Table structure for purchase
-- ----------------------------
DROP TABLE IF EXISTS `purchase`;
CREATE TABLE `purchase` (
  `purchaseId` int(11) NOT NULL AUTO_INCREMENT COMMENT '团购活动id',
  `schoolId` int(11) DEFAULT NULL COMMENT '团购活动和驾校绑定(关联school表 schoolId）',
  `type` varchar(255) DEFAULT NULL COMMENT '1：c1  2 : c2',
  `title` varchar(255) DEFAULT NULL COMMENT '团购标题',
  `price` decimal(10,0) DEFAULT NULL COMMENT '团购价格',
  `number` int(10) DEFAULT NULL COMMENT '团购人数',
  `startTime` datetime DEFAULT NULL COMMENT '开始时间',
  `endTime` datetime DEFAULT NULL COMMENT '团购结束时间',
  `thumb` varchar(255) DEFAULT NULL COMMENT '照片',
  `content` text,
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`purchaseId`),
  KEY `schoolId` (`schoolId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='团购信息表';

-- ----------------------------
-- Records of purchase
-- ----------------------------

-- ----------------------------
-- Table structure for push_msg
-- ----------------------------
DROP TABLE IF EXISTS `push_msg`;
CREATE TABLE `push_msg` (
  `pushMsgId` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '推送消息主键',
  `title` varchar(30) DEFAULT NULL COMMENT '消息标题',
  `content` text COMMENT '消息内容',
  `pushConfig` varchar(500) DEFAULT NULL COMMENT '第三方推送,配置信息  如logo 是否响 等 以json字符串形式存储',
  `pushMsgType` tinyint(1) unsigned DEFAULT NULL COMMENT '1.图书 2.外链 3.提醒',
  `pushMsgLocation` tinyint(1) unsigned DEFAULT NULL COMMENT '1.系统消息 2.图书模块 3.亲子模块',
  `pushMsgTypeValue` varchar(255) DEFAULT NULL COMMENT '类型值，根据type而定',
  `pushUserIds` varchar(255) DEFAULT NULL COMMENT '指定用户推送id集合，为空则不指定',
  `pushStatus` tinyint(1) unsigned DEFAULT NULL COMMENT '推送状态:1.已推送 2.未推送...',
  `createAdminId` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updateAdminId` int(10) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`pushMsgId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='消息推送表';

-- ----------------------------
-- Records of push_msg
-- ----------------------------

-- ----------------------------
-- Table structure for question
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `questionId` int(11) NOT NULL AUTO_INCREMENT,
  `questionCategoryId` int(11) NOT NULL COMMENT '关联（category）分类表id ',
  `questionName` varchar(255) NOT NULL COMMENT '试题名称',
  `analysis` text COMMENT '答案解析',
  `questionType` int(1) NOT NULL DEFAULT '0' COMMENT '1:单选题,2:判断题,3:多选题',
  `courseType` int(10) NOT NULL DEFAULT '0' COMMENT '题目类型1：科目一 4：科目四',
  `thumb` varchar(255) DEFAULT NULL COMMENT '图片l路径',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`questionId`),
  KEY `category_id` (`questionCategoryId`),
  KEY `name` (`questionName`) USING BTREE,
  KEY `questionType` (`questionType`) USING BTREE,
  KEY `courseType` (`courseType`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='试题表';

-- ----------------------------
-- Records of question
-- ----------------------------

-- ----------------------------
-- Table structure for question_answer
-- ----------------------------
DROP TABLE IF EXISTS `question_answer`;
CREATE TABLE `question_answer` (
  `questionAnswerId` int(10) NOT NULL AUTO_INCREMENT,
  `questionId` int(11) NOT NULL COMMENT '试题表Id',
  `isAnswer` int(1) NOT NULL DEFAULT '0' COMMENT '0:不是正确答案,1:正确答案',
  `content` text COMMENT '选项内容',
  `thumb` varchar(255) DEFAULT NULL COMMENT '图片',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`questionAnswerId`),
  KEY `subject_id` (`questionId`),
  KEY `isAnswer` (`isAnswer`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of question_answer
-- ----------------------------

-- ----------------------------
-- Table structure for question_category
-- ----------------------------
DROP TABLE IF EXISTS `question_category`;
CREATE TABLE `question_category` (
  `questionCategoryId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '试题分类名称',
  `parent_id` int(11) DEFAULT '0' COMMENT '试题分类父id',
  `status` int(1) DEFAULT '1' COMMENT '0:待处理1:显示,-1:隐藏',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`questionCategoryId`),
  KEY `name` (`name`) USING BTREE,
  KEY `pid` (`parent_id`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='试题分类表';

-- ----------------------------
-- Records of question_category
-- ----------------------------

-- ----------------------------
-- Table structure for question_tab
-- ----------------------------
DROP TABLE IF EXISTS `question_tab`;
CREATE TABLE `question_tab` (
  `questionTabId` int(11) NOT NULL AUTO_INCREMENT COMMENT '试题标签id',
  `name` varchar(255) DEFAULT NULL COMMENT '试题标签名称',
  `status` int(255) DEFAULT '0' COMMENT '0:待处理1:显示,-1:隐藏',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新是',
  PRIMARY KEY (`questionTabId`),
  UNIQUE KEY `name` (`name`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of question_tab
-- ----------------------------

-- ----------------------------
-- Table structure for question_tab_question
-- ----------------------------
DROP TABLE IF EXISTS `question_tab_question`;
CREATE TABLE `question_tab_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questionId` int(11) NOT NULL COMMENT '试题id',
  `questionTabId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `questionTabId` (`questionTabId`) USING BTREE,
  KEY `questionId` (`questionId`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='试题标签关系表';

-- ----------------------------
-- Records of question_tab_question
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', '超级管理员', 'admin', '超级管理员', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `roles` VALUES ('2', '普通用户1', 'user1', '普通用户1', '1', '2017-04-07 13:07:50', '2017-04-13 19:41:12');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('1', '1', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `role_user` VALUES ('2', '2', '2', '2017-04-07 13:07:51', '2017-04-07 13:07:51');
INSERT INTO `role_user` VALUES ('3', '2', '3', '2017-04-07 13:07:51', '2017-04-07 13:07:51');
INSERT INTO `role_user` VALUES ('4', '2', '4', '2017-04-07 13:07:51', '2017-04-07 13:07:51');

-- ----------------------------
-- Table structure for school
-- ----------------------------
DROP TABLE IF EXISTS `school`;
CREATE TABLE `school` (
  `schoolId` int(11) NOT NULL AUTO_INCREMENT,
  `schoolName` varchar(255) NOT NULL COMMENT '驾校名称',
  `address` varchar(255) NOT NULL COMMENT '驾校地址',
  `schoolPhone` varchar(255) DEFAULT NULL COMMENT '驾校联系电话',
  `overview` text COMMENT '驾校简介',
  `description` text COMMENT '驾校课程描述',
  `thumb` text NOT NULL COMMENT '驾校照片',
  `province` int(11) DEFAULT NULL COMMENT '与地区表id关联',
  `city` int(11) DEFAULT NULL COMMENT '与地区表id关联',
  `district` int(11) DEFAULT NULL COMMENT '与地区表id关联',
  `status` int(1) DEFAULT '0' COMMENT '0:待审核,1:审核成功,-1审核失败',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`schoolId`),
  KEY `name` (`schoolName`),
  KEY `city` (`province`,`city`,`district`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='驾校表';

-- ----------------------------
-- Records of school
-- ----------------------------

-- ----------------------------
-- Table structure for school_approve
-- ----------------------------
DROP TABLE IF EXISTS `school_approve`;
CREATE TABLE `school_approve` (
  `schoolApproveId` int(11) DEFAULT NULL COMMENT '驾校认证id',
  `name` varchar(50) DEFAULT NULL COMMENT '驾校名称',
  `address` varchar(255) DEFAULT NULL COMMENT '驾校地址',
  `phone` int(50) DEFAULT NULL COMMENT '驾校电话',
  `thumb` varchar(255) DEFAULT NULL COMMENT '驾校照片',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='驾校认证表';

-- ----------------------------
-- Records of school_approve
-- ----------------------------

-- ----------------------------
-- Table structure for school_comment
-- ----------------------------
DROP TABLE IF EXISTS `school_comment`;
CREATE TABLE `school_comment` (
  `schoolCommentId` int(11) NOT NULL AUTO_INCREMENT,
  `memberId` int(11) NOT NULL COMMENT '关联用户表（member）的id',
  `schoolId` int(11) NOT NULL COMMENT '关联驾校表（school）的id',
  `comment` text NOT NULL COMMENT '评论内容',
  `star` int(1) NOT NULL DEFAULT '0' COMMENT '驾校评论星数',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0:待审核,1:显示,-1:隐藏',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`schoolCommentId`),
  KEY `memberId` (`memberId`) USING BTREE,
  KEY `schoolId` (`schoolId`) USING BTREE,
  KEY `star` (`star`) USING BTREE,
  KEY `status` (`status`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='驾校评论表';

-- ----------------------------
-- Records of school_comment
-- ----------------------------

-- ----------------------------
-- Table structure for school_gallery
-- ----------------------------
DROP TABLE IF EXISTS `school_gallery`;
CREATE TABLE `school_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolId` int(11) NOT NULL COMMENT '关联驾校（school）表id',
  `gallery` text COMMENT '驾校图集',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `school_id` (`schoolId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='驾校相册表';

-- ----------------------------
-- Records of school_gallery
-- ----------------------------

-- ----------------------------
-- Table structure for school_type
-- ----------------------------
DROP TABLE IF EXISTS `school_type`;
CREATE TABLE `school_type` (
  `schoolTypeId` int(11) NOT NULL COMMENT '学校驾照类型id',
  `schoolId` int(11) NOT NULL COMMENT '学校id（关联school表schoolId）',
  `type` varchar(50) DEFAULT NULL COMMENT '学校驾照类型',
  `price` decimal(10,0) DEFAULT NULL COMMENT '价格',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`schoolTypeId`),
  KEY `schoolId` (`schoolId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='学校驾照类型表';

-- ----------------------------
-- Records of school_type
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '管理员', '709344897@qq.com', '$2y$10$ijzRzxk3mSJuQi0MPcpyZeDmePGk6lu0TLBWo7kVivuvJocJ6QOBa', 'ywe7riDYzryDAzgnBu7fK43lYNFodSay8wX9GjgUeWJ36qBXqByCzu1fTTFk', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `users` VALUES ('2', 'Kiley', 'Pierre Smitham', 'metz.corine@example.net', '$2y$10$oVtKN2BNE/A6EZP6bTUreu6gX1r9vGyfdh.JznKomCiD7J1NmVd62', 'uudegKrfcX', '2017-04-07 13:07:51', '2017-04-07 13:07:51');
INSERT INTO `users` VALUES ('3', 'Joel', 'Spencer Kirlin', 'ymclaughlin@example.com', '$2y$10$oVtKN2BNE/A6EZP6bTUreu6gX1r9vGyfdh.JznKomCiD7J1NmVd62', 'xqMD4dFCxB', '2017-04-07 13:07:51', '2017-04-07 13:07:51');
INSERT INTO `users` VALUES ('4', 'Lelah', 'Lucinda Moore', 'walsh.penelope@example.net', '$2y$10$oVtKN2BNE/A6EZP6bTUreu6gX1r9vGyfdh.JznKomCiD7J1NmVd62', '7OKwsN0RHT', '2017-04-07 13:07:51', '2017-04-07 13:07:51');

-- ----------------------------
-- Table structure for write_back
-- ----------------------------
DROP TABLE IF EXISTS `write_back`;
CREATE TABLE `write_back` (
  `writebackId` int(11) NOT NULL AUTO_INCREMENT COMMENT '系统回复给用户消息id',
  `feedbackId` int(11) DEFAULT NULL COMMENT '关联feedback表的feedbackId',
  `memberId` int(11) NOT NULL COMMENT '回复给哪一个用户（关联memberId）',
  `userId` int(11) NOT NULL COMMENT '是哪个管理员回复给用户的消息(关联user表）',
  `content` varchar(255) DEFAULT NULL COMMENT '回复消息内容',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`writebackId`),
  KEY `memberId` (`memberId`),
  KEY `userId` (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统管理员回复用户消息表';

-- ----------------------------
-- Records of write_back
-- ----------------------------
