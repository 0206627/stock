<?php

    include("config.php");
    session_start();

    if(isset($_POST)) {

        $category = $_POST['category'];
        $code = $_POST['code'];
        $category_id = $_POST['category_id'];

        $sql = "UPDATE categories set category_name='$category', category_code='$code' where category_id=$category_id";
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