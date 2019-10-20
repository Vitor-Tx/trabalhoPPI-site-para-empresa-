<?php 

    class Cliente {
        public $id;
        public $nome;
        public $cpf;
        public $endereco;
        public $email;
        public $sexo;
        public $estadoCivil;
        public $profissao;
    }

    function getClientes($conn) {
        $array_clientes = null;

        $sql = "SELECT 
                    c.ID, 
                    c.Nome,
                    c.Cpf,
                    c.Endereco,
                    c.Email,
                    c.Sexo,
                    e.Nome as EstadoCivil,
                    c.Profissao
                FROM
                    cliente as c,
                    estadoCivil as e
                WHERE
                    c.EstadoCivil = e.ID";

        $result = $conn->query($sql);
        if ($result == false)
            throw new Exception('Ocorreu uma falha ao buscar os clientes: ' . $conn->error);
    
        while ($row = $result->fetch()) {
            $cliente = new Cliente();
            
            $cliente->id            = $row["ID"];
            $cliente->nome          = $row["Nome"];
            $cliente->cpf           = $row["Cpf"];
            $cliente->endereco      = $row["Endereco"];
            $cliente->email         = $row["Email"];
            if ($row["Sexo"] == "m")
                $cliente->sexo      = "Masculino";
            if ($row["Sexo"] == "f")
                $cliente->sexo      = "Feminino";
            if ($row["Sexo"] == "o")
                $cliente->sexo      = "Outro";
            $cliente->estadoCivil   = $row["EstadoCivil"];
            $cliente->profissao     = $row["Profissao"];

            $array_clientes[] = $cliente;
        }

        return $array_clientes;
    }

?>