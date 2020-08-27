<?php
    
    if(isset($_POST["okbutton"])){
        $name=$_POST["username"];
        $password=$_POST["password"];
        require("./condb.php");
        $sql="select userName,auth from player where userName='$name' and userPassword='$password' ";
        $result=mysqli_query($link,$sql);
        $row=mysqli_fetch_assoc($result);
            echo "login :".$row["userName"].$row["auth"]."<br>";
        if($row["auth"] == 'admin'||$row["auth"] == 'root'){
            session_start();
            $suser=$_POST["username"];
            $_SESSION["suser"]=$suser;
            echo "i can write";
            header("location: backend.php");
        }else{
            echo "u can't enter";
            header("location: http://localhost/PID_Assignment/test/");
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
    <h1>Admin</h1>
    <form method="post" >
    <div class="form-group">
        <label for="text">user</label>
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