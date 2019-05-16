<?php
class Action{
    protected $_tpl;
    protected $_mode;
    protected function __construct(&$_tpl,&$_mode=null){
        $this->_tpl=$_tpl;
        $this->_mode=$_mode;
    }
    
    protected function page($_total,$_pagesize=PAGE_SIZE){
        $_page=new Page($_total, $_pagesize);
        $this->_mode->limit=$_page->limit;
        $this->_tpl->assign('page',$_page->showpage());
        $this->_tpl->assign('num',($_page->page-1)*$_pagesize);
    }
}