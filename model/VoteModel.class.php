<?php
//投票实体类
class VoteModel extends Model{
    private $id;
    private $title;
    private $info;
    private $state;
    private $vid;
    private $count;
    private $date;
    private $limit;

    //拦截器
    private function __set($_key,$_value){
        $this->$_key=Tool::mysqlString($_value);
    }
    //取值
    private function __get($_name){
            return $this->$_name;
    }
  
    //获取总票数
    public function getVoteSum(){
        $_sql="SELECT sum(count) c From cms_vote WHERE vid=(SELECT id FROM cms_vote WHERE state=1 LIMIT 1)";
        return parent::one($_sql);
    }
    //累计投票
    public function setCount(){
        $_sql="UPDATE 
                        cms_vote 
                    SET 
                        count=count+1 
                    WHERE 
                        id=$this->id";
        return parent::aud($_sql);
    }
    //获取首选标题
    public function getVoteTitle(){
        $_sql="SELECT 
                        id,
                        title 
                    FROM 
                        cms_vote 
                    WHERE 
                        state=1 
                    LIMIT 
                        1";
        return parent::one($_sql);
    }
    //获取首选标题项目
    public function getVoteItem(){
        $_sql="SELECT 
                        id,
                        title,
                        count 
                    FROM 
                        cms_vote 
                    WHERE 
                        vid=(SELECT id FROM cms_vote WHERE state=1 LIMIT 1)";
        return parent::all($_sql);
    }
    public function  getVoteTotal(){
        $_sql="SELECT COUNT(*) FROM cms_vote WHERE vid=0";
        return parent::total($_sql);
    }
    public function  getVoteTotalChild(){
        $_sql="SELECT COUNT(*) FROM cms_vote WHERE vid='$this->id'";
        return parent::total($_sql);
    }
    public function getAllVote(){
        
        $_sql="SELECT
                        c.id,
                        c.title,
                        c.info,
                        c.state,
                        (SELECT SUM(count) FROM cms_vote WHERE vid=c.id) pcount
                FROM
                        cms_vote c
                WHERE
                        c.vid=0
                ORDER BY
                        c.date 
                DESC
                        $this->limit";
        return parent::all($_sql);
    }
    public function getAllVoteChild(){
        
        $_sql="SELECT
        id,
        title,
        info,
        count,
        state
        FROM
        cms_vote
        WHERE
        vid='$this->id'
        ORDER BY
        date DESC
        $this->limit";
        return parent::all($_sql);
    }
    public function getOneVote(){
        $_sql="SELECT id,title,info FROM cms_vote WHERE id='$this->id' LIMIT 1";
        return parent::one($_sql);
    }
    //通过审核
    public function setStateOk(){
        $_sql="UPDATE
        cms_vote
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
        cms_vote
        SET
        state=0
        WHERE
        state=1
        ";
        return parent::aud($_sql);
    }
    public function addVote(){
        
        $_sql="INSERT INTO cms_vote(
        title,
        info,
        state,
        vid,
        date
        ) values(
        '$this->title',
        '$this->info',
        0,
        '$this->vid',
        NOW()
        )";
        return parent::aud($_sql);
        
    }
    public function updateVote(){
        
        $_sql="UPDATE cms_vote
        SET
        title='$this->title',
        info='$this->info'
        WHERE
        id='$this->id'
        LIMIT 1";
        return parent::aud($_sql);
    }
    public function deleteVote(){
        
        $_sql="DELETE FROM
        cms_vote
        WHERE id='$this->id'
          OR  vid='$this->id'
        ";
        return parent::aud($_sql);
    }

   
}