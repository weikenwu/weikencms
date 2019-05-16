<?php
//实体类
class LinkModel extends Model{
    private $id;
    private $webname;
    private $weburl;
    private $logourl;
    private $user;
    private $type;
    private $state;
    private $limit;


    //拦截器
    private function __set($_key,$_value){
        $this->$_key=Tool::mysqlString($_value);
    }
    //取值
    private function __get($_name){
            return $this->$_name;
    }
    public function getNineLinkLogo(){
        $_sql="SELECT
        webname,
        weburl,
        logourl
        FROM
        cms_link
        WHERE
        type=2
        AND
        state=1
        ORDER BY
        date
        DESC
        LIMIT
        0,9";
        return parent::all($_sql);
    }
    public function getAllLinkLogo(){
        $_sql="SELECT
        webname,
        weburl,
        logourl
        FROM
        cms_link
        WHERE
        type=2
        AND
        state=1
        ORDER BY
        date
        DESC
        ";
        return parent::all($_sql);
    }
    public function getTwentyLinkText(){
        $_sql="SELECT
        webname,
        weburl
        FROM
        cms_link
        WHERE
        type=1
        AND
        state=1
        ORDER BY
        date
        DESC
        LIMIT
        0,20";
        return parent::all($_sql);
    }
    public function getAllLinkText(){
        $_sql="SELECT
        webname,
        weburl
        FROM
        cms_link
        WHERE
        type=1
        AND
        state=1
        ORDER BY
        date
        DESC
        ";
        return parent::all($_sql);
    }
    public function  getLinkTotal(){
        $_sql="SELECT 
                    COUNT(*) 
                FROM 
                    cms_link";
        return parent::total($_sql);
    }
    public function getOneLink(){
        $_sql="SELECT
                        id,
                        webname,
                        weburl,
                        logourl,
                        user,
                        type,
                        state
                    FROM
                        cms_link
                    WHERE
                        id='$this->id'
                    LIMIT
                           1";
        return parent::one($_sql);
    }
    //通过审核
    public function setStateOk(){
        $_sql="UPDATE
                cms_link
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
                    cms_link
        SET
                    state=0
        WHERE
                    id='$this->id'
        LIMIT
        1";
        return parent::aud($_sql);
    }
    public function getAllLink(){
        
        $_sql="SELECT
                id,
                webname,
                weburl,
                weburl fullweburl,
                logourl,
                logourl fulllogourl,
                type,
                user,
                state
        FROM
                cms_link
        ORDER BY
                date
        DESC
        $this->limit";
        return parent::all($_sql);
    }
    public function addLink(){
        
        $_sql="INSERT INTO cms_link(
                                    webname,
                                    weburl,
                                    logourl,
                                    user,
                                    state,
                                    type,
                                    date
                                    ) values(
                                    '$this->webname',
                                    '$this->weburl',
                                    '$this->logourl',
                                    '$this->user',
                                    '$this->state',
                                    '$this->type',
                                    NOW()
                                    )";
        return parent::aud($_sql);
        
    }
    public function deleteLink(){
        
        $_sql="DELETE FROM
        cms_link
        WHERE id='$this->id'
        LIMIT 1";
        return parent::aud($_sql);
    }
    public function updateLink(){
        
        $_sql="UPDATE cms_link
        SET
        webname='$this->webname',
        weburl='$this->weburl',
        logourl='$this->logourl',
        user='$this->user',
        type='$this->type'
        WHERE
        id='$this->id'
        LIMIT 1";
        return parent::aud($_sql);
    }
   
}