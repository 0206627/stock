<?php

    if(isset($_SESSION)) {
        session_destroy();
    }
    
    include("config.php");
    session_start();

    if(isset($_POST)) {

        $username = $_POST['username'];
        $password = MD5($_POST['password']);

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $connect->query($sql);

        if(!$result){
            echo -1;
            return;
        }

        if($result->num_rows != 1) {
            echo 0;
            return;
        }

        // Save user info
        $user = $result->fetch_assoc();
        $_SESSION["user_id"] = $user['user_id'];
        $_SESSION["username"] = $user['username'];
        $_SESSION["email"] = $user['email'];
        $_SESSION["is_admin"] = $user['is_admin'];

        echo 1;
        return;

    } else {
        echo 'No data';
    }

?>