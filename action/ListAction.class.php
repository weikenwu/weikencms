<?php
class ListAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl);
        
    }
    public function _action(){
        $this->getNav();
        $this->getListContent();
    }
    //获取前台列表显示
    public function getListContent(){
        if(isset($_GET['id'])){
            parent::__construct($this->_tpl,new ContentModel());
            $_nav=new NavModel();
            $_nav->id=$_GET['id'];            
            $_navid=$_nav->getNavChildId();
            if($_navid){
                $this->_mode->nav=Tool::objArrOfStr($_navid, "id");
            }else {
                $this->_mode->nav=$_nav->id;
            }
            parent::page($this->_mode->getListContentTotal(),ARTICLE_SIZE);
            
            $_object=$this->_mode->getListContent();
            Tool::subStr($_object, 'info', 120, 'utf-8');
            Tool::subStr($_object, 'title', 35, 'utf-8');//对象数组无需引用，默认引用传值
            if($_object){
                foreach ($_object as $_value){
                    if(empty($_value->thumbnail)) $_value->thumbnail='images/myface.png';
                }
            }
//             if(IS_CACHE){
//                 if($_object){
//                 foreach ($_object as $_value){
//                     $_value->count='<script type="text/javascript">getContentCount();</script>';
//                 }
//                 }
//             }
//             echo $this->_mode->nav;
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
    public function getNav(){
        if(isset($_GET['id'])){
            $_nav=new NavModel();
            $_nav->id=$_GET['id'];
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
        }else {
            Tool::alertBack("警告：非法操作的ID");
        }
    }
    
    
}