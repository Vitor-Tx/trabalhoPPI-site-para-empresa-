window.onload = () => {
    clientes.forEach(function(cliente) {
        var counterTelefone = 1;
        var saida = ("<div class='row pt-4'>" +
                        "<div class='container'>" +
                            "<div class='col-sm-12 box-cliente'>" +
                                "<div class='row'>" +
                                    "<h4>" + cliente.nome + "</h4>" +
                                "</div>" +
                                "<hr>" +
                                "<div class='row mt-2 ml-1'>" +
                                    "<label for='cpf'><strong>CPF:&nbsp&nbsp</strong></label>" +
                                    "<span name='cpf'>" + cliente.cpf + "</span>" +
                                "</div>" +
                                "<div class='row ml-1'>" +
                                    "<label for='endereco'><strong>Endereço:&nbsp&nbsp</strong></label>" +
                                    "<span name='endereco'>" + cliente.endereco + "</span>" +
                                "</div>");

        cliente.telefones.forEach(function(telefone) {
            saida += ("<div class='row ml-1'>" +
                          "<label for='telefone" + counterTelefone + "'><strong>Telefone" + counterTelefone + ":&nbsp&nbsp</strong></label>" +
                          "<span name='telefone" + counterTelefone + "'>" + telefone + "</span>" +
                      "</div>");

            counterTelefone++;
        });

        saida += (            "<div class='row ml-1'>" +
                                  "<label for='email'><strong>Email:&nbsp&nbsp</strong></label>" +
                                  "<span name='email'>" + cliente.email + "</span>" +
                              "</div>" +
                              "<div class='row ml-1'>" +
                                  "<label for='sexo'><strong>Sexo:&nbsp&nbsp</strong></label>" +
                                  "<span name='sexo'>" + cliente.sexo + "</span>" +
                              "</div>" +
                              "<div class='row ml-1'>" +
                                  "<label for='estadoCivil'><strong>Estado Civil:&nbsp&nbsp</strong></label>" +
                                  "<span name='estadoCivil'>" + cliente.estadoCivil + "</span>" +
                              "</div>" +
                              "<div class='row ml-1'>" +
                                  "<label for='profissao'><strong>Profissão:&nbsp&nbsp</strong></label>" +
                                  "<span name='profissao'>" + cliente.profissão + "</span>" +
                              "</div>" +
                          "</div>" +
                      "</div>" +
                  "</div>");

        $("#container-clientes").append(saida);
    });
}