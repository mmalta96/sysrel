<!--CODIGO DESENVOLVIDO POR MATHEUS -->
<?php 
session_start();

//Recebe senha e passa criptografia sha256
$nsenha = $_POST['nsenha'];
$nsenhacriptograda = hash('sha256',$nsenha);
$confirmasenha = $_POST['nsenhac'];
$lider = 7;



include 'abreConexao.php';


if ($nsenha == $confirmasenha) {

//selecionando dados da tabela
$sql = "SELECT * FROM tb_lider_pesquisa"
$query = mysql_query($sql);
while($sql = mysql_fetch_array($query)){
$id = $sql["$lider"];
$senhaAntiga = $sql["SENHA"];
//onde $nome é a variavel que rerpresenta a coluna "nome" nessa
//mesma tabela.
echo "$senhaAntiga"; //exibindo o que foi achado na coluna "nome".
}




	$sql = "UPDATE tb_lider_pesquisa SET SENHA = '$nsenhacriptograda' WHERE ID = '$lider';";
$result = $conexao->query($sql);
}else{
	$_SESSION["ALERT"] = "Senhas não coincidem!" ;
	header('location:verificaAcessoLider.php');

}


if ($result) {
	echo("deu certo");
}

include 'fechaConexao.php';




 ?>