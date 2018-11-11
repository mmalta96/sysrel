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


    if($Linha == 0){
         $_SESSION["ALERT"] = " ERRO - Linha de pesquisa Vazia ! " ;
                     header('location:CadastrarPublicacoes.php');
    }else{
    $sql = "INSERT INTO `tb_publicacao` (`ID`, `TITULO`, `TIPO`, `DATA_PUBLICACAO`, `REFERENCIAS`, `ID_PROJETO_FK`, `ID_DOCENTE_FK`, `ID_LINHA_FK`, `ID_GRUPO_FK` ) VALUES (0, '$tituloP', '$Tipo', '$Data', '$Referencia', '$ProjetoPesquisa', '$Docente', '$Linha', '$idGrupo');";
    $sql = $conexao->query($sql);

    ECHO  $tituloP.",<br>".$Tipo.",<br>". $Data.",<br>".$Referencia.",<br>".$ProjetoPesquisa.",<br>".$Docente.",<br>".$Linha;


                    $_SESSION["ALERT"] = "PUBLICAÇÃO CADASTRADA COM SUCESSO !!" ;
                     header('location:PUBLICACOES.php');
}



include 'fechaConexao.php';
?>

