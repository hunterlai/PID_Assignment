<?php
require("condb.php");

session_start();
$name=$_GET["prodName"];
$id=$_GET["prodId"];
$arr=$_SESSION['cart'];

if(array_key_exists($name,$arr)){
    $a=$arr[$name]['unitStock']++;
    echo '已存在'.$arr[$name]['unitStock'];
}else{
    $sql="select * from products where prodId = $id";
    $result=mysqli_query($link,$sql);
    $row=mysqli_fetch_assoc($result);

    $arr0 = array($name=> array('prodId' => $id,'unitStock'=>1,'prodName'=> $name,'unitPrice'=>$row['unitPrice']));
    
    foreach($arr0 as $key => $value){
        $arr[$key]=$value;
    }
}

$_SESSION['cart']=$arr;

header("location: index.php");

?>