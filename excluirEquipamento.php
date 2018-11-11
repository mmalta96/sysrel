<?php

   session_start();
	$id = ($_GET["id"]);

  echo $id;

      include 'abreConexao.php';

                 

                    $sql = "DELETE FROM `tb_equipamentos` WHERE ID = $id";
                     $conexao->query($sql);
                     

                    

                    $_SESSION["ALERT"] = "Equipamento removido com sucesso !! ";
                        header('location:equipamentos.php');

include 'fechaConexao.php';

                     

?>