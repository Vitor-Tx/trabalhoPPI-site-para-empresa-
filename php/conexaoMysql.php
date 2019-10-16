<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $nomeBD = "bonfins";

    // Inicia uma nova conexão com o servidor MySQL.
    // Em caso de sucesso na conexão, a variável $conn será
    // ser utilizada posteriormente para manipulação do banco
    // de dados através dessa conexão
    $conn = new mysqli($servidor, $usuario, $senha, $nomeBD);

    // Verifica se ocorreu alguma falha durante a conexão
    if ($conn->connect_error)
        die("Falha na conexão com o MySQL: " . $conn->connect_error);
?>