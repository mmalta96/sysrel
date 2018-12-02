<?php 
	session_start();

	$idlinha = $_POST["idLinha"];

	$dataInicio = $_POST["dataInicio"];

	$descricao = $_POST["txtDescricao"];

	$idGrupo = $_SESSION['idGrupoAtual'];

	include 'abreConexao.php';

	$sql = "SELECT lg.ID from tb_linha_grupo lg where DATA_TERMINO is null and lg.ID_LINHA = (SELECT ID FROM tb_linha_pesquisa WHERE ID LIKE '%".$idlinha."%') and lg.ID_GRUPO = ".$idGrupo;	

	$result = $conexao->query($sql);

	if ($result->fetch_assoc()) {
		$_SESSION["ALERT"] = "Esta linha de pesquisa já se encontra vinculada!";
	}
	else {
		$sql = "INSERT INTO tb_linha_grupo values (0, (select id from tb_linha_pesquisa where ID like '%".$idlinha."%'),".$idGrupo.",NOW(),'".$dataInicio."',NULL,'".$descricao."');";

		$conexao->query($sql);

		$_SESSION["ALERT"] = "Linha vinculada com sucesso!";

	}

	
	header("location:cadastrolinhapesquisa.php");


 ?>