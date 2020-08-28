<?php
session_start();
$id=$_GET["prodId"];
$arr=$_SESSION['cart'];
// var_dump($arr);

foreach($arr as $key =>$val){
    if($val["prodId"] == $id){
        if($val["unitStock"]>1){
            $arr[$key]['unitStock']-=1;
        }else{
            unset($arr["$key"]);
        }
    }
}
$_SESSION['cart'] = $arr;
header("location:buycar.php");
?>