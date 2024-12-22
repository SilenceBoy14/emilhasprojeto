-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/12/2024 às 03:21
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cidade_melhorias`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidades`
--

CREATE TABLE `cidades` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cidades`
--

INSERT INTO `cidades` (`id`, `nome`, `estado`) VALUES
(1, 'curitibaa', 'paraná');

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `id_melhoria` int(11) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `data_criacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `melhorias`
--

CREATE TABLE `melhorias` (
  `id` int(11) NOT NULL,
  `id_cidade` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `data_criacao` datetime DEFAULT current_timestamp(),
  `relevancia` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `melhorias`
--

INSERT INTO `melhorias` (`id`, `id_cidade`, `titulo`, `descricao`, `categoria`, `data_criacao`, `relevancia`) VALUES
(1, 1, 'acabar com o athletico', 'acabar', 'morre', '2024-12-17 10:35:46', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `opinioes`
--

CREATE TABLE `opinioes` (
  `id` int(11) NOT NULL,
  `id_melhoria` int(11) DEFAULT NULL,
  `opiniao` text DEFAULT NULL,
  `data_criacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `votos`
--

CREATE TABLE `votos` (
  `id` int(11) NOT NULL,
  `id_melhoria` int(11) DEFAULT NULL,
  `voto` tinyint(1) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `votos`
--

INSERT INTO `votos` (`id`, `id_melhoria`, `voto`, `id_usuario`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 1),
(3, 1, 0, 1),
(4, 1, 1, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_melhoria` (`id_melhoria`);

--
-- Índices de tabela `melhorias`
--
ALTER TABLE `melhorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cidade` (`id_cidade`);

--
-- Índices de tabela `opinioes`
--
ALTER TABLE `opinioes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_melhoria` (`id_melhoria`);

--
-- Índices de tabela `votos`
--
ALTER TABLE `votos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_melhoria` (`id_melhoria`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cidades`
--
ALTER TABLE `cidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `melhorias`
--
ALTER TABLE `melhorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `opinioes`
--
ALTER TABLE `opinioes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `votos`
--
ALTER TABLE `votos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_melhoria`) REFERENCES `melhorias` (`id`);

--
-- Restrições para tabelas `melhorias`
--
ALTER TABLE `melhorias`
  ADD CONSTRAINT `melhorias` FOREIGN KEY (`id_cidade`) REFERENCES `cidades` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `opinioes`
--
ALTER TABLE `opinioes`
  ADD CONSTRAINT `opinioes_ibfk_1` FOREIGN KEY (`id_melhoria`) REFERENCES `melhorias` (`id`);

--
-- Restrições para tabelas `votos`
--
ALTER TABLE `votos`
  ADD CONSTRAINT `votos` FOREIGN KEY (`id_melhoria`) REFERENCES `melhorias` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
