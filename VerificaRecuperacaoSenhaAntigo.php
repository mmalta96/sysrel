<meta charset="utf-8">

<?php 

session_start();
header('Content-Type: text/html; charset=UTF-8');

$prontuario = strtoupper($_POST['prontuario']);



 include 'abreConexao.php';

//pega senha usuario
$sql1 = "SELECT SENHA FROM tb_lider_pesquisa WHERE PRONTUARIO = '".strtoupper($prontuario)."'";
$result = $conexao->query($sql1);

if ($row = $result->fetch_assoc()) {
$senha = $row["SENHA"];
}
//pega email usuario
 $sql = "SELECT EMAIL FROM tb_lider_pesquisa WHERE PRONTUARIO = '".strtoupper($prontuario)."'";
 $result = $conexao->query($sql);

//executa se o email existir
 if ($row = $result->fetch_assoc()) {
 	$email = $row["EMAIL"];

//Cria chave para recuperação de senha Prontuario+Email
$chave = sha1($prontuario.$senha);
date_default_timezone_set('America/Sao_Paulo');
$dataRecuperacao = date('Y-m-d H:i');



$sql2 = "INSERT INTO tb_recuperar_senha (ID, PRONTUARIO_LIDER, CODIGO, DTHR_ENVIO) VALUES ('0', '$prontuario', '$chave', '$dataRecuperacao');";
$result = $conexao->query($sql2);


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
     $mail->Subject = 'Bem vindo ao Sysrel - Recuperacao de Senha';//Assunto do e-mail
 
 
     //Destinátarios
     $mail->AddAddress($email, 'Teste Sysrel');
 

     //Define o corpo do email
     $mail->MsgHTML('

        <h1 align="center">Olá, link para redefinição de senha.!</h1> 
        <h2 align="center"><img width="200px" height="100px" src="imagens\sysrel.png"></h2>
        <h3 align="center"><a href="http://localhost/cadastrosenharecuperacao.php?chave='.$chave.'">Link para recuperação de senha</a></h3>


        '); 

    
 
     ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
     //$mail->MsgHTML(file_get_contents('arquivo.html'));
 
     $mail->Send();
     //$_SESSION["ALERT"] = "Foi enviado um e-mail com o link de redefinição para: ".$email;
    // header('location:index.php?');
     

    //caso apresente algum erro é apresentado abaixo com essa exceção.
    }catch (phpmailerException $e) {
      echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
}



 }else {

	//$_SESSION["ALERT"] = "O Prontuario digitado não consta em nosso banco de dados. ".$email;
     //header('location:telaRecuperacaoSenha.php');
 }



 include 'fechaConexao.php'; 

 ?>