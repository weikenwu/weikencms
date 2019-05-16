<?php
class UserAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new UserModel());
        
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
        //$page=new Page($this->_mode->getUserTotal(),PAGE_SIZE);
        parent::page($this->_mode->getUserTotal());
        $this->_tpl->assign("show",true);
        $this->_tpl->assign("title","会员列表");
        $_object=$this->_mode->getAllUser();
        foreach ($_object as $_value){
            switch ($_value->state) {
                case 0:
                    $_value->state = "被封杀的会员";
                    break;
                case 1:
                    $_value->state = "待审核的会员";
                    break;
                case 2:
                    $_value->state = "初级会员";
                    break;
                case 3:
                    $_value->state = "中级会员";
                    break;
                case 4:
                    $_value->state = "高级会员";
                    break;
                case 5:
                    $_value->state = "VIP会员";
                    break;
            }
        }
        $this->_tpl->assign("AllUser", $_object);
        //$this->_tpl->assign("page", $page->showpage());
    }
    
    private function add(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['user'])) Tool::alertBack("警告：用户名不得为空！");
            if(Validate::checkLength($_POST['user'], 2,'min')) Tool::alertBack("警告：用户名不得小于2位!");
            if(Validate::checkLength($_POST['user'], 20,'max')) Tool::alertBack("警告：用户名不得大于20位!");
            if(Validate::checkLength($_POST['pass'], 6,'min')) Tool::alertBack("警告：密码不得小于6位!");        
            if(Validate::checkEquals($_POST['pass'],$_POST['notpass'])) Tool::alertBack("警告：密码不一致!");         
            if(Validate::checkNull($_POST['email'])) Tool::alertBack("警告：电子邮件不得为空！");
            if(Validate::checkEmail($_POST['email'])) Tool::alertBack("警告：电子邮件格式不对！");
            if(!Validate::checkNull($_POST['question']) && !Validate::checkNull($_POST['answer'])){
                $this->_mode->question=$_POST['question'];
                $this->_mode->answer=$_POST['answer'];
            }
            
            $this->_mode->user=$_POST['user'];
            $this->_mode->pass=sha1($_POST['pass']);
            $this->_mode->email=$_POST['email'];
            $this->_mode->face=$_POST['face'];
            $this->_mode->state=$_POST['state'];
            if($this->_mode->checkUser()) Tool::alertBack("警告：用户名重复！");
            if($this->_mode->checkEmail()) Tool::alertBack("警告：邮箱重复！");
            if($this->_mode->addUser()){
                Tool::alertLocation("注册成功！", 'user.php?action=show');
            } else{
                Tool::alertBack("注册失败！");
            }
            
        }
        $this->_tpl->assign("add",true);
        $this->_tpl->assign("PREV_URL",PREV_URL);
        $this->_tpl->assign("title","新增会员");
        $this->_tpl->assign('OptionFaceOne',range(1, 9));
        $this->_tpl->assign('OptionFaceTwo',range(10, 20));
    }
    private function update(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['pass'])){
                $this->_mode->pass=$_POST['ppass'];
            }else {
                if(Validate::checkLength($_POST['pass'], 6,'min')) Tool::alertBack("警告：密码不得小于6位!");
                $this->_mode->pass=sha1($_POST['pass']);
            }
            if(Validate::checkNull($_POST['email'])) Tool::alertBack("警告：电子邮件不得为空！");
            if(Validate::checkEmail($_POST['email'])) Tool::alertBack("警告：电子邮件格式不对！");
            if(!Validate::checkNull($_POST['question']) && !Validate::checkNull($_POST['answer'])){
                $this->_mode->question=$_POST['question'];
                $this->_mode->answer=$_POST['answer'];
            }
            $this->_mode->id=$_POST['id'];
            $this->_mode->email=$_POST['email'];
            $this->_mode->face=$_POST['face'];
            $this->_mode->state=$_POST['state'];
            $this->_mode->updateUser() ? Tool::alertLocation("修改成功！", $_POST['prev_url']) : Tool::alertBack("修改失败!");
        }
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $_user=$this->_mode->getOneUser();
            if($_user){

                $this->_tpl->assign("update",true);
                $this->_tpl->assign("title","修改会员");
                $this->_tpl->assign("PREV_URL",PREV_URL);
                $this->_tpl->assign("id",$_user->id);
                $this->_tpl->assign("user",$_user->user);
                $this->_tpl->assign("email",$_user->email);
                $this->_tpl->assign("answer",$_user->answer);
                $this->_tpl->assign("facesrc",$_user->face);
                $this->_tpl->assign("pass",$_user->pass);
                $this->face($_user->face);
                $this->question($_user->question);
                $this->state($_user->state);
            }else {
                Tool::alertBack("警告：该会员不存在");
            }
            
        }else {
            Tool::alertBack("非法操作");
        }
    }
    private function delete(){
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $this->_mode->deleteUser()?Tool::alertLocation("删除成功！", PREV_URL):Tool::alertBack("删除失败！");
        }else {
            Tool::alertBack("非法操作!");
        }

    }
    //状态
    private function state($_state){
        $_stateArr=array('0'=>'被封杀的会员','1'=>'待审核的会员','2'=>'初级会员','3'=>'中级会员','4'=>'高级会员','5'=>'VIP会员');
        foreach ($_stateArr as $_key=>$_value){
            if($_key==$_state) $_checked='checked="checked"';
            $_html.='<input type="radio" name="state" '.$_checked.' value="'.$_key.'"/>'.$_value;
            $_checked='';
        }
        $this->_tpl->assign('state',$_html);
    }
    //提问
    private function question($_question){
        $_questionArr=array('没有任何安全问题','您父亲的姓名？','您母亲的职业？','您配偶的性别？');
        foreach ($_questionArr as $_value){
            if($_value==$_question) $_selected='selected="selected"';
            $_html.='<option '.$_selected.' value="'.$_value.'" >'.$_value.'</option>';
            $_selected='';
        }
        $this->_tpl->assign('question',$_html);
    }
    //头像
    private function face($_face){
        $_one=range(1,9);
        $_two=range(10,20);
        foreach ($_one as $_value){
            if('0'.$_value.'.gif'==$_face) $_selected='selected="selected"';
            $_html.='<option '.$_selected.' value="0'.$_value.'.gif">0'.$_value.'.gif</option>';
            $_selected='';
        }
        foreach ($_two as $_value){
            if($_value.'.gif'==$_face) $_selected='selected="selected"';
            $_html.='<option '.$_selected.' value="'.$_value.'.gif">'.$_value.'.gif</option>';
            $_selected='';
        }
        $this->_tpl->assign('face',$_html);
    }
    
}