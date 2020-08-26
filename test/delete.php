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
// $de=$_GET["de"];
// $sql="delete from buying where orderId = $id ";
// echo $sql;
// require("condb.php");
// echo "<script> 
//                var \$de =window.confirm('確定是否要刪除');
//                if (\$de == 1 ){
//                   alert('確定刪除:$de');                         
//                }else{
//                   alert('取消');
//                }
//       </script>";
// $result=mysqli_query($link,$sql);
?>