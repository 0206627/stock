<?php

    include("config.php");
    session_start();

    if(isset($_POST)) {

        $id = $_SESSION["user_id"];
        $users = array();

        $sql = "SELECT * FROM users WHERE user_id != $id";
        $result = $connect->query($sql);

        if(!$result){
            echo -1;
            return;
        }

        while($user = $result->fetch_assoc()) {
            $users[] = array(
                'user_id' => $user['user_id'], 
                'username' => $user['username'], 
                'email' => $user['email'], 
                'is_admin' => $user['is_admin']
            );
        }

        $_SESSION['users'] = $users;

    } else {
        echo 'No data';
    }

?>