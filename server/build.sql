# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.6.35)
# Database: tp5
# Generation Time: 2017-08-15 13:41:06 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
# Dump of database lab
# ------------------------------------------------------------

CREATE DATABASE if NOT EXISTS `lab`;

USE `lab`;

# Dump of table lab_banner
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lab_banner`;

CREATE TABLE `lab_banner` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '广告主键',
  `title` longtext DEFAULT NULL COMMENT '标题',
  `position` tinyint(4) DEFAULT NULL COMMENT '位置',
  `img` varchar(200) DEFAULT NULL COMMENT '图片',
  `img_origin` varchar(200) DEFAULT NULL COMMENT '图片源',
  `section` tinyint(4) DEFAULT NULL COMMENT '版块',
  `conid` int(11) DEFAULT NULL COMMENT '外键',
  `begintime` int(11) DEFAULT NULL COMMENT '开始时间',
  `endtime` int(11) DEFAULT NULL COMMENT '结束时间',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态：1->启用；2->关闭',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Dump of table lab_research_area
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lab_research_area`;

CREATE TABLE `lab_research_area` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(1000) DEFAULT NULL COMMENT '标签,外键',
  `tagid` tinyint(4) unsigned DEFAULT NULL COMMENT '标签',
  `digest` varchar(1000) DEFAULT NULL COMMENT '摘要',
  `img` varchar(200) DEFAULT NULL COMMENT '图片',
  `img_origin` varchar(200) DEFAULT NULL COMMENT '图片源',
  `content` longtext DEFAULT NULL COMMENT '内容',
  `istop` tinyint(1) unsigned DEFAULT 0 COMMENT '是否置顶',
  `ispublish` tinyint(1) unsigned DEFAULT 0 COMMENT '是否发布',
  `toptime` int(11) DEFAULT NULL COMMENT '置顶时间',
  `publishtime` int(11) DEFAULT NULL COMMENT '发布时间',
  `isrecommend` tinyint(1) unsigned DEFAULT 0 COMMENT '是否推荐',
  `recommendtime` int(11) DEFAULT NULL COMMENT '推荐时间',
  `recomm_pos` tinyint(4) unsigned DEFAULT NULL COMMENT '推荐位置',
  `recomm_begintime` int(11) DEFAULT NULL COMMENT '推荐开始时间',
  `recomm_endtime` int(11) DEFAULT NULL COMMENT '推荐结束时间',
  `count_view` int(11) DEFAULT 0 COMMENT '阅读量',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态：1->启用；2->关闭',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Dump of table lab_member
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lab_member`;

CREATE TABLE `lab_member` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `tagid` tinyint(4) DEFAULT NULL COMMENT '标签,外键',
  `name` varchar(50) DEFAULT NULL COMMENT '姓名',
  `tutor` varchar(50) DEFAULT NULL COMMENT '导师',
  `phone` varchar(20) DEFAULT NULL COMMENT '手机号',
  `email` varchar(200) DEFAULT NULL COMMENT '邮箱',
  `address` varchar(200) DEFAULT NULL COMMENT '地址',
  `position` varchar(200) DEFAULT NULL COMMENT '职称',
  `url` varchar(200) DEFAULT NULL COMMENT '链接',
  `research_area` varchar(1000) DEFAULT NULL COMMENT '研究领域',
  `img` varchar(200) DEFAULT NULL COMMENT '图片',
  `img_origin` varchar(200) DEFAULT NULL COMMENT '图片源',
  `bgimg` varchar(200) DEFAULT NULL COMMENT '背景图片',
  `bgimg_origin` varchar(200) DEFAULT NULL COMMENT '背景图片源',
  `digest` varchar(1000) DEFAULT NULL COMMENT '摘要',
  `descr` varchar(5000) DEFAULT NULL COMMENT '描述',
  `iscurrent` tinyint(1) unsigned DEFAULT 0 COMMENT '是否在职',
  `istop` tinyint(1) unsigned DEFAULT 0 COMMENT '是否置顶',
  `ispublish` tinyint(1) unsigned DEFAULT 0 COMMENT '是否发布',
  `toptime` int(11) DEFAULT NULL COMMENT '置顶时间',
  `publishtime` int(11) DEFAULT NULL COMMENT '发布时间',
  `isrecommend` tinyint(1) unsigned DEFAULT 0 COMMENT '是否推荐',
  `recommendtime` int(11) DEFAULT NULL COMMENT '推荐时间',
  `recomm_pos` tinyint(4) unsigned DEFAULT NULL COMMENT '推荐位置',
  `recomm_begintime` int(11) DEFAULT NULL COMMENT '推荐开始时间',
  `recomm_endtime` int(11) DEFAULT NULL COMMENT '推荐结束时间',
  `count_view` int(11) DEFAULT 0 COMMENT '阅读量',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态：1->启用；2->关闭',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  FOREIGN KEY (tagid) REFERENCES lab_tag(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Dump of table lab_result
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lab_result`;

CREATE TABLE `lab_result` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` longtext DEFAULT NULL COMMENT '标题',
  `tagid` tinyint(4) DEFAULT NULL COMMENT '标签,外键',
  `research_id` tinyint(4) DEFAULT 1 COMMENT '研究方向id,外键',
  `href` varchar(200) DEFAULT NULL COMMENT '外链接',
  `digest` varchar(1000) DEFAULT NULL COMMENT '摘要',
  `img` varchar(200) DEFAULT NULL COMMENT '图片',
  `img_origin` varchar(200) DEFAULT NULL COMMENT '图片源',
  `file` varchar(200) DEFAULT NULL COMMENT '文件',
  `file_origin` varchar(200) DEFAULT NULL COMMENT '文件源',
  `content` longtext DEFAULT NULL COMMENT '内容',
  `istop` tinyint(1) unsigned DEFAULT 0 COMMENT '是否置顶',
  `ispublish` tinyint(1) unsigned DEFAULT 0 COMMENT '是否发布',
  `toptime` int(11) DEFAULT NULL COMMENT '置顶时间',
  `publishtime` int(11) DEFAULT NULL COMMENT '发布时间',
  `isrecommend` tinyint(1) unsigned DEFAULT 0 COMMENT '是否推荐',
  `recommendtime` int(11) DEFAULT NULL COMMENT '推荐时间',
  `recomm_pos` tinyint(4) unsigned DEFAULT NULL COMMENT '推荐位置',
  `recomm_begintime` int(11) DEFAULT NULL COMMENT '推荐开始时间',
  `recomm_endtime` int(11) DEFAULT NULL COMMENT '推荐结束时间',
  `count_view` int(11) DEFAULT 0 COMMENT '阅读量',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态：1->启用；2->关闭',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  FOREIGN KEY (tagid) REFERENCES lab_tag(id),
  FOREIGN KEY (research_id) REFERENCES lab_research_area(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Dump of table lab_news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lab_news`;

CREATE TABLE `lab_news` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` longtext DEFAULT NULL COMMENT '标题',
  `author` varchar(50) DEFAULT NULL COMMENT '作者',
  `tagid` tinyint(4) DEFAULT NULL COMMENT '标签,外键',
  `href` varchar(200) DEFAULT NULL COMMENT '外链接',
  `digest` varchar(1000) DEFAULT NULL COMMENT '摘要',
  `img` varchar(200) DEFAULT NULL COMMENT '图片',
  `img_origin` varchar(200) DEFAULT NULL COMMENT '图片源',
  `content` longtext DEFAULT NULL COMMENT '内容',
  `istop` tinyint(1) unsigned DEFAULT 0 COMMENT '是否置顶',
  `ispublish` tinyint(1) unsigned DEFAULT 0 COMMENT '是否发布',
  `toptime` int(11) DEFAULT NULL COMMENT '置顶时间',
  `publishtime` int(11) DEFAULT NULL COMMENT '发布时间',
  `regular_publishtime` int(11) DEFAULT NULL COMMENT '定时发布时间',
  `isrecommend` tinyint(1) unsigned DEFAULT 0 COMMENT '是否推荐',
  `recommendtime` int(11) DEFAULT NULL COMMENT '推荐时间',
  `recomm_pos` tinyint(4) unsigned DEFAULT NULL COMMENT '推荐位置',
  `recomm_begintime` int(11) DEFAULT NULL COMMENT '推荐开始时间',
  `recomm_endtime` int(11) DEFAULT NULL COMMENT '推荐结束时间',
  `count_view` int(11) DEFAULT 0 COMMENT '阅读量',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态：1->启用；2->关闭',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  FOREIGN KEY (tagid) REFERENCES lab_tag(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Dump of table lab_tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lab_tag`;

CREATE TABLE `lab_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(1000) DEFAULT NULL COMMENT '标题',
  `section` varchar(50) DEFAULT NULL COMMENT '版块',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态：1->启用；2->关闭',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Dump of table lab_user_admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lab_user_admin`;

CREATE TABLE `lab_user_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(50) DEFAULT NULL COMMENT '账号',
  `pass` varchar(50) DEFAULT NULL COMMENT '密码',
  `roleid` tinyint(4) DEFAULT NULL COMMENT '角色',
  `remark` varchar(50) DEFAULT NULL COMMENT '备注',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态：1->启用；2->关闭；3->禁用',
  `logintime` int(11) DEFAULT NULL COMMENT '登陆时间',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  FOREIGN KEY (roleid) REFERENCES lab_role_admin(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Dump of table lab_role_admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lab_role_admin`;

CREATE TABLE `lab_role_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(50) DEFAULT NULL COMMENT '角色名',
  `remark` varchar(50) DEFAULT NULL COMMENT '备注',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态：1->启用；2->关闭',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Dump of table lab_action_admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lab_action_admin`;

CREATE TABLE `lab_action_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(50) DEFAULT NULL COMMENT '操作名称',
  `tag` varchar(50) DEFAULT NULL COMMENT '备注',
  `pid` tinyint(4) DEFAULT NULL COMMENT '父节点',
  `pids` varchar(10) DEFAULT NULL COMMENT '父子节点关系',
  `level` tinyint(4) DEFAULT NULL COMMENT '层次',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态：1->启用；2->关闭',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Dump of table lab_role_action_admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lab_role_action_admin`;

CREATE TABLE `lab_role_action_admin` (
  `roleid` tinyint(4) unsigned NOT NULL COMMENT '外键,角色id',
  `actionid` tinyint(4) DEFAULT NULL COMMENT '外键,操作id',
  `status` tinyint(4) DEFAULT NULL COMMENT '状态：1->启用；2->关闭',
  `createtime` int(11) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`roleid`, `actionid`),
  FOREIGN KEY (roleid) REFERENCES lab_role_admin(id),
  FOREIGN KEY (actionid) REFERENCES lab_action_admin(id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
