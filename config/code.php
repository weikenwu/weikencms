<?php
require substr(dirname(__FILE__),0,-7).'/init.inc.php';
$_vc=new ValidateCode();
echo $_vc->doimg();
$_SESSION['code']=$_vc->getCode();