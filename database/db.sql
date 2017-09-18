CREATE TABLE `administrator` (
  `id` int(11) NOT NULL COMMENT '自增id' AUTO_INCREMENT PRIMARY KEY,
  `parentId` int(11) NULL COMMENT '上级id',
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `department` varchar(100) NULL COMMENT '部门',
  `position` varchar(100) NULL COMMENT '职位',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已删除',
  `createdTimestamp` int(11) NOT NULL COMMENT '创建时间',
  `lastLoginTimestamp` int(11) DEFAULT NULL COMMENT '最后一次登陆时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 表的结构 `distributor`
--

CREATE TABLE `distributor` (
  `id` int(11) NOT NULL COMMENT '自增id',
  `incharge` varchar(100) DEFAULT NULL COMMENT '负责人',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机号码',
  `coverImage` varchar(100) DEFAULT NULL COMMENT '封面照片',
  `logo` varchar(100) DEFAULT NULL COMMENT '商标',
  `name` varchar(100) DEFAULT NULL COMMENT '供应商名称',
  `description` text COMMENT '描述',
  `content` text COMMENT '内容',
  `qrCode` varchar(100) DEFAULT NULL COMMENT '二维码',
  `address` text COMMENT '地址',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已删除',
  `creatorId` int(11) NOT NULL COMMENT '创建人id',
  `createdTimestamp` int(11) NOT NULL COMMENT '创建时间',
  `lastEditorId` int(11) DEFAULT NULL COMMENT '最后一次修改者id',
  `lastEditedTimestamp` int(11) DEFAULT NULL COMMENT '最后一次修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `distributor`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `distributor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id';

CREATE TABLE `news` (
  `id` int(11) NOT NULL COMMENT '自增id' AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(100) NOT NULL COMMENT '标题',
  `coverImage` varchar(100) NULL COMMENT '封面照片',
  `description` text NULL COMMENT '简介',
  `content` text NULL COMMENT '内容',
  `hits` int(11) NULL COMMENT '点击量',
  `publishedTimestamp` int(11) NOT NULL COMMENT '发布日期',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已删除',
  `creatorId` int(11) NOT NULL COMMENT '创建人id',
  `createdTimestamp` int(11) NOT NULL COMMENT '创建时间',
  `lastEditorId` int(11) NULL COMMENT '最后一次修改者id',
  `lastEditedTimestamp` int(11) DEFAULT NULL COMMENT '最后一次修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `news` ADD `orderNumber` INT(11) NOT NULL COMMENT '排序' AFTER `publishedTimestamp`, ADD `isRecommended` TINYINT(1) NOT NULL COMMENT '推荐' AFTER `orderNumber`;
ALTER TABLE `news` CHANGE `isRecommended` `isRecommended` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '推荐';

CREATE TABLE `introduction` (
  `id` int(11) NOT NULL COMMENT '自增id' AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(100) NOT NULL COMMENT '标题',
  `image` varchar(100) NULL COMMENT '封面照片',
  `description` text NULL COMMENT '简介',
  `content` text NULL COMMENT '内容',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已删除',
  `creatorId` int(11) NOT NULL COMMENT '创建人id',
  `createdTimestamp` int(11) NOT NULL COMMENT '创建时间',
  `lastEditorId` int(11) NULL COMMENT '最后一次修改者id',
  `lastEditedTimestamp` int(11) DEFAULT NULL COMMENT '最后一次修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `scenicview` (
  `id` int(11) NOT NULL COMMENT '自增id' AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(100) NOT NULL COMMENT '标题',
  `coverImage` varchar(100) NULL COMMENT '封面照片',
  `description` text NULL COMMENT '简介',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已删除',
  `creatorId` int(11) NOT NULL COMMENT '创建人id',
  `createdTimestamp` int(11) NOT NULL COMMENT '创建时间',
  `lastEditorId` int(11) NULL COMMENT '最后一次修改者id',
  `lastEditedTimestamp` int(11) DEFAULT NULL COMMENT '最后一次修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `scenicview` ADD `orderNumber` INT(11) NOT NULL DEFAULT NULL COMMENT '排序' AFTER `description`;
ALTER TABLE `scenicview` ADD `isRecommended` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '推荐' AFTER `orderNumber`;

CREATE TABLE `scenicviewimage` (
  `id` int(11) NOT NULL COMMENT '外键scenicviewId' PRIMARY KEY,
  `description` text NULL COMMENT '标题',
  `image` varchar(100) NOT NULL COMMENT '照片'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `scenicviewimage` CHANGE `image` `image` VARCHAR(100) NULL COMMENT '照片';
ALTER TABLE `scenicviewimage` ADD `scenicViewId` INT(11) NOT NULL COMMENT 'scenicView外键' AFTER `id`;
ALTER TABLE `scenicviewimage` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `scenicarea` (
  `id` int(11) NOT NULL COMMENT '自增id' AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(100) NOT NULL COMMENT '标题',
  `coverImage` varchar(100) NULL COMMENT '封面照片',
  `description` text NULL COMMENT '简介',
  `orderNumber` int(11) NOT NULL COMMENT '排序',
  `isRecommended` tinyint(1) NOT NULL DEFAULT '0' COMMENT '推荐',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已删除',
  `creatorId` int(11) NOT NULL COMMENT '创建人id',
  `createdTimestamp` int(11) NOT NULL COMMENT '创建时间',
  `lastEditorId` int(11) NULL COMMENT '最后一次修改者id',
  `lastEditedTimestamp` int(11) DEFAULT NULL COMMENT '最后一次修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `scenicareaimage` (
  `id` int(11) NOT NULL COMMENT '外键scenicareaId' PRIMARY KEY,
  `image` varchar(100) NOT NULL COMMENT '照片'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `scenicareaimage` CHANGE `image` `image` VARCHAR(100) NULL DEFAULT NULL COMMENT '照片';
ALTER TABLE `scenicareaimage` ADD `scenicAreaId` INT(11) NOT NULL COMMENT 'scenicArea外键' AFTER `id`;
ALTER TABLE `scenicareaimage` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `food` (
  `id` int(11) NOT NULL COMMENT '自增id' AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(100) NOT NULL COMMENT '标题',
  `coverImage` varchar(100) NULL COMMENT '封面照片',
  `description` text NULL COMMENT '简介',
  `content` text NULL COMMENT '内容',
  `orderNumber` int(11) NOT NULL COMMENT '排序',
  `isRecommended` tinyint(1) NOT NULL DEFAULT '0' COMMENT '推荐',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已删除',
  `creatorId` int(11) NOT NULL COMMENT '创建人id',
  `createdTimestamp` int(11) NOT NULL COMMENT '创建时间',
  `lastEditorId` int(11) NULL COMMENT '最后一次修改者id',
  `lastEditedTimestamp` int(11) DEFAULT NULL COMMENT '最后一次修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `member` (
  `id` int(11) NOT NULL COMMENT '自增id' AUTO_INCREMENT PRIMARY KEY,
  `sourceType` smallint(6) NOT NULL COMMENT '来源',
  `uid` int(11) NULL COMMENT '第三方id',
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `email` varchar(100) NULL COMMENT '邮件',
  `mobile` varchar(20) NULL COMMENT '电话',
  `password` varchar(100) NULL COMMENT '密码',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已删除',
  `createdTimestamp` int(11) NOT NULL COMMENT '创建时间',
  `lastLoginTimestamp` int(11) DEFAULT NULL COMMENT '最后一次登陆时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `member` CHANGE `uid` `uid` VARCHAR(100) NULL DEFAULT NULL COMMENT '第三方id';

CREATE TABLE `jotting` (
  `id` int(11) NOT NULL COMMENT '自增id' AUTO_INCREMENT PRIMARY KEY,
  `memberId` int(11) NOT NULL COMMENT '会员id',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `content` mediumtext NOT NULL COMMENT '内容',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已删除',
  `creatorId` int(11) NOT NULL COMMENT '创建者id',
  `createdTimestamp` int(11) NOT NULL COMMENT '创建时间',
  `lastEditorId` int(11) DEFAULT NULL COMMENT '最后一次修改者id',
  `lastEditedTimestamp` int(11) DEFAULT NULL COMMENT '最后一次修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `jotting` ADD `hits` INT(11) NOT NULL DEFAULT '0' COMMENT '随笔点击量' AFTER `content`;

CREATE TABLE `jottingimage` (
  `id` int(11) NOT NULL COMMENT '自增id' AUTO_INCREMENT PRIMARY KEY,
  `jottingId` int(11) NOT NULL COMMENT '表jotting外键',
  `image` varchar(100) NOT NULL COMMENT '照片'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `comment` (
  `id` int(11) NOT NULL COMMENT '自增id' AUTO_INCREMENT PRIMARY KEY,
  `jottingId` int(11) NOT NULL COMMENT '随记id',
  `creatorMemberId` int(11) NOT NULL COMMENT '创建者id',
  `receiverMemberId` int(11) NULL COMMENT '接收者id',
  `content` mediumtext NOT NULL COMMENT '内容',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已删除',
  `createdTimestamp` int(11) NOT NULL COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `comment` ADD `commentId` INT(11) NULL DEFAULT NULL COMMENT '评论id' AFTER `jottingId`;

CREATE TABLE `website` (
  `id` int(11) NOT NULL COMMENT '自增id' PRIMARY KEY,
  `title` varchar(100) NULL COMMENT '标题',
  `content` mediumtext NULL COMMENT '内容',
  `backgroundImage` varchar(100) NULL COMMENT '背景图片',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态',
  `lastEditorId` int(11) DEFAULT NULL COMMENT '最后一次修改者id',
  `lastEditedTimestamp` int(11) DEFAULT NULL COMMENT '最后一次修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `accommodationCategory` (
  `id` int(11) NOT NULL COMMENT '自增id' AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(100) NOT NULL COMMENT '类别名称',
  `description`text NULL COMMENT '描述',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已删除',
  `creatorId` int(11) NOT NULL COMMENT '创建者id',
  `createdTimestamp` int(11) NOT NULL COMMENT '创建时间',
  `lastEditorId` int(11) NULL COMMENT '最后一次更改者id',
  `lastEditedTimestamp` int(11) DEFAULT NULL COMMENT '最后一次登陆时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `accommodation` (
  `id` int(11) NOT NULL COMMENT '自增id' AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(100) NOT NULL COMMENT '名称',
  `description`text NULL COMMENT '描述',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已删除',
  `creatorId` int(11) NOT NULL COMMENT '创建者id',
  `createdTimestamp` int(11) NOT NULL COMMENT '创建时间',
  `lastEditorId` int(11) NULL COMMENT '最后一次更改者id',
  `lastEditedTimestamp` int(11) DEFAULT NULL COMMENT '最后一次登陆时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `accommodation` ADD `accommodationCategoryId` INT(11) NOT NULL COMMENT '住在瑶琳类别id' AFTER `id`;

CREATE TABLE `accommodationimage` (
  `id` int(11) NOT NULL COMMENT '自增id' AUTO_INCREMENT PRIMARY KEY,
  `accommodationId` int(11) NOT NULL COMMENT '表accommodation外键',
  `image` varchar(100) NOT NULL COMMENT '照片'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `accommodationcategoryimage` (
  `id` int(11) NOT NULL COMMENT '自增id' AUTO_INCREMENT PRIMARY KEY,
  `accommodationCategoryId` int(11) NOT NULL COMMENT '表accommodationcategory外键',
  `text` varchar(100) NOT NULL COMMENT '文字',
  `image` varchar(100) NOT NULL COMMENT '照片'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
