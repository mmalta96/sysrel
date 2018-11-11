<?php 

	$vetor = $_POST["arrayLinhas"];

	$projeto = $_POST["projeto"];

	echo $vetor;

	$vetor = explode(",", $vetor);

	include "abreConexao.php";

	

	foreach ($vetor as $valor) {
		$sql = "INSERT INTO tb_projeto_colaboracao (ID_DOCENTE_FK , ID_PROJETO_FK) VALUES ($valor,$projeto)";
		$conexao->query($sql);
	}


	header('location:ColaboracaoProjetoPesquisa.php?id='.$projeto.'');

?>