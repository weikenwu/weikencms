<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
global $_tpl;
Validate::checkSession();
Validate::checkPremission('6', '警告，权限不足，不能管理网站导航');
$_nav=new NavAction($_tpl);
$_nav->_action();
$_tpl->display('Nav.tpl');

