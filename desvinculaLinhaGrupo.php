<?php 

	$data =  $_POST["datadesvinculo"];

	$id =  $_POST["idReg"];

	$sql = "UPDATE tb_linha_grupo set DATA_TERMINO = '".$data."' WHERE ID = ".$id;

	include "abreConexao.php";

	if ($conexao->query($sql)) {
		header("location:cadastrolinhapesquisa.php");
	}



 ?>