$(".valor").mask("###0.00 R$", {reverse: true});

$(".valor").on('keyup', function() {
    if (this.value.trim() == "R$") {
        this.value = "";
    }
});

$("#login").on("click", function() {
    $("#btnLogar").attr("data-path-login", "../php/login.php");
    $("#btnLogar").attr("data-path-redirect", "../administrativo/");
});

$("#btnEnviarInteresse").on('click', function() {
    var nome = $("#nome").val();
    var email = $("#email").val();
    var telefone = $("#telefone").val();
    var descricaoProposta = $("#descricaoProposta").val();
    var imovelID = localStorage.getItem('imovelSelecionado');

    if (nome == null || nome == undefined || nome == "") {
        $("#erro").text("Campo Nome não preenchido!");
    } else if (email == null || email == undefined || email == "") {
        $("#erro").text("Campo Email não preenchido!");
    } else if (telefone == null || telefone == undefined || telefone == "") {
        $("#erro").text("Campo Telefone não preenchido!");
    } else if (descricaoProposta == null || descricaoProposta == undefined || descricaoProposta == "") {
        $("#erro").text("Campo Descrição não preenchido!");
    } else {
        $("#erro").text("");
        $.ajax({
            method: "POST",
            url: "../php/cadastraInteresse.php",
            data:
            {
                imovelID: imovelID,
                nome: nome,
                email: email,
                telefone: telefone,
                proposta: descricaoProposta
            },
            success: function(result)
            {
                alert(result);
            }
        });
        $('#modalInteresse').modal("hide");
    }
});

$(".phoneField").last().mask('(00) 0000-0000');
                            
$(".phoneField").on('keydown', function(e) {
    if ((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode == 8) {
        if (this.value.length == 14 && e.keyCode != 8) {
            $(this).mask('(00) 00000-0000');
        } else if (this.value.length < 14) {
            $(this).mask('(00) 0000-0000');
        }
    }
});

$(".phoneField").on('keyup', function(e) {
    if (e.keyCode == 8 && this.value.length == 14) {
        $(this).mask('(00) 0000-0000');
    }
});

$(".radio-proposito").change(function() {
    $.ajax({
        method: "POST",
        url: "../php/getBairros.php",
        data:
        {
            proposito: $(this).val() 
        },
        success: function(result)
        {
            if (result != "Não encontramos nenhum imóvel à venda!" &&
                result != "Não encontramos nenhum imóvel para locação!") {
                
                    $("#btn-buscar").removeAttr("disabled");
                    $("#bairro").empty();
                    $("#bairro").append("<option selected value=''>Selecione um...</option>");
        
                    bairros = JSON.parse(result);
        
                    for (var x = 0; x < bairros.length; x++) {
                        $("#bairro").append("<option value='"+ bairros[x].Bairro +
                                            "'>"+ bairros[x].Bairro +"</option>");
                    }
            } else {
                alert(result);
                $("#btn-buscar").attr("disabled", "disabled");
            }
        }
    });
});

$("#btn-buscar").on("click", function() {
    var inputPropositoVal = "";
    var radioProposito = document.getElementsByName("proposito");
    var inputBairro = $("#bairro").val();
    var inputValMin = $("#valorMin").val();
    var inputValMax = $("#valorMax").val();
    var inputInformacoes = $("#informacoes").val();

    for (var x = 0; x < radioProposito.length; x++) {
        if (radioProposito[x].checked == true) {
            inputPropositoVal = radioProposito[x].value;
        }
    }

    if (inputPropositoVal == "" &&
        inputBairro == "" &&
        inputValMin == "" &&
        inputValMax == "" &&
        inputInformacoes == "") {
            alert("Preencha ao menos um dos campos acima");
    } else {
        if (inputValMin != "") {
            inputValMin = inputValMin.slice(0, inputValMin.length - 3);
        }
    
        if (inputValMax != "") {
            inputValMax = inputValMax.slice(0, inputValMax.length - 3);
        }

        $("#listaImoveis").empty();

        $("body").append("<div id='loadingContainer' class='ml-auto'>" +
                            "<img src='../assets/images/loading.gif' alt='Loading' id='loadingIcon'>" +
                        "</div>");

        carregando = 0;

        $.ajax({
            method: "POST",
            url: "../php/pesquisaImoveis.php",
            data:
            {
                proposito: inputPropositoVal,
                bairro: inputBairro,
                valMin: inputValMin,
                valMax: inputValMax,
                informacoes: inputInformacoes 
            },
            success: function(result)
            {
                if (result != "Não encontramos nenhum imóvel para os seus critérios de busca") {
                    imoveis = JSON.parse(result);

                    for (var x = 0; x < imoveis.length; x++) {
                        $.ajax({
                            method: "POST",
                            url: "../php/getImagens.php",
                            data:
                            {
                                id: imoveis[x].ID,
                                quantidade: 3,
                                index: x
                            },
                            success: function(result)
                            {
                                imagens = JSON.parse(result);
                                x = imagens[0];
                                area = imoveis[x].Area.slice(0, imoveis[x].Area.indexOf('Â')) + 
                                        imoveis[x].Area[imoveis[x].Area.length - 1];

                                saida = "<div class='row mx-auto mb-3 corpo-imovel w-100'>" +
                                            "<div class='col-sm-3 p-3 text-center'>" +
                                                "<ul class='list-unstyled text-left'>" +
                                                    "<li><strong>Tipo:</strong> " + 
                                                        imoveis[x].TipoImovel +
                                                    "</li>" +
                                                    "<li><strong>Cidade:</strong> " + 
                                                        imoveis[x].Cidade +
                                                    "</li>" +
                                                    "<li><strong>Bairro:</strong> " + 
                                                    imoveis[x].Bairro +"</li>" +
                                                    "<li><strong>Quartos:</strong> " + 
                                                        imoveis[x].QuantidadeQuartos +
                                                    "</li>" +
                                                    "<li><strong>Suites:</strong> " + 
                                                        imoveis[x].QuantidadeSuites +
                                                    "</li>" +
                                                    "<li><strong>Área:</strong> " + 
                                                        area +
                                                    "</li>" +
                                                    "<li><strong>Preço:</strong> R$ " + 
                                                        parseFloat(imoveis[x].Valor).toFixed(2) 
                                                    +"</li>" +
                                                "</ul>" +
                                                "<div class='row'>" +
                                                    "<button " +
                                                    "type='button' " + 
                                                    "class='btn cor-btn btn-informacoes mx-auto' " + 
                                                    "data-toggle='modal' " + 
                                                    "data-target='#maisInformacoes' " +
                                                    "data-imovel-id='"+ imoveis[x].ID +"'>" +
                                                        "Mais informações" +
                                                    "</button>" +
                                                "</div>" +
                                                "<div class='row'>" +
                                                    "<button " + 
                                                    "type='button' " + 
                                                    "class='btn cor-btn btn-interesse mt-3 mx-auto' " + 
                                                    "data-toggle='modal' " + 
                                                    "data-target='#modalInteresse' " +
                                                    "data-imovel-id='"+ imoveis[x].ID +"'>" +
                                                        "Tenho interesse" +
                                                    "</button>" +
                                                "</div>" +
                                            "</div>" +
                                            "<div class='col-sm-9 imagens-pesquisa'>" +
                                                "<div class='row h-100'>";

                                for (var z = 0; z < imagens.length - 1; z++) {
                                    saida +=        "<div class='col-sm-4 text-center my-auto'>" +
                                                        "<img " + 
                                                        "src='../assets/images/uploads/"+ imagens[z + 1].Imagem +"' " + 
                                                        "class='imagens-casas img-fluid'>" +
                                                    "</div>";
                                }
                                                
                                saida +=        "</div>" +
                                            "</div>" +
                                        "</div>";

                                $("#listaImoveis").append(saida);
                            
                                localStorage.setItem('imovelSelecionado', '');

                                carregando++;

                                if (carregando == imoveis.length) {
                                    $(".btn-informacoes").on('click', function() {
                                        $(this).attr("disabled", "disabled");
                                        localStorage.setItem('imovelSelecionado', $(this).attr('data-imovel-id'));
                                
                                        $("body").append("<div id='loadingContainer' class='ml-auto'>" +
                                                            "<img src='../assets/images/loading.gif' alt='Loading' id='loadingIcon'>" +
                                                        "</div>");
                                
                                        $("#carouselArrows").empty();
                                        $("#carouselImages").empty();
                                        $("#infoImovel").empty();
                                    
                                        $.ajax({
                                            method: "POST",
                                            async: false,
                                            url: "../php/getInfoImovel.php",
                                            data:
                                            {
                                                id: localStorage.getItem('imovelSelecionado')  
                                            },
                                            success: function(result)
                                            {
                                                imoveis = JSON.parse(result);
                                
                                                $.ajax({
                                                    method: "POST",
                                                    url: "../php/getImagens.php",
                                                    async: false,
                                                    data:
                                                    {
                                                        id: localStorage.getItem('imovelSelecionado'),
                                                        quantidade: 6,
                                                    },
                                                    success: function(result)
                                                    {
                                                        imagens = JSON.parse(result);
                                
                                                        $("#carouselArrows").append(
                                                            "<li " +
                                                            "data-target='#carouselMaisInformacoes'" + 
                                                            "data-slide-to='0' " + 
                                                            "class='active'></li>"
                                                        );
                                
                                                        for (var i = 1; i < imagens.length; i++) {
                                                            $("#carouselArrows").append(
                                                                "<li " +
                                                                "data-target='#carouselMaisInformacoes' " + 
                                                                "data-slide-to='1'></li>" 
                                                            );
                                                        }
                                
                                                        $("#carouselImages").append(
                                                            "<div class='carousel-item active'>" +
                                                                "<img " +
                                                                "class='d-block imagem-carousel w-100' " + 
                                                                "src='../assets/images/uploads/"+ imagens[0].Imagem +"' " +
                                                                "alt='Imagem 1 da casa'>" +
                                                            "</div>"
                                                        );
                                
                                                        for (var i = 1; i < imagens.length; i++) {
                                                            $("#carouselImages").append(
                                                                "<div class='carousel-item'>" +
                                                                    "<img " +
                                                                    "class='d-block imagem-carousel w-100' " + 
                                                                    "src='../assets/images/uploads/"+ imagens[i].Imagem +"' " +
                                                                    "alt='Imagem "+ i +" da casa'>" +
                                                                "</div>"
                                                            );
                                                        }
                                
                                                        saida = "<div class='col-sm-12'>" +
                                                                    "<div class='row'>" +
                                                                        "<h4>"+ imoveis[0].TipoImovel +"</h4>" +
                                                                    "</div>" +
                                                                    "<div class='row'>" +
                                                                        "<h6>Rua "+ 
                                                                            imoveis[0].Rua + 
                                                                            " " + 
                                                                            imoveis[0].Numero + 
                                                                            ", Bairro " + 
                                                                            imoveis[0].Bairro +
                                                                            ", " + 
                                                                            imoveis[0].Cidade +
                                                                            " - " +
                                                                            imoveis[0].Estado +
                                                                            "</h6>" +
                                                                    "</div>";
                                
                                                        if (imoveis[0].TipoTransacao == 1) {
                                                            saida +=    "<div class='row mt-2'>" +
                                                                            "<div class='col-sm-12'>" +
                                                                                "<h3>" +
                                                                                    "<strong>Preço: </strong> R$ " +
                                                                                    parseFloat(imoveis[0].Valor).toFixed(2) +
                                                                                "</h3>" +
                                                                            "</div>" +
                                                                        "</div>";
                                                        } else if (imoveis[0].TipoTransacao == 2) {
                                                            saida +=    "<div class='row mt-2'>" +
                                                                            "<div class='col-sm-12'>" +
                                                                                "<h3>" +
                                                                                    "<strong>Aluguel: </strong> R$ " +
                                                                                    parseFloat(imoveis[0].Valor).toFixed(2) +
                                                                                "</h3>" +
                                                                            "</div>" +
                                                                        "</div>";
                                                        }
                                                            
                                                        saida +=    "<hr>" +
                                                                    "<div class='row mt-2'>" +
                                                                        "<div class='col-sm-3'>" +
                                                                            "<span>" +
                                                                                "<strong>Quartos: </strong>"+ 
                                                                                imoveis[0].QuantidadeQuartos +
                                                                            "</span>" +
                                                                        "</div>" +
                                                                        "<div class='col-sm-3'>" +
                                                                            "<span>" +
                                                                                "<strong>Suítes: </strong>"+ 
                                                                                imoveis[0].QuantidadeSuites +
                                                                            "</span>" +
                                                                        "</div>" +
                                                                        "<div class='col-sm-3'>" +
                                                                            "<span>" +
                                                                                "<strong>Salas de Estar: </strong>"+ 
                                                                                imoveis[0].QuantidadeSalaEstar +
                                                                            "</span>" +
                                                                        "</div>" +
                                                                        "<div class='col-sm-3'>" +
                                                                            "<span>" +
                                                                                "<strong>Salas de Jantar: </strong>"+ 
                                                                                imoveis[0].QuantidadeSalaJantar +
                                                                            "</span>" +
                                                                        "</div>" +
                                                                    "</div>" +
                                                                    "<div class='row mt-2'>" +
                                                                        "<div class='col-sm-3'>" +
                                                                            "<span>" +
                                                                                "<strong>Vagas: </strong>"+ 
                                                                                imoveis[0].QuantidadeVagasGaragem +
                                                                            "</span>" +
                                                                        "</div>" +
                                                                        "<div class='col-sm-3'>" +
                                                                            "<span>" +
                                                                                "<strong>Area: </strong>"+ 
                                                                                imoveis[0].Area +
                                                                            "</span>" +
                                                                        "</div>" +
                                                                        "<div class='col-sm-3'>" +
                                                                            "<span>" +
                                                                                "<strong>Armario Embutido: </strong>"+ 
                                                                                imoveis[0].ArmarioEmbutido +
                                                                            "</span>" +
                                                                        "</div>";
                                
                                                        if (imoveis[0].TipoImovel == "Apartamento") {
                                                            condominio = imoveis[0].ValorCondominio.slice(0, 
                                                                imoveis[0].ValorCondominio.length - 3)
                                
                                                            portaria = "";
                                
                                                            if (imoveis[0].Portaria24Horas == 1) {
                                                                portaria = "Sim";
                                                            } else {
                                                                portaria = "Não";
                                                            }
                                
                                                            saida +=    "<div class='col-sm-3'>" +
                                                                            "<span>" +
                                                                                "<strong>Andar: </strong>"+ 
                                                                                imoveis[0].Andar +
                                                                            "</span>" +
                                                                        "</div>" +
                                                                    "</div>" +
                                                                    "<div class='row mt-2'>" +
                                                                        "<div class='col-sm-3'>" +
                                                                            "<span>" +
                                                                                "<strong>Condominio:</strong> R$"+ 
                                                                                condominio +
                                                                            "</span>" +
                                                                        "</div>" +
                                                                        "<div class='col-sm-3'>" +
                                                                            "<span>" +
                                                                                "<strong>Portaria 24hrs: </strong>"+ 
                                                                                portaria +
                                                                            "</span>" +
                                                                        "</div>" +
                                                                    "</div>";
                                                        }
                                
                                                        saida +=    "<div class='row mt-5'>" +
                                                                        "<div class='col-sm-12'>" +
                                                                            "<span>" +
                                                                                imoveis[0].Descricao +
                                                                            "</span>" +
                                                                        "</div>" +
                                                                    "</div>" +
                                                                "</div>";
                                
                                                        $("#infoImovel").append(saida);
                                                    }
                                                });
                                            }
                                        });
                                
                                        $("#loadingContainer").remove();
                                        $(this).removeAttr("disabled");
                                    });

                                    $(".btn-interesse").on('click', function() {
                                        localStorage.setItem('imovelSelecionado', $(this).attr('data-imovel-id'));
                                    });

                                    $("#loadingContainer").remove();
                                }
                            }
                        });
                    }
                } else {
                    $("#listaImoveis").append(  "<div class='text-center mb-5 text-white'>"+
                                                    "<h1>"+ result +"</h1>"+
                                                "</div>");

                    $("#loadingContainer").remove();
                }
            }
        });
    }
});
