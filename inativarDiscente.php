<?php
 include 'abreConexao.php';
   session_start();
   	
   	$IDOrientacao =  $_POST["idReg"];
	$data =  $_POST["datadesvinculo"];
	$idProjeto =  $_POST["idProjeto"];



     

     $sql = " UPDATE `tb_orientacao` SET `DATA_TERMINO` = '$data' WHERE ID = $IDOrientacao;";
     $result = $conexao->query($sql);
       
     $_SESSION["ALERT"] = "Discente inativado com sucesso !! ";
                        header('location:discentes.php?id='.$idProjeto.'');  
               

include 'fechaConexao.php';

                     

?>