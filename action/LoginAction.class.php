<?php
class LoginAction extends Action{
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new ManageModel());
        
    }
    public function _action(){

        switch ($_GET['action']){
            case "login":
                $this->login();
                break;
            case "logout":
                $this->logout();
                break;
        }
    }
    
    private function logout(){
        Tool::unSession();
        Tool::alertLocation(null, "admin_login.php");
    }
    private function login(){
        if(isset($_POST['send'])){
            if(Validate::checkLength($_POST['code'], 4, "equals")) Tool::alertBack("警告：验证码必须4位！");
            if(Validate::checkEquals(strtolower($_POST['code']), $_SESSION['code'])) Tool::alertBack("警告：验证码不一致");
            if(Validate::checkNull($_POST['admin_user'])) Tool::alertBack("警告：用户名不得为空！");
            if(Validate::checkLength($_POST['admin_user'], 2,'min')) Tool::alertBack("警告：用户名不得小于2位!");
            if(Validate::checkLength($_POST['admin_user'], 20,'max')) Tool::alertBack("警告：用户名不得大于20位!");
            if(Validate::checkNull($_POST['admin_pass'])) Tool::alertBack("警告：密码不得为空！");
            if(Validate::checkLength($_POST['admin_pass'], 6,'min')) Tool::alertBack("警告：密码不得小于6位!");
            $this->_mode->_admin_user=$_POST['admin_user'];
            $this->_mode->_admin_pass=sha1($_POST['admin_pass']);
            $_login=$this->_mode->getLoginManage();
            if($_login){
                $_preArr=explode(',', $_login->premission);
                if(in_array('1', $_preArr)){
                $_SESSION['admin']['admin_user']=$_login->admin_user;
                $_SESSION['admin']['level_name']=$_login->level_name;
                $_SESSION['admin']['premission']=$_preArr;
                $this->update_ip();
                Tool::alertLocation(null, 'admin.php');
                }else {
                    Tool::alertBack("警告，权限不足");
                }
                
                //echo "恭喜你，登录成功";
            }else {
                Tool::alertBack("警告：用户名或密码错误！");
            }
        }
    }
    private function update_ip(){
        $_ip=Validate::GetIP();
        $this->_mode->updateManage_ip($_ip);
    }
}