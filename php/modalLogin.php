<!-- Modal Login -->
<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModal">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="user">Usuário:</label>
                        <input type="text" class="form-control" id="user" name="user">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" class="form-control" id="senha" name="senha">
                    </div>
                    <div class="form-group">
                        <label id="erroLogin" class="text-danger"></label>
                    </div>
                    <div class="text-center">
                        <button 
                        type="button" 
                        class="btn cor-btn" 
                        id="btnLogar"
                        data-path-login="php/login.php"
                        data-path-redirect="administrativo/">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>