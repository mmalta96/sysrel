<?php 
$nome = $_POST['nome'];
$curso = $_POST['curso'];
$clattes = $_POST['clattes'];
$dataVinculo = $_POST['dataVinculo'];
$dataTermino = $_POST['dataTermino'];
$idProjeto = $_POST['idProjeto'];
$idDiscente = $_POST['idDiscente'];
$idOrientacao = $_POST['idOrientacao'];



include 'abreConexao.php';
try{

     $sql = "UPDATE tb_discente SET NOME = '$nome' WHERE ID = '$idDiscente';";
    $sql = $conexao->query($sql);

    $sql = "UPDATE tb_discente SET CURSO = '$curso' WHERE ID = '$idDiscente';";
    $sql = $conexao->query($sql);


    if(strpos($clattes, 'LATTES')){

	 $sql = "UPDATE tb_discente SET LATTES = '$clattes' WHERE ID = '$idDiscente';";
    $sql = $conexao->query($sql);}
    else{
                        $_SESSION["ALERT1"] = "O curriculo lattes digitado não é valido";
        header("location: discente.php?id=".$idProjeto."");
                      }   


    $sql = "UPDATE tb_orientacao SET DATA_INICIO = '$dataVinculo' WHERE ID = '$idOrientacao';";
    $sql = $conexao->query($sql);

       $sql = "UPDATE tb_orientacao SET DATA_TERMINO = '$dataTermino' WHERE ID = '$idOrientacao';";
    $sql = $conexao->query($sql);
 

  



$_SESSION["ALERT"] = "Discente cadastrado com sucesso" ;
                                        header('location:discentes.php?id='.$idProjeto.'');                   
}catch (Exception $e){

$_SESSION["ALERT"] = "Discente não foi cadastrado, confira os dados" ;
                                        header('location:discentes.php?id='.$idProjeto.'');                   


}











 ?>