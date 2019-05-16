<?php
//权限实体类
class PremissionModel extends Model{

    private $id;
    private $name;
    private $info;
    private $limit;

    //拦截器
    private function __set($_key,$_value){
        $this->$_key=Tool::mysqlString($_value);
    }
    //取值
    private function __get($_name){

            return $this->$_name;
    }
    public function  getPremissionTotal(){
        $_sql="SELECT COUNT(*) FROM cms_premission";
        return parent::total($_sql);
    }
    public function getAllPremission(){
        
        $_sql="SELECT
        id,
        name,
        info
        FROM
        cms_premission
        ORDER BY
        id ASC
        ";
        return parent::all($_sql);
    }
    public function getAllLimitPremission(){
        
        $_sql="SELECT
        id,
        name,
        info
        FROM
        cms_premission
        ORDER BY
        id DESC
        $this->limit
        ";
        return parent::all($_sql);
    }
    public function  getOnePremission(){
        
        $_sql="SELECT
        id,
        name,
        info
        FROM cms_premission
        WHERE
        name='$this->name'
        OR
        id='$this->id'
        LIMIT 1";
        return parent::one($_sql);
    }
    public function  getOnePremissionByid($_ids){
        
        $_sql="SELECT
        id,
        name,
        info
        FROM cms_premission
        WHERE
        id in ($_ids)
        ";
        return parent::all($_sql);
    }
    public function  getOnePremissionNoByid($_ids){
        
        $_sql="SELECT
        id,
        name,
        info
        FROM cms_premission
        WHERE
        id not in ($_ids)
        ";
        return parent::all($_sql);
    }
    public function addPremission(){
        
        $_sql="INSERT INTO cms_premission(
        name,
        info
        ) values(
        '$this->name',
        '$this->info'
        )";
        return parent::aud($_sql);
        
    }
    public function updatePremission(){
        
        $_sql="UPDATE cms_premission
        SET
        name='$this->name',
        info='$this->info'
        WHERE
        id='$this->id'
        LIMIT 1";
        return parent::aud($_sql);
    }
    public function deletePremission(){
        
        $_sql="DELETE FROM
        cms_premission
        WHERE id='$this->id'
        LIMIT 1";
        return parent::aud($_sql);
    }
}