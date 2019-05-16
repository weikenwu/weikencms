<?php
//图像处理类
class Image{
    private $file;//图片地址
    private $width;
    private $height;
    private $type;
    private $img;//原图资源句柄
    private $new;//新图资源句柄
    public function __construct($_file){
        $this->file=$_SERVER["DOCUMENT_ROOT"].$_file;
        list($this->width,$this->height,$this->type)=getimagesize($this->file);
        $this->img=$this->getFromImage($this->file, $this->type);
        
    }
    //cke专用图像处理
    public function ckeImage($new_width=0,$new_height=0){
        if(empty($new_width) && empty($new_height)){
            $new_width=$this->width;
            $new_height=$this->height;
        }
        if(!is_numeric($new_width) || !is_numeric($new_height)){
            $new_width=$this->width;
            $new_height=$this->height;
        }
        if ($this->width > $new_width) {
            $new_height = ($new_width / $this->width) * $this->height;
        } else {
            $new_width=$this->width;
            $new_height=$this->height;
        }
        if ($this->height > $new_height) {
            $new_width = ($new_height / $this->height) * $this->width;
        } else {
            $new_width=$this->width;
            $new_height=$this->height;
        }
        
        list($_water_width,$_water_height,$_water_type)=getimagesize(MARK);
        $_water=$this->getFromImage(MARK, $_water_type);
        
        $_water_x=$new_width-$_water_width-5;
        $_water_y=$new_height-$_water_height-5;
        
        $this->new=imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($this->new, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);   
        
        imagecopy($this->new, $_water, $_water_x, $_water_y, 0, 0, $_water_width, $_water_height);

        imagedestroy($_water);
    }
    //缩略图百分比
//     public function thumb($_per){
//         $new_width=$this->width*($_per/100);
//         $new_height=$this->height*($_per/100);
//         $this->new=imagecreatetruecolor($new_width, $new_height);
//         imagecopyresampled($this->new, $this->img, 0, 0, 0, 0, $new_width, $new_height, $this->width, $this->height);
//     }
    //缩略图等比例
//     public function thumb($new_width,$new_height){
//         if($this->width<$this->height){
//             $new_width=($new_height/$this->height)*$this->width;
//         }else {
//             $new_height=($new_width/$this->width)*$this->height;
//         }
        
//     }
    //固定长宽等比例裁剪
    public function thumb($new_width=0,$new_height=0){
        if(empty($new_width) && empty($new_height)){
            $new_width=$this->width;
            $new_height=$this->height;
        }
        if(!is_numeric($new_width) || !is_numeric($new_height)){
            $new_width=$this->width;
            $new_height=$this->height;
        }
        //创建一个容器
        $_n_w=$new_width;
        $_n_h=$new_height;
        //创建裁剪点
        $_cut_width=0;
        $_cut_height=0;
        
        
        if ($this->width < $this->height) {
            $new_width = ($new_height / $this->height) * $this->width;
        } else {
            $new_height = ($new_width / $this->width) * $this->height;
        }
        
        if($new_width<$_n_w){
            $r=$_n_w/$new_width;
            $new_width*=$r;
            $new_height*=$r;
            $_cut_height=($new_height-$_n_h)/2;
        }
        if($new_height<$_n_h){
            $r=$_n_h/$new_height;
            $new_width*=$r;
            $new_height*=$r;
            $_cut_width=($new_width-$_n_w)/2;
        }
        
        $this->new = imagecreatetruecolor($_n_w,$_n_h);
        imagecopyresampled($this->new, $this->img, 0, 0, $_cut_width, $_cut_height, $new_width, $new_height, $this->width, $this->height);
    }
    
    //加载各种类型图片返回
    private function getFromImage($_file,$_type){
        switch ($_type) {
            case 1:
                $img = imagecreatefromgif($_file);
                break;
            case 2:
                $img = imagecreatefromjpeg($_file);
                break;
            case 3:
                $img = imagecreatefrompng($_file);
                break;
            default:
                Tool::alertBack("警告：此图片类型不支持！");
        }
        return $img;
    }
    //图像输出
    public function out(){
        //header("Content-Type:image/jpeg");
        imagepng($this->new,$this->file);
        imagedestroy($this->new);
    }
}