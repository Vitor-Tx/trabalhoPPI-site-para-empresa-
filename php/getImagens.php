<?php 

    require "conexaoMysql.php";

    function filtraEntrada($dado) 
    {
        $dado = trim($dado);               // remove espaços no inicio e no final da string
        $dado = stripslashes($dado);       // remove contra barras: "cobra d\'agua" vira "cobra d'agua"
        $dado = htmlspecialchars($dado);   // caracteres especiais do HTML (como < e >) são codificados

        return $dado;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id         = filtraEntrada($_POST["id"]);
        $quantidade = (int) filtraEntrada($_POST["quantidade"]);

        if (isset($_POST["index"])) {
            $index  = filtraEntrada($_POST["index"]);
        }

        try {

            $sql = "SELECT Imagem FROM imagem WHERE ImovelID = ? LIMIT ?";

            try {
                $result = $conn->prepare($sql);
                $result->bindValue(1, $id, PDO::PARAM_INT);
                $result->bindValue(2, $quantidade, PDO::PARAM_INT);
                $result->execute();
            } catch (Exception $e) {
            	echo "teste";
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