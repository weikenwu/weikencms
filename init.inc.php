<?php
//开启session
session_start();
ini_set('display_errors', 'off');//php版本空值报错
date_default_timezone_set('Asia/Shanghai');//时区
header("Content-Type:text/html;charset=utf-8");
define('ROOT_PATH', dirname(__FILE__));


//引入配置信息
require ROOT_PATH.'/config/profile.inc.php';

//自动加载类
function __autoload($_classname){
    if(substr($_classname, -6)=='Action'){
        require ROOT_PATH.'/action/'.$_classname.'.class.php';
    }else if(substr($_classname, -5)=='Model'){
        require ROOT_PATH.'/model/'.$_classname.'.class.php';
    }else {
        require ROOT_PATH.'/includes/'.$_classname.'.class.php';
    }
}
//设置不缓存
$_cache=new Cache(array('code','ckeup','static','upload','register','feedback','cast','friendlink','search'));
// $_noCache=array('code','ckeup','static','upload');
// $_noCacheScript=in_array(Tool::tplName(), $_noCache);
//实例化模板
$_tpl=new Templates($_cache);
//初始化
require 'common.inc.php';

