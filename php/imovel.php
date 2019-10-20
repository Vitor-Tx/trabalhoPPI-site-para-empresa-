<?php 

    class Imovel {
        public $id;
        public $rua;
        public $numero;
        public $bairro;
        public $cidade;
        public $estado;
        public $tipoTransacao;
        public $quantidadeQuartos;
        public $quantidadeSuites;
        public $quantidadeSalaEstar;
        public $quantidadeSalaJantar;
        public $quantidadeVagaGaragem;
        public $area;
        public $armarioEmbutido;
        public $descricao;
        public $andar;
        public $valorCondominio;
        public $portaria24Horas;
        public $valorVenda;
        public $valorAluguel;
        public $porcentagemImobiliaria;
        public $tipoImovel;
    }

    function getImoveis($conn) {
        $array_imoveis = null;

        $sql = "SELECT 
                    i.ID,
                    i.Rua,
                    i.Numero,
                    i.Bairro,
                    i.Cidade,
                    i.Estado,
                    i.TipoTransacao,
                    i.QuantidadeQuartos,
                    i.QuantidadeSuites,
                    i.QuantidadeSalaEstar,
                    i.QuantidadeSalaJantar,
                    i.QuantidadeVagasGaragem,
                    i.Area,
                    i.ArmarioEmbutido,
                    i.Descricao,
                    i.Andar,
                    i.ValorCondominio,
                    i.Portaria24Horas,
                    i.ValorVenda,
                    i.ValorAluguel,
                    i.PorcentagemImobiliaria,
                    ti.Nome as TipoImovel 
                FROM 
                    imovel as i, 
                    tipoImovel as ti
                WHERE
                    i.TipoImovel = ti.ID";

        $result = $conn->query($sql);
        if (! $result)
            throw new Exception('Erro ao coletar as informações dos imóveis: ' . $conn->error);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imovel = new Imovel();

                $imovel->id                     = $row["ID"];
                $imovel->rua                    = $row["Rua"];
                $imovel->numero                 = $row["Numero"];
                $imovel->bairro                 = $row["Bairro"];
                $imovel->cidade                 = $row["Cidade"];
                $imovel->estado                 = $row["Estado"];
                if ($row["TipoTransacao"] == 1) {
                    $imovel->tipoTransacao      = "Venda";
                } else if ($row["TipoTransacao"] == 2) {
                    $imovel->tipoTransacao      = "Aluguel";
                }
                $imovel->quantidadeQuartos      = $row["QuantidadeQuartos"];
                $imovel->quantidadeSuites       = $row["QuantidadeSuites"];
                $imovel->quantidadeSalaEstar    = $row["QuantidadeSalaEstar"];
                $imovel->quantidadeSalaJantar   = $row["QuantidadeSalaJantar"];
                $imovel->quantidadeVagasGaragem = $row["QuantidadeVagasGaragem"];
                $imovel->area                   = $row["Area"];
                if ($row["ArmarioEmbutido"] == 1) {
                    $imovel->armarioEmbutido    = "Sim";
                } else if ($row["ArmarioEmbutido"] == 2) {
                    $imovel->armarioEmbutido    = "Não";
                }
                $imovel->descricao              = $row["Descricao"];
                $imovel->andar                  = $row["Andar"];
                $imovel->valorCondominio        = $row["ValorCondominio"];
                if ($row["Portaria24Horas"] == 1) {
                    $imovel->portaria24Horas    = "Sim";
                } else if ($row["Portaria24Horas"] == 2) {
                    $imovel->portaria24Horas    = "Não";
                }
                $imovel->valorVenda             = $row["ValorVenda"];
                $imovel->valorAluguel           = $row["ValorAluguel"];
                $imovel->porcentagemImobiliaria = $row["PorcentagemImobiliaria"];
                $imovel->tipoImovel             = $row["TipoImovel"];

                $array_imoveis[] = $imovel;
            }
        }

        return $array_imoveis;
    }

?>