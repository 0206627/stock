<?php

    include("config.php");
    session_start();

    if(isset($_POST)) {

        $user = $_POST['user'];
        $email = $_POST['email'];
        $password = MD5($_POST['password']);

        $sql = "INSERT INTO users (username, password, email, is_admin) VALUES ('$user', '$password', '$email', 0)";
        $result = $connect->query($sql);

        if(!$result){
            echo -1;
            return;
        }

        // Save user info
        $_SESSION["user_id"] = $connect->insert_id;
        $_SESSION["username"] = $user;
        $_SESSION["email"] = $email;
        $_SESSION["is_admin"] = 0;

        echo 1;
        return;
        
    } else {
        echo 'No data';
    }

?>