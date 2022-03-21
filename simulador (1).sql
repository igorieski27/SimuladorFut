-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Mar-2022 às 20:38
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `simulador`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `artilheiros`
--

CREATE TABLE `artilheiros` (
  `id_arti` int(11) NOT NULL,
  `nome_art` varchar(255) NOT NULL,
  `gols_art` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `times`
--

CREATE TABLE `times` (
  `idTime` int(11) NOT NULL,
  `nome` varchar(15) NOT NULL,
  `ataque` int(11) NOT NULL,
  `defesa` int(11) NOT NULL,
  `pontos` int(11) NOT NULL,
  `campanha` varchar(100) NOT NULL,
  `titulos` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `times`
--

INSERT INTO `times` (`idTime`, `nome`, `ataque`, `defesa`, `pontos`, `campanha`, `titulos`) VALUES
(1, 'Atlético-MG', 73, 68, 74, '2|6|7|9|12|8|13|4|15|5|10|16|17|14|3|11|2|6|7|9|12|8|13|4|15|5|10|16|17|14|3|11|', 0),
(2, 'Coritiba', 63, 59, 30, '7|10|13|16|8|5|1|3|4|14|15|9|12|6|17|11|7|10|13|16|8|5|1|3|4|14|15|9|12|6|17|11|', 0),
(3, 'Juventude', 62, 55, 23, '14|8|6|11|7|2|9|1|5|15|17|13|4|16|10|12|14|8|6|11|7|2|9|1|5|15|17|13|4|16|10|12|', 0),
(4, 'Fluminense', 67, 64, 65, '11|2|16|15|13|10|8|7|17|12|14|9|3|1|6|11|2|16|15|13|10|8|7|17|12|14|9|3|1|6|', 0),
(5, 'Corinthians', 67, 62, 67, '6|2|1|8|15|3|4|7|12|10|17|11|9|16|13|6|2|1|8|15|3|4|7|12|10|17|11|9|16|13|', 0),
(6, 'São Paulo', 70, 65, 68, '17|4|13|2|14|5|8|1|12|16|15|7|10|3|9|17|4|13|2|14|5|8|1|12|16|15|7|10|3|9|', 1),
(7, 'Internacional', 67, 68, 76, '13|6|8|5|11|12|9|4|3|1|2|14|15|10|16|17|13|6|8|5|11|12|9|4|3|1|2|14|15|10|16|17|', 2),
(8, 'Ceará', 64, 60, 36, '9|12|16|6|5|10|17|1|14|11|13|2|4|7|3|9|12|16|6|5|10|17|1|14|11|13|2|4|7|3|', 0),
(9, 'Cuiabá', 60, 65, 31, '10|11|16|3|14|15|12|5|2|1|4|13|6|7|17|10|11|16|3|14|15|12|5|2|1|4|13|6|7|17|', 0),
(10, 'Goiás', 62, 59, 23, '14|1|16|9|6|2|12|13|17|5|11|15|3|7|4|8|14|1|16|9|6|2|12|13|17|5|11|15|3|7|4|8|', 0),
(11, 'Avaí', 58, 57, 16, '3|1|7|9|4|5|15|16|2|12|13|8|10|6|17|3|1|7|9|4|5|15|16|2|12|13|8|10|6|17|', 0),
(12, 'Palmeiras', 71, 70, 88, '13|15|3|11|7|8|5|14|9|1|10|2|17|4|16|13|15|3|11|7|8|5|14|9|1|10|2|17|4|16|', 7),
(13, 'Atlético-PR', 67, 66, 56, '6|5|3|12|15|4|8|1|7|11|9|2|16|14|17|6|5|3|12|15|4|8|1|7|11|9|2|16|14|17|', 0),
(14, 'America-MG', 65, 65, 58, '16|15|13|11|2|3|9|10|12|1|7|4|5|17|8|16|15|13|11|2|3|9|10|12|1|7|4|5|17|8|', 0),
(15, 'Santos', 68, 65, 70, '11|9|13|7|1|2|16|4|14|10|5|12|8|6|3|11|9|13|7|1|2|16|4|14|10|5|12|8|6|3|', 0),
(16, 'Fortaleza', 61, 62, 53, '4|9|7|15|10|1|6|14|13|17|2|3|11|5|12|4|9|7|15|10|1|6|14|13|17|2|3|11|5|12|', 0),
(17, 'Atlético-GO', 58, 60, 28, '4|3|13|14|9|1|2|7|16|15|11|10|12|5|8|4|3|13|14|9|1|2|7|16|15|11|10|12|5|8|', 0),
(18, 'RB Bragantino', 65, 65, 77, '7|9|8|1|3|6|13|17|4|16|11|5|12|2|10|15|7|9|8|1|3|6|13|17|4|16|11|5|12|2|10|15|', 0),
(19, 'Flamengo', 75, 67, 69, '6|17|13|7|8|1|10|12|16|3|15|5|11|4|9|14|6|17|13|7|8|1|10|12|16|3|15|5|11|4|9|14|', 2),
(20, 'Botafogo', 64, 62, 34, '3|8|1|9|15|10|17|16|5|7|12|13|4|11|6|14|2|3|8|1|9|15|10|17|16|5|7|12|13|4|11|6|14|2|', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `artilheiros`
--
ALTER TABLE `artilheiros`
  ADD PRIMARY KEY (`id_arti`);

--
-- Índices para tabela `times`
--
ALTER TABLE `times`
  ADD PRIMARY KEY (`idTime`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `artilheiros`
--
ALTER TABLE `artilheiros`
  MODIFY `id_arti` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `times`
--
ALTER TABLE `times`
  MODIFY `idTime` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
