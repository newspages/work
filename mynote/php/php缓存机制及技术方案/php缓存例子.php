<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/6/6
 * Time: 14:43
 * 功能：实现简单的缓存
 */
$id=$_GET['id'];
$filename="static_id_".$id.".html";
$status=filemtime($filename)+30>time();//判断文件创建及修改时间距当前时间是否超过30秒
if(file_exists($filename)&&$status){
    $str=file_get_contents($filename);
    echo $str;
}else{
    require_once "SqlHelper.class.php";
    $sqlHelper=new Sqlhelper();
    $arr=$sqlHelper->execute_dql2("SELECT * FROM news1 WHERE id=$id");
    if(empty($arr)){
        echo "数据为空";
    }else{
        /***缓存开始***/
        ob_start();//下面的内容将存到缓存区中,显示的内容都将存到缓存区
        echo $arr[0]['tile'];
        echo "<br/>";
        echo $arr[0]['content'];
        $content=  ob_get_contents();//从缓存中获取内容
        ob_end_clean();//关闭缓存并清空
        /***缓存结束***/
        file_put_contents($filename, $content);
        echo $content;
    }
}

