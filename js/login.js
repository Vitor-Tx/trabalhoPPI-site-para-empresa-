window.onload = function() {
    
    window.onkeydown = function (e) {
        if (e.which == 13 && $("#modalLogin").css('display') == "block") {
            $("#btnLogar").trigger("click");
        }
    }
    
    $("#btnLogar").on('click', function() {
        var user = $("#user").val();
        var senha = $("#senha").val();
        var path = $(this).attr("data-path-login");
        var pathRedirect = $(this).attr("data-path-redirect");
    
        if (user == null || user == undefined || user == "") {
            $("#erroLogin").text("Campo usuário não preenchido!");
        } else if (senha == null || senha == undefined || senha == "") {
            $("#erroLogin").text("Campo senha não preenchido!");
        } else {
            $("#erroLogin").text("");
            $.ajax({
                method: "POST",
                url: path,
                data:
                {
                    login: user,
                    senha: senha
                },
                success: function(result)
                {
                    if (result == "Logado com sucesso") {
                        window.location.href = pathRedirect;
                    } else {
                        $("#erroLogin").text(result);
                    }
                }
            });
            //alert("tudo ok");
        }
    });
}
