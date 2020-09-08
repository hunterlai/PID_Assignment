<?php 
session_start();
$name=$_SESSION["username"];
require("condb.php");
$sql="select userId,userName,balance from player where userName = '$name'";
// $sql2="select o.orderId,od.prodId,qty,prodName,orderDate from player pl join orders o on o.userId=pl.userId join 
// order_detail od on od.orderId=o.orderId join products p on p.prodId=od.prodId where userName = '$name'";

// echo $sql2;

$result=mysqli_query($link,$sql);
// $result=mysqli_query($link,$sql2);

?>
<!DOCTYPE html>
<html>
<head>
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
    <span class="float-right">
      <td><a href="index.php">返回首頁</a></td>
    </span>
</h2>
</div>
<div class="container">
  <table>
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


</body>
</html>
