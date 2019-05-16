<?php
//网站的配置
define('WEBNAME', '韦肯Webcms文章管理系统');
//数据库配置文件
define(DB_HOST, "localhost");
define(DB_USER, "root");
define(DB_PASS, "");
define(DB_NAME, "cms");

//系统配置文件
define('PREV_URL', getenv("HTTP_REFERER"));
define('GPC', get_magic_quotes_gpc());//转译功能是否打开
define('PAGE_SIZE', 10);//每页显示多少条
define('ARTICLE_SIZE', 8);//文章显示条数
define('NAV_SIZE', 10);//主导航在前台显示的条数
define('RO_NUM', 3);//轮播器显示条数
define(UPDIR, '/uploads/');//上传目录
define('MARK', ROOT_PATH.'/images/logo2.png');//水印图片

//模板配置信息
define('TPL_DIR', ROOT_PATH.'/templates/');
define('TPL_C_DIR', ROOT_PATH.'/templates_c/');//编译目录
define('CACHE', ROOT_PATH.'/cache/');
//define('FRONT_CACHE', false); //前台缓存开关

//广告配置
define('ADVER_TEXT_NUM', 5);  //最多5个
define('ADVER_PIC_NUM', 3);
?>
