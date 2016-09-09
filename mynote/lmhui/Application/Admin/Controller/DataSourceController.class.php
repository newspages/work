<?php
namespace Admin\Controller;
use Think\Controller;
header("COntent-type:text/html;charset=utf-8");
class DataSourceController extends Controller{
    /**
     * 导入excel数据到数据库
     */
    public function importData(){
        if(!IS_POST){
            $this->display('importData');exit(0);
        }
        if($_POST ['import']=="导入数据 "){

            $leadExcel=$_POST['leadExcel'];

            if($leadExcel == "true")
            {
                //echo "OK";die();
                //获取上传的文件名
                $filename = $HTTP_POST_FILES['inputExcel'] ['name'];
                $filename = $_FILES['inputExcel'] ['name'];
                echo $filename;
                //上传到服务器上的临时文件名
                $tmp_name = $_FILES ['inputExcel']['tmp_name'];
                echo $tmp_name;

                $msg = $this->uploadFile($filename,$tmp_name);
                echo $msg;
            }
        }
    }
    /**
     * 导入Excel文件
     * @param $file
     * @param $filetempname
     * @return bool|string
     */
    public function uploadFile($file,$filetempname)
    {
        //自己设置的上传文件存放路径
        $filePath = 'upFile/';
        $str = "";
        //下面的路径按照你 PHPExcel的路径来修改
        //set_include_path('.'. PATH_SEPARATOR .'E:\php\AppServ\www\91ctcStudy\PHPExcelImportSQl2 \PHPExcel' . PATH_SEPARATOR .get_include_path());
        //echo '.'. PATH_SEPARATOR .'F:\wamp\apache\htdocs\truck\lmhui\Application\Admin\Public\phpexcel' . PATH_SEPARATOR .get_include_path();
        $flag = set_include_path('F:\wamp\apache\htdocs\truck\lmhui\Application\Admin\Public\phpexcel');

        require_once '/PHPExcel.php';
        require_once '/PHPExcel/IOFactory.php';
        //require_once 'PHPExcel\Reader\Excel5.php';//excel 2003
        require_once '/PHPExcel/Reader/Excel2007.php';//excel 2007

        $filename=explode(".",$file);//把上传的文件名以“.”好为准做一个数组。
        $time=date("y-m-d-H-i- s");//去当前上传的时间
        $filename [0]=$time;//取文件名t替换
        $name=implode (".",$filename); //上传后的文件名
        $uploadfile=$filePath.$name;//上传后的文件名地址
        $uploadfile=$name;//上传后的文件名地址

        //move_uploaded_file() 函数 将上传的文件移动到新位置。若成功，则返回 true，否则返回 false。
        $result=move_uploaded_file($filetempname,$uploadfile);//假如上传到当前目录下
//        $result=move_uploaded_file($filetempname,'../upload');//假如上传到当前目录下
        if($result) //如果上传文件成功，就执行导入 excel操作
        {
            //$objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2003
            $objReader = \PHPExcel_IOFactory::createReader('Excel2007');//use excel2003 和  2007 format

            //$objPHPExcel = $objReader->load($uploadfile); //这个容易造成httpd崩溃
            $objPHPExcel = \PHPExcel_IOFactory::load($uploadfile);//改成这个写法就好了

            echo 'ok';
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数
//            p($sheet,0);
            p('列数'.$highestColumn,0);
//            p($highestRow);

            $field = '';
            $j = 1;
            //读取excel表第一行作为表字段
            for($k = 'A';$k <= $highestColumn; $k++){
                if($k == $highestColumn){
                    $field .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
                    echo $k;break;
                }
                $field .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'\\';//读 取单元格
            }
            //拆分字符串存放到数组中
            $field = explode('\\',$field);
            //组装sql语句创建数据表
            $sql = 'DROP TABLE IF EXISTS `data`; create table data (';
            for($i = 'A';$i <= $highestColumn;$i++){
                if($i == $highestColumn){
                    $sql .= "`".$i."` varchar(32));";//注意：不要漏了数据类型
                    break;
                }
                $sql .= "`".$i."` varchar(32), ";
            }
            //连接数据库
            $conn = mysql_connect('localhost','root','root') or die('数据库连接失败');
            mysql_select_db('lmhui',$conn);
            //执行创建数据表语句
            mysql_query($sql);

            //循环读取excel文件,读取一条,插入一条
            for($j=2;$j<=$highestRow;$j++)
            {
                for($k='A';$k<=$highestColumn;$k++)
                {
                    if($k == $highestColumn){
                        $str .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue();
                        echo $k;break;
                    }
                    //$str .= iconv('utf-8','gbk',$objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue()).'\\';//读 取单元格
                    $str .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().'\\';//读 取单元格
                }
//            p($objPHPExcel->getActiveSheet()->getCell("J2")->getValue());
                //explode:函 数把字符串分割为数组。
                $strs =explode("\\",$str);
                p($strs,0);

                //var_dump ($strs);
                //die();

                $sql = "INSERT INTO VALUES ('".$strs[0]."','".$strs[1]."','".$strs[2]."')";
                $sql = "INSERT INTO VALUES (";
                for($i = 0 ;$i < count($strs) ; $i++){
                    if($i == count($strs)-1){
                        $sql .= "'".$strs[$i]."');";
                        break;
                    }

                    $sql .= "'".$strs[$i]."',";
                }
                p($sql);
                //echo $ sql;
                mysql_query ("set names GBK");//这就是指定数据库字 符集，一般放在连接数据库后面就系了
                if(! mysql_query($sql)){
                    p(mysql_error());
                    return false;
                }
                $str ="";
            }

            unlink ($uploadfile); //删除上传的excel文件
            $msg = "导入成 功！";
        }else{
            $msg = "导入失 败！";
        }
        return $msg;
    }

}