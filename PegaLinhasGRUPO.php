<?php 
	session_start();

	include 'abreConexao.php';

	$idGrupo = $_SESSION["idGrupoAtual"];
	$idDocente= $_POST['id'];
	
              
                include 'abreConexao.php';

                $sql = "SELECT L.ID, L.NOME 
                      FROM tb_linha_pesquisa L

                      INNER JOIN tb_linha_grupo GL
                      ON GL.ID_LINHA = L.ID
                      AND GL.ID_GRUPO = '$idGrupo'

					 ";
              
	$result = $conexao->query($sql);
	//alimenta a combo as Linhas do Docente
	$string = "";
	while($row = $result->fetch_assoc()) {
		$string = $string. '<option value="'.$row["ID"].'">'.$row["NOME"].'</option>';
	}
		
	echo $string;



 ?>