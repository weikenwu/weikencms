<?php
class Tool{
    //弹窗跳转
    static public function alertLocation($_info,$_url){
        if(!empty($_info)){
            echo "<script type='text/javascript'> alert('$_info');location.href='$_url';</script>";
            exit();
        }else {
            header("location:$_url");
            exit();
        }
    }
    //弹窗返回
    static public function alertBack($_info){
        echo "<script type='text/javascript'> alert('$_info');history.back();</script>";
        exit();
    }
    //弹窗关闭
    static public function alertClose($_info){
        echo "<script type='text/javascript'> alert('$_info');close();</script>";
        exit();
    }
    //弹窗赋值(上传专用)
    static public function alertOpenerClose($_info,$_path){
        echo "<script type='text/javascript'> alert('$_info');</script>";
        echo "<script type='text/javascript'>opener.document.content.thumbnail.value='$_path';</script>";
        echo "<script type='text/javascript'>opener.document.content.pic.style.display='block';</script>";
        echo "<script type='text/javascript'>opener.document.content.pic.src='$_path';</script>";
        echo "<script type='text/javascript'>window.close();</script>";
        exit();
    }
    
    //清除session
    static public function unSession(){
        if(session_start()){
            session_destroy();
        }
    }
    //数据库，输入转译
    static public function mysqlString($_date){
        return !GPC ? mysql_real_escape_string($_date) : $_date;
        //linux GPC mysql_real_escape_string addslashes()
    }
    //数组转字符串，并去掉最后的逗号
    static public function objArrOfStr($_object,$_field){
        if($_object){
        foreach ($_object as $_value){
            $_html.=$_value->$_field.",";
        }
        }
        return substr($_html, 0,strlen($_html)-1);
    }
    //将当前文件名转换成tpl
    static public function tplName(){
        $_str=explode('/', $_SERVER['SCRIPT_NAME']);
        $_str=explode('.', $_str[count($_str)-1]);
        return $_str[0];
        
    }
    //将HTML代码转换
    static public function unHtml($_str){
        return htmlspecialchars_decode($_str);
    }
    //日期转换
    static public function objDate(&$_object,$_field){
        if($_object){
        foreach ($_object as $_value){
            $_value->$_field=date('m-d',strtotime($_value->$_field));
        }
        }
    }
    //字符截取
    static public function  subStr($_object,$_field,$_length,$_encoding){
        if($_object){
            if(is_array($_object)){
                foreach ($_object as $value) {
                    if (mb_strlen($value->$_field, $_encoding) > $_length) {
                        $value->$_field = mb_substr($value->$_field, 0, $_length, $_encoding) . '...';
                    }
                }
            } else {
                if (mb_strlen($_object, $_encoding) > $_length) {
                    return mb_substr($_object, 0,$_length,$_encoding).'...';
                }else {
                    return $_object;
                }
            }
        }
       
    }
    //显示，过滤
    static public function htmlString($_date){
        if(is_array($_date)){
            foreach ($_date as $_key=>$_value){
                $_string[$_key]=Tool::htmlString($_value);
            }
        }elseif (is_object($_date)){
            foreach ($_date as $_key=>$_value){
                $_string->$_key=Tool::htmlString($_value);
            }
        }else {
            $_string=htmlspecialchars($_date);
        }
        return $_string;
    }
}