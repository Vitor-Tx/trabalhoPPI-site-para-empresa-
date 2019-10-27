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
        <title>Cadastro de Imóveis</title>

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
                                    <h1 class="display-4">Cadastro de Imóveis</h1>
                                    <hr class="my-3">
                                    <form>
                                        <div class="form-group">
                                            <label for="tipoImovel">Tipo do Imóvel</label>
                                            <select 
                                            class="form-control" 
                                            name="tipoImovel" 
                                            id="inputTipoImovel">
                                                <option value="0" selected>Selecione um</option>
                                                <option value="1">Casa</option>
                                                <option value="2">Apartamento</option>
                                            </select>
                                        </div>
                                        <div id="campos"></div>
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
    <script src="../jquery/jQuery-Mask-Plugin-master/dist/jquery.mask.js"></script>
    <script src="js/cadastroImovel.js"></script>
    <script src="js/navbar.js"></script>
</html>