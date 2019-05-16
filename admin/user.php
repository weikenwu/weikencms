<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
global $_tpl;
Validate::checkSession();
Validate::checkPremission('13', '警告，权限不足，不能管理会员');
$_user=new UserAction($_tpl);
$_user->_action();
$_tpl->display('user.tpl');

