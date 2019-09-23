window.onload = function() {
    $("#inputCPF").mask('000.000.000-00');

    $(".phoneField").mask('(00) 0000-0000');

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
}

$("#btnCadastrar").on('click', function() {
    var inputNome = $("#inputNome").val();
    var inputTelefone = $("#inputTelefone").val();
    var inputCPF = $("#inputCPF").val();
    var inputEndereco = $("#inputEndereco").val();
    var inputTelefoneContato = $("#inputTelefoneContato").val();
    var inputTelefoneCelular = $("#inputTelefoneCelular").val();
    var inputCargo = $("#inputCargo").val();
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
    } else if (inputLogin == "" || inputLogin == null || inputLogin == undefined) {
        alert("Campo Login não preenchido!");
    } else if (inputSenha == "" || inputSenha == null || inputSenha == undefined) {
        alert("Campo Senha não preenchido!");
    } else {
        alert("Tudo OK!");
    }
});