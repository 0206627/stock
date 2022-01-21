<?php

    include("config.php");
    session_start();

    if(isset($_POST)) {

        $id = $_POST["id"];

        $sql = "DELETE FROM products WHERE product_id = $id";
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