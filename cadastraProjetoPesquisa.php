<?php
	session_start();
	
	include "abreConexao.php";
	
	$tipo;
	
	if (isset($_POST["txtTipo"])) {
		$tipo = $_POST["txtTipo"];
	}
	else {
		$tipo = $_POST["cbTipo"];
	}
	
	$titulo = $_POST["txtTitulo"];
	$docente = $_POST["cbDocente"];
	$linha = $_POST["cbLinhaPesquisa"];
	$dataInicio = $_POST["dataInicio"];

	$grupo = $_SESSION["idGrupoAtual"];

	if (isset($_POST["dataFim"])){
		$dataFim = $_POST["dataFim"];

		$sql = "INSERT INTO tb_projeto_pesquisa (TITULO, TIPO, DATA_INICIO, ID_DOCENTE_FK, ID_LINHA_FK, ID_GRUPO_FK, DATA_TERMINO) VALUES('$titulo','$tipo','$dataInicio',$docente,'$linha',$grupo,'$dataFim')";
	}
	else {
		$sql = "INSERT INTO tb_projeto_pesquisa (TITULO, TIPO, DATA_INICIO, ID_DOCENTE_FK, ID_LINHA_FK, ID_GRUPO_FK) VALUES('$titulo','$tipo','$dataInicio',$docente,'$linha','$grupo')";
	}


		$conexao->query($sql);
		$_SESSION["ALERT"] = "Projeto Criado com Sucesso!";

		header("location:PROJETOS_PESQUISA.php");	
	
	
?>