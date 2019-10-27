<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Imobiliária Bonfins</title>

        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/index.css">
        <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light sticky-top pt-0">
            <a class="navbar-brand pt-0" href="#">
                <img class="logo-bonfins" src="assets/images/logo-bonfins3.png">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a 
                        class="nav-link" 
                        href="pesquisa/pesquisa.php">Pesquisar Imóvel</a>
                    </li>
                    <li class="nav-item">
                        <a 
                        class="nav-link" 
                        href="#aboutSection">Valores</a>
                    </li>
                    <li class="nav-item">
                        <?php

                            require "php/conexaoMysql.php";

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
                                    href='administrativo/'>$nome</a>
                                ";
                            } else {
                                echo "
                                    <a 
                                    data-toggle='modal' 
                                    data-target='#modalLogin' 
                                    class='nav-link' 
                                    href='#'>Login</a>
                                ";
                            }

                        ?>
                    </li>
                </ul>
            </div>
        </nav>
        <section id="carousel">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100 carousel-img " src="assets/images/casa1.png">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 carousel-img " src="assets/images/casa2.png">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 carousel-img " src="assets/images/casa3.png">
                    </div>
                </div>
                <a class="carousel-control-prev carousel-control ml-0" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next carousel-control mr-0" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>
        <section id="showcase">
            <div class="row m-0 bonfins-brown">
                <div class="col-sm-12 text-center text-white py-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1>Imobiliária Bonfins</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>O seu lar, na sua mão.</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-0">
                <div class="parallax w-100" id="prlx1"></div>
            </div>

            <div class="row m-0 px-5 py-5 bonfins-brown">
                <div class="col-12  w-75 text-center">
                    <h2>Imóveis à venda</h2>
                    <div class="row my-5">
                        <div class="col-sm-4 mt-2">
                            <img src="assets/images/imagens paisagem/casa1.jpg" class="img-fluid img-thumbnail gallery-img">
                        </div>
                        <div class="col-sm-4 mt-2">
                            <img src="assets/images/imagens paisagem/casa2.jpg" class="img-fluid img-thumbnail gallery-img">
                        </div>
                        <div class="col-sm-4 mt-2">
                            <img src="assets/images/imagens paisagem/casa3.jpg" class="img-fluid img-thumbnail gallery-img">
                        </div>
                    </div>
                    <hr>
                    <h2 class="mt-5">Imóveis para locação</h2>
                    <div class="row mt-5">
                        <div class="col-sm-4 mt-2">
                            <img src="assets/images/imagens paisagem/casa4.jpg" class="img-fluid img-thumbnail gallery-img">
                        </div>
                        <div class="col-sm-4 mt-2">
                            <img src="assets/images/imagens paisagem/casa5.jpg" class="img-fluid img-thumbnail gallery-img">
                        </div>
                        <div class="col-sm-4 mt-2">
                            <img src="assets/images/imagens paisagem/casa6.jpg" class="img-fluid img-thumbnail gallery-img">
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <div class="row m-0">
            <div class="parallax w-100" id="prlx2"></div>
        </div>
        <div id="aboutSection"></div>
        <section id="about">
            <div class="row m-0 px-5 py-4 bonfins-brown">
                <div class="col-12  w-75 text-center">
                    <h2 class="mt-5">Missão</h2>
                    <br>
                    <h3 class="mb-5 text-justify">A missão da Imobiliária Bonfins é oferecer um novo padrão de mercado nas regiões onde atuamos. Oferecer um serviço digno do respeito e admiração de nossos clientes, assim como preços competitivos e plausíveis, pois nosso objetivo é crescer
                        ao passo de que nossos clientes também crescem ao adquirirem seus imóveis tão sonhados.</h3>
                    <hr>
                    <h2 class="mt-5">Visão</h2>
                    <br>
                    <h3 class="mb-5 text-center">Nos tornaremos, em menos de 10 anos, a maior imobiliária do sudeste brasileiro.</h3>
                    <hr>
                    <h2 class="mt-5">Valores</h2>
                    <br>
                    <h3 class="mb-5 text-justify">Oferecer sempre o máximo de informação possível para que nossos clientes não se arrependam de ter feito uma compra ou assinado um contrato de aluguel. Garantir que todo tipo de cliente tenha opções disponíveis dentro dos padrões de mercado
                        das regiões onde vivem. Acima de tudo, diminuir ao máximo a burocracia, assim oferecendo um serviço ágil e transações confortáveis para todos.
                    </h3>
                </div>
            </div>
        </section>
        <?php include "php/footer.php" ?>

        <?php include "php/modalLogin.php"; ?>

        <script src="jquery/jquery-3.4.1.js "></script>
        <script src="popper/popper.min.js "></script>
        <script src="js/bootstrap.js "></script>
        <script src="js/login.js"></script>
    </body>
</html>