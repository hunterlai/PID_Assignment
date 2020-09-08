<?php
require("session.php");
require("condb.php");
$id=$_GET["userId"];
$sql="select od.orderId,p.prodId,qty,prodName from order_detail od join orders o 
on o.orderId=od.orderId join products p on p.prodId = od.prodId where o.userId = $id";
$result=mysqli_query($link,$sql);

// echo $sql;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./jquery.min.js"></script>

    <title>Document</title>
</head>
<body>
    <div class="container">
        <h4>購買紀錄
        </h4>
    </div>
    <div class="container">
    <table class="table">
    <thead>
        <span style="float:right;"><a href="backend.php">返回</a></span>
        <tr>
        <th >訂單編號</th>
        <th >產品編號</th>
        <th >產品名稱</th>
        <th >購買數量</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row=mysqli_fetch_assoc($result)){?>
        <tr>
        <th><?=$row["orderId"]?></th>
        <td><?=$row["prodId"]?></td>
        <td><?=$row["prodName"]?></td>
        <td><?=$row["qty"]?></td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    </div>
</body>
</html>