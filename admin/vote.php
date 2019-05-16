<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
Validate::checkPremission('11', '警告，权限不足，不能管理投票');
global $_tpl;
$_vote=new VoteAction($_tpl);
$_vote->_action();
$_tpl->display('vote.tpl');

