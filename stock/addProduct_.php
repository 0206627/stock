<?php

    include("config.php");
    session_start();

    if(isset($_POST)) {

        $product = $_POST['product'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $category_id = $_POST['category_id'];

        $sql = "INSERT INTO products (product_name, price, quantity, category_id) VALUES ('$product', $price, $quantity, $category_id)";
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