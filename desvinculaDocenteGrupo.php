<?php 
SESSION_START();

	$data =  $_POST["datadesvinculo"];

	$id =  $_POST["idReg"];
	$idGrupo = $_SESSION['idGrupoAtual'];

	$idUsuario;
	$idRegistro;
		
		if($data == ""){
			$_SESSION["EXCLUSAO"] = "Data invalida !";
		header("location:cadastroDocentes.php");
	}else{

//SEPARA O RETORNO EM DUAS VARIAVEIS
	 $arrayInicial = explode(',', $id);
	 	$idcontador = 0;
                   foreach ($arrayInicial as $value) {
                   				if($idcontador == 0){
                   					$idRegistro = $value;
                   				}else{
                   					$idUsuario = $value;
                   				}

                   				$idcontador = 1;

                        	}




	include "abreConexao.php";

	$sql = "UPDATE tb_docente_grupo set DATA_TERMINO = '".$data."' WHERE ID = ".$idRegistro;

	$sql2 = "UPDATE tb_docente_linha set DATA_TERMINO = '$data' WHERE ID_DOCENTE_FK = '$idUsuario' AND ID_GRUPO_FK = '$idGrupo' ;";
	 $sql2 = $conexao->query($sql2);

	

	if ($conexao->query($sql)) {
		$_SESSION["ALERT"] = "Docente Desvinculado com sucesso!";
		header("location:cadastroDocentes.php");
	}

}

 ?>