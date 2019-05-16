<?php
// require dirname(__FILE__).'/init.inc.php';
// $_vc=new ValidateCode();
// echo $_vc->doimg();


// function GetIP(){
//     if(!empty($_SERVER["HTTP_CLIENT_IP"])){
//         $cip = $_SERVER["HTTP_CLIENT_IP"];
//     }
//     elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
//         $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
//     }
//     elseif(!empty($_SERVER["REMOTE_ADDR"])){
//         $cip = $_SERVER["REMOTE_ADDR"];
//     }
//     else{
//         $cip = "无法获取！";
//     }
//     return $cip;
// }

// echo GetIP();

// $img=imagecreatefromjpeg("3.jpg");
// list($width,$height,$type)=getimagesize("3.jpg");
// $per=0.6;
// $new_widht=$width*$per;
// $new_height=$height*$per;
// $new=imagecreatetruecolor($new_widht, $new_height);
// imagecopyresampled($new, $img, 0, 0, 0, 0, $new_widht, $new_height, $width, $height);
// //水印
// $color=imagecolorallocate($new, 100, 100, 100);
// imagettftext($new, 18, 0, 10, 20, $color, 'font/MISTRAL.TTF', 'Weiken');


// header("Content-Type:image/jpeg");
// imagejpeg($new);
//imagedestroy($img);

$a=array('1','2','3');
fn($a);
var_dump($a);
function fn(&$_date){
    $_date[4]='4';
}
