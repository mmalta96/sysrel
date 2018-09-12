<?php 

session_start();

$lider = $_SESSION["ID_USUARIO"];


$senhaAtual = $_POST['senhaatual'];
$novaSenha = $_POST['novasenha'];
$confirmaSenha = $_POST['confirmanovasenha'];


include 'abreConexao.php';


$sql = "SELECT SENHA FROM tb_lider_pesquisa WHERE ID = '$lider'";
 $result = $conexao->query($sql);

if ($row = $result->fetch_assoc()) {
 	$senha = $row["SENHA"];} 	


include 'fechaConexao.php';


$SenhaCriptograda = hash('sha256',$novaSenha);



if ($SenhaCriptograda == $senhaAtual) {
	echo "Senhas Iguais";

}else{
	echo "Senhas diferentes";
}














echo $lider;
echo $senha;

 ?>