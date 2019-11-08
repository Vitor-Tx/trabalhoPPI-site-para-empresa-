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
                        CASE
                            WHEN i.TipoImovel = 2 THEN a.Andar
                            ELSE null
                        END as Andar,
                        CASE
                            WHEN i.TipoImovel = 2 THEN a.ValorCondominio
                            ELSE null
                        END as ValorCondominio,
                        CASE
                            WHEN i.TipoImovel = 2 THEN a.Portaria24Horas
                            ELSE null
                        END as Portaria24Horas,
                        CASE
                            WHEN i.TipoImovel = 2 THEN a.NumeroApartamento
                            ELSE null
                        END as NumeroApartamento,
                        CASE
                            WHEN i.TipoImovel = 1 THEN c.Piscina
                            ELSE null
                        END as Piscina,
                        i.Valor,
                        i.TipoTransacao,
                        ti.Nome as TipoImovel
                    FROM 
                        imovel as i,
                        tipoImovel as ti,
                        casa as c,
                        apartamento as a
                    WHERE
                        i.ID = ? AND
                        i.TipoImovel = ti.ID AND
                        i.ID = CASE WHEN i.TipoImovel = 1 THEN c.ID ELSE a.ID END";
                    
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

    $conn = null;

?>