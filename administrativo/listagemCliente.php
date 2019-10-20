<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Listagem de Clientes</title>

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
                            <a class="navbar-brand pt-0" href="../homePublica.html">
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
                                        <a href="homeRestrita.html">Home</a>
                                    </li>
                                    <li class="mt-2 mr-3">
                                        <a href="cadastroFuncionario.php">Cadastrar Funcionário</a>
                                    </li>
                                    <li class="mt-2 mr-3">
                                        <a href="cadastroCliente.html">Cadastrar Cliente</a>
                                    </li>
                                    <li class="mt-2 mr-3">
                                        <a href="cadastroImovel.html">Cadastrar Imóvel</a>
                                    </li>
                                    <li class="mt-2 mr-3">
                                        <a href="listagemFuncionario.php">Listar Funcionários</a>
                                    </li>
                                    <li class="mt-2 mr-3">
                                        <a href="listagemImovel.php">Listar Imóveis</a>
                                    </li>
                                    <li class="mt-2 mr-3">
                                        <a href="listagemInteresse.html">Listar Interesses</a>
                                    </li>
                                    <li class="mt-2 mr-3">
                                        <a href="../homePublica.html">Sair</a>
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
                                    <h1 class="display-4">Listagem de Clientes</h1>
                                    <hr class="my-3">
                                    <div id="admContainer">
                                        <?php 
                                        
                                            require "../php/conexaoMysql.php";
                                            require "../php/cliente.php";

                                            $arrayClientes = null;
                                            $msgErro = "";
                                            $telefones = null;

                                            try {
                                                $arrayClientes = getClientes($conn);  
                                            } catch (Exception $e) {
                                                $msgErro = $e->getMessage();
                                                echo $msgErro;
                                            }

                                            if ($arrayClientes != null) {
                                                foreach ($arrayClientes as $cliente) {
                                                    $counterTelefone = 1;
                                                    $sql = "SELECT 
                                                                Numero 
                                                            FROM 
                                                                telefone 
                                                            WHERE 
                                                                PessoaID = $cliente->id AND 
                                                                TipoPessoa = 1";

                                                    $result = $conn->query($sql);
                                                    if ($result == false)
                                                        throw new Exception("Falha na busca dos telefones: " . $conn->error);

                                                    while ($row = $result->fetch()) {
                                                        $telefones[] = $row["Numero"];
                                                    }

                                                    echo "
                                                        <div class='row pt-4'>
                                                            <div class='container'>
                                                                <div class='col-sm-12 admBox'>
                                                                    <div class='row'>
                                                                        <h1>$cliente->nome</h1>
                                                                    </div>
                                                                    <hr>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='cpf'>
                                                                            <strong>CPF:&nbsp&nbsp</strong>
                                                                        </label>
                                                                        <span name='cpf'>$cliente->cpf</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='endereco'>
                                                                            <strong>Endereço:&nbsp&nbsp</strong>
                                                                        </label>
                                                                        <span name='endereco'>$cliente->endereco</span>
                                                                    </div>";

                                                    for ($x = 0; $x < count($telefones); $x++) {
                                                        echo "
                                                            <div class='row mt-2 ml-1'>
                                                                <label for='telefone$counterTelefone'>
                                                                    <strong>Telefone$counterTelefone:&nbsp&nbsp</strong>
                                                                </label>
                                                                <span name='telefone$counterTelefone'>$telefones[$x]</span>
                                                            </div>";

                                                        $counterTelefone++;
                                                    }

                                                    echo "
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='email'>
                                                                            <strong>Email:&nbsp&nbsp</strong>
                                                                        </label>
                                                                        <span name='email'>$cliente->email</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='sexo'>
                                                                            <strong>Sexo:&nbsp&nbsp</strong>
                                                                        </label>
                                                                        <span name='sexo'>$cliente->sexo</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='estadoCivil'>
                                                                            <strong>Estado Civil:&nbsp&nbsp</strong>
                                                                        </label>
                                                                        <span name='estadoCivil'>$cliente->estadoCivil</span>
                                                                    </div>
                                                                    <div class='row mt-2 ml-1'>
                                                                        <label for='profissao'>
                                                                            <strong>Profissão:&nbsp&nbsp</strong>
                                                                        </label>
                                                                        <span name='profissao'>$cliente->profissao</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>";

                                                    $telefones = null;
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