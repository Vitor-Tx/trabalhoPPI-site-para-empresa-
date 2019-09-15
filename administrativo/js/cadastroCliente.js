$("#adicionarTelefone").on('click', function () {
    $("#numeros").append("<input type='number' name='telefone' placeholder='Digite o Telefone' class='form-control inputField phoneField aditionalNumber mt-2'>");
    setLimpaCampo();
});

function setLimpaCampo() {
    $(".aditionalNumber").keyup(function(event) {
        if (this.value == "" && event.which == 8) {
            $(this).remove();
        }
    });
}