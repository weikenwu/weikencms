<?php
//验证类
class Validate{
    //是否为空
    static public function checkNull($_data){
        if(trim($_data)=='') return true;
        return false;
    }
    
    //长度是否足够
    static public function checkLength($_data,$_length,$_flag){
        if($_flag=='min'){
            if(mb_strlen(trim($_data),"utf-8")<$_length) return true;
            return false;
        }elseif ($_flag=='max'){
            if(mb_strlen(trim($_data),"utf-8")>$_length) return true;
            return false;
        }elseif ($_flag=='equals'){
            if(mb_strlen(trim($_data),"utf-8")!=$_length) return true;
            return false;
        }
        else {
            Tool::alertBack("ERROR:参数传值有误，必须是min,max");
        }
    }
    //数据是否为数字
    static public function checkNum($_data){
        if(!is_numeric($_data)) return true;
        return false;
    }
    
    //数据是否一致
    static public function checkEquals($_data,$_otherdate){
        if(trim($_data)!=trim($_otherdate)) return true;
        return false;
    }
    //验证电子邮件
    static public function checkEmail($_data){
        if(!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/', $_data)) return true;
        return false;
    }
    //session验证
    static public function checkSession(){
        if(!isset($_SESSION['admin'])) Tool::alertBack("非法登录！");
    }
    //权限
    static public function checkPremission($_data,$_info){
        
        if(!in_array($_data, $_SESSION['admin']['premission'])){ 
            Tool::alertBack($_info);
        }
    }
    //获取ip
    static public function GetIP(){
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif(!empty($_SERVER["REMOTE_ADDR"])){
            $cip = $_SERVER["REMOTE_ADDR"];
        }
        else{
            $cip = "无法获取！";
        }
        return $cip;
    }
}