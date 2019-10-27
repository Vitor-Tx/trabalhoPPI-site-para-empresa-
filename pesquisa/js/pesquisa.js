$(".valor").mask("###0.00 R$", {reverse: true});

$(".valor").on('keyup', function() {
    if (this.value.trim() == "R$") {
        this.value = "";
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
                                                        "src='"+ imagens[z + 1].Imagem +"' " + 
                                                        "class='imagens-casas img-fluid'>" +
                                                    "</div>";
                                }
                                                
                                saida +=        "</div>" +
                                            "</div>" +
                                        "</div>";

                                $("#listaImoveis").append(saida);
                                addInfoJS();
                                addInteresseJS();
                            }
                        });
                    }
                } else {
                    $("#listaImoveis").append(  "<div class='text-center mb-5 text-white'>"+
                                                    "<h1>"+ result +"</h1>"+
                                                "</div>");
                }
            }
        });
    }
});
