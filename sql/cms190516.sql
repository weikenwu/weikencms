/*
Navicat MySQL Data Transfer

Source Server         : wamp
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : cms

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2019-05-16 14:34:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cms_adver`
-- ----------------------------
DROP TABLE IF EXISTS `cms_adver`;
CREATE TABLE `cms_adver` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//',
  `title` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `info` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cms_adver
-- ----------------------------
INSERT INTO `cms_adver` VALUES ('1', '腾讯开始进军游戏网络市场', '', 'http://www.qq.com', '腾讯开始进军游戏网络市场腾讯开始进军游戏网络市场', '1', '1', '2019-05-05 14:31:37');
INSERT INTO `cms_adver` VALUES ('2', '新浪微博进军博客', '', 'http://weibo.com', '新浪微博进军博客新浪微博进军博客', '1', '1', '2019-05-05 14:32:52');
INSERT INTO `cms_adver` VALUES ('3', '网易广告请进入', '', 'http://www.163.com', '网易广告请进入网易广告请进入', '1', '1', '2019-05-05 14:33:17');
INSERT INTO `cms_adver` VALUES ('5', '头部广告测试1', '/default1/CMS0.2/uploads/20190505/20190505163519231.jpg', 'http://sian.com.cn', '头部广告测试1头部广告测试1', '2', '1', '2019-05-05 16:35:24');
INSERT INTO `cms_adver` VALUES ('6', '头部广告测试2', '/default1/CMS0.2/uploads/20190505/20190505163646316.jpg', 'http://baidu.com', '头部广告测试2头部广告测试2', '2', '1', '2019-05-05 16:36:54');
INSERT INTO `cms_adver` VALUES ('7', '侧边栏广告测试1', '/default1/CMS0.2/uploads/20190505/20190505170534833.jpg', 'http://www.qq.com', '侧边栏广告测试1', '3', '1', '2019-05-05 17:05:43');
INSERT INTO `cms_adver` VALUES ('8', '侧边栏广告测试2', '/default1/CMS0.2/uploads/20190505/20190505170636481.jpg', 'http://weibo.com', '侧边栏广告测试2侧边栏广告测试2', '3', '1', '2019-05-05 17:06:43');

-- ----------------------------
-- Table structure for `cms_comment`
-- ----------------------------
DROP TABLE IF EXISTS `cms_comment`;
CREATE TABLE `cms_comment` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//id',
  `user` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '//评论者',
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '//内容',
  `manner` tinyint(1) NOT NULL COMMENT '//态度',
  `cid` mediumint(8) NOT NULL COMMENT '//内容ID',
  `sustain` smallint(6) unsigned NOT NULL COMMENT '//支持',
  `oppose` smallint(6) unsigned NOT NULL COMMENT '//反对率',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '//状态',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cms_comment
-- ----------------------------
INSERT INTO `cms_comment` VALUES ('2', '蜡笔小新', '蜡笔小新测试评论', '0', '12', '0', '0', '1', '2019-04-23 10:27:58');
INSERT INTO `cms_comment` VALUES ('3', '蜡笔小新', '蜡笔小新测试评论2', '-1', '12', '3', '0', '1', '2019-04-23 10:35:48');
INSERT INTO `cms_comment` VALUES ('4', '蜡笔小新', '支持在测试一条haha', '1', '12', '0', '0', '1', '2019-04-24 09:01:47');
INSERT INTO `cms_comment` VALUES ('5', '游客', '我游客来一条', '1', '12', '0', '0', '1', '2019-04-24 09:58:36');
INSERT INTO `cms_comment` VALUES ('6', '游客', '评论下测试', '1', '11', '0', '0', '1', '2019-04-24 15:19:08');
INSERT INTO `cms_comment` VALUES ('7', '游客', '测试下评论你看看', '1', '11', '1', '0', '1', '2019-05-16 11:44:07');
INSERT INTO `cms_comment` VALUES ('8', '威肯', '哇,有钱人就是好', '1', '14', '1', '0', '1', '2019-05-16 14:14:44');

-- ----------------------------
-- Table structure for `cms_content`
-- ----------------------------
DROP TABLE IF EXISTS `cms_content`;
CREATE TABLE `cms_content` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//编号',
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '//标题',
  `nav` mediumint(8) unsigned NOT NULL COMMENT '//栏目号',
  `attr` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '//属性',
  `tag` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '//标签',
  `keyword` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '//关键字',
  `thumbnail` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '//缩略图',
  `source` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '//文章来源',
  `author` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '//作者',
  `info` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '//简介',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '//详细内容',
  `commend` tinyint(1) NOT NULL DEFAULT '1' COMMENT '//评论开关',
  `count` smallint(6) NOT NULL DEFAULT '0' COMMENT '//浏览次数',
  `gold` tinyint(6) NOT NULL DEFAULT '0' COMMENT '//金币',
  `sort` tinyint(1) NOT NULL DEFAULT '0' COMMENT '//排序',
  `readlimit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '//阅读权限',
  `color` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '//颜色',
  `date` datetime NOT NULL COMMENT '//发布时间',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cms_content
-- ----------------------------
INSERT INTO `cms_content` VALUES ('10', '3款无线手柄横评：2000块的手柄能比100块的好多少', '3', '推荐,头条', '无线手柄,横评', '无线手柄,横评', '/default1/CMS0.2/uploads/20190410/20190410093025603.png', 'PIC', 'admin', '[PConline 横评]随着无线风潮的掀起，游戏手柄也逐渐开始摆脱线材的束缚，可以通过蓝牙或者接收器与PC和游戏机相连，使用无线手柄的好处是显而易见的，连接大屏电视时我们能隔着老远玩游戏，对着电脑时也能躺在床上玩3A大作。', '<p>\r\n	<span -webkit-text-stroke-width:=\"\" background-color:=\"\" display:=\"\" float:=\"\" font-size:=\"\" font-style:=\"\" font-variant-caps:=\"\" font-variant-ligatures:=\"\" font-weight:=\"\" inline=\"\" letter-spacing:=\"\" microsoft=\"\" orphans:=\"\" style=\"color: rgb(0, 0, 0); font-family: \" text-align:=\"\" text-decoration-color:=\"\" text-decoration-style:=\"\" text-indent:=\"\" text-transform:=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\">经典到不能再经典的XBOX手柄系列，外观耐看，舒适度被广大用户赞叹。据说为了这个设计花费了几千万的研发费用，就是为了找到又好看舒适度又高的解决方案，不过却因为使用5号电池供电饱受玩家诟病。来自XBOX的优质手柄，在提供了非常好的体验的情况下价格不过400元左右。<img alt=\"\" src=\"/default1/CMS0.2/uploads/20190410/20190410093224239.jpg\" style=\"width: 300px; height: 300px;\" /></span></p>\r\n<p>\r\n	<span -webkit-text-stroke-width:=\"\" background-color:=\"\" display:=\"\" float:=\"\" font-size:=\"\" font-style:=\"\" font-variant-caps:=\"\" font-variant-ligatures:=\"\" font-weight:=\"\" inline=\"\" letter-spacing:=\"\" microsoft=\"\" orphans:=\"\" style=\"color: rgb(0, 0, 0); font-family: \" text-align:=\"\" text-decoration-color:=\"\" text-decoration-style:=\"\" text-indent:=\"\" text-transform:=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\"><span -webkit-text-stroke-width:=\"\" background-color:=\"\" display:=\"\" float:=\"\" font-size:=\"\" font-style:=\"\" font-variant-caps:=\"\" font-variant-ligatures:=\"\" font-weight:=\"\" inline=\"\" letter-spacing:=\"\" microsoft=\"\" orphans:=\"\" style=\"color: rgb(0, 0, 0); font-family: \" text-align:=\"\" text-decoration-color:=\"\" text-decoration-style:=\"\" text-indent:=\"\" text-transform:=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\">经典到不能再经典的XBOX手柄系列，外观耐看，舒适度被广大用户赞叹。据说为了这个设计花费了几千万的研发费用，就是为了找到又好看舒适度又高的解决方案，不过却因为使用5号电池供电饱受玩家诟病。来自XBOX的优质手柄，在提供了非常好的体验的情况下价格不过400元左右。</span></span></p>\r\n', '0', '22', '2', '2', '1', 'red', '2019-05-01 09:32:43');
INSERT INTO `cms_content` VALUES ('11', '智能门锁火了 智能窗会成为下一个行业爆点么', '4', '头条，推荐', '智能门锁,行业爆点', '智能门锁,行业爆点', '/default1/CMS0.2/uploads/20190410/20190410142942570.jpg', '头条', 'admin', '门窗对于家庭来讲是现实意义的入口，近年来随着智能化技术的渗透，在门上做智能产品的厂家不计其数，智能门锁和智能猫眼已成为智能家居安全布防场景下的重要一环，而反观在窗上做智能化的厂家似乎寥寥无几。', '<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	门窗对于家庭来讲是现实意义的入口，近年来随着智能化技术的渗透，在门上做智能产品的厂家不计其数，智能门锁和智能猫眼已成为智能家居安全布防场景下的重要一环，而反观在窗上做智能化的厂家似乎寥寥无几。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	智能窗产品在传统窗子的形态上增加了新的体验，例如在室内的情况下通过语音操控或者遥控器就能控制窗户的自动开合或者上悬，远程则可以通过APP来控制窗的各种状态，最新款的智能窗开始把透明的触控显示屏做到窗子上，在不影响透明度的情况下，屏幕上可以显示所在地的天气和室内外空气质量等相关信息，甚至还可配置上窗式新风过滤系统及光线调节系统。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	亿欧家居日前在一个智能方案展厅里现场体验了源码智能旗下几种智能窗系统，通过与源码智能联合创始人高敬对话了解到，与智能门锁赛道拥挤不堪的现状形成反差，智能窗虽是片待开发的万亿级蓝海，但目前似乎很难有千家大战的火爆局面。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	<strong>万亿蓝海，传统中小门窗厂转型难</strong></p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	长久以来，门窗是个相对传统且分散的行业，伴随中国房地产行业的发展市场体量巨大。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	&ldquo;我们从2015年成立公司开始创业(董事长逯金重，CEO赵畅，联合创始人高敬，CTO张淼辉)，当时想做物联网智能家居类的产品，最后锁定门窗行业做第一款产品，首先是因为体量足够大，有6000多亿元的门窗市场规模，窗差不多能占到3000亿，其次这个市场是一种很传统的低端制造业，长久以来有很多痛点并没有解决。&rdquo;高敬对亿欧家居说道。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	痛点一，当室内空气质量不好，比如二氧化碳、甲醛、苯等不良气体含量高的时候最简单的方式其实是开窗换气进行调节，空气净化器等室内设备的吸附能力有限;痛点二，室外有雾霾、沙尘暴、下雨等天气状况时需要及时乃至提前关窗，目前皆须人工手动操作;痛点三，比如有刚装修的新房尚未住人，或者有长期空置的度假房，在没有远程操控的情况下，人们只能每天跑去开关窗或者雇佣外人去管理通风，不放心也不安全。于是，可以远程控制且能自主开关的智能窗就有了发力点。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	高敬透露，目前团队给智能窗产品下了两个方向的产品定义。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	第一类是智能的微气候窗，通过智能化的开关窗调节，让室内的温度、湿度、空气质量保持在一个健康范围，并能自主防范天气变化;</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	第二类是智能显示窗，通过给智能窗新增显示屏幕，在不同的场景下可为用户提供更多的生活、教学、工作相关信息，未来的每一扇窗都是物联网的智能终端。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	除了每年的增量市场，窗户的存量市场也十分可观。高敬表示这个周期大概是十年改造一次，所以至少还有万亿级的窗户存量市场，针对增量市场和存量市场的智能窗解决方案还有巨大探索空间。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	然而，智能窗现阶段到达用户的途径可能并不像智能锁一样有迅速成为随机消费品的趋势，通过toB渗透toC似乎是绕不开的路线。首先它的产品形态、运输和安装都更为复杂，用户很分散，需要建立标准化的服务体系;其次是建筑的多样化导致窗子没有固定的尺寸标准，需要做批量定制，这也是整个市场存在分化的主要原因。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	高敬介绍：&ldquo;中国没有完全标准化的建筑，每栋建筑对窗子的尺寸、颜色、型材要求可能都不一样，我们目前还是以B端业务为主，比如学校，我们能去覆盖一个或者几个校区的教室用上智能窗;比如住宅地产，可能分成ABCD四个户型，可以配套定制智能窗产品，这会有一定的批量，包括写字楼项目等，2B的项目占到我们业务的90%，而在2C方面，主要聚焦个人家庭的住宅和别墅项目，主要还是要考虑客单价和成本投入。&rdquo;</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	另一方面，亿欧家居也了解到，传统门窗企业转型做智能窗的门槛很高，这是一种跨学科跨领域的产品新品类，大部分的传统门窗中小企业可能面临相关的人才匮乏问题，而高端的技术人才又很少有意愿下沉到低端制造组装行业中去。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	传统的门窗厂多是前店后厂的模式，厂家背后一个或者几个工厂，渠道终端开一些店，大的品牌可能有几百家的全国分店，在居然之家、红星美凯龙等卖场或者自己的门店触达C端。还有一些厂家是属于工装型的企业，会把产品直接卖给开发商等大客户。传统门窗行业门槛不算很高，行业里既有上市公司，也普遍存在小作坊一样的模式，几十个工人把窗子加工出来，把铝材或塑钢、玻璃、胶条、五金等配件进行组装。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	&ldquo;我们跟一些传统的窗厂的负责人和总工程师聊过，他们看到了智能窗市场却难以做出来成熟的产品。这是需要有人去懂电控，电子和机械自动装置，需要有人懂软件、云平台和移动端APP等多领域的技术，找到这些方面的优秀人才可能得去微软、华为等高新科技型的企业去找，但是要这些领域的人才去传统的门窗厂工作可能性低。&rdquo;高敬说道。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	一边是传统窗企业缺少跨学科类的专业人才，另一边可能无论是智能窗还是传统窗，都是一个模式偏重的制造产业，智能门窗属于传统门窗行业的升级转型，也是互联网+门窗，对于电子和互联网科技公司来说，门窗也是一门新的学科，比如门窗要研究它的五性：气密性、水密性、抗风压性、保温性和隔声性，跨界难度也不算小。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	国内创业复制成风，看到有利可图的风口总会有厂家一窝蜂杀进来掘金，就目前看来，智能窗产品被迅速抄袭复制的可能性不大。高敬表示团队花了近三年的时间做产品的研发和反复的测试，因为窗户一旦安装上至少十年不会再拆换了，还要每天面对风吹日晒，内外温差防水防潮等，这比对智能门锁类产品的考验大的多，目前公司基于智能窗申请的各种专利近百项，产品推出市场前先在知识产权层面形成一层保护。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	想涉足智能窗赛道，自主专利技术和核心方案创新将是企业关键壁垒和PK维度，这里虽一切尚未定型，短期内却也难以野蛮生长。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	<strong>地产的白银时代，智能窗的黄金发展期</strong></p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	虽然房地产行业到了白银时代，但是基于这种现状新兴的智慧地产和健康建筑潮流或将给智能窗的发展带来黄金发展期。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	在对话中亿欧家居了解到，目前美国WELL健康建筑标准正在被国内许多地产开发商落地，健康建筑将重点围绕&ldquo;人&rdquo;来研究建筑与居住者健康之间的关系，重塑建筑标准，解决居住健康问题。WELL建筑标准由空气、水、营养、光线、健身、舒适性和意识等部分组成，健康建筑与智能家居结合将会碰撞出无限可能。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	在这种潮流下智能窗未来可能成为家庭中的一个新型入口或者平台，比如智能微气候窗，可以与室内外的各种温湿传感器、空气质量检测器、空气净化器、加湿器、空调、风扇、新风系统等形成联动，实现智能化管理调节室内的微气候和空气循环，保持健康舒适的水平，高敬透露目前源码智能的智能门窗系统也正在主动和很多主流智能家居生态平台进行对接融入。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	而另一类智能显示窗除了具备智能窗的各种功能外，会增加显示屏交互。例如跟高等院校、幼儿园等合作的智能窗配置透明的显示屏，在玻璃上，可以显示这间教室的课程安排;在一些智能化现代化的楼盘，物业要发出通知通告，原来方式可能是在一楼门口或电梯、公告牌贴张纸，未来可以直接推送到智能窗上，甚至包括举办什么活动、有什么产品优惠等等信息投放。这些可以为学校打造一流的教学环境或者为地产楼盘增加健康、智能的亮点标签。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	高敬表示智能窗市场初期商业模式现在以TOB为主，未来新的营销方式和盈利模式还有很大想象空间，比如把它当作一个平台，采用云服务运营的方式，提供给一些大客户或商业综合体等安装使用，每年去做一些付费信息投放、数字营销等。这些未来打算的前提是，智能窗有足够多的用户在用，有足够大的产品销量。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	&ldquo;智能家居肯定不是什么新概念，人工智能、智能家居的说法可能存在几十年了，但是真正这几年能够有机会大范围落地的原因是多层次的，比如4G、5G、无线通信技术进步，比如芯片性能提升、传感器价格的下降可靠性的增强等等，都是关键因素。我觉得智能家居最终落地还是需要考量实际的应用场景。第一是创新技术的成熟，第二是成本可以负担，第三是技术和产品的可靠性、稳定性;第四就是应用场景。&rdquo;高敬总结说。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	<strong>结语</strong></p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	据国家统计数据显示，在2017年我国门窗行业市场规模就已突破6600亿元，另一个现象是，根据颁发许可证统计，自2015年后，我国门窗行业规模以上的企业数量开始持续减少，到2017年下降至3764家，2018年大概也有3500余家，其中95%以上都是中小型门窗企业。</p>\r\n<p style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: &quot;\\&quot;PingFang SC\\&quot;,Arial,\\&quot;Microsoft yahei\\&quot;,simsun,\\&quot;sans-serif\\&quot;&quot;; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(249, 249, 249); text-decoration-style: initial; text-decoration-color: initial;\">\r\n	地产行情、城镇化发展、技术创新不断为这个行业提供新的增长空间，而智能窗玩家的加入，或许将为这个市场带来新的变量，一石激起千层浪，推动这个传统行业走上转型升级和品牌聚焦之路。</p>\r\n', '1', '199', '11', '1', '0', '', '2019-05-01 14:30:25');
INSERT INTO `cms_content` VALUES ('12', '全球最大飞机首次试飞成功 未来将从半空发射卫星', '3', '头条,加粗,推荐', '全球,飞机', '首次试飞,发射卫星', '/default1/CMS0.2/uploads/20190415/20190415093551568.jpg', '头条', 'admin', '中新网4月15日电 综合报道，近日，在美国加利福尼亚州的莫哈韦沙漠，由平流层发射系统公司制造的全球最大的飞机——巨型双体飞机“罗克”(Roc)完成首次升空飞行', '<p>\r\n	<span -webkit-text-stroke-width:=\"\" background-color:=\"\" display:=\"\" float:=\"\" font-size:=\"\" font-style:=\"\" font-variant-caps:=\"\" font-variant-ligatures:=\"\" font-weight:=\"\" inline=\"\" letter-spacing:=\"\" microsoft=\"\" orphans:=\"\" pingfang=\"\" style=\"color: rgb(25, 25, 25); font-family: \" text-align:=\"\" text-decoration-color:=\"\" text-decoration-style:=\"\" text-indent:=\"\" text-transform:=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\">中新网4月15日电 综合报道，近日，在美国加利福尼亚州的莫哈韦沙漠，由平流层发射系统公司制造的全球最大的飞机&mdash;&mdash;巨型双体飞机&ldquo;罗克&rdquo;(Roc)完成首次升空飞行。据悉，这架飞机的最终目标是搭载一枚运载卫星的火箭飞到1万米的高度，将卫星射入低地球轨道。</span></p>\r\n<p -webkit-text-stroke-width:=\"\" background-color:=\"\" font-style:=\"\" font-variant-caps:=\"\" font-variant-ligatures:=\"\" font-weight:=\"\" letter-spacing:=\"\" microsoft=\"\" orphans:=\"\" pingfang=\"\" style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: \" text-align:=\"\" text-decoration-color:=\"\" text-decoration-style:=\"\" text-indent:=\"\" text-transform:=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\">\r\n	4月13日，&ldquo;Roc&rdquo;&mdash;&mdash;世界上最大的飞机&mdash;&mdash;在经过多年的研发后，在美国加利福尼亚的莫哈韦沙漠进行了首次试飞，并在空中飞行了两个多小时。</p>\r\n<p -webkit-text-stroke-width:=\"\" background-color:=\"\" font-style:=\"\" font-variant-caps:=\"\" font-variant-ligatures:=\"\" font-weight:=\"\" letter-spacing:=\"\" microsoft=\"\" orphans:=\"\" pingfang=\"\" style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: \" text-align:=\"\" text-decoration-color:=\"\" text-decoration-style:=\"\" text-indent:=\"\" text-transform:=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\">\r\n	<img alt=\"\" src=\"/default1/CMS0.2/uploads/20190415/20190415093652915.jpg\" style=\"width: 300px; height: 300px;\" /></p>\r\n<p -webkit-text-stroke-width:=\"\" background-color:=\"\" font-style:=\"\" font-variant-caps:=\"\" font-variant-ligatures:=\"\" font-weight:=\"\" letter-spacing:=\"\" microsoft=\"\" orphans:=\"\" pingfang=\"\" style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: \" text-align:=\"\" text-decoration-color:=\"\" text-decoration-style:=\"\" text-indent:=\"\" text-transform:=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\">\r\n	<strong>最高时速达304公里 翼展比一个足球场宽</strong></p>\r\n<p -webkit-text-stroke-width:=\"\" background-color:=\"\" font-style:=\"\" font-variant-caps:=\"\" font-variant-ligatures:=\"\" font-weight:=\"\" letter-spacing:=\"\" microsoft=\"\" orphans:=\"\" pingfang=\"\" style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: \" text-align:=\"\" text-decoration-color:=\"\" text-decoration-style:=\"\" text-indent:=\"\" text-transform:=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\">\r\n	报道称，这架双机身飞机罗克(Roc)是由平流层发射系统公司制造，该公司总部位于美国华盛顿州西雅图，致力于开发新的太空轨道发射系统。</p>\r\n<p -webkit-text-stroke-width:=\"\" background-color:=\"\" font-style:=\"\" font-variant-caps:=\"\" font-variant-ligatures:=\"\" font-weight:=\"\" letter-spacing:=\"\" microsoft=\"\" orphans:=\"\" pingfang=\"\" style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: \" text-align:=\"\" text-decoration-color:=\"\" text-decoration-style:=\"\" text-indent:=\"\" text-transform:=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\">\r\n	罗克于当地时间13日上午7时起飞，飞行了两个多小时后，安全返回莫哈韦航空港。据悉，此次试飞主要是测试罗克的性能。在试飞的过程中，其最高时速达每小时304公里。</p>\r\n<p -webkit-text-stroke-width:=\"\" background-color:=\"\" font-style:=\"\" font-variant-caps:=\"\" font-variant-ligatures:=\"\" font-weight:=\"\" letter-spacing:=\"\" microsoft=\"\" orphans:=\"\" pingfang=\"\" style=\"margin: 10px 0px 20px; padding: 0px; list-style: none; line-height: 30px; font-size: 16px; word-break: break-all; color: rgb(25, 25, 25); font-family: \" text-align:=\"\" text-decoration-color:=\"\" text-decoration-style:=\"\" text-indent:=\"\" text-transform:=\"\" white-space:=\"\" widows:=\"\" word-spacing:=\"\">\r\n	此外，罗克机翼翼展比一个足球场还宽，由6个波音747发动机驱动，起落架轮子多达28个。</p>\r\n<p>\r\n	&nbsp;</p>\r\n', '1', '720', '10', '1', '2', 'blue', '2019-05-01 09:37:28');
INSERT INTO `cms_content` VALUES ('13', '11111111111111111111', '4', '推荐', '111', '111', '', '111', 'admin', '11111', '<p>\r\n	1111111111111111111111111111</p>\r\n', '1', '31', '0', '0', '0', '0', '2019-05-01 10:52:28');
INSERT INTO `cms_content` VALUES ('14', '长和隐瞒577亿港元债务？李嘉诚公司被机构沽空', '13', '无属性', '债务,李嘉诚', '李嘉诚公司被机构沽空,长和隐瞒577亿', '', '网易', 'admin', '5月14日，活跃于港股及美股市场的研究机构GMT Research（以下简称GMT）向长和（00001，HK）发动了“攻击”。GMT称，长和近日发布的年报显示，与收购意大利电讯商Wind Tre相关的会计调整，加上2015年重组的残余影响，推动其2018财年利润增加了约132亿港元，涨幅达38%。通过将部分资产视为待售资产，长和可能隐瞒了与待售资产相关的577亿港元债务。', '<p class=\"otitle\">\r\n	（原标题：长和隐瞒577亿债务？李嘉诚公司被沽空）</p>\r\n<p>\r\n	每经记者 吴泽鹏 刘晨光 袁东</p>\r\n<p>\r\n	5月14日，活跃于港股及美股市场的研究机构<a href=\"http://quotes.money.163.com/usstock/hq/GM.html\">GM</a>T Research（以下简称GMT）向<a href=\"https://money.163.com/keywords/9/7/957f548c/1.html\" target=\"_blank\" title=\"长和\">长和</a>（00001，HK）发动了&ldquo;攻击&rdquo;。GMT称，长和近日发布的年报显示，与收购意大利电讯商Wind Tre相关的会计调整，加上2015年重组的残余影响，推动其2018财年利润增加了约132亿港元，涨幅达38%。通过将部分资产视为待<a href=\"https://money.163.com/keywords/5/2/552e8d444ea7/1.html\" target=\"_blank\" title=\"售资产\">售资产</a>，长和可能隐瞒了与待售资产相关的577亿港元债务。</p>\r\n<p>\r\n	《每日经济新闻》记者研究长和2018年年报发现，与日常所理解的&ldquo;隐瞒&rdquo;不同，在财报中，长和通过&ldquo;单独列示&rdquo;的<a href=\"https://money.163.com/keywords/8/2/8d2252a1/1.html\" target=\"_blank\" title=\"财务\">财务</a>处理，将部分银行借款从合并报表中剔除。这种方式实际上并未对债务进行隐瞒，但确实起到了降低整体负债的效果。而长和剔除的这部分负债金额为577.07亿港元，与GMT报告质疑的数据一致。</p>\r\n<p>\r\n	5月14日，长和发布澄清公告表示&ldquo;强烈否认&rdquo;。公司称，经审核财务报表是严格遵守适用香港财务报告准则的。</p>\r\n<p>\r\n	<b>577亿债务单独列示</b></p>\r\n<p>\r\n	《每日经济新闻》记者联系GMT试图获取沽空报告相关内容，但遭到拒绝，&ldquo;我们只能与订阅者讨论我们的研究报告&rdquo;。</p>\r\n<p>\r\n	2019年4月9日，长和发布了2018年年报，2018年，公司收入4532.3亿港元，税后溢利达到了467.82亿港元。记者研究公司2018年年报发现，GMT沽空报告所指的&ldquo;隐瞒与待售资产相关的577亿港元债务&rdquo;，或与长和精简基建投资有关。</p>\r\n<p>\r\n	上市公司年报披露，集团与子公司<a href=\"http://quotes.money.163.com/hkstock/01038.html\">长江基建集团</a>有限公司共同持有六项基建投资。2018年12月20日，公司董事会通过精简基建投资的计划。根据该计划，长和将终止对部分基建投资的控制。</p>\r\n<p>\r\n	在此情况下，长和在制作合并财务报表时，将这六项基建投资重新分类为&ldquo;持作待售之出售组别&rdquo;，即单独列示出来，且与普通的财务报表一致，&ldquo;持作待售之出售组别&rdquo;项目中也分为负债及资产。</p>\r\n<p>\r\n	据长和披露，在该组别中，&ldquo;负债&rdquo;项目包含&ldquo;银行及其他债务&rdquo;科目，这一科目金额为577.07亿港元，与沽空机构质疑的金额一致。</p>\r\n<p>\r\n	实 际上，长和在年报中并未刻意隐瞒上述变动。在解释财年内债务净额变动时，长和便指出，截至2018年年底，公司综合债务净额为2079.65亿港元，较年 初增加26%，主要由于派付股息、赎回若干永久资本证券、资本开支及投资费用等。长和同时指出，此前在合并报表中列示的上述基建资产中的债务净额被重新分 类至&ldquo;持作待售之出售组别&rdquo;内。</p>\r\n<p>\r\n	不过，记者计算发现，长和调整的577.07亿港元负债，占财报披露债务净额的27.75%，占比较大。</p>\r\n<p>\r\n	<b>收购带来较大收益</b></p>\r\n<p>\r\n	GMT沽空报告称，收购意大利电讯商Wind Tre相关的会计调整，加上2015年重组的残余影响，推动长和2018财年利润增加约132亿港元（38%）。这些非现金调整解释了为何长和的经营现金流滞后于现金利润，以及为何资本支出始终超过折旧及摊销。</p>\r\n<p>\r\n	实际上，长和在年报中对此均有披露。2018年年报指出，2018年9月收购Wind Tre余下50%权益带来的新增利润，均令盈利及现金流有所增长。</p>\r\n<p>\r\n	根据长和年报，2018年全年实现收益总额4532.30亿港元，同比增长9%；普通股股东应占纯利390亿港元，同比增长11%；每股盈利10.11港元，拟派末期股息每股2.3港元，全年股息每股达3.17港元。</p>\r\n<p>\r\n	长和表示，在其电讯部门实现的收益中，3集团在欧洲的业务（长和年报披露统称为欧洲3集团）收益为784.11亿港元，较去年增长11%，其中的主要原因为2018年9月收购Wind Tre余下50%权益带来的新增利润。</p>\r\n<p>\r\n	《每日经济新闻》记者查询发现，Wind Tre是2016年由VimpelCom旗下的Wind电信与长和旗下的3 Italia合并而成，公司主要在意大利经营业务，是意大利电讯市场最大的<a href=\"http://quotes.money.163.com/hkstock/08266.html\">流动电讯</a>营运商。此前，长和持有其一半股权。2018年7月，长和宣布以24.5亿欧元（约合190.51亿元人民币）的价格，收购剩余的50%股份。</p>\r\n<p>\r\n	沽空报告指出，推测长和通过这种激进的会计方法，以获取廉价的信贷以及更高的市场评级。</p>\r\n<p>\r\n	值 得注意的是，5月14日，长和发布澄清公告表示&ldquo;强烈否认&rdquo;。公司称，经审核财务报表是严格遵守适用香港财务报告准则的。与导言所提述集团呈报盈利有关的 事宜均已按照适用会计准则在集团之经审核财务报表作出全面透明披露。至于沽空报告提述与待售资产相关之债务并无综合入账的事宜，此亦同样全面按照适用会计 准则之要求，并已与信贷评级机构讨论。</p>\r\n<p>\r\n	长和认为，导言显现选择性、带有偏见且严重误导。其仅指出非现金盈利项目，惟未有提述均按照适用报告准则亦有于相关期间呈报之非现金亏损。其提述并无于长和2018年财务报表综合入账的债务，只是未有提述因期内收购活动而在资产负债表录得的债务。</p>\r\n', '1', '5', '0', '0', '0', '0', '2019-05-16 14:10:06');
INSERT INTO `cms_content` VALUES ('15', '巴菲特索罗斯最新持仓曝光：有一位“按兵不动”', '14', '头条,推荐', '持仓,巴菲特', '股神,巴菲特和索罗斯', '', '网易', 'admin', '同是“股神”的巴菲特和索罗斯，一季度持仓变动却大不相同，一位“按兵不动”，一位则频频调仓。', '<p class=\"otitle\">\r\n	（原标题：巴菲特索罗斯最新持仓曝光：一位&ldquo;按兵不动&rdquo;，一位快速交易。多数对冲基金&ldquo;踏空&rdquo;科技股反弹行情）</p>\r\n<p>\r\n	同是&ldquo;股神&rdquo;的<a href=\"https://money.163.com/keywords/5/f/5df483f27279/1.html\" target=\"_blank\" title=\"巴菲特\">巴菲特</a>和索罗斯，一季度持仓变动却大不相同，一位&ldquo;按兵不动&rdquo;，一位则频频调仓。</p>\r\n<p>\r\n	5月15日，<a href=\"https://money.163.com/keywords/7/8/7f8e80a1/1.html\" target=\"_blank\" title=\"美股\">美股</a>市场上机构投资者2019年第一季度持仓报告全部出炉。</p>\r\n<p>\r\n	根据美国证监会(SEC)规定，管理资产规模超过1亿美元的基金经理必须在每个季度结束后的45天内提交一份13F文件，以披露股票，债券方面的持仓情况。13F持仓变动通常揭露基金经理对个股的最新看法和动向，对市场具有较大的引导意义。</p>\r\n<p>\r\n	持仓数据显示，受恐慌心理影响，<a href=\"https://money.163.com/keywords/7/d/79d1628080a1/1.html\" target=\"_blank\" title=\"科技股\">科技股</a>自2018年第四季度成为被机构抛售的主要对象，抛售浪潮一直延续到了2019年第一季度。然而今年一季度科技股出现大举反弹，并推动美股再度走高，大部分对冲基金均踏空了这轮科技股行情。</p>\r\n<p>\r\n	在这方面，&ldquo;股神&rdquo;巴菲特仍然值得投资者学习，即使在市场波动期，其并未就重仓品种进行调仓换股。</p>\r\n<p>\r\n	<b>巴菲特：一季度开仓亚马逊</b></p>\r\n<p>\r\n	巴菲特旗下伯克希尔哈撒韦公司披露的13F持仓报告显示，截至2019年3月31日，其在美股市场上的持仓市值为1994.8亿美元，较前一季度增加164.2亿美元。</p>\r\n<p>\r\n	伯克希尔在2018年第四季度曾大举减持科技板块，但2019年第一季度却重新增持该板块，伯克希尔还对前一季度增持的耐用消费板块进行了减持。</p>\r\n<p>\r\n	最引人关注的是，2019年第一季度，伯克希尔仅新建仓1只股票，就是<a href=\"http://money.163.com/baike/amazon/\" target=\"_blank\" title=\"财经人物_亚马逊\">亚马逊</a>，买入48.33万股亚马逊股份。若按照15日亚马逊的收盘价格1871.15美元计算，该持仓的金额超过9亿美元，占到亚马逊总股本的0.1%。</p>\r\n<p>\r\n	本月初，巴菲特首次披露了对亚马逊的新投资，但没有公布持仓的规模。他还表示亚马逊的投资并非其本人做出，彭博数据显示，该仓位由巴菲特麾下大将Todd Combs做出。</p>\r\n<p>\r\n	伯克希尔13F持仓报告还显示，该公司一季度增持摩根大通股份940万股、增持德尔塔航空538万股。与此同时，伯克希尔减持了富国银行、西南航空、菲利普斯66等四只股票，并对威瑞森通信实施了清仓。</p>\r\n<p>\r\n	相比前一季度（2018年第四季度），除减持富国银行、增持摩根大通外，伯克希尔的其他前十大<a href=\"https://money.163.com/keywords/9/c/91cd4ed380a1/1.html\" target=\"_blank\" title=\"重仓股\">重仓股</a>均持仓不动。其目前的前五大重仓股分别是苹果（持有2.49亿股）、美国银行（持有8.96亿股）、富国银行（持有4.09亿股）、可口可乐（持有4亿股）、美国运通（持有1.51亿股）。</p>\r\n<p>\r\n	板块方面，伯克希尔目前持仓比例最高的是金融，占比为44.6%；其次是科技，占比26.5%；第三是耐用消费品，占比15.3%。</p>\r\n<p class=\"f_center\">\r\n	<img src=\"http://cms-bucket.ws.126.net/2019/05/16/84d09facfea54a25a0c88a1454aea87c.jpeg?imageView&amp;thumbnail=550x0\" style=\"margin: 0px auto; display: block;\" /><span style=\"text-align: justify;\">来源：彭博</span></p>\r\n<p>\r\n	<b>索罗斯&ldquo;船小好调头&rdquo;</b></p>\r\n<p>\r\n	索罗斯目前以管理家族资金为主，资金量比巴菲特小很多，&ldquo;船小好调头&rdquo;。</p>\r\n<p>\r\n	截至2019年3月31日，索罗斯基金管理公司在美股市场上的持仓市值为38.99亿美元，较前一季度增加8亿美元。在板块方面，索罗斯同巴菲特一样，增持科技板块，同时减持了耐用消费品板块。</p>\r\n<p class=\"f_center\">\r\n	<img src=\"http://cms-bucket.ws.126.net/2019/05/16/928139718cf542048fd13566597003e0.jpeg?imageView&amp;thumbnail=550x0\" style=\"margin: 0px auto; display: block;\" /><span style=\"text-align: justify;\">来源：彭博</span></p>\r\n<p>\r\n	不 过在个股选择上，索罗斯却和巴菲特恰恰相反。伯克希尔刚刚开仓亚马逊，索罗斯却选择了清仓。在索罗斯一季度清仓的30只股票名单中，有三只股票都是巴菲特 青睐的品种（亚马逊、卡夫亨氏、菲利普斯66），同时索罗斯还清仓了谷歌母公司Alphabet以及多家电信运营商股票。</p>\r\n<p>\r\n	Ceridian人力资本管理控股公司、媒体公司康卡斯特是索罗斯本次新开仓的两大品种，他在一季度共新开仓36只股票以及基金。此外，索罗斯还增加了罗素Ishares基金、红帽公司等31只品种的仓位。</p>\r\n<p>\r\n	与 巴菲特&rdquo;按兵不动&ldquo;不同的是，索罗斯的操作非常快速。其重仓股在一季度增减仓幅度较大。其前五大重仓股为媒体公司LibertyC类股（持有729万 股）、美国博彩房地产投资信托VICI Properties（持有1960万股）、博彩集团凯撒娱乐（持有2480万股）、Altaba公司（持有2482万股）以及新开仓的Ceridian 人力资本管理控股公司（持有165万股）。</p>\r\n<p>\r\n	板块方面，索罗斯目前持仓比例最高的是通讯服务，占比32%；其次是金融，占比24.2%；第三是科技，占比12.6%。</p>\r\n<p>\r\n	<b>对冲基金&ldquo;卖早了&rdquo;科技股</b></p>\r\n<p>\r\n	自 2018年10月初美股市场大幅下跌之后，美股机构投资者纷纷减仓，风险性较高、前期涨幅较大的科技股成为了被对冲基金抛售的主要对象。科技股的抛售浪潮 一直延续到了2019年第一季度，前期被市场各方趋之若鹜的&ldquo;FAANG&rdquo;组合（脸书、亚马逊、苹果、奈飞、谷歌母公司Alphabet）以及科技巨头微 软都成为了被抛售的重点对象。</p>\r\n<p>\r\n	然而今年一季度，上述科技巨头均大举反弹，大部分对冲基金均吃了个&rdquo;哑巴亏&ldquo;。</p>\r\n<p>\r\n	一季度对冲基金大举抛售美股科技巨头</p>\r\n<p class=\"f_center\">\r\n	<img src=\"http://cms-bucket.ws.126.net/2019/05/16/5dfc1548b1e44961811021b8440f166d.jpeg?imageView&amp;thumbnail=550x0\" style=\"margin: 0px auto; display: block;\" /><span style=\"text-align: justify;\">来源：彭博</span></p>\r\n<p>\r\n	哈佛大学捐赠基金就成为了业界的&rdquo;笑柄&ldquo;。该基金一季度大举减持科技板块16.8%，据估算数据，其一季度美股持仓市值缩水了近17%。哈佛大学捐赠基金一季度清仓了微软，同时减仓了苹果、脸书。</p>\r\n<p>\r\n	但老虎全球管理公司（Tiger Global Management）是个例外。在该公司一季度加仓榜单中，微软、脸书、奈飞分别名列第一、二、五位。估算数据显示，老虎全球管理公司一季度美股仓位盈利超过了20%，可谓对冲基金中的大赢家。</p>\r\n<p>\r\n	<b>部分机构押宝中概股</b></p>\r\n<p>\r\n	13F持仓报告还显示，部分对冲基金一季度开始大举做多中概股，其中包括Moore Capital Management，Viking Global Investors和Appaloosa Management等多家知名基金。</p>\r\n<p>\r\n	美国对冲基金Moore Capital Management一季度开仓<a href=\"http://money.163.com/baike/alibaba/\" target=\"_blank\" title=\"财经公司_阿里巴巴\">阿里巴巴</a>，买入78万股，阿里巴巴已成为该基金第二大重仓股。该基金还开仓了<a href=\"http://money.163.com/baike/jingdong/\" target=\"_blank\" title=\"财经公司_京东\">京东</a>和携程，分别买入138万股、42.5万股。</p>\r\n<p>\r\n	Viking Global Investors一季度开仓榜单第一名则是京东，买入1155万股，京东已成为该基金第九大重仓股。</p>\r\n<div class=\"gg200x300\">\r\n	&nbsp;</div>\r\n<p>\r\n	华尔街著名对冲基金经理大卫&middot;泰珀旗下的Appaloosa Management一季度开仓榜单第二名是阿里巴巴，买入70万股，阿里巴巴已成为该基金第八大重仓股。</p>\r\n<p>\r\n	另外，一季度英国老牌投资机构Baillie Gifford、美国CAPITAL GROUP和威灵顿资产管理分别加仓阿里巴巴171.7万、731.9万、230万股。</p>\r\n<p>\r\n	京东则被D1 CAPITAL、RERICHO CAPITAL、城堡集团增持，分别加仓1411万股、333.4万股、294.5万股。</p>\r\n<p>\r\n	瑞士国家银行一季度新开仓的股票榜单中，中通快递、爱奇艺、腾讯音乐分列第五、七、八位，分别买入66.45万股、34.1万股、26.3万股。</p>\r\n', '1', '3', '0', '0', '0', '1', '2019-05-16 14:12:57');

-- ----------------------------
-- Table structure for `cms_level`
-- ----------------------------
DROP TABLE IF EXISTS `cms_level`;
CREATE TABLE `cms_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level_info` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `premission` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '//权限',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cms_level
-- ----------------------------
INSERT INTO `cms_level` VALUES ('1', '超级管理员', '管理所有栏目', '1,2,3,4,5,6,7,8,9,10,11,12,13,14');
INSERT INTO `cms_level` VALUES ('2', '普通管理员', '普通管理员普通管理员', '1,14');
INSERT INTO `cms_level` VALUES ('3', '后台游客', '后台游客', '1');
INSERT INTO `cms_level` VALUES ('5', '游客', '游客', '');

-- ----------------------------
-- Table structure for `cms_link`
-- ----------------------------
DROP TABLE IF EXISTS `cms_link`;
CREATE TABLE `cms_link` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `webname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `weburl` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `logourl` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cms_link
-- ----------------------------
INSERT INTO `cms_link` VALUES ('1', '网易新闻', 'http://news.163.com', '', '丁磊', '1', '1', '2019-05-08 20:42:34');
INSERT INTO `cms_link` VALUES ('2', '优酷视频', 'http://www.youku.com', 'images/logolink.gif', '古永锵', '2', '1', '2019-05-08 20:44:45');
INSERT INTO `cms_link` VALUES ('3', '百度搜索', 'http://www.baidu.com', '', '李彦宏', '1', '1', '2019-05-09 08:49:26');
INSERT INTO `cms_link` VALUES ('4', 'KU6视频', 'http://www.ku6.com', '', 'kuku', '1', '1', '2019-05-10 15:36:14');
INSERT INTO `cms_link` VALUES ('5', '网易新闻', 'http://news.163.com', 'images/logolink.gif', '丁磊1', '2', '1', '2019-05-10 15:38:10');

-- ----------------------------
-- Table structure for `cms_manage`
-- ----------------------------
DROP TABLE IF EXISTS `cms_manage`;
CREATE TABLE `cms_manage` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_user` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `admin_pass` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(10) NOT NULL,
  `login_count` int(10) NOT NULL,
  `last_ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0000.0000.0000.0000',
  `last_time` datetime DEFAULT NULL,
  `reg_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cms_manage
-- ----------------------------
INSERT INTO `cms_manage` VALUES ('1', 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1', '33', '127.0.0.1', '2019-05-16 11:43:30', null);
INSERT INTO `cms_manage` VALUES ('2', 'weiwei', '7c4a8d09ca3762af61e59520943dc26494f8941b', '5', '7', '127.0.0.1', '2019-05-16 11:42:23', '2019-04-07 17:10:19');

-- ----------------------------
-- Table structure for `cms_nav`
-- ----------------------------
DROP TABLE IF EXISTS `cms_nav`;
CREATE TABLE `cms_nav` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nav_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nav_info` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `pid` int(10) NOT NULL DEFAULT '0',
  `sort` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cms_nav
-- ----------------------------
INSERT INTO `cms_nav` VALUES ('1', '军事新闻', '军事新闻军事新闻军事新闻军事新闻', '0', '3');
INSERT INTO `cms_nav` VALUES ('2', '娱乐新闻', '娱乐新闻娱乐新闻娱乐新闻', '0', '2');
INSERT INTO `cms_nav` VALUES ('3', '日本军事', '日本军事日本军事日本军事', '1', '3');
INSERT INTO `cms_nav` VALUES ('4', '韩国军事', '韩国军事韩国军事韩国军事韩国军事', '1', '4');
INSERT INTO `cms_nav` VALUES ('5', '股票证券', '股票证券股票证券', '0', '1');
INSERT INTO `cms_nav` VALUES ('6', '时尚女人', '时尚女人时尚女人时尚女人时尚女人', '0', '7');
INSERT INTO `cms_nav` VALUES ('7', '科技频道', '科技频道科技频道科技频道', '0', '6');
INSERT INTO `cms_nav` VALUES ('8', '智能手机', '智能手机智能手机智能手机', '0', '8');
INSERT INTO `cms_nav` VALUES ('9', '美容护肤', '美容护肤美容护肤美容护肤', '0', '9');
INSERT INTO `cms_nav` VALUES ('10', '热门汽车', '热门汽车热门汽车热门汽车', '0', '10');
INSERT INTO `cms_nav` VALUES ('11', '房产家居', '房产家居', '0', '11');
INSERT INTO `cms_nav` VALUES ('12', '读书教育', '读书教育读书教育读书教育', '0', '12');
INSERT INTO `cms_nav` VALUES ('13', '港股', '香港股票', '5', '13');
INSERT INTO `cms_nav` VALUES ('14', '美股', '美国股票', '5', '14');

-- ----------------------------
-- Table structure for `cms_premission`
-- ----------------------------
DROP TABLE IF EXISTS `cms_premission`;
CREATE TABLE `cms_premission` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '//权限名称',
  `info` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '//描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cms_premission
-- ----------------------------
INSERT INTO `cms_premission` VALUES ('1', '后台登录', '后台登录');
INSERT INTO `cms_premission` VALUES ('2', '清理缓存', '清理缓存');
INSERT INTO `cms_premission` VALUES ('3', '管理员管理', '管理员管理');
INSERT INTO `cms_premission` VALUES ('4', '等级管理', '等级管理');
INSERT INTO `cms_premission` VALUES ('5', '权限设定', '权限设定');
INSERT INTO `cms_premission` VALUES ('6', '网站导航', '网站导航');
INSERT INTO `cms_premission` VALUES ('7', '文档操作', '文档操作');
INSERT INTO `cms_premission` VALUES ('8', '评论审核', '评论审核');
INSERT INTO `cms_premission` VALUES ('9', '轮播器管理', '轮播器管理');
INSERT INTO `cms_premission` VALUES ('10', '广告管理', '广告管理');
INSERT INTO `cms_premission` VALUES ('11', '投票管理', '投票管理');
INSERT INTO `cms_premission` VALUES ('12', '审核友情链接', '审核友情链接');
INSERT INTO `cms_premission` VALUES ('13', '会员管理', '会员管理');
INSERT INTO `cms_premission` VALUES ('14', '系统配置管理', '系统配置管理');

-- ----------------------------
-- Table structure for `cms_rotatain`
-- ----------------------------
DROP TABLE IF EXISTS `cms_rotatain`;
CREATE TABLE `cms_rotatain` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '//图片',
  `title` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '//标题',
  `info` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '//简介',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '//状态',
  `link` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '//地址',
  `date` datetime NOT NULL COMMENT '//时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cms_rotatain
-- ----------------------------
INSERT INTO `cms_rotatain` VALUES ('1', '/default1/CMS0.2/uploads/20190429/20190429162926691.jpg', '测试广告1', '测试广告1', '1', 'http://baidu.com', '2019-04-29 16:29:54');
INSERT INTO `cms_rotatain` VALUES ('2', '/default1/CMS0.2/uploads/20190429/20190429163236371.jpg', '智能门锁火了 智能窗会成为下一个行业爆1', '智能门锁火了 智能窗会成为下一个行业爆点么智能门锁火了 智能窗会成为下一个行业爆点么1', '1', '/default1/CMS0.2/details.php?id=11', '2019-04-29 16:34:27');

-- ----------------------------
-- Table structure for `cms_system`
-- ----------------------------
DROP TABLE IF EXISTS `cms_system`;
CREATE TABLE `cms_system` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `webname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `page_size` tinyint(2) NOT NULL COMMENT '//普通分页',
  `article_size` tinyint(2) NOT NULL COMMENT '//文章分页',
  `nav_size` tinyint(2) NOT NULL COMMENT '//主导航个数',
  `updir` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '//上传的主目录',
  `ro_num` tinyint(2) NOT NULL COMMENT '//轮播数',
  `adver_text_num` tinyint(2) NOT NULL COMMENT '//文字广告的个数',
  `adver_pic_num` tinyint(2) NOT NULL COMMENT '//图片广告的个数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cms_system
-- ----------------------------
INSERT INTO `cms_system` VALUES ('1', 'WEB俱乐部', '10', '8', '10', '/uploads/', '3', '5', '3');

-- ----------------------------
-- Table structure for `cms_tag`
-- ----------------------------
DROP TABLE IF EXISTS `cms_tag`;
CREATE TABLE `cms_tag` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `tagname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `count` smallint(6) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cms_tag
-- ----------------------------
INSERT INTO `cms_tag` VALUES ('1', '行业爆点', '3');
INSERT INTO `cms_tag` VALUES ('2', '智能门锁', '5');
INSERT INTO `cms_tag` VALUES ('3', '全球', '1');
INSERT INTO `cms_tag` VALUES ('4', '飞机', '8');
INSERT INTO `cms_tag` VALUES ('5', '横评', '1');
INSERT INTO `cms_tag` VALUES ('6', '无线手柄', '2');
INSERT INTO `cms_tag` VALUES ('7', '李嘉诚', '3');

-- ----------------------------
-- Table structure for `cms_user`
-- ----------------------------
DROP TABLE IF EXISTS `cms_user`;
CREATE TABLE `cms_user` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//id',
  `user` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '//用户名',
  `pass` char(40) COLLATE utf8_unicode_ci NOT NULL COMMENT '//密码',
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '//电子邮件',
  `question` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '//提问',
  `answer` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '//回答',
  `face` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `state` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '//会员状态',
  `time` char(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '//最近登录的时间',
  `date` datetime NOT NULL COMMENT '//注册时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cms_user
-- ----------------------------
INSERT INTO `cms_user` VALUES ('2', '蜡笔小新', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'labixiaoxin@qq.com', '您配偶的性别？', '女', '02.gif', '1', '1556094349', '2019-04-17 09:12:42');
INSERT INTO `cms_user` VALUES ('3', '樱桃小丸子', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'ytxwz@qq.com', '', '', '01.gif', '1', '1555636815', '2019-04-17 10:42:15');
INSERT INTO `cms_user` VALUES ('4', '威肯', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'weiken@qq.com', '您母亲的职业？', '同行', '02.gif', '1', '1557987235', '2019-04-17 10:54:21');
INSERT INTO `cms_user` VALUES ('5', '路飞', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'lufei@qq.com', '', '', '03.gif', '1', '1555636835', '2019-04-17 16:34:08');
INSERT INTO `cms_user` VALUES ('7', '圣斗士', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'sds1@qq.com', '您母亲的职业？', '333', '01.gif', '0', '', '2019-04-19 15:08:01');
INSERT INTO `cms_user` VALUES ('8', '紫龙', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'zilong@qq.com', '', '', '03.gif', '2', '', '2019-04-20 11:41:53');

-- ----------------------------
-- Table structure for `cms_vote`
-- ----------------------------
DROP TABLE IF EXISTS `cms_vote`;
CREATE TABLE `cms_vote` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `info` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `vid` mediumint(8) NOT NULL DEFAULT '0' COMMENT '//是否主题',
  `count` smallint(6) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of cms_vote
-- ----------------------------
INSERT INTO `cms_vote` VALUES ('1', '您是怎么知道本网站的', '您是怎么知道本网站的您是怎么知道本网站的', '0', '0', '1', '2019-05-06 11:10:32');
INSERT INTO `cms_vote` VALUES ('3', '从网上知道的', '从网上知道的', '1', '30', '0', '2019-05-06 14:36:46');
INSERT INTO `cms_vote` VALUES ('4', '短信推广看到', '短信推广看到', '1', '11', '0', '2019-05-06 17:14:32');
INSERT INTO `cms_vote` VALUES ('5', 'QQ群里知道的', 'QQ群里知道的QQ群里知道的QQ群里知道的', '1', '20', '0', '2019-05-07 14:21:34');
INSERT INTO `cms_vote` VALUES ('11', '您最喜欢的男歌手是谁？', '您最喜欢的男歌手是谁？', '0', '0', '0', '2019-05-07 15:26:22');
INSERT INTO `cms_vote` VALUES ('12', '您最喜欢的运动是哪项？', '您最喜欢的运动是哪项？', '0', '0', '0', '2019-05-07 15:26:42');
INSERT INTO `cms_vote` VALUES ('13', '听别人说的', '听别人说的听别人说的', '1', '4', '0', '2019-05-08 10:49:44');
