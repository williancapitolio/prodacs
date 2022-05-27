-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Jan-2022 às 02:16
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `prodacs`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `auxilio_brasil`
--

CREATE TABLE `auxilio_brasil` (
  `id` int(11) NOT NULL,
  `fam_ab` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco_ab` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chefe_ab` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_ab` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auxilio_brasil`
--

INSERT INTO `auxilio_brasil` (`id`, `fam_ab`, `endereco_ab`, `chefe_ab`, `status_ab`) VALUES
(15, '001', 'Mar de Minas', 'Dimas Paula', 1),
(16, '003', 'Residencial Vitoria', 'Eduardo Ramos', 1),
(17, '005', 'Pontal de Escarpas', 'Vania Penido', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auxilio_brasil_familia`
--

CREATE TABLE `auxilio_brasil_familia` (
  `id` int(11) NOT NULL,
  `nome_abf` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nasc_abf` date DEFAULT NULL,
  `nome_mae_abf` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_coleta_abf` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `peso_abf` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `altura_abf` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auxilio_brasil_familia`
--

INSERT INTO `auxilio_brasil_familia` (`id`, `nome_abf`, `data_nasc_abf`, `nome_mae_abf`, `data_coleta_abf`, `peso_abf`, `altura_abf`, `status`) VALUES
(1, '1', '0000-00-00', '1', '1', '1', '1', 1),
(2, 'Dimas de Paula', '1951-05-12', 'Dimaria de Paula', '1', '1', '1', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastros_inclusoes`
--

CREATE TABLE `cadastros_inclusoes` (
  `id` int(11) NOT NULL,
  `data` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fam` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nasc` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `cadastros_inclusoes`
--

INSERT INTO `cadastros_inclusoes` (`id`, `data`, `tipo`, `fam`, `nome`, `data_nasc`, `endereco`, `status`) VALUES
(5, '2022-01-04', 'Cadastro', '800', 'Paciente K', '2000-01-01', 'Endereço K', 1),
(6, '2021-12-06', 'Inclusão', '800', 'Paciente KK', '2001-02-05', 'Endereço K', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comorbidades`
--

CREATE TABLE `comorbidades` (
  `id` int(11) NOT NULL,
  `fam` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nasc` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comorbidade` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `comorbidades`
--

INSERT INTO `comorbidades` (`id`, `fam`, `nome`, `data_nasc`, `endereco`, `comorbidade`, `status`) VALUES
(6, '150', 'Paciente A', '2000-01-01', 'Endereço A', 'Comorbidade A', 1),
(7, '300', 'Paciente B', '1950-05-05', 'Endereço B', 'Comorbidade B', 1),
(8, '999', 'Fulana de Tal', '1980-03-07', 'Rua Fictícia', 'Câncer de Mama', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(220) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `start`, `end`) VALUES
(18, '20 visitas', '#8B0000', '2021-12-03 00:00:00', '2021-12-04 00:00:00'),
(19, '10 VISITAS', '#1C1C1C', '2022-01-03 08:00:00', '2022-01-03 10:30:00'),
(20, '9 VISITAS', '#1C1C1C', '2022-01-04 09:00:00', '2022-01-04 11:00:00'),
(21, 'CHUVA', '#436EEE', '2022-01-05 07:00:00', '2022-01-05 12:00:00'),
(22, 'CHUVA', '#436EEE', '2022-01-06 07:00:00', '2022-01-06 12:00:00'),
(23, 'UBS', '#228B22', '2022-01-07 07:00:00', '2022-01-07 12:00:00'),
(14, '15', '#1C1C1C', '2021-12-01 00:00:00', '2021-12-02 00:00:00'),
(15, '16', '#1C1C1C', '2021-12-02 08:00:00', '2021-12-02 10:30:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `insulinos`
--

CREATE TABLE `insulinos` (
  `id` int(11) NOT NULL,
  `fam` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nasc` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tempo_diabetes` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tempo_insulina` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ui` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `insulina_utilizada` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo_diabetes` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `insulinos`
--

INSERT INTO `insulinos` (`id`, `fam`, `nome`, `data_nasc`, `tempo_diabetes`, `tempo_insulina`, `ui`, `insulina_utilizada`, `tipo_diabetes`, `status`) VALUES
(3, '450', 'Paciente A', '1950-04-05', 'Desde 1990', 'Desde 1990', '15/00/00', 'Lantus', '1', 1),
(4, '600', 'Paciente B', '1940-06-06', 'Desde 2000', 'Desde 2015', '40/00/20', 'NPH', '2', 1),
(5, '750', 'Paciente C', '1975-07-07', 'Sem informação', 'Sem informação', '10/00/00', 'Lantus', '1', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `description` varchar(220) DEFAULT NULL,
  `location_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `locations`
--

INSERT INTO `locations` (`id`, `lat`, `lng`, `description`, `location_status`) VALUES
(53, -20.644958, -46.076595, '001', 1),
(54, -20.639311, -46.015934, '002', 1),
(55, -20.629850, -46.024445, '003', 1),
(56, -20.644297, -46.013683, '004', 1),
(57, -20.634909, -46.013668, '005', 1),
(59, -20.615501, -46.043587, '007', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcacao_exames`
--

CREATE TABLE `marcacao_exames` (
  `id` int(11) NOT NULL,
  `fam` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nasc` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exame_tipo` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exame_local` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exame_data` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exame_hora` time DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `marcacao_exames`
--

INSERT INTO `marcacao_exames` (`id`, `fam`, `nome`, `data_nasc`, `exame_tipo`, `exame_local`, `exame_data`, `exame_hora`, `status`) VALUES
(3, '007', 'Maria Silva', '1964-05-07', 'Mamografia', 'Piumhi', '2022-01-05', '08:30:00', 1),
(4, '007', 'Wilson Silva', '1960-10-15', 'PSA', 'Capitolio', '2022-01-07', '10:00:00', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `markers`
--

CREATE TABLE `markers` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `markers`
--

INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES
(1, 'UBS Pedro Domingos Machado', '240 R. José Soares de Oliveira, Capitólio', -20.619316, -46.041386, 'UBS'),
(2, 'Casa', '63 R. José Soares Leite de Melo, Capitólio', -20.615580, -46.043598, 'Casa'),
(3, 'SSVP', '514 R. Dr. Avelino de Queiroz, Capitólio', -20.613817, -46.050636, 'Festas/Vacinação Emergencial');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens_contatos`
--

CREATE TABLE `mensagens_contatos` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `email` varchar(220) NOT NULL,
  `assunto` varchar(220) NOT NULL,
  `mensagem` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mensagens_contatos`
--

INSERT INTO `mensagens_contatos` (`id`, `nome`, `email`, `assunto`, `mensagem`, `created`, `modified`) VALUES
(31, 'Willian', 'williansilvap25@gmail.com', 'Salve', 'Salve!', '2021-11-26 23:25:48', NULL),
(32, 'willian', 'williansilvap25@gmail.com', 'Bla', 'Blablabla', '2021-11-26 23:40:02', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `natalidades`
--

CREATE TABLE `natalidades` (
  `id` int(11) NOT NULL,
  `fam` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nasc` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome_mae` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `natalidades`
--

INSERT INTO `natalidades` (`id`, `fam`, `nome`, `data_nasc`, `nome_mae`, `status`) VALUES
(5, '007', 'Willian Silva', '1998-10-25', 'Maria Silva', 1),
(6, '007', 'Maria Silva', '1964-05-07', 'Vitoria Santos', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `obitos`
--

CREATE TABLE `obitos` (
  `id` int(11) NOT NULL,
  `fam` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nasc` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_obito` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `motivo` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `obitos`
--

INSERT INTO `obitos` (`id`, `fam`, `nome`, `data_nasc`, `data_obito`, `motivo`, `status`) VALUES
(6, '999', 'Fulano de Tal', '1991-01-01', '2021-01-01', 'Algum Motivo', 1),
(7, '900', 'Ciclano Ciclo', '1950-02-02', '2017-03-10', 'CID 10 R54 Senilidade', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `fam` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf_chefe` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `endereco` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nasc` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome_mae` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `data_coleta` varchar(220) COLLATE utf8_unicode_ci DEFAULT 'Sem dados',
  `peso` varchar(220) COLLATE utf8_unicode_ci DEFAULT 'Sem dados',
  `altura` varchar(220) COLLATE utf8_unicode_ci DEFAULT 'Sem dados'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`id`, `fam`, `nome`, `cpf`, `cpf_chefe`, `endereco`, `data_nasc`, `nome_mae`, `status`, `data_coleta`, `peso`, `altura`) VALUES
(1, '001', 'Dimas Paula', '001.000.000-00', '001.000.000-00', 'Mar de Minas', '1954-01-11', 'Maria Paula', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(2, '001', 'Rosalia Paula', '001.000.000-01', '001.000.000-00', '', '1956-09-04', 'Wanda Paraiso', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(3, '002', 'Ana Carvalho', '002.000.000-00', '002.000.000-00', 'Fazenda Ramos', '1951-02-24', 'Maria Fernandes', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(4, '002', 'Lindomir Carvalho', '002.000.000-01', '002.000.000-00', '', '1980-10-20', 'Ana Carvalho', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(5, '002', 'Lediana Carvalho', '002.000.000-02', '002.000.000-00', '', '1979-03-30', 'Ana Carvalho', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(6, '002', 'Ana Silva', '002.000.000-03', '002.000.000-00', '', '2010-02-08', 'Lediana Carvalho', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(7, '002', 'Lindomar Carvalho', '002.000.000-04', '002.000.000-00', '', '1974-09-01', 'Ana Carvalho', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(8, '003', 'Eduardo Ramos', '003.000.000-00', '003.000.000-00', 'Residencial Vitoria', '1982-09-22', 'Aparecida Ramos', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(9, '003', 'Patricia Ramos', '003.000.000-01', '003.000.000-00', '', '1984-11-08', 'Marlucia Terra', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(10, '003', 'Carlos Ramos', '003.000.000-02', '003.000.000-00', '', '2004-09-19', 'Patricia Ramos', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(11, '003', 'Larissa Ramos', '003.000.000-03', '003.000.000-00', '', '2007-06-06', 'Patricia Ramos', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(12, '003', 'Gabriel Ramos', '003.000.000-04', '003.000.000-00', '', '2017-06-01', 'Patricia Ramos', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(13, '004', 'Vicente Silva', '004.000.000-00', '004.000.000-00', 'Escarpas do Lago', '1976-05-05', 'Maria Silva', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(14, '004', 'Savia Veloso', '004.000.000-01', '004.000.000-00', '', '1974-03-04', 'Auxiliadora Veloso', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(15, '004', 'Otavio Veloso Silva', '004.000.000-02', '004.000.000-00', '', '2008-09-12', 'Savia Veloso', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(16, '005', 'Vania Penido', '005.000.000-00', '005.000.000-00', 'Pontal de Escarpas', '1972-10-29', 'Aparecida Maria Penido', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(17, '005', 'Laura Penido', '005.000.000-01', '005.000.000-00', '', '2006-09-05', 'Vania Penido', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(19, '007', 'Willian Silva', '117.111.111-11', '117.111.111-11', 'Rua Jose Soares Leite de Melo, 63', '1998-10-25', 'Maria Silva', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(20, '007', 'Maria Silva', '007.000.000-00', '117.111.111-11', '', '1964-05-07', 'Vitoria Santos', 1, 'Sem dados', 'Sem dados', 'Sem dados'),
(21, '007', 'Wilson Silva', '227.222.222-22', '117.111.111-11', '', '1960-10-15', 'Alvarinda Silva', 1, 'Sem dados', 'Sem dados', 'Sem dados');

-- --------------------------------------------------------

--
-- Estrutura da tabela `preventivos`
--

CREATE TABLE `preventivos` (
  `id` int(11) NOT NULL,
  `data` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fam` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nasc` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `preventivos`
--

INSERT INTO `preventivos` (`id`, `data`, `fam`, `nome`, `data_nasc`, `status`) VALUES
(4, '2021-12-28', '123', 'Paciente L', '1999-10-14', 1),
(5, '2022-01-04', '321', 'Paciente M', '1998-03-08', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `relatorios`
--

CREATE TABLE `relatorios` (
  `id` int(11) NOT NULL,
  `data` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fam` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chefe` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nasc` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `motivo_vd` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `relatorios`
--

INSERT INTO `relatorios` (`id`, `data`, `fam`, `chefe`, `data_nasc`, `motivo_vd`, `status`) VALUES
(6, '2022-01-03', '001', 'Dimas Paula', '1954-01-11', 'Realizado visita domiciliar, senhor Dimas relata que família passa bem. PSA está em dia. Mamografia e Preventivo da esposa Rosalia também está em dia. Sem mais. Oriento.', 1),
(7, '2022-01-03', '002', 'Ana Carvalho', '1951-02-24', 'Realizado visita domiciliar ausente às 09:40.', 1),
(8, '2022-01-06', '007', 'Willian Silva', '1998-10-25', 'Realizado visita, dona Maria relata que família passa bem. Solicitou agendamento de exame mamografia, o preventivo está em dia. PSA do marido Wilson está em dia. Sem mais. Oriento.', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `resultado_exames`
--

CREATE TABLE `resultado_exames` (
  `id` int(11) NOT NULL,
  `fam` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nasc` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exame_tipo` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exame_resultado` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `observacao` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `resultado_exames`
--

INSERT INTO `resultado_exames` (`id`, `fam`, `nome`, `data_nasc`, `exame_tipo`, `exame_resultado`, `observacao`, `status`) VALUES
(2, '007', 'Maria Silva', '1964-05-07', 'Mamografia', 'Tarja Azul - Normal', 'Repetir em 2 anos', 1),
(3, '007', 'Wilson Silva', '1960-10-15', 'PSA', 'Normal', 'Repetir em 1 ano', 1),
(4, '999', 'Fulana de Tal', '1980-03-07', 'Mamografia', 'Tarja Vermelha - Grave', 'Procurar atendimento', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sisvidas`
--

CREATE TABLE `sisvidas` (
  `id` int(11) NOT NULL,
  `data` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fam` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nasc` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sisvidas` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ar` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nf` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ma` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `af` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contato` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sisvidas`
--

INSERT INTO `sisvidas` (`id`, `data`, `fam`, `nome`, `data_nasc`, `sisvidas`, `ar`, `nf`, `ma`, `af`, `contato`, `status`) VALUES
(3, '2022-01-04', '999', 'Fulana de Tal', '1980-03-07', '99999', 'Sim', 'Já Fez', 'Sim', 'Sim', '(99)99999-9999', 1),
(4, '2022-01-05', '888', 'Paciente O', '1975-04-01', '88888', 'Não', 'Nunca Fez', 'Não', 'Não', '(88)88888-8888', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(220) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `usuario`, `senha`) VALUES
(1, 'Willian', 'williansilvap25@gmail.com', 'Agente Willian', '$2y$10$u9xT9TG2/Z5zqm/yRL5xbecdYrYwJcEDSbjpUZZkUm4.xXVjSQBqK'),
(3, 'Jose', 'jose@gmail.com', 'Agente Jose', '$2y$10$n8U2nbTfTpYyPKlk4jucJ.f/sjp3oxXveF8ZehBAxOsD4mhlMA8cK'),
(50, 'Vania', 'Vania@gmail.com', 'Agente Vania', '111116'),
(51, 'abc', 'abcabc@gmail.com', 'Agente abcabc', '$2y$10$o87LO6UXzHbKj0YDhpLFTu6BL5DWHVhFM1J2yn/P4eGfC2Y8M7hOy'),
(52, 'Agente', 'agente@gmail.com', 'Agente Agente', '$2y$10$vZhRrDqBUNdJ.21Ov1IXVOfiJzbEDNQ/ZOHF5PIidpdmRB1iGuidu');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `auxilio_brasil`
--
ALTER TABLE `auxilio_brasil`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `auxilio_brasil_familia`
--
ALTER TABLE `auxilio_brasil_familia`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cadastros_inclusoes`
--
ALTER TABLE `cadastros_inclusoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `comorbidades`
--
ALTER TABLE `comorbidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `insulinos`
--
ALTER TABLE `insulinos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `marcacao_exames`
--
ALTER TABLE `marcacao_exames`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `mensagens_contatos`
--
ALTER TABLE `mensagens_contatos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `natalidades`
--
ALTER TABLE `natalidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `obitos`
--
ALTER TABLE `obitos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `preventivos`
--
ALTER TABLE `preventivos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `relatorios`
--
ALTER TABLE `relatorios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `resultado_exames`
--
ALTER TABLE `resultado_exames`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sisvidas`
--
ALTER TABLE `sisvidas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `auxilio_brasil`
--
ALTER TABLE `auxilio_brasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `auxilio_brasil_familia`
--
ALTER TABLE `auxilio_brasil_familia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cadastros_inclusoes`
--
ALTER TABLE `cadastros_inclusoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `comorbidades`
--
ALTER TABLE `comorbidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `insulinos`
--
ALTER TABLE `insulinos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de tabela `marcacao_exames`
--
ALTER TABLE `marcacao_exames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `markers`
--
ALTER TABLE `markers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `mensagens_contatos`
--
ALTER TABLE `mensagens_contatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `natalidades`
--
ALTER TABLE `natalidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `obitos`
--
ALTER TABLE `obitos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `preventivos`
--
ALTER TABLE `preventivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `relatorios`
--
ALTER TABLE `relatorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `resultado_exames`
--
ALTER TABLE `resultado_exames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `sisvidas`
--
ALTER TABLE `sisvidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
