<?php
//等级实体类
class LevelModel extends Model{
    private $_level_name;
    private $_level_info;
    private $id;
    private $premission;
    private $limit;

    //拦截器
    private function __set($_key,$_value){
        $this->$_key=Tool::mysqlString($_value);
    }
    //取值
    private function __get($_name){

            return $this->$_name;
    }
    public function  getLevelTotal(){
        $_sql="SELECT COUNT(*) FROM cms_level";
        return parent::total($_sql);
    }
    public function  getOneLevel(){
        
        $_sql="SELECT 
                    id,
                    level_name,
                    level_info,
                    premission 
                    FROM cms_level 
                    WHERE
                    id='$this->id'
                    OR
                    level_name='$this->_level_name'
                    LIMIT 1";
        return parent::one($_sql);
    }
   
    public function getAllLevel(){
        
        $_sql="SELECT 
                    id,
                    level_name,
                    level_info,
                    premission    
                     FROM 
                         cms_level
                    ORDER BY
                    id ASC
                    $this->limit
                    ";
        return parent::all($_sql);
    }
    public function addLevel(){
        
        $_sql="INSERT INTO cms_level(
                                        level_name,
                                        level_info,
                                        premission
                                        ) values(
                                            '$this->_level_name',
                                            '$this->_level_info',
                                            '$this->premission'
                                        )";
        return parent::aud($_sql);
        
    }
    public function updateLevel(){

        $_sql="UPDATE cms_level 
                                SET 
                                level_name='$this->_level_name',
                                premission='$this->premission',
                                level_info='$this->_level_info'
                                WHERE 
                                id='$this->id' 
                                LIMIT 1";
        return parent::aud($_sql);
    }
    public function deleteLevel(){

        $_sql="DELETE FROM 
                    cms_level 
                    WHERE id='$this->id' 
                    LIMIT 1";
        return parent::aud($_sql);
    }
}