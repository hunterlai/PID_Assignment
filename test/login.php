<?php
    
    if(isset($_GET["out"])){
        session_start();
        session_unset();
        session_destroy();
        header("location: index.php");
        exit();
    }
    if(isset($_POST["okbutton"])){
        // echo "OK";
        $userName=$_POST["username"];
        $userPassword=$_POST["password"];
        if($userName && $userPassword){
            $sql="select userName, userPassword from player where userName = '$userName' and userPassword =$userPassword";
            require("condb.php");
            $result=mysqli_query($link,$sql);
            $row=mysqli_num_rows($result);
            if($row){
                $sUserName = $_POST["username"];
                if (trim($sUserName) != "")
                {   
                    session_start();
                    $_SESSION["username"]=$sUserName;
                    header("Location: index.php");
                    exit();
                }
            }else{
                echo "使用者名稱或密碼錯誤";
                // header('refresh:3;url="login.php"');
            }
        }else{
            echo "表單不完整 ";
            // header('refresh:2;url="login.php"');
        }
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
    <h1>登入</h1>
    <form method="post" >
    <div class="form-group">
        <label for="text">username</label>
        <input type="text" class="form-control" placeholder="username" id="username" name="username">
    </div>
    <div class="form-group">
        <label for="pwd">password</label>
        <input type="password" class="form-control" placeholder="Enter password" id="pwd" name="password">
    </div>
    <button name="okbutton" type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>