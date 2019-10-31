<?php 

    require "conexaoMysql.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id         = $_POST["id"];
        $quantidade = $_POST["quantidade"];
        if (isset($_POST["index"])) {
            $index  = $_POST["index"];
        }

        try {

            $sql = "SELECT DISTINCT Imagem FROM imagem WHERE ImovelID = $id LIMIT $quantidade";

            try {
                $result = $conn->prepare($sql);
                $result->execute();
            } catch (Exception $e) {
                throw $e;
            }

            $dados = array();

            if (isset($_POST["index"])) {
                array_push($dados, $index);
            }

            if ($result->rowCount() > 0) {
	    
                while($row = $result->fetch()) {
                    $row = array_map('utf8_encode', $row);
                    array_push($dados, $row);
                }
        
                echo json_encode($dados);
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    $conn = null;

?>