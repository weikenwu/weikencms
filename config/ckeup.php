<?php
require substr(dirname(__FILE__), 0, - 7) . '/init.inc.php';
if ($_GET['type']) {
    $_fileupload = new FileUpload('upload', $_POST['MAX_FILE_SIZE']);
    $_chefn=$_GET['CKEditorFuncNum'];
    $_path=$_fileupload->getPath();
    $img=new Image($_path);
    $img->ckeImage(650,0);
    $img->out();
    echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($_chefn,\"$_path\",'图片上传成功！')</script>";
    exit();
} else {
    Tool::alertBack("警告：上传太大或者未知错误导致崩溃!");
}