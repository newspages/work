<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="jquery-2.0.0.min.js"></script>
    <script type="text/javascript" src="jquery-ui"></script>
    <link href="bootstrap-combined.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="bootstrap.min.js"></script>
    <style type="text/css">
        input{
            height:30px;!important;
            padding-bottom: 0px;!important;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span4">

        </div>
        <div class="span4" style="margin-top: 50px;">
            <p>功能介绍：</p>
            <p>您可以上传图片，并且在输入框中输入要在图片上显示的文字</p>
            <form action="" method="post" enctype="multipart/form-data">
<!--                <label for="file">请上传文件:</label>-->
                <input type="file" name="file" id="file" class="btn btn-info" style="display: none;"/>
                <input type="button" value="本地上传" class="btn btn-navbar" onclick="file.click()"/>
                <br /><br/>
                <input type="text" name="name" placeholder="请输入要显示的文字(选填)" class="ip" style="height: 30px;margin-bottom: 0px;"/>
                <input type="text" name="fontSize" placeholder="请输入字体大小(px)(选填)" class="ip" style="height: 30px;margin-bottom: 0px;"/>
                <!--    <input type="text" name="left" placeholder="左移的距离(px)"/>-->
                <!--    <input type="text" name="right" placeholder="右移的距离(px)"/>-->
                <input type="hidden" name="action" value="create"/><br/><br/>
                <input type="submit" onclick="return showmsg()" value="生成图片" class="btn btn-info"/><br/><br/>

<!--<img src="res.png" height="691" width="1000">-->
<!--<img src="jiangzhuang.png">-->
<?php
header("Content-type:text/html;charset=ut-8");
if($_FILES['file']['name']){
    //接收图片
    $image = fileupload();
    $type = getExt($image);
    $text = $_POST['name']?$_POST['name']:'爱你哦';
    //判断上传的图片类型
    switch($type){
        //case 'jpeg':
        case 'jpg':
            $image = imagecreatefromjpeg($image);
            break;
        case 'png':
            $image = imagecreatefrompng($image);
            break;
        case 'gif':
            $image = imagecreatefromgif($image);
            break;
        default:break;
    }
    //接收字体大小
    $fontSize = $_POST['fontSize'] ? $_POST['fontSize'] : 28;
    imagealphablending($image,true);
    $red = imagecolorallocate($image,150,0,0);
    imagefttext($image,$fontSize,0,100,180,$red,'simkai.ttf',$text);
    //将图像输出到浏览器或者文件
    switch($type){
        case 'jpg':
            $filename = "image.jpeg";
            Imagejpeg($image,$filename);
            file_put_contents("./image.jpg",$filename);
            break;
        case 'png':
            $filename = "image.png";
            Imagepng($image,$filename);
            file_put_contents("./image.jpg",$filename);
            break;
        case 'gif':
            $filename = "image.gif";
            Imagegif($image,$filename);
            file_put_contents("./image.jpg",$filename);
            break;
        default:break;
    }
    imagedestroy($image);
    echo "<div style=''><img src='$filename'><br/><br/></div>";
    echo "<a href='download.php?image=$filename' id='download'></a><button class='btn btn-primary' onclick='download.click()'>点击下载图片</button>";
}else{

}

//文件上传
function fileupload(){
    //p($_FILES);
    if ((($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/png"))&& ($_FILES["file"]["size"] < 2000000)){
        if ($_FILES["file"]["error"] > 0){
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        }else{
            if (file_exists("upload/" . $_FILES["file"]["name"])){
                //echo $_FILES["file"]["name"] . " 你已经上传过该图片啦<br/><br/>";
                echo " 你已经上传过该图片啦<br/><br/>";
            }else{
                move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $_FILES["file"]["name"]);
//                echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
            }
        }
    }else{
        echo "Invalid file";
    }
    return "upload/" . $_FILES["file"]["name"];//返回上传的文件路径
}//fileupload end

    //获取文件后缀名
    function getExt($filename){
        $ext = explode('.',$filename);
        return $ext[1];
    }

    //调试使用函数
    function p($str , $flag = 1){
        echo '<pre>';
        print_r($str);
        echo '</pre>';
        if($flag)exit;
    }

?>
            </form>
        </div>
        <div class="span4">

        </div>
    </div>
</div>
<script type="text/javascript">
    function showmsg(){
        if(document.getElementById('file').value && document.getElementById('content').value){
            return true;
        }else if(document.getElementById('file').value){
            var res = confirm("你没有填写要显示的文字,确定要提交了吗？");
            return  res ? true : false;
        }else{
            alert("请上传文件和填写要显示的文字");
            return false;
        }

    }
</script>
</body>
</html>

<?
/*
 * <meta charset="utf-8">
<form action="" method="post">
    <input type="text" name="name" placeholder="请输入要显示的文字"/>
    <input type="submit" value="生成"/>
</form>
<img src="res.png" height="691" width="1000">
<!--<img src="jiangzhuang.png">-->
<?php
header("Content-type:text/html;charset=ut-8");
if($_POST['name']){
    $text = $_POST['name'];
    $image = imagecreatefrompng('res.png');
    imagealphablending($image,true);
    $red = imagecolorallocate($image,150,0,0);
    imagefttext($image,40,0,100,350,$red,'simkai.ttf',$text);
    $filename = "jiangzhuang.png";
    Imagepng($image,$filename);
    imagedestroy($image);
    file_put_contents("./jiangzhuang.jpg",$filename);
    echo '<img src="jiangzhuang.png">';
    echo "<a href='download.php?image=$filename'>点击下载图片</a>";
}
?>
 */
?>

