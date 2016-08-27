<?php
/**
 * Created by PhpStorm.
 * User: ldk
 * Date: 2016/6/1
 * Time: 14:23
 */
//postxml.php：
//<?php
// Do a POST
$data="<?xml version='1.0' encoding='UTF-8'?>
<TypeRsp>
<CONNECT_ID>1</CONNECT_ID>
<MO_MESSAGE_ID>2</MO_MESSAGE_ID>
</TypeRsp>";


//$data = array('name' => 'Dennis', 'surname' => 'Pallett');


// create a new curl resource
$ch = curl_init();
// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL,"http://localhost/test/getxml.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
// grab URL, and print
curl_exec($ch);
//? >


//getxml.php：
//<?php
$file_in = file_get_contents("php://input"); //接收post数据


$xml = simplexml_load_string($file_in);//转换post数据为simplexml对象


foreach($xml->children() as $child)    //遍历所有节点数据
{


    echo $child->getName() . ": " . $child . "<br />"; //打印节点名称和节点值


//if($child->getName()=="from")    //捡取要操作的节点
//{
//echo "i say ". ": get you!" . "<br />"; //操作节点数据
//}
}


exit;
?>
