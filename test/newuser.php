<?php
    if(isset($_POST["okButton"])){
        $name=$_POST["newName"];
        $password=$_POST["newPassword"];
        $sql ="insert into player (userName,userPassword) values ('$name','$password');";
        require("condb.php");
        mysqli_query($link,$sql);
        header("location: index.php");
        // echo $sql;
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
    <h1>新用戶</h1>
    <form method="post">
        <div>
            <label for = "newName">帳號名稱</label>
            <input type= "text" name = "newName" />
        </div>
        <div>
            <label for = "newName">密碼</label>
            <input type= "password" name = "newPassword" />
        </div>
        <!-- <div>
            <label for = "newName">密碼確認</label>
            <input type= "text" name = "verifyPassword" />
        </div> -->
        <button name="okButton" type="submit">送出</button>
    </form>
</body>
</html>