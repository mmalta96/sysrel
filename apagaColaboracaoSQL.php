<?php 

	$id = $_GET["id"];

	$sql = "DELETE FROM tb_projeto_colaboracao WHERE ID = ".$id;

	include "abreConexao.php";

	$conexao->query($sql);


	

?>