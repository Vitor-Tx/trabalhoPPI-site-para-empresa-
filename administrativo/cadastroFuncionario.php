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
        <title>Cadastro de Funcionário</title>

        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="css/administrativo.css">
        <link rel="stylesheet" href="css/cadastro.css">
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
                        <div id="admContainer">
                            <div class="container">
                                <div class="jumbotron">
                                    <h1 class="display-4">Cadastro de Funcionários</h1>
                                    <hr class="my-3">
                                    <form>
                                        <div class="form-group">
                                            <label for="nome">Nome</label>
                                            <input type="text" name="nome" id="inputNome" placeholder="Digite o Nome" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="telefone">Telefone</label>
                                            <input type="text" name="telefone" id="inputTelefone" placeholder="Digite o Telefone" class="form-control phoneField">
                                        </div>
                                        <div class="form-group">
                                            <label for="cpf">CPF</label>
                                            <input type="text" name="cpf" id="inputCPF" placeholder="Digite o CPF" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="endereco">Endereço</label>
                                            <input type="text" name="endereco" id="inputEndereco" placeholder="Digite o Endereço" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="telefoneContato">Telefone de Contato</label>
                                            <input type="text" name="telefoneContato" id="inputTelefoneContato" placeholder="Digite o Telefone de Contato" class="form-control  phoneField">
                                        </div>
                                        <div class="form-group">
                                            <label for="telefoneCelular">Telefone Celular</label>
                                            <input type="text" name="telefoneCelular" id="inputTelefoneCelular" placeholder="Digite o Telefone Celular" class="form-control  phoneField">
                                        </div>
                                        <div class="form-group">
                                            <label for="cargo">Cargo</label>
                                            <select name="cargo" id="inputCargo" class="form-control">
                                                <option value="0" selected>Selecione um</option>
                                                <?php 
                                                
                                                    require "../php/conexaoMysql.php";

                                                    $sql = "SELECT ID, Nome FROM cargo ORDER BY ID";

                                                    $result = $conn->query($sql);
                                                    if (! $result)
                                                        throw new Exception("Falha na busca dos cargos: " . $conn->error);

                                                    while ($row = $result->fetch()) {
                                                        $id = $row["ID"];
                                                        $nome = $row["Nome"];
                                                        echo "<option value='$id'>$nome</option>";
                                                    }

                                                    $conn == null;

                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="login">Login</label>
                                            <input type="text" name="login" id="inputLogin" placeholder="Digite o Login" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="senha">Senha</label>
                                            <input type="password" name="senha" id="inputSenha" placeholder="Digite a Senha" class="form-control">
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
    <script src="js/cadastroFuncionario.js"></script>
    <script src="js/navbar.js"></script>
    <script src="../jquery/jQuery-Mask-Plugin-master/dist/jquery.mask.js"></script>
</html>