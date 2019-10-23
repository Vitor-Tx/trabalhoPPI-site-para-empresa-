<?php
    session_start();

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
        <title>Listagem de Interesses</title>

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
                            <button class="navbar-toggler mt-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                                        <a href="listagemImovel.php">Listar Imóveis</a>
                                    </li>
                                    <li class="mt-2 mr-3">
                                        <a href="../php/logout.php">Sair</a>
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
                                    <h1 class="display-4">Listagem de Interesses</h1>
                                    <hr class="my-3">
                                    <div id="admContainer">
                                        <?php 
                                        
                                            require "../php/conexaoMysql.php";
                                            require "../php/interesse.php";

                                            $arrayInteresses = null;

                                            try {
                                                $arrayInteresses = getInteresses($conn);  
                                            } catch (Exception $e) {
                                                $msgErro = $e->getMessage();
                                                echo $msgErro;
                                            }
                                        
                                            if ($arrayInteresses != null) {
                                                foreach ($arrayInteresses as $interesse) {
                                                    echo "
                                                        <div class='row pt-4'>
                                                            <div class='container'>
                                                                <div class='col-sm-12 admBox'>
                                                                    <div class='row'>
                                                                        <h1>$interesse->nome</h1>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='imovel'><strong>Imóvel:&nbsp&nbsp</strong></label>
                                                                        <span name='imovel'>$interesse->endereco</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='telefoneCliente'><strong>Telefone do Cliente:&nbsp&nbsp</strong></label>
                                                                        <span name='telefoneCliente'>$interesse->telefone</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='emailCliente'><strong>Email do CLiente:&nbsp&nbsp</strong></label>
                                                                        <span name='emailCliente'>$interesse->email</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='proposta'><strong>Proposta:&nbsp&nbsp</strong></label>
                                                                        <span name='proposta'>$interesse->proposta</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ";
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