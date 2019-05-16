<?php
class ContentAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new ContentModel());
        
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
        $this->_tpl->assign("show", true);
        $this->_tpl->assign("title", "文档列表");
        $_nav=new NavModel();
        if(empty($_GET['nav'])){  
            $_id=$_nav->getAllNavchildID();
            $this->_mode->nav=Tool::objArrOfStr($_id, 'id');
        }else {
            $_nav->id=$_GET['nav'];
            if(!$_nav->getOneNav()) Tool::alertBack("警告：类别传输错误！");
            $this->_mode->nav=$_nav->id;
        }
        
        parent::page($this->_mode->getListContentTotal());
        $_object=$this->_mode->getListContent();
        Tool::subStr($_object, 'title', 20, 'utf-8');
        $this->nav();
        $this->_tpl->assign('SearchContent',$_object);
    }
    private function add(){
        if (isset($_POST['send'])) {
            // echo $_POST['title'];
            $this->getPost();
            $this->_mode->addContent() ? Tool::alertLocation("新增成功", "?action=show") : Tool::alertBack("新增失败");
        }
        $this->_tpl->assign("add", true);
        $this->_tpl->assign("PREV_URL", PREV_URL);
        $this->_tpl->assign("title", "新增文档");
        $_html=$this->nav();
        $this->_tpl->assign('author',$_SESSION['admin']['admin_user']);
    }
    private function update(){
        if($_POST['send']){
            $this->_mode->id=$_POST['id'];
            $this->getPost();
            $this->_mode->updateContent()?Tool::alertLocation("修改成功", $_POST['prev_url']) : Tool::alertBack("修改失败");
        }
        if(!isset($_GET['id'])) Tool::alertBack("警告：非法操作！");
        $this->_tpl->assign("update", true);
        $this->_tpl->assign("title", "修改文档");
        $this->_mode->id=$_GET['id'];
        $_content=$this->_mode->getOneContent();
        if(!$_content) Tool::alertBack("警告：错误id！");
        $this->_tpl->assign("id",$_content->id);
        $this->_tpl->assign("titlec",$_content->title);
        $this->_tpl->assign("tag",$_content->tag);
        $this->_tpl->assign("keyword",$_content->keyword); 
        if($_content->thumbnail){
        $this->_tpl->assign("thumbnail",$_content->thumbnail);
        }
        $this->_tpl->assign("source",$_content->source);
        $this->_tpl->assign("author",$_content->author);
        $this->_tpl->assign("content",$_content->content);
        $this->_tpl->assign("info",$_content->info);
        $this->_tpl->assign("count",$_content->count);
        $this->_tpl->assign("gold",$_content->gold);
        $this->_tpl->assign("prev_url",PREV_URL);
        $this->nav($_content->nav);
        $this->attr($_content->attr);
        $this->color($_content->color);
        $this->sort($_content->sort);
        $this->readlimit($_content->readlimit);
        $this->commend($_content->commend);
    }
    private function delete(){
        if(isset($_GET['id'])){
            $this->_mode->id=$_GET['id'];
            $this->_mode->deleteContent()?Tool::alertLocation("删除成功", PREV_URL) : Tool::alertBack("删除失败");
        }else {
            Tool::alertBack("警告：非法操作！");
        }
    }
    private function getPost(){
        if(Validate::checkNull($_POST['title'])) Tool::alertBack("警告：标题不得为空！");
        if(Validate::checkLength($_POST['title'], 2, 'min')) Tool::alertBack("警告：标题长度不得小于2字符！");
        if(Validate::checkLength($_POST['title'], 50, 'max')) Tool::alertBack("警告：标题长度不得大于50字符！");
        if(Validate::checkNull($_POST['nav'])) Tool::alertBack("警告：必须选择一个栏目！");
        if(Validate::checkLength($_POST['tag'], 30, 'max')) Tool::alertBack("警告：不得大于30字符！");
        if(Validate::checkLength($_POST['keyword'], 30, 'max')) Tool::alertBack("警告：不得大于30字符！");
        if(Validate::checkLength($_POST['source'], 20, 'max')) Tool::alertBack("警告：不得大于20字符！");
        if(Validate::checkLength($_POST['author'], 10, 'max')) Tool::alertBack("警告：不得大于10字符！");
        if(Validate::checkNum($_POST['count'])) Tool::alertBack("警告：浏览必须为数字");
        if(Validate::checkNum($_POST['gold'])) Tool::alertBack("警告：金币必须为数字");
        if ($_POST['attr']) {
            $this->_mode->attr = implode(',', $_POST['attr']);
        } else {
            $this->_mode->attr = '无属性';
        }
        
        $this->_mode->title = $_POST['title'];
        $this->_mode->nav = $_POST['nav'];
        $this->_mode->title = $_POST['title'];
        $this->_mode->keyword = $_POST['keyword'];
        $this->_mode->thumbnail = $_POST['thumbnail'];
        $this->_mode->info = $_POST['info'];
        $this->_mode->source = $_POST['source'];
        $this->_mode->author = $_POST['author'];
        $this->_mode->tag = $_POST['tag'];
        $this->_mode->content = $_POST['content'];
        $this->_mode->commend = $_POST['commend'];
        $this->_mode->count = $_POST['count'];
        $this->_mode->gold = $_POST['gold'];
        $this->_mode->color = $_POST['color'];
        $this->_mode->sort = $_POST['sort'];
        $this->_mode->readlimit = $_POST['readlimit'];
    }
    private function commend($_commend){
        $_commendArr=array('0'=>'禁止评论','1'=>'允许评论');
        foreach ($_commendArr as $_key=>$_value){
            if($_key==$_commend) $_checkeded='checked="checked"';
            $_html.='<input type="radio" name="commend" '.$_checkeded.' value="'.$_key.'">'.$_value;
            $_checkeded='';
        }
        $this->_tpl->assign('commend',$_html);
        
    }
    private function readlimit($_readlimit){
        //echo $_readlimit;
        $_readlimittArr=array('0'=>'开放浏览','1'=>'初级会员','2'=>'中级会员','3'=>'高级会员','4'=>'VIP会员');
        foreach ($_readlimittArr as $_key=>$_value){
            if($_key==$_readlimit) $_selected='selected="selected"';
            $_html.='<option '.$_selected.' value="'.$_key.'">'.$_value.'</option>';
            $_selected='';
        }
        $this->_tpl->assign('readlimit',$_html);
    
    }
    private function sort($_sort){
        //echo $_sort;
        $_sortArr=array('0'=>'默认排序','1'=>'置顶一天','2'=>'置顶一周','3'=>'置顶一月','4'=>'置顶一年');
        foreach ($_sortArr as $_key=>$_value){
            if($_key==$_sort) $_selected='selected="selected"';
            $_html.='<option '.$_selected.' value="'.$_key.'">'.$_value.'</option>';
            $_selected='';
        }
        $this->_tpl->assign('sort',$_html);
    }
    private function color($_color){
        //print_r($_color);
        $_colorArr=array(''=>'默认颜色','red'=>'红色','blue'=>'蓝色','orange'=>'橙色');
        foreach ($_colorArr as $_key=>$_value){
            if($_key==$_color) $_selected='selected="selected"';
            $_html.='<option '.$_selected.' value="'.$_key.'" style="color:'.$_key.';">'.$_value.'</option>';
            $_selected='';
        }
        $this->_tpl->assign('color',$_html);
    }
    private function attr($_attr){
        $_attrArr=array('头条','推荐','加粗','跳转');
        $_attrS=explode(',', $_attr);
        $_arrtNo=array_diff($_attrArr, $_attrS);
        if($_attrS[0]!='无属性'){
        foreach ($_attrS as $_value){
            $_html.='<input type="checkbox" checked="checked" name="attr[]" value="'.$_value.'"/>'.$_value;
        }
        }
        foreach ($_arrtNo as $_value){
            $_html.='<input type="checkbox" name="attr[]" value="'.$_value.'"/>'.$_value;
        }
        $this->_tpl->assign('attr',$_html);
        //echo $_attr;
        //<input type="checkbox" name="attr[]" value="头条"/>头条

    }
    private function nav($_n=0){
        $_nav = new NavModel();
        foreach ($_nav->getAllFrontNav() as $_object) {
            $_html .= '<optgroup label=' . $_object->nav_name . '>' . "\r\n";
            $_nav->id = $_object->id;
            if (! ! $_chaildnav = $_nav->getAllFrontChildNav()) {
                foreach ($_chaildnav as $_object) {
                    if($_n==$_object->id) $_selected='selected="selected"';
                    $_html .= '<option '.$_selected.' value=' . $_object->id . '>' . $_object->nav_name . '</option>' . "\r\n";
                    $_selected='';
                }
            }
             $_html .= '</optgroup>';
        }
        $this->_tpl->assign('nav', $_html);
    }
    
}