<?php
 include 'abreConexao.php';
   session_start();
   	$id =  $_POST["idReg"];
	$data =  $_POST["datadesvinculo"];


echo $data;

     

     $sql = " UPDATE `tb_tecnico_grupo` SET `DATA_TERMINO` = '$data' WHERE ID_TECNICO_FK = $id;";
     $result = $conexao->query($sql);
       
     $_SESSION["ALERT"] = "Tecnico inativado com sucesso !! ";
                        header('location:Tecnicos.php');
               

include 'fechaConexao.php';

                     

?>