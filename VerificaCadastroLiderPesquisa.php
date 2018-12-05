<!--CODIGO DESENVOLVIDO POR MATHEUS -->
<?php 
session_start();
header('Content-Type: text/html; charset=UTF-8');
   


//função senha - envia no primeiro acesso
 function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
  $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
  $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
  $nu = "0123456789"; // $nu contem os números
  $si = "!@#$%¨&*()_+="; // $si contem os símbolos
  $senha = "0";
  if ($maiusculas){
        // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
        $senha .= str_shuffle($ma);
  }
 
    if ($minusculas){
        // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
        $senha .= str_shuffle($mi);
    }
 
    if ($numeros){
        // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
        $senha .= str_shuffle($nu);
    }
 
    if ($simbolos){
        // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
        $senha .= str_shuffle($si);
    }
 
    // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
    return substr(str_shuffle($senha),0,$tamanho);
}


//Pega as variaveis do formulario
$nomelider = $_POST['nomelider'];
$prontuario = strtoupper($_POST['prontuario']);
$email = $_POST['email'];
$senha = gerar_senha(6, true, true, true, false);
date_default_timezone_set('America/Sao_Paulo');
$dataCadastro = date('Y-m-d H:i');


include 'abreConexao.php';

//VERIFICA SE JÁ NÃO SALVOU ESTE USUARIO
$sql = "SELECT * FROM `tb_lider_pesquisa`";

$resultado =  $conexao->query($sql);
$verificador = 0;

while($row = $resultado->fetch_assoc()){
if($row['PRONTUARIO'] == strtoupper($prontuario) || $row['EMAIL'] == strtolower($email)){

        $verificador = 1;
 
}

}

include 'fechaConexao.php';

if($verificador == 1){
      $_SESSION["ALERT"] = "Esse usuário já esta cadastrado!";
    header('location:telaCadastroLiderPesquisa.php?');
 

}else{ //Envia o e-mail e cadastra caso consiga enviar

//Envia email com primeira senha
require_once("class/class.phpmailer.php"); 
$mail = new PHPMailer(true);

 

$mail->IsSMTP(); 
 
try {
     $mail->Host = 'mx1.hostinger.com.br';
     $mail->SMTPAuth   = true;  
     $mail->Port       = 587; 
     $mail->Username = 'contato@sysrel.ml'; 
     $mail->Password = '183461'; 
 
     //Define o remetente
     $mail->SetFrom('contato@sysrel.ml', 'Matheus - Sysrel'); 
     $mail->AddReplyTo('contato@sysrel.ml', 'Matheus - Sysrel'); 
     $mail->Subject = 'Bem vindo ao Sysrel - Primeiro Acesso';//Assunto do e-mail
 
 
     //Destinátarios
     $mail->AddAddress($email, 'Teste Sysrel');
 

     //Define o corpo do email
     $mail->MsgHTML('Ola '.$nomelider.', voce foi cadastrado com sucesso!</h1> <h2 align="center"><img width="200px" height="100px" src="imagens\sysrel.png"></h2> <h2 style="color:Tomato;" align="center">Sua senha de acesso e: '.$senha.'</h2>    <h3 align="center"><a href="localhost//login.php">Clique aqui para acessar.</a> </h3>'); 

    
 
     ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
     //$mail->MsgHTML(file_get_contents('arquivo.html'));
 
     $mail->Send();
     include 'abreConexao.php';

     //Salva Registros no banco
    $sql = "INSERT INTO tb_lider_pesquisa (`ID`, `NOME`, `PRONTUARIO`, `EMAIL`, `DATA_CADASTRO`, `CLATTES`, `FOTO`, `SENHA`, `SENHA_ANTIGA`, `ERROS_LOGIN`) VALUES (0, '$nomelider', '$prontuario', '$email', '$dataCadastro', NULL, NULL, '$senha', NULL, 0);";
    $sql = $conexao->query($sql);
    include 'fechaConexao.php';

     $_SESSION["ALERT"] = "Lider cadastrado com sucesso. A senha para primeiro acesso foi enviada para o e-mail:".$email;
      header('location:index_logado.php?');

     

    //caso apresente algum erro é apresentado abaixo com essa exceção.
    }catch (phpmailerException $e) {
      $_SESSION["ALERT"] = "O sistema não foi capaz de enviar um e-mail para: ".$email." verifique sua conexão e tente novamente.";
      echo $e->errorMessage();        //Mensagem de erro costumizada do PHPMailer
      header('location:telaCadastroLiderPesquisa.php?');
}
}




 ?>






