<?php 

    require "conexaoMysql.php";

    function filtraEntrada($dado) {
        $dado = trim($dado);
        $dado = stripslashes($dado);
        $dado = htmlspecialchars($dado);

        return $dado;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $login = filtraEntrada($_POST["login"]);     
        $senha = filtraEntrada($_POST["senha"]);
        $custo = '04';
        $salt = "";

        try {

            $sql = "SELECT Salt, Senha FROM funcionario WHERE Login = ?";

            $st = $conn->prepare($sql);
            $st->execute([$login]);
                
            if ($st->rowCount() > 0) {
                $row = $st->fetch();
                $salt = $row["Salt"];

                $hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');

                if ($hash == $row["Senha"]) {

                    session_start();

                    setcookie('sessionID', session_id(), time() + 864000, '/');

                    echo "Logado com sucesso";
                } else {
                    echo "Login inválido";
                }
            } else {
                echo "Login inválido!";
            }

        } catch (Exception $e) {
            $msgErro = $e->getMessage();
        }

        $conn = null;
    }

?>