<?php
require substr(dirname(__FILE__),0,-6).'/init.inc.php';
Validate::checkSession();
Validate::checkPremission('8', '警告，权限不足，不能管理评论审核');
global $_tpl;
$_comment=new CommentAction($_tpl);
$_comment->_action();
$_tpl->display('comment.tpl');

