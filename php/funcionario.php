<?php 

    class Funcionario {
        public $nome;
        public $cargo;
        public $cpf;
        public $endereco;
        public $telefone;
        public $telefoneContato;
        public $telefoneCelular;
        public $dataIngresso;
        public $salarioBase;
        public $comissao;
        public $salario;
        public $login;
    }

    function getfuncionarios($conn) {
        $array_funcionarios = null;

        $sql = "SELECT 
                    f.Nome,
                    c.Nome as Cargo,
                    f.Cpf,
                    f.Endereco,
                    f.Telefone,
                    f.TelefoneContato,
                    f.TelefoneCelular,
                    f.DataIngresso,
                    f.Salario as SalarioBase,
                    f.Comissao,
                    f.Login
                FROM
                    funcionario as f,
                    cargo as c
                WHERE
                    f.Cargo = c.ID";

        $result = $conn->query($sql);
        if ($result == false)
            throw new Exception('Ocorreu uma falha ao buscar os funcionários de funcionarios: ' . $conn->error);
    
        while ($row = $result->fetch()) {
            $funcionario = new Funcionario();
            
            $funcionario->nome            = $row["Nome"];
            $funcionario->cargo           = $row["Cargo"];
            $funcionario->cpf             = $row["Cpf"];
            $funcionario->endereco        = $row["Endereco"];
            $funcionario->telefone        = $row["Telefone"];
            $funcionario->telefoneContato = $row["TelefoneContato"];
            $funcionario->telefoneCelular = $row["TelefoneCelular"];
            $funcionario->dataIngresso    = $row["DataIngresso"];
            $funcionario->salarioBase     = $row["SalarioBase"];
            $funcionario->comissao        = $row["Comissao"];
            $funcionario->salario         = $row["SalarioBase"] + $row["Comissao"];
            $funcionario->login           = $row["Login"];

            $array_funcionarios[] = $funcionario;
        }

        return $array_funcionarios;
    }

?>