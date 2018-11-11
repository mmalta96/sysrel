<?php 
	session_start();

	include 'abreConexao.php';

	$idGrupo = $_SESSION["idGrupoAtual"];
	$idDocente= $_POST['id'];
	
              
                include 'abreConexao.php';

                $sql = "SELECT L.ID, L.NOME 
					FROM tb_linha_pesquisa L

					INNER JOIN tb_docente_linha DL
					ON DL.ID_LINHA_PESQUISA_FK = L.ID
					AND DL.ID_DOCENTE_FK = '$idDocente'
					AND DL.ID_GRUPO_FK = '$idGrupo'

					 ";
              
	$result = $conexao->query($sql);
	//alimenta a combo as Linhas do Docente
	$string = "";
	while($row = $result->fetch_assoc()) {
		$string = $string. '<option value="'.$row["ID"].'">'.$row["NOME"].'</option>';
	}
		
	echo $string;



 ?>