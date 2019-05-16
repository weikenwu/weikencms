<?php
$_mysqli=new mysqli();
$_mysqli->connect('localhost','root','','test');
$_mysqli->set_charset('utf8');
//事务
$_mysqli->autocommit(false);
$_sql.="UPDATE user SET age=age+5 WHERE id=1;";
$_sql.="UPDATE user SET age=age-5 WHERE id=2";

if($_mysqli->multi_query($_sql)){
    $_success=$_mysqli->affected_rows==1 ? true : false;
    $_mysqli->next_result();
    $_success2=$_mysqli->affected_rows==1 ? true : false;
    if($_success && $_success2){
        $_mysqli->commit();
        echo '完美提交';
    }else {
        $_mysqli->rollback();
        echo '撤销提交';
    }
    
}else {
    echo '第一条SQL语句有误';
}

$_mysqli->autocommit(true);

$_mysqli->close();