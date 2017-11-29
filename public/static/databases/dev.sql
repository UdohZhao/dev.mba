# 后台用户表
CREATE TABLE `admin_user`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '后台用户表主键id',
  `username` VARCHAR(25) NOT NULL COMMENT '用户名',
  `password` VARCHAR(32) NOT NULL COMMENT '密码',
  `type` TINYINT(1) UNSIGNED NOT NULL COMMENT '类型{0>超级管理员，1>普通管理员}',
  `status` TINYINT(1) UNSIGNED NOT NULL COMMENT '状态{0>正常，1>冻结}',
  `ctime` INT(10) UNSIGNED NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

# 后台用户权限表
CREATE TABLE `permissions`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '后台用户权限表主键id',
  `auid` INT(11) UNSIGNED NOT NULL COMMENT '关联后台用户表主键id',
  `pid` INT(11) UNSIGNED NOT NULL COMMENT '关联栏目表主键id',
  PRIMARY KEY (`id`),
  KEY (`auid`),
  KEY (`pid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

# 栏目表
CREATE TABLE `programa`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '栏目表主键id',
  `pid` INT(11) UNSIGNED NOT NULL COMMENT '父级id，0为顶级',
  `ctime` INT(10) UNSIGNED NOT NULL COMMENT '时间',
  `type` TINYINT(2) UNSIGNED NOT NULL COMMENT '0>招生，1>院校，2>考试，3>热点关注，4>招考公告，5>活动预告，6>院校推荐',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

# 栏目文章表
CREATE TABLE `programa_article`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '栏目文章表主键id',
  `auid` INT(11) UNSIGNED NOT NULL COMMENT '关联后台用户表主键id',
  `pid` INT(11) UNSIGNED NOT NULL COMMENT '关联栏目表主键id',
  `title` VARCHAR(255) NOT NULL COMMENT '标题',
  `tips` VARCHAR(255) NOT NULL COMMENT '小贴士',
  `search_keywords` VARCHAR(255) NOT NULL COMMENT '搜索关键词',
  `content` VARCHAR(30000) NOT NULL COMMENT '内容',
  `type` TINYINT(1) UNSIGNED NOT NULL COMMENT '类型{0>正常，1>置顶}',
  `status` TINYINT(1) UNSIGNED NOT NULL COMMENT '状态{0>展示，1>隐藏}',
  `ctime` INT(10) UNSIGNED NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`),
  KEY (`auid`),
  KEY (`pid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Banner表
CREATE TABLE `banner`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'banner表主键id',
  `img_path` VARCHAR(255) NOT NULL COMMENT '图片路径',
  `img_link` VARCHAR(255) NOT NULL COMMENT '链接地址',
  `sort` TINYINT(1) UNSIGNED NOT NULL COMMENT '状态{0>展示，1>隐藏}',
  `ctime` INT(10) UNSIGNED NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

# 二维码表
CREATE TABLE `qr_code`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '二维码表主键id',
  `img_path` VARCHAR(255) NOT NULL COMMENT '图片路径',
  `type` TINYINT(1) UNSIGNED NOT NULL COMMENT '类型{0>手机二维码，1>公众号二维码}',
  `ctime` INT(10) UNSIGNED NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

# 活动预告图片广告表
CREATE TABLE `ad_foreshow`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '活动预告图片广告表主键id',
  `img_path` VARCHAR(255) NOT NULL COMMENT '图片路径',
  `img_link` VARCHAR(255) NOT NULL COMMENT '链接地址',
  `status` TINYINT(1) UNSIGNED NOT NULL COMMENT '状态{0>展示,1>隐藏}',
  `ctime` INT(10) UNSIGNED NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

# 资讯热线图片广告表
CREATE TABLE `ad_information`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '资讯热线图片广告表主键id',
  `img_path` VARCHAR(255) NOT NULL COMMENT '图片路径',
  `ctime` INT(10) UNSIGNED NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

# 图片广告表
CREATE TABLE `ad_images`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '图片广告表主键id',
  `img_path` VARCHAR(255) NOT NULL COMMENT '图片路径',
  `img_link` VARCHAR(255) NOT NULL COMMENT '链接地址',
  `sort` TINYINT(3) UNSIGNED NOT NULL COMMENT '排序，数字越小越靠前',
  `type` TINYINT(1) UNSIGNED NOT NULL COMMENT '类型{0>院校发布上方，1>考试资讯上方}',
  `ctime` INT(10) UNSIGNED NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

# 合作伙伴图片广告表
CREATE TABLE `ad_partner`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '合作伙伴图片广告表主键id',
  `img_path` VARCHAR(255) NOT NULL COMMENT '图片路径',
  `img_link` VARCHAR(255) NOT NULL COMMENT '链接地址',
  `sort` TINYINT(3) UNSIGNED NOT NULL COMMENT '排序，数字越小越靠前',
  `type` TINYINT(1) UNSIGNED NOT NULL COMMENT '类型{0>展示，1>隐藏}',
  `ctime` INT(10) UNSIGNED NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

# 友情链接表
CREATE TABLE `blogroll`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '友情链接表主键id',
  `cname` VARCHAR(255) NOT NULL COMMENT '名称',
  `cname_link` VARCHAR(255) NOT NULL COMMENT '链接地址',
  `sort` TINYINT(3) UNSIGNED NOT NULL COMMENT '排序，数字越小越靠前',
  `status` TINYINT(1) UNSIGNED NOT NULL COMMENT '状态{0>展示，1>隐藏}',
  `ctime` INT(10) UNSIGNED NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

# 底部信息表
CREATE TABLE `webstat`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '底部信息表主键id',
  `content` VARCHAR(30000) NOT NULL COMMENT '内容',
  `ctime` INT(10) UNSIGNED NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

# 关于我们表
CREATE TABLE `about_us`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '关于我们表主键id',
  `title` VARCHAR(255) NOT NULL COMMENT '标题',
  `content` VARCHAR(30000) NOT NULL COMMENT '内容',
  `ctime` INT(10) UNSIGNED NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

# 站点表
CREATE TABLE `website`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '站点表主键id',
  `logo_path` VARCHAR(255) NOT NULL COMMENT 'Logo图片路径',
  `service_qq` VARCHAR(25) NOT NULL COMMENT '客服QQ',
  `service_tel` VARCHAR(25) NOT NULL COMMENT '客服电话',
  `describe` VARCHAR(255) NOT NULL COMMENT '网站描述',
  `search_keywords` VARCHAR(255) NOT NULL COMMENT '网站搜索关键词',
  `status` TINYINT(1) UNSIGNED NOT NULL COMMENT '状态{0>启动站点，1>关闭站点}',
  `ctime` INT(10) UNSIGNED NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

# 站点访问量表
CREATE TABLE `website_pv`(
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '站点访问量表主键id',
  `pv` INT(11) UNSIGNED NOT NULL COMMENT '访问量',
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;



