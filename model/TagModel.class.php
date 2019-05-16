<?php
//tag实体类
class TagModel extends Model{
    private $id;
    private $count;
    private $tagname;

    //拦截器
    private function __set($_key,$_value){
        $this->$_key=Tool::mysqlString($_value);
    }
    //取值
    private function __get($_name){
            return $this->$_name;
    }
    //获取前五条TAG
    public function getFiveTag(){
        $_sql="SELECT tagname,count FROM cms_tag ORDER BY count DESC LIMIT 0,5";
        return parent::all($_sql);
    }
    //查找单一
    public function getOneTag(){
        $_sql="SELECT id FROM cms_tag WHERE tagname='$this->tagname'";
        return parent::one($_sql);
    }
    public function addTagCount(){
        $_sql="UPDATE cms_tag SET count=count+1 WHERE tagname='$this->tagname'";
        return parent::aud($_sql);
    }
    public function addTag(){
        
        $_sql="INSERT INTO cms_tag(
        tagname
        ) values(
        '$this->tagname'
        )";
        return parent::aud($_sql);
        
    }
   

   
}