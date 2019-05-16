<?php
//广告实体类
class AdverModel extends Model{
    private $type;
    private $title;
    private $id;
    private $info;
    private $link;
    private $state;
    private $thumbnail;
    private $limit;

    //拦截器
    private function __set($_key,$_value){
        $this->$_key=Tool::mysqlString($_value);
    }
    //取值
    private function __get($_name){
            return $this->$_name;
    }
    
    public function  getAdverTotal(){
        $_sql="SELECT COUNT(*) FROM cms_adver";
        return parent::total($_sql);
    }
    //获取最新的n条文字广告
    public function getNewTextAdver(){
        $_sql="SELECT 
                        title,
                        link
                    FROM 
                        cms_adver 
                    WHERE 
                        state=1 
                    AND
                        type=1
                    ORDER BY 
                        date 
                    DESC 
                    LIMIT 
                        0,".ADVER_TEXT_NUM;
        return parent::all($_sql);
    }
    public function getNewHeaderAdver(){
        $_sql="SELECT
                        title,
                        link,
                        thumbnail
                    FROM
                        cms_adver
                    WHERE
                        state=1
                    AND
                        type=2
                    ORDER BY
                        date
                    DESC
                    LIMIT
                        0,".ADVER_PIC_NUM;
        return parent::all($_sql);
    }
    public function getNewSidebarAdver(){
        $_sql="SELECT
                        title,
                        link,
                        thumbnail
                    FROM
                        cms_adver
                    WHERE
                        state=1
                    AND
                        type=3
                    ORDER BY
                        date
                    DESC
                    LIMIT
                        0,".ADVER_PIC_NUM;
        return parent::all($_sql);
    }
    //通过审核
    public function setStateOk(){
        $_sql="UPDATE
        cms_adver
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
        cms_adver
        SET
        state=0
        WHERE
        id='$this->id'
        LIMIT
        1";
        return parent::aud($_sql);
    }
    public function getOneAdver(){
        $_sql="SELECT id,title,thumbnail,info,link FROM cms_adver WHERE id='$this->id' LIMIT 1";
        return parent::one($_sql);
    }
    public function getAllAdver(){
        
        $_sql="SELECT
                            id,
                            title,
                            info,
                            thumbnail,
                            state,
                            type,
                            link
                     FROM
                         cms_adver
                    ORDER BY
                    date DESC
                    $this->limit";
        return parent::all($_sql);
    }
    
    public function addAdver(){
        
        $_sql="INSERT INTO cms_adver(
                                    title,
                                    link,
                                    info,
                                    type,
                                    state,
                                    date,
                                    thumbnail
                                    ) values(
                                    '$this->title',
                                    '$this->link',
                                    '$this->info',  
                                    '$this->type',
                                    1,
                                    NOW(),
                                    '$this->thumbnail'
                                    )";
        return parent::aud($_sql);
        
    }
    public function deleteAdver(){
        $_sql="DELETE FROM
        cms_adver
        WHERE
        id='$this->id'
        LIMIT 1";
        return parent::aud($_sql);
    }
}