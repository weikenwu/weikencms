<?php
class SearchAction extends Action{
    
    public function __construct(&$_tpl){
        parent::__construct($_tpl,new ContentModel());
        
    }
    public function _action(){
       $this->searchTitle();
       $this->searchKeyword();
       $this->searchTag();
    }
    
    private function searchTitle(){
        if($_GET['type']==1){
            if(empty($_GET['inputkeyword'])) Tool::alertBack("警告：关键字不能为空");
            $this->_mode->inputkeyword=$_GET['inputkeyword'];
            parent::page($this->_mode->searchTitleContentTotal(),ARTICLE_SIZE);
            $_object=$this->_mode->searchTitleContent();
            Tool::subStr($_object, 'info', 120, 'utf-8');
            Tool::subStr($_object, 'title', 35, 'utf-8');//对象数组无需引用，默认引用传值
            if($_object){
                foreach ($_object as $_value){
                    if(empty($_value->thumbnail)) $_value->thumbnail='images/myface.png';
                    $_value->title=str_replace($this->_mode->inputkeyword, '<span class="red">'.$this->_mode->inputkeyword.'</span>', $_value->title);
                }
            }
            $this->_tpl->assign('SearchContent',$_object);
        }
    }
    private function searchKeyword(){
        if($_GET['type']==2){
            if(empty($_GET['inputkeyword'])) Tool::alertBack("警告：关键字不能为空");
            $this->_mode->inputkeyword=$_GET['inputkeyword'];
            parent::page($this->_mode->searchKeywordContentTotal(),ARTICLE_SIZE);
            $_object=$this->_mode->searchKeywordContent();
            Tool::subStr($_object, 'info', 120, 'utf-8');
            Tool::subStr($_object, 'title', 35, 'utf-8');//对象数组无需引用，默认引用传值
            if($_object){
                foreach ($_object as $_value){
                    if(empty($_value->thumbnail)) $_value->thumbnail='images/myface.png';
                    $_value->keyword=str_replace($this->_mode->inputkeyword, '<span class="red">'.$this->_mode->inputkeyword.'</span>', $_value->keyword);
                }
            }
            $this->_tpl->assign('SearchContent',$_object);
        }
    }
    private function searchTag(){
        if($_GET['type']==3){            
            if(empty($_GET['inputkeyword'])) Tool::alertBack("警告：关键字不能为空");
            $this->_mode->inputkeyword=$_GET['inputkeyword'];
            parent::page($this->_mode->searchTagContentTotal(),ARTICLE_SIZE);
            $_object=$this->_mode->searchTagContent();
            Tool::subStr($_object, 'info', 120, 'utf-8');
            Tool::subStr($_object, 'title', 35, 'utf-8');//对象数组无需引用，默认引用传值
            if($_object){
                foreach ($_object as $_value){
                    if(empty($_value->thumbnail)) $_value->thumbnail='images/myface.png';
//                     $_value->keyword=str_replace($this->_mode->inputkeyword, '<span class="red">'.$this->_mode->inputkeyword.'</span>', $_value->keyword);
                }
            }
            $_tag=new TagModel();
            $_tag->tagname=$this->_mode->inputkeyword;
            if($_tag->getOneTag()){
                $_tag->addTagCount();
            }else {
                $_tag->addTag();
            }
            
            $this->_tpl->assign('SearchContent',$_object);
        }
    }
}