<?php

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeBD = "bonfins";

    try {
        $conn = new PDO("mysql:host=$servidor;dbname=$nomeBD", $usuario, $senha);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
?>