<?php
    session_start();
    
      
      if(isset($_SESSION['username'])){
        $username=$_SESSION['username'];
        require("condb.php");
        $sql="select userId from player where userName = '{$username}' ";
        $result=mysqli_query($link,$sql);
          $row=mysqli_fetch_assoc($result);
        if(isset($_SESSION['cart'])){
          $arr = $_SESSION['cart'];
          } else{
            $arr=[];
          }
      }else{
      echo '未登入';
      }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="./jquery.min.js"></script>

</head>
<body>

<div class="container">
  <h2>Buying List</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ProdId</th>
        <th>UnitStock</th>
        <th>ProductName</th>
        <th>UnitPrice</th>
        <th>sum</th>
        <span class="float-right">
          <a href="index.php" class="btn btn-outline-success btn-sm">首頁</a>    
        </span>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php foreach ($arr as $v => $val){?>
        <td><?=$val["prodId"]?></td>
        <td><?=$val["unitStock"]?></td>
        <td><?=$val["prodName"]?></td>
        <td><?=$val["unitPrice"]?></td>
        <td><?=$val["unitPrice"]*$val["unitStock"]?></td>
        <td>
            <span class="float-right">
                <a href="delete.php?prodId=<?=$val["prodId"]?>" class="btn btn-outline-danger btn-sm" name="delete">Delete</a>
            </span>
        </td>
      </tr>
        <?php } ?>
      <tr >
        <td></td>
        <td></td>
        <td></td>
        <td >
          <a>總計</a>
        </td>
      <?php $sum=0;
            foreach ($arr as $v => $val){
              $sum +=$val["unitPrice"]*$val["unitStock"];
            } ?>
        <td><?=$sum?></td>
        <td></td>
      </tr>
      <tr >
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td >
          <span class="float-right">
            <a href="gocash.php?userId=<?=$row["userId"]?>" name="cashbtn" class="btn btn-outline-info btn-sm">結帳</a>
          </span>
        </td>
      </tr>
    </tbody>
  </table>
</div>


</body>
</html>
