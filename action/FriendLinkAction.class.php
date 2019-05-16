<?php
class FriendLinkAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new LinkModel());
        
    }
    
    public function _action(){
             
        //业务控制流程
        switch ($_GET['action']){
            case "frontshow":
                $this->frontshow();
                break;
            case "frontadd":
                $this->frontadd();
                break;
            
            default:
                Tool::alertBack("非法操作");
        }
        
    }
    private function frontshow(){
        $this->_tpl->assign('frontshow',true);
        $this->_tpl->assign('Alltext',$this->_mode->getAllLinkText());
        $this->_tpl->assign('Alllogo',$this->_mode->getAllLinkLogo());
    }
    public function index(){
        $this->text();
        $this->logo();
    }
    private function text(){
        $this->_tpl->assign('text',$this->_mode->getTwentyLinkText());
    }
    private function logo(){
        $this->_tpl->assign('logo',$this->_mode->getNineLinkLogo());
    }
    private function frontadd(){
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
            if(Validate::checkLength($_POST['code'], 4, "equals")) Tool::alertBack("警告：验证码必须4位！");
            if(Validate::checkEquals(strtolower($_POST['code']), $_SESSION['code'])) Tool::alertBack("警告：验证码不一致");
            
            $this->_mode->webname=$_POST['webname'];
            $this->_mode->weburl=$_POST['weburl'];
            $this->_mode->logourl=$_POST['logourl'];
            $this->_mode->user=$_POST['user'];
            $this->_mode->state=0;
            $this->_mode->type=$_POST['type'];
            $this->_mode->addLink() ? Tool::alertClose("申请成功！") : Tool::alertBack("警告：申请失败");
        }
        $this->_tpl->assign('frontadd',true);
    }
    
    
}