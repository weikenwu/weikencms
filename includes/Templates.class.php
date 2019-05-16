<?php

class Templates
{

    // 变量数组声明
    private $_vars = array();

    private $_config = array();
    private $_cache=null;//缓存对象
 // 系统变量
    public function __construct($_cache)
    {
        if (! is_dir(TPL_DIR) || ! is_dir(TPL_C_DIR) || ! is_dir(CACHE)) {
            exit('ERROR:模板目录或编译目录或缓存目录不存在！请手工建立');
        }
        // 系统变量
        $_sxe = simplexml_load_file(ROOT_PATH."/config/profile.xml");
        $_tagLib = $_sxe->xpath('/root/taglib');
        // var_dump($_tagLib);
        foreach ($_tagLib as $_tag) {
            $this->_config["$_tag->name"] = $_tag->value;
        }
        // print_r($this->_config);
        $this->_cache=$_cache;
    }

    public function assign($_var, $_value)
    { // 动态赋值
        if (isset($_var) && $_value !== "") {
            $this->_vars[$_var] = $_value;
            // var_dump($this->_vars);
        } else {
            exit($_var.'请设置模板变量');
        }
    }
    //cache 缓存方法 不执行PHP
    public function cache($_file){
        $_tplFile = TPL_DIR . $_file;
        if (! file_exists($_tplFile)) {
            exit('ERROR:模板文件不存在!');
        }
        //在编译之前是否加入参数
        if(!empty($_SERVER['QUERY_STRING'])){
            $_file.=$_SERVER['QUERY_STRING'];
        }
        // 生成编译文件
        $_parFile = TPL_C_DIR . md5($_file) . $_file . '.php';
        // 缓存文件
        $_cacheFile = CACHE . md5($_file) . $_file . '.html';
        // 第二次执行的时候
        if (IS_CACHE) {
            if (file_exists($_cacheFile) && file_exists($_parFile)) {
                if (filemtime($_parFile) >= filemtime($_tplFile) && filemtime($_cacheFile) >= filemtime($_parFile)) {
                    echo '载入缓存文件';
                    // 载入缓存文件
                    include $_cacheFile;
                    exit();
                }
            }
        }
    }
    
    public function display($_file)
    {   
        $_tpl=$this;//include进来的tpl传一个模板操作对象
        
        $_tplFile = TPL_DIR . $_file;
        if (! file_exists($_tplFile)) {
            exit('ERROR:模板文件不存在!');
        }
        //在编译之前是否加入参数
        if(!empty($_SERVER['QUERY_STRING'])){
            $_file_query.=$_SERVER['QUERY_STRING'];
        }
        // 生成编译文件
        $_parFile = TPL_C_DIR . md5($_file) . $_file . '.php';
        // 缓存文件
        $_cacheFile = CACHE . md5($_file) . $_file .$_file_query. '.html';
        
        if (! file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)) {
            require_once ROOT_PATH . '/includes/Parser.class.php';
            // file_put_contents($_parFile, file_get_contents($_tplFile));
            $_parser = new Parser($_tplFile);
            $_parser->compile($_parFile);
        }
        // 载入编译文件
        include $_parFile;
        if (IS_CACHE && !$this->_cache->noCache()) {
            // 获取缓冲区内容，并且写入缓存文件中
            file_put_contents($_cacheFile, ob_get_contents());
            ob_end_clean();
            include $_cacheFile;
        }
    }
    
    //创建create方法footer模块解析使用
    public function create($_file){
        $_tplFile = TPL_DIR . $_file;
        if (! file_exists($_tplFile)) {
            exit('ERROR:模板文件不存在!');
        }    
        // 生成编译文件
        $_parFile = TPL_C_DIR . md5($_file) . $_file . '.php';
        
        if (! file_exists($_parFile) || filemtime($_parFile) < filemtime($_tplFile)) {
            require_once ROOT_PATH . '/includes/Parser.class.php';
            // file_put_contents($_parFile, file_get_contents($_tplFile));
            $_parser = new Parser($_tplFile);
            $_parser->compile($_parFile);
        }
        // 载入编译文件
        include $_parFile;

    }
    
}