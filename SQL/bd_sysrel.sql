-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 15-Set-2018 às 17:54
-- Versão do servidor: 8.0.12
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_sysrel`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_administrador`
--

DROP TABLE IF EXISTS `tb_administrador`;
CREATE TABLE IF NOT EXISTS `tb_administrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `senha_antiga` varchar(64) DEFAULT NULL,
  `erros_login` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tb_administrador`
--

INSERT INTO `tb_administrador` (`id`, `login`, `email`, `senha`, `senha_antiga`, `erros_login`) VALUES
(2, 'MMALTA96', 'matheusmalta.p@gmail.com', '55de1e4b50da90d84249ab53f61a99a6959d4c6fd8a6c402670b4115c137beae', '55de1e4b50da90d84249ab53f61a99a6959d4c6fd8a6c402670b4115c137beae', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_grupo_lider`
--

DROP TABLE IF EXISTS `tb_grupo_lider`;
CREATE TABLE IF NOT EXISTS `tb_grupo_lider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_grupo_fk` int(11) DEFAULT NULL,
  `id_lider_fk` int(11) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `tb_grupo_pesquisa_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_grupo_id_idx` (`id_grupo_fk`),
  KEY `fk_lider_id_idx` (`id_lider_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_grupo_pesquisa`
--

DROP TABLE IF EXISTS `tb_grupo_pesquisa`;
CREATE TABLE IF NOT EXISTS `tb_grupo_pesquisa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `logotipo` varchar(100) DEFAULT NULL,
  `descricao` varchar(400) DEFAULT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `link_dgp` varchar(100) DEFAULT NULL,
  `situacao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_itens_index`
--

DROP TABLE IF EXISTS `tb_itens_index`;
CREATE TABLE IF NOT EXISTS `tb_itens_index` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descricao` varchar(2048) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_lider_pesquisa`
--

DROP TABLE IF EXISTS `tb_lider_pesquisa`;
CREATE TABLE IF NOT EXISTS `tb_lider_pesquisa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `prontuario` varchar(12) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `senha_antiga` varchar(64) DEFAULT NULL,
  `erros_login` int(11) DEFAULT NULL,
  `data_cadastro` date NOT NULL,
  `clattes` varchar(2048) DEFAULT NULL,
  `foto` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_permissao_telas`
--

DROP TABLE IF EXISTS `tb_permissao_telas`;
CREATE TABLE IF NOT EXISTS `tb_permissao_telas` (
  `id_tela_fk` int(11) NOT NULL,
  `adm` bit(1) NOT NULL,
  `lider` bit(1) NOT NULL,
  PRIMARY KEY (`id_tela_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tb_permissao_telas`
--

INSERT INTO `tb_permissao_telas` (`id_tela_fk`, `adm`, `lider`) VALUES
(1, b'1', b'1'),
(2, b'1', b'1'),
(3, b'0', b'0'),
(4, b'0', b'0'),
(5, b'0', b'0'),
(6, b'0', b'0'),
(7, b'0', b'0'),
(8, b'0', b'0'),
(9, b'0', b'0'),
(10, b'0', b'0'),
(11, b'0', b'0'),
(12, b'0', b'0'),
(13, b'1', b'0'),
(14, b'1', b'1'),
(15, b'1', b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_recuperar_senha`
--

DROP TABLE IF EXISTS `tb_recuperar_senha`;
CREATE TABLE IF NOT EXISTS `tb_recuperar_senha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lider` int(11) DEFAULT NULL,
  `id_adm` int(11) DEFAULT NULL,
  `codigo` varchar(300) DEFAULT NULL,
  `dthr_envio` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_lider_idx` (`id_lider`),
  KEY `fk_id_adm_idx` (`id_adm`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_telas`
--

DROP TABLE IF EXISTS `tb_telas`;
CREATE TABLE IF NOT EXISTS `tb_telas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `caminho` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tb_telas`
--

INSERT INTO `tb_telas` (`id`, `descricao`, `caminho`) VALUES
(1, 'Cadastro de Lider de Pesquisa', 'telaCadastroLiderPesquisa.php'),
(2, 'Permissões de Usuário', 'permissoes.php'),
(3, 'Cadastro de Grupo de Pesquisa', 'cadastrogrupopesquisa.php'),
(4, 'Cadastro de Linhas de Pesquisa', 'cadastrolinhapesquisa.php'),
(5, 'Cadastro de Técnicos', 'cadastrotecnicos.php'),
(6, 'Cadastro de Docentes', 'cadastrodocentes.php'),
(7, 'Cadastro de Discentes', 'cadastrodiscentes.php'),
(8, 'Cadastro de Projetos de Pesquisa', 'cadastroprojetos.php'),
(9, 'Cadastro de Publicações', 'cadastropublicacoes.php'),
(10, 'Cadastro de Equipamentos', 'cadastroequipamentos.php'),
(11, 'Cadastro de Reuniões', 'cadastroreunioes.php'),
(12, 'Relatório', 'relatorio.php'),
(13, 'Cadastro de Administradores', 'cadastroAdministrador.php'),
(14, 'Manutenção de Usuario', 'telaManutencaoUsuarios.php'),
(15, 'Recuperar Senha Usuario', 'telaEnviaSenhaUsuarios.php');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_grupo_lider`
--
ALTER TABLE `tb_grupo_lider`
  ADD CONSTRAINT `fk_grupo_id` FOREIGN KEY (`id_grupo_fk`) REFERENCES `tb_grupo_pesquisa` (`id`),
  ADD CONSTRAINT `fk_lider_id` FOREIGN KEY (`id_lider_fk`) REFERENCES `tb_lider_pesquisa` (`id`);

--
-- Limitadores para a tabela `tb_permissao_telas`
--
ALTER TABLE `tb_permissao_telas`
  ADD CONSTRAINT `fk_id_tela` FOREIGN KEY (`id_tela_fk`) REFERENCES `tb_telas` (`id`);

--
-- Limitadores para a tabela `tb_recuperar_senha`
--
ALTER TABLE `tb_recuperar_senha`
  ADD CONSTRAINT `fk_id_adm` FOREIGN KEY (`id_adm`) REFERENCES `tb_administrador` (`id`),
  ADD CONSTRAINT `fk_id_lider` FOREIGN KEY (`id_lider`) REFERENCES `tb_lider_pesquisa` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
