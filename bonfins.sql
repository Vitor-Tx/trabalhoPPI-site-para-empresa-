-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 30/10/2019 às 03:00
-- Versão do servidor: 10.4.8-MariaDB
-- Versão do PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bonfins`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cargo`
--

CREATE TABLE `cargo` (
  `ID` int(4) UNSIGNED NOT NULL,
  `Nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SalarioBase` float UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `cargo`
--

INSERT INTO `cargo` (`ID`, `Nome`, `SalarioBase`) VALUES
(1, 'Diretor', 3000),
(2, 'Vendedor', 1200),
(3, 'Estagiário', 600);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `ID` int(4) UNSIGNED NOT NULL,
  `Nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Cpf` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `Endereco` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Sexo` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `EstadoCivil` int(1) UNSIGNED NOT NULL,
  `Profissao` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`ID`, `Nome`, `Cpf`, `Endereco`, `Email`, `Sexo`, `EstadoCivil`, `Profissao`) VALUES
(1, 'Maria', '123.456.789-02', 'Rua A, Bairro B, Araguari - MG', 'maria@email.com', 'f', 4, 'Piloto de Caça'),
(2, 'Guilherme Bartasson', '137.682.906-11', 'Rua Guaporé 526, Bairro Santa Rosa', 'guilhermebnj@gmail.com', 'm', 2, 'Programador'),
(3, 'Teste', '123.456.789-05', 'Rua C, Bairro D', 'teste@teste.com', 'f', 1, 'Tester'),
(4, 'Teste2', '123.456.789-03', 'Rua F, Bairro G', 'teste1@teste1.com', 'm', 5, 'Tester'),
(5, 'Carlos Rocha', '234.567.890-67', 'Rua G, Bairro F', 'carlos@gmail.com', 'm', 3, 'Atirador de Elite'),
(6, 'Fernado Silva', '113.216.465-19', 'Rua Sargento Benevides 12, Bairro Centro, Maceió - AL', 'fernando.silva@gmail.com', 'm', 5, 'Caçador de Castores');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estadoCivil`
--

CREATE TABLE `estadoCivil` (
  `ID` int(4) UNSIGNED NOT NULL,
  `Nome` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `estadoCivil`
--

INSERT INTO `estadoCivil` (`ID`, `Nome`) VALUES
(1, 'Casado(a)'),
(2, 'Solteiro(a)'),
(3, 'Divorciado(a)'),
(4, 'Viúvo(a)'),
(5, 'União estável');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `ID` int(4) UNSIGNED NOT NULL,
  `Nome` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Telefone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Cpf` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `Endereco` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `TelefoneContato` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `TelefoneCelular` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `DataIngresso` date NOT NULL,
  `Cargo` int(4) UNSIGNED NOT NULL,
  `Comissao` float UNSIGNED NOT NULL,
  `Login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Senha` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Salt` varchar(22) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `funcionario`
--

INSERT INTO `funcionario` (`ID`, `Nome`, `Telefone`, `Cpf`, `Endereco`, `TelefoneContato`, `TelefoneCelular`, `DataIngresso`, `Cargo`, `Comissao`, `Login`, `Senha`, `Salt`) VALUES
(4, 'Guilherme Bartasson', '(34) 3223-8957', '137.682.906-11', 'Rua Guaporé 526, Bairro Santa Rosa', '(34) 3223-8957', '(34) 99813-4380', '2019-10-16', 1, 0, 'guilherme.bonfins', '$2a$04$s6CTAFW6BhP8Be1UAZuh2.UGnFIbDFl3d6MD2fYbuvFOjSaNt.H9m', 's6CTAFW6BhP8Be1UAZuh2A'),
(5, 'Teste3', '(34) 34567-8907', '123.456.789-56', 'Rua C, Bairro Z Uberlândia MG', '(45) 67890-7890', '(67) 8906-7890', '2019-10-20', 2, 0, 'bonfins_teste3', '$2a$04$w3cJubBPwYnm3dDuY7t1nuGiTWj6WbhuOQuamnVzUchL6jPNJRZ8a', 'w3cJubBPwYnm3dDuY7t1nv'),
(6, 'Teste 4', '(45) 67890-6789', '456.789.067-89', 'Rua A, Bairro B Uberlândia Mg', '(34) 56789-0789', '(56) 78905-6789', '2019-10-20', 3, 0, 'bonfins_teste4', '$2a$04$uz4Fte6UuHPBd5sic6UKlO62Eaz4.FVfCsmgEzAlvnR9yb2tRThXq', 'uz4Fte6UuHPBd5sic6UKlP'),
(8, 'Teste5', '(34) 56789-0678', '234.567.890-67', 'Rua A, Bairro B Uberlândia MG', '(23) 45678-9678', '(56) 7890-7890', '2019-10-20', 1, 0, 'bonfins_teste5', '$2a$04$mRVAq3Lw1UmjZAfDZ0dZu.weHec514ssTZvPBewt4qmejNSQkq73q', 'mRVAq3Lw1UmjZAfDZ0dZuG'),
(9, 'Guilherme Bartasson Naves Junker', '(23) 45678-9456', '345.678.905-67', 'Rua A, Bairro B Uberlândia MG', '(23) 45678-9056', '(67) 8905-6789', '2019-10-21', 1, 0, 'bonfins_guilherme', '$2a$04$GCaL5dPrxqX14VLugXLxjeU.4y6FyumgM01q7S5/4cbNFD.nctrsS', 'GCaL5dPrxqX14VLugXLxjh'),
(10, 'Vitor Manoel Gonçalves Teixeira', '(23) 45678-9045', '456.789.045-67', 'Rua A, Bairro B Uberlândia MG', '(23) 45678-9056', '(56) 78905-6789', '2019-10-21', 1, 0, 'bonfins_vitor', '$2a$04$gk2qGlRyW5PkfScz4SGeKelSH1Gu0rp1fSUdWuuEROkgG51Q3MVwS', 'gk2qGlRyW5PkfScz4SGeKm'),
(11, 'Diego Batistuta Ribeiro de Andrade', '(12) 34567-8903', '345.678.904-56', 'Rua A, Bairro B Uberlândia MG', '(23) 45678-9056', '(56) 78903-4567', '2019-10-21', 1, 0, 'bonfins_diego', '$2a$04$FFva7zFPyGcMNIaBq4z9q.HHeeAeFXS1BZUvFxGCJELTdnOnleUsy', 'FFva7zFPyGcMNIaBq4z9qM');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagem`
--

CREATE TABLE `imagem` (
  `ID` int(4) UNSIGNED NOT NULL,
  `Imagem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ImovelID` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `imovel`
--

CREATE TABLE `imovel` (
  `ID` int(4) UNSIGNED NOT NULL,
  `Rua` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Numero` int(3) UNSIGNED NOT NULL,
  `Bairro` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Cidade` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Estado` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `TipoTransacao` int(4) UNSIGNED NOT NULL,
  `QuantidadeQuartos` int(1) UNSIGNED NOT NULL,
  `QuantidadeSuites` int(1) UNSIGNED NOT NULL,
  `QuantidadeSalaEstar` int(1) UNSIGNED NOT NULL,
  `QuantidadeSalaJantar` int(1) UNSIGNED NOT NULL,
  `QuantidadeVagasGaragem` int(1) UNSIGNED NOT NULL,
  `Area` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ArmarioEmbutido` int(1) UNSIGNED NOT NULL,
  `Descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `Andar` int(1) UNSIGNED DEFAULT NULL,
  `ValorCondominio` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Portaria24Horas` int(1) UNSIGNED DEFAULT NULL,
  `Valor` double UNSIGNED NOT NULL,
  `PorcentagemImobiliaria` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TipoImovel` int(4) UNSIGNED NOT NULL,
  `ValorReal` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DataInicio` date NOT NULL,
  `DataFim` date DEFAULT NULL,
  `Vendido_Alugado` int(1) UNSIGNED NOT NULL,
  `FuncionarioResponsavel` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `interesse`
--

CREATE TABLE `interesse` (
  `ID` int(4) UNSIGNED NOT NULL,
  `ImovelID` int(4) UNSIGNED NOT NULL,
  `NomeCliente` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `TelefoneCliente` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `EmailCliente` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `Proposta` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `proprietario`
--

CREATE TABLE `proprietario` (
  `ID` int(4) UNSIGNED NOT NULL,
  `PessoaID` int(4) UNSIGNED NOT NULL,
  `ImovelID` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `telefone`
--

CREATE TABLE `telefone` (
  `ID` int(4) UNSIGNED NOT NULL,
  `PessoaID` int(4) UNSIGNED NOT NULL,
  `TipoPessoa` int(1) UNSIGNED NOT NULL,
  `Numero` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `telefone`
--

INSERT INTO `telefone` (`ID`, `PessoaID`, `TipoPessoa`, `Numero`) VALUES
(1, 1, 1, '(56) 98738-9475'),
(2, 1, 1, '(03) 98252-0938'),
(3, 1, 1, '(48) 09583-4960'),
(4, 2, 1, '(34) 3223-8957'),
(5, 2, 1, '(34) 99813-4380'),
(6, 3, 1, '(23) 45678-9045'),
(7, 4, 1, '(45) 67890-4567'),
(8, 5, 1, '(34) 56789-0789'),
(9, 5, 1, '(67) 8907-8909'),
(10, 6, 1, '(45) 4545-5445');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipoImovel`
--

CREATE TABLE `tipoImovel` (
  `ID` int(4) UNSIGNED NOT NULL,
  `Nome` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `tipoImovel`
--

INSERT INTO `tipoImovel` (`ID`, `Nome`) VALUES
(2, 'Apartamento'),
(1, 'Casa');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipoPessoa`
--

CREATE TABLE `tipoPessoa` (
  `ID` int(1) UNSIGNED NOT NULL,
  `Nome` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `tipoPessoa`
--

INSERT INTO `tipoPessoa` (`ID`, `Nome`) VALUES
(1, 'Cliente'),
(2, 'Funcionário');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nome` (`Nome`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Cpf` (`Cpf`),
  ADD KEY `fk_estadoCivil` (`EstadoCivil`);

--
-- Índices de tabela `estadoCivil`
--
ALTER TABLE `estadoCivil`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Cpf` (`Cpf`),
  ADD UNIQUE KEY `Login` (`Login`),
  ADD KEY `fk_cargo` (`Cargo`);

--
-- Índices de tabela `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_imovelId` (`ImovelID`);

--
-- Índices de tabela `imovel`
--
ALTER TABLE `imovel`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_tipoImovel` (`TipoImovel`),
  ADD KEY `fk_funcionarioResponsavel` (`FuncionarioResponsavel`);

--
-- Índices de tabela `interesse`
--
ALTER TABLE `interesse`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_imovelId_interesse` (`ImovelID`);

--
-- Índices de tabela `proprietario`
--
ALTER TABLE `proprietario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_pessoa_id` (`PessoaID`),
  ADD KEY `fk_imovel_id` (`ImovelID`);

--
-- Índices de tabela `telefone`
--
ALTER TABLE `telefone`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_tipoPessoa` (`TipoPessoa`),
  ADD KEY `fk_pessoaID` (`PessoaID`);

--
-- Índices de tabela `tipoImovel`
--
ALTER TABLE `tipoImovel`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nome` (`Nome`);

--
-- Índices de tabela `tipoPessoa`
--
ALTER TABLE `tipoPessoa`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `cargo`
--
ALTER TABLE `cargo`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `estadoCivil`
--
ALTER TABLE `estadoCivil`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `imagem`
--
ALTER TABLE `imagem`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `imovel`
--
ALTER TABLE `imovel`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `interesse`
--
ALTER TABLE `interesse`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `proprietario`
--
ALTER TABLE `proprietario`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de tabela `telefone`
--
ALTER TABLE `telefone`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tipoImovel`
--
ALTER TABLE `tipoImovel`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tipoPessoa`
--
ALTER TABLE `tipoPessoa`
  MODIFY `ID` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_estadoCivil` FOREIGN KEY (`EstadoCivil`) REFERENCES `estadoCivil` (`ID`);

--
-- Restrições para tabelas `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_cargo` FOREIGN KEY (`Cargo`) REFERENCES `cargo` (`ID`);

--
-- Restrições para tabelas `imagem`
--
ALTER TABLE `imagem`
  ADD CONSTRAINT `fk_imovelId` FOREIGN KEY (`ImovelID`) REFERENCES `imovel` (`ID`);

--
-- Restrições para tabelas `imovel`
--
ALTER TABLE `imovel`
  ADD CONSTRAINT `fk_funcionarioResponsavel` FOREIGN KEY (`FuncionarioResponsavel`) REFERENCES `funcionario` (`ID`),
  ADD CONSTRAINT `fk_tipoImovel` FOREIGN KEY (`TipoImovel`) REFERENCES `tipoImovel` (`ID`);

--
-- Restrições para tabelas `interesse`
--
ALTER TABLE `interesse`
  ADD CONSTRAINT `fk_imovelId_interesse` FOREIGN KEY (`ImovelID`) REFERENCES `imovel` (`ID`);

--
-- Restrições para tabelas `proprietario`
--
ALTER TABLE `proprietario`
  ADD CONSTRAINT `fk_imovel_id` FOREIGN KEY (`ImovelID`) REFERENCES `imovel` (`ID`),
  ADD CONSTRAINT `fk_pessoa_id` FOREIGN KEY (`PessoaID`) REFERENCES `cliente` (`ID`);

--
-- Restrições para tabelas `telefone`
--
ALTER TABLE `telefone`
  ADD CONSTRAINT `fk_pessoaID` FOREIGN KEY (`PessoaID`) REFERENCES `cliente` (`ID`),
  ADD CONSTRAINT `fk_tipoPessoa` FOREIGN KEY (`TipoPessoa`) REFERENCES `tipoPessoa` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
