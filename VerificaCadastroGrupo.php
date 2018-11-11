<?php
session_start();

$idGrupoAtual=isset ($_SESSION["idGrupoAtual"])?$_SESSION["idGrupoAtual"]:"";

echo $idGrupoAtual;


$nomeGrupo = $_POST['nomegrupo'];
$sigla = $_POST['sigla'];
$lider = $_POST['lider'];
date_default_timezone_set('America/Sao_Paulo');
$dataInicio = date('Y-m-d H:i');

include 'abreConexao.php';

//Pega email do líder
$sql = "SELECT * FROM `tb_lider_pesquisa` WHERE ID = $lider;";
$resultado =  $conexao->query($sql);
if ($row = $resultado->fetch_assoc()) {
 	$email = $row["EMAIL"];	
 	$nomeLider = $row["NOME"];	
}


//Verifica se ja não salvou o grupo
$sql = "SELECT * FROM `tb_grupo_pesquisa`";

$resultado =  $conexao->query($sql);
$verificador = 0;

while($row = $resultado->fetch_assoc()){
if($row['SIGLA'] == strtoupper($sigla) ){

        $verificador = 1;
 
}

}




if ($verificador == 0) {
  
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
     $mail->Subject = 'Novo Grupo de Pesquisa';//Assunto do e-mail
 
 
     //Destinátarios
     $mail->AddAddress($email, 'Teste Sysrel');
 

     //Define o corpo do email
     $mail->MsgHTML('

        <h1 align="center">Ola, você foi atribuido como lider no grupo de pesquisa '.$nomeGrupo.'!</h1> 
        <h2 align="center"><img width="200px" height="100px" src="imagens\sysrel.png"></h2>
        <h3 align="center"><a href="http://localhost/telaMostraGruposLider.php">Clique para ativar o grupo</a></h3>


        '); 

    
 
     //Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
     //$mail->MsgHTML(file_get_contents('arquivo.html'));
 
     $mail->Send();

$logo = "padraogrupo";

$sigla = strtoupper($sigla);
     //Insere os dados do cadastro do grupo
	$sql = "INSERT INTO `tb_grupo_pesquisa` (`ID`, `SIGLA`, `NOME`, `LOGOTIPO`, `DESCRICAO`, `DATA_INICIO`, `EMAIL`, `LINK_DGP`, `SITUACAO`) VALUES (NULL, '$sigla', '$nomeGrupo', '$logo', NULL, '$dataInicio', NULL, NULL, '0');";
	$resultado =  $conexao->query($sql);

	//Pega ID do grupo qe eu acabei de inserir
	$sql = "SELECT * FROM `tb_grupo_pesquisa` ORDER BY ID DESC;  ";
	$resultado =  $conexao->query($sql);
	
	if ($row = $resultado->fetch_assoc()) {
 	$idGrupo = $row["ID"];	
 	}

    //Insere dados na tabela auxiliar
 	$sql = "INSERT INTO `tb_grupo_lider` (`ID`, `ID_GRUPO_FK`, `ID_LIDER_FK`, `DATA_INICIO`, `DATA_FIM`) VALUES (NULL, '$idGrupo', '$lider', '$dataInicio', NULL);";
	$resultado =  $conexao->query($sql);

     $_SESSION["ALERT"] = "Foi enviado um e-mail para o lider do grupo: ".$email;
     header('location:telaMostraGrupos.php');


      include 'fechaConexao.php'; 

     

    //caso apresente algum erro é apresentado abaixo com essa exceção.
    }catch (phpmailerException $e) {

      $_SESSION["ALERT"] = "O sistema não foi capaz de enviar um e-mail para: ".$email." verifique sua conexão e tente novamente.";
     header('location:telaCadastroGrupo.php');

	//Mensagem de erro costumizada do PHPMailer
    echo $e->errorMessage(); 
}


}else{

     $_SESSION["ALERT"] = "Já existe um grupo com essa sigla, tente novamente.";
     header('location:telaCadastroGrupo.php');

}
 

?>