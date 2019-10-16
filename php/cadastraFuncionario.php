<?php 

    require "conexaoMysql.php";

    // Valida uma string removendo alguns caracteres
    // especiais que poderiam ser provenientes
    // de ataques do tipo HTML/CSS/JavaScript Injection
    function filtraEntrada($dado) 
    {
        $dado = trim($dado);               // remove espaços no inicio e no final da string
        $dado = stripslashes($dado);       // remove contra barras: "cobra d\'agua" vira "cobra d'agua"
        $dado = htmlspecialchars($dado);   // caracteres especiais do HTML (como < e >) são codificados

        return $dado;
    }

    function generateSalt() {
        $salt = "";
        $c = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        for ($x = 0; $x < 22; $x++) {
            $r = rand(0, 61);
            $salt = $salt . $c[$r];
        }

        return $salt;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome            = filtraEntrada($_POST["nome"]);
        $telefone        = filtraEntrada($_POST["telefone"]);
        $cpf             = filtraEntrada($_POST["cpf"]);
        $endereco        = filtraEntrada($_POST["endereco"]);
        $telefoneContato = filtraEntrada($_POST["telefoneContato"]);
        $telefoneCelular = filtraEntrada($_POST["telefoneCelular"]);
        $cargo           = filtraEntrada($_POST["cargo"]);
        $login           = filtraEntrada($_POST["login"]);
        $senha           = filtraEntrada($_POST["senha"]);

        $custo = '04';
        $salt = generateSalt();

        $hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');

        try {
            $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

            $sql = "INSERT INTO funcionario
                    (
                        Nome, 
                        Telefone, 
                        Cpf, 
                        Endereco, 
                        TelefoneContato, 
                        TelefoneCelular,
                        DataIngresso,
                        Cargo,
                        Comissao,
                        Login,
                        Senha,
                        Salt
                    )
                    VALUES 
                    (
                        '$nome',
                        '$telefone',
                        '$cpf',
                        '$endereco',
                        '$telefoneContato',
                        '$telefoneCelular',
                        NOW(),
                        '$cargo',
                        0.0,
                        '$login',
                        '$hash',
                        '$salt'
                    )";

            if (! $conn->query($sql))
                throw new Exception("Falha na inserção dos dados: " . $conn->error);

            $conn->commit();

            echo "Funcionário cadastrado com sucesso";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    $conn->close();

?>