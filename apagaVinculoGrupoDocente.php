<?php 
	SESSION_START();
	
	
	$idGrupo = $_SESSION['idGrupoAtual'];
	$id = $_GET["id"];
	$idUsuario = $_GET["idUser"];

	include "abreConexao.php";

	$sql = "DELETE FROM tb_docente_grupo WHERE id=".$id;
	$sql = $conexao->query($sql);

	$sql2 = "DELETE FROM tb_docente_linha WHERE ID_GRUPO_FK= '$idGrupo' and ID_DOCENTE_FK = $idUsuario;";
	$sql2 = $conexao->query($sql2);
	
	$sql3 = "DELETE FROM tb_docentes WHERE ID = '$idUsuario'";
	$sql3 = $conexao->query($sql3);

	
		$_SESSION["ALERT"] = "Registro Excluído com Sucesso!";


		header("location:cadastroDocentes.php");
	



 ?>