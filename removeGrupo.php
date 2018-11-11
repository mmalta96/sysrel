<?php

   session_start();
	$id = ($_GET["id"]);

      include 'abreConexao.php';


     $sql = "SELECT * FROM `tb_grupo_pesquisa` WHERE ID = $id";
     $result = $conexao->query($sql);
     if ($row = $result->fetch_assoc()) {
     $situacao = $row["SITUACAO"];
     }

     include 'fechaConexao.php';


if ($situacao == 0) {
          include 'abreConexao.php';
        

                  

                    $sql = "DELETE FROM `tb_grupo_lider` WHERE ID_GRUPO_FK = $id";
                     $conexao->query($sql);
                     

                    $sql = "DELETE FROM `tb_grupo_pesquisa` WHERE ID = $id";
                     $conexao->query($sql);

                    $_SESSION["ALERT"] = "Grupo removido com sucesso !! ";
                        header('location:telaMostraGrupos.php');

include 'fechaConexao.php';

                     


}elseif ($situacao == 2) {
   $_SESSION["ALERT1"] = "Não foi possivel remover o grupo, só pode ser excluido caso não tenha sido ativado .";
      header('location:telaMostraGrupos.php');
  
}


else{

      $_SESSION["ALERT1"] = "Não foi possivel remover o grupo, só pode ser excluido caso não tenha sido ativado .";
      header('location:telaMostraGrupos.php');

}       
?>