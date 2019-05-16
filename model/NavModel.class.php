<?php

// 等级实体类
class NavModel extends Model
{

    private $nav_name;

    private $nav_info;

    private $pid;

    public $sort;

    private $id;

    private $limit;

    // 拦截器
    private function __set($_key, $_value)
    {
        $this->$_key = Tool::mysqlString($_value);
    }

    // 取值
    private function __get($_name)
    {
        return $this->$_name;
    }
    //获取4个主导航
    public function getFourNav(){
        $_sql="SELECT 
                        id,
                        nav_name 
                    FROM 
                        cms_nav 
                    WHERE 
                        pid=0 
                    ORDER BY 
                        sort 
                    ASC 
                    LIMIT 
                        0,4";
        return parent::all($_sql);
    }
    //获取所有非主类下的ID
    public function getAllNavchildID(){
        $_sql="SELECT
                        id
                 FROM
                        cms_nav
                 WHERE
                        pid<>0";
        return parent::all($_sql);
    }
    //获取主类下的子类ID
    public function getNavChildId(){
        $_sql="SELECT
        id
        FROM
        cms_nav
        WHERE
        pid='$this->id'";
        return parent::all($_sql);
    }
    //导航排序
    public function setNavSort(){
        foreach ($this->sort as $_key=>$_value){
            if(!is_numeric($_value)) continue;
           echo $_sql.="UPDATE cms_nav SET sort='$_value' WHERE id='$_key';";
           
        }
        return parent::multi($_sql);
    }
    
    //前台显示
    public function getFrontNav(){
        $_sql = "SELECT
                        id,
                        nav_name
                FROM
                        cms_nav
                WHERE
                        pid=0
                ORDER BY
                        sort ASC
                LIMIT 0,".NAV_SIZE;
        return parent::all($_sql);
    }

    public function  getOneNav(){
        
         $_sql="SELECT
                        n1.id,
                        n1.nav_name,
                        n1.nav_info,
                        n2.id iid,
                        n2.nav_name nnav_name
               FROM 
                        cms_nav n1
               LEFT JOIN 
                        cms_nav n2
               ON
                        n1.pid=n2.id
               WHERE
                        n1.id='$this->id'
                OR
                        n1.nav_name='$this->nav_name'
               LIMIT 1";
        return parent::one($_sql);
    }
    
    public function getNavTotal()
    {
        $_sql = "SELECT 
                    COUNT(*) 
                  FROM 
                    cms_nav
                WHERE
                    pid=0
                          ";
        return parent::total($_sql);
    }
    public function getNavChildTotal()
    {
        $_sql = "SELECT
                    COUNT(*)
                  FROM
                    cms_nav
                WHERE
                    pid=$this->id
                          ";
        return parent::total($_sql);
    }
    public function getAllNav()
    {
        $_sql = "SELECT 
                        id,
                        nav_name,
                        nav_info,
                        sort    
                   FROM 
                        cms_nav
                   WHERE
                        pid=0
                    ORDER BY
                        sort ASC
                        $this->limit
                    ";
        return parent::all($_sql);
    }
    
    public function getAllChildNav()
    {
        $_sql = "SELECT
                        id,
                        nav_name,
                        nav_info,
                        sort
        FROM
                        cms_nav
        WHERE
                        pid='$this->id'
        ORDER BY sort ASC
                        $this->limit;
        ";
        return parent::all($_sql);
    }
    public function getAllFrontNav()
    {
        $_sql = "SELECT
        id,
        nav_name,
        nav_info,
        sort
        FROM
        cms_nav
        WHERE
        pid='$this->id'
        ORDER BY sort ASC
        ";
        return parent::all($_sql);
    }
    //前台所有子导航
    public function getAllFrontChildNav()
    {
        $_sql = "SELECT
        id,
        nav_name,
        nav_info,
        sort
        FROM
        cms_nav
        WHERE
        pid='$this->id'
        ORDER BY sort ASC;
        ";
        return parent::all($_sql);
    }
    
   public function addNav(){
        
        $_sql="INSERT INTO cms_nav(
                                    nav_name,
                                    nav_info,
                                    pid,
                                    sort
                                 ) values(
                                    '$this->nav_name',
                                    '$this->nav_info',
                                    '$this->pid',
                                    ".parent::nextid('cms_nav')."
                                 )";
        return parent::aud($_sql);
        
    }
    public function updateNav(){
        
        $_sql="UPDATE cms_nav
                        SET
                            nav_name='$this->nav_name',
                            nav_info='$this->nav_info'
                        WHERE
                            id='$this->id'
                        LIMIT 1";
        return parent::aud($_sql);
    }
    public function deleteNav(){      
        $_sql="DELETE FROM
                            cms_nav
                      WHERE 
                            id='$this->id'
                      LIMIT 1";
        return parent::aud($_sql);
    }

}