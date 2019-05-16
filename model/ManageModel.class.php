<?php
//管理员实体类
class ManageModel extends Model{
    private $_admin_user;
    private $_admin_pass;
    private $_level;
    private $id;
    private $_limit;

    //拦截器
    private function __set($_key,$_value){
        $this->$_key=Tool::mysqlString($_value);
    }
    //取值
    private function __get($_name){

            return $this->$_name;
    }
    public function  getOneManage(){
        
        $_sql="SELECT 
                    id,
                    admin_user,
                    admin_pass,
                    level 
                    FROM cms_manage 
                    WHERE
                    id='$this->id'
                    OR
                    admin_user='$this->_admin_user'
                    OR
                    level='$this->_level'
                    LIMIT 1";
        return parent::one($_sql);
    }
    //查询单个管理员核对
    public function getLoginManage(){
        $_sql="SELECT
                    m.admin_user,
                    l.level_name,
                    l.premission
                FROM
                    cms_manage m,cms_level l
                WHERE
                    m.admin_user='$this->_admin_user'
                AND
                    m.admin_pass='$this->_admin_pass'
                AND
                    m.level=l.id
                LIMIT 1";
        return parent::one($_sql);
    }
    
    public function  getManageTotal(){
        $_sql="SELECT COUNT(*) FROM cms_manage";
        return parent::total($_sql);
    }
//     //查询所有的登记
//     public function getAllLevel(){
//         $_sql="SELECT 
//                     id,
//                     level_name 
//                FROM cms_level 
//                ORDER BY 
//                     id ASC";
//         return parent::all($_sql);
//     }
    public function getAllManage(){
        
        $_sql="SELECT 
                    m.id,
                    m.admin_user,
                    m.login_count,
                    m.last_ip,
                    m.last_time,
                    l.level_name    
                     FROM 
                         cms_manage m,
                         cms_level l
                    WHERE
                    m.level=l.id
                    ORDER BY
                    id ASC 
                    $this->_limit";
        return parent::all($_sql);
    }
    public function addManage(){
        
        $_sql="INSERT INTO cms_manage(
                                        admin_user,
                                        admin_pass,
                                        level,
                                        reg_time
                                        
                                        ) values(
                                            '$this->_admin_user',
                                            '$this->_admin_pass',
                                            '$this->_level',
                                            NOW()
                                        )";
        return parent::aud($_sql);
        
    }
    public function updateManage(){

        $_sql="UPDATE cms_manage 
                                SET 
                                admin_pass='$this->_admin_pass',
                                level='$this->_level'
                                WHERE 
                                id='$this->id' 
                                LIMIT 1";
        return parent::aud($_sql);
    }
    public function updateManage_ip($_ip){
        $_user=$_SESSION['admin']['admin_user'];
        $_time=date('Y-m-d H:i:s',time());
        echo $_sql="UPDATE cms_manage
            SET
                login_count=login_count+1,
                last_ip='$_ip',
                last_time='$_time'
            WHERE
                admin_user='$_user'
            LIMIT 1";
        return parent::aud($_sql);
    }
    public function deleteManage(){

        $_sql="DELETE FROM 
                    cms_manage 
                    WHERE id='$this->id' 
                    LIMIT 1";
        return parent::aud($_sql);
    }
}