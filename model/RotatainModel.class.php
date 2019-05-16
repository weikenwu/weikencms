<?php
//轮播器实体类
class RotatainModel extends Model{
    private $id;
    private $thumbnail;
    private $link;
    private $title;
    private $limit;
    private $info;
    private $state;

    //拦截器
    private function __set($_key,$_value){
        $this->$_key=Tool::mysqlString($_value);
    }
    //取值
    private function __get($_name){

            return $this->$_name;
    }
    //前台获取轮播器
    public function getNewRotatain(){
        $_sql="SELECT 
                        title,
                        thumbnail,
                        link 
                    FROM 
                        cms_rotatain 
                    WHERE 
                        state=1 
                    ORDER BY 
                        date 
                    DESC 
                    LIMIT 
                        0,".RO_NUM;
        return parent::all($_sql);
    }
    //通过审核
    public function setStateOk(){
        $_sql="UPDATE
        cms_rotatain
        SET
        state=1
        WHERE
        id='$this->id'
        LIMIT
        1";
        return parent::aud($_sql);
    }
    //取消通过审核
    public function setStateCancel(){
        $_sql="UPDATE
        cms_rotatain
        SET
        state=0
        WHERE
        id='$this->id'
        LIMIT
        1";
        return parent::aud($_sql);
    }
    public function getOneRotatain(){
        $_sql="SELECT id,title,thumbnail,info,link FROM cms_rotatain WHERE id='$this->id' LIMIT 1";
        return parent::one($_sql);
    }
    public function  getRotatainTotal(){
        $_sql="SELECT COUNT(*) FROM cms_rotatain";
        return parent::total($_sql);
    }
    public function getAllRatatain(){
        
         $_sql="SELECT
                            id,
                            title,
                            info,
                            state,
                            link,
                            link fulllink
                     FROM
                            cms_rotatain
                    ORDER BY
                            state DESC,date DESC
                        $this->limit";
        return parent::all($_sql);
    }
    public function addRotatain(){
        
        $_sql="INSERT INTO 
                        cms_rotatain(
                                    thumbnail,
                                    info,
                                    link,
                                    title,
                                    state,
                                    date
                        ) values(
                                    '$this->thumbnail',
                                    '$this->info',
                                    '$this->link',
                                    '$this->title',
                                    1,
                                    NOW()
                        )";
        return parent::aud($_sql);
        
    }
    public function updateRotatain(){
        
        $_sql="UPDATE cms_rotatain
        SET
        title='$this->title',
        info='$this->info',
        thumbnail='$this->thumbnail',
        link='$this->link'
        WHERE
        id='$this->id'
        LIMIT 1";
        return parent::aud($_sql);
    }
    public function deleteRotatain(){
        $_sql="DELETE FROM
        cms_rotatain
        WHERE
        id='$this->id'
        LIMIT 1";
        return parent::aud($_sql);
    }
    
}