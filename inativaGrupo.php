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


if ($situacao == 1) {
          include 'abreConexao.php';

     $sql = " UPDATE `tb_grupo_pesquisa` SET `SITUACAO` = '2' WHERE `tb_grupo_pesquisa`.`ID` = $id;";
     $result = $conexao->query($sql);


$_SESSION["ALERT"] = "Grupo inativado com sucesso !! ";
                        header('location:telaMostraGrupos.php');
                  


include 'fechaConexao.php';

                     


}elseif ($situacao == 2) {

 $_SESSION["ALERT1"] = "Não foi possivel remover o grupo pois ele já está inativo .";
      header('location:telaMostraGrupos.php');
}



else {

      $_SESSION["ALERT1"] = "Não foi possivel remover o grupo pois ele ainda não foi ativo pelo líder .";
      header('location:telaMostraGrupos.php');

}       
?>