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

        if (isset($_POST["valorVenda"])) {
            $valorVenda         =   filtraEntrada($_POST["valorVenda"]);
        } else {
            $valorVenda         =   null;
        }

        if (isset($_POST["valorAluguel"])) {
            $valorAluguel       =   filtraEntrada($_POST["valorAluguel"]);
        } else {
            $valorAluguel       =   null;
        }

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
        
        $imagens                =   $_POST["imagens"];

        $imagem = "";
        $proprietario = 0;

        for ($x = 0; $x < count($proprietarios); $x++) {
            $proprietarios[$x] = filtraEntrada($proprietarios[$x]);
        }

        try {
            $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

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
                        ValorVenda,
                        ValorAluguel,
                        PorcentagemImobiliaria,
                        TipoImovel
                    )
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);

            if (!$stmt)
                throw new Exception("Falha ao preparar a inserção de imóvel: " . $conn->error);

            $stmt->bind_param("sisssiiiiiisisididddi", 
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
                $valorVenda,
                $valorAluguel,
                $porcentagemImobiliaria,
                $tipoImovel);

            if (!$stmt->execute()) {
                throw new Exception("Falha na inserção do imóvel: " . $conn->error);
                $conn->rollback();
            }
                
            $sql = "SELECT @id := MAX(ID) FROM imovel;";

            if (! $conn->query($sql))
                throw new Exception("Falha ao recuperar o ID: " . $conn->error);

            $stmt = $conn->prepare("INSERT INTO imagem (Imagem, ImovelID) VALUES (?, @id)");

            $stmt->bind_param("s", $imagem);

            for ($y = 0; $y < count($imagens); $y++) {
                $imagem = $imagens[$y];
                if (!$stmt->execute()) {
                    throw new Exception("Falha na inserção das Imagens: " . $conn->error);
                    $conn->rollback();
                }
            }

            $stmt = $conn->prepare("INSERT INTO proprietario (PessoaID, ImovelID) VALUES (?, @id)");

            $stmt->bind_param("i", $proprietario);

            for ($z = 0; $z < count($proprietarios); $z++) {
                $proprietario = $proprietarios[$z];
                if (!$stmt->execute()) {
                    throw new Exception("Falha na inserção dos Proprietários: " . $conn->error);
                    $conn->rollback();
                }
            }

            $conn->commit();

            echo "Imóvel cadastrado com sucesso";

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    $conn->close();

?>