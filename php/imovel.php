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
        public $numeroApartamento;
        public $piscina;
        public $valor;
        public $porcentagemImobiliaria;
        public $tipoImovel;
        public $valorReal;
        public $dataInicio;
        public $dataFim;
        public $vendido_alugado;
        public $funcionarioResponsavel;
    }

    function getImoveis($conn) {
        $array_imoveis = null;

        $sql = "SELECT DISTINCT
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
                    CASE
                        WHEN i.TipoImovel = 2 THEN a.Andar
                        ELSE null
                    END as Andar,
                    CASE
                        WHEN i.TipoImovel = 2 THEN a.ValorCondominio
                        ELSE null
                    END as ValorCondominio,
                    CASE
                        WHEN i.TipoImovel = 2 THEN a.Portaria24Horas
                        ELSE null
                    END as Portaria24Horas,
                    CASE
                        WHEN i.TipoImovel = 2 THEN a.NumeroApartamento
                        ELSE null
                    END as NumeroApartamento,
                    CASE
                        WHEN i.TipoImovel = 1 THEN c.Piscina
                        ELSE null
                    END as Piscina,
                    i.Valor,
                    i.PorcentagemImobiliaria,
                    ti.Nome as TipoImovel,
                    i.ValorReal,
                    i.DataInicio,
                    i.DataFim,
                    i.Vendido_Alugado,
                    f.Nome as FuncionarioResponsavel
                FROM 
                    imovel as i,
                    tipoImovel as ti,
                    funcionario as f,
                    casa as c,
                    apartamento as a
                WHERE
                    i.TipoImovel = ti.ID AND
                    i.FuncionarioResponsavel = f.ID AND
                    i.ID = CASE WHEN i.TipoImovel = 1 THEN c.ID ELSE a.ID END";

        $result = $conn->query($sql);
        if ($result == false)
            throw new Exception('Erro ao coletar as informações dos imóveis: ' . $conn->error);

        while ($row = $result->fetch()) {
            $imovel = new Imovel();

            $imovel->id                     = $row["ID"];
            if (trim(strtolower(substr($row["Rua"], 0, 4))) == "rua" && trim(strtolower($row["Rua"])) != "rua") {
                $imovel->rua                = substr($row["Rua"], 4, strlen($row["Rua"]) - 4);    
            } else {
                $imovel->rua                = $row["Rua"];
            }
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
            $imovel->numeroApartamento      = $row["NumeroApartamento"];
            $imovel->valorCondominio        = $row["ValorCondominio"];
            if ($row["Portaria24Horas"] == 1) {
                $imovel->portaria24Horas    = "Sim";
            } else if ($row["Portaria24Horas"] == 2) {
                $imovel->portaria24Horas    = "Não";
            }
            if ($row["Piscina"] == 1) {
                $imovel->piscina            = "Sim";
            } else if ($row["Piscina"] == 2) {
                $imovel->piscina            = "Não";
            }
            $imovel->valor                  = $row["Valor"];
            $imovel->porcentagemImobiliaria = $row["PorcentagemImobiliaria"];
            $imovel->tipoImovel             = $row["TipoImovel"];
            if ($row["ValorReal"] == null && $imovel->tipoTransacao == "Venda") {
                $imovel->valorReal          = "Não foi vendido ainda";
            } else if ($row["ValorReal"] == null && $imovel->tipoTransacao == "Aluguel") {
                $imovel->valorReal          = "Não foi alugado ainda";
            } else {
                $imovel->valorReal          = $row["ValorReal"];
            }
            $imovel->dataInicio             = $row["DataInicio"];
            if ($row["DataFim"] == null && $imovel->tipoTransacao == "Venda") {
                $imovel->dataFim            = "Não foi vendido ainda";
            } else if ($row["DataFim"] == null && $imovel->tipoTransacao == "Aluguel") {
                $imovel->dataFim            = "Não foi alugado ainda";
            } else {
                $imovel->dataFim            = $row["DataFim"];
            }
            if ($row["Vendido_Alugado"] == 0) {
                $imovel->vendido_alugado    = "Não"; 
            } else if ($row["Vendido_Alugado"] == 1) {
                $imovel->vendido_alugado    = "Sim"; 
            }
            $imovel->funcionarioResponsavel = $row["FuncionarioResponsavel"];

            $array_imoveis[] = $imovel;
        }

        return $array_imoveis;
    }

?>