<?php 
SESSION_START();
	
	 if (isset($_SESSION["ERRO"])){
          echo'<div class="alert alert-danger alert-dismissible"> 
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              '.$_SESSION["ERRO"].'
          </div>';
          unset($_SESSION['ERRO']);
        }

	$data =  $_POST["datavinculo"];
	$idGrupo = $_SESSION['idGrupoAtual'];
	$linhas = $_POST['arrayLinhas'];
	$id =  $_POST["IDdocente"];
	

include "abreConexao.php";
  $sql = "SELECT ID_LINHA FROM tb_linha_grupo WHERE ID_GRUPO = '$idGrupo'";
$resultado =  $conexao->query($sql);
$aux = 0;
 while($row = $resultado->fetch_assoc()){        
         if(strstr($linhas, $row['ID_LINHA'])){
            $aux = 1;
         }             
                    }
     include "fechaConexao.php";
echo $aux;
     if($aux == 0){
           $_SESSION["EXCLUSAO"] = " ERRO - TENTATIVA DE ADICIONAR LINHA DE PESQUISA QUE NÃO PERTENCE AO GRUPO ou NENHUMA LINHA DE PESQUISA FOI SELECIONADA !!" ;

                      header('location:listaDocentesGrupoLinha.php');
     }else{





   if($data == ""){
     $_SESSION["EXCLUSAO"] = "DATA INVALIDA!";
    header("location:listaDocentesGrupoLinha.php");
   }else{


	include "abreConexao.php";

	$sql = "INSERT INTO `tb_docente_grupo` (`ID`, `ID_DOCENTE_FK`, `ID_GRUPO_FK`, `DATA_CADASTRO`, `DATA_INICIO`, `DATA_TERMINO`) VALUES (0, '$id' , '$idGrupo'  , NOW(), '".$data."' , NULL);";
	$sql = $conexao->query($sql);

	

	    // PEGA ID DO ULTIMO CADASTRADO - NO CASO O DOCENTE QUE ESTÁ SENDO CADASTRADO.
                    $sql = "SELECT ID_DOCENTE_FK FROM tb_docente_grupo ORDER BY id DESC LIMIT 1";
                    $resultado = $conexao->query($sql);

                    while($row = $resultado->fetch_assoc()){
                        $UltimoDocenteCadastrado = $row['ID_DOCENTE_FK'];
                    }

                      //VINCULA AS LINHAS SELECIONADAS AO DOCENTE          
                    $arrayInicial = explode(',', $linhas);

                    foreach ($arrayInicial as $value) {
                        echo $value . '<br/>';


                           $sql = "INSERT INTO `tb_docente_linha` (`ID`, `ID_DOCENTE_FK`, `ID_LINHA_PESQUISA_FK`, `DATA_CADASTRO`, `DATA_INICIO`, `DATA_TERMINO`, `ID_GRUPO_FK`) VALUES (0, '$UltimoDocenteCadastrado', '$value', NOW() , '$data', NULL, '$idGrupo');";
                            $sql = $conexao->query($sql);

                        echo "0, '$UltimoDocenteCadastrado', '$value', NOW() , '$data', NULL, '$idGrupo');";

                    }





		$_SESSION["ALERT"] = "Docente Vinculado com sucesso!";
		header("location:cadastroDocentes.php");
	

include "fechaConexao.php";
	


}

}

 ?>