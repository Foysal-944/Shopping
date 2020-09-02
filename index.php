<?php

session_start();
require_once('./php/CreateDb.php');
require_once('./php/component.php');

$database= new CreateDb("Prodcutdb", "Producttb");

if(isset($_POST['add'])){
    // print_r($_POST['product_id']);
    if(isset($_SESSION['cart'])){
        $item_array_id=array_column($_SESSION['cart'], "product_id");
        print_r($item_array_id);

        if(in_array($_POST['product_id'], $item_array_id)){
            echo"<script>alert('Product is already added in the cart')</script>";
            echo "<script>window.location='index.php'</script>";
        } else{
            $count=count($_SESSION['cart']);
            $item_array=array(
                'product_id'=>$_POST['product_id']
            );
            $_SESSION['cart'][$count]=$item_array;
            print_r($_SESSION['cart']);

        }

    }else{
        $item_array=array(
            'product_id'=>$_POST['product_id']
        );
        $_SESSION['cart']=$item_array;
        print_r($_SESSION['cart']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!--Font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css"/>

    <!--Bootstrap CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <?php require_once("php/header.php")  ?>
    
<div class="container">
    <div class="row text-center py-5">

        <?php
           $result = $database->getData();
           while($row= mysqli_fetch_assoc($result)){
               component($row['product_name'],$row['product_price'],$row['product_image'],$row['id']);
           }
            
            // productname, "Product1", productprice, 599, productimg, "./upload/product1.png"
        ?>

    </div>
    

</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
