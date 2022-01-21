<?php

    include("config.php");
    session_start();

    if(isset($_POST)) {

        $user = $_POST['user'];
        $email = $_POST['email'];
        $user_id = $_POST['user_id'];
        $is_admin = $_POST['is_admin'];

        $sql = "UPDATE users set username='$user', email='$email', is_admin=$is_admin where user_id=$user_id";
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