<?php
$id=$_GET['name'];
require "condb.php";
$sql="select userName from player where userName='$id'";
$result=mysqli_query($link,$sql);
$row=mysqli_fetch_assoc($result);

if(isset($row["userName"])){
    echo 0;
}else if(!isset($row["userName"])&& !empty($id)){
    echo 1;
}else if(!isset($row["userName"])&& empty($id)){
    echo 2;
}



?>