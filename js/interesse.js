$("#interesse").on('submit', function() {
    var nome = $("#nome").val();
    var email = $("#email").val();
    var telefone = $("#telefone").val();
    var descricaoProposta = $("#descricaoProposta").val();

    if (nome == null || nome == undefined || nome == "") {
        alert("Campo Nome não preenchido!");
        return false;
    } else if (email == null || email == undefined || email == "") {
        alert("Campo Senha não preenchido!");
        return false
    } else if (telefone == null || telefone == undefined || telefone == "") {
        alert("Campo Telefone não preenchido!");
        return false
    } else if (descricaoProposta == null || descricaoProposta == undefined || descricaoProposta == "") {
        alert("Campo descrição não preenchido!");
        return false
    } else {
        alert("tudo ok");
        return false;
    }
});

window.onload = function() {
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