CREATE TABLE `kw_device_config` (
  `config_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '審核編號',
  `config_uid` mediumint(9) unsigned NOT NULL COMMENT '審核者',
  `config_title` varchar(255) NOT NULL DEFAULT '' COMMENT '審核職稱',
  `config_sort` tinyint(3) unsigned NOT NULL COMMENT '審核順序',
  `config_isenable` enum('1','0') NOT NULL DEFAULT '1' COMMENT '是否啟用',
  PRIMARY KEY (`config_id`),
  UNIQUE KEY (`config_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `kw_device_cate` (
  `cate_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '類型編號',
  `cate_title` varchar(255) NOT NULL DEFAULT '' COMMENT '類型標題',
  `cate_sort` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '類型排序',
  `cate_isenable` enum('1','0') NOT NULL DEFAULT '1' COMMENT '狀態',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `kw_device_cate` (`cate_id`, `cate_title`, `cate_sort`, `cate_isenable`) VALUES
(1,	'筆電',	1,	'1'),
(2,	'平板',	2,	'1'),
(3,	'相機',	3,	'1'),
(4,	'攝影機',4,	'1'),
(5,	'腳架',	5,	'0'),
(6,	'單槍',	6,	'0');

CREATE TABLE `kw_device_place` (
  `place_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '地點編號',
  `place_title` varchar(255) NOT NULL DEFAULT '' COMMENT '地點標題',
  `place_sort` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '地點排序',
  `place_isenable` enum('1','0') NOT NULL DEFAULT '1' COMMENT '狀態',
  PRIMARY KEY (`place_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `kw_device_place` (`place_id`, `place_title`, `place_sort`, `place_isenable`) VALUES
(1,	'設備室',	1,	'1'),
(2,	'總務處',	2,	'1'),
(3,	'教務處',	3,	'1');


CREATE TABLE `kw_device_equ` (
  `equ_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '設備編號',
  `equ_code` varchar(20) NOT NULL DEFAULT '' COMMENT '設備編碼',
  `equ_year` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '採購年度',
  `cate_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '設備類型',
  `place_id` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '保管地點',
  `config_uid` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '審核者',
  `equ_title` varchar(255) NOT NULL DEFAULT '' COMMENT '設備名稱',
  `equ_note` varchar(255) NOT NULL COMMENT '設備描述注意事項',
  `equ_number` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '設備數量',
  `equ_available` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '可借數量',
  `equ_count` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '借用次數',
  `equ_isenable` enum('1','0') NOT NULL DEFAULT '1' COMMENT '是否開放借用',
  `equ_date` date NOT NULL COMMENT '新增日期',
  `equ_sort` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`equ_id`),
  UNIQUE KEY (`equ_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `kw_device_book` (
  `book_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '借用編號',
  `book_uid` mediumint(9) unsigned NOT NULL COMMENT '借用者id',
  `equ_id` smallint(6) unsigned NOT NULL COMMENT '設備id',
  `config_uid` smallint(6) unsigned NOT NULL COMMENT '審核uid',
  `book_number` smallint(6) unsigned NOT NULL COMMENT '借用數量',
  `book_desc` varchar(255) NOT NULL DEFAULT '' COMMENT '用途說明',
  `book_mode` varchar(20) NOT NULL DEFAULT '' COMMENT '借用模式',
  `book_time_start` date NOT NULL COMMENT '起始日期',
  `book_time_end` date NOT NULL COMMENT '歸還日期',
  `book_ischecked` enum('1','0') NOT NULL DEFAULT '0' COMMENT '是否審核完成',
  `book_isdeny` enum('1','0') NOT NULL DEFAULT '0' COMMENT '是否拒絕審核',
  `book_istaken` enum('1','0') NOT NULL DEFAULT '0' COMMENT '是否領取設備',
  `book_isreturn` enum('1','0') NOT NULL DEFAULT '0' COMMENT '是否歸還',
  `book_islate` enum('1','0') NOT NULL DEFAULT '0' COMMENT '是否逾期',
  `book_isfinish` enum('1','0') NOT NULL DEFAULT '0' COMMENT '是否完成借用',
  `book_isenable` enum('1','0') NOT NULL DEFAULT '1' COMMENT '申請狀態',
  `book_year` smallint(6) unsigned NOT NULL COMMENT '借用學年',
  `book_time` datetime NOT NULL COMMENT '登記時間',
  `book_checknote` varchar(255) NULL DEFAULT '' COMMENT '審核說明',
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

