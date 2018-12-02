<?php 
session_start();

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$dataVinculo = $_POST['dataVinculo'];
$idGrupo = $_SESSION['idGrupoAtual'];


include 'abreConexao.php';


try{
$sql = "INSERT INTO `tb_equipamentos` (`ID`, `NOME`, `DESCRICAO`, `DATA_INICIO`, `DATA_TERMINO`, `ID_GRUPO_FK`) VALUES (NULL, '$nome', '$descricao', '$dataVinculo', NULL, '$idGrupo');";
$sql = $conexao->query($sql);

$_SESSION["ALERT"] = "Equipamento cadastrado com sucesso" ;
                                        header('location:equipamentos.php');                        
}catch (Exception $e){

$_SESSION["ALERT"] = "Equipamento não foi cadastrado, confira os dados" ;
                                        header('location:telaCadastroEquipamento.php');                        


}






 ?>