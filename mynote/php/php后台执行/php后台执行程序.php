<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/8/26
 * Time: 12:00
 */
//php中实现后台执行的方法：
ignore_user_abort(true); // 后台运行
set_time_limit(0); // 取消脚本运行时间的超时上限
//后台运行的后面还要，set_time_limit(0); 除非在服务器上关闭这个程序，否则下面的代码将永远执行下去止到完成为止。
//如果程序运行不超时,在没有执行结束前,程序不会自动结束的.
//=========================================
//PHP 中如何 在客户端触发，然后在服务器端执行一个函数，页面关闭也继续执行。要先返回用户请求不要等待时。

 ob_end_clean();#清除之前的缓冲内容，这是必需的，如果之前的缓存不为空的话，里面可能有http头或者其它内容，导致后面的内容不能及时的输出
 header("Connection: close");//告诉浏览器，连接关闭了，这样浏览器就不用等待服务器的响应
 header("HTTP/1.1 200 OK"); //可以发送200状态码，以这些请求是成功的，要不然可能浏览器会重试，特别是有代理的情况下
 //return false;//加了这个下面的就不执行了，不加这个无法返回页面状态，浏览器一直在等待状态，可以关闭，但不是要的效果。
 //die(); 或 return ;也一样不执行下面的
 //rundata();
 //register_shutdown_function("rundata");
 //return  ;
 ob_start();#开始当前代码缓冲
  echo "running,,,,.";
 //下面输出http的一些头信息
 $size=ob_get_length();
 header("Content-Length: $size");
 ob_end_flush();#输出当前缓冲
 flush();#输出PHP缓冲

 #休眠PHP，也就是当前PHP代码的执行停止，1秒钟后PHP被唤醒，
 #PHP唤醒后，继续执行下面的代码，但这个时候上面代码的结果已经输出浏览器了，
 #也就是浏览器从HTTP头中知道了服务端关闭了连接，浏览器将不在等待服务器的响应，
 #反应给客户的就是页面不会显示处于加载状态中，换句话说用户可以关掉当前页面，或者关掉浏览器，
 #PHP唤醒后继续执行下面的代码，这也就实现了PHP后台执行的效果，
 #休眠的作用只是让php先把前面的输出作完，不要急于马上执行下面的代码，休息一下而已，也就是说下面的代码
 #执行的时候前面的输出应该到达浏览器了
 sleep(1);
 echo '这里的输出用户看不到，后台运行的';

 //下面代码的任何输出都不会输出给浏览器，因为http连接已经关了，
 //所以下面的代码的执行属于后台运行的

 ignore_user_abort(true); // 后台运行，这个只是运行浏览器关闭，并不是直接就中止返回200状态。
 set_time_limit(0); // 取消脚本运行时间的超时上限
 rundata();

function rundata(){//do something}

=========================================
用ignore_user_abort函数实现php计划任务
代码如下:
<?php
ignore_user_abort(true);
set_time_limit(0);
while(1) {
    　　$fp = fopen('time_task.txt',"a+");
    　　$str = date("Y-m-d h:i:s")."\n\r";
    　　fwrite($fp,$str);
    　　fclose($fp);
    　　sleep(300); //半小时执行一次
}
?>
=======================================
int ignore_user_abort ( [bool setting] )
这个函数的作用是指示服务器端在远程客户端关闭连接后是否继续执行下面的脚本。
setting 参数是一个可选参数。如设置为True，则表示如果用户停止脚本运行，仍然不影响脚本的运行（即：脚本将持续执行）；如果设置为False，则表示当用户停止运行脚本程序时，脚本程序将停止运行。
下面这个例子，在用户关闭浏览器后，该脚本仍然后在服务器上继续执行：
ignore_user_abort(true); // 后台运行
set_time_limit(0); // 取消脚本运行时间的超时上限
do{
sleep(60); // 休眠1分钟
}while(true);
?>
除非在服务器上关闭这个程序，否则这断代码将永远执行下去。
-------------------------------------------------------------------------
ignore_user_abort(true); // 后台运行
set_time_limit(0); // 取消脚本运行时间的超时上限
echo 'start.';
sleep(1000);
echo 'end.';
?>