function addInfoJS() {
    $(".btn-informacoes").on('click', function() {
        localStorage.setItem('imovelSelecionado', $(this).attr('data-imovel-id'));

        console.log(localStorage.getItem('imovelSelecionado'));

        $("#carouselArrows").empty();
        $("#carouselImages").empty();
        $("#infoImovel").empty();
    
        $.ajax({
            method: "POST",
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
                                "src='"+ imagens[0].Imagem +"' " +
                                "alt='Imagem 1 da casa'>" +
                            "</div>"
                        );

                        for (var i = 1; i < imagens.length; i++) {
                            $("#carouselImages").append(
                                "<div class='carousel-item'>" +
                                    "<img " +
                                    "class='d-block imagem-carousel w-100' " + 
                                    "src='"+ imagens[i].Imagem +"' " +
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
                                                    imoveis[0].Valor.toFixed(2) +
                                                "</h3>" +
                                            "</div>" +
                                        "</div>";
                        } else if (imoveis[0].TipoTransacao == 2) {
                            saida +=    "<div class='row mt-2'>" +
                                            "<div class='col-sm-12'>" +
                                                "<h3>" +
                                                    "<strong>Aluguel: </strong> R$ " +
                                                    imoveis[0].Valor.toFixed(2) +
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

                            console.log(imoveis[0].Portaria24Horas)

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
    });
}