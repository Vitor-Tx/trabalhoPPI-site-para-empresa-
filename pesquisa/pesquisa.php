<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Pesquisa</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/pesquisa.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light sticky-top pt-0">
            <a class="navbar-brand pt-0" href="../index.php">
                <img class="logo-bonfins" src="../assets/images/logo-bonfins3.png">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <?php 

                            require "../php/conexaoMysql.php";

                            if (isset($_COOKIE["login"])) {

                                $login = $_COOKIE["login"];
                                $nome = "";

                                $sql = "SELECT Nome FROM funcionario WHERE Login = '$login'";

                                try {
                                    $result = $conn->query($sql);
                                } catch (Exception $e) {
                                    echo 'User404: ';
                                    var_dump($e->getMessage());
                                }

                                $row = $result->fetch();
                                $nome = substr($row["Nome"], 0, strpos($row["Nome"], ' '));

                                echo "
                                    <a  
                                    class='nav-link' 
                                    href='../administrativo/'>$nome</a>
                                ";
                            } else {
                                echo "
                                    <a 
                                    data-toggle='modal' 
                                    data-target='#modalLogin' 
                                    class='nav-link' 
                                    href='#'
                                    id='login'>Login</a>
                                ";
                            }

                        ?>
                    </li>
                </ul>
            </div>
        </nav>
        <section id="corpo" class="mt-3">
            <div class="container">
                <div class="col-sm-12">
                    <div class="row mb-5">
                        <form class="px-4 py-1 border-warning w-100" id="pesquisa">
                            <div>
                                <label 
                                class="col-form-label" 
                                for="proposito"><h6>Propósito:</h6></label>
                                <div id="radio" class="ml-1">
                                    <div class="form-check form-check-inline">
                                        <input 
                                        class="form-check-input radio-proposito" 
                                        type="radio" 
                                        name="proposito" 
                                        value="1">
                                        <label 
                                        class="form-check-label" 
                                        for="proposito">Aquisição</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input 
                                        class="form-check-input radio-proposito" 
                                        type="radio" 
                                        name="proposito" 
                                        value="2">
                                        <label 
                                        class="form-check-label" 
                                        for="proposito">Locação</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label 
                                for="bairro"><h6>Bairro:</h6></label>
                                <select 
                                class="form-control" 
                                id="bairro">
                                    <option value="" selected>Selecione um...</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label 
                                for="valorMin"><h6>Valor mínimo:</h6></label>
                                <input 
                                type="text" 
                                class="form-control valor" 
                                id="valorMin" name="valorMin">
                            </div>
                            <div class="form-group">
                                <label 
                                for="valorMax"><h6>Valor máximo:</h6></label>
                                <input 
                                type="text" 
                                class="form-control valor" 
                                id="valorMax" 
                                name="valorMax">
                            </div>
                            <div class="form-group">
                                <label 
                                for="informacoes"><h6>Outras Informações:</h6></label>
                                <textarea 
                                class="form-control" 
                                id="informacoes" 
                                rows="3" 
                                placeholder="Palavras chave"></textarea>
                            </div>
                            <div class="text-center mb-3">
                                <button 
                                type="button" 
                                class="btn cor-btn" 
                                id="btn-buscar">Buscar</button>
                            </div>
                        </form>
                    </div>
                    <div class="row" id="listaImoveis"></div>
                </div>
            </div>
        </section>
        <?php include "../php/footer.php" ?>

        <!-- Modal Mais Informacoes -->
        <div class="modal fade" id="maisInformacoes" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Imóveis Bonfins</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="carouselMaisInformacoes" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators" id="carouselArrows"></ol>
                            <div class="carousel-inner" id="carouselImages"></div>
                            <a class="carousel-control-prev" href="#carouselMaisInformacoes" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Anterior</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselMaisInformacoes" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Próximo</span>
                            </a>
                        </div>
                        <div id="infoImovel" class="w-100 mt-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tenho Interesse-->
        <div class="modal fade" id="modalInteresse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Imóveis Bonfins</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="nome">Nome Completo:</label>
                                <input type="text" class="form-control" id="nome" name="nome">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone:</label>
                                <input type="text" class="form-control phoneField" id="telefone" name="telefone">
                            </div>
                            <div class="form-group">
                                <label for="descricaoProposta">Descrição da Proposta:</label>
                                <textarea class="form-control" id="descricaoProposta" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label id="erro" class="text-danger"></label>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn cor-btn" id="btnEnviarInteresse">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include "../php/modalLogin.php" ?>

        <script src="../jquery/jquery-3.4.1.js"></script>
        <script src="../popper/popper.min.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../jquery/jQuery-Mask-Plugin-master/dist/jquery.mask.js"></script>
        <script src="js/pesquisa.js"></script>
        <script src="../js/login.js"></script>
    </body>
</html>
