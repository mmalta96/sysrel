<?php 

  
session_start();

 $nome = $_POST['nome'];
 $descricao = $_POST['descricao'];
 $dataVinculo = $_POST['dataVinculo'];
 $idEquipamento = $_POST['idEquipamento'];




    include 'abreConexao.php';

    $sql = "UPDATE tb_equipamentos SET NOME = '$nome' WHERE ID = '$idEquipamento';";
    $sql = $conexao->query($sql);

    $sql = "UPDATE tb_equipamentos SET DESCRICAO = '$descricao' WHERE ID = '$idEquipamento';";
    $sql = $conexao->query($sql);

    $sql = "UPDATE tb_equipamentos SET DATA_INICIO = '$dataVinculo' WHERE ID = '$idEquipamento';";
    $sql = $conexao->query($sql);

    $_SESSION["ALERT"] = "Equipamento alterado com sucesso" ;
                                        header('location:equipamentos.php');

 ?>