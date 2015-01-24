-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 24-Jan-2015 às 17:52
-- Versão do servidor: 5.5.40-0ubuntu0.14.04.1
-- versão do PHP: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `laravel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplines`
--

CREATE TABLE IF NOT EXISTS `disciplines` (
  `d_id` int(11) NOT NULL AUTO_INCREMENT,
  `d_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `disciplines`
--

INSERT INTO `disciplines` (`d_id`, `d_name`) VALUES
(1, 'Desconhecida'),
(2, 'Linguagens De Programação');

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `logs_id` int(11) NOT NULL AUTO_INCREMENT,
  `logs_username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `logs_action` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `logs_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logs_ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`logs_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`logs_id`, `logs_username`, `logs_action`, `logs_date`, `logs_ip`) VALUES
(1, 'G4brym', 'Register', '2014-11-09 21:18:08', '144.64.105.23'),
(2, 'fghjgg', 'Register', '2014-11-10 20:38:44', '144.64.105.23'),
(3, 'triangle', 'Register', '2014-11-16 21:40:04', '188.80.150.60'),
(4, '1', 'Ticket Creation', '2014-11-26 19:59:30', '2.81.151.24'),
(5, '1', 'Ticket Creation', '2014-11-26 20:01:25', '2.81.151.24'),
(6, '1', 'Ticket Answer #1', '2014-11-26 20:35:41', '2.81.151.24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_year` int(11) NOT NULL,
  `m_num` int(11) NOT NULL,
  `m_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `m_hours` int(11) NOT NULL,
  `m_did` int(11) NOT NULL DEFAULT '1' COMMENT 'disciline ID',
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `modules`
--

INSERT INTO `modules` (`m_id`, `m_year`, `m_num`, `m_name`, `m_hours`, `m_did`) VALUES
(1, 2013, 1, 'Algoritmia', 18, 2),
(2, 2013, 2, 'Introdução à Linguagem de Programação', 18, 1),
(3, 2013, 3, 'Estruturas de Controlo', 36, 1),
(4, 2013, 4, 'Subprogramas (Procedimentos e Funções)', 36, 2),
(5, 2013, 5, 'Tipo Estruturado - Tabelas', 21, 1),
(6, 2013, 6, 'Tipo Estruturado - Registos', 18, 2),
(7, 2013, 7, 'Estruturas Dinâmicas (Apontadores)', 24, 1),
(8, 2013, 8, 'Ficheiros', 18, 1),
(9, 2014, 10, 'Introdução à Programação Orientada por Objectos', 18, 1),
(10, 2014, 11, 'Introdução à Linguagem de Programação Orientada por Objectos', 24, 1),
(11, 2014, 12, 'Fundamentos Avançados de Programação Orientada por Objectos', 36, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(15) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastlogin` int(32) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `token`, `remember_token`, `lastlogin`, `admin`, `created_at`, `updated_at`) VALUES
(1, 'g4bryrm98@hotmail.com', 'Gabriel', '$2y$10$f0mn2mNtWDXzIG18qZyhG.EUZo9vQWt3ceNdvKWEy/ZXA2m.eII3y', '', 'oEuCq20tOrNrvewJinFGYqPT85WZIxsSFIWLyEhwEJ4vHy6nzXIanIqzyaRT', 1422120374, 1, '2014-11-09 21:18:03', '2015-01-24 22:26:14'),
(17017, NULL, 'VANESSA CRISTINA DA SILVA ANDRADE', NULL, '0', '', 0, 0, '2015-01-04 04:34:04', '2015-01-04 04:34:04'),
(17021, NULL, 'RICARDO MICAEL MARQUES ALMEIDA', NULL, '0', '', 0, 0, '2015-01-04 04:34:04', '2015-01-04 04:34:04'),
(17634, NULL, 'JOÃO SALVADOR GOMES  NEVES', NULL, '0', '', 0, 0, '2015-01-04 04:34:04', '2015-01-04 04:34:04'),
(17700, '12000@escola.pt', 'GABRIEL RINO MASSADAS', '$2y$10$f0mn2mNtWDXzIG18qZyhG.EUZo9vQWt3ceNdvKWEy/ZXA2m.eII3y', '0', '7NNxcWCbBuUwLlznSUIOk98VIurE4uEwDS4aGri9NuC6YD0F9TefrNtPBvuo', 0, 0, '2015-01-04 04:34:04', '2015-01-22 01:40:37'),
(18255, NULL, 'RAFAEL CALÔBA VERDADE', '$2y$10$f0mn2mNtWDXzIG18qZyhG.EUZo9vQWt3ceNdvKWEy/ZXA2m.eII3y', '0', '', 1422103545, 0, '2015-01-04 04:34:04', '2015-01-24 17:45:45'),
(20030, '12001@escola.pt', 'DANIEL ABRANTES MARTINS', '$2y$10$hcInaACjRzVhMxSi3sXvweVZEn7w/cYlmwnF6IUq.G2b74QMY/74e', '0', '', 0, 0, '2015-01-04 04:34:04', '2015-01-04 04:34:04'),
(20050, NULL, 'BEATRIZ ALEXANDRA MAXIMIANO ABRANTES', NULL, '0', '', 0, 0, '2015-01-04 04:34:04', '2015-01-04 04:34:04'),
(23126, NULL, 'ANA BEATRIZ RODRIGUES FIGUEIREDO', NULL, '0', '', 0, 0, '2015-01-04 04:34:04', '2015-01-04 04:34:04'),
(23277, NULL, 'LINDA INÊS MARTINS ARRUDA', NULL, '0', '', 0, 0, '2015-01-04 04:34:04', '2015-01-04 04:34:04'),
(23311, NULL, 'ANA BEATRIZ MORAIS DA SILVA', NULL, '0', '', 0, 0, '2015-01-04 04:34:04', '2015-01-04 04:34:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usersmods`
--

CREATE TABLE IF NOT EXISTS `usersmods` (
  `um_id` int(11) NOT NULL AUTO_INCREMENT,
  `um_mod` int(11) NOT NULL,
  `um_user` int(11) NOT NULL,
  `um_grade` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`um_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `usersmods`
--

INSERT INTO `usersmods` (`um_id`, `um_mod`, `um_user`, `um_grade`) VALUES
(1, 1, 18255, NULL),
(2, 4, 18255, NULL),
(3, 6, 18255, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
