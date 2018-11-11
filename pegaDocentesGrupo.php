<?php 
	session_start();

	include 'abreConexao.php';

	$idGrupo = $_SESSION["idGrupoAtual"];

	$sql = "SELECT D.ID, D.NOME FROM tb_docentes D inner join tb_docente_grupo DG on D.ID = DG.ID_DOCENTE_FK AND DG.ID_GRUPO_FK = ".$idGrupo;

	$result = $conexao->query($sql);
	//alimenta a combo com os docentes do grupo  
	$string = "";
	while($row = $result->fetch_assoc()) {
		$string = $string. '<option value="'.$row["ID"].'">'.$row["NOME"].'</option>';
	}
		
	echo $string;

 ?>