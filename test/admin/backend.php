<?php
require("session.php");
require("condb.php");
$sql="select prodId,prodName,unitPrice,unitStock,display,picId from products ";
$result=mysqli_query($link,$sql);

$suser="select userId,userName,auth from player where userName != 'root' and userName != 'admin'";
$result2=mysqli_query($link,$suser);

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
        <span class="float-right">
          <a href="logout.php?out=1" class="btn btn-outline-dark btn-sm">logout!</a>    
        </span>
  <h2>admin set</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <h4>Product &nbsp; <a href="../index.php" class="btn btn-outline-success btn-sm">觀看主頁面</a></h4>
        <th>prodId</th>
        <th>prodName</th>
        <th>unitPrice</th>
        <th>unitStock</th>
        <th>0為下架</th>
        <th>pic</th>
        <span class="float-right">
          <a href="addprod.php" class="btn btn-outline-primary btn-sm">add product</a>    
        </span>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row=mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?=$row["prodId"]?></td>
        <td><?=$row["prodName"]?></td>
        <td><?=$row["unitPrice"]?></td>
        <td><?=$row["unitStock"]?></td>
        <td><?=$row["display"]?></td>
        <td><img style="width:50px; height:40px;" src="../img/<?=$row["picId"]?>"></td>
        <td>
            <span class="float-right">
                <a href="edit.php?prodId=<?=$row["prodId"]?>" class="btn btn-outline-success btn-sm" name="edit">Edit</a>
                |
                <a href="display.php?prodId=<?=$row["prodId"]?>" class="btn btn-outline-danger btn-sm" name="delete">Delete</a>
            </span>
        </td>
      </tr>
      <?php } ?>
      
      
    </tbody>
  </table>
  <table class="table table-striped">
    <thead>
      <tr>
        <h4>會員</h4>
        <th>編號</th>
        <th>名稱</th>
        <th>購買紀錄</th>
        <th>狀態</th>
        <th>鎖住使用者</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row2=mysqli_fetch_assoc($result2)) { ?>
      <tr>
        <td><?=$row2["userId"]?></td>
        <td><?=$row2["userName"]?></td>
        <td><a href="buywt.php?userId=<?=$row2["userId"]?>">查看</a></td>
        <td><?=$row2["auth"]?></td>
        <td>
            <a href="lock.php?auth=<?=$row2["auth"]?>&userId=<?=$row2["userId"]?>"><?=$row2["auth"]?></a>
        </td>
        
      </tr>
      <?php } ?>  
    </tbody>
  </table>
</div>


</body>
</html>
