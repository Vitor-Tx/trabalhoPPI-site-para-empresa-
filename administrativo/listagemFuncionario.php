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
        <title>Listagem de Funcionários</title>

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
                                    <h1 class="display-4">Listagem de Funcionários</h1>
                                    <hr class="my-3">
                                    <div id="admContainer">
                                        <?php 

                                            require "../php/conexaoMysql.php";
                                            require "../php/funcionario.php";

                                            $arrayFuncionarios = null;
                                            $msgErro = "";

                                            try {
                                                $arrayFuncionarios = getFuncionarios($conn);  
                                            } catch (Exception $e) {
                                                $msgErro = $e->getMessage();
                                                echo $msgErro;
                                            }

                                            if ($arrayFuncionarios != null) {
                                                foreach ($arrayFuncionarios as $funcionario) {
                                                    echo "
                                                        <div class='row pt-4'>
                                                            <div class='container'>
                                                                <div class='col-sm-12 admBox'>
                                                                    <div class='row'>
                                                                        <h1>$funcionario->nome<span class='badge badge-info'>$funcionario->cargo</span></h1>
                                                                    </div>
                                                                    <hr>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='cpf'><strong>CPF:&nbsp&nbsp</strong></label>
                                                                        <span name='cpf'>$funcionario->cpf</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='endereco'><strong>Endereço:&nbsp&nbsp</strong></label>
                                                                        <span name='endereco'>$funcionario->endereco</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='telefone'><strong>Telefone:&nbsp&nbsp</strong></label>
                                                                        <span name='telefone'>$funcionario->telefone</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='telefoneContato'><strong>Telefone de Contato:&nbsp&nbsp</strong></label>
                                                                        <span name='telefoneContato'>$funcionario->telefoneContato</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='telefoneCelular'><strong>Telefone Celular:&nbsp&nbsp</strong></label>
                                                                        <span name='telefoneCelular'>$funcionario->telefoneCelular</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='dataIngresso'><strong>Data de Ingresso:&nbsp&nbsp</strong></label>
                                                                        <span name='telefone'>$funcionario->dataIngresso</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='salarioBase'><strong>Salário Base:&nbsp&nbsp</strong></label>
                                                                        <span name='salarioBase'>$funcionario->salarioBase</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='comissao'><strong>Comissão:&nbsp&nbsp</strong></label>
                                                                        <span name='comissao'>$funcionario->comissao</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='salario'><strong>Salário:&nbsp&nbsp</strong></label>
                                                                        <span name='salario'>$funcionario->salario</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='login'><strong>Login:&nbsp&nbsp</strong></label>
                                                                        <span name='login' class='text-break'>$funcionario->login</span>
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