<?php
 include 'abreConexao.php';
   session_start();
   	
   	$IDOrientacao =  $_POST["idReg"];
	$dataFim =  $_POST["datadesvinculo"];
	$idProjeto =  $_POST["idProjeto"];


     $sql = "SELECT * FROM `tb_orientacao` WHERE ID = $IDOrientacao";
     $result = $conexao->query($sql);
     if ($row = $result->fetch_assoc()) {
     $dataInicio = $row["DATA_INICIO"];
     }

     if ($dataFim < $dataInicio) {
     	$_SESSION["ALERT1"] = "Data de desvinculamento não pode ser menor que data do vinculo";
                        header('location:discentes.php?id='.$idProjeto.''); 
     }else{

     $sql = " UPDATE `tb_orientacao` SET `DATA_TERMINO` = '$dataFim' WHERE ID = $IDOrientacao;";
     $result = $conexao->query($sql);
       
     $_SESSION["ALERT"] = "Discente inativado com sucesso !! ";
                        header('location:discentes.php?id='.$idProjeto.'');  
               }

include 'fechaConexao.php';

                     

?>