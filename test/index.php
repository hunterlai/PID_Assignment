<?php
require("locker.php");
$arr = [];
if(isset($_SESSION["username"])){
    $user=$_SESSION["username"];
    if(isset($_SESSION['cart'])){
        $arr = $_SESSION['cart'];
    }
}else{
    $user="Vistor";
}
if(isset($_GET["out"])){
    $_SESSION=array();
}
if(isset($_POST["okbtn"])){
    $name=$_POST["newName"];
    $password=$_POST["newPassword"];
    $options=[
        'cost' =>12
    ];
    $hash = password_hash($password, PASSWORD_DEFAULT,$options);
    $sql_new ="insert into player (userName,userPassword,auth) values ('$name','$hash','VorC');";
    // echo $sql_new;
    require("condb.php");
    $result_new=mysqli_query($link,$sql_new);
    header("location: index.php");
}
require("condb.php");
$sql="select prodId,prodName,unitPrice from products where display = 1";
$result=mysqli_query($link,$sql);

if(isset($_POST["okbutton"])){
    $userName=$_POST["username"];
    $userPassword=$_POST["password"];
    if($userName!="" && $userPassword!=""){
        require("condb.php");
        $sql_login="select userName, userPassword from player where userName = '$userName'";
        $result_login=mysqli_query($link,$sql_login);
        $row_login=@mysqli_fetch_assoc($result_login);
        var_dump($row_login);
        if($row_login["userName"]=='admin' || $row_login["userName"]=='root' || $row_login["userName"]=='qwe'){
            if($row_login["userPassword"]==strval($userPassword)){
                $sUserName = $_POST["username"];
                if (trim($sUserName) != "")
                {   
                    session_start();
                    $_SESSION["username"]=$sUserName;
                    header("Location: index.php");
                }
            }else{
                header("Location: index.php");
            }   
        }
        if(password_verify($userPassword,$row_login["userPassword"])){
            $sUserName = $_POST["username"];
            if (trim($sUserName) != "")
            {   
                session_start();
                $_SESSION["username"]=$sUserName;
                header("Location: index.php");
            }
        }else{
            echo "使用者名稱或密碼錯誤";
        }
    }else{
        echo "表單不完整 ";
    }
}
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
    <title>Document</title>
    <script type="text/javascript" src="./jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(test);
        $testn=0;
        function test(){
            $("#cart").on("click",function(){
                $testn++;
                if($testn%2 ==1){
                    $("#meau").css("left","0");
                }else{
                    $("#meau").css("left","-200px");
                } 
            });
            $("#newName").on("keyup",function(){
                $("#okbtn").prop("disabled",true);
            })
            $("#test").on("click",function(){
                var t=$("#newName").val();
                if(jQuery.trim(t)==""){
                    $("#authname").val("不為空值");
                    $("#authname").css("color","blue");  
                }
                $.getJSON("same.php",{name:t},function(data){
                    if(data==0){
                        $("#authname").val("名稱已被註冊");
                        $("#authname").css("color","red");
                        $("#okbtn").prop("disabled",true);
                    }else if(data==1){
                        $("#authname").val("名稱可以註冊");
                        $("#authname").css("color","green");
                        $("#okbtn").prop("disabled",false);
                    }
                });
                
            })
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
        padding: 10px;
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
        height: auto;
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
     .navbar{
         margin:0;
     }
     .meau{
         position:absolute;
         left:-200px;
         width:200px;
         height:600px;
         background-color:#20b2aa;
         float:left;
         opacity:.8;
     }
     .ml-auto{
         left:auto;
         right:0;
     }
     .resize{
         width:50px;
         height:50px;
     }
     .recolor{
        color:white;
     }    
    </style>
    
</head>
<body>
    <div class="header">
        <h1>HEAD</h1>
    </div>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="#">shop</a>
        <ul class="navbar-nav bg-dark ">
                <li class="nav-item">
                    <a class="nav-link" id="home">您好！<?=$user?></a>
                </li>
                <?php if($user!='Vistor' && $user!='admin' && $user!='root'){?>
                <li class="nav-item">
                    <a class="nav-link" href="buycar.php">購物庫</a>
                </li>
                <?php } ?>
        </ul>
        <ul class="ml-auto bg-dark">
            <?php if($user=='Vistor'){?>
            <li class="nav-item ">
            <button type="button" class="btn btn-primary btn-sm text-center" data-toggle="modal" data-target="#Modal" >
            <svg width="1em" height="1em" viewBox="0 0 16 16" style="margin-bottom:2px;" class="bi bi-person-circle " fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
            <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
            </svg>
            登／註</button>
            </li>
            <?php }else if($user=='admin'||$user=='root'){?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php?out=1">登出</a>
                </li>
                <li class="nav-item">
                    <a href="./admin/" class="nav-link" id="cart" style="cursor:pointer"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-wrench" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.252A3.003 3.003 0 0 0 13 16a3 3 0 1 0-.851-5.878L5.897 3.781A3.004 3.004 0 0 0 2.223.1l2.141 2.142L4 4l-1.757.364L.102 2.223zm13.37 9.019L13 11l-.471.242-.529.026-.287.445-.445.287-.026.529L11 13l.242.471.026.529.445.287.287.445.529.026L13 15l.471-.242.529-.026.287-.445.445-.287.026-.529L15 13l-.242-.471-.026-.529-.445-.287-.287-.445-.529-.026z"/>
                    </svg>管理端</a>
                </li>
            <?php }else{ ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php?out=1">登出</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cart" style="cursor:pointer"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-fill " style="margin-bottom:5px;" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                    </svg>購物車</a>
                </li>
            <?php } ?>
        </ul>
    </nav>
    <div class="content">
        <div class="meau" id="meau">
        <?php if($arr == []){?>
            尚無商品
        <?php }else{?>
            購物中
            <?php foreach($arr as $val){?>
                <div>
                    <p>編號：<?=$val["prodId"]?>&nbsp;名稱：<?=$val["prodName"]?><br>數量：<?=$val["unitStock"]?><br><a  href="delete.php" style="color:red;">刪除</a></p>
                </div>
            <?php }?>
                <p><a href="buycar.php" style="color:blue;">購物庫</a></p>
        <?php } ?>
        </div>

        <div class="container">
        <br>
        <table class="table table-striped">
            <thead class="table-primary">
            <tr>
                <th>編號</th>
                <th>圖片</th>
                <th>名稱</th>
                <th>購買</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php while($row=mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?=$row["prodId"]?></td>
                <td><img class="resize" src="./img/<?=$row["prodId"]?>.jpg"></td>
                <td><?=$row["prodName"]?></td>
                <td><?=$row["unitPrice"]?></td>
                <?php if ($user == "Vistor" ) { ?>
                    <td><p type="text" style="color:red">請先註冊或登入</p></td>
                <?php }else{ ?>
                    <td><a href="cart.php?prodId=<?=$row["prodId"]?>&prodName=<?=$row["prodName"]?>" style="color:green" >加入購物車</a></td>
                <?php }?>
            </tr>
            <?php }?>
                    
            </tbody>
        </table>
        </div>
    </div>
    <div class="footer">
        <a href="#" style="color:black;">email</a>
        <a href="#" style="color:black;">請聯繫XX-12345678</a>
    </div>

    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">登入／註冊</h5>
            </div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#tab1" data-toggle="tab" class="nav-link active">登入</a>
                </li>
                <li class="nav-item">
                    <a href="#tab2" data-toggle="tab" class="nav-link ">註冊</a>
                </li>
            </ul> 
        <div class="modal-body container" >
            <div class="tab-content">
            <div id="tab1" class="container tab-pane active">
            <p>
                <form method="post">
                <div class="form-group">
                    <label for="username" class="col-form-label">帳號</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password" class="col-form-label">密碼</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="modal-footer">
                <button type="submit" name="okbutton" class="btn btn-primary">登入</button>
                </div>
                </form>
            </p>
            </div>
            <div id="tab2" class="container tab-pane fade">
            <p>
                <form method="post">
                <div class="form-group col-md-9">
                    <label for="newName" class="col-form-label">
                    新用戶名稱<input type="text" id="authname" name="authname" style="border:0; background-color:white;" value="" readonly="readonly">
                    </label>
                    <input type="text" class="form-control" id="newName" name="newName">
                    <button type="button" class="btn btn-primary" id="test">驗證</button>
                </div>
                <div class="form-group col-md-9">
                    <label for="newPassword" class="col-form-label">設定密碼</label>
                    <input type="password" class="form-control" id="newPassword" name="newPassword">
                </div>
                <div class="modal-footer">
                <button type="submit" name="okbtn" id="okbtn" class="btn btn-primary" disabled="disabled">註冊</button>
                </div>
                </form>
            </p>
            </div>
            </div>
        </div>
        
        </div>
    </div>
    </div>
    
</body>
</html>