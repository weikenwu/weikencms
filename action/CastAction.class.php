<?php
class CastAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl,new VoteModel());
        
    }
    public function _action(){
        $this->setCount();
        $this->getVote();
    }
    //累计
    private function setCount(){
        if(isset($_POST['send'])){
            if(!isset($_POST['vote'])) Tool::alertClose("请选择投票项目，谢谢！");
            if($_COOKIE['ip']==$_SERVER['REMOTE_ADDR ']){
                if(time()-$_COOKIE['time']<86400){
                    Tool::alertLocation("警告：您今天已经参与投票，请勿重复投票，谢谢！",'cast.php');
                }
            }
            $this->_mode->id=$_POST['vote'];
            $this->_mode->setCount();
            setcookie('ip',$_SERVER['REMOTE_ADDR ']);
            setcookie('time',time());
            Tool::alertLocation("恭喜，投票成功", 'cast.php');
        }
    }
    //获取投票
    private function getVote(){
        $_vote=new VoteModel();
        $_sum=$_vote->getVoteSum()->c;
        $_width=400;
        $this->_tpl->assign('vote_title',$_vote->getVoteTitle()->title);
        $this->_tpl->assign('width',$_width);
        $_object=$_vote->getVoteItem();
        if($_object){
            $_i=1;
            foreach ($_object as $_value){
                $_value->percent=round($_value->count/$_sum * 100,2).'%';
                $_value->picwidth=$_value->count/$_sum * $_width;
                $_value->picnum=$_i;
                $_i++;
            }
        }
        $this->_tpl->assign('vote_item',$_object);
    }
}