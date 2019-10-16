-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Out-2019 às 05:21
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.10

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
-- Estrutura da tabela `cliente`
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
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`ID`, `Nome`, `Cpf`, `Endereco`, `Email`, `Sexo`, `EstadoCivil`, `Profissao`) VALUES
(1, 'Maria', '123.456.789-02', 'Rua A, Bairro B, Araguari - MG', 'maria@email.com', 'f', 4, 'Piloto de Caça'),
(2, 'Guilherme Bartasson', '137.682.906-11', 'Rua Guaporé 526, Bairro Santa Rosa', 'guilhermebnj@gmail.com', 'm', 2, 'Programador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone`
--

CREATE TABLE `telefone` (
  `ID` int(4) UNSIGNED NOT NULL,
  `PessoaID` int(4) UNSIGNED NOT NULL,
  `TipoPessoa` int(1) UNSIGNED NOT NULL,
  `Numero` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `telefone`
--

INSERT INTO `telefone` (`ID`, `PessoaID`, `TipoPessoa`, `Numero`) VALUES
(1, 1, 1, '(56) 98738-9475'),
(2, 1, 1, '(03) 98252-0938'),
(3, 1, 1, '(48) 09583-4960'),
(4, 2, 1, '(34) 3223-8957'),
(5, 2, 1, '(34) 99813-4380');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipopessoa`
--

CREATE TABLE `tipopessoa` (
  `ID` int(1) UNSIGNED NOT NULL,
  `Nome` varchar(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tipopessoa`
--

INSERT INTO `tipopessoa` (`ID`, `Nome`) VALUES
(1, 'Cliente'),
(2, 'Funcionário');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `telefone`
--
ALTER TABLE `telefone`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `tipopessoa`
--
ALTER TABLE `tipopessoa`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `telefone`
--
ALTER TABLE `telefone`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tipopessoa`
--
ALTER TABLE `tipopessoa`
  MODIFY `ID` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
