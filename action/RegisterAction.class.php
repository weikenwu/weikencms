<?php
class RegisterAction extends Action{
    
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl);
        
    }
    public function _action(){
        switch ($_GET['action']) {
            case 'reg':
                $this->reg();
                break;
            case 'login':
                $this->login();
                break;
            case 'logout':
                $this->logout();
                break;
            default:
                Tool::alertBack("警告：请求有误!");
        }
    }
    private function reg(){
        if(isset($_POST['send'])){
            parent::__construct($this->_tpl, new UserModel());
            if(Validate::checkNull($_POST['user'])) Tool::alertBack("警告：用户名不得为空！");
            if(Validate::checkLength($_POST['user'], 2,'min')) Tool::alertBack("警告：用户名不得小于2位!");
            if(Validate::checkLength($_POST['user'], 20,'max')) Tool::alertBack("警告：用户名不得大于20位!");
            if(Validate::checkLength($_POST['pass'], 6,'min')) Tool::alertBack("警告：密码不得小于6位!");
            
            if(Validate::checkEquals($_POST['pass'],$_POST['notpass'])) Tool::alertBack("警告：密码不一致!");
            if(Validate::checkLength($_POST['code'], 4, "equals")) Tool::alertBack("警告：验证码必须4位！");
            if(Validate::checkNull($_POST['email'])) Tool::alertBack("警告：电子邮件不得为空！");
            if(Validate::checkEmail($_POST['email'])) Tool::alertBack("警告：电子邮件格式不对！");
            if(Validate::checkEquals(strtolower($_POST['code']), $_SESSION['code'])) Tool::alertBack("警告：验证码不一致");
            
            if(!Validate::checkNull($_POST['question']) && !Validate::checkNull($_POST['answer'])){
                $this->_mode->question=$_POST['question'];
                $this->_mode->answer=$_POST['answer'];
            }
            $this->_mode->user=$_POST['user'];
            $this->_mode->pass=sha1($_POST['pass']);
            $this->_mode->email=$_POST['email'];
            $this->_mode->face=$_POST['face'];
            $this->_mode->state=1;
            $this->_mode->time=time();
            if($this->_mode->checkUser()) Tool::alertBack("警告：用户名重复！");
            if($this->_mode->checkEmail()) Tool::alertBack("警告：邮箱重复！");
            if($this->_mode->addUser()){
                $_cookie=new Cookie('user',$this->_mode->user,0);
                $_cookie->setCookie();
                $_cookie=new Cookie('face',$this->_mode->face,0);
                $_cookie->setCookie();
                Tool::alertLocation("注册成功！", './');
            } else{  
                Tool::alertBack("注册失败！");
            }
        }
        $this->_tpl->assign('reg',true);
        $this->_tpl->assign('OptionFaceOne',range(1, 9));
        $this->_tpl->assign('OptionFaceTwo',range(10, 20));
    }
    
    public function login(){
        if(isset($_POST['send'])){
            parent::__construct($this->_tpl, new UserModel());
            if(Validate::checkNull($_POST['user'])) Tool::alertBack("警告：用户名不得为空！");
            if(Validate::checkLength($_POST['user'], 2,'min')) Tool::alertBack("警告：用户名不得小于2位!");
            if(Validate::checkLength($_POST['user'], 20,'max')) Tool::alertBack("警告：用户名不得大于20位!");
            if(Validate::checkLength($_POST['pass'], 6,'min')) Tool::alertBack("警告：密码不得小于6位!");
            if(Validate::checkLength($_POST['code'], 4, "equals")) Tool::alertBack("警告：验证码必须4位！");
            if(Validate::checkEquals(strtolower($_POST['code']), $_SESSION['code'])) Tool::alertBack("警告：验证码不一致");
            $this->_mode->user=$_POST['user'];
            $this->_mode->pass=sha1($_POST['pass']);
            if(!!$_user=$this->_mode->checkLogin()){
                $_cookie=new Cookie('user',$_user->user,$_POST['time']);
                $_cookie->setCookie();
                $_cookie=new Cookie('face',$_user->face,$_POST['time']);
                $_cookie->setCookie();
                $this->_mode->id=$_user->id;
                $this->_mode->time=time();
                $this->_mode->setLaterUser();
                Tool::alertLocation(null, './');
            }else {
                Tool::alertBack("警告：用户名或密码错误！");
            }
        }
        $this->_tpl->assign('login',true);
    }
    
    public function logout(){
        $_cookie=new Cookie('user');
        $_cookie->unCookie();
        Tool::alertLocation(null, 'register.php?action=login');
    }
    
    
}