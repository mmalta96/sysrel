-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 02-Set-2018 às 17:20
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
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(45) NOT NULL,
  `SENHA` varchar(64) NOT NULL,
  `SENHA_ANTIGA` varchar(64) DEFAULT NULL,
  `ERROS_LOGIN` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tb_administrador`
--

INSERT INTO `tb_administrador` (`ID`, `EMAIL`, `SENHA`, `SENHA_ANTIGA`, `ERROS_LOGIN`) VALUES
(2, 'matheusmalta.p@gmail.com', '183461', '183461', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_lider_pesquisa`
--

DROP TABLE IF EXISTS `tb_lider_pesquisa`;
CREATE TABLE IF NOT EXISTS `tb_lider_pesquisa` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOME` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `PRONTUARIO` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `EMAIL` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `DATA_CADASTRO` datetime NOT NULL,
  `CLATTES` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `FOTO` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `SENHA` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `SENHA_ANTIGA` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ERROS_LOGIN` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13481 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tb_lider_pesquisa`
--

INSERT INTO `tb_lider_pesquisa` (`ID`, `NOME`, `PRONTUARIO`, `EMAIL`, `DATA_CADASTRO`, `CLATTES`, `FOTO`, `SENHA`, `SENHA_ANTIGA`, `ERROS_LOGIN`) VALUES
(13469, 'Matheus', 'ba169037x', 'matheusmalta.p@gmail.com', '2018-09-01 17:57:00', 'dsadsa', NULL, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL),
(13470, 'Choco', 'ba11545', 'emerson@dodod.com', '2018-09-01 18:20:00', NULL, NULL, '8bgziX', NULL, NULL),
(13471, 'Carlos', 'ba1154522', 'carlos@carlos.com', '2018-09-01 18:20:00', NULL, NULL, 'Acz5Wr', NULL, NULL),
(13472, 'Getulio', '155', '11@dd.com', '2018-09-02 13:09:00', NULL, NULL, 'dmAbDh', NULL, NULL),
(13473, 'Jo', '212', '11@dd.com', '2018-09-02 13:11:00', NULL, NULL, 'UBeEog', NULL, NULL),
(13474, 'Mikael', 'ba169037x', 'matheusmalta.p@gmail.com', '2018-09-02 13:13:00', NULL, NULL, 'O4IXJD', NULL, NULL),
(13475, '2', '2', 'matheusmalta.p@gmail.com', '2018-09-02 13:14:00', NULL, NULL, 'NuLdgJ', NULL, NULL),
(13476, '', '', '', '2018-09-02 13:42:00', NULL, NULL, 'GTx0cI', NULL, NULL),
(13477, '', '', '', '2018-09-02 13:42:00', NULL, NULL, 'BNL7Pm', NULL, NULL),
(13478, '', '', '', '2018-09-02 13:42:00', NULL, NULL, 'fj4VPb', NULL, NULL),
(13479, 'ddddddddddddddd', 'ddddddddd', 'd', '2018-09-02 13:47:00', NULL, NULL, 'MiEJad', NULL, NULL),
(13480, 'MATHEUS MALTA PEDROSO', 'ba169037x', 'matheusmalta.p@gmail.com', '2018-09-02 13:54:00', NULL, NULL, 'ie4hfw', NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(13, b'1', b'1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_recuperar_senha`
--

DROP TABLE IF EXISTS `tb_recuperar_senha`;
CREATE TABLE IF NOT EXISTS `tb_recuperar_senha` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_LIDER` int(11) DEFAULT NULL,
  `ID_ADM` int(11) DEFAULT NULL,
  `CODIGO` varchar(10) NOT NULL,
  `DTHR_ENVIO` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_TB_LIDER_PESQUISA` (`ID_LIDER`),
  KEY `FK_TB_ADMINISTRADOR` (`ID_ADM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tb_telas`
--

INSERT INTO `tb_telas` (`ID`, `DESCRICAO`, `CAMINHO`) VALUES
(1, 'Cadastro de Líder de Pesquisa', 'telaCadastroLiderPesquisa.php'),
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
(13, 'Cadastro de Administrador', 'cadastroadministrador.php');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_permissao_telas`
--
ALTER TABLE `tb_permissao_telas`
  ADD CONSTRAINT `FK_TB_TELAS` FOREIGN KEY (`ID_TELA_FK`) REFERENCES `tb_telas` (`id`);

--
-- Limitadores para a tabela `tb_recuperar_senha`
--
ALTER TABLE `tb_recuperar_senha`
  ADD CONSTRAINT `FK_TB_ADMINISTRADOR` FOREIGN KEY (`ID_ADM`) REFERENCES `tb_administrador` (`id`),
  ADD CONSTRAINT `FK_TB_LIDER_PESQUISA` FOREIGN KEY (`ID_LIDER`) REFERENCES `tb_lider_pesquisa` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
