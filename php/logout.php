<?php

    session_start();

    unset($_COOKIE["sessionID"]);
    setcookie("sessionID", '', 1, "/");

    unset($_COOKIE["login"]);
    setcookie("login", '', 1, "/");

    session_destroy();
    
    header("Location: ../");

?>