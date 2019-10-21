<?php 

    class Interesse {
        public $nome;
        public $endereco;
        public $telefone;
        public $email;
        public $proposta;
    }

    function getInteresses($conn) {
        $array_interesses = null;

        $sql = "SELECT
                    ti.Nome as TipoImovel,
                    i.Rua,
                    i.Numero,
                    i.Bairro,
                    i.Cidade,
                    i.Estado,
                    it.NomeCliente,
                    it.TelefoneCliente,
                    it.EmailCliente,
                    it.Proposta
                FROM
                    imovel as i,
                    interesse as it,
                    tipoImovel as ti
                WHERE
                    it.ImovelID = i.ID AND
                    i.TipoImovel = ti.ID
                ";

        try {
            $result = $conn->query($sql);
        } catch (Exception $e) {
            echo 'Ocorreu uma falha ao buscar os interesses: ';
            var_dump($e->getMessage());
        }

        while ($row = $result->fetch()) {
            $interesse = new Interesse();

            $interesse->nome        = $row["NomeCliente"];
            $interesse->endereco    = $row["TipoImovel"] . ", Rua " . $row["Rua"] . " " . $row["Numero"] .
                                      ", Bairro " . $row["Bairro"] . ", " . $row["Cidade"] . " - " .
                                      $row["Estado"];
            $interesse->telefone    = $row["TelefoneCliente"];
            $interesse->email       = $row["EmailCliente"];
            $interesse->proposta    = $row["Proposta"];
            
            $array_interesses[]     = $interesse;
        }

        return $array_interesses;
    }

?>