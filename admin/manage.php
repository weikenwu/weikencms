<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
Validate::checkPremission('3', '警告，权限不足，不能管理管理员');
global $_tpl;
$_manage=new ManageAction($_tpl);
$_manage->_action();
$_tpl->display('manage.tpl');

