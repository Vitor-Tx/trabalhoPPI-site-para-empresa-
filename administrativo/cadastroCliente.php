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
        <title>Cadastro de Clientes</title>

        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="css/administrativo.css">
        <link rel="stylesheet" href="css/cadastro.css">
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
                                        <a href="listagemInteresse.php">Listar Interesses</a>
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
                        <div id="admContainer">
                            <div class="container">
                                <div class="jumbotron">
                                    <h1 class="display-4">Cadastro de Clientes</h1>
                                    <hr class="my-3">
                                    <form>
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" name="nome" id="inputNome" placeholder="Digite o Nome" class="form-control inputField">
                                        </div>
                                        <div class="form-group">
                                            <label for="cpf">CPF</label>
                                            <input type="text" name="cpf" id="inputCPF" placeholder="Digite o CPF" class="form-control inputField">
                                        </div>
                                        <div class="form-group">
                                            <label for="endereco">Endereço</label>
                                            <input type="text" name="endereco" id="inputEndereco" placeholder="Digite o Endereço" class="form-control inputField">
                                        </div>
                                        <div class="form-group">
                                            <label for="telefone">Telefone</label>
                                            <div id="numeros">
                                                <input type="text" name="telefone" placeholder="Digite o Telefone" class="form-control inputField phoneField" id="inputTelefone">
                                            </div>
                                            <button type="button" class="btn btn-success mt-2" id="adicionarTelefone">Adicionar Telefone</button>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="inputEmail" placeholder="Digite o Email" class="form-control inputField">
                                        </div>
                                        <div class="form-group" id="sexoInput">
                                            <label>Sexo</label>
                                            <div class="form-check pl-4">
                                                <input class="form-check-input" type="radio" name="sexo" value="m">
                                                <label class="form-check-label" for="sexo">Masculino</label>
                                            </div>
                                            <div class="form-check pl-4">
                                                <input class="form-check-input" type="radio" name="sexo" value="f">
                                                <label class="form-check-label" for="sexo">Feminino</label>
                                            </div>
                                            <div class="form-check pl-4 ">
                                                <input class="form-check-input" type="radio" name="sexo" value="o">
                                                <label class="form-check-label" for="sexo">Outro</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="estadoCivil">Estado Civil</label>
                                            <select class="form-control" name="estadoCivil" id="inputEstadoCivil">
                                                <option value="0" selected>Selecione um</option>
                                                <option value="1">Casado(a)</option>
                                                <option value="2">Solteiro(a)</option>
                                                <option value="3">Divorciado(a)</option>
                                                <option value="4">Viúvo(a)</option>
                                                <option value="5">União estável</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="profissao">Profissão</label>
                                            <input type="text" name="profissao" id="inputProfissao" placeholder="Digite a Profissão" class="form-control inputField">
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-orange" id="btnCadastrar">Cadastrar</button>
                                        </div>
                                    </form>
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
    <script src="js/cadastroCliente.js"></script>
    <script src="../jquery/jQuery-Mask-Plugin-master/dist/jquery.mask.js"></script>
</html>