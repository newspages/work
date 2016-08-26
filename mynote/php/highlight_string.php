<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/7/22
 * Time: 11:49
 */
header('Content-type:text/html;charset=utf-8');
//在浏览器中输出高亮的php代码：
echo highlight_string("<?php echo 'This is highlight_string 函数使用的结果'; \r\n  echo 'This is highlight_string 函数使用的结果'; ?>").'<br/>';
echo highlight_string("<?php echo 'This is highlight_string 函数使用的结果'; ?>");
echo '<br/><br/>';

//统计字符串中单词的个数
$str = 'Wellcome to my IT shop';
echo str_word_count($str);