<?php 

session_start();

$lider = $_SESSION["ID_USUARIO"];


$senhaAntiga = $_POST['senhaAntiga'];
$novaSenha = $_POST['novaSenha'];
$confirmaSenha = $_POST['confirmaNovaSenha'];


include 'abreConexao.php';


$sql = "SELECT SENHA FROM tb_lider_pesquisa WHERE ID = '$lider'";
 $result = $conexao->query($sql);

if ($row = $result->fetch_assoc()) {
 	$senha = $row["SENHA"];} 	


include 'fechaConexao.php';


$SenhaAntigaCriptograda = hash('sha256',$senhaAntiga);



if ($SenhaAntigaCriptograda == $senha) {
	echo "Senhas Iguais";



if ($novaSenha == $confirmaSenha) {

//Expressão Regulares

$Teste = preg_match('/[0-9]+/', $novaSenha);

if($Teste == 1){
$Teste = preg_match('/[a-z]+/', $novaSenha);

if($Teste == 1){
  $Teste = preg_match('/[A-Z]+/', $novaSenha);

  if($Teste == 1){
      $Teste = preg_match('/[\W]+/', $novaSenha);
  }
}
}



 if($Teste == 1){

include 'abreConexao.php';

      //Criptografa a senha
		$SenhaCriptograda = hash('sha256',$novaSenha);

		$sql = "UPDATE tb_lider_pesquisa SET SENHA = '$SenhaCriptograda' WHERE ID = $lider;";
		$result = $conexao->query($sql);

     

        include 'fechaConexao.php';
		$_SESSION["ALERT1"] = "Senha salva com sucesso!";
        header("location: telaManutencaoUsuarios.php");
    
    } else if($Teste == 0){
        $_SESSION["ALERT"] = "OBS* Senha deve Conter : No minimo 6 caracteres, 1 letra minúscula, 1 maiúscula, 1 número e 1 caractere especial!";
        header("location: telaManutencaoUsuarios.php");
        include 'fechaConexao.php';

}}else{
	$_SESSION["ALERT"] = "Senhas não Coincidem !";
    header('location:telaManutencaoUsuarios.php?');
}





}else{
$_SESSION["ALERT"] = "Senhas antiga não coincide !";
    header('location:telaManutencaoUsuarios.php?');





	echo "Senhas diferentes";
}









 ?>