<?php 

	$linhas = $_POST["linhas"];

	include "abreConexao.php";

	$sql = "DELETE FROM tb_linha_pesquisa WHERE ID IN(".$linhas.")"; 

	if ($conexao->query($sql)){
		$_SESSION["ALERT"] = "Registros excluídos com sucesso!";
	}
	else {
		$_SESSION["ALERT"] = "Alguma linha está vinculada, verifique!";	
	}

	

	header("location:cadastrolinhapesquisaadm.php");

 ?>	