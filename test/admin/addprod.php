<?php
require("session.php");
require("condb.php");

if(isset($_POST["okbtn"])){
    $prodname=$_POST["prodName"];
    $unitprice=$_POST["unitPrice"];
    $unitStock=$_POST["unitStock"];
    $display=$_POST["display"];

    $sql="insert into products (prodName,unitPrice,unitStock,display) values 
    ('$prodname',$unitprice,$unitStock,$display)";
    $show=mysqli_query($link,$sql);
    header("location: backend.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }
        fieldset {
            margin: 1.5em 0 0 0;
            padding: 0;
            border: 1px solid #CCC;
        }
        legend {
            margin-left: 1em;
            color: #009;
            font-weight: bold;
        }
        label {
            float: left;
            width: 10em;
            margin-right: 1em;
        }
        fieldset ol {
            list-style: none;
            padding-top: 3px;
            padding-left: 2em;
            padding-bottom: 3px;
        }
        fieldset li {
            line-height: 24px;
            margin-top: 5px;
            margin-bottom: 5px;
        }
        fieldset li input.fildform{
            line-height: 24px;
            height: 24px;
            border: 1px solid #CCC;
        }
        fieldset .submit {
            border-style: none;
        }
    </style>
</head>
<body>
    <form method="post">
    <fieldset>
        <legend>新增產品</legend>
            <ol>
            <li>
                <label for="prodName">prodName</label>
                <input id="prodName" name="prodName" type="text" class="fildform" placeholder="xxxshoe" />
            </li>
            <li>
                <label for="unitPrice">unitPrice</label>
                <input id="unitPrice" name="unitPrice" type="text" class="fildform" placeholder="number" />
            </li>
            <li>
                <label for="unitStock">unitStock</label>
                <input id="unitStock" name="unitStock" type="text" class="fildform" placeholder="number" />
            </li>
            <li>
                <label for="display">display</label>
                <input id="display" name="display" type="text" class="fildform" placeholder="0 or 1" />
            </li>
            </ol>
        </fieldset>
        <fieldset class="submit">
        <input class="submit" type="submit" value="Send" name="okbtn"/>
        </fieldset>
    </form>
</body>
</html>