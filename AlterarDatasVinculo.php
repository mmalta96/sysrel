<?php
  

   session_start();
     $id = $_POST['idReg'];
	 $inicio = $_POST['dataInicio'];
     
     //pega id do usuario
     include 'abreConexao.php';

                    $sql = "SELECT ID_DOCENTE_FK FROM `tb_docente_linha` WHERE ID = '$id'";
                    $result = $conexao->query($sql);
                    while($row = $result->fetch_assoc()) {
                        $idDocente = $row["ID_DOCENTE_FK"];
                      }


                     include 'fechaConexao.php';



     if (isset($_POST['dataFim'])){
        $fim = $_POST['dataFim'];
            // TEM DATA FIM
                try {
         // Inicia a sessão
                    include 'abreConexao.php';

                    $sql = "UPDATE tb_docente_linha 
                    set DATA_INICIO = '$inicio', DATA_TERMINO = '$fim'
                    WHERE ID = '$id'";
                     $conexao->query($sql);
                    $_SESSION["ALERT"] = "Data Alterada Com Sucesso !! ";
                     header('location:AlterarDatasDeVinculacao.php?id='.$idDocente.'');


                     include 'fechaConexao.php';


                         }catch (Exception $e) {

      $_SESSION["ALERT"] = "Não foi possivel remover o item .";
     header('location:AlterarDatasDeVinculacao.php');
        }

    }
                else{
            //NAO TEM DATA FIM

                try {
         // Inicia a sessão
                    include 'abreConexao.php';

                    $sql = "UPDATE tb_docente_linha 
                    set DATA_INICIO = '$inicio'
                    WHERE ID = '$id'";
                     $conexao->query($sql);
                    $_SESSION["ALERT"] = "Data Alterada Com Sucesso !! ";
                     header('location:AlterarDatasDeVinculacao.php?id='.$idDocente.'');


                     include 'fechaConexao.php';


                         }catch (Exception $e) {

      $_SESSION["ALERT"] = "Não foi possivel remover o item .";
     header('location:AlterarDatasDeVinculacao.php');


        }
    }


     

        

?>