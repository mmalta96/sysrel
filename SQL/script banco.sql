-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 07-Set-2018 às 17:33
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
  `LOGIN` varchar(20) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(45) NOT NULL,
  `SENHA` varchar(64) NOT NULL,
  `SENHA_ANTIGA` varchar(64) DEFAULT NULL,
  `ERROS_LOGIN` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_lider_pesquisa`
--

DROP TABLE IF EXISTS `tb_lider_pesquisa`;
CREATE TABLE IF NOT EXISTS `tb_lider_pesquisa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOME` varchar(80) NOT NULL,
  `PRONTUARIO` varchar(12) NOT NULL,
  `EMAIL` varchar(45) NOT NULL,
  `SENHA` varchar(64) NOT NULL,
  `SENHA_ANTIGA` varchar(64) DEFAULT NULL,
  `ERROS_LOGIN` int(11) DEFAULT NULL,
  `DATA_CADASTRO` datetime NOT NULL,
  `CLATTES` varchar(2048) DEFAULT NULL,
  `FOTO` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_permissao_telas`
--

DROP TABLE IF EXISTS `tb_permissao_telas`;
CREATE TABLE IF NOT EXISTS `tb_permissao_telas` (
  `ID_TELA_FK` int(11) NOT NULL,
  `ADM` bit(1) DEFAULT NULL,
  `LIDER` bit(1) DEFAULT NULL,
  PRIMARY KEY (`ID_TELA_FK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_permissao_telas`
--

INSERT INTO `tb_permissao_telas` (`ID_TELA_FK`, `ADM`, `LIDER`) VALUES
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
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_LIDER` int(11) DEFAULT NULL,
  `ID_ADM` int(11) DEFAULT NULL,
  `CODIGO` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `DTHR_ENVIO` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_TB_LIDER_PESQUISA` (`ID_LIDER`),
  KEY `FK_TB_ADMINISTRADOR` (`ID_ADM`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_telas`
--

DROP TABLE IF EXISTS `tb_telas`;
CREATE TABLE IF NOT EXISTS `tb_telas` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DESCRICAO` varchar(50) NOT NULL,
  `CAMINHO` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_telas`
--

INSERT INTO `tb_telas` (`ID`, `DESCRICAO`, `CAMINHO`) VALUES
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
