-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 16/10/2019 às 16:54
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
(4, 'Teste2', '123.456.789-03', 'Rua F, Bairro G', 'teste1@teste1.com', 'm', 5, 'Tester');

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
  `Cargo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Login` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Senha` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `Salt` varchar(22) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `funcionario`
--

INSERT INTO `funcionario` (`ID`, `Nome`, `Telefone`, `Cpf`, `Endereco`, `TelefoneContato`, `TelefoneCelular`, `Cargo`, `Login`, `Senha`, `Salt`) VALUES
(1, 'Guilherme Bartasson', '(34) 99812-4380', '137.682.906-11', 'Rua Guaporé 526, Bairro Santa Rosa', '(34) 3223-8957', '(34) 99813-4380', 'Diretor', 'guilherme.bonfins', '$2a$04$oR6TICVZV5G2FGicSdXDb.AcnOuB3tkFcUu5818P27dbrArCdn/6q', 'oR6TICVZV5G2FGicSdXDbG');

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
(7, 4, 1, '(45) 67890-4567');

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
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Cpf` (`Cpf`);

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
  ADD UNIQUE KEY `Cpf` (`Cpf`);

--
-- Índices de tabela `telefone`
--
ALTER TABLE `telefone`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `tipoPessoa`
--
ALTER TABLE `tipoPessoa`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `estadoCivil`
--
ALTER TABLE `estadoCivil`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `telefone`
--
ALTER TABLE `telefone`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tipoPessoa`
--
ALTER TABLE `tipoPessoa`
  MODIFY `ID` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
