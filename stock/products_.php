<?php

include("config.php");
include("categories_.php");
session_start();

if(isset($_POST)) {

    $products = array();

    $sql = "SELECT products.product_id, products.product_name, products.price, products.quantity, products.category_id, categories.category_code 
            FROM products 
            INNER JOIN categories ON products.category_id=categories.category_id;";
    $result = $connect->query($sql);

    if(!$result){
        echo -1;
        return;
    }

    while($product = $result->fetch_assoc()) {
        $products[] = array(
            'product_id' => $product['product_id'], 
            'product_name' => $product['product_name'], 
            'price' => $product['price'], 
            'quantity' => $product['quantity'], 
            'category_id' => $product['category_id'], 
            'category_code' => $product['category_code'], 
        );
    }

    $_SESSION['products'] = $products;

} else {
    echo 'No data';
}

?>