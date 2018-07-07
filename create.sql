

CREATE TABLE `wd_rescue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL  COMMENT '用户id',
  `target_money` varchar(255) NOT NULL DEFAULT ''  COMMENT '目标金额',
  `title` varchar(250) NOT NULL DEFAULT '' COMMENT '筹款标题',
  `summary` text NOT NULL DEFAULT '' COMMENT '求助内容',
  `money_repository` text NOT NULL DEFAULT '' COMMENT '已筹金额',
  `status` tinyint(4) unsigned NOT NULL  DEFAULT '0' COMMENT '0代表未填写完毕，1代表未通过组织机构认证，2代表未通过审核，3代表筹款中，4代表已结束',
  `is_top` boolean NOT NULL  DEFAULT false COMMENT '是否置顶',
  `personal_img` varchar(255)    DEFAULT '' COMMENT '上传的图片，逗号分割，最多8张。',
  `me_id` varchar(255)  NOT NULL   DEFAULT '' COMMENT '个人身份证号',
  `me_tel` varchar(255)  NOT NULL DEFAULT '' COMMENT '个人联系电话',
  `me_email` varchar(255)  NOT NULL DEFAULT '' COMMENT '个人电子邮箱',
  `me_bank` varchar(255)  NOT NULL DEFAULT '' COMMENT '个人银行卡号',
  `tag` varchar(255)   DEFAULT '' COMMENT 'tag id',
  `family_id` varchar(255)   DEFAULT '' COMMENT '家人身份证号',
  `family_tel` varchar(255)   DEFAULT '' COMMENT '家人联系电话',
  `organization` varchar(255)   DEFAULT '' COMMENT '组织机构认证，id 逗号分割',
  `committee` varchar(255)   DEFAULT '' COMMENT '委员会人员职位',
  `company_img` varchar(255)   DEFAULT '' COMMENT '上传机构证明图片,逗号分割',
  `recommend` char(1)   DEFAULT '0' COMMENT '是否推荐,1是，0不是',
  `money_is_use` char(1)   DEFAULT '0' COMMENT '项目资金是否已使用,1是，0不是',
  `is_success` char(1)   DEFAULT '0' COMMENT '是否是成功案例，1是 0不是',
  `create_date` int(11)    COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;


--梦想清单
CREATE TABLE `wd_dream` (
  `id` int(11)  NOT NULL AUTO_INCREMENT,
  `user_id` int(11)    COMMENT '用户id', 
  `target_money` varchar(255) NOT NULL DEFAULT ''  COMMENT '目标金额',
  `money_purpose` varchar(2550) NOT NULL DEFAULT ''  COMMENT '资金用途',
  `type` int(11)  DEFAULT ''  COMMENT '项目类型id', 
  `status` tinyint(4) unsigned NOT NULL  DEFAULT '0' COMMENT '2代表隐藏 3代表筹款中，4代表已结束',
  `title` varchar(255)  DEFAULT ''  COMMENT '标题', 
  `return_money` varchar(255)  DEFAULT ''  COMMENT '回报金额', 
  `return_content` varchar(2550)  DEFAULT ''  COMMENT '回报内容', 
  `summary` text()  DEFAULT ''  COMMENT '摘要', 
  `is_top` boolean NOT NULL  DEFAULT false COMMENT '是否置顶',
  `img` varchar(255)    DEFAULT '' COMMENT '上传的图片，逗号分割，最多8张。',
  `money_is_use` char(1)   DEFAULT '0' COMMENT '项目资金是否已使用,1是，0不是',
  `date` int(11)    COMMENT '时间', 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--梦想清单顶部类型
CREATE TABLE `wd_dream_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255)  DEFAULT ''  COMMENT '名称', 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;



--轻松互助 用户表
CREATE TABLE `wd_mutual_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(5)    COMMENT '用户id', 
  `auth_name` varchar(50)  DEFAULT ''  COMMENT '姓名', 
  `auth_id` varchar(255)  DEFAULT ''  COMMENT '身份证号', 
  `mutual_id` varchar(255)  DEFAULT ''  COMMENT '所加入的互助id', 
  `price` varchar(255)  DEFAULT ''  COMMENT '金额',
  `status` char(1)  DEFAULT '0'  COMMENT '0代表未付款  1代表已付款',
  `create_date` int(11)    COMMENT 'date',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;




--家人互助
CREATE TABLE `wd_home_mutual` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255)    COMMENT '标题', 
  `img` varchar(255)    COMMENT '图片', 
  `list_tagone` varchar(255)  DEFAULT ''  COMMENT '列表简短介绍', 
  `list_tagtwo` varchar(255) DEFAULT ''   COMMENT '列表年龄段介绍', 
  `apply_condition` text    COMMENT '申请条件', 
  `detail` text    COMMENT '详细信息', 
  `price` text    COMMENT '价钱', 
  `create_date` int(11)   COMMENT '发布时间', 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;













--举报
CREATE TABLE `wd_report` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` char(1)  DEFAULT ''  COMMENT '捐款类型，1代表筹款救助，2代表梦想清单,3代表轻松公益', 
  `item_id` varchar(255)  DEFAULT ''  COMMENT '项目id', 
  `user_id` varchar(255)  DEFAULT ''  COMMENT '用户id', 
  `auth_name` varchar(255)  DEFAULT ''  COMMENT '姓名', 
  `auth_id` varchar(255)  DEFAULT ''  COMMENT '身份证号', 
  `content` varchar(255)  DEFAULT ''  COMMENT '举报理由', 
  `img` varchar(255)  DEFAULT ''  COMMENT '图片id组', 
  `remark` varchar(255)  DEFAULT ''  COMMENT '备注', 
  `date` varchar(255)  DEFAULT ''  COMMENT '时间', 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;




--图片
CREATE TABLE `wd_images` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL DEFAULT ''  ,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;


--标签
CREATE TABLE `wd_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT ''  ,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;





--关注
CREATE TABLE `wd_follow` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11)     COMMENT '用户id',
  `item_id` int(11)     COMMENT '项目id',
  `type` int(11)     COMMENT '1代表筹款救助，2代表梦想清单',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;



--配置文件表
CREATE TABLE `wd_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL COMMENT '配置字段名称',
  `value` varchar(500) DEFAULT NULL COMMENT '配置值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;





--用户表
CREATE TABLE `wd_member` (
  `id` int(11)  NOT NULL AUTO_INCREMENT,
  `username` varchar(255)   DEFAULT '' COMMENT '用户名',
  `password` varchar(255)   DEFAULT '' COMMENT '密码',
  `openid` varchar(255)   DEFAULT '' COMMENT '微信openid',
  `photo` varchar(255)   DEFAULT '' COMMENT '头像',
  `sign` varchar(255)   DEFAULT '' COMMENT '签名',
  `email` varchar(255)   DEFAULT '' COMMENT '邮箱',
  `cu_id` varchar(255)   DEFAULT '' COMMENT '个人中心显示id',
  `love_value` varchar(255)   DEFAULT '' COMMENT '爱心值',
  `phone` varchar(255)   DEFAULT '' COMMENT '绑定手机号',
  `province` varchar(255)   DEFAULT '' COMMENT '所在地省份',
  `city` varchar(255)   DEFAULT '' COMMENT '所在地城市',
  `home_province` varchar(255)   DEFAULT '' COMMENT '家乡省份',
  `home_city` varchar(255)   DEFAULT '' COMMENT '家乡城市',
  `is_auth` char(1)   DEFAULT '0' COMMENT '1代表已实名认证。0代表没',
  `auth_name` varchar(255)   DEFAULT '' COMMENT '实名 姓名',
  `auth_id` varchar(255)   DEFAULT '' COMMENT '身份证号',
  `auth_date` varchar(255)   DEFAULT '' COMMENT '实名时间',
  `express_address` varchar(255)   DEFAULT '' COMMENT '收件地址',
  `remark` varchar(255)   DEFAULT '' COMMENT '备注',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是后台用户',
  `last_login` int(10) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `first_login_time` int(11)     COMMENT '首次进入系统时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;


--爱心宣扬
CREATE TABLE `wd_announce` (
  `id` int(11)  NOT NULL AUTO_INCREMENT,
  `item_count` varchar(255)  DEFAULT ''  COMMENT '项目个数', 
  `single_price` varchar(255)  DEFAULT ''  COMMENT '单个金额', 
  `province` varchar(255)  DEFAULT ''  COMMENT '省份编号', 
  `city` varchar(255)  DEFAULT ''  COMMENT '城市编号', 
  `content` varchar(255)  DEFAULT ''  COMMENT '祝福语', 
  `user_id` int(11)    COMMENT '用户id', 
  `date` int(11)    COMMENT '时间', 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;


--订单表
CREATE TABLE `wd_order` (
  `id` int(11)  NOT NULL AUTO_INCREMENT,
  `user_id` int(11)    COMMENT '用户id', 
  `total_price` int(11)   COMMENT '订单总额', 
  `status` char(1)  DEFAULT 0  COMMENT '0未付款 1已付款 ', 
  `order_code` varchar(50)    COMMENT '订单编号 ', 
  `type` int(11)    COMMENT '订单类型，1.爱心救助；2.梦想清单；3.轻松公益；4.爱心宣扬;5轻松公益', 
  `item_id` int(11)    COMMENT '项目id', 
  `content` varchar(255)   DEFAULT '' COMMENT '慰问语',
  `province` varchar(255)   DEFAULT '' COMMENT '需要回报时，省份地址',
  `city` varchar(255)   DEFAULT '' COMMENT '需要回报时，城市地址',
  `detail_address` varchar(255)   DEFAULT '' COMMENT '需要回报时，详细地址',
  `is_anonymous` char(1)   DEFAULT 0 COMMENT '1代表匿名',
  `item_count` varchar(255)  DEFAULT ''  COMMENT '项目个数（爱心宣扬）', 
  `single_price` varchar(255)  DEFAULT ''  COMMENT '单个金额（爱心宣扬）', 
  `province_love` varchar(255)  DEFAULT ''  COMMENT '省份编号（爱心宣扬）', 
  `city_love` varchar(255)  DEFAULT ''  COMMENT '城市编号（爱心宣扬）', 
  `id_arr` varchar(255)  DEFAULT ''  COMMENT '加入互助名单的id组（轻松互助）', 
  `create_date` int(11)    COMMENT '创建时间（爱心宣扬）', 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;


--捐赠
CREATE TABLE `wd_donor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11)     COMMENT '捐赠人id',
  `content` varchar(255)   DEFAULT '' COMMENT '慰问语',
  `item_id` int(11) COMMENT '受捐人项目id,wd_rescue表id',
  `price` varchar(255)   DEFAULT '' COMMENT '捐赠金额',
  `type` varchar(255)   DEFAULT '' COMMENT '捐款类型，1代表筹款救助，2代表梦想清单,3代表轻松公益',
  `province` varchar(255)   DEFAULT '' COMMENT '需要回报时，省份地址',
  `city` varchar(255)   DEFAULT '' COMMENT '需要回报时，城市地址',
  `detail_address` varchar(255)   DEFAULT '' COMMENT '需要回报时，详细地址',
  `is_anonymous` char(1)   DEFAULT 0 COMMENT '1代表匿名',
  `date` int(11)   COMMENT '捐赠时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;



--使用钱款
CREATE TABLE `wd_use_money` (
  `id` int(11)  NOT NULL AUTO_INCREMENT,
  `user_id` int(11)    COMMENT '用户id', 
  `img_arr` int(11)    COMMENT '证明图片组，对应images表的id', 
  `item_id` int(11) COMMENT '项目id', 
  `flag` int(11) COMMENT '1代表使用前。  2代表使用后', 
  `status` char(1) DEFAULT 0 COMMENT '0代表未处理  1代表已打款 ', 
  `pay_price` varchar(50) COMMENT '打款金额  只有status为1的时候才存在', 
  `use_price` varchar(50) COMMENT '用户已提现到零钱金额', 
  `type` varchar(255)  COMMENT '捐款类型，1代表筹款救助，2代表梦想清单,3代表轻松公益',
  `date` int(11)    COMMENT '时间', 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;



--评论
CREATE TABLE `wd_comments` (
  `id` int(11)  NOT NULL AUTO_INCREMENT,
  `item_id` int(11)    COMMENT '项目id', 
  `donor_id` int(11)    COMMENT '捐款信息id', 
  `user_id` int(11)    COMMENT '用户id', 
  `content` varchar(255)  DEFAULT ''  COMMENT '评论内容', 
  `type` varchar(255)   DEFAULT '' COMMENT '捐款类型，1代表筹款救助，2代表梦想清单',
  `date` int(11)    COMMENT '时间', 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;


--轻松公益
CREATE TABLE `wd_gongyi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `target_money` varchar(255) NOT NULL DEFAULT ''  COMMENT '目标金额',
  `ins_logo` varchar(255) NOT NULL DEFAULT ''  COMMENT '机构logo',
  `ins_name` varchar(255) NOT NULL DEFAULT ''  COMMENT '机构名称',
  `title` varchar(250) NOT NULL DEFAULT '' COMMENT '筹款标题',
  `summary` text NOT NULL DEFAULT '' COMMENT '求助内容',
  `status` tinyint(4) unsigned NOT NULL  DEFAULT '0' COMMENT '2代表隐藏，3代表筹款中，4代表已结束',
  `is_top` boolean NOT NULL  DEFAULT false COMMENT '是否置顶',
  `personal_img` varchar(255)    DEFAULT '' COMMENT '上传的图片，逗号分割，最多8张。',
  `money_is_use` char(1)   DEFAULT '0' COMMENT '项目资金是否已使用,1是，0不是',
  `create_date` int(11)    COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;


--明星选手
CREATE TABLE `wd_star` (
  `id` int(11)  NOT NULL AUTO_INCREMENT,
  `name` varchar(255)    COMMENT '名称', 
  `en_name` varchar(255)    COMMENT '名称', 
  `img` varchar(255)    COMMENT '头像', 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;


--明显选手点赞
CREATE TABLE `wd_good_star` (
  `id` int(11)  NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255)    COMMENT '用户id', 
  `star_id` varchar(255)    COMMENT '明星选手id', 
  `date` int(11)    COMMENT '点赞时间', 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;


--点赞 （爱心宣扬）

CREATE TABLE `wd_good` (
  `id` int(11)  NOT NULL AUTO_INCREMENT,
  `announce_id` int(11)    COMMENT '爱心宣扬id', 
  `user_id` int(11)    COMMENT 'user_id', 
  `date` int(11)    COMMENT '时间', 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;


mysqluser

@#$666$%^!
--证人
CREATE TABLE `wd_witness` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT ''  ,
  `item_id` int(11)   ,
  `item_user_id` int(11)   COMMENT '此项目的userID、' ,
  `user_id` int(11)   COMMENT '证人的user_id' ,
  `tel` varchar(255)   ,
  `title` varchar(255)   DEFAULT '' ,
  `score` char(4)   DEFAULT '' ,
  `date` int(11)   ,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--组织机构
CREATE TABLE `wd_organization` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT ''  ,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

--委员会人员职位
CREATE TABLE `wd_committee` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT ''  ,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

 
 --省份表
CREATE TABLE `provinces` (  
  `id` int(11) NOT NULL auto_increment,  
  `provinceid` varchar(20) NOT NULL,  
  `province` varchar(50) NOT NULL,  
  PRIMARY KEY  (`id`)  
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='省份信息表' AUTO_INCREMENT=35 ;  

--城市表
CREATE TABLE `cities` (  
  `id` int(11) NOT NULL auto_increment,  
  `cityid` varchar(20) NOT NULL,  
  `city` varchar(50) NOT NULL,  
  `provinceid` varchar(20) NOT NULL,  
  PRIMARY KEY  (`id`)  
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='行政区域地州市信息表' AUTO_INCREMENT=346 ; 