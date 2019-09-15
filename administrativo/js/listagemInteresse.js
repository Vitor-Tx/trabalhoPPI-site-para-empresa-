window.onload = () => {
    interesses.forEach(function(interesse) {
        $("#admContainer").append("<div class='row pt-4'>" +
                                    "<div class='container'>" +
                                        "<div class='col-sm-12 admBox'>" +
                                            "<div class='row'>" +
                                                "<h1>" + interesse.cliente + "</h1>" +
                                            "</div>" +
                                            "<div class='row mt-2 ml-1'>" +
                                                "<label for='imovel'><strong>Imóvel:&nbsp&nbsp</strong></label>" +
                                                "<span name='imovel'>" + interesse.imovel +"</span>" +
                                            "</div>" +
                                            "<div class='row mt-2 ml-1'>" +
                                                "<label for='telefoneCliente'><strong>Telefone do Cliente:&nbsp&nbsp</strong></label>" +
                                                "<span name='telefoneCliente'>" + interesse.telefoneCliente +"</span>" +
                                            "</div>" +
                                            "<div class='row mt-2 ml-1'>" +
                                                "<label for='emailCliente'><strong>Email do CLiente:&nbsp&nbsp</strong></label>" +
                                                "<span name='emailCliente'>" + interesse.emailCliente +"</span>" +
                                            "</div>" +
                                            "<div class='row mt-2 ml-1'>" +
                                                "<label for='proposta'><strong>Proposta:&nbsp&nbsp</strong></label>" +
                                                "<span name='proposta'>" + interesse.proposta +"</span>" +
                                            "</div>");
    });
}