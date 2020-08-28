<?php
require("session.php");
require("condb.php");
$id=$_GET["prodId"];
$sql="select prodName,unitPrice,unitStock,display from products where prodId = $id";
$show=mysqli_query($link,$sql);
    if(isset($_POST["okbtn"])){
        $prodname=$_POST["prodName"];
        $unitprice=$_POST["unitPrice"];
        $unitStock=$_POST["unitStock"];
        $display=$_POST["display"];

        $sql2="update products set prodName='$prodname',unitPrice=$unitprice,unitStock=$unitStock,display=$display where prodId=$id";
        // echo $sql2;
        $show2=mysqli_query($link,$sql2);
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
            <?php while($row=mysqli_fetch_assoc($show)){?>
            <ol>
            <li>
                <label for="prodName">prodName</label>
                <input id="prodName" name="prodName" type="text" class="fildform" value="<?=$row["prodName"]?>"/>
            </li>
            <li>
                <label for="unitPrice">unitPrice</label>
                <input id="unitPrice" name="unitPrice" pattern="\d*" type="text" class="fildform"  value="<?=$row["unitPrice"]?>"/>
            </li>
            <li>
                <label for="unitStock">unitStock</label>
                <input id="unitStock" name="unitStock" pattern="\d*" type="text" class="fildform" value="<?=$row["unitStock"]?>" />
            </li>
            <li>
                <label for="display">display</label>
                <input id="display" name="display" min="0" max="1" type="number" class="fildform" value="<?=$row["display"]?> "/>
            </li>
            </ol>
            <?php }?>
        </fieldset>
        <fieldset class="submit">
        <input class="submit" type="submit" value="Send" name="okbtn"/>
        </fieldset>
    </form>
</body>
</html>