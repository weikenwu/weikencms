<?php
class IndexAction extends Action{
    
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl);
        
    }
    public function _action(){
        $this->login();
        $this->laterUser();
        $this->showList();
        $this->getShowRotatain();
        $this->getVote();
    }
    //获取投票
    private function getVote(){
        $_vote=new VoteModel();
        $this->_tpl->assign('vote_title',$_vote->getVoteTitle()->title);
        $this->_tpl->assign('vote_item',$_vote->getVoteItem());
    }
    //获取轮播图
    private function getShowRotatain(){
        parent::__construct($this->_tpl,new RotatainModel());
        $_object=$this->_mode->getNewRotatain();
        $this->_tpl->assign('NewRotatain',$_object);
    }
    //最近登录的会员
    private function laterUser(){
        $_user=new UserModel();
        $this->_tpl->assign('AllLaterUser',$_user->getLaterUser());
    }
    //显示推荐，本月热点，本月评论，头条
    private function showList(){
        parent::__construct($this->_tpl,new ContentModel());
        $_object=$this->_mode->getNewRecList();
        Tool::subStr($_object, 'title', 16, 'utf-8');
        Tool::objDate($_object, 'date');
        $this->_tpl->assign('NewRecList',$_object);
        
        $_object=$this->_mode->getMonthHotList();
        Tool::subStr($_object, 'title', 16, 'utf-8');
        Tool::objDate($_object, 'date');
        $this->_tpl->assign('MonthHotList',$_object);
        
        $_object=$this->_mode->getMonthCommentList();
        Tool::subStr($_object, 'title', 16, 'utf-8');
        Tool::objDate($_object, 'date');
        $this->_tpl->assign('MonthCommentList',$_object);
        
        $_object=$this->_mode->getPicList();
        Tool::subStr($_object, 'title', 20, 'utf-8');
        $this->_tpl->assign('PicList',$_object);
        
        $_object=$this->_mode->getNewList();
        Tool::subStr($_object, 'title', 25, 'utf-8');
        Tool::objDate($_object, 'date');
        $this->_tpl->assign('NewList',$_object);
        
        $_object=$this->_mode->getNewTop();
        $this->_tpl->assign('TopTitle',Tool::subStr($_object->title, null, 25, 'utf-8'));
        $this->_tpl->assign('TopInfo',Tool::subStr($_object->info, null, 80, 'utf-8'));
        $this->_tpl->assign('TopId',$_object->id);
        
        $_object=$this->_mode->getNewTopList();
        Tool::subStr($_object, 'title', 14, 'utf-8');
        Tool::objDate($_object, 'date');
        if($_object){
            $_i=1;
            foreach ($_object as $_value){
                if($_i%2==0){
                    $_value->line='';
                }else {
                    $_value->line='|';
                }
                $_i++;
            }
        }
        $this->_tpl->assign('NewTopList',$_object);
        $_nav=new NavModel();
        $_object=$_nav->getFourNav();
        if($_object){
            $_i=1;
            foreach ($_object as $_value){
                if($_i % 2 == 0){
                    $_value->class='list right bottom';
                }else {
                    $_value->class='list bottom';
                }
                $_i++;
                $this->_mode->nav=$_value->id;
                $_navlist=$this->_mode->getNewNavList();
                Tool::objDate($_navlist, 'date');
                Tool::subStr($_navlist, 'title', 20, 'utf-8');
                $_value->list=$_navlist;
            }
        }
        $this->_tpl->assign('FourNav',$_object);
        //print_r($_object);
    }
    //登录模块
    private function login(){
        $_cookie=new Cookie('user');
        $_user=$_cookie->getCookie();
        $_cookie=new Cookie('face');
        $_face=$_cookie->getCookie();
        if($_user && $_face){
            $this->_tpl->assign('user',Tool::subStr($_user, null, 8, 'utf-8'));
            $this->_tpl->assign('face',$_face);
        }else {
            $this->_tpl->assign('login',true);
        }
        $this->_tpl->assign('cache',IS_CACHE);
        if(IS_CACHE){
            $this->_tpl->assign('member','<script type="text/javascript">getIndexLogin();</script>');
        }
    }
    
    
    
}