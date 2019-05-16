<?php
class Model{
    //执行多条SQL
    protected function multi($_sql){
        $_db=DB::getDB();
        $_db->multi_query($_sql);
        DB::unDB($_result=null, $_db);
        return true;
    }
    //查找总记录模型
    protected function total($_sql){
        $_db=DB::getDB();
        $_result=$_db->query($_sql);
        $_row=$_result->fetch_row();
        DB::unDB($_result, $_db);
        return $_row[0];
        
    }
    //查找单个数据模型
    protected function one($_sql){
        $_db=DB::getDB();
        
        $_result=$_db->query($_sql);
        
        $_row=$_result->fetch_object();
        DB::unDB($_result, $_db);
        return $_row;
    }
    
    //查找多个数据模型
    protected function all($_sql){
        //echo $_sql;
        $_db=DB::getDB();
        
        $_result=$_db->query($_sql);
        $_html=array();
        while (!!$_row=$_result->fetch_object()){
            $_html[]=$_row;
        }
        DB::unDB($_result, $_db);
        return Tool::htmlString($_html);
    }
    
    //删修改模型
    protected function aud($_sql){
        $_db=DB::getDB();
        
        $_result=$_db->query($_sql);
        $_affected_rows=$_db->affected_rows;
        DB::unDB($_result, $_db);
        return $_affected_rows;
    }
    
    //获取下一个增值ID
    protected function nextid($_table){
        $_sql="SHOW TABLE STATUS LIKE '$_table'";
        $_object=$this->one($_sql);
        return $_object->Auto_increment;
    }
}