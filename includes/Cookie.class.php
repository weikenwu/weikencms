<?php
class Cookie{
    private $name;
    private $value;
    private $time;
    
    public function __construct($_name,$_value='',$_time=0){
        $this->name=$_name;
        $this->value=$_value;
        if(empty($_time)){
            $this->time=0;
        }else {
            $this->time=time()+$_time;
        }
        
    }
    public function setCookie(){
        setcookie($this->name,$this->value,$this->time);
    }
    public function getCookie(){
        return $_COOKIE["$this->name"];
    }
    //移除COOKIE
    public function unCookie(){
        setcookie($this->name,'',-1);
    }
}