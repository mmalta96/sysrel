<?php
session_start();
$idGrupo = $_SESSION['idGrupoAtual'];

 include 'abreConexao.php';

	$vetor = $_POST["campo"];
	$vetor2 = $_POST["campoPauta"];
	$Tipo = $_POST["TipoReuniao"];
	$DtaInicio = $_POST["DataInicio"];
	$HoraInicio = $_POST["Hinicio"];
	$HoraFIM = $_POST["Hfim"];
	$Ata = $_POST["ata"];
	$Docentes = $_POST['arrayLinhas'];

$date = DateTime::createFromFormat('d/m/Y H:i', $DtaInicio);
$date =  $date->format('Y-m-d H:i:s');



	if($Tipo == 0){
		$sql ="INSERT INTO `tb_reuniao` (`ID`, `DATA`, `ID_GRUPO_FK`) VALUES (0, '$date', '$idGrupo');";
		$sql = $conexao->query($sql);

	

	    // PEGA ID DA ULTIMA REUNIAO - NO CASO A QUE ESTÁ SENDO CADASTRADA.
                    $sql = "SELECT ID FROM tb_reuniao ORDER BY id DESC LIMIT 1";
                    $resultado = $conexao->query($sql);

                    while($row = $resultado->fetch_assoc()){
                        $UltimoReuniao = $row['ID'];
                    }

     //INSERE PAUTAS NA REUNIÃO


	
	$contador = count($vetor2); 
	for($i=0;$i<$contador;$i++) 
	{ 
	 
		 $Paulta = $vetor2[$i];

	
	 $sql ="INSERT INTO `tb_pauta` (`ID`, `DESCRICAO`, `ID_REUNIAO_FK`) VALUES (0, '$Paulta', '$UltimoReuniao');";
	 $sql = $conexao->query($sql);

	    
	}

    $_SESSION["msg"] = "REUNIÃO CADASTRADA COM SUCESSO !!" ;
                     header('location:Reunioes.php');
}else{
	$sql ="INSERT INTO `tb_reuniao` (`ID`, `DATA`, `ID_GRUPO_FK`) VALUES (0, '$date', '$idGrupo');";
		$sql = $conexao->query($sql);

	

	    // PEGA ID DA ULTIMA REUNIAO - NO CASO A QUE ESTÁ SENDO CADASTRADA.
                    $sql = "SELECT ID FROM tb_reuniao ORDER BY id DESC LIMIT 1";
                    $resultado = $conexao->query($sql);

                    while($row = $resultado->fetch_assoc()){
                        $UltimoReuniao = $row['ID'];
                    }

     //INSERE PAUTAS NA REUNIÃO


	
	$contador = count($vetor2); 
	for($i=0;$i<$contador;$i++) 
	{ 
	 
		 $Paulta = $vetor2[$i];

	
	 $sql ="INSERT INTO `tb_pauta` (`ID`, `DESCRICAO`, `ID_REUNIAO_FK`) VALUES (0, '$Paulta', '$UltimoReuniao');";
	 $sql = $conexao->query($sql);

	    
	}

	     //INSERE CONVIDADOS NA REUNIÃO

	$contador = count($vetor); 
	for($i=0;$i<$contador;$i++) 
	{ 
	 
		 $Convidado = $vetor[$i];
		 if($vetor[$i] != ""){
	
	 $sql ="INSERT INTO `tb_convidado_reuniao` (`ID`, `NOME`, `ID_REUNIAO_FK`) VALUES (0, '$Convidado', '$UltimoReuniao');";
	 $sql = $conexao->query($sql);
	 						}

	    
	}


	//SALVA DETALHES
	$sql ="INSERT INTO `tb_detalhe_reuniao` (`ID`, `ID_REUNIAO_FK`, `HORA_INICIO`, `HORA_FIM`, `ATA`, `FINALIZACAO`) VALUES (0, '$UltimoReuniao', '$HoraInicio', '$HoraFIM', '$Ata', 1);";
	 $sql = $conexao->query($sql);


	 //SALVA OS DOCENTES PARTICIPANTES         
                    $arrayInicial = explode(',', $Docentes);

                    foreach ($arrayInicial as $value) {
                        echo $value . '<br/>';


                           $sql = "INSERT INTO `tb_detalhe_reuniao_docente` (`ID`, `ID_REUNIAO_FK`, `ID_DOCENTE_FK`) VALUES (0, '$UltimoReuniao', '$value');";
                            $sql = $conexao->query($sql);

                        

                    }

		$_SESSION["msg"] = "REUNIÃO CADASTRADA COM SUCESSO !!" ;
		                     header('location:Reunioes.php');


}

?>