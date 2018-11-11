<?php 
$nome = $_POST['nome'];
$curso = $_POST['curso'];
$clattes = $_POST['clattes'];
$dataVinculo = $_POST['dataVinculo'];
$idProjeto = $_POST['idProjeto'];



include 'abreConexao.php';
try{
$sql = "INSERT INTO `tb_discente` (`ID`, `NOME`, `CURSO`, `LATTES`) VALUES (NULL, '$nome', '$curso', '$clattes');";
$sql = $conexao->query($sql);


$sql1 = "SELECT * FROM tb_discente ORDER BY `tb_discente`.`ID` DESC;";
    $result = $conexao->query($sql1);
      $row = $result->fetch_assoc();
       $idDiscente = $row["ID"];
       

$sql2 = "INSERT INTO `tb_orientacao` (`ID`, `DATA_INICIO`, `DATA_TERMINO`, `ID_PROJETO_FK`, `ID_DISCENTE_FK`) VALUES (NULL, '$dataVinculo', NULL, '$idProjeto', '$idDiscente');";
$sql2 = $conexao->query($sql2);



$_SESSION["ALERT"] = "Discente cadastrado com sucesso" ;
                                        header('location:discentes.php?id='.$idProjeto.'');                       
}catch (Exception $e){

$_SESSION["ALERT"] = "Discente não foi cadastrado, confira os dados" ;
                                        header('location:discentes.php?id='.$idProjeto.'');                   


}











 ?>