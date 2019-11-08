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

$("#inputCEP").mask('00000-000');

$("#adicionarTelefone").on('click', function () {
    $("#numeros").append("<input type='text' name='telefone' placeholder='Digite o Telefone' class='form-control inputField phoneField aditionalNumber mt-2'>");
    setLimpaCampo();

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
        var aux;

        if (e.keyCode == 8 && this.value.length == 14) {
            $(this).mask('(00) 0000-0000');
        }
    });
});

function setLimpaCampo() {
    $(".aditionalNumber").keyup(function(event) {
        if (this.value == "" && event.which == 8) {
            $(this).remove();
        }
    });
}

$("#btnCadastrar").on('click', function() {
    var inputNome = $("#inputNome").val();
    var inputCPF = $("#inputCPF").val();
    var inputCEP = $("#inputCEP").val();
    var inputLogradouro = $("#inputLogradouro").val();
    var inputNumero = $("#inputNumero").val();
    var inputBairro = $("#inputBairro").val();
    var inputCidade = $("#inputCidade").val();
    var inputEstado = $("#inputEstado").val();
    var inputTelefone = $("#inputTelefone").val();
    var inputEmail = $("#inputEmail").val();
    var inputEstadoCivil = $("#inputEstadoCivil").val();
    var inputProfissao = $("#inputProfissao").val();
    var inputSexo = false;
    var inputSexoVal = "";
    var radioSexo = document.getElementsByName("sexo");

    for (var x = 0; x < radioSexo.length; x++) {
        if (radioSexo[x].checked == true) {
            inputSexo = true;
            inputSexoVal = radioSexo[x].value;
        }
    }

    var inputTelefones = [];
    var telefones = document.getElementsByName("telefone");

    for (var x = 0; x < telefones.length; x++) {
        if (telefones[x].value != "" && telefones[x].value.length >= 14) {
            inputTelefones.push(telefones[x].value);
        }
    }

    if (inputNome == "" || inputNome == null || inputNome == undefined) {
        alert("Campo nome não preenchido!");
    } else if (inputCPF == "" || inputCPF == null || inputCPF == undefined || inputCPF.length < 14) {
        alert("CPF inválido!");
    } else if (inputCEP == "" || inputCEP == null || inputCEP == undefined || inputCEP.length < 9) {
        alert("CEP inválido!");
    } else if (inputLogradouro == "" || inputLogradouro == null || inputLogradouro == undefined) {
        alert("Campo Logradouro não preenchido!");
    } else if (inputNumero == 0 || inputNumero == null || inputNumero == undefined) {
        alert("Número inválido!");
    } else if (inputBairro == "" || inputBairro == null || inputBairro == undefined) {
        alert("Campo Bairro não preenchido!");
    } else if (inputCidade == "" || inputCidade == null || inputCidade == undefined) {
        alert("Campo Cidade não preenchido!");
    } else if (inputEstado == "" || inputEstado == null || inputEstado == undefined) {
        alert("Campo Estado não preenchido!");
    } else if (inputTelefone == "" || inputTelefone == null || inputTelefone == undefined || inputTelefone.length < 14) {
        alert("Telefone inválido!");
    } else if (inputEmail == "" || inputEmail == null || inputEmail == undefined) {
        alert("Campo Email não preenchido!");
    } else if (inputSexo == false) {
        alert("Campo Sexo não preenchido!");
    } else if (inputEstadoCivil == "0" || inputEstadoCivil == null || inputEstadoCivil == undefined) {
        alert("Campo Estado Civil não preenchido!");
    } else if (inputProfissao == "" || inputProfissao == null || inputProfissao == undefined) {
        alert("Campo Profissão não preenchido!");
    } else {
        if (!inputLogradouro.toLowerCase().includes("rua ") && 
        !inputLogradouro.toLowerCase().includes("avenida ")) {
            inputLogradouro = "Rua " + inputLogradouro;
        }

        if (!inputBairro.toLowerCase().includes("bairro ")) {
            inputBairro = "Bairro " + inputBairro;
        }

        $.ajax({
            method: "POST",
            url: "../php/cadastraCliente.php",
            data:
            {
                nome: inputNome,
                cpf: inputCPF,
                endereco: ( inputLogradouro + " " + 
                            inputNumero + ", " + 
                            inputBairro + ", " + 
                            inputCidade + " - " + 
                            inputEstado),
                telefones: inputTelefones,
                email: inputEmail,
                estadoCivil: inputEstadoCivil,
                profissao: inputProfissao,
                sexo: inputSexoVal,
            },
            success: function(result)
            {
                alert(result);
                window.location.reload();
            }
        });
    }
});

$("#inputCEP").on('keyup', function() {
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
