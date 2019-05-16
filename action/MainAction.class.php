<?php
class MainAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl);
        
    }
    
    public function _action(){
        if($_GET['action']=='delCache'){
            if(in_array('2',$_SESSION['admin']['premission'])){
            $this->delCache();
            }else {
                Tool::alertBack("警告，权限不足");
            }
        }
        $this->cacheNum();
        
    }
    //计算缓存目录的文件数
    private function cacheNum(){
        $_dir=ROOT_PATH.'/cache';
        $_num=sizeof(scandir($_dir));
        $this->_tpl->assign('cacheNum',$_num-2);
    }
    //清理缓存
    private function delCache(){
        $_dir=ROOT_PATH.'/cache';
        if(!$_dh=@opendir($_dir)) return;
        while (false!==($_obj=readdir($_dh))){
            if($_obj=='.' || $_obj=='..') continue;
            @unlink($_dir.'/'.$_obj);
        }
        closedir($_dh);
        Tool::alertLocation("恭喜清理缓存成功！", 'main.php');
    }
    
}