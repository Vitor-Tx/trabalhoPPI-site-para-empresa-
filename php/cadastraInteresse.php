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
        $imovel_id  = filtraEntrada($_POST["imovelID"]);
        $nome       = filtraEntrada($_POST["nome"]);
        $email      = filtraEntrada($_POST["email"]);
        $telefone   = filtraEntrada($_POST["telefone"]);
        $proposta   = filtraEntrada($_POST["proposta"]);

        try {
            $conn->beginTransaction();

            $sql = "INSERT INTO interesse (
                ImovelID, 
                NomeCliente, 
                TelefoneCliente, 
                EmailCliente, 
                Proposta
            ) 
            VALUES (?, ?, ?, ?, ?)";

            try {
                $st = $conn->prepare($sql);
                $st->execute(
                    [
                        $imovel_id,
                        $nome,
                        $telefone,
                        $email,
                        $proposta
                    ]
                );
            } catch (Exception $e) {
                $conn->rollback();
                throw $e;
            }

            echo "Obrigado por entrar em contato!";
            $conn->commit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    $conn = null;

?>