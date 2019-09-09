$("#inputTipoImovel").change(function() {
    if ($(this).val() === '1') {
        $("#campos").empty();
        $("#campos").append("<div class='form-group'>" +
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
                            "<div class='text-center'>" +
                                "<button type='button' class='btn btn-primary'>Cadastrar</button>" +
                            "</div>");
    } else if ($(this).val() === '2') {
        $("#campos").empty();
        $("#campos").append("<div class='form-group'>" +
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
                            "<div class='text-center'>" +
                                "<button type='button' class='btn btn-primary'>Cadastrar</button>" +
                            "</div>");
    } else {
        $("#campos").empty();
    }
});