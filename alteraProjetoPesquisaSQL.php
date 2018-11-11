<?php
		SESSION_START();
		include "abreConexao.php";
	
		$tipo;

		if (isset($_GET["txtTipo"])) {
			$tipo = $_GET["txtTipo"];
		}
		else {
			$tipo = $_GET["cbTipo"];
		}

		$id =  $_GET["id"];
		$titulo = $_GET["txtTitulo"];
		$docente = $_GET["cbDocente"];
		$linha = $_GET["cbLinhaPesquisa"];
		$dataInicio = $_GET["dataInicio"];
		$dataFim = $_GET["dataFim"];

		$grupo = $_SESSION["idGrupoAtual"];


			$sql = "UPDATE tb_projeto_pesquisa SET TITULO='$titulo', TIPO='$tipo', DATA_INICIO='$dataInicio', ID_DOCENTE_FK=$docente, ID_LINHA_FK='$linha', ID_GRUPO_FK=$grupo, DATA_TERMINO='$dataFim' WHERE ID=".$id;

			$sql = "UPDATE tb_projeto_pesquisa SET TITULO='$titulo', TIPO='$tipo', DATA_INICIO='$dataInicio', ID_DOCENTE_FK=$docente, ID_LINHA_FK='$linha', ID_GRUPO_FK=$grupo, DATA_TERMINO='$dataFim' WHERE ID=".$id;


			$conexao->query($sql);
			$_SESSION["ALERT"] = "Projeto Alterado com Sucesso!";

			header("location:PROJETOS_PESQUISA.php");	
		


?>