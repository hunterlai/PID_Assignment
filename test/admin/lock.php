<?php
require("session.php");

$statu=$_GET["auth"];
$id=$_GET["userId"];

    if($statu=='VorC'){
        require("condb.php");
        $sql="update player set auth='lock' where userId = $id ";
        $result=mysqli_query($link,$sql);
        header("location: backend.php");
        exit();
    }else{
        require("condb.php");
        $sql="update player set auth='VorC' where userId = $id ";
        $result=mysqli_query($link,$sql);
        header("location: backend.php");
        exit();
    }
        

?>