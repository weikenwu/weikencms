<?php
class FeedBackAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl);
        
    }
    
    public function _action(){
     $this->addComment(); 
     $this->setCount();
     $this->showComment();       
    }
        
    //新增评论
    private function addComment(){
        if(isset($_POST['send'])){
            $_url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            if(PREV_URL==$_url){
                if(Validate::checkNull($_POST['content'])) Tool::alertBack("警告：内容不得为空！");
                if(Validate::checkLength($_POST['content'], 255,'max')) Tool::alertBack("警告：内容不得大于255位!");
                if(Validate::checkLength($_POST['code'], 4, "equals")) Tool::alertBack("警告：验证码必须4位！");
                if(Validate::checkEquals(strtolower($_POST['code']), $_SESSION['code'])) Tool::alertBack("警告：验证码不一致");
            }else {
            if(Validate::checkNull($_POST['content'])) Tool::alertClose("警告：内容不得为空！");
            if(Validate::checkLength($_POST['content'], 255,'max')) Tool::alertClose("警告：内容不得大于255位!");
            if(Validate::checkLength($_POST['code'], 4, "equals")) Tool::alertClose("警告：验证码必须4位！");
            if(Validate::checkEquals(strtolower($_POST['code']), $_SESSION['code'])) Tool::alertClose("警告：验证码不一致");
            }
            parent::__construct($this->_tpl,new CommentModel());
            $_cookie=new Cookie('user');
            if($_cookie->getCookie()){
                $this->_mode->user=$_cookie->getCookie();
            }else {
                $this->_mode->user='游客';
            }
            $this->_mode->manner=$_POST['manner'];
            $this->_mode->content=$_POST['content'];
            $this->_mode->cid=$_GET['cid'];
            $this->_mode->addComment() ? Tool::alertLocation("新增成功！", 'feedback.php?cid='.$this->_mode->cid) : Tool::alertLocation("新增失败！", 'feedback.php?cid='.$this->_mode->cid);
        }
    }
    
    private function  showComment(){
        if (isset($_GET['cid'])) {
            parent::__construct($this->_tpl, new CommentModel());
            $this->_mode->cid = $_GET['cid'];
            $_content=new ContentModel();
            $_content->id=$_GET['cid'];
            if(!$_content->getOneContent()) Tool::alertClose("警告：不存在评论的文档！");
            parent::page($this->_mode->getCommentTotal());
            $_object = $this->_mode->getAllComment();
            $_object2=$this->_mode->getHotThreeComment();
            $_object3=$_content->getHotTwentyComment();
            
            //var_dump($_object);
            $this->setObject($_object);
            $this->setObject($_object2);
            $this->_tpl->assign('titlec',$_content->getOneContent()->title);
            $this->_tpl->assign('info',$_content->getOneContent()->info);
            $this->_tpl->assign('cid',$this->_mode->cid);
            $this->_tpl->assign('AllComment',$_object);
            $this->_tpl->assign('HotThreeComment',$_object2);
            $this->_tpl->assign('HotTwentyComment',$_object3);
            $this->_tpl->assign('id',$_content->id);
        }else {
            Tool::alertBack("警告：非法操作！");
        }
    }
    private function setObject(&$_object){
        if ($_object) {
            foreach ($_object as $_value) {
                switch ($_value->manner) {
                    case - 1:
                        $_value->manner = '反对';
                        break;
                    case 0:
                        $_value->manner = '中立';
                        break;
                    case 1:
                        $_value->manner = '支持';
                        break;
                }
                if (empty($_value->face)) {
                    $_value->face = 'myface3.jpg';
                }
                if (!empty($_value->oppose)) {
                    $_value->oppose = '-'.$_value->oppose;
                }
            }
     
        }
    }
    //支持和反对
    private function setCount(){
        if(isset($_GET['cid']) && isset($_GET['id']) && isset($_GET['type'])){
            parent::__construct($this->_tpl, new CommentModel());
            $this->_mode->id=$_GET['id'];
            if(!$this->_mode->getOneComment()) Tool::alertBack("警告：无此条评论！");
            if($_GET['type']=='sustain'){
                $this->_mode->setSustain() ? Tool::alertLocation("支持成功！", 'feedback.php?cid='.$_GET['cid']) : Tool::alertLocation("支持失败！", 'feedback.php?cid='.$_GET['cid']);
            }
            if($_GET['type']=='oppose'){
                $this->_mode->setOppose() ? Tool::alertLocation("反对成功！", 'feedback.php?cid='.$_GET['cid']) : Tool::alertLocation("反对失败！", 'feedback.php?cid='.$_GET['cid']);
            }
        }
    }
    
}