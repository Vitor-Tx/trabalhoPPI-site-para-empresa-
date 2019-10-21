$("#btnEnviarInteresse").on('click', function() {
    var nome = $("#nome").val();
    var email = $("#email").val();
    var telefone = $("#telefone").val();
    var descricaoProposta = $("#descricaoProposta").val();

    if (nome == null || nome == undefined || nome == "") {
        $("#erro").text("Campo Nome não preenchido!");
    } else if (email == null || email == undefined || email == "") {
        $("#erro").text("Campo Email não preenchido!");
    } else if (telefone == null || telefone == undefined || telefone == "") {
        $("#erro").text("Campo Telefone não preenchido!");
    } else if (descricaoProposta == null || descricaoProposta == undefined || descricaoProposta == "") {
        $("#erro").text("Campo Descrição não preenchido!");
    } else {
        $.ajax({
            method: "POST",
            url: "../php/cadastraInteresse.php",
            data:
            {
                imovelID: localStorage.getItem('imovelSelecionado'),
                nome: nome,
                email: email,
                telefone: telefone,
                proposta: descricaoProposta
            },
            success: function(result)
            {
                alert(result);
                //window.location.reload();
            }
        });
    }
});

$(".btn-interesse").on('click', function() {
    localStorage.setItem('imovelSelecionado', $(this).attr('data-imovel-id'));
});

window.onload = function() {
    localStorage.setItem('imovelSelecionado', '');

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
}