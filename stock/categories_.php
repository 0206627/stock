<?php

include("config.php");
session_start();

if(isset($_POST)) {

    $categories = array();

    $sql = "SELECT * FROM categories";
    $result = $connect->query($sql);

    if(!$result){
        echo -1;
        return;
    }

    while($category = $result->fetch_assoc()) {
        $categories[] = array(
            'category_id' => $category['category_id'], 
            'category_name' => $category['category_name'], 
            'category_code' => $category['category_code'], 
        );
    }

    $_SESSION['categories'] = $categories;

} else {
    echo 'No data';
}

?>