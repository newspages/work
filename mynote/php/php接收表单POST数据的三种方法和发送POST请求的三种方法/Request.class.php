<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/6/1
 * Time: 12:06
 */
class Request{

    public static function post($url, $post_data = '', $timeout = 5){//curl

        //初始化curl
        $ch = curl_init();
        //设置请求地址
        curl_setopt ($ch, CURLOPT_URL, $url);
        //设置请求方式 POST、GET
        curl_setopt ($ch, CURLOPT_POST, 1);
        //判断数据是否为空
        if($post_data != ''){
            //数据不为空就设置要发送的数据
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }
        //设置返回的数据不是直接显示，如果为 1 或者是 true 返回数据时就不是直接显示出来，而是将数据缓存起来 以便使用
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 0);
        //设置发送请求的超时时间
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        //设置请求头部信息，false 为返回信息时忽略 头部信息
        curl_setopt($ch, CURLOPT_HEADER, false);
        //接收返回的数据
        $file_contents = curl_exec($ch);
        //关闭资源
        curl_close($ch);
        //返回抓取的内容
        return $file_contents;

    }


    public static function post2($url, $data){//file_get_content
        $postdata = http_build_query(
            $data
        );

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );

        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
        return $result;
    }


    public static function post3($host,$path,$query,$others=''){//fsocket
        $post="POST $path HTTP/1.1\r\nHost: $host\r\n";
        $post.="Content-type: application/x-www-form-";
        $post.="urlencoded\r\n${others}";
        $post.="User-Agent: Mozilla 4.0\r\nContent-length: ";
        $post.=strlen($query)."\r\nConnection: close\r\n\r\n$query";
        $h=fsockopen($host,80);
        fwrite($h,$post);
        for($a=0,$r='';!$a;){
            $b=fread($h,8192);
            $r.=$b;
            $a=(($b=='')?1:0);
        }
        fclose($h);
        return $r;
    }
}