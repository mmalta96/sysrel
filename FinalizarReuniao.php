<?php
session_start();
$idGrupo = $_SESSION['idGrupoAtual'];

 include 'abreConexao.php';

	$vetor = $_POST["campoF"];
	$HoraInicio = $_POST["Hinicio"];
	$HoraFIM = $_POST["Hfim"];
	$Ata = $_POST["ata"];
	$Docentes = $_POST['arrayLinhas'];
	$IdReuniao = $_POST['idReuniaoF'];





	


	     //INSERE CONVIDADOS NA REUNIÃO

	$contador = count($vetor); 
	for($i=0;$i<$contador;$i++) 
	{ 
	 
		 $Convidado = $vetor[$i];
		 if($vetor[$i] != ""){
	
	 $sql ="INSERT INTO `tb_convidado_reuniao` (`ID`, `NOME`, `ID_REUNIAO_FK`) VALUES (0, '$Convidado', '$IdReuniao');";
	 $sql = $conexao->query($sql);
	 					}
	    
	}


	//SALVA DETALHES
	$sql ="INSERT INTO `tb_detalhe_reuniao` (`ID`, `ID_REUNIAO_FK`, `HORA_INICIO`, `HORA_FIM`, `ATA`, `FINALIZACAO`) VALUES (0, '$IdReuniao', '$HoraInicio', '$HoraFIM', '$Ata', 1);";
	 $sql = $conexao->query($sql);


	 //SALVA OS DOCENTES PARTICIPANTES         
                    $arrayInicial = explode(',', $Docentes);

                    foreach ($arrayInicial as $value) {
                        echo $value . '<br/>';


                           $sql = "INSERT INTO `tb_detalhe_reuniao_docente` (`ID`, `ID_REUNIAO_FK`, `ID_DOCENTE_FK`) VALUES (0, '$IdReuniao', '$value');";
                            $sql = $conexao->query($sql);

                        

                    }

		$_SESSION["msg"] = "REUNIÃO FINALIZADA COM SUCESSO !!" ;
		                     header('location:Reunioes.php');




?>