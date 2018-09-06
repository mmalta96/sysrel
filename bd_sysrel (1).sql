-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 06-Set-2018 às 02:04
-- Versão do servidor: 5.7.21
-- PHP Version: 5.6.35

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
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_administrador`
--

INSERT INTO `tb_administrador` (`LOGIN`, `ID`, `EMAIL`, `SENHA`, `SENHA_ANTIGA`, `ERROS_LOGIN`) VALUES
('CHOKITO', 54, 'emersondecrr@hotmail.com', '44f28f369850e09af4d026809359a0f16f8ebe2d28d7e86e4d34c61993565333', '44f28f369850e09af4d026809359a0f16f8ebe2d28d7e86e4d34c61993565333', 0),
('TESTE', 55, 'elianna-alves@hotmail.com', '44f28f369850e09af4d026809359a0f16f8ebe2d28d7e86e4d34c61993565333', '44f28f369850e09af4d026809359a0f16f8ebe2d28d7e86e4d34c61993565333', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_lider_pesquisa`
--

INSERT INTO `tb_lider_pesquisa` (`ID`, `NOME`, `PRONTUARIO`, `EMAIL`, `SENHA`, `SENHA_ANTIGA`, `ERROS_LOGIN`, `DATA_CADASTRO`, `CLATTES`, `FOTO`) VALUES
(36, 'Tiago', '11111', 'tiago.ifsp@gmail.com', 'be4f68c4e2620f968f72c754f37601bd580d5632ebbe08a3dcd3b6510021f3c2', 'GZy4vR', 0, '2018-09-05 21:09:00', 'http://lattes.cnpq.br/', '4ba6ebdd0db2091e458448028bd5459c.jpg');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_permissao_telas`
--

INSERT INTO `tb_permissao_telas` (`ID_TELA_FK`, `ADM`, `LIDER`) VALUES
(1, b'1', b'1'),
(2, b'1', b'1'),
(3, b'1', b'1'),
(4, b'1', b'1'),
(5, b'1', b'1'),
(6, b'1', b'1'),
(7, b'1', b'1'),
(8, b'1', b'1'),
(9, b'1', b'1'),
(10, b'1', b'1'),
(11, b'1', b'1'),
(12, b'1', b'1'),
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
  `PRONTUARIO_LIDER` varchar(20) NOT NULL,
  `ID_ADM` int(11) DEFAULT NULL,
  `CODIGO` varchar(10) NOT NULL,
  `DTHR_ENVIO` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_TB_LIDER_PESQUISA` (`ID_LIDER`),
  KEY `FK_TB_ADMINISTRADOR` (`ID_ADM`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

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
(14, 'Manutenção de Usuario', 'ManutencaoLider.php'),
(15, 'Recuperar Senha Usuario', 'telaManutencaoUsuario.php');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
