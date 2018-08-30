CREATE DATABASE BD_SYSREL;
USE BD_SYSREL;

CREATE TABLE TB_TELAS (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  DESCRICAO VARCHAR(50) NOT NULL,
  CAMINHO VARCHAR(100) NULL
);

CREATE TABLE TB_PERMISSAO_TELAS (
  ID_TELA_FK INT PRIMARY KEY,
  ADM BIT,
  LIDER BIT
);

ALTER TABLE TB_PERMISSAO_TELAS ADD CONSTRAINT FK_TB_TELAS FOREIGN KEY (ID_TELA_FK) REFERENCES TB_TELAS(ID);

CREATE TABLE TB_LIDER_PESQUISA (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  NOME VARCHAR(80) NOT NULL,
  PRONTUARIO VARCHAR(12) NOT NULL,
  EMAIL VARCHAR(45) NOT NULL,
  SENHA VARCHAR(64) NOT NULL,
  SENHA_ANTIGA VARCHAR(64) NULL,
  ERROS_LOGIN INT NULL
);

CREATE TABLE TB_ADMINISTRADOR (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  EMAIL VARCHAR(45) NOT NULL,
  SENHA VARCHAR(64) NOT NULL,
  SENHA_ANTIGA VARCHAR(64) NULL,
  ERROS_LOGIN INT NULL
);

CREATE TABLE TB_RECUPERAR_SENHA (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  ID_LIDER INT NULL,
  ID_ADM INT NULL,
  CODIGO VARCHAR(10) NOT NULL,
  DTHR_ENVIO DATETIME NOT NULL
);

ALTER TABLE TB_RECUPERAR_SENHA ADD CONSTRAINT FK_TB_LIDER_PESQUISA FOREIGN KEY (ID_LIDER) REFERENCES TB_LIDER_PESQUISA(ID);
ALTER TABLE TB_RECUPERAR_SENHA ADD CONSTRAINT FK_TB_ADMINISTRADOR FOREIGN KEY (ID_ADM) REFERENCES TB_ADMINISTRADOR(ID);

INSERT INTO `tb_telas` (`ID`,`DESCRICAO`,`CAMINHO`) VALUES (1,'Cadastro de Usuários','cadastrousuarios.php');
INSERT INTO `tb_telas` (`ID`,`DESCRICAO`,`CAMINHO`) VALUES (2,'Permissões de Usuário','permissoes.php');
INSERT INTO `tb_telas` (`ID`,`DESCRICAO`,`CAMINHO`) VALUES (3,'Cadastro de Grupo de Pesquisa','cadastrogrupopesquisa.php');
INSERT INTO `tb_telas` (`ID`,`DESCRICAO`,`CAMINHO`) VALUES (4,'Cadastro de Linhas de Pesquisa','cadastrolinhapesquisa.php');
INSERT INTO `tb_telas` (`ID`,`DESCRICAO`,`CAMINHO`) VALUES (5,'Cadastro de Técnicos','cadastrotecnicos.php');
INSERT INTO `tb_telas` (`ID`,`DESCRICAO`,`CAMINHO`) VALUES (6,'Cadastro de Docentes','cadastrodocentes.php');
INSERT INTO `tb_telas` (`ID`,`DESCRICAO`,`CAMINHO`) VALUES (7,'Cadastro de Discentes','cadastrodiscentes.php');
INSERT INTO `tb_telas` (`ID`,`DESCRICAO`,`CAMINHO`) VALUES (8,'Cadastro de Projetos de Pesquisa','cadastroprojetos.php');
INSERT INTO `tb_telas` (`ID`,`DESCRICAO`,`CAMINHO`) VALUES (9,'Cadastro de Publicações','cadastropublicacoes.php');
INSERT INTO `tb_telas` (`ID`,`DESCRICAO`,`CAMINHO`) VALUES (10,'Cadastro de Equipamentos','cadastroequipamentos.php');
INSERT INTO `tb_telas` (`ID`,`DESCRICAO`,`CAMINHO`) VALUES (11,'Cadastro de Reuniões','cadastroreunioes.php');
INSERT INTO `tb_telas` (`ID`,`DESCRICAO`,`CAMINHO`) VALUES (12,'Relatório','relatorio.php');


INSERT INTO `bd_sysrel`.`tb_permissao_telas` (`ID_TELA_FK`, `ADM`, `LIDER`) VALUES ('1', b'1', b'1');
INSERT INTO `bd_sysrel`.`tb_permissao_telas` (`ID_TELA_FK`, `ADM`, `LIDER`) VALUES ('2', b'1', b'1');
INSERT INTO `bd_sysrel`.`tb_permissao_telas` (`ID_TELA_FK`, `ADM`, `LIDER`) VALUES ('3', b'1', b'1');
INSERT INTO `bd_sysrel`.`tb_permissao_telas` (`ID_TELA_FK`, `ADM`, `LIDER`) VALUES ('4', b'1', b'1');
INSERT INTO `bd_sysrel`.`tb_permissao_telas` (`ID_TELA_FK`, `ADM`, `LIDER`) VALUES ('5', b'1', b'1');
INSERT INTO `bd_sysrel`.`tb_permissao_telas` (`ID_TELA_FK`, `ADM`, `LIDER`) VALUES ('6', b'1', b'1');
INSERT INTO `bd_sysrel`.`tb_permissao_telas` (`ID_TELA_FK`, `ADM`, `LIDER`) VALUES ('7', b'1', b'1');
INSERT INTO `bd_sysrel`.`tb_permissao_telas` (`ID_TELA_FK`, `ADM`, `LIDER`) VALUES ('8', b'1', b'1');
INSERT INTO `bd_sysrel`.`tb_permissao_telas` (`ID_TELA_FK`, `ADM`, `LIDER`) VALUES ('9', b'1', b'1');
INSERT INTO `bd_sysrel`.`tb_permissao_telas` (`ID_TELA_FK`, `ADM`, `LIDER`) VALUES ('10', b'1', b'1');
INSERT INTO `bd_sysrel`.`tb_permissao_telas` (`ID_TELA_FK`, `ADM`, `LIDER`) VALUES ('11', b'1', b'1');
INSERT INTO `bd_sysrel`.`tb_permissao_telas` (`ID_TELA_FK`, `ADM`, `LIDER`) VALUES ('12', b'1', b'1');
