<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
Validate::checkPremission('9', '警告，权限不足，不能管理轮播器');
global $_tpl;
$_rotatain=new RotatainAction($_tpl);
$_rotatain->_action();
$_tpl->display('rotatain.tpl');

