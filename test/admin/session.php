<?php
session_start();
if(isset($_SESSION["suser"])){
    $suser=$_SESSION["suser"];
}else{
    header("location: http://localhost/PID_Assignment/test/");
    exit();
}

?>