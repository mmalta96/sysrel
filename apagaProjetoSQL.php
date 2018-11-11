<?php 

	$id = $_GET["id"];

	$sql = "DELETE FROM tb_projeto_pesquisa WHERE ID = ".$id;

	include "abreConexao.php";

	$conexao->query($sql);


	

?>