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

        if (isset($_POST["numeroApartamento"])) {
            $numeroApartamento  =   filtraEntrada($_POST["numeroApartamento"]);
        } else {
            $numeroApartamento  =   null;
        }

        if (isset($_POST["piscina"])) {
            $piscina            =   filtraEntrada($_POST["piscina"]);
        } else {
            $piscina            =   null;
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
                        $valor,
                        $porcentagemImobiliaria,
                        $tipoImovel
                    ]
                );

                $sql = "SELECT @id := MAX(ID) FROM imovel;";

                $result = $conn->query($sql); 
                if (!$result)
                    throw new Exception("Falha ao recuperar o ID: " . $conn->error);

                try {
                    if ($tipoImovel == 1) {
                        $sql = "INSERT INTO casa (ID, Piscina) VALUES (@id, ?)";
    
                        $st = $conn->prepare($sql);
                        $st->execute([$piscina]);
                    } else if ($tipoImovel == 2) {
                        $sql = "INSERT INTO apartamento (
                                    ID, 
                                    Andar, 
                                    ValorCondominio, 
                                    Portaria24Horas, 
                                    NumeroApartamento
                                )
                                VALUES (
                                    @id,
                                    ?,
                                    ?,
                                    ?,
                                    ?
                                )";
    
                        $st = $conn->prepare($sql);
                        $st->execute([$andar, $valorCondominio, $portaria24horas, $numeroApartamento]);
                    }
                } catch (Exception $e) {
                    $conn->rollback();
                    throw $e;
                }

                try {
                    $st = $conn->prepare("INSERT INTO proprietario (PessoaID, ImovelID) VALUES (?, @id)");

                    foreach ($proprietarios as $proprietario) {
                        $st->execute([$proprietario]);
                    }
                } catch (Exception $e) {
                    $conn->rollback();
                    throw $e;
                }

                $sql = "SELECT MAX(ID) as ID FROM imovel;";

                $result = $conn->query($sql); 

                $row = $result->fetch(PDO::FETCH_ASSOC);
                
                $id = $row["ID"];

                $targetDir  = "../assets/images/uploads/";
                $allowTypes = array('jpg','png','jpeg');

                $nomeArquivos = array();
                $x = 0;

                date_default_timezone_set("America/Sao_Paulo"); 

                $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
                if (!empty(array_filter($_FILES["imagens"]["name"]))) {
                    foreach ($_FILES["imagens"]["name"] as $key=>$val) {
                        $x++;

                        $fileName = $id . "-" . date('dmy-his-') . $x . "." . pathinfo($_FILES['imagens']['name'][$key], PATHINFO_EXTENSION); 

                        $targetFilePath = $targetDir . $fileName;

                        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                        if(in_array($fileType, $allowTypes)) {
                            if(move_uploaded_file($_FILES["imagens"]["tmp_name"][$key], $targetFilePath)){
                                array_push($nomeArquivos, $fileName);
                            } else {
                                $errorUpload .= $_FILES['imagens']['name'][$key].', ';
                            }
                        } else {
                            $errorUploadType .= $_FILES['imagens']['name'][$key].', ';
                        }
                    }
                }

                if (count($nomeArquivos) > 0) {
                    try {
                        $st = $conn->prepare("INSERT INTO imagem (Imagem, ImovelID) VALUES (?, $id)");

                        foreach ($nomeArquivos as $imagem) {
                            $st->execute([$imagem]);
                        }
                    } catch (Exception $e) {
                        $conn->rollback();
                        throw $e;
                    }
                }

                if ($errorUpload != "") {
                    echo $errorUpload;
                } else {
                    $conn->commit();
                    echo "Imóvel cadastrado com sucesso";
                }
            } catch (Exception $e) {
                $conn->rollback();
                throw new Exception("Falha ao cadastrar o imóvel: " . $e);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    $conn = null;

?>