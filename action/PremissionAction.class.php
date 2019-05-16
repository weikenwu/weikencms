<?php
class PremissionAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new PremissionModel());
        
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
            default:
                Tool::alertBack("非法操作");
        }
        
    }
    private function show(){
        parent::page($this->_mode->getPremissionTotal());
        $this->_tpl->assign("show",true);
        $this->_tpl->assign("title","权限列表");
        $this->_tpl->assign("AllPremission", $this->_mode->getAllLimitPremission());
    }
    private function add(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['name'])) Tool::alertBack("警告：权限名称不得为空！");
            if(Validate::checkLength($_POST['name'], 2,'min')) Tool::alertBack("警告：权限名称不得小于2位!");
            if(Validate::checkLength($_POST['name'], 100,'max')) Tool::alertBack("警告：权限名称不得大于100位!");
            if(Validate::checkLength($_POST['info'], 200,'max')) Tool::alertBack("警告：描述不得大于200位!");
            $this->_mode->name=$_POST['name'];
            if($this->_mode->getOnePremission()) Tool::alertBack("警告：此权限名称已存在！");
            $this->_mode->info=$_POST['info'];
            
            if($this->_mode->addPremission()){
                Tool::alertLocation("恭喜你添加成功！", "?action=show");
            }else {
                Tool::alertBack("很遗憾，新增失败!");
            }
        }
        $this->_tpl->assign("add",true);
        $this->_tpl->assign("PREV_URL",PREV_URL);
        $this->_tpl->assign("title","新增权限");
        
    }
    private function update(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['name'])) Tool::alertBack("警告：权限名称不得为空！");
            if(Validate::checkLength($_POST['name'], 2,'min')) Tool::alertBack("警告：权限名称不得小于2位!");
            if(Validate::checkLength($_POST['name'], 100,'max')) Tool::alertBack("警告：权限名称不得大于100位!");
            if(Validate::checkLength($_POST['info'], 200,'max')) Tool::alertBack("警告：描述不得大于200位!");
            $this->_mode->name=$_POST['name'];
            if($this->_mode->getOnePremission()) Tool::alertBack("警告：此权限名称已存在！");
            $this->_mode->id=$_POST['id'];
            $this->_mode->info=$_POST['info'];
            $this->_mode->updatePremission()?Tool::alertLocation("恭喜修改成功！", $_POST['PREV_URL']):Tool::alertBack("修改失败");
        }
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $_premission=$this->_mode->getOnePremission();
            if(!$_premission) Tool::alertBack("ID有误");
            $this->_tpl->assign("name",$_premission->name);
            $this->_tpl->assign("id",$_premission->id);
            $this->_tpl->assign("info",$_premission->info);
            $this->_tpl->assign("update",true);
            $this->_tpl->assign("title","修改权限");
            $this->_tpl->assign("PREV_URL",PREV_URL);
        }else {
            Tool::alertBack("非法操作");
        }
    }
    private function delete(){
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $this->_mode->deletePremission()?Tool::alertLocation("删除成功！", PREV_URL):Tool::alertBack("删除失败！");
        }else {
            Tool::alertBack("非法操作!");
        }
    }
    
}