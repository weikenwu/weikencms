<?php
class RotatainAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new RotatainModel());
        
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
            case "state":
                $this->state();
                break;
            case "delete":
                $this->delete();
                break;
            default:
                Tool::alertBack("非法操作");
        }
        
    }
    // 单个审核
    private function state()
    {
        if (isset($_GET[id])) {
            $this->_mode->id = $_GET['id'];
            if (! $this->_mode->getOneRotatain())
                Tool::alertBack('警告：不存在此轮播！');
                if ($_GET['type'] == 'ok') {
                    if ($this->_mode->setStateOk()) {
                        Tool::alertLocation(null, PREV_URL);
                    } else {
                        Tool::alertBack("警告：审核失败！");
                    }
                } elseif ($_GET['type'] == 'cancel') {
                    if ($this->_mode->setStateCancel()) {
                        Tool::alertLocation(null, PREV_URL);
                    } else {
                        Tool::alertBack("警告：取消审核失败！");
                    }
                } else {
                    Tool::alertBack('警告：非法操作');
                }
        } else {
            Tool::alertBack('警告：非法操作!');
        }
    }
    private function show(){
        parent::page($this->_mode->getRotatainTotal(),PAGE_SIZE);
        $this->_tpl->assign("show",true);
        $this->_tpl->assign("title","轮播器列表");
        $_object=$this->_mode->getAllRatatain();
        Tool::subStr($_object, 'title', 20, 'utf-8');
        Tool::subStr($_object, 'link', 20, 'utf-8');
        if($_object){
            foreach ($_object as $_value){
                if(empty($_value->state)){
                    $_value->state='<span class="red">[否]</span> | <a href="rotatain.php?action=state&type=ok&id='.$_value->id.'">确定</a>';
                }else {
                    $_value->state='<span class="green">[是]</span> | <a href="rotatain.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
                }
            }
        }
        $this->_tpl->assign("AllRotatain", $_object);
    }
    private function add(){
        if($_POST['send']){
            if(Validate::checkNull($_POST['thumbnail'])) Tool::alertBack("警告：轮播图不得为空！");
            if(Validate::checkNull($_POST['link'])) Tool::alertBack("警告：链接不得为空！");
            if(Validate::checkLength($_POST['title'], 20,'max')) Tool::alertBack("警告：标题不得大于20位!");
            if(Validate::checkLength($_POST['info'], 200,'max')) Tool::alertBack("警告：描述不得大于200位!");
            $this->_mode->title=$_POST['title'];
            $this->_mode->thumbnail=$_POST['thumbnail'];
            $this->_mode->info=$_POST['info'];
            $this->_mode->link=$_POST['link'];
            $this->_mode->addRotatain() ? Tool::alertLocation("恭喜添加轮播图成功", "?action=show") : Tool::alertBack("添加轮播图失败!");
           
        }
        $this->_tpl->assign("add",true);
        $this->_tpl->assign("PREV_URL",PREV_URL);
        $this->_tpl->assign("title","新增轮播器");
        
    }
    private function update(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['thumbnail'])) Tool::alertBack("警告：轮播图不得为空！");
            if(Validate::checkNull($_POST['link'])) Tool::alertBack("警告：链接不得为空！");
            if(Validate::checkLength($_POST['title'], 20,'max')) Tool::alertBack("警告：标题不得大于20位!");
            if(Validate::checkLength($_POST['info'], 200,'max')) Tool::alertBack("警告：描述不得大于200位!");
            $this->_mode->id=$_GET['id'];
            $this->_mode->title=$_POST['title'];
            $this->_mode->info=$_POST['info'];
            $this->_mode->thumbnail=$_POST['thumbnail'];
            $this->_mode->link=$_POST['link'];
            $this->_mode->updateRotatain()?Tool::alertLocation("恭喜修改成功！", "?action=show"):Tool::alertBack("修改失败");
        }
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $_rotatain=$this->_mode->getOneRotatain();
            is_object($_rotatain)?true:Tool::alertBack("ID有误");
            $this->_tpl->assign("titlec",$_rotatain->title);
            $this->_tpl->assign("id",$_rotatain->id);
            $this->_tpl->assign("thumbnail",$_rotatain->thumbnail);
            $this->_tpl->assign("info",$_rotatain->info);
            $this->_tpl->assign("link",$_rotatain->link);
            $this->_tpl->assign("update",true);
            $this->_tpl->assign("title","修改轮播器");
            $this->_tpl->assign("PREV_URL",PREV_URL);
        }else {
            Tool::alertBack("非法操作");
        }
    }
    private function delete(){
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $this->_mode->deleteRotatain()?Tool::alertLocation("删除成功", PREV_URL) : Tool::alertBack("删除失败");
        }else {
            Tool::alertBack("警告：非法操作！");
        }
    }
    
}