<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/6/6
 * Time: 15:53
 */
//这篇文章主要介绍了php读取文件内容的三种方法,需要的朋友可以参考下
//php读取文件内容的三种方法:

//**************第一种读取方式*****************************
//代码如下:
header("content-type:text/html;charset=utf-8");
//文件路径
$file_path="text.txt";
//判断是否有这个文件
if(file_exists($file_path)){
    if($fp=fopen($file_path,"a+")){
//读取文件
        $conn=fread($fp,filesize($file_path));
//替换字符串
        $conn=str_replace("rn","<br/>",$conn);
        echo $conn."<br/>";
    }else{
        echo "文件打不开";
    }
}else{
    echo "没有这个文件";
}
fclose($fp);

//*******************第二种读取方式***************************
// 代码如下:
header("content-type:text/html;charset=utf-8");
//文件路径
$file_path="text.txt";
$conn=file_get_contents($file_path);
$conn=str_replace("rn","<br/>",file_get_contents($file_path));
echo $conn;
fclose($fp);

//******************第三种读取方式，循环读取*****************
 //代码如下:
header("content-type:text/html;charset=utf-8");
//文件路径
$file_path="text.txt";
//判断文件是否存在
if(file_exists($file_path)){
//判断文件是否能打开
    if($fp=fopen($file_path,"a+")){
        $buffer=1024;
//边读边判断是否到了文件末尾
        $str="";
        while(!feof($fp)){
            $str.=fread($fp,$buffer);
        }
    }else{
        echo "文件不能打开";
    }
}else{
    echo "没有这个文件";
}
//替换字符
$str=str_replace("rn","<br>",$str);
echo $str;
fclose($fp);
读取INI配置文件的函数:
$arr=parse_ini_file("config.ini");
//返回的是数组
echo $arr['host']."<br/>";
echo $arr['username']."<br/>";
echo $arr['password']."<br/>";
