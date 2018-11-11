<?php 


	$nome = $_POST["txtnome"];
	$id = $_POST["txtid"];
	
	include "abreConexao.php";

	$sql = "INSERT INTO tb_linha_pesquisa VALUES('".$nome."','" . $id."')"; 

	$conexao->query($sql);

	$_SESSION["ALERT"] = "Registro cadastrado com sucesso!";

	header("location:cadastrolinhapesquisaadm.php");



 ?>