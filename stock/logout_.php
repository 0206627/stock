<?php

    // Destroy session
    session_start();
    session_destroy();
    echo "You have logged out.";

?>