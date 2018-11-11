<?php

  
session_start();


    include 'abreConexao.php';
     $idGrupo = $_SESSION['idGrupoAtual'];

    $tituloP = $_POST['Titulo'];
    $ProjetoPesquisa = $_POST['cbProj'];
    $Tipo = $_POST['TipoPublic'];
    $Docente =  $_POST['DocentesDisp'];
    $Linha =  $_POST['LinhaPesquisa'];
    $Referencia =  $_POST['Referencias'];
    $Data = $_POST['data'];
    $id = $_POST['idPub'];
 
    $sql = "UPDATE `tb_publicacao` SET `TITULO` = '$tituloP', `REFERENCIAS` = '$Referencia', `ID_PROJETO_FK` = '$ProjetoPesquisa', `TIPO` = '$Tipo', `ID_DOCENTE_FK` = '$Docente', `ID_LINHA_FK` = '$Linha', `DATA_PUBLICACAO` = '$Data', `ID_GRUPO_FK` = '$idGrupo' WHERE `tb_publicacao`.`ID` = '$id' ;";
    $sql = $conexao->query($sql);

    ECHO  $tituloP.",<br>".$Tipo.",<br>". $Data.",<br>".$Referencia.",<br>".$ProjetoPesquisa.",<br>".$Docente.",<br>".$Linha;
    echo "<br>".$id;
    echo "<br>".$idGrupo;

                    $_SESSION["ALERT"] = "PUBLICAÇÃO EDITADA COM SUCESSO !!" ;
                     header('location:PUBLICACOES.php');

include 'fechaConexao.php';
?>

