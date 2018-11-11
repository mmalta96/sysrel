<?php  
session_start();

include 'abreConexao.php';
$titulo = $_POST['Titulo'];
$descricao = $_POST['Descricao'];

$sql = "INSERT INTO `tb_itens_index` (`ID`, `TITULO`, `DESCRICAO`) VALUES ('0', '$titulo', '$descricao');";
$sql = $conexao->query($sql);
$_SESSION["ALERT"] = "Item Cadastrado com Sucesso!";
header('location:ItensSobregrupo.php');

include 'fechaConexao.php';

        


?>

