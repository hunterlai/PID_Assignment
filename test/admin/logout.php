<?php
if(isset($_GET["out"])){
    session_start();
    session_unset();
    session_destroy();
    header("location: http://localhost/PID_Assignment/test/");
    exit();
}
?>