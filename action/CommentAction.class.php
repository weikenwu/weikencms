<?php
class CommentAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new CommentModel());
        
    }
    
    public function _action(){
             
        //业务控制流程
        switch ($_GET['action']){
            case "show":
                $this->show();
                break;
            case "state":
                $this->state();
                break;
            case "states":
                $this->states();
                break;
            case "delete":
                $this->delete();
                break;
            default:
                Tool::alertBack("非法操作");
        }
        
    }
    private function show(){
        parent::page($this->_mode->getCommentListTotal(),PAGE_SIZE);
        $this->_tpl->assign("show", true);
        $this->_tpl->assign("title", "评论列表");
        $_object=$this->_mode->getCommentList();
        Tool::subStr($_object, 'content', 30, 'utf-8');
        if($_object){
            foreach ($_object as $_value){
                if(empty($_value->state)){
                    $_value->state='<span class="red">[未审核]</span> | <a href="comment.php?action=state&type=ok&id='.$_value->id.'">通过</a>';
                }else {
                    $_value->state='<span class="green">[已审核]</span> | <a href="comment.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
                }
            }
        }
        $this->_tpl->assign("CommentList", $_object);
        
        
    }

    // 单个审核
    private function state()
    {
        if (isset($_GET[id])) {
            $this->_mode->id = $_GET['id'];
            if (! $this->_mode->getOneComment())
                Tool::alertBack('警告：不存在此评论！');
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
    //批审核
    private function states(){
        if(isset($_POST['send'])){
            $this->_mode->states=$_POST['states'];
            if($this->_mode->setStates()) Tool::alertLocation(null, PREV_URL);
        }
    }
    private function delete(){
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $this->_mode->deletecomment()?Tool::alertLocation("删除成功", PREV_URL) : Tool::alertBack("删除失败");
        }else {
            Tool::alertBack("警告：非法操作！");
        }
    }
    
    
}