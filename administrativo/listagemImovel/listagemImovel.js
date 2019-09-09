window.onload = () => {
    imoveis.forEach(function(imovel) {
        var counterProprietario = 1;
        var saida = ""; 
        
        if (imovel.tipo === 1) {
            saida += ("<div class='row pt-4'>" +
                        "<div class='container'>" +
                            "<div class='col-sm-12 box-imovel'>" +
                                "<div class='row'>" +
                                    "<h4>" + imovel.endereco + "</h4>" +
                                "</div>" +
                                "<hr>" +
                                "<div class='row mt-2 ml-1'>" +
                                    "<label for='tipo'><strong>Tipo:&nbsp&nbsp</strong></label>" +
                                    "<span name='tipo'>Casa</span>" +
                                "</div>" +
                                "<div class='row mt-2 ml-1'>" +
                                    "<label for='tipoTransacao'><strong>Tipo de Transacao:&nbsp&nbsp</strong></label>" +
                                    "<span name='tipoTransacao'>" + imovel.tipoTransacao + "</span>" +
                                "</div>");

            imovel.proprietarios.forEach(function(proprietario) {
                saida += ("<div class='row ml-1'>" +
                            "<label for='proprietario" + counterProprietario + "'><strong>Proprietario" + counterProprietario + ":&nbsp&nbsp</strong></label>" +
                            "<span name='proprietario" + counterProprietario + "'>" + proprietario + "</span>" +
                        "</div>");

                counterProprietario++;
            });

            saida += ("<div class='row mt-2 ml-1'>" +
                            "<label for='qtdQuartos'><strong>Quantidade de Quartos:&nbsp&nbsp</strong></label>" +
                            "<span name='qtdQuartos'>" + imovel.qtdQuartos + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='qtdSuites'><strong>Quantidade de Suites:&nbsp&nbsp</strong></label>" +
                            "<span name='qtdSuites'>" + imovel.qtdSuites + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='qtdSalaEstar'><strong>Quantidade de Salas de Estar:&nbsp&nbsp</strong></label>" +
                            "<span name='qtdSalaEstar'>" + imovel.qtdSalaEstar + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='qtdSalaJantar'><strong>Quantidade de Salas de Jantar:&nbsp&nbsp</strong></label>" +
                            "<span name='qtdSalaJantar'>" + imovel.qtdSalaJantar + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='vagasGaragem'><strong>Número de Vagas na Garagem:&nbsp&nbsp</strong></label>" +
                            "<span name='vagasGaragem'>" + imovel.vagasGaragem + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='area'><strong>Área:&nbsp&nbsp</strong></label>" +
                            "<span name='area'>" + imovel.area + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='armarioEmbutido'><strong>Possui Armário Embutido:&nbsp&nbsp</strong></label>" +
                            "<span name='armarioEmbutido'>" + imovel.armarioEmbutido + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='descricao'><strong>Descrição:&nbsp&nbsp</strong></label>" +
                            "<span name='descricao'>" + imovel.descricao + "</span>" +
                        "</div>");

            if (imovel.tipoTransacao === "Venda") {
                saida += ("<div class='row mt-2 ml-1'>" +
                              "<label for='valorVenda'><strong>Valor de Venda:&nbsp&nbsp</strong></label>" +
                              "<span name='valorVenda'>" + imovel.valorVenda + "</span>" +
                          "</div>" +
                          "<div class='row mt-2 ml-1'>" +
                              "<label for='valorRealVenda'><strong>Valor Real de Venda:&nbsp&nbsp</strong></label>" +
                              "<span name='valorRealVenda'>" + imovel.valorRealVenda + "</span>" +
                          "</div>" +
                          "<div class='row mt-2 ml-1'>" +
                              "<label for='porcentagemImobiliaria'><strong>Porcentagem da Imobiliaria:&nbsp&nbsp</strong></label>" +
                              "<span name='porcentagemImobiliaria'>" + imovel.porcentagemImobiliaria + "</span>" +
                          "</div>" +
                          "<div class='row mt-2 ml-1'>" +
                              "<label for='dataInicioVenda'><strong>Data de Início da Venda:&nbsp&nbsp</strong></label>" +
                              "<span name='dataInicioVenda'>" + imovel.dataInicioVenda + "</span>" +
                          "</div>" +
                          "<div class='row mt-2 ml-1'>" +
                              "<label for='dataFimVenda'><strong>Data de Fim da Venda:&nbsp&nbsp</strong></label>" +
                              "<span name='dataFimVenda'>" + imovel.dataFimVenda + "</span>" +
                          "</div>" +
                          "<div class='row mt-2 ml-1'>" +
                              "<label for='vendido'><strong>Vendido:&nbsp&nbsp</strong></label>" +
                              "<span name='vendido'>" + imovel.vendido + "</span>" +
                          "</div>" +
                          "<div class='row mt-2 ml-1'>" +
                              "<label for='funcionarioResponsavel'><strong>Funcionário Responsável:&nbsp&nbsp</strong></label>" +
                              "<span name='funcionarioResponsavel'>" + imovel.funcionarioResponsavel + "</span>" +
                          "</div>");
            } else if (imovel.tipoTransacao === "Aluguel") {
                saida += ("<div class='row mt-2 ml-1'>" +
                              "<label for='valorAluguel'><strong>Valor do    Aluguel:&nbsp&nbsp</strong></label>" +
                              "<span name='valorAluguel'>" + imovel.valorAluguel + "</span>" +
                          "</div>" +
                          "<div class='row mt-2 ml-1'>" +
                              "<label for='valorRealAluguel'><strong>Valor Real do Aluguel:&nbsp&nbsp</strong></label>" +
                              "<span name='valorRealAluguel'>" + imovel.valorRealAluguel + "</span>" +
                          "</div>" +
                          "<div class='row mt-2 ml-1'>" +
                              "<label for='porcentagemImobiliaria'><strong>Porcentagem da Imobiliaria:&nbsp&nbsp</strong></label>" +
                              "<span name='porcentagemImobiliaria'>" + imovel.porcentagemImobiliaria + "</span>" +
                          "</div>" +
                          "<div class='row mt-2 ml-1'>" +
                              "<label for='dataInicioAluguel'><strong>Data de Início do Aluguel:&nbsp&nbsp</strong></label>" +
                              "<span name='dataInicioAluguel'>" + imovel.dataInicioAluguel + "</span>" +
                          "</div>" +
                          "<div class='row mt-2 ml-1'>" +
                              "<label for='dataFimAluguel'><strong>Data de Fim do Aluguel:&nbsp&nbsp</strong></label>" +
                              "<span name='dataFimAluguel'>" + imovel.dataFimAluguel + "</span>" +
                          "</div>" +
                          "<div class='row mt-2 ml-1'>" +
                              "<label for='alugado'><strong>Alugado:&nbsp&nbsp</strong></label>" +
                              "<span name='alugado'>" + imovel.alugado + "</span>" +
                          "</div>" +
                          "<div class='row mt-2 ml-1'>" +
                              "<label for='funcionarioResponsavel'><strong>Funcionário Responsável:&nbsp&nbsp</strong></label>" +
                              "<span name='funcionarioResponsavel'>" + imovel.funcionarioResponsavel + "</span>" +
                          "</div>");
            }

            saida += (    "</div>" +
                      "</div>" +
                  "</div>");

        } else if (imovel.tipo === 2) {
            saida += ("<div class='row pt-4'>" +
            "<div class='container'>" +
                "<div class='col-sm-12 box-imovel'>" +
                    "<div class='row'>" +
                        "<h4>" + imovel.endereco + "</h4>" +
                    "</div>" +
                    "<hr>" +
                    "<div class='row mt-2 ml-1'>" +
                        "<label for='tipo'><strong>Tipo:&nbsp&nbsp</strong></label>" +
                        "<span name='tipo'>Apartamento</span>" +
                    "</div>" +
                    "<div class='row mt-2 ml-1'>" +
                        "<label for='tipoTransacao'><strong>Tipo de Transacao:&nbsp&nbsp</strong></label>" +
                        "<span name='tipoTransacao'>" + imovel.tipoTransacao + "</span>" +
                    "</div>");

            imovel.proprietarios.forEach(function(proprietario) {
                saida += ("<div class='row ml-1'>" +
                            "<label for='proprietario" + counterProprietario + "'><strong>Proprietario" + counterProprietario + ":&nbsp&nbsp</strong></label>" +
                            "<span name='proprietario" + counterProprietario + "'>" + proprietario + "</span>" +
                        "</div>");

                counterProprietario++;
            });

            saida += ("<div class='row mt-2 ml-1'>" +
                            "<label for='qtdQuartos'><strong>Quantidade de Quartos:&nbsp&nbsp</strong></label>" +
                            "<span name='qtdQuartos'>" + imovel.qtdQuartos + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='qtdSuites'><strong>Quantidade de Suites:&nbsp&nbsp</strong></label>" +
                            "<span name='qtdSuites'>" + imovel.qtdSuites + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='qtdSalaEstar'><strong>Quantidade de Salas de Estar:&nbsp&nbsp</strong></label>" +
                            "<span name='qtdSalaEstar'>" + imovel.qtdSalaEstar + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='qtdSalaJantar'><strong>Quantidade de Salas de Jantar:&nbsp&nbsp</strong></label>" +
                            "<span name='qtdSalaJantar'>" + imovel.qtdSalaJantar + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='vagasGaragem'><strong>Número de Vagas na Garagem:&nbsp&nbsp</strong></label>" +
                            "<span name='vagasGaragem'>" + imovel.vagasGaragem + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='area'><strong>Área:&nbsp&nbsp</strong></label>" +
                            "<span name='area'>" + imovel.area + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='armarioEmbutido'><strong>Possui Armário Embutido:&nbsp&nbsp</strong></label>" +
                            "<span name='armarioEmbutido'>" + imovel.armarioEmbutido + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='descricao'><strong>Descrição:&nbsp&nbsp</strong></label>" +
                            "<span name='descricao'>" + imovel.descricao + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='andar'><strong>Andar:&nbsp&nbsp</strong></label>" +
                            "<span name='andar'>" + imovel.andar + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='valorCondominio'><strong>Valor do Condomínio:&nbsp&nbsp</strong></label>" +
                            "<span name='valorCondominio'>" + imovel.valorCondominio + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='portaria24horas'><strong>Possui Portaria 24 Horas:&nbsp&nbsp</strong></label>" +
                            "<span name='portaria24horas'>" + imovel.portaria24horas + "</span>" +
                        "</div>");

            if (imovel.tipoTransacao === "Venda") {
                saida += ("<div class='row mt-2 ml-1'>" +
                                "<label for='valorVenda'><strong>Valor de Venda:&nbsp&nbsp</strong></label>" +
                                "<span name='valorVenda'>" + imovel.valorVenda + "</span>" +
                            "</div>" +
                            "<div class='row mt-2 ml-1'>" +
                                "<label for='valorRealVenda'><strong>Valor Real de Venda:&nbsp&nbsp</strong></label>" +
                                "<span name='valorRealVenda'>" + imovel.valorRealVenda + "</span>" +
                            "</div>" +
                            "<div class='row mt-2 ml-1'>" +
                                "<label for='porcentagemImobiliaria'><strong>Porcentagem da Imobiliaria:&nbsp&nbsp</strong></label>" +
                                "<span name='porcentagemImobiliaria'>" + imovel.porcentagemImobiliaria + "</span>" +
                            "</div>" +
                            "<div class='row mt-2 ml-1'>" +
                                "<label for='dataInicioVenda'><strong>Data de Início da Venda:&nbsp&nbsp</strong></label>" +
                                "<span name='dataInicioVenda'>" + imovel.dataInicioVenda + "</span>" +
                            "</div>" +
                            "<div class='row mt-2 ml-1'>" +
                                "<label for='dataFimVenda'><strong>Data de Fim da Venda:&nbsp&nbsp</strong></label>" +
                                "<span name='dataFimVenda'>" + imovel.dataFimVenda + "</span>" +
                            "</div>" +
                            "<div class='row mt-2 ml-1'>" +
                                "<label for='vendido'><strong>Vendido:&nbsp&nbsp</strong></label>" +
                                "<span name='vendido'>" + imovel.vendido + "</span>" +
                            "</div>" +
                            "<div class='row mt-2 ml-1'>" +
                                "<label for='funcionarioResponsavel'><strong>Funcionário Responsável:&nbsp&nbsp</strong></label>" +
                                "<span name='funcionarioResponsavel'>" + imovel.funcionarioResponsavel + "</span>" +
                            "</div>");
            } else if (imovel.tipoTransacao === "Aluguel") {
                saida += ("<div class='row mt-2 ml-1'>" +
                                "<label for='valorAluguel'><strong>Valor do Aluguel:&nbsp&nbsp</strong></label>" +
                                "<span name='valorAluguel'>" + imovel.valorAluguel + "</span>" +
                            "</div>" +
                            "<div class='row mt-2 ml-1'>" +
                                "<label for='valorRealAluguel'><strong>Valor Real do Aluguel:&nbsp&nbsp</strong></label>" +
                                "<span name='valorRealAluguel'>" + imovel.valorRealAluguel + "</span>" +
                            "</div>" +
                            "<div class='row mt-2 ml-1'>" +
                                "<label for='porcentagemImobiliaria'><strong>Porcentagem da Imobiliaria:&nbsp&nbsp</strong></label>" +
                                "<span name='porcentagemImobiliaria'>" + imovel.porcentagemImobiliaria + "</span>" +
                            "</div>" +
                            "<div class='row mt-2 ml-1'>" +
                                "<label for='dataInicioAluguel'><strong>Data de Início do Aluguel:&nbsp&nbsp</strong></label>" +
                                "<span name='dataInicioAluguel'>" + imovel.dataInicioAluguel + "</span>" +
                            "</div>" +
                            "<div class='row mt-2 ml-1'>" +
                                "<label for='dataFimAluguel'><strong>Data de Fim do Aluguel:&nbsp&nbsp</strong></label>" +
                                "<span name='dataFimAluguel'>" + imovel.dataFimAluguel + "</span>" +
                            "</div>" +
                            "<div class='row mt-2 ml-1'>" +
                                "<label for='alugado'><strong>Alugado:&nbsp&nbsp</strong></label>" +
                                "<span name='alugado'>" + imovel.alugado + "</span>" +
                            "</div>" +
                            "<div class='row mt-2 ml-1'>" +
                                "<label for='funcionarioResponsavel'><strong>Funcionário Responsável:&nbsp&nbsp</strong></label>" +
                                "<span name='funcionarioResponsavel'>" + imovel.funcionarioResponsavel + "</span>" +
                            "</div>");
            }

            saida += (    "</div>" +
                        "</div>" +
                    "</div>");
        }

        $("#container-imoveis").append(saida);
    });
}