<?php 
session_start();
header('Content-Type: text/html; charset=UTF-8');

$prontuarioLogin = $_POST['prontuarioLogin'];

echo strtoupper($prontuarioLogin);

$email = NULL;
$senha = NULL;
$ID = NULL;


include 'abreConexao.php';

$sql = "SELECT * FROM `tb_administrador`";

$resultado =  $conexao->query($sql);
$verificador = 0;

while($row = $resultado->fetch_assoc()){
if($row['LOGIN'] == strtoupper($prontuarioLogin)){

        $verificador = 1;
 
}
}

$sql = "SELECT * FROM `tb_lider_pesquisa`";

$resultado =  $conexao->query($sql);

while($row = $resultado->fetch_assoc()){
if($row['PRONTUARIO'] == strtoupper($prontuarioLogin)){

        $verificador = 2;
 
}
}


if ($verificador == 0) {
echo "Usuario não localizado";


}else if($verificador == 1){
//Se for administrador

$sql = "SELECT EMAIL FROM tb_administrador WHERE LOGIN = '".strtoupper($prontuarioLogin)."'";
 $result = $conexao->query($sql);

//executa se o email existir
 if ($row = $result->fetch_assoc()) {
    $email = $row["EMAIL"];
}

$sql = "SELECT SENHA FROM tb_administrador WHERE LOGIN = '".strtoupper($prontuarioLogin)."'";
 $result = $conexao->query($sql);

//executa se o email existir
 if ($row = $result->fetch_assoc()) {
    $senha = $row["SENHA"];
}

$sql = "SELECT ID FROM tb_administrador WHERE LOGIN = '".strtoupper($prontuarioLogin)."'";
 $result = $conexao->query($sql);

//executa se o email existir
 if ($row = $result->fetch_assoc()) {
    $ID = $row["ID"];
}




}else if($verificador == 2){
//Se for lider


$sql = "SELECT EMAIL FROM tb_lider_pesquisa WHERE PRONTUARIO = '".strtoupper($prontuarioLogin)."'";
 $result = $conexao->query($sql);

//executa se o email existir
 if ($row = $result->fetch_assoc()) {
    $email = $row["EMAIL"];
}

$sql = "SELECT SENHA FROM tb_lider_pesquisa WHERE PRONTUARIO = '".strtoupper($prontuarioLogin)."'";
 $result = $conexao->query($sql);

//executa se o email existir
 if ($row = $result->fetch_assoc()) {
    $senha = $row["SENHA"];
}

$sql = "SELECT ID FROM tb_lider_pesquisa WHERE PRONTUARIO = '".strtoupper($prontuarioLogin)."'";
 $result = $conexao->query($sql);

//executa se o email existir
 if ($row = $result->fetch_assoc()) {
    $ID = $row["ID"];


echo "Usuario é um lider";     
}
}

$chave = sha1($email.$senha);
date_default_timezone_set('America/Sao_Paulo');
$dataRecuperacao = date('Y-m-d H:i');


//MASCARA EMAIl

 function mascara($email){

// vamos separar a string em 2 partes com explode

$mascara = explode("@", $email);

$part1Email = $mascara[0];
$part2Email = $mascara[1];

/* 

PARTE 1 DA STRING:

*/

    $quantidadeCarac = strlen($part1Email); 
    //calcula quantos caracteres tem na primeira parte da string

    $inicio = $quantidadeCarac / 2; 
    // não vamos alterar o começo, então iremos separa-lo da string

    $inicioString = substr($part1Email, 0, $inicio); 
    // fazemos a separação do inicio

    $restanteString = str_replace($inicioString, "", $part1Email); 
    // pegaremos o restante 

    $restanteString = preg_replace( "/[^0-9_-]/", "*", $restanteString); 
    // vamos substituir tudo que não for numeros por "_"


/* 

PARTE 2 DA STRING:

*/

    $quantidadeCarac2 = strlen($part2Email); 
    // calcula quantos caracteres tem na segunda parte da string

    $finalParte2 = substr($part2Email, 2, $quantidadeCarac2); 
    // vamos separar a parte final que não será alterada

    $inicioParte2 = str_replace($finalParte2, "", $part2Email); 
    // separamos o começo

    $inicioParte2 = preg_replace( "/[^0-9_-]/", "*", $inicioParte2); 
    // alteramos o começo


// finaliza a string juntando as partes

$mascaraNova = $inicioString.$restanteString."@".$inicioParte2.$finalParte2;

return $mascaraNova;

}

 $emailm = $email;

 $emailm = mascara($emailm);

 echo $emailm;


if ($verificador == 1 || 2) {


//Envia email com primeira senha
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
     $mail->Subject = 'Recuperacao de Senha';//Assunto do e-mail
 
 
     //Destinátarios
     $mail->AddAddress($email, 'Teste Sysrel');
 

     //Define o corpo do email
     $mail->MsgHTML('

        <h1 align="center">Ola, link para redefinicao de senha.!</h1> 
        <h2 align="center"><img width="200px" height="100px" src="imagens\sysrel.png"></h2>
        <h3 align="center"><a href="http://localhost/cadastrosenharecuperacao.php?chave='.$chave.'">Link para recuperacao de senha</a></h3>


        ');  

    
 
    ////Caso queira colocar o conteudo de um arquivo utilize o método abaixo ao invés da mensagem no corpo do e-mail.
     //$mail->MsgHTML(file_get_contents('arquivo.html'));
 
     $mail->Send();

    if ($verificador == 1) {
        
    $sql = "INSERT INTO tb_recuperar_senha (`ID`, `ID_LIDER`, `ID_ADM`, `CODIGO`, `DTHR_ENVIO`) VALUES ('0', NULL, '$ID', '$chave', '$dataRecuperacao');";
    $sql = $conexao->query($sql);

    $_SESSION["ALERT"] = "Foi enviado um e-mail com o link de redefinição para: ".$emailm;
    header('location:index.php?');

    } else if ($verificador == 2){

    $sql = "INSERT INTO tb_recuperar_senha (`ID`, `ID_LIDER`, `ID_ADM`, `CODIGO`, `DTHR_ENVIO`) VALUES ('0', '$ID', NULL, '$chave', '$dataRecuperacao');";
    $sql = $conexao->query($sql);

    $_SESSION["ALERT"] = "Foi enviado um e-mail com o link de redefinição para: ".$emailm;
    header('location:index.php?');    


    }
     
     

    //caso apresente algum erro é apresentado abaixo com essa exceção.
    }catch (phpmailerException $e) {
       $_SESSION["ALERT"] = "O sistema não foi capaz de enviar um e-mail para: ".$emailm." verifique sua conexão e tente novamente.";
      echo $e->errorMessage();        //Mensagem de erro costumizada do PHPMailer
      header('location:telaRecuperacaoSenha.php');
}
}







include 'fechaConexao.php';



 


 ?>