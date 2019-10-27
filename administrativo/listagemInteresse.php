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
                        <?php include "../php/navbarRestrita.php" ?>
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
    <script src="js/navbar.js"></script>
</html>