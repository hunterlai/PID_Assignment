<?php
require("session.php");
require("condb.php");
$id=$_GET["prodId"];
$sql="update products set display=0 where prodId = $id";
$disp=mysqli_query($link,$sql);

header("location: backend.php");

?>