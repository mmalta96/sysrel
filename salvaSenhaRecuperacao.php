<?php 

session_start();

$chave = $_SESSION['chave'];

$novasenha = $_POST['novasenha'];
$confirmasenha = $_POST['confirmanovasenha'];
$SenhaCriptograda = hash('sha256',$novasenha);
date_default_timezone_set('America/Sao_Paulo');
$dataAtual = date('Y-m-d H:i');
//$IDLider = 0;



include 'abreConexao.php';

//pega codigo
	$sql = "SELECT CODIGO FROM tb_recuperar_senha WHERE CODIGO = '$chave'";
	$result = $conexao->query($sql);

	if ($row = $result->fetch_assoc()) {
	$codigo = $row["CODIGO"];
}

	$sql = "SELECT DTHR_ENVIO FROM tb_recuperar_senha WHERE CODIGO = '$chave'";
	$result = $conexao->query($sql);

	if ($row = $result->fetch_assoc()) {
	$dataRecuperacao = $row["DTHR_ENVIO"];
}

	$sql = "SELECT ID_LIDER FROM tb_recuperar_senha WHERE CODIGO = '$chave'";
	$result = $conexao->query($sql);
	$verificador = 0;
	$IDLider = 0;

	if ($row = $result->fetch_assoc()) {
	$ID = $row["ID_LIDER"];
	$IDLider = $row["ID_LIDER"];
	if ($ID == NULL) {
	$verificadorLider = 0;		
	}else{
	$verificadorLider = 1;	

	}
}

$sql = "SELECT ID_ADM FROM tb_recuperar_senha WHERE CODIGO = '$chave'";
	$result = $conexao->query($sql);
	$verificador = 0;
	//$IDAdm = 0;

	if ($row = $result->fetch_assoc()) {
	$ID = $row["ID_ADM"];
	$IDAdm = $row["ID_ADM"];
	if ($ID == NULL) {
	$verificadorAdm = 0;		
	}else{
	$verificadorAdm = 1;
	}
}



$Teste = preg_match('/[0-9]+/', $novasenha);

if($Teste == 1){
$Teste = preg_match('/[a-z]+/', $novasenha);

if($Teste == 1){
  $Teste = preg_match('/[A-Z]+/', $novasenha);

  if($Teste == 1){
      $Teste = preg_match('/[\W]+/', $novasenha);
  }
}
}


$horaAtual = strtotime($dataAtual);
$horaBanco = strtotime($dataRecuperacao);

$intervalo = abs( $horaAtual - $horaBanco ) / 60;

if( $intervalo < 600 ) {

if ($codigo == $chave) {


if ($novasenha == $confirmasenha) {
 
if($Teste == 1){


	
//CODE
//SE FOR ADM
if ($IDAdm != NULL) {

	echo "cheguei aqui sou ADM";

	$sql = "UPDATE tb_administrador SET SENHA = '$SenhaCriptograda' WHERE ID = '$IDAdm';";
	$result = $conexao->query($sql);

	$sql = "UPDATE tb_administrador SET ERROS_LOGIN = 0 WHERE ID = '$IDAdm';";
	$result = $conexao->query($sql);

	$sql = "UPDATE tb_recuperar_senha SET CODIGO = '0'";
	$result = $conexao->query($sql);

	$_SESSION["ALERT"] = "Senha redefinida com sucesso!";
    header('location:index.php?');
    //SE FOR LIDER
	}else if ($verificadorLider = 1){

	$sql1 = "UPDATE tb_lider_pesquisa SET SENHA = '$SenhaCriptograda' WHERE ID = '$IDLider';";
	$result = $conexao->query($sql1);

	$sql1 = "UPDATE tb_lider_pesquisa SET ERROS_LOGIN = 0 WHERE ID = '$IDLider';";
	$result = $conexao->query($sql1);
		
	$sql = "UPDATE tb_recuperar_senha SET CODIGO = '0'";
	$result = $conexao->query($sql);		


	$_SESSION["ALERT"] = "Senha redefinida com sucesso!";
    header('location:index.php?');
    echo $IDLider;

	}	


}else if($Teste == 0){
 $_SESSION["ALERT"] = "OBS* Senha deve Conter : No minimo 6 caracteres, 1 letra minúscula, 1 maiúscula, 1 número e 1 caractere especial!";
 header('location:cadastrosenharecuperacao.php?chave='.$chave.'');

}

}else{
	$_SESSION["ALERT"] = "Senhas não Coincidem !";
    header('location:cadastrosenharecuperacao.php?chave='.$chave.'');
}

}else{
	$_SESSION["ALERT"] = "O Link não é valido solicite uma nova recuperação";
   header('location:telaRecuperacaoSenha.php');

}


}else{
	$_SESSION["ALERT"] = "O Link não é valido solicite uma nova recuperação";
   header('location:telaRecuperacaoSenha.php');
}










/*











    $Teste = preg_match('/[0-9]+/', $novasenha);

    if($Teste == 1){
        $Teste = preg_match('/[a-z]+/', $novasenha);

        if($Teste == 1){
          $Teste = preg_match('/[A-Z]+/', $novasenha);

          if($Teste == 1){
              $Teste = preg_match('/[\W]+/', $novasenha);
          }
        }
    }


  if($Teste == 1){
//compara se a chave é igual ao codigo do banco
if ($chave == $codigo) {

	$sql = "UPDATE tb_lider_pesquisa SET SENHA = '$SenhaCriptograda' WHERE PRONTUARIO = '$prontuario';";
	$result = $conexao->query($sql);

	$codigo = "0";
	$sql = "UPDATE tb_recuperar_senha SET CODIGO = '$codigo'";
	$result = $conexao->query($sql);

	$_SESSION["ALERT"] = "Senha redefinida com sucesso!";
    header('location:index.php?');

}else{
	$_SESSION["ALERT"] = "Codigo Invalido, solicite uma nova recuperação!";
    header('location:telaRecuperacaoSenha.php?');


}}else if($Teste == 0){


$_SESSION["ALERT"] = "OBS* Senha deve Conter : No minimo 6 caracteres, 1 letra minúscula, 1 maiúscula, 1 número e 1 caractere especial!";
header('location:cadastrosenharecuperacao.php?chave='.$chave.'.php?');
}


include 'fechaConexao.php';


*/

 ?>










