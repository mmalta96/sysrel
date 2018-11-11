<?php

   session_start();
	$id = ($_GET["id"]);

  echo $id;

      include 'abreConexao.php';

                 

                    $sql = "DELETE FROM `tb_tecnico_grupo` WHERE ID_TECNICO_FK = $id";
                     $conexao->query($sql);
                     

                    $sql = "DELETE FROM `tb_tecnico` WHERE ID = $id";
                     $conexao->query($sql);

                    $_SESSION["ALERT"] = "Tecnico removido com sucesso !! ";
                        header('location:Tecnicos.php');

include 'fechaConexao.php';

                     

?>