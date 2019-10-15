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

        // echo $nome. "\n";
        // echo $cpf. "\n";
        // echo $endereco. "\n";
        // print_r($telefones);
        // echo $email. "\n";
        // echo $sexo. "\n";
        // echo $estadoCivil. "\n";
        // echo $profissao. "\n";

        try {
            $conn = conectaAoMySQL();

            $sql = "
                INSERT INTO cliente (Nome, Cpf, Endereco, Email, Sexo, EstadoCivil, Profissao) 
                VALUES ('$nome', '$cpf', '$endereco', '$email', '$sexo', '$estadoCivil', '$profissao')
            ";

            if (! $conn->query($sql))
                throw new Exception("Falha na inserção dos dados: " . $conn->error);
                
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

?>