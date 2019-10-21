<?php 

    require "conexaoMysql.php";

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
            $conn->beginTransaction();

            $sql = "INSERT INTO cliente (
                        Nome, 
                        Cpf, 
                        Endereco, 
                        Email, 
                        Sexo, 
                        EstadoCivil, 
                        Profissao
                    ) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            try {
                $st = $conn->prepare($sql);
                $st->execute(
                    [
                        $nome,
                        $cpf,
                        $endereco,
                        $email,
                        $sexo,
                        $estadoCivil,
                        $profissao
                    ]
                );
            } catch (Exception $e) {
                $conn->rollback();
                throw $e;
            }
                
            $sql = "SELECT @id := MAX(ID) FROM cliente";

            if (! $conn->query($sql))
                throw new Exception("Falha ao recuperar o ID: " . $conn->error);

            $sql = "INSERT INTO telefone (PessoaID, TipoPessoa, Numero) VALUES (@id, 1, ?);";

            try {
                $st = $conn->prepare($sql);

                foreach ($telefones as $telefone) {
                    $st->execute([$telefone]);
                }

                $conn->commit();

                echo "Cliente cadastrado com sucesso";
            } catch (Exception $e) {
                $conn->rollback();
                throw $e;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    $conn = null;

?>