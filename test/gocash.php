<?php

session_start();

$arr= $_SESSION['cart'];
$id = $_GET["userId"];
// print_r($arr);
require("condb.php");
$sql="select balance from player where userId = $id ";
$result=mysqli_query($link,$sql);
$row=mysqli_fetch_assoc($result);


$total=0;
foreach($arr as $val){
    $total+=$val["unitPrice"]*$val["unitStock"];
}
if($total>0 && $row["balance"]>=$total){
    $coin=$row["balance"];
    foreach($arr as $val){
        $pid=$val['prodId'];
        $sql2="select unitStock from products where prodId = $pid ";
        $result2=mysqli_query($link,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        if ($val['unitStock']>$row2["unitStock"]){
            echo "id:".$pid."庫存不足 3秒後自動返回!";
            header('refresh:3;url="buycar.php"');
        }
    }
    $sql3="update player set balance=($coin-$total) where userId = $id";
    $result3=mysqli_query($link,$sql3);

    foreach($arr as $val){
        $pid=$val['prodId'];
        $num=$val['unitStock'];
        $sql2="select unitStock from products where prodId = $pid ";
        $result2=mysqli_query($link,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        $stock=$row2["unitStock"];
        $sql4="update products set unitStock=($stock-$num) where prodId = $pid";
        $result4=mysqli_query($link,$sql4);
    }
    $day=date("Y-m-d");
    $sql5="insert into orders (userId,orderDate) value ($id,'$day')";
    // echo "$sql5";
    $result5=mysqli_query($link,$sql5);
    
    $sql6="select Max(orderId) from orders where userId = $id";
    $result6=mysqli_query($link,$sql6);
    $row3=mysqli_fetch_assoc($result6);
    $orderId=$row3["Max(orderId)"];
    // echo $orderId;
    foreach($arr as $val){
        $pid=$val['prodId'];
        $num=$val['unitStock'];
        $sql7="insert into order_detail (orderId,prodId,qty) values ($orderId,$pid,$num)";
        // echo $sql7."<br>";
        $result7=mysqli_query($link,$sql7);
    }
    unset($_SESSION['cart']);
    echo "<script>alert('交易完成！');location.href='index.php?out=1';</script>";

    
}else{
    echo "<script>alert('餘額不足或尚未購買商品');location.href='index.php';</script>";
    // header('refresh:3;url="buycar.php"');
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>