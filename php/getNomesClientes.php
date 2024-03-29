<?php 

    require "conexaoMysql.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "SELECT ID, Nome FROM cliente";

        $result = $conn->query($sql);
        if (! $result)
            throw new Exception("Falha na busca de clientes: " . $conn->error);
        
        $dados = array();

        while ($row = $result->fetch()) {
            $row = array_map('utf8_encode', $row);
            array_push($dados, $row);
        }

        echo json_encode($dados);
    }

    $conn = null;

?>