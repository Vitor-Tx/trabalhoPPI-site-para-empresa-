$(document).ready(function() {
    $("#inputCPF").mask('000.000.000-00');

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

    $(".valor").mask("###0.00 R$", {reverse: true});

    $(".valor").on('keyup', function() {
        if (this.value.trim() == "R$") {
            this.value = "";
        }
    });

    $("#inputCEP").mask('00000-000');

    $("#inputCEP").on("keyup", function() {
        var val = $(this).val();

        if (val.length == 9) {
            $.ajax({
                method: "POST",
                url: "../php/buscaDadosCEP.php",
                data:
                {
                    cep: val
                },
                success: function(result)
                {
                    if (!result.includes("Erro")) {
                        console.log(typeof result);
                        var dados = JSON.parse(result);

                        console.log(dados);

                        $("#inputLogradouro").val(dados[0].Logradouro);
                        $("#inputBairro").val(dados[0].Bairro);
                        $("#inputCidade").val(dados[0].Cidade);
                        $("#inputEstado").val(dados[0].Estado);
                    } else {
                        alert(result);
                    }

                    $("#inputLogradouro").removeAttr("disabled");
                    $("#inputBairro").removeAttr("disabled");
                    $("#inputCidade").removeAttr("disabled");
                    $("#inputEstado").removeAttr("disabled");
                    $("#inputNumero").removeAttr("disabled");
                }
            });

            $(this).blur();
        }
    });
});

$("#btnCadastrar").on('click', function() {
    var inputNome = $("#inputNome").val();
    var inputTelefone = $("#inputTelefone").val();
    var inputCPF = $("#inputCPF").val();
    var inputEndereco = $("#inputEndereco").val();
    var inputTelefoneContato = $("#inputTelefoneContato").val();
    var inputTelefoneCelular = $("#inputTelefoneCelular").val();
    var inputCargo = $("#inputCargo").val();
    var inputSalario = $("#inputSalario").val();
    var inputLogin = $("#inputLogin").val();
    var inputSenha = $("#inputSenha").val();

    if (inputNome == "" || inputNome == null || inputNome == undefined) {
        alert("Campo Nome não preenchido!");
    } else if (inputTelefone == "" || inputTelefone == null || inputTelefone == undefined) {
        alert("Campo Telefone não preenchido!");
    } else if (inputCPF == "" || inputCPF == null || inputCPF == undefined) {
        alert("Campo CPF não preenchido!");
    } else if (inputEndereco == "" || inputEndereco == null || inputEndereco == undefined) {
        alert("Campo Endereço não preenchido!");
    } else if (inputTelefoneContato == "" || inputTelefoneContato == null || inputTelefoneContato == undefined) {
        alert("Campo Telefone Contato não preenchido!");
    } else if (inputTelefoneCelular == "" || inputTelefoneCelular == null || inputTelefoneCelular == undefined) {
        alert("Campo Telefone Celular não preenchido!");
    } else if (inputCargo == "" || inputCargo == null || inputCargo == undefined) {
        alert("Campo Cargo não preenchido!");
    } else if (inputSalario == "" || inputSalario == null || inputSalario == undefined) {
        alert("Campo salário não preenchido");
    } else if (inputLogin == "" || inputLogin == null || inputLogin == undefined) {
        alert("Campo Login não preenchido!");
    } else if (inputSenha == "" || inputSenha == null || inputSenha == undefined) {
        alert("Campo Senha não preenchido!");
    } else {
        $.ajax({
            method: "POST",
            url: "../php/cadastraFuncionario.php",
            data:
            {
                nome: inputNome,
                telefone: inputTelefone,
                cpf: inputCPF,
                endereco: inputEndereco,
                telefoneContato: inputTelefoneContato,
                telefoneCelular: inputTelefoneCelular,
                cargo: inputCargo,
                salario: salario,
                login: inputLogin,
                senha: inputSenha,
            },
            success: function(result)
            {
                alert(result);
                window.location.reload();
            }
        });
    }
});