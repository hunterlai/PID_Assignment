<?php
session_start();
if(isset($_SESSION["username"])){
    $arr = [0];
    @$arr = $_SESSION['cart'];
    $user=$_SESSION["username"];
}else{
    $user="Vistor";
}
if(isset($_GET["out"])){
    $_SESSION=array();
}
require("condb.php");
$sql="select prodId,prodName,unitPrice from products";

$result=mysqli_query($link,$sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
    <script type="text/javascript" src="./jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(test);
        $testn=0;
        function test(){
            $("#cart").on("click",function(){
                $testn++;
                if($testn%2 ==1){
                    $("#meau").css("display","inline");
                }else{
                    $("#meau").css("display","none");
                } 
            });
        }

    </script>
    <style type="text/css">
    body{
        margin:0;
    }
    a{
        display: block;
        text-decoration: none;
    }
    .header{
        padding: 50px;
        text-align: center;
        background: orange;
        color: white;
        font-size: 25px;
        height: 80px;
    }
    .content{
        height: 600px;
        text-align: center;
        background-color: wheat;
    }
    .footer{
        /* clear: both; */
        background-color: red;
        height: 40px;
        text-align: center;
        line-height: 40px;
    }
     nav ul{
         list-style-type:none;
         margin: 0;
         padding: 0;
         overflow: hidden;
         background-color: #333;
     }
     nav li{
         overflow:hidden;
         float: right;   
     }
     nav li a{
         color:white;
         text-align: center;
         padding: 14px 16px;
     }
     .content ul{
         margin:0;
         list-style-type:none;
     }
     
     
     .meau{
         position:relative;
         display:none;
         margin:0;
         width:200px;
         height:600px;
         background-color:#7c7c7c;
         float: left;
     }    
    </style>
    
</head>
<body>
    <div class="header">
        <h1>HEAD</h1>
    </div>
    <div class="nav">
        <nav>
            <ul>
                <?php if($user == 'Vistor'){?>
                    <li><a href="newuser.php">註冊</a></li>
                    <li><a href="login.php">登入</a></li>
                <?php }else{ ?>
                    <li><a href="login.php?out=1">登出</a></li>
                    <li><a href="info.php" id="info">會員資訊</a></li>
                    <li><a id="cart" style="cursor:pointer" >購物車</a></li>
                <?php }?>
                <li><a id="home">您好！<?=$user?></a></li>
                <li><a href="" id="home">首頁</a></li>     
            </ul>
        </nav>
    </div>
    <div class="content">
        <div class="meau" id="meau">
        <?php if($arr == []){?>
            尚無商品
        <?php }else{?>
            購物中
            <?php foreach($arr as $val){?>
                <div>
                    <p>編號：<?=$val["prodId"]?>&nbsp;名稱：<?=$val["prodName"]?><br>數量：<?=$val["unitStock"]?><br><a  href="delete.php" >刪除</a></p>
                </div>
            <?php }?>
                <p><a href="buycar.php">購物庫</a></p>
        <?php } ?>
        
            
        </div>
        <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>編號</th>
                <th>名稱</th>
                <th>購買</th>
                <!-- <th>數量</th> -->
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php while($row=mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?=$row["prodId"]?></td>
                <td><?=$row["prodName"]?></td>
                <td><?=$row["unitPrice"]?></td>
                <?php if ($user == "Vistor" ) { ?>
                    <td><p type="text" style="color:red">請先註冊或登入</p></td>
                <?php }else{ ?>
                    <!-- <td><input type="number" name="point" min="0" max="10" value="" oninput="test(event)"></td>
                    <script>
                    function test(e){
                        var value = e.target.value;
                        value = value.replace( /\D+/, "");
                        if(value.length > 0){
                            if(value.length > 1 && value[0] == 0){
                                e.target.value = value.substring(1, value.length);
                                return;
                            }
                            if(value.length>1){
                                e.target.value = value.slice(0,1);
                            }else{
                                e.target.value = value;
                            }
                            
                        }else{
                            e.target.value = 0;
                        };
                    }
                    </script> -->
                    <td><a href="cart.php?prodId=<?=$row["prodId"]?>&prodName=<?=$row["prodName"]?>" >加入購物車</td>
                <?php }?>
            </tr>
            <?php }?>
                    
            </tbody>
        </table>
        </div>
    </div>
    <div class="footer">footer</div>
    
    
</body>
</html>