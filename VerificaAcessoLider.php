<!--CODIGO DESENVOLVIDO POR MATHEUS -->
<?php 
session_start();

//Recebe senha
$NovaSenha = $_POST['novasenha'];
$ConfirmaSenha = $_POST['confirmanovasenha'];


  

//PEGAR O NOME DE QUEM FEZ O LOGIN
$lider = $_SESSION["ID_USUARIO"];





include 'abreConexao.php';


$sql = "SELECT SENHA FROM tb_lider_pesquisa WHERE ID = $lider;";

$result = $conexao->query($sql);

$senhaAntiga;

if($row = $result->fetch_assoc()){
		$senhaAntiga = $row["SENHA"];
}



if ($NovaSenha == $ConfirmaSenha) {

//Expressão Regulares

$Teste = preg_match('/[0-9]+/', $NovaSenha);

if($Teste == 1){
$Teste = preg_match('/[a-z]+/', $NovaSenha);

if($Teste == 1){
  $Teste = preg_match('/[A-Z]+/', $NovaSenha);

  if($Teste == 1){
      $Teste = preg_match('/[\W]+/', $NovaSenha);
  }
}
}



 if($Teste == 1){

      //Criptografa a senha
		$SenhaCriptograda = hash('sha256',$NovaSenha);

		$sql = "UPDATE tb_lider_pesquisa SET SENHA_ANTIGA = '$senhaAntiga' WHERE ID = $lider;";
		$result = $conexao->query($sql);
		$sql = "UPDATE tb_lider_pesquisa SET SENHA = '$SenhaCriptograda' WHERE ID = $lider;";
		$result = $conexao->query($sql);

     

        include 'fechaConexao.php';
		$_SESSION["ALERT1"] = "Senha salva com sucesso!";
        header("location: telaPrimeiroAcessoLider.php");
    
    } else if($Teste == 0){
        $_SESSION["ALERT"] = "OBS* Senha deve Conter : No minimo 6 caracteres, 1 letra minúscula, 1 maiúscula, 1 número e 1 caractere especial!";
        header("location: telaPrimeiroAcessoLider.php");
        include 'fechaConexao.php';

}}else{
	$_SESSION["ALERT"] = "Senhas não Coincidem !";
    header('location:telaPrimeiroAcessoLider.php?');
}




?>