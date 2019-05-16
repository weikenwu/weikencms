<?php
class LevelAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new LevelModel());
        
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
        //$page=new Page($this->_mode->getLevelTotal(),PAGE_SIZE);
        parent::page($this->_mode->getLevelTotal());
        $this->_tpl->assign("show",true);
        $this->_tpl->assign("title","等级列表");
        $this->_tpl->assign("AllLevel", $this->_mode->getAllLevel());
        //$this->_tpl->assign("page", $page->showpage());
    }
    private function add(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['level_name'])) Tool::alertBack("警告：等级名称不得为空！");
            if(Validate::checkLength($_POST['level_name'], 2,'min')) Tool::alertBack("警告：等级名称不得小于2位!");
            if(Validate::checkLength($_POST['level_name'], 20,'max')) Tool::alertBack("警告：等级名称不得大于20位!");
            if(Validate::checkLength($_POST['level_info'], 200,'max')) Tool::alertBack("警告：描述不得大于200位!");
            $this->_mode->_level_name=$_POST['level_name'];
            if($this->_mode->getOneLevel()) Tool::alertBack("警告：此等级名称已存在！");
            $this->_mode->_level_info=$_POST['level_info'];
            $this->_mode->premission=implode(',', $_POST['premission']);
          
            if($this->_mode->addLevel()){
                Tool::alertLocation("恭喜你添加成功！", "level.php?action=show");
            }else {
                Tool::alertBack("很遗憾，新增管理员失败!");
            }
        }
        $this->_tpl->assign("add",true);
        $this->_tpl->assign("PREV_URL",PREV_URL);
        $this->_tpl->assign("title","新增等级");
        $_premission=new PremissionModel();
        $this->_tpl->assign('AllPremission',$_premission->getAllPremission());
    }
    private function update(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['level_name'])) Tool::alertBack("警告：等级名称不得为空！");
            if(Validate::checkLength($_POST['level_name'], 2,'min')) Tool::alertBack("警告：等级名称不得小于2位!");
            if(Validate::checkLength($_POST['level_name'], 20,'max')) Tool::alertBack("警告：等级名称不得大于20位!");
            if(Validate::checkLength($_POST['level_info'], 200,'max')) Tool::alertBack("警告：描述不得大于200位!");
            $this->_mode->id=$_POST['id'];
            $this->_mode->_level_name=$_POST['level_name'];
            $this->_mode->_level_info=$_POST['level_info'];
            $this->_mode->premission=implode(',', $_POST['premission']);
            $this->_mode->updateLevel()?Tool::alertLocation("恭喜修改成功！", "level.php?action=show"):Tool::alertBack("修改失败");
        }
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $_level=$this->_mode->getOneLevel();
            is_object($_level)?true:Tool::alertBack("ID有误");
            //$_premission=new PremissionModel();
            //$_object=$_premission->getAllPremission();
            $_object=$_level->premission;
            $this->premission($_object);
            //$this->_tpl->assign('AllPremission',$_object);
            $this->_tpl->assign("level_name",$_level->level_name);
            $this->_tpl->assign("id",$_level->id);
            $this->_tpl->assign("level_info",$_level->level_info);
            $this->_tpl->assign("update",true);
            $this->_tpl->assign("title","修改等级");
            $this->_tpl->assign("PREV_URL",PREV_URL);
        }else {
            Tool::alertBack("非法操作");
        }
    }
    private function premission($_object){
        $_premission = new PremissionModel();
        if ($_object) {
            $_checkpre = $_premission->getOnePremissionByid($_object);
            $_nocheckpre = $_premission->getOnePremissionNoByid($_object);
        } else {
            $_nocheckpre = $_premission->getAllPremission();
        }
        
        // print_r($_nocheckpre);
        // exit;
        if ($_checkpre) {
            foreach ($_checkpre as $_value) {
                $_html .= '<input type="checkbox" checked="checked" name="premission[]" value="' . $_value->id . '"/>' . $_value->name;
            }
        }
        
        foreach ($_nocheckpre as $_value) {
            $_html .= '<input type="checkbox" name="premission[]" value="' . $_value->id . '"/>' . $_value->name;
        }
        $this->_tpl->assign('premission', $_html);

        
    }
    private function delete(){
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $manage=new ManageModel();
            $manage->_level=$this->_mode->id;
            if($manage->getOneManage()) Tool::alertBack("此等级有用户存在，不能被删除！");
            $this->_mode->deleteLevel()?Tool::alertLocation("删除成功！", PREV_URL):Tool::alertBack("删除失败！");
        }else {
            Tool::alertBack("非法操作!");
        }
//         $this->_tpl->assign("delete",true);
//         $this->_tpl->assign("title","删除等级");
    }
    
}