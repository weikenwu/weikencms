<?php
require dirname(__FILE__).'/init.inc.php';
global $_tpl;


// $_array=array(1,2,3,4,5);

//$_tpl->assign('name',$_name);
// $_tpl->assign('content','是一个程序员');
// $_tpl->assign('a',5<4);
// $_tpl->assign('array',$_array);
$_index=new IndexAction($_tpl);
$_index->_action();
$_tpl->display('index.tpl');

