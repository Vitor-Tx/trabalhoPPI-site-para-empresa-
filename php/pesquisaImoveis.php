<?php 

    require "conexaoMysql.php";

    function filtraEntrada($dado) 
    {
        $dado = trim($dado);
        $dado = stripslashes($dado);
        $dado = htmlspecialchars($dado);

        return $dado;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $proposito      = filtraEntrada($_POST["proposito"]);
        $bairro         = filtraEntrada($_POST["bairro"]);
        $valMin         = filtraEntrada($_POST["valMin"]);
        $valMax         = filtraEntrada($_POST["valMax"]);
        $informacoes    = filtraEntrada($_POST["informacoes"]);

        try {

            $execute = array();

            $sql = "SELECT 
                    i.ID,
                    ti.Nome as TipoImovel,
                    i.Cidade,
                    i.Bairro,
                    i.QuantidadeQuartos,
                    i.QuantidadeSuites,
                    i.Area,
                    i.Valor
                FROM 
                    imovel as i,
                    tipoImovel as ti
                WHERE 
                    i.TipoImovel = ti.ID";

            if ($proposito != "") {
                $sql = $sql." AND i.TipoTransacao = ?";
                array_push($execute, $proposito);
            }

            if ($bairro != "") {
                $sql = $sql." AND i.Bairro = ?";
                array_push($execute, $bairro);
            }

            if ($valMin != "") {
                $sql = $sql." AND i.Valor >= ?";
                array_push($execute, $valMin);
            }

            if ($valMax != "") {
                $sql = $sql." AND i.Valor <= ?";
                array_push($execute, $valMax);
            }

            if ($informacoes != "") {
                $chaves = explode(" ", $informacoes);

                $sql = $sql." AND (";
                for ($x = 0; $x < count($chaves); $x++) {
                    $chave = $chaves[$x];

                    if ($x == 0) {
                        $sql = $sql." Descricao LIKE ?";
                    } else {
                        $sql = $sql." AND Descricao LIKE ?";
                    }

                    array_push($execute, "%".$chave."%");
                }
                $sql = $sql.");";
            }

            try {
                $st = $conn->prepare($sql);
                $st->execute($execute);
            } catch (Exception $e) {
                throw $e;
            }

            $dados = array();

            if ($st->rowCount() > 0) {
	    
                while($row = $st->fetch()) {
                    $row = array_map('utf8_encode', $row);
                    array_push($dados, $row);
                }
        
                echo json_encode($dados);
            } else {
                echo "Não encontramos nenhum imóvel para os seus critérios de busca";
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

?>