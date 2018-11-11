<?php 

	$nome = $_POST["nomeLinha"];
	$id = $_POST["idReg"];
	
	include "abreConexao.php";

	$sql = "UPDATE tb_linha_pesquisa SET NOME = '".$nome."' WHERE ID = '".$id."'"; 


	$conexao->query($sql);

	$_SESSION["ALERT"] = "Registro alterado com sucesso!";

	header("location:cadastrolinhapesquisaadm.php");



 ?>