<?php 
	$id = $_GET["id"];

	$sql = "DELETE FROM tb_publicacao WHERE id=".$id;

	include "abreConexao.php";

	SESSION_START();

	if ($conexao->query($sql)) {
		$_SESSION["ALERT"] = "Registro Excluído com Sucesso!";

		header("location:Publicacoes.php");
	}



 ?>