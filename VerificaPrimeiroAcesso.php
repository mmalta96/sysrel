
<?php 



$USUARIO = $_POST['uname'];
$SENHA= $_POST['psw'];

include 'abreConexao.php';

//VERIFICA SE Email existe
$sql = "SELECT * FROM `tb_administrador`";

$resultado =  $conexao->query($sql);
$verificador = 0;
$quantidadeDisponivel = 5;

$consulta = $conexao->query($sql);
$conta = $consulta->fetch_assoc();
if (empty($conta))
{
	//SE NÃO HOUVER ADMNISTRADORES, CHAMA PAGINA DE CADASTRO
	header("location:PrimeiroAcessoAdm.php");
} else {
	header("location:Login.php");
}



include 'fechaConexao.php'
?>


