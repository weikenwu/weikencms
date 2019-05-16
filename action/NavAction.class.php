<?php
class NavAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new NavModel());
        
    }
    
    public function _action(){
             
        //业务控制流程
        switch ($_GET['action']){
            case "show":
                $this->show();
                break;
            case "add":
                $this->add();
                break;
            case "update":
                $this->update();
                break;
            case "delete":
                $this->delete();
                break;
            case "addchild":
                $this->addchild();
                break;
            case "showchild":
                $this->showchild();
                break;
            case "sort":
                $this->sort();
                break;
            default:
                Tool::alertBack("非法操作");
        }
        
    }
    public function showfront(){
        $this->_tpl->assign('FrontNav',$this->_mode->getFrontNav());
    }
    private function sort(){
        if(isset($_POST['send'])){
            $this->_mode->sort=$_POST['sort'];
            if($this->_mode->setNavSort()) Tool::alertLocation(null, PREV_URL);        
        }
    }
    private function addchild(){
        if(isset($_POST['send'])){
            $this->add();
        }
        if($_GET['id']){
         $this->_mode->id=$_GET['id'];
         $_nav=$this->_mode->getOneNav();
         if(!$_nav) Tool::alertBack("警告：导航传值ID有误！");
        $this->_tpl->assign("addchild",true);
        $this->_tpl->assign("id",$this->_mode->id);
        $this->_tpl->assign("prev_name",$_nav->nav_name);
        $this->_tpl->assign("title","新增子导航");
        $this->_tpl->assign("PREV_URL",PREV_URL);
        }
    }
    private function showchild(){
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $_nav=$this->_mode->getOneNav();
            if(!$_nav) Tool::alertBack("警告：导航传值ID有误！");
            $page=new Page($this->_mode->getNavChildTotal(),PAGE_SIZE);
            $this->_mode->limit=$page->limit;
            $this->_tpl->assign("showchild",true);
            $this->_tpl->assign("title","子导航列表");
            $this->_tpl->assign("prev_name",$_nav->nav_name);
            $this->_tpl->assign("id",$_nav->id);
            $this->_tpl->assign("AllChildNav", $this->_mode->getAllChildNav());
            $this->_tpl->assign("PREV_URL",PREV_URL);
            $this->_tpl->assign("page", $page->showpage());
        }
        
    }
    private function show(){
        $page=new Page($this->_mode->getNavTotal(),PAGE_SIZE);
        $this->_mode->limit=$page->limit;
        $this->_tpl->assign("show",true);
        $this->_tpl->assign("title","导航列表");
        $this->_tpl->assign("AllNav", $this->_mode->getAllNav());
        $this->_tpl->assign("page", $page->showpage());
    }
    private function add(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['nav_name'])) Tool::alertBack("警告：导航名称不得为空！");
            if(Validate::checkLength($_POST['nav_name'], 2,'min')) Tool::alertBack("警告：导航名称不得小于2位!");
            if(Validate::checkLength($_POST['nav_name'], 20,'max')) Tool::alertBack("警告：导航名称不得大于20位!");
            if(Validate::checkLength($_POST['nav_info'], 200,'max')) Tool::alertBack("警告：描述不得大于200位!");
            $this->_mode->nav_name=$_POST['nav_name'];
            $this->_mode->pid=$_POST['pid'];
            if($this->_mode->getOneNav()) Tool::alertBack("警告：此导航名称已存在！");
            $this->_mode->nav_info=$_POST['nav_info'];
            $_returnurl=$this->_mode->pid?"nav.php?action=showchild&id=".$this->_mode->pid:"nav.php?action=show";
            if($this->_mode->addNav()){
                Tool::alertLocation("恭喜你添加成功！", $_returnurl);
            }else {
                Tool::alertBack("很遗憾，新增管理员失败!");
            }
        }
        $this->_tpl->assign("add",true);
        $this->_tpl->assign("title","新增导航");
        $this->_tpl->assign("PREV_URL",PREV_URL);
        
    }
    private function update(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['nav_name'])) Tool::alertBack("警告：导航名称不得为空！");
            if(Validate::checkLength($_POST['nav_name'], 2,'min')) Tool::alertBack("警告：导航名称不得小于2位!");
            if(Validate::checkLength($_POST['nav_name'], 20,'max')) Tool::alertBack("警告：导航名称不得大于20位!");
            if(Validate::checkLength($_POST['nav_info'], 200,'max')) Tool::alertBack("警告：描述不得大于200位!");
            $this->_mode->id=$_POST['id'];
            $this->_mode->nav_name=$_POST['nav_name'];
            $this->_mode->nav_info=$_POST['nav_info'];
            $this->_mode->updateNav()?Tool::alertLocation("恭喜修改成功！", $_POST['prev_url']):Tool::alertBack("修改失败");
        }
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $_nav=$this->_mode->getOneNav();
            is_object($_nav)?true:Tool::alertBack("ID有误");
            $this->_tpl->assign("nav_name",$_nav->nav_name);
            $this->_tpl->assign("id",$_nav->id);
            $this->_tpl->assign("nav_info",$_nav->nav_info);
            $this->_tpl->assign("update",true);
            $this->_tpl->assign("title","修改导航");
            $this->_tpl->assign("PREV_URL",PREV_URL);
        }else {
            Tool::alertBack("非法操作");
        }
    }
    private function delete(){
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $this->_mode->deleteNav()?Tool::alertLocation("删除成功！", PREV_URL):Tool::alertBack("删除失败！");
        }else {
            Tool::alertBack("非法操作!");
        }
        $this->_tpl->assign("delete",true);
        $this->_tpl->assign("title","删除导航");
    }
    
}