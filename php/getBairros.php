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
        $proposito = filtraEntrada($_POST["proposito"]);

        try {
            $sql = "SELECT DISTINCT Bairro FROM imovel WHERE TipoTransacao = ?";

            try {
                $st = $conn->prepare($sql);
                $st->execute([$proposito]);
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
                if ($proposito == 1) {
                    echo "Não encontramos nenhum imóvel à venda!";
                } else if ($proposito == 2) {
                    echo "Não encontramos nenhum imóvel para locação!";
                }
                
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    $conn = null;

?>