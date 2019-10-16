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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $msgErro = "";
        
        $nome        =   filtraEntrada($_POST["nome"]);
        $cpf         =   filtraEntrada($_POST["cpf"]);
        $endereco    =   filtraEntrada($_POST["endereco"]);
        $telefones   =   $_POST["telefones"];
        $email       =   filtraEntrada($_POST["email"]);
        $sexo        =   filtraEntrada($_POST["sexo"]);
        $estadoCivil =   filtraEntrada($_POST["estadoCivil"]);
        $profissao   =   filtraEntrada($_POST["profissao"]);

        for ($x = 0; $x < count($telefones); $x++) {
            $telefones[$x] = filtraEntrada($telefones[$x]);
        }

        try {
            $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

            $sql = "
                INSERT INTO cliente (Nome, Cpf, Endereco, Email, Sexo, EstadoCivil, Profissao) 
                VALUES ('$nome', '$cpf', '$endereco', '$email', '$sexo', '$estadoCivil', '$profissao')
            ";

            if (! $conn->query($sql))
                throw new Exception("Falha na inserção dos dados: " . $conn->error);
                
            $sql = "SELECT @id := LAST_INSERT_ID();";

            if (! $conn->query($sql))
                throw new Exception("Falha na inserção dos dados: " . $conn->error);

            for ($y = 0; $y < count($telefones); $y++) {
                $sql = "INSERT INTO telefone (PessoaID, TipoPessoa, Numero) VALUES (@id, 1, '$telefones[$y]');";

                if (! $conn->query($sql))
                    throw new Exception("Falha na inserção dos dados: " . $conn->error);
            }

            $conn->commit();

            echo "Cliente cadastrado com sucesso";

        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

?>