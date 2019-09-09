$("#inputTipoImovel").change(function() {
    if ($(this).val() === '1') {
        $("#campos").empty();
        $("#campos").append("<div class='form-group'>" +
                                "<label for='rua'>Rua</label>" +
                                "<input type='text' name='rua' id='inputRua' placeholder='Digite o Nome da Rua e o Número da Casa' class='form-control'>" +
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
                                "<input type='text' name='estado' id='inputEstado' placeholder='Digite o Nome do Estado' class='form-control'>" +
                            "</div>" +
                            "<div class='form-group'>" +
                                "<label for='proprietario'>Proprietário</label>" +
                                "<div id='proprietarios'>" +
                                    getProprietarios(false) +
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
                                "<label for='qtdQuartos'>Quantidade de Quartos</label>" +
                                "<input type='number' name='qtdQuartos' id='inputQtdQuartos' placeholder='Digite o Número de Quartos' class='form-control'>" +
                            "</div>" +
                            "<div class='form-group'>" +
                                "<label for='qtdSuites'>Quantidade de Suítes</label>" +
                                "<input type='number' name='qtdQuartos' id='inputQtdQuartos' placeholder='Digite o Número de Quartos' class='form-control'>" +
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
                                "<input type='number' name='area' id='inputArea' placeholder='Digite a Área (m²)' class='form-control'>" +
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
                            "</div>" +
                            "<div id='dadosTransacao'></div>" +
                            "<div class='text-center'>" +
                                "<button type='button' class='btn btn-primary'>Cadastrar</button>" +
                            "</div>");
    } else if ($(this).val() === '2') {
        $("#campos").empty();
        $("#campos").append("<div class='form-group'>" +
                                "<label for='rua'>Rua</label>" +
                                "<input type='text' name='rua' id='inputRua' placeholder='Digite o Nome da Rua e o Número da Casa' class='form-control'>" +
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
                                "<input type='text' name='estado' id='inputEstado' placeholder='Digite o Nome do Estado' class='form-control'>" +
                            "</div>" +
                            "<div class='form-group'>" +
                                "<label for='proprietario'>Proprietário</label>" +
                                "<div id='proprietarios'>" +
                                    getProprietarios(false) +
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
                                "<input type='number' name='qtdQuartos' id='inputQtdQuartos' placeholder='Digite o Número de Quartos' class='form-control'>" +
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
                                "<input type='number' name='area' id='inputArea' placeholder='Digite a Área (m²)' class='form-control'>" +
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
                            "</div>" +
                            "<div class='form-group'>" +
                                "<label for='andar'>Andar</label>" +
                                "<input type='number' name='andar' id='inputAndar' placeholder='Digite o Andar' class='form-control'>" +
                            "</div>" +
                            "<div class='form-group'>" +
                                "<label for='valorCondominio'>Valor Condomínio</label>" +
                                "<input type='number' name='valorCondominio' id='inputValorCondominio' placeholder='Digite o Valor do condominio' class='form-control'>" +
                            "</div>" +
                            "<div class='form-group'>" +
                                "<label for='portaria24horas'>Possui Portaria 24 Horas</label>" +
                                "<select class='form-control' name='portaria24horas' id='inputPortaria24horas'>" +
                                    "<option value='0' selected>Selecione um</option>" +
                                    "<option value='1'>Sim</option>" +
                                    "<option value='2'>Não</option>" +
                                "</select>" +
                            "</div>" +
                            "<div id='dadosTransacao'></div>" +
                            "<div class='text-center'>" +
                                "<button type='button' class='btn btn-primary'>Cadastrar</button>" +
                            "</div>");
    } else {
        $("#campos").empty();
    }

    $("#inputTipoTransacao").change(function() {
        if ($(this).val() === "1") {
            $("#dadosTransacao").empty();
            $("#dadosTransacao").append("<div class='form-group'>" +
                                            "<label for='valorVenda'>Valor de Venda</label>" +
                                            "<input type='number' name='valorVenda' id='inputValorVenda' placeholder='Digite o Valor de Venda' class='form-control'>" +
                                        "</div>" +
                                        "<div class='form-group'>" +
                                            "<label for='porcentagemImobiliaria'>Porcentagem da Imobiliaria</label>" +
                                            "<input type='number' name='porcentagemImobiliaria' id='inputPorcentagemImobiliaria' placeholder='Digite a Porcentagem da Imobiliaria' class='form-control'>" +
                                        "</div>");
        } else if ($(this).val() === "2") {
            $("#dadosTransacao").empty();
            $("#dadosTransacao").append("<div class='form-group'>" +
                                            "<label for='valorAluguel'>Valor de Aluguel</label>" +
                                            "<input type='number' name='valorAluguel' id='inputValorAluguel' placeholder='Digite o Valor de Aluguel' class='form-control'>" +
                                        "</div>" +
                                        "<div class='form-group'>" +
                                            "<label for='porcentagemImobiliaria'>Porcentagem da Imobiliaria</label>" +
                                            "<input type='number' name='porcentagemImobiliaria' id='inputPorcentagemImobiliaria' placeholder='Digite a Porcentagem da Imobiliaria' class='form-control'>" +
                                        "</div>");
        } else {
            $("#dadosTransacao").empty();
        }
    });

    $("#adicionarProprietario").on('click', function() {
        $("#proprietarios").append(getProprietarios(true));

        $(".removivel").change(function() {
            if ($(this).val() === "0") {
                $(this).remove();
            }
        });
    });
});

function getProprietarios(removivel) {
    var selectPropietarios = "";

    if (removivel) {
        selectPropietarios = ("<select class='form-control removivel mt-2' name='proprietario' id='inputProprietario'>" +
                                  "<option value='0' selected>Selecione um</option>");
    } else {
        selectPropietarios = ("<select class='form-control' name='proprietario' id='inputProprietario'>" +
                                      "<option value='0' selected>Selecione um</option>");
    }

    clientes.forEach(function(cliente) {
        selectPropietarios += "<option value='" + cliente.id + "'>" + cliente.nome + "</option>"
    });

    selectPropietarios += "</select>";

    return selectPropietarios;
}