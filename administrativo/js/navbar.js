window.onload = function() {
    var pagina = document.getElementsByTagName("title")[0].innerText;

    if (pagina == "Cadastro de Clientes") {
        $("#cadastrarCliente").removeAttr("href");
        $("#cadastrarCliente").css("color", "#000");
        $("#cadastrarCliente").hover(function() {
            $(this).css("color", "#000");
        });
    } else if (pagina == "Cadastro de Funcionário") {
        $("#cadastrarFuncionario").removeAttr("href");
        $("#cadastrarFuncionario").css("color", "#000");
        $("#cadastrarFuncionario").hover(function() {
            $(this).css("color", "#000");
        });
    } else if (pagina == "Cadastro de Imóveis") {
        $("#cadastrarImovel").removeAttr("href");
        $("#cadastrarImovel").css("color", "#000");
        $("#cadastrarImovel").hover(function() {
            $(this).css("color", "#000");
        });
    } else if (pagina == "Listagem de Funcionários") {
        $("#listarFuncionarios").removeAttr("href");
        $("#listarFuncionarios").css("color", "#000");
        $("#listarFuncionarios").hover(function() {
            $(this).css("color", "#000");
        });
    } else if (pagina == "Listagem de Clientes") {
        $("#listarClientes").removeAttr("href");
        $("#listarClientes").css("color", "#000");
        $("#listarClientes").hover(function() {
            $(this).css("color", "#000");
        });
    } else if (pagina == "Listagem de Imóveis") {
        $("#listarImoveis").removeAttr("href");
        $("#listarImoveis").css("color", "#000");
        $("#listarImoveis").hover(function() {
            $(this).css("color", "#000");
        });
    } else if (pagina == "Listagem de Interesses") {
        $("#listarInteresses").removeAttr("href");
        $("#listarInteresses").css("color", "#000");
        $("#listarInteresses").hover(function() {
            $(this).css("color", "#000");
        });
    }
}