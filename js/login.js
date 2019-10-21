$("#btnLogar").on('click', function() {
    var user = $("#user").val();
    var senha = $("#senha").val();

    if (user == null || user == undefined || user == "") {
        $("#erro").text("Campo usuário não preenchido!");
    } else if (senha == null || senha == undefined || senha == "") {
        $("#erro").text("Campo senha não preenchido!");
    } else {
        $("#erro").text("");
        $.ajax({
            method: "POST",
            url: "php/login.php",
            data:
            {
                login: user,
                senha: senha
            },
            success: function(result)
            {
                if (result == "Logado com sucesso") {
                    window.location.href = "administrativo/"
                } else {
                    $("#erro").text(result);
                }
            }
        });
        //alert("tudo ok");
    }
});