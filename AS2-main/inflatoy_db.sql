-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/11/2025 às 15:59
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
-- Banco de dados: `inflatoy_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `brinquedos`
--

CREATE TABLE `brinquedos` (
  `id_brinquedo` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco_dia` decimal(10,2) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `brinquedos`
--

INSERT INTO `brinquedos` (`id_brinquedo`, `nome`, `descricao`, `preco_dia`, `ativo`, `id_categoria`) VALUES
(1, 'Castelo Mágico', 'Clássico castelo inflável para os pequenos.', 250.00, 1, 1),
(2, 'Super Escorregador Radical', 'Escorregador de 6 metros de altura.', 350.00, 1, 2),
(3, 'Piscina de Bolinhas', 'Piscina para várias crianças com milhares de bolinhas.', 300.00, 1, 3),
(4, 'Combo Atividades', 'Combinação pinturas faciais + pula pula.', 180.00, 1, 4),
(5, 'Combo Atividades 2', 'Combinação de área de pulo e escorregador.', 380.00, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nome`, `descricao`) VALUES
(1, 'Castelos & Pulos', 'Infláveis focados em pular e saltar, seguros e divertidos.'),
(2, 'Escorregadores & Tobogãs', 'Infláveis altos para escorregar, ideais para emoção.'),
(3, 'Interativos & Esportivos', 'Brinquedos que incentivam a competição e a interação.'),
(4, 'Piscinas & Água', 'Infláveis projetados para uso com água ou bolinhas.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `data_festa` date NOT NULL,
  `periodo` enum('diario','completo') NOT NULL,
  `status` enum('solicitado','confirmado','cancelado') NOT NULL DEFAULT 'solicitado',
  `data_reserva` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `nivel_acesso` enum('admin','operador') NOT NULL DEFAULT 'operador'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `email`, `senha_hash`, `nivel_acesso`) VALUES
(1, 'admin', 'admin@inflatoy.com', '$2y$10$954hF/t0tM1yN1kX8yN5rO.Jv1P/D/S7L9R/f3L1mF2G3W4X5Y6Z7', 'admin'),
(2, 'operador_a', 'victor@inflatoy.com', '$2y$10$954hF/t0tM1yN1kX8yN5rO.Jv1P/D/S7L9R/f3L1mF2G3W4X5Y6Z7', 'operador');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `brinquedos`
--
ALTER TABLE `brinquedos`
  ADD PRIMARY KEY (`id_brinquedo`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices de tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nome_usuario` (`nome_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `brinquedos`
--
ALTER TABLE `brinquedos`
  MODIFY `id_brinquedo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `brinquedos`
--
ALTER TABLE `brinquedos`
  ADD CONSTRAINT `brinquedos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
