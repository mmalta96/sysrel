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


if ($situacao == 2) {
          include 'abreConexao.php';

     $sql = " UPDATE `tb_grupo_pesquisa` SET `SITUACAO` = '1' WHERE `tb_grupo_pesquisa`.`ID` = $id;";
     $result = $conexao->query($sql);


$_SESSION["ALERT"] = "Grupo ativado com sucesso !! ";
                        header('location:telaMostraGrupos.php');
                  


include 'fechaConexao.php';

                     


}elseif ($situacao == 0) {

 $_SESSION["ALERT1"] = "Não foi possível ativar, pois o líder deve realizar a ativação do grupo .";
      header('location:telaMostraGrupos.php');
}



else {

      $_SESSION["ALERT1"] = "Não foi possivel ativar o grupo pois ele já se encontra ativo .";
      header('location:telaMostraGrupos.php');

}       
?>