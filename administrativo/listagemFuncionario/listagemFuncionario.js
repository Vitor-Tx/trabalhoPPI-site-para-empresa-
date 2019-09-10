window.onload = () => {
    funcionarios.forEach(function(funcionario) {
        $("#container-funcionarios").append(
            "<div class='row pt-4'>" +
                "<div class='container'>" +
                    "<div class='col-sm-12 box-funcionario'>" +
                        "<div class='row'>" +
                            "<h4>" + funcionario.nome + " <span class='badge badge-secondary'>" + funcionario.cargo + "</span></h4>" +
                        "</div>" +
                        "<hr>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='cpf'><strong>CPF:&nbsp&nbsp</strong></label>" +
                            "<span name='cpf'>" + funcionario.cpf + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='endereco'><strong>Endereço:&nbsp&nbsp</strong></label>" +
                            "<span name='endereco'>" + funcionario.endereco + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='telefone'><strong>Telefone:&nbsp&nbsp</strong></label>" +
                            "<span name='telefone'>" + funcionario.telefone + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='telefoneContato'><strong>Telefone de Contato:&nbsp&nbsp</strong></label>" +
                            "<span name='telefoneContato'>" + funcionario.telefoneContato + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='telefoneCelular'><strong>Telefone Celular:&nbsp&nbsp</strong></label>" +
                            "<span name='telefoneCelular'>" + funcionario.telefoneCelular + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='dataIngresso'><strong>Data de Ingresso:&nbsp&nbsp</strong></label>" +
                            "<span name='telefone'>" + funcionario.dataIngresso + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='salarioBase'><strong>Salário Base:&nbsp&nbsp</strong></label>" +
                            "<span name='salarioBase'>" + funcionario.salarioBase + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='comissao'><strong>Comissão:&nbsp&nbsp</strong></label>" +
                            "<span name='comissao'>" + funcionario.comissao + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='salario'><strong>Salário:&nbsp&nbsp</strong></label>" +
                            "<span name='salario'>" + funcionario.salario + "</span>" +
                        "</div>" +
                        "<div class='row mt-2 ml-1'>" +
                            "<label for='login'><strong>Login:&nbsp&nbsp</strong></label>" +
                            "<span name='login' class='text-break'>" + funcionario.login + "</span>" +
                        "</div>" +
                    "</div>" +
                "</div>" +
            "</div>");
    });
}