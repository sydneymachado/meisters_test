-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 22/12/2023 às 00:44
-- Versão do servidor: 8.2.0
-- Versão do PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `todo_app`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `finish_date` datetime DEFAULT NULL,
  `finished` tinyint NOT NULL DEFAULT '0',
  `title` varchar(45) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `task`
--

INSERT INTO `task` (`id`, `creation_date`, `finish_date`, `finished`, `title`, `description`) VALUES
(1, '2023-12-21 23:37:45', '2023-12-21 23:37:45', 1, 'Primeira tarefa', 'This is the first job that I do in this new job'),
(2, '2023-12-21 23:34:34', '2023-12-21 23:34:34', 1, 'Segunda tarefa', 'This is the second job... go work man!');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
