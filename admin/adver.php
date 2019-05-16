<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
Validate::checkPremission('10', '警告，权限不足，不能管理广告');
global $_tpl;
$_adver=new AdverAction($_tpl);
$_adver->_action();
$_tpl->display('adver.tpl');

