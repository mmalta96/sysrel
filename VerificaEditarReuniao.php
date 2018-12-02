<?php 
session_start();

$vetor2 = $_POST["campoPauta2"];
$contador = count($vetor2); 
	for($i=0;$i<$contador;$i++) 
	{ 
	 
		ECHO $vetor2[$i].",";
	}


	$idReuniao = $_POST["idReuniao"];
	$idGrupo = $_SESSION["idGrupoAtual"];
	$DtaInicio = $_POST["DataInicio"];
$date = DateTime::createFromFormat('d/m/Y H:i', $DtaInicio);
$date =  $date->format('Y-m-d H:i:s');


 include 'abreConexao.php';

	





	
		$sql ="UPDATE `tb_reuniao` SET `DATA` = '$DtaInicio' WHERE `tb_reuniao`.`ID` = '$idReuniao';";
		$sql = $conexao->query($sql);

	

	//REMOVE TODAS AS PAUTAS DA REUNIÃO
		$sql ="DELETE FROM tb_pauta where ID_REUNIAO_FK = '$idReuniao';";
		$sql = $conexao->query($sql);
		


     //INSERE AS NOVAS PAUTAS NA REUNIÃO
	$contador = count($vetor2); 
	for($i=0;$i<$contador;$i++) 
	{ 
	 
		 $Paulta = $vetor2[$i];

	
	 $sql ="INSERT INTO `tb_pauta` (`ID`, `DESCRICAO`, `ID_REUNIAO_FK`) VALUES (0, '$Paulta', '$idReuniao');";
	 $sql = $conexao->query($sql);

	    
	}

    $_SESSION["msg"] = "REUNIÃO EDITADA COM SUCESSO !!" ;
                     header('location:Reunioes.php');


 ?>