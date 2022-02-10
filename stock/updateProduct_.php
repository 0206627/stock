<?php

    include("config.php");
    session_start();

    if(isset($_POST)) {

        $product_id = $_POST['product_id'];
        $product = $_POST['product'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category_id = $_POST['category_id'];

        $sql = "UPDATE products set product_name='$product', price=$price, quantity=$quantity, category_id=$category_id where product_id=$product_id";
        $result = $connect->query($sql);

        if(!$result){
            echo -1;
            return;
        }

        echo 1;
        return; 
        
    } else {
        echo 'No data';
    }

?>