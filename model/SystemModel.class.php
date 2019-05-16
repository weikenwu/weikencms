<?php
//配置实体类
class SystemModel extends Model{

    private $id;
    private $webname;
    private $page_size;
    private $article_size;
    private $nav_size;
    private $updir;
    private $ro_num;
    private $adver_text_num;
    private $adver_pic_num;

    //拦截器
    private function __set($_key,$_value){
        $this->$_key=Tool::mysqlString($_value);
    }
    //取值
    private function __get($_name){

            return $this->$_name;
    }
    public function setSystem(){
        $_sql="UPDATE 
                        cms_system 
                    SET 
                        webname='$this->webname',
                        page_size='$this->page_size',
                        article_size='$this->article_size',
                        nav_size='$this->nav_size',
                        updir='$this->updir',
                        ro_num='$this->ro_num',
                        adver_text_num='$this->adver_text_num',
                        adver_pic_num='$this->adver_pic_num'
                    WHERE 
                        id=1
                    ";
        return parent::aud($_sql);
    }
    
    public function getSystem(){
        $_sql="SELECT
                        webname,
                        page_size,
                        article_size,
                        nav_size,
                        updir,
                        ro_num,
                        adver_text_num,
                        adver_pic_num
                     FROM
                        cms_system
                     WHERE
                        id=1";
        return parent::one($_sql);
    }
    
}