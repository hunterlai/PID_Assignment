<?php
require("session.php");
require("condb.php");
$id=$_GET["prodId"];
$sql="select prodName,unitPrice,unitStock,display,picId from products where prodId = $id";
// echo $sql;
$show=mysqli_query($link,$sql);
    if(isset($_POST["okbtn"])){
        $prodname=$_POST["prodName"];
        $unitprice=$_POST["unitPrice"];
        $unitStock=$_POST["unitStock"];
        $display=$_POST["display"];
        $img=$_POST["img"];

        $sql2="update products set prodName='$prodname',unitPrice=$unitprice,unitStock=$unitStock,display=$display,picId='$img' where prodId=$id";
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
    <script type="text/javascript" src="./jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(test);
        function test(){

            $("#select").on("change",function(){
                readURL(this);
                var files=$("#select")[0].files;
                var arr;
                for(var i=0;i<files.length;i++){
                    arr=files.item(i);
                }
                $("#img").val(arr.name);
            });
            function readURL(input){
                if(input.files && input.files[0]){
                    var reader= new FileReader();
                    reader.onload =function(e){
                        $("#imgshow").prop('src',e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        }
    </script>
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
                <input id="display" name="display"  type="number" value="<?=$row["display"]?>" min="0" max="1"/>
            </li>
            <li>
                <label for="img">img</label>
                <input id="img" name="img" type="text" class="fildform" value="<?=$row["picId"]?>" />
            </li>
            <li>
                <label for="select">select</label>
                <input id="select" name="select" type="file" class="fildform"  accept="image/gif, image/jpeg, image/png" />
            </li>
            <li>
                <label for="img">預覽</label>
                <img id="imgshow" style="width:100px; height:100px;" src="../img/<?=$row["picId"]?>" class="fildform">
            </li>
            </ol>
            <?php }?>
        </fieldset>
        <fieldset class="submit">
        <input class="submit" type="submit" value="Send" name="okbtn"/>
        <input class="submit" type="button" value="reback" name="rebtn" onclick="history.back()"/>
        </fieldset>
    </form>
</body>
</html>