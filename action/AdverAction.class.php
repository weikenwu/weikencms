<?php
class AdverAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new AdverModel());
        
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
            case "state":
                $this->state();
                break;
            case "update":
                $this->update();
                break;
            case "delete":
                $this->delete();
                break;
            case "text":
                $this->text();
                break;
            case "header":
                $this->header();
                break;
            case "sidebar":
                $this->sidebar();
                break;
            default:
                Tool::alertBack("非法操作");
        }
        
    }
    //头部广告生成js
    private function header(){
        $_object=$this->_mode->getNewHeaderAdver();
        $_js.="var header=[];\r\n";
        if($_object){
            $_i=0;
            foreach ($_object as $_value){
                $_i++;
                $_js.="header[$_i]={\r\n";
                $_js.="'title':'$_value->title',\r\n";
                $_js.="'pic':'$_value->thumbnail',\r\n";
                $_js.="'link':'$_value->link'\r\n";
                $_js.="};\r\n";
            }
        }
        
        $_js.="var i=Math.floor(Math.random()*$_i+1);\r\n";
        $_js.="document.write('<a href=\"'+header[i].link+'\" title=\"'+header[i].title+'\" target=\"_blank\"><img src=\"'+header[i].pic+'\"></a>');";
        
        if(!file_put_contents("../js/header_adver.js", $_js)){
            Tool::alertBack("警告：头部广告生成出错！");
        }
        Tool::alertLocation("恭喜头部广告生成成功！", '?action=show');
    }
    private function sidebar(){
        $_object=$this->_mode->getNewSidebarAdver();
        $_js.="var sidebar=[];\r\n";
        if($_object){
            $_i=0;
            foreach ($_object as $_value){
                $_i++;
                $_js.="sidebar[$_i]={\r\n";
                $_js.="'title':'$_value->title',\r\n";
                $_js.="'pic':'$_value->thumbnail',\r\n";
                $_js.="'link':'$_value->link'\r\n";
                $_js.="};\r\n";
            }
        }
        
        $_js.="var i=Math.floor(Math.random()*$_i+1);\r\n";
        $_js.="document.write('<a href=\"'+sidebar[i].link+'\" title=\"'+sidebar[i].title+'\" target=\"_blank\"><img border=\"0\" src=\"'+sidebar[i].pic+'\"></a>');";
        
        if(!file_put_contents("../js/sidebar_adver.js", $_js)){
            Tool::alertBack("警告：侧栏广告生成出错！");
        }
        Tool::alertLocation("恭喜侧栏广告生成成功！", '?action=show');
    }
    private function text(){
        $_object=$this->_mode->getNewTextAdver();
        $_js.="var text=[];\r\n";
        if($_object){
            $_i=0;
            foreach ($_object as $_value){
                $_i++;
                $_js.="text[$_i]={\r\n";
                $_js.="'title':'$_value->title',\r\n";
                $_js.="'link':'$_value->link'\r\n";
                $_js.="};\r\n";
            }
        }
        $_js.="var i=Math.floor(Math.random()*$_i+1);\r\n";
        $_js.="document.write('<a href=\"'+text[i].link+'\" class=\"adv\" target=\"_blank\">'+text[i].title+'</a>');\r\n";
        
        if(!file_put_contents("../js/test_adver.js", $_js)){
            Tool::alertBack("警告：文字广告生成出错！");
        }
        Tool::alertLocation("恭喜文字广告生成成功！", '?action=show');
    }
    private function show(){
        parent::page($this->_mode->getAdverTotal(),PAGE_SIZE);
        $this->_tpl->assign("show",true);
        $this->_tpl->assign("title","广告列表");
        $_object=$this->_mode->getAllAdver();
        Tool::subStr($_object, 'link', 20, 'utf-8');
        if($_object){
            foreach ($_object as $_value){
                switch ($_value->type){
                    case 1:
                        $_value->type='文本广告';
                        break;
                    case 2:
                        $_value->type='头部广告690*80';
                        break;
                    case 3:
                        $_value->type='侧栏广告270*200';
                        break;
                }
                if(empty($_value->state)){
                    $_value->state='<span class="red">[否]</span> | <a href="adver.php?action=state&type=ok&id='.$_value->id.'">确定</a>';
                }else {
                    $_value->state='<span class="green">[是]</span> | <a href="adver.php?action=state&type=cancel&id='.$_value->id.'">取消</a>';
                }
            }
        }
        $this->_tpl->assign("AllAdver", $_object);
    }
    // 单个审核
    private function state()
    {
        if (isset($_GET[id])) {
            $this->_mode->id = $_GET['id'];
            if (! $this->_mode->getOneAdver())
                Tool::alertBack('警告：不存在此广告！');
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
    private function add(){
        if(isset($_POST['send'])){
            if(Validate::checkNull($_POST['title'])) Tool::alertBack("警告：标题不得为空！");
            if(Validate::checkLength($_POST['title'], 2, 'min')) Tool::alertBack("警告：标题长度不得小于2字符！");
            if(Validate::checkLength($_POST['title'], 20, 'max')) Tool::alertBack("警告：标题长度不得大于20字符！");
            if(Validate::checkNull($_POST['link'])) Tool::alertBack("警告：链接不得为空！");
            if($_POST['type']=='2' || $_POST['type']=='3'){
                if(Validate::checkNull($_POST['thumbnail'])) Tool::alertBack("警告：图不得为空！");
            }
            if(Validate::checkLength($_POST['info'], 200, 'max')) Tool::alertBack("警告：描述长度不得大于200字符！");
            $this->_mode->title=$_POST['title'];
            $this->_mode->link=$_POST['link'];
            $this->_mode->info=$_POST['info'];
            $this->_mode->thumbnail=$_POST['thumbnail'];
            $this->_mode->type=$_POST['type'];
            $this->_mode->addAdver() ? Tool::alertLocation("恭喜，添加成功", "?action=show") : Tool::alertBack("警告：添加失败");
        }
        $this->_tpl->assign("add",true);
        $this->_tpl->assign("PREV_URL",PREV_URL);
        $this->_tpl->assign("title","新增广告");
    }
    private function update(){
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $_adver=$this->_mode->getOneAdver();
            is_object($_adver)?true:Tool::alertBack("ID有误");
            $this->_tpl->assign("titlec",$_adver->title);
//             $this->_tpl->assign("id",$_adver->id);
//             $this->_tpl->assign("thumbnail",$_adver->thumbnail);
            $this->_tpl->assign("info",$_adver->info);
            $this->_tpl->assign("link",$_adver->link);
            $this->_tpl->assign("update",true);
            $this->_tpl->assign("title","修改广告");
            $this->_tpl->assign("PREV_URL",PREV_URL);
        }else {
            Tool::alertBack("非法操作");
        }
    }
    private function delete(){
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $this->_mode->deleteAdver()?Tool::alertLocation("删除成功", PREV_URL) : Tool::alertBack("删除失败");
        }else {
            Tool::alertBack("警告：非法操作！");
        }
    }
    
}