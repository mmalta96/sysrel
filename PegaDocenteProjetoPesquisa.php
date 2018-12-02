<?php 
	session_start();

	include 'abreConexao.php';

	$idGrupo = $_SESSION["idGrupoAtual"];
	$idProjeto = $_POST['id'];
	
              
                include 'abreConexao.php';

                $sql = "SELECT dc.NOME, dc.ID, LP.NOME AS LINHA, LP.ID AS ID_LINHA

                      FROM tb_projeto_pesquisa pp
						
                      INNER JOIN tb_linha_pesquisa LP
                      ON LP.ID = pp.ID_LINHA_FK
                        
                      inner join tb_docentes dc
                      ON dc.ID = pp.ID_DOCENTE_FK
                      AND pp.ID = '$idProjeto'
                      AND pp.ID_GRUPO_FK = '$idGrupo' ";
              
     	$result = $conexao->query($sql);
	//alimenta o Input Text Docente. 
	$string = "	";
	while($row = $result->fetch_assoc()) {
		$string = $row["NOME"]."|".$row["LINHA"]."|".$row["ID_LINHA"]."|".$row["ID"];
	}
		
	echo $string;

 ?>