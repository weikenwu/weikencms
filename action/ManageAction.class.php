<?php
class ManageAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new ManageModel());
        
    }
    
    public function _action(){
        //if($_GET['action']=="login") $this->login();    
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
//             case "logout":
//                 $this->logout();
//                 break;
            default:
                Tool::alertBack("非法操作");
        }
        
    }
    

    
    private function show(){
        $page=new Page($this->_mode->getManageTotal(),PAGE_SIZE);
        //echo $page->total;
        $this->_mode->_limit=$page->limit;
        $this->_tpl->assign("show",true);
        $this->_tpl->assign("title","管理员列表");
        $this->_tpl->assign("AllManage", $this->_mode->getAllManage());
        $this->_tpl->assign("page", $page->showpage());
    }
    private function add(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['admin_user'])) Tool::alertBack("警告：用户名不得为空！");
            if(Validate::checkLength($_POST['admin_user'], 2,'min')) Tool::alertBack("警告：用户名不得小于2位!");
            if(Validate::checkLength($_POST['admin_user'], 20,'max')) Tool::alertBack("警告：用户名不得大于20位!");
            if(Validate::checkNull($_POST['admin_pass'])) Tool::alertBack("警告：密码不得为空！");
            if(Validate::checkLength($_POST['admin_pass'], 6,'min')) Tool::alertBack("警告：密码不得小于6位!");
            if(Validate::checkEquals($_POST['admin_pass'], $_POST['admin_notpass'])) Tool::alertBack("警告：密码不一致!");
            $this->_mode->_admin_user=$_POST['admin_user'];
            if($this->_mode->getOneManage()) Tool::alertBack("用户名已存在!");
            $this->_mode->_admin_pass=sha1($_POST['admin_pass']);
            $this->_mode->_level=$_POST['level'];
            if($this->_mode->addManage()){
                Tool::alertLocation("恭喜你添加成功！", "manage.php?action=show");
            }else {
                Tool::alertBack("很遗憾，新增管理员失败!");
            }
        }
        $this->_tpl->assign("add",true);
        $this->_tpl->assign("title","新增管理员");
        $level=new LevelModel();
        $this->_tpl->assign("AllLevel",$level->getAllLevel());
    }
    private function update(){
        if(isset($_POST['send'])){
            $this->_mode->id=$_POST['id'];
            if($_POST['admin_pass']==''){
                $this->_mode->_admin_pass=$_POST['pass'];
            }else {
                if(Validate::checkLength($_POST['admin_pass'],6,'min')) Tool::alertBack("密码不能小于6位！");
                $this->_mode->_admin_pass=sha1($_POST['admin_pass']);
            }
            
            $this->_mode->_level=$_POST['level'];
            $this->_mode->updateManage()?Tool::alertLocation("恭喜修改成功！", "manage.php?action=show"):Tool::alertBack("修改失败");
        }
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $_manage=$this->_mode->getOneManage();
            is_object($_manage)?true:Tool::alertBack("ID有误");
            $this->_tpl->assign("admin_user",$_manage->admin_user);
            $this->_tpl->assign("admin_pass",$_manage->admin_pass);
            $this->_tpl->assign("id",$_manage->id);
            $this->_tpl->assign("level",$_manage->level);
            $this->_tpl->assign("update",true);
            $this->_tpl->assign("title","修改管理员");
            $level=new LevelModel();
            $this->_tpl->assign("AllLevel",$level->getAllLevel());
        }else {
            Tool::alertBack("非法操作");
        }
    }
    private function delete(){
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $this->_mode->deleteManage()?Tool::alertLocation("删除成功！", "manage.php?action=show"):Tool::alertBack("删除失败！");
        }else {
            Tool::alertBack("非法操作!");
        }
        $this->_tpl->assign("delete",true);
        $this->_tpl->assign("title","删除管理员");
    }
    
}