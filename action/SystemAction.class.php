<?php
class SystemAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl, new SystemModel());
        
    }
    
    public function _action(){
             
        $this->show();
        
    }
    private function show(){
        if(isset($_POST['send'])){
            $this->_mode->webname=$_POST['webname'];
            $this->_mode->page_size=$_POST['page_size'];
            $this->_mode->article_size=$_POST['article_size'];
            $this->_mode->nav_size=$_POST['nav_size'];
            $this->_mode->updir=$_POST['updir'];
            $this->_mode->ro_num=$_POST['ro_num'];
            $this->_mode->adver_text_num=$_POST['adver_text_num'];
            $this->_mode->adver_pic_num=$_POST['adver_pic_num'];
            if($this->_mode->setSystem()){
                
                $_br="\r\n";
                $_tab="\t";
                $_profile='<?php'.$_br;
                
                
                $_profile.=$_tab."//网站的配置".$_br;
                $_profile.=$_tab."define('WEBNAME', '{$this->_mode->webname}');".$_br;
                
                $_profile.=$_tab."//系统分页广告配置".$_br;
                $_profile.=$_tab."define('PAGE_SIZE', {$this->_mode->page_size});//每页显示多少条".$_br;
                $_profile.=$_tab."define('ARTICLE_SIZE', {$this->_mode->article_size});".$_br;
                $_profile.=$_tab."define('NAV_SIZE', {$this->_mode->nav_size});".$_br;
                $_profile.=$_tab."define('RO_NUM', {$this->_mode->ro_num});//轮播器显示条数".$_br;
                $_profile.=$_tab."define('UPDIR', '{$this->_mode->updir}');".$_br;
                $_profile.=$_tab."define('ADVER_TEXT_NUM', {$this->_mode->adver_text_num});//广告配置".$_br;
                $_profile.=$_tab."define('ADVER_PIC_NUM', {$this->_mode->adver_pic_num});".$_br;
                
                $_profile.=$_tab."//数据库配置".$_br;
                $_profile.=$_tab."define(DB_HOST, \"localhost\");".$_br;
                $_profile.=$_tab."define(DB_USER, \"root\");".$_br;
                $_profile.=$_tab."define(DB_PASS, \"\");".$_br;
                $_profile.=$_tab."define(DB_NAME, \"cms\");".$_br;
                
                $_profile.=$_tab."//系统配置".$_br;
                $_profile.=$_tab."define('PREV_URL', getenv(\"HTTP_REFERER\"));".$_br;
                $_profile.=$_tab."define('GPC', get_magic_quotes_gpc());//转译功能是否打开".$_br;
                $_profile.=$_tab."define('MARK', ROOT_PATH.'/images/logo2.png');//水印图片".$_br;
                
                $_profile.=$_tab."//模板配置信息".$_br;
                $_profile.=$_tab."define('TPL_DIR', ROOT_PATH.'/templates/');".$_br;
                $_profile.=$_tab."define('TPL_C_DIR', ROOT_PATH.'/templates_c/');//编译目录".$_br;
                $_profile.=$_tab."define('CACHE', ROOT_PATH.'/cache/');".$_br;
                
                $_profile.='?>'.$_br;
                
                if(!file_put_contents('../config/profile.inc.php', $_profile)){
                    Tool::alertBack("生成配置文件失败");
                }
                Tool::alertLocation("恭喜，修改成功", 'system.php');
            } else{
                Tool::alertBack("修改失败");
                } 
        }
        $_object=$this->_mode->getSystem();
        $this->_tpl->assign('webname',$_object->webname);
        $this->_tpl->assign('page_size',$_object->page_size);
        $this->_tpl->assign('article_size',$_object->article_size);
        $this->_tpl->assign('nav_size',$_object->nav_size);
        $this->_tpl->assign('updir',$_object->updir);
        $this->_tpl->assign('ro_num',$_object->ro_num);
        $this->_tpl->assign('adver_text_num',$_object->adver_text_num);
        $this->_tpl->assign('adver_pic_num',$_object->adver_pic_num);
    }
    
}