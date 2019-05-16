<?php
//模板解析类
class Parser{
    private $_tpl;
    public function __construct($_tplFile){
        if(!$this->_tpl=file_get_contents($_tplFile)){
            exit('ERROR:模板文件读取错误！');
        }
    }
    //对外公共方法
    public function compile($_parFile){
        $this->parVar();
        $this->parIf();
        $this->parIff();
        $this->parCommon();
        $this->parForeach();
        $this->parFor();
        $this->parInclude();
        $this->parConfig();
        //生成编译文件
        if(!file_put_contents($_parFile, $this->_tpl)){
            exit('ERROR:编译文件生成出错');
        }
    }
    //解析普通变量
    public function parVar(){
        $_patten='/\{\$([\w]+)\}/';
        if(preg_match($_patten, $this->_tpl)){
            //echo '在模板里可以找到普通变量';
            $this->_tpl=preg_replace($_patten, "<?php echo \$this->_vars['$1'] ?>", $this->_tpl);
        }else {
            //echo 'ERROR:模板里找不到普通变量';
        }
    }
    //解析if语句
    public function parIf(){
        $_pattenIf='/\{if\s+\$([\w]+)\}/';
        $_pattenEnd='/\{\/if\}/';
        $_pattenElse='/\{else\}/';
        if(preg_match($_pattenIf, $this->_tpl)){
            if(preg_match($_pattenEnd, $this->_tpl)){
                $this->_tpl=preg_replace($_pattenIf, "<?php if(\$this->_vars['$1']){?>", $this->_tpl);
                $this->_tpl=preg_replace($_pattenEnd, "<?php } ?>", $this->_tpl);
                if(preg_match($_pattenElse, $this->_tpl)){
                $this->_tpl=preg_replace($_pattenElse, "<?php }else{ ?>", $this->_tpl);
                }
            }else {
                exit('ERROR:IF没有关闭');
            }
        }
    }
    //解析iff语句
    public function parIff(){
        $_pattenIf='/\{iff\s+\@([\w\-\>]+)\}/';
        $_pattenEnd='/\{\/iff\}/';
        $_pattenElse='/\{else\}/';
        if(preg_match($_pattenIf, $this->_tpl)){
            if(preg_match($_pattenEnd, $this->_tpl)){
                $this->_tpl=preg_replace($_pattenIf, "<?php if(\$$1){?>", $this->_tpl);
                $this->_tpl=preg_replace($_pattenEnd, "<?php } ?>", $this->_tpl);
                if(preg_match($_pattenElse, $this->_tpl)){
                    $this->_tpl=preg_replace($_pattenElse, "<?php }else{ ?>", $this->_tpl);
                }
            }else {
                exit('ERROR:IFf没有关闭');
            }
        }
    }
    //foreach
    public function parForeach(){
        $_pattenForeach='/\{foreach\s+\$([\w]+)\(([\w]+),([\w]+)\)\}/';
        $_pattenEndforeach='/\{\/foreach\}/';
        $_pattenVar='/\{@([\w]+)([\w\-\>]*)\}/';
        if(preg_match($_pattenForeach, $this->_tpl)){
            if(preg_match($_pattenEndforeach, $this->_tpl)){
                $this->_tpl=preg_replace($_pattenForeach, "<?php foreach(\$this->_vars['$1'] as \$$2=>\$$3){ ?>", $this->_tpl);
                $this->_tpl=preg_replace($_pattenEndforeach,"<?php } ?>", $this->_tpl);
                if(preg_match($_pattenVar, $this->_tpl)){
                    $this->_tpl=preg_replace($_pattenVar, "<?php echo \$$1$2 ?>", $this->_tpl);
                }
            }else {
                exit('ERROR:foreach没有关闭');
            }
        }
    }
    //解析for语句，用于内嵌循环
    private function parFor(){
        $_pattenFor='/\{for\s+\@([\w\-\>]+)\(([\w]+),([\w]+)\)\}/';
        $_pattenEndfor='/\{\/for\}/';
        $_pattenVar='/\{@([\w]+)([\w\-\>]*)\}/';
        if(preg_match($_pattenFor, $this->_tpl)){
            if(preg_match($_pattenEndfor, $this->_tpl)){
                $this->_tpl=preg_replace($_pattenFor, "<?php foreach(\$$1 as \$$2=>\$$3){ ?>", $this->_tpl);
                $this->_tpl=preg_replace($_pattenEndfor,"<?php } ?>", $this->_tpl);
                if(preg_match($_pattenVar, $this->_tpl)){
                    $this->_tpl=preg_replace($_pattenVar, "<?php echo \$$1$2 ?>", $this->_tpl);
                }
            }else {
                exit('ERROR:for没有关闭');
            }
        }
    }
    
    //includes代码解析
    private  function parInclude(){
        $_patten='/\{include\s+file=\"([\w\.\-\/]+)\"\}/';
        if(preg_match_all($_patten, $this->_tpl,$_file)){
//             var_dump($_file[1]);
//             exit();
            foreach ($_file[1] as $_value){
                if(!file_exists('templates/'.$_value)){
                    exit("ERRPR:包含文件出错");
                }
            }
            $this->_tpl=preg_replace($_patten, "<?php \$_tpl->create('$1') ?>", $this->_tpl);
            
            
        }
    }
    //解析系统变量
    private function parConfig(){
        $_patten='/<!--\{([\w]+)\}-->/';
        if(preg_match($_patten, $this->_tpl)){
            $this->_tpl=preg_replace($_patten, "<?php echo \$this->_config['$1']?>", $this->_tpl);
        }
    }
    //php代码注释
    public function parCommon(){
        $_patten='/\{#\}(.*)\{#\}/';
        if(preg_match($_patten, $this->_tpl)){
            $this->_tpl=preg_replace($_patten, '<?php /* $1 */?>', $this->_tpl);
        }
    }
    
}