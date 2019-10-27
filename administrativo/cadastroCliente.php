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
                        <?php include "../php/navbarRestrita.php" ?>
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
                                            <input 
                                            type="text" 
                                            name="nome" 
                                            id="inputNome" 
                                            placeholder="Digite o Nome" 
                                            class="form-control inputField">
                                        </div>
                                        <div class="form-group">
                                            <label for="cpf">CPF</label>
                                            <input 
                                            type="text" 
                                            name="cpf" 
                                            id="inputCPF" 
                                            placeholder="Digite o CPF" 
                                            class="form-control inputField">
                                        </div>
                                        <div class="form-group">
                                            <label for="cep">CEP</label>
                                            <input 
                                            type="text" 
                                            name="cep" 
                                            id="inputCEP" 
                                            placeholder="Digite o CEP" 
                                            class="form-control inputField">
                                        </div>
                                        <div class="form-group">
                                            <label for="logradouro">Logradouro</label>
                                            <input 
                                            type="text" 
                                            name="logradouro" 
                                            id="inputLogradouro" 
                                            placeholder="Digite o Logradouro (Nome da Rua/Avenida)" 
                                            class="form-control inputField"
                                            disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="numero">Número</label>
                                            <input 
                                            type="number" 
                                            name="numero" 
                                            id="inputNumero" 
                                            placeholder="Digite o Número" 
                                            class="form-control inputField"
                                            disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="bairro">Bairro</label>
                                            <input 
                                            type="text" 
                                            name="bairro" 
                                            id="inputBairro" 
                                            placeholder="Digite o Bairro" 
                                            class="form-control inputField"
                                            disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="cidade">Cidade</label>
                                            <input 
                                            type="text" 
                                            name="cidade" 
                                            id="inputCidade" 
                                            placeholder="Digite a Cidade" 
                                            class="form-control inputField"
                                            disabled>
                                        </div>
                                        <div class='form-group'>
                                            <label for='estado'>Estado</label>
                                            <select 
                                            name='estado' 
                                            id='inputEstado' 
                                            class='form-control'
                                            disabled>
                                                <option value='' selected>Selecione um ...</option>
                                                <option value='AC'>Acre</option>
                                                <option value='AL'>Alagoas</option>
                                                <option value='AP'>Amapá</option>
                                                <option value='AM'>Amazonas</option>
                                                <option value='BA'>Bahia</option>
                                                <option value='CE'>Ceará</option>
                                                <option value='DF'>Distrito Federal</option>
                                                <option value='ES'>Espírito Santo</option>
                                                <option value='GO'>Goiás</option>
                                                <option value='MA'>Maranhão</option>
                                                <option value='MT'>Mato Grosso</option>
                                                <option value='MS'>Mato Grosso do Sul</option>
                                                <option value='MG'>Minas Gerais</option>
                                                <option value='PA'>Pará</option>
                                                <option value='PB'>Paraíba</option>
                                                <option value='PR'>Paraná</option>
                                                <option value='PE'>Pernambuco</option>
                                                <option value='PI'>Piauí</option>
                                                <option value='RJ'>Rio de Janeiro</option>
                                                <option value='RN'>Rio Grande do Norte</option>
                                                <option value='RS'>Rio Grande do Sul</option>
                                                <option value='RO'>Rondônia</option>
                                                <option value='RR'>Roraima</option>
                                                <option value='SC'>Santa Catarina</option>
                                                <option value='SP'>São Paulo</option>
                                                <option value='SE'>Sergipe</option>
                                                <option value='TO'>Tocantins</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="telefone">Telefone</label>
                                            <div id="numeros">
                                                <input 
                                                type="text" 
                                                name="telefone" 
                                                placeholder="Digite o Telefone" 
                                                class="form-control inputField phoneField" 
                                                id="inputTelefone">
                                            </div>
                                            <button 
                                            type="button" 
                                            class="btn btn-success mt-2" 
                                            id="adicionarTelefone">Adicionar Telefone</button>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input 
                                            type="text" 
                                            name="email" 
                                            id="inputEmail" 
                                            placeholder="Digite o Email" 
                                            class="form-control inputField">
                                        </div>
                                        <div class="form-group" id="sexoInput">
                                            <label>Sexo</label>
                                            <div class="form-check pl-4">
                                                <input 
                                                class="form-check-input" 
                                                type="radio" 
                                                name="sexo" 
                                                value="m">
                                                <label 
                                                class="form-check-label" 
                                                for="sexo">Masculino</label>
                                            </div>
                                            <div class="form-check pl-4">
                                                <input 
                                                class="form-check-input" 
                                                type="radio" 
                                                name="sexo" 
                                                value="f">
                                                <label 
                                                class="form-check-label" 
                                                for="sexo">Feminino</label>
                                            </div>
                                            <div class="form-check pl-4 ">
                                                <input 
                                                class="form-check-input" 
                                                type="radio" 
                                                name="sexo" 
                                                value="o">
                                                <label 
                                                class="form-check-label" 
                                                for="sexo">Outro</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="estadoCivil">Estado Civil</label>
                                            <select 
                                            class="form-control" 
                                            name="estadoCivil" 
                                            id="inputEstadoCivil">
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
                                            <input 
                                            type="text" 
                                            name="profissao" 
                                            id="inputProfissao" 
                                            placeholder="Digite a Profissão" 
                                            class="form-control inputField">
                                        </div>
                                        <div class="text-center">
                                            <button 
                                            type="button" 
                                            class="btn btn-orange" 
                                            id="btnCadastrar">Cadastrar</button>
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
    <script src="../jquery/jQuery-Mask-Plugin-master/dist/jquery.mask.js"></script>
    <script src="js/cadastroCliente.js"></script>
    <script src="js/navbar.js"></script>
</html>