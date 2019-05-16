<?php
class VoteAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new VoteModel());
        
    }
    
    public function _action(){
             
        //业务控制流程
        switch ($_GET['action']){
            case "show":
                $this->show();
                break;
            case "showchild":
                $this->showchild();
                break;
            case "add":
                $this->add();
                break;
            case "addchild":
                $this->addchild();
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
            if (! $this->_mode->getOneVote())
                Tool::alertBack('警告：不存在此投票！');
                if ($_GET['type'] == 'ok') {
                    $this->_mode->setStateCancel();
                    if ($this->_mode->setStateOk()) {
                        Tool::alertLocation(null, PREV_URL);
                    } else {
                        Tool::alertBack("警告：审核失败！");
                    }
                } else {
                    Tool::alertBack('警告：非法操作');
                }
        } else {
            Tool::alertBack('警告：非法操作!');
        }
    }
    private function show(){
        parent::page($this->_mode->getVoteTotal(),PAGE_SIZE);
        $this->_tpl->assign("show",true);
        $this->_tpl->assign("title","投票主题列表");
        $_object=$this->_mode->getAllVote();
        if($_object){
            foreach ($_object as $_value){
                if(empty($_value->state)){
                    $_value->state='<span class="red">[否]</span> | <a href="vote.php?action=state&type=ok&id='.$_value->id.'">确定</a>';
                }else {
                    $_value->state='<span class="green">[是]</span>';
                }
                if(empty($_value->pcount)){
                    $_value->pcount=0;
                }
            }
        }
        $this->_tpl->assign("AllVote", $_object);
    }
    
    private function showchild(){
        $this->_mode->id=$_GET['id'];
        $_vote=$this->_mode->getOneVote();
        if(!$_vote) Tool::alertBack("不存在此主题");
        parent::page($this->_mode->getVoteTotalChild(),PAGE_SIZE);
        $this->_tpl->assign("id",$_vote->id);
        $this->_tpl->assign("titlec",$_vote->title);
        $this->_tpl->assign("PREV_URL",PREV_URL);
        $this->_tpl->assign("showchild",true);
        $this->_tpl->assign("title","投票项目列表");
        $_object=$this->_mode->getAllVoteChild();
        $this->_tpl->assign("AllVoteChild", $_object);
    }
   
    private function add(){
        if(isset($_POST['send'])){
            $this->setAdd();
            $this->_mode->title=$_POST['title'];
            $this->_mode->info=$_POST['info'];
            $this->_mode->addVote() ? Tool::alertLocation("新增投票主题成功", '?action=show') : Tool::alertBack("新增投票主题失败");
        }
        $this->_tpl->assign("add",true);
        $this->_tpl->assign("PREV_URL",PREV_URL);
        $this->_tpl->assign("title","新增投票主题");
    }
    private function addchild(){
        if(isset($_POST['send'])){
            $this->setAdd();
            $this->_mode->vid=$_POST['id'];
            $this->_mode->title=$_POST['title'];
            $this->_mode->info=$_POST['info'];
            $this->_mode->addVote() ? Tool::alertLocation("新增投票项目成功", '?action=showchild&id='.$this->_mode->vid) : Tool::alertBack("新增投票项目失败");
        }
        if($_GET['id']){
            $this->_mode->id=$_GET['id'];
            $_vote=$this->_mode->getOneVote();
            if(!$_vote) Tool::alertBack("不存在此主题");
            $this->_tpl->assign("id",$_vote->id);
            $this->_tpl->assign("titlec",$_vote->title);
            $this->_tpl->assign("addchild",true);
            $this->_tpl->assign("PREV_URL",PREV_URL);
            $this->_tpl->assign("title","新增投票项目");
        }else {
            Tool::alertBack("非法操作");
        }
    }
    private function setAdd(){
        if(Validate::checkNull($_POST['title'])) Tool::alertBack("警告：标题不得为空！");
        if(Validate::checkLength($_POST['title'], 2, 'min')) Tool::alertBack("警告：标题长度不得小于2字符！");
        if(Validate::checkLength($_POST['title'], 20, 'max')) Tool::alertBack("警告：标题长度不得大于20字符！");
        if(Validate::checkLength($_POST['info'], 200, 'max')) Tool::alertBack("警告：描述长度不得大于200字符！");
    }
    private function update(){
        if(isset($_POST['send'])){
            $this->setAdd();//验证
            $this->_mode->id=$_POST['id'];
            $this->_mode->title=$_POST['title'];
            $this->_mode->info=$_POST['info'];
            $this->_mode->updateVote() ? Tool::alertLocation("修改投票成功", $_POST['PREV_URL']) : Tool::alertBack("修改投票失败");
        }
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $_vote=$this->_mode->getOneVote();
            if(!$_vote) Tool::alertBack("不存在此主题");
            $this->_tpl->assign("titlec",$_vote->title);
            $this->_tpl->assign("id",$_vote->id);
            $this->_tpl->assign("info",$_vote->info);
            $this->_tpl->assign("update",true);
            $this->_tpl->assign("title","修改投票主题");
            $this->_tpl->assign("PREV_URL",PREV_URL);
        }else {
            Tool::alertBack("非法操作");
        }
    }
    private function delete(){
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $this->_mode->deleteVote()?Tool::alertLocation("删除成功", PREV_URL) : Tool::alertBack("删除失败");
        }else {
            Tool::alertBack("警告：非法操作！");
        }
    }
    
}