<?php

   session_start();
	$id = ($_GET["id"]);

  echo $id;

      include 'abreConexao.php';

      $sql = "
SELECT o.ID_PROJETO_FK FROM tb_discente d inner join tb_orientacao o on d.ID = o.ID_DISCENTE_FK AND o.ID_DISCENTE_FK = $id";
$result1 = $conexao->query($sql);
if($row = $result1->fetch_assoc()) {

  $idProjeto = $row["ID_PROJETO_FK"];

  echo $idProjeto;

    }

                 

                    $sql = "DELETE FROM `tb_orientacao` WHERE ID_DISCENTE_FK = $id";
                     $conexao->query($sql);
                     

                    $sql = "DELETE FROM `tb_discente` WHERE ID = $id";
                     $conexao->query($sql);

                    $_SESSION["ALERT"] = "Discente removido com sucesso !! ";
                        header('location:discentes.php?id='.$idProjeto.'');

include 'fechaConexao.php';

                     

?>