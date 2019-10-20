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
    
?>