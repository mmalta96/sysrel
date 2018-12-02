<?php 
    session_start();

     $idGrupoAtual = $_GET['id'];

$_SESSION['idGrupoAtual']=$idGrupoAtual;
$paginaAtual = $_SESSION["PAGINA_ATUAL"];


header("location:$paginaAtual");



 ?>