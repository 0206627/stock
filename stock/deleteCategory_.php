<?php

    include("config.php");
    session_start();

    if(isset($_POST)) {

        $id = $_POST["id"];

        // First delete all related products
        $sql = "DELETE FROM products WHERE category_id = $id";
        $result = $connect->query($sql);

        if(!$result){
            echo -1;
            return;
        }

        // Finally delete the category
        $sql = "DELETE FROM categories WHERE category_id = $id";
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