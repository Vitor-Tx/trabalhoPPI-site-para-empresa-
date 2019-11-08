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
        $cep = filtraEntrada($_POST["cep"]);

        try {
            $sql = "SELECT 
                        Logradouro,
                        Bairro,
                        Cidade,
                        Estado 
                    FROM 
                        consultaEndereco 
                    WHERE 
                        CEP = ?";

            try {
                $st = $conn->prepare($sql);
                $st->execute([$cep]);
            } catch (Exception $e) {
                throw $e;
            }

            $dados = array();

            if ($st->rowCount() > 0) {
	    
                while($row = $st->fetch()) {
                    array_push($dados, $row);
                }
        
                echo json_encode($dados);
            } else {
                echo "Erro, não encontramos seu CEP em nosso sitema!";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    $conn = null;

?>