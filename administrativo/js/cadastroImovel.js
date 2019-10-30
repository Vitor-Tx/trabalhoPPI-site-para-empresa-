// var imagens = [];
// var controlPressed = false;

// window.onkeyup = function (e) {
//     if (e.which == 17) {
//         controlPressed = false;
//     }
// }

// window.onkeydown = function (e) {
//     if (e.which == 17) {
//         controlPressed = true;
//     }
// }

const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
});

$("#inputTipoImovel").change(function() {
    var clientes;
    var saida;
    imagens = [];

    $.ajax({
        method: "POST",
        async: false,
        url: "../php/getNomesClientes.php",
        success: function(result)
        {
            clientes = JSON.parse(result);
        }
    });

    $("#campos").empty();

    if ($(this).val() !== '0') {
        saida = "<div class='form-group'>" +
                    "<label for='rua'>Rua</label>" +
                    "<input type='text' name='rua' id='inputRua' placeholder='Digite o Nome da Rua' class='form-control'>" +
                "</div>" +
                "<div class='form-group'>" +
                    "<label for='numero'>Número</label>" +
                    "<input type='number' name='numero' id='inputNumero' placeholder='Digite o Número do Imóvel' class='form-control'>" +
                "</div>" +
                "<div class='form-group'>" +
                    "<label for='bairro'>Bairro</label>" +
                    "<input type='text' name='bairro' id='inputBairro' placeholder='Digite o Nome do Bairro' class='form-control'>" +
                "</div>" +
                "<div class='form-group'>" +
                    "<label for='cidade'>Cidade</label>" +
                    "<input type='text' name='cidade' id='inputCidade' placeholder='Digite o Nome da Cidade' class='form-control'>" +
                "</div>" +
                "<div class='form-group'>" +
                    "<label for='estado'>Estado</label>" +
                    "<select name='estado' id='inputEstado' class='form-control'>" +
                        "<option value='' selected>Selecione um ...</option>" +
                        "<option value='AC'>Acre</option>" +
                        "<option value='AL'>Alagoas</option>" +
                        "<option value='AP'>Amapá</option>" +
                        "<option value='AM'>Amazonas</option>" +
                        "<option value='BA'>Bahia</option>" +
                        "<option value='CE'>Ceará</option>" +
                        "<option value='DF'>Distrito Federal</option>" +
                        "<option value='ES'>Espírito Santo</option>" +
                        "<option value='GO'>Goiás</option>" +
                        "<option value='MA'>Maranhão</option>" +
                        "<option value='MT'>Mato Grosso</option>" +
                        "<option value='MS'>Mato Grosso do Sul</option>" +
                        "<option value='MG'>Minas Gerais</option>" +
                        "<option value='PA'>Pará</option>" +
                        "<option value='PB'>Paraíba</option>" +
                        "<option value='PR'>Paraná</option>" +
                        "<option value='PE'>Pernambuco</option>" +
                        "<option value='PI'>Piauí</option>" +
                        "<option value='RJ'>Rio de Janeiro</option>" +
                        "<option value='RN'>Rio Grande do Norte</option>" +
                        "<option value='RS'>Rio Grande do Sul</option>" +
                        "<option value='RO'>Rondônia</option>" +
                        "<option value='RR'>Roraima</option>" +
                        "<option value='SC'>Santa Catarina</option>" +
                        "<option value='SP'>São Paulo</option>" +
                        "<option value='SE'>Sergipe</option>" +
                        "<option value='TO'>Tocantins</option>" +
                    "</select>" +
                "</div>" +
                "<div class='form-group'>" +
                    "<label for='proprietario'>Proprietário</label>" +
                    "<div id='proprietarios'>" +
                        getProprietarios(false, clientes) +
                    "</div>" +
                    "<button type='button' class='btn btn-success mt-2' id='adicionarProprietario'>Adicionar Proprietario</button>" +
                "</div>" +
                "<div class='form-group'>" +
                    "<label for='tipoTransacao'>Tipo de Transação</label>" +
                    "<select class='form-control' name='tipoTransacao' id='inputTipoTransacao'>" +
                        "<option value='0' selected>Selecione um</option>" +
                        "<option value='1'>Venda</option>" +
                        "<option value='2'>Aluguel</option>" +
                    "</select>" +
                "</div>" +
                "<div class='form-group'>" +
                    "<label for='qtdQuartos'>Quantidade de Quartos</label>" +
                    "<input type='number' name='qtdQuartos' id='inputQtdQuartos' placeholder='Digite o Número de Quartos' class='form-control'>" +
                "</div>" +
                "<div class='form-group'>" +
                    "<label for='qtdSuites'>Quantidade de Suítes</label>" +
                    "<input type='number' name='qtdSuites' id='inputQtdSuites' placeholder='Digite o Número de Suítes' class='form-control'>" +
                "</div>" +
                "<div class='form-group'>" +
                    "<label for='qtdSalaEstar'>Quantidade de Salas de Estar</label>" +
                    "<input type='number' name='qtdSalaEstar' id='inputQtdSalaEstar' placeholder='Digite o Número de Salas de Estar' class='form-control'>" +
                "</div>" +
                "<div class='form-group'>" +
                    "<label for='qtdSalaJantar'>Quantidade de Salas de Jantar</label>" +
                    "<input type='number' name='qtdSalaJantar' id='inputQtdSalaJantar' placeholder='Digite o Número de Salas de Jantar' class='form-control'>" +
                "</div>" +
                "<div class='form-group'>" +
                    "<label for='qtdVagasGaragem'>Quantidade de Vagas na Garagem</label>" +
                    "<input type='number' name='qtdVagasGaragem' id='inputQtdVagasGaragem' placeholder='Digite o Número de Vagas na Garagem' class='form-control'>" +
                "</div>" +
                "<div class='form-group'>" +
                    "<label for='area'>Área</label>" +
                    "<input type='text' name='area' id='inputArea' placeholder='Digite a Área (m²)' class='form-control'>" +
                "</div>" +
                "<div class='form-group'>" +
                    "<label for='armarioEmbutido'>Possui Armário Embutido</label>" +
                    "<select class='form-control' name='armarioEmbutido' id='inputArmarioEmbutido'>" +
                        "<option value='0' selected>Selecione um</option>" +
                        "<option value='1'>Sim</option>" +
                        "<option value='2'>Não</option>" +
                    "</select>" +
                "</div>" + 
                "<div class='form-group'>" +
                    "<label for='descricao'>Descrição</label>" +
                    "<textarea name='descricao' class='form-control' id='inputDescricao' rows='5'></textarea>" +
                "</div>";
                
        if ($(this).val() === '2') {
            saida +=    "<div class='form-group'>" +
                            "<label for='andar'>Andar</label>" +
                            "<input type='number' name='andar' id='inputAndar' placeholder='Digite o Andar' class='form-control'>" +
                        "</div>" +
                        "<div class='form-group'>" +
                            "<label for='valorCondominio'>Valor do Condomínio</label>" +
                            "<input type='text' name='valorCondominio' id='inputValorCondominio' placeholder='Digite o Valor do condominio' class='form-control valor'>" +
                        "</div>" +
                        "<div class='form-group'>" +
                            "<label for='portaria24horas'>Possui Portaria 24 Horas</label>" +
                            "<select class='form-control' name='portaria24horas' id='inputPortaria24horas'>" +
                                "<option value='0' selected>Selecione um</option>" +
                                "<option value='1'>Sim</option>" +
                                "<option value='2'>Não</option>" +
                            "</select>" +
                        "</div>";
        }

        saida +=    "<div id='containerValores'></div>"

        saida +=    "<div class='d-inline'>" +
                        "<button type='button' class='btn btn-success mt-2 mr-3' id='btnEnviar'>Enviar Imagem</button>" +
                        "<input type='file' accept='image/*' id='inputImagens' class='hidden' multiple  >" +
                    "</div>" +
                    "<div class='d-inline'>" +
                        "<button type='button' class='btn btn-danger mt-2' id='btnLimpar'>Limpar</button>" +
                    "</div>" +
                    "<div id='imagens' class='text-center pt-4'></div>";

        saida +=    "<div class='text-center'>" +
                        "<button type='button' class='btn btn-orange mt-4' id='btnCadastrar'>Cadastrar</button>" +
                    "</div>";

        $("#campos").append(saida);

        $(".valor").mask("###0.00 R$", {reverse: true});

        $(".valor").on('keyup', function() {
            if (this.value.trim() == "R$") {
                this.value = "";
            }
        });

        $("#inputTipoTransacao").change(function() {
            $("#containerValores").empty();
            if ($(this).val() == 1) {
                saida =    "<div class='form-group'>" +
                                "<label for='valor'>Valor</label>" +
                                "<input type='text' name='valor' id='inputValor' placeholder='Digite o Valor de Venda' class='form-control valor'>" +
                            "</div>" +
                            "<div class='form-group'>" +
                                "<label for='porcentagemImobiliaria'>Porcentagem da Imobiliária</label>" +
                                "<input type='text' name='porcentagemImobiliaria' id='inputPorcentagemImobiliaria' placeholder='Digite a Porcentagem da Imobiliária' class='form-control'>" +
                            "</div>";

                $("#containerValores").append(saida);
            } else if ($(this).val() == 2) {
                saida =    "<div class='form-group'>" +
                                "<label for='valor'>Valor</label>" +
                                "<input type='text' name='valor' id='inputValor' placeholder='Digite o Valor do Aluguel' class='form-control valor'>" +
                            "</div>" +
                            "<div class='form-group'>" +
                                "<label for='porcentagemImobiliaria'>Porcentagem da Imobiliária</label>" +
                                "<input type='text' name='porcentagemImobiliaria' id='inputPorcentagemImobiliaria' placeholder='Digite a Porcentagem da Imobiliária' class='form-control'>" +
                            "</div>";

                $("#containerValores").append(saida);
            }
        });

        $("#btnEnviar").on("click", (e) => {
            e.preventDefault();
            if (document.getElementById("inputImagens").files.length < 6) {
                $("#inputImagens").click();
            } else {
                alert("Você pode enviar no máximo 6 imagens!")
            }
        });

        $("#btnLimpar").on("click", (e) => {
            e.preventDefault();
            $("#imagens").empty();
            document.getElementById("inputImagens").value = "";
        });

        $("#inputImagens").on("change", () => {
            fileInput = document.getElementById("inputImagens");

            const files = fileInput.files;

            for (var z = 0; z < files.length; z++) {
                toBase64(files[z]).then(result => {
                    $("#imagens").append("<img src='" + result +"'" + 
                                         "class='image-cadastro d-inline mx-2 my-2'>");
                });
            }
        });

        $(".valor").mask("###0.00 R$", {reverse: true});

        $(".valor").on('keyup', function() {
            if (this.value.trim() == "R$") {
                this.value = "";
            }
        });

        $("#inputPorcentagemImobiliaria").mask('##0,00 %', {reverse: true});

        $("#inputPorcentagemImobiliaria").on('keyup', function() {
            if (this.value.trim() == "%") {
                this.value = "";
            }
        });
    }

    $("#adicionarProprietario").on('click', function() {
        var clientes;

        $.ajax({
            method: "POST",
            async: false,
            url: "../php/getNomesClientes.php",
            success: function(result)
            {
                clientes = JSON.parse(result);
            }
        });

        $("#proprietarios").append(getProprietarios(true, clientes));

        $(".removivel").change(function() {
            if ($(this).val() === "0") {
                $(this).remove();
            }
        });
    });

    $("#btnCadastrar").on('click', function() {
        var inputRua = $("#inputRua").val();
        var inputNumero = $("#inputNumero").val();
        var inputBairro = $("#inputBairro").val();
        var inputCidade = $("#inputCidade").val();
        var inputEstado = $("#inputEstado").val();
        var inputProprietario = $("#inputProprietario").val();
        var inputTipoTransacao = $("#inputTipoTransacao").val();
        var inputQtdQuartos = $("#inputQtdQuartos").val();
        var inputQtdSuites = $("#inputQtdSuites").val();
        var inputQtdSalaEstar = $("#inputQtdSalaEstar").val();
        var inputQtdSalaJantar = $("#inputQtdSalaJantar").val();
        var inputQtdVagasGaragem = $("#inputQtdVagasGaragem").val();
        var inputArea = $("#inputArea").val();
        var inputArmarioEmbutido = $("#inputArmarioEmbutido").val();
        var inputDescricao = $("#inputDescricao").val();
        var inputAndar = $("#inputAndar").val();
        var inputValorCondominio = $("#inputValorCondominio").val();
        var inputPortaria24horas = $("#inputPortaria24horas").val();
        var inputValor = $("#inputValor").val();
        var inputPorcentagemImobiliaria = $("#inputPorcentagemImobiliaria").val();
        var inputTipoImovel = $("#inputTipoImovel").val();
        var fileInput = document.getElementById("inputImagens").files;

        var ok = false;

        var inputProprietarios = []
        var proprietarios = document.getElementsByName("proprietario");

        for (var x = 0; x < proprietarios.length; x++) {
            if (proprietarios[x].value != "0" && 
                proprietarios[x].value != null && 
                proprietarios[x].value != undefined) {
                    inputProprietarios.push(proprietarios[x].value);
                }
        }
    
        if (inputRua == "" || inputRua == null || inputRua == undefined) {
            alert("Campo Rua não preenchido!");
        } else if (inputNumero == "" || inputNumero == null || inputNumero == undefined) {
            alert("Campo Número não preenchido!");
        } else if (inputBairro == "" || inputBairro == null || inputBairro == undefined) {
            alert("Campo Bairro não preenchido!");
        } else if (inputCidade == "" || inputCidade == null || inputCidade == undefined) {
            alert("Campo Cidade não preenchido!");
        } else if (inputEstado == "" || inputEstado == null || inputEstado == undefined) {
            alert("Campo Estado não preenchido!");
        } else if (inputProprietario == "0" || inputProprietario == null || inputProprietario == undefined) {
            alert("Campo Proprietário não preenchido!");
        } else if (inputTipoTransacao == "0" || inputTipoTransacao == null || inputTipoTransacao == undefined) {
            alert("Campo Tipo de Transação não preenchido!");
        } else if (inputQtdQuartos == "" || inputQtdQuartos == null || inputQtdQuartos == undefined) {
            alert("Campo Quantidade de Quartos não preenchido");
        } else if (inputQtdSuites == "" || inputQtdSuites == null || inputQtdSuites == undefined) {
            alert("Campo Quantidade de Suítes não preenchido!");
        } else if (inputQtdSalaEstar == "" || inputQtdSalaEstar == null || inputQtdSalaEstar == undefined) {
            alert("Campo Quantidade de Salas de Estar não preenchido!");
        } else if (inputQtdSalaJantar == "" || inputQtdSalaJantar == null || inputQtdSalaJantar == undefined) {
            alert("Campo Quantidade de Salas de Jantar não preenchido!");
        } else if (inputQtdVagasGaragem == "" || inputQtdVagasGaragem == null || inputQtdVagasGaragem == undefined) {
            alert("Campo Quantidade de Vagas na Garagem não preenchido!");
        } else if (inputArea == "" || inputArea == null || inputArea == undefined) {
            alert("Campo Área não preenchido!");
        } else if (inputArmarioEmbutido == "0" || inputArmarioEmbutido == null || inputArmarioEmbutido == undefined) {
            alert("Campo Possui Armário Embutido não preenchido!");
        } else if (inputDescricao == "" || inputDescricao == null || inputDescricao == undefined) {
            alert("Campo Descrição não preenchido!");
        } else if (inputTipoImovel == '2') {
            if (inputAndar == "" || inputAndar == null || inputAndar == undefined) {
                alert("Campo Andar não preenchido!");
            } else if (inputValorCondominio == "" || inputValorCondominio == null || inputValorCondominio == undefined) {
                alert("Campo Valor do Condomínio não preenchido!");
            } else if (inputPortaria24horas == "0" || inputPortaria24horas == null || inputPortaria24horas == undefined) {
                alert("Campo Possui Portaria 24 Horas não preenchido!");
            } else {
                if (inputValor == "" || inputValor == null || inputValor == undefined) {
                    alert("Campo Valor não preenchido!");
                } else if (inputPorcentagemImobiliaria == "" || inputPorcentagemImobiliaria == null || inputPorcentagemImobiliaria == undefined) {
                    alert("Campo Porcentagem da Imobiliária não preenchido!");
                } else if (fileInput.length == 0) {
                    alert("Você não selecionou nenhuma imagem!");
                } else if (fileInput.length > 6) {
                    alert("Você pode enviar no máximo 6 imagens!");
                } else {
                    ok = true;
                    inputValor = inputValor.slice(0, inputValor.length - 3);
                }
            }
        } else if (inputValor == "" || inputValor == null || inputValor == undefined) {
            alert("Campo Valor não preenchido!");
        } else if (inputPorcentagemImobiliaria == "" || inputPorcentagemImobiliaria == null || inputPorcentagemImobiliaria == undefined) {
            alert("Campo Porcentagem da Imobiliária não preenchido!");
        } else if (fileInput.length == 0) {
            alert("Você não selecionou nenhuma imagem!");
        } else if (fileInput.length > 6) {
            alert("Você pode enviar no máximo 6 imagens!");
        } else {
            ok = true;
            inputValor = inputValor.slice(0, inputValor.length - 3);
        }

        if (ok) {
            $.ajax({
                method: "POST",
                url: "../php/cadastraImovel.php",
                data:
                {
                    tipoImovel: inputTipoImovel,
                    rua: inputRua,
                    numero: inputNumero,
                    bairro: inputBairro,
                    cidade: inputCidade,
                    estado: inputEstado,
                    proprietarios: inputProprietarios,
                    tipoTransacao: inputTipoTransacao,
                    quantidadeQuartos: inputQtdQuartos,
                    quantidadeSuites: inputQtdSuites,
                    quantidadeSalaEstar: inputQtdSalaEstar,
                    quantidadeSalaJantar: inputQtdSalaJantar,
                    quantidadeVagasGaragem: inputQtdVagasGaragem,
                    area: inputArea,
                    armarioEmbutido: inputArmarioEmbutido,
                    descricao: inputDescricao,
                    valor: inputValor,
                    porcentagemImobiliaria: inputPorcentagemImobiliaria,
                    andar: inputAndar,
                    valorCondominio: inputValorCondominio,
                    portaria24horas: inputPortaria24horas
                },
                success: function(result)
                {
                    result = JSON.parse(result);   
                    var id = result[0].ID;

                    var img_data = new FormData();

                    var ins = document.getElementById('inputImagens').files.length;
                    for (var x = 0; x < ins; x++) {
                        img_data.append("imagens[]", document.getElementById('inputImagens').files[x]);
                    }

                    img_data.append("id", id);

                    $.ajax({
                        method: "POST",
                        url: "../php/cadastraImagensImovel.php",
                        data: img_data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(result)
                        {
                            alert(result);
                            window.location.reload();
                        }
                    });

                }
            });
        }
    });

    $("#inputArea").mask("###0 m²", {reverse: true});

    $("#inputArea").on('keyup', function() {
        if (this.value.trim() == "m²") {
            this.value = "";
        }
    });
});

function getProprietarios(removivel, clientes) {
    var selectPropietarios = "";

    if (removivel) {
        selectPropietarios = ("<select class='form-control removivel mt-2' name='proprietario'>" +
                                  "<option value='0' selected>Selecione um</option>");
    } else {
        selectPropietarios = ("<select class='form-control' name='proprietario' id='inputProprietario'>" +
                                      "<option value='0' selected>Selecione um</option>");
    }

    for (var x = 0; x < clientes.length; x++) {
        selectPropietarios += "<option value='" + clientes[x].ID + "'>" + clientes[x].Nome + "</option>"
    }

    selectPropietarios += "</select>";

    return selectPropietarios;
}
