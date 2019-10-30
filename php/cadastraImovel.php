<?php 

    require "conexaoMysql.php";

    // Valida uma string removendo alguns caracteres
    // especiais que poderiam ser provenientes
    // de ataques do tipo HTML/CSS/JavaScript Injection
    function filtraEntrada($dado) 
    {
        $dado = trim($dado);               // remove espaços no inicio e no final da string
        $dado = stripslashes($dado);       // remove contra barras: "cobra d\'agua" vira "cobra d'agua"
        $dado = htmlspecialchars($dado);   // caracteres especiais do HTML (como < e >) são codificados

        return $dado;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $msgErro = "";

        $login = $_COOKIE["login"];
        
        $tipoImovel             =   filtraEntrada($_POST["tipoImovel"]);
        $rua                    =   filtraEntrada($_POST["rua"]);
        $numero                 =   filtraEntrada($_POST["numero"]);
        $bairro                 =   filtraEntrada($_POST["bairro"]);
        $cidade                 =   filtraEntrada($_POST["cidade"]);
        $estado                 =   filtraEntrada($_POST["estado"]);
        $proprietarios          =   $_POST["proprietarios"];
        $tipoTransacao          =   filtraEntrada($_POST["tipoTransacao"]);
        $qtdQuartos             =   filtraEntrada($_POST["quantidadeQuartos"]);
        $qtdSuites              =   filtraEntrada($_POST["quantidadeSuites"]);
        $qtdSalaEstar           =   filtraEntrada($_POST["quantidadeSalaEstar"]);
        $qtdSalaJantar          =   filtraEntrada($_POST["quantidadeSalaJantar"]);
        $qtdVagasGaragem        =   filtraEntrada($_POST["quantidadeVagasGaragem"]);
        $area                   =   filtraEntrada($_POST["area"]);
        $armarioEmbutido        =   filtraEntrada($_POST["armarioEmbutido"]);
        $descricao              =   filtraEntrada($_POST["descricao"]);
        $porcentagemImobiliaria =   filtraEntrada($_POST["porcentagemImobiliaria"]);
        $valor                  =   filtraEntrada($_POST["valor"]);

        if (isset($_POST["andar"])) {
            $andar              =   filtraEntrada($_POST["andar"]);
        } else {
            $andar              =   null;
        }

        if (isset($_POST["valorCondominio"])) {
            $valorCondominio    =   filtraEntrada($_POST["valorCondominio"]);
        } else {
            $valorCondominio    =   null;
        }

        if (isset($_POST["portaria24horas"])) {
            $portaria24horas    =   filtraEntrada($_POST["portaria24horas"]);
        } else {
            $portaria24horas    =   null;
        }

        $proprietario = 0;

        for ($x = 0; $x < count($proprietarios); $x++) {
            $proprietarios[$x] = filtraEntrada($proprietarios[$x]);
        }

        try {
            $conn->beginTransaction();

            $sql = "SELECT @id := ID FROM funcionario WHERE Login = '$login'";

            $conn->query($sql);

            $sql = "INSERT INTO imovel (
                        Rua,
                        Numero,
                        Bairro,
                        Cidade,
                        Estado,
                        TipoTransacao,
                        QuantidadeQuartos,
                        QuantidadeSuites,
                        QuantidadeSalaEstar,
                        QuantidadeSalaJantar,
                        QuantidadeVagasGaragem,
                        Area,
                        ArmarioEmbutido,
                        Descricao,
                        Andar,
                        ValorCondominio,
                        Portaria24Horas,
                        Valor,
                        PorcentagemImobiliaria,
                        TipoImovel,
                        ValorReal,
                        DataInicio,
                        DataFim,
                        Vendido_Alugado,
                        FuncionarioResponsavel
                    )
                    VALUES (
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?, 
                        ?,
                        NULL,
                        NOW(),
                        NULL,
                        0,
                        @id)";

            try {
                $st = $conn->prepare($sql);
                $st->execute(
                    [
                        $rua,
                        $numero,
                        $bairro,
                        $cidade,
                        $estado,
                        $tipoTransacao,
                        $qtdQuartos,
                        $qtdSuites,
                        $qtdSalaEstar,
                        $qtdSalaJantar,
                        $qtdVagasGaragem,
                        $area,
                        $armarioEmbutido,
                        $descricao,
                        $andar,
                        $valorCondominio,
                        $portaria24horas,
                        $valor,
                        $porcentagemImobiliaria,
                        $tipoImovel
                    ]
                );
            } catch (Exception $e) {
                $conn->rollback();
                throw new Exception("Falha ao cadastrar o imóvel: " . $e);
            }
                
            $sql = "SELECT @id := MAX(ID) FROM imovel;";

            $result = $conn->query($sql); 
            if (!$result)
                throw new Exception("Falha ao recuperar o ID: " . $conn->error);

            try {
                $st = $conn->prepare("INSERT INTO proprietario (PessoaID, ImovelID) VALUES (?, @id)");

                foreach ($proprietarios as $proprietario) {
                    $st->execute([$proprietario]);
                }
            } catch (Exception $e) {
                $conn->rollback();
                throw $e;
            }

            $conn->commit();

            $sql = "SELECT MAX(ID) as ID FROM imovel;";

            $id = array();

            $result = $conn->query($sql); 

            $row = $result->fetch();
            $row = array_map('utf8_encode', $row);
            array_push($id, $row);

            echo json_encode($id);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    $conn = null;

?>