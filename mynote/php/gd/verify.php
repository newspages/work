<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/8/11
 * Time: 10:06
 */
//建立一幅100*30的图像
$image = imagecreatetruecolor(200,100);

//设置背景颜色
//$bgcolor = imagecolorallocate($image,0,0,0);
$bgcolor = imagecolorallocate($image,255,0,0);

//将背景颜色填充到画布
imagefill($image,20,20,$bgcolor);

//设置字体颜色
$textcolor = imagecolorallocate($image,255,255,255);

//把字符串写在图像左上角
imagestring($image,20,15,10,"Hello world!",$textcolor);

//输出图像
header("Content-type: image/jpeg");
imagejpeg($image);