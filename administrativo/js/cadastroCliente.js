window.onload = function() {
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
        var aux;

        if (e.keyCode == 8 && this.value.length == 14) {
            $(this).mask('(00) 0000-0000');
        }
    });
}

$("#adicionarTelefone").on('click', function () {
    $("#numeros").append("<input type='text' name='telefone' placeholder='Digite o Telefone' class='form-control inputField phoneField aditionalNumber mt-2'>");
    setLimpaCampo();

    $(".phoneField").last().mask('(00) 0000-0000');

    $(".phoneField").on('keydown', function(e) {
        var aux;

        if (this.value.length == 14) {
            $(this).mask('(00) 00000-0000');
        } else if (e.keyCode == 8 && this.value.length == 15) {
            aux = $(this).val();
            $(this).mask('(00) 0000-0000');
            $(this).val(aux);
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
    var inputEndereco = $("#inputEndereco").val();
    var inputTelefone = $("#inputTelefone").val();
    var inputEmail = $("#inputEmail").val();
    var inputEstadoCivil = $("#inputEstadoCivil").val();
    var inputProfissao = $("#inputProfissao").val();
    var inputSexo = false;
    var radioSexo = document.getElementsByName("sexo");

    for (var x = 0; x < radioSexo.length; x++) {
        if (radioSexo[x].checked == true) {
            inputSexo = true;
        }
    }

    if (inputNome == "" || inputNome == null || inputNome == undefined) {
        alert("Campo nome não preenchido!");
    } else if (inputCPF == "" || inputCPF == null || inputCPF == undefined) {
        alert("Campo CPF não preenchido!");
    } else if (inputEndereco == "" || inputEndereco == null || inputEndereco == undefined) {
        alert("Campo Endereço não preenchido!");
    } else if (inputTelefone == "" || inputTelefone == null || inputTelefone == undefined) {
        alert("Campo Telefone não preenchido!");
    } else if (inputSexo == false) {
        alert("Campo Sexo não preenchido!");
    } else if (inputEmail == "" || inputEmail == null || inputEmail == undefined) {
        alert("Campo Email não preenchido!");
    } else if (inputEstadoCivil == "0" || inputEstadoCivil == null || inputEstadoCivil == undefined) {
        alert("Campo Estado Civil não preenchido!");
    } else if (inputProfissao == "" || inputProfissao == null || inputProfissao == undefined) {
        alert("Campo Profissão não preenchido!");
    } else {
        alert("Tudo OK!")
    }
});