<?php
session_start();
if(isset($_SESSION["username"])){
    $user=$_SESSION["username"];
}else{
    $user="Vistor";
}
require("condb.php");

$sql="select auth from player where userName = '$user' ";
$danger=mysqli_query($link,$sql);
$fin=mysqli_fetch_assoc($danger);

if($fin["auth"]=='lock'){
    session_unset();
    session_destroy();
}




?>