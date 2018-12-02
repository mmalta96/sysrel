<?php
session_start();

$id = $_GET["idR"];


include 'abreConexao.php';


//REMOVE CONVIDADOS
$sql ="DELETE FROM tb_convidado_reuniao WHERE ID_REUNIAO_FK = '$id';";
		$sql = $conexao->query($sql);

//REMOVE DOCENTES PARTICIANTES
$sql ="DELETE FROM tb_detalhe_reuniao_docente WHERE ID_REUNIAO_FK = '$id';";
		$sql = $conexao->query($sql);

//REMOVE PAUTAS
$sql ="DELETE FROM tb_pauta WHERE ID_REUNIAO_FK = '$id';";
		$sql = $conexao->query($sql);

//REMOVE A REUNIAO
$sql ="DELETE FROM tb_reuniao WHERE ID = '$id';";
		$sql = $conexao->query($sql);


		$_SESSION["msg"] = "Excluido com Sucesso !!" ;
		                     header('location:Reunioes.php');



?>