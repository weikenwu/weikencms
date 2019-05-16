<?php
class DetailsAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl);
        
    }
    public function _action(){
       $this->getDetails();
    }
    
    //获取文档的详细内容
    private function getDetails(){
        if(isset($_GET['id'])){
            parent::__construct($this->_tpl,new ContentModel());
            $this->_mode->id=$_GET['id'];
            //$this->_mode->setContentCount();        
            $_content=$this->_mode->getOneContent();
            if(!$_content) Tool::alertBack("警告：不存在此文档！");
            $_comment=new CommentModel();
            $_comment->cid=$this->_mode->id;
            $this->_tpl->assign('titlec',$_content->title);
            $this->_tpl->assign('id',$_content->id);
            if(IS_CACHE){
//                 $this->_tpl->assign('comment','<script type="text/javascript">getCommentCount();</script>');
                $this->_tpl->assign('count','<script type="text/javascript">getContentCount();</script>');    
            }else {
                
                
                $this->_tpl->assign('count',$_content->count);
            }
            $this->_tpl->assign('comment',$_comment->getCommentTotal());
            $_object=$_comment->getNewThreeComment();
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
            $this->_tpl->assign('NewThreeComment',$_object);
            $this->_tpl->assign('author',$_content->author);
            $this->_tpl->assign('date',$_content->date);
            $this->_tpl->assign('source',$_content->source);
            $this->_tpl->assign('info',$_content->info);
            $_tarArr=explode(',', $_content->tag);
            
            if(is_array($_tarArr)){
                foreach ($_tarArr as $_value){
                    $_content->tag=str_replace($_value, '<a href="search.php?type=3&inputkeyword='.$_value.'" target="_blank">'.$_value.'</a>', $_content->tag);
                }
            }
            //print_r($_content->tag);
            $this->_tpl->assign('tag',$_content->tag);
            $this->_tpl->assign('content',Tool::unHtml($_content->content));
            $this->getNav($_content->nav);
            
            $this->_mode->nav=$_content->nav;
            $this->_tpl->assign('AllListContent',$_object);
            $_object=$this->_mode->getMonthNavRec();
            $this->setObject($_object);
            $this->_tpl->assign('MonthNavRec',$_object);
            
            $_object=$this->_mode->getMonthNavHot();
            $this->setObject($_object);
            $this->_tpl->assign('MonthNavHot',$_object);
            
            $_object=$this->_mode->getMonthNavPic();
            $this->setObject($_object);
            $this->_tpl->assign('MonthNavPic',$_object);
            
        }else {
            Tool::alertBack("警告：非法操作！");
        }
    }
    private function setObject(&$_object){
        if($_object){
            Tool::subStr($_object, 'title', 15, 'utf-8');
            Tool::objDate($_object,'date');
        }
    }
    //获取前台导航
    public function getNav($_id){
        
            $_nav=new NavModel();
            $_nav->id=$_id;
            $_navo=$_nav->getOneNav();
            if($_navo){
                //主导航
                if($_navo->nnav_name) $_nav1="<a href='list.php?id=$_navo->iid'>".$_navo->nnav_name."</a> &gt;";
                $_nav2="<a href='list.php?id=$_navo->id'>".$_navo->nav_name."</a>";
                $this->_tpl->assign("nav",$_nav1.$_nav2);
                //子导航
                $this->_tpl->assign("childnav",$_nav->getAllFrontChildNav());
            }else {
                Tool::alertBack("警告：此导航不存在");
            }
        
    }
}