<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
Validate::checkPremission('4', '警告，权限不足，不能管理等级');
global $_tpl;
$_level=new LevelAction($_tpl);
$_level->_action();
$_tpl->display('level.tpl');

