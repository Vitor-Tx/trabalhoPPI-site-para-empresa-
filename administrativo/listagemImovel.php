<?php 
    if (!isset($_COOKIE["sessionID"])) {
        header("Location: ../");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Listagem de Imóveis</title>

        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="css/administrativo.css">
        <link rel="stylesheet" href="css/listagem.css">
    </head>
    <body>
        <section>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12 p-0">
                        <nav class="navbar navbar-expand-lg navbar-light sticky-top pt-0">
                            <a class="navbar-brand pt-0" href="../index.html">
                                <img class="logo-bonfins" src="../assets/images/logo-bonfins3.png">
                            </a>
                            <button 
                            class="navbar-toggler mt-2" 
                            type="button" 
                            data-toggle="collapse" 
                            data-target="#navbarSupportedContent" 
                            aria-controls="navbarSupportedContent" 
                            aria-expanded="false" 
                            aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                    
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto">
                                    <li class="mt-2 mr-3">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li class="mt-2 mr-3">
                                        <a href="cadastroFuncionario.php">Cadastrar Funcionário</a>
                                    </li>
                                    <li class="mt-2 mr-3">
                                        <a href="cadastroCliente.php">Cadastrar Cliente</a>
                                    </li>
                                    <li class="mt-2 mr-3">
                                        <a href="cadastroImovel.php">Cadastrar Imóvel</a>
                                    </li>
                                    <li class="mt-2 mr-3">
                                        <a href="listagemFuncionario.php">Listar Funcionários</a>
                                    </li>
                                    <li class="mt-2 mr-3">
                                        <a href="listagemCliente.php">Listar Clientes</a>
                                    </li>
                                    <li class="mt-2 mr-3">
                                        <a href="listagemInteresse.php">Listar Interesses</a>
                                    </li>
                                    <li class="mt-2 mr-3">
                                        <a href="../index.html">Sair</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 px-0">
                        <div id="listagemContainer" class="px-0">
                            <div class="container px-0">
                                <div class="jumbotron px-2">
                                    <h1 class="display-4">Listagem de Imóveis</h1>
                                    <hr class="my-3">
                                    <div id="admContainer">
                                        <?php 
                                        
                                            require "../php/conexaoMysql.php";
                                            require "../php/imovel.php";

                                            $msgErro = "";
                                            $arrayImoveis = null;
                                            $proprietarios = null;
                                            $imagem = null;

                                            try {
                                                $arrayImoveis = getImoveis($conn);  
                                            } catch (Exception $e) {
                                                $msgErro = $e->getMessage();
                                                echo $msgErro;
                                            }

                                            if ($arrayImoveis != null) {
                                                foreach ($arrayImoveis as $imovel) {
                                                    $counterProprietario = 1;

                                                    $sql = "SELECT 
                                                                c.Nome 
                                                            FROM 
                                                                proprietario as p,
                                                                cliente as c 
                                                            WHERE 
                                                                p.ImovelID = $imovel->id AND
                                                                p.PessoaID = c.ID";

                                                    try {
                                                        $result = $conn->query($sql);
                                                    } catch (Exception $e) {
                                                        echo 'Falha na busca do proprietarios: ';
                                                        var_dump($e->getMessage());
                                                    }
                                                    
                                                    while ($row = $result->fetch()) {
                                                        $proprietarios[] = $row["Nome"];
                                                    }
                                                    

                                                    $sql = "SELECT
                                                                Imagem
                                                            FROM
                                                                imagem
                                                            WHERE
                                                                ImovelID = $imovel->id
                                                            LIMIT 1;
                                                            ";

                                                    try {
                                                        $result = $conn->query($sql);
                                                    } catch (Exception $e) {
                                                        echo 'Falha na busca das imagens: ';
                                                        var_dump($e->getMessage());
                                                    }

                                                    while ($row = $result->fetch()) {
                                                        $imagem = $row["Imagem"];
                                                    }

                                                    echo "
                                                        <div class='row pt-4'>
                                                            <div class='container'>
                                                                <div class='col-sm-12 admBox'>
                                                                    <div class='row'>
                                                                        <h1>Rua $imovel->rua $imovel->numero, Bairro $imovel->bairro, $imovel->cidade - $imovel->estado</h1>
                                                                    </div>
                                                                    <hr>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='tipo'><strong>Tipo:&nbsp&nbsp</strong></label>
                                                                        <span name='tipo'>$imovel->tipoImovel</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='tipoTransacao'><strong>Tipo de Transação:&nbsp&nbsp</strong></label>
                                                                        <span name='tipoTransacao'>$imovel->tipoTransacao</span>
                                                                    </div>
                                                    ";

                                                    for ($x = 0; $x < count($proprietarios); $x++) {
                                                        echo "
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='proprietario$counterProprietario'><strong>Proprietário$counterProprietario:&nbsp&nbsp</strong></label>
                                                                <span name='proprietario$counterProprietario'>$proprietarios[$x]</span>
                                                            </div>
                                                        ";

                                                        $counterProprietario++;
                                                    }

                                                    echo "
                                                        <div class='row mt-2 ml-1'>
                                                            <label for='qtdQuartos'><strong>Quantidade de Quartos:&nbsp&nbsp</strong></label>
                                                            <span name='qtdQuartos'>$imovel->quantidadeQuartos</span>
                                                        </div>
                                                        <div class='row mt-2 ml-1'>
                                                            <label for='qtdSuites'><strong>Quantidade de Suítes:&nbsp&nbsp</strong></label>
                                                            <span name='qtdSuites'>$imovel->quantidadeSuites</span>
                                                        </div>
                                                        <div class='row mt-2 ml-1'>
                                                            <label for='qtdSalaEstar'><strong>Quantidade de Salas de Estar:&nbsp&nbsp</strong></label>
                                                            <span name='qtdSalaEstar'>$imovel->quantidadeSalaEstar</span>
                                                        </div>
                                                        <div class='row mt-2 ml-1'>
                                                            <label for='qtdSalaJantar'><strong>Quantidade de Salas de Jantar:&nbsp&nbsp</strong></label>
                                                            <span name='qtdSalaJantar'>$imovel->quantidadeSalaJantar</span>
                                                        </div>
                                                        <div class='row mt-2 ml-1'>
                                                            <label for='vagasGaragem'><strong>Número de Vagas na Garagem:&nbsp&nbsp</strong></label>
                                                            <span name='vagasGaragem'>$imovel->quantidadeVagasGaragem</span>
                                                        </div>
                                                        <div class='row mt-2 ml-1'>
                                                            <label for='area'><strong>Área:&nbsp&nbsp</strong></label>
                                                            <span name='area'>$imovel->area</span>
                                                        </div>
                                                        <div class='row mt-2 ml-1'>
                                                            <label for='armarioEmbutido'><strong>Possui Armário Embutido:&nbsp&nbsp</strong></label>
                                                            <span name='armarioEmbutido'>$imovel->armarioEmbutido</span>
                                                        </div>
                                                        <div class='row mt-2 ml-1'>
                                                            <label for='descricao'><strong>Descrição:&nbsp&nbsp</strong></label>
                                                            <span name='descricao'>$imovel->descricao</span>
                                                        </div>
                                                    ";

                                                    if ($imovel->tipoImovel == "Apartamento") {
                                                        echo "
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='andar'><strong>Andar:&nbsp&nbsp</strong></label>
                                                                <span name='andar'>$imovel->andar</span>
                                                            </div>
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='valorCondominio'><strong>Valor do Condomínio:&nbsp&nbsp</strong></label>
                                                                <span name='valorCondominio'>$imovel->valorCondominio</span>
                                                            </div>
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='portaria24horas'><strong>Possui Portaria 24 Horas:&nbsp&nbsp</strong></label>
                                                                <span name='portaria24horas'>$imovel->portaria24Horas</span>
                                                            </div>
                                                        ";
                                                    }

                                                    if ($imovel->tipoTransacao == "Venda") {
                                                        echo "
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='valorVenda'><strong>Valor de Venda:&nbsp&nbsp</strong></label>
                                                                <span name='valorVenda'>$imovel->valorVenda</span>
                                                            </div>
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='valorRealVenda'><strong>Valor Real de Venda:&nbsp&nbsp</strong></label>
                                                                <span name='valorRealVenda'>$imovel->valorReal</span>
                                                            </div>
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='porcentagemImobiliaria'><strong>Porcentagem da Imobiliária:&nbsp&nbsp</strong></label>
                                                                <span name='porcentagemImobiliaria'>$imovel->porcentagemImobiliaria</span>
                                                            </div>
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='dataInicioVenda'><strong>Data de Início da Venda:&nbsp&nbsp</strong></label>
                                                                <span name='dataInicioVenda'>$imovel->dataInicio</span>
                                                            </div>
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='dataFimVenda'><strong>Data de Fim da Venda:&nbsp&nbsp</strong></label>
                                                                <span name='dataFimVenda'>$imovel->dataFim</span>
                                                            </div>
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='vendido'><strong>Vendido:&nbsp&nbsp</strong></label>
                                                                <span name='vendido'>$imovel->vendido_alugado</span>
                                                            </div>
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='funcionarioResponsavel'><strong>Funcionário Responsável:&nbsp&nbsp</strong></label>
                                                                <span name='funcionarioResponsavel'>------ A SER IMPLEMENTADO ------</span>
                                                            </div>
                                                        ";
                                                    } else if ($imovel->tipoTransacao == "Aluguel") {
                                                        echo "
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='valorAluguel'><strong>Valor do    Aluguel:&nbsp&nbsp</strong></label>
                                                                <span name='valorAluguel'>$imovel->valorAluguel</span>
                                                            </div>
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='valorRealAluguel'><strong>Valor Real do Aluguel:&nbsp&nbsp</strong></label>
                                                                <span name='valorRealAluguel'>$imovel->valorReal</span>
                                                            </div>
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='porcentagemImobiliaria'><strong>Porcentagem da Imobiliaria:&nbsp&nbsp</strong></label>
                                                                <span name='porcentagemImobiliaria'>$imovel->porcentagemImobiliaria</span>
                                                            </div>
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='dataInicioAluguel'><strong>Data de Início do Aluguel:&nbsp&nbsp</strong></label>
                                                                <span name='dataInicioAluguel'>$imovel->dataInicio</span>
                                                            </div>
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='dataFimAluguel'><strong>Data de Fim do Aluguel:&nbsp&nbsp</strong></label>
                                                                <span name='dataFimAluguel'>$imovel->dataFim</span>
                                                            </div>
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='alugado'><strong>Alugado:&nbsp&nbsp</strong></label>
                                                                <span name='alugado'>$imovel->vendido_alugado</span>
                                                            </div>
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='funcionarioResponsavel'><strong>Funcionário Responsável:&nbsp&nbsp</strong></label>
                                                                <span name='funcionarioResponsavel'>------ A SER IMPLEMENTADO ------</span>
                                                            </div>
                                                        ";
                                                    }

                                                    echo "      <hr>
                                                                <div class='row bg-orange mt-5 mb-3 mx-4'>
                                                                   <img src='$imagem' class='w-75 mx-auto'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    ";

                                                    $proprietarios = null;
                                                    $imagens = null;
                                                }
                                            }

                                            $conn = null;

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 p-0">
                        <footer class="text-center p-0" id=footer>
                            <small>Imobiliária Bonfins<span>&reg</span></small>
                        </footer>
                    </div>
                </div>
            </div>
        </section>
    </body>

    <script src="../jquery/jquery-3.4.1.js"></script>
    <script src="../popper/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
</html>