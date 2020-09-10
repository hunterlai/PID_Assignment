<?php 
session_start();
$name=$_SESSION["username"];
require("condb.php");
$sql="select userId,userName,balance from player where userName = '$name'";
$sql2="select o.orderId,od.prodId,qty,unitPrice,prodName,orderDate from player pl join orders o on o.userId=pl.userId join 
order_detail od on od.orderId=o.orderId join products p on p.prodId=od.prodId where userName = '$name'";
// echo $sql2;
$result=mysqli_query($link,$sql);
$result2=mysqli_query($link,$sql2);

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
  <style>
a{
  text-decoration: none;
  color:blue;
}
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
<div class="container">
<h2>會員中心
    
</h2>
</div>
<div class="container">
  <table>
    <span class="float-right">
      <a class="btn btn-info" href="index.php">返回首頁</a>
    </span>
    <tr>
      <th>會員編號</th>
      <th>會員姓名</th>
      <th>餘額</th>
      <th></th>
    </tr>
    <?php while ($row=mysqli_fetch_assoc($result)){ ?>
    <tr>
      <td><?=$row["userId"]?></td>
      <td><?=$row["userName"]?></td>   
      <td><?=$row["balance"]?></td>
          <span class="float-right">
              <td><a href="putcash.php">充值系統</a></td>
          </span>
    </tr>
    <?php } ?>
  </table>
</div>
<br>
<div class="container">
        <h5>
          購買紀錄
        </h5>
    <table>
        <tr>
          <th>訂單編號</th>
          <th>訂單時間</th>
          <th>購買項目</th>
          <th>單價</th>
          <th>數量</th>
        </tr>
        <?php while ($row2=mysqli_fetch_assoc($result2)){ ?>
        <tr>
          <td><?=$row2["orderId"]?></td>
          <td><?=$row2["orderDate"]?></td>   
          <td><?=$row2["prodName"]?></td>
          <td><?=$row2["unitPrice"]?></td>
          <td><?=$row2["qty"]?></td>
        </tr>
        <?php } ?>
      </table>
</div>
</body>
</html>

