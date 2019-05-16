<?php
class LinkAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new LinkModel());
        
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
            case "state":
                $this->state();
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
            if (!$this->_mode->getOneLink())
                Tool::alertBack('警告：不存在此链接！');
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
        parent::page($this->_mode->getLinkTotal(),PAGE_SIZE);
        $this->_tpl->assign("show",true);
        $this->_tpl->assign("title","友情链接列表");
        $_object=$this->_mode->getAllLink();
        Tool::subStr($_object, 'weburl', 20, 'utf-8');
        Tool::subStr($_object, 'logourl', 20, 'utf-8');
        if($_object){
            foreach ($_object as $_value){
                switch ($_value->type){
                    case 1:
                        $_value->type='文字链接';
                        break;
                    case 2:
                        $_value->type='LOGO链接';
                        break;
                }
                if(empty($_value->state)){
                    $_value->state='<span class="red">[未审核]</span> | <a href="link.php?action=state&type=ok&id='.$_value->id.'">确定</a>';
                }else {
                    $_value->state='<span class="green">[已审核]</span> | <a href="link.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
                }
            }
        }
        $this->_tpl->assign("AllLink", $_object);
    }
    private function add(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['webname'])) Tool::alertBack("警告：网站名称不得为空！");
            if(Validate::checkLength($_POST['webname'], 20,'max')) Tool::alertBack("警告：网站名称不得大于20位!");
            if(Validate::checkNull($_POST['weburl'])) Tool::alertBack("警告：网站地址不得为空！");
            if(Validate::checkLength($_POST['weburl'], 100,'max')) Tool::alertBack("警告：网站地址不得大于100位!");
            if($_POST['type']==2){
                if(Validate::checkNull($_POST['logourl'])) Tool::alertBack("警告：LOGO地址不得为空！");
                if(Validate::checkLength($_POST['logourl'], 100,'max')) Tool::alertBack("警告：LOGO地址不得大于100位!");
            }
            
            if(Validate::checkLength($_POST['user'], 20,'max')) Tool::alertBack("警告：站长名不得大于20位!");
            
            
            $this->_mode->webname=$_POST['webname'];
            $this->_mode->weburl=$_POST['weburl'];
            $this->_mode->logourl=$_POST['logourl'];
            $this->_mode->user=$_POST['user'];
            $this->_mode->state=$_POST['state'];
            $this->_mode->type=$_POST['type'];
            $this->_mode->addLink() ? Tool::alertLocation("新增成功！",'?action=show') : Tool::alertBack("警告：添加失败");
        }
        $this->_tpl->assign("add",true);
        $this->_tpl->assign("PREV_URL",PREV_URL);
        $this->_tpl->assign("title","新增友情链接");
    }
    private function update(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['webname'])) Tool::alertBack("警告：网站名称不得为空！");
            if(Validate::checkLength($_POST['webname'], 20,'max')) Tool::alertBack("警告：网站名称不得大于20位!");
            if(Validate::checkNull($_POST['weburl'])) Tool::alertBack("警告：网站地址不得为空！");
            if(Validate::checkLength($_POST['weburl'], 100,'max')) Tool::alertBack("警告：网站地址不得大于100位!");
            if($_POST['type']==2){
                if(Validate::checkNull($_POST['logourl'])) Tool::alertBack("警告：LOGO地址不得为空！");
                if(Validate::checkLength($_POST['logourl'], 100,'max')) Tool::alertBack("警告：LOGO地址不得大于100位!");
            }
            
            if(Validate::checkLength($_POST['user'], 20,'max')) Tool::alertBack("警告：站长名不得大于20位!");
            
            $this->_mode->id=$_POST['id'];
            $this->_mode->webname=$_POST['webname'];
            $this->_mode->weburl=$_POST['weburl'];
            $this->_mode->logourl=$_POST['logourl'];
            $this->_mode->user=$_POST['user'];
            $this->_mode->state=$_POST['state'];
            $this->_mode->type=$_POST['type'];
            $this->_mode->updateLink() ? Tool::alertLocation("修改成功！",$_POST['PREV_URL']) : Tool::alertBack("警告：修改失败");
        }
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $_link=$this->_mode->getOneLink();
            if(!$_link) Tool::alertBack("ID有误");
            $this->_tpl->assign("id",$_link->id);
            $this->_tpl->assign("webname",$_link->webname);
            $this->_tpl->assign("weburl",$_link->weburl);
            
            $this->_tpl->assign("user",$_link->user);
            if($_link->type==1){
                $this->_tpl->assign("text_type",'checked="checked"');
                $this->_tpl->assign("logo",'display:none');
            }elseif($_link->type==2){
            $this->_tpl->assign("logourl",$_link->logourl);
                $this->_tpl->assign("logourl",$_link->logourl);
                $this->_tpl->assign("logo_type",'checked="checked"');
                $this->_tpl->assign("logo",'display:block');
            }
            $this->_tpl->assign("state",$_link->state);
            $this->_tpl->assign("update",true);
            $this->_tpl->assign("title","修改友情链接");
            $this->_tpl->assign("PREV_URL",PREV_URL);
        }else {
            Tool::alertBack("非法操作");
        }
    }
    private function delete(){
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $this->_mode->deleteLink()?Tool::alertLocation("删除成功！", "?action=show"):Tool::alertBack("删除失败！");
        }else {
            Tool::alertBack("非法操作!");
        }
    }
    
}