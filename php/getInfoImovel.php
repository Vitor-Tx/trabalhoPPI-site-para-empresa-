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

        $id = filtraEntrada($_POST["id"]);

        try {

            $sql = "SELECT 
                        i.Rua,
                        i.Numero,
                        i.Bairro,
                        i.Cidade,
                        i.Estado,
                        i.QuantidadeQuartos,
                        i.QuantidadeSuites,
                        i.QuantidadeSalaEstar,
                        i.QuantidadeSalaJantar,
                        i.QuantidadeVagasGaragem,
                        i.Area,
                        i.ArmarioEmbutido,
                        i.Descricao,
                        i.Andar,
                        i.ValorCondominio,
                        i.Portaria24Horas,
                        i.Valor,
                        i.TipoTransacao,
                        ti.Nome as TipoImovel
                    FROM 
                        imovel as i,
                        tipoImovel as ti
                    WHERE
                        i.ID = ? AND
                        i.TipoImovel = ti.ID";
                    
            try {

                $st = $conn->prepare($sql);
                $st->execute([$id]);

            } catch (Exception $e) {
                throw $e;
            }

            $dados = array();

            if ($st->rowCount() > 0) {
	    
                while($row = $st->fetch()) {
                    array_push($dados, $row);
                }
        
                echo json_encode($dados);
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

?>