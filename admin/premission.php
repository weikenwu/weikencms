<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
Validate::checkPremission('5', '警告，权限不足，不能管理权限');
global $_tpl;
$_premission=new PremissionAction($_tpl);
$_premission->_action();
$_tpl->display('premission.tpl');

