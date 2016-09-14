<?php
    // html 本身也可以实现简单的文件下载，但是如果想实现安全下载不想把文件的连接告诉别人，就可以使用php提供的 header 函数实现文件下载
    header("Content-type:text/html;charset=utf-8");//设置客户端浏览器编码
    header("Cache-Control:no-cache");//不缓存
    down_file("数据库密码.txt","/mynote/file/");
    //php文件下载过程，将文件下载过程封装成一个函数
    /*
        函数参数说明
        $file_name 文件名称
        $file_sub_dir 下载文件的子路径
     */
    function down_file($file_name,$file_sub_dir){
        //如果文件名中函数中文名称，那么就需要对文件名进行转码
        //原因：php文件函数比较古老，需要对中文转码成gb2312，使用icon（）函数进行编码转码
        $file_name = iconv("utf-8","gb2312",$file_name);

        //$_SERVER['DOCUMENT_ROOT']表示当前运行脚本所在的文件根目录
        $file_path = $_SERVER['DOCUMENT_ROOT'].$file_sub_dir.$file_name;
        //绝对路径比相对路径要高，建议使用绝对路径
        //1.判断文件是否存在
        if(!file_exists($file_path)){
            echo "文件不存在";
            return ;
        }

        //2.以只读的方式打开文件
        $fp = fopen($file_path,'r+t');

        //获取下载文件的大小
        $file_size = filesize($file_path);
        //防止下载大文件，括号中数字单位为字节
        if($file_size>1000000){
            echo "<script>window.alert('文件过大,不能下载！')</script>";
            return ;
        }

        //下载文件需要用到的头，以下四个header()是必须的
        //通过这句代码客户端浏览器就能知道服务器端返回的文件形式(文件流的形式返回)
        header("Content-type:application/octet-stream");
        //告诉客户端浏览器返回的文件大小是按照字节进行计算的
        header("Accept-Ranges:bytes");
        //告诉浏览器返回的文件的大小
        header("Accept-Lenght:$file_size");
        //告诉浏览器返回的文件的名称
        header("Content-Disposition:attachment;filename=".$file_name);
        fwrite($fp,'abcd');
        //向客户端回送数据
        $buffer = 1024;
        //为了下载的安全，我们最好做一个文件字节读取计数器
        $file_count = 0;
        //这句话用于判断文件是否结束
        while(!feof($fp)&&($file_size-$file_count>0)){
            //每次读取1024字节
            $file_data = fread($fp,$buffer);
            //统计读了多少个字节
            $file_count += $buffer;
            //把部分数据回送给客户端浏览器
            echo $file_data;
        }

        //关闭文件，释放资源
        fclose($fp);
    }

