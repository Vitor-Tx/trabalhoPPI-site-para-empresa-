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