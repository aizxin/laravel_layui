/*
Navicat MySQL Data Transfer

Source Server         : phpstudy
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : kamun

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-07-26 17:59:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `articleCategoryId` int(11) NOT NULL COMMENT '文章分类的id',
  `title` varchar(255) DEFAULT NULL COMMENT '文章标题',
  `author` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL COMMENT '文章图片',
  `rank` int(11) DEFAULT '555' COMMENT '排序顺序',
  `content` text COMMENT '文章内容',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '添加时间',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `cid` (`articleCategoryId`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of article
-- ----------------------------

-- ----------------------------
-- Table structure for article_category
-- ----------------------------
DROP TABLE IF EXISTS `article_category`;
CREATE TABLE `article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章分类Id',
  `parent_id` int(11) DEFAULT NULL COMMENT '文章分类父id',
  `name` varchar(255) NOT NULL COMMENT '文章分类名称',
  `status` int(1) DEFAULT '1' COMMENT '0:待处理1:显示,-1:隐藏',
  `created_at` timestamp NULL DEFAULT NULL COMMENT '添加时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `name` (`name`),
  KEY `status` (`status`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='文章分类表';

-- ----------------------------
-- Records of article_category
-- ----------------------------
INSERT INTO `article_category` VALUES ('1', '0', '常见问题', '1', '2017-04-19 12:43:45', '2017-05-03 14:42:23');
INSERT INTO `article_category` VALUES ('2', '0', '学车须知', '1', '2017-04-19 12:57:34', '2017-04-19 12:58:35');
INSERT INTO `article_category` VALUES ('3', '0', '关于我们', '1', '2017-04-19 12:57:50', '2017-04-19 12:57:50');
INSERT INTO `article_category` VALUES ('4', '0', '法律', '1', '2017-04-21 20:17:41', '2017-04-21 20:17:41');

-- ----------------------------
-- Records of article_category
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
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
INSERT INTO `permissions` VALUES ('22', '5', '0', '权限分配', 'role.permission', '权限分配', null, '0', null, '2017-04-13 16:39:42', '2017-07-27 14:07:38');
INSERT INTO `permissions` VALUES ('23', '5', '0', '角色权限详情', 'role.show', '角色权限', null, '1', null, '2017-04-13 18:53:10', '2017-07-27 10:35:04');
INSERT INTO `permissions` VALUES ('24', '4', '0', '管理员详情', 'user.show', '管理员详情', null, '1', null, '2017-07-27 14:06:05', '2017-07-27 14:06:05');
INSERT INTO `permissions` VALUES ('25', '4', '0', '角色分配', 'user.role', '管理员详情', null, '1', null, '2017-07-27 14:06:48', '2017-07-27 17:19:14');
INSERT INTO `permissions` VALUES ('26', '0', '1', '文章管理', 'article.manage', '文章管理', 'fa fa-calendar-o', '1', null, '2017-04-13 16:39:42', '2017-04-17 13:24:56');
INSERT INTO `permissions` VALUES ('27', '26', '1', '文章分类', 'article.category.index', '文章分类管理', 'fa fa-clone', '1', null, '2017-04-17 16:10:38', '2017-04-25 12:03:57');
INSERT INTO `permissions` VALUES ('28', '27', '0', '文章分类添加操作', 'article.category.store', '文章分类添加操作', null, '1', null, '2017-04-18 12:17:03', '2017-04-18 12:17:03');
INSERT INTO `permissions` VALUES ('29', '27', '0', '文章分类添加视图', 'article.category.create', '文章添加视图', null, '1', null, '2017-04-18 12:18:11', '2017-04-18 12:18:11');
INSERT INTO `permissions` VALUES ('30', '27', '0', '文章分类更新视图', 'article.category.edit', '文章分类更新视图', null, '1', null, '2017-04-18 12:19:17', '2017-04-18 12:19:17');
INSERT INTO `permissions` VALUES ('31', '27', '0', '文章分类删除', 'article.category.destroy', '文章分类删除', null, '1', null, '2017-04-18 12:20:24', '2017-04-18 12:20:24');
INSERT INTO `permissions` VALUES ('32', '26', '1', '文章列表', 'article.index', '文章列表', 'fa fa-reorder', '1', null, '2017-04-19 12:05:05', '2017-04-19 12:05:05');
INSERT INTO `permissions` VALUES ('33', '32', '0', '文章添加视图', 'article.create', '文章添加视图', null, '1', null, '2017-04-19 12:06:23', '2017-04-19 12:06:23');
INSERT INTO `permissions` VALUES ('34', '32', '0', '文章添加操作', 'article.store', '文章添加操作', null, '1', null, '2017-04-19 12:07:10', '2017-04-19 12:07:10');
INSERT INTO `permissions` VALUES ('35', '32', '0', '文章更新视图', 'article.edit', '文章更新视图', null, '1', null, '2017-04-19 12:07:57', '2017-04-19 12:07:57');
INSERT INTO `permissions` VALUES ('36', '32', '0', '文章更新操作', 'article.update', '文章更新操作', null, '1', null, '2017-04-19 12:09:18', '2017-04-19 12:09:18');
INSERT INTO `permissions` VALUES ('37', '32', '0', '文章删除', 'article.destroy', '文章删除', null, '1', null, '2017-04-19 12:10:02', '2017-04-19 13:05:20');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', '超级管理员', 'admin', '超级管理员', '1', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `roles` VALUES ('2', '普通用户1', 'user1', '普通用户1', '1', '2017-04-07 13:07:50', '2017-04-13 19:41:12');
INSERT INTO `roles` VALUES ('4', '11', '1', '1', '1', '2017-07-26 16:21:50', '2017-07-26 16:33:42');

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
INSERT INTO `users` VALUES ('1', 'admin', '管理员', '709344897@qq.com', '$2y$10$ijzRzxk3mSJuQi0MPcpyZeDmePGk6lu0TLBWo7kVivuvJocJ6QOBa', 'wLgFeNe45c3kaMFHgjDEidCJHePkZO5lWFZgv2h05mQ7HSU9FtjZ7uhoIcCe', '2017-04-07 13:07:50', '2017-04-07 13:07:50');
INSERT INTO `users` VALUES ('2', 'Kiley', 'Pierre Smitham', 'metz.corine@example.net', '$2y$10$oVtKN2BNE/A6EZP6bTUreu6gX1r9vGyfdh.JznKomCiD7J1NmVd62', 'uudegKrfcX', '2017-04-07 13:07:51', '2017-04-07 13:07:51');
INSERT INTO `users` VALUES ('3', 'Joel', 'Spencer Kirlin', 'ymclaughlin@example.com', '$2y$10$oVtKN2BNE/A6EZP6bTUreu6gX1r9vGyfdh.JznKomCiD7J1NmVd62', 'xqMD4dFCxB', '2017-04-07 13:07:51', '2017-04-07 13:07:51');
INSERT INTO `users` VALUES ('4', 'Lelah1', 'Lucinda Moore', 'walsh.penelope@example.net', '$2y$10$gn/tO/N1bFoX7r5VOCA3d.kE.UVsOlNLhFQC/b7SqBj8WIGwaeUj.', '7OKwsN0RHT', '2017-04-07 13:07:51', '2017-04-17 14:47:10');
