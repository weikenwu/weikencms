<?php
define('IS_CACHE', true);//开启缓冲区

global $_tpl,$_cache;
//前台专用
if(IS_CACHE && !$_cache->noCache()){//静态缓存处理
    ob_start();
    $_tpl->cache(Tool::tplName().'.tpl');
}

$_nav=new NavAction($_tpl);
$_nav->showfront();
//echo Tool::tplName();
$_cookie=new Cookie('user');
if (IS_CACHE) {
    $_tpl->assign('header', '<script type="text/javascript">getHeader();</script>');
} else {
    if ($_cookie->getCookie()) {
        $_tpl->assign('header', $_cookie->getCookie() . '，您好！ <a href="register.php?action=logout">退出</a> ');
    } else {
        $_tpl->assign('header', '<a href="register.php?action=reg" class="user">注册</a>
<a href="register.php?action=login" class="user">登录</a> ');
    }
}

$_link=new FriendLinkAction($_tpl);
$_link->index();

$_tag=new TagAction($_tpl);
$_tag->getFiveTag();

$_tpl->assign('webname', WEBNAME);