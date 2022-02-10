<?php

    include("config.php");
    session_start();

    if(isset($_POST)) {

        $category = $_POST['category'];
        $code = $_POST['code'];

        $sql = "INSERT INTO categories (category_name, category_code) VALUES ('$category', '$code')";
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