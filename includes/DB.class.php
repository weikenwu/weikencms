<?php
class DB{
    
    //获取对象句柄
    static public function getDB(){
        //使用过程化操作数据库
        $_mysqli=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME,3306);
        if(mysqli_connect_errno()){
            echo "数据库链接错误：".mysqli_connect_errno();
        }       
        $_mysqli->set_charset("utf8");
        return $_mysqli;
    }
    //清理
    static public function unDB(&$_resutl,&$_db){
        if(is_object($_resutl)){
            $_resutl->free();
            $_resutl=null;
        }
        if(is_object($_db)){
            $_db->close;
            $_db=null;
        }
        
    }
}