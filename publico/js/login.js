$("#login").on('submit', function() {
    var user = $("#user").val();
    var senha = $("#senha").val();

    if (user == null || user == undefined || user == "") {
        alert("Campo usuário não preenchido!");
        return false;
    } else if (senha == null || senha == undefined || senha == "") {
        alert("Campo senha não preenchido!");
        return false
    } else {
        alert("tudo ok");
        return false;
    }
});