<?php

    session_start();

    unset($_COOKIE["sessionID"]);
    setcookie("sessionID", '', time() - 3600, "/");
    
    header("Location: ../");

?>