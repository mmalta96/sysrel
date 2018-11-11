<?php 
session_start();


include 'abreConexao.php';

$lider = $_POST['lider'];
$idGrupoAtual=isset ($_SESSION["grupo"])?$_SESSION["grupo"]:"";
date_default_timezone_set('America/Sao_Paulo');
$data = date('Y-m-d H:i');



//Pega email do líder
$sql = "SELECT * FROM `tb_lider_pesquisa` WHERE ID = $lider;";
$resultado =  $conexao->query($sql);
if ($row = $resultado->fetch_assoc()) {
 	$email = $row["EMAIL"];	
 	$nomeLider = $row["NOME"];	
}


//Pega atual líder do grupo
$sql = "SELECT * FROM `tb_grupo_lider` WHERE ID_GRUPO_FK = $idGrupoAtual ORDER BY ID DESC;";
$resultado =  $conexao->query($sql);
if ($row = $resultado->fetch_assoc()) {
 	//$idLiderAntigo = $row["ID_LIDER_FK"];	
    $dataFim = $row['DATA_FIM'];
    $idLiderAntigo = $row['ID'];
}




//echo $verificador;




//Envia email
require_once("class/class.phpmailer.php"); 
$mail = new PHPMailer(true);

$mail->IsSMTP(); 
 
try {
     $mail->Host = 'mx1.hostinger.com.br';
     $mail->SMTPAuth   = true;  
     $mail->Port       = 587; 
     $mail->Username = 'contato@sysrel.tk'; 
     $mail->Password = '183461'; 
 
     //Define o remetente
     $mail->SetFrom('contato@sysrel.tk', 'Matheus - Sysrel'); 
     $mail->AddReplyTo('contato@sysrel.tk', 'Matheus - Sysrel'); 
     $mail->Subject = 'Troca de Liderança';//Assunto do e-mail
 
 
     //Destinátarios
     $mail->AddAddress($email, 'Teste Sysrel');
 

     //Define o corpo do email
     $mail->MsgHTML('

        <h1 align="center">Ola, você foi atribuido como novo lider em um grupo de pesquisa!</h1> 
        <h2 align="center"><img width="200px" height="100px" src="imagens\sysrel.png"></h2>
        <h3 align="center"><a href="http://localhost/telaMostraGruposLider.php">Clique para visualizar o grupo</a></h3>


        '); 

    
 
     //Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
     //$mail->MsgHTML(file_get_contents('arquivo.html'));
 
     $mail->Send();

//Armazena data que lider deixou o grupo
$sql = "UPDATE `tb_grupo_lider` SET `DATA_FIM` = '$data' WHERE `tb_grupo_lider`.`ID` = $idLiderAntigo;";
$resultado =  $conexao->query($sql);


    //Insere dados do novo lider
    $sql = "INSERT INTO `tb_grupo_lider` (`ID`, `ID_GRUPO_FK`, `ID_LIDER_FK`, `DATA_INICIO`, `DATA_FIM`) VALUES (NULL, '$idGrupoAtual', '$lider', '$data', NULL);";
    $resultado =  $conexao->query($sql);

     $_SESSION["ALERT"] = "Foi enviado um e-mail para o novo lider do grupo: ".$email;
     header('location:telaMostraGruposLider.php');


      include 'fechaConexao.php'; 

     

    //caso apresente algum erro é apresentado abaixo com essa exceção.
    }catch (phpmailerException $e) {

      $_SESSION["ALERT"] = "O sistema não foi capaz de enviar um e-mail para o novo lider, troca não realizada, verifique sua conexão e tente novamente.";
	header('location:telaCadastroGrupoLider?id='.$idGrupoAtual.'.php');

	//Mensagem de erro costumizada do PHPMailer
    echo $e->errorMessage(); 
}








 ?>